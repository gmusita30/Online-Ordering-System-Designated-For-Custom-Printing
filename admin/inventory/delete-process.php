<?php
include_once 'db_conn.php';
if (isset($_POST['remove'])){
    $id = $_POST['id'];
    $sql2 = "SELECT * FROM product WHERE productID = $id";
    $result2 = mysqli_query($conn, $sql2);
    $resultCheck = mysqli_fetch_array($result2);
    $productImage = $resultCheck['productImage'];
    $path = "Images/$productImage";
    if(!unlink($path)){
        header("Location: all-products.php?error=Image Not Linked To The Folder Path.");
        exit();
    }else {
        $sql = "DELETE FROM product WHERE productID = $id";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $sql1 = "DELETE FROM product_variant WHERE productID = $id";
            $result1 = mysqli_query($conn, $sql1);
            if ($result1){
                header("Location: all-products.php?success=You have successfully removed the product.");
                exit();
            }
        }else{
            echo "Error Deleting Record: " . mysqli_error($conn);
        }
    }
}else {
mysqli_close($conn);
}
?>
