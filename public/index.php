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
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .banner-section {
            color: white;
            display: flex;
            align-items: center;
            height: 90vh;
            padding: 20px 50px;
        }
        .banner-text {
            text-align: left;
            width: 100%; 
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
    <link type="text/css" href="../assets/css/style.css" />
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <!-- Banner Section -->
    <section class="banner-section">
        <div class="banner-text">
            <h1>Are You Want to Become <br> <span>Co-Rider!!</span></h1>
            <a href="rider_signup.php" class="rider-btn">Book as Rider</a>
        </div>
        <div class="banner-image">
            <img src="../assets/images/banner-bike.webp" alt="Bike Image">
        </div>
    </section>

    <!-- Search Section -->
    <section class="search-section">
        <form action="search.php" method="post" class="search-bar">
            <div class="search-box">
                <div class="search-field">
                    <i class="fas fa-map-marker-alt icon"></i>
                    <input type="text" name="pickup" placeholder="Leaving from" required>
                </div>
                <div class="search-field">
                    <i class="fas fa-flag-checkered icon"></i>
                    <input type="text" name="destination" placeholder="Going to" required>
                </div>
                <div class="search-field">
                    <i class="fas fa-calendar-alt icon"></i>
                    <input type="date" name="date" required>
                </div>
                <button type="submit"><i class="fas fa-search"></i> Search</button>
            </div>
        </form>
    </section>

    <!-- Services Section -->
    <section class="services">
        <h1>Our Services</h1>
        <div class="service-content">
            <div class="content1">
                <h2>Bike Pooling</h2>
                <h4>Bike pooling helps people share rides, reducing traffic and saving costs. It’s a smart way to travel while being environmentally conscious.</h4>
                <img src="../assets/images/bike-pooling.avif" alt="Bike Pooling">
            </div>
            <div class="content2">
                <h2>Bike Renting</h2>
                <h4>Rent a bike for short or long durations with flexible plans. Ideal for daily commutes or travel enthusiasts who need easy mobility.</h4>
                <img src="../assets/images/bike-rent.svg" alt="Bike Renting">
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer id="contacts">
        <p>© 2025 Your Company. All rights reserved.</p>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            var storedImageUrl = localStorage.getItem('background_image');
            if (storedImageUrl) {
                document.querySelector(".right-nav .profile_div").style.backgroundImage = "url('" + storedImageUrl + "')";
            }
        });
    </script>
    <script src="script.js"></script>

</body>
</html>