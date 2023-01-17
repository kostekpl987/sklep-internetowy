<?php  


$host = 'localhost';
$username = 'root';
$password = '';
$db = 'sklep';
session_start();
$id=$_SESSION['id'];
$link = mysqli_connect($host, $username, $password, $db);
if (!$link) {
	die("Blad polaczenia " . mysqli_connect_error());
}
$query="DELETE from uzytkownicy where id=$id";
mysqli_query($link, $query);
unset($_SESSION['login']);
unset($_SESSION['haslo']);
unset($_SESSION['telefon']);
unset($_SESSION['kod']);
unset($_SESSION['zamieszkanie']);
unset($_SESSION['id']);
header("location:sklep.php");







?>