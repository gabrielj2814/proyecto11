<?PHP

// print($_GET["operacion"]);
$operacion=$_POST["operacion"];
switch($operacion){
    case 1:operacionConsultarTodosLosInformesSemanales();break;
    case 2:buscarPorFiltro();break;
}

function buscarPorFiltro(){
    // print_r($_POST);
    include("../../bd/informe_semanal_DB.php");
    $respuesta=consultarPorRangoDeFecha($_POST);
    print(json_encode($respuesta));
}


function operacionConsultarTodosLosInformesSemanales(){
    include("../../bd/informe_semanal_DB.php");
    $respuesta=consultarTodosLosInformesSemanales();
    print(json_encode($respuesta));
}

?>