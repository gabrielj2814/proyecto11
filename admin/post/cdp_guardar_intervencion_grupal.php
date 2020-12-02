<?php
include('../../bd/cdp_intervencion_grupal_BD.php');
$respuesta=guardar( $_POST );
echo json_encode($respuesta);
?>