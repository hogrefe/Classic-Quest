<center><h2>Galerie des <?php echo $typeartist; ?>s.</h2></center>
<?php
	if(!isset($galid) || is_numeric($galid) || $galid > 'z' || $galid < 'a'){
		$page = $galid = ''; 						// valeur par defaut page 1
	}else $page = $galid;
	$results = afficher_artist($page,$typeartist); // $artistype a decouper dans l'url
	echo "<ul id='galery-artist'>";
	foreach ($results as $result) {
		echo '<li><a href="artist'.$result['id'].'"><br />';
		// image artist
			$array = array("jpg","png","gif","JPG","PNG","GIF");
			$i = 0;
			$res ="";
			while($i != count($array)){
				if(file_exists("sources/images/".$result['id'].".".$array[$i])){
					$mdcinq = md5_file("sources/images/min/".$result['id'].".".$array[$i]);
					$res = "<img src='sources/images/min/".$result['id'].".".$array[$i]."?<?php echo".$mdcinq."; ?>' class='profil-photo' alt='".$result['nomartist']."' />";
				}
				$i++;
			}
			if($res == ""){
				echo '<img src="sources/image-profil.jpg" alt="'.$result['nomartist'].'" />';
			}
			else{
				echo $res;
			}
		echo "<br />".$result['nomartist']."</a></li>"; 			// affiche le nom des artists
	}
	echo "</ul><div id='fin-galery-artist'>";
	$i = 97;
	if($page == ''){
		echo "<span id='sel'> Tous </span>";
	}else echo "<a href='galery-artist-".$typeartist."'> Tous </a>";
	while($i <= 122){ //chr(116); renvoi t
		$it = chr($i);
		if($it == $page){
			echo "<span id='sel'> ".strtoupper($it)." </span>";
		}else echo "<a href='galery-artist-".$typeartist.$it."'> ".strtoupper($it)." </a>"; // lien vers les autres pages
		$i++;
	}
	echo "</div>";
?>