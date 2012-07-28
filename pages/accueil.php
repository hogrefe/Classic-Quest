<?php
	include('bdd.php');
	// EVENEMENTS
	$results = array();
	// suppr les event passés
	$sql = mysql_query("DELETE FROM evenement WHERE TO_DAYS(date) - TO_DAYS(NOW()) < 0");
	// supprimer les images inutiles
	
	//afficher les futur evenement
	$results = array();
	$sql = mysql_query("SELECT * FROM evenement order by date ASC limit 0,3");
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
		echo "</div><br /><br /><hr />";
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
		$artist = recup_artist($id);
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
			$artist = recup_artist($id);
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
				$rest = recup_artist($result['idartist']);
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