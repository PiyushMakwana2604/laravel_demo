var express = require("express");
// var multer= require("multer");
var path = require("path");
var auth_model = require("./auth_module");
var middleware = require("../../../middleware/validator");
// var middleware = require("../../../middleware/validator1");
var router = express.Router();
// var nodemailer = require("nodemailer");
const { request } = require("http");
const con = require("../../../config/database");
// const con = require("../../../config/database");

var cryptoLib = require("cryptlib");
var shakey = cryptoLib.getHashSha256(process.env.KEY, 32);

router.post("/signup", function (req, res) {
    middleware.decryption(req.body, function (request) {
        // console.log("reqewgoiewjgjgolqjg");
        // var request=req.body;
        var rules = {
            full_name: "required",
            email: "required|email",
            study: "required",
            office_phone_no: "required",
            mobile_number: "required",
            password: "required",
            organization: "required",
            office_city: "required",
            office_state: "required",
            office_address: "required",
        }

        var message = {
            required: "please enter :attr",
            email: "Please enter Valid email"
        }
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            auth_model.signup(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            })
        }
    })
});
router.post("/login", function (req, res) {
    middleware.decryption(req.body, function (request) {
        // var request = req.body;

        var rules = {
            email: "required",
            password: "required",
        };
        var message = {
            required: "Bro please enter :attr",
        };

        if (middleware.checkValidatorRule(res, request, rules, message)) {
            auth_model.login(request, function (user_data) {
                if (user_data == null) {
                    middleware.send_response(req, res, "0", { keyword: 'Please Enter Valid Email or Password', content: {} }, null);
                } else {
                    middleware.send_response(req, res, "1", { keyword: 'rest_keyword_success_message', content: {} }, user_data);
                }
            });
        }
    })
});
router.post("/validateuser", function (req, res) {
    middleware.decryption(req.body, function (request) {
        // var request=req.body;
        // console.log(request)
        var rules = {
            email: "required|email"
        }

        var message = {
            required: "please enter :attr",
            email: "please enter valid email"
        }
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            auth_model.validateUser(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            })
        }
    })
});
router.post("/logout", function (req, res) {
    // var request = req.body
    middleware.decryption(req.body, function (request) {
        // console.log("req", request)
        var rules = {
            user_id: "required"
        }

        var message = {
            required: "please enter :attr"
        }
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            auth_model.logout(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            })
        }
    })
});
router.post('/forgotpassword', function (req, res) {
    middleware.decryption(req.body, function (request) {

        // var request = req.body;
        var rules = {
            email: 'required|email'
        }
        var message = {
            required: req.language.required,
            email: req.language.email
        }
        if (middleware.checkValidatorRule(res, request, rules, message)) {
            auth_model.forgotPassword(request, function (code, message, data) {
                middleware.send_response(req, res, code, message, data);
            })
        }
    })
})
router.get('/forgotpassword/:token', function (req, res) {
    var token = req.params.token;
    con.query("SELECT * FROM tbl_user WHERE forgotpassword_token = ?", [token], function (err, result) {
        // console.log(err);
        if (!err && result.length > 0) {
            // if token exists render reset password form
            // console.log("test");
            res.render('editform.ejs', { token: token });
        } else {
            res.send('Sorry, the link is invalid or has expired.');
        }
    });
});
router.post('/resetpassword', function (req, res) {
    // console.log("finnaly got this ii")
    var token = req.body.token;
    var password = req.body.password;
    con.query("SELECT id, forgotpassword_token FROM tbl_user WHERE forgotpassword_token = ?", [token], function (err, result) {
        if (!err && result.length > 0) {
            var userId = result[0].id;
            // console.log("result", result[0]);
            var pass = cryptoLib.encrypt(password, shakey, process.env.IV);
            con.query("UPDATE tbl_user SET password = ? WHERE id = ?", [pass, userId], function (err, result) {
                if (!err) {

                    con.query("UPDATE tbl_user SET forgotpassword_token = '' WHERE forgotpassword_token = ?", [token], function (err, result) {
                        if (!err) {
                            res.send('Password has been reset successfully.');
                        } else {
                            res.send('Failed to delete reset token from database.');
                        }
                    });
                } else {
                    res.send('Failed to update password in database.');
                }
            });
        } else {
            res.send('Sorry, the link is invalid or has expired.');
        }
    });
});

module.exports = router;