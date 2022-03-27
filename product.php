<?php
session_start();
include "product-Verify.php";

?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <script> 
        function change_text(){
            //document.getElementById("price").innerHTML = "< ?php echo $row['productID']?>";
            //document.getElementById("price").innerHTML = "< ?php echo $row['productID']?>";
            <?php 
                $sql50 = "SELECT * FROM product_variant WHERE productID = '$productID' ORDER BY size ASC";
                $result50 = mysqli_query($conn, $sql50);
                while ($row50 = mysqli_fetch_assoc($result50)){?>
                    if (document.getElementById("variation").value == "<?php echo $row50['colorID']?>") {
                        document.getElementById("price").innerHTML = "Price: ₱<?php echo $row50['price']?>.00";
                        document.getElementById("stocks").innerHTML = "Remaining Stocks: <?php echo $row50['stocks']?>";
                    }
            <?php }?>
            /*< ?php while ($row1 = mysqli_fetch_assoc($result1)){?>
                < ?php if ($row1['stocks'] == 0){?>
                    <option value = "< ?php echo $row1['colorID'] ?>" disabled>< ?php echo $row1['size']?> - < ?php echo $row1['colorName']?> (No Stocks Available)</option>
                < ?php }else {?>
                    <option value = "< ?php echo $row1['colorID'] ?>">< ?php echo $row1['size']?> - < ?php echo $row1['colorName']?> (Stocks: < ?php echo $row1['stocks']?>) = ₱ < ?php echo $row1['price']?></option>
                < ?php }?>            
            < ?php }?>*/
        }
    </script>
    <link rel="icon" href="Images/client_logo.ico">
    <link rel = "stylesheet" href = "customerSearch.css?v=<?php echo time(); ?>">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>View Product</title>
</head>
<header>
    <div class = "header">
        <a href="index.php"><img src = "Images/client_logo.png" alt = "Rootmates Clothing Logo"></a>
        <h3 style  = "color:white;">Rootmates <br> O-Store</h3>
        <nav>
        <form action="index.php" method="post">
            <input id="searchBar" type="text" name="valueToSearch" placeholder="Search for Products">
            <button id = "searchbtn" type = "submit" value="Search" name="search"><i class = "fa fa-search"></i></button>
        </form>
        <button onclick="window.location.href='notifications-page.php';" id = "notifbtn" type = "submit"><i class = "fa fa-bell fa-2x" style  = "color:white;"></i></button>
            
            <div class="dropdown">
            <button class = "dropbtn" id = "cartbtn" type = "submit"><i class = "fa fa-cart-plus fa-2x" style  = "color:white;"></i></button>
            <!--onclick="window.location.href='orders/cart-page.php';"
                onclick="window.location.href='account/manage-account.php';" 
             onclick="window.location.href='orders/order-page.php';" -->
             <div id="cartDropdown" class="dropdown-contentCart">
                <a href="orders/cart-page.php">My Cart</a>
                <a href="orders/order-page.php">My Orders</a>
            </div>
            </div>

            <div class="dropdown">
            <button class = "dropbtn" id = "profilebtn" type = "submit"><i class = "fa fa-user fa-2x" style  = "color:white;"></i></button>
            <div id="accountDropdown" class="dropdown-contentAccount">
                <a href="account/manage-account.php">Manage Account</a>
                <?php
                if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
                    $customerID = $_SESSION['customerID'];
                ?>
                <a href="account/logout.php">Logout</a>
                <?php }else {?>
                    <a href="account/login.php">Login</a>
             <?php }?>
            </div>
            </div>

        </nav>
    </div>
</header>

