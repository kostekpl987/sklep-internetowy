<?php

session_start();
$host="localhost";
$user="root";
$pass="";
$db="sklep";

$link=@mysqli_connect($host,$user,$pass,$db);
if(!$link){
	echo mysqli_connect_error();
}
if (!isset($_SESSION['login']) && !isset($_SESSION['haslo'])){
header("location:logowanie.php");
}
$stan="w trakcie";

$query="INSERT INTO zamowienia (id_klient, stan) values ('$_SESSION[id]','$stan')";
        
        mysqli_query($link, $query); 
        $query="SELECT * FROM zamowienia WHERE id=(Select MAX(id) FROM zamowienia) "; 
        $result=mysqli_query($link, $query); 
        $wynik = mysqli_fetch_array($result);  
        $licz = mysqli_num_rows($result); 
        $id=$wynik['id'];
        echo $id;
foreach ($_SESSION["shopping_cart"] as $product){
	$query="INSERT INTO zamowienia_produkty (id_produktu,id_zamowienia, ilosc) values ('$product[id]','$id','$product[ilosc]')";
        mysqli_query($link, $query); 
}
unset($_SESSION['shopping_cart']);
header("location:cart.php");

















?>