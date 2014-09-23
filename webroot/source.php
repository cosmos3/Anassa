<?php 
	include(__DIR__."/config.inc");
	/*
	$path=readPost('path', "");
	if ($path!="") {
		header("Location:source.php?path=".$path);
		exit();
	}
	*/
	$download=readGet('download', "");
	if ($download!="") {
		downloadFile($download);
	}
	$anassa['css'][]="css/source.css";
	$source=new CSource(array('secure_dir'=>"..", 'base_dir'=>".."));
	$anassa['header_sub']=getPageTitle('source', true).$source->getPathFile();
	$anassa['main']=$source->View();
	include(ANASSA_THEME_PATH);
?>