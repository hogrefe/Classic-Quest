<div id="menufond">
<ul id="menuDeroulant">
	<li><a href="index.php"><strong>Classic Quest</strong></a></li>
	<li><a href="accueil">Nouveautées</a></li>
	<li><a href="#"> Les Galeries</a>
		<ul class='sousMenu'>
			<li><a href="galery-artist-Compositeur">Compositeurs</a></li>
			<li><a href="galery-artist-Interprete">Interpretes</a></li>
			<li><a href="galery-event">Événements</a></li>
		</ul></li>
</ul>
<ul id="menu-droit">
		<?php if(isset($_SESSION['username'])){
	 		echo "<li><a href='logout'>Deconnexion</a></li>";
	 		echo "<li><a href='param'>Paramètres</a>";
	 		echo "<ul class='sousMenu'>";
	 			if($_SESSION['statut'] == "webmaster"){
	 				echo "<li><a href='validation'>Validation</a></li>";
	 				echo "<li><a href='supprimer-ban'>Bannir</a></li>";
	 			}
	 		echo "</ul></li>";
	 		echo "<li><a href='add'>Ajouter</a>";
	 		echo "<ul class='sousMenu'>";
	 			echo "<li><a href='add-artist'>Artiste</a></li>";
		 		echo "<li><a href='add-enreg'>Enregistrement</a></li>";
		 		echo "<li><a href='add-event'>Événement</a></li>";
		 	echo "</ul></li>";
	 	} else {
	 		echo '<li><a href="admin">Connexion</a></li>';
	 		echo '<li><a href="admin#inscrire">Inscription</a></li>';
	 	}
	 ?>
</ul>
</div>