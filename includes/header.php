<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        .header {
            background: #FAE4D8;
            color: #D35100;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 30px;
            width: 100%;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
        }
        .nav a {
            text-decoration: none;
            color: #D35100;
            margin: 0 15px;
            font-size: 16px;
            font-weight: bold;
        }
        .nav a:hover {
            color: #A13600;
        }
        .profile a {
            text-decoration: none;
            color: #D35100;
            font-weight: bold;
        }
        .profile span {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">Bike Pooling</div>
        <div class="nav">
            <a href="index.php">Home</a>
            <a href="about.php">About</a>
            <a href="rent_bike.php">Rent</a>
            <a href="contact.php">Contact</a>
        </div>
        <div class="profile">
            <?php if (isset($_SESSION['username'])): ?>
                <span>Welcome, <?php echo $_SESSION['username']; ?></span>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Login</a>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
