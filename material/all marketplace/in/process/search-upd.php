<?php
error_reporting(0);
$connect = mysqli_connect("localhost", "root", "", "db_rrgraph");  
$type = $_POST['type'];
$search = $_POST['search'];

if($type == 'All'){
    if(!empty($search)){
        $select_query = "SELECT * FROM tb_catalog WHERE name LIKE '%$search%'";  
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
        }  
        $output .= '</table>';
    }else{
        $select_query = "SELECT * FROM tb_catalog WHERE name LIKE '%$search%' LIMIT 10";  
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
        }  
        $output .= '</table>';
    }
}else{
    if(!empty($search)){
        $select_query = "SELECT * FROM tb_catalog WHERE name LIKE '%$search%' && name LIKE '%$type%'";  
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
        }  
        $output .= '</table>';
    }else{
        $select_query = "SELECT * FROM tb_catalog WHERE name LIKE '%$search%' && name LIKE '%$type%' LIMIT 10";  
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
        }  
        $output .= '</table>';
    }
}

echo $output;  

?>