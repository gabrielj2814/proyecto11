<?php
include('../../bd/club_BD.php');
$respuesta=ver_datos( $_POST );
echo json_encode($respuesta);
?>