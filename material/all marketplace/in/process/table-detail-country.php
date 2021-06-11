<?php

include('../../../../src/connection/connection.php');
error_reporting(0);
$name = $_POST['name'];
$date_range = $_POST['this_value'];

date_default_timezone_set('Asia/Jakarta');
$param_date             = date("Y-m-d");
$param_year_month       = date("Y-m");
$param_month            = date("m");
$param_year             = date("Y");

if($date_range == "This Month"){
    $previous_year_month    = date('Y-m', strtotime("-1 month"));

    $query="SELECT country, COUNT(*) AS TOTAL 
    FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && name='$name' && date LIKE '%$param_year_month%' GROUP BY country ORDER BY TOTAL DESC LIMIT 5";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {

        ?>
            <tr class="sub-title-table">
                <td scope="row"><?=$row['country']?></td>
                <td><?=$row['TOTAL']?></td>
            </tr>
        <?php
    }

}elseif($date_range == "30 Days"){
    $param_date_1   = date('Y-m-d', strtotime("-30 day"));
    $param_date_2   = date('Y-m-d', strtotime("-60 day"));

    $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && name='$name' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY country ORDER BY TOTAL DESC LIMIT 5";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {

        ?>
            <tr class="sub-title-table">
                <td scope="row"><?=$row['country']?></td>
                <td><?=$row['TOTAL']?></td>
            </tr>
        <?php
    }

}elseif($date_range == "One Year" && !isset($_POST['date']) && !isset($_POST['todate'])){
    $param_date_1   = date('Y-m-d', strtotime("-12 month"));
    $param_date_2   = date('Y-m-d', strtotime("-24 month"));

    $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && name = '$name' && date BETWEEN '$param_date_1' AND '$param_date' GROUP BY country ORDER BY TOTAL DESC LIMIT 5";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $param_item = $row["country"];
        if(isset($param_item)){
        ?>
            <tr class="sub-title-table">
                <td scope="row"><?=$row['country']?></td>
                <td><?=$row['TOTAL']?></td>
            </tr>
        <?php
        }elseif(!isset($param_item)){
            ?>
            <tr class="sub-title-table">
                <td scope="row">Nothing Country</td>
                <td><</td>
            </tr>
        <?php
        }
    }

}elseif($date_range == "One Year" && isset($_POST['date']) && isset($_POST['todate'])){

    $date = $_POST['date'];
    $todate = $_POST['todate'];

    $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && name = '$name' && date BETWEEN '$date' AND '$todate' GROUP BY country ORDER BY TOTAL DESC LIMIT 5";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $param_item = $row["country"];
        if(isset($param_item)){
        ?>
            <tr class="sub-title-table">
                <td scope="row"><?=$row['country']?></td>
                <td><?=$row['TOTAL']?></td>
            </tr>
        <?php
        }elseif(!isset($param_item)){
            ?>
            <tr class="sub-title-table">
                <td scope="row">Nothing Country</td>
                <td></td>
            </tr>
        <?php
        }
    }

}elseif($date_range == "Last Month"){
    $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
    $previous_year_month_2    = date('Y-m', strtotime("-2 month"));

    $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && name = '$name' && date LIKE '%$previous_year_month_1%' GROUP BY country ORDER BY TOTAL DESC LIMIT 5";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $param_item = $row["country"];
        if(isset($param_item)){
        ?>
            <tr class="sub-title-table">
                <td scope="row"><?=$row['country']?></td>
                <td><?=$row['TOTAL']?></td>
            </tr>
        <?php
        }elseif(!isset($param_item)){
            ?>
            <tr class="sub-title-table">
                <td scope="row">Nothing Country</td>
                <td><</td>
            </tr>
        <?php
        }
    }

}elseif($date_range == "Last Year"){
    $param_year_1   = date('Y', strtotime("-1 year"));
    $param_year_2   = date('Y', strtotime("-2 year"));

    $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && name = '$name' && year=$param_year_1 GROUP BY country ORDER BY TOTAL DESC LIMIT 5";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $param_item = $row["country"];
        if(isset($param_item)){
        ?>
            <tr class="sub-title-table">
                <td scope="row"><?=$row['country']?></td>
                <td><?=$row['TOTAL']?></td>
            </tr>
        <?php
        }elseif(!isset($param_item)){
            ?>
            <tr class="sub-title-table">
                <td scope="row">Nothing Country</td>
                <td></td>
            </tr>
        <?php
        }
    }
}elseif($date_range == "All Time"){

    $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && name = '$name' GROUP BY country ORDER BY TOTAL DESC LIMIT 5";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $param_item = $row["country"];
        if(isset($param_item)){
        ?>
            <tr class="sub-title-table">
                <td scope="row"><?=$row['country']?></td>
                <td><?=$row['TOTAL']?></td>
            </tr>
        <?php
        }elseif(!isset($param_item)){
            ?>
            <tr class="sub-title-table">
                <td scope="row">Nothing Country</td>
                <td></td>
            </tr>
        <?php
        }
    }
}elseif($date_range == "This Year"){
    $param_year_1   = date('Y', strtotime("-1 year"));

    $query="SELECT country, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE country!='' && name = '$name' && year=$param_year GROUP BY country ORDER BY TOTAL DESC LIMIT 5";
    $result = mysqli_query($connect, $query);
    while($row =mysqli_fetch_array($result)) 
    {
        $param_item = $row["country"];
        if(isset($param_item)){
        ?>
            <tr class="sub-title-table">
                <td scope="row"><?=$row['country']?></td>
                <td><?=$row['TOTAL']?></td>
            </tr>
        <?php
        }elseif(!isset($param_item)){
            ?>
            <tr class="sub-title-table">
                <td scope="row">Nothing Country</td>
                <td><</td>
            </tr>
        <?php
        }
    }

}

echo json_encode($output);
