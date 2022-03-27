<?php
session_start();
include "db_conn.php";


if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory - View Product</title>
    <link rel="stylesheet" href="layout-inv.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../../Images/client_logo.ico">
    </head>
<body>
    <div class = "header">
    <h1>Rootmates Online - Admin</h1>
    </div>

    <div class = "profile">
        <img src = "Images/client_logo.png" alt = "Rootmates Clothing Logo">
        <h2>Ordering System</h2>
    </div>

    <div class = "tabs">
        <ul>
        <li><button><a href = "../orders/all-orders.php">Orders</a></button></li>
        <li><button id = "inventoryClick"><a id = "inventoryClicklink" href = "all-products.php">Inventory</a></button></li>
        <li><button><a href = "../feedback/all-feedbacks.php">Feedback</a></button></li>
        <li><button><a href = "../marketing/all-requests.php">Marketing Request</a></button></li>
        <li><button><a href = "../users/all-admin-users.php">Users</a></button></li>
        <li><button><a href = "../logout.php">Logout</a></button></li>
        </ul>
    </div>

    <div class = "inventViewItem">
        <div class = "inventTitle">
            <h1>Inventory - View Product</h1>

            <div id = "scroll">
            <table id = "invTitle">
            <?php
            if (isset($_POST['view'])){
            $id = $_POST['id'];
            $sql = "SELECT * FROM product WHERE productID = $id";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_fetch_array($result);

            $sql1 = "SELECT * FROM product_variant WHERE productID = $id";
            $result1 = mysqli_query($conn, $sql1);
            //$resultCheck1 = mysqli_fetch_array($result1);
            ?>

            <tr>
                <th>ID:</th>
                <td name = "id" style = "position:static;"><?php echo $resultCheck['productID'];?></td>
                <?php if (isset($resultCheck['productImage'])){?>
                <td rowspan ="4" colspan = "2" style = "position:static;text-align:center;"><img src = "Images/<?=$resultCheck['productImage']?>" class="img2" alt = "Image"></td>
            <?php }else{?>
                <td rowspan ="4" colspan = "2" style = "position:static;text-align:center;"><img src = "Images/test.png" class="img2" alt = "Image"></td>
            <?php }?>
            </tr>

            <tr>
                <th>Product Name:</th>
                <td name = "pName" style = "position:static;"><?php echo $resultCheck['productName'];?></td>
            </tr>

            <?php 
            $sql3 = "SELECT Sum(stocks) AS totalStocks FROM product_variant WHERE productID = $id";
            $result3 = mysqli_query($conn, $sql3);
            $resultCheck3 = mysqli_fetch_array($result3);?>
            <tr>
                <th>Total Stocks:</th>
                <td name = "stocks" style = "position:static;"><?php echo $resultCheck3['totalStocks'];?></td>
            </tr>
            <?php 
            $sql4 = "SELECT MIN(NULLIF(price, 0)) AS lowPrice, MAX(NULLIF(price,0)) AS highPrice FROM product_variant WHERE productID = $id";
            $result4 = mysqli_query($conn, $sql4);
            $resultCheck4 = mysqli_fetch_array($result4);
            $lowPrice = $resultCheck4['lowPrice'];
            $highPrice = $resultCheck4['highPrice'];?>
            <tr>
                <?php if ($lowPrice == $highPrice){
                        echo "<th>Price:</th>
                        <td name = 'stocks' style = 'position:static;'>
                            ₱$lowPrice.00";
                }else {
                    echo "<th>Price Range:</th>
                    <td name = 'stocks' style = 'position:static;'>
                        ₱$lowPrice.00 - ₱$highPrice.00";
                }?></td>
            </tr>

            <tr>
                <th>Rate:</th>
                <?php 
                    $prdtID = $resultCheck['productID'];
                    $sql0 = "SELECT * FROM ordercontents WHERE productID = '$prdtID' AND rateprd = 'Rated'";
                    $result0 = mysqli_query($conn, $sql0);
                    $ratings = 0;
                    while ($row0 = mysqli_fetch_assoc($result0)){
                        if ($row0){
                            $ratings += 1;
                            }
                    }

                    if ($resultCheck['rate'] == 0){
                        $totalRate = "No ratings yet";
                    }else if ($ratings == 0){
                        $totalRate = 0;
                    }else{
                        $totalRate = number_format($resultCheck['rate']/$ratings);
                    }
                    if ($ratings == '0'){?>
                        <td name = "rate" style = "position:static;">No ratings yet</td>
                    <?php }else{?>}
                        <td name = "rate" style = "position:static;"><?php echo $totalRate;?>/5 (<?php echo $ratings;?> persons rated) </td>
                    <?php }?>
            </tr>
            
            <tr>
                <th>Description:</th>
                <td name = "description" style = "position:static;"><?php echo $resultCheck['description'];?></td>
            </tr>

            <tr>
                <th></th>
            </tr>
            <tr>
                <th>Product Variation</th>
            </tr>

            <tr style = "text-align:center; border: 2px solid black; background-color: lightblue;">
                <th style = "border: 2px solid black;">Size:</th>
                <th style = "border: 2px solid black;">Color:</th>
                <th style = "border: 2px solid black;">Remaining Stocks:</th>
                <th style = "border: 2px solid black;">Price:</th>
            </tr>
            <tr style = "text-align:center;">
            <?php
                      $sql2 = "SELECT * FROM product_variant WHERE productID = '$id' ORDER BY colorName ASC";
                      $result2 = mysqli_query($conn, $sql2);
                    $resultCheck2 = mysqli_num_rows($result2);
                     if($resultCheck2 > 0){
                        while ($row2 = mysqli_fetch_array($result2)){
                            $sql3 = "SELECT * FROM product WHERE productID = '$id'";
                            $result3 = mysqli_query($conn, $sql3);?>
                <?php
                    // $resultCheck1 = mysqli_num_rows($result1);
                    // $i = 0;
                    // if($resultCheck1 > 0){
                    //     while($row = mysqli_fetch_assoc($result1)){ ?>
                                <th name = "size" style = "font-weight: normal; text-align:center;border: 2px solid black;"><?php echo $row2['size'];?></th>
                  <?php //} }?>
                <!-- </tr> -->
                <!-- <tr> -->
                <!-- <th>Color:</th> -->
                <?php// foreach($result1 as $resultCheck1){?>
                <th name = "color" style = "font-weight: normal; text-align:center;border: 2px solid black;"><?php echo $row2['colorName'];?></th>
                <?php// }?>
                <!-- </tr>
                <tr> -->
                <!-- <th>Remaining Stocks:</th> -->
                <?php //foreach($result1 as $resultCheck1){?>
                <th name = "stocks" style = "font-weight: normal; text-align:center;border: 2px solid black;"><?php echo $row2['stocks'];?></th>
                  <!-- <th>Price:</th> -->
                  <?php //foreach($result1 as $resultCheck1){?>
                <th name = "price" style = "font-weight: normal; text-align:center;border: 2px solid black;">₱<?php echo $row2['price'];?>.00</th>
                <?php //}?>
            </tr>
            <?php }}?>
            <?php }?>
            </table>  
        </div>
    </div>
    </div>

    <?php
        // $sql2 = "SELECT product.*, product_variant.* FROM product IN JOIN product_variant ON product.productID = product_variant.productID WHERE productID = '". $_POST['id']. "'";
        // $result2 = mysqli_query($conn, $sql2);
    ?>
    
    <div class = "tabViewProduct">
        <ul>
            <li><a href = "all-products.php"><button id="btnBack" name = "back">Back</button></a></li>
            <li>
            <form action = "delete-process.php" method = "post" enctype="multipart/form-data">
            <input type = "hidden" name = "id" value = "<?php echo $resultCheck['productID']; ?>">
            <a href = "all-products.php"><button id = "btnRem" name = "remove">Remove Product</button></a>
            </form>
            </li>

            <li>
            <form action = "update-stocks.php" method = "post">
            <input type = "hidden" name = "id" value = "<?php echo $resultCheck['productID']; ?>">
            <a href = "update-stocks.php?id=<?php echo $resultCheck['productID']; ?>"><button id = "btnUp" name = "btnUp">Update Product</button></a>
            </form>
            </li>

            <li>
            <input type = "hidden" name = "id" value = "<?php echo $resultCheck['productID']; ?>">
            <a href = "view-product.php?id=<?php echo $resultCheck['productID']; ?>"><button id = "btnRefresh2">Refresh</button></a>
            </li>
        </ul>
    </div>
    <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

</body>
</html>
<?php
}else{
    header("Location: ../login.php");
    exit();
}
?>