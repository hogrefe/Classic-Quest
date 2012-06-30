<?php
			if(isset($_POST['submit'])){
				$search = addslashes($_POST['search']); // securite pour la recherche
				$table = addslashes($_POST['table']);
				if(empty($search)){ // s'il est vide
					$error[]= "<span style='color:red;'>Veuillez saisir une recherche!</span>";
				}
				if(empty($error)){
					include('pages/functions.php');
					resultat_recherche($search,$table);
				}
				else{
					foreach ($error as $errors) { //errors est un tableau donc on peut avoir plusieur erreur, style profile nom...
						echo $errors.'<br />'; // ici on a qu'une erreur possible.
					}
				}
				echo "<br /><br />";
			} else header('Location:index.php');

?>