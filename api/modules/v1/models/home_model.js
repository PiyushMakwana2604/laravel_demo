const dbConn = require("../../../config/database");
const common = require("../../../config/common");
const lang = require("../../../config/language");
const emailTemplate = require("../../../config/template")
const logger = require("../../../logger");
const Codes = require("../../../config/status_codes");

var home_model = {

    //function for Register user
    async our_team(req, res) {
        try {
            let sql = `SElECT * FROM tbl_team Where is_active = "1"`;
            const [result, fields] = await dbConn.query(sql);
            console.log(result.length);
            if (result.length <= 0) {
                return await common.sendResponse(res, Codes.NOT_FOUND, lang[req.language]['text_home_unavailable_data'], null);
            }
            return await common.sendResponse(res, Codes.SUCCESS, lang[req.language]['text_home_people_poll_listing_succ'], result)
        }
        catch (error) {
            logger.error(error)
            return await common.sendResponse(res, Codes.INTERNAL_ERROR, lang[req.language]['text_user_something_wrong'], null);
        }
    },

    async team_details(req, res) {
        try {
            // console.log(req);
            let sql = `SElECT * FROM tbl_team Where is_active = "1" AND id = ${req.team_id} `;
            console.log(sql);
            const [result, fields] = await dbConn.query(sql);
            console.log(result.length);
            if (result.length <= 0) {
                return await common.sendResponse(res, Codes.NOT_FOUND, lang[req.language]['text_home_unavailable_data'], null);
            }
            return await common.sendResponse(res, Codes.SUCCESS, lang[req.language]['text_home_people_poll_listing_succ'], result)
        }
        catch (error) {
            logger.error(error)
            return await common.sendResponse(res, Codes.INTERNAL_ERROR, lang[req.language]['text_user_something_wrong'], null);
        }
    },

    async contact_us(req, res) {
        try {
            let postdata = {
                "first_name": req.first_name,
                "last_name": req.last_name,
                "email": req.email,
                "comment": req.comment
            }
            const [rows, field] = await dbConn.query(`INSERT INTO tbl_contact_us SET ?`, postdata);
            if (rows.affectedRows == 0) {
                return await common.sendResponse(res, Codes.NOT_FOUND, lang[req.language]['text_home_contactus_error'], null);
            }
            return await common.sendResponse(res, Codes.SUCCESS, lang[req.language]['text_home_contactus_succ'], null)
        }
        catch (error) {
            logger.error(error)
            return await common.sendResponse(res, Codes.INTERNAL_ERROR, lang[req.language]['text_user_something_wrong'], error);
        }
    },

    async services(req, res) {
        try {
            let sql = `SElECT * FROM tbl_services Where is_active = "1"`;
            const [result, fields] = await dbConn.query(sql);
            console.log(result.length);
            if (result.length <= 0) {
                return await common.sendResponse(res, Codes.NOT_FOUND, lang[req.language]['text_home_unavailable_data'], null);
            }
            return await common.sendResponse(res, Codes.SUCCESS, lang[req.language]['text_home_service_succ'], result)
        }
        catch (error) {
            logger.error(error)
            return await common.sendResponse(res, Codes.INTERNAL_ERROR, lang[req.language]['text_user_something_wrong'], null);
        }
    },

    async about_us(req, res) {
        try {
            let sql = `SElECT * FROM tbl_about_us Where is_active = "1" LIMIT 1`;
            const [result, fields] = await dbConn.query(sql);
            console.log(result.length);
            if (result.length <= 0) {
                return await common.sendResponse(res, Codes.NOT_FOUND, lang[req.language]['text_home_unavailable_data'], null);
            }
            return await common.sendResponse(res, Codes.SUCCESS, lang[req.language]['text_home_aboutus_succ'], result)
        }
        catch (error) {
            logger.error(error)
            return await common.sendResponse(res, Codes.INTERNAL_ERROR, lang[req.language]['text_user_something_wrong'], null);
        }
    },

    async our_classes(req, res) {
        try {
            let sql = `SElECT * FROM tbl_classes Where is_active = "1"`;
            const [result, fields] = await dbConn.query(sql);
            if (result.length <= 0) {
                return await common.sendResponse(res, Codes.NOT_FOUND, lang[req.language]['text_home_unavailable_data'], null);
            }
            return await common.sendResponse(res, Codes.SUCCESS, lang[req.language]['text_home_classes_succ'], result)
        }
        catch (error) {
            logger.error(error)
            return await common.sendResponse(res, Codes.INTERNAL_ERROR, lang[req.language]['text_user_something_wrong'], null);
        }
    },

    async bmi_calculator(req, res) {
        try {
            let height = req.height;
            let weight = req.weight;
            let heightInMeters = height / 100;
            let bmi = weight / (heightInMeters ** 2);
            let result = {
                bmi: bmi
            }
            if (bmi > 0) {
                return await common.sendResponse(res, Codes.SUCCESS, lang[req.language]['text_home_bmi_succ'], result)
            } else {
                return await common.sendResponse(res, Codes.NOT_FOUND, lang[req.language]['text_home_bmi_err'], null);
            }
        }
        catch (error) {
            logger.error(error)
            return await common.sendResponse(res, Codes.INTERNAL_ERROR, lang[req.language]['text_user_something_wrong'], null);
        }
    },

    async add_event_calendar(req, res) {
        try {
            let postdata = {
                "event_id": req.event_id,
                "name": req.event_name,
                "event_start": req.event_start,
                "event_end": req.event_end
            }
            const [row, field] = await dbConn.query(`SELECT * FROM tbl_event_calendar WHERE name = '${req.event_name}' AND event_start = '${req.event_start}' AND event_end = '${req.event_end}' AND is_active = 1`);
            if (row.length > 0) {
                return await common.sendResponse(res, Codes.DUPLICATE_DATA, lang[req.language]['text_home_duplicate_data_err'], null);
            }
            let sql = `INSERT INTO tbl_event_calendar SET ?`;
            const [result, fields] = await dbConn.query(sql, postdata);
            if (result.affectedRows == 0) {
                return await common.sendResponse(res, Codes.NOT_FOUND, lang[req.language]['text_home_add_event_calendar_error'], null);
            }
            return await common.sendResponse(res, Codes.SUCCESS, lang[req.language]['text_home_add_event_calendar_succ'], result)
        }
        catch (error) {
            logger.error(error)
            return await common.sendResponse(res, Codes.INTERNAL_ERROR, lang[req.language]['text_user_something_wrong'], null);
        }
    },

    async delete_event_calendar(req, res) {
        try {
            const [row, field] = await dbConn.query(`DELETE FROM tbl_event_calendar WHERE event_id = '${req.id}';`);
            if (row.affectedRows == 0) {
                return await common.sendResponse(res, Codes.NOT_FOUND, lang[req.language]['text_home_delete_event_calendar_err'], null);
            }
            return await common.sendResponse(res, Codes.SUCCESS, lang[req.language]['text_home_delete_event_calendar_succ'], null)
        }
        catch (error) {
            logger.error(error)
            return await common.sendResponse(res, Codes.INTERNAL_ERROR, lang[req.language]['text_user_something_wrong'], null);
        }
    },

    async edit_event_calendar(req, res) {
        try {
            const [row, field] = await dbConn.query(`SELECT * FROM tbl_event_calendar WHERE name = '${req.event_name}' AND event_start = '${req.event_start}' AND event_end = '${req.event_end}' AND is_active = 1`);
            if (row.length > 0) {
                return await common.sendResponse(res, Codes.DUPLICATE_DATA, lang[req.language]['text_home_duplicate_data_err'], null);
            }
            let params = {
                name: req.event_name,
                event_start: req.event_start,
                event_end: req.event_end
            }
            const [result, fields] = await dbConn.query(`UPDATE tbl_event_calendar SET ? WHERE event_id=${req.event_id}`, params);
            if (result.affectedRows == 0) {
                return await common.sendResponse(res, Codes.NOT_FOUND, lang[req.language]['text_home_edit_event_calendar_err'], null);
            }
            return await common.sendResponse(res, Codes.SUCCESS, lang[req.language]['text_home_edit_event_calendar_succ'], null)
        }
        catch (error) {
            logger.error(error)
            return await common.sendResponse(res, Codes.INTERNAL_ERROR, lang[req.language]['text_user_something_wrong'], null);
        }
    },
    async list_event_calendar(req, res) {
        const [row, field] = await dbConn.query(`SELECT id,event_id,name,DATE_FORMAT(event_start, '%Y-%m-%d') as event_start,DATE_FORMAT(event_end, '%Y-%m-%d') as event_end FROM tbl_event_calendar WHERE is_active = 1`);
        if (row.length <= 0) {
            return await common.sendResponse(res, Codes.NOT_FOUND, lang[req.language]['text_home_unavailable_data'], null);
        }
        return await common.sendResponse(res, Codes.SUCCESS, lang[req.language]['text_home_edit_event_calendar_succ'], row)
    }
}

module.exports = home_model;