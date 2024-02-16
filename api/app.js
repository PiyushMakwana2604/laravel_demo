const express = require('express');
require('dotenv').config()
var app = express();

app.use(express.text());
// app.use(express.json());
app.use(express.urlencoded({ extended: false }));

app.use('/v1/api_document/', require('./modules/v1/api_document/index'));


app.engine('html', require('ejs').renderFile);
app.set('view engine', 'html');
app.use('/', require('./middleware/validator').extractHeaderLanguage);
app.use('/', require('./middleware/validator').validateApiKey);
app.use('/', require('./middleware/validator').validateHeaderToken);

var user_product = require('./modules/v1/user/route');
app.use('/api/v1/user', user_product)
var auth_product = require('./modules/v1/auth/route');
app.use('/api/v1/auth', auth_product)

try {
    server = app.listen(process.env.PORT);
    console.log("successfully connected on port number " + process.env.PORT);
}
catch (err) {
    console.log("failed to connect ");
}   