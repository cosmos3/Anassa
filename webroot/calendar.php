<?php 
	$anassa["css"][]="css/calendar.css";
	$calendar=new CCalendar(false);
	$calendar->CalendarData->CalculateMonth();
	$calendar->CalendarVisual->InitMonth($calendar->CalendarData->GetData());
	$anassa["main"]=$title."
<article>
<div>
	<div class='calendar-right-window'>".
		$calendar->CalendarVisual->Show()."
	</div>
	<div class='calendar-left-window'>
		<p>
			Detta är en liten kalender som visar olika bilder för varje månad.
		</p>
		<p>
			De ursprungliga koderna skrev jag i Delphi/Pascal för ett antal år sedan. Då visade kalendern en ny tecknad &amp; kul bild för varje dag - för vem kan vänta en hel månad på en ny bild?
		</p>
		<p>
			Idag, om vi fortfarande är fast i samma månad, får vi lugnt och stilla invänta nästa månad för nästa bild... eller? Helt rätt, man kan använda <i>pilarna</i> längst upp i kalendern och förflytta sig till en annan tid... och titta på en annan bild.
		</p><hr/>
			Helger att fira denna månad:<br/>".
		$calendar->CalendarRedDaysInMonth->Show($calendar->CalendarData->GetData())."
	</div>
</div>
	<div class='clear'></div>
</article>";
	include(ANASSA_THEME_RENDER);
?>