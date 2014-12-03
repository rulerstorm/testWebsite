<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
</head>
<body>
<?php
	require_once 'mysql.php';


	$username = $_POST["username"];
	$password = $_POST["password"];

	//echo $username.$password;

	con_sql("ask_question");

	$sql = "select * from account where username='".$username."'";

	//echo $sql;

	$res = mysql_query($sql);

	if($row = mysql_fetch_row($res)){

		//var_dump($row[0]);

		if($row[2] == $password){

			setcookie("uid", $row[0], time()+3600*24*30*12*10); 
			setcookie("username", $row[1], time()+3600*24*30*12*10); 

			echo '登陆成功';
			echo '<br/>';
			echo '<br/>';
			echo "<a href='index.php'>返回</a>";
		}else{
			echo '密码错误';
			echo '<br/>';
			echo '<br/>';
			echo "<a href='login.html'>返回</a>";
		}
	}else{
		echo '不存在该用户';
		echo '<br/>';
		echo '<br/>';
		echo "<a href='login.html'>返回</a>";
	}
	ob_end_flush();
?>
</body>
</html>