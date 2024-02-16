const express = require('express')
const router = express.Router()
const homeController = require('../controller/home_controllers');

router.get('/our-team', homeController.our_team);

router.get('/team-details', homeController.team_details);

router.post('/contact-us', homeController.contact_us);

router.get('/services', homeController.services);

router.get('/about-us', homeController.about_us);

router.get('/our-classes', homeController.our_classes);

router.post('/bmi-calculator', homeController.bmi_calculator);

router.post('/add-event-calendar', homeController.add_event_calendar);

router.post('/delete-event-calendar', homeController.delete_event_calendar);

router.post('/edit-event-calendar', homeController.edit_event_calendar);

router.post('/list-event-calendar', homeController.list_event_calendar);


module.exports = router;