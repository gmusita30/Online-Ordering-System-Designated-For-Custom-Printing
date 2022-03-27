<?php

if (isset($_GET['orderID'])){
    include "../account/db_conn.php";

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    $orderID = validate($_GET['orderID']);

    $sql = "SELECT * FROM orders WHERE orderID=$orderID";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }else{
        header("Location:order-page.php");
    }

}else if(isset($_POST['cancel'])){
    include "../db_conn.php";

    if (isset($_POST['orderID']) && isset($_POST['orderStatus']) && isset($_POST['customerID'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    $orderID = validate($_POST['orderID']);
    $orderStatus = validate($_POST['orderStatus']);
    $customerID = validate($_POST['customerID']);
    $notification = "Your order (Order ID $orderID) has been cancelled.";
    date_default_timezone_set("Asia/Manila");
    $date = date('Y-m-d h:ia');

    $user_data = 'orderID='. $orderID. '&orderStatus='. $orderStatus;

    $sql2 = "UPDATE orders SET orderStatus = '$orderStatus'WHERE orderID = '$orderID' ";
    $result2 = mysqli_query($conn, $sql2);
    $sql3 = "INSERT INTO notif(customerID, orderID, notification, datetime, orderStatus)
             VALUES('$customerID', '$orderID', '$notification', '$date', '$orderStatus')";
    $result3 =mysqli_query($conn, $sql3);

    $user_data = 'orderID='. $orderID. '&orderStatus='. $orderStatus. '&notification='. $notification;

    if ($result3){
        header("Location: order-page.php?orderID=$orderID&success=You have cancelled Order ID $orderID");
        exit();
    }else {
        header("Location: order-cancel-page.php?orderID=$orderID&error=Unkwown error occured. Please try again");
        exit();
    }
    

}else {
    header("Location:order-page.php");

}}