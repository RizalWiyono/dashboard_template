<?php
include '../../../src/connection/connection.php';

$sql_check = mysqli_query($connect, "SELECT * FROM tb_account WHERE role = ''");
$count = mysqli_num_rows($sql_check);
    $output[] = [
        'count'  => $count,
    ];


echo json_encode($output);
