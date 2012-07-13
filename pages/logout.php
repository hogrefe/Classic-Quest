<?php
	session_start();
	session_destroy();
	//redirection
	echo '<SCRIPT LANGUAGE="JavaScript">
			document.location.href="index.php"
		</SCRIPT>';
?>