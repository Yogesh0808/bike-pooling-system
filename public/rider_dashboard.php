<?php
include '../config/database.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (!isset($_POST['rider_id'], $_POST['rider_username'], $_POST['password'], $_POST['pickup'], $_POST['date'], $_POST['destination'], $_POST['rd_amount'])) {
        die("All form fields are required.");
    }

    $rider_id = $_POST['rider_id'];
    $rider_username = $_POST['rider_username'];
    $password = $_POST['password'];
    $pickup = $_POST['pickup'];
    $gender = "Male"; // Hardcoded for now
    $date = $_POST['date'];
    $destination = $_POST['destination'];
    $rd_amount = floatval($_POST['rd_amount']); // Convert to float

    // Check if the user exists
    $user_check_sql = "SELECT * FROM riders WHERE rider_username = :rider_username AND rider_id = :rider_id";
    $stmt = $conn->prepare($user_check_sql);
    $stmt->execute([
        ':rider_username' => $rider_username,
        ':rider_id' => $rider_id
    ]);
    $user_result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user_result) {
        // Insert trip details
        $insert_sql = "INSERT INTO trips (rider_id, pickup, destination, date, rd_amount, gender) 
                       VALUES (:rider_id, :pickup, :destination, :date, :rd_amount, :gender)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->execute([
            ':rider_id' => $rider_id,
            ':pickup' => $pickup,
            ':destination' => $destination,
            ':date' => $date,
            ':rd_amount' => $rd_amount,
            ':gender' => $gender
        ]);

        if ($stmt->rowCount() > 0) {
            echo "Ride successfully added!";
        } else {
            echo "Error: Failed to add ride.";
        }
    } else {
        echo "User not found!";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rider Dashboard</title>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="../assets/css/style.css" rel="stylesheet">
  <link
    href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@100&family=Inter:wght@200&family=Pacifico&family=Poppins:ital,wght@0,200;1,100&family=Sofia+Sans:wght@300&display=swap"
    rel="stylesheet">
    <style>
    :root {
      --primary-color: #f07900;
    }

    .dark-theme {
      --primary-color: #d35100;
    }

    body {
      margin: 0px;
      font-family: "Poppins", sans-serif;
    }

    .ride_details {
      margin-top: 80px;
      padding: 20px;
    }

    .ride_detials h2 {
      color: var(--primary-color);
      font-family: "Poppins", sans-serif;
      font-style: bold;
      font-size: 28px;
      margin: 30px 30px;
    }

    .ride_detials h4 {
      font-size: 16px;
      text-align: left;
    }

    h1 {
      color: var(--primary-color);
      font-family: "Poppins", sans-serif;
      font-style: bold;
      text-align: center;
    }

    .update_ride {
      height: auto;
      width: 100%;
      display: flex;
      justify-content: center;
      margin-top: 40px; /* Added margin to separate form from cards */
      margin-bottom: 40px; /* Added margin for spacing at the bottom */
    }

    #updrd_form {
      background: var(--primary-color);
      height: auto; /* Changed to auto to accommodate all fields */
      width: 40%;
      display: grid;
      grid-template-columns: 50% 50%;
      border-radius: 10px;
      padding: 20px;
      gap: 20px;
    }

    #updrd_form label {
      margin: 20px 30px 10px; /* Adjusted margin for better spacing */
      font-size: larger;
      color: white;
    }

    #updrd_form input {
      width: 80%; /* Adjusted width to fit container */
      margin: 10px 30px;
      border-radius: 10px;
      border: none;
      height: 22px;
      outline: none;
      padding: 10px;
    }

    #updrd_form button {
      height: 50px;
      width: 93%;
      margin: 20px 10px; /* Adjusted margin for better spacing */
      color: var(--primary-color);
      background-color: white;
      border: none;
      border-radius: 5px;
      font-size: larger;
      cursor: pointer; /* Added cursor pointer for better UX */
    }

    #updrd_form button:hover {
      color: white;
      background-color: var(--primary-color);
      border: 1px solid white;
    }

    .ride_div {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); /* Responsive grid */
      gap: 20px; /* Added gap between cards */
      padding: 20px; /* Added padding for better spacing */
    }

    .ride_div .ride_div_content {
      height: auto; /* Changed to auto to accommodate content */
      width: 100%; /* Adjusted width to fit container */
      background-color: var(--primary-color);
      color: white;
      padding: 20px;
      border-radius: 20px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Added shadow for better UI */
    }

    .ride_div .ride_div_content h4 {
      margin: 10px 0; /* Adjusted margin for better spacing */
    }
</style>
</head>

<body>
  <?php include '../includes/header.php'; ?>
  <div class="ride_details">

    <h2>Your Rides:</h2>
    <?php
    $sql = "SELECT * FROM trips";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($result) == 0) { ?>
        <h1>No record Found</h1>
    <?php } else { ?>
        <div class="ride_div">
            <?php
            $i = 1;
            foreach ($result as $row) { ?>
                <div class="ride_div_content">
                    <h4>Trip <?php echo $i; ?> </h4>
                    <h4>Pickup Location: <?php echo htmlspecialchars($row["pickup"]); ?></h4>
                    <h4>Drop Location: <?php echo htmlspecialchars($row["destination"]); ?></h4>
                    <h4>Date: <?php echo htmlspecialchars($row["date"]); ?></h4>
                    <h4>Amount of the ride: <?php echo htmlspecialchars($row["rd_amount"]); ?></h4>
                </div>
            <?php $i++; } ?>
        </div>
    <?php } ?>

          </div>
        </div>
        <h1 style="text-align:left; margin-left:1%">Update Ride</h1>
        <div class="update_ride">
        <form id="updrd_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <div>
        <label>Rider ID:</label><br>
        <input type="text" name="rider_id" required><br>
    </div>
    <div>
        <label>Username: </label><br>
        <input type="text" name="rider_username" id="rider_username" required><br>
    </div>
    <div>
        <label>Password: </label><br>
        <input type="text" name="password" id="password_rd" required><br>
    </div>
    <div>
        <label>Pickup Location: </label><br>
        <input type="text" name="pickup" id="pickup" required><br>
    </div>
    <div>
        <label>Destination: </label>
        <input type="text" name="destination" id="destination" required><br>
    </div>
    <div>
        <label>Date: </label><br>
        <input type="date" name="date" id="date"><br>
    </div>
    <div>
        <label>Amount for the Ride: </label><br>
        <input type="text" name="rd_amount" id="rd_amount"><br>
    </div>
    <button type="submit" class="sign_upbtn" value="Submit">UPDATE RIDE</button>
</form>
        </div>

        <script src="script.js">
        </script>
</body>

</html>