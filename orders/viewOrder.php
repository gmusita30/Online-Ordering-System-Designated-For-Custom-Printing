<?php
include "../account/db_conn.php";

if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
        include "../account/db_conn.php";

        function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        $customerID = validate($_SESSION['customerID']);
        $orderID = validate($_GET['orderID']);

        $sql = "SELECT * FROM orders WHERE orderID = $orderID ORDER BY orderID DESC";
        $result = mysqli_query ($conn, $sql);
        $rows = mysqli_fetch_assoc($result);

        $sql2 = "SELECT * FROM ordercontents 
                INNER JOIN product ON ordercontents.productID = product.productID
                WHERE orderID = $orderID ORDER BY orderID DESC";
        $result2 = mysqli_query ($conn, $sql2);
        //$rows2 = mysqli_fetch_assoc($result2);

}else{
        header("Location: ../account/login.php");
        exit();
    }
?>