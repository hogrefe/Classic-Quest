<?php
	if(!isset($_SESSION['username'])){
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="admin"
			</SCRIPT>';
	}	
	if(isset($_POST['submit'])){
		$date = "";
		if(!empty($_POST['date']))
			$date =  htmlspecialchars(trim(addslashes($_POST['date'])));
		include('bdd.php');
		$nom = htmlspecialchars(trim(addslashes($_POST['nom'])));
		$lieu = htmlspecialchars(trim(addslashes($_POST['lieu'])));
		$biography = addslashes($_POST['biography']);
		if(isset($_SESSION['username'])){ // inutile c de la securite
			$username = $_SESSION['username'];
		}else $username = "HariS Seldon";
		if($date && $nom && $lieu){
			$sql = "INSERT INTO evenement Values('','$nom','$date','$lieu','$biography','$username')";
			mysql_query($sql) or die('<span style="color:red;">L\'artiste est déjà dans la base de donnée!</span>');
			$id=mysql_insert_id(); // recupere l'id apres insert
			// Upload des images.
			if(!empty($_FILES)){
				$img = $_FILES['img'];
				$ext = strtolower(substr($img['name'],-3));
				$allow_ext = array("jpg", "png", "gif", "JPG", "PNG" , "GIF");
				if(in_array($ext,$allow_ext)){
					if(file_exists("sources/images/e".$id.".jpg")){
						unlink("sources/images/e".$id.".jpg");
					}
					if(file_exists("sources/images/e".$id.".gif")){
						unlink("sources/images/e".$id.".gif");
					}
					if(file_exists("sources/images/e".$id.".png")){
						unlink("sources/images/e".$id.".png");
					}
					move_uploaded_file($img['tmp_name'],"sources/images/e".$id.".".$ext);
					if(file_exists("sources/images/min/e".$id.".".$ext)){
						unlink("sources/images/min/e".$id.".".$ext);
					}
					Img::creerMin("sources/images/e".$id.".".$ext,"sources/images/min/","e".$id.".".$ext,200,200);
				}
			}
			//redirection
			echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="galery-event"
				</SCRIPT>';
		} else echo "<b><span style='color:red;'>Vous devez au moins renseigner le nom, la date e tle lieu de l'évènement!</span></b>";
	}
	echo 	"<div id='mod'>
			<center><h2>Ajouter un évènement.</h2></center>
			<form method='POST' action='' enctype='multipart/form-data'>
				<center>Uploader une image (jpg,png,gif et inférieur a 1Mo) : <input type='file' name='img' /></center>
				<table border='0' width='100%'>
				<tr><td><label for='nom'>Nom : </label><input type='text' name='nom' value='' /></td>
				<td><br /><label for='date'>Date : </label><input type='hidden' name='date' id='date' value='' /><br /><div id='dateevent' class='box'></div></td></tr>
				<tr><td><label for='lieu'>Lieu : </label><input type='text' id='lieu' name='lieu' value='' /></td>
				<td><div id='mapsv'>Rechercher ce lieu</div></td></tr>
			</table>";
	// carte google map
	echo 	"<br /><div id= 'mapdescri'><strong>Attention cette carte est a titre indicatif, en aucun cas le lieu designer par celle si
			ne sera vérifier. Seul l'adresse écrit devra être exacte.</strong></div><br /><div id ='maps' style='text-align: center;'>
			<iframe frameborder='0' height='500' marginheight='0' marginwidth='0' scrolling='no' src='http://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=&amp;output=embed' width='500'></iframe><br /></div>
			</div>";
	echo		"<h3>Détail, programme :</h3><br />
			<textarea name='biography'></textarea><br /><center>
			<input type='submit' name='submit' value='Ajouter'>
			<input type='submit' name='annuller' value='Annuller'></center>
			</form></div>";
?>