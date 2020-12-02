<?php
$ServidorInet=gethostbyaddr($_SERVER['REMOTE_ADDR']);//Nodo ip
$RealIP=getRealIP(); //ipreal

function getRealIP(){
   if( $_SERVER['HTTP_X_FORWARDED_FOR'] != '' ){
      $client_ip = 
         ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
            $_SERVER['REMOTE_ADDR'] 
            : 
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
               $_ENV['REMOTE_ADDR'] 
               : 
               "unknown" );
      $entries = preg_split('/[, ]/', $_SERVER['HTTP_X_FORWARDED_FOR']);
      reset($entries);
      while (list(, $entry) = each($entries)) {
         $entry = trim($entry);
         if ( preg_match("/^([0-9]+\.[0-9]+\.[0-9]+\.[0-9]+)/", $entry, $ip_list) ){
            $private_ip = array(
                  '/^0\./', 
                  '/^127\.0\.0\.1/', 
                  '/^192\.168\..*/', 
                  '/^172\.((1[6-9])|(2[0-9])|(3[0-1]))\..*/', 
                  '/^10\..*/');
            $found_ip = preg_replace($private_ip, $client_ip, $ip_list[1]);
            if ($client_ip != $found_ip){
               $client_ip = $found_ip;
               break;
            }
         }
      }
   }
   else{
      $client_ip = 
         ( !empty($_SERVER['REMOTE_ADDR']) ) ? 
            $_SERVER['REMOTE_ADDR'] 
            : 
            ( ( !empty($_ENV['REMOTE_ADDR']) ) ? 
               $_ENV['REMOTE_ADDR'] 
               : 
               "unknown" );
   }
   return $client_ip;
}




?>


<!DOCTYPE HTML>
<html lang="es" ng-app="App_Angular">
<head>
<title>GolfAnalytics</title>
<meta charset="UTF-8" />
<link href='images/logito.png' rel='shortcut icon' type='img/gif'>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="" />
<script type="application/x-javascript"> 
	addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); 
	function hideURLbar(){ 
		window.scrollTo(0,1); 
	} 
</script>
<link href="css/bootstrap.css" type="text/css" rel="stylesheet" media="all">
<link href="css/style.css" type="text/css" rel="stylesheet" media="all">
<link rel="stylesheet" href="font-awesome/css/font-awesome.css" />
<!--<link rel="stylesheet" href="css/swipebox.css">-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/angular.min.js" type="application/javascript"></script>
<script>

var imagen_ipad=3;
function cambiar_ipad(){
	if(imagen_ipad==1){
		window.imagen_ipad=2;
		$('#foto_ipad').attr('src', 'images/telefono2.png');
	}else if(imagen_ipad==2){
		window.imagen_ipad=3;
		$('#foto_ipad').attr('src', 'images/telefono3.png');
	}else if(imagen_ipad==3){
		window.imagen_ipad=1;
		$('#foto_ipad').attr('src', 'images/telefono.png');
	}
	
}

setInterval(cambiar_ipad, 5000);

</script>
<style>
	/* latin-ext */
	@font-face {
	  font-family: 'Racing Sans One';
	  font-style: normal;
	  font-weight: 400;
	  src: local('Racing Sans One'), local('RacingSansOne-Regular'),
	  /*url(http://fonts.gstatic.com/s/racingsansone/v4/1r3DpWaCiT7y3PD4KgkNyJQnCV4ii-F0S-GDf6mWM7Q.woff2) format('woff2');*/
	  unicode-range: U+0100-024F, U+1E00-1EFF, U+20A0-20AB, U+20AD-20CF, U+2C60-2C7F, U+A720-A7FF;
	}
	/* latin */
	@font-face {
	  font-family: 'Racing Sans One';
	  font-style: normal;
	  font-weight: 400;
	  src: local('Racing Sans One'), local('RacingSansOne-Regular'), /*url(http://fonts.gstatic.com/s/racingsansone/v4/1r3DpWaCiT7y3PD4KgkNyJbhOpL-vLTkIjCTuVYsuO0.woff2) format('woff2');*/
	  unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2212, U+2215;
	}
	#boton_guardar_alerta{
		border: 2px solid #262626;
		background-color:#262626;
		color:white;
	}
	
	#boton_guardar_alerta:hover{
		border: 2px solid #262626;
		background-color:transparent;
		color:#262626;
	}
	
	#boton_cerrar_alerta{
		border: 2px solid white;
		background-color: transparent;
		color:white;
	}
	
	#boton_cerrar_alerta:hover{
		border: 2px solid black;
		background-color:transparent;
		color:black;
	}
	
