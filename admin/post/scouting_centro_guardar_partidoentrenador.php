<?php
include('../../bd/scouting_centro_BD.php');
$respuesta=guardar_partido_entrenador( $_POST );
echo json_encode($respuesta);
?>