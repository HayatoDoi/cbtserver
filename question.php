<?php
	function login($id,$password){
		$query = "SELECT * from users where id = " . $id . " and password = '" . $password . "';";
		$link = mysql_connect('localhost','root','3966mysqlpassword');
		if(!$link){
			die("connect failed");
		}
		$db_selected = mysql_select_db('cbt',$link);
		if(!db_selected){
			die("select failed");
		}
		$result = mysql_query($query);
		if(!$result){
			die("query failed");
		}
		$row = mysql_num_rows($result);
		if($row != 1){
			return 0;
		}
		$close = mysql_close($link);
		if(!close){
			die("close failed");
		}
		return 1;
	}

	function login_failed(){
		echo "<html><head><title>Login Failed</title></head><body><p>Login Failed</p><a href=\"login.php\">Back to Login Page</a></body></html>";
	}

	function check_flag($flag,$id){
		$link = mysql_connect('localhost','root','3966mysqlpassword');
		$db_selected = mysql_select_db('cbt',$link);
		$query0 = "select * from admin;";
		$result0 = mysql_query($query0);
		$row0 = mysql_fetch_assoc($result0);
		$query1 = "select * from question_list where flag = '" . $flag . "';";
		$result1 = mysql_query($query1);
		$row1 = mysql_num_rows($result1);
		$score=0;
		$point=0;
		if($row0['isplay'] == false){
			mysql_close($link);
			return 4;
		}
		if($row1 != 1){
			mysql_close($link);
			return 1;
		}else{
			$row1 = mysql_fetch_assoc($result1);
			$qid = $row1['qid'];
			$point = $row1['point'];
			$query2 = "select q" . $qid . ",score  from users where id = " . $id . ";";
			$result2 = mysql_query($query2);
			$row2 = mysql_fetch_assoc($result2);
			$str = "q".$qid;
			if($row2[$str] == 1){
				mysql_close($link);
				return 2;
			}else{
				$query3 = "update users set q" . $qid . " = true where id = " . $id . ";";
				mysql_query($query3);
				if($row1['is_first'] == true){
					$query4 = "update question_list set is_first = false where qid = ". $qid . ";";
					mysql_query($query4);
					$score = $row2['score'];
					$score = $score + $point + 1;
				}else{
					$score = $row2['score'];
					$score = $score + $point;
				}
				$query5 = "update users set score = " . $score . " where id = " . $id . ";";
				mysql_query($query5);
			}
			mysql_close($link);
			return 3;
		}
	}
	function questions($id,$isaccept){
		$i = 1;
		$str;
		$link = mysql_connect('localhost','root','3966mysqlpassword');
		$db_selected = mysql_select_db('cbt',$link);
		$query0 = "select * from admin;";
		$result0 = mysql_query($query0);
		$row0 = mysql_fetch_assoc($result0);
		$query1 = "select * from users where id = " . $id . ";";
		$result1 = mysql_query($query1);
		$row1 = mysql_fetch_assoc($result1);
		$username = $row1['username'];
		$score = $row1['score'];
		$query2 = "select * from question_list;";
		$result2 = mysql_query($query2);
		echo "<html><head><title>Questions</title></head><body><p>Welcome " . $username . ". You get " . $score . " points now!</p>";
		if($isaccept == 1){
			echo "<p>Your flag is wrong!</p>";
		}else if($isaccept == 2){
			echo "<p>You are already solved!</p>";
		}else if($isaccept == 3){
			echo "<p>Congratulations! Your flag is correct!</p>";
		}else if($isaccept == 4){
			echo "<p>TIME OVER!</p>";
		}
		echo "AdminMessage:".$row0['msg'];
		echo "<p>Flag format is \"linuxctf{_string_}\"</p>";
		echo "<p>YOUR_FLAG:";
		echo "<form action=\"question.php\" method=\"POST\">";
		echo "<input type=\"text\" name=\"flag\"/>";
		echo "<input type=\"submit\" value=\"send!\"/>";
		echo "</form>";
		if($row0['isplay'] == true){
			echo "<p>!!!Question List!!!</p><table>";
			while($row = mysql_fetch_assoc($result2)){
				echo "<tr><td>";
				$str = "q" . $i++;
				if($row1[$str] == true){
					echo " ok </td>";
				}else{
					echo "</td>";
				}
				echo "<td> " . $row['point'] . " </td><td> "  . $row['question'] . "</td></tr>";
			}
			echo "</table>";
		}else{
			echo "<p>Game is not available!</p>";
		}
		echo "<a href=\"ranking.php\">Ranking is here</a>";
		echo "<br><a href=\"logout.php\">Logout is here</a>";
		echo "</body></html>";
	}

	//MAIN
	$id = $_POST['id'];
	$password = $_POST['password'];
	$flag = $_POST['flag'];
	$isaccept = 0;
	
	if(isset($_COOKIE['PHPSESSID'])){
		session_start();
		session_regenerate_id();
		if(isset($flag)){
			$isaccept = check_flag($flag,$_SESSION['id']);
		}
		questions($_SESSION['id'],$isaccept);
	}else if(isset($_POST['id']) && isset($_POST['password'])){
		$id = $_POST['id'];
		$password = $_POST['password'];
		if(login($id,$password)){
			session_start();
			$_SESSION['id'] = $id;
			questions($id,$isaccept);
		}else{
			login_failed();
		}
	}else{
		login_failed();
	}
?>
