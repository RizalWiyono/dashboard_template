<?php
session_start();

include('../../../../src/connection/connection.php');

$query = "DELETE FROM tb_freebies WHERE market_id='5'";
mysqli_query($connect, $query);

$query = "DELETE FROM tb_sub_freebies WHERE market_id='5'";
mysqli_query($connect, $query);

$user = $_SESSION['username'];
date_default_timezone_set('Asia/Jakarta');
$date_ac= date("d/m/Y");
$hour= date("H:i:s", strtotime('now +24 hours'));

$query = "INSERT INTO tb_activity (id, name, activity, date, hours) 
            values 
            (null, '$user', 'Reset All - FrB','$date_ac','$hour')";
            mysqli_query($connect, $query);

header("location: ../reset.php?id=$id&&success=true");    
