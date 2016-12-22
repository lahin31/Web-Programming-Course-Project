<?php
header('Content-Type: application/json');
if (!isset($_GET['query'])) {
	echo json_encode([]);
	exit();
}
$db=new PDO('mysql:host=127.0.0.1;dbname=w_programming','root','');
$users=$db->prepare("
	select id, Animal_Name 
	from animals_table
	where Animal_Name LIKE :query
	"
	);
$users->execute([
	'query'=>"{$_GET['query']}%"
	]);
echo json_encode($users->fetchAll());