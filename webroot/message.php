<?php
	include(__DIR__."/config.inc");
	if (!isset($_SESSION["message"])) {
		header("location:home.php");
		exit();
	}
	$title="Meddelande";
	$anassa["main"]="
<article>".
		$_SESSION["message"]."
</article>";
	unset($_SESSION["message"]);
	include(ANASSA_THEME_RENDER);
?>