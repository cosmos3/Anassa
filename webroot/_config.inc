<?php
	include("_db.inc");
	$server="http://".$_SERVER["SERVER_NAME"];
	define("ANASSA_URL_ROOT", $server); // local
	//define("ANASSA_URL_ROOT", $server."/bth_oophp"); // cosmos3.se
?>