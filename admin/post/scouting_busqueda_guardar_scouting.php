<?php
include('../../bd/scouting_busqueda_BD.php');
$respuesta=guardar_scouting( $_POST );
echo json_encode($respuesta);
?>