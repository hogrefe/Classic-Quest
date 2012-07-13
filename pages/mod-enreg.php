<?php
	if(!isset($_SESSION['username'])){
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="admin"
			</SCRIPT>';
	}
	
	if(isset($_POST['submit'])){
		if(!empty($_POST['interpretele']))
			$dateb =  Reversedecoupedatetime(htmlspecialchars(trim(addslashes($_POST['interpretele']))));
		include('bdd.php');
		$titre = htmlspecialchars(trim(addslashes($_POST['titre'])));
		$nom = htmlspecialchars(trim(addslashes($_POST['nom'])));
		$interpretepar = htmlspecialchars(trim(addslashes($_POST['interpretepar'])));
		$opus = htmlspecialchars(trim(addslashes($_POST['opus'])));
		$duree = htmlspecialchars(trim(addslashes($_POST['duree'])));
		$type = htmlspecialchars(trim(addslashes($_POST['type'])));
		$instruments = htmlspecialchars(trim(addslashes($_POST['instruments'])));
		$biography = addslashes($_POST['biography']);
		if(isset($_SESSION['username'])){ // inutile c de la securite
			$username = $_SESSION['username'];
		}else $username = "HariS Seldon";
		if($titre && $nom){
			$sql = 'UPDATE enregistrement SET idartist="'.$nom.'", interpretes="'.$interpretepar.'", duree="'.$duree.'",annee = "'.$dateb.'", type="'.$type.'", instruments="'.$instruments.'", titre="'.$titre.'",opus="'.$opus.'", histoire="'.$biography.'", auteur="'.$username.'", creerle="'.date("Y-m-d H:i:s").'" WHERE id="'.$id.'"';
			mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
			//redirection
			echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="enreg'.$id.'"
			</SCRIPT>';
		} else echo "<b><span style='color:red;'>Vous devez au moins renseigner le titre et le nom de l'artist</span></b>";
	}
	$enreg = recup_enreg($id);
	$date = Decoupedatetime($enreg[4]);
	$artist = recup_artist($enreg[1]);
	echo 	"<div id='mod'>
			<center><h2>Modifier l'histoire de l'enregistrement.</h2></center>
			<table border='0' width='100%'>
			<form method='POST' action=''>
				<tr><td><label for='titre'>Titre : </label><input type='text' name='titre' value='".$enreg[7]."' /></td>
				<td><label for='nom'>Nom de l'artiste : </label><select name='nom'>";
					// liste deroulante nom artist de la bdd
				include('bdd.php');
				$query = "SELECT * FROM artist ORDER BY nomartist";
				$result = mysql_query($query);
				// Recuperation des resultats
				while($row = mysql_fetch_row($result)){
					echo "<option ";
					if ($row[0] == $enreg[1]){
						echo " selected='selected'";
					}
					echo " value='".$row[0]."'>".$row[1]."</option>";
				}
	echo		"</select></td></tr>
				<tr><td><label for='interpretele'>Interprété la première foi le : </label><input type='text' name='interpretele' value='".$date."' /></td>
				<td><label for='interpretepar'>Interprété par : </label><input type='text' name='interpretepar' value='".$enreg[2]."' /></td></tr>
				<tr><td><label for='opus'>Opus numéro : </label><input type='text' name='opus' value='".$enreg[8]."' /></td>
				<td><label for='duree'>Duree : </label><input type='text' name='duree' value='".$enreg[3]."' /></td>
				<tr><td><label for='type'>Type : </label><input type='text' name='type' value='".$enreg[5]."' /></td>
				<td><label for='instruments'>Instruments : </label><input type='text' name='instruments' value='".$enreg[6]."' /></td></tr>
			</table>
			<h3>Histoire :</h3><br />
			<textarea id='biography' name='biography'>".$enreg[9]."</textarea><br /><center>
			<input type='submit' name='submit' value='Modifier'>
			<input type='submit' name='annuller' value='Annuller'></center>
			</form></div>";
?>