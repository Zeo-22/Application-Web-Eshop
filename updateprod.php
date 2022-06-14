<?php
require 'Connexion.php';

//Appeler le fichier mesfonctions.php pour la traçabilité
require 'mesfonctions.php';

$num=$_POST['num'];
$des=$_POST['des'];
$desc=$_POST['desc'];
$prix=$_POST['prix'];
$type=$_POST['type'];
$fabri=$_POST['fabri'];
$cat=$_POST['cat'];
$query="update produits set designation='$des', description='$desc', prix=$prix, dateFabrication='$fabri', type='$type', numcat=$cat where id=$num";

//Reprendre la session
session_start();

//Traçabilité
trace($query);

mysqli_query($connect,$query);
mysqli_close($connect);
header('location:All_products.php');
?>