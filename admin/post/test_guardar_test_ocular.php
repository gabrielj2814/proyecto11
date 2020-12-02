<?PHP
include("../../bd/test_BD.php");
// print_r($_POST);
$respuesta=operacionTestOcular($_POST);
if($respuesta["respuesta"]){
    for($contador=0;$contador<sizeof($_POST["array_idJugador"]);$contador++){
        $idJugador=$_POST["array_idJugador"][$contador];
        $velocidad=$_POST["array_velocidad"][$contador];
        $ranking=$_POST["array_ranking"][$contador];
        $comentario=$_POST["array_comentario"][$contador];
        registrarDetallesTestOcular($respuesta["id"],$idJugador,$velocidad,$ranking,$comentario,$_POST["nombre_usuario_software"]);
    }
    // 
}
else{
    print("sin insertar detalles test oculares");
}
print(json_encode($respuesta));
?>