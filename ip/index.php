<?php
	include('../bd/gestionar_usuarios_BD.php');
	include('../config/datos.php');
?>
<!DOCTYPE html>
<html lang="es" ng-app="App_Angular">
	<head>
		<title>IP</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="keywords" content="" />
		<link href='../images/logito.png' rel='shortcut icon' type='img/gif'>
        <link rel="stylesheet" href="../font-awesome/css/font-awesome.css" />
        <link rel="stylesheet" href="../admin/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../admin/css/bootstrap-responsive.min.css" />
        <script src="../admin/js/jquery.min.js"></script> 
		<script src="../admin/js/bootstrap.min.js"></script> 
        <script>
        function filtrar_usuarios(){
	if ($('#usuario_activo').is(":checked")){
		$('.activo').show();
	}else{
		$('.activo').hide();
	}
	if ($('#usuario_inactivo').is(":checked")){
		$('.inactivo').show();
	}else{
		$('.inactivo').hide();
	}

}
        </script>
	</head>
	<body>
	<div class="row-fluid">
    <div class="span12" style="padding:10px;">
     <center>
     <img src="../config/logo.png" style=" width:65px; height:60px;">
     <br>
     <table>
        <tr>
          <td style="padding-left:15px; padding-right:15px;"><label for="usuario_activo"><input type="checkbox" name="usuario_activo" id="usuario_activo" checked onChange="filtrar_usuarios();"> Usuarios activos</label></td>
         <td style="padding-left:15px; padding-right:15px;"><label for="usuario_inactivo"><input type="checkbox" name="usuario_inactivo" id="usuario_inactivo" checked onChange="filtrar_usuarios();"> Usuarios inactivos</label></td>
        </tr>
      </table>
	</center>
    <table border="1" style="border: 1px solid #28b779; margin-top:10px; width:100%; background-color:white; padding:10px;" >
  <tr style="background-color:#28b779; color:white;">
    <td><center>NOMBRE</center></td>
    <td style="border-left:1px solid white; border-right:1px solid white;"><center>USUARIO</center></td>
    <td style="border-left:1px solid white; border-right:1px solid white;"><center>NODO IP</center></td>
    <td style="border-left:1px solid white; border-right:1px solid white;"><center>PROVEEDOR</center></td>
    <td style="border-left:1px solid white; border-right:1px solid white;"><center>NAVEGADOR</center></td>
    <td style="border-left:1px solid white; border-right:1px solid white;"><center>S. OPERATIVO</center></td>
    <td style="border-left:1px solid white; border-right:1px solid white;"><center>ESTADO</center></td>
    <td><center>ULTIMO ACCESO</center></td>
  </tr>
  <?php
    $actividad = consultar_accesos_ip();
  	$clase_fila[0] = "inactivo";
	$clase_fila[1] = "activo";
    $texto_estado[0] = "<i class='icon-remove'></i> INACTIVO";
	$texto_estado[1] = "<i class='icon-ok'></i> ACTIVO";
  	for($i=0; $i<count($actividad);$i++){
		//$part = explode('.', $actividad[$i]['servidorInternet']);
		echo "
			<tr class='".$clase_fila[$actividad[$i]['estado']]."'>
			  <td>".utf8_encode($actividad[$i]['nombre'])." ".utf8_encode($actividad[$i]['apellido1'])." ".utf8_encode($actividad[$i]['apellido2'])."</td>
			  <td>".$actividad[$i]['user']."</td>
			  <td>".$actividad[$i]['ipReal']."</td>
			  <td>".$actividad[$i]['servidorInternet']."</td>
			  <td>".$actividad[$i]['navegador']."</td>
			  <td>".$actividad[$i]['sistemaOperativo']."</td>
			  <td>".$texto_estado[$actividad[$i]['estado']]."</td>
			  <td>".$actividad[$i]['fechaIP']."</td>
			</tr>
		";	
	}
  ?>
</table>

     
      
  </div>
    
    </div>
    
    
    
    

	</body>
</html>