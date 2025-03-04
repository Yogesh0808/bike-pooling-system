<?php

// Database connection
$servername = "localhost"; // Change this to your MySQL server hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$dbname = "db"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Collect form data
    $license_no = $_POST['license_no'];
    $address = $_POST['address'];
    $veh_no = $_POST['veh_no'];
    $veh_model = $_POST['veh_model'];
    $license_file = $_POST['license_file'];
    
    
    // Check if username and password exist in the user table
    $username = $_POST['username']; 
    $password = $_POST['password']; 

  
   
 

    $user_check_sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $user_result = $conn->query($user_check_sql);

    
    if ($user_result->num_rows ==1) {
        // Username and password exist in the user table, proceed with inserting into the rider table
     
        $user_check_sql = "SELECT * FROM rider WHERE rider_username = '$username' ";
        $user_result = $conn->query($user_check_sql);
    
        
        if ($user_result->num_rows ==0){
            $sql = "INSERT INTO rider (license_no,address,vehicle_no,license_file,veh_model,rider_username) 
         
            VALUES ('$license_no', '$address', '$veh_no', '$license_file','$veh_model','$username')";

if ($conn->query($sql) === TRUE) {
    $last_id = $conn->insert_id;
    echo "<script>alert('Your Rider ID: " . $last_id . "');</script>";
    echo "<script>window.location.href = 'rider_login.php';</script>";
}

                    else{
                        echo "<script> alert('ERROR WHILE CREATING ACCOUNT');</script>";
                    }
        }
       
        else {
            // Username and password do not match any existing user in the user table
            
            $user_check_sql = "SELECT * FROM rider WHERE rider_username = '$username' ";
            $user_result = $conn->query($user_check_sql);
        
            
            if ($user_result->num_rows >0){
                echo "<script> alert(' Already have an account');</script>";
            }
                 
        }   

       
            
            // Rider account created successfully
          
       
    }
 
  


     

  
    
}

    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
   
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
        .container-rd_signup{
     position:absolute;
     height: 100%;
     width:100%;
     top:0;
     left: 0;
     opacity:0.8;
     font-family: 'Poppins', sans-serif;
     font-weight:600;
    
    }
    .container-rd_signup::after{
        position:absolute;
        top:0;
        left:0;
        height: 100%;
        width:100%;
        content: "";
        z-index: -1;
        background: var(--primary-color);
        opacity: 0.65;}  

  
    
    
    #signup-form{
        margin-top:40px;
        margin-bottom:10px;
        margin-left: 10px;
        margin-bottom: 20px;
        display:grid;
        grid-template-columns:50% 50%;


    }

    #signup-form label{
           margin:20px 30px;
    }

    #signup-form input{
        width:210px;
        margin-left:30px;

    }

    #sign_up{
        position:absolute;
        top:90px;
        left:27%;
        height:auto;
        width:48%;
   
      
 
        border-radius: 3%;
        background-color:var(--primary-color);
        box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;     
      
   

    }
    .container-rd_signup label{
        margin:10px 30px;
        font-size: larger;
        color:white;

    }
    .container-rd_signup input{
        margin: 20px 30px;
        border-radius:10px;
        border: none;
        height:22px;
        width:220px;
    }
    
 

    .sign_upbtn{
        height:40px;
        width:93%;
        margin:7px 10px;
        color:var(--primary-color);
        background-color:white;
        border:none;
        border-radius:5px;
        font-size: larger;
    }
    .sign_upbtn:hover{
        color:white;
        background-color:var(--primary-color);
        border:1px solid white; 
    }
        </style>
</head>
<body>

<div class="container-rd_signup">
<div id="sign_up">
    <form id="signup-form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post"  onsubmit="return validateForm()">
    <div>
        <label>Username:</label><br>
        <input type="text" name="username" required><br>
    </div>
    <div>
        <label>Password : </label><br>
        <input type="password" name="password"  required><br>
    </div>
    <div>
        <label>Name: </label><br>
        <input type="text" name="rd_name" id="rd_name"  required><br>
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
        <input type="text" name="veh_no" id="veh_no"  required><br>
    </div>
    <div>
        <label>vehicle model: </label>
        <input type="text" name="veh_model" id="veh_model"  required><br>
    </div>
     
    
     
        <button type="submit" class="sign_upbtn" value="Submit" >SIGN UP</button>
     
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

