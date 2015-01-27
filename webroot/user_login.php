<?php 
	include(__DIR__."/config.inc");
	$title=CAnassa::getPageTitle("#Logga in", true);
	$user=new CUser($anassa["db"]);
	if (isset($_POST["login"])) {
		if ($user->checkLogin()) {
			header("location:message.php");
			exit();
		}
	}
	$anassa["main"]=$title."
<article>".
		$user->loginForm("user_login.php")."
	<h4>Ojdå, har du glömt dina inloggningsuppgifter nu igen?!</h4>
	<p>
		Prova att logga in med <b>admin:admin</b> alternativt <b>doe:doe</b> (med begränsade rättigheter) eller skapa ett eget konto.
	</p>
</article>";
	include(ANASSA_THEME_RENDER);
?>