<?php
include '../../../../src/connection/connection.php';


if($_POST['type'] == "Input"){
    $sect = $_POST['section'];

    $query = "INSERT INTO tb_section (section_id, name) 
    values 
    ( NULL, '$sect')";
    $insert = mysqli_query($connect, $query); 
}elseif($_POST['type'] == "Edit"){
    $upd = $_POST['edit'];
    $id = $_POST['id'];

    $query = "UPDATE tb_section SET name='$upd' WHERE section_id=$id";
    $insert = mysqli_query($connect, $query); 
}elseif($_POST['type'] == "Delete"){
    $id = $_POST['id'];

    $query = "DELETE FROM tb_section WHERE section_id  = '$id'";
    $insert = mysqli_query($connect, $query);
}

header("location: ../tools-section.php?market=All%20Marketplace");    
