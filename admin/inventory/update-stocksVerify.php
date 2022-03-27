<?php
session_start();
include_once 'db_conn.php';

    if (isset($_POST['update'])) {
        if (isset($_POST['pName']) || isset($_POST['description'])
            || isset($_POST['productImage'])) {
            $id = $_POST['id'];
            $pName = $_POST['pName'];
            // $stocks = $_POST['stocks'];
            // $price = $_POST['price'];
            $description = $_POST['description'];
            $productImageReal = $_FILES['productImage']['name'];
            $productImageTemp = $_FILES['productImage']['tmp_name'];

            if ($productImageTemp != ""){
                move_uploaded_file($productImageTemp, "Images/$productImageReal"); 
                $sql2 = "UPDATE product SET productName = '$pName', 
                description = '$description', productImage = '$productImageReal' WHERE productID = '$id'";
                $result1 = mysqli_query($conn, $sql2);
                if ($result1){
                        header("Location: all-products.php?id=$id&success=You have successfully updated the product");
                        exit();
                }else {
                    header("Location: all-products.php?id=$id&error=Unkwown error occured. Please try again");
                    exit();
                    }

            }else{ 
                move_uploaded_file($productImageTemp, "Images/$productImageReal");
                $sql2 = "UPDATE product SET productName = '$pName', 
                description = '$description', productImage = '$productImageReal' WHERE productID = '$id'";
                mysqli_query($conn, $sql2);
            }
        }

    }else if (isset($_POST['updateVar'])) {
        $id = $_POST['id'];
        header("Location: update-VarStocks.php?id=$id");
    }else if (isset($_POST['removeVar'])){
        $id = $_POST['id'];
        header("Location: remove-VarStocks.php?id=$id");
    }
    // else if (isset($_POST['back'])){
    //     $id = $_POST['id'];
    //     // header("Location: view-product.php?id=$id");
    //     //exit();
    //     header("Location: all-products.php?id=$id");
    // }
    else {
        header("Location: update-stocks.php");
        exit();
    }
            ?>

<?php
// session_start();
//   include "db_conn.php";

// if (isset($_POST['update'])) {
//     // if (isset($_GET['id'])) {
//         if (isset($_POST['pName']) || isset($_POST['stocks']) || isset($_POST['price']) || isset($_POST['description'])) {
//         $id = $_GET['id'];
//         $pName = $_POST['pName'];
//         $stocks = $_POST['stocks'];
//         $price = $_POST['price'];
//         $description = $_POST['description'];

//             // $sql = "SELECT * FROM product WHERE productID = $id";
//             // $result = mysqli_query($conn, $sql);

//             // if ($result){
//             //     $sql2 = "UPDATE product SET productName = '$pName', stocks = '$stocks', price = '$price',
//             //     'description' = '$description' WHERE productID = '$id' ";
//             //     $result1 = mysqli_query($conn, $sql2);
//             //     if ($result1){  
//             //         header("Location: update-stocks.php?success=You have successfully updated the product");
//             //         exit();
//             //     }else {
//             //         header("Location: update-stocks.php?error=Unkwown error occured. Please try again");
//             //         exit();
//             //     }
//             // }
        
//                 // $sql2 = "UPDATE 'product' SET productName = '$pName', stocks = '$stocks', price = '$price',
//                 // description = '$description' WHERE productID = '$id' ";
//                 // $result = mysqli_query($conn, $sql2);
//                 // $resultCheck = mysqli_fetch_array($result);
//                 // if ($result){
//                     $sql2 = "UPDATE product SET productName = '$pName', stocks = '$stocks', price = '$price',
//                     description = '$description' WHERE productID = '$id' ";
//                     $result1 = mysqli_query($conn, $sql2);
//                     $resultCheck = mysqli_fetch_array($result1);
                    
//                     if ($result1){
//                         header("Location: update-stocks.php?success=You have successfully updated the product");
//                         exit();
//                     }
//                 // }
//                 else {
//                     header("Location: update-stocks.php?error=Unkwown error occured. Please try again");
//                     exit();
//                 }
//                 // while ($resultCheck = mysqli_fetch_array($result) && $result1){
//                 //     header("Location: update-stocks.php?success=You have successfully updated the product");
//                 //     exit();
//                 //  }//else {
//                 // //     header("Location: update-stocks.php?error=Unkwown error occured. Please try again");
//                 // //     exit();
//                 // // }
//          }
//     // }
// }
// else if(isset($_POST['back'])) {
//     // if (isset($_GET['id']) && isset($_SESSION['adminID'])){
//     //         // $id = $_GET['id'];
//     //         // $sql = "SELECT * FROM product WHERE productID = $id";
//     //         // $result = mysqli_query($conn, $sql);
//     //         // $resultCheck = mysqli_fetch_array($result);

//     //         // echo $resultCheck['productID'];
//     //         // echo $resultCheck['productName'];
//     //         // echo $resultCheck['rate'];
//     //         // echo $resultCheck['description'];
//     //         // echo $resultCheck['stocks'];
//     //         // echo $resultCheck['price'];
//     //         mysqli_close($conn);
//     //         header("Location: view-product.php?id=$id");
//     //         exit();
//     // }
//     mysqli_close($conn);
//     header("Location: all-products.php");
//     // $id = $_GET['id'];
//     // header("Location: view-product.php?id=$id");
//     exit(); 
// }
// else{
//     header("Location: update-stocks.php");
//     exit();
// }
?>
