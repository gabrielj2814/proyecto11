<?php
include('../../bd/scouting_centro_BD.php');
$respuesta=eliminar_entrenador( $_POST['identrenador'] );
echo json_encode($respuesta);
?>