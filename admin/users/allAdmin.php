<?php

include "../db_conn.php";

$sql = "SELECT * FROM admin_users ORDER BY adminID ASC";
$result = mysqli_query($conn, $sql);