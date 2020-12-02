<?php
include('../../bd/udc_cargadiaria_complemento_BD.php');
$respuesta=eliminar_sesion( $_POST['idudc_cargadiaria_sesion'] );
echo json_encode($respuesta);
?>