<?php 
	include(__DIR__."/config.inc");
	$kmomSelected=readSessionFromPost('kmoms', 1);
	$kmomComboBox=array(
		"Kmom01: Kom igång med Objektorienterad PHP",
		"Kmom02: Objektorienterad programmering i PHP",
		"Kmom03: SQL och databasen MySQL",
		"Kmom04: PHP PDO och MySQL",
		"Kmom05: Lagra innehåll i databasen",
		"Kmom06: Bildbearbetning och galleri",
		"Kmom07/10: Projekt/Examination"
		);
	$kmomForm="
		<form action='kmoms.php' method='POST'>
			Välj uppgift:
			<select name='kmoms' onchange='document.forms[0].submit();'>";
	for ($i=1; $i<=7; $i++) {
		$kmomForm.="
				<option value='".$i."'".($kmomSelected==$i ? " selected" : "").">".$kmomComboBox[$i-1]."</option>";
	}
	$kmomForm.="
			</select>
		</form>";
	$anassa['header_sub']=getPageTitle('kmoms', true).$kmomForm;
	$kmomsTitle=txtPageTitle($kmomComboBox[$kmomSelected-1]);
	$fileName=__DIR__."/kmoms/kmom0".$kmomSelected.".inc";
	if (file_exists($fileName)) {
		$anassa['main']=$fileName;
		$anassa['main_inc']=true;
	} else {
		$anassa['main']=$kmomsTitle."
			<p>
				Det finns ingen redovisning tillgänglig för denna uppgift.
			</p>";
	}
	include(ANASSA_THEME_PATH);
?>