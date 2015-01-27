<?php

	/**
	 * This is class CMovie
	 *
	 */
	class CMovie extends CDatabase {
		private $query="";
		private $params=array();

		public function getMovie($id) {
			$sql="SELECT * FROM ".ANASSA_TABLE_MOVIE." WHERE id=?";
			return $this->getSQL($sql, array($id));
		}
		
		public function getRows() {
			$sql="SELECT COUNT(id) AS rows FROM ".ANASSA_TABLE_MOVIE;
			$res=$this->getSQL($sql);
			return $res[0]->rows;
		}

		private function checkQuery() {
			if ($this->query=="") {
				return " WHERE ";
			} else {
				return " AND ";
			}
		}

		public function addTitleToQuery($title="") {
			if ($title) {
				$this->query.=$this->checkQuery()."_title LIKE ?";
				$title=str_replace("*", "%", $title);
				$this->params[]=str_replace("?", "_", $title);
			}
		}
		
		public function addYearToQuery($year=array()) {
			if ($year[0] && $year[1]) {
				$this->query.=$this->checkQuery()."_year>=? AND _year<=?";
				$this->params[]=$year[0];
				$this->params[]=$year[1];
			} elseif ($year[0]) {
				$this->query.=$this->checkQuery()."_year>=?";
				$this->params[]=$year[0];
			} elseif ($year[1]) {
				$this->query.=$this->checkQuery()."_year<=?";
				$this->params[]=$year[1];
			}
		}

		public function addPeopleToQuery($name="") {
			if ($name) {
				$this->query.=$this->checkQuery().ANASSA_TABLE_MOVIE_PEOPLE_ALL." LIKE ?";
				$name=str_replace("*", "%", $name);
				$this->params[]="%".str_replace("?", "_", $name)."%";
			}
		}
		
		public function addGenreToQuery($genre="") {
			if ($genre) {
				$this->query.=$this->checkQuery()."_genre LIKE ?";
				$this->params[]="%".$genre."%";
			}
		}

		public function getQuery() {
			return $this->query;
		}
		
		public function getParams() {
			return $this->params;
		}

		public function updateMovie($sql, $params=array(), $id) {
			$sql="UPDATE ".ANASSA_TABLE_MOVIE." SET ".$sql." WHERE id=?";
			$params[]=$id;
			if ($this->executeSQL($sql, $params)) {
				$_SESSION["message"]="+Ändringar för filmen har sparats";
				return true;
			} else {
				$_SESSION["message"]="-Ändringar för filmen har inte sparats";
				return false;
			}
		}

		public function addMovie($params=array()) {
			$sql="INSERT INTO ".ANASSA_TABLE_MOVIE." (_title, _year, _genre, _content, _image, _imdb, _price) VALUES (?, ?, ?, ?, ?, ?, ?)";
			if ($this->executeSQL($sql, $params)) {
				$_SESSION["message"]="+Ny film har lagts till";
				return true;
			} else {
				$_SESSION["message"]="-Kunde inte spara filmen";
				return false;
			}
		}
		
		public function deleteMovie($id=0) {
			$sql="DELETE FROM ".ANASSA_TABLE_MOVIE." WHERE id=?";
			if ($this->executeSQL($sql, array($id))) {
				$_SESSION["message"]="+Filmen har tagits bort";
				return true;
			} else {
				$_SESSION["message"]="-Kunde inte ta bort filmen";
				return false;
			}
		}		

		public function getPeopleByFunction($id, $function) {
			$sql="SELECT * FROM ".ANASSA_TABLE_MOVIE_PEOPLE." WHERE _movie_id=? AND _function LIKE ?";
			$result=$this->getSQL($sql, array($id, "%".$function."%"));
			$html="";
			foreach ($result as $people) {
				$sql="SELECT _name FROM ".ANASSA_TABLE_MOVIE_PEOPLE_ALL." WHERE id=?";
				$tmp=$this->getSQL($sql, array($people->_people_id));
				if ($html!="") {
					$html.=", ";
				}
				$html.=$tmp[0]->_name;
			}
			return $html;
		}

		public static function getGenre() {
			return array(
				"Action",
				"Adventure",
				"Animation",
				"Comedy",
				"Crime",
				"Drama",
				"Family",
				"Fantasy",
				"Horror",
				"Mystery",
				"Sci-Fi",
				"Thriller",
				"Western"
				);
		}		
		
	}

?>