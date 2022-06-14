<?php
require 'Connexion.php';
if(isset($_GET['p'])){
	$p=$_GET['p'];
	$query="select designation from produits where designation like '%$p%' limit 5";
	$result=mysqli_query($connect,$query);
	while($prop=mysqli_fetch_array($result)){
		echo "$prop[0]<br>";
	}
}
mysqli_close($connect);
?>