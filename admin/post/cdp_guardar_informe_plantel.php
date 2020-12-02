<?php
include('../../bd/cdp_informe_plantel_BD.php');
$respuesta=guardar( $_POST );
echo json_encode($respuesta);
?>