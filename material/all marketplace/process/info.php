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
        $previous_year_month    = date('Y-m', strtotime("-1 month"));

        $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$param_year_month%' GROUP BY item_id");
        $result_upd = mysqli_num_rows($update);

        $update_min = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$previous_year_month%' GROUP BY item_id");
        $result_upd_min = mysqli_num_rows($update_min);

        // ----------------------------------------

        $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$param_year_month%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $upload = $row['TOTAL'];
        }

        $query_min="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$previous_year_month%'";
        $result_min = mysqli_query($connect, $query_min);
        while($row =mysqli_fetch_array($result_min)) 
        {
            $upload_min = $row['TOTAL'];
        }

        $output[] = [
            'UPLOAD'  => $upload,
            'UPDATE'  => $result_upd,
            'UPLOAD_MIN'  => $upload_min,
            'UPDATE_MIN'  => $result_upd_min,
        ];

    }elseif($date_range == "30 Days"){
        $param_date_1   = date('Y-m-d', strtotime("-30 day"));
        $param_date_2   = date('Y-m-d', strtotime("-60 day"));

        $query_upd="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$param_date_1' AND '$param_date'";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $TOTAL_upl = $row['TOTAL'];
        }

        $query_upd="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$param_date_2' AND '$param_date_1'";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $TOTAL_upl_min = $row['TOTAL'];
        }

        $query_upd="SELECT item_id, COUNT(*) AS TOTAL FROM tb_update WHERE market_id!=5 && date BETWEEN '$param_date_1' AND '$param_date'";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $TOTAL_upd = $row['TOTAL'];
        }

        $query_upd="SELECT item_id, COUNT(*) AS TOTAL FROM tb_update WHERE market_id!=5 && date BETWEEN '$param_date_2' AND '$param_date_1'";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $TOTAL_upd_min = $row['TOTAL'];
        }

            $output[] = [
                'UPLOAD'  => $TOTAL_upl,
                'UPDATE'  => $TOTAL_upd,
                'UPLOAD_MIN'  => $TOTAL_upl_min,
                'UPDATE_MIN'  => $TOTAL_upd_min,
            ];

    }elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));
        $param_date_2   = date('Y-m-d', strtotime("-24 month"));

        $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY item_id");
        $result_upd = mysqli_num_rows($update);

        $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$param_date_2' AND '$param_date_1'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $upload = $row['TOTAL'];
        }

        $update_min = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY item_id");
        $result_upd_min = mysqli_num_rows($update_min);

        $query_min="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$param_date_2' AND '$param_date_1'";
        $result_min = mysqli_query($connect, $query_min);
        while($row =mysqli_fetch_array($result_min)) 
        {
            $upload_min = $row['TOTAL'];
        }

        $output[] = [
            'UPLOAD'  => $upload,
            'UPDATE'  => $result_upd,
            'UPLOAD_MIN'  => $upload_min,
            'UPDATE_MIN'  => $result_upd_min,
        ];

    }elseif($date_range == "One Year" && isset($_POST['date']) && isset($_POST['todate'])){
        $date = $_POST['date'];
        $todate = $_POST['todate'];
        
        $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date BETWEEN '$date' AND '$todate'");
        $result_upd = mysqli_num_rows($update);

        $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$date' AND '$todate'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $upload = $row['TOTAL'];
        }

        $update_min = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date BETWEEN '$date' AND '$todate'");
        $result_upd_min = mysqli_num_rows($update_min);

        $query_min="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on BETWEEN '$date' AND '$todate'";
        $result_min = mysqli_query($connect, $query_min);
        while($row =mysqli_fetch_array($result_min)) 
        {
            $upload_min = $row['TOTAL'];
        }

        $output[] = [
            'UPLOAD'  => $upload,
            'UPDATE'  => $result_upd,
            'UPLOAD_MIN'  => $upload_min,
            'UPDATE_MIN'  => $result_upd_min,
        ];
    }elseif($date_range == "Last Month"){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
        $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

        $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$previous_year_month_1%' GROUP BY item_id");
        $result_upd = mysqli_num_rows($update);

        $update_min = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$previous_year_month_2%' GROUP BY item_id");
        $result_upd_min = mysqli_num_rows($update_min);

        // ----------------------------------------

        $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$previous_year_month_1%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $upload = $row['TOTAL'];
        }

        $query_min="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$previous_year_month_2%'";
        $result_min = mysqli_query($connect, $query_min);
        while($row =mysqli_fetch_array($result_min)) 
        {
            $upload_min = $row['TOTAL'];
        }

        $output[] = [
            'UPLOAD'  => $upload,
            'UPDATE'  => $result_upd,
            'UPLOAD_MIN'  => $upload_min,
            'UPDATE_MIN'  => $result_upd_min,
        ];
    }elseif($date_range == "Last Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));
        $param_year_2   = date('Y', strtotime("-2 year"));

        $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$param_year_1%' GROUP BY item_id");
        $result_upd = mysqli_num_rows($update);

        $update_min = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$param_year_2%' GROUP BY item_id");
        $result_upd_min = mysqli_num_rows($update_min);

        // ----------------------------------------

        $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$param_year_1%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $upload = $row['TOTAL'];
        }

        $query_min="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$param_year_2%'";
        $result_min = mysqli_query($connect, $query_min);
        while($row =mysqli_fetch_array($result_min)) 
        {
            $upload_min = $row['TOTAL'];
        }

        $output[] = [
            'UPLOAD'  => $upload,
            'UPDATE'  => $result_upd,
            'UPLOAD_MIN'  => $upload_min,
            'UPDATE_MIN'  => $result_upd_min,
        ];
    }elseif($date_range == "All Time"){
        $query_upd="SELECT DATE_FORMAT(upload_on, '%Y') AS YEAR FROM tb_catalog WHERE market_id!=5 GROUP BY upload_on DESC LIMIT 1";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $year = $row['YEAR']-1;
            $year_min = (int)$row['YEAR']-2;
        }

        $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$year%' GROUP BY item_id");
        $result_upd = mysqli_num_rows($update);

        // $update_min = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE date LIKE '%$year_min%' GROUP BY item_id");
        $result_upd_min = '-';

        // ----------------------------------------

        $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$year%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $upload = $row['TOTAL'];
        }

        // $query_min="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE upload_on LIKE '%$year_min%'";
        // $result_min = mysqli_query($connect, $query_min);
        // while($row =mysqli_fetch_array($result_min)) 
        // {
            $upload_min = '-';
        // }

        $output[] = [
            'UPLOAD'  => $upload,
            'UPDATE'  => $result_upd,
            'UPLOAD_MIN'  => $upload_min,
            'UPDATE_MIN'  => $result_upd_min,
        ];
    }elseif($date_range == "This Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$param_year%' GROUP BY item_id");
        $result_upd = mysqli_num_rows($update);

        $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$param_year%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $upload = $row['TOTAL'];
        }

        $update_min = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id!=5 && date LIKE '%$param_year_1%' GROUP BY item_id");
        $result_upd_min = mysqli_num_rows($update_min);

        $query_min="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id!=5 && upload_on LIKE '%$param_year_1%'";
        $result_min = mysqli_query($connect, $query_min);
        while($row =mysqli_fetch_array($result_min)) 
        {
            $upload_min = $row['TOTAL'];
        }

        $output[] = [
            'UPLOAD'  => $upload,
            'UPDATE'  => $result_upd,
            'UPLOAD_MIN'  => $upload_min,
            'UPDATE_MIN'  => $result_upd_min,
        ];

    }
}else{
    if($date_range == "This Month"){
        $previous_year_month    = date('Y-m', strtotime("-1 month"));

        $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id=$market_id && date LIKE '%$param_year_month%' GROUP BY item_id");
        $result_upd = mysqli_num_rows($update);

        $update_min = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id=$market_id && date LIKE '%$previous_year_month%' GROUP BY item_id");
        $result_upd_min = mysqli_num_rows($update_min);

        // ----------------------------------------

        $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on LIKE '%$param_year_month%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $upload = $row['TOTAL'];
        }

        $query_min="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on LIKE '%$previous_year_month%'";
        $result_min = mysqli_query($connect, $query_min);
        while($row =mysqli_fetch_array($result_min)) 
        {
            $upload_min = $row['TOTAL'];
        }

        $output[] = [
            'UPLOAD'  => $upload,
            'UPDATE'  => $result_upd,
            'UPLOAD_MIN'  => $upload_min,
            'UPDATE_MIN'  => $result_upd_min,
        ];

    }elseif($date_range == "30 Days"){
        $param_date_1   = date('Y-m-d', strtotime("-30 day"));
        $param_date_2   = date('Y-m-d', strtotime("-60 day"));

        $query_upd="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on BETWEEN '$param_date_1' AND '$param_date'";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $TOTAL_upl = $row['TOTAL'];
        }

        $query_upd="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on BETWEEN '$param_date_2' AND '$param_date_1'";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $TOTAL_upl_min = $row['TOTAL'];
        }

        $query_upd="SELECT item_id, COUNT(*) AS TOTAL FROM tb_update WHERE market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date'";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $TOTAL_upd = $row['TOTAL'];
        }

        $query_upd="SELECT item_id, COUNT(*) AS TOTAL FROM tb_update WHERE market_id=$market_id && date BETWEEN '$param_date_2' AND '$param_date_1'";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $TOTAL_upd_min = $row['TOTAL'];
        }

            $output[] = [
                'UPLOAD'  => $TOTAL_upl,
                'UPDATE'  => $TOTAL_upd,
                'UPLOAD_MIN'  => $TOTAL_upl_min,
                'UPDATE_MIN'  => $TOTAL_upd_min,
            ];

    }elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));
        $param_date_2   = date('Y-m-d', strtotime("-24 month"));

        $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY item_id");
        $result_upd = mysqli_num_rows($update);

        $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on BETWEEN '$param_date_2' AND '$param_date_1'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $upload = $row['TOTAL'];
        }

        $update_min = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY item_id");
        $result_upd_min = mysqli_num_rows($update_min);

        $query_min="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on BETWEEN '$param_date_2' AND '$param_date_1'";
        $result_min = mysqli_query($connect, $query_min);
        while($row =mysqli_fetch_array($result_min)) 
        {
            $upload_min = $row['TOTAL'];
        }

        $output[] = [
            'UPLOAD'  => $upload,
            'UPDATE'  => $result_upd,
            'UPLOAD_MIN'  => $upload_min,
            'UPDATE_MIN'  => $result_upd_min,
        ];

    }elseif($date_range == "One Year" && isset($_POST['date']) && isset($_POST['todate'])){
        $date = $_POST['date'];
        $todate = $_POST['todate'];
        
        $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id=$market_id && date BETWEEN '$date' AND '$todate'");
        $result_upd = mysqli_num_rows($update);

        $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on BETWEEN '$date' AND '$todate'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $upload = $row['TOTAL'];
        }

        $update_min = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id=$market_id && date BETWEEN '$date' AND '$todate'");
        $result_upd_min = mysqli_num_rows($update_min);

        $query_min="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on BETWEEN '$date' AND '$todate'";
        $result_min = mysqli_query($connect, $query_min);
        while($row =mysqli_fetch_array($result_min)) 
        {
            $upload_min = $row['TOTAL'];
        }

        $output[] = [
            'UPLOAD'  => $upload,
            'UPDATE'  => $result_upd,
            'UPLOAD_MIN'  => $upload_min,
            'UPDATE_MIN'  => $result_upd_min,
        ];
    }elseif($date_range == "Last Month"){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
        $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

        $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id=$market_id && date LIKE '%$previous_year_month_1%' GROUP BY item_id");
        $result_upd = mysqli_num_rows($update);

        $update_min = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id=$market_id && date LIKE '%$previous_year_month_2%' GROUP BY item_id");
        $result_upd_min = mysqli_num_rows($update_min);

        // ----------------------------------------

        $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on LIKE '%$previous_year_month_1%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $upload = $row['TOTAL'];
        }

        $query_min="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on LIKE '%$previous_year_month_2%'";
        $result_min = mysqli_query($connect, $query_min);
        while($row =mysqli_fetch_array($result_min)) 
        {
            $upload_min = $row['TOTAL'];
        }

        $output[] = [
            'UPLOAD'  => $upload,
            'UPDATE'  => $result_upd,
            'UPLOAD_MIN'  => $upload_min,
            'UPDATE_MIN'  => $result_upd_min,
        ];
    }elseif($date_range == "Last Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));
        $param_year_2   = date('Y', strtotime("-2 year"));

        $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id=$market_id && date LIKE '%$param_year_1%' GROUP BY item_id");
        $result_upd = mysqli_num_rows($update);

        $update_min = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id=$market_id && date LIKE '%$param_year_2%' GROUP BY item_id");
        $result_upd_min = mysqli_num_rows($update_min);

        // ----------------------------------------

        $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on LIKE '%$param_year_1%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $upload = $row['TOTAL'];
        }

        $query_min="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on LIKE '%$param_year_2%'";
        $result_min = mysqli_query($connect, $query_min);
        while($row =mysqli_fetch_array($result_min)) 
        {
            $upload_min = $row['TOTAL'];
        }

        $output[] = [
            'UPLOAD'  => $upload,
            'UPDATE'  => $result_upd,
            'UPLOAD_MIN'  => $upload_min,
            'UPDATE_MIN'  => $result_upd_min,
        ];
    }elseif($date_range == "All Time"){
        $query_upd="SELECT DATE_FORMAT(upload_on, '%Y') AS YEAR FROM tb_catalog WHERE market_id!=5 GROUP BY upload_on DESC LIMIT 1";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $year = $row['YEAR']-1;
            $year_min = (int)$row['YEAR']-2;
        }

        $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id=$market_id && date LIKE '%$year%' GROUP BY item_id");
        $result_upd = mysqli_num_rows($update);

        // $update_min = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE date LIKE '%$year_min%' GROUP BY item_id");
        $result_upd_min = '-';

        // ----------------------------------------

        $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on LIKE '%$year%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $upload = $row['TOTAL'];
        }

        // $query_min="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE upload_on LIKE '%$year_min%'";
        // $result_min = mysqli_query($connect, $query_min);
        // while($row =mysqli_fetch_array($result_min)) 
        // {
            $upload_min = '-';
        // }

        $output[] = [
            'UPLOAD'  => $upload,
            'UPDATE'  => $result_upd,
            'UPLOAD_MIN'  => $upload_min,
            'UPDATE_MIN'  => $result_upd_min,
        ];
    }elseif($date_range == "This Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $update = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id=$market_id && date LIKE '%$param_year%' GROUP BY item_id");
        $result_upd = mysqli_num_rows($update);

        $query="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on LIKE '%$param_year%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $upload = $row['TOTAL'];
        }

        $update_min = mysqli_query($connect, "SELECT item_id, COUNT(*) FROM tb_update WHERE market_id=$market_id && date LIKE '%$param_year_1%' GROUP BY item_id");
        $result_upd_min = mysqli_num_rows($update_min);

        $query_min="SELECT item_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && upload_on LIKE '%$param_year_1%'";
        $result_min = mysqli_query($connect, $query_min);
        while($row =mysqli_fetch_array($result_min)) 
        {
            $upload_min = $row['TOTAL'];
        }

        $output[] = [
            'UPLOAD'  => $upload,
            'UPDATE'  => $result_upd,
            'UPLOAD_MIN'  => $upload_min,
            'UPDATE_MIN'  => $result_upd_min,
        ];

    }
}

echo json_encode($output);
