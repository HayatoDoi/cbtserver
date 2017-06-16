<?php
	function errmsg(){
		echo "Sorry, Error! Please contact administrator";
	}

	echo "<html><head><title>Ranking Page</title></head><body>";
	echo "<p>Ranking is here<p><table>";

	$link = mysql_connect('localhost','root','3966mysqlpassword');
	if(!$link){
		die("Sorry, can't connect mysql!");
	}
	$db_selected = mysql_select_db('cbt',$link);
	if(!db_selected){
		die("Sorry,can't select DB!");
	}
	$query = "select username,score from users order by score desc,time asc;";
	$result = mysql_query($query);
	if(!$result){
		die("Sorry, can't query!");
	}
	$rank = 1;
	while($row = mysql_fetch_assoc($result)){
		echo "<tr><td>" .$rank++ ."</td><td>" .  $row['username'] . "</td><td>" . $row['score'] . "</td></tr>";
	}

	echo "</table>";
	echo "<a href=\"question.php\">Back to Questions</a>";
	echo "</body></html>";

?>
