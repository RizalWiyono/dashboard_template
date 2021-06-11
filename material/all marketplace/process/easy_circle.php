<?php

$market = $_POST['market'];
$market_sup = array("All Marketplace" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5");
$market_id =$market_sup[$market];

include('../../../src/connection/connection.php');

if($market_id == 5){
    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id";
    $result = mysqli_query($connect, $query); 
    while($row =mysqli_fetch_array($result)) 
    {
        $output[] = [
            'TOTAL'  => $row['TOTAL']
        ];
    }

    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && slug='PowerPoint'";
    $result = mysqli_query($connect, $query); 
    while($row =mysqli_fetch_array($result)) 
    {
        $output[] = [
            'PPT'  => $row['TOTAL']
        ];
    }

    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && slug='Infographic'";
    $result = mysqli_query($connect, $query); 
    while($row =mysqli_fetch_array($result)) 
    {
        $output[] = [
            'KY'  => $row['TOTAL']
        ];
    }

    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_catalog_fb WHERE market_id=$market_id";
    $result = mysqli_query($connect, $query); 
    while($row =mysqli_fetch_array($result)) 
    {
        $output[] = [
            'PT'  => $row['TOTAL']
        ];
    }
}else{
    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id";
    $result = mysqli_query($connect, $query); 
    while($row =mysqli_fetch_array($result)) 
    {
        $output[] = [
            'TOTAL'  => $row['TOTAL']
        ];
    }
    
    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && slug='PowerPoint'";
    $result = mysqli_query($connect, $query); 
    while($row =mysqli_fetch_array($result)) 
    {
        $output[] = [
            'PPT'  => $row['TOTAL']
        ];
    }

    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && slug='Keynote'";
    $result = mysqli_query($connect, $query); 
    while($row =mysqli_fetch_array($result)) 
    {
        $output[] = [
            'KY'  => $row['TOTAL']
        ];
    }

    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && slug='Potrait'";
    $result = mysqli_query($connect, $query); 
    while($row =mysqli_fetch_array($result)) 
    {
        $output[] = [
            'PT'  => $row['TOTAL']
        ];
    }

    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && slug='Etc'";
    $result = mysqli_query($connect, $query); 
    while($row =mysqli_fetch_array($result)) 
    {
        $output[] = [
            'ETC'  => $row['TOTAL']
        ];
    }

    $query="SELECT market_id, COUNT(*) AS TOTAL FROM tb_catalog WHERE market_id=$market_id && slug='Google Slide'";
    $result = mysqli_query($connect, $query); 
    while($row =mysqli_fetch_array($result)) 
    {
        $output[] = [
            'GS'  => $row['TOTAL']
        ];
    }
}

echo json_encode($output);
