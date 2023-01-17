<!DOCTYPE html>
<html>
<head>
	<title>Panel admina</title>
	<link rel="stylesheet" type="text/css" href="panel.css">
</head>
<body>
	<?php 
	session_start();
	if (!isset($_SESSION['admin']) || !isset($_SESSION['admin_h'])) {
		header("location:logowanie.php");
	}
	 ?>
<header>
		<input class="menu-btn" type="checkbox" id="menu-btn">
		<label class="menu-icon" for="menu-btn">
			<span class=navicon></span>
		</label>
		<ul class="menu">
			<?php  
			if (isset($_SESSION['admin_h']) && isset($_SESSION['admin'])) {
				echo "<li><a href='wyloguj.php'>Wyloguj</a></li>";

			}
			else
				echo '<li><a href="logowanie.php">Logowanie</a></li>';
			?>
		</ul>
</header>
<main>
	
		<form method="POST" action="dod.php" enctype="multipart/form-data">
			<input  required type="text" placeholder="nazwa produktu" name="nazwa">
			<select required name="kat">
				<option>Kategoria</option>
				<option>Liny</option>
				<option>Buty</option>
				<option>Kurtki</option>
			</select>
			<input type="number" required placeholder="ilosc" name="ilosc">
			<input type="number" required placeholder="cena podstawowa" name="cena_z">
			<input type="number" required placeholder="marża" min="1" max="300" maxlength="3" name="marza">

			<input type="date" name="data">
			<input type="file" required class="file" name="zdj">
			<input type="submit" required name="dodaj" value="dodaj">

		</form>	

</main>
			<div class="trzymacz">
			<table>
				<tr>
					
					<th>Zdjęcie</th>
					<th>Nazwa</th>
					<th>Kategoria</th>
					<th>Ilość</th>
					<th>Cena zakupu</th>
					<th>Marża</th>
					<th>Cena Klienta</th>
					<th>Data ważności</th>
					<th colspan="2">Usuwanie i Edycja</th>
					
				</tr>
			<?php  
			$host = 'localhost';
		$username = 'root';
$password = '';
$db = 'sklep';

$link = mysqli_connect($host, $username, $password, $db);

if (!$link) {
	die("Blad polaczenia " . mysqli_connect_error());
}

$query=mysqli_query($link,"SELECT * from produkty where kosz=1");

while ($wynik = mysqli_fetch_array($query)){
	echo "<tr>";
?>
<td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($wynik['zdjecie']); ?>" ></td>
<?php
	echo "<td>$wynik[nazwa]</td>";
	echo "<td>$wynik[kategoria]</td>";
	echo "<td>$wynik[ilosc]</td>";
	echo "<td>$wynik[cena_z]zł</td>";
	echo "<td>$wynik[marza]%</td>";
	echo "<td>$wynik[cena_klient]zł</td>";
	echo "<td>$wynik[data_w]</td>";
	
	echo "<td>
	<form action=usuwanie.php method=POST>
	<input type=hidden value='$wynik[id]' name=id>
	<input type=submit class=usun value=usun></form></td>";
	

	echo "</tr>";

		echo "<tr class=cichy id=$wynik[id]>";
	echo "<form action=edycja.php method=POST enctype=multipart/form-data ><input name=id type=hidden value=$wynik[id] >";?>
<td><input class="file" type="file" name="zdj"></td>
<?php
	echo "<td><input type=text placeholder=Nazwa name=nazwa ></td>";
	echo "<td><select name=kat >
				<option>".$wynik['kategoria']."</option>
				<option>Liny</option>
				<option>Buty</option>
				<option>Kurtki</option>
	</select></td>";
	echo "<td><input name=ilosc type=number placeholder=ilość ></td>";
	echo "<td><input name=cena_z type=number min='10' placeholder=cena bez marży ></td>";
	echo "<td><input name=marza type=number min='1' max='100' placeholder=marża ></td>";
	echo "<td>$wynik[cena_klient]zł</td>";
	echo "<td><input name=data_w type=date ></td>";
	echo "<td colspan=2><input  name=cena_z_s type=hidden value=$wynik[cena_z] ><input name=marza_s type=hidden value=$wynik[marza] ><input type=submit class='edycja' value=edycja name=edyt ></form></td>";

	

	echo "</tr>";
}


			?>
		</table>

</div>	
</body>
</html>