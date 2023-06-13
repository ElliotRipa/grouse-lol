<html>

<head>
<title>Add Source</title>
<link rel="stylesheet" href="/css/stylesheet.css">
<link rel="icon" type="image/x-icon" href="/images/favicon.png">

</head>

<div id="header">
        Add Source!
</div>

<div class="main">

<form action="add-source.php">

        <p>
                <label for="id"> Movie ID:</label>
                <input type="text" name="id">
        </p>
	<p>
		<label for "type"> Source Type:</label>
		<select name="type" id="type">
			<option value="Downloaded">Downloaded</option>
			<option value="YouTube">YouTube</option>
			<option value="Netflix">Netflix</option>
			<option value="Cineasterna">Cineasterna</option>
			<option value="Link">Link</option>
		</select>
	</p>
        <p>
                <label for="source">Source:</label>
                <input type="text" name="source">
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

$possibleTypes = ["Downloaded", "YouTube", "Netflix", "Cineasterna", "Link"];
$tables = ["DownloadedMovies", "YouTubeMovies", "NetflixMovies", "CineasternaMovies", "LinkedMovies"];
$headers = ["path", "youtube_id", "netflix_id", "cineasterna_id", "link"];

$specifiedFields = "";
$specifiedValues = "";

$id = $_GET["id"];
$type = $_GET["type"];
$source = $_GET["source"];

$isSourceFilled = ($source != "");

$index = array_search($type, $possibleTypes);

$table = $tables[$index];
$header = $headers[$index];



if($id){

$source = stringify($source);

echo "<div class='main'>";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  if($isSourceFilled) {
  $sql = "INSERT INTO ".$table." (movie, $header) VALUES ($id, $source)";
} else {
  $sql = "INSERT INTO ".$table." (movie) VALUES ($id)";
}

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
