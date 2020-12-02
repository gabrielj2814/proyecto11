<?PHP
include("../../bd/ficha_jugador_DB.php");
// print_r($_POST);
$resultado=consultarFichaJugador($_POST);
print(json_encode($resultado));
?>