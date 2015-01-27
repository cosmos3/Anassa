<?php 
	include(__DIR__."/config.inc");
	$anassa["css"][]="css/content.css";
	$title=CAnassa::getPageTitle("content", true);
	$contentManage=new CContentManage($anassa["db"]);
	//$contentManage->content->createTable(true);
	$html=$contentManage->htmlTable(CUser::checkLevel(array("admin", "super")));
	if (isset($_SESSION["message"])) {
		$message=CAnassa::txtMessage($_SESSION["message"])."<br/><br/>";
		unset($_SESSION["message"]);
	} else {
		$message="";
	}
	$anassa["main"]=
	$title.$message.$html;
	include(ANASSA_THEME_RENDER);
?>