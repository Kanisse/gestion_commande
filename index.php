<!DOCTYPE html>
<html>
<head>
	<title>La page Connexion</title>
	</head>

<body style="backgroud-color:red;">

<div>
<h1>Gestion Commerciale :</h1>


<form action="index.php" method="post">
	<input type="submit" name="OK" value="Ajouter un Produit">
</form>	
<center>

	<?php
	$connexion=mysqli_connect("localhost","root","","gestionc");

	$sql="SELECT * FROM produits";
	$resultat=$connexion->query($sql);
	echo "<table border ='1'><tr><th>ID</th><th>Nom</th><th>Prix</th><th>Catégorie</th><th></th></tr>";
	while($ligne=$resultat->fetch_assoc()){
		echo "<tr>".
		"<td>".$ligne['Id_Produit'] ."</td>". 
		"<td>".$ligne['Nom_Produit'] ."</td>". 
		"<td>".$ligne['Prix_Produit']. "</td>". 
		"<td>".$ligne['Cat_Produit']."</td> ".
		"<td>  <a href='index.php?id=".$ligne['Id_Produit']."'>Supprimer</a>   </td>".
			"</tr>"; 
	}
	echo "</table>";

	?>

</center>
	</div>
</body>
</html>

<?php

if(isset($_GET['id'])){

$id = $_GET['id'];
$sql="DELETE FROM produits WHERE Id_Produit=$id";
$resultat=$connexion->query($sql);

if($resultat)
{
	header('location: index.php');

}
else {
	echo "ERROR";
}



}


if(isset($_POST['OK'])){
?>
<form action="index.php" method="post">
	Nom : <input type="text" name="Nom"><br>
	Prix : <input type="number" name="Prix"><br>
	Catégorie : <input type="text" name="Cat"><br>
	<input type="submit" name="Ajouter" value="Ajouter">
</form>

<?php
 
}
 if(isset($_POST['Ajouter'])){

 	$sql="INSERT INTO produits (Nom_Produit,Prix_Produit,Cat_Produit) 
 	VALUES ('".$_POST['Nom']."','".$_POST['Prix']."','".$_POST['Cat']."')";

	$resultat=$connexion->query($sql);
	if($resultat)
	{
		header('location: index.php');
	}else {echo "ERROR";}

 }  





?>

