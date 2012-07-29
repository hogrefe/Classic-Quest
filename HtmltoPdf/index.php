<?php
	ob_start();
?>
<style type="text/css">
</style>
<page backtop="20mm" backleft="10mm" backright="10mm" backbottom="30mm" footer="page; date; heure;">
	<bookmark title="Informations" level="1"></bookmark> <!-- Ancre pdf -->
	Classic Quest - http://classic-quest.olympe.in/<br />

<hr />BeethovenNom complet de l'artiste : Ludwig van Beethoven
 Née le 07/12/1770 à Bonn
 Décédé(e) le 26/03/1827 à Vienne 
 L'artiste est un Compositeur	

Biographie

Ludwig van Beethoven est un compositeur allemand né à Bonn le 16 ou le 17 décembre 1770 et mort à Vienne le 26 mars 1827. Dernier grand représentant du classicisme viennois (après Gluck, Haydn et Mozart), Beethoven a préparé l’évolution vers le romantisme en musique et influencé la musique occidentale pendant une grande partie du XIXe siècle. Inclassable (« Vous me faites l’impression d’un homme qui a plusieurs têtes, plusieurs cœurs, plusieurs âmes » lui dit Haydn vers 1793), son art s’est exprimé à travers différents genres musicaux, et bien que sa musique symphonique soit la principale source de sa popularité, il a eu un impact également considérable dans l’écriture pianistique et dans la musique de chambre.

Surmontant à force de volonté les épreuves d’une vie marquée par la surdité qui le frappe à 28 ans, célébrant dans sa musique le triomphe de l’héroïsme et de la joie quand le destin lui prescrivait l’isolement et la misère, il est récompensé par cette affirmation de Romain Rolland : « Il est bien davantage que le premier des musiciens. Il est la force la plus héroïque de l’art moderne ». Expression d’une inaltérable foi en l’homme et d’un optimisme volontaire, affirmant la création musicale comme action d’un artiste libre et indépendant, l’œuvre de Beethoven a fait de lui une des figures les plus marquantes de l’histoire de la musique.
Dernière modification par Roques Steve.
EnregistrementsOpus	Titre	Date de création	Durée (h:m:s)	Type de musique	Instruments	Interpretes

21	Symphonie no 1 en ut majeur	02/04/1800	00:27:00	Symphonie		
36	Symphonie no 2 en ré majeur	05/04/1803	00:30:00	Symphonie
<hr />
</page>
<?php
	$content = ob_get_clean();						// recupere le contenu
	require('html2pdf/html2pdf.class.php');
	try{
		$pdf = new HTML2PDF('p', 'A4', 'fr');		// parametre portait a4 francais
		$pdf->pdf->SetDisplayMode('fullpage');
		$pdf->writeHTML($content);					// ecrit le contenu
		$pdf->Output('test.pdf', 'D'); 					// fichier final
	}catch (HTML2PDF_exception $e){					// donne les erreurs
		die($e);
	}
?>