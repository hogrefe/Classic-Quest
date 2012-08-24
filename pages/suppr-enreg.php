<?php
	if(!isset($_SESSION['username'])){
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="admin"
			</SCRIPT>';
	}
	include('bdd.php');
	if(isset($_POST['suppr'])){
		$sql = "DELETE FROM `enregistrement` WHERE `id` = $id";
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="index.php"
			</SCRIPT>';
	}
?>
<form method="POST" action="">
	<br /><label for="suppr">Confirmer la suppression de <span style="color:red;"><b><?php   $enreg =  recuperation($id,'enregistrement'); echo $enreg[7]; ?></b></span> : </label>
	<input type="submit" name="suppr" value="Supprimer" />
</form>