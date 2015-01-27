<?php 
	include(__DIR__."/config.inc");
	$anassa["css"][]="css/source.css";
	$download=CAnassa::readGet("download", "");
	if ($download!="") {
		CAnassa::downloadFile($download);
	}
	$source=new CSource(array(
		'secure_dir'=>"..",
		'base_dir'=>".."
		)
		);
	$anassa["header_sub"]=$source->getPathFile(CAnassa::getPageTitle("source", false));
	$anassa["main"]=$source->View();
	include(ANASSA_THEME_RENDER);
?>