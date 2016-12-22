<?php
$DB_host = "localhost";
$DB_user = "root";
$DB_pass = "";
$DB_name = "w_programming";
$pdo = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);$statement=$pdo->prepare("SELECT * FROM animals_table");
$statement=$pdo->prepare("SELECT * FROM animals_table order by id desc");
$statement->execute();
$results=$statement->fetchAll(PDO::FETCH_ASSOC);
$json=json_encode(array('animalDetails' => $results)); 
echo $json;
?>
