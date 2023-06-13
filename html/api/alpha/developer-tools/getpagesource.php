<head>
	<link rel="icon" type="image/x-icon" href="/images/favicon.png">
</head>

<?php


$servername = "localhost";
$username = "website";
$password = "";
$dbname = "media";


try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  $stmt = $conn->query("SELECT COUNT(id) FROM movies");
  $result = $stmt->fetch();
  $nr_of_movies = $result[0];
  echo "<br>";
  //for($i = 1 ; $i <= $result[0], $i++) {
  $i = 1;

  $starttime = microtime(true);

  for ($i = 1 ; $i <= $nr_of_movies ; $i++) {
  	$stmt = $conn->query("SELECT imdb_id FROM movies WHERE id = $i LIMIT 1");
	$result = $stmt->fetch();
	//echo $result[0];
	//echo "<br>";
	$movie_length = get_movie_length($result[0]);
	//echo $movie_length;
	if($movie_length) {
		$conn->exec("UPDATE movies SET length = '$movie_length' WHERE id = $i");
	} else {
	echo "Movie with id number ".$i." erred.<br>";
	}
}

  $endtime = microtime(true);

  echo $endtime-$starttime;

  //}
} catch(PDOException $e) {
  echo $sql . "<br>" . $e->getMessage();
}

echo "Done!";
$conn = null;



//echo get_movie_length("tt0120915");




function get_movie_length(string $imdb_id) {

	$text = file_get_contents('https://www.imdb.com/title/'.$imdb_id.'/', 1, null, 0, 10000);

//	echo htmlspecialchars($text);

	$pos = strpos($text, '],"duration":') + 14;

	if($pos == FALSE) {
		return FALSE;
	}

	return htmlspecialchars(read_until_quotationmark($text, $pos));

}



function read_until_quotationmark(string $text, int $start_index) {
	$quote_pos = strpos($text, '"', $start_index);

	$word_length = $quote_pos-$start_index;

	return substr($text, $start_index, $word_length);
}

?>
