const { series, parallel, src, dest } = require("gulp");
var exec = require("child_process").exec;
var mysql = require("mysql");

/**
 *  Funtion to install composer dependecies
 * @param {*} cb
 */
function Install_Dependencies(cb) {
    exec("composer install", function (err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        cb(err);
    });
}


/**
 *  Funtion to create de database in mysql with expamples
 * @param {*} cb
 */
function Create_Database_Seed(cb) {
    create_db(cb);
    exec("php artisan migrate --seed", function (err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        cb(err);
    });
}

/**
 *  Funtion to delete de database from mysql
 * @param {*} cb
 */
function Delete_Database(cb) {
    exec("php artisan migrate:reset", function (err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        cb(err);
    });
}

function create_db(cb) {
    var connection = mysql.createConnection({
        host: "localhost",
        user: "root",
        password: "",
    });

    connection.connect();

    connection.query("DROP DATABASE IF EXISTS laravel", function (error) {
        if (error) throw error;
    });
    connection.query("CREATE DATABASE laravel", function (error) {
        if (error) throw error;
        cb();
    });

    connection.end();
}

exports.create_db = create_db;
exports.Install_Dependencies = Install_Dependencies;
exports.Create_Database_Seed = Create_Database_Seed;
exports.Delete_Database = Delete_Database;
