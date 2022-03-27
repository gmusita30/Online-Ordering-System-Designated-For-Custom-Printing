<?php
include "../db_conn.php";

if (isset($_POST['update'])){

    if (isset($_POST['loc1']) && isset($_POST['loc2']) && isset($_POST['loc3']) && isset($_POST['loc4']) 
    && isset($_POST['sf1']) && isset($_POST['sf2']) && isset($_POST['sf3']) && isset($_POST['sf4']) 
    && isset($_POST['accname']) && isset($_POST['accnum'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

    $loc1 = validate($_POST['loc1']);
    $loc2 = validate($_POST['loc2']);
    $loc3 = validate($_POST['loc3']);
    $loc4 = validate($_POST['loc4']);
    $sf1 = validate($_POST['sf1']);
    $sf2 = validate($_POST['sf2']);
    $sf3 = validate($_POST['sf3']);
    $sf4 = validate($_POST['sf4']);
    $accname = validate($_POST['accname']);
    $accnum = validate($_POST['accnum']);

    $user_data = 'loc1='. $loc1. '&loc2='. $loc2. '&loc3='. $loc3. '&loc4='. $loc4. 
                '&sf1='. $sf1. '&sf2='. $sf2. '&sf3='. $sf3. '&sf4='. $sf4. 
                '&accname='. $accname. '&accnum='. $accnum;
    //echo $user_data;
    //exit();
    
    if (empty($loc1)) {
        header("Location: edit-shipping.php?error=COD location is required&$user_data");
        exit();
    }else if (empty($loc2)) {
        header("Location: edit-shipping.php?error=COD location is required&$user_data");
        exit();
    } else if (empty($loc3)) {
        header("Location: edit-shipping.php?error=GCash location is required&$user_data");
        exit();
    }else if (empty($loc4)) {
        header("Location: edit-shipping.php?error=GCash location is required&$user_data");
        exit();
    }else if($sf1 < 0){
        header("Location: edit-shipping.php?error=COD shipping fee is required&$user_data");
        exit();
    }else if($sf2 < 0){
        header("Location: edit-shipping.php?error=COD shipping fee is required&$user_data");
        exit();
    }else if($sf3 < 0){
        header("Location: edit-shipping.php?error=GCash shipping fee is required&$user_data");
        exit();
    }else if($sf4 < 0){
        header("Location: edit-shipping.php?error=GCash shipping fee is required&$user_data");
        exit();
    }else if(empty($accname)){
        header("Location: edit-shipping.php?error=GCash Account Name is required&$user_data");
        exit();
    }else if(empty($accnum)){
        header("Location: edit-shipping.php?error=GCash Account Number is required&$user_data");
        exit();
    }else if($accnum <= 0){
        header("Location: edit-shipping.php?error=GCash Account Number should not be zero or less than zero&$user_data");
        exit();
    }else{
        $sql1 = "UPDATE value
                SET valname = '$loc1', price = '$sf1'
                WHERE valueID = 1";
        $result1 = mysqli_query($conn, $sql1);

        $sql2 = "UPDATE value
                SET valname = '$loc2', price = '$sf2'
                WHERE valueID = 2";
        $result2 = mysqli_query($conn, $sql2);

        $sql3 = "UPDATE value
                SET valname = '$loc3', price = '$sf3'
                WHERE valueID = 3";
        $result3 = mysqli_query($conn, $sql3);

        $sql4 = "UPDATE value
                SET valname = '$loc4', price = '$sf4'
                WHERE valueID = 4";
        $result4 = mysqli_query($conn, $sql4);

        $sql5 = "UPDATE value
                SET valname = '$accname', account = '$accnum'
                WHERE valueID = 5";
        $result5 = mysqli_query($conn, $sql5);

        if ($result5){
            header("Location: edit-shipping.php?success=You have successfully edited the information for shipping fees.");
            exit();
        }else {
            header("Location: edit-shipping.php?error=Unkwown error occured. Please try again&$user_data");
            exit();
            
        }
    }
    }
}