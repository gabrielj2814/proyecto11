<?PHP
include("../../bd/informe_semanal_DB.php");
$respuesta=eliminar($_GET["id"]);
print(json_encode($respuesta))

?>