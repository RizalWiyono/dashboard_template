<?php

ini_set("max_execution_time",0);
session_start();

    // Code Brandearth
    function BrandEarth($market) 
    { 
        include '../../../src/connection/connection.php';
        if(isset($_POST["submit"]))
        {
            if($_FILES['file']['name'])
            {
                $filename = explode(".", $_FILES['file']['name']);
                if($filename[1] == 'csv')
                {

                    $user = $_SESSION['email'];
                    date_default_timezone_set('Asia/Jakarta');
                    $date_ac= date("d M Y");
                    $hour= date("H:i:s", strtotime('now +24 hours'));

                    $query = "INSERT INTO tb_activity_template (activity_id, username, activity, date, hours) 
                                values 
                                (null, '$user', 'Upload File - GR-BE','$date_ac','$hour')";
                                mysqli_query($connect, $query);

                    $handle = fopen($_FILES['file']['tmp_name'], "r");
                    while($data = fgetcsv($handle))
                    {
                        $date                   = mysqli_real_escape_string($connect, $data[0]);  
                        $order_id               = mysqli_real_escape_string($connect, $data[1]);
                        $status                 = mysqli_real_escape_string($connect, $data[2]);
                        $item_id                = mysqli_real_escape_string($connect, $data[4]);  
                        $extra                  = mysqli_real_escape_string($connect, $data[5]);  
                        $name                   = mysqli_real_escape_string($connect, $data[3]);  
                        $earnings               = mysqli_real_escape_string($connect, $data[6]);
                        $other_party_country    = mysqli_real_escape_string($connect, $data[14]);

                        $sub_sentence_date      = substr($date, 0, 10);

                        $sentence               = $date;
                        $sub_sentence           = substr($sentence, 5, 2);

                        $substance_year         = substr($date, 0, 4);

                        $sentence_day           = $date;
                        $sub_sentence_day       = substr($sentence_day, 8, 2);

                        if($status !== 'Author Fee'){
                            $query = "INSERT INTO tb_catalog (catalog_id , item_id, market_id, upload_on, category, sub_category, color, slug, name) 
                            values 
                            ( NULL, $item_id, '$market', '$sub_sentence_date', '', '', '', '','$name')";
                            $insert = mysqli_query($connect, $query);
                        }

                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'PowerPoint' WHERE name LIKE '%powerpoint%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Keynote' WHERE name LIKE '%keynote%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Potrait' WHERE name LIKE '%potrait%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Google Slide' WHERE name LIKE '%google slide%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Etc' WHERE slug=''");

                        if($status == 'Sale') {
                            $sql_check = mysqli_query($connect, "SELECT * FROM tb_sales WHERE market_id=1 && extra='$extra'");
                            if(mysqli_num_rows($sql_check) < 1) {
                                $query = "INSERT INTO tb_sales (sales_id, market_id, item_id, order_id, year, month, day, date, status, earnings, country, extra) 
                                    values 
                                    ( NULL, $market, '$item_id', '$order_id', '$substance_year', '$sub_sentence', '$sub_sentence_day','$sub_sentence_date','$status','$earnings','$other_party_country', '$extra')";
                                $insert = mysqli_query($connect, $query);
                                    if(!$insert){
                                        echo "Error . " . mysqli_error($connect) . "</br>";
                                    }
                            }
                        }

                        if($status == 'Author Fee Reversal'){
                            $reversal = strstr("$name","IVI");
                            mysqli_query($connect, "DELETE FROM `tb_sales` WHERE market_id=1 && extra='$reversal' && item_id='$item_id'");
                        }
                        
                    }
                }

                $filename = explode(".", $_FILES['file']['name']);
                if($filename[1] == 'csv')
                {


                    $handle = fopen($_FILES['file']['tmp_name'], "r");
                    while($data = fgetcsv($handle))
                    {
                        $date                   = mysqli_real_escape_string($connect, $data[0]);  
                        $order_id               = mysqli_real_escape_string($connect, $data[1]);
                        $status                 = mysqli_real_escape_string($connect, $data[2]);
                        $item_id                = mysqli_real_escape_string($connect, $data[4]);  
                        $extra                  = mysqli_real_escape_string($connect, $data[5]);  
                        $name                   = mysqli_real_escape_string($connect, $data[3]);  
                        $earnings               = mysqli_real_escape_string($connect, $data[6]);
                        $other_party_country    = mysqli_real_escape_string($connect, $data[14]);

                        $sub_sentence_date      = substr($date, 0, 10);

                        $sentence               = $date;
                        $sub_sentence           = substr($sentence, 5, 2);

                        $substance_year         = substr($date, 0, 4);

                        $sentence_day           = $date;
                        $sub_sentence_day       = substr($sentence_day, 8, 2);


                        if($status == 'Author Fee Reversal'){
                            $reversal = strstr("$name","IVI");
                            mysqli_query($connect, "DELETE FROM `tb_sales` WHERE market_id=1 && extra='$reversal'");
                        }
                        

                    }
                }
            }
        }
    }

    // Code RRGraph
    function RRGraph($market) 
    { 
        include '../../../src/connection/connection.php';
        if(isset($_POST["submit"]))
        {
            if($_FILES['file']['name'])
            {
                $filename = explode(".", $_FILES['file']['name']);
                if($filename[1] == 'csv')
                {

                    $user = $_SESSION['email'];
                    date_default_timezone_set('Asia/Jakarta');
                    $date_ac= date("d M Y");
                    $hour= date("H:i:s", strtotime('now +24 hours'));

                    $query = "INSERT INTO tb_activity_template (activity_id, username, activity, date, hours) 
                                values 
                                (null, '$user', 'Upload File - GR-RRG','$date_ac','$hour')";
                                mysqli_query($connect, $query);

                    $handle = fopen($_FILES['file']['tmp_name'], "r");
                    while($data = fgetcsv($handle))
                    {
                        $date                   = mysqli_real_escape_string($connect, $data[0]);  
                        $order_id               = mysqli_real_escape_string($connect, $data[1]);
                        $status                 = mysqli_real_escape_string($connect, $data[2]);
                        $item_id                = mysqli_real_escape_string($connect, $data[4]);  
                        $extra                  = mysqli_real_escape_string($connect, $data[5]);  
                        $name                   = mysqli_real_escape_string($connect, $data[3]);  
                        $earnings               = mysqli_real_escape_string($connect, $data[6]);
                        $other_party_country    = mysqli_real_escape_string($connect, $data[14]);

                        $sub_sentence_date      = substr($date, 0, 10);

                        $sentence               = $date;
                        $sub_sentence           = substr($sentence, 5, 2);

                        $substance_year         = substr($date, 0, 4);

                        $sentence_day           = $date;
                        $sub_sentence_day       = substr($sentence_day, 8, 2);

                        if($status !== 'Author Fee'){
                            $query = "INSERT INTO tb_catalog (catalog_id , item_id, market_id, upload_on, category, sub_category, color, slug, name) 
                            values 
                            ( NULL, $item_id, '$market', '$sub_sentence_date', '', '', '', '','$name')";
                            $insert = mysqli_query($connect, $query);
                        }

                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'PowerPoint' WHERE name LIKE '%powerpoint%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Keynote' WHERE name LIKE '%keynote%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Potrait' WHERE name LIKE '%potrait%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Google Slide' WHERE name LIKE '%google slide%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Etc' WHERE name LIKE '%bundle%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Etc' WHERE slug=''");

                        if($status == 'Sale') {
                            $sql_check = mysqli_query($connect, "SELECT * FROM tb_sales WHERE market_id=2 && extra='$extra'");
                            if(mysqli_num_rows($sql_check) < 1) {
                                $query = "INSERT INTO tb_sales (sales_id, market_id, item_id, order_id, year, month, day, date, status, earnings, country, extra) 
                                    values 
                                    ( NULL, $market, '$item_id', '$order_id', '$substance_year', '$sub_sentence', '$sub_sentence_day','$sub_sentence_date','$status','$earnings','$other_party_country', '$extra')";
                                $insert = mysqli_query($connect, $query);
                                    if(!$insert){
                                        echo "Error . " . mysqli_error($connect) . "</br>";
                                    }
                            }
                        }

                        if($status == 'Author Fee Reversal'){
                            $reversal = strstr("$name","IVI");
                            mysqli_query($connect, "DELETE FROM `tb_sales` WHERE market_id=2 && extra='$reversal' && item_id='$item_id'");
                        }
                        
                    }
                }

                $filename = explode(".", $_FILES['file']['name']);
                if($filename[1] == 'csv')
                {


                    $handle = fopen($_FILES['file']['tmp_name'], "r");
                    while($data = fgetcsv($handle))
                    {
                        $date                   = mysqli_real_escape_string($connect, $data[0]);  
                        $order_id               = mysqli_real_escape_string($connect, $data[1]);
                        $status                 = mysqli_real_escape_string($connect, $data[2]);
                        $item_id                = mysqli_real_escape_string($connect, $data[4]);  
                        $extra                  = mysqli_real_escape_string($connect, $data[5]);  
                        $name                   = mysqli_real_escape_string($connect, $data[3]);  
                        $earnings               = mysqli_real_escape_string($connect, $data[6]);
                        $other_party_country    = mysqli_real_escape_string($connect, $data[14]);

                        $sub_sentence_date      = substr($date, 0, 10);

                        $sentence               = $date;
                        $sub_sentence           = substr($sentence, 5, 2);

                        $substance_year         = substr($date, 0, 4);

                        $sentence_day           = $date;
                        $sub_sentence_day       = substr($sentence_day, 8, 2);


                        if($status == 'Author Fee Reversal'){
                            $reversal = strstr("$name","IVI");
                            mysqli_query($connect, "DELETE FROM `tb_sales` WHERE market_id=2 && extra='$reversal'");
                        }
                        

                    }
                }
            }
        }
    }

    // Code Template Monster
    function TemplateMonster($market) 
    { 
        
        include '../../../src/connection/connection.php';
        if(isset($_POST["submit"]))
        {
            if($_FILES['file']['name'])
            {
                $filename = explode(".", $_FILES['file']['name']);
                if($filename[1] == 'csv')
                {
                    $user = $_SESSION['email'];
                    date_default_timezone_set('Asia/Jakarta');
                    $date_ac= date("d M Y");
                    $hour= date("H:i:s", strtotime('now +24 hours'));

                    $query = "INSERT INTO tb_activity_template (activity_id, username, activity, date, hours) 
                                values 
                                (null, '$user', 'Upload File - TM','$date_ac','$hour')";
                                mysqli_query($connect, $query);

                    $handle = fopen($_FILES['file']['tmp_name'], "r");
                    while($data = fgetcsv($handle))
                    {
                        $date                   = mysqli_real_escape_string($connect, $data[4]);  
                        $order_id               = mysqli_real_escape_string($connect, $data[0]);
                        $status                 = mysqli_real_escape_string($connect, $data[3]);
                        $name                   = mysqli_real_escape_string($connect, $data[8]);
                        $item_id                = mysqli_real_escape_string($connect, $data[5]);  
                        $earnings               = mysqli_real_escape_string($connect, $data[1]);
                        $other_party_country    = mysqli_real_escape_string($connect, $data[7]);
                        $sentence               = $date;

                        
                        $sub_sentence           = substr($sentence, -2);
                        $subt_sentence          = substr($sentence, -10);
                        $subt_sentences         = substr($date, 0, 2);
                        $subtr_sentence         = substr($sentence, 3, -3);
                        $subtr_sentences        = substr($date, 3, -3);

                        $varyear                = "20";
                        $yeardata               = $varyear . sprintf($sub_sentence);

                        $sub_sentence_date      = $yeardata."-".$subt_sentences."-".$subtr_sentences;

                        error_reporting(0);
                        include 'country.php';
                        $country = $countryList[$other_party_country];

                        if($status !== 'Author Fee'){
                            $sql_catalog = mysqli_query($connect, "SELECT * FROM tb_catalog WHERE market_id=3 && name LIKE '%$name%'");
                            if(mysqli_num_rows($sql_catalog) < 1) {
                                mysqli_query($connect, "INSERT INTO tb_catalog (catalog_id , item_id, market_id, upload_on, category, sub_category, color, slug, name) 
                                values 
                                ( NULL, $item_id, '$market', '$sub_sentence_date', '', '', '', '','$name')");
                            }
                        }

                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'PowerPoint' WHERE name LIKE '%powerpoint%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Keynote' WHERE name LIKE '%keynote%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Potrait' WHERE name LIKE '%portrait%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Google Slide' WHERE name LIKE '%google slide%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Etc' WHERE slug=''");
                    }
                }

                $filename = explode(".", $_FILES['file']['name']);
                if($filename[1] == 'csv')
                {
                    $user = $_SESSION['email'];
                    date_default_timezone_set('Asia/Jakarta');
                    $date_ac= date("d M Y");
                    $hour= date("H:i:s", strtotime('now +24 hours'));

                    $query = "INSERT INTO tb_activity_template (activity_id, username, activity, date, hours) 
                                values 
                                (null, '$user', 'Upload File - TM','$date_ac','$hour')";
                                mysqli_query($connect, $query);

                    $handle = fopen($_FILES['file']['tmp_name'], "r");
                    while($data = fgetcsv($handle))
                    {
                        $date                   = mysqli_real_escape_string($connect, $data[4]);  
                        $order_id               = mysqli_real_escape_string($connect, $data[0]);
                        $status                 = mysqli_real_escape_string($connect, $data[3]);
                        $name                   = mysqli_real_escape_string($connect, $data[8]);
                        $item_id                = mysqli_real_escape_string($connect, $data[5]);  
                        $earnings               = mysqli_real_escape_string($connect, $data[1]);
                        $other_party_country    = mysqli_real_escape_string($connect, $data[7]);
                        $sentence               = $date;

                        
                        $sub_sentence           = substr($sentence, -2);
                        $subt_sentence          = substr($sentence, -10);
                        $subt_sentences         = substr($date, 0, 2);
                        $subtr_sentence         = substr($sentence, 3, -3);
                        $subtr_sentences        = substr($date, 3, -3);
                        $month                  = substr($sentence, 0, 2);

                        $varyear                = "20";
                        $yeardata               = $varyear . sprintf($sub_sentence);

                        $sub_sentence_date      = $yeardata."-".$subt_sentences."-".$subtr_sentences;

                        error_reporting(0);
                        include 'country.php';
                        $country = $countryList[$other_party_country];

                        if($status !== 'Author Fee'){

                            $sql_check = mysqli_query($connect, "SELECT * FROM tb_sales WHERE market_id=3 &&  order_id='$order_id'");
                            if($status == 'sale') {
                                if(mysqli_num_rows($sql_check) < 1) {
                                    $query = "INSERT INTO tb_sales (sales_id, market_id, item_id, order_id, year, month, day, date, status, earnings, country, extra) 
                                    values 
                                    ( NULL, $market, '$item_id', '$order_id', '$yeardata', '$month', '$subtr_sentence','$sub_sentence_date','Sale','$earnings','$country', '')";
                                    $insert = mysqli_query($connect, $query);
                                        if(!$insert){
                                            echo "Error . " . mysqli_error($connect) . "</br>";
                                        }
                                    }
                            }
                        }

                    }
                }
            }
        }
    }

    
    // Code Creative Market
    function CreativeMarket($market) { 
        include '../../../src/connection/connection.php';
        if(isset($_POST["submit"]))
        {
            if($_FILES['file']['name'])
            {
                $filename = explode(".", $_FILES['file']['name']);
                if($filename[1] == 'csv' || $filename[2] == 'csv')
                {
                    $user = $_SESSION['email'];
                    date_default_timezone_set('Asia/Jakarta');
                    $date_ac= date("d M Y");
                    $hour= date("H:i:s", strtotime('now +24 hours'));

                    $query = "INSERT INTO tb_activity_template (activity_id, username, activity, date, hours) 
                                values 
                                (null, '$user', 'Upload File - CM','$date_ac','$hour')";
                                mysqli_query($connect, $query);

                    $handle = fopen($_FILES['file']['tmp_name'], "r");
                    $no = 0;
                    while($data = fgetcsv($handle))
                    {
                        $date                   = mysqli_real_escape_string($connect, $data[0]);  
                        $extra                  = mysqli_real_escape_string($connect, $data[3]);
                        // $item_id                = mysqli_real_escape_string($connect, $data[6]);  
                        $earnings               = mysqli_real_escape_string($connect, $data[5]);
                        // $other_party_country    = mysqli_real_escape_string($connect, $data[7]);
                        $name                   = mysqli_real_escape_string($connect, $data[2]);

                        $sub_sentence_date      = substr($date, 0, 10);

                        $sentence               = $date;
                        $sub_sentence           = substr($sentence, 5, -3);

                        $sentence_day           = $date;
                        $sub_sentence_day       = substr($sentence_day, 8);

                        if($name !== 'Product') {
                            $sql_catalog = mysqli_query($connect, "SELECT * FROM tb_catalog WHERE market_id=4 && name LIKE '%$name%'");
                            if(mysqli_num_rows($sql_catalog) < 1) {
                                $id =  'CM-'.$no;
                                mysqli_query($connect, "INSERT INTO tb_catalog (catalog_id , item_id, market_id, upload_on, category, sub_category, color, slug, name) 
                                values 
                                ( NULL, '$id', '$market', '$sub_sentence_date', '', '', '', '','$name')");
                            }
                        }

                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'PowerPoint' WHERE name LIKE '%powerpoint%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Keynote' WHERE name LIKE '%keynote%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Potrait' WHERE name LIKE '%potrait%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Google Slide' WHERE name LIKE '%google slide%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Etc' WHERE slug=''");

                        $no++;
                    }
                }

                $filename = explode(".", $_FILES['file']['name']);
                if($filename[1] == 'csv' || $filename[2] == 'csv')
                {
                    $handle = fopen($_FILES['file']['tmp_name'], "r");
                    while($data = fgetcsv($handle))
                    {
                        $date                   = mysqli_real_escape_string($connect, $data[0]);  
                        $extra                  = mysqli_real_escape_string($connect, $data[3]);
                        // $item_id                = mysqli_real_escape_string($connect, $data[6]);  
                        $earnings               = mysqli_real_escape_string($connect, $data[5]);
                        // $other_party_country    = mysqli_real_escape_string($connect, $data[7]);
                        $name                   = mysqli_real_escape_string($connect, $data[2]);

                        $sub_sentence_date      = substr($date, 0, 10);

                        $year      = substr($date, 0, 4);

                        $sentence               = $date;
                        $sub_sentence           = substr($sentence, 5, -3);

                        $sentence_day           = $date;
                        $sub_sentence_day       = substr($sentence_day, 8);
                        
            	        include '../../../src/connection/connection.php';

						error_reporting(0);


                        if($name !== 'Product') {
                            $query_upd="SELECT * FROM tb_catalog WHERE market_id=4 && name LIKE '%$name%'";
                            $result_upd = mysqli_query($connect, $query_upd);
                            while($data =mysqli_fetch_array($result_upd)) {
                                $id_item = $data['item_id'];
                            }

                            $sql_check = mysqli_query($connect, "SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE tb_sales.market_id=4 && name='$name' && date='$sub_sentence_date' && extra='$extra'");
                            if(mysqli_num_rows($sql_check) < 1) {

                                $query = "INSERT INTO tb_sales (sales_id, market_id, item_id, order_id, year, month, day, date, status, earnings, country, extra) 
                                values 
                                ( NULL, $market, '$id_item', '0', '$year', '$sub_sentence', '$sub_sentence_day','$sub_sentence_date','Sale','$earnings','', '$extra')";
                                $insert = mysqli_query($connect, $query);
                                    if(!$insert){
                                        echo "Error . " . mysqli_error($connect) . "</br>";
                                    }
                            }
                        }
                        
                    }
                }

            }
        }
    }

    // Code RRSlides
    function RRSlides($market) { 
        include '../../../src/connection/connection.php';
        if(isset($_POST["submit"]))
        {
            if($_FILES['file']['name'])
            {
                $filename = explode(".", $_FILES['file']['name']);
                if($filename[1] == 'csv')
                {
                    $user = $_SESSION['email'];
                    date_default_timezone_set('Asia/Jakarta');
                    $date_ac= date("d M Y");
                    $hour= date("H:i:s", strtotime('now +24 hours'));

                    $query = "INSERT INTO tb_activity_template (activity_id, username, activity, date, hours) 
                                values 
                                (null, '$user', 'Upload File - RRS','$date_ac','$hour')";
                                mysqli_query($connect, $query);

                    $query = "INSERT INTO tb_activity_template (activity_id, username, activity, date, hours) 
                                values 
                                (null, '$user', 'Upload File - FrB','$date_ac','$hour')";
                                mysqli_query($connect, $query);

                    $handle = fopen($_FILES['file']['tmp_name'], "r");
                    while($data = fgetcsv($handle))
                    {
                        $date                   = mysqli_real_escape_string($connect, $data[19]);  
                        $order_id               = mysqli_real_escape_string($connect, $data[0]);
                        $type                   = mysqli_real_escape_string($connect, $data[18]);
                        $name                   = mysqli_real_escape_string($connect, $data[11]);  
                        $earnings               = mysqli_real_escape_string($connect, $data[13]);
                        $country                = mysqli_real_escape_string($connect, $data[25]);
                        $sub_sentence_date      = substr($date, 0, 10);

                        $sub_type               = substr($type, 0, 20);

                        $sentence               = $date;
                        $sub_sentence           = substr($sentence, 5, -3);

                        $sentence_day           = $date;
                        $sub_sentence_day       = substr($sentence_day, 8, -8);

                        if($earnings > 0.00) {
                            $query="SELECT MAX(cast(SUBSTR(item_id, 4) as UNSIGNED )) as maxCode FROM tb_sales WHERE market_id=5";
                            $result = mysqli_query($connect, $query);
                            while($row =mysqli_fetch_array($result)) {
                            $maxCode = $row['maxCode'];
                                if($maxCode == NULL){
                                    $no = 0;
                                    $char = 'RRS';
                                    $no++;
                                    $item_id = $char.$no;
                                }else{
                                    $no = (int) $maxCode;
                                    $char = 'RRS';
                                    $no++;
                                    $item_id = $char.$no;
                                }
                            }
                        }

                        $sql_catalog = mysqli_query($connect, "SELECT * FROM tb_catalog WHERE market_id=5 && name='$name'");
                        if(mysqli_num_rows($sql_catalog) < 1) {
                            if($name !== 'Products (Verbose)' && $earnings > 0.00) {
                                $query = "INSERT INTO tb_catalog (catalog_id , item_id, market_id, upload_on, category, sub_category, color, slug, name) 
                                values 
                                ( NULL, '$item_id', '$market', '$sub_sentence_date', '', '', '', '','$name')";
                                $insert = mysqli_query($connect, $query);
                            }
                        }

                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Presentation' WHERE name LIKE '%presentation%'");
                        mysqli_query($connect, "UPDATE tb_catalog SET slug = 'Infographic' WHERE name LIKE '%infographic%'");

                        if($name !== 'Products (Verbose)' && $earnings > 0.00) {
                            $query_upd="SELECT * FROM tb_catalog WHERE market_id=5";
                            $result_upd = mysqli_query($connect, $query_upd);
                            while($data =mysqli_fetch_array($result_upd)) {
                                $product = $data['name'];
                                $id = $data['item_id'];
                                if($product == $name){
                                    $sql_check = mysqli_query($connect, "SELECT * FROM tb_sales WHERE market_id=5 && order_id='$order_id'");
                                    if(mysqli_num_rows($sql_check) < 1) {
                                        $query = "INSERT INTO tb_sales (sales_id, market_id, item_id, order_id, year, month, day, date, status, earnings, country, extra) 
                                        values 
                                        ( NULL, $market, '$id', '$order_id', '$date', '$sub_sentence', '$sub_sentence_day','$sub_sentence_date','Sale','$earnings','', '')";
                                        $insert = mysqli_query($connect, $query);
                                        if(!$insert){
                                            echo "Error . " . mysqli_error($connect) . "</br>";
                                        }
                                    }
                                }
                            }
                        }

                        if($earnings == 0.00) {
                            $query="SELECT MAX(cast(SUBSTR(item_id, 4) as UNSIGNED )) as maxCode FROM tb_catalog_fb WHERE market_id=5";
                            $result = mysqli_query($connect, $query);
                            while($row =mysqli_fetch_array($result)) {
                            $maxCode = $row['maxCode'];
                                if($maxCode == NULL){
                                    $no = 0;
                                    $char = 'FrB';
                                    $no++;
                                    $item_idd = $char.$no;
                                }else{
                                    $no = (int) $maxCode;
                                    $char = 'FrB';
                                    $no++;
                                    $item_idd = $char.$no;
                                }
                            }
                        }

                        if($name !== 'Products (Verbose)' && $earnings == 0.00) {
                        $sql_catalog_fb = mysqli_query($connect, "SELECT * FROM tb_catalog_fb WHERE market_id=5 && name='$name'");
                        if(mysqli_num_rows($sql_catalog_fb) < 1) {
                            $query = "INSERT INTO tb_catalog_fb (catalogfb_id , item_id, market_id, upload_on, category, sub_category, color, slug, name) 
                            values 
                            ( NULL, '$item_idd', '$market', '$sub_sentence_date', '', '', '', '','$name')";
                            $insert = mysqli_query($connect, $query);
                                if(!$insert){
                                    echo "Error . " . mysqli_error($connect) . "</br>";
                                }
                            }
                        }

                        mysqli_query($connect, "UPDATE tb_catalog_fb SET slug = 'Presentation' WHERE name LIKE '%presentation%'");
                        mysqli_query($connect, "UPDATE tb_catalog_fb SET slug = 'Infographic' WHERE name LIKE '%infographic%'");

                        if($name !== 'Products (Verbose)' && $earnings == 0.00) {
                            $query_upd="SELECT * FROM tb_catalog_fb WHERE market_id=5";
                            $result_upd = mysqli_query($connect, $query_upd);
                            while($data =mysqli_fetch_array($result_upd)) {
                                $product = $data['name'];
                                $id = $data['item_id'];
                                if($product == $name){
                                    $sql_check = mysqli_query($connect, "SELECT * FROM tb_freebies WHERE market_id=5 && order_id='$order_id'");
                                    if(mysqli_num_rows($sql_check) < 1) {
                                        $query = "INSERT INTO tb_freebies (freebies_id, market_id, item_id, order_id, year, month, day, date, status, earnings, country, extra) 
                                        values 
                                        ( NULL, $market, '$id', '$order_id', '$date', '$sub_sentence', '$sub_sentence_day','$sub_sentence_date','Sale','$earnings','', '')";
                                        $insert = mysqli_query($connect, $query);
                                        if(!$insert){
                                            echo "Error . " . mysqli_error($connect) . "</br>";
                                        }
                                    }
                                }
                            }
                        }


                        // $sql_check = mysqli_query($connect, "SELECT * FROM tb_sales WHERE market_id=5 && type='$sub_type'");
                        // if($earnings > 0.00 && $other_party_country != 'Country Name') {
                        //     if(mysqli_num_rows($sql_check) < 1) {
                        //         $query = "INSERT INTO tb_sales (id, market_id, year, month, day, date, order_id, type, detail, item_id, earnings, other_party_country, color1, color2) 
                        //             values 
                        //             ( null, $market, '$date', '$sub_sentence', '$sub_sentence_day', '$date', '$order_id','$sub_type', '$detail','','$earnings','$other_party_country', '-', '-')";
                        //         $insert = mysqli_query($connect, $query);
                        //             if(!$insert){
                        //                 echo "Error . " . mysqli_error($connect) . "</br>";
                        //             }

                        //         $query = "INSERT INTO tb_type (market_id, date, type, detail) 
                        //             values 
                        //             ($market, '$date', '$type','$detail')";
                        //         mysqli_query($connect, $query);

                        //         $query = "UPDATE tb_sales SET detail = REPLACE(detail, '(Regular License)', '')";
                        //         mysqli_query($connect, $query);

                        //         $query = "UPDATE tb_type SET detail = REPLACE(detail, '(Regular License)', '')";
                        //         mysqli_query($connect, $query);
                        //     }
                        // }
                        // $sql_check_free = mysqli_query($connect, "SELECT * FROM tb_freebies WHERE market_id=5 && type='$sub_type'");
                        // if($earnings == 0.00 && $other_party_country != 'Country Name') {
                        //     if(mysqli_num_rows($sql_check_free) < 1) {
                        //         $query = "INSERT INTO tb_freebies (id, market_id, year, month, day, date, order_id, type, detail, item_id, earnings, other_party_country, color1, color2) 
                        //             values 
                        //             ( null, $market, '$date', '$sub_sentence', '$sub_sentence_day', '$date', '$order_id','$sub_type', '$detail','','$earnings','$other_party_country', '-', '-')";
                        //         $insert = mysqli_query($connect, $query);
                        //             if(!$insert){
                        //                 echo "Error . " . mysqli_error($connect) . "</br>";
                        //             }
            
                        //         $query = "INSERT INTO tb_sub_freebies (market_id, date, type, detail) 
                        //             values 
                        //             ($market, '$date', '$type','$detail')";
                        //         mysqli_query($connect, $query);

                        //         $query = "UPDATE tb_freebies SET detail = REPLACE(detail, '(Regular License)', '')";
                        //         mysqli_query($connect, $query);

                        //         $query = "UPDATE tb_sub_freebies SET detail = REPLACE(detail, '(Regular License)', '')";
                        //         mysqli_query($connect, $query);
                        //     }
                        // }

                    }
                }
            }
        }
    }
    
    if(isset($_POST['submit']))
    {
        $AlgoType = $_POST['market'];

        if ($AlgoType == 1) {
            BrandEarth($AlgoType);
        }
        elseif ($AlgoType == 2) {
            RRGraph($AlgoType);
        }
        elseif ($AlgoType == 3) {
            TemplateMonster($AlgoType);
        }
        elseif ($AlgoType == 4) {
            CreativeMarket($AlgoType);
        }
        elseif ($AlgoType == 5) {
            RRSlides($AlgoType);
        }
    }

header("location: ../upload.php?upload=success");    