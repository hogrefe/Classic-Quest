<?php
	include('bdd.php');
	$results = array();
	// suppr les event passés
	$sql = mysql_query("DELETE FROM evenement WHERE TO_DAYS(date) - TO_DAYS(NOW()) < 0");
	//afficher les futur evenement
	$sql = mysql_query("SELECT * FROM evenement order by date ASC limit 0,3");
	while($row = mysql_fetch_assoc($sql)){
		$results[] = $row; 
	}
	if(count($results) != 0)
		echo "<div><center><h2>Les prochains événements.</h2></center>";
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
	echo	"<div><center><h2>Les derniers artistes ajoutés ou modifiés.</h2></center>";
	include('bdd.php');
	$results = array();
	$sql = mysql_query("SELECT * FROM artist order by creerle desc limit 0,3");
	while($row = mysql_fetch_assoc($sql)){
		$results[] = $row; 
	}
	echo "<ul id='galery-artist'>";
	foreach ($results as $result) {
		echo '<li><a href="artist'.$result['id'].'"><br />';
		// image artist
			$array = array("jpg","png","gif","JPG","PNG","GIF");
			$i = 0;
			$res ="";
			while($i != count($array)){
				if(file_exists("sources/images/".$result['id'].".".$array[$i])){
					$mdcinq = md5_file("sources/images/min/".$result['id'].".jpg");
					$res = "<img src='sources/images/min/".$result['id'].".jpg?<?php echo".$mdcinq."; ?>' class='profil-photo' alt='".$result['nomartist']."' />";
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
?>
</div>
<div><br /><br /><hr />
<center><h2>Les derniers enregistrements ajoutés ou modifiés.</h2></center>
<?php
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