<?PHP
include("../../bd/evaluacion_jugador_BD.php");
$respuesta=consultarJugadorPorSerie($_POST["serie"],$_POST["sexo"]);
print(json_encode($respuesta));

?>