<?php
    session_start();
    include("config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: login.php");
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Edit Profile</title>

</head>
<body>
    <div class="hero">
        <nav>
            <a href="home.html" class="logo"></a>
            
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">Feature</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <img src="login.png" class="user-pic" onclick="toggleMenu()">

            <div class="sub-menu-wrap" id="subMenu">
                <div class="sub-menu">
                    <div class="user-info">
                        <img src="login.png" style="margin-right: 10px;">
                        <h3>Hai Lat</h3> 


                    </div>
                    <hr>
                    <a href="login.html" class="sub-menu-link">
                        <img src="./icon/login.png">
                        <p>Login</p>
                        <span>></span>

                    </a>
                    <a href="register.html" class="sub-menu-link">
                        <img src="./icon/signin.png" style="height: 40px; width: 40px;">
                        <p>Sign In</p>
                        <span>></span>

                    </a>
                    <a href="edit.html" class="sub-menu-link">
                        <img src="./icon/edit.png"  >
                        <p>Edit Profile</p>
                        <span>></span>

                    </a>

                    <a href="#" class="sub-menu-link">
                        <img src="./icon/logout.png"  >
                        <p>Log Out</p>
                        <span>></span>

                    </a>
                    

                </div>

            </div>

        </nav>
    </div>
<script>
    let subMenu=document.getElementById("subMenu");

    function toggleMenu(){
        subMenu.classList.toggle("open-menu");
    }

</script>
<div class="container">
    <div class="kotak form-kotak">

        <?php
            if(isset($_POST['submit'])){
                $name=$_POST['name'];
                $username=$_POST['username'];
                $password=$_POST['password'];
                $address=$_POST['address'];
                $phonenumber=$_POST['phonenumber'];
                $email=$_POST['email'];
                $id=$_SESSION['id'];

                $edit_query=mysqli_query($con, "UPDATE food_vendor SET Vendor_Name='$name', Vendor_Username='$username', Vendor_Password='$password', Vendor_Address= '$address', Vendor_PhoneNum='$phonenumber', Vendor_Email='$email' WHERE Vendor_ID=$id") or die("error occurred");
                if($edit_query){
                    echo "<div class='message'>
                    <p>Registration successfully!</p>
                    </div><br>";
                    echo "<a href='homefoodvendor.php'><button class='btn'>Go Home</button>";
                }

            }else{
                $id=$_SESSION['id'];
                $query=mysqli_query($con, "SELECT * FROM food_vendor WHERE Vendor_ID='$id'");

                while($result= mysqli_fetch_assoc($query)){
                    $res_name=$result['Vendor_Name'];
                    $res_username=$result['Vendor_Username'];
                    $res_password=$result['Vendor_Password'];
                    $res_address=$result['Vendor_Address'];
                    $res_phonenumber=$result['Vendor_PhoneNum'];
                    $res_email=$result['Vendor_Email'];
                    
                }
            
        ?>
        <header>Edit Profile</header>
        <form action="" method="post">
            <div class="field input">
                <label for="Name">Name</label>
                <input type="text" name="name" id="name" value="<?php echo $res_name?>" placeholder="   Name.." required>
            </div>
            <div class="field input">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" value="<?php echo $res_username?>" placeholder="   Username.." required>
            </div>

            <div class="field input">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" value="<?php echo $res_password?>" placeholder="   Password.." required>
            </div>

            <div class="field input">
                <label for="address">Address</label>
                <input type="text" name="address" id="address"  value="<?php echo $res_address?>"placeholder="  Address.." required>
            </div>

            <div class="field input">
                <label for="phonenumber">Phone Number</label>
                <input type="text" name="phonenumber" id="phonenumber"  value="<?php echo $res_phonenumber?>" placeholder=" Phone number..." required>
            </div>

            <div class="field input">
                <label for="email">Email</label>
                <input type="text" name="email" id="email"  value="<?php echo $res_email?>" placeholder=" Email..." required>
            </div>


            <div class="field">
                <input type="submit" name="submit" class="btn" value="Save" required>
            </div>

            

        </form>

    </div>
    <?php }?>
</div>


</body>
</html>
