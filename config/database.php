<?php
// config/database.php

$host = "mysql.freehostia.com"; // MySQL hostname
$db_name = "yasjai1_bike_pooling"; // MySQL database name
$username = "yasjai1_bike_pooling"; // MySQL username
$password = "Bike@2003"; // MySQL password
$port = 3306; // MySQL port (optional)

try {
    // Create a PDO connection
    $conn = new PDO("mysql:host=$host;port=$port;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Enable exceptions for errors
} catch (PDOException $e) {
    die("Connection failed raa: " . $e->getMessage()); // Handle connection errors
}
?>