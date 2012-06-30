<?php
	if(!isset($_SESSION['username'])){
		header('Location:admin');
	}
	include('bdd.php');
	if(isset($_POST['suppr'])){
		$sql = "DELETE FROM `enregistrement` WHERE `idartist` = $id";
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		$sql = "DELETE FROM `artist` WHERE `id` = $id";
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		header('Location:index.php');
	}
?>
<form method="POST" action="">
	<br /><label for="suppr">Confirmer la suppression de <span style="color:red;"><b><?php  include('pages/functions.php'); $artist = recup_artist($id); echo $artist[1]; ?></b></span> : </label>
	<input type="submit" name="suppr" value="Supprimer" />
</form>