</style>
<script>
//Angular//
/*
//////////////////////Expresiones regulares//////////////////////
?     0 o 1 vez
*     0 o muchas veces
+     1 o muchas veces
\s    espacio en blanco
{n}   n veces
{n,m} n a m veces
//////////////////////Angular JS//////////////////////////
ng-trim    false-->     elimina espacios en blanco al comienzo y al final
*/
var app= angular.module("App_Angular",[]);
app.controller("controlador_1",['$scope',function($scope){
	//$scope.ER_alfaNumericoConEspacios=/^([a-zA-Z0-9]+\s?)+$/;
	$scope.ER_alfaNumericoConEspacios=/^([a-zA-Z0-9](\s[a-zA-Z0-9])*)+$/;
	$scope.ER_email=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	$scope.ER_alfaNumericoSinEspacios=/^([a-zA-Z0-9])+$/;
	$scope.ER_numericoSinEspacios=/^[0-9]+$/;
	$scope.ER_caracteresConEspacios=/^([ña-zÑA-Z](\s[ña-zÑA-Z])*)+$/;
	$scope.ER_telefono=/^[0-9]+$/;
	//$scope.alfaNumericos=/^a((aa)*|b)*$/;
	$scope.ER_rut=/^(([1-2]{1}[0-9]?)|([1-9]{1}))[0-9]{6}-[0-9]|k$/;
	
	$scope.clickFunction = function() {
        $scope.buttonClicks=1;
    };
	$scope.desactivarBoton = function() {
        $('#boton_guardar_alerta').attr('disabled', true);
		$scope.nombre = null;
		$scope.email = null;
		$scope.telefono = null;
		$scope.club = null;
		$scope.mensaje = null;
        //$scope.isDisabled = true;
        return false;
    }
}]);




