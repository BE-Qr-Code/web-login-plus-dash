var mysql = require('mysql');
var con = mysql.createConnection({
    host: "localhost:3308",
    user: "root",
    password: ""
  });
  
  con.connect(function(err) {
    if (err) throw err;
    console.log("Connected!");
  });