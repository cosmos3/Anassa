<?php
	echo "
<article>
	".$kmomsTitle."
	<h4>Utvecklingsmiljö</h4>
	<p>
		Efter ett akut datorbyte tidigare i år, sitter jag numera med <b>Windows 7 Professional</b> på en tämligen billig och måttfull \"kontorsmaskin\" (och visst, man kan inte sitta med det gamla XP hur länge som helst, dock påverkas en del gamla favoritprogram av ett nyare Windows). De program jag använder mest i utvecklingssyfte är <b>Microsoft Visual Studio 2010</b> (med tillägg för PHP, CSS-3 och Javascript), samt <b>Notepad++</b> för att göra snabba justeringar och hämta fram äldre användbara dokument. Jag kör <b>Wamp 2.5</b> som lokal server och nyttjar <b>FileZilla</b> som FTP-klient. Till grafiken använder jag, så gott som uteslutande, det gamla <b>Paint Shop Pro 9.1</b> - finns ingen anledning att fläska på med det tunga artilleriet.
	</p>
	<h4>Guiden 20 steg för att komma igång med PHP</h4>
	<p>
		Eftersom jag är rätt så van vid programmering, från förr, och numera även med PHP, gav guiden mig inget direkt nytt. Men det var bra att gå genom den för att friska upp det gamla minnet.
	</p>
	<h4>Webbmallen Anax</h4>
	<p>
		Min mall har jag döpt till Anassa (jepp, googla på det! Hum, hotell?). Nåväl, <i>hon</i> är tydligen inte så viktig i den gamla grekiska mytologin, men Anassa är helt enkelt den feminina motsvarigheten till Anax, d v s ".txtLinkBlank('http://en.wikipedia.org/wiki/Anax', '<i>drottningen</i>')." (i början slant dock fingrarna och det blev ganska ofta <i>ananas</i> av det hela istället).
	</p>
	<h4>Strukturen i webbmallen</h4>
	<p>
		Jag tänkte först använda några av mina egna strukturer, eller åtminstone göra en slags blandning, men bestämde mig sedan för att följa grundstrukturen så långt som möjligt (t ex föredrar jag att ha menyer, huvud och liknande som egna filer och inte som variabler). Några smärre förändringar har jag trots allt gjort, som exempelvis flyttat inkluderingen av funktions-filen till config-filen, eftersom jag vill kunna nå mina funktioner <i>innan</i> den tänkta sidan ska renderas.
	</p>
	<p>
		Även dessa sidor för redovisningarna har vållat en del huvudbry eftersom jag vill ha dem som fristående filer, som inkluderas i sidans huvudfönster, men samtidigt kunna nå eventuella funktioner för text- och bildlänkar. Detta löstes genom att ha en variabel som talar om när \"main\"-variabeln ska inkluderas istället för att bara skrivas ut på sidan.
	</p>
	<h4>CSource</h4>
	<p>
		Eftersom jag har lagt till en metod i klassen för att visa filer och kataloger i en combobox var jag tvungen att titta närmare på strukturen i klassen och plocka ut de uppgifter jag behövde för min combobox. I början fungerade inte själva GET-metoden för comboboxen, så jag använde POST-metoden istället, vars variabel omvandlades till en GET-variabel i min Source-fil (eftersom jag inte ville ändra för mycket i CSource-filen). En osnygg lösning, så efter ett par dagar återinförde jag GET-metoden, och då plötsligt fungerade det som det ska...?
	</p>
	<p>
Jag har även lagt till en funktion för att man ska kunna ladda hem vald fil. Denna funktion la jag dock inte i själva klassen, eftersom funktionen kan komma till användning vid andra tillfällen.
	</p>
	<h4>GitHub</h4>
	<p>
		Denna uppgift väntar jag med att göra eftersom den inte har så mycket med själva PHP-programmeringen att göra.
	</p>
	<h4>Övrigt</h4>
	<p>
		Det var inga större problem att lägga till funktionen <code>dump()</code> eller göra en speciell sida för \"Error&nbsp;404\". Den senare kräver förstås en mer planerad strategi för att fylla sin funktion. Google Analytics tog lite tid på sig för att komma igång, men tycks fungera.
	</p>
	<p>
		För övrigt undviker jag kommentarer i min kod, såvida det inte handlar om ett mer invecklat avsnitt eller en komplicerad funktion - tycker att koden i sig är tillräckligt självförklarande, tillsammans med vettiga variabel- och funktionsnamn.
	</p>
</article>";
?>