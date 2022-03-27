<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
    header("Location: edit-account.php");
    exit();
}

if (isset($_POST['uname']) && isset ($_POST['password'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);
    // $passw = password_verify($pass, $row['pw']);
    // $rowPass = $row['pw'];
        
    if (empty($uname)) {
        header("Location: login.php?error=Username is required");
        exit();
    }else if(empty($pass)){
        header("Location: login.php?error=Password is required");
        exit();
    }else{
        //hashing the password
        //$pass = md5($pass);

        $sql = "SELECT * FROM customer_users WHERE userName='$uname'";
            
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['userName'] === $uname && password_verify($pass, $row['pw'])) {
                $_SESSION['customerID'] = $row['customerID'];
                $_SESSION['customerFName'] = $row['customerFName'];
                $_SESSION['customerLName'] = $row['customerLName'];
                $_SESSION['phonenum'] = $row['phonenum'];
                $_SESSION['address'] = $row['address'];
                $_SESSION['userName'] = $row['userName'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['pw'] = $row['pw'];
                header("Location: ../index.php");
                exit();
            }else{
                header("Location: login.php?error=Incorrect Username or password");    
                exit();
            }        
        }
    }
    
}else{
    header("Location: login.php");
    exit();
}
