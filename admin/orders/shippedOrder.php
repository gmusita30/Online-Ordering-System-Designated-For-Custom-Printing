<?php
session_start();
include_once 'db_conn.php';


if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order - View All Orders</title>
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

    <div class = "order-settings">
            <button> <a href="edit-shipping.php">Edit Shipping Fees</a></button>
    </div>
    
    <div class = "order-container">
        <h1>Shipped Orders</h1>
        <div class = "scroll">
        <table style = "border: 2px solid black; table-layout: fixed; width: 1110px; margin-left: 370px; background-color: beige; box-shadow: 5px 10px gray;" cellpadding = "10">
        <tr id = "orders" class = "orders">
            <th>orderID</th>
            <th>customer ID</th>
            <th>Customer Name</th>
            <th>Phone Number</th>
            <th>Mode of Payment</th>
            <th>Price</th>
            <th>Status</th>
            <th>Last Update</th>
            <th>View</th>
        </tr>

        <?php
            
            $sql = "SELECT * FROM orders WHERE orderStatus = 'Shipped' ORDER BY orderID DESC";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck > 0){
                while ($row = mysqli_fetch_assoc($result)){
            
            ?>
        <tr id="orderlist">
            <form action = "view-order.php" method = "post">
            <td><?php echo $row['orderID'];?></td>
            <td><?php echo $row['customerID'];?></td>
            <td><?php echo $row['customerName'];?></td>
            <td><?php echo $row['phonenum'];?></td>
            <td><?php echo $row['paymentMethod'];?></td>
            <td><?php echo $row['price'];?></td>
            <td><?php echo $row['orderStatus'];?></td>
            <td>
                <?php 
                    $orderID = $row['orderID'];
                    $status = $row['orderStatus'];
                    $sql10 = "SELECT datetime FROM notif WHERE orderID = '$orderID' AND orderStatus = '$status'";
                    $result10 = mysqli_query($conn, $sql10);
                    $resultCheck10 = mysqli_num_rows($result10);

                    if($resultCheck10 > 0){
                        $row10 = mysqli_fetch_assoc($result10);
                        echo $row10['datetime'];
                    }
                ?>
            </td>
            <input type = "hidden" name = "id" value="<?php echo $row['orderID']; ?>">
            <td style = "padding-left: 30px; padding-right:50px;"><a href="view-order.php?id=<?php echo $row['orderID']; ?>"><button name = "view" style = "border: none; background-color:transparent; font-size: 25px; font-family: Times New Roman; font-weight: bold;">View</button></a></td>
            </form>
        </tr>
            <?php }
                }?>
        </tr>
        </table>
        </div> 
    </div>

    <div>

    </div>

    <div class = "order-buttons">
    <ul>
        <li><button><a href ="pendingOrder.php">Pending</a></button></li>
        <li><button><a href ="shippedOrder.php">Shipped</a></button></li>
        <li><button><a href ="confirmedOrder.php">Confirmed</a></button></li>
        <li><button><a href ="rejectedOrder.php">Rejected</a></button></li>
        <li><button><a href ="deliveredOrder.php">Delivered</a></button></li>
        <li><button><a href ="cancelledOrder.php">Cancelled</a></button></li>
        <li><button><a href ="faileddeliveryOrder.php">Failed Delivery</a></button></li>
        </ul>
    </div>
</body>
</html>
</body>
</html>
<?php
}else{
    header("Location: ../login.php");
    exit();
}
?>