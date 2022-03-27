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
    <title>Inventory - Update Stocks</title>
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

    <form action = "update-stocksVerify.php" method = "post" enctype="multipart/form-data">
        <div class = "updatestocks-container">
            <h1>Inventory - Update Product Information</h1>
            <table id = "stocksinside">
            <?php
            if (isset($_POST['btnUp'])){
                    $id = $_POST['id'];
                    $sql = "SELECT * FROM product WHERE productID = '$id'";
                    $result = mysqli_query($conn, $sql);
                   foreach($result as $resultCheck){
                    $ratings = 0;
                    $sql1 = "SELECT * FROM product_variant WHERE productID = '$id'";
                    $result1 = mysqli_query($conn, $sql1);
                    $resultCheck1 = mysqli_fetch_assoc($result1);
            ?>
            <?php if (isset($_POST['id'])) { ?>
                <input type = "hidden" name = "id" value="<?php echo $resultCheck['productID']; ?>">
            <?php }else{ ?>
                <input type = "hidden" name = "id">

            <?php }?>
            
            <tr>
            <th>
                <label for = "pName"> Product Name</label>
            </th>
                <td style = "padding-top: 10px; padding-bottom: 20px;">
                <input type = "text" name = "pName" value="<?php echo $resultCheck['productName']; ?>" 
                        size = "40" style = "font-size: 20px; line-height: 50px;"  placeholder = "Rootmates Product">
                </td>
            <th colspan = "3">
            <img src = "Images/<?=$resultCheck['productImage']?>"
                style = "margin-left: -100px; margin-top: -50px; width: 300px; height: 200px;" class="img3" alt = "Image">
            </th>
            </tr>

            <tr>
            <th style = "padding-bottom: 20px; padding-top: 20px;">
                <label for = "rate">Rate</label>
            </th>
            <?php 
                    $sql0 = "SELECT * FROM ordercontents WHERE productID = '$id' AND rateprd = 'Rated'";
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
                        <td name = "rate">No ratings yet</td>
                    <?php }else{?>}
                        <td name = "rate"><?php echo $totalRate;?>/5 (<?php echo $ratings;?> persons rated) </td>
                    <?php }?>
            </tr>
            <tr>
            <th>
                <label for = "description">Description</label>
            </th>
                <td style = "width: 100px;">
                        <textarea name = "description" style = "height: 270px; width: 460px;"
                        placeholder = "Description of the Product"><?php echo $resultCheck['description'];?></textarea>
                </td>
            <th>
                <td style = "width: 100px;">
                </td>
            </th>

            <th style = "text-align:center;width: 300px;">
                <span><label for = "imageFile" style = "text-decoration: underline;">Change Image</label>
                <input class="addimg3" id = "imageFile" type="file" name="productImage" style = "display: none;">
                </span>
            </th>
            </tr>

            <!-- <?php// foreach($result1 as $resultCheck1){ ?> -->
            <tr>
            <th>
            </th>
                <td style = "padding-top: 10px; padding-bottom: 20px;"> 
                </td>
            <th>
            </th>
                <td>
                </td>
            </tr>

            <?php }
                    }
            ?>
            </table>
            </form>
            <div class = "tabUpdate">
                <ul>
                    <li>
                        <form action = "view-product.php" method = "post">
                        <input type = "hidden" name = "id" value="<?php echo $resultCheck['productID']; ?>">
                        <a href="view-product.php?id=<?php echo $resultCheck['productID']; ?>"><button id = "btnBack" name = "view" >Back</button></a>
                        </form>
                        <!--a id = "btnBack" href = "view-product.php?id=<?php echo $resultCheck['productID']; ?>"><button id = "btnBack" name = "back">Back</button></a></li-->
                    <li>
                    <a id = "btnUpdateVar" href = "update-VarStocks.php?id=<?php echo $resultCheck['productID']; ?>">
                    <button id = "btnUpdateVariation" name = "updateVar">Add/Update Product Variation</button></a>
                    </li>
                    <li><button id = "btnUpdate" type = "submit" name = "update">Update</button></li>
                </ul>
            </div>
        </div>

        <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <?php
            if (isset($_POST['back'])){
                $id = $_POST['id'];
                header("Location: view-product.php?id=$id");
                exit(); 
            }?>
    
    <form action = "update-VarStocks.php" method = "post">
    <input type = "hidden" name = "id" value="<?php echo $row['productID']; ?>">
    <button style = "display: none;" id = "btnUpdateVariation" name = "updateVar">Update Product Variation</button>
    </form>
</body>
</html>
<?php
}else{
    header("Location: ../login.php");
    exit();
}
?>