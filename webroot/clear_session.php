<?php
	include(__DIR__."/config.inc");
	session_unset();
	header("location:home.php");
	exit();
?>