<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Logowanie</title>
	<link rel="stylesheet" type="text/css" href="logowanie.css">
	<style type="text/css">

.log{
align-items: center	;
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
			<li><a href="sklep.php">Start</a></li>
			<?php  session_start();
			if (isset($_SESSION['login']) && isset($_SESSION['haslo'])) {
				echo "<li><a href='wyloguj.php'>Wyloguj</a></li>";

			}
			else
				echo '<li><a href="logowanie.php">Logowanie</a></li>';
			?>
			
		</ul>
	</header>

<main>
		<form class="log" action="log_dwa.php" method="POST">
			<h2>Zaloguj się:</h2>
				<?php
	if(isset($_SESSION['komunikat'])){
	echo "<h2>".$_SESSION['komunikat']."!</h2>";
	session_destroy();
}
	 ?>
			<input class="dane" autocomplete="off" placeholder="email" type="text" name="email">
			
			<input class="dane" autocomplete="off" placeholder="Hasło" type="password" name="haslo" >
			<p style="color:red;">
			<?php 
			
			if (isset($_SESSION['blad'])) {
				echo $_SESSION['blad'];
				session_destroy();
			}


			?>	
			</p>	
			<p>Nie masz konta <a href="rejestracja.php">zarejestruj się</a>!</p>
			<input class="sub" type="submit" value="Zaloguj" name="rej">
		</form>

</main>	
<footer>
		<div class="kontakt"></div>
		<div class="prawa"></div>
		<div class="linki"></div>
	</footer>
</body>
</html>