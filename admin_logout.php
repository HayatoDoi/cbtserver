<?php
	session_start("ADMIN_CBT");
	$_SESSION=array();
	if(isset($_COOKIE['ADMIN_CBT'])){
		setcookie('ADMIN_CBT','',time()-42000,'/');
	}
	session_destroy("ADMIN_CBT");

	echo "<html><head><title>Logout</title></head><body><a href=\"admin_login.php\">Login is here</a></body></html>";
?>
