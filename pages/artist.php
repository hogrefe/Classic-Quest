<?php
	if(isset($id)){
	$artist = recuperation($id,'artist');
	if(!empty($artist)){
	$neele = Decoupedatetime($artist[3]);
	$mortle =  Decoupedatetime($artist[5]);
	echo "<center><h1>$artist[1]</h1></center>
			<div>
			<table border='0' width='100%' style='font-size:18px;'>
				<td>Nom complet de l'artiste : $artist[2]<br />
					Née le $neele à $artist[4]<br />
					Décédé(e) le $mortle à $artist[6] <br />
					L'artiste est un $artist[10]</td><td>";
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
			</table><br />";
			echo "<div id='mapsv'><a href='outils/pdf.php'>Télécharger la fiche (PDF)</a></div>";
			if(isset($_SESSION['username'])){
				echo 		"<div id='mapsv'><a href='mod-artist".$id."'>Modifier l'artiste</a></div><div id='mapsv'><a href='suppr-artist".$id."'>Supprimer l'artiste</a></div>";
			}
			echo "<br /><br /><br /></div>
			<div>
			<hr />";
			if($artist[7] != ""){
				echo "<h2>Biographie</h2>
					$artist[7]
					<hr />";
			}
			// recup user
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
		}
		else {
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="index.php"
			</SCRIPT>';
		}
	}
	else {
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="index.php"
			</SCRIPT>';
	}
?>
