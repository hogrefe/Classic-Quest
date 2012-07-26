<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<?php
		include('bdd.php');
		include('pages/functions.php');
		if(isset($_GET['page'])){
			if(preg_match("/pages\/artist/",$_GET['page'])){
				$idart =  substr($_GET["page"], 12, -4);
				$rowb = recup_artist($idart);  
				echo "<title>$rowb[2]</title>";
			}
			elseif(preg_match("/pages\/enreg/",$_GET['page'])){
				$idart =  substr($_GET["page"], 11, -4);
				$rowb = recup_enreg($idart);  
				echo "<title>$rowb[7]</title>";
			}
			elseif(preg_match("/pages\/event/",$_GET['page'])){
				$idevent =  substr($_GET["page"], 11, -4);
				$rowb = recup_event($idevent);  
				echo "<title>$rowb[1]</title>";
			}
			elseif(preg_match("/admin/",$_GET['page'])){ 
				echo "<title>Connexion & Inscription</title>";
			}
			elseif(preg_match("/param/",$_GET['page'])){ 
				echo "<title>Modifier mes paramètres</title>";
			}
			elseif(preg_match("/admin/",$_GET['page'])){ 
				echo "<title>Connexion & Inscription</title>";
			}
			elseif(preg_match("/admin/",$_GET['page'])){ 
				echo "<title>Connexion & Inscription</title>";
			}
			elseif(preg_match("/galery-artist-Compositeur/",$_GET['page'])){ 
				echo "<title>Galerie des compositeurs</title>";
			}
			elseif(preg_match("/galery-artist-Interprete/",$_GET['page'])){ 
				echo "<title>Galerie des interpretes</title>";
			}
			elseif(preg_match("/galery-event/",$_GET['page'])){ 
				echo "<title>Galerie des évènements</title>";
			}
			else{
				echo "<title>Classic Quest - Retrouvez les biographies des compositeurs et interpretes de la musique classique</title>";
			}
		}
		else{
			echo "<title>Classic Quest - Retrouvez les biographies des compositeurs et interpretes de la musique classique</title>";
		}
		?>
		<!-- Les verificaiton moteur de recherche -->
		<meta name="google-site-verification" content="OuEb2kYVV6I-j4-80whAH2DQM5mFuxZR6kbnocmCrQ0" />
		<meta name="msvalidate.01" content="734EC8B806B3910A95B2452CC192D1B9" />
		<!-- Info du site  -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="Description" content="Galerie des compositeurs et enregistrements de la musique classique, ecrit par les utilisateurs inscrit." />
		<meta name="Keywords" content="musique, classique, classic, beethoven, roques, steve, haris, seldon, jquery, php, css, js, mozart, bach, luc, sonneur, opengeek, github, gratuit, inscrit, connecter, redacteur, compositeur, enregistrement, opus, oeuvre, baroque, interprete, lieu, date, biographie, histoire, biography" />
		<meta name="Subject" content="Musique classique" />
		<meta name="Author" content="Roques Steve" />
		<meta name="Publisher" content="Roques Steve" />
		<meta name="Reply-To" content="haris.seldon@gmail.com" />
		<meta name="Robots" content="all" />
		<meta name="Rating" content="general" />
		<meta name="Distribution" content="global" />
		<!-- style -->
		<link rel="icon" type="image/gif" href="sources/favicon.gif">
		<link rel="alternate" type="application/rss+xml" href="outils/rss.php" title="Classic Quest">
		<link rel="stylesheet" type="text/css" href="css/moncss.css" />
		<link rel="stylesheet" type="text/css" href="css/zoombox.css" />
		<!-- TinyMCE -->
