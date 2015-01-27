<?php
	echo "
<article>
	".$titleKmom."
	<h4>Bilderfarenhet</h4>
	<p>
		Jag har ganska stor erfarenhet av att arbeta med och skapa bilder i olika sorters bildhanteringsprogram, så därför är de olika begreppen inte något nytt. Däremot har jag inte använt något programmeringsspråk för att hantera bilder i någon större utsträckning, om man bortser från storleksförändring av bilder. 
	</p>
	<h4>PHP GD och Img.php</h4>
	<p>
		Det känns både enkelt och bra att jobba med GD, och på php.net:s sidor finns det ett lättöverskådligt biblioteket med bra vägledning.
	</p>
	<p>
		I början var jag lite tveksam till nyttan med detta verktyg, eftersom jag föredrar att göra mina bilder, som ska visas på webben, i vanliga bildhanteringsprogram. Men jag har insett att det finns många andra områden som detta kan vara väldigt användbart, t&nbsp;ex vid visning av produktbilder på en säljsida där man på ett enkelt sätt kan välja storlek på bilderna.
	</p>
	<h4>Summering av ramverket</h4>
	<p>
		Efter varje uppgift har fördelarna med denna modulstruktur växt. Jag har tidigare tyckt att klasser i webbsammanhang har känts som en onödig omväg när man lika gärna kan använda sig av vanliga funktioner. Men när ett webbprojekt växer så blir det mycket lättare att hantera om man har byggt upp det kring klasser och moduler. Det jag kan sakna så här långt är en lite bättre katalogstruktur.
	</p>
	<h4>Övrigt</h4>
	<p>
		När jag skrev de två klasserna <code>CImage</code> och <code>CGallery</code> utelämnade jag \"verbose\"-funktionerna. Jag har även skippat de olika valideringarna för GET-variablerna, då dessa ändå hårdkodas.
	</p>
	<p>
		Däremot har jag lagt till en funktion som känner av att en bildfil <i>verkligen</i> är en bildfil, för det räcker inte att enbart titta på filändelsen (t&nbsp;ex kan en vanlig textfil vara omdöpt till \"text.png\"). Funktionen, <code>fileIsImage</code>, har jag lagt i <code>CAnassa</code>-klassen och den använder PHP-funktionerna <code>finfo_open</code> och <code>finfo_file</code> för att närmare granska en fil.
	</p>
	<p>
		Jag har även ändrat på hur GET-variablerna ska anges och hanteras så att de passar in på Anassa’s <code>readGet</code>-funktion.
	</p>
	<p>
		Jag har använt min \"sub-header\" (undermenyn) för att samla några inställningar, såsom olika filter och färgblandningar, som man kan göra i realtid.
	</p>
	<h4>Utvecklingsmiljö</h4>
	<ul>
		<li>
			Windows 7 Professional
		</li>
		<li>
			Microsoft Visual Studio 2010 Professional
		</li>
		<li>
			Notepad++ / Sublime Text
		</li>
		<li>
			Wamp 2.5
		</li>
		<li>
			FileZilla
		</li>
		<li>
			Paint Shop Pro 9.01
		</li>
	</ul>
	<p>
		<span class='font-small-italic'>".CAnassa::txtDate("2015-01-22", 0, "")."</span>
	</p>
</article>";
?>