<?php

include '../../../../src/connection/connection.php';
// error_reporting(0);

$param_id = $_POST['param_id'];
$type = $_POST['type'];

$queryy = "DELETE FROM tb_category WHERE category_id  = '$param_id'";
$insert = mysqli_query($connect, $queryy);

$query = "DELETE FROM tb_sub_category WHERE category_id  = '$param_id'";
$insert = mysqli_query($connect, $query);

header("location: ../category-section.php?market=All%20Marketplace&type=".$type."&id=".$param_id);    
