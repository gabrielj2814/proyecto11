<?php
include('../../bd/scouting_centro_BD.php');
$respuesta=eliminar_informe_scouting( $_POST['idinforme_cscouting_jugador'] );
echo json_encode($respuesta);
?>