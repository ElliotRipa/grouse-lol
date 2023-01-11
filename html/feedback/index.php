<html>

<head>

	<title>Feedback</title>
	<link rel="stylesheet" href="/css/stylesheet.css">

</head>

<body>
<div id="header">Feedback</h1></div>
	<div>

		<p>So you want to give me feedback, eh?<br>
                What? You think you're better than me?<br>
                You think you know better than me?<br>
                You gonna complain that grammatically speaking it should be
                "better than I" in both those sentences becuase of the hidden subclause?<br>
                Well, looks like I beat you to it.</p>

                <p>In all seriousness though, I welcome all feedback. If you're looking to
                recommend a movie to me, then I suggest going to this <a href="Okay so I haven't made that website yet, but I'm working on it, trust me">link</a>


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

$feedback = $_GET["feedback"];



if($feedback and strlen($feedback) < 512){



	$feedback = stringify($feedback);

	$currentDate = date("Y-m-d");

	$currentDate = stringify($currentDate);


	try {
	  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	  // set the PDO error mode to exception
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  $sql = "INSERT INTO Feedback (dateRecieved, text)
	  VALUES ($currentDate, $feedback)";
	  // use exec() because no results are returned
	  $conn->exec($sql);
	  echo "Sent!";
	} catch(PDOException $e) {
	  echo $sql . "<br>" . $e->getMessage();
	}



}



$conn = null;


function stringify($word) {

	$output = str_replace("'", "''", $word);

	$output = "'".$output."'";


	return $output;
}

?>
