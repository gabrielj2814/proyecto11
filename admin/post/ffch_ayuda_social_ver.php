<?php
include('../../bd/ffch_ayuda_social_BD.php');
$respuesta=ver_datos( $_POST );
echo json_encode($respuesta);
?>