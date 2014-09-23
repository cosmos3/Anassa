<?php 
	include(__DIR__."/config.inc");
	$title=getPageTitle('home', true);
	$anassa['main']=<<<EOD
$title
<article>
	<h2>En värld - En Drottning - Ett PHP-ramverk...!</h2>
	<code>
		The feminine form of Anax is Anassa, "Queen" (ἄνασσα, ánassa; from wánassa, itself from *wánakt-ja). "Anassa - high Queens who exercise overlordship over other, presumably lesser, Queens."
	</code>
	<p>
		Så var det sagt...
	</p>
</article>
EOD;
	include(ANASSA_THEME_PATH);
?>