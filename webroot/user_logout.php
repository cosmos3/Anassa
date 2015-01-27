<?php 
	include(__DIR__."/config.inc");
	$user=new CUser($anassa["db"]);
	$user->logout();
	header("location:message.php");
	exit();
?>