<?php
session_start();
    
if(!isset($_SESSION['email']) ) {
    header('location: ../../../Dashboard Fee/material/login/login.php');
    exit;
}else{
    if($_SESSION['role'] == 'User'){
        header('location: ../../../Dashboard Fee/material/team-viewer/');
    }
}
?>

<html>
<head>
    <title>RRGraph - Dashboard</title> 
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../../src/image/Group 38.png">

    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300;400;700&family=Poppins:wght@100;300;600&display=swap" rel="stylesheet">
    
    <!-- View -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
    <!-- Stylesheet -->
    <link rel="stylesheet" href="../../src/css/style.css">
    <link rel="stylesheet" href="../../src/select/css/bvselect.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"><link rel="stylesheet" href="../../src/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>

    <div class="loader">
        <img src="../../src/image/LOGO-RRG.svg" alt="">
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

                <a href="in/item-update.php?market=All%20Marketplace&type=All" class="place-item-setting">
                    <img src="../../src/image/SET-CATALOG.svg" alt="">
                    <h1>List Items / Catalog</h1>
                </a>

                <a href="in/category-section.php?market=All%20Marketplace&type=All" class="place-item-setting">
                    <img src="../../src/image/SET-CATEGORY.svg" alt="">
                    <h1>Set Category & Sub</h1>
                </a>

                <a href="in/tools-section.php?market=All%20Marketplace" class="place-item-setting">
                    <img src="../../src/image/SET-TYPE.svg" alt="">
                    <h1>Type Items / Tools</h1>
                </a>

                <a href="in/color-analyze.php?market=All%20Marketplace&type=All&item=Sales&date=One%20Year%20Last" class="place-item-setting-color">
                    <img src="../../src/image/SET-COLOR.svg" alt="">
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
                    <a href="in/item-download.php?market=All%20Marketplace&type=All%20Marketplace&date=One%20Year%20Last" class="tool" align="center">
                        <img src="../../src/image/SET-CATALOG.svg" alt="">
                        <h1>Most Download</h1>
                    </a>

                    <a href="in/category-bar.php?market=All%20Marketplace&type=All&date=One%20Year%20Last" class="tool" align="center">
                        <img src="../../src/image/SET-CATEGORY.svg" alt="">
                        <h1>By Category</h1>
                    </a>
                </div>

                <div class="place-tool">
                    <a href="in/color-analyze.php?market=All%20Marketplace&type=All&item=Sales&date=One%20Year%20Last" class="tool" align="center">
                        <img src="../../src/image/SET-COLOR.svg" alt="">
                        <h1>By Color</h1>
                    </a>

                    <a href="in/top-country.php?market=All%20Marketplace&type=All%20Marketplace&date=One%20Year%20Last" class="tool" align="center">
                        <img src="../../src/image/SET-REGION.svg" alt="">
                        <h1>By Region</h1>
                    </a>
                </div>

                <div class="place-tool">
                    <a href="in/upload-update.php?market=All%20Marketplace&type=All%20Marketplace&date=One%20Year%20Last" class="tool" align="center">
                        <img src="../../src/image/SET-UPLUPD.svg" alt="">
                        <h1>Upload & Update</h1>
                    </a>

                    <a href="in/popular-item.php?market=All%20Marketplace&date=One%20Year%20Last" class="tool" align="center">
                        <img src="../../src/image/SET-LIVE.svg" alt="">
                        <h1>Live Market</h1>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="grid-content">
        <nav align="center">
            <div class="logo">
                <a href="../../../Dashboard Fee/material/Dashboard/index.php">
                    <img src="../../src/image/LOGO-1.svg"/>
                </a>
            </div>
            
            <div class="item"  align="center">
                <ul>
                    <li class="sect-active" data-toggle="tooltip" data-placement="right" title="All Marketplace" id="tool-market">
                        <a id="href-all" href="">
                            <img class="logo-rr" src="../../src/image/MARKETPLACE.svg"/>
                        </a>
                    </li>

                    <li class="" data-toggle="tooltip" data-placement="right" title="Freebies" id="tool-freebies">
                        <a id="href-frb" href="">
                            <img class="logo-rr" src="../../src/image/FREEBIES.svg"/>
                        </a>
                    </li>

                    <li class="" data-toggle="tooltip" data-placement="right" title="News Letter" id="tool-newsletter">
                        <a id="href-nl" href="">
                            <img class="logo-rr" src="../../src/image/NEWSLETTER.svg"/>
                        </a>
                    </li>

                    <li class="" data-toggle="tooltip" data-placement="right" title="Team" id="tool-team">
                        <a href="../team/team.php?market=All%20Marketplace">
                            <img class="logo-rr" src="../../src/image/TEAM.svg"/>
                        </a>
                    </li>

                    <div class="notif-team" id="notif-place"><p id="notif"></p></div>

                    <li class="sect-bottom-1" data-toggle="tooltip" data-placement="right" title="Syncronize" id="tool-sync">
                        <a href="../upload/upload.php?market=All%20Marketplace">
                            <?php
                            include '../../src/connection/connection.php';
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
                            <img class="logo-rr" src="../../src/image/SYNC-GREEN.svg"/>
                            <?php
                            }else{
                            ?>
                            <img class="logo-rr" src="../../src/image/SYNC-RED.svg"/>
                            <?php
                            }
                            ?>
                        </a>
                    </li>

                    <li class="sect-bottom" data-toggle="tooltip" data-placement="right" title="Logout" id="tool-logout">
                        <a href="../../../Dashboard Fee/material/login/logout.php">
                            <img class="logo-rr" src="../../src/image/LOGOUT.svg"/>
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
                            <option id="opt-all">All Marketplace</option>
                                <?php
                                    include '../../src/connection/connection.php';
                                    $sql_market = mysqli_query($connect, "SELECT * FROM tb_marketplace");
                                    while($row = mysqli_fetch_array($sql_market)){
                                        if($row['market_id'] == 1){
                                            echo '<option data-img="../../src/image/GR-IC.svg" id="opt-be">'.$row['marketplace'].'</option>';
                                        }elseif($row['market_id'] == 2){
                                            echo '<option data-img="../../src/image/GR-IC.svg" id="opt-rrg">'.$row['marketplace'].'</option>';
                                        }elseif($row['market_id'] == 3){
                                            echo '<option data-img="../../src/image/TM-IC.svg" id="opt-tm">'.$row['marketplace'].'</option>';
                                        }elseif($row['market_id'] == 4){
                                            echo '<option data-img="../../src/image/CM-IC.svg" id="opt-cm">'.$row['marketplace'].'</option>';
                                        }elseif($row['market_id'] == 5){
                                            echo '<option data-img="../../src/image/RRS-IC.svg" id="opt-rrs">'.$row['marketplace'].'</option>';
                                        }
                                    }
                                ?>
                        </select>
                        
                        <a href="../freebies/freebies.php?market=All Marketplace&type=freebies">
                            Freebies
                        </a>
                        
                        <div class="col-md-4 search">
                            <form action="in/search.php?market=All Marketplace" method="POST" class="row">
                                <input type="text" name="search" id="search" placeholder="Template name here" onInput="search_all_m()">
                                <input type="submit" style="display: none;"> <img class="search-ic" src="../../src/image/SEARCH-IC.svg" alt="">
                                <img class="menu-ic" src="../../src/image/MENU-IC.svg" alt="" onclick="openNav2()">
                                
                                <img class="setting-ic" src="../../src/image/SETTING-IC.svg" alt="" onclick="openNav()">
                            </form>
                        </div>
                    </div>
                    
                    <div class="main-sales">
                        <div class="distance-content">
                            <div class="header-content">
                                <h1 class="title-content">Sales Summary
                                    <strong class="report-strong ml-2">|</strong> 
                                    <strong class="report-strong ml-2" id="report_start">Start Date</strong> 
                                    <strong class="report-strong">-</strong> 
                                    <strong class="report-strong" id="report_end">End Date</strong> 
                                </h1>
                                
                                <div class="range" style="width: 100%;" align="right">
                                    <button id="this_date" class="but-sales " value="This Month">This Month</button>
                                    <button id="30_date" class="but-sales" value="30 Days">30 Days</button>
                                    <button id="one_year_date" class="but-sales" value="One Year">One Year</button>
                                    <button class="btn btn-secondary dropdown-toggle but-sales" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Custom
                                    </button>
                                    <div class="dropdown-menu dd_costum" aria-labelledby="dropdownMenu2">
                                        <button id="last_month" class="dropdown-item" type="button" value="Last Month">Last Month</button>
                                        <button id="this_year" class="dropdown-item" type="button" value="This Year">This Year</button>
                                        <button id="last_year" class="dropdown-item" type="button" value="Last Year">Last Year</button>
                                        <button id="all_time" class="dropdown-item" type="button" value="All Time">All Time</button>
                                    </div>
                                    <button id="date_todate" class="but-sales d-none" value="One Year">One as</button>
                                    <button id="costum_date" class="but-costum" value="Costum Date">Period</button>
                                </div>
                                <div class="col-md-12" style="display: none;">  
                                    <h1 id="report" class="report" ></h1>
                                </div>

                            </div>

                            <div class="content"> 
                                <div class="total-sales-place">
                                    <div class="distance-total-place">
                                        <div class="circle-icon " align="center">
                                            <img src="../../src/image/TOTAL-IC.svg" alt="">
                                        </div>

                                        <h1 class="calc-title total-sales">0</h1>

                                        <?php
                                        // error_reporting(0);
                                        $rates = 0;
                                        ?>

                                        <p class="title-in-shape">
                                            Total Sales &nbsp; 
                                            
                                            <p id="plus-rate" class="title-rate">+</p>
                                            <p id="title-rate" class="title-rate sales-rate"> 
                                                <?=number_format($rates, 0)?>
                                                <p id="presentage" class="title-rate">%</p>
                                                <div id="plus-shape" class="shape-circle" align="center">
                                                    <img id="plus-image" src="../../src/image/Polygon 1.png" alt="">
                                                </div>
                                            </p>
                                        
                                        </p>
                                    </div>
                                </div>

                                <div class="avg-daily-place">
                                    <div class="distance-total-place">
                                        <div class="circle-icon-avg" align="center">
                                                <img clas src="../../src/image/AVG-IC.svg" alt="">
                                        </div>

                                        <h1 class="calc-title-sales avg-sales">0</h1>

                                        <p class="title-in-shape-sales">
                                            Avg daily sales 
                                        </p>
                                    </div>
                                </div>

                                <div class="total-item-place">
                                    <div class="place">
                                        <div class="distance-item-place">
                                            <div class="circle-icon-ppt" align="center">
                                                <img clas src="../../src/image/POWERPOINT-IC.svg" alt="">
                                            </div>

                                            <h1 class="calc-title-sales total_ppt_text">0</h1>

                                            <p class="title-in-shape-sales">
                                                Powerpoint Sales 
                                            </p>
                                        </div>
                                    </div>
                                    <div class="place">
                                        <div class="distance-item-place">
                                            <div class="circle-icon-ky" align="center">
                                                <img clas src="../../src/image/KEYNOTE-IC.svg" alt="">
                                            </div>

                                            <h1 class="calc-title-sales total_keynote_text">0</h1>

                                            <p class="title-in-shape-sales">
                                                Keynote Sales 
                                            </p>
                                        </div>
                                    </div>
                                    <div class="place">
                                        <div class="distance-item-place">
                                            <div class="circle-icon-pt" align="center">
                                                <img clas src="../../src/image/POTRAIT-IC.svg" alt="">
                                            </div>

                                            <h1 class="calc-title-sales total_potrait_text">0</h1>

                                            <p class="title-in-shape-sales">
                                                Potrait Sales
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="barchart-content" align="center">
                                <div id="chart_area" class="chart-area"></div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="main-search">
                        <div class="distance-content">
                            <div class="header-content">
                                <h1 class="title-content mt-3">Search Summary</h1>
                            </div>
                            
                            <div class="content"> 
                                
                            </div>

                        </div>
                    </div> -->
                    
                    <?php
                    if($_GET['market'] == "All Marketplace"){
                    ?>

                    <div class="main-market">
                        <div class="marketplace">
                            <div class="distance-content-market">
                                <div class="header-content-market">
                                    <h1 class="title-content">Marketplace</h1>
                                    <p>Total Data <strong id="totdat-day">345 Days</strong></p>
                                </div>

                                <div class="content">
                                    <div id="piechart" class="piechart-pptall"></div>  

                                    <table class="table-market table">
                                        <thead>
                                            <tr class="title-table">
                                                <th scope="col">Marketplace</th>
                                                <th scope="col">Sales</th>
                                                <th scope="col">Stats</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table-market">

                                        <tr class="sub-title-table">
                                            <?php
                                            if($row['market_id'] == 1){
                                                $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #343FD5; border-radius: 100%; float: left; margin-top: 2%; margin-right: 2%;'></div>";
                                            }elseif($row['market_id'] == 2){
                                                $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #3EBEF4; border-radius: 100%; float: left; margin-top: 2%; margin-right: 2%;'></div>";
                                            }elseif($row['market_id'] == 3){
                                                $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #F6425E; border-radius: 100%; float: left; margin-top: 2%; margin-right: 2%;'></div>";
                                            }elseif($row['market_id'] == 4){
                                                $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #2BE870; border-radius: 100%; float: left; margin-top: 2%; margin-right: 2%;'></div>";
                                            }elseif($row['market_id'] == 5){
                                                $circle_shape = "<div class='circle-shape-market' style='width: 0.6vw; height: 0.6vw; background-color: #FBA146; border-radius: 100%; float: left; margin-top: 2%; margin-right: 2%;'></div>";
                                            }
                                            ?>
                                            <td scope="row"></td>
                                            <td></td>
                                            <td>
                                                <?php
                                                $rates = 0;
                                                if($rates > 0){
                                                ?>
                                                <p id="plus-rate" class="title-rate">+</p>
                                                <p id="title-rate" class="title-rate sales-rate"> 
                                                    <?=number_format($rates, 0)?>
                                                    <p id="presentage" class="title-rate">%</p>
                                                    <div id="plus-shape" class="shape-circle" align="center">
                                                        <img id="plus-image" src="../../src/image/Polygon 1.png" alt="">
                                                    </div>
                                                </p>
                                                <?php
                                                }elseif($rates < 0){
                                                ?>
                                                <p id="plus-rate" class="title-rate"></p>
                                                <p id="title-rate" class="title-rate-min sales-rate"> 
                                                    <?=number_format($rates, 0)?>
                                                    <p id="presentage" class="title-rate-min">%</p>
                                                    <div id="plus-shape" class="shape-circle-min" align="center">
                                                        <img id="plus-image" src="../../src/image/Polygon 1 (1).png" alt="">
                                                    </div>
                                                </p>
                                                <?php
                                                }elseif($rates == 0){
                                                ?>
                                                <p id="title-rate" class="title-rate sales-rate"> 
                                                    <?=number_format($rates, 0)?>
                                                    <p id="presentage" class="title-rate">%</p>
                                                    <div id="plus-shape" class="shape-circle" align="center">
                                                        <img id="plus-image" src="../../src/image/Polygon 1.png" alt="">
                                                    </div>
                                                </p>
                                            </td>
                                        </tr> 

                                            <?php
                                                }
                                            ?>

                                        </tbody>
                                    </table>  
                                </div>
                            </div>
                        </div>
                        <div class="info">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content-info">Info
                                        <img src="../../src/image/UPLOAD-IC.svg" alt="" align="right">
                                    </h1>
                                </div>

                                <div class="sub-header-content">
                                    <p class="desc-upd" >
                                        Data from &nbsp;
                                        <strong class="desc-upd-sub" id="title_info"> One Year/ 1 Month </strong>
                                    </p>
                                </div>
                                
                                <div class="info-upload">
                                    <p class="info-title" id="num-upl">0

                                        <p class="desc-info" >New Item Uploaded<br/>
                                            <p class="desc-bot-info" id="min-upl">0<p class="desc-bot-info">&nbsp;Items&nbsp;</p>
                                                <p class="desc-bot-info-sub"> on previous period</p>
                                            </p>
                                        </p>
                                    </p>

                                    <div class="line"></div>

                                    <p class="info-title" id="num-upd">0

                                        <p class="desc-info" >New Item Uploaded<br/>
                                            <p class="desc-bot-info" id="min-upd">0<p class="desc-bot-info">&nbsp;Items&nbsp;</p>
                                                <p class="desc-bot-info-sub"> on previous period</p>
                                            </p>
                                        </p>
                                    </p>
                                    
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="main-table pb-5">
                        <div class="table-item-place-all">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content">Top Items Download</h1>

                                    <input style="display: none;" type="text" name="market" value="<?=$_GET['market']?>" id="param_more_market">
                                    <input style="display: none;" type="text" name="date" id="param_more_date">
                                    <input style="display: none;" type="text" name="todate" id="param_more_todate">

                                    <button class="btn-more-details" id="btn_more_detail">More Details</button>
                                </div>

                                <div class="content">
                                    <table class="table-item table">
                                        <thead>
                                            <tr class="title-table">
                                                <th style="width: 60%;">Items Name</th>
                                                <th>Sales</th>
                                                <th>Stats</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table-items">
                                            <tr class="sub-title-table">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="table-item-place">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content">Top Country</h1>

                                    <button class="btn-more-country" id="btn_more_country">More Details</button>
                                </div>

                                <div class="content">
                                    <table class="table-country table">
                                        <thead>
                                            <tr class="title-table">
                                                <th style="width: 60%;">Country</th>
                                                <th>Sales</th>
                                                <th>Stats</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table-country">
                                            <tr class="sub-title-table">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                   
                    <?php
                    }elseif($_GET['market'] == "GR-Brandearth"){
                    ?>
                    <div class="main-table">
                        <div class="table-item-place">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content">Top Items Download</h1>

                                    <input style="display: none;" type="text" name="market" value="<?=$_GET['market']?>" id="param_more_market">
                                    <input style="display: none;" type="text" name="date" id="param_more_date">
                                    <input style="display: none;" type="text" name="todate" id="param_more_todate">

                                    <button class="btn-more-country" id="btn_more_detail">More Details</button>
                                </div>

                                <div class="content">
                                    <table class="table-item table">
                                        <thead>
                                            <tr class="title-table">
                                                <th style="width: 60%;">Items Name</th>
                                                <th>Sales</th>
                                                <th>Stats</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table-items">
                                            <tr class="sub-title-table">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="table-item-place-all">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content">Top Country</h1>

                                    <button class="btn-more-details" id="btn_more_country">More Details</button>
                                </div>

                                <div class="content">
                                    <table class="table-country table">
                                        <thead>
                                            <tr class="title-table">
                                                <th style="width: 60%;">Country</th>
                                                <th>Sales</th>
                                                <th>Stats</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table-country">
                                            <tr class="sub-title-table">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="main-market pb-5">

                        <div class="info">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content-info">Info
                                        <img src="../../src/image/UPLOAD-IC.svg" alt="" align="right">
                                    </h1>
                                </div>

                                <div class="sub-header-content">
                                    <p class="desc-upd" >
                                        Data from &nbsp;
                                        <strong class="desc-upd-sub" id="title_info"> One Year/ 1 Month </strong>
                                    </p>
                                </div>
                                
                                <div class="info-upload">
                                    <p class="info-title" id="num-upl">0

                                        <p class="desc-info" >New Item Uploaded<br/>
                                            <p class="desc-bot-info" id="min-upl">0<p class="desc-bot-info">&nbsp;Items&nbsp;</p>
                                                <p class="desc-bot-info-sub"> on previous period</p>
                                            </p>
                                        </p>
                                    </p>

                                    <div class="line"></div>

                                    <p class="info-title" id="num-upd">0

                                        <p class="desc-info" >New Item Uploaded<br/>
                                            <p class="desc-bot-info" id="min-upd">0<p class="desc-bot-info">&nbsp;Items&nbsp;</p>
                                                <p class="desc-bot-info-sub"> on previous period</p>
                                            </p>
                                        </p>
                                    </p>
                                    
                                </div>
                                
                            </div>
                        </div>

                        <div class="marketplace">
                            <div class="distance-content-market">
                                <div class="header-content">
                                    <h1 class="title-content">Tools Demography</h1>
                                </div>

                                <div class="content">
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-total" data-percent="100">
                                                <span class="total-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>Total Item</p>
                                            <h1 id="total-sales">Total Item</h1>
                                        </div>
                                    </div>
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-ppt" id="chart-ppt" data-percent="">
                                                <span class="ppt-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>PowerPoint</p>
                                            <h1 id="ppt-sales">Total Item</h1>
                                        </div>
                                    </div>
                                </div>

                                <div class="content">
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-keynote" id="chart-keynote" data-percent="">
                                                <span class="keynote-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>Keynote</p>
                                            <h1 id="keynote-sales">Total Item</h1>
                                        </div>
                                    </div>
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-potrait" id="chart-potrait" data-percent="">
                                                <span class="potrait-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>Potrait</p>
                                            <h1 id="potrait-sales">Total Item</h1>
                                        </div>
                                    </div>
                                </div>

                                <div class="content">
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-gs" id="chart-gs" data-percent="">
                                                <span class="gs-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>Google Slide</p>
                                            <h1 id="gs-sales">Total Item</h1>
                                        </div>
                                    </div>
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-etc" id="chart-etc" data-percent="">
                                                <span class="etc-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>Etc</p>
                                            <h1 id="etc-sales">Total Item</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php
                    }elseif($_GET['market'] == "GR-RRGraph"){
                    ?>
                    <div class="main-table">
                        <div class="table-item-place">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content">Top Items Download</h1>
                                    <input style="display: none;" type="text" name="market" value="<?=$_GET['market']?>" id="param_more_market">
                                    <input style="display: none;" type="text" name="date" id="param_more_date">
                                    <input style="display: none;" type="text" name="todate" id="param_more_todate">

                                    <button class="btn-more-country" id="btn_more_detail">More Details</button>
                                </div>

                                <div class="content">
                                    <table class="table-item table">
                                        <thead>
                                            <tr class="title-table">
                                                <th style="width: 60%;">Items Name</th>
                                                <th>Sales</th>
                                                <th>Stats</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table-items">
                                            <tr class="sub-title-table">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="table-item-place-all">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content">Top Country</h1>

                                    <button class="btn-more-details" id="btn_more_country">More Details</button>
                                </div>

                                <div class="content">
                                    <table class="table-country table">
                                        <thead>
                                            <tr class="title-table">
                                                <th style="width: 60%;">Country</th>
                                                <th>Sales</th>
                                                <th>Stats</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table-country">
                                            <tr class="sub-title-table">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="main-market pb-5">

                        <div class="info">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content-info">Info
                                        <img src="../../src/image/UPLOAD-IC.svg" alt="" align="right">
                                    </h1>
                                </div>

                                <div class="sub-header-content">
                                    <p class="desc-upd" >
                                        Data from &nbsp;
                                        <strong class="desc-upd-sub" id="title_info"> One Year/ 1 Month </strong>
                                    </p>
                                </div>
                                
                                <div class="info-upload">
                                    <p class="info-title" id="num-upl">0

                                        <p class="desc-info" >New Item Uploaded<br/>
                                            <p class="desc-bot-info" id="min-upl">0<p class="desc-bot-info">&nbsp;Items&nbsp;</p>
                                                <p class="desc-bot-info-sub"> on previous period</p>
                                            </p>
                                        </p>
                                    </p>

                                    <div class="line"></div>

                                    <p class="info-title" id="num-upd">0

                                        <p class="desc-info" >New Item Uploaded<br/>
                                            <p class="desc-bot-info" id="min-upd">0<p class="desc-bot-info">&nbsp;Items&nbsp;</p>
                                                <p class="desc-bot-info-sub"> on previous period</p>
                                            </p>
                                        </p>
                                    </p>
                                    
                                </div>
                                
                            </div>
                        </div>

                        <div class="marketplace">
                            <div class="distance-content-market">
                                <div class="header-content">
                                    <h1 class="title-content">Tools Demography</h1>
                                </div>

                                <div class="content">
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-total" data-percent="100">
                                                <span class="total-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>Total Item</p>
                                            <h1 id="total-sales">Total Item</h1>
                                        </div>
                                    </div>
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-ppt" id="chart-ppt" data-percent="">
                                                <span class="ppt-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>PowerPoint</p>
                                            <h1 id="ppt-sales">Total Item</h1>
                                        </div>
                                    </div>
                                </div>

                                <div class="content">
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-keynote" id="chart-keynote" data-percent="">
                                                <span class="keynote-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>Keynote</p>
                                            <h1 id="keynote-sales">Total Item</h1>
                                        </div>
                                    </div>
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-potrait" id="chart-potrait" data-percent="">
                                                <span class="potrait-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>Potrait</p>
                                            <h1 id="potrait-sales">Total Item</h1>
                                        </div>
                                    </div>
                                </div>

                                <div class="content">
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-gs" id="chart-gs" data-percent="">
                                                <span class="gs-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>Google Slide</p>
                                            <h1 id="gs-sales">Total Item</h1>
                                        </div>
                                    </div>
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-etc" id="chart-etc" data-percent="">
                                                <span class="etc-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>Etc</p>
                                            <h1 id="etc-sales">Total Item</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php
                    }elseif($_GET['market'] == "Templatemonster"){
                    ?>
                    <div class="main-table">
                        <div class="table-item-place">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content">Top Items Download</h1>
                                    <input style="display: none;" type="text" name="market" value="<?=$_GET['market']?>" id="param_more_market">
                                    <input style="display: none;" type="text" name="date" id="param_more_date">
                                    <input style="display: none;" type="text" name="todate" id="param_more_todate">

                                    <button class="btn-more-country" id="btn_more_detail">More Details</button>
                                </div>

                                <div class="content">
                                    <table class="table-item table">
                                        <thead>
                                            <tr class="title-table">
                                                <th style="width: 60%;">Items Name</th>
                                                <th>Sales</th>
                                                <th>Stats</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table-items">
                                            <tr class="sub-title-table">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="table-item-place-all">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content">Top Country</h1>

                                    <button class="btn-more-details" id="btn_more_country">More Details</button>
                                </div>

                                <div class="content">
                                    <table class="table-country table">
                                        <thead>
                                            <tr class="title-table">
                                                <th style="width: 60%;">Country</th>
                                                <th>Sales</th>
                                                <th>Stats</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table-country">
                                            <tr class="sub-title-table">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }elseif($_GET['market'] == "Creativemarket"){
                    ?>
                    <div class="main-table">
                        <div class="table-item-place">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content">Top Items Download</h1>
                                    <input style="display: none;" type="text" name="market" value="<?=$_GET['market']?>" id="param_more_market">
                                    <input style="display: none;" type="text" name="date" id="param_more_date">
                                    <input style="display: none;" type="text" name="todate" id="param_more_todate">

                                    <button class="btn-more-country" id="btn_more_detail">More Details</button>
                                </div>

                                <div class="content">
                                    <table class="table-item table">
                                        <thead>
                                            <tr class="title-table">
                                                <th style="width: 60%;">Items Name</th>
                                                <th>Sales</th>
                                                <th>Stats</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table-items">
                                            <tr class="sub-title-table">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="table-item-place-all">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content">Top Country</h1>

                                    <button class="btn-more-details" id="btn_more_country">More Details</button>
                                </div>

                                <div class="content">
                                    <table class="table-country table">
                                        <thead>
                                            <tr class="title-table">
                                                <th style="width: 60%;">Country</th>
                                                <th>Sales</th>
                                                <th>Stats</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table-country">
                                            <tr class="sub-title-table">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }elseif($_GET['market'] == "RRSlide"){
                    ?>
                    <div class="main-table">
                        <div class="table-item-place">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content">Top Items Download</h1>
                                    <input style="display: none;" type="text" name="market" value="<?=$_GET['market']?>" id="param_more_market">
                                    <input style="display: none;" type="text" name="date" id="param_more_date">
                                    <input style="display: none;" type="text" name="todate" id="param_more_todate">

                                    <button class="btn-more-country" id="btn_more_detail">More Details</button>
                                </div>

                                <div class="content">
                                    <table class="table-item table">
                                        <thead>
                                            <tr class="title-table">
                                                <th style="width: 60%;">Items Name</th>
                                                <th>Sales</th>
                                                <th>Stats</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table-items">
                                            <tr class="sub-title-table">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="table-item-place-all">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content">Top Country</h1>

                                    <button class="btn-more-details" id="btn_more_country">More Details</button>
                                </div>

                                <div class="content">
                                    <table class="table-country table">
                                        <thead>
                                            <tr class="title-table">
                                                <th style="width: 60%;">Country</th>
                                                <th>Sales</th>
                                                <th>Stats</th>
                                            </tr>
                                        </thead>

                                        <tbody id="table-country">
                                            <tr class="sub-title-table">
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr> 
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="main-market pb-5">

                        <div class="info">
                            <div class="distance-content-info">
                                <div class="header-content">
                                    <h1 class="title-content-info">Info
                                        <img src="../../src/image/UPLOAD-IC.svg" alt="" align="right">
                                    </h1>
                                </div>

                                <div class="sub-header-content">
                                    <p class="desc-upd" >
                                        Data from &nbsp;
                                        <strong class="desc-upd-sub" id="title_info"> One Year/ 1 Month </strong>
                                    </p>
                                </div>
                                
                                <div class="info-upload">
                                    <p class="info-title" id="num-upl">0

                                        <p class="desc-info" >New Item Uploaded<br/>
                                            <p class="desc-bot-info" id="min-upl">0<p class="desc-bot-info">&nbsp;Items&nbsp;</p>
                                                <p class="desc-bot-info-sub"> on previous period</p>
                                            </p>
                                        </p>
                                    </p>

                                    <div class="line"></div>

                                    <p class="info-title" id="num-upd">0

                                        <p class="desc-info" >New Item Uploaded<br/>
                                            <p class="desc-bot-info" id="min-upd">0<p class="desc-bot-info">&nbsp;Items&nbsp;</p>
                                                <p class="desc-bot-info-sub"> on previous period</p>
                                            </p>
                                        </p>
                                    </p>
                                    
                                </div>
                                
                            </div>
                        </div>

                        <div class="marketplace">
                            <div class="distance-content-market">
                                <div class="header-content">
                                    <h1 class="title-content">Tools Demography</h1>
                                </div>

                                <div class="content">
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-total" data-percent="100">
                                                <span class="total-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>Total Item</p>
                                            <h1 id="total-sales">Total Item</h1>
                                        </div>
                                    </div>
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-ppt" id="chart-ppt" data-percent="">
                                                <span class="ppt-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>Presentation</p>
                                            <h1 id="ppt-sales">Total Item</h1>
                                        </div>
                                    </div>
                                </div>

                                <div class="content">
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-keynote" id="chart-keynote" data-percent="">
                                                <span class="keynote-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>Infographic</p>
                                            <h1 id="keynote-sales">Total Item</h1>
                                        </div>
                                    </div>
                                    <div class="place-demo">
                                        <div class="box">
                                            <div class="chart-potrait" id="chart-potrait" data-percent="">
                                                <span class="potrait-percent">100%</span>
                                            </div>
                                        </div>
                                        <div class="title-demograph">
                                            <p>Freebies</p>
                                            <h1 id="potrait-sales">Total Item</h1>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
        </main>
    </div> 

	<script src="../../src/js/navigasi.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="../../src/js/jquery.min.js"></script>
    <script src="../../src/js/bootstrap.min.js"></script>
    <script src="js/circle.js"></script>
    <script src="../../src/select/js/bvselect.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/tooltip.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="js/jquery.easypiechart.js"></script>
    <script type="text/javascript" src="js/main.js"></script> 
    <script src="js/content.js"></script> 
    <script src="../../src/js/loader.js"></script>
    

</body>
</html>

