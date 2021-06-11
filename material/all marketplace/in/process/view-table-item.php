<?php
include('../../../../src/connection/connection.php');
$date_range = $_POST['this_value'];
$type = $_POST['type'];
$select = $_POST['select'];
$month = array("1" => "GR - Brandearth", "2" => "GR - RRGraph", "3" => "Templatemonster", "4" => "Creativemarket", "5" => "RRSlides");
$market_sup = array("All Marketplace" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5", "Category" => "6", "Color" => "7");
$market_id =$market_sup[$type];

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

if($market_id == 0){
    if($select == 'All'){
        if($date_range == "One Year Last" && !isset($_POST['this_values'])){
            $param_date_1   = date('Y-m-d', strtotime("-12 month"));
            $param_date_2   = date('Y-m-d', strtotime("-24 month"));
            
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY name ORDER BY TOTAL DESC, name DESC";
        }elseif($date_range == "One Month Last"){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));
            
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$param_year_month%' GROUP BY name ORDER BY TOTAL DESC, name DESC ";
        }elseif($date_range == "30 Days"){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY name ORDER BY TOTAL DESC, name DESC ";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$previous_year_month_1%' GROUP BY name ORDER BY TOTAL DESC, name DESC ";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$param_year GROUP BY name ORDER BY TOTAL DESC, name DESC ";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
            $param_year_2   = date('Y', strtotime("-2 year"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$param_year_1 GROUP BY name ORDER BY TOTAL DESC, name DESC ";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id GROUP BY name ORDER BY TOTAL DESC, name DESC  ";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC  ";
        }
    }else{
        if($date_range == "One Year Last" && !isset($_POST['this_values'])){
            $param_date_1   = date('Y-m-d', strtotime("-12 month"));
            $param_date_2   = date('Y-m-d', strtotime("-24 month"));
            
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select";
        }elseif($date_range == "One Month Last"){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));
            
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$param_year_month%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select";
        }elseif($date_range == "30 Days"){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select ";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$previous_year_month_1%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select ";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$param_year GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select ";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
            $param_year_2   = date('Y', strtotime("-2 year"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$param_year_1 GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select ";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select";
        }
    }
}elseif($market_id == 6){
    if($select == 'All'){
        if($date_range == "One Year Last" && !isset($_POST['this_values'])){
            $param_date_1   = date('Y-m-d', strtotime("-12 month"));
            $param_date_2   = date('Y-m-d', strtotime("-24 month"));

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY category ORDER BY TOTAL DESC, name DESC  ";
        }elseif($date_range == "One Month Last"){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date LIKE '%$param_year_month%' GROUP BY category ORDER BY TOTAL DESC, name DESC  ";
        }elseif($date_range == "30 Days"){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY category ORDER BY TOTAL DESC, name DESC  ";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date LIKE '%$previous_year_month_1%' GROUP BY category ORDER BY TOTAL DESC, name DESC  ";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && year=$param_year GROUP BY category ORDER BY TOTAL DESC, name DESC  ";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
            $param_year_2   = date('Y', strtotime("-2 year"));

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && year=$param_year_1 GROUP BY category ORDER BY TOTAL DESC, name DESC  ";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' GROUP BY category ORDER BY TOTAL DESC, name DESC  ";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY category ORDER BY TOTAL DESC, name DESC  ";
        }
    }else{
        if($date_range == "One Year Last" && !isset($_POST['this_values'])){
            $param_date_1   = date('Y-m-d', strtotime("-12 month"));
            $param_date_2   = date('Y-m-d', strtotime("-24 month"));

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }elseif($date_range == "One Month Last"){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date LIKE '%$param_year_month%' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }elseif($date_range == "30 Days"){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date LIKE '%$previous_year_month_1%' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && year=$param_year GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
            $param_year_2   = date('Y', strtotime("-2 year"));

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && year=$param_year_1 GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, category, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY category ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }
    }
}elseif($market_id == 7){
    if($select == 'All'){
        if($date_range == "One Year Last" && !isset($_POST['this_values'])){
            $param_date_1   = date('Y-m-d', strtotime("-12 month"));
            $param_date_2   = date('Y-m-d', strtotime("-24 month"));

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY color ORDER BY TOTAL DESC, name DESC  ";
        }elseif($date_range == "One Month Last"){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));
            
            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date LIKE '%$param_year_month%' GROUP BY color ORDER BY TOTAL DESC, name DESC  ";
        }elseif($date_range == "30 Days"){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY color ORDER BY TOTAL DESC, name DESC  ";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date LIKE '%$previous_year_month_1%' GROUP BY color ORDER BY TOTAL DESC, name DESC  ";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && year=$param_year GROUP BY color ORDER BY TOTAL DESC, name DESC  ";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
            $param_year_2   = date('Y', strtotime("-2 year"));

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && year=$param_year_1 GROUP BY color ORDER BY TOTAL DESC, name DESC  ";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' GROUP BY color ORDER BY TOTAL DESC, name DESC  ";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color ORDER BY TOTAL DESC, name DESC  ";
        }
    }else{
        if($date_range == "One Year Last" && !isset($_POST['this_values'])){
            $param_date_1   = date('Y-m-d', strtotime("-12 month"));
            $param_date_2   = date('Y-m-d', strtotime("-24 month"));

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }elseif($date_range == "One Month Last"){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));
            
            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date LIKE '%$param_year_month%' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }elseif($date_range == "30 Days"){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date LIKE '%$previous_year_month_1%' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && year=$param_year GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
            $param_year_2   = date('Y', strtotime("-2 year"));

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && year=$param_year_1 GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, color, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$start_date' AND '$end_date' GROUP BY color ORDER BY TOTAL DESC, name DESC LIMIT $select  ";
        }
    }
}else{
    if($select == 'All'){
        if($date_range == "One Year Last" && !isset($_POST['this_values'])){
            $param_date_1   = date('Y-m-d', strtotime("-12 month"));
            $param_date_2   = date('Y-m-d', strtotime("-24 month"));
            
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY name ORDER BY TOTAL DESC, name DESC";
        }elseif($date_range == "One Month Last"){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));
            
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date LIKE '%$param_year_month%' GROUP BY name ORDER BY TOTAL DESC, name DESC ";
        }elseif($date_range == "30 Days"){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY name ORDER BY TOTAL DESC, name DESC ";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date LIKE '%$previous_year_month_1%' GROUP BY name ORDER BY TOTAL DESC, name DESC ";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && year=$param_year GROUP BY name ORDER BY TOTAL DESC, name DESC ";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
            $param_year_2   = date('Y', strtotime("-2 year"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && year=$param_year_1 GROUP BY name ORDER BY TOTAL DESC, name DESC ";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id GROUP BY name ORDER BY TOTAL DESC, name DESC  ";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC  ";
        }
    }else{
        if($date_range == "One Year Last" && !isset($_POST['this_values'])){
            $param_date_1   = date('Y-m-d', strtotime("-12 month"));
            $param_date_2   = date('Y-m-d', strtotime("-24 month"));
            
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select";
        }elseif($date_range == "One Month Last"){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));
            
            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date LIKE '%$param_year_month%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select";
        }elseif($date_range == "30 Days"){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select ";
        }elseif($date_range == "Last Month" && !isset($_POST['this_values'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date LIKE '%$previous_year_month_1%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select ";
        }elseif($date_range == "This Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && year=$param_year GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select ";
        }elseif($date_range == "Last Year" && !isset($_POST['this_values'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
            $param_year_2   = date('Y', strtotime("-2 year"));

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && year=$param_year_1 GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select ";
        }elseif($date_range == "All Time" && !isset($_POST['this_values'])){

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select";
        }elseif(isset($date_range) && isset($_POST['this_values'])){
            $start_date = $_POST['this_value'];
            $end_date = $_POST['this_values'];

            $query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date BETWEEN '$start_date' AND '$end_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT $select";
        }
    }
}

$result = mysqli_query($connect, $query);
while($row =mysqli_fetch_array($result)) {
?>
    <tr class="sub-title-table">
        <td>
            <?php
            error_reporting(0);
            if(strlen($_GET['todate']) > 1){
            ?>
                <a href="item-details.php?item=<?=$row['name']?>&market=All Marketplace&date=<?=$_GET['date']?>&todate=<?=$_GET['todate']?>">
            <?php
            }else{
                if($_GET['date'] == 'One Year'){
            ?>
                <a href="item-details.php?item=<?=$row['name']?>&market=All Marketplace&date=<?=$_GET['date']?>&todate=">
            <?php
                }else{
            ?>
                <a href="item-details.php?item=<?=$row['name']?>&market=All Marketplace&date=One Year&todate=">
            <?php
                }
            }
            ?>
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