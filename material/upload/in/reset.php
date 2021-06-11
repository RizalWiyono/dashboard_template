<?php
session_start();
if(!isset($_SESSION['username']) ) {
    header('location: ../../login/login.php');
    exit;
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>RrGraph - Upload CSV</title> 
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../../src/image/Group 38.png">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;600&display=swap" rel="stylesheet"> 
    
    <!-- View -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Stylesheet -->
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.css">

    <link rel="stylesheet" href="../../../src/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../../src/css/sweetalert2.min.css">
	<link rel="stylesheet" href="../../../src/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../src/css/animate.min.css">
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    

    <!--[if lt IE 9]> <script src="
    http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script> <![endif]-->
</head>

<body>


    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-black sidebar collapse">
                    <ul class="nav flex-column distance-side">
                        <li class="nav-item">
                            <img class="logo" src="../../../src/image/logo.png"/>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white fs-side" href="../../all marketplace/all-marketplace.php">
                                All Marketplace
                            </a>
                        </li>
                    </ul>

                    <h1 class="distance-side-cat sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted ">
                    <span>Category</span>
                    </h1>

                    <ul class="nav flex-column distance-side">
                        <li class="nav-item">
                            <div class="line-top"></div>
                            <a class="nav-link text-white fs-side" href="../../brandearth/gr-brandearth.php">
                                GR - Brandearth
                                <img class="img-right" src="../../../src/image/right-sign.png"></img>
                            </a>
                        </li>

                        <li class="nav-item">
                            <div class="line-bot"></div>
                            <a class="nav-link text-white fs-side" href="../../rrgraph/gr-rrgraph.php">
                                GR - RRGraph
                                <img class="img-right" src="../../../src/image/right-sign.png"></img>
                            </a>
                        </li>

                        <li class="nav-item">
                            <div class="line-bot"></div>
                            <a class="nav-link text-white fs-side" href="../../templatemonster/templatemonster.php">
                                Templatemonster
                                <img class="img-right" src="../../../src/image/right-sign.png"></img>
                            </a>
                        </li>

                        <li class="nav-item">
                            <div class="line-bot"></div>
                            <a class="nav-link text-white fs-side" href="../../creativemarket/creativemarket.php">
                                Creativemarket
                                <img class="img-right" src="../../../src/image/right-sign.png"></img>
                            </a>
                        </li>

                        <li class="nav-item">
                            <div class="line-bot"></div>
                            <a class="nav-link text-white fs-side" href="../../rrslides/rrslides.php">
                                RRSlides
                                <img class="img-right" src="../../../src/image/right-sign.png"></img>
                            </a>
                        </li>

                        <li class="nav-item">
                            <div class="line-bot"></div>
                            <a class="nav-link text-white fs-side" href="../../freebies/freebies.php">
                                Freebies
                                <img class="img-right" src="../../../src/image/right-sign.png"></img>
                            </a>
                            <div class="line-bot"></div>
                        </li>
                    </ul>

                    <h1 class="distance-side-cat sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted ">
                    <span>Details</span>
                    </h1>

                    <ul class="nav flex-column distance-side">
                        <li class="nav-item">
                            <div class="line-top"></div>
                            <a class="nav-link text-white fs-side" href="../../table report/table-report.php">
                                Table Reports
                                <img class="img-right" src="../../../src/image/right-sign.png"></img>
                            </a>
                            <div class="line-bot"></div>
                        </li>
                        <li class="nav-item">
                            <div class="line-bot"></div>
                            <a class="nav-link text-white fs-side" href="../../search/search-template.php">
                                Search Template
                                <img class="img-right" src="../../../src/image/right-sign.png"></img>
                            </a>
                            <div class="line-bot"></div>
                        </li>
                    </ul>

                    <ul class="nav flex-column side-bot">
                        <li class="nav-item  active">
                            <a class="nav-link text-white fs-side-bot " href="../../upload/upload.php">
                                <img class="img-upload" src="../../../src//image/upload.png"></img>    
                                Upload CSV
                                <img class="img-right" src="../../../src/image/right-sign.png"></img>
                            </a>
                        </li>
                    </ul>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-5">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 ">
                    <h1 class="title">Reset CSV File</h1>
                </div>

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom border-dark">
                    <p class="sub-title">All Marketplace</p>
                </div>

                <div class="col-md-12 mt-5">
                    <div class="row">
                        <table class="table-market table table-striped mr-4">
                            <thead>
                                <tr class="title-table">
                                    <th scope="col">Tables</th>
                                    <th scope="col">Last Update</th>
                                    <th scope="col">Action</th>

                                </tr>
                            </thead>

                            <tbody id="table-market">
                            
                                <?php
                                    $name_market = array("BrandEarth" => "GR - Brandearth", "RRGraph" => "GR - RRGraph", "TemplateMonster" => "Templatemonster", "CreativeMarket" => "Creativemarket", "RRSlides" => "RRSlides");
                                    $market = array("BrandEarth" => "Upload File - GR-BE", "RRGraph" => "Upload File - GR-RRG", "TemplateMonster" => "Upload File - TM", "CreativeMarket" => "Upload File - CM", "RRSlides" => "Upload File - RRS");
                                    
                                    include '../../../src/connection/connection.php';
                                    $query="SELECT * FROM tb_market";
                                    $result = mysqli_query($connect, $query);
                                    while($row =mysqli_fetch_array($result)) {

                                ?>

                            <tr class="sub-title-table">
                                <td id="name-<?=$row['id']?>" scope="row"><?=$name_market[$row['name_market']]?></td>
                                <?php
                                
                                $detail = $market[$row['name_market']];

                                $query_ma="SELECT * FROM tb_activity WHERE activity LIKE '%$detail%' ORDER BY date DESC, hours DESC LIMIT 1";
                                $result_ma = mysqli_query($connect, $query_ma);
                                while($data =mysqli_fetch_array($result_ma)) {
                                ?>
                                <td><?=$data['date']?></td>
                                <?php
                                }
                                ?>
                                <td>
                                    <a href="reset.php?id=<?=$row['id']?>" style="color: red;">
                                        Delete by Range Time &ensp;
                                    </a>|
                                    <a style="cursor: pointer;" id="reset-<?=$row['id']?>">
                                    &ensp; Reset All
                                    </a>
                                </td>
                            </tr> 

                                <?php
                                error_reporting(0);
                                if($row['id'] == $_GET['id']){
                                ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <form name="Form1" method="POST" action="process/delete.php">
                                        <input type="text" name="id" value="<?=$_GET['id']?>" style="display: none;">
                                        <select name="year" class="year select-control" id="year">
                                        <option value="">Select Year</option>
                                            <?php
                                            $get = $_GET['id'];
                                            $query_sel="SELECT year FROM tb_sales WHERE market_id='$get' GROUP BY year DESC";
                                            $result_sel = mysqli_query($connect, $query_sel);
                                            while($data_sel =mysqli_fetch_array($result_sel)) {
                                            ?>
                                                    <option value="<?=$data_sel['year']?>"><?=$data_sel['year']?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>

                                        <select name="month" id="month" class="select-control">
                                        <option value="">Select Month</option>

                                        <?php
                                        $bulan = [
                                            "January", 
                                            "February", 
                                            "March", 
                                            "April", 
                                            "May", 
                                            "June", 
                                            "July", 
                                            "August", 
                                            "September", 
                                            "October",
                                            "November", 
                                            "December"
                                        ];
                                        $now_year = date('Y');

                                        include('../../../src/connection/connection.php');
                                        $get = $_GET['id'];
                                        $query_month = "SELECT month FROM tb_sales WHERE market_id='$get' && year='$now_year' GROUP BY month ASC";
                                        $result_month = mysqli_query($connect, $query_month);
                                        
                                        while($data_month =mysqli_fetch_array($result_month)) 

                                        {
                                        ?>
                                            <option value="<?=$data_month['month']?>"><?=$bulan[$data_month['month'] - 1]?></option>
                                        <?php
                                        }
                                        ?>

                                </select>

                                    <input class="btn-sbmt btn btn-danger" type="submit" id="" value="Reset">
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
                                <td scope="row">Freebies</td>
                                <?php
                                
                                $query_ma="SELECT * FROM tb_activity WHERE activity LIKE '%Upload File - FrB%' ORDER BY date DESC, hours DESC LIMIT 1";
                                $result_ma = mysqli_query($connect, $query_ma);
                                while($row =mysqli_fetch_array($result_ma)) {
                                ?>
                                <td><?=$row['date']?></td>
                                <?php
                                }
                                ?>
                                <td>
                                    <a href="reset.php?id=6" style="color: red;">
                                        Delete by Range Time &ensp;
                                    </a>|
                                    <a style="cursor: pointer;" id="reset-6">
                                    &ensp;    Reset All
                                    </a>
                                </td>
                            </tr>

                            <?php
                            if(6 == $_GET['id']){
                            ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <select name="year" class="year select-control" id="year">
                                        <option value="">Select Year</option>
                                        <option value="">Select Year</option>
                                        <option value="">Select Year</option>
                                        <option value="">Select Year</option>
                                    </select>

                                    <select name="year" class="year select-control" id="year">
                                        <option value="">Select Year</option>
                                        <option value="">Select Year</option>
                                        <option value="">Select Year</option>
                                        <option value="">Select Year</option>
                                    </select>

                                    <button class="reset-btn" id="filter-btn">FILTER</button>

                                </td>
                            </tr>

                            <?php
                            }
                            ?>
                            </tbody>
                        </table>

                        
                        <p id="username" style="display: none;"><?=$_SESSION['password'];?></p>

                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="js/main.js"></script>
    <script src="../../../src/js/jquery.min.js"></script>
    <script src="../../../src/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="../../../src/js/jquery.idle.min.js"></script>

    <script type="text/javascript">
    $(document).idle({
        onIdle: function(){
            window.location="../../login/logout.php";                
        },
        idle: 86400000
    });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/min/dropzone.min.js"></script>

    <script src="../../../src/js/select.js"></script> 
    <script src="../js/alert.js"></script> 
</html>
