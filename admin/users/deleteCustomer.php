<?php

if (isset($_GET['customerID'])){
    include "../db_conn.php";

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    $customerID = validate($_GET['customerID']);

    $sql = "SELECT * FROM customer_users WHERE customerID=$customerID";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }else{
        header("Location:all-customer-users.php");
    }

}else if(isset($_POST['delete'])){
    include "../db_conn.php";

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $customerID = validate($_POST['customerID']);

    $sql = "DELETE FROM customer_users
            WHERE customerID=$customerID";

    $result = mysqli_query($conn, $sql);
    if ($result){
        header("Location: all-customer-users.php?customerID=$customerID&success=You have successfully deleted a customer user");
        exit();
    }else {
        header("Location: delete-customer-user.php?customerID=$customerID&error=Unkwown error occured. Please try again");
        exit();
    }

}else {
    header("Location:all-customer-users.php");

}