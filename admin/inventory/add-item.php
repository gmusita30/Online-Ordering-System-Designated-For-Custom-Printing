<?php
session_start();

if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory - Add Item</title>
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

    <form action = "add-itemVerify.php" method = "post" enctype="multipart/form-data">
        <div class = "inventAddItem">
            <h1>Inventory - Add Product</h1>
        <table  id = "invAddItem">
        <tr class = "pName">
            <th>
                <label for = "pName">Product Name</label>
            </th>
        <th style = "padding-top: 10px; padding-bottom: 20px;" colspan = "3">
        <?php if (isset($_GET['pName'])) { ?>
            <input type = "text" name = "pName" value="<?php echo $_GET['pName']; ?>" 
            size = "80" style = "font-size: 20px; line-height: 50px;"placeholder = "Rootmates Product">
        <?php }else{ ?>
            <input type = "text" name = "pName" size = "80" style = "font-size: 20px; line-height: 50px;" placeholder = "Rootmates Product">
            <?php }?>
        </th>
        </tr>

        <tr class = "description">
            <th>
                <label for = "description">Description</label>
            </th>

            <th colspan = "3">
            <?php if (isset($_GET['description'])) { ?>
                <textarea name = "description" value="<?php echo $_GET['description'];?>" placeholder = "Description of the Product"></textarea>
            <?php }else{ ?>
                <textarea style = "height: 200px; width: 875px;" name = "description" placeholder = "Description of the Product"></textarea>
            <?php }?>
            </th>
        </tr>

        <!-- <tr class = "stocksPrice">
            <th>
                <label for = "stocks">Total Stocks</label>
            </th>

            <th style = "padding-top: 10px; padding-bottom: 20px;">
            <?php //if (isset($_GET['stocks'])) { ?>
                <input type = "number" name = "stocks" value="<?php //echo $_GET['stocks']; ?>" 
                style = "font-size: 20px; line-height: 50px; width: 380px;" placeholder = "350">
            <?php// }else{ ?>
                <input type = "number" name = "stocks" style = "font-size: 20px; line-height: 50px; width: 380px;" placeholder = "350">
            <?php// }?>
            </th> -->
            <tr class = "sizeColor">
        

            <th>
                <label for = "size">Size</label>
            </th>

            <th>
            <?php if (isset($_GET['size'])) { ?>
                <select id = "size" name = "size" style = "font-size: 20px; width: 410px; height: 50px;" onchange = "priceChange()">
                <option value = "selectSize" selected = "selected">Select Size</option>
                <option value = "XS">XS</option>
                <option value = "Small">S</option>
                <option value = "Medium">M</option>
                <option value = "Large">L</option>
                <option value = "XL">XL</option>
                <option value = "XXL">XXL</option>
                <option value = "XXXL">XXXL</option>
            </select>
            <?php }else{ ?>
            <select id = "size" name = "size" style = "font-size: 20px; width: 410px; height: 50px;" onchange = "priceChange()">
                <option value = "selectSize" selected = "selected">Select Size</option>
                <option value = "XS">XS</option>
                <option value = "Small">S</option>
                <option value = "Medium">M</option>
                <option value = "Large">L</option>
                <option value = "XL">XL</option>
                <option value = "XXL">XXL</option>
                <option value = "XXXL">XXXL</option>
            </select>
            <?php }?>
            </th>
            <script>
            function priceChange() {
                if (document.getElementById("size").value == "XS" || document.getElementById("size").value == "Small" ||
                document.getElementById("size").value == "Medium" || document.getElementById("size").value == "Large" ||
                document.getElementById("sizeAdd").value == "XL"){
                    document.getElementById("price").value = 500;
                    document.getElementById("price").readOnly = true;
                    document.getElementById("addPrice").innerHTML = "Fixed Price";
                    document.getElementById("price").placeholder = "500";

                }     
                else{
                        document.getElementById("price").value = 550;
                        document.getElementById("price").readOnly = true;
                        document.getElementById("addPrice").innerHTML = "Fixed Price";
                        document.getElementById("price").placeholder = "550";
                    }        
                }
            </script>

            <th>
                <label for = "color">Color</label>
            </th>
            
            <th>
            <?php if (isset($_GET['color'])) { ?>
                <input type = "text" name = "color" value="<?php echo $_GET['color']; ?>" 
                size = "30" style = "font-size: 20px; line-height: 50px;" placeholder = "Pink">
            <?php }else{ ?>
                <input type = "text" name = "color" size = "30" style = "font-size: 20px; line-height: 50px;" placeholder = "Pink">
            <?php }?>
            </th>
            </tr>
            <th>
                <label for = "price" id = "addPrice">Price</label>
            </th>

            <th>
            <?php if (isset($_GET['price'])) { ?>
                <input type = "text" id = "price" name = "price" value="<?php echo $_GET['price']; ?>" 
                style = "font-size: 20px; line-height: 50px; width: 400px;" placeholder = "500">
            <?php }else{ ?>
                <input type = "text" id = "price" name = "price" style = "font-size: 20px; line-height: 50px; width: 400px;" placeholder = "500">
            <?php }?>
            </th>

            <th>
                <label for = "stocks">Stocks</label>
            </th>

            <th>
            <?php if (isset($_GET['stocks'])) { ?>
                <input type = "text" name = "stocks" value="<?php echo $_GET['stocks']; ?>" 
                style = "font-size: 20px; line-height: 50px; width: 355spx;" placeholder = "100">
            <?php }else{ ?>
                <input type = "text" name = "stocks" style = "font-size: 20px; line-height: 50px; width: 355px;" placeholder = "100">
            <?php }?>
            </th>
            </tr>

        <!-- </tr>

        <tr class = "prodImage"> -->
            <tr>
            <th>
                <label for = "productImage">Image</label>
            </th>

            <th>
                <!-- <form action="upload.php" method="post" enctype="multipart/form-data"> -->
                    <input class="addimg3" type="file" name="productImage">
                <!-- </form> -->
            </th>
        </tr>
        </table>
        </div>

        <div class = "tabAdd">
            <ul>
            <li><a id = "btnBack" href = "all-products.php"><button id = "btnBack" name = "back">Back</button></a></li>
            <li><button id = "btnAdd" type = "submit" name = "submit">Add</button></li>
            </ul>
        </div>
        
        <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
    </form>
</body>
</html>
<?php
}else{
    header("Location: ../login.php");
    exit();
}
?>