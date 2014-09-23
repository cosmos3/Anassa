<?php
	
	class CCalendar {
		
		private $href=null;
		private $year=0;
		private $month=0;
		private $yearNow=0;
		private $monthNow=0;
		private $dayNow=0;
		
		private $monthNames=array(
			"Januari",
			"Februari",
			"Mars",
			"April",
			"Maj",
			"Juni",
			"Juli",
			"Augusti",
			"September",
			"Oktober",
			"November",
			"December"
			);
		
		public function __construct() {
			$this->href=htmlentities($_SERVER['PHP_SELF']);
			$this->yearNow=date("Y");
			$this->monthNow=date("n");
			$this->dayNow=date("d");
		}
		
		
		
		
		public function show() {

			$this->year=readGet('year', $this->yearNow);
			$this->month=readGet('month', $this->monthNow);
			if ($this->month<1) {
				$this->month=12;
				$this->year=$this->year-1;
			} elseif ($this->month>12) {
				$this->month=1;
				$this->year=$this->year+1;
			}
			

			$html="
			

				<div id='calendar'>
					<div class='head'>
						".$this->monthNames[$this->month-1]." - ".$this->year."
						<div class='prev prev-year' onclick='location.href=\"".$this->href."?year=".($this->year-1)."&amp;month=".$this->month."\"'></div>
						<div class='prev prev-month' onclick='location.href=\"".$this->href."?year=".$this->year."&amp;month=".($this->month-1)."\"'></div>
						<div class='next next-year' onclick='location.href=\"".$this->href."?year=".($this->year+1)."&amp;month=".$this->month."\"'></div>
						<div class='next next-month' onclick='location.href=\"".$this->href."?year=".$this->year."&amp;month=".($this->month+1)."\"'></div>
					</div>
					<div class='image'>
						<img src='img/calendar_img_".$this->month.".jpg' width='300' height='200' alt=''/>
					</div>
					<div class='snap'></div>
					<div class='days'>
						<table class='t-calendar'>
							<thead>
								<tr>
									<th></th>
									<th>Mån</th>
									<th>Tis</th>
									<th>Ons</th>
									<th>Tor</th>
									<th>Fre</th>
									<th>Lör</th>
									<th class='red-day'>Sön</th>
								</tr>
							</thead>
							<tbody>
		";
			
			$timestamp=mktime(0, 0, 0, $this->month , 1, $this->year);
			$maxDay=date("t", $timestamp);
			$thisMonth=getdate($timestamp);
			$startDay=$thisMonth['wday']-1;
			if ($startDay==-1) {
				$startDay=6;
			}
			for ($i=0; $i<($maxDay+$startDay); $i++) {
				$day=$i-$startDay+1;
				if (($i % 7)==0) {
					$html.="
						<tr>";
					$timestamp=mktime(0, 0, 0, $this->month, $day, $this->year);
					$week=date("W", $timestamp);
					$html.="
						<td class='week'>".$week."</td>";
				}
				if ($i<$startDay) {
					$html.="
						<td></td>";
				} else {
					$divDay="day";
					if ($this->year==$this->yearNow && $this->month==$this->monthNow && $day==$this->dayNow) {
						$divDay="selected";
					}
					$tdDay="class='day";
					if (($i % 7)==6) {
						$tdDay.=" red-day";
					}
					$html.="
						<td ".$tdDay."'><div class='".$divDay."'>".$day."</div></td>";
				}
				if (($i % 7)==6) {
					$html.="
						</tr>";
				}
				
			}
			
			$html.="
							</tbody>
						</table>
					</div>
				</div>
				";
			
			return $html;
			
		}
		
		
		
		
	}
	

?>