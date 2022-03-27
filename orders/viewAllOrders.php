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

        $sql = "SELECT * FROM orders WHERE customerID = '".$_SESSION['customerID']."' ORDER BY orderID DESC";
        $result = mysqli_query ($conn, $sql);

/*
        $sql2 = "SELECT * FROM cart INNER JOIN product ON cart.productID = product.productID WHERE customerID = $customerID ORDER BY cartID";
        $result2 = mysqli_query ($conn, $sql2);
        $num_rows = mysqli_num_rows($result2);

        /*$sql3 = "SELECT * FROM customer_users WHERE customerID = '".$_SESSION['customerID']."'";
        $result3 = mysqli_query ($conn, $sql3);
        $user = mysqli_fetch_assoc($result3);*/
}else{
        header("Location: ../account/login.php");
        exit();
    }
?>