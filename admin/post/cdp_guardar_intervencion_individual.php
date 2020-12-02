<?php
include('../../bd/cdp_intervencion_individual_BD.php');
$respuesta=guardar( $_POST );
echo json_encode($respuesta);
?>