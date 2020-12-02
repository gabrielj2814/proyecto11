<?PHP
include("../../bd/evaluacion_jugador_BD.php");
$respuesta=consultarEvaluacionYConceptosJugador($_POST);
print(json_encode($respuesta));

?>