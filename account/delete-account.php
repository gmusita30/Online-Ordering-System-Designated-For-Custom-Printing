<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
    

?>
<!DOCTYPE html>
<html lang="en">
<header>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="styledeleteacc.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../Images/client_logo.ico">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	
</header>

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
    <h2>Delete Account</h2>
    <form action="deleteAccount.php">    
        <fieldset style = "background-color: lightgray; box-shadow:  3px 3px 3px 5px #ccc;">    
            <div class="tit">
                <label id = "eventTitle">Sorry to see you go. <br>
                            Are you really sure you want to delete your account? <br> </label>
            </div><br>

            <div class="but">
                <label id = "Submit"></label><input style = "background-color: #FF7276;" type = "submit" value = "Delete Account" class="bo1" onclick = "Forms()"><br>
                <button style = "background-color:lightblue;"><a href = "manage-account.php" style = "font-weight:bold; color:black; text-decoration:none;">Go Back</a></button>
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
</html>
<?php
}else{
    header("Location: login.php");
    exit();
}
?>