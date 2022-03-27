<?php

if(isset($_POST['update'])){
    if(isset($_POST['cartID']) && isset($_POST['colorID']) && isset($_POST['qty']) && isset($_POST['stocks'])){
        include "../account/db_conn.php";
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $cartID = validate($_POST['cartID']);
        $colorID = validate($_POST['colorID']);
        $qty = validate($_POST['qty']);
        $stocks = validate($_POST['stocks']);

        if(empty($qty)){
            header("Location:cart-page.php?error=Quantity must not be 0");
            exit();
        }elseif($qty <= 0){
            header("Location:cart-page.php?error=Quantity must not be below 0");
            exit();
        }elseif($qty > $stocks){
            header("Location:cart-page.php?error=Quantity must not exceeded the current stocks");
            exit();
        } else{
            $sql = "UPDATE cart SET colorID = '$colorID', quantity='$qty' WHERE cartID='$cartID'";
            $result = mysqli_query($conn, $sql);
            if ($result){
                header("Location:cart-page.php?success=You have successfully updated an item in your cart");
                exit();
            } else {
                header("Location:cart-page.php?error=Unknown error occured");
                exit();
            }
        }
    }
}else {
    header("Location:cart-page.php");
}