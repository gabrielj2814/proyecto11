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
    array_walk_recursive($array,
    function(&$item,
    $key){
        if(!mb_detect_encoding($item,
        'utf-8',
        true)){
            $item = utf8_encode($item); 
        }
    });
    return $array;
}


function operacion($POST,$FILES){
    if($POST["tipo_formulario"]==="false"){
        return registrar($POST,$FILES);
    }
    else{
        return actualizar($POST,$FILES);
    }
}
function insertarPdf($id,$nombre,$descripcion,$POST){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="INSERT INTO archivo_pdf_jugador(
        nombre_archivo,
        titulo_archivo,
        fecha_software,
        nombre_usuario_software,
        idfichaJugador
    )
    VALUES(
        '$nombre',
        '$descripcion',
        '$fecha_software',
        '".$POST["nombre_usuario_software"]."',
        $id
    );";
    $link->query($SQL);
    $id_archivo=$link->insert_id;
    $link->close();
    return $id_archivo;
}

function eliminarRowPdf($listIdPdfDelete,$idJugador){
    for($contador=0;$contador<sizeof($listIdPdfDelete);$contador++){
        $idPdf=$listIdPdfDelete[$contador];
        include("conexion.php");
        $SQL="DELETE FROM archivo_pdf_jugador WHERE idarchivo_pdf_jugador=$idPdf;";
        $link->query($SQL);
        $link->close();
        if(file_exists("../pdf_jugadores/$idJugador/$idPdf.pdf")){
            unlink("../pdf_jugadores/$idJugador/$idPdf.pdf");
        }
    }
}

function actualizarRowPdf($listIdPdfUpdate,$POST,$idJugador){
    $fecha_software=date_futbolJoven();
    for($contador=0;$contador<sizeof($listIdPdfUpdate);$contador++){
        $idPdf=$listIdPdfUpdate[$contador];
        $nombre=$POST["array_nombre_pdf_update"][$contador];
        $titulo=$POST["array_descripcion_pdf_update"][$contador];
        include("conexion.php");
        $SQL="UPDATE archivo_pdf_jugador SET 
                nombre_archivo='$nombre',
                titulo_archivo='$titulo',
                fecha_software='$fecha_software',
                nombre_usuario_software='".$POST["nombre_usuario_software"]."'
                WHERE idarchivo_pdf_jugador=$idPdf;";
        $link->query($SQL);
        $link->close();
        if(file_exists("../temp/$idPdf"."_upload".".pdf")){
            if(file_exists("../pdf_jugadores/$idJugador/$idPdf.pdf")){
                unlink("../pdf_jugadores/$idJugador/$idPdf.pdf");
                copy("../temp/$idPdf"."_upload".".pdf","../pdf_jugadores/$idJugador/$idPdf.pdf");
            }
            else{
                copy("../temp/$idPdf"."_upload".".pdf","../pdf_jugadores/$idJugador/$idPdf.pdf");
            }
           
        }
    }
}

function consultarArchivosPdfs($id){
    include("conexion.php");
    $SQL="SELECT * FROM archivo_pdf_jugador WHERE idfichaJugador=$id ;";
    $result_pdf=$link->query($SQL);
    $pdf_list=[];
    while($row_pdf=mysqli_fetch_array($result_pdf)){
        $pdf_list[]=utf8_converter($row_pdf);
    }
    $link->close();
    return $pdf_list;
}

