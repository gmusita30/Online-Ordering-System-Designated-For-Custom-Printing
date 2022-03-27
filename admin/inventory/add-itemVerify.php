<?php
session_start();
  include "db_conn.php";

if (isset($_POST['submit'])) {
    if (isset($_POST['pName']) && isset($_POST['description'])){
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $pName = validate($_POST['pName']);
        $stocks = validate($_POST['stocks']);
        $price = validate($_POST['price']);
        $description = validate($_POST['description']);
        $size = validate($_POST['size']);
        $color = validate($_POST['color']);


        $sizeValue = 'selectSize';

        if ($size == "XS"  ||  $size == "Small" || $size == "Medium" || $size == "Large"){
            $actualPrice = 500;
        }else if ($size == "XL" ||  $size == "XXL" ||  $size == "XXXL"){
            $actualPrice = 500 + $price; 
        }

        if(empty($pName) && empty($description) && empty($stocks) && empty($price) && $size == $sizeValue && empty($color)
           ){
            header("Location: add-item.php?error=All information must be filled out");
            exit();
        }else if (empty($pName)) {
            header("Location: add-item.php?error=Product Name is required");
            exit();
        }else if(empty($description)){
            header("Location: add-item.php?error=Description is required");
            exit();
        }else if($size == $sizeValue){
            header("Location: add-item.php?error=Size is required");
            exit();
        }else if(empty($color)){
            header("Location: add-item.php?error=Color is required");
            exit();
        }else if(empty($stocks)){
            header("Location: add-item.php?error=Stocks is required");
            exit();
        }else if(empty($price)){
            header("Location: add-item.php?error=Price is required");
            exit();
        //}else if($price < $actualPrice){


        }else if (isset($_FILES['productImage'])){
            $img_name = $_FILES['productImage']['name'];
            $img_size = $_FILES['productImage']['size'];
            $tmp_name = $_FILES['productImage']['tmp_name'];
            $error = $_FILES['productImage']['error'];
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
    
            $allowed_exs = array("jpg", "jpeg", "png");
    
    
            $pName = $_POST['pName'];
            $stocks = $_POST['stocks'];
            $price = $_POST['price'];
            $description = $_POST['description'];
            $size = $_POST['size'];
            $color = $_POST['color'];
            $productImage = $_POST['productImage'];
    
            if (in_array($img_ex_lc, $allowed_exs)){
                if($error === 0){
                    if ($img_size < 10485760){
                        $new_img_name = uniqid('IMG-', true).'.'.$img_ex_lc;
                        $img_upload_path = 'Images/'.$new_img_name;
                        move_uploaded_file($tmp_name, $img_upload_path);
    
                        $sql3 = "INSERT INTO product(productName, description, productImage)
                        VALUES('$pName', '$description', '$new_img_name')";
                    $result3 = mysqli_query($conn, $sql3);
                    if ($result3){
                        $id = mysqli_insert_id($conn);
                        $sql4 = "INSERT INTO product_variant(productID, colorName, size, price, stocks)
                        VALUES('$id', '$color', '$size', '$actualPrice', '$stocks')";
                        $result4 = mysqli_query($conn, $sql4);
    
                        if ($result4){
                        header("Location: add-item.php?success=You have successfully added a new product");
                        exit();
                    }
                    }else {
                        header("Location: add-item.php?error=Unkwown error occured. Please try again");
                        exit();
                    }
                    }else {
                        $em = "Sorry, your file is too large.";
                        header("Location: add-item.php?error=$em");
                    }
    
                    }else {
                        $em = "unknown error occurred!";
                        header("Location: add-item.php?error=$em");
                    }
                }else {
                    $em = "You still need to add an image.";
                    header("Location: add-item.php?error=$em");
                }
            }

        else {
            $sql = "SELECT * FROM product WHERE productName='$pName' ";
            $result = mysqli_query($conn, $sql);
        
            if (mysqli_num_rows($result) > 0){
                header("Location: add-item.php?error=Product Name already exist");
                exit();
            }
            else {
                
                $sql3 = "INSERT INTO product(productName, description)
                    VALUES('$pName', '$description')";
                $result3 = mysqli_query($conn, $sql3);
                if ($result3){
                    $id = mysqli_insert_id($conn);
                    $sql4 = "INSERT INTO product_variant(productID, colorName, size, price, stocks)
                    VALUES('$id', '$color', '$size', '$actualPrice', '$stocks')";
                    $result4 = mysqli_query($conn, $sql4);

                    if ($result4){
                        header("Location: add-item.php?success=You have successfully added a new product");
                        exit();
                    }
                }else {
                    header("Location: add-item.php?error=Unkwown error occured. Please try again");
                    exit();
                }
            }
        }

    }
}
else if(isset($_POST['back'])) {
    mysqli_close($conn);
    header("Location: all-products.php");
    exit();
}
else{
    header("Location: add-item.php");
    exit();
}
