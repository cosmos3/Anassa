<?php

	/**
	 * This is class CContent
	 *
	 */	
	class CContent {
		
		public function __construct($db) {
			$this->db=new CDatabase($db);
		}
		
		public function createTable($dummies) {
			$sql="DROP TABLE IF EXISTS ".ANASSA_TABLE_CONTENT;
			$this->db->executeSQL($sql);
			$sql="CREATE TABLE ".ANASSA_TABLE_CONTENT."	(
				id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
				_title VARCHAR(80),
				_type CHAR(80),
				_url CHAR(80) UNIQUE,
				_slug CHAR(80) UNIQUE,
				_data TEXT,
				_filter CHAR(80),
				_published DATETIME,
				_created DATETIME,
				_updated DATETIME,
				_deleted DATETIME,
				_owner_acronym CHAR(20)
				) ENGINE INNODB CHARACTER SET utf8";
			$this->db->executeSQL($sql);
			if ($dummies) {
				$this->db->restoreTable(ANASSA_TABLE_CONTENT, ANASSA_TABLE_CONTENT.".sql");
			}
		}
		
		public function getSQL($sql, $params=array()) {
			return $this->db->getSQL($sql, $params);
		}
		
		public function getId($id) {
			return $this->db->getSQL("SELECT * FROM ".ANASSA_TABLE_CONTENT." WHERE id=?", array($id));
		}
		
		public function updateContent($sql, $params=array(), $id) {
			$sql="UPDATE ".ANASSA_TABLE_CONTENT." SET ".$sql.", _updated=?, _deleted=? WHERE id=?";
			$params[]=CAnassa::getNow();
			$params[]=null;
			$params[]=$id;
			if ($this->db->executeSQL($sql, $params)) {
				$_SESSION["message"]="+Ändringarna har sparats";
				return true;
			} else {
				$_SESSION["message"]="-Ändringarna har inte sparats";
				return false;
			}
		}

		public function addContent($params=array()) {
			$sql="INSERT INTO ".ANASSA_TABLE_CONTENT." (_title, _type, _url, _slug, _data, _html5, _filter, _published, _owner_acronym, _created) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
			$params[]=CAnassa::getNow();
			if ($this->db->executeSQL($sql, $params)) {
				$_SESSION["message"]="+Ny post för innehåll har sparats";
				return true;
			} else {
				$_SESSION["message"]="-Kunde inte spara innehållet";
				return false;
			}
		}
		
		public function deleteContent($id=0) {
			$tmp=$this->getId($id);
			if ($tmp) {
				if (!$tmp[0]->_deleted) {
					$sql="UPDATE ".ANASSA_TABLE_CONTENT." SET _published=?, _deleted=? WHERE id=?";
					$params=array(null, CAnassa::getNow(), $id);
					if ($this->db->executeSQL($sql, $params)) {
						$_SESSION["message"]="+Innehållet har raderats \"mjukt\"";
						return true;
					} else {
						$_SESSION["message"]="-Innehållet har inte raderats";
						return false;
					}
				} else {
					$sql="DELETE FROM ".ANASSA_TABLE_CONTENT." WHERE id=?";
					if ($this->db->executeSQL($sql, array($id))) {
						$_SESSION["message"]="+Innehållet har tagits bort";
						return true;
					} else {
						$_SESSION["message"]="-Kunde inte ta bort innehållet";
						return false;
					}
				}
			} else {
				$_SESSION["message"]="-Kunde inte hitta innehållet";
			}
		}
				
	}

?>