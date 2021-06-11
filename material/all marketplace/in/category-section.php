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
    <title>RRGraph - Setting Category</title> 
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
                    
                    <div class="main-sales">
                        <div class="distance-content">
                            <div class="header-content">
                                <h1 class="title-content">Category Setting</h1>
                            </div>
                            
                            <div class="content-in"> 
                                <?php
                                if($_GET['type'] == 'All'){
                                    if(isset($_GET['id'])){
                                ?>
                                    <a href="?market=All Marketplace&type=All&id=<?=$_GET['id']?>">
                                <?php
                                    }else{
                                ?>
                                    <a href="?market=All Marketplace&type=All">
                                <?php
                                    }
                                ?>
                                    <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">All</button>
                                </a>
                                <?php
                                }else{
                                    if(isset($_GET['id'])){
                                ?>
                                    <a href="?market=All Marketplace&type=All&id=<?=$_GET['id']?>">
                                <?php
                                    }else{
                                ?>
                                    <a href="?market=All Marketplace&type=All">
                                <?php
                                    }
                                ?>
                                    <button type="button" class="btn btn-primary btn-market-cat" name="" id="">All</button>
                                </a>
                                <?php
                                }

                                if($_GET['type'] == 'GR-Brandearth'){
                                    if(isset($_GET['id'])){
                                ?>
                                    <a href="?market=All Marketplace&type=GR-Brandearth&id=<?=$_GET['id']?>">
                                <?php
                                    }else{
                                ?>
                                    <a href="?market=All Marketplace&type=GR-Brandearth">
                                <?php
                                    }
                                ?>
                                        <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">GR-Brandearth</button>
                                    </a>
                                <?php
                                }else{
                                    if(isset($_GET['id'])){
                                ?>
                                    <a href="?market=All Marketplace&type=GR-Brandearth&id=<?=$_GET['id']?>">
                                <?php
                                    }else{
                                ?>
                                    <a href="?market=All Marketplace&type=GR-Brandearth">
                                <?php
                                    }
                                    ?>
                                    <a href="?market=All Marketplace&type=GR-Brandearth">
                                        <button type="button" class="btn btn-primary btn-market-cat" name="" id="">GR-Brandearth</button>
                                    </a>
                                <?php
                                }
                                ?>

                                <?php
                                if($_GET['type'] == 'GR-RRGraph'){
                                    if(isset($_GET['id'])){
                                ?>
                                    <a href="?market=All Marketplace&type=GR-RRGraph&id=<?=$_GET['id']?>">
                                <?php
                                    }else{
                                ?>
                                    <a href="?market=All Marketplace&type=GR-RRGraph">
                                <?php
                                    }
                                ?>
                                    <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">GR-RRGraph</button>
                                </a>
                                <?php
                                }else{
                                    if(isset($_GET['id'])){
                                ?>
                                    <a href="?market=All Marketplace&type=GR-RRGraph&id=<?=$_GET['id']?>">
                                <?php
                                    }else{
                                ?>
                                    <a href="?market=All Marketplace&type=GR-RRGraph">
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
                                    if(isset($_GET['id'])){
                                ?>
                                    <a href="?market=All Marketplace&type=Templatemonster&id=<?=$_GET['id']?>">
                                <?php
                                    }else{
                                ?>
                                    <a href="?market=All Marketplace&type=Templatemonster">
                                <?php
                                    }
                                ?>
                                    <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">Templatemonster</button>
                                </a>
                                <?php
                                }else{
                                    if(isset($_GET['id'])){
                                ?>
                                    <a href="?market=All Marketplace&type=Templatemonster&id=<?=$_GET['id']?>">
                                <?php
                                    }else{
                                ?>
                                    <a href="?market=All Marketplace&type=Templatemonster">
                                <?php
                                    }
                                ?>
                                    <button type="button" class="btn btn-primary btn-market-cat" name="" id="">Templatemonster</button>
                                </a>
                                <?php
                                }
                                ?>

                                <?php
                                if($_GET['type'] == 'Creativemarket'){
                                    if(isset($_GET['id'])){
                                ?>
                                    <a href="?market=All Marketplace&type=Creativemarket&id=<?=$_GET['id']?>">
                                <?php
                                    }else{
                                ?>
                                    <a href="?market=All Marketplace&type=Creativemarket">
                                <?php
                                    }
                                ?>
                                    <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">Creativemarket</button>
                                </a>
                                <?php
                                }else{
                                    if(isset($_GET['id'])){
                                ?>
                                    <a href="?market=All Marketplace&type=Creativemarket&id=<?=$_GET['id']?>">
                                <?php
                                    }else{
                                ?>
                                    <a href="?market=All Marketplace&type=Creativemarket">
                                <?php
                                    }
                                ?>
                                    <button type="button" class="btn btn-primary btn-market-cat" name="" id="">Creativemarket</button>
                                </a>
                                <?php
                                }
                                ?>

                                <?php
                                if($_GET['type'] == 'RRSlide'){
                                    if(isset($_GET['id'])){
                                ?>
                                    <a href="?market=All Marketplace&type=RRSlide&id=<?=$_GET['id']?>">
                                <?php
                                    }else{
                                ?>
                                    <a href="?market=All Marketplace&type=RRSlide">
                                <?php
                                    }
                                ?>
                                    <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">RRSlide</button>
                                </a>
                                <?php
                                }else{
                                    if(isset($_GET['id'])){
                                ?>
                                    <a href="?market=All Marketplace&type=RRSlide&id=<?=$_GET['id']?>">
                                <?php
                                    }else{
                                ?>
                                    <a href="?market=All Marketplace&type=RRSlide">
                                <?php
                                    }
                                ?>
                                    <button type="button" class="btn btn-primary btn-market-cat" name="" id="">RRSlide</button>
                                </a>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="content-catset">
                                <div class="category">
                                    <h1 class="title-content">Category</h1>
                                    <div class="category-place" align="center">
                                        <div class="table">
                                            <table class="table-category table">
                                                <thead>
                                                    <tr class="title-table">
                                                        <th scope="col">Name</th>
                                                        <th scope="col">Sub</th>
                                                        <th scope="col" style="text-align: right;">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="table-category">
                                                <?php
                                                include '../../../src/connection/connection.php';
                                                error_reporting(0);
                                                $type = $_GET['type'];
                                                $market_sup = array("All" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5");
                                                $market_id = $market_sup[$type];
                                                if($market_id == 0){
                                                    $query = mysqli_query($connect, "SELECT * FROM tb_category");
                                                }else{
                                                    $query = mysqli_query($connect, "SELECT * FROM `tb_catalog` INNER JOIN tb_category ON tb_catalog.category=tb_category.name WHERE market_id=$market_id && category!='' GROUP BY category");
                                                }
                                                while($row = mysqli_fetch_array($query)){
                                                    $id = $row['category_id'];
                                                    $total = "SELECT * FROM tb_sub_category WHERE category_id='$id'";

                                                    $total_sub = mysqli_num_rows(mysqli_query($connect, $total));
                                                ?>
                                                    <tr class="sub-title-table">
                                                        <?php
                                                        if($_GET['edit'] == $row['category_id']){
                                                        ?>
                                                        <form action="process/edit-cat.php" method="POST">
                                                        <td>
                                                            <input autofocus type="text" name="edit_name" class="inp-cate" placeholder="<?=$row['name']?>">
                                                            <input type="text" name="param_id" class="d-none" value="<?=$row['category_id']?>">
                                                            <input type="text" name="type" class="d-none" value="<?=$_GET['type']?>">
                                                            <?php
                                                            if(isset($_GET['id'])){
                                                            ?>
                                                            <input type="text" name="id" class="d-none" value="<?=$_GET['id']?>">
                                                            <?php
                                                            }else{
                                                            ?>
                                                            <input type="text" name="id" class="d-none" value="0">
                                                            <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?=$total_sub?></td>
                                                        <td align="right">
                                                        <input class="btn-update-sect" type="submit" value="Update">
                                                        </form>

                                                        <?php
                                                        if(isset($_GET['id'])){
                                                        ?>
                                                        <a href="?market=All%20Marketplace&type=All&id=<?=$_GET['id']?>">
                                                        <?php
                                                        }else{
                                                        ?>
                                                        <a href="?market=All%20Marketplace&type=All">
                                                        <?php
                                                        }
                                                        ?>
                                                            <input class="btn-cancel-sect" type="submit" value="Cancel">
                                                        </a>
                                                        </td>
                                                        <?php
                                                        }else{
                                                        ?>
                                                        <td><?=$row['name']?></td>
                                                        <td><?=$total_sub?></td>
                                                        <td>
                                                        <form action="process/delete-cat.php" method="POST">
                                                            <input class="d-none" type="text" name="param_id" value="<?=$row['category_id']?>">
                                                            <input class="d-none" type="text" name="type" value="<?=$_GET['type']?>">
                                                            <input type="submit" class="action-del" value="  ">
                                                            <a href="?market=All Marketplace&type=<?=$_GET['type']?>&id=<?=$row['category_id']?>" class="text-decoration-none">
                                                            <?php
                                                            if($_GET['id'] == $id){
                                                            ?>
                                                                <canvas class="action-cat-active"></canvas>
                                                            <?php
                                                            }else{
                                                            ?>
                                                                <canvas class="action-cat"></canvas>
                                                            <?php
                                                            }
                                                            ?>
                                                            </a>
                                                            
                                                        </form>
                                                        <?php
                                                        if(isset($_GET['id'])){
                                                        ?>
                                                            <a href="?market=All Marketplace&type=<?=$_GET['type']?>&id=<?=$_GET['id']?>&edit=<?=$row['category_id']?>" class="text-decoration-none">
                                                        <?php
                                                        }else{
                                                        ?>
                                                            <a href="?market=All Marketplace&type=<?=$_GET['type']?>&edit=<?=$row['category_id']?>" class="text-decoration-none">
                                                        <?php
                                                        }
                                                        ?>
                                                                <canvas class="action-cat-edit"></canvas>
                                                            </a>
                                                        </td>
                                                        <?php
                                                        }
                                                        ?>
                                                        
                                                    </tr> 
                                                <?php
                                                }
                                                ?>
                                                    <tr class="sub-title-table">
                                                        <td colspan="3">
                                                            <form action="process/input-sub-category.php" method="POST">
                                                                <input class="d-none" type="text" name="id" value="<?=$_GET['id']?>">
                                                                <input class="d-none" type="text" name="type" value="<?=$_GET['type']?>">
                                                                <input type="text" name="cat" class="inp-cate" placeholder="add new here ....">
                                                                <input class="sbm-cat float-right" type="submit" value="+ Add category">
                                                            </form>
                                                        </td>
                                                    </tr> 
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="subcategory">
                                    <h1 class="title-content">Sub-Category</h1>
                                    <div class="subcategory-place" align="center">
                                        <div class="table">
                                            <?php
                                            if(isset($_GET['id'])){
                                            ?>
                                                <table class="table-category table">
                                                    <thead>
                                                        <tr class="title-table">
                                                            <th scope="col">Name</th>
                                                            <th scope="col" style="text-align: right;">Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody id="table-market">
                                                    <?php
                                                    $id = $_GET['id'];
                                                    include '../../../src/connection/connection.php';
                                                    $query = mysqli_query($connect, "SELECT * FROM tb_sub_category WHERE category_id='$id'");
                                                    while($row = mysqli_fetch_array($query)){
                                                        if($_GET['subedit'] == $row['subcat_id']){
                                                    ?>
                                                        <tr class="sub-title-table">
                                                        <form action="process/process-subcat.php" method="POST">
                                                            <td>
                                                                    <input class="d-none" type="text" name="param_process" value="edit">
                                                                    <input autofocus type="text" name="edit_name" class="inp-cate" placeholder="<?=$row['name']?>">
                                                                    <input type="text" name="param_id" class="d-none" value="<?=$row['subcat_id']?>">
                                                                    <input type="text" name="id" class="d-none" value="<?=$_GET['id']?>">
                                                                    <input type="text" name="type" class="d-none" value="<?=$_GET['type']?>">
                                                            </td>
                                                            <td align="right">
                                                                <div class="dp-btn" style=" display: flex; float: right;">
                                                                    <input class="btn-update-sect" type="submit" value="Update">
                                                                    </form>

                                                                    <?php
                                                                    if(isset($_GET['id'])){
                                                                    ?>
                                                                    <a href="?market=All%20Marketplace&type=All&id=<?=$_GET['id']?>">
                                                                    <?php
                                                                    }else{
                                                                    ?>
                                                                    <a href="?market=All%20Marketplace&type=All">
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                        <input class="btn-cancel-sect" style="height: 100%;" type="submit" value="Cancel">
                                                                    </a>
                                                            </div>
                                                            </td>
                                                        </tr> 
                                                    <?php
                                                        }else{
                                                        ?>
                                                        <tr class="sub-title-table">
                                                            <td><?=$row['name']?></td>
                                                            <td>
                                                                <div class="dp-btn" style=" display: flex; float: right;">
                                                                <?php
                                                                if(isset($_GET['id'])){
                                                                ?>
                                                                    <a href="?market=All Marketplace&type=<?=$_GET['type']?>&id=<?=$_GET['id']?>&subedit=<?=$row['subcat_id']?>" class="text-decoration-none">
                                                                <?php
                                                                }else{
                                                                ?>
                                                                    <a href="?market=All Marketplace&type=<?=$_GET['type']?>&subedit=<?=$row['subcat_id']?>" class="text-decoration-none">
                                                                <?php
                                                                }
                                                                ?>
                                                                        <canvas class="action-cat-edit"></canvas>
                                                                    </a>

                                                                <form action="process/delete_subcat.php" method="POST">
                                                                    <input class="d-none" type="text" name="param_id" value="<?=$row['subcat_id']?>">
                                                                    <input class="d-none" type="text" name="param_process" value="delete">
                                                                    <input type="text" name="id" class="d-none" value="<?=$_GET['id']?>">
                                                                    <input type="submit" class="action-del" value="  ">
                                                                    <input type="text" name="type" class="d-none" value="<?=$_GET['type']?>">
                                                                </form>
                                                                
                                                                </div>
                                                            </td>
                                                        </tr> 
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                        <tr class="sub-title-table">
                                                            <form action="process/input-sub-category.php" method="POST">
                                                                <td>
                                                                    <input class="d-none" type="text" name="id" value="<?=$_GET['id']?>">
                                                                    <input type="text" name="sub" class="inp-cate" placeholder="add new here ....">
                                                                </td>

                                                                <td>
                                                                    <input class="sbm-cat float-right" type="submit" value="+ Add sub-category">
                                                                </td>
                                                            </form>
                                                        </tr> 
                                                    </tbody>
                                                </table>
                                            <?php
                                            }else{}
                                            ?>
                                        </div>
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
    <script src="js/category.js"></script>  
    <script src="js/main.js"></script> 
    <script src="../../../src/js/loader.js"></script>

</body>
</html>

