<?php
include('../../../src/connection/connection_fetch.php');

$query = "
SELECT year, month, day FROM tb_newsletter WHERE year=(SELECT MIN(year) FROM tb_newsletter) && month=(SELECT MIN(month) FROM tb_newsletter WHERE year=(SELECT MIN(year) FROM tb_newsletter)) && day=(SELECT MIN(day) FROM tb_newsletter WHERE year=(SELECT MIN(year) FROM tb_newsletter) && month=(SELECT MIN(month) FROM tb_newsletter WHERE year=(SELECT MIN(year) FROM tb_newsletter))) LIMIT 1";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output[] = [
            'year'  => $row["year"],
            'month'  => $row["month"],
            'day'  => $row["day"]
        ];
    }

    $query = "
SELECT year, month, day FROM tb_newsletter WHERE year=(SELECT MAX(year) FROM tb_newsletter) && month=(SELECT MAX(month) FROM tb_newsletter WHERE year=(SELECT MAX(year) FROM tb_newsletter)) && day=(SELECT MAX(day) FROM tb_newsletter WHERE year=(SELECT MAX(year) FROM tb_newsletter) && month=(SELECT MAX(month) FROM tb_newsletter WHERE year=(SELECT MAX(year) FROM tb_newsletter))) LIMIT 1";
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();
    foreach($result as $row)
    {
        $output[] = [
            'year'  => $row["year"],
            'month'  => $row["month"],
            'day'  => $row["day"]
        ];
    }


echo json_encode($output);
?>