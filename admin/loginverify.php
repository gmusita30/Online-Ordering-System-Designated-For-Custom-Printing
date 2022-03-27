<?php
session_start();
include "db_conn.php";

if (isset($_POST['uname']) && isset ($_POST['password'])){

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $uname = validate($_POST['uname']);
    $pass = validate($_POST['password']);

    if (empty($uname)) {
        header("Location: login.php?error=Username is required");
        exit();
    }else if(empty($pass)){
        header("Location: login.php?error=Password is required");
        exit();
    }else{
        $sql = "SELECT * FROM admin_users WHERE userName='$uname' AND pw='$pass'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['userName'] === $uname && $row['pw'] === $pass) {
                $_SESSION['userName'] = $row['userName'];
                $_SESSION['adminName'] = $row['adminName'];
                $_SESSION['adminID'] = $row['adminID'];
                header("Location: orders/all-orders.php");
                exit();
            }
        }else{
            header("Location: login.php?error=Incorrect Username or password");
            exit();
        }
    }

}else{
    header("Location: login.php");
    exit();
}