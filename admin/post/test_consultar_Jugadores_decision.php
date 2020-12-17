<?PHP
include("../../bd/test_decision_DB.php");
$repuesta=consultarJugadoresSerie($_POST["serie"],$_POST["sexo"]);
print(json_encode($repuesta));
?>