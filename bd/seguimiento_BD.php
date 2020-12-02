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

function consultarJugador($get){
    include("conexion.php");
    $SQL="SELECT * FROM fichaJugador,club WHERE (fichaJugador.serieActual='".$get["serie"]."' AND fichaJugador.sexo=".$get["sexo"]." ) ;";
    // $SQL="SELECT * FROM fichajugador,club WHERE (fichajugador.serieActual='".$get["serie"]."' AND fichajugador.sexo=".$get["sexo"]." ) ;";
    $result_jugador=$link->query($SQL);
    $array_datos=[];
    while($row=mysqli_fetch_array($result_jugador)){
        $array_datos[]=utf8_converter($row);
    }
    for($contador3=0;$contador3<sizeof($array_datos);$contador3++){
        $SQL_informe_medico_jugador="SELECT * FROM informe_medico WHERE idfichaJugador=".$array_datos[$contador3]["idfichaJugador"]."";
        $result_informe_medico=$link->query($SQL_informe_medico_jugador);
        $datos_informe_medico=[];
        while($row_informe_medico=mysqli_fetch_array($result_informe_medico)){
            $datos_informe_medico[]=utf8_converter($row_informe_medico);
        }
        $array_datos[$contador3]["informes_medicos"]= $datos_informe_medico;
    }
    $link->close();
    return (sizeof($array_datos)>0)? ["estado"=>true,"respuesta"=>$array_datos]: ["estado"=>false,"respuesta"=>[]];
}


function guardar($POST){
// modalidad_tipo_formulario
    if($POST["modalidad_tipo_formulario"]==="1"){
        return guardarModalidadLibreEleccion($POST);
    }
    elseif($POST["modalidad_tipo_formulario"]==="2"){
        return guardarModalidadCordinada($POST);
    }
    else{
        return registroRapido($POST);
    }

}

function registroRapido($POST){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $comentario_caso="NULL";
    if($POST["comentario_caso"]!=""){
        $comentario_caso="'".$POST["comentario_caso"]."'";
    }
    $SQL="
    INSERT INTO seguimiento (
        idfichaJugador,
        diagnostico_seguimiento,
        fecha_accidente_seguimiento,
        fecha_software,
        nombre_usuario_software
    )

    VALUES(
        ".$POST["id_ficha_jugador"].",
        '".$POST["diagnostico"]."',
        '".$POST["fecha_accidente"]."',
        '".$fecha_software."',
        '".$POST["nombre_usuario_software"]."'
    );";
    // print($SQL);
    $link->query($SQL);
    $id=$link->insert_id;
    $link->close();
    return ["modalidad"=>$POST["modalidad_tipo_formulario"],"id"=>$id];
}

