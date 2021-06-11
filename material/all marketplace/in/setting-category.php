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
    <title>RRGraph - Setting Category All</title> 
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
    <link rel="stylesheet" type="text/css" href="../../../src/DataTables/datatables.css"/>

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
                                <h1 class="title-content">Top Item Details</h1>
                                
                                <div class="link-set">
                                    <a href="category-section.php?market=All%20Marketplace&type=All">setting category </a>
                                    <p>&nbsp;|&nbsp;</p>
                                    <a href="tools-section.php?market=All%20Marketplace"> setting type</a>
                                </div>
                            </div>
                            
                            <div class="content-in-item"> 
                                <div class="marketplace-item">
                                    <?php
                                    if($_GET['type'] == 'All'){
                                    ?>
                                        <a href="?market=All Marketplace&type=All">
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">All</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <a href="?market=All Marketplace&type=All">
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">All</button>
                                        </a>
                                    <?php
                                    }

                                    if($_GET['type'] == 'GR-Brandearth'){
                                    ?>
                                        <a href="?market=All Marketplace&type=GR-Brandearth">
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">GR-Brandearth</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <a href="?market=All Marketplace&type=GR-Brandearth">
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">GR-Brandearth</button>
                                        </a>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($_GET['type'] == 'GR-RRGraph'){
                                    ?>
                                        <a href="?market=All Marketplace&type=GR-RRGraph">
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">GR-RRGraph</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <a href="?market=All Marketplace&type=GR-RRGraph">
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">GR-RRGraph</button>
                                        </a>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($_GET['type'] == 'Templatemonster'){
                                    ?>
                                        <a href="?market=All Marketplace&type=Templatemonster">
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">Templatemonster</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <a href="?market=All Marketplace&type=Templatemonster">
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">Templatemonster</button>
                                        </a>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($_GET['type'] == 'Creativemarket'){
                                    ?>
                                        <a href="?market=All Marketplace&type=Creativemarket">
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">Creativemarket</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <a href="?market=All Marketplace&type=Creativemarket">
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">Creativemarket</button>
                                        </a>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($_GET['type'] == 'RRSlide'){
                                    ?>
                                        <a href="?market=All Marketplace&type=RRSlide">
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">RRSlide</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <a href="?market=All Marketplace&type=RRSlide">
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">RRSlide</button>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                    
                                    <?php
                                    if($_GET['type'] == 'Non-Color'){
                                    ?>
                                        <a href="?market=All Marketplace&type=Non-Color">
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">Non-Color</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <a href="?market=All Marketplace&type=Non-Color">
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">Non-Color</button>
                                        </a>
                                    <?php
                                    }
                                    ?>

<?php
                                    if($_GET['type'] == 'Non-Category'){
                                    ?>
                                        <a href="?market=All Marketplace&type=Non-Category">
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">Non-Category</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <a href="?market=All Marketplace&type=Non-Category">
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">Non-Category</button>
                                        </a>
                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if($_GET['type'] == 'Non-Sub-Category'){
                                    ?>
                                        <a href="?market=All Marketplace&type=Non-Sub-Category">
                                            <button type="button" class="btn btn-primary btn-market-cat-active" name="" id="">Non-Sub-Category</button>
                                        </a>
                                    <?php
                                    }else{
                                    ?>
                                        <a href="?market=All Marketplace&type=Non-Sub-Category">
                                            <button type="button" class="btn btn-primary btn-market-cat" name="" id="">Non-Sub-Category</button>
                                        </a>
                                    <?php
                                    }
                                    ?>
                                </div>

                                <!-- <div class="select-in-item">
                                    <select class="select-upd-all" name="" id="select_count"  >
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="All">All</option>
                                    </select>
                                </div> -->
                            </div>

                            <div class="tb-item-update mt-5" id="employee_table">
                                <!-- <form method="POST" action="process/input-all-change.php" style="width: 100%;"> -->
                                <!-- <form method="POST" action="setting-category.php" style="width: 100%;"> -->
                                    <table class="table-market-item table" id="tbl-list">
                                        <thead>
                                            <tr class="title-table">
                                                <th scope="col">Items Name</th>
                                                <th scope="col">Color</th>
                                                <th scope="col">Category</th>
                                                <th scope="col">Sub</th>
                                                <th scope="col">Type</th>
                                                <th scope="col" style="width: 200px;">
                                                    <button class="btn-edit" onclick="edit_data()">
                                                        Bulk Edit
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody id="table-items">

                                        <?php
                                        include '../../../src/connection/connection.php';
                                        $market_sup = array("All Marketplace" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5");
                                      
                                        if($_GET['type'] == 'All'){
                                            $sql_market = mysqli_query($connect, "SELECT * FROM tb_catalog GROUP BY SUBSTR(name, 1, 7) ASC");
                                        }elseif($_GET['type'] == 'Non-Color'){
                                            $type = $_GET['type'];
                                            $sql_market = mysqli_query($connect, "SELECT * FROM tb_catalog WHERE color='' GROUP BY SUBSTR(name, 1, 7) ASC");
                                        }elseif($_GET['type'] == 'Non-Category'){
                                            $type = $_GET['type'];
                                            $sql_market = mysqli_query($connect, "SELECT * FROM tb_catalog WHERE category='' GROUP BY SUBSTR(name, 1, 7) ASC");
                                        }elseif($_GET['type'] == 'Non-Sub-Category'){
                                            $type = $_GET['type'];
                                            $sql_market = mysqli_query($connect, "SELECT * FROM tb_catalog WHERE sub_category='' GROUP BY SUBSTR(name, 1, 7) ASC");
                                        }else{
                                            $type = $market_sup[$_GET['type']];
                                            $sql_market = mysqli_query($connect, "SELECT * FROM tb_catalog WHERE market_id='$type' GROUP BY SUBSTR(name, 1, 7) ASC");
                                        }
                                        while($row = mysqli_fetch_array($sql_market))
                                        {
                                        ?>
                                            <tr class="sub-title-table">
                                                <td><?=$row['name']?></td>
                                                <td>
                                                    <input type="hidden" name="id[]" id="id" value="<?=$row['item_id']?>">
                                                    <input type="hidden" name="name[]" id="name" value="<?=$row['name']?>">
                                                    <select name="color[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
                                                    <?php
                                                    include '../../../src/connection/connection.php';
                                                    $sql_color = mysqli_query($connect, "SELECT * FROM tb_color");
                                                    while($data = mysqli_fetch_array($sql_color)){
                                                    ?>
                                                        <option style="background-color: <?=$data['code_color']?>; color: <?=$data['code_color']?>;" value="<?=$data['code_color']?>"><?=$data['code_color']?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                        <option selected value="<?=$row['color']?>"><?=$row['color']?></option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="category[]" id="category" class="form-control cates" style="height: 30px; font-size: 10px; font-weight: bold;">
                                                    <?php
                                                    $sql_category = mysqli_query($connect, "SELECT * FROM tb_category");
                                                    while($data = mysqli_fetch_array($sql_category)){
                                                    ?>
                                                        <option value="<?=$data['category_id']?>"><?=$data['name']?></option>
                                                    <?php
                                                    }
                                                    $para_category       = $row['category'];

                                                    $query_cat="SELECT category_id FROM tb_category WHERE name='$para_category'";
                                                    $result_cat = mysqli_query($connect, $query_cat);
                                                    while($datas =mysqli_fetch_array($result_cat)) {
                                                    ?>
                                                        <option selected value="<?=$datas['category_id']?>"><?=$para_category?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="sub_category[]" id="sub_category" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control subcategory">
                                                    <?php
                                                    $sql_sub_category = mysqli_query($connect, "SELECT * FROM tb_sub_category");
                                                    while($data = mysqli_fetch_array($sql_sub_category)){
                                                    ?>
                                                        <option value="<?=$data['name']?>"><?=$data['name']?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                        <option selected value="<?=$row['sub_category']?>"><?=$row['sub_category']?></option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="type[]" id="type" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
                                                    <?php
                                                    $sql_type = mysqli_query($connect, "SELECT * FROM tb_section");
                                                    while($data = mysqli_fetch_array($sql_type)){
                                                    ?>
                                                        <option value="<?=$data['name']?>"><?=$data['name']?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                        <option selected value="<?=$row['slug']?>"><?=$row['slug']?></option>
                                                    </select>
                                                </td>
                                                <td>
                                                </td>
                                            </tr> 
                                        <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>

                    <a class="back" href="item-update.php?type=All&market=All%20Marketplace">
                        Edit Unit Item
                    </a>

                </div>
            </div>
        </main>
    </div>
    <script>
        let category = document.getElementsByClassName("cates");
        for(let i=0; i <= category.length; i++) {
            category[i].addEventListener("change", function(e) {
                let sub = document.getElementsByClassName("subcategory")[i];

                let form  = new FormData();
                form.append("id", category[i].value);

                    fetchAPI('process/fetch_subcategory.php', form , function(data){
                    let subcategory = `<option value="">-- Choose --</option>`;
                    for(let y=0; y<data.data.length; y++) {
                        subcategory += `<option value="${data.data[y].name}">${data.data[y].name}</option>`;
                    } 
    
                    sub.innerHTML = "";
                    sub.innerHTML += subcategory;
                });
            });
        }

        function fetchAPI(url, data, callback) {
            fetch(url, {
                method: 'POST',
                body: data,
            }).then((response) => {
                if(response.status == 200) {
                    return response.json();
                }
            }).then((res) => {
                return callback(res)
            }).catch((err) => {
                console.error(err)
            });
        }
    
    </script>
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
    <script src="../../../src/DataTables/datatables.min.js"></script>
    <script src="js/set-category.js"></script> 
</body>
</html>

