<?php
/**
 * Database configuration file.
 * PDO connection with error handling.          
 */
define("DB_HOST","localhost");
define("DB_NAME","smart-review-project");
define("DB_USER","root");
define("DB_PASS"," ");
// pdo option for security and performance
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
];
try{
    //create pdo isntance
    $dsn = "mysql:host=". DB_HOST . ";
    dbname=" . DB_NAME . ";
    charset=utf8mb4";
    $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
}
catch(PDOException $e){
    //log error and show user friendly message
    error_log("Database connection error: " .  $e->getMessage());
    die(json_encode([
        "success" => "false",
        "message" => "Database connection failed.Please contact adminstrator"
    ]));
}