<?php
session_start();

error_reporting(0);
include '../../../src/connection/connection.php';
define('APIKEY', '98ZcnqnHC5Y6dDAOW0y6VmS8hyEcxsUR');

include '../../../src/connection/connection.php';
    $query = "SELECT date FROM `tb_sales` WHERE market_id=2 GROUP BY date DESC LIMIT 1";
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


    if($dates !== null){
      $url_all  = 'https://api.envato.com/v3/market/user/statement?from_date='.$dates.'&type=Sale';
    }else{
      $url_all  = 'https://api.envato.com/v3/market/user/statement?type=Sale';
    }


function fetch_api($apiKey, $apiUrl){
  $curl  = curl_init();
  curl_setopt_array($curl, array(
      CURLOPT_URL => $apiUrl,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => [
        "Authorization: Bearer ".$apiKey
      ],
  ));

  $response = curl_exec($curl);
  return $response;
  curl_close($curl);
}

$response       = fetch_api(APIKEY, $url_all);
$json_to_array  = json_decode($response, true);
$num_page       = (int)$json_to_array['pagination']["pages"];

// echo "<pre>";
//   print_r($json_to_array);
//   echo "</pre>";

$user = $_SESSION['email'];
date_default_timezone_set('Asia/Jakarta');
$date_ac= date("d M Y");
$hour= date("H:i:s", strtotime('now +24 hours'));

$query = "INSERT INTO tb_activity_template (activity_id, username, activity, date, hours) 
values 
(null, '$user', 'Upload File - GR-RRG','$date_ac','$hour')";
mysqli_query($connect, $query);

