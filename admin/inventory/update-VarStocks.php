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
    <title>Inventory - Update Product Variation</title>
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

    <!-- <form action = "remove-VarStocks.php" method = "post">
                    <input id = "colorId"  type = "hidden" name = "colorId" value="<?php //echo $row['colorID']; ?>">
                    <input id = "id" type = "hidden" name = "id" value="<?php //echo $row['productID']; ?>"> -->

        <div class = "updatestocks-container">
            <h1>Inventory - Add/Update/Remove Product Variation</h1>
            <table id = "stocksinside">
            <?php
                   
                    $id = $_GET['id'];
                    $sql = "SELECT * FROM product_variant WHERE productID = '$id' ORDER BY colorName ASC";
                    $result = mysqli_query($conn, $sql);
            ?>
            <tr>
            <th>
                <label for = "id"> Product ID</label>
            </th>
                <td style = "padding-top: 10px; padding-bottom: 20px;">
                <input type = "text" name = "id" value="<?php echo $id ?>" 
                        size = "30" style = "font-size: 20px; line-height: 50px;" readonly>
                </td>
            </tr>
            <tr>
            <th>Update/Remove Product Variation</th>
             <td colspan = "4" style = "color: red;"> <!-- Update or Remove Existing Product Variation<br> -->
                                                    Change the color and remaining stocks</td>
            </tr>

            <tr class = "removalVariation">
                <th>Size</th>
                <th>Color</th>
                <th>Remaining Stocks</th>
                <th>Price</th>
                <th>Update</th>
                <th>Removal</th>
            </tr>

            <?php
                    $resultCheck = mysqli_num_rows($result);
                     if($resultCheck > 0){
                        while ($row = mysqli_fetch_array($result)){
                            $sql = "SELECT * FROM product WHERE productID = '$id'";
                            $result1 = mysqli_query($conn, $sql);?>

            <form action = "remove-VarStocks.php" method = "post">
                <input id = "colorId"  type = "hidden" name = "colorId" value="<?php echo $row['colorID']; ?>">
                <input id = "id" type = "hidden" name = "id" value="<?php echo $row['productID']; ?>">
            <tr class = "variableVariation">
            <td><input type = "text" name = "color" style = "font-size: 20px; text-align: center; border: none; outline: none; background-color: beige;" value = "<?php echo $row['size']; ?>" readonly></td>
                 <td>
                 <input type = "text" name = "color" style = "font-size: 20px; text-align: center; border: none; outline: none; background-color: beige;" value = "<?php echo $row['colorName']; ?>">
                 <!-- <select id = "size" name = "size" style = "font-size: 20px; outline: none; border: none; background-color: beige;" onchange = "newPriceChange()"> -->
                <!-- <option selected = 'selected' value = <?php //echo $row['size']?>><?php //echo $row['size']; ?></option>
                <option value = 'selectSize'>Select Size</option>
                    <option value = 'XS'>XS</option>
                    <option value = 'Small'>S</option>
                    <option value = 'Medium'>M</option>
                    <option value = 'Large'>L</option>
                    <option value = 'XL'>XL</option>
                    <option value = 'XXL'>XXL</option>
                    <option value = 'XXXL'>XXXL</option>
                </select> -->
                </td>

                <?php 
                            // $sql50 = "SELECT * FROM product_variant WHERE productID = '$id'";
                            // $result50 = mysqli_query($conn, $sql50);
                            // while ($row50 = mysqli_fetch_array($result50)){?>
                <!-- <script>
                    function newPriceChange() {
                        if (document.getElementById("size").value == "XS" || document.getElementById("size").value == "Small" ||
                            document.getElementById("size").value == "Medium" || document.getElementById("size").value == "Large"){
                                document.getElementById("newPrice").value = 500;
                                document.getElementById("newPrice").readOnly = true;

                    }
                        else{
                        document.getElementById("newPrice").value = "";
                        document.getElementById("newPrice").readOnly = false;
                    }      
                }
                </script> -->
                 <?php //}?> 

                <td>
                <?php   
                    $sql3 = "SELECT SUM(stocks) AS totalStocks FROM product_variant WHERE productID = '$id'";
                    $result3 = mysqli_query($conn, $sql3);
                    $row3 = mysqli_fetch_assoc($result3);

                    $sql = "SELECT * FROM product WHERE productID = '$id'";
                    $result1 = mysqli_query($conn, $sql); 
                    $row1 = mysqli_fetch_array($result1);  

                    $total = $row3['totalStocks'];
                    // echo $row3['totalVarStocks'];?>

                <?$row1 = mysqli_fetch_array($result1);?>
                <input type = "number" name = "stocks" min = "0" style = "font-size: 20px; width: 70px; text-align: center; border: none; outline: none; background-color: beige;" value = "<?php echo $row['stocks']; ?>">
                </td>
                <td><input type = "number" id = "newPrice" name = "price" style = "font-size: 20px; width: 70px; text-align: center; border: none; outline: none; background-color: beige;" value = "<?php echo $row['price']; ?>" readonly></td>
                <td hidden><input type = "text" name ="cID" value = "<?= $row['colorID']?>" readonly></input></td>
                <th style = "background-color:lightgreen;">
                    <a href = "remove-VarStocks.php" style = "text-decoration: none;"><button name = "update" style = "border: none; 
                            outline: none; background-color: transparent; font-size: 20px; font-family: Times New Roman; 
                            font-weight: bold;">Update</button></a>
                
                </th>
                <?php
                if (mysqli_num_rows($result) === 1) {?>
                <th hidden style = "background-color:#FF7276;">
                    <a href = "remove-VarStocks.php" style = "text-decoration: none;"><button name = "remove" style = "border: none; 
                            outline: none; background-color:transparent; font-size: 20px; font-family: Times New Roman; 
                            font-weight: bold;">Remove</button></a>
                <?php }else{?>
                <th style = "background-color:#FF7276;">
                    <a href = "remove-VarStocks.php" style = "text-decoration: none;"><button name = "remove" style = "border: none; 
                            outline: none; background-color:transparent; font-size: 20px; font-family: Times New Roman; 
                            font-weight: bold;">Remove</button></a>
                </th>
                <?php
                      }?>
             </form>
            </tr>
            <?php }}?>
            </table>
            <form action = "add-variation.php" method = "post">
            <?php
                    $sql1 = "SELECT * FROM product_variant WHERE productID = '$id'";
                    $result1 = mysqli_query($conn, $sql1);
                    $resultCheck1 = mysqli_fetch_assoc($result1);
                    ?>
                    <input id = "id" type = "hidden" name = "id" value="<?php echo $resultCheck1['productID']; ?>">
            <table id = "stocksinside">
            <tr>
            <th style = "text-align:center;">Add Product Variation</th>
            <td style = "color: red;">Add another size, color, quantity and price.</td>
            </tr>
            <tr>
            <th>Size</th>
            <td><select id = "sizeAdd" name = "size" style = "width: 312px; height: 53px;font-size: 20px;" onchange = "priceChange()">
            <option selected = 'selected' value = <?php echo $resultCheck1['size']?>><?php echo $resultCheck1['size']; ?></option>
                <option value = 'selectSize'>Select Size</option>
                    <option value = 'XS'>XS</option>
                    <option value = 'Small'>S</option>
                    <option value = 'Medium'>M</option>
                    <option value = 'Large'>L</option>
                    <option value = 'XL'>XL</option>
                    <option value = 'XXL'>XXL</option>
                    <option value = 'XXXL'>XXXL</option>
                </select></td>
                <script>
                    function priceChange() {
                        if (document.getElementById("sizeAdd").value == "XS" || document.getElementById("sizeAdd").value == "Small" ||
                            document.getElementById("sizeAdd").value == "Medium" || document.getElementById("sizeAdd").value == "Large" ||
                            document.getElementById("sizeAdd").value == "XL"){
                                document.getElementById("prices").value = 500;
                                document.getElementById("prices").readOnly = true;
                                document.getElementById("addPrice").innerHTML = "Fixed Price";
                                document.getElementById("prices").placeholder = "500";

                    }     
                        else{
                        document.getElementById("prices").value = 550;
                        document.getElementById("prices").readOnly = true;
                        document.getElementById("addPrice").innerHTML = "Fixed Price";
                        document.getElementById("prices").placeholder = "550";
                    }        
                }
                </script>
            <th>Quantity</th>
            <td>
            <?php   
                    $sql3 = "SELECT SUM(NULLIF(stocks, 0)) AS totalVarStocks FROM product_variant WHERE productID = '$id'";
                    $result3 = mysqli_query($conn, $sql3);
                    $row3 = mysqli_fetch_assoc($result3);

                    $sql = "SELECT * FROM product WHERE productID = '$id'";
                    $result1 = mysqli_query($conn, $sql); 
                    $row1 = mysqli_fetch_array($result1);  

                    $total = $row3['totalVarStocks'];
                    // echo "Max: ";
                    // echo $totalstock;
                    // echo " Current: ";
                    // echo $row3['totalVarStocks'];
                    ?>
              <?$row1 = mysqli_fetch_array($result1);?>
            <input type = "number" min = "0" name = "stocks" 
                    size = "25" style = "font-size: 20px; line-height: 50px;" placeholder = "<?php echo $total?>">
            </td>
            </tr>

            <tr>
            <th>Color</th>
            <td><input type = "text" name = "color" value="<?php echo $resultCheck1['colorName']; ?>" 
                    size = "25" style = "font-size: 20px; line-height: 50px;" placeholder = "Pink"></td>
            <th id = "addPrice">Fixed Price</th>
                <td><input type = "number" id = "prices" name = "price" value="<?php echo $resultCheck1['price']; ?>" 
                    size = "25" style = "font-size: 20px; line-height: 50px;" placeholder = "500"></td>


            </tr>
            </table>

            <div class = "tabAddVar">
                <button id = "btnAddVar" type="submit" name = "add">Add</button>
            </div>

            
            </form>

            <div class = "tabBack">
                <ul>
                    <li>
                        <form action = "update-stocks.php" method = "post">
                        <input type = "hidden" name = "id" value = "<?php echo $id; ?>">
                        <a href = "update-stocks.php?id=<?php echo $id; ?>"><button id = "btnBack" name = "btnUp">Back</button></a>
                        <!--a id = "btnBack" href = "update-stocks.php?id=<?php echo $id; ?>"><button id = "btnBack" name = "back">Back</button></a-->
                        </form>
                    </li>
                    <!--li><a id = "btnBack" href = "all-products.php"><button id = "btnBack" name = "back">Back</button></a></li-->                    
                </ul>
            </div>
            
        </div>
        <?php if (isset($_GET['error'])) { ?>
                <p class="error" style = "margin-top: 30px;"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success" style = "margin-top: 30px;"><?php echo $_GET['success']; ?></p>
            <?php } ?>

</body>
</html>
<?php
}else{
    header("Location: ../login.php");
    exit();
}
?>