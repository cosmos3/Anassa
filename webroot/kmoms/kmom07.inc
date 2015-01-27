<?php
	echo "
<article>
	".$titleKmom."
	<h4>Krav 1: Struktur och innehåll</h4>
	<p>
		Jag har använt min gamla Anassa-struktur, vilken i princip är densamma som för de tidigare kursuppgifterna, förutom att ovidkommande klasser (t&nbsp;ex tärningsspelet och galleriet) inte längre är med. Jag har lyft bort min tidigare \"sub-header\", som tidigare har fungerat som en undermeny, och bytt namn på <code>CContent</code>-klasserna till <code>CBlog</code>.
	</p>
	<p>
		Först tänkte jag byta ut \"filmtemat\" till någon annan produkt som inte är direkt \"hyrbar\" över nätet. Detta för att jag ville ha med en varukorg för beställda (köpta) produkter, men att skapa nya datatabeller, med motsvarande krav på sorteringsmöjligheter och tillhörande nya klasser, skulle ta för lång tid, så jag har istället behållit de gamla filmtabellerna. Men det blev ändå en varukorg till slut.
	</p>
	<p>
		Sidorna har en gemensam \"header\" (med logotyp, titel och slogan), \"footer\" och huvudmeny med länkar till de olika sidorna. Jag har låtit sidorna ha en enkel design och layout, och koncentrerat mig mer på kopplingarna mellan sidor och funktioner, såsom att \"tillbaka\"-knapparna fungerar som de ska, att rätt och informativ text ges till användaren vid t&nbsp;ex inloggning och beställning, samt en del mindre funktioner.
	</p>
	<p>
		Det finns tre nivåer för inloggade användare till sidan:
	</p>
	<ul>
		<li>
			\"normal\" - kan fullfölja en beställning
		</li>
		<li>
			\"admin\" - kan skapa, ändra och radera (mjukt) filmer, nyheter och användare
		</li>
		<li>
			\"super\" - kan göra allt samt återställa databaser
		</li>
	</ul>
	<p>
		Jag har gjort så att en \"normal\" användare kan se en liten del av vad en \"admin\" kan göra på sidorna för hantering av filmer, nyheter och användare.
	</p>
	<h4>Krav 2: Filmsidan</h4>
	<p>
