<?php
if (isset($_POST['id'])) {
	require_once 'lib/config.php';
	$mysqli = new mysqli($servidor,$usuario,$clave,$basedatos);
	if ($mysqli->connect_errno) {
	    echo "Fallo al conectar a MySQL: (".$mysqli->connect_errno.") ".$mysqli->connect_error;
	}
	$mysqli->query("SET NAMES 'utf8'");
	$query = "SELECT `nombres`,`apellidos`,`nombreIP`,`email` FROM `registrodocentes` WHERE `id`="+$_POST['id'];
	$resultado = $mysqli->query($query);
	
	
	
	
	//SMTP needs accurate times, and the PHP time zone MUST be set
	//This should be done in your php.ini, but this is how to do it if you don't have access to that
	date_default_timezone_set('Etc/UTC');
	
	require 'lib/PHPMailerAutoload.php';
	
	//Create a new PHPMailer instance
	$mail = new PHPMailer();
	//Tell PHPMailer to use SMTP
	$mail->isSMTP();
	//Enable SMTP debugging
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$mail->SMTPDebug = 2;
	//Ask for HTML-friendly debug output
	$mail->Debugoutput = 'html';
	//Set the hostname of the mail server
	$mail->Host = 'host.redeaprender.org';
	//Set the SMTP port number - likely to be 25, 465 or 587
	$mail->Port = 587;
	//Whether to use SMTP authentication
	$mail->SMTPAuth = true;
	// SMTP password
	$mail->SMTPSecure = 'tls';  
	//Username to use for SMTP authentication
	$mail->Username = 'femcidi@redeaprender.org';
	//Password to use for SMTP authentication
	$mail->Password = 'FEMCIDI';
	//Set who the message is to be sent from
	$mail->setFrom('femcidi@redeaprender.org', 'Sistema de registro FEMCIDI');
	//Set an alternative reply-to address
	$mail->addReplyTo('femcidi@redeaprender.org', 'Sistema de registro FEMCIDI');
	//Set who the message is to be sent to
	$mail->addAddress('ocastelblanco@gmail.com', 'Oliver Castelblanco');
	$mail->isHTML(true);  
	//Set the subject line
	$mail->Subject = 'PHPMailer SMTP test';
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
	$mail->msgHTML('Este es un <strong>mensaje</strong> muy importante.');
	//Replace the plain text body with one created manually
	$mail->AltBody = 'This is a plain-text message body';
	//Attach an image file
	$mail->addAttachment('img/ciudadanias.png');
	/*
	//send the message, check for errors
	if (!$mail->send()) {
	    echo "Mailer Error: " . $mail->ErrorInfo;
	} else {
	    echo "Message sent!";
	}
	 */
}
?>