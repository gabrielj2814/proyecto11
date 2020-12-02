<?php
include('../../bd/udc_ficha_social_BD.php');
$respuesta=guardar_registro_otro( $_POST );
echo json_encode($respuesta);
?>