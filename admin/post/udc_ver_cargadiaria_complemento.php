<?php
include('../../bd/udc_cargadiaria_complemento_BD.php');
$respuesta=ver_datos( $_POST );
echo json_encode($respuesta);
?>