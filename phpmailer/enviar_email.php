<?php
if($_REQUEST['mensaje']){
	$mensaje=$_REQUEST['mensaje'];
	//$respuesta = enviarCorreoACliente($mensaje);
	$respuesta = enviarCorreoACliente_SMTP($mensaje);
	enviarCorreoAEquipo_SMTP($mensaje);
	echo $respuesta;
}
            
function enviarCorreoACliente_SMTP($mensaje){	//PHPmailer
  require("phpmailer/class.phpmailer.php");
  $mail = new phpmailer();
  $mail->PluginDir = "phpmailer/";
  $mail->Mailer = "smtp";
  $mail->Host = "mail.golfanalytics.cl";
  $mail->SMTPAuth = true;
  $mail->Username = "ventas@golfanalytics.cl"; 
  $mail->Password = "copern1co10";
  $mail->From = "ventas@golfanalytics.cl";
  $mail->FromName = "GolfAnalytics";
  $mail->Timeout=10;
  $mail->AddAddress($mensaje['email']);//Indicamos cual es la dirección de destino del correo
  $mail->CharSet = 'UTF-8';
  $mail->Subject = "Nuestro equipo ha recibido tu mensaje con éxito.";
  $mail->Body = ' 
  <html>
	<body>
	<b><h3>Estimado(a) '.$mensaje['nombre'].',</h3></b>
	<p>Nuestros vendedores han recibido tu consulta correctamente. En unos minutos responderemos todas tus dudas. </p>
	<b>Detalle de tu consulta:</b><br /><br />
	<hr>
	<b>Nombre: </b>'.$mensaje['nombre'].'<br />
	<b>Email: </b>'.$mensaje['email'].'<br />
	<b>Club: </b>'.$mensaje['club'].'<br />
	<b>Telefono: </b>'.$mensaje['telefono'].'<br />
	<b>Mensaje: </b>'.$mensaje['mensaje'].'
	<hr>
	<br /><br />
	<b>
	Saludos<br />Equipo GolfAnalytics<br />
	<a href="http://www.golfanalytics.cl">www.golfanalytics.cl</a><br />
	'.datetime().'
	</b>
	</body>
	</html>
  ';//Mensaje en HTML
  $mail->AltBody = '
  	Estimado '.$mensaje['nombre'].',
	Nuestros vendedores han recibido tu consulta correctamente. En unos minutos responderemos todas tus dudas. 
	Detalle de tu consulta:
	Nombre: '.$mensaje['nombre'].'
	Email: '.$mensaje['email'].'
	Club: '.$mensaje['club'].'
	Telefono: '.$mensaje['telefono'].'
	Mensaje: '.$mensaje['mensaje'].'
	Saludos,
	Equipo GolfAnalytics
	www.golfanalytics.cl
	'.datetime().'
  ';//Por si el destinatario del correo no admite email con formato html 
  $exito = $mail->Send();
  $intentos=1; 
  while((!$exito) && ($intentos < 5)){
	sleep(5);
	$exito = $mail->Send();
	$intentos=$intentos+1;	
  }
  if(!$exito){
	return 0;//Error al enviar mensaje
	//echo "<br/>".$mail->ErrorInfo;
  }else{
	return 1;//Mensaje enviado correctamente
  } 	
}

function enviarCorreoAEquipo_SMTP($mensaje){	//PHPmailer
  //require("phpmailer/class.phpmailer.php");
  $mail = new phpmailer();
  $mail->PluginDir = "phpmailer/";
  $mail->Mailer = "smtp";
  $mail->Host = "mail.golfanalytics.cl";
  $mail->SMTPAuth = true;
  $mail->Username = "ventas@golfanalytics.cl"; 
  $mail->Password = "copern1co10";
  $mail->From = "ventas@golfanalytics.cl";
  $mail->FromName = "GolfAnalytics";
  $mail->Timeout=30;
  $mail->AddAddress("bat.schulze@gmail.com");
  $mail->AddAddress("danif.gonzalezm@gmail.com");
  $mail->Subject = "Tienes un mensaje en GolfAnalytics.cl!.";
  $mail->CharSet = 'UTF-8';
  $mail->Body = ' 
  <html>
	<body>
	<b><h3>Haz recibido un mensaje en GolfAnalytics.cl!</h3></b>
	<b>Detalle del mensaje:</b><br /><br />
	<hr>
	<b>Nodo IP: </b>'.$mensaje['nodoIP'].'<br />
	<b>IP Real: </b>'.$mensaje['realIP'].'<br />
	<b>Fecha: </b>'.datetime().'<br />
	<b>Nombre: </b>'.$mensaje['nombre'].'<br />
	<b>Email: </b>'.$mensaje['email'].'<br />
	<b>Club: </b>'.$mensaje['club'].'<br />
	<b>Telefono: </b>'.$mensaje['telefono'].'<br />
	<b>Mensaje: </b>'.$mensaje['mensaje'].'
	<hr>
	<br /><br />
	<b>
	Saludos<br />Equipo GolfAnalytics<br />
	<a href="http://www.golfanalytics.cl">www.golfanalytics.cl</a><br />
	'.datetime().'
	</b>
	</body>
	</html>
  ';//Mensaje en HTML
  $mail->AltBody = '
  	Haz recibido un mensaje en GolfAnalytics.cl!
	Detalle del mensaje:
	Nodo IP: '.$mensaje['nodoIP'].'
	IP Real: '.$mensaje['realIP'].'
	Fecha: '.datetime().'
	Nombre: '.$mensaje['nombre'].'
	Email: '.$mensaje['email'].'
	Club: '.$mensaje['club'].'
	Telefono: '.$mensaje['telefono'].'
	Mensaje: '.$mensaje['mensaje'].'
	Saludos,
	Equipo GolfAnalytics
	www.golfanalytics.cl
	'.datetime().'
  ';//Por si el destinatario del correo no admite email con formato html 
  $exito = $mail->Send();
  $intentos=1; 
  while((!$exito) && ($intentos < 5)){
	sleep(5);
	$exito = $mail->Send();
	$intentos=$intentos+1;	
  }
  if(!$exito){
	return 0;//Error al enviar mensaje
	//echo "<br/>".$mail->ErrorInfo;
  }else{
	return 1;//Mensaje enviado correctamente
  } 	
}

function datetime(){
     $datetime_now = new DateTime();
	 $datetime_now = $datetime_now->format('Y-m-d H:i:s');
	 return $datetime_now;
}





?>