<?php
session_start();
include "editSecurity.php";

if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Security Settings</title>
    <link rel="stylesheet" href="layout.css?v=<?php echo time(); ?>">
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
        <li><button><a href = "../inventory/all-products.php">Inventory</a></button></li>
        <li><button><a href = "../feedback/all-feedbacks.php">Feedback</a></button></li>
        <li><button><a href = "../marketing/all-requests.php">Marketing Request</a></button></li>
        <li><button id = "usersClick"><a id = "usersClicklink" href = "all-admin-users.php">Users</a></button></li>
        <li><button><a href = "../logout.php">Logout</a></button></li>
        </ul>
    </div>
    
    
    <div class = "user">
        <h1>Security Settings</h1>
        <form action = "editSecurity.php" method = "post">
            <div class="user-contents">
                
                    <h3>Admin Access Code (Used in the search bar on the Customer Side to access Admin Side of the System)</h3>
                    <?php
                    $sql = "SELECT * FROM value WHERE valueID = 7";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_assoc($result);
                    }
                    ?>
                    Current Code: <?php echo $row['account']?> <br>
                    Change Code: <input type="text" value="<?php echo $row['valname']?>" name="accesscode"></input>

                    <h3>Security Code (Also used as a Security Code for Admin Signup Page)</h3>
                    <?php
                    $sql = "SELECT * FROM value WHERE valueID = 6";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0){
                        $row = mysqli_fetch_assoc($result);
                    }
                    ?>
                    New Code: <input type="password" value="" name="newcode" placeholder="Input New Code"> </input><br>
                    Repeat New Code: <input type="password" value="" name="renewcode" placeholder="Repeat New Code"> </input><br>

                    <h3>Verification</h3>
                    Security Code: <input type="password" value="" name="vercode" placeholder="Input Security Code"> </input><br>
                    <input type="password" value="<?php echo $row['account']?>" name="code" placeholder="Input Security Code" hidden> </input><br>

            </div>        

            <div class = "buttons">
                <?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
                <?php } ?>

                <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
                <?php } ?>
            
                <button class="button" style ="color: black; background-color: beige; box-shadow: 5px 10px gray; border: 2px solid black;"><a href="all-admin-users.php">Back</a></button>
                <button class="button" name="update" style ="color: black; background-color: beige; box-shadow: 5px 10px gray;margin-top: 10px; border: 2px solid black; font-weight: bold;" onclick = "Forms()">Apply Changes</button>
            </div>     
        </form>
    
       
        
</body>
</html> 
<?php
}else{
    header("Location: ../login.php");
    exit();
}
?>