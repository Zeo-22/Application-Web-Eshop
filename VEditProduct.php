<h3><center><font color=C0392B><u>MODIFIER LE PRODUIT</u></font></center></h3>
<form action="Ctrl.class.php?action=updateprod" method="post">

<table cellspacing="10">
	<input type="hidden" name="num" value="<?php echo "$prod[0]"; ?>">
	<tr>
		<td>Nom</td>
		<td><input type="text" name="des" value="<?php echo "$prod[1]"; ?>"></td>
	</tr>
	<tr>
		<td>Description</td>
		<td><textarea rows="6" cols="50" name="desc"><?php echo "$prod[2]"; ?></textarea></td>
	</tr>
	<tr>
		<td>Prix</td>
		<td><input type="number" name="prix" min="0" value="<?php echo "$prod[3]"; ?>"></td>
	</tr>
	<tr>
		<td>Type</td>
		<td>
			<?php
			if($prod[5]=='p')
				echo "Au poids<input type=radio name=type value=p checked=yes> A l'unit&eacute<input type=radio name=type value=u>";
			else
				echo "Au poids<input type=radio name=type value=p> A l'unit&eacute<input type=radio name=type value=u checked=yes>";
			?>
	</tr>
	<tr>
		<td>Date de fabrication</td>
		<td><input type="date" name="fabri" min="1980-01-01" max="2024-12-31" value="<?php echo "$prod[4]"; ?>"></td>
	</tr>
	<tr>
		<td>Photo</td>
		<td><input type="file" name="fichier"></td>
	</tr>
	<tr>
		<td>Cat&eacutegorie</td>
		<td>
			<select name="cat">
				<option value="0">-</option>
				<?php
					foreach($categories as $cat){
						echo "<option value=$cat[0]";
						if($cat[0]==$prod[7]) 
							echo " selected=1";
						echo ">$cat[1]</option>";
					}
				?>
			</select>
		</td>
	</tr>
</table>
<br><br>
<center><input type="submit" value="Envoyer"> <input type="reset" value="Recommencer"></center>

</form>
