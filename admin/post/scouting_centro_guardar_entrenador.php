<?php
include('../../bd/scouting_centro_BD.php');
$respuesta=guardar_entrenador( $_POST );
echo json_encode($respuesta);
?>