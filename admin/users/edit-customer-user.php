<?php
session_start();
include 'editCustomer.php';

if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer User</title>
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
        <h1 id="usershow">Edit Customer User</h1>
        <div class = "user-contents">
            <form action = "editCustomer.php" method = "post">
                <fieldset>
                <div class="form" id="left">
                    <h3>First name</h3>
                    <h3>Last name</h3>
                    <h3>Phone number</h3>
                    <h3>Address</h3>
                    <h3>Username</h3>
                    <h3>Email</h3>
                    <h3>Current Password</h3>
                    <h3>Password</h3>
                    <h3>Repeat Password</h3>
                </div>

                <div class="fill" id="right">
                    <h3><input type = "text" id = "user" name = "fname" class="title" value = "<?=$row['customerFName']?>" placeholder = "Please enter First name"> <br></h3>
                    <h3><input type = "text" id = "user" name = "lname" class="title" value = "<?=$row['customerLName']?>" placeholder = "Please enter Last Name"> <br></h3>
                    <h3><input type = "number" id = "user" name = "pnum" class="title" value = "<?=$row['phonenum']?>" placeholder = "Please enter Phone number"> <br></h3>
                    <h3><input type = "text" id = "user" name = "add" class="title" value = "<?=$row['address']?>" placeholder = "Please enter Address"> <br></h3>
                    <h3><input type = "text" id = "user" name = "uname" class="title" value = "<?=$row['userName']?>" placeholder = "Please enter Username"> <br></h3>
                    <h3><input type = "email" id = "user" name = "emailadd" class="title" value = "<?=$row['email']?>" placeholder = "Please enter Email"> <br></h3>
                    <h3><input type = "text" class="title" placeholder = "<?=$row['pw']?>" readonly> <br></h3>
                    <h3><input type = "password" id = "user" name = "passw" class="title" placeholder = "Please enter Password"> <br></h3>
                    <h3><input type = "password" id = "user" name = "repeatpass" class="title" placeholder = "Please Repeat Password"> <br></h3>
                    <input type ="text" name="customerID" value = "<?=$row['customerID']?>" hidden>
                    <input type ="text" name="un" value = "<?=$row['userName']?>" hidden>
                    <input type ="email" name="eadd" value = "<?=$row['email']?>" hidden>
                </div>
                <div class = "buttons">
                    <?php if (isset($_GET['error'])) { ?>
                        <p class="error"><?php echo $_GET['error']; ?></p>
                    <?php } ?>

                    <?php if (isset($_GET['success'])) { ?>
                        <p class="success"><?php echo $_GET['success']; ?></p>
                    <?php } ?>  

                     <button class="button" style ="color: black; background-color: beige; box-shadow: 5px 10px gray; border: 2px solid black;"><a href="all-customer-users.php">Back</a></button>
                    <button class="button" name="update" style ="color: black; background-color: beige; box-shadow: 5px 10px gray; margin-top: 10px; border: 2px solid black; font-weight: bold;" onclick = "Forms()">Apply Changes</button>
                </div>
                </fieldset> 
            </form>
        </div>
</body>
</html>
<?php
}else{
    header("Location: ../login.php");
    exit();
}
?>