<?PHP
include("../../bd/centro_medico_BD.php");
$resultado=consultarJugadoresSinAltaMedica($_GET);
print(json_encode($resultado));


?>