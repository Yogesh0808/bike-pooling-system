<!-- public/contact.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@100&family=Inter:wght@200&family=Pacifico&family=Poppins:ital,wght@0,200;1,100&family=Sofia+Sans:wght@300&display=swap" rel="stylesheet">
</head>
<body>

    <?php include '../includes/header.php'; ?>

    <section class="contact-banner">
        <h1>Get in Touch</h1>
        <p>We would love to hear from you! Reach out with any inquiries.</p>
    </section>

    <section class="contact-container">
        <div class="contact-info">
            <h2>Contact Details</h2>
            <p><strong>Email:</strong> support@yourcompany.com</p>
            <p><strong>Phone:</strong> +91 98765 43210</p>
            <p><strong>Address:</strong> 123, Main Street, Bengaluru, India</p>
        </div>

        <div class="contact-form">
            <h2>Send Us a Message</h2>
            <form action="send_message.php" method="post">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Your Name" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Your Email" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="4" placeholder="Your Message" required></textarea>

                <button type="submit" class="submit-btn">Send Message</button>
            </form>
        </div>
    </section>

    <footer>
        <p>© 2025 Your Company. All rights reserved.</p>
    </footer>

</body>
</html>
