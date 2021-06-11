<?php

$date = $_POST['date'];

include('../../../../src/connection/connection.php');

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

if($date == 'One Month Last' && !isset($_POST['todate'])){
    $previous_year_month    = date('Y-m', strtotime("-1 month"));
    $end = date('Y-m-t');

    $end_dates = substr("$param_date", 0, 7);

    $query="SELECT DATE_ADD('$end', INTERVAL 1 WEEK) AS DATE";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $start_date_week = $row["DATE"];
    }

    // Last Week

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE date BETWEEN '$end' AND '$start_date_week'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_WEEK'  => $row['TOTAL'],
        ];
    }
    
    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$end' AND '$start_date_week'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_WEEK'  => $row['TOTAL'],
        ];
    }

    // Total Month

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE date LIKE '%$param_year_month%'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_YEAR'  => $row['TOTAL'],
        ];
    }
    
    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$param_year_month%'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_YEAR'  => $row['TOTAL'],
        ];
    }

    $output[] = [
        'TITLE'  => 'This Month'
    ];

}elseif($date == '30 Days' && !isset($_POST['todate'])){
    $param_date_1   = date('Y-m-d', strtotime("-30 day"));
    $param_date_2   = date('Y-m-d', strtotime("-60 day"));
    
    $query="SELECT DATE_ADD('$param_date_1', INTERVAL 1 WEEK) AS DATE";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $start_date_week = $row["DATE"];
    }

    // Last Week

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE date BETWEEN '$param_date_1' AND '$start_date_week'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_WEEK'  => $row['TOTAL'],
        ];
    }
    
    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$start_date_week'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_WEEK'  => $row['TOTAL'],
        ];
    }

    // Total 30 Days

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE date BETWEEN '$param_date_1' AND '$param_date'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_YEAR'  => $row['TOTAL'],
        ];
    }
    
    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$param_date'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_YEAR'  => $row['TOTAL'],
        ];
    }

    $output[] = [
        'TITLE'  => '30 Days'
    ];
    
}elseif($date == "One Year Last" && !isset($_POST['todate'])){
    $param_date_1   = date('Y-m-d', strtotime("-12 month"));
    $param_date_2   = date('Y-m-d', strtotime("-24 month"));

    $end = date("Y-m-t", strtotime($param_date));

    $query="SELECT DATE_ADD('$end', INTERVAL 1 WEEK) AS DATE";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $start_date_week = $row["DATE"];
    }

    // Last Week

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE date BETWEEN '$end' AND '$start_date_week'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_WEEK'  => $row['TOTAL'],
        ];
    }
    
    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$end' AND '$start_date_week'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_WEEK'  => $row['TOTAL'],
        ];
    }

    // Last One Year

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE date BETWEEN '$param_date_1' AND '$param_date'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_YEAR'  => $row['TOTAL'],
        ];
    }
    
    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$param_date'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_YEAR'  => $row['TOTAL'],
        ];
    }

    $output[] = [
        'TITLE'  => 'One Year'
    ];
    
}elseif(isset($date) && isset($_POST['todate'])){

    $todate = $_POST['todate'];

    $query="SELECT DATE_ADD('$date', INTERVAL -1 WEEK) AS DATE";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $start_date_week = $row["DATE"];
    }

    // Last Week

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE date BETWEEN '$start_date_week' AND '$date'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_WEEK'  => $row['TOTAL'],
        ];
    }
    
    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_week' AND '$date'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_WEEK'  => $row['TOTAL'],
        ];
    }

    // Period

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE date BETWEEN '$date' AND '$todate'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_YEAR'  => $row['TOTAL'],
        ];
    }
    
    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$date' AND '$todate'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_YEAR'  => $row['TOTAL'],
        ];
    }

    $output[] = [
        'TITLE'  => $date . ' to ' . $todate
    ];

}elseif($date == "Last Month" && !isset($_POST['todate'])){
    $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
    $previous_year_month_2    = date('Y-m', strtotime("-2 month"));
    
    $end = date("Y-m-t", strtotime($previous_year_month_1));

    $query="SELECT DATE_ADD('$end', INTERVAL 1 WEEK) AS DATE";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $start_date_week = $row["DATE"];
    }
    
    // Last Week

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE date BETWEEN '$end' AND '$start_date_week'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_WEEK'  => $row['TOTAL'],
        ];
    }

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$end' AND '$start_date_week'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_WEEK'  => $row['TOTAL'],
        ];
    }

    // Last Month

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE date LIKE '%$previous_year_month_1%'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_YEAR'  => $row['TOTAL'],
        ];
    }

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$previous_year_month_1%'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_YEAR'  => $row['TOTAL'],
        ];
    }

    $output[] = [
        'TITLE'  => 'Last Month'
    ];
    
}elseif($date == "This Year" && !isset($_POST['todate'])){
    $param_year_1   = date('Y', strtotime("-1 year"));
    $param_year_date   = date('Y-m-d', strtotime("-1 year"));
    $end = date("Y-m-t", strtotime($param_year_date));

    $query="SELECT DATE_ADD('$end', INTERVAL 1 WEEK) AS DATE";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $start_date_week = $row["DATE"];
    }

    // Last Week

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE date BETWEEN '$end' AND '$start_date_week'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_WEEK'  => $row['TOTAL'],
        ];
    }
    
    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$end' AND '$start_date_week'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_WEEK'  => $row['TOTAL'],
        ];
    }

    // This Year

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE year=$param_year";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_YEAR'  => $row['TOTAL'],
        ];
    }
    
    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$param_year";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_YEAR'  => $row['TOTAL'],
        ];
    }

    $output[] = [
        'TITLE'  => 'This Year'
    ];
    
}elseif($date == "Last Year" && !isset($_POST['todate'])){
    $param_year_1   = date('Y', strtotime("-1 year"));
    $param_year_date   = date('Y-m-d', strtotime("-2 year"));
    $end = date("Y-m-t", strtotime($param_year_date));

    $query="SELECT DATE_ADD('$end', INTERVAL 1 WEEK) AS DATE";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $start_date_week = $row["DATE"];
    }

    // Last Week

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE date BETWEEN '$end' AND '$start_date_week'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_WEEK'  => $row['TOTAL'],
        ];
    }
    
    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$end' AND '$start_date_week'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_WEEK'  => $row['TOTAL'],
        ];
    }

    // This Year

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE year=$param_year_1";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_YEAR'  => $row['TOTAL'],
        ];
    }
    
    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$param_year_1";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_YEAR'  => $row['TOTAL'],
        ];
    }


    $output[] = [
        'TITLE'  => 'Last Year'
    ];
    
}elseif($date == "All Time" && !isset($_POST['todate'])){

    $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $end_date = $row["date"];
    }

    $query="SELECT DATE_ADD('$end_date', INTERVAL -1 WEEK) AS DATE";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $start_date_week = $row["DATE"];
    }

    // Last Week

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular WHERE date BETWEEN '$start_date_week' AND '$end_date'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_WEEK'  => $row['TOTAL'],
        ];
    }
    
    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_week' AND '$end_date'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_WEEK'  => $row['TOTAL'],
        ];
    }

    // All Time

    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_popular";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'GR_YEAR'  => $row['TOTAL'],
        ];
    }
    
    $query="SELECT date, name, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'RRG_YEAR'  => $row['TOTAL'],
        ];
    }
    
    $output[] = [
        'TITLE'  => 'All Time'
    ];
}

echo json_encode($output);
