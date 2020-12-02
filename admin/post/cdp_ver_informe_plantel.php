<?php
include('../../bd/cdp_informe_plantel_BD.php');
$respuesta=ver_datos( $_POST );
echo json_encode($respuesta);
?>