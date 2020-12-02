<?php
include('../../bd/cdp_informe_individual_BD.php');
$respuesta=eliminar( $_POST['idcdp_informe_individual'] );
echo json_encode($respuesta);
?>