<?php

	/**
	 * This is class CMovieManage
	 *
	 */
	class CMovieManage {
		private $movie=null;
		private $moviePeople=null;
		private $moviePeopleAll=null;
		private $people=array();
		private $peopleNr=0;
		
		public function __construct($db) {
			$this->movie=new CMovie($db);
			$this->moviePeople=new CMoviePeople($db);
			$this->moviePeopleAll=new CMoviePeopleAll($db);
		}

		public function updateMovie($sql, $params=array(), $movieId, $tmpPeople) {
			if ($this->movie->updateMovie($sql, $params, $movieId)) {
				$this->managePeopleFunction($movieId, $tmpPeople);
			}
		}

		public function addMovie($params=array(), $tmpPeople) {
			if ($this->movie->addMovie($params)) {
				$this->managePeopleFunction($this->movie->lastId(), $tmpPeople);
				return true;
			}
			return false;
		}
		
		public function deleteMovie($movieId) {
			if ($this->movie->deleteMovie($movieId)) {
				$this->managePeopleFunction($movieId, "");
				return true;
			}
			return false;
		}

		private function hiddenPeople($tmp="") {
			if ($tmp) {
				$tmpPeople=explode(ANASSA_DELIMITER, $tmp);
				$this->peopleNr=count($tmpPeople);
				$i=0;
				while ($i<$this->peopleNr) {
					$name=$tmpPeople[$i];
					$function="";
					if ($i+1<$this->peopleNr) {
						$function=$tmpPeople[$i+1];
					}
					$nameId=$this->moviePeopleAll->getIdFromName($name);
					$action="";
					$id=$this->moviePeople->getIdPeopleFunction($this->movieId, $nameId, $function);
					if ($id==0) {
						$id=$this->moviePeople->getIdPeople($this->movieId, $nameId);
						if ($id>0) {
							$action="update";
						} else {
							$action="add";
						}
					}
					$this->people[]=array("id"=>$id, "nameId"=>$nameId, "name"=>$name, "function"=>$function, "action"=>$action);
					$i+=2;
				}
				$this->peopleNr/=2;
			}
			return ($this->peopleNr>0);
		}
		
		private function managePeopleFunction($movieId, $tmpPeople="") {
			$this->movieId=$movieId;
			if ($this->hiddenPeople($tmpPeople)) {
				$peopleInMovie=$this->moviePeople->getPeopleInMovie($this->movieId);
				for ($i=0; $i<$this->peopleNr; $i++) {
					if ($this->people[$i]["action"]!="") {
						if ($this->people[$i]["nameId"]==0) {
							$this->people[$i]["nameId"]=$this->moviePeopleAll->addPeople($this->people[$i]["name"]);
						}
						if ($this->people[$i]["action"]=="add") {
							$this->people[$i]["id"]=$this->moviePeople->addPeople($this->movieId, $this->people[$i]["nameId"], $this->people[$i]["function"]);
						} elseif ($this->people[$i]["action"]=="update") {
							$this->moviePeople->updatePeople($this->movieId, $this->people[$i]["nameId"], $this->people[$i]["function"]);
						}
					}
				}
			}
			$peopleInMovie=$this->moviePeople->getPeopleInMovie($movieId);
			$deleteIx=array();
			foreach ($peopleInMovie as $aPeople) {
				$ok=false;
				for ($i=0; $i<$this->peopleNr; $i++) {
					if ($this->people[$i]["id"]==$aPeople->id) {
						$ok=true;
					}
				}
				if (!$ok) {
					$deleteIx[]=$aPeople->id;
				}
			}
			for ($i=0; $i<count($deleteIx); $i++) {					
				$this->moviePeople->deletePeople($deleteIx[$i]);
			}
		}

	}

?>