function actualizar($POST,$FILES){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $condicion_sql="";
    if($POST["condicion"]==="5" || $POST["condicion"]==="1"){
        $condicion_sql="
        estado='5',
        ano_llegada_club_ficha_jugador_mc=".validarValoresNullNumber($POST["ano_llegada_club"]).",
        fecha_inicio_contrato_ficha_jugador_mc=".validarValoresNullString($POST["fecha_inicio_contrato"]).",
        fecha_fin_contrato_ficha_jugador_mc=".validarValoresNullString($POST["fecha_fin_contrato"]).",
        costos_derecho_ficha_jugador_mc=".validarValoresNullString($POST["costos_derecho"]).",
        clausula_rescision_ficha_jugador_mc=".validarValoresNullString($POST["clausula_rescision"]).",
        observacion_datos_contrato_condicion_pertenece_ficha_jugador_mc=".validarValoresNullString($POST["observacion_datos_contrato_condicion_pertenece"]).",
        ";
    }
    else if($POST["condicion"]==="0"){
        $condicion_sql="
        estado='0',
        ano_llegada_club_ficha_jugador_mc=".validarValoresNullNumber($POST["ano_llegada_club"]).",
        fecha_inicio_contrato_ficha_jugador_mc=".validarValoresNullString($POST["fecha_inicio_contrato"]).",
        fecha_fin_contrato_ficha_jugador_mc=".validarValoresNullString($POST["fecha_fin_contrato"]).",
        costos_derecho_ficha_jugador_mc=".validarValoresNullString($POST["costos_derecho"]).",
        clausula_rescision_ficha_jugador_mc=".validarValoresNullString($POST["clausula_rescision"]).",
        observacion_datos_contrato_condicion_pertenece_ficha_jugador_mc=".validarValoresNullString($POST["observacion_datos_contrato_condicion_pertenece"]).",
        ";
    }
    else{
        $condicion_sql="
        ano_llegada_club_ficha_jugador_mc=NULL,
        fecha_inicio_contrato_ficha_jugador_mc=NULL,
        fecha_fin_contrato_ficha_jugador_mc=NULL,
        costos_derecho_ficha_jugador_mc=NULL,
        clausula_rescision_ficha_jugador_mc=NULL,
        observacion_datos_contrato_condicion_pertenece_ficha_jugador_mc=NULL,
        ";
    }
    $SQL="UPDATE fichaJugador SET
        nombre='".$POST["nombre"]."',
        apellido1='".$POST["apellido1"]."',
        apellido2='".$POST["apellido2"]."',
        rut='".$POST["rut"]."',
        fechaNacimiento='".$POST["fecha_nacimiento"]."',
        nacionalidad1='".$POST["nacionalidad"]."',
        nacionalidad2='".$POST["nacionalidad_adicional"]."',
        pieHabil=".$POST["pie_habil"].",
        altura=".$POST["estatura"].",
        numeroDorsal=".$POST["dorsal"].",
        email='".$POST["correo"]."',
        telefono='".$POST["telefono"]."',
        prevision=".$POST["prevision"].",
        seguro_ficha_jugador_mc=".$POST["seguro"].",

        pasaporte_ficha_jugador_mc='".$POST["pasaporte"]."',
        fecha_vencimiento_pasaporte_ficha_jugador_mc='".$POST["fecha_vencimiento_pasaporte"]."',
        fecha_vencimiento_rut_ficha_jugador_mc='".$POST["fecha_vencimiento_rut"]."',
        valor_mercado_ficha_jugador_mc='".$POST["valor_mercado"]."',
        representante_ficha_jugador_mc='".$POST["representante"]."',
        correo_representante_ficha_jugador_mc='".$POST["correo_representante"]."',
        telefono_representante_ficha_jugador_mc='".$POST["telefono_representante"]."',

        formado_en_ficha_jugador_mc=".validarValoresNullNumber($POST["formado_en"]).",
        otro_club_ficha_jugador_mc=".validarValoresNullString($POST["otro_club"]).",
        $condicion_sql

        sueldo_bruto_ficha_jugador_mc='".$POST["sueldo_bruto"]."',
        sueldo_neto_ficha_jugador_mc='".$POST["sueldo_neto"]."',
        monto_arriendo_vivienda_ficha_jugador_mc='".$POST["monto_arriendo_vivienda"]."',
        valor_total_contrato_ficha_jugador_mc='".$POST["valor_total_contrato"]."',
        otros_costos_asociados_ficha_jugador_mc='".$POST["otros_costos_asociados"]."',
        premios_pactados_ficha_jugador_mc='".$POST["premios_pactados"]."',
        observacion_datos_contrato_ficha_jugador_mc='".$POST["observacion_datos_contrato"]."',

        estado_ficha_jugador_mc=".$POST["estado"].",
        fecha_termino_contrato_ficha_jugador_mc=".validarValoresNullString($POST["fecha_termino_contrato"]).",
        motivo_ficha_jugador_mc=".validarValoresNullNumber($POST["motivo"]).",
        costos_asociados_ficha_jugador_mc=".validarValoresNullString($POST["costos_asociados"]).",
        observacion_rescision_contrato_ficha_jugador_mc=".validarValoresNullString($POST["observacion_rescision_contrato"]).",
        serieActual=99,
        sexo=1,
        derecho_federativo=".$POST["derecho_federativo"].",
        movilizacion='".$POST["movilizacion"]."',
        colacion='".$POST["colacion"]."',
        viaticos='".$POST["viaticos"]."',
        otros_remuneraciones='".$POST["remuneracion"]."',
        desgaste='".$POST["desgaste"]."',

        fecha='".$fecha_software."',
        nombre_usuario_software='".$POST["nombre_usuario_software"]."'

    WHERE 

    idfichaJugador=".$POST["idficha_jugador"]."
    
    ;";
    // print($SQL);
    $link->query($SQL);
    $id=$POST["idficha_jugador"];
    eliminarPosicionCancha($id);
    insertarPosicionesCancha($POST["posicion"],0,$id);
    if($POST["posicion2"]!=="null"){
        insertarPosicionesCancha($POST["posicion2"],1,$id);
    }
    eliminarBonoJugador($id);
    insertarBonosJugador($POST,$id);
    $id_prestamo=NULL;
    if(validarValoresNullNumber($POST["condicion"])!=="NULL" && validarValoresNullNumber($POST["condicion"])!=="5"){
        $id_prestamo=insertarPerstamosJugador($id,$POST);
    }
    $respuesta_imagen_jugador=guardarFotoJugador($id,$POST);
    if(array_key_exists("array_id_pdf_delete",$POST)){
        eliminarRowPdf($POST["array_id_pdf_delete"],$id);
    }
    
    if(array_key_exists("array_id_pdf_update",$POST)){
        actualizarRowPdf($POST["array_id_pdf_update"],$POST,$id);

    }
    $respuesta_imagen_jugador=guardarFotoJugador($id,$POST);
    if(array_key_exists("array_id_buffer_pdf",$POST)){
        for($contador_file=0;$contador_file<sizeof($POST["array_id_buffer_pdf"]);$contador_file++){
            $nombre=$POST["array_nombre_pdf"][$contador_file];
            $descripcion=$POST["array_descripcion_pdf"][$contador_file];
            $idPdf=insertarPdf($id,$nombre,$descripcion,$POST);
            moverPdfBuffer($id,$idPdf,$POST["array_id_buffer_pdf"][$contador_file]);
        }
        borrarArchivosBuffer();
    }
    
    return ["id_ficha" => $id,"imagen_jugador" =>$respuesta_imagen_jugador, "id_prestamo" => $id_prestamo];
}


