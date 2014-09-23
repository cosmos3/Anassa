<?php 
	include(__DIR__."/config.inc");
	$title=getPageTitle('dice', true);
	
	$dice=new CDice();
	$times=readGet("roll", 1);
	$dice->Roll($times);
	$rolls=$dice->rolls;
	$html="<ul>";
	foreach ($rolls as $val) {
		$html.="<li>".$val."</li>";
	}
	$html.="</ul>";


	$anassa['main']=$title."
<article>
<p>Tärningen kastas valfritt (<a href='?roll=6'>6 kast</a> <a href='?roll=12'>12 kast</a> <a href='?roll=24'>24 kast</a>) antal gånger, här är resultatet.</p>".

$html."

		
		
			

</article>";
	include(ANASSA_THEME_PATH);
?>