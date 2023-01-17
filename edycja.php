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
    if(!empty($_FILES["zdj"]["name"])) { 
        
        $nazwa = basename($_FILES["zdj"]["name"]); 
        $typ = pathinfo($nazwa, PATHINFO_EXTENSION); 
         
        
        $typy = array('jpg','png','jpeg','gif'); 
        if(in_array($typ, $typy)){ 
            $img = $_FILES['zdj']['tmp_name']; 
            $zdjecie = addslashes(file_get_contents($img)); 
         $query="UPDATE produkty set zdjecie='$zdjecie' where id='$id'";
mysqli_query($link,$query);

             

        } 
    } 

$marza_s=$_POST['marza_s'];
$cena_z_s=$_POST['cena_z_s'];
    if(!empty($_FILES["zdj"]["name"])) { 
        
        $nazwa = basename($_FILES["zdj"]["name"]); 
        $typ = pathinfo($nazwa, PATHINFO_EXTENSION); 
         
        
        $typy = array('jpg','png','jpeg','gif'); 
        if(in_array($typ, $typy)){ 
            $img = $_FILES['zdj']['tmp_name']; 
            $zdjecie = addslashes(file_get_contents($img)); 
         $query="UPDATE produkty set zdjecie='$zdjecie' where id='$id'";
        mysqli_query($link,$query);

             

        } 
    } 
if (!empty($_POST['data_w'])) {
$data=$_POST['data_w'];	
$query="UPDATE produkty set data_w='$data' where id='$id'";
mysqli_query($link,$query);
}
if (!empty($_POST['ilosc'])) {
$ilosc=$_POST['ilosc']; 
$query="UPDATE produkty set ilosc='$ilosc' where id='$id'";
mysqli_query($link,$query);
}
if (!empty($_POST['kat'])) {
$kategoria=$_POST['kat'];	
$query="UPDATE produkty set kategoria='$kategoria' where id='$id'";
mysqli_query($link,$query);
}
if (!empty($_POST['cena_z'])) {
$cena_z=$_POST['cena_z'];
$query="UPDATE produkty set cena_z='$cena_z' where id='$id'";
mysqli_query($link,$query);
}
if (!empty($_POST['marza'])) {
$marza=$_POST['marza'];	
$query="UPDATE produkty set marza='$marza' where id='$id'";
mysqli_query($link,$query);
}
if (!empty($_POST['nazwa'])) {
$nazwa=$_POST['nazwa'];	
$query="UPDATE produkty set nazwa='$nazwa' where id='$id'";
mysqli_query($link,$query);
}

if (!empty($_POST['marza']) && empty($_POST['cena_z'])) {
$cena_klient=$_POST['cena_z_s']*$_POST['marza']*0.01+$_POST['cena_z_s'];
$query="UPDATE produkty set cena_klient='$cena_klient' where id='$id'";
mysqli_query($link,$query);	
}
if (!empty($_POST['cena_z']) && empty($_POST['marza'])) {
	$cena_klient=$_POST['cena_z']*$_POST['marza_s']*0.01+$_POST['cena_z'];
$query="UPDATE produkty set cena_klient='$cena_klient' where id='$id'";
mysqli_query($link,$query);	
}
if (!empty($_POST['cena_z']) && !empty($_POST['marza'])) {
	$cena_klient=$_POST['cena_z']*$_POST['marza']*0.01+$_POST['cena_z'];
$query="UPDATE produkty set cena_klient='$cena_klient' where id='$id'";
mysqli_query($link,$query);	
}

header("location:panel_admin.php");


?>