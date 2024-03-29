<?php
    session_start();
    include("config.php");
    if(!isset($_SESSION['id'])){
        header("Location: ../login.php");
    }
    
    
                $select_rows = mysqli_query($con, "SELECT * FROM `menu`") or die ('query failed');
                $row_count = mysqli_num_rows($select_rows);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Registered User</title>
    <link rel="stylesheet" href="/WebProject/Module1/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body>
    <div class="hero">
        <nav>
            <a href="/WebProject/Module3/home.php" class="logo"></a>
        
            <ul>
            <li><a href="/WebProject/Module3/home.php">Home</a></li>
                <li><a href="Orderlist.php">OrderList</a></li> 
                <li><a href="/WebProject/Module3/cart1.php" class="cart">cart <span><?php echo $row_count;?></span></a></li>
            </ul>
            <div id="menu-btn" class="fas fa-bars"></div>
            <img src="/WebProject/Module1/login.png" class="user-pic" onclick="toggleMenu()">


            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">

                
                    <div class="user-info">
                        <img src="/WebProject/Module1/login.png" style="margin-right: 10px;">
                        <?php
                        $id=$_SESSION['id'];
                        
                        
                        $res_name=null;
                        $query= mysqli_query($con, "SELECT * FROM registered_user where ID='$id'");
                        if (!$query) {
                            die("Query failed: " . mysqli_error($con));
                        }
                    
                        // Check if there are any results
                        if ($result = mysqli_fetch_assoc($query)) {
                            $res_name = $result['Name'];
                            echo "<h3>$res_name</h3>";
                        } else {
                            echo "<h3>No Name Found</h3>"; // or handle the case where the name is not found
                        }
                        
                    
    ?>
                    </div>
                    <hr>
                    <div>
                    <?php

                    $id=$_SESSION['id'];
                    $query= mysqli_query($con, "SELECT * FROM registered_user where ID='$id'");

                    $res_id=null;
                    while($result= mysqli_fetch_assoc($query)){
                        $res_name=$result['Name'];
                        $res_username=$result['Username'];
                        $res_password=$result['Password'];
                        $res_address=$result['Address'];
                        $res_phonenumber=$result['Phonenumber'];
                        $res_id=$result['ID'];
                    }

                   

                   
                     echo "<a href='/WebProject/Module1/edit.php?Id=$res_id' class='sub-menu-link'>
                    <img src='/WebProject/Module1/icon/edit.png' >
                    <p>Edit Profile</p>
                    <span>></span>
                    </a>";



                    

                    echo "<a href='/WebProject/Module1/logout.php' class='sub-menu-link'>
                        <img src='/WebProject/Module1/icon/logout.png' >
                        <p>Log Out</p>
                        <span>></span>

                    </a>";

                    ?>
                    



                    </div>
                    

                </div>

            </div>

        </nav>
    </div>
    
                    
<div class=container2>
    <?php

$con = mysqli_connect("localhost","root","")or die (mysqli_connect_error());
mysqli_select_db($con,"project")or die(mysqli_error($con));


$query = mysqli_query($con, "SELECT * FROM menu WHERE FoodStatus = 1");

echo '<style>';
echo 'h2 { font-size: 24px; margin-bottom: 20px; }';
echo '.card { background-color: #fff; border-radius: 10px; padding: 20px; margin: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); text-align: center; }';
echo '.card img { max-width: 100%; border-radius: 5px; margin-bottom: 10px; }';
echo '.card h3 { margin-top: 10px; font-size: 20px; }';
echo '.card p { color: #555; margin-bottom: 10px; }';
echo '.card__order-button { background-color: #333; color: #fff; border: none; padding: 10px 20px; cursor: pointer; border-radius: 5px; font-size: 16px; }';
echo '</style>';

echo '<h2>Menu</h2>';

while ($row = mysqli_fetch_assoc($query)) {
    $foodImageFilePath = $row['FoodImage'];

    echo '<div class="card">';
    echo '<img src="\WebProject\Module2\\' . $foodImageFilePath . '" alt="Food Image">';
    echo '<h3>' . $row['Foodname'] . '</h3>';
    echo '<p>' . $row['FoodDescription'] . '</p>';
    echo '<p>Available Set: ' . $row['FoodQuantity'] . '</p>';
    echo '<p>RM ' . $row['FoodPrice'] . '</p>';
    // Add a data attribute with the food ID
    echo '<button class="btn btn-info btn-block addItemBtn" data-foodid="' . $row['ID'] . '"><i class="fas fa-cart-plus"></i>&nbsp;&nbsp;Add to cart</button>';
    echo '</div>';
}

echo '</div>';
?>
    <?php

        echo '</div>';
    

    echo '</div>';
?>
</div>
  
                        
<script>
    // Add an event listener to the parent container to handle button clicks
    document.addEventListener('click', function (event) {
        // Check if the clicked element has the class 'addItemBtn'
        if (event.target.classList.contains('addItemBtn')) {
            // Get the data-foodid attribute value
            const foodId = event.target.getAttribute('data-foodid');
            addToCart(foodId);
        }
    });

    function addToCart(foodId) {
        // Make an AJAX request to add the item to the cart
        fetch('cart1.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                foodId: foodId,
            }),
        })
        .then(response => response.json())
        .then(data => {
            // Update the cart count in the small trolley icon
            updateCartCount(data.cartCount);

            // Display a pop-up message
            alert('Item added to cart!');
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }

    function updateCartCount(count) {
        // Update the small trolley icon with the item count
        document.getElementById('cartCount').innerText = count;
    }

    let subMenu = document.getElementById("subMenu");

    function toggleMenu() {
        subMenu.classList.toggle("open-menu");
    }
</script>


</body>


</html>