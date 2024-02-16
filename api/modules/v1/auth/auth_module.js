var con = require("../../../config/database");
var asyncLoop = require('node-async-loop');
var GLOBALS = require('../../../config/constant');
var common = require('../../../config/common');
const { query } = require("express");
var cryptoLib = require("cryptlib");
var shakey = cryptoLib.getHashSha256(process.env.KEY, 32);
var auth = {
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
    signup: function (request, callback) {
        auth.checkemailuse(request, function (emailuse) {
            // console.log(emailuse)
            if (emailuse) {
                callback("0", { keyword: 'rest_keywords_unique_email_error', content: {} }, null)
            } else {
                auth.checkeMoblieUse(request, function (mobileuse) {
                    if (mobileuse) {
                        callback("0", { keyword: 'rest_keywords_unique_mobile_error', content: {} }, null)
                    } else {
                        var pass = cryptoLib.encrypt(request.password, shakey, process.env.IV);
                        var value = {
                            full_name: request.full_name,
                            profile_image: (request.profile_image != undefined) ? request.profile_image : "default.jpg",
                            email: request.email,
                            study: (request.study != undefined) ? request.study : "",
                            office_phone_no: request.office_phone_no,
                            mobile_number: request.mobile_number,
                            password: pass,
                            organization: request.organization,
                            office_city: request.office_city,
                            office_state: request.office_state,
                            office_address: request.office_address,
                            profile_type: (request.profile_type != undefined) ? request.profile_type : "public"
                        };
                        con.query("INSERT INTO tbl_user SET ?", [value], function (err, result) {
                            if (!err) {
                                var id = result.insertId;
                                // var mobile = result.mobile;
                                auth.get_user_details(id, function (user_detail) {
                                    if (user_detail == null) {
                                        callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err)
                                    } else {
                                        common.checkUpdateToken(id, request, function (token) {
                                            user_detail.token = token;
                                            auth.get_user_details(id, function (user_detail) {
                                                if (user_detail == null) {
                                                    callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err)
                                                } else {
                                                    callback("1", { keyword: 'rest_keyword_success_message', content: {} }, user_detail)
                                                }
                                            })
                                        });
                                    }
                                });
                            } else {
                                console.log("in else part", err);
                                callback('0', { keyword: 'rest_keyword_error_message', content: {} },);
                            }
                        });
                    }
                })
            }
        })

    },
    login: function (request, callback) {
        var pass = cryptoLib.encrypt(request.password, shakey, process.env.IV);
        // console.log(pass);
        // console.log(request.email);
        if (request.email != "" && request.email != undefined) {
            sql = "SELECT * FROM tbl_user WHERE email='" + request.email + "' AND password='" + pass + "' "
        }
        else {
            sql = "SELECT * FROM tbl_user WHERE mobile_number ='" + request.mobile_number + "' AND password='" + request.password + "' "
        }
        con.query(sql, function (err, result) {
            if (!err && result.length > 0) {
                let id = result[0].id
                auth.get_user_details(id, function (user_detail) {
                    if (user_detail == null) {
                        callback("0", { keyword: 'rest_keyword_error_message', content: {} }, err)
                    } else {
                        common.checkUpdateToken(id, request, function (token) {
                            user_detail.token = token;
                            callback(user_detail);
                        });
                    }
                });
            } else {
                callback(err);
            }
        })
    },
    validateUser: function (request, callback) {
        auth.checkemailuse(request, function (emailuse) {
            if (emailuse) {
                callback('0', { keyword: 'email is already used', content: {} }, {})
            } else {

                var otp_code = common.randomOtpGenrator();
                var sms = common.sendsms();
                if (sms) {
                    console.log("Success semding SMS!!!!!");
                } else {
                    console.log("Error in d=sending SMS!!!!!");
                }

                common.sendEmail(request.email, "OTP Verification", "<p>your otp was" + otp_code + "</p>", function (issent) {
                    if (issent) {
                        console.log("success")
                        // con.query("INSERT INTO tbl_verification_otp")
                        callback('1', { keyword: 'rest_keyword_sucess_on_validation', content: {} }, { otp_code: otp_code });

                    } else {
                        callback('0', { keyword: 'rest_keyword_error_message', content: {} }, null);
                    }
                })
            }
        })
    },
    checkemailuse: function (request, callback) {
        con.query("SELECT * FROM tbl_user where email= ? AND is_active='1' AND is_delete='0' ", [request.email], function (err, result) {
            if (!err && result.length > 0) {
                callback(true);
            } else {
                console.log("given email was unique")
                callback(false);
            }
        })
    },
    checkeMoblieUse: function (request, callback) {
        con.query("SELECT * FROM tbl_user where mobile_number = ? AND is_active='1' AND is_delete='0' ", [request.mobile_number], function (err, result) {
            if (!err && result.length > 0) {
                callback(true);
            } else {
                callback(false);
            }
        })
    },
    // logout: function (request, token, callback) {
    //     auth.get_user_details(request.user_id, function (user_data) {
    //         var upddata = {
    //             token: "",
    //             device_token: ""
    //         }
    //         con.query("SELECT u.id FROM tbl_user u JOIN tbl_user_device_info ud ON u.id=ud.user_id WHERE ud.token = ?", [token], function (err, result) {
    //             if (!err && result.length > 0) {
    //                 con.query("UPDATE tbl_user_device_info SET ? WHERE user_id=? ", [upddata, result[0].id], function (err, response) {
    //                     if (!err) {
    //                         auth.get_user_details(result[0].id, function (user_data) {
    //                             console.log("result", user_data)
    //                             if (user_data == null) {
    //                                 callback("0", { keyword: 'rest_keyword_error_message', content: {} }, null)
    //                             } else {
    //                                 callback("1", { keyword: 'rest_keyword_success_on_logout', content: {} }, user_data)
    //                             }
    //                         })
    //                     } else {
    //                         console.log(err)
    //                         callback("0", { keyword: 'rest_keyword_error_message', content: {} }, null)
    //                     }
    //                 })
    //             } else {
    //                 callback("0", { keyword: 'rest_keyword_error_message', content: {} }, null)
    //             }
    //         })
    //     })
    // },
    logout: function (request, callback) {
        auth.get_user_details(request.user_id, function (user_data) {

            var upddata = {
                token: "",
                device_token: ""
            }
            con.query("UPDATE tbl_user_device_info SET ? WHERE user_id=? ", [upddata, request.user_id], function (err, result) {
                if (!err) {
                    callback("1", { keyword: 'rest_keyword_success_on_logout', content: {} }, result)
                } else {
                    console.log(err)
                    callback("0", { keyword: 'rest_keyword_error_message', content: {} }, null)
                }
            })

        })
    },
    forgotPassword: function (request, callback) {
        const sql = 'SELECT * FROM tbl_user WHERE email = ?';
        con.query(sql, [request.email], function (err, result) {
            if (!err && result.length > 0) {
                var user_id = result[0].id;
                // console.log("user id:", user_id);

                auth.generateToken(user_id, function (token) {
                    // console.log("token", token);

                    var resetLink = GLOBALS.BASE + `${token}`;

                    if (token == null) {
                        callback('0', { keyword: 'null token token already exist in database', content: {} }, null)
                    } else {
                        console.log("resetLink", resetLink);
                        console.log("request", request);
                        require('../../../config/template').resetPasswordEmail(request, result, resetLink, function (resetPassswordEmailTemplate) {
                            // console.log("request:", request);
                            // console.log("result:", result);
                            common.sendEmail(request.email, "Reset Your Password", resetPassswordEmailTemplate, function (isSent) {

                                console.log(isSent);
                                if (isSent) {
                                    callback('1', { keyword: 'Success! Email Sent.', content: {} }, null);
                                } else {
                                    callback('0', { keyword: 'Failed to Send Email.', content: {} }, null);
                                }
                            })
                        })
                    }
                })
            } else {
                callback('0', { keyword: 'Sorry Email Not Matched with db, you can create a new account with this email.', content: {} }, err);
            }
        })
    },
    generateToken: function (user_id, callback) {
        var randtoken = require('rand-token').generator();
        var token = randtoken.generate(64, "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789");
        var insertObject = {
            forgotpassword_token: token,
        };

        con.query("SELECT * FROM tbl_user WHERE id = ?", [user_id], function (err, result) {
            if (err) {
                console.log("Error in retrieving user from database");
                callback(null);
            } else if (result && result.length > 0 && result[0].forgotpassword_token) {
                console.log("There is already an unused token in the database. You cannot generate a new token.");
                callback(null);
            } else {
                console.log(insertObject, user_id)
                con.query("UPDATE tbl_user SET ? WHERE id=?", [insertObject, user_id], function (err, result) {
                    if (err) {
                        console.log("Error in updating token in database");
                        callback(err);
                    } else {
                        console.log("Token Updated Successfully");
                        callback(token);
                    }
                });
            }
        });
    },
}

module.exports = auth;

