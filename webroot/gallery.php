<?php
	include(__DIR__."/config.inc");
	include("gallery_header.inc");
	$anassa["css"][]="css/gallery.css";
	$title=CAnassa::getPageTitle("gallery", true);
	checkPostGet();
	$gallery=new CGallery($_SESSION["gallery"]);
	$html=$gallery->htmlGallery();
	$anassa["header_sub"]=htmlHeader();
	$anassa["main"]=
		$title.$html;
	include(ANASSA_THEME_RENDER);
?>