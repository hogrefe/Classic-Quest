<?php
			if(isset($_POST['submit'])){
				$search = addslashes($_POST['search']); // securite pour la recherche
				$table = addslashes($_POST['table']);
				if(strlen($search) <= 3){ // s'il est vide
					$error[]= "<br /><span style='color:red;'>Veuillez saisir une recherche de plus de 3 caractères!</span>";
				}
				if(empty($error)){
					resultat_recherche($search,$table);
				}
				else{
					foreach ($error as $errors) { //errors est un tableau donc on peut avoir plusieur erreur, style profile nom...
						echo $errors.'<br />'; // ici on a qu'une erreur possible.
					}
				}
				echo "<br /><br />";
			} else{
				//redirection
			echo '<SCRIPT LANGUAGE="JavaScript">
				document.location.href="index.php"
			</SCRIPT>';
			}

?>