<?php
include('../../bd/udc_gestion_talento_BD.php');
$respuesta=ver_datos( $_POST );
echo json_encode($respuesta);
?>