<?php


//Dags att definiera några funktioner

function createdeck(){

	$deck = array();

	for($i = 1 ; $i < 14 ; $i++) {
		
		$current = "c" . $i;
		array_push($deck , $current);

	}

	for($i = 1 ; $i < 14 ; $i++) {
		
		$current = "d" . $i;
		array_push($deck , $current);

	}

	for($i = 1 ; $i < 14 ; $i++) {
		
		$current = "h" . $i;
		array_push($deck , $current);

	}

	for($i = 1 ; $i < 14 ; $i++) {
		
		$current = "s" . $i;
		array_push($deck , $current);

	}
	
return $deck;

}


function createreference(){

	$refref = array("Ace" , "Two" , "Three" , "Four" , "Five" , "Six" , "Seven" , "Eight" , "Nine" , "Ten" , "Jack" , "Queen" , "King");
	$deck = array();

	for($i = 0 ; $i < 13 ; $i++) {
		
		$current = $refref[$i] . " of Clubs";
		array_push($deck , $current);

	}

	for($i = 0 ; $i < 13 ; $i++) {
		
		$current = $refref[$i] . " of Diamonds";
		array_push($deck , $current);

	}

	for($i = 0 ; $i < 13 ; $i++) {
		
		$current = $refref[$i] . " of Hearts";
		array_push($deck , $current);

	}

	for($i = 0 ; $i < 13 ; $i++) {
		
		$current = $refref[$i] . " of Spades";
		array_push($deck , $current);

	}
	
return $deck;

}


function distribute($number, $deck) {
	
	$hand = array();
	$phpsucks = array();
	
	for($i = 0 ; $i != $number ; $i++) {
		
		$cardnum = $deck[rand(0, count($deck)-1)];
		array_push($hand , $cardnum);
		unset($deck[array_search($cardnum, $deck)]);
		$deck = array_values($deck);

		$phpsucks[0] = $hand;
		$phpsucks[1] = $deck;
		
	}
	
	return $phpsucks;
	
}

function checkflush($hand, $table) {
	
	//Kombinera korten i handen och på bordet till $allcards
	$allcards = $hand;
	foreach($table as $i) {
		array_push($allcards, $i);
	}
	
	
	
	sort($allcards);
	
	$clubs = 0;
	$diamonds = 0;
	$hearts = 0;
	$spades = 0;
	
	//Räkna antalet instanser av varje färg
	foreach($allcards as $card) {
		
		if($card[0] == "c") {
			$clubs++;
		}
		if($card[0] == "d") {
			$diamonds++;
		}
		if($card[0] == "h") {
			$hearts++;
		}
		if($card[0] == "s") {
			$spades++;
		}
	}
	
		//Kolla om det finns minst fem av någon
		if($clubs > 4) {
			return 1;
		}
		elseif($diamonds > 4) {
			return 2;
		}
		elseif($hearts > 4) {
			return 3;
		}
		elseif($spades > 4) {
			return 4;
		}
		else {
			return 0;
		}
		
	
	//Printa korten (Görs inte nu)
	printf("<pre>");
	print_r($allcards);
	printf("</pre>");
	
}


function checkstraight($hand, $table) {
	
	//Kombinera korten i handen och på bordet till $allcards
	$allcards = $hand;
	foreach($table as $i) {
		array_push($allcards, $i);
	}
	
	//Omvandla dem till valörer
	for($i = 0 ; $i < count($allcards) ; $i++) {
		$allcards[$i] = ltrim($allcards[$i], $allcards[$i][0]);
		preg_replace( "/\r|\n/", "", $allcards[$i]);
		$allcards[$i] = (int)$allcards[$i];
	}
	
	//Ta bort dubbletter
	$allcards = array_unique($allcards);
	$allcards = array_merge($allcards);
	
	sort($allcards, SORT_NUMERIC);
	
	//Definiera "flaggor"
	$lastcard = -1;
	$consecutive = 0;
	
	
	//Kolla om korten kommer i rad
	foreach($allcards as $card) {
		
		if($card == $lastcard+1) {

			$consecutive++;

		} else {
			
			$consecutive = 0;
			
		}
		
		if($consecutive == 4) {
			
			return $lastcard;
			
		}
		
		$lastcard = $card;
		
		
	}
	
	//Omvandla värden på ess till 14 för att kunna ligga brevid kungen
	for($i = 0 ; $i<=count($allcards)-1 ; $i++) {
		
		if($allcards[$i] == 1) {
			$allcards[$i] = 14;
		}
		
	}
	
	//Kolla igen
	sort($allcards, SORT_NUMERIC);
	
	$consecutive = 0;
	$lastcard = -1;
	foreach($allcards as $card) {
		
		if($card == $lastcard+1) {

			$consecutive++;

		} else {
			
			$consecutive = 0;
			
		}
		
		if($consecutive == 4) {
			
			return $lastcard;
			
		}
		
		$lastcard = $card;
		
		
	}
	return False;
	
	printf("<pre>");
	print_r($allcards);
	printf("</pre>");
	
}


function checkfours($hand, $table) {
	
	//Kombinera korten i handen och på bordet till $allcards
	$allcards = $hand;
	foreach($table as $i) {
		array_push($allcards, $i);
	}
	
	//Omvandla dem till valörer
	for($i = 0 ; $i < count($allcards) ; $i++) {
		$allcards[$i] = ltrim($allcards[$i], $allcards[$i][0]);
	}	
	
	//Sortera korten
	sort($allcards, SORT_NUMERIC);
	
	
	$number = 0;
	$lastcard = -1;
	foreach($allcards as $card) {
		
		if($card == $lastcard) {
			
			$number++;
			
		} else {
			
			$number = 0;
		}
		
		if($number == 3) {
			
			return $card;
			
		}
		
		$lastcard = $card;
		
		
	}
	
	
}