<body>
    <div class = "content">
        <div class = "colorVariety">
            
        </div>

        <img id = "productImg" src = "./admin/Inventory/Images/<?php echo $row['productImage']; ?>">
    
        <div class = "productDetails">
          
           <h1 style = "margin-left: -20px;"><label for = "pName"><?php echo $row['productName']; ?></label></h1>
                      
           <p style = "font-size: 20px;">Product Ratings:
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
                $totalRate = 0;
            }else if ($ratings == 0){
                $totalRate = 0;
            }else{
                $totalRate = number_format($row['rate']/$ratings);
            }
            if ($totalRate == 1){
                echo "<i class = 'fa fa-star'></i>
                      <i class = 'fa fa-star-o'></i>
                      <i class = 'fa fa-star-o'></i>
                      <i class = 'fa fa-star-o'></i>
                      <i class = 'fa fa-star-o'></i>";
            }else if ($totalRate == 2){
                echo "<i class = 'fa fa-star'></i>
                      <i class = 'fa fa-star'></i>
                      <i class = 'fa fa-star-o'></i>
                      <i class = 'fa fa-star-o'></i>
                      <i class = 'fa fa-star-o'></i>";
            }else if ($totalRate == 3){
                echo "<i class = 'fa fa-star'></i>
                      <i class = 'fa fa-star'></i>
                      <i class = 'fa fa-star'></i>
                      <i class = 'fa fa-star-o'></i>
                      <i class = 'fa fa-star-o'></i>";
            }else if ($totalRate == 4){
                echo "<i class = 'fa fa-star'></i>
                      <i class = 'fa fa-star'></i>
                      <i class = 'fa fa-star'></i>
                      <i class = 'fa fa-star'></i>
                      <i class = 'fa fa-star-o'></i>";
            }
            else if ($totalRate == 5){
                echo "<i class = 'fa fa-star'></i>
                      <i class = 'fa fa-star'></i>
                      <i class = 'fa fa-star'></i>
                      <i class = 'fa fa-star'></i>
                      <i class = 'fa fa-star'></i>";
            }else {
                echo "<i class = 'fa fa-star-o'></i>
                      <i class = 'fa fa-star-o'></i>
                      <i class = 'fa fa-star-o'></i>
                      <i class = 'fa fa-star-o'></i>
                      <i class = 'fa fa-star-o'></i>";
            }?>
            (<?php echo $ratings?>)
            </p>
            <p style = "font-size: 20px;">Sold: <?php echo $row['sold']; ?></p>
            <!--h3>Price<h3-->
            <p style = 'font-size: 30px;'id="price"></p>
                <!--h3>Remaining Stocks<h3-->
                <p style = 'font-size: 30px;' id="stocks"></p>
            <!--?php 
                $sql12 = "SELECT  MIN(stocks) AS minStocks1, MAX(NULLIF(price, 0)) AS highest, MIN(NULLIF(price, 0)) AS lowest FROM product_variant WHERE productID = $prdtID";
                $result12 = mysqli_query($conn, $sql12);
                $row12 = mysqli_fetch_assoc($result12);
                $lowPrice = $row12['lowest'];
                $highPrice = $row12['highest'];
                $minStocks = $row12['minStocks1'];
                if ($lowPrice == $highPrice){
                    echo"<p style = 'font-size: 30px;'>Price: ₱$lowPrice.00";
                }else if ($minStocks == 0){
                    echo"<p style = 'font-size: 30px;'>Price Range: ₱$lowPrice.00";
                }else{
                    echo "<p style = 'font-size: 30px;'>Price Range: ₱$lowPrice.00 - ₱$highPrice.00";
                }?></p-->
            
            <!--p>Overall Stocks: <?php 
                $sql11 = "SELECT SUM(stocks) AS totalStocks FROM product_variant WHERE productID = $prdtID";
                $result11 = mysqli_query($conn, $sql11);
                $row11 = mysqli_fetch_assoc($result11);
            echo $row11['totalStocks']; ?></p-->


            <form action = "product-Verify.php?customerID=<?= $customerID?>" method = "post">
                <input type="text" name="pID" value="<?php echo $row['productID']?>"readonly hidden></input>
                <p>Size & Color:</p>
                
                <!--select id = "variation" name = "colorID">
                
                <option value = "none">Select Size and Color</option>
                < ?php while ($row1 = mysqli_fetch_assoc($result1)){?>
                    <tr>
                    <th>
                        < ?php if ($row1['stocks'] == 0){?>
                            <option value = "<?php echo $row1['colorID'] ?>" disabled><?php echo $row1['size']?> - <?php echo $row1['colorName']?> (No Stocks Available)</option>
                        < ?php }else {?>
                            <option value = "<?php echo $row1['colorID'] ?>"><?php echo $row1['size']?> - <?php echo $row1['colorName']?> (Stocks: <?php echo $row1['stocks']?>) = ₱ <?php echo $row1['price']?></option>
                        < ?php }?>
                    </tr>
                < ?php }?>
                </select -->

                
                <!--button onclick="change_text()">Click me</button-->
                <select id = "variation" name = "colorID" onchange="change_text()">
                    <option value="none" >Select Size and Color</option>
                    <?php while ($row1 = mysqli_fetch_assoc($result1)){?>
                        <tr>
                        <th>
                            <?php if ($row1['stocks'] == 0){?>
                                <option value = "<?php echo $row1['colorID'] ?>" disabled><?php echo $row1['size']?> - <?php echo $row1['colorName']?> (No Stocks Available)</option>
                            <?php }else {?>
                                <option value = "<?php echo $row1['colorID'] ?>"><?php echo $row1['size']?> - <?php echo $row1['colorName']?> </option>
                            <?php }?>
                        </tr>
                    <?php }?>
                </select>

                
            
                <p>Quantity:
                <input type="number" id="txtQuantity" name="quant" min="1" max="<?php echo $row11['totalStocks'];?>" value="1" ></input><br>
                <?php
                if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
                    ?>
                    <button class="btnDesign" style = "width: 150px; height: 50px; font-weight:bold; margin-top: 20px;"  name="cart"  onclick = "Forms()">Add to Cart</button>
                    <button class="btnDesign" style = "width: 150px; height: 50px; font-weight:bold;" name="buy"  onclick = "Forms()">Buy Now</button>
                    <?php
                }else{}?>

