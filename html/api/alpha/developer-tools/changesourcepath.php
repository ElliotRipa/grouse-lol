<html>

<form action="changesourcepath.php" method="get">
	ID: <input type="text" name="id"><br>
	Source: <input type="text" name="source"><br>
	Path: <input type="text" name="path"><br>
<input type="submit">
</form>

</html>

<?php

$servername = "localhost";
$username = "website";
$password = "ne!JB9C2SK35";
$dbname = "media";


$id = $_GET["id"];
$source = $_GET["source"];
$path = $_GET["path"];


if($id & $path & $source){

$source = stringify($source);
$path = stringify($path);

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "UPDATE movies
  SET path = $path, source = $source
  WHERE id = $id";
  // use exec() because no results are returned
  $conn->exec($sql);
  $stmt = $conn->query("SELECT * FROM movies WHERE id = $id LIMIT 1");
  $result = $stmt->fetch();
  echo "Changed the source and path of movie nr " . $result[0] . " named " . $result[1] . " to " . $result[3] . " and " . $result[4];
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
