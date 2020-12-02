<?php
include('../../bd/evaluacion_jugador_BD.php');
// print_r($_POST);
$respuesta = guardar_evaluacion($_POST);
print json_encode($respuesta);
?>