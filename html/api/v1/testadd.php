<html>

<form action="testadd.php" method="get">
	Name: <input type="text" name="name"><br>
	Release Date: <input type="text" name="releasedate"><br>
	IMDB id: <input type="text" name="imdbid"><br>
	IMDB Rating: <input type="text" name="imdbrating"><br>
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

$possibleFields = ["source", "path", "imdbid", "imdbrating"];
$specifiedFields = "";
$specifiedValues = "";

$name = $_GET["name"];
$releasedate = $_GET["releasedate"];

foreach($possibleFields as $field) {

	$temp = $_GET[$field];
	if($temp) {
		$specifiedFields .= ", ".$field;
		$specifiedValues .= ", ".stringify($temp);
	}

}


if($name & $releasedate){

$name = stringify($name);
$releasedate = stringify($releasedate);

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO movies (name, releasedate".$specifiedFields.")
  VALUES ($name, $releasedate".$specifiedValues.")";
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
