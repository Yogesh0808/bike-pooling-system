<?php
require '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Form data
    $rider_name = $_POST['rider_name'];
    $license_no = $_POST['license_no'];
    $address = $_POST['address'];
    $vehicle_no = $_POST['vehicle_no'];
    $vehicle_model = $_POST['vehicle_model'];
    $rider_username = $_POST['rider_username'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Generate sequential Rider ID
    $stmt = $conn->query("SELECT COUNT(*) as total FROM riders");
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $rider_id = "RID" . ($row['total'] + 1);

    // Insert into database
    $sql = "INSERT INTO riders (rider_id, rider_name, license_no, address, vehicle_no, vehicle_model, rider_username, gender, password) 
    VALUES (:rider_id, :rider_name, :license_no, :address, :vehicle_no, :vehicle_model, :rider_username, :gender, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':rider_id', $rider_id);
    $stmt->bindParam(':rider_name', $rider_name);
    $stmt->bindParam(':license_no', $license_no);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':vehicle_no', $vehicle_no);
    $stmt->bindParam(':vehicle_model', $vehicle_model);
    $stmt->bindParam(':rider_username', $rider_username);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
        echo "<script>alert('Rider Profile Created Successfully! Your Rider ID: " . $rider_id . "'); window.location.href='rider_login.php';</script>";
        exit();
    } else {
        $errorInfo = $stmt->errorInfo();
        echo "<script>alert('Error: " . $errorInfo[2] . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Signup - Bike Pooling System</title>
     <style>
     body{margin:0}:root{--primary-color:#f07900}.dark-theme{--primary-color:#d35100}.container-rd_signup{position:absolute;height:100%;width:100%;top:0;left:0;opacity:0.8;font-family:'Poppins', sans-serif;font-weight:600}.container-rd_signup::after{position:absolute;top:0;left:0;height:100%;width:100%;content:"";z-index:-1;background:var(--primary-color);opacity:0.65}#signup-form{margin-top:40px;margin-bottom:10px;margin-left:10px;margin-bottom:20px;display:grid;grid-template-columns:50% 50%}#signup-form label{margin:20px 30px}#signup-form input{width:210px;margin-left:30px}#sign_up{position:absolute;top:90px;left:27%;height:auto;width:48%;border-radius:3%;background-color:var(--primary-color);box-shadow:rgba(50, 50, 93, 0.25) 0 13px 27px -5px, rgba(0, 0, 0, 0.3) 0 8px 16px -8px}.container-rd_signup label{margin:10px 30px;font-size:larger;color:white}.container-rd_signup input{margin:20px 30px;border-radius:10px;border:none;height:22px;width:220px}.sign_upbtn{height:40px;width:93%;margin:7px 10px;color:var(--primary-color);background-color:white;border:none;border-radius:5px;font-size:larger}.sign_upbtn:hover{color:white;background-color:var(--primary-color);border:1px solid white}
     .login-link { text-align: center; margin: 20px 0; font-size: 16px; color: white; }
     .login-link a { color: white; text-decoration: underline; font-weight: bold; }
     input { padding: 5px 10px;}
    </style>
      <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@100&family=Inter:wght@200&family=Pacifico&family=Poppins:ital,wght@0,200;1,100&family=Sofia+Sans:wght@300&display=swap" rel="stylesheet">
</head>

<body>

<?php include '../includes/header.php'; ?>
<div class="container-rd_signup">
<div id="sign_up">
    <form id="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  onsubmit="return validateForm()">
    <div>
        <label>Username:</label><br>
        <input type="text" name="rider_username" required><br>
    </div>
    <div>
        <label>Password : </label><br>
        <input type="password" name="password"  required><br>
    </div>
    <div>
   <label>Confirm Password : </label><br>
   <input type="password" name="password_confirmation" id="password_confirmation" required><br>
</div>
    <div>
        <label>Name: </label><br>
        <input type="text" name="rider_name" id="rider_name"  required><br>
     </div>
     <div>
    <label>Gender:</label><br>
    <select name="gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
        <option value="Other">Other</option>
    </select><br>
    </div>
     <div>
        <label>Driving License no: </label><br>
        <input type="text" name="license_no" id="license_no"  required><br>
     </div>
     <div>
        <label>Upload Driving License: </label><br>
        <input type="file" name="license_file" id="license_file"  required><br>
</div>
     <div>
        <label>Your Address: </label>
        <input type="text" name="address" id="address"  required><br>
    </div>
    <div>
        <label>vehicle no: </label>
        <input type="text" name="vehicle_no" id="vehicle_no"  required><br>
    </div>
    <div>
        <label>vehicle model: </label>
        <input type="text" name="vehicle_model" id="vehicle_model"  required><br>
    </div>
        <button type="submit" class="sign_upbtn" value="Submit" >SIGN UP</button>
     
    </form>
    <div class="login-link">Existing User? <a href="rider_login.php">Login</a></div>
</div>  
</div>
<script>
     function validateForm() {
        var password = document.querySelector("input[name='password']").value
        var confirmPassword = document.querySelector("input[name='password_confirmation']").value;

        if (password !== confirmPassword) {
     alert("Passwords do not match");
     return false;
    }
    return true;
    }
    </script>
<script src="script.js"> </script>
</body>
</html>