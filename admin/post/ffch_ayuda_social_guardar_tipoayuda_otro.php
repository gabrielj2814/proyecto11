<?php
include('../../bd/ffch_ayuda_social_BD.php');
$respuesta=guardar_tipo_ayuda_otro( $_POST );
echo json_encode($respuesta);
?>