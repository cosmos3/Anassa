<?php 
	echo
	$titleOther."
<article>
	<p>
		Här blir Anassa dumpad (och SESSION):
	</p>
	<pre style='background: #F8F8F8; max-height:500px; padding:10px; border:1px solid #888; overflow:auto; margin-bottom:0;'><b>SESSION:</b><br/>".
		dump($_SESSION)."
		<br/><b>ANASSA:</b><br/>".
		dump($anassa)."
	</pre>
</article>";
?>