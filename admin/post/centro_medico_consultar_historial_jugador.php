<?PHP
include("../../bd/centro_medico_BD.php");
$resultado=consultarJugadorHistorialLesiones($_GET["id"]);
print(json_encode($resultado));
?>