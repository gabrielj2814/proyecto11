<?php
include('../../bd/scouting_centro_BD.php');
$respuesta=ver_datos( $_POST );
echo json_encode($respuesta);
?>