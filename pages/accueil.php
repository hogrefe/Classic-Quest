<?php
	include('bdd.php');
	// EVENEMENTS
	$results = array();
	// suppr les event passés
	$query = "SELECT * FROM evenement order by date";
		$result = mysql_query($query);
		// Recuperation des resultats
		while($row = mysql_fetch_row($result))
		{
			$suppridate = "non";
			$exploderdta = substr($row[2],-10, 10);
			$expldate = explode('/', $exploderdta);
			if($expldate[2] < date("Y"))
			{
				$suppridate = "ok";
			}
			elseif($expldate[2] == date("Y"))
			{
				if($expldate[0] < date("n"))
				{
					$suppridate = "ok";

				}
				elseif($expldate[0] == date("n"))
				{
					if($expldate[1] < date("j"))
					{
						$suppridate = "ok";
					}
				}
			}
			if($suppridate == "ok")
			{
				$sql = mysql_query("DELETE FROM evenement WHERE id='".$row[0]."'");
			}
		}
	// supprimer les images inutiles
	$dir_nom = 'sources/images/'; // dossier listé (pour lister le répertoir courant : $dir_nom = '.'  --> ('point')
	$dir = opendir($dir_nom) or die('Erreur de listage : le répertoire n\'existe pas'); // on ouvre le contenu du dossier courant
	$fichier= array(); // on déclare le tableau contenant le nom des fichiers
	while($element = readdir($dir)) {
		if($element != '.' && $element != '..') {
			if (!is_dir($dir_nom.'/'.$element)) {$fichier[] = $element;}
		}
	}
	closedir($dir);
	if(!empty($fichier)){
		sort($fichier);// pour le tri croissant, rsort() pour le tri décroissant
		foreach($fichier as $lien) {
			//event
			if (preg_match("/e/",$lien)){
				$idm = substr($lien, 1, -4);
				$sql = mysql_query("SELECT * FROM evenement WHERE `id`=$idm");
				while($row = mysql_fetch_assoc($sql)){
					$results[] = $row; 
				}
				if(empty($results)){
					// kill des images.
					if(file_exists("sources/images/e".$idm.".jpg")){
						unlink("sources/images/e".$idm.".jpg");
					}
					elseif(file_exists("sources/images/e".$idm.".gif")){
						unlink("sources/images/e".$idm.".gif");
					}
					elseif(file_exists("sources/images/e".$idm.".png")){
						unlink("sources/images/e".$idm.".png");
					}
					if(file_exists("sources/images/min/e".$idm.".jpg")){
						unlink("sources/images/min/e".$idm.".jpg");
					}
				}
				$results = array(); // nettoyage de results
			}
			//artist
			if (!preg_match("/e/",$lien)){
				$idm = substr($lien, 0, -4);
				$sqlb = mysql_query("SELECT * FROM artist WHERE `id`=$idm");
				while($rowb = mysql_fetch_assoc($sqlb)){
					$resultsb[] = $rowb; 
				}
				if(empty($resultsb)){
					// kill des images.
					if(file_exists("sources/images/".$idm.".jpg")){
						unlink("sources/images/".$idm.".jpg");
					}
					elseif(file_exists("sources/images/".$idm.".gif")){
						unlink("sources/images/".$idm.".gif");
					}
					elseif(file_exists("sources/images/".$idm.".png")){
						unlink("sources/images/".$idm.".png");
					}
					if(file_exists("sources/images/min/".$idm.".jpg")){
						unlink("sources/images/min/".$idm.".jpg");
					}
				}
				$resultsb = array(); // nettoyage de results
			}
		}
	 }
	//afficher les futur evenement
	$results = array();
	$sql = mysql_query("SELECT * FROM evenement order by SUBSTRING(date,-7, 6) ASC limit 0,3");
	while($row = mysql_fetch_assoc($sql)){
		$results[] = $row; 
	}
	if(count($results) != 0)
		echo "<div><center><h2>Les prochains évènements.</h2></center>";
	echo "<ul id='galery-artist'>";
	foreach ($results as $result) {
		echo '<li><a href="event'.$result['id'].'"><br />';
		// image artist
			$array = array("jpg","png","gif","JPG","PNG","GIF");
			$i = 0;
			$res ="";
			while($i != count($array)){
				if(file_exists("sources/images/e".$result['id'].".".$array[$i])){
					$mdcinq = md5_file("sources/images/min/e".$result['id'].".jpg");
					$res = "<img src='sources/images/min/e".$result['id'].".jpg?<?php echo".$mdcinq."; ?>' class='profil-photo' alt='".$result['nom']."' />";
				}
				$i++;
			}
			if($res == ""){
				echo '<img src="sources/image-profil.jpg" alt="'.$result['nom'].'" />';
			}
			else{
				echo $res;
			}
		echo "<br />".$result['nom']."</a></li>";
	}
	if(count($results) != 0)
	{
		echo "</div><br /><br /><br /><hr />";
	}
	// COMPOSITEUR
	echo	"<div><center><h2>Les derniers compositeurs ajoutés ou modifiés.</h2></center>";
	include('bdd.php');
	$results = array();
	$sql = mysql_query("SELECT * FROM artist WHERE typeartist = 'Compositeur' order by creerle desc limit 0,10");
	while($row = mysql_fetch_assoc($sql)){
		$results[] = $row; 
	}
	$t = 0;
	foreach ($results as $result) {
		$id = $result['id'];
		$artist = recuperation($id,'artist');
		$neele = Decoupedatetime($artist[3]);
		$mortle =  Decoupedatetime($artist[5]);
		if($t == 0){
			echo "<span class='acccompog'><a href='artist".$id."'><table border='0' width='100%' style='font-size:18px;'>
				<td WIDTH='90%'>Nom complet de l'artiste : $artist[2]<br />
					Née le $neele à $artist[4]<br />
					Décédé(e) le $mortle à $artist[6] <br /></td><td WIDTH='10%'>";
			// image artist
			$array = array("jpg","png","gif","JPG","PNG","GIF");
			$i = 0;
			$res ="";
			while($i != count($array)){
				if(file_exists("sources/images/".$id.".".$array[$i])){
					$mdcinq = md5_file("sources/images/min/$id.jpg");
					$res = "<a class='zoombox zgallery1' href='sources/images/$id.$array[$i]?<?php echo".$mdcinq."; ?>'><img src='sources/images/min/$id.jpg?<?php echo".$mdcinq."; ?>' class='profil-photo' alt='".$artist[1]."' /></a>";
				}
				$i++;
			}
			if($res == ""){
				echo '<img src="sources/image-profil.jpg" alt="'.$artist[1].'" />';
			}
			else{
				echo $res;
			}
			echo "</td>
			</table></a></span>";
			$t = 1;
		}
		else{
			echo "<span class='acccompog'><a href='artist".$id."'><table border='0' width='100%' style='font-size:18px;'><td WIDTH='30%'>";
			// image artist
			$array = array("jpg","png","gif","JPG","PNG","GIF");
			$i = 0;
			$res ="";
			while($i != count($array)){
				if(file_exists("sources/images/".$id.".".$array[$i])){
					$mdcinq = md5_file("sources/images/min/$id.jpg");
					$res = "<a class='zoombox zgallery1' href='sources/images/$id.$array[$i]?<?php echo".$mdcinq."; ?>'><img src='sources/images/min/$id.jpg?<?php echo".$mdcinq."; ?>' class='profil-photo' alt='".$artist[1]."' /></a>";
				}
				$i++;
			}
			if($res == ""){
				echo '<img src="sources/image-profil.jpg" alt="'.$artist[1].'" />';
			}
			else{
				echo $res;
			}
			echo "</td><td WIDTH='70%'>Nom complet de l'artiste : $artist[2]<br />
					Née le $neele à $artist[4]<br />
					Décédé(e) le $mortle à $artist[6] <br /></td>
			</table></a></span>";
			$t = 0;
		}
		echo "<hr />";
	}
	echo "<div id='mapsv'><a href='galery-artist-Compositeur'>Les autres compositeurs</a></div></div>";
	// INTERPRETE
	include('bdd.php');
	$results = array();
	$sql = mysql_query("SELECT * FROM artist WHERE typeartist != 'Compositeur' order by creerle desc limit 0,10");
	while($row = mysql_fetch_assoc($sql)){
		$results[] = $row; 
	}
	if(count($results) > 0){
		echo	"<div><br /><br /><br /><hr /><center><h2>Les derniers interprètes ajoutés ou modifiés.</h2></center>";
		$t = 0;
		foreach ($results as $result) {
			$id = $result['id'];
			$artist = recuperation($id,'artist');
			$neele = Decoupedatetime($artist[3]);
			$mortle =  Decoupedatetime($artist[5]);
			if($t == 0){
				echo "<span class='acccompog'><a href='artist".$id."'><table border='0' width='100%' style='font-size:18px;'>
					<td WIDTH='90%'>Nom complet de l'artiste : $artist[2]<br />
						Née le $neele à $artist[4]<br />
						Décédé(e) le $mortle à $artist[6] <br /></td><td WIDTH='10%'>";
				// image artist
				$array = array("jpg","png","gif","JPG","PNG","GIF");
				$i = 0;
				$res ="";
				while($i != count($array)){
					if(file_exists("sources/images/".$id.".".$array[$i])){
						$mdcinq = md5_file("sources/images/min/$id.jpg");
						$res = "<a class='zoombox zgallery1' href='sources/images/$id.$array[$i]?<?php echo".$mdcinq."; ?>'><img src='sources/images/min/$id.jpg?<?php echo".$mdcinq."; ?>' class='profil-photo' alt='".$artist[1]."' /></a>";
					}
					$i++;
				}
				if($res == ""){
					echo '<img src="sources/image-profil.jpg" alt="'.$artist[1].'" />';
				}
				else{
					echo $res;
				}
				echo "</td>
				</table></a></span>";
				$t = 1;
			}
			else{
				echo "<span class='acccompog'><a href='artist".$id."'><table border='0' width='100%' style='font-size:18px;'><td WIDTH='30%'>";
				// image artist
				$array = array("jpg","png","gif","JPG","PNG","GIF");
				$i = 0;
				$res ="";
				while($i != count($array)){
					if(file_exists("sources/images/".$id.".".$array[$i])){
						$mdcinq = md5_file("sources/images/min/$id.jpg");
						$res = "<a class='zoombox zgallery1' href='sources/images/$id.$array[$i]?<?php echo".$mdcinq."; ?>'><img src='sources/images/min/$id.jpg?<?php echo".$mdcinq."; ?>' class='profil-photo' alt='".$artist[1]."' /></a>";
					}
					$i++;
				}
				if($res == ""){
					echo '<img src="sources/image-profil.jpg" alt="'.$artist[1].'" />';
				}
				else{
					echo $res;
				}
				echo "</td><td WIDTH='70%'>Nom complet de l'artiste : $artist[2]<br />
						Née le $neele à $artist[4]<br />
						Décédé(e) le $mortle à $artist[6] <br /></td>
				</table></a></span>";
				$t = 0;
			}
			echo "<hr />";
		}
		echo "<div id='mapsv'><a href='galery-artist-Interprete'>Les autres interprètes</a></div></div>";
	}
