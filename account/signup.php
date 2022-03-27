<?php
session_start();

if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
    header("Location: ../index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Sign Up</title>
    <link rel="stylesheet" href="stylesignup.css?v=<?php echo time(); ?>">
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


<body>
<div class="container">
    <h2>Create Account</h2>
    <form action="signupVerify.php" method="post">
          
            <div class="enter">
                <label id = "eventTitle"> Please enter the necessary information <br></label>
            </div>

            <div class="firstn">
            <label id = "eventTitle" >First name <br> </label>
            <?php if (isset($_GET['fname'])) { ?>
                <input type="text"
                        id = "Eventtitle"
                        name="fname"
                        class="inputbox"
                        placeholder="Please enter your First name"
                        value="<?php echo $_GET['fname']; ?>">
            <?php }else{ ?>
                <input type="text"
                        id = "Eventtitle"
                        name="fname"
                        class="inputbox"
                        placeholder="Please enter your First name">
                <?php }?>
            </div><br>

            <div class="lastn">
            <label id = "eventTitle" >Last name <br> </label>
            <?php if (isset($_GET['lname'])) { ?>
                <input type="text"
                        id = "Eventtitle"
                        name="lname"
                        class="inputbox"
                        placeholder="Please enter your Last name"
                        value="<?php echo $_GET['lname']; ?>">
            <?php }else{ ?>
                <input type="text"
                        id = "Eventtitle"
                        name="lname"
                        class="inputbox"
                        placeholder="Please enter your Last name">
                <?php }?>
            </div><br>

            <div class="phonenumber">
            <label id = "eventTitle" >Phone number <br> </label>
            <?php if (isset($_GET['pnum'])) { ?>
                <input type="text"
                        id = "Eventtitle"
                        name="pnum"
                        class="inputbox"
                        placeholder="Please enter your Phone number"
                        value="<?php echo $_GET['pnum']; ?>">
            <?php }else{ ?>
                <input type="text"
                        id = "Eventtitle"
                        name="pnum"
                        class="inputbox"
                        placeholder="Please enter your Phone number">
                <?php }?>
            </div><br>

            <div class="address">
            <label id = "eventTitle" >Address <br> </label>
            <?php if (isset($_GET['add'])) { ?>
                <input type="text"
                        id = "Eventtitle"
                        name="add"
                        class="inputbox"
                        placeholder="Please enter your Address"
                        value="<?php echo $_GET['add']; ?>">
            <?php }else{ ?>
                <input type="text"
                        id = "Eventtitle"
                        name="add"
                        class="inputbox"
                        placeholder="Please enter your Address">
                <?php }?>
            </div><br><br>

            <div class="username">
            <label id = "eventTitle" >Username <br> </label>
            <?php if (isset($_GET['uname'])) { ?>
                <input type="text"
                        id = "Eventtitle"
                        name="uname"
                        class="inputbox"
                        placeholder="Please enter your Username"
                        value="<?php echo $_GET['uname']; ?>">
            <?php }else{ ?>
                <input type="text"
                        id = "Eventtitle"
                        name="uname"
                        class="inputbox"
                        placeholder="Please enter your Username">
                <?php }?>
            </div>
            

            <div class="email">
            <label id = "eventTitle" >Email <br> </label>
            <?php if (isset($_GET['emailadd'])) { ?>
                <input type="email"
                        id = "Eventtitle"
                        name="emailadd"
                        class="inputbox"
                        placeholder="Please enter your Email"
                        value="<?php echo $_GET['emailadd']; ?>">
            <?php }else{ ?>
                <input type="email"
                        id = "Eventtitle"
                        name="emailadd"
                        class="inputbox"
                        placeholder="Please enter your Email">
                <?php }?>
            </div>

            <div class="passw">
            <label id = "eventTitle"> Password <br></label>
                <input type = "password" 
                        id="Eventtitle" 
                        name="passw" 
                        class="inputbox" 
                        placeholder="Please enter your Password"><br><br>
            </div>

            <div class="repeatpass">
            <label id ="eventTitle"> Repeat Password <br></label>
                <input type = "password" 
                        id="Eventtitle" 
                        name = "repeatpass" 
                        class="inputbox" 
                        placeholder="Please repeat your Password"><br><br>
            </div>

            <div class="but">
                <label id = "Submit"></label><input type = "submit" style = "background-color: lightblue;" value = "Create Account" class="bo1" onclick = "Forms()">
            </div>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <div class="signup">
                <h3>Already have an account? <a href="loginVerify.php" class="side">Click here to login</a> </h3>
            </div>
    </form>
    <img src= "Images/tree.png" style = "position:fixed; width: 200px; height: 100px; margin-left: -180px; margin-top: 50px;">
    <img src= "Images/tree.png" style = "position:fixed; width: 200px; height: 100px; margin-left: 1150px; margin-top: 50px;">
</div>
</body>
<footer>
<div id = "table-scroller">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <div class = "footer">
    <h3 id = "follow" style  = "color:white;">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x" style  = "color:white;"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x" style  = "color:white;"></i></a></h3>
    <h3 id = "partnership" style  = "color:white;">Want to work with us? Click <a  style = "text-decoration: underline; color:white;" href = "../marketing/marketreq-page.php"> here</a> to know more</h3>
    <h3 style="margin-left:18%;"><a href="../about-Us.php" style="text-decoration: none; color:white;">About Us</a></h3>
    </div>
    </div>
</footer>
</html>
<?php?>