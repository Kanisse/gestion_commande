<!DOCTYPE html>
<html>
<head>
	<title>La page de produits</title>
	</head>

<body>


<h1>Liste des produits :</h1>


<form action="produit.php" method="post">
 	ID: <input type="number" name="IdPdt">
	<input type="submit" name="search1" value="chercher">	
	<br><br>ou<br><br>
	Name: <input type="text" name="NamePdt">
	<input type="submit" name="search2" value="chercher">	
</form>

<?php
include 'connexion.php';
if (isset($_POST['search1'])){
	?>
	<center>
	<?php

	$id=$_POST['IdPdt'];

	if (empty($id)){
		echo "<h1>Veuillez inserer une valeur</h1>";

	}
	else{
		$sql="SELECT * FROM produits INNER JOIN categories ON produits.IdCategorie = categories.IdCategorie WHERE IdProduit=$id";

	$resultat=$connexion->query($sql);
	
	echo "<table border ='1'><tr><th>ID</th><th>Nom</th><th>Prix</th><th>Quantité Stock</th><th>Catégorie</th></tr>";
	while($ligne=$resultat->fetch_assoc()){
		echo "<tr>".
		"<td>".$ligne['IdProduit'] ."</td>". 
		"<td>".$ligne['NomProduit'] ."</td>". 
		"<td>".$ligne['Prix']."</td>". 
		"<td>".$ligne['QteStock']. "</td>". 
		"<td>".$ligne['NomCategorie']."</td> ".
		"<td><a href=\"produit.php?id=".$ligne['IdProduit']."\">Modifier</a></td>".
			"</tr>"; 
	}
	echo "</table>";
	}
	?>
	
	<form action="produit.php" method="POST">
	<br><input type="submit" name="back" value="retour">	
	</form>
	<center>
	<?php
	
}
else if(isset($_POST['search2'])){
	?>
	<center>
	<?php
	$name=$_POST['NamePdt'];
	if (empty($name)){
		echo "<h1>Veuillez inserer une valeur</h1>";

	}
	else{
		$sql="SELECT * FROM produits INNER JOIN categories ON produits.IdCategorie = categories.IdCategorie WHERE NomProduit LIKE '%".$name."%'";

	$resultat=$connexion->query($sql);
	
	echo "<table border ='1'><tr><th>ID</th><th>Nom</th><th>Prix</th><th>Quantité Stock</th><th>Catégorie</th></tr>";
	while($ligne=$resultat->fetch_assoc()){
		echo "<tr>".
		"<td>".$ligne['IdProduit'] ."</td>". 
		"<td>".$ligne['NomProduit'] ."</td>". 
		"<td>".$ligne['Prix']."</td>". 
		"<td>".$ligne['QteStock']. "</td>". 
		"<td>".$ligne['NomCategorie']."</td> ".
		"<td><a href=\"produit.php?id=".$ligne['IdProduit']."\">Modifier</a></td>".
			"</tr>"; 
	}
	echo "</table>";
	}
	?>
	
	<form action="produit.php" method="POST">
	<br><input type="submit" name="back" value="retour">	
	</form>
	</center>
	<?php
	if(isset($_POST['back'])){
		$sql="SELECT * FROM produits INNER JOIN categories ON produits.IdCategorie = categories.IdCategorie";
		$resultat=$connexion->query($sql);
		echo "<table border ='1'><tr><th>ID</th><th>Nom</th><th>Prix</th><th>Quantité Stock</th><th>Catégorie</th></tr>";
		while($ligne=$resultat->fetch_assoc()){
			echo "<tr>".
			"<td>".$ligne['IdProduit'] ."</td>". 
			"<td>".$ligne['NomProduit'] ."</td>". 
			"<td>".$ligne['Prix']."</td>". 
			"<td>".$ligne['QteStock']. "</td>". 
			"<td>".$ligne['NomCategorie']."</td> ".
			"<td><a href=\"produit.php?id=".$ligne['IdProduit']."\">Modifier</a></td>".
			"</tr>"; 
		}
		echo "</table>";
	}
}