function checkthrees($hand, $table) {
	
	//Kombinera korten i handen och på bordet till $allcards
	$allcards = $hand;
	foreach($table as $i) {
		array_push($allcards, $i);
	}
	
	//Omvandla dem till valörer
	for($i = 0 ; $i < count($allcards) ; $i++) {
		$allcards[$i] = ltrim($allcards[$i], $allcards[$i][0]);
	}	
	
	//Omvandla värden på ess till 14 för att kunna ligga brevid kungen
	for($i = 0 ; $i<=count($allcards)-1 ; $i++) {
		
		if($allcards[$i] == 1) {
			$allcards[$i] = 14;
		}
		
	}	
	
	//Sortera korten
	sort($allcards, SORT_NUMERIC);
	
	
	$number = 0;
	$lastcard = -1;
	foreach($allcards as $card) {
		
		if($card == $lastcard) {
			
			$number++;
			
		} else {
			
			$number = 0;
		}
		
		if($number == 2) {
			
			return $card;
			
		}
		
		$lastcard = $card;
		
		
	}
	
	
}


function checkpair($hand, $table) {
	
	//Kombinera korten i handen och på bordet till $allcards
	$allcards = $hand;
	foreach($table as $i) {
		array_push($allcards, $i);
	}
	
	//Omvandla dem till valörer
	for($i = 0 ; $i < count($allcards) ; $i++) {
		$allcards[$i] = ltrim($allcards[$i], $allcards[$i][0]);
	}	
	
	//Omvandla värden på ess till 14 för att vara värd mer
	for($i = 0 ; $i<=count($allcards)-1 ; $i++) {
		
		if($allcards[$i] == 1) {
			$allcards[$i] = 14;
		}
		
	}
	
	//Sortera korten
	sort($allcards, SORT_NUMERIC);
	
	
	$lastcard = -1;
	foreach($allcards as $card) {
		
		if($card == $lastcard) {
			
			return $card;
			
		}
		
		
		$lastcard = $card;
		
		
	}
	
	
}


function checksecondpair($hand, $table, $exclusion) {
	
	//Kombinera korten i handen och på bordet till $allcards
	$allcards = $hand;
	foreach($table as $i) {
		array_push($allcards, $i);
	}
	
	//Omvandla dem till valörer
	for($i = 0 ; $i < count($allcards)-1 ; $i++) {
		$allcards[$i] = ltrim($allcards[$i], $character_mask = $allcards[$i][0]);
	}
	
	//Omvandla värden på ess till 14 för att kunna ligga brevid kungen
	for($i = 0 ; $i<=count($allcards)-1 ; $i++) {
		
		if($allcards[$i] == 1) {
			$allcards[$i] = 14;
		}
		
	}
	
	//Sortera korten
	sort($allcards, SORT_NUMERIC);
	
	
	$lastcard = -1;
	foreach($allcards as $card) {
		if($card == $lastcard) {
			
			if($card != $exclusion) {
				return $card;
			}
			
		}
		
		
		$lastcard = $card;
		
		
	}
	
	
}

function checkroyal($hand, $table) {
	
	//Kombinera korten i handen och på bordet till $allcards
	$allcards = $hand;
	foreach($table as $i) {
		array_push($allcards, $i);
	}
	
	//Omvandla dem till valörer
	for($i = 0 ; $i < count($allcards)	; $i++) {
		$allcards[$i] = ltrim($allcards[$i], $character_mask = $allcards[$i][0]);		
	}
	
	//Ta bort kopior, Sortera korten, Placera ess som 14, och Ta bort kort under 10
	$allcards = array_unique($allcards);
	sort($allcards, SORT_NUMERIC);
	
	
	//Omvandla värden på ess till 14 för att kunna ligga brevid kungen
	for($i = 0 ; $i < count($allcards) ; $i++) {
		
		if($allcards[$i] == 1) {
			$allcards[$i] = 14;
		}
		
	}	
	
	
	for($i = 0 ; $i <= count($allcards)-1 ; $i++) {
		
		if($allcards[$i] < 10) {
			
			unset($allcards[$i]);
			
		}
		
	}
	
	if(count($allcards) >= 5) {
		
		return True;
		
	}
	
}


function checkhand($hand, $table) {
	
	//Definiera handvärde samt sekundärt värde
	$value = 0;
	$secondary = 0;
	$tertiary = 0;
	
	
	//Kolla Par
	
	if(checkpair($hand, $table) > 0) {
		
		$value = 1;
		$secondary = checkpair($hand, $table);
		
	}
	
	//Kolla Två Par
	
	if(checkpair($hand, $table) > 0) {
		
		if(checksecondpair($hand, $table, checkpair($hand, $table)) > 0) {
			
			$value = 2;
			
			if(checkpair($hand, $table) == 1) {
				
				$secondary = 14;
				
			} else {
				
				$secondary = checksecondpair($hand, $table, checkpair($hand, $table));
				
			}
			
		}
		
	}
	
	//Kolla Tretal
	
	if(checkthrees($hand, $table) > 0) {
		
		$value = 3;
		
		if(checkthrees($hand, $table) == 1) {
				
			$secondary = 14;
			
		} else {
			
			$secondary = checkthrees($hand, $table);
			
		}
		
	}
	
	//Kolla Straight
	
	if(checkstraight($hand, $table) > 0) {
		
		$value = 4;
		$secondary = checkstraight($hand, $table);
		
	}
	
	//Kolla Flush
	
	if(checkflush($hand, $table) > 0) {
		
		$value = 5;
		$secondary = checkflush($hand, $table);
	}
	
	//Kolla Full House
	
	if(checkthrees($hand, $table) > 0) {
		
		if(checksecondpair($hand, $table, checkthrees($hand, $table)) > 0) {
			
			$value = 6;
			
			if(checkthrees($hand, $table) > checksecondpair($hand, $table, checkthrees($hand, $table))) {
				
				$secondary = checkthrees($hand, $table);
				
			} else {
				
				$secondary = checksecondpair($hand, $table, checkthrees($hand, $table));
				
			}
			
		}
		
	}
	
	//Kolla Fyrtal
	
	if(checkfours($hand, $table) > 0) {
		
		$value = 7;
		
		if(checkfours($hand, $table) == 1) {
				
			$secondary = 14;
			
		} else {
			
			$secondary = checkfours($hand, $table);
			
		}
		
	}
	
	//Kolla Straight Flush
	
	if(checkstraight($hand , $table) > 0) {
		
		if(checkflush($hand, $table) > 0) {
			
			$value = 8;
			
			$secondary = checkstraight($hand , $table);
			
			$tertiary = checkflush($hand , $table);
			
		}
		
	}
	
	//Kolla Royal Flush
	
	if(checkflush($hand, $table) > 0) {

		if(checkstraight($hand, $table) > 0) {

			if(checkroyal($hand, $table) > 0) {
				
				$value = 9;
				$secondary = checkflush($hand , $table);
				
			}

		}

	}		
	
	//Kombinera value och secondary
	if(floor($value) == 5 or $value == 9) {
		
		$value = $value + (($secondary+1) / 8);
		
	} else {
		
		$value = (int)$value + (((int)$secondary+1) / 16);
		
	}
	
	
	return $value;
	
	
}

