<?php
session_start();

if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
include "db_conn.php";

if (isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['pnum']) && isset($_POST['add']) 
&& isset($_POST['uname']) && isset($_POST['emailadd']) && isset($_POST['currentpass'])){
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
    $currentpass = validate($_POST['currentpass']);

    $user_data = 'fname='. $fname. '&lname='. $lname. '&pnum='. $pnum. '&add='. $add. 
    '&uname='. $uname. '&emailadd='. $emailadd. '&currentpass='. $currentpass;

    if (empty($fname)) {
        header("Location: manage-account.php?error=First Name is required&$user_data");
        exit();
    }else if(empty($lname)){
        header("Location: manage-account.php?error=Last Name is required&$user_data");
        exit();
    }else if(empty($pnum)){
        header("Location: manage-account.php?error=Phone number is required&$user_data");
        exit();
    }else if(empty($add)){
        header("Location: manage-account.php?error=Address is required&$user_data");
        exit();
    }else if(empty($uname)){
        header("Location: manage-account.php?error=Username is required&$user_data");
        exit();
    }else if(empty($emailadd)){
        header("Location: manage-account.php?error=Email is required&$user_data");
        exit();
    }else if(empty($currentpass)){
        header("Location: manage-account.php?error=Current Password is required&$user_data");
        exit();
    } else {
        $customerID = $_SESSION['customerID'];

        $sql ="SELECT * FROM customer_users WHERE userName='$uname' ";
        $result = mysqli_query($conn, $sql);
        $sql2 ="SELECT * FROM customer_users WHERE email='$emailadd' ";
        $result2 = mysqli_query($conn, $sql2);

       //$row = mysqli_fetch_assoc($result2);
        // if (password_verify($oldpass, $row['pw'])){
       //$currentPassw = password_verify($currentpass, $row['pw']);
        $sql3 = "SELECT pw FROM customer_users WHERE customerID='$customerID'";
        $result3 = mysqli_query($conn, $sql3);

        if($uname == ($_SESSION['userName'])){            
        }else if(mysqli_num_rows($result) > 0){
            header("Location: manage-account.php?error=The Username has already been taken&$user_data");
            exit();
        }

        if($emailadd == ($_SESSION['email'])){
        }else if(mysqli_num_rows($result2) > 0){
            header("Location: manage-account.php?error=The Email has already been taken&$user_data");
            exit();     
        }

        if(mysqli_num_rows($result3) === 1){
            
            $sql_4 = "UPDATE customer_users SET customerFName = '$fname' WHERE customerID='$customerID'";
            mysqli_query($conn, $sql_4);
            $sql_5 = "UPDATE customer_users SET customerLName = '$lname' WHERE customerID='$customerID'";
            mysqli_query($conn, $sql_5);
            $sql_6 = "UPDATE customer_users SET phonenum = '$pnum' WHERE customerID='$customerID'";
            mysqli_query($conn, $sql_6);
            $sql_7 = "UPDATE customer_users SET address = '$add' WHERE customerID='$customerID'";
            mysqli_query($conn, $sql_7);
            $sql_8 = "UPDATE customer_users SET userName = '$uname' WHERE customerID='$customerID'";
            mysqli_query($conn, $sql_8);
            $sql_9 = "UPDATE customer_users SET email = '$emailadd' WHERE customerID='$customerID'";
            mysqli_query($conn, $sql_9);
            $sql10 = "SELECT * FROM customer_users WHERE userID='$customerID' ";
            $result10 = mysqli_query($conn, $sql);
                    
            if (mysqli_num_rows($result10) === 1) {
                $row = mysqli_fetch_assoc($result10);
                if ($row['customerID'] === $customerID && password_verify($currentpass, $row['pw'])) {
                    $_SESSION['customerID'] = $row['customerID'];
                    $_SESSION['customerFName'] = $row['customerFName'];
                    $_SESSION['customerLName'] = $row['customerLName'];
                    $_SESSION['phonenum'] = $row['phonenum'];
                    $_SESSION['address'] = $row['address'];
                    $_SESSION['userName'] = $row['userName'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['pw'] = $row['pw'];
                
            header("Location: manage-account.php?success=You have successfully edited your account");
            exit();
                }
            }
        } else {
            header("Location: manage-account.php?error=Incorrect password");
            exit();
        }
    }
//}

}else{
    header("Location: manage-account.php");
    exit();
}

}else{
    header("Location: login.php");
    exit();
}