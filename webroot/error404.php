<?php
	header("HTTP/1.0 404 Not Found");
	include(__DIR__."/config.inc");
	$title="Error 404";
	$page=basename($_SERVER["REQUEST_URI"]);
	$anassa["main"]=<<<EOD
<article>
	<h1>$title</h1>
	<h3>Oops, sidan du söker finns inte på servern!</h3><br/>
	<p>
		Sidan <code>$page</code> finns inte på denna server.
	</p>
	<p>
		Var vänlig kontakta administratören... (ha, som om det skulle hjälpa?)
	</p>
</article>
EOD;
	include(ANASSA_THEME_RENDER);
?>