<?php
include('../../bd/informe_carga_BD.php');
$respuesta=ver_todos_informe_carga_sexo_serie_fecha_inicio_fin( $_POST['sexo'], $_POST['numero_serie'], $_POST['inicio'], $_POST['fin'] );
echo json_encode($respuesta);
?>