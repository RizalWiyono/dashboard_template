<?php
include '../../../../src/connection/connection.php';
error_reporting(0);
$type = $_POST['type'];
if(isset($_POST['id'])){
    $id_item = $_POST['id'];
}else{}
$market_sup = array("All" => "0", "GR-Brandearth" => "1", "GR-RRGraph" => "2", "Templatemonster" => "3", "Creativemarket" => "4", "RRSlide" => "5");
$market_id = $market_sup[$type];

if($market_id == 0)
{
    if(!empty($_POST['search'])){
        $search = $_POST['search'];

        $query="SELECT * FROM tb_category WHERE name LIKE '%$search%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $id = $row['category_id'];
            $total = "SELECT * FROM tb_sub_category WHERE category_id='$id'";

            $total_sub = mysqli_num_rows(mysqli_query($connect, $total));
            ?>
            <table class="table-category table">
                <tbody id="table-category">
                
                    <tr class="sub-title-table">
                        <td><?=$row['name']?></td>
                        <td><?=$total_sub?></td>
                        <td>
                            <form action="process/delete-cat.php" method="POST">
                                <input class="d-none" type="text" name="id" value="<?=$row['category_id']?>">
                                <input type="submit" class="action-del" value="  ">
                                <a href="?market=All Marketplace&type=<?=$type?>&id=<?=$row['category_id']?>" class="text-decoration-none">
                                <?php
                                if($id_item == $id){
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
                        </td>
                    </tr> 

                </tbody>
            </table>
        <?php
        }

    }else{
        $query="SELECT * FROM tb_category";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $id = $row['category_id'];
            $total = "SELECT * FROM tb_sub_category WHERE category_id='$id'";

            $total_sub = mysqli_num_rows(mysqli_query($connect, $total));
            ?>
            <table class="table-category table">
                <tbody id="table-category">
                
                    <tr class="sub-title-table">
                        <td><?=$row['name']?></td>
                        <td><?=$total_sub?></td>
                        <td>
                            <form action="process/delete-cat.php" method="POST">
                                <input class="d-none" type="text" name="id" value="<?=$row['category_id']?>">
                                <input type="submit" class="action-del" value="  ">
                                <a href="?market=All Marketplace&type=<?=$type?>&id=<?=$row['category_id']?>" class="text-decoration-none">
                                <?php
                                if($id_item == $id){
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
                        </td>
                    </tr> 

                </tbody>
            </table>
        <?php
        }
    }
}else{
    if(!empty($_POST['search'])){
        $search = $_POST['search'];

        $query="SELECT * FROM `tb_catalog` INNER JOIN tb_category ON tb_catalog.category=tb_category.name WHERE market_id=$market_id && category LIKE '%$search%' GROUP BY category";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $id = $row['category_id'];
            $total = "SELECT * FROM tb_sub_category WHERE category_id='$id'";

            $total_sub = mysqli_num_rows(mysqli_query($connect, $total));
            ?>
            <table class="table-category table">
                <tbody id="table-category">
                
                    <tr class="sub-title-table">
                        <td><?=$row['name']?></td>
                        <td><?=$total_sub?></td>
                        <td>
                            <form action="process/delete-cat.php" method="POST">
                                <input class="d-none" type="text" name="id" value="<?=$row['category_id']?>">
                                <input type="submit" class="action-del" value="  ">
                                <a href="?market=All Marketplace&type=<?=$type?>&id=<?=$row['category_id']?>" class="text-decoration-none">
                                <?php
                                if($id_item == $id){
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
                        </td>
                    </tr> 

                </tbody>
            </table>
        <?php
        }

    }else{
        $query="SELECT * FROM `tb_catalog` INNER JOIN tb_category ON tb_catalog.category=tb_category.name WHERE market_id=$market_id && category!='' GROUP BY category";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            $id = $row['category_id'];
            $total = "SELECT * FROM tb_sub_category WHERE category_id='$id'";

            $total_sub = mysqli_num_rows(mysqli_query($connect, $total));
            ?>
            <table class="table-category table">
                <tbody id="table-category">
                
                    <tr class="sub-title-table">
                        <td><?=$row['name']?></td>
                        <td><?=$total_sub?></td>
                        <td>
                            <form action="process/delete-cat.php" method="POST">
                                <input class="d-none" type="text" name="id" value="<?=$row['category_id']?>">
                                <input type="submit" class="action-del" value="  ">
                                <a href="?market=All Marketplace&type=<?=$type?>&id=<?=$row['category_id']?>" class="text-decoration-none">
                                <?php
                                if($id_item == $id){
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
                        </td>
                    </tr> 

                </tbody>
            </table>
        <?php
        }
    }
}