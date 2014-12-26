<?php
if($_POST["username"]){
	header("location:index.php");
}else{
	header("location:go_back.php");
}