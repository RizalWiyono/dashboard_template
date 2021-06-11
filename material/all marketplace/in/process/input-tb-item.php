<?php

include('../../../../src/connection/connection.php');


$color = $_POST['color'];
$type = $_POST['type'];
$sub_category = $_POST['sub_category'];
$category = $_POST['category'];
$id = $_POST['id'];


$query = "UPDATE tb_catalog SET category='$category', color='$color', sub_category='$sub_category', slug='$type' WHERE item_id='$id'";
$insert = mysqli_query($connect, $query); 

header("location: ../item-update.php?type=All&market=All%20Marketplace");    
