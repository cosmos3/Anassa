<?php 
	include(__DIR__."/config.inc");
	$selKmom=CAnassa::readSessionFromPost("kmoms", 1);
	$cmbKmom=array(
		"Kmom01: Kom igång med Objektorienterad PHP",
		"Kmom02: Objektorienterad programmering i PHP",
		"Kmom03: SQL och databasen MySQL",
		"Kmom04: PHP PDO och MySQL",
		"Kmom05: Lagra innehåll i databasen",
		"Kmom06: Bildbearbetning och galleri",
		"Kmom07/10: Projekt/Examination"
		);
	$frmKmom="
<form action='kmoms.php' method='POST'>".
		CAnassa::getPageTitle("kmoms", false)." - välj uppgift:
	<select name='kmoms' onChange='document.forms[0].submit();'>";
	$count=count($cmbKmom);
	for ($i=1; $i<=$count; $i++) {
		$frmKmom.="
		<option value='".$i."'".($selKmom==$i ? " selected" : "").">".
			$cmbKmom[$i-1]."
		</option>";
	}
	$frmKmom.="
	</select>
</form>";
	$anassa["header_sub"]=$frmKmom;
	$titleKmom=CAnassa::txtPageTitle($cmbKmom[$selKmom-1]);
	$fileName=__DIR__."/kmoms/kmom0".$selKmom.".inc";
	if (file_exists($fileName)) {
		$anassa["main"]=$fileName;
		$anassa["main_inc"]=true;
	} else {
		$anassa["main"]=$titleKmom."
<p>
	Det finns ingen redovisning tillgänglig för denna uppgift.
</p>";
	}
	include(ANASSA_THEME_RENDER);
?>