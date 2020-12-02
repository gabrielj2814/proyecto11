<?PHP
include("../../bd/centro_medico_BD.php");
$resultado=consultarJugadoresHistorialLesiones($_POST);
print(json_encode($resultado));
?>