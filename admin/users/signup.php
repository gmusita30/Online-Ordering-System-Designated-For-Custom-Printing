<?php
session_start();

if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign Up</title>
    <link rel="stylesheet" href="stylesignup.css?v=<?php echo time(); ?>">
    <link rel="icon" href="../../Images/client_logo.ico">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<div class = "header">
    <a href="../index.php"><img src = "Images/client_logo.png" alt = "Rootmates Clothing Logo"></a>
    <h3>Rootmates <br> Clothing</h3>
     
    </div>


<body>
<div class="container">
    <h2>Signup Admin Account</h2>
    <form action="signupVerify.php" method="post">
    
            <div class="enter">
                <label id = "eventTitle"> Please enter the necessary information <br></label>
            </div>

            <div class="name">
            <label id = "eventTitle" >Full name <br> </label>
            <?php if (isset($_GET['name'])) { ?>
                <input type="text"
                        id = "Eventtitle"
                        name="name"
                        class="inputbox"
                        placeholder="Please enter your Full name"
                        value="<?php echo $_GET['name']; ?>">
            <?php }else{ ?>
                <input type="text"
                        id = "Eventtitle"
                        name="name"
                        class="inputbox"
                        placeholder="Please enter your Full name">
                <?php }?>
            </div><br>

            <div class="uname">
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

            <div class="position">
            <label id = "eventTitle" >Position <br> </label>
            <?php if (isset($_GET['pos'])) { ?>
                <input type="text"
                        id = "Eventtitle"
                        name="pos"
                        class="inputbox"
                        placeholder="Please enter your Position in the Company"
                        value="<?php echo $_GET['pos']; ?>">
            <?php }else{ ?>
                <input type="text"
                        id = "Eventtitle"
                        name="pos"
                        class="inputbox"
                        placeholder="Please enter your Position in the Company">
                <?php }?>
            </div><br><br>

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
            
            <div class="code">
            <label id = "eventTitle" >Security Code <br> </label>
            <?php if (isset($_GET['code'])) { ?>
                <input type="password"
                        id = "Eventtitle"
                        name="code"
                        class="inputbox"
                        placeholder="Please enter Security Code"
                        value="<?php echo $_GET['emailadd']; ?>">
            <?php }else{ ?>
                <input type="password"
                        id = "Eventtitle"
                        name="code"
                        class="inputbox"
                        placeholder="Please enter Security Code">
                <?php }?>
            </div>

            <div class="but">
                <label id = "Submit"></label><input type = "submit" value = "Create Admin Account" class="bo1" onclick = "Forms()">
            </div>

            <?php if (isset($_GET['error'])) { ?>
                <p class="error"><?php echo $_GET['error']; ?></p>
            <?php } ?>

            <?php if (isset($_GET['success'])) { ?>
                <p class="success"><?php echo $_GET['success']; ?></p>
            <?php } ?>

            <div class="signup">
                <h3>Already have an admin account? <a href="../login.php" class="side">Click here to login</a> </h3>
            </div>
     
    </form>
</div>
<div id = "table-scroller">
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  
  
<div class = "footer">
    <h3 id = "follow">Follow Us: &nbsp;<a href = "https://www.facebook.com/Rootmates"><i class = "fa fa-facebook-official fa-15x"></i></a>
    <a href = "https://www.instagram.com/rootmates/"><i class = "fa fa-instagram fa-15x"></i></a></h3>
    <h3 id = "partnership">Want to work with us? Click <a href = "../marketing/marketreq-page.php"> here</a> to know more</h3>
    <h5 id = "questions">Got a question? <br>Ask us</h5>
    <h4>About Us <br> Contacts <br>Branches</h4>
    </div>
</footer>
</body>
</html>
<?php?>