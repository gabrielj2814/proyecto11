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
    $SQL="SELECT * FROM fichaJugador WHERE (fichaJugador.serieActual='".$get["serie"]."' AND fichaJugador.sexo=".$get["sexo"]." );";
    $result_jugador=$link->query($SQL);
    $array_datos=[];
    while($row=mysqli_fetch_array($result_jugador)){
        $posicon=calcular_posicion_jugador2($row["idfichaJugador"]);
        $row["posicion"]=$posicon["codigo_posicion"];
        $row["texto_posicion"]=$posicon["texto_posicion"];
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

function registrarContextoIncidente($POST){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="INSERT INTO contexto_incidente(nombre_contexto_incidente,fecha_software,nombre_usuario_software) VALUES('".$POST["indique_incidente"]."','".$fecha_software."','".$POST["nombre_usuario_software"]."');";
    $link->query($SQL);
    $id=$link->insert_id;
    $link->close();
    return $id;
}

function consultarContextoIncidente(){
    include("conexion.php");
    $SQL="SELECT * FROM contexto_incidente;";
    $result_contexto_incidente=$link->query($SQL);
    $array_datos=[];
    while($row=mysqli_fetch_array($result_contexto_incidente)){
        $array_datos[]=utf8_converter($row);
    }
    $link->close();
    return (sizeof($array_datos)>0)? ["estado"=>true,"respuesta"=>$array_datos]: ["estado"=>false,"respuesta"=>[]];
}

function registrarTratamiento($POST){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="INSERT INTO tratamiento_aplicado(nombre_tratamiento_aplicado,fecha_software,nombre_usuario_software) VALUES('".$POST["otro_tratamiento_aplicado"]."','".$fecha_software."','".$POST["nombre_usuario_software"]."');";
    $link->query($SQL);
    $link->close();
    return ["respuesta" => true];
}

function registrarTratamientoAtencionDiaria($POST,$tratamiento,$id_atencion_diaria){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="INSERT INTO tratamiento_aplicado_atencion_diaria_federacion(nombre_tratamiento_atencion_diaria,idatencion_diaria_federacion,fecha_software,nombre_usuario_software) VALUES('".$tratamiento."',".$id_atencion_diaria.",'".$fecha_software."','".$POST["nombre_usuario_software"]."');";
    $link->query($SQL);
    $link->close();
    return ["respuesta" => true];
}

function registrarExamenesSolicitadosAtencionDiaria($POST,$examen,$id_atencion_diaria){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="INSERT INTO examen_solicitado_atencion_diaria_federacion(nombre_examen_atencion_diaria,idatencion_diaria_federacion,fecha_software,nombre_usuario_software) VALUES('".$examen."',".$id_atencion_diaria.",'".$fecha_software."','".$POST["nombre_usuario_software"]."');";
    $link->query($SQL);
    $link->close();
    return ["respuesta" => true];
}

function consultarTratamientos(){
    include("conexion.php");
    $SQL="SELECT * FROM tratamiento_aplicado ORDER BY nombre_tratamiento_aplicado;";
    $result_tratamiento=$link->query($SQL);
    $datos=[];
    while($row=mysqli_fetch_array($result_tratamiento)){
        $datos[]=utf8_converter($row);
    }
    $link->close();
    return (sizeof($datos)>0)? ["respuesta"=>true,"datos"=>$datos]: ["respuesta"=>false,"datos"=>[]];
}

function consultarTrabajadorReadaptador(){
    include("conexion.php");
    $SQL="SELECT * FROM trabajador_readatador ORDER BY trabajo_readatador;";
    $result_trabajo_readaptador=$link->query($SQL);
    $datos=[];
    while($row=mysqli_fetch_array($result_trabajo_readaptador)){
        $datos[]=utf8_converter($row);
    }
    $link->close();
    return (sizeof($datos)>0)? ["respuesta"=>true,"datos"=>$datos]: ["respuesta"=>false,"datos"=>[]];
}

function consultarInformeMedico($GET){
    include("conexion.php");
    $SQL="SELECT * FROM informe_medico WHERE idfichaJugador=".$GET["idfichaJugador"].";";
    $result_informe_medico=$link->query($SQL);
    $datos=[];
    while($row=mysqli_fetch_array($result_informe_medico)){
        $datos[]=utf8_converter($row);
    }
    $link->close();
    return (sizeof($datos)>0)? ["respuesta"=>true,"datos"=>$datos]: ["respuesta"=>false,"datos"=>[]];
}


function registrarTrabajoRedaptor($POST){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="INSERT INTO trabajador_readatador(trabajo_readatador,fecha_software,nombre_usuario_software) VALUES('".$POST["otro_trabajo_readaptador"]."','".$fecha_software."','".$POST["nombre_usuario_software"]."');";
    
    $link->query($SQL);
    $id=$link->insert_id;
    $link->close();
    if($id!=null){
        return ["estado"=>true,"respuesta"=>$id];
    }
    else{
        return ["estado"=>false,"respuesta"=>null];
    }
}

function registrarTrabajoRedaptorAtencionDiaria($POST,$trabajo_readaptador,$id_atencion_diaria){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="INSERT INTO trabajo_readaptador_atencion_diaria_federacion(idatencion_diaria_federacion,trabajo_readaptador_atencion_diaria,fecha_software,nombre_usuario_software) VALUES(".$id_atencion_diaria.",".$trabajo_readaptador.",'".$fecha_software."','".$POST["nombre_usuario_software"]."');";
    $link->query($SQL);
    $link->close();
}

function registrarRecomendacionesAltaAtencionDiaria($POST,$recomendacion_alta,$id_atencion_diaria){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="INSERT INTO recomendacion_alta_atencion_diaria_federacion(idatencion_diaria_federacion,recomendacion_alta_atencion_diaria,fecha_software,nombre_usuario_software) VALUES(".$id_atencion_diaria.",".$recomendacion_alta.",'".$fecha_software."','".$POST["nombre_usuario_software"]."');";
    $link->query($SQL);
    $link->close();
}

function registrarAltaDeportiva($POST,$alta_deportiva,$id_atencion_diaria){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="INSERT INTO alta_deportiva_atencion_diaria_federacion(idatencion_diaria_federacion,alta_deportiva_atencion_diaria,fecha_software,nombre_usuario_software) VALUES(".$id_atencion_diaria.",".$alta_deportiva.",'".$fecha_software."','".$POST["nombre_usuario_software"]."');";
    $link->query($SQL);
    $link->close();
}

function registrarLesionesCuerpo($POST,$codigo,$parte_texto,$id_atencion_diaria){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="INSERT INTO zonas_lesion_atencion_diaria_federacion(idatencion_diaria_federacion,codigo_zonas_lesion,zona_lesion,fecha_software,nombre_usuario_software) VALUES(".$id_atencion_diaria.",'".$codigo."','".$parte_texto."','".$fecha_software."','".$POST["nombre_usuario_software"]."');";
    // print($SQL);
    $link->query($SQL);
    $link->close();
}


// campo numero_sesion INT, porcentaje_recuperacion INT
// alter table atencion_diaria add numero_sesion int ; alter table atencion_diaria add porcentaje_recuperacion int
// alter table atencion_diaria add asistencia_atencion_diaria int 

function guardarAtencionDiaria($POST){
    include("conexion.php");
    if($POST["tipo_formulario"]==="1"){
        if($POST["id_informe"]=="false"){
            $fecha_software=date_futbolJoven();
            $obserbacion_kinesiologo="";
            if($POST["observaciones_kinesiologo"]!=""){
                $obserbacion_kinesiologo="'".$POST["observaciones_kinesiologo"]."'";
            }
            else{
                $obserbacion_kinesiologo="NULL";
            }

            $SQL="INSERT INTO atencion_diaria_federacion(
                idfichaJugador,
                idcontexto_incidente,
                tipo_atencion_atencion_diaria,
                fecha_atencion_diaria,
                fecha_incidente_atencion_diaria,
                diagnostico_atencion_diaria,
                anamnesis_atencion_diaria,
                derivado_seguro_atencion_diaria,
                examen_solicitados_atencion_diaria,
                examen_fisico,
                estado_jugador,
                observacion_kinesiologo,

                fecha_software,
                nombre_usuario_software
            ) VALUES(
                ".$POST["id_ficha_jugador"].",
                ".$POST["contexto_incidente_formulario"].",
                ".$POST["tipo_tipo_atencion_formulario"].",
                '".$POST["fecha_atencion_diaria"]."',
                '".$POST["fecha_incidente"]."',
                '".$POST["diagnostico"]."',
                '".$POST["anamnesis"]."',
                ".$POST["derivado_seguro"].",
                ".$POST["examen_solicitado"].",
                '".$POST["examen_fisico"]."',
                ".$POST["estado_jugador"].",
                ".$obserbacion_kinesiologo.",
                '".$fecha_software."',
                '".$POST["nombre_usuario_software"]."'
            );";
            // echo $SQL;
            $link->query($SQL);
            $id=$link->insert_id;
            $link->close();
            return $id;
        }
        else{
            $fecha_software=date_futbolJoven();
            $obserbacion_kinesiologo="";
            if($POST["observaciones_kinesiologo"]!=""){
                $obserbacion_kinesiologo="'".$POST["observaciones_kinesiologo"]."'";
            }
            else{
                $obserbacion_kinesiologo="NULL";
            }
            
            // tipo_atencion_atencion_diaria=".$POST["tipo_tipo_atencion_formulario"].",
            $SQL="UPDATE atencion_diaria_federacion SET
                idcontexto_incidente=".$POST["contexto_incidente_formulario"].",
                fecha_atencion_diaria='".$POST["fecha_atencion_diaria"]."',
                fecha_incidente_atencion_diaria='".$POST["fecha_incidente"]."',
                diagnostico_atencion_diaria='".$POST["diagnostico"]."',
                anamnesis_atencion_diaria='".$POST["anamnesis"]."',
                derivado_seguro_atencion_diaria=".$POST["derivado_seguro"].",
                examen_solicitados_atencion_diaria=".$POST["examen_solicitado"].",
                examen_fisico='".$POST["examen_fisico"]."',
                estado_jugador=".$POST["estado_jugador"].",
                observacion_kinesiologo=".$obserbacion_kinesiologo.",

                fecha_software='".$fecha_software."',
                nombre_usuario_software='".$POST["nombre_usuario_software"]."'

                WHERE idatencion_diaria_federacion=".$POST["id_atencion_diaria"].";";
            // print($SQL);
            $link->query($SQL);
            $link->close();
            eliminarAtencionDiariaExamenes($POST);
            eliminarAtencionDiariaTratamiento($POST);
            eliminarAtencionDiariaTrabajoReadaptador($POST);
            eliminarAtencionDiariaAltaDeportiva($POST);
            eliminarAtencionDiariaRecomendacionAlta($POST);
            eliminarAtencionDiariaLesiones($POST);
            eliminarRecomendacion($POST);
            return $POST["id_atencion_diaria"];
        }
    }
    if($POST["tipo_formulario"]==="2"){
        if($POST["id_informe"]=="false"){
            $fecha_software=date_futbolJoven();
            $idinforme_medico="";
            if($POST["idinforme_medico"]==="0"){
                $idinforme_medico="NULL";
            }
            else{
                $idinforme_medico=$POST["idinforme_medico"];
            }
            $observaion_general="";
            if($POST["observaciones_generales"]!=""){
                // $POST["observaciones_generales"]
                $observaion_general="'".$POST["observaciones_generales"]."'";
            }
            else{
                $observaion_general="NULL";
            }
            // asistencia_atencion_diaria asistencia_control
            $SQL="INSERT INTO atencion_diaria_federacion(
                idfichaJugador,
                tipo_atencion_atencion_diaria,
                fecha_atencion_diaria,

                observacion_general ,
                numero_sesion,
                porcentaje_recuperacion,
                idinforme_medico,
                asistencia_atencion_diaria,

                fecha_estimada_de_alta,
                estado_jugador,
                indicaciones,

                fecha_software,
                nombre_usuario_software
            ) VALUES(
                ".$POST["id_ficha_jugador"].",
                ".$POST["tipo_tipo_atencion_formulario"].",
                '".$POST["fecha_atencion_diaria"]."',

                ".$observaion_general.",
                ".$POST["numero_sesiones"].",
                ".$POST["porcentaje_recuperacion"].",
                ".$idinforme_medico.",
                ".$POST["asistencia_control"].",

                '".$POST["fecha_alta"]."',
                ".$POST["estado_jugador"].",
                '".$POST["indicaciones"]."',

                '".$fecha_software."',
                '".$POST["nombre_usuario_software"]."'
            );";
            // echo $SQL;
            $link->query($SQL);
            $id=$link->insert_id;
            $link->close();
            // echo $SQL;
            return $id;
            
        }
        else{
            $fecha_software=date_futbolJoven();
            if($POST["idinforme_medico"]==="0"){
                $idinforme_medico="NULL";
            }
            else{
                $idinforme_medico=$POST["idinforme_medico"];
            }
            $observaion_general="";
            if($POST["observaciones_generales"]!=""){
                // $POST["observaciones_generales"]
                $observaion_general="'".$POST["observaciones_generales"]."'";
            }
            else{
                $observaion_general="NULL";
            }
            
            $SQL="UPDATE atencion_diaria_federacion SET
                fecha_atencion_diaria='".$POST["fecha_atencion_diaria"]."',
                tipo_atencion_atencion_diaria=".$POST["tipo_tipo_atencion_formulario"].",
                observacion_general=".$observaion_general.",
                numero_sesion=".$POST["numero_sesiones"].",
                porcentaje_recuperacion=".$POST["porcentaje_recuperacion"].",
                idinforme_medico=".$idinforme_medico.",
                asistencia_atencion_diaria=".$POST["asistencia_control"].",

                fecha_estimada_de_alta='".$POST["fecha_alta"]."',
                estado_jugador=".$POST["estado_jugador"].",
                indicaciones='".$POST["indicaciones"]."',

                fecha_software='".$fecha_software."',
                nombre_usuario_software='".$POST["nombre_usuario_software"]."'

                WHERE idatencion_diaria_federacion=".$POST["id_atencion_diaria"].";";
            $link->query($SQL);
            $link->close();
            // eliminarAtencionDiariaTrabajoReadaptador($POST);
            eliminarAtencionDiariaTratamiento($POST);
            eliminarRecomendacion($POST);
            return $POST["id_atencion_diaria"];
        }
    }
    if($POST["tipo_formulario"]==="3"){
        if($POST["id_informe"]=="false"){
            $idinforme_medico="";
            if($POST["idinforme_medico"]==="0"){
                $idinforme_medico="NULL";
            }
            else{
                $idinforme_medico=$POST["idinforme_medico"];
            }
            $recomendacion_medica="";
            if($POST["recomendacion_medica"]!=""){
                $recomendacion_medica="'".$POST["recomendacion_medica"]."'";
            }
            else{
                $recomendacion_medica="NULL";
            }
            $fecha_software=date_futbolJoven();
            $SQL="INSERT INTO atencion_diaria_federacion(
                idfichaJugador,
                tipo_atencion_atencion_diaria,
                fecha_atencion_diaria,

                estado_jugador,
                observacion_medica ,
                idinforme_medico,

                fecha_software,
                nombre_usuario_software
            ) VALUES(
                ".$POST["id_ficha_jugador"].",
                ".$POST["tipo_tipo_atencion_formulario"].",
                '".$POST["fecha_atencion_diaria"]."',
                
                ".$POST["estado_jugador"].",
                ".$recomendacion_medica.",
                ".$idinforme_medico.",
                '".$fecha_software."',
                '".$POST["nombre_usuario_software"]."'
            );";
            // echo $SQL;
            $link->query($SQL);
            $id=$link->insert_id;
            $link->close();
            return $id;
        }
        else{
            $idinforme_medico="";
            if($POST["idinforme_medico"]==="0"){
                $idinforme_medico="NULL";
            }
            else{
                $idinforme_medico=$POST["idinforme_medico"];
            }
            $recomendacion_medica="";
            if($POST["recomendacion_medica"]!=""){
                $recomendacion_medica="'".$POST["recomendacion_medica"]."'";
            }
            else{
                $recomendacion_medica="NULL";
            }
            $fecha_software=date_futbolJoven();
            $SQL="UPDATE atencion_diaria_federacion SET
                fecha_atencion_diaria='".$POST["fecha_atencion_diaria"]."',
                tipo_atencion_atencion_diaria=".$POST["tipo_tipo_atencion_formulario"].",
                
                estado_jugador=".$POST["estado_jugador"].",
                observacion_medica=".$recomendacion_medica.",
                idinforme_medico=".$idinforme_medico.",

                fecha_software='".$fecha_software."',
                nombre_usuario_software='".$POST["nombre_usuario_software"]."'
                WHERE idatencion_diaria_federacion=".$POST["id_atencion_diaria"].";";
            // echo $SQL;
            $link->query($SQL);
            $link->close();
            eliminarAtencionDiariaExamenes($POST);
            eliminarAtencionDiariaTratamiento($POST);
            eliminarAtencionDiariaTrabajoReadaptador($POST);
            eliminarAtencionDiariaAltaDeportiva($POST);
            eliminarAtencionDiariaRecomendacionAlta($POST);
            eliminarAtencionDiariaLesiones($POST);
            return $POST["id_atencion_diaria"];
        }
    }
    if($POST["tipo_formulario"]==="4"){
        if($POST["id_informe"]=="false"){
            $idinforme_medico="";
            if($POST["idinforme_medico"]==="0"){
                $idinforme_medico="NULL";
            }
            else{
                $idinforme_medico=$POST["idinforme_medico"];
            }
            $recomendacion_readaptadore="";
            if($POST["recomendacion_readaptadores"]!=""){
                $recomendacion_readaptadore="'".$POST["recomendacion_readaptadores"]."'";
            }
            else{
                $recomendacion_readaptadore="NULL";
            }
            $fecha_software=date_futbolJoven();
            $SQL="INSERT INTO atencion_diaria_federacion(
                idfichaJugador,
                tipo_atencion_atencion_diaria,
                fecha_atencion_diaria,
                
                estado_jugador,
                observacion_readaptor  ,
                idinforme_medico,

                fecha_software,
                nombre_usuario_software
            ) VALUES(
                ".$POST["id_ficha_jugador"].",
                ".$POST["tipo_tipo_atencion_formulario"].",
                '".$POST["fecha_atencion_diaria"]."',

                ".$POST["estado_jugador"].",
                ".$recomendacion_readaptadore.",
                ".$idinforme_medico.",
                '".$fecha_software."',
                '".$POST["nombre_usuario_software"]."'
            );";
            // echo $SQL;
            $link->query($SQL);
            $id=$link->insert_id;
            $link->close();
            return $id;
        }
        else{
            $idinforme_medico="";
            if($POST["idinforme_medico"]==="0"){
                $idinforme_medico="NULL";
            }
            else{
                $idinforme_medico=$POST["idinforme_medico"];
            }
            $recomendacion_readaptadore="";
            if($POST["recomendacion_readaptadores"]!=""){
                $recomendacion_readaptadore="'".$POST["recomendacion_readaptadores"]."'";
            }
            else{
                $recomendacion_readaptadore="NULL";
            }
            $fecha_software=date_futbolJoven();
            $SQL="UPDATE atencion_diaria_federacion SET
                fecha_atencion_diaria='".$POST["fecha_atencion_diaria"]."',
                tipo_atencion_atencion_diaria=".$POST["tipo_tipo_atencion_formulario"].",
                
                estado_jugador=".$POST["estado_jugador"].",
                observacion_readaptor=".$recomendacion_readaptadore.",
                idinforme_medico=".$idinforme_medico.",

                fecha_software='".$fecha_software."',
                nombre_usuario_software='".$POST["nombre_usuario_software"]."'
                WHERE idatencion_diaria_federacion=".$POST["id_atencion_diaria"].";";
            $link->query($SQL);
            $link->close();
            // eliminarAtencionDiariaAltaDeportiva($POST);
            eliminarAtencionDiariaRecomendacionAlta($POST);
            return $POST["id_atencion_diaria"];
        }
        
    }





































    
    if($POST["tipo_formulario"]==="5"){
        // NUEVA ATENCION
        if($POST["id_informe"]=="false"){
            $fecha_software=date_futbolJoven();
            $indicaciones="";
            if($POST["indicaciones"]!=""){
                $indicaciones="'".$POST["indicaciones"]."'";
            }
            else{
                $indicaciones="NULL";
            }

            $SQL="INSERT INTO atencion_diaria_federacion(
                idfichaJugador,
                idcontexto_incidente,
                tipo_atencion_atencion_diaria,
                fecha_atencion_diaria,
                fecha_incidente_atencion_diaria,
                diagnostico_atencion_diaria,
                anamnesis_atencion_diaria,
                examen_solicitados_atencion_diaria,
                examen_fisico,
                estado_jugador,
                plan_atencion_diaria,
                indicaciones,

                fecha_software,
                nombre_usuario_software
            ) VALUES(
                ".$POST["id_ficha_jugador"].",
                ".$POST["contexto_incidente_formulario"].",
                ".$POST["tipo_tipo_atencion_formulario"].",
                '".$POST["fecha_atencion_diaria"]."',
                '".$POST["fecha_incidente"]."',
                '".$POST["diagnostico"]."',
                '".$POST["anamnesis"]."',
                ".$POST["examen_solicitado"].",
                '".$POST["examen_fisico"]."',
                ".$POST["estado_jugador"].",
                '".$POST["plan"]."',
                ".$indicaciones.",
                '".$fecha_software."',
                '".$POST["nombre_usuario_software"]."'
            );";
            // echo $SQL;
            $link->query($SQL);
            $id=$link->insert_id;
            $link->close();
            return $id;
        }
        else{
            $fecha_software=date_futbolJoven();
            $indicaciones="";
            if($POST["indicaciones"]!=""){
                $indicaciones="'".$POST["indicaciones"]."'";
            }
            else{
                $indicaciones="NULL";
            }
            
            // tipo_atencion_atencion_diaria=".$POST["tipo_tipo_atencion_formulario"].",
            $SQL="UPDATE atencion_diaria_federacion SET
                idcontexto_incidente=".$POST["contexto_incidente_formulario"].",
                fecha_atencion_diaria='".$POST["fecha_atencion_diaria"]."',
                fecha_incidente_atencion_diaria='".$POST["fecha_incidente"]."',
                diagnostico_atencion_diaria='".$POST["diagnostico"]."',
                anamnesis_atencion_diaria='".$POST["anamnesis"]."',
                examen_solicitados_atencion_diaria=".$POST["examen_solicitado"].",
                examen_fisico='".$POST["examen_fisico"]."',
                estado_jugador=".$POST["estado_jugador"].",
                plan_atencion_diaria='".$POST["plan"]."',
                indicaciones=".$indicaciones.",

                fecha_software='".$fecha_software."',
                nombre_usuario_software='".$POST["nombre_usuario_software"]."'

                WHERE idatencion_diaria_federacion=".$POST["id_atencion_diaria"].";";
            // print($SQL);
            $link->query($SQL);
            $link->close();
            eliminarAtencionDiariaLesiones($POST);
            return $POST["id_atencion_diaria"];
        }
    }
    if($POST["tipo_formulario"]==="6"){
        if($POST["id_informe"]=="false"){
            $fecha_software=date_futbolJoven();
            $idinforme_medico="";
            if($POST["idinforme_medico"]==="0"){
                $idinforme_medico="NULL";
            }
            else{
                $idinforme_medico=$POST["idinforme_medico"];
            }
            $observacion="";
            if($POST["observacion"]!=""){
                // $POST["observacion"]
                $observacion="'".$POST["observacion"]."'";
            }
            else{
                $observacion="NULL";
            }
            // asistencia_atencion_diaria asistencia_control
            $SQL="INSERT INTO atencion_diaria_federacion(
                idfichaJugador,
                tipo_atencion_atencion_diaria,
                fecha_atencion_diaria,

                examen_fisico,
                observacion ,
                numero_sesion,
                idinforme_medico,
                asistencia_atencion_diaria,

                fecha_estimada_de_alta,
                estado_jugador,
                indicaciones,

                fecha_software,
                nombre_usuario_software
            ) VALUES(
                ".$POST["id_ficha_jugador"].",
                ".$POST["tipo_tipo_atencion_formulario"].",
                '".$POST["fecha_atencion_diaria"]."',

                '".$POST["examen_fisico"]."',
                ".$observacion.",
                ".$POST["numero_sesiones"].",
                ".$idinforme_medico.",
                ".$POST["asistencia_control"].",

                '".$POST["fecha_alta"]."',
                ".$POST["estado_jugador"].",
                '".$POST["indicaciones"]."',

                '".$fecha_software."',
                '".$POST["nombre_usuario_software"]."'
            );";
            // echo $SQL;
            $link->query($SQL);
            $id=$link->insert_id;
            $link->close();
            // echo $SQL;
            return $id;
            
        }
        else{
            $fecha_software=date_futbolJoven();
            if($POST["idinforme_medico"]==="0"){
                $idinforme_medico="NULL";
            }
            else{
                $idinforme_medico=$POST["idinforme_medico"];
            }
            $observacion="";
            if($POST["observacion"]!=""){
                // $POST["observacion"]
                $observacion="'".$POST["observacion"]."'";
            }
            else{
                $observacion="NULL";
            }
            
            $SQL="UPDATE atencion_diaria_federacion SET
                fecha_atencion_diaria='".$POST["fecha_atencion_diaria"]."',
                tipo_atencion_atencion_diaria=".$POST["tipo_tipo_atencion_formulario"].",
                numero_sesion=".$POST["numero_sesiones"].",
                idinforme_medico=".$idinforme_medico.",
                asistencia_atencion_diaria=".$POST["asistencia_control"].",

                observacion=".$observacion.",
                examen_fisico='".$POST["examen_fisico"]."',
                fecha_estimada_de_alta='".$POST["fecha_alta"]."',
                estado_jugador=".$POST["estado_jugador"].",
                indicaciones='".$POST["indicaciones"]."',

                fecha_software='".$fecha_software."',
                nombre_usuario_software='".$POST["nombre_usuario_software"]."'

                WHERE idatencion_diaria_federacion=".$POST["id_atencion_diaria"].";";
            $link->query($SQL);
            $link->close();
            eliminarRecomendacion($POST);
            return $POST["id_atencion_diaria"];
        }
    }
    if($POST["tipo_formulario"]==="7"){
        if($POST["id_informe"]=="false"){
            $fecha_software=date_futbolJoven();
            $idinforme_medico="";
            if($POST["idinforme_medico"]==="0"){
                $idinforme_medico="NULL";
            }
            else{
                $idinforme_medico=$POST["idinforme_medico"];
            }
            $observacion="";
            if($POST["observacion"]!=""){
                // $POST["observacion"]
                $observacion="'".$POST["observacion"]."'";
            }
            else{
                $observacion="NULL";
            }
            // asistencia_atencion_diaria asistencia_control
            $SQL="INSERT INTO atencion_diaria_federacion(
                idfichaJugador,
                tipo_atencion_atencion_diaria,
                fecha_atencion_diaria,

                observacion ,
                numero_sesion,
                porcentaje_recuperacion,
                idinforme_medico,
                asistencia_atencion_diaria,

                fecha_estimada_de_alta,
                estado_jugador,
                indicaciones,

                fecha_software,
                nombre_usuario_software
            ) VALUES(
                ".$POST["id_ficha_jugador"].",
                ".$POST["tipo_tipo_atencion_formulario"].",
                '".$POST["fecha_atencion_diaria"]."',

                '".$observacion."',
                ".$POST["numero_sesiones"].",
                ".$POST["porcentaje_recuperacion"].",
                ".$idinforme_medico.",
                ".$POST["asistencia_control"].",

                '".$POST["fecha_alta"]."',
                ".$POST["estado_jugador"].",
                '".$POST["indicaciones"]."',

                '".$fecha_software."',
                '".$POST["nombre_usuario_software"]."'
            );";
            // echo $SQL;
            $link->query($SQL);
            $id=$link->insert_id;
            $link->close();
            // echo $SQL;
            return $id;
            
        }
        else{
            $fecha_software=date_futbolJoven();
            if($POST["idinforme_medico"]==="0"){
                $idinforme_medico="NULL";
            }
            else{
                $idinforme_medico=$POST["idinforme_medico"];
            }
            $observacion="";
            if($POST["observacion"]!=""){
                // $POST["observacion"]
                $observacion="'".$POST["observacion"]."'";
            }
            else{
                $observacion="NULL";
            }
            
            $SQL="UPDATE atencion_diaria_federacion SET
                fecha_atencion_diaria='".$POST["fecha_atencion_diaria"]."',
                tipo_atencion_atencion_diaria=".$POST["tipo_tipo_atencion_formulario"].",
                observacion=".$observacion.",
                numero_sesion=".$POST["numero_sesiones"].",
                porcentaje_recuperacion=".$POST["porcentaje_recuperacion"].",
                idinforme_medico=".$idinforme_medico.",
                asistencia_atencion_diaria=".$POST["asistencia_control"].",

                fecha_estimada_de_alta='".$POST["fecha_alta"]."',
                estado_jugador=".$POST["estado_jugador"].",
                indicaciones='".$POST["indicaciones"]."',

                fecha_software='".$fecha_software."',
                nombre_usuario_software='".$POST["nombre_usuario_software"]."'

                WHERE idatencion_diaria_federacion=".$POST["id_atencion_diaria"].";";
            $link->query($SQL);
            $link->close();
            eliminarAtencionDiariaTrabajoReadaptador($POST);
            // eliminarAtencionDiariaTratamiento($POST);
            eliminarRecomendacion($POST);
            return $POST["id_atencion_diaria"];
        }
    }
}

