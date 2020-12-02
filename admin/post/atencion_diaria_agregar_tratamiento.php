<?PHP
include("../../bd/atencion_diaria_BD.php");
$respuesta=registrarTratamiento($_POST);
print(json_encode($respuesta));
?>