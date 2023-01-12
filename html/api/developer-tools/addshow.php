<html>

<form action="addshow.php" method="get">
	Name: <input type="text" name="name"><br>
	Start Date: <input type="text" name="start_date"><br>
	End Date: <input type="text" name="end_date"><br>
	Ended: <input type="text" name="ended"><br>
	IMDB id: <input type="text" name="imdb_id"><br>
	IMDB Rating: <input type="text" name="imdb_rating"><br>
<input type="submit">
</form>

</html>

<?php

$servername = "localhost";
$username = "website";
$password = "ne!JB9C2SK35";
$dbname = "media";

$possibleFields = ["end_date", "ended", "imdb_id", "imdb_rating"];
$specifiedFields = "";
$specifiedValues = "";

$name = $_GET["name"];
$start_date = $_GET["start_date"];

foreach($possibleFields as $field) {

	$temp = $_GET[$field];
	if($temp) {
		$specifiedFields .= ", ".$field;
		$specifiedValues .= ", ".stringify($temp);
	}

}


if($name & $start_date){

$name = stringify($name);
$start_date = stringify($start_date);

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO shows (name, start_date".$specifiedFields.", date_checked)
  VALUES ($name, $start_date".$specifiedValues.", '2023-01-12')";
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
