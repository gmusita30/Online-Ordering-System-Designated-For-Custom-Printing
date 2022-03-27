<?php
include "../db_conn.php";

if (isset($_SESSION['adminID']) && isset($_SESSION['userName'])){

$sql = "SELECT * FROM marketreqs ORDER BY reqID ASC";
$result = mysqli_query($conn, $sql);

}else{
    header("Location: ../login.php");
    exit();
}
?>