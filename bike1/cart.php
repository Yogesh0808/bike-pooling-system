
<?php
require 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@100&family=Inter:wght@200&family=Pacifico&family=Poppins:ital,wght@0,200;1,100&family=Sofia+Sans:wght@300&display=swap" rel="stylesheet">
<style>
    :root {
  --primary-color: #f07900;
}
.dark-theme {
  --primary-color: #d35100;
}
    body{
        font-family: 'Poppins', sans-serif;
        font-size:18px;
    }
    h2{
        font-size:28px;
        color:var(--primary-color);
        text-align:center;
    }
    div{
        display:flex;
        justify-content:center;
    }
    table{
        background:var(--primary-color);
       padding:20px;
        width:90%;
        border-radius:12px;
        

    }
   
    th{
        padding:20px;
        background:white;
        color:var(--primary-color);
    }
    td{
        border:1px solid white;
        padding:10px;
        color:white;
        
    }
    
    .button{
        height:40px;
        width:80%;
        margin:7px 10px;
        color:var(--primary-color);
        background-color:white;
        border:none;
        border-radius:5px;
        font-size: larger;
    }
    .button:hover{
        color:white;
        background-color:var(--primary-color);
        border:1px solid white; 
    }
    .img_row{
        background: rgba(255, 255, 255, 0.533);
    }
    .img_row img{
        width:100%;
        border-radius:20px;
    
    }
</style>
</head>
<body>
<h2>Cart Contents:</h2>


<div>
<?php
session_start();

// Function to delete item from cart
function deleteCartItem($index) {
    if (isset($_SESSION['cart'][$index])) {
        unset($_SESSION['cart'][$index]);
        // Reorder array keys
        $_SESSION['cart'] = array_values($_SESSION['cart']);
    }?>
    <script src="cart.js"></script>
<?php
}


// Check if form data is received
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['vechile_name'])) {
    // Retrieve form data
    $vehicleNames = $_POST['vechile_name'];
    $vehicleNumbers = $_POST['vechicle_no'];
    $rentDays = $_POST['rent_days'];
    $rentPrices = $_POST['rent_price'];
    $vechile_image = $_POST['vechile_image'];
    // Determine the number of items submitted
    $numItems = count($vehicleNames);

    // Store each item in the cart separately
    for ($i = 0; $i < $numItems; $i++) {
        // Combine form data into an array
        $cartItem = array(
            'vechile_name' => $vehicleNames[$i],
            'vechicle_no' => $vehicleNumbers[$i],
            'rent_days' => $rentDays[$i],
            'rent_price' => $rentPrices[$i],
            'vechile_image' => $vechile_image[$i]
        );

        // Add cart item to session
        $_SESSION['cart'][] = $cartItem;
    }
}

// Handle delete item request
if (isset($_POST['delete_index'])) {
    $deleteIndex = $_POST['delete_index'];
    deleteCartItem($deleteIndex);
}

// Display form data from session
if (!empty($_SESSION['cart'])) {

    echo "<table>";
    echo "<tr><th>Vehicle Image</th><th>Vehicle Name</th><th>Vechicle_no</th><th>Rent Days</th><th>Rent Price</th></tr>";
    foreach ($_SESSION['cart'] as $index => $cartItem) {
        echo "<tr>";
        // Output cart item details
       
        echo "<td class='img_row'><img src='data:image/jpeg;base64," . (is_array($cartItem['vechile_image']) ? implode("<br>", $cartItem['vechile_image']) : $cartItem['vechile_image']) . "'></td>";


        echo "<td>" . (is_array($cartItem['vechile_name']) ? implode("<br>", $cartItem['vechile_name']) : $cartItem['vechile_name']) . "</td>";
        echo "<td>" . (is_array($cartItem['vechicle_no']) ? implode("<br>", $cartItem['vechicle_no']) : $cartItem['vechicle_no']) . "</td>";
        echo "<td>" . (is_array($cartItem['rent_days']) ? implode("<br>", $cartItem['rent_days']) : $cartItem['rent_days']) . "</td>";
        echo "<td> <h4>Rs.</h4>".  (is_array($cartItem['rent_price']) ? implode("<br>", $cartItem['rent_price']) : $cartItem['rent_price']) . "</td>";
        // Add delete button with a form
        echo "<td>";
        echo "<form method='post' action=''>";
        echo "<input type='hidden' name='delete_index' value='$index'>";
        echo "<input type='submit' value='Delete' class='button'>";
        echo "</form>";
        echo "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    // If cart is empty, display a message
    echo "Cart is empty.";
}
?>

</div> 
<script src="script.js"> </script> 
</body>
</html>
