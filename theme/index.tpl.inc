<?php
	echo "<!DOCTYPE html>
<html lang='".$lang."' class='no-js'>
<head>
	<meta charset='utf-8'/>
	<title>".$title_prefix.$title."</title>
	<link rel='shortcut icon' href='".$favicon."'/>";
	foreach ($css as $css_file) {
		echo "
	<link rel='stylesheet' type='text/css' href='".$css_file."'/>";
	}
	foreach ($js as $js_file) {
		echo "
	<script type='text/javascript' src='".$js_file."'></script>";
	}
	echo "
</head>
<body>";
	if ($gat_ua!="") {
		include_once("gat.inc");
	}
	echo "
	<div id='wrapper'>
		<div id='header'>".
		$header.CMenu::MainTop($menu_top).CMenu::User()."
		</div>";
	if ($header_sub!="") {
		echo "
		<div id='header-sub'>".
			$header_sub."
		</div>";
	}
	echo "
		<div id='main'>";
	if (!$main_inc) {
		echo $main;
	} else {
		include($main);
	}
	echo "
		</div>
		<div id='footer'>".
		$footer."
		</div>
	</div>
	<script type='text/javascript'>
		resizePage();
	</script>
</body>
</html>";
?>