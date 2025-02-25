<?php
include '../config/database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = uniqid('U');
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $mobile_no = $_POST['mobile_no'];
    $gender = $_POST['gender'];

    $stmt = $conn->prepare("INSERT INTO users (user_id, username, password, email, mobile_no, gender) VALUES (:user_id, :username, :password, :email, :mobile_no, :gender)");
    $stmt->bindParam(':user_id', $user_id);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':mobile_no', $mobile_no);
    $stmt->bindParam(':gender', $gender);
    
    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: login.php");
        exit();
    } else {
        echo "Error in registration!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
</head>
<body>
    <h2>Sign Up</h2>
    <form method="post" action="">
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="mobile_no" placeholder="Mobile No" required>
        <select name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select>
        <button type="submit">Sign Up</button>
    </form>
</body>
</html>