<?php

include '../../../src/connection/connection.php';
ini_set("max_execution_time",0);
error_reporting(0);
$curl = curl_init();
session_start();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.sendinblue.com/v3/emailCampaigns?api-key=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',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'api-key: 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',
    'Cookie: __cfduid=d335a3ae1a7cb5737f296bc16b690c2df1608190534'
  ),
));

$response = curl_exec($curl);
$result  = json_decode($response, true);

curl_close($curl);
// echo "<pre>";
//     print_r($result);
// echo "</pre>";
$user = $_SESSION['email'];
date_default_timezone_set('Asia/Jakarta');
$date_ac= date("d M Y");
$hour= date("H:i:s", strtotime('now +24 hours'));

$query = "INSERT INTO tb_activity_template (activity_id, username, activity, date, hours) 
            values 
            (null, '$user', 'Upload File - NL','$date_ac','$hour')";
            mysqli_query($connect, $query);

foreach ($result["campaigns"] as $item) {
    
    $id             = $item["id"];
    $param          = $item["status"];
    $delivered      = $item["statistics"]["globalStats"]["delivered"];
    $name           = $item["name"];
    $recipients     = $item["statistics"]["globalStats"]["sent"];
    $opened         = $item["statistics"]["globalStats"]["uniqueViews"];
    $open_rate      = ($opened/$delivered)*100;
    $clicked        = $item["statistics"]["globalStats"]["clickers"];
    $unique_click   = $item["statistics"]["globalStats"]["uniqueClicks"];
    $click_rate     = ($unique_click/$delivered)*100;
    $unsub          = $item["statistics"]["globalStats"]["unsubscriptions"];
    $unsub_rate     = ($unsub/$delivered)*100;
    $total_open     = $item["statistics"]["globalStats"]["viewed"];
    $dates          = $item["sentDate"];
    $date           = substr("$dates",0, 10);;
    $year           = substr("$dates",0, 4);;
    $month          = substr("$dates",5, 2);;
    $day            = substr("$dates",8, 2);;
    
    if($param != 'draft'){
      $sql_value_exist = mysqli_query($connect, "SELECT * FROM tb_newsletter WHERE item_id='$id'");
      if(mysqli_num_rows($sql_value_exist) < 1)
      {
          $sql_insert = mysqli_query($connect, "INSERT INTO tb_newsletter(news_id, item_id, campaign_title, recipients, opened, open_rate, clicked, click_rate, unsub, uns_rate, mailing_list, jenis_newsletter, delivered, total_opens, unique_click, date, year, month, day) 
          VALUES 
          (NULL, '$id', '$name', '$recipients', '$opened', '$open_rate', '$clicked', '$click_rate', '$unsub', '$unsub_rate', '', '', '$delivered', '$total_open', '$unique_click', '$date', '$year', '$month', '$day')");
      }elseif(mysqli_num_rows($sql_value_exist) > 1){
          $sql_insert = mysqli_query($connect, "UPDATE tb_newsletter SET recipients = '$recipients', opened = '$opened', open_rate='$open_rate', clicked='$clicked', click_rate='$click_rate', unsub='$unsub', uns_rate='$unsub_rate', delivered='$delivered', total_opens='$total_open', unique_click='$unique_click' WHERE item_id ='$id'");
      }
    }else{}

header("location: ../upload.php?upload=success");    
}

