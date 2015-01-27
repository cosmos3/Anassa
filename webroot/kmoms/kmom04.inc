<?php
	echo "
<article>
	".$titleKmom."
	<h4>Generellt</h4>
	<p>
	Den här uppgiften har tenderat att sväva ut lite väl mycket vid det här laget, men det är oftast så jag använder kursuppgifter till; att skapa små projekt som lever ett eget liv utanför och efter avslutad kurs.
	</p>
	<p>
	Än en gång har jag återanvänt delar från ett liknande arbete som jag har gjort tidigare, den gången helt utan några klasser, bara en massa funktioner och \"include\"-filer. Men det ska ju inte vara så svårt att omvandla dessa till separata klasser? Och det var heller inte så svårt, även om jag fick \"göra om\" och \"tänka nytt\" vid ett flertal tillfällen.
	</p>
	<p>
	I början var jag lite irriterad på användandet av <code>FETCH_OBJ</code> istället för <code>FETCH_ASSOC</code>, som jag alltid har använt tidigare. Hade nästan tänkt ändra på det, men knotade på med objekten, för man kan ju alltid lära sig något nytt av det.
	</p>
	<p>
	Jag har låtit tabellen för kategorier (genre) vara en ren \"statisk\" klass (kategorier ändras ju inte så ofta), och har istället lagt till en tabell för namn (personer som ingår i en film) och en för själva kopplingen mellan film och namn. I denna tabell sparas även personens funktion(er) (regissör, skådespelare, etc) i filmen.
	</p>
	<p>
	Klasser (de första hanterar i huvudsak läsning och skrivning från/till datatabeller):
	</p>
	<ul>
		<li>
			<code>CMovie</code> - data om enskild film
		</li>
		<li>
			<code>CMoviePeople</code> - koppling mellan film och person, samt personens funktioner
		</li>
		<li>
			<code>CMoviePeopleAll</code> - namn på personer (kan förstås utvecklas till att innehålla mer data)
		</li>
		<li>
			<code>CMovieGenre</code> - \"statisk\" tabell för kategorier (ingen SQL-tabell)
		</li>
		<li>
			<code>CMovieManage</code> - klass som nyttjar de ovanstående när en film skapas, ändras eller raderas
		</li>
		<li>
			<code>CMovieManageHTML</code> - visar data om filmen och möjliggör ändringar av film (beroende på användarnivå)
		</li>
		<li>
			<code>CMovieTable</code> - visar alla filmer och sköter sortering, paginering m m (denna klass borde egentligen också delas upp i två separata)
		</li>
	</ul>
	<p>
	Eftersom sidorna har svävat ut lite grann, så har jag även stött på problem som inte är relaterade till uppgiften, men som har varit lärorika att lösa, t ex:
	</p>
	<ul>
		<li>
			Autocomplete. När man börjar skriva något i en sökruta dyker en popup-meny upp med förslag från aktuell datatabell (filmtitel eller namn). Detta har lösts med <code>AJAX</code>-anrop och lämplig PHP-fil (filnamnen slutar med \"_ac\").
		</li>
		<li>
			Fylla en combobox (select) med namn och sedan läsa boxens hela innehåll, vilket görs lättast genom att spara boxens innehåll i en gömd variabel.
		</li>
	</ul>
	<p>
		Jag var tvungen att lägga in tre separata comboboxar för kategorival, eftersom en combobox med multi-select beter sig konstigt när den är \"stylad\" (jag har inte tittat närmare på detta – det kommer långt ner på min \"to do\"-lista).
	</p>
	<p>
		Sidorna fungerar som de ska, med \"multi\"-sökning i filmdatabasen, skapande, ändring och radering av filmer och kopplingar till personer, samt inloggning av användare och vissa begränsningar för dessa.
	</p>
	<h4>Guiden för film-databasen</h4>
	<p>
		Och ja, guiden gick bra att jobba igenom. Jag skippade dock den virtuella tabellen för genre, eftersom jag ville göra en sådan kopplad till personer som medverkar i vald film.
	</p>
	<h4>CUser</h4>
	<p>
		Inloggning av användare sker längst upp till höger på sidorna (via \"inloggnings-figuren\"). Användare är (kommer att vara) uppdelade i olika behörighetsnivåer. Högsta nivån kommer att kunna redigera användartabellen (som att plocka bort illvilliga användare), medan nästa nivå begränsas till att t ex redigera filmer i databasen. En vanlig inloggad användare kommer endast, när det gäller film-databasen, att kunna gå in och avge sitt omdöme och betyg.
	</p>
	<p>
		(<i>ovanstående är ännu inte helt färdigt</i>)
	</p>
	<h4>Dynamisk rullgardinsmeny</h4>
	<p>
		Eftersom liknande upplägg finns och har gjorts i kursen phpmvc, så gjorde jag ingen sådan till dessa sidor. Dessutom så passar det inte riktigt in på Anassa’s lite \"bulliga\" menyrad. Däremot har \"inloggnings-figuren\" fått en egen popup-meny med menyval beroende på om man är inloggad eller inte. Denna är så gott som helt baserad på CSS och några enkla javascript-rader.
	</p>
	<p>
		För film-databasen är alla funktioner samlade i ett separat fönster under själva huvudmenyn. Dessa ligger i \"include\"-filen <code>movies_header.inc</code>, där även <code>SESSION</code>-variabeln (\"movies\") initieras.
	</p>
	<h4>Övrigt</h4>
	<p>
		Att återställa databasen med plattformsberoende kodning känns inte som en praktisk och optimal lösning, även om man kan ha två (eller finns det fler plattformar?) funktioner och bortkommentera den ena, beroende på om det är den ena eller den andra plattformen. Man kan förstås även låta programmet själv känna av plattformen med hjälp av PHP-variabeln <code>PHP_OS</code>, men det är rätt många snarlika alternativ att gå igenom.
	</p>
	<p>
		Jag skrev en egen variant för återställande av databasen, vilken fungerar alldeles utmärkt på båda plattformarna. Det finns dock en liten \"brist\" i koden, men det är inget som påverkar de aktuella tabellerna.
	</p>
	<p>
		Det allmänt vedertagna tecknet för \"wildcard\" i en sökning är asterisken (*), så varför då använda procenttecknet (%)? Tja, för att mySQL hanterar det som ett \"wildcard\". Kan man då inte låta användaren använda sitt (*) och få mySQL hantera det som ett \"wildcard\"? Jovisst, och det borde väl även ingå i uppgiften?
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
		<span class='font-small-italic'>".CAnassa::txtDate("2014-11-24", 0, "")."</span>
	</p>
</article>";
?>