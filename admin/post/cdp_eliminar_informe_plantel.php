<?php
include('../../bd/cdp_informe_plantel_BD.php');
$respuesta=eliminar( $_POST['idcdp_informe_plantel'] );
echo json_encode($respuesta);
?>