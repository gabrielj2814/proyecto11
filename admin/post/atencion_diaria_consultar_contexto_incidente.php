<?PHP
include("../../bd/atencion_diaria_BD.php");
$respuesta=consultarContextoIncidente();
print(json_encode($respuesta));
?>