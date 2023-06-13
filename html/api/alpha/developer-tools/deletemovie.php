<html>
<head>
	<link rel="icon" type="image/x-icon" href="/images/favicon.png">
</head>


<form action="deletemovie.php" method="get">
	ID: <input type="text" name="id"><br>
<input type="submit">
</form>

</html>

<?php

$servername = "localhost";
$username = "website";
$password = "Enter Password Here";
$dbname = "media";


$id = $_GET["id"];

if($id){

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $sql = "DELETE FROM movies
  WHERE id = $id";
  // use exec() because no results are returned
  $conn->exec($sql);
  echo "Deleted movie number " . $id;
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
