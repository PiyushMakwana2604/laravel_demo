var con = require('../../../config/database');
var GLOBALS = require('../../../config/constant');

var API = {

    /**
     * Function to get api users list
     * 04-06-2021
     * @param {Function} callback 
     */
    apiuserList: function (callback) {

        con.query("SELECT u.id,udi.token,udi.device_type,u.name,u.email,u.password,u.profile_img,u.login_type,udi.device_token,udi.created_at FROM tbl_user u JOIN tbl_user_device_info udi ON u.id=udi.user_id", function (err, result, fields) {
            if (!err) {
                callback(result);
            } else {
                callback(null, err);
            }
        });
    },
}

module.exports = API;