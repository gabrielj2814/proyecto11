<?php
include('../../bd/udc_ficha_social_BD.php');
$respuesta=ver_datos( $_POST );
echo json_encode($respuesta);
?>