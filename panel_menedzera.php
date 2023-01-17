<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="menedzer.css">
	<meta charset="utf-8">
	<title>Panel Menedżera</title>
</head>
<body>
	<?php
	session_start();
	if(!isset($_SESSION['login_w']) && !isset($_SESSION['haslo_w'])){
		header("location:logowanie.php");
	}

$host = 'localhost';
		$username = 'root';
$password = '';
$db = 'sklep';

$link = mysqli_connect($host, $username, $password, $db);

if (!$link) {
	die("Blad polaczenia " . mysqli_connect_error());
}



	?>
<header>
		<input class="menu-btn" type="checkbox" id="menu-btn">
		<label class="menu-icon" for="menu-btn">
			<span class=navicon></span>
		</label>
		<ul class="menu">
			
			<li><a href='wyloguj.php'>Wyloguj</a></li>
		</ul>
			
	</header>		
<main>
	<div>
			<div class="inwentaryzacja">
				<h3>Inwentaryzacja</h3>
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
					</tr>
					<?php 

$result=mysqli_query($link,"SELECT * from produkty where kosz=1");

while ($wynik = mysqli_fetch_array($result)){
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
	echo "</tr>";
}






					?></table>
			</div>
			<h3>Zamówienia</h3>
			<div class="zamowienia">
				<table>
					<tr>
						<th>Zdjęcie</th>
						<th>Nazwa</th>
						<th>Ilość</th>
					</tr>
				<?php 
				$query="SELECT * FROm zamowienia where stan ='w trakcie'";
				$result=mysqli_query($link, $query);
				while($wynik = mysqli_fetch_array($result)){
					$id_z=$wynik['id'];
				$query2="SELECT * FROm uzytkownicy where id=$wynik[id_klient]";
				$result2=mysqli_query($link, $query2);
					while ($wynik2 = mysqli_fetch_array($result2)) {
						$klient=$wynik2['email'];
						$miejsce=$wynik2['zamieszkanie'];
						
					}
				$query2="SELECT * FROm zamowienia_produkty where id_zamowienia=$wynik[id]";
				$result2=mysqli_query($link, $query2);
					while ($wynik2 = mysqli_fetch_array($result2)) {
						$ilosc=$wynik2['ilosc'];
						$query3="SELECT * FROM produkty where id=$wynik2[id_produktu]";
						$result3=mysqli_query($link, $query3);
						while ($wynik3= mysqli_fetch_array($result3)) {
							$nazwa=$wynik3['nazwa'];
							$zdjecie=$wynik3['zdjecie'];
							echo "<tr>";
							?><td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($zdjecie); ?> "></td>
							 <?php
							 echo "<td>$nazwa</td>";
							 echo "<td>$ilosc</td>";
							 echo "</tr>";	
						}
					}	
					echo "<tr><th >Klient</th>";echo "<th colspan=2>Miejsce dowozu</th><tr>";
					echo "<tr><td >$klient</td>";echo "<td colspan=2>$miejsce</td><tr>";	
					echo "<tr><td colspan=3><form action=zatwierdz.php method=POST>
						<input type=hidden name=id value=$id_z;>
						<input class=zatwierdz type=submit value=Zatwierdź>


					</form></td></tr>";		
				}




				?>
			</table>
			</div>





<h3>Statystyki</h3>

			<div class="statystyki">
				
				<div class="naj_zam">
					<?php 
					$naj=0;
					$id_naj=0;
					$query="SELECT * FROM uzytkownicy";
					$result= mysqli_query($link,$query);
					while ($wynik = mysqli_fetch_array($result)) {
						$query2="SELECT COUNT(id_klient) as naj FROM zamowienia WHERE id_klient=$wynik[id]";
						$result2= mysqli_query($link,$query2);
						$wynik2 = mysqli_fetch_array($result2);
						
						if ($wynik2['naj']>$naj) {
							$naj=$wynik2['naj'];
							$id_naj=$wynik['id'];
						}

					}
					





					?>
				</div>
				<div class="min_zam">
										<?php 
					$min=0;
					$id_min=0;
					$query="SELECT * FROM uzytkownicy";
					$result= mysqli_query($link,$query);
					while ($wynik = mysqli_fetch_array($result)) {
						$query2="SELECT COUNT(id_klient) as min FROM zamowienia WHERE id_klient=$wynik[id]";
						$result2= mysqli_query($link,$query2);
						$wynik2 = mysqli_fetch_array($result2);
						
						if ($wynik2['min']<$min) {
							$min=$wynik2['min'];
							$id_min=$wynik['id'];
						}

					}
					





					?>
				</div>
				<div class="naj_kaski">
										<?php 
										$pieniedzy=0;
										$pieniedzy_naj=0;
										$id_pi_naj=0;
					$query="SELECT * FROM uzytkownicy";
					$result= mysqli_query($link,$query);
					while ($wynik = mysqli_fetch_array($result)) {
						$query2="SELECT * FROM zamowienia WHERE id_klient=$wynik[id] AND stan!='w trakcie'";
						$result2= mysqli_query($link,$query2);
						while($wynik2 = mysqli_fetch_array($result2)){

						$query3="SELECT * FROM zamowienia_produkty where id_zamowienia=$wynik2[id]";
						$result3= mysqli_query($link,$query3);
						while($wynik3 = mysqli_fetch_array($result3)){
							
						$query4="SELECT * FROM produkty where id=$wynik3[id_produktu]";
						$result4= mysqli_query($link,$query4);
						while($wynik4 = mysqli_fetch_array($result4)){
							$przychod=$wynik4['cena_klient']-$wynik4['cena_z'];
							$pieniedzy= $przychod*$wynik3['ilosc']+$pieniedzy;






						}

						}

						}
							if ($pieniedzy>$pieniedzy_naj) {
								$pieniedzy_naj=$pieniedzy;
								$id_pi_naj=$wynik['id'];

							}	
							$pieniedzy=0;		

					}
					echo $pieniedzy_naj."<br>".$id_pi_naj;					


					?>					
				</div>
				<div class="min_kaski">
					<?php 
										$pieniedzy=0;
										$pieniedzy_min=0;
										$id_pi_min=0;
					$query="SELECT * FROM uzytkownicy";
					$result= mysqli_query($link,$query);
					while ($wynik = mysqli_fetch_array($result)) {
						$query2="SELECT * FROM zamowienia WHERE id_klient=$wynik[id] AND stan!='w trakcie'";
						$result2= mysqli_query($link,$query2);
						while($wynik2 = mysqli_fetch_array($result2)){

						$query3="SELECT * FROM zamowienia_produkty where id_zamowienia=$wynik2[id]";
						$result3= mysqli_query($link,$query3);
						while($wynik3 = mysqli_fetch_array($result3)){
							
						$query4="SELECT * FROM produkty where id=$wynik3[id_produktu]";
						$result4= mysqli_query($link,$query4);
						while($wynik4 = mysqli_fetch_array($result4)){
							$przychod=$wynik4['cena_klient']-$wynik4['cena_z'];
							$pieniedzy= $przychod*$wynik3['ilosc']+$pieniedzy;






						}

						}

						}
							if ($pieniedzy<$pieniedzy_min || $pieniedzy_min==0){
								$pieniedzy_min=$pieniedzy;
								$id_pi_min=$wynik['id'];
							}			
							$pieniedzy=0;
					}
					echo $pieniedzy_min."<br>".$id_pi_min;



					?>
				</div>
			</div>
	</div>
</main>

</body>
</html>