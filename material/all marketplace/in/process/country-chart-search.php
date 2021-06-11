<?php
include('../../../../src/connection/connection.php');
$type = $_POST['type'];
$date = $_POST['this_value'];
$market_sup = array("All Marketplace" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5");
$item_market = $market_sup[$type];

    if($item_market == 0){
        if(isset($_POST['search'])){
            $search = $_POST['search'];

            if($date == 'One Month Last'){
           
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country LIKE '%$search%' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country LIKE '%$search%') && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country LIKE '%$search%' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country LIKE '%$search%')) GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }elseif($date == '30 Days'){
    
                $query_upd="SELECT tb_sales.item_id, upload_on FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE datediff(current_date,date(date)) BETWEEN 0 AND 30 ORDER BY date DESC LIMIT 1";
                $result_upd = mysqli_query($connect, $query_upd);
                while($row =mysqli_fetch_array($result_upd)) 
                {
                    $param = $row['upload_on'];
                }
    
                $query_upd="SELECT tb_sales.item_id, upload_on FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE datediff(current_date,date(date)) BETWEEN 0 AND 30 ORDER BY date ASC LIMIT 1";
                $result_upd = mysqli_query($connect, $query_upd);
                while($row =mysqli_fetch_array($result_upd)) 
                {
                    $param1 = $row['upload_on'];
                }
        
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country LIKE '%$search%' && date BETWEEN '$param1' AND '$param' GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }elseif(isset($date) && !isset($_POST['this_values'])){
    
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country LIKE '%$search%' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country LIKE '%$search%') GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }elseif(isset($date) && isset($_POST['this_values'])){
                $todate = $_POST['this_values'];
        
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country LIKE '%$search%' && date BETWEEN '$date' AND '$todate' GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }
        }else{
            if($date == 'One Month Last'){
           
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id)) GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }elseif($date == '30 Days'){
    
                $query_upd="SELECT tb_sales.item_id, upload_on FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE datediff(current_date,date(date)) BETWEEN 0 AND 30 ORDER BY date DESC LIMIT 1";
                $result_upd = mysqli_query($connect, $query_upd);
                while($row =mysqli_fetch_array($result_upd)) 
                {
                    $param = $row['upload_on'];
                }
    
                $query_upd="SELECT tb_sales.item_id, upload_on FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE datediff(current_date,date(date)) BETWEEN 0 AND 30 ORDER BY date ASC LIMIT 1";
                $result_upd = mysqli_query($connect, $query_upd);
                while($row =mysqli_fetch_array($result_upd)) 
                {
                    $param1 = $row['upload_on'];
                }
        
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && date BETWEEN '$param1' AND '$param' GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }elseif(isset($date) && !isset($_POST['this_values'])){
    
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }elseif(isset($date) && isset($_POST['this_values'])){
                $todate = $_POST['this_values'];
        
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && date BETWEEN '$date' AND '$todate' GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }
        }
        
    }else{
        if(isset($_POST['search'])){
            $search = $_POST['search'];

            if($date == 'One Month Last'){
           
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market && country LIKE '%$search%' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market && country LIKE '%$search%') && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country LIKE '%$search%' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market && country LIKE '%$search%')) GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }elseif($date == '30 Days'){
    
                $query_upd="SELECT tb_sales.item_id, upload_on FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market && datediff(current_date,date(date)) BETWEEN 0 AND 30 ORDER BY date DESC LIMIT 1";
                $result_upd = mysqli_query($connect, $query_upd);
                while($row =mysqli_fetch_array($result_upd)) 
                {
                    $param = $row['upload_on'];
                }
    
                $query_upd="SELECT tb_sales.item_id, upload_on FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market && datediff(current_date,date(date)) BETWEEN 0 AND 30 ORDER BY date ASC LIMIT 1";
                $result_upd = mysqli_query($connect, $query_upd);
                while($row =mysqli_fetch_array($result_upd)) 
                {
                    $param1 = $row['upload_on'];
                }
        
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market && country LIKE '%$search%' && date BETWEEN '$param1' AND '$param' GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }elseif(isset($date) && !isset($_POST['this_values'])){
    
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market && country LIKE '%$search%' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market && country LIKE '%$search%') GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }elseif(isset($date) && isset($_POST['this_values'])){
                $todate = $_POST['this_values'];
        
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market && country LIKE '%$search%' && date BETWEEN '$date' AND '$todate' GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }
        }else{
            if($date == 'One Month Last'){
           
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market && country!='' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market) && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market)) GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }elseif($date == '30 Days'){
    
                $query_upd="SELECT tb_sales.item_id, upload_on FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market && datediff(current_date,date(date)) BETWEEN 0 AND 30 ORDER BY date DESC LIMIT 1";
                $result_upd = mysqli_query($connect, $query_upd);
                while($row =mysqli_fetch_array($result_upd)) 
                {
                    $param = $row['upload_on'];
                }
    
                $query_upd="SELECT tb_sales.item_id, upload_on FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market && datediff(current_date,date(date)) BETWEEN 0 AND 30 ORDER BY date ASC LIMIT 1";
                $result_upd = mysqli_query($connect, $query_upd);
                while($row =mysqli_fetch_array($result_upd)) 
                {
                    $param1 = $row['upload_on'];
                }
        
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market && country!='' && date BETWEEN '$param1' AND '$param' GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }elseif(isset($date) && !isset($_POST['this_values'])){
    
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE tb_sales.market_id=$item_market && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$item_market) GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }elseif(isset($date) && isset($_POST['this_values'])){
                $todate = $_POST['this_values'];
        
                $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && date BETWEEN '$date' AND '$todate' GROUP BY country DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $param_item = $row["country"];
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COUNTRY'  => $row["country"],
                    ];
                }
    
                if(!isset($param_item)){
                    $output[] = [
                        'TOTAL'  => 0,
                        'COUNTRY'  => '',
                    ];
                }
            }
        }
    }

    

echo json_encode($output);
