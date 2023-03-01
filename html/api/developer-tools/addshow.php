<html>

<head>
<title>Add Show</title>
<link rel="stylesheet" href="/css/stylesheet.css">

</head>

<div id="header">
        Add Show!
</div>

<div class="main">

<form>

        <p>
                <label for="name">Show Name:</label>
                <input type="text" name="name">
        </p>
	<p>
		<label for "start_date"> Start Date:</label>
		<input type="text" name="start_date">
	</p>
        <p>
                <label for="end_name">End Date:</label>
                <input type="text" name="name">
        </p>
	<p>
		<label for "ended"> Ended:</label>
		<input type="text" name="ended">
	</p>
        <p>
                <label for="imdb_id">IMDB ID:</label>
                <input type="text" name="imdb_id">
        </p>
	<p>
		<label for "imdb_rating"> IMDB:</label>
		<input type="text" name="imdb_rating">
	</p>

	<input type="submit">

</form>

</div>

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

echo "<div class='main'>";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO shows (name, start_date".$specifiedFields.", date_checked)
  VALUES ($name, $start_date".$specifiedValues.", '".date("Y-m-d")."')";
  //use exec() because no results are returned
  $conn->exec($sql);
  echo "New record created successfully";
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
}
echo "</div>";

function stringify($word) {

	$output = "'".$word."'";

	return $output;
}

?>
