


<?php

$servername = "localhost";
$username = "website";
$password = "";
$dbname = "media2";

$file = fopen("", "r");

$errorList = [];

$entryCount = 0;

if($file !== FALSE) {
	print "<PRE>";
	while(! feof($file)) {
		$data = fgetcsv($file, 1000, ",");
		if(!empty($data)) {

			$addsource = True;
			switch($data[7]):
				case "Y":
					$source = "Downloaded";
					break;
				case "N":
					$source = "Netflix";
					break;
				case "YT":
					$source = "YouTube";
					break;
				case "C":
					$source = "Cineasterna";
					break;
				case "L":
					$source = "Link";
					break;
				default:
					$source = "";
			endswitch;

			$name = str_replace("'", "''", $data[0]);

			if($source) {
				$sql = "INSERT INTO movies (name, release_date, season, episode, imdb_rating, imdb_id, show, source) VALUES ('". $name . "', '" . $data[1] . "', '" . $data[2] . "', '" . $data[3] . "', '" . $data[4] . "', '" . $data[5] . "', '" . $data[6] . "', '" . $source . "')";
			} else {
				$sql =  "INSERT INTO movies (name, release_date, imdb_rating, imdb_id) VALUES ('". $name . "', '" . $data[1] . "', '" . $data[2] . "', '" . $data[3] . $data[4] . "', '" . $data[5] . "', '" . $data[6] . "')";
			}

			try {
				$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			 	// set the PDO error mode to exception
			 	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			 	// use exec() because no results are returned
			 	$conn->exec($sql);
				$entryCount++;
			 	echo "Successfully added entry ". $entryCount . "<br>";
			} catch(PDOException $e) {
				array_push($errorList, $sql . $e->getMessage());
			}

			$conn = null;

		}

	}

}

fclose($file);

echo "<br>The following entrys erred:<br>";
foreach($errorList as $error) {
	echo $error;
	echo "<br>";
}

?>
