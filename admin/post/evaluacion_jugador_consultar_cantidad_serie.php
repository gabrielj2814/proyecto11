<?PHP
include("../../bd/evaluacion_jugador_BD.php");
$respuesta=cantidadDeJugadoresPorSerie($_GET);
print(json_encode($respuesta));

?>