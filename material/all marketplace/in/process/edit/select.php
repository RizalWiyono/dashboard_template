<?php  
 
 include '../../../../../src/connection/connection_pdo.php';


$query = "
	SELECT * FROM tb_sales INNER JOIN tb_catalog ON tb_sales.item_id=tb_catalog.item_id
";

$statement = $connect->prepare($query);

if($statement->execute()) {
  	while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    	$data[] = $row;
  	}

  	echo json_encode($data);
}