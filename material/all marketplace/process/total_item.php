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

if($market_id == 0){
    if($date_range == "This Month"){

        $query="SELECT a.year, (SELECT  COUNT(*) FROM tb_sales WHERE date LIKE '%$param_year_month%') as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Keynote%' && date LIKE '%$param_year_month%') as TOTALKY, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Potrait%' && date LIKE '%$param_year_month%') as TOTALPT 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $total = $row["TOTAL"]-($row["TOTALKY"]+$row["TOTALPT"]);

            $output[] = [
                'PPT'  => $total
            ];
        }

        $query="SELECT month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Keynote%' && date LIKE '%$param_year_month%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {

            $output[] = [
                'KY'  => $row['TOTAL']
            ];
        }

        $query="SELECT month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Potrait%' && date LIKE '%$param_year_month%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {

            $output[] = [
                'PT'  => $row['TOTAL']
            ];
        }

        $query="SELECT * FROM tb_sales WHERE date LIKE '%$param_year_month%' GROUP BY date ORDER BY year DESC, month DESC, day DESC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $param_date = $row["date"];
        }

        $start_date = date("Y-m-01", strtotime($param_date));
        $output[] = [
            'start'  => $start_date,
        ];

        $end_date = date("Y-m-t", strtotime($param_date));
        $output[] = [
            'end'  => $end_date,
        ];

        $earlier = new DateTime("$start_date");
        $later = new DateTime("$end_date");
        
        $diff = $later->diff($earlier)->format("%a");

        $output[] = [
            'totdat_days'  => $diff
        ];

    }elseif($date_range == "30 Days"){
        $param_date_1   = date('Y-m-d', strtotime("-30 day"));

        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year DESC, month DESC, day DESC) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $TOTAL = $row["TOTAL"];
        }

        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Keynote%' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year DESC, month DESC, day DESC) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            if($row["TOTAL"] == NULL){
                $KEYNOTE = 0;
            }else{
                $KEYNOTE = $row["TOTAL"];
            }
        }

        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Potrait%' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year DESC, month DESC, day DESC) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            if($row["TOTAL"] == NULL){
                $POTRAIT = 0;
            }else{
                $POTRAIT = $row["TOTAL"];
            }
        }

        $sum = $TOTAL-($KEYNOTE+$POTRAIT);

        $output[] = [
            'PPT'  => $sum
        ];
        
        $output[] = [
            'KY'  => $KEYNOTE
        ];

        $output[] = [
            'PT'  => $POTRAIT
        ];

        
        $output[] = [
            'start'  => $param_date,
        ];

        $output[] = [
            'end'  => $param_date_1,
        ];

        $earlier = new DateTime("$param_date");
        $later = new DateTime("$param_date_1");
        
        $diff = $later->diff($earlier)->format("%a");

        $output[] = [
            'totdat_days'  => $diff
        ];


    }elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));

        $query="SELECT a.year, (SELECT  COUNT(*) FROM tb_sales WHERE date BETWEEN '$param_date_1' AND '$param_date') as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Keynote%' && date BETWEEN '$param_date_1' AND '$param_date') as TOTALKY, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE name LIKE '%Potrait%' && date BETWEEN '$param_date_1' AND '$param_date') as TOTALPT 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $total = $row["TOTAL"]-($row["TOTALKY"]+$row["TOTALPT"]);

            $output[] = [
                'PPT'  => $total
            ];

            $output[] = [
                'KY'  => $row['TOTALKY']
            ];

            $output[] = [
                'PT'  => $row['TOTALPT']
            ];
        }


        
        $query="SELECT * FROM tb_sales WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY date ORDER BY year ASC, month ASC, day ASC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $start_date = $row["date"];

            $output[] = [
                'start'  => $row["date"],
            ];
        }

        $query="SELECT * FROM tb_sales WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY date ORDER BY year DESC, month DESC, day DESC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $end_date = $row["date"];

            $output[] = [
                'end'  => $row["date"],
            ];
        }

        $earlier = new DateTime("$start_date");
        $later = new DateTime("$end_date");
        
        $diff = $later->diff($earlier)->format("%a");

        $output[] = [
            'totdat_days'  => $diff
        ];

    }elseif($date_range == "One Year" && isset($_POST['date']) && isset($_POST['todate'])){
        $date = $_POST['date'];
        $todate = $_POST['todate'];
        
        $query="SELECT a.year, (SELECT  COUNT(*) FROM tb_sales WHERE date BETWEEN '$date' AND '$todate') as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Keynote%' && date BETWEEN '$date' AND '$todate' ) as TOTALKY, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE name LIKE '%Potrait%' && date BETWEEN '$date' AND '$todate' ) as TOTALPT 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $total = $row["TOTAL"]-($row["TOTALKY"]+$row["TOTALPT"]);

            $output[] = [
                'PPT'  => $total
            ];
        }

        $query="SELECT month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Keynote%' &&  date BETWEEN '$date' AND '$todate' ";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {

            $output[] = [
                'KY'  => $row['TOTAL']
            ];
        }

        $query="SELECT month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Potrait%' && date BETWEEN '$date' AND '$todate' ";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {

            $output[] = [
                'PT'  => $row['TOTAL']
            ];
        }

        $output[] = [
            'start'  => $date,
        ];

        $output[] = [
            'end'  => $todate,
        ];

        $earlier = new DateTime("$date");
        $later = new DateTime("$todate");
        
        $diff = $later->diff($earlier)->format("%a");

        $output[] = [
            'totdat_days'  => $diff
        ];

    }elseif($date_range == "Last Month"){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));

        $query="SELECT a.year, (SELECT  COUNT(*) FROM tb_sales WHERE date LIKE '%$previous_year_month_1%') as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Keynote%' && date LIKE '%$previous_year_month_1%') as TOTALKY, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Potrait%' && date LIKE '%$previous_year_month_1%') as TOTALPT 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $total = $row["TOTAL"]-($row["TOTALKY"]+$row["TOTALPT"]);

            $output[] = [
                'PPT'  => $total
            ];

            $output[] = [
                'KY'  => $row['TOTALKY']
            ];

            $output[] = [
                'PT'  => $row['TOTALPT']
            ];
        }

        

        $query_upd="SELECT day, date, COUNT(*) as TOTAL FROM tb_sales WHERE date LIKE '%$previous_year_month_1%' GROUP BY day ORDER BY year ASC, month ASC, day ASC LIMIT 1";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $start_date = $row["date"];

            $output[] = [
                'start'  => $row["date"],
            ];
        }

        $query_upd="SELECT day, date, COUNT(*) as TOTAL FROM tb_sales WHERE date LIKE '%$previous_year_month_1%' GROUP BY day ORDER BY year DESC, month DESC, day DESC LIMIT 1";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $end_date = $row["date"];

            $output[] = [
                'end'  => $row["date"],
            ];
        }

        $earlier = new DateTime("$start_date");
        $later = new DateTime("$end_date");
        
        $diff = $later->diff($earlier)->format("%a");

        $output[] = [
            'totdat_days'  => $diff
        ];

    }elseif($date_range == "Last Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $query="SELECT a.year, (SELECT  COUNT(*) FROM tb_sales WHERE year=$param_year_1) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Keynote%' && year=$param_year_1) as TOTALKY, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Potrait%' && year=$param_year_1) as TOTALPT 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $total = $row["TOTAL"]-($row["TOTALKY"]+$row["TOTALPT"]);

            $output[] = [
                'PPT'  => $total
            ];

            $output[] = [
                'KY'  => $row['TOTALKY']
            ];

            $output[] = [
                'PT'  => $row['TOTALPT']
            ];
        }

        
        $query_upd="SELECT year, month, date FROM tb_sales WHERE year=$param_year_1 ORDER BY year ASC, month ASC, day ASC LIMIT 1";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $start_date = $row["date"];

            $output[] = [
                'start'  => $row["date"],
            ];
        }

        $query_upd="SELECT year, month, date FROM tb_sales WHERE year=$param_year_1 ORDER BY year DESC, month DESC, day DESC LIMIT 1";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $end_date = $row["date"];

            $output[] = [
                'end'  => $row["date"],
            ];
        }

        $earlier = new DateTime("$start_date");
        $later = new DateTime("$end_date");
        
        $diff = $later->diff($earlier)->format("%a");

        $output[] = [
            'totdat_days'  => $diff
        ];

    }elseif($date_range == "All Time"){
        $query="SELECT a.year, (SELECT  COUNT(*) FROM tb_sales) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Keynote%') as TOTALKY, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Potrait%') as TOTALPT 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $total = $row["TOTAL"]-($row["TOTALKY"]+$row["TOTALPT"]);

            $output[] = [
                'PPT'  => $total
            ];

            $output[] = [
                'KY'  => $row['TOTALKY']
            ];

            $output[] = [
                'PT'  => $row['TOTALPT']
            ];
        }

        
        $query_upd="SELECT year, month, date, COUNT(*) as TOTAL FROM tb_sales GROUP BY month ORDER BY year ASC, month ASC, day ASC LIMIT 1 ";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $start_date = $row["date"];

            $output[] = [
                'start'  => $row["date"],
            ];
        }

        $query_upd="SELECT year, month, date, COUNT(*) as TOTAL FROM tb_sales GROUP BY month ORDER BY year DESC, month DESC, day DESC LIMIT 1 ";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $end_date = $row["date"];

            $output[] = [
                'end'  => $row["date"],
            ];
        }

        $earlier = new DateTime("$start_date");
        $later = new DateTime("$end_date");
        
        $diff = $later->diff($earlier)->format("%a");

        $output[] = [
            'totdat_days'  => $diff
        ];

    }elseif($date_range == "This Year"){

        $query="SELECT a.year, (SELECT  COUNT(*) FROM tb_sales WHERE year=$param_year) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Keynote%' && year=$param_year) as TOTALKY, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE name LIKE '%Potrait%' && year=$param_year) as TOTALPT 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $total = $row["TOTAL"]-($row["TOTALKY"]+$row["TOTALPT"]);

            $output[] = [
                'PPT'  => $total
            ];
        }

        $query="SELECT month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Keynote%' && year=$param_year";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {

            $output[] = [
                'KY'  => $row['TOTAL']
            ];
        }

        $query="SELECT month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Potrait%' && year=$param_year";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {

            $output[] = [
                'PT'  => $row['TOTAL']
            ];
        }

        
        $query="SELECT * FROM tb_sales WHERE year=$param_year GROUP BY date ORDER BY year ASC, month ASC, day ASC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $start_date = $row["date"];

            $output[] = [
                'start'  => $row["date"],
            ];
        }

        $query="SELECT * FROM tb_sales WHERE year=$param_year GROUP BY date ORDER BY year DESC, month DESC, day DESC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $end_date = $row["date"];

            $output[] = [
                'end'  => $row["date"],
            ];
        }

        $earlier = new DateTime("$start_date");
        $later = new DateTime("$end_date");
        
        $diff = $later->diff($earlier)->format("%a");

        $output[] = [
            'totdat_days'  => $diff
        ];

    }
}else{
    if($date_range == "This Month"){

        $query="SELECT a.year, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date LIKE '%$param_year_month%') as TOTAL, 
        (SELECT  COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Keynote%' && tb_sales.market_id=$market_id && date LIKE '%$param_year_month%') as TOTALKY, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Potrait%' && tb_sales.market_id=$market_id && date LIKE '%$param_year_month%') as TOTALPT 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
        $result = mysqli_query($connect, $query); 
        while($row =mysqli_fetch_array($result)) 
        {
            $total = $row["TOTAL"]-($row["TOTALKY"]+$row["TOTALPT"]);

            $output[] = [
                'PPT'  => $total
            ];
        }

        $query="SELECT tb_sales.month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Keynote%' && tb_sales.market_id=$market_id && date LIKE '%$param_year_month%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {

            $output[] = [
                'KY'  => $row['TOTAL']
            ];
        }

        $query="SELECT tb_sales.month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Potrait%' && tb_sales.market_id=$market_id && date LIKE '%$param_year_month%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {

            $output[] = [
                'PT'  => $row['TOTAL']
            ];
        }

        
        $query="SELECT * FROM tb_sales WHERE market_id=$market_id && date LIKE '%$param_year_month%' GROUP BY date ORDER BY year ASC, month ASC, day ASC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'start'  => $row["date"],
            ];
        }

        $query="SELECT * FROM tb_sales WHERE market_id=$market_id && date LIKE '%$param_year_month%'  GROUP BY date ORDER BY year DESC, month DESC, day DESC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'end'  => $row["date"],
            ];
        }


    }elseif($date_range == "30 Days"){
        $param_date_1   = date('Y-m-d', strtotime("-30 day"));

        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year DESC, month DESC, day DESC ) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $TOTAL = $row["TOTAL"];
            
        }

        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Keynote%' && tb_sales.market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year DESC, month DESC, day DESC ) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            if($row["TOTAL"] == NULL){
                $KEYNOTE = 0;
            }else{
                $KEYNOTE = $row["TOTAL"];
            }
        }


        $query="SELECT mycount, SUM(mycount) AS TOTAL FROM (SELECT COUNT(*) AS mycount FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%Potrait%' && tb_sales.market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY year DESC, month DESC, day DESC ) counttable";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            if($row["TOTAL"] == NULL){
                $POTRAIT = 0;
            }else{
                $POTRAIT = $row["TOTAL"];
            }
        }

        $sum = $TOTAL-($KEYNOTE+$POTRAIT);

        $output[] = [
            'PPT'  => $sum
        ];
        
        $output[] = [
            'KY'  => $KEYNOTE
        ];

        $output[] = [
            'PT'  => $POTRAIT
        ];

        
        $output[] = [
            'start'  => $param_date,
        ];

        $output[] = [
            'end'  => $param_date_1,
        ];

    }elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));

        $query="SELECT a.year, (SELECT  COUNT(*) FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date') as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Keynote%' && date BETWEEN '$param_date_1' AND '$param_date') as TOTALKY, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Potrait%' && date BETWEEN '$param_date_1' AND '$param_date') as TOTALPT 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $total = $row["TOTAL"]-($row["TOTALKY"]+$row["TOTALPT"]);

            $output[] = [
                'PPT'  => $total
            ];

            $output[] = [
                'KY'  => $row['TOTALKY']
            ];

            $output[] = [
                'PT'  => $row['TOTALPT']
            ];
        }


        
        $query="SELECT * FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY date ORDER BY year ASC, month ASC, day ASC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'start'  => $row["date"],
            ];
        }

        $query="SELECT * FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY date ORDER BY year DESC, month DESC, day DESC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'end'  => $row["date"],
            ];
        }


    }elseif($date_range == "One Year" && isset($_POST['date']) && isset($_POST['todate'])){
        $date = $_POST['date'];
        $todate = $_POST['todate'];
        
        $query="SELECT a.year, (SELECT  COUNT(*) FROM tb_sales WHERE tb_sales.market_id=$market_id && date BETWEEN '$date' AND '$todate') as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Keynote%' && date BETWEEN '$date' AND '$todate' ) as TOTALKY, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id  WHERE tb_sales.market_id=$market_id && name LIKE '%Potrait%' && date BETWEEN '$date' AND '$todate' ) as TOTALPT 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $total = $row["TOTAL"]-($row["TOTALKY"]+$row["TOTALPT"]);

            $output[] = [
                'PPT'  => $total
            ];
        }

        $query="SELECT month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Keynote%' &&  date BETWEEN '$date' AND '$todate' ";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {

            $output[] = [
                'KY'  => $row['TOTAL']
            ];
        }

        $query="SELECT month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Potrait%' && date BETWEEN '$date' AND '$todate' ";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {

            $output[] = [
                'PT'  => $row['TOTAL']
            ];
        }

    }elseif($date_range == "Last Month"){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));

        $query="SELECT a.year, (SELECT  COUNT(*) FROM tb_sales WHERE market_id=$market_id && date LIKE '%$previous_year_month_1%') as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Keynote%' && date LIKE '%$previous_year_month_1%') as TOTALKY, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Potrait%' && date LIKE '%$previous_year_month_1%') as TOTALPT 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $total = $row["TOTAL"]-($row["TOTALKY"]+$row["TOTALPT"]);

            $output[] = [
                'PPT'  => $total
            ];

            $output[] = [
                'KY'  => $row['TOTALKY']
            ];

            $output[] = [
                'PT'  => $row['TOTALPT']
            ];
        }

        

        $query_upd="SELECT day, date, COUNT(*) as TOTAL FROM tb_sales WHERE market_id=$market_id && date LIKE '%$previous_year_month_1%'  GROUP BY day ORDER BY year ASC, month ASC, day ASC LIMIT 1";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $output[] = [
                'start'  => $row["date"],
            ];
        }

        $query_upd="SELECT day, date, COUNT(*) as TOTAL FROM tb_sales WHERE market_id=$market_id && date LIKE '%$previous_year_month_1%'  GROUP BY day ORDER BY year DESC, month DESC, day DESC LIMIT 1";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $output[] = [
                'end'  => $row["date"],
            ];
        }
    }elseif($date_range == "Last Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $query="SELECT a.year, (SELECT  COUNT(*) FROM tb_sales WHERE market_id=$market_id && year=$param_year_1) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Keynote%' && year=$param_year_1) as TOTALKY, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Potrait%' && year=$param_year_1) as TOTALPT 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $total = $row["TOTAL"]-($row["TOTALKY"]+$row["TOTALPT"]);

            $output[] = [
                'PPT'  => $total
            ];

            $output[] = [
                'KY'  => $row['TOTALKY']
            ];

            $output[] = [
                'PT'  => $row['TOTALPT']
            ];
        }

        
        $query_upd="SELECT year, month, date, COUNT(*) as TOTAL FROM tb_sales WHERE market_id=$market_id && year=$param_year_1 GROUP BY month ORDER BY year ASC, month ASC, day ASC LIMIT 1";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $output[] = [
                'start'  => $row["date"],
            ];
        }

        $query_upd="SELECT year, month, date, COUNT(*) as TOTAL FROM tb_sales WHERE market_id=$market_id && year=$param_year_1 GROUP BY month ORDER BY year DESC, month DESC, day DESC LIMIT 1";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $output[] = [
                'end'  => $row["date"],
            ];
        }
    }elseif($date_range == "All Time"){
        $query="SELECT a.year, (SELECT  COUNT(*) FROM tb_sales WHERE market_id=$market_id) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Keynote%') as TOTALKY, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Potrait%') as TOTALPT 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $total = $row["TOTAL"]-($row["TOTALKY"]+$row["TOTALPT"]);

            $output[] = [
                'PPT'  => $total
            ];

            $output[] = [
                'KY'  => $row['TOTALKY']
            ];

            $output[] = [
                'PT'  => $row['TOTALPT']
            ];
        }

        

        $query_upd="SELECT year, month, date, COUNT(*) as TOTAL FROM tb_sales WHERE market_id=$market_id GROUP BY month ORDER BY year ASC, month ASC, day ASC LIMIT 1 ";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $output[] = [
                'start'  => $row["date"],
            ];
        }

        $query_upd="SELECT year, month, date, COUNT(*) as TOTAL FROM tb_sales WHERE market_id=$market_id GROUP BY month ORDER BY year DESC, month DESC, day DESC LIMIT 1 ";
        $result_upd = mysqli_query($connect, $query_upd);
        while($row =mysqli_fetch_array($result_upd)) 
        {
            $output[] = [
                'end'  => $row["date"],
            ];
        }
    }elseif($date_range == "This Year"){

        $query="SELECT a.year, (SELECT  COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && year=$param_year) as TOTAL, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Keynote%' && year=$param_year) as TOTALKY, 
        (SELECT COUNT(*) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Potrait%' && year=$param_year) as TOTALPT 
        FROM (SELECT DISTINCT year FROM tb_sales GROUP BY year ASC LIMIT 1) a";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $total = $row["TOTAL"]-($row["TOTALKY"]+$row["TOTALPT"]);

            $output[] = [
                'PPT'  => $total
            ];
        }

        $query="SELECT month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Keynote%' && year=$param_year";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {

            $output[] = [
                'KY'  => $row['TOTAL']
            ];
        }

        $query="SELECT month, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%Potrait%' && year=$param_year";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {

            $output[] = [
                'PT'  => $row['TOTAL']
            ];
        }

        $query="SELECT * FROM tb_sales WHERE market_id=$market_id && year=$param_year GROUP BY date ORDER BY year ASC, month ASC, day ASC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'start'  => $row["date"],
            ];
        }

        $query="SELECT * FROM tb_sales WHERE market_id=$market_id && year=$param_year GROUP BY date ORDER BY year DESC, month DESC, day DESC LIMIT 1";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $output[] = [
                'end'  => $row["date"],
            ];
        }

    }
}

echo json_encode($output);
