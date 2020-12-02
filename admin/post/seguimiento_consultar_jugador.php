<?PHP
include("../../bd/seguimiento_BD.php");
$jugadores=consultarJugador($_GET);
print(json_encode($jugadores));
?>