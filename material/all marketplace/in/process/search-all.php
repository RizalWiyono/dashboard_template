<?php
error_reporting(0);
include '../../../../src/connection/connection.php';
$type = $_POST['type'];
$search = $_POST['search'];

if($type == 'All'){
    if(!empty($search)){
        $query="SELECT * FROM tb_catalog WHERE name LIKE '%$search%'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name']?></td>
                    <td>
                        <input type="hidden" name="id[]" value="<?=$row['item_id']?>">
                        <select name="color[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
                        <?php
                        $sql_color = mysqli_query($connect, "SELECT * FROM tb_color");
                        while($data = mysqli_fetch_array($sql_color)){
                        ?>
                            <option value="<?=$data['code_color']?>"><?=$data['code_color']?></option>
                        <?php
                        }
                        ?>
                            <option selected value="<?=$row['color']?>"><?=$row['color']?></option>
                        </select>
                    </td>
                    <td>
                        <select name="category[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
                        <?php
                        $sql_category = mysqli_query($connect, "SELECT * FROM tb_category");
                        while($data = mysqli_fetch_array($sql_category)){
                        ?>
                            <option value="<?=$data['name']?>"><?=$data['name']?></option>
                        <?php
                        }
                        ?>
                            <option selected value="<?=$row['category']?>"><?=$row['category']?></option>
                        </select>
                    </td>
                    <td>
                        <select name="sub_category[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
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
                        <select name="type[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
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
    }else{
        $query="SELECT * FROM tb_catalog WHERE name LIKE '%$search%' LIMIT 10";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name']?></td>
                    <td>
                        <input type="hidden" name="id[]" value="<?=$row['item_id']?>">
                        <select name="color[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
                        <?php
                        $sql_color = mysqli_query($connect, "SELECT * FROM tb_color");
                        while($data = mysqli_fetch_array($sql_color)){
                        ?>
                            <option value="<?=$data['code_color']?>"><?=$data['code_color']?></option>
                        <?php
                        }
                        ?>
                            <option selected value="<?=$row['color']?>"><?=$row['color']?></option>
                        </select>
                    </td>
                    <td>
                        <select name="category[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
                        <?php
                        $sql_category = mysqli_query($connect, "SELECT * FROM tb_category");
                        while($data = mysqli_fetch_array($sql_category)){
                        ?>
                            <option value="<?=$data['name']?>"><?=$data['name']?></option>
                        <?php
                        }
                        ?>
                            <option selected value="<?=$row['category']?>"><?=$row['category']?></option>
                        </select>
                    </td>
                    <td>
                        <select name="sub_category[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
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
                        <select name="type[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
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
    }
    
}else{
    if(!empty($search)){
        $query="SELECT * FROM tb_catalog WHERE name LIKE '%$search%' && slug='$type'";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name']?></td>
                    <td>
                        <input type="hidden" name="id[]" value="<?=$row['item_id']?>">
                        <select name="color[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
                        <?php
                        $sql_color = mysqli_query($connect, "SELECT * FROM tb_color");
                        while($data = mysqli_fetch_array($sql_color)){
                        ?>
                            <option value="<?=$data['code_color']?>"><?=$data['code_color']?></option>
                        <?php
                        }
                        ?>
                            <option selected value="<?=$row['color']?>"><?=$row['color']?></option>
                        </select>
                    </td>
                    <td>
                        <select name="category[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
                        <?php
                        $sql_category = mysqli_query($connect, "SELECT * FROM tb_category");
                        while($data = mysqli_fetch_array($sql_category)){
                        ?>
                            <option value="<?=$data['name']?>"><?=$data['name']?></option>
                        <?php
                        }
                        ?>
                            <option selected value="<?=$row['category']?>"><?=$row['category']?></option>
                        </select>
                    </td>
                    <td>
                        <select name="sub_category[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
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
                        <select name="type[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
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
    }else{
        $query="SELECT * FROM tb_catalog WHERE name LIKE '%$search%' && slug='$type' LIMIT 10";
        $result = mysqli_query($connect, $query);
        while($row =mysqli_fetch_array($result)) 
        {
            ?>
                <tr class="sub-title-table">
                    <td><?=$row['name']?></td>
                    <td>
                        <input type="hidden" name="id[]" value="<?=$row['item_id']?>">
                        <select name="color[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
                        <?php
                        $sql_color = mysqli_query($connect, "SELECT * FROM tb_color");
                        while($data = mysqli_fetch_array($sql_color)){
                        ?>
                            <option value="<?=$data['code_color']?>"><?=$data['code_color']?></option>
                        <?php
                        }
                        ?>
                            <option selected value="<?=$row['color']?>"><?=$row['color']?></option>
                        </select>
                    </td>
                    <td>
                        <select name="category[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
                        <?php
                        $sql_category = mysqli_query($connect, "SELECT * FROM tb_category");
                        while($data = mysqli_fetch_array($sql_category)){
                        ?>
                            <option value="<?=$data['name']?>"><?=$data['name']?></option>
                        <?php
                        }
                        ?>
                            <option selected value="<?=$row['category']?>"><?=$row['category']?></option>
                        </select>
                    </td>
                    <td>
                        <select name="sub_category[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
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
                        <select name="type[]" id="color" style="height: 30px; font-size: 10px; font-weight: bold;" class="form-control">
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
    }
}
        


?>