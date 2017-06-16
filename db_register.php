<html><head><title>

<?php
	
	function db_register($id,$username,$password){
		$query = "INSERT INTO users VALUES(" . $id . ",'" . $username . "','" . $password . "',0,NOW(),false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false,false);";
		$link = mysql_connect('localhost','root','3966mysqlpassword');
		if(!$link){
			die("connection failed");
		}
		$db_selected = mysql_select_db('cbt',$link);
		if(!$db_selected){
			die("select failed");
		}
		$result = mysql_query($query);
		if(!$result){
			registererror();
		}else{
			complete($id,$username,$password);
		}
		$close = mysql_close($link);
		if(!$close){
			die("close failed");
		}
	}
	
	function registererror(){
		echo "Failed</title></haed><body><p>Sorry, failed to register</p><a href=\"login.php\">Back to LoginPage</a></body></html>";
	}
	
	function complete($id,$username,$password){
		echo "Success!</title></head><body><p>Register Success!</p><p>ID:" . $id ."</p><p>USERNAME:" . $username . "</p><p>PASSWORD:" . $password . "</p><a href=\"login.php\">Back to LoginPage</a></body></html>";
	}

	function error(){
		echo "Failed</title></head><body><p>Sorry, you are not complete parameter</p><a href=\"login.php\">Back to LoginPage</a></body></html>";
	}
	

	if(isset($_POST['id']) && isset($_POST['username']) && isset($_POST['password'])){
		$id = $_POST['id'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		db_register($id,$username,$password);
	}else{
		error();
	}
?>
