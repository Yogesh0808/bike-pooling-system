<?php
include '../config/database.php';
include '../includes/session.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Bike Pooling - Home</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@100&family=Inter:wght@200&family=Pacifico&family=Poppins:ital,wght@0,200;1,100&family=Sofia+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #F27900;
            font-family: 'Google Italic', sans-serif;
            color: white;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .banner-section {
            display: flex;
            align-items: center;
            height: 90vh;
            padding: 20px 50px;
        }
        .banner-text {
            text-align: left;
            width: 100%; /* Take full width */
            display: flex;
            flex-direction: column;
            justify-content: center; /* Center content vertically */
            align-items: flex-start;
        }
        .banner-text h1 {
            font-size: 4.5em;
            font-style: italic;
            margin-bottom: 20px;
            width: 140%; /* Limit width to accommodate image */
        }
        .banner-text a {
            padding: 5px 30px;
            border: 2px solid white;
            color: white;
            text-decoration: none;
            font-style: normal;
            border-radius: 5px;
            font-size: 1.2em;
            text-align: center;
            display: inline-block;
            margin-left: 60%;
        }
        .banner-image {
            display: flex;
            justify-content: flex-end;
            align-items: flex-end;   
        }
        .banner-image img {
            width: 50vw;
            height: auto;
            transform: translateY(120px);
        }
        .search-section {
            background-color: white;
            padding: 20px;
            border-radius: 15px;
            margin: 50px auto;
            width: 80%;
            max-width: 800px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .search-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
        }
        .search-bar input {
            flex: 1;
            padding: 10px 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 25px;
            outline: none;
        }
        .search-bar input::placeholder {
            color: #999;
        }
        .search-bar button {
            padding: 10px 20px;
            background-color: #F27900;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 5px;
        }
        .search-bar button:hover {
            background-color: #FFD700;
        }
        .search-bar .icon {
            font-size: 18px;
            color: #F27900;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    
    <section class="banner-section">
        <div class="banner-text">
            <h1>Are You Want to Become <br> Co-Rider!!</h1>
            <a href="book_ride.php">Book as Rider</a>
        </div>
        <div class="banner-image">
            <img src="https://images.tractorjunction.com/3_RV_400_3b1b9bc0aa.png?format=webp" alt="Bike Image">
        </div>
    </section>
    
    <section class="search-section">
        <div class="search-bar">
            <div style="flex: 1; position: relative;">
                <i class="fas fa-map-marker-alt icon" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);"></i>
                <input type="text" name="from" placeholder="Leaving from" required style="padding-left: 35px;">
            </div>
            <div style="flex: 1; position: relative;">
                <i class="fas fa-flag-checkered icon" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);"></i>
                <input type="text" name="to" placeholder="Going to" required style="padding-left: 35px;">
            </div>
            <div style="flex: 1; position: relative;">
                <i class="fas fa-calendar-alt icon" style="position: absolute; left: 10px; top: 50%; transform: translateY(-50%);"></i>
                <input type="date" name="date" required style="padding-left: 35px;">
            </div>
            <button type="submit"><i class="fas fa-search"></i> Search</button>
        </div>
    </section>
</body>
</html>