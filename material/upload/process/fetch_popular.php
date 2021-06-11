<?php

$curl = curl_init();
include '../../../src/connection/connection.php';
session_start();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.envato.com/v1/market/popular:graphicriver.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Bearer 812DYeZSHAQkD7UQQeN0bVd3CPJKu87u',
    'Cookie: __cfduid=d65f81095fba0ac90acfd1b5812a1b0ba1609829873; __cf_bm=6520978f1a120f33e12ebea1cf370d42d536496d-1609829873-1800-AbvCr2+6TvK2x3PTU03sYZPRxMiEl/vv5G8Pjuu07lzMA3yyBo52hSKnRTm5d5jqfMj0e74jILD5vnJR+EdKlOo='
  ),
));

$response = curl_exec($curl);
$json_to_array  = json_decode($response, true);

curl_close($curl);
// echo "<pre>";
//     print_r($json_to_array);
// echo "</pre>";

date_default_timezone_set('Asia/Jakarta');
$day = date("d");
$month = date("m");
$year = date("Y");
$date = date("Y-m-d");
$date_ac = date("d M Y");
$hour = date("H:i:s", strtotime('now +24 hours'));
$user = $_SESSION['email'];

mysqli_query($connect, "INSERT INTO tb_activity_template (activity_id, username, activity, date, hours) 
values 
(null, '$user', 'Upload File - DT-POPULAR','$date_ac','$hour')");

foreach ($json_to_array["popular"]["items_last_week"] as $result) {
$param = $result['category'];
$param_item = substr("$param",23, 10);;
    if($param_item == 'powerpoint'){
        $item_id = $result['id'];
        $name = $result['item'];
        $author = $result['user'];
        $sales = $result['sales'];

        $sql_value_exist = mysqli_query($connect, "SELECT * FROM tb_popular WHERE item_id=$item_id && date='$date'");
            if(mysqli_num_rows($sql_value_exist) < 1){
                mysqli_query($connect, "INSERT INTO tb_popular (popular_id , item_id, name, author, category, sales, day, month, year, date) 
                VALUES 
                (NULL , '$item_id', '$name', '$author', 'PowerPoint', '$sales' , '$day', '$month', '$year', '$date')");
            }
    }
}

header("location: ../upload.php?upload=success");    
