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

            //update password in database
            mysqli_query($conn,"UPDATE admin_users set pw = '$password1' where email = '$email'");

            $message_success="New password has been set for ".$_SESSION['email'];
        }
        else{
            $message="Passwords do not match! Please try again!";
        }
}
        
?>



	
        
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="stylelogin.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../Images/client_logo.ico">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	
</head>
<div class = "header">
<a href= "orders/all-orders.php"><img src = "Images/client_logo.png" alt = "Rootmates Clothing Logo"></a>
    <h3>Rootmates <br>Clothing</h3>
        
    </div>

</header>


</div>



      <h2 style = "margin-left: 510px; margin-top: 60px;">Reset Password</h2>
	
    <div class="container_password">
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
        <div id = "table-scroller">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> 
    </div> 

    <div class = "footer" style = "margin-left: 20px; width:100%; margin-top: 110px;">
    <h3 id = "follow">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x"></i></a></h3>
    <h3 id = "partnership">Want to work with us? Click <a  style = " text-decoration: underline;" href = "../marketing/marketreq-page.php"> here</a> to know more</h3>
    <h3 style="margin-left:17%;"><a href="../about-Us.php" style=" text-decoration: none;">About Us</a></h3>
    </div>
  </body>
</html>
