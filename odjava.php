<?php
include_once 'baza.class.php';
$baza=new baza();
session_start();
$kime=$_SESSION['kime'];

session_destroy();
header('Location:prijava.php');
?>