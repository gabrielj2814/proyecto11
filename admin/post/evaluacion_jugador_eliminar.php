<?php
include('../../bd/evaluacion_jugador_BD.php');
// print_r($_GET);
$respuesta = eliminarEvaluacion($_POST);
print json_encode($respuesta);
?>