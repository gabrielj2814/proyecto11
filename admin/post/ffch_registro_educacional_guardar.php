<?php
include('../../bd/ffch_registro_educacional_BD.php');
$respuesta=guardar( $_POST );
echo json_encode($respuesta);
?>