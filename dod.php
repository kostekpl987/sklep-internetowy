<?php  
$host = 'localhost';
$username = 'root';
$password = '';
$db = 'sklep';

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
         

             

        } 
    } else{
        session_start();
        $_SESSION['blad']="Wypełnij wszystkie pola.";
        header("location:panel_admin");
            }
            $ilosc=$_POST['ilosc'];
$data=trim($_POST['data']);
$kategoria=trim($_POST['kat']);
$cena_z=trim($_POST['cena_z']);
$marza=($_POST['marza']);
$nazwa=$_POST['nazwa'];
if (!empty($data) && !empty($kategoria) && !empty($cena_z) && !empty($marza) && !empty($nazwa)) {
        if (!is_int($marza) || !is_int($ilosc)) {
            $cena_klient=$_POST['cena_z']*$_POST['marza']*0.01+$_POST['cena_z'];
            $query="INSERT into produkty (ilosc, zdjecie, data_w,kategoria, cena_z, nazwa, cena_klient, marza) VALUES ('$ilosc','$zdjecie','$data','$kategoria','$cena_z','$nazwa','$cena_klient','$marza')";
            mysqli_query($link, $query);
            header("location:panel_admin.php"); 
         } 
}
else{
            session_start();
        $_SESSION['blad']="Wypełnij wszystkie pola.";
        header("location:panel_admin");
}



?>