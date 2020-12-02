<?PHP
include("../../bd/atencion_diaria_federacion_BD.php");
$jugadores=consultarJugador($_POST);
print(json_encode($jugadores));
?>