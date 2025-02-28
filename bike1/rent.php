<?php
require 'conn.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Bike</title>
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
body {
  margin: 0px;
  font-family: 'Poppins', sans-serif;
  
}
    form{
        display:flex;
        justify-content:center;
        width:100%;
        margin-top:30px;
    }
    form input{
        border-radius:12px;
        outline:none;
        border:2px solid var(--primary-color);
       height:30px;
       width:30%;
       margin-right:20px;
    }
select{
    border:none;
    outline:none;
    display:none;
    
}
select option{

}
form button{
    border: 1px solid #efefef;
  font-family: "Poppins", sans-serif;
  width: 100px;
  color: #efefef;
  font-size: 18px;
  padding: auto auto;
  background: var(--primary-color);
  border-radius: 5px;
  transition: 0.2s ease-in-out;
  margin-left:20px;
}
form button:hover{
background: #efefef;
  color: var(--primary-color);
  border: 1px solid var(--primary-color);
}
.display_bike{
    display:grid;
    grid-template-columns:33% 33% 33%;
   gap:10px;
   place-items: center; 
  justify-items: center;
  margin-top:30px;
}
.display_div{
    height:300px;
    width:80%;
    
    margin:20px;
    border-radius:13px;
    background: var(--primary-color);
   
    box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
}
.image_div{
   height:50%;
   width:100%;
    position: relative;
    box-shadow: rgba(50, 50, 93, 0.25) 0px 30px 60px -12px inset, rgba(0, 0, 0, 0.3) 0px 18px 36px -18px inset;
}
.image_div img{
    height:100%;
    width:100%;
    position:absolute;
    top:0;
    left:0;
    
}
.display_div h4{
    margin:2px 30px;
    width:80%;
    color:white;
    text-align:justify;
}

.display_div button{
  height: 30px;
  width:45%;
  margin: 7px 10px;
  color: var(--primary-color);
  background-color: white;
  border: none;
  border-radius: 5px;
  font-size: larger;
  margin-left:53%;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px;
}
.display_div button:hover {
  color: white;
  background-color: var(--primary-color);
  border: 1px solid white;
}
.cart{
    position: relative;
}
.cart img{
    height:30px;
    width:40px;
    margin-left:20px;
   
}


a{
    text-decoration:none;
}
</style>
</head>
<body>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <input type="text" name="search" placeholder="Search...">
    <img src="filter.png" id="filter-img">
    <select name="filter">
        <option value="all">All</option>
        <option value="30">Rent Less than 30 days</option>
        <option value="31">Rent greater than 30 days</option>
        <!-- Add more filter options as needed -->
    </select>
    <button type="submit">Search</button>
   <a href="cart.php" ><div class="cart" >
        <img src="cart.png">
        
    </div>
</a>
</form>

<div class="display_bike">
    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
        $search = $_POST['search'];
        $filter = $_POST['filter'];
        
        // Construct the SQL query based on the filter option
        if ($filter == 'all') {
            $sql = "SELECT * FROM rent_vechicle WHERE vechile_name LIKE '%$search%'";
        } 
        else if($filter == '30') {
            $sql = "SELECT * FROM rent_vechicle WHERE rent_days <= '$filter'";
        }
        else{
            $sql = "SELECT * FROM rent_vechicle WHERE rent_days >= '$filter'";
        }
$result = $conn->query($sql);

$i = 0; // Initialize the loop counter variable
if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
?>
        <div class="display_div">
            <div class="image_div">
                <?php echo '<img src="data:image/jpeg;base64,' . base64_encode($row['vechicle_image']) . '" />'; ?>
            </div>
            <h4>Vehicle Name: <?php echo $row['vechile_name'] ?></h4>
            <h4>Vehicle No: <?php echo $row['vechicle_no'] ?></h4>
            <h4>Rent Days: <?php echo $row['rent_days'] ?></h4>
            <h4>Rent Amount: <?php echo $row['rent_price'] ?></h4>

            <button id="crt_bt_<?php echo $i ?>" class="crt_bt" onclick="addToCart('<?php echo $row['vechile_name'] ?>', '<?php echo $row['vechicle_no'] ?>', '<?php echo $row['rent_days'] ?>', '<?php echo $row['rent_price'] ?>','<?php echo  base64_encode($row['vechicle_image']); ?>' ) ">Add to Cart</button>

       
        </div>

        <script>
            // Add click event listener to the button
            document.getElementById("crt_bt_<?php echo $i ?>").addEventListener("click", () => {
                var button = document.getElementById("crt_bt_<?php echo $i ?>");
                if (button.innerHTML === "Add to Cart") {
                    button.innerHTML = "Cart Added";
                    // Store the new button text in localStorage
                    localStorage.setItem("buttonText_<?php echo $i ?>", "Cart Added");
                } else {
                    button.innerHTML = "Add to Cart";
                    // Remove the stored button text from localStorage
                    localStorage.removeItem("buttonText_<?php echo $i ?>");
                }
            
            });

            // Check if the button text is stored in localStorage
            if (localStorage.getItem("buttonText_<?php echo $i ?>")) {
                // If so, set the button text accordingly
                document.getElementById("crt_bt_<?php echo $i ?>").innerHTML = localStorage.getItem("buttonText_<?php echo $i ?>");
            }
        </script>
<?php
        $i++; // Increment the loop counter variable
    }
}
else{
    echo "<h3>No items found <h3>";
}


    }
?>
   </div>   

 
<script>
var filter = document.getElementById("filter-img");
filter.addEventListener('click', () => {
    var filter_select = document.getElementsByTagName('select')[0];
   if(filter_select.style.display =="block"){
    filter_select.style.display ="none";
   }
   else{
    filter_select.style.display ="block"
   }
});
</script>
<script>
function addToCart(name, number, days, price, img) {
    // Create a form
    var form = document.createElement('form');
    form.method = 'post';
    form.action = 'cart.php'; // Specify the URL of your cart page

    // Create hidden input fields to send data
    var nameField = document.createElement('input');
    nameField.type = 'hidden';
    nameField.name = 'vechile_name[]';
    nameField.value = name;
    form.appendChild(nameField);

    var numberField = document.createElement('input');
    numberField.type = 'hidden';
    numberField.name = 'vechicle_no[]';
    numberField.value = number;
    form.appendChild(numberField);

    var daysField = document.createElement('input');
    daysField.type = 'hidden';
    daysField.name = 'rent_days[]';
    daysField.value = days;
    form.appendChild(daysField);

    var priceField = document.createElement('input');
    priceField.type = 'hidden';
    priceField.name = 'rent_price[]';
    priceField.value = price;
    form.appendChild(priceField);

    var imgField = document.createElement('input');
    imgField.type = 'hidden';
    imgField.name = 'vechile_image[]';
    imgField.value = img; // Pass the image URL here
    form.appendChild(imgField);

    // Append the form to the body and submit it
    document.body.appendChild(form);
    form.submit();
}





</script>
<script src="cart.js"></script>
</body>
</html>