<?php

if (isset($_GET['orderID'])){
    include "../account/db_conn.php";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
      
    $custID = validate($_GET['customerID']);
    $orderID = validate($_GET['orderID']);
    $notification = "Your order (Order ID $orderID) has been delivered (confirmed by you). You can now rate the products you have ordered.";
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

    if ($result2){
        header("Location: order-view-page.php?orderID=$orderID&success=You have successfully confirmed the delivery of your order (Order ID $orderID). You can now rate the products you've ordered");
        exit();
    }else {
        header("Location: order-view-page.php?orderID=$orderID&error=Unkwown error occured. Please try again");
        exit();
    }
}