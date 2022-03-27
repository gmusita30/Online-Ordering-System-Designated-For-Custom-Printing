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
    <title>View Order ID <?php echo $orderID ?></title>
    <link rel="stylesheet" href="customerOrderViewLayout.css?v=<?php echo time(); ?>">
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
        <h2 id="headerOrder">Order ID <?php echo $orderID ?></h2>
        <div class = "order">
        <h2>Delivery Information</h2>
            <h3> Name: <?php echo $rows['customerName']?></h3>
            <h3> Contact number: <?php echo $rows['phonenum']?></h3>
            <h3> Address: <?php echo $rows['address']?></h3>
            <h3> Email: <?php echo $rows['email']?></h3>
            <h3> Total Order Price: ₱<?php echo $rows['price']?>.00</h3>
            <h3> Order Status: <?php echo $rows['orderStatus']?></h3>
            <h3> Payment Method: <?php echo $rows['paymentMethod']?></h3>
            <?php if($rows['paymentMethod'] == 'COD'){?>
                    <h3> Payment Proof: (Not needed for this type of Payment Method)</h3>
                <?php }else{ ?>
                    <h3> Payment Proof:</h3> <center><br><img src="../admin/orders/gcashPaymentProof/<?php echo $rows['paymentProof']?>"></center>
            <?php } ?>
            
        <br><br><br><br><br><br><br><br><br><br><br><br><h2>Order Contents</h2>
        <center>
            <?php if (mysqli_num_rows($result2)) { ?>
                    <table class="table table-striped" style = "width: 1020px;">
                        <thead>
                            <tr style = "text-align:center;">
                                <th scope="col">Product ID </th>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Color</th>
                                <th scope="col">Size</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Total</th>
                                <th scope="col">Rate Status</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php
                                $i = 0;
                                while($rows2 = mysqli_fetch_assoc($result2)){
                                $i++;
                            ?>
                            <tr style = "text-align:center;">
                                <form action="rateProduct.php" method="post">    
                                    <td><?=$rows2['productID']?></td>
                                    <td><img src="../admin/inventory/Images/<?=$rows2['productImage']?>"></td>
                                    <td><?=$rows2['productName']?></td>
                                    <td><?=$rows2['colorName']?></td>
                                    <td><?=$rows2['size']?></td>
                                    <td>₱<?=$rows2['price']?>.00</td>
                                    <td><?=$rows2['qty']?></td>
                                    <td>₱<?=$rows2['price'] * $rows2['qty']?>.00</td>
                                    <td>
                                        <?php if ($rows2['rateprd'] == 'Unrated' ){?>
                                            
                                            <input type ="number" name="orderCID" value="<?=$rows2['orderCID']?>" hidden>
                                            <input type ="number" name="orderID" value="<?=$rows2['orderID']?>" hidden>
                                            <input type ="number" name="productID" value= "<?=$rows2['productID']?>" hidden>
                                            <input type ="number" name="colorID" value= "<?=$rows2['colorID']?>" hidden>
                                            <input type ="number" name="qty" value="<?=$rows2['qty']?>" hidden>
                                            <input type ="number" name="order" value="<?=$rows2['orderID']?>" hidden>
                                            <?php if ($rows['orderStatus'] == 'Delivered'){ ?>
                                                <?=$rows2['rateprd']?><br>
                                                <input type="number" name="rating" min="1" max="5" > out of 5 </input><br>
                                                <input type="text" name="comment" min="0" max="124" placeholder="Leave a comment"></input><br>
                                                <button type = "submit" class = "btn btn-primary" name="rate">Rate</button>
                                            <?php }else if ($rows['orderStatus'] == 'Cancelled'){ ?>
                                                This order is cancelled. You can't rate or comment to this product.
                                            <?php }else if ($rows['orderStatus'] == 'Failed Delivery'){ ?>
                                                This order has failed delivery. You can't rate or comment to this product.
                                            <?php }else {?>
                                                (Can be rated and commented once delivered)
                                            <?php } ?>
                                        <?php }else{ ?>
                                            <input type ="number" name="orderCID" value="<?=$rows2['orderCID']?>" hidden>
                                            <input type ="number" name="orderID" value="<?=$rows2['orderID']?>" hidden>
                                            <input type ="number" name="productID" value= "<?=$rows2['productID']?>" hidden>
                                            <input type ="number" name="colorID" value= "<?=$rows2['colorID']?>" hidden>
                                            <input type ="number" name="qty" value="<?=$rows2['qty']?>" hidden>
                                            <input type ="number" name="order" value="<?=$rows2['orderID']?>" hidden>
                                            Rated: 
                                            <br><input type="number" name="rating" min="1" max="5" value="<?=($rows2['rateNum'])?>">/5 </input><br>
                                            <input type="number" name="prvRate" value="<?=($rows2['rateNum'])?>" hidden readonly></input>
                                            Commented:
                                            <br><input type="text" name="comment" min="0" max="124" value="<?=($rows2['comment'])?>"> <br>
                                            <input type="text" name="prvComment" value="<?=($rows2['comment'])?>" hidden readonly></input>
                                            <button type = "submit" class = "btn btn-primary" name="update">Update</button>
                                        <?php }?>
                                    </td>
                                </form>
                            </tr>
                            <?php } ?>
                        </tbody>
                        </table>
                    <?php } ?>
        </center>

            <h2>Order Status Updates</h2>
            <table class="table table-striped" style = "width: 1020px;">
                <thead>
                    <tr style = "text-align:center;">
                        <th scope="col">Date and Time</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql10 = "SELECT * FROM notif WHERE customerID = '".$_SESSION['customerID']."' AND orderID = $orderID AND orderStatus = 'Pending'";
                        $result10 = mysqli_query ($conn, $sql10);
                        $row10 = mysqli_fetch_assoc($result10);
                        $sql11 = "SELECT * FROM notif WHERE customerID = '".$_SESSION['customerID']."' AND orderID = $orderID AND orderStatus = 'Confirmed'";
                        $result11 = mysqli_query ($conn, $sql11);
                        $row11 = mysqli_fetch_assoc($result11);
                        $sql12 = "SELECT * FROM notif WHERE customerID = '".$_SESSION['customerID']."' AND orderID = $orderID AND orderStatus = 'Rejected'";
                        $result12 = mysqli_query ($conn, $sql12);
                        $row12 = mysqli_fetch_assoc($result12);
                        $sql13 = "SELECT * FROM notif WHERE customerID = '".$_SESSION['customerID']."' AND orderID = $orderID AND orderStatus = 'Packed'";
                        $result13 = mysqli_query ($conn, $sql13);
                        $row13 = mysqli_fetch_assoc($result13);
                        $sql14 = "SELECT * FROM notif WHERE customerID = '".$_SESSION['customerID']."' AND orderID = $orderID AND orderStatus = 'Shipped'";
                        $result14 = mysqli_query ($conn, $sql14);
                        $row14 = mysqli_fetch_assoc($result14);
                        $sql15 = "SELECT * FROM notif WHERE customerID = '".$_SESSION['customerID']."' AND orderID = $orderID AND orderStatus = 'Delivered'";
                        $result15 = mysqli_query ($conn, $sql15);
                        $row15 = mysqli_fetch_assoc($result15);
                        $sql16 = "SELECT * FROM notif WHERE customerID = '".$_SESSION['customerID']."' AND orderID = $orderID AND orderStatus = 'Failed Delivery'";
                        $result16 = mysqli_query ($conn, $sql16);
                        $row16 = mysqli_fetch_assoc($result16);
                        $sql17 = "SELECT * FROM notif WHERE customerID = '".$_SESSION['customerID']."' AND orderID = $orderID AND orderStatus = 'Cancelled'";
                        $result17 = mysqli_query ($conn, $sql17);
                        $row17 = mysqli_fetch_assoc($result17);
                    ?>
                    <?php if (mysqli_num_rows($result10) > 0) {?>
                            <tr style = "text-align:center;">
                                <td><?php echo $row10['datetime']?></td>
                                <td>Order has been placed.</td>    
                            </tr>
                    <?php }?>
                    <?php if (mysqli_num_rows($result11) > 0) {?>
                        <tr style = "text-align:center;">
                        <td><?php echo $row11['datetime']?></td>
                            <td>Order has been Confirmed.</td>
                        </tr>
                    <?php }?>
                    <?php if (mysqli_num_rows($result12) > 0) {?>
                        <tr style = "text-align:center;">
                        <td><?php echo $row12['datetime']?></td>
                            <td>Order has been Rejected.</td>
                        </tr>
                    <?php }?>
                    <?php if (mysqli_num_rows($result13) > 0) {?>
                        <tr style = "text-align:center;">
                        <td><?php echo $row13['datetime']?></td>
                            <td>Order has been Packed and Ready to Ship. </td>
                        </tr>
                    <?php }?>
                    <?php if (mysqli_num_rows($result14) > 0) {?>
                        <tr style = "text-align:center;">
                        <td><?php echo $row14['datetime']?></td>
                            <td>Order has been Shipped. Kindly prepare the amount needed for your order.</td>
                        </tr>
                    <?php }?>
                    <?php if (mysqli_num_rows($result15) > 0) {?>
                        <tr style = "text-align:center;">
                        <td><?php echo $row15['datetime']?></td>
                            <td>Order has been Delivered. Thank you for buying, you can now rate the products you have ordered.</td>
                        </tr>
                    <?php }?>
                    <?php if (mysqli_num_rows($result16) > 0) {?>
                        <tr style = "text-align:center;">
                        <td><?php echo $row16['datetime']?></td>
                            <td>Order has been Cancelled due to Failed Delivery. We are very sorry about this issue, you can contact us through our Facebook page if you have any questions.</td>
                        </tr>
                    <?php }?>
                    <?php if (mysqli_num_rows($result17) > 0) {?>
                        <tr style = "text-align:center;">
                        <td><?php echo $row17['datetime']?></td>
                            <td>You have cancelled this order.</td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        
        <center>
            <button style = "background-color: lightblue; width: 75px; height: 30px;"><a href="order-page.php" style = "font-size: 20px; color:black; font-weight:bold; text-decoration:none;">Back</a></button>
            <?php if ($rows['orderStatus'] == 'Pending'){ ?>
                    <button style = "background-color: #FF7276; width: 80px; height: 30px;"><a style = "font-size: 20px; color:black; font-weight:bold; text-decoration:none;" href="order-cancel-page.php?orderID=<?=$rows['orderID']?>">Cancel</a></button>
            <?php }elseif ($rows['orderStatus'] == 'Shipped'){ ?>
                <button style = "background-color: lightgreen; width: 190px; height: 30px;"><a style = "font-size: 20px; color:black; font-weight:bold; text-decoration:none;" href="orderConfirmDelivery.php?orderID=<?=$rows['orderID']?>&customerID=<?=$_SESSION['customerID']?>">Confirm Delivery</a></button>
            <?php } ?>
        </center>
        </div>
       
        <?php if (isset($_GET['error'])) { ?>
        <p class="error"><?php echo $_GET['error']; ?></p>
    <?php } ?>

    <?php if (isset($_GET['success'])) { ?>
        <p class="success"><?php echo $_GET['success']; ?></p>
    <?php } ?>
    </div>

        <img src= "Images/tree.png" style = "position:absolute; z-index: -5; width: 200px; height: 100px; margin-left: -10px; margin-top: 1460px;">
        <img src= "Images/tree.png" style = "position:absolute; z-index: -5; width: 200px; height: 100px; margin-left: 1300px; margin-top: 1460px;">
    
    <div class = "footer" style = "padding-left: 20px; margin-left: -10px; margin-top: 1500px;">
    <h3 id = "follow" style  = "color:white;">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x" style  = "color:white;"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x" style  = "color:white;"></i></a></h3>
    <h3 id = "partnership" style  = "color:white;">Want to work with us? Click <a  style = "text-decoration: underline; color: white;" href = "../marketing/marketreq-page.php"> here</a> to know more</h3>
    <h3 style="margin-left:24%;"><a href="../about-Us.php" style="text-decoration: none; color: white;">About Us</a></h3>
    </div>
</body>
</html>
<?php
}else{
    header("Location: ../account/login.php");
    exit();
}
?>