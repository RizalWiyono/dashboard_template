<?php
error_reporting(0);
$connect = mysqli_connect("localhost", "root", "", "db_rrgraph");  
$select = $_POST['select'];
$type = $_POST['type'];

if($type == 'All'){
    if($select == 'All'){
        $select_query = "SELECT * FROM tb_catalog GROUP BY SUBSTR(name, 1, 7) ";  
        $result = mysqli_query($connect, $select_query);  
        $output .= '  
             <table class="table-market-item table">  
                 <tr class="title-table">
                     <th scope="col">Items Name</th>
                     <th scope="col">Color</th>
                     <th scope="col">Category</th>
                     <th scope="col">Sub</th>
                     <th scope="col">Type</th>
                     <th scope="col" style="width: 200px;">
                         <button class="btn-edit">
                             Bulk Edit
                         </button>
                     </th>
                 </tr>
        ';  
        while($row = mysqli_fetch_array($result))  
        {  
            if($row['color'] == ''){
                $output .= '  
                <tr>  
                    <td>' . $row["name"] . '</td>  
                    <td>' . $row["color"] . '</td>  
                    <td>' . $row["category"] . '</td>  
                    <td>' . $row["sub_category"] . '</td>  
                    <td>' . $row["slug"] . '</td>  
                    <td align="right"><input type="button" name="edit" value="Edit" id="'.$row["item_id"] .'" class="btn-upd-type edit_data" /> 
                    </td>  
                </tr>  
            ';  
            }else{            
                $output .= '  
                <tr>  
                    <td>' . $row["name"] . '</td>  
                    <td><canvas style="border-radius: 100%; width: 18px; height: 18px; background-color: '.$row['color'].'; border: 1px solid #D8D8D8;"></canvas></td>  
                    <td>' . $row["category"] . '</td>  
                    <td>' . $row["sub_category"] . '</td>  
                    <td>' . $row["slug"] . '</td>  
                    <td align="right"><input type="button" name="edit" value="Edit" id="'.$row["item_id"] .'" class="btn-upd-type edit_data" /> 
                    </td>  
                </tr>  
            ';
            }
        }  
        $output .= '</table>';  
    }else{
        $select_query = "SELECT * FROM tb_catalog GROUP BY SUBSTR(name, 1, 7) LIMIT $select";  
        $result = mysqli_query($connect, $select_query);  
        $output .= '  
            <table class="table-market-item table">  
                <tr class="title-table">
                    <th scope="col">Items Name</th>
                    <th scope="col">Color</th>
                    <th scope="col">Category</th>
                    <th scope="col">Sub</th>
                    <th scope="col">Type</th>
                    <th scope="col" style="width: 200px;">
                        <button class="btn-edit">
                            Bulk Edit
                        </button>
                    </th>
                </tr>
        ';  
        while($row = mysqli_fetch_array($result))  
        {  
            if($row['color'] == ''){
                $output .= '  
                <tr>  
                    <td>' . $row["name"] . '</td>  
                    <td>' . $row["color"] . '</td>  
                    <td>' . $row["category"] . '</td>  
                    <td>' . $row["sub_category"] . '</td>  
                    <td>' . $row["slug"] . '</td>  
                    <td align="right"><input type="button" name="edit" value="Edit" id="'.$row["item_id"] .'" class="btn-upd-type edit_data" /> 
                    </td>  
                </tr>  
            ';  
            }else{            
                $output .= '  
                <tr>  
                    <td>' . $row["name"] . '</td>  
                    <td><canvas style="border-radius: 100%; width: 18px; height: 18px; background-color: '.$row['color'].'; border: 1px solid #D8D8D8;"></canvas></td>  
                    <td>' . $row["category"] . '</td>  
                    <td>' . $row["sub_category"] . '</td>  
                    <td>' . $row["slug"] . '</td>  
                    <td align="right"><input type="button" name="edit" value="Edit" id="'.$row["item_id"] .'" class="btn-upd-type edit_data" /> 
                    </td>  
                </tr>  
            ';
            }
        }  
        $output .= '</table>';  
    }
}else{
    if($select == 'All'){
        $select_query = "SELECT * FROM tb_catalog WHERE name LIKE '%$type%' GROUP BY SUBSTR(name, 1, 7)";  
        $result = mysqli_query($connect, $select_query);  
        $output .= '  
             <table class="table-market-item table">  
                 <tr class="title-table">
                     <th scope="col">Items Name</th>
                     <th scope="col">Color</th>
                     <th scope="col">Category</th>
                     <th scope="col">Sub</th>
                     <th scope="col">Type</th>
                     <th scope="col" style="width: 200px;">
                         <button class="btn-edit">
                             Bulk Edit
                         </button>
                     </th>
                 </tr>
        ';  
        while($row = mysqli_fetch_array($result))  
        {  
            if($row['color'] == ''){
                $output .= '  
                <tr>  
                    <td>' . $row["name"] . '</td>  
                    <td>' . $row["color"] . '</td>  
                    <td>' . $row["category"] . '</td>  
                    <td>' . $row["sub_category"] . '</td>  
                    <td>' . $row["slug"] . '</td>  
                    <td align="right"><input type="button" name="edit" value="Edit" id="'.$row["item_id"] .'" class="btn-upd-type edit_data" /> 
                    </td>  
                </tr>  
            ';  
            }else{            
                $output .= '  
                <tr>  
                    <td>' . $row["name"] . '</td>  
                    <td><canvas style="border-radius: 100%; width: 18px; height: 18px; background-color: '.$row['color'].'; border: 1px solid #D8D8D8;"></canvas></td>  
                    <td>' . $row["category"] . '</td>  
                    <td>' . $row["sub_category"] . '</td>  
                    <td>' . $row["slug"] . '</td>  
                    <td align="right"><input type="button" name="edit" value="Edit" id="'.$row["item_id"] .'" class="btn-upd-type edit_data" /> 
                    </td>  
                </tr>  
            ';
            }
        }  
        $output .= '</table>';  
    }else{
        $select_query = "SELECT * FROM tb_catalog WHERE name LIKE '%$type%' GROUP BY SUBSTR(name, 1, 7) LIMIT $select";  
        $result = mysqli_query($connect, $select_query);  
        $output .= '  
            <table class="table-market-item table">  
                <tr class="title-table">
                    <th scope="col">Items Name</th>
                    <th scope="col">Color</th>
                    <th scope="col">Category</th>
                    <th scope="col">Sub</th>
                    <th scope="col">Type</th>
                    <th scope="col" style="width: 200px;">
                        <button class="btn-edit">
                            Bulk Edit
                        </button>
                    </th>
                </tr>
        ';  
        while($row = mysqli_fetch_array($result))  
        {  
            if($row['color'] == ''){
                $output .= '  
                <tr>  
                    <td>' . $row["name"] . '</td>  
                    <td>' . $row["color"] . '</td>  
                    <td>' . $row["category"] . '</td>  
                    <td>' . $row["sub_category"] . '</td>  
                    <td>' . $row["slug"] . '</td>  
                    <td align="right"><input type="button" name="edit" value="Edit" id="'.$row["item_id"] .'" class="btn-upd-type edit_data" /> 
                    </td>  
                </tr>  
            ';  
            }else{            
                $output .= '  
                <tr>  
                    <td>' . $row["name"] . '</td>  
                    <td><canvas style="border-radius: 100%; width: 18px; height: 18px; background-color: '.$row['color'].'; border: 1px solid #D8D8D8;"></canvas></td>  
                    <td>' . $row["category"] . '</td>  
                    <td>' . $row["sub_category"] . '</td>  
                    <td>' . $row["slug"] . '</td>  
                    <td align="right"><input type="button" name="edit" value="Edit" id="'.$row["item_id"] .'" class="btn-upd-type edit_data" /> 
                    </td>  
                </tr>  
            ';
            }
        }  
        $output .= '</table>';  
    }
}

echo $output;  
?>