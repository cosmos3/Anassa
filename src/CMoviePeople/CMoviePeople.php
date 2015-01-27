<?php

	/**
	 * This is class CMoviePeople
	 *
	 */
	class CMoviePeople extends CDatabase {
		
		public function getPeopleInMovie($id) {
			$sql="SELECT * FROM ".ANASSA_TABLE_MOVIE_PEOPLE." WHERE _movie_id=?";
			return $this->getSQL($sql, array($id));
		}

		public function getIdPeople($movieId, $nameId) {
			$sql="SELECT * FROM ".ANASSA_TABLE_MOVIE_PEOPLE." WHERE _movie_id=? AND _people_id=?";
			return $this->idSQL($sql, array($movieId, $nameId));
		}
		
		public function getIdPeopleFunction($movieId, $nameId, $function) {
			$sql="SELECT * FROM ".ANASSA_TABLE_MOVIE_PEOPLE." WHERE _movie_id=? AND _people_id=? AND _function=?";
			return $this->idSQL($sql, array($movieId, $nameId, $function));
		}

		public function addPeople($movieId, $nameId, $function) {
			$sql="INSERT INTO ".ANASSA_TABLE_MOVIE_PEOPLE." (_movie_id, _people_id, _function) VALUES (?, ?, ?)";
			$this->executeSQL($sql, array($movieId, $nameId, $function));
			return (int)$this->lastId();
		}
		
		public function updatePeople($movieId, $nameId, $function) {
			$sql="SELECT * FROM ".ANASSA_TABLE_MOVIE_PEOPLE." WHERE _movie_id=? AND _people_id=?";
			$id=$this->idSQL($sql, array($movieId, $nameId));
			$sql="UPDATE ".ANASSA_TABLE_MOVIE_PEOPLE." SET _function=? WHERE id=?";
			$this->executeSQL($sql, array($function, $id));
		}
		
		public function deletePeople($id) {
			$sql="DELETE FROM ".ANASSA_TABLE_MOVIE_PEOPLE." WHERE id=?";
			$this->executeSQL($sql, array($id));
		}
		
	}
	
?>