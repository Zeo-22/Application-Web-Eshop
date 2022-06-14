<script language="javascript">

//Fonction qui vérifie que les champs sont remplis
function verif(){
	//Rendre le champ "Nom" obligatoire
	if(document.getElementById('des').value==""){
		alert("Veuillez remplir le champ \"Nom\"");
		return false;
	}

	//Rendre le champ "Description" obligatoire
	if(document.getElementById('desc').value==""){
		alert("Veuillez remplir le champ \"Description\"");
		return false;
	}

	//Rendre le champ "Date de fabrication" obligatoire
	if(document.getElementById('fabri').value==""){
		alert("Veuillez remplir le champ \"Date de fabrication\"");
		return false;
	}

	//Rendre le champ "Photo" obligatoire
	if(document.getElementById('photo').value==""){
		alert("Veuillez joindre une image .jpg ou .jpeg dans le champ \"Photo\"");
		return false;
	}

	//Rendre le champ "Catégorie" obligatoire
	if(document.getElementById('cat').value==0){
		alert("Veuillez remplir le champ \"Catégorie\"");
		return false;
	}

}
</script>



<h3><center><font color=C0392B><u>AJOUTEZ UN PRODUIT</u></font></center></h3>
<form action="Ctrl.class.php?action=addprod" method="post" enctype="multipart/form-data" onsubmit="return verif()">

<table cellspacing="10">
	<tr>
		<td>Nom</td>
		<td><input type="text" name="des" id="des"></td>
	</tr>
	<tr>
		<td>Description</td>
		<td><textarea rows="6" cols="50" name="desc" id="desc"></textarea></td>
	</tr>
	<tr>
		<td>Prix</td>
		<td><input type="number" name="prix" min="0"></td>
	</tr>
	<tr>
		<td>Type</td>
		<td>Au poids<input type="radio" name="type" value="p" checked="yes"> A l'unit&eacute<input type="radio" name="type" value="u"></td>
	</tr>
	<tr>
		<td>Date de fabrication</td>
		<td><input type="date" name="fabri" id="fabri" min="1980-01-01" max="2024-12-31"></td>
	</tr>
	<tr>
		<td>Photo</td>
		<td><input type="file" name="photo" id="photo"></td>
	</tr>
	<tr>
		<td>Cat&eacutegorie</td>
		<td>
			<select name="cat" id="cat">
				<option value="0">-</option>
				<?php
					//Dans la liste des catégories, afficher la désignation
					foreach ($categories as $cat)
						echo "<option value=$cat[0]>$cat[1]</option>";
				?>
			</select>
		</td>
	</tr>
</table>
<br><br>
<center><input type="submit" value="Envoyer"> <input type="reset" value="Recommencer"></center>

</form>
