<?PHP
include("../../bd/test_desicion_DB.php");
// print_r($_POST);
$respuesta=consultarTestMensual($_POST["ano_test_oculares"],$_POST["mes_test_oculares"]);
print(json_encode($respuesta));
?>