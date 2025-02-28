<?php
include '../config/database.php';
include '../includes/session.php';
include '../includes/header.php'; // Including the header file

// Create connection
$conn = new mysqli($host, $username, $password, $db_name);

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
    <title>Search Rides</title>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F27900;
            color: #FAE4D8;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start; /* Align to top */
            min-height: 100vh;
        }
        .search-box {
            background: #FAE4D8;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 10px;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            max-width: 600px;
            width: 90%;
            margin-top: 100px;
            color: #333;
        }
        .search-box div {
            display: flex;
            align-items: center;
            gap: 8px;
            background: white;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ddd;
        }
        .search-box i {
            font-size: 18px;
            color: #F27900;
        }
        .search-box input {
            border: none;
            outline: none;
            font-size: 14px;
            padding: 6px;
            width: 100%;
            font-family: 'Poppins', sans-serif;
        }
        .search-box button {
            background: #F27900;
            color: #FAE4D8;
            padding: 12px 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: 600;
            transition: background 0.3s ease-in-out;
        }
        .search-box button:hover {
            background: #d96c00;
        }
        .ride-card {
            background: #FAE4D8;
            margin: 20px 10px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 600px;
            color: #333;
            box-sizing: border-box;
            display: block;
            text-align: left;
        }
        .ride-card h2 {
            font-size: 18px;
            margin: 5px 0 10px;
            color: #F27900;
        }
        .ride-card p {
            margin: 5px 0;
        }
        @media (max-width: 600px) {
            .search-box {
                flex-direction: column;
                align-items: stretch;
            }
            .search-box div, .search-box button {
                width: 100%;
            }
        }
    </style>
</head>
<body>

<form action="" method="post">
    <div class="search-box">
        <div class="pickup">
            <i class="fa-solid fa-location-dot"></i>
            <input type="text" placeholder="Leaving From" name="pickup" />
        </div>
        <div class="destination">
            <i class="fa-solid fa-location-dot"></i>
            <input type="text" placeholder="Destination" name="destination" />
        </div>
        <div class="date">
            <i class="fa-solid fa-calendar"></i>
            <input type="date" name="date" />
        </div>
        <div class="no">
            <i class="fa-solid fa-user"></i>
            <input type="number" placeholder="No of Persons" name="person_no" min="1" />
        </div>
        <button type="submit">Search</button>
    </div>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pickup = !empty($_POST["pickup"]) ? trim($_POST["pickup"]) : null;
    $destination = !empty($_POST["destination"]) ? trim($_POST["destination"]) : null;
    $date = !empty($_POST["date"]) ? $_POST["date"] : null;
    $person_no = !empty($_POST["person_no"]) ? (int) $_POST["person_no"] : null;

    $sql = "SELECT * FROM rider_details WHERE 1=1";
    $params = [];
    $types = "";

    if ($pickup) {
        $sql .= " AND pickup = ?";
        $params[] = $pickup;
        $types .= "s";
    }
    if ($destination) {
        $sql .= " AND destination = ?";
        $params[] = $destination;
        $types .= "s";
    }
    if ($date) {
        $sql .= " AND date = ?";
        $params[] = $date;
        $types .= "s";
    }
    if ($person_no) {
        $sql .= " AND person_no = ?";
        $params[] = $person_no;
        $types .= "i";
    }

    $stmt = $conn->prepare($sql);
    if (!empty($params)) {
        $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="ride-card">
                <h2><?php echo htmlspecialchars($row["pickup"]) . " to " . htmlspecialchars($row["destination"]); ?></h2>
                <p><strong>Date:</strong> <?php echo htmlspecialchars($row["date"]); ?></p>
                <p><strong>Persons:</strong> <?php echo htmlspecialchars($row["person_no"]); ?></p>
            </div>
            <?php
        }
    } else {
        echo "<p style='color: #FAE4D8; margin-top: 20px;'>No matching rides found.</p>";
    }
    $stmt->close();
}
$conn->close();
?>

</body>
</html>