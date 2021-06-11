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
    <title>RRGraph - Top Country</title> 
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
                                <h1 class="title-content">Top Item Details</h1>
                                
                                <div class="range" style="width: 100%;" align="right">
                                    <?php
                                    if($_GET['date'] == 'One Month Last'){
                                    ?>
                                    <a href="?market=<?=$_GET['market']?>&type=<?=$_GET['type']?>&date=One Month Last">
                                        <button id="this_date" class="but-sales but-active" value="This Month">This Month</button>
                                    </a>
                                    <?php
                                    }else{
                                    ?>
                                    <a href="?market=<?=$_GET['market']?>&type=<?=$_GET['type']?>&date=One Month Last">
                                        <button id="this_date" class="but-sales" value="This Month">This Month</button>
                                    </a>
                                    <?php
                                    }
                                    if($_GET['date'] == '30 Days'){
                                    ?>
                                    <a href="?market=<?=$_GET['market']?>&type=<?=$_GET['type']?>&date=30 Days">
                                        <button id="30_date" class="but-sales but-active" value="30 Days">30 Days</button>
                                    </a>
                                    <?php
                                    }else{
                                    ?>
                                    <a href="?market=<?=$_GET['market']?>&type=<?=$_GET['type']?>&date=30 Days">
                                        <button id="30_date" class="but-sales" value="30 Days">30 Days</button>
                                    </a>
                                    <?php
                                    }
                                    if($_GET['date'] == 'One Year Last'){
                                    ?>
                                    <a href="?market=<?=$_GET['market']?>&type=<?=$_GET['type']?>&date=One Year Last">
                                        <button id="one_year_date" class="but-sales but-active" value="One Year">One Year</button>
                                    </a>
                                    <?php
                                    }else{
                                    ?>
                                    <a href="?market=<?=$_GET['market']?>&type=<?=$_GET['type']?>&date=One Year Last">
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
                                        <a href="?market=<?=$_GET['market']?>&type=<?=$_GET['type']?>&date=Last Month" id="last_month" class="dropdown-item" type="button" value="Last Month">Last Month</a>
                                        <a href="?market=<?=$_GET['market']?>&type=<?=$_GET['type']?>&date=This Year" id="this_year" class="dropdown-item" type="button" value="This Year">This Year</a>
                                        <a href="?market=<?=$_GET['market']?>&type=<?=$_GET['type']?>&date=Last Year" id="last_year" class="dropdown-item" type="button" value="Last Year">Last Year</a>
                                        <a href="?market=<?=$_GET['market']?>&type=<?=$_GET['type']?>&date=All Time" id="all_time" class="dropdown-item" type="button" value="All Time">All Time</a>
                                    </div>
                                    <?php
                                    }else{
                                    ?>
                                    <button class="btn btn-secondary dropdown-toggle but-sales" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Custom
                                    </button>
                                    <div class="dropdown-menu dd_costum" aria-labelledby="dropdownMenu2">
                                        <a href="?market=<?=$_GET['market']?>&type=<?=$_GET['type']?>&date=Last Month" id="last_month" class="dropdown-item" type="button" value="Last Month">Last Month</a>
                                        <a href="?market=<?=$_GET['market']?>&type=<?=$_GET['type']?>&date=This Year" id="this_year" class="dropdown-item" type="button" value="This Year">This Year</a>
                                        <a href="?market=<?=$_GET['market']?>&type=<?=$_GET['type']?>&date=Last Year" id="last_year" class="dropdown-item" type="button" value="Last Year">Last Year</a>
                                        <a href="?market=<?=$_GET['market']?>&type=<?=$_GET['type']?>&date=All Time" id="all_time" class="dropdown-item" type="button" value="All Time">All Time</a>
                                    </div>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if(isset($_GET['date']) && isset($_GET['todate'])){
                                    ?>
                                    <button id="costum_date" class="but-costum but-costum-active">Custom</button>
                                    <?php
                                    }else{
                                    ?>
                                    <button id="costum_date" class="but-costum">Custom</button>
                                    <?php
                                    }
                                    ?>

                                </div>
                                <div class="col-md-12" style="display: none;">  
                                    <h1 id="report" class="report" ></h1>
                                </div>
                            </div>
                            
                            <div class="content-in-item"> 
                                <div class="marketplace-item">
                                    <?php
                                    if($_GET['type'] == 'All Marketplace'){
                                    ?>
                                        <?php
                                        if(isset($_GET['todate'])){
                                        ?>
                                        <a href="?market=All Marketplace&type=All Marketplace&date=<?=$_GET['date']?>&todate=<?=$_GET['todate']?>">
                                        <?php
                                        }else{
                                        ?>
                                        <a href="?market=All Marketplace&type=All Marketplace&date=<?=$_GET['date']?>">
                                        <?php
                                        }
                                        ?>
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">All Marketplace</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <?php
                                        if(isset($_GET['todate'])){
                                        ?>
                                        <a href="?market=All Marketplace&type=All Marketplace&date=<?=$_GET['date']?>&todate=<?=$_GET['todate']?>">
                                        <?php
                                        }else{
                                        ?>
                                        <a href="?market=All Marketplace&type=All Marketplace&date=<?=$_GET['date']?>">
                                        <?php
                                        }
                                        ?>
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">All Marketplace</button>
                                        </a>
                                    <?php
                                    }

                                    if($_GET['type'] == 'GR-Brandearth'){
                                    ?>
                                        <?php
                                        if(isset($_GET['todate'])){
                                        ?>
                                        <a href="?market=All Marketplace&type=GR-Brandearth&date=<?=$_GET['date']?>&todate=<?=$_GET['todate']?>">
                                        <?php
                                        }else{
                                        ?>
                                        <a href="?market=All Marketplace&type=GR-Brandearth&date=<?=$_GET['date']?>">
                                        <?php
                                        }
                                        ?>
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">GR-Brandearth</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <?php
                                        if(isset($_GET['todate'])){
                                        ?>
                                        <a href="?market=All Marketplace&type=GR-Brandearth&date=<?=$_GET['date']?>&todate=<?=$_GET['todate']?>">
                                        <?php
                                        }else{
                                        ?>
                                        <a href="?market=All Marketplace&type=GR-Brandearth&date=<?=$_GET['date']?>">
                                        <?php
                                        }
                                        ?>
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">GR-Brandearth</button>
                                        </a>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($_GET['type'] == 'GR-RRGraph'){
                                    ?>
                                        <?php
                                        if(isset($_GET['todate'])){
                                        ?>
                                        <a href="?market=All Marketplace&type=GR-RRGraph&date=<?=$_GET['date']?>&todate=<?=$_GET['todate']?>">
                                        <?php
                                        }else{
                                        ?>
                                        <a href="?market=All Marketplace&type=GR-RRGraph&date=<?=$_GET['date']?>">
                                        <?php
                                        }
                                        ?>
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">GR-RRGraph</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <?php
                                        if(isset($_GET['todate'])){
                                        ?>
                                        <a href="?market=All Marketplace&type=GR-RRGraph&date=<?=$_GET['date']?>&todate=<?=$_GET['todate']?>">
                                        <?php
                                        }else{
                                        ?>
                                        <a href="?market=All Marketplace&type=GR-RRGraph&date=<?=$_GET['date']?>">
                                        <?php
                                        }
                                        ?>
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">GR-RRGraph</button>
                                        </a>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($_GET['type'] == 'Templatemonster'){
                                    ?>
                                        <?php
                                        if(isset($_GET['todate'])){
                                        ?>
                                        <a href="?market=All Marketplace&type=Templatemonster&date=<?=$_GET['date']?>&todate=<?=$_GET['todate']?>">
                                        <?php
                                        }else{
                                        ?>
                                        <a href="?market=All Marketplace&type=Templatemonster&date=<?=$_GET['date']?>">
                                        <?php
                                        }
                                        ?>
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">Creativemarket</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <?php
                                        if(isset($_GET['todate'])){
                                        ?>
                                        <a href="?market=All Marketplace&type=Templatemonster&date=<?=$_GET['date']?>&todate=<?=$_GET['todate']?>">
                                        <?php
                                        }else{
                                        ?>
                                        <a href="?market=All Marketplace&type=Templatemonster&date=<?=$_GET['date']?>">
                                        <?php
                                        }
                                        ?>
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">Creativemarket</button>
                                        </a>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($_GET['type'] == 'Creativemarket'){
                                    ?>
                                        <?php
                                        if(isset($_GET['todate'])){
                                        ?>
                                        <a href="?market=All Marketplace&type=Creativemarket&date=<?=$_GET['date']?>&todate=<?=$_GET['todate']?>">
                                        <?php
                                        }else{
                                        ?>
                                        <a href="?market=All Marketplace&type=Creativemarket&date=<?=$_GET['date']?>">
                                        <?php
                                        }
                                        ?>
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">Templatemonster</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <?php
                                        if(isset($_GET['todate'])){
                                        ?>
                                        <a href="?market=All Marketplace&type=Creativemarket&date=<?=$_GET['date']?>&todate=<?=$_GET['todate']?>">
                                        <?php
                                        }else{
                                        ?>
                                        <a href="?market=All Marketplace&type=Creativemarket&date=<?=$_GET['date']?>">
                                        <?php
                                        }
                                        ?>
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">Templatemonster</button>
                                        </a>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($_GET['type'] == 'RRSlide'){
                                    ?>
                                        <?php
                                        if(isset($_GET['todate'])){
                                        ?>
                                        <a href="?market=All Marketplace&type=RRSlide&date=<?=$_GET['date']?>&todate=<?=$_GET['todate']?>">
                                        <?php
                                        }else{
                                        ?>
                                        <a href="?market=All Marketplace&type=RRSlide&date=<?=$_GET['date']?>">
                                        <?php
                                        }
                                        ?>
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">RRSlide</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <?php
                                        if(isset($_GET['todate'])){
                                        ?>
                                        <a href="?market=All Marketplace&type=RRSlide&date=<?=$_GET['date']?>&todate=<?=$_GET['todate']?>">
                                        <?php
                                        }else{
                                        ?>
                                        <a href="?market=All Marketplace&type=RRSlide&date=<?=$_GET['date']?>">
                                        <?php
                                        }
                                        ?>
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">RRSlide</button>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <div class="select-in-item">
                                    <select class="select-country" name="" id="select_count" >
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="All">All</option>
                                    </select>
                                </div>
                            </div>

                            <div class="barchart-content" align="center">
                                <div id="country-chart" class="chart-category"></div>
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