function registrar($POST,$FILES){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="
    INSERT INTO fichaJugador(
        nombre,
        apellido1,
        apellido2,
        rut,
        fechaNacimiento,
        nacionalidad1,
        nacionalidad2,
        pieHabil,
        altura,
        numeroDorsal,
        email,
        telefono,
        prevision,
        seguro_ficha_jugador_mc,

        pasaporte_ficha_jugador_mc,
        fecha_vencimiento_pasaporte_ficha_jugador_mc,
        fecha_vencimiento_rut_ficha_jugador_mc,
        valor_mercado_ficha_jugador_mc,
        representante_ficha_jugador_mc,
        correo_representante_ficha_jugador_mc,
        telefono_representante_ficha_jugador_mc,

        formado_en_ficha_jugador_mc,
        otro_club_ficha_jugador_mc,
        estado,
        ano_llegada_club_ficha_jugador_mc,
        fecha_inicio_contrato_ficha_jugador_mc,
        fecha_fin_contrato_ficha_jugador_mc,
        costos_derecho_ficha_jugador_mc,
        clausula_rescision_ficha_jugador_mc,
        observacion_datos_contrato_condicion_pertenece_ficha_jugador_mc,
        
        sueldo_bruto_ficha_jugador_mc,
        sueldo_neto_ficha_jugador_mc,
        monto_arriendo_vivienda_ficha_jugador_mc,
        valor_total_contrato_ficha_jugador_mc,
        otros_costos_asociados_ficha_jugador_mc,
        premios_pactados_ficha_jugador_mc,
        observacion_datos_contrato_ficha_jugador_mc,

        estado_ficha_jugador_mc,
        fecha_termino_contrato_ficha_jugador_mc,
        motivo_ficha_jugador_mc,
        costos_asociados_ficha_jugador_mc,
        observacion_rescision_contrato_ficha_jugador_mc,
        serieActual,
        sexo,
        derecho_federativo,
        movilizacion,
        colacion,
        viaticos,
        otros_remuneraciones,
        desgaste,

        fecha,
        nombre_usuario_software
    )
    
    VALUES(
        '".$POST["nombre"]."',

        '".$POST["apellido1"]."',

        '".$POST["apellido2"]."',

        '".$POST["rut"]."',

        '".$POST["fecha_nacimiento"]."',

        '".$POST["nacionalidad"]."',

        '".$POST["nacionalidad_adicional"]."',

        ".$POST["pie_habil"].",

        ".$POST["estatura"].",

        ".$POST["dorsal"].",

        '".$POST["correo"]."',

        '".$POST["telefono"]."',

        ".$POST["prevision"].",

        ".$POST["seguro"].",

        '".$POST["pasaporte"]."',

        '".$POST["fecha_vencimiento_pasaporte"]."',

        '".$POST["fecha_vencimiento_rut"]."',

        '".$POST["valor_mercado"]."',

        '".$POST["representante"]."',

        '".$POST["correo_representante"]."',

        '".$POST["telefono_representante"]."',

        ".validarValoresNullNumber($POST["formado_en"]).",

        ".validarValoresNullString($POST["otro_club"]).",

        ".(($POST["condicion"]==="5")?validarValoresNullNumber($POST["condicion"]):"NULL").",

        ".validarValoresNullNumber($POST["ano_llegada_club"]).",

        ".validarValoresNullString($POST["fecha_inicio_contrato"]).",

        ".validarValoresNullString($POST["fecha_fin_contrato"]).",

        ".validarValoresNullString($POST["costos_derecho"]).",

        ".validarValoresNullString($POST["clausula_rescision"]).",

        ".validarValoresNullString($POST["observacion_datos_contrato_condicion_pertenece"]).",

        '".$POST["sueldo_bruto"]."',

        '".$POST["sueldo_neto"]."',

        '".$POST["monto_arriendo_vivienda"]."',

        '".$POST["valor_total_contrato"]."',

        '".$POST["otros_costos_asociados"]."',

        '".$POST["premios_pactados"]."',

        '".$POST["observacion_datos_contrato"]."',

        ".$POST["estado"].",

        ".validarValoresNullString($POST["fecha_termino_contrato"]).",

        ".validarValoresNullNumber($POST["motivo"]).",

        ".validarValoresNullString($POST["costos_asociados"]).",

        ".validarValoresNullString($POST["observacion_rescision_contrato"]).",

        99,
        1,
        ".$POST["derecho_federativo"].",
        '".$POST["movilizacion"]."',
        '".$POST["colacion"]."',
        '".$POST["viaticos"]."',
        '".$POST["remuneracion"]."',
        '".$POST["desgaste"]."',

        '".$fecha_software."',

        '".$POST["nombre_usuario_software"]."'
    ) ;
    ";
    // print($SQL);
    $link->query($SQL);
    $id=$link->insert_id;
    $link->close();
    insertarPosicionesCancha($POST["posicion"],0,$id);
    if($POST["posicion2"]!=="null"){
        insertarPosicionesCancha($POST["posicion2"],1,$id);
    }
    insertarBonosJugador($POST,$id);
    $id_prestamo=NULL;
    if(validarValoresNullNumber($POST["condicion"])!=="NULL" && validarValoresNullNumber($POST["condicion"])!=="5"){
        $id_prestamo=insertarPerstamosJugador($id,$POST);
    }
    $respuesta_imagen_jugador=guardarFotoJugador($id,$POST);
    if(array_key_exists("array_id_buffer_pdf",$POST)){
        for($contador_file=0;$contador_file<sizeof($POST["array_id_buffer_pdf"]);$contador_file++){
            $nombre=$POST["array_nombre_pdf"][$contador_file];
            $descripcion=$POST["array_descripcion_pdf"][$contador_file];
            $idPdf=insertarPdf($id,$nombre,$descripcion,$POST);
            moverPdfBuffer($id,$idPdf,$POST["array_id_buffer_pdf"][$contador_file]);
        }
        borrarArchivosBuffer();
    }
    return ["id_ficha" => $id,"imagen_jugador" =>$respuesta_imagen_jugador, "id_prestamo" => $id_prestamo];
}

