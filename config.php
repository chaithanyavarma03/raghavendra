<?php

// Base URL of the project. Modify "your_project_directory" to match your actual project path
if (!defined('BASE_URL')) {
    define('BASE_URL', 'http://localhost/RTS/eCommerceSite-PHP/');

// Database connection parameters
define('DB_HOST', 'localhost'); // Database host
define('DB_NAME', 'ecommerceweb'); // Database name
define('DB_USER', 'root'); // Database username
define('DB_PASSWORD', ''); // Database password

// Establish a PDO connection
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Optional: Set the default fetch mode to FETCH_ASSOC for fetching associative arrays
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Could not connect to the database " . DB_NAME . ": " . $e->getMessage());
}
}

?>
<style>
    body{
        background-color: #aa7a76;
    }
</style>