function printcard($card) {
	
	printf("<img src='images/cards/%s.png' width=128px", $card);
	
}


function comparecards($h1, $h2, $h3, $h4, $h5, $h6) {
	
	$array = array($h1, $h2, $h3, $h4, $h5, $h6);
	
	$pointsmax = max($array);
	
	$winner = null;
	
	for($i = 0 ; $i < 6 ; $i++) {
		
		if($array[$i] == $pointsmax) {
			
			if(is_array($winner)) {
				
				array_push($winner , $i);
				
			} elseif(isset($winner) == False) {
				
				$winner = $i;
				
			} else {
				
				$winner = array($winner, $i);
				
			}
			
		}
		
	}
	
	$return = array($winner, $pointsmax);
	return $return;
}

function printvalue($value, $coolerref, $colourref) {
	
	if(floor($value) == 1) {
		
		$mod = ($value-floor($value))*16;
		
		printf("a pair of %ss",$coolerref[$mod-1]);
	}
	
	if(floor($value) == 2) {
		
		$mod = ($value-floor($value))*16;
		
		printf("two pairs, with the highest one being of %ss",$coolerref[$mod-1]);
	}
	
	if(floor($value) == 3) {
		
		$mod = ($value-(floor($value)))*16;
		
		printf("three %ss",$coolerref[$mod-1]);
	}
	
	if(floor($value) == 4) {
		
		$mod = ($value-floor($value))*16;
		
		printf("a straight going from %s to %s",$coolerref[$mod-4], $coolerref[$mod]);
	}
	
	if(floor($value) == 5) {
		
		$mod = ($value-floor($value))*8;
		
		printf("a flush of %s",$colourref[$mod-1]);
	}
	
	if(floor($value) == 6) {
		
		$mod = ($value-floor($value))*16;
		
		printf("a full house with the highest card being the %s", $coolerref[$mod-1]);
	}
	
	if(floor($value) == 7) {
		
		$mod = ($value-floor($value))*16;
		
		printf("four %ss", $coolerref[$mod-1]);
		
	}
	
	if(floor($value) == 8) {
		
		$mod = ($value-floor($value))*16;
		
		printf("a straight flush going from %s to %s",$coolerref[$mod-4], $coolerref[$mod]);
		
	}
	
	if(floor($value) == 9) {
		
		$mod = ($value-floor($value))*8;
		
		printf("royal flush of the suit %s",$colourref[$mod-1]);
		
	}
	
}

function printsecret($num) {
	
	printf("<br>Player %d has two cards<br>", $num);
	printcard("back");
	printf("<br>");
	printcard("back");
	printf("<br>");
}



//Nu börjar saker faktiskt hända



$deck = createdeck();
$name = createreference();

$refdeck = $deck;
$refname = $name;

