<?php
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = uniqid('U');
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $mobile_no = $_POST['mobile_no'];
    $gender = $_POST['gender'];

    // Validate password match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!');</script>";
        exit();
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    // Handle profile picture upload
    $profile_pic = null;
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $profile_pic = file_get_contents($_FILES['profile_pic']['tmp_name']);
    }

    try {
        $stmt = $conn->prepare("INSERT INTO users (user_id, username, password, email, mobile_no, gender, profile_pic) VALUES (:user_id, :username, :password, :email, :mobile_no, :gender, :profile_pic)");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mobile_no', $mobile_no);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':profile_pic', $profile_pic, PDO::PARAM_LOB);

        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
            exit();
        } else {
            echo "<script>alert('Error in registration!');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
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
        }
        .registration-container {
            background-color: #F69422;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 600px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-gap: 10px;
        }
        .registration-container label {
            display: block;
            margin-bottom: 5px;
            color: white;
        }
        .registration-container input, .registration-container select {
            width: calc(100% - 22px);
            padding: 5px;
            margin-bottom: 10px;
            border: none;
            border-radius: 20px;
            box-sizing: border-box;
        }
        .registration-container button {
            width: 100%;
            padding: 5px 10px;;
            background-color: #fff;
            color: #F69422;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            margin-top: 20px;
        }
        .registration-container button:hover {
            background-color: #ffcc99;
        }
        .profile-pic-container {
            grid-column: 1 / 3;
            text-align: center;
            margin-bottom: 20px;
        }

        .profile-pic-icon {
            width: 80px;
            height: 80px;
            background-color: white;
            border-radius: 50%;
            display: inline-flex;
            justify-content: center;
            align-items: center;
            color: black;
            font-size: 4em;
            margin-bottom: 10px;
            padding: 0;
        }
        .profile-pic-icon::before {
            content: "\f2bd"; 
            font-family: "Font Awesome 6 Free"; /* Or your specific Font Awesome family */
            font-weight: 900;
        }

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
</head>
<body>
    <?php include '../includes/header.php'; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="registration-container">
            <div class="profile-pic-container">
                <div class="profile-pic-icon"></div>
                <label for="profile_pic">Profile Picture:</label>
                <input type="file" name="profile_pic" id="profile_pic" accept="image/*">
            </div>

            <div>
                <label for="username">Name:</label>
                <input type="text" name="username" placeholder="Enter your full name" required>
            </div>

            <div>
                <label for="email">Email ID:</label>
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>

            <div>
                <label for="mobile_no">Mobile No:</label>
                <input type="text" name="mobile_no" placeholder="Enter your mobile number" required>
            </div>

            <div>
                <label for="gender">Gender:</label>
                <select name="gender">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" name="password" placeholder="Enter your password" required>
            </div>

            <div>
                <label for="confirm_password">Confirm Password:</label>
                <input type="password" name="confirm_password" placeholder="Re-enter your password" required>
            </div>

            <div>
                <button type="submit">SIGN UP</button>
            </div>
        </div>
    </form>
</body>
</html>