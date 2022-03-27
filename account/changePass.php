<?php
session_start();

if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
include "db_conn.php";

if (isset($_POST['oldpass']) && isset($_POST['newpass']) && isset($_POST['repeatnewpass'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    $oldpass = validate($_POST['oldpass']);
    $newpass = validate($_POST['newpass']);
    $repeatnewpass = validate($_POST['repeatnewpass']);

    $newPassw = password_hash($newpass, PASSWORD_DEFAULT);

    if(empty($oldpass)){
        header("Location: manageaccount-changepass.php?error=Old password is required");
        exit();
    } else if(empty($newpass)){
        header("Location: manageaccount-changepass.php?error=New password is required");
        exit();
    } else if($newpass !== $repeatnewpass){
        header("Location: manageaccount-changepass.php?error=New password does not match please repeat new password again");
        exit();
    } else {
        $customerID = $_SESSION['customerID'];

        $sql = "SELECT pw FROM customer_users WHERE customerID='$customerID'";
        $result = mysqli_query($conn, $sql);
        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if (password_verify($oldpass, $row['pw'])){
                $sql_2 = "UPDATE customer_users SET pw = '$newPassw' WHERE customerID='$customerID'";
                mysqli_query($conn, $sql_2);
                header("Location: manageaccount-changepass.php?success=You have successfully changed your password");
                exit();
            }
        }else {
            header("Location: manageaccount-changepass.php?error=Incorrect password");
            exit();
        }
    }

}else{
    header("Location: manageaccount-changepass.php");
    exit();
}

}else{
    header("Location: login.php");
    exit();
}