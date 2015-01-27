<?php
	echo "
<article>
	".$titleKmom."
	<h4>Många moduler blir det</h4>
	<p>
		Många moduler (klasser) blir det förvisso, men det känns helt okej. För att få en viss ordning i det hela, försöker jag hålla en någorlunda logisk namngivning på klasserna. T ex har klasserna <code>CPage</code> och <code>CBlog</code> (som heter just så i uppgiften) fått prefixet <code>CContent</code>. Samma system använder jag också för de olika sidkontrollerna.
	</p>
	<h4>Struktur</h4>
	<p>
		Jag tycker att strukturen börjar kännas ganska naturlig vid det här laget och det är lätt att gå från idé till så att säga handling. Från sidkontrollern som använder klasser med metoder för att producera html (och hantera olika villkor), vilka i sin tur använder klasser som sparar och hämtar information från databasen. Det är i alla fall den strukturen jag har använt till denna uppgift.
	</p>
	<ul>
		<li>
			<code>CContent</code> - hanterar information till och från databasen
		</li>
		<li>
			<code>CContentManage</code> - producerar formulär och tabell samt hanterar en del villkor
		</li>
		<li>
			<code>CContentPage och CContentBlog</code> - dessa två är så gott som identiska. Skillnaderna ligger i hämtningsmetoden av poster, men även i en framtida skillnad i layouten, vilken jag inte har lagt någon större vikt vid för stunden
		</li>
	</ul>
	<p>
		Jag har kopplat \"äganderätten\" för posterna till akronymet (användarnamnet) i användartabellen. Det mer normala vore kanske att använda id:et (index) för användaren, men eftersom det ideligen testas och återskapas tabeller, så känns det bäst att använda akronymet.
	</p>
	<p>
		Skapande och eventuella ändringar av \"content\"-posterna beror på vilken behörighet användaren har. En normal användare kan bara ändra sin egen post, medan en användare med administrationsrättigheter kan ändra på alla poster.
	</p>
	<p>
		Jag har även lagt till en variabel som tillåter att content-posterna kan renderas i HTML5. Det känns onekligen lite klent att bara använda de olika filtren för att skapa en modern webbsida. Dock kan denna möjlighet bara användas av betrodda och seriösa användare (t ex admin).
	</p>
	<p>
		Eftersom jag inte har några rullgardinsmenyer har jag låtit två sidor innehålla varsin combobox (select) för att kunna presentera \"content\"-posterna (hem- och blogg-sidan). Dessa sidors kontroller innehåller därför också mer kod. I comboboxen på bloggsidan visas vem som har skrivit bloggen och när den publicerades.
	</p>
	<h4>Saknade moduler</h4>
	<p>
		Jag skulle gärna vilja ha några moduler (klasser) som generellt hanterar tabeller och formulär, men kanske inte riktigt så omfattande som formulär-modulen i phpmvc-kursen.
	</p>
	<h4>Övrigt</h4>
	<p>
		Till den här uppgiften har jag samlat mina tidigare löst liggande funktioner till en liten statisk klass, <code>CAnassa</code>, och det känns mycket bättre att ha det så. Även menyerna (huvudmenyn och \"login\"-menyn) ligger i en separat klass.
	</p>
	<p>
		Jag upptäckte att metoden <code>slugify</code> (för att generera en slug av titeln) behöver \"UTF-8\"-tillägget i PHP-funktionen <code>mb_strtolower</code> för att fungera på ett korrekt sätt.
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
		<span class='font-small-italic'>".CAnassa::txtDate("2014-12-29", 0, "")."</span>
	</p>
</article>";
?>