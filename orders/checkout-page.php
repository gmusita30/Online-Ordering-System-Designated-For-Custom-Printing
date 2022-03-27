<?php
session_start();
include "checkOutProcess.php";

if (isset($_GET['customerID'])){
    include "../account/db_conn.php";

    function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    $customerID = validate($_GET['customerID']);

    $sql = "SELECT * FROM cart 
            INNER JOIN product_variant ON cart.colorID = product_variant.colorID 
            INNER JOIN product ON product.productID = product_variant.productID 
            WHERE customerID = '".$_SESSION['customerID']."' ORDER BY cartID";
    $result = mysqli_query ($conn, $sql);


    $sql2 = "SELECT * FROM cart 
            INNER JOIN product_variant ON cart.colorID = product_variant.colorID 
            INNER JOIN product ON product.productID = product_variant.productID 
            WHERE customerID = '".$_SESSION['customerID']."' ORDER BY cartID";
    $result2 = mysqli_query ($conn, $sql2);
    $num_rows = mysqli_num_rows($result2);

    $sql10 = "SELECT * FROM value";
    $result10 = mysqli_query($conn, $sql10);

    if (mysqli_num_rows($result10) > 0){
            $row10 = mysqli_fetch_assoc($result10);
    }
}

if(mysqli_num_rows($result) > 0){
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout Page</title>
    <link rel="stylesheet" href="customerCartLayout.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../Images/client_logo.ico">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<header>
    <div class = "header">
    <a href="../index.php"><img src = "Images/client_logo.png" alt = "Rootmates Clothing Logo"></a>
    <h3  style  = "color:white;">Rootmates <br> O-Store</h3>
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
        <h2 id="headerOrder">Order Contents</h2>
        <ul id = "customerContainerOrder">
        <form action="checkoutProcess.php?customerID=<?=$_SESSION['customerID']?>" method="post" enctype="multipart/form-data">
            <!--fieldset-->
            <center>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col" hidden></th>
                            <th scope="col" hidden></th>
                            <th scope="col" hidden></th>
                            <th scope="col">Product Image</th>
                            <th scope="col">Product Name</th>
                            <th scope="col">Color</th>
                            <th scope="col">Size</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <div class="scroll">
                    <tbody>
                            <?php
                                if(mysqli_num_rows($result) > 0){
                                    $i=0;
                                    $j=0;
                                    while ($rows = mysqli_fetch_array($result)){                            
                                    $i++;
                            ?>
                            <?php if ($rows['stocks'] > 0){?>
                            <tr>
                                <td hidden><input type="text" id="user" name="cartID[]" value="<?php echo $rows['cartID']?>" hidden readonly></td>
                                <td hidden><input type="checkbox" id="user" name="colorID[]" value="<?php echo $rows['colorID']?>" checked hidden></td>
                                <td hidden><input type="checkbox" id="user" name="productID[]" value="<?php echo $rows['productID']?>" checked hidden></td>
                                <td><img src="../admin/inventory/Images/<?=$rows['productImage']?>"></td>
                                <td><?php echo $rows['productName']?></td>
                                    <td hidden><input type="text" id="user" name="productName[]" value="<?php echo $rows['productName']?>" readonly></td>
                                <td><?php echo $rows['colorName']?></td>
                                    <td hidden><input type="text" id="user" name="colorName[]" value="<?php echo $rows['colorName']?>" readonly></td>
                                <td><?php echo $rows['size']?></td>
                                    <td hidden><input type="text" id="user" name="size[]" value="<?php echo $rows['size']?>" readonly></td>
                                <td>₱<?php echo $rows['price']?>.00</td>
                                    <td hidden><input type="text" id="user" name="price[]" value="<?php echo $rows['price']?>" readonly></td>
                                <td>
                                    <?php if ($rows['quantity'] <= $rows['stocks']){ ?>
                                        <?php echo $rows['quantity']?>
                                        <input type="number" name = "qty[]" value="<?php echo $rows['quantity']?>" readonly hidden>
                                        <?php $j+=($rows['price'] * $rows['quantity']); ?>
                                    <?php }else if ($rows['quantity'] > $rows['stocks']){ ?>
                                        <?php echo $rows['stocks']?>
                                        <input type="number" name = "qty[]" value="<?php echo $rows['stocks']?>" readonly hidden>
                                        <?php $j+=($rows['price'] * $rows['stocks']); ?>
                                    <?php }?>
                                </td>
                                <td>
                                    ₱<?php if ($rows['quantity'] <= $rows['stocks']) {
                                            echo $rows['price'] * $rows['quantity'];
                                        } else if($rows['quantity'] > $rows['stocks']){
                                            echo $rows['price'] * $rows['stocks'];
                                        }?>.00
                                </td>
                            <?php } else{?>
                            <?php }?>
                            </tr>
                            <tr>
                                <td colspan="7"> 
                                    <center>
                                        <?php
                                        if ($num_rows == $i){
                                            echo "Total Price of Items: ₱$j.00";
                                        }
                                        ?>
                                    </center>
                                </td>
                            </tr>

                            <?php }}?>
                        </tbody>
                        </div>
                    </table>                
                </ul>
                    </center>
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
                
                <br>
                <center><button style = "background-color: lightblue;"><a href="cart-page.php" style = "font-weight:bold; text-decoration:none; color:black;">Go back to Cart I want to make additional changes to my order</a></button></center>

                <h2 id="headerOrder">Delivery Information</h2>
                <div class = "pInfo">
                    <!--put session info -->
                    Name: <?php echo $_SESSION['customerFName']?> <?php echo $_SESSION['customerLName']?>
                        <input type="text" name="customerName" value= "<?php echo $_SESSION['customerFName']?> <?php echo $_SESSION['customerLName']?>" readonly hidden> <br>
                    Contact Number: <?php echo $_SESSION['phonenum']?>
                        <input type="text" name="phonenum" value="<?php echo $_SESSION['phonenum']?>" readonly hidden> <br>
                    Address: <?php echo $_SESSION['address']?>
                        <input type="text" name="address" value="<?php echo $_SESSION['address']?>" readonly hidden> <br>
                    Email: <?php echo $_SESSION['email']?>
                        <input type="text" name="email" value="<?php echo $_SESSION['email']?>" readonly hidden> <br><br>
                    <input type="text" name="customerID" value="<?php echo $_SESSION['customerID']?>" readonly hidden>

                    <center>(Change delivery information on your <a href="../account/manage-account.php">Manage Account</a> page)</center>
                </div>

                <h2 id="headerOrder">Payment Method</h2>
                <input type="text" name="orderStatus" value="Pending" readonly hidden>
                <input type="text" name="rate" value="Unrated" readonly hidden>

                <div class = "cod">
                    <center><h2>Pay on Cash-On-Delivery</h2></center>
                        <p>Payment for your order will be on your doorstep. 
                        We will notify you thru your notifications, your phone number and your email regarding the status of your order.</p>
                            <?php 
                            $sql10 = "SELECT * FROM value WHERE valueID = 1";
                            $result10 = mysqli_query($conn, $sql10);
                        
                            if (mysqli_num_rows($result10) > 0){
                                    $row10 = mysqli_fetch_assoc($result10);
                            }

                            echo "Cart Price: ₱$j.00 <br><br>";
                            echo $row10['valname'];
                            echo "<br>";

                            echo "Shipping Fee: ₱";
                            echo $row10['price'];
                            echo ".00<br>";
                            
                            $k = $j + $row10['price']; 
                            echo "Total Price to Pay: ₱$k.00";
                            ?> <br>
                            
                            <input type="text" name="paymentcod" value="COD" readonly hidden>
                            <input type="text" name="paymentProofcod" value="none" readonly hidden>
                            <input type="text" name="codnearprice" value="<?php echo $k?>" readonly hidden>
                    <center><button class="button" name="codnear" onclick = "Forms()" style = "background-color: lightgreen; font-weight:bold;">Place Order</button></center><br>

                            <?php 
                            $sql10 = "SELECT * FROM value WHERE valueID = 2";
                            $result10 = mysqli_query($conn, $sql10);
                        
                            if (mysqli_num_rows($result10) > 0){
                                    $row10 = mysqli_fetch_assoc($result10);
                            }
                            echo $row10['valname'];
                            echo "<br>";

                            echo "Shipping Fee: ₱";
                            echo $row10['price'];
                            echo ".00<br>";
                            
                            $k = $j + $row10['price']; 
                            $a = $k; 
                            echo "Total Price to Pay: ₱$k.00";
                            ?> <br>
                            
                            <input type="text" name="paymentcod" value="COD" readonly hidden>
                            <input type="text" name="paymentProofcod" value="none" readonly hidden>
                            <input type="text" name="codfarprice" value="<?php echo $a?>" readonly hidden>
                    <center><button class="button" name="codfar" onclick = "Forms()" style = "background-color: #ccb494; font-weight:bold;">Place Order</button></center>
                </div>

                <div class = "gcash">
                    <center><h2>Pay through GCash</h2></center>
                        <p>Payment can be done thru GCash preferred banks, over-the-counter, and GCash Remittance Partners. 
                        We will notify you thru your notifications, your phone number and your email regarding the status of your order.</p>
                        <div class="gcashacc">
                            <?php
                            $sql10 = "SELECT * FROM value WHERE valueID = 5";
                            $result10 = mysqli_query($conn, $sql10);
                        
                            if (mysqli_num_rows($result10) > 0){
                                    $row10 = mysqli_fetch_assoc($result10);
                            }?>
                            <?php echo $row10['valname'];?>
                            <br><br>
                            <div id="account">
                                <?php echo $row10['account'];?>
                            </div>
                        </div>
                        <br>
                        
                        <center>
                            Upload Proof of Transaction (Required) <br>
                            <input type="file" name="paymentProofgcash"><br><br>
                        </center>
                        <?php 
                           $sql10 = "SELECT * FROM value WHERE valueID = 3";
                           $result10 = mysqli_query($conn, $sql10);
                       
                           if (mysqli_num_rows($result10) > 0){
                                   $row10 = mysqli_fetch_assoc($result10);
                           }

                           echo "Cart Price: ₱$j.00<br><br>";
                           echo $row10['valname'];
                           echo "<br>";

                           echo "Shipping Fee: ₱";
                           echo $row10['price'];
                           echo ".00<br>";
                           
                           $k = $j + $row10['price']; 
                           echo "Total Price to Pay: ₱$k.00";
                           
                        ?> <br>
                            <input type="text" name="paymentgcash" value="GCash" readonly hidden>
                            <!--input type="text" name="paymentProofgcash" value="none" readonly hidden-->
                            <input type="text" name="gcashnearprice" value="<?php echo $k?>" readonly hidden>
                    <center><button class="button" name="gcashnear" onclick = "Forms()" style = "background-color: lightgreen; font-weight:bold;">Place Order</button></center><br>

                    <?php 
                           $sql10 = "SELECT * FROM value WHERE valueID = 4";
                           $result10 = mysqli_query($conn, $sql10);
                       
                           if (mysqli_num_rows($result10) > 0){
                                   $row10 = mysqli_fetch_assoc($result10);
                           }

                           echo $row10['valname'];
                           echo "<br>";

                           echo "Shipping Fee: ₱";
                           echo $row10['price'];
                           echo ".00<br>";
                           
                           $k = $j + $row10['price'];
                           $a = $k; 
                           echo "Total Price to Pay: ₱$k.00";
                           
                        ?> <br>
                            <input type="text" name="paymentgcash" value="GCash" readonly hidden>
                            <!--input type="text" name="paymentProofgcash" value="none" readonly hidden-->
                            <input type="text" name="gcashfarprice" value="<?php echo $a?>" readonly hidden>
                    <center><button class="button" name="gcashfar" onclick = "Forms()" style = "background-color: #ccb494; font-weight:bold;">Place Order</button></center>
                </div>
            <!--/fieldset-->
        </form>
        <img src= "Images/tree.png" style = "position:absolute; z-index: -5; width: 200px; height: 100px; margin-left: -10px; margin-top: 635px;">
        <img src= "Images/tree.png" style = "position:absolute; z-index: -5; width: 200px; height: 100px; margin-left: 1300px; margin-top: 635px;">
    </div>
</body>

<footer style = "margin-top: 700px;">
    <div class = "footer" style = "padding-left: 20px; margin-left: -10px; padding-bottom: 2px;">
    <h3 id = "follow" style  = "color:white;">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x"  style  = "color:white;"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x" style  = "color:white;"></i></a></h3>
    <h3 id = "partnership" style  = "color:white;">Want to work with us? Click <a  style = "text-decoration: underline; color: white;" href = "../marketing/marketreq-page.php"> here</a> to know more</h3>
    <h3 style="margin-left:25%;"><a href="../about-Us.php" style="text-decoration: none; color: white;">About Us</a></h3>
    </div>
</footer>
</html>
<?php
}else{
    header("Location: cart-page.php");
    exit();
}
?>