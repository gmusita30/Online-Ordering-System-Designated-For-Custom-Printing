<?php
/*
      Author  : Joseph Carlos Andong
      
*/ 
?>

<?php 
$message="";
$valid='true';
include("db_conn.php");


session_start();


if($_SERVER["REQUEST_METHOD"] == "POST"){
        $password1=mysqli_real_escape_string($conn,$_POST['password1']);
        $password2=mysqli_real_escape_string($conn,$_POST['password2']);
	if ($password2==$password1) {
            
            $email = $_SESSION['email'];
            $password3 = password_hash($password1, PASSWORD_DEFAULT);

            //update password in database
            mysqli_query($conn,"UPDATE customer_users set pw = '$password3' where email = '$email'");

            $message_success="New password has been set for ".$_SESSION['email'];
        }
        else{
            $message="Passwords do not match! Please try again!";
        }
}
        
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="stylelogin.css?v=<?php echo time(); ?>">
<link rel="icon" href="../../Images/client_logo.ico">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
    <title>Forgot Password</title>
  </head>
  <body style = "overflow-x: hidden;">
    <div class="header" style = "margin-left: -10px; width: 1600px; padding-left: 10px;">
        

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

      <h2 style = "margin-left: 510px; margin-top: 60px;">Reset Password</h2>
	
      <div class="row"><br><br><br>
        <div class="col-md-4"></div>
        <div class="col-md-4" style="background-color: #D2D1D1; border-radius:15px;">
          <br><br>
          <form role="form" method="POST">
              <label style = "font-weight: bold;">Please enter your new password</label><br><br>
              <div class="form-group">
                <input type="password" class="form-control" id="pwd" name="password1" placeholder="Password">
              </div>
              <div class="form-group">
                <input type="password" class="form-control" id="pwd" name="password2" placeholder="Re-type Password">
              </div>
                  <?php if (isset($error)) {
                    echo"<div class='alert alert-danger' role='alert'>
                    <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                    <span class='sr-only'>Error:</span>".$error."</div>";
                    } ?>
                  <?php if ($message<>"") {
                    echo"<div class='alert alert-danger' role='alert'>
                    <span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>
                    <span class='sr-only'>Error:</span>".$message."</div>";
                    } ?>
                  <?php if (isset($message_success)) {
                    echo"<div class='alert alert-success' role='alert'>
                    <span class='glyphicon glyphicon-ok' aria-hidden='true'></span>
                    <span class='sr-only'>Error:</span>".$message_success."</div>";
                    } ?>
                <button type="submit" class="btn btn-primary pull-right" name="submit" style="display: block; width: 100%;">Save Password</button>
                <br><br>
                <label style = "font-weight: bold;">This link will work only once for a limited time period.</label>
                <center> <a href="login.php">Back to Login</a></center>
                <br>
          </form>
    </div>
        <img src= "Images/tree.png" style = "position:fixed; width: 200px; height: 100px; margin-left: 10px; margin-top: 440px;">
        <img src= "Images/tree.png" style = "position:fixed; width: 200px; height: 100px; margin-left: 1320px; margin-top: 440px;">
  </body>
  <div class = "footer_reset" style = "margin-left: -10px; width: 1600px;">
    <h3 id = "follow" style = "margin-left: 20px; color:white;">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x" style  = "color:white;"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x" style  = "color:white;"></i></a></h3>
    <h3 id = "partnership" style  = "color:white;">Want to work with us? Click <a  style = " text-decoration: underline; color:white;" href = "../marketing/marketreq-page.php"> here</a> to know more</h3>
    <h3 style="margin-left: 17%;"><a href="../about-Us.php" style="margin-left: -30px; text-decoration: none; color:white;">About Us</a></h3>
    </div>

</html>