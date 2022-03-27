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
    $notification = "Your order (Order ID $orderID) has been delivered (confirmed by store). This ensures that the item cannot be refunded since the item is in good condition. You can now rate the products you have ordered.";
    $orderStatus = "Delivered";

    /*
    $user_data = 'orderID='. $orderID. '&orderStatus='. $orderStatus. '&notification='. $notification. '&customerID='. $customerID;
    echo $user_data;
    exit();
    */

    $sql = "UPDATE orders SET orderStatus = '$orderStatus'WHERE orderID = '$orderID' ";
    $result = mysqli_query($conn, $sql);

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
                $qty = $row3['qty'];  
                $productID = $row3['productID'];
                $sql4 = "UPDATE product SET sold = (sold + $qty) WHERE productID='$productID'";
                $result4 = mysqli_query($conn, $sql4);
            }
        }

    if ($result4){
        header("Location: all-orders.php?orderID=$orderID&success=Order Delivery Confirmed! (Order ID $orderID)");
        exit();
    }else {
        header("Location: all-orders.php?orderID=$orderID&error=Unkwown error occured. Please try again");
        exit();
    }
}