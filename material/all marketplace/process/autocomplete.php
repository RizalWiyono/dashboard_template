<?php
include('../../../src/connection/connection.php');

$searchTerm = $_GET['term'];

$select =mysqli_query($connect, "SELECT * FROM tb_sales WHERE name LIKE '%".$searchTerm."%'");
while ($row=mysqli_fetch_array($select)) 
{
 $data[] = $row['detail'];
}
echo json_encode($data);
?>