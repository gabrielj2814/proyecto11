<?php
include('../../bd/evaluacion_jugador_BD.php');
$respuesta = ver_jugadores($_POST);
print(json_encode($respuesta));
?>