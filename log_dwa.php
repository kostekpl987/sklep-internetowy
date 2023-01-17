<?php  
$host="localhost";
$user="root";
$pass="";
$db="sklep";

$link=@mysqli_connect($host,$user,$pass,$db);
if(!$link){
	echo mysqli_connect_error();
}
$login=trim($_POST['email']);
$haslo=md5(trim($_POST['haslo']));
$query="SELECT * FROM uzytkownicy WHERE email='$login' AND haslo='$haslo'";
        
        $result = mysqli_query($link, $query);  
        $wynik = mysqli_fetch_array($result);  
        $licz = mysqli_num_rows($result);  

        if($licz == 1){  
         session_start();
$_SESSION['login']=$login;
$_SESSION['haslo']=$haslo;
$_SESSION['id']=$wynik['id'];

$_SESSION['zamieszkanie']=$wynik['zamieszkanie'];
$_SESSION['telefon']=$wynik['telefon'];
$_SESSION['kod']=$wynik['kod_pocztowy'];
header("location:sklep.php");
        }  
        else{  
        	$query="SELECT * FROM admin WHERE email='$login' AND haslo='$haslo'";
        
        $result = mysqli_query($link, $query);  
        $wynik = mysqli_fetch_array($result);  
        $licz = mysqli_num_rows($result); 
        if($licz == 1){
        	session_start();
        	$_SESSION['admin']=$login;
			$_SESSION['admin_h']=$haslo;
			header("location:panel_admin.php");
        }else{
            $query="SELECT * FROM wlasciciel WHERE login='$login' AND haslo='$haslo'";
        
        $result = mysqli_query($link, $query);  
        $wynik = mysqli_fetch_array($result);  
        $licz = mysqli_num_rows($result); 
        if($licz == 1){
                session_start();
                $_SESSION['login_w']=$login;
                        $_SESSION['haslo_w']=$haslo;
                        header("location:panel_menedzera.php");    
        	
        }else{
                       session_start();
            $_SESSION['blad']="Niepoprawny login lub haslo.";
            header("location:logowanie.php");       
        }

        }     
}


?>