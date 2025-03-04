<?php
// Include database connection
include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $message = htmlspecialchars($_POST["message"]);

    try {
        // Insert message into the database
        $stmt = $conn->prepare("INSERT INTO messages (name, email, message) VALUES (:name, :email, :message)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':message', $message);
        $stmt->execute();
    } catch (PDOException $e) {
        die("Error inserting message: " . $e->getMessage());
    }
}

// Fetch latest message
$latestMessage = $conn->query("SELECT * FROM messages ORDER BY id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);

// Fetch all messages
$allMessages = $conn->query("SELECT * FROM messages ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Received</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(129deg, rgba(240, 121, 0, 1) 0%, rgb(223 102 27) 55%, rgba(255, 255, 255, 1) 98%);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            text-align: center;
            margin-bottom: 20px;
        }
        h2 {
            color: #f07900;
        }
        p {
            font-size: 18px;
            margin: 10px 0;
        }
        .back-btn {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 20px;
            text-decoration: none;
            background: #f07900;
            color: #fff;
            border-radius: 5px;
        }
        .back-btn:hover {
            background: #0056b3;
        }
        .message-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            border-radius: 20px;
        }
        .message-table th, .message-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .message-table th {
            background-color: #f07900;
            color: white;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Message Received</h2>
        <?php if ($latestMessage): ?>
            <p><strong>Name:</strong> <?= $latestMessage['name'] ?></p>
            <p><strong>Email:</strong> <?= $latestMessage['email'] ?></p>
            <p><strong>Message:</strong></p>
            <p><?= nl2br($latestMessage['message']) ?></p>
        <?php else: ?>
            <p>No messages received yet.</p>
        <?php endif; ?>
        <a href="contact.php" class="back-btn">Go Back</a>
    </div>

    <div class="container">
        <h2>All Messages</h2>
        <table class="message-table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Received At</th>
            </tr>
            <?php if (!empty($allMessages)): ?>
                <?php foreach ($allMessages as $msg): ?>
                    <tr>
                        <td><?= $msg['id'] ?></td>
                        <td><?= htmlspecialchars($msg['name']) ?></td>
                        <td><?= htmlspecialchars($msg['email']) ?></td>
                        <td><?= nl2br(htmlspecialchars($msg['message'])) ?></td>
                        <td><?= $msg['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="5">No messages found.</td></tr>
            <?php endif; ?>
        </table>
    </div>

</body>
</html>
