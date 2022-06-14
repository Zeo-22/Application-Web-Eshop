<?php
require 'Connexion.php';

//Appeler le fichier mesfonctions.php pour la traçabilité
require 'mesfonctions.php';

//print_r($_POST);
$suppr=$_POST['suppr'];
foreach($suppr as $numprod){
	$query="delete from produits where id=$numprod";

	//Reprendre la session
	session_start();

	//Traçabilité
	trace($query);

	mysqli_query($connect,$query);
}
mysqli_close($connect);
header('location:All_products.php');
?>


