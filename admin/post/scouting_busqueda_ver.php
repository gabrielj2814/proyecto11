<?php
include('../../bd/scouting_busqueda_BD.php');
$respuesta=ver_datos( $_POST );
echo json_encode($respuesta);
?>