function consultarAtencionDiariaJugador($POST){
    include("conexion.php");
    $SQL_atencion_diaria="SELECT * FROM  fichaJugador,atencion_diaria_federacion WHERE  (atencion_diaria_federacion.fecha_atencion_diaria BETWEEN '".$POST["fecha_inicio"]."' AND '".$POST["fecha_final"]."'  ) AND ( fichaJugador.nombre LIKE '%".$POST["nombre_jugador"]."%' AND  fichaJugador.idfichaJugador=atencion_diaria_federacion.idfichaJugador  )  ";
    if(array_key_exists("array_checkbox_serie_filtro_atencion_diaria",$POST)){
        if(sizeof($POST["array_checkbox_serie_filtro_atencion_diaria"])>1){
            $list_serie_or=[];
            for($contador=0;$contador<sizeof($POST["array_checkbox_serie_filtro_atencion_diaria"]);$contador++){
                list($serie,$sexo)=explode("_",$POST["array_checkbox_serie_filtro_atencion_diaria"][$contador]);
                $list_serie_or[]="(fichaJugador.serieActual='".$serie."' AND fichaJugador.sexo=".$sexo.")";
            }
            $str_serie_or=implode(" OR ",$list_serie_or);
            // $list_serie_or
            $SQL_atencion_diaria.=" AND ( ".$str_serie_or." )";
        }
        else{
            list($serie,$sexo)=explode("_",$POST["array_checkbox_serie_filtro_atencion_diaria"][0]);
            $SQL_atencion_diaria.=" AND  (fichaJugador.serieActual='".$serie."' AND fichaJugador.sexo=".$sexo.") ";
        }
    }
    if(array_key_exists("array_checkbox_tipo_atencion_filtro_atencion_diaria",$POST)){
        if(sizeof($POST["array_checkbox_tipo_atencion_filtro_atencion_diaria"])>1){
            $list_atencion_or=[];
            for($contador2=0;$contador2<sizeof($POST["array_checkbox_tipo_atencion_filtro_atencion_diaria"]);$contador2++){
                $list_atencion_or[]=" atencion_diaria_federacion.tipo_atencion_atencion_diaria=".$POST["array_checkbox_tipo_atencion_filtro_atencion_diaria"][$contador2]."";
            }
            $str_atencion_or=implode(" OR ",$list_atencion_or);
            // $list_serie_or
            $SQL_atencion_diaria.=" AND ( ".$str_atencion_or." ) ";
        }
        else{
            $SQL_atencion_diaria.=" AND  ( atencion_diaria_federacion.tipo_atencion_atencion_diaria=".$POST["array_checkbox_tipo_atencion_filtro_atencion_diaria"][0]." ) ";
        }
    }
    // print($SQL_atencion_diaria);
    $result_atencion_diaria=$link->query($SQL_atencion_diaria);
    $datos_atencion_diaria=[];
    while($row_atencion_diaria=mysqli_fetch_array($result_atencion_diaria)){
        $posicon=calcular_posicion_jugador2($row_atencion_diaria["idfichaJugador"]);
        $row_atencion_diaria["posicion"]=$posicon["codigo_posicion"];
        $row_atencion_diaria["texto_posicion"]=$posicon["texto_posicion"];
        $datos_atencion_diaria[]=utf8_converter($row_atencion_diaria);
    }
    for($contador3=0;$contador3<sizeof($datos_atencion_diaria);$contador3++){
        $SQL_examen_solicitud="SELECT * FROM examen_solicitado_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$datos_atencion_diaria[$contador3]["idatencion_diaria_federacion"]."";
        $result_examen_solicitud=$link->query($SQL_examen_solicitud);
        $datos_examenes=[];
        while($row_examen=mysqli_fetch_array($result_examen_solicitud)){
            $datos_examenes[]=utf8_converter($row_examen);
        }
        $datos_atencion_diaria[$contador3]["examenes_solicitados"]=$datos_examenes;

        $SQL_tratamiento_aplicado="SELECT * FROM tratamiento_aplicado_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$datos_atencion_diaria[$contador3]["idatencion_diaria_federacion"]."";
        $result_tratamiento=$link->query($SQL_tratamiento_aplicado);
        $datos_tratamiento=[];
        while($row_tratamiento=mysqli_fetch_array($result_tratamiento)){
            $datos_tratamiento[]=utf8_converter($row_tratamiento);
        }
        $datos_atencion_diaria[$contador3]["tratamiento_aplicado"]= $datos_tratamiento;
        $SQL_tranajo_readaptor="SELECT * FROM trabajo_readaptador_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$datos_atencion_diaria[$contador3]["idatencion_diaria_federacion"]."";
        $result_trabajo_readaptador=$link->query($SQL_tranajo_readaptor);
        $datos_trabajo=[];
        while($row_trabajo=mysqli_fetch_array($result_trabajo_readaptador)){
            $datos_trabajo[]=utf8_converter($row_trabajo);
        }
        $datos_atencion_diaria[$contador3]["trabajo_readaptor"]= $datos_trabajo;

        $SQL_recomendaciones_alta="SELECT * FROM recomendacion_alta_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$datos_atencion_diaria[$contador3]["idatencion_diaria_federacion"]."";
        $result_recomendaciones_alta=$link->query($SQL_recomendaciones_alta);
        $datos_recomendaciones_alta=[];
        while($row_recomendaciones_alta=mysqli_fetch_array($result_recomendaciones_alta)){
            $datos_recomendaciones_alta[]=utf8_converter($row_recomendaciones_alta);
        }
        $datos_atencion_diaria[$contador3]["recomendacion_alta"]= $datos_recomendaciones_alta;

        $SQL_alta_deportiva="SELECT * FROM alta_deportiva_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$datos_atencion_diaria[$contador3]["idatencion_diaria_federacion"]."";
        $result_alta_deportiva=$link->query($SQL_alta_deportiva);
        $datos_alta_deportiva=[];
        while($row_alta_deportiva=mysqli_fetch_array($result_alta_deportiva)){
            $datos_alta_deportiva[]=utf8_converter($row_alta_deportiva);
        }
        $datos_atencion_diaria[$contador3]["alta_deportiva"]= $datos_alta_deportiva;

        $SQL_lesion="SELECT * FROM zonas_lesion_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$datos_atencion_diaria[$contador3]["idatencion_diaria_federacion"]."";
        $result_lesion=$link->query($SQL_lesion);
        $datos_lesion=[];
        while($row_lesion=mysqli_fetch_array($result_lesion)){
            $datos_lesion[]=utf8_converter($row_lesion);
        }
        $datos_atencion_diaria[$contador3]["lesiones"]= $datos_lesion;

        $SQL_recomendacion="SELECT * FROM recomendaciones_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$datos_atencion_diaria[$contador3]["idatencion_diaria_federacion"]."";
        $result_recomendacion=$link->query($SQL_recomendacion);
        $datos_recomendacion=[];
        while($row_recomendacion=mysqli_fetch_array($result_recomendacion)){
            $datos_recomendacion[]=utf8_converter($row_recomendacion);
        }
        $datos_atencion_diaria[$contador3]["recomendaciones"]= $datos_recomendacion;

        $SQL_informe_medico_jugador="SELECT * FROM informe_medico WHERE idfichaJugador=".$datos_atencion_diaria[$contador3]["idfichaJugador"]."";
        $result_informe_medico=$link->query($SQL_informe_medico_jugador);
        $datos_informe_medico=[];
        while($row_informe_medico=mysqli_fetch_array($result_informe_medico)){
            $datos_informe_medico[]=utf8_converter($row_informe_medico);
        }
        $datos_atencion_diaria[$contador3]["informes_medicos"]= $datos_informe_medico;
        $datos_atencion_diaria[$contador3]["posicion"]=calcular_posicion_jugador($datos_atencion_diaria[$contador3]["idfichaJugador"]);
    }
    $link->close();
    return (sizeof($datos_atencion_diaria)>0)? ["respuesta"=>true,"datos"=>$datos_atencion_diaria]: ["respuesta"=>false,"datos"=>[]];
}

