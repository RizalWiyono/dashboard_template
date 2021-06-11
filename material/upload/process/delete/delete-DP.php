<?php
session_start();

include('../../../../src/connection/connection.php');

$query = "DELETE FROM tb_popular";
mysqli_query($connect, $query);


$user = $_SESSION['username'];
date_default_timezone_set('Asia/Jakarta');
$date_ac= date("d/m/Y");
$hour= date("H:i:s", strtotime('now +24 hours'));

$query = "INSERT INTO tb_activity_template (activity_id, username, activity, date, hours) 
            values 
            (null, '$user', 'Reset All - DT-POPULAR','$date_ac','$hour')";
            mysqli_query($connect, $query);

header("location: ../../upload.php?market=All%20Marketplace&&success=true");    
