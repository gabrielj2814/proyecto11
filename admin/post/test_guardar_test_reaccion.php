<?PHP
include("../../bd/test_reaccion_DB.php");
// print_r($_POST);
$respuesta=operacionTestReaccion($_POST);
if($respuesta["respuesta"]){
    for($contador=0;$contador<sizeof($_POST["array_idJugador"]);$contador++){
        $idJugador=$_POST["array_idJugador"][$contador];
        $tiempo_1=$_POST["array_tiempo_1"][$contador];
        $tiempo_2=$_POST["array_tiempo_2"][$contador];
        $tiempo_3=$_POST["array_tiempo_3"][$contador];
        $tiempo_4=$_POST["array_tiempo_4"][$contador];
        $ranking=$_POST["array_ranking"][$contador];
        $comentario=$_POST["array_comentario"][$contador];
        registrarDetallesTesteaccion($respuesta["id"],$idJugador,$tiempo_1,$tiempo_2,$tiempo_3,$tiempo_4,$ranking,$comentario,$_POST["nombre_usuario_software"]);
    }
    // 
}
else{
    print("sin insertar detalles test reaccion");
}
print(json_encode($respuesta));
?>