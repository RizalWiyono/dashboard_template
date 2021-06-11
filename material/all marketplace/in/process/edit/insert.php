<?php
session_start();
if(!isset($_SESSION['username']) ) {
    header('location: ../login/login.php');
    exit;
}
?>

<html>
<head>
    <link rel="stylesheet" type="text/css" href="../../../src/DataTables/datatables.css"/>
      
</head>
<body >

<?php  
 $connect = mysqli_connect("localhost", "root", "", "db_rrgraph");  
 if(!empty($_POST))  
 {  
      $output = '';  
      $message = '';  
      $color = mysqli_real_escape_string($connect, $_POST["color"]);  
      $category = mysqli_real_escape_string($connect, $_POST["category"]);  
      $param_like = mysqli_real_escape_string($connect, $_POST["param_like"]);  
      $sub_category = mysqli_real_escape_string($connect, $_POST["sub_category"]);  
      $type = mysqli_real_escape_string($connect, $_POST["type"]);  
           $query = "  
           UPDATE tb_catalog   
           SET 
           color='$color',  
           category='$category',  
           sub_category='$sub_category',  
           slug='$type'
           WHERE name LIKE '%$param_like%'";  
           $message = 'Data Updated';  
      
      if(mysqli_query($connect, $query))  
      {  
           $select_query = "SELECT * FROM tb_catalog GROUP BY SUBSTR(name, 1, 7) LIMIT 10";  
           $result = mysqli_query($connect, $select_query);  
           $output .= '  
                <table class="table-market-item table" id="tbl-edit">  
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
                          <td><canvas style="border-radius: 100%; width: 18px; height: 18px; background-color:' . $row['color'] . '; border: 1px solid #D8D8D8;"></canvas></td>
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
      echo $output;  
 }  
 ?>
 

    <script src="js/table-edit.js"></script> 
    <script src="../../../src/DataTables/datatables.min.js"></script>
    <script>
    $('#tbl-edit').DataTable( {
        "order": false,
        "ordering": false,
        "info":     false
    } );
    </script>

</body>
</html>

