<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="sklep.css">
	<title>Sklep</title>
</head>
<body>
<header>
		<input class="menu-btn" type="checkbox" id="menu-btn">
		<label class="menu-icon" for="menu-btn">
			<span class=navicon></span>
		</label>
		<ul class="menu">
			<li><a href="sklep.php">Start</a></li><li><a href="cart.php">Koszyk</a></li>
			<li style="height: 76px;"><a style="padding: 10px;" href="
			<?php  session_start();
			if (isset($_SESSION['login']) && isset($_SESSION['haslo'])) {
				echo "profil.php";

			}
			else
				echo 'logowanie.php';
			?>"><img alt="ikona profil" src="profil.png"></a></li>
			
		</ul>
	</header>
<main>
	<div class="filtry">
		<form action="sklep.php" method="POST">
		<select class="kat" name="kat">
			<option>Kategoria</option>
			<option>Liny</option>
			<option>Buty</option>
			<option>Woreczki</option>
			<option>przyrządy asekuracyjne</option>
			<option>karabinki</option>
			<option>kurtki</option>
		</select>
		<input type="text" placeholder="min" class="kat" maxlength="3" name="min"><input placeholder="max" class="kat" type="text" maxlength="3" name="max">

		<input class="f" type="submit" name="filtr" value="Filtruj">
</form>
	</div>
	<div class="of">
<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db = 'sklep';

$link = mysqli_connect($host, $username, $password, $db);
if (!$link) {
	die("Blad polaczenia " . mysqli_connect_error());
}
if (isset($_POST['filtr'])) {
	$query="SELECT * FROM produkty Where kosz=1";
	if (isset($_POST['min']) && !empty($_POST['min'])) {
		$query.=" AND cena_klient>=$_POST[min]";
	}
	if (isset($_POST['max']) && !empty($_POST['max'])) {
		$query.= " AND cena_klient<=$_POST[max]";
	}
		if (isset($_POST['kat']) && !empty($_POST['kat'])) {
			if ($_POST['kat']!="Kategoria") {
				$query.=" AND kategoria='$_POST[kat]'";
			}
		
	}
	$result=mysqli_query($link,$query);
	
while ($wynik = mysqli_fetch_array($result)){
echo "<div class=produkt>
<div>
	"?><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($wynik['zdjecie']); ?>" >
	<?php	
	echo"			
</div>
<p>$wynik[nazwa]</p>
<div class=koszyk >

<form method=POST action=dod_koszyk.php>$wynik[cena_klient]zł
<input type=hidden value=$wynik[id] name=id >
<input value=1 min=1 max=$wynik[ilosc] name=ilosc class=ile type=number>
<input class=dodaj type=submit value='Dodaj'>
</form>
</div>
</div>";


}



}else{
$query=mysqli_query($link,"SELECT * FROM produkty Where kosz=1");
while ($wynik = mysqli_fetch_array($query)){
echo "<div class=produkt>
<div>
	"?><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($wynik['zdjecie']); ?>" >
	<?php	
	echo"			
</div>
<p>$wynik[nazwa]</p>
<div class=koszyk >

<form method=POST action=dod_koszyk.php>$wynik[cena_klient]zł
<input type=hidden value=$wynik[id] name=id >
<input value=1 min=1 max=$wynik[ilosc] name=ilosc class=ile type=number>
<input class=dodaj type=submit value='Dodaj'>
</form>
</div>
</div>";


}}

?>

	</div>
</main>







</body>
</html>