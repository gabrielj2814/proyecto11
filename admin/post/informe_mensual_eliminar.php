<?PHP
include("../../bd/informe_mensual_DB.php");
$respuesta=eliminar($_GET["id"]);
print(json_encode($respuesta))

?>