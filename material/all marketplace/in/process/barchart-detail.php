<?php
include('../../../../src/connection/connection.php');
$name = $_POST['name'];
$date_range = $_POST['this_value'];
$month = array("1" => "Jan", "2" => "Feb", "3" => "Mar", "4" => "Apr", "5" => "May", "6" => "Jun", "7" => "Jul", "8" => "Aug", "9" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");              
// $market_sup = array("All Marketplace" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5");
// $market_id =$market_sup[$market];

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

if($date_range == 'This Month'){
    $previous_year_month    = date('Y-m', strtotime("-1 month"));
    $previous_date_month    = date('Y-m-d', strtotime("-1 month"));
    $previous_year_month_1    = date('Y-m', strtotime("-1 month"));

    $start = date('Y-m-01');
    $endd = date('Y-m-t');        

    $start2 = date('Y-m-01', strtotime("-1 month"));
    $endd2 = date("Y-m-t", strtotime($previous_year_month_1));

    $begin = new DateTime( $start );
    $end = new DateTime( $endd );
    $end = $end->modify( '+1 day' ); 

    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($begin, $interval ,$end);
    $rows = array();
    $rowss = array();

    foreach($daterange as $dt){
        $date_value = $dt->format("Y-m-d");
        $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE name LIKE '%$name%' && date = '$date_value'");
        while($row = mysqli_fetch_array($sql_tb_catalog)){
            $rows[] = $row;

        }
    }

    $begin2 = new DateTime( $start2 );
    $end2 = new DateTime( $endd2 );
    $end2 = $end2->modify( '+1 day' ); 

    $interval2 = new DateInterval('P1D');
    $daterange2 = new DatePeriod($begin2, $interval2 ,$end2);

    foreach($daterange2 as $dt2){
        $date_value2 = $dt2->format("Y-m-d");
        $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value2', 9) AS day, SUBSTR('$date_value2', 1, 4) AS year, SUBSTR('$date_value2', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE name LIKE '%$name%' && date = '$date_value2'");
        while($data = mysqli_fetch_array($sql_popular)){
            $rowss[] = $data;

        }
    }

    $combinedArray = array_replace_recursive($rows, $rowss);

    foreach( $combinedArray as $value ) {
        $output[] = [
            'month'   => $value['day'].'/'.$value["month"],
            'TOTAL'  => $value["TOTAL"],
            'JUMLAH'  => $value["JUMLAH"],
        ];
    }
}elseif($date_range == '30 Days'){
    $param_date_1   = date('Y-m-d', strtotime("-30 day"));
    $param_date_2   = date('Y-m-d', strtotime("-60 day"));

    $query="SELECT year, month, a.day, 
    (SELECT  COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' && date BETWEEN '$param_date_2' AND '$param_date_1' and day = a.day) as TOTAL, 
    (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' && date BETWEEN '$param_date_1' AND '$param_date' and day = a.day) as JUMLAH 
    FROM (SELECT DISTINCT year, month, day FROM tb_sales GROUP BY day ASC) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $output[] = [
            'month'   => $row['day'].'/'.$row['month'],
            'TOTAL'  => $row["TOTAL"],
            'JUMLAH'  => $row["JUMLAH"],
        ];
    }
}elseif($date_range == 'One Year' && !isset($_POST['date']) && !isset($_POST['todate'])){
    $param_date_1   = date('Y-m-d', strtotime("-12 month"));
    $param_date_2   = date('Y-m-d', strtotime("-24 month"));

    $endd = date('Y-m-01');
    $start = date('Y-m-01', strtotime("-12 month"));   

    $start2 = new DateTime( $start );
    $interval = new DateInterval('P1M');
    $end2 = new DateTime( $endd );
    $end2 = $end2->modify( '+1 month' ); 
    $period2 = new DatePeriod($start2, $interval, $end2);

    foreach($period2 as $dt2){
        $date_value2 = $dt2->format("Y-m");
        $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value2', 9) AS day, SUBSTR('$date_value2', 1, 4) AS year, SUBSTR('$date_value2', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE name LIKE '%$name%' && date LIKE '%$date_value2%'");
        while($row = mysqli_fetch_array($sql_tb_catalog)){
            $rows[] = $row;
        }
    }

    $endd3 = date('Y-m-01', strtotime("-12 month"));
    $start3 = date('Y-m-01', strtotime("-24 month"));   

    $start4 = new DateTime( $start3 );
    $interval3 = new DateInterval('P1M');
    $end4 = new DateTime( $endd3 );
    $end4 = $end4->modify( '+1 month' ); 
    $period4 = new DatePeriod($start4, $interval3, $end4);

    foreach($period4 as $dt4){
        $date_value4 = $dt4->format("Y-m");
        $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value4', 9) AS day, SUBSTR('$date_value4', 1, 4) AS year, SUBSTR('$date_value4', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE name LIKE '%$name%' && date LIKE '%$date_value4%'");
        while($data = mysqli_fetch_array($sql_popular)){
            $rowss[] = $data;

        }
    }

    $combinedArray = array_replace_recursive($rowss, $rows);

    foreach( $combinedArray as $value ) {
        $output[] = [
            'month'   => $value['month'].'/'.$value["year"],
            'TOTAL'  => $value["TOTAL"],
            'JUMLAH'  => $value["JUMLAH"],
        ];
    }

}elseif($date_range == 'One Year' && isset($_POST['date']) && isset($_POST['todate'])){
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
    
    $update_sql = mysqli_query($connect, "SELECT * FROM tb_sales WHERE date BETWEEN '$date' AND '$todate' GROUP BY date");

    if(mysqli_num_rows($update_sql) > 50){
        $query="SELECT date, year, day, a.month, 
        (SELECT  COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' && date BETWEEN '$date_1' AND '$date_2' and month = a.month) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' && date BETWEEN '$date' AND '$todate' and month = a.month) as JUMLAH FROM (SELECT DISTINCT date, year, day, month  FROM tb_sales WHERE date BETWEEN '$date' AND '$todate' GROUP BY month ASC, year ASC ORDER BY year ASC, month ASC) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $output[] = [
                'month'   => $month[$row["month"]].'/'.$row['year'],
                'TOTAL'  => $row["TOTAL"],
                'JUMLAH'  => $row["JUMLAH"]
            ];
        }
    }else{
        error_reporting(0);

        $begin = new DateTime( $date );
        $end = new DateTime( $todate );
        $end = $end->modify( '+1 day' ); 

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);
        
        $rows = array();
        foreach($daterange as $dt){
            $date_value = $dt->format("Y-m-d");
            $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE name LIKE '%$name%' && date = '$date_value'");
            while($row = mysqli_fetch_array($sql_tb_catalog)){
                $rows[] = $row;

            }
        }

        $begin2 = new DateTime( $date_1 );
        $end2 = new DateTime( $date_2 );
        $end2 = $end2->modify( '+1 day' ); 

        $interval2 = new DateInterval('P1D');
        $daterange2 = new DatePeriod($begin2, $interval2 ,$end2);
        
        $rowss = array();
        foreach($daterange2 as $dt2){
            $date_value2 = $dt2->format("Y-m-d");
            $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value2', 9) AS day, SUBSTR('$date_value2', 1, 4) AS year, SUBSTR('$date_value2', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE name LIKE '%$name%' && date = '$date_value2'");
            while($data = mysqli_fetch_array($sql_popular)){
                $rowss[] = $data;

            }
        }

        $combinedArray = array_replace_recursive($rowss, $rows);

        foreach( $combinedArray as $value ) {
            $output[] = [
                'month'   => $value['day'].'/'.$value["month"],
                'TOTAL'  => $value["TOTAL"],
                'JUMLAH'  => $value["JUMLAH"],
            ];
        }
    }

    
}elseif($date_range == 'Last Month'){
    error_reporting(0);
    $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
    $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

    $start = date('Y-m-01', strtotime("-1 month"));
    $endd = date("Y-m-t", strtotime($previous_year_month_1));

    $start2 = date('Y-m-01', strtotime("-2 month"));
    $endd2 = date("Y-m-t", strtotime($previous_year_month_2));

    $begin = new DateTime( $start );
    $end = new DateTime( $endd );
    $end = $end->modify( '+1 day' ); 

    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($begin, $interval ,$end);
    $rows = array();
    $rowss = array();

    foreach($daterange as $dt){
        $date_value = $dt->format("Y-m-d");
        $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE name LIKE '%$name%' && date = '$date_value'");
        while($row = mysqli_fetch_array($sql_tb_catalog)){
            $rows[] = $row;

        }
    }

    $begin2 = new DateTime( $start2 );
    $end2 = new DateTime( $endd2 );
    $end2 = $end2->modify( '+1 day' ); 

    $interval2 = new DateInterval('P1D');
    $daterange2 = new DatePeriod($begin2, $interval2 ,$end2);

    foreach($daterange2 as $dt2){
        $date_value2 = $dt2->format("Y-m-d");
        $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value2', 9) AS day, SUBSTR('$date_value2', 1, 4) AS year, SUBSTR('$date_value2', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE name LIKE '%$name%' && date = '$date_value2'");
        while($data = mysqli_fetch_array($sql_popular)){
            $rowss[] = $data;

        }
    }

    $combinedArray = array_replace_recursive($rows, $rowss);

    foreach( $combinedArray as $value ) {
        $output[] = [
            'month'   => $value['day'].'/'.$value["month"],
            'TOTAL'  => $value["TOTAL"],
            'JUMLAH'  => $value["JUMLAH"],
        ];
    }

}elseif($date_range == 'Last Year'){
    $param_year_1   = date('Y', strtotime("-1 year"));
    $param_year_2   = date('Y', strtotime("-2 year"));

    $query="SELECT year, a.month, 
    (SELECT  COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' && year=$param_year_2 and month = a.month) as TOTAL, 
    (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' && year=$param_year_1 and month = a.month) as JUMLAH 
    FROM (SELECT DISTINCT year, month FROM tb_sales GROUP BY month ASC) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $param = $row['JUMLAH'];
        $output[] = [
            'month'   => $month[$row["month"]].'/'.$row['year'],
            'TOTAL'  => $row["TOTAL"],
            'JUMLAH'  => $row["JUMLAH"],
        ];
    }

    if($param == NULL){
        $output[] = [
            'month'   => 0,
            'TOTAL'  => 0,
            'JUMLAH'  => 0,
        ];
    }
}elseif($date_range == 'This Year'){
    $param_year_1   = date('Y', strtotime("-1 year"));

    $query="SELECT year, a.month, 
    (SELECT  COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' && year=$param_year_1 and month = a.month) as TOTAL,
    (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' && year=$param_year and month = a.month) as JUMLAH 
    FROM (SELECT DISTINCT year, month FROM tb_sales GROUP BY month ASC) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $param = $row['JUMLAH'];
        $output[] = [
            'month'   => $month[$row["month"]].'/'.$row['year'],
            'TOTAL'  => $row["TOTAL"],
            'JUMLAH'  => $row["JUMLAH"],
        ];
    }

    if($param == NULL){
        $output[] = [
            'month'   => 0,
            'TOTAL'  => 0,
            'JUMLAH'  => 0,
        ];
    }
}elseif($date_range == 'All Time'){

    $query="SELECT a.year, (SELECT  COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' and year = a.year) as TOTAL, (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' and year = a.year) as JUMLAH FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $param = $row['JUMLAH'];
        $output[] = [
            'month'   => $row["year"],
            'TOTAL'  => $row["TOTAL"],
            'JUMLAH'  => $row["JUMLAH"],
        ];
    }

    if($param == NULL){
        $output[] = [
            'month'   => 0,
            'TOTAL'  => 0,
            'JUMLAH'  => 0,
        ];
    }
}

echo json_encode($output);
