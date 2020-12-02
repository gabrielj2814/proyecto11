<?php
include('../../bd/informe_carga_BD.php');
$respuesta=ver_todos_informe_carga_sexo_serie( $_POST['sexo'], $_POST['numero_serie'] );
echo json_encode($respuesta);
?>