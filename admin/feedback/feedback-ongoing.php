<?php
include "../db_conn.php";
session_start();
$total=0;
$pmethods = "";
$custOrdid = 0;
$custId = 0;
$chk= "";

if(isset($_GET['orderID']) && isset($_GET['customerID']));
if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){
    

    $custOrdid = $_GET['orderID'];
    $customerID = $_GET['customerID'];
     if ($_SERVER["REQUEST_METHOD"] == "POST") {
   //collect value of input field

    $radio = $_POST['status'];
     
    if ($radio == "Shipped"){
        $chk = $radio;
        $notification = "Your order (Order ID $custOrdid) has been Shipped. Items have already been dispatched and is arriving soon. Rest assured that the items will be in good hands and will come shortly. For now, kindly prepare the amount needed for your order.";
    }else if ($radio == "Packed"){
        $chk = $radio;
        $notification = "Your order (Order ID $custOrdid) has been Packed and Ready to Ship. Items are successfully packed by the seller and is ready for shipment, items have already been checked, organized and is in good condition.";
    }else{
        $chk = "Failed Delivery";
        $notification = "Your order (Order ID $custOrdid) has been Cancelled due to Failed Delivery. The items had undergone fail delivery due to unforeseen circumstances. If the payment is done through gcash, please see the <h7 style = font-weight:bold>ABOUT US</h7> page for contact details.";
        
        $sql6 = "SELECT * FROM ordercontents WHERE orderID = $custOrdid";
        $result6 = mysqli_query($conn, $sql6);
        $resultCheck6 = mysqli_num_rows($result6);

            if($resultCheck6 > 0){
                while ($row6 = mysqli_fetch_assoc($result6)){
                    $colorID = $row6['colorID'];
                    $qty = $row6['qty'];  
                    $productID = $row6['productID'];
                    $sql7 = "UPDATE product_variant SET stocks = (stocks + $qty) WHERE colorID='$colorID'";
                    $result7 = mysqli_query($conn, $sql7);
                    $sql8 = "UPDATE product SET totalstocks = (totalStocks + $qty) WHERE productID='$productID'";
                    $result8 = mysqli_query($conn, $sql8);
                }
            
            }
    }

    $sql1 = "UPDATE orders SET orderStatus = '$chk' WHERE orderID = $custOrdid";
    $result = mysqli_query($conn, $sql1);

    date_default_timezone_set("Asia/Manila");
    $date = date('m-d-Y h:ia');
    $sql10 = "INSERT INTO notif(customerID, orderID, notification, datetime, orderStatus)
              VALUES('$customerID', '$custOrdid', '$notification', '$date', '$chk')";
    $result10 =mysqli_query($conn, $sql10);
    
    header("Location: feedback-ongoing.php?orderID=$custOrdid&status=$chk&customerID=$customerID");
    exit();
}
                 //$resultCheck = mysqli_num_rows($result);
                // $row = mysqli_fetch_assoc($result);
             // if($result){
               
             //}else
             //{

              //  echo "Error updating record: " . mysqli_error($conn);
            // }

            $sql2 = "Select customerID,orderID from orders where orderID = $custOrdid";
              $result = mysqli_query($conn, $sql2);
                 $resultCheck = mysqli_num_rows($result);

              if($resultCheck > 0){
                
                $row = mysqli_fetch_assoc($result);
                
                $custId = $row['customerID'];
              }         
                //$custName = $row['customerName']
     // print_r($custID);
     // print_r($radio);
      //print_r($custId);
//}

?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <title>Select Notification</title>
    <link rel = "stylesheet" href = "adminLayout.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../../Images/client_logo.ico">
</head>

<header>
    <div class = "header">
        <h1>Rootmates Online - Admin</h1>
    </div>
    
    <div class = "profile">
        <img src = "Images/client_logo.png" alt = "Rootmates Clothing Logo">
        <h2>Ordering System</h2>
    </div>
</header>

    <div class = "tabs">
        <ul>
        <li><button><a href = "../orders/all-orders.php">Orders</a></button></li>
        <li><button><a href = "../inventory/all-products.php">Inventory</a></button></li>
        <li><button id = "feedClick"><a id = "feedClicklink" href = "all-feedbacks.php">Feedback</a></button></li>
        <li><button><a href = "../marketing/all-requests.php">Marketing Request</a></button></li>
        <li><button><a href = "../users/all-admin-users.php">Users</a></button></li>
        <li><button><a href = "../logout.php">Logout</a></button></li>
        </ul>
    </div>
    <div class = "feedbackNotif">
        <h1>Feedback - Select Notifications </h1>
    </div>
    <div class = "SelectNotifContainer" style="padding-top: 20px;">
              <div class = "scroll" style = "width: 1065px;">
        <?php
            $sql = "SELECT orderID,customerName,address, orderStatus FROM orders WHERE orderID = $custOrdid";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
              if($resultCheck > 0){
                while ($row = mysqli_fetch_assoc($result)){         
                        echo "<h3>";
                        echo "OrderID:"." "."  ".$row['orderID']." ------- "."Order Status:"." "."  ".$row['orderStatus'];  
                        echo "</h3>";
             
                        echo"<h3>";
                        echo "Customer Name:"."  "."   ".$row['customerName'];
                        echo"</h3>";

                        echo"<h3>";
                        echo"Address:"."    ".$row['address'];
                        echo"</h3>";  
                        } }
        ?>
        <div class = "infoNotification">
            <?php
	   echo"<table cellpadding = '3' style = 'font-size:25px;'>";
            echo"<tr>"; 
                        echo"<th style = 'padding-left: 50px;'>ID</th>";
                         
                        echo"<th style = 'padding-left:100px;padding-right:100px;'>ProductName</th>";
         
                        echo"<th style = 'padding-right:70px;'>Quantity</th>";
              
                        echo"<th style = 'padding-right:70px;'>Size</th>";
            
                        echo"<th style = 'padding-right:70px;'>Color</th>";

                        echo"<th style = 'padding-right:70px;'>Price</th>";
             echo" </tr>";
            ?>
                <?php
                $sql = "SELECT * FROM ordercontents WHERE ordercontents.orderID = $custOrdid";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

              if($resultCheck > 0){
                
                while ($row = mysqli_fetch_assoc($result)){
            echo"<tr style ='text-align:center;' >";
                echo "<td style = 'padding-left: 50px;'>";
                    echo $row['productID'];
                echo"</td>";

                echo"<td>";
                    echo $row['productName']; 
                echo"</td>";
               
                echo"<td style='padding-right:70px;' >" ;
                    echo $row['qty']; 
                echo"</td>";

                echo "<td style='padding-right:70px;'>";
                    echo $row['size'];
                echo"</td>";
                echo "<td style='padding-right:70px;'>";
                     echo $row['colorName'];
                echo"</td>";
                echo "<td style='padding-right:70px;' >";
                     echo $row['price'];
                echo"</td>";
            echo"</tr>";
                $total = $total + $row['price'];
                     }}
        ?>       
	    </table>      
     </div>
             <?php
                $sql = "SELECT customerID,paymentMethod FROM orders WHERE orders.customerID = $custId";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);
              if($resultCheck > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    $pmethods = "   ".$row['paymentMethod'];
                }
            }
           echo"<h4>"; 
             echo"PaymentMethod   ".$pmethods."&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp  &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp"."Total    ".$total;
            echo"</h4><br>"; 
	    
	     echo"<h4>Order Status Messages</h4><br>";
	     echo"<h7>Packed: Items are successfully packed by the seller and is ready for shipment, items have already been checked, organized and is in good condition.<br><br>
		     Pending: Pending items are still waiting to be confirmed, kindly wait for the confirmation of the seller.<br><br>
		     Rejected: Order has been rejected due to certain issues, item is out of stocks or would be available until further notice.<br><br>
		     Confirmed: The order is now confirmed please wait for the item to be packed.<br><br>
		     Cancelled: Order is cancelled by the customer.<br><br>
		     Delivered: Orders have already been delivered. This ensures that the item cannot be refunded since the item is in good condition.You can now rate the products you have ordered.<br><br>
		     Fail Delivery: The items had undergone fail delivery due to unforeseen circumstances. If the payment is done through gcash please see the <h7 style = font-weight:bold>ABOUT US</h7> page for contact details.<br><br>
		     Shipped: Items have already been dispatched and is arriving soon. Rest assured that the items will be in good hands and will come shortly.<br><br>
	</h7>";
	     
              //  echo"<p>";
               //  echo"Total        ".$total;
               // echo"</p>";
        ?>
        <?php (isset($_GET['status'])); 
                $sql20 = "SELECT orderID,customerName,address,orderStatus FROM orders WHERE orderID = $custOrdid";
                $result20 = mysqli_query($conn, $sql20);
                $row20 = mysqli_fetch_assoc($result20);
                $stats = $row20['orderStatus']?>
      
        <h4>Select Order Status Notification</h4>
        <form action="feedback-ongoing.php?orderID=<?=$custOrdid?>&customerID=<?=$customerID?>" method="post">

        <?php if ($stats == "Pending") {?>
            <center><h3>This Order is still Pending and Waiting to be Confirmed <a href="../orders/all-orders.php" style="color: blue"> Click Here to Confirm Pending Orders</a><br></h3></center>
        <?php } if ($stats == "Rejected") {?>
            <center><h3>This Order has been Rejected <h3></center>
        <?php } if ($stats == "Cancelled") {?>
            <center><h3>This Order has been Cancelled by the Customer</h3></center>
        <?php }if ($stats == "Delivered"){?>
            <center><h3>This Order has already been delivered</h3></center>
        <?php }if ($stats == "Failed Delivery"){?>
            <center><h3>This Order has already been cancelled due to Failed Delivery</h3></center>
        <?php } if ($stats == "Confirmed") {?>
            <input class = "ShippingMethod" type = "radio" name = "status" value = "Packed">
            <label class = "ShippingMethod" for = "Packed" style = "padding-right: 10px;">Packed (Sets Status to Packed)</label>
            <input  class = "ShippingMethod" type = "radio" name = "status" value = "Shipped">
            <label class = "ShippingMethod" for = "Shipping" style = "padding-right: 10px;">Shipped (Sets Status to shipped)</label>
            <input class = "ShippingMethod" type = "radio" name = "status" value = "Failed Delivery">
            <label class = "ShippingMethod" for = "Failed Delivery" >Failed Delivery (Sets Status to Failed Delivery)</label>
        <?php } if ($stats == "Packed") {?>
            <input  class = "ShippingMethod" type = "radio" name = "status" value = "Shipped">
            <label class = "ShippingMethod" for = "Shipping" style = "padding-right: 10px;">Shipped (Sets Status to shipped)</label>
            <input class = "ShippingMethod" type = "radio" name = "status" value = "Failed Delivery">
            <label class = "ShippingMethod" for = "Failed Delivery" >Failed Delivery (Sets Status to Failed Delivery)</label>
        <?php } if ($stats == "Shipped") {?>
            <center><h3>If this Order has been Delivered <a href="../orders/shippedOrder.php" style="color: blue"> Click Here to Confirm its Delivery</a></h3></center>
            <input class = "ShippingMethod" type = "radio" name = "status" value = "Failed Delivery">
            <label class = "ShippingMethod" for = "Failed Delivery" >Failed Delivery (Sets Status to Failed Delivery)</label>
        <?php }?>
            <!-- <label class = "Shipping Method" for = "customer order id"><br>Order ID Confirmation Input</label>
            <input class = "ShippingMethod" type = "text" name = "ordid"  value = "" required> -->
        </div>
    </div>

    <div class = "tabReturnNext">
        <ul>
        <?php if ($stats == "Delivered"){?>
            <li><button id = "Back" onclick = "window.location.href = 'all-feedbacks.php';">Back</button></li>
        <?php }else if ($stats == "Cancelled"){?>
            <li><button id = "Back" onclick = "window.location.href = 'all-feedbacks.php';">Back</button></li>
        <?php }else if ($stats == "Failed Delivery"){?>
            <li><button id = "Back" onclick = "window.location.href = 'all-feedbacks.php';">Back</button></li>
        <?php }else if ($stats == "Pending"){?>
            <li><button id = "Back" onclick = "window.location.href = 'all-feedbacks.php';">Back</button></li>
        <?php }else{?>
            <li><button id = "Back" onclick = "window.location.href = 'all-feedbacks.php';">Back</button></li>
            <li><button type = "submit" class = "btn btn-primary" name="update" style = "font-weight: bold;">Update </button></li>
        <?php }?>

        </ul>
    </div>
</form>
</body>
</html>
<?php
}else{
header("Location: ../login.php");
exit();
}