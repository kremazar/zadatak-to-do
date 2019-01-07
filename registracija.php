<?php
include_once 'baza.class.php';
$baza=new baza();
$poruka= "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$ime=$_POST['ime'];
	$prezime=$_POST['prezime'];
	$kime=$_POST['kime'];
	$email=$_POST['email'];
  $lozinka=$_POST['lozinka'];
  $ponlozinku=$_POST['ponlozinku'];
  $password1 = $_POST['lozinka'];
  $password2 = $_POST['ponlozinku'];
    
    $upit = "SELECT * FROM user WHERE user='$kime'";
    $rezultat = $baza->selectDB($upit);
    if($rezultat->num_rows > 0){
        $poruka="Korisničko ime nije slobodno";
    }
    if ($password1 != $password2){
	    $poruka= "Nije ista lozinka";
    }
    if(empty($poruka)){

        $upit2 = "INSERT INTO user (ID,ime, prezime, user,email, lozinka) VALUES (DEFAULT,'$ime', '$prezime','$kime', '$email', '$lozinka');";
        $baza->updateDB($upit2);
        header('Location:prijava.php');
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
  <label for="ime">Ime:</label>
  <input type="text" name="ime" id="ime">
  <br>
  <label for="prezime">Prezime:</label>
  <input type="text" name="prezime" id="prezime" >
  <br>
  <label for="kime">Korisničko ime:</label>
  <input type="text" name="kime" id="kime">
  <br>
  <label for="email">E-mail:</label> 
  <input type="text" name="email" id="email">
  <br>
  <label for="lozinka">Lozinka:</label>
  <input type="text" name="lozinka" id="lozinka" >
  <br>
  <label for="ponlozinku">Ponovi lozinku:</label>
  <input type="text" name="ponlozinku" id="ponlozinku">
  <br><br>
  <input type="submit" value="Registriraj">
  <br><br>
</form> 
</div>
</body>
</html>