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
    $notification = "Your order (Order ID $orderID) has been rejected due to certain issues, item is out of stocks or would be available until further notice.";
    $orderStatus = "Rejected";

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

    if ($result2){
        header("Location: all-orders.php?orderID=$orderID&success=Order rejected! (Order ID $orderID)");
        exit();
    }else {
        header("Location: all-orders.php?orderID=$orderID&error=Unkwown error occured. Please try again");
        exit();
    }
}