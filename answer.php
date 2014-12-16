<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
</head>
<body>
<?php
	require_once 'mysql.php';


	$qid = $_POST["qid"];
	$content = $_POST["content"];
	$username = $_COOKIE["username"];


	con_sql("ask_question");

	$sql = "insert into answer (qid, content, username) values (".$qid.
		',"'.$content.'","'.$username.'")';

	$res = mysql_query($sql);

	$sql = "update question set count=count+1 where qid=$qid";

	$res = mysql_query($sql);


			echo '回答成功';
			echo '<br/>';
			echo '<br/>';
			echo "<a href='question.php/?id=".$qid."'>返回</a>";

?>
</body>
</html>