function guardarModalidadLibreEleccion ($POST){
    // print("modalidad cordinada");
    include("conexion.php");
    if($POST["id_informe"]==="false"){
        $fecha_software=date_futbolJoven();
        $comentario_caso="NULL";
        if($POST["comentario_caso"]!=""){
            $comentario_caso="'".$POST["comentario_caso"]."'";
        }
        $SQL="
        INSERT INTO seguimiento (
            idfichaJugador,
            modalidad_seguimiento,
            numero_caso_seguimiento,
            diagnostico_seguimiento,
            fecha_accidente_seguimiento,
            fecha_denuncia_seguimiento,
            fecha_plazo_maximo_30_seguimiento,
            fecha_plazo_maximo_90_seguimiento,
            fecha_plazo_maximo_180_seguimiento,
            fecha_plazo_reembolzo_seguimiento,
            pendiente_ano_anterior_seguimiento,
            entrega_documento_seguimiento,
            continuidad_tratamiento_seguimiento,
            comentario_caso,
            fecha_software,
            nombre_usuario_software
        )

        VALUES(
            ".$POST["id_ficha_jugador"].",
            ".$POST["modalidad_tipo_formulario"].",
            ".$POST["numero_caso"].",
            '".$POST["diagnostico"]."',
            '".$POST["fecha_accidente"]."',
            '".$POST["fecha_denuncia"]."',
            '".$POST["fecha_plazo_maximo_30"]."',
            '".$POST["fecha_plazo_maximo_90"]."',
            '".$POST["fecha_plazo_maximo_180"]."',
            '".$POST["fecha_plazo_reembolzo"]."',
            ".$POST["pendiente_ano"].",
            ".$POST["entrada_documentacion"].",
            ".$POST["continuidad_tratamiento"].",
            ".$comentario_caso.",
            '".$fecha_software."',
            '".$POST["nombre_usuario_software"]."'
        );";
        // print($SQL);
        $link->query($SQL);
        $id=$link->insert_id;
        $link->close();
        return ["modalidad"=>$POST["modalidad_tipo_formulario"],"id"=>$id];
    }
    else{
        $fecha_software=date_futbolJoven();
        $comentario_caso="NULL";
        if($POST["comentario_caso"]!=""){
            $comentario_caso="'".$POST["comentario_caso"]."'";
        }
        $SQL="
        UPDATE seguimiento SET
            idfichaJugador=".$POST["id_ficha_jugador"].",
            modalidad_seguimiento=".$POST["modalidad_tipo_formulario"].",
            numero_caso_seguimiento=".$POST["numero_caso"].",
            diagnostico_seguimiento='".$POST["diagnostico"]."',
            fecha_accidente_seguimiento='".$POST["fecha_accidente"]."',
            fecha_denuncia_seguimiento='".$POST["fecha_denuncia"]."',
            fecha_plazo_maximo_30_seguimiento='".$POST["fecha_plazo_maximo_30"]."',
            fecha_plazo_maximo_90_seguimiento='".$POST["fecha_plazo_maximo_90"]."',
            fecha_plazo_maximo_180_seguimiento='".$POST["fecha_plazo_maximo_180"]."',
            fecha_plazo_reembolzo_seguimiento='".$POST["fecha_plazo_reembolzo"]."',
            pendiente_ano_anterior_seguimiento=".$POST["pendiente_ano"].",
            entrega_documento_seguimiento=".$POST["entrada_documentacion"].",
            continuidad_tratamiento_seguimiento=".$POST["continuidad_tratamiento"].",
            comentario_caso=".$comentario_caso.",
            fecha_software='".$fecha_software."',
            nombre_usuario_software='".$POST["nombre_usuario_software"]."'

        WHERE idseguimiento=".$POST["idseguimiento"].";";
        $link->query($SQL);
        $id=$link->insert_id;
        $link->close();
        return ["modalidad"=>$POST["modalidad_tipo_formulario"],"id"=>$id];
    }



}

