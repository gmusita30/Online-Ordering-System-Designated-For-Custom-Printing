<?php
session_start();
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "styleReq.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../Images/client_logo.ico">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Send Marketing Request</title>
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
                <a href="../account/manage-account.php">Manage Account</a>
                
                <?php
                if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
                ?>
                <a href="../account/logout.php">Logout</a>
                <?php }else {?>
                    <a href="../account/login.php">Login</a>
             <?php }?>
            </div>
            </div>

        </nav>
    </div>
</header>

<body>
    <div class = "content">
        <div class="head">
            <b>Work With Us!!!</b>
        </div>
        <form action="requestVerify.php" method="post" enctype="multipart/form-data">
        <div class="container">
            
                <div class="type">
                    <h3>What's this about?</h3>
                    <p>Our business is planning to expand our products and currently we need to find services that can accomodate us. 
                        If you're a printing house or a clothes, shorts, and caps manufacturer, maybe you're business can be a help to us and our business to yours. 
                        Kindly fill the form below to let us know about your business more.</p>
                        </div>
                        <div class="box">
                            <label>Name<label style = "color:red;">*</label>    </label>
                            <?php if (isset($_GET['sender'])) { ?>
                                <input type="text"
                                        id = "name"
                                        name="sender"
                                        class="inputbox"
                                        placeholder="Please enter your Name"
                                        value="<?php echo $_GET['sender']; ?>">
                            <?php }else{ ?>
                                <input type="text"
                                        id = "name"
                                        name="sender"
                                        class="inputbox"
                                        placeholder="Please enter your Name" required>
                            <?php }?>
                        </div>
            
                        <div class="box">
                            <label>Business Name<label style = "color:red;">*</label></label>
                            <?php if (isset($_GET['bname'])) { ?>
                                <input type="text"
                                        id = "businessn"
                                        name="bname"
                                        class="inputbox"
                                        placeholder="Please enter Business Name"
                                        value="<?php echo $_GET['bname']; ?>">
                            <?php }else{ ?>
                                <input type="text"
                                        id = "businessn"
                                        name="bname"
                                        class="inputbox"
                                        placeholder="Please enter Business Name" required>
                            <?php }?>
                        </div>

                        <div class="box">
                            <label>Contact Number<label style = "color:red;">*</label></label>
                            <?php if (isset($_GET['pnum'])) { ?>
                                <input type="number"
                                        id = "businessn"
                                        name="pnum"
                                        class="inputbox"
                                        pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" maxlength="13"
                                        placeholder="Please enter Contact Number"
                                        value="<?php echo $_GET['pnum']; ?>">
                            <?php }else{ ?>
                                <input type="number"
                                        id = "businessn"
                                        name="pnum"
                                        class="inputbox"
                                        pattern="[0-9]{4}-[0-9]{3}-[0-9]{4}" maxlength="13"
                                        placeholder="Please enter Contact Number" required>
                            <?php }?>
                        </div>

                        <div class="box">
                            <label>Social Media Page</label>
                            <?php if (isset($_GET['social'])) { ?>
                                <input type="text"
                                        id = "login"
                                        name="social"
                                        class="inputbox"
                                        placeholder="Please enter Social Media Page (Optional)"
                                        value="<?php echo $_GET['social']; ?>">
                            <?php }else{ ?>
                                <input type="text"
                                        id = "login"
                                        name="social"
                                        class="inputbox"
                                        placeholder="Please enter Social Media Page (Optional)">
                            <?php }?>
                        </div>

                        <div class="box">
                            <label id = "eventTitle" >Address<label style = "color:red;">*</label> <br> </label>
                            <?php if (isset($_GET['add'])) { ?>
                                <input type="text"
                                        id = "Eventtitle"
                                        name="add"
                                        class="inputbox"
                                        placeholder="Please enter Business Address"
                                        value="<?php echo $_GET['add']; ?>">
                            <?php }else{ ?>
                                <input type="text"
                                        id = "Eventtitle"
                                        name="add"
                                        class="inputbox"
                                        placeholder="Please enter Business Address">
                            <?php }?>
                        </div>

                        <div class = "vertical"></div>

                        <div class="box1">
                            <label>Tell us about your business<label style = "color:red;">*</label></label>
                        </div>

                        <div class="txtbox">
                            <label>
                                <?php if (isset($_GET['info'])) { ?>
                                    <input type="textarea"
                                            name="info"
                                            class="txtb"
                                            maxlength="300"
                                            placeholder="Can be about business operation hours, offered services, etc."
                                            value="<?php echo $_GET['info']; ?>">
                                <?php }else{ ?>
                                    <input type="textarea"
                                            name="info"
                                            class="txtb"
                                            maxlength="300"
                                            placeholder="Can be about business operation hours, offered services, etc." required>
                                <?php }?>
                            </label>
                        </div><br><br><br><br><br><br>

                <div class="box2">
                    <label>Image Preview (Optional)</label>
                </div>

                <div class="image-preview" id="imagePreview">
                    <input type="file" name="bImage">
                </div>

                <div class="but">
                    <label id = "Submit"></label><input style = "background-color:lightblue;" type = "submit" name="submit" value = "Send Request" class="bo1">
                </div>

                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
                <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
        </div>   
        </form>
        <img src= "Images/tree.png" style = "position:absolute; z-index: -5; width: 200px; height: 100px; margin-left: -10px; margin-top: 525px;">
        <img src= "Images/tree.png" style = "position:absolute; z-index: -5; width: 200px; height: 100px; margin-left: 1300px; margin-top: 525px;">
    </div>
    
    <footer>
    <div class = "footer" style = "padding-left: 20px; margin-left: -10px;">
    <h3 id = "follow" style  = "color:white;">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x" style  = "color:white;"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x" style  = "color:white;"></i></a></h3>
    <h3 id = "partnership" style  = "color:white;">Want to work with us? Click <a  style = " text-decoration: underline; color:white;" href = "marketreq-page.php"> here</a> to know more</h3>
    <h3 style="margin-left:22%;"><a href="../about-Us.php" style=" text-decoration: none; color:white;">About Us</a></h3>
    </div>
    </footer>
</body>
</html>
<?php?>