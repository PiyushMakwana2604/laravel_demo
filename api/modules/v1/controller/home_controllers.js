const common = require("../../../config/common");
const home_model = require("../models/home_model");
const logger = require("../../../logger");
const Codes = require("../../../config/status_codes");
const { log } = require("winston");

exports.our_team = async (req, res) => {
    return home_model.our_team(req, res)
}

exports.team_details = async (req, res) => {
    var request = await common.decryption(req);
    var rules = {
        team_id: "required"
    }
    let valid = await common.checkValidationRules(request, rules)
    if (valid.status) {
        return home_model.team_details(request, res)
    }
    else {
        logger.error(valid.error)
        return common.sendResponse(res, Codes.VALIDATION_ERROR, valid.error, null);
    }
};

exports.contact_us = async (req, res) => {
    // console.log(req);
    var request = await common.decryption(req);
    var rules = {
        first_name: "required",
        last_name: "required",
        email: "required|email",
        comment: "required"
    }
    let valid = await common.checkValidationRules(request, rules)
    if (valid.status) {
        return home_model.contact_us(request, res)
    }
    else {
        logger.error(valid.error)
        return common.sendResponse(res, Codes.VALIDATION_ERROR, valid.error, null);
    }
};

exports.services = async (req, res) => {
    return home_model.services(req, res)
}

exports.about_us = async (req, res) => {
    return home_model.about_us(req, res)
}

exports.our_classes = async (req, res) => {
    return home_model.our_classes(req, res)
}

exports.bmi_calculator = async (req, res) => {
    var request = await common.decryption(req);
    var rules = {
        height: "required|numeric|min:15",
        weight: "required|numeric|min:2",
        age: "required|numeric|max:120",
        gender: "required"
    }
    let valid = await common.checkValidationRules(request, rules)
    if (valid.status) {
        return home_model.bmi_calculator(request, res)
    }
    else {
        logger.error(valid.error)
        return common.sendResponse(res, Codes.VALIDATION_ERROR, valid.error, null);
    }
};

exports.add_event_calendar = async (req, res) => {
    var request = await common.decryption(req);
    var rules = {
        event_name: "required",
        event_start: "required",
        event_end: "required"
    }
    let valid = await common.checkValidationRules(request, rules)
    if (valid.status) {
        return home_model.add_event_calendar(request, res)
    }
    else {
        logger.error(valid.error)
        return common.sendResponse(res, Codes.VALIDATION_ERROR, valid.error, null);
    }
};

exports.delete_event_calendar = async (req, res) => {
    var request = await common.decryption(req);
    var rules = {
        id: "required"
    }
    let valid = await common.checkValidationRules(request, rules)
    if (valid.status) {
        return home_model.delete_event_calendar(request, res)
    }
    else {
        logger.error(valid.error)
        return common.sendResponse(res, Codes.VALIDATION_ERROR, valid.error, null);
    }
};

exports.edit_event_calendar = async (req, res) => {
    var request = await common.decryption(req);
    var rules = {
        event_id: "required",
        event_name: "required",
        event_start: "required",
        event_end: "required"
    }
    let valid = await common.checkValidationRules(request, rules)
    if (valid.status) {
        return home_model.edit_event_calendar(request, res)
    }
    else {
        logger.error(valid.error)
        return common.sendResponse(res, Codes.VALIDATION_ERROR, valid.error, null);
    }
};

exports.list_event_calendar = async (req, res) => {
    return home_model.list_event_calendar(req, res)
}