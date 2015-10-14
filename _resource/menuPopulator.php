<?php
$fileCont = file_get_contents("menu.json");
$menuOb = json_decode($fileCont);
$arr = $menuOb->menu;

$dbname = 'BurritoBar';
$user = 'test';
$pass = 'abc123';
$host = 'localhost';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$pass");
} 
catch (PDOException $e) {
    $response = "Failed to connect: ";
    $response .= $e->getMessage();
    die ($response);
}
$statement = $pdo->prepare(
		"INSERT INTO Items (itemName,itemType,itemPrice)
		VALUES (:name,:type,1.5)");
foreach ($arr as $val)
{
	$args = array();
	$args[":name"]=$val->itemName;
	$args[":type"]=$val->itemType;
	$statement = $pdo->prepare(
		"INSERT INTO Items (itemName,itemType,itemPrice)
		VALUES (:name,:type,1.5)");
	$statement->execute($args);
}
echo "Success";
?>