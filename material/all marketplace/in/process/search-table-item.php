<?php
include('../../../../src/connection/connection.php');
$date_range = $_POST['this_value'];
$type = $_POST['type'];
$search = $_POST['search'];
$month = array("1" => "GR - Brandearth", "2" => "GR - RRGraph", "3" => "Templatemonster", "4" => "Creativemarket", "5" => "RRSlides");
$market_sup = array("All Marketplace" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5", "Category" => "6", "Color" => "7");
$market_id =$market_sup[$type];

if($market_id == 0){
    if(!empty($search)){
        if($date_range == "One Year Last"){
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Month Last"){
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id)) GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "30 Days"){
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

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Year Last" && !isset($_POST['this_values'])){
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

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
            $monthh = date("m", strtotime($date));
            $month = $monthh-1;

            $param_date = $year.'-'.$month;

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && date LIKE '%$param_date%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && date LIKE '%$year%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $yearr = date("Y", strtotime($date));
            $year = $yearr-1;

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && date LIKE '%$year%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }
    }else{
        if($date_range == "One Year Last"){
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Month Last"){
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id)) GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "30 Days"){
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

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Year Last" && !isset($_POST['this_values'])){
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

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
            $monthh = date("m", strtotime($date));
            $month = $monthh-1;

            $param_date = $year.'-'.$month;

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$param_date%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$year%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $yearr = date("Y", strtotime($date));
            $year = $yearr-1;

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$year%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }
    }
}elseif($market_id == 6){
    if(!empty($search)){
        if($date_range == "One Year Last"){
            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && category!='' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Month Last"){
            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && category!='' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id)) GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "30 Days"){
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

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && category!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Year Last" && !isset($_POST['this_values'])){
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

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && category!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
            $monthh = date("m", strtotime($date));
            $month = $monthh-1;

            $param_date = $year.'-'.$month;

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && category!='' && date LIKE '%$param_date%' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && category!='' && date LIKE '%$year%' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $yearr = date("Y", strtotime($date));
            $year = $yearr-1;

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && category!='' && date LIKE '%$year%' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && category!='' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && category!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }
    }else{
        if($date_range == "One Year Last"){
            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Month Last"){
            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id)) GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "30 Days"){
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

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Year Last" && !isset($_POST['this_values'])){
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

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
            $monthh = date("m", strtotime($date));
            $month = $monthh-1;

            $param_date = $year.'-'.$month;

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date LIKE '%$param_date%' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date LIKE '%$year%' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $yearr = date("Y", strtotime($date));
            $year = $yearr-1;

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date LIKE '%$year%' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }
    }
}elseif($market_id == 7){
    if(!empty($search)){
        if($date_range == "One Year Last"){
            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && color!='' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Month Last"){
            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && color!='' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id)) GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "30 Days"){
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

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Year Last" && !isset($_POST['this_values'])){
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

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
            $monthh = date("m", strtotime($date));
            $month = $monthh-1;

            $param_date = $year.'-'.$month;

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && color!='' && date LIKE '%$param_date%' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && color!='' && date LIKE '%$year%' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $yearr = date("Y", strtotime($date));
            $year = $yearr-1;

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && color!='' && date LIKE '%$year%' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && color!='' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }
    }else{
        if($date_range == "One Year Last"){
            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Month Last"){
            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id)) GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "30 Days"){
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

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Year Last" && !isset($_POST['this_values'])){
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

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
            $monthh = date("m", strtotime($date));
            $month = $monthh-1;

            $param_date = $year.'-'.$month;

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date LIKE '%$param_date%' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date LIKE '%$year%' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $yearr = date("Y", strtotime($date));
            $year = $yearr-1;

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date LIKE '%$year%' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }
    }
}else{
    if(!empty($search)){
        if($date_range == "One Year Last"){
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && tb_sales.market_id=$market_id && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id) GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Month Last"){
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && tb_sales.market_id=$market_id && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id) && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id)) GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "30 Days"){
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

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && tb_sales.market_id=$market_id && date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Year Last" && !isset($_POST['this_values'])){
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

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && tb_sales.market_id=$market_id && date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
            $monthh = date("m", strtotime($date));
            $month = $monthh-1;

            $param_date = $year.'-'.$month;

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && tb_sales.market_id=$market_id && date LIKE '%$param_date%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && tb_sales.market_id=$market_id && date LIKE '%$year%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $yearr = date("Y", strtotime($date));
            $year = $yearr-1;

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && tb_sales.market_id=$market_id && date LIKE '%$year%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && tb_sales.market_id=$market_id GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && tb_sales.market_id=$market_id && date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }
    }else{
        if($date_range == "One Year Last"){
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id) GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Month Last"){
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id) && month=(SELECT MAX(month) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id)) GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "30 Days"){
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

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "One Year Last" && !isset($_POST['this_values'])){
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

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));
            $monthh = date("m", strtotime($date));
            $month = $monthh-1;

            $param_date = $year.'-'.$month;

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date LIKE '%$param_date%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $year = date("Y", strtotime($date));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date LIKE '%$year%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            date_default_timezone_set('Asia/Jakarta');
            $date = date('Y-m-d');
            $yearr = date("Y", strtotime($date));
            $year = $yearr-1;

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date LIKE '%$year%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
        }
    }
}

$result = mysqli_query($connect, $query);
while($row =mysqli_fetch_array($result)) {
?>
    <tr class="sub-title-table">
        <td>
            <a href="item-details.php?item=<?=$row['name']?>&market=All Marketplace">
                <?=$row['name']?>
            </a>
        </td>
        <?php
        if($market_id == 6){
        ?>
        <td><?=$row['category']?></td>
        <?php
        }elseif($market_id == 7){
        ?>
        <td><?=$row['color']?></td>
        <?php
        }else{
        ?>
        <td><?=$month[$row['market_id']]?></td>
        <?php
        }
        ?>
        <td><?=$row['TOTAL']?></td> 
    </tr> 
    <?php
}

?>