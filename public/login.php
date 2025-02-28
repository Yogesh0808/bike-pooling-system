<?php
include '../includes/session.php';
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $identifier = $_POST['email']; 
    $password = $_POST['password'];

    if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :identifier");
    } else {
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :identifier");
    }

    $stmt->bindParam(':identifier', $identifier);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['mobile_no'] = $user['mobile_no'];
        $_SESSION['gender'] = $user['gender'];

        echo "<script>alert('Login Successful'); window.location.href='index.php';</script>";
        exit();
    } else {
        echo "<script>alert('Invalid credentials!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #F9B975;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }
        .login-container {
            background-color: #F69422;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 320px;
            text-align: center;
            margin-top: 70px; /* Adjust for fixed header */
        }
        label {
            display: flex;
            text-align: left;
            margin: 15px 20px;
            font-weight: bold;
            color: white;
        }
        input {
            width: 90%;
            padding: 2px 5px;;
            margin: 10px;
            border: none;
            border-radius: 20px;
        }
        button {
            margin: 10px;
            padding: 2px 10px;
            background-color: #fff;
            color: #F69422;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        button:hover {
            background-color: #ffcc99;
        }
        .signup-text {
            margin-top: 15px;
            font-size: 14px;
        }
        .signup-text a {
            color: yellow;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <?php include '../includes/header.php'; ?> 

    <div class="login-container">
        <form method="post" action="">
            <label for="identifier">Username or Email:</label>
            <input type="text" name="email" placeholder="Enter your username or email" required>
            <label for="password">Password:</label>
            <input type="password" name="password" placeholder="Enter your password" required>
            <button type="submit">LOGIN</button>
        </form>
        <p class="signup-text">First time visiting? <a href="signup.php">Sign Up</a></p>
    </div>
</body>
</html>