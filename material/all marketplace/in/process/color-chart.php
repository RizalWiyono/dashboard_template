<?php
include('../../../../src/connection/connection.php');
$type = $_POST['type'];
$item = $_POST['item'];
$date = $_POST['date'];
$market_sup = array("All" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5");
$item_market = $market_sup[$type];

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

if($item == 'Sales'){
    if($item_market == 0){
        if($date == 'One Month Last' && !isset($_POST['todate'])){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date LIKE '%$param_year_month%' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
        }elseif($date == '30 Days' && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
        }elseif($date == "One Year Last" && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-12 month"));
            $param_date_2   = date('Y-m-d', strtotime("-24 month"));

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
        }elseif(isset($date) && isset($_POST['todate'])){
            $todate = $_POST['todate'];
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date BETWEEN '$date' AND '$todate' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
        }elseif($date == "Last Month" && !isset($_POST['todate'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date LIKE '%$previous_year_month_1%' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
            
        }elseif($date == "This Year" && !isset($_POST['todate'])){
            $param_year_1   = date('Y', strtotime("-1 year"));

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date LIKE '%$param_year%' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
            
        }elseif($date == "Last Year" && !isset($_POST['todate'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
            $param_year_2   = date('Y', strtotime("-2 year"));

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' && date LIKE '%$param_year_1%'  GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
            
        }elseif($date == "All Time" && !isset($_POST['todate'])){

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE color!='' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
            
        }
    }else{
        if($date == 'One Month Last' && !isset($_POST['todate'])){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' && date LIKE '%$param_year_month%' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
        }elseif($date == '30 Days' && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
        }elseif($date == "One Year Last" && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-12 month"));
            $param_date_2   = date('Y-m-d', strtotime("-24 month"));

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
        }elseif(isset($date) && isset($_POST['todate'])){
            $todate = $_POST['todate'];
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' && date BETWEEN '$date' AND '$todate' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
        }elseif($date == "Last Month" && !isset($_POST['todate'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' && date LIKE '%$previous_year_month_1%' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
            
        }elseif($date == "This Year" && !isset($_POST['todate'])){
            $param_year_1   = date('Y', strtotime("-1 year"));

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' && date LIKE '%$param_year%' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
            
        }elseif($date == "Last Year" && !isset($_POST['todate'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
            $param_year_2   = date('Y', strtotime("-2 year"));

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' && date LIKE '%$param_year_1%'  GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
            
        }elseif($date == "All Time" && !isset($_POST['todate'])){

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id='$item_market' && color!='' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];

                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }

            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
            
        }
    }
}else{
    if($item_market == 0){
        if($date == "One Month Last" && !isset($_POST['todate'])){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));
            
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' && upload_on LIKE '%$param_year_month%' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
        }elseif($date == "30 Days" && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' && upload_on BETWEEN '$param_date_1' AND '$param_date' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
    
        }elseif($date == "One Year Last" && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-12 month"));
            $param_date_2   = date('Y-m-d', strtotime("-24 month"));
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' && upload_on BETWEEN '$param_date_1' AND '$param_date' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
    
        }elseif($date == "Last Month" && !isset($_POST['todate'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' && upload_on LIKE '%$previous_year_month_1%' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
    
    
        }elseif($date == "This Year" && !isset($_POST['todate'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' && upload_on LIKE '%$param_year%' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
    
    
        }elseif($date == "Last Year" && !isset($_POST['todate'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
            $param_year_2   = date('Y', strtotime("-2 year"));

            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' && upload_on LIKE '%$param_year_1%' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
    
    
        }elseif($date == "All Time" && !isset($_POST['todate'])){
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
    
    
        }elseif(isset($_POST['date']) && isset($_POST['todate'])){
            $todate = $_POST['todate'];
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE color!='' && upload_on BETWEEN '$date' AND '$todate' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
    
    
        }
    }else{
        if($date == "One Month Last" && !isset($_POST['todate'])){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));
            
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' && upload_on LIKE '%$param_year_month%' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
        }elseif($date == "30 Days" && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' && upload_on BETWEEN '$param_date_1' AND '$param_date' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
    
        }elseif($date == "One Year Last" && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-12 month"));
            $param_date_2   = date('Y-m-d', strtotime("-24 month"));
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' && upload_on BETWEEN '$param_date_1' AND '$param_date' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
    
        }elseif($date == "Last Month" && !isset($_POST['todate'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' && upload_on LIKE '%$previous_year_month_1%' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
    
    
        }elseif($date == "This Year" && !isset($_POST['todate'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' && upload_on LIKE '%$param_year%' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
    
    
        }elseif($date == "Last Year" && !isset($_POST['todate'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
            $param_year_2   = date('Y', strtotime("-2 year"));
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' && upload_on LIKE '%$param_year_1%' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
    
    
        }elseif($date == "All Time" && !isset($_POST['todate'])){
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
    
    
        }elseif(isset($_POST['date']) && isset($_POST['todate'])){
            $todate = $_POST['todate'];
    
            $query="SELECT color, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id='$item_market' && color!='' && upload_on BETWEEN '$date' AND '$todate' GROUP BY color DESC ORDER BY TOTAL DESC";
            $result = mysqli_query($connect, $query);
            while($row =mysqli_fetch_array($result)) {
                $param_item = $row["color"];
    
                $output[] = [
                    'TOTAL'  => $row["TOTAL"],
                    'COLOR'  => $row["color"],
                ];
            }
    
            if(!isset($param_item)){
                $output[] = [
                    'TOTAL'  => 0,
                    'COLOR'  => '',
                ];
            }
    
    
    
        }
    }
}
    

echo json_encode($output);
