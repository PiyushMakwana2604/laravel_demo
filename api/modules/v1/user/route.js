var express = require("express");
var multer = require("multer");
var path = require("path");
var user_model = require("./user_module");
var middleware = require("../../../middleware/validator");
// var middleware = require("../../../middleware/validator1");
var router = express.Router();
var nodemailer = require("nodemailer");
const { request } = require("http");
const con = require("../../../config/database");

var cryptoLib = require("cryptlib");
var shakey = cryptoLib.getHashSha256(process.env.KEY, 32);

router.post("/upload_image", function (req, res) {
    const storage = multer.diskStorage({
        destination: function (req, file, cb) {
            cb(null, '../api/public/post_img/')
        },
        filename: function (req, file, cb) {
            //   const uniqueSuffix = Date.now() + '-' + Math.round(Math.random() * 1E9)
            //   cb(null, file.fieldname + '-' + uniqueSuffix)
            // console.log(Date.now(),path.extname(file.originalname));
            cb(null, Date.now() + path.extname(file.originalname))
        }
    });
    const updimg = multer({
        storage: storage,
        limits: {
            fileSize: (4 * 1024 * 1024)
        }
    }).single("post_img");
    // var updmultiimage=updimg.fields([
    //     {
    //         name:'food_image',
    //         maxCount:3
    //     }
    // ]);
    updimg(req, res, function (err) {
        if (err) {
            middleware.send_response(req, res, "0", { keyword: 'rest_keyword_error_message', content: {} }, null);
        } else {
            // {image:req.file.filename}
            // console.log(req.files.restaurant_img)
            // req.files.restaurant_img.forEach(element => {
            //     console.log(element);
            // });
            middleware.send_response(req, res, "1", { keyword: 'rest_keyword_successfully_add_image', content: {} }, { image: req.file.filename });
        }
    })
});
router.post("/homescreen_feed", function (req, res) {
    middleware.decryption(req.body, function (request) {
        // console.log("request", request);
        var token = req.headers.token
        var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // console.log("de", dec_token);
        // var request = req.body;
        user_model.homescreen_feed(request, dec_token, function (code, message, data) {
            middleware.send_response(req, res, code, message, data);
        });
    })
});
router.post("/add_comment", function (req, res) {
    middleware.decryption(req.body, function (request) {
        // var token = req.headers.token
        // var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        var rules = {
            user_id: "required",
            post_id: "required",
            comment: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.add_comment(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/add_like", function (req, res) {
    middleware.decryption(req.body, function (request) {
        // var token = req.headers.token
        // var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        // console.log(request);
        var rules = {
            post_id: "required",
            user_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.add_like(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/comments_feed", function (req, res) {
    middleware.decryption(req.body, function (request) {
        // var token = req.headers.token
        // var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        var rules = {
            post_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.comments_feed(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/create_event", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var token = req.headers.token
        var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        var rules = {
            event_image: "required",
            event_name: "required",
            event_location: "required",
            date: "required",
            time: "required",
            description: "required",
            members_price: "required",
            non_members_price: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.create_event(request, dec_token, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/create_post", function (req, res) {
    middleware.decryption(req.body, function (request) {
        // var token = req.headers.token
        // var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        // console.log(request);
        var rules = {
            user_id: "required",
            post_image: "required",
            description: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.create_post(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/event_homescreen", function (req, res) {
    middleware.decryption(req.body, function (request) {
        // var request = req.body;
        // console.log(request);
        var rules = {
            start_date: "required",
            end_date: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.event_homescreen(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/all_event", function (req, res) {
    // middleware.decryption(req.body, function (request) {
    var request = req.body;
    // console.log(request);
    // var rules = {
    //     start_date: "required",
    //     end_date: "required"
    // };
    // var message = {
    //     required: "please enter :attr"
    // };
    // if (middleware.checkValidatorRule(res, request, rules, message)) {
    user_model.all_event(request, function (code, message, data) {
        middleware.send_response(req, res, code, message, data);
    });
    // }
    // })
});
router.post("/event_details", function (req, res) {
    middleware.decryption(req.body, function (request) {
        // var request = req.body;
        var rules = {
            event_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.event_details(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/my_profile", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            user_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        // var token = req.headers.token
        // var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        if (middleware.checkValidatorRule(res, request, rules, message)) {

            user_model.my_profile(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/my_profile_post", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            user_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        //     var token = req.headers.token
        //     var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.my_profile_post(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/contact_us", function (req, res) {
    middleware.decryption(req.body, function (request) {
        // var request = req.body;
        // console.log(request);
        var rules = {
            title: "required",
            email: "required",
            message: "required",
        };
        var message = {
            required: "please enter :attr",
            email: "please enter valid email id"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.contact_us(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/faqs_page", function (req, res) {
    middleware.decryption(req.body, function (request) {
        // var request = req.body;
        var parmas = req.query;
        console.log("request", request)
        // console.log("request", parmas)
        user_model.faqs(request, parmas, function (code, message, data) {
            middleware.send_response(req, res, code, message, data);
        });
    })
});
router.post("/delete_post", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            post_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        //     var token = req.headers.token
        //     var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.delete_post(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/delete_comment", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            comment_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        //     var token = req.headers.token
        //     var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.delete_comment(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/update_user", function (req, res) {
    middleware.decryption(req.body, function (request) {
        // var request = req.body;
        // console.log(request);
        var rules = {
            user_id: "required",
            full_name: "required",
            email: "required",
            study: "required",
            office_phone_no: "required",
            mobile_number: "required",
            office_city: "required",
            office_state: "required",
            office_address: "required"
        };
        var message = {
            required: "please enter :attr",
            email: "please enter valid email id"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.update_user(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/follow_user", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            user_id: "required",
            follow_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.follow_user(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/follow", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            user_id: "required",
            follow_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        //     var token = req.headers.token
        //     var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.follow(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/following_count", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            user_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        //     var token = req.headers.token
        //     var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.following_count(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/follower_count", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            follow_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        //     var token = req.headers.token
        //     var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.follower_count(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/following_list", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            user_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        //     var token = req.headers.token
        //     var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.following_list(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/follower_list", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            follow_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        //     var token = req.headers.token
        //     var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.follower_list(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/user_request", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            user_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        //     var token = req.headers.token
        //     var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.user_request(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/user_req_accept", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            request_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        //     var token = req.headers.token
        //     var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.user_req_accept(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/user_req_cancel", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            request_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        //     var token = req.headers.token
        //     var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.user_req_cancel(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/account_public", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            user_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.account_public(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/account_private", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            user_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.account_private(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/remove_follower", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            follower_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.remove_follower(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/remove_following", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            following_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.remove_following(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/chat_page", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            sender_id: "required",
            receiver_id: "required",
            message: "required_without:message_image", // "message" is required if "message_image" is not present
            message_image: "required_without:message"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.chat_page(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/chat_history", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            sender_id: "required",
            receiver_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.chat_history(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/last_chat", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            sender_id: "required",
            receiver_id: "required",
            last_message_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.last_chat(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/delete_message", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            message_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        //     var token = req.headers.token
        //     var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        // var request = req.body;
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.delete_message(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/message_listing", function (req, res) {
    var token = req.headers.token
    var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
    user_model.message_listing(dec_token, function (code, message, data) {
        middleware.send_response(req, res, code, message, data);
    });
});

router.post("/seen_unseen_msg", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            message_id: "required",
            receiver_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        var token = req.headers.token
        var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.seen_unseen_msg(request, dec_token, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/block_user", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            block_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        var token = req.headers.token
        var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.block_user(request, dec_token, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
router.post("/block_data", function (req, res) {
    middleware.decryption(req.body, function (request) {
        var rules = {
            block_id: "required"
        };
        var message = {
            required: "please enter :attr"
        };
        var token = req.headers.token
        var dec_token = cryptoLib.decrypt(token, shakey, process.env.IV)
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            user_model.block_data(request, dec_token, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            });
        }
    })
});
module.exports = router;

