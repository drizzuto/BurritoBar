<?php

require 'vendor/autoload.php';
$dbname = 'BurritoBar';
$user = 'test';
$pass = 'abc123';
$host = 'localhost';
$app = new \Slim\Slim();
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", "$user", "$pass");
}
catch (PDOException $e) {
    $response = "Failed to connect: ";
    $response .= $e->getMessage();
    die ($response);
}

$app->get('/', function() {
	echo "text";
});

$app->post('/getMenu',function()
{
	global $pdo;
	$statement = $pdo->prepare(
		"SELECT * FROM Items");
	if ($statement->execute()) {
		$result['success'] = true;
		$result['menu'] = array();
		while ($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			if(!array_key_exists($row['itemType'],$result['menu']))
			{
				$result['menu'][$row['itemType']] = array();
			}
			$item = new stdClass;
			$item->name = $row['itemName'];
			$item->price = $row['itemPrice'];
			$result['menu'][$row['itemType']][] = $item;
		}
	}
	else {
		$result['success'] = false;
		$result['error'] = $statement->errorInfo();
	}
	echo json_encode($result);
});

$app->post('/getMostRecentOrder',function()
{
	global $pdo;
	$args[":userId"] = $_POST["userId"];
	$statement = $pdo->prepare(
		"SELECT * FROM Orders
			WHERE customerID = :userId
			AND timeOrdered = (SELECT MAX(timeOrdered)
				FROM Orders
				WHERE customerID = :userId)");
	if ($statement->execute($args)) {
		$result['success'] = true;
		while ($row = $statement->fetch(PDO::FETCH_ASSOC))
		{
			$result['order'] = $row['orderJSON'];
		}
	}
	else {
		$result['success'] = false;
		$result['error'] = $statement->errorInfo();
	}
	echo json_encode($result);
});

$app->post('/signUp', function()
{
  global $pdo;
  $args[":firstName"] = $_POST["firstName"];
  $args[":lastName"] = $_POST["lastName"];
  $args[":email"] = $_POST["email"];
  $args[":password"] = $_POST["password"];
  $args[":creditProvider"] = $_POST["creditProvider"];
  $args[":ccNum"] = $_POST["ccNum"];
  $statement = $pdo->prepare(
  "INSERT INTO Account(firstName, lastName, email, password, creditProvider, ccNum) values (:firstName, :lastName, :email, :password, :creditProvider, :ccNum)");
  if($statement = $pdo->execute($args)){
    $result['success'] = true;
  }
  else{
    $result['success']= false;
    $result['error'] = $statement->errorInfo();
  }
  echo json_encode($result);
});

$app->post('/login', function()
{
  global $pdo;
  $args[":email"] = $_POST["email"];
  $args[":password"] = $_POST["password"];
  $statement = $pdo->prepare(
  "SELECT * FROM Account where email = :email AND password = :password AND loggedIn = 0");
  if($statement = $pdo->execute($args)){
    $result['success'] = true;
    $result['email'] = $row['email'];
    $row['loggedIn'] = 1;
  }
  else{
    $result['success'] = false;
    $result['error'] = $statement->errorInfo();
  }
  echo json_encode($result);
})

$app->get('/', function()
{
	echo "test";
});

$app->run();
?>