// sql 2 SELECT * FROM fichajugador,atencion_diaria WHERE (atencion_diaria.fecha_atencion_diaria BETWEEN '2020-07-29' AND '2020-07-29' ) AND ( fichajugador.nombre LIKE '%Mauro Antonio%' OR ( fichajugador.idfichaJugador=atencion_diaria.idfichaJugador ) ) AND (fichaJugador.serieActual='14' AND fichaJugador.sexo=1) 

// sql 3 SELECT * FROM fichajugador,atencion_diaria WHERE (atencion_diaria.fecha_atencion_diaria BETWEEN '2020-07-29' AND '2020-07-29' ) AND ( fichajugador.nombre LIKE '%Mauro Antonio%' OR ( fichajugador.idfichaJugador=atencion_diaria.idfichaJugador ) ) AND ( (fichaJugador.serieActual='15' AND fichaJugador.sexo=1) OR (fichaJugador.serieActual='14' AND fichaJugador.sexo=1) OR (fichaJugador.serieActual='13' AND fichaJugador.sexo=1) OR (fichaJugador.serieActual='17' AND fichaJugador.sexo=2) )

function eliminarAtencionDiaria($GET){
    include("conexion.php");
    $SQL="DELETE FROM atencion_diaria_federacion WHERE	idatencion_diaria_federacion=".$GET["id_atencion_diaria"].";";
    $link->query($SQL);
    // print($SQL);
    $link->close();
}

