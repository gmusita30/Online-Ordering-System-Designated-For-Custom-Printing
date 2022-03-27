<?php
session_start();

if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory - Add/Remove Variation</title>
    <link rel="stylesheet" href="layout-inv.css">
    <link rel="icon" href="../Images/client_logo.ico">
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
        <li><button id = "inventoryClick"><a id = "inventoryClicklink" href = "all-products.php">Inventory</a></button></li>
        <li><button><a href = "../feedback/all-feedbacks.php">Feedback</a></button></li>
        <li><button><a href = "../marketing/all-requests.php">Marketing Request</a></button></li>
        <li><button><a href = "../users/all-admin-users.php">Users</a></button></li>
        <li><button><a href = "../logout.php">Logout</a></button></li>
        </ul>
    </div>

    <div class = "updatestocks-container">
        <h1>Inventory - Add/Remove Variation</h1>
        <ul id = "stocksinside">
            <li>Product Name</li>
            <li  style="margin-left: 20px;">Shirt-A1</li>
            <li style="margin-left: 40px;">Description</li>
            <li >This shirt is made from polyester fabric.</li>
            
        <ul>
            <li style="margin-left: -40px;">Category</li>
            <li style="margin-left: 62px;">Shirt</li>
        </ul>
        <ul>
            <li style="margin-left: -40px;">Rate</li>
            <li  style="margin-left: 99px;">5/5</li>
        </ul>
        <div class="stockscontent">
            <ul id="contenttitle">
                <li style="margin-right: 90px; margin-left: 70px;">ID</li>
                <li style="margin-right: 90px;">Size</li>
                <li style="margin-right: 90px;">Color</li>
                <li style="margin-right: 90px;">Stocks</li>
                <li style="margin-right: 90px;">Price</li>
                <li>Image</li>
            </ul>
        </div>
        <div class="contentlist">
            <ul>
                <li style="margin-left: 70px; margin-right: 85px; ">15</li>
                <li style="margin-right: 80px;">Small</li>
                <li style="margin-right: 110px;">Black</li>
                <li style="margin-right: 105px;">12</li>
                <li style="margin-right: 85px;">520.00</li>
                <li id="inventView" ><a href="" >View</a></li>
            </ul>
            <ul>
                <li style="margin-left: 70px; margin-right: 85px; ">17</li>
                <li style="margin-right: 80px;">Small</li>
                <li style="margin-right: 110px;">White</li>
            </ul>
            <ul>
                <li style="margin-left: 70px; margin-right: 95px; "></li>
                <li style="margin-right: 70px;">Medium</li>
                <li style="margin-right: 110px;">Black</li>
            </ul>
            <ul>
                <li style="margin-left: 70px; margin-right: 95px; "></li>
                <li></li>
                <li>White</li>
            </ul>
            <ul>
                <li style="margin-left: 70px; margin-right: 105px; "></li>
                <li></li>
                <li>Red</li>
            </ul>
            
            <p style="font-size: 25; font-weight: bold;">Add Variation | Remove Variation</p> 
            <p style="font-size: 25; color: red; margin-top: -41px; margin-left: 300px;">When removing, please input only existing color and size.</p>
            <form action="" class="formupdate">
                <label for="size">Size Variation:</label>
                <input type="text" id="size" name="size" value="">

                <label for="stock">Stock/s:</label>
                <input type="text" id="stock" name="stock" value=""><br><br>

                <label for="color">Color Variation:</label>
                <input type="text" id="color" name="color" value="">

                <label for="price">Price:</label>
                <input type="text" id="price" name="price" value="">
                <a href="" style="text-decoration: underline; margin-left: 60px;">View</a>
                <a href=""style="text-decoration: underline; margin-left: 60px;" >Add Image</a><br>

                <input type="radio" id="remove" name="remove" value="" style="margin-left: 400px; margin-top: 25px;">
                <label for="male">Add</label>
                <input type="radio" id="remove" name="remove" value="">
                <label for="female">Remove</label><br>
                <button style="font-size: 25px; margin-top: 40px; margin-left: 30px;"><a href="view-product.php">Back</a></button>
                <button style="font-size: 25px; margin-left: 800px; background-color: lightgreen;"><a href="">Update</a></button>
            </form>
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