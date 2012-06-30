<center><h2>Galerie d'Artistes.</h2></center>
<?php
	include('pages/functions.php');
	
	if(!isset($galid) || is_numeric($galid) || $galid > 'z' || $galid < 'a'){
		$page = $galid = ''; 						// valeur par defaut page 1
	}else $page = $galid;

	$results = afficher_artist($page);
	echo "<ul id='galery-artist'>";
	foreach ($results as $result) {
		echo '<li><a href="artist'.$result['id'].'">'.$result['nomartist']."</a></li>"; 			// affiche le nom des artists
	}
	echo "</ul><div id='fin-galery-artist'>";
	$i = 97;
	if($page == ''){
		echo "<span id='sel'> Tous </span>";
	}else echo "<a href='galery-artist'> Tous </a>";
	while($i <= 122){ //chr(116); renvoi t
		$it = chr($i);
		if($it == $page){
			echo "<span id='sel'> ".strtoupper($it)." </span>";
		}else echo "<a href='galery-artist{$it}'> ".strtoupper($it)." </a>"; // lien vers les autres pages
		$i++;
	}
	echo "</div>";
?>