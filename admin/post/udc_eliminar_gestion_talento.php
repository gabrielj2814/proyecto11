<?php
include('../../bd/udc_gestion_talento_BD.php');
$respuesta=eliminar( $_POST['idudc_gestion_talento'] );
echo json_encode($respuesta);
?>