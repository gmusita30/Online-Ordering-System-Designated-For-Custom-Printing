<?php
include "../db_conn.php";

if (isset($_POST['update'])){

    if (isset($_POST['accesscode']) && isset($_POST['newcode']) && isset($_POST['renewcode']) && isset($_POST['vercode']) && isset($_POST['code'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

    $accesscode = validate($_POST['accesscode']);
    $newcode = validate($_POST['newcode']);
    $renewcode = validate($_POST['renewcode']);
    $vercode = validate($_POST['vercode']);
    $code = validate($_POST['code']);

    $user_data = 'accesscode='. $accesscode. '&newcode='. $newcode. '&renewcode='. $renewcode. '&vercode='. $vercode;
    //echo $user_data;
    //exit();
    
    if ($accesscode !== ""){
        if (empty($vercode)){
            header("Location: edit-security.php?error=Please type current security code for verification&$user_data");
            exit();
        }
    }

    if ($newcode !== "") {
        if (empty($renewcode)){
            header("Location: edit-security.php?error=Please repeat new code&$user_data");
            exit();
        }else if ($newcode !== $renewcode){
            header("Location: edit-security.php?error=Please make that new code and repeat new code is matching&$user_data");
            exit();
        }else if (empty($vercode)){
            header("Location: edit-security.php?error=Please type current security code for verification&$user_data");
            exit();
        }
    }

    if ($renewcode !== ""){
        if (empty($newcode)){
            header("Location: edit-security.php?error=Please type new code before the repeat new code&$user_data");
            exit();
        }
    }
    
    if ($vercode !== $code){
        header("Location: edit-security.php?error=Wrong Verification Code&$user_data");
        exit();
    }else{
        if ($accesscode !== ""){
            $sql = "UPDATE value
            SET account = '$accesscode'
            WHERE valueID = 7";
            $result = mysqli_query($conn, $sql);
        }
        
        if ($newcode !== ""){
            $sql = "UPDATE value
            SET account = '$newcode'
            WHERE valueID = 6";
            $result = mysqli_query($conn, $sql);
        }

        if ($result){
            header("Location: edit-security.php?success=You have successfully edited the security settings.");
            exit();
        }else {
            header("Location: edit-security.php?error=Unkwown error occured. Please try again&$user_data");
            exit();
            
        }
    }
    }
}