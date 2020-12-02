<?PHP
include("../../bd/centro_medico_BD.php");
$respuesta=consultarEstadoEquipo();
print(json_encode($respuesta));

?>