function moverPdfBuffer($id,$idPdf,$idBuffer){
    $ruta="../pdf_jugadores";
    if(file_exists($ruta)){
        $ruta.="/".$id;
        $archivo=$ruta."/".$idPdf.".pdf";;
        if(file_exists($ruta)){
            copy("../temp/".$idBuffer.".pdf",$archivo);
        }
        else{
            mkdir($ruta, 0777, true);
            copy("../temp/".$idBuffer.".pdf",$archivo);
        }
    }
    else{
        mkdir($ruta, 0777, true);
        $ruta.="/".$id;
        $archivo=$ruta."/".$idPdf.".pdf";;
        if(file_exists($ruta)){
            copy("../temp/".$idBuffer.".pdf",$archivo);
        }
        else{
            mkdir($ruta, 0777, true);
            copy("../temp/".$idBuffer.".pdf",$archivo);
        }
    }
}

function insertarBonosJugador($POST,$id){
    
    $fecha_software=date_futbolJoven();
    for($contador=0;$contador<sizeof($POST["array_tipo_bono"]);$contador++){
        if($POST["array_monto"][$contador]!==""){
            include("conexion.php");
            $SQL="INSERT INTO bono_jugador(
                tipo_bono,
                monto,
                comentario_bono,
                fecha_software,
                nombre_usuario_software,
                moneda,
                idfichaJugador
            )
            VALUES(
                ".$POST["array_tipo_bono"][$contador].",
                '".$POST["array_monto"][$contador]."',
                '".$POST["array_comentario"][$contador]."',
                '".$fecha_software."',
                '".$POST["nombre_usuario_software"]."',
                ".$POST["array_moneda"][$contador].",
                ".$id."
            )";
            // print($SQL);
            $link->query($SQL);
            $link->close();
        }
    }
}

function eliminarBonoJugador($id){
    include("conexion.php");
    $SQL="DELETE FROM bono_jugador WHERE idfichaJugador=$id";
    $link->query($SQL);
    $link->close();
}

function consultarBonosJugador($id){
    include("conexion.php");
    $SQL="SELECT * FROM bono_jugador WHERE idfichaJugador=$id";
    $resultBono=$link->query($SQL);
    $bonos=[];
    while($rowBono=mysqli_fetch_array($resultBono)){
        $bonos[]=utf8_converter($rowBono);
    }
    $link->close();
    return $bonos;
}

