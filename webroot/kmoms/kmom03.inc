<?php
	echo "
<article>
	".$titleKmom."
	<h4>Är du bekant med databaser sedan tidigare? Vilka?</h4>
	<p>
		MySQL är jag ganska bekant med vid det här laget. Jag har även jobbat med Microsofts Access och SQL-server samt äldre databasverktyg såsom dBase IV.
	</p>
	<h4>Hur känns det att jobba med MySQL och dess olika klienter, utvecklingsmiljö och BTH driftsmiljö?</h4>
	<p>
		<i><u>Wamp - MySQL Console</u></i>.<br/>
		Ett smidigt verktyg när det gäller att köra \"queries\" mot databasen. Personligen undviker jag att göra ändringar i en databas eller tabeller via konsolen, då det är lätt att det smyger in något litet fel i kommandoraden.
	</p>
	<p>
		<i><u>PHPMyAdmin</u></i>.<br/>
		För att skapa och ändra i databaser och tabeller tycker jag att detta är det bästa verktyget för just det ändamålet. Man får en bra överblick av alla tabellerna och det är lätt att göra ändringar i efterhand. Funktionerna för att importera och exportera tabeller är enkla och lätthanterliga. Dessutom kan man själv välja vilket format man vill exportera en tabell i.
	</p>
	<p>
		<i><u>MySQL Workbench</u></i>.<br/>
			Detta är ett ypperligt verktyg för att dokumentera en databas och dess tabeller. Speciellt tycker jag om att det är så enkelt att få fram en grafisk översikt (ER-diagram) av databasen samt enkelheten i att \"rita\" ut eventuella kopplingar mellan tabellerna.
	</p>
	<p>
		Jag föredrar dock helst att jobba med phpMyAdmin som känns både smidig och behändig. BTH:s driftsmiljö är precis som ett vanligt och normalt webbhotell (t&nbsp;ex one.com som jag själv använder mig av) där man också är hänvisad till just bara en databas. Då gäller det att namnge sina tabeller med omsorg.
	</p>
	<p>
		Med phpMyAdmin och Workbench hade jag inga problem att koppla upp mig mot databasen på BTH:s server, även om jag var tvungen att markera \"disable secure_auth\" (eller \"use the old authentication protocol\" som det står i min version) i Workbench.
	</p>
	<p>
		När jag först försökte använda MySQL-konsolen, via Putty eller FireSSH, gick det inte alls bra, eftersom den klagade på mitt lösenord - för många \"(\" (paranteser) i mitt lösenord. Just vid detta första tillfälle hade jag inte tid att lösa problemet, men har senare kommit underfund med att konsolen accepterar lösenordet om jag omger det med \"pnuffar\".
	</p>
	<h4>Hur gick SQL-övningen, något som var lite svårare i övningen, kändes den lagom?</h4>
	<p>
		Det mesta i SQL-övningen var väldigt bekant och sig likt. Jag testade dock inte alla punkterna i övningen, utan bara de mer \"invecklade\" och då mot en lokal liknande databas. En del kommandon och funktioner använder man sig inte så ofta av, så det känns bra att kunna repetera dessa genom den här typen av övning. Övningen var för övrigt lagom stor beträffande svårighetsgrad och omfång.
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
		<span class='font-small-italic'>".CAnassa::txtDate("2014-10-24", 0, "")."</span><br/>
		<span class='font-small-italic'>Kompletterad: ".CAnassa::txtDate("2015-01-26", 0, "")."</span>
	</p>	
</article>";
?>