</p>
            </form> 
            <?php if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
                }else{?>
                    <button class = "btnDesign" style = "width: 100px; height: 60px; margin-top: 20px; font-weight:bold; "><a href="account/login.php" style = "text-decoration:none; color:black;">Login/Signup First to Buy This Product</a></button>
            <?php } ?>

            <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
            </div>
        </div>

        <div class = "paymentOption">
        <h3>Payment Options</h3>
        <p>Cash-On-Delivery (COD)</p>
        <p>Payment thru G-Cash</p>
        </div>

        <div class = "shippingFee">
            <h3>Shipping Fees</h3>
            <p>GCash</p>
            <?php
                $sql10 = "SELECT * FROM value WHERE valueID = 3";
                $result10 = mysqli_query($conn, $sql10);
            
                if (mysqli_num_rows($result10) > 0){
                        $row10 = mysqli_fetch_assoc($result10);
                }

                echo $row10['valname'];
                echo " - ₱";
                echo $row10['price'];
                echo "<br><br>";

                $sql10 = "SELECT * FROM value WHERE valueID = 4";
                $result10 = mysqli_query($conn, $sql10);
            
                if (mysqli_num_rows($result10) > 0){
                        $row10 = mysqli_fetch_assoc($result10);
                }

                echo $row10['valname'];
                echo " - ₱";
                echo $row10['price'];
                echo "<br><br>";
            ?>

            <p>Cash-On-Delivery</p>
            <?php
                $sql10 = "SELECT * FROM value WHERE valueID = 1";
                $result10 = mysqli_query($conn, $sql10);
            
                if (mysqli_num_rows($result10) > 0){
                        $row10 = mysqli_fetch_assoc($result10);
                }

                echo $row10['valname'];
                echo " - ₱";
                echo $row10['price'];
                echo "<br><br>";

                $sql10 = "SELECT * FROM value WHERE valueID = 2";
                $result10 = mysqli_query($conn, $sql10);
            
                if (mysqli_num_rows($result10) > 0){
                        $row10 = mysqli_fetch_assoc($result10);
                }

                echo $row10['valname'];
                echo " - ₱";
                echo $row10['price'];
                echo "<br><br>";
            ?>
            </div>
        
        <div class = "productDescrip">
            <h2>Product Description</h2>
            <p>  &nbsp; <?php echo $row['description'];?></p>
        </div>

        <div class = "ratings">
            <h2>Size Chart</h2>
            <img src = "Images/sizeChart.jpg" style = "margin-left: 200px; width: 500px; height: 400px;">
        </div>

        <div class = "comments">
            <h2>Comments</h2>
            <table class="table table-striped">
                <?php 
                    $prdID = $row['productID'];
                    $sql10 = "SELECT * FROM ordercontents WHERE productID = $prdID AND comment != '' ORDER BY orderCID DESC";
                    $result10 = mysqli_query($conn, $sql10);
                    
                ?>
                <thead>
                    <tr>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php if ($resultCheck = mysqli_num_rows($result10)){
                            while ($row10 = mysqli_fetch_assoc($result10)){?>
                            <tr>
                                <td>&nbsp;>><?=$row10['comment']?></td>
                            </tr>
                    <?php }}else{?>
                        <tr>
                            <td>>>No comments yet.</td>
                        </tr>
                <?php }?>
                </tbody>
            </table>
        </div>

        <div class = "otherProd">
            <h3 style = "margin-left: 20px;">Other Products</h3>
            <?php
            $sql = "SELECT * FROM product ORDER BY rand() LIMIT 3";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if($resultCheck > 0){
                while ($row = mysqli_fetch_assoc($result)){
                    $id = $row['productID'];
                    $pName = $row['productName'];
                    // $price = $row['priceRange'];
                    $image = $row['productImage'];
                    
                    echo '<table><tr><td><a href = "product.php?id= '. $id .'&productName= '. $pName .'">
                    <img src="./admin/inventory/Images/'. $image .'"style = "width: 60px; height: 50px; margin-left: 10px;"></td>
                    <td>'. $pName .'</a></td></tr></table>';
                    }}?>
        </div>
        
        <?php //}
            ?> 
        <img src= "Images/tree.png" style = "position:absolute; width: 200px; height: 100px; margin-left: -15px; margin-top: 960px;">
        <img src= "Images/tree.png" style = "position:absolute; width: 200px; height: 100px; margin-left: 1300px; margin-top: 960px;">   
    </div>
    <div id = "table-scroller1" >
    <div class = "footer" style = "padding-left: 20px; margin-left: -10px;">
    <h3 id = "follow" style  = "color:white;">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x" style  = "color:white;"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x" style  = "color:white;"></i></a></h3>
    <h3 id = "partnership" style  = "color:white;">Want to work with us? Click <a  style = " text-decoration: underline; color:white;" href = "marketing/marketreq-page.php" > here</a> to know more</h3>
    <h3 style="margin-left:22%;"><a href="about-Us.php" style=" text-decoration: none; color:white;">About Us</a></h3>
    </div>
</body>

<footer>
</footer>

</html>
<?php ?>