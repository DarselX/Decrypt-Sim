<?php
	$to=$_GET['mail_to'];
	$subject=$_GET['subject'];
	$message=$_GET['message'];
	$headers='From: support@gamer-stammtisch.de' . "\r\n" . 'Reply-To: support@gamer-stammtisch.de' . "\r\n" . 'X-Mailer: PHP/' . phpversion();
	
	mail($to,$subject,$message,$headers);
	
	echo "Message sent at ";
	echo date ("h:i:s");
?>