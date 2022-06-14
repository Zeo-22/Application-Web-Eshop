<?php 
require 'Connexion.php';
//print_r($_POST);
$des=$_POST['des'];
$desc=$_POST['desc'];
$prix=$_POST['prix'];
$type=$_POST['type'];
$fabri=$_POST['fabri'];
$cat=$_POST['cat'];

//Appeler le fichier mesfonctions.php pour la traçabilité
require 'mesfonctions.php';

//Si la taille de la photo est supérieure à 400Ko, Alors ne pas insérer le produit
require 'ponom.php';
if($_FILES['photo']['size']>$maxfilesize){
	echo "Vous avez dépassé la taille de photo autorisée. Veuillez cliquer sur le lien ci-dessous pour ajouter à nouveau votre produit.<br>";
	echo "<a href=formprod.php>Revenir au formulaire</a>";
}

//Si l'extension de la photo n'est ni jpeg ni jpg, Alors ne pas insérer le produit
elseif($_FILES['photo']['type']!='image/jpeg' and $_FILES['photo']['type']!='image/jpg') {
	echo "Le format de la photo n'est pas autorisé. Veuillez cliquer sur le lien ci-dessous pour ajouter à nouveau votre produit.<br>";
	echo "<a href=formprod.php>Revenir au formulaire</a>";
}

//Sinon, déplacer la photo vers le répertoire photos, et insérer le produit
else{
	$path=uniqid();
	move_uploaded_file($_FILES['photo']['tmp_name'],'photos/'.$path.'.jpeg');
	$query="insert into produits values(null,'$des','$desc',$prix,'$fabri','$type','','$cat','$path')";

	//Reprendre la session
	session_start();

	//Traçabilité
	trace($query);

	mysqli_query($connect,$query);
	header('location:All_products.php');
}
mysqli_close($connect);
?>