<?php  

define("DB_HOST", "localhost");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "test1");

$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
$http_data = json_decode(file_get_contents("php://input"));

$x = array(
 ':name'  => $http_data->name,
 ':phone'  => $http_data->phone,
 ':id'    => $http_data->id
);

$sql = "
 UPDATE ang 
 SET name = :name, phone = :phone 
 WHERE id = :id
";

$stmt = $conn->prepare($sql);
$stmt->execute($x)
?>