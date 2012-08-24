<center><h2>Calendrier des Évènements à venir.</h2></center>
<?php
	include('bdd.php');
	$results = array();
	$sql = mysql_query("SELECT * FROM evenement order by SUBSTRING(date,-4, 4) ASC, SUBSTRING(date,-10, 2) ASC, SUBSTRING(date,-7, 2) ASC");
	while($row = mysql_fetch_assoc($sql))
	{
		$results[] = $row; 
	}
	if(count($results) == 0)
	{
		echo "<span style='color:red;'>Pas de nouveau évènements enregistrés.</span>";
	}else{
		$dateanne = "";
		foreach ($results as $result) 
		{
			$dateanne .= $result['date'].",";
		}
		echo "<input type='hidden' name='dateanne' id='dateanne' value='".$dateanne."' /><center><div id='anne'></div></center>";
	}
?>
<hr />
<center><h2>Galerie des Évènements à venir.</h2></center>
<?php
	include('bdd.php');
	$results = array();
	$sql = mysql_query("SELECT * FROM evenement order by SUBSTRING(date,-4, 4) ASC, SUBSTRING(date,-10, 2) ASC, SUBSTRING(date,-7, 2) ASC");
	while($row = mysql_fetch_assoc($sql)){
			$results[] = $row; 
	}
	if(count($results) == 0){
		echo "<span style='color:red;'>Pas de nouveau évènements enregistrés.</span>";
	}else{
		echo "<ul id='galery-artist'>";
		foreach ($results as $result) {
			echo '<li><a href="event'.$result['id'].'"><br />';
			// image event
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
			echo "<br />".$result['nom']."</a></li>"; 			// affiche le nom des event
		}
	}
?>