<script lannguage="javascript">

//Fonction qui change le type "password" en type "text" si la case "Afficher" est cochée
function afficher(){
	if(document.getElementById('aff').checked==true)
		document.getElementById('mdp').type="text";
	else
		document.getElementById('mdp').type="password";
}

</script>

<h3><center><font color=C0392B><u>PAGE D'AUTHENTIFICATION</u></font></center></h3>
<form action="Ctrl.class.php?action=verifauth" method="post">

<table cellspacing="10">
	<tr>
		<td>Login</td>
		<td><input type="text" name="log"></td>
	</tr>
	<tr>
		<td>Mot de passe</td>
		<td><input type="password" name="mdp" id="mdp"></td>
		<td></td>
		<td>Afficher</td>
		<td><input type="checkbox" id="aff" onclick="afficher()"></td>
	</tr>
</table>
<br><br>
<center><input type="submit" value="Se connecter"></center>

</form>