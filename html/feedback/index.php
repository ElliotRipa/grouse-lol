<html>

<head>

	<title>Feedback</title>
	<link rel="stylesheet" href="/css/stylesheet.css">
	<link rel="icon" type="image/x-icon" href="/images/favicon.png">

</head>

<body>
<div id="header">Feedback</h1></div>
	<div class="main">

		<p>So you want to give me feedback, eh?<br>
                What? You think you're better than me?<br>
                You think you know better than me?<br>
                You gonna complain that grammatically speaking it should be
                "better than I" in both those sentences becuase of the hidden subclause?<br>
                Well, looks like I beat you to it.</p>

                <p>In all seriousness though, I welcome all feedback. If you're looking to
                recommend a movie to me, then I suggest going to this <a href="suggest-movie.php">link</a>


		<form action="index.php" method="get">
		Give me feedback: <input type="text" name="feedback"><br>
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


$feedback = $_GET["feedback"];



if($feedback and strlen($feedback) < 512){



	$feedback = stringify($feedback);

	$currentDate = date("Y-m-d");

	$currentDate = stringify($currentDate);


	try {
	  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	  // set the PDO error mode to exception
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  $sql = "INSERT INTO Feedback (dateRecieved, text, ip_address)
	  VALUES ($currentDate, $feedback, $ipaddress)";
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
