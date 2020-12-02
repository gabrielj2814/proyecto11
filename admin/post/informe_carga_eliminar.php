<?php
include('../../bd/informe_carga_BD.php');
$respuesta=eliminar_informe_carga( $_POST["id"] );
echo json_encode($respuesta);
?>