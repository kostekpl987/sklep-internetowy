<?php  
$host="localhost";
$user="root";
$pass="";
$db="sklep";
session_start();
$link=@mysqli_connect($host,$user,$pass,$db);
if(!$link){
	echo mysqli_connect_error();
}
if (isset($_POST['admin'])) {
	$email=$_POST['email'];
	$haslo=md5($_POST['haslo']);
	$query="INSERT INTO admin (email, haslo) VALUES ('$email','$haslo')";
$result=mysqli_query($link,$query);
	header("location:panel_admin.php");
}elseif (!empty($_POST['email']) && !empty($_POST['haslo']) && !empty($_POST['mieszkanie']) && !empty($_POST['numer']) && !empty($_POST['kod'])) {

$email=$_POST['email'];
if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i", $email)) {
	$_SESSION['blad']="Nieprawidłowy email.";

header("location:rejestracja.php");
}
else{
$haslo=$_POST['haslo'];
if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/", $haslo)) {
	$_SESSION['blad']="Nieprawidłowe hasło.";
header("location:rejestracja.php");

}
else{
$telefon=$_POST['numer'];
if (!preg_match("/^[0-9]{3}-[0-9]{3}-[0-9]{3}$/", $telefon)) {
	$_SESSION['blad']="Nieprawidłowy numer telefonu.";

header("location:rejestracja.php");
}
else{
$zamieszkanie=trim($_POST['mieszkanie']);
$kod=trim($_POST['kod']);
$haslo=md5($_POST['haslo']);

        	$query="SELECT * FROM uzytkownicy WHERE email='$email'";
        
        $result = mysqli_query($link, $query);  
        $wynik = mysqli_fetch_array($result);  
        $licz = mysqli_num_rows($result); 
        if($licz >= 1){
        		$_SESSION['blad']="Konto o danym mailu już istnieje.";
header("location:rejestracja.php");
        }
else{
$query="INSERT INTO uzytkownicy (email, haslo,  zamieszkanie, telefon, kod_pocztowy) VALUES ('$email','$haslo','$zamieszkanie','$telefon','$kod')";
$result=mysqli_query($link,$query);	
$_SESSION['komunikat']="Pomyślnie utworzono konto";
header("location:logowanie.php");	
}

}	
}	
}











	
}
else{
$_SESSION['blad']="Proszę wypełnić wszystkie pola.";

header("location:rejestracja.php");
}


?>