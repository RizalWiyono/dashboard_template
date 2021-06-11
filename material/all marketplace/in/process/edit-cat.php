<?php
include '../../../../src/connection/connection.php';
$name = $_POST['edit_name'];
$param_id = $_POST['param_id'];
$id = $_POST['id'];
$type = $_POST['type'];

mysqli_query($connect, "UPDATE tb_category SET name = '$name' WHERE category_id='$param_id'");

if($id == 0){
header("location: ../category-section.php?market=All%20Marketplace&type=".$type);    
}else{
    header("location: ../category-section.php?market=All%20Marketplace&type=".$type."&id=".$id);    
}
