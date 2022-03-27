<?php
session_start();
include "../db_conn.php";

if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){

if(isset($_GET['reqID'])){
    include "../db_conn.php";

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    $reqID = validate($_GET['reqID']);
    $businessImage = validate($_GET['businessImage']);

    if ($businessImage == ""){
        $sql = "DELETE FROM marketreqs
        WHERE reqID=$reqID";
        $result = mysqli_query($conn, $sql);
        if ($result){
            header("Location: all-requests.php?reqID=$reqID&success=You have successfully deleted a marketing request");
            exit();
        }else {
            header("Location: all-requests.php?reqID=$reqID&error=Unkwown error occured. Please try again&$user_data");
            exit();
        }
    } else{
        $path = "marketreqImages/$businessImage";
        if (!unlink($path)){
            header("Location: all-requests.php?reqID=$reqID&businessImage=$businessImage&error=Unkwown error occured. Please try again&$user_data");
            exit();
        } else {
            $sql = "DELETE FROM marketreqs
            WHERE reqID=$reqID";
            $result = mysqli_query($conn, $sql);
            if ($result){
                header("Location: all-requests.php?reqID=$reqID&success=You have successfully deleted a marketing request");
                exit();
            }else {
                header("Location: all-requests.php?reqID=$reqID&error=Unkwown error occured. Please try again&$user_data");
                exit();
            }
        }
    }

}else{
    header("Location:all-requests.php");
}

}else{
    header("Location: ../login.php");
    exit();
}
?>