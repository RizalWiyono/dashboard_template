<?php
error_reporting(0);
include('../../../../src/connection/connection.php');
$search = $_POST['search'];
$market = array("1" => "GR - Brandearth", "2" => "GR - RRGraph", "3" => "Templatemonster", "4" => "Creativemarket", "5" => "RRSlides");

    if(isset($search)){
        $query="SELECT name, tb_sales.market_id, color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' GROUP BY name ASC";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            ?>
                <tr class="sub-title-table">
                <td>
                    <a href="item-details.php?item=<?=$row['name']?>&market=All Marketplace&date=One Year&todate=">
                        <?=$row['name']?>
                    </a>
                </td>
                    <td><?=$market[$row['market_id']]?></td>
                    <td><?=$row['color']?></td> 
                    <td><?=$row['TOTAL']?></td>
                </tr> 
            <?php
        }
    }else{
        $query="SELECT name, tb_sales.market_id, color, COUNT(*) AS TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id GROUP BY name ASC LIMIT 10";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            ?>
                <tr class="sub-title-table">
                <td>
                    <a href="item-details.php?item=<?=$row['name']?>&market=All Marketplace&date=One Year&todate=">
                        <?=$row['name']?>
                    </a>
                </td>
                    <td><?=$market[$row['market_id']]?></td>
                    <td><?=$row['color']?></td> 
                    <td><?=$row['TOTAL']?></td>
                </tr> 
            <?php
        }
    }
?>