<html>

<head>

	<title>Suggest Movie</title>
	<link rel="stylesheet" href="/css/stylesheet.css">

</head>

<body>
<div id="header">Suggest Movie</h1></div>
	<div class="main">

		<p>Hi, please give me any and all movie suggestions. They don't have to be good, but I appreciate it if they are. :)</p>

		<form action="suggest-movie.php" method="get">
		Movie: <input type="text" name="movie"><br>
		<input type="submit">

		</form>

	</div>

</body>

</html>

<?php

$servername = "localhost";
$username = "website";
$password = "ne!JB9C2SK35";
$dbname = "feedback";

$ipaddress = getenv("REMOTE_ADDR") ;
$ipaddress = stringify($ipaddress);


$movie = $_GET["movie"];



if($movie and strlen($movie) < 512){


	$movie = stringify($movie);

	try {
	  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	  // set the PDO error mode to exception
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  $sql = "INSERT INTO MovieSuggestions (dateRecieved, suggestion, ip_address)
	  VALUES (CURRENT_TIMESTAMP, $movie, $ipaddress)";
	  // use exec() because no results are returned
	  $conn->exec($sql);
	  echo "<div class=main>" . "Sent!" . "</div>";
	} catch(PDOException $e) {
	  echo "<div class=main>" . $sql . "<br>" . $e->getMessage() . "</div>";
	}



}



$conn = null;


function stringify($word) {

	$output = str_replace("'", "''", $word);

	$output = "'".$output."'";


	return $output;
}

?>
