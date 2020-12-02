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

        // ------------------------------------ TODOS LOS JUGADORES DE LA TABLA 'cscouting_jugador'  ------------------------------------ // 
        case 'get_cantidad_jugadores_scouting':
            $resultado = $link->query("
                SELECT COUNT(idcscouting_jugador) FROM cscouting_jugador
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break; 

        // ------------------------------------ TODOS LOS ENTRENADORES DE LA TABLA 'entrenador_club'  ------------------------------------ // 
        case 'get_cantidad_entrenadores_scouting':
            $resultado = $link->query("
                SELECT COUNT(identrenador_club) FROM entrenador_club
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break;             

        // ------------------------------------ EDAD Y ALTURA MÍNIMA Y MÁXIMA DE TODOS LOS JUGADORES EN SEGUIMIENTO ------------------------------------ // 
        case 'get_edadminmax_jugadores_seguimiento':

            $resultado = $link->query("
              SELECT * FROM cscouting_jugador
              -- Datos del jugador y su club:
              LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador_club = cscouting_jugador.idfichaJugador_club
              -- Datos del club:
              LEFT JOIN club ON club.idclub = fichaJugador_club.idclub                
              -- Datos del jugador:
              LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador
              -- Datos de la posición:
              LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador              
              WHERE posicionCancha.numero_posicion = 0
              ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC
            ");

            while($row = mysqli_fetch_assoc($resultado)) {

              $idfichaJugador = $row['idfichaJugador'];

              // Calculando edad y altura mínima y máxima: :
              $resultado_2 = $link->query("
                SELECT 
                fichaJugador.fechaNacimiento
                FROM cscouting_jugador
                -- Datos del jugador y su club:
                LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador_club = cscouting_jugador.idfichaJugador_club
                -- Datos del club:
                LEFT JOIN club ON club.idclub = fichaJugador_club.idclub                
                -- Datos del jugador:
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador
              ");

              $array_edad = [];

              while($row_2 = mysqli_fetch_assoc($resultado_2)) {  
                  // Calculando edad mínima y máxima:    
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
              }

              $min_edad = min($array_edad);
              $max_edad = max($array_edad);
       
              $row['min_edad'] = $min_edad;
              $row['max_edad'] = $max_edad;  

              // Consultando posiciones:
              $resultado_3 = $link->query("
              SELECT 
              posicionCancha.posicion,
              posicionCancha.numero_posicion
              FROM cscouting_jugador
              -- Datos del jugador y su club:
              LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador_club = cscouting_jugador.idfichaJugador_club           
              -- Datos del jugador:
              LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador   
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

        // ------------------------------------ TODOS LOS JUGADORES DE LA TABLA 'cscouting_jugador' ------------------------------------ // 
        case '1':

            $string = $datos['string'];
            $idpais_fbjscouting_main = $datos['idpais_fbjscouting_main'];
            $division_fbjscouting_main = intval( $datos['division_fbjscouting_main'] );
            $idclub_fbjscouting_main = intval( $datos['idclub_fbjscouting_main'] );
            $nacionalidad_fbjscouting_main = $datos['nacionalidad_fbjscouting_main'];
            $range_min_edad_fbjscouting_main = intval( $datos['range_min_edad_fbjscouting_main'] );
            $range_max_edad_fbjscouting_main = intval( $datos['range_max_edad_fbjscouting_main'] );
            $lateralidad_fbjscouting_main = intval( $datos['lateralidad_fbjscouting_main'] );            

            // ----------------------- FILTROS ----------------------- //

            // País donde juega:
            $f_paisclub = '';
            if( $idpais_fbjscouting_main == '0' ) {
              $f_paisclub = "1 = 1";
            } else {
              $f_paisclub = "club.pais_club = '".$idpais_fbjscouting_main."'";
            }

            // División:
            $f_divisionclub = "";
            // 0 = Todos
            if( $division_fbjscouting_main === 0 ) {
                $f_divisionclub = "1 = 1";
            } else {
                $f_divisionclub = "club.division_club = ".$division_fbjscouting_main."";
            }            

            // Club:
            $f_club = "";
            // 0 = Todos
            if( $idclub_fbjscouting_main === 0 ) {
                $f_club = "1 = 1";
            } else {
                $f_club = "club.idclub = ".$idclub_fbjscouting_main."";
            } 

            // nacionalidad1:
            $f_nacionalidad = "";
            // 0 = Todos
            if( $nacionalidad_fbjscouting_main == '0' ) {
                $f_nacionalidad = "1 = 1";
            } else {
                $f_nacionalidad = "fichaJugador.nacionalidad1 = '".$nacionalidad_fbjscouting_main."'";
            }      
            
            // Edad Mínima:
            $f_edadmin = "";
            // 0 = Todos
            if( $range_min_edad_fbjscouting_main === 0 ) {
                $f_edadmin = 0;
            } else {
                $f_edadmin = $range_min_edad_fbjscouting_main;
            }  
               
            // Edad Máxima:
            $f_edadmax = "";
            // 0 = Todos
            if( $range_max_edad_fbjscouting_main === 0 ) {
                $f_edadmax = 99999999999999999;
            } else {
                $f_edadmax = $range_max_edad_fbjscouting_main;
            } 

            // Lateralidad:
            $f_lateralidad = "";
            // 0 = Todos
            if( $lateralidad_fbjscouting_main === 0 ) {
                $f_lateralidad = "1 = 1";
            } else {
                $f_lateralidad = "fichaJugador.dinamico = ".$lateralidad_fbjscouting_main."";
            }                              

            if( $string=='' ) {

              $resultado = $link->query("
                  SELECT * FROM cscouting_jugador
                  -- Datos del jugador y su club:
                  LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador_club = cscouting_jugador.idfichaJugador_club
                  -- Datos del club:
                  LEFT JOIN club ON club.idclub = fichaJugador_club.idclub                
                  -- Datos del jugador:
                  LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador                   
                  -- Datos de la posición:
                  LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador                  
                  -- País donde juega:
                  WHERE ".$f_paisclub."
                  -- División donde juega:
                  AND ".$f_divisionclub." 
                  -- Club donde juega:
                  AND ".$f_club."
                  -- nacionalidad1:                
                  AND ".$f_nacionalidad."  
                  -- Edad del jugador:
                  AND YEAR(CURDATE())-YEAR(fichaJugador.fechaNacimiento) BETWEEN ".$f_edadmin." AND ".$f_edadmax."
                  -- Lateralidad (Dinámico):                
                  AND ".$f_lateralidad."   
                  AND posicionCancha.numero_posicion = 0
                  ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC                                                                               
              "); 

            } else {

              $resultado = $link->query("
                  SELECT * FROM cscouting_jugador
                  -- Datos del jugador y su club:
                  LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador_club = cscouting_jugador.idfichaJugador_club
                  -- Datos del club:
                  LEFT JOIN club ON club.idclub = fichaJugador_club.idclub                
                  -- Datos del jugador:
                  LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador
                  -- Datos de la posición:
                  LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador
                  -- Nombre y Apellido del jugador:
                  WHERE (fichaJugador.nombre LIKE '".$string."%' OR fichaJugador.apellido1 LIKE '".$string."%' OR fichaJugador.apellido2 LIKE '".$string."%')
                  -- País donde juega:
                  AND ".$f_paisclub."
                  -- División donde juega:
                  AND ".$f_divisionclub." 
                  -- Club donde juega:
                  AND ".$f_club."
                  -- nacionalidad1:                
                  AND ".$f_nacionalidad."  
                  -- Edad del jugador:
                  AND YEAR(CURDATE())-YEAR(fichaJugador.fechaNacimiento) BETWEEN ".$f_edadmin." AND ".$f_edadmax."
                  -- Lateralidad (Dinámico):                
                  AND ".$f_lateralidad."       
                  AND posicionCancha.numero_posicion = 0
                  ORDER BY posicionCancha.posicion ASC, fichaJugador.nombre ASC, fichaJugador.apellido1 ASC, fichaJugador.apellido2 ASC                                                                             
              ");          

            }


            while($row = mysqli_fetch_assoc($resultado)) {
                
                $idfichaJugador = $row['idfichaJugador'];

                // Consultando posiciones:
                $resultado_2 = $link->query("
                SELECT 
                posicionCancha.posicion,
                posicionCancha.numero_posicion
                FROM cscouting_jugador
                -- Datos del jugador y su club:
                LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador_club = cscouting_jugador.idfichaJugador_club
                -- Datos del club:
                LEFT JOIN club ON club.idclub = fichaJugador_club.idclub                
                -- Datos del jugador:
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador
                -- Datos de la posición:
                LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador                 
                WHERE posicionCancha.idfichaJugador = ".$idfichaJugador."
                ");

                while($row_2 = mysqli_fetch_assoc($resultado_2)) {  
                    $posicion = $row_2['posicion'];
                    $numero_posicion = $row_2['numero_posicion']; 
                    $row['posicion'.$numero_posicion] = $posicion;                                        
                }

                $dato[] = utf8_converter( $row );
            }                            
            break;

        // ------------------------------------ EDAD Y ALTURA MÍNIMA Y MÁXIMA DE TODOS LOS ENTRENADORES EN SEGUIMIENTO ------------------------------------ // 
        case 'get_edadminmax_entrenadores_seguimiento':

            $resultado = $link->query("
              SELECT * FROM entrenador
              LEFT JOIN entrenador_club ON entrenador_club.identrenador = entrenador.identrenador
              LEFT JOIN club ON club.idclub = entrenador_club.idclub
            ");

            while($row = mysqli_fetch_assoc($resultado)) {

              $resultado_2 = $link->query("
                SELECT 
                entrenador.fecha_nacimiento_entrenador
                FROM entrenador
                LEFT JOIN entrenador_club ON entrenador_club.identrenador = entrenador.identrenador
                LEFT JOIN club ON club.idclub = entrenador_club.idclub
              ");
                
              $array_edad = [];
              while($row_2 = mysqli_fetch_assoc($resultado_2)) {
                  // Calculando edad y altura mínima y máxima:    
                  $edad = '';
                  if( $row_2['fecha_nacimiento_entrenador'] == '0000-00-00' || is_null( $row_2['fecha_nacimiento_entrenador'] ) || $row_2['fecha_nacimiento_entrenador'] == '' ) {
                      $edad = 0;
                  } else {
                      $edad = calcularEdad( $row_2['fecha_nacimiento_entrenador'] );
                      if( $edad < 0 ) {
                          $edad = 0;
                      }                        
                  }
                  $array_edad[] = $edad;
                  
              }
              
              $min_edad = min($array_edad);
              $max_edad = max($array_edad);
         
              $row['min_edad'] = $min_edad;
              $row['max_edad'] = $max_edad;

              $dato[] = utf8_converter( $row );

            }                  

            break;

        // ------------------------------------ TODOS LOS ENTRENADORES DE LA TABLA 'entrenadores_club' ------------------------------------ // 
        case 'buscar_entrenadores_seguimiento':

            $string = $datos['string'];
            $idpais_entrenador_cscouting = $datos['idpais_entrenador_cscouting'];
            $division_entrenador_cscouting = intval( $datos['division_entrenador_cscouting'] );
            $idclub_entrenador_cscouting = intval( $datos['idclub_entrenador_cscouting'] );
            $nacionalidad_entrenador_cscouting = $datos['nacionalidad_entrenador_cscouting'];
            $min_edad_entrenador_cscouting = intval( $datos['min_edad_entrenador_cscouting'] );
            $max_edad_entrenador_cscouting = intval( $datos['max_edad_entrenador_cscouting'] );      

            // ----------------------- FILTROS ----------------------- //

            // País donde juega:
            $f_paisclub = '';
            if( $idpais_entrenador_cscouting == '0' ) {
              $f_paisclub = "1 = 1";
            } else {
              $f_paisclub = "club.pais_club = '".$idpais_entrenador_cscouting."'";
            }

            // División:
            $f_divisionclub = "";
            // 0 = Todos
            if( $division_entrenador_cscouting === 0 ) {
                $f_divisionclub = "1 = 1";
            } else {
                $f_divisionclub = "club.division_club = ".$division_entrenador_cscouting."";
            }            

            // Club:
            $f_club = "";
            // 0 = Todos
            if( $idclub_entrenador_cscouting === 0 ) {
                $f_club = "1 = 1";
            } else {
                $f_club = "club.idclub = ".$idclub_entrenador_cscouting."";
            } 

            // nacionalidad1:
            $f_nacionalidad = "";
            // 0 = Todos
            if( $nacionalidad_entrenador_cscouting == '0' ) {
                $f_nacionalidad = "1 = 1";
            } else {
                $f_nacionalidad = "entrenador.nacionalidad_entrenador = '".$nacionalidad_entrenador_cscouting."'";
            }      
            
            // Edad Mínima:
            $f_edadmin = "";
            // 0 = Todos
            if( $min_edad_entrenador_cscouting === 0 ) {
                $f_edadmin = 0;
            } else {
                $f_edadmin = $min_edad_entrenador_cscouting;
            }  
               
            // Edad Máxima:
            $f_edadmax = "";
            // 0 = Todos
            if( $max_edad_entrenador_cscouting === 0 ) {
                $f_edadmax = 99999999999999999;
            } else {
                $f_edadmax = $max_edad_entrenador_cscouting;
            } 

            if( $string=='' ) {

              $resultado = $link->query("
                  SELECT * FROM entrenador
                  LEFT JOIN entrenador_club ON entrenador_club.identrenador = entrenador.identrenador
                  LEFT JOIN club ON club.idclub = entrenador_club.idclub
                  -- País donde juega:
                  WHERE ".$f_paisclub."
                  -- División donde juega:
                  AND ".$f_divisionclub." 
                  -- Club donde juega:
                  AND ".$f_club."
                  -- nacionalidad1:                
                  AND ".$f_nacionalidad."  
                  -- Edad del jugador:
                  AND YEAR(CURDATE())-YEAR(entrenador.fecha_nacimiento_entrenador) BETWEEN ".$f_edadmin." AND ".$f_edadmax."                                                                             
              "); 

            } else {

              $resultado = $link->query("
                  SELECT * FROM entrenador
                  LEFT JOIN entrenador_club ON entrenador_club.identrenador = entrenador.identrenador
                  LEFT JOIN club ON club.idclub = entrenador_club.idclub
                  -- Nombre y Apellido del jugador:
                  WHERE (entrenador.nombre_entrenador LIKE '".$string."%' OR entrenador.apellido1_entrenador LIKE '".$string."%' OR entrenador.apellido2_entrenador LIKE '".$string."%')
                  -- País donde juega:
                  AND ".$f_paisclub."
                  -- División donde juega:
                  AND ".$f_divisionclub." 
                  -- Club donde juega:
                  AND ".$f_club."
                  -- nacionalidad1:                
                  AND ".$f_nacionalidad."  
                  -- Edad del jugador:
                  AND YEAR(CURDATE())-YEAR(entrenador.fecha_nacimiento_entrenador) BETWEEN ".$f_edadmin." AND ".$f_edadmax."                                                                             
              ");          

            }

            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                            
            break;

        // ------------------------------------ PARTIDOS DE ENTRENADOR - TABLA 'entrenador_partido' ------------------------------------ // 
        case 'buscar_partidos_entrenador':

            $identrenador_club = $datos['identrenador_club'];
            $resultado = $link->query("
                SELECT 
                -- Tabla 'entrenador_partido':
                entrenador_partido.identrenador_partido,
                entrenador_partido.identrenador_club,
                entrenador_partido.fecha_entrenadorpartido,
                entrenador_partido.temporada_entrenadorpartido,
                entrenador_partido.md_entrenadorpartido,
                entrenador_partido.jornada_entrenadorpartido,
                entrenador_partido.tactica_entrenadorpartido,
                entrenador_partido.cond_equipo1_entrenadorpartido,
                entrenador_partido.cond_equipo2_entrenadorpartido,
                entrenador_partido.gol_equipo1_entrenadorpartido,
                entrenador_partido.gol_equipo2_entrenadorpartido,
                entrenador_partido.t_amarilla_entrenadorpartido,
                entrenador_partido.t_amarilladb_entrenadorpartido,
                entrenador_partido.t_roja_entrenadorpartido,
                entrenador_partido.min_jugados_entrenadorpartido,

                -- Tabla 'entrenador':
                entrenador.identrenador,
                entrenador.nombre_entrenador,
                entrenador.apellido1_entrenador,
                entrenador.apellido2_entrenador,
                entrenador.fecha_nacimiento_entrenador,
                entrenador.nacionalidad_entrenador,

                -- Tabla 'entrenador_club':
                entrenador_club.representante_entrenadorclub,
                entrenador_club.fechafin_contrato_entrenadorclub,
                entrenador_club.clausula_salida_entrenadorclub,
                entrenador_club.valor_clausula_entrenadorclub,
                entrenador_club.observaciones_entrenadorclub,

                -- Tabla 'campeonato':
                campeonato.idcampeonato,
                campeonato.pais_campeonato,
                campeonato.nombre_campeonato,

                -- Tabla 't_club_entrenador':
                t_club_entrenador.idclub AS idclub_entrenador, 
                t_club_entrenador.nombre_club AS nombre_club_entrenador,

                -- Tabla 't_club_rival':
                t_club_rival.idclub AS idclub_rival,
                t_club_rival.nombre_club AS nombre_club_rival

                FROM entrenador_partido
                -- Datos del campeonato:
                LEFT JOIN campeonato ON campeonato.idcampeonato = entrenador_partido.idcampeonato
                -- Datos del entrenador y club:
                LEFT JOIN entrenador_club ON entrenador_club.identrenador_club = entrenador_partido.identrenador_club
                -- Datos del entrenador:
                LEFT JOIN entrenador ON entrenador.identrenador = entrenador_club.identrenador
                -- Datos del club del entrenador:
                LEFT JOIN club AS t_club_entrenador ON t_club_entrenador.idclub = entrenador_club.idclub
                -- Datos del club rival:
                LEFT JOIN club AS t_club_rival ON t_club_rival.idclub = entrenador_partido.idclub
                WHERE entrenador_club.identrenador_club = ".$identrenador_club."
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                            
            break;

        // ------------------------------------ CONSULTAR CLUBES SEGÚN PAÍS Y DIVISIÓN SELECCIONADAS  ------------------------------------ // 
        case 'get_clubes_from_paisdivision_entrenador':
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

        // ------------------------------------ CONSULTAR CLUBES SEGÚN PAÍS DEL CAMPEONATO SELECCIONADO (JUGADOR)  ------------------------------------ // 
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

        // ------------------------------------ CONSULTAR CLUBES SEGÚN PAÍS DEL CAMPEONATO SELECCIONADO (ENTRENADOR)  ------------------------------------ // 
        case 'get_clubes_from_paiscampeonato_entrenador':
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

        // ------------------------------------ CONSULTAR CLUBES SEGÚN PAÍS DEL CAMPEONATO SELECCIONADO (INFORME DE PARTIDO SCOUTING)  ------------------------------------ // 
        case 'get_clubes_from_paiscampeonato_icsjp':
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

        // ------------------------------------ TODOS LOS INFORMES DE UN DETERMINADO JUGADOR - TABLA 'informe_cscouting_jugador' ------------------------------------ // 
        case 'buscar_informes_jugador':

            $idcscouting_jugador = $datos['idcscouting_jugador'];
            $resultado = $link->query("
                SELECT 
                -- Tabla 'informe_cscouting_jugador':
                informe_cscouting_jugador.idinforme_cscouting_jugador,
                informe_cscouting_jugador.idcscouting_jugador,
                informe_cscouting_jugador.fecha_icsj,
                informe_cscouting_jugador.nombre_icsj,
                informe_cscouting_jugador.tipo_informe_icsj,
                informe_cscouting_jugador.recomendacion_icsj,
                informe_cscouting_jugador.realizado_por_icsj,

                -- Tabla 'video_informe_cscouting_jugador':
                video_informe_cscouting_jugador.fecha_video,
                video_informe_cscouting_jugador.servidor_video,
                video_informe_cscouting_jugador.titulo_video,
                video_informe_cscouting_jugador.link_video,
                video_informe_cscouting_jugador.categoria_video,
                video_informe_cscouting_jugador.sub_categoria_video,

                -- Tabla 'informe_csj_general':
                informe_csj_general.idinforme_csj_general,
                informe_csj_general.aspct_tecnico_icsjg,
                informe_csj_general.aspct_tactico_icsjg,
                informe_csj_general.aspct_fisico_icsjg,
                informe_csj_general.aspct_psico_icsjg,
                informe_csj_general.resumen_obsrv_icsjg,
                informe_csj_general.sugerencias_icsjg,
                informe_csj_general.proyeccion_icsjg,
                informe_csj_general.exportacion_icsjg,

                -- Tabla 'informe_csj_partido':
                informe_csj_partido.idinforme_csj_partido,
                informe_csj_partido.idcampeonato,
                informe_csj_partido.idclub,
                informe_csj_partido.fecha_icsjp,
                informe_csj_partido.temporada_icsjp,
                informe_csj_partido.jornada_icsjp,
                informe_csj_partido.posicion_icsjp,
                informe_csj_partido.tit_sup_nc_icsjp,
                informe_csj_partido.t_amarilla_icsjp,
                informe_csj_partido.t_amarilladb_icsjp,
                informe_csj_partido.t_roja_icsjp,
                informe_csj_partido.num_gol_icsjp,
                informe_csj_partido.min_entrada_icsjp,
                informe_csj_partido.min_salida_icsjp,
                informe_csj_partido.min_jugados_icsjp,
                informe_csj_partido.condicion_icsjp,
                informe_csj_partido.golequipo1_icsjp,
                informe_csj_partido.golequipo2_icsjp,
                informe_csj_partido.aspct_ofen_icsjp,
                informe_csj_partido.aspct_def_icsjp,
                informe_csj_partido.aspct_fisico_icsjp,
                informe_csj_partido.observaciones_generales_icsjp,

                -- Datos del jugador:
                fichaJugador.nombre,
                fichaJugador.apellido1,
                fichaJugador.apellido2,  

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
                t_club_rival.nombre_club AS nombre_club_rival   

                FROM informe_cscouting_jugador
                -- Vídeo
                LEFT JOIN video_informe_cscouting_jugador ON video_informe_cscouting_jugador.idinforme_cscouting_jugador = informe_cscouting_jugador.idinforme_cscouting_jugador
                -- Datos del Informe de Tipo 'General'
                LEFT JOIN informe_csj_general ON informe_csj_general.idinforme_cscouting_jugador = informe_cscouting_jugador.idinforme_cscouting_jugador
                -- Datos del Informe de Tipo 'Partido'
                LEFT JOIN informe_csj_partido ON informe_csj_partido.idinforme_cscouting_jugador = informe_cscouting_jugador.idinforme_cscouting_jugador
                -- Datos del campeonato:
                LEFT JOIN campeonato ON campeonato.idcampeonato = informe_csj_partido.idcampeonato
                -- Datos Scouting:
                LEFT JOIN cscouting_jugador ON cscouting_jugador.idcscouting_jugador = informe_cscouting_jugador.idcscouting_jugador
                -- Datos del jugador y club:
                LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador_club = cscouting_jugador.idfichaJugador_club
                -- Datos del jugador:
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador                    
                -- Datos del club del jugador:
                LEFT JOIN club AS t_club_jugador ON t_club_jugador.idclub = fichaJugador_club.idclub
                -- Datos del club rival:
                LEFT JOIN club AS t_club_rival ON t_club_rival.idclub = informe_csj_partido.idclub
                WHERE cscouting_jugador.idcscouting_jugador = ".$idcscouting_jugador."
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                
              $idinforme_cscouting_jugador = $row['idinforme_cscouting_jugador'];

              // Consultando estadísticas:
              $resultado_2 = $link->query("
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

            }                            
            break; 

        // ------------------------------------ TODOS LOS INFORMES DE UN DETERMINADO JUGADOR - TABLA 'informe_cscouting_jugador' ------------------------------------ // 
        case 'ver_estadisticas_informe':

            $idinforme_cscouting_jugador = $datos['idinforme_cscouting_jugador'];
            $resultado = $link->query("
              SELECT * FROM estadistica_informe_csj
              -- Tabla 'informe_cscouting_jugador':
              LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = estadistica_informe_csj.idinforme_cscouting_jugador
              WHERE estadistica_informe_csj.idinforme_cscouting_jugador = ".$idinforme_cscouting_jugador."
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
              $dato[] = utf8_converter( $row );
            }                            
            break;             

        // ------------------------------------ TODOS LOS INFORMES DE PARTIDO UN DETERMINADO JUGADOR - TABLA 'informe_cscouting_jugador' ------------------------------------ // 
        case 'buscar_informes_partido_jugador':

            $idcscouting_jugador = $datos['idcscouting_jugador'];
            // ------- DATOS DEL CLUB ------- //
            $resultado = $link->query("
            SELECT  
                -- Tabla 'informe_csj_partido':
                informe_csj_partido.fecha_icsjp,
                informe_csj_partido.condicion_icsjp,
                informe_csj_partido.tit_sup_nc_icsjp,
                informe_csj_partido.min_jugados_icsjp,
                informe_csj_partido.t_amarilla_icsjp,
                informe_csj_partido.t_roja_icsjp,
                informe_csj_partido.t_amarilladb_icsjp,
                informe_csj_partido.golequipo1_icsjp,
                informe_csj_partido.golequipo2_icsjp,
                informe_csj_partido.num_gol_icsjp,

                -- Tabla 't_club_jugador':
                t_club_jugador.idclub AS idclub_jugador,
                t_club_jugador.nombre_club AS nombre_club_jugador,

                -- Tabla 't_club_rival':
                t_club_rival.idclub AS idclub_rival,
                t_club_rival.nombre_club AS nombre_club_rival,

                -- Tabla 'fichaJugador':
                fichaJugador.serieActual

              FROM informe_csj_partido
              -- Tabla 'informe_cscouting_jugador'
              LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = informe_csj_partido.idinforme_cscouting_jugador
              -- Datos Scouting
              LEFT JOIN cscouting_jugador ON cscouting_jugador.idcscouting_jugador = informe_cscouting_jugador.idcscouting_jugador          
              -- Datos de la relación club-jugador:
              LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador_club = cscouting_jugador.idfichaJugador_club
              -- Datos del jugador:
              LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador
              -- Datos del club del jugador:
              LEFT JOIN club AS t_club_jugador ON t_club_jugador.idclub = fichaJugador_club.idclub
              -- Datos del club rival:
              LEFT JOIN club AS t_club_rival ON t_club_rival.idclub = informe_csj_partido.idclub
              WHERE informe_cscouting_jugador.idcscouting_jugador = ".$idcscouting_jugador."                                     
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                            
            break;                        

    }

    $link->close();
    return $dato;       
    
}

/* --------------------------------------------- Inicio de la función 'guardar_ficha_jugador' --------------------------------------------- */
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

                // Si se insertan correctamente los datos en la tabla 'fichaJugador_club', se procede a insertar datos en la tabla 'cscouting_jugador':
                if( $query )  {

                  // Valor del 'fichaJugador_club.idfichaJugador_club' recién insertado:
                  $idfichaJugador_club = $link->insert_id;                  

                  // Insertando en la tabla 'cscouting_jugador'
                  // ----------- Tabla 'cscouting_jugador' ----------- //
                  $query = $link->query("INSERT INTO cscouting_jugador (
                    idfichaJugador_club,
                    nombre_usuario_software,
                    fecha_software
                    ) VALUES (
                      '".utf8_decode($idfichaJugador_club)."',
                      '".utf8_decode($datos['nombre_usuario_software'])."',
                      '".getDateTime()."'
                  )");                  

                  // Si se insertan correctamente los datos en la tabla 'cscouting_jugador', el proceso finaliza y se muestra el mensaje de éxito:
                  if( $query ) {
                    $respuesta = 1; // INSERT ejecutado correctamente.
                  } else {
                    // Error al insertar datos en la tabla 'cscouting_jugador'
                    $respuesta = $link->error; // Error al ejecutar.                       
                  }

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
/* --------------------------------------------- Fin de la función 'guardar_ficha_jugador' --------------------------------------------- */


/* --------------------------------------------- Inicio de la función 'guardar_partido_jugador' --------------------------------------------- */
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
/* --------------------------------------------- Fin de la función 'guardar_partido_jugador' --------------------------------------------- */

/* --------------------------------------------- Inicio de la función 'guardar' --------------------------------------------- */
function guardar($datos){
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

    if($datos['idinforme_cscouting_jugador']==''){
        // INSERT:
        
        // Comprobando si no está establecido la recomendación (radio-button):
        if( !isset( $datos['recomendacion_icsj'] ) ) {
            $datos['recomendacion_icsj'] = '';
        }

        // INSERT en tabla 'informe_cscouting_jugador':
        $query = $link->query("INSERT INTO informe_cscouting_jugador (
            idcscouting_jugador,
            fecha_icsj,
            nombre_icsj,
            tipo_informe_icsj,
            recomendacion_icsj,
            realizado_por_icsj,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
              ".utf8_decode($datos['idcscouting_jugador']).",
              '".utf8_decode($datos['fecha_icsj'])."',
              '".utf8_decode($datos['nombre_icsj'])."',
              '".utf8_decode($datos['tipo_informe_icsj'])."',
              '".utf8_decode($datos['recomendacion_icsj'])."',
              '".utf8_decode($datos['nombre_usuario_software'])."',
              '".utf8_decode($datos['nombre_usuario_software'])."',
              '".getDateTime()."'
        )");

        /*
        Si los datos en la tabla 'informe_cscouting_jugador' son insertados correctamente, se procede a insertar o las posibles dos tablas:
            - informe_csj_general
            - informe_csj_partido
        */  
        if( $query )  { 

            $idinforme_cscouting_jugador = $link->insert_id; // <--- Valor del campo 'idinforme_cscouting_jugador' que fue generado en la consulta anterior:                
            
            // INSERT en tabla 'video_informe_cscouting_jugador':
            $query = $link->query("INSERT INTO video_informe_cscouting_jugador (
                idinforme_cscouting_jugador,
                fecha_video,
                servidor_video,
                titulo_video,
                link_video,
                categoria_video,
                sub_categoria_video
                ) VALUES (
                  ".$idinforme_cscouting_jugador.",
                  '".utf8_decode($datos['fecha_video'])."',
                  '".utf8_decode($datos['servidor_video'])."',
                  '".utf8_decode($datos['titulo_video'])."',
                  '".utf8_decode($datos['link_video'])."',
                  '".utf8_decode($datos['categoria_video'])."',
                  '".utf8_decode($datos['sub_categoria_video'])."'
            )");

            // Si se insertan correctamente los datos en la tabla 'video_informe_cscouting_jugador' se procede a verificar el tipo de informe seleccionado:
            if( $query ) {

              // Verificando el tipo de informe seleccionado:
              $tipo_informe_icsj = intval( $datos['tipo_informe_icsj'] );
              
              if( $tipo_informe_icsj === 1 ) { // <---- INFORME GENERAL ('informe_cscouting_jugador.tipo_informe_icsj' = 1):
                  // Se insertan datos en la tabla 'informe_csj_general':
                  $query = $link->query("INSERT INTO informe_csj_general (
                      idinforme_cscouting_jugador,
                      aspct_tecnico_icsjg,
                      aspct_tactico_icsjg,
                      aspct_fisico_icsjg,
                      aspct_psico_icsjg,
                      resumen_obsrv_icsjg,
                      sugerencias_icsjg,
                      proyeccion_icsjg,
                      exportacion_icsjg
                      ) VALUES (
                        ".$idinforme_cscouting_jugador.",
                        '".utf8_decode($datos['aspct_tecnico_icsjg'])."',
                        '".utf8_decode($datos['aspct_tactico_icsjg'])."',
                        '".utf8_decode($datos['aspct_fisico_icsjg'])."',
                        '".utf8_decode($datos['aspct_psico_icsjg'])."',
                        '".utf8_decode($datos['resumen_obsrv_icsjg'])."',
                        '".utf8_decode($datos['sugerencias_icsjg'])."',
                        '".utf8_decode($datos['proyeccion_icsjg'])."',
                        '".utf8_decode($datos['exportacion_icsjg'])."'
                  )");

                  if( $query )  { 

                    // Comprobando si se han ingresado estadísticas:
                    if( isset( $datos['descripcion_estadistica_icsj_insert'] ) ) {

                      // -------------- Insertando datos en la tabla 'estadistica_informe_csj' -------------- //
                      for($i=0; $i < count( $datos['descripcion_estadistica_icsj_insert'] ); $i++) {

                        $descripcion_estadistica_icsj = $datos['descripcion_estadistica_icsj_insert'][$i];
                        $valor_estadistica_icsj = $datos['valor_estadistica_icsj_insert'][$i];

                        $query = $link->query("INSERT INTO estadistica_informe_csj (
                            idinforme_cscouting_jugador,
                            descripcion_estadistica_icsj,
                            valor_estadistica_icsj
                        ) VALUES (
                            ".$idinforme_cscouting_jugador.",
                            '".utf8_decode($descripcion_estadistica_icsj)."',
                            '".utf8_decode($valor_estadistica_icsj)."'
                        )");
                      }    

                      if( $query ) {
                        $respuesta = 1; // INSERT ejecutado correctamente.
                      } else {
                        $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'estadistica_informe_csj')...
                      }

                    } else {
                      $respuesta = 1; // INSERT ejecutado correctamente.
                    } 

                  } else {
                      $respuesta = $link->error; // Error al ejecutar UPDATE...                    
                  } 

              } else { // <---- INFORME DE PARTIDO ('informe_cscouting_jugador.tipo_informe_icsj' = 2):
                  // Se insertan datos en la tabla 'idinforme_csj_partido':


                  // Declarando variable que almacenará el valor del ID del Campeonato según sea el caso.
                  $idcampeonato = "";

                  // ============================ Verificando si el campeonato es uno que ha sido previamente registrado en la BD o es nuevo (el usuario seleccionó 'Otro') ============== //
                  if( $datos['idcampeonato_icsjp'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                      // INSERT en la tabla 'campeonato':
                      $query = $link->query("INSERT INTO campeonato (
                          pais_campeonato,
                          nombre_campeonato,
                          division_campeonato,
                          organizador_campeonato,
                          nombre_usuario_software,
                          fecha_software
                          ) VALUES (
                            '".utf8_decode($datos['pais_campeonato_otro_icsjp'])."',
                            '".utf8_decode($datos['nombre_campeonato_otro_icsjp'])."',
                            '".utf8_decode($datos['division_campeonato_otro_icsjp'])."',
                            '".utf8_decode($datos['organizador_campeonato_otro_icsjp'])."',
                            '".utf8_decode($datos['nombre_usuario_software'])."',
                            '".getDateTime()."'
                      )");

                      if( $query )  { 
                          $idcampeonato = $link->insert_id; // <--- ID del Campeonato recién registrado
                      } else {
                          $respuesta = $link->error; // Error al ejecutar INSERT... 
                          return false;
                      }              
                      

                  } else { // <---- El campeonato seleccionado es uno que ha sido previamente registrado en la BD.
                      $idcampeonato = $datos['idcampeonato_icsjp'];
                  }

                  // Declarando variable que almacenará el valor del ID del Club según sea el caso.
                  $idclub = "";
                  // ============================ Verificando si el club es uno que ha sido previamente registrado en la BD o es nuevo (el usuario seleccionó 'Otro') ============== //
                  if( $datos['idclub_rival_icsjp'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                      
                      $tipo_pais_club = '';
                      if( in_array( $datos['pais_club_rival_otro_icsjp'], $array_paises ) ) {
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
                            '".utf8_decode($datos['pais_club_rival_otro_icsjp'])."',
                            '".utf8_decode($tipo_pais_club)."',
                            '".utf8_decode($datos['division_club_rival_otro_icsjp'])."',
                            '".utf8_decode($datos['nombre_club_rival_otro_icsjp'])."',
                            '".utf8_decode($datos['entrenador_club_rival_otro_icsjp'])."'
                      )");

                      if( $query )  { 
                          $idclub = $link->insert_id; // <--- ID del Campeonato recién registrado
                      } else {
                          $respuesta = $link->error; // Error al ejecutar INSERT...
                          return false;
                      }              
                      

                  } else { // <---- El campeonato seleccionado es uno que ha sido previamente registrado en la BD.
                      $idclub = $datos['idclub_rival_icsjp'];
                  }                

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
                  if( !isset( $datos['condicion_icsjp'] ) ) {
                      $datos['condicion_icsjp'] = '';
                  }

                  $query = $link->query("INSERT INTO informe_csj_partido (
                      idinforme_cscouting_jugador,
                      idcampeonato,
                      idclub,
                      fecha_icsjp,
                      temporada_icsjp,
                      jornada_icsjp,
                      posicion_icsjp,
                      tit_sup_nc_icsjp,
                      t_amarilla_icsjp,
                      t_amarilladb_icsjp,
                      t_roja_icsjp,
                      num_gol_icsjp,
                      min_entrada_icsjp,
                      min_salida_icsjp,
                      min_jugados_icsjp,
                      condicion_icsjp,
                      golequipo1_icsjp,
                      golequipo2_icsjp,
                      observaciones_generales_icsjp,
                      aspct_ofen_icsjp,
                      aspct_def_icsjp,
                      aspct_fisico_icsjp
                      ) VALUES (
                        ".$idinforme_cscouting_jugador.",
                        ".$idcampeonato.",
                        ".$idclub.",
                        '".utf8_decode($datos['fecha_icsjp'])."',
                        '".utf8_decode($datos['temporada_icsjp'])."',
                        '".utf8_decode($datos['jornada_icsjp'])."',
                        '".utf8_decode($datos['posicion_icsjp'])."',
                        '".utf8_decode($datos['tit_sup_nc_icsjp'])."',
                        '".utf8_decode($datos['t_amarilla_icsjp'])."',
                        '".utf8_decode($datos['t_amarilladb_icsjp'])."',
                        '".utf8_decode($datos['t_roja_icsjp'])."',
                        '".utf8_decode($datos['num_gol_icsjp'])."',
                        '".utf8_decode($datos['min_entrada_icsjp'])."',
                        '".utf8_decode($datos['min_salida_icsjp'])."',
                        '".utf8_decode($datos['min_jugados_icsjp'])."',
                        '".utf8_decode($datos['condicion_icsjp'])."',
                        '".utf8_decode($datos['golequipo1_icsjp'])."',
                        '".utf8_decode($datos['golequipo2_icsjp'])."',
                        '".utf8_decode($datos['observaciones_generales_icsjp'])."',
                        '".utf8_decode($datos['aspct_ofen_icsjp'])."',
                        '".utf8_decode($datos['aspct_def_icsjp'])."',
                        '".utf8_decode($datos['aspct_fisico_icsjp'])."'
                  )");


                  $sql_debugging = "INSERT INTO informe_csj_partido (
                      idinforme_cscouting_jugador,
                      idcampeonato,
                      idclub,
                      fecha_icsjp,
                      temporada_icsjp,
                      jornada_icsjp,
                      posicion_icsjp,
                      tit_sup_nc_icsjp,
                      t_amarilla_icsjp,
                      t_amarilladb_icsjp,
                      t_roja_icsjp,
                      num_gol_icsjp,
                      min_entrada_icsjp,
                      min_salida_icsjp,
                      min_jugados_icsjp,
                      condicion_icsjp,
                      golequipo1_icsjp,
                      golequipo2_icsjp,
                      observaciones_generales_icsjp,
                      aspct_ofen_icsjp,
                      aspct_def_icsjp,
                      aspct_fisico_icsjp
                      ) VALUES (
                        ".$idinforme_cscouting_jugador.",
                        ".$idcampeonato.",
                        ".$idclub.",
                        '".utf8_decode($datos['fecha_icsjp'])."',
                        '".utf8_decode($datos['temporada_icsjp'])."',
                        '".utf8_decode($datos['jornada_icsjp'])."',
                        '".utf8_decode($datos['posicion_icsjp'])."',
                        '".utf8_decode($datos['tit_sup_nc_icsjp'])."',
                        '".utf8_decode($datos['t_amarilla_icsjp'])."',
                        '".utf8_decode($datos['t_amarilladb_icsjp'])."',
                        '".utf8_decode($datos['t_roja_icsjp'])."',
                        '".utf8_decode($datos['num_gol_icsjp'])."',
                        '".utf8_decode($datos['min_entrada_icsjp'])."',
                        '".utf8_decode($datos['min_salida_icsjp'])."',
                        '".utf8_decode($datos['min_jugados_icsjp'])."',
                        '".utf8_decode($datos['condicion_icsjp'])."',
                        '".utf8_decode($datos['golequipo1_icsjp'])."',
                        '".utf8_decode($datos['golequipo2_icsjp'])."',
                        '".utf8_decode($datos['observaciones_generales_icsjp'])."',
                        '".utf8_decode($datos['aspct_ofen_icsjp'])."',
                        '".utf8_decode($datos['aspct_def_icsjp'])."',
                        '".utf8_decode($datos['aspct_fisico_icsjp'])."'
                  )";

                  if( $query )  { 
                    
                    // Comprobando si se han ingresado estadísticas:
                    if( isset( $datos['descripcion_estadistica_icsj_insert'] ) ) {

                      // -------------- Insertando datos en la tabla 'estadistica_informe_csj' -------------- //
                      for($i=0; $i < count( $datos['descripcion_estadistica_icsj_insert'] ); $i++) {

                        $descripcion_estadistica_icsj = $datos['descripcion_estadistica_icsj_insert'][$i];
                        $valor_estadistica_icsj = $datos['valor_estadistica_icsj_insert'][$i];

                        $query = $link->query("INSERT INTO estadistica_informe_csj (
                            idinforme_cscouting_jugador,
                            descripcion_estadistica_icsj,
                            valor_estadistica_icsj
                        ) VALUES (
                            ".$idinforme_cscouting_jugador.",
                            '".utf8_decode($descripcion_estadistica_icsj)."',
                            '".utf8_decode($valor_estadistica_icsj)."'
                        )");
                      }    

                      if( $query ) {
                        $respuesta = 1; // INSERT ejecutado correctamente.
                      } else {
                        $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'estadistica_informe_csj')...
                      }

                    } else {
                      $respuesta = 1; // INSERT ejecutado correctamente.
                    }

                  } else {
                      $respuesta = $link->error; // Error al ejecutar INSERT...
                      //  $respuesta = $sql_debugging; // Error al ejecutar INSERT...  
                      // echo $query;                  
                  }
              }

            } else {
                $respuesta = $link->error; // Error al ejecutar INSERT...              
            }

        } else {
            $respuesta = $link->error; // Error al ejecutar INSERT...                    
        }   
      
    // =========================================================================================================== //
    } else {
        // UPDATE:

        $idinforme_cscouting_jugador = $datos['idinforme_cscouting_jugador']; // <--- Valor del campo 'idinforme_cscouting_jugador' a editar.                

        // Comprobando si no está establecido la recomendación (radio-button):
        if( !isset( $datos['recomendacion_icsj'] ) ) {
            $datos['recomendacion_icsj'] = '';
        }

        // UPDATE en tabla 'informe_cscouting_jugador':
        $query = $link->query("UPDATE informe_cscouting_jugador SET 
            idcscouting_jugador = ".utf8_decode($datos['idcscouting_jugador']).",
            fecha_icsj = '".utf8_decode($datos['fecha_icsj'])."',
            nombre_icsj = '".utf8_decode($datos['nombre_icsj'])."',
            tipo_informe_icsj = '".utf8_decode($datos['tipo_informe_icsj'])."',
            recomendacion_icsj = '".utf8_decode($datos['recomendacion_icsj'])."',
            realizado_por_icsj = '".utf8_decode($datos['nombre_usuario_software'])."',
            nombre_usuario_software = '".utf8_decode($datos['nombre_usuario_software'])."',
            fecha_software = '".getDateTime()."'
            WHERE idinforme_cscouting_jugador = ".$idinforme_cscouting_jugador."
        ");

        /*
        Si los datos en la tabla 'informe_cscouting_jugador' son modificados correctamente, se procede a modificar o las posibles dos tablas:
            - informe_csj_general
            - informe_csj_partido
        */  
        if( $query )  { 

            // UPDATE en tabla 'video_informe_cscouting_jugador':
            $query = $link->query("UPDATE video_informe_cscouting_jugador SET
                fecha_video = '".utf8_decode($datos['fecha_video'])."',
                servidor_video = '".utf8_decode($datos['servidor_video'])."',
                titulo_video = '".utf8_decode($datos['titulo_video'])."',
                link_video = '".utf8_decode($datos['link_video'])."',
                categoria_video = '".utf8_decode($datos['categoria_video'])."',
                sub_categoria_video = '".utf8_decode($datos['sub_categoria_video'])."'
                WHERE idinforme_cscouting_jugador = ".$idinforme_cscouting_jugador."
            ");

            // Si se modifican correctamente los datos en la tabla 'video_informe_cscouting_jugador', se procede a verificar el tipo de informe selccionado
            if( $query )  {

                $idinforme_csj_general = $datos['idinforme_csj_general'];
                $idinforme_csj_partido = $datos['idinforme_csj_partido'];

                // Verificando el tipo de informe seleccionado:
                $tipo_informe_icsj = intval( $datos['tipo_informe_icsj'] );
                    
                if( $tipo_informe_icsj === 1 ) { // <---- INFORME GENERAL ('informe_cscouting_jugador.tipo_informe_icsj' = 1):
                    // Se insertan datos en la tabla 'informe_csj_general':
                    
                    // Verificamos si es un informe que existe o nuevo (informe de PARTIDO cambiado a uno GENERAL):
                    if( $idinforme_csj_general == 'null' ) {
                      // Se insertan datos en la tabla 'informe_csj_general':
                      $query = $link->query("INSERT INTO informe_csj_general (
                          idinforme_cscouting_jugador,
                          aspct_tecnico_icsjg,
                          aspct_tactico_icsjg,
                          aspct_fisico_icsjg,
                          aspct_psico_icsjg,
                          resumen_obsrv_icsjg,
                          sugerencias_icsjg,
                          proyeccion_icsjg,
                          exportacion_icsjg
                          ) VALUES (
                            ".$idinforme_cscouting_jugador.",
                            '".utf8_decode($datos['aspct_tecnico_icsjg'])."',
                            '".utf8_decode($datos['aspct_tactico_icsjg'])."',
                            '".utf8_decode($datos['aspct_fisico_icsjg'])."',
                            '".utf8_decode($datos['aspct_psico_icsjg'])."',
                            '".utf8_decode($datos['resumen_obsrv_icsjg'])."',
                            '".utf8_decode($datos['sugerencias_icsjg'])."',
                            '".utf8_decode($datos['proyeccion_icsjg'])."',
                            '".utf8_decode($datos['exportacion_icsjg'])."'
                      )");
                    } else {
                      // Se Modifican datos en la tabla 'informe_csj_general':
                      $query = $link->query("UPDATE informe_csj_general SET 
                          aspct_tecnico_icsjg = '".utf8_decode($datos['aspct_tecnico_icsjg'])."',
                          aspct_tactico_icsjg = '".utf8_decode($datos['aspct_tactico_icsjg'])."',
                          aspct_fisico_icsjg = '".utf8_decode($datos['aspct_fisico_icsjg'])."',
                          aspct_psico_icsjg = '".utf8_decode($datos['aspct_psico_icsjg'])."',
                          resumen_obsrv_icsjg = '".utf8_decode($datos['resumen_obsrv_icsjg'])."',
                          sugerencias_icsjg = '".utf8_decode($datos['sugerencias_icsjg'])."',
                          proyeccion_icsjg = '".utf8_decode($datos['proyeccion_icsjg'])."',
                          exportacion_icsjg = '".utf8_decode($datos['exportacion_icsjg'])."'
                          WHERE idinforme_csj_general = ".$idinforme_csj_general."
                      ");
                    }

                    if( $query ) { 

                      // -------------------------- INICIO DE CONSULTAS PARA ESTADÍSTICAS --------------------------  //
                      // Estatus de la consultas de estadísticas:
                      $status_query_estadisticas = "";                      
                      // Comprobando si se han ingresado estadísticas para insertar:
                      if( isset( $datos['descripcion_estadistica_icsj_insert'] ) ) {

                        // -------------- Insertando datos en la tabla 'estadistica_informe_csj' -------------- //
                        for($i=0; $i < count( $datos['descripcion_estadistica_icsj_insert'] ); $i++) {

                          $descripcion_estadistica_icsj = $datos['descripcion_estadistica_icsj_insert'][$i];
                          $valor_estadistica_icsj = $datos['valor_estadistica_icsj_insert'][$i];

                          $query = $link->query("INSERT INTO estadistica_informe_csj (
                              idinforme_cscouting_jugador,
                              descripcion_estadistica_icsj,
                              valor_estadistica_icsj
                          ) VALUES (
                              ".$idinforme_cscouting_jugador.",
                              '".utf8_decode($descripcion_estadistica_icsj)."',
                              '".utf8_decode($valor_estadistica_icsj)."'
                          )");
                        }    

                        if( $query ) {
                          $status_query_estadisticas = true;
                        } else {
                          $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'estadistica_informe_csj')...
                        }

                      } else {
                        $status_query_estadisticas = true;
                      }

                      // MODIFICAR STATS:
                      // Comprobando si se han ingresado estadísticas para modificar:
                      if( isset( $datos['idestadistica_informe_csj_update'] ) ) {

                        // -------------- Modificando datos en la tabla 'estadistica_informe_csj' -------------- //
                        for($i=0; $i < count( $datos['idestadistica_informe_csj_update'] ); $i++) {

                          $idestadistica_informe_csj = $datos['idestadistica_informe_csj_update'][$i];
                          $descripcion_estadistica_icsj = $datos['descripcion_estadistica_icsj_update'][$i];
                          $valor_estadistica_icsj = $datos['valor_estadistica_icsj_update'][$i];

                          $query = $link->query("UPDATE estadistica_informe_csj SET 
                              descripcion_estadistica_icsj = '".utf8_decode($descripcion_estadistica_icsj)."', 
                              valor_estadistica_icsj = '".utf8_decode($valor_estadistica_icsj)."'
                              WHERE idestadistica_informe_csj = ".$idestadistica_informe_csj."
                          ");
                        }    

                        if( $query ) {
                          $status_query_estadisticas = true;
                        } else {
                          $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'estadistica_informe_csj')...
                        }

                      } else {
                        $status_query_estadisticas = true;
                      }                      

                      // -------------------------- FIN DE CONSULTAS PARA ESTADÍSTICAS --------------------------  //

                      // Si todo va bien con las consultas de estadísticas...
                      if( $status_query_estadisticas === true ) {

                        // INFORME GENERAL: Ahora se debe verificar si existe o no un registro en la tabla 'informe_csj_partido' asociado al $idinforme_cscouting_jugador para eliminarlo/ejecutar sentencia DELETE:

                        // Si el valor de la variable $idinforme_csj_partido no está vacía significa que SÍ existe un registro en el campo 'informe_csj_partido' asociado al $idinforme_cscouting_jugador. Dicho registro será eliminado:

                        if( $idinforme_csj_partido != 'null' ) {

                          // ELIMINANDO VÍDEOS ASOCIADOS AL INFORME DE PARTIDO QUE DE DESEA ELIMINAR (tabla 'video_informe_cscouting_jugador'):
                          $query = $link->query("
                                DELETE FROM video_informe_cscouting_jugador WHERE idinforme_cscouting_jugador = ".$idinforme_cscouting_jugador."   
                          ");

                          if( $query )  {
                          
                            // INSERT en tabla 'video_informe_cscouting_jugador':
                            $query = $link->query("INSERT INTO video_informe_cscouting_jugador (
                                idinforme_cscouting_jugador,
                                fecha_video,
                                servidor_video,
                                titulo_video,
                                link_video,
                                categoria_video,
                                sub_categoria_video
                                ) VALUES (
                                  ".$idinforme_cscouting_jugador.",
                                  '".utf8_decode($datos['fecha_video'])."',
                                  '".utf8_decode($datos['servidor_video'])."',
                                  '".utf8_decode($datos['titulo_video'])."',
                                  '".utf8_decode($datos['link_video'])."',
                                  '".utf8_decode($datos['categoria_video'])."',
                                  '".utf8_decode($datos['sub_categoria_video'])."'
                            )");                        
                            
                            if( $query ) {
                              // ELIMINANDO EL INFORME DE PARTIDO (tabla 'informe_csj_partido'):
                              $query = $link->query("
                                  DELETE FROM informe_csj_partido WHERE idinforme_csj_partido = ".$idinforme_csj_partido."   
                              ");                  
                              
                              if( $query )  {
                                $respuesta = 2; // DELETE ejecutado correctamente (tabla 'informe_csj_partido').  
                              } else {
                                $respuesta = $link->error; // Error al ejecutar DELETE (tabla 'informe_csj_partido')...
                              }
                              
                            } else {
                              $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'video_informe_cscouting_jugador')...
                            }

                          } else {
                              $respuesta = $link->error; // Error al ejecutar DELETE en la tabla 'video_informe_cscouting_jugador'...
                          }


                        } else {
                            $respuesta = 2; // UPDATE/INSERT ejecutado correctamente.
                        }

                      }

                    
                    } else {
                        $respuesta = $link->error; // Error al ejecutar UPDATE...                    
                    } 

                } else { // <---- INFORME DE PARTIDO ('informe_cscouting_jugador.tipo_informe_icsj' = 2):
                    
                    // Se insertan datos en la tabla 'idinforme_csj_partido':

                    // Declarando variable que almacenará el valor del ID del Campeonato según sea el caso.
                    $idcampeonato = "";

                    // ============================ Verificando si el campeonato es uno que ha sido previamente registrado en la BD o es nuevo (el usuario seleccionó 'Otro') ============== //
                    if( $datos['idcampeonato_icsjp'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                        // INSERT en la tabla 'campeonato':
                        $query = $link->query("INSERT INTO campeonato (
                            pais_campeonato,
                            nombre_campeonato,
                            division_campeonato,
                            organizador_campeonato,
                            nombre_usuario_software,
                            fecha_software
                            ) VALUES (
                            '".utf8_decode($datos['pais_campeonato_otro_icsjp'])."',
                            '".utf8_decode($datos['nombre_campeonato_otro_icsjp'])."',
                            '".utf8_decode($datos['division_campeonato_otro_icsjp'])."',
                            '".utf8_decode($datos['organizador_campeonato_otro_icsjp'])."',
                            '".utf8_decode($datos['nombre_usuario_software'])."',
                            '".getDateTime()."'
                        )");

                        if( $query )  { 
                            $idcampeonato = $link->insert_id; // <--- ID del Campeonato recién registrado
                        } else {
                            $respuesta = $link->error; // Error al ejecutar INSERT... 
                            return false;
                        }              
                            

                    } else { // <---- El campeonato seleccionado es uno que ha sido previamente registrado en la BD.
                        $idcampeonato = $datos['idcampeonato_icsjp'];
                    }

                    // Declarando variable que almacenará el valor del ID del Club según sea el caso.
                    $idclub = "";
                    // ============================ Verificando si el club es uno que ha sido previamente registrado en la BD o es nuevo (el usuario seleccionó 'Otro') ============== //
                    if( $datos['idclub_rival_icsjp'] == '000' ) { // <---- El usuario seleccionó 'Otro'.

                        $tipo_pais_club = '';
                        if( in_array( $datos['pais_club_rival_otro_icsjp'], $array_paises ) ) {
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
                            '".utf8_decode($datos['pais_club_rival_otro_icsjp'])."',
                            '".utf8_decode($tipo_pais_club)."',
                            '".utf8_decode($datos['division_club_rival_otro_icsjp'])."',
                            '".utf8_decode($datos['nombre_club_rival_otro_icsjp'])."',
                            '".utf8_decode($datos['entrenador_club_rival_otro_icsjp'])."'
                        )");

                        if( $query )  {  
                            $idclub = $link->insert_id; // <--- ID del Campeonato recién registrado
                        } else {
                            $respuesta = $link->error; // Error al ejecutar INSERT...
                            return false;
                        }              
                            

                    } else { // <---- El campeonato seleccionado es uno que ha sido previamente registrado en la BD.
                        $idclub = $datos['idclub_rival_icsjp'];
                    }                

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
                    if( !isset( $datos['condicion_icsjp'] ) ) {
                        $datos['condicion_icsjp'] = '';
                    }

                    // Verificamos si es un informe que existe o nuevo (informe de GENERAL cambiado a uno de PARTIDO):
                    if( $idinforme_csj_partido == 'null' ) {
                      // Se insertan datos en la tabla 'informe_csj_partido':
                      $query = $link->query("INSERT INTO informe_csj_partido (
                          idinforme_cscouting_jugador,
                          idcampeonato,
                          idclub,
                          fecha_icsjp,
                          temporada_icsjp,
                          jornada_icsjp,
                          posicion_icsjp,
                          tit_sup_nc_icsjp,
                          t_amarilla_icsjp,
                          t_amarilladb_icsjp,
                          t_roja_icsjp,
                          num_gol_icsjp,
                          min_entrada_icsjp,
                          min_salida_icsjp,
                          min_jugados_icsjp,
                          condicion_icsjp,
                          golequipo1_icsjp,
                          golequipo2_icsjp,
                          observaciones_generales_icsjp,
                          aspct_ofen_icsjp,
                          aspct_def_icsjp,
                          aspct_fisico_icsjp
                          ) VALUES (
                            ".$idinforme_cscouting_jugador.",
                            ".$idcampeonato.",
                            ".$idclub.",
                            '".utf8_decode($datos['fecha_icsjp'])."',
                            '".utf8_decode($datos['temporada_icsjp'])."',
                            '".utf8_decode($datos['jornada_icsjp'])."',
                            '".utf8_decode($datos['posicion_icsjp'])."',
                            '".utf8_decode($datos['tit_sup_nc_icsjp'])."',
                            '".utf8_decode($datos['t_amarilla_icsjp'])."',
                            '".utf8_decode($datos['t_amarilladb_icsjp'])."',
                            '".utf8_decode($datos['t_roja_icsjp'])."',
                            '".utf8_decode($datos['num_gol_icsjp'])."',
                            '".utf8_decode($datos['min_entrada_icsjp'])."',
                            '".utf8_decode($datos['min_salida_icsjp'])."',
                            '".utf8_decode($datos['min_jugados_icsjp'])."',
                            '".utf8_decode($datos['condicion_icsjp'])."',
                            '".utf8_decode($datos['golequipo1_icsjp'])."',
                            '".utf8_decode($datos['golequipo2_icsjp'])."',
                            '".utf8_decode($datos['observaciones_generales_icsjp'])."',
                            '".utf8_decode($datos['aspct_ofen_icsjp'])."',
                            '".utf8_decode($datos['aspct_def_icsjp'])."',
                            '".utf8_decode($datos['aspct_fisico_icsjp'])."'
                      )");
                    } else {
                      // Se modifican datos en la tabla 'informe_csj_partido':
                      $query = $link->query("UPDATE informe_csj_partido SET
                          idcampeonato = ".$idcampeonato.",
                          idclub = ".$idclub.",
                          fecha_icsjp = '".utf8_decode($datos['fecha_icsjp'])."',
                          jornada_icsjp = '".utf8_decode($datos['jornada_icsjp'])."',
                          posicion_icsjp = '".utf8_decode($datos['posicion_icsjp'])."',
                          tit_sup_nc_icsjp = '".utf8_decode($datos['tit_sup_nc_icsjp'])."',
                          t_amarilla_icsjp = '".utf8_decode($datos['t_amarilla_icsjp'])."',
                          t_amarilladb_icsjp = '".utf8_decode($datos['t_amarilladb_icsjp'])."',
                          t_roja_icsjp = '".utf8_decode($datos['t_roja_icsjp'])."',
                          num_gol_icsjp = '".utf8_decode($datos['num_gol_icsjp'])."',
                          min_entrada_icsjp = '".utf8_decode($datos['min_entrada_icsjp'])."',
                          min_salida_icsjp = '".utf8_decode($datos['min_salida_icsjp'])."',
                          min_jugados_icsjp = '".utf8_decode($datos['min_jugados_icsjp'])."',
                          condicion_icsjp = '".utf8_decode($datos['condicion_icsjp'])."',
                          golequipo1_icsjp = '".utf8_decode($datos['golequipo1_icsjp'])."',
                          golequipo2_icsjp = '".utf8_decode($datos['golequipo2_icsjp'])."',
                          observaciones_generales_icsjp = '".utf8_decode($datos['observaciones_generales_icsjp'])."',
                          aspct_ofen_icsjp = '".utf8_decode($datos['aspct_ofen_icsjp'])."',
                          aspct_def_icsjp = '".utf8_decode($datos['aspct_def_icsjp'])."',
                          aspct_fisico_icsjp = '".utf8_decode($datos['aspct_fisico_icsjp'])."'
                          WHERE idinforme_csj_partido = ".$idinforme_csj_partido."
                          ");                      
                    }

                    if( $query )  { 

                      // -------------------------- INICIO DE CONSULTAS PARA ESTADÍSTICAS --------------------------  //
                      // Estatus de la consultas de estadísticas:
                      $status_query_estadisticas = "";                      
                      // Comprobando si se han ingresado estadísticas para insertar:
                      if( isset( $datos['descripcion_estadistica_icsj_insert'] ) ) {

                        // -------------- Insertando datos en la tabla 'estadistica_informe_csj' -------------- //
                        for($i=0; $i < count( $datos['descripcion_estadistica_icsj_insert'] ); $i++) {

                          $descripcion_estadistica_icsj = $datos['descripcion_estadistica_icsj_insert'][$i];
                          $valor_estadistica_icsj = $datos['valor_estadistica_icsj_insert'][$i];

                          $query = $link->query("INSERT INTO estadistica_informe_csj (
                              idinforme_cscouting_jugador,
                              descripcion_estadistica_icsj,
                              valor_estadistica_icsj
                          ) VALUES (
                              ".$idinforme_cscouting_jugador.",
                              '".utf8_decode($descripcion_estadistica_icsj)."',
                              '".utf8_decode($valor_estadistica_icsj)."'
                          )");
                        }    

                        if( $query ) {
                          $status_query_estadisticas = true;
                        } else {
                          $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'estadistica_informe_csj')...
                        }

                      } else {
                        $status_query_estadisticas = true;
                      }

                      // MODIFICAR STATS:
                      // Comprobando si se han ingresado estadísticas para modificar:
                      if( isset( $datos['idestadistica_informe_csj_update'] ) ) {

                        // -------------- Modificando datos en la tabla 'estadistica_informe_csj' -------------- //
                        for($i=0; $i < count( $datos['idestadistica_informe_csj_update'] ); $i++) {

                          $idestadistica_informe_csj = $datos['idestadistica_informe_csj_update'][$i];
                          $descripcion_estadistica_icsj = $datos['descripcion_estadistica_icsj_update'][$i];
                          $valor_estadistica_icsj = $datos['valor_estadistica_icsj_update'][$i];

                          $query = $link->query("UPDATE estadistica_informe_csj SET 
                              descripcion_estadistica_icsj = '".utf8_decode($descripcion_estadistica_icsj)."', 
                              valor_estadistica_icsj = '".utf8_decode($valor_estadistica_icsj)."'
                              WHERE idestadistica_informe_csj = ".$idestadistica_informe_csj."
                          ");
                        }    

                        if( $query ) {
                          $status_query_estadisticas = true;
                        } else {
                          $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'estadistica_informe_csj')...
                        }

                      } else {
                        $status_query_estadisticas = true;
                      }                      

                      // -------------------------- FIN DE CONSULTAS PARA ESTADÍSTICAS --------------------------  //

                      // Si todo va bien con las consultas de las estadísticas...
                      if( $status_query_estadisticas === true ) {

                        // INFORME PARTIDO: Ahora se debe verificar si existe o no un registro en el campo 'informe_csj_general' asociado al $idinforme_cscouting_jugador para eliminarlo/ejecutar sentencia DELELTE:

                        // Si el valor de la variable $idinforme_csj_general no está vacía significa que SÍ existe un registro en el campo 'informe_csj_general' asociado al $idinforme_cscouting_jugador. Dicho registro será eliminado:
                        if( $idinforme_csj_general != 'null' ) {

                          // ELIMINANDO VÍDEOS ASOCIADOS AL INFORME GENERAL QUE DE DESEA ELIMINAR (tabla 'video_informe_cscouting_jugador'):
                          $query = $link->query("
                                DELETE FROM video_informe_cscouting_jugador WHERE idinforme_cscouting_jugador = ".$idinforme_cscouting_jugador."   
                          ");

                          if( $query )  {
                          
                            // INSERT en tabla 'video_informe_cscouting_jugador':
                            $query = $link->query("INSERT INTO video_informe_cscouting_jugador (
                                idinforme_cscouting_jugador,
                                fecha_video,
                                servidor_video,
                                titulo_video,
                                link_video,
                                categoria_video,
                                sub_categoria_video
                                ) VALUES (
                                  ".$idinforme_cscouting_jugador.",
                                  '".utf8_decode($datos['fecha_video'])."',
                                  '".utf8_decode($datos['servidor_video'])."',
                                  '".utf8_decode($datos['titulo_video'])."',
                                  '".utf8_decode($datos['link_video'])."',
                                  '".utf8_decode($datos['categoria_video'])."',
                                  '".utf8_decode($datos['sub_categoria_video'])."'
                            )");                        
                            
                            if( $query ) {
                              // ELIMINANDO EL INFORME GENERAL (tabla 'informe_csj_general'):
                              $query = $link->query("
                                  DELETE FROM informe_csj_general WHERE idinforme_csj_general = ".$idinforme_csj_general."   
                              ");                  
                              
                              if( $query )  {
                                $respuesta = 2; // DELETE ejecutado correctamente (tabla 'informe_csj_general').  
                              } else {
                                $respuesta = $link->error; // Error al ejecutar DELETE (tabla 'informe_csj_general')...
                              }
                              
                            } else {
                              $respuesta = $link->error; // Error al ejecutar INSERT (tabla 'video_informe_cscouting_jugador')...
                            }

                          } else {
                              $respuesta = $link->error; // Error al ejecutar DELETE en la tabla 'video_informe_cscouting_jugador'...
                          }


                        } else {
                            $respuesta = 2; // UPDATE/INSERT ejecutado correctamente.
                        }

                      }

                        
                    } else {

                      $sql_debugging = "UPDATE informe_csj_partido SET
                        idcampeonato = ".$idcampeonato.",
                        idclub = ".$idclub.",
                        jornada_icsjp = '".utf8_decode($datos['jornada_icsjp'])."',
                        posicion_icsjp = '".utf8_decode($datos['posicion_icsjp'])."',
                        tit_sup_nc_icsjp = '".utf8_decode($datos['tit_sup_nc_icsjp'])."',
                        t_amarilla_icsjp = '".utf8_decode($datos['t_amarilla_icsjp'])."',
                        t_amarilladb_icsjp = '".utf8_decode($datos['t_amarilladb_icsjp'])."',
                        t_roja_icsjp = '".utf8_decode($datos['t_roja_icsjp'])."',
                        num_gol_icsjp = '".utf8_decode($datos['num_gol_icsjp'])."',
                        min_entrada_icsjp = '".utf8_decode($datos['min_entrada_icsjp'])."',
                        min_salida_icsjp = '".utf8_decode($datos['min_salida_icsjp'])."',
                        min_jugados_icsjp = '".utf8_decode($datos['min_jugados_icsjp'])."',
                        condicion_icsjp = '".utf8_decode($datos['condicion_icsjp'])."',
                        golequipo1_icsjp = '".utf8_decode($datos['golequipo1_icsjp'])."',
                        golequipo2_icsjp = '".utf8_decode($datos['golequipo2_icsjp'])."',
                        observaciones_generales_icsjp = '".utf8_decode($datos['observaciones_generales_icsjp'])."',
                        aspct_ofen_icsjp = '".utf8_decode($datos['aspct_ofen_icsjp'])."',
                        aspct_def_icsjp = '".utf8_decode($datos['aspct_def_icsjp'])."',
                        aspct_fisico_icsjp = '".utf8_decode($datos['aspct_fisico_icsjp'])."'
                        WHERE idinforme_csj_partido = ".$idinforme_csj_partido."
                        ";                      
                        $respuesta = $link->error; // Error al ejecutar UPDATE...
                        // $respuesta = $sql_debugging; // Error al ejecutar UPDATE...                    
                    } 
                    
                }

            } else {
                
                // UPDATE en tabla 'video_informe_cscouting_jugador':
                $sql_debugging = "UPDATE video_informe_cscouting_jugador SET
                  fecha_video = '".utf8_decode($datos['fecha_video'])."',
                  servidor_video = '".utf8_decode($datos['servidor_video'])."',
                  titulo_video = '".utf8_decode($datos['titulo_video'])."',
                  link_video = '".utf8_decode($datos['link_video'])."',
                  categoria_video = '".utf8_decode($datos['categoria_video'])."',
                  sub_categoria_video = '".utf8_decode($datos['sub_categoria_video'])."'
                  WHERE idinforme_cscouting_jugador = ".$idinforme_cscouting_jugador."
                ";
                // $respuesta = $link->error; // Error al ejecutar UPDATE...
                $respuesta = $sql_debugging; // Error al ejecutar UPDATE...    
            
            } 

        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        } 

    }
    
    $link->close();
    return $respuesta;

}
/* --------------------------------------------- Fin de la función 'guardar' --------------------------------------------- */

/* --------------------------------------------- Inicio de la función 'guardar_entrenador' --------------------------------------------- */
function guardar_entrenador($datos){
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
    if( $datos['fecha_nacimiento_entrenador'] == '' ) {
        $datos['fecha_nacimiento_entrenador'] = date("Y-m-d");
    }

    if($datos['identrenador']==''){//agregar nuevo entrenador
        // ----------- Tabla 'entrenador' ----------- //
        // INSERT:
        $query = $link->query("INSERT INTO entrenador (
            nombre_entrenador,
            apellido1_entrenador,
            apellido2_entrenador,
            fecha_nacimiento_entrenador,
            nacionalidad_entrenador,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
              '".utf8_decode($datos['nombre_entrenador'])."',
              '".utf8_decode($datos['apellido1_entrenador'])."',
              '".utf8_decode($datos['apellido2_entrenador'])."',
              '".utf8_decode($datos['fecha_nacimiento_entrenador'])."',
              '".utf8_decode($datos['nacionalidad_entrenador'])."',
              '".utf8_decode($datos['nombre_usuario_software'])."',
              '".getDateTime()."'
        )");

        // Si se insertan correctamente los datos en la tabla 'entrenador', se procede a insertar datos en la tabla 'entrenador_club'
        if( $query )  { 
            
            // Valor del ID del entrenador insertado:
            $identrenador = $link->insert_id;
               
            // ------------------- FOTO --------------- //
            if( isset($_FILES['foto_entrenador']['name']) ){
                if( $_FILES['foto_entrenador']['name'] == '' ) {
                    copy('../img/silueta_entrenador.png', '../foto_entrenadores/'.$identrenador.'.png');
                } else {
                    copy('../subir_imagen3/buffer_imagen.png', '../foto_entrenadores/'.$identrenador.'.png');
                }

            } else{ // Si no selecciona foto (registro de usuario con nuevo perfil)... 
                copy('../subir_imagen3/buffer_imagen.png', '../foto_entrenadores/'.$identrenador.'.png');
            }

            // Declarando variable que almacenará el valor del ID del Club según sea el caso.
            $idclub = "";
            // ============================ Verificando si el club es uno que ha sido previamente registrado en la BD o es nuevo (el usuario seleccionó 'Otro') ============== //
            if( $datos['idclub_actual_entrenador'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                
                $tipo_pais_club = '';
                if( in_array( $datos['pais_club_entrenador_otro'], $array_paises ) ) {
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
                    '".utf8_decode($datos['pais_club_entrenador_otro'])."',
                    '".utf8_decode($tipo_pais_club)."',
                    '".utf8_decode($datos['division_club_entrenador_otro'])."',
                    '".utf8_decode($datos['nombre_club_entrenador_otro'])."',
                    '".utf8_decode($datos['entrenador_club_entrenador_otro'])."'
                )");

                if( $query )  { 
                    $idclub = $link->insert_id; // <--- ID del Campeonato recién registrado
                } else {
                    $respuesta = $link->error; // Error al ejecutar INSERT...
                    // return false; 
                }              

            } else { // <---- El club seleccionado es uno que ha sido previamente registrado en la BD.
                $idclub = $datos['idclub_actual_entrenador'];
            }

            $representante_entrenadorclub = $datos['representante_entrenadorclub'];
            $fechafin_contrato_entrenadorclub = $datos['fechafin_contrato_entrenadorclub'];
            
            $clausula_salida_entrenadorclub = $datos['clausula_salida_entrenadorclub'];
            $valor_clausula_entrenadorclub = ''; // <--- Valor de la cláusula por defecto vacía. Si el usuario selecciona que sí tiene cláusula de salida, entonces su valor será el ingresado en el formulario.

            // Si tiene cláusula de salida, se registrará el valor de esta:
            if( $clausula_salida_entrenadorclub == '1' ) { // Cláusula de salida = 'Sí' ('1')
                $valor_clausula_entrenadorclub = $datos['valor_clausula_entrenadorclub'];
            } 
     
            // Independientemente del estado del jugador, la observación siempre será insertada/modificada:
            $observaciones_entrenadorclub = $datos['observaciones_entrenadorclub'];

            // Comprobando si el valor es nulo:
            $idclub = !empty($idclub) ? "'$idclub'" : "NULL";

            // ----------- Tabla 'entrenador_club' ----------- //
            $query = $link->query("INSERT INTO entrenador_club (
                identrenador,
                idclub,
                representante_entrenadorclub,
                fechafin_contrato_entrenadorclub,
                clausula_salida_entrenadorclub,
                valor_clausula_entrenadorclub,
                observaciones_entrenadorclub
                ) VALUES (
                  ".$identrenador.",
                  ".$idclub.",
                  '".utf8_decode($representante_entrenadorclub)."',
                  '".utf8_decode($fechafin_contrato_entrenadorclub)."',
                  '".utf8_decode($clausula_salida_entrenadorclub)."',
                  '".utf8_decode($valor_clausula_entrenadorclub)."',
                  '".utf8_decode($observaciones_entrenadorclub)."'
            )");

            // Si se insertan correctamente los datos en la tabla 'entrenador_club', el proceso finaliza y se muestra el mensaje de éxito:
            if( $query )  {

                $respuesta = 1; // INSERT ejecutado correctamente.
                
            } else {
                // Error al insertar datos en la tabla 'entrenador_club'
                $respuesta = $link->error; // Error al ejecutar.                    
            }

        } else {
            // Error al insertar datos en la tabla 'entrenador'
            $respuesta = $link->error; // Error al ejecutar INSERT.                    
        }   
            
    } else {

        // UPDATE:
        $identrenador = $datos['identrenador'];
        $identrenador_club = $datos['identrenador_club'];

        // Si la fecha de nacimiento no es especificada, registra la fecha actual:
        if( $datos['fecha_nacimiento_entrenador'] == '' ) {
            $datos['fecha_nacimiento_entrenador'] = date("Y-m-d");
        }

        // ----------- Tabla 'entrenador' ----------- //
        $query = $link->query("UPDATE entrenador SET
            nombre_entrenador = '".utf8_decode($datos['nombre_entrenador'])."',
            apellido1_entrenador = '".utf8_decode($datos['apellido1_entrenador'])."',
            apellido2_entrenador = '".utf8_decode($datos['apellido2_entrenador'])."',
            fecha_nacimiento_entrenador = '".utf8_decode($datos['fecha_nacimiento_entrenador'])."',
            nacionalidad_entrenador = '".utf8_decode($datos['nacionalidad_entrenador'])."',
            nombre_usuario_software = '".utf8_decode($datos['nombre_usuario_software'])."',
            fecha_software = '".getDateTime()."'
            WHERE identrenador = ".$identrenador."              
        ");

        // Si se insertan correctamente los datos en la tabla 'entrenador', se procede a insertar datos en la tabla 'entrenador_club'
        if( $query )  { 

          // ------------------- FOTO --------------- //
          if( isset($_FILES['foto_entrenador']['name']) ){
              if( $_FILES['foto_entrenador']['name'] == '' ) {

                if (!file_exists('../foto_entrenadores/'.$identrenador.'.png')) {
                    copy('../img/silueta_entrenador.png', '../foto_entrenadores/'.$identrenador.'.png');
                } else {
                    copy('../foto_entrenadores/'.$identrenador.'.png', '../'.$datos['foto_anterior_entrenador']);
                }
 
              } else {
                  copy('../subir_imagen3/buffer_imagen.png', '../foto_entrenadores/'.$identrenador.'.png');
              }

          } else{ // Si no selecciona foto (registro de usuario con nuevo perfil)... 
              copy('../subir_imagen3/buffer_imagen.png', '../foto_entrenadores/'.$identrenador.'.png');
          }
            
            // Declarando variable que almacenará el valor del ID del Club según sea el caso.
            $idclub = "";
            // ============================ Verificando si el club es uno que ha sido previamente registrado en la BD o es nuevo (el usuario seleccionó 'Otro') ============== //
            if( $datos['idclub_actual_entrenador'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                
                $tipo_pais_club = '';
                if( in_array( $datos['pais_club_entrenador_otro'], $array_paises ) ) {
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
                    '".utf8_decode($datos['pais_club_entrenador_otro'])."',
                    '".utf8_decode($tipo_pais_club)."',
                    '".utf8_decode($datos['division_club_entrenador_otro'])."',
                    '".utf8_decode($datos['nombre_club_entrenador_otro'])."',
                    '".utf8_decode($datos['entrenador_club_entrenador_otro'])."'
                )");

                if( $query )  { 
                    $idclub = $link->insert_id; // <--- ID del Campeonato recién registrado
                } else {
                    $respuesta = $link->error; // Error al ejecutar INSERT...
                    // return false; 
                }              

            } else { // <---- El club seleccionado es uno que ha sido previamente registrado en la BD.
                $idclub = $datos['idclub_actual_entrenador'];
            }

            $representante_entrenadorclub = $datos['representante_entrenadorclub'];
            $fechafin_contrato_entrenadorclub = $datos['fechafin_contrato_entrenadorclub'];
            
            $clausula_salida_entrenadorclub = $datos['clausula_salida_entrenadorclub'];
            $valor_clausula_entrenadorclub = ''; // <--- Valor de la cláusula por defecto vacía. Si el usuario selecciona que sí tiene cláusula de salida, entonces su valor será el ingresado en el formulario.

            // Si tiene cláusula de salida, se registrará el valor de esta:
            if( $clausula_salida_entrenadorclub == '1' ) { // Cláusula de salida = 'Sí' ('1')
                $valor_clausula_entrenadorclub = $datos['valor_clausula_entrenadorclub'];
            } 
     
            // Independientemente del estado del jugador, la observación siempre será insertada/modificada:
            $observaciones_entrenadorclub = $datos['observaciones_entrenadorclub'];

            // Comprobando si el valor es nulo:
            $idclub = !empty($idclub) ? "'$idclub'" : "NULL";

            // ----------- Tabla 'entrenador_club' ----------- //
            $query = $link->query("UPDATE entrenador_club SET
                idclub = ".$idclub.",
                representante_entrenadorclub = '".utf8_decode($representante_entrenadorclub)."',
                fechafin_contrato_entrenadorclub = '".utf8_decode($fechafin_contrato_entrenadorclub)."',
                clausula_salida_entrenadorclub = '".utf8_decode($clausula_salida_entrenadorclub)."',
                valor_clausula_entrenadorclub = '".utf8_decode($valor_clausula_entrenadorclub)."',
                observaciones_entrenadorclub = '".utf8_decode($observaciones_entrenadorclub)."'
                WHERE identrenador_club = ".$identrenador_club."
            ");

            // Si se modifican correctamente los datos en la tabla 'entrenador_club', el proceso finaliza y se muestra el mensaje de éxito:
            if( $query )  {

                $respuesta = 2; // UPDATE ejecutado correctamente.
                
            } else {
                // Error al modificar datos en la tabla 'entrenador_club'
                $respuesta = $link->error; // Error al ejecutar.                    
            }

        } else {
            // Error al modificar datos en la tabla 'entrenador'
            $respuesta = $link->error; // Error al ejecutar UPDATE en la tabla 'entrenador'.                    
        } 

    }
    
    $link->close();
    return $respuesta;
}
/* --------------------------------------------- Fin de la función 'guardar_entrenador' --------------------------------------------- */

/* --------------------------------------------- Inicio de la función 'guardar_partido_entrenador' --------------------------------------------- */
function guardar_partido_entrenador($datos){
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

    if($datos['identrenador_partido']==''){ 

        // INSERT:
        $identrenador_club = $datos['identrenador_club'];

        // Declarando variable que almacenará el valor del ID del Club según sea el caso (CLUB RIVAL).
        $idclub = "";
        // ============================ Verificando si el club es uno que ha sido previamente registrado en la BD o el usuario seleccionó 'Otro') ============== //
        if( $datos['idclub_rival_entrenador'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                    
            $tipo_pais_club = '';
            if( in_array( $datos['pais_club_rival_entrenador_otro'], $array_paises ) ) {
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
                '".utf8_decode($datos['pais_club_rival_entrenador_otro'])."',
                '".utf8_decode($tipo_pais_club)."',
                '".utf8_decode($datos['division_club_rival_entrenador_otro'])."',
                '".utf8_decode($datos['nombre_club_rival_entrenador_otro'])."',
                '".utf8_decode($datos['entrenador_club_rival_entrenador_otro'])."'
            )");

            if( $query )  { 
                $idclub = $link->insert_id; // <--- ID del Campeonato recién registrado
                } else {
                $respuesta = $link->error; // Error al ejecutar INSERT...
                // return false; 
            }              

        } else { // <---- El club seleccionado es uno que ha sido previamente registrado en la BD.
            $idclub = $datos['idclub_rival_entrenador'];
        }

        // Declarando variable que almacenará el valor del ID del Campeonato según sea el caso.
        $idcampeonato = "";
        // ============================ Verificando si el campeonato es uno que ha sido previamente registrado en la BD o el usuario seleccionó 'Otro') ============== //
        if( $datos['idcampeonato_entrenador'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                    
            // INSERT en la tabla 'campeonato':
            $query = $link->query("INSERT INTO campeonato (
                pais_campeonato,
                division_campeonato,
                nombre_campeonato,
                organizador_campeonato
                ) VALUES (
                '".utf8_decode($datos['pais_campeonato_entrenador_otro'])."',
                '".utf8_decode($datos['division_campeonato_entrenador_otro'])."',
                '".utf8_decode($datos['nombre_campeonato_entrenador_otro'])."',
                '".utf8_decode($datos['organizador_campeonato_entrenador_otro'])."'
            )");

            if( $query )  { 
                $idcampeonato = $link->insert_id; // <--- ID del Campeonato recién registrado
                } else {
                $respuesta = $link->error; // Error al ejecutar INSERT...
                // return false; 
            }              

        } else { // <---- El club seleccionado es uno que ha sido previamente registrado en la BD.
            $idcampeonato = $datos['idcampeonato_entrenador'];
        }        

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
        if( !isset( $datos['cond_equipo1_entrenadorpartido'] ) ) {
            $datos['cond_equipo1_entrenadorpartido'] = '';
        }

        if( !isset( $datos['cond_equipo2_entrenadorpartido'] ) ) {
            $datos['cond_equipo2_entrenadorpartido'] = '';
        }        

        // ----------- Tabla 'entrenador_partido' ----------- //
        $query = $link->query("INSERT INTO entrenador_partido (
            identrenador_club,
            idcampeonato,
            idclub,
            fecha_entrenadorpartido,
            temporada_entrenadorpartido,
            md_entrenadorpartido,
            jornada_entrenadorpartido,
            tactica_entrenadorpartido,
            t_amarilla_entrenadorpartido,
            t_amarilladb_entrenadorpartido,
            t_roja_entrenadorpartido,
            cond_equipo1_entrenadorpartido,
            cond_equipo2_entrenadorpartido,
            gol_equipo1_entrenadorpartido,
            gol_equipo2_entrenadorpartido,
            min_jugados_entrenadorpartido,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
              ".$identrenador_club.",
              ".$idcampeonato.",
              ".$idclub.",
              '".utf8_decode($datos['fecha_entrenadorpartido'])."',
              '".utf8_decode($datos['temporada_entrenadorpartido'])."',
              '".utf8_decode($datos['md_entrenadorpartido'])."',
              '".utf8_decode($datos['jornada_entrenadorpartido'])."',
              '".utf8_decode($datos['tactica_entrenadorpartido'])."',
              '".utf8_decode($datos['t_amarilla_entrenadorpartido'])."',
              '".utf8_decode($datos['t_amarilladb_entrenadorpartido'])."',
              '".utf8_decode($datos['t_roja_entrenadorpartido'])."',
              '".utf8_decode($datos['cond_equipo1_entrenadorpartido'])."',
              '".utf8_decode($datos['cond_equipo2_entrenadorpartido'])."',
              '".utf8_decode($datos['gol_equipo1_entrenadorpartido'])."',
              '".utf8_decode($datos['gol_equipo2_entrenadorpartido'])."',
              '".utf8_decode($datos['min_jugados_entrenadorpartido'])."',
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
        $identrenador_partido = $datos['identrenador_partido'];

        // Declarando variable que almacenará el valor del ID del Club según sea el caso (CLUB RIVAL).
        $idclub = "";
        // ============================ Verificando si el club es uno que ha sido previamente registrado en la BD o el usuario seleccionó 'Otro') ============== //
        if( $datos['idclub_rival_entrenador'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                    
            $tipo_pais_club = '';
            if( in_array( $datos['pais_club_rival_entrenador_otro'], $array_paises ) ) {
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
                '".utf8_decode($datos['pais_club_rival_entrenador_otro'])."',
                '".utf8_decode($tipo_pais_club)."',
                '".utf8_decode($datos['division_club_rival_entrenador_otro'])."',
                '".utf8_decode($datos['nombre_club_rival_entrenador_otro'])."',
                '".utf8_decode($datos['entrenador_club_rival_entrenador_otro'])."'
            )");

            if( $query )  { 
                $idclub = $link->insert_id; // <--- ID del Campeonato recién registrado
                } else {
                $respuesta = $link->error; // Error al ejecutar INSERT...
                // return false; 
            }              

        } else { // <---- El club seleccionado es uno que ha sido previamente registrado en la BD.
            $idclub = $datos['idclub_rival_entrenador'];
        }

        // Declarando variable que almacenará el valor del ID del Campeonato según sea el caso.
        $idcampeonato = "";
        // ============================ Verificando si el campeonato es uno que ha sido previamente registrado en la BD o el usuario seleccionó 'Otro') ============== //
        if( $datos['idcampeonato_entrenador'] == '000' ) { // <---- El usuario seleccionó 'Otro'.
                    
            // INSERT en la tabla 'campeonato':
            $query = $link->query("INSERT INTO campeonato (
                pais_campeonato,
                division_campeonato,
                nombre_campeonato,
                organizador_campeonato
                ) VALUES (
                '".utf8_decode($datos['pais_campeonato_entrenador_otro'])."',
                '".utf8_decode($datos['division_campeonato_entrenador_otro'])."',
                '".utf8_decode($datos['nombre_campeonato_entrenador_otro'])."',
                '".utf8_decode($datos['organizador_campeonato_entrenador_otro'])."'
            )");

            if( $query )  { 
                $idcampeonato = $link->insert_id; // <--- ID del Campeonato recién registrado
                } else {
                $respuesta = $link->error; // Error al ejecutar INSERT...
                // return false; 
            }              

        } else { // <---- El club seleccionado es uno que ha sido previamente registrado en la BD.
            $idcampeonato = $datos['idcampeonato_entrenador'];
        }        

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
        if( !isset( $datos['cond_equipo1_entrenadorpartido'] ) ) {
            $datos['cond_equipo1_entrenadorpartido'] = '';
        }

        if( !isset( $datos['cond_equipo2_entrenadorpartido'] ) ) {
            $datos['cond_equipo2_entrenadorpartido'] = '';
        }

        // ----------- Tabla 'fichaJugador_partido' ----------- //
        $query = $link->query("UPDATE entrenador_partido SET
            idcampeonato = ".$idcampeonato.",
            idclub = ".$idclub.",
            fecha_entrenadorpartido = '".utf8_decode($datos['fecha_entrenadorpartido'])."',
            temporada_entrenadorpartido = '".utf8_decode($datos['temporada_entrenadorpartido'])."',
            md_entrenadorpartido = '".utf8_decode($datos['md_entrenadorpartido'])."',
            jornada_entrenadorpartido = '".utf8_decode($datos['jornada_entrenadorpartido'])."',
            tactica_entrenadorpartido = '".utf8_decode($datos['tactica_entrenadorpartido'])."',
            t_amarilla_entrenadorpartido = '".utf8_decode($datos['t_amarilla_entrenadorpartido'])."',
            t_amarilladb_entrenadorpartido = '".utf8_decode($datos['t_amarilladb_entrenadorpartido'])."',
            t_roja_entrenadorpartido = '".utf8_decode($datos['t_roja_entrenadorpartido'])."',
            cond_equipo1_entrenadorpartido = '".utf8_decode($datos['cond_equipo1_entrenadorpartido'])."',
            cond_equipo2_entrenadorpartido = '".utf8_decode($datos['cond_equipo2_entrenadorpartido'])."',
            gol_equipo1_entrenadorpartido = '".utf8_decode($datos['gol_equipo1_entrenadorpartido'])."',
            gol_equipo2_entrenadorpartido = '".utf8_decode($datos['gol_equipo2_entrenadorpartido'])."',
            min_jugados_entrenadorpartido = '".utf8_decode($datos['min_jugados_entrenadorpartido'])."',
            nombre_usuario_software = '".utf8_decode($datos['nombre_usuario_software'])."',
            fecha_software = '".getDateTime()."'  
            WHERE identrenador_partido = ".$identrenador_partido." 
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
/* --------------------------------------------- Inicio de la función 'guardar_partido_entrenador' --------------------------------------------- */

/* --------------------------------------------- Inicio de la función 'eliminar_entrenador' --------------------------------------------- */
function eliminar_entrenador($id){
    include("conexion.php");
    $query = $link->query("DELETE FROM entrenador WHERE identrenador = ".$id." ");
    if( $query )  { 
        return 1;                   
        $link->close();
    } else {
        return $link->error; // Error al ejecutar UPDATE...                    
        $link->close();
    }      
    
}
/* --------------------------------------------- Fin de la función 'eliminar_partido_entrenador' --------------------------------------------- */

/* --------------------------------------------- Inicio de la función 'eliminar_entrenador' --------------------------------------------- */
function eliminar_partido_entrenador($id){
    include("conexion.php");
    $query = $link->query("DELETE FROM entrenador_partido WHERE identrenador_partido = ".$id." ");
    if( $query )  { 
        return 1;                   
        $link->close();
    } else {
        return $link->error; // Error al ejecutar UPDATE...                    
        $link->close();
    }      
    
}
/* --------------------------------------------- Fin de la función 'eliminar_partido_entrenador' --------------------------------------------- */

/* --------------------------------------------- Inicio de la función 'eliminar_scouting' --------------------------------------------- */
function eliminar_scouting($id){
    include("conexion.php");
    $query = $link->query("DELETE FROM cscouting_jugador WHERE idcscouting_jugador = ".$id." ");
    if( $query )  { 
        return 1;                   
        $link->close();
    } else {
        return $link->error; // Error al ejecutar UPDATE...                    
        $link->close();
    }      
    
}
/* --------------------------------------------- Fin de la función 'eliminar_scouting' --------------------------------------------- */

/* --------------------------------------------- Inicio de la función 'eliminar_informe_scouting' --------------------------------------------- */
function eliminar_estadistica_informe_scouting($id){
    include("conexion.php");
    $query = $link->query("DELETE FROM estadistica_informe_csj WHERE idestadistica_informe_csj = ".$id." ");
    if( $query )  { 
        return 1;                   
        $link->close();
    } else {
        return $link->error; // Error al ejecutar UPDATE...                    
        $link->close();
    }      
    
}
/* --------------------------------------------- Fin de la función 'eliminar_informe_scouting' --------------------------------------------- */

/* --------------------------------------------- Inicio de la función 'eliminar_informe_scouting' --------------------------------------------- */
function eliminar_informe_scouting($id){
    include("conexion.php");
    $query = $link->query("DELETE FROM informe_cscouting_jugador WHERE idinforme_cscouting_jugador = ".$id." ");
    if( $query )  { 
        return 1;                   
        $link->close();
    } else {
        return $link->error; // Error al ejecutar UPDATE...                    
        $link->close();
    }      
    
}
/* --------------------------------------------- Fin de la función 'eliminar_informe_scouting' --------------------------------------------- */

/* --------------------------------------------- Inicio de la función 'buscar_datosPDF' --------------------------------------------- */
function buscar_datosPDF($id){
    include("conexion.php");

      $idinforme_cscouting_jugador = $_POST['idinforme_cscouting_jugador'];
      $resultado = $link->query("
          SELECT 
          -- Tabla 'informe_cscouting_jugador':
          informe_cscouting_jugador.idinforme_cscouting_jugador,
          informe_cscouting_jugador.idcscouting_jugador,
          informe_cscouting_jugador.fecha_icsj,
          informe_cscouting_jugador.nombre_icsj,
          informe_cscouting_jugador.tipo_informe_icsj,
          informe_cscouting_jugador.recomendacion_icsj,
          informe_cscouting_jugador.realizado_por_icsj,
          informe_cscouting_jugador.fecha_software,

          -- Tabla 'informe_csj_general':
          informe_csj_general.aspct_tecnico_icsjg,
          informe_csj_general.aspct_tactico_icsjg,
          informe_csj_general.aspct_fisico_icsjg,
          informe_csj_general.aspct_psico_icsjg,
          informe_csj_general.resumen_obsrv_icsjg,
          informe_csj_general.sugerencias_icsjg,
          informe_csj_general.proyeccion_icsjg,
          informe_csj_general.exportacion_icsjg,

          -- Tabla 'informe_csj_partido':
          informe_csj_partido.aspct_ofen_icsjp,
          informe_csj_partido.aspct_def_icsjp,
          informe_csj_partido.aspct_fisico_icsjp,
          informe_csj_partido.observaciones_generales_icsjp,

          -- Tabla 'cscouting_jugador':
          cscouting_jugador.idcscouting_jugador,

          -- Tabla 'fichaJugador_club':
          fichaJugador_club.idfichaJugador_club,
          fichaJugador_club.fechafin_contrato_jugadorclub,

          -- Tabla 'fichaJugador':
          fichaJugador.idfichaJugador,
          fichaJugador.nombre,
          fichaJugador.apellido1,
          fichaJugador.apellido2,
          fichaJugador.fechaNacimiento,
          fichaJugador.nacionalidad1,
          fichaJugador.codigoNacionalidad1,
          fichaJugador.altura,
          fichaJugador.dinamico,
          fichaJugador.seleccionado,

          -- Tabla 't_club_jugador':
          t_club_jugador.idclub AS idclub_jugador,
          t_club_jugador.pais_club AS pais_club_jugador,
          t_club_jugador.division_club AS division_club_jugador,
          t_club_jugador.nombre_club AS nombre_club_jugador

          FROM informe_cscouting_jugador
          -- Datos del Informe de Tipo 'General'
          LEFT JOIN informe_csj_general ON informe_csj_general.idinforme_cscouting_jugador = informe_cscouting_jugador.idinforme_cscouting_jugador
          -- Datos del Informe de Tipo 'Partido'
          LEFT JOIN informe_csj_partido ON informe_csj_partido.idinforme_cscouting_jugador = informe_cscouting_jugador.idinforme_cscouting_jugador
          -- Datos Scouting:
          LEFT JOIN cscouting_jugador ON cscouting_jugador.idcscouting_jugador = informe_cscouting_jugador.idcscouting_jugador
          -- Datos del jugador y club:
          LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador_club = cscouting_jugador.idfichaJugador_club
          -- Datos del jugador:
          LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador 
          -- Datos del club del jugador:
          LEFT JOIN club AS t_club_jugador ON t_club_jugador.idclub = fichaJugador_club.idclub
          WHERE informe_cscouting_jugador.idinforme_cscouting_jugador = ".$idinforme_cscouting_jugador."
      ");

     while($row = mysqli_fetch_array($resultado)){ 

        // Tabla 'posicionCancha':
        $idfichaJugador = $row['idfichaJugador'];
        $resultado_5 = $link->query("
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

        while($row_5 = mysqli_fetch_assoc($resultado_5)) {  
            $posicion = $row_5['posicion'];
            $numero_posicion = $row_5['numero_posicion']; 
            $row['posicion'.$numero_posicion] = $posicion;                                        
        }

        // Tabla 'estadistica_informe_csj':
        $resultado_6 = $link->query("
          SELECT * FROM estadistica_informe_csj
          -- Tabla 'informe_cscouting_jugador':
          LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = estadistica_informe_csj.idinforme_cscouting_jugador
          WHERE estadistica_informe_csj.idinforme_cscouting_jugador = ".$idinforme_cscouting_jugador."
        ");
        while($row_6 = mysqli_fetch_assoc($resultado_6)) {
          $row[] = $row_6;
          /*
          $row['descripcion_estadistica_icsj'] = $row_6['descripcion_estadistica_icsj'];
          $row['valor_estadistica_icsj'] = $row_6['valor_estadistica_icsj'];
          */
        }                                    

        $dato[] = utf8_converter( $row );

    }
    
    // var_dump( $dato );
    unset($row);


    $link->close();
    return $dato;
    
}
/* --------------------------------------------- Fin de la función 'buscar_datosPDF' --------------------------------------------- */

/* --------------------------------------------- Inicio de la función 'partidos_jugador' --------------------------------------------- */
function partidos_jugador( $idfichaJugador_club ) {
    include("conexion.php");

    // Primero se consultan todos los campeonatos 
    $resultado = $link->query("
        SELECT * FROM fichaJugador_partido
        LEFT JOIN campeonato ON campeonato.idcampeonato = fichaJugador_partido.idcampeonato
        WHERE fichaJugador_partido.idfichaJugador_club = ".$idfichaJugador_club."
        LIMIT 14
    ");
    $array_id_campeonato = [];
    while($row = mysqli_fetch_assoc($resultado)) {
        
        $idcampeonato = $row["idcampeonato"];

        // var_dump( 'ID Campeonato: ' . $idcampeonato );

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

    // var_dump( $dato );
    unset($row);

    $link->close();
    return $dato;
    
}
/* --------------------------------------------- Fin de la función 'partidos_jugador' --------------------------------------------- */

/* --------------------------------------------- Inicio de la función 'partidos_jugador_detalle' --------------------------------------------- */
function partidos_jugador_detalle( $idfichaJugador_club ){
    include("conexion.php");

      $resultado = $link->query("
          SELECT 

          -- Tabla 'fichaJugador_partido':
          fichaJugador_partido.fecha_jugadorpartido,
          fichaJugador_partido.temporada_jugadorpartido,
          fichaJugador_partido.condicion_jugadorpartido,
          fichaJugador_partido.tit_sup_nc_jugadorpartido,
          fichaJugador_partido.min_jugados_jugadorpartido,
          fichaJugador_partido.t_amarilla_jugadorpartido,
          fichaJugador_partido.t_roja_jugadorpartido,
          fichaJugador_partido.num_gol_jugadorpartido,
          fichaJugador_partido.gol_equipo1_jugadorpartido,
          fichaJugador_partido.gol_equipo2_jugadorpartido,

          -- Datos del jugador:
          fichaJugador.sexo,
          fichaJugador.serieActual,

          -- Tabla 't_club_jugador':
          t_club_jugador.idclub AS idclub_jugador,
          t_club_jugador.pais_club AS pais_club_jugador,
          t_club_jugador.division_club AS division_club_jugador,
          t_club_jugador.nombre_club AS nombre_club_jugador,

          -- Tabla 't_club_rival':
          t_club_rival.idclub AS idclub_rival,
          t_club_rival.nombre_club AS nombre_club_rival,

          -- Tabla 'campeonato':
          campeonato.idcampeonato,
          campeonato.nombre_campeonato

          FROM fichaJugador_partido
          LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador_club = fichaJugador_partido.idfichaJugador_club
          -- Datos del jugador:
          LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador 
          -- Datos del club del jugador:
          LEFT JOIN club AS t_club_jugador ON t_club_jugador.idclub = fichaJugador_club.idclub
          -- Datos del club rival:
          LEFT JOIN club AS t_club_rival ON t_club_rival.idclub = fichaJugador_partido.idclub
          -- Datos del Campeonato:
          LEFT JOIN campeonato ON campeonato.idcampeonato = fichaJugador_partido.idcampeonato
          WHERE fichaJugador_partido.idfichaJugador_club = ".$idfichaJugador_club."
      ");

     while($row = mysqli_fetch_array($resultado)){ 
        $dato[] = utf8_converter($row);
    }
    
    // var_dump( $dato );
    unset($row);


    $link->close();
    return $dato;
    
}
/* --------------------------------------------- Fin de la función 'partidos_jugador_detalle' --------------------------------------------- */

/* --------------------------------------------- Inicio de la función 'partidos_jugador_informe_scouting' --------------------------------------------- */
function partidos_jugador_informe_scouting( $idcscouting_jugador ){
    include("conexion.php");

    // Primero se consultan todos los campeonatos 
    $resultado = $link->query("
      SELECT * FROM informe_csj_partido
      LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = informe_csj_partido.idinforme_cscouting_jugador
      LEFT JOIN cscouting_jugador ON cscouting_jugador.idcscouting_jugador = informe_cscouting_jugador.idcscouting_jugador
      LEFT JOIN campeonato ON campeonato.idcampeonato = informe_csj_partido.idcampeonato
      WHERE cscouting_jugador.idcscouting_jugador = ".$idcscouting_jugador."
      LIMIT 14
    ");
    $array_id_campeonato = [];
    while($row = mysqli_fetch_assoc($resultado)) {
        
      $idcampeonato = $row["idcampeonato"];

      // -------------------------- Cantidad de partidos jugados -------------------------- //
      // El 3 hace referencia al valor 'NC' (No Compite/No jugados). 
      $resultado_2 = $link->query("
          SELECT COUNT(informe_csj_partido.idinforme_csj_partido) FROM informe_csj_partido
          LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = informe_csj_partido.idinforme_cscouting_jugador
          LEFT JOIN cscouting_jugador ON cscouting_jugador.idcscouting_jugador = informe_cscouting_jugador.idcscouting_jugador          
          WHERE cscouting_jugador.idcscouting_jugador = ".$idcscouting_jugador." 
          AND informe_csj_partido.idcampeonato = ".$idcampeonato."
          AND informe_csj_partido.tit_sup_nc_icsjp <> 3                  
      ");
      while($row_2 = mysqli_fetch_assoc($resultado_2)) {
        $row['partidos_jugados'] = $row_2['COUNT(informe_csj_partido.idinforme_csj_partido)'];
      } 

      // -------------------------- Cantidad de minutos jugados -------------------------- //
      $resultado_3 = $link->query("
          SELECT informe_csj_partido.min_jugados_icsjp 
          FROM informe_csj_partido
          LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = informe_csj_partido.idinforme_cscouting_jugador
          LEFT JOIN cscouting_jugador ON cscouting_jugador.idcscouting_jugador = informe_cscouting_jugador.idcscouting_jugador          
          WHERE cscouting_jugador.idcscouting_jugador = ".$idcscouting_jugador." 
          AND informe_csj_partido.idcampeonato = ".$idcampeonato."                     
      ");
      $acumulador_min_partidosjugados = 0;
      while($row_3 = mysqli_fetch_assoc($resultado_3)) {
         $acumulador_min_partidosjugados = $acumulador_min_partidosjugados + $row_3['min_jugados_icsjp'];
      } 
      $row['min_jugados_icsjp'] = $acumulador_min_partidosjugados;                           

      // -------------------------- Cantidad de partidos jugados como TITULAR -------------------------- //
      // El 1 hace referencia al valor 'Titular'. 
      $resultado_4 = $link->query("
          SELECT COUNT(informe_csj_partido.idinforme_csj_partido) FROM informe_csj_partido
          LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = informe_csj_partido.idinforme_cscouting_jugador
          LEFT JOIN cscouting_jugador ON cscouting_jugador.idcscouting_jugador = informe_cscouting_jugador.idcscouting_jugador            
          WHERE cscouting_jugador.idcscouting_jugador = ".$idcscouting_jugador." 
          AND informe_csj_partido.idcampeonato = ".$idcampeonato."        
          AND informe_csj_partido.tit_sup_nc_icsjp = 1                  
      ");
      while($row_4 = mysqli_fetch_assoc($resultado_4)) {
        $row['partidos_jugados_titular'] = $row_4['COUNT(informe_csj_partido.idinforme_csj_partido)'];
      } 

      // -------------------------- Cantidad de partidos jugados como SUPLENTE -------------------------- //
      // El 2 hace referencia al valor 'Suplente'. 
      $resultado_5 = $link->query("
          SELECT COUNT(informe_csj_partido.idinforme_csj_partido) FROM informe_csj_partido
          LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = informe_csj_partido.idinforme_cscouting_jugador
          LEFT JOIN cscouting_jugador ON cscouting_jugador.idcscouting_jugador = informe_cscouting_jugador.idcscouting_jugador            
          WHERE cscouting_jugador.idcscouting_jugador = ".$idcscouting_jugador." 
          AND informe_csj_partido.idcampeonato = ".$idcampeonato."        
          AND informe_csj_partido.tit_sup_nc_icsjp = 2                 
      ");
      while($row_5 = mysqli_fetch_assoc($resultado_5)) {
        $row['partidos_jugados_suplente'] = $row_5['COUNT(informe_csj_partido.idinforme_csj_partido)'];
      }

      // -------------------------- Cantidad de partidos NO JUGADOS -------------------------- //
      // El 3 hace referencia al valor 'NC' (No Compite/No jugados). 
      $resultado_6 = $link->query("
          SELECT COUNT(informe_csj_partido.idinforme_csj_partido) FROM informe_csj_partido
          LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = informe_csj_partido.idinforme_cscouting_jugador
          LEFT JOIN cscouting_jugador ON cscouting_jugador.idcscouting_jugador = informe_cscouting_jugador.idcscouting_jugador            
          WHERE cscouting_jugador.idcscouting_jugador = ".$idcscouting_jugador." 
          AND informe_csj_partido.idcampeonato = ".$idcampeonato."        
          AND informe_csj_partido.tit_sup_nc_icsjp = 3                    
      ");
      while($row_6 = mysqli_fetch_assoc($resultado_6)) {
        $row['partidos_jugados_nojugados'] = $row_6['COUNT(informe_csj_partido.idinforme_csj_partido)'];
      } 

      // -------------------------- Cantidad de Tarjetas Amarillas -------------------------- //
      $resultado_7 = $link->query("
          SELECT informe_csj_partido.t_amarilla_icsjp FROM informe_csj_partido
          LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = informe_csj_partido.idinforme_cscouting_jugador
          LEFT JOIN cscouting_jugador ON cscouting_jugador.idcscouting_jugador = informe_cscouting_jugador.idcscouting_jugador          
          WHERE cscouting_jugador.idcscouting_jugador = ".$idcscouting_jugador." 
          AND informe_csj_partido.idcampeonato = ".$idcampeonato." 
      ");
      $acumulador_t_amarillas = 0;
      while($row_7 = mysqli_fetch_assoc($resultado_7)) {
         $acumulador_t_amarillas = $acumulador_t_amarillas + $row_7['t_amarilla_icsjp'];
      } 
      $row['t_amarillas_icsjp'] = $acumulador_t_amarillas;    

      // -------------------------- Cantidad de Tarjetas Rojas -------------------------- //
      $resultado_8 = $link->query("
          SELECT informe_csj_partido.t_roja_icsjp FROM informe_csj_partido
          LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = informe_csj_partido.idinforme_cscouting_jugador
          LEFT JOIN cscouting_jugador ON cscouting_jugador.idcscouting_jugador = informe_cscouting_jugador.idcscouting_jugador          
          WHERE cscouting_jugador.idcscouting_jugador = ".$idcscouting_jugador." 
          AND informe_csj_partido.idcampeonato = ".$idcampeonato." 
      ");
      $acumulador_t_rojas = 0;
      while($row_8 = mysqli_fetch_assoc($resultado_8)) {
         $acumulador_t_rojas = $acumulador_t_rojas + $row_8['t_roja_icsjp'];
      } 
      $row['t_rojas_icsjp'] = $acumulador_t_rojas; 

      // -------------------------- Cantidad de Goles Convertidos -------------------------- //
      $resultado_9 = $link->query("
          SELECT informe_csj_partido.num_gol_icsjp FROM informe_csj_partido
          LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = informe_csj_partido.idinforme_cscouting_jugador
          LEFT JOIN cscouting_jugador ON cscouting_jugador.idcscouting_jugador = informe_cscouting_jugador.idcscouting_jugador          
          WHERE cscouting_jugador.idcscouting_jugador = ".$idcscouting_jugador." 
          AND informe_csj_partido.idcampeonato = ".$idcampeonato."
      ");
      $acumulador_goles_convertidos = 0;
      while($row_9 = mysqli_fetch_assoc($resultado_9)) {
         $acumulador_goles_convertidos = $acumulador_goles_convertidos + $row_9['num_gol_icsjp'];
      } 
      $row['num_gol_icsjp'] = $acumulador_goles_convertidos;          
        

      $dato[] = utf8_converter( $row );                                          

    }

    // var_dump( $dato );
    unset($row);

    $link->close();
    return $dato;
    
}
/* --------------------------------------------- Fin de la función 'partidos_jugador_informe_scouting' --------------------------------------------- */

/* --------------------------------------------- Inicio de la función 'partidos_jugador_informe_scouting_detalle' --------------------------------------------- */
function partidos_jugador_informe_scouting_detalle( $idcscouting_jugador ){
    include("conexion.php");

      $resultado = $link->query("
          SELECT 
          -- Tabla 'informe_csj_partido':
          informe_csj_partido.idinforme_csj_partido,
          informe_csj_partido.idcampeonato,
          informe_csj_partido.idclub,
          informe_csj_partido.fecha_icsjp,
          informe_csj_partido.jornada_icsjp,
          informe_csj_partido.posicion_icsjp,
          informe_csj_partido.tit_sup_nc_icsjp,
          informe_csj_partido.t_amarilla_icsjp,
          informe_csj_partido.t_amarilladb_icsjp,
          informe_csj_partido.t_roja_icsjp,
          informe_csj_partido.num_gol_icsjp,
          informe_csj_partido.min_entrada_icsjp,
          informe_csj_partido.min_salida_icsjp,
          informe_csj_partido.min_jugados_icsjp,
          informe_csj_partido.condicion_icsjp,
          informe_csj_partido.golequipo1_icsjp,
          informe_csj_partido.golequipo2_icsjp,
          informe_csj_partido.aspct_ofen_icsjp,
          informe_csj_partido.aspct_def_icsjp,
          informe_csj_partido.aspct_fisico_icsjp,
          informe_csj_partido.observaciones_generales_icsjp,

          -- Datos del jugador:
          fichaJugador.sexo,
          fichaJugador.serieActual,

          -- Tabla 't_club_jugador':
          t_club_jugador.idclub AS idclub_jugador,
          t_club_jugador.pais_club AS pais_club_jugador,
          t_club_jugador.division_club AS division_club_jugador,
          t_club_jugador.nombre_club AS nombre_club_jugador,

          -- Tabla 't_club_rival':
          t_club_rival.idclub AS idclub_rival,
          t_club_rival.nombre_club AS nombre_club_rival,

          -- Tabla 'campeonato':
          campeonato.idcampeonato,
          campeonato.nombre_campeonato

          FROM informe_csj_partido
          -- Datos del Informe:
          LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = informe_csj_partido.idinforme_cscouting_jugador
          -- Datos Scouting:
          LEFT JOIN cscouting_jugador ON cscouting_jugador.idcscouting_jugador = informe_cscouting_jugador.idcscouting_jugador
          -- Datos del jugador y club:
          LEFT JOIN fichaJugador_club ON fichaJugador_club.idfichaJugador_club = cscouting_jugador.idfichaJugador_club
          -- Datos del jugador:
          LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = fichaJugador_club.idfichaJugador 
          -- Datos del club del jugador:
          LEFT JOIN club AS t_club_jugador ON t_club_jugador.idclub = fichaJugador_club.idclub
          -- Datos del club rival:
          LEFT JOIN club AS t_club_rival ON t_club_rival.idclub = informe_csj_partido.idclub
          -- Datos del Campeonato:
          LEFT JOIN campeonato ON campeonato.idcampeonato = informe_csj_partido.idcampeonato
          WHERE cscouting_jugador.idcscouting_jugador = ".$idcscouting_jugador."
      ");

     while($row = mysqli_fetch_array($resultado)){ 
        $dato[] = utf8_converter($row);
    }
    
    // var_dump( $dato );
    unset($row);


    $link->close();
    return $dato;
    
}
/* --------------------------------------------- Fin de la función 'partidos_jugador_informe_scouting_detalle' --------------------------------------------- */

/* --------------------------------------------- Inicio de la función 'ver_estadisticas_informe_reporte' --------------------------------------------- */
function ver_estadisticas_informe_reporte( $idinforme_cscouting_jugador ){
  include("conexion.php");

  $dato = [];

  $resultado = $link->query("
    SELECT * FROM estadistica_informe_csj
    -- Tabla 'informe_cscouting_jugador':
    LEFT JOIN informe_cscouting_jugador ON informe_cscouting_jugador.idinforme_cscouting_jugador = estadistica_informe_csj.idinforme_cscouting_jugador
    WHERE estadistica_informe_csj.idinforme_cscouting_jugador = ".$idinforme_cscouting_jugador."
  ");


  while($row = mysqli_fetch_array($resultado)){ 
    $dato[] = utf8_converter($row);
  }
    
  // var_dump( $dato );
  unset($row);

  $link->close();
  return $dato;
    
}
/* --------------------------------------------- Fin de la función 'ver_estadisticas_informe_reporte' --------------------------------------------- */

?>