</script>
<!-- //web-fonts -->	 
</head>
<body ng-controller="controlador_1">
	<!-- banner -->
	<div class="baner" id="home">
		<div class="container">
			<div class="w3ls-logo">
				<h1><a href="#"><img src="images/logo.png" style="width:300px; height:45px; padding-top:8px;"></a> </h1>
           
			</div>
			<div class="baner-w3text">
            <!--
				<p style="font-size:28px; color:white; font-family:Helvetica Neue LT Std; font-stretch: condensed; border: 2px solid white;  background-color: rgba(0, 0, 0, 0.6);">Be Smart, Save Energy!</p>	
               -->
			</div>	
		</div>
	</div>
	<!-- //banner -->
	<!-- navigation -->
	<div class="top-nav" style="background-color: #262626; padding:1px; border-top: 1px solid white; border-bottom: 1px solid white;">
		<nav class="navbar navbar-default">
			<div class="container">
				<div class="navbar-header" style="padding-top:10px;">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" style="background-color:#28b779; border-color: white;">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="index.html"><img src="images/logo2.png" style="width:170px; height:30px; padding-top:10px;"></a>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                
					<ul class="nav navbar-nav navbar-center cl-effect-15">
						<li><a href="#home" class="active scroll" data-hover="Inicio">Inicio</a></li>
                        <li><a href="#slid" class="scroll" data-hover="Nosotros">Nosotros</a></li>	
						<li><a href="#feature" class="scroll" data-hover="Productos">Productos</a></li>					
						<li><a href="#tecnologia" class="scroll" data-hover="Tecnología">Tecnología</a></li>
						<li><a href="#contact" class="scroll" data-hover="Contacto">Contacto</a></li>
                      
					</ul>	
					<div class="clearfix"> </div>
				</div>
			</div>	
		</nav>		
	</div>	
	<!-- script-for sticky-nav -->
	<script>
	$(document).ready(function() {
		 var navoffeset=$(".top-nav").offset().top;
		 $(window).scroll(function(){
			var scrollpos=$(window).scrollTop(); 
			if(scrollpos >=navoffeset){
				$(".top-nav").addClass("fixed");
			}else{
				$(".top-nav").removeClass("fixed");
			}
		 });
		 
	});
	</script> 
	<!-- navigation -->
	<!-- about -->
	<div class="about" id="about">
		<div class="container" style="margin-top:0px; margin-bottom:0px; padding-bottom:0px;">
			<!--<h3 class="w3l-title">Welcome to our page</h3>-->
            <center>
            <h4 style="margin-top:0px;">TU CLUB DE GOLF DEJARÁ DE SER UNA PREOCUPACIÓN</h4>
            <hr style="width:16%; border-color:#28b779;">
			<p style="font-size:15px; width:100%;">
            "GolfAnalytics es un sistema tecnológico integral que permite un control total de tu Club de Golf en tiempo real."
            </p>
            <table style="padding:0px; margin-top:7px;">
              <tr>
                <td><h5 style="color:#777777;"><b style="color:#777777;">PATROCINA:</b> &nbsp;</h5></td>
                <td><img src="images/patrocinador.jpg" style="width:126px; height:80px;"></td>
              </tr>
            </table>
            </center>
		</div>	
	</div>
	<!-- //about -->
	<!-- slid -->
	<div class="slid" id="slid" style="padding-top:10px;">
    <center><img src="images/logo2.png" style="width:240px; height:35px; padding-top:10px;"></center>
		<div class="container">			
			<div class="slid-info">
				<center>
				<p>Desarrollamos herramientas integrales pensadas en automatizar la operación de tu negocio integrando tecnologías de vanguardia que permiten administrar y controlar tu club desde cualquier lugar.</p>       
                </center>
			</div>
		</div>	
	</div>
	<!-- //slid -->	
    
    
    
    
    
    <section class="our-features" id="feature" style="padding-top:40px;">
	 <center>
            <h3 style="margin-top:0px;">Nuestros productos</h3>
            <hr style="width:13%; border-color:#28b779;">
            </center><br>
	
	<div class="container">
		<div class="row">
			<div class="col-lg-4 col-md-4 col-sm-6 feature-w3l">
            <h4>
              <center>
              <img class="img-responsive" src="images/logo_golf.png" style=" width:150px; height:120px;">
              </center>
            </h4>
				<p>Software Administrativo Integral que permite un control completo de la gestión de tu club.</p>
			</div><!-- /.col-lg-4 -->
			<div class="col-lg-4 col-md-4 col-sm-6 feature-w3l">
				<h4>
                  <center>
                  <img class="img-responsive" src="images/logo_solar.png" style=" width:150px; height:120px;">
                  </center>
                </h4>
				<p>Desarrollamos tecnología de punta para convertir tu carro de golf en un eficiente carro solar autónomo.</p>
			</div><!-- /.col-lg-4 -->
			<div class="col-lg-4 col-md-4 col-sm-6 feature-w3l f3">
				<h4>
                  <center>
                  <img class="img-responsive" src="images/logo_grass.png" style=" width:150px; height:120px;">
                  </center>
                </h4>
				<p>Sistema de monitoreo inteligente que entrega una visión completa de las condiciones de los greens en tiempo real.</p>
			</div><!-- /.col-lg-4 -->
		</div><!-- /.row -->
	</div>	
