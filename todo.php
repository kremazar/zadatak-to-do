<?php
ini_set('default_charset', 'UTF-8');
$poruka="";
include_once 'baza.class.php';
session_start();
$baza=new baza();
if(isset($_SESSION['kime'])){
$korisnik=$_SESSION['kime']; 
$user = "SELECT ID FROM user where user='$korisnik'";
$nasao = $baza->selectDB($user);
$ID=mysqli_fetch_array($nasao);
$user2 = "SELECT user FROM user where ID='$ID[0]'";
$nasao2 = $baza->selectDB($user2);
$ID2=mysqli_fetch_array($nasao2);
}

if(isset($_POST['submit'])){
    $task=$_POST['task'];
    if(empty($task)){
        $poruka="Niste upisali task";
    }else{
        $upit2 = "INSERT INTO task (ID,task,ID_user) VALUES (DEFAULT,'$task','$ID[0]');";
        $baza->updateDB($upit2);
        header('Location:todo.php');
    }

}
$upit2 = "SELECT * FROM task where ID_user=$ID[0]";
$rezultat = $baza->selectDB($upit2);
if (isset ($_GET['obrisi'])){
    $id=$_GET['obrisi'];
    $upit3 = "DELETE from task where id=$id";
    $rezultat3 = $baza->selectDB($upit3);  
    header('Location:todo.php');  
}
if(isset($_POST['preimenuj'])){
    $id=$_GET['preimenuj'];
    $preinaka=$_POST['preimenuj'];
    $upit4 = "update  task set task='$preinaka' where id=$id";
    $rezultat4 = $baza->selectDB($upit4);  
    header('Location:todo.php'); 
}

?>
<!DOCTYPE html>
<html>
<link rel="stylesheet" type="text/css" href="todo.css">
<body>
<div id="forma">
<?php if (isset($_SESSION['kime'])){ echo '<a href="odjava.php">Odjava</a>';} ?>
<?php if (!isset($_SESSION['kime'])){ echo '<a href="prijava.php">Prijava</a>';} ?>
<h1>Dobrodošli u todo aplikaciju <?php if(isset($_SESSION['kime'])){$korisnik=$_SESSION['kime']; echo $korisnik;} ?></h1>
<?php if (!isset($_SESSION['kime'])){echo '<a href="prijava.php">Prijava</a>';}  ?>
<?php if (isset($_SESSION['kime'])&& ($_SESSION['kime']==$ID2[0])) {?>
<form action="" method="post">
  <input type="text" name="task" id="task" class="input">
<button type="submit" name="submit" class="botun" >Dodaj</button>
<?php if (isset($poruka)){ echo $poruka;}?>
<table>
    <thead>
        <tr>
            <th>Broj</th>
            <th>Task</th>
            <th>Opcije</th>
        </tr>
    </thead>
    <tbody>
    <?php $i=1; while ($row=mysqli_fetch_array($rezultat)) { ?>
        <tr>
            <th><?php echo $i; ?></th>
            <th class="task"><?php echo $row['task'];?></th>
            <th class="obrisi">
                <a href="todo.php?obrisi=<?php echo $row['ID']; ?>">Obrisi</a> 
            </th>
            <th>
                <a href="todo.php?preimenuj=<?php echo $row['ID']; ?>">Preimenuj</a> 
            </th>
        </tr>
    <?php $i++; } ?>  
    </tbody>
    
</table>
<?php if(isset($_GET['preimenuj'])){ ?>
                <input type="text" name="preimenuj" id="preimenuj">
                <button type="submit" name="preinaka" >Preimenuj</button>
           <?php } ?> 
</form> 
<?php }?>
</div>
</body>
</html>