function insertarPerstamosJugador($id,$POST){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="
    INSERT  INTO prestamo_ficha_jugador_mc(
        condicion_prestamo_ficha_jugador_mc,
        pais_origen_club_prestamo_ficha_jugador_mc,
        origen_club_prestamo_ficha_jugador_mc,
        fecha_inicio_prestamo_prestamo_ficha_jugador_mc,
        fecha_fin_prestamo_prestamo_ficha_jugador_mc,
        valor_prestamo_prestamo_ficha_jugador_mc,
        opcion_compra_prestamo_ficha_jugador_mc,
        observacion_datos_deportivos_prestamo_ficha_jugador_mc,
        fecha_fin_contrato_prestamo,

        fecha_software,
        nombre_usuario_software,
        idfichaJugador
    )
    VALUES(
        ".$POST["condicion"].",

        '".$POST["pais_origen_club"]."',

        '".$POST["origen_club"]."',

        '".$POST["fecha_inicio_prestamo"]."',

        '".$POST["fecha_fin_prestamo"]."',

        '".$POST["valor_prestamo"]."',

        '".$POST["opcion_compra"]."',

        '".$POST["observacion_datos_deportivos"]."',

        ".validarValoresNullString($POST["fecha_fin_contrato_prestamo"]).",
        
        '".$fecha_software."',

        '".$POST["nombre_usuario_software"]."',

        ".$id."
    );
    ";
    $link->query($SQL);
    $id_prestamo=$link->insert_id;
    $link->close();
    return ($id_prestamo!="0")?$id_prestamo:NULL;
}

function guardarFotoJugador($id,$POST){
    if($POST["tipo_formulario"]==="false"){

        return copiarFoto($id);
    }
    else{
        if(file_exists("../subir_imagen3/buffer_imagen.png")){
            unlink("../foto_jugadores/".$id.".png");
            if(copy("../subir_imagen3/buffer_imagen.png","../foto_jugadores/".$id.".png")){
                unlink("../subir_imagen3/buffer_imagen.png");
                return "imagen copiada existosamente vvv";
            }
            else{
                return "error al copiar la imagen xxxx";
            }
        }
    }
}

function copiarFoto($id){
    if(file_exists("../subir_imagen3/buffer_imagen.png")){
        if(copy("../subir_imagen3/buffer_imagen.png","../foto_jugadores/".$id.".png")){
            unlink("../subir_imagen3/buffer_imagen.png");
            return "imagen copiada existosamente";
        }
        else{
            return "error al copiar la imagen";
        }
    }
    else{
        copy("../../config/camiseta.png","../foto_jugadores/".$id.".png");
    }
    
}

function guardarContratoPdf($id,$FILES,$idPdf){
    $ruta="../pdf_jugadores";
    if(file_exists($ruta)){
        return verificarCarpetaJugador($id,$ruta,$FILES,$idPdf);
    }
    else{
        mkdir($ruta, 0777, true);
        return verificarCarpetaJugador($id,$ruta,$FILES,$idPdf);
    }
}

function verificarCarpetaJugador($id,$ruta,$FILES,$idPdf){
    $ruta.="/".$id;
    $FILES["name"]=$idPdf.".pdf";
    $archivo=$ruta."/".$FILES["name"];
    if(file_exists($ruta)){
        return guardarPdfJugador($archivo,$FILES);
    }
    else{
        mkdir($ruta, 0777, true);
        return guardarPdfJugador($archivo,$FILES);
    }
}

function guardarPdfJugador($archivo,$FILES){
    $resultado=NULL;
    if(!file_exists($archivo)){
        $resultado=@move_uploaded_file($FILES["tmp_name"],$archivo);
        return "pdf subido corectamente ";
    }
    else{
        return "error al guardar el pdf por que ya exites un pdf con este mismo nombre -> ".$FILES["name"];
    }

}

function validarValoresNullString($valor){
    return ($valor==="null")? "NULL":"'".$valor."'";
}

function validarValoresNullNumber($valor){
    return ($valor==="null")? "NULL":$valor;
}

function obtenerPrestamosCheck($POST){
    $str_prestamo="";
    if(sizeof($POST["array_lista_prestamo"])===1){
        
        $str_prestamo=" estado=".$POST["array_lista_prestamo"][0]."";
    }
    else if(sizeof($POST["array_lista_prestamo"])>1){
        $str_prestamo="";
        for($contador=0;$contador<sizeof($POST["array_lista_prestamo"]);$contador++){
            $POST["array_lista_prestamo"][$contador]="estado=".$POST["array_lista_prestamo"][$contador];
        }
        $str_join_prestamos=implode(" OR ",$POST["array_lista_prestamo"]);
        $str_prestamo=" ".$str_join_prestamos."";
    }
    return  $str_prestamo;
}

function consultarDirenciasDemeses($hasta){
    include("conexion.php");
    $SQL="SELECT DATEDIFF('$hasta',NOW()) AS meses_diferencia";
    $result_meses=$link->query($SQL);
    $mes=[];
    while($row=mysqli_fetch_array($result_meses)){
        $mes[]=utf8_converter($row);
    }
    return $mes[0];
    
}

