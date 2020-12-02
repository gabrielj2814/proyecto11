<?PHP
include("../../bd/atencion_diaria_BD.php");
$respuesta=consultarTrabajadorReadaptador();
print(json_encode($respuesta));
?>