<?php
	//phpinfo();
	$email_to="cosmos3@telia.com";		
	$email_subject="BTH: Anassa (BTH - oophp)";
	$email_message="Anassa (BTH - oophp)...\n";
	$email_message.="\nHTTP_USER_AGENT: ".$_SERVER["HTTP_USER_AGENT"];
	$email_message.="\nREMOTE_ADDR: ".$_SERVER["REMOTE_ADDR"];
	$email_message.="\nREMOTE_PORT: ".$_SERVER["REMOTE_PORT"];
	$headers="Content-type: text/plain; charset=UTF-8\r\n"."From: server@cosmos3.se\r\nReply-To: server@cosmos3.se\r\nX.Mailer: PHP/".phpversion();
	//mail($email_to, $email_subject, $email_message, $headers);
	header("location:webroot/home.php");
	exit();
?>