<script language="javascript">

//Fonction qui permet d'agrandir l'image quand on fait passer la souris dessus
function agrandirImage(photo){
	photo.style.width="100px";
	photo.style.height="100px";
}

//Fonction qui permet de rendre l'image à sa taille initiale quand on enlève la souris
function normalImage(photo){
	photo.style.width="40px";
	photo.style.height="40px";
}

//Fonction qui permet de changer la langue lorsqu'on la choisit dans le formulaire
function changeLangue(){
	document.getElementById('form').submit();
}

</script>


<!-- Formulaire pour choisir la langue -->
<form id='form'>
<table>
	<tr>
		<td>
			<select name="langue" id="langue" onchange="changeLangue()">
				<option value="Fr_fr" id="Fr_fr" <?php if(isset($_GET['langue']) and $_GET['langue']=="Fr_fr") echo "selected=1"; ?> >Fran&ccedilais</option>
				<option value="An_us" id="An_us" <?php if(isset($_GET['langue']) and $_GET['langue']=="An_us") echo "selected=1"; ?> >Anglais</option>
			</select>
		</td>
	</tr>
</table>
</form>


<?php 

//Importer le fichier 'Fr_fr' ou le fichier 'An_us' selon le choix dans le formulaire de langue
$file='Fr_fr';
if(isset($_GET['langue']))
	$file=$_GET['langue'];
require $file.'.php';


//Si la session n'est pas ouverte : renvoyer vers la page d'authentification
session_start();
if(!isset($_SESSION['user']))
	header('location:auth.php');

//Appeler le fichier mesfonctions.php pour la traçabilité
require 'mesfonctions.php';


//Déterminer un temps maximum d'inactivité pour la session
require 'ponom.php';
if(time()-$_SESSION['lat']>$ttl)
	header('location:deconnexion.php');
else
	$_SESSION['lat']=time();



//Afficher le message de bienvenue
echo "<h3>".$welcome." ".$_SESSION['user']."</h3>";


require 'Connexion.php';
echo "<h3><center><font color=C0392B><u>TOUS LES PRODUITS</u></font></center></h3>";

//Nombre de produits
$querynbp="select count(*) from produits where 1";
$resultnbp=mysqli_query($connect,$querynbp);
$nbp=mysqli_fetch_array($resultnbp)['count(*)'];


