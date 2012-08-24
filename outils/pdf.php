<?php
	include('../bdd.php');
	include("../pages/functions.php");
	ob_start();
?>
<page backtop="20mm" backleft="10mm" backright="10mm" backbottom="30mm" footer="page; date; heure;">
	<page_header width='100%'> 
       <strong>Classic Quest</strong> - http://classic-quest.olympe.in/      
    </page_header> 
	<!-- contenue -->
	<?php
		$old = $_SERVER["HTTP_REFERER"]; // recupere la page precedente
		// enleve le nom de domaine
		if(preg_match("/http:\/\/localhost\/Classic-Quest\//",$old)){
			$old =  substr($old, 31);
		}
		if(preg_match("/http:\/\/classic-quest.olympe.in\//",$old)){
			$old =  substr($old, 31);
		}
		if(preg_match("/http:\/\/oxyde-max.site88.net\//",$old)){
			$old =  substr($old, 28);
		}
		// decoupe artist id enreg, event ...
		if(preg_match("/artist/",$old)){
				$id =  substr($old, 6);
				$artist = recuperation($id,'artist');
				$neele = Decoupedatetime($artist[3]);
				$mortle =  Decoupedatetime($artist[5]);
				echo '<bookmark title="Informations" level="0" ></bookmark>';
				echo "<div style='text-align:center; color: #1d5f1d;'><h1>".htmlentities($artist[1], ENT_QUOTES, "UTF-8")."</h1></div><br />
					<table style='width:100%;'><tr><td style='width:50%;'>Nom complet de l'artiste : ".htmlentities($artist[2], ENT_QUOTES, "UTF-8")."<br />
					".htmlentities('Née le '.$neele.' à '.$artist[4], ENT_QUOTES, "UTF-8")."<br />
					".htmlentities('Décédé(e) le '.$mortle.' à '.$artist[6] , ENT_QUOTES, "UTF-8")."<br />
					L'artiste est un <b>".htmlentities($artist[10], ENT_QUOTES, "UTF-8")."</b></td><td style='width:50%;>";
					// image artist
					$array = array("jpg","png","gif","JPG","PNG","GIF");
					$i = 0;
					$res ="";
					while($i != count($array)){
						if(file_exists("../sources/images/".$id.".".$array[$i])){
							$res = "<img src='../sources/images/min/".$id.".jpg' class='profil-photo' />";
						}
						$i++;
					}
					if($res == ""){
						echo '<img src="../sources/image-profil.jpg" />';
					}
					else{
						echo $res;
					}
				echo "</td></tr></table><hr />";
				if($artist[7] != ""){
					$search = array("&rsquo;", "&oelig;");
					$find =  array("'", "oe");
					echo '<bookmark title="Biographie" level="0" ></bookmark>';
					echo "<h2>Biographie</h2>
						".str_replace($search, $find, $artist[7]);
				}
				$enreg = afficher_enregistrement($id);
			if(count($enreg) != 0){
				echo '<bookmark title="Enregistrements" level="0" ></bookmark>';
				echo "<hr /><h2>Enregistrements</h2>
				 <table style='border:solid 1px gray;width:100%;'>
					<tr>
						<td style='width:10%;'>Opus</td>
						<td style='width:40%;'>Titre</td>
						<td style='width:15%;'>".htmlentities('Date de création', ENT_QUOTES, 'UTF-8')."</td>
						<td style='width:15%;'>".htmlentities('Durée (h:m:s)', ENT_QUOTES, 'UTF-8')."</td>
						<td style='width:20%;'>Type de musique</td>
					</tr>
					<tr>";
			$i = 0;
			while($i < count($enreg)){
				$res = $enreg[$i];
				$date = Decoupedatetime($res['annee']);
				echo "<tr>
						<td style='width:10%;'>".htmlentities($res['opus'], ENT_QUOTES, 'UTF-8')."</td>
						<td style='width:40%;'><a href='http://classic-quest.olympe.in/enreg".$res['id']."'>".htmlentities($res['titre'], ENT_QUOTES, 'UTF-8')."</a></td>
						<td style='width:15%;'>".htmlentities($date, ENT_QUOTES, 'UTF-8')."</td>
						<td style='width:15%;'>".htmlentities($res['duree'], ENT_QUOTES, 'UTF-8')."</td>
						<td style='width:20%;'>".htmlentities($res['type'], ENT_QUOTES, 'UTF-8')."</td>

					</tr>";
				$i++;
			}
			echo   "</tr>
				  </table>";
			}
				// recup user
				echo '<bookmark title="Auteur" level="0" ></bookmark>';
				echo "<hr /><div style='text-align: right; color: #5544DD;'>".htmlentities("Dernière modification par $artist[8].", ENT_QUOTES, "UTF-8")."</div>";
		}
	?>
</page>
<?php
	$content = ob_get_clean();										// recupere le contenu
	//die($content);												// debug
	include('html2pdf_v3.31/html2pdf.class.php'); // chemin absolue
	try{
		$pdf = new HTML2PDF('P','A4','fr', true, 'UTF-8');			// parametre portait a4 francais
		$pdf->pdf->SetDisplayMode('fullpage');
		$pdf->writeHTML($content);									// ecrit le contenu
		if(isset($artist[2])){
			$nom = $artist[2]." - Biographie.pdf";
		}else $nom = 'Biographie.pdf';
		$pdf->Output($nom, 'D');				 					// fichier final
	}catch (HTML2PDF_exception $e){									// donne les erreurs
		die($e);
	}
?>