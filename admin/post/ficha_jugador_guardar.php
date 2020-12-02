<?PHP
include("../../bd/ficha_jugador_DB.php");
// print_r($_POST);
$resultado=operacion($_POST,$_FILES);
print(json_encode($resultado));
?>