if($nbp){
	$query="select * from produits where 1";


	//Si un critère de recherche est donné 
	if(isset($_POST['critere'])){
		$critere=$_POST['critere'];
		$query="select * from produits where designation like '%$critere%' or description like '%$critere%'";
		$querynbp="select count(*) from produits where designation like '%$critere%' or description like '%$critere%'";
		$resultnbp=mysqli_query($connect,$querynbp);
		$nbp=mysqli_fetch_array($resultnbp)['count(*)'];
	}
	$result=mysqli_query($connect,$query);

	//Traçabilité
	trace($query);

	//Si il y a un produit qui répond au critère de recherche
	if($nbp){

		//Champ de recherche
		echo "<div align=right>";
		echo "<table cellspacing=5>";
		echo "<tr>";
		echo "<td><b><font color=#4993AD><i>Rechercher sur eshop</i></b></td>";
		echo "<td><a href=searchprod.php><img src=icone_recherche.png height=25 width=25 alt=icone de recherche></img></a>";
		echo "</tr></table></div>";


		//Si la personne connectée est un admin
		if($_SESSION['droit']=='ad'){

			//Champ d'ajout
			echo "<div align=right>";
			echo "<table cellspacing=5>";
			echo "<tr>";
			echo "<td><b><font color=#4993AD><i>Ajouter un produit</i></b></td>";
			echo "<td><a href=formprod.php><img src=icone_ajout.png height=25 width=25 alt=icone d'ajout></img></a></td>";
			echo "</tr></table></div>";
		}

		//Tableau des produits
		echo "<center><table cellpadding=5 border=1>";
		echo "<tr>";
		if($_SESSION['droit']=='ad')
			echo "<td></td>";
		echo "<td><b>Numéro</b></td>";
		echo "<td><b>Nom</b></td>";
		echo "<td><b>Description</b></td>";
		echo "<td><b>Prix</b></td>";
		echo "<td><b>Date de Fabrication</b></td>";
		echo "<td><b>Type</b></td>";
		echo "<td><b>Photo</b></td>";
		echo "<td><b>Catégorie</b></td>";

		//Si la personne connectée est un admin
		if($_SESSION['droit']=='ad'){
			echo "<td><b><font color=#4993AD><i>Supprimer</i></b></td>";
			echo "<td><b><font color=#4993AD><i>Modifier</i></b></td>";
		}

		echo "</tr>";


		//Si la personne connectée est un admin
		if($_SESSION['droit']=='ad'){

			//Ouverture du formulaire pour la suppression en lot
			echo "<form action=dellotofprods.php method=POST>";

		}



		while($prod=mysqli_fetch_array($result)){

			echo "<tr>";

			//Si la personne connectée est un admin
			if($_SESSION['droit']=='ad'){

				//Ajout de la colonne de sélection
				echo "<td><input type=checkbox name='suppr[]' value=$prod[0]></td>";

			}


			echo "<td>".$prod['id']."</td>";
			echo "<td>".$prod['designation']."</td>";
			echo "<td>".$prod['description']."</td>";
			echo "<td>".$prod['prix']."</td>";
			echo "<td>".$prod['dateFabrication']."</td>";

			//Dans le champ type, afficher "Au poids" ou "A l'unité" au lieu de "p" ou "u"
			if($prod[5]=='p')
				echo "<td>Au poids</td>";
			else
				echo "<td>A l'unité</td>";


			//Afficher la photo
			echo "<td><img src=photos/$prod[8].jpeg height=40 width=40 alt=photo du produit onmouseover=agrandirImage(this) onmouseout=normalImage(this)></td>";


			//Dans le champ catégorie, afficher la désignation au lieu de l'id de la catégorie
			$querycat="select designation from categories where $prod[7]=id";
			$resultcat=mysqli_query($connect,$querycat);
			$cat=mysqli_fetch_array($resultcat);
			echo "<td>".$cat['designation']."</td>";


			//Si la personne connectée est un admin
			if($_SESSION['droit']=='ad'){

				//Ajout de la colonne de suppression 
				echo "<td align=center><a href=delprod.php?num=$prod[0]><img src=icone_de_suppression.png height=25 width=25 alt=icone de suppression></img></a></td>";

				//Ajout de la colonne de modification
				echo "<td align=center><a href=editprod.php?num=$prod[0]><img src=icone_modification.png height=25 width=25 alt=icone de modification></img></a></td>";
			}

			echo "</tr>";
		}

		echo "<tr>";

		//Si la personne connectée est un admin
		if($_SESSION['droit']=='ad')
			echo "<td colspan=10 align=center><b>Nombre de produits</b></td>";


		//Si la personne connectée n'est pas un admin
		else
			echo "<td colspan=7 align=center><b>Nombre de produits</b></td>";

		
		echo "<td>$nbp</td>";
		echo "</tr></table></center>";

		//Si la personne connectée est un admin
		if($_SESSION['droit']=='ad'){

			//Fermeture du formulaire pour la suppression en lot
			echo "<input type=submit value=Supprimer>";
			echo "</form>";

		}


		//Bouton de déconnexion
		echo "<br><br><br><br>";
		echo "<table cellspacing=5>";
		echo "<tr>";
		echo "<td><b><font color=#4993AD><i>Se déconnecter</i></b></td>";
		echo "<td><a href=deconnexion.php><img src=icone_deconnexion.png height=25 width=25 alt=icone de déconnexion></img></a>";
		echo "</tr></table>";
	}

	//Si il n'y aucun produit qui répond au critère de recherche
	else{
		echo "<h2>Aucun produit ne répond à votre critère de recherche</h2>";

		//Lien pour revenir à tous les produits
		echo "<a href=All_products.php><b>Tous les produits</b></a>";

		//Bouton de déconnexion
		echo "<br><br><br><br>";
		echo "<table cellspacing=5>";
		echo "<tr>";
		echo "<td><b><font color=#4993AD><i>Se déconnecter</i></b></td>";
		echo "<td><a href=deconnexion.php><img src=icone_deconnexion.png height=25 width=25 alt=icone de déconnexion></img></a>";
		echo "</tr></table>";
	}

}

//Si il n'y a aucun produit dans la base de données
else{

	echo "<h2>Aucun produit</h2>";

	//Si la personne connectée est un admin
	if($_SESSION['droit']=='ad'){

		//Champ d'ajout
		echo "<table cellspacing=5>";
		echo "<tr>";
		echo "<td><b><font color=#4993AD><i>Ajouter un produit</i></b></td>";
		echo "<td><a href=formprod.php><img src=icone_ajout.png height=25 width=25 alt=icone d'ajout></img></a>";
		echo "</tr></table></div>";

	}


	//Bouton de déconnexion
	echo "<br><br><br><br>";
	echo "<table cellspacing=5>";
	echo "<tr>";
	echo "<td><b><font color=#4993AD><i>Se déconnecter</i></b></td>";
	echo "<td><a href=deconnexion.php><img src=icone_deconnexion.png height=25 width=25 alt=icone de déconnexion></img></a>";
	echo "</tr></table>";

}


mysqli_close($connect);
?>
