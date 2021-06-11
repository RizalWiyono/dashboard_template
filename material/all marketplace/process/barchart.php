<?php
include('../../../src/connection/connection.php');
$market = $_POST['market'];
$date_range = $_POST['this_value'];
$month = array("1" => "Jan", "2" => "Feb", "3" => "Mar", "4" => "Apr", "5" => "May", "6" => "Jun", "7" => "Jul", "8" => "Aug", "9" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");              
$market_sup = array("All Marketplace" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5");
$market_id =$market_sup[$market];

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

if($market_id == 0){
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
            $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_sales WHERE date = '$date_value'");
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
            $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value2', 9) AS day, SUBSTR('$date_value2', 1, 4) AS year, SUBSTR('$date_value2', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_sales WHERE date = '$date_value2'");
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
        

    }elseif($date_range == '30 Days'){
        
        $previous_year_month    = date('Y-m', strtotime("-1 month"));
        $previous_date_month    = date('Y-m-d', strtotime("-1 month"));
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));

        $endd = date('Y-m-d');
        $start = date('Y-m-d', strtotime("-30 day"));

        $endd2 = date('Y-m-d', strtotime("-30 day"));
        $start2 = date('Y-m-d', strtotime("-60 day"));

        $begin = new DateTime( $start );
        $end = new DateTime( $endd );
        $end = $end->modify( '+1 day' ); 

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);
        $rows = array();
        $rowss = array();

        foreach($daterange as $dt){
            $date_value = $dt->format("Y-m-d");
            $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_sales WHERE date = '$date_value'");
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
            $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value2', 9) AS day, SUBSTR('$date_value2', 1, 4) AS year, SUBSTR('$date_value2', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_sales WHERE date = '$date_value2'");
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
    }elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));
        $param_date_2   = date('Y-m-d', strtotime("-24 month"));

        $sql_market1 = mysqli_query($connect, "SELECT (ROW_NUMBER() OVER(ORDER BY year ASC, month ASC)) AS NUMBER , year, month, COUNT(*) AS TOTAL FROM tb_sales WHERE date BETWEEN '$param_date_2' AND '$param_date_1' GROUP BY year, month ORDER BY NUMBER ASC");
        $sql_market2 = mysqli_query($connect, "SELECT (ROW_NUMBER() OVER(ORDER BY year ASC, month ASC)) AS NUMBER , year, month, COUNT(*) AS JUMLAH FROM tb_sales WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year, month ORDER BY NUMBER ASC");

        $rows = array();
        while($row = mysqli_fetch_array($sql_market1)){
            $rows[] = $row;

        }
        $rowss = array();
        while($data = mysqli_fetch_array($sql_market2)){
            $rowss[] = $data;

        }

        $combinedArray = array_replace_recursive(
            array_combine(array_column($rows, "NUMBER"), $rows),
            array_combine(array_column($rowss, "NUMBER"), $rowss)
        );


        foreach( $combinedArray as $value ) {
            if(isset($value['JUMLAH'])){
                $value['JUMLAH'] = $value['JUMLAH'];
            }else{
                $value['JUMLAH'] = 0;
            }

            if(isset($value['TOTAL'])){
                $value['TOTAL'] = $value['TOTAL'];
            }else{
                $value['TOTAL'] = 0;
            }

            $output[] = [
                    'month'   => $month[$value["month"]].'/'.$value["year"],
                    'TOTAL'  => $value["TOTAL"],
                    'JUMLAH'  => $value["JUMLAH"],
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
        
        $update_sql = mysqli_query($connect, "SELECT date, year, month, a.day, 
        (SELECT COUNT(*) FROM tb_sales WHERE date BETWEEN '$date_1' AND '$date_2' and day = a.day) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales WHERE date BETWEEN '$date' AND '$todate' and day = a.day) as JUMLAH 
        FROM (SELECT DISTINCT date, year, day, month FROM tb_sales WHERE date BETWEEN '$date' AND '$todate' GROUP BY date ASC) a");
        

        if(mysqli_num_rows($update_sql) > 50){
            $sql_market1 = mysqli_query($connect, "SELECT (ROW_NUMBER() OVER(ORDER BY year ASC, month ASC)) AS NUMBER , year, month, COUNT(*) AS TOTAL FROM tb_sales WHERE date BETWEEN '$date_1' AND '$date_2' GROUP BY year, month ORDER BY NUMBER ASC");
            $sql_market2 = mysqli_query($connect, "SELECT (ROW_NUMBER() OVER(ORDER BY year ASC, month ASC)) AS NUMBER , year, month, COUNT(*) AS JUMLAH FROM tb_sales WHERE date BETWEEN '$date' AND '$todate' GROUP BY year, month ORDER BY NUMBER ASC");

            $rows = array();
            while($row = mysqli_fetch_array($sql_market1)){
                $rows[] = $row;

            }
            $rowss = array();
            while($data = mysqli_fetch_array($sql_market2)){
                $rowss[] = $data;

            }

            $combinedArray = array_replace_recursive(
                array_combine(array_column($rows, "NUMBER"), $rows),
                array_combine(array_column($rowss, "NUMBER"), $rowss)
            );


            foreach( $combinedArray as $value ) {
                if(isset($value['JUMLAH'])){
                    $value['JUMLAH'] = $value['JUMLAH'];
                }else{
                    $value['JUMLAH'] = 0;
                }

                if(isset($value['TOTAL'])){
                    $value['TOTAL'] = $value['TOTAL'];
                }else{
                    $value['TOTAL'] = 0;
                }

                $output[] = [
                        'month'   => $month[$value["month"]].'/'.$value["year"],
                        'TOTAL'  => $value["TOTAL"],
                        'JUMLAH'  => $value["JUMLAH"],
                    ];
            }
        }else{
            $sql_popular = mysqli_query($connect, "SELECT (ROW_NUMBER() OVER(ORDER BY date ASC)) AS NUMBER , day, year, month, COUNT(*) AS JUMLAH FROM tb_sales WHERE date BETWEEN '$date' AND '$todate' GROUP BY date ORDER BY NUMBER ASC");
            $rows = array();
            $rowss = array();
            while($data = mysqli_fetch_array($sql_popular)){
                $rowss[] = $data;
                $cb = $data['year'].'-'.$data['month'].'-'.$data['day'];
                $year_dates3 = substr($cb, 0, 4);
                $month_dates3 = substr($cb, 5, 2)-1;
                $day_date3 = substr($cb, 8, 2);

                if($month_dates3 == 0){
                    $year_date3 = $year_dates3-1;
                    $month_date3 = 12;
                    $day_date3 = substr($cb, 8, 2);
                }else{
                    $year_date3 = substr($cb, 0, 4);
                    $month_date3 = substr($cb, 5, 2)-1;
                    $day_date3 = substr($cb, 8, 2);
                }

                if($month_dates3 < 10){
                    $month_date3 = '0'.$month_date3;
                }else {
                    $month_date3 = $month_date3;
                }
                $date_3 = $year_date3.'-'.$month_date3.'-'.$day_date3;
                
                $sql_market = mysqli_query($connect, "SELECT SUBSTR('$date_3', 9) AS day, SUBSTR('$date_3', 1, 4) AS year, SUBSTR('$date_3', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_sales WHERE date = '$date_3'");
                while($row = mysqli_fetch_array($sql_market)){
                    $rows[] = $row;
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
        }
    }elseif($date_range == "Last Month"){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
        $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

        $start = date('Y-m-01', strtotime("-1 month"));
        $end = date("Y-m-t", strtotime($previous_year_month_1));

        $query="SELECT month, a.day, 
        (SELECT COUNT(*) FROM tb_sales WHERE date LIKE '%$previous_year_month_2%' and day = a.day) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales WHERE date LIKE '%$previous_year_month_1%' and day = a.day) as JUMLAH 
        FROM (SELECT DISTINCT month, day FROM tb_sales WHERE date BETWEEN '$start' AND '$end' GROUP BY day ASC) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $output[] = [
                'month'   => $row['day'].'/'.$row["month"],
                'TOTAL'  => $row["TOTAL"],
                'JUMLAH'  => $row["JUMLAH"],
            ];
        }
    }elseif($date_range == "Last Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));
        $param_year_2   = date('Y', strtotime("-2 year"));

        $query="SELECT year, a.month, 
        (SELECT COUNT(*) FROM tb_sales WHERE year=$param_year_2 and month = a.month) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales WHERE year=$param_year_1 and month = a.month) as JUMLAH 
        FROM (SELECT DISTINCT year, month FROM tb_sales WHERE year=$param_year_1 GROUP BY month, year ORDER BY year ASC, month ASC) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $output[] = [
                'month'   => $month[$row["month"]].'/'.$row['year'],
                'TOTAL'  => $row["TOTAL"],
                'JUMLAH'  => $row["JUMLAH"],
            ];
        }
    }elseif($date_range == "All Time"){
        $query="SELECT a.year, 
        (SELECT  COUNT(*) FROM tb_sales WHERE year = a.year) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales WHERE year = a.year) as JUMLAH 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $output[] = [
                'month'   => $row["year"],
                'TOTAL'  => $row["TOTAL"],
                'JUMLAH'  => $row["JUMLAH"],
            ];
        }
    }elseif($date_range == "This Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $query="SELECT year, a.month, 
        (SELECT  COUNT(*) FROM tb_sales WHERE year=$param_year_1 and month = a.month) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales WHERE year=$param_year and month = a.month) as JUMLAH 
        FROM (SELECT DISTINCT year, month FROM tb_sales WHERE year=$param_year GROUP BY month, year ORDER BY year ASC, month ASC) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $output[] = [
                'month'   => $month[$row["month"]].'/'.$row['year'],
                'TOTAL'  => $row["TOTAL"],
                'JUMLAH'  => $row["JUMLAH"],
            ];
        }
    }
}else{
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
            $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_sales WHERE market_id=$market_id && date = '$date_value'");
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
            $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value2', 9) AS day, SUBSTR('$date_value2', 1, 4) AS year, SUBSTR('$date_value2', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_sales WHERE market_id=$market_id && date = '$date_value2'");
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

    }elseif($date_range == '30 Days'){

        $previous_year_month    = date('Y-m', strtotime("-1 month"));
        $previous_date_month    = date('Y-m-d', strtotime("-1 month"));
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));

        $endd = date('Y-m-d');
        $start = date('Y-m-d', strtotime("-30 day"));

        $endd2 = date('Y-m-d', strtotime("-30 day"));
        $start2 = date('Y-m-d', strtotime("-60 day"));

        $begin = new DateTime( $start );
        $end = new DateTime( $endd );
        $end = $end->modify( '+1 day' ); 

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);
        $rows = array();
        $rowss = array();

        foreach($daterange as $dt){
            $date_value = $dt->format("Y-m-d");
            $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_sales WHERE market_id='$market_id' && date = '$date_value'");
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
            $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value2', 9) AS day, SUBSTR('$date_value2', 1, 4) AS year, SUBSTR('$date_value2', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_sales WHERE market_id='$market_id' && date = '$date_value2'");
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
    }elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));
        $param_date_2   = date('Y-m-d', strtotime("-24 month"));

        $param_date_1   = date('Y-m-d', strtotime("-12 month"));
        $param_date_2   = date('Y-m-d', strtotime("-24 month"));

        $sql_market1 = mysqli_query($connect, "SELECT (ROW_NUMBER() OVER(ORDER BY year ASC, month ASC)) AS NUMBER , year, month, COUNT(*) AS TOTAL FROM tb_sales WHERE market_id='$market_id' && date BETWEEN '$param_date_2' AND '$param_date_1' GROUP BY year, month ORDER BY NUMBER ASC");
        $sql_market2 = mysqli_query($connect, "SELECT (ROW_NUMBER() OVER(ORDER BY year ASC, month ASC)) AS NUMBER , year, month, COUNT(*) AS JUMLAH FROM tb_sales WHERE market_id='$market_id' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year, month ORDER BY NUMBER ASC");

        $rows = array();
        while($row = mysqli_fetch_array($sql_market1)){
            $rows[] = $row;

        }
        $rowss = array();
        while($data = mysqli_fetch_array($sql_market2)){
            $rowss[] = $data;

        }

        $combinedArray = array_replace_recursive(
            array_combine(array_column($rows, "NUMBER"), $rows),
            array_combine(array_column($rowss, "NUMBER"), $rowss)
        );


        foreach( $combinedArray as $value ) {
            if(isset($value['JUMLAH'])){
                $value['JUMLAH'] = $value['JUMLAH'];
            }else{
                $value['JUMLAH'] = 0;
            }

            if(isset($value['TOTAL'])){
                $value['TOTAL'] = $value['TOTAL'];
            }else{
                $value['TOTAL'] = 0;
            }
            
            $output[] = [
                'month'   => $month[$value["month"]].'/'.$value["year"],
                'TOTAL'  => $value["TOTAL"],
                'JUMLAH'  => $value["JUMLAH"],
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

        $update_sql = mysqli_query($connect, "SELECT date, year, month, a.day, 
        (SELECT COUNT(*) FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$date_1' AND '$date_2' and day = a.day) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$date' AND '$todate' and day = a.day) as JUMLAH 
        FROM (SELECT DISTINCT date, year, day, month FROM tb_sales WHERE market_id='$market_id' && date BETWEEN '$date' AND '$todate' GROUP BY date ASC) a");

        if(mysqli_num_rows($update_sql) > 50){
            $sql_market1 = mysqli_query($connect, "SELECT (ROW_NUMBER() OVER(ORDER BY year ASC, month ASC)) AS NUMBER , year, month, COUNT(*) AS TOTAL FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$date_1' AND '$date_2' GROUP BY year, month ORDER BY NUMBER ASC");
            $sql_market2 = mysqli_query($connect, "SELECT (ROW_NUMBER() OVER(ORDER BY year ASC, month ASC)) AS NUMBER , year, month, COUNT(*) AS JUMLAH FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$date' AND '$todate' GROUP BY year, month ORDER BY NUMBER ASC");

            $rows = array();
            while($row = mysqli_fetch_array($sql_market1)){
                $rows[] = $row;

            }
            $rowss = array();
            while($data = mysqli_fetch_array($sql_market2)){
                $rowss[] = $data;

            }

            $combinedArray = array_replace_recursive(
                array_combine(array_column($rows, "NUMBER"), $rows),
                array_combine(array_column($rowss, "NUMBER"), $rowss)
            );


            foreach( $combinedArray as $value ) {
                if(isset($value['JUMLAH'])){
                    $value['JUMLAH'] = $value['JUMLAH'];
                }else{
                    $value['JUMLAH'] = 0;
                }

                if(isset($value['TOTAL'])){
                    $value['TOTAL'] = $value['TOTAL'];
                }else{
                    $value['TOTAL'] = 0;
                }

                $output[] = [
                        'month'   => $month[$value["month"]].'/'.$value["year"],
                        'TOTAL'  => $value["TOTAL"],
                        'JUMLAH'  => $value["JUMLAH"],
                    ];
            }
        }else{
            $sql_popular = mysqli_query($connect, "SELECT (ROW_NUMBER() OVER(ORDER BY date ASC)) AS NUMBER , day, year, month, COUNT(*) AS JUMLAH FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$date' AND '$todate' GROUP BY date ORDER BY NUMBER ASC");
            $rows = array();
            $rowss = array();
            while($data = mysqli_fetch_array($sql_popular)){
                $rowss[] = $data;
                $cb = $data['year'].'-'.$data['month'].'-'.$data['day'];
                $year_dates3 = substr($cb, 0, 4);
                $month_dates3 = substr($cb, 5, 2)-1;
                $day_date3 = substr($cb, 8, 2);

                if($month_dates3 == 0){
                    $year_date3 = $year_dates3-1;
                    $month_date3 = 12;
                    $day_date3 = substr($cb, 8, 2);
                }else{
                    $year_date3 = substr($cb, 0, 4);
                    $month_date3 = substr($cb, 5, 2)-1;
                    $day_date3 = substr($cb, 8, 2);
                }

                if($month_dates3 < 10){
                    $month_date3 = '0'.$month_date3;
                }else {
                    $month_date3 = $month_date3;
                }
                $date_3 = $year_date3.'-'.$month_date3.'-'.$day_date3;
                
                $sql_market = mysqli_query($connect, "SELECT SUBSTR('$date_3', 9) AS day, SUBSTR('$date_3', 1, 4) AS year, SUBSTR('$date_3', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_sales WHERE market_id=$market_id && date = '$date_3'");
                while($row = mysqli_fetch_array($sql_market)){
                    $rows[] = $row;
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
        }
    }elseif($date_range == "Last Month"){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
        $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

        $start = date('Y-m-01', strtotime("-1 month"));
        $end = date("Y-m-t", strtotime($previous_year_month_1));

        $query="SELECT month, a.day, 
        (SELECT COUNT(*) FROM tb_sales WHERE market_id=$market_id && date LIKE '%$previous_year_month_2%' and day = a.day) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales WHERE market_id=$market_id && date LIKE '%$previous_year_month_1%' and day = a.day) as JUMLAH 
        FROM (SELECT DISTINCT month, day FROM tb_sales WHERE date BETWEEN '$start' AND '$end' GROUP BY day ASC) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $output[] = [
                'month'   => $row['day'].'/'.$row["month"],
                'TOTAL'  => $row["TOTAL"],
                'JUMLAH'  => $row["JUMLAH"],
            ];
        }
    }elseif($date_range == "Last Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));
        $param_year_2   = date('Y', strtotime("-2 year"));

        $query="SELECT year, a.month, 
        (SELECT COUNT(*) FROM tb_sales WHERE market_id=$market_id && year=$param_year_2 and month = a.month) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales WHERE market_id=$market_id && year=$param_year_1 and month = a.month) as JUMLAH 
        FROM (SELECT DISTINCT year, month FROM tb_sales WHERE market_id=$market_id && year=$param_year_1 GROUP BY month, year ORDER BY year ASC, month ASC) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $output[] = [
                'month'   => $month[$row["month"]].'/'.$row['year'],
                'TOTAL'  => $row["TOTAL"],
                'JUMLAH'  => $row["JUMLAH"],
            ];
        }
    }elseif($date_range == "All Time"){
        $query="SELECT a.year, 
        (SELECT  COUNT(*) FROM tb_sales WHERE market_id=$market_id && year = a.year) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales WHERE market_id=$market_id && year = a.year) as JUMLAH 
        FROM (SELECT DISTINCT year FROM tb_sales WHERE market_id='$market_id' GROUP BY year ASC) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $output[] = [
                'month'   => $row["year"],
                'TOTAL'  => $row["TOTAL"],
                'JUMLAH'  => $row["JUMLAH"],
            ];
        }
    }elseif($date_range == "This Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $query="SELECT year, a.month, 
        (SELECT  COUNT(*) FROM tb_sales WHERE market_id=$market_id && year=$param_year_1  and month = a.month) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales WHERE market_id=$market_id && year=$param_year and month = a.month) as JUMLAH 
        FROM (SELECT DISTINCT year, month FROM tb_sales WHERE market_id=$market_id && year=$param_year GROUP BY month, year ORDER BY year ASC, month ASC) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $output[] = [
                'month'   => $month[$row["month"]].'/'.$row['year'],
                'TOTAL'  => $row["TOTAL"],
                'JUMLAH'  => $row["JUMLAH"],
            ];
        }
    }
}
echo json_encode($output);
