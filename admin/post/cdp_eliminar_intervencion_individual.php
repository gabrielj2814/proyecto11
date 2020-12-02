<?php
include('../../bd/cdp_intervencion_individual_BD.php');
$respuesta=eliminar( $_POST['idcdp_intervencion_individual'] );
echo json_encode($respuesta);
?>