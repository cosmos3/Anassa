<?php
	include(__DIR__."/config.inc");
	$slug=CAnassa::readGet("slug", null, "html");
	$contentBlog=new CContentBlog($anassa["db"]);
	$content=$contentBlog->getBlog($slug);
	if ($content) {
		$anassa["title"]=$content[0]->_title;
		$anassa["main"]=$contentBlog->htmlBlog($content[0]);
	} else {
		header("location:".$slug);
		exit();
	}
	include(ANASSA_THEME_RENDER);
?>