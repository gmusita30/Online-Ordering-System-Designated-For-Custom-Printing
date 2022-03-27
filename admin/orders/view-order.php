<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Order</title>
    <link rel="stylesheet" href="layout-order.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../../Images/client_logo.ico">
</head>
<body>
    <div class = "header">
    <h1>Rootmates Online - Admin</h1>
    </div>
    
    <div class = "profile">
        <img src = "Images/client_logo.png" alt = "Rootmates Clothing Logo">
        <h2>Ordering System</h2>
    </div>

    <div class = "tabs">
        <ul>
        <li><button id = "orderClick"><a  id = "orderClicklink" href = "all-orders.php">Orders</a></button></li>
        <li><button><a href = "../inventory/all-products.php">Inventory</a></button></li>
        <li><button><a href = "../feedback/all-feedbacks.php">Feedback</a></button></li>
        <li><button><a href = "../marketing/all-requests.php">Marketing Request</a></button></li>
        <li><button><a href = "../users/all-admin-users.php">Users</a></button></li>
        <li><button><a href = "../logout.php">Logout</a></button></li>
        </ul>
    </div>
    
    <div class = "order-container">
        <h1>Order - Customer</h1>
        <div class = "scroll">
        <div class="ordertable">
        <?php
            if (isset($_POST['view'])){
            $id = $_POST['id'];
            $sql = "SELECT * FROM orders WHERE orderID = $id";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_fetch_array($result);


            ?>
            <ul id="ordertabletext">
                <li style = "font-weight: bold;">Order ID</li>
                <li style="margin-left: 30px;"><?php echo $resultCheck['orderID'];?></li>
            </ul>
            <ul id="ordertabletext">
                <li style = "font-weight: bold;">Order Status</li>
                <li style="margin-left: 5px;"><?php echo $resultCheck['orderStatus'];?></li>
            </ul>
            <ul id="ordertabletext">
                <li style = "font-weight: bold;">Customer ID</li>
                <li><?php echo $resultCheck['customerID'];?></li>
            </ul>
            <ul id="ordertabletext">
                <li style = "font-weight: bold;">Customer Name</li>
                <li style="margin-left: -25px;"><?php echo $resultCheck['customerName'];?></li>
            </ul>
            <ul id="ordertabletext">
                <li style = "font-weight: bold;">Phone Number</li>
                <li style="margin-left: -25px;"><?php echo $resultCheck['phonenum'];?></li>
            </ul>
            <ul id="ordertabletext">
                <li style = "font-weight: bold;">Address</li>
                <li style="margin-left: 38px;"><?php echo $resultCheck['address'];?></li>
            </ul>
           <div>
            <table class="orderinsidetable">
                <tr>
                    <th style = "border: 2px solid black;">ID</th>
                    <th style = "border: 2px solid black;">Product</th>
                    <th style = "border: 2px solid black;">Quantity</th>
                    <th style = "border: 2px solid black;">Size</th>
                    <th style = "border: 2px solid black;">Color</th>
                    <th style = "border: 2px solid black;">Price</th>
                    <th style = "border: 2px solid black;">Stocks Available</th>
                </tr>
                
                <?php    
                    $sql1 = "SELECT * FROM ordercontents WHERE orderID = $id";
                    $result1 = mysqli_query($conn, $sql1);
                    $resultCheck1 = mysqli_num_rows($result1);

                    if($resultCheck1 > 0){
                        while ($row = mysqli_fetch_assoc($result1)){ ?>
                            <tr class="orderlistcustomer">
                                <td style = "border: 2px solid black;"><?php echo $row['orderCID'];?></td>
                                <td style = "border: 2px solid black;"><?php echo $row['productName'];?></td>
                                <td style = "border: 2px solid black;"><?php echo $row['qty'];?></td>
                                <td style = "border: 2px solid black;"><?php echo $row['size'];?></td>
                                <td style = "border: 2px solid black;"><?php echo $row['colorName'];?></td>
                                <td style = "border: 2px solid black;"><?php echo $row['price'];?></td>
                                <td style = "border: 2px solid black;">
                                    <?php  
                                        $colorID = $row['colorID'];
                                        $sql4 = "SELECT * FROM product_variant WHERE colorID = $colorID";
                                        $result4 = mysqli_query($conn, $sql4);
                                        $resultCheck4 = mysqli_num_rows($result4);
                                        if($resultCheck4 > 0){
                                            while ($row4 = mysqli_fetch_assoc($result4)){
                                                echo $row4['stocks'];
                                            }
                                        }
                                        
                                    ?>
                                </td>
                            </tr>
                            <!--?php}
                            }?>
                            <?php //} ?>-->
                        <?php } ?>

                    <tr style="margin-top: -10px;">
                        <td style="margin-right: 20px; text-align:center;">Payment Method</td>
                        <td><?php echo $resultCheck['paymentMethod'];?></td>
                        <td colspan = "2" style = "text-align:right;">Total</td>
                        <td colspan = "2" style = "text-align:left;"><?php echo $resultCheck['price'];?></td>
                    </tr>
                    <?php } ?>
            </table>
            <?php if($resultCheck['paymentMethod'] == "GCash"){ ?> <img  class = "imgPlacement" src="gcashPaymentProof/<?=$resultCheck['paymentProof']?>"> <?php }?>
        
            <h3 style = "margin-top: -20px;">Order Status Updates</h3>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Date and Time</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $sql10 = "SELECT * FROM notif WHERE orderID = $id AND orderStatus = 'Pending'";
                        $result10 = mysqli_query ($conn, $sql10);
                        $row10 = mysqli_fetch_assoc($result10);
                        $sql11 = "SELECT * FROM notif WHERE orderID = $id AND orderStatus = 'Confirmed'";
                        $result11 = mysqli_query ($conn, $sql11);
                        $row11 = mysqli_fetch_assoc($result11);
                        $sql12 = "SELECT * FROM notif WHERE orderID = $id AND orderStatus = 'Rejected'";
                        $result12 = mysqli_query ($conn, $sql12);
                        $row12 = mysqli_fetch_assoc($result12);
                        $sql13 = "SELECT * FROM notif WHERE orderID = $id AND orderStatus = 'Packed'";
                        $result13 = mysqli_query ($conn, $sql13);
                        $row13 = mysqli_fetch_assoc($result13);
                        $sql14 = "SELECT * FROM notif WHERE orderID = $id AND orderStatus = 'Shipped'";
                        $result14 = mysqli_query ($conn, $sql14);
                        $row14 = mysqli_fetch_assoc($result14);
                        $sql15 = "SELECT * FROM notif WHERE orderID = $id AND orderStatus = 'Delivered'";
                        $result15 = mysqli_query ($conn, $sql15);
                        $row15 = mysqli_fetch_assoc($result15);
                        $sql16 = "SELECT * FROM notif WHERE orderID = $id AND orderStatus = 'Failed Delivery'";
                        $result16 = mysqli_query ($conn, $sql16);
                        $row16 = mysqli_fetch_assoc($result16);
                        $sql17 = "SELECT * FROM notif WHERE orderID = $id AND orderStatus = 'Cancelled'";
                        $result17 = mysqli_query ($conn, $sql17);
                        $row17 = mysqli_fetch_assoc($result17);
                    ?>
                    
                    <?php if (mysqli_num_rows($result10) > 0) {?>
                        <tr>
                            <td><center><?php echo $row10['datetime']?></center></td>
                            <td><center>Order has been placed.</center></td>    
                        </tr>
                    <?php }?>
                    <?php if (mysqli_num_rows($result11) > 0) {?>
                        <tr>
                            <td><center><?php echo $row11['datetime']?></center></td>
                            <td><center>Order has been Confirmed.</center></td>
                        </tr>
                    <?php }?>
                    <?php if (mysqli_num_rows($result12) > 0) {?>
                        <tr>
                            <td><center><?php echo $row12['datetime']?></center></td>
                            <td><center>Order has been Rejected.</center></td>
                        </tr>
                    <?php }?>
                    <?php if (mysqli_num_rows($result13) > 0) {?>
                        <tr>
                            <td><center><?php echo $row13['datetime']?></center></td>
                            <td><center>Order has been Packed and Ready to Ship.</center></td>
                        </tr>
                    <?php }?>
                    <?php if (mysqli_num_rows($result14) > 0) {?>
                        <tr>
                            <td><center><?php echo $row14['datetime']?></center></td>
                            <td><center>Order has been Shipped.</center></td>
                        </tr>
                    <?php }?>
                    <?php if (mysqli_num_rows($result15) > 0) {?>
                        <tr>
                            <td><center><?php echo $row15['datetime']?></center></td>
                            <td><center>Order has been Delivered.</center></td>
                        </tr>
                    <?php }?>
                    <?php if (mysqli_num_rows($result16) > 0) {?>
                        <tr>
                            <td><center><?php echo $row16['datetime']?></center></td>
                            <td><center>Order has been Cancelled due to Failed Delivery.</center></td>
                        </tr>
                    <?php }?>
                    <?php if (mysqli_num_rows($result17) > 0) {?>
                        <tr>
                            <td><center><?php echo $row17['datetime']?></center></td>
                            <td><center>Customer cancelled the Order.</center></td>
                        </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>
        </div>
    </div>

    <div class = "order-buttons-customer">
        <ul>
        <li><button class="button"  id = "btnDesign"><a href = "all-orders.php">Back</a></button></li>
        
        <?php 
        $id = $_POST['id'];
        $sql = "SELECT * FROM orders WHERE orderID = $id";
        $result = mysqli_query($conn, $sql);
        $resultCheck2 = mysqli_fetch_array($result);

         if ($resultCheck2['orderStatus'] == 'Pending'){ ?>
                    <button class="confirm-customers" id = "btnDesign"><a href="rejectOrder.php?orderID=<?=$resultCheck['orderID']?>&customerID=<?=$resultCheck['customerID']?>">Reject</a></button>
                    <button id = "btnDesign" style = "font-weight:bold;"><a href="confirmOrder.php?orderID=<?=$resultCheck['orderID']?>&customerID=<?=$resultCheck['customerID']?>">Confirm</a></button>
        <?php }elseif ($resultCheck2['orderStatus'] == 'Shipped'){ ?>
                <li><button class="confirm-customer" id = "btnDesign"><a href="confirmDelivery.php?orderID=<?=$resultCheck['orderID']?>&customerID=<?=$resultCheck['customerID']?>">Confirm Delivery</a></button></li>
        <?php } ?>
            
        </ul>
    </div>
        <?php if (isset($_GET['error'])) { ?>
            <p class="error"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <p class="success"><?php echo $_GET['success']; ?></p>
        <?php } ?>
    <?php } ?>

</body>
</html> 
<?php
}else{
    header("Location: ../login.php");
    exit();
}
?>