function eliminarAtencionDiariaExamenes($POST){
    include("conexion.php");
    $SQL="DELETE FROM examen_solicitado_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$POST["id_atencion_diaria"].";";
    $link->query($SQL);
    // print($SQL);
    $link->close();
}

function eliminarAtencionDiariaTratamiento($POST){
    include("conexion.php");
    $SQL="DELETE FROM tratamiento_aplicado_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$POST["id_atencion_diaria"].";";
    $link->query($SQL);
    // print($SQL);
    $link->close();
}

function eliminarAtencionDiariaTrabajoReadaptador($POST){
    include("conexion.php");
    $SQL="DELETE FROM trabajo_readaptador_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$POST["id_atencion_diaria"].";";
    $link->query($SQL);
    // print($SQL);
    $link->close();
}

function eliminarAtencionDiariaAltaDeportiva($POST){
    include("conexion.php");
    $SQL="DELETE FROM alta_deportiva_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$POST["id_atencion_diaria"].";";
    $link->query($SQL);
    // print($SQL);
    $link->close();
}

function eliminarAtencionDiariaRecomendacionAlta($POST){
    include("conexion.php");
    $SQL="DELETE FROM recomendacion_alta_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$POST["id_atencion_diaria"].";";
    $link->query($SQL);
    // print($SQL);
    $link->close();
}

