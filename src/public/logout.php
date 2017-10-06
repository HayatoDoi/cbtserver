<?php
	session_start();
	$_SESSION = array();
	if(isset($_COOKIE["PHPSESSID"])){
		setcookie("PHPSESSID",'',time()-42000,'/');
	}
	session_destroy();
	echo "<html><head><title>Logout</title></head><body>";
	echo "<a href=\"login.php\">Login is here</a>";
	echo "</body></html>";
?>
