<?php
session_start();
include "allCustomer.php";

if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Customer</title>
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
        <h1 id="usershow">Customers Users</h1>
        <div class = "user-contents">
        <div class = "box">
                 <?php if (mysqli_num_rows($result)) { ?>
                <table class="table table-striped">
                    <thead>
                        <tr style="background-color:beige; font-size: 20px;">
                            <th scope="col" style = "border-bottom: 2px solid black;">ID</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">First Name</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Last Name</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Username</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Phone Number</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Address</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Email</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Password</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0;
                            while($rows = mysqli_fetch_assoc($result)){
                            $i++;
                        ?>
                        <tr style = "font-size: 20px; text-align:center;">
                            <td><?=$rows['customerID']?></td>
                            <td><?=$rows['customerFName']?></td>
                            <td><?=$rows['customerLName']?></td>
                            <td><?=$rows['userName']?></td>
                            <td><?=$rows['phonenum']?></td>
                            <td><?=$rows['address']?></td>
                            <td><?=$rows['email']?></td>
                            <td><?= substr($rows['pw'], 0, 15)?></td>
                            <td style = "font-weight: bold;">
                                <a href="edit-customer-user.php?customerID=<?=$rows['customerID']?>" class = "btn btn-success">Edit</a>
                                <a href="delete-customer-user.php?customerID=<?=$rows['customerID']?>" class = "btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                    <?php } ?>
            </div>
        </div>   

        <div class = "buttons">
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <a href="all-admin-users.php"><button class="button" style="color: black; background-color: beige; box-shadow: 5px 10px gray; border: 2px solid black; font-weight: bold;">Admin</button></a>
            <a href="add-customer-user.php"><button class="button" style ="color: black; background-color: beige; box-shadow: 5px 10px gray; border: 2px solid black; font-weight: bold;">Add New Customer Account</button></a>
            <a href="all-customer-users.php"> <button class="button" style ="color: black; background-color: beige; box-shadow: 5px 10px gray; border: 2px solid black;">Refresh</button></a>
            <a href="edit-security.php"><button class="button" style ="color: black;  background-color: beige; box-shadow: 5px 10px gray; border: 2px solid black;">Security Settings</button></a>
        </div>     
    </div>
</body>
</html>
<?php
}else{
    header("Location: ../login.php");
    exit();
}
?>