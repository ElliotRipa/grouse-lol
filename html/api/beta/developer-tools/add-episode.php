<html>

<head>
<title>Add Episode</title>
<link rel="stylesheet" href="/css/stylesheet.css">
<link rel="icon" type="image/x-icon" href="/images/favicon.png">

</head>

<div id="header">
	Add Episode!
</div>

<div class="main">

NOTE!<br>
This adds into the new version of the database.<br>
Also, no I don't know why that field is doing that either.

<form>

	<p>
		<label for="show">Show ID:</label>
		<input type="text" name="show">
	</p>
	<p>
		<label for="name">Episode Name:</label>
		<input type="text" name="name">
	</p>
	<p>
		<label for="release_date">Release Date:</label>
		<input type="text" name="release_date">
	</p>
	<p>
		<label for="season">Season:</label>
		<input type="text" name="season">
	</p>
	<p>
		<label for="episode">Episode: <label>
		<input type="text" name="episode">
	</p>
	<p>
		<label for="imdb_rating">IMDB Rating:</label>
		<input type="text" name="imdb_rating">
	</p>
	<p>
		<label for="imdb_id">IMDB ID:</label>
		<input type="text" name="imdb_id">
	</p>

	<input type="submit">

</form>

</div>

<script>
var close = document.getElementsByClassName("closebtn");
var i;

for (i = 0; i < close.length; i++) {
  close[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>

</html>

<?php

$servername = "localhost";
$username = "website";
$password = "ne!JB9C2SK35";
$dbname = "media2";

$possibleFields = ["season", "episode", "imdb_id", "imdb_rating"];
$specifiedFields = "";
$specifiedValues = "";

$name = $_GET["name"];
$release_date = $_GET["release_date"];
$show = $_GET["show"];

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

// echo "<div class='main'>";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "INSERT INTO Episodes (name, release_date, `show`".$specifiedFields.")
  VALUES ($name, $release_date, $show".$specifiedValues.")";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "<div class='success-alert'>";
  echo "New record created successfully";
  echoLastEpisode($conn);
} catch(PDOException $e) {
  echo "<div class='error-alert'>";
  echo $sql . "<br>" . $e->getMessage();
}

$conn = null;
}
echo "</div>";


function stringify($word) {

	$output = "'".$word."'";

	return $output;
}

function echoLastEpisode($conn) {

	$stmt = $conn->query("SELECT * FROM Episodes ORDER BY id DESC LIMIT 1");
	$result = $stmt->fetch();

	echo "<br>";

	print_r($result);

	return;
}

?>
