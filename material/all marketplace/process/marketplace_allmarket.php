<?php
include('../../../src/connection/connection.php');

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

$date_range = $_POST['this_value'];

if($date_range == "This Month"){
    $previous_year_month    = date('Y-m', strtotime("-1 month"));

    $query="SELECT a.month, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=1 && date LIKE '%$param_year_month%') as TOTALBE, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=2 && date LIKE '%$param_year_month%') as TOTALRRG, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=3 && date LIKE '%$param_year_month%') as TOTALTM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=4 && date LIKE '%$param_year_month%') as TOTALCM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=5 && date LIKE '%$param_year_month%') as TOTALRRS 
	FROM (SELECT DISTINCT month FROM tb_sales GROUP BY month ASC LIMIT 1) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'value'  => $row["month"],
            'TOTALBE'  => $row["TOTALBE"],
            'TOTALRRG'  => $row["TOTALRRG"],
            'TOTALTM'  => $row["TOTALTM"],
            'TOTALCM'  => $row["TOTALCM"],
            'TOTALRRS'  => $row["TOTALRRS"]
        ];
    }
    

}elseif($date_range == "30 Days"){
    $param_date_1   = date('Y-m-d', strtotime("-30 day"));

    $query="SELECT a.year, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=1 && date BETWEEN '$param_date_1' AND '$param_date') as TOTALBE, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=2 && date BETWEEN '$param_date_1' AND '$param_date') as TOTALRRG, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=3 && date BETWEEN '$param_date_1' AND '$param_date') as TOTALTM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=4 && date BETWEEN '$param_date_1' AND '$param_date') as TOTALCM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=5 && date BETWEEN '$param_date_1' AND '$param_date') as TOTALRRS 
	FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'value'  => $row["year"],
            'TOTALBE'  => $row["TOTALBE"],
            'TOTALRRG'  => $row["TOTALRRG"],
            'TOTALTM'  => $row["TOTALTM"],
            'TOTALCM'  => $row["TOTALCM"],
            'TOTALRRS'  => $row["TOTALRRS"]
        ];
    }
        
}elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
    $param_date_1   = date('Y-m-d', strtotime("-12 month"));

    $query="SELECT a.year, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=1 && date BETWEEN '$param_date_1' AND '$param_date') as TOTALBE, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=2 && date BETWEEN '$param_date_1' AND '$param_date') as TOTALRRG, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=3 && date BETWEEN '$param_date_1' AND '$param_date') as TOTALTM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=4 && date BETWEEN '$param_date_1' AND '$param_date') as TOTALCM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=5 && date BETWEEN '$param_date_1' AND '$param_date') as TOTALRRS 
	FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'value'  => $row["year"],
            'TOTALBE'  => $row["TOTALBE"],
            'TOTALRRG'  => $row["TOTALRRG"],
            'TOTALTM'  => $row["TOTALTM"],
            'TOTALCM'  => $row["TOTALCM"],
            'TOTALRRS'  => $row["TOTALRRS"]
        ];
    }
}elseif($date_range == "One Year" && isset($_POST['date']) && isset($_POST['todate'])){
    $date = $_POST['date'];
    $todate = $_POST['todate'];
    
    $query="SELECT a.year, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=1 && date BETWEEN '$date' AND '$todate') as TOTALBE, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=2 && date BETWEEN '$date' AND '$todate') as TOTALRRG, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=3 && date BETWEEN '$date' AND '$todate') as TOTALTM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=4 && date BETWEEN '$date' AND '$todate') as TOTALCM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=5 && date BETWEEN '$date' AND '$todate') as TOTALRRS 
	FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'value'  => $row["year"],
            'TOTALBE'  => $row["TOTALBE"],
            'TOTALRRG'  => $row["TOTALRRG"],
            'TOTALTM'  => $row["TOTALTM"],
            'TOTALCM'  => $row["TOTALCM"],
            'TOTALRRS'  => $row["TOTALRRS"]
        ];
    }
}elseif($date_range == "Last Month"){
    $previous_year_month_1    = date('Y-m', strtotime("-1 month"));

    $query="SELECT a.year, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=1 && date LIKE '%$previous_year_month_1%') as TOTALBE, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=2 && date LIKE '%$previous_year_month_1%') as TOTALRRG, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=3 && date LIKE '%$previous_year_month_1%') as TOTALTM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=4 && date LIKE '%$previous_year_month_1%') as TOTALCM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=5 && date LIKE '%$previous_year_month_1%') as TOTALRRS 
	FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'value'  => $row["year"],
            'TOTALBE'  => $row["TOTALBE"],
            'TOTALRRG'  => $row["TOTALRRG"],
            'TOTALTM'  => $row["TOTALTM"],
            'TOTALCM'  => $row["TOTALCM"],
            'TOTALRRS'  => $row["TOTALRRS"]
        ];
    }
}elseif($date_range == "Last Year"){
    $param_year_1   = date('Y', strtotime("-1 year"));
    
    $query="SELECT a.year, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=1 && year=$param_year_1) as TOTALBE, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=2 && year=$param_year_1) as TOTALRRG, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=3 && year=$param_year_1) as TOTALTM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=4 && year=$param_year_1) as TOTALCM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=5 && year=$param_year_1) as TOTALRRS 
	FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'value'  => $row["year"],
            'TOTALBE'  => $row["TOTALBE"],
            'TOTALRRG'  => $row["TOTALRRG"],
            'TOTALTM'  => $row["TOTALTM"],
            'TOTALCM'  => $row["TOTALCM"],
            'TOTALRRS'  => $row["TOTALRRS"]
        ];
    }
}elseif($date_range == "All Time"){
    $query="SELECT a.year, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=1) as TOTALBE, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=2) as TOTALRRG, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=3) as TOTALTM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=4) as TOTALCM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=5) as TOTALRRS 
	FROM (SELECT DISTINCT year FROM tb_sales LIMIT 1) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'value'  => $row["year"],
            'TOTALBE'  => $row["TOTALBE"],
            'TOTALRRG'  => $row["TOTALRRG"],
            'TOTALTM'  => $row["TOTALTM"],
            'TOTALCM'  => $row["TOTALCM"],
            'TOTALRRS'  => $row["TOTALRRS"]
        ];
    }
}elseif($date_range == "This Year"){
    $query="SELECT a.year, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=1 && year=$param_year) as TOTALBE, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=2 && year=$param_year) as TOTALRRG, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=3 && year=$param_year) as TOTALTM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=4 && year=$param_year) as TOTALCM, 
	(SELECT COUNT(*) FROM tb_sales WHERE market_id=5 && year=$param_year) as TOTALRRS 
	FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'value'  => $row["year"],
            'TOTALBE'  => $row["TOTALBE"],
            'TOTALRRG'  => $row["TOTALRRG"],
            'TOTALTM'  => $row["TOTALTM"],
            'TOTALCM'  => $row["TOTALCM"],
            'TOTALRRS'  => $row["TOTALRRS"]
        ];
    }
}


echo json_encode($output);
