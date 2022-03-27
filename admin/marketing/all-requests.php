<?php
session_start();
include "allMRequest.php";

if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Marketing Requests</title>
    <link rel = "stylesheet" href = "adminLayout.css?v=<?php echo time(); ?>">
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
        <li><button id = "marketClick"><a  id = "marketClicklink" href = "all-requests.php">Marketing Request</a></button></li>
        <li><button><a href = "../users/all-admin-users.php">Users</a></button></li>
        <li><button><a href = "../logout.php">Logout</a></button></li>
        </ul>
    </div>

    <div class = "marketingReqs">
        <h1>Marketing Request</h1>
        <div class = "user-contents">
            <div class = "box">
                 <?php if (mysqli_num_rows($result)) { ?>
                <table class="table table-striped">
                    <thead>
                        <tr style = "font-size: 20px;">
                            <th scope="col" style = "border-bottom: 2px solid black;">ID</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Sender Name</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Business Name</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Phone Number</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Social Media</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Business Info</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Address</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Business Image</th>
                            <th scope="col" style = "border-bottom: 2px solid black;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $i = 0;
                            while($rows = mysqli_fetch_assoc($result)){
                            $i++;
                        ?>
                        <tr style = "font-size: 20px; text-align:center;">
                            <td><?=$rows['reqID']?></td>
                            <td><?=$rows['name']?></td>
                            <td><?=$rows['businessName']?></td>
                            <td><?=$rows['phonenum']?></td>
                            <td><?=$rows['socmed']?></td>
                            <td><?=$rows['businessInfo']?></td>
                            <td><?=$rows['address']?></td>
                            <td><?=$rows['businessImage']?></td>
                            <td style = "font-weight: bold;">
                                <a href="view-request.php?reqID=<?=$rows['reqID']?>" class ="btn btn-success">View</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                    <?php } ?>
            </div>
        </div>   

        <div class = "refresh">
            <button><a href = "all-requests.php">Refresh</a></button>
            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>
        </div>
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