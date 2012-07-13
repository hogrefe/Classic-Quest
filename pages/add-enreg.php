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
		$sql = "INSERT INTO enregistrement Values('','$nom','$interpretepar','$duree','$dateb','$type','$instruments','$titre','$opus','$biography','$username','".date("Y-m-d H:i:s")."')";
		mysql_query($sql) or die('<span style="color:red;">L\'enregistrement et déjà dans la base de donnée!</span>');
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="enreg'.$id.'"
			</SCRIPT>';
		} else echo "<b><span style='color:red;'>Vous devez au moins renseigner le titre et le nom de l'artist</span></b>";
	}
	echo 	"<div id='mod'>
			<center><h2>Modifier l'histoire de l'enregistrement.</h2></center>
			<table border='0' width='100%'>
			<form method='POST' action=''>
				<tr><td><label for='titre'>Titre : </label><input type='text' name='titre' value='' /></td>
				<td><label for='nom'>Nom de l'artiste : </label><select name='nom'>";
					// liste deroulante nom artist de la bdd
				include('bdd.php');
				$queryb = "SELECT * FROM artist ORDER BY nomartist";
				$resultb = mysql_query($queryb);
				// Recuperation des resultats
				while($rowb = mysql_fetch_row($resultb)){
					echo "<option value='".$rowb[0]."'>".$rowb[1]."</option>";
				}
	echo		"</select></td></tr>
				<tr><td><label for='interpretele'>Interprété la première foi le : </label><input type='text' name='interpretele' value='' /></td>
				<td><label for='interpretepar'>Interprété par : </label><input type='text' name='interpretepar' value='' /></td></tr>
				<tr><td><label for='opus'>Opus numéro : </label><input type='text' name='opus' value='' /></td>
				<td><label for='duree'>Duree : </label><input type='text' name='duree' value='' /></td>
				<tr><td><label for='type'>Type : </label><input type='text' name='type' value='' /></td>
				<td><label for='instruments'>Instruments : </label><input type='text' name='instruments' value='' /></td></tr>
			</table>
			<h3>Histoire :</h3><br />
			<textarea id='biography' name='biography'></textarea><br /><center>
			<input type='submit' name='submit' value='Ajouter'>
			<input type='submit' name='annuller' value='Annuller'></center>
			</form></div>";
?>