<?php
	if(isset($id)){
		include('pages/functions.php');
		$enreg = recup_enreg($id);
		$artist = recup_artist($enreg[1]);
		echo "<center><h1>".$enreg[7]."</h1></center>
		<div>
			<table border='0' width='100%' style='overflow:hidden; font-size:18px;'>
				<td>Nom de l'artiste : <a href='artist".$artist[0]."'>$artist[1]</a><br />
					Interprété la première foi le : ".Decoupedatetime($enreg[4])."<br />
					Opus numéro : $enreg[8]<br />
					Type : $enreg[5]<br />
				</td>
				<td>
					Nom complet de l'artiste : <a href='artist".$artist[0]."'>$artist[2]</a><br />
					Interprété par : $enreg[2] <br />
					Duree : $enreg[3] <br />
					Instruments : $enreg[6]<br />
				</td>
			</table>";
			if(isset($_SESSION['username'])){
				echo "<br /><a href='mod-enreg".$id."'>Modifier l'enregistrement</a> - <a href='suppr-enreg".$id."'>Supprimer l'enregistrement</a>";
			}
		echo "</div>
			<div>
			<hr />";
			if($enreg[9] != ""){
				echo "<h2>Histoire</h2>
					$enreg[9]
					<hr />";
			}
			echo "<span class='auteur'>Dernière modification par $enreg[10].</span>
			</div>";
	}else header('Location:index.php');
?>