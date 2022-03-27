<?php
session_start();
include "viewOrder.php";

if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Order ID <?php echo $orderID ?></title>
    <link rel="stylesheet" href="customerOrderCancelLayout.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../Images/client_logo.ico">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<header>
    <div class = "header">
    <a href="../index.php"><img src = "Images/client_logo.png" alt = "Rootmates Clothing Logo"></a>
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
                <a href="cart-page.php">My Cart</a>
                <a href="order-page.php">My Orders</a>
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
    <div class = "containerOrder">
        <h2 id="headerOrder">Cancel Order ID <?php echo $orderID ?></h2>
        <div class = "order">
        <h2>Delivery Information</h2>
            <h3> Name: <?php echo $rows['customerName']?></h3>
            <h3> Contact number: <?php echo $rows['phonenum']?></h3>
            <h3> Address: <?php echo $rows['address']?></h3>
            <h3> Email: <?php echo $rows['email']?></h3>
            <h3> Total Order Price: ₱<?php echo $rows['price']?></h3>
            <h3> Order Status: <?php echo $rows['orderStatus']?></h3>
            <h3> Payment Method: <?php echo $rows['paymentMethod']?></h3>
            <?php if($rows['paymentMethod'] == 'COD'){?>
                    <h3> Payment Proof: (Not needed for this type of Payment Method)</h3>
                <?php }else{ ?>
                    <h3> Payment Proof:</h3> <center><br><img src="../admin/orders/gcashPaymentProof/<?php echo $rows['paymentProof']?>"></center>
            <?php } ?>
            
        <h2>Order Contents</h2>
            <center>
            <?php if (mysqli_num_rows($result2)) { ?>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Product ID </th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                                $i = 0;
                                while($rows2 = mysqli_fetch_assoc($result2)){
                                $i++;
                            ?>
                            <tr>
                                <td><?=$rows2['productID']?></td>
                                <td><img src="../admin/inventory/Images/<?=$rows2['productImage']?>"></td>
                                <td><?=$rows2['productName']?></td>
                                <td><?=$rows2['colorName']?></td>
                                <td><?=$rows2['size']?></td>
                                <td>₱<?=$rows2['price']?>.00</td>
                                <td><?=$rows2['qty']?></td>
                                <td>₱<?=$rows2['price'] * $rows2['qty']?>.00</td>
                            </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                    <?php } ?>
                    <center>
        </div>
        <center>
        <h3>Are you sure you want to cancel this order?</h3>
        <form action = "orderCancel.php" method = "post">
            <input type="text" name="orderID" value="<?=$rows['orderID']?>" readonly hidden> </input>
            <input type="text" name="orderStatus" value="Cancelled" readonly hidden> </input>
            <input type="text" name="customerID" value="<?=$_SESSION['customerID']?>" readonly hidden> </input>
            <button style = "background-color: #FF7276; width: 75px; height: 30px;"><a href="order-view-page.php?orderID=<?=$rows['orderID']?>" style = " font-size: 20px; font-weight: bold; text-decoration:none; color: black;">No</a></button>
            <button class="button" name="cancel" onclick = "Forms()" style = " font-size: 20px; font-weight: bold; background-color: lightgreen; width: 75px; height: 30px;">Yes</button>
        </form>
        </center>
    <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>

    <?php if (isset($_GET['success'])) { ?>
        <p class="success"><?php echo $_GET['success']; ?></p>
    <?php } ?>
    </div>
        <img src= "Images/tree.png" style = "position:absolute; z-index: -5; width: 200px; height: 100px; margin-left: -10px; margin-top: 85px;">
        <img src= "Images/tree.png" style = "position:absolute; z-index: -5; width: 200px; height: 100px; margin-left: 1300px; margin-top: 85px;">
</body>

<footer>
    <div class = "footer" style = "padding-left: 20px; margin-left: -10px; padding-bottom: 2px;">
    <h3 id = "follow" style  = "color:white;">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x" style  = "color:white;"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x" style  = "color:white;"></i></a></h3>
    <h3 id = "partnership" style  = "color:white;">Want to work with us? Click <a  style = "text-decoration: underline; color: white;" href = "../marketing/marketreq-page.php"> here</a> to know more</h3>
    <h3 style="margin-left:23%;"><a href="../about-Us.php" style="text-decoration: none; color:white;">About Us</a></h3>
    </div>
</footer>
</html>
<?php
}else{
    header("Location: ../account/login.php");
    exit();
}
?>