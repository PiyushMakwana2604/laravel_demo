var con = require("../../../config/database");
var asyncLoop = require('node-async-loop');
var global = require('../../../config/constant');
var common = require('../../../config/common');
const { query, request } = require("express");
var user = {
    get_user_details: function (id, callback) {
        con.query(
            "SELECT tu.*,IFNULL(tud.token,'') as token,IFNULL(tud.device_type,'') as device_type, IFNULL(tud.device_token,'') as device_token  FROM tbl_user as tu LEFT JOIN tbl_user_device_info as tud ON tu.id=tud.user_id where tu.id= ? ",
            [id],
            function (err, result) {
                var user_data = result[0];
                if (err) {
                    callback("found error" + err);
                } else {
                    callback(user_data);
                }
            }
        );
    },
    get_post_details: function (id, callback) {
        // ,CONCAT('" + global.BASE_URL + global.POST_IMAGE + "','',post_image)AS post_image
        con.query(
            "SELECT * FROM tbl_post WHERE id = ? ",
            [id],
            function (err, result) {
                var user_data = result[0];
                if (err) {
                    callback("found error" + err);
                } else {
                    callback(user_data);
                }
            }
        );
    },
    get_event_details: function (id, callback) {
        con.query(
            "SELECT * FROM tbl_event WHERE id = ? ",
            [id],
            function (err, result) {
                var user_data = result[0];
                if (err) {
                    callback("found error" + err);
                } else {
                    callback(user_data);
                }
            }
        );
    },
    get_chat_details: function (id, callback) {
        con.query(
            `SELECT c.*, u.full_name, u.profile_image,
            CASE
                    WHEN TIMESTAMPDIFF(second, c.created_at, now()) < 60 THEN concat(TIMESTAMPDIFF(second, c.created_at, now()), ' seconds ago')
                    WHEN TIMESTAMPDIFF(minute, c.created_at, now()) < 60 THEN concat(TIMESTAMPDIFF(minute, c.created_at, now()), ' minutes ago')
                    WHEN TIMESTAMPDIFF(hour, c.created_at, now()) < 24 THEN concat(TIMESTAMPDIFF(hour, c.created_at, now()), ' hours ago')
                    WHEN TIMESTAMPDIFF(day, c.created_at, now()) < 31 THEN concat(TIMESTAMPDIFF(day, c.created_at, now()), ' days ago')
                END as time_diffrence
                FROM tbl_chat c
                LEFT JOIN tbl_user u on c.sender_id = u.id
                WHERE c.id = ?`,
            [id],
            function (err, result) {
                var user_data = result[0];
                if (err) {
                    callback("found error" + err);
                } else {
                    callback(user_data);
                }
            }
        );
    },
    get_comment_details: function (id, callback) {
        con.query(
            "SELECT * FROM tbl_post_comment WHERE id = ? ",
            [id],
            function (err, result) {
                var user_data = result[0];
                if (err) {
                    callback("found error" + err);
                } else {
                    callback(user_data);
                }
            }
        );
    },
    get_contectUs_details: function (id, callback) {
        con.query("SELECT * FROM tbl_contact_us where id= ? ", [id], function (err, result) {
            if (err) {
                callback("0", { keyword: "rest_error", content: {} } + err);
            } else {
                var place_data = result[0];
                con.query("SELECT * FROM tbl_contact_us_image where contact_us_id= ? ", [id], function (err, result) {
                    console.log(place_data);
                    if (err) {
                        place_data.image = [];
                        callback(place_data);
                    } else {
                        place_data.image = result;
                        callback(place_data);
                    }
                }
                );
            }
        }
        );
    },
    // homescreen_feed: function (request, token, callback) {
    //     con.query("SELECT u.id,u.profile_image,u.full_name FROM tbl_user u JOIN tbl_user_device_info ud ON u.id=ud.user_id WHERE ud.token = ? ", [token], function (err, result) {
    //         // console.log(err)
    //         if (!err && result.length > 0) {
    //             // console.log(result);

    //             // WHERE p.user_id != ? 
    //             con.query(`SELECT p.id,p.post_image,p.description,p.like_count,p.comment_count,pl.is_active as is_like,u.full_name,u.profile_image,
    //             CASE
    //                 WHEN TIMESTAMPDIFF(second,p.created_at,now()) < 60 THEN concat(TIMESTAMPDIFF(second,p.created_at,now()),' seconds ago')
    //                 WHEN TIMESTAMPDIFF(minute,p.created_at,now()) < 60 THEN concat(TIMESTAMPDIFF(minute,p.created_at,now()),' minutes ago')
    //                 WHEN TIMESTAMPDIFF(hour,p.created_at,now()) < 24 THEN concat(TIMESTAMPDIFF(hour,p.created_at,now()),' hours ago')
    //                 WHEN TIMESTAMPDIFF(day,p.created_at,now()) < 31 THEN concat( TIMESTAMPDIFF(day,p.created_at,now()),' days ago')
    //                 WHEN TIMESTAMPDIFF(month,p.created_at,now()) < 13 THEN concat( TIMESTAMPDIFF(month,p.created_at,now()),' months ago')
    //             END as time_diffrence
    //             FROM tbl_post p
    //             LEFT JOIN tbl_post_like pl ON p.id=pl.post_id AND pl.user_id = ?
    //             LEFT JOIN tbl_user u on p.user_id=u.id
    //             ORDER BY p.created_at desc`, result[0].id, function (err, response) {
    //                 if (!err) {
    //                     // result[0].posts = response
    //                     // console.log(response)
    //                     callback("1", { keyword: "rest_keyword_success_message", content: {} }, response);

    //                 } else {
    //                     console.log(err);
    //                     callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
    //                 }
    //             })
    //         } else {
    //             callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
    //         }
    //     })
    // },

    homescreen_feed: function (request, token, callback) {
        // console.log(Date.now());
        var page = request.page
        var perPage = request.perpage
        // console.log("request123", request);
        // console.log(perPage);
        con.query("SELECT u.id,u.profile_image,u.full_name FROM tbl_user u JOIN tbl_user_device_info ud ON u.id=ud.user_id WHERE ud.token = ? ", [token], function (err, result) {
            if (!err && result.length > 0) {
                var userId = result[0].id;
                var offset = (page - 1) * perPage;

                var query = `SELECT p.id,u.id as user_id,p.post_image,p.description,p.like_count,p.comment_count,pl.is_active as is_like,uf.is_active as is_follow,u.full_name,u.profile_image,
                    CASE
                        WHEN TIMESTAMPDIFF(second,p.created_at,now()) < 60 THEN concat(TIMESTAMPDIFF(second,p.created_at,now()),' seconds ago')
                        WHEN TIMESTAMPDIFF(minute,p.created_at,now()) < 60 THEN concat(TIMESTAMPDIFF(minute,p.created_at,now()),' minutes ago')
                        WHEN TIMESTAMPDIFF(hour,p.created_at,now()) < 24 THEN concat(TIMESTAMPDIFF(hour,p.created_at,now()),' hours ago')
                        WHEN TIMESTAMPDIFF(day,p.created_at,now()) < 31 THEN concat( TIMESTAMPDIFF(day,p.created_at,now()),' days ago')
                        WHEN TIMESTAMPDIFF(month,p.created_at,now()) < 13 THEN concat( TIMESTAMPDIFF(month,p.created_at,now()),' months ago')
                    END as time_diffrence
                    FROM tbl_post p
                    LEFT JOIN tbl_post_like pl ON p.id=pl.post_id AND pl.user_id = ?
                    LEFT JOIN tbl_user_following uf ON p.user_id=uf.user_id 
                    LEFT JOIN tbl_user u on p.user_id=u.id
                    GROUP BY p.id
                    ORDER BY p.created_at desc
                    `;

                con.query(query, [userId, perPage, offset], function (err, response) {
                    if (!err) {
                        callback("1", { keyword: "rest_keyword_success_message", content: {} }, response);
                    } else {
                        console.log(err);
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                    }
                });
            } else {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
            }
        });
    },

    add_comment: function (request, callback) {
        var value = {
            user_id: request.user_id,
            post_id: request.post_id,
            comment: request.comment,
        };
        con.query("INSERT INTO tbl_post_comment SET ? ", [value], function (err, response) {
            if (!err) {
                //   console.log("success")
                let id = response.insertId
                user.get_comment_details(id, function (comment_data) {
                    // console.log(result[0].id)
                    // console.log(comment_data)
                    if (comment_data == null) {
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                    } else {
                        callback("1", { keyword: "rest_keyword_success_message", content: {} }, comment_data);
                    }
                })
                // callback("1",  { keyword:"rest_keyword_success_message",content:{}}, response);
            } else {
                console.log(err);
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
            }
        });
    },
    add_like: function (request, callback) {
        con.query("SELECT * FROM tbl_post_like WHERE user_id = ? AND post_id = ? ", [request.user_id, request.post_id], function (err, result_update) {
            if (!err && result_update.length > 0) {
                con.query("DELETE FROM tbl_post_like WHERE id=?;", [result_update[0].id], function (err, result) {
                    if (!err) {
                        callback("1", { keyword: 'rest_keyword_success_message', content: {} }, result);
                    } else {
                        callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
                    }
                })
            } else if (err) {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
            } else {
                var value = {
                    user_id: request.user_id,
                    post_id: request.post_id
                };
                con.query("INSERT INTO tbl_post_like SET ? ", [value], function (err, response) {
                    if (!err) {
                        callback("1", { keyword: "rest_keyword_success_message", content: {} }, response);
                    } else {
                        console.log(err);
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
                    }
                });
            }

        })
    },
    comments_feed: function (request, callback) {
        // con.query("SELECT u.id,u.profile_image,u.user_name FROM tbl_user u JOIN tbl_user_device_info ud ON u.id=ud.user_id WHERE ud.token = ? ", [token], function (err, result) {
        //     if (!err && result.length > 0) {
        con.query("SELECT COUNT(id) as comment_count FROM tbl_post_comment pc WHERE pc.post_id= ? ", [request.post_id], function (err, result) {
            if (!err) {
                // result[0].comment_count = count_result
                con.query(`SELECT pc.id,pc.user_id,u.profile_image,u.full_name,pc.comment,
                        CASE
                            WHEN TIMESTAMPDIFF(second,pc.created_at,now()) <= 60 THEN concat(TIMESTAMPDIFF(second,pc.created_at,now()),' seconds ago')
                            WHEN TIMESTAMPDIFF(minute,pc.created_at,now()) <= 60 THEN concat(TIMESTAMPDIFF(minute,pc.created_at,now()),' minutes ago')
                            WHEN TIMESTAMPDIFF(hour,pc.created_at,now()) <= 24 THEN concat(TIMESTAMPDIFF(hour,pc.created_at,now()),' hours ago')
                            WHEN TIMESTAMPDIFF(day,pc.created_at,now()) <= 31 THEN concat( TIMESTAMPDIFF(day,pc.created_at,now()),' days ago')
                            WHEN TIMESTAMPDIFF(month,pc.created_at,now()) < 13 THEN concat( TIMESTAMPDIFF(month,pc.created_at,now()),' months ago')
                        END as time_diffrence
                        FROM tbl_post_comment pc
                        JOIN tbl_user u ON pc.user_id=u.id
                        WHERE pc.post_id= ? 
                        ORDER BY pc.created_at desc`, [request.post_id], function (err, response) {
                    if (!err) {
                        result[0].posts = response
                        callback("1", { keyword: "rest_keyword_success_message", content: {} }, result);

                    } else {
                        console.log(err);
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                    }
                });
            } else {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
            }
        })

        //     } else {
        //         callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
        //     }
        // })
    },
    create_event: function (request, token, callback) {
        con.query("SELECT u.id FROM tbl_user u JOIN tbl_user_device_info ud ON u.id=ud.user_id WHERE ud.token = ? ", [token], function (err, result) {
            if (!err && result.length > 0) {
                // console.log("hii")
                var value = {
                    // user_id:result[0].id,
                    event_image: request.event_image,
                    event_name: request.event_name,
                    event_location: request.event_location,
                    date: request.date,
                    time: request.time,
                    description: request.description,
                    members_price: request.members_price,
                    non_members_price: request.non_members_price,
                    // like_count: (request.like_count != undefined) ? request.like_count : "",
                    // comment_count: (request.comment_count != undefined) ? request.comment_count : "",
                };
                con.query("INSERT INTO tbl_event SET ? ", [value], function (err, response) {
                    if (!err) {
                        //   console.log("success",response)
                        let id = response.insertId
                        console.log(id)
                        user.get_event_details(id, function (user_data) {
                            // console.log(user_data)
                            if (user_data == null) {
                                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                            } else {
                                callback("1", { keyword: "rest_keyword_success_message", content: {} }, user_data);
                            }
                        })
                    } else {
                        // console.log("err");
                        console.log(err);
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                    }
                });
            } else {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
            }
        })
    },
    event_homescreen: function (request, callback) {
        // SELECT * FROM tbl_event WHERE date= ? ORDER BY created_at DESC

        con.query("SELECT * FROM tbl_event WHERE date BETWEEN ? AND ?", [request.start_date, request.end_date], function (err, result) {
            if (!err) {
                console.log("response", result);
                // result[0].post=post_result
                con.query("SELECT count(id) as upcoming_event FROM tbl_event WHERE date BETWEEN ? AND ? ", [request.start_date, request.end_date], function (err, response) {
                    if (!err && result.length > 0) {
                        response[0].event_details = result
                        console.log("err", result)
                        console.log("err", response)
                        callback("1", { keyword: "rest_keyw ord_success_message", content: {} }, response);
                    } else {
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                    }
                })
            } else {
                console.log(err)
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
            }
        })
    },
    all_event: function (request, callback) {
        // SELECT * FROM tbl_event WHERE date= ? ORDER BY created_at DESC

        con.query("SELECT * FROM tbl_event ORDER BY created_at DESC", function (err, result) {
            if (!err) {
                console.log("response", result);
                // result[0].post=post_result
                con.query("SELECT count(id) as upcoming_event FROM tbl_event ", function (err, response) {
                    if (!err && result.length > 0) {
                        response[0].event_details = result
                        // console.log("err", result)
                        // console.log("err", response)
                        callback("1", { keyword: "rest_keyw ord_success_message", content: {} }, response);
                    } else {
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                    }
                })
            } else {
                console.log(err)
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
            }
        })
    },
    event_details: function (request, callback) {
        con.query("SELECT * FROM tbl_event WHERE id= ? ORDER BY created_at DESC", [request.event_id], function (err, result) {
            if (!err) {
                // result[0].post=post_result
                callback("1", { keyword: "rest_keyw ord_success_message", content: {} }, result);
            } else {
                console.log(err)
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
            }
        })
    },
    create_post: function (request, callback) {
        // con.query("SELECT u.id FROM tbl_user u JOIN tbl_user_device_info ud ON u.id=ud.user_id WHERE ud.token = ? ", [token], function (err, result) {
        //     if (!err && result.length > 0) {
        var value = {
            user_id: request.user_id,
            post_image: request.post_image,
            description: request.description,
            like_count: (request.like_count != undefined) ? request.like_count : "",
            comment_count: (request.comment_count != undefined) ? request.comment_count : "",
        };
        con.query("INSERT INTO tbl_post SET ? ", [value], function (err, response) {
            if (!err) {
                //   console.log("success")
                let id = response.insertId
                user.get_post_details(id, function (user_data) {
                    // console.log(result[0].id)
                    // console.log(user_data)
                    if (user_data == null) {
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                    } else {
                        callback("1", { keyword: "rest_keyword_success_message", content: {} }, user_data);
                    }
                })
                // callback("1",  { keyword:"rest_keyword_success_message",content:{}}, response);
            } else {
                // console.log("err");
                console.log(err);
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
            }
        });
        //     } else {
        //         callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
        //     }
        // })
    },
    my_profile: function (request, callback) {
        con.query("SELECT u.* FROM tbl_user u Where u.id = ? ", [request.user_id], function (err, result) {
            if (!err && result.length > 0) {
                callback("1", { keyword: "rest_keyword_success_message", content: {} }, result);
            } else {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
            }
        })
    },
    my_profile_post: function (request, callback) {
        // con.query("SELECT u.id,u.full_name,u.profile_image,u.study FROM tbl_user u JOIN tbl_user_device_info ud ON u.id=ud.user_id WHERE ud.token = ? ", [token], function (err, result) {
        //     if (!err && result.length > 0) {
        con.query(`SELECT p.id,u.id as user_id,u.profile_image,p.post_image,p.description,p.like_count,p.comment_count,pl.is_active as is_like,u.full_name,u.profile_image,
        CASE
            WHEN TIMESTAMPDIFF(second,p.created_at,now()) < 60 THEN concat(TIMESTAMPDIFF(second,p.created_at,now()),' seconds ago')
            WHEN TIMESTAMPDIFF(minute,p.created_at,now()) < 60 THEN concat(TIMESTAMPDIFF(minute,p.created_at,now()),' minutes ago')
            WHEN TIMESTAMPDIFF(hour,p.created_at,now()) < 24 THEN concat(TIMESTAMPDIFF(hour,p.created_at,now()),' hours ago')
            WHEN TIMESTAMPDIFF(day,p.created_at,now()) < 31 THEN concat( TIMESTAMPDIFF(day,p.created_at,now()),' days ago')
        END as time_diffrence
        FROM tbl_post p
        LEFT JOIN tbl_post_like pl ON p.id=pl.post_id
        LEFT JOIN tbl_user u on p.user_id=u.id
        WHERE p.user_id=?
        GROUP BY p.id
        ORDER BY p.created_at desc`, [request.user_id], function (err, result) {
            if (!err & result.length > 0) {
                // result[0].post = post_result
                callback("1", { keyword: "rest_keyw ord_success_message", content: {} }, result);
            } else {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
            }
        })
        //     } else {
        //         callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
        //     }
        // })
    },
    contact_us: function (request, callback) {
        var value = {
            title: request.title,
            email: request.email,
            message: request.message,
            //   images: (request.images != undefined) ? request.images : "",
        };
        con.query("INSERT INTO tbl_contact_us SET ? ", [value], function (err, result) {
            if (!err) {
                // console.log(result.insertId);
                var id = result.insertId;
                asyncLoop(request.images, function (item, next) {
                    //code
                    var image = {
                        contact_us_id: id,
                        image: item,
                    };
                    con.query("INSERT INTO tbl_contact_us_image SET ? ", [image], function (err, result) {
                        if (!err) {
                            next();
                        } else {
                            next();
                        }
                    }
                    );
                },
                    function (err) {
                        // after loop complete
                        user.get_contectUs_details(id, function (place_data) {
                            if (place_data == null) {
                                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                            } else {
                                callback("1", { keyword: "rest_keyword_success_message", content: {} }, place_data);
                            }
                        });
                    }
                );
            } else {
                console.log("err");
                console.log(err);
            }
        });
    },
    faqs: function (request, parmas, callback) {
        var where = ``;
        if (request.search && request.search != []) {
            where += `WHERE LOWER(question) LIKE ('%${request.search}%') `;
        }
        // console.log("request", request)
        // var page = Number(parmas.page) || 1;
        // var limit = Number(parmas.limit) || 4;
        // var skip = (page - 1) * limit
        // + where + " limit ? offset ?", [limit, skip]
        // console.log(where);
        con.query("SELECT id,question,answer FROM tbl_faqs " + where + " ", function (err, result) {
            if (!err && result.length > 0) {
                callback("1", { keyword: 'rest_keyword_success_message', content: {} }, result);
            } else {
                callback("0", { keyword: 'rest_keyword_content_error', content: {} }, err);
            }
        })

    },
    delete_post: function (request, callback) {
        con.query("SELECT id,post_image FROM tbl_post WHERE id=?", [request.post_id], function (err, response) {
            if (!err && response.length > 0) {
                // callback("1", { keyword: 'rest_keyword_success_message', content: {} }, response);
                con.query("DELETE FROM tbl_post WHERE id=?;", [request.post_id], function (err, result) {
                    if (!err) {
                        con.query("DELETE FROM tbl_post_like WHERE post_id=?;", [request.post_id], function (err, result_data) {
                            if (!err) {
                                callback("1", { keyword: 'rest_keyword_success_message', content: {} }, response);
                            } else {
                                callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
                            }
                        })
                        // callback("1", { keyword: 'rest_keyword_success_message', content: {} }, result);
                    } else {
                        callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
                    }
                })
            } else {
                callback("0", { keyword: 'rest_keyword_content_error', content: {} }, err);
            }
        })
    },
    delete_comment: function (request, callback) {
        con.query("DELETE FROM tbl_post_comment WHERE id=?;", [request.comment_id], function (err, result) {
            if (!err) {
                callback("1", { keyword: 'rest_keyword_success_message', content: {} }, result);
            } else {
                callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
            }
        })

    },
    update_user: function (request, callback) {
        con.query("SELECT * FROM tbl_user WHERE id=?", [request.user_id], function (err, response) {
            if (!err && response.length > 0) {
                // callback("1", { keyword: 'rest_keyword_success_message', content: {} }, response);
                var value = {
                    full_name: request.full_name,
                    email: request.email,
                    study: request.study,
                    office_phone_no: request.office_phone_no,
                    mobile_number: request.mobile_number,
                    office_city: request.office_city,
                    office_state: request.office_state,
                    office_address: request.office_address,
                    profile_image: (request.profile_image != undefined) ? request.profile_image : response[0].profile_image,

                };
                con.query("UPDATE tbl_user SET ? WHERE id = ?;", [value, request.user_id], function (err, result) {
                    if (!err) {
                        // callback("1", { keyword: 'rest_keyword_success_message', content: {} }, result);
                        user.get_user_details(request.user_id, function (user_data) {
                            // console.log(result[0].id)
                            // console.log(user_data)
                            if (user_data == null) {
                                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                            } else {
                                callback("1", { keyword: "rest_keyword_success_message", content: {} }, user_data);
                            }
                        })
                    } else {
                        callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
                    }
                })
            } else {
                callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
            }
        })


    },
    follow_user: function (request, callback) {
        con.query("SELECT * FROM tbl_user_following WHERE user_id = ? AND follow_id = ? ", [request.user_id, request.follow_id], function (err, result_update) {
            if (!err && result_update.length > 0) {
                con.query("DELETE FROM tbl_user_following WHERE id=?;", [result_update[0].id], function (err, result) {
                    if (!err) {
                        callback("1", { keyword: 'rest_keyword_success_message', content: {} }, result);
                    } else {
                        callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
                    }
                })
            } else if (err) {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
            } else {
                con.query("SELECT * FROM tbl_user WHERE id = ?", [request.follow_id], function (err, response_data) {
                    if (!err && response_data.length > 0 && response_data[0].profile_type == "private") {
                        var value = {
                            user_id: request.user_id,
                            follow_id: request.follow_id,
                            status: "pending"
                        };
                        con.query("INSERT INTO tbl_user_following SET ? ", [value], function (err, response) {
                            if (!err) {
                                callback("1", { keyword: "rest_keyword_success_message", content: {} }, response);
                            } else {
                                console.log(err);
                                callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
                            }
                        });
                    } else if (err) {
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
                    } else {
                        var value = {
                            user_id: request.user_id,
                            follow_id: request.follow_id,
                            status: "accept"
                        };
                        con.query("INSERT INTO tbl_user_following SET ? ", [value], function (err, response) {
                            if (!err) {
                                callback("1", { keyword: "rest_keyword_success_message", content: {} }, response);
                            } else {
                                console.log(err);
                                callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
                            }
                        });
                    }
                })

            }

        })
    },
    follow: function (request, callback) {
        con.query("SELECT * FROM tbl_user_following WHERE is_active = '1' AND user_id = ? AND follow_id = ? ", [request.user_id, request.follow_id], function (error, result) {
            if (!error && result.length > 0) {

                callback("1", { keyword: "rest_keyword_success_message", content: {} }, result);
            } else if (error) {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, error);
            } else {
                callback("1", { keyword: "rest_keyword_success_message", content: {} }, null);
            }
        }
        );
    },
    following_count: function (request, callback) {
        // console.log(request);
        con.query("SELECT COUNT(uf.id) as following_count,uf.user_id FROM tbl_user_following uf JOIN tbl_user u ON uf.user_id=u.id WHERE uf.user_id=? AND uf.is_active=1 AND uf.is_delete=0 AND uf.status='accept' ", [request.user_id], function (error, response) {
            if (!error) {
                callback("1", { keyword: "rest_keyword_success_message", content: {} }, response);
            } else {
                console.log("response", response);
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, error);
            }
        }
        );
    },
    follower_count: function (request, callback) {
        // console.log(request);
        con.query("SELECT COUNT(uf.id) as follower_count,uf.follow_id FROM tbl_user_following uf JOIN tbl_user u ON uf.user_id=u.id WHERE uf.follow_id=? AND uf.is_active=1 AND uf.is_delete=0 AND uf.status='accept' ", [request.follow_id], function (error, response) {
            if (!error) {
                callback("1", { keyword: "rest_keyword_success_message", content: {} }, response);
            } else {
                console.log("response", response);
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, error);
            }
        }
        );
    },
    following_list: function (request, callback) {
        con.query(`SELECT uf.id,uf.user_id,uf.follow_id,u.full_name as following_name,u.profile_image as following_image,
                    CASE
                        WHEN TIMESTAMPDIFF(second,uf.created_at,now()) < 60 THEN concat(TIMESTAMPDIFF(second,uf.created_at,now()),' seconds ago')
                        WHEN TIMESTAMPDIFF(minute,uf.created_at,now()) < 60 THEN concat(TIMESTAMPDIFF(minute,uf.created_at,now()),' minutes ago')
                        WHEN TIMESTAMPDIFF(hour,uf.created_at,now()) < 24 THEN concat(TIMESTAMPDIFF(hour,uf.created_at,now()),' hours ago')
                        WHEN TIMESTAMPDIFF(day,uf.created_at,now()) < 31 THEN concat( TIMESTAMPDIFF(day,uf.created_at,now()),' days ago')
                        WHEN TIMESTAMPDIFF(month,uf.created_at,now()) < 13 THEN concat( TIMESTAMPDIFF(month,uf.created_at,now()),' months ago')
                    END as time_diffrence
                    FROM tbl_user_following uf
                    JOIN tbl_user u ON uf.follow_id=u.id
                    WHERE uf.user_id = ? AND uf.is_active=1 AND uf.is_delete=0 AND uf.status="accept"
                    ORDER BY uf.created_at DESC`, [request.user_id], function (error, response) {
            if (!error) {
                callback("1", { keyword: "rest_keyword_success_message", content: {} }, response);
            } else {
                console.log("response", response);
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, error);
            }
        }
        );
    },
    follower_list: function (request, callback) {
        // console.log(request);
        con.query(`SELECT uf.id,uf.user_id,uf.follow_id,u.full_name as following_name,u.profile_image as following_image,
                    CASE
                        WHEN TIMESTAMPDIFF(second,uf.created_at,now()) < 60 THEN concat(TIMESTAMPDIFF(second,uf.created_at,now()),' seconds ago')
                        WHEN TIMESTAMPDIFF(minute,uf.created_at,now()) < 60 THEN concat(TIMESTAMPDIFF(minute,uf.created_at,now()),' minutes ago')
                        WHEN TIMESTAMPDIFF(hour,uf.created_at,now()) < 24 THEN concat(TIMESTAMPDIFF(hour,uf.created_at,now()),' hours ago')
                        WHEN TIMESTAMPDIFF(day,uf.created_at,now()) < 31 THEN concat( TIMESTAMPDIFF(day,uf.created_at,now()),' days ago')
                        WHEN TIMESTAMPDIFF(month,uf.created_at,now()) < 13 THEN concat( TIMESTAMPDIFF(month,uf.created_at,now()),' months ago')
                    END as time_diffrence
                    FROM tbl_user_following uf
                    JOIN tbl_user u ON uf.user_id=u.id
                    WHERE uf.follow_id = ? AND uf.is_active=1 AND uf.is_delete=0 AND uf.status="accept"
                    ORDER BY uf.created_at DESC`, [request.follow_id], function (error, response) {
            if (!error) {
                callback("1", { keyword: "rest_keyword_success_message", content: {} }, response);
            } else {
                console.log("response", response);
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, error);
            }
        }
        );
    },
    user_request: function (request, callback) {
        // console.log(request);
        con.query(`SELECT uf.id,uf.user_id,uf.follow_id,uf.status,u.full_name,u.profile_image,
            CASE
                WHEN TIMESTAMPDIFF(second,uf.created_at,now()) < 60 THEN concat(TIMESTAMPDIFF(second,uf.created_at,now()),' seconds ago')
                WHEN TIMESTAMPDIFF(minute,uf.created_at,now()) < 60 THEN concat(TIMESTAMPDIFF(minute,uf.created_at,now()),' minutes ago')
                WHEN TIMESTAMPDIFF(hour,uf.created_at,now()) < 24 THEN concat(TIMESTAMPDIFF(hour,uf.created_at,now()),' hours ago')
                WHEN TIMESTAMPDIFF(day,uf.created_at,now()) < 31 THEN concat( TIMESTAMPDIFF(day,uf.created_at,now()),' days ago')
                WHEN TIMESTAMPDIFF(month,uf.created_at,now()) < 13 THEN concat( TIMESTAMPDIFF(month,uf.created_at,now()),' months ago')
            END as time_diffrence
            FROM tbl_user_following  uf
            JOIN tbl_user u ON uf.user_id=u.id
            WHERE uf.follow_id = ?
            AND uf.status="pending"
            ORDER BY uf.created_at DESC`, [request.user_id], function (error, response) {
            if (!error) {
                callback("1", { keyword: "rest_keyword_success_message", content: {} }, response);
            } else {
                console.log("response", response);
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, error);
            }
        }
        );
    },
    user_req_accept: function (request, callback) {
        // console.log(request);
        con.query("SELECT * FROM tbl_user_following WHERE is_active = '1' AND id = ? ", [request.request_id], function (error, result_data) {
            if (!error && result_data.length > 0) {
                con.query("UPDATE tbl_user_following SET status = 'accept' WHERE id = ?;", [request.request_id], function (err, result) {
                    if (!err) {
                        // callback("1", { keyword: 'rest_keyword_success_message', content: {} }, result);
                        user.get_user_details(result_data[0].user_id, function (user_data) {
                            // console.log(result[0].id)
                            // console.log(user_data)
                            if (user_data == null) {
                                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                            } else {
                                callback("1", { keyword: "rest_keyword_success_message", content: {} }, user_data);
                            }
                        })
                    } else {
                        callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
                    }
                })
            } else {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, error);
            }
        }
        );
    },
    user_req_cancel: function (request, callback) {
        // console.log(request);
        con.query("SELECT * FROM tbl_user_following WHERE is_active = '1' AND id = ? ", [request.request_id], function (error, result_data) {
            if (!error && result_data.length > 0) {
                con.query("DELETE FROM tbl_user_following WHERE id=?;", [request.request_id], function (err, result) {
                    if (!err) {
                        callback("1", { keyword: 'rest_keyword_success_message', content: {} }, result);
                    } else {
                        callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
                    }
                })
            } else {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, error);
            }
        }
        );
    },
    account_public: function (request, callback) {
        con.query("UPDATE tbl_user SET profile_type = 'public' WHERE id = ? ", request.user_id, function (err, result) {
            if (!err) {
                callback("1", { keyword: 'rest_keyword_success_message', content: {} }, result);
            } else {
                callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
            }
        })
    },
    account_private: function (request, callback) {
        con.query("UPDATE tbl_user SET profile_type = 'private' WHERE id = ? ", request.user_id, function (err, result) {
            if (!err) {
                callback("1", { keyword: 'rest_keyword_success_message', content: {} }, result);
            } else {
                callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
            }
        })
    },
    remove_follower: function (request, callback) {
        con.query("DELETE FROM tbl_user_following WHERE id=?;", [request.follower_id], function (err, result) {
            if (!err) {
                callback("1", { keyword: 'rest_keyword_success_message', content: {} }, result);
            } else {
                callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
            }
        })
    },
    remove_following: function (request, callback) {
        con.query("DELETE FROM tbl_user_following WHERE id=?;", [request.following_id], function (err, result) {
            if (!err) {
                callback("1", { keyword: 'rest_keyword_success_message', content: {} }, result);
            } else {
                callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
            }
        })
    },
    chat_page: function (request, callback) {
        con.query(`SELECT * FROM tbl_last_chat WHERE sender_id = ${request.sender_id} AND receiver_id = ${request.receiver_id}`, function (err, result) {
            if (!err & result.length > 0) {
                if (request.message == "" && request.message_image != "") {
                    var message = "📷 Photo";
                } else {
                    var message = request.message;
                }
                con.query("UPDATE tbl_last_chat SET message = ?,seen_unseen='unseen' WHERE (sender_id = ? AND receiver_id=?) OR (sender_id = ? AND receiver_id=?);", [message, request.sender_id, request.receiver_id, request.receiver_id, request.sender_id], function (err, update_result) {
                    if (!err) {
                        var value = {
                            sender_id: request.sender_id,
                            receiver_id: request.receiver_id,
                            // message: request.message,
                            message: (request.message != undefined) ? request.message : "",
                            message_image: (request.message_image != undefined) ? request.message_image : ""
                        };
                        con.query("INSERT INTO tbl_chat SET ? ", [value], function (err, response) {
                            if (!err) {
                                //   console.log("success",response)
                                let id = response.insertId
                                // console.log(id);
                                user.get_chat_details(id, function (user_data) {
                                    // console.log(user_data)
                                    if (user_data == null) {
                                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                                    } else {
                                        callback("1", { keyword: "rest_keyword_success_message", content: {} }, user_data);
                                    }
                                })
                            } else {
                                // console.log("err");
                                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                            }
                        });
                    } else {
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                    }
                })
            } else if (!err) {
                var value = {
                    // user_id:result[0].id,
                    sender_id: request.sender_id,
                    receiver_id: request.receiver_id,
                    message: request.message
                };
                con.query("INSERT INTO tbl_last_chat SET ? ", [value], function (err, result_data) {
                    if (!err) {
                        var value = {
                            // user_id:result[0].id,
                            sender_id: request.sender_id,
                            receiver_id: request.receiver_id,
                            message: request.message
                        };
                        con.query("INSERT INTO tbl_chat SET ? ", [value], function (err, response) {
                            if (!err) {
                                //   console.log("success",response)
                                let id = response.insertId
                                // console.log(id);
                                user.get_chat_details(id, function (user_data) {
                                    // console.log(user_data)
                                    if (user_data == null) {
                                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                                    } else {
                                        callback("1", { keyword: "rest_keyword_success_message", content: {} }, user_data);
                                    }
                                })
                            } else {
                                // console.log("err");
                                console.log(err);
                                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                            }
                        });
                    } else {
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                    }
                })
            } else {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
            }
        })
    },
    chat_history: function (request, callback) {

        con.query(`SELECT * FROM tbl_user WHERE id = ${request.receiver_id}`, function (err, result_data) {
            if (!err) {
                // console.log(request);
                con.query(`SELECT c.*, u.full_name, u.profile_image,
                CASE
                        WHEN TIMESTAMPDIFF(second, c.created_at, now()) < 60 THEN concat(TIMESTAMPDIFF(second, c.created_at, now()), ' seconds ago')
                        WHEN TIMESTAMPDIFF(minute, c.created_at, now()) < 60 THEN concat(TIMESTAMPDIFF(minute, c.created_at, now()), ' minutes ago')
                        WHEN TIMESTAMPDIFF(hour, c.created_at, now()) < 24 THEN concat(TIMESTAMPDIFF(hour, c.created_at, now()), ' hours ago')
                        WHEN TIMESTAMPDIFF(day, c.created_at, now()) < 31 THEN concat(TIMESTAMPDIFF(day, c.created_at, now()), ' days ago')
                    END as time_diffrence
                    FROM tbl_chat c
                    LEFT JOIN tbl_user u on c.sender_id = u.id
                    WHERE(c.sender_id = ${request.sender_id} OR c.sender_id = ${request.receiver_id}) AND(c.receiver_id = ${request.sender_id} OR c.receiver_id = ${request.receiver_id})`, function (err, result) {
                    // console.log(this.sql);
                    if (!err & result.length > 0) {
                        result_data[0].messages = result;
                        callback("1", { keyword: "rest_keyw ord_success_message", content: {} }, result_data);
                    } else if (!err) {
                        // console.log(result);
                        callback("1", { keyword: "rest_keyw ord_success_message", content: {} }, []);
                    } else {
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
                    }
                })
            } else {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
            }
        })
    },
    last_chat: function (request, callback) {
        // console.log(request.receiver_id);
        con.query(`SELECT c.*, u.full_name, u.profile_image,
                CASE
                        WHEN TIMESTAMPDIFF(second, c.created_at, now()) < 60 THEN concat(TIMESTAMPDIFF(second, c.created_at, now()), ' seconds ago')
                        WHEN TIMESTAMPDIFF(minute, c.created_at, now()) < 60 THEN concat(TIMESTAMPDIFF(minute, c.created_at, now()), ' minutes ago')
                        WHEN TIMESTAMPDIFF(hour, c.created_at, now()) < 24 THEN concat(TIMESTAMPDIFF(hour, c.created_at, now()), ' hours ago')
                        WHEN TIMESTAMPDIFF(day, c.created_at, now()) < 31 THEN concat(TIMESTAMPDIFF(day, c.created_at, now()), ' days ago')
                    END as time_diffrence
                    FROM tbl_chat c
                    LEFT JOIN tbl_user u on c.sender_id = u.id
                    WHERE c.receiver_id = ${request.sender_id} AND c.sender_id = ${request.receiver_id} AND c.id > ${request.last_message_id}
                    order by c.created_at desc`, function (err, result) {
            if (!err && result.length > 0) {
                callback("1", { keyword: "rest_keyw ord_success_message", content: {} }, result);
            } else if (!err) {
                callback("1", { keyword: "rest_keyw ord_success_message", content: {} }, null);
            } else {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, null);
            }
        })
    },
    // delete_message: function (request, callback) {
    //     con.query("SELECT * FROM tbl_chat WHERE id=?", [request.message_id], function (err, response) {
    //         if (!err && response.length > 0) {
    //             // callback("1", { keyword: 'rest_keyword_success_message', content: {} }, response);
    //             con.query("DELETE FROM tbl_chat WHERE id=?;", [request.message_id], function (err, result) {
    //                 if (!err) {
    //                     callback("1", { keyword: 'rest_keyword_success_message', content: {} }, result);
    //                 } else {
    //                     callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
    //                 }
    //             })
    //         } else {
    //             callback("0", { keyword: 'rest_keyword_content_error', content: {} }, err);
    //         }
    //     })
    // },

    delete_message: function (request, callback) {
        con.query("SELECT * FROM tbl_chat WHERE id=?", [request.message_id], function (err, response) {
            if (!err && response.length > 0) {
                con.query("SELECT * FROM tbl_chat WHERE (sender_id= " + response[0].sender_id + " AND receiver_id=" + response[0].receiver_id + ") OR (sender_id=" + response[0].receiver_id + " AND receiver_id=" + response[0].sender_id + ") ORDER BY id DESC LIMIT 2;", [request.message_id], function (err, res_data) {
                    if (!err && res_data.length > 0) {
                        if (res_data[0].id == request.message_id) {
                            if (res_data[1] != undefined) {
                                if (res_data[1].message == "" && res_data[1].message_image != "") {
                                    var message = "📷 Photo";
                                } else {
                                    var message = res_data[1].message;
                                }
                                con.query("UPDATE tbl_last_chat SET message = '" + message + "' WHERE (sender_id= " + response[0].sender_id + " AND receiver_id=" + response[0].receiver_id + ") OR (sender_id=" + response[0].receiver_id + " AND receiver_id=" + response[0].sender_id + ");", function (err, update_result) {

                                })
                            } else {
                                con.query("UPDATE tbl_last_chat SET message = '' WHERE (sender_id= " + response[0].sender_id + " AND receiver_id=" + response[0].receiver_id + ") OR (sender_id=" + response[0].receiver_id + " AND receiver_id=" + response[0].sender_id + ");", function (err, update_result) {

                                })
                            }
                        }
                        con.query("DELETE FROM tbl_chat WHERE id=?;", [request.message_id], function (err, result) {
                            if (!err) {
                                callback("1", { keyword: 'rest_keyword_success_message', content: {} }, result);
                            } else {
                                callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
                            }
                        })
                    } else {
                        console.log(err);
                        callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
                    }
                })
                // callback("1", { keyword: 'rest_keyword_success_message', content: {} }, response);

            } else {
                callback("0", { keyword: 'rest_keyword_content_error', content: {} }, err);
            }
        })
    },
    message_listing: function (token, callback) {
        con.query("SELECT u.id,u.profile_image,u.full_name FROM tbl_user u JOIN tbl_user_device_info ud ON u.id=ud.user_id WHERE ud.token = ? ", [token], function (err, result) {
            if (!err && result.length > 0) {
                con.query(`SELECT c.*,u.full_name,u.profile_image,
                CASE
                        WHEN TIMESTAMPDIFF(second,c.updated_at,now()) < 60 THEN concat(TIMESTAMPDIFF(second,c.updated_at,now()),' seconds ago')
                        WHEN TIMESTAMPDIFF(minute,c.updated_at,now()) < 60 THEN concat(TIMESTAMPDIFF(minute,c.updated_at,now()),' minutes ago')
                        WHEN TIMESTAMPDIFF(hour,c.updated_at,now()) < 24 THEN concat(TIMESTAMPDIFF(hour,c.updated_at,now()),' hours ago')
                        WHEN TIMESTAMPDIFF(day,c.updated_at,now()) < 31 THEN concat( TIMESTAMPDIFF(day,c.updated_at,now()),' days ago')
                        WHEN TIMESTAMPDIFF(month,c.updated_at,now()) < 13 THEN concat( TIMESTAMPDIFF(month,c.updated_at,now()),' months ago')
                    END as time_diffrence
                    FROM tbl_last_chat c JOIN tbl_user u ON c.receiver_id=u.id WHERE c.sender_id = ? ORDER BY c.updated_at DESC;`, [result[0].id], function (err, response) {
                    if (!err && response.length) {
                        console.log(response);
                        callback("1", { keyword: 'rest_keyword_success_message', content: {} }, response);
                    } else {
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
                    }
                })
            } else {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
            }
        })
    },
    seen_unseen_msg: function (request, token, callback) {
        con.query("SELECT u.id,u.profile_image,u.full_name FROM tbl_user u JOIN tbl_user_device_info ud ON u.id=ud.user_id WHERE ud.token = ? ", [token], function (err, result) {
            if (!err && result.length) {
                con.query("SELECT * FROM tbl_chat WHERE id=?", [request.message_id], function (err, response) {
                    if (request.receiver_id == "2") {
                        con.query(`UPDATE tbl_last_chat SET seen_unseen = "seen" WHERE (sender_id = ? AND receiver_id=?) OR (sender_id = ? AND receiver_id=?)`, [result[0].id, request.receiver_id, request.receiver_id, result[0].id], function (err, response) {
                            if (!err) {
                                callback("1", { keyword: 'rest_keyword_success_message', content: {} }, response);
                            } else {
                                callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
                            }
                        })
                    } else {
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
                    }
                })
            } else {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
            }
        })
    },
    block_user: function (request, token, callback) {
        con.query("SELECT u.id,u.profile_image,u.full_name FROM tbl_user u JOIN tbl_user_device_info ud ON u.id=ud.user_id WHERE ud.token = ? ", [token], function (err, result) {
            if (!err && result.length) {
                con.query("SELECT * FROM tbl_block_user WHERE blocked_from=? AND blocked_to=?", [result[0].id, request.block_id], function (err, response) {
                    if (!err && response.length) {
                        con.query("DELETE FROM tbl_block_user WHERE id=?;", [response[0].id], function (err, response_data) {
                            if (!err) {
                                callback("1", { keyword: 'rest_keyword_success_message', content: {} }, response_data);
                            } else {
                                callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err);
                            }
                        })
                    } else if (err) {
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
                    } else {
                        var value = {
                            blocked_from: result[0].id,
                            blocked_to: request.block_id
                        };
                        con.query("INSERT INTO tbl_block_user SET ? ", [value], function (err, response_data) {
                            if (!err) {
                                callback("1", { keyword: 'rest_keyword_success_message', content: {} }, response_data);
                            } else {
                                callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
                            }
                        })
                    }
                })
            } else {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
            }
        })
    },
    block_data: function (request, token, callback) {
        con.query("SELECT u.id,u.profile_image,u.full_name FROM tbl_user u JOIN tbl_user_device_info ud ON u.id=ud.user_id WHERE ud.token = ? ", [token], function (err, result) {
            if (!err && result.length) {
                con.query("SELECT * FROM tbl_block_user WHERE (blocked_from=? AND blocked_to=?) OR (blocked_from=? AND blocked_to=?)", [result[0].id, request.block_id, request.block_id, result[0].id], function (err, response) {
                    if (!err && response.length) {
                        callback("1", { keyword: 'rest_keyword_success_message', content: {} }, response);
                    } else {
                        callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
                    }
                })
            } else {
                callback("0", { keyword: "rest_keyword_error_message", content: {} }, err);
            }
        })
    },
}

module.exports = user;

