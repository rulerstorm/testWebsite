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
	$aid = $_POST["aid"];

	$sql1 = "update answer set best=1 where aid=$aid";

	$sql2 = "update question set best=1 where qid=$qid";


	con_sql("ask_question");

	$res1 = mysql_query($sql1);
	$res2 = mysql_query($sql2);

			echo '已采纳该答案';
			echo '<br/>';
			echo '<br/>';
			echo "<a href='question.php/?id=".$qid."'>返回</a>";




?>
</body>
</html>