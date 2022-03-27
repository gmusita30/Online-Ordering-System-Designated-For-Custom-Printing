<?php

include "../db_conn.php";

$sql = "SELECT * FROM customer_users ORDER BY customerID ASC";
$result = mysqli_query($conn, $sql);