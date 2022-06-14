<script>

//Fonction qui permet de remplir la liste des villes lorsqu'on sélectionne un pays
function remplir_villes(){
	xhr=new XMLHttpRequest();
	xhr.onreadystatechange=function(){
		if(xhr.status==200 && xhr.readyState==4)
			document.getElementById('vi').innerHTML=xhr.responseText;
	}
	sel = document.getElementById('pays');
	numeroPays = sel.options[sel.selectedIndex].value;
	xhr.open("GET","Ex_Ajax_getVille.php?numPays="+numeroPays,true);
	xhr.send();
}

</script>

<!--Listes de pays et de villes-->
<form>
<table cellspacing="10">
	<tr>
		<td>Pays</td>
		<td>
			<select name="pays" id="pays" onchange="remplir_villes()">
				<option value="0">-</option>
				<?php 
					require 'Connexion.php';
					$query="select * from pays where 1";
					$result=mysqli_query($connect,$query);
					while($pays=mysqli_fetch_array($result))
						echo "<option value=$pays[0]>$pays[1]</option>";
				?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Ville</td>
		<td>
			<div id="vi">
			<select name="ville">
				<option value=0>-</option>
			</select>
			</div>
		</td>
	</tr>
</table>
</form>


