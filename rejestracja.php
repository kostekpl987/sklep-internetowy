<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Rejestracja</title>
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
			<li><a href="logowanie.php">Logowanie</a></li>
		</ul>
	</header>
<main>
		<form class="log" action="rejestracja_dwa.php" method="POST">
			<h2>Zarejestruj się:</h2>
			
			<input class="dane" required autocomplete="off" placeholder="email" type="text" name="email">
			
			<input class="dane" required autocomplete="off" placeholder="Hasło" type="text" name="haslo" minlength="8">
			
			<input class="dane" required placeholder="XXX-XXX-XXX" type="text" name="numer" >
			
			<input class="dane" placeholder="miejsce zamieszkania" type="text" name="mieszkanie">
			
			<input class="dane" placeholder="kod pocztowy" type="text" name="kod">
						<p style="color:red;">
			<?php 
			session_start(); 
			if (isset($_SESSION['blad'])) {
				echo $_SESSION['blad'];
				session_destroy();
			}


			?>	
			</p>
			<input class="sub" type="submit" value="rejestracja" name="rej">
		</form>
</main>
</body>
</html>