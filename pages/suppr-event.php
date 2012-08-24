<?php
	if(!isset($_SESSION['username'])){
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="admin"
			</SCRIPT>';
	}
	include('bdd.php');
	if(isset($_POST['suppr'])){
		// kill des images.
		if(file_exists("sources/images/e".$id.".jpg")){
			unlink("sources/images/e".$id.".jpg");
		}
		elseif(file_exists("sources/images/e".$id.".gif")){
			unlink("sources/images/e".$id.".gif");
		}
		elseif(file_exists("sources/images/e".$id.".png")){
			unlink("sources/images/e".$id.".png");
		}
		if(file_exists("sources/images/min/e".$id.".jpg")){
			unlink("sources/images/min/e".$id.".jpg");
		}
		$sql = "DELETE FROM `evenement` WHERE `id` = $id";
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="index.php"
			</SCRIPT>';
	}
?>
<form method="POST" action="">
	<br /><label for="suppr">Confirmer la suppression de <span style="color:red;"><b><?php   $event =  recuperation($id,'evenement'); echo $event[1]; ?></b></span> : </label>
	<input type="submit" name="suppr" value="Supprimer" />
</form>