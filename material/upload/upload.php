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
    <title>RRGraph - Syncronize</title> 
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
    <link rel="stylesheet" href="../../src/select/css/bvselect.css">
    <link rel="stylesheet" href="../../src/css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous"><link rel="stylesheet" href="../../src/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    
    <link rel="stylesheet" href="../../src/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../src/css/sweetalert2.min.css">
	<link rel="stylesheet" href="../../src/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../src/css/animate.min.css">

</head>
<body >

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

                <a href="../all marketplace/in/item-update.php?market=All%20Marketplace&type=All" class="place-item-setting">
                    <img src="../../src/image/SET-CATALOG.svg" alt="">
                    <h1>List Items / Catalog</h1>
                </a>

                <a href="../all marketplace/in/category-section.php?market=All%20Marketplace&type=All" class="place-item-setting">
                    <img src="../../src/image/SET-CATEGORY.svg" alt="">
                    <h1>Set Category & Sub</h1>
                </a>

                <a href="../all marketplace/in/tools-section.php?market=All%20Marketplace" class="place-item-setting">
                    <img src="../../src/image/SET-TYPE.svg" alt="">
                    <h1>Type Items / Tools</h1>
                </a>

                <a href="../all marketplace/in/color-analyze.php?market=All%20Marketplace&type=All&item=Sales&date=One%20Year%20Last" class="place-item-setting-color">
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
                        <a href="../all marketplace/in/item-download.php?market=All%20Marketplace&type=All%20Marketplace&date=One%20Year%20Last" class="tool" align="center">
                            <img src="../../src/image/SET-CATALOG.svg" alt="">
                            <h1>Most Download</h1>
                        </a>

                        <a href="../all marketplace/in/category-bar.php?market=All%20Marketplace&type=All&date=One%20Year%20Last" class="tool" align="center">
                            <img src="../../src/image/SET-CATEGORY.svg" alt="">
                            <h1>By Category</h1>
                        </a>
                    </div>

                    <div class="place-tool">
                        <a href="../all marketplace/in/color-analyze.php?market=All%20Marketplace&type=All&item=Sales&date=One%20Year%20Last" class="tool" align="center">
                            <img src="../../src/image/SET-COLOR.svg" alt="">
                            <h1>By Color</h1>
                        </a>

                        <a href="../all marketplace/in/top-country.php?market=All%20Marketplace&type=All%20Marketplace&date=One%20Year%20Last" class="tool" align="center">
                            <img src="../../src/image/SET-REGION.svg" alt="">
                            <h1>By Region</h1>
                        </a>
                    </div>

                    <div class="place-tool">
                        <a href="../all marketplace/in/upload-update.php?market=All%20Marketplace&type=All%20Marketplace&date=One%20Year%20Last" class="tool" align="center">
                            <img src="../../src/image/SET-UPLUPD.svg" alt="">
                            <h1>Upload & Update</h1>
                        </a>

                        <a href="../all marketplace/in/popular-item.php?market=All%20Marketplace&date=One%20Year%20Last" class="tool" align="center">
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
                    <li class="" data-toggle="tooltip" data-placement="right" title="All Marketplace" id="tool-market">
                        <a href="../all marketplace/all-marketplace.php?market=All Marketplace">
                            <img class="logo-rr" src="../../src/image/MARKETPLACE.svg"/>
                        </a>
                    </li>

                    <li class="" data-toggle="tooltip" data-placement="right" title="Freebies" id="tool-freebies">
                        <a href="../freebies/freebies.php?market=All Marketplace&type=freebies">
                            <img class="logo-rr" src="../../src/image/FREEBIES.svg"/>
                        </a>
                    </li>

                    <li class="" data-toggle="tooltip" data-placement="right" title="News Letter" id="tool-newsletter">
                        <a href="../news letter/news_letter.php?market=All Marketplace">
                            <img class="logo-rr" src="../../src/image/NEWSLETTER.svg"/>
                        </a>
                    </li>

                    <li class="" data-toggle="tooltip" data-placement="right" title="Team" id="tool-team">
                        <a href="../team/team.php?market=All%20Marketplace">
                            <img class="logo-rr" src="../../src/image/TEAM.svg"/>
                        </a>
                    </li>

                    <div class="notif-team" id="notif-place"><p id="notif"></p></div>

                    <li class="sect-bottom-1 sect-active" data-toggle="tooltip" data-placement="right" title="Syncronize" id="tool-sync">
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
                            <option value="../all marketplace/all-marketplace.php?market=All Marketplace">All Marketplace</option>
                                <?php
                                    include '../../src/connection/connection.php';
                                    $sql_market = mysqli_query($connect, "SELECT * FROM tb_marketplace");
                                    while($row = mysqli_fetch_array($sql_market)){
                                        if($row['market_id'] == 1){
                                            echo '<option data-img="../../src/image/GR-IC.svg" value="../all marketplace/all-marketplace.php?market='.$market[$row['market_id']].'">'.$row['marketplace'].'</option>';
                                        }elseif($row['market_id'] == 2){
                                            echo '<option data-img="../../src/image/GR-IC.svg" value="../all marketplace/all-marketplace.php?market='.$market[$row['market_id']].'">'.$row['marketplace'].'</option>';
                                        }elseif($row['market_id'] == 3){
                                            echo '<option data-img="../../src/image/TM-IC.svg" value="../all marketplace/all-marketplace.php?market='.$market[$row['market_id']].'">'.$row['marketplace'].'</option>';
                                        }elseif($row['market_id'] == 4){
                                            echo '<option data-img="../../src/image/CM-IC.svg" value="../all marketplace/all-marketplace.php?market='.$market[$row['market_id']].'">'.$row['marketplace'].'</option>';
                                        }elseif($row['market_id'] == 5){
                                            echo '<option data-img="../../src/image/RRS-IC.svg" value="../all marketplace/all-marketplace.php?market='.$market[$row['market_id']].'">'.$row['marketplace'].'</option>';
                                        }
                                    }
                                ?>
                        </select>

                        <a href="../freebies/freebies.php?market=All Marketplace&type=freebies">
                            Freebies
                        </a>
                        
                        <div class="col-md-4 search">
                            <form action="../all marketplace/in/search.php?market=All Marketplace" method="POST" class="row">
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
                                <h1 class="title-content">Synchronize</h1>
                            </div>
                            
                            <div class="content"> 
                            <table class="table-sync table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Platform</th>
                                                <th scope="col">Start</th>
                                                <th scope="col">Last Update</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            error_reporting(0);
                                            date_default_timezone_set('Asia/Jakarta');
                                            $date_ac= date("d M Y");
                                            $day_ac= date("D");
                                            include '../../src/connection/connection.php';
                                            $query="SELECT * FROM tb_activity_template WHERE activity='Upload File - GR-BE' ORDER BY activity_id DESC LIMIT 1";
                                            $result = mysqli_query($connect, $query);
                                            while($row =mysqli_fetch_array($result)) {
                                            $date_be = $row['date'];
                                            $time_be = $row['hours'];
                                            $date_bee = date("d M Y", strtotime($date_be));
                                            }


                                            $query="SELECT * FROM tb_activity_template WHERE activity LIKE '%Upload File - GR-RRG%' ORDER BY activity_id DESC LIMIT 1";
                                            $result = mysqli_query($connect, $query);
                                            while($row =mysqli_fetch_array($result)) {
                                            $date_rrg = $row['date'];
                                            $time_rrg = $row['hours'];
                                            $date_rrgg = date("d M Y", strtotime($date_rrg));
                                            }

                                            $query="SELECT * FROM tb_activity_template WHERE activity LIKE '%Upload File - TM%' ORDER BY activity_id DESC LIMIT 1";
                                            $result = mysqli_query($connect, $query);
                                            while($row =mysqli_fetch_array($result)) {
                                            $date_tm = $row['date'];
                                            $time_tm = $row['hours'];
                                            $date_tmm = date("d M Y", strtotime($date_tm));
                                            }

                                            $query="SELECT * FROM tb_activity_template WHERE activity LIKE '%Upload File - CM%' ORDER BY activity_id DESC LIMIT 1";
                                            $result = mysqli_query($connect, $query);
                                            while($row =mysqli_fetch_array($result)) {
                                            $date_cm = $row['date'];
                                            $time_cm = $row['hours'];
                                            $date_cmm = date("d M Y", strtotime($date_cm));
                                            }

                                            $query="SELECT * FROM tb_activity_template WHERE activity LIKE '%Upload File - RRS%' ORDER BY activity_id DESC LIMIT 1";
                                            $result = mysqli_query($connect, $query);
                                            while($row =mysqli_fetch_array($result)) {
                                            $date_rrs = $row['date'];
                                            $time_rrs = $row['hours'];
                                            $date_rrss = date("d M Y", strtotime($date_rrs));
                                            }

                                            $query="SELECT date FROM `tb_sales` WHERE market_id=1 GROUP BY date ASC LIMIT 1";
                                            $result = mysqli_query($connect, $query);
                                            while($row =mysqli_fetch_array($result)) {
                                            $BE = $row['date'];
                                            $start_BE = date("d M Y", strtotime($BE));
                                            }

                                            $query="SELECT date FROM `tb_sales` WHERE market_id=2 GROUP BY date ASC LIMIT 1";
                                            $result = mysqli_query($connect, $query);
                                            while($row =mysqli_fetch_array($result)) {
                                            $RRG = $row['date'];
                                            $start_RRG = date("d M Y", strtotime($RRG));
                                            }

                                            $query="SELECT date FROM `tb_sales` WHERE market_id=3 GROUP BY date ASC LIMIT 1";
                                            $result = mysqli_query($connect, $query);
                                            while($row =mysqli_fetch_array($result)) {
                                            $TM = $row['date'];
                                            $start_TM = date("d M Y", strtotime($TM));
                                            }

                                            $query="SELECT date FROM `tb_sales` WHERE market_id=4 GROUP BY date ASC LIMIT 1";
                                            $result = mysqli_query($connect, $query);
                                            while($row =mysqli_fetch_array($result)) {
                                            $CM = $row['date'];
                                            $start_CM = date("d M Y", strtotime($CM));
                                            }

                                            $query="SELECT date FROM `tb_sales` WHERE market_id=5 GROUP BY date ASC LIMIT 1";
                                            $result = mysqli_query($connect, $query);
                                            while($row =mysqli_fetch_array($result)) {
                                            $RRS = $row['date'];
                                            $start_RRS = date("d M Y", strtotime($RRS));
                                            }

                                            $query="SELECT * FROM tb_marketplace";
                                            $result = mysqli_query($connect, $query);
                                            while($row =mysqli_fetch_array($result)) {
                                            
                                            ?>
                                            <tr>
                                                <?php
                                                if($row['market_id'] == 1){
                                                ?>
                                                <td>
                                                    <div class="header-title-sync">
                                                        <img class="img-sync" src="../../src/image/GR-IC2.svg" alt="" >

                                                        <div class="title-sync">
                                                            <h1>GR-Brandearth</h1>
                                                            <p>graphicriver.net/user/brandearth</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="title-sync-start">
                                                        <h1><?=$start_BE?></h1>
                                                    </div>    
                                                </td>
                                                <?php
                                                    if($date_be == $date_ac){
                                                ?>
                                                    <td>
                                                        <div class="title-sync-last-today">
                                                            <h1>Today</h1>
                                                            <p>at&nbsp;<?=substr($time_be, 0, 5)?></p>
                                                        </div>    
                                                    </td>
                                                <?php
                                                    }else{
                                                ?>
                                                    <td>
                                                        <div class="title-sync-last">
                                                            <h1><?=$date_be?></h1>
                                                            <p>at&nbsp;<?=substr($time_be, 0, 5)?></p>
                                                        </div>    
                                                    </td>
                                                <?php
                                                    }
                                                ?>
                                                <td>
                                                    <?php
                                                    if($date_be == $date_ac){
                                                    ?>
                                                    <div class="curent-date">
                                                        <p>
                                                            current
                                                        </p>
                                                    </div>
                                                    <?php
                                                    }else{
                                                        $fm_date1 = date("Y-m-d", strtotime($date_be));
                                                        $fm_date2= date("Y-m-d");

                                                        $earlier = new DateTime($fm_date1);
                                                        $later = new DateTime($fm_date2);

                                                        $diff = $later->diff($earlier)->format("%a");
                                                    ?>
                                                    <div class="curent-date-day">
                                                        <p>
                                                            <?=$diff?> days late
                                                        </p>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button class="btn-sync" id="btn-be" data-toggle="tooltip" data-placement="bottom" title="Synchronize">
                                                        <img src="../../src/image/SYNCRONIZE.svg" alt="">
                                                    </button>
                                                    <button class="btn-sync" id="be" data-toggle="tooltip" data-placement="bottom" title="Upload CSV">
                                                        <img src="../../src/image/UPL-SYNC-IC.svg" alt="">
                                                    </button>
                                                    <button class="btn-sync" id="reset-be" data-toggle="tooltip" data-placement="bottom" title="Clear Data">
                                                        <img src="../../src/image/DELETE-SYNC.svg" alt="">
                                                    </button>
                                                </td>
                                                <?php
                                                }elseif($row['market_id'] == 2){
                                                ?>
                                                <td>
                                                    <div class="header-title-sync">
                                                        <img src="../../src/image/GR-IC2.svg" alt="">

                                                        <div class="title-sync">
                                                            <h1>GR-RRGraph</h1>
                                                            <p>graphicriver.net/user/rrgraph</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="title-sync-start">
                                                        <h1><?=$start_RRG?></h1>
                                                    </div>          
                                                </td>
                                                <?php
                                                    if($date_rrg == $date_ac){
                                                ?>
                                                    <td>
                                                        <div class="title-sync-last-today">
                                                            <h1>Today</h1>
                                                            <p>at&nbsp;<?=substr($time_rrg, 0, 5)?></p>
                                                        </div>    
                                                    </td>
                                                <?php
                                                    }else{
                                                ?>
                                                    <td>
                                                        <div class="title-sync-last">
                                                            <h1><?=$date_rrg?></h1>
                                                            <p>at&nbsp;<?=substr($time_rrg, 0, 5)?></p>
                                                        </div>    
                                                    </td>
                                                <?php
                                                    }
                                                ?>
                                                <td>
                                                    <?php
                                                    if($date_rrg == $date_ac){
                                                    ?>
                                                    <div class="curent-date">
                                                        <p>
                                                            current
                                                        </p>
                                                    </div>
                                                    <?php
                                                    }else{
                                                        $fm_date1 = date("Y-m-d", strtotime($date_rrg));
                                                        $fm_date2= date("Y-m-d");

                                                        $earlier = new DateTime($fm_date1);
                                                        $later = new DateTime($fm_date2);

                                                        $diff = $later->diff($earlier)->format("%a");
                                                    ?>
                                                    <div class="curent-date-day">
                                                        <p>
                                                            <?=$diff?> days late
                                                        </p>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button class="btn-sync" id="btn-rrg" data-toggle="tooltip" data-placement="bottom" title="Synchronize">
                                                        <img src="../../src/image/SYNCRONIZE.svg" alt="">
                                                    </button>
                                                    <button class="btn-sync" id="rrg" data-toggle="tooltip" data-placement="bottom" title="Upload CSV">
                                                        <img src="../../src/image/UPL-SYNC-IC.svg" alt="">
                                                    </button>
                                                    <button class="btn-sync" id="reset-rrg" data-toggle="tooltip" data-placement="bottom" title="Clear Data">
                                                        <img src="../../src/image/DELETE-SYNC.svg" alt="">
                                                    </button>
                                                </td>
                                                <?php
                                                }elseif($row['market_id'] == 3){
                                                ?>
                                                <td>
                                                    <div class="header-title-sync">
                                                        <img src="../../src/image/TM-IC.svg" alt="">

                                                        <div class="title-sync">
                                                            <h1>Templatemonster</h1>
                                                            <p>templatemonster.com/authors/rrgraph</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="title-sync-start">
                                                        <h1><?=$start_TM?></h1>
                                                    </div>       
                                                </td>
                                                <?php
                                                    if($date_tm == $date_ac){
                                                ?>
                                                    <td>
                                                        <div class="title-sync-last-today">
                                                            <h1>Today</h1>
                                                            <p>at&nbsp;<?=substr($time_tm, 0, 5)?></p>
                                                        </div>    
                                                    </td>
                                                <?php
                                                    }else{
                                                ?>
                                                    <td>
                                                        <div class="title-sync-last">
                                                            <h1><?=$date_tm?></h1>
                                                            <p>at&nbsp;<?=substr($time_tm, 0, 5)?></p>
                                                        </div>    
                                                    </td>
                                                <?php
                                                    }
                                                ?>
                                                <td>
                                                    <?php
                                                    if($date_tm == $date_ac){
                                                    ?>
                                                    <div class="curent-date">
                                                        <p>
                                                            current
                                                        </p>
                                                    </div>
                                                    <?php
                                                    }else{
                                                        $fm_date1 = date("Y-m-d", strtotime($date_tm));
                                                        $fm_date2= date("Y-m-d");

                                                        $earlier = new DateTime($fm_date1);
                                                        $later = new DateTime($fm_date2);

                                                        $diff = $later->diff($earlier)->format("%a");
                                                    ?>
                                                    <div class="curent-date-day">
                                                        <p>
                                                            <?=$diff?> days late
                                                        </p>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button class="btn-sync" id="btn-tm" data-toggle="tooltip" data-placement="bottom" title="Upload CSV">
                                                        <img src="../../src/image/UPL-SYNC-IC.svg" alt="">
                                                    </button>
                                                    <button class="btn-sync" id="reset-tm" data-toggle="tooltip" data-placement="bottom" title="Clear Data">
                                                        <img src="../../src/image/DELETE-SYNC.svg" alt="">
                                                    </button>
                                                </td>
                                                <?php
                                                }elseif($row['market_id'] == 4){
                                                ?>
                                                <td>
                                                    <div class="header-title-sync">
                                                        <img src="../../src/image/CM-IC.svg" alt="">

                                                        <div class="title-sync">
                                                            <h1>Creativemarket</h1>
                                                            <p>creativemarket.com/rrgraph</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="title-sync-start">
                                                        <h1><?=$start_CM?></h1>
                                                    </div>
                                                </td>
                                                <?php
                                                    if($date_cm == $date_ac){
                                                ?>
                                                    <td>
                                                        <div class="title-sync-last-today">
                                                            <h1>Today</h1>
                                                            <p>at&nbsp;<?=substr($time_cm, 0, 5)?></p>
                                                        </div>    
                                                    </td>
                                                <?php
                                                    }else{
                                                ?>
                                                    <td>
                                                        <div class="title-sync-last">
                                                            <h1><?=$date_cm?></h1>
                                                            <p>at&nbsp;<?=substr($time_cm, 0, 5)?></p>
                                                        </div>    
                                                    </td>
                                                <?php
                                                    }
                                                ?>
                                                <td>
                                                    <?php
                                                    if($date_cm == $date_ac){
                                                    ?>
                                                    <div class="curent-date">
                                                        <p>
                                                            current
                                                        </p>
                                                    </div>
                                                    <?php
                                                    }else{
                                                        $fm_date1 = date("Y-m-d", strtotime($date_cm));
                                                        $fm_date2= date("Y-m-d");

                                                        $earlier = new DateTime($fm_date1);
                                                        $later = new DateTime($fm_date2);

                                                        $diff = $later->diff($earlier)->format("%a");
                                                    ?>
                                                    <div class="curent-date-day">
                                                        <p>
                                                            <?=$diff?> days late
                                                        </p>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button class="btn-sync" id="btn-cm" data-toggle="tooltip" data-placement="bottom" title="Upload CSV">
                                                        <img src="../../src/image/UPL-SYNC-IC.svg" alt="">
                                                    </button>
                                                    <button class="btn-sync" id="reset-cm" data-toggle="tooltip" data-placement="bottom" title="Clear Data">
                                                        <img src="../../src/image/DELETE-SYNC.svg" alt="">
                                                    </button>
                                                </td>
                                                <?php
                                                }elseif($row['market_id'] == 5){
                                                ?>
                                                <td>
                                                    <div class="header-title-sync">
                                                        <img src="../../src/image/RRS-IC.svg" alt="">

                                                        <div class="title-sync">
                                                            <h1>RRSlide</h1>
                                                            <p>rrslide.com</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="title-sync-start">
                                                        <h1><?=$start_RRS?></h1>
                                                    </div>
                                                </td>
                                                <?php
                                                    if($date_rrs == $date_ac){
                                                ?>
                                                    <td>
                                                        <div class="title-sync-last-today">
                                                            <h1>Today</h1>
                                                            <p>at&nbsp;<?=substr($time_rrs, 0, 5)?></p>
                                                        </div>    
                                                    </td>
                                                <?php
                                                    }else{
                                                ?>
                                                    <td>
                                                        <div class="title-sync-last">
                                                            <h1><?=$date_rrs?></h1>
                                                            <p>at&nbsp;<?=substr($time_rrs, 0, 5)?></p>
                                                        </div>    
                                                    </td>
                                                <?php
                                                    }
                                                ?>
                                                <td>
                                                    <?php
                                                    if($date_rrs == $date_ac){
                                                    ?>
                                                    <div class="curent-date">
                                                        <p>
                                                            current
                                                        </p>
                                                    </div>
                                                    <?php
                                                    }else{
                                                        $fm_date1 = date("Y-m-d", strtotime($date_rrs));
                                                        $fm_date2= date("Y-m-d");

                                                        $earlier = new DateTime($fm_date1);
                                                        $later = new DateTime($fm_date2);

                                                        $diff = $later->diff($earlier)->format("%a");
                                                    ?>
                                                    <div class="curent-date-day">
                                                        <p>
                                                            <?=$diff?> days late
                                                        </p>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button class="btn-sync" id="btn-rrs" data-toggle="tooltip" data-placement="bottom" title="Synchronize">
                                                        <img src="../../src/image/SYNCRONIZE.svg" alt="">
                                                    </button>
                                                    <button class="btn-sync" id="rrs" data-toggle="tooltip" data-placement="bottom" title="Upload CSV">
                                                        <img src="../../src/image/UPL-SYNC-IC.svg" alt="">
                                                    </button>
                                                    <button class="btn-sync" id="reset-rrs" data-toggle="tooltip" data-placement="bottom" title="Clear Data">
                                                        <img src="../../src/image/DELETE-SYNC.svg" alt="">
                                                    </button>
                                                </td>
                                                <?php
                                                }
                                                ?>
                                            </tr>
                                            <?php
                                            }
                                            ?>
                                            <tr>
                                                <td>
                                                    <div class="header-title-sync">
                                                        <img src="../../src/image/SB-IC.svg" alt="">

                                                        <div class="title-sync">
                                                            <h1>News Letter</h1>
                                                            <p>my.sendinblue.com</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php
                                                $query="SELECT date FROM `tb_newsletter` WHERE date!='0000-00-00' GROUP BY date ASC LIMIT 1";
                                                $result = mysqli_query($connect, $query);
                                                while($row =mysqli_fetch_array($result)) {
                                                $NL = $row['date'];
                                                $start_NL = date("d M Y", strtotime($NL));
                                                }
                                                ?>
                                                <td>
                                                    <div class="title-sync-start">
                                                        <h1><?=$start_NL?></h1>
                                                    </div>
                                                </td>
                                                <?php
                                                $query="SELECT * FROM tb_activity_template WHERE activity LIKE '%Upload File - NL%' ORDER BY activity_id DESC LIMIT 1";
                                                $result = mysqli_query($connect, $query);
                                                while($row =mysqli_fetch_array($result)) {
                                                $date_nl = $row['date'];
                                                $time_nl = $row['hours'];
                                                $date_nll = date("d M Y", strtotime($date_ne));
                                                }
                                                ?>
                                                <?php
                                                    if($date_nl == $date_ac){
                                                ?>
                                                    <td>
                                                        <div class="title-sync-last-today">
                                                            <h1>Today</h1>
                                                            <p>at&nbsp;<?=substr($time_nl, 0, 5)?></p>
                                                        </div>    
                                                    </td>
                                                <?php
                                                    }else{
                                                ?>
                                                    <td>
                                                        <div class="title-sync-last">
                                                            <h1><?=$date_nl?></h1>
                                                            <p>at&nbsp;<?=substr($time_nl, 0, 5)?></p>
                                                        </div>    
                                                    </td>
                                                <?php
                                                    }
                                                ?>
                                                <td>
                                                <?php
                                                    if($date_nl == $date_ac){
                                                    ?>
                                                    <div class="curent-date">
                                                        <p>
                                                            current
                                                        </p>
                                                    </div>
                                                    <?php
                                                    }else{
                                                        $fm_date1 = date("Y-m-d", strtotime($date_nl));
                                                        $fm_date2= date("Y-m-d");

                                                        $earlier = new DateTime($fm_date1);
                                                        $later = new DateTime($fm_date2);

                                                        $diff = $later->diff($earlier)->format("%a");
                                                    ?>
                                                    <div class="curent-date-day">
                                                        <p>
                                                            <?=$diff?> days late
                                                        </p>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <button class="btn-sync" id="btn-nl" data-toggle="tooltip" data-placement="bottom" title="Synchronize">
                                                        <img src="../../src/image/SYNCRONIZE.svg" alt="">
                                                    </button>
                                                    <button class="btn-sync" id="reset-nl" data-toggle="tooltip" data-placement="bottom" title="Clear Data">
                                                        <img src="../../src/image/DELETE-SYNC.svg" alt="">
                                                    </button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="header-title-sync">
                                                        <img class="img-sync" src="../../src/image/GR-IC2.svg" alt="" >

                                                        <div class="title-sync">
                                                            <h1>Data Popular</h1>
                                                            <p>graphicriver.net/user/brandearth</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <?php
                                                $query="SELECT date FROM `tb_popular` GROUP BY date ASC LIMIT 1";
                                                $result = mysqli_query($connect, $query);
                                                while($row =mysqli_fetch_array($result)) {
                                                $DP = $row['date'];
                                                $start_DP = date("d M Y", strtotime($DP));
                                                }
                                                ?>
                                                <td>
                                                    <div class="title-sync-start">
                                                        <h1><?=$start_DP?></h1>
                                                    </div>
                                                </td>
                                                <?php
                                                $query="SELECT * FROM tb_activity_template WHERE activity LIKE '%Upload File - DT-POPULAR%' ORDER BY activity_id DESC LIMIT 1";
                                                $result = mysqli_query($connect, $query);
                                                while($row =mysqli_fetch_array($result)) {
                                                $date_dp = $row['date'];
                                                $time_dp = $row['hours'];
                                                $date_dpp = date("d M Y", strtotime($date_dp));
                                                }
                                                ?>
                                                <?php
                                                    if($date_dp == $date_ac){
                                                ?>
                                                    <td>
                                                        <div class="title-sync-last-today">
                                                            <h1>Today</h1>
                                                            <p>at&nbsp;<?=substr($time_dp, 0, 5)?></p>
                                                        </div>    
                                                    </td>
                                                <?php
                                                    }else{
                                                ?>
                                                    <td>
                                                        <div class="title-sync-last">
                                                            <h1><?=$date_dp?></h1>
                                                            <p>at&nbsp;<?=substr($time_dp, 0, 5)?></p>
                                                        </div>    
                                                    </td>
                                                <?php
                                                    }
                                                ?>
                                                <td>
                                                <?php
                                                    if($date_dp == $date_ac){
                                                    ?>
                                                    <div class="curent-date">
                                                        <p>
                                                            current
                                                        </p>
                                                    </div>
                                                    <?php
                                                    }else{
                                                        $fm_date1 = date("Y-m-d", strtotime($date_dp));
                                                        $fm_date2= date("Y-m-d");

                                                        $earlier = new DateTime($fm_date1);
                                                        $later = new DateTime($fm_date2);

                                                        $diff = $later->diff($earlier)->format("%a");
                                                    ?>
                                                    <div class="curent-date-day">
                                                        <p>
                                                            <?=$diff?> days late
                                                        </p>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                <?php
                                                if($day_ac == 'Tue'){
                                                ?>
                                                    <button class="btn-sync" id="btn-dp" data-toggle="tooltip" data-placement="bottom" title="Synchronize">
                                                <?php
                                                }else{
                                                ?>
                                                    <button class="btn-sync" disabled id="btn-dp" data-toggle="tooltip" data-placement="bottom" title="Synchronize">
                                                <?php
                                                }
                                                ?>
                                                        <img src="../../src/image/SYNCRONIZE.svg" alt="">
                                                    </button>
                                                    <button class="btn-sync" id="reset-dp" data-toggle="tooltip" data-placement="bottom" title="Clear Data">
                                                        <img src="../../src/image/DELETE-SYNC.svg" alt="">
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>

                    <div class="distance-all-market">
                        
                    </div>

                </div>
            </div>
        </main>
    </div> 
    <p id="username" style="display: none;"><?=$_SESSION['pass'];?></p>

    <div class="hover_bkgr_friccbe">
        <span class="helper"></span>
        <div class="place-ul">
                <p class="title-upload">
                Upload your file here
                </p>
            <form action="process/process-input.php" method="post" enctype="multipart/form-data">
                <h1 class="title-market">GR-Brandearth</h1>
                <input type="text" style="display: none;" name="market" value="1">
                <div class="drop-zone" align="center">
                    <img class="dropzone-csv" src="../../src/image/UPL-CSV.svg" alt="">
                    <span class="drop-zone__prompt">Select or drop your file here.</span>
                    <input type="file" name="file" class="drop-zone__input" multiple="multiple">
                </div>
                <input type="submit" id="submit" name="submit" class="upl-inp " value="Yes, Upload it!"/>
                <p class="cnc-csv">Cancel</p>
            </form>
        </div>
    </div>

    <div class="hover_bkgr_friccrrg">
        <span class="helper"></span>
        <div class="place-ul">
                <p class="title-upload">
                Upload your file here
                </p>
            <form action="process/process-input.php" method="post" enctype="multipart/form-data">
                <h1 class="title-market">GR-RRGaph</h1>
                <input type="text" style="display: none;" name="market" value="2">
                <div class="drop-zone" align="center">
                    <img class="dropzone-csv" src="../../src/image/UPL-CSV.svg" alt="">
                    <span class="drop-zone__prompt">Select or drop your file here.</span>
                    <input type="file" name="file" class="drop-zone__input" multiple="multiple">
                </div>
                <input type="submit" id="submit" name="submit" class="upl-inp " value="Yes, Upload it!"/>
                <p class="cnc-csv">Cancel</p>
            </form>
        </div>
    </div>

    <div class="hover_bkgr_fricctm">
        <span class="helper"></span>
        <div class="place-ul">
                <p class="title-upload">
                Upload your file here
                </p>
            <form action="process/process-input.php" method="post" enctype="multipart/form-data">
                <h1 class="title-market">TemplateMonster</h1>
                <input type="text" style="display: none;" name="market" value="3">
                <div class="drop-zone" align="center">
                    <img class="dropzone-csv" src="../../src/image/UPL-CSV.svg" alt="">
                    <span class="drop-zone__prompt">Select or drop your file here.</span>
                    <input type="file" name="file" class="drop-zone__input" multiple="multiple">
                </div>
                <input type="submit" id="submit" name="submit" class="upl-inp " value="Yes, Upload it!"/>
                <p class="cnc-csv">Cancel</p>
            </form>
        </div>
    </div>

    <div class="hover_bkgr_fricccm">
        <span class="helper"></span>
        <div class="place-ul">
                <p class="title-upload">
                Upload your file here
                </p>
            <form action="process/process-input.php" method="post" enctype="multipart/form-data">
                <h1 class="title-market">CreativeMarket</h1>
                <input type="text" style="display: none;" name="market" value="4">
                <div class="drop-zone" align="center">
                    <img class="dropzone-csv" src="../../src/image/UPL-CSV.svg" alt="">
                    <span class="drop-zone__prompt">Select or drop your file here.</span>
                    <input type="file" name="file" class="drop-zone__input" multiple="multiple">
                </div>
                <input type="submit" id="submit" name="submit" class="upl-inp " value="Yes, Upload it!"/>
                <p class="cnc-csv">Cancel</p>
            </form>
        </div>
    </div>

    <div class="hover_bkgr_friccrrs">
        <span class="helper"></span>
        <div class="place-ul">
                <p class="title-upload">
                Upload your file here
                </p>
            <form action="process/process-input.php" method="post" enctype="multipart/form-data">
                <h1 class="title-market">RRSlide</h1>
                <input type="text" style="display: none;" name="market" value="5">
                <div class="drop-zone" align="center">
                    <img class="dropzone-csv" src="../../src/image/UPL-CSV.svg" alt="">
                    <span class="drop-zone__prompt">Select or drop your file here.</span>
                    <input type="file" name="file" class="drop-zone__input" multiple="multiple">
                </div>
                <input type="submit" id="submit" name="submit" class="upl-inp " value="Yes, Upload it!"/>
                <p class="cnc-csv">Cancel</p>
            </form>
        </div>
    </div>

	<script src="../../src/js/navigasi.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../all marketplace/js/tooltip.js"></script> 
    <script src="../../src/js/jquery.min.js"></script>
    <script src="../../src/js/bootstrap.min.js"></script>
    <script src="../../src/js/select.js"></script> 
    <script type="text/javascript" src="../../src/js/jquery.idle.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="js/jquery.easypiechart.js"></script>
    <script src="js/circle.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="js/main.js"></script> 
    <script src="js/content.js"></script> 
    <script src="js/bar-chart.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <script src="js/alert.js"></script> 
    <script src="../../src/select/js/bvselect.js"></script>
    <script src="js/asset.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="../../src/js/loader.js"></script>

</body>
</html>

