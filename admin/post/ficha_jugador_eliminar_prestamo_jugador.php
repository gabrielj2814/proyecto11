<?PHP
include("../../bd/ficha_jugador_DB.php");
// print_r($_POST);
$resultado=eliminarPrestamo($_POST["id"]);
print(json_encode($resultado));
?>