<?php
session_start();
include "../db_conn.php";

if (isset($_POST['name']) && isset($_POST['uname']) && isset($_POST['pnum']) && isset($_POST['pos']) 
&& isset($_POST['code']) && isset($_POST['emailadd']) && isset($_POST['passw']) && isset($_POST['repeatpass'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    $name = validate($_POST['name']);
    $uname = validate($_POST['uname']);
    $pnum = validate($_POST['pnum']);
    $pos = validate($_POST['pos']);
    $emailadd = validate($_POST['emailadd']);
    $code = validate($_POST['code']);
    $passw = validate($_POST['passw']);
    $repeatpass = validate($_POST['repeatpass']);

    $user_data = 'name='. $name. '&uname='. $uname. '&pnum='. $pnum. '&pos='. $pos. 
    '&emailadd='. $emailadd. '&passw='. $passw. '&repeatpass='. $repeatpass;
    
    $sql = "SELECT * FROM value WHERE valueID = 6";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }

    $securitycode = $row['account'];
    //echo $user_data;
        
    if (empty($name)) {
        header("Location: signup.php?error=Full Name is required&$user_data");
        exit();
    }else if(empty($uname)){
        header("Location: signup.php?error=Username is required&$user_data");
        exit();
    }else if(empty($pnum)){
        header("Location: signup.php?error=Phone number is required&$user_data");
        exit();
    }else if(empty($pos)){
        header("Location: signup.php?error=Position is required&$user_data");
        exit();
    }else if(empty($emailadd)){
        header("Location: signup.php?error=Email is required&$user_data");
        exit();
    }else if(empty($passw)){
        header("Location: signup.php?error=Password is required&$user_data");
        exit();
    }else if(empty($repeatpass)){
        header("Location: signup.php?error=Repeat your password&$user_data");
        exit();
    }else if($passw !== $repeatpass){
        header("Location: signup.php?error=The passwords do not match&$user_data");
        exit();
    }else if ($code !== $securitycode){
        header("Location: signup.php?error=Incorrect Security Code&$user_data");
        exit();
    }else{

        //hashing the password
        //$passw = md5($passw);

        $sql ="SELECT * FROM admin_users WHERE userName='$uname' ";
        $result = mysqli_query($conn, $sql);
        $sql2 ="SELECT * FROM admin_users WHERE email='$emailadd' ";
        $result2 = mysqli_query($conn, $sql2);
        
        if (mysqli_num_rows($result) > 0){
            header("Location: signup.php?error=The Username has already been taken&$user_data");
            exit();
        } else if(mysqli_num_rows($result2) > 0){
            header("Location: signup.php?error=The Email has already been taken&$user_data");
            exit();
        }  else {
            $sql3 = "INSERT INTO admin_users(adminName, userName, phonenum, position, email, pw)
                VALUES('$name', '$uname', '$pnum', '$pos','$emailadd', '$passw')";
            $result3 = mysqli_query($conn, $sql3);
            if ($result3){
                header("Location: signup.php?success=You have successfully created an account");
                exit();
            }else {
                header("Location: signup.php?error=Unkwown error occured. Please try again&$user_data");
                exit();
            }
        }
    }
}else{
    header("Location: signup.php");
    exit();
}
