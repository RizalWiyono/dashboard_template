<?php
//fetch.php
$connect = mysqli_connect("localhost", "root", "", "db_rrgraph");

$query = "SELECT * FROM tb_catalog WHERE item_id='".$_POST["employee_id"]."' LIMIT 10";
$result = mysqli_query($connect, $query);
$row = mysqli_fetch_array($result);  
echo json_encode($row);  
?>