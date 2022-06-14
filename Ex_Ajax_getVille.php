<?php
require 'Connexion.php';
echo "<select name='ville'>";
echo "<option value=0>-</option>";
if(isset($_GET['numPays'])){
	$numPays=$_GET['numPays'];
	$query="select * from villes where numPays=$numPays";
	$result=mysqli_query($connect,$query);
	while($ville=mysqli_fetch_array($result))
		echo "<option value=$ville[0]>$ville[1]</option>";
    }
echo "</select>"; 
?>