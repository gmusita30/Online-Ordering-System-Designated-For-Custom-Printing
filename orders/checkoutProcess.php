<?php
include "../account/db_conn.php";

if (isset($_GET['customerID'])){
        include "../account/db_conn.php";

        function validate($data){
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
        $customerID = validate($_GET['customerID']);

        $sql = "SELECT * FROM cart 
                INNER JOIN product_variant ON cart.colorID = product_variant.colorID 
                INNER JOIN product ON product.productID = product_variant.productID 
                WHERE customerID = '".$_SESSION['customerID']."' ORDER BY cartID";
        $result = mysqli_query ($conn, $sql);


        $sql2 = "SELECT * FROM cart 
                INNER JOIN product_variant ON cart.colorID = product_variant.colorID 
                INNER JOIN product ON product.productID = product_variant.productID 
                WHERE customerID = '".$_SESSION['customerID']."' ORDER BY cartID";
        $result2 = mysqli_query ($conn, $sql2);
        $num_rows = mysqli_num_rows($result2);

        $sql10 = "SELECT * FROM value";
        $result10 = mysqli_query($conn, $sql10);
    
        if (mysqli_num_rows($result10) > 0){
                $row10 = mysqli_fetch_assoc($result10);
        }

}if (isset($_POST['codnear'])){
        include "../account/db_conn.php";

        if (isset($_POST['customerID']) && isset($_POST['customerName']) && isset($_POST['phonenum']) && isset($_POST['address']) && isset($_POST['email']) 
           && isset($_POST['codnearprice']) && isset($_POST['paymentcod']) && isset($_POST['paymentProofcod']) && isset($_POST['orderStatus']) && isset($_POST['rate'])){

                $customerID = validate($_POST['customerID']);
                $customerName = validate($_POST['customerName']);
                $phonenum = validate($_POST['phonenum']);
                $address = validate($_POST['address']);
                $email = validate($_POST['email']);
                $codprice = validate($_POST['codnearprice']);
                $paymentcod = validate($_POST['paymentcod']);
                $paymentProofcod = validate($_POST['paymentProofcod']);
                $orderStatus = validate($_POST['orderStatus']);
                $rate = validate($_POST['rate']);

                $user_data = 'customerID='. $customerID. 'customerName='. $customerName. 'phonenum='. $phonenum. 'address='. $address. 'email='. $email. 
                                'codprice='. $codprice. 'paymentcod='. $paymentcod. 'paymentProofcod='. $paymentProofcod. 'orderStatus='. $orderStatus. 'rate='. $rate;
                
                $sql3 = "INSERT INTO orders (customerID, customerName, phonenum, address, email,
                                        price, paymentMethod, paymentProof, orderStatus)
                        VALUES('$customerID', '$customerName', '$phonenum', '$address', '$email', 
                                '$codprice', '$paymentcod', '$paymentProofcod', '$orderStatus')";
                $result3 = mysqli_query($conn, $sql3);
                
                if ($result3){
                        echo $user_data;
                }else {
                        header("Location: checkout-page.php?customerID=$customerID");
                        exit();
                }
                
                $sql4 = "SELECT * FROM orders WHERE customerID = $customerID ORDER BY orderID DESC LIMIT 0,1";
                $result4 = mysqli_query($conn, $sql4);

                if (mysqli_num_rows($result4) > 0){
                        $row4 = mysqli_fetch_assoc($result4);
                        echo 'order ID: ';
                        echo $row4['orderID'];
                        echo '<br>';
                }else{
                        header("Location: checkout-page.php?customerID=$customerID");
                        exit();
                }
                
                $orderID=$row4['orderID'];

                print_r($_POST['cod']);
                foreach ($_POST['colorID'] as $key => $value){                        
                                        
                        $cartID=$_POST['cartID'][$key];
                        $colorID=$_POST['colorID'][$key];
                        $productID=$_POST['productID'][$key];
                        $productName=$_POST['productName'][$key];
                        $colorName=$_POST['colorName'][$key];
                        $size=$_POST['size'][$key];
                        $price=$_POST['price'][$key];
                        $qty=$_POST['qty'][$key];

                        $sql5 = "INSERT INTO ordercontents(orderID, colorID, productID, productName, colorName, size, price, qty, rateprd)
                                VALUES('$orderID', '$colorID', '$productID', '$productName', '$colorName', '$size','$price', '$qty', '$rate')";
                        $result5 = mysqli_query($conn, $sql5);

                        $sql6 = "DELETE FROM cart WHERE cartID=$cartID";
                        $result6 = mysqli_query($conn, $sql6);
                }
                
                date_default_timezone_set("Asia/Manila");
                $date = date('m-d-Y h:ia');
                $notification = "Your Order (Order No $orderID) has successfully been placed. Pending items are still waiting to be confirmed, kindly wait for the confirmation of the seller";
                $sql7 = "INSERT INTO notif(customerID, orderID, notification, datetime, orderStatus)
                         VALUES('$customerID', '$orderID', '$notification', '$date', '$orderStatus')";
                $result7 =mysqli_query($conn, $sql7);

                if ($result7){
                        header("Location: order-view-page.php?orderID=$orderID&success=You have successfully placed an Order (Order ID: $orderID).");
                        exit();  
                }
                
        }
} else if(isset($_POST['codfar'])){
        include "../account/db_conn.php";

        if (isset($_POST['customerID']) && isset($_POST['customerName']) && isset($_POST['phonenum']) && isset($_POST['address']) && isset($_POST['email']) 
           && isset($_POST['codfarprice']) && isset($_POST['paymentcod']) && isset($_POST['paymentProofcod']) && isset($_POST['orderStatus']) && isset($_POST['rate'])){

                $customerID = validate($_POST['customerID']);
                $customerName = validate($_POST['customerName']);
                $phonenum = validate($_POST['phonenum']);
                $address = validate($_POST['address']);
                $email = validate($_POST['email']);
                $codprice = validate($_POST['codfarprice']);
                $paymentcod = validate($_POST['paymentcod']);
                $paymentProofcod = validate($_POST['paymentProofcod']);
                $orderStatus = validate($_POST['orderStatus']);
                $rate = validate($_POST['rate']);

                $user_data = 'customerID='. $customerID. 'customerName='. $customerName. 'phonenum='. $phonenum. 'address='. $address. 'email='. $email. 
                                'codprice='. $codprice. 'paymentcod='. $paymentcod. 'paymentProofcod='. $paymentProofcod. 'orderStatus='. $orderStatus. 'rate='. $rate;
                
                $sql3 = "INSERT INTO orders (customerID, customerName, phonenum, address, email,
                                        price, paymentMethod, paymentProof, orderStatus)
                        VALUES('$customerID', '$customerName', '$phonenum', '$address', '$email', 
                                '$codprice', '$paymentcod', '$paymentProofcod', '$orderStatus')";
                $result3 = mysqli_query($conn, $sql3);
                
                if ($result3){
                        echo $user_data;
                }else {
                        header("Location: checkout-page.php?customerID=$customerID");
                        exit();
                }
                
                $sql4 = "SELECT * FROM orders WHERE customerID = $customerID ORDER BY orderID DESC LIMIT 0,1";
                $result4 = mysqli_query($conn, $sql4);

                if (mysqli_num_rows($result4) > 0){
                        $row4 = mysqli_fetch_assoc($result4);
                        echo 'order ID: ';
                        echo $row4['orderID'];
                        echo '<br>';
                }else{
                        header("Location: checkout-page.php?customerID=$customerID");
                        exit();
                }
                
                $orderID=$row4['orderID'];

                print_r($_POST['cod']);
                foreach ($_POST['colorID'] as $key => $value){                        
                                        
                        $cartID=$_POST['cartID'][$key];
                        $colorID=$_POST['colorID'][$key];
                        $productID=$_POST['productID'][$key];
                        $productName=$_POST['productName'][$key];
                        $colorName=$_POST['colorName'][$key];
                        $size=$_POST['size'][$key];
                        $price=$_POST['price'][$key];
                        $qty=$_POST['qty'][$key];

                        $sql5 = "INSERT INTO ordercontents(orderID, colorID, productID, productName, colorName, size, price, qty, rateprd)
                                VALUES('$orderID', '$colorID', '$productID', '$productName', '$colorName', '$size','$price', '$qty', '$rate')";
                        $result5 = mysqli_query($conn, $sql5);

                        $sql6 = "DELETE FROM cart WHERE cartID=$cartID";
                        $result6 = mysqli_query($conn, $sql6);
                }
                
                date_default_timezone_set("Asia/Manila");
                $date = date('m-d-Y h:ia');
                $notification = "Your Order (Order No $orderID) has successfully been placed. Pending items are still waiting to be confirmed, kindly wait for the confirmation of the seller";
                $sql7 = "INSERT INTO notif(customerID, orderID, notification, datetime, orderStatus)
                         VALUES('$customerID', '$orderID', '$notification', '$date', '$orderStatus')";
                $result7 =mysqli_query($conn, $sql7);

                if ($result7){
                        header("Location: order-view-page.php?orderID=$orderID&success=You have successfully placed an Order (Order ID: $orderID).");
                        exit();  
                }
                
        }
}else if(isset($_POST['gcashnear'])){
        include "../account/db_conn.php";

        if (isset($_POST['customerID']) && isset($_POST['customerName']) && isset($_POST['phonenum']) && isset($_POST['address']) && isset($_POST['email']) 
           && isset($_POST['gcashnearprice']) && isset($_POST['paymentgcash']) && isset($_FILES['paymentProofgcash']) && isset($_POST['orderStatus']) && isset($_POST['rate'])){

                echo "<pre>";
                print_r($_FILES['paymentProofgcash']);
                echo "</pre>";

                $img_name = $_FILES['paymentProofgcash']['name'];
                $img_size = $_FILES['paymentProofgcash']['size'];
                $tmp_name = $_FILES['paymentProofgcash']['tmp_name'];
                $error = $_FILES['paymentProofgcash']['error'];

                $customerID = validate($_POST['customerID']);
                $customerName = validate($_POST['customerName']);
                $phonenum = validate($_POST['phonenum']);
                $address = validate($_POST['address']);
                $email = validate($_POST['email']);
                $gcashprice = validate($_POST['gcashnearprice']);
                $paymentgcash = validate($_POST['paymentgcash']);
                $orderStatus = validate($_POST['orderStatus']);
                $rate = validate($_POST['rate']);

                $user_data = 'customerID='. $customerID. 'customerName='. $customerName. 'phonenum='. $phonenum. 'address='. $address. 'email='. $email. 
                                'gcashprice='. $gcashprice. 'paymentgcash='. $paymentgcash. 'orderStatus='. $orderStatus. 'rate='. $rate; 
                if(empty($img_name)){
                        header("Location: checkout-page.php?customerID=$customerID&error=Please attached an proof of transaction for GCash Payment Method");
                        exit();
                }else if($error === 0){
                        if($img_size > 10485760){
                                header("Location: checkout-page.php?customerID=$customerID&error=Sorry your image size is too large. Must be 10MB or below");    
                            } else {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);
                        $allowed_exs = array("jpg", "jpeg", "png");
                        if(in_array($img_ex_lc, $allowed_exs)) {
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = '../admin/orders/gcashPaymentProof/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);

                                $sql3 = "INSERT INTO orders (customerID, customerName, phonenum, address, email,
                                price, paymentMethod, paymentProof, orderStatus)
                                VALUES('$customerID', '$customerName', '$phonenum', '$address', '$email', 
                                '$gcashprice', '$paymentgcash', '$new_img_name', '$orderStatus')";
                                $result3 = mysqli_query($conn, $sql3);

                                $sql4 = "SELECT * FROM orders WHERE customerID = $customerID ORDER BY orderID DESC LIMIT 0,1";
                                $result4 = mysqli_query($conn, $sql4);

                                if (mysqli_num_rows($result4) > 0){
                                        $row4 = mysqli_fetch_assoc($result4);
                                        echo 'order ID: ';
                                        echo $row4['orderID'];
                                        echo '<br>';
                                }else{
                                        header("Location: checkout-page.php?customerID=$customerID&error=Unknown error occured");
                                        exit();
                                }

                                $orderID=$row4['orderID'];

                                print_r($_POST['gcash']);
                                foreach ($_POST['colorID'] as $key => $value){                        
                                        
                                        $cartID=$_POST['cartID'][$key];
                                        $colorID=$_POST['colorID'][$key];
                                        $productID=$_POST['productID'][$key];
                                        $productName=$_POST['productName'][$key];
                                        $colorName=$_POST['colorName'][$key];
                                        $size=$_POST['size'][$key];
                                        $price=$_POST['price'][$key];
                                        $qty=$_POST['qty'][$key];

                                        $sql5 = "INSERT INTO ordercontents(orderID, colorID, productID, productName, colorName, size, price, qty, rateprd)
                                                VALUES('$orderID', '$colorID', '$productID', '$productName', '$colorName', '$size','$price', '$qty', '$rate')";
                                        $result5 = mysqli_query($conn, $sql5);

                                        $sql6 = "DELETE FROM cart WHERE cartID=$cartID";
                                        $result6 = mysqli_query($conn, $sql6);
                                }

                                date_default_timezone_set("Asia/Manila");
                                $date = date('m-d-Y h:ia');
                                $notification = "Your Order (Order No $orderID) has successfully been placed. Pending items are still waiting to be confirmed, kindly wait for the confirmation of the seller";
                                $sql7 = "INSERT INTO notif(customerID, orderID, notification, datetime, orderStatus)
                                         VALUES('$customerID', '$orderID', '$notification', '$date', '$orderStatus')";
                                $result7 =mysqli_query($conn, $sql7);

                                if ($result7){
                                        header("Location: order-view-page.php?orderID=$orderID&success=You have successfully placed an Order (Order ID: $orderID).");
                                        exit();  
                                }
                                
                        }else{
                                header("Location: checkout-page.php?customerID=$customerID&error=Please upload only image file types (.jpg, .jpeg, .png) for GCash Proof of Payment");    
                                exit();
                        }        
                }
                }
        }
}else if(isset($_POST['gcashfar'])){
        include "../account/db_conn.php";

        if (isset($_POST['customerID']) && isset($_POST['customerName']) && isset($_POST['phonenum']) && isset($_POST['address']) && isset($_POST['email']) 
           && isset($_POST['gcashfarprice']) && isset($_POST['paymentgcash']) && isset($_FILES['paymentProofgcash']) && isset($_POST['orderStatus']) && isset($_POST['rate'])){

                echo "<pre>";
                print_r($_FILES['paymentProofgcash']);
                echo "</pre>";

                $img_name = $_FILES['paymentProofgcash']['name'];
                $img_size = $_FILES['paymentProofgcash']['size'];
                $tmp_name = $_FILES['paymentProofgcash']['tmp_name'];
                $error = $_FILES['paymentProofgcash']['error'];

                $customerID = validate($_POST['customerID']);
                $customerName = validate($_POST['customerName']);
                $phonenum = validate($_POST['phonenum']);
                $address = validate($_POST['address']);
                $email = validate($_POST['email']);
                $gcashprice = validate($_POST['gcashfarprice']);
                $paymentgcash = validate($_POST['paymentgcash']);
                $orderStatus = validate($_POST['orderStatus']);
                $rate = validate($_POST['rate']);

                $user_data = 'customerID='. $customerID. 'customerName='. $customerName. 'phonenum='. $phonenum. 'address='. $address. 'email='. $email. 
                                'gcashprice='. $gcashprice. 'paymentgcash='. $paymentgcash. 'orderStatus='. $orderStatus. 'rate='. $rate; 
                if(empty($img_name)){
                        header("Location: checkout-page.php?customerID=$customerID&error=Please attached an proof of transaction for GCash Payment Method");
                        exit();
                }else if($error === 0){
                        if($img_size > 10485760){
                                header("Location: checkout-page.php?customerID=$customerID&error=Sorry your image size is too large. Must be 10MB or below");    
                            } else {
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);
                        $allowed_exs = array("jpg", "jpeg", "png");
                        if(in_array($img_ex_lc, $allowed_exs)) {
                                $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
                                $img_upload_path = '../admin/orders/gcashPaymentProof/'.$new_img_name;
                                move_uploaded_file($tmp_name, $img_upload_path);

                                $sql3 = "INSERT INTO orders (customerID, customerName, phonenum, address, email,
                                price, paymentMethod, paymentProof, orderStatus)
                                VALUES('$customerID', '$customerName', '$phonenum', '$address', '$email', 
                                '$gcashprice', '$paymentgcash', '$new_img_name', '$orderStatus')";
                                $result3 = mysqli_query($conn, $sql3);

                                $sql4 = "SELECT * FROM orders WHERE customerID = $customerID ORDER BY orderID DESC LIMIT 0,1";
                                $result4 = mysqli_query($conn, $sql4);

                                if (mysqli_num_rows($result4) > 0){
                                        $row4 = mysqli_fetch_assoc($result4);
                                        echo 'order ID: ';
                                        echo $row4['orderID'];
                                        echo '<br>';
                                }else{
                                        header("Location: checkout-page.php?customerID=$customerID&error=Unknown error occured");
                                        exit();
                                }

                                $orderID=$row4['orderID'];

                                print_r($_POST['gcash']);
                                foreach ($_POST['colorID'] as $key => $value){                        
                                        
                                        $cartID=$_POST['cartID'][$key];
                                        $colorID=$_POST['colorID'][$key];
                                        $productID=$_POST['productID'][$key];
                                        $productName=$_POST['productName'][$key];
                                        $colorName=$_POST['colorName'][$key];
                                        $size=$_POST['size'][$key];
                                        $price=$_POST['price'][$key];
                                        $qty=$_POST['qty'][$key];

                                        $sql5 = "INSERT INTO ordercontents(orderID, colorID, productID, productName, colorName, size, price, qty, rateprd)
                                                VALUES('$orderID', '$colorID', '$productID', '$productName', '$colorName', '$size','$price', '$qty', '$rate')";
                                        $result5 = mysqli_query($conn, $sql5);

                                        $sql6 = "DELETE FROM cart WHERE cartID=$cartID";
                                        $result6 = mysqli_query($conn, $sql6);
                                }

                                date_default_timezone_set("Asia/Manila");
                                $date = date('m-d-Y h:ia');
                                $notification = "Your Order (Order No $orderID) has successfully been placed.Pending items are still waiting to be confirmed, kindly wait for the confirmation of the seller";
                                $sql7 = "INSERT INTO notif(customerID, orderID, notification, datetime, orderStatus)
                                         VALUES('$customerID', '$orderID', '$notification', '$date', '$orderStatus')";
                                $result7 =mysqli_query($conn, $sql7);

                                if ($result7){
                                        header("Location: order-view-page.php?orderID=$orderID&success=You have successfully placed an Order (Order ID: $orderID).");
                                        exit();  
                                }
                                
                        }else{
                                header("Location: checkout-page.php?customerID=$customerID&error=Please upload only image file types (.jpg, .jpeg, .png) for GCash Proof of Payment");    
                                exit();
                        }        
                }
                }
        }
}
?>

