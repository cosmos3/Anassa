<?php
	
	/**
	 * This is class CContentManage
	 *
	 */	
	class CContentManage {

		public function __construct($db) {
			$this->content=new CContent($db);
			$this->user=new CUser($db);
		}

		private function getUrlToContent($content) {
			switch($content->_type) {
				case "page": {
					return "content_page.php?url=".$content->_url;
					break;
				}
				case "post": {
					return "content_blog.php?slug=".$content->_slug;
					break;
				}
				default: {
					return null;
					break;
				}
			}
		}
		
		public function htmlTable($admin) {
			$contents=$this->content->getSQL("SELECT * FROM ".ANASSA_TABLE_CONTENT);
			$html="
<div id='t-content'>
	<table class='t-content'>
		<thead>
			<tr>
				<th class='type'>Typ</th>
				<th class='title'>Titel</th>
				<th class='date'>Publicerad</th>
				<th class='date'>Uppdaterad</th>
				<th class='date'>Raderad</th>
				<th class='owner'>Ägare/ansvarig</th>
				<th class='icon'><span class='symbol edit'></span></th>
				<th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
			</tr>
		</thead>
		<tbody>";
			foreach ($contents as $content) {
				$owner=$this->user->getNameByAcronym($content->_owner_acronym);
				$html.="
			<tr>
				<td class='type'>".
					$content->_type."
				</td>
				<td class='title'>
					<a href='".$this->getUrlToContent($content)."' title='Titta på: ".$content->_title."\nUrl: ".$content->_url."\nSlug: ".$content->_slug."'>".$content->_title."</a>
				</td>
				<td class='date'>".
					($content->_published ? $content->_published : "---")."
				</td>
				<td class='date'>".
					$content->_updated."
				</td>
				<td class='date'>".
					$content->_deleted."
				</td>
				<td class='owner'>".
					$owner."
				</td>";
				if ($admin || CUser::checkUser($content->_owner_acronym)) {
					$html.="
				<td class='icon'>
					<a href='content_manage.php?action=edit&amp;id=".$content->id."' title='Gör ändringar'><span class='symbol edit'></span></a>
				</td>";
				} else {
					$html.="
				<td class='icon disabled'>
					<span class='symbol edit' title='Du måste vara inloggad för att göra ändringar'></span>
				</td>";
				}
				$html.="
			</tr>";
			}
			$html.="
		</tbody>
	</table>
</div>
<div class='clear'></div><br/>
<input type='button' value='Skapa ny sida eller blogg' onClick='location.href=\"content_manage.php?action=new\"'/>";
			if ($admin) {
				$file=ANASSA_TABLE_CONTENT.".sql";
				$fileDate="Okänt";
				if (is_file(ANASSA_INSTALL_PATH."/webroot/".$file)) {
					$fileDate=date("Y-m-d - H:i:s", filemtime(ANASSA_INSTALL_PATH."/webroot/".$file));
				}
				$html.="
<input type='submit' value='Återställ databasen' onClick='location.href=\"content_manage.php?action=restore\"'/>&nbsp;<span class='font-small-italic'>Återställs med filen: <b>".$file."</b> (senast ändrad: ".$fileDate.")</span>";
			}
			return $html;		
		}

		private function slugify($str) {
			$str=mb_strtolower(trim($str), "UTF-8");
			$str=str_replace(array("å", "ä", "ö"), array("a", "a", "o"), $str);
			$str=preg_replace("/[^a-z0-9-]/", "-", $str);
			$str=trim(preg_replace("/-+/", "-", $str), "-");
			return $str;
		}
		
		public function checkPostAction() {
			if (CAnassa::readPost("cancel", null)) {
				return true;
			} else {
				$id=CAnassa::readPost("id", null, "int");
				if (CAnassa::readPost("delete", null)) {
					$this->content->deleteContent($id);
					return true;
				} elseif (CAnassa::readPost("save", null)) {
					$title=CAnassa::readPost("title", null);
					$type=CAnassa::readPost("type", null, array("page", "post"));
					$url=CAnassa::readPost("url", null, "url");
					$slug=CAnassa::readPost("slug", null);
					if ((!isset($slug) && $type=="post") || CAnassa::readPost("auto-slug", null)) {
						$slug=$this->slugify($title);
					}
					$data=CAnassa::readPost("data", null);
					$html5=(CAnassa::readPost("html5", false)=="on");
					$filter=CAnassa::readPost("filter", null, "string");
					$published=CAnassa::readPost("published", null);
					if (CAnassa::readPost("auto-date", null)) {
						$published=CAnassa::getNow();
					}
					$owner=CAnassa::readPost("owner", null, "string");
					$params=array($title, $type, $url, $slug, $data, $html5, $filter, $published, $owner);
					if ($id>0) {
						$this->content->updateContent("_title=?, _type=?, _url=?, _slug=?, _data=?, _html5=?, _filter=?, _published=?, _owner_acronym=?", $params, $id);
					} else {
						$this->content->addContent($params);
					}
					return true;
				}
			}
			return false;
		}

		public function htmlForm($action) {
			$id=($action=="edit" ? CAnassa::readGet("id", null, "int") : 0);
			if ($action=="new" || ($action=="edit" && $id>0)) {
				if ($id>0) {
					$sql="SELECT * FROM ".ANASSA_TABLE_CONTENT." WHERE id=?";
					$row=$this->content->getSQL($sql, array($id));
					$title=$row[0]->_title;
					$type=$row[0]->_type;
					$url=$row[0]->_url;
					$slug=$row[0]->_slug;
					$data=$row[0]->_data;
					$html5=$row[0]->_html5;
					$filter=$row[0]->_filter;
					$published=$row[0]->_published;
					$deleted=$row[0]->_deleted;
					$owner=$row[0]->_owner_acronym;
				} else {
					$title="";
					$type="post";
					$url="";
					$slug="";
					$data="";
					$html5=false;
					$filter="";
					$published=null;
					$deleted=null;
					$owner=$_SESSION["user"]->_acronym;
				}
				$txtTitle=($id>0 ? "Ändra och uppdatera innehåll" : "Nytt innehåll");
				$btnDelete=($id>0 ? "<input type='submit' name='delete' value='Radera'/>" : "");
				$html="
<h3>".$txtTitle."</h3>
<form method='POST'>
	<p>
		<label>
			Titel:<br/>
			<input class='label-above content-manage' type='text' name='title' value='".$title."'/>
		</label>
	</p>
  <p>
		<label>
			Typ: <span style='font-size:small;'>(".CAnassa::addTextToId("page", "type", "")."/".CAnassa::addTextToId("post", "type", "").")</span><br/>
      <input class='label-above content-manage' type='text' id='type' name='type' value='".$type."'/>
		</label>
	</p>
	<p>
		<label>
			Url:<br/>
			<input class='label-above content-manage' type='text' name='url' value='".$url."'/>
		</label>
	</p>
  <p>
		<input type='checkbox' name='auto-slug'".($slug ? "" : " checked")."/>
		<label>
			(auto) Slug:<br/>
      <input class='label-above content-manage' type='text' name='slug' value='".$slug."'/>
		</label>
	</p>
	<p>
		<label>
			Text:<br/>
			<textarea class='label-above content-manage' name='data'>".$data."</textarea>
		</label>
	</p>
	<p>";
				if (CUser::checkLevel(array("admin", "super"))) {
					$html.="
		<input type='checkbox' id='html5' name='html5'".($html5 ? " checked" : "")."/><label for='html5'>Tillåt HTML5</label>";
				} else {
					$html.="
		<input type='checkbox' id='html5'".($html5 ? " checked" : "")." disabled/><label for='html5'>Tillåt HTML5</label>
		<input type='hidden' name='html5' value='".($html5 ? "on" : "")."'/>";
				}
				$html.="
	</p>
  <p>
		<label>
			Textfilter: <span style='font-size:small;'>(".CAnassa::addTextToId("bbcode", "filter", ",").", ".CAnassa::addTextToId("link", "filter", ",").", ".CAnassa::addTextToId("markdown", "filter", ",").", ".CAnassa::addTextToId("nl2br", "filter", ",").")</span><br/>
      <input class='label-above content-manage' type='text' id='filter' name='filter' value='".$filter."'/>
		</label>
	</p>
  <p>
		<input type='checkbox' name='auto-date'/>
		<label>
			(auto) Publiceringsdatum: ".($deleted ? "<span class='font-small-italic'>(Raderad: ".$deleted.")" : "")."<br/>
      <input class='label-above content-manage' type='text' name='published' value='".$published."'/>
		</label>
	</p>
	<p>
		<label>
			Ägare/Ansvarig (användarnamn):<br/>";
			if (CUser::checkLevel(array("admin", "user"))) {
				$html.="
			<input class='label-above content-manage' type='text' name='owner' value='".$owner."'/>";
			} else {
				$html.="
			<input class='label-above content-manage' type='text' value='".$owner."' disabled/>
			<input type='hidden' name='owner' value='".$owner."'/>";
			}
			$html.="
		</label>
	</p>
  <p>
		<input type='submit' name='save' value='Spara'/>".
					$btnDelete."
		<input type='submit' name='cancel' value='Avbryt'/>
		<input type='hidden' name='id' value='".$id."'/>
	</p>
</form>";
			}
			return $html;
		} 

	}

?>