function guardarModalidadCordinada($POST){
    // print("modalidad libre eleccion");
    include("conexion.php");
    if($POST["id_informe"]==="false"){
        $fecha_software=date_futbolJoven();
        $comentario_caso="NULL";
        if($POST["comentario_caso"]!=""){
            $comentario_caso="'".$POST["comentario_caso"]."'";
        }
        $centro_atencion="NULL";
        if($POST["centro_atencion"]!=""){
            $centro_atencion="'".$POST["centro_atencion"]."'";
        }
        $centro_derivacion="NULL";
        if($POST["centro_derivacion"]!=""){
            $centro_derivacion="'".$POST["centro_derivacion"]."'";
        }
        $medico_tratante="NULL";
        if($POST["medico_tratante"]!=""){
            $medico_tratante="'".$POST["medico_tratante"]."'";
        }

        $SQL="
        INSERT INTO seguimiento (
            idfichaJugador,
            modalidad_seguimiento,
            numero_caso_seguimiento,
            diagnostico_seguimiento,
            fecha_accidente_seguimiento,
            fecha_denuncia_seguimiento,
            fecha_atencion_seguimiento,

            centro_atencion_seguimiento,
            centro_derivacion_seguimiento,
            medico_tratante_seguimiento,

            comentario_caso,
            fecha_software,
            nombre_usuario_software
        )

        VALUES(
            ".$POST["id_ficha_jugador"].",
            ".$POST["modalidad_tipo_formulario"].",
            ".$POST["numero_caso"].",
            '".$POST["diagnostico"]."',
            '".$POST["fecha_accidente"]."',
            '".$POST["fecha_denuncia"]."',
            '".$POST["fecha_atencion"]."',
            ".$centro_atencion.",
            ".$centro_derivacion.",
            ".$medico_tratante.",
            ".$comentario_caso.",
            '".$fecha_software."',
            '".$POST["nombre_usuario_software"]."'
        );";
        // print($SQL);
        $link->query($SQL);
        $id=$link->insert_id;
        $link->close();
        return ["modalidad"=>$POST["modalidad_tipo_formulario"],"id"=>$id];
    }
    else{
        $fecha_software=date_futbolJoven();
        $comentario_caso="NULL";
        if($POST["comentario_caso"]!=""){
            $comentario_caso="'".$POST["comentario_caso"]."'";
        }
        $centro_atencion="NULL";
        if($POST["centro_atencion"]!=""){
            $centro_atencion="'".$POST["centro_atencion"]."'";
        }
        $centro_derivacion="NULL";
        if($POST["centro_derivacion"]!=""){
            $centro_derivacion="'".$POST["centro_derivacion"]."'";
        }
        $medico_tratante="NULL";
        if($POST["medico_tratante"]!=""){
            $medico_tratante="'".$POST["medico_tratante"]."'";
        }

        $SQL="
        UPDATE seguimiento SET
            idfichaJugador=".$POST["id_ficha_jugador"].",
            modalidad_seguimiento=".$POST["modalidad_tipo_formulario"].",
            numero_caso_seguimiento=".$POST["numero_caso"].",
            diagnostico_seguimiento='".$POST["diagnostico"]."',
            fecha_accidente_seguimiento='".$POST["fecha_accidente"]."',
            fecha_denuncia_seguimiento='".$POST["fecha_denuncia"]."',
            fecha_atencion_seguimiento='".$POST["fecha_atencion"]."',

            centro_atencion_seguimiento=".$centro_atencion.",
            centro_derivacion_seguimiento=".$centro_derivacion.",
            medico_tratante_seguimiento=".$medico_tratante.",

            comentario_caso=".$comentario_caso.",
            fecha_software='".$fecha_software."',
            nombre_usuario_software='".$POST["nombre_usuario_software"]."'

        WHERE idseguimiento=".$POST["idseguimiento"].";";
        // print($SQL);
        $link->query($SQL);
        $id=$link->insert_id;
        $link->close();
        eliminarDetalleAtencionSeguimiento($POST["idseguimiento"]);
        return ["modalidad"=>$POST["modalidad_tipo_formulario"],"id"=>$POST["idseguimiento"]];
    }
}

function guardarDetallesAtencion($POST,$fecha,$centro,$detalle,$id_seguimiento){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $centro_validado="NULL";
    if($centro!=""){
        $centro_validado="'".$centro."'";
    }
    $detalle_validado="NULL";
    if($detalle!=""){
        $detalle_validado="'".$detalle."'";
    }
    $SQL="INSERT INTO detalle_atencion_seguimiento
    (
        idseguimiento,
        fecha_atencion_detalle_atencion_seguimiento,
        centro_atencion_detalle_atencion_seguimiento,
        detalle_atencion_seguimiento,
        fecha_software,
        nombre_usuario_software
    ) 
    VALUES(
        ".$id_seguimiento.",
        '".$fecha."',
        ".$centro_validado.",
        ".$detalle_validado.",
        '".$fecha_software."',
        '".$POST["nombre_usuario_software"]."'
    );";
    $link->query($SQL);
    $link->close();
}

