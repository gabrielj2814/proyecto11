<?php
function getDateTime(){
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

/* ---------------- Función que convierte la fecha en formato dia/mes/año. ----------------- */
function dbfecha( $fecha ){
    $fecha = substr($fecha,8,2)."-".substr($fecha,5,2)."-".substr($fecha,0,4);
    return $fecha;    
}

/* ---------------- Función que calcula edad. ----------------- */
function calcularEdad( $fechaNacimiento ) {
    dbfecha( $fechaNacimiento ); // <--- Fecha de Nacimiento en formado dd-mm-aaaa.

    $diaFechaNacimiento = substr($fechaNacimiento, 8, 2);
    $diaFechaNacimiento = intval( $diaFechaNacimiento );      

    $mesFechaNacimiento = substr($fechaNacimiento, 5, 2);
    $mesFechaNacimiento = intval( $mesFechaNacimiento );                       

    $anioFechaNacimiento = substr($fechaNacimiento, 0, 4);
    $anioFechaNacimiento = intval( $anioFechaNacimiento );

    // ----------- DÍA ACTUAL ----------- //
    $diafechaActual = date("d");
    $diafechaActual = intval( $diafechaActual );                

    // ----------- MES ACTUAL ----------- //
    $mesfechaActual = date("m");
    $mesfechaActual = intval( $mesfechaActual );

    // ----------- AÑO ACTUAL ----------- //
    $aniofechaActual = date("Y");
    $aniofechaActual = intval( $aniofechaActual );      


    $edad = $aniofechaActual - $anioFechaNacimiento;
            
    /*
    if( $mesfechaActual < $mesFechaNacimiento ) {
        $edad--;
    }

    if( $mesfechaActual > $mesFechaNacimiento ) {
        $edad;
    }

    if( $mesfechaActual === $mesFechaNacimiento ) {
        // Comparamos los días:
        if( $diafechaActual >= $diaFechaNacimiento ) {
        $edad;
        } else {
        $edad--;
        }
    } 
    */           

    return $edad;

}

function t_serie ($serie) {
    $arreglo = explode('_', $serie);
    return $arreglo;
}

function ver_series_total () {
    $dato = [
        '8_1'  => 'SUB-8 Masculina',
        '9_1'  => 'SUB-9 Masculina',
        '10_1' => 'SUB-10 Masculina',
        '11_1' => 'SUB-11 Masculina',
        '12_1' => 'SUB-12 Masculina',
        '13_1' => 'SUB-13 Masculina',
        '14_1' => 'SUB-14 Masculina',
        '15_1' => 'SUB-15 Masculina',
        '16_1' => 'SUB-16 Masculina',
        '17_1' => 'SUB-17 Masculina',
        '19_1' => 'SUB-19 Masculina',
        
        '99_1' => 'Primer Equipo',
        
        '15_2' => 'SUB-15 Femenina',
        '17_2' => 'SUB-17 Femenina',
        '99_2' => 'Primer Equipo'
    ];
    return $dato;
}


function jugadores_por_serie ($serie) {
    include("conexion.php");
    
    $dato = 0;
    $con    = t_serie($serie);
    $serie  = $con[0];
    $sexo   = $con[1];
    
    if ($resultado = $link->query("SELECT *
        FROM fichaJugador
        WHERE fichaJugador.serieActual='".$serie."'
        AND fichaJugador.sexo='".$sexo."'
        AND fichaJugador.estado <> 0 AND fichaJugador.estado <> 1 AND fichaJugador.estado <> 3
    ")){
        $dato = $resultado->num_rows;
    };
    
    $link->close();
    return $dato;
}

function ver_datos( $datos ){
    include("conexion.php");
    
    $dato = [];

    $tipo_consulta = $datos['tipo_consulta'];
    
    switch( $tipo_consulta ) {

        case '0':
            $array_sexo = $datos['array_sexo'];
            $array_numero_serie = $datos['array_numero_serie'];        
            for(
                $i_1 = 0,
                $i_2 = 0; 
                // ---------------------- //
                $i_1 < count( $array_sexo ),
                $i_2 < count( $array_numero_serie );
                // ---------------------- //
                $i_1++,
                $i_2++
            ) {

                $resultado = $link->query("
                    SELECT COUNT(idfichaJugador) FROM fichaJugador 
                    WHERE sexo = ".$array_sexo[$i_1]." 
                    AND serieActual = ".$array_numero_serie[$i_2]."
                    AND fichaJugador.estado <> 0 AND fichaJugador.estado <> 1 AND fichaJugador.estado <> 3
                ");
                
                
                while($row = mysqli_fetch_assoc($resultado)) {
                    $dato[] =  $row["COUNT(idfichaJugador)"];
                }

            }
            break;

        // ------------------------------------------------------------------------ //

        case '1':
            $string = $datos['string'];
            $sexo = $datos['sexo']; 
            $numero_serie = $datos['numero_serie'];
            
            if( $string=='' ) {

                $resultado = $link->query("
                    SELECT *
                    FROM fichaJugador
                    LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
                    WHERE sexo = ".$sexo." 
                    AND serieActual = ".$numero_serie."
                    AND posicionCancha.numero_posicion = 0
                    AND fichaJugador.estado <> 0 AND fichaJugador.estado <> 1 AND fichaJugador.estado <> 3
                    ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC
                ");

            } else {

                $resultado = $link->query("
                    SELECT *
                    FROM fichaJugador
                    LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
                    WHERE (fichaJugador.nombre LIKE '".$datos['string']."%' OR fichaJugador.apellido1 LIKE '".$datos['string']."%' OR fichaJugador.apellido2 LIKE '".$datos['string']."%')
                    AND sexo = ".$sexo." 
                    AND serieActual = ".$numero_serie."
                    AND posicionCancha.numero_posicion = 0
                    AND fichaJugador.estado <> 0 AND fichaJugador.estado <> 1 AND fichaJugador.estado <> 3
                    ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC
                ");

            }


            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                
                $idfichaJugador = $row["idfichaJugador"];
                 
                // Última visita social:
                $resultado2 = $link->query("
                    SELECT * FROM udc_visita_social
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = udc_visita_social.idfichaJugador
                    WHERE udc_visita_social.idfichaJugador = ".$idfichaJugador."
                    ORDER BY udc_visita_social.idudc_visita_social DESC
                    LIMIT 1 
                ");

                while( $row2 = mysqli_fetch_assoc( $resultado2 ) ) {
                    $row['idudc_visita_social'] = $row2['idudc_visita_social'];

                    
                    $row['domicilio_actual'] = $row2['domicilio_actual'];
                    $row['comuna'] = $row2['comuna'];
                    $row['comuna_procedencia'] = $row2['comuna_procedencia'];
                    $row['apod_nombre'] = $row2['apod_nombre'];
                    $row['apod_parentesco'] = $row2['apod_parentesco'];
                    $row['apod_correo'] = $row2['apod_correo'];
                    $row['apod_telefono'] = $row2['apod_telefono'];
                    $row['af_num_personas_gf'] = $row2['af_num_personas_gf'];                    
                    $row['af_num_personas_domicilio'] = $row2['af_num_personas_domicilio'];
                    $row['af_num_habitaciones_domicilio'] = $row2['af_num_habitaciones_domicilio'];
                    $row['af_comparte_habitacion'] = $row2['af_comparte_habitacion'];
                    $row['af_conquien_comparte_habitacion'] = $row2['af_conquien_comparte_habitacion'];
                    $row['af_ingreso_nucleo_familiar'] = $row2['af_ingreso_nucleo_familiar'];
                    $row['af_indep_economica'] = $row2['af_indep_economica'];
                    $row['af_situacion_conyugal_padres'] = $row2['af_situacion_conyugal_padres'];
                    $row['af_num_hermanos'] = $row2['af_num_hermanos'];
                    $row['af_principal_sostenedor'] = $row2['af_principal_sostenedor'];
                    $row['af_tipo_domicilio_jugador'] = $row2['af_tipo_domicilio_jugador'];
                    $row['af_info_grupo_familiar'] = $row2['af_info_grupo_familiar'];
                    $row['af_info_grupo_familiar'] = $row2['af_info_grupo_familiar'];
                    $row['af_valoracion'] = $row2['af_valoracion'];
                    $row['af_valoracion_text'] = $row2['af_valoracion_text'];
                    $row['rp_situacion_amorosa'] = $row2['rp_situacion_amorosa'];
                    $row['rp_hace_cuanto'] = $row2['rp_hace_cuanto'];
                    $row['rp_relacion_pareja'] = $row2['rp_relacion_pareja'];
                    $row['rp_inicio_vida_sexual'] = $row2['rp_inicio_vida_sexual'];
                    $row['rp_metodo_proteccion'] = $row2['rp_metodo_proteccion'];
                    $row['rp_orientacion_temas_sexuales'] = $row2['rp_orientacion_temas_sexuales'];
                    $row['rp_tiene_hijos'] = $row2['rp_tiene_hijos'];
                    $row['rp_num_hijos'] = $row2['rp_num_hijos'];
                    $row['rp_valoracion'] = $row2['rp_valoracion'];
                    $row['rp_valoracion_text'] = $row2['rp_valoracion_text'];
                    $row['a_costear_alimentacion'] = $row2['a_costear_alimentacion'];
                    $row['a_observaciones'] = $row2['a_observaciones'];
                    $row['a_comidas_club'] = $row2['a_comidas_club'];
                    $row['a_comidas_diarias'] = $row2['a_comidas_diarias'];
                    $row['a_valoracion'] = $row2['a_valoracion'];
                    $row['a_valoracion_text'] = $row2['a_valoracion_text'];
                    $row['l_valoracion'] = $row2['l_valoracion'];
                    $row['l_valoracion_text'] = $row2['l_valoracion_text'];
                    $row['s_consume_drogas'] = $row2['s_consume_drogas'];
                    $row['s_frecuencia_consumo_drogas'] = $row2['s_frecuencia_consumo_drogas'];
                    $row['s_familiar_consume_drogas'] = $row2['s_familiar_consume_drogas'];
                    $row['s_quien_consume_drogas_familiar'] = $row2['s_quien_consume_drogas_familiar'];
                    $row['s_valoracion'] = $row2['s_valoracion'];
                    $row['s_valoracion_text'] = $row2['s_valoracion_text'];
                    $row['aj_jugador_tiene_antecedentes'] = $row2['aj_jugador_tiene_antecedentes'];
                    $row['aj_jugador_antecedentes'] = $row2['aj_jugador_antecedentes'];
                    $row['aj_familiar_tiene_antecedentes'] = $row2['aj_familiar_tiene_antecedentes'];
                    $row['aj_familiar_antecedentes'] = $row2['aj_familiar_antecedentes'];
                    $row['aj_valoracion'] = $row2['aj_valoracion'];
                    $row['aj_valoracion_text'] = $row2['aj_valoracion_text'];
                    $row['od_tiene_seguro'] = $row2['od_tiene_seguro'];
                    $row['od_nombre_compania_seguro'] = $row2['od_nombre_compania_seguro'];
                    $row['od_seguro_vencimiento'] = $row2['od_seguro_vencimiento'];
                    $row['od_tiene_pasaporte'] = $row2['od_tiene_pasaporte'];
                    $row['od_num_pasaporte'] = $row2['od_num_pasaporte'];
                    $row['od_pasaporte_vencimiento'] = $row2['od_pasaporte_vencimiento'];
                    $row['od_vencimiento_carnetid'] = $row2['od_vencimiento_carnetid'];
                    $row['od_observaciones'] = $row2['od_observaciones'];

                    $row['od_padre_nombre'] = $row2['od_padre_nombre'];
                    $row['od_padre_apellido'] = $row2['od_padre_apellido'];
                    $row['od_padre_telefono'] = $row2['od_padre_telefono'];
                    $row['od_padre_correo'] = $row2['od_padre_correo'];
                    $row['od_padre_tiene_discapacidad'] = $row2['od_padre_tiene_discapacidad'];
                    $row['od_padre_discapacidad'] = $row2['od_padre_discapacidad'];
                    $row['od_padre_comuna_residencia'] = $row2['od_padre_comuna_residencia'];
                    $row['od_padre_trabaja'] = $row2['od_padre_trabaja'];
                    $row['od_padre_trabajo_nombre'] = $row2['od_padre_trabajo_nombre'];
                    $row['od_padre_tiempo_cesante_jubilado'] = $row2['od_padre_tiempo_cesante_jubilado'];

                    $row['od_madre_nombre'] = $row2['od_madre_nombre'];
                    $row['od_madre_apellido'] = $row2['od_madre_apellido'];
                    $row['od_madre_telefono'] = $row2['od_madre_telefono'];
                    $row['od_madre_correo'] = $row2['od_madre_correo'];
                    $row['od_madre_tiene_discapacidad'] = $row2['od_madre_tiene_discapacidad'];
                    $row['od_madre_discapacidad'] = $row2['od_madre_discapacidad'];
                    $row['od_madre_comuna_residencia'] = $row2['od_madre_comuna_residencia'];
                    $row['od_madre_trabaja'] = $row2['od_madre_trabaja'];
                    $row['od_madre_trabajo_nombre'] = $row2['od_madre_trabajo_nombre'];
                    $row['od_madre_tiempo_cesante_jubilado'] = $row2['od_madre_tiempo_cesante_jubilado'];                    
                    
                }           

                if( isset($row['idudc_visita_social']) ) {

                    $idudc_visita_social = $row['idudc_visita_social'];


                    // --------------------- Seleccionando la comuna del jugador en la tabla 'udc_visita_social' --------------------- //
                    $resultado_comuna_visitasocial = $link->query("
                      SELECT  
                      comuna AS comuna_visita_social
                      FROM udc_visita_social
                      WHERE idudc_visita_social = ".$idudc_visita_social."
                    ");

                    while($row_comuna_visitasocial = mysqli_fetch_assoc($resultado_comuna_visitasocial)) {
                        $row['comuna_visita_social'] = $row_comuna_visitasocial['comuna_visita_social'];
                    }                 
                    
                    // --------------------- Tabla 'persona_domicilio_jugador' --------------------- //
                    $resultado_2 = $link->query("
                      SELECT * FROM persona_domicilio_jugador
                      LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = persona_domicilio_jugador.idudc_visita_social
                      WHERE persona_domicilio_jugador.idudc_visita_social = ".$idudc_visita_social."
                    ");

                    $array_persona_domicilio_jugador = [];
                    while($row_2 = mysqli_fetch_assoc($resultado_2)) {
                        $array_persona_domicilio_jugador[] = $row_2;
                    } 

                    // --------------------- Tabla 'hijo_jugador' --------------------- //
                    $resultado_3 = $link->query("
                      SELECT * FROM hijo_jugador
                      LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = hijo_jugador.idudc_visita_social
                      WHERE hijo_jugador.idudc_visita_social = ".$idudc_visita_social."
                    ");

                    $array_hijo_jugador = [];
                    while($row_3 = mysqli_fetch_assoc($resultado_3)) {
                        $array_hijo_jugador[] = $row_3;
                    } 

                    // --------------------- Tabla 'visitasocial_llegada_club' --------------------- //
                    $resultado_4 = $link->query("
                      SELECT 
                      llegada_ida_club.idllegada_ida_club,
                      llegada_ida_club.descripcion_llegada_ida_club
                      FROM visitasocial_llegada_club
                      LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_llegada_club.idudc_visita_social
                      LEFT JOIN llegada_ida_club ON llegada_ida_club.idllegada_ida_club = visitasocial_llegada_club.idllegada_ida_club
                      WHERE visitasocial_llegada_club.idudc_visita_social = ".$idudc_visita_social."
                    ");

                    $array_visitasocial_llegada_club = [];
                    while($row_4 = mysqli_fetch_assoc($resultado_4)) {
                        $array_visitasocial_llegada_club[] = $row_4;
                    } 

                    // --------------------- Tabla 'visitasocial_ida_club' --------------------- //
                    $resultado_5 = $link->query("
                      SELECT 
                      llegada_ida_club.idllegada_ida_club,
                      llegada_ida_club.descripcion_llegada_ida_club
                      FROM visitasocial_ida_club
                      LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_ida_club.idudc_visita_social
                      LEFT JOIN llegada_ida_club ON llegada_ida_club.idllegada_ida_club = visitasocial_ida_club.idllegada_ida_club
                      WHERE visitasocial_ida_club.idudc_visita_social = ".$idudc_visita_social."
                    ");

                    $array_visitasocial_ida_club = [];
                    while($row_5 = mysqli_fetch_assoc($resultado_5)) {
                        $array_visitasocial_ida_club[] = $row_5;
                    }

                    // --------------------- Tabla 'visitasocial_mediotrans_llegada' --------------------- //
                    $resultado_6 = $link->query("
                      SELECT 
                      medio_transporte.idmedio_transporte,
                      medio_transporte.descripcion_medio_transporte
                      FROM visitasocial_mediotrans_llegada
                      LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_mediotrans_llegada.idudc_visita_social
                      LEFT JOIN medio_transporte ON medio_transporte.idmedio_transporte = visitasocial_mediotrans_llegada.idmedio_transporte 
                      WHERE visitasocial_mediotrans_llegada.idudc_visita_social = ".$idudc_visita_social."
                    ");

                    $array_visitasocial_mediotrans_llegada = [];
                    while($row_6 = mysqli_fetch_assoc($resultado_6)) {
                        $array_visitasocial_mediotrans_llegada[] = $row_6;
                    }

                    // --------------------- Tabla 'visitasocial_mediotrans_ida' --------------------- //
                    $resultado_7 = $link->query("
                      SELECT  
                      medio_transporte.idmedio_transporte,
                      medio_transporte.descripcion_medio_transporte
                      FROM visitasocial_mediotrans_ida
                      LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_mediotrans_ida.idudc_visita_social
                      LEFT JOIN medio_transporte ON medio_transporte.idmedio_transporte = visitasocial_mediotrans_ida.idmedio_transporte 
                      WHERE visitasocial_mediotrans_ida.idudc_visita_social = ".$idudc_visita_social."
                    ");

                    $array_visitasocial_mediotrans_ida = [];
                    while($row_7 = mysqli_fetch_assoc($resultado_7)) {
                        $array_visitasocial_mediotrans_ida[] = $row_7;
                    }

                    // --------------------- Tabla 'visitasocial_droga_consumidajug' --------------------- //
                    $resultado_8 = $link->query("
                      SELECT * FROM visitasocial_droga_consumidajug
                      LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_droga_consumidajug.idudc_visita_social
                      WHERE visitasocial_droga_consumidajug.idudc_visita_social = ".$idudc_visita_social."
                    ");

                    $array_visitasocial_droga_consumidajug = [];
                    while($row_8 = mysqli_fetch_assoc($resultado_8)) {
                        $array_visitasocial_droga_consumidajug[] = $row_8;
                    }

                    // --------------------- Tabla 'visitasocial_droga_probadajug' --------------------- //
                    $resultado_9 = $link->query("
                      SELECT  
                      droga.iddroga,
                      droga.descripcion_droga
                      FROM visitasocial_droga_probadajug
                      LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_droga_probadajug.idudc_visita_social
                      LEFT JOIN droga ON droga.iddroga = visitasocial_droga_probadajug.iddroga
                      WHERE visitasocial_droga_probadajug.idudc_visita_social = ".$idudc_visita_social."
                    ");

                    $array_visitasocial_droga_probadajug = [];
                    while($row_9 = mysqli_fetch_assoc($resultado_9)) {
                        $array_visitasocial_droga_probadajug[] = $row_9;
                    }                       

                    // --------------------- Tabla 'visitasocial_droga_consumidafam' --------------------- //
                    $resultado_10 = $link->query("
                      SELECT * FROM visitasocial_droga_consumidafam
                      LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_droga_consumidafam.idudc_visita_social
                      WHERE visitasocial_droga_consumidafam.idudc_visita_social = ".$idudc_visita_social."
                    ");

                    $array_visitasocial_droga_consumidafam = [];
                    while($row_10 = mysqli_fetch_assoc($resultado_10)) {
                        $array_visitasocial_droga_consumidafam[] = $row_10;
                    }

                    // Consultando posiciones:
                    $resultado_11 = $link->query("
                    SELECT 
                    posicionCancha.posicion,
                    posicionCancha.numero_posicion
                    FROM fichaJugador        
                    -- Datos de la posición:
                    LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
                    WHERE posicionCancha.idfichaJugador = ".$idfichaJugador."        
                    ");

                    while($row_11 = mysqli_fetch_assoc($resultado_11)) {  
                        $posicion = $row_11['posicion'];
                        $numero_posicion = $row_11['numero_posicion']; 
                        $row['posicion'.$numero_posicion] = $posicion;                                        
                    }                  
 

                    $row['array_persona_domicilio_jugador'] = $array_persona_domicilio_jugador;
                    $row['array_hijo_jugador'] = $array_hijo_jugador;
                    $row['array_visitasocial_llegada_club'] = $array_visitasocial_llegada_club;
                    $row['array_visitasocial_ida_club'] = $array_visitasocial_ida_club;
                    $row['array_visitasocial_mediotrans_llegada'] = $array_visitasocial_mediotrans_llegada;
                    $row['array_visitasocial_mediotrans_ida'] = $array_visitasocial_mediotrans_ida;
                    $row['array_visitasocial_droga_consumidajug'] = $array_visitasocial_droga_consumidajug;
                    $row['array_visitasocial_droga_probadajug'] = $array_visitasocial_droga_probadajug;
                    $row['array_visitasocial_droga_consumidafam'] = $array_visitasocial_droga_consumidafam;

                    $dato[] = utf8_converter( $row );         

                    unset($array_persona_domicilio_jugador);
                    unset($array_hijo_jugador);
                    unset($array_visitasocial_llegada_club);
                    unset($array_visitasocial_ida_club);  
                    unset($array_visitasocial_mediotrans_llegada);
                    unset($array_visitasocial_mediotrans_ida);
                    unset($array_visitasocial_droga_consumidajug);
                    unset($array_visitasocial_droga_probadajug);
                    unset($array_visitasocial_droga_consumidafam);


                } else {

                    // Consultando posiciones:
                    $resultado_10 = $link->query("
                    SELECT 
                    posicionCancha.posicion,
                    posicionCancha.numero_posicion
                    FROM fichaJugador        
                    -- Datos de la posición:
                    LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
                    WHERE posicionCancha.idfichaJugador = ".$idfichaJugador."        
                    ");

                    while($row_10 = mysqli_fetch_assoc($resultado_10)) {  
                        $posicion = $row_10['posicion'];
                        $numero_posicion = $row_10['numero_posicion']; 
                        $row['posicion'.$numero_posicion] = $posicion;                                        
                    }                  


                    // $row["ultimos_datos_social"] = $ultimos_datos_social;
                    $dato[] = utf8_converter( $row );     

                }     

            
            }
            break;

        case '2':
            $idfichaJugador = $datos['idfichaJugador']; 
            
            $resultado = $link->query("
                SELECT * FROM udc_visita_social  
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = udc_visita_social.idfichaJugador
                WHERE udc_visita_social.idfichaJugador = ".$idfichaJugador." 
            ");
                
            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                // $dato[] = utf8_converter( $row );

                $idudc_visita_social = $row['idudc_visita_social'];          

                // --------------------- Seleccionando la comuna del jugador en la tabla 'udc_visita_social' --------------------- //
                $resultado_comuna_visitasocial = $link->query("
                  SELECT  
                  comuna AS comuna_visita_social
                  FROM udc_visita_social
                  WHERE idudc_visita_social = ".$idudc_visita_social."
                ");

                while($row_comuna_visitasocial = mysqli_fetch_assoc($resultado_comuna_visitasocial)) {
                    $row['comuna_visita_social'] = $row_comuna_visitasocial['comuna_visita_social'];
                }                 
                
                // --------------------- Tabla 'persona_domicilio_jugador' --------------------- //
                $resultado_2 = $link->query("
                  SELECT * FROM persona_domicilio_jugador
                  LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = persona_domicilio_jugador.idudc_visita_social
                  WHERE persona_domicilio_jugador.idudc_visita_social = ".$idudc_visita_social."
                ");

                $array_persona_domicilio_jugador = [];
                while($row_2 = mysqli_fetch_assoc($resultado_2)) {
                    $array_persona_domicilio_jugador[] = $row_2;
                } 

                // --------------------- Tabla 'hijo_jugador' --------------------- //
                $resultado_3 = $link->query("
                  SELECT * FROM hijo_jugador
                  LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = hijo_jugador.idudc_visita_social
                  WHERE hijo_jugador.idudc_visita_social = ".$idudc_visita_social."
                ");

                $array_hijo_jugador = [];
                while($row_3 = mysqli_fetch_assoc($resultado_3)) {
                    $array_hijo_jugador[] = $row_3;
                } 

                // --------------------- Tabla 'visitasocial_llegada_club' --------------------- //
                $resultado_4 = $link->query("
                  SELECT 
                  llegada_ida_club.idllegada_ida_club,
                  llegada_ida_club.descripcion_llegada_ida_club
                  FROM visitasocial_llegada_club
                  LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_llegada_club.idudc_visita_social
                  LEFT JOIN llegada_ida_club ON llegada_ida_club.idllegada_ida_club = visitasocial_llegada_club.idllegada_ida_club
                  WHERE visitasocial_llegada_club.idudc_visita_social = ".$idudc_visita_social."
                ");

                $array_visitasocial_llegada_club = [];
                while($row_4 = mysqli_fetch_assoc($resultado_4)) {
                    $array_visitasocial_llegada_club[] = $row_4;
                } 

                // --------------------- Tabla 'visitasocial_ida_club' --------------------- //
                $resultado_5 = $link->query("
                  SELECT 
                  llegada_ida_club.idllegada_ida_club,
                  llegada_ida_club.descripcion_llegada_ida_club
                  FROM visitasocial_ida_club
                  LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_ida_club.idudc_visita_social
                  LEFT JOIN llegada_ida_club ON llegada_ida_club.idllegada_ida_club = visitasocial_ida_club.idllegada_ida_club
                  WHERE visitasocial_ida_club.idudc_visita_social = ".$idudc_visita_social."
                ");

                $array_visitasocial_ida_club = [];
                while($row_5 = mysqli_fetch_assoc($resultado_5)) {
                    $array_visitasocial_ida_club[] = $row_5;
                }

                // --------------------- Tabla 'visitasocial_mediotrans_llegada' --------------------- //
                $resultado_6 = $link->query("
                  SELECT 
                  medio_transporte.idmedio_transporte,
                  medio_transporte.descripcion_medio_transporte
                  FROM visitasocial_mediotrans_llegada
                  LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_mediotrans_llegada.idudc_visita_social
                  LEFT JOIN medio_transporte ON medio_transporte.idmedio_transporte = visitasocial_mediotrans_llegada.idmedio_transporte 
                  WHERE visitasocial_mediotrans_llegada.idudc_visita_social = ".$idudc_visita_social."
                ");

                $array_visitasocial_mediotrans_llegada = [];
                while($row_6 = mysqli_fetch_assoc($resultado_6)) {
                    $array_visitasocial_mediotrans_llegada[] = $row_6;
                }

                // --------------------- Tabla 'visitasocial_mediotrans_ida' --------------------- //
                $resultado_7 = $link->query("
                  SELECT  
                  medio_transporte.idmedio_transporte,
                  medio_transporte.descripcion_medio_transporte
                  FROM visitasocial_mediotrans_ida
                  LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_mediotrans_ida.idudc_visita_social
                  LEFT JOIN medio_transporte ON medio_transporte.idmedio_transporte = visitasocial_mediotrans_ida.idmedio_transporte 
                  WHERE visitasocial_mediotrans_ida.idudc_visita_social = ".$idudc_visita_social."
                ");

                $array_visitasocial_mediotrans_ida = [];
                while($row_7 = mysqli_fetch_assoc($resultado_7)) {
                    $array_visitasocial_mediotrans_ida[] = $row_7;
                }

                // --------------------- Tabla 'visitasocial_droga_consumidajug' --------------------- //
                $resultado_8 = $link->query("
                  SELECT * FROM visitasocial_droga_consumidajug
                  LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_droga_consumidajug.idudc_visita_social
                  WHERE visitasocial_droga_consumidajug.idudc_visita_social = ".$idudc_visita_social."
                ");

                $array_visitasocial_droga_consumidajug = [];
                while($row_8 = mysqli_fetch_assoc($resultado_8)) {
                    $array_visitasocial_droga_consumidajug[] = $row_8;
                }

                // --------------------- Tabla 'visitasocial_droga_probadajug' --------------------- //
                $resultado_9 = $link->query("
                  SELECT  
                  droga.iddroga,
                  droga.descripcion_droga
                  FROM visitasocial_droga_probadajug
                  LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_droga_probadajug.idudc_visita_social
                  LEFT JOIN droga ON droga.iddroga = visitasocial_droga_probadajug.iddroga
                  WHERE visitasocial_droga_probadajug.idudc_visita_social = ".$idudc_visita_social."
                ");

                $array_visitasocial_droga_probadajug = [];
                while($row_9 = mysqli_fetch_assoc($resultado_9)) {
                    $array_visitasocial_droga_probadajug[] = $row_9;
                }                       

                // --------------------- Tabla 'visitasocial_droga_consumidafam' --------------------- //
                $resultado_10 = $link->query("
                  SELECT * FROM visitasocial_droga_consumidafam
                  LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_droga_consumidafam.idudc_visita_social
                  WHERE visitasocial_droga_consumidafam.idudc_visita_social = ".$idudc_visita_social."
                ");

                $array_visitasocial_droga_consumidafam = [];
                while($row_10 = mysqli_fetch_assoc($resultado_10)) {
                    $array_visitasocial_droga_consumidafam[] = $row_10;
                }

                // Consultando posiciones:
                $resultado_11 = $link->query("
                SELECT 
                posicionCancha.posicion,
                posicionCancha.numero_posicion
                FROM fichaJugador        
                -- Datos de la posición:
                LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
                WHERE posicionCancha.idfichaJugador = ".$idfichaJugador."        
                ");

                while($row_11 = mysqli_fetch_assoc($resultado_11)) {  
                    $posicion = $row_11['posicion'];
                    $numero_posicion = $row_11['numero_posicion']; 
                    $row['posicion'.$numero_posicion] = $posicion;                                        
                }                  


                $row['array_persona_domicilio_jugador'] = $array_persona_domicilio_jugador;
                $row['array_hijo_jugador'] = $array_hijo_jugador;
                $row['array_visitasocial_llegada_club'] = $array_visitasocial_llegada_club;
                $row['array_visitasocial_ida_club'] = $array_visitasocial_ida_club;
                $row['array_visitasocial_mediotrans_llegada'] = $array_visitasocial_mediotrans_llegada;
                $row['array_visitasocial_mediotrans_ida'] = $array_visitasocial_mediotrans_ida;
                $row['array_visitasocial_droga_consumidajug'] = $array_visitasocial_droga_consumidajug;
                $row['array_visitasocial_droga_probadajug'] = $array_visitasocial_droga_probadajug;
                $row['array_visitasocial_droga_consumidafam'] = $array_visitasocial_droga_consumidafam;

                $dato[] = utf8_converter( $row );         

                unset($array_persona_domicilio_jugador);
                unset($array_hijo_jugador);
                unset($array_visitasocial_llegada_club);
                unset($array_visitasocial_ida_club);  
                unset($array_visitasocial_mediotrans_llegada);
                unset($array_visitasocial_mediotrans_ida);
                unset($array_visitasocial_droga_consumidajug);
                unset($array_visitasocial_droga_probadajug);
                unset($array_visitasocial_droga_consumidafam);             

            }
            break; 

        case '3':
            $idudc_visita_social = $datos['idudc_visita_social']; 
            
            $resultado = $link->query("
                SELECT * FROM udc_visita_social 
                WHERE idudc_visita_social = ".$idudc_visita_social." 
            ");
                
            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                $dato[] = utf8_converter( $row );          
            }              $resultado_2 = $link->query("
                  SELECT * FROM estadistica_informe_csj
                  -- Tabla 'informe_cscouting_jugador':
                  LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = estadistica_informe_csj.idinforme_cscouting_jugador
                  WHERE estadistica_informe_csj.idinforme_cscouting_jugador = ".$idinforme_cscouting_jugador."
              ");

              $estadisticas = [];
              while($row_2 = mysqli_fetch_assoc($resultado_2)) {
                  $estadisticas[] = $row_2;
              } 

              $row['estadisticas'] = $estadisticas;
              $dato[] = utf8_converter( $row );
              unset($estadisticas);
            break;                        

        // ------------------------------------ TODOS LOS TIPOS DE LLEGADA E IDA A/DE CLUB  ------------------------------------ // 
        case 'get_llegada_ida_club':
            $resultado = $link->query("
                SELECT * FROM llegada_ida_club
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break;  

        // ------------------------------------ TODOS LOS MEDIOS DE TRANSPORTE  ------------------------------------ // 
        case 'get_medio_transporte':
            $resultado = $link->query("
                SELECT * FROM medio_transporte
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break;  

        // ------------------------------------ TODOS LAS DROGAS  ------------------------------------ // 
        case 'get_droga':
            $resultado = $link->query("
                SELECT * FROM droga
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break;                                      

        // ------------------------------------ CONSULTANDO EL ÚLTIMO TIPO DE AYUDA SOCIAL  ------------------------------------ // 
        case 'get_ultimo_registro':

            $tabla = '';
            $id = '';

            switch ( $datos['registro'] ) {

                case '1':
                case '2':
                    $tabla = 'llegada_ida_club';
                    $id = 'idllegada_ida_club';        
                    break;
                // -------------------------- //            

                case '5':
                case '6':
                case '7':
                    $tabla = 'droga';
                    $id = 'iddroga';           
                    break;
                // -------------------------- //            

            }


            $resultado = $link->query("
                SELECT * FROM ".$tabla."
                ORDER BY ".$id." DESC
                LIMIT 1                
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break;     

    }


    $link->close();
    return $dato;       
    
}

function guardar($datos){
    include("conexion.php");
    $respuesta = "";
    $query = "";

    // ------- Datos opcionales -------// 
    if( !isset( $datos['af_conquien_comparte_habitacion'] ) ) {
        $datos['af_conquien_comparte_habitacion'] = '';
    }

    if( !isset( $datos['rp_hace_cuanto'] ) ) {
        $datos['rp_hace_cuanto'] = '';
    }

    if( !isset( $datos['rp_relacion_pareja'] ) ) {
        $datos['rp_relacion_pareja'] = '';
    }

    if( !isset( $datos['s_frecuencia_consumo_drogas'] ) ) {
        $datos['s_frecuencia_consumo_drogas'] = '';
    }

    if( !isset( $datos['s_quien_consume_drogas_familiar'] ) ) {
        $datos['s_quien_consume_drogas_familiar'] = '';
    }

    if( !isset( $datos['aj_jugador_antecedentes'] ) ) {
        $datos['aj_jugador_antecedentes'] = '';
    }

    if( !isset( $datos['aj_familiar_antecedentes'] ) ) {
        $datos['aj_familiar_antecedentes'] = '';
    }

    if( !isset( $datos['od_nombre_compania_seguro'] ) ) {
        $datos['od_nombre_compania_seguro'] = '';
    }

    if( !isset( $datos['od_seguro_vencimiento'] ) ) {
        $datos['od_seguro_vencimiento'] = '';
    }

    if( !isset( $datos['od_num_pasaporte'] ) ) {
        $datos['od_num_pasaporte'] = '';
    }

    if( !isset( $datos['od_pasaporte_vencimiento'] ) ) {
        $datos['od_pasaporte_vencimiento'] = '';
    }

    // ------- PADRE ------- //
    if( !isset( $datos['od_padre_discapacidad'] ) ) {
        $datos['od_padre_discapacidad'] = '';
    }

    if( !isset( $datos['od_padre_trabajo_nombre'] ) ) {
        $datos['od_padre_trabajo_nombre'] = '';
    }

    if( !isset( $datos['od_padre_tiempo_cesante_jubilado'] ) ) {
        $datos['od_padre_tiempo_cesante_jubilado'] = '';
    }        

    // ------- MADRE ------- //
    if( !isset( $datos['od_madre_discapacidad'] ) ) {
        $datos['od_madre_discapacidad'] = '';
    }

    if( !isset( $datos['od_madre_trabajo_nombre'] ) ) {
        $datos['od_madre_trabajo_nombre'] = '';
    }

    if( !isset( $datos['od_madre_tiempo_cesante_jubilado'] ) ) {
        $datos['od_madre_tiempo_cesante_jubilado'] = '';
    } 

    if($datos['idudc_visita_social']==''){//agregar nuevo jugador
        $query = $link->query("INSERT INTO udc_visita_social (
            idfichaJugador,
            domicilio_actual,
            comuna,
            comuna_procedencia,
            apod_nombre,
            apod_parentesco,
            apod_correo,
            apod_telefono,
            af_num_personas_gf,
            af_num_personas_domicilio,
            af_num_habitaciones_domicilio,
            af_comparte_habitacion,
            af_conquien_comparte_habitacion,
            af_ingreso_nucleo_familiar,
            af_indep_economica,
            af_situacion_conyugal_padres,
            af_num_hermanos,
            af_principal_sostenedor,
            af_tipo_domicilio_jugador,
            af_info_grupo_familiar,
            af_valoracion,
            af_valoracion_text,
            rp_situacion_amorosa,
            rp_hace_cuanto,
            rp_relacion_pareja,
            rp_inicio_vida_sexual,
            rp_metodo_proteccion,
            rp_orientacion_temas_sexuales,
            rp_tiene_hijos,
            rp_num_hijos,
            rp_valoracion,
            rp_valoracion_text,
            a_costear_alimentacion,
            a_observaciones,
            a_comidas_club,
            a_comidas_diarias,
            a_valoracion,
            a_valoracion_text,
            l_valoracion,
            l_valoracion_text,
            s_consume_drogas,
            s_frecuencia_consumo_drogas,
            s_familiar_consume_drogas,
            s_quien_consume_drogas_familiar,
            s_valoracion,
            s_valoracion_text,
            aj_jugador_tiene_antecedentes,
            aj_jugador_antecedentes,
            aj_familiar_tiene_antecedentes,
            aj_familiar_antecedentes,
            aj_valoracion,
            aj_valoracion_text,
            od_tiene_seguro,
            od_nombre_compania_seguro,
            od_seguro_vencimiento,
            od_tiene_pasaporte,
            od_num_pasaporte,
            od_pasaporte_vencimiento,
            od_vencimiento_carnetid,
            od_observaciones,
            od_padre_nombre,
            od_padre_apellido,
            od_padre_telefono,
            od_padre_correo,
            od_padre_tiene_discapacidad,
            od_padre_discapacidad, 
            od_padre_comuna_residencia,
            od_padre_trabaja,
            od_padre_trabajo_nombre,
            od_padre_tiempo_cesante_jubilado,
            od_madre_nombre,
            od_madre_apellido,
            od_madre_telefono,
            od_madre_correo,
            od_madre_tiene_discapacidad,
            od_madre_discapacidad, 
            od_madre_comuna_residencia,
            od_madre_trabaja,
            od_madre_trabajo_nombre,
            od_madre_tiempo_cesante_jubilado,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
              '".utf8_decode($datos['idfichaJugador'])."',
              '".utf8_decode($datos['domicilio_actual'])."',
              '".utf8_decode($datos['comuna'])."',
              '".utf8_decode($datos['comuna_procedencia'])."',
              '".utf8_decode($datos['apod_nombre'])."',
              '".utf8_decode($datos['apod_parentesco'])."',
              '".utf8_decode($datos['apod_correo'])."',
              '".utf8_decode($datos['apod_telefono'])."',
              '".utf8_decode($datos['af_num_personas_gf'])."',
              '".utf8_decode($datos['af_num_personas_domicilio'])."',
              '".utf8_decode($datos['af_num_habitaciones_domicilio'])."',
              '".utf8_decode($datos['af_comparte_habitacion'])."',
              '".utf8_decode($datos['af_conquien_comparte_habitacion'])."',
              '".utf8_decode($datos['af_ingreso_nucleo_familiar'])."',
              '".utf8_decode($datos['af_indep_economica'])."',
              '".utf8_decode($datos['af_situacion_conyugal_padres'])."',
              '".utf8_decode($datos['af_num_hermanos'])."',
              '".utf8_decode($datos['af_principal_sostenedor'])."',
              '".utf8_decode($datos['af_tipo_domicilio_jugador'])."',
              '".utf8_decode($datos['af_info_grupo_familiar'])."',
              '".utf8_decode($datos['af_valoracion'])."',
              '".utf8_decode($datos['af_valoracion_text'])."',
              '".utf8_decode($datos['rp_situacion_amorosa'])."',
              '".utf8_decode($datos['rp_hace_cuanto'])."',
              '".utf8_decode($datos['rp_relacion_pareja'])."',
              '".utf8_decode($datos['rp_inicio_vida_sexual'])."',
              '".utf8_decode($datos['rp_metodo_proteccion'])."',
              '".utf8_decode($datos['rp_orientacion_temas_sexuales'])."',
              '".utf8_decode($datos['rp_tiene_hijos'])."',
              '".utf8_decode($datos['rp_num_hijos'])."',
              '".utf8_decode($datos['rp_valoracion'])."',
              '".utf8_decode($datos['rp_valoracion_text'])."',
              '".utf8_decode($datos['a_costear_alimentacion'])."',
              '".utf8_decode($datos['a_observaciones'])."',
              '".utf8_decode($datos['a_comidas_club'])."',
              '".utf8_decode($datos['a_comidas_diarias'])."',
              '".utf8_decode($datos['a_valoracion'])."',
              '".utf8_decode($datos['a_valoracion_text'])."',
              '".utf8_decode($datos['l_valoracion'])."',
              '".utf8_decode($datos['l_valoracion_text'])."',
              '".utf8_decode($datos['s_consume_drogas'])."',
              '".utf8_decode($datos['s_frecuencia_consumo_drogas'])."',
              '".utf8_decode($datos['s_familiar_consume_drogas'])."',
              '".utf8_decode($datos['s_quien_consume_drogas_familiar'])."',
              '".utf8_decode($datos['s_valoracion'])."',
              '".utf8_decode($datos['s_valoracion_text'])."',
              '".utf8_decode($datos['aj_jugador_tiene_antecedentes'])."',
              '".utf8_decode($datos['aj_jugador_antecedentes'])."',
              '".utf8_decode($datos['aj_familiar_tiene_antecedentes'])."',
              '".utf8_decode($datos['aj_familiar_antecedentes'])."',
              '".utf8_decode($datos['aj_valoracion'])."',
              '".utf8_decode($datos['aj_valoracion_text'])."',
              '".utf8_decode($datos['od_tiene_seguro'])."',
              '".utf8_decode($datos['od_nombre_compania_seguro'])."',
              '".utf8_decode($datos['od_seguro_vencimiento'])."',
              '".utf8_decode($datos['od_tiene_pasaporte'])."',
              '".utf8_decode($datos['od_num_pasaporte'])."',
              '".utf8_decode($datos['od_pasaporte_vencimiento'])."',
              '".utf8_decode($datos['od_vencimiento_carnetid'])."',
              '".utf8_decode($datos['od_observaciones'])."',
              '".utf8_decode($datos['od_padre_nombre'])."',
              '".utf8_decode($datos['od_padre_apellido'])."',
              '".utf8_decode($datos['od_padre_telefono'])."',
              '".utf8_decode($datos['od_padre_correo'])."',
              '".utf8_decode($datos['od_padre_tiene_discapacidad'])."',
              '".utf8_decode($datos['od_padre_discapacidad'])."', 
              '".utf8_decode($datos['od_padre_comuna_residencia'])."',
              '".utf8_decode($datos['od_padre_trabaja'])."',
              '".utf8_decode($datos['od_padre_trabajo_nombre'])."',
              '".utf8_decode($datos['od_padre_tiempo_cesante_jubilado'])."',
              '".utf8_decode($datos['od_madre_nombre'])."',
              '".utf8_decode($datos['od_madre_apellido'])."',
              '".utf8_decode($datos['od_madre_telefono'])."',
              '".utf8_decode($datos['od_madre_correo'])."',
              '".utf8_decode($datos['od_madre_tiene_discapacidad'])."',
              '".utf8_decode($datos['od_madre_discapacidad'])."', 
              '".utf8_decode($datos['od_madre_comuna_residencia'])."',
              '".utf8_decode($datos['od_madre_trabaja'])."',
              '".utf8_decode($datos['od_madre_trabajo_nombre'])."',
              '".utf8_decode($datos['od_madre_tiempo_cesante_jubilado'])."',              
              '".utf8_decode($datos['nombre_usuario_software'])."',
              '".getDateTime()."'
        )");

        if( $query )  { 
            // $respuesta = 1; // INSERT ejecutado correctamente.

            // Valor del ID del informe de ayuda recién insertado:
            $idudc_visita_social = $link->insert_id;

            // Estatus de la consultas:
            $status_query = "";        

            // ------------------- DETALLE PERSONAS QUE VIVEN CON EL JUGADOR  ------------------- //
            if( isset( $datos['array_nombre_domicilio_jugador'] )  ) {

                $array_nombre_domicilio_jugador = $datos['array_nombre_domicilio_jugador'];
                $array_parentesco_domicilio_jugador = $datos['array_parentesco_domicilio_jugador'];
                $array_edad_domicilio_jugador = $datos['array_edad_domicilio_jugador'];
                $array_nivel_educacional_domicilio_jugador = $datos['array_nivel_educacional_domicilio_jugador'];
                $array_ocupacion_domicilio_jugador = $datos['array_ocupacion_domicilio_jugador'];

                for ( $i=0; $i < count($array_nombre_domicilio_jugador); $i++ ) {
                    
                    $nombre_domicilio_jugador = $array_nombre_domicilio_jugador[$i];
                    $parentesco_domicilio_jugador =  $array_parentesco_domicilio_jugador[$i];
                    $edad_domicilio_jugador =  $array_edad_domicilio_jugador[$i];
                    $nivel_educacional_domicilio_jugador =  $array_nivel_educacional_domicilio_jugador[$i];
                    $ocupacion_domicilio_jugador =  $array_ocupacion_domicilio_jugador[$i];

                    // ----------- Tabla 'persona_domicilio_jugador' ----------- //
                    // INSERT:
                    $query = $link->query("INSERT INTO persona_domicilio_jugador (
                        idudc_visita_social,
                        nombre_domicilio_jugador,
                        parentesco_domicilio_jugador,
                        edad_domicilio_jugador,
                        nivel_educacional_domicilio_jugador,
                        ocupacion_domicilio_jugador
                        ) VALUES (
                          '".utf8_decode($idudc_visita_social)."',
                          '".utf8_decode($nombre_domicilio_jugador)."',
                          '".utf8_decode($parentesco_domicilio_jugador)."',
                          '".utf8_decode($edad_domicilio_jugador)."',
                          '".utf8_decode($nivel_educacional_domicilio_jugador)."',
                          '".utf8_decode($ocupacion_domicilio_jugador)."'
                    )");
                  

                }

                if( $query ) {
                  $status_query = true;
                } else {
                  $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'persona_domicilio_jugador')...
                }

            } else {
                $status_query = true;
            }

            // ------------------- DATOS DEL/ DE LOS HIJO(S) DEL JUGADOR  ------------------- //
            if( isset( $datos['array_edadhijo_jugador'] )  ) {

                $array_edadhijo_jugador = $datos['array_edadhijo_jugador'];
                $array_vivecon_hijo_jugador = $datos['array_vivecon_hijo_jugador'];
                $array_tiempocon_hijo_jugador = $datos['array_tiempocon_hijo_jugador'];

                for ( $i=0; $i < count($array_edadhijo_jugador); $i++ ) {
                    
                    $edadhijo_jugador = $array_edadhijo_jugador[$i];
                    $vivecon_hijo_jugador = $array_vivecon_hijo_jugador[$i];
                    $tiempocon_hijo_jugador = $array_tiempocon_hijo_jugador[$i];

                    // ----------- Tabla 'hijo_jugador' ----------- //
                    // INSERT:
                    $query = $link->query("INSERT INTO hijo_jugador (
                        idudc_visita_social,
                        edadhijo_jugador,
                        vivecon_hijo_jugador,
                        tiempocon_hijo_jugador
                        ) VALUES (
                          '".utf8_decode($idudc_visita_social)."',
                          '".utf8_decode($edadhijo_jugador)."',
                          '".utf8_decode($vivecon_hijo_jugador)."',
                          '".utf8_decode($tiempocon_hijo_jugador)."'
                    )");
                  

                }

                if( $query ) {
                  $status_query = true;
                } else {
                  $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'hijo_jugador')...
                }                

            } else {
                $status_query = true;
            }            

            // ------------------- ¿CÓMO LLEGA AL CLUB? ------------------- //
            if( isset( $datos['array_llegada_club'] )  ) {

                $array_llegada_club = $datos['array_llegada_club'];

                $array_idllegada_ida_club = [];

                for ( $i=0; $i < count($array_llegada_club); $i++ ) {
                    $idllegada_ida_club = $array_llegada_club[$i];

                    if( $idllegada_ida_club != '000' ) { // <---- Esto evita que agrege el valor del checkbox 'Otro'.
                        $array_idllegada_ida_club[] = $idllegada_ida_club;
                    }

                }

                // ---------------------------- Insertando en la tabla 'visitasocial_llegada_club' ---------------------------- //
                for ( $j=0; $j< count($array_idllegada_ida_club); $j++ ) {

                    $idllegada_ida_club = $array_idllegada_ida_club[$j];

                    // ----------- Tabla 'visitasocial_llegada_club' ----------- //
                    // INSERT:
                    $query = $link->query("INSERT INTO visitasocial_llegada_club (
                        idudc_visita_social,
                        idllegada_ida_club
                        ) VALUES (
                          '".utf8_decode($idudc_visita_social)."',
                          '".utf8_decode($idllegada_ida_club)."'
                    )");

                }

                if( $query ) {
                  $status_query = true;
                } else {
                  $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'visitasocial_llegada_club')...
                }                  

            } else {
                $status_query = true;
            }

            // ------------------- MEDIO DE LLEGADA AL CLUB ------------------- //
            if( isset( $datos['array_medio_transporte_llegada'] )  ) {

                $array_medio_transporte_llegada = $datos['array_medio_transporte_llegada'];

                $array_idmedio_transporte = [];

                for ( $i=0; $i < count($array_medio_transporte_llegada); $i++ ) {
                    $idmedio_transporte = $array_medio_transporte_llegada[$i];

                    if( $idmedio_transporte != '000' ) { // <---- Esto evita que agrege el valor del checkbox 'Otro'.
                        $array_idmedio_transporte[] = $idmedio_transporte;
                    }

                }

                // ---------------------------- Insertando en la tabla 'visitasocial_mediotrans_llegada' ---------------------------- //
                for ( $j=0; $j< count($array_idmedio_transporte); $j++ ) {

                    $idmedio_transporte = $array_idmedio_transporte[$j];

                    // ----------- Tabla 'visitasocial_mediotrans_llegada' ----------- //
                    // INSERT:
                    $query = $link->query("INSERT INTO visitasocial_mediotrans_llegada (
                        idudc_visita_social,
                        idmedio_transporte
                        ) VALUES (
                          '".utf8_decode($idudc_visita_social)."',
                          '".utf8_decode($idmedio_transporte)."'
                    )");

                }

                if( $query ) {
                  $status_query = true;
                } else {
                  $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'visitasocial_mediotrans_llegada')...
                }                

            } else {
                $status_query = true;
            }               
            
            // ------------------- ¿CÓMO SE VA DEL CLUB? ------------------- //
            if( isset( $datos['array_ida_club'] )  ) {

                $array_ida_club = $datos['array_ida_club'];

                $array_idllegada_ida_club = [];

                for ( $i=0; $i < count($array_ida_club); $i++ ) {
                    $idllegada_ida_club = $array_ida_club[$i];

                    if( $idllegada_ida_club != '000' ) { // <---- Esto evita que agrege el valor del checkbox 'Otro'.
                        $array_idllegada_ida_club[] = $idllegada_ida_club;
                    }

                }

                // ---------------------------- Insertando en la tabla 'visitasocial_ida_club' ---------------------------- //
                for ( $j=0; $j< count($array_idllegada_ida_club); $j++ ) {

                    $idllegada_ida_club = $array_idllegada_ida_club[$j];

                    // ----------- Tabla 'visitasocial_ida_club' ----------- //
                    // INSERT:
                    $query = $link->query("INSERT INTO visitasocial_ida_club (
                        idudc_visita_social,
                        idllegada_ida_club
                        ) VALUES (
                          '".utf8_decode($idudc_visita_social)."',
                          '".utf8_decode($idllegada_ida_club)."'
                    )");

                }

                if( $query ) {
                  $status_query = true;
                } else {
                  $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'visitasocial_ida_club')...
                }                  

            } else {
                $status_query = true;
            }

            // ------------------- MEDIO DE IDA AL CLUB ------------------- //
            if( isset( $datos['array_medio_transporte_ida'] )  ) {

                $array_medio_transporte_ida = $datos['array_medio_transporte_ida'];

                $array_idmedio_transporte = [];

                for ( $i=0; $i < count($array_medio_transporte_ida); $i++ ) {
                    $idmedio_transporte = $array_medio_transporte_ida[$i];

                    if( $idmedio_transporte != '000' ) { // <---- Esto evita que agrege el valor del checkbox 'Otro'.
                        $array_idmedio_transporte[] = $idmedio_transporte;
                    }

                }

                // ---------------------------- Insertando en la tabla 'visitasocial_mediotrans_ida' ---------------------------- //
                for ( $j=0; $j< count($array_idmedio_transporte); $j++ ) {

                    $idmedio_transporte = $array_idmedio_transporte[$j];

                    // ----------- Tabla 'visitasocial_mediotrans_ida' ----------- //
                    // INSERT:
                    $query = $link->query("INSERT INTO visitasocial_mediotrans_ida (
                        idudc_visita_social,
                        idmedio_transporte
                        ) VALUES (
                          '".utf8_decode($idudc_visita_social)."',
                          '".utf8_decode($idmedio_transporte)."'
                    )");

                }

                if( $query ) {
                  $status_query = true;
                } else {
                  $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'visitasocial_mediotrans_ida')...
                }                   

            } else {
                $status_query = true;
            }

            // ------------------- DROGAS CONSUMIDAS ------------------- //
            if( isset( $datos['array_drogas_consumidas_jugador'] )  ) {

                $array_drogas_consumidas_jugador = $datos['array_drogas_consumidas_jugador'];

                $array_id_drogas = [];

                for ( $i=0; $i < count($array_drogas_consumidas_jugador); $i++ ) {
                    $iddroga = $array_drogas_consumidas_jugador[$i];

                    if( $iddroga != '000' ) { // <---- Esto evita que agrege el valor del checkbox 'Otro'.
                        $array_id_drogas[] = $iddroga;
                    }

                }

                // ---------------------------- Insertando en la tabla 'visitasocial_droga_consumidajug' ---------------------------- //
                for ( $j=0; $j< count($array_id_drogas); $j++ ) {

                    $iddroga = $array_id_drogas[$j];

                    // ----------- Tabla 'visitasocial_droga_consumidajug' ----------- //
                    // INSERT:
                    $query = $link->query("INSERT INTO visitasocial_droga_consumidajug (
                        idudc_visita_social,
                        iddroga
                        ) VALUES (
                          '".utf8_decode($idudc_visita_social)."',
                          '".utf8_decode($iddroga)."'
                    )");

                }

                if( $query ) {
                  $status_query = true;
                } else {
                  $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'visitasocial_droga_consumidajug')...
                }                   

            } else {
                $status_query = true;
            }

            // ------------------- DROGAS PROBADAS ------------------- //
            if( isset( $datos['array_drogas_probadas_jugador'] )  ) {

                $array_drogas_probadas_jugador = $datos['array_drogas_probadas_jugador'];

                $array_id_drogas = [];

                for ( $i=0; $i < count($array_drogas_probadas_jugador); $i++ ) {
                    $iddroga = $array_drogas_probadas_jugador[$i];

                    if( $iddroga != '000' ) { // <---- Esto evita que agrege el valor del checkbox 'Otro'.
                        $array_id_drogas[] = $iddroga;
                    }

                }

                // ---------------------------- Insertando en la tabla 'visitasocial_droga_probadajug' ---------------------------- //
                for ( $j=0; $j< count($array_id_drogas); $j++ ) {

                    $iddroga = $array_id_drogas[$j];

                    // ----------- Tabla 'visitasocial_droga_probadajug' ----------- //
                    // INSERT:
                    $query = $link->query("INSERT INTO visitasocial_droga_probadajug (
                        idudc_visita_social,
                        iddroga
                        ) VALUES (
                          '".utf8_decode($idudc_visita_social)."',
                          '".utf8_decode($iddroga)."'
                    )");

                }

                if( $query ) {
                  $status_query = true;
                } else {
                  $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'visitasocial_droga_probadajug')...
                }                   

            } else {
                $status_query = true;
            }                        

            // ------------------- DROGAS CONSUMIDAS (FAMILIAR) ------------------- //
            if( isset( $datos['array_drogas_consumidas_familiar'] )  ) {

                $array_drogas_consumidas_familiar = $datos['array_drogas_consumidas_familiar'];

                $array_id_drogas = [];

                for ( $i=0; $i < count($array_drogas_consumidas_familiar); $i++ ) {
                    $iddroga = $array_drogas_consumidas_familiar[$i];

                    if( $iddroga != '000' ) { // <---- Esto evita que agrege el valor del checkbox 'Otro'.
                        $array_id_drogas[] = $iddroga;
                    }

                }

                // ---------------------------- Insertando en la tabla 'visitasocial_droga_consumidafam' ---------------------------- //
                for ( $j=0; $j< count($array_id_drogas); $j++ ) {

                    $iddroga = $array_id_drogas[$j];

                    // ----------- Tabla 'visitasocial_droga_consumidafam' ----------- //
                    // INSERT:
                    $query = $link->query("INSERT INTO visitasocial_droga_consumidafam (
                        idudc_visita_social,
                        iddroga
                        ) VALUES (
                          '".utf8_decode($idudc_visita_social)."',
                          '".utf8_decode($iddroga)."'
                    )");

                }

                if( $query ) {
                  $status_query = true;
                } else {
                  $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'visitasocial_droga_consumidafam')...
                }                   

            } else {
                $status_query = true;
            }

          // -------------------------- FIN DE CONSULTAS INSERT --------------------------  //

          // Si todo va bien con las consultas INSERT...
          if( $status_query === true ) {
            $respuesta = 1; // INSERT ejecutado correctamente.
          } else {
            $respuesta = 'Error al ejecutar sentencias INSERT...'; // INSERT ejecutado incorrectamente.
          }

        } else {
          $respuesta = $link->error; // Error al insertar datos en la tabla 'udc_visita_social'       
        }          

    }else{ // <------------- UPDATE

        $idudc_visita_social = $datos['idudc_visita_social'];

        $query = $link->query("UPDATE udc_visita_social SET 
            domicilio_actual = '".utf8_decode($datos['domicilio_actual'])."',
            comuna = '".utf8_decode($datos['comuna'])."',
            comuna_procedencia = '".utf8_decode($datos['comuna_procedencia'])."',
            apod_nombre = '".utf8_decode($datos['apod_nombre'])."',
            apod_parentesco = '".utf8_decode($datos['apod_parentesco'])."',
            apod_correo = '".utf8_decode($datos['apod_correo'])."',
            apod_telefono = '".utf8_decode($datos['apod_telefono'])."',
            af_num_personas_gf = '".utf8_decode($datos['af_num_personas_gf'])."',
            af_num_personas_domicilio = '".utf8_decode($datos['af_num_personas_domicilio'])."',
            af_num_habitaciones_domicilio = '".utf8_decode($datos['af_num_habitaciones_domicilio'])."',
            af_comparte_habitacion = '".utf8_decode($datos['af_comparte_habitacion'])."',
            af_conquien_comparte_habitacion = '".utf8_decode($datos['af_conquien_comparte_habitacion'])."',
            af_ingreso_nucleo_familiar = '".utf8_decode($datos['af_ingreso_nucleo_familiar'])."',
            af_indep_economica = '".utf8_decode($datos['af_indep_economica'])."',
            af_situacion_conyugal_padres = '".utf8_decode($datos['af_situacion_conyugal_padres'])."',
            af_num_hermanos = '".utf8_decode($datos['af_num_hermanos'])."',
            af_principal_sostenedor = '".utf8_decode($datos['af_principal_sostenedor'])."',
            af_tipo_domicilio_jugador = '".utf8_decode($datos['af_tipo_domicilio_jugador'])."',
            af_info_grupo_familiar = '".utf8_decode($datos['af_info_grupo_familiar'])."',
            af_valoracion = '".utf8_decode($datos['af_valoracion'])."',
            af_valoracion_text = '".utf8_decode($datos['af_valoracion_text'])."',
            rp_situacion_amorosa = '".utf8_decode($datos['rp_situacion_amorosa'])."',
            rp_hace_cuanto = '".utf8_decode($datos['rp_hace_cuanto'])."',
            rp_relacion_pareja = '".utf8_decode($datos['rp_relacion_pareja'])."',
            rp_inicio_vida_sexual = '".utf8_decode($datos['rp_inicio_vida_sexual'])."',
            rp_metodo_proteccion = '".utf8_decode($datos['rp_metodo_proteccion'])."',
            rp_orientacion_temas_sexuales = '".utf8_decode($datos['rp_orientacion_temas_sexuales'])."',
            rp_tiene_hijos = '".utf8_decode($datos['rp_tiene_hijos'])."',
            rp_num_hijos = '".utf8_decode($datos['rp_num_hijos'])."',
            rp_valoracion = '".utf8_decode($datos['rp_valoracion'])."',
            rp_valoracion_text = '".utf8_decode($datos['rp_valoracion_text'])."',
            a_costear_alimentacion = '".utf8_decode($datos['a_costear_alimentacion'])."',
            a_observaciones = '".utf8_decode($datos['a_observaciones'])."',
            a_comidas_club = '".utf8_decode($datos['a_comidas_club'])."',
            a_comidas_diarias = '".utf8_decode($datos['a_comidas_diarias'])."',
            a_valoracion = '".utf8_decode($datos['a_valoracion'])."',
            a_valoracion_text = '".utf8_decode($datos['a_valoracion_text'])."',
            l_valoracion = '".utf8_decode($datos['l_valoracion'])."',
            l_valoracion_text = '".utf8_decode($datos['l_valoracion_text'])."',
            s_consume_drogas = '".utf8_decode($datos['s_consume_drogas'])."',
            s_frecuencia_consumo_drogas = '".utf8_decode($datos['s_frecuencia_consumo_drogas'])."',
            s_familiar_consume_drogas = '".utf8_decode($datos['s_familiar_consume_drogas'])."',
            s_quien_consume_drogas_familiar = '".utf8_decode($datos['s_quien_consume_drogas_familiar'])."',
            s_valoracion = '".utf8_decode($datos['s_valoracion'])."',
            s_valoracion_text = '".utf8_decode($datos['s_valoracion_text'])."',
            aj_jugador_tiene_antecedentes = '".utf8_decode($datos['aj_jugador_tiene_antecedentes'])."',
            aj_jugador_antecedentes = '".utf8_decode($datos['aj_jugador_antecedentes'])."',
            aj_familiar_tiene_antecedentes = '".utf8_decode($datos['aj_familiar_tiene_antecedentes'])."',
            aj_familiar_antecedentes = '".utf8_decode($datos['aj_familiar_antecedentes'])."',
            aj_valoracion = '".utf8_decode($datos['aj_valoracion'])."',
            aj_valoracion_text = '".utf8_decode($datos['aj_valoracion_text'])."',
            od_tiene_seguro = '".utf8_decode($datos['od_tiene_seguro'])."',
            od_nombre_compania_seguro = '".utf8_decode($datos['od_nombre_compania_seguro'])."',
            od_seguro_vencimiento = '".utf8_decode($datos['od_seguro_vencimiento'])."',
            od_tiene_pasaporte = '".utf8_decode($datos['od_tiene_pasaporte'])."',
            od_num_pasaporte = '".utf8_decode($datos['od_num_pasaporte'])."',
            od_pasaporte_vencimiento = '".utf8_decode($datos['od_pasaporte_vencimiento'])."',
            od_vencimiento_carnetid = '".utf8_decode($datos['od_vencimiento_carnetid'])."',
            od_observaciones = '".utf8_decode($datos['od_observaciones'])."',
            od_padre_nombre = '".utf8_decode($datos['od_padre_nombre'])."',
            od_padre_apellido = '".utf8_decode($datos['od_padre_apellido'])."',
            od_padre_telefono = '".utf8_decode($datos['od_padre_telefono'])."',
            od_padre_correo = '".utf8_decode($datos['od_padre_correo'])."',
            od_padre_tiene_discapacidad = '".utf8_decode($datos['od_padre_tiene_discapacidad'])."',
            od_padre_discapacidad = '".utf8_decode($datos['od_padre_discapacidad'])."',
            od_padre_comuna_residencia = '".utf8_decode($datos['od_padre_comuna_residencia'])."',
            od_padre_trabaja = '".utf8_decode($datos['od_padre_trabaja'])."',
            od_padre_trabajo_nombre = '".utf8_decode($datos['od_padre_trabajo_nombre'])."',
            od_padre_tiempo_cesante_jubilado = '".utf8_decode($datos['od_padre_tiempo_cesante_jubilado'])."',
            od_madre_nombre = '".utf8_decode($datos['od_madre_nombre'])."',
            od_madre_apellido = '".utf8_decode($datos['od_madre_apellido'])."',
            od_madre_telefono = '".utf8_decode($datos['od_madre_telefono'])."',
            od_madre_correo = '".utf8_decode($datos['od_madre_correo'])."',
            od_madre_tiene_discapacidad = '".utf8_decode($datos['od_madre_tiene_discapacidad'])."',
            od_madre_discapacidad = '".utf8_decode($datos['od_madre_discapacidad'])."',
            od_madre_comuna_residencia = '".utf8_decode($datos['od_madre_comuna_residencia'])."',
            od_madre_trabaja = '".utf8_decode($datos['od_madre_trabaja'])."',
            od_madre_trabajo_nombre = '".utf8_decode($datos['od_madre_trabajo_nombre'])."',
            od_madre_tiempo_cesante_jubilado = '".utf8_decode($datos['od_madre_tiempo_cesante_jubilado'])."',            
            nombre_usuario_software = '".utf8_decode($datos['nombre_usuario_software'])."',
            fecha_software = '".getDateTime()."'
            WHERE idudc_visita_social = '".$idudc_visita_social."'
        "); 

        if( $query )  { 
            // $respuesta = 2; // UPDATE ejecutado correctamente.
        
            // Estatus de la consultas:
            $status_query = "";        

            // ------------------- DETALLE PERSONAS QUE VIVEN CON EL JUGADOR  ------------------- //
            if( isset( $datos['array_nombre_domicilio_jugador'] )  ) {

                // ----------- DELETE a Tabla 'persona_domicilio_jugador' ----------- //
                $query = $link->query("DELETE FROM persona_domicilio_jugador WHERE idudc_visita_social = ".$idudc_visita_social."");

                if( $query ) {

                    $array_nombre_domicilio_jugador = $datos['array_nombre_domicilio_jugador'];

                    $array_parentesco_domicilio_jugador = $datos['array_parentesco_domicilio_jugador'];
                    $array_edad_domicilio_jugador = $datos['array_edad_domicilio_jugador'];
                    $array_nivel_educacional_domicilio_jugador = $datos['array_nivel_educacional_domicilio_jugador'];
                    $array_ocupacion_domicilio_jugador = $datos['array_ocupacion_domicilio_jugador'];

                    for ( $i=0; $i < count($array_nombre_domicilio_jugador); $i++ ) {
                        
                        $nombre_domicilio_jugador = $array_nombre_domicilio_jugador[$i];
                        $parentesco_domicilio_jugador =  $array_parentesco_domicilio_jugador[$i];
                        $edad_domicilio_jugador =  $array_edad_domicilio_jugador[$i];
                        $nivel_educacional_domicilio_jugador =  $array_nivel_educacional_domicilio_jugador[$i];
                        $ocupacion_domicilio_jugador =  $array_ocupacion_domicilio_jugador[$i];

                        // ----------- Tabla 'persona_domicilio_jugador' ----------- //
                        // INSERT:
                        $query = $link->query("INSERT INTO persona_domicilio_jugador (
                            idudc_visita_social,
                            nombre_domicilio_jugador,
                            parentesco_domicilio_jugador,
                            edad_domicilio_jugador,
                            nivel_educacional_domicilio_jugador,
                            ocupacion_domicilio_jugador
                            ) VALUES (
                              '".utf8_decode($idudc_visita_social)."',
                              '".utf8_decode($nombre_domicilio_jugador)."',
                              '".utf8_decode($parentesco_domicilio_jugador)."',
                              '".utf8_decode($edad_domicilio_jugador)."',
                              '".utf8_decode($nivel_educacional_domicilio_jugador)."',
                              '".utf8_decode($ocupacion_domicilio_jugador)."'
                        )");
                      

                    }

                    if( $query ) {
                      $status_query = true;
                    } else {
                      $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'persona_domicilio_jugador')...
                    }

                } else {
                    $status_query = false;
                    $respuesta = $link->error; // Error al ejecutar DELETE (tabla 'persona_domicilio_jugador')...
                }

            } else {
                $status_query = true;
            }

            // ------------------- DATOS DEL/ DE LOS HIJO(S) DEL JUGADOR  ------------------- //
            if( isset( $datos['array_edadhijo_jugador'] )  ) {

                // ----------- DELETE a Tabla 'hijo_jugador' ----------- //
                $query = $link->query("DELETE FROM hijo_jugador WHERE idudc_visita_social = ".$idudc_visita_social."");

                if( $query ) {

                    $array_edadhijo_jugador = $datos['array_edadhijo_jugador'];
                    $array_vivecon_hijo_jugador = $datos['array_vivecon_hijo_jugador'];
                    $array_tiempocon_hijo_jugador = $datos['array_tiempocon_hijo_jugador'];

                    for ( $i=0; $i < count($array_edadhijo_jugador); $i++ ) {
                        
                        $edadhijo_jugador = $array_edadhijo_jugador[$i];
                        $vivecon_hijo_jugador = $array_vivecon_hijo_jugador[$i];
                        $tiempocon_hijo_jugador = $array_tiempocon_hijo_jugador[$i];

                        // ----------- Tabla 'hijo_jugador' ----------- //
                        // INSERT:
                        $query = $link->query("INSERT INTO hijo_jugador (
                            idudc_visita_social,
                            edadhijo_jugador,
                            vivecon_hijo_jugador,
                            tiempocon_hijo_jugador
                            ) VALUES (
                              '".utf8_decode($idudc_visita_social)."',
                              '".utf8_decode($edadhijo_jugador)."',
                              '".utf8_decode($vivecon_hijo_jugador)."',
                              '".utf8_decode($tiempocon_hijo_jugador)."'
                        )");
                      

                    }

                    if( $query ) {
                      $status_query = true;
                    } else {
                      $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'hijo_jugador')...
                    }                

                } else {
                    $status_query = false;
                    $respuesta = $link->error; // Error al ejecutar DELETE (tabla 'hijo_jugador')...                    
                }

            } else {
                $status_query = true;
            }            

            // ------------------- ¿CÓMO LLEGA AL CLUB? ------------------- //
            if( isset( $datos['array_llegada_club'] )  ) {

                // ----------- DELETE a Tabla 'visitasocial_llegada_club' ----------- //
                $query = $link->query("DELETE FROM visitasocial_llegada_club WHERE idudc_visita_social = ".$idudc_visita_social."");

                if( $query ) {

                    $array_llegada_club = $datos['array_llegada_club'];

                    $array_idllegada_ida_club = [];

                    for ( $i=0; $i < count($array_llegada_club); $i++ ) {
                        $idllegada_ida_club = $array_llegada_club[$i];

                        if( $idllegada_ida_club != '000' ) { // <---- Esto evita que agrege el valor del checkbox 'Otro'.
                            $array_idllegada_ida_club[] = $idllegada_ida_club;
                        }

                    }

                    // ---------------------------- Insertando en la tabla 'visitasocial_llegada_club' ---------------------------- //
                    for ( $j=0; $j< count($array_idllegada_ida_club); $j++ ) {

                        $idllegada_ida_club = $array_idllegada_ida_club[$j];

                        // ----------- Tabla 'visitasocial_llegada_club' ----------- //
                        // INSERT:
                        $query = $link->query("INSERT INTO visitasocial_llegada_club (
                            idudc_visita_social,
                            idllegada_ida_club
                            ) VALUES (
                              '".utf8_decode($idudc_visita_social)."',
                              '".utf8_decode($idllegada_ida_club)."'
                        )");

                    }

                    if( $query ) {
                      $status_query = true;
                    } else {
                      $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'visitasocial_llegada_club')...
                    } 

                } else {
                    $status_query = false;
                    $respuesta = $link->error; // Error al ejecutar DELETE (tabla 'visitasocial_llegada_club')...                    
                }           

            } else {
                $status_query = true;
            }

            // ------------------- MEDIO DE LLEGADA AL CLUB ------------------- //
            if( isset( $datos['array_medio_transporte_llegada'] )  ) {

                // ----------- DELETE a Tabla 'visitasocial_mediotrans_llegada' ----------- //
                $query = $link->query("DELETE FROM visitasocial_mediotrans_llegada WHERE idudc_visita_social = ".$idudc_visita_social."");

                if( $query ) {

                    $array_medio_transporte_llegada = $datos['array_medio_transporte_llegada'];

                    $array_idmedio_transporte = [];

                    for ( $i=0; $i < count($array_medio_transporte_llegada); $i++ ) {
                        $idmedio_transporte = $array_medio_transporte_llegada[$i];

                        if( $idmedio_transporte != '000' ) { // <---- Esto evita que agrege el valor del checkbox 'Otro'.
                            $array_idmedio_transporte[] = $idmedio_transporte;
                        }

                    }

                    // ---------------------------- Insertando en la tabla 'visitasocial_mediotrans_llegada' ---------------------------- //
                    for ( $j=0; $j< count($array_idmedio_transporte); $j++ ) {

                        $idmedio_transporte = $array_idmedio_transporte[$j];

                        // ----------- Tabla 'visitasocial_mediotrans_llegada' ----------- //
                        // INSERT:
                        $query = $link->query("INSERT INTO visitasocial_mediotrans_llegada (
                            idudc_visita_social,
                            idmedio_transporte
                            ) VALUES (
                              '".utf8_decode($idudc_visita_social)."',
                              '".utf8_decode($idmedio_transporte)."'
                        )");

                    }

                    if( $query ) {
                      $status_query = true;
                    } else {
                      $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'visitasocial_mediotrans_llegada')...
                    }  

                } else {
                    $status_query = false;
                    $respuesta = $link->error; // Error al ejecutar DELETE (tabla 'visitasocial_mediotrans_llegada')...                    
                }    
              

            } else {
                $status_query = true;
            }               
            
            // ------------------- ¿CÓMO SE VA DEL CLUB? ------------------- //
            if( isset( $datos['array_ida_club'] )  ) {

                // ----------- DELETE a Tabla 'visitasocial_ida_club' ----------- //
                $query = $link->query("DELETE FROM visitasocial_ida_club WHERE idudc_visita_social = ".$idudc_visita_social."");

                if( $query ) {

                    $array_ida_club = $datos['array_ida_club'];

                    $array_idllegada_ida_club = [];

                    for ( $i=0; $i < count($array_ida_club); $i++ ) {
                        $idllegada_ida_club = $array_ida_club[$i];

                        if( $idllegada_ida_club != '000' ) { // <---- Esto evita que agrege el valor del checkbox 'Otro'.
                            $array_idllegada_ida_club[] = $idllegada_ida_club;
                        }

                    }

                    // ---------------------------- Insertando en la tabla 'visitasocial_ida_club' ---------------------------- //
                    for ( $j=0; $j< count($array_idllegada_ida_club); $j++ ) {

                        $idllegada_ida_club = $array_idllegada_ida_club[$j];

                        // ----------- Tabla 'visitasocial_ida_club' ----------- //
                        // INSERT:
                        $query = $link->query("INSERT INTO visitasocial_ida_club (
                            idudc_visita_social,
                            idllegada_ida_club
                            ) VALUES (
                              '".utf8_decode($idudc_visita_social)."',
                              '".utf8_decode($idllegada_ida_club)."'
                        )");

                    }

                    if( $query ) {
                      $status_query = true;
                    } else {
                      $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'visitasocial_ida_club')...
                    }                  

                } else {
                    $status_query = false;
                    $respuesta = $link->error; // Error al ejecutar DELETE (tabla 'visitasocial_ida_club')...                    
                }    

            } else {
                $status_query = true;
            }

            // ------------------- MEDIO DE IDA AL CLUB ------------------- //
            if( isset( $datos['array_medio_transporte_ida'] )  ) {

                // ----------- DELETE a Tabla 'visitasocial_mediotrans_ida' ----------- //
                $query = $link->query("DELETE FROM visitasocial_mediotrans_ida WHERE idudc_visita_social = ".$idudc_visita_social."");

                if( $query ) {

                    $array_medio_transporte_ida = $datos['array_medio_transporte_ida'];

                    $array_idmedio_transporte = [];

                    for ( $i=0; $i < count($array_medio_transporte_ida); $i++ ) {
                        $idmedio_transporte = $array_medio_transporte_ida[$i];

                        if( $idmedio_transporte != '000' ) { // <---- Esto evita que agrege el valor del checkbox 'Otro'.
                            $array_idmedio_transporte[] = $idmedio_transporte;
                        }

                    }

                    // ---------------------------- Insertando en la tabla 'visitasocial_mediotrans_ida' ---------------------------- //
                    for ( $j=0; $j< count($array_idmedio_transporte); $j++ ) {

                        $idmedio_transporte = $array_idmedio_transporte[$j];

                        // ----------- Tabla 'visitasocial_mediotrans_ida' ----------- //
                        // INSERT:
                        $query = $link->query("INSERT INTO visitasocial_mediotrans_ida (
                            idudc_visita_social,
                            idmedio_transporte
                            ) VALUES (
                              '".utf8_decode($idudc_visita_social)."',
                              '".utf8_decode($idmedio_transporte)."'
                        )");

                    }

                    if( $query ) {
                      $status_query = true;
                    } else {
                      $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'visitasocial_mediotrans_ida')...
                    } 

                } else {
                    $status_query = false;
                    $respuesta = $link->error; // Error al ejecutar DELETE (tabla 'visitasocial_mediotrans_ida')...                    
                }            

            } else {
                $status_query = true;
            }

            // ------------------- DROGAS CONSUMIDAS ------------------- //
            if( isset( $datos['array_drogas_consumidas_jugador'] )  ) {

                // ----------- DELETE a Tabla 'visitasocial_droga_consumidajug' ----------- //
                $query = $link->query("DELETE FROM visitasocial_droga_consumidajug WHERE idudc_visita_social = ".$idudc_visita_social."");

                if( $query ) {

                    $array_drogas_consumidas_jugador = $datos['array_drogas_consumidas_jugador'];

                    $array_id_drogas = [];

                    for ( $i=0; $i < count($array_drogas_consumidas_jugador); $i++ ) {
                        $iddroga = $array_drogas_consumidas_jugador[$i];

                        if( $iddroga != '000' ) { // <---- Esto evita que agrege el valor del checkbox 'Otro'.
                            $array_id_drogas[] = $iddroga;
                        }

                    }

                    // ---------------------------- Insertando en la tabla 'visitasocial_droga_consumidajug' ---------------------------- //
                    for ( $j=0; $j< count($array_id_drogas); $j++ ) {

                        $iddroga = $array_id_drogas[$j];

                        // ----------- Tabla 'visitasocial_droga_consumidajug' ----------- //
                        // INSERT:
                        $query = $link->query("INSERT INTO visitasocial_droga_consumidajug (
                            idudc_visita_social,
                            iddroga
                            ) VALUES (
                              '".utf8_decode($idudc_visita_social)."',
                              '".utf8_decode($iddroga)."'
                        )");

                    }

                    if( $query ) {
                      $status_query = true;
                    } else {
                      $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'visitasocial_droga_consumidajug')...
                    }

                } else {
                    $status_query = false;
                    $respuesta = $link->error; // Error al ejecutar DELETE (tabla 'visitasocial_droga_consumidajug')...                    
                }                  

            } else {
                $status_query = true;
            }

            // ------------------- DROGAS PROBADAS ------------------- //
            if( isset( $datos['array_drogas_probadas_jugador'] )  ) {

                // ----------- DELETE a Tabla 'visitasocial_droga_probadajug' ----------- //
                $query = $link->query("DELETE FROM visitasocial_droga_probadajug WHERE idudc_visita_social = ".$idudc_visita_social."");

                if( $query ) {

                    $array_drogas_probadas_jugador = $datos['array_drogas_probadas_jugador'];

                    $array_id_drogas = [];

                    for ( $i=0; $i < count($array_drogas_probadas_jugador); $i++ ) {
                        $iddroga = $array_drogas_probadas_jugador[$i];

                        if( $iddroga != '000' ) { // <---- Esto evita que agrege el valor del checkbox 'Otro'.
                            $array_id_drogas[] = $iddroga;
                        }

                    }

                    // ---------------------------- Insertando en la tabla 'visitasocial_droga_probadajug' ---------------------------- //
                    for ( $j=0; $j< count($array_id_drogas); $j++ ) {

                        $iddroga = $array_id_drogas[$j];

                        // ----------- Tabla 'visitasocial_droga_probadajug' ----------- //
                        // INSERT:
                        $query = $link->query("INSERT INTO visitasocial_droga_probadajug (
                            idudc_visita_social,
                            iddroga
                            ) VALUES (
                              '".utf8_decode($idudc_visita_social)."',
                              '".utf8_decode($iddroga)."'
                        )");

                    }

                    if( $query ) {
                      $status_query = true;
                    } else {
                      $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'visitasocial_droga_probadajug')...
                    } 

                } else {
                    $status_query = false;
                    $respuesta = $link->error; // Error al ejecutar DELETE (tabla 'visitasocial_droga_probadajug')...                    
                }               

            } else {
                $status_query = true;
            }

            // ------------------- DROGAS CONSUMIDAS (FAMILIAR) ------------------- //
            if( isset( $datos['array_drogas_consumidas_familiar'] )  ) {

                // ----------- DELETE a Tabla 'visitasocial_droga_consumidafam' ----------- //
                $query = $link->query("DELETE FROM visitasocial_droga_consumidafam WHERE idudc_visita_social = ".$idudc_visita_social."");

                if( $query ) {

                    $array_drogas_consumidas_familiar = $datos['array_drogas_consumidas_familiar'];

                    $array_id_drogas = [];

                    for ( $i=0; $i < count($array_drogas_consumidas_familiar); $i++ ) {
                        $iddroga = $array_drogas_consumidas_familiar[$i];

                        if( $iddroga != '000' ) { // <---- Esto evita que agrege el valor del checkbox 'Otro'.
                            $array_id_drogas[] = $iddroga;
                        }

                    }

                    // ---------------------------- Insertando en la tabla 'visitasocial_droga_consumidafam' ---------------------------- //
                    for ( $j=0; $j< count($array_id_drogas); $j++ ) {

                        $iddroga = $array_id_drogas[$j];

                        // ----------- Tabla 'visitasocial_droga_consumidafam' ----------- //
                        // INSERT:
                        $query = $link->query("INSERT INTO visitasocial_droga_consumidafam (
                            idudc_visita_social,
                            iddroga
                            ) VALUES (
                              '".utf8_decode($idudc_visita_social)."',
                              '".utf8_decode($iddroga)."'
                        )");

                    }

                    if( $query ) {
                      $status_query = true;
                    } else {
                      $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'visitasocial_droga_consumidafam')...
                    }

                } else {
                    $status_query = false;
                    $respuesta = $link->error; // Error al ejecutar DELETE (tabla 'visitasocial_droga_consumidafam')...                    
                }                  

            } else {
                $status_query = true;
            }            

          // -------------------------- FIN DE CONSULTAS UPDATE --------------------------  //

          // Si todo va bien con las consultas UPDATE...
          if( $status_query === true ) {
            $respuesta = 2; // UPDATE ejecutado correctamente.
          } else {
            $respuesta = 'Error al ejecutar sentencias UPDATE...'; // INSERT ejecutado incorrectamente.
          }

        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        } 

    }
    
    $link->close();
    return $respuesta;

}

/* --------------------------------------------- Fin de la función 'guardar_registro_otro' --------------------------------------------- */
function guardar_registro_otro( $datos ) {
    include("conexion.php");
    
    $tabla = '';
    $descripcion = '';

    switch ( $datos['registro'] ) {

        case '1':
        case '2':
            $tabla = 'llegada_ida_club';
            $descripcion = 'descripcion_llegada_ida_club';        
            break;
        // -------------------------- //            

        case '5':
        case '6':
        case '7':
            $tabla = 'droga';
            $descripcion = 'descripcion_droga';           
            break;
        // -------------------------- //            

    }

    // INSERT:
    $query = $link->query("INSERT INTO ".$tabla." (
        ".$descripcion.",
        nombre_usuario_software,
        fecha_software
        ) VALUES (
          '".utf8_decode($datos['input_registro_otro'])."',
          '".utf8_decode($datos['nombre_usuario_software'])."',
          '".getDateTime()."'
    )");

    if( $query )  { 
        return 1;                   
        $link->close();
    } else {
        return $link->error; // Error al ejecutar UPDATE...                    
        $link->close();
    }      
    
}
/* --------------------------------------------- Fin de la función 'guardar_registro_otro' --------------------------------------------- */

function eliminar($id){
    include("conexion.php");
    $query = $link->query("DELETE FROM udc_visita_social WHERE idudc_visita_social = ".$id." ");
    if( $query )  { 
        return 1;                   
        $link->close();
    } else {
        return $link->error; // Error al ejecutar UPDATE...                    
        $link->close();
    }      
    
}

/* --------------------------------------------- Inicio de la función 'buscar_datosPDF' --------------------------------------------- */
function buscar_datosPDF($id){
    include("conexion.php");

    $dato = [];

    $idudc_visita_social = $_POST['idudc_visita_social'];
    
    $resultado = $link->query("
        SELECT * FROM udc_visita_social  
        LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = udc_visita_social.idfichaJugador
        WHERE udc_visita_social.idfichaJugador = ".$idudc_visita_social." 
    ");

     while($row = mysqli_fetch_array($resultado)){ 

        // --------------------- Seleccionando la comuna del jugador en la tabla 'udc_visita_social' --------------------- //
        $resultado_comuna_visitasocial = $link->query("
          SELECT  
          comuna AS comuna_visita_social
          FROM udc_visita_social
          WHERE idudc_visita_social = ".$idudc_visita_social."
        ");

        while($row_comuna_visitasocial = mysqli_fetch_assoc($resultado_comuna_visitasocial)) {
            $row['comuna_visita_social'] = $row_comuna_visitasocial['comuna_visita_social'];
        }                 
        
        // --------------------- Tabla 'persona_domicilio_jugador' --------------------- //
        $resultado_2 = $link->query("
          SELECT * FROM persona_domicilio_jugador
          LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = persona_domicilio_jugador.idudc_visita_social
          WHERE persona_domicilio_jugador.idudc_visita_social = ".$idudc_visita_social."
        ");

        $array_persona_domicilio_jugador = [];
        while($row_2 = mysqli_fetch_assoc($resultado_2)) {
            $array_persona_domicilio_jugador[] = $row_2;
        } 

        // --------------------- Tabla 'hijo_jugador' --------------------- //
        $resultado_3 = $link->query("
          SELECT * FROM hijo_jugador
          LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = hijo_jugador.idudc_visita_social
          WHERE hijo_jugador.idudc_visita_social = ".$idudc_visita_social."
        ");

        $array_hijo_jugador = [];
        while($row_3 = mysqli_fetch_assoc($resultado_3)) {
            $array_hijo_jugador[] = $row_3;
        } 

        // --------------------- Tabla 'visitasocial_llegada_club' --------------------- //
        $resultado_4 = $link->query("
          SELECT 
          llegada_ida_club.idllegada_ida_club,
          llegada_ida_club.descripcion_llegada_ida_club
          FROM visitasocial_llegada_club
          LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_llegada_club.idudc_visita_social
          LEFT JOIN llegada_ida_club ON llegada_ida_club.idllegada_ida_club = visitasocial_llegada_club.idllegada_ida_club
          WHERE visitasocial_llegada_club.idudc_visita_social = ".$idudc_visita_social."
        ");

        $array_visitasocial_llegada_club = [];
        while($row_4 = mysqli_fetch_assoc($resultado_4)) {
            $array_visitasocial_llegada_club[] = $row_4;
        } 

        // --------------------- Tabla 'visitasocial_ida_club' --------------------- //
        $resultado_5 = $link->query("
          SELECT 
          llegada_ida_club.idllegada_ida_club,
          llegada_ida_club.descripcion_llegada_ida_club
          FROM visitasocial_ida_club
          LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_ida_club.idudc_visita_social
          LEFT JOIN llegada_ida_club ON llegada_ida_club.idllegada_ida_club = visitasocial_ida_club.idllegada_ida_club
          WHERE visitasocial_ida_club.idudc_visita_social = ".$idudc_visita_social."
        ");

        $array_visitasocial_ida_club = [];
        while($row_5 = mysqli_fetch_assoc($resultado_5)) {
            $array_visitasocial_ida_club[] = $row_5;
        }

        // --------------------- Tabla 'visitasocial_mediotrans_llegada' --------------------- //
        $resultado_6 = $link->query("
          SELECT 
          medio_transporte.idmedio_transporte,
          medio_transporte.descripcion_medio_transporte
          FROM visitasocial_mediotrans_llegada
          LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_mediotrans_llegada.idudc_visita_social
          LEFT JOIN medio_transporte ON medio_transporte.idmedio_transporte = visitasocial_mediotrans_llegada.idmedio_transporte 
          WHERE visitasocial_mediotrans_llegada.idudc_visita_social = ".$idudc_visita_social."
        ");

        $array_visitasocial_mediotrans_llegada = [];
        while($row_6 = mysqli_fetch_assoc($resultado_6)) {
            $array_visitasocial_mediotrans_llegada[] = $row_6;
        }

        // --------------------- Tabla 'visitasocial_mediotrans_ida' --------------------- //
        $resultado_7 = $link->query("
          SELECT  
          medio_transporte.idmedio_transporte,
          medio_transporte.descripcion_medio_transporte
          FROM visitasocial_mediotrans_ida
          LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_mediotrans_ida.idudc_visita_social
          LEFT JOIN medio_transporte ON medio_transporte.idmedio_transporte = visitasocial_mediotrans_ida.idmedio_transporte 
          WHERE visitasocial_mediotrans_ida.idudc_visita_social = ".$idudc_visita_social."
        ");

        $array_visitasocial_mediotrans_ida = [];
        while($row_7 = mysqli_fetch_assoc($resultado_7)) {
            $array_visitasocial_mediotrans_ida[] = $row_7;
        }

        // --------------------- Tabla 'visitasocial_droga_consumidajug' --------------------- //
        $resultado_8 = $link->query("
          SELECT * FROM visitasocial_droga_consumidajug
          LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_droga_consumidajug.idudc_visita_social
          WHERE visitasocial_droga_consumidajug.idudc_visita_social = ".$idudc_visita_social."
        ");

        $array_visitasocial_droga_consumidajug = [];
        while($row_8 = mysqli_fetch_assoc($resultado_8)) {
            $array_visitasocial_droga_consumidajug[] = $row_8;
        }

        // --------------------- Tabla 'visitasocial_droga_probadajug' --------------------- //
        $resultado_9 = $link->query("
          SELECT  
          droga.iddroga,
          droga.descripcion_droga
          FROM visitasocial_droga_probadajug
          LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_droga_probadajug.idudc_visita_social
          LEFT JOIN droga ON droga.iddroga = visitasocial_droga_probadajug.iddroga
          WHERE visitasocial_droga_probadajug.idudc_visita_social = ".$idudc_visita_social."
        ");

        $array_visitasocial_droga_probadajug = [];
        while($row_9 = mysqli_fetch_assoc($resultado_9)) {
            $array_visitasocial_droga_probadajug[] = $row_9;
        }                       

        // --------------------- Tabla 'visitasocial_droga_consumidafam' --------------------- //
        $resultado_10 = $link->query("
          SELECT * FROM visitasocial_droga_consumidafam
          LEFT JOIN udc_visita_social ON udc_visita_social.idudc_visita_social = visitasocial_droga_consumidafam.idudc_visita_social
          WHERE visitasocial_droga_consumidafam.idudc_visita_social = ".$idudc_visita_social."
        ");

        $array_visitasocial_droga_consumidafam = [];
        while($row_10 = mysqli_fetch_assoc($resultado_10)) {
            $array_visitasocial_droga_consumidafam[] = $row_10;
        }

        // Consultando posiciones:
        $resultado_11 = $link->query("
        SELECT 
        posicionCancha.posicion,
        posicionCancha.numero_posicion
        FROM fichaJugador        
        -- Datos de la posición:
        LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
        WHERE posicionCancha.idfichaJugador = ".$idfichaJugador."        
        ");

        while($row_11 = mysqli_fetch_assoc($resultado_11)) {  
            $posicion = $row_11['posicion'];
            $numero_posicion = $row_11['numero_posicion']; 
            $row['posicion'.$numero_posicion] = $posicion;                                        
        }                  

        $row['array_persona_domicilio_jugador'] = $array_persona_domicilio_jugador;
        $row['array_hijo_jugador'] = $array_hijo_jugador;
        $row['array_visitasocial_llegada_club'] = $array_visitasocial_llegada_club;
        $row['array_visitasocial_ida_club'] = $array_visitasocial_ida_club;
        $row['array_visitasocial_mediotrans_llegada'] = $array_visitasocial_mediotrans_llegada;
        $row['array_visitasocial_mediotrans_ida'] = $array_visitasocial_mediotrans_ida;
        $row['array_visitasocial_droga_consumidajug'] = $array_visitasocial_droga_consumidajug;
        $row['array_visitasocial_droga_probadajug'] = $array_visitasocial_droga_probadajug;
        $row['array_visitasocial_droga_consumidafam'] = $array_visitasocial_droga_consumidafam;
                           
        $dato[] = utf8_converter( $row );

    }
    
    // var_dump( $dato );
    unset($row);


    $link->close();
    return $dato;
    
}
/* --------------------------------------------- Fin de la función 'buscar_datosPDF' --------------------------------------------- */

?>