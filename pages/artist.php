<?php
	if(isset($id)){
	include('pages/functions.php');
	$artist = recup_artist($id);
	$neele = Decoupedatetime($artist[3]);
	$mortle =  Decoupedatetime($artist[5]);
	echo "<center><h1>$artist[1]</h1></center>
			<div>
			<table border='0' width='100%' style='font-size:18px;'>
				<td>Nom complet de l'artiste : $artist[2]<br />
					Née le $neele à $artist[4]<br />
					Décédé(e) le $mortle à $artist[6] <br /></td><td>";
			// image artist
			$array = array("jpg","png","gif","JPG","PNG","GIF");
			$i = 0;
			$res ="";
			while($i != count($array)){
				if(file_exists("sources/images/".$id.".".$array[$i])){
					$mdcinq = md5_file("sources/images/min/$id.$array[$i]");
					$res = "<a class='zoombox zgallery1' href='sources/images/$id.$array[$i]?<?php echo".$mdcinq."; ?>'><img src='sources/images/min/$id.$array[$i]?<?php echo".$mdcinq."; ?>' class='profil-photo' alt='".$artist[1]."' /></a>";
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
			</table>";
			if(isset($_SESSION['username'])){
				echo 		"<br /><a href='mod-artist".$id."'>Modifier l'artiste</a> - <a href='suppr-artist".$id."'>Supprimer l'artiste</a>";
			}
			echo "</div>
			<div>
			<hr />";
			if($artist[7] != ""){
				echo "<h2>Biographie</h2>
					$artist[7]
					<hr />";
			}
			echo "<span class='auteur'>Dernière modification par $artist[8].</span>
			</div>
			<div id='enreg'>";
			$enreg = afficher_enregistrement($id);
			if(count($enreg) != 0){
			echo "<h2>Enregistrements</h2>
				 <table border='0' width='100%'>
					<tr>
						<td>Opus</td>
						<td>Titre</td>
						<td>Date de création</td>
						<td>Durée (h:m:s)</td>
						<td>Type de musique</td>
						<td>Instruments</td>
						<td>Interpretes</td>
					</tr>
					<tr>";
			$i = 0;
			while($i < count($enreg)){
				$res = $enreg[$i];
				$date = Decoupedatetime($res['annee']);
				echo "<tr>
						<td>".$res['opus']."</td>
						<td><a href='enreg".$res['id']."'>".$res['titre']."</a></td>
						<td>".$date."</td>
						<td>".$res['duree']."</td>
						<td>".$res['type']."</td>
						<td>".$res['instruments']."</td>
						<td>".$res['interpretes']."</td>
					</tr>";
				$i++;
			}
			echo   "</tr>
				  </table>";
			}
			echo "</div>";
	}else header('Location:index.php');
?>