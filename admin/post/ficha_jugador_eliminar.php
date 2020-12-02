<?PHP
include("../../bd/ficha_jugador_DB.php");
// print_r($_POST);
$resultado=eliminar($_POST["idfichaJugador"]);
print(json_encode($resultado));
?>