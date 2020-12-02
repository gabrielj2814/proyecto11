<?php
include('../../bd/udc_cargadiaria_complemento_BD.php');
$respuesta=guardar_sesion($_POST);
echo json_encode($respuesta);
?>