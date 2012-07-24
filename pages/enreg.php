<?php
	if(isset($id)){
		$enreg = recup_enreg($id);
		if(!empty($enreg)){
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
					echo "<br /><div id='mapsv'><a href='mod-enreg".$id."'>Modifier l'enregistrement</a></div><div id='mapsv'><a href='suppr-enreg".$id."'>Supprimer l'enregistrement</a></div><br /><br /><br />";
				}
			echo "</div>
				<hr />";
				if($enreg[9] != ""){
					echo "<h2>Histoire</h2>
						$enreg[9]
						<hr />";
				}
				echo "<div id='enreg'>";
				$enreg = afficher_enregistrement($artist[0]);
				if(count($enreg) != 0){
				echo "<h3>Liste des enregistrements du même compositeur ($artist[2])</h3>
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
				$auteur = $enreg[0];
				echo "<span class='auteur'>Dernière modification par ".$auteur['auteur'].".</span>";
			}
			else{
				//redirection
				echo '<SCRIPT LANGUAGE="JavaScript">
					document.location.href="index.php"
				</SCRIPT>';
			}
		} else{
		//redirection
		echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="index.php"
			</SCRIPT>';
	}
?>