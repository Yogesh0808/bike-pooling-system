<?php
// Include database connection
include '../config/database.php';

// Debugging: Check if database connection is successful
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rider_id = $_POST['rider_id'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Not being used for validation, consider removing if not needed
    $pickup = $_POST['pickup'];
    $date = $_POST['date'];
    $destination = $_POST['destination'];
    $rd_amount = $_POST['rd_amount'];

    // Debugging: Log received POST data
    error_log("Received POST data: " . print_r($_POST, true));

    // Check if the user exists in the database
    $user_check_sql = "SELECT * FROM users WHERE username = ? AND rider_id = ?";
    $stmt = $conn->prepare($user_check_sql);
    $stmt->bind_param("ss", $username, $rider_id);
    $stmt->execute();
    $user_result = $stmt->get_result();

    if ($user_result->num_rows > 0) {
        // Insert ride details into the trips table
        $insert_sql = "INSERT INTO trips (rider_id, pickup, destination, date, rd_amount, username) 
                       VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("ssssss", $rider_id, $pickup, $destination, $date, $rd_amount, $username);
        
        if ($stmt->execute()) {
            echo "Ride successfully added!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "User not found!";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider Dashboard</title>
</head>
<body>

<h2>Your Rides:</h2>

<?php
// Fetch trips from database
$sql = "SELECT * FROM trips";
$result = $conn->query($sql);

// Debugging: Log fetched trip records
error_log("SQL Query: $sql");
error_log("Trip Records: " . print_r($result->fetch_all(MYSQLI_ASSOC), true));

if ($result->num_rows == 0) {
    echo "<h1>No record Found</h1>";
} else {
    echo '<div class="ride_div">';
    while ($row = $result->fetch_assoc()) {
        echo "<div class='ride_div_content'>";
        echo "<h4>Trip ID: " . htmlspecialchars($row["id"]) . "</h4>";
        echo "<h4>Pickup Location: " . htmlspecialchars($row["pickup"]) . "</h4>";
        echo "<h4>Drop Location: " . htmlspecialchars($row["destination"]) . "</h4>";
        echo "<h4>Date: " . htmlspecialchars($row["date"]) . "</h4>";
        echo "<h4>Amount: " . htmlspecialchars($row["rd_amount"]) . "</h4>";
        echo "</div>";
    }
    echo '</div>';
}
?>

<h1>Update Ride</h1>

<div class="update_ride">
    <form id="updrd_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label>Rider ID:</label>
        <input type="text" name="rider_id" required><br>

        <label>Username: </label>
        <input type="text" name="username" required><br>

        <label>Password: </label>
        <input type="password" name="password" required><br>

        <label>Pickup Location: </label>
        <input type="text" name="pickup" required><br>

        <label>Destination: </label>
        <input type="text" name="destination" required><br>

        <label>Date: </label>
        <input type="date" name="date"><br>

        <label>Amount for the Ride: </label>
        <input type="text" name="rd_amount"><br>

        <button type="submit">UPDATE RIDE</button>
    </form>
</div>

<script>
    // Debugging: Log trip data to browser console
    console.log("Fetching trip data...");
    fetch("<?php echo $_SERVER["PHP_SELF"]; ?>")
        .then(response => response.text())
        .then(data => console.log(data))
        .catch(error => console.error("Error fetching trip data:", error));
</script>

</body>
</html>
