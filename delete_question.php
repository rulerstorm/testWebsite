<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
</head>
<body>
<?php
	require_once 'mysql.php';


	$qid = $_GET["qid"];

	con_sql("ask_question");
	$sql = "delete from answer where qid=$qid";
	$res = mysql_query($sql);


	$sql = "delete from question where qid=$qid";
	$res = mysql_query($sql);



			echo '删除成功';
			echo '<br/>';
			echo '<br/>';
			echo "<a href='./my_question.php'>返回</a>";

?>
</body>
</html>