<?php

include('../../../../src/connection/connection.php');

$year = $_POST['year'];
$month = $_POST['month'];
$id = $_POST["id"];

$query = "DELETE FROM tb_sales WHERE market_id='$id' && year='$year' && month='$month'";
mysqli_query($connect, $query);

$query = "DELETE FROM tb_type WHERE market_id='$id' && year='$year' && month='$month'";
mysqli_query($connect, $query);

header("location: ../reset.php?id=$id&&success=true");    
