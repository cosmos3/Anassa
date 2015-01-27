<?php 
	include(__DIR__."/config.inc");
	$slug=CAnassa::readSessionFromGet("slug", null);
	$content=new CContent($anassa["db"]);
	$user=new CUser($anassa["db"]);
	$sql="SELECT * FROM ".ANASSA_TABLE_CONTENT." WHERE _type=? AND _published<=? ORDER BY _published DESC";
	$blogs=$content->getSQL($sql, array("post", CAnassa::getNow()));
	$frmBlog="
<form action='blogs.php' method='GET'>".
		CAnassa::getPageTitle("blogs", false)." - välj blogg:
	<select name='slug' onChange='document.forms[0].submit();'>
		<option value=' '>---</option>";
	foreach ($blogs as $blog) {
		$name=$user->getNameByAcronym($blog->_owner_acronym);
		$frmBlog.="
		<option value='".$blog->_slug."'".($slug==$blog->_slug ? " selected" : "").">".$blog->_title." --- av ".$name.", ".substr($blog->_published, 0, 10)."
		</option>";
	}
	$frmBlog.="
	</select>
</form>";
	$anassa["header_sub"]=$frmBlog;
	$contentBlog=new CContentBlog($anassa["db"]);
	if ($slug) {
		$content=$contentBlog->getBlog($slug);
	} else {
		$content=null;
	}
	if ($content) {
		$anassa["title"]=$content[0]->_title;
		$anassa["main"]=$contentBlog->htmlBlog($content[0]);
	} else {
		$title=CAnassa::getPageTitle("blogs", true);
		$anassa["main"]=$title."På denna sida kan du läsa de olika bloggarna.";
	}
	include(ANASSA_THEME_RENDER);
?>