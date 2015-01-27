<?php
	include(__DIR__."/config.inc");
	$selOther=CAnassa::readSessionFromPost("other", 1);
	$cmbOther=array(
		array(
				'text'=>"Kalender: En liten kalender",
				'url'=>"calendar.php",
				'main_inc'=>false
				),
			array(
				'text'=>"Tärningsspelet 100: Ett spännande tärningsspel",
				'url'=>"diceGame.php",
				'main_inc'=>false
				),
			array(
				'text'=>"ctrlTest: Test av kontroller",
				'url'=>"other/ctrlTest.inc",
				'main_inc'=>true
				),
			array(
				'text'=>"varDump: Dumpning av Anassa (variabeln, förstås)",
				'url'=>"other/vardump.inc",
				'main_inc'=>true
				),
			array(
				'text'=>"error 404: Snabbtest av error 404",
				'url'=>"other/error404.inc",
				'main_inc'=>true
				)
			);
	$htmlSub="
<div style='float:left;'>
	<form action='other.php' method='POST'>".
		CAnassa::getPageTitle("other", false).":
		<select name='other' onChange='document.forms[0].submit();'>";
	for ($i=1; $i<=count($cmbOther); $i++) {
		$htmlSub.="
			<option value='".$i."'".($selOther==$i ? " selected" : "").">".
			$cmbOther[$i-1]["text"]."
			</option>";
	}
	$htmlSub.="
		</select>
	</form>
</div>
<div style='float:right;'>
	<form action='clear_session.php' method='POST'>
		<i>Panik-knappen:</i>
		<input type='submit' value='Unset SESSION' title='Nollställer SESSION'/>
	</form>
</div>";
	$anassa["header_sub"]=$htmlSub;
	$titleOther=CAnassa::txtPageTitle($cmbOther[$selOther-1]["text"]);
	$htmlUrl=__DIR__."/".$cmbOther[$selOther-1]["url"];
	if ($cmbOther[$selOther-1]["main_inc"]) {
		$anassa["main"]=$htmlUrl;
		$anassa["main_inc"]=true;
		include(ANASSA_THEME_RENDER);
	} else {
		$title=$titleOther;
		include($htmlUrl);
	}
?>