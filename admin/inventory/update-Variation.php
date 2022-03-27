<?php
if(isset($_POST['update'])){
    if (isset($_POST['stocks']) || isset($_POST['price']) || isset($_POST['size']) || isset($_POST['color'])) {
    $id = $_GET['id'];
    $stocks = $_POST['stocks'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $color = $_POST['colorName'];

    $sql = "UPDATE product SET size = '$size', colorName = '$color', stocks = '$stocks', price = '$price', WHERE productID = '$id'";
    $result = mysqli_query($conn, $sql);
    if ($result){
        header("Location: all-products.php?success=Ypu have successfully updated all product variations.");
        exit();
    }
}
}
?>