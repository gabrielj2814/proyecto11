<?PHP
include("../../bd/test_reaccion_DB.php");
// print_r($_POST);
$respuesta=eliminarTestReaccion($_POST["id"]);
print(json_encode($respuesta));
?>