<?php
	if(!isset($_SESSION['username'])){
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="admin"
			</SCRIPT>';
	}

	
	if(isset($_POST['submit'])){
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
		if(!empty($_POST['neele']))
			$neeleb =  Reversedecoupedatetime(htmlspecialchars(trim(addslashes($_POST['neele']))));
		if(!empty($_POST['mortle']))
			$mortleb =  Reversedecoupedatetime(htmlspecialchars(trim(addslashes($_POST['mortle']))));
		include('bdd.php');
		$nom = htmlspecialchars(trim(addslashes($_POST['nom'])));
		$realnom = htmlspecialchars(trim(addslashes($_POST['realnom'])));
		$neea = htmlspecialchars(trim(addslashes($_POST['neea'])));
		$morta = htmlspecialchars(trim(addslashes($_POST['morta'])));
		$typeartist = htmlspecialchars(trim(addslashes($_POST['typeartist'])));
		$biography = addslashes($_POST['biography']);
		if(isset($_SESSION['username'])){ // inutile c de la securite
			$username = $_SESSION['username'];
		}else $username = "HariS Seldon";
		if($realnom && $nom){
			$sql = 'UPDATE artist SET nomartist="'.$nom.'", nom="'.$realnom.'",neele = "'.$neeleb.'", neea="'.$neea.'", mortle="'.$mortleb.'", morta="'.$morta.'", biography="'.$biography.'", auteur="'.$username.'", creerle="'.date("Y-m-d H:i:s").'", typeartist= "'.$typeartist.'" WHERE id="'.$id.'"';
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
			//redirection
			echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="artist'.$id.'"
			</SCRIPT>';
		} else echo "<b><span style='color:red;'>Vous devez au moins renseigner le pseudonime et le nom réel de l'artist</span></b>";
	}

	$artist = recup_artist($id);
	$neele = Decoupedatetime($artist[3]);
	$mortle =  Decoupedatetime($artist[5]);
	echo 	"<div id='mod'>
			<center><h2>Modifier l'histoire de l'artiste.</h2></center>
			<form method='POST' action='' enctype='multipart/form-data'>
				<center>Uploader une image (jpg,png,gif et inférieur a 1Mo) : <input type='file' name='img' /></center>
				<table border='0' width='100%'>
					<tr><td><label for='nom'>Nom d'artiste : </label><input type='text' name='nom' value='".$artist[1]."' /></td>
					<td><label for='realnom'>Nom complet de l'artiste : </label><input type='text' name='realnom' value='".$artist[2]."' /></td></tr>
					<tr><td><label for='neele'>Née le : </label><input type='text' name='neele' value='".$neele."' /></td>
					<td><label for='neea'> à : </label><input type='text' name='neea' value='".$artist[4]."' /></td></tr>
					<tr><td><label for='mortle'>Décédé(e) le : </label><input type='text' name='mortle' value='".$mortle."' /></td>
					<td><label for='morta'> à : </label><input type='text' name='morta' value='".$artist[6]."' /></td></tr>
					<tr><td><label for='typeartist'>L'artiste est un : </label>
					<select name='typeartist'>";
					// compositeur
					echo "<option value='Compositeur' ";
						if($artist[10] == "Compositeur"){
							echo " selected='selected'";
						}
						echo ">Compositeur</option><hr />";
						// interprete
						echo "<option value='Flûtiste' ";
						if($artist[10] == "Flûtiste"){
							echo " selected='selected'";
						}
						echo ">Flûtiste</option>
						<option value='Violoniste' ";
						if($artist[10] == "Violoniste"){
							echo " selected='selected'";
						}
						echo ">Violoniste</option>
					</select></td></tr>
				</table>
				<h3>Biographie :</h3><br />
				<textarea id='biography' name='biography'>".$artist[7]."</textarea><br /><center>
				<input type='submit' name='submit' value='Modifier'>
				<input type='submit' name='annuller' value='Annuller'></center>
			</form></div>";
?>