else{
	
	?>
	<center>
	<?php
	

	$sql="SELECT * FROM produits INNER JOIN categories ON produits.IdCategorie = categories.IdCategorie";
	$resultat=$connexion->query($sql);
	echo "<table border ='1'><tr><th>ID</th><th>Nom</th><th>Prix</th><th>Quantité Stock</th><th>Catégorie</th></tr>";
	while($ligne=$resultat->fetch_assoc()){
		echo "<tr>".
		"<td>".$ligne['IdProduit']."</td>". 
		"<td>".$ligne['NomProduit']."</td>". 
		"<td>".$ligne['Prix']."</td>". 
		"<td>".$ligne['QteStock']."</td>". 
		"<td>".$ligne['NomCategorie']."</td> ".
		"<td><a href=\"produit.php?id=".$ligne['IdProduit']."\">Modifier</a></td>".
		"</tr>";
	}
	echo "</table>";
	?>
</center>
	
</body>
</html>

<form action="produit.php" method="post">
	<input type="submit" name="OK" value="Ajouter un Produit">
</form>
<br/>
<?php
if(isset($_POST['OK']) or isset($_GET['id'])){
	if(isset($_GET['id'])){
		$id=$_GET['id'];
		$sql="SELECT * FROM Produits WHERE IdProduit=$id";
		$resultat=$connexion->query($sql);
		$ligne=$resultat->fetch_assoc();
		echo "<form action='produit.php' method='post'>
		<input type='text' name='id' value='".$ligne['IdProduit']."' hidden='hidden'> 
		<table>
		<tr><td>Nom Produit : </td><td><input type='text' name='Nom_modification' value='".$ligne['NomProduit']."' required='required'></td></tr>
		<tr><td>Prix : </td><td><input type='float' name='Prix_modification' value='".$ligne['Prix']."' required='required'></td></tr>
		<tr><td>Quantité Stock : </td><td><input type='number' name='QteStock_modification' value='".$ligne['QteStock']."' required='required'></td></tr>
		<tr><td>Catégorie : </td><td><select name='Cat_modification'>";
		$sql="SELECT * FROM Categories";
		$resultat=$connexion->query($sql);
			while($select=$resultat->fetch_assoc()){
				if($select['IdCategorie']==$ligne['IdCategorie']){
					echo "<option value='".$select['IdCategorie']."' selected='selected'>".$select['NomCategorie']." </option>";
				}
				else{
					echo "<option value='".$select['IdCategorie']."'>".$select['NomCategorie']."</option>";
				}	
			}
			echo "</select></td></tr>
			</table>
			<br/><input type='submit' name='Modifier' value='Modifier'>
			<input type='submit' name='Annuler' value='Annuler'>
			</form>";
	}
	else{
?>
	<form action="produit.php" method="post">
	<table>
		<tr><td>Nom Produit : </td><td><input type="text" name="Nom"></td></tr>
		<tr><td>Prix : </td><td><input type="float" name="Prix"></td></tr>
		<tr><td>Quantité Stock : </td><td><input type="number" name="QteStock"></td></tr>
		<tr><td>Catégorie : </td><td><select name='Cat'>
			<?php
			$sql="SELECT * FROM Categories";
			$resultat=$connexion->query($sql);
			while($ligne=$resultat->fetch_assoc()){
				echo "<option value='".$ligne['IdCategorie']."'>".$ligne['NomCategorie']."</option>";
			}
			?>
			</select></td></tr>
	</table>
	<br/><input type="submit" name="Ajouter" value="Ajouter">
</form>

<?php
	}
}

if(isset($_POST['Ajouter']) and $_POST['Nom'] != "" and $_POST['Prix']>0 and $_POST['Cat']>0){

 	$sql="INSERT INTO produits (NomProduit,Prix,QteStock,IdCategorie) 
 	VALUES ('".$_POST['Nom']."','".$_POST['Prix']."','".$_POST['QteStock']."','".$_POST['Cat']."')";

	$resultat=$connexion->query($sql);
	if($resultat)
	{
		header('location: produit.php');
	}
	else 
	{
		echo "ERROR";
	}
}
elseif (isset($_POST['Ajouter'])){
	echo "remplir les champs necessaires";
}

if(isset($_POST['Modifier'])){
	$sql="UPDATE Produits SET NomProduit='".$_POST['Nom_modification']."', Prix=".$_POST['Prix_modification'].", QteStock=".$_POST['QteStock_modification'].", IdCategorie=".$_POST['Cat_modification']." WHERE IdProduit=".$_POST['id'];
	$resultat=$connexion->query($sql);
	header('location:produit.php');
}
elseif(isset($_POST['Annuler'])){
	header('location:produit.php');
}

}

 ?>
