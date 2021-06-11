<?php
include('../../../src/connection/connection.php');

$param_id = $_POST['value'];

$query = "UPDATE tb_account SET role='Admin'
WHERE account_id='$param_id'"; 
$insert = mysqli_query($connect, $query); 

echo json_encode($output);
