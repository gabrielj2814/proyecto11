<?PHP
include("../../bd/ficha_jugador_DB.php");
// print_r($_POST);
$resultado=consultarTipoPrestamosJugador($_POST);
print(json_encode($resultado));
?>