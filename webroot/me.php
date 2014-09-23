<?php 
	include(__DIR__."/config.inc");
	$title=getPageTitle('me', true);
	$anassa['css'][]="css/me.css";
	$anassa['js'][]="js/me.js";
	$anassa['header_sub']="
		<div id='slides-box'>
			<div id='slides'></div>
		</div>
		";
	$anassa['main']=$title."
<article>
	<div id='computerDOS'>
		<object type='application/x-shockwave-flash' data='swf/ComputerDOS.swf' width='150' height='150'>
			<param name='movie' value='swf/ComputerDOS.swf'/>
			<param name='quality' value='high'/>
			<param name='wmode' value='transparent'/>
		</object>
	</div>
	<p>
		Jag heter Göran Hellberg och är 52 år ung, mestadels uppvuxen och boendes i det \"stora möbelföretagets Mecka\", d&nbsp;v&nbsp;s Älmhult, sedan 45 år tillbaka. Här bor jag i en marklägenhet utan familj och vovve - obunden och fågelfri. De första 7 åren tillbringade jag f&nbsp;ö i Hörby, Skåne.
	</p>
	<p>
		Man kan lugnt påstå att jag inte är uppvuxen med datorer och andra tekniska
 \"roligheter\" utan det var mest \"spring och lek\" som gällde under min uppväxttid.
 Men efter genomgången naturvetenskaplig linje på gymnasiet och tio månaders militärtjänst, så lånade min mamma hem, från sitt bankjobb, en ".txtLinkBlank('http://en.wikipedia.org/wiki/Commodore_64', 'Commodore&nbsp;64')." (allmänt kallad VIC-64) - och jag var fast! Ganska raskt beställde jag hem en ".txtLinkBlank('http://en.wikipedia.org/wiki/SV-328', 'Spectravideo-328').", där jag snabbt omvandlade analoga spel, såsom Mastermind och Yatzy, till digitala versioner, samt hittade på en del andra småroliga spel.
	</p>
	<p>
		Jag har mestadels yrkesarbetet under mitt korta och ungdomliga liv, och då främst inom några få branscher såsom:
	</p>
	<ul>
		<li>Kontorsarbete vid kommunens bostadsföretag</li>
		<li>Montering och kretskorttestning vid elektronikföretag</li>
		<li>Virkessorterare och slipare vid det lokala sågverket</li>
	</ul>
	<p>	
		Även om jag inte har varit anställd som programmerare har jag ändå skrivit en hel del program åt de företag jag har jobbat vid. Dessa program har varit av typen; beräkning av banklån, kalkylering av hyror, diverse produktions- och resultatprogram samt grafiskt postningsstöd (som matematiskt och visuellt visar det bästa virkesuttag ur en stock).
	</p>
	<p>
		Så, jag har trots allt ändå tjänat något, och lärt mig mer, på mitt datorintresse, men jag har märkt att det har blivit allt svårare att få ett nytt jobb utan en dokumenterad och <i>högre</i> utbildning. Och efter nedläggningen av det numera nedrivna och utraderade sågverket, började jag så smått läsa några universitetskurser på distans och tänker fortsätta med det.
	</p>
	<p>
		Visst ja, det förekommer en del gitarrer där uppe i bildspelet - och visst är det så. Musiken är också en stor del av mitt liv, samt även teckning. Dock ligger jag lågt med dessa kreativa sysslor då jag lägger det mesta krutet på studier och fortsatt självinlärning av datorrelaterat material.
	</p>
</article>";
	include(ANASSA_THEME_PATH);
?>