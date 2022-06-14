<?php
define('HOST','localhost');
define('USER','root');
define('PASS','');
define('DB','eshop');
$connect=mysqli_connect(HOST,USER,PASS,DB);
if($connect==false){
	echo "Problème de connexion";
	exit(); 
}
?>