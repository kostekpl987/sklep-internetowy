<?php


$host = 'localhost';
$username = 'root';
$password = '';
$db = 'sklep';
$id=$_POST['id'];
$link = mysqli_connect($host, $username, $password, $db);
if (!$link) {
	die("Blad polaczenia " . mysqli_connect_error());
}
session_start();


if (isset($_POST['id']) && $_POST['id']!=""){
$id = $_POST['id'];
$result = mysqli_query($link,"SELECT * FROM `produkty` WHERE id='$id'"
);
$wynik = mysqli_fetch_assoc($result);
$cartArray = array($id=>array('ilosc'=>$_POST['ilosc'], 'id'=>$id));

if(empty($_SESSION["shopping_cart"]) || !isset($_SESSION['shopping_cart'])) {
    $_SESSION["shopping_cart"] = $cartArray;
    
}else{
	$pomocnicza=0;
foreach ($_SESSION['shopping_cart'] as $key => $value) {
        if ($_SESSION['shopping_cart'][$key]['id']==$_POST['id']) {
        $_SESSION['shopping_cart'][$key]['ilosc']=$_POST['ilosc'];
        $pomocnicza++;
        }

}
if($pomocnicza==0)
$_SESSION['shopping_cart']=array_merge($_SESSION['shopping_cart'],$cartArray);

}
}

header("location:sklep.php");
?>