<?php
error_reporting(0);
$date_range = $_POST['this_value'];
$market = $_POST['market'];
$month = array("1" => "GR - Brandearth", "2" => "GR - RRGraph", "3" => "Templatemonster", "4" => "Creativemarket", "5" => "RRSlides");
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
        $previous_year_month    = date('Y-m', strtotime("-1 month"));

        $query="SELECT tb_sales.item_id, name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$param_year_month%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];
            $item = $row['item_id'];

            $query_current = "SELECT * FROM tb_sales WHERE item_id='$item' && date LIKE '%$param_year_month%'";
            $query_previous = "SELECT * FROM tb_sales WHERE item_id='$item' && date LIKE '%$previous_year_month%'";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }

    }elseif($date_range == "30 Days"){
        $param_date_1   = date('Y-m-d', strtotime("-30 day"));
        $param_date_2   = date('Y-m-d', strtotime("-60 day"));

        $query="SELECT name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];

            $query_current = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' && date BETWEEN '$param_date_1' AND '$param_date'";
            $query_previous = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' && date BETWEEN '$param_date_2' AND '$param_date_1'";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }

    }elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));
        $param_date_2   = date('Y-m-d', strtotime("-24 month"));

        $query="SELECT name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];

            $query_current = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' &&  date BETWEEN '$param_date_1' AND '$param_date'";
            $query_previous = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' &&  date BETWEEN '$param_date_2' AND '$param_date_1'";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));


            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }

    }elseif($date_range == "One Year" && isset($_POST['date']) && isset($_POST['todate'])){
        $date = $_POST['date'];
        $todate = $_POST['todate'];
        
        $query="SELECT name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$date' AND '$todate' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];

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

            $query_current = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' &&  date BETWEEN '$date' AND '$todate'";
            $query_previous = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' &&  date BETWEEN '$date_1' AND '$date_2'";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));


            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }

    }elseif($date_range == "Last Month"){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
        $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

        $query="SELECT tb_sales.item_id, name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$previous_year_month_1%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];
            $item = $row['item_id'];

            $query_current = "SELECT * FROM tb_sales WHERE item_id='$item' && date LIKE '%$previous_year_month_1%'";
            $query_previous = "SELECT * FROM tb_sales WHERE item_id='$item' && date LIKE '%$previous_year_month_2%'";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }
    }elseif($date_range == "Last Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));
        $param_year_2   = date('Y', strtotime("-2 year"));
        
        $query="SELECT tb_sales.item_id, name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$param_year_1 GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];
            $item = $row['item_id'];

            $query_current = "SELECT * FROM tb_sales WHERE item_id='$item' && year=$param_year_1";
            $query_previous = "SELECT * FROM tb_sales WHERE item_id='$item' && year=$param_year_2";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }
    }elseif($date_range == "All Time"){
        $query="SELECT tb_sales.item_id, name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];
            $item = $row['item_id'];

            $query_current = "SELECT * FROM tb_sales WHERE item_id='$item'";
            $query_previous = "SELECT * FROM tb_sales WHERE item_id='$item'";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }
    }elseif($date_range == "This Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $query="SELECT name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$param_year GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];

            $query_current = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' && year=$param_year";
            $query_previous = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$name%' && year=$param_year_1";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));


            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }

    }
}else{
    if($date_range == "This Month"){
        $previous_year_month    = date('Y-m', strtotime("-1 month"));

        $query="SELECT name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date LIKE '%$param_year_month%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];

            $query_current = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%$name%' && date LIKE '%$param_year_month%'";
            $query_previous = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%$name%' && date LIKE '%$previous_year_month%'";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$name;?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }

    }elseif($date_range == "30 Days"){
        $param_date_1   = date('Y-m-d', strtotime("-30 day"));
        $param_date_2   = date('Y-m-d', strtotime("-60 day"));

        $query="SELECT name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];

            $query_current = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%$name%' && date BETWEEN '$param_date_1' AND '$param_date'";
            $query_previous = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%$name%' && date BETWEEN '$param_date_2' AND '$param_date_1'";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));


            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }

    }elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
        $param_date_1   = date('Y-m-d', strtotime("-12 month"));
        $param_date_2   = date('Y-m-d', strtotime("-24 month"));

        $query="SELECT name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];

            $query_current = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%$name%' &&  date BETWEEN '$param_date_1' AND '$param_date'";
            $query_previous = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%$name%' &&  date BETWEEN '$param_date_2' AND '$param_date_1'";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));


            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }

    }elseif($date_range == "One Year" && isset($_POST['date']) && isset($_POST['todate'])){
        $date = $_POST['date'];
        $todate = $_POST['todate'];
        
        $query="SELECT name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date BETWEEN '$date' AND '$todate' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];

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

            $query_current = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%$name%' &&  date BETWEEN '$date' AND '$todate'";
            $query_previous = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%$name%' &&  date BETWEEN '$date_1' AND '$date_2'";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));


            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }

    }elseif($date_range == "Last Month"){
        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
        $previous_year_month_2    = date('Y-m', strtotime("-2 month"));
        
        $query="SELECT tb_sales.item_id, name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && date LIKE '%$previous_year_month_1%' GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];
            $item = $row['item_id'];

            $query_current = "SELECT * FROM tb_sales WHERE market_id=$market_id && item_id='$item' && date LIKE '%$previous_year_month_1%'";
            $query_previous = "SELECT * FROM tb_sales WHERE market_id=$market_id && item_id='$item' && date LIKE '%$previous_year_month_2%'";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }
    }elseif($date_range == "Last Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));
        $param_year_2   = date('Y', strtotime("-2 year"));

        $query="SELECT tb_sales.item_id, name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && year=$param_year_1 GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];
            $item = $row['item_id'];

            $query_current = "SELECT * FROM tb_sales WHERE market_id=$market_id && item_id='$item' && year=$param_year_1";
            $query_previous = "SELECT * FROM tb_sales WHERE market_id=$market_id && item_id='$item' && year=$param_year_2";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }
    }elseif($date_range == "All Time"){
        $query="SELECT tb_sales.item_id, name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];
            $item = $row['item_id'];

            $query_current = "SELECT * FROM tb_sales WHERE market_id=$market_id && item_id='$item'";
            $query_previous = "SELECT * FROM tb_sales WHERE market_id=$market_id && item_id='$item'";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }
    }elseif($date_range == "This Year"){
        $param_year_1   = date('Y', strtotime("-1 year"));

        $query="SELECT name, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && year=$param_year GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 5";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $name = $row['name'];

            $query_current = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%$name%' && year=$param_year";
            $query_previous = "SELECT name FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=$market_id && name LIKE '%$name%' && year=$param_year_1";

            $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
            $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

            $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name'];?></td>
                    <td><?=$row['TOTAL'];?></td>
                    <td>
                        <?php
                        if($rates >= 0){
                        ?>
                        <p class="top-rate"> 
                            <div class="top-shape-circle" align="center">
                                <img src="../../src/image/Polygon 1.png" alt="">
                            </div>
                            <p class="top-rate">+<?=number_format($rates, 0)?></p>
                            <p class="top-rate">%</p>
                        </p>
                        <?php
                        }else{
                        ?>
                        <p class="top-rate-min"> 
                            <div class="top-shape-circle-min" align="center">
                                <img src="../../src/image/Polygon 1 (1).png" alt="">
                            </div>
                            <p class="top-rate-min"><?=number_format($rates, 0)?></p>
                            <p class="top-rate-min">%</p>
                        </p>
                        <?php
                        }
                        ?>
                    </td>
                </tr>
            <?php
        }

    }
} 