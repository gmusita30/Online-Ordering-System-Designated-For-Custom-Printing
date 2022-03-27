<?php

if (isset($_GET['adminID'])){
    include "../db_conn.php";

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    $adminID = validate($_GET['adminID']);

    $sql = "SELECT * FROM admin_users WHERE adminID=$adminID";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }else{
        header("Location:all-admin-users.php");
    }

}else if(isset($_POST['delete'])){
    include "../db_conn.php";

    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $adminID = validate($_POST['adminID']);

    $sql = "DELETE FROM admin_users
            WHERE adminID=$adminID";

    $result = mysqli_query($conn, $sql);
    if ($result){
        header("Location: all-admin-users.php?adminID=$adminID&success=You have successfully deleted an admin user");
        exit();
    }else {
        header("Location: delete-admin-user.php?adminID=$adminID&error=Unkwown error occured. Please try again");
        exit();
    }

}else {
    header("Location:all-admin-users.php");

}