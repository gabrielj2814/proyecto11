<?PHP
include("../../bd/test_decision_DB.php");
// print_r($_POST);
$respuesta=operacionTestDecision($_POST);
if($respuesta["respuesta"]){
    for($contador=0;$contador<sizeof($_POST["array_idJugador"]);$contador++){
        $idJugador=$_POST["array_idJugador"][$contador];
        $descision=$_POST["array_toma_decision"][$contador];
        $presicion=$_POST["array_presicion"][$contador];
        $presion=$_POST["array_manejo_presion"][$contador];
        $reaccion=$_POST["array_reaccion"][$contador];
        $adaptacion=$_POST["array_adaptacion"][$contador];
        registrarDetallesTestDecision($respuesta["id"],$idJugador,$descision,$presicion,$presion,$reaccion,$adaptacion,$_POST["nombre_usuario_software"]);
    }
    // 
}
else{
    print("sin insertar detalles test decision");
}
print(json_encode($respuesta));
?>