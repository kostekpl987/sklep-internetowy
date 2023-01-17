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
  
  if (!empty($_POST['login'])) {
  	if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $_POST['login'])) {
	$_SESSION['blad']="Nieprawidłowy email.";

header("location:profil.php");
}else{
$zmienna=$_POST['login']; 
$query="UPDATE uzytkownicy set email='$zmienna' where id='$id'";
mysqli_query($link,$query);
$_SESSION['login']=$zmienna;}
}
if (!empty($_POST['zamieszkanie'])) {
$zmienna=$_POST['zamieszkanie']; 
$query="UPDATE uzytkownicy set zamieszkanie='$zmienna' where id='$id'";
mysqli_query($link,$query);
$_SESSION['zamieszkanie']=$zmienna;
}
if (!empty($_POST['kod'])) {
$zmienna=$_POST['kod']; 
$query="UPDATE uzytkownicy set kod_pocztowy='$zmienna' where id='$id'";
mysqli_query($link,$query);
$_SESSION['kod']=$zmienna;
}
if (!empty($_POST['telefon'])) {
	if (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{3}$/", $_POST['telefon'])) {
	$_SESSION['blad']="Nieprawidłowy numer telefonu.";

header("location:profil.php");
}
	else{
$zmienna=$_POST['telefon']; 
$query="UPDATE uzytkownicy set telefon='$zmienna' where id='$id'";
mysqli_query($link,$query);
$_SESSION['telefon']=$zmienna;}
}
if (!empty($_POST['haslo'])) {
	if (!empty($_POST['haslo_s'])) {
		if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $_POST['haslo'])) {
	$_SESSION['blad']="Nieprawidłowe hasło.";
header("location:profil.php");

}else
			if (md5($_POST['haslo_s'])==$_SESSION['haslo']) {
			$zmienna=$_POST['haslo']; 
$query="UPDATE uzytkownicy set haslo='$zmienna' where id='$id'";
mysqli_query($link,$query);	
$_SESSION['haslo']=$zmienna;
			}
			else{
			$_SESSION['blad']="Złe hasło spróbuj ponownie.";
		header("location:profil.php");
			}
	}
	else
	{
		$_SESSION['blad']="Wypełnij pole z poprzednim haslem.";
		header("location:profil.php");
	}

}
header("location:profil.php");

?>