<?php
	if(!isset($_SESSION['username']) && $_SESSION['statut'] != "webmaster"){
		header('Location:admin');
	}

	include('bdd.php');
	include('pages/functions.php');


	$results = array();
	$sql = mysql_query("SELECT * FROM users WHERE statut = 'nonverif' ORDER BY email ASC");
	while($row = mysql_fetch_assoc($sql)){
		$results[] = $row; 
	}
	$i = 0;
	while($i < count($results)){
		$resultat = $results[$i];
		$i++;
		echo $resultat['username']." : <strong>".$resultat['email']."</strong> voudrait devenir redacteur pour le site. Voici sa présentation : <br />".$resultat['presentation']."<br />";
		echo "<a href='validationok".$resultat['id']."'>Rédacteur</a> <a href='validationnon".$resultat['id']."'>Non valide</a>";
		echo "<hr />";
	}
	if(count($results) == 0)
		echo "Aucun utilisateur sur le site, ce qui est impossible, puisque je voi cette page!";

?>