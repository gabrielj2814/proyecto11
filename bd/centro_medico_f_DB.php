<?PHP
function datetime_futbolJoven(){
    $datetime_now = new DateTime();
    $datetime_now = $datetime_now->format('Y-m-d H:i:s');
    return $datetime_now;
}

function date_futbolJoven(){
    $datetime_now = new DateTime();
    $datetime_now = $datetime_now->format('Y-m-d');
    return $datetime_now;
}

function utf8_converter($array){
    array_walk_recursive($array, function(&$item, $key){
        if(!mb_detect_encoding($item, 'utf-8', true)){
            $item = utf8_encode($item); 
        }
    });
    return $array;
}


function consultarBajasSerie($serie,$sexo){
    $contadorJugadoresDeBaja=0;
    $jugadores=consultarJugadoresSerie($serie,$sexo);
    for($contador=0;$contador<sizeof($jugadores);$contador++){
        $jugador=$jugadores[$contador];
        $atencionesDiariasJugador=consultarAtencionesDiariaJugador($jugador["idfichaJugador"]);
        $estado=analizarEstadoDeAtencionesDiarias($atencionesDiariasJugador);
        if(!$estado){
            $contadorJugadoresDeBaja++;
        }
    }
    // print  $contadorJugadoresDeBaja;
    return $contadorJugadoresDeBaja;
}

function consultarJugadoresSerie($serie,$sexo){
    include("conexion.php");
    $SQL="SELECT * FROM fichaJugador WHERE (fichaJugador.serieActual='$serie' AND sexo= $sexo );";
    // print($SQL);
    $result_jugador=$link->query($SQL);
    $array_datos=[];
    while($row=mysqli_fetch_array($result_jugador)){
        // $row["posicion"]=calcular_posicion_jugador($row["idfichaJugador"]);
        $array_datos[]=utf8_converter($row);
    }
    $link->close();
    return $array_datos;

}

function consultarAtencionesDiariaJugador($id){
    include("conexion.php");
    $SQL="SELECT * FROM atencion_diaria_federacion,fichaJugador WHERE atencion_diaria_federacion.idatencion_diaria_federacion=".$id." AND fichaJugador.idfichaJugador=atencion_diaria_federacion.idfichaJugador;";
    $result_atencion=$link->query($SQL);
    $datos=[];
    while($row_atencion_diaria=mysqli_fetch_array($result_atencion)){

        // $SQL_tratamiento_aplicado="SELECT * FROM tratamiento_aplicado_atencion_diaria_federacion WHERE  idatencion_diaria_federacion=".$row_atencion_diaria["idatencion_diaria_federacion"].";";
        // $result_tratamiento_aplicado=$link->query($SQL_tratamiento_aplicado);
        // $datos_tratamiento_aplicado=[];
        // while($row_tratamiento_aplicado=mysqli_fetch_array($result_tratamiento_aplicado)){
        //     $datos_tratamiento_aplicado[]=utf8_converter($row_tratamiento_aplicado);
        // }
        // $row_atencion_diaria["lista_tratamiento"]=$datos_tratamiento_aplicado;

        // $SQL_tranajo_readaptor="SELECT * FROM trabajo_readaptador_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$row_atencion_diaria["idatencion_diaria_federacion"]."";
        // $result_trabajo_readaptador=$link->query($SQL_tranajo_readaptor);
        // $datos_trabajo=[];
        // while($row_trabajo=mysqli_fetch_array($result_trabajo_readaptador)){
        //     $datos_trabajo[]=utf8_converter($row_trabajo);
        // }
        // $row_atencion_diaria["trabajo_readaptor"]= $datos_trabajo;

        // $SQL_recomendacion="SELECT * FROM recomendacion_alta_atencion_diaria_federacion WHERE  idatencion_diaria_federacion=".$row_atencion_diaria["idatencion_diaria_federacion"].";";
        // $result_recomendacion=$link->query($SQL_recomendacion);
        // $datos_recomendacion=[];
        // while($row_recomendacion=mysqli_fetch_array($result_recomendacion)){
        //     $datos_recomendacion[]=utf8_converter($row_recomendacion);
        // }
        // $row_atencion_diaria["lista_recomendacion"]=$datos_recomendacion;

        // if($row_atencion_diaria["idinforme_medico"]!=null){
        //     $SQL_informe_medico="SELECT * FROM informe_medico WHERE  idinforme_medico=".$row_atencion_diaria["idinforme_medico"].";";
        //     $result_informe_medico=$link->query($SQL_informe_medico);
        //     $datos_informe_medico=[];
        //     while($row_informe_medico=mysqli_fetch_array($result_informe_medico)){
        //         $datos_informe_medico[]=utf8_converter($row_informe_medico);
        //     }
        //     $row_atencion_diaria["informe_medico"]=$datos_informe_medico;
        // }
        
        // $SQL_recomendacion="SELECT * FROM recomendaciones_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$row_atencion_diaria["idatencion_diaria_federacion"]."";
        // $result_recomendacion=$link->query($SQL_recomendacion);
        // $datos_recomendacion=[];
        // while($row_recomendacion=mysqli_fetch_array($result_recomendacion)){
        //     $datos_recomendacion[]=utf8_converter($row_recomendacion);
        // }
        // $row_atencion_diaria["recomendaciones"]= $datos_recomendacion;

        $datos[]=utf8_converter($row_atencion_diaria);
    }
    $link->close();
    return (sizeof($datos)>0)? $datos: [];
}

function analizarEstadoDeAtencionesDiarias($atenciones){
    $estado=false;
    for($contador=0;$contador<sizeof($atenciones);$contador++){
        $atencion=$atenciones[$contador];
        if($atencion["estado_jugador"]===1){
            $estado=true;
        }
        else{
            $estado=false;
        }
    }
    return $estado;

}