function consultarFichaJugador($POST){
    include("conexion.php");
    $SQL=NULL;
    if($POST["nombre"]===""){
        $SQL="SELECT * FROM fichaJugador;";
    }
    else{
        $SQL="SELECT * FROM fichaJugador WHERE (nombre LIKE '%".$POST["nombre"]."%' OR apellido1 LIKE '%".$POST["nombre"]."%' OR apellido2 LIKE '%".$POST["nombre"]."%');";
    }
    $ficha_jugador_result=$link->query($SQL);
    $ficha_jugadores=[];
    while($row_ficha_jugador=mysqli_fetch_array($ficha_jugador_result)){

        $row_ficha_jugador["meses_diferencia"]=consultarDirenciasDemeses($row_ficha_jugador["fecha_fin_contrato_ficha_jugador_mc"]);
        $valido=false;
        // file_exists
        $row_ficha_jugador["estado_contrato_pdf"]=file_exists("../pdf_jugadores/".$row_ficha_jugador["idfichaJugador"]."/".$row_ficha_jugador["idfichaJugador"].".pdf");
        $row_ficha_jugador["bonos"]=consultarBonosJugador($row_ficha_jugador["idfichaJugador"]);
        $row_ficha_jugador["archivos_pdfs"]=consultarArchivosPdfs($row_ficha_jugador["idfichaJugador"]);

        $posicion=calcular_posicion_jugador2($row_ficha_jugador["idfichaJugador"]);
        $row_ficha_jugador["posicion"]=$posicion["codigo_posicion"];
        $row_ficha_jugador["posicion_texto"]=$posicion["texto_posicion"];
        $row_ficha_jugador["posicionesJugador"]=consultarPosicionesJugador($row_ficha_jugador["idfichaJugador"]);

        
        $posicion_g=NULL;
        if ($row_ficha_jugador["posicion"]== 1) {
            $posicion_g = 1;
        } else if ($row_ficha_jugador["posicion"]== 2 || $row_ficha_jugador["posicion"]== 3 || $row_ficha_jugador["posicion"]== 4) {
            $posicion_g = 2;
        } else if ($row_ficha_jugador["posicion"]== 5 || $row_ficha_jugador["posicion"]== 6 || $row_ficha_jugador["posicion"]== 7 || $row_ficha_jugador["posicion"]== 8 || $row_ficha_jugador["posicion"]== 9) {
            $posicion_g = 3;
        } else if ($row_ficha_jugador["posicion"]== 10 || $row_ficha_jugador["posicion"]== 11 || $row_ficha_jugador["posicion"]== 12) {
            $posicion_g = 4;
        }
        $row_ficha_jugador['posicionA'] = $posicion_g;
        $row_ficha_jugador['prestamos']=consultarPrestamosFichaJugador($row_ficha_jugador["idfichaJugador"]);
        if(array_key_exists("array_lista_prestamo",$POST)){

            for($contador=0;$contador<sizeof($POST["array_lista_prestamo"]);$contador++){

                if($POST["array_lista_prestamo"][$contador]==="5" && $row_ficha_jugador["estado"]===$POST["array_lista_prestamo"][$contador]){
                    $valido=true;
                }
                else{
                    if(sizeof($row_ficha_jugador['prestamos'])>0){
                        for($contador2=0;$contador2<sizeof($row_ficha_jugador['prestamos']);$contador2++){
                            if($POST["array_lista_prestamo"][$contador]==="1" && $row_ficha_jugador['prestamos'][$contador2]["condicion_prestamo_ficha_jugador_mc"]===$POST["array_lista_prestamo"][$contador]){
                                $valido=true;
                            }
                            if($POST["array_lista_prestamo"][$contador]==="2" && $row_ficha_jugador['prestamos'][$contador2]["condicion_prestamo_ficha_jugador_mc"]===$POST["array_lista_prestamo"][$contador]){
                                $valido=true;
                            }
                            
                        }

                    }
                }

            }

            if($valido){
                if($row_ficha_jugador["estado"]!=="0"){
                    $ficha_jugadores[]=utf8_converter($row_ficha_jugador);
                }
            }
        }
        else{
            if($row_ficha_jugador["estado"]!=="0"){
                $ficha_jugadores[]=utf8_converter($row_ficha_jugador);

            }
        }
        // $ficha_jugadores[]=utf8_converter($row_ficha_jugador);

    }
    return (sizeof($ficha_jugadores)>0)?["datos" => $ficha_jugadores, "estado" => true]:["datos" => [], "estado" => false];
}

function consultarPrestamosFichaJugador($id){
    include("conexion.php");
    $SQL="SELECT * FROM prestamo_ficha_jugador_mc WHERE idfichaJugador=$id;";
    $prestamo_jugador_result=$link->query($SQL);
    $datos_prestamos_jugadores=[];
    while($row_prestamos_jugadores=mysqli_fetch_array($prestamo_jugador_result)){
        $row_prestamos_jugadores["dias_diferencia_fecha_fin_prestamo"]=consultarDirenciasDemeses($row_prestamos_jugadores["fecha_fin_prestamo_prestamo_ficha_jugador_mc"]);
        $row_prestamos_jugadores["dias_diferencia_fecha_fin_contrato_prestamo"]=consultarDirenciasDemeses($row_prestamos_jugadores["fecha_fin_contrato_prestamo"]);
        $datos_prestamos_jugadores[]=utf8_converter($row_prestamos_jugadores);
    }
    return (sizeof($datos_prestamos_jugadores)>0)?$datos_prestamos_jugadores:[];
}

