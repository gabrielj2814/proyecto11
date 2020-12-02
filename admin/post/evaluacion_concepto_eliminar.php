<?PHP
include("../../bd/evaluacion_concepto_DB.php");
$respuesta=eliminar($_POST);
print(json_encode($respuesta));

?>