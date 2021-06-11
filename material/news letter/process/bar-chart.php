<?php
include('../../../src/connection/connection.php');
$date_range = $_POST['this_value'];

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

    foreach($daterange as $dt){
        $date_value = $dt->format("Y-m-d");
        $sql_sum1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, campaign_title, open_rate AS TOTAL_SUM1 , click_rate AS TOTAL_SUM2 , SUM(click_rate) AS TOTAL_SUM3 FROM tb_newsletter WHERE date = '$date_value' ORDER BY TOTAL_SUM1 DESC LIMIT 1");
        
        while($row1 = mysqli_fetch_array($sql_sum1)){
            $rows1[] = $row1;

        }
    }

    foreach( $rows1 as $value ) {
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

        $output[] = [
            'TITLE'   => $value['day'].'/'.$value["campaign_title"],
            'TOTAL'  => $value['TOTAL_SUM1'],
            'JUMLAH'  => $value['TOTAL_SUM2']
        ];
    }

    $query_op="SELECT AVG(open_rate) AS OPEN FROM tb_newsletter WHERE date LIKE '%$param_year_month%'";
    $result_op = mysqli_query($connect, $query_op);
    while($row =mysqli_fetch_array($result_op)) {
        $OPEN = $row['OPEN'];
    }

    $query_cl="SELECT AVG(click_rate) AS CLICK FROM tb_newsletter WHERE date LIKE '%$param_year_month%'";
    $result_cl = mysqli_query($connect, $query_cl);
    while($row =mysqli_fetch_array($result_cl)) {
        $CLICK = $row['CLICK'];
    }

    $query_un="SELECT AVG(uns_rate) AS UNSUB FROM tb_newsletter WHERE date LIKE '%$param_year_month%'";
    $result_un = mysqli_query($connect, $query_un);
    while($row =mysqli_fetch_array($result_un)) {
        $UNSUB = $row['UNSUB'];
    }

    $output[] = [
        'OPEN'   => $OPEN,
        'CLICK'  => $CLICK,
        'UNSUB'  => $UNSUB
    ];
    
}elseif($date_range == 'One Year' && !isset($_POST['date']) && !isset($_POST['todate'])){
    $param_date_1   = date('Y-m-d', strtotime("-12 month"));
    $param_date_2   = date('Y-m-d', strtotime("-24 month"));

    $endd = date('Y-m-01');
    $start = date('Y-m-01', strtotime("-12 month"));  
    
    $start2 = new DateTime( $start );
    $interval = new DateInterval('P1M');
    $end2 = new DateTime( $endd );
    $end2 = $end2->modify( '+1 month' ); 
    $daterange = new DatePeriod($start2, $interval, $end2);

    $rows1 = array();

    foreach($daterange as $dt){
        $date_value = $dt->format("Y-m-d");
        $year_param = $dt->format("Y");
        $month_param = $dt->format("m");
        $sql_sum1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, campaign_title, open_rate AS TOTAL_SUM1 , click_rate AS TOTAL_SUM2 , SUM(click_rate) AS TOTAL_SUM3 FROM tb_newsletter WHERE year=$year_param && month=$month_param ORDER BY TOTAL_SUM1 DESC LIMIT 1");
        
        while($row1 = mysqli_fetch_array($sql_sum1)){
            $rows1[] = $row1;

        }
    }

    foreach( $rows1 as $value ) {
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

        $output[] = [
            'TITLE'   => $value['month'].'/'.$value["campaign_title"],
            'TOTAL'  => $value['TOTAL_SUM1'],
            'JUMLAH'  => $value['TOTAL_SUM2']
        ];
    }

    $query_op="SELECT AVG(open_rate) AS OPEN FROM tb_newsletter WHERE date BETWEEN '$param_date_1' AND '$param_date'";
    $result_op = mysqli_query($connect, $query_op);
    while($row =mysqli_fetch_array($result_op)) {
        $OPEN = $row['OPEN'];
    }

    $query_cl="SELECT AVG(click_rate) AS CLICK FROM tb_newsletter WHERE date BETWEEN '$param_date_1' AND '$param_date'";
    $result_cl = mysqli_query($connect, $query_cl);
    while($row =mysqli_fetch_array($result_cl)) {
        $CLICK = $row['CLICK'];
    }

    $query_un="SELECT AVG(uns_rate) AS UNSUB FROM tb_newsletter WHERE date BETWEEN '$param_date_1' AND '$param_date'";
    $result_un = mysqli_query($connect, $query_un);
    while($row =mysqli_fetch_array($result_un)) {
        $UNSUB = $row['UNSUB'];
    }

    $output[] = [
        'OPEN'   => $OPEN,
        'CLICK'  => $CLICK,
        'UNSUB'  => $UNSUB
    ];

}elseif($date_range == 'One Year' && isset($_POST['date']) && isset($_POST['todate'])){
    $date = $_POST['date'];
    $todate = $_POST['todate'];

    $start = $date;
    $endd = $todate;        

    $begin = new DateTime( $start );
    $end = new DateTime( $endd );
    $end = $end->modify( '+1 day' ); 

    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($begin, $interval ,$end);
    $rows1 = array();

    foreach($daterange as $dt){
        $date_value = $dt->format("Y-m-d");
        $sql_sum1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, campaign_title, open_rate AS TOTAL_SUM1 , click_rate AS TOTAL_SUM2 , SUM(click_rate) AS TOTAL_SUM3 FROM tb_newsletter WHERE date = '$date_value' ORDER BY TOTAL_SUM1 DESC LIMIT 1");
        
        while($row1 = mysqli_fetch_array($sql_sum1)){
            $rows1[] = $row1;

        }
    }

    foreach( $rows1 as $value ) {
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

        $output[] = [
            'TITLE'   => $value['day'].'/'.$value["campaign_title"],
            'TOTAL'  => $value['TOTAL_SUM1'],
            'JUMLAH'  => $value['TOTAL_SUM2']
        ];
    }

    $query_op="SELECT AVG(open_rate) AS OPEN FROM tb_newsletter WHERE date BETWEEN '$date' AND '$todate'";
    $result_op = mysqli_query($connect, $query_op);
    while($row =mysqli_fetch_array($result_op)) {
        $OPEN = $row['OPEN'];
    }

    $query_cl="SELECT AVG(click_rate) AS CLICK FROM tb_newsletter WHERE date BETWEEN '$date' AND '$todate'";
    $result_cl = mysqli_query($connect, $query_cl);
    while($row =mysqli_fetch_array($result_cl)) {
        $CLICK = $row['CLICK'];
    }

    $query_un="SELECT AVG(uns_rate) AS UNSUB FROM tb_newsletter WHERE date BETWEEN '$date' AND '$todate'";
    $result_un = mysqli_query($connect, $query_un);
    while($row =mysqli_fetch_array($result_un)) {
        $UNSUB = $row['UNSUB'];
    }

    $output[] = [
        'OPEN'   => $OPEN,
        'CLICK'  => $CLICK,
        'UNSUB'  => $UNSUB
    ];

}elseif($date_range == '30 Days'){
    $param_date_1   = date('Y-m-d', strtotime("-30 day"));
    $param_date_2   = date('Y-m-d', strtotime("-60 day"));

    $start = $param_date_1;
    $endd = $param_date;

    $begin = new DateTime( $start );
    $end = new DateTime( $endd );
    $end = $end->modify( '+1 day' ); 

    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($begin, $interval ,$end);
    $rows1 = array();

    foreach($daterange as $dt){
        $date_value = $dt->format("Y-m-d");
        $sql_sum1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, campaign_title, open_rate AS TOTAL_SUM1 , click_rate AS TOTAL_SUM2 , SUM(click_rate) AS TOTAL_SUM3 FROM tb_newsletter WHERE date = '$date_value' ORDER BY TOTAL_SUM1 DESC LIMIT 1");
        
        while($row1 = mysqli_fetch_array($sql_sum1)){
            $rows1[] = $row1;

        }
    }

    foreach( $rows1 as $value ) {
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

        $output[] = [
            'TITLE'   => $value['day'].'/'.$value["campaign_title"],
            'TOTAL'  => $value['TOTAL_SUM1'],
            'JUMLAH'  => $value['TOTAL_SUM2']
        ];
    }


    // $query="SELECT month, a.campaign_title, 
    // (SELECT  SUM(open_rate) FROM tb_newsletter WHERE date BETWEEN '$param_date_1' AND '$param_date' && campaign_title = a.campaign_title) as TOTAL, 
    // (SELECT SUM(click_rate) FROM tb_newsletter WHERE date BETWEEN '$param_date_1' AND '$param_date' && campaign_title = a.campaign_title) as JUMLAH 
    // FROM (SELECT DISTINCT month, campaign_title FROM tb_newsletter WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY day, campaign_title ORDER BY year ASC, month DESC, day ASC) a";
    // $result = mysqli_query($connect, $query);
    // while($row =mysqli_fetch_array($result)) {
    //     if($row["TOTAL"] !== NULL && $row["JUMLAH"] !== NULL){
    //         $output[] = [
    //             'TITLE'   => $row['month'].'/'.$row["campaign_title"],
    //             'TOTAL'  => $row["TOTAL"],
    //             'JUMLAH'  => $row["JUMLAH"],
    //         ];
    //     }elseif($row["TOTAL"] == NULL && $row["JUMLAH"] !== NULL){
    //         $output[] = [
    //             'TITLE'   => $row['month'].'/'.$row["campaign_title"],
    //             'TOTAL'  => 0,
    //             'JUMLAH'  => $row["JUMLAH"],
    //         ];
    //     }elseif($row["TOTAL"] !== NULL && $row["JUMLAH"] == NULL){
    //         $output[] = [
    //             'TITLE'   => $row['month'].'/'.$row["campaign_title"],
    //             'TOTAL'  => $row["TOTAL"],
    //             'JUMLAH'  => 0,
    //         ];
    //     }
    // } 

    $query_op="SELECT AVG(open_rate) AS OPEN FROM tb_newsletter WHERE date BETWEEN '$param_date_1' AND '$param_date'";
    $result_op = mysqli_query($connect, $query_op);
    while($row =mysqli_fetch_array($result_op)) {
        $OPEN = $row['OPEN'];
    }

    $query_cl="SELECT AVG(click_rate) AS CLICK FROM tb_newsletter WHERE date BETWEEN '$param_date_1' AND '$param_date'";
    $result_cl = mysqli_query($connect, $query_cl);
    while($row =mysqli_fetch_array($result_cl)) {
        $CLICK = $row['CLICK'];
    }

    $query_un="SELECT AVG(uns_rate) AS UNSUB FROM tb_newsletter WHERE date BETWEEN '$param_date_1' AND '$param_date'";
    $result_un = mysqli_query($connect, $query_un);
    while($row =mysqli_fetch_array($result_un)) {
        $UNSUB = $row['UNSUB'];
    }

    $output[] = [
        'OPEN'   => $OPEN,
        'CLICK'  => $CLICK,
        'UNSUB'  => $UNSUB
    ];

}elseif($date_range == 'Last Month'){
    $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
    $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

    $start = date('Y-m-01', strtotime("-1 month"));
    $endd = date("Y-m-t", strtotime("-1 month"));   

    $begin = new DateTime( $start );
    $end = new DateTime( $endd );
    $end = $end->modify( '+1 day' ); 

    $interval = new DateInterval('P1D');
    $daterange = new DatePeriod($begin, $interval ,$end);
    $rows1 = array();

    foreach($daterange as $dt){
        $date_value = $dt->format("Y-m-d");
        $sql_sum1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, campaign_title, open_rate AS TOTAL_SUM1 , click_rate AS TOTAL_SUM2 , SUM(click_rate) AS TOTAL_SUM3 FROM tb_newsletter WHERE date = '$date_value' ORDER BY TOTAL_SUM1 DESC LIMIT 1");
        
        while($row1 = mysqli_fetch_array($sql_sum1)){
            $rows1[] = $row1;

        }
    }

    foreach( $rows1 as $value ) {
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

        $output[] = [
            'TITLE'   => $value['day'].'/'.$value["campaign_title"],
            'TOTAL'  => $value['TOTAL_SUM1'],
            'JUMLAH'  => $value['TOTAL_SUM2']
        ];
    }

    $query_op="SELECT AVG(open_rate) AS OPEN FROM tb_newsletter WHERE date LIKE '%$previous_year_month_1%'";
    $result_op = mysqli_query($connect, $query_op);
    while($row =mysqli_fetch_array($result_op)) {
        $OPEN = $row['OPEN'];
    }

    $query_cl="SELECT AVG(click_rate) AS CLICK FROM tb_newsletter WHERE date LIKE '%$previous_year_month_1%'";
    $result_cl = mysqli_query($connect, $query_cl);
    while($row =mysqli_fetch_array($result_cl)) {
        $CLICK = $row['CLICK'];
    }

    $query_un="SELECT AVG(uns_rate) AS UNSUB FROM tb_newsletter WHERE date LIKE '%$previous_year_month_1%'";
    $result_un = mysqli_query($connect, $query_un);
    while($row =mysqli_fetch_array($result_un)) {
        $UNSUB = $row['UNSUB'];
    }

    $output[] = [
        'OPEN'   => $OPEN,
        'CLICK'  => $CLICK,
        'UNSUB'  => $UNSUB
    ];
}elseif($date_range == 'This Year'){
    $param_year_1   = date('Y', strtotime("-1 year"));

    $start = date('Y-01-01');
    $endd = date('Y-12-t');
    
    $start2 = new DateTime( $start );
    $interval = new DateInterval('P1M');
    $end2 = new DateTime( $endd );
    $end2 = $end2->modify( '+1 month' ); 
    $daterange = new DatePeriod($start2, $interval, $end2);

    $rows1 = array();

    foreach($daterange as $dt){
        $date_value = $dt->format("Y-m-d");
        $year_param = $dt->format("Y");
        $month_param = $dt->format("m");
        $sql_sum1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, campaign_title, open_rate AS TOTAL_SUM1 , click_rate AS TOTAL_SUM2 , SUM(click_rate) AS TOTAL_SUM3 FROM tb_newsletter WHERE year=$year_param && month=$month_param ORDER BY TOTAL_SUM1 DESC LIMIT 1");
        
        while($row1 = mysqli_fetch_array($sql_sum1)){
            $rows1[] = $row1;

        }
    }

    foreach( $rows1 as $value ) {
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

        $output[] = [
            'TITLE'   => $value['month'].'/'.$value["campaign_title"],
            'TOTAL'  => $value['TOTAL_SUM1'],
            'JUMLAH'  => $value['TOTAL_SUM2']
        ];
    }

    $query_op="SELECT AVG(open_rate) AS OPEN FROM tb_newsletter WHERE year=$param_year";
    $result_op = mysqli_query($connect, $query_op);
    while($row =mysqli_fetch_array($result_op)) {
        $OPEN = $row['OPEN'];
    }

    $query_cl="SELECT AVG(click_rate) AS CLICK FROM tb_newsletter WHERE year=$param_year";
    $result_cl = mysqli_query($connect, $query_cl);
    while($row =mysqli_fetch_array($result_cl)) {
        $CLICK = $row['CLICK'];
    }

    $query_un="SELECT AVG(uns_rate) AS UNSUB FROM tb_newsletter WHERE year=$param_year";
    $result_un = mysqli_query($connect, $query_un);
    while($row =mysqli_fetch_array($result_un)) {
        $UNSUB = $row['UNSUB'];
    }

    $output[] = [
        'OPEN'   => $OPEN,
        'CLICK'  => $CLICK,
        'UNSUB'  => $UNSUB
    ];

}elseif($date_range == 'Last Year'){
    $param_year_1   = date('Y', strtotime("-1 year"));
    $param_year_2   = date('Y', strtotime("-2 year"));

    $start = date('Y-m-01', strtotime("-1 year"));  
    $endd = date('Y-12-t', strtotime("-1 year"));  
    
    $start2 = new DateTime( $start );
    $interval = new DateInterval('P1M');
    $end2 = new DateTime( $endd );
    $daterange = new DatePeriod($start2, $interval, $end2);
    
    $rows1 = array();

    foreach($daterange as $dt){
        $date_value = $dt->format("Y-m-d");
        $year_param = $dt->format("Y");
        $month_param = $dt->format("m");
        $sql_sum1 = mysqli_query($connect, "SELECT SUBSTR('$date_value', 9) AS day, SUBSTR('$date_value', 1, 4) AS year, SUBSTR('$date_value', 6, 2) AS month, campaign_title, open_rate AS TOTAL_SUM1 , click_rate AS TOTAL_SUM2 , SUM(click_rate) AS TOTAL_SUM3 FROM tb_newsletter WHERE year=$year_param && month=$month_param ORDER BY TOTAL_SUM1 DESC LIMIT 1");
        
        while($row1 = mysqli_fetch_array($sql_sum1)){
            $rows1[] = $row1;

        }
    }

    foreach( $rows1 as $value ) {
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

        $output[] = [
            'TITLE'   => $value['month'].'/'.$value["campaign_title"],
            'TOTAL'  => $value['TOTAL_SUM1'],
            'JUMLAH'  => $value['TOTAL_SUM2']
        ];
    }

    $query_op="SELECT AVG(open_rate) AS OPEN FROM tb_newsletter WHERE year=$param_year_1";
    $result_op = mysqli_query($connect, $query_op);
    while($row =mysqli_fetch_array($result_op)) {
        $OPEN = $row['OPEN'];
    }

    $query_cl="SELECT AVG(click_rate) AS CLICK FROM tb_newsletter WHERE year=$param_year_1";
    $result_cl = mysqli_query($connect, $query_cl);
    while($row =mysqli_fetch_array($result_cl)) {
        $CLICK = $row['CLICK'];
    }

    $query_un="SELECT AVG(uns_rate) AS UNSUB FROM tb_newsletter WHERE year=$param_year_1";
    $result_un = mysqli_query($connect, $query_un);
    while($row =mysqli_fetch_array($result_un)) {
        $UNSUB = $row['UNSUB'];
    }

    $output[] = [
        'OPEN'   => $OPEN,
        'CLICK'  => $CLICK,
        'UNSUB'  => $UNSUB
    ];

}elseif($date_range == 'All Time'){

    $query="SELECT a.campaign_title, 
    (SELECT  SUM(open_rate) FROM tb_newsletter WHERE campaign_title = a.campaign_title) as TOTAL, 
    (SELECT SUM(click_rate) FROM tb_newsletter WHERE campaign_title = a.campaign_title) as JUMLAH 
    FROM (SELECT DISTINCT campaign_title FROM tb_newsletter GROUP BY campaign_title ASC) a";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) {
        if($row["TOTAL"] !== NULL && $row["JUMLAH"] !== NULL){
            $output[] = [
                'TITLE'   => $row["campaign_title"],
                'TOTAL'  => $row["TOTAL"],
                'JUMLAH'  => $row["JUMLAH"],
            ];
        }elseif($row["TOTAL"] == NULL && $row["JUMLAH"] !== NULL){
            $output[] = [
                'TITLE'   => $row["campaign_title"],
                'TOTAL'  => 0,
                'JUMLAH'  => $row["JUMLAH"],
            ];
        }elseif($row["TOTAL"] !== NULL && $row["JUMLAH"] == NULL){
            $output[] = [
                'TITLE'   => $row["campaign_title"],
                'TOTAL'  => $row["TOTAL"],
                'JUMLAH'  => 0,
            ];
        }
    } 

    $query_op="SELECT AVG(open_rate) AS OPEN FROM tb_newsletter";
    $result_op = mysqli_query($connect, $query_op);
    while($row =mysqli_fetch_array($result_op)) {
        $OPEN = $row['OPEN'];
    }

    $query_cl="SELECT AVG(click_rate) AS CLICK FROM tb_newsletter";
    $result_cl = mysqli_query($connect, $query_cl);
    while($row =mysqli_fetch_array($result_cl)) {
        $CLICK = $row['CLICK'];
    }

    $query_un="SELECT AVG(uns_rate) AS UNSUB FROM tb_newsletter";
    $result_un = mysqli_query($connect, $query_un);
    while($row =mysqli_fetch_array($result_un)) {
        $UNSUB = $row['UNSUB'];
    }

    $output[] = [
        'OPEN'   => $OPEN,
        'CLICK'  => $CLICK,
        'UNSUB'  => $UNSUB
    ];

}
    
    echo json_encode($output);
