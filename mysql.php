<?php 

	function con_sql($db_name){		
		$link = mysql_connect('127.0.0.1', 'root', '');
		mysql_select_db($db_name);
	}


/*
		$sql = 'select * from test_tab';

		$res = mysql_query($sql);

		$row = mysql_fetch_row($res);

		echo $row[0].$row[1];

*/




?>