function consultarSeguimiento($POST){
    include("conexion.php");
    // $SQL="";
    if(array_key_exists("array_checkbox_seguimiento_filtro_jugador",$POST)){
        $condicional="";
        if(sizeof($POST["array_checkbox_seguimiento_filtro_jugador"])>1){
            $lista_condicional=[];
            for($contador=0;$contador<sizeof($POST["array_checkbox_seguimiento_filtro_jugador"]);$contador++){
                $condicion=" seguimiento.idfichaJugador=".$POST["array_checkbox_seguimiento_filtro_jugador"][$contador]." ";
                $lista_condicional[]=$condicion;
            }
            $condicional=implode("OR",$lista_condicional);;
        }
        else{
            $condicional="seguimiento.idfichaJugador=".$POST["array_checkbox_seguimiento_filtro_jugador"][0]."";
        }

        $SQL1="SELECT * FROM seguimiento,fichajugador WHERE (seguimiento.fecha_accidente_seguimiento BETWEEN '".$POST["fecha_inicio"]."' AND '".$POST["fecha_final"]."' ) AND (".$condicional.") AND (fichajugador.idfichaJugador=seguimiento.idfichaJugador);";
        // print($SQL1);
        $result_seguimiento=$link->query($SQL1);
        $datos_seguimiento=[];
        while($row_seguimiento=mysqli_fetch_array($result_seguimiento)){
            if($row_seguimiento["modalidad_seguimiento"]==="2"){
                $row_seguimiento["detalles_atencion_seguimiento"]=consultarDetalleAtencion($row_seguimiento["idseguimiento"]);
            }
            $datos_seguimiento[]=utf8_converter($row_seguimiento);
        }
        $link->close();
        return (sizeof($datos_seguimiento)>0)?["respuesta"=>true,"datos"=>$datos_seguimiento]:["respuesta"=>false,"datos"=>[]];
    }
    else{
        $SQL1="SELECT * FROM seguimiento,fichaJugador WHERE (seguimiento.fecha_accidente_seguimiento BETWEEN '".$POST["fecha_inicio"]."' AND '".$POST["fecha_final"]."') AND (fichaJugador.idfichaJugador=seguimiento.idfichaJugador) ;";
        $result_seguimiento=$link->query($SQL1);
        $datos_seguimiento=[];
        while($row_seguimiento=mysqli_fetch_array($result_seguimiento)){
            if($row_seguimiento["modalidad_seguimiento"]==="2"){
                $row_seguimiento["detalles_atencion_seguimiento"]=consultarDetalleAtencion($row_seguimiento["idseguimiento"]);
            }
            $datos_seguimiento[]=utf8_converter($row_seguimiento);
        }
        $link->close();
        return (sizeof($datos_seguimiento)>0)?["respuesta"=>true,"datos"=>$datos_seguimiento]:["respuesta"=>false,"datos"=>[]];
    }
}

function consultarDetalleAtencion($idseguimiento){
    include("conexion.php");
    $SQL2="SELECT * FROM detalle_atencion_seguimiento WHERE idseguimiento=".$idseguimiento.";";
    $result_detalle_atencion=$link->query($SQL2);
    $datos_detalle_atencion_seguimiento=[];
    while($row_seguimiento_detalle_atencion=mysqli_fetch_array($result_detalle_atencion)){
        $datos_detalle_atencion_seguimiento[]=utf8_converter($row_seguimiento_detalle_atencion);
    }
    $link->close();
    return $datos_detalle_atencion_seguimiento;
}


function eliminarSeguimiento($GET){
    include("conexion.php");
    $SQL="DELETE FROM seguimiento WHERE idseguimiento=".$GET["id"].";";
    $link->query($SQL);
    $link->close();
}

function eliminarDetalleAtencionSeguimiento($id){
    include("conexion.php");
    $SQL="DELETE FROM detalle_atencion_seguimiento WHERE idseguimiento=".$id.";";
    $link->query($SQL);
    $link->close();
}


function consultarSeguimientoId($id){
    include("conexion.php");
    $SQL="SELECT * FROM seguimiento,fichaJugador WHERE (seguimiento.idseguimiento=".$id.") AND (fichaJugador.idfichaJugador=seguimiento.idfichaJugador) ;";
    $result_seguimiento=$link->query($SQL);
    $datos_seguimiento=[];
    while($row_seguimiento=mysqli_fetch_array($result_seguimiento)){
        if($row_seguimiento["modalidad_seguimiento"]==="2"){
            $row_seguimiento["detalles_atencion_seguimiento"]=consultarDetalleAtencion($row_seguimiento["idseguimiento"]);
        }
        $datos_seguimiento[]=utf8_converter($row_seguimiento);
    }
    $link->close();
    return $datos_seguimiento;
}




