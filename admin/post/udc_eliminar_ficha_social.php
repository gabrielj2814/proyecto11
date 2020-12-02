<?php
include('../../bd/udc_ficha_social_BD.php');
$respuesta=eliminar( $_POST['idudc_visita_social'] );
echo json_encode($respuesta);
?>