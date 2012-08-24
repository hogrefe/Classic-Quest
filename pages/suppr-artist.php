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
		if(file_exists("sources/images/".$id.".jpg")){
			unlink("sources/images/".$id.".jpg");
		}
		elseif(file_exists("sources/images/".$id.".gif")){
			unlink("sources/images/".$id.".gif");
		}
		elseif(file_exists("sources/images/".$id.".png")){
			unlink("sources/images/".$id.".png");
		}
		if(file_exists("sources/images/min/".$id.".jpg")){
			unlink("sources/images/min/".$id.".jpg");
		}
		$sql = "DELETE FROM `enregistrement` WHERE `idartist` = $id";
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		$sql = "DELETE FROM `artist` WHERE `id` = $id";
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="index.php"
			</SCRIPT>';
	}
?>
<form method="POST" action="">
	<br /><label for="suppr">Confirmer la suppression de <span style="color:red;"><b><?php   $artist = recuperation($id,'artist'); echo $artist[1]; ?></b></span> : </label>
	<input type="submit" name="suppr" value="Supprimer" />
</form>