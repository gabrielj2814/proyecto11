<?PHP
include("../../bd/atencion_diaria_federacion_BD.php");
$respuesta=consultarTratamientos();
print(json_encode($respuesta));
?>