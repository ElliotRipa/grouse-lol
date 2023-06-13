<html>
<head>
	<link rel="icon" type="image/x-icon" href="/images/favicon.png">
</head>


<form action="changename.php" method="get">
	ID: <input type="text" name="id"><br>
	Name: <input type="text" name="name"><br>
<input type="submit">
</form>

</html>

<?php

$servername = "localhost";
$username = "website";
$password = "ne!JB9C2SK35";
$dbname = "media";


$id = $_GET["id"];
$name = $_GET["name"];


if($id & $name){

$name = stringify($name);

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "UPDATE movies
  SET name = $name
  WHERE id = $id";
  // use exec() because no results are returned
  $conn->exec($sql);
  $stmt = $conn->query("SELECT * FROM movies WHERE id = $id LIMIT 1");
  $result = $stmt->fetch();
  echo "Changed the name of movie nr " . $result[0] . " to " . $result[1];
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
}

function stringify($word) {

	$output = "'".$word."'";

	return $output;
}

?>
