<?php
include('../../bd/ffch_ayuda_social_BD.php');
$respuesta=guardar_ayuda_social( $_POST );
echo json_encode($respuesta);
?>