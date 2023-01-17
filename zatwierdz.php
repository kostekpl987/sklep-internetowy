<?php 


//usuwa za bazy przedmioty

$host = 'localhost';
		$username = 'root';
$password = '';
$db = 'sklep';
$id=$_POST['id'];
$link = mysqli_connect($host, $username, $password, $db);

if (!$link) {
	die("Blad polaczenia " . mysqli_connect_error());
}
$query="UPDATE zamowienia set stan='wysłano' where id=$id";

mysqli_query($link,$query);

$query="SELECT * FROM zamowienia_produkty where id_zamowienia=$id";
$result=mysqli_query($link,$query);
while ($wynik = mysqli_fetch_array($result)) {

$query3="UPDATE produkty set ilosc=ilosc-$wynik[ilosc] where id=$wynik[id_produktu]";
mysqli_query($link, $query3);

}

header("location:panel_menedzera.php");













?>