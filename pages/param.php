<?php
	if(!isset($_SESSION['username'])){
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="admin"
			</SCRIPT>';
	}
	
	include('bdd.php');
	
	$user = recup_user($_SESSION['id']);

	if(isset($_POST['submit'])){
		$username = htmlspecialchars(trim(addslashes($_POST['username'])));
		$email = htmlspecialchars(trim(addslashes($_POST['email'])));
		$presentation = addslashes($_POST['biography']);
		$oldpassword = htmlspecialchars(trim(addslashes($_POST['oldpassword'])));
		$newpassword = htmlspecialchars(trim(addslashes($_POST['newpassword'])));
		$repeatnewpassword = htmlspecialchars(trim(addslashes($_POST['repeatnewpassword'])));
		if($oldpassword && $newpassword && $repeatnewpassword){
			if(md5($oldpassword) == $user[2]){
				if($newpassword == $repeatnewpassword){
					$newpasswordok = md5($newpassword); 
				}else die("<span style='color:red;'>Les 2 nouveaux mots de passe sont différents!</span> - <a href='param'>Retour a vos paramètres</a>");
			}else die("<span style='color:red;'>Votre mots de passe d'origine est faux!</span>  - <a href='param'>Retour a vos paramètres</a>");
		}
		if(empty($newpasswordok)){
			$newpasswordok = $user[2];
		}
		$sql = 'UPDATE users SET username="'.$username.'", password="'.$newpasswordok.'",email = "'.$email.'", presentation="'.$presentation.'" WHERE id="'.$user[0].'"';
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		$_SESSION['username'] = $username;
		$_SESSION['email'] = $email;
		$_SESSION['presentation'] = $presentation;
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="param"
			</SCRIPT>';
	}
	echo 	"<div id='mod'><form method='POST' action=''>
				<h3>Vos coordonnées :</h3>
				<label for='username'>Vos noms et prénoms : </label><input type='text' name='username' value='".$_SESSION['username']."' /><br />
				<label for='email'>Votre adresse email : </label><input type='text' name='email' value='".$_SESSION['email']."' /><br />
				<h3>Changer de mot de passe :</h3>
				<label for='oldpassword'>Votre ancien mot de passe : </label><input type='password' name='oldpassword' value='' /><br />
				<label for='newpassword'>Nouveau mot de passe : </label><input type='password' name='newpassword' value='' /><br />
				<label for='repeatnewpassword'>Retapez le à nouveau : </label><input type='password' name='repeatnewpassword' value='' /><br />
				<h3>Votre présentation : </h3>
				<textarea name='biography'>".$_SESSION['presentation']."</textarea><br /><center>
				<input type='submit' name='submit' value='Modifier mon profil'>
				<input type='submit' name='annuller' value='Annuler'></center>
			</form></div>";
?>