</section>
    
    
    
    
    
     <!-- donec -->
	<div class="donec" style="padding-top:40px;" id="tecnologia">
    	<center>
            <h3 style="margin-top:0px; padding:0px;">Tecnología de punta</h3>
            <hr style="width:13%; border-color:#28b779;">
        </center>
		<div class="container" style="padding:0px; margin:0px;">
			<div class="donec-top" style="background-color:transparent; margin:0px;">
				<div class="col-md-6 donec-left">
					<center><img src="images/telefono.png" style=" width:330px; height:320px;" id="foto_ipad"></center>
				</div>
				<div class="col-md-6 donec-right" style="padding-top:20px;  background-color: rgba(0, 0, 0, 0.4); border-radius:10px;">	
					<h3 style="color:#92cb42;">SENSORES MODERNOS</h3>
					<p style="font-family: 'Viga', sans-serif; font-size:14px;">Dispositivos de ultima generación con excelente desempeño y precisión.</p><br>
                    <h3 style="color:#92cb42;">ENERGÍA RENOVABLE</h3> 
					<p style="font-family: 'Viga', sans-serif; font-size:14px;">Nuestros productos son alimentados 100% por energía solar.</p><br>
                    <h3 style="color:#92cb42;">CONTROLA 24/7</h3> 
					<p style="font-family: 'Viga', sans-serif; font-size:14px;">Independiente de donde estés, siempre tendrás el control de tu club en tu bolsillo.</p>
				</div>
					<div class="clearfix"> </div>
			</div>				
		</div>
	</div>
<!-- donec -->
    
    
    <div id="contact"></div>
    <!-- contact -->
	 <div class="contact"  style="background-color:white;">
	<div class="container">
		<div class="w3ls-heading">
			 <center>
            <h3 style="margin-top:0px;">¡Contáctanos para que evaluemos tu club!</h3>
            <hr style="width:13%; border-color:#28b779;">
            </center><br>
		</div>
			<div class="contact-w3ls">
				<form action="#" method="post" id="formulario_enviar_mensaje" ng-model="formulario_enviar_mensaje" name="formulario_enviar_mensaje" novalidate>
					<div class="col-md-7 col-sm-7 contact-left agileits-w3layouts">
						<input type="text" name="nombre" placeholder="Nombre completo" id="nombre" required ng-model="nombre" ng-minlength="2" ng-maxlength="100" ng-required="true" maxlength="100" ng-trim="true" ng-click="nombreClick = true">
						<input type="email" class="email" name="Email" id="email" placeholder="Correo electrónico" required ng-model="email" ng-pattern="ER_email" ng-minlength="2" ng-maxlength="50" ng-required="true" maxlength="50" ng-trim="true" ng-click="emailClick = true">
						<input type="text" name="telefono" placeholder="Telefono" id="telefono" required ng-model="telefono" ng-minlength="2" ng-maxlength="50" ng-required="true" maxlength="50" ng-trim="true" ng-click="telefonoClick = true" >
						<input type="text" class="club" name="club"  id="club" placeholder="Club de golf" required ng-model="club" ng-minlength="2" ng-maxlength="100" ng-required="true" maxlength="100" ng-trim="true" ng-click="clubClick = true">
					</div> 
					<div class="col-md-5 col-sm-6 contact-right agileits-w3layouts">
						<textarea name="mensaje" placeholder="Mensaje" id="mensaje" required style="height:242px;" ng-model="mensaje" ng-minlength="2" ng-maxlength="300" ng-required="true" maxlength="300" ng-trim="true"></textarea>
					</div>
                  
					<div class="clearfix"> </div> 
				</form>
			</div> <br>
            <div class="contact-w3ls">
            <center><button type="button" class="btn btn-default boton_alert" id="boton_guardar_alerta" ng-disabled="formulario_enviar_mensaje.$invalid" ng-click="desactivarBoton()">ENVIAR MENSAJE </button></center>
            </div>
	</div>
   
