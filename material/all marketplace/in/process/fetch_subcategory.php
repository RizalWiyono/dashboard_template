<?php
include('../../../../src/connection/connection.php');


$id = $_POST['id'];

$query="SELECT * FROM tb_sub_category WHERE category_id=$id";
$result = mysqli_query($connect, $query);
while($row =mysqli_fetch_array($result)) {

    $output[] = [
        'subcategory_id'  => $row["subcat_id"],
        'name'  => $row["name"],
    ];
}
$respon = [
    "status" => 200,
    "data"   => $output
];

echo json_encode($respon);
?>