<?php
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $rider_id = $_POST['rider_id'];

    $sql = "SELECT * FROM trips WHERE rider_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $rider_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $rides = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        $rides = [];
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Rides</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        body {
            font-family: "Poppins", sans-serif;
        }
        .container {
            width: 50%;
            margin: auto;
            padding: 20px;
            text-align: center;
        }
        input, button {
            margin: 10px;
            padding: 10px;
        }
        .ride-card {
            border: 1px solid #f07900;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Check Your Rides</h2>
        <form method="post">
            <input type="text" name="rider_id" placeholder="Enter Rider ID" required>
            <button type="submit">Check Rides</button>
        </form>
        
        <?php if (isset($rides) && count($rides) > 0): ?>
            <h3>Your Rides:</h3>
            <?php foreach ($rides as $ride): ?>
                <div class="ride-card">
                    <p><strong>Pickup:</strong> <?php echo htmlspecialchars($ride['pickup']); ?></p>
                    <p><strong>Destination:</strong> <?php echo htmlspecialchars($ride['destination']); ?></p>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($ride['date']); ?></p>
                    <p><strong>Amount:</strong> <?php echo htmlspecialchars($ride['rd_amount']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php elseif (isset($rides)): ?>
            <p>No rides found for this Rider ID.</p>
        <?php endif; ?>
    </div>
</body>
</html>
