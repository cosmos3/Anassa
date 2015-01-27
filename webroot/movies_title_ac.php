<?php
	include(__DIR__."/config.inc");
	$movie=new CMovie($anassa["db"]);
	$keyword=CAnassa::readPost("keyword", "", "html");
	$txtId=CAnassa::readPost("txtId", "", "html");
	$sql="SELECT _title FROM ".ANASSA_TABLE_MOVIE." WHERE _title LIKE ? ORDER BY _title ASC";
	$result=$movie->getSQL($sql, array($keyword."%"));
	$html="";
	foreach ($result as $aMovie) {
		$html.="
			<a href='#' class='auto-complete-href' onClick='txtSetValue(\"".$txtId."\", \"".$aMovie->_title."\"); hideAutoComplete(\"".$txtId."\");'>".$aMovie->_title."</a><br/>";
	}
	echo $html;
?>