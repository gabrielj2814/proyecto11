<?PHP

// print($_GET["operacion"]);
$operacion=$_POST["operacion"];
switch($operacion){
    case 1:operacionConsultarTodosLosInformesMensual();break;
    case 2:buscarPorFiltro();break;
}

function buscarPorFiltro(){
    // print_r($_POST);
    include("../../bd/informe_mensual_DB.php");
    $respuesta=consultarPorRangoDeFecha($_POST);
    print(json_encode($respuesta));
}


function operacionConsultarTodosLosInformesMensual(){
    include("../../bd/informe_mensual_DB.php");
    $respuesta=consultarTodosLosInformesMensuales();
    print(json_encode($respuesta));
}

?>