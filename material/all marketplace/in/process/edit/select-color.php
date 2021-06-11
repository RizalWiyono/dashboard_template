<?php  
 
include '../../../../../src/connection/connection.php';


$query="SELECT * FROM tb_color";
$result = mysqli_query($connect, $query);
while($row =mysqli_fetch_array($result)) 
{

    $output[] = [
        'num'  => $row['color_id'],
        'name'  => $row['code_color']
    ];
}

echo json_encode($output);
