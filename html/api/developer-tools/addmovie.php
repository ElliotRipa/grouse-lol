<html>

<form action="addmovie.php" method="get">
	Name: <input type="text" name="name"><br>
	Release Date: <input type="text" name="release_date"><br>
	IMDB Rating: <input type="text" name="imdb_rating"><br>
	IMDB id: <input type="text" name="imdb_id"><br>
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

$possibleFields = ["source", "path", "imdb_id", "imdb_rating"];
$specifiedFields = "";
$specifiedValues = "";

$name = $_GET["name"];
$release_date = $_GET["release_date"];

foreach($possibleFields as $field) {

	$temp = $_GET[$field];
	if($temp) {
		$specifiedFields .= ", ".$field;
		$specifiedValues .= ", ".stringify($temp);
	}

}


if($name & $release_date){

$name = stringify($name);
$release_date = stringify($release_date);

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO movies (name, release_date".$specifiedFields.")
  VALUES ($name, $release_date".$specifiedValues.")";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully";
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
