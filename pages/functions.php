<?php
	// cropper d'image uploader
	class Img{
		static function creerMin($img,$chemin,$nom,$mlargeur=100,$mhauteur=100){
			// On supprime l'extension du nom
			$nom = substr($nom,0,-4);
			// On récupère les dimensions de l'image
			$dimension=getimagesize($img);
			// On crée une image à partir du fichier récup
			if(substr(strtolower($img),-4)==".jpg"){$image = imagecreatefromjpeg($img); }
			else if(substr(strtolower($img),-4)==".png"){$image = imagecreatefrompng($img); }
			else if(substr(strtolower($img),-4)==".gif"){$image = imagecreatefromgif($img); }
			// L'image ne peut etre redimensionne
			else{return false; }
		
			// Création des miniatures
			// On cré une image vide de la largeur et hauteur voulue
			$miniature =imagecreatetruecolor ($mlargeur,$mhauteur); 
			// On va gérer la position et le redimensionnement de la grande image
			if($dimension[0]>($mlargeur/$mhauteur)*$dimension[1] ){ $dimY=$mhauteur; $dimX=$mhauteur*$dimension[0]/$dimension[1]; $decalX=-($dimX-$mlargeur)/2; $decalY=0;}
			if($dimension[0]<($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mlargeur*$dimension[1]/$dimension[0]; $decalY=-($dimY-$mhauteur)/2; $decalX=0;}
			if($dimension[0]==($mlargeur/$mhauteur)*$dimension[1]){ $dimX=$mlargeur; $dimY=$mhauteur; $decalX=0; $decalY=0;}
			// on modifie l'image crée en y plaçant la grande image redimensionné et décalée
			imagecopyresampled($miniature,$image,$decalX,$decalY,0,0,$dimX,$dimY,$dimension[0],$dimension[1]);
			// On sauvegarde le tout
			imagejpeg($miniature,$chemin."/".$nom.".jpg",90);
			return true;
		}
	}
	
	//recupere les infos de l'artist
	function recup_artist($id){
		include('bdd.php');
		$query = "SELECT * FROM artist ORDER BY id";
		$result = mysql_query($query);
		// Recuperation des resultats
		while($row = mysql_fetch_row($result)){
			if ($row[0] == htmlentities(trim($id))){
				return $row;
			}
		}
	}

	//recupere les infos de l'enregistrment
	function recup_enreg($id){
		include('bdd.php');
		$query = "SELECT * FROM enregistrement ORDER BY id";
		$result = mysql_query($query);
		// Recuperation des resultats
		while($row = mysql_fetch_row($result)){
			if ($row[0] == htmlentities(trim($id))){
				return $row;
			}
		}
	}

	//recupere les infos de l'user
	function recup_user($id){
		include('bdd.php');
		$query = "SELECT * FROM users ORDER BY id";
		$result = mysql_query($query);
		// Recuperation des resultats
		while($row = mysql_fetch_row($result)){
			if ($row[0] == htmlentities(trim($id))){
				return $row;
			}
		}
	}

	//decoupe le datetime 0000-00-00 en  00/00/0000 et le retourne
	function Decoupedatetime($datetime){
		$exploderdta = explode('-',$datetime);
    	return $exploderdta[2]."/".$exploderdta[1]."/".$exploderdta[0];
    }


    //decoupe le datetime 00/00/0000 en 0000-00-00 00:00:00 et le retourne
	function Reversedecoupedatetime($date){
		$exploderdta = explode('/',$date);
    	return $exploderdta[2]."-".$exploderdta[1]."-".$exploderdta[0];
    }

    // galery artist
	function afficher_artist($lettre,$artisttype){ 		// affiche les element de la page demander
    	include('bdd.php');
		$results = array();
		if($artisttype == ''){
			$restypeartist = '';
		}else $restypeartist = "WHERE typeartist = '$artisttype'";
		if($lettre == ''){
			$sql = mysql_query("SELECT * FROM artist ".$restypeartist." ORDER BY nomartist ASC");
		}else $sql = mysql_query("SELECT * FROM artist ".$restypeartist." AND nomartist LIKE '".$lettre."%' ORDER BY nomartist ASC");
		while($row = mysql_fetch_assoc($sql)){
			$results[] = $row; 
		}
		return $results;
	}

	// galery nouveauté
	function afficher_nouveaute(){ 		// affiche les element de la page demander
    	include('bdd.php');
		$results = array();
		$sql = mysql_query("SELECT * FROM artist order by id desc limit 0,10");
		while($row = mysql_fetch_assoc($sql)){
			$results[] = $row; 
		}
		return $results;
	}

	// afficher liste d'enregistrements
	function afficher_enregistrement($id){
		include('bdd.php');
		$result = array();
		$ssql = mysql_query("SELECT * FROM enregistrement WHERE idartist = $id ORDER BY annee ASC");
		while($srow = mysql_fetch_assoc($ssql)){
			$result[] = $srow; 
		}
		return $result;
	}

	// envoi email
	function sendmail($mail,$contenu,$sujet){
			if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)) // On filtre les serveurs qui rencontrent des bogues.
			{
				$passage_ligne = "\r\n";
			}
			else
			{
				$passage_ligne = "\n";
			}
			$message_txt = $contenu;
			$message_html = "<html><head></head><body>".$contenu."</body></html>";
			$boundary = "-----=".md5(rand());
			$header = "From: \"Musique Classique\"<haris.seldon@gmail.com>".$passage_ligne;
			$header.= "Reply-to: \"Musique classique\"<haris.seldon@gmail.com>".$passage_ligne;
			$header.= "MIME-Version: 1.0".$passage_ligne;
			$header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
			$message = $passage_ligne."--".$boundary.$passage_ligne;
			$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
			$message.= $passage_ligne.$message_txt.$passage_ligne;
			$message.= $passage_ligne."--".$boundary.$passage_ligne;
			$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
			$message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
			$message.= $passage_ligne.$message_html.$passage_ligne;
			$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
			$message.= $passage_ligne."--".$boundary."--".$passage_ligne;
			mail($mail,$sujet,$message,$header);
	}

	//moteur de recherche du site recherche
	function resultat_recherche($search,$table){
		include('bdd.php');
		$s=explode(" ",$search);
		$sql="SELECT * FROM $table";
		if($table == "artist"){ 				// artist
			$i = 0;
			foreach($s as $mot){
				if(strlen($mot)>3){
					if($i == 0){
						$sql.=" WHERE ";
					}
					else{
						$sql.= " OR ";
					}
					$sql.=" nom LIKE '%$mot%'";
				}
				$i++;
			}
			$i = 0;
			foreach($s as $mot){
				if(strlen($mot)>3){
					$sql.= " OR nomartist LIKE '%$mot%'";
				}
				$i++;
			}
			$i = 0;
			foreach($s as $mot){
				if(strlen($mot)>3){
					$sql.= " OR neea LIKE '%$mot%'";
				}
				$i++;
			}
			$i = 0;
			foreach($s as $mot){
				if(strlen($mot)>3){
					$sql.= " OR morta LIKE '%$mot%'";
				}
				$i++;
			}
		}
		if($table == "enregistrement"){ 		// enregistrement
			$i = 0;
			foreach($s as $mot){
				if(strlen($mot)>3){
					if($i == 0){
						$sql.=" WHERE ";
					}
					else{
						$sql.= " OR ";
					}
					$sql.=" titre LIKE '%$mot%'";
				}
				$i++;
			}
			$i = 0;
			foreach($s as $mot){
				if(strlen($mot)>3){
					$sql.= " OR instruments LIKE '%$mot%'";
				}
				$i++;
			}
			$i = 0;
			foreach($s as $mot){
				if(strlen($mot)>3){
					$sql.= " OR type LIKE '%$mot%'";
				}
				$i++;
			}
			$i = 0;
			foreach($s as $mot){
				if(strlen($mot)>3){
					$sql.= " OR interpretes LIKE '%$mot%'";
				}
				$i++;
			}
			$i = 0;
			foreach($s as $mot){
				if(strlen($mot)>3){
					$sql.= " OR opus LIKE '%$mot%'";
				}
				$i++;
			}
		}
		$req=mysql_query($sql) or die( mysql_error());
		echo "<h3><center>".mysql_num_rows($req)." resultat(s) pour la recherche : '".$search."'.</center></h3><br />";
		echo "<span id='search'>";
		while($d=mysql_fetch_assoc($req)){	
			if($table == "artist"){
				echo "<a href='artist{$d["id"]}'><strong>{$d["nom"]}</strong><br /></a>";
			}
			if($table == "enregistrement"){
				echo "<a href='enreg{$d["id"]}'><strong>{$d["titre"]}</strong><br /></a>";
			}
		}
		echo "</span>";
	}
?>