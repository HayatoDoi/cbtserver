<?php
	
	function login($username,$password){
		$link = mysql_connect('localhost','root','3966mysqlpassword');
		$db_selected = mysql_select_db('cbt', $link);
		$query = "select * from admin where username = '" . $username . "' and password = '" . $password . "';";
		$result = mysql_query($query);
		$rows = mysql_num_rows($result);
		mysql_close($link);
		if($rows == 0){
			return 0;
		}
		return 1;
	}
	
	function login_failed(){
		echo "<html><head><title>Login Failed</title></head>";
		echo "<body><a href=\"admin_login.php\">Back to Login Page</a>";
		echo "</body></html>";
	}
	function login_success($username){
		$link = mysql_connect('localhost','root','3966mysqlpassword');
		$db_selected = mysql_select_db('cbt',$link);
		$query = "select username, score from users order by score desc, time asc;";
		$result = mysql_query($query);
		echo "<html><head><title>Control Page</title></haed>";
		echo "<p>Welcome to control Page! LOGIN:" . $username . "</p>";
		echo "<a href=\"admin_logout.php\">Logout is here</a>";
		echo "<p>Ranking is here</p>";
		echo "<table>";
		while($row = mysql_fetch_assoc($result)){
			echo "<tr><td>" . $row['username'] . "</td><td>" . $row['score'] . "</td></tr>";
		}
		echo "</table><br><br>";
		$query = "select * from admin";
		$result = mysql_query($query);
		$row = mysql_fetch_assoc($result);
		if($row['isplay'] == 1){
			echo "<p>Playing Now!</p>";
		}else{
			echo "<p>Not Available</p>";
		}
		echo "<form action=\"control.php\" method=\"POST\">";
		echo "<input type=\"radio\" name=\"isplay\" value=\"1\">Game Start!";
		echo "<input type=\"radio\" name=\"isplay\" value=\"0\">Game Stop!";
		echo "<input type=\"submit\" value=\"Refresh!\">";
		echo "</body></html>";
	}
	
	function update_game($isplay){
		$status = 'true';
		if($isplay == 1){
			$status = 'true';
		}else{
			$status = 'false';
		}
		$link = mysql_connect('localhost','root','3966mysqlpassword');
		$db_selected = mysql_select_db('cbt',$link);
		$query = "update admin set isplay = " . $status . " where username = 'happynote3966';";
		$result = mysql_query($query);
		mysql_close($link);
	}
	

	//MAIN
	$username = $_POST['username'];
	$password = $_POST['password'];
	$isplay = $_POST['isplay'];
	if(isset($_COOKIE['ADMIN_CBT'])){
		if(isset($isplay)){
			update_game($isplay);
		}
		session_name("ADMIN_CBT");
		session_start("ADMIN_CBT");
		session_regenerate_id("ADMIN_CBT");
		login_success($_SESSION['username']);
	}else if(isset($username) && isset($password)){
		
		if(login($username,$password)){
			session_name("ADMIN_CBT");
			session_start("ADMIN_CBT");
			$_SESSION['username'] = $username;
			login_success($username);
		}else{
			login_failed();
		}
        }else{
		login_failed();
	}

?>