if($dates !== null){
  if($num_page !== 0){
  $i=1;

    while ($i <= $num_page) {

      $url_per_page = 'https://api.envato.com/v3/market/user/statement?from_date='.$dates.'&page='.$i.'&type=Sale';
      $response_per_page = fetch_api(APIKEY, $url_per_page);
      $results_per_page  = json_decode($response_per_page, true);

      foreach ($results_per_page["results"] as $item) {
        $dateTime = explode(' ', $item['date']);
        $date     = explode('-', $dateTime[0]);
        $date_1   = $date[0] .'-'. $date[1] .'-'. $date[2];
        // $date_2   = $date[0] .'/'. $date[1] .'/'. $date[2];
        $year 	  = $date[0];
        $month	  = $date[1];
        $day	    = $date[2];
        $order_id = $item['order_id'];
        $type     = $item['type'];
        $detail   = $item['detail'];
        $item_id  = $item['item_id'];
        $earnings = $item['amount'];
        $extra = $item['document'];
        $county   = $item['other_party_country'];

        $sql_value_exist = mysqli_query($connect, "SELECT * FROM tb_sales WHERE market_id=2 && extra='$extra'");
        if(mysqli_num_rows($sql_value_exist) < 1){
          $sql_insert = mysqli_query($connect, "INSERT INTO tb_sales(sales_id, market_id, item_id, order_id, year, month, day, date, status, earnings, country, extra) 
          VALUES 
          (NULL, 2, '$item_id', '$order_id', '$year', '$month', '$day', '$date_1', '$type', '$earnings', '$county', '$extra')");

          $sql_insert_type = mysqli_query($connect, "INSERT INTO tb_catalog (catalog_id , item_id, market_id, upload_on, category, sub_category, color, slug, name) 
          VALUES 
          (NULL , '$item_id', 2, '$date_1', '', '' , '', '', '$detail')");

          mysqli_query($connect, "UPDATE tb_catalog SET name = REPLACE(name, '(Regular License)', '')");
          mysqli_query($connect, "UPDATE tb_catalog SET slug = 'PowerPoint' WHERE name LIKE '%powerpoint%'");
          mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Keynote' WHERE name LIKE '%keynote%'");
          mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Potrait' WHERE name LIKE '%potrait%'");
          mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Google Slide' WHERE name LIKE '%google slide%'");
          mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Etc' WHERE slug=''");

          
        }
      }


      // echo "<pre>";
      //   print_r($results_per_page);
      // echo "</pre>";
      $i++;
    }
  }else{
      $url_per_page = 'https://api.envato.com/v3/market/user/statement?from_date='.$dates.'&type=Sale';
      $response_per_page = fetch_api(APIKEY, $url_per_page);
      $results_per_page  = json_decode($response_per_page, true);

      foreach ($results_per_page["results"] as $item) {
        $dateTime = explode(' ', $item['date']);
        $date     = explode('-', $dateTime[0]);
        $date_1   = $date[0] .'-'. $date[1] .'-'. $date[2];
        // $date_2   = $date[0] .'/'. $date[1] .'/'. $date[2];
        $year 	  = $date[0];
        $month	  = $date[1];
        $day	    = $date[2];
        $order_id = $item['order_id'];
        $type     = $item['type'];
        $detail   = $item['detail'];
        $item_id  = $item['item_id'];
        $earnings = $item['amount'];
        $extra = $item['document'];
        $county   = $item['other_party_country'];

        $sql_value_exist = mysqli_query($connect, "SELECT * FROM tb_sales WHERE market_id=2 && extra='$extra'");
        if(mysqli_num_rows($sql_value_exist) < 1){
          $sql_insert = mysqli_query($connect, "INSERT INTO tb_sales(sales_id, market_id, item_id, order_id, year, month, day, date, status, earnings, country, extra) 
          VALUES 
          (NULL, 2, '$item_id', '$order_id', '$year', '$month', '$day', '$date_1', '$type', '$earnings', '$county', '$extra')");

          $sql_insert_type = mysqli_query($connect, "INSERT INTO tb_catalog (catalog_id , item_id, market_id, upload_on, category, sub_category, color, slug, name) 
          VALUES 
          (NULL , '$item_id', 2, '$date_1', '', '' , '', '', '$detail')");

          mysqli_query($connect, "UPDATE tb_catalog SET name = REPLACE(name, '(Regular License)', '')");
          mysqli_query($connect, "UPDATE tb_catalog SET slug = 'PowerPoint' WHERE name LIKE '%powerpoint%'");
          mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Keynote' WHERE name LIKE '%keynote%'");
          mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Potrait' WHERE name LIKE '%potrait%'");
          mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Google Slide' WHERE name LIKE '%google slide%'");
          mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Etc' WHERE slug=''");

          
        }
      }

      // echo "<pre>";
      // print_r( $results_per_page);
      // echo "</pre>";
  }

}else{
  if($num_page !== 0){
    $i=1;
  
      while ($i <= $num_page) {
  
        $url_per_page = 'https://api.envato.com/v3/market/user/statement?&page='.$i.'&type=Sale';
        $response_per_page = fetch_api(APIKEY, $url_per_page);
        $results_per_page  = json_decode($response_per_page, true);
  
        foreach ($results_per_page["results"] as $item) {
          $dateTime = explode(' ', $item['date']);
          $date     = explode('-', $dateTime[0]);
          $date_1   = $date[0] .'-'. $date[1] .'-'. $date[2];
          // $date_2   = $date[0] .'/'. $date[1] .'/'. $date[2];
          $year 	  = $date[0];
          $month	  = $date[1];
          $day	    = $date[2];
          $order_id = $item['order_id'];
          $type     = $item['type'];
          $detail   = $item['detail'];
          $item_id  = $item['item_id'];
          $earnings = $item['amount'];
          $extra = $item['document'];
          $county   = $item['other_party_country'];
  
          $sql_value_exist = mysqli_query($connect, "SELECT * FROM tb_sales WHERE market_id=2 && extra='$extra'");
          if(mysqli_num_rows($sql_value_exist) < 1){
            $sql_insert = mysqli_query($connect, "INSERT INTO tb_sales(sales_id, market_id, item_id, order_id, year, month, day, date, status, earnings, country, extra) 
            VALUES 
            (NULL, 2, '$item_id', '$order_id', '$year', '$month', '$day', '$date_1', '$type', '$earnings', '$county', '$extra')");

            $sql_insert_type = mysqli_query($connect, "INSERT INTO tb_catalog (catalog_id , item_id, market_id, upload_on, category, sub_category, color, slug, name) 
            VALUES 
            (NULL , '$item_id', 2, '$date_1', '', '' , '', '', '$detail')");

            mysqli_query($connect, "UPDATE tb_catalog SET name = REPLACE(name, '(Regular License)', '')");
            mysqli_query($connect, "UPDATE tb_catalog SET slug = 'PowerPoint' WHERE name LIKE '%powerpoint%'");
            mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Keynote' WHERE name LIKE '%keynote%'");
            mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Potrait' WHERE name LIKE '%potrait%'");
            mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Google Slide' WHERE name LIKE '%google slide%'");
            mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Etc' WHERE slug=''");

            
          }
        }

        // echo "<pre>";
        // print_r( $results_per_page);
        // echo "</pre>";
        $i++;
      }
    }else{
        $url_per_page = 'https://api.envato.com/v3/market/user/statement?type=Sale';
        $response_per_page = fetch_api(APIKEY, $url_per_page);
        $results_per_page  = json_decode($response_per_page, true);
  
        foreach ($results_per_page["results"] as $item) {
          $dateTime = explode(' ', $item['date']);
          $date     = explode('-', $dateTime[0]);
          $date_1   = $date[0] .'-'. $date[1] .'-'. $date[2];
          // $date_2   = $date[0] .'/'. $date[1] .'/'. $date[2];
          $year 	  = $date[0];
          $month	  = $date[1];
          $day	    = $date[2];
          $order_id = $item['order_id'];
          $type     = $item['type'];
          $detail   = $item['detail'];
          $item_id  = $item['item_id'];
          $earnings = $item['amount'];
          $extra = $item['document'];
          $county   = $item['other_party_country'];
  
          $sql_value_exist = mysqli_query($connect, "SELECT * FROM tb_sales WHERE market_id=2 && extra='$extra'");
          if(mysqli_num_rows($sql_value_exist) < 1){
            $sql_insert = mysqli_query($connect, "INSERT INTO tb_sales(sales_id, market_id, item_id, order_id, year, month, day, date, status, earnings, country, extra) 
            VALUES 
            (NULL, 2, '$item_id', '$order_id', '$year', '$month', '$day', '$date_1', '$type', '$earnings', '$county', '$extra')");

            $sql_insert_type = mysqli_query($connect, "INSERT INTO tb_catalog (catalog_id , item_id, market_id, upload_on, category, sub_category, color, slug, name) 
            VALUES 
            (NULL , '$item_id', 2, '$date_1', '', '' , '', '', '$detail')");

            mysqli_query($connect, "UPDATE tb_catalog SET name = REPLACE(name, '(Regular License)', '')");
            mysqli_query($connect, "UPDATE tb_catalog SET slug = 'PowerPoint' WHERE name LIKE '%powerpoint%'");
            mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Keynote' WHERE name LIKE '%keynote%'");
            mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Potrait' WHERE name LIKE '%potrait%'");
            mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Google Slide' WHERE name LIKE '%google slide%'");
            mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Etc' WHERE slug=''");

            
          }
        }

        // echo "<pre>";
        // print_r( $results_per_page);
        // echo "</pre>";
    }
}

  
$url_per_page_author = 'https://api.envato.com/v3/market/user/statement?type=Author%20Fee%20Reversal';
$response_per_page_author = fetch_api(APIKEY, $url_per_page_author);
$results_per_page_author  = json_decode($response_per_page_author, true);

foreach ($results_per_page_author["results"] as $item) {
  $dateTime = explode(' ', $item['date']);
  $date     = explode('-', $dateTime[0]);
  $date_1   = $date[0] .'-'. $date[1] .'-'. $date[2];
  // $date_2   = $date[0] .'/'. $date[1] .'/'. $date[2];
  $year 	  = $date[0];
  $month	  = $date[1];
  $day	    = $date[2];
  $order_id = $item['order_id'];
  $type     = $item['type'];
  $detail   = $item['detail'];
  $item_id  = $item['item_id'];
  $extra = $item['document'];
  $earnings = $item['amount'];
  $county   = $item['other_party_country'];

  $reversal = strstr("$detail","IVI");
  mysqli_query($connect, "DELETE FROM `tb_sales` WHERE market_id=2 && extra='$reversal'");

}
// echo "<pre>";
// print_r( $results_per_page_author);
// echo "</pre>";
    

$url_upd  = 'https://api.envato.com/v1/market/new-files-from-user:brandearth,graphicriver.json';
$response_upd = fetch_api(APIKEY, $url_upd);
$results_upd  = json_decode($response_upd, true);

foreach ($results_upd["new-files-from-user"] as $item) {
  $item_id  = $item['id'];
  $date_md = date("Y-m-d", strtotime($item['uploaded_on']));
  $date_cd = date("Y-m-d", strtotime($item['last_update']));
  $detail = $item["item"];

  if($date_md !== $date_cd){
    $sql_insert = mysqli_query($connect, "INSERT INTO tb_update (update_id, item_id, market_id, date) 
    VALUES 
    (NULL, '$item_id', 2, '$date_md')");
  }

  $sql_value_exist = mysqli_query($connect, "SELECT * FROM tb_catalog WHERE market_id=1 && item_id='$item_id'");
                  
  if(mysqli_num_rows($sql_value_exist) < 1)
  {
      $sql_insert_type = mysqli_query($connect, "INSERT INTO tb_catalog (catalog_id , item_id, market_id, upload_on, category, sub_category, color, slug, name) 
      VALUES 
      (NULL, '$item_id', 2, '$date_cd', '', '' , '' , '', '$detail')");

      mysqli_query($connect, "UPDATE tb_catalog SET name = REPLACE(name, '(Regular License)', '') WHERE market_id=2");
      mysqli_query($connect, "UPDATE tb_catalog SET upload_on = '$date_cd' WHERE market_id=2 && item_id='$item_id'");
      mysqli_query($connect, "UPDATE tb_catalog SET name = REPLACE(name, '(Regular License)', '')");

      mysqli_query($connect, "UPDATE tb_catalog SET slug = 'PowerPoint' WHERE name LIKE '%powerpoint%' && market_id=2");
      mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Keynote' WHERE name LIKE '%keynote%' && market_id=2");
      mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Potrait' WHERE name LIKE '%potrait%' && market_id=2");
      mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Google Slide' WHERE name LIKE '%google slide%' && market_id=2");
      mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Etc' WHERE slug='' && market_id=2");
  }

  // mysqli_query($connect, "INSERT INTO tb_update(update_id, item_id, market_id, date) 
  // VALUES 
  // (NULL, '$item_id', 2, '$dateTime')");

}

// // echo "<pre>";
// //         print_r( $results_per_page);
// //         echo "</pre>";

header("location: ../upload.php?upload=success");    
   