function eliminarPrestamo($id){
    $prestamo_tmp=consultarPrestamoId($id);
    include("conexion.php");
    $SQL="DELETE FROM prestamo_ficha_jugador_mc WHERE idprestamo_ficha_jugador_mc=$id;";
    $link->query($SQL);
    $link->close();
    $prestamos_jugador=consultarPrestamosFichaJugador($prestamo_tmp[0]["idfichaJugador"]);
    if(sizeof($prestamos_jugador)===0){
        cambiarEstadoEliminarFichaJugador($prestamo_tmp[0]["idfichaJugador"]);
    }
    // return ["estado" => true];0
}

function consultarPrestamoId($id){
    // consultarPrestamosFichaJugador()
    include("conexion.php");
    $SQL="SELECT * FROM prestamo_ficha_jugador_mc WHERE idprestamo_ficha_jugador_mc=$id;";
    $prestamo_result=$link->query($SQL);
    $datos_prestamos=[];
    while($row_prestamo=mysqli_fetch_array($prestamo_result)){
        $datos_prestamos[]=utf8_converter($row_prestamo);
    }
    $link->close();
    return $datos_prestamos;
}

function cambiarEstadoEliminarFichaJugador($idJugador){
    include("conexion.php");
    $SQL="UPDATE fichaJugador SET estado='0' WHERE idfichaJugador=$idJugador;";
    $link->query($SQL);
    $link->close();
}

