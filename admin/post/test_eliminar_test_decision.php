<?PHP
include("../../bd/test_decision_DB.php");
// print_r($_POST);
$respuesta=eliminarTest($_POST["id"]);
print(json_encode($respuesta));
?>