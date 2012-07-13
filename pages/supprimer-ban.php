<?php
	if(!isset($_SESSION['username']) && $_SESSION['statut'] != "webmaster"){
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="admin"
			</SCRIPT>';
	}

	include('bdd.php');
	
	if(isset($suppr) && $suppr == "suppr"){
		$sql = 'DELETE FROM `users` WHERE `id` = "'.$id.'"';
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="supprimer-ban"
			</SCRIPT>';
	}
	if(isset($ban) && $ban == "ban"){
		$user = recup_user($id);
		$sql = 'DELETE FROM `users` WHERE `id` = "'.$id.'"';
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		$sql = "INSERT INTO bans Values('','".$user[3]."')";
		mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="supprimer-ban"
			</SCRIPT>';
	}
	$results = array();
	$sql = mysql_query("SELECT * FROM users WHERE statut != 'webmaster' AND statut != 'admin' ORDER BY email ASC");
	while($row = mysql_fetch_assoc($sql)){
		$results[] = $row; 
	}
	$i = 0;
	while($i < count($results)){
		$resultat = $results[$i];
		$i++;
		echo $resultat['username']." : <strong>".$resultat['email']."</strong><br /> Voici sa présentation : <br />".$resultat['presentation']."<br />";
		echo "<a href='supprimer-bans".$resultat['id']."'>Supprimer</a> <a href='supprimer-banb".$resultat['id']."'>Bannir</a>";
		echo "<hr />";
	}
	if(count($results) == 0)
		echo "Aucun utilisateur sur le site, ce qui est impossible, puisque je voi cette page!";

?>