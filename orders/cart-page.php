<?php
session_start();
include "viewCart.php";

if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link rel="stylesheet" href="customerCartLayout.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../Images/client_logo.ico">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<header>
    <div class = "header">
    <a href="../index.php"><img src = "Images/client_logo.png" alt = "Rootmates Clothing Logo"></a>
    <h3 style  = "color:white;">Rootmates <br> O-Store</h3>
        <nav>
        <form action="../index.php" method="post">
            <input id="searchBar" type="text" name="valueToSearch" placeholder="Search for Products">
            <button id = "searchbtn" type = "submit" value="Search" name="search"><i class = "fa fa-search"></i></button>
        </form>
            <button onclick="window.location.href='../notifications-page.php';" id = "notifbtn" type = "submit"><i class = "fa fa-bell fa-2x" style  = "color:white;"></i></button>
            
            <div class="dropdown">
            <button class = "dropbtn" id = "cartbtn" type = "submit"><i class = "fa fa-cart-plus fa-2x" style  = "color:white;"></i></button>
            <!--onclick="window.location.href='orders/cart-page.php';"
                onclick="window.location.href='account/manage-account.php';" 
             onclick="window.location.href='orders/order-page.php';" -->
             <div id="cartDropdown" class="dropdown-contentCart">
                <a href="cart-page.php">My Cart</a>
                <a href="order-page.php">My Orders</a>
            </div>
            </div>
            <div class="dropdown">
            <button class = "dropbtn" id = "profilebtn" type = "submit"><i class = "fa fa-user fa-2x" style  = "color:white;"></i></button>
            <div id="accountDropdown" class="dropdown-contentAccount">
                <a href="../account/manage-account.php">Manage Account</a>
                
                <?php
                if (isset($_SESSION['customerID']) && isset($_SESSION['userName'])){
                ?>
                <a href="../account/logout.php">Logout</a>
                <?php }else {?>
                    <a href="../account/login.php">Login</a>
             <?php }?>
            </div>
            </div>

        </nav>
    </div>
</header>

