<?php
include('../../bd/cdp_informe_individual_BD.php');
$respuesta=guardar( $_POST );
echo json_encode($respuesta);
?>