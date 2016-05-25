<?php
session_start();
$pemail = $_POST["email"];
$pwachtwoord = $_POST["wachtwoord"];
$email = $_SESSION["email"];
$wachtwoord = $_SESSION["wachtwoord"];

if(!empty($email) && ($wachtwoord)){
	header('Location: lijsten.php');
}else if(!empty($pemail) && ($pwachtwoord)){
	$_SESSION["email"] = $pemail;
	$_SESSION["wachtwoord"] = $pwachtwoord;
	header('Location: lijsten.php');
}else{
	header('Location: index.php');
}
?>