<?php 
	include(__DIR__."/config.inc");
	include("movies_header.inc");
	$anassa["css"][]="css/movies.css";
	$title=CAnassa::getPageTitle("movies", true);
	
	if (!$_SESSION["movies"]["action"]) {
		$id=CAnassa::readGet("edit", null, "int");
		if ($id>0) {
			$_SESSION["movies"]["action"]="edit_movie";
			$_SESSION["movies"]["movieID"]=$id;
		} else {
			$id=CAnassa::readGet("delete", null, "int");
			if ($id>0) {
				$_SESSION["movies"]["action"]="delete_movie";
				$_SESSION["movies"]["movieID"]=$id;
			} else {
				$id=CAnassa::readGet("view", null, "int");
				if ($id>0) {
					$_SESSION["movies"]["action"]="view_movie";
					$_SESSION["movies"]["movieID"]=$id;
				}
			}
		}
	}
	if ($_SESSION["movies"]["action"]=="view_movie" || (CUser::checkLevel(array("admin", "super")) && ($_SESSION["movies"]["action"]=="add_movie" || $_SESSION["movies"]["action"]=="edit_movie" || $_SESSION["movies"]["action"]=="delete_movie"))) {
		$movieManageHTML=new CMovieManageHTML($anassa["db"]);
		$html=$movieManageHTML->show($_SESSION["movies"]["action"], $_SESSION["movies"]["movieID"]);
	} else {
		$movieTable=new CMovieTable($anassa["db"]);
		$movieTable->doActions();
		$html=$movieTable->htmlTable();
	}
	$anassa["header_sub"]=htmlHeader();
	$anassa["main"]=$html;
	include(ANASSA_THEME_RENDER);
?>