?>
<div><br /><br /><br /><hr />
<center><h2>Les derniers enregistrements ajoutés ou modifiés.</h2></center>
<?php
	// ENREGISTREMENT
	include('bdd.php');
	$results = array();
	$sql = mysql_query("SELECT * FROM enregistrement order by creerle desc limit 0,3");
	while($row = mysql_fetch_assoc($sql)){
		$results[] = $row; 
	}
	echo "<ul id='galery-artist'>";
	foreach ($results as $result) {
		echo '<li><a href="enreg'.$result['id'].'"><br />';
		// image artist
			$array = array("jpg","png","gif","JPG","PNG","GIF");
			$i = 0;
			$res ="";
			while($i != count($array)){
				$rest = recuperation($result['idartist'],'artist');
				if(file_exists("sources/images/".$rest[0].".".$array[$i])){
					$mdcinq = md5_file("sources/images/min/".$rest[0].".".$array[$i]);
					$res = "<img src='sources/images/min/".$rest[0].".".$array[$i]."?<?php echo".$mdcinq."; ?>' class='profil-photo' alt='".$rest[2]."' />";
				}
				$i++;
			}
			if($res == ""){
				echo '<img src="sources/image-profil.jpg" alt="'.$rest[2].'" />';
			}
			else{
				echo $res;
			}
		echo "<br />".$result['titre']."</a></li>"; 			// affiche le nom des artists
	}
?>
</div><br /><br />