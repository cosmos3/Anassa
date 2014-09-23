<?php

	class CDice {
		public $rolls=array();
		public $faces;
		
		public function __construct() {
			$this->faces=$faces;
			echo __METHOD__;
		}
		
		public function __destruct() {
			echo __METHOD__;
		}
		
		public function Roll($times) {
			$this->rolls=array();
			for ($i=0; $i<$times; $i++) {
				$this->rolls[]=rand(1, 6);
			}
		}
		
		public function GetTotal() {
			return array_sum($this->rolls);
		}
		
	}
	
	
?>