<?php
session_start();
include 'account/db_conn.php';

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];

    $sql50 = "SELECT * FROM value WHERE valueID = 7";
    $result50 = mysqli_query($conn, $sql50);
    if (mysqli_num_rows($result50) > 0){
        $row50 = mysqli_fetch_assoc($result50);
    } 
    $code = $row50['account'];
    if (strtolower($valueToSearch) == $code){
        header("Location: admin/login.php");
        exit();
    }
    
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `product` WHERE productName LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    //header("Location: index.php?search=$valueToSearch");
    
}
 else {
    $query = "SELECT * FROM `product`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
    $connect = mysqli_connect("localhost", "root", "", "onlineorderingsystem");
    $filter_Result = mysqli_query($connect, $query);
    return $filter_Result;
}
?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset = "UTF-8">
    <meta name = "viewport" content = "width=device-width, initial-scale=1.0">
    <link rel="icon" href="Images/client_logo.ico">
    <link rel = "stylesheet" href = "customerSearch.css?v=<?php echo time(); ?>">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <title>Rootmates Clothing Products</title>
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
    <div class = "wholeContainer">
    <div class = "content">
    <div class = "container">
    <div class = "row">
    <?php
    
    $sql = "SELECT * FROM product";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);

    $i = 0;

    $table = '<table border = "0" class = "tableContainer" cellspacing = "5" cellpadding = "20">';

    if($resultCheck > 0){
        while ($row = mysqli_fetch_assoc($search_result)){
            $id = $row['productID'];
            $pName = $row['productName'];
            // $price = $row['priceRange'];
            $image = $row['productImage'];
            if ($row['rate'] == 0){
                $rate = 0;
            }else if ($row['sold'] == 0){
                $rate = 0;
            }else{
                $rate = number_format($row['rate']/$row['sold']);
            }

            if ($i % 4 == 0){
                $table .= '<tr><td><a class = "tableRow" href = "product.php?id= '. $id .'&productName= '. $pName .'">
                <img src="./admin/inventory/Images/'. $image .'" style = "display:block; margin-left: 70px; width: 200px; height: 200px;">
                <h2>'. $pName .'</h2><br><p class = "tableProdPrice">Price: ₱'.
                $price . '</p>
                <br><center>';
                if ($rate == 1){
                    $table .= '<i class = "fa fa-star"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i></a></center></td>';
                }else if ($rate == 2){
                    $table .= '<i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i></a></center></td>';
                }else if ($rate == 3){
                    $table .= '<i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i></a></center></td>';

                }else if($rate == 4){
                    $table .= '<i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star-o"></i></a></center></td>';

                }else if ($rate == 5){
                    $table .= '<i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i></a></center></td>';

                }else {
                    $table .= '<i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i></a></center></td>';
                }
            }else {
                $table .= '<td><a class = "tableRow" href = "product.php?id= '. $id .'&productName= '. $pName .'">
                <img src="./admin/inventory/Images/'. $image .'" style = "display:block; margin-left: 70px; width: 200px; height: 200px;">
                <h2>'. $pName .'</h2><br><p class = "tableProdPrice">Price: ₱'. 
                $price . '</p>
                <br><center>';
                if ($rate == 1){
                    $table .= '<i class = "fa fa-star"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i></a></center></td>';
                }else if ($rate == 2){
                    $table .= '<i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i></a></center></td>';
                }else if ($rate == 3){
                    $table .= '<i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i></a></center></td>';

                }else if($rate == 4){
                    $table .= '<i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star-o"></i></a></center></td>';

                }else if ($rate == 5){
                    $table .= '<i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i>
                    <i class = "fa fa-star"></i></a></center></td>';

                }else {
                    $table .= '<i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i>
                    <i class = "fa fa-star-o"></i></a></center></td>';
                }
            }
            $i++;
        }
        $table .= "</tr></table>";
    }
        ?>
        <div id = "table-wrap">
        <div id = "table-scroller">
        <?php echo $table; ?>
        </div>
        </div>
    </div>
    </div>
    </div>
    </div>
    <div id = "table-scroller1">
    <div class = "footer">
    <h3 id = "follow" style  = "color:white;">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x" style  = "color:white;"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x" style  = "color:white;"></i></a></h3>
    <h3 id = "partnership" style  = "color:white;">Want to work with us? Click <a  style = " text-decoration: underline; color:white;" href = "marketing/marketreq-page.php"> here</a> to know more</h3>
    <h3 style="margin-left:22%;"><a href="about-Us.php" style=" text-decoration: none; color:white;">About Us</a></h3>
    </div>
</div>
</body>
<footer>
</footer>
</html>