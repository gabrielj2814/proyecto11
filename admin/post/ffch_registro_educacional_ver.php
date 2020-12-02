<?php
include('../../bd/ffch_registro_educacional_BD.php');
$respuesta=ver_datos( $_POST );
echo json_encode($respuesta);
?>