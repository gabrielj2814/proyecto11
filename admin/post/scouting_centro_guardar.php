<?php
include('../../bd/scouting_centro_BD.php');
$respuesta=guardar( $_POST );
echo json_encode($respuesta);
?>