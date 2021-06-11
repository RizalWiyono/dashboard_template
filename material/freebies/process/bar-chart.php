<?php
include('../../../src/connection/connection.php');

$market = $_POST['market'];
$date_range = $_POST['this_value'];
$month = array("1" => "Jan", "2" => "Feb", "3" => "Mar", "4" => "Apr", "5" => "May", "6" => "Jun", "7" => "Jul", "8" => "Aug", "9" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");              

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

if($date_range == 'This Month'){

    $previous_year_month    = date('Y-m', strtotime("-1 month"));
    $previous_date_month    = date('Y-m-d', strtotime("-1 month"));

    $start = date('Y-m-01');
    $endd = date('Y-m-t');        

    $begin = new DateTime( $start );
    $end = new DateTime( $endd );
    $end = $end->modify( '+1 day' ); 

    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($begin, $interval ,$end);
    $rows1 = array();
    $rows2 = array();
    $datas1 = array();
    $datas2 = array();

    foreach($daterange as $dt){
        $date_value = $dt->format("Y-m-d");
        $sql_sum1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, SUM(earnings) AS TOTAL_SUM1 FROM tb_freebies WHERE market_id = 5 && date = '$date_value'");
        $sql_sum2 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, SUM(earnings) AS TOTAL_SUM2 FROM tb_sales WHERE market_id = 5 && date = '$date_value'");
        $sql_count1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL_COUNT1 FROM tb_freebies WHERE market_id = 5 && date = '$date_value'");
        $sql_count2 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL_COUNT2 FROM tb_sales WHERE market_id = 5 && date = '$date_value'");
        
        while($row1 = mysqli_fetch_array($sql_sum1)){
            $rows1[] = $row1;

        }

        while($row2 = mysqli_fetch_array($sql_sum2)){
            $rows2[] = $row2;

        }

        while($data1 = mysqli_fetch_array($sql_count1)){
            $datas1[] = $data1;

        }

        while($data2 = mysqli_fetch_array($sql_count2)){
            $datas2[] = $data2;

        }
    }

    $combinedArray = array_replace_recursive($rows1, $rows2, $datas1, $datas2);

    foreach( $combinedArray as $value ) {
        if(isset($value['TOTAL_SUM1'])){
            $value['TOTAL_SUM1'] = $value['TOTAL_SUM1'];
        }else{
            $value['TOTAL_SUM1'] = 0;
        }

        if(isset($value['TOTAL_SUM2'])){
            $value['TOTAL_SUM2'] = $value['TOTAL_SUM2'];
        }else{
            $value['TOTAL_SUM2'] = 0;
        }

        if(isset($value['TOTAL_COUNT1'])){
            $value['TOTAL_COUNT1'] = $value['TOTAL_COUNT1'];
        }else{
            $value['TOTAL_COUNT1'] = 0;
        }

        if(isset($value['TOTAL_COUNT2'])){
            $value['TOTAL_COUNT2'] = $value['TOTAL_COUNT2'];
        }else{
            $value['TOTAL_COUNT2'] = 0;
        }

        $total_count = $value['TOTAL_COUNT1']+$value['TOTAL_COUNT2'];
        $total_sum = $value['TOTAL_SUM1']+$value['TOTAL_SUM2'];

        $output[] = [
            'month'   => $value['day'].'/'.$value["month"],
            'TOTAL'  => $total_sum,
            'JUMLAH'  => $total_count
        ];
    }
}elseif($date_range == '30 Days'){
    $param_date_1   = date('Y-m-d', strtotime("-30 day"));
    $param_date_2   = date('Y-m-d', strtotime("-60 day"));

    $query="SELECT month, a.day, 
    (SELECT SUM(earnings) FROM tb_freebies WHERE market_id=5 && date BETWEEN '$param_date_1' AND '$param_date' and day = a.day) as SUM, 
    (SELECT SUM(earnings) FROM tb_sales WHERE market_id=5 && date BETWEEN '$param_date_1' AND '$param_date' and day = a.day) as SUM1, 
    (SELECT COUNT(*) FROM tb_freebies WHERE market_id=5 && date BETWEEN '$param_date_1' AND '$param_date' and day = a.day) as JUMLAH, 
    (SELECT COUNT(*) FROM tb_sales WHERE market_id=5 && date BETWEEN '$param_date_1' AND '$param_date' and day = a.day) as JUMLAH1 
    FROM (SELECT DISTINCT month, day FROM tb_freebies WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY day ORDER BY year ASC, month DESC, day ASC) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $total = $row["SUM"]+$row["SUM1"];
        $jumlah = $row["JUMLAH"]+$row["JUMLAH1"];
        $output[] = [
            'month'   => $row['day'].'/'.$row['month'],
            'TOTAL'  => $total,
            'JUMLAH'  => $jumlah,
        ];
    }
}elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
    $param_date_1   = date('Y-m-d', strtotime("-12 month"));
    $param_date_2   = date('Y-m-d', strtotime("-24 month"));

    $endd = date('Y-m-01');
    $start = date('Y-m-01', strtotime("-12 month"));   

    $start2 = new DateTime( $start );
    $interval = new DateInterval('P1M');
    $end2 = new DateTime( $endd );
    $end2 = $end2->modify( '+1 month' ); 
    $daterange = new DatePeriod($start2, $interval, $end2);

    foreach($daterange as $dt){
        $date_value = $dt->format("Y-m-d");
        $sql_sum1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, SUM(earnings) AS TOTAL_SUM1 FROM tb_freebies WHERE market_id = 5 && date LIKE '%$date_value%'");
        $sql_sum2 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, SUM(earnings) AS TOTAL_SUM2 FROM tb_sales WHERE market_id = 5 && date LIKE '%$date_value%'");
        $sql_count1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL_COUNT1 FROM tb_freebies WHERE market_id = 5 && date LIKE '%$date_value%'");
        $sql_count2 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL_COUNT2 FROM tb_sales WHERE market_id = 5 && date LIKE '%$date_value%'");
        
        while($row1 = mysqli_fetch_array($sql_sum1)){
            $rows1[] = $row1;

        }

        while($row2 = mysqli_fetch_array($sql_sum2)){
            $rows2[] = $row2;

        }

        while($data1 = mysqli_fetch_array($sql_count1)){
            $datas1[] = $data1;

        }

        while($data2 = mysqli_fetch_array($sql_count2)){
            $datas2[] = $data2;

        }
    }

    $combinedArray = array_replace_recursive($rows1, $rows2, $datas1, $datas2);

    foreach( $combinedArray as $value ) {
        if(isset($value['TOTAL_SUM1'])){
            $value['TOTAL_SUM1'] = $value['TOTAL_SUM1'];
        }else{
            $value['TOTAL_SUM1'] = 0;
        }

        if(isset($value['TOTAL_SUM2'])){
            $value['TOTAL_SUM2'] = $value['TOTAL_SUM2'];
        }else{
            $value['TOTAL_SUM2'] = 0;
        }

        if(isset($value['TOTAL_COUNT1'])){
            $value['TOTAL_COUNT1'] = $value['TOTAL_COUNT1'];
        }else{
            $value['TOTAL_COUNT1'] = 0;
        }

        if(isset($value['TOTAL_COUNT2'])){
            $value['TOTAL_COUNT2'] = $value['TOTAL_COUNT2'];
        }else{
            $value['TOTAL_COUNT2'] = 0;
        }

        $total_count = $value['TOTAL_COUNT1']+$value['TOTAL_COUNT2'];
        $total_sum = $value['TOTAL_SUM1']+$value['TOTAL_SUM2'];

        $output[] = [
            'month'   => $value['month'].'/'.$value["year"],
            'TOTAL'  => $total_sum,
            'JUMLAH'  => $total_count,
        ];
    }
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
    
    $update_sql = mysqli_query($connect, "SELECT * FROM tb_freebies WHERE date BETWEEN '$date' AND '$todate' GROUP BY date");
    
    if(mysqli_num_rows($update_sql) > 50){
        $query="SELECT date, year, month, a.day, 
        (SELECT SUM(earnings) FROM tb_freebies WHERE market_id=5 && date BETWEEN '$date' AND '$todate' and day = a.day) as SUM, 
        (SELECT SUM(earnings) FROM tb_sales WHERE market_id=5 && date BETWEEN '$date' AND '$todate' and day = a.day) as SUM1, 
        (SELECT COUNT(*) FROM tb_freebies WHERE market_id=5 && date BETWEEN '$date' AND '$todate' and day = a.day) as JUMLAH, 
        (SELECT COUNT(*) FROM tb_sales WHERE market_id=5 && date BETWEEN '$date' AND '$todate' and day = a.day) as JUMLAH1 
        FROM (SELECT DISTINCT date, year, day, month FROM tb_freebies WHERE date BETWEEN '$date' AND '$todate' GROUP BY month ORDER BY year DESC, month DESC) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $total = $row["SUM"]+$row["SUM1"];
            $jumlah = $row["JUMLAH"]+$row["JUMLAH1"];
            $output[] = [
                'month'   => $month[$row["month"]].'/'.$row['year'],
                'TOTAL'  => $total,
                'JUMLAH'  => $jumlah,
            ];
        }
    }else{
        // $query="SELECT date, year, month, a.day, 
        // (SELECT SUM(earnings) FROM tb_freebies WHERE market_id=5 && date BETWEEN '$date' AND '$todate' and day = a.day) as SUM, 
        // (SELECT SUM(earnings) FROM tb_sales WHERE market_id=5 && date BETWEEN '$date' AND '$todate' and day = a.day) as SUM1, 
        // (SELECT COUNT(*) FROM tb_freebies WHERE market_id=5 && date BETWEEN '$date' AND '$todate' and day = a.day) as JUMLAH, 
        // (SELECT COUNT(*) FROM tb_sales WHERE market_id=5 && date BETWEEN '$date' AND '$todate' and day = a.day) as JUMLAH1 
        // FROM (SELECT DISTINCT date, year, day, month FROM tb_freebies WHERE date BETWEEN '$date' AND '$todate' GROUP BY date ASC) a";
        // $result = mysqli_query($connect, $query);
        // while($row =mysqli_fetch_array($result)) {
        //     $total = $row["SUM"]+$row["SUM1"];
        //     $jumlah = $row["JUMLAH"]+$row["JUMLAH1"];
        //     $output[] = [
        //         'month'   => $row['day'].'/'.$row['month'],
        //         'TOTAL'  => $total,
        //         'JUMLAH'  => $jumlah,
        //     ];
        // }

        error_reporting(0);

        $begin = new DateTime( $date );
        $end = new DateTime( $todate );
        $end = $end->modify( '+1 day' ); 

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);
        $rows1 = array();
        $rows2 = array();
        $datas1 = array();
        $datas2 = array();
        
        foreach($daterange as $dt){
            $date_value = $dt->format("Y-m-d");
            $sql_sum1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, SUM(earnings) AS TOTAL_SUM1 FROM tb_freebies WHERE market_id = 5 && date = '$date_value'");
            $sql_sum2 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, SUM(earnings) AS TOTAL_SUM2 FROM tb_sales WHERE market_id = 5 && date = '$date_value'");
            $sql_count1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL_COUNT1 FROM tb_freebies WHERE market_id = 5 && date = '$date_value'");
            $sql_count2 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL_COUNT2 FROM tb_sales WHERE market_id = 5 && date = '$date_value'");
            
            while($row1 = mysqli_fetch_array($sql_sum1)){
                $rows1[] = $row1;

            }

            while($row2 = mysqli_fetch_array($sql_sum2)){
                $rows2[] = $row2;

            }

            while($data1 = mysqli_fetch_array($sql_count1)){
                $datas1[] = $data1;

            }

            while($data2 = mysqli_fetch_array($sql_count2)){
                $datas2[] = $data2;

            }
        }

        $combinedArray = array_replace_recursive($rows1, $rows2, $datas1, $datas2);

        foreach( $combinedArray as $value ) {
            if(isset($value['TOTAL_SUM1'])){
                $value['TOTAL_SUM1'] = $value['TOTAL_SUM1'];
            }else{
                $value['TOTAL_SUM1'] = 0;
            }
    
            if(isset($value['TOTAL_SUM2'])){
                $value['TOTAL_SUM2'] = $value['TOTAL_SUM2'];
            }else{
                $value['TOTAL_SUM2'] = 0;
            }
    
            if(isset($value['TOTAL_COUNT1'])){
                $value['TOTAL_COUNT1'] = $value['TOTAL_COUNT1'];
            }else{
                $value['TOTAL_COUNT1'] = 0;
            }
    
            if(isset($value['TOTAL_COUNT2'])){
                $value['TOTAL_COUNT2'] = $value['TOTAL_COUNT2'];
            }else{
                $value['TOTAL_COUNT2'] = 0;
            }
    
            $total_count = $value['TOTAL_COUNT1']+$value['TOTAL_COUNT2'];
            $total_sum = $value['TOTAL_SUM1']+$value['TOTAL_SUM2'];
    
            $output[] = [
                'month'   => $value['day'].'/'.$value["month"],
                'TOTAL'  => $total_sum,
                'JUMLAH'  => $total_count
            ];
        }
    }

}elseif($date_range == "Last Month"){
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
    $rows1 = array();
    $rows2 = array();
    $datas1 = array();
    $datas2 = array();

    foreach($daterange as $dt){
        $date_value = $dt->format("Y-m-d");
        $sql_sum1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, SUM(earnings) AS TOTAL_SUM1 FROM tb_freebies WHERE market_id = 5 && date = '$date_value'");
        $sql_sum2 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, SUM(earnings) AS TOTAL_SUM2 FROM tb_sales WHERE market_id = 5 && date = '$date_value'");
        $sql_count1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL_COUNT1 FROM tb_freebies WHERE market_id = 5 && date = '$date_value'");
        $sql_count2 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL_COUNT2 FROM tb_sales WHERE market_id = 5 && date = '$date_value'");
        
        while($row1 = mysqli_fetch_array($sql_sum1)){
            $rows1[] = $row1;

        }

        while($row2 = mysqli_fetch_array($sql_sum2)){
            $rows2[] = $row2;

        }

        while($data1 = mysqli_fetch_array($sql_count1)){
            $datas1[] = $data1;

        }

        while($data2 = mysqli_fetch_array($sql_count2)){
            $datas2[] = $data2;

        }
    }

    $combinedArray = array_replace_recursive($rows1, $rows2, $datas1, $datas2);

    foreach( $combinedArray as $value ) {
        if(isset($value['TOTAL_SUM1'])){
            $value['TOTAL_SUM1'] = $value['TOTAL_SUM1'];
        }else{
            $value['TOTAL_SUM1'] = 0;
        }

        if(isset($value['TOTAL_SUM2'])){
            $value['TOTAL_SUM2'] = $value['TOTAL_SUM2'];
        }else{
            $value['TOTAL_SUM2'] = 0;
        }

        if(isset($value['TOTAL_COUNT1'])){
            $value['TOTAL_COUNT1'] = $value['TOTAL_COUNT1'];
        }else{
            $value['TOTAL_COUNT1'] = 0;
        }

        if(isset($value['TOTAL_COUNT2'])){
            $value['TOTAL_COUNT2'] = $value['TOTAL_COUNT2'];
        }else{
            $value['TOTAL_COUNT2'] = 0;
        }

        $total_count = $value['TOTAL_COUNT1']+$value['TOTAL_COUNT2'];
        $total_sum = $value['TOTAL_SUM1']+$value['TOTAL_SUM2'];

        $output[] = [
            'month'   => $value['day'].'/'.$value["month"],
            'TOTAL'  => $total_sum,
            'JUMLAH'  => $total_count
        ];
    }

}elseif($date_range == "Last Year"){
    $param_year_1   = date('Y', strtotime("-1 year"));
    $param_year_2   = date('Y', strtotime("-2 year"));

    $query="SELECT year, a.month, 
    (SELECT SUM(earnings) FROM tb_freebies WHERE market_id=5 && year=$param_year_1 and month = a.month) as SUM, 
    (SELECT SUM(earnings) FROM tb_sales WHERE market_id=5 && year=$param_year_1 and month = a.month) as SUM1, 
    (SELECT COUNT(*) FROM tb_freebies WHERE market_id=5 && year=$param_year_1 and month = a.month) as JUMLAH, 
    (SELECT COUNT(*) FROM tb_sales WHERE market_id=5 && year=$param_year_1 and month = a.month) as JUMLAH1 
    FROM (SELECT DISTINCT year, month FROM tb_freebies WHERE year=$param_year_1 GROUP BY month, year ORDER BY year ASC, month ASC) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $total = $row["SUM"]+$row["SUM1"];
        $jumlah = $row["JUMLAH"]+$row["JUMLAH1"];
        $output[] = [
            'month'   => $month[$row["month"]].'/'.$row['year'],
            'TOTAL'  => $total,
            'JUMLAH'  => $jumlah,
        ];
    }
}elseif($date_range == "All Time"){

    $query="SELECT a.year, 
    (SELECT SUM(earnings) FROM tb_freebies WHERE market_id=5 && year = a.year) as SUM, 
    (SELECT SUM(earnings) FROM tb_sales WHERE market_id=5 && year = a.year) as SUM1, 
    (SELECT COUNT(*) FROM tb_freebies WHERE market_id=5 && year = a.year) as JUMLAH, 
    (SELECT COUNT(*) FROM tb_sales WHERE market_id=5 && year = a.year) as JUMLAH1 
    FROM (SELECT DISTINCT year FROM tb_freebies GROUP BY year ASC) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $total = $row["SUM"]+$row["SUM1"];
        $jumlah = $row["JUMLAH"]+$row["JUMLAH1"];
        $output[] = [
            'month'   => $row["year"],
            'TOTAL'  => $total,
            'JUMLAH'  => $jumlah,
        ];
    }
}elseif($date_range == "This Year"){
    $param_year_1   = date('Y', strtotime("-1 year"));

    $query="SELECT year, a.month, 
    (SELECT SUM(earnings) FROM tb_freebies WHERE market_id=5 && year=$param_year and month = a.month) as SUM, 
    (SELECT SUM(earnings) FROM tb_sales WHERE market_id=5 && year=$param_year and month = a.month) as SUM1, 
    (SELECT COUNT(*) FROM tb_freebies WHERE market_id=5 && year=$param_year and month = a.month) as JUMLAH, 
    (SELECT COUNT(*) FROM tb_sales WHERE market_id=5 && year=$param_year and month = a.month) as JUMLAH1 
    FROM (SELECT DISTINCT year, month FROM tb_freebies WHERE year=$param_year GROUP BY month, year ORDER BY year ASC, month ASC) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        $total = $row["SUM"]+$row["SUM1"];
        $jumlah = $row["JUMLAH"]+$row["JUMLAH1"];
        $output[] = [
            'month'   => $month[$row["month"]].'/'.$row['year'],
            'TOTAL'  => $total,
            'JUMLAH'  => $jumlah,
        ];
    }
}

echo json_encode($output);
