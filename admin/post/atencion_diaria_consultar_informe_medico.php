<?PHP
include("../../bd/atencion_diaria_BD.php");
$respuesta=consultarInformeMedico($_POST);
print(json_encode($respuesta));
?>