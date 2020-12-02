<?PHP
include("../../bd/atencion_diaria_BD.php");
$respuesta=registrarTrabajoRedaptor($_POST);
print(json_encode($respuesta));
?>