<body>
    <div class = "containerOrder">
        <h2 id="headerOrder">Cart</h2>
        <div class = "cart">
            <center>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" hidden></th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Size & Color</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Stocks</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        <?php
                            if(mysqli_num_rows($result) > 0){
                                $i=0;
                                $j=0;
                                while ($rows = mysqli_fetch_array($result)){                            
                                $i++;
                        ?>
                        <tr>
                            <form action="cartUpdateItem.php" method="post">
                                <td hidden><input type="text" name="cartID" value="<?=$rows['cartID']?>" hidden></input></td>
                                <td><img src="../admin/inventory/Images/<?=$rows['productImage']?>"></td>
                                <td><a href="../product.php?id=<?php echo $rows['productID']?>"><?php echo $rows['productName']?></a></td>
                                <td>
                                    <select id = "variation" name = "colorID">
                                        <option value = "<?php echo $rows['colorID']?>"><?php echo $rows['size']?> - <?php echo $rows['colorName']?></option>
                                        <?php 
                                            $pID = $rows['productID'];
                                            $sql1 = "SELECT * FROM product_variant WHERE productID = '$pID' ORDER BY size ASC";
                                            $result1 = mysqli_query($conn, $sql1);
                                            while ($row1 = mysqli_fetch_assoc($result1)){?>
                                                <?php if ($row1['stocks'] == 0){?>
                                                    <option value = "<?php echo $row1['colorID'] ?>" disabled><?php echo $row1['size']?> - <?php echo $row1['colorName']?> (No Stocks Available)</option>
                                                <?php }else {?>
                                                    <option value = "<?php echo $row1['colorID'] ?>"><?php echo $row1['size']?> - <?php echo $row1['colorName']?> (Stocks: <?php echo $row1['stocks']?>) = ₱<?php echo $row1['price']?></option>
                                                <?php }?>
                                        <?php }?>
                                    </select>
                                </td>
                                <td>₱<?php echo $rows['price']?>.00</td>
                                <td>
                                    <?php if ($rows['quantity'] <= $rows['stocks']){ ?>
                                        <input type="number" name = "qty" value="<?php echo $rows['quantity']?>" min="1" max="<?=$rows['stocks']?>">
                                        <?php $j+=($rows['price'] * $rows['quantity']); ?>
                                    <?php }else if ($rows['stocks'] == 0){ ?>
                                        <input type="number" name = "qty" value="0" min="0">
                                    <?php }else if ($rows['quantity'] > $rows['stocks']){ ?>
                                        <input type="number" name = "qty" value="<?php echo $rows['stocks']?>" min="1" max="<?=$rows['stocks']?>">
                                        <?php $j+=($rows['price'] * $rows['stocks']); ?>
                                    <?php }?>
                                </td>
                                <td>
                                        <?php if ($rows['stocks'] > 0) {?>
                                            <input type="number" name = "stocks" value="<?php echo $rows['stocks']?>" readonly>
                                        <?php } else {?>
                                            <input type="text" name = "stocks" value="Out of Stocks" readonly></td>
                                        <?php }?>
                                <td>
                                    ₱<?php if ($rows['quantity'] <= $rows['stocks']) {
                                            echo $rows['price'] * $rows['quantity'];
                                        } else if($rows['stocks'] == 0){
                                            echo 0;
                                        } else if($rows['quantity'] > $rows['stocks']){
                                            echo $rows['price'] * $rows['stocks'];
                                        }?>.00
                                </td>
                                <td>
                                    <button type = "submit" class = "btn btn-primary" name="update" style = "background-color: lightgreen; text-decoration:none; color:black; font-weight:bold;">Update</button>
                                    <button style = "background-color:#FF7276;"><a href="cartDeleteItem.php?cartID=<?=$rows['cartID']?>" style = "text-decoration:none; color:black; font-weight:bold;">Remove</a></button>
                                </td>
                            </form>
                        </tr>
                        <tr>
                            <td colspan="9"> 
                                <center>
                                    <?php
                                    if ($num_rows == $i){
                                        echo "<br>Total Cart Price: ₱$j.00 <br>";
                                    ?>
                                    <center>
                                        <?php if($j == 0){ ?>
                                            Please make sure the products in your Cart are not Out of Stocks
                                        <?php }else{ ?>
                                        <button style = "background-color: lightblue; font-weight: bold;"><a  style = "text-decoration: none; color:black;" href="checkout-page.php?customerID=<?=$_SESSION['customerID']?>">Checkout Cart</a></button><br>
                                        (Always make sure to update your cart if you have changed the quantity)
                                        <?php }?>
                                    </center>   
                                    <?php }?>
                                </center>
                            </td>
                        </tr>

                        <?php }}else{
                                echo "Please Add an item to your Cart first";
                        }?>
                    </tbody>
                    </div>
                </table>         
                <br>
            </ul>
                </center>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
    </div>
        <img src= "Images/tree.png" style = "position:absolute; z-index: -5; width: 200px; height: 100px; margin-left: -10px; margin-top: -40px;">
        <img src= "Images/tree.png" style = "position:absolute; z-index: -5; width: 200px; height: 100px; margin-left: 1300px; margin-top: -40px;">
</body>

<footer>
    <div class = "footer" style = "padding-left: 20px; margin-left: -10px;">
    <h3 id = "follow" style  = "color:white;">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x" style  = "color:white;"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x" style  = "color:white;"></i></a></h3>
    <h3 id = "partnership" style  = "color:white;">Want to work with us? Click <a  style = "text-decoration: underline; color:white;" href = "../marketing/marketreq-page.php"> here</a> to know more</h3>
    <h3 style="margin-left:25%;"><a href="../about-Us.php" style="text-decoration: none; color:white;">About Us</a></h3>
    </div>
</footer>
</html>
<?php
}else{
    header("Location: ../account/login.php");
    exit();
}
?>