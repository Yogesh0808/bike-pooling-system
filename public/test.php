<?php
include '../config/database.php'; 

try {
    // Test the connection
    $stmt = $conn->query("SELECT 1");
    echo "Database connection is working!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>