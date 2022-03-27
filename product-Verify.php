<?php 
include 'db_conn.php';

if (isset($_GET['id'])){  
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
            
    $productID = validate($_GET['id']);
    
    $sql = "SELECT * FROM product WHERE productID=$productID";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
    }

    $sql1 = "SELECT * FROM product_variant WHERE productID = '$productID' ORDER BY size ASC";
    $result1 = mysqli_query($conn, $sql1);

}else if(isset($_POST['cart'])){
    if (isset($_POST['colorID']) && isset($_POST['quant']) && isset($_POST['pID'])){
        include 'db_conn.php';
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
                    
        $colorID = validate($_POST['colorID']);
        $quantity = validate($_POST['quant']);
        $pID = validate($_POST['pID']);
        $customerID = $_GET['customerID'];

        $user_data = 'colorID='. $colorID. '&qty='. $quantity. '&customerID='. $customerID;

        $sql2 = "SELECT * FROM product_variant WHERE colorID = '$colorID'";
        $result2 = mysqli_query($conn, $sql2);

        $row2 = mysqli_fetch_assoc($result2);
        $stocks = $row2['stocks'];
            
      if ($colorID == "none"){
            header("Location: product.php?id=$pID&error=Please select a color and size");
            exit();
        }

        if ($quantity > $stocks) {
            header("Location: product.php?id=$pID&error=Quantity should not exceed over the available stock of the product's color and sizes");
            exit();
        } else if ($quantity < 1) {
            header("Location: product.php?id=$pID&error=Quantity should not be below the available stock of the product's color and sizes");
            exit();
        } else{
            $sql3 = "SELECT * FROM cart WHERE customerID = $customerID AND colorID = $colorID";
            $result3 = mysqli_query($conn, $sql3);
            if (mysqli_num_rows($result3) > 0){
                $row3 = mysqli_fetch_assoc($result3);
                $cartnum = $row3['cartID'];
                $addqty = $row3['quantity'] + $quantity;

                $sql4 = "UPDATE cart SET quantity = '$addqty' WHERE cartID = $cartnum";
                $result4 = mysqli_query($conn, $sql4);
                if ($result3){
                    header("Location: product.php?id=$pID&success=You have successfully added this product to your cart");
                    exit();
                }else {
                    header("Location: product.php?id=$pID&error=Unkown error occured please try again");
                    exit();
                }

            } else

            $sql4 = "INSERT INTO cart(customerID, colorID, quantity)
                    VALUES('$customerID', '$colorID', '$quantity')";
            $result4 = mysqli_query($conn, $sql4);
            if ($result3){
                header("Location: product.php?id=$pID&success=You have successfully added this product to your cart");
                exit();
            }else {
                header("Location: product.php?id=$pID&error=Unkown error occured please try again");
                exit();
            }
        }
    }

}else if(isset($_POST['buy'])){
    if (isset($_POST['colorID']) && isset($_POST['quant']) && isset($_POST['pID'])){
        include 'db_conn.php';
        function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
                    
        $colorID = validate($_POST['colorID']);
        $quantity = validate($_POST['quant']);
        $pID = validate($_POST['pID']);
        $customerID = $_GET['customerID'];

        $user_data = 'colorID='. $colorID. '&qty='. $quantity. '&customerID='. $customerID;

        $sql2 = "SELECT * FROM product_variant WHERE colorID = '$colorID'";
        $result2 = mysqli_query($conn, $sql2);

        $row2 = mysqli_fetch_assoc($result2);
        $stocks = $row2['stocks'];
            
        if ($colorID == "none"){
            header("Location: product.php?id=$pID&error=Please select a color and size");
            exit();
        }

        if ($quantity > $stocks) {
            header("Location: product.php?id=$pID&error=Quantity should not exceed over the available stock of the product's color and sizes");
            exit();
        } else if ($quantity < 1) {
            header("Location: product.php?id=$pID&error=Quantity should not be below the available stock of the product's color and sizes");
            exit();
        } else{
            $sql3 = "SELECT * FROM cart WHERE customerID = $customerID AND colorID = $colorID";
            $result3 = mysqli_query($conn, $sql3);
            if (mysqli_num_rows($result3) > 0){
                $row3 = mysqli_fetch_assoc($result3);
                $cartnum = $row3['cartID'];
                $addqty = $row3['quantity'] + $quantity;

                $sql4 = "UPDATE cart SET quantity = '$addqty' WHERE cartID = $cartnum";
                $result4 = mysqli_query($conn, $sql4);
                if ($result3){
                    header("Location: orders/checkout-page.php?&customerID=$customerID");
                    exit();
                }else {
                    header("Location: product.php?id=$pID&error=Unkown error occured please try again");
                    exit();
                }

            } else

            $sql4 = "INSERT INTO cart(customerID, colorID, quantity)
                    VALUES('$customerID', '$colorID', '$quantity')";
            $result4 = mysqli_query($conn, $sql4);
            if ($result3){
                header("Location: orders/checkout-page.php?&customerID=$customerID");
                exit();
            }else {
                header("Location: product.php?id=$pID&error=Unkown error occured please try again");
                exit();
            }
        }
    }
}

