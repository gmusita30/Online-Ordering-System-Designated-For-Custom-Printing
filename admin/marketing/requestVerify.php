<?php
session_start();
include "../account/db_conn.php";

if (isset($_POST['sender']) && isset($_POST['bname']) && isset($_POST['pnum']) 
    && isset($_POST['social']) && isset($_POST['add']) && isset($_POST['info']) && isset($_FILES['bImage'])){
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    echo "<pre>";
    print_r($_FILES['bImage']);
    echo "</pre>";

    $img_name = $_FILES['bImage']['name'];
    $img_size = $_FILES['bImage']['size'];
    $tmp_name = $_FILES['bImage']['tmp_name'];
    $error = $_FILES['bImage']['error'];
        
    $sender = validate($_POST['sender']);
    $bname = validate($_POST['bname']);
    $pnum = validate($_POST['pnum']);
    $social = validate($_POST['social']);
    $add = validate($_POST['add']);
    $info = validate($_POST['info']);
    

    $user_data = 'sender='. $sender. '&bname='. $bname. '&pnum='. $pnum.
                '&social='. $social. '&add='. $add. '&info='. $info; 

    //echo $user_data;
        
    if (empty($sender)) {
        header("Location: marketreq-page.php?error=Name of Sender is required&$user_data");
        exit();
    }else if(empty($bname)){
        header("Location: marketreq-page.php?error=Business Name is required&$user_data");
        exit();
    }else if(empty($pnum)){
        header("Location: marketreq-page.php?error=Phone number is required&$user_data");
        exit();
    }else if(empty($add)){
        header("Location: marketreq-page.php?error=Address is required&$user_data");
        exit();
    }else if(empty($info)){
        header("Location: marketreq-page.php?error=Business Information is required&$user_data");
        exit();
    }else if ($error === 0) {
        if($img_size > 10485760){
            header("Location: marketreq-page.php?error=Sorry your image size is too large. Must be 10MB or below&$user_data");    
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = array("jpg", "jpeg", "png");
            if(in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                $img_upload_path = '../admin/marketing/marketreqImages/'.$new_img_name;
                move_uploaded_file($tmp_name, $img_upload_path);

                $sql = "INSERT INTO marketreqs(name, businessName, phonenum, socmed, businessInfo, address, businessImage)
                VALUES('$sender', '$bname', '$pnum', '$social', '$info', '$add', '$new_img_name')";
                $result = mysqli_query($conn, $sql);
                if ($result){
                    header("Location: marketreq-page.php?success=Thank you for sending your marketing request!");
                    exit();
                }else {
                    header("Location: marketreq-page.php?error=Unkwown error occured. Please try again&$user_data");
                    exit();
                }
            }else {
                header("Location: marketreq-page.php?error=You can't upload other files besides .jpg, .jpeg, .png&$user_data");
                exit();
            }
        }
    } else{
        $sql = "INSERT INTO marketreqs(name, businessName, phonenum, socmed, businessInfo, address)
        VALUES('$sender', '$bname', '$pnum', '$social', '$info', '$add')";
        $result = mysqli_query($conn, $sql);
        if ($result){
            header("Location: marketreq-page.php?success=Thank you for sending your marketing request!");
            exit();
        }else {
            header("Location: marketreq-page.php?error=Unkwown error occured. Please try again&$user_data");
            exit();
        }
     }
} else {
    header("Location: marketreq-page.php");
    exit();
}
    