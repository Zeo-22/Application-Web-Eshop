<?php

//Fonction qui permet d'avoir la traçabilité
function trace($action){
	$qui=$_SESSION['user'];
	$quand=date('Y/m/D H:i:s');
	$lieu=$_SERVER['REMOTE_ADDR'];
	$ch=$qui.'|'.$action.'|'.$quand.'|'.$lieu;
	$f=fopen("..\\..\\..\\trace\\trace.log","a+");
	fputs($f,$ch);
	fputs($f,"\r\n");
	fclose($f);
}

?>

<script>

//Fonction qui permet de proposer des résultats quand l'utilisateur fait une recherche (AJAX : Asynchronous Java And XML)
function proposer(P){
	xhr=new XMLHttpRequest();
	xhr.onreadystatechange=function(){
		if(xhr.status==200 && xhr.readyState==4)
			document.getElementById('pr').innerHTML=xhr.responseText;
	}
	xhr.open("GET","getProposition.php?p="+P,true);
	xhr.send();
}

</script>
