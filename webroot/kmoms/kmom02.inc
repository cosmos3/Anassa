<?php
	echo "
<article>
	".$titleKmom."
	<h4>Objektorienterade koncept</h4>
	<p>
		Jag är sedan 80-talet en självlärd programmerare och får väl säga att jag numera är ganska välbekant och förtrogen med OO-konceptet, även om det är skillnad mellan olika programmeringsspråk där en viss begreppsförvirring kan förekomma. De sista åren har jag läst kurser i Java, C++, C# och Actionscript.
	</p>
	<h4>oophp20-guiden</h4>
	<p>
		Guiden skummade jag bara lättsamt igenom – återvände dock ett par gånger för att kolla upp vissa saker.
	</p>
	<h4>Kalendern</h4>
	<p>
		Jag återanvände (\"översatte\") ett gammat Delphi/Pascal-projekt och började med att dela upp programmet i två klasser:
	</p>
	<ul>
		<li>
			<code>CCalendarData</code>, som  beräknar data för månaden
		</li>
		<li>
			<code>CCalendarVisual</code>, som hanterar det visuella
		</li>
	</ul>
	<p>
		<code>CCalenderVisual</code> hämtar informationen från <code>CCalendarData</code> i form av en array.
	</p>
	<p>
		Och man kunde förstås nöja sig med det, men som en god övning delade jag upp månadsnamn och helgnamn i två abstrakta klasser (som man kan tänka sig läsa in namnen från en databas beroende på språkval). Dessa klasser kan sedan användas av andra klasser <em>utanför</em> själva kalendern, såsom <code>CCalendarRedDaysInMonth</code>, vilken visar vilka dagar som ska firas i den valda månaden.
	</p>
	<p>
		Eftersom jag <em>inte</em> vill sprida ut mina klasser i olika mappar (föredrar \"namespace\"-metoden), så har jag samlat klasserna i en enda fil där en huvudklass, <code>CCalender</code>, sköter själva ruljansen.
	</p>
	<h4>Tärningsspelet 100</h4>
	<p>
		Denna uppgift gjorde jag enbart för att jag ville prova att skapa ett objekt som sparar resultaten till en enkel textfil. Precis som med kalendern har jag samlat spelklasserna i en fil:
	</p>
	<ul>
		<li>
			<code>CDiceEngine</code>, som sköter logiken
		</li>
		<li>
			<code>CDiceBoard</code>, som hanterar det visuella
		</li>
	</ul>
	<p>
		Och även här hämtar <code>CDiceBoard</code> informationen i form av en array från <code>CDiceEngine</code>. I samma fil ligger också \"huvudklassen\" <code>CDiceGame</code> som sköter ruljansen. Denna klass (eller objekt) skapas i en session-variabel.
	</p>
	<p>
		Klassen <code>CDiceGameRecordFile</code> hanterar, utöver läsning/skrivning av textfilen, kontroll och sortering av de bästa resultaten. Denna klass är fristående (ingår inte i session-variabeln), så att frekventa uppdateringar kan göras (efter varje slag). Även om risken är minimal, kan det bli rusning till spelet och då vill man kunna se de aktuella resultaten!
	</p>
	<p>
		För att göra spelet ännu mer \"spännande\" har jag lagt till möjligheten att inför varje slag ändra på den tärningssiffra man <em>inte</em> vill slå – det finns ju de olyckskorpar som jämt och ständigt slår ettor i diverse tärningsspel!
	</p>
	<h4>Övrigt</h4>
	<p>
		-
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
			Notepad++
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
		<span class='font-small-italic'>".CAnassa::txtDate("2014-10-10", 0, "")."</span>
	</p>
</article>";
?>