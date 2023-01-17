<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Profil</title>
	<link rel="stylesheet" type="text/css" href="logowanie.css">
	<style type="text/css">
		input{
			float: right;
			margin-right: 50px;
			width: 250px;
		}
		.log{
			padding: 10px;		
			gap: 5px;
		}
		.z{
			align-self: center;
			width: 150px;
			height: 50px;
			margin: 0;
			margin-top: 10px!important;
			border-radius: 3px;
			border: 1px solid black;
			transition: background 0.5s;
		}
		.z:hover{
			background: lightgrey;
		}
	</style>
</head>
<body>
	<header>
		<input class="menu-btn" type="checkbox" id="menu-btn">
		<label class="menu-icon" for="menu-btn">
			<span class=navicon></span>
		</label>
		<ul class="menu">
			<li><a href="sklep.php">Start</a></li><li><a href="cart.php">Koszyk</a></li>
			<?php  session_start();
			if (isset($_SESSION['login']) && isset($_SESSION['haslo'])) {
				echo "<li><a href='wyloguj.php'>Wyloguj</a></li>";

			}
			else
				header("location:logowanie.php");
			?>
			
		</ul>
	</header>
	<main>
		<form class="log" action=edycja_konta.php method=POST>
			<?php
			echo "
			
			<label>Email:<input autocomplete='off' name=login type=email placeholder=$_SESSION[login]></label>
			<label>Hasło:<input autocomplete='off' name=haslo_s type=password placeholder=***********></label>
						<label>Nowe hasło:<input autocomplete=off name=haslo type=password placeholder=***********></label>

			<label>Numer:<input name=telefon autocomplete='off' type=text placeholder=$_SESSION[telefon]></label>
			<label>Zamieszkanie:<input autocomplete='off' name=zamieszkanie type=text placeholder=$_SESSION[zamieszkanie]></label>
			<label>Kod pocztowy:<input autocomplete='off' name=kod type=text placeholder=$_SESSION[kod]></label>
			";
			if (isset($_SESSION['blad'])) {
				echo "<p>".$_SESSION['blad']."</p>";
				unset($_SESSION['blad']);
			}                      echo "
			<input class=z type=submit value=EDYTUJ>


			
			";
			?>
		</form>
		<h2>Aby usunąć konto kliknij dwa razy w poniższy przycisk.</h2>
		<form action="usun_konto.php" method="POST">
			<input class="z" type="submit" name="usun" value="USUŃ">
		</form>
	</main>
</body>
</html>