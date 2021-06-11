<?php

$date_range = $_POST['this_value'];
$market = $_POST['market'];
$market_sup = array("All Marketplace" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5");
$market_id =$market_sup[$market];

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

include('../../../src/connection/connection.php');

if($market_id == 0){
    if($date_range == "This Month"){
        $previous_year_month    = date('Y-m', strtotime("-1 month"));

        $query_current = "SELECT * FROM tb_sales WHERE date LIKE '%$param_year_month%'";
        $query_previou = "SELECT * FROM tb_sales WHERE date LIKE '%$previous_year_month%'";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previou));


        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;
        $output = [
            "current" => $current_sales,
            "previou" => $previou_sales,
            "rate" => $rates];

    }elseif($date_range == "30 Days"){
        $param_date_1   = date('Y-m-d', strtotime("-30 day"));
        $param_date_2   = date('Y-m-d', strtotime("-60 day"));

        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year DESC, month DESC, day DESC) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
        $TOTAL_1 = $row['TOTAL'];
        }
        
        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales WHERE date BETWEEN '$param_date_2' AND '$param_date_1' GROUP BY year DESC, month DESC, day DESC) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
        $TOTAL_2 = $row['TOTAL'];
        }

        $rates = ($TOTAL_2 < 1) ? 0.00001 : (($TOTAL_1 - $TOTAL_2) / $TOTAL_2) * 100;
        $output = [
            "current" => $TOTAL_1,
            "previou" => $TOTAL_2,
            "rate" => $rates];
            
    }elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));
        $param_date_2   = date('Y-m-d', strtotime("-24 month"));
        
        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year DESC) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
        $TOTAL_1 = $row['TOTAL'];
        }

        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales WHERE date BETWEEN '$param_date_2' AND '$param_date_1' GROUP BY year DESC) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
        $TOTAL_2 = $row['TOTAL'];
        }

        $rates = ($TOTAL_2 < 1) ? 0.00001 : (($TOTAL_1 - $TOTAL_2) / $TOTAL_2) * 100;
        $output = [
            "current" => $TOTAL_1,
            "previou" => $TOTAL_2,
            "rate" => $rates];
    }elseif($date_range == "One Year" && isset($_POST['date']) && isset($_POST['todate'])){
        $date = $_POST['date'];
        $todate = $_POST['todate'];

        $year_dates = substr($date, 0, 4);
        $month_dates = substr($date, 5, 2)-1;
        $day_date = substr($date, 8, 2);

        if($month_dates == 0){
            $year_date = $year_dates-1;
            $month_date = 12;
            $day_date = substr($date, 8, 2);
        }else{
            $year_date = substr($date, 0, 4);
            $month_date = substr($date, 5, 2)-1;
            $day_date = substr($date, 8, 2);
        }
        
        $date_1 = $year_date.'-'.$month_date.'-'.$day_date;

        $year_todates = substr($todate, 0, 4);
        $month_todates = substr($todate, 5, 2)-1;
        $day_todate = substr($todate, 8, 2);

        if($month_todates == 0){
            $year_todates = $year_dates-1;
            $month_todates = 12;
            $day_todate = substr($todate, 8, 2);
        }else{
            $year_todates = substr($todate, 0, 4);
            $month_todates = substr($todate, 5, 2)-1;
            $day_todate = substr($todate, 8, 2);
        }

        $date_2 = $year_todates.'-'.$month_todates.'-'.$day_todate;

        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales WHERE date BETWEEN '$date' AND '$todate' GROUP BY date DESC) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
        $TOTAL_1 = $row['TOTAL'];
        }

        if(isset($date_2)){
            $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales WHERE date BETWEEN '$date_1' AND '$date_2' GROUP BY date DESC) counttable";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
            $TOTAL_2 = $row['TOTAL'];
            }
        }else {
            $TOTAL_2 = 0;
        }

        $rates = ($TOTAL_2 < 1) ? 0.00001 : (($TOTAL_1 - $TOTAL_2) / $TOTAL_2) * 100;
        $output = [
            "current" => $TOTAL_1,
            "previou" => $TOTAL_2,
            "rate" => $rates];
    }elseif($date_range == "Last Month"){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
        $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

        $query_current = "SELECT * FROM tb_sales WHERE date LIKE '%$previous_year_month_1%'";
        $query_previou = "SELECT * FROM tb_sales WHERE date LIKE '%$previous_year_month_2%'";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previou));


        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;
        $output = [
            "current" => $current_sales,
            "previou" => $previou_sales,
            "rate" => $rates];
    }elseif($date_range == "Last Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));
        $param_year_2   = date('Y', strtotime("-2 year"));
        
        $query_current = "SELECT * FROM tb_sales WHERE year=$param_year_1";
        $query_previou = "SELECT * FROM tb_sales WHERE year=$param_year_2";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previou));


        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;
        $output = [
            "current" => $current_sales,
            "previou" => $previou_sales,
            "rate" => $rates];
    }elseif($date_range == "All Time"){

        $current_sales = 0;
        $previou_sales = 0;


        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;
        $output = [
            "current" => $current_sales,
            "previou" => $previou_sales,
            "rate" => $rates];
    }elseif($date_range == "This Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));
        
        $query_current = "SELECT * FROM tb_sales WHERE year=$param_year";
        $query_previou = "SELECT * FROM tb_sales WHERE year=$param_year_1";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previou));


        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;
        $output = [
            "current" => $current_sales,
            "previou" => $previou_sales,
            "rate" => $rates];
    }
}else{
    if($date_range == "This Month"){
        $previous_year_month    = date('Y-m', strtotime("-1 month"));

        $query_current = "SELECT * FROM tb_sales WHERE market_id=$market_id && date LIKE '%$param_year_month%'";
        $query_previou = "SELECT * FROM tb_sales WHERE market_id=$market_id && date LIKE '%$previous_year_month%'";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previou));


        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;
        $output = [
            "current" => $current_sales,
            "previou" => $previou_sales,
            "rate" => $rates];

    }elseif($date_range == "30 Days"){
        $param_date_1   = date('Y-m-d', strtotime("-30 day"));
        $param_date_2   = date('Y-m-d', strtotime("-60 day"));

        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year DESC, month DESC, day DESC) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
        $TOTAL_1 = $row['TOTAL'];
        }
        
        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$param_date_2' AND '$param_date_1' GROUP BY year DESC, month DESC, day DESC) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
        $TOTAL_2 = $row['TOTAL'];
        }

        $rates = ($TOTAL_2 < 1) ? 0.00001 : (($TOTAL_1 - $TOTAL_2) / $TOTAL_2) * 100;
        $output = [
            "current" => $TOTAL_1,
            "previou" => $TOTAL_2,
            "rate" => $rates];
            
    }elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));
        $param_date_2   = date('Y-m-d', strtotime("-24 month"));
        
        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year DESC) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
        $TOTAL_1 = $row['TOTAL'];
        }

        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$param_date_2' AND '$param_date_1' GROUP BY year DESC) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
        $TOTAL_2 = $row['TOTAL'];
        }

        $rates = ($TOTAL_2 < 1) ? 0.00001 : (($TOTAL_1 - $TOTAL_2) / $TOTAL_2) * 100;
        $output = [
            "current" => $TOTAL_1,
            "previou" => $TOTAL_2,
            "rate" => $rates];
    }elseif($date_range == "One Year" && isset($_POST['date']) && isset($_POST['todate'])){
        $date = $_POST['date'];
        $todate = $_POST['todate'];

        $year_dates = substr($date, 0, 4);
        $month_dates = substr($date, 5, 2)-1;
        $day_date = substr($date, 8, 2);

        if($month_dates == 0){
            $year_date = $year_dates-1;
            $month_date = 12;
            $day_date = substr($date, 8, 2);
        }else{
            $year_date = substr($date, 0, 4);
            $month_date = substr($date, 5, 2)-1;
            $day_date = substr($date, 8, 2);
        }
        
        $date_1 = $year_date.'-'.$month_date.'-'.$day_date;

        $year_todates = substr($todate, 0, 4);
        $month_todates = substr($todate, 5, 2)-1;
        $day_todate = substr($todate, 8, 2);

        if($month_todates == 0){
            $year_todates = $year_dates-1;
            $month_todates = 12;
            $day_todate = substr($todate, 8, 2);
        }else{
            $year_todates = substr($todate, 0, 4);
            $month_todates = substr($todate, 5, 2)-1;
            $day_todate = substr($todate, 8, 2);
        }

        $date_2 = $year_todates.'-'.$month_todates.'-'.$day_todate;

        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$date' AND '$todate' GROUP BY date DESC) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
        $TOTAL_1 = $row['TOTAL'];
        }

        if(isset($date_2)){
            $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$date_1' AND '$date_2' GROUP BY date DESC) counttable";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
            $TOTAL_2 = $row['TOTAL'];
            }
        }else {
            $TOTAL_2 = 0;
        }

        $rates = ($TOTAL_2 < 1) ? 0.00001 : (($TOTAL_1 - $TOTAL_2) / $TOTAL_2) * 100;
        $output = [
            "current" => $TOTAL_1,
            "previou" => $TOTAL_2,
            "rate" => $rates];
    }elseif($date_range == "Last Month"){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
        $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

        $query_current = "SELECT * FROM tb_sales WHERE market_id=$market_id && date LIKE '%$previous_year_month_1%'";
        $query_previou = "SELECT * FROM tb_sales WHERE market_id=$market_id && date LIKE '%$previous_year_month_2%'";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previou));


        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;
        $output = [
            "current" => $current_sales,
            "previou" => $previou_sales,
            "rate" => $rates];
    }elseif($date_range == "Last Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));
        $param_year_2   = date('Y', strtotime("-2 year"));

        $query_current = "SELECT * FROM tb_sales WHERE market_id=$market_id && year=$param_year_1";
        $query_previou = "SELECT * FROM tb_sales WHERE market_id=$market_id && year=$param_year_2";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previou));


        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;
        $output = [
            "current" => $current_sales,
            "previou" => $previou_sales,
            "rate" => $rates];
    }elseif($date_range == "All Time"){
        // $query_current = "SELECT * FROM tb_sales WHERE YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 1 YEAR)";
        // $query_previou = "SELECT * FROM tb_sales WHERE YEAR(date) = YEAR(CURRENT_DATE - INTERVAL 2 YEAR)";

        $current_sales = 0;
        $previou_sales = 0;


        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;
        $output = [
            "current" => $current_sales,
            "previou" => $previou_sales,
            "rate" => $rates];
    }elseif($date_range == "This Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));
        
        $query_current = "SELECT * FROM tb_sales WHERE market_id=$market_id && year=$param_year";
        $query_previou = "SELECT * FROM tb_sales WHERE market_id=$market_id && year=$param_year_1";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previou));


        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;
        $output = [
            "current" => $current_sales,
            "previou" => $previou_sales,
            "rate" => $rates];
    }
}

echo json_encode($output);