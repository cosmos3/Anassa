<?php
	
	/**
	 * This is class CDiceGameRecordFile
	 *
	 */	
	class CDiceGameRecordFile {
		const FILE_LENGTH=64;
		const MAX_RECORDS=100;
		const FIELD_SIGN="|";
		private $fileName="";
		private $recordList=null;
		
		public function __construct($fileName) {
			$this->fileName=$fileName;
		}
		
		public function CheckScore($data) {
			extract($data);
			$date=date("Y-m-d - H:i");
			if ($name=="") {
				//$name="*** anonym";
				$name=$_SERVER["REMOTE_ADDR"].":".$_SERVER["REMOTE_PORT"];
			}
			$arr=array($score, $roll, $name, $date);
			array_push($this->recordList, $arr);
			$this->sortRecord();
			$this->saveRecord();
		}

		private function sortRecord() {
			$arr=$this->recordList;
			$tmp=array();
			$ok=false;
			$t=0;
			while (!$ok) {
				$ok=true;
				for ($i=0; $i<count($this->recordList)-1; $i++) {
					if (($arr[$i+1][0]>$arr[$i][0]) || ($arr[$i+1][0]==$arr[$i][0] && $arr[$i+1][1]<$arr[$i][1])) {
						$ok=false;
						$tmp=$arr[$i];
						$arr[$i]=$arr[$i+1];
						$arr[$i+1]=$tmp;
						$t++;
					}
				}
			}
			$this->recordList=$arr;
		}
		
		public function LoadRecord() {
			$this->recordList=array();
			$file=fopen($this->fileName, "r");
			if ($file) {
				while (!feof($file)) {
					$line=trim(fgets($file, self::FILE_LENGTH));
					if (strlen($line)>0) {
						array_push($this->recordList, explode(self::FIELD_SIGN, $line));
					}
				}
			}
			fclose($file);
			$this->sortRecord();
			return $this->recordList;
		}
		
		private function saveRecord() {
			$length=count($this->recordList);
			if ($length>self::MAX_RECORDS) {
				$length=self::MAX_RECORDS;
			}
			$file=fopen($this->fileName, "w+");
			if ($file) {
				for ($i=0; $i<$length; $i++) {
					$str=$this->recordList[$i][0].(self::FIELD_SIGN).$this->recordList[$i][1].(self::FIELD_SIGN).$this->recordList[$i][2].(self::FIELD_SIGN).$this->recordList[$i][3];
					$line=str_pad($str, self::FILE_LENGTH).PHP_EOL;
					fwrite($file, $line);
				}
			}
			fclose($file);
		}
		
		public function NumberInList($nr) {
			if ($nr<=count($this->recordList)) {
				return $this->recordList[$nr-1][2];
			}
			return "Dummy";
		}
	}
	
?>