<?php  

define("DB_HOST", "localhost");
	define("DB_USERNAME", "root");
	define("DB_PASSWORD", "");
	define("DB_NAME", "test1");

$conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);

 

$sql = "SELECT * FROM ang ORDER BY id DESC";
$stmt = $conn->prepare($sql);
if($stmt->execute())
{
  while($row = $stmt->fetch(PDO::FETCH_ASSOC))
  {
    $y[] = $row;
  }
  echo json_encode($y);
}

?>
