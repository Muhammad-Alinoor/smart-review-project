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