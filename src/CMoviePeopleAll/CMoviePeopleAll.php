<?php

	/**
	 * This is class CMoviePeopleAll
	 *
	 */
	class CMoviePeopleAll extends CDatabase {
		
		public function getAll() {
			$sql="SELECT * FROM ".ANASSA_TABLE_MOVIE_PEOPLE_ALL." ORDER BY _name ASC";
			return $this->getSQL($sql);
		}
		
		public function getIdFromName($name) {
			$sql="SELECT * FROM ".ANASSA_TABLE_MOVIE_PEOPLE_ALL." WHERE _name=?";
			$res=$this->getSQL($sql, array($name));
			if ($res) {
				return (int)$res[0]->id;
			} else {
				return 0;
			}
		}
		
		public function getNameFromId($id) {
			$sql="SELECT _name FROM ".ANASSA_TABLE_MOVIE_PEOPLE_ALL." WHERE id=?";
			return $this->getSQL($sql, array($id));
		}
		
		public function addPeople($name) {
			$sql="INSERT INTO ".ANASSA_TABLE_MOVIE_PEOPLE_ALL." (_name) VALUES (?)";
			$this->executeSQL($sql, array($name));
			return (int)$this->lastId();
		}
		
	}
	
?>