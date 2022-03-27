<?php

if (isset($_GET['orderID'])){
    include "db_conn.php";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
      
    $custID = validate($_GET['customerID']);
    $orderID = validate($_GET['orderID']);
    $notification = "Your order (Order ID $orderID) has been confirmed, please wait for the item to be packed.";
    $orderStatus = "Confirmed";

    /*
    $user_data = 'orderID='. $orderID. '&orderStatus='. $orderStatus. '&notification='. $notification. '&customerID='. $customerID;
    echo $user_data;
    exit();
    */
    $sql = "SELECT * FROM ordercontents WHERE orderID = $orderID";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    while($row = mysqli_fetch_assoc($result)){
            $colorID = $row['colorID'];
            $quan = $row['qty'];
            

            $sql1 = "SELECT * FROM product_variant WHERE colorID = $colorID ORDER BY stocks ASC";
            $result1 = mysqli_query($conn, $sql1);
            $resultCheck1 = mysqli_num_rows($result1);
            $row1 = mysqli_fetch_assoc($result1);
            $availStocks = $row1['stocks'];                

            if($quan > $availStocks){
                header("Location: all-orders.php?orderID=$orderID&error=Order can't be confirmed not enough stocks available.");
                exit();
            }
    }
    
    
    $sql10 = "UPDATE orders SET orderStatus = '$orderStatus'WHERE orderID = '$orderID' ";
    $result10 = mysqli_query($conn, $sql10);
    
    date_default_timezone_set("Asia/Manila");
    $date = date('m-d-Y h:ia');
    $sql2 = "INSERT INTO notif(customerID, orderID, notification, datetime, orderStatus)
            VALUES('$custID', '$orderID', '$notification', '$date', '$orderStatus')";
    $result2 =mysqli_query($conn, $sql2);

    $sql3 = "SELECT * FROM ordercontents WHERE orderID = $orderID";
    $result3 = mysqli_query($conn, $sql3);
    $resultCheck3 = mysqli_num_rows($result3);
    
    if($resultCheck3 > 0){
        while ($row3 = mysqli_fetch_assoc($result3)){
            $colorID = $row3['colorID'];
            $qty = $row3['qty'];  
            $productID = $row3['productID'];
            echo '<br>';
 
            $sql4 = "UPDATE product_variant SET stocks = (stocks - $qty) WHERE colorID='$colorID'";
            $result4 = mysqli_query($conn, $sql4);
            $sql5 = "UPDATE product SET totalstocks = (totalStocks -$qty) WHERE productID='$productID'";
            $result5 = mysqli_query($conn, $sql5);
        }
    }

    if ($result5){
        header("Location: all-orders.php?orderID=$orderID&success=Order Confirmed! (Order ID $orderID)");
        exit();
    }else {
        header("Location: all-orders.php?orderID=$orderID&error=Unkwown error occured. Please try again");
        exit();
    }
}