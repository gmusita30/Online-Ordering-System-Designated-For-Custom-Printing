<?php
session_start();
include "db_conn.php";

if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){

    if(isset($_SESSION['customerID'])){
        include "db_conn.php";

        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
            
        $customerID = validate($_SESSION['customerID']);

        $sql = "DELETE FROM customer_users
                WHERE customerID=$customerID";

        $result = mysqli_query($conn, $sql);
        if ($result){
            session_start();
            session_unset();
            session_destroy();

            header("Location: ../index.php");
            exit();
        }else {
            header("Location: delete-account.php?&error=Unkwown error occured. Please try again&$user_data");
            exit();
        }

    }else{
        header("Location:delete-account.php");
    }
}else{
    header("Location: login.php");
    exit();
}