<?php
include('../../../../src/connection/connection.php');
$type = $_POST['type'];
$date = $_POST['date'];
$item = $_POST['item'];
$market_sup = array("All" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5");
$item_market = $market_sup[$type];

if($item == 'Sales'){
    if($item_market == 0){
        if(!empty($_POST['search'])){
            $search = $_POST['search'];

            if($date == 'One Month Last' && !isset($_POST['todate'])){
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && color!='' && year=(SELECT MAX(year) FROM tb_sales) && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id)) GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == '30 Days' && !isset($_POST['todate'])){
        
                $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -30 DAY) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "One Year Last" && !isset($_POST['todate'])){
    
                $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -12 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif(isset($date) && isset($_POST['todate'])){
                $todate = $_POST['todate'];
        
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && color!='' && date BETWEEN '$date' AND '$todate' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "Last Month" && !isset($_POST['todate'])){
    
                $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -1 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_dates = $row["DATE"];
                    $start_date = substr("2020-11-10", 0, 7);
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && color!='' && date LIKE '%$start_date%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "This Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $year = date("Y", strtotime($date));
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && color!='' && year='$year' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "Last Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $yearr = date("Y", strtotime($date));
                $year = $yearr-1;
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && color!='' && year='$year' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "All Time" && !isset($_POST['todate'])){
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && color!='' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }
        }else{
            if($date == 'One Month Last' && !isset($_POST['todate'])){
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && year=(SELECT MAX(year) FROM tb_sales) && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id)) GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == '30 Days' && !isset($_POST['todate'])){
        
                $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -30 DAY) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "One Year Last" && !isset($_POST['todate'])){
    
                $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -12 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif(isset($date) && isset($_POST['todate'])){
                $todate = $_POST['todate'];
        
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$date' AND '$todate' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "Last Month" && !isset($_POST['todate'])){
    
                $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -1 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_dates = $row["DATE"];
                    $start_date = substr("2020-11-10", 0, 7);
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date LIKE '%$start_date%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "This Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $year = date("Y", strtotime($date));
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && year='$year' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "Last Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $yearr = date("Y", strtotime($date));
                $year = $yearr-1;
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && year='$year' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "All Time" && !isset($_POST['todate'])){
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }
        }
    }else{
        if(!empty($_POST['search'])){
            $search = $_POST['search'];

            if($date == 'One Month Last' && !isset($_POST['todate'])){
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && tb_sales.market_id='$item_market' && color!='' && year=(SELECT MAX(year) FROM tb_sales WHERE tb_sales.market_id='$item_market') && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market')) GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == '30 Days' && !isset($_POST['todate'])){
        
                $query="SELECT date FROM tb_sales WHERE market_id='$item_market' GROUP BY date DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -30 DAY) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && tb_sales.market_id='$item_market' && color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "One Year Last" && !isset($_POST['todate'])){
    
                $query="SELECT date FROM tb_sales WHERE tb_sales.market_id='$item_market' GROUP BY date DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -12 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && tb_sales.market_id='$item_market' && color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif(isset($date) && isset($_POST['todate'])){
                $todate = $_POST['todate'];
        
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && tb_sales.market_id='$item_market' && color!='' && date BETWEEN '$date' AND '$todate' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "Last Month" && !isset($_POST['todate'])){
    
                $query="SELECT date FROM tb_sales WHERE tb_sales.market_id='$item_market' GROUP BY date DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -1 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_dates = $row["DATE"];
                    $start_date = substr("2020-11-10", 0, 7);
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && tb_sales.market_id='$item_market' && color!='' && date LIKE '%$start_date%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "This Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $year = date("Y", strtotime($date));
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && tb_sales.market_id='$item_market' && color!='' && year='$year' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "Last Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $yearr = date("Y", strtotime($date));
                $year = $yearr-1;
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && tb_sales.market_id='$item_market' && color!='' && year='$year' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "All Time" && !isset($_POST['todate'])){
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color LIKE '%$search%' && tb_sales.market_id='$item_market' && color!='' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }
        }else{
            if($date == 'One Month Last' && !isset($_POST['todate'])){
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' && year=(SELECT MAX(year) FROM tb_sales WHERE tb_sales.market_id='$item_market') && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market')) GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == '30 Days' && !isset($_POST['todate'])){
        
                $query="SELECT date FROM tb_sales WHERE market_id='$item_market' GROUP BY date DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -30 DAY) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "One Year Last" && !isset($_POST['todate'])){
    
                $query="SELECT date FROM tb_sales WHERE tb_sales.market_id='$item_market' GROUP BY date DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -12 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif(isset($date) && isset($_POST['todate'])){
                $todate = $_POST['todate'];
        
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' && date BETWEEN '$date' AND '$todate' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "Last Month" && !isset($_POST['todate'])){
    
                $query="SELECT date FROM tb_sales WHERE tb_sales.market_id='$item_market' GROUP BY date DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -1 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_dates = $row["DATE"];
                    $start_date = substr("2020-11-10", 0, 7);
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' && date LIKE '%$start_date%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "This Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $year = date("Y", strtotime($date));
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' && year='$year' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "Last Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $yearr = date("Y", strtotime($date));
                $year = $yearr-1;
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' && year='$year' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "All Time" && !isset($_POST['todate'])){
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }
        }
    }
}else{
    if($item_market == 0){
        if(!empty($_POST['search'])){
            $search = $_POST['search'];

            if($date == 'One Month Last' && !isset($_POST['todate'])){

                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
        
                $start_date = date("Y-m-01", strtotime($date));
                $end_date = date("Y-m-t", strtotime($date));
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && color!='' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == '30 Days' && !isset($_POST['todate'])){
        
                $query="SELECT upload_on FROM tb_catalog GROUP BY upload_on DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -30 DAY) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && color!='' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "One Year Last" && !isset($_POST['todate'])){
    
                $query="SELECT upload_on FROM tb_catalog GROUP BY upload_on DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -12 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && color!='' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif(isset($date) && isset($_POST['todate'])){
                $todate = $_POST['todate'];
        
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && color!='' && upload_on BETWEEN '$date' AND '$todate' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "Last Month" && !isset($_POST['todate'])){
    
                $query="SELECT upload_on FROM tb_catalog GROUP BY upload_on DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -1 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_dates = $row["DATE"];
                    $start_date = substr("2020-11-10", 0, 7);
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && color!='' && upload_on LIKE '%$start_date%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "This Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $year = date("Y", strtotime($date));
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && color!='' && upload_on LIKE '%$year%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "Last Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $yearr = date("Y", strtotime($date));
                $year = $yearr-1;
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && color!='' && upload_on LIKE '%$year%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "All Time" && !isset($_POST['todate'])){
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && color!='' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }
        }else{
            if($date == 'One Month Last' && !isset($_POST['todate'])){

                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
        
                $start_date = date("Y-m-01", strtotime($date));
                $end_date = date("Y-m-t", strtotime($date));
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == '30 Days' && !isset($_POST['todate'])){
        
                $query="SELECT upload_on FROM tb_catalog GROUP BY upload_on DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -30 DAY) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "One Year Last" && !isset($_POST['todate'])){
    
                $query="SELECT upload_on FROM tb_catalog GROUP BY upload_on DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -12 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif(isset($date) && isset($_POST['todate'])){
                $todate = $_POST['todate'];
        
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' && upload_on BETWEEN '$date' AND '$todate' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "Last Month" && !isset($_POST['todate'])){
    
                $query="SELECT upload_on FROM tb_catalog GROUP BY upload_on DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -1 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_dates = $row["DATE"];
                    $start_date = substr("2020-11-10", 0, 7);
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' && upload_on LIKE '%$start_date%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "This Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $year = date("Y", strtotime($date));
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' && upload_on LIKE '%$year%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "Last Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $yearr = date("Y", strtotime($date));
                $year = $yearr-1;
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' && upload_on LIKE '%$year%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "All Time" && !isset($_POST['todate'])){
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }
        }
    }else{
        if(!empty($_POST['search'])){
            $search = $_POST['search'];

            if($date == 'One Month Last' && !isset($_POST['todate'])){

                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
        
                $start_date = date("Y-m-01", strtotime($date));
                $end_date = date("Y-m-t", strtotime($date));
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && market_id='$item_market' && color!='' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == '30 Days' && !isset($_POST['todate'])){
        
                $query="SELECT upload_on FROM tb_catalog WHERE market_id='$item_market' GROUP BY upload_on DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -30 DAY) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && market_id='$item_market' && color!='' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "One Year Last" && !isset($_POST['todate'])){
    
                $query="SELECT upload_on FROM tb_catalog WHERE market_id='$item_market' GROUP BY upload_on DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -12 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && market_id='$item_market' && color!='' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif(isset($date) && isset($_POST['todate'])){
                $todate = $_POST['todate'];
        
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && market_id='$item_market' && color!='' && upload_on BETWEEN '$date' AND '$todate' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "Last Month" && !isset($_POST['todate'])){
    
                $query="SELECT upload_on FROM tb_catalog WHERE market_id='$item_market' GROUP BY upload_on DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -1 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_dates = $row["DATE"];
                    $start_date = substr("2020-11-10", 0, 7);
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && market_id='$item_market' && color!='' && upload_on LIKE '%$start_date%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "This Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $year = date("Y", strtotime($date));
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && market_id='$item_market' && color!='' && upload_on LIKE '%$year%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "Last Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $yearr = date("Y", strtotime($date));
                $year = $yearr-1;
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && market_id='$item_market' && color!='' && upload_on LIKE '%$year%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "All Time" && !isset($_POST['todate'])){
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color LIKE '%$search%' && market_id='$item_market' && color!='' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }
        }else{
            if($date == 'One Month Last' && !isset($_POST['todate'])){

                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
        
                $start_date = date("Y-m-01", strtotime($date));
                $end_date = date("Y-m-t", strtotime($date));
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == '30 Days' && !isset($_POST['todate'])){
        
                $query="SELECT upload_on FROM tb_catalog WHERE market_id='$item_market' GROUP BY upload_on DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -30 DAY) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "One Year Last" && !isset($_POST['todate'])){
    
                $query="SELECT upload_on FROM tb_catalog WHERE market_id='$item_market' GROUP BY upload_on DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -12 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_date = $row["DATE"];
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif(isset($date) && isset($_POST['todate'])){
                $todate = $_POST['todate'];
        
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' && upload_on BETWEEN '$date' AND '$todate' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
            }elseif($date == "Last Month" && !isset($_POST['todate'])){
    
                $query="SELECT upload_on FROM tb_catalog WHERE market_id='$item_market' GROUP BY upload_on DESC LIMIT 1";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $end_date = $row["date"];
                }
    
                $query="SELECT DATE_ADD('$end_date', INTERVAL -1 MONTH) AS DATE";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
                    $start_dates = $row["DATE"];
                    $start_date = substr("2020-11-10", 0, 7);
                }
    
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' && upload_on LIKE '%$start_date%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "This Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $year = date("Y", strtotime($date));
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' && upload_on LIKE '%$year%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "Last Year" && !isset($_POST['todate'])){
    
                date_default_timezone_set('Asia/Jakarta');
                $date = date('Y-m-d');
                $yearr = date("Y", strtotime($date));
                $year = $yearr-1;
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' && upload_on LIKE '%$year%' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }elseif($date == "All Time" && !isset($_POST['todate'])){
    
                $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' GROUP BY color DESC ORDER BY TOTAL DESC";
                $result = mysqli_query($connect, $query);
                while($row =mysqli_fetch_array($result)) {
    
                    $output[] = [
                        'TOTAL'  => $row["TOTAL"],
                        'COLOR'  => $row["color"],
                    ];
                }
                
            }
        }
    }
}
    

echo json_encode($output);
