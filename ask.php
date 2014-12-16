<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
</head>
<body>
<?php
	require_once 'mysql.php';


	$title = $_POST["title"];
	$content = $_POST["content"];
	$uid = $_COOKIE["uid"];

	$type = $_POST["q_type"];

	switch ($type) {
		case '生产':
			$q_type = 0;
			break;
		case '市场':
			$q_type = 1;
			break;		
		case '其他':
			$q_type = 2;
			break;
	}

	con_sql("ask_question");

//	$sql = "insert into question (uid, title, content, q_type) values (".$uid.
//		',"'.$title.'","'.$content.'")';

	
	$sql = "insert into question (uid, title, content, q_type) values ($uid ,
		'$title','$content','$q_type')";

	//echo $sql;

	$res = mysql_query($sql);

			echo '提问成功';
			echo '<br/>';
			echo '<br/>';
			echo "<a href='index.php'>返回</a>";

?>
</body>
</html>