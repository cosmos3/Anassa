<?php 
	include(__DIR__."/config.inc");
	$title=getPageTitle('calendar', true);
	$anassa['css'][]="css/calendar.css";
	
	$calendar=new CCalendar();

	$anassa['main']=$title."
<article>".$calendar->show()."

</article>";
	include(ANASSA_THEME_PATH);
?>