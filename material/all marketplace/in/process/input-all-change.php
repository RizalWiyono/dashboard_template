<?php
include '../../../../src/connection/connection.php';
// error_reporting(0);

$par_id             = $_POST['param_id'];
$par_name           = $_POST['param_name'];
$par_color          = $_POST['param_color'];
$param_category     = $_POST['param_category'];
$par_subcategory    = $_POST['param_subcategory'];

$sql_catalog = mysqli_query($connect, "SELECT name FROM tb_category WHERE category_id='$param_category'");
if(mysqli_num_rows($sql_catalog) < 1) {
    $par_category       = $_POST['param_category'];
}else{
    $para_category       = $_POST['param_category'];

    $query_cat="SELECT name FROM tb_category WHERE category_id='$para_category'";
    $result_cat = mysqli_query($connect, $query_cat);
    while($data =mysqli_fetch_array($result_cat)) {
        $par_category = $data['name'];
    }
}

$query = 'UPDATE tb_catalog   
SET 
color="'.$par_color.'",  
category="'.$par_category.'",  
sub_category="'.$par_subcategory.'"
WHERE name LIKE "%'.$par_name.'%"';
$insert = mysqli_query($connect, $query);
    if(!$insert){
        $output[] = [
            'Error'  => mysqli_error($connect)
        ];
}

// $query_subcat="SELECT * FROM tb_sub_category WHERE category_id=$par_category && subcat_id=$par_subcategory";
// $result_subcat = mysqli_query($connect, $query_subcat);
// while($row =mysqli_fetch_array($result_subcat)) {
//     $para_subcategory = $row['name'];
// }



echo json_encode($output);
