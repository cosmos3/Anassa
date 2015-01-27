<?php
	include(__DIR__."/config.inc");
	$url=CAnassa::readGet("url", null, "url");
	$contentPage=new CContentPage($anassa["db"]);
	$content=$contentPage->getPage($url);
	if ($content) {
		$anassa["title"]=$content[0]->_title;
		$anassa["main"]=$contentPage->htmlPage($content[0]);
	} else {
		header("location:".$url);
		exit();
	}
	include(ANASSA_THEME_RENDER);
?>