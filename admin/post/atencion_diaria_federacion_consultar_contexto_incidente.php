<?PHP
include("../../bd/atencion_diaria_federacion_BD.php");
$respuesta=consultarContextoIncidente();
print(json_encode($respuesta));
?>