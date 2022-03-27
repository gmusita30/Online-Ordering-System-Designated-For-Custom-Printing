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

    $sql = "SELECT * FROM cart 
            INNER JOIN product_variant ON cart.colorID = product_variant.colorID 
            INNER JOIN product ON product.productID = product_variant.productID 
            WHERE customerID = '".$_SESSION['customerID']."' ORDER BY cartID";
    $result = mysqli_query ($conn, $sql);


    $sql2 = "SELECT * FROM cart 
            INNER JOIN product_variant ON cart.colorID = product_variant.colorID 
            INNER JOIN product ON product.productID = product_variant.productID 
            WHERE customerID = '".$_SESSION['customerID']."' ORDER BY cartID";
    $result2 = mysqli_query ($conn, $sql2);
    $num_rows = mysqli_num_rows($result2);
    
}else{
        header("Location: ../account/login.php");
        exit();
    }
?>