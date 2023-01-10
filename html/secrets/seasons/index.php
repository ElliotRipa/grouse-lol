<!doctype html>
<!-- Kommentarer --> 

<html lang='sv'>
	<head> 
        <meta charset='utf-8' />
        <title>Årstider</title> 
        <link rel='stylesheet' href='style.css'/>
        <style>
        	body {background-color: HotPink}
			a:visited {
				color: green;
				background-color: transparent;
				text-decoration: none;
			}
			a:link {
				color: blue;
				background-color: transparent;
				text-decoration: none;
					}
			.center {
				text-align: center;
				}
			ul {
				display: table;
				margin: 0 auto;
			}
			img {
				max-width:100%;
				height:250px;
				width: 375px;
			}

        </style>
    </head>
    
    <body>
	<div class="center">
    	<h1>Årstider!</h1>
		Det finns flera. Men hur många?<br>
		Det är den stora frågan, så jag tycker att vi gör en quiz. Se om du kan få rätt direkt.
		
		<form method=post action=index.php>
			

			<input type=submit name=one value='1'>
			<input type=submit name=two value='2'><br>
			<input type=submit name=three value='3'>
			<input type=submit name=four value='4'><br>
			<input type=submit name=five value='5'>
			<input type=submit name=six value='6'>

		</form>
		<?php
		
			if(isset($_POST['one'])) {
				$_POST = NULL;
				printf("Nej, det finns fler än bara en årstid.");
			}
			if(isset($_POST['two'])) {
				$_POST = NULL;
				printf("Två är fel.");
			}
			if(isset($_POST['three'])) {
				$_POST = NULL;
				printf("Kan jag berätta en hemlighet?<br>Det finns fler än tre årstider.");
			}
			if(isset($_POST['four'])) {
				$_POST = NULL;
				printf("Hurra! Du är ett geni! Det finns hela <b>Fyra(4)</b> Årstider!<br>");
				printf("Det är ett mirakel. Klicka på bilderna nedan för att kolla på de olika årstiderna.<br>");
				
				printf("<a href=winter/index.html><img src=images/winter/sunthrutrees.jpg></a>&nbsp;&nbsp;");
				printf("<a href=spring/index.html><img src=images/spring/birds.jpeg></a><br>");
				printf("<a href=summer/index.html><img src=images/summer/ocean.jpg></a>&nbsp;&nbsp;");
				printf("<a href=autumn/index.html><img src=images/autumn/beauty.jpg></a>");
				
			}
			if(isset($_POST['five'])) {
				$_POST = NULL;
				printf("Du är nära, men riktigt så många årstider finns det inte.");
			}
			if(isset($_POST['six'])) {
				$_POST = NULL;
				printf("ÄR DU HELT JÄVLA DUM I HUVUDET!? KLART DET INTE FINNS SEX ÅRSTIDER DIN KRITÄTANDE MONGOLID!<br>");
				printf("FÖRSÖK IGEN! SKÄM INTE UT DIG RIKTIGT LIKA MYCKET DEN HÄR GÅNGEN!");
			}
		?>	
	<div>
    </body> 
</html>
