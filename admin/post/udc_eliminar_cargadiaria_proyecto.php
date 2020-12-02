<?php
include('../../bd/udc_cargadiaria_complemento_BD.php');
$respuesta=eliminar_proyecto( $_POST['idudc_cargadiaria_proyecto'] );
echo json_encode($respuesta);
?>