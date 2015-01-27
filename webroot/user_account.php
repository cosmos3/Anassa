<?php
	include(__DIR__."/config.inc");
	$anassa["css"][]="css/user.css";
	$title="Användare";
	$userAccount=new CUserAccount($anassa["db"]);
	$post=$userAccount->checkPostAction();
	if (!$post) {
		$action=CAnassa::readGet("action", null);
		if ($action=="edit" || $action=="new") {
			$html=$userAccount->htmlForm($action, true, null);
		}
	} elseif ($post=="new") {
		$_SESSION["message"]="<h3>Välkommen till ANASSA, ".$_SESSION["user"]->_name."</h3>".
			CAnassa::txtMessage("+Du är nu inloggad");
	} elseif ($post=="edit") {
		$_SESSION["message"]="<h3>".$_SESSION["user"]->_name."</h3>".
			CAnassa::txtMessage("+Dina ändringar har sparats");
	} elseif ($post=="delete") {
		$_SESSION["message"]="<h3>Användar-information</h3>".
			CAnassa::txtMessage("+Ditt konto har avaktiverats");
	} else {
		$html="<h3>".$title."</h3>
		<p>
			Något är fel på sidan - var vänlig och rapportera till admin.
		</p>";
	}
	if (!isset($html)) {
		header("location:message.php");
		exit();
	}
	$anassa["main"]=$html;
	include(ANASSA_THEME_RENDER);
?>