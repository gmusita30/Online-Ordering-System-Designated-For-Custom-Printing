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

}else if(isset($_POST['update'])){
    include "../db_conn.php";

    if (isset($_POST['uname']) && isset($_POST['name']) && isset($_POST['pnum']) && isset($_POST['pos']) 
        && isset($_POST['emailadd']) && isset($_POST['passw']) && isset($_POST['repeatpass'])
        && isset($_POST['adminID']) && isset($_POST['un']) && isset($_POST['eadd'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    $uname = validate($_POST['uname']);
    $name = validate($_POST['name']);
    $pnum = validate($_POST['pnum']);
    $pos = validate($_POST['pos']);
    $emailadd = validate($_POST['emailadd']);
    $passw = validate($_POST['passw']);
    $repeatpass = validate($_POST['repeatpass']);
    $adminID = validate($_POST['adminID']);
    $un = validate($_POST['un']);
    $eadd = validate($_POST['eadd']);

    $user_data = 'uname='. $uname. '&name='. $name. '&pnum='. $pnum. '&pos='. $pos. 
                '&emailadd='. $emailadd. '&passw='. $passw. '&repeatpass='. $repeatpass. 
                '&adminID='. $adminID. '&un='. $un. '&eadd='. $eadd;

    //echo $user_data;
        
    if (empty($uname)) {
        header("Location: edit-admin-user.php?adminID=$adminID&error=Username is required&$user_data");
        exit();
    }else if(empty($name)){
        header("Location: edit-admin-user.php?adminID=$adminID&error=Name is required&$user_data");
        exit();
    }else if(empty($pnum)){
        header("Location: edit-admin-user.php?adminID=$adminID&error=Phone number is required&$user_data");
        exit();
    }else if(empty($pos)){
        header("Location: edit-admin-user.php?adminID=$adminID&error=Position is required&$user_data");
        exit();
    }else if(empty($emailadd)){
        header("Location: edit-admin-user.php?adminID=$adminID&error=Email is required&$user_data");
        exit();
    }else if(empty($passw)){
        header("Location: edit-admin-user.php?adminID=$adminID&error=Password is required&$user_data");
        exit();
    }else if(empty($repeatpass)){
        header("Location: edit-admin-user.php?adminID=$adminID&error=Repeat password is required&$user_data");
        exit();
    }else if($passw !== $repeatpass){
        header("Location: edit-admin-user.php?adminID=$adminID&error=The passwords do not match&$user_data");
        exit();
    }else{

        //hashing the password
        //$passw = md5($passw);

        $sql ="SELECT * FROM admin_users WHERE userName='$uname' ";
        $result = mysqli_query($conn, $sql);
        $sql2 ="SELECT * FROM admin_users WHERE email='$emailadd' ";
        $result2 = mysqli_query($conn, $sql2);

        if($uname == $un){  

        }else if(mysqli_num_rows($result) > 0){
            header("Location: edit-admin-user.php?adminID=$adminID&error=The Username has already been taken&$user_data");
            exit();
        }
        
        if($emailadd == $eadd){

        }else if(mysqli_num_rows($result2) > 0){
            header("Location: edit-admin-user.php?adminID=$adminID&error=The Email has already been taken&$user_data");
            exit();
        }  
        
        
        $sql3 = "UPDATE admin_users
                    SET userName = '$uname', adminName = '$name', phonenum = '$pnum', 
                        position = '$pos', email = '$emailadd', pw = '$passw'
                    WHERE adminID = '$adminID' ";
        $result3 = mysqli_query($conn, $sql3);
        if ($result3){
            header("Location: edit-admin-user.php?adminID=$adminID&success=You have successfully edited an admin user");
            exit();
        }else {
            header("Location: edit-admin-user.php?adminID=$adminID&error=Unkwown error occured. Please try again&$user_data");
            exit();
            
        }
    }


}else {
    header("Location:all-admin-users.php");

}}