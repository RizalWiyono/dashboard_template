<?php
include('../../../../src/connection/connection.php');
$type = $_POST['type'];
$date = $_POST['this_value'];
$select = $_POST['select'];
$market_sup = array("All Marketplace" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5");
$item_market = $market_sup[$type];

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

if($item_market == 0){
    if($select == 'All'){
        if($date == 'One Month Last' && !isset($_POST['todate'])){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && country!='' && date LIKE '%$param_year_month%' GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }

        }elseif($date == '30 Days' && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));
    
            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE country!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
        }elseif(isset($date) && isset($_POST['this_values'])){
            $todate = $_POST['this_values'];
    
            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && country!='' && date BETWEEN '$date' AND '$todate' GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
        }if($date == 'Last Month' && !isset($_POST['todate'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && date LIKE '%$previous_year_month_1%' GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE country!='' && year=$param_year GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE country!='' && year=$param_year_1 GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
        }elseif($date == "All Time" && !isset($_POST['todate'])){

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE country!='' GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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
        if($date == 'One Month Last' && !isset($_POST['todate'])){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && date LIKE '%$param_year_month%' GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }

        }elseif($date == '30 Days' && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));
    
            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE country!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
        }elseif(isset($date) && isset($_POST['this_values'])){
            $todate = $_POST['this_values'];
    
            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && country!='' && date BETWEEN '$date' AND '$todate' GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
        }if($date == 'Last Month' && !isset($_POST['todate'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && date LIKE '%$previous_year_month_1%' GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE country!='' && year=$param_year GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE country!='' && year=$param_year_1 GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
        }elseif($date == "All Time" && !isset($_POST['todate'])){

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE country!='' GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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
}else{
    if($select == 'All'){
        if($date == 'One Month Last' && !isset($_POST['todate'])){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && country!='' && country!='' && date LIKE '%$param_year_month%' GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }

        }elseif($date == '30 Days' && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));
    
            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && country!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE tb_sales.market_id='$item_market' && country!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
        }elseif(isset($date) && isset($_POST['this_values'])){
            $todate = $_POST['this_values'];
    
            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && country!='' && country!='' && date BETWEEN '$date' AND '$todate' GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
        }if($date == 'Last Month' && !isset($_POST['todate'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && country!='' && date LIKE '%$previous_year_month_1%' GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE tb_sales.market_id='$item_market' && country!='' && year=$param_year GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE tb_sales.market_id='$item_market' && country!='' && year=$param_year_1 GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
        }elseif($date == "All Time" && !isset($_POST['todate'])){

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE tb_sales.market_id='$item_market' && country!='' GROUP BY country DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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
        if($date == 'One Month Last' && !isset($_POST['todate'])){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && country!='' && date LIKE '%$param_year_month%' GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }

        }elseif($date == '30 Days' && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));
    
            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && country!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE tb_sales.market_id='$item_market' && country!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
        }elseif(isset($date) && isset($_POST['this_values'])){
            $todate = $_POST['this_values'];
    
            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && country!='' && country!='' && date BETWEEN '$date' AND '$todate' GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
        }if($date == 'Last Month' && !isset($_POST['todate'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && country!='' && date LIKE '%$previous_year_month_1%' GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE tb_sales.market_id='$item_market' && country!='' && year=$param_year GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE tb_sales.market_id='$item_market' && country!='' && year=$param_year_1 GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COUNTRY'  => '',
                ];
            }
        }elseif($date == "All Time" && !isset($_POST['todate'])){

            $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE tb_sales.market_id='$item_market' && country!='' GROUP BY country DESC ORDER BY TOTAL DESC LIMIT $select";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["country"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COUNTRY'  => $row["country"],
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
}

echo json_encode($output);
