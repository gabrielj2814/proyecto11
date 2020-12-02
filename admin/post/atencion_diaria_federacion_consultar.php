<?PHP
include("../../bd/atencion_diaria_federacion_BD.php");
$respuesta=consultarAtencionDiariaJugador($_POST);
print(json_encode($respuesta));
// print_r($_POST);
?>