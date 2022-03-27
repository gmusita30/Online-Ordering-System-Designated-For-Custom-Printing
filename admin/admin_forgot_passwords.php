<?php
/*
      Author  : Joseph Andong
      
*/ 
?>

<?php
$message="";
$valid='true';
include("db_conn.php");


session_start();

if(isset($_POST['submit'])) {
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $email_reg=mysqli_real_escape_string($conn,$_POST['email']);
    $phone_reg = mysqli_real_escape_string($conn,$_POST['phonenum']);
    $_SESSION['email'] = $_POST['email'];
    $_SESSION['phonenumber'] = $_POST['phonenum'];
    $details=mysqli_query($conn,"SELECT phonenum, email FROM admin_users WHERE email='$email_reg' and phonenum = '$phone_reg'");

    if (mysqli_num_rows($details)>0) 
        { 
        $message_success=" Your email is in the database. Change your password";
        header('location: admin_forgot_password_resets.php');
        
        }
	else if (empty($email_reg) and empty($phone_reg))
        	{
            		$message="All information is required to be filled!"; 
             
        	}
    	else if (empty($email_reg))
       		{
            		$message="Email is required";
       		}
    	else if (empty($phone_reg))
       		{
            		$message="Phone Number is required!";
        
       		}
    else 
       {
        $message="Sorry! No account associated with this Email and Phone Number";
       }
    
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
    
    <title>Forgot Password</title>
</head>
<div class = "header"> 
<body>

</div>
</header>
      <h2 style = "margin-left: 510px; margin-top: 60px;">Forgot Password</h2>
      <div class="row"><br><br><br>
        <div class="col-md-4"></div>
        <div class="col-md-4" style="background-color: #D2D1D1; border-radius:15px; ">
          <br><br>
          <form role="form" method="POST">
            <div class="form-group">
              <label style = "font-weight: bold;">Email</label><br><br>
              <input  class="form-control" id="email" name="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" placeholder="Email" >
            </div>

            <div class="form-group">
              <label style = "font-weight: bold;">Phone Number</label><br><br>
              <input  class="form-control" id="phonenum" name="phonenum" value="<?php echo isset($_POST['phonenum']) ? $_POST['phonenum'] : ''; ?>" placeholder="PhoneNumber"  >
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
		<button type="submit" class="btn btn-primary pull-right" name="submit" style="display: block; width: 100%;">Change Password</button></a>
    		<br><br>
                <br>
		
          </form>


       </div>
        
      </div>
	<div id = "table-scroller">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </div>
    <div class = "footer">
    <h3 id = "follow">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x"></i></a></h3>
    <h3 id = "partnership">Want to work with us? Click <a  style = " text-decoration: underline;" href = "../marketing/marketreq-page.php"> here</a> to know more</h3>
    <h3 style="margin-left:17%;"><a href="../about-Us.php" style=" text-decoration: none;">About Us</a></h3>
    </div>
  </body>
</body>
</html>


