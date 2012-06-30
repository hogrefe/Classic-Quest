<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Classic Quest</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<link rel="icon" type="image/gif" href="sources/favicon.gif">
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
			<div id="cont-top">
				<img src="sources/classic-quest.png" alt="Classic Quest" height="250px" />
				<h2>Que recherchez vous?</h2>
				<form method="POST" action="search">
					<input type="text" name="search" size="100" />
					<input type="submit" name="submit" value="Rechercher" /><br />
					<input type="radio" name="table" value="artist" <?php if((isset($_POST['table']) && $_POST['table'] == "artist") || empty($_POST['table'])) echo 'checked="checked"'; ?> />Artistes
 					<input type="radio" name="table" value="enregistrement" <?php if(isset($_POST['table']) && $_POST['table'] == "enregistrement") echo 'checked="checked"'; ?> />Enregistrements<br />
				</form>
				<br /><hr />
			</div>
			<div id="cont-rest">
				<?php 
					if(isset($_GET['page'])){
						if(file_exists($_GET['page'])){
							include($_GET['page']);
						}
						// on decoupe l'artist de son id
						elseif(preg_match("/pages\/artist/",$_GET['page'])){
							$id =  substr($_GET["page"], 12, -4);
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
						// on decoupe l'artist de son id
						elseif(preg_match("/pages\/suppr-enreg/",$_GET['page'])){
							$id =  substr($_GET["page"], 17, -4);
							$temp = substr($_GET["page"], 6,-(strlen($id)+4));
						}
						// on decoupe la page galery de son ident
						elseif(preg_match("/pages\/galery-artist/",$_GET['page'])){
							$galid=  substr($_GET["page"], 19, -4);
							$temp = substr($_GET["page"], 6,-(strlen($galid)+4));
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
						// on decoupe l'enregistrement de son id
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
						else include('pages/galery-artist.php'); 
						// on inclus la page principale de l'application
						if(isset($temp))
							include('pages/'.$temp.'.php');
					}
					else{
						include('pages/galery-artist.php');
					} 
				?>
			</div>
		</div>
		<div id="bas">
			Classic Quest - &copy; Copyright 2012
		</div>
	</body>
	<script type="text/javascript" src="js/jquery-1.7.min.js"></script> 
	<script type="text/javascript" src="js/zoombox.js"></script>
	<script type="text/javascript"> 
	//<![CDATA[
	    $(function(){
	        $('a.zoombox').zoombox();
	    });
	//]]>
</script>
</html>