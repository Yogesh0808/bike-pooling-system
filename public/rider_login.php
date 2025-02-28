<?php
require '../includes/session.php';
require '../config/database.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $rider_id = trim($_POST['rider_id']);

    // Validate inputs
    if (empty($username) || empty($password) || empty($rider_id)) {
        echo "<script>alert('All fields are required.');</script>";
    } else {
        // Prepare SQL statement to prevent SQL injection
        $sql = "SELECT * FROM riders WHERE rider_username = :username AND rider_id = :rider_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':rider_id', $rider_id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                $_SESSION['rider_id'] = $user['rider_id'];
                $_SESSION['rider_username'] = $user['rider_username'];
                echo "<script>alert('Login successful!'); window.location.href='rider_dashboard.php';</script>";
                exit();
            } else {
                echo "<script>alert('Invalid password.');</script>";
            }
        } else {
            echo "<script>alert('Invalid username or Rider ID.');</script>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Login</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <div class="container-login">
        <div id="login_form_login">
            <form id="login-form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <label>Username:</label>
                <input type="text" name="username" required>
                <label>Password:</label>
                <input type="password" name="password" required>
                <label>Rider ID:</label>
                <input type="text" name="rider_id" required>
                <button class="loginpg-btn" type="submit">LOGIN</button>
            </form>
        </div>
    </div>
</body>
</html>
