<?php
session_start();
include "viewMRequest.php";

if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Marketing Request</title>
    <link rel = "stylesheet" href = "adminViewReq.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../../Images/client_logo.ico">
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
<!-- value=      ?php echo $_SESSION['userName']; ?>-->
   
    <div class = "marketingReqs">
 <h1>Marketing Request - View</h1>
        
        <div class = "user-contents">
            <div class = "businessPersonalInfo">
                <h3 id = "name">Sender Name: <?=$row['name']?></h3>
                <h3 id = "socmed">Social Media: <?=$row['socmed']?></h3><br>
                <h3 id = "businessName">Business Name: <?=$row['businessName']?></h3>
                <h3 id = "address">Address: <?=$row['address']?></h3>
                <h3 id = "contactInfo">Phone Number: <?=$row['phonenum']?></h3>
            </div>

            <h3 id = "aboutBusiness">Business Info:</h3>
                <div class = "businessInfo">
                    <?=$row['businessInfo']?>
                </div>
                
            <h3 id = "attachedImage">Attached Images: </h3>

            <div class = "attachedImage">
                <img src="marketreqImages/<?=$row['businessImage']?>">
                <!--input type="text" name="bImage"  value="<!?=$row['businessImage']?>" hidden-->
            </div>
        </div>

        <div class = "tabDelBack">
            <button id = "back" style ="color: black; background-color: beige; box-shadow: 5px 10px gray; border: 2px solid black;"><a href = "all-requests.php">Back</a></button>
            <button id = "del" style ="color: black; background-color: beige; box-shadow: 5px 10px gray; border: 2px solid black; margin-left: 85px; font-weight: bold;"><a href="deleteRequest.php?reqID=<?=$row['reqID']?>&businessImage=<?=$row['businessImage']?>" class = "btn btn-danger">Delete</a></button>
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