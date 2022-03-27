<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Account Page</title>
    <link rel="stylesheet" href="stylemanaged.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../Images/client_logo.ico">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<header>
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
</header>

<body>
    <div class="container">
        <h2>Manage Account</h2>
        <form action="editAccount.php" method="post">
            <fieldset style = "border: none;">  
                
                <div class="firstn">
                    <label id = "eventTitle">First name <br> </label>
                    <input type = "text" 
                            id = "Eventtitle" 
                            name = "fname" 
                            class="inputbox" 
                            value=<?php echo $_SESSION['customerFName']; ?>
                            placeholder = "Please enter your First name"><br><br>
                </div>

                <div class="lastn">
                    <label id = "eventTitle">Last name <br> </label>
                    <input type="text"
                        id = "Eventtitle"
                        name="lname"
                        class="inputbox"
                        value=<?php echo $_SESSION['customerLName']; ?>
                        placeholder="Please enter your Last name"><br><br>
                </div>

                <div class="phonenumber">
                    <label id = "eventTitle"> Phone number <br> </label>
                    <input type="number"
                        id = "Eventtitle"
                        name="pnum"
                        class="inputbox"
                        value=<?php echo $_SESSION['phonenum']; ?>
                        placeholder="Please enter your Phone Number"><br><br>
                </div>

                <div class="address">
                    <label id = "eventTitle"> Address <br> </label>
                    <input type="text"
                        id = "Eventtitle"
                        name="add"
                        class="inputbox"
                        value=<?php echo $_SESSION['address']; ?>
                        placeholder="Please enter your Address"><br><br>
                </div>

                <div class="username">
                    <label id = "eventTitle">Username <br> </label>
                    <input type="text"
                        id = "Eventtitle"
                        name="uname"
                        class="inputbox"
                        value=<?php echo $_SESSION['userName']; ?>
                        placeholder="Please enter your Username"><br><br>
                </div>

                <div class="email">
                    <label id = "eventTitle">Email <br></label> 
                    <input type="text"
                        id = "Eventtitle"
                        name="emailadd"
                        class="inputbox"
                        value=<?php echo $_SESSION['email']; ?>
                        placeholder="Please enter your Email"><br><br>
                </div>

                <div class="currentpass">
                    <label id ="eventTitle"> Type Current Password <br></label>
                    <input type = "password" 
                            id = "user" 
                            name = "currentpass" 
                            class="inputbox" 
                            placeholder = "Please enter your Current Password"><br><br>
                </div>

                <div class="changepass">
                    <a href="manageaccount-changepass.php" style = "color:black;"> Change Password</a><br>
                    <a href="delete-account.php?" ><input type = "button"  class = "btnDesign" style = "width: 225px; font-weight:bold; background-color:#FF7276;" value = "Delete Account" class="bo1"></a>
                </div>

                <div class="but">
                    <br><label id = "Submit"></label><input type = "submit" style = "background-color:lightblue;" value = "Save changes" class="bo1" onclick = "Forms()">
                    <br>
                </div>

                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
            </fieldset>
        </form>
        <!-- <img src= "Images/tree.png" style = "position:fixed; width: 200px; height: 100px; margin-left: -220px; margin-top: 20px;">
        <img src= "Images/tree.png" style = "position:fixed; width: 200px; height: 100px; margin-left: 1120px; margin-top: 20px;"> -->
    </div>
</body>
<footer>
        <img src= "Images/tree.png" style = "position:fixed; z-index: -5; width: 200px; height: 100px; margin-left: -30px; margin-top: 20px;">
        <img src= "Images/tree.png" style = "position:fixed; z-index: -5; width: 200px; height: 100px; margin-left: 1310px; margin-top: 20px;">
<div class = "footer" style = "margin-left: -5px; margin-top: 60px;">
    <h3 id = "follow" style  = "padding-left: 10px; color:white;">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x" style  = "color:white;"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x" style  = "color:white;"></i></a></h3>
    <h3 id = "partnership" style  = "color:white;">Want to work with us? Click <a  style = " text-decoration: underline; color:white;" href = "../marketing/marketreq-page.php"> here</a> to know more</h3>
    <h3 style="margin-left: 18%;"><a href="../about-Us.php" style=" text-decoration: none; color:white;">About Us</a></h3>
    </div>
</footer>
</html>
<?php
}else{
    header("Location: login.php");
    exit();
}
?>