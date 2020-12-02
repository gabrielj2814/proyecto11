<?PHP
include("../../bd/centro_medico_BD.php");
$datos=consultarJugadoresSerie($_GET["serie"],$_GET["sexo"]);
$respuesta=(sizeof($datos)>0)? ["respuesta"=> true,"datos" => $datos]: ["respuesta"=> true,"datos" => []];
print(json_encode($respuesta));


?>