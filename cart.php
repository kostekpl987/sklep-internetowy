<?php
$host = 'localhost';
$username = 'root';
$password = '';
$db = 'sklep';

$link = mysqli_connect($host, $username, $password, $db);
if (!$link) {
  die("Blad polaczenia " . mysqli_connect_error());
}
session_start();
if (!isset($_SESSION['login']) && !isset($_SESSION['haslo'])){
header("location:logowanie.php");
}


if (isset($_POST['usun']) && isset($_SESSION['shopping_cart'])){
  foreach($_SESSION["shopping_cart"] as $key => $value) {
if(!empty($_SESSION["shopping_cart"]) && isset($_SESSION["shopping_cart"])) {

        if ($_SESSION['shopping_cart'][$key]['id']==$_POST['id']) {
        unset($_SESSION['shopping_cart'][$key]);  
        }

      
}
else{
  unset($_SESSION["shopping_cart"]);
}
}
}
if (empty($_SESSION['shopping_cart']) || !isset($_SESSION['shopping_cart'])) {
  unset($_SESSION['shopping_cart']);
}
if (!isset($_SESSION['shopping_cart'])) {
  ?> <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Koszyk ale pusty</title>
    <link rel="stylesheet" type="text/css" href="koszyk.css">
  </head>
  <body>
    <header>
    <input class="menu-btn" type="checkbox" id="menu-btn">
    <label class="menu-icon" for="menu-btn">
      <span class=navicon></span>
    </label>
    <ul class="menu">
      <li><a href="sklep.php">Start</a></li><li><a href="cart.php">Koszyk</a></li>
      <li style="height: 76px;"><a style="padding: 10px;" href=
      <?php  
    
      if (isset($_SESSION['login']) && isset($_SESSION['haslo'])) {
        echo "profil.php";

      }
      else
        echo 'logowanie.php';
      ?>><img alt="ikona profil" src="profil.png"></a></li>
      
    </ul>
  </header>
  <h1 style="text-align: center; margin: 0;padding: 100px;">Koszyk jest pusty prosimy przyjść później </h1>
  </body>
  </html>
<?php }
else{
?>







<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="koszyk.css">
  <title>Koszyk</title>
</head>
<body>
  <header>
    <input class="menu-btn" type="checkbox" id="menu-btn">
    <label class="menu-icon" for="menu-btn">
      <span class=navicon></span>
    </label>
    <ul class="menu">
      <li><a href="sklep.php">Start</a></li><li><a href="cart.php">Koszyk</a></li>
      <li style="height: 76px;"><a style="padding: 10px;" href="
      <?php  session_start();
      if (isset($_SESSION['login']) && isset($_SESSION['haslo'])) {
        echo "profil.php";

      }
      else
        echo 'logowanie.php';
      ?>"><img alt="ikona profil" src="profil.png"></a></li>
      
    </ul>
  </header>


<main>
  <table style="padding: 100px;">
    <tr>
      <th>Zdjęcie</th>
      <th>Nazwa</th>
      <th>Ilość</th>
      <th>Cena</th>
      <th>Cena końcowa</th>
      <th>Usuń</th>
    </tr>


<?php   
foreach ($_SESSION["shopping_cart"] as $product){
  $query="SELECT * FROM produkty where id=$product[id]";
  $result=mysqli_query($link,$query);
  $wynik = mysqli_fetch_array($result);
  echo "<tr>";
?>
<td><img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($wynik['zdjecie']); ?>" ></td>
<?php
  echo "<td>$wynik[nazwa]</td>";
  echo "<td>$product[ilosc]</td>";
  echo "<td>$wynik[cena_klient]zł</td>";
  echo"<td>";echo $wynik["cena_klient"]*$product["ilosc"]."zł";echo"</td>";
  echo"<td><form action=cart.php method=POST><input type=hidden name=id value=$product[id]><input name=usun type=submit value=Usuń></form></td>";

  

  echo "</tr>";
}
  ?> 
  



  </table>
</main>

  <form class="wysylaj" action="nowe_zamowienie.php" method="POST">
    <input class="wys" type="submit" name="zamow" value="zamów">
  </form>

</body>
</html>
<?php } ?>