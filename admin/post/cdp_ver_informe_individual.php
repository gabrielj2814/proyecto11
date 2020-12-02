<?php
include('../../bd/cdp_informe_individual_BD.php');
$respuesta=ver_datos( $_POST );
echo json_encode($respuesta);
?>