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

/* ---------------- Ver datos ----------------- */
function ver_datos( $datos ){
    include("conexion.php");
    
    $dato = [];

    $tipo_consulta = $datos['tipo_consulta'];
    
    switch( $tipo_consulta ) {

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

    }

    $link->close();
    return $dato;       
    
}

function guardar_ficha_jugador($datos){
    include("conexion.php");
    $respuesta = "";
    $query = "";
    $array_paises = [
        'cl', // <--- Chile 
        'ar',  // <--- Argentina
        've',  // <--- Venezuela
        'br',  // <--- Brasil
        'co',  // <--- Colombia
        'ec',  // <--- Ecuador
        'uy',  // <--- Uruguay
        'pe',  // <--- Perú
        'py',  // <--- Paraguay
        'mx'  // <--- México
    ];

    // Si la fecha de nacimiento no es especificada, registra la fecha actual:
    if( $datos['fechaNacimiento'] == '' ) {
        $datos['fechaNacimiento'] = date("Y-m-d");
    }

    if($datos['idfichaJugador']==''){//agregar nuevo jugador
        // ----------- Tabla 'fichaJugador' ----------- //
        // INSERT:
        $query = $link->query("INSERT INTO fichaJugador (
            nombre,
            apellido1,
            apellido2,
            fechaNacimiento,
            sexo,
            serieActual,
            dinamico,
            altura,
            nacionalidad1,
            codigoNacionalidad1,
            nacionalidad2,
            seleccionado
            ) VALUES (
              '".utf8_decode($datos['nombre'])."',
              '".utf8_decode($datos['apellido1'])."',
              '".utf8_decode($datos['apellido2'])."',
              '".utf8_decode($datos['fechaNacimiento'])."',
              '".utf8_decode($datos['sexo'])."',
              '".utf8_decode($datos['serieActual'])."',
              '".utf8_decode($datos['dinamico'])."',
              '".utf8_decode($datos['altura'])."',
              '".utf8_decode($datos['nacionalidad1'])."',
              '".utf8_decode($datos['nacionalidad1'])."',
              '".utf8_decode($datos['nacionalidad2'])."',
              '".utf8_decode($datos['seleccionado'])."'
        )");

        // Si se insertan correctamente los datos en la tabla 'fichaJugador', se procede a insertar datos en la tabla 'posicionCancha'
        if( $query )  { 
            
            // Valor del ID del jugador recién insertado:
            $idfichaJugador = $link->insert_id;

            // ------------------- FOTO --------------- //
            if( isset($_FILES['foto_jugador']['name']) ){
                if( $_FILES['foto_jugador']['name'] == '' ) {
                    copy('../img/silueta_jugador.png', '../foto_jugadores_scouting/'.$idfichaJugador.'.png');
                } else {
                    copy('../subir_imagen3/buffer_imagen.png', '../foto_jugadores_scouting/'.$idfichaJugador.'.png');
                }

            } else{ // Si no selecciona foto (registro de usuario con nuevo perfil)... 
                copy('../subir_imagen3/buffer_imagen.png', '../foto_jugadores_scouting/'.$idfichaJugador.'.png');
            }

            // ----------- Tabla 'posicionCancha' ----------- //
            // INSERT:
            for( $i=0; $i<3; $i++ ) {

                $posicion = $datos['posicion'.$i];
                $query = $link->query("INSERT INTO posicionCancha (
                    posicion,
                    numero_posicion,
                    idfichaJugador
                    ) 
                    VALUES 
                    (
                      '".$posicion."',
                      '".$i."',
                      '".$idfichaJugador."'
                    )                         
                ");                
            }
               
            // Si se insertan correctamente los datos en la tabla 'posicionCancha', se procede a insertar datos en la tabla 'fichaJugador_club'
            if( $query ) {

                 // Verificando el estado del club:
                $estado_jugadorclub = intval( $datos['estado_jugadorclub'] );
                
                // Inicializando valores que cambiarán dependiendo del estado del jugador:
                $contrato_pro_jugadorclub = '';
                $situ_clubactual_jugadorclub = '';
                $fechafin_prestamo_jugadorclub = '';
                $pase_pertenencia_jugadorclub = '';
                $fechafin_contrato_jugadorclub = '';
                $valor_mercado_jugadorclub = '';
                $clausula_salida_jugadorclub = '';
                $valor_clausula_jugadorclub = '';

                if( $estado_jugadorclub === 1 ) { // <---- Jugador Libre.

                    // Declarando variable que almacenará el valor del ID del Club según sea el caso (JUGADOR LIBRE).
                    $idclub = "";
                    // ============================ Verificando si el club es uno que ha sido previamente registrado en la BD o es nuevo (el usuario seleccionó 'Otro') ============== //
                    if( $datos['idclub_jugadorlibre'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                        
                        $tipo_pais_club = '';
                        if( in_array( $datos['pais_club_jugadorlibre_otro'], $array_paises ) ) {
                            $tipo_pais_club = 1;
                        } else {
                            $tipo_pais_club = 2;
                        }
                        // INSERT en la tabla 'club':
                        $query = $link->query("INSERT INTO club (
                            pais_club,
                            tipo_pais_club,
                            division_club,
                            nombre_club,
                            entrenador_club
                            ) VALUES (
                            '".utf8_decode($datos['pais_club_jugadorlibre_otro'])."',
                            '".utf8_decode($tipo_pais_club)."',
                            '".utf8_decode($datos['division_club_jugadorlibre_otro'])."',
                            '".utf8_decode($datos['nombre_club_jugadorlibre_otro'])."',
                            '".utf8_decode($datos['entrenador_club_jugadorlibre_otro'])."'
                        )");

                        if( $query )  { 
                            $idclub = $link->insert_id; // <--- ID del Campeonato recién registrado
                        } else {
                            $respuesta = $link->error; // Error al ejecutar INSERT...
                            // return false; 
                        }              

                    } else { // <---- El club seleccionado es uno que ha sido previamente registrado en la BD.
                        $idclub = $datos['idclub_jugadorlibre'];
                    }                

                    // Éstas variables estarán vacías ya que no tienen nada que no serán tomadas en cuenta si el jugador es libre.
                    $contrato_pro_jugadorclub = '';
                    $situ_clubactual_jugadorclub = '';
                    $fechafin_prestamo_jugadorclub = '';
                    $pase_pertenencia_jugadorclub = '';
                    $fechafin_contrato_jugadorclub = '';
                    $valor_mercado_jugadorclub = '';
                    $clausula_salida_jugadorclub = '';
                    $valor_clausula_jugadorclub = '';

                } else { // <---- En club-

                    // Declarando variable que almacenará el valor del ID del Club según sea el caso (JUGADOR EN CLUB).
                    $idclub = "";
                    // ============================ Verificando si el club es uno que ha sido previamente registrado en la BD o es nuevo (el usuario seleccionó 'Otro') ============== //
                    if( $datos['idclub_actual_jugadorenclub'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                        
                        $tipo_pais_club = '';
                        if( in_array( $datos['pais_club_jugadorenclub_otro'], $array_paises ) ) {
                            $tipo_pais_club = 1;
                        } else {
                            $tipo_pais_club = 2;
                        }
                        // INSERT en la tabla 'club':
                        $query = $link->query("INSERT INTO club (
                            pais_club,
                            tipo_pais_club,
                            division_club,
                            nombre_club,
                            entrenador_club
                            ) VALUES (
                            '".utf8_decode($datos['pais_club_jugadorenclub_otro'])."',
                            '".utf8_decode($tipo_pais_club)."',
                            '".utf8_decode($datos['division_club_jugadorenclub_otro'])."',
                            '".utf8_decode($datos['nombre_clubenclub_jugadorenclub_otro'])."',
                            '".utf8_decode($datos['entrenador_club_jugadorenclub_otro'])."'
                        )");

                        if( $query )  { 
                            $idclub = $link->insert_id; // <--- ID del Campeonato recién registrado
                        } else {
                            $respuesta = $link->error; // Error al ejecutar INSERT...
                            // return false; 
                        }              

                    } else { // <---- El club seleccionado es uno que ha sido previamente registrado en la BD.
                        $idclub = $datos['idclub_actual_jugadorenclub'];
                    }

                    $contrato_pro_jugadorclub = $datos['contrato_pro_jugadorclub'];
                    $situ_clubactual_jugadorclub = $datos['situ_clubactual_jugadorclub'];
                    
                    /*
                    Si la Situación en el club actual es 'A préstamo' / == '1', entonces se registrarán valores en los siguientes campos:
                    - fichaJugador_club.fechafin_prestamo_jugadorclub
                    - fichaJugador_club.pase_pertenencia_jugadorclub
                    */ 
                    if( $situ_clubactual_jugadorclub == '1' ) { // <--- 'A préstamo' 
                        $fechafin_prestamo_jugadorclub = $datos['fechafin_prestamo_jugadorclub'];
                        $pase_pertenencia_jugadorclub = $datos['pase_pertenencia_jugadorclub'];
                    } else { // <--- 'Pertenece al club' ('2') 
                        $fechafin_prestamo_jugadorclub = '';   
                        $pase_pertenencia_jugadorclub = '';
                    }   

                    $fechafin_contrato_jugadorclub = $datos['fechafin_contrato_jugadorclub'];
                    $valor_mercado_jugadorclub = $datos['valor_mercado_jugadorclub'];
                    

                    $clausula_salida_jugadorclub = $datos['clausula_salida_jugadorclub'];
                    // Si tiene cláusula de salida, se registrará el valor de esta:
                    if( $clausula_salida_jugadorclub == '1' ) { // Cláusula de salida = 'Sí' ('1')
                        $valor_clausula_jugadorclub = $datos['valor_clausula_jugadorclub'];
                    } else { // Cláusula de salida = 'No' ('0')
                        $valor_clausula_jugadorclub = '';
                    }

                }     
                // Independientemente del estado del jugador, la observación siempre será insertada/modificada:
                $observaciones_jugadorclub = $datos['observaciones_jugadorclub'];

                // Comprobando si el valor es nulo:
                $idclub = !empty($idclub) ? "'$idclub'" : "NULL";
                // var_dump($idclub);

                // ----------- Tabla 'fichaJugador_club' ----------- //
                $query = $link->query("INSERT INTO fichaJugador_club (
                    idfichaJugador,
                    idclub,
                    estado_jugadorclub,
                    representante_jugadorclub,
                    contrato_pro_jugadorclub,
                    situ_clubactual_jugadorclub,
                    fechafin_prestamo_jugadorclub,
                    pase_pertenencia_jugadorclub,
                    fechafin_contrato_jugadorclub,
                    valor_mercado_jugadorclub,
                    clausula_salida_jugadorclub,
                    valor_clausula_jugadorclub,
                    observaciones_jugadorclub,
                    nombre_usuario_software,
                    fecha_software
                    ) VALUES (
                      '".$idfichaJugador."',
                      ".$idclub.",
                      '".utf8_decode($estado_jugadorclub)."',
                      '".utf8_decode($datos['representante_jugadorclub'])."',
                      '".utf8_decode($contrato_pro_jugadorclub)."',
                      '".utf8_decode($situ_clubactual_jugadorclub)."',
                      '".utf8_decode($fechafin_prestamo_jugadorclub)."',
                      '".utf8_decode($pase_pertenencia_jugadorclub)."',
                      '".utf8_decode($fechafin_contrato_jugadorclub)."',
                      '".utf8_decode($valor_mercado_jugadorclub)."',
                      '".utf8_decode($clausula_salida_jugadorclub)."',
                      '".utf8_decode($valor_clausula_jugadorclub)."',
                      '".utf8_decode($observaciones_jugadorclub)."',
                      '".utf8_decode($datos['nombre_usuario_software'])."',
                      '".getDateTime()."'
                )");

                // Si se insertan correctamente los datos en la tabla 'fichaJugador_club', el proceso finaliza y se muestra el mensaje de éxito:
                if( $query )  {
                    $respuesta = 1; // INSERT ejecutado correctamente.
                } else {
                    // Error al insertar datos en la tabla 'fichaJugador_club'
                    $respuesta = $link->error; // Error al ejecutar.                    
                }

            } else {
                // Error al insertar datos en la tabla 'posicionCancha'
                $respuesta = $link->error; // Error al ejecutar INSERT.                       
            }           


        } else {
            // Error al insertar datos en la tabla 'fichaJugador'
            $respuesta = $link->error; // Error al ejecutar INSERT.                    
        }   
            
    }else{

        // Si la fecha de nacimiento no es especificada, registra la fecha actual:
        if( $datos['fechaNacimiento'] == '' ) {
            $datos['fechaNacimiento'] = date("Y-m-d");
        }

        // ----------- Tabla 'fichaJugador' ----------- //
        // UPDATE:
        $query = $link->query("UPDATE fichaJugador SET
            nombre = '".utf8_decode($datos['nombre'])."',
            apellido1 = '".utf8_decode($datos['apellido1'])."',
            apellido2 = '".utf8_decode($datos['apellido2'])."',
            fechaNacimiento = '".utf8_decode($datos['fechaNacimiento'])."',
            sexo = '".utf8_decode($datos['sexo'])."',
            serieActual = '".utf8_decode($datos['serieActual'])."',
            dinamico = '".utf8_decode($datos['dinamico'])."',
            altura = '".utf8_decode($datos['altura'])."',
            nacionalidad1 = '".utf8_decode($datos['nacionalidad1'])."',
            codigoNacionalidad1 = '".utf8_decode($datos['nacionalidad1'])."',
            nacionalidad2 = '".utf8_decode($datos['nacionalidad2'])."',
            seleccionado = '".utf8_decode($datos['seleccionado'])."'
            WHERE idfichaJugador = '".utf8_decode($datos['idfichaJugador'])."'
        ");

        // Si se modifican correctamente los datos en la tabla 'fichaJugador', se procede a modificar datos en la tabla 'fichaJugador_club'
        if( $query )  { 
            
            // Valor del ID del jugador seleccionado:
            $idfichaJugador = $datos['idfichaJugador']; 

            // ------------------- FOTO --------------- //
            if( isset($_FILES['foto_jugador']['name']) ){
                if( $_FILES['foto_jugador']['name'] == '' ) {

                    if (!file_exists('../foto_jugadores_scouting/'.$idfichaJugador.'.png')) {
                        copy('../img/silueta_jugador.png', '../foto_jugadores_scouting/'.$idfichaJugador.'.png');
                    } else {
                        copy('../foto_jugadores_scouting/'.$idfichaJugador.'.png', '../'.$datos['foto_anterior_jugador']);
                    }
                    
                } else {
                    copy('../subir_imagen3/buffer_imagen.png', '../foto_jugadores_scouting/'.$idfichaJugador.'.png');
                }

            } else{ // Si no selecciona foto (registro de usuario con nuevo perfil)... 
                copy('../subir_imagen3/buffer_imagen.png', '../foto_jugadores_scouting/'.$idfichaJugador.'.png');
            }

            // ----------- Tabla 'posicionCancha' ----------- //
            // UPDATE:

            for( $i=0; $i<3; $i++ ) {
                
                $posicion = $datos['posicion'.$i];
                
                // Consulando las posiciones para determinar si se modificarán o insertarán:
                if( $resultado = $link->query("SELECT * FROM posicionCancha WHERE idfichaJugador = '".$idfichaJugador."' AND numero_posicion = '".$i."'") ) {

                    // Cantidad de filas de la consulta:
                    $row_cnt = $resultado->num_rows;

                    if( $row_cnt > 0 ) { // <--- Modificar
                        $query = $link->query("UPDATE posicionCancha SET
                            posicion = '".utf8_decode($posicion)."'
                            WHERE idfichaJugador = '".$idfichaJugador."' AND numero_posicion = '".$i."'
                        ");

                    } else { // <--- Insertar
                        $query = $link->query("INSERT INTO posicionCancha (
                            posicion,
                            numero_posicion,
                            idfichaJugador
                            ) 
                            VALUES 
                            (
                              '".$posicion."',
                              '".$i."',
                              '".$idfichaJugador."'
                            )                         
                        ");                      
                    }

                } else { // <-- Error al consultar las posiciones de los jugadores
                    return false;
                }                

            }
               
            // Si se modifican correctamente los datos en la tabla 'posicionCancha', se procede a modificar datos en la tabla 'fichaJugador_club':
            if( $query ) {


                // Valor del ID del jugador-club seleccionado:
                $idfichaJugador_club = $datos['idfichaJugador_club'];


                // Verificando el estado del club:
                $estado_jugadorclub = intval( $datos['estado_jugadorclub'] );
                
                // Inicializando valores que cambiarán dependiendo del estado del jugador:
                $contrato_pro_jugadorclub = '';
                $situ_clubactual_jugadorclub = '';
                $fechafin_prestamo_jugadorclub = '';
                $pase_pertenencia_jugadorclub = '';
                $fechafin_contrato_jugadorclub = '';
                $valor_mercado_jugadorclub = '';
                $clausula_salida_jugadorclub = '';
                $valor_clausula_jugadorclub = '';

                if( $estado_jugadorclub === 1 ) { // <---- Jugador Libre.

                    // Declarando variable que almacenará el valor del ID del Club según sea el caso (JUGADOR LIBRE).
                    $idclub = "";
                    // ============================ Verificando si el club es uno que ha sido previamente registrado en la BD o es nuevo (el usuario seleccionó 'Otro') ============== //
                    if( $datos['idclub_jugadorlibre'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                        
                        $tipo_pais_club = '';
                        if( in_array( $datos['pais_club_jugadorlibre_otro'], $array_paises ) ) {
                            $tipo_pais_club = 1;
                        } else {
                            $tipo_pais_club = 2;
                        }
                        // INSERT en la tabla 'club':
                        $query = $link->query("INSERT INTO club (
                            pais_club,
                            tipo_pais_club,
                            division_club,
                            nombre_club,
                            entrenador_club
                            ) VALUES (
                            '".utf8_decode($datos['pais_club_jugadorlibre_otro'])."',
                            '".utf8_decode($tipo_pais_club)."',
                            '".utf8_decode($datos['division_club_jugadorlibre_otro'])."',
                            '".utf8_decode($datos['nombre_club_jugadorlibre_otro'])."',
                            '".utf8_decode($datos['entrenador_club_jugadorlibre_otro'])."'
                        )");

                        if( $query )  { 
                            $idclub = $link->insert_id; // <--- ID del Campeonato recién registrado
                        } else {
                            $respuesta = $link->error; // Error al ejecutar INSERT...
                            //return false; 
                        }              

                    } else { // <---- El club seleccionado es uno que ha sido previamente registrado en la BD.
                        $idclub = $datos['idclub_jugadorlibre'];
                    }                

                    // Éstas variables estarán vacías ya que no tienen nada que no serán tomadas en cuenta si el jugador es libre.
                    $contrato_pro_jugadorclub = '';
                    $situ_clubactual_jugadorclub = '';
                    $fechafin_prestamo_jugadorclub = '';
                    $pase_pertenencia_jugadorclub = '';
                    $fechafin_contrato_jugadorclub = '';
                    $valor_mercado_jugadorclub = '';
                    $clausula_salida_jugadorclub = '';
                    $valor_clausula_jugadorclub = '';

                } else { // <---- En club-

                    // Declarando variable que almacenará el valor del ID del Club según sea el caso (JUGADOR EN CLUB).
                    $idclub = "";
                    // ============================ Verificando si el club es uno que ha sido previamente registrado en la BD o es nuevo (el usuario seleccionó 'Otro') ============== //
                    if( $datos['idclub_actual_jugadorenclub'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                        
                        $tipo_pais_club = '';
                        if( in_array( $datos['pais_club_jugadorenclub_otro'], $array_paises ) ) {
                            $tipo_pais_club = 1;
                        } else {
                            $tipo_pais_club = 2;
                        }
                        // INSERT en la tabla 'club':
                        $query = $link->query("INSERT INTO club (
                            pais_club,
                            tipo_pais_club,
                            division_club,
                            nombre_club,
                            entrenador_club
                            ) VALUES (
                            '".utf8_decode($datos['pais_club_jugadorenclub_otro'])."',
                            '".utf8_decode($tipo_pais_club)."',
                            '".utf8_decode($datos['division_club_jugadorenclub_otro'])."',
                            '".utf8_decode($datos['nombre_clubenclub_jugadorenclub_otro'])."',
                            '".utf8_decode($datos['entrenador_club_jugadorenclub_otro'])."'
                        )");

                        if( $query )  { 
                            $idclub = $link->insert_id; // <--- ID del Campeonato recién registrado
                        } else {
                            $respuesta = $link->error; // Error al ejecutar INSERT...
                            // return false; 
                        }              

                    } else { // <---- El club seleccionado es uno que ha sido previamente registrado en la BD.
                        $idclub = $datos['idclub_actual_jugadorenclub'];
                    }

                    $contrato_pro_jugadorclub = $datos['contrato_pro_jugadorclub'];
                    $situ_clubactual_jugadorclub = $datos['situ_clubactual_jugadorclub'];
                    
                    /*
                    Si la Situación en el club actual es 'A préstamo' / == '1', entonces se registrarán valores en los siguientes campos:
                    - fichaJugador_club.fechafin_prestamo_jugadorclub
                    - fichaJugador_club.pase_pertenencia_jugadorclub
                    */ 
                    if( $situ_clubactual_jugadorclub == '1' ) { // <--- 'A préstamo' 
                        $fechafin_prestamo_jugadorclub = $datos['fechafin_prestamo_jugadorclub'];
                        $pase_pertenencia_jugadorclub = $datos['pase_pertenencia_jugadorclub'];
                    } else { // <--- 'Pertenece al club' ('2') 
                        $fechafin_prestamo_jugadorclub = '';   
                        $pase_pertenencia_jugadorclub = '';
                    }   

                    $fechafin_contrato_jugadorclub = $datos['fechafin_contrato_jugadorclub'];
                    $valor_mercado_jugadorclub = $datos['valor_mercado_jugadorclub'];
                    

                    $clausula_salida_jugadorclub = $datos['clausula_salida_jugadorclub'];
                    // Si tiene cláusula de salida, se registrará el valor de esta:
                    if( $clausula_salida_jugadorclub == '1' ) { // Cláusula de salida = 'Sí' ('1')
                        $valor_clausula_jugadorclub = $datos['valor_clausula_jugadorclub'];
                    } else { // Cláusula de salida = 'No' ('0')
                        $valor_clausula_jugadorclub = '';
                    }

                }     

                // Independientemente del estado del jugador, la observación siempre será insertada/modificada:
                $observaciones_jugadorclub = $datos['observaciones_jugadorclub'];

                // Comprobando si el valor es nulo:
                $idclub = !empty($idclub) ? "'$idclub'" : "NULL";

                // ----------- Tabla 'fichaJugador_club' ----------- //
                $query = $link->query("UPDATE fichaJugador_club SET
                    idclub = ".utf8_decode($idclub).",
                    estado_jugadorclub = '".utf8_decode($estado_jugadorclub)."',
                    representante_jugadorclub = '".utf8_decode($datos['representante_jugadorclub'])."',
                    contrato_pro_jugadorclub = '".utf8_decode($contrato_pro_jugadorclub)."',
                    situ_clubactual_jugadorclub = '".utf8_decode($situ_clubactual_jugadorclub)."',
                    fechafin_prestamo_jugadorclub = '".utf8_decode($fechafin_prestamo_jugadorclub)."',
                    pase_pertenencia_jugadorclub = '".utf8_decode($pase_pertenencia_jugadorclub)."',
                    fechafin_contrato_jugadorclub = '".utf8_decode($fechafin_contrato_jugadorclub)."',
                    valor_mercado_jugadorclub = '".utf8_decode($valor_mercado_jugadorclub)."',
                    clausula_salida_jugadorclub = '".utf8_decode($clausula_salida_jugadorclub)."',
                    valor_clausula_jugadorclub = '".utf8_decode($valor_clausula_jugadorclub)."',
                    observaciones_jugadorclub = '".utf8_decode($observaciones_jugadorclub)."',
                    nombre_usuario_software = '".utf8_decode($datos['nombre_usuario_software'])."',
                    fecha_software = '".getDateTime()."'
                    WHERE idfichaJugador_club = '".$idfichaJugador_club."'
                ");

                // Si se insertan correctamente los datos en la tabla 'fichaJugador_club', el proceso finaliza y se muestra el mensaje de éxito:
                if( $query )  {
                    $respuesta = 2; // UPDATE ejecutado correctamente.
                } else {
                    // Error al insertar datos en la tabla 'fichaJugador_club'
                    $respuesta = $link->error; // Error al ejecutar.                    
                }

            } else {
                // Error al modificar datos en la tabla 'posicionCancha'
                $respuesta = $link->error; // Error al ejecutar.                 
            }
        
        } else {
            // Error al modificar datos en la tabla 'fichaJugador'
            $respuesta = $link->error; // Error al ejecutar.                    
        }

    }
    
    $link->close();
    return $respuesta;

}

// -------------------------------------------------------------------------------------------- //
function guardar_partido_jugador($datos){
    include("conexion.php");
    $respuesta = "";
    $query = "";

    $array_paises = [
        'cl', // <--- Chile 
        'ar',  // <--- Argentina
        've',  // <--- Venezuela
        'br',  // <--- Brasil
        'co',  // <--- Colombia
        'ec',  // <--- Ecuador
        'uy',  // <--- Uruguay
        'pe',  // <--- Perú
        'py',  // <--- Paraguay
        'mx'  // <--- México
    ];

    if($datos['idfichaJugador_partido']==''){ 

        // INSERT:
        $idfichaJugador_club = $datos['idfichaJugador_club'];

        // Declarando variable que almacenará el valor del ID del Club según sea el caso (CLUB RIVAL).
        $idclub = "";
        // ============================ Verificando si el club es uno que ha sido previamente registrado en la BD o el usuario seleccionó 'Otro') ============== //
        if( $datos['idclub_rival'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                    
            $tipo_pais_club = '';
            if( in_array( $datos['pais_club_rival_otro'], $array_paises ) ) {
                $tipo_pais_club = 1;
            } else {
                $tipo_pais_club = 2;
            }
            // INSERT en la tabla 'club':
            $query = $link->query("INSERT INTO club (
                pais_club,
                tipo_pais_club,
                division_club,
                nombre_club,
                entrenador_club
                ) VALUES (
                '".utf8_decode($datos['pais_club_rival_otro'])."',
                '".utf8_decode($tipo_pais_club)."',
                '".utf8_decode($datos['division_club_rival_otro'])."',
                '".utf8_decode($datos['nombre_club_rival_otro'])."',
                '".utf8_decode($datos['entrenador_club_rival_otro'])."'
            )");

            if( $query )  { 
                $idclub = $link->insert_id; // <--- ID del Campeonato recién registrado
                } else {
                $respuesta = $link->error; // Error al ejecutar INSERT...
                // return false; 
            }              

        } else { // <---- El club seleccionado es uno que ha sido previamente registrado en la BD.
            $idclub = $datos['idclub_rival'];
        }

        // Declarando variable que almacenará el valor del ID del Campeonato según sea el caso.
        $idcampeonato = "";
        // ============================ Verificando si el campeonato es uno que ha sido previamente registrado en la BD o el usuario seleccionó 'Otro') ============== //
        if( $datos['idcampeonato'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                    
            // INSERT en la tabla 'campeonato':
            $query = $link->query("INSERT INTO campeonato (
                pais_campeonato,
                division_campeonato,
                nombre_campeonato,
                organizador_campeonato
                ) VALUES (
                '".utf8_decode($datos['pais_campeonato_otro'])."',
                '".utf8_decode($datos['division_campeonato_otro'])."',
                '".utf8_decode($datos['nombre_campeonato_otro'])."',
                '".utf8_decode($datos['organizador_campeonato_otro'])."'
            )");

            if( $query )  { 
                $idcampeonato = $link->insert_id; // <--- ID del Campeonato recién registrado
                } else {
                $respuesta = $link->error; // Error al ejecutar INSERT...
                // return false; 
            }              

        } else { // <---- El club seleccionado es uno que ha sido previamente registrado en la BD.
            $idcampeonato = $datos['idcampeonato'];
        }        

        // Comprobando si el valor es nulo:
        /*
        $idcampeonato = !empty($idclub) ? "'$idcampeonato'" : "NULL";
        $idclub = !empty($idclub) ? "'$idclub'" : "NULL";
        */

        if( $idcampeonato == '' ) {
            $idcampeonato = "NULL";
        } else {
            $idcampeonato = $idcampeonato;
        }
        
        if( $idclub == '' ) {
            $idclub = "NULL";
        } else {
            $idclub = $idclub;
        }        

        // Comprobando si no está establecido la condición:
        if( !isset( $datos['condicion_jugadorpartido'] ) ) {
            $datos['condicion_jugadorpartido'] = '';
        }

        // ----------- Tabla 'fichaJugador_partido' ----------- //
        $query = $link->query("INSERT INTO fichaJugador_partido (
            idfichaJugador_club,
            idcampeonato,
            idclub,
            fecha_jugadorpartido,
            temporada_jugadorpartido,
            jornada_jugadorpartido,
            posicion_jugadorpartido,
            tit_sup_nc_jugadorpartido,
            t_amarilla_jugadorpartido,
            t_amarilladb_jugadorpartido,
            t_roja_jugadorpartido,
            num_gol_jugadorpartido,
            min_entrada_jugadorpartido,
            min_salida_jugadorpartido,
            min_jugados_jugadorpartido,
            condicion_jugadorpartido,
            gol_equipo1_jugadorpartido,
            gol_equipo2_jugadorpartido,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
              '".$idfichaJugador_club."',
              ".$idcampeonato.",
              ".$idclub.",
              '".utf8_decode($datos['fecha_jugadorpartido'])."',
              '".utf8_decode($datos['temporada_jugadorpartido'])."',
              '".utf8_decode($datos['jornada_jugadorpartido'])."',
              '".utf8_decode($datos['posicion_jugadorpartido'])."',
              '".utf8_decode($datos['tit_sup_nc_jugadorpartido'])."',
              '".utf8_decode($datos['t_amarilla_jugadorpartido'])."',
              '".utf8_decode($datos['t_amarilladb_jugadorpartido'])."',
              '".utf8_decode($datos['t_roja_jugadorpartido'])."',
              '".utf8_decode($datos['num_gol_jugadorpartido'])."',
              '".utf8_decode($datos['min_entrada_jugadorpartido'])."',
              '".utf8_decode($datos['min_salida_jugadorpartido'])."',
              '".utf8_decode($datos['min_jugados_jugadorpartido'])."',
              '".utf8_decode($datos['condicion_jugadorpartido'])."',
              '".utf8_decode($datos['gol_equipo1_jugadorpartido'])."',
              '".utf8_decode($datos['gol_equipo2_jugadorpartido'])."',
              '".utf8_decode($datos['nombre_usuario_software'])."',
              '".getDateTime()."'
        )");

        // Si se insertan correctamente los datos en la tabla 'fichaJugador', se procede a insertar datos en la tabla 'fichaJugador_club'
        if( $query )  { 
            $respuesta = 1; // INSERT ejecutado correctamente.
        } else {
            // Error al insertar datos en la tabla 'fichaJugador'
            $respuesta = $link->error; // Error al ejecutar.                    
        }   
            
    }else{

        // UPDATE:        
        $idfichaJugador_partido = $datos['idfichaJugador_partido'];

        // Declarando variable que almacenará el valor del ID del Club según sea el caso (CLUB RIVAL).
        $idclub = "";
        // ============================ Verificando si el club es uno que ha sido previamente registrado en la BD o el usuario seleccionó 'Otro') ============== //
        if( $datos['idclub_rival'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                    
            $tipo_pais_club = '';
            if( in_array( $datos['pais_club_rival_otro'], $array_paises ) ) {
                $tipo_pais_club = 1;
            } else {
                $tipo_pais_club = 2;
            }
            // INSERT en la tabla 'club':
            $query = $link->query("INSERT INTO club (
                pais_club,
                tipo_pais_club,
                division_club,
                nombre_club,
                entrenador_club
                ) VALUES (
                '".utf8_decode($datos['pais_club_rival_otro'])."',
                '".utf8_decode($tipo_pais_club)."',
                '".utf8_decode($datos['division_club_rival_otro'])."',
                '".utf8_decode($datos['nombre_club_rival_otro'])."',
                '".utf8_decode($datos['entrenador_club_rival_otro'])."'
            )");

            if( $query )  { 
                $idclub = $link->insert_id; // <--- ID del Campeonato recién registrado
                } else {
                $respuesta = $link->error; // Error al ejecutar INSERT...
                // return false; 
            }              

        } else { // <---- El club seleccionado es uno que ha sido previamente registrado en la BD.
            $idclub = $datos['idclub_rival'];
        }

        // Declarando variable que almacenará el valor del ID del Campeonato según sea el caso.
        $idcampeonato = "";
        // ============================ Verificando si el campeonato es uno que ha sido previamente registrado en la BD o el usuario seleccionó 'Otro') ============== //
        if( $datos['idcampeonato'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                    
            // INSERT en la tabla 'campeonato':
            $query = $link->query("INSERT INTO campeonato (
                pais_campeonato,
                division_campeonato,
                nombre_campeonato,
                organizador_campeonato
                ) VALUES (
                '".utf8_decode($datos['pais_campeonato_otro'])."',
                '".utf8_decode($datos['division_campeonato_otro'])."',
                '".utf8_decode($datos['nombre_campeonato_otro'])."',
                '".utf8_decode($datos['organizador_campeonato_otro'])."'
            )");

            if( $query )  { 
                $idcampeonato = $link->insert_id; // <--- ID del Campeonato recién registrado
                } else {
                $respuesta = $link->error; // Error al ejecutar INSERT...
                // return false; 
            }              

        } else { // <---- El club seleccionado es uno que ha sido previamente registrado en la BD.
            $idcampeonato = $datos['idcampeonato'];
        }        


        // Comprobando si el valor es nulo:
        // $idcampeonato = !empty($idclub) ? "'$idcampeonato'" : "NULL";
        // $idclub = !empty($idclub) ? "'$idclub'" : "NULL";
        
        if( $idcampeonato == '' ) {
            $idcampeonato = "NULL";
        } else {
            $idcampeonato = $idcampeonato;
        }
        
        if( $idclub == '' ) {
            $idclub = "NULL";
        } else {
            $idclub = $idclub;
        }        

        // Comprobando si no está establecido la condición:
        if( !isset( $datos['condicion_jugadorpartido'] ) ) {
            $datos['condicion_jugadorpartido'] = '';
        }

        // ----------- Tabla 'fichaJugador_partido' ----------- //
        $query = $link->query("UPDATE fichaJugador_partido SET
            idcampeonato = ".$idcampeonato.",
            idclub = ".$idclub.",
            fecha_jugadorpartido = '".utf8_decode($datos['fecha_jugadorpartido'])."',
            temporada_jugadorpartido = '".utf8_decode($datos['temporada_jugadorpartido'])."',
            jornada_jugadorpartido = '".utf8_decode($datos['jornada_jugadorpartido'])."',
            posicion_jugadorpartido = '".utf8_decode($datos['posicion_jugadorpartido'])."',
            tit_sup_nc_jugadorpartido = '".utf8_decode($datos['tit_sup_nc_jugadorpartido'])."',
            t_amarilla_jugadorpartido = '".utf8_decode($datos['t_amarilla_jugadorpartido'])."',
            t_amarilladb_jugadorpartido = '".utf8_decode($datos['t_amarilladb_jugadorpartido'])."',
            t_roja_jugadorpartido = '".utf8_decode($datos['t_roja_jugadorpartido'])."',
            num_gol_jugadorpartido = '".utf8_decode($datos['num_gol_jugadorpartido'])."',
            min_entrada_jugadorpartido = '".utf8_decode($datos['min_entrada_jugadorpartido'])."',
            min_salida_jugadorpartido = '".utf8_decode($datos['min_salida_jugadorpartido'])."',
            min_jugados_jugadorpartido = '".utf8_decode($datos['min_jugados_jugadorpartido'])."',
            condicion_jugadorpartido = '".utf8_decode($datos['condicion_jugadorpartido'])."',
            gol_equipo1_jugadorpartido = '".utf8_decode($datos['gol_equipo1_jugadorpartido'])."',
            gol_equipo2_jugadorpartido = '".utf8_decode($datos['gol_equipo2_jugadorpartido'])."',
            nombre_usuario_software = '".utf8_decode($datos['nombre_usuario_software'])."',
            fecha_software = '".getDateTime()."'
            WHERE idfichaJugador_partido = '".$idfichaJugador_partido."'     
        ");

        // Si se insertan correctamente los datos en la tabla 'fichaJugador', se procede a insertar datos en la tabla 'fichaJugador_club'
        if( $query )  { 
            $respuesta = 2; // UPDATE ejecutado correctamente.
        } else {
            // Error al insertar datos en la tabla 'fichaJugador'
            $respuesta = $link->error; // Error al ejecutar.                    
        } 

    }
    
    $link->close();
    return $respuesta;

}

// -------------------------------------------------------------------------------------------- //
function guardar_scouting($datos){
    include("conexion.php");
    $respuesta = "";

    // ----------- Tabla 'cscouting_jugador' ----------- //
    $query = $link->query("INSERT INTO cscouting_jugador (
        idfichaJugador_club,
        nombre_usuario_software,
        fecha_software
        ) VALUES (
          '".utf8_decode($datos['idfichaJugador_club'])."',
          '".utf8_decode($datos['nombre_usuario_software'])."',
          '".getDateTime()."'
    )");

    // Si se insertan correctamente los datos en la tabla 'fichaJugador', se procede a insertar datos en la tabla 'fichaJugador_club'
    if( $query )  { 
        $respuesta = 1; // INSERT ejecutado correctamente.
    } else {
        // Error al insertar datos en la tabla 'fichaJugador'
        $respuesta = $link->error; // Error al ejecutar.                    
    }   
            
    $link->close();
    return $respuesta;

}

function eliminar_ficha_jugador($id){
    include("conexion.php");
    $query = $link->query("DELETE FROM fichaJugador WHERE idfichaJugador = ".$id." ");
    if( $query )  { 
        return 1;                   
        $link->close();
    } else {
        return $link->error; // Error al ejecutar UPDATE...                    
        $link->close();
    }      
    
}

function insertIntoFichaJugadorClub(){
    include("conexion.php");
    $query = '';
    // ------- DATOS DEL CLUB ------- //
    $resultado = $link->query("
        SELECT idfichaJugador FROM fichaJugador
    ");

    $array_idfichaJugador = [];
    while($row = mysqli_fetch_assoc($resultado)) {
        $array_idfichaJugador[] = $row['idfichaJugador'];
    }                 

    for( $i=0; $i<count($array_idfichaJugador); $i++ ) {

        $idfichaJugador = $array_idfichaJugador[$i];

        // ----------- Tabla 'fichaJugador_club' ----------- //
        $query = $link->query("INSERT INTO fichaJugador_club (
            idfichaJugador
            ) VALUES (
              '".$idfichaJugador."'
        )");                
    }

    if( $query ) {
        echo "Consulta ejecutada con éxito";
    }  
    
}

function eliminar_partido_jugador($id){
    include("conexion.php");
    $query = $link->query("DELETE FROM fichaJugador_partido WHERE idfichaJugador_partido = ".$id." ");
    if( $query )  { 
        return 1;                   
        $link->close();
    } else {
        return $link->error; // Error al ejecutar UPDATE...                    
        $link->close();
    }      
    
}

function buscar_datosPDF($id){
    include("conexion.php");

    $resultado = $link->query("
        SELECT * FROM cdp_informe_individual
        LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = cdp_informe_individual.idfichaJugador
        LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador  
        WHERE cdp_informe_individual.idcdp_informe_individual = ".$id."        
    ");

     while($row = mysqli_fetch_array($resultado)){ 
        $dato[] = utf8_converter($row);
    }
    
    // var_dump( $dato );
    unset($row);


    $link->close();
    return $dato;
    
}

// insertIntoFichaJugadorClub();

?>