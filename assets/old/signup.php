<?php
require 'conn.php';
?>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
// Form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password1'];
$confirm_password = $_POST['password_confirmation'];
$mobile_no = $_POST['mobile_no'];
$username = $_POST['username'];
$profile_pic=$_POST['profile_pic'];
$sql_check_username = "SELECT * FROM users WHERE username = '$username'";
$result_check_username = $conn->query($sql_check_username);


function generateid(){
  return uniqid();
}

$user_id=generateid();


$sql1 = "SELECT * FROM users WHERE username = '$username'";
$result = $conn->query($sql1);

if ($result_check_username->num_rows > 0) {
    // Username already exists
   
   
    echo "<script> alert('Username already exists. Please choose a different one.'); </script>";
   


} 
else {
    // Insert the new user into the database
    // SQL to insert data into users table
    $sql = "INSERT INTO users (user_id,name,username,password,mobile_no,email,profile_pic) VALUES ( '$user_id','$name','$username','$password','$mobile_no','$email','$profile_pic')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Profile created succesfully.');</script>";       
header("Location: login.php");
exit(); 
      
    } else {
       
    }
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
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@100&family=Inter:wght@200&family=Pacifico&family=Poppins:ital,wght@0,200;1,100&family=Sofia+Sans:wght@300&display=swap" rel="stylesheet">
<style>
    body {
  margin: 0px;
}
:root {
  --primary-color: #f07900;
}
.dark-theme {
  --primary-color: #d35100;
}
    .container-signup {
  position: absolute;
  height: 770px;
  width: 100%;
  top: 0;
  left: 0;
  opacity: 0.8;
  font-family: "Poppins", sans-serif;
  font-weight: 600;
}
.container-signup::after {
  position: absolute;
  top: 0;
  left: 0;
  height: 100%;
  width: 100%;
  content: "";
  z-index: -1;
  background: var(--primary-color);
  opacity: 0.65;
}

#signup-form {
  margin-top: 40px;
  margin-bottom: 10px;
  margin-left: 10px;
  margin-bottom: 20px;
  display: grid;
  grid-template-columns: 50% 50%;
}
.profile_pic {
  grid-column: span 2;
  padding: 0px 35%;
}
.profile_pic div {
  height: 135px;
  width: 135px;
  margin-left:10px;
}
#profile_img{
  background: white;
  border-radius: 50%;
  background-image: url("images/images.png");
  background-size:cover;
  
}
#signup-form label {
  margin: 20px 30px;
}

#signup-form input {
  width: 210px;
  margin-left: 30px;
}

#sign_up {
  position: absolute;
  top: 60px;
  left: 27%;
  height: auto;
  width: 48%;

  border-radius: 3%;
  background-color: var(--primary-color);
  box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px,
    rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
}
.container-signup label {
  margin: 10px 30px;
  font-size: larger;
  color: white;
}
.container-signup input {
  margin: 20px 30px;
  border-radius: 10px;
  border: none;
  height: 22px;
  width: 220px;
}

.sign_upbtn {
  height: 40px;
  width: 93%;
  margin: 7px 10px;
  color: var(--primary-color);
  background-color: white;
  border: none;
  border-radius: 5px;
  font-size: larger;
}
.sign_upbtn:hover {
  color: white;
  background-color: var(--primary-color);
  border: 1px solid white;
}
    </style>


</head>
<body>

<div class="container-signup">
<div id="sign_up">
    <form id="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  onsubmit="return validateForm()">
    <div class="profile_pic">
    <div><div id="profile_img"></div></div>
    <input type="file" name="profile_pic" id="imageInput" accept="image/*"><br>
    </div>
    <div>
        <label>Name:</label><br>
        <input type="text" name="name" required><br>
    </div>
    <div>
        <label>Email ID: </label><br>
        <input type="text" name="email" required><br>
    </div>
    <div>
        <label>Mobile no: </label><br>
        <input type="text" name="mobile_no" id="mobile_no" required><br>
     </div>
     <div>
        <label>Username: </label><br>
        <input type="text" name="username" id="username" required><br>
     </div>
     <div>
        <label>Password: </label>
        <input type="password" name="password1" id="password1" required><br>
    </div>
     
     <div>
        <label>Confirmation Password: </label><br>
        <input type="password" name="password_confirmation" id="password_confirmation"><br>
    </div>
     
        <button type="submit" class="sign_upbtn" value="Submit">SIGN UP</button>
     
    </form>
</div>  
</div>
<script>




    
     function validateForm() {
        var password1 = document.getElementById("password1").value;
        var password_confirmation = document.getElementById("password_confirmation").value;

        if (password1 !== password_confirmation) {
            alert("Passwords do not match");
            return false; 
        }
        
        return true; 
    }


    </script>
<script src="script.js"> </script>

</body>
</html>



