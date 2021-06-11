<?php
session_start();

include('../../../../src/connection/connection.php');

$query = "DELETE FROM tb_sales WHERE market_id='3'";
mysqli_query($connect, $query);

$query = "DELETE FROM tb_type WHERE market_id='3'";
mysqli_query($connect, $query);

$user = $_SESSION['username'];
date_default_timezone_set('Asia/Jakarta');
$date_ac= date("d/m/Y");
$hour= date("H:i:s", strtotime('now +24 hours'));

$query = "INSERT INTO tb_activity (id, name, activity, date, hours) 
            values 
            (null, '$user', 'Reset All - TM','$date_ac','$hour')";
            mysqli_query($connect, $query);

header("location: ../reset.php?id=$id&&success=true");    
