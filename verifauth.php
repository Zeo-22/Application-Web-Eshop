<?php
require 'Connexion.php';
$log=$_POST['log'];
$mdp=md5($_POST['mdp']);
$query="select count(*) from users where login='$log' and pass='$mdp'";
$result=mysqli_query($connect,$query);
$nblignes=mysqli_fetch_array($result)['count(*)'];
if($nblignes==1){
	session_start();
	$_SESSION['user']=$log;
	$_SESSION['lat']=time();
	$querydroit="select droit from users where login='$log' and pass='$mdp'";
	$resultdroit=mysqli_query($connect,$querydroit);
	$droit=mysqli_fetch_array($resultdroit);
	$_SESSION['droit']=$droit[0];
	header('location:All_products.php');
}
else
	header('location:auth.php');
mysqli_close($connect);
?>