</div>
<!-- //contact -->





  <!-- Modal -->
  <div  style="border-radius:10px;" class="modal fade" id="myModal3" role="dialog">
    <div class="modal-dialog" style="border-radius:10px;">
      <!-- Modal content-->
      <div style="border-radius:10px;" class="modal-content">
        <div class="modal-header" style="background-color:#28b779;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="images/logo3.png" style="height:35px; width:270px;"></h4></center>
        </div>
        <div class="modal-body">
          <p>Hemos recibido tu mensaje con éxito. Pronto nuestro equipo de ventas se pondrá en contacto contigo.</p>
          <br>
          <b>
          <center>
          Saludos<br>
          Equipo GolfAnalytics
          </center>
          </b>
        </div>
        <div class="modal-footer" style="background-color:#28b779;">
          <center><button type="button" class="btn btn-default" data-dismiss="modal" id="boton_cerrar_alerta">Cerrar ventana</button></center>
        </div>
      </div>
      
    </div>
  </div>

 <!-- Modal -->
  <div  style="border-radius:10px;" class="modal fade" id="myModal4" role="dialog">
    <div class="modal-dialog" style="border-radius:10px;">
      <!-- Modal content-->
      <div style="border-radius:10px;" class="modal-content">
        <div class="modal-header" style="background-color:#28b779;">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="images/logo3.png" style="height:35px; width:270px;"></h4></center>
        </div>
        <div class="modal-body">
          <p>Hubo un error al enviar su mensaje. Estos errores suelen producirse por los siguientes motivos:</p><br>
          -Formato de correo proporcionado.<br>
          -Mala conexión a internet.<br>
          -Servidor en mantención.<br><br>
          Intente nuevamente en unos minutos o escribanos a <b>ventas@golfanalytics.cl</b> para que un ejecutivo lo contacte a la brevedad.
          <b><br>
          <center>
          Saludos<br>
          Equipo GolfAnalytics
          </center>
          </b>
          
        </div>
        <div class="modal-footer" style="background-color:#28b779;">
          <center><button type="button" class="btn btn-default" data-dismiss="modal" id="boton_cerrar_alerta">Cerrar ventana</button></center>
        </div>
      </div>
      
    </div>
  </div>






	<!-- footer -->
	<div class="footer" style="background-color:#262626;">
		<div class="container">
			<p> &copy; <?php echo date("Y"); ?> | GolfAnalytics&#x2122;. Todos los derechos reservados.</p>
		</div>
	</div>
	<!-- //footer -->
	<script type="text/javascript">
			jQuery(document).ready(function($) {
				$(".scroll").click(function(event){		
					event.preventDefault();
			
			$('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
				});
			});
	</script>
    <script src="js/bootstrap.js"></script>
    <script>
	cambiar_ipad();
    $('#boton_guardar_alerta').click(function(){
		$('#boton_guardar_alerta').html('<i class="icon-spinner icon-spin icon-large"></i> Cargando...');
		var mensaje = {
			nombre: $('#nombre').val(),
			email: $('#email').val(),
			telefono: $('#telefono').val(),
			club: $('#club').val(),
			mensaje: $('#mensaje').val(),
			nodoIP: "<?php echo $ServidorInet;?>",
			realIP: "<?php echo $RealIP;?>"
		}
		$.ajax({
			url: "enviar_email.php",
			type: "POST",
			data: { mensaje: mensaje },
			success: function(respuesta){
				if(respuesta==1){
					$('#myModal3').modal('show');
					$('#formulario_enviar_mensaje')[0].reset();
				}else{//error al enviar mensaje
					$('#myModal4').modal('show');
					//$('#formulario_enviar_mensaje')[0].reset();
				}
				$('#boton_guardar_alerta').html('ENVIAR MENSAJE ');
				//alert(respuesta);
			}
	});
	
	
	
	});
    </script>
</body>
</html>