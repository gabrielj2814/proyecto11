<?php
include('../../bd/udc_gestion_talento_BD.php');
$respuesta=guardar( $_POST );
echo json_encode($respuesta);
?>