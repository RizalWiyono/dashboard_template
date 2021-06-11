<?php  
 
 include '../../../../../src/connection/connection_pdo.php';


$query = "
	SELECT * FROM tb_color
";

$statement = $connect->prepare($query);

if($statement->execute()) {
  	while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    	$data[] = $row;
  	}

  	echo json_encode($data);
}