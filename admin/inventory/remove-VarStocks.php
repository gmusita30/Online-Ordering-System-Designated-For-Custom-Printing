<?php
include_once 'db_conn.php';

if (isset($_POST['remove'])){
    if (isset($_POST['id']) && isset($_POST['colorId'])){
    $id = $_POST['id'];
    $colorid = $_POST['colorId'];
    $sql = "DELETE FROM product_variant WHERE colorID = '$colorid' AND productID = '$id'";
    $result = mysqli_query($conn, $sql);
        if ($result) {
                header("Location: update-VarStocks.php?id=$id&success=You have successfully removed the product.");
                exit();
        }else{
            echo "Error Deleting Record: " . mysqli_error($conn);
        }
    }
}
if(isset($_POST['update'])){
    if (isset($_POST['stocks']) || isset($_POST['price']) || isset($_POST['size']) || isset($_POST['color']) || isset($_POST['cID'])) {
    $colorid = $_POST['colorId'];
    $id = $_POST['id'];
    $stocks = $_POST['stocks'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $color = $_POST['color'];
    $cID = $_POST['cID'];

    $sql2 = "SELECT * FROM product WHERE productID = '$id'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($result2);
    $totalstocks = $row2['totalStocks'];

    $selectedValue = "selectSize";

    $sql3 = "SELECT SUM(stocks) AS totalVarStocks FROM product_variant WHERE productID = '$id'";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($result3);

    $totalVar = $row3['totalVarStocks'];

    $sql10 = "SELECT * FROM product_variant WHERE productID = '$id'";
    $result10 = mysqli_query($conn, $sql10);
    $totalsum = 0;

    /*echo $cID;
    exit();*/
    
    while ($row10 = mysqli_fetch_assoc($result10)){
        if ($row10['colorID'] == $cID){
        }else{
            //echo $row10['colorName'];
            $totalsum += $row10['stocks'];
        }
    }
    
    /*echo $remaining;
    echo '<br>';
    echo $stocks;
    exit();*/
    
    /*$color = $row['colorName'];
                        $sql2 = "SELECT * FROM product_variant WHERE productID = '$id' AND colorName = '$color'";
                        $result2 = mysqli_query($conn, $sql2);
                        
                        while ($row2 = mysqli_fetch_assoc($result2)){?>
                            <option value = "<?php echo $row2['colorID'] ?>"><?php echo $row2['size']?> - ₱<?php echo $row2['price']?>  (Stocks: <?php echo $row2['stocks']?>)</option>
                    <?php }?>
                    */

    if ($size == $selectedValue && empty($color)){
        header("Location: update-VarStocks.php?id=$id&error=Select a size and add a color when updating a product variation.");
        exit();
    }else if ($size == $selectedValue){
        header("Location: update-VarStocks.php?id=$id&error=Select a size when updating a product variation.");
        exit();
    }else if (empty($color)){
        header("Location: update-VarStocks.php?id=$id&error=Add a color when updating a product variation.");
        exit();
    }else if ($stocks < 0){
        header("Location: update-VarStocks.php?id=$id&error=Stocks must not be below 0.");
        exit();
    }else{
        $sql2 = "UPDATE product_variant SET size = '$size', colorName = '$color', stocks = '$stocks', price = '$price' WHERE productID = '$id' AND colorID = '$colorid'";
        $result2 = mysqli_query($conn, $sql2);
            if ($result2){
                header("Location: update-VarStocks.php?id=$id&success=You have successfully updated the product variations.");
                exit();
            }else{
                echo "Error Deleting Record: " . mysqli_error($conn);
            }
        }
    }
}else {
mysqli_close($conn);
}
?>
