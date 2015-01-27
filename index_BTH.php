<?php
	$email_to="cosmos3@telia.com";		
	$email_subject="BTH: Anassa (kmom06 - oophp)";
	$email_message="Anassa (BTH - kmom06 - oophp)...\n";
	$email_message.="\nHTTP_USER_AGENT: ".$_SERVER["HTTP_USER_AGENT"];
	$email_message.="\nREMOTE_ADDR: ".$_SERVER["REMOTE_ADDR"];
	$email_message.="\nREMOTE_PORT: ".$_SERVER["REMOTE_PORT"];
	$headers="Content-type: text/plain; charset=UTF-8\r\n"."From: oophp@bth.se\r\nReply-To: cosmos3@telia.com\r\nX.Mailer: PHP/".phpversion();
	mail($email_to, $email_subject, $email_message, $headers);
	header("location:kmom06/webroot/home.php");
	exit();
?>