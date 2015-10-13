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

$app->get('/hello/:name', function ($name) {
    echo "Hello, $name";
});

$app->post('/validate', function() {
	global $pdo;
	$args [":username"] = $_POST["email"];
	$args [":password"] = $_POST["password"];
	$statement = $pdo->prepare(
		"SELECT COUNT(username) AS count FROM Account
			WHERE username = :email AND password = :password");
	if ($statement->execute($args)) {
		$result["success"] = true;
		$row = $statement->fetch($fetch_style=$pdo::FETCH_ASSOC);
		$result['valid'] = $row['count'] != 0;
		$result['error'] = $result['valid'] ? '' : 'The combination is incorrect.';
	}
	else {
		$result["success"] = false;
		$result["error"] = $statement->errorInfo();
	}
	echo json_encode($result);
});

$app->get('/isNewUser/:email', function($email) {
	global $pdo;
	$args [":email"] = $email;
	$statement = $pdo->prepare(
		"SELECT COUNT(*) AS count FROM Rating
			WHERE email = :email");
	if ($statement->execute($args)) {
		$result["success"] = true;
		$row = $statement->fetch($fetch_style=$pdo::FETCH_ASSOC);
		$result['newUser'] = $row['count'] == 0;
		#$result['error'] = $result['exists'] ? 'The username is taken' : '';
	}
	else {
		$result["success"] = false;
		$result["error"] = $statement->errorInfo();
	}
	echo json_encode($result);
});

$app->post('/addUser', function() {
	global $pdo;
	$args [":email"] = $_POST['email'];
	$args [":password"] = $_POST['password'];
	$statement = $pdo->prepare(
		"INSERT INTO Account (email, password)
		VALUES (:email, :password)");
	if ($statement->execute($args)) {
		$result['success'] = true;
	}
	else {
		$result['success'] = false;
		$result['error'] = $statement->errorInfo();
	}
	echo json_encode($result);
});

$app->post('/getMenu',function()
{
	global $pdo;
	$statement = $pdo->prepare(
		"SELECT * FROM Item");
	if ($statement->execute($args)) {
		$result['success'] = true;
		$result['menu'] = array();
		while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
		{
			if(array_key_exists($row['itemType'],$result['menu'])
			{
				$result['menu'][$row['itemType']] = array();
			}
			$result['menu'][$row['itemType']][] = $row['itemName'];
		}
	}
	else {
		$result['success'] = false;
		$result['error'] = $statement->errorInfo();
	}
	echo json_encode($result);
});

?>
