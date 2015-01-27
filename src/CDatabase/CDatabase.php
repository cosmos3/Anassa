<?php

	/**
	 * This is class CDatabase
	 *
	 */
	class CDatabase {
		private $options;
		private $db=null;
		private $stmt=null;
		private static $numQueries=0;
		private static $queries=array();
		private static $params=array();
		
		public function __construct($options) {
			$default=array(
				'dsn'=>null,
				'username'=>null,
				'password'=>null,
				'driver_options'=>null,
				'fetch_style'=>PDO::FETCH_OBJ
				);
			$this->options=array_merge($default, $options);
			try {
				$this->db=new PDO($this->options["dsn"], $this->options["username"], $this->options["password"], $this->options["driver_options"]);
				$this->db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, $this->options["fetch_style"]);
			} catch(Exception $e) {
				throw new PDOException("Kunde inte ansluta till databasen.");
				//echo $e->getMessage();
			}
			if (isset($_SESSION["CDatabase"])) {
				self::$numQueries=$_SESSION["CDatabase"]["numQueries"];
				self::$queries=$_SESSION["CDatabase"]["queries"];
				self::$params=$_SESSION["CDatabase"]["params"];
				unset($_SESSION["CDatabase"]);
			}
		}
		
		public function getSQL($query, $params=array(), $debug=false) {
			$this->addDebug($query, $params, $debug);
			$this->stmt=$this->db->prepare($query);
			$this->stmt->execute($params);
			return $this->stmt->fetchAll();
		}
		
		public function executeSQL($query, $params=array(), $debug=false) {
			$this->addDebug($query, $params, $debug);
			$this->stmt=$this->db->prepare($query);
			return $this->stmt->execute($params);
		}
		
		public function idSQL($query, $params=array()) {
			if ($this->executeSQL($query, $params)) {			
				$res=$this->stmt->fetch(PDO::FETCH_ASSOC);
				if (array_key_exists("id", (array)$res)) {
					return (int)$res["id"];
				}
			}
			return 0;
		}
		
		private function addDebug($query, $params, $debug) {
			self::$queries[]=$query;
			self::$params[]=$params;
			self::$numQueries++;
			if ($debug) {
				echo "<p>Query = <br/><pre>".$query."</pre></p><p>Num query = ".self::$numQueries."</p><p><pre>".print_r($params, 1)."</pre></p>";
			}
		}

		public function lastId() {
			return $this->db->lastInsertId();
		}
		
		public function rowCount() {
			return (is_null($this->stmt) ? $this->stmt : $this->stmt->rowCount());
		}
		
		public function dumpDB() {
			$html="<p><i>Du har gjort ".self::$numQueries." databas-förfrågningar.</i></p><pre>";
			foreach(self::$queries as $key=>$val) {
				$params=empty(self::$params[$key]) ? null : htmlentities(print_r(self::$params[$key], 1))."<br/></br>";
				$html.=$val."<br/></br>".$params;
			}
			return $html."</pre>";
		}

		public function saveDebug($debug=null) {
			if ($debug) {
				self::$queries[]=$debug;
				self::$params[]=null;
			}
			self::$queries[]="Saved debuginformation to session.";
			self::$params[]=null;
			$_SESSION["CDatabase"]["numQueries"]=self::$numQueries;
			$_SESSION["CDatabase"]["queries"]=self::$queries;
			$_SESSION["CDatabase"]["params"]=self::$params;
		}
		
		public function restoreTable($table, $sqlFile) {
			$sql="DROP TABLE IF EXISTS ".$table;
			$ok=$this->executeSQL($sql);
			if ($ok) {
				$tmp="";
				$rows=file($sqlFile);
				$ok=(bool)$rows;
				foreach ($rows as $row) {
					if (substr($row, 0, 2)!=="--" && $row!=="") {
						$tmp.=$row;
						if (substr(trim($row), -1, 1)==";") {
							$ok=$this->executeSQL($tmp);
							$tmp="";
						}
					}
				}
			}
			return $ok;
		}
		
	}

?>