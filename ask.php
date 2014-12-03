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


	con_sql("ask_question");

	$sql = "insert into question (uid, title, content) values (".$uid.
		',"'.$title.'","'.$content.'")';

	//echo $sql;

	$res = mysql_query($sql);

			echo '提问成功';
			echo '<br/>';
			echo '<br/>';
			echo "<a href='index.php'>返回</a>";

?>
</body>
</html>