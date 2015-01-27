<?php 
	include(__DIR__."/config.inc");
	$url=CAnassa::readSessionFromGet("url", null);
	$content=new CContent($anassa["db"]);
	$sql="SELECT * FROM ".ANASSA_TABLE_CONTENT." WHERE _type=? AND _published IS NOT NULL ORDER BY _title ASC";
	$pages=$content->getSQL($sql, array("page"));
	$frmPage="
<form action='home.php' method='GET'>
		<i>".CAnassa::getPageTitle("home", false)."</i> - välj sida:
	<select name='url' onChange='document.forms[0].submit();'>
		<option value=' '>---</option>";
	foreach ($pages as $page) {
		$frmPage.="
		<option value='".$page->_url."'".($url==$page->_url ? " selected" : "").">".$page->_title."
		</option>";
	}
	$frmPage.="
	</select>
</form>";
	$anassa["header_sub"]="
<article>
	<h3>En värld - En Drottning - Ett pyttelitet PHP-ramverk...</h3>
	<code>
		<b>The feminine form of Anax is Anassa, \"Queen\" (ἄνασσα, ánassa; from wánassa, itself from *wánakt-ja). \"Anassa - high Queens who exercise overlordship over other, presumably lesser, Queens.\"</b>
	</code>
</article><br/>".$frmPage;
	$contentPage=new CContentPage($anassa["db"]);
	if ($url) {
		$content=$contentPage->getPage($url);
	} else {
		$content=null;
	}
	if ($content) {
		$anassa["title"]=$content[0]->_title;
		$anassa["main"]=$contentPage->htmlPage($content[0]);
	} else {
		$title=CAnassa::getPageTitle("home", true);
		$anassa["main"]=$title."På denna sida kan du kika på andra sidor.";
	}
	include(ANASSA_THEME_RENDER);
?>