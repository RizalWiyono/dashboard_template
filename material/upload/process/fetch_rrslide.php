<?php
include '../../../src/connection/connection.php';
ini_set("max_execution_time",0);
error_reporting(0);
session_start();
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://rrslide.com/edd-api/sales/?key=e31633ef7ffa83bffd8476d3ce0ef874&token=e4919f890c37b6427b03f38835876195&number=-1',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: __cfduid=d2d12ee33a4b90a8615baca0ea6b6e3691606962572'
  ),
));

$query = "SELECT date FROM `tb_sales` WHERE market_id=5 GROUP BY date DESC LIMIT 1";
$result = mysqli_query($connect, $query);
while($row =mysqli_fetch_array($result)) {

    $s_date      = substr($row['date'], 0, 8);

    $s_day       = (int)substr($row['date'], 8, 2);
    $sum_day     = $s_day - 1;

}

if(isset($s_date)){
    if($sum_day  < 10)
    {
        $dates = $s_date . "0" . $sum_day;
    }elseif($sum_day >= 10)
    {
        $dates = $s_date . $sum_day;
    }
}

$user = $_SESSION['email'];
date_default_timezone_set('Asia/Jakarta');
$date_ac= date("d M Y");
$hour= date("H:i:s", strtotime('now +24 hours'));

$query = "INSERT INTO tb_activity_template (activity_id, username, activity, date, hours) 
            values 
            (null, '$user', 'Upload File - RRS','$date_ac','$hour')";
            mysqli_query($connect, $query);

$query = "INSERT INTO tb_activity_template (activity_id, username, activity, date, hours) 
            values 
            (null, '$user', 'Upload File - FrB','$date_ac','$hour')";
            mysqli_query($connect, $query);

$response = curl_exec($curl);
$result  = json_decode($response, true);

curl_close($curl);
// echo "<pre>";
//         print_r($results_per_page);
// echo "</pre>";

