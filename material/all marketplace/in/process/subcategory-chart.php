<?php
include('../../../../src/connection/connection.php');
$type = $_POST['type'];
$date = $_POST['date'];
$name = $_POST['name'];
$market_sup = array("All" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5");
$item_market = $market_sup[$type];

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

if($item_market == 0){
    if($date == "One Month Last" && !isset($_POST['todate'])){
        $previous_year_month    = date('Y-m', strtotime("-1 month"));
        
        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE category='$name' && sub_category!='' && upload_on LIKE '%$param_year_month%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }

    }elseif($date == "30 Days" && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-30 day"));
        $param_date_2   = date('Y-m-d', strtotime("-60 day"));

        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE category='$name' && sub_category!='' && upload_on BETWEEN '$param_date_1' AND '$param_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }


    }elseif($date == "One Year Last" && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));
        $param_date_2   = date('Y-m-d', strtotime("-24 month"));

        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE category='$name' && sub_category!='' && upload_on BETWEEN '$param_date_1' AND '$param_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }


    }elseif($date == "Last Month" && !isset($_POST['todate'])){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
        $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE category='$name' && sub_category!='' && upload_on LIKE '%$previous_year_month_1%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }



    }elseif($date == "This Year" && !isset($_POST['todate'])){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE category='$name' && sub_category!='' && upload_on LIKE '%$param_year%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }



    }elseif($date == "Last Year" && !isset($_POST['todate'])){
        $param_year_1   = date('Y', strtotime("-1 year"));
        $param_year_2   = date('Y', strtotime("-2 year"));

        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE category='$name' && sub_category!='' && upload_on LIKE '%$param_year_1%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }



    }elseif($date == "All Time" && !isset($_POST['todate'])){

        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE sub_category!='' && category='$name' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }



    }elseif(isset($_POST['date']) && isset($_POST['todate'])){
        $todate = $_POST['todate'];

        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE sub_category!='' && category='$name' && upload_on BETWEEN '$date' AND '$todate' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }



    }
}else{
    if($date == "One Month Last" && !isset($_POST['todate'])){
        $previous_year_month    = date('Y-m', strtotime("-1 month"));
        
        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && category='$name' && sub_category!='' && upload_on LIKE '%$param_year_month%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }

    }elseif($date == "30 Days" && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-30 day"));
        $param_date_2   = date('Y-m-d', strtotime("-60 day"));

        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && category='$name' && sub_category!='' && upload_on BETWEEN '$param_date_1' AND '$param_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }


    }elseif($date == "One Year Last" && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));
        $param_date_2   = date('Y-m-d', strtotime("-24 month"));

        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && category='$name' && sub_category!='' && upload_on BETWEEN '$param_date_1' AND '$param_date' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }


    }elseif($date == "Last Month" && !isset($_POST['todate'])){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
        $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && category='$name' && sub_category!='' && upload_on LIKE '%$previous_year_month_1%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }



    }elseif($date == "This Year" && !isset($_POST['todate'])){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && category='$name' && sub_category!='' && upload_on LIKE '%$param_year%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }



    }elseif($date == "Last Year" && !isset($_POST['todate'])){
        $param_year_1   = date('Y', strtotime("-1 year"));
        $param_year_2   = date('Y', strtotime("-2 year"));

        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && category='$name' && sub_category!='' && upload_on LIKE '%$param_year_1%' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }



    }elseif($date == "All Time" && !isset($_POST['todate'])){

        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && sub_category!='' && category='$name' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }



    }elseif(isset($_POST['date']) && isset($_POST['todate'])){
        $todate = $_POST['todate'];

        $query="SELECT sub_category, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && sub_category!='' && category='$name' && upload_on BETWEEN '$date' AND '$todate' GROUP BY sub_category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["sub_category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["sub_category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }



    }
}

echo json_encode($output);
