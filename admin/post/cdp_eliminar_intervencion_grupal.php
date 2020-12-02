<?php
include('../../bd/cdp_intervencion_grupal_BD.php');
$respuesta=eliminar( $_POST['idcdp_intervencion_grupal'] );
echo json_encode($respuesta);
?>