<?php 
	
	/**
	 * This is class CDiceGame
	 *
	 */	
	class CDiceGame {
		public $DiceEngine=null;
		private $diceBoard=null;
		
		public function __construct() {
			$this->DiceEngine=new CDiceEngine();
			$this->diceBoard=new CDiceBoard();
		}
		
		public function Play($recordFile) {
			$this->DiceEngine->Play($recordFile);
			return $this->diceBoard->Show($this->DiceEngine->BoardData());
		}
	}
	
	/**
	 * This is class CDiceEngine
	 *
	 */	
	class CDiceEngine {
		const DICE_FACES=6;
		private $dice=null;
		private $recordFile=null;
		private $recordList=array();
		private $currentDiceFace=6;
		private $dangerDice=1;
		private $name="";
		private $score=0;
		private $roll=0;
		private $gameOn=true;
		private $lastMessage="";
		private $releaseGame=false;

		public function __construct() {
			$this->dice=new CDice(self::DICE_FACES);
			$this->Init();
		}
		
		public function Init() {
			$this->score=0;
			$this->roll=0;
			$this->gameOn=true;
			$this->message("En ny spännande runda börjar!<br/>Klicka på tärningen ovan.");
		}    
		
		private function checkRecord($sort) {
			if ($sort) {
				$this->recordFile->CheckScore(
					array(
							'score'=>$this->score,
							'roll'=>$this->roll,
							'name'=>$this->name
							)
						);
			}
			$this->recordList=array();
			$this->recordList=$this->recordFile->LoadRecord();
		}
		
		private function check100() {
			if ($this->score>=100) {
				$this->score=100;
				$this->checkRecord(true);
				$this->message($this->txtScore("<span style='font-size:16px; font-weight:bold'>GRATTULERAR!<br/></span><br/>Du har nått ", $this->score));
				$this->gameOn=false;
			} else {
				$this->message($this->txtScore("Omgångens resultat:", $this->score));
			}
		}
		
		private function txtScore($txt, $score) {
			return $txt." <span style='font-size:16px; font-weight:bold;'>".$score." </span>poäng<br/>Antal slag: <b>".$this->roll."</b>";
		}

		private function message($message) {
			if ($message!="") {
				$this->lastMessage="<p id='dicegame-text'>".$message."</p>";
			}
			return $this->lastMessage;
		}
		
		public function ReleaseDiceGame() {
			return $this->releaseGame;
		}
		
		public function Play($recordFile) {
			$this->recordFile=$recordFile;
			$this->checkRecord(false);
			$this->releaseGame=CAnassa::readSession("dicegame-release", false, true);
			if (CAnassa::readSession("dicegame-reset", false, true)) {
				$this->Init();
			}
			$this->name=CAnassa::readSession("dicegame-name", $this->name, true);
			$rollDice=CAnassa::readSession("dicegame-roll", false, true);
			$this->dangerDice=CAnassa::readGet("danger-dice", $this->dangerDice, "int");
			if ($rollDice && $this->gameOn) {
				$this->currentDiceFace=$this->dice->RollDice();
				if ($this->currentDiceFace!=$this->dangerDice) {
					$this->score+=$this->currentDiceFace;
					$this->roll++;
					$this->check100();
				} else {
					if ($this->score>0) {
						$this->checkRecord(true);
					}
					$this->message($this->txtScore("Du stannar på: ", $this->score)."<br/><br/>Klicka på knappen <b>Ny runda</b><br/>för en ny spännande runda!");
					$this->gameOn=false;
				}
			}
		}
		
		public function BoardData() {
			$dangerDice="";
			for ($i=1; $i<=self::DICE_FACES; $i++) {
				$dangerDice.="<a href='?danger-dice=".$i."'><span class='danger-dice face-".$i.($i==$this->dangerDice ? " selected" : "")."'></span></a>";
			}
			return array(
				'dice'=>($this->gameOn ? "<a href='#' onclick='rollDice()' title='Klicka för att rulla tärningen...'>" : "").$this->dice->ShowFace($this->currentDiceFace).($this->gameOn ? "</a>" : ""),
				'message'=>$this->message(''),
				'dangerDice'=>$dangerDice,
				'name'=>$this->name,
				'recordList'=>$this->recordList
				);
		}
	}
	
	/**
	 * This is class CDice
	 *
	 */
	class CDice {
		private $faces;

		public function __construct($faces) {
			$this->faces=$faces;			
		}

		public function RollDice() {
			return rand(1, $this->faces);
		}
		
		public function ShowFace($face) {
			return "<span class='dice face-".$face."'></span>";
		}
	} 

	/**
	 * This is class CDiceBoard
	 *
	 */	
	class CDiceBoard {	
		
		public function __construct() {
		}
		
		public function Show($data) {
			extract($data);
			$html="
<div id='dicegame-board'>
	<div style='margin:0 auto; text-align:center;'>
		<form name='dicegame-form' action='diceGame_redirect.php' method='POST'>
		<div id='dice'>".$dice."
		</div>".$message."
		<div>".$dangerDice."<br/>
			Välj den siffra du <i>INTE</i> vill slå!
		</div><br/>
			Namn: <input type='text' name='dicegame-name' value='".$name."' size='24'/><br/><br/>
			<input type='submit' name='name' value='Spara namn' style='margin-right:10px;'/>
			<input type='submit' name='dicegame-reset' value='Ny runda'/><br/>
			<input type='submit' name='dicegame-release' value='Frigör mig (unset session-variabeln)' style='margin-top:20px;'/>
			<input type='hidden' id='dicegame-roll' name='dicegame-roll' value='' />
		</form>
	</div>
</div>
<div id='dicegame-table'>".$this->recordTable($recordList)."
</div>
<div class='clear'></div>";
			return $html;
		}

		private function recordTable($recordList) {
			$html="
<table class='dicegame'>
	<thead>
		<tr>
			<th class='nr'>Nr</th>
			<th class='score'>Poäng</th>
			<th class='roll'>Slag</th>
			<th class='name'>Namn</th>
			<th class='date'>Datum</th>
		</tr>
	</thead>
	<tbody>";
			for ($i=0; $i<count($recordList); $i++) {
				$html.="
		<tr>
			<td class='nr'>".($i+1)."</td>
			<td class='score' style='font-weight:bold;'>".$recordList[$i][0]."</td>
			<td class='roll'>".$recordList[$i][1]."</td>
			<td class='name'>".$recordList[$i][2]."</td>
			<td class='date'>".$recordList[$i][3]."</td>
		</tr>";
			}
			$html.="
	</tbody>
</table>";
			return $html;
		}
	}

?>