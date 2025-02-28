<?php
// Connect to the MySQL database
$servername = "localhost"; // Change this to your MySQL server's hostname
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password
$database = "db"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Search</title>

</head>
<body>
  
</body>
</html>

<form action="" method="post">
  <div class="search-box">
    <div class="pickup">
      <img src="icons8-location-64.png" />
      <input type="text" placeholder="Leaving From" name="pickup" />
    </div>
    <div class="destination">
      <img src="icons8-location-64.png" />
      <input type="text" placeholder="Destination" name="destination" />
    </div>
    <div class="date">
      <img src="icons8-date-64.png" />
      <input type="date" placeholder="Date" name="date" />
    </div>
    <div class="no">
      <img src="icons8-person-50.png" />
      <input type="text" placeholder="No of Persons" name="person_no" />
    </div>
    <button type="submit">Submit</button>
  </div>
  
</form>
<?php 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $pickup = $_POST["pickup"];
    $destination = $_POST["destination"];
    $date = $_POST["date"];
    $person_no = $_POST["person_no"];

    // Construct SQL query
    $sql = "SELECT * FROM ride_detials WHERE pickup = '$pickup' AND destination = '$destination' AND date = '$date' AND person_no = '$person_no'";

    // Execute query
    $result = $conn->query($sql);

    // Check if there are any matching items
    if ($result->num_rows > 0) {
        // Output data of each matching item
        while($row = $result->fetch_assoc()) {
        ?>
        <div class="user-info">
    <h2>Pickup:<?php echo  $row["pickup"] ; ?></h2>
    <h2>destination:<?php echo  $row["destination"] ; ?></h2>
    <h2>date:<?php echo  $row["date"] ; ?></h2>
    <h2>person_no:<?php echo  $row["person_no"] ; ?></h2>
    
  
           </div>
    <?php

        }
    } else {
        echo "No matching items found";
       

    }
}

// Close the connection
$conn->close();
?>




