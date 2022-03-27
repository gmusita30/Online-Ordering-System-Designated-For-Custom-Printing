<?php
include "../db_conn.php";
session_start();
$total=0;
$pmethods = "";
$custOrdid = 0;
$custId = 0;
$chk= "";

     if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){ ?>

<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <title>Select Orders</title>
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
        <h1>Feedback - Select Orders to Send Notifications </h1>
    </div>

    <div class = "SelectNotifContainer" style = 'padding-top: 10px'>
    <div class = "scroll">
	  <table cellpadding = '5' style = 'font-size:20px;'>
            <?php
            echo"<tr>";
                        echo"<th style = 'border-bottom: 2px solid black;'>Order ID</th>";

                        echo"<th style = 'padding-left:100px;padding-right:100px; border-bottom: 2px solid black;'>CustomerId</th>";

                        echo"<th style = 'padding-right:70px; border-bottom: 2px solid black;'>CustomerName</th>";

                        echo"<th style = 'padding-right:70px; border-bottom: 2px solid black;'>Price</th>";
                
                        echo"<th style = 'padding-right:70px; border-bottom: 2px solid black;'>Order Status</th>";
                     
			            echo"<th style = 'padding-right:70px; border-bottom: 2px solid black;'>View</th>";      
             echo" </tr>"; ?>

            <?php  $sql = "SELECT orderID,customerID,customerName,price,orderStatus FROM orders ORDER BY orderID DESC";
                   $result = mysqli_query($conn, $sql);
                   $resultCheck = mysqli_num_rows($result);
              if($resultCheck > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    if ($row['orderStatus'] == "Pending"){
                    }else if ($row['orderStatus'] == "Rejected"){
                    }else if ($row['orderStatus'] == "Failed Delivery"){
                    }else if ($row['orderStatus'] == "Delivered"){
                    }else if ($row['orderStatus'] == "Cancelled"){
                    }else {
                        echo"<tr style = 'text-align:center;'>";
                        echo "<td>";
                            echo $row['orderID'];
                        echo"</td>";

                        echo"<td>";
                            echo $row['customerID']; 
                        echo"</td>";
                    
                        echo"<td style='padding-right:70px;'>" ;
                            echo $row['customerName']; 
                        echo"</td >";

                        echo "<td style='padding-right:70px;'>";
                            echo $row['price'];
                        echo"</td>";
                        echo "<td style='padding-right:70px;'>";
                            echo $row['orderStatus'];
                        echo"</td>";

                        echo "<td style='padding-right:70px; font-weight: bold;'>";
                            $ordID = $row['orderID'];
                            $status = $row['orderStatus'];
                            $customerID = $row['customerID'];
                            echo "<a href = 'feedback-ongoing.php?orderID=$ordID&status=$status&customerID=$customerID'>View</a>";
                        echo"</td>";
                        echo"</tr>";      
                    }

                }
            } ?>            
        </table>
        </div>
     </div>
       <!---<div class = "infoContainer">-->
</div>     
</body>
</html>
<?php
}else{
   header("Location: ../login.php");
   exit();
}

?>