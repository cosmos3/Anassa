<?php
	include(__DIR__."/config.inc");
	$people=new CMoviePeopleAll($anassa["db"]);
	$keyword=CAnassa::readPost("keyword", "", "html");
	$txtId=CAnassa::readPost("txtId", "", "html");
	$sql="SELECT _name FROM ".ANASSA_TABLE_MOVIE_PEOPLE_ALL." WHERE _name LIKE ? ORDER BY _name ASC";
	$result=$people->getSQL($sql, array($keyword."%"));
	$html="";
	foreach ($result as $aPeople) {
		$html.="
			<a href='#' class='auto-complete-href' onClick='txtSetValue(\"".$txtId."\", \"".$aPeople->_name."\"); hideAutoComplete(\"".$txtId."\");'>".$aPeople->_name."</a><br/>";
	}
	echo $html;
?>