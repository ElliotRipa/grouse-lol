<html>

<head>
<title>Log Movie</title>
<link rel="stylesheet" href="/css/stylesheet.css">
<link rel="icon" type="image/x-icon" href="/images/favicon.png">

</head>

<div id="header">
        Log Movie!
</div>

<div class="main">

<form action="log-movie.php">

        <p>
                <label for="id"> Movie ID:</label>
                <input type="text" name="id">
        </p>
        <p>
                <label for="date">Date Watched:</label>
                <input type="text" name="date">
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

$id = $_GET["id"];
$date = $_GET["date"];

if($id & $date){

$date = stringify($date);

echo "<div class='main'>";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  $sql = "INSERT INTO WatchedMovies (movie, watched_date) VALUES ($id, $date)";

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
