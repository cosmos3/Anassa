<?php

	/**
	 * This is class CMovieTable
	 *
	 */
	class CMovieTable {
		private $movie=null;
		private $pages=1;
		private $movieList=null;
		private $query="";
		private $params=array();
		
		public function __construct($db) {
			$this->movie=new CMovie($db);
		}

		private function queryDefault() {
			$sql="CREATE OR REPLACE VIEW ".ANASSA_VTABLE_MOVIE." AS SELECT m.*, GROUP_CONCAT(p._name SEPARATOR ', ') AS ".ANASSA_TABLE_MOVIE_PEOPLE_ALL." FROM ".ANASSA_TABLE_MOVIE." AS m LEFT OUTER JOIN ".ANASSA_TABLE_MOVIE_PEOPLE." AS m2a ON m.id=m2a._movie_id LEFT OUTER JOIN ".ANASSA_TABLE_MOVIE_PEOPLE_ALL." AS p ON m2a._people_id=p.id GROUP BY m.id";
			$this->movie->executeSQL($sql);
			$_SESSION["movies"]["query"]="SELECT * FROM ".ANASSA_VTABLE_MOVIE;
			$_SESSION["movies"]["params"]=array();
			$_SESSION["movies"]["quantity"]=$this->movie->getRows();
		}
		
		private function getOrder() {
			if ($_SESSION["movies"]["action"]=="show_last") {
				$_SESSION["movies"]["order_by"]="id";
				$_SESSION["movies"]["order"]="DESC";
			} else {
				$_SESSION["movies"]["order_by"]=CAnassa::readGet("orderBy", $_SESSION["movies"]["order_by"], array("_title", "_year", "_price"));
				$_SESSION["movies"]["order"]=CAnassa::readGet("order", $_SESSION["movies"]["order"], array("ASC", "DESC"));
			}
		}
		
		private function getPaging() {
			$_SESSION["movies"]["per_page"]=CAnassa::readGet("perPage", $_SESSION["movies"]["per_page"], array(5, 10, 20));
			$_SESSION["movies"]["page"]=CAnassa::readGet("page", $_SESSION["movies"]["page"]);
			$this->pages=(int)ceil($_SESSION["movies"]["quantity"]/$_SESSION["movies"]["per_page"]);
			if ($this->pages<1) {
				$this->pages=1;
			}
			if ($_SESSION["movies"]["page"]>$this->pages) {
				$_SESSION["movies"]["page"]=$this->pages;
			}
		}
		
		public function doActions() {
			// show all
			if ($_SESSION["movies"]["action"]=="show_all") {
				$this->queryDefault();
			} elseif ($_SESSION["movies"]["action"]=="search") {
				// add to query
				$this->movie->addTitleToQuery($_SESSION["movies"]["title"]);
				$this->movie->addYearToQuery(array($_SESSION["movies"]["year_1"], $_SESSION["movies"]["year_2"]));
				$this->movie->addPeopleToQuery($_SESSION["movies"]["people"]);
				$this->movie->addGenreToQuery($_SESSION["movies"]["genre"]);
				$this->query=$this->movie->getQuery();
				$this->params=$this->movie->getParams();
				if ($this->query) {
					// search
					$sql="SELECT * FROM ".ANASSA_VTABLE_MOVIE.$this->query;
					$this->movie->executeSQL($sql, $this->params);
					$rows=$this->movie->rowCount();
					if ($rows>0) {
						$_SESSION["movies"]["query"]=$sql;
						$_SESSION["movies"]["params"]=$this->params;
						$_SESSION["movies"]["quantity"]=$rows;
						$_SESSION["message"]="+Sökningen gav ".$rows." träff".($rows>1 ? "ar" : "");
						$_SESSION["movies"]["page"]=1;
					} else {
						$_SESSION["message"]="-Sökningen gav inga resultat";
					}
				} else {
					$_SESSION["message"]="-Sökfälten är tomma";
				}
			} elseif ($_SESSION["movies"]["action"]=="clear_search") {
				// clear search
				$_SESSION["movies"]["title"]=null;
				$_SESSION["movies"]["year_1"]=null;
				$_SESSION["movies"]["year_2"]=null;
				$_SESSION["movies"]["people"]=null;
				$_SESSION["movies"]["genre"]=null;
			} elseif ($_SESSION["movies"]["action"]=="restore") {
				// restore
				if ($this->movie->restoreTable(ANASSA_TABLE_MOVIE, ANASSA_TABLE_MOVIE.".sql")) {
					$this->queryDefault();
					$_SESSION["message"]="+Film-databasen är återställd";
					if (!$this->movie->restoreTable(ANASSA_TABLE_MOVIE_PEOPLE, ANASSA_TABLE_MOVIE_PEOPLE.".sql")) {
						$_SESSION["message"].=" (defekt ".ANASSA_TABLE_MOVIE_PEOPLE.")";
					}
					if (!$this->movie->restoreTable(ANASSA_TABLE_MOVIE_PEOPLE_ALL, ANASSA_TABLE_MOVIE_PEOPLE_ALL.".sql")) {
						$_SESSION["message"].=" (defekt ".ANASSA_TABLE_MOVIE_PEOPLE_ALL.")";
					}
				} else {
					$_SESSION["message"]="-Något gick fel vid återställning av film-databasen";
				}
			} elseif ($_SESSION["movies"]["action"]=="show_last") {
				// show last ix
				$this->queryDefault();
				$_SESSION["movies"]["page"]=1;
			}
			// people-content, order & paging
			$_SESSION["movies"]["view_people_content"]=CAnassa::readGet("viewPeopleContent", $_SESSION["movies"]["view_people_content"], array(0, 1));
			$sql=$_SESSION["movies"]["query"];
			$this->getOrder();
			$sql.=" ORDER BY ".$_SESSION["movies"]["order_by"]." ".$_SESSION["movies"]["order"];
			$this->getPaging();
			$sql.=" LIMIT ".$_SESSION["movies"]["per_page"]." OFFSET ".(($_SESSION["movies"]["page"]-1)*$_SESSION["movies"]["per_page"]);
			$result=$this->movieList=$this->movie->getSQL($sql, $_SESSION["movies"]["params"]);
			$_SESSION["movies"]["action"]=null;
		}
		
		private function orderBy($column) {
			return "
		<span class='movies-href'><a href='?orderBy=".$column."&amp;order=ASC' title='A-Ö / 0-10 / min-max'>▼</a><a href='?orderBy=".$column."&amp;order=DESC' title='Ö-A / 10-0 / max-min'>▲</a></span>";
		}

		private function paging($page, $sign) {
			if ($page>0 && $page<=$this->pages) {
				return "<a href='?page=".$page."' title='Sida ".$page."'><span class='t-movies-bar selectable".($sign==$_SESSION["movies"]["page"] ? " selected" : "")."'>".$sign."</span></a>";
			} else {
				return "<span class='t-movies-bar selectable' style='opacity:0.5;'>".$sign."</span>";
			}
		}
		
		private function movieListBar() {
			$first=1+($_SESSION["movies"]["page"]-1)*$_SESSION["movies"]["per_page"];
			$last=$first+$_SESSION["movies"]["per_page"]-1;
			if ($last>$_SESSION["movies"]["quantity"]) {
				$last=$_SESSION["movies"]["quantity"];
			}
			$tmp="Visa per sida:&nbsp;";
			$arr=array(5, 10, 20);
			foreach ($arr as $val) {
				$tmp.="&nbsp;<a href='?perPage=".$val."' title='Visa ".$val." filmer per sida'><span class='t-movies-bar selectable".($val==$_SESSION["movies"]["per_page"] ? " selected" : "")."'>".$val."</span></a>";
			}
			$html="
<div class='t-movies-bar'>
	<div class='t-movies-bar-right'>".
				$tmp."
	</div>
	<div class='t-movies-bar-left'>
		Antal filmer: ".$_SESSION["movies"]["quantity"]." [ ".$first."-".$last." ]
	</div>
	<div class='t-movies-bar-middle'>";
			$tmp=$this->paging($_SESSION["movies"]["page"]-1, "◄");
			for ($i=0; $i<$this->pages; $i++) {
				$page=$i+1;
				$tmp.=$this->paging($page, $page);
			}
			$tmp.=$this->paging($_SESSION["movies"]["page"]+1, "►");
			$html.=$tmp."
	</div>
</div>";
			return $html;
		}

		public function htmlTable() {
			$movieBar=$this->movieListBar();
			$html=$movieBar."
<div id='t-movies'>
	<table class='t-movies'>
		<thead>
			<tr>
				<th class='title'>Titel ".$this->orderBy("_title")."</th>
				<th class='image'>Bild</th>
				<th class='year'>År ".$this->orderBy("_year")."</th>
				<th class='people-content'>".($_SESSION["movies"]["view_people_content"]==0 ? "Medverkande [ <span class='movies-href'><a href='?viewPeopleContent=1'>Beskrivning</a></span> ]" : "Beskrivning [ <span class='movies-href'><a href='?viewPeopleContent=0'>Medverkande</a></span> ]")."</th>
				<th class='genre'>Genre</th>
				<th class='price'>Pris ".$this->orderBy("_price")."</th>
				<th class='icon'><span class='symbol edit'></span></th>
				<th class='icon'><span class='symbol delete'></span></th>
				<th>&nbsp;&nbsp;&nbsp;&nbsp;</th>
			</tr>
		</thead>
		<tbody>";
			foreach ($this->movieList as $aMovie) {
				$tmp=explode("/", $aMovie->_genre);
				$genre="";
				foreach ($tmp as $txt) {
					$genre.=$txt."<br/>";
				}
				$view="<a href='?view=".$aMovie->id."' Title=''>";
				$html.="
			<tr>
				<td class='title'>".
					$view.$aMovie->_title."</a>
				</td>
				<td class='image'>
					<div class='t-movies-image'>".
					$view."<img src='".$aMovie->_image."' width='60' height='80' alt='Filmbild'/></a>
					</div>
				</td>
				<td class='year'>".
					$aMovie->_year."
				</td>
				<td class='people-content'>
					<div style='max-height:70px; overflow:auto;'>".($_SESSION["movies"]["view_people_content"]==0 ? "Regi: ".$this->movie->getPeopleByFunction($aMovie->id, "director")."<br/>Manus: ".$this->movie->getPeopleByFunction($aMovie->id, "writer")."<br/>Aktörer: ".$this->movie->getPeopleByFunction($aMovie->id, "actor") : $aMovie->_content)."
					</div>
				</td>
				<td class='genre'>".
					$genre."
				</td>
				<td class='price'>".
					CAnassa::txtPrice($aMovie->_price, false)."
				</td>";
				if (CUser::checkLevel(array("admin", "super"))) {
					$html.="
				<td class='icon'>
					<a href='?edit=".$aMovie->id."' title='Gör ändringar av filmen: ".$aMovie->_title."'><span class='symbol edit'></span></a>
				</td>
				<td class='icon'>
					<a href='?delete=".$aMovie->id."' title='Ta bort filmen: ".$aMovie->_title."'><span class='symbol delete'></span></a>
				</td>";
				} else {
					$html.="
				<td class='icon disabled'>
					<span class='symbol edit' title='Du måste vara inloggad för att göra ändringar'></span>
				</td>
				<td class='icon disabled'>
					<span class='symbol delete' title='Du måste var inloggad för att radera filmen'></span>
				</td>";
				}
				$html.="
			</tr>";
			}
			$html.="
		</tbody>
	</table>
</div>";
			return $html;
		}

	}

?>