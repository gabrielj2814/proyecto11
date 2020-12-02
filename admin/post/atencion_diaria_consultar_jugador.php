<?PHP
include("../../bd/atencion_diaria_BD.php");
$jugadores=consultarJugador($_POST);
print(json_encode($jugadores));
?>