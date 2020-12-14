<?PHP
include("../../bd/test_reaccion_DB.php");
$repuesta=consultarJugadoresSerie($_POST["serie"],$_POST["sexo"]);
print(json_encode($repuesta));
?>