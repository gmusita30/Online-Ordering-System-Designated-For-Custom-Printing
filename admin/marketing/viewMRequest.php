<?php

if (isset($_GET['reqID'])){
    include "../db_conn.php";

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    $reqID = validate($_GET['reqID']);

    $sql = "SELECT * FROM marketreqs WHERE reqID=$reqID";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }else{
        header("Location:all-requests.php");
    }

}else {
    header("Location:all-requests.php");

}