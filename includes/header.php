<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../assets/style.css">
    <style>
        :root {
    --bg-color: #D35100;
    --text-color: #FAE4D8 ;
}

.dark-mode {
    --bg-color: #D65000;
    --text-color: #FFFFFF;
}


.theme-toggle img {
    width: 30px;
    height: 30px;
    cursor: pointer;
}

.switch {
  position: relative;
  display: inline-block;
  height: 28px;
  width: 60px;
  background-color: #D35100; /* Use a valid color */
  border-radius: 20px;
  border: 1.5px solid #efefef;
  margin: 10px 20px 0px 0;
}

.switch:before {
  position: absolute;
  content: "";
  background: url("../assets/icons/icons8-sun-24.png");
  background-size: 20px 20px;
  display: flex;
  background-position: 2px 2px;
  background-repeat: no-repeat;
  background-color: #efefef;
  height: 24px;
  width: 24px;
  margin: 2px;
  border-radius: 50%;
  transition: 0.4s;
}

input:checked + .switch {
  background-color: var(--bg-color);
}

input:checked + .switch:before {
  transform: translateX(32px);
  background: url("../assets/icons/moon.png");
  background-size: 20px 20px;
  background-position: 2px 2px;
  background-repeat: no-repeat;
  background-color: #efefef;
}

#check {
  display: none;
}
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
        .header {
            background: #FAE4D8;
            color: var(--bg-color);
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
            <input type="checkbox" onchange="" id="check">
            <label for="check" class="switch"></label>
                <?php if (isset($_SESSION['username'])): ?>
                <span>Welcome, <?php echo $_SESSION['username']; ?></span>
                <a href="logout.php">Logout</a>
                   <?php else: ?>
                <a href="login.php">Login</a>
                <?php endif; ?>
        </div>
    </div>
    <script src="../assets/js/script.js" > </script>
</body>
</html>
