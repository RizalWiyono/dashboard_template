<?php
include('../../../../src/connection/connection.php');
$date = $_POST['date'];
$type = $_POST['type'];
$market_sup = array("All Marketplace" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5");
$market_id =$market_sup[$type];

$month = array("1" => "Jan", "2" => "Feb", "3" => "Mar", "4" => "Apr", "5" => "May", "6" => "Jun", "7" => "Jul", "8" => "Aug", "9" => "Sep", "10" => "Oct", "11" => "Nov", "12" => "Dec");              

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

if($market_id == 0){
    if($date == "One Month Last" && !isset($_POST['todate'])){
        $previous_year_month    = date('Y-m', strtotime("-1 month"));
        $previous_date_month    = date('Y-m-d', strtotime("-1 month"));

        $start = date('Y-m-01');
        $endd = date('Y-m-t');        

        $begin = new DateTime( $start );
        $end = new DateTime( $endd );
        $end = $end->modify( '+1 day' ); 

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);
        $rows = array();
        $rowss = array();

        foreach($daterange as $dt){
            $date_value = $dt->format("Y-m-d");
            $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on = '$date_value'");
            $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id!=5 && date = '$date_value'");
            while($row = mysqli_fetch_array($sql_tb_catalog)){
                $rows[] = $row;

            }

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

    }elseif($date == "30 Days" && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-30 day"));
        $param_date_2   = date('Y-m-d', strtotime("-60 day"));

        $begin = new DateTime( $param_date_1 );
        $end = new DateTime( $param_date );
        $end = $end->modify( '+1 day' ); 

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);
        $rows = array();
        $rowss = array();

        foreach($daterange as $dt){
            $date_value = $dt->format("Y-m-d");
            $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on = '$date_value'");
            $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id!=5 && date = '$date_value'");
            while($row = mysqli_fetch_array($sql_tb_catalog)){
                $rows[] = $row;

            }

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

    }elseif($date == "One Year Last" && !isset($_POST['todate'])){
        error_reporting(0);
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));
        $param_date_2   = date('Y-m-d', strtotime("-24 month"));

        $sql_tb_catalog = mysqli_query($connect, "SELECT DATE_FORMAT(upload_on, '%Y-%m') AS param_date, YEAR(upload_on) AS year, MONTH(upload_on) AS month, upload_on, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$param_date_1' AND '$param_date' GROUP BY MONTH(upload_on), YEAR(upload_on) ORDER BY YEAR(upload_on) ASC, MONTH(upload_on) ASC");
        $sql_tb_update = mysqli_query($connect, "SELECT DATE_FORMAT(date, '%Y-%m') AS param_date, YEAR(date) AS year, MONTH(date) AS month, date, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id!=5 && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY MONTH(date), YEAR(date) ORDER BY YEAR(date) ASC, MONTH(date) ASC");
        $rows = array();
        while($row = mysqli_fetch_array($sql_tb_catalog)){
            $rows[] = $row;

        }
        $rowss = array();
        while($data = mysqli_fetch_array($sql_tb_update)){
            $rowss[] = $data;

        }

        $combinedArray = array_replace_recursive(
            array_combine(array_column($rows, "param_date"), $rows),
            array_combine(array_column($rowss, "param_date"), $rowss)
        );

        foreach( $combinedArray as $value ) {
            $output[] = [
            'month'   => $value['year'].'/'.$value['month'],
            'TOTAL'  => $value['TOTAL'],
            'JUMLAH'  => $value['JUMLAH'],
            ];
        }

    }elseif($date == "Last Month" && !isset($_POST['todate'])){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
        $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

        $start = date('Y-m-01', strtotime("-1 month"));
        $endd = date("Y-m-t", strtotime($previous_year_month_1));

        $begin = new DateTime( $start );
        $end = new DateTime( $endd );
        $end = $end->modify( '+1 day' ); 

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);
        $rows = array();
        $rowss = array();

        foreach($daterange as $dt){
            $date_value = $dt->format("Y-m-d");
            $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on = '$date_value'");
            $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id!=5 && date = '$date_value'");
            while($row = mysqli_fetch_array($sql_tb_catalog)){
                $rows[] = $row;

            }

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

    }elseif($date == "This Year" && !isset($_POST['todate'])){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $sql_tb_catalog = mysqli_query($connect, "SELECT DATE_FORMAT(upload_on, '%Y-%m') AS param_date, YEAR(upload_on) AS year, MONTH(upload_on) AS month, upload_on, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$param_year%' GROUP BY MONTH(upload_on), YEAR(upload_on) ORDER BY YEAR(upload_on) ASC, MONTH(upload_on) ASC");
        $sql_tb_update = mysqli_query($connect, "SELECT DATE_FORMAT(date, '%Y-%m') AS param_date, YEAR(date) AS year, MONTH(date) AS month, date, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id!=5 && date LIKE '%$param_year%' GROUP BY MONTH(date), YEAR(date) ORDER BY YEAR(date) ASC, MONTH(date) ASC");
        $rows = array();
        while($row = mysqli_fetch_array($sql_tb_catalog)){
            $rows[] = $row;

        }
        $rowss = array();
        while($data = mysqli_fetch_array($sql_tb_update)){
            $rowss[] = $data;

        }

        $combinedArray = array_replace_recursive(
            array_combine(array_column($rows, "param_date"), $rows),
            array_combine(array_column($rowss, "param_date"), $rowss)
        );

        foreach( $combinedArray as $value ) {
            $output[] = [
            'month'   => $value['year'].'/'.$value['month'],
            'TOTAL'  => $value['TOTAL'],
            'JUMLAH'  => $value['JUMLAH'],
            ];
        }

    }elseif($date == "Last Year" && !isset($_POST['todate'])){
        $param_year_1   = date('Y', strtotime("-1 year"));
        $param_year_2   = date('Y', strtotime("-2 year"));

        $sql_tb_catalog = mysqli_query($connect, "SELECT DATE_FORMAT(upload_on, '%Y-%m') AS param_date, YEAR(upload_on) AS year, MONTH(upload_on) AS month, upload_on, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$param_year_1%' GROUP BY MONTH(upload_on), YEAR(upload_on) ORDER BY YEAR(upload_on) ASC, MONTH(upload_on) ASC");
        $sql_tb_update = mysqli_query($connect, "SELECT DATE_FORMAT(date, '%Y-%m') AS param_date, YEAR(date) AS year, MONTH(date) AS month, date, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id!=5 && date LIKE '%$param_year_1%' GROUP BY MONTH(date), YEAR(date) ORDER BY YEAR(date) ASC, MONTH(date) ASC");
        $rows = array();
        while($row = mysqli_fetch_array($sql_tb_catalog)){
            $rows[] = $row;

        }
        $rowss = array();
        while($data = mysqli_fetch_array($sql_tb_update)){
            $rowss[] = $data;

        }

        $combinedArray = array_replace_recursive(
            array_combine(array_column($rows, "param_date"), $rows),
            array_combine(array_column($rowss, "param_date"), $rowss)
        );

        foreach( $combinedArray as $value ) {
            $output[] = [
            'month'   => $value['year'].'/'.$value['month'],
            'TOTAL'  => $value['TOTAL'],
            'JUMLAH'  => $value['JUMLAH'],
            ];
        }

    }elseif($date == "All Time" && !isset($_POST['todate'])){
        error_reporting(0);

        $sql_tb_catalog = mysqli_query($connect, "SELECT DATE_FORMAT(upload_on, '%Y') AS param_date, YEAR(upload_on) AS year, MONTH(upload_on) AS month, upload_on, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 GROUP BY YEAR(upload_on) ASC");
        $sql_tb_update = mysqli_query($connect, "SELECT DATE_FORMAT(date, '%Y') AS param_date, YEAR(date) AS year, MONTH(date) AS month, date, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id!=5 GROUP BY YEAR(date) ASC");
        $rows = array();
        while($row = mysqli_fetch_array($sql_tb_catalog)){
            $rows[] = $row;

        }
        $rowss = array();
        while($data = mysqli_fetch_array($sql_tb_update)){
            $rowss[] = $data;

        }

        $combinedArray = array_replace_recursive(
            array_combine(array_column($rows, "param_date"), $rows),
            array_combine(array_column($rowss, "param_date"), $rowss)
        );

        foreach( $combinedArray as $value ) {
            $output[] = [
            'month'   => $value['year'],
            'TOTAL'  => $value['TOTAL'],
            'JUMLAH'  => $value['JUMLAH'],
            ];
        }

    }elseif(isset($_POST['date']) && isset($_POST['todate'])){
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

        $update_sql = mysqli_query($connect, "SELECT * FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$date' AND '$todate' GROUP BY upload_on ");

        if(mysqli_num_rows($update_sql) > 50){
            $sql_tb_catalog = mysqli_query($connect, "SELECT DATE_FORMAT(upload_on, '%Y-%m') AS param_date, YEAR(upload_on) AS year, MONTH(upload_on) AS month, upload_on, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$date' AND '$todate' GROUP BY MONTH(upload_on), YEAR(upload_on) ORDER BY YEAR(upload_on) ASC, MONTH(upload_on) ASC");
            $sql_tb_update = mysqli_query($connect, "SELECT DATE_FORMAT(date, '%Y-%m') AS param_date, YEAR(date) AS year, MONTH(date) AS month, date, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id!=5 && date BETWEEN '$date' AND '$todate' GROUP BY MONTH(date), YEAR(date) ORDER BY YEAR(date) ASC, MONTH(date) ASC");
            $rows = array();
            while($row = mysqli_fetch_array($sql_tb_catalog)){
                $rows[] = $row;

            }
            $rowss = array();
            while($data = mysqli_fetch_array($sql_tb_update)){
                $rowss[] = $data;

            }

            $combinedArray = array_replace_recursive(
                array_combine(array_column($rows, "param_date"), $rows),
                array_combine(array_column($rowss, "param_date"), $rowss)
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
                'month'   => $value['year'].'/'.$value['month'],
                'TOTAL'  => $value['TOTAL'],
                'JUMLAH'  => $value['JUMLAH']
                ];
            }
        }elseif(mysqli_num_rows($update_sql) < 50){

            $begin = new DateTime( $date );
            $end = new DateTime( $todate );
            $end = $end->modify( '+1 day' ); 

            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval ,$end);
            $rows = array();
            $rowss = array();

            foreach($daterange as $dt){
                $date_value = $dt->format("Y-m-d");
                $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_catalog WHERE upload_on = '$date_value'");
                $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_update WHERE date = '$date_value'");
                while($row = mysqli_fetch_array($sql_tb_catalog)){
                    $rows[] = $row;

                }

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
        }

    }
}else{
    if($date == "One Month Last" && !isset($_POST['todate'])){
        $previous_year_month    = date('Y-m', strtotime("-1 month"));
        $previous_date_month    = date('Y-m-d', strtotime("-1 month"));

        $start = date('Y-m-01');
        $endd = date('Y-m-t');        

        $begin = new DateTime( $start );
        $end = new DateTime( $endd );
        $end = $end->modify( '+1 day' ); 

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);
        $rows = array();
        $rowss = array();

        foreach($daterange as $dt){
            $date_value = $dt->format("Y-m-d");
            $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on = '$date_value'");
            $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id=$market_id && date = '$date_value'");
            while($row = mysqli_fetch_array($sql_tb_catalog)){
                $rows[] = $row;

            }

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

    }elseif($date == "30 Days" && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-30 day"));
        $param_date_2   = date('Y-m-d', strtotime("-60 day"));

        $begin = new DateTime( $param_date_1 );
        $end = new DateTime( $param_date );
        $end = $end->modify( '+1 day' ); 

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);
        $rows = array();
        $rowss = array();

        foreach($daterange as $dt){
            $date_value = $dt->format("Y-m-d");
            $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on = '$date_value'");
            $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id=$market_id && date = '$date_value'");
            while($row = mysqli_fetch_array($sql_tb_catalog)){
                $rows[] = $row;

            }

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
    }elseif($date == "One Year Last" && !isset($_POST['todate'])){
        error_reporting(0);
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));
        $param_date_2   = date('Y-m-d', strtotime("-24 month"));

        $sql_tb_catalog = mysqli_query($connect, "SELECT DATE_FORMAT(upload_on, '%Y-%m') AS param_date, YEAR(upload_on) AS year, MONTH(upload_on) AS month, upload_on, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on BETWEEN '$param_date_1' AND '$param_date' GROUP BY MONTH(upload_on), YEAR(upload_on) ORDER BY YEAR(upload_on) ASC, MONTH(upload_on) ASC");
        $sql_tb_update = mysqli_query($connect, "SELECT DATE_FORMAT(date, '%Y-%m') AS param_date, YEAR(date) AS year, MONTH(date) AS month, date, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY MONTH(date), YEAR(date) ORDER BY YEAR(date) ASC, MONTH(date) ASC");
        $rows = array();
        while($row = mysqli_fetch_array($sql_tb_catalog)){
            $rows[] = $row;

        }
        $rowss = array();
        while($data = mysqli_fetch_array($sql_tb_update)){
            $rowss[] = $data;

        }

        $combinedArray = array_replace_recursive(
            array_combine(array_column($rows, "param_date"), $rows),
            array_combine(array_column($rowss, "param_date"), $rowss)
        );

        foreach( $combinedArray as $value ) {
            $output[] = [
            'month'   => $value['year'].'/'.$value['month'],
            'TOTAL'  => $value['TOTAL'],
            'JUMLAH'  => $value['JUMLAH'],
            ];
        }

    }elseif($date == "Last Month" && !isset($_POST['todate'])){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
        $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

        $start = date('Y-m-01', strtotime("-1 month"));
        $endd = date("Y-m-t", strtotime($previous_year_month_1));

        $begin = new DateTime( $start );
        $end = new DateTime( $endd );
        $end = $end->modify( '+1 day' ); 

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);
        $rows = array();
        $rowss = array();

        foreach($daterange as $dt){
            $date_value = $dt->format("Y-m-d");
            $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on = '$date_value'");
            $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id=$market_id && date = '$date_value'");
            while($row = mysqli_fetch_array($sql_tb_catalog)){
                $rows[] = $row;

            }

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

    }elseif($date == "This Year" && !isset($_POST['todate'])){
        $param_year_1   = date('Y', strtotime("-1 year"));


        $sql_tb_catalog = mysqli_query($connect, "SELECT DATE_FORMAT(upload_on, '%Y-%m') AS param_date, YEAR(upload_on) AS year, MONTH(upload_on) AS month, upload_on, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on LIKE '%$param_year%' GROUP BY MONTH(upload_on), YEAR(upload_on) ORDER BY YEAR(upload_on) ASC, MONTH(upload_on) ASC");
        $sql_tb_update = mysqli_query($connect, "SELECT DATE_FORMAT(date, '%Y-%m') AS param_date, YEAR(date) AS year, MONTH(date) AS month, date, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id=$market_id && date LIKE '%$param_year%' GROUP BY MONTH(date), YEAR(date) ORDER BY YEAR(date) ASC, MONTH(date) ASC");
        $rows = array();
        while($row = mysqli_fetch_array($sql_tb_catalog)){
            $rows[] = $row;

        }
        $rowss = array();
        while($data = mysqli_fetch_array($sql_tb_update)){
            $rowss[] = $data;

        }

        $combinedArray = array_replace_recursive(
            array_combine(array_column($rows, "param_date"), $rows),
            array_combine(array_column($rowss, "param_date"), $rowss)
        );

        foreach( $combinedArray as $value ) {
            $output[] = [
            'month'   => $value['year'].'/'.$value['month'],
            'TOTAL'  => $value['TOTAL'],
            'JUMLAH'  => $value['JUMLAH'],
            ];
        }

    }elseif($date == "Last Year" && !isset($_POST['todate'])){
        $param_year_1   = date('Y', strtotime("-1 year"));
        $param_year_2   = date('Y', strtotime("-2 year"));

        $sql_tb_catalog = mysqli_query($connect, "SELECT DATE_FORMAT(upload_on, '%Y-%m') AS param_date, YEAR(upload_on) AS year, MONTH(upload_on) AS month, upload_on, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on LIKE '%$param_year_1%' GROUP BY MONTH(upload_on), YEAR(upload_on) ORDER BY YEAR(upload_on) ASC, MONTH(upload_on) ASC");
        $sql_tb_update = mysqli_query($connect, "SELECT DATE_FORMAT(date, '%Y-%m') AS param_date, YEAR(date) AS year, MONTH(date) AS month, date, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id=$market_id && date LIKE '%$param_year_1%' GROUP BY MONTH(date), YEAR(date) ORDER BY YEAR(date) ASC, MONTH(date) ASC");
        $rows = array();
        while($row = mysqli_fetch_array($sql_tb_catalog)){
            $rows[] = $row;

        }
        $rowss = array();
        while($data = mysqli_fetch_array($sql_tb_update)){
            $rowss[] = $data;

        }

        $combinedArray = array_replace_recursive(
            array_combine(array_column($rows, "param_date"), $rows),
            array_combine(array_column($rowss, "param_date"), $rowss)
        );

        foreach( $combinedArray as $value ) {
            $output[] = [
            'month'   => $value['year'].'/'.$value['month'],
            'TOTAL'  => $value['TOTAL'],
            'JUMLAH'  => $value['JUMLAH'],
            ];
        }

    }elseif($date == "All Time" && !isset($_POST['todate'])){
        error_reporting(0);

        $sql_tb_catalog = mysqli_query($connect, "SELECT DATE_FORMAT(upload_on, '%Y') AS param_date, YEAR(upload_on) AS year, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id GROUP BY YEAR(upload_on) ASC");
        $sql_tb_update = mysqli_query($connect, "SELECT DATE_FORMAT(date, '%Y') AS param_date, YEAR(date) AS year, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id=$market_id GROUP BY YEAR(date) ASC");
        $rows = array();
        while($row = mysqli_fetch_array($sql_tb_catalog)){
            $rows[] = $row;

        }
        $rowss = array();
        while($data = mysqli_fetch_array($sql_tb_update)){
            $rowss[] = $data;

        }

        $combinedArray = array_replace_recursive(
            array_combine(array_column($rows, "param_date"), $rows),
            array_combine(array_column($rowss, "param_date"), $rowss)
        );

        foreach( $combinedArray as $value ) {
            $output[] = [
            'month'   => $value['year'],
            'TOTAL'  => $value['TOTAL'],
            'JUMLAH'  => $value['JUMLAH'],
            ];
        }

    }elseif(isset($_POST['date']) && isset($_POST['todate'])){
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

        $update_sql = mysqli_query($connect, "SELECT * FROM tb_catalog WHERE market_id=$market_id && upload_on BETWEEN '$date' AND '$todate' GROUP BY upload_on ");

        if(mysqli_num_rows($update_sql) > 50){
            $sql_tb_catalog = mysqli_query($connect, "SELECT DATE_FORMAT(upload_on, '%Y-%m') AS param_date, YEAR(upload_on) AS year, MONTH(upload_on) AS month, upload_on, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on BETWEEN '$date' AND '$todate' GROUP BY MONTH(upload_on), YEAR(upload_on) ORDER BY YEAR(upload_on) ASC, MONTH(upload_on) ASC");
            $sql_tb_update = mysqli_query($connect, "SELECT DATE_FORMAT(date, '%Y-%m') AS param_date, YEAR(date) AS year, MONTH(date) AS month, date, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id=$market_id && date BETWEEN '$date' AND '$todate' GROUP BY MONTH(date), YEAR(date) ORDER BY YEAR(date) ASC, MONTH(date) ASC");
            $rows = array();
            while($row = mysqli_fetch_array($sql_tb_catalog)){
                $rows[] = $row;

            }
            $rowss = array();
            while($data = mysqli_fetch_array($sql_tb_update)){
                $rowss[] = $data;

            }

            $combinedArray = array_replace_recursive(
                array_combine(array_column($rows, "param_date"), $rows),
                array_combine(array_column($rowss, "param_date"), $rowss)
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
                'month'   => $value['year'].'/'.$value['month'],
                'TOTAL'  => $value['TOTAL'],
                'JUMLAH'  => $value['JUMLAH']
                ];
            }
        }elseif(mysqli_num_rows($update_sql) < 50){

            $begin = new DateTime( $date );
            $end = new DateTime( $todate );
            $end = $end->modify( '+1 day' ); 

            $interval = new DateInterval('P1D');
            $daterange = new DatePeriod($begin, $interval ,$end);
            $rows = array();
            $rowss = array();

            foreach($daterange as $dt){
                $date_value = $dt->format("Y-m-d");
                $sql_tb_catalog = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on = '$date_value'");
                $sql_popular = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, COUNT(*) AS JUMLAH FROM tb_update WHERE market_id=$market_id && date = '$date_value'");
                while($row = mysqli_fetch_array($sql_tb_catalog)){
                    $rows[] = $row;

                }

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
        }

    }
}

echo json_encode($output);
