<?php
include('../../../../src/connection/connection.php');
$type = $_POST['type'];
$date = $_POST['date'];
$name = $_POST['name'];
$market_sup = array("All" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5");
$item_market = $market_sup[$type];

if($item_market == 0){
    if(!empty($_POST['search'])){
        $search = $_POST['search'];

        if($date == 'One Month Last' && !isset($_POST['todate'])){
            
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');

            $start_date = date("Y-m-01", strtotime($date));
            $end_date = date("Y-m-t", strtotime($date));
            
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE sub_category LIKE '%$search%' && category='$name' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
        }elseif($date == "30 Days" && !isset($_POST['todate'])){
        
            $query="SELECT upload_on FROM tb_catalog GROUP BY upload_on DESC LIMIT 1";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $end_date = $row["upload_on"];
            }
    
            $query="SELECT DATE_ADD('$end_date', INTERVAL -30 DAY) AS DATE";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $start_date = $row["DATE"];
            }
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE sub_category LIKE '%$search%' && category='$name' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
        }elseif($date == "One Year Last" && !isset($_POST['todate'])){
            
            $query="SELECT upload_on FROM tb_catalog GROUP BY upload_on DESC LIMIT 1";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $end_date = $row["upload_on"];
            }
    
            $query="SELECT DATE_ADD('$end_date', INTERVAL -12 MONTH) AS DATE";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $start_date = $row["DATE"];
            }
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE sub_category LIKE '%$search%' && category='$name' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
        }elseif($date == "Last Month" && !isset($_POST['todate'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
            $monthh = date("m", strtotime($date));
            $month = $monthh-1;
    
            $param_date = $year.'-'.$month;
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE sub_category LIKE '%$search%' && category='$name' && upload_on LIKE '%$param_date%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif($date == "This Year" && !isset($_POST['todate'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE sub_category LIKE '%$search%' && category='$name' && upload_on LIKE '%$year%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif($date == "Last Year" && !isset($_POST['todate'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $yearr = date("Y", strtotime($date));
            $year = $yearr-1;
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE sub_category LIKE '%$search%' && category='$name' && upload_on LIKE '%$year%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif($date == "All Time" && !isset($_POST['todate'])){
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE sub_category LIKE '%$search%' && category='$name' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif(isset($_POST['date']) && isset($_POST['todate'])){
            $todate = $_POST['todate'];
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE sub_category LIKE '%$search%' && category='$name' && upload_on BETWEEN '$date' AND '$todate' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
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
        if($date == "One Month Last" && !isset($_POST['todate'])){

            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
    
            $start_date = date("Y-m-01", strtotime($date));
            $end_date = date("Y-m-t", strtotime($date));
            
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE category='$name' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
        }elseif($date == "30 Days" && !isset($_POST['todate'])){
            
            $query="SELECT upload_on FROM tb_catalog GROUP BY upload_on DESC LIMIT 1";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $end_date = $row["upload_on"];
            }
    
            $query="SELECT DATE_ADD('$end_date', INTERVAL -30 DAY) AS DATE";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $start_date = $row["DATE"];
            }
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE category='$name' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
        }elseif($date == "One Year Last" && !isset($_POST['todate'])){
            
            $query="SELECT upload_on FROM tb_catalog GROUP BY upload_on DESC LIMIT 1";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $end_date = $row["upload_on"];
            }
    
            $query="SELECT DATE_ADD('$end_date', INTERVAL -12 MONTH) AS DATE";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $start_date = $row["DATE"];
            }
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE category='$name' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
        }elseif($date == "Last Month" && !isset($_POST['todate'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
            $monthh = date("m", strtotime($date));
            $month = $monthh-1;
    
            $param_date = $year.'-'.$month;
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE category='$name' && upload_on LIKE '%$param_date%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif($date == "This Year" && !isset($_POST['todate'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE category='$name' && upload_on LIKE '%$year%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif($date == "Last Year" && !isset($_POST['todate'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $yearr = date("Y", strtotime($date));
            $year = $yearr-1;
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE category='$name' && upload_on LIKE '%$year%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif($date == "All Time" && !isset($_POST['todate'])){
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE category='$name' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif(isset($_POST['date']) && isset($_POST['todate'])){
            $todate = $_POST['todate'];
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE category='$name' && upload_on BETWEEN '$date' AND '$todate' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
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
    if(!empty($_POST['search'])){
        $search = $_POST['search'];

        if($date == "One Month Last" && !isset($_POST['todate'])){

            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
    
            $start_date = date("Y-m-01", strtotime($date));
            $end_date = date("Y-m-t", strtotime($date));
            
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && sub_category LIKE '%$search%' && category='$name' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
        }elseif($date == "30 Days" && !isset($_POST['todate'])){
            
            $query="SELECT upload_on FROM tb_catalog WHERE market_id='$item_market' GROUP BY upload_on DESC LIMIT 1";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $end_date = $row["upload_on"];
            }
    
            $query="SELECT DATE_ADD('$end_date', INTERVAL -30 DAY) AS DATE";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $start_date = $row["DATE"];
            }
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && sub_category LIKE '%$search%' && category='$name' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
        }elseif($date == "One Year Last" && !isset($_POST['todate'])){
            
            $query="SELECT upload_on FROM tb_catalog WHERE market_id='$item_market' GROUP BY upload_on DESC LIMIT 1";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $end_date = $row["upload_on"];
            }
    
            $query="SELECT DATE_ADD('$end_date', INTERVAL -12 MONTH) AS DATE";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $start_date = $row["DATE"];
            }
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && sub_category LIKE '%$search%' && category='$name' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
        }elseif($date == "Last Month" && !isset($_POST['todate'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
            $monthh = date("m", strtotime($date));
            $month = $monthh-1;
    
            $param_date = $year.'-'.$month;
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && sub_category LIKE '%$search%' && category='$name' && upload_on LIKE '%$param_date%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif($date == "This Year" && !isset($_POST['todate'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && sub_category LIKE '%$search%' && category='$name' && upload_on LIKE '%$year%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif($date == "Last Year" && !isset($_POST['todate'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $yearr = date("Y", strtotime($date));
            $year = $yearr-1;
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && sub_category LIKE '%$search%' && category='$name' && upload_on LIKE '%$year%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif($date == "All Time" && !isset($_POST['todate'])){
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && sub_category LIKE '%$search%' && category='$name' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif(isset($_POST['date']) && isset($_POST['todate'])){
            $todate = $_POST['todate'];
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && sub_category LIKE '%$search%' && category='$name' && upload_on BETWEEN '$date' AND '$todate' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
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
        if($date == "One Month Last" && !isset($_POST['todate'])){

            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
    
            $start_date = date("Y-m-01", strtotime($date));
            $end_date = date("Y-m-t", strtotime($date));
            
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && category='$name' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
        }elseif($date == "30 Days" && !isset($_POST['todate'])){
            
            $query="SELECT upload_on FROM tb_catalog WHERE market_id='$item_market' GROUP BY upload_on DESC LIMIT 1";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $end_date = $row["upload_on"];
            }
    
            $query="SELECT DATE_ADD('$end_date', INTERVAL -30 DAY) AS DATE";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $start_date = $row["DATE"];
            }
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && category='$name' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
        }elseif($date == "One Year Last" && !isset($_POST['todate'])){
            
            $query="SELECT upload_on FROM tb_catalog WHERE market_id='$item_market' GROUP BY upload_on DESC LIMIT 1";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $end_date = $row["upload_on"];
            }
    
            $query="SELECT DATE_ADD('$end_date', INTERVAL -12 MONTH) AS DATE";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $start_date = $row["DATE"];
            }
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && category='$name' && upload_on BETWEEN '$start_date' AND '$end_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
        }elseif($date == "Last Month" && !isset($_POST['todate'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
            $monthh = date("m", strtotime($date));
            $month = $monthh-1;
    
            $param_date = $year.'-'.$month;
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && category='$name' && upload_on LIKE '%$param_date%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif($date == "This Year" && !isset($_POST['todate'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && category='$name' && upload_on LIKE '%$year%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif($date == "Last Year" && !isset($_POST['todate'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $yearr = date("Y", strtotime($date));
            $year = $yearr-1;
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && category='$name' && upload_on LIKE '%$year%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif($date == "All Time" && !isset($_POST['todate'])){
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && category='$name' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
    
    
    
        }elseif(isset($_POST['date']) && isset($_POST['todate'])){
            $todate = $_POST['todate'];
    
            $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && category='$name' && upload_on BETWEEN '$date' AND '$todate' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["sub_category"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["sub_category"],
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
