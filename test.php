<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
</head>
<body>

<?php

	exec("./hello 爱的我中华", $output);

	foreach ($output as $i => $j) {
		echo $i." ".$j;
		echo "</br>";
	}
	

?>



</body>
</html>