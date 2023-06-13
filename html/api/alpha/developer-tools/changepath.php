<html>
<head>
	<link rel="icon" type="image/x-icon" href="/images/favicon.png">
</head>


<form action="changepath.php" method="get">
	ID: <input type="text" name="id"><br>
	Path: <input type="text" name="path"><br>
<input type="submit">
</form>

</html>

<?php

$servername = "localhost";
$username = "website";
$password = "Enter Password Here";
$dbname = "media";


$id = $_GET["id"];
$path = $_GET["path"];


if($id & $path){

$path = stringify($path);

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "UPDATE movies
  SET path = $path
  WHERE id = $id";
  // use exec() because no results are returned
  $conn->exec($sql);
  $stmt = $conn->query("SELECT * FROM movies WHERE id = $id LIMIT 1");
  $result = $stmt->fetch();
  echo "Changed the path of movie nr " . $result[0] . " named " . $result[1] . " to " . $result[4];
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
