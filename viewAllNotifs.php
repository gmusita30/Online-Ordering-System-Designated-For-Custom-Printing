<?php
include "account/db_conn.php";

if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
        include "account/db_conn.php";

        function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        $customerID = validate($_SESSION['customerID']);

        $sql = "SELECT * FROM notif WHERE customerID = '".$_SESSION['customerID']."' ORDER BY notificationID DESC";
        $result = mysqli_query ($conn, $sql);
}else{
        header("Location: account/login.php");
        exit();
    }
?>