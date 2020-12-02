<?php
include('../../bd/udc_ficha_social_BD.php');
$respuesta=guardar( $_POST );
echo json_encode($respuesta);
?>