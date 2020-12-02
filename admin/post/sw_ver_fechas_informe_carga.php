<?php
include('../../bd/informe_carga_BD.php');
$respuesta  = ver_fechas_informe_carga( $_POST['sexo'], $_POST['numero_serie'] );
echo json_encode($respuesta);
?>