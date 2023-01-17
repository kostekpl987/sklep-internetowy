<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="produkt.css">
	<title>Produkt</title>
</head>
<body>
	<header>
		<input class="menu-btn" type="checkbox" id="menu-btn">
		<label class="menu-icon" for="menu-btn">
			<span class=navicon></span>
		</label>
		<ul class="menu">
			<li><a href="#">Start</a></li>
			<li><a href="#">Oferta</a></li>
			<li><a href="#">Kontakt</a></li>
		</ul>
	</header>
	<?php
		$host = 'localhost';
		$username = 'root';
$password = '';
$db = 'sklep';

$link = mysqli_connect($host, $username, $password, $db);

if (!$link) {
	die("Blad polaczenia " . mysqli_connect_error());
}
if (isset($_POST['id'])) {
$query=mysqli_query($link,"SELECT * from produkty where kosz=1 AND id='$id'");

while ($wynik = mysqli_fetch_array($query)){
	echo"<main>
		<div class=zdjecie>$wynik[zdjecie]</div>
		<div class=tytul>$wynik[nazwa]</div>
		<div class=opis>$wynik[opis]</div>
	</main>";
}
}else{
	echo "<main><div class=blad><h2>Wystąpił błąd spróbuj ponownie</h2></div></main>";
}

	  ?>
</body>
</html>