foreach ($result["sales"] as $item) {
    $date_range  = $item["date"];
    $price = (float)$item["products"]["0"]["price"];
    $order_id = $item["ID"];
    $type = $item["key"];
    $detail = $item["products"]["0"]["name"];
    $item_id = $item["products"]["0"]["id"];
    $earnings = $item["products"]["0"]["price"];

    $date_y = substr($date_range, 0, 10);
    $month = substr($date_y, 5, 2);
    $year  = substr($date_y, 0, 4);
    $day   = substr($date_y, 8, 2);
    
    // if(isset($dates)){

    //     if($date_range >= $dates){

    //         if($price == 0.00){

    //             $sql_value_exist = mysqli_query($connect, "SELECT * FROM tb_freebies WHERE market_id=5 && order_id='$order_id'");
    //             if(mysqli_num_rows($sql_value_exist) < 1)
    //             {
                
    //                 $sql_insert = mysqli_query($connect, "INSERT INTO tb_freebies(freebies_id, market_id, item_id, order_id, year, month, day, date, status, earnings, country, extra) 
    //                 VALUES 
    //                 (NULL, 5, '$item_id', '$order_id', '$year', '$month', '$day', '$date_y', 'Sale', '$earnings', '', '')");
    //             }

    //         }else{

    //             $sql_value_exist = mysqli_query($connect, "SELECT * FROM tb_sales WHERE market_id=5 && order_id='$order_id'");
    //             if(mysqli_num_rows($sql_value_exist) < 1)
    //             {
                
    //                 $sql_insert = mysqli_query($connect, "INSERT INTO tb_sales(sales_id, market_id, item_id, order_id, year, month, day, date, status, earnings, country, extra) 
    //                 VALUES 
    //                 (NULL, 5, '$item_id', '$order_id', '$year', '$month', '$day', '$date_y', 'Sale', '$earnings', '', '')");
    //             }

    //         }

    //     }else{}
    // }else{

        if($price == 0.00){

            $sql_value_exist = mysqli_query($connect, "SELECT * FROM tb_freebies WHERE market_id=5 && order_id='$order_id'");
            if(mysqli_num_rows($sql_value_exist) < 1)
            {
            
                $sql_insert = mysqli_query($connect, "INSERT INTO tb_freebies(freebies_id, market_id, item_id, order_id, year, month, day, date, status, earnings, country, extra) 
                VALUES 
                (NULL, 5, '$item_id', '$order_id', '$year', '$month', '$day', '$date_y', 'Sale', '$earnings', '', '')");
            }

        }else{

            $sql_value_exist = mysqli_query($connect, "SELECT * FROM tb_sales WHERE market_id=5 && order_id='$order_id'");
            if(mysqli_num_rows($sql_value_exist) < 1)
            {
            
                $sql_insert = mysqli_query($connect, "INSERT INTO tb_sales(sales_id, market_id, item_id, order_id, year, month, day, date, status, earnings, country, extra) 
                VALUES 
                (NULL, 5, '$item_id', '$order_id', '$year', '$month', '$day', '$date_y', 'Sale', '$earnings', '', '')");
            }

        }

    // }
    
    
    
}

$curl_upd = curl_init();

curl_setopt_array($curl_upd, array(
  CURLOPT_URL => 'http://rrslide.com/edd-api/products/?key=e31633ef7ffa83bffd8476d3ce0ef874&token=e4919f890c37b6427b03f38835876195&number=-1',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: __cfduid=d2d12ee33a4b90a8615baca0ea6b6e3691606962572'
  ),
));

$response_upd = curl_exec($curl_upd);
$result_upd  = json_decode($response_upd, true);

curl_close($curl_upd);

foreach ($result_upd["products"] as $value) {

    $slug = $value["info"]["category"]["0"]["slug"] ;
    $date_c = $value["info"]['create_date'];
    $date_cd = substr($date_c, 0, 10);

    $date_m = $value["info"]['modified_date'];
    $date_md = substr($date_m, 0, 10);

    $item_id = $value["info"]['id'];
    $detail = $value["info"]['title'];

    if($slug !== 'freebies'){

        if($date_md !== $date_cd){
            $sql_insert = mysqli_query($connect, "INSERT INTO tb_update (update_id, item_id, market_id, date) 
            VALUES 
            (NULL, '$item_id', 5, '$date_md')");
        }

        $sql_value_exist = mysqli_query($connect, "SELECT * FROM tb_catalog WHERE market_id=5 && date='$date_y' AND item_id='$item_id'");
        
        if(mysqli_num_rows($sql_value_exist) < 1)
        {
            $sql_insert_type = mysqli_query($connect, "INSERT INTO tb_catalog (catalog_id , item_id, market_id, upload_on, category, sub_category, color, slug, name) 
            VALUES 
            (NULL, '$item_id', 5, '$date_cd', '', '' , '' , '', '$detail')");

            $sql_update_ty = mysqli_query($connect, "UPDATE tb_catalog SET name = REPLACE(name, '(Regular License)', '') WHERE market_id=5");
        }

    }else{

        if($date_md !== $date_cd){
            $sql_insert = mysqli_query($connect, "INSERT INTO tb_update_fb (modifedfb_id, item_id, market_id, date) 
            VALUES 
            (NULL, '$item_id', 5, '$date_md')");
        }

        $sql_value_exist = mysqli_query($connect, "SELECT * FROM tb_catalog_fb WHERE market_id=5 && date='$date_y' AND item_id='$item_id'");
            
        if(mysqli_num_rows($sql_value_exist) < 1)
        {
            $sql_insert_type = mysqli_query($connect, "INSERT INTO tb_catalog_fb (catalogfb_id , item_id, market_id, upload_on, category, sub_category, color, slug, name) 
            VALUES 
            (NULL, '$item_id', 5, '$date_cd', '', '' , '' , '', '$detail')");

            $sql_update_ty = mysqli_query($connect, "UPDATE tb_catalog_fb SET name = REPLACE(name, '(Regular License)', '') WHERE market_id=5");
        }

    }
    
}

header("location: ../upload.php?upload=success");    
