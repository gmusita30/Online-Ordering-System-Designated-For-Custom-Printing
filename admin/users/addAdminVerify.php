<?php
session_start();
include "../db_conn.php";

if (isset($_POST['uname']) && isset($_POST['name']) && isset($_POST['pnum']) && isset($_POST['pos']) 
&& isset($_POST['emailadd']) && isset($_POST['passw']) && isset($_POST['repeatpass'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    $uname = validate($_POST['uname']);
    $name = validate($_POST['name']);
    $pnum = validate($_POST['pnum']);
    $pos = validate($_POST['pos']);
    $emailadd = validate($_POST['emailadd']);
    $passw = validate($_POST['passw']);
    $repeatpass = validate($_POST['repeatpass']);

    $user_data = 'uname='. $uname. '&name='. $name. '&pnum='. $pnum. '&pos='. $pos. 
                '&emailadd='. $emailadd. '&passw='. $passw. '&repeatpass='. $repeatpass;

    //echo $user_data;
        
    if (empty($uname)) {
        header("Location: add-admin-user.php?error=Username is required&$user_data");
        exit();
    }else if(empty($name)){
        header("Location: add-admin-user.php?error=Name is required&$user_data");
        exit();
    }else if(empty($pnum)){
        header("Location: add-admin-user.php?error=Phone number is required&$user_data");
        exit();
    }else if(empty($pos)){
        header("Location: add-admin-user.php?error=Position is required&$user_data");
        exit();
    }else if(empty($emailadd)){
        header("Location: add-admin-user.php?error=Email is required&$user_data");
        exit();
    }else if(empty($passw)){
        header("Location: add-admin-user.php?error=Password is required&$user_data");
        exit();
    }else if(empty($repeatpass)){
        header("Location: add-admin-user.php?error=Repeat password is required&$user_data");
        exit();
    }else if($passw !== $repeatpass){
        header("Location: add-admin-user.php?error=The passwords do not match&$user_data");
        exit();
    }
    
    else{

        //hashing the password
        //$passw = md5($passw);

        $sql ="SELECT * FROM admin_users WHERE userName='$uname' ";
        $result = mysqli_query($conn, $sql);
        $sql2 ="SELECT * FROM admin_users WHERE email='$emailadd' ";
        $result2 = mysqli_query($conn, $sql2);
        
        if (mysqli_num_rows($result) > 0){
            header("Location: add-admin-user.php?error=The Username has already been taken&$user_data");
            exit();
        } else if(mysqli_num_rows($result2) > 0){
            header("Location: add-admin-user.php?error=The Email has already been taken&$user_data");
            exit();
        } else {
            $sql3 = "INSERT INTO admin_users(userName, adminName, phonenum, position, email, pw)
                VALUES('$uname', '$name', '$pnum', '$pos', '$emailadd', '$passw')";
            $result3 = mysqli_query($conn, $sql3);
            if ($result3){
                header("Location: add-admin-user.php?success=You have successfully added a new admin user");
                exit();
            }else {
                header("Location: add-admin-user.php?error=Unkwown error occured. Please try again&$user_data");
                exit();
            }
        }
    }
}else{
    header("Location: add-admin-user.php");
    exit();
}
