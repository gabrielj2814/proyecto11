<?PHP
include("../../bd/test_BD.php");
// print_r($_POST);
$respuesta=obtenerTotaltestMensuales();
print(json_encode($respuesta));

?>