<?php
include '../../../../src/connection/connection.php';
$name = $_POST['edit_name'];
$param_id = $_POST['param_id'];
$id = $_POST['id'];
$type = $_POST['type'];

mysqli_query($connect, "UPDATE tb_sub_category SET name = '$name' WHERE subcat_id='$param_id'");

    header("location: ../category-section.php?market=All%20Marketplace&type=".$type."&id=".$id);    
