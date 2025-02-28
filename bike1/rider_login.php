<?php
// Database connection
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "db"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Form data
$username = $_POST['username'];
$password = $_POST['password'];

// SQL to validate username and password
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

if ($result->num_rows> 0) {
    // Login successful
    echo "<script>alert('Login successfully');</script>";
    header("Location:rider_dashboard.php");
    
} else {
    // Invalid username or password
    echo "<script>alert('Invalid username or password');</script>";
   
}

// Close connection
$conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@100&family=Inter:wght@200&family=Pacifico&family=Poppins:ital,wght@0,200;1,100&family=Sofia+Sans:wght@300&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="styles.css">
    <style>

    </style>

</head>

<body>

    <div class="container-login">
        <div id="login_form_login">
            <form id="login-form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" >
                <label>Username:</label>
                <br>
                <input type="text" name="username">
                <br>
                <label>Password:</label>
                <br>
                <input type="password" name="password">
                <label>Rider Id:</label>
                <br>
                <input type="text" name="rider_id">
                <button class="loginpg-btn"  value="Submit">LOGIN</button>
                
            </form>
            
        </div>

        <script src="script.js">

</script>
</body>
