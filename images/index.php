<?php 
session_start();
$_SESSION["nombre_usuario_software"]='Maiker Leon';
?>

<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Estudios</title>

<style type="text/css">
.selectOne{
  text-decoration: none; 
  color: black;
}
.selectOne:hover{
    background-color: #34c5f1;
    border-radius: 5px;
    padding: 4px;
}
</style>
</head>
<body style="background-color: #e4e4e4">

<?php 
if(isset($GET_['cerrar_sesion'])){
  echo "**Ha finalizado su sesion";
}
?>
<center>
  <h4>ESTUDIOS</h4>
  <div style="background-color:white;width:400px; border: 2px solid black; padding:5px; border-radius:5px;">
      <a class="selectOne" href="admin/estudios_registro.php">REGISTRO</a><br />
      
  </div><br />
</center>

<center>
  <h4>KINESIOLOGÍA</h4>
  <div style="background-color:white;width:400px; border: 2px solid black; padding:5px; border-radius:5px;">
    
      <a class="selectOne" href="admin/kine_pautas.php">PAUTAS</a><br /> 
      <a class="selectOne" href="admin/kine_ejercicios.php">EJERCICIOS</a><br /> 
      <a class="selectOne" href="admin/kine_fms_test.php">FMS TEST</a><br /> 
      <a class="selectOne" href="admin/kine_tratamiento_lesiones.php">TRATAMIENTO LESIONES</a><br />
      
  </div><br />
</center>

<center>
  <h4>SANTIAGO WANDERERS</h4>
  <div style="background-color:white;width:400px; border: 2px solid black; padding:5px; border-radius:5px;">
      
      <a class="selectOne" href="admin/sw_tablas.php">TABLAS</a><br /> 
      <a class="selectOne" href="admin/sw_informe_medico.php">INFORME MÉDICO</a><br /> 
      <a class="selectOne" href="admin/sw_partidos.php">PARTIDOS</a><br /> 
      <a class="selectOne" href="admin/sw_estadisticas.php">ESTADISTICAS</a><br /> 
      <a class="selectOne" href="admin/sw_goles_convertidos.php">GOLES CONVERTIDOS</a><br /> 
      <a class="selectOne" href="admin/sw_goles_contra.php">GOLES EN CONTRA</a><br /> 
      <a class="selectOne" href="admin/sw_videos.php">VIDEOS</a><br />
      <a class="selectOne" href="admin/sw_microciclo.php">MICROCICLO</a><br />
      <a class="selectOne" href="admin/sw_calendarios.php">CALENDARIOS</a><br />
      <a class="selectOne" href="admin/sw_calendar.php">CALENDAR</a><br />
  </div><br />
</center>

<center>
  <h4>SSCC COLEGIO</h4>
  <div style="background-color:white;width:400px; border: 2px solid black; padding:5px; border-radius:5px;">
      
      <a class="selectOne" href="admin/sscc_asistencia.php">ASISTENCIA</a><br />
  </div><br />
</center>

<center>
  <h4>SOCIOS</h4>
  <div style="background-color:white;width:400px; border: 2px solid black; padding:5px; border-radius:5px;">
      
      <a class="selectOne" href="admin/socios_ingresar.php">INGRESAR SOCIOS</a><br />
      <a class="selectOne" href="admin/socios_pagos.php">PAGOS</a><br />
      <a class="selectOne" href="admin/socios_resumen.php">RESUMEN</a><br />
  </div><br />
</center>

</body>
</html>