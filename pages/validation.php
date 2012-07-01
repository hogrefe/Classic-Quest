<?php
	if(!isset($_SESSION['username']) && $_SESSION['statut'] != "webmaster"){
		header('Location:admin');
	}

	include('bdd.php');
	include('pages/functions.php');
	if(isset($ok) && isset($id)){
		$resultat = recup_user($id);
		$sql = 'UPDATE users SET statut="redacteur" WHERE id="'.$id.'"';
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		$contenu="Bonjour, votre compte à été validé. Vous pouvez désormais vous connecter sur le site et ajouter de nouveau compositeur ou enregistrement. Merci à vous!";
		sendmail($resultat[3],$contenu,'Bienvenue en tant que redacteur sur Classic Quest');
		header('Location:validation');
	}
	if(isset($non) && isset($id)){
		$resultat = recup_user($id);
		$sql = "DELETE FROM `users` WHERE `id` = $id";
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		$contenu = "Malheuresement votre compte n'a pas été retenu en tant que redcteur. Vous pouvez a tout moment vous réinscrire et proposer une présentation de vos objectif plus complet et adéquat pour devenir rédacteur sur notre site. Merci a vous!";
		sendmail($resultat[3],$contenu,'Profil non valider sur Classic Quest');
		header('Location:validation');
	}
	$results = array();
	$sql = mysql_query("SELECT * FROM users WHERE statut = 'nonverif' ORDER BY email ASC");
	while($row = mysql_fetch_assoc($sql)){
		$results[] = $row; 
	}
	$i = 0;
	while($i < count($results)){
		$resultat = $results[$i];
		$i++;
		echo $resultat['username']." : <strong>".$resultat['email']."</strong> voudrait devenir redacteur pour le site.<br /> Voici sa présentation : <br />".$resultat['presentation']."<br />";
		echo "<a href='validationok".$resultat['id']."'>Rédacteur</a> <a href='validationnon".$resultat['id']."'>Non valide</a>";
		echo "<hr />";
	}
	if(count($results) == 0)
		echo "Aucune demande de redacteur non traiter!";
?>