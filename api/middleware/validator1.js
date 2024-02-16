const newLocal = "Validator";
var Validator = require(newLocal);
const {default: localizify} = require('localizify');
var en = require('../language/en');
var gj = require('../language/gj');
const { t } = require('localizify');
var con = require("../config/database");

var cryptoLib=require("cryptlib");
var shakey=cryptoLib.getHashSha256(process.env.KEY,32);

var bypassMethod=new Array("validateuser","signup","login","forgetpass","confirm_otp")
var middleware={
    checkValidatorRule: function (res, request, rules, message) {
        const v = Validator.make(request, rules, message);
        if (v.fails()) {
            console.log("if");
            const errors = v.getErrors();
            for (var key in errors) {
                var error = errors[key][0];
                break;
            }
            let response_data = {
                code: "0",
                message: error,
            };
            // middleware.encryption(response_data,function(response){
                res.status(200).send(response_data);
            // });
            return false;
        } else {
            console.log("validation successfully complete");
            return true;
        }
    },
    send_response:function(req,res,code,message,data){
        this.getMessage(req.lang, message, function(translated_message){
        if (data==null) {
            response_data={
                code:code,
                message:translated_message
                }
                // middleware.encryption(response_data,function(response){
                    res.status(200).send(response_data);
                // })
        }else{
            response_data={
                code:code,
                message:translated_message,
                data:data
                }
                // middleware.encryption(response_data,function(response){
                    res.status(200).send(response_data);
                // })
        }
    })
    },
    getMessage: function(language, message, callback){
        localizify
        .add('en', en)
        .add('gj', gj)
        .setLocale(language);
        callback(t(message.keyword, message.content));

    },
    extractHeaderLanguage: function (req, res, callback) {
        var headerlang = (req.headers['accept-language'] !=undefined && req.headers['accept-language'] !="") ? req.headers
        ['accept-language'] : 'en';
        console.log(headerlang);
        req.lang = headerlang;
        req.language = (headerlang == 'en') ? en : gj;

        localizify
             .add('en', en)
             .add('gj', gj)
             .setLocale(headerlang);

        callback();
    },
    
    validateApiKey:function(req,res,callback){
        var api_key=(req.headers["api-key"] !=undefined && req.headers["api-key"] != "") ? req.headers["api-key"] :'';   
        if (api_key != "") {
            try {
                var dec_apikey=cryptoLib.decrypt(api_key,shakey,process.env.IV)
                // console.log("a",dec_apikey);
                // console.log("b",process.env.API_KEY);
                if (dec_apikey != "" && dec_apikey==process.env.API_KEY) {
                    callback();
                } else {
                    response_data={
                        code:"0",
                        message:"Invalid API Key"
                    }
                    // middleware.encryption(response_data,function(response){
                        res.status(200).send(response_data);
                    // })
                } 
            } catch (error) {
                response_data={
                    code:"0",
                    message:"Invalid API Key"
                }
                // middleware.encryption(response_data,function(response){
                    res.status(401).send(response_data);
                // })
            }

            // callback();
        } else {
            response_data={
                code:"0",
                message:"Invalid API Key"
            }
            // middleware.encryption(response_data,function(response){
                res.status(401).send(response_data);
            // })
        } 
    },
    
    validateHeaderToken:function(req,res,callback){
        var headertoken=(req.headers["token"] !=undefined && req.headers["token"] != "") ? req.headers["token"] :'';   

        // console.log("req.path: ",req.path);
        var path_data=req.path.split("/")
        // console.log("path_data: ",path_data[4]);
        if (bypassMethod.indexOf(path_data[4]) === -1 ) {  // return -1 value when koi pan index ma value nai male
            if (headertoken != "" ) {
                try {

                    var dec_token=cryptoLib.decrypt(headertoken,shakey,process.env.IV)

                    if (dec_token != "") {
                        con.query("SELECT * FROM tbl_user_device_info where token= ? ",[dec_token],function(err,result){
                            if (!err && result.length>0) {
                                req.user_id=result[0].user_id
                                callback();
                            } else {
                                response_data={
                                    code:"0",
                                    message:"Invalid Token"
                                }
                                // middleware.encryption(response_data,function(response){
                                    res.status(401).send(response_data);
                                // })
                            }
                        })
                    } else {
                        response_data={
                                    code:"0",
                                    message:"Invalid Token"
                                }
                                // middleware.encryption(response_data,function(response){
                                    res.status(401).send(response_data);
                                // })
                    }
                   
                } catch (error) {
                    response_data={
                        code:"0",
                        message:"Invalid Token"
                    }
                    // middleware.encryption(response_data,function(response){
                        res.status(401).send(response_data);
                    // })
                }
                
            } else {
                response_data={
                    code:"0",
                    message:"Invalid Token"
                    }
                    // middleware.encryption(response_data,function(response){
                        res.status(401).send(response_data);
                    // })
            } 
        } else {
            callback();
        }

    },
    decryption:function(encrypted_text,callback){
        console.log(encrypted_text)
        if (encrypted_text != undefined && Object.keys(encrypted_text).length !== 0) {
            try {
                var request=JSON.parse(cryptoLib.decrypt(encrypted_text,shakey,process.env.IV));
                callback(request);
            } catch (error) {
                console.log("catch")
                callback({});
            }
        } else {
            console.log("else")
            callback({});            
        }
    },
    encryption:function(response_data,callback){
        var response=cryptoLib.encrypt(JSON.stringify(response_data),shakey,process.env.IV);
        callback(response);
    },
    // decrypted_token:function(token,callback){
    //     var token=req.headers.token;
    //     var dec_token=JSON.parse(cryptoLib.decrypt(encrypted_text,shakey,process.env.IV));
    //     callback(dec_token)
    // },
    decrypted_token:function(token,callback){
        // console.log("fun",token)
        if (token != undefined && Object.keys(token).length !== 0) {
            try {
                var dec_token=JSON.parse(cryptoLib.decrypt(token,shakey,process.env.IV));
                console.log("aaa",dec_token)
                callback(dec_token);
            } catch (error) {
                console.log("catch")
                callback({});
            }
        } else {
            console.log("else")
            callback({});            
        }
    },
}
module.exports=middleware;