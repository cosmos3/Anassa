<?php

	/**
	 * This is class CContentBlog
	 *
	 */	
	class CContentBlog {
		
		public function __construct($db) {
			$this->content=new CContent($db);
			$this->user=new CUser($db);
			$this->filter=new CTextFilter();
		}

		public function getBlog($slug) {
			$sqlSlug=($slug ? "_slug=?" :"1");
			$sql="SELECT * FROM ".ANASSA_TABLE_CONTENT." WHERE _type=? AND ".$sqlSlug;
			return $this->content->getSQL($sql, array("post", $slug));
		}
		
		public function htmlBlog($content) {
			$title=CAnassa::cleanVar($content->_title, ($content->_html5 ? "" : "html"));
			$data=$this->filter->doFilter(CAnassa::cleanVar($content->_data, ($content->_html5 ? "" : "html")), $content->_filter);
			$owner=$this->user->getNameByAcronym($content->_owner_acronym);
			$html="
<article class='content'>
	<h3>".$title."</h3>".
				$data."<br/>
	<footer class='content'>
		Publicerad: ".CAnassa::txtDate($content->_published, 3, "min")."<br/>
    Uppdaterad: ".CAnassa::txtDate($content->_updated, 3, "min")."<br/>
		Ansvarig utgivare: ".$owner."
  </footer>
</article>";
			return $html;
		}
		
	}

?>