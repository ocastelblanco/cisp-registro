<?php
if (isset($_GET['id'])) {
	require_once 'lib/config.php';
	$mysqli = new mysqli($servidor,$usuario,$clave,$basedatos);
	if ($mysqli->connect_errno) {
	    echo "Fallo al conectar a MySQL: (".$mysqli->connect_errno.") ".$mysqli->connect_error;
	}
	$mysqli->query("SET NAMES 'utf8'");
	$query = "SELECT `nombres`, `apellidos`, `email`, `nombreIP`, `estado` FROM `registrodocentes` WHERE `id` =".$_GET['id'];
	$resultado = $mysqli->query($query);
	$fila = $resultado->fetch_assoc();
	$caracteres = array("á","é","í","ó","ú","ü","ñ","Á","É","Í","Ó","Ú","Ü","Ñ");
	$reemplazos = array("a","e","i","o","u","u","n","A","E","I","O","U","U","N");
	$nombres = str_replace($caracteres, $reemplazos, $fila['nombres']);
	$apellidos = str_replace($caracteres, $reemplazos, $fila['apellidos']);
	
	$textoRechazoHTML = "$nombres $apellidos, reciba un cordial saludo.<br><br>Queremos agradecerle por su inscripci&oacute;n en el curso Ciudadan&iacute;as, nuestro equipo valora genuinamente su inter&eacute;s.<br><br>Como se plante&oacute; desde el inicio de este proceso, cada uno de los cuatro pa&iacute;ses (Argentina, Uruguay, Bolivia y Colombia) seleccion&oacute; a 20 personas para participar en el curso. Desafortunadamente usted no ha sido elegido para participar en esta corte del curso, pero reconociendo su excelente perfil y capacidad pedag&oacute;gica lo tendremos en cuenta para futuras oportunidades.<br><br>Nuevamente gracias por su inter&eacute;s.<br><br>Equipo Curso Ciudadan&iacute;as";
	$textoRechazo = "$nombres $apellidos, reciba un cordial saludo. Queremos agradecerle por su inscripcion en el curso Ciudadanias, nuestro equipo valora genuinamente su interes. Como se planteo desde el inicio de este proceso, cada uno de los cuatro paises (Argentina, Uruguay, Bolivia y Colombia) selecciono a 20 personas para participar en el curso. Desafortunadamente usted no ha sido elegido para participar en esta corte del curso, pero reconociendo su excelente perfil y capacidad pedagogica lo tendremos en cuenta para futuras oportunidades. Nuevamente gracias por su interes. Equipo Curso Ciudadanias";
	$textoAceptacionHTML = "$nombres $apellidos, reciba un cordial saludo.<br><br>Queremos agradecerle por su inscripci&oacute;n en el curso Ciudadan&iacute;as, nuestro equipo valora genuinamente su inter&eacute;s. De igual forma, queremos felicitarlo pues ha sido seleccionado por su pa&iacute;s para formar parte del grupo de 20 personas que participar&aacute;n en el curso Ciudadan&iacute;as.<br><br>Esta selecci&oacute;n se realiz&oacute; teniendo en cuenta su perfil e iniciativa pedag&oacute;gica por lo que para nosotros como equipo del curso ser&aacute; un gusto poder construir aprendizajes con usted y los otros participantes alrededor de los diferentes temas que nos interesan.<br><br>Pr&oacute;ximamente recibir&aacute; la informaci&oacute;n general del curso, la p&aacute;gina donde se ubicar&aacute;, su usuario y contrase&ntilde;a.<br><br>Adicionalmente, como este es un curso donde en la parte inicial puede seleccionar dos m&oacute;dulos para desarrollar, le pedimos que revise el siguiente listado y nos haga saber a qu&eacute; m&oacute;dulos desea inscribirse escribi&eacute;ndonos un mensaje con los nombres de los m&oacute;dulos de su inter&eacute;s al correo <a href='mailto:cursociudadanias@gmail.com'>cursociudadanias@gmail.com</a>:<br><ul><li>Convivencia escolar</li><li>G&eacute;nero</li><li>Medio Ambiente</li><li>Derechos Humanos</li><li>Prevenci&oacute;n del acoso escolar</li></ul><br><br>Nuevamente gracias por su inter&eacute;s y esperamos construir un excelente equipo de trabajo juntos.<br><br>Equipo Curso Ciudadan&iacute;as";
	$textoAceptacion = "$nombres $apellidos, reciba un cordial saludo. Queremos agradecerle por su inscripcion en el curso Ciudadanias, nuestro equipo valora genuinamente su interes. De igual forma, queremos felicitarlo pues ha sido seleccionado por su pais para formar parte del grupo de 20 personas que participaran en el curso Ciudadanias. Esta seleccion se realizo teniendo en cuenta su perfil e iniciativa pedagogica por lo que para nosotros como equipo del curso sera un gusto poder construir aprendizajes con usted y los otros participantes alrededor de los diferentes temas que nos interesan. Proximamente recibira la informacion general del curso, la pagina donde se ubicara, su usuario y clave. Adicionalmente, como este es un curso donde en la parte inicial puede seleccionar dos modulos para desarrollar, le pedimos que revise el siguiente listado y nos haga saber a que modulos desea inscribirse escribiendonos un mensaje con los nombres de los modulos de su interes al correo cursociudadanias@gmail.com: 1) Convivencia escolar 2)Genero 3)Medio Ambiente 4)Derechos Humanos y 5)Prevencion del acoso escolar. Nuevamente gracias por su interes y esperamos construir un excelente equipo de trabajo juntos. Equipo Curso Ciudadanias";
	if ($fila['estado'] == "1") {
		$textoMensajeHTML = $textoAceptacionHTML;
		$textoMensaje = $textoAceptacion;
	} else if ($fila['estado'] == "2") {
		$textoMensajeHTML = $textoRechazoHTML;
		$textoMensaje = $textoRechazo;
	}
	
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
	$mail->SMTPDebug = 0;
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
	$mail->addAddress($fila['email'], "$nombres $apellidos");
	$mail->isHTML(true);  
	//Set the subject line
	$mail->Subject = 'Registro de Iniciativas Pedagogicas para el Curso virtual Ciudadanias';
	//Read an HTML message body from an external file, convert referenced images to embedded,
	//convert HTML into a basic plain-text alternative body
	//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
	$mail->msgHTML($textoMensajeHTML);
	//Replace the plain text body with one created manually
	$mail->AltBody = $textoMensaje;
	//Attach an image file
	//$mail->addAttachment('img/ciudadanias.png');
	sleep(15);
	/*
	 */
	//send the message, check for errors
	if (!$mail->send()) {
		echo "{\"resultado\": \"error\", \"error\": \"".$mail->ErrorInfo."\", \"nombres\": \"".$fila["nombres"]."\", \"apellidos\": \"".$fila["apellidos"]."\"}";
	} else {
		echo "{\"resultado\": \"correcto\", \"nombres\": \"".$fila["nombres"]."\", \"apellidos\": \"".$fila["apellidos"]."\"}";
		$query = "UPDATE `registrodocentes` SET `notificado` = '1' WHERE `id` =".$_GET['id'];
		$resultado = $mysqli->query($query);
	}
	$mysqli->close();
}
?>