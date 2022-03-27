<?php
session_start();
include "editShipping.php";

if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Shipping Fees</title>
    <link rel="stylesheet" href="layout-order.css?v=<?php echo time(); ?>">
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
        <li><button id = "orderClick"><a  id = "orderClicklink" href = "all-orders.php">Orders</a></button></li>
        <li><button><a href = "../inventory/all-products.php">Inventory</a></button></li>
        <li><button><a href = "../feedback/all-feedbacks.php">Feedback</a></button></li>
        <li><button><a href = "../marketing/all-requests.php">Marketing Request</a></button></li>
        <li><button><a href = "../users/all-admin-users.php">Users</a></button></li>
        <li><button><a href = "../logout.php">Logout</a></button></li>
        </ul>
    </div>
    
    
    <div class = "order-container">
        <h1>Edit Shipping Fees</h1>
        <div class="ordertable">
            <form action = "editShipping.php" method = "post">
                <h3>Cash-On-Delivery</h3>
                <?php
                $sql = "SELECT * FROM value WHERE valueID = 1";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                }
                ?>
                Location: 
                <input type="text" value="<?php echo $row['valname']?>" name="loc1" max="40"></input>
                Shipping Fee:
                <input type="number" value="<?php echo $row['price']?>" name="sf1" min ="0"></input><br><br>
                
                <?php
                $sql = "SELECT * FROM value WHERE valueID = 2";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                }
                ?>
                Location: 
                <input type="text" value="<?php echo $row['valname']?>" name="loc2"></input>
                Shipping Fee:
                <input type="number" value="<?php echo $row['price']?>" name="sf2" min ="0"></input><br>

                <h3>GCash</h3>
                <?php
                $sql = "SELECT * FROM value WHERE valueID = 3";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                }
                ?>
                Location: 
                <input type="text" value="<?php echo $row['valname']?>" name="loc3"></input>
                Shipping Fee:
                <input type="number" value="<?php echo $row['price']?>" name="sf3" min ="0"></input><br><br>
                
                <?php
                $sql = "SELECT * FROM value WHERE valueID = 4";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                }
                ?>
                Location: 
                <input type="text" value="<?php echo $row['valname']?>" name="loc4"></input>
                Shipping Fee:
                <input type="number" value="<?php echo $row['price']?>" name="sf4" min ="0"></input><br>
                
                <h3>GCash Account Information</h3>
                <?php
                $sql = "SELECT * FROM value WHERE valueID = 5";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_assoc($result);
                }
                ?>
                Account Name:
                <input type="text" value="<?php echo $row['valname']?>" name="accname"></input>
                Account Number:
                <input type="number" value="<?php echo $row['account']?>" name="accnum"></input>
                <br><br>

        </div>
        
        <div class = "order-buttons-customer">
        <ul>
        <li>
            <button class="button" style ="color: black; background-color: beige; box-shadow: 5px 10px gray; border: 2px solid black;"><a href="all-orders.php">Back</a></button>
            <button class="button" name="update" style ="color: black; background-color: beige; box-shadow: 5px 10px gray;margin-top: 10px; border: 2px solid black; font-weight: bold;" onclick = "Forms()">Apply Changes</button>
        </li>
        </ul>
        </form>
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