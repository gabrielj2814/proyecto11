<?PHP
include("../../bd/ficha_jugador_DB.php");
// print_r($_POST);
$resultado=actualizarPrestamo($_POST);
print(json_encode($resultado));
?>