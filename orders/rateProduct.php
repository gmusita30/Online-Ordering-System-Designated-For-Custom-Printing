<?php
include "../account/db_conn.php";

if(isset($_POST['rate'])){
    if(isset($_POST['orderCID']) && isset($_POST['orderID']) && isset($_POST['productID']) 
        && isset($_POST['colorID']) && isset($_POST['qty']) && isset($_POST['rating']) && isset($_POST['comment'])){
        include "../account/db_conn.php";
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $orderCID = validate($_POST['orderCID']);
        $orderID = validate($_POST['orderID']);
        $productID = validate($_POST['productID']);
        $colorID = validate($_POST['colorID']);
        $qty = validate($_POST['qty']);
        $rating = validate($_POST['rating']);
        $comment = validate($_POST['comment']);

        if($rating == ''){
            header("Location:order-view-page.php?orderID=$orderID&error=Rating must not be blank");
            exit();
        }else if($rating < 1){
            header("Location:order-view-page.php?orderID=$orderID&error=Rating must not be below than 0");
            exit();
        }else if($rating > '5'){
            header("Location:order-view-page.php?orderID=$orderID&error=Rating must not be higher than 5");
            exit();
        }else{
            $sql3 = "UPDATE product SET rate = (rate +$rating) WHERE productID='$productID'";
            $result3 = mysqli_query($conn, $sql3);
            $sql5 = "UPDATE ordercontents SET rateNum = $rating WHERE orderCID='$orderCID'";
            $result5 = mysqli_query($conn, $sql5);
            $sql6 = "UPDATE ordercontents SET rateprd = 'Rated' WHERE orderCID='$orderCID'";
            $result6 = mysqli_query($conn, $sql6);
            $sql7 = "UPDATE ordercontents SET comment = '$comment' WHERE orderCID='$orderCID'";
            $result7 = mysqli_query($conn, $sql7);
            if ($result7){
                header("Location:order-view-page.php?orderID=$orderID&success=You have successfully rated a product");
                exit();
            } else {
                header("Location:order-view-page.php?orderID=$orderID&error=Unknown error occured");
                exit();
            }
        }
    }
}else if(isset($_POST['update'])){
    if(isset($_POST['orderCID']) && isset($_POST['orderID']) && isset($_POST['productID']) 
        && isset($_POST['colorID']) && isset($_POST['qty']) && isset($_POST['rating']) && isset($_POST['prvRate']) && isset($_POST['comment']) && isset($_POST['prvComment'])){
        include "../account/db_conn.php";
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $orderCID = validate($_POST['orderCID']);
        $orderID = validate($_POST['orderID']);
        $productID = validate($_POST['productID']);
        $colorID = validate($_POST['colorID']);
        $qty = validate($_POST['qty']);
        $rating = validate($_POST['rating']);
        $prvRate = validate($_POST['prvRate']);
        $comment = validate($_POST['comment']);
        $prvComment = validate($_POST['prvComment']);

        if($rating < 1){
            header("Location:order-view-page.php?orderID=$orderID&error=Rating must not be below than 0");
            exit();
        }else if($rating > '5'){
            header("Location:order-view-page.php?orderID=$orderID&error=Rating must not be higher than 5");
            exit();
        }else{
            if ($rating > $prvRate){
                $sql3 = "UPDATE product SET rate = (rate + ($rating-$prvRate)) WHERE productID='$productID'";
                $result3 = mysqli_query($conn, $sql3);
            } else if ($rating < $prvRate){
                $sql3 = "UPDATE product SET rate = (rate - ($prvRate-$rating)) WHERE productID='$productID'";
                $result3 = mysqli_query($conn, $sql3);
            }
            $sql5 = "UPDATE ordercontents SET rateNum = $rating WHERE orderCID='$orderCID'";
            $result5 = mysqli_query($conn, $sql5);
            $sql6 = "UPDATE ordercontents SET rateprd = 'Rated' WHERE orderCID='$orderCID'";
            $result6 = mysqli_query($conn, $sql6);
            $sql7 = "UPDATE ordercontents SET comment = '$comment' WHERE orderCID='$orderCID'";
            $result7 = mysqli_query($conn, $sql7);
            if ($result7){
                header("Location:order-view-page.php?orderID=$orderID&success=You have successfully rated a product");
                exit();
            } else {
                header("Location:order-view-page.php?orderID=$orderID&error=Unknown error occured");
                exit();
            }
        }
    }
}