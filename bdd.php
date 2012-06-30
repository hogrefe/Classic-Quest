<?php
	$host = 'localhost'; //Votre host, souvent localhost
	$user = 'root'; //votre login
	$pass = ''; //Votre mot de passe
	$db = 'classique'; // Le nom de la base de donnee
	mysql_connect($host,$user,$pass) or die("Erreur de connexion a la bdd"); 	//  connexion
	mysql_select_db($db) or die('Erreur de Connexion mysql'); 			// select de la bdd
	mysql_query("SET NAMES 'utf8'"); 				// force la bdd en utf8
?>