//Några av namnen här är skumma eftersom jag provtestade vid ett tillfälle, och tog aldrig bort dem, dock dyker de aldrig upp. ¯\_(ツ)_/¯
$coolerref = array("Ace", "Ace", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine", "Ten", "Jack", "Queen", "King", "Ace", "Ace");
$colourref = array("ClubsFake", "Clubs", "Diamonds", "Hearts", "Spades");


for($i = 1 ; $i != 7 ; $i++) {
	
	$hand[$i] = distribute(2, $deck);
	$deck = $hand[$i][1];
	$hand[$i] = $hand[$i][0];
	
}




//Lägger ut 3 kort på bordet
$table = distribute(3, $deck);
$deck = $table[1];
$table = $table[0];





//Visa endast knappen då inget steg har nåtts

if(!isset($_POST['transparent']) and !isset($_POST['normal']) and !isset($_POST['stage2']) and !isset($_POST['stage3']) and !isset($_POST['stage4'])) {
	
	if(isset($_POST['moneygen'])) {
		
		$file = "money.txt";
		$c = fopen($file, "w+");
		fprintf($c, "1\r\n");
		fprintf($c, "100\r\n");
		fclose($c);
	}
	
	//Skapa dock pengar först om de inte finns
	$file = "money.txt";

	if(file_exists($file)) {
		$c = fopen($file, "r+");
		fprintf($c, "1\r\n");
		$money = fgets($c);
	} else {
		$c = fopen($file, "w+");
		fprintf($c, "1\r\n");
		fprintf($c, "100\r\n");
	}
	
	printf("<pre>



</pre>
<h1>POKER</h1>
<pre>

</pre>
You have $%s<br>
<pre>
</pre>
<form method=post action=poker.php>
<input type=submit name=transparent value='Play with transparency'>
<p>
<input type=submit name=normal value='Play like a man'><p>", $money);

if($money <= 10) {
	
	printf("<input type=submit name=moneygen value='Print more money'>");
	
}
printf("</form>");
}

if(isset($_POST['transparent'])) {
	
	$secret = False;
	$stageone = True;
	
} 

if(isset($_POST['normal'])){
	
	$secret = True;
	$stageone = True;
	
}

printf("<b><style>body {
	background-color: #000000;
	color: #ffffff;
	text-align: center;
	font-family: Arial, Helvetica, sans-serif;
</style></b>");

printf("<b><style>input {
	width: 314px;
	height: 50px;
	font-size: 25px;
	border: 2px solid red;
	background-color: red;
	color: Yellow;
	margin-bottom: 10px; }
</style></b>");

printf("<b><style>input[type=text] {
	
	text-align: center;
	color: White; }
</style></b>");

printf("<b><style>h1 {
	font-family: 'Cooper Black', serif;
	font-size: 88px;
</style></b>");



//Steg 1
if(isset($stageone)) {

	//Skapar pokerlog.txt
	$file = "pokerlog.txt";

	if(file_exists($file)) {
		$f = fopen($file, "r+");	
	} else {
		$f = fopen($file, "w+");
	}
	
	
	
	//Loggar vilket läge man spelar med
	if($secret == True) {
		
		ftruncate($f, 0);
		fprintf($f, "1\r\n");
		
	} else {
		
		ftruncate($f, 0);
		fprintf($f, "0\r\n");
		
	}
	
	//Loggar korten på bordet
	fprintf($f, "%s\r\n", $table[0]);
	fprintf($f, "%s\r\n", $table[1]);
	fprintf($f, "%s\r\n", $table[2]);
	
	//Loggar korten i händerna
	for($i = 0 ; $i != 2 ; $i++) {
		
		fprintf($f, "%s\r\n", $hand[1][$i]);
		
	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		fprintf($f, "%s\r\n", $hand[2][$i]);
		
	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		fprintf($f, "%s\r\n", $hand[3][$i]);
		
	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		fprintf($f, "%s\r\n", $hand[4][$i]);
		
	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		fprintf($f, "%s\r\n", $hand[5][$i]);
		
	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		fprintf($f, "%s\r\n", $hand[6][$i]);
		
	}
	
	//Printar korten på bordet
	printf("<br>On the table lies the %s, the %s, and the %s<br>",
	$refname[array_search($table[0], $refdeck)], $refname[array_search($table[1], $refdeck)], $refname[array_search($table[2], $refdeck)]);
	printcard($table[0]);
	printf("<br>");
	printcard($table[1]);
	printf("<br>");
	printcard($table[2]);
	printf("<br>");
	
	
	//Printar ut Spelarens hand
	printf("<p>You have the %s and the %s<br>",
	$refname[array_search($hand[1][0], $refdeck)], $refname[array_search($hand[1][1], $refdeck)]);
	printcard($hand[1][0]);
	printf("<br>");
	printcard($hand[1][1]);
	printf("<br>");

	//Printar de andras händer
	if($secret == False) {
		
		for($i = 2 ; $i != 7 ; $i++) {
			
			
			printf("<br>Player %s has the %s and the %s<br>", $coolerref[$i],
			$refname[array_search($hand[$i][0], $refdeck)], $refname[array_search($hand[$i][1], $refdeck)]);
			printcard($hand[$i][0]);
			printf("<br>");
			printcard($hand[$i][1]);
			printf("<br>");
			
			
		}


	} else {
		
		for($i = 2 ; $i != 7 ; $i++) {
			
			printsecret($i);
			
		}
		
	}
	//Ge händerna poäng
	$h1 = checkhand($hand[1], $table);
	$h2 = checkhand($hand[2], $table);
	$h3 = checkhand($hand[3], $table);
	$h4 = checkhand($hand[4], $table);
	$h5 = checkhand($hand[5], $table);
	$h6 = checkhand($hand[6], $table);



	//Printa ut poäng
	//printf("<br>1: %d<br>", $h1);
	//printf("2: %d<br>", $h2);
	//printf("3: %d<br>", $h3);
	//printf("4: %d<br>", $h4);
	//printf("5: %d<br>", $h5);
	//printf("6: %d<p>", $h6);
	printf("<p>");

	$comp = comparecards($h1, $h2, $h3, $h4, $h5, $h6);

	//Räknar ut vinnaren samt dess hand
	$winner = $comp[0];
	$points = $comp[1];


	//Loggar den ledande handen
	fprintf($f, "%s\r\n", $points);

	//Printar och loggar vem som leder 
	if(is_array($winner)) {
		
		printf("It's currently tied.");
		fprintf($f, "tie\r\n");
		
	} elseif($winner == 0) {
			
		printf("You are in the lead with ");
		printvalue($points, $coolerref, $colourref);
		fprintf($f, "%s\r\n", $winner+1);
			
	} elseif($secret == False) {

		printf("Player %d is currently in the lead with ", $winner+1);
		printvalue($points, $coolerref, $colourref);
		fprintf($f, "%s\r\n", $winner+1);
	
	} else {
			
		printf("Player %d is currently in the lead.", $winner+1);
		fprintf($f, "%s\r\n", $winner+1);
	
	}

	//Stänger filen
	fclose($f);
	
	//Skapar en separat fil där högen skall lagras
	$file = "drawpile.txt";

	if(file_exists($file)) {
		$d = fopen($file, "r+");	
	} else {
		$d = fopen($file, "w+");
	}
	
	//Lagrar först hur många kort som finns i högen, sedan själva högen där
	fprintf($d, "%s\r\n", count($deck));
	for($i = 0 ; $i != count($deck) ; $i++) {
		
		fprintf($d, "%s\r\n", $deck[$i]);
		
	}
	
	
	
	printf("<pre>








	</pre>");
	
	//Läs av pengar
	$file = "money.txt";

	if(file_exists($file)) {
		$c = fopen($file, "r+");
		fprintf($c, "1\r\n");
		$money = fgets($c);
		printf("You have $%s", $money);
	} else {
		$c = fopen($file, "w+");
		fprintf($c, "1\r\n");
		fprintf($c, "100\r\n");
		printf("You have $100");
	}
	
	//Printa pengar(På lagligt vis)
	
	

	//Skapar knapparna för olika alternativ som drar ytterliggare ett kort
	printf("<form method=post action=poker.php>");
	if($money > 9) {
		
		printf("<input type=text name=amount value='10'>");
	
	} else {
		
		printf("<input type=text name=amount value='0'>");
		
	}
	printf("<br>");
	printf("<input type=submit name=stage2 value='Bet'>");

}

//Steg 2
if(isset($_POST['stage2'])) {
	
	//Kollar om bettet var tillåtet
	$bet = $_POST['amount'];
	$file = "money.txt";
	$c = fopen($file, "r+");
	fprintf($c, "1\r\n");
	$money = fgets($c);
	$money = substr($money, 0, -2);
	
	
	if(is_numeric($bet) == False) {
		
		printf("<pre>
		
		
		
		
		</pre>");
		printf("That isn't a number dude. Return to the menu and try again.");
		printf("<form method=post action=poker.php>");
		printf("<input type=submit value='Return to menu'>");
		
	} elseif($bet > $money) {
		
		printf("<pre>
		
		
		
		
		</pre>");
		printf("You aren't allowed to bet more than you have dude. Return to the menu and try again.");
		printf("<form method=post action=poker.php>");
		printf("<input type=submit value='Return to menu'>");
		
	} elseif($bet < 10 and $money >=10) {
				
		printf("<pre>
		
		
		
		
		</pre>");
		printf("If you are able to, you have to bet at least $10. Return to the menu and try again.");
		printf("<form method=post action=poker.php>");
		printf("<input type=submit value='Return to menu'>");
		
	} elseif($bet < 0) {
		
		printf("<pre>
		
		
		
		
		</pre>");
		printf("You can't bet negative amounts you maroon. Return to the menu and try again.");
		printf("<form method=post action=poker.php>");
		printf("<input type=submit value='Return to menu'>");
		
	} else {
	
		//Skriver hur mycket pengar spelaren har kvar
		fprintf($c, "%s\r\n", $money-$bet);
		fclose($c);
		
		//Öppnar filen med högen
		$file = "drawpile.txt";
		$d = fopen($file, "r+");

		//Kollar hur många kort som finns i högen, lagrar sedan högen på nytt. Stänger den sedan igen
		$cardnum = fgets($d);
		for($i = 0 ; $i != $cardnum ; $i++) {
			
			$deck[$i] = fgets($d);
			$deck[$i] = substr($deck[$i], 0, -2);
		}
		
		fclose($d);

		
		//Öppnar filen igen
		$file = "pokerlog.txt";
		$f = fopen($file, "r+");	
		
		//Kollar efter hemligheter. sssch..
		$str = fgets($f);
		if($str == 1) {
			
			$secret = True;
			
		} else {
			
			$secret = False;
			
		}
		
		//Laddar korten på bordet
		for($i = 0 ; $i != 3 ; $i++) {
			
			$table[$i] = fgets($f);
			$table[$i] = substr($table[$i], 0, -2);
			
		}

		//Lägger till ytterligare ett kort
		$temp = distribute(1, $deck);
		array_push($table, $temp[0][0]);
		$deck = $temp[1];
		
		//Laddar korten på händerna
		
		for($i = 0 ; $i != 2 ; $i++) {
			
			$hand[1][$i] = fgets($f);
			$hand[1][$i] = substr($hand[1][$i], 0, -2);
			
		}
		
		for($i = 0 ; $i != 2 ; $i++) {
			
			$hand[2][$i] = fgets($f);
			$hand[2][$i] = substr($hand[2][$i], 0, -2);
			
		}
		
		for($i = 0 ; $i != 2 ; $i++) {
			
			$hand[3][$i] = fgets($f);
			$hand[3][$i] = substr($hand[3][$i], 0, -2);
			
		}
		
		for($i = 0 ; $i != 2 ; $i++) {
			
			$hand[4][$i] = fgets($f);
			$hand[4][$i] = substr($hand[4][$i], 0, -2);
			
		}
		
		for($i = 0 ; $i != 2 ; $i++) {
			
			$hand[5][$i] = fgets($f);
			$hand[5][$i] = substr($hand[5][$i], 0, -2);
			
		}
		
		for($i = 0 ; $i != 2 ; $i++) {
			
			$hand[6][$i] = fgets($f);
			$hand[6][$i] = substr($hand[6][$i], 0, -2);
			
		}
		
		//Flyttar ner pointern två rader
		fgets($f);
		fgets($f);
		
		//Printar korten på bordet
		//printf("<pre>");
		//print_r($table);
		//print_r($deck);
		//print_r($refdeck);
		printf("<br>On the table lies the %s, the %s, the %s, and the %s<br>",
		$refname[array_search($table[0], $refdeck)], $refname[array_search($table[1], $refdeck)],
		$refname[array_search($table[2], $refdeck)], $refname[array_search($table[3], $refdeck)]);
		printcard($table[0]);
		printf("<br>");
		printcard($table[1]);
		printf("<br>");
		printcard($table[2]);
		printf("<br>");
		printcard($table[3]);
		printf("<br>");
		
		
		//Printar ut Spelarens hand
		printf("<p>You have the %s and the %s<br>",
		$refname[array_search($hand[1][0], $refdeck)], $refname[array_search($hand[1][1], $refdeck)]);
		printcard($hand[1][0]);
		printf("<br>");
		printcard($hand[1][1]);
		printf("<br>");

		if($secret == False) {

			for($i = 2 ; $i != 7 ; $i++) {
				
				
				printf("<br>Player %s has the %s and the %s<br>", $coolerref[$i],
				$refname[array_search($hand[$i][0], $refdeck)], $refname[array_search($hand[$i][1], $refdeck)]);
				printcard($hand[$i][0]);
				printf("<br>");
				printcard($hand[$i][1]);
				printf("<br>");
				
				
			}
			printf("<br>");

		} else {
			
			for($i = 2 ; $i != 7 ; $i++) {
				
				printsecret($i);
				
			}
			
		}
		
		//Ge händerna poäng
		$h1 = checkhand($hand[1], $table);
		$h2 = checkhand($hand[2], $table);
		$h3 = checkhand($hand[3], $table);
		$h4 = checkhand($hand[4], $table);
		$h5 = checkhand($hand[5], $table);
		$h6 = checkhand($hand[6], $table);



		//Printa ut poäng
		//printf("<br>1: %d<br>", $h1);
		//printf("2: %d<br>", $h2);
		//printf("3: %d<br>", $h3);
		//printf("4: %d<br>", $h4);
		//printf("5: %d<br>", $h5);
		//printf("6: %d<p>", $h6);
		printf("<p>");

		$comp = comparecards($h1, $h2, $h3, $h4, $h5, $h6);

		//Räknar ut vinnaren samt dess hand
		$winner = $comp[0];
		$points = $comp[1];


		//Loggar den ledande handen
		fprintf($f, "%s\r\n", $points);

		//Printar och loggar vem som leder 
		if(is_array($winner)) {
			
			printf("It's currently tied.");
			fprintf($f, "tie\r\n");
			
		} elseif($winner == 0) {
				
			printf("You are in the lead with ");
			printvalue($points, $coolerref, $colourref);
			fprintf($f, "%s\r\n", $winner+1);
				
		} elseif($secret == False) {

			printf("Player %d is currently in the lead with ", $winner+1);
			printvalue($points, $coolerref, $colourref);
			fprintf($f, "%s\r\n", $winner+1);
		
		} else {
				
			printf("Player %d is currently in the lead.", $winner+1);
			fprintf($f, "%s\r\n", $winner+1);
		
		}
		
		//Loggar vilket kort som lades till
		fprintf($f, "%s\r\n", $temp[0][0]);
		
		
		//Stänger filen
		fclose($f);
		
		//Öppnar filen där högen lagras och rensar den helt
		$file = "drawpile.txt";
		$d = fopen($file, "r+");

		
		
		//Lagrar först hur många kort som finns i högen, sedan själva högen där
		fprintf($d, "%s\r\n", count($deck));
		for($i = 0 ; $i != count($deck) ; $i++) {
			
			fprintf($d, "%s\r\n", $deck[$i]);
			
		}
		
		
		
		
		
		printf("<pre>








		</pre>");
		
		//Pengar
		$file = "money.txt";
		
		$c = fopen($file, "r+");
			fprintf($c, "1\r\n");
			fgets($c);
			$money = fgets($c);
			printf("You have $%s", $money);
			fclose($c);

		//Skapar knappen som drar ytterliggare ett kort
		printf("<form method=post action=poker.php>");
	if($money > 9) {
		
		printf("<input type=text name=amount value='10'>");
	
	} else {
		
		printf("<input type=text name=amount value='0'>");
		
	}
	printf("<br>");
	printf("<input type=submit name=stage3 value='Bet'>");

}

	}

//Steg 3
if(isset($_POST['stage3'])) {
	
	//Kollar om bettet var tillåtet
	$bet = $_POST['amount'];
	$file = "money.txt";
	$c = fopen($file, "r+");
	fprintf($c, "1\r\n");
	fgets($c);
	$money = fgets($c);
	$money = substr($money, 0, -2);
	
	
	if(is_numeric($bet) == False) {
		
		printf("<pre>
		
		
		
		
		</pre>");
		printf("That isn't a number dude. Return to the menu and try again.");
		printf("<form method=post action=poker.php>");
		printf("<input type=submit value='Return to menu'>");
		
	} elseif($bet > $money) {
		
		printf("<pre>
		
		
		
		
		</pre>");
		printf("You aren't allowed to bet more than you have dude. Return to the menu and try again.");
		printf("<form method=post action=poker.php>");
		printf("<input type=submit value='Return to menu'>");
		
	} elseif($bet < 10 and $money >=10) {
				
		printf("<pre>
		
		
		
		
		</pre>");
		printf("If you are able to, you have to bet at least $10. Return to the menu and try again.");
		printf("<form method=post action=poker.php>");
		printf("<input type=submit value='Return to menu'>");
		
	} elseif($bet < 0) {
		
		printf("<pre>
		
		
		
		
		</pre>");
		printf("You can't bet negative amounts you maroon. Return to the menu and try again.");
		printf("<form method=post action=poker.php>");
		printf("<input type=submit value='Return to menu'>");
		
	} else {
	
	//Skriver hur mycket pengar spelaren har kvar
	fprintf($c, "%s\r\n", $money-$bet);
	fclose($c);
	
	//Öppnar filen med högen
	$file = "drawpile.txt";
	$d = fopen($file, "r+");
	
	

	//Kollar hur många kort som finns i högen, lagrar sedan högen på nytt. Stänger den sedan igen
	$cardnum = fgets($d);
	for($i = 0 ; $i != $cardnum ; $i++) {
		
		$deck[$i] = fgets($d);
		$deck[$i] = substr($deck[$i], 0, -2);
	}
	
	fclose($d);

	
	//Öppnar filen igen
	$file = "pokerlog.txt";
	$f = fopen($file, "r+");	
	
	//Lagrar hela filen i en array
	for($i = 0 ; $i != 21 ; $i++) {
		
		$str[$i] = fgets($f);
		
	}
	
	//Kollar efter hemligheter. sssch..
	if($str[0] == 1) {
		
		$secret = True;
		
	} else {
		
		$secret = False;
		
	}
	
	//Laddar de första tre korten på bordet
	for($i = 0 ; $i != 3 ; $i++) {
		
		$table[$i] = $str[$i+1];
		$table[$i] = substr($table[$i], 0, -2);
		
	}
	
	//Laddar nästa kort till bordet
	$table[3] = $str[20];
	$table[$i] = substr($table[$i], 0, -2);



	//Lägger till ytterligare ett kort
	$temp = distribute(1, $deck);
	array_push($table, $temp[0][0]);
	$deck = $temp[1];
	
	
	//Laddar korten på händerna
	for($i = 0 ; $i != 2 ; $i++) {
		
		$hand[1][$i] = $str[$i+4];
		$hand[1][$i] = substr($hand[1][$i], 0, -2);
		
	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		$hand[2][$i] = $str[$i+6];
		$hand[2][$i] = substr($hand[2][$i], 0, -2);
		
	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		$hand[3][$i] = $str[$i+8];
		$hand[3][$i] = substr($hand[3][$i], 0, -2);
		
	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		$hand[4][$i] = $str[$i+10];
		$hand[4][$i] = substr($hand[4][$i], 0, -2);
		
	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		$hand[5][$i] = $str[$i+12];
		$hand[5][$i] = substr($hand[5][$i], 0, -2);
		
	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		$hand[6][$i] = $str[$i+14];
		$hand[6][$i] = substr($hand[6][$i], 0, -2);
		
	}
	

	
	//Printar korten på bordet
	//printf("<pre>");
	//print_r($table);
	//print_r($deck);
	//print_r($refdeck);
	printf("<br>On the table lies the %s, the %s, the %s, the %s, and the %s<br>",
	$refname[array_search($table[0], $refdeck)], $refname[array_search($table[1], $refdeck)],
	$refname[array_search($table[2], $refdeck)], $refname[array_search($table[3], $refdeck)], $refname[array_search($table[4], $refdeck)]);
	printcard($table[0]);
	printf("<br>");
	printcard($table[1]);
	printf("<br>");
	printcard($table[2]);
	printf("<br>");
	printcard($table[3]);
	printf("<br>");
	printcard($table[4]);
	printf("<br>");
	
	
	//Printar ut Spelarens hand
	printf("<p>You have the %s and the %s<br>",
	$refname[array_search($hand[1][0], $refdeck)], $refname[array_search($hand[1][1], $refdeck)]);
	printcard($hand[1][0]);
	printf("<br>");
	printcard($hand[1][1]);
	printf("<br>");
	
	
	//Printa andra spelares kort
	if($secret == False) {

		for($i = 2 ; $i != 7 ; $i++) {
			
			
			printf("<br>Player %s has the %s and the %s<br>", $coolerref[$i],
			$refname[array_search($hand[$i][0], $refdeck)], $refname[array_search($hand[$i][1], $refdeck)]);
			printcard($hand[$i][0]);
			printf("<br>");
			printcard($hand[$i][1]);
			printf("<br>");
			
			
		}
		printf("<br>");

	} else {
		
		for($i = 2 ; $i != 7 ; $i++) {
			
			printsecret($i);
			
		}
		
	}
	
	
	//Ge händerna poäng
	$h1 = checkhand($hand[1], $table);
	$h2 = checkhand($hand[2], $table);
	$h3 = checkhand($hand[3], $table);
	$h4 = checkhand($hand[4], $table);
	$h5 = checkhand($hand[5], $table);
	$h6 = checkhand($hand[6], $table);



	//Printa ut poäng
	//printf("<br>1: %d<br>", $h1);
	//printf("2: %d<br>", $h2);
	//printf("3: %d<br>", $h3);
	//printf("4: %d<br>", $h4);
	//printf("5: %d<br>", $h5);
	//printf("6: %d<p>", $h6);
	printf("<p>");

	$comp = comparecards($h1, $h2, $h3, $h4, $h5, $h6);

	//Räknar ut vinnaren samt dess hand
	$winner = $comp[0];
	$points = $comp[1];
	
	
	//Loggar den ledande handen
	fprintf($f, "%s\r\n", $points);

	//Printar och loggar vem som leder 
	if(is_array($winner)) {
		
		fprintf($f, "tie\r\n");
		
	} else {
	
		fprintf($f, "%s\r\n", $winner+1);
	
	}
	
	//Loggar vilket kort som lades till
	fprintf($f, "%s\r\n", $temp[0][0]);
	
	//Stänger filen
	fclose($f);
	
	//Öppnar filen där högen lagras och rensar den helt
	$file = "drawpile.txt";
	$d = fopen($file, "r+");

	
	//Lagrar först hur många kort som finns i högen, sedan själva högen där
	fprintf($d, "%s\r\n", count($deck));
	for($i = 0 ; $i != count($deck) ; $i++) {
		
		fprintf($d, "%s\r\n", $deck[$i]);
		
	}
	
	printf("<pre>





	</pre>");
	
	//Pengar
	$file = "money.txt";
	
	$c = fopen($file, "r+");
		fprintf($c, "1\r\n");
		fgets($c);
		fgets($c);
		$money = fgets($c);
		printf("You have $%s", $money);

	//Skapar knappen som avslutar spelet
	printf("<form method=post action=poker.php>");
	
	printf("<input type=submit name=stage4 value='Reveal Winner'>");
	
	}
}

//Steg 4
if(isset($_POST['stage4'])) {
	
	//Öppnar filen med högen
	$file = "drawpile.txt";
	$d = fopen($file, "r+");
	
	

	//Kollar hur många kort som finns i högen, lagrar sedan högen på nytt. Stänger den sedan igen
	$cardnum = fgets($d);
	for($i = 0 ; $i != $cardnum ; $i++) {
		
		$deck[$i] = fgets($d);
		$deck[$i] = substr($deck[$i], 0, -2);
	}
	
	fclose($d);

	
	//Öppnar filen igen
	$file = "pokerlog.txt";
	$f = fopen($file, "r+");	
	
	//Lagrar hela filen i en array
	for($i = 0 ; $i != 24 ; $i++) {
		
		$str[$i] = fgets($f);
		preg_replace( "/\r|\n/", "", $str[$i] );
		
	}
	
	//Stänger filen
	fclose($f);
		
	//Laddar de första tre korten på bordet
	for($i = 0 ; $i != 3 ; $i++) {
		
		$table[$i] = $str[$i+1];
		$table[$i] = substr($table[$i], 0, -2);
		
	}
	
	//Laddar nästa kort till bordet
	$table[3] = substr($str[20], 0, -2);
	
	//Laddar det sista kortet till bordet
	$table[4] = substr($str[23], 0, -2);
	
	
	//Laddar korten på händerna
	for($i = 0 ; $i != 2 ; $i++) {
		
		$hand[1][$i] = $str[$i+4];
		$hand[1][$i] = substr($hand[1][$i], 0, -2);
		
	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		$hand[2][$i] = $str[$i+6];
		$hand[2][$i] = substr($hand[2][$i], 0, -2);

	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		$hand[3][$i] = $str[$i+8];
		$hand[3][$i] = substr($hand[3][$i], 0, -2);
		
	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		$hand[4][$i] = $str[$i+10];
		$hand[4][$i] = substr($hand[4][$i], 0, -2);
		
	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		$hand[5][$i] = $str[$i+12];
		$hand[5][$i] = substr($hand[5][$i], 0, -2);
		
	}
	
	for($i = 0 ; $i != 2 ; $i++) {
		
		$hand[6][$i] = $str[$i+14];
		$hand[6][$i] = substr($hand[6][$i], 0, -2);
		
	}

	printf("<br>On the table lies the %s, the %s, the %s, the %s, and the %s<br>",
	$refname[array_search($table[0], $refdeck)], $refname[array_search($table[1], $refdeck)],
	$refname[array_search($table[2], $refdeck)], $refname[array_search($table[3], $refdeck)], $refname[array_search($table[4], $refdeck)]);
	printcard($table[0]);
	printf("<br>");
	printcard($table[1]);
	printf("<br>");
	printcard($table[2]);
	printf("<br>");
	printcard($table[3]);
	printf("<br>");
	printcard($table[4]);
	printf("<br>");

	printf("<p>You have the %s and the %s<br>",
	$refname[array_search($hand[1][0], $refdeck)], $refname[array_search($hand[1][1], $refdeck)]);
	printcard($hand[1][0]);
	printf("<br>");
	printcard($hand[1][1]);
	printf("<br>");

	for($i = 2 ; $i != 7 ; $i++) {
			
			
			printf("<br>Player %s has the %s and the %s<br>", $coolerref[$i],
			$refname[array_search($hand[$i][0], $refdeck)], $refname[array_search($hand[$i][1], $refdeck)]);
			printcard($hand[$i][0]);
			printf("<br>");
			printcard($hand[$i][1]);
			printf("<br>");
			
			
		}
	
	//Laddar pengar
	$file = "money.txt";
	$c = fopen($file, "r+");
	fprintf($c, "1\r\n");
	$startcap = fgets($c);
	$startcap = substr($startcap, 0, -2);
	fgets($c);
	$endcap = fgets($c);
	$endcap = substr($endcap, 0, -2);
	$diff = $startcap - $endcap;
	fclose($c);
	
	//Öppnar filen igen, wipear den för att flytta up pointern
	$c = fopen($file, "r+");
	ftruncate($c, 0);
	fprintf($c, "1\r\n");
	
	//Printar vem som vinner 
	$str[22] = 	substr($str[22], 0, -2);
	$str[21] = 	substr($str[21], 0, -2);
	if($str[22] == "tie") {
		
		printf("<br>It ends with a tie. Your money is refunded");
		$money = $startcap;
		
	} elseif((int)$str[22] == 1) {
			
		printf("<br>You win with ");
		printvalue($str[21], $coolerref, $colourref);
		printf("<br>Your money has been sextupled.<p>Congratulations!");
		$money = $startcap + ($diff * 5);
			
	} else {

		printf("<br>Player %d wins with ", (int)$str[22]);
		printvalue($str[21], $coolerref, $colourref);
		printf("<br>Your money has been lost. Commiserations");
		$money = $endcap;
	
	}

	fprintf($c, "%s\r\n", $money);
	
	printf("<pre>








	</pre>");
	

	//Skapar knapparna som startar ett nytt spel eller återvänder till hemskärmen
	printf("You now have $%s", $money);
	
	printf("<form method=post action=poker.php>");

	if($money < 20) {
		
		printf("<br>That isn't enough to play again.<br>");
		
	} else {

		if($str[0] == 1) {
		printf("<input type=submit name=normal value='Play Again'><br>");
		
		} else {
			
			printf("<input type=submit name=transparent value='Play Again'><br>");
			
		}
	
	}
	
	printf("<input type=submit value='Return to Home Screen'>");
}

?>