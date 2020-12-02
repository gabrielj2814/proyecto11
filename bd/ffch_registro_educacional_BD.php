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

function ver_posicion_jug () {
    $dato = [
        ['', 'Arqueros', 'Defensas', 'Mediocampistas', 'Delanteros'],
        ['',
            'Arquero',
            //////////////////////////////
            'Defensor Central',
            'Lateral Izquierdo',
            'Lateral Derecho',
            //////////////////////////////
            'Volante Defensivo',
            'Volante Izquierdo',
            'Volante Derecho',
            'Volante Mixto',
            'Volante Ofensivo',
            //////////////////////////////
            'Extremo Izquierdo',
            'Extremo Derecho',
            'Delantero Centro',
        ],
        ['Arqueros', 'Defensas', 'Mediocampistas', 'Delanteros'],
        [
            'Arquero',
            //////////////////////////////
            'Defensor Central',
            'Lateral Izquierdo',
            'Lateral Derecho',
            //////////////////////////////
            'Volante Defensivo',
            'Volante Izquierdo',
            'Volante Derecho',
            'Volante Mixto',
            'Volante Ofensivo',
            //////////////////////////////
            'Extremo Izquierdo',
            'Extremo Derecho',
            'Delantero Centro',
        ],
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

// Número de informes por serie:
function informes_por_serie( $serie ){
    include("conexion.php");
    
    $dato = 0;
    $con    = t_serie($serie);
    $serie  = $con[0];
    $sexo   = $con[1];
    
    $resultado = $link->query("
        SELECT informe_ayuda_social.idinforme_ayuda_social FROM informe_ayuda_social
        LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_ayuda_social.idfichaJugador
        WHERE fichaJugador.sexo = '".$sexo."' AND fichaJugador.serieActual = '".$serie."'          
    ");
    
    $array_idinforme_ayuda_social = [];
    while($row = mysqli_fetch_assoc($resultado)) {
        $array_idinforme_ayuda_social[] =  $row["idinforme_ayuda_social"];
    }        

    $cantidad_informes = count( $array_idinforme_ayuda_social );
    $dato = $cantidad_informes;
    
    $link->close();
    return $dato;         
}
/* ---------------- Ver datos ----------------- */
function ver_datos( $datos ){
    include("conexion.php");
    
    $dato = [];

    $tipo_consulta = $datos['tipo_consulta'];
    
    switch( $tipo_consulta ) {

        // ------------------------------------ CANTIDAD DE INFORMES DE AYUDAS SOCIALES POR SEXO Y SERIE  ------------------------------------ // 
        case 'cantidad_informes_sexo_serie':

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
                    SELECT informe_ayuda_social.idinforme_ayuda_social 
                    FROM informe_ayuda_social 
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_ayuda_social.idfichaJugador 
                    WHERE fichaJugador.sexo = ".$array_sexo[$i_1]." AND fichaJugador.serieActual = ".$array_numero_serie[$i_2]."
                ");
                
                $array_idinforme_ayuda_social = [];
                while($row = mysqli_fetch_assoc($resultado)) {
                    $array_idinforme_ayuda_social[] =  $row["idinforme_ayuda_social"];
                }        

                $cantidad_informes = count( $array_idinforme_ayuda_social );

                $row['cantidad_informes'] = $cantidad_informes;
                $dato[] =  $row;

            }
            break; 

        // ------------------------------------ JUGADORES QUE HAN RECIBIDO AYUDA SOCIAL FILTRADO POR SEXO Y SERIE  ------------------------------------ //
        case 'get_jug_ultima_ayudasocial_sexoserie':
            $string = $datos['string'];
            $sexo = $datos['sexo']; 
            $numero_serie = $datos['numero_serie'];
            
            $estado_re_filtro_busqueda = intval( $datos['estado_re_filtro_busqueda'] );
            $promedio_min_nota_re_fb = floatval( $datos['promedio_min_nota_re_fb'] );
            $promedio_max_nota_re_fb = floatval( $datos['promedio_max_nota_re_fb'] );            

            if( $estado_re_filtro_busqueda === 0 ) {
                $estado_re_filtro_busqueda = "1 = 1";
            } else {
                $estado_re_filtro_busqueda = "ffch_registro_educacional.estado_re =  ".$estado_re_filtro_busqueda."";
            }

            if( $string=='' ) {

                $resultado = $link->query("
                    SELECT * FROM fichaJugador
                    LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador
                    WHERE fichaJugador.sexo = ".$sexo." 
                    AND fichaJugador.serieActual = ".$numero_serie."
                    AND posicionCancha.numero_posicion = 0                 
                    ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC
                ");

            } else {

                $resultado = $link->query("
                    SELECT * FROM fichaJugador
                    LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
                    WHERE (fichaJugador.nombre LIKE '".$datos['string']."%' OR fichaJugador.apellido1 LIKE '".$datos['string']."%' OR fichaJugador.apellido2 LIKE '".$datos['string']."%')
                    AND fichaJugador.sexo = ".$sexo." 
                    AND fichaJugador.serieActual = ".$numero_serie."
                    AND posicionCancha.numero_posicion = 0             
                    ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC
                ");

            }

            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                
                $idfichaJugador = $row["idfichaJugador"];
                
                // var_dump($idfichaJugador);

                // Consultar último informe de registro educacional:
                $resultado_2 = $link->query("
                    SELECT * FROM ffch_registro_educacional
                    WHERE idfichaJugador = ".$idfichaJugador." 
                    -- Estado:
                    AND ".$estado_re_filtro_busqueda." 
                    -- Promedio de Notas:
                    AND promedio_nota_re BETWEEN ".$promedio_min_nota_re_fb." AND ".$promedio_max_nota_re_fb."                      
                    ORDER BY idffch_registro_educacional DESC
                    LIMIT 1
                ");
                

                /*
                $resultado_2 = $link->query("
                    SELECT * FROM ffch_registro_educacional
                    WHERE idfichaJugador = ".$idfichaJugador."                     
                    ORDER BY idffch_registro_educacional DESC
                    LIMIT 1
                ");
                */

                while($row2 = mysqli_fetch_assoc($resultado_2)) {
                    // Datos de la tabla 'informe_ayuda_social':
                    $row['idffch_registro_educacional'] = $row2['idffch_registro_educacional'];
                    $row['estado_re'] = $row2['estado_re'];
                    $row['motivo_noestudiando_re'] = $row2['motivo_noestudiando_re'];
                    $row['nivel_educ_egreso_re'] = $row2['nivel_educ_egreso_re'];
                    $row['nivel_educ_re'] = $row2['nivel_educ_re'];
                    $row['colegio_re'] = $row2['colegio_re'];
                    $row['curso_re'] = $row2['curso_re'];
                    $row['jornada_re'] = $row2['jornada_re'];
                    $row['horario_inicio_re'] = $row2['horario_inicio_re'];
                    $row['horario_fin_re'] = $row2['horario_fin_re'];
                }

                // Consultando posiciones:
                $resultado_5 = $link->query("
                SELECT 
                posicionCancha.posicion,
                posicionCancha.numero_posicion
                FROM fichaJugador        
                -- Datos de la posición:
                LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
                WHERE posicionCancha.idfichaJugador = ".$idfichaJugador."        
                ");

                while($row_5 = mysqli_fetch_assoc($resultado_5)) {  
                    $posicion = $row_5['posicion'];
                    $numero_posicion = $row_5['numero_posicion']; 
                    $row['posicion'.$numero_posicion] = $posicion;                                        
                }   

                $dato[] = utf8_converter( $row );
            }
            break;
        
        // ------------------------------------ CARGAR GRÁFICAS  ------------------------------------ //
        case 'cargar_graficas':
            
            $sexo = intval( $datos['sexo'] ); 
            $numero_serie = intval( $datos['numero_serie'] );
            $anio = intval( $datos['anio'] );
            
            // ---------------------- Montos entregados en ayuda social ---------------------- //
            $array_meses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];
            $array_montos_mes = [];
            $array_montos_mes_suma = [];
            for ($i=0; $i < count( $array_meses ); $i++) {

                $mes = $array_meses[$i];                                        

                $resultado_1 = $link->query("
                    SELECT monto_ayuda_social FROM informe_ayuda_social
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_ayuda_social.idfichaJugador
                    WHERE fichaJugador.sexo = ".$sexo." 
                    AND fichaJugador.serieActual = ".$numero_serie."                
                    AND MONTH(informe_ayuda_social.fecha_ayuda_social) = ".$mes." AND YEAR(informe_ayuda_social.fecha_ayuda_social) =  ".$anio."
                ");

                while($row_1 = mysqli_fetch_assoc($resultado_1)) {
                    $array_montos_mes[] = intval( $row_1['monto_ayuda_social'] );
                } 

                $monto_total_mes = array_sum( $array_montos_mes );                                
                $array_montos_mes_suma[] = $monto_total_mes;                                         
                $array_montos_mes = ['']; // <---- Vaciando array.

            }

            // ---------------------- Club de origen de los jugadoresque han recibido ayuda social ---------------------- //
            $resultado_2 = $link->query("
                SELECT DISTINCT informe_ayuda_social.idfichaJugador FROM informe_ayuda_social
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_ayuda_social.idfichaJugador
                WHERE fichaJugador.sexo = ".$sexo." 
                AND fichaJugador.serieActual = ".$numero_serie."                 
            ");

            
            $array_idclub_origen = [];
            $array_club_origen = [];            
            while($row_2 = mysqli_fetch_assoc($resultado_2)) {
                
                $idfichaJugador = $row_2['idfichaJugador'];

                $resultado_3 = $link->query("
                    SELECT
                    club.idclub,
                    club.nombre_club 
                    FROM fichaJugador
                    -- Datos del jugador:
                    LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador = fichaJugador.idfichaJugador               
                    -- Datos de la posición:
                    LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador
                    -- Datos del club:
                    LEFT JOIN club ON club.idclub = fichaJugador_club.idclub 
                    WHERE fichaJugador.idfichaJugador = ".$idfichaJugador."
                    AND posicionCancha.numero_posicion = 0 
                ");                
                
                while($row_3 = mysqli_fetch_assoc($resultado_3)) {
                    $array_idclub_origen[] = $row_3['idclub'];
                    $array_club_origen[] = $row_3['nombre_club'];
                }

                
                $array_idclub_origen = array_unique($array_idclub_origen);
                $array_club_origen = array_unique($array_club_origen);
                

            }             


            // Cantidad de jugadores (por club) que han recibido ayuda:
            $array_cantidad_jugadores_total_club = [];
            $array_cantidad_jugadores_x_club = []; 
            for ($i=0; $i<count($array_idclub_origen); $i++) { 
                    
                $idclub = $array_idclub_origen[$i]; 

                $resultado = $link->query("
                    SELECT DISTINCT informe_ayuda_social.idfichaJugador FROM informe_ayuda_social
                    -- Datos del jugador:
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_ayuda_social.idfichaJugador
                    -- Datos del jugador y el club:
                    LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador = fichaJugador.idfichaJugador                      
                    WHERE fichaJugador.sexo = ".$sexo." 
                    AND fichaJugador.serieActual = ".$numero_serie."     
                    AND fichaJugador_club.idclub = ".$idclub."
                ");

                while($row = mysqli_fetch_assoc($resultado)) {
                    $array_cantidad_jugadores_x_club[] = $row['idfichaJugador'];
                } 

                $array_cantidad_jugadores_total_club[] = count( $array_cantidad_jugadores_x_club );

            }            

            // var_dump($array_cantidad_jugadores_total_club);

            // ---------------------- Montos entregados en ayuda social por jugador ---------------------- //
            $resultado_4 = $link->query("
                SELECT DISTINCT informe_ayuda_social.idfichaJugador FROM informe_ayuda_social
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_ayuda_social.idfichaJugador
                WHERE fichaJugador.sexo = ".$sexo." 
                AND fichaJugador.serieActual = ".$numero_serie."                 
            ");


            $array_nombre_jugador = [];
            $array_montos_jugador = [];
            $array_montos_jugador_suma = [];
            while($row_4 = mysqli_fetch_assoc($resultado_4)) {

                $idfichaJugador = $row_4['idfichaJugador'];

                // Nombre del jugador:
                $resultado_5_0 = $link->query("
                    SELECT * FROM fichaJugador 
                    WHERE idfichaJugador = ".$idfichaJugador."
                ");

                while($row_5_0 = mysqli_fetch_assoc($resultado_5_0)) {
                    $array_nombre_jugador[] = $row_5_0['nombre'] . ' ' . $row_5_0['apellido1'] . ' ' . $row_5_0['apellido2'];
                } 


                // Montos del jugador:
                $resultado_5 = $link->query("
                    SELECT monto_ayuda_social FROM informe_ayuda_social
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_ayuda_social.idfichaJugador
                    WHERE fichaJugador.idfichaJugador = ".$idfichaJugador."
                ");

                while($row_5 = mysqli_fetch_assoc($resultado_5)) {
                    $array_montos_jugador[] = intval( $row_5['monto_ayuda_social'] );
                } 

                $monto_total_jugador = array_sum( $array_montos_jugador );                                
                $array_montos_jugador_suma[] = $monto_total_jugador;                                         
                $array_montos_jugador = ['']; // <---- Vaciando array.

            }

            // ---------------------- Monto entregado según club de origen deljugador ---------------------- //
            $array_nombre_club = [];
            $array_montos_club = [];
            $array_montos_club_suma = [];            
            for ($i=0; $i<count($array_idclub_origen); $i++) { 
                    
                $idclub = $array_idclub_origen[$i]; 

                // Nombre del jugador:
                $resultado_6_0 = $link->query("
                    SELECT * FROM club 
                    WHERE idclub = ".$idclub."
                ");

                while($row_6_0 = mysqli_fetch_assoc($resultado_6_0)) {
                    $array_nombre_club[] = $row_6_0['nombre_club'];
                } 

                $resultado_6 = $link->query("
                    SELECT monto_ayuda_social FROM informe_ayuda_social
                    -- Datos del jugador:
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_ayuda_social.idfichaJugador
                    -- Datos del jugador y el club:
                    LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador = fichaJugador.idfichaJugador                      
                    WHERE fichaJugador_club.idclub = ".$idclub."
                ");

                while($row_6 = mysqli_fetch_assoc($resultado_6)) {
                    $array_montos_club[] = intval( $row_6['monto_ayuda_social'] );
                } 

                $monto_total_club = array_sum( $array_montos_club );                                
                $array_montos_club_suma[] = $monto_total_club;                                         
                $array_montos_club = ['']; // <---- Vaciando array.

            }

            // ------------------------------- Enviando resultados al cliente ------------------------------- // 
            // Montos entregados en ayuda social:
            $dato[] = utf8_converter( $array_montos_mes_suma );
            
            // Club de origen de los jugadoresque han recibido ayuda social:
            $dato[] = utf8_converter( $array_club_origen );
            // Cantidad de jugadores (por club) que han recibido ayuda:
            $dato[] = utf8_converter( $array_cantidad_jugadores_total_club );
            
            // Nombres de los jugadores que han recibido ayuda:
            $dato[] = utf8_converter( $array_nombre_jugador );
            // Montos entregados en ayuda social por jugador:
            $dato[] = utf8_converter( $array_montos_jugador_suma );
            
            // Nombre de los clubes con respecto al monto entregado según club de origen del jugador:
            $dato[] = utf8_converter( $array_nombre_club );
            // Monto entregado según club de origen del jugador:
            $dato[] = utf8_converter( $array_montos_club_suma );

            break;            

        // ------------------------------------ REGISTRO EDUCACIONAL ACTUAL DE UN DETERMINADO JUGADOR  ------------------------------------ // 
        case 'get_re_actual_jugador':

            $idfichaJugador = $datos["idfichaJugador"];
            $idffch_registro_educacional = $datos["idffch_registro_educacional"];

            $resultado = $link->query("
                SELECT * FROM ffch_registro_educacional 
                WHERE idfichaJugador = ".$idfichaJugador."
                AND idffch_registro_educacional = ".$idffch_registro_educacional."
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break; 

        // ------------------------------------ TODOS LOS REGISTROS EDUCACIONALES DE UN DETERMINADO JUGADOR  ------------------------------------ // 
        case 'get_re_todos_jugador':

            $idfichaJugador = $datos["idfichaJugador"];

            $resultado = $link->query("
                SELECT * FROM ffch_registro_educacional 
                WHERE idfichaJugador = ".$idfichaJugador."
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break;          


        // ------------------------------------ AYUDAS SOCIALES DE UN DETERINADO JUGADOR  ------------------------------------ //
        case 'buscar_ayudas_sociales_jugador':

            $idfichaJugador = $datos['idfichaJugador'];

            $resultado = $link->query("
                SELECT * FROM informe_ayuda_social 
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_ayuda_social.idfichaJugador 
                WHERE informe_ayuda_social.idfichaJugador = ".$idfichaJugador."
            ");

            while($row = mysqli_fetch_assoc($resultado)) {

                $idinforme_ayuda_social = $row['idinforme_ayuda_social'];

                $resultado_2 = $link->query("
                    SELECT * FROM detalle_informe_ayuda_social
                    LEFT JOIN tipo_ayuda_social ON tipo_ayuda_social.idtipo_ayuda_social = detalle_informe_ayuda_social.idtipo_ayuda_social
                    WHERE detalle_informe_ayuda_social.idinforme_ayuda_social = ".$idinforme_ayuda_social."
                ");

                $array_id_tipos_ayuda = [];
                $array_tipos_ayuda = [];
                
                while($row_2 = mysqli_fetch_assoc($resultado_2)) {
                    $array_id_tipos_ayuda[] = $row_2['idtipo_ayuda_social'];
                    $array_tipos_ayuda[] = $row_2['descripcion_tipo_ayuda_social'];
                }

                $row['array_id_tipos_ayuda'] = $array_id_tipos_ayuda;
                $row['array_tipos_ayuda'] = $array_tipos_ayuda;

                $dato[] = utf8_converter( $row );
            } 

            break; 

        // ------------------------------------ TODOS LOS CAMPEONATOS  ------------------------------------ // 
        case 'get_all_campeonatos':
            $resultado = $link->query("
                SELECT * FROM campeonato ORDER BY nombre_campeonato ASC
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break; 

        // ------------------------------------ TODOS LOS CLUBES  ------------------------------------ // 
        case 'get_all_clubes':
            $resultado = $link->query("
                SELECT * FROM club ORDER BY nombre_club ASC
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break; 

        // ------------------------------------ TODOS LOS TIPOS DE AYUDA SOCIAL  ------------------------------------ // 
        case 'get_tipos_ayuda_social':
            $resultado = $link->query("
                SELECT * FROM tipo_ayuda_social
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break;     

        // ------------------------------------ CONSULTANDO EL ÚLTIMO TIPO DE AYUDA SOCIAL  ------------------------------------ // 
        case 'get_ultimo_tipo_ayuda_social':
            $resultado = $link->query("
                SELECT * FROM tipo_ayuda_social
                ORDER BY idtipo_ayuda_social DESC
                LIMIT 1                
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break;                         

        // ------------------------------------ CANTIDAD DE REGISTROS PARA LA VISTA PRINCIPAL ------------------------------------ // 
        case '0':
            $array_tipo_cuadro = $datos['array_tipo_cuadro'];
            $array_tipo_pais = $datos['array_tipo_pais'];
            $array_pais_club = $datos['array_pais_club'];
            $array_jugador_entrenador = $datos['array_jugador_entrenador'];            

            for( $i = 0; $i < count( $array_tipo_cuadro ); $i++ ) {

                // Convirtiendo valores de tipo 'string' a números enteros:
                $tipo_cuadro = intval( $array_tipo_cuadro[$i] );
                $tipo_pais = intval( $array_tipo_pais[$i] );
                $pais_club = $array_pais_club[$i];
                $jugador_entrenador = intval( $array_jugador_entrenador[$i] );

                // var_dump($pais_club);

                // Consultando según el tipo de cuadro:
                switch ( $tipo_cuadro ) {
                    
                    // ------- Cantidad de jugadores que pertecen a clubes de países mostrados en el cuadro principal ------- //
                    case 1:
                        $resultado = $link->query("
                            SELECT COUNT(fichaJugador_club.idfichaJugador_club) FROM fichaJugador_club
                            -- Datos del jugador:
                            LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador
                            -- Datos del club:
                            LEFT JOIN club ON club.idclub = fichaJugador_club.idclub 
                            WHERE club.pais_club = '".$pais_club."'
                            AND club.tipo_pais_club = 1
                            AND fichaJugador_club.estado_jugadorclub = 2
                        ");
                        while($row = mysqli_fetch_assoc($resultado)) {
                            $dato[] =  $row["COUNT(fichaJugador_club.idfichaJugador_club)"];
                        }                
                        break;

                    // ------- Cantidad de jugadores que pertecen a clubes de otros países ------- //
                    case 2:
                        $resultado = $link->query("
                            SELECT COUNT(fichaJugador_club.idfichaJugador_club) FROM fichaJugador_club
                            -- Datos del jugador:
                            LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador
                            -- Datos del club:
                            LEFT JOIN club ON club.idclub = fichaJugador_club.idclub 
                            WHERE club.tipo_pais_club = 2
                            AND fichaJugador_club.estado_jugadorclub = 2
                        ");
                        while($row = mysqli_fetch_assoc($resultado)) {
                            $dato[] =  $row["COUNT(fichaJugador_club.idfichaJugador_club)"];
                        }                   
                        break;

                    // ------- Cantidad de jugadores y entrenadores (independientemente de donde jueguen/entrenen)------- //
                    case 3:
                        $resultado = $link->query("
                            SELECT COUNT(fichaJugador_club.idfichaJugador_club) FROM fichaJugador_club
                            -- Datos del jugador:
                            LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador
                            -- Datos del club:
                            LEFT JOIN club ON club.idclub = fichaJugador_club.idclub 
                        ");
                        while($row = mysqli_fetch_assoc($resultado)) {
                            $dato[] =  $row["COUNT(fichaJugador_club.idfichaJugador_club)"];
                        }                  
                        break;                                                
                    

                }
                                

            }
            break;

        // ------------------------------------ CLUBES SEGÚN EL PAÍS SELECCIONADO (PAÍSES MOSTRADOS EN LA VISTA PRINCIPAL) ------------------------------------ // 
        case '1':
            $tipo_pais = $datos['tipo_pais'];
            $pais_club = $datos['pais_club'];
            $division_club = $datos['division_club'];

            $tipo_pais = intval( $tipo_pais );
            // $pais_club = intval( $pais_club );
            $division_club = intval( $division_club );

            // 0 = Todos
            $f_division_club = '';
            if( $division_club === 0 ) {
                $f_division_club = "1 = 1";
            } else {
                $f_division_club = "division_club = ".$division_club."";
            }  

            // ------- DATOS DEL CLUB ------- //
            $resultado = $link->query("
                SELECT * FROM club 
                WHERE pais_club = '".$pais_club."' 
                AND tipo_pais_club = ".$tipo_pais."
                AND ".$f_division_club." 
            ");
            while($row = mysqli_fetch_assoc($resultado)) {

                $idclub = $row["idclub"];

                // Calculando cantidad total de jugadores (QUE ACTUALMENTE PERTENECEN A UN CLUB):
                $resultado_2 = $link->query("
                    SELECT COUNT(fichaJugador_club.idfichaJugador_club) FROM fichaJugador_club
                    -- Datos del jugador:
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador
                    -- Datos del club:
                    LEFT JOIN club ON club.idclub = fichaJugador_club.idclub 
                    WHERE club.idclub = ".$idclub."
                    AND club.pais_club = '".$pais_club."' 
                    AND club.tipo_pais_club = ".$tipo_pais."
                    AND fichaJugador_club.estado_jugadorclub = 2
                ");

                $array_cantidad_jugadores = [];
                while($row_2 = mysqli_fetch_assoc($resultado_2)) {
                    $array_cantidad_jugadores[] = intval( $row_2["COUNT(fichaJugador_club.idfichaJugador_club)"] );
                }

                // Calculando la fecha de los jugadores:
                $resultado_3 = $link->query("
                    SELECT fichaJugador.fechaNacimiento FROM fichaJugador_club
                    -- Datos del jugador:
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador
                    -- Datos del club:
                    LEFT JOIN club ON club.idclub = fichaJugador_club.idclub 
                    WHERE club.idclub = ".$idclub."
                    AND club.pais_club = '".$pais_club."' 
                    AND club.tipo_pais_club = ".$tipo_pais."                    
                ");

                $acumulador = 0;
                while($row_3 = mysqli_fetch_assoc($resultado_3)) {
                    $edad = calcularEdad( $row_3["fechaNacimiento"] );
                    $acumulador = $acumulador + $edad;
                }                  

                $array_promedio_edad = [];
                for ($i=0; $i <count($array_cantidad_jugadores); $i++) {

                    $cantidad_jugadores = $array_cantidad_jugadores[$i];
                    
                    if( $cantidad_jugadores === 0 ) {
                        $array_promedio_edad[] = 0;
                    } else {
                        $media_edad = $acumulador / $cantidad_jugadores;
                        // $media_edad = floor(($media_edad*1000))/1000;
                        $media_edad = floor(($media_edad*10))/10;
                        $array_promedio_edad[] = $media_edad;                        
                    }

                }

                $row['cantidad_total_jugadores'] = $array_cantidad_jugadores;
                $row['media_edad'] = $array_promedio_edad;

                $dato[] = utf8_converter( $row );

            }                            
            break;

        // ------------------------------------ EDAD Y ALTURA MÍNIMA Y MÁXIMA DE TODOS LOS JUGADORES ------------------------------------ // 
        case 'edad_altura_minmax_pozocomun':

            $resultado = $link->query("
                SELECT * FROM fichaJugador
                -- Datos del jugador:
                LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador = fichaJugador.idfichaJugador               
                -- Datos de la posición:
                LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador
                -- Datos del club:
                LEFT JOIN club ON club.idclub = fichaJugador_club.idclub 
                WHERE posicionCancha.numero_posicion = 0
                ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC
            ");

            while($row = mysqli_fetch_assoc($resultado)) {

                $idfichaJugador = $row['idfichaJugador'];

                $resultado_2 = $link->query("
                    SELECT 
                    fichaJugador.fechaNacimiento,
                    fichaJugador.altura 
                    FROM fichaJugador
                    -- Datos del jugador y su club:
                    LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador = fichaJugador.idfichaJugador 
                ");

                $array_edad = [];
                $array_altura = [];
                while($row_2 = mysqli_fetch_assoc($resultado_2)) {
                    // Calculando edad y altura mínima y máxima:    
                    $edad = '';
                    if( $row_2['fechaNacimiento'] == '0000-00-00' || is_null( $row_2['fechaNacimiento'] ) || $row_2['fechaNacimiento'] == '' ) {
                        $edad = 0;
                    } else {
                        $edad = calcularEdad( $row_2['fechaNacimiento'] );
                        if( $edad < 0 ) {
                            $edad = 0;
                        }                        
                    }
                    $array_edad[] = $edad;
                    
                    $altura = '';
                    if( $row_2['altura'] == '' || is_null( $row_2['altura'] ) || $row_2['altura'] == '0' ) {
                        $altura = 0;
                    } else {
                        $altura = $row_2['altura'];
                    }
                    $array_altura[] = intval( $altura );
                }
                
                $min_edad = min($array_edad);
                $max_edad = max($array_edad);

                $min_altura = min($array_altura);
                $max_altura = max($array_altura);            

                $row['min_edad'] = $min_edad;
                $row['max_edad'] = $max_edad;

                $row['min_altura'] = $min_altura;
                $row['max_altura'] = $max_altura;

                // Consultando posiciones:
                $resultado_3 = $link->query("
                SELECT 
                posicionCancha.posicion,
                posicionCancha.numero_posicion
                FROM fichaJugador_club
                -- Datos del jugador:
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador
                -- Datos del club:
                LEFT JOIN club ON club.idclub = fichaJugador_club.idclub                 
                -- Datos de la posición:
                LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
                WHERE posicionCancha.idfichaJugador = ".$idfichaJugador."        
                ");

                while($row_3 = mysqli_fetch_assoc($resultado_3)) {  
                    $posicion = $row_3['posicion'];
                    $numero_posicion = $row_3['numero_posicion']; 
                    $row['posicion'.$numero_posicion] = $posicion;                                        
                }

                $dato[] = utf8_converter( $row );

            }                  

            break;

        // ------------------------------------ EDAD MÍNIMA Y MÁXIMA DE JUGADORES DEL PAÍS SELECCIONADO  ------------------------------------ // 
        case 'edad_minmax_jugadores_club':
            $idclub = $datos['idclub'];

            $idclub = intval( $idclub );

            // ------- DATOS DEL CLUB ------- //
            $resultado = $link->query("
                SELECT * FROM fichaJugador_club
                -- Datos del jugador:
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador                
                -- Datos de las posiciones
                LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador                
                -- Datos del club:                
                LEFT JOIN club ON club.idclub = fichaJugador_club.idclub 
                WHERE club.idclub = ".$idclub." AND fichaJugador_club.estado_jugadorclub = 2
                AND posicionCancha.numero_posicion = 0
                ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC
            ");
            $array_anios = [];
            while($row = mysqli_fetch_assoc($resultado)) {

                $idfichaJugador = $row['idfichaJugador'];
                $idclub = $row["idclub"];

                // Calculando el rango de año de nacimento de los jugadores del club seleccionado:
                $resultado_2 = $link->query("
                    SELECT fichaJugador.fechaNacimiento FROM fichaJugador_club
                    -- Datos del jugador:
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador                 
                    -- Datos del club:
                    LEFT JOIN club ON club.idclub = fichaJugador_club.idclub 
                    WHERE club.idclub = ".$idclub." AND fichaJugador_club.estado_jugadorclub = 2                  
                ");

                $array_anios = [];
                while($row_2 = mysqli_fetch_assoc($resultado_2)) {
                    
                    if( $row_2['fechaNacimiento'] == '0000-00-00' || is_null( $row_2['fechaNacimiento'] ) || $row_2['fechaNacimiento'] == '' ) {
                        $row_2["fechaNacimiento"] = date("Y-m-d");
                    }

                    $anio = substr($row_2["fechaNacimiento"], 0, 4);
                    $anio = intval( $anio );
                    $array_anios[] = $anio;
                }
                
                $min_anio = min($array_anios);
                $max_anio = max($array_anios);

                $row['min_anio'] = $min_anio;
                $row['max_anio'] = $max_anio;

                // Consultando posiciones:
                $resultado_3 = $link->query("
                SELECT 
                posicionCancha.posicion,
                posicionCancha.numero_posicion
                FROM fichaJugador_club
                -- Datos del jugador:
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador
                -- Datos del club:
                LEFT JOIN club ON club.idclub = fichaJugador_club.idclub                 
                -- Datos de la posición:
                LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
                WHERE club.idclub = ".$idclub." AND posicionCancha.idfichaJugador = ".$idfichaJugador."        
                ");
                /*
                Consulta anterior (jugadores en club) -> fichaJugador_club.estado_jugadorclub = 2 <---Eliminado
                WHERE club.idclub = ".$idclub." AND fichaJugador_club.estado_jugadorclub = 2  AND posicionCancha.idfichaJugador = ".$idfichaJugador."        
                ");
                */                

                while($row_3 = mysqli_fetch_assoc($resultado_3)) {  
                    $posicion = $row_3['posicion'];
                    $numero_posicion = $row_3['numero_posicion']; 
                    $row['posicion'.$numero_posicion] = $posicion;                                        
                }

                $dato[] = utf8_converter( $row );

            }                 
            break;  

        // ------------------------------------ CANTIDAD DE REGISTROS SCOUTING DE UN DETERMINADO JUGADOR (Tabla 'cscouting_jugador') ------------------------------------ // 
        case 'get_cantidad_registros_scouting':
            $idfichaJugador_club = $datos['idfichaJugador_club'];

            $resultado = $link->query(" 
                SELECT COUNT(cscouting_jugador.idcscouting_jugador) FROM cscouting_jugador
                -- Datos del jugador-club:
                LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador_club = cscouting_jugador.idfichaJugador_club
                -- Datos del jugador:
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador
                -- Datos de la posición:
                LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador
                -- Datos del club:
                LEFT JOIN club ON club.idclub = fichaJugador_club.idclub 
                WHERE fichaJugador_club.idfichaJugador_club = ".$idfichaJugador_club."
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                            
            break;

        // ------------------------------------ DATOS DE JUGADORES SEGÚN EL CLUB SELECCIONADO  ------------------------------------ // 
        case '2':
            $idclub = $datos['idclub'];
            $posicion_jugador = $datos['posicion_jugador'];
            $nacionalidad_jugador = $datos['nacionalidad_jugador'];
            $range_anio_nac_1 = $datos['range_anio_nac_1'];
            $range_anio_nac_2 = $datos['range_anio_nac_2'];

            $idclub = intval( $idclub );
            $posicion_jugador = intval( $posicion_jugador );
            $nacionalidad_jugador = intval( $nacionalidad_jugador );
            $range_anio_nac_1 = intval( $range_anio_nac_1 );
            $range_anio_nac_2 = intval( $range_anio_nac_2 );

            // Filtro de posición:
            $filtro_posicion_jugador = "";
            // 0 = Todos
            if( $posicion_jugador === 0 ) {
                $filtro_posicion_jugador = "1 = 1 AND posicionCancha.numero_posicion = 0";
            } else {
                $filtro_posicion_jugador = "posicionCancha.posicion = ".$posicion_jugador." AND posicionCancha.numero_posicion = 0";
            }

            // Filtro de nacionalidad1:
            $filtro_nacionalidad_jugador = "";
            // 0 = Todos
            if( $nacionalidad_jugador === 0 ) {
                $filtro_nacionalidad_jugador = "1 = 1";
            } else {
                $filtro_nacionalidad_jugador = "fichaJugador.nacionalidad1 = ".$nacionalidad_jugador."";
            }

            // Filtro de Año de Nacimiento (Mínimo):
            $filtro_min_anio_nac = "";
            // 0 = Nada
            if( $range_anio_nac_1 === 0 ) {
                $filtro_min_anio_nac = 0;
            } else {
                $filtro_min_anio_nac = $range_anio_nac_1;
            }      

            // Filtro de Año de Nacimiento (Mínimo):
            $filtro_max_anio_nac = "";
            // 0 = Nada
            if( $range_anio_nac_2 === 0 ) {
                $filtro_max_anio_nac = 99999999999999999;
            } else {
                $filtro_max_anio_nac = $range_anio_nac_2;
            }                                    

            $resultado = $link->query("
                SELECT * FROM fichaJugador_club
                -- Datos del jugador:
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador               
                -- Datos de la posición:
                LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador
                -- Datos del club:
                LEFT JOIN club ON club.idclub = fichaJugador_club.idclub 
                WHERE club.idclub = ".$idclub."
                AND ".$filtro_posicion_jugador."
                AND ".$filtro_nacionalidad_jugador." 
                AND YEAR(fichaJugador.fechaNacimiento) BETWEEN ".$filtro_min_anio_nac." AND ".$filtro_max_anio_nac." AND fichaJugador_club.estado_jugadorclub = 2
                ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                            
            break; 

        // ------------------------------------ JUGADORES - POZO COMÚN  ------------------------------------ // 
        case 'jugadores_pozo_comun':

            $estadoclub_jugador_pzcomun = $datos['estadoclub_jugador_pzcomun'];
            $nacionalidad_jugador_pzcomun = $datos['nacionalidad_jugador_pzcomun'];
            $paisclub_jugador_pzcomun = $datos['paisclub_jugador_pzcomun'];
            $divisionclub_jugador_pzcomun = $datos['divisionclub_jugador_pzcomun'];
            $club_jugador_pzcomun = $datos['club_jugador_pzcomun'];
            $range_edad_min_pzcomun = $datos['range_edad_min_pzcomun'];
            $range_edad_max_pzcomun = $datos['range_edad_max_pzcomun'];
            $altura_min_pzcomun = $datos['altura_min_pzcomun'];
            $altura_max_pzcomun = $datos['altura_max_pzcomun'];
            $posicion_jugador_pzcomun = $datos['posicion_jugador_pzcomun'];

            $estadoclub_jugador_pzcomun = intval( $estadoclub_jugador_pzcomun );
            // $nacionalidad_jugador_pzcomun = intval( $nacionalidad_jugador_pzcomun );
            // $paisclub_jugador_pzcomun = intval( $paisclub_jugador_pzcomun );
            $divisionclub_jugador_pzcomun = intval( $divisionclub_jugador_pzcomun );
            $club_jugador_pzcomun = intval( $club_jugador_pzcomun );
            $range_edad_min_pzcomun = intval( $range_edad_min_pzcomun );
            $range_edad_max_pzcomun = intval( $range_edad_max_pzcomun );
            $altura_min_pzcomun = intval( $altura_min_pzcomun );
            $altura_max_pzcomun = intval( $altura_max_pzcomun );
            $posicion_jugador_pzcomun = intval( $posicion_jugador_pzcomun );

            // ----------------------- FILTROS ----------------------- //

            // Estado del jugador con respecto a un club:
            $f_estadoclub = "";
            // 0 = Todos
            if( $estadoclub_jugador_pzcomun === 0 ) {
                $f_estadoclub = "1 = 1";
            } else {
                $f_estadoclub = "fichaJugador_club.estado_jugadorclub = ".$estadoclub_jugador_pzcomun."";
            }

            // nacionalidad1:
            $f_nacionalidad = "";
            // 0 = Todos
            if( $nacionalidad_jugador_pzcomun == '0' ) {
                $f_nacionalidad = "1 = 1";
            } else {
                $f_nacionalidad = "fichaJugador.nacionalidad1 = '".$nacionalidad_jugador_pzcomun."'";
            }

            // País:
            $f_paisclub = "";
            // 0 = Todos
            if( $paisclub_jugador_pzcomun == '0' ) {
                $f_paisclub = "1 = 1";
            } else {
                $f_paisclub = "club.pais_club = '".$paisclub_jugador_pzcomun."'";
            }  

            // División:
            $f_divisionclub = "";
            // 0 = Todos
            if( $divisionclub_jugador_pzcomun === 0 ) {
                $f_divisionclub = "1 = 1";
            } else {
                $f_divisionclub = "club.division_club = ".$divisionclub_jugador_pzcomun."";
            }

            // Club:
            $f_club = "";
            // 0 = Todos
            if( $club_jugador_pzcomun === 0 ) {
                $f_club = "1 = 1";
            } else {
                $f_club = "club.idclub = ".$club_jugador_pzcomun."";
            }                           

            // Edad Mínima:
            $f_edadmin = "";
            // 0 = Todos
            if( $range_edad_min_pzcomun === 0 ) {
                $f_edadmin = 0;
            } else {
                $f_edadmin = $range_edad_min_pzcomun;
            }  
               
            // Edad Máxima:
            $f_edadmax = "";
            // 0 = Todos
            if( $range_edad_max_pzcomun === 0 ) {
                $f_edadmax = 99999999999999999;
            } else {
                $f_edadmax = $range_edad_max_pzcomun;
            } 

            // altura Mínima:
            $f_altura_min = "";
            // 0 = Todos
            if( $altura_min_pzcomun === 0 ) {
                $f_altura_min = 0;
            } else {
                $f_altura_min = $altura_min_pzcomun;
            } 

            // altura Máxima:
            $f_altura_max = "";
            // 0 = Todos
            if( $altura_max_pzcomun === 0 ) {
                $f_altura_max = 99999999999999999;
            } else {
                $f_altura_max = $altura_max_pzcomun;
            }                               

            // Posición:
            $f_posicion = "";
            // 0 = Todos
            if( $posicion_jugador_pzcomun === 0 ) {
                $f_posicion = "1 = 1 AND posicionCancha.numero_posicion = 0"; // <--- Posición principal
            } else {
                $f_posicion = "posicionCancha.posicion = ".$posicion_jugador_pzcomun." AND posicionCancha.numero_posicion = 0"; // <--- Posición principal
            }

            $resultado = $link->query("
                SELECT * FROM fichaJugador
                -- Datos del jugador:
                LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador = fichaJugador.idfichaJugador               
                -- Datos de la posición:
                LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador
                -- Datos del club:
                LEFT JOIN club ON club.idclub = fichaJugador_club.idclub 
                -- Estado del jugador con respecto a un club:
                WHERE ".$f_estadoclub."
                -- nacionalidad1:
                AND ".$f_nacionalidad."
                -- País donde juega:
                AND ".$f_paisclub."
                -- División donde juega:
                AND ".$f_divisionclub." 
                -- Club donde juega:
                AND ".$f_club."   
                -- Edad del jugador:
                AND YEAR(CURDATE())-YEAR(fichaJugador.fechaNacimiento) BETWEEN ".$f_edadmin." AND ".$f_edadmax."  
                -- altura del jugador:
                AND fichaJugador.altura BETWEEN ".$f_altura_min." AND ".$f_altura_max."                            
                -- Posición del jugador
                AND ".$f_posicion."
                ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC
            ");            

            
            /*
            $my_query = "
                SELECT * FROM fichaJugador
                -- Datos del jugador:
                LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador = fichaJugador.idfichaJugador               
                -- Datos de la posición:
                LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador
                -- Datos del club:
                LEFT JOIN club ON club.idclub = fichaJugador_club.idclub 
                -- Estado del jugador con respecto a un club:
                WHERE ".$f_estadoclub."
                -- nacionalidad1:
                AND ".$f_nacionalidad."
                -- País donde juega:
                AND ".$f_paisclub."
                -- División donde juega:
                AND ".$f_divisionclub." 
                -- Club donde juega:
                AND ".$f_club."   
                -- Edad del jugador:
                AND YEAR(CURDATE())-YEAR(fichaJugador.fechaNacimiento) BETWEEN ".$f_edadmin." AND ".$f_edadmax."  
                -- altura del jugador:
                AND fichaJugador.altura BETWEEN ".$f_altura_min." AND ".$f_altura_max."                            
                -- Posición del jugador
                AND ".$f_posicion."
                ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC
            ";

            echo $my_query;
            */
            

            while($row = mysqli_fetch_assoc($resultado)) {
                // $dato[] = utf8_converter( $row );
                
                $idfichaJugador = $row['idfichaJugador'];
                // Consultando posiciones:
                $resultado_3 = $link->query("
                SELECT 
                posicionCancha.posicion,
                posicionCancha.numero_posicion
                FROM fichaJugador
                LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
                WHERE posicionCancha.idfichaJugador = ".$idfichaJugador."        
                ");

                while($row_3 = mysqli_fetch_assoc($resultado_3)) {  
                    $posicion = $row_3['posicion'];
                    $numero_posicion = $row_3['numero_posicion']; 
                    $row['posicion'.$numero_posicion] = $posicion;                                        
                } 
                
                $dato[] = utf8_converter( $row );

            }                            
            break;                                            

        // ------------------------------------ CONSULTAR CLUBES SEGÚN PAÍS Y DIVISIÓN SELECCIONADAS  ------------------------------------ // 
        case 'get_clubes_from_paisdivision':
            $pais_club = intval( $datos['pais_club'] );
            $division_club = intval( $datos['division_club'] );
                    
            // ------- DATOS DEL CLUB ------- //
            $resultado = $link->query("
                SELECT * FROM club 
                WHERE pais_club = ".$pais_club." AND division_club = ".$division_club."
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break; 

        // ------------------------------------ CONSULTAR CLUBES SEGÚN PAÍS DEL CAMPEONATO SELECCIONADO  ------------------------------------ // 
        case 'get_clubes_from_paiscampeonato':
            $pais_campeonato = intval( $datos['pais_campeonato'] );
                    
            // ------- DATOS DEL CLUB ------- //
            $resultado = $link->query("
                SELECT * FROM club 
                WHERE pais_club = ".$pais_campeonato."
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break;             

        // ------------------------------------ PARTIDOS DE JUGADOR  ------------------------------------ // 
        case 'buscar_partidos_jugador':
            $idfichaJugador_club = $datos['idfichaJugador_club'];
            $idfichaJugador_club = intval( $idfichaJugador_club );

            // ------- DATOS DEL CLUB ------- //
            $resultado = $link->query("
            SELECT  
            -- Tabla 'fichaJugador_partido':
            fichaJugador_partido.idfichaJugador_partido,
            fichaJugador_partido.fecha_jugadorpartido,
            fichaJugador_partido.temporada_jugadorpartido,
            fichaJugador_partido.jornada_jugadorpartido,
            fichaJugador_partido.condicion_jugadorpartido,
            fichaJugador_partido.gol_equipo1_jugadorpartido,
            fichaJugador_partido.gol_equipo2_jugadorpartido,
            fichaJugador_partido.posicion_jugadorpartido,
            fichaJugador_partido.tit_sup_nc_jugadorpartido,
            fichaJugador_partido.min_jugados_jugadorpartido,
            fichaJugador_partido.min_entrada_jugadorpartido,
            fichaJugador_partido.min_salida_jugadorpartido,
            fichaJugador_partido.num_gol_jugadorpartido,
            fichaJugador_partido.t_amarilla_jugadorpartido,
            fichaJugador_partido.t_amarilladb_jugadorpartido,
            fichaJugador_partido.t_roja_jugadorpartido,

            -- Tabla 'campeonato':
            campeonato.idcampeonato,
            campeonato.pais_campeonato,
            campeonato.nombre_campeonato,
        
            -- Tabla 't_club_jugador':
            t_club_jugador.idclub AS idclub_jugador,
            t_club_jugador.pais_club AS pais_club_jugador,
            t_club_jugador.division_club AS division_club_jugador,
            t_club_jugador.nombre_club AS nombre_club_jugador,

            -- Tabla 't_club_rival':
            t_club_rival.idclub AS idclub_rival,
            t_club_rival.nombre_club AS nombre_club_rival,    
            
            -- Tabla 'fichaJugador':
            fichaJugador.idfichaJugador,
            fichaJugador.nombre,
            fichaJugador.apellido1,
            fichaJugador.apellido2,
            fichaJugador.fechaNacimiento,
            fichaJugador.sexo,
            fichaJugador.serieActual,
            fichaJugador.numeroDorsal,
            fichaJugador.dinamico,
            fichaJugador.altura,
            fichaJugador.nacionalidad1,
            fichaJugador.nacionalidad2,

            -- Tabla 'fichaJugador_club':
            fichaJugador_club.idfichaJugador_club,
            fichaJugador_club.estado_jugadorclub,
            fichaJugador_club.representante_jugadorclub,
            fichaJugador_club.contrato_pro_jugadorclub,
            fichaJugador_club.situ_clubactual_jugadorclub,
            fichaJugador_club.fechafin_prestamo_jugadorclub,   
            fichaJugador_club.pase_pertenencia_jugadorclub,
            fichaJugador_club.fechafin_contrato_jugadorclub,
            fichaJugador_club.valor_mercado_jugadorclub,
            fichaJugador_club.clausula_salida_jugadorclub,
            fichaJugador_club.valor_clausula_jugadorclub,
            fichaJugador_club.observaciones_jugadorclub

            FROM fichaJugador_partido
            -- Datos del campeonato:
            LEFT JOIN campeonato ON campeonato.idcampeonato = fichaJugador_partido.idcampeonato
            -- Datos de la relación jugador-club:
            LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador_club = fichaJugador_partido.idfichaJugador_club
            -- Datos del jugador:
            LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador            
            -- Datos del club del jugador:
            LEFT JOIN club AS t_club_jugador ON t_club_jugador.idclub = fichaJugador_club.idclub
            -- Datos del club rival:
            LEFT JOIN club AS t_club_rival ON t_club_rival.idclub = fichaJugador_partido.idclub
            WHERE fichaJugador_club.idfichaJugador_club = ".$idfichaJugador_club."
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break; 

        // ------------------------------------ PARTIDOS DE JUGADOR POR CAMPEONATO  ------------------------------------ // 
        case 'buscar_partidos_jugador_porcampeonato':

            $idfichaJugador_club = $datos['idfichaJugador_club'];

            // Primero se consultan todos los campeonatos 
            $resultado = $link->query("
                SELECT * FROM fichaJugador_partido
                LEFT JOIN campeonato ON campeonato.idcampeonato = fichaJugador_partido.idcampeonato
                WHERE fichaJugador_partido.idfichaJugador_club = ".$idfichaJugador_club."
            ");
            $array_id_campeonato = [];
            while($row = mysqli_fetch_assoc($resultado)) {
                
                $idcampeonato = $row["idcampeonato"];

                // -------------------------- Cantidad de partidos jugados -------------------------- //
                // El 3 hace referencia al valor 'NC' (No Compite/No jugados). 
                $resultado_2 = $link->query("
                    SELECT COUNT(idfichaJugador_partido) FROM fichaJugador_partido
                    WHERE idfichaJugador_club = ".$idfichaJugador_club." 
                    AND idcampeonato = ".$idcampeonato."
                    AND tit_sup_nc_jugadorpartido <> 3                  
                ");
                while($row_2 = mysqli_fetch_assoc($resultado_2)) {
                  $row['partidos_jugados'] = $row_2['COUNT(idfichaJugador_partido)'];
                } 

                // -------------------------- Cantidad de minutos jugados -------------------------- //
                $resultado_3 = $link->query("
                    SELECT min_jugados_jugadorpartido FROM fichaJugador_partido
                    WHERE idfichaJugador_club = ".$idfichaJugador_club." 
                    AND idcampeonato = ".$idcampeonato."                  
                ");
                $acumulador_min_partidosjugados = 0;
                while($row_3 = mysqli_fetch_assoc($resultado_3)) {
                   $acumulador_min_partidosjugados = $acumulador_min_partidosjugados + $row_3['min_jugados_jugadorpartido'];
                } 
                $row['min_jugados_jugadorpartido'] = $acumulador_min_partidosjugados;                           

                // -------------------------- Cantidad de partidos jugados como TITULAR -------------------------- //
                // El 1 hace referencia al valor 'Titular'. 
                $resultado_4 = $link->query("
                    SELECT COUNT(idfichaJugador_partido) FROM fichaJugador_partido
                    WHERE idfichaJugador_club = ".$idfichaJugador_club." 
                    AND idcampeonato = ".$idcampeonato."
                    AND tit_sup_nc_jugadorpartido = 1                  
                ");
                while($row_4 = mysqli_fetch_assoc($resultado_4)) {
                  $row['partidos_jugados_titular'] = $row_4['COUNT(idfichaJugador_partido)'];
                } 

                // -------------------------- Cantidad de partidos jugados como SUPLENTE -------------------------- //
                // El 2 hace referencia al valor 'Suplente'. 
                $resultado_5 = $link->query("
                    SELECT COUNT(idfichaJugador_partido) FROM fichaJugador_partido
                    WHERE idfichaJugador_club = ".$idfichaJugador_club." 
                    AND idcampeonato = ".$idcampeonato."
                    AND tit_sup_nc_jugadorpartido = 2                  
                ");
                while($row_5 = mysqli_fetch_assoc($resultado_5)) {
                  $row['partidos_jugados_suplente'] = $row_5['COUNT(idfichaJugador_partido)'];
                }

                // -------------------------- Cantidad de partidos NO JUGADOS -------------------------- //
                // El 1 hace referencia al valor 'NC' (No Compite/No jugados). 
                $resultado_6 = $link->query("
                    SELECT COUNT(idfichaJugador_partido) FROM fichaJugador_partido
                    WHERE idfichaJugador_club = ".$idfichaJugador_club." 
                    AND idcampeonato = ".$idcampeonato."
                    AND tit_sup_nc_jugadorpartido = 3                  
                ");
                while($row_6 = mysqli_fetch_assoc($resultado_6)) {
                  $row['partidos_jugados_nojugados'] = $row_6['COUNT(idfichaJugador_partido)'];
                } 

                // -------------------------- Cantidad de Tarjetas Amarillas -------------------------- //
                $resultado_7 = $link->query("
                    SELECT t_amarilla_jugadorpartido FROM fichaJugador_partido
                    WHERE idfichaJugador_club = ".$idfichaJugador_club." 
                    AND idcampeonato = ".$idcampeonato."
                ");
                $acumulador_t_amarillas = 0;
                while($row_7 = mysqli_fetch_assoc($resultado_7)) {
                   $acumulador_t_amarillas = $acumulador_t_amarillas + $row_7['t_amarilla_jugadorpartido'];
                } 
                $row['t_amarillas_jugadorpartido'] = $acumulador_t_amarillas;    

                // -------------------------- Cantidad de Tarjetas Rojas -------------------------- //
                $resultado_8 = $link->query("
                    SELECT t_roja_jugadorpartido FROM fichaJugador_partido
                    WHERE idfichaJugador_club = ".$idfichaJugador_club." 
                    AND idcampeonato = ".$idcampeonato."
                ");
                $acumulador_t_rojas = 0;
                while($row_8 = mysqli_fetch_assoc($resultado_8)) {
                   $acumulador_t_rojas = $acumulador_t_rojas + $row_8['t_roja_jugadorpartido'];
                } 
                $row['t_rojas_jugadorpartido'] = $acumulador_t_rojas; 

                // -------------------------- Cantidad de Goles Convertidos -------------------------- //
                $resultado_9 = $link->query("
                    SELECT num_gol_jugadorpartido FROM fichaJugador_partido
                    WHERE idfichaJugador_club = ".$idfichaJugador_club." 
                    AND idcampeonato = ".$idcampeonato."
                ");
                $acumulador_goles_convertidos = 0;
                while($row_9 = mysqli_fetch_assoc($resultado_9)) {
                   $acumulador_goles_convertidos = $acumulador_goles_convertidos + $row_9['num_gol_jugadorpartido'];
                } 
                $row['goles_convertidos'] = $acumulador_goles_convertidos;          

                // Array con todos los datos:
                $dato[] = utf8_converter($row);                                                                    

            }               
            break;

        // ------------------------------------ CONSULTAR CLUBES SEGÚN PAÍS Y DIVISIÓN SELECCIONADAS  ------------------------------------ // 
        case 'consultar_jugadores':
            $con    = t_serie($datos['seleccion']);
            $serie  = $con[0];
            $sexo   = $con[1];

            $string = $datos['string'];

            if( $string=='' ) {

                $consulta = $link->query("SELECT
                    -- Tabla 'fichaJugador':
                    fichaJugador.idfichaJugador,
                    fichaJugador.nombre,
                    fichaJugador.apellido1,
                    fichaJugador.apellido2,
                    fichaJugador.rut,
                    fichaJugador.fechaNacimiento,
                    fichaJugador.serieActual,
                    fichaJugador.sexo,
                    fichaJugador.codigoNacionalidad1,
                    fichaJugador.pieHabil,
                    -- Tabla 'club':
                    club.idclub,
                    club.nombre_club
                    FROM fichaJugador
                    -- Datos del jugador:
                    LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador = fichaJugador.idfichaJugador  
                    -- Datos del club:
                    LEFT JOIN club ON club.idclub = fichaJugador_club.idclub                                
                    WHERE fichaJugador.serieActual='".$serie."'
                    AND fichaJugador.sexo='".$sexo."'
                    AND fichaJugador.estado <> 0
                    AND fichaJugador.estado <> 1
                    AND fichaJugador.estado <> 3
                ");

            } else {

                $consulta = $link->query("SELECT
                    -- Tabla 'fichaJugador':
                    fichaJugador.idfichaJugador,
                    fichaJugador.nombre,
                    fichaJugador.apellido1,
                    fichaJugador.apellido2,
                    fichaJugador.rut,
                    fichaJugador.fechaNacimiento,
                    fichaJugador.serieActual,
                    fichaJugador.sexo,
                    fichaJugador.codigoNacionalidad1,
                    fichaJugador.pieHabil,
                    -- Tabla 'club':
                    club.idclub,
                    club.nombre_club
                    FROM fichaJugador
                    -- Datos del jugador:
                    LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador = fichaJugador.idfichaJugador  
                    -- Datos del club:
                    LEFT JOIN club ON club.idclub = fichaJugador_club.idclub                                
                    WHERE (fichaJugador.nombre LIKE '".$datos['string']."%' OR fichaJugador.apellido1 LIKE '".$datos['string']."%' OR fichaJugador.apellido2 LIKE '".$datos['string']."%') 
                    AND fichaJugador.serieActual='".$serie."'
                    AND fichaJugador.sexo='".$sexo."'
                    AND fichaJugador.estado <> 0
                    AND fichaJugador.estado <> 1
                    AND fichaJugador.estado <> 3
                ");

            }

            while ($resultado = mysqli_fetch_assoc($consulta)) {
                $consulta2 = $link->query("SELECT *
                    FROM posicionCancha
                    WHERE posicionCancha.idfichaJugador='".$resultado['idfichaJugador']."'
                    AND posicionCancha.numero_posicion = 0
                    LIMIT 1
                ");
                
                while($resultado2 = mysqli_fetch_assoc($consulta2)){
                    $posicion_g = 0;
                    if      ($resultado2['posicion'] == 1) { $posicion_g = 1; } 
                    else if ($resultado2['posicion'] == 2 || $resultado2['posicion'] == 3 || $resultado2['posicion'] == 4){ $posicion_g = 2; }
                    else if ($resultado2['posicion'] == 5 || $resultado2['posicion'] == 6 || $resultado2['posicion'] == 7 || $resultado2['posicion'] == 8 || $resultado2['posicion'] == 9) { $posicion_g = 3; }
                    else if ($resultado2['posicion'] == 10 || $resultado2['posicion'] == 11 || $resultado2['posicion'] == 12) { $posicion_g = 4; }
                    
                    $resultado['idposicionCancha']= $resultado2['idposicionCancha'];
                    $resultado['posicion']        = $resultado2['posicion'];
                    $resultado['posicion2']       = $posicion_g;
                    $resultado['numeroPosicion']  = $resultado2['numero_posicion'];
                    $resultado['numeroPosicion']  = $resultado2['numero_posicion'];
                }
                
                $dato[] = utf8_converter($resultado);
            }

            // ORDERNAR JUGADORES POR POSICION.
            $n; $i; $k; $aux;
            $n = count($dato);
            for ($k = 1; $k < $n; $k++) {
                for ($i = 0; $i < ($n - $k); $i++) {
                    if ($dato[$i]['posicion'] > $dato[$i + 1]['posicion']) {
                        $aux = $dato[$i];
                        $dato[$i] = $dato[$i + 1];
                        $dato[$i + 1] = $aux;
                    }
                }
            }

            break; 

    }

    $link->close();
    return $dato;       
    
}

/* --------------------------------------------- Inicio de la función 'guardar' --------------------------------------------- */
function guardar( $datos ){
    include("conexion.php");
    $respuesta = "";
    $query = "";

    // ------- Datos opcionales -------// 
    if( !isset( $datos['motivo_noestudiando_re'] ) ) {
        $datos['motivo_noestudiando_re'] = '';
    }

    if( !isset( $datos['nivel_educ_egreso_re'] ) ) {
        $datos['nivel_educ_egreso_re'] = '';
    }

    if( !isset( $datos['aniofin_egreso_re'] ) ) {
        $datos['aniofin_egreso_re'] = '';
    }

    if( !isset( $datos['institucion_egreso_re'] ) ) {
        $datos['institucion_egreso_re'] = '';
    }

    if( !isset( $datos['carrera_egreso_re'] ) ) {
        $datos['carrera_egreso_re'] = '';
    }    

    if($datos['idffch_registro_educacional']=='') { // <----------- INSERT

        // ----------- Tabla 'ffch_registro_educacional' ----------- //
        // INSERT:
        $query = $link->query("INSERT INTO ffch_registro_educacional (
            idfichaJugador,
            anio_re,
            semestre_re,
            estado_re,
            motivo_noestudiando_re,
            nivel_educ_egreso_re,
            aniofin_egreso_re,
            institucion_egreso_re,
            carrera_egreso_re,
            nivel_educ_re,
            colegio_re,
            curso_re,
            jornada_re,
            horario_inicio_re,
            horario_fin_re,
            promedio_nota_re,
            comuna_colegio_re,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
              '".utf8_decode($datos['idfichaJugador'])."',
              '".utf8_decode($datos['anio_re'])."',
              '".utf8_decode($datos['semestre_re'])."',
              '".utf8_decode($datos['estado_re'])."',
              '".utf8_decode($datos['motivo_noestudiando_re'])."',
              '".utf8_decode($datos['nivel_educ_egreso_re'])."',
              '".utf8_decode($datos['aniofin_egreso_re'])."',
              '".utf8_decode($datos['institucion_egreso_re'])."',
              '".utf8_decode($datos['carrera_egreso_re'])."',
              '".utf8_decode($datos['nivel_educ_re'])."',
              '".utf8_decode($datos['colegio_re'])."',
              '".utf8_decode($datos['curso_re'])."',
              '".utf8_decode($datos['jornada_re'])."',
              '".utf8_decode($datos['horario_inicio_re'])."',
              '".utf8_decode($datos['horario_fin_re'])."',
              '".utf8_decode($datos['promedio_nota_re'])."',
              '".utf8_decode($datos['comuna_colegio_re'])."',
              '".utf8_decode($datos['nombre_usuario_software'])."',
              '".getDateTime()."'
        )");

        if( $query ) {
            $respuesta = 1; // INSERT ejecutado correctamente.
        } else {
            $respuesta = $link->error; // Error al ejecutar INSERT.
        }
            
    } else { // <------------- UPDATE

        $idffch_registro_educacional = $datos['idffch_registro_educacional'];

        $query = $link->query("UPDATE ffch_registro_educacional SET 
            anio_re = '".utf8_decode($datos['anio_re'])."',
            semestre_re = '".utf8_decode($datos['semestre_re'])."',
            estado_re = '".utf8_decode($datos['estado_re'])."',
            motivo_noestudiando_re = '".utf8_decode($datos['motivo_noestudiando_re'])."',
            nivel_educ_egreso_re = '".utf8_decode($datos['nivel_educ_egreso_re'])."',
            aniofin_egreso_re = '".utf8_decode($datos['aniofin_egreso_re'])."',
            institucion_egreso_re = '".utf8_decode($datos['institucion_egreso_re'])."',
            carrera_egreso_re = '".utf8_decode($datos['carrera_egreso_re'])."',
            nivel_educ_re = '".utf8_decode($datos['nivel_educ_re'])."',
            colegio_re = '".utf8_decode($datos['colegio_re'])."',
            curso_re = '".utf8_decode($datos['curso_re'])."',
            jornada_re = '".utf8_decode($datos['jornada_re'])."',
            horario_inicio_re = '".utf8_decode($datos['horario_inicio_re'])."',
            horario_fin_re = '".utf8_decode($datos['horario_fin_re'])."',
            promedio_nota_re = '".utf8_decode($datos['promedio_nota_re'])."',
            comuna_colegio_re = '".utf8_decode($datos['comuna_colegio_re'])."',
            nombre_usuario_software = '".utf8_decode($datos['nombre_usuario_software'])."',
            fecha_software = '".getDateTime()."'
            WHERE idffch_registro_educacional = '".$idffch_registro_educacional."'
        "); 

        if( $query ) {
            $respuesta = 2; // UPDATE ejecutado correctamente.
        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE.
        }

    }
    
    $link->close();
    return $respuesta;

}
/* --------------------------------------------- Fin de la función 'guardar' --------------------------------------------- */

/* --------------------------------------------- Fin de la función 'eliminar' --------------------------------------------- */
function eliminar($id){
    include("conexion.php");
    $query = $link->query("DELETE FROM informe_ayuda_social WHERE idinforme_ayuda_social = ".$id." ");
    if( $query )  { 
        return 1;                   
        $link->close();
    } else {
        return $link->error; // Error al ejecutar UPDATE...                    
        $link->close();
    }      
    
}
/* --------------------------------------------- Fin de la función 'eliminar' --------------------------------------------- */

?>