<script type="text/javascript" src="outils/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
		elements : "biography",
		theme : "advanced",
		skin : "o2k7",
		skin_variant : "silver",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,forecolor,backcolor,|,search,replace,|,undo,redo,|,sub,sup,charmap,advhr,|,bullist,numlist,|,outdent,indent,|,link,unlink,image,media,|,preview,print,|,fullscreen",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,tablecontrols,|,hr,removeformat,visualaid,|,insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,pagebreak",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "center",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->
	</head>
	<body>
		<?php include('pages/menu.php'); ?>
		<div id="contenu">
			<table border="0" width="100%">
			<tr><td>
				<center><table border="0" WIDTH='90%'>
					<td WIDTH='50%'><img src="sources/classic-quest.png" alt="Classic Quest" width="100%" /></td>
					<td id='subdroit'>
						<span id='subface'><a target="_blank" href="https://www.facebook.com/ClassicQuest"><img src="sources/facebook.png" alt="Notre page Facebook (officiel)" title="Notre page Facebook (officiel)" /></a></span>
									<span id='submail'><a target="_blank" href="mailto:haris.seldon@gmail.com"><img src="sources/mail.png" alt="Contactez-nous" title="Contactez-nous" /></a></span>
									<span id='subrss'><a target="_blank" href="outils/rss.php"><img src="sources/rss.png" alt="rss" title="rss" /></a></span>			
						</span>
						<br /><br /><br /><br /><h2>Que recherchez vous?</h2>
						<form method="POST" action="search">
							<input type="text" name="search" />
							<input type="submit" name="submit" value="Rechercher" /><br />
							<br /><input type="radio" name="table" value="artist" <?php if((isset($_POST['table']) && $_POST['table'] == "artist") || empty($_POST['table'])) echo 'checked="checked"'; ?> />Artistes
		 					<input type="radio" name="table" value="enregistrement" <?php if(isset($_POST['table']) && $_POST['table'] == "enregistrement") echo 'checked="checked"'; ?> />Enregistrements
		 					<input type="radio" name="table" value="evenement" <?php if(isset($_POST['table']) && $_POST['table'] == "evenement") echo 'checked="checked"'; ?> />Évènement<br />
						</form>
						<br />
					</td>
				</table></center>
				<hr />
			</td></tr>
			<tr><td>	<?php 
					if(isset($_GET['page'])){
						if(file_exists($_GET['page'])){
							include($_GET['page']);
						}
						// on decoupe l'artist de son id
						elseif(preg_match("/pages\/artist/",$_GET['page'])){
							$id =  substr($_GET["page"], 12, -4);
							$temp = substr($_GET["page"], 6,-(strlen($id)+4));
						}
						elseif(preg_match("/pages\/event/",$_GET['page'])){
							$id =  substr($_GET["page"], 11, -4);
							$temp = substr($_GET["page"], 6,-(strlen($id)+4));
						}
						// on decoupe l'artist de son id
						elseif(preg_match("/pages\/mod-artist/",$_GET['page'])){
							$id =  substr($_GET["page"], 16, -4);
							$temp = substr($_GET["page"], 6,-(strlen($id)+4));
						}
						// on decoupe l'artist de son id
						elseif(preg_match("/pages\/suppr-artist/",$_GET['page'])){
							$id =  substr($_GET["page"], 18, -4);
							$temp = substr($_GET["page"], 6,-(strlen($id)+4));
						}
						// on decoupe l'enregistrement de son id
						elseif(preg_match("/pages\/suppr-enreg/",$_GET['page'])){
							$id =  substr($_GET["page"], 17, -4);
							$temp = substr($_GET["page"], 6,-(strlen($id)+4));
						}
						// on decoupe la page galery de son ident
						elseif(preg_match("/pages\/galery-artist/",$_GET['page'])){
							$galid=  substr($_GET["page"], 19, -4);
							if(preg_match("/-Compositeur/",$galid)){
								$typeartist = "Compositeur";
								$galid =  substr($galid, 12);
							}
							elseif(preg_match("/-Interprete/",$galid)){
								$typeartist = "Interprete";
								$galid =  substr($galid, 11);
							}
							$temp = substr($_GET["page"], 6,-(strlen($galid)+strlen($typeartist)+5));
						}
						// on decoupe l'enregistrement de son id
						elseif(preg_match("/pages\/enreg/",$_GET['page'])){
							$id =  substr($_GET["page"], 11, -4);
							$temp = substr($_GET["page"], 6,-(strlen($id)+4));
						}
						// on decoupe l'enregistrement de son id
						elseif(preg_match("/pages\/mod-enreg/",$_GET['page'])){
							$id =  substr($_GET["page"], 15, -4);
							$temp = substr($_GET["page"], 6,-(strlen($id)+4));
						}
						// on decoupe l'evenement de son id
						elseif(preg_match("/pages\/mod-event/",$_GET['page'])){
							$id =  substr($_GET["page"], 15, -4);
							$temp = substr($_GET["page"], 6,-(strlen($id)+4));
						}
						// on decoupe l'evenement de son id
						elseif(preg_match("/pages\/suppr-event/",$_GET['page'])){
							$id =  substr($_GET["page"], 17, -4);
							$temp = substr($_GET["page"], 6,-(strlen($id)+4));
						}
						// on decoupe l'user de son id
						elseif(preg_match("/pages\/validation/",$_GET['page'])){
							$id =  substr($_GET["page"], 16, -4);
							if(preg_match("/ok/",$id)){
								$ok = "ok";
								$id = substr($id, 2);
							}
							if(preg_match("/non/",$id)){
								$non = "non";
								$id = substr($id, 3);
							}
							$temp = "validation";
						}
						// on decoupe l'enregistrement de son id
						elseif(preg_match("/pages\/supprimer-ban/",$_GET['page'])){
							$id =  substr($_GET["page"], 19, -4);
							if(preg_match("/s/",$id)){
								$suppr = "suppr";
								$id = substr($id, 1);
							}
							if(preg_match("/b/",$id)){
								$ban = "ban";
								$id = substr($id, 1);
							}
							$temp = "supprimer-ban";
						}
						else include('pages/accueil.php'); 
						// on inclus la page principale de l'application
						if(isset($temp))
							include('pages/'.$temp.'.php');
					}
					else{
						include('pages/accueil.php');
					} 
				?>
			</td></tr></table>
		</div>
		<div id="bas">
			Classic Quest - &copy; Copyright 2012 
			- <a href="https://www.olympe.in/" target="_blank">Hebergeur : Olympe</a>
			- <a href="https://www.facebook.com/groups/358656437504076/" target="_blank">OpenGeek</a>
			<div id='partenaires'>
				<h3>Nos partenaires :</h3>
				<a href="http://michelroques.blogspot.fr/" target="_blank">Michel Roques (Blog officiel de l'auteur.)</a>
				- <a href="http://www.lulu.com/product/couverture-souple/le-sixième-siège/11060245" target="_blank">Le Sixième siège (Achetez le livre sur lulu.com)</a>
				- <a href="http://harisseldon.blogspot.fr/" target="_blank">HariS Seldon</a>
				- <a href="http://leopol-dine.blogspot.fr/" target="_blank">Leopol-dine</a>
				- <a href="http://aary-fr.blogspot.fr/" target="_blank">AARY</a>
			</div>
		</div>
	</body>
	<script type="text/javascript" src="js/jquery-1.7.min.js"></script>
	<script type="text/javascript" src="js/jquery.animate-colors-min.js"></script>
	<script type="text/javascript" src="js/backpos.js"></script>
	<script type="text/javascript" src="js/zoombox.js"></script>
	<script type="text/javascript" src="js/monjs.js"></script>
</html>