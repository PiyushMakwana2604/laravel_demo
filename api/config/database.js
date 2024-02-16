var mysql = require('mysql');

var con = mysql.createPool({
    host: process.env.DATABASE_HOST,
    user: process.env.DATABASE_USER,
    password: process.env.DATABASE_PASSWORD,
    database: process.env.DATABASE_NAME,
    charset: 'utf8mb4'
});

con.getConnection((err) => {
    if (err) {
        console.log(err);
    } else {
        console.log("database was connected successfully");
    }
})

module.exports = con;