<?php
include('../../bd/informe_carga_BD.php');
$respuesta=guardar_informe_carga($_POST);
echo json_encode($respuesta);
?>