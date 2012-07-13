<?php
	if(isset($_POST['submit'])){
		$username = htmlspecialchars(trim($_POST['username'])); // recupere l'username de fassont securiser
		$password = htmlspecialchars(trim($_POST['password'])); // recupere le password (mot de pass) de fassont securiser
		if($username && $password){
			$password = md5($password); 						// prend le md5 du mot de passe
			include('bdd.php');
			$log = mysql_query("SELECT * FROM `users` WHERE username ='$username' AND password = '$password'");
			$rows = mysql_num_rows($log);
			if($rows==1){ 										// si l'utilisateur est dans la bdd
				$query = "SELECT * FROM `users` WHERE username ='$username' AND password = '$password'";
				$result = mysql_query($query);
				// Recuperation des resultats
				while($row = mysql_fetch_row($result)){
					if ($row[5] == "webmaster" || $row[5] == "admin" || $row[5] == "redacteur"){
						$_SESSION['username'] = $row[1];				// Variable de session username
						$_SESSION['id'] = $row[0];
						$_SESSION['statut'] = $row[5];				// Variable de session statut
						$_SESSION['email'] = $row[3];
						$_SESSION['presentation'] = $row[4];
						//redirection
						echo '<SCRIPT LANGUAGE="JavaScript">
									document.location.href="index.php"
								</SCRIPT>';
					}else $error[] = "Statut non vérifié! Veuillez attendre la réponse de notre équipe pour vous connecter";
				}
			}else $error[] = "Nom d'utilisateur ou mots de passe incorrecte!";
		}else $error[] = "Si vous voulez vous connecter, veuillez saisir tous les champs du formulaire prévu à cet effet!";
	}
	// inscription----------------------------------------------------------------------------------------------------------
	if(!empty($error)){
		foreach ($error as $errors) { //errors est un tableau donc on peut avoir plusieur erreur, style profile nom...
			echo "<span style='color:red;'><strong>".$errors.'</strong></span><br />';
		}
	}
	if(isset($_POST['submitinscr'])){
		$username = htmlspecialchars(trim(addslashes($_POST['username']))); // recupere l'username de fassont securiser
		$password = htmlspecialchars(trim(addslashes($_POST['password']))); // recupere le password (mot de pass) de fassont securiser
		$repeatpassword = htmlspecialchars(trim(addslashes($_POST['repeatpassword']))); // recupere le repeatpassword de fassont securiser
		$email = htmlspecialchars(trim(addslashes($_POST['email']))); // recupere l'email de fassont securiser
		$biography = addslashes($_POST['biography']); // recupere la biography de fassont securiser
		if($username && $password && $repeatpassword && $email && $biography){ 			// verifi si tous les champs on ete rempli
			if($password == $repeatpassword){ 					// verifi si les deux mots passe sont identiques
				if(strlen($password)>3){ 						// verifie si la taille du mots de passe et superieur a 3 caractères
					$password = md5($password); 				// mes le mdp en md5 (plus securite)
					include('bdd.php');
					$query = mysql_query("SELECT * FROM `users` WHERE email = '$email'");
					$rows = mysql_num_rows($query);
					if($rows==0){									 // S'il nexiste pas dans la bdd
						$nonverif = "nonverif";
						$reg = mysql_query("INSERT INTO users Values('','$username','$password','$email','$biography','$nonverif')"); // ajoute l'element dans la table
						
						$sujet = "Inscription d'un nouveau membre sur musique classique";
						$message = "Un nouveau redacteur? ".$email." il envoi le message suivant ".$_POST['biography'].". A bientot!";
						$adresse = "haris.seldon@gmail.com";
						sendmail($adresse,$message,$sujet);
						die('Inscription terminee!<br />');  // die = echo plus break
					}else $errorb[] = "utilisateur deja dans la base de donnee!";
				}else $errorb[] = "Le mots de passe est trop petit!"; // un else peu secrire sur une ligne
			}else $errorb[] = "Les mots de passe sont differents!";   // s'il n'y a q'une seul chose a faire
		}else $errorb[] = "Si vous voulez vous inscrire, veuillez saisir tous les champs du formulaire prévu à cet effet!";		 // IDEM POUR UN if
	}
?>
		<style>
			label{
				float:left;
				display:block;
				width:200px;
			}
		</style>
		<h1>Connexion</h1>
		<form method="POST" action="">
			<label for="username">Votre nom d'utilisateur :</label>
			<input type="text" name="username" /><br />
			<label for="password">Mots de passe : </label>
			<input type="password" name="password" /><br /><br />
			<input type="submit" value="Connection" name="submit" />
			<input type="submit" value="Effacer" name="nul" /><a name="inscrire"></a>
		</form>
		<hr />
		<h1>S'inscrire</h1>
		<form method="POST" action="">
			<label for="username">Votre login : </label>
			<input type="text" name="username" /><br /><br />
			<label for="email">Votre adresse email : </label>
			<input type="text" name="email" /><br /><br />
			<label for="password">Mots de passe : </label>
			<input type="password" name="password" /><br />
			<label for="repeatpassword">Repeter le mots de passe : </label>
			<input type="password" name="repeatpassword" /><br /><br />
			Présentation et motivation pour devenir redacteur sur ce site :
			<div id="mod"><textarea name="biography"></textarea></div>
			<br /><center><input type="submit" value="Inscription" name="submitinscr" />
			<input type="submit" value="Effacer" name="nul" /></center>
		</form>
		<hr />
		<?php
			if(!empty($errorb)){
				foreach ($errorb as $errors) { //errors est un tableau donc on peut avoir plusieur erreur, style profile nom...
					echo "<span style='color:red;'><strong>".$errors.'</strong></span><br />';
				}
			}
		?>