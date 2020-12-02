<?PHP
include("../../bd/atencion_diaria_federacion_BD.php");
$respuesta=registrarTrabajoRedaptor($_POST);
print(json_encode($respuesta));
?>