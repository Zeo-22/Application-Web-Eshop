<?php
require 'Connexion.php';

//Appeler le fichier mesfonctions.php pour la traçabilité
require 'mesfonctions.php';

$numprod=$_GET['num'];
//print_r($_GET);
$query="delete from produits where id=$numprod";

//Reprendre la session
session_start();

//Traçabilité
trace($query);

//echo "$query";
mysqli_query($connect,$query);
mysqli_close($connect);
header('location:All_products.php');
?>
