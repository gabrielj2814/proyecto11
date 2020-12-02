<?PHP
include("../../bd/test_BD.php");
// print_r($_POST);
$respuesta=consultarTestOculares($_POST["ano_test_oculares"],$_POST["mes_test_oculares"]);
print(json_encode($respuesta));
?>