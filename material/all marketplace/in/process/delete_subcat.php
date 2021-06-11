<?php
include '../../../../src/connection/connection.php';
$param_id = $_POST['param_id'];
$id = $_POST['id'];
$type = $_POST['type'];

mysqli_query($connect, "DELETE FROM tb_sub_category WHERE subcat_id='$param_id' && category_id='$id'");

    header("location: ../category-section.php?market=All%20Marketplace&type=".$type."&id=".$id);    
