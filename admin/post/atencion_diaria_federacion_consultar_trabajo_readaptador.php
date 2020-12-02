<?PHP
include("../../bd/atencion_diaria_federacion_BD.php");
$respuesta=consultarTrabajadorReadaptador();
print(json_encode($respuesta));
?>