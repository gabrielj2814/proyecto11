<?php
include('../../bd/scouting_centro_BD.php');
$respuesta=eliminar_scouting( $_POST['idcscouting_jugador'] );
echo json_encode($respuesta);
?>