<?php
 	include(__DIR__."/config.inc");
 	$anassa["css"][]="css/content.css";
	$title="Innehåll";
	if (CUser::checkLevel(array("normal", "admin", "super"))) {
 		$contentManage=new CContentManage($anassa["db"]);
 		if (!$contentManage->checkPostAction()) {
 			$action=CAnassa::readGet("action", null);
			if ($action=="restore" && CUser::checkLevel(array("admin", "super"))) {
 				$contentManage->content->createTable(true);
 				$_SESSION["message"]="+Databasen är återställd";
 				header("location:content.php");
 				exit();
 			} else {
 				$html=$contentManage->htmlForm($action);
 			}
 		} else {
 			header("location:content.php");
 			exit();
 		}
 	} else {
		$html="<h3>".$title."</h3>".CAnassa::txtMessage("-Du har ingen behörighet att göra ändringar");
 	}
 	$anassa["main"]=$html;
 	include(ANASSA_THEME_RENDER);
?>