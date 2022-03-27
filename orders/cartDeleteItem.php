<?php

if(isset($_GET['cartID'])){
    include "../account/db_conn.php";
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $cartID = validate($_GET['cartID']);

    $sql = "DELETE FROM cart
            WHERE cartID=$cartID";
    $result = mysqli_query($conn, $sql);
    if ($result){
        header("Location:cart-page.php?success=You have successfully removed an item in your cart");
        exit();
    } else {
        header("Location:cart-page.php?cartID=$cartID&error=Unknown error occured");
        exit();
    }

}else {
    header("Location:cart-page.php");
}