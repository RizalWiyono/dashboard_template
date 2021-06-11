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
    <title>RRGraph - Tools Section / Type</title> 
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
                            <option value="../all-marketplace.php?market=All Marketplace">All Marketplace</option>
                                <?php
                                    include '../../../src/connection/connection.php';
                                    $sql_market = mysqli_query($connect, "SELECT * FROM tb_marketplace");
                                    while($row = mysqli_fetch_array($sql_market)){
                                        if($row['market_id'] == 1){
                                            echo '<option data-img="../../../src/image/GR-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'">'.$row['marketplace'].'</option>';
                                        }elseif($row['market_id'] == 2){
                                            echo '<option data-img="../../../src/image/GR-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'">'.$row['marketplace'].'</option>';
                                        }elseif($row['market_id'] == 3){
                                            echo '<option data-img="../../../src/image/TM-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'">'.$row['marketplace'].'</option>';
                                        }elseif($row['market_id'] == 4){
                                            echo '<option data-img="../../../src/image/CM-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'">'.$row['marketplace'].'</option>';
                                        }elseif($row['market_id'] == 5){
                                            echo '<option data-img="../../../src/image/RRS-IC.svg" value="../all-marketplace.php?market='.$market[$row['market_id']].'">'.$row['marketplace'].'</option>';
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
                    
                    <div class="main-sales-tools">
                        <div class="distance-content">
                            <div class="header-content">
                                <h1 class="title-content mt-4">Tools Section</h1>
                            </div>

                            <div class="tools-section mt-4">
                                <div class="tools-place" align="center">
                                    <div class="table">
                                        <table class="table-tools table">
                                            <thead>
                                                <tr class="title-table">
                                                    <th scope="col">Name</th>
                                                    <th style="text-align: right;">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody id="table-tools">
                                            <?php
                                            error_reporting(0);
                                            include '../../../src/connection/connection.php';
                                            $sql_market = mysqli_query($connect, "SELECT * FROM tb_section");
                                            while($row = mysqli_fetch_array($sql_market)){
                                            ?>
                                                <tr class="sub-title-table">
                                                    <?php
                                                    if($row['section_id'] == $_GET['id']){
                                                    ?>
                                                    <td>
                                                        <form action="process/input-section.php" method="POST">
                                                        <input name="edit" type="text" placeholder="<?=$row['name']?>">
                                                    </td>
                                                    <td style="text-align: right;">
                                                        <input class="d-none" name="type" type="text" value="Edit">
                                                        <input class="d-none" name="id" type="text" value="<?=$_GET['id']?>">
                                                        <input class="btn-update-sect" type="submit" value="Update">
                                                        </form>
                                                        <a href="?market=All Marketplace">
                                                            <input class="btn-cancel-sect" type="submit" value="Cancel">
                                                        </a>
                                                    </td>
                                                    <?php
                                                    }else{
                                                    ?>
                                                    <td><?=$row['name']?></td>
                                                    <td style="text-align: right;">
                                                        <a class="mr-3 text-decoration-none" href="?market=All Marketplace&id=<?=$row['section_id']?>">
                                                        <form action="process/input-section.php" method="POST">
                                                        <input class="btn-upd-sect" type="button" name="" id="" value="Edit">   
                                                        </a>
                                                            <input class="d-none" name="id" type="text" value="<?=$row['section_id']?>">
                                                            <input class="d-none" name="type" type="text" value="Delete">
                                                            <input class="btn-upd-sect" type="submit" name="" id="" value="Delete">   
                                                        </form>
                                                    </td>
                                                    <?php
                                                    }
                                                    ?>
                                                </tr> 
                                            <?php
                                            }
                                            ?>
                                                <tr class="sub-title-table">
                                                    <td colspan="2">
                                                        <form action="process/input-section.php" method="POST">
                                                            <input class="d-none" name="type" type="text" value="Input">
                                                            <input type="text" name="section" class="inp-cate" placeholder="add new here ....">
                                                            <input class="sbm-cat float-right" type="submit" value="+ Add sub-category">
                                                        </form>
                                                    </td>
                                                </tr> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
    <script type="text/javascript" src="../js/tooltip.js"></script> 
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="js/content.js"></script>  
    <script src="js/main.js"></script> 
    <script src="../../../src/js/loader.js"></script>

</body>
</html>

