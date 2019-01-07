<?php
ini_set('default_charset', 'UTF-8');
include_once 'baza.class.php';
$baza=new baza();
$poruka="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kime=$_POST['kime'];
    $lozinka=$_POST['lozinka']; 

    $upit = "SELECT * FROM user WHERE user='$kime'";
    $rezultat = $baza->selectDB($upit);
    $korisnik = mysqli_fetch_array($rezultat);
    
    if ($rezultat->num_rows == 0) {
        $poruka="nije dobro korisničko ime";
    }else if ($korisnik['lozinka'] != $lozinka) {
                $poruka="nije dobra lozinka";
            }
          
            else {
                session_start();
                $_SESSION['kime'] = $korisnik['user'];
                header('Location:todo.php');
                exit();
            }
 }
?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="todo.css">
<body>
<div id="forma">
<?php if ($poruka != "") echo $poruka . "<br><br>"?>
<form action="" method="post">
  <label for="kime">Korisničko ime: </label>
  <input type="text" name="kime" id="kime">
  <br>
  <label for="lozinka">Lozinka:</label>
  <input type="text" name="lozinka" id="lozinka" >
  <br>
  <input type="submit" value="Prijava">
  <br><br>
</form> 
</div>
</body>
</html>