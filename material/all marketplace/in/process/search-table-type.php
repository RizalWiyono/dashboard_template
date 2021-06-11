<?php
error_reporting(0);
include('../../../../src/connection/connection.php');
$type = $_POST['type'];
$search = $_POST['search'];
$id = $_POST['id'];

    if(isset($search)){
        $query="SELECT * FROM tb_catalog WHERE name LIKE '%$search%' GROUP BY name ASC LIMIT 10";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            if($row['item_id'] == $id){
                ?>
                    <tr class="sub-title-table" id="tr-hidden">
                        <td><?=$row['name']?></td>
                        <td>    
                            <input class="d-none" name="id" type="text" value="<?=$row['item_id']?>">
                                
                            <select name="color" class="select-update-detail" id="">
                            <?php
                            $query = mysqli_query($connect, "SELECT * FROM tb_color");
                            while($row = mysqli_fetch_array($query)){
                            ?>
                                    <option style="background-color: red;" value="<?=$row['code_color']?>"><?=$row['code_color']?></option>
                            <?php
                            }
                            ?>
                            </select>
                            </div>
                        </td>
                        <td>
                            <select name="category" class="select-update-detail" id="">
                            <?php
                            $query = mysqli_query($connect, "SELECT * FROM tb_category");
                            while($row = mysqli_fetch_array($query)){
                            ?>
                                <option value="<?=$row['name']?>"><?=$row['name']?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </td>
                        <td>
                                
                            <select name="sub_category" class="select-update-detail" id="">
                            <?php
                            $query = mysqli_query($connect, "SELECT * FROM tb_sub_category");
                            while($row = mysqli_fetch_array($query)){
                            ?>
                                <option value="<?=$row['name']?>"><?=$row['name']?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </td>
                        <td>
                            <select name="type" class="select-update-detail" id="">
                            <?php
                            $query = mysqli_query($connect, "SELECT * FROM tb_catalog GROUP BY slug DESC");
                            while($row = mysqli_fetch_array($query)){
                            ?>
                                    <option value="<?=$row['slug']?>"><?=$row['slug']?></option>
                            <?php
                            }
                            ?>
                            </select>
                        </td>
                        <td>
                                <input type="submit" class="btn-upd-type" value="Update"> 
                        </td>
                    </tr> 
                <?php
                }else{
                ?>
                    <tr class="sub-title-table">
                        <td><?=$row['name']?></td>
                        <td><?=$row['color']?></td>
                        <td><?=$row['category']?></td> 
                        <td><?=$row['sub_category']?></td>
                        <td><?=$row['slug']?></td>
                        <td>
                            <!-- <a href="?type=All&market=All Marketplace&id=<?=$row['item_id']?>" class="btn-upd-type">
                                Edit
                            </a>     -->
                    <form action="process/input-tb-item.php" method="POST">
                            <input type="submit" class="btn-upd-type" value="Update"> 
                    </form>
                        </td>
                    </tr> 
                <?php
                }
                }
    }else{
        $query="SELECT * FROM tb_catalog GROUP BY name ASC LIMIT 10";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name']?></td>
                    <td><?=$row['color']?></td>
                    <td><?=$row['category']?></td> 
                    <td><?=$row['sub_category']?></td>
                    <td><?=$row['slug']?></td>
                    <td>
                        <button class="btn-upd-type">
                            Edit
                        </button>    
                    </td>
                </tr> 
            <?php
        }
    }
?>

<!-- <script>
    function getNode(param) {
        document.getElementById("tr-hidden").style.display = '';
        // $(this).closest("tr").nextUntil("#tr-hidden").toggleClass("open");
        console.log(param)
    }
</script> -->