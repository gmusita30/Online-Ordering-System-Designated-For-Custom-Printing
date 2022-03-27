<?php
session_start();

if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Customer</title>
    <link rel="stylesheet" href="layout-addcustomer.css?v=<?php echo time(); ?>">
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
        <h1 id="usershow">Add Customer Account</h1>
    <form action="addCustomerVerify.php" method="post">
        <fieldset style  = "background-color:beige; box-shadow: 5px 5px gray; border: 2px solid black;">  
            <div class="firstn">
            <label id = "eventTitle" >First name <br> </label>
            <?php if (isset($_GET['fname'])) { ?>
                <input type="text"
                        id = "Eventtitle"
                        name="fname"
                        class="inputbox"
                        placeholder="Please enter your First name"
                        value="<?php echo $_GET['fname']; ?>">
            <?php }else{ ?>
                <input type="text"
                        id = "Eventtitle"
                        name="fname"
                        class="inputbox"
                        placeholder="Please enter your First name">
                <?php }?>
            </div><br>

            <div class="lastn">
            <label id = "eventTitle" >Last name <br> </label>
            <?php if (isset($_GET['lname'])) { ?>
                <input type="text"
                        id = "Eventtitle"
                        name="lname"
                        class="inputbox"
                        placeholder="Please enter your Last name"
                        value="<?php echo $_GET['lname']; ?>">
            <?php }else{ ?>
                <input type="text"
                        id = "Eventtitle"
                        name="lname"
                        class="inputbox"
                        placeholder="Please enter your Last name">
                <?php }?>
            </div><br>

            <div class="phonenumber">
            <label id = "eventTitle" >Phone number <br> </label>
            <?php if (isset($_GET['pnum'])) { ?>
                <input type="text"
                        id = "Eventtitle"
                        name="pnum"
                        class="inputbox"
                        placeholder="Please enter your Phone number"
                        value="<?php echo $_GET['pnum']; ?>">
            <?php }else{ ?>
                <input type="text"
                        id = "Eventtitle"
                        name="pnum"
                        class="inputbox"
                        placeholder="Please enter your Phone number">
                <?php }?>
            </div><br>

            <div class="address">
            <label id = "eventTitle" >Address <br> </label>
            <?php if (isset($_GET['add'])) { ?>
                <input type="text"
                        id = "Eventtitle"
                        name="add"
                        class="inputbox"
                        placeholder="Please enter your Address"
                        value="<?php echo $_GET['add']; ?>">
            <?php }else{ ?>
                <input type="text"
                        id = "Eventtitle"
                        name="add"
                        class="inputbox"
                        placeholder="Please enter your Address">
                <?php }?>
            </div><br><br>

            <div class="username">
            <label id = "eventTitle" >Username <br> </label>
            <?php if (isset($_GET['uname'])) { ?>
                <input type="text"
                        id = "Eventtitle"
                        name="uname"
                        class="inputbox"
                        placeholder="Please enter your Username"
                        value="<?php echo $_GET['uname']; ?>">
            <?php }else{ ?>
                <input type="text"
                        id = "Eventtitle"
                        name="uname"
                        class="inputbox"
                        placeholder="Please enter your Username">
                <?php }?>
            </div>
            

            <div class="email">
            <label id = "eventTitle" >Email <br> </label>
            <?php if (isset($_GET['emailadd'])) { ?>
                <input type="email"
                        id = "Eventtitle"
                        name="emailadd"
                        class="inputbox"
                        placeholder="Please enter your Email"
                        value="<?php echo $_GET['emailadd']; ?>">
            <?php }else{ ?>
                <input type="email"
                        id = "Eventtitle"
                        name="emailadd"
                        class="inputbox"
                        placeholder="Please enter your Email">
                <?php }?>
            </div>

            <div class="passw">
            <label id = "eventTitle"> Password <br></label>
                <input type = "password" 
                        id="Eventtitle" 
                        name="passw" 
                        class="inputbox" 
                        placeholder="Please enter your Password"><br><br>
            </div>

            <div class="repeatpass">
            <label id ="eventTitle"> Repeat Password <br></label>
                <input type = "password" 
                        id="Eventtitle" 
                        name = "repeatpass" 
                        class="inputbox" 
                        placeholder="Please repeat your Password"><br><br>
            </div>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

        <div class = "buttons">
        <button class="button" style ="color: black; background-color: beige; box-shadow: 5px 10px gray; border: 2px solid black;"><a href="all-customer-users.php">Back</a></button>
            <button class="button" style ="color: black; background-color: beige; box-shadow: 5px 10px gray; border: 2px solid black; font-weight: bold;" onclick = "Forms()">Add Customer Account</button>
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