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

}else if(isset($_POST['update'])){
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
    $customerID = validate($_POST['customerID']);
    $un = validate($_POST['un']);
    $eadd = validate($_POST['eadd']);

    $user_data = 'fname='. $fname. '&lname='. $lname. '&pnum='. $pnum. '&add='. $add. '&uname='. $uname.
                '&emailadd='. $emailadd. '&passw='. $passw. '&repeatpass='. $repeatpass. 
                '&customerID='. $customerID. '&un='. $un. '&eadd='. $eadd;

    //echo $user_data;
    
    if (empty($fname)) {
        header("Location: edit-customer-user.php?customerID=$customerID&error=First Name is required&$user_data");
        exit();
    }else if(empty($lname)){
        header("Location: edit-customer-user.php?customerID=$customerID&error=Last Name is required&$user_data");
        exit();
    }else if(empty($pnum)){
        header("Location: edit-customer-user.php?customerID=$customerID&error=Phone number is required&$user_data");
        exit();
    }else if(empty($add)){
        header("Location: edit-customer-user.php?customerID=$customerID&error=Address is required&$user_data");
        exit();
    }else if(empty($uname)){
        header("Location: edit-customer-user.php?customerID=$customerID&error=Username is required&$user_data");
        exit();
    }else if(empty($emailadd)){
        header("Location: edit-customer-user.php?customerID=$customerID&error=Email is required&$user_data");
        exit();
    }else if(empty($passw)){
        header("Location: edit-customer-user.php?customerID=$customerID&error=Password is required&$user_data");
        exit();
    }else if(empty($repeatpass)){
        header("Location: edit-customer-user.php?customerID=$customerID&error=Repeat password is required&$user_data");
        exit();
    }else if($passw !== $repeatpass){
        header("Location: edit-customer-user.php?customerID=$customerID&error=The passwords do not match&$user_data");
        exit();
    } else {

        //hashing the password
        //$passw = md5($passw);

        $sql ="SELECT * FROM customer_users WHERE userName='$uname' ";
        $result = mysqli_query($conn, $sql);
        $sql2 ="SELECT * FROM customer_users WHERE email='$emailadd' ";
        $result2 = mysqli_query($conn, $sql2);

        $Pass = password_hash($passw, PASSWORD_DEFAULT);
        if($uname == $un){

        }else if(mysqli_num_rows($result) > 0){
            header("Location: edit-customer-user.php?customerID=$customerID&error=The Username has already been taken&$user_data");
            exit();
        }

    if($emailadd == $eadd){

    }else if(mysqli_num_rows($result2) > 0){
        header("Location: edit-customer-user.php?customerID=$customerID&error=The Email has already been taken&$user_data");
        exit();
    } 
        
    $sql3 = "UPDATE customer_users
                SET customerFName = '$fname', customerLName = '$lname', phonenum = '$pnum', 
                    address = '$add', userName = '$uname', email = '$emailadd', pw = '$Pass'
                WHERE customerID = '$customerID' ";
    $result3 = mysqli_query($conn, $sql3);
        
    if ($result3){
        header("Location: edit-customer-user.php?customerID=$customerID&success=You have successfully edited a customer user");
        exit();
    }else {
        header("Location: edit-customer-user.php?customerID=$customerID&error=Unkwown error occured. Please try again&$user_data");
        exit();            
    }
    }


    }else {
        header("Location:all-customer-users.php");
    }
}