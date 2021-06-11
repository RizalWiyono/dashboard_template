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

if($market == 'All Marketplace'){
    if($date_range == "This Month"){

        $query="SELECT day, COUNT(*) as TOTAL FROM tb_sales WHERE date LIKE '%$param_year_month%' GROUP BY day";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["day"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }


    }elseif($date_range == "30 Days"){
        $param_date_1   = date('Y-m-d', strtotime("-30 day"));

        $query="SELECT year, month, day, COUNT(*) as TOTAL FROM tb_sales WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year DESC, month DESC, day DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["day"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }

    }elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));

        $query="SELECT month, COUNT(*) AS TOTAL FROM tb_sales WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year DESC, month DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["month"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }
        
    }elseif($date_range == "One Year" && isset($_POST['date']) && isset($_POST['todate'])){
        $date = $_POST['date'];
        $todate = $_POST['todate'];
        $query="SELECT month, COUNT(*) as TOTAL FROM tb_sales WHERE date BETWEEN '$date' AND '$todate' GROUP BY month";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["month"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }
    }elseif($date_range == "Last Month"){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));

        $query="SELECT day, COUNT(*) as TOTAL FROM tb_sales WHERE date LIKE '%$previous_year_month_1%' GROUP BY day";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["day"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }
    }elseif($date_range == "Last Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $query="SELECT year, month, COUNT(*) as TOTAL FROM tb_sales WHERE year=$param_year_1 GROUP BY month";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["month"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }

    }elseif($date_range == "All Time"){
        $query="SELECT year, month, COUNT(*) as TOTAL FROM tb_sales GROUP BY month";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["month"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }

    }elseif($date_range == "This Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $query="SELECT month, COUNT(*) as TOTAL FROM tb_sales WHERE year=$param_year GROUP BY month";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["month"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }

    }
}else{
    if($date_range == "This Month"){

        $query="SELECT day, COUNT(*) as TOTAL FROM tb_sales WHERE market_id=$market_id && date LIKE '%$param_year_month%' GROUP BY day";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["day"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }

    }elseif($date_range == "30 Days"){
        $param_date_1   = date('Y-m-d', strtotime("-30 day"));

        $query="SELECT year, month, day, COUNT(*) as TOTAL FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year DESC, month DESC, day DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["day"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }

    }elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));

        $query="SELECT month, COUNT(*) AS TOTAL FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year DESC, month DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["month"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }

    }elseif($date_range == "One Year" && isset($_POST['date']) && isset($_POST['todate'])){
        $date = $_POST['date'];
        $todate = $_POST['todate'];
        $query="SELECT month, COUNT(*) as TOTAL FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$date' AND '$todate' GROUP BY month";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["month"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }
    }elseif($date_range == "Last Month"){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));

        $query="SELECT day, COUNT(*) as TOTAL FROM tb_sales WHERE market_id=$market_id && date LIKE '%$previous_year_month_1%' GROUP BY day";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["day"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }
    }elseif($date_range == "Last Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $query="SELECT year, month, COUNT(*) as TOTAL FROM tb_sales WHERE market_id=$market_id && year=$param_year_1 GROUP BY month";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["month"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }

    }elseif($date_range == "All Time"){
        $query="SELECT year, month, COUNT(*) as TOTAL FROM tb_sales WHERE market_id=$market_id GROUP BY month";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["month"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }
    }elseif($date_range == "This Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $query="SELECT month, COUNT(*) as TOTAL FROM tb_sales WHERE market_id=$market_id && year=$param_year GROUP BY month";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'value'  => $row["month"],
                'TOTAL'  => $row["TOTAL"]
            ];
        }

    }
}

echo json_encode($output);
