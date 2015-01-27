<?php
	include(__DIR__."/config.inc");
	$_SESSION["dicegame-release"]=CAnassa::readPost("dicegame-release", false);
	$_SESSION["dicegame-reset"]=CAnassa::readPost("dicegame-reset", false);
	$_SESSION["dicegame-name"]=str_replace("|", "", CAnassa::readPost("dicegame-name", ""));
	$_SESSION["dicegame-roll"]=CAnassa::readPost("dicegame-roll", false);
	header("location:other.php");
	exit();	
?>