function calcular_posicion_jugador($numero_posicion){
    
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
		if($numero_posicion==1){
			$jugador['portero']=1;
			$jugador['posicionPrincipal']='Arquero';
			
		}else if($numero_posicion==2){
			$jugador['defensorCentral']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Defensor Central';
			//}
		}else if($numero_posicion==3){
			$jugador['lateralIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Lateral Izquierdo';
			//}
		}else if($numero_posicion==4){
			$jugador['lateralDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Lateral Derecho';
			//}
		}else if($numero_posicion==5){
			$jugador['volanteDefensivo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Defensivo';
			//}
		}else if($numero_posicion==6){
			$jugador['volanteIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Izquierdo';
			//}
		}else if($numero_posicion==7){
			$jugador['volanteDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Derecho';
			//}
		}else if($numero_posicion==8){
			$jugador['volanteMixto']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Mixto';
			//}
		}else if($numero_posicion==9){
			$jugador['volanteOfensivo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Volante Ofensivo';
			//}
		}else if($numero_posicion==10){
			$jugador['extremoIzquierdo']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Extremo Izquierdo';
			//}
		}else if($numero_posicion==11){
			$jugador['extremoDerecho']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Extremo Derecho';
			//}
		}else if($numero_posicion==12){
			$jugador['delanteroCentro']=1;
			//if($jugador['posicionPrincipal']==''){
				$jugador['posicionPrincipal']='Delantero Centro';
		}
	return ["texto_posicion" => $jugador['posicionPrincipal'],"codigo_posicion" => $numero_posicion];
    
}

function eliminar($id){
    include("conexion.php");
    $SQL="DELETE FROM fichaJugador WHERE idfichaJugador=$id;";
    $link->query($SQL);
    if(file_exists("../foto_jugadores/".$id.".png")){
        unlink("../foto_jugadores/".$id.".png");

    }
    if(file_exists("../pdf_jugadores/".$id)){
        // recurse_delete_dir("../pdf_jugadores/".$id);
        eliminarCarpetaPdfJugador($id);
    }
    return ["estado" => true];
}

function consultarTipoPrestamosJugador($POST){
    include("conexion.php");
    $SQL="SELECT * FROM prestamo_ficha_jugador_mc WHERE idfichaJugador=".$POST["idfichaJugador"]." AND condicion_prestamo_ficha_jugador_mc=".$POST["tipo_prestamo"]." ;";
    $prestamo_jugador_result=$link->query($SQL);
    $datos_prestamos_jugadores=[];
    while($row_prestamos_jugadores=mysqli_fetch_array($prestamo_jugador_result)){
        $datos_prestamos_jugadores[]=utf8_converter($row_prestamos_jugadores);
    }
    return (sizeof($datos_prestamos_jugadores)>0)?["estado" => true,"datos" => $datos_prestamos_jugadores]:["estado" => false,"datos" => []];
}

function actualizarPrestamo($POST){
    include("conexion.php");
    $fecha_software=date_futbolJoven();
    $SQL="UPDATE prestamo_ficha_jugador_mc SET 

    pais_origen_club_prestamo_ficha_jugador_mc='".$POST["pais_origen_club_prestamo_ficha_jugador_mc"]."',
    origen_club_prestamo_ficha_jugador_mc='".$POST["origen_club_prestamo_ficha_jugador_mc"]."',
    fecha_inicio_prestamo_prestamo_ficha_jugador_mc='".$POST["fecha_inicio_prestamo_prestamo_ficha_jugador_mc"]."',
    fecha_fin_prestamo_prestamo_ficha_jugador_mc='".$POST["fecha_fin_prestamo_prestamo_ficha_jugador_mc"]."',
    valor_prestamo_prestamo_ficha_jugador_mc='".$POST["valor_prestamo_prestamo_ficha_jugador_mc"]."',
    opcion_compra_prestamo_ficha_jugador_mc='".$POST["opcion_compra_prestamo_ficha_jugador_mc"]."',
    observacion_datos_deportivos_prestamo_ficha_jugador_mc='".$POST["observacion_datos_deportivos_prestamo_ficha_jugador_mc"]."',
    fecha_fin_contrato_prestamo=".validarValoresNullString($POST["fecha_fin_contrato_prestamo_editar"]).",
    fecha_software='".$fecha_software."',
    nombre_usuario_software='".$POST["nombre_usuario_software"]."'

    WHERE  
    
    idprestamo_ficha_jugador_mc=".$POST["idprestamo_ficha_jugador_mc"]."
    AND
    condicion_prestamo_ficha_jugador_mc=".$POST["condicion_prestamo_ficha_jugador_mc"].";
    ";
    // print($SQL);
    $link->query($SQL);
    $id=$link->insert_id;
    $link->close();
    return ($id!==0)?["estado" => true]:["estado" => false];
    
}

function recurse_delete_dir(string $dir) {
    $count = 0;

    // ensure that $dir ends with a slash so that we can concatenate it with the filenames directly
    $dir = rtrim($dir, "/\\") . "/";

    // use dir() to list files
    $list = dir($dir);

    // store the next file name to $file. if $file is false, that's all -- end the loop.
    while(($file = $list->read()) !== false) {
        if($file === "." || $file === "..") continue;
        if(is_file($dir . $file)) {
            unlink($dir . $file);
            $count++;
        } elseif(is_dir($dir . $file)) {
            $count += recurse_delete_dir($dir . $file);
        }
    }

    // finally, safe to delete directory!
    rmdir($dir);
}

function borrarArchivosBuffer(){
    $dir="../temp";
    $count = 0;

    // ensure that $dir ends with a slash so that we can concatenate it with the filenames directly
    $dir = rtrim($dir, "/\\") . "/";

    // use dir() to list files
    $list = dir($dir);

    // store the next file name to $file. if $file is false, that's all -- end the loop.
    while(($file = $list->read()) !== false) {
        if($file === "." || $file === "..") continue;
        if(is_file($dir . $file)) {
            unlink($dir . $file);
            $count++;
        }
    }
}


function eliminarCarpetaPdfJugador($idCarpetaJugador){

    // Eliminando carpeta de PDFs:
    $borrar_carpeta_pdf = true;
    $carpeta_pdf = '../pdf_jugadores/' . $idCarpetaJugador;
    if(is_dir($carpeta_pdf)) { // <--------- Si existe la carpeta se elimina.
        foreach(scandir($carpeta_pdf) as $file) {
            if ('.' === $file || '..' === $file) continue;
            if (is_dir("$carpeta_pdf/$file")) rmdir_recursive("$carpeta_pdf/$file");
            else unlink("$carpeta_pdf/$file");
        }
        // rmdir($dir);

        if(!rmdir($carpeta_pdf)) { // <--------- Si ocurre un error al eliminar la carpeta, se mostrará un mensaje.
          echo ('No se pudo eliminar la carpeta de PDFs '.$carpeta_pdf.'');
          $borrar_carpeta_pdf = false;
        }        
    }    
    
}

function insertarPosicionesCancha($posicion,$numeroPosicion,$idJugador){
    include("conexion.php");
    $SQL="INSERT INTO posicionCancha(
         posicion,
         numero_posicion,
         idfichaJugador
    )
    VALUES(
        '".$posicion."',
        '".$numeroPosicion."',
        ".$idJugador."
    );";
    $link->query($SQL);
    $link->close();
}

function eliminarPosicionCancha($idJugador){
    include("conexion.php");
    $SQL="DELETE FROM posicionCancha WHERE idfichaJugador=$idJugador;";
    $link->query($SQL);
    $link->close();
}

function consultarPosicionesJugador($idJugador){
    include("conexion.php");
    $SQL="SELECT * FROM posicionCancha WHERE idfichaJugador=$idJugador;";
    $resultPosicionesJugador=$link->query($SQL);
    $listaPosiciones=[];
    while($rowPosicion=mysqli_fetch_array($resultPosicionesJugador)){
        $listaPosiciones[]=utf8_converter($rowPosicion);
    }
    $link->close();
    return $listaPosiciones;
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


?>