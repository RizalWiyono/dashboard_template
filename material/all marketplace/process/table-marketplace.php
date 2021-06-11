<?php

$date_range = $_POST['this_value'];
$month = array("1" => "GR - Brandearth", "2" => "GR - RRGraph", "3" => "Templatemonster", "4" => "Creativemarket", "5" => "RRSlides");

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

include('../../../src/connection/connection.php');

if($date_range == "This Month"){
    $previous_year_month    = date('Y-m', strtotime("-1 month"));

    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_sales WHERE date LIKE '%$param_year_month%' GROUP BY market_id";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $market_id = $row['market_id'];

        $query_current = "SELECT * FROM tb_sales WHERE market_id='$market_id' && date LIKE '%$param_year_month%'";
        $query_previous = "SELECT * FROM tb_sales WHERE market_id='$market_id' && date LIKE '%$previous_year_month%'";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

        ?>
            <tr class="sub-title-table">
                <?php
                if($row['market_id'] == 1){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #343FD5; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 2){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #3EBEF4; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 3){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #F6425E; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 4){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #2BE870; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 5){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #FBA146; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }
                ?>
                <td scope="row"><?= $circle_shape?><?=$month[$row['market_id']]?></td>
                <td><?=$row['TOTAL']?></td>
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

    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_sales WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY market_id";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $market_id = $row['market_id'];

        $query_current = "SELECT * FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date'";
        $query_previous = "SELECT * FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$param_date_2' AND '$param_date_1'";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

        ?>
            <tr class="sub-title-table">
            <?php
                if($row['market_id'] == 1){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #343FD5; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 2){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #3EBEF4; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 3){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #F6425E; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 4){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #2BE870; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 5){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #FBA146; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }
                ?>
                <td scope="row"><?= $circle_shape?><?=$month[$row['market_id']]?></td>
                <td><?=$row['TOTAL']?></td>
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

    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_sales WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY market_id";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $market_id = $row['market_id'];

        $query_current = "SELECT * FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$param_date_1' AND '$param_date'";
        $query_previous = "SELECT * FROM tb_sales WHERE market_id=$market_id && date BETWEEN '$param_date_2' AND '$param_date_1'";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));


        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

        ?>
            <tr class="sub-title-table">
            <?php
                if($row['market_id'] == 1){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #343FD5; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 2){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #3EBEF4; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 3){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #F6425E; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 4){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #2BE870; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 5){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #FBA146; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }
                ?>
                <td scope="row"><?= $circle_shape?><?=$month[$row['market_id']]?></td>
                <td><?=$row['TOTAL']?></td>
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

    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_sales WHERE date BETWEEN '$date' AND '$todate' GROUP BY market_id";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $market_id = $row['market_id'];

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
        $query_current = "SELECT * FROM tb_sales WHERE market_id=$market_id &&  date BETWEEN '$date' AND '$todate'";
        $query_previous = "SELECT * FROM tb_sales WHERE market_id=$market_id &&  date BETWEEN '$date_1' AND '$date_2'";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));


        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

        ?>
            <tr class="sub-title-table">
            <?php
                if($row['market_id'] == 1){
                     $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #343FD5; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 2){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #3EBEF4; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 3){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #F6425E; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 4){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #2BE870; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 5){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #FBA146; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }
                ?>
                <td scope="row"><?= $circle_shape?><?=$month[$row['market_id']]?></td>
                <td><?=$row['TOTAL']?></td>
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

    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_sales WHERE date LIKE '%$previous_year_month_1%' GROUP BY market_id";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $market_id = $row['market_id'];

        $query_current = "SELECT * FROM tb_sales WHERE market_id='$market_id' && date LIKE '%$previous_year_month_1%'";
        $query_previous = "SELECT * FROM tb_sales WHERE market_id='$market_id' && date LIKE '%$previous_year_month_2%'";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

        ?>
            <tr class="sub-title-table">
                <?php
                if($row['market_id'] == 1){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #343FD5; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 2){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #3EBEF4; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 3){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #F6425E; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 4){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #2BE870; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 5){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #FBA146; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }
                ?>
                <td scope="row"><?= $circle_shape?><?=$month[$row['market_id']]?></td>
                <td><?=$row['TOTAL']?></td>
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

    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_sales WHERE year=$param_year_1 GROUP BY market_id";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $market_id = $row['market_id'];

        $query_current = "SELECT * FROM tb_sales WHERE market_id='$market_id' && year=$param_year_1";
        $query_previous = "SELECT * FROM tb_sales WHERE market_id='$market_id' && year=$param_year_2";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

        ?>
            <tr class="sub-title-table">
                <?php
                if($row['market_id'] == 1){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #343FD5; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 2){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #3EBEF4; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 3){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #F6425E; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 4){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #2BE870; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 5){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #FBA146; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }
                ?>
                <td scope="row"><?= $circle_shape?><?=$month[$row['market_id']]?></td>
                <td><?=$row['TOTAL']?></td>
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
    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_sales GROUP BY market_id";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $market_id = $row['market_id'];

        $query_current = "SELECT * FROM tb_sales WHERE market_id='$market_id' ";
        $query_previous = "SELECT * FROM tb_sales WHERE market_id='$market_id' ";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));

        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

        ?>
            <tr class="sub-title-table">
                <?php
                if($row['market_id'] == 1){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #343FD5; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 2){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #3EBEF4; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 3){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #F6425E; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 4){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #2BE870; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 5){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #FBA146; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }
                ?>
                <td scope="row"><?= $circle_shape?><?=$month[$row['market_id']]?></td>
                <td><?=$row['TOTAL']?></td>
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

    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_sales WHERE year=$param_year GROUP BY market_id";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $market_id = $row['market_id'];

        $query_current = "SELECT * FROM tb_sales WHERE market_id=$market_id && year=$param_year";
        $query_previous = "SELECT * FROM tb_sales WHERE market_id=$market_id && year=$param_year_1";

        $current_sales = mysqli_num_rows(mysqli_query($connect, $query_current));
        $previou_sales = mysqli_num_rows(mysqli_query($connect, $query_previous));


        $rates = ($previou_sales < 1) ? 0.00001 : (($current_sales - $previou_sales) / $previou_sales) * 100;

        ?>
            <tr class="sub-title-table">
            <?php
                if($row['market_id'] == 1){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #343FD5; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 2){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #3EBEF4; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 3){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #F6425E; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 4){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #2BE870; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }elseif($row['market_id'] == 5){
                    $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #FBA146; border-radius: 100%; float: left; margin-top: 2%; margin-right: 5%;'></div>";
                }
                ?>
                <td scope="row"><?= $circle_shape?><?=$month[$row['market_id']]?></td>
                <td><?=$row['TOTAL']?></td>
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

echo json_encode($output);
