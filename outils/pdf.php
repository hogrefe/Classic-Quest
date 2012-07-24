<?php
	include('../bdd.php');
	include("../pages/functions.php");
	ob_start();
?>
<style type="text/css">
	table{
		width:100%;
		border:none;
		font-size:18px;
	}
	hr{
		color: #1d5f1d;
 		background-color: #1d5f1d;
 		height: 1px;
 		border: 0;
	}
	img.profil-photo{
		width:200px;
		height:200px;
		text-align: right;
	}
	.auteur{
		float:right;
		color:#555;
		font-style:italic;
	}
	span.bio{
		text-align:justify;
		overflow:none;
		word-wrap:breapxword;
	}
</style>
<page backtop="20mm" backleft="10mm" backright="10mm" backbottom="30mm" footer="page; date; heure;">
	<bookmark title="Informations" level="1"></bookmark> <!-- Ancre pdf -->
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
				$old =  substr($old, 30);
		}
		// decoupe artist id enreg, event ...
		if(preg_match("/artist/",$old)){
				$id =  substr($old, 6);
				$artist = recup_artist($id);
				$neele = Decoupedatetime($artist[3]);
				$mortle =  Decoupedatetime($artist[5]);
				echo "<span class='cent'><h1>$artist[1]</h1></span>
				<table>
				<tr><td>Nom complet de l'artiste : $artist[2]<br />
					Née le $neele à $artist[4]<br />
					Décédé(e) le $mortle à $artist[6] <br />
					L'artiste est un $artist[10]</td><td>";
					// image artist
					$array = array("jpg","png","gif","JPG","PNG","GIF");
					$i = 0;
					$res ="";
					while($i != count($array)){
						if(file_exists("../sources/images/".$id.".".$array[$i])){
							$mdcinq = md5_file("../sources/images/min/$id.jpg");
							$res = "<img src='../sources/images/min/$id.jpg' class='profil-photo' />";
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
				echo '<bookmark title="Biographie" level="0"></bookmark> <!-- Ancre pdf -->';
				echo "<h2>Biographie</h2>
					<span class='bio'>$artist[7]</span>
					<hr />";
				}
				// recup user
				echo '<bookmark title="Auteur de la fiche" level="0"></bookmark> <!-- Ancre pdf -->';
				echo "<span class='auteur'>Dernière modification par $artist[8].</span>";
		}
	?>
</page>
<?php
	$content = ob_get_clean();						// recupere le contenu
	require('html2pdf/html2pdf.class.php');
	try{
		$pdf = new HTML2PDF('p', 'A4', 'fr');		// parametre portait a4 francais
		$pdf->pdf->SetDisplayMode('fullpage');
		$pdf->writeHTML($content);					// ecrit le contenu
		if(isset($artist[2])){
			$nom = $artist[2]." - Biographie.pdf";
		}else $nom = 'Biographie.pdf';
		$pdf->Output($nom, 'D'); 					// fichier final
	}catch (HTML2PDF_exception $e){					// donne les erreurs
		die($e);
	}
?>