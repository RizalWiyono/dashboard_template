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

if($date == "One Month Last"){
    $previous_year_month    = date('Y-m', strtotime("-1 month"));
    $previous_date_month    = date('Y-m-d', strtotime("-1 month"));

    $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$param_year_month%' GROUP BY item_id");
    $result_upd = mysqli_num_rows($update);

    $update_previous = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$previous_year_month%' GROUP BY item_id");
    $result_upd_pprevious = mysqli_num_rows($update_previous);

    // ----------------------------------------

    $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$param_year_month%'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $upload = $row['TOTAL'];
    }

    $query_previous="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$previous_year_month%'";
    $result_previous = mysqli_query($connect, $query_previous);
    while($data =mysqli_fetch_array($result_previous)) 
    {
        $upload_previous = $data['TOTAL'];
    }

    $tot_update = ($result_upd_pprevious < 1) ? 0.00001 : (($result_upd - $result_upd_pprevious) / $result_upd_pprevious) * 100;
    $tot_upload = ($upload_previous < 1) ? 0.00001 : (($upload - $upload_previous) / $upload_previous) * 100;

    $output[] = [
        'UPLOAD'  => $upload,
        'UPDATE'  => $result_upd,
        'UPLOAD_RATE'  => $tot_upload,
        'UPDATE_RATE'  => $tot_update,
    ];

}elseif($date == "30 Days"){
    $param_date_1   = date('Y-m-d', strtotime("-30 day"));
    $param_date_2   = date('Y-m-d', strtotime("-60 day"));

    $query_upd="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$param_date_1' AND '$param_date'";
    $result_upd = mysqli_query($connect, $query_upd);
    while($row =mysqli_fetch_array($result_upd)) 
    {
        $TOTAL_upl = $row['TOTAL'];
    }

    $query_upd_prev="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$param_date_2' AND '$param_date_1'";
    $result_upd_prev = mysqli_query($connect, $query_upd_prev);
    while($data =mysqli_fetch_array($result_upd_prev)) 
    {
        $TOTAL_upl_prev = $data['TOTAL'];
    }

    $query_upd="SELECT item_id, COUNT(*) AS TOTAL FROM tb_update WHERE market_id!=5 && date BETWEEN '$param_date_1' AND '$param_date'";
    $result_upd = mysqli_query($connect, $query_upd);
    while($row =mysqli_fetch_array($result_upd)) 
    {
        $TOTAL_upd = $row['TOTAL'];
    }

    $query_upd_prev ="SELECT item_id, COUNT(*) AS TOTAL FROM tb_update WHERE market_id!=5 && date BETWEEN '$param_date_2' AND '$param_date_1'";
    $result_upd_prev = mysqli_query($connect, $query_upd_prev);
    while($data =mysqli_fetch_array($result_upd_prev)) 
    {
        $TOTAL_upd_prev = $row['TOTAL'];
    }

    $tot_update = ($TOTAL_upd_prev < 1) ? 0.00001 : (($TOTAL_upd - $TOTAL_upd_prev) / $TOTAL_upd_prev) * 100;
    $tot_upload = ($TOTAL_upl_prev < 1) ? 0.00001 : (($TOTAL_upl - $TOTAL_upl_prev) / $TOTAL_upl_prev) * 100;

        $output[] = [
            'UPLOAD'  => $TOTAL_upl,
            'UPDATE'  => $TOTAL_upd,
            'UPLOAD_RATE'  => $tot_upload,
            'UPDATE_RATE'  => $tot_update,
        ];

}elseif($date == "One Year Last" && !isset($_POST['todate'])){
    $param_date_1   = date('Y-m-d', strtotime("-12 month"));
    $param_date_2   = date('Y-m-d', strtotime("-24 month"));

    $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY item_id");
    $result_upd = mysqli_num_rows($update);

    $update_previous = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date BETWEEN '$param_date_2' AND '$param_date_1' GROUP BY item_id");
    $result_upd_pprevious = mysqli_num_rows($update_previous);

    $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$param_date_1' AND '$param_date'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $upload = $row['TOTAL'];
    }

    $query_previous="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$param_date_2' AND '$param_date_1'";
    $result_previous = mysqli_query($connect, $query_previous);
    while($data =mysqli_fetch_array($result_previous)) 
    {
        $upload_previous = $data['TOTAL'];
    }

    $tot_update = ($result_upd_pprevious < 1) ? 0.00001 : (($result_upd - $result_upd_pprevious) / $result_upd_pprevious) * 100;
    $tot_upload = ($upload_previous < 1) ? 0.00001 : (($upload - $upload_previous) / $upload_previous) * 100;

    $output[] = [
        'UPLOAD'  => $upload,
        'UPDATE'  => $result_upd,
        'UPLOAD_RATE'  => $tot_upload,
        'UPDATE_RATE'  => $tot_update,
    ];

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
    
    $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date BETWEEN '$date' AND '$todate'");
    $result_upd = mysqli_num_rows($update);

    $update_previous = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date BETWEEN '$date_1' AND '$date_2' GROUP BY item_id");
    $result_upd_pprevious = mysqli_num_rows($update_previous);

    $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$date' AND '$todate'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $upload = $row['TOTAL'];
    }

    $query_previous="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$date_1' AND '$date_2'";
    $result_previous = mysqli_query($connect, $query_previous);
    while($data =mysqli_fetch_array($result_previous)) 
    {
        $upload_previous = $data['TOTAL'];
    }

    $tot_update = ($result_upd_pprevious < 1) ? 0.00001 : (($result_upd - $result_upd_pprevious) / $result_upd_pprevious) * 100;
    $tot_upload = ($upload_previous < 1) ? 0.00001 : (($upload - $upload_previous) / $upload_previous) * 100;

    $output[] = [
        'UPLOAD'  => $upload,
        'UPDATE'  => $result_upd,
        'UPLOAD_RATE'  => $tot_upload,
        'UPDATE_RATE'  => $tot_update,
    ];
}elseif($date == "Last Month"){
    $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
    $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

    $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$previous_year_month_1%' GROUP BY item_id");
    $result_upd = mysqli_num_rows($update);

    $update_previous = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$previous_year_month_2%' GROUP BY item_id");
    $result_upd_pprevious = mysqli_num_rows($update_previous);

    // ----------------------------------------

    $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$previous_year_month_1%'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $upload = $row['TOTAL'];
    }

    $query_previous="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$previous_year_month_2%'";
    $result_previous = mysqli_query($connect, $query_previous);
    while($data =mysqli_fetch_array($result_previous)) 
    {
        $upload_previous = $data['TOTAL'];
    }

    $tot_update = ($result_upd_pprevious < 1) ? 0.00001 : (($result_upd - $result_upd_pprevious) / $result_upd_pprevious) * 100;
    $tot_upload = ($upload_previous < 1) ? 0.00001 : (($upload - $upload_previous) / $upload_previous) * 100;

    $output[] = [
        'UPLOAD'  => $upload,
        'UPDATE'  => $result_upd,
        'UPLOAD_RATE'  => $tot_upload,
        'UPDATE_RATE'  => $tot_update,
    ];

    $output[] = [
        'UPLOAD'  => $upload,
        'UPDATE'  => $result_upd,
    ];
}elseif($date == "Last Year"){
    $param_year_1   = date('Y', strtotime("-1 year"));
    $param_year_2   = date('Y', strtotime("-2 year"));

    $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$param_year_1%' GROUP BY item_id");
    $result_upd = mysqli_num_rows($update);

    $update_previous = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$param_year_2%' GROUP BY item_id");
    $result_upd_pprevious = mysqli_num_rows($update_previous);

    // ----------------------------------------

    $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$param_year_1%'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $upload = $row['TOTAL'];
    }

    $query_previous="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$param_year_2%'";
    $result_previous = mysqli_query($connect, $query_previous);
    while($data =mysqli_fetch_array($result_previous)) 
    {
        $upload_previous = $data['TOTAL'];
    }

    $tot_update = ($result_upd_pprevious < 1) ? 0.00001 : (($result_upd - $result_upd_pprevious) / $result_upd_pprevious) * 100;
    $tot_upload = ($upload_previous < 1) ? 0.00001 : (($upload - $upload_previous) / $upload_previous) * 100;

    $output[] = [
        'UPLOAD'  => $upload,
        'UPDATE'  => $result_upd,
        'UPLOAD_RATE'  => $tot_upload,
        'UPDATE_RATE'  => $tot_update,
    ];

}elseif($date == "All Time"){

    $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 GROUP BY item_id");
    $result_upd = mysqli_num_rows($update);


    // ----------------------------------------

    $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $upload = $row['TOTAL'];
    }


    $output[] = [
        'UPLOAD'  => $upload,
        'UPDATE'  => $result_upd,
        'UPLOAD_RATE'  => 0,
        'UPDATE_RATE'  => 0,
    ];
}elseif($date == "This Year"){
    $param_year_1   = date('Y', strtotime("-1 year"));

    $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$param_year%' GROUP BY item_id");
    $result_upd = mysqli_num_rows($update);

    $update_previous = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$param_year_1%' GROUP BY item_id");
    $result_upd_pprevious = mysqli_num_rows($update_previous);

    $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$param_year%'";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $upload = $row['TOTAL'];
    }

    $query_previous="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$param_year_1%'";
    $result_previous = mysqli_query($connect, $query_previous);
    while($data =mysqli_fetch_array($result_previous)) 
    {
        $upload_previous = $data['TOTAL'];
    }

    $tot_update = ($result_upd_pprevious < 1) ? 0.00001 : (($result_upd - $result_upd_pprevious) / $result_upd_pprevious) * 100;
    $tot_upload = ($upload_previous < 1) ? 0.00001 : (($upload - $upload_previous) / $upload_previous) * 100;

    $output[] = [
        'UPLOAD'  => $upload,
        'UPDATE'  => $result_upd,
        'UPLOAD_RATE'  => $tot_upload,
        'UPDATE_RATE'  => $tot_update,
    ];

}
    

echo json_encode($output);
