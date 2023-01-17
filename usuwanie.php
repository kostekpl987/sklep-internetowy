<?php  

$host = 'localhost';
$username = 'root';
$password = '';
$db = 'sklep';

$link = mysqli_connect($host, $username, $password, $db);
if (!$link) {
	die("Blad polaczenia " . mysqli_connect_error());
}
$id=$_POST['id'];

$query="UPDATE produkty set kosz=0 where id=$id";
mysqli_query($link, $query);
header("location:panel_admin.php");






?>