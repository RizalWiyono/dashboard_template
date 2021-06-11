<?php
include('../../../../src/connection/connection.php');
$type = $_POST['type'];
$date = $_POST['date'];
// $todate = $_POST['todate'];
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
        
        $query="SELECT year, month, category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && year=$param_year && month=$param_month GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
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

        $query="SELECT category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
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

        $query="SELECT category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
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

        $query="SELECT category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date LIKE '%$previous_year_month_1%' GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
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

        $query="SELECT category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date LIKE '%$param_year%' GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
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

        $query="SELECT category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date LIKE '%$param_year_1%' GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }



    }elseif($date == "All Time" && !isset($_POST['todate'])){

        $query="SELECT category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
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

        $query="SELECT category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE category!='' && date BETWEEN '$date' AND '$todate' GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
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
        
        $query="SELECT year, month, category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && category!='' && year=$param_year && month=$param_month GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
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

        $query="SELECT category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && category!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
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

        $query="SELECT category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && category!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
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

        $query="SELECT category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && category!='' && date LIKE '%$previous_year_month_1%' GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
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

        $query="SELECT category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && category!='' && date LIKE '%$param_year%' GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
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

        $query="SELECT category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && category!='' && date LIKE '%$param_year_1%' GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
            ];
        }

        if(!isset($param_item)){
            $output[] = [
                'TOTAL'  => 0,
                'COUNTRY'  => '',
            ];
        }



    }elseif($date == "All Time" && !isset($_POST['todate'])){

        $query="SELECT category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && category!='' GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
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

        $query="SELECT category, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && category!='' && date BETWEEN '$date' AND '$todate' GROUP BY category DESC ORDER BY TOTAL DESC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) {
            $param_item = $row["category"];

            $output[] = [
                'TOTAL'  => $row["TOTAL"],
                'COUNTRY'  => $row["category"],
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
