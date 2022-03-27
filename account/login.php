<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
    header("Location: manage-account.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Login</title>
    <link rel="stylesheet" href="stylelogin.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../Images/client_logo.ico">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
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
                <a href="../orders/cart-page.php" style = "text-decoration:none; color:black;">My Cart</a>
                <a href="../orders/order-page.php" style = "text-decoration:none; color:black;">My Orders</a>
            </div>
            </div>
            <div class="dropdown">
            <button class = "dropbtn" id = "profilebtn" type = "submit"><i class = "fa fa-user fa-2x" style  = "color:white;"></i></button>
            <div id="accountDropdown" class="dropdown-contentAccount">
                <a href="manage-account.php" style = "text-decoration:none; color:black;">Manage Account</a>
                
                <?php
                if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
                ?>
                <a href="logout.php" style = "text-decoration:none; color:black;">Logout</a>
                <?php }else {?>
                    <a href="login.php" style = "text-decoration:none; color:black;">Login</a>
             <?php }?>
            </div>
            </div>
        </nav>
    </div>


</header>

<body>
<div class="container">
    <h2>Log In</h2>
    <form role="form" action="loginVerify.php" method="post">    
       
    <div class="container-fluid" style="background: rgb(233, 233, 233); border-radius: 3%; padding:10px; box-shadow:5px 5px 10px 5px #ccc;" ><br><br>
           
           <div class="form-group row">
           <span style="display:inline-block; width: 20%;"></span><label id = "eventTitle" class="col-sm-2 col-form-label">Username <br> </label>
                <div class="col-sm-5">
                <input type = "text" id = "user" name = "uname" class="form-control" placeholder = "Please enter username"><br><br>
            </div>
            </div>

            <div class="form-group row">
            <span style="display:inline-block; width: 20%;"></span><label id = "eventTitle" class="col-sm-2 col-form-label">Password<br> </label>
                <div class="col-sm-5">
                <input type = "password" id = "pass" name = "password" class="form-control" placeholder = "Please enter password"><br><br>
            </div>
            </div>

            <div class="bob">
                <a href="cust_forgot_passwords.php" class="side">Forgot Password?</a><br><br>
            </div>

            <div class="but">
                <br><label id = "Submit"></label><input style = "background-color:lightblue" type = "submit" value = "LOGIN" class="bo1" onclick = "Forms()">
            </div>
            
            <div class="signup">
                <a href="signup.php" class="side">Don't have an account?</a><br><br><br>
            </div>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                </div> 
        </form>
        <img src= "Images/tree.png" style = "position:fixed; width: 200px; height: 100px; margin-left: -220px; margin-top: -10px;">
        <img src= "Images/tree.png" style = "position:fixed; width: 200px; height: 100px; margin-left: 1100px; margin-top: -10px;">
</div>
<div id = "table-scroller">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</div>
<div class = "footer" style = "margin-left: -10px; padding-left:20px;">
    <h3 id = "follow" style  = "color:white;">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x" style  = "color:white;"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x" style  = "color:white;"></i></a></h3>
    <h3 id = "partnership" style  = "color:white;">Want to work with us? Click <a  style = "text-decoration: underline; color:white;" href = "../marketing/marketreq-page.php"> here</a> to know more</h3>
    <h3 style="margin-left:17%;"><a href="../about-Us.php" style=" text-decoration: none; color:white;">About Us</a></h3>
    </div>

</body>
</html>
