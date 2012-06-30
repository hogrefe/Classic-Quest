<?php
	if(!isset($_SESSION['username'])){
		header('Location:admin');
	}

	include('pages/functions.php');
	if(isset($_POST['submit'])){
		$neeleb = "";
		$mortleb ="";
		if(!empty($_POST['neele']))
			$neeleb =  Reversedecoupedatetime(htmlspecialchars(trim(addslashes($_POST['neele']))));
		if(!empty($_POST['mortle']))
			$mortleb =  Reversedecoupedatetime(htmlspecialchars(trim(addslashes($_POST['mortle']))));
		include('bdd.php');
		$nom = htmlspecialchars(trim(addslashes($_POST['nom'])));
		$realnom = htmlspecialchars(trim(addslashes($_POST['realnom'])));
		$neea = htmlspecialchars(trim(addslashes($_POST['neea'])));
		$morta = htmlspecialchars(trim(addslashes($_POST['morta'])));
		$biography = addslashes($_POST['biography']);
		if(isset($_SESSION['username'])){ // inutile c de la securite
			$username = $_SESSION['username'];
		}else $username = "HariS Seldon";
		if($realnom && $nom){
			$sql = "INSERT INTO artist Values('','$nom','$realnom','$neeleb','$neea','$mortleb','$morta','$biography','$username')";
			mysql_query($sql) or die('<span style="color:red;">L\'artiste est déjà dans la base de donnée!</span>');
			$id=mysql_insert_id(); // recupere l'id apres insert
			// Upload des images.
			if(!empty($_FILES)){
				$img = $_FILES['img'];
				$ext = strtolower(substr($img['name'],-3));
				$allow_ext = array("jpg", "png", "gif", "JPG", "PNG" , "GIF");
				if(in_array($ext,$allow_ext)){
					if(file_exists("sources/images/".$id.".jpg")){
						unlink("sources/images/".$id.".jpg");
					}
					if(file_exists("sources/images/".$id.".gif")){
						unlink("sources/images/".$id.".gif");
					}
					if(file_exists("sources/images/".$id.".png")){
						unlink("sources/images/".$id.".png");
					}
					move_uploaded_file($img['tmp_name'],"sources/images/".$id.".".$ext);
					if(file_exists("sources/images/min/".$id.".".$ext)){
						unlink("sources/images/min/".$id.".".$ext);
					}
					Img::creerMin("sources/images/".$id.".".$ext,"sources/images/min/",$id.".".$ext,200,200);
				}
			}
			header('Location:index.php');
		} else echo "<b><span style='color:red;'>Vous devez au moins renseigner le pseudonime et le nom réel de l'artist</span></b>";
	}
	echo 	"<div id='mod'>
			<center><h2>Ajouter un artiste.</h2></center>
			<form method='POST' action='' enctype='multipart/form-data'>
				<center>Uploader une image (jpg,png,gif et inférieur a 1Mo) : <input type='file' name='img' /></center>
				<table border='0' width='100%'>
				<tr><td><label for='nom'>Nom d'artiste : </label><input type='text' name='nom' value='' /></td>
				<td><label for='realnom'>Nom complet de l'artiste : </label><input type='text' name='realnom' value='' /></td></tr>
				<tr><td><label for='neele'>Née le : </label><input type='text' name='neele' value='' /></td>
				<td><label for='neea'> à : </label><input type='text' name='neea' value='' /></td></tr>
				<tr><td><label for='mortle'>Décédé(e) le : </label><input type='text' name='mortle' value='' /></td>
				<td><label for='morta'> à : </label><input type='text' name='morta' value='' /></td></tr>
			</table>
			<h3>Biographie :</h3><br />
			<textarea name='biography'></textarea><br /><center>
			<input type='submit' name='submit' value='Ajouter'>
			<input type='submit' name='annuller' value='Annuller'></center>
			</form></div>";
?>