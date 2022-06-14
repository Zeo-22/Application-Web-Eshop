<?php 
require 'mesfonctions.php';
?>

<h3><center><font color=C0392B><u>RECHERCHEZ UN PRODUIT</u></font></center></h3>
<br><br><center>
<form action="All_Products.php" method="post">

<table cellspacing="10">
	<tr>
		<td><b>Rechercher par nom ou par description</b></td>
		<td><input type="text" name="critere" onkeyup="proposer(this.value)"></td>
		<td><input type="submit" value="Rechercher"></td>
	</tr>
</table>
<br>
<div id="pr"></div>
</center>
<br>
<a href="All_Products.php">Tous les produits</a>
</form>