Dessa sidor är uppbyggda med samma klasser från tidigare kursuppgift (kmom04).
	</p>
	<p>
		Filmerna (25 stycken för närvarande) ligger i en tabell som valfritt kan visa 5, 10 eller 20 filmer per sida. Sökning kan ske på titel, årtal, medverkande och kategori. När man söker efter titel eller medverkande sker en sökning i databasen för varje tecken man skriver in, en så att säga \"autocomplete\"-funktion, vilket resulterar i en rullgardinsmeny under sökrutan med föreslagna alternativ. Denna funktion använder ett AJAX-anrop för att leta i databasen.
	</p>
	<p>
		I tabellen visas även pris och antal uthyrningar och man kan växla mellan att visa medverkande i eller en beskrivning av filmen. Går man in på enskild film visas också en IMDB-länk. Någon länk till en trailer har jag inte tagit med. Varje film kan maximalt tillhöra 3 kategorier.
	</p>
	<p>
		Filmbilderna visas i olika storlekar med hjälp av filen <code>img.php</code> och <code>CImage</code>-klassen från tidigare uppgift. I klassen <code>CImage</code> har jag lagt till en GET-variabel \"standby\", en länk till en standardbild, som ska användas ifall den ordinarie bildlänken inte fungerar eller bildfilen inte finns tillgänglig. Jag har låtit en film sakna bild för att illustrera detta på första sidan.
	</p>
	<p>
		Användare med \"admin\"-rättigheter kan skapa, ändra och radera filmer.
	</p>
	<h4>Krav 3: Nyhetssidan</h4>
	<p>
		På nyhetssidan kan man välja hur många nyheter som ska visas på sidan samt ur vilken kategori (3 olika). Nyheterna visas inte i sin helhet utan enbart en introduktion av nyheten och man måste klicka på \"Läs mer\"-knappen för att kunna läsa hela nyheten. Utformningen för sidans nyheter är densamma för de nyheter som visas på första sidan.
	</p>
	<p>
		Jag har valt att ha hanteringen av nyheterna (för användare med \"admin\"-rättigheter) på en separat sida som visar nyheterna i en tabell. Denna sida kommer man åt via inloggnings-menyn (vid den gröna gubben). Tabellen går att sorteras på olika sätt.
	</p>
	<h4>Krav 4: Första sidan</h4>
	<p>
		Första sidan visar de senaste upplagda filmerna, de senaste nyheterna samt de populäraste (mest uthyrda) filmerna. På sidan finns en liten \"checkbox\" som gör att man kan se fler än enbart de 3 senaste ur varje ovanstående kategori.
	</p>
	<p>
		Filmerna visas som bilder (<code>img.php</code> och <code>CImage</code>) med titel, pris, beställningslänk samt en liten siffra som visar hur många gånger filmen har varit uthyrd. Datatabellen för filmerna har en variabel som räknas upp varje gång en film blir beställd.
	</p>
	<p>
		Sidan visar även en översikt av de olika filmkategorierna. En sökning på kategorierna leder till filmsidan.
	</p>
	<h4>Krav 5-6: Extra funktioner</h4>
	<p>
		<i><u>Filmkalender</u></i>. Detta är i princip samma kalender från tidigare kursuppgift (kmom02). Bilderna hämtas slumpmässigt från databasen med SQL-kommandot <code>RAND()</code>. Tillsammans med kalendern visas också information om filmen samt länkar till IMDB och själva filmen, så att man snabbt kan göra en beställning.
	</p>
	<p>
		<i><u>Kundsida</u></i>. En användare kan skapa ett eget kundkonto och detta är ett måste för att kunna fullfölja en beställning. Användaren kan göra ändringar och radera sitt konto. Detta görs via menyvalet \"Mitt konto\" (vid den gröna gubben).
	</p>
	<p>
		<i><u>Bilduppladdning</u></i>. Det finns möjlighet att ladda upp filmbilder och funktionen är knuten till skapandet och ändring av en film. Bildlänken uppdateras automatiskt om man lägger upp en bildfil. Jag har dock inte tagit hänsyn till eventuella överskrivningar av befintliga bildfiler. Funktionen ligger för övrigt i filen <code>movies_post.php</code>.
	</p>
	<p>
		<i><u>Användarhantering</u></i>. Jag har gjort en sida där administratören kan skapa, ändra och radera användare. Listan har inget stöd för paginering, men däremot kan den sorteras på olika sätt. Man når sidan från användarmenyn (just det, vid den gröna gubben).
	</p>
	<p>
		<i><u>Varukorg</u></i>. För att få en översikt över sin beställning har jag lagt till en varukorg där man kan se sin beställning i en tabell. Beställningen lagras i en <code>SESSION</code>-variabel och man kan på sidan plocka bort filmer eller helt tömma varukorgen. Menyvalet för varukorgen dyker först upp när man har beställt en film. Man måste vara inloggad för att fullfölja en beställning och då skickas ett bekräftelse-mejl till användaren (hade jag haft mer tid på mig så hade jag lagt till en datatabell för beställningarna). Funktionerna för varukorgen ligger i klassen <code>CCart</code> och filerna <code>cart.php</code> och <code>cart_post.php</code>.
	</p>
	<h4>Allmänt</h4>
	<p>
		Jag tycker att projektet var ganska lätt att genomföra, eftersom de flesta modulerna och klasserna redan var färdigskrivna sedan tidigare. Det som behövdes var några mindre justeringar för att de skulle fungera tillsammans.
	</p>
	<p>
		De problem som uppstod var enkla att lösa och knappt värda att nämnas. Men bara för att nämna något, så var jag tvungen att flytta initieringen av alla <code>SESSION</code>-variablerna för de olika sidorna till filen <code>config.inc</code> för att på så sätt undvika interna felmeddelande som kan uppstå när man till exempel går direkt från en film på första sidan (eller från kalendern) till sidan med detaljerad filmbeskrivning, då just den sidan förutsätter att man kommer från sidan med filmtabellen där initieringen förut skedde.
	</p>
	<p>
		Projektet var både lagom stort och utmanande.
	</p>
	<h4>Tankar om kursen</h4>
	<p>
		Kursens material och handledning har varit mycket bra med välskrivna och lättbegripliga övningar och dokument.
	</p>
	<p>
		Jag är väl kanske mindre nöjd med det ständigt återkommande \"tjatet\" om GitHub, vilket förstås är bra att känna till och kunna, men har inte så mycket att göra med kursens själva \"kärnämne\" - nämligen OOP.
	</p>
	<p>
		Övningen med <code>CImage</code>- och <code>CGallery</code>-klasserna kändes lite överflödig, även om det var nyttigt att pussla ihop klasserna utifrån de lösa funktionerna. Men bildvisning, och framförallt bildmanipulering, görs lika bra (eller bättre) med lämpligt bildhanteringsprogram och \"layout-styrning\". Jag hade hellre sett en övning i hur man integrerar en ordentlig HTML-editor eller en editor till ett forum. Eller så kunde man tänka sig en lättare genomgång av hur en CMS-struktur bäst kan vara uppbyggd, då många av uppgifterna just handlar om att kunna göra ändringar på sidan via webben.
	</p>
	<p>
		Det är lite väl många ställen som redovisningstexten ska kopieras till och publiceras på. Det kanske räcker med en länk till \"ME\"-sidorna på forumet?
	</p>
	<p>
		Förutom ovanstående så är jag ändå mycket nöjd med kursen och eftersom det även har varit väldigt roligt och stimulerande så får den betyget <b>8</b>. Och ett stort plus för ett bra och aktivt forum - det är inte många distanskurser som har det.
	</p>
	<p>
		Jag kan tänka mig att rekommendera kursen till dem som redan kan PHP och har ett någorlunda grepp om OOP, annars kan uppgifterna kanske ta lite för lång tid att dels läsa in sig på och dels utföra.
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