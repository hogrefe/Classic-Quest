<?php
	$event = recup_event($id);
	echo 	"<center><h1>".$event[1]."</h1>
				<br />";
	// image artist
	$array = array("jpg","png","gif","JPG","PNG","GIF");
	$i = 0;
	$res ="";
	while($i != count($array)){
		if(file_exists("sources/images/e".$id.".".$array[$i])){
			$mdcinq = md5_file("sources/images/min/e$id.jpg");
			$res = "<a class='zoombox zgallery1' href='sources/images/e$id.$array[$i]?<?php echo".$mdcinq."; ?>'><img src='sources/images/min/e$id.jpg?<?php echo".$mdcinq."; ?>' class='profil-photo' alt='".$event[1]."' /></a>";
		}
		$i++;
	}
	if($res == ""){
		echo '<img src="sources/image-profil.jpg" alt="'.$event[1].'" />';
	}
	else{
		echo $res;
	}
	echo 	"</center>
				Prévu le : <strong>".Decoupedatetime($event[2])."</strong><br />
				Prévu à cette adresse : <strong>$event[3]</strong><br />";
	if(isset($_SESSION['username'])){
		echo "<br /><div id='mapsv'><a href='mod-event".$id."'>Modifier l'évènement</a></div><div id='mapsv'><a href='suppr-event".$id."'>Supprimer l'évènement</a></div>";
	}
	echo 	"<br /><br /><br /><div id='mapdescri'><strong>Attention cette carte est a titre indicatif, en aucun cas le lieu designer par celle si
			ne sera vérifier. Seul l'adresse écrit devra être exacte.</strong></div><br /><div id ='maps' style='text-align: center;'>
			<iframe frameborder='0' height='500' marginheight='0' marginwidth='0' scrolling='no' src='http://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=".$event[3]."&amp;output=embed' width='500'></iframe><br /></div>
			</div><div id='restevent'><hr />";
	if($event[4] != "")
		echo	"<h3>Détail, programme :</h3><br />$event[4]";
	echo "<span class='auteur'>Dernière modification par ".$event[5].".</span></div>";
?>