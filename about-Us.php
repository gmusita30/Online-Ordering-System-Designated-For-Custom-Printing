<?php
session_start();
include "product-Verify.php";

?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link rel="icon" href="Images/client_logo.ico">
    <link rel = "stylesheet" href = "about-Us.css?v=<?php echo time(); ?>">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>View Product</title>
</head>
<header>
    <div class = "header">
        <a href="index.php"><img src = "Images/client_logo.png" alt = "Rootmates Clothing Logo"></a>
        <h3 style  = "color:white;">Rootmates <br> O-Store</h3>
        <nav>
        <form action="index.php" method="post">
            <input id="searchBar" type="text" name="valueToSearch" placeholder="Search for Products">
            <button id = "searchbtn" type = "submit" value="Search" name="search"><i class = "fa fa-search"></i></button>
        </form>
        <button onclick="window.location.href='notifications-page.php';" id = "notifbtn" type = "submit"><i class = "fa fa-bell fa-2x" style  = "color:white;"></i></button>
            
            <div class="dropdown">
            <button class = "dropbtn" id = "cartbtn" type = "submit"><i class = "fa fa-cart-plus fa-2x" style  = "color:white;"></i></button>
            <!--onclick="window.location.href='orders/cart-page.php';"
                onclick="window.location.href='account/manage-account.php';" 
             onclick="window.location.href='orders/order-page.php';" -->
             <div id="cartDropdown" class="dropdown-contentCart">
                <a href="orders/cart-page.php">My Cart</a>
                <a href="orders/order-page.php">My Orders</a>
            </div>
            </div>

            <div class="dropdown">
            <button class = "dropbtn" id = "profilebtn" type = "submit"><i class = "fa fa-user fa-2x" style  = "color:white;"></i></button>
            <div id="accountDropdown" class="dropdown-contentAccount">
                <a href="account/manage-account.php">Manage Account</a>
                <?php
                if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
                    $customerID = $_SESSION['customerID'];
                ?>
                <a href="account/logout.php">Logout</a>
                <?php }else {?>
                    <a href="account/login.php">Login</a>
             <?php }?>
            </div>
            </div>

        </nav>
    </div>
</header>

<body>
    <div class = "content0">
        <h1>About Us</h1>
        </div>
    <div id = "product-wrap">
    <div id = "product-scroller">
    <div class = "content1">
        <h2>Business Background</h2>
        <p>Rootmate’s Clothing is a new business that is primarily focused on printing unique custom T-shirts</p>
        <img src = "Images/Rootmates Clothing Brand.jpg"></a>
        <h2>Rootmate's Clothing Members:</h2>
        <img src = "Images/Client Organization Chart 2.png"></a>
        <h2>Rootmate's Clothing Physical Store:</h2>
        <p>Block 95 Lot 15 Waterlily St. Rizal, Makati City</p>
        <h2>Business Contact Number:</h2>
        <p>09123456789</p>
        <h2 id = "follow2">Visit Our Facebook and Instagram Page: &nbsp; </h2>
        <p>
        <p style = "color:blue;"><a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x"></i></a> https://www.facebook.com/Rootmates
        <br><a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x"></i></a> https://www.instagram.com/rootmates </p>    
        </p>
    </div>
</div>
        <img src= "Images/tree.png" style = "position:absolute; z-index: -5; width: 200px; height: 100px; margin-left: -10px; margin-top: 20px;">
        <img src= "Images/tree.png" style = "position:absolute; z-index: -5; width: 200px; height: 100px; margin-left: 1300px; margin-top: 20px;">
</div>
<div id = "table-scroller1">
<div class = "footer" style = "padding-left: 20px; margin-left: -10px;">
    <h3 id = "follow" style  = "color:white;">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x" style  = "color:white;"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x" style  = "color:white;"></i></a></h3>
    <h3 id = "partnership" style  = "color:white;">Want to work with us? Click <a  style = " text-decoration: underline; color:white;" href = "marketing/marketreq-page.php"> here</a> to know more</h3>
    <h3 style="margin-left:22%;"><a href="about-Us.php" style=" text-decoration: none; color:white;">About Us</a></h3>
</div>
</body>
<footer>
</footer>
</html>
<?php ?>