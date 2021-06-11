<?php
include('../../../../src/connection/connection.php');
$select = $_POST['select'];
$date = $_POST['date'];

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

    if($select == 'All'){

        if($date == 'One Month Last' && !isset($_POST['todate'])){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));

            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$param_year_month%' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date LIKE '%$param_year_month%' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC");

        }elseif($date == '30 Days' && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));
        
            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC");

        }elseif($date == 'One Year Last' && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-12 month"));
            $param_date_2   = date('Y-m-d', strtotime("-24 month"));
        
            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC");

        }elseif(isset($date) && isset($_POST['todate'])){

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
           
            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$date' AND '$todate' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date BETWEEN '$date' AND '$todate' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC");

        }elseif($date == "Last Month" && !isset($_POST['todate'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));
        
            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$previous_year_month_1%' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date LIKE '%$previous_year_month_1%' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC");

        }elseif($date == "This Year" && !isset($_POST['todate'])){
            $param_year_1   = date('Y', strtotime("-1 year"));

            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$param_year GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE year=$param_year GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC");

        }elseif($date == "Last Year" && !isset($_POST['todate'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
            $param_year_2   = date('Y', strtotime("-2 year"));

            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$param_year_1 GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE year=$param_year_1 GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC");

        }elseif($date == "All Time" && !isset($_POST['todate'])){

            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC");
        
        }

        $rows = array();
        while($row = mysqli_fetch_array($sql_market)){
            $rows[] = $row;

        }

        $rowss = array();
        while($data = mysqli_fetch_array($sql_popular)){
            $rowss[] = $data;

        }

        $combinedArray = array_replace_recursive(
            array_combine(array_column($rows, "DATE_POPULARRR"), $rows),
            array_combine(array_column($rowss, "DATE_POPULARRR"), $rowss)
        );

        error_reporting(0);
        foreach( $combinedArray as $value ) {
        if(!empty($value['sales'])){
        $market = array("1" => "GR-Brandearth", "2" => "GR-RRGraph", "3" => "Templatemonster", "4" => "Creativemarket", "5" => "RRSlide");
        ?>
        <tr class="sub-title-table">
            <?php
            if(isset($value['item_id'])){
                $param_nmp = $value['item_id'];
                $name_popular = mysqli_query($connect, "SELECT name FROM tb_popular WHERE item_id='$param_nmp' LIMIT 1");
                while($row = mysqli_fetch_array($name_popular)){
                        ?>
                            <td scope="row"><?=$row['name'];?></td>
                        <?php
                }
            }else{
                ?>
                    <td scope="row"></td>
                <?php
            }
            
            ?>
            <td><?=$value['author'];?></td>
            <td><?=$value['sales'];?></td>
            <td><?=$value['name'];?></td>
            <td><?=$market[$value['market_id']]?></td>
            <td><?=$value['TOTAL'];?></td>
            <td><?=$value['date'];?></td>
        </tr> 
        <?php
        }else{}
        }
    }else{

        if($date == 'One Month Last' && !isset($_POST['todate'])){
            $previous_year_month    = date('Y-m', strtotime("-1 month"));

            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$param_year_month%' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC LIMIT $select");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date LIKE '%$param_year_month%' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT $select");

        }elseif($date == '30 Days' && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-30 day"));
            $param_date_2   = date('Y-m-d', strtotime("-60 day"));
        
            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC LIMIT $select");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT $select");

        }elseif($date == 'One Year Last' && !isset($_POST['todate'])){
            $param_date_1   = date('Y-m-d', strtotime("-12 month"));
            $param_date_2   = date('Y-m-d', strtotime("-24 month"));
        
            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC LIMIT $select");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT $select");

        }elseif(isset($date) && isset($_POST['todate'])){

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
           
            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$date' AND '$todate' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date BETWEEN '$date' AND '$todate' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC");

        }elseif($date == "Last Month" && !isset($_POST['todate'])){
            $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
            $previous_year_month_2    = date('Y-m', strtotime("-2 month"));
        
            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$previous_year_month_1%' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC LIMIT $select");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date LIKE '%$previous_year_month_1%' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT $select");

        }elseif($date == "This Year" && !isset($_POST['todate'])){
            $param_year_1   = date('Y', strtotime("-1 year"));

            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$param_year GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC LIMIT $select");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE year=$param_year GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT $select");

        }elseif($date == "Last Year" && !isset($_POST['todate'])){
            $param_year_1   = date('Y', strtotime("-1 year"));
            $param_year_2   = date('Y', strtotime("-2 year"));

            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$param_year_1 GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC LIMIT $select");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE year=$param_year_1 GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT $select");

        }elseif($date == "All Time" && !isset($_POST['todate'])){

            $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC LIMIT $select");
            $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT $select");
        
        }
        
        $rows = array();
        while($row = mysqli_fetch_array($sql_market)){
            $rows[] = $row;

        }

        $rowss = array();
        while($data = mysqli_fetch_array($sql_popular)){
            $rowss[] = $data;

        }

        $combinedArray = array_replace_recursive(
            array_combine(array_column($rows, "DATE_POPULARRR"), $rows),
            array_combine(array_column($rowss, "DATE_POPULARRR"), $rowss)
        );

        error_reporting(0);
        foreach( $combinedArray as $value ) {
        if(!empty($value['sales'])){
            $market = array("1" => "GR-Brandearth", "2" => "GR-RRGraph", "3" => "Templatemonster", "4" => "Creativemarket", "5" => "RRSlide");
        ?>
        <tr class="sub-title-table">
            <?php
            if(isset($value['item_id'])){
                $param_nmp = $value['item_id'];
                $name_popular = mysqli_query($connect, "SELECT name FROM tb_popular WHERE item_id='$param_nmp' LIMIT 1");
                while($row = mysqli_fetch_array($name_popular)){
                        ?>
                            <td scope="row"><?=$row['name'];?></td>
                        <?php
                }
            }else{
                ?>
                    <td scope="row"></td>
                <?php
            }
            
            ?>
            <td><?=$value['author'];?></td>
            <td><?=$value['sales'];?></td>
            <td><?=$value['name'];?></td>
            <td><?=$market[$value['market_id']]?></td>
            <td><?=$value['TOTAL'];?></td>
            <td><?=$value['date'];?></td>
        </tr> 
        <?php
        }else{}
        }
    }

?>