<?php
include('../../bd/informe_carga_BD.php');
$respuesta  = ver_cantidad_jugadores_sexo_serie( $_POST['array_sexo'], $_POST['array_numero_serie'] );
echo json_encode($respuesta);
?>