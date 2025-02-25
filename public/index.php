<?php
include '../config/database.php';
include '../includes/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bike Pooling - Home</title>
    <link href="../assets/style.css" type="stylesheet" >
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <div class="banner">
        <h1>Are you Want to Become a Co-Rider!!</h1>
        <img src="https://images.tractorjunction.com/3_RV_400_3b1b9bc0aa.png?format=webp" alt="Bike Image" style="max-width: 500px;">
    </div>
    
    <div class="search-bar">
        <form method="get" action="search.php">
            <input type="text" name="from" placeholder="Leaving from" required>
            <input type="text" name="to" placeholder="Going to" required>
            <input type="date" name="date" required>
            <button type="submit">Search</button>
        </form>
    </div>
</body>
</html>