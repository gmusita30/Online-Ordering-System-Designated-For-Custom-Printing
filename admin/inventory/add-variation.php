<?php 
include_once 'db_conn.php';
if(isset($_POST['add'])){
    if (isset($_POST['stocks']) || isset($_POST['price']) || isset($_POST['size']) || isset($_POST['color'])) {
    $id = $_POST['id'];
    $stocks = $_POST['stocks'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $color = $_POST['color'];

    $selectedValue = "selectSize";

    $sql2 = "SELECT * FROM product WHERE productID = '$id'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);

    $sql3 = "SELECT SUM(stocks) AS totalStocks FROM product_variant WHERE productID = '$id'";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_assoc($result3);

    $totalVar = $row3['totalStocks']; //current sum
    $sql = "SELECT * FROM product_variant WHERE productID='$id' AND size = '$size' AND colorName = '$color' AND stocks = '$stocks'";
    $result = mysqli_query($conn, $sql);

    $generalPrice = 500;
    if($price < $generalPrice){
        $actualPrice = 500 + $price;
    }else {
        $actualPrice = 500;
    }

    /*echo $total;
    echo " > ";
    echo $stocks;
    exit();*/

    if ($result){
            if (mysqli_num_rows($result) > 0){
                header("Location: update-VarStocks.php?id=$id&error=Size and Color already exist.");
                exit();
            }else if(empty($color) && $size == $selectedValue){
                header("Location: update-VarStocks.php?id=$id&error=Select a size and add a color when adding a product variation.");
                exit();
            }else if (empty($color)){
                header("Location: update-VarStocks.php?id=$id&error=Add a color when adding a product variation.");
                exit();
            }else if (empty($stocks)){
                header("Location: update-VarStocks.php?id=$id&error=Add a number of stocks when adding a product variation.");
                exit();
            }else if (empty($price)){
                header("Location: update-VarStocks.php?id=$id&error=Add a price when adding a product variation.");
                exit();
            }else if ($size == $selectedValue){
                header("Location: update-VarStocks.php?id=$id&error=Select a size when adding a product variation.");
                exit();
            }else if($stocks < 0) {
                header("Location: update-VarStocks.php?id=$id&error=Stocks must not be below 0.");
                exit();
            }
            else{
                $sql2 = "INSERT INTO product_variant (productID, size, colorName, stocks, price) VALUES ('$id', '$size', '$color', '$stocks', '$actualPrice')";
                $result2 = mysqli_query($conn, $sql2);
                if ($result2){
                    header("Location: update-VarStocks.php?id=$id&success=You have successfully add a new product variation.");
                    exit();
                }
            }
        }else{
            echo "Error Deleting Record: " . mysqli_error($conn);
        }
    }
}
// else if(isset($_POST['back'])) {
//     header("Location: update-stocks.php");
//     exit();
// }
else {
    mysqli_close($conn);
}?>