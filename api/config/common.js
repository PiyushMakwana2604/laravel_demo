var nodemailer = require("nodemailer");
var twilio = require('twilio');
var con = require('../config/database');
const messages = require("../language/en");
const http = require('http').createServer(app);
const io = require('socket.io')(http);

var common = {

    sendEmail: function (to_email, subject, message, callback) {
        var transpoter = nodemailer.createTransport({
            host: "smtp.gmail.com",
            port: 587,
            secure: false,
            requireTLS: true,
            auth: {
                user: process.env.EMAIL_ID,
                pass: process.env.EMAIL_PASSWORD
            }
        });
        var mailDetails = {
            from: process.env.EMAIL_ID,
            to: to_email,
            subject: subject,
            html: message
        };

        transpoter.sendMail(mailDetails, function (err, data) {
            if (err) {
                console.log(err);
                callback(false);
            } else {
                console.log('Email sent successfully', data.response);
                callback(true);
            }
        });
    },

    checkUpdateToken: function (user_id, request, callback) {
        var randtoken = require('rand-token').generator();
        var usersession = randtoken.generate(64, "0123456789abcdefghi jkInmopqrstuvwxyz");

        con.query("SELECT * FROM tbl_user_device_info WHERE user_id=?", [user_id], function (err, result) {
            if (!err && result.length > 0) {
                // Update
                var deviceparams = {
                    device_type: (request.device_type != undefined) ? request.device_type : "A",
                    device_token: (request.device_token != undefined) ? request.device_token : "0",
                    token: usersession
                }
                con.query("UPDATE tbl_user_device_info SET ? WHERE user_id= ?", [deviceparams, user_id], function (err, result) {
                    callback(usersession);
                })
            } else {
                // Insert
                var deviceparams = {
                    device_type: (request.device_type != undefined) ? request.device_type : "A",
                    device_token: (request.device_token != undefined) ? request.device_token : "0",
                    token: usersession,
                    user_id: user_id
                }
                con.query("INSERT INTO tbl_user_device_info SET ?", [deviceparams], function (err, result) {
                    callback(usersession);
                })
            }
        })
    },

    sendsms: function () {
        const client = new twilio(process.env.TWILIO_SID, process.env.TWILIO_AUTH_TOKEN)

        return client.messages
            .create({ body: 'hey buddy my first sms :how is itttttttttttttt?', from: process.env.PHONE_NUMBER, to: '+917874861880' })
            .then(message => { console.log(message) })
            .catch(err => { console.log(err) })

    },

    randomOtpGenrator: function () {
        return Math.floor(1000 + Math.random() * 9000)
        // return "1234";
    },
    sendMessageUsingServer: function (message) {
        // console.log('Received message:', message);
        io.on('connection', (socket) => {
            console.log('A user connected');

            // Handle the "chat message" event
            socket.on('chat message', (message) => {
                console.log('Received message:', message);

                // Broadcast the message to all connected clients
                io.emit('chat message', message);
            });

            // Handle disconnections
            socket.on('disconnect', () => {
                console.log('A user disconnected');
            });
        });
    }

}

module.exports = common;