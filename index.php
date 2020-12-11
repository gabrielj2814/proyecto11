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

.caja{
  background-color:white;width:80%;
  border: 2px solid black;
  padding:5px;
  border-radius:5px;
}

.contenedores{
  display: inline-flex;
  width: 50%;
}
.contenedores_wb{
  display: inline-flex;
}
.no:hover{
  background-color: #FD5A5A;
  cursor: no-drop;
}

</style>
</head>
<body style="background-color: #e4e4e4">

<?php 
if(isset($GET_['cerrar_sesion'])){
  echo "**Ha finalizado su sesion";
}
?>

<!-- SW -->
<!-- ====================================================================================================== -->
<!-- UDC -->
<!-- ====================================================================================================== -->
<center>
  <h4>UNIVERSIDAD DE CHILE</h4>
  <div class="caja">
    <!-- ====================================================================================================== -->      
    <!-- ====================================================================================================== -->    
    <div class="contenedores">
      <a class="selectOne" href="admin/informe_semanal.php">INFORME SEMANAL</a>
    </div>
    <div class="contenedores_wb">
      <a class="selectOne" style="margin-left:100px;" target="_BLANK" href="RELACIONES/udc_informe_semanal.mwb">WORKBENCH</a><br /><!-- despues relacionar con modelo -->
    </div>
    <div class="contenedores">
      <a class="selectOne" href="admin/informe_mensual.php">INFORME MENSUAL</a>
    </div>
    <div class="contenedores_wb">
      <a class="selectOne" style="margin-left:100px;" target="_BLANK" href="RELACIONES/udc_informe_mensual.mwb">WORKBENCH</a><br /><!-- despues relacionar con modelo -->
    </div>
    <div class="contenedores">
      <a class="selectOne" href="admin/test_ocular.php">TEST OCULAR</a>
    </div>
    <div class="contenedores_wb">
      <a class="selectOne" style="margin-left:100px;" target="_BLANK" href="RELACIONES/test_ocular.mwb">WORKBENCH</a><br /><!-- despues relacionar con modelo -->
    </div>
    
  </div><br />
</center> 
<center>
  <h4>OHIGGINS DE RANCAGUA</h4>
  <div class="caja">
    <!-- ====================================================================================================== -->      
    <!-- ====================================================================================================== -->    
    <div class="contenedores">
      <a class="selectOne" href="admin/atencion_diaria.php">ATENCIÓN DIARIA</a>
    </div>
    <div class="contenedores_wb">
      <a class="selectOne" style="margin-left:100px;" target="_BLANK" href="RELACIONES/atención diaria.mwb">WORKBENCH</a><br /><!-- despues relacionar con modelo -->
    </div>
    <div class="contenedores">
      <a class="selectOne" href="admin/atencion_diaria_federacion.php">ATENCIÓN DIARIA FEDERACION</a>
    </div>
    <div class="contenedores_wb">
      <a class="selectOne" style="margin-left:100px;" target="_BLANK" href="RELACIONES/atencion diaria federacion.mwb">WORKBENCH</a><br /><!-- despues relacionar con modelo -->
    </div>
    <div class="contenedores">
      <a class="selectOne" href="admin/seguimiento.php">SEGUIMIENTO</a>
    </div>
    <div class="contenedores_wb">
      <a class="selectOne" style="margin-left:100px;" target="_BLANK" href="RELACIONES/atención diaria.mwb">WORKBENCH</a><br /><!-- despues relacionar con modelo -->
    </div>
    <div class="contenedores">
      <a class="selectOne" href="admin/centro medico.php.php">CENTRO MEDICO</a>
    </div>
    <div class="contenedores_wb">
      <a class="selectOne" style="margin-left:100px;" target="_BLANK" href="#">WORKBENCH</a><br /><!-- despues relacionar con modelo -->
    </div>
    <div class="contenedores">
      <a class="selectOne" href="admin/centro_medico_f.php">CENTRO MEDICO FEDERACION</a>
    </div>
    <div class="contenedores_wb">
      <a class="selectOne" style="margin-left:100px;" target="_BLANK" href="#">WORKBENCH</a><br /><!-- despues relacionar con modelo -->
    </div>
    <div class="contenedores">
      <a class="selectOne" href="admin/centro_medico_c.php">CENTRO MEDICO CLUB</a>
    </div>
    <div class="contenedores_wb">
      <a class="selectOne" style="margin-left:100px;" target="_BLANK" href="#">WORKBENCH</a><br /><!-- despues relacionar con modelo -->
    </div>
    <div class="contenedores">
      <a class="selectOne" href="admin/perfil_fisico.php">PERFIL FISICO</a>
    </div>
    <div class="contenedores_wb">
      <a class="selectOne" style="margin-left:100px;" target="_BLANK" href="#">WORKBENCH</a><br /><!-- despues relacionar con modelo -->
    </div>
    <div class="contenedores">
      <a class="selectOne" href="admin/evaluacion_concepto.php">EVALUACIÓN CONCEPTO</a>
    </div>
    <div class="contenedores_wb">
      <a class="selectOne" style="margin-left:100px;" target="_BLANK" href="RELACIONES/evaluacion.mwb">WORKBENCH</a><br /><!-- despues relacionar con modelo -->
    </div>
    <div class="contenedores">
      <a class="selectOne" href="admin/evaluacion_jugador.php">EVALUACIÓN JUGADOR</a>
    </div>
    <div class="contenedores_wb">
      <a class="selectOne" style="margin-left:100px;" target="_BLANK" href="RELACIONES/evaluacion.mwb">WORKBENCH</a><br /><!-- despues relacionar con modelo -->
    </div>
    <div class="contenedores">
      <a class="selectOne" href="admin/ficha_jugador.php">FICHA JUGADOR</a>
    </div>
    <div class="contenedores_wb">
      <a class="selectOne" style="margin-left:100px;" target="_BLANK" href="RELACIONES/ficha_jugador_2.mwb">WORKBENCH</a><br /><!-- despues relacionar con modelo -->
    </div>
  </div><br />
</center> 


</body>


</html>