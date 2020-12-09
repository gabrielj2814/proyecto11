<?PHP
include("../../bd/centro_medico_f_DB.php");
$datos=consultarEstadoJugadoresSerie($_POST["serie"],$_POST["sexo"]);
print(json_encode($datos));

?>