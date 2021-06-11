<?php
error_reporting(0);
include('../../../../src/connection/connection.php');
$type = $_POST['type'];
$select = $_POST['select'];

if($type == 'All'){
    if($select == 'All'){
        $query="SELECT * FROM tb_catalog GROUP BY name ASC";
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
    }else{
        $query="SELECT * FROM tb_catalog GROUP BY name ASC LIMIT $select";
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
}else{
    if($select == 'All'){
        $query="SELECT * FROM tb_catalog WHERE slug='$type' GROUP BY name ASC";
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
    }else{
        $query="SELECT * FROM tb_catalog WHERE slug='$type' GROUP BY name ASC LIMIT $select";
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
}
?>