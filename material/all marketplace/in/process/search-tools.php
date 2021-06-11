<?php
include('../../../../src/connection/connection.php');
$search = $_POST['search'];

$query="SELECT name, tb_sales.market_id, COUNT(*) as TOTAL FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id WHERE name LIKE '%$search%' && year=(SELECT MAX(year) FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id) GROUP BY name ORDER BY TOTAL DESC, name DESC LIMIT 10";
$result = mysqli_query($connect, $query);
while($row =mysqli_fetch_array($result)) {
?>
    <tr class="sub-title-table">
        <td>
            <a href="item-details.php?item=<?=$row['name']?>&market=All Marketplace">
                <?=$row['name']?>
            </a>
        </td>
        <?php
        if($market_id == 6){
        ?>
        <td><?=$row['category']?></td>
        <?php
        }elseif($market_id == 7){
        ?>
        <td><?=$row['color']?></td>
        <?php
        }else{
        ?>
        <td><?=$month[$row['market_id']]?></td>
        <?php
        }
        ?>
        <td><?=$row['TOTAL']?></td> 
    </tr> 
    <?php
}
?>