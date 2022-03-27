<?php
session_start();
include_once 'db_conn.php';

if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory - All Products</title>
    <link rel="stylesheet" href="layout-inv.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../../Images/client_logo.ico">
    </head>
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

        <div class = "inventTitle2">
            <h1>Inventory</h1>

        <div id = "product-wrap">
        <div id = "product-scroller">
            <table id = "invTitle2">
            <tr class = "invTitle2">
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Total Stocks</th>
                <!-- <th>Price Range</th> -->
                <th>Rate</th>
                <th>Images</th>
                <th>Edit</th>
            </tr>

            <?php
            
            $sql = "SELECT * FROM product";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if($resultCheck > 0){
                while ($row = mysqli_fetch_assoc($result)){
            ?>
            <tr class = "invStock">
                <td><?php echo $row['productID'];?></td>
                <td><?php echo $row['productName'];?></td>
                <?php                     
                    $id = $row['productID'];
                    $sql2 = "SELECT Sum(stocks) AS totalStocks FROM product_variant WHERE productID = $id";
                    $result2 = mysqli_query($conn, $sql2);
                    $resultCheck2 = mysqli_num_rows($result2);
                    while ($row2 = mysqli_fetch_assoc($result2)){?>

                <td><?php echo $row2['totalStocks'];?></td>
                <?php }?>
                <!-- <td><?php echo $row['priceRange'];?></td> -->
                <?php 
                    $prdtID = $row['productID'];
                    $sql0 = "SELECT * FROM ordercontents WHERE productID = '$prdtID' AND rateprd = 'Rated'";
                    $result0 = mysqli_query($conn, $sql0);
                    $ratings = 0;
                    while ($row0 = mysqli_fetch_assoc($result0)){
                        if ($row0){
                            $ratings += 1;
                            }
                    }

                    if ($row['rate'] == 0){
                        $totalRate = "No ratings yet";
                    }else if ($ratings == 0){
                        $totalRate = 0;
                    }else{
                        $totalRate = number_format($row['rate']/$ratings);
                    }
                    if ($ratings == '0'){?>
                        <td name = "rate">No ratings yet</td>
                    <?php }else{?>
                        <td name = "rate"><?php echo $totalRate;?>/5 (<?php echo $ratings;?> persons rated) </td>
                    <?php }?>
                <td>
                <?php if (isset($row['productImage'])){?>
                        <img src="Images/<?=$row['productImage']?>" width = "30" height = "30">
                         <!-- <input type="text" name="my_image"  value="<?//=$row['productImage']?>" hidden> -->
                <?php }else{?>
                    <img src="Images/test.png" width = "30" height = "30">
                <?php }?>
                </td>
                <td>
                <form action = "view-product.php" method = "post">
                <input type = "hidden" name = "id" value="<?php echo $row['productID']; ?>">
                <a href="view-product.php?id=<?php echo $row['productID']; ?>"><button name = "view" style = "border: none; outline: none; background-color:transparent; font-size: 23px; font-family: Times New Roman; font-weight: bold;">View</button></a>
                </form>
                </td>
            <?php }
                }?>
            </tr>
            </table>
        </div>
        </div>
        </div>

        <div class = "tabAddRefresh">
            <ul>
            <li><a id = "btnAddItem" href = "add-item.php"><button id = "btnAddItem">Add Item</button></a></li>
            <li><a id = "btnRefresh" href = "all-products.php"><button id = "btnRefresh">Refresh</button></a></li>
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