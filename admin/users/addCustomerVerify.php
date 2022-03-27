<?php
session_start();
include "../db_conn.php";

if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['pnum']) && isset($_POST['add']) 
&& isset($_POST['uname']) && isset($_POST['emailadd']) && isset($_POST['passw']) && isset($_POST['repeatpass'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $pnum = validate($_POST['pnum']);
    $add = validate($_POST['add']);
    $uname = validate($_POST['uname']);
    $emailadd = validate($_POST['emailadd']);
    $passw = validate($_POST['passw']);
    $repeatpass = validate($_POST['repeatpass']);

    $user_data = 'fname='. $fname. '&lname='. $lname. '&pnum='. $pnum. '&add='. $add. 
    '&uname='. $uname. '&emailadd='. $emailadd. '&passw='. $passw. '&repeatpass='. $repeatpass;

    //echo $user_data;
        
    if (empty($fname)) {
        header("Location: add-customer-user.php?error=First Name is required&$user_data");
        exit();
    }else if(empty($lname)){
        header("Location: add-customer-user.php?error=Last Name is required&$user_data");
        exit();
    }else if(empty($pnum)){
        header("Location: add-customer-user.php?error=Phone number is required&$user_data");
        exit();
    }else if(empty($add)){
        header("Location: add-customer-user.php?error=Address is required&$user_data");
        exit();
    }else if(empty($uname)){
        header("Location: add-customer-user.php?error=Username is required&$user_data");
        exit();
    }else if(empty($emailadd)){
        header("Location: add-customer-user.php?error=Email is required&$user_data");
        exit();
    }else if(empty($passw)){
        header("Location: add-customer-user.php?error=Password is required&$user_data");
        exit();
    }else if(empty($repeatpass)){
        header("Location: add-customer-user.php?error=Repeat password is required&$user_data");
        exit();
    }else if($passw !== $repeatpass){
        header("Location: add-customer-user.php?error=The passwords do not match&$user_data");
        exit();
    }
    
    else{

        //hashing the password
        //$passw = md5($passw);

        $sql ="SELECT * FROM customer_users WHERE userName='$uname' ";
        $result = mysqli_query($conn, $sql);
        $sql2 ="SELECT * FROM customer_users WHERE email='$emailadd' ";
        $result2 = mysqli_query($conn, $sql2);
        
        if (mysqli_num_rows($result) > 0){
            header("Location: add-customer-user.php?error=The Username has already been taken&$user_data");
            exit();
        } else if(mysqli_num_rows($result2) > 0){
            header("Location: add-customer-user.php?error=The Email has already been taken&$user_data");
            exit();
        } else {
            $sql3 = "INSERT INTO customer_users(customerFName, customerLName, phonenum, address, userName, email, pw)
                VALUES('$fname', '$lname', '$pnum', '$add', '$uname', '$emailadd', '$passw')";
            $result3 = mysqli_query($conn, $sql3);
            if ($result3){
                header("Location: add-customer-user.php?success=You have successfully added a new customer user");
                exit();
            }else {
                header("Location: add-customer-user.php?error=Unkwown error occured. Please try again&$user_data");
                exit();
            }
        }
    }
}else{
    header("Location: add-customer-user.php");
    exit();
}
