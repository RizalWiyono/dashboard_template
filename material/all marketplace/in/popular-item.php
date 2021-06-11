<?php
session_start();
    
if(!isset($_SESSION['email']) ) {
    header('location: ../../../../Dashboard Fee/material/login/login.php');
    exit;
}else{
    if($_SESSION['role'] == 'User'){
        header('location: ../../../../Dashboard Fee/material/team-viewer/');
    }
}
?>

<html>
<head>
    <title>RRGraph - Popular Item</title> 
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../../../src/image/Group 38.png">

    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&family=Poppins:wght@100;300;600&display=swap" rel="stylesheet">
    
    <!-- View -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <!-- Stylesheet -->
    <link rel="stylesheet" href="../../../src/css/style.css">
    <link rel="stylesheet" href="../../../src/select/css/bvselect.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"><link rel="stylesheet" href="../../src/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>
<body >

    <div class="loader">
        <img src="../../../src/image/LOGO-RRG.svg" alt="">
    </div>

    <div class="place-nav">
        <div class="bgc" id="hm" onclick="closeNav()"></div>
        <div id="mySidenav" class="navmenuslide" align="center">
            <div class="distance-nav-content" align="left">
                <h1>Settings</h1>
                <p class="mb-5">Organize and synchronize data
                    <div class="circle-close" align="center"  onclick="closeNav()">
                        <p>&times;</p>
                    </div>
                    <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" align="center">&times;</a> -->
                </p>

                <a href="item-update.php?market=All%20Marketplace&type=All" class="place-item-setting">
                    <img src="../../../src/image/SET-CATALOG.svg" alt="">
                    <h1>List Items / Catalog</h1>
                </a>

                <a href="category-section.php?market=All%20Marketplace&type=All" class="place-item-setting">
                    <img src="../../../src/image/SET-CATEGORY.svg" alt="">
                    <h1>Set Category & Sub</h1>
                </a>

                <a href="tools-section.php?market=All%20Marketplace" class="place-item-setting">
                    <img src="../../../src/image/SET-TYPE.svg" alt="">
                    <h1>Type Items / Tools</h1>
                </a>

                <a href="color-analyze.php?market=All%20Marketplace&type=All&item=Sales&date=One%20Year%20Last" class="place-item-setting-color">
                    <img src="../../../src/image/SET-COLOR.svg" alt="">
                    <h1>Color Options</h1>
                </a>
            </div>
        </div>
    </div>
    
    <div class="place-nav">
        <div class="bgc" id="hm2" onclick="closeNav2()"></div>
        <div id="mySidenav2" class="navmenuslide" align="center">
            <div class="distance-nav-content" align="left">
                <h1>Analyze Options</h1>
                <p class="mb-5">Category tools for analysis
                    <div class="circle-close" align="center"  onclick="closeNav2()">
                        <p>&times;</p>
                    </div>
                    <!-- <a href="javascript:void(0)" class="closebtn" onclick="closeNav()" align="center">&times;</a> -->
                </p>

                <div class="place-tool">
                        <a href="item-download.php?market=All%20Marketplace&type=All%20Marketplace&date=One%20Year%20Last" class="tool" align="center">
                            <img src="../../../src/image/SET-CATALOG.svg" alt="">
                            <h1>Most Download</h1>
                        </a>

                        <a href="category-bar.php?market=All%20Marketplace&type=All&date=One%20Year%20Last" class="tool" align="center">
                            <img src="../../../src/image/SET-CATEGORY.svg" alt="">
                            <h1>By Category</h1>
                        </a>
                    </div>

                    <div class="place-tool">
                        <a href="color-analyze.php?market=All%20Marketplace&type=All&item=Sales&date=One%20Year%20Last" class="tool" align="center">
                            <img src="../../../src/image/SET-COLOR.svg" alt="">
                            <h1>By Color</h1>
                        </a>

                        <a href="top-country.php?market=All%20Marketplace&type=All%20Marketplace&date=One%20Year%20Last" class="tool" align="center">
                            <img src="../../../src/image/SET-REGION.svg" alt="">
                            <h1>By Region</h1>
                        </a>
                    </div>

                    <div class="place-tool">
                        <a href="upload-update.php?market=All%20Marketplace&type=All%20Marketplace&date=One%20Year%20Last" class="tool" align="center">
                            <img src="../../../src/image/SET-UPLUPD.svg" alt="">
                            <h1>Upload & Update</h1>
                        </a>

                        <a href="popular-item.php?market=All%20Marketplace&date=One%20Year%20Last" class="tool" align="center">
                            <img src="../../../src/image/SET-LIVE.svg" alt="">
                            <h1>Live Market</h1>
                        </a>
                    </div>
            </div>
        </div>
    </div>

    <div class="grid-content">
        <nav align="center">
            <div class="logo">
                <a href="../../../../Dashboard Fee/material/Dashboard/index.php">
                    <img src="../../../src/image/LOGO-1.svg"/>
                </a>
            </div>
            
            <div class="item"  align="center">
                <ul>
                    <li class="sect-active" data-toggle="tooltip" data-placement="right" title="All Marketplace" id="tool-market">
                        <a href="../../all marketplace/all-marketplace.php?market=All Marketplace">
                            <img class="logo-rr" src="../../../src/image/MARKETPLACE.svg"/>
                        </a>
                    </li>

                    <li class="" data-toggle="tooltip" data-placement="right" title="Freebies" id="tool-freebies">
                        <a href="../../freebies/freebies.php?market=All Marketplace&type=freebies">
                            <img class="logo-rr" src="../../../src/image/FREEBIES.svg"/>
                        </a>
                    </li>

                    <li class="" data-toggle="tooltip" data-placement="right" title="News Letter" id="tool-newsletter">
                        <a href="../../news letter/news_letter.php?market=All Marketplace">
                            <img class="logo-rr" src="../../../src/image/NEWSLETTER.svg"/>
                        </a>
                    </li>

                    <li class="" data-toggle="tooltip" data-placement="right" title="Team" id="tool-team">
                        <a href="../../team/team.php?market=All%20Marketplace">
                            <img class="logo-rr" src="../../../src/image/TEAM.svg"/>
                        </a>
                    </li>

                    <div class="notif-team" id="notif-place"><p id="notif"></p></div>

                    <li class="sect-bottom-1" data-toggle="tooltip" data-placement="right" title="Syncronize" id="tool-sync">
                        <a href="../../upload/upload.php?market=All%20Marketplace">
                            <?php
                            include '../../../src/connection/connection.php';
                            date_default_timezone_set('Asia/Jakarta');
                            $param_date = date("d M Y");
                            $sql_param  = mysqli_query($connect, "SELECT (SELECT date FROM tb_activity_template WHERE activity='Upload File - GR-BE' ORDER BY activity_id DESC LIMIT 1) AS BE,
                            (SELECT date FROM tb_activity_template WHERE activity='Upload File - GR-RRG' ORDER BY activity_id DESC LIMIT 1) AS RRG,
                            (SELECT date FROM tb_activity_template WHERE activity='Upload File - TM' ORDER BY activity_id DESC LIMIT 1) AS TM,
                            (SELECT date FROM tb_activity_template WHERE activity='Upload File - CM' ORDER BY activity_id DESC LIMIT 1) AS CM,
                            (SELECT date FROM tb_activity_template WHERE activity='Upload File - RRS' ORDER BY activity_id DESC LIMIT 1) AS RRS,
                            (SELECT date FROM tb_activity_template WHERE activity='Upload File - NL' ORDER BY activity_id DESC LIMIT 1) AS NL,
                            (SELECT date FROM tb_activity_template WHERE activity='Upload File - DT-POPULAR' ORDER BY activity_id DESC LIMIT 1) AS DP");
                            while($row = mysqli_fetch_array($sql_param)){
                                $param_BE   = $row['BE'];
                                $param_RRG  = $row['RRG'];
                                $param_TM   = $row['TM'];
                                $param_CM   = $row['CM'];
                                $param_RRS  = $row['RRS'];
                                $param_NL   = $row['NL'];
                                $param_DP   = $row['DP'];
                            }

                            if($param_BE == $param_date && $param_RRG == $param_date && $param_TM == $param_date && $param_CM == $param_date && $param_RRS == $param_date && $param_NL == $param_date && $param_DP == $param_date){
                            ?>
                            <img class="logo-rr" src="../../../src/image/SYNC-GREEN.svg"/>
                            <?php
                            }else{
                            ?>
                            <img class="logo-rr" src="../../../src/image/SYNC-RED.svg"/>
                            <?php
                            }
                            ?>
                        </a>
                    </li>

                    <li class="sect-bottom" data-toggle="tooltip" data-placement="right" title="Logout" id="tool-logout">
                        <a href="../../../../Dashboard Fee/material/login/logout.php">
                            <img class="logo-rr" src="../../../src/image/LOGOUT.svg"/>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <main>
            <div class="main-container" align="center">
                <div class="main-content" align="left">
                    
                    <div class="main-header">
                    <select id="selectbox" onchange="location = this.value;">
                            <?=$market = array("1" => "GR-Brandearth", "2" => "GR-RRGraph", "3" => "Templatemonster", "4" => "Creativemarket", "5" => "RRSlide");?>
                            <?php
                            if(isset($_GET['todate'])){
                            ?>
                            <option value="../all-marketplace.php?market=All Marketplace&date=<?=$_GET['date']?>&todate=<?=$_GET['todate']?>">All Marketplace</option>
                            <?php
                            }else{
                            ?>
                            <option value="../all-marketplace.php?market=All Marketplace&date=<?=$_GET['date']?>">All Marketplace</option>
                            <?php
                            }
                            ?>
                                <?php
                                    include '../../../src/connection/connection.php';
                                    $sql_market = mysqli_query($connect, "SELECT * FROM tb_marketplace");
                                    while($row = mysqli_fetch_array($sql_market)){
                                        if($row['market_id'] == 1){
                                            if(isset($_GET['todate'])){
                                                echo '<option data-img="../../../src/image/GR-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'&date='.$_GET['date'].'&todate='.$_GET['todate'].'">'.$row['marketplace'].'</option>';
                                            }else{
                                                echo '<option data-img="../../../src/image/GR-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'&date='.$_GET['date'].'">'.$row['marketplace'].'</option>';
                                            }
                                        }elseif($row['market_id'] == 2){
                                            if(isset($_GET['todate'])){
                                                echo '<option data-img="../../../src/image/GR-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'&date='.$_GET['date'].'&todate='.$_GET['todate'].'">'.$row['marketplace'].'</option>';
                                            }else{
                                                echo '<option data-img="../../../src/image/GR-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'&date='.$_GET['date'].'">'.$row['marketplace'].'</option>';
                                            }
                                        }elseif($row['market_id'] == 3){
                                            if(isset($_GET['todate'])){
                                                echo '<option data-img="../../../src/image/TM-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'&date='.$_GET['date'].'&todate='.$_GET['todate'].'">'.$row['marketplace'].'</option>';
                                            }else{
                                                echo '<option data-img="../../../src/image/TM-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'&date='.$_GET['date'].'">'.$row['marketplace'].'</option>';
                                            }
                                        }elseif($row['market_id'] == 4){
                                            if(isset($_GET['todate'])){
                                                echo '<option data-img="../../../src/image/CM-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'&date='.$_GET['date'].'&todate='.$_GET['todate'].'">'.$row['marketplace'].'</option>';
                                            }else{
                                                echo '<option data-img="../../../src/image/CM-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'&date='.$_GET['date'].'">'.$row['marketplace'].'</option>';
                                            }
                                        }elseif($row['market_id'] == 5){
                                            if(isset($_GET['todate'])){
                                                echo '<option data-img="../../../src/image/RRS-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'&date='.$_GET['date'].'&todate='.$_GET['todate'].'">'.$row['marketplace'].'</option>';
                                            }else{
                                                echo '<option data-img="../../../src/image/RRS-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'&date='.$_GET['date'].'">'.$row['marketplace'].'</option>';
                                            }
                                        }
                                    }
                                ?>
                        </select>

                        <a href="../../freebies/freebies.php?market=All Marketplace&type=freebies">
                            Freebies
                        </a>
                        
                        <div class="col-md-4 search">
                            <form action="search.php?market=All Marketplace" method="POST" class="row">
                                <input type="text" name="search" id="search" placeholder="Template name here" onInput="search_all_m()">
                                <input type="submit" style="display: none;"> <img class="search-ic" src="../../../src/image/SEARCH-IC.svg" alt="">
                                <img class="menu-ic" src="../../../src/image/MENU-IC.svg" alt="" onclick="openNav2()">
                                
                                <img class="setting-ic" src="../../../src/image/SETTING-IC.svg" alt="" onclick="openNav()">
                            </form>
                        </div>
                    </div>
                    
                    <div class="main-sales">
                        <div class="distance-content">
                            <div class="header-content">
                                <h1 class="title-content">Update Popular Item (Static)</h1>
                                
                                <div class="range" style="width: 100%;" align="right">
                                    <?php
                                    if($_GET['date'] == 'One Month Last'){
                                    ?>
                                    <a href="?market=<?=$_GET['market']?>&date=One Month Last">
                                        <button id="this_date" class="but-sales but-active" value="This Month">This Month</button>
                                    </a>
                                    <?php
                                    }else{
                                    ?>
                                    <a href="?market=<?=$_GET['market']?>&date=One Month Last">
                                        <button id="this_date" class="but-sales" value="This Month">This Month</button>
                                    </a>
                                    <?php
                                    }
                                    if($_GET['date'] == '30 Days'){
                                    ?>
                                    <a href="?market=<?=$_GET['market']?>&date=30 Days">
                                        <button id="30_date" class="but-sales but-active" value="30 Days">30 Days</button>
                                    </a>
                                    <?php
                                    }else{
                                    ?>
                                    <a href="?market=<?=$_GET['market']?>&date=30 Days">
                                        <button id="30_date" class="but-sales" value="30 Days">30 Days</button>
                                    </a>
                                    <?php
                                    }
                                    if($_GET['date'] == 'One Year Last'){
                                    ?>
                                    <a href="?market=<?=$_GET['market']?>&date=One Year Last">
                                        <button id="one_year_date" class="but-sales but-active" value="One Year">One Year</button>
                                    </a>
                                    <?php
                                    }else{
                                    ?>
                                    <a href="?market=<?=$_GET['market']?>&date=One Year Last">
                                        <button id="one_year_date" class="but-sales" value="One Year">One Year</button>
                                    </a>
                                    <?php
                                    }
                                    if($_GET['date'] == 'Last Month' || $_GET['date'] == 'This Year' || $_GET['date'] == 'Last Year' || $_GET['date'] == 'All Time'){
                                    ?>
                                    <button class="btn btn-secondary dropdown-toggle but-sales but-active" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Custom
                                    </button>
                                    <div class="dropdown-menu dd_costum" aria-labelledby="dropdownMenu2">
                                        <a href="?market=<?=$_GET['market']?>&date=Last Month" id="last_month" class="dropdown-item" type="button" value="Last Month">Last Month</a>
                                        <a href="?market=<?=$_GET['market']?>&date=This Year" id="this_year" class="dropdown-item" type="button" value="This Year">This Year</a>
                                        <a href="?market=<?=$_GET['market']?>&date=Last Year" id="last_year" class="dropdown-item" type="button" value="Last Year">Last Year</a>
                                        <a href="?market=<?=$_GET['market']?>&date=All Time" id="all_time" class="dropdown-item" type="button" value="All Time">All Time</a>
                                    </div>
                                    <?php
                                    }else{
                                    ?>
                                    <button class="btn btn-secondary dropdown-toggle but-sales" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Custom
                                    </button>
                                    <div class="dropdown-menu dd_costum" aria-labelledby="dropdownMenu2">
                                        <a href="?market=<?=$_GET['market']?>&date=Last Month" id="last_month" class="dropdown-item" type="button" value="Last Month">Last Month</a>
                                        <a href="?market=<?=$_GET['market']?>&date=This Year" id="this_year" class="dropdown-item" type="button" value="This Year">This Year</a>
                                        <a href="?market=<?=$_GET['market']?>&date=Last Year" id="last_year" class="dropdown-item" type="button" value="Last Year">Last Year</a>
                                        <a href="?market=<?=$_GET['market']?>&date=All Time" id="all_time" class="dropdown-item" type="button" value="All Time">All Time</a>
                                    </div>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if(isset($_GET['date']) && isset($_GET['todate'])){
                                    ?>
                                    <button id="costum_date" class="but-costum but-costum-active">Period</button>
                                    <?php
                                    }else{
                                    ?>
                                    <button id="costum_date" class="but-costum">Period</button>
                                    <?php
                                    }
                                    ?>

                                </div>
                                <div class="col-md-12" style="display: none;">  
                                    <h1 id="report" class="report" ></h1>
                                </div>
                            </div>

                            <div class="content"> 
                                <div class="full-place-popular">
                                    <p class="desc-popular">Last <strong>Week</strong></p>

                                    <div class="popular-place">
                                        <div class="distance-place-popular">
                                            <div class="place">
                                                <div class="distance-item-place" >
                                                    <div class="circle-icon-gr" align="center">
                                                        <img clas src="../../../src/image/IC-GR.svg" alt="">
                                                    </div>

                                                    <h1 class="calc-title-sales total_gr_week">0</h1>

                                                    <p class="title-in-shape-sales">
                                                        Graphicriver
                                                        <?php
                                                        if($_GET['date'] == 'One Month Last' && !isset($_GET['todate'])){
                                                                                                                    
                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_date = $row["date"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_1 = $row["DATE"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                                $start_date = substr("2020-11-10", 0, 7);
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_2 = $row["DATE"];
                                                            }
                                                        
                                                            // Last Week
                                                        
                                                            $query_current_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_date_1' AND '$end_date'";
                                                            $query_previous_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_date_2' AND '$start_dates'";
                                                            
                                                            $current_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_current_gr_week));
                                                            $previou_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_previous_gr_week));
                                                           
                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;

                                                        }elseif($_GET['date'] == '30 Days' && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_date = $row["date"];
                                                            }

                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_1 = $row["DATE"];
                                                            }

                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -30 DAY) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                            }

                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_2 = $row["DATE"];
                                                            }
                                                        
                                                            // Last Week
                                                        
                                                            $query_current_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_date_1' AND '$end_date'";
                                                            $query_previous_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_date_2' AND '$start_dates'";
                                                            
                                                            $current_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_current_gr_week));
                                                            $previou_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_previous_gr_week));
                                                           
                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                        
                                                        }elseif($_GET['date'] == 'One Year Last' && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_date = $row["date"];
                                                            }

                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_1 = $row["DATE"];
                                                            }

                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -12 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                            }

                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_2 = $row["DATE"];
                                                            }
                                                        
                                                            // Last Week
                                                        
                                                            $query_current_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_date_1' AND '$end_date'";
                                                            $query_previous_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_date_2' AND '$start_dates'";
                                                        
                                                            $current_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_current_gr_week));
                                                            $previou_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_previous_gr_week));
                                                            
                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                        
                                                        }elseif(isset($_GET['date']) && isset($_GET['todate'])){

                                                            $date = $_GET['date'];
                                                            $todate = $_GET['todate'];
                                                            
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

                                                            $query="SELECT DATE_ADD('$date', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_1 = $row["DATE"];
                                                            }

                                                            $query="SELECT DATE_ADD('$date_1', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_2 = $row["DATE"];
                                                            }

                                                            // Last Week
                                                                                                                    
                                                            $query_current_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_date_1' AND '$date'";
                                                            $query_previous_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_date_2' AND '$date_1'";
                                                           
                                                            $current_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_current_gr_week));
                                                            $previou_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_previous_gr_week));

                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;

                                                        }elseif($_GET['date'] == "Last Month" && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_date = $row["date"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_1 = $row["DATE"];
                                                            }

                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates_2 = $row["DATE"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$start_dates_2', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_2 = $row["DATE"];
                                                            }
                                                            

                                                            // Last Week
                                                        
                                                            $query_current_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_date_1' AND '$start_dates'";
                                                            $query_previous_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_date_2' AND '$start_dates_2'";
                                                        
                                                            $current_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_current_gr_week));
                                                            $previou_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_previous_gr_week));

                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                        
                                                        }elseif($_GET['date'] == "This Year" && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_date = $row["date"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_1 = $row["DATE"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 YEAR) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_2 = $row["DATE"];
                                                            }
                                                        
                                                            // This Year
                                                        
                                                            $query_current_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_date_1' AND '$end_date'";
                                                            $query_previous_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_date_2' AND '$start_dates'";
                                                        
                                                            $current_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_current_gr_week));
                                                            $previou_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_previous_gr_week));
                                                        
                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                            
                                                        }elseif($_GET['date'] == "Last Year" && !isset($_GET['todate'])){
                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_date = $row["date"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 YEAR) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_1 = $row["DATE"];
                                                            }

                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 YEAR) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates_2 = $row["DATE"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$start_dates_2', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_2 = $row["DATE"];
                                                            }
                                                            

                                                            // Last Week
                                                        
                                                            $query_current_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_date_1' AND '$start_dates'";
                                                            $query_previous_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_date_2' AND '$start_dates_2'";
                                                        
                                                            $current_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_current_gr_week));
                                                            $previou_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_previous_gr_week));

                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                        
                                                        }elseif($_GET['date'] == "All Time" && !isset($_GET['todate'])){

                                                            $rates_gr = 0;
                                                            $rates_rrg = 0;
                                                        
                                                        }

                                                        if($rates_gr >= 0){
                                                        ?>
                                                            <p class="top-rate"> &nbsp;+<?=number_format($rates_gr, 0)?></p>
                                                            <p class="top-rate">%</p>
                                                            <div class="cirlce-popular" align="center">
                                                                <img src="../../../src/image/Polygon 1.png" alt="">
                                                            </div>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <p class="top-rate-min"> &nbsp;<?=number_format($rates_gr, 0)?></p>
                                                            <p class="top-rate-min">%</p>
                                                            <div class="cirlce-popular-min" align="center">
                                                                <img src="../../../src/image/Polygon 1 (1).png" alt="">
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="place">
                                                <div class="distance-item-place" style="margin-left: -10%;">
                                                    <div class="circle-icon-rrg" align="center">
                                                        <img clas src="../../../src/image/IC-RRG.svg" alt="">
                                                    </div>

                                                    <h1 class="calc-title-sales total_rrg_week">0</h1>

                                                    <p class="title-in-shape-sales">
                                                        RRgraph
                                                        <?php
                                                        if($_GET['date'] == 'One Month Last' && !isset($_GET['todate'])){
                                                                                                                    
                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_date = $row["date"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_1 = $row["DATE"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                                $start_date = substr("2020-11-10", 0, 7);
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_2 = $row["DATE"];
                                                            }
                                                        
                                                            // Last Week
                                                        
                                                            $query_current_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_1' AND '$end_date'";
                                                            $query_previous_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_2' AND '$start_dates'";
                                                        
                                                            $current_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_current_rrg_week));
                                                            $previou_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_previous_rrg_week));
                                                        
                                                            $rates_rrg = ($previou_sales_rrg_week < 1) ? 0.00001 : (($current_sales_rrg_week - $previou_sales_rrg_week) / $previou_sales_rrg_week) * 100;
                                                        
                                                        }elseif($_GET['date'] == '30 Days' && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_date = $row["date"];
                                                            }

                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_1 = $row["DATE"];
                                                            }

                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -30 DAY) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                            }

                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_2 = $row["DATE"];
                                                            }
                                                        
                                                            // Last Week
                                                        
                                                            $query_current_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_1' AND '$end_date'";
                                                            $query_previous_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_2' AND '$start_dates'";
                                                        
                                                            $current_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_current_rrg_week));
                                                            $previou_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_previous_rrg_week));
                                                        
                                                            $rates_rrg = ($previou_sales_rrg_week < 1) ? 0.00001 : (($current_sales_rrg_week - $previou_sales_rrg_week) / $previou_sales_rrg_week) * 100;
                                                        
                                                        }elseif($_GET['date'] == 'One Year Last' && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_date = $row["date"];
                                                            }

                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_1 = $row["DATE"];
                                                            }

                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -12 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                            }

                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_2 = $row["DATE"];
                                                            }
                                                        
                                                            // Last Week
                                                        
                                                            $query_current_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_1' AND '$end_date'";
                                                            $query_previous_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_2' AND '$start_dates'";
                                                        
                                                            $current_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_current_rrg_week));
                                                            $previou_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_previous_rrg_week));
                                                        
                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                            $rates_rrg = ($previou_sales_rrg_week < 1) ? 0.00001 : (($current_sales_rrg_week - $previou_sales_rrg_week) / $previou_sales_rrg_week) * 100;
                                                        
                                                        }elseif(isset($_GET['date']) && isset($_GET['todate'])){

                                                            $date = $_GET['date'];
                                                            $todate = $_GET['todate'];
                                                            
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

                                                            $query="SELECT DATE_ADD('$date', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_1 = $row["DATE"];
                                                            }

                                                            $query="SELECT DATE_ADD('$date_1', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_2 = $row["DATE"];
                                                            }

                                                            // Last Week
                                                                                                                    
                                                            $query_current_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_1' AND '$date'";
                                                            $query_previous_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_2' AND '$date_1'";

                                                            $current_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_current_rrg_week));
                                                            $previou_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_previous_rrg_week));

                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                            $rates_rrg = ($previou_sales_rrg_week < 1) ? 0.00001 : (($current_sales_rrg_week - $previou_sales_rrg_week) / $previou_sales_rrg_week) * 100;

                                                        }elseif($_GET['date'] == "Last Month" && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_date = $row["date"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_1 = $row["DATE"];
                                                            }

                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates_2 = $row["DATE"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$start_dates_2', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_2 = $row["DATE"];
                                                            }
                                                            

                                                            // Last Week
                                                        
                                                            $query_current_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_1' AND '$start_dates'";
                                                            $query_previous_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_2' AND '$start_dates_2'";
                                                        
                                                            $current_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_current_rrg_week));
                                                            $previou_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_previous_rrg_week));

                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                            $rates_rrg = ($previou_sales_rrg_week < 1) ? 0.00001 : (($current_sales_rrg_week - $previou_sales_rrg_week) / $previou_sales_rrg_week) * 100;
                                                        
                                                        }elseif($_GET['date'] == "This Year" && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_date = $row["date"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_1 = $row["DATE"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 YEAR) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_2 = $row["DATE"];
                                                            }
                                                        
                                                            // This Year
                                                        
                                                            $query_current_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_1' AND '$end_date'";
                                                            $query_previous_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_2' AND '$start_dates'";
                                                        
                                                            $current_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_current_rrg_week));
                                                            $previou_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_previous_rrg_week));
                                                        
                                                            $rates_rrg = ($previou_sales_rrg_week < 1) ? 0.00001 : (($current_sales_rrg_week - $previou_sales_rrg_week) / $previou_sales_rrg_week) * 100;
                                                            
                                                        }elseif($_GET['date'] == "Last Year" && !isset($_GET['todate'])){
                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_date = $row["date"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$end_date', INTERVAL -1 YEAR) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_1 = $row["DATE"];
                                                            }

                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 YEAR) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates_2 = $row["DATE"];
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$start_dates_2', INTERVAL -1 WEEK) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_date_2 = $row["DATE"];
                                                            }
                                                            

                                                            // Last Week
                                                        
                                                            $query_current_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_1' AND '$start_dates'";
                                                            $query_previous_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_date_2' AND '$start_dates_2'";
                                                        
                                                            $current_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_current_rrg_week));
                                                            $previou_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_previous_rrg_week));

                                                            $rates_rrg = ($previou_sales_rrg_week < 1) ? 0.00001 : (($current_sales_rrg_week - $previou_sales_rrg_week) / $previou_sales_rrg_week) * 100;
                                                        
                                                        }elseif($_GET['date'] == "All Time" && !isset($_GET['todate'])){

                                                            $rates_gr = 0;
                                                            $rates_rrg = 0;
                                                        
                                                        }

                                                        if($rates_rrg >= 0){
                                                        ?>
                                                            <p class="top-rate"> &nbsp;+<?=number_format($rates_rrg, 0)?></p>
                                                            <p class="top-rate">%</p>
                                                            <div class="cirlce-popular" align="center">
                                                                <img src="../../../src/image/Polygon 1.png" alt="">
                                                            </div>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <p class="top-rate-min"> &nbsp;<?=number_format($rates_rrg, 0)?></p>
                                                            <p class="top-rate-min">%</p>
                                                            <div class="cirlce-popular-min" align="center">
                                                                <img src="../../../src/image/Polygon 1 (1).png" alt="">
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="full-place-popular">
                                    <p class="desc-popular">Total <strong id="title-param">One Year</strong></p>

                                    <div class="popular-place">
                                        <div class="distance-place-popular">
                                            <div class="place">
                                                
                                                <div class="distance-item-place">
                                                    <div class="circle-icon-gr" align="center">
                                                        <img clas src="../../../src/image/IC-GR.svg" alt="">
                                                    </div>

                                                    <h1 class="calc-title-sales total_gr_right">0</h1>

                                                    <p class="title-in-shape-sales">
                                                        Graphicriver
                                                        <?php
                                                        if($_GET['date'] == 'One Month Last' && !isset($_GET['todate'])){
                                                                                                                    
                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_dates = $row["date"];
                                                                $end_date = substr("$end_date", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$end_dates', INTERVAL -1 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                                $start_date = substr("$start_dates", 0, 7);
                                                            }
                                                        
                                                            // Last Week
                                                        
                                                            $query_current_gr_week = "SELECT * FROM tb_popular WHERE date LIKE '%$end_date%'";
                                                            $query_previous_gr_week = "SELECT * FROM tb_popular WHERE date LIKE '%$start_date%'";
                                                            
                                                            $current_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_current_gr_week));
                                                            $previou_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_previous_gr_week));
                                                           
                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;

                                                        }elseif($_GET['date'] == '30 Days' && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_dates = $row["date"];
                                                                $end_date = substr("$end_date", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$end_dates', INTERVAL -30 DAY) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                                $start_date = substr("$start_dates", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -30 DAY) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates_2 = $row["DATE"];
                                                                $start_date = substr("$start_dates", 0, 7);
                                                            }
                                                        
                                                            // 30 Days
                                                        
                                                            $query_current_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_dates' AND '$end_dates'";
                                                            $query_previous_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_dates_2' AND '$start_dates'";
                                                            
                                                            $current_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_current_gr_week));
                                                            $previou_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_previous_gr_week));
                                                           
                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                        
                                                        }elseif($_GET['date'] == 'One Year Last' && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_dates = $row["date"];
                                                                $end_date = substr("$end_date", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$end_dates', INTERVAL -12 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                                $start_date = substr("$start_dates", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -12 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates_2 = $row["DATE"];
                                                                $start_date = substr("$start_dates", 0, 7);
                                                            }
                                                        
                                                            // One Year
                                                        
                                                            $query_current_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_dates' AND '$end_dates'";
                                                            $query_previous_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$start_dates_2' AND '$start_dates'";
                                                            
                                                            $current_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_current_gr_week));
                                                            $previou_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_previous_gr_week));
                                                           
                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                        
                                                        }elseif(isset($_GET['date']) && isset($_GET['todate'])){

                                                            $date = $_GET['date'];
                                                            $todate = $_GET['todate'];
                                                            
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
                                                           
                                                            // Period
                                                                                                                    
                                                            $query_current_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$date' AND '$todate'";
                                                            $query_previous_gr_week = "SELECT * FROM tb_popular WHERE date BETWEEN '$date_1' AND '$date_2'";
                                                           
                                                            $current_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_current_gr_week));
                                                            $previou_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_previous_gr_week));

                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;

                                                        }elseif($_GET['date'] == "Last Month" && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_dates = $row["date"];
                                                                $end_date = substr("$end_date", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$end_dates', INTERVAL -1 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                                $start_date = substr("$start_dates", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates_2 = $row["DATE"];
                                                                $start_date_2 = substr("$start_dates_2", 0, 7);
                                                            }
                                                        
                                                            // Last Month
                                                        
                                                            $query_current_gr_week = "SELECT * FROM tb_popular WHERE date LIKE '%$start_date%'";
                                                            $query_previous_gr_week = "SELECT * FROM tb_popular WHERE date LIKE '%$start_date_2%'";
                                                            
                                                            $current_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_current_gr_week));
                                                            $previou_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_previous_gr_week));
                                                           
                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                        
                                                        }elseif($_GET['date'] == "This Year" && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_dates = $row["date"];
                                                                $end_date = substr("$end_date", 0, 4);
                                                            }

                                                            // This Year
                                                        
                                                            $query_current_gr_week = "SELECT * FROM tb_popular WHERE year = $end_date";
                                                            $query_previous_gr_week = "SELECT * FROM tb_popular WHERE year = $end_date-1";
                                                            
                                                            $current_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_current_gr_week));
                                                            $previou_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_previous_gr_week));
                                                           
                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                        
                                                        }elseif($_GET['date'] == "Last Year" && !isset($_GET['todate'])){
                                                            
                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_dates = $row["date"];
                                                                $end_date = substr("$end_date", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$end_dates', INTERVAL -1 YEAR) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                                $start_date = substr("$start_dates", 0, 4);
                                                            }

                                                            // Last Year
                                                        
                                                            $query_current_gr_week = "SELECT * FROM tb_popular WHERE year=$start_date";
                                                            $query_previous_gr_week = "SELECT * FROM tb_popular WHERE year=$start_date-1";
                                                            
                                                            $current_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_current_gr_week));
                                                            $previou_sales_gr_week = mysqli_num_rows(mysqli_query($connect, $query_previous_gr_week));
                                                           
                                                            
                                                        }elseif($_GET['date'] == "All Time" && !isset($_GET['todate'])){

                                                            $rates_gr = 0;
                                                            $rates_rrg = 0;
                                                        
                                                        }

                                                        if($rates_gr >= 0){
                                                        ?>
                                                            <p class="top-rate"> &nbsp;+<?=number_format($rates_gr, 0)?></p>
                                                            <p class="top-rate">%</p>
                                                            <div class="cirlce-popular" align="center">
                                                                <img src="../../../src/image/Polygon 1.png" alt="">
                                                            </div>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <p class="top-rate-min"> &nbsp;<?=number_format($rates_gr, 0)?></p>
                                                            <p class="top-rate-min">%</p>
                                                            <div class="cirlce-popular-min" align="center">
                                                                <img src="../../../src/image/Polygon 1 (1).png" alt="">
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="place">
                                                <div class="distance-item-place" style="margin-left: -10%;">
                                                    <div class="circle-icon-rrg" align="center">
                                                        <img clas src="../../../src/image/IC-RRG.svg" alt="">
                                                    </div>

                                                    <h1 class="calc-title-sales total_rrg_right">0</h1>

                                                    <p class="title-in-shape-sales">
                                                        RRgraph
                                                        <?php
                                                        if($_GET['date'] == 'One Month Last' && !isset($_GET['todate'])){
                                                                                                                    
                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_dates = $row["date"];
                                                                $end_date = substr("$end_dates", 0, 7);
                                                            }
                                                        
                                                            $query="SELECT DATE_ADD('$end_dates', INTERVAL -1 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                                $start_date = substr("$start_dates", 0, 7);
                                                            }
                                                            
                                                            // Last Week
                                                        
                                                            $query_current_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$end_date%'";
                                                            $query_previous_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$start_date%'";
                                                        
                                                            $current_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_current_rrg_week));
                                                            $previou_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_previous_rrg_week));
                                                        
                                                            $rates_rrg = ($previou_sales_rrg_week < 1) ? 0.00001 : (($current_sales_rrg_week - $previou_sales_rrg_week) / $previou_sales_rrg_week) * 100;
                                                        
                                                        }elseif($_GET['date'] == '30 Days' && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_dates = $row["date"];
                                                                $end_date = substr("$end_date", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$end_dates', INTERVAL -30 DAY) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                                $start_date = substr("$start_dates", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -30 DAY) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates_2 = $row["DATE"];
                                                                $start_date = substr("$start_dates", 0, 7);
                                                            }
                                                        
                                                            // 30 Days
                                                        
                                                            $query_current_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_dates' AND '$end_dates'";
                                                            $query_previous_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_dates_2' AND '$start_dates'";
                                                        
                                                            $current_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_current_rrg_week));
                                                            $previou_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_previous_rrg_week));
                                                        
                                                            $rates_rrg = ($previou_sales_rrg_week < 1) ? 0.00001 : (($current_sales_rrg_week - $previou_sales_rrg_week) / $previou_sales_rrg_week) * 100;
                                                        
                                                        }elseif($_GET['date'] == 'One Year Last' && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_dates = $row["date"];
                                                                $end_date = substr("$end_dates", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$end_dates', INTERVAL -12 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                                $start_date = substr("$start_dates", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -12 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates_2 = $row["DATE"];
                                                                $start_date = substr("$start_dates_2", 0, 7);
                                                            }
                                                        
                                                            // One Year
                                                        
                                                            $query_current_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_dates' AND '$end_dates'";
                                                            $query_previous_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$start_dates_2' AND '$start_dates'";
                                                        
                                                            $current_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_current_rrg_week));
                                                            $previou_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_previous_rrg_week));
                                                        
                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                            $rates_rrg = ($previou_sales_rrg_week < 1) ? 0.00001 : (($current_sales_rrg_week - $previou_sales_rrg_week) / $previou_sales_rrg_week) * 100;
                                                        
                                                        }elseif(isset($_GET['date']) && isset($_GET['todate'])){

                                                            $date = $_GET['date'];
                                                            $todate = $_GET['todate'];
                                                            
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
                                                           
                                                            // Period
                                                                                                                    
                                                            $query_current_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$date' AND '$todate'";
                                                            $query_previous_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$date_1' AND '$date_2'";

                                                            $current_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_current_rrg_week));
                                                            $previou_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_previous_rrg_week));

                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                            $rates_rrg = ($previou_sales_rrg_week < 1) ? 0.00001 : (($current_sales_rrg_week - $previou_sales_rrg_week) / $previou_sales_rrg_week) * 100;

                                                        }elseif($_GET['date'] == "Last Month" && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_dates = $row["date"];
                                                                $end_date = substr("$end_date", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$end_dates', INTERVAL -1 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                                $start_date = substr("$start_dates", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$start_dates', INTERVAL -1 MONTH) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates_2 = $row["DATE"];
                                                                $start_date_2 = substr("$start_dates_2", 0, 7);
                                                            }
                                                        
                                                            // Last Month
                                                        
                                                            $query_current_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$start_date%'";
                                                            $query_previous_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$start_date_2%'";
                                                        
                                                            $current_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_current_rrg_week));
                                                            $previou_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_previous_rrg_week));

                                                            $rates_gr = ($previou_sales_gr_week < 1) ? 0.00001 : (($current_sales_gr_week - $previou_sales_gr_week) / $previou_sales_gr_week) * 100;
                                                            $rates_rrg = ($previou_sales_rrg_week < 1) ? 0.00001 : (($current_sales_rrg_week - $previou_sales_rrg_week) / $previou_sales_rrg_week) * 100;
                                                        
                                                        }elseif($_GET['date'] == "This Year" && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_dates = $row["date"];
                                                                $end_date = substr("$end_date", 0, 4);
                                                            }

                                                            // This Year
                                                        
                                                            $query_current_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$end_date";
                                                            $query_previous_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$end_date-1";
                                                        
                                                            $current_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_current_rrg_week));
                                                            $previou_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_previous_rrg_week));
                                                        
                                                            $rates_rrg = ($previou_sales_rrg_week < 1) ? 0.00001 : (($current_sales_rrg_week - $previou_sales_rrg_week) / $previou_sales_rrg_week) * 100;
                                                            
                                                        }elseif($_GET['date'] == "Last Year" && !isset($_GET['todate'])){

                                                            $query="SELECT date FROM tb_sales GROUP BY date DESC LIMIT 1";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $end_dates = $row["date"];
                                                                $end_date = substr("$end_date", 0, 7);
                                                            }

                                                            $query="SELECT DATE_ADD('$end_dates', INTERVAL -1 YEAR) AS DATE";
                                                            $result = mysqli_query($connect, $query);
                                                            while($row =mysqli_fetch_array($result)) {
                                                                $start_dates = $row["DATE"];
                                                                $start_date = substr("$start_dates", 0, 4);
                                                            }

                                                            // Last Year
                                                        
                                                            $query_current_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$start_date";
                                                            $query_previous_rrg_week = "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$start_date-1";
                                                        
                                                            $current_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_current_rrg_week));
                                                            $previou_sales_rrg_week = mysqli_num_rows(mysqli_query($connect, $query_previous_rrg_week));

                                                            $rates_rrg = ($previou_sales_rrg_week < 1) ? 0.00001 : (($current_sales_rrg_week - $previou_sales_rrg_week) / $previou_sales_rrg_week) * 100;
                                                        
                                                        }elseif($_GET['date'] == "All Time" && !isset($_GET['todate'])){

                                                            $rates_gr = 0;
                                                            $rates_rrg = 0;
                                                        
                                                        }

                                                        if($rates_rrg >= 0){
                                                        ?>
                                                            <p class="top-rate"> &nbsp;+<?=number_format($rates_rrg, 0)?></p>
                                                            <p class="top-rate">%</p>
                                                            <div class="cirlce-popular" align="center">
                                                                <img src="../../../src/image/Polygon 1.png" alt="">
                                                            </div>
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <p class="top-rate-min"> &nbsp;<?=number_format($rates_rrg, 0)?></p>
                                                            <p class="top-rate-min">%</p>
                                                            <div class="cirlce-popular-min" align="center">
                                                                <img src="../../../src/image/Polygon 1 (1).png" alt="">
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="barchart-content pt-4" align="center">
                                <div id="columnchart_material" class="chart-popular"></div>
                            </div>

                            <div class="barchart-content" align="center">

                                <div class="select-in-popular">
                                    <select class="select-popular" name="" id="select_popular"  >
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="All">All</option>
                                    </select>
                                </div>

                                <table class="table-popular table">
                                    <thead>
                                        <tr class="title-table">
                                            <th scope="col">Graphicriver</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">Sales</th>
                                            <th scope="col">RRgraph Item</th>
                                            <th scope="col">Author</th>
                                            <th scope="col">Sales</th>
                                            <th scope="col">Date</th>
                                        </tr>
                                    </thead>

                                    <tbody id="table-popular">

                                    <?php
                                    include '../../../src/connection/connection.php';

                                    date_default_timezone_set('Asia/Jakarta');
                                    $param_date             = date("Y-m-d");
                                    $param_year_month       = date("Y-m");
                                    $param_month            = date("m");
                                    $param_year             = date("Y");

                                    if($_GET['date'] == 'One Month Last' && !isset($_GET['todate'])){
                                        $previous_year_month    = date('Y-m', strtotime("-1 month"));

                                        $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$param_year_month%' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC  LIMIT 10");
                                        $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date LIKE '%$param_year_month%' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT 10");

                                    }elseif($_GET['date'] == '30 Days' && !isset($_GET['todate'])){
                                        $param_date_1   = date('Y-m-d', strtotime("-30 day"));
                                        $param_date_2   = date('Y-m-d', strtotime("-60 day"));
                                    
                                        $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC  LIMIT 10");
                                        $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT 10");

                                    }elseif($_GET['date'] == 'One Year Last' && !isset($_GET['todate'])){
                                        $param_date_1   = date('Y-m-d', strtotime("-12 month"));
                                        $param_date_2   = date('Y-m-d', strtotime("-24 month"));
                                    
                                        $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC  LIMIT 10");
                                        $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date BETWEEN '$param_date_1' AND '$param_date' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT 10");

                                    }elseif(isset($_GET['date']) && isset($_GET['todate'])){

                                        $date = $_GET['date'];
                                        $todate = $_GET['todate'];
                                        
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
                                       
                                        $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date BETWEEN '$date' AND '$todate' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC  LIMIT 10");
                                        $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date BETWEEN '$date' AND '$todate' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT 10");

                                    }elseif($_GET['date'] == "Last Month" && !isset($_GET['todate'])){
                                        $previous_year_month_1    = date('Y-m', strtotime("-1 month"));
                                        $previous_year_month_2    = date('Y-m', strtotime("-2 month"));
                                    
                                        $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE date LIKE '%$previous_year_month_1%' GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC  LIMIT 10");
                                        $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE date LIKE '%$previous_year_month_1%' GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT 10");

                                    }elseif($_GET['date'] == "This Year" && !isset($_GET['todate'])){
                                        $param_year_1   = date('Y', strtotime("-1 year"));

                                        $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$param_year GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC  LIMIT 10");
                                        $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE year=$param_year GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT 10");

                                    }elseif($_GET['date'] == "Last Year" && !isset($_GET['todate'])){
                                        $param_year_1   = date('Y', strtotime("-1 year"));
                                        $param_year_2   = date('Y', strtotime("-2 year"));

                                        $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE year=$param_year_1 GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC  LIMIT 10");
                                        $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular WHERE year=$param_year_1 GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT 10");

                                    }elseif($_GET['date'] == "All Time" && !isset($_GET['todate'])){

                                        $sql_market = mysqli_query($connect, "SELECT date, name, tb_sales.market_id, YEARWEEK(date) AS DATE_SALES, color, YEARWEEK(date) AS DATE_POPULARRR, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id GROUP BY YEARWEEK(date) ORDER BY  year DESC, month DESC, day DESC, TOTAL DESC  LIMIT 10");
                                        $sql_popular = mysqli_query($connect, "SELECT item_id, author, sales, YEARWEEK(date) AS DATE_POPULARRR, YEARWEEK(date) AS DATE_POPULAR, COUNT(*) AS JUMLAH FROM tb_popular GROUP BY YEARWEEK(date) ORDER BY sales DESC , year DESC, month DESC, day DESC LIMIT 10");
                                    
                                    }

                                    $rows = array();
                                    while($row = mysqli_fetch_array($sql_market)){
                                        $rows[] = $row;

                                    }
                                    $rowss = array();
                                    while($data = mysqli_fetch_array($sql_popular)){
                                        $rowss[] = $data;

                                    }
                                    // $combinedArray = array_replace_recursive($rows, $rowss);

                                    $combinedArray = array_replace_recursive(
                                        array_combine(array_column($rows, "DATE_POPULARRR"), $rows),
                                        array_combine(array_column($rowss, "DATE_POPULARRR"), $rowss)
                                    );

                                    // echo "<pre>";
                                    //     print_r($combinedArray);
                                    // echo "</pre>";


                                    // function addArray( array &$output, array $input ) {
                                    //     foreach( $input as $key => $value ) {
                                    //         if( is_array( $value ) ) {
                                    //             if( !isset( $output[$key] ) )
                                    //                 $output[$key] = array( );
                                    //             addArray( $output[$key], $value );
                                    //         } else {
                                    //             $output[$key] = $value;
                                    //         }
                                    //     }
                                    // }

                                    // $combinedArray = array( );
                                    // addArray( $combinedArray, $rows );
                                    // addArray( $combinedArray, $rowss );

                                    error_reporting(0);
                                    foreach( $combinedArray as $value ) {
                                    $market = array("1" => "GR-Brandearth", "2" => "GR-RRGraph", "3" => "Templatemonster", "4" => "Creativemarket", "5" => "RRSlide");
                                    if(!empty($value['sales'])){
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
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

	<script src="../../../src/js/navigasi.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/tooltip.js"></script> 
    <script src="../../../src/select/js/bvselect.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="../../../src/js/jquery.idle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="js/popular.js"></script>  
    <script src="js/costum_popular.js"></script> 
    <script src="../../../src/js/loader.js"></script>

</body>
</html>

