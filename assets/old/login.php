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
    header("Location:index.html");
    
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
            <form id="login-form1" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  >
                <label>Username:</label>
                <br>
                <input type="text" name="username">
                <br>
                <label>Password:</label>
                <br>
                <input type="password" name="password">

                <button class="loginpg-btn" value="Submit" onclick="disp_prof()">LOGIN</button>
                <h4>For First time visiting, <span onclick="location.href='signup.php'">Sign up</span></h4>
            </form>
            
        </div>
        <script>
 var imageUrl=<?php 
  $result = mysqli_query($conn, "SELECT * FROM trips");
  if (mysqli_num_rows($result) > 0) {
    $i = 0;
    while ($row = mysqli_fetch_array($result)) {
        echo $row["profile_pic"]; 
    }
    $i++;
}
?>       

// Store image URL in localStorage
            localStorage.setItem('background_image', imageUrl);



        function disp_prof(){
    // Retrieve image URL from localStorage on page load
    var storedImageUrl = localStorage.getItem('background_image');
    if (storedImageUrl) {
        document.getElementById("profile_img").style.backgroundImage = "url('" + storedImageUrl + "')";
    }
        }
            </script>


        <script src="script.js">

</script>
</body>
