<?php
include('../../bd/cdp_intervencion_grupal_BD.php');
$respuesta=ver_datos( $_POST );
echo json_encode($respuesta);
?>