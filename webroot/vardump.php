<?php 
	include(__DIR__."/config.inc");
	$title=getPageTitle('vardump', true);
	$anassa['main']=
		$title."
<article>
	<p>
		Här blir Anassa dumpad:
	</p>
	<pre style='background: #F8F8F8; max-height:600px; padding:10px; border:1px solid #888; overflow:auto;'>
		".dump($anassa)."
	</pre>
</article>";
	include(ANASSA_THEME_PATH);
?>