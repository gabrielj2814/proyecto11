<?PHP
include("../../bd/evaluacion_concepto_DB.php");
$respuesta=consultarPorPosicion($_POST);
print(json_encode($respuesta))

?>