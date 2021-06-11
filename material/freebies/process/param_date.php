<?php

$date_range = $_POST['this_value'];

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

include('../../../src/connection/connection.php');

if($date_range == "This Month"){

    $start_date = date("Y-m-01", strtotime($param_date));
    $output[] = [
        'start'  => $start_date,
    ];

    $end_date = date("Y-m-t", strtotime($param_date));
    $output[] = [
        'end'  => $end_date,
    ];

}elseif($date_range == "30 Days"){
    $param_date_1   = date('Y-m-d', strtotime("-30 day"));

    $output[] = [
        'start'  => $param_date,
    ];

    $output[] = [
        'end'  => $param_date_1,
    ];

    $query_upd="SELECT * FROM (
                SELECT * FROM tb_sales WHERE market_id=5 
                UNION
                SELECT * FROM tb_freebies
            ) AS a  
    WHERE datediff(current_date,date(date)) BETWEEN 0 AND 30 ORDER BY year DESC, month DESC, day DESC LIMIT 1";
    $result_upd = mysqli_query($connect, $query_upd);
    while($row =mysqli_fetch_array($result_upd)) 
    {
        $end_date = $row["date"];

        $output[] = [
            'end'  => $row["date"],
        ];
    }


}elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
    $param_date_1   = date('Y-m-d', strtotime("-12 month"));
    
    $query="SELECT * FROM tb_freebies WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY date ORDER BY year ASC, month ASC, day ASC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $start_date = $row["date"];

            $output[] = [
                'start'  => $row["date"],
            ];
        }

        $query="SELECT * FROM tb_freebies WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY date ORDER BY year DESC, month DESC, day DESC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $end_date = $row["date"];

            $output[] = [
                'end'  => $row["date"],
            ];
        }

    $query="SELECT * FROM (
                SELECT * FROM tb_sales WHERE market_id=5 
                UNION
                SELECT * FROM tb_freebies
            ) AS a  
    WHERE date> now() - INTERVAL 11 month GROUP BY date ORDER BY year ASC, month ASC, day ASC LIMIT 1";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $end_date = $row["date"];

        $output[] = [
            'end'  => $row["date"],
        ];
    }

}elseif($date_range == "One Year" && isset($_POST['date']) && isset($_POST['todate'])){
    

}elseif($date_range == "Last Month"){
    $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
    
    $query_upd="SELECT day, date, COUNT(*) as TOTAL FROM tb_freebies WHERE date LIKE '%$previous_year_month_1%' GROUP BY day ORDER BY year ASC, month ASC, day ASC LIMIT 1";
    $result_upd = mysqli_query($connect, $query_upd);
    while($row =mysqli_fetch_array($result_upd)) 
    {
        $start_date = $row["date"];

        $output[] = [
            'start'  => $row["date"],
        ];
    }

    $query_upd="SELECT day, date, COUNT(*) as TOTAL FROM tb_freebies WHERE date LIKE '%$previous_year_month_1%' GROUP BY day ORDER BY year DESC, month DESC, day DESC LIMIT 1";
    $result_upd = mysqli_query($connect, $query_upd);
    while($row =mysqli_fetch_array($result_upd)) 
    {
        $end_date = $row["date"];

        $output[] = [
            'end'  => $row["date"],
        ];
    }

}elseif($date_range == "Last Year"){
    $param_year_1   = date('Y', strtotime("-1 year"));

    $query_upd="SELECT year, month, date FROM tb_freebies WHERE year=$param_year_1 ORDER BY year ASC, month ASC, day ASC LIMIT 1";
    $result_upd = mysqli_query($connect, $query_upd);
    while($row =mysqli_fetch_array($result_upd)) 
    {
        $start_date = $row["date"];

        $output[] = [
            'start'  => $row["date"],
        ];
    }

    $query_upd="SELECT year, month, date FROM tb_freebies WHERE year=$param_year_1 ORDER BY year DESC, month DESC, day DESC LIMIT 1";
    $result_upd = mysqli_query($connect, $query_upd);
    while($row =mysqli_fetch_array($result_upd)) 
    {
        $end_date = $row["date"];

        $output[] = [
            'end'  => $row["date"],
        ];
    }

}elseif($date_range == "All Time"){
    
    $query_upd="SELECT * FROM (
                SELECT * FROM tb_sales WHERE market_id=5 
                UNION
                SELECT * FROM tb_freebies
            ) AS a  GROUP BY month ORDER BY year ASC, month ASC, day ASC LIMIT 1 ";
    $result_upd = mysqli_query($connect, $query_upd);
    while($row =mysqli_fetch_array($result_upd)) 
    {
        $start_date = $row["date"];

        $output[] = [
            'start'  => $row["date"],
        ];
    }

    $query_upd="SELECT * FROM (
                SELECT * FROM tb_sales WHERE market_id=5 
                UNION
                SELECT * FROM tb_freebies
            ) AS a  GROUP BY month ORDER BY year DESC, month DESC, day DESC LIMIT 1 ";
    $result_upd = mysqli_query($connect, $query_upd);
    while($row =mysqli_fetch_array($result_upd)) 
    {
        $end_date = $row["date"];

        $output[] = [
            'end'  => $row["date"],
        ];
    }

}elseif($date_range == "This Year"){
    
    $query="SELECT * FROM tb_freebies WHERE year=$param_year GROUP BY date ORDER BY year ASC, month ASC, day ASC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $start_date = $row["date"];

            $output[] = [
                'start'  => $row["date"],
            ];
        }

        $query="SELECT * FROM tb_freebies WHERE year=$param_year GROUP BY date ORDER BY year DESC, month DESC, day DESC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $end_date = $row["date"];

            $output[] = [
                'end'  => $row["date"],
            ];
        }
}


echo json_encode($output);
