<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
    

?>
<!DOCTYPE html>
<html lang="en" style = "overflow-x:hidden;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="stylechangedpass.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../Images/client_logo.ico">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
</head>

<div class = "header">
    <a href="../index.php"><img src = "Images/client_logo_use.png" alt = "Rootmates Clothing Logo"></a>
    <h3 style  = "color:white;">Rootmates <br> O-Store</h3>
    <nav>
    <form action="../index.php" method="post">
            <input id="searchBar" type="text" name="valueToSearch" placeholder="Search for Products">
            <button id = "searchbtn" type = "submit" value="Search" name="search"><i class = "fa fa-search"></i></button>
        </form>
            <button onclick="window.location.href='../notifications-page.php';" id = "notifbtn" type = "submit"><i class = "fa fa-bell fa-2x" style  = "color:white;"></i></button>
            
            <div class="dropdown">
            <button class = "dropbtn" id = "cartbtn" type = "submit"><i class = "fa fa-cart-plus fa-2x" style  = "color:white;"></i></button>
            <!--onclick="window.location.href='orders/cart-page.php';"
                onclick="window.location.href='account/manage-account.php';" 
             onclick="window.location.href='orders/order-page.php';" -->
             <div id="cartDropdown" class="dropdown-contentCart">
                <a href="../orders/cart-page.php">My Cart</a>
                <a href="../orders/order-page.php">My Orders</a>
            </div>
            </div>
            <div class="dropdown">
            <button class = "dropbtn" id = "profilebtn" type = "submit"><i class = "fa fa-user fa-2x" style  = "color:white;"></i></button>
            <div id="accountDropdown" class="dropdown-contentAccount">
                <a href="manage-account.php">Manage Account</a>
                
                <?php
                if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
                ?>
                <a href="logout.php">Logout</a>
                <?php }else {?>
                    <a href="login.php">Login</a>
             <?php }?>
            </div>
            </div>
    </nav>
</div>
<br>
<div class="container">
<body>
    <h2>Manage Account - Change Password</h2>
    <form action="changePass.php" method="post">    
        <fieldset style = "box-shadow:  3px 3px 3px 5px #ccc; background-color:lightgray;">    
            <div class="tit">
                <label id = "eventTitle">Old Password <br> </label>
                <input type = "password" id = "pass" name = "oldpass" class="title" placeholder = "Please enter old password"><br><br>
            </div>

            <div class="gag">
                <label id = "eventTitle">New Password <br> </label>
                <input type = "password" id = "pass" name = "newpass" class="title" placeholder = "Please enter new password"><br><br>
            </div>

            <div class="gag">
                <label id = "eventTitle">Repeat New Password <br> </label>
                <input type = "password" id = "pass" name = "repeatnewpass" class="title" placeholder = "Please enter repeat new password"><br><br>
            </div>

            <div class="but">
                <label id = "Submit"></label><input style = "background-color: lightblue;"type = "submit" value = "Change Password" class="bo1" onclick = "Forms()"><br>
                <button style = "background-color: #FF7276;"><a href = "manage-account.php" style = "font-weight:bold; color:black; text-decoration:none;">Cancel</a></button>
            </div>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
            </fieldset>
        </form>
</div>
</body>
<footer>
        <img src= "Images/tree.png" style = "position:fixed; z-index: -5; width: 200px; height: 100px; margin-left: -35px; margin-top: 20px;">
        <img src= "Images/tree.png" style = "position:fixed; z-index: -5; width: 200px; height: 100px; margin-left: 1305px; margin-top: 20px;">
    <div class = "footer" style = "margin-left: -10px; margin-top: 60px;">
    <h3 id = "follow" style  = "padding-left: 10px; color:white;">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x" style  = "color:white;"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x" style  = "color:white;"></i></a></h3>
    <h3 id = "partnership" style  = "color:white;">Want to work with us? Click <a  style = " text-decoration: underline; color:white;" href = "../marketing/marketreq-page.php"> here</a> to know more</h3>
    <h3 style="margin-left: 22%;"><a href="../about-Us.php" style=" text-decoration: none; color:white;">About Us</a></h3>
    </div>
</footer>
</html>
<?php
}else{
    header("Location: login.php");
    exit();
}
?>