<?php
include 'connexion.php';
// 1- recuperation
$user = $_POST['login'];
$pass = $_POST['pass'];

// 3- Préparation
$row = "SELECT * FROM `users` where UserName='".$user."' and Password='".$pass."' ";

// 4- Exécution
$exect = mysqli_query($conn,$row);

$array = mysqli_fetch_array($exect);
// 5- verification
$result = mysqli_num_rows($exect);

if($result == 0){
	echo "merci de vérifier votre pseudo ou mot de passe";
	header("location:index.php?error");
}else{
	
	echo "vous êtes connecté";
	$_SESSION['auth']=true;
	$_SESSION['id']=$array['UserID'];
	$_SESSION['FullName']=$array['FullName'];
	
	
	header("location:dashboard.php");
	
}
