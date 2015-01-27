<?php 
	$anassa["css"][]="css/dicegame.css";
	$anassa["js"][]="js/dicegame.js";
	$recordFile=new CDiceGameRecordFile(ANASSA_INSTALL_PATH."/src/CDiceGame/dicegame_record.txt");
	if (!CAnassa::readSession("dicegame", "", false)) {
		$_SESSION["dicegame"]=new CDiceGame();
	}
	$html=$_SESSION["dicegame"]->Play($recordFile);
	$gee="<br/>Gee, den där <span class='dicegame-gee'>".$recordFile->NumberInList(1)."</span> verkar vara svårslagen... hur är det med <span class='dicegame-gee'>".$recordFile->NumberInList(2)."</span> då? Kan du slå den filuren? Varför inte slå dem båda två!? Eller nöjer du dig med att putta ner <span class='dicegame-gee'>".$recordFile->NumberInList(3)."</span> från prispallen?!";
	if ($_SESSION["dicegame"]->DiceEngine->ReleaseDiceGame()) {
		unset($_SESSION["dicegame"]);
		unset($_SESSION["dicegame-release"]);
		unset($_SESSION["dicegame-reset"]);
		unset($_SESSION["dicegame-name"]);
		unset($_SESSION["dicegame-roll"]);
		$html="
<p>
	<b>Tärningsspelet 100 är frisläppt!</b><br/><br/>
	Klicka på menyn igen för nytt spel.
</p>";
		$gee="";
	}
	$anassa["main"]=$title."
<article>
	<p>
Här gäller det att samla ihop poäng och komma till 100, eller så nära som möjligt. På resan dit gäller det att undvika att slå samma siffra som den mindre röda tärningen visar (denna kan du själv ändra på inför varje slag) - slår du samma siffra så är spelet över. Låt din intuition och magkänsla styra spelet. Ditt mål bör åtminstone vara att komma in på \"100&nbsp;i&nbsp;topp\"-listan!<br/>".
		$gee."
	</p>".
		$html."
</article>";
	include(ANASSA_THEME_RENDER);
?>