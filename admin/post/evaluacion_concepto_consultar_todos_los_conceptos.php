<?PHP
include("../../bd/evaluacion_concepto_DB.php");
$respuesta=consultarTodosLosConceptos();
print(json_encode($respuesta))

?>