<?PHP
include("../../bd/test_BD.php");
// print_r($_POST);
$respuesta=eliminarTestOcular($_POST["id"]);
print(json_encode($respuesta));
?>