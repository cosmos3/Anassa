<?php
	
	/**
	 * This is class CCalendar
	 *
	 */	
	class CCalendar {
		public $CalendarData=null;
		public $CalendarVisual=null;
		public $CalendarRedDaysInMonth=null;
		
		public function __construct($flexibleSize=false) {
			$this->CalendarData=new CCalendarData($flexibleSize);
			$this->CalendarVisual=new CCalendarVisual();
			$this->CalendarRedDaysInMonth=new CCalendarRedDaysInMonth();
		}
	}

	/**
	 * This is class CCalendarData
	 *
	 */	
	class CCalendarData {
		private $flexibleSize=false;
		private $yearNow=0;
		private $monthNow=0;
		private $dayNow=0;
		private $year=0;
		private $month=0;
		private $monthData=array();
		
		public function __construct($flexibleSize) {
			$this->flexibleSize=$flexibleSize;
			$this->yearNow=date("Y");
			$this->monthNow=date("n");
			$this->dayNow=date("d");
		}
		
		private function getRedDay($i, $year, $month, $day) {
			if ($month==1) {
				if ($day==1) {
					return 1;
				} elseif ($day==5 || $day==6) {
					return $day-3;
				}
			} elseif ($month==4 && $day==30) {
				return 4;
			} elseif ($month==5 && $day==1) {
				return 5;
			} elseif ($month==6) {
				if ($day==6) {
					return 6;
				} elseif ($i % 7==4 && ($day>=19 && $day<=25)) {
					return 7;
				} elseif ($i % 7==5 && ($day>=20 && $day<=26)) {
					return 8;
				}
			} elseif ($month==10) {
				if ($i % 7==4 && $day>=30) {
					return 9;
				} elseif ($i % 7==5 && $day>=31) {
					return 10;
				}
			} elseif ($month==11) {
				if ($i % 7==4 && $day<=5) {
					return 9;
				} elseif ($i % 7==5 && $day<=6) {
					return 10;
				}
			} elseif ($month==12) {
				if ($day>=24 && $day<=26) {
					return $day-13;
				} elseif ($day==31) {
					return 14;
				}
			}
			$timestamp=mktime(0, 0, 0, $month, $day, $year);
			$thisDay=date("z", $timestamp);
			$easterMonth=3;
			$easterDay=21+easter_days($year);
			if ($easterDay>31) {
				$easterDay-=31;
				$easterMonth++;
			}
			$timestamp=mktime(0, 0, 0, $easterMonth, $easterDay, $year);
			$easterDay=date("z", $timestamp);
			for ($j=0; $j<=4; $j++) {
				if ($thisDay==$easterDay-3+$j) {
					return 15+$j;
				}
			}
			if ($thisDay==$easterDay+39) {
				return 20;
			} elseif ($thisDay==$easterDay+48) {
				return 21;
			} elseif ($thisDay==$easterDay+49) {
				return 22;
			}
			if ($i % 7==6) {
				return 0;
			}
			return -1;
		}
		
		private function checkMonth($month, $changeYear) {
			if ($month<1) {
				$month=12;
				if ($changeYear) {
					$this->year=$this->year-1;
				}
			} elseif ($month>12) {
				$month=1;
				if ($changeYear) {
					$this->year=$this->year+1;
				}
			}
			return $month;
		}
		
		public function CalculateMonth() {
			$this->year=CAnassa::readGET('year', $this->yearNow);
			$this->month=CAnassa::readGET('month', $this->monthNow);
			$this->month=$this->checkMonth($this->month, true);
			$prevMonth=$this->checkMonth($this->month-1, false);
			$nextMonth=$this->checkMonth($this->month+1, false);
			$timestamp=mktime(0, 0, 0, $this->month , 1, $this->year);
			$firstDay=date("w", $timestamp)-1;
			$firstDay+=($firstDay<0 || ($firstDay==0 && !$this->flexibleSize) ? 7 : 0);
			$lastDay=date("t", $timestamp);
			$timestamp=mktime(0, 0, 0, $prevMonth, 1, $this->year);
			$prevMonthLastDay=date("t", $timestamp);
			$numberOfDays=28+($firstDay+$lastDay>28 || !$this->flexibleSize ? 7 : 0)+($firstDay+$lastDay>35 || !$this->flexibleSize ? 7 : 0);
			$this->monthData=array();
			for ($i=0; $i<$numberOfDays; $i++) {
				$arr=array(
					'week'=>0,
					'day'=>0,
					'month'=>0,
					'red-day'=>-1,
					'in-month'=>false,
					'today'=>false
					);
				if ($i<$firstDay) {
					$day=$prevMonthLastDay-$firstDay+$i+1;
					$month=$prevMonth;
				} elseif ($i<$lastDay+$firstDay) {
					$day=$i-$firstDay+1;
					$month=$this->month;
					$arr['today']=($this->year==$this->yearNow && $this->month==$this->monthNow && $day==$this->dayNow) ? true : false;
				} else {
					$day=$i-$lastDay-$firstDay+1;
					$month=$nextMonth;
				}
				if ($i % 7==0) {
					$year=$this->year-(($month==12 && $this->month==1) || ($month==1 && $this->month==12) ? 1 : 0);
					$timestamp=mktime(0, 0, 0, $month, $day, $year);
					$arr['week']=date("W", $timestamp);
				}
				$arr['day']=$day;
				$arr['month']=$month;
				$arr['red-day']=$this->getRedDay($i, $this->year, $month, $day);
				$arr['in-month']=$month==$this->month ? true : false;
				array_push($this->monthData, $arr);
			}
		}
		
		public function GetData() {
			return array(
				'year'=>$this->year,
				'month'=>$this->month,
				'monthData'=>$this->monthData
				);
		}
	}

	/**
	 * This is class CCalendarVisual
	 *
	 */		
	class CCalendarVisual {
		const LANGUAGE="swedish";//"english";
		public $CalendarMonth=null;
		public $CalendarDay=null;
		private $year=0;
		private $month=0;
		private $monthData=array();
		
		public function __construct() {
			$this->CalendarMonth=new CCalendarMonth(self::LANGUAGE);
			$this->CalendarDay=new CCalendarDay(self::LANGUAGE);
		}

		public function InitMonth($data) {
			extract($data);
			$this->year=$year;
			$this->month=$month;
			$this->monthData=$monthData;
		}
		
		private function setButton($class, $refYear, $refMonth, $title) {
			return "<a href='?year=".$refYear."&amp;month=".$refMonth."' title='".$title."'><span class='".$class."'></span></a>";
		}
		
		private function getRedDay($day) {
			if ($day>=0) {
				return " title='".$this->CalendarDay->GetRedDay($day)."'";
			}
			return "";
		}
		
		public function Show() {
			$html="
<div id='calendar'>
	<div class='head'>".
				$this->setButton("prev-month", $this->year, $this->month-1, "Föregående månad").
				$this->setButton("prev-year", $this->year-1, $this->month, "Föregående år").
				$this->CalendarMonth->GetMonth($this->month)." - ".$this->year.
				$this->setButton("next-month", $this->year, $this->month+1, "Nästa månad").
				$this->setButton("next-year", $this->year+1, $this->month, "Nästa år")."
	</div>
	<div class='image'>
		<img src='".ANASSA_URL_ROOT."/webroot/img/calendar/calendar_img_".$this->month.".jpg' width='300' height='200' alt='Månadens bild'/>
	</div>
	<div class='snap'>
	</div>
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
			<tbody>";
			$i=0;
			foreach ($this->monthData as $data) {
				$day=$data['day'];
				$month=$data['month'];
				if ($data['week']>0) {
					$html.="
				<tr>
					<td><span class='week'>".$data['week']."</span></td>";
				}
				$html.="
					<td".$this->getRedDay($data['red-day']).">
						<span class='".($data['in-month'] ? "day" : "off-month").($data['red-day']>=0 ? " red-day" : "").($data['today'] ? " today" : "")."'>".$day."
						</span>
					</td>";
				if (($i % 7)==6) {
					$html.="
				</tr>";
				}
				$i++;
			}
			$html.="
			</tbody>
		</table>
	</div>
</div>";
			return $html;
		}
	}
	
	/**
	 * This is class ACalendarMonth
	 *
	 */	
	abstract class ACalendarMonth {
		private $language;
		private $monthName=array(
			'swedish'=>array(
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
				),
			'english'=>array(
				"January",
				"February",
				"March",
				"April",
				"May",
				"June",
				"July",
				"August",
				"September",
				"October",
				"November",
				"December"
				)
			);
		
		public function __construct($language="swedish") {
			$this->language=$language;
		}
		
		public function GetMonthName($month) {
			if (array_key_exists($this->language, $this->monthName)) {
				if ($month>=1 && $month<=12) {
					return $this->monthName[$this->language][$month-1];
				}
			}
			return "";
		}
	}

	/**
	 * This is class CCalendarMonth
	 *
	 */	
	class CCalendarMonth extends ACalendarMonth {
		
		public function __construct($language) {
			parent::__construct($language);
		}
		
		public function GetMonth($month) {
			return $this->GetMonthName($month);
		}
	}
	
	/**
	 * This is class ACalendarDay
	 *
	 */	
	abstract class ACalendarDay {
		private $language;
		private $redDayName=array(
			'swedish'=>array(
				"En vanlig #%& söndag",
				"Nyårsdagen",
				"Trettondagsafton",
				"Trettondedag jul",
				"Valborgsmässoafton",
				"Första maj",
				"Nationaldagen",
				"Midsommarafton",
				"Midsommardagen",
				"Allhelgonaafton",
				"Alla helgons dag",
				"Julafton",
				"Juldagen",
				"Annandag jul",
				"Nyårsafton",
				"Skärtorsdagen",
				"Långfredagen",
				"Påskafton",
				"Påskdagen",
				"Annandag påsk",
				"Kristi himmelsfärdsdag",
				"Pingstafton",
				"Pingstdagen"
				)
			);

		public function __construct($language="swedish") {
			$this->language=$language;
		}
		
		public function GetRedDayName($day) {
			if (array_key_exists($this->language, $this->redDayName)) {
				if ($day>=0) {
					return $this->redDayName[$this->language][$day];
				}
			}
			return "";
		}
	}
	
	/**
	 * This is class CCalendarDay
	 *
	 */	
	class CCalendarDay extends ACalendarDay {

		public function __construct($language) {
			parent::__construct($language);
		}
		
		public function GetRedDay($day) {
			return $this->GetRedDayName($day);
		}
	}

	/**
	 * This is class CCalendarRedDaysInMonth
	 *
	 */
	class CCalendarRedDaysInMonth extends ACalendarDay {
		
		public function __construct() {
			parent::__construct("swedish");
		}
		
		public function Show($data) {
			extract($data);
			$html="
<ul>";		
			foreach ($monthData as $data) {
				if ($data['month']==$month) {
					$day=$data['red-day'];
					if ($day>0) {
						$redDay=$this->GetRedDayName($day);
						if ($redDay!="") {
							$html.="
	<li>
		<i>".$redDay."</i> - (".$data['day']."/".$month.")
	</li>";
						}
					}
				}
			}
			$html.="
</ul>";
			return $html;
		}
	}
	
?>