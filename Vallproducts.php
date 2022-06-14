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
</script>

<?php

echo "<h3><center><font color=C0392B><u>TOUS LES PRODUITS</u></font></center></h3>";

//Champ de recherche
echo "<div align=right>";
echo "<table cellspacing=5>";
echo "<tr>";
echo "<td><b><font color=#4993AD><i>Rechercher sur eshop</i></b></td>";
echo "<td><a href=Ctrl.class.php?action=searchprod><img src=icone_recherche.png height=25 width=25 alt=icone de recherche></img></a>";
echo "</tr></table></div>";

//Champ d'ajout
echo "<div align=right>";
echo "<table cellspacing=5>";
echo "<tr>";
echo "<td><b><font color=#4993AD><i>Ajouter un produit</i></b></td>";
echo "<td><a href=Ctrl.class.php?action=formprod><img src=icone_ajout.png height=25 width=25 alt=icone d'ajout></img></a></td>";
echo "</tr></table></div>";

//Tableau des produits
echo "<center><table cellpadding=5 border=1>";
echo "<tr>";
echo "<td><b>Numéro</b></td>";
echo "<td><b>Nom</b></td>";
echo "<td><b>Description</b></td>";
echo "<td><b>Prix</b></td>";
echo "<td><b>Date de Fabrication</b></td>";
echo "<td><b>Type</b></td>";
echo "<td><b>Photo</b></td>";
echo "<td><b>Catégorie</b></td>";
echo "<td><b><font color=#4993AD><i>Supprimer</i></b></td>";
echo "<td><b><font color=#4993AD><i>Modifier</i></b></td>";
echo "</tr>";


foreach ($produits as $prod) {
	echo "<tr>";
	echo "<td>".$prod['id']."</td>";
	echo "<td>".$prod[1]."</td>";
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
	echo "<td>".$prod[7]."</td>";

	//Ajout de la colonne de suppression 
	echo "<td align=center><a href=Ctrl.class.php?action=delprod&amp;num=$prod[0]><img src=icone_de_suppression.png height=25 width=25 alt=icone de suppression></img></a></td>";

	//Ajout de la colonne de modification
	echo "<td align=center><a href=Ctrl.class.php?action=editprod&amp;num=$prod[0]><img src=icone_modification.png height=25 width=25 alt=icone de modification></img></a></td>";

	echo "</tr>";
}

//Ajout de la ligne du nombre de produits
echo "<tr>";
echo "<td colspan=9 align=center><b>Nombre de produits</b></td>";
echo "<td>$nbp[0]</td>";

echo "</table></center>";

//Bouton de déconnexion
echo "<br><br><br><br>";
echo "<table cellspacing=5>";
echo "<tr>";
echo "<td><b><font color=#4993AD><i>Se déconnecter</i></b></td>";
echo "<td><a href=Ctrl.class.php?action=disconnect><img src=icone_deconnexion.png height=25 width=25 alt=icone de déconnexion></img></a>";
echo "</tr></table>";

?>