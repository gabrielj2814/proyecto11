<?php
include('../../bd/scouting_busqueda_BD.php');
$respuesta=eliminar_partido_jugador( $_POST['idfichaJugador_partido'] );
echo json_encode($respuesta);
?>