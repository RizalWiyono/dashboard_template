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
    <title>RrGraph - Category Analyze</title> 
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
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../../../src/css/bootstrap.min.css">
	<link rel="stylesheet" href="../../../src/css/sweetalert2.min.css">
	<link rel="stylesheet" href="../../../src/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../../src/css/animate.min.css">

    <script src="https://code.jquery.com/jquery-1.12.4.js"></script> 
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

</head>
<body >

<div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-1 col-lg-1 d-md-block bg-black sidebar collapse" align="center">
                    <ul class="nav flex-column distance-side">
                        <li class="nav-item">
                            <a href="../../../../Dashboard Fee/material/Dashboard/index.php">
                                <img src="../../../src/image/LOGO-1.svg"/>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav flex-column distance-side-rr-top" >
                        <li class="nav-item">
                            <a class="place-left-sect sect-active" href="../../all marketplace/all-marketplace.php?market=All Marketplace" data-toggle="tooltip" data-placement="right" title="All Marketplace" id="tool-market">
                                <img class="logo-rr" src="../../../src/image/MARKETPLACE.svg"/>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav flex-column distance-side-rr">
                        <li class="nav-item">
                            <a class="place-left-sect" href="#" data-toggle="tooltip" data-placement="right" title="Freebies" id="tool-freebies">
                                <img class="logo-rr" src="../../../src/image/FREEBIES.svg"/>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav flex-column distance-side-rr">
                        <li class="nav-item">
                            <a class="place-left-sect" href="#" data-toggle="tooltip" data-placement="right" title="News Letter" id="tool-newsletter">
                                <img class="logo-rr" src="../../../src/image/NEWSLETTER.svg"/>
                            </a>
                        </li>
                    </ul>

                    <ul class="nav flex-column distance-side-rr">
                        <li class="nav-item">
                            <a class="place-left-sect" href="#" data-toggle="tooltip" data-placement="right" title="Team" id="tool-team">
                                <img class="logo-rr" src="../../../src/image/TEAM.svg"/>
                            </a>
                        </li>
                    </ul>
                    
                    <ul class="nav flex-column side-bot">
                        <li class="nav-item">
                            <a class="place-left-bot" href="../upload/upload.php" data-toggle="tooltip" data-placement="right" title="Syncronize" id="tool-sync">
                                <img class="logo-rr-sync" src="../../../src/image/SYNC-RED.svg"/>
                            </a>
                        </li>
                    </ul>
                    
            </nav>

            <main role="main" class="col-md-10 ml-sm-auto col-lg-11 px-md-5 distance-main">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-5 ">
                    <h1 class="sub-title">Hi <?=$_SESSION['username']?>
                        <p class="sub-title-bc">, Welcome Back!</p>
                    </h1>
                </div>

                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center border-bottom border-dark">
                    <h1 class="title">Category Section</h1>
                </div>

                    <div class="col-md-12">
                        <div class="row">

                            <div class="col-md-12 mt-5">
                                <div class="row">
                                    <h1 class="title-cs">Category</h1>

                                    <div class="shape-place-cs" align='center'>
                                        <div class="col-md-12 mt-5" align='left'>
                                            <button type="button" class="btn btn-primary btn-market-cat" id="btn_all_market" value="All">
                                                All
                                            </button>

                                            <button type="button" class="btn btn-primary btn-market-cat" id="btn_all_market" value="All">
                                                Powerpoint
                                            </button>

                                            <button type="button" class="btn btn-primary btn-market-cat" id="btn_all_market" value="All">
                                                Keynote
                                            </button>

                                            <button type="button" class="btn btn-primary btn-market-cat" id="btn_all_market" value="All">
                                                Google Slides
                                            </button>

                                            <button type="button" class="btn btn-primary btn-market-cat" id="btn_all_market" value="All">
                                                Potrait
                                            </button>

                                            <button type="button" class="btn btn-primary btn-market-cat" id="btn_all_market" value="All">
                                                Etc
                                            </button>
                                        </div>

                                        <table class="table-category table table-striped mr-4">
                                            <thead>
                                                <tr class="title-table">
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Sub</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody id="table-market">
                                                <tr class="sub-title-table">
                                                    <td>asas</td>
                                                    <td>as</td>
                                                    <td>as</td>
                                                </tr> 
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

            </main>
        </div>
    </div>

    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
    <script type="text/javascript" src="../../../src/js/jquery.idle.min.js"></script>
    <script src="js/main.js"></script> 
    <script src="js/content.js"></script> 

</body>
</html>

