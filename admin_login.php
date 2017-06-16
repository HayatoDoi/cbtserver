<?php
	echo "<html><head><title>Welcome to administration page!</title></head>";
	echo "<body><form action = \"control.php\" method=\"post\">";
	echo "<p>username:<input type=\"text\" name=\"username\"></p>";
	echo "<p>password:<input type=\"password\" name=\"password\"></p>";
	echo "<input type=\"submit\" value=\"login\">";
	echo "</body></html>";
?>
