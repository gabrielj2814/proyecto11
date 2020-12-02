<?php
include('../../bd/scouting_busqueda_BD.php');
$respuesta=eliminar_ficha_jugador( $_POST['idfichaJugador'] );
echo json_encode($respuesta);
?>