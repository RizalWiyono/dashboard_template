<?php
include '../../../../src/connection/connection.php';
error_reporting(0);
$type = $_POST['type'];
if(isset($_POST['cat'])){
$cat = $_POST['cat'];
    if($cat !== ''){
        $query = "INSERT INTO tb_category (category_id, name) 
        values 
        ( NULL, '$cat')";
        $insert = mysqli_query($connect, $query); 
    }else{

    }
}else{
    $sub = $_POST['sub'];
    $id = $_POST['id'];
    
    if($sub !== ''){
        $query = "INSERT INTO tb_sub_category (subcat_id, category_id, name) 
        values 
        ( NULL, $id, '$sub')";
        $insert = mysqli_query($connect, $query);
    }else{
        
    }
    
}
header("location: ../category-section.php?market=All%20Marketplace&type=".$type."&id=".$id);    
