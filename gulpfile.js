const { series, parallel, src, dest } = require("gulp");
var exec = require("child_process").exec;
var cmd = null;

/**
 *  Funtion to install composer dependecies
 * @param {*} cb
 */
function Install_Dependencies(cb) {
    cmd = exec("composer install", function (err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        cb(err);
    });
}

/**
 *  Funtion to create de database in mysql
 * @param {*} cb
 */
function Create_Database(cb) {
    cmd = exec("php artisan migrate", function (err, stdout, stderr) {
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
    cmd = exec("php artisan migrate --seed", function (err, stdout, stderr) {
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
    cmd = exec("php artisan migrate:reset", function (err, stdout, stderr) {
        console.log(stdout);
        console.log(stderr);
        cb(err);
    });
}


exports.Install_Dependencies = Install_Dependencies;
exports.Create_Database = Create_Database;
exports.Create_Database_Seed = Create_Database_Seed;
exports.Delete_Database = Delete_Database;
