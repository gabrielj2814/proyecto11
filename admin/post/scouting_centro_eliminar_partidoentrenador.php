<?php
include('../../bd/scouting_centro_BD.php');
$respuesta=eliminar_partido_entrenador( $_POST['identrenador_partido'] );
echo json_encode($respuesta);
?>