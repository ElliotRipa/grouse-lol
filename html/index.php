<!DOCTYPE html>
<html>
<head>
<title>Grouse</title>
<link rel="stylesheet" href="/css/stylesheet.css">
<link rel="icon" type="image/x-icon" href="/images/favicon.png">

</head>

<div id=header>
	Grouse.lol
</div>
<div class=main>
	<h1>Hi!</h1>
	And welcome to the legendary website <a href="http://grouse.lol" class=rainbow>grouse.lol</a>! You're probably wondering what's here, aren't you?<br>
	That's a rhetorical question, you don't have to answer.<br>
	Well, this website is essentially just an unholy amalgamation of whatever ideas I (The eponymous Grouse) decide to throw together and put out there.<br>
	The one of the biggest scope would be my <a href="api/beta">API</a>, through which you can access a fairly large database of moives I've gathered over 
	some time. It is by no means complete, nor would I ever want it to be. Because its purpose is really just to serve as a watch-list for myself. One which
	I'll probably never finish, but I'll try.<br>
	I "recently" went through a pretty major redesign of this website, so if you want to see my throught process for this beautiful site, smash this mf-ing <a href="posts/aesthetic-overhaul">link</a>!<br>
	Okey, that's the main thing. So if you have any other cool ideas of what I should make, you can drop them at <a href="feedback">this here link</a>.
</div>

<div class="main">
	<h1>Links!</h1>
	Ok, so this is just a collection of links I've curated so I don't have to remember them or flood my bookmarks tab more than I already do.<br>
	<a href="https://twitter.com">Just a regular link to Twitter because I probably don't want to share my account.</a><br>
	<a href="http://torrent.grouse.lol">Also, here's a link you don't have to worry about :)</a>
</div>


<div class=main>
	<h1>TODOs</h1>
	So I have a lot of things planned, both for this site, and for life in general. So here's a TODO list. Please note that a lot of the ones in the second section aren't all that serious,
	but hopefully you'd be able to figure that out by yourself.


<?php
class Todos

{

function getUnfinishedAdultTodos() {

		$pdo = getPDO();

		$sql	= "SELECT t.* FROM todos t LEFT OUTER JOIN finished_todos ut ON t.id = ut.id LEFT OUTER JOIN child_todos ct on t.id = ct.id WHERE ut.id IS NULL AND ct.id IS NULL";

		$stmt	= $pdo->prepare($sql);

		$stmt->execute($data);

		$todos = [];


		echo "<br>";

		while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

			$todos[$row['id']] = $row;
			//print_r($row);
			//echo "<br>";

		}

		$response['data'] = $todos;

		print_r($todos[1]['todo']);

		return $todos;

}
}


function getUnfinishedChildTodos() {


$pdo = getPDO();

                $sql    = "SELECT t.*, ct.parent_id FROM child_todos ct LEFT JOIN todos t ON ct.id = t.id LEFT OUTER JOIN finished_todos ft ON ct.id = ft.id WHERE ft.id IS NULL";

                $stmt   = $pdo->prepare($sql);

                $stmt->execute($data);

                $todos = [];


                echo "<br>";

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

                        $todos[$row['id']] = $row;

                }

                $response['data'] = $todos;

                return $todos;



}



function getPDO() {

	try {

		$configFile = fopen("actual-secrets/config.config", "r") or die("File not found exception");

		$db_name = trim(fgets($configFile));

		$db_user = trim(fgets($configFile));

		$db_password = trim(fgets($configFile));

		$db_host = trim(fgets($configFile));

		fclose($configFile);


                $pdo = new PDO('mysql:host=' . $db_host . '; dbname=' . $db_name, $db_user, $db_password);

                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

		return $pdo;

	} catch (PDOException $ex) {

		$error = [];

		$error['message'] = $ex->getMessage();

		echo "<br>Something went wrong creating PDO.</br>";

		return $error;

	}

}

function printTodosByCategory($todos, $category) {


echo "<ul>";

foreach($todos as &$todo) {
if($todo['category'] == $category) {

	echo "<li> " . $todo['todo'] . "</li>";

	if(isset($todo['children'])) {

		echo "<ul>";

		foreach($todo['children'] as &$childTodo) {

			echo "<li>" . $childTodo['todo'] . "</li>";

		}

		echo "</ul>";

	}

}
}

echo "</ul>";

}

$todos = new Todos();

$todos = $todos->getUnfinishedAdultTodos();

$childTodos = getUnfinishedChildTodos();


foreach($childTodos as &$childTodo) {

	$parentId = $childTodo['parent_id'];

	if(isset($todos[$parentId])) {

		$todos[$parentId]['children'][$childTodo['id']] = $childTodo;

	}

}

//print_r($todos);

echo "<h2>Website Related:</h2>";
printTodosByCategory($todos, "website");
echo "<h2>Non-website-related:</h2>";
printTodosByCategory($todos, "");


?>

<html>
