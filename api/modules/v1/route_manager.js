const express = require('express');
const router = express.Router();
const middleware = require('../../middleware/headerValidator');

const home_routes = require('./routes/home_routes')

router.use('/', middleware.extractHeaderLanguage);

router.use('/', middleware.validateHeaderApiKey);

// router.use('/', middleware.validateHeaderToken);

router.use('/home/', home_routes);

module.exports = router;