<?php
	if(!isset($_SESSION['username'])){
		header('Location:admin');
	}
	include('bdd.php');
	if(isset($_POST['suppr'])){
		$sql = "DELETE FROM `enregistrement` WHERE `id` = $id";
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		header('Location:index.php');
	}
?>
<form method="POST" action="">
	<br /><label for="suppr">Confirmer la suppression de <span style="color:red;"><b><?php  include('pages/functions.php'); $enreg =  recup_enreg($id); echo $enreg[7]; ?></b></span> : </label>
	<input type="submit" name="suppr" value="Supprimer" />
</form>