function eliminarAtencionDiariaLesiones($POST){
    include("conexion.php");
    $SQL="DELETE FROM zonas_lesion_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$POST["id_atencion_diaria"].";";
    $link->query($SQL);
    // print($SQL);
    $link->close();
}

function calcular_posicion_jugador($id){
    
	$jugador['portero'] = 0; 			//1
	$jugador['defensorCentral'] = 0;	//3,4,5,7,  Defensas
	$jugador['lateralIzquierdo'] = 0;            //2,6,      Defensas
	$jugador['lateralDerecho'] = 0;	//9,10,11,14,15,16  Mediocampistas
	$jugador['volanteDefensivo'] = 0;		//8,12,13,17,18,22, Med 
    $jugador['volanteIzquierdo'] = 0;		//8,12,13,17,18,22, Med 
    $jugador['volanteDerecho'] = 0;		//8,12,13,17,18,22,     Med 
	$jugador['volanteMixto'] = 0;	//19,20,21,			Med
	$jugador['volanteOfensivo'] = 0;			//23,27,            Delanteros
	$jugador['extremoIzquierdo'] = 0;	//24,25,26,28,29   
	$jugador['extremoDerecho'] = 0;	//24,25,26,28,29   
	$jugador['delanteroCentro'] = 0;	//24,25,26,28,29   
	$jugador['posicionPrincipal'] = '';	//24,25,26,28,29
	include("conexion.php");
	$resultado = $link->query("SELECT posicion, numero_posicion FROM posicionCancha WHERE idfichaJugador like ".$id." ORDER BY posicionCancha.numero_posicion DESC");
	while($row = mysqli_fetch_array($resultado)){
		
		if($row['posicion']==1){
			$jugador['portero']=1;
			$jugador['posicionPrincipal']='Arquero';
			
		}else if($row['posicion']==2){
			$jugador['defensorCentral']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Defensor Central';
			//}
		}else if($row['posicion']==3){
			$jugador['lateralIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Lateral Izquierdo';
			//}
		}else if($row['posicion']==4){
			$jugador['lateralDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Lateral Derecho';
			//}
		}else if($row['posicion']==5){
			$jugador['volanteDefensivo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Defensivo';
			//}
		}else if($row['posicion']==6){
			$jugador['volanteIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Izquierdo';
			//}
		}else if($row['posicion']==7){
			$jugador['volanteDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Derecho';
			//}
		}else if($row['posicion']==8){
			$jugador['volanteMixto']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Mixto';
			//}
		}else if($row['posicion']==9){
			$jugador['volanteOfensivo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Ofensivo';
			//}
		}else if($row['posicion']==10){
			$jugador['extremoIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Extremo Izquierdo';
			//}
		}else if($row['posicion']==11){
			$jugador['extremoDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Extremo Derecho';
			//}
		}else if($row['posicion']==12){
			$jugador['delanteroCentro']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Delantero Centro';
		}
	}
	return $jugador['posicionPrincipal'];
    
}


function calcular_posicion_jugador2($id){
    
	$jugador['portero'] = 0; 			//1
	$jugador['defensorCentral'] = 0;	//3,4,5,7,  Defensas
	$jugador['lateralIzquierdo'] = 0;            //2,6,      Defensas
	$jugador['lateralDerecho'] = 0;	//9,10,11,14,15,16  Mediocampistas
	$jugador['volanteDefensivo'] = 0;		//8,12,13,17,18,22, Med 
    $jugador['volanteIzquierdo'] = 0;		//8,12,13,17,18,22, Med 
    $jugador['volanteDerecho'] = 0;		//8,12,13,17,18,22,     Med 
	$jugador['volanteMixto'] = 0;	//19,20,21,			Med
	$jugador['volanteOfensivo'] = 0;			//23,27,            Delanteros
	$jugador['extremoIzquierdo'] = 0;	//24,25,26,28,29   
	$jugador['extremoDerecho'] = 0;	//24,25,26,28,29   
	$jugador['delanteroCentro'] = 0;	//24,25,26,28,29   
	$jugador['posicionPrincipal'] = '';	//24,25,26,28,29
	include("conexion.php");
	$resultado = $link->query("SELECT posicion, numero_posicion FROM posicionCancha WHERE idfichaJugador like ".$id." ORDER BY posicionCancha.numero_posicion DESC");
	$posicion="";
	while($row = mysqli_fetch_array($resultado)){
		$posicion=$row['posicion'];
		if($row['posicion']==1){
			$jugador['portero']=1;
			$jugador['posicionPrincipal']='Arquero';
			
		}else if($row['posicion']==2){
			$jugador['defensorCentral']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Defensor Central';
			//}
		}else if($row['posicion']==3){
			$jugador['lateralIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Lateral Izquierdo';
			//}
		}else if($row['posicion']==4){
			$jugador['lateralDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Lateral Derecho';
			//}
		}else if($row['posicion']==5){
			$jugador['volanteDefensivo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Defensivo';
			//}
		}else if($row['posicion']==6){
			$jugador['volanteIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Izquierdo';
			//}
		}else if($row['posicion']==7){
			$jugador['volanteDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Derecho';
			//}
		}else if($row['posicion']==8){
			$jugador['volanteMixto']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Mixto';
			//}
		}else if($row['posicion']==9){
			$jugador['volanteOfensivo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Ofensivo';
			//}
		}else if($row['posicion']==10){
			$jugador['extremoIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Extremo Izquierdo';
			//}
		}else if($row['posicion']==11){
			$jugador['extremoDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Extremo Derecho';
			//}
		}else if($row['posicion']==12){
			$jugador['delanteroCentro']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Delantero Centro';
		}
	}
	return ["texto_posicion" => $jugador['posicionPrincipal'],"codigo_posicion" => $posicion];
    
}

function consultarInformeMedicoPdf($id){
    include("conexion.php");
    $SQL="SELECT * FROM informe_medico WHERE idinforme_medico=".$id.";";
    $result_informe_medico=$link->query($SQL);
    $datos=[];
    while($row=mysqli_fetch_array($result_informe_medico)){
        $datos[]=utf8_converter($row);
    }
    $link->close();
    return (sizeof($datos)>0)? ["respuesta"=>true,"datos"=>$datos]: ["respuesta"=>false,"datos"=>[]];
}

function consultarAtencionPdf($id){
    // recomendacion_alta_atencion_diaria
    include("conexion.php");
    $SQL="SELECT * FROM atencion_diaria_federacion,fichaJugador WHERE atencion_diaria_federacion.idatencion_diaria_federacion=".$id." AND fichaJugador.idfichaJugador=atencion_diaria_federacion.idfichaJugador;";
    $result_atencion=$link->query($SQL);
    $datos=[];
    while($row_atencion_diaria=mysqli_fetch_array($result_atencion)){

        $SQL_tratamiento_aplicado="SELECT * FROM tratamiento_aplicado_atencion_diaria_federacion WHERE  idatencion_diaria_federacion=".$row_atencion_diaria["idatencion_diaria_federacion"].";";
        $result_tratamiento_aplicado=$link->query($SQL_tratamiento_aplicado);
        $datos_tratamiento_aplicado=[];
        while($row_tratamiento_aplicado=mysqli_fetch_array($result_tratamiento_aplicado)){
            $datos_tratamiento_aplicado[]=utf8_converter($row_tratamiento_aplicado);
        }
        $row_atencion_diaria["lista_tratamiento"]=$datos_tratamiento_aplicado;

        $SQL_tranajo_readaptor="SELECT * FROM trabajo_readaptador_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$row_atencion_diaria["idatencion_diaria_federacion"]."";
        $result_trabajo_readaptador=$link->query($SQL_tranajo_readaptor);
        $datos_trabajo=[];
        while($row_trabajo=mysqli_fetch_array($result_trabajo_readaptador)){
            $datos_trabajo[]=utf8_converter($row_trabajo);
        }
        $row_atencion_diaria["trabajo_readaptor"]= $datos_trabajo;

        $SQL_recomendacion="SELECT * FROM recomendacion_alta_atencion_diaria_federacion WHERE  idatencion_diaria_federacion=".$row_atencion_diaria["idatencion_diaria_federacion"].";";
        $result_recomendacion=$link->query($SQL_recomendacion);
        $datos_recomendacion=[];
        while($row_recomendacion=mysqli_fetch_array($result_recomendacion)){
            $datos_recomendacion[]=utf8_converter($row_recomendacion);
        }
        $row_atencion_diaria["lista_recomendacion"]=$datos_recomendacion;

        if($row_atencion_diaria["idinforme_medico"]!=null){
            $SQL_informe_medico="SELECT * FROM informe_medico WHERE  idinforme_medico=".$row_atencion_diaria["idinforme_medico"].";";
            $result_informe_medico=$link->query($SQL_informe_medico);
            $datos_informe_medico=[];
            while($row_informe_medico=mysqli_fetch_array($result_informe_medico)){
                $datos_informe_medico[]=utf8_converter($row_informe_medico);
            }
            $row_atencion_diaria["informe_medico"]=$datos_informe_medico;
        }
        
        $SQL_recomendacion="SELECT * FROM recomendaciones_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$row_atencion_diaria["idatencion_diaria_federacion"]."";
        $result_recomendacion=$link->query($SQL_recomendacion);
        $datos_recomendacion=[];
        while($row_recomendacion=mysqli_fetch_array($result_recomendacion)){
            $datos_recomendacion[]=utf8_converter($row_recomendacion);
        }
        $row_atencion_diaria["recomendaciones"]= $datos_recomendacion;

        $datos[]=utf8_converter($row_atencion_diaria);
    }
    $link->close();
    return (sizeof($datos)>0)? ["respuesta"=>true,"datos"=>$datos]: ["respuesta"=>false,"datos"=>[]];
}

function consultarTratamientoControl($id){
    // recomendacion_alta_atencion_diaria
    include("conexion.php");
    $SQL="SELECT * FROM atencion_diaria_federacion,fichaJugador WHERE atencion_diaria_federacion.idinforme_medico=".$id." AND fichaJugador.idfichaJugador=atencion_diaria_federacion.idfichaJugador;";
    $result_atencion=$link->query($SQL);
    $datos=[];
    $lista_tratamiento_control=[];
    while($row_atencion_diaria=mysqli_fetch_array($result_atencion)){

        $SQL_tratamiento_aplicado="SELECT * FROM tratamiento_aplicado_atencion_diaria_federacion WHERE  idatencion_diaria_federacion=".$row_atencion_diaria["idatencion_diaria_federacion"].";";
        $result_tratamiento_aplicado=$link->query($SQL_tratamiento_aplicado);
        $datos_tratamiento_aplicado=[];
        while($row_tratamiento_aplicado=mysqli_fetch_array($result_tratamiento_aplicado)){
            // $lista_tratamiento_control[]=utf8_converter($row_tratamiento_aplicado);
            $datos_tratamiento_aplicado[]=utf8_converter($row_tratamiento_aplicado);
        }
        $lista_tratamiento_control[]=$datos_tratamiento_aplicado;
        $row_atencion_diaria["lista_tratamiento"]=$datos_tratamiento_aplicado;
        $datos[]=utf8_converter($row_atencion_diaria);
    }
    $link->close();
    return (sizeof($datos)>0)? ["respuesta"=>true,"datos"=>$datos,"lista_tratamientos"=>$lista_tratamiento_control]: ["respuesta"=>false,"datos"=>[],"lista_tratamientos"=>[]];
}


function registrarRecomendacionSinfecha($numeroRecomendacion,$id,$POST){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="INSERT INTO recomendaciones_atencion_diaria_federacion(
        recomendacion_numero,
        fecha_software,
        nombre_usuario_software,
        idatencion_diaria_federacion
    )
    VALUES(
        ".$numeroRecomendacion.",
        '". $fecha_software."',
        '".$POST["nombre_usuario_software"]."',
        $id
    )";
    $link->query($SQL);
    $link->close();
}

function registrarRecomendacionConfecha($numeroRecomendacion,$id,$fecha,$POST){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="INSERT INTO recomendaciones_atencion_diaria_federacion(
        recomendacion_numero,
        fecha_recomendacion,
        fecha_software,
        nombre_usuario_software,
        idatencion_diaria_federacion
    )
    VALUES(
        ".$numeroRecomendacion.",
        '".$fecha."',
        '". $fecha_software."',
        '".$POST["nombre_usuario_software"]."',
        $id
    )";
    $link->query($SQL);
    $link->close();
}

function eliminarRecomendacion($POST){
    include("conexion.php");
    $SQL="DELETE FROM recomendaciones_atencion_diaria_federacion WHERE idatencion_diaria_federacion=".$POST["id_atencion_diaria"].";";
    $link->query($SQL);
}

?>