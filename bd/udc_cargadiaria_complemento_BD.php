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
                 
                // Última informe de gestión de talento:
                $resultado2 = $link->query("
                    SELECT * FROM udc_gestion_talento
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = udc_gestion_talento.idfichaJugador
                    WHERE udc_gestion_talento.idfichaJugador = ".$idfichaJugador."
                    ORDER BY udc_gestion_talento.idudc_gestion_talento DESC
                    LIMIT 1 
                ");

                while( $row2 = mysqli_fetch_assoc( $resultado2 ) ) {
                    $row['idudc_gestion_talento'] = $row2['idudc_gestion_talento'];
                    $row['idfichaJugador'] = $row2['idfichaJugador'];
                    $row['fecha_talento'] = $row2['fecha_talento'];
                    $row['perfil_comunicacional_talento'] = $row2['perfil_comunicacional_talento'];
                    $row['reputacion_deportiva_talento'] = $row2['reputacion_deportiva_talento'];
                    $row['redes_sociales_talento'] = $row2['redes_sociales_talento'];
                    $row['aspectos_mejorar_talento'] = $row2['aspectos_mejorar_talento'];
                    $row['actividades_realizar_talento'] = $row2['actividades_realizar_talento'];
                    $row['status_talento'] = $row2['status_talento'];
                } 

                // Cantidad de registros de informes de gestión de talento:
                $resultado3 = $link->query("
                    SELECT COUNT(udc_gestion_talento.idudc_gestion_talento) FROM udc_gestion_talento
                    LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = udc_gestion_talento.idfichaJugador
                    WHERE udc_gestion_talento.idfichaJugador = ".$idfichaJugador."
                ");

                while( $row3 = mysqli_fetch_assoc( $resultado3 ) ) {
                    $row['cantidad_informes_gestion_talento'] = $row3['COUNT(udc_gestion_talento.idudc_gestion_talento)'];
                }                             
                
                // Consultando posiciones:
                $resultado_4 = $link->query("
                SELECT 
                posicionCancha.posicion,
                posicionCancha.numero_posicion
                FROM fichaJugador        
                -- Datos de la posición:
                LEFT JOIN posicionCancha ON posicionCancha.idfichaJugador = fichaJugador.idfichaJugador 
                WHERE posicionCancha.idfichaJugador = ".$idfichaJugador."        
                ");

                while($row_4 = mysqli_fetch_assoc($resultado_4)) {  
                    $posicion = $row_4['posicion'];
                    $numero_posicion = $row_4['numero_posicion']; 
                    $row['posicion'.$numero_posicion] = $posicion;                                        
                }

                // $row["ultimos_datos_social"] = $ultimos_datos_social;
                $dato[] = utf8_converter( $row );          

            
            }
            break;

        case '2':
            $idfichaJugador = $datos['idfichaJugador']; 
            
            $resultado = $link->query("
                SELECT * FROM udc_cargadiaria_proyecto 
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = udc_cargadiaria_proyecto.idfichaJugador
                WHERE udc_cargadiaria_proyecto.idfichaJugador = ".$idfichaJugador." 
            ");
                
            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                $dato[] = utf8_converter( $row );          
            }
            break; 

        case '3':
            $idudc_gestion_talento = $datos['idudc_gestion_talento']; 
            
            $resultado = $link->query("
                SELECT * FROM udc_gestion_talento 
                WHERE idudc_gestion_talento = ".$idudc_gestion_talento." 
            ");
                
            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                $dato[] = utf8_converter( $row );          
            }
            break;  

        case '4':
            $idfichaJugador = $datos['idfichaJugador'];
            $anio = $datos['anio'];
            $meses = $datos['mes']; 
            $dias_por_mes = [];

            if( $meses !== "null" ) {

                if (in_array('0', $meses)) {

                    $array_meses = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

                    $array_fechas_por_mes = [];
                    $array_categoria_por_mes = [];
                    $array_peso_por_mes = [];                        
                    $array_fecha_carga_por_mes = [];
                    $array_mes = [];

                    for ($i=0; $i < count( $array_meses ); $i++) { 
                        
                        $mes = $array_meses[$i];
                        $mes = intval( $mes );
                        $array_mes[] = $mes;

                        $dias_por_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
                        
                        $fecha_por_mes = array();

                        $fecha_carga_por_mes = [];
                        $categoria_por_mes = [];
                        $peso_por_mes = [];
                        for( $d=1; $d <= $dias_por_mes; $d++ ) {
                            
                            $array_meses[$i] = intval( $array_meses[$i] );
                            if( $array_meses[$i] < 10 ) {
                                $array_meses[$i] = '0' . $array_meses[$i];
                            }

                            if( $d < 10 ) {
                                $d = '0' . $d;
                            }                    

                            $time = $anio . '-' . $array_meses[$i] . '-' . $d;
                            $fecha_por_mes[] = $time;

                            // echo $time . "<br>";
                            $resultado = $link->query("
                                    SELECT 
                                    categoria_informe_carga_individual,
                                    peso_informe_carga_individual,
                                    fecha_informe_carga_individual
                                    FROM informe_carga_individual 
                                    WHERE idfichaJugador = ".$idfichaJugador." AND fecha_informe_carga_individual = '".$time."'
                                ");

                            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                                // $categoria_por_mes[] = $row['categoria_informe_carga_individual'];
                                // $peso_por_mes[] = $row['peso_informe_carga_individual'];
                                $fecha_carga_por_mes[] = $row['fecha_informe_carga_individual'];
                            }

                        }

                        $fecha_carga_por_mes = array_unique($fecha_carga_por_mes);
                        $fecha_carga_por_mes = array_values($fecha_carga_por_mes);
                        $fecha_carga_por_mes_norep = []; // <---- Array de las fechas de cargas por mes sin valores repetidos.                        
                        foreach ($fecha_carga_por_mes as $fecha_carga_mes ) {
                            // echo $fecha_carga_por_mes[$i] . " - ";
                            $resultado = $link->query("
                                    SELECT 
                                    categoria_informe_carga_individual,
                                    peso_informe_carga_individual,
                                    fecha_informe_carga_individual
                                    FROM informe_carga_individual 
                                    WHERE idfichaJugador = ".$idfichaJugador." AND fecha_informe_carga_individual = '".$fecha_carga_mes."'
                                    ORDER BY idinforme_carga_individual DESC LIMIT 1

                                ");

                            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                                $categoria_por_mes[] = $row['categoria_informe_carga_individual'];
                                $peso_por_mes[] = $row['peso_informe_carga_individual'];
                                $fecha_carga_por_mes_norep[] = $row['fecha_informe_carga_individual'];
                            } 
                        }

                        $array_fechas_por_mes[] = $fecha_por_mes;
                        $array_categoria_por_mes[] = $categoria_por_mes;
                        $array_peso_por_mes[] = $peso_por_mes;
                        $array_fecha_carga_por_mes[] = $fecha_carga_por_mes_norep;
                        // $row['mes'] = $mes;
                    
                    }       

                    // var_dump($array_mes);

                    $array_fechas_todos = [];
                    $array_categorias_todos = [];
                    $array_pesos_todos = [];
                    $array_fecha_carga_por_mes_todos = [];

                    foreach ($array_fechas_por_mes as $array) {
                        $array_fechas_todos = array_merge($array_fechas_todos, $array);
                    }

                    foreach ($array_categoria_por_mes as $array) {
                        $array_categorias_todos = array_merge($array_categorias_todos, $array);
                    }

                    foreach ($array_peso_por_mes as $array) {
                        $array_pesos_todos = array_merge($array_pesos_todos, $array);
                    }

                    foreach ($array_fecha_carga_por_mes as $array) {
                        $array_fecha_carga_por_mes_todos = array_merge($array_fecha_carga_por_mes_todos, $array);
                    }                                                            

                    // var_dump($array_fechas);

                    $dato[] = utf8_converter( $array_fechas_por_mes );
                    $dato[] = utf8_converter( $array_fechas_todos );

                    $dato[] = utf8_converter( $array_categoria_por_mes );
                    $dato[] = utf8_converter( $array_categorias_todos );

                    $dato[] = utf8_converter( $array_peso_por_mes );
                    $dato[] = utf8_converter( $array_pesos_todos ); 

                    $dato[] = utf8_converter( $array_fecha_carga_por_mes );
                    $dato[] = utf8_converter( $array_fecha_carga_por_mes_todos );

                    $dato[] = utf8_converter( $array_mes );
                    // ------------------------------------------------------- //                

                } else {

                    $array_fechas_por_mes = [];
                    $array_categoria_por_mes = [];
                    $array_peso_por_mes = [];
                    $array_fecha_carga_por_mes = [];
                    $array_mes = [];

                    for ( $i=0; $i < count($meses); $i++ ) {

                        $mes = $meses[$i];
                        $mes = intval( $mes );
                        
                        $array_mes[] = $mes;

                        $dias_por_mes = cal_days_in_month(CAL_GREGORIAN, $mes, $anio);
                        
                        $fecha_por_mes = array();

                        $fecha_carga_por_mes = [];
                        $categoria_por_mes = [];
                        $peso_por_mes = [];
                        
                        for( $d=1; $d <= $dias_por_mes; $d++ ) {
                            
                            $meses[$i] = intval( $meses[$i] );
                            if( $meses[$i] < 10 ) {
                                $meses[$i] = '0' . $meses[$i];
                            }

                            if( $d < 10 ) {
                                $d = '0' . $d;
                            }                    

                            $time = $anio . '-' . $meses[$i] . '-' . $d;
                            $fecha_por_mes[] = $time;

                            // echo $time . "<br>";
                            $resultado = $link->query("
                                    SELECT 
                                    categoria_informe_carga_individual,
                                    peso_informe_carga_individual,
                                    fecha_informe_carga_individual
                                    FROM informe_carga_individual 
                                    WHERE idfichaJugador = ".$idfichaJugador." AND fecha_informe_carga_individual = '".$time."'
                                ");

                            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                                // $categoria_por_mes[] = $row['categoria_informe_carga_individual'];
                                // $peso_por_mes[] = $row['peso_informe_carga_individual'];
                                $fecha_carga_por_mes[] = $row['fecha_informe_carga_individual'];
                            }

                        }

                        $fecha_carga_por_mes = array_unique($fecha_carga_por_mes);
                        $fecha_carga_por_mes = array_values($fecha_carga_por_mes);
                        $fecha_carga_por_mes_norep = []; // <---- Array de las fechas de cargas por mes sin valores repetidos.                        
                        foreach ($fecha_carga_por_mes as $fecha_carga_mes ) {
                            // echo $fecha_carga_por_mes[$i] . " - ";
                            $resultado = $link->query("
                                    SELECT 
                                    categoria_informe_carga_individual,
                                    peso_informe_carga_individual,
                                    fecha_informe_carga_individual
                                    FROM informe_carga_individual 
                                    WHERE idfichaJugador = ".$idfichaJugador." AND fecha_informe_carga_individual = '".$fecha_carga_mes."'
                                    ORDER BY idinforme_carga_individual DESC LIMIT 1

                                ");

                            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                                $categoria_por_mes[] = $row['categoria_informe_carga_individual'];
                                $peso_por_mes[] = $row['peso_informe_carga_individual'];
                                $fecha_carga_por_mes_norep[] = $row['fecha_informe_carga_individual'];
                            } 
                        }

                        $array_fechas_por_mes[] = $fecha_por_mes;
                        $array_categoria_por_mes[] = $categoria_por_mes;
                        $array_peso_por_mes[] = $peso_por_mes;
                        $array_fecha_carga_por_mes[] = $fecha_carga_por_mes_norep;
                        // $row['mes'] = $mes;
                    
                    }       

                    // var_dump($array_mes);

                    $array_fechas_todos = [];
                    $array_categorias_todos = [];
                    $array_pesos_todos = [];
                    $array_fecha_carga_por_mes_todos = [];

                    foreach ($array_fechas_por_mes as $array) {
                        $array_fechas_todos = array_merge($array_fechas_todos, $array);
                    }

                    foreach ($array_categoria_por_mes as $array) {
                        $array_categorias_todos = array_merge($array_categorias_todos, $array);
                    }

                    foreach ($array_peso_por_mes as $array) {
                        $array_pesos_todos = array_merge($array_pesos_todos, $array);
                    }

                    foreach ($array_fecha_carga_por_mes as $array) {
                        $array_fecha_carga_por_mes_todos = array_merge($array_fecha_carga_por_mes_todos, $array);
                    }                                                            

                    // var_dump($array_fechas);

                    $dato[] = utf8_converter( $array_fechas_por_mes );
                    $dato[] = utf8_converter( $array_fechas_todos );

                    $dato[] = utf8_converter( $array_categoria_por_mes );
                    $dato[] = utf8_converter( $array_categorias_todos );

                    $dato[] = utf8_converter( $array_peso_por_mes );
                    $dato[] = utf8_converter( $array_pesos_todos ); 

                    $dato[] = utf8_converter( $array_fecha_carga_por_mes );
                    $dato[] = utf8_converter( $array_fecha_carga_por_mes_todos );

                    $dato[] = utf8_converter( $array_mes );                                        

                }

            }            
            break;                                    

        case '5':
            $idfichaJugador = $datos['idfichaJugador']; 
            
            $resultado = $link->query("
                SELECT * FROM udc_cargadiaria_sesion 
                LEFT JOIN udc_cargadiaria_proyecto ON udc_cargadiaria_proyecto.idudc_cargadiaria_proyecto = udc_cargadiaria_sesion.idudc_cargadiaria_proyecto 
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = udc_cargadiaria_proyecto.idfichaJugador
                WHERE udc_cargadiaria_proyecto.idfichaJugador = ".$idfichaJugador."                
            ");
                
            while( $row = mysqli_fetch_assoc( $resultado ) ) {
                $dato[] = utf8_converter( $row ); 
            }
            break; 

        case '6':
            $idfichaJugador = $datos['idfichaJugador']; 
            
            // Última informe de gestión de talento:
            $resultado = $link->query("
                SELECT COUNT(udc_cargadiaria_sesion.idudc_cargadiaria_sesion) FROM udc_cargadiaria_sesion
                LEFT JOIN udc_cargadiaria_proyecto ON udc_cargadiaria_proyecto.idudc_cargadiaria_proyecto = udc_cargadiaria_sesion.idudc_cargadiaria_proyecto 
                LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = udc_cargadiaria_proyecto.idfichaJugador
                WHERE udc_cargadiaria_proyecto.idfichaJugador = ".$idfichaJugador."
            ");
                
            while( $row = mysqli_fetch_assoc( $resultado ) ) {           
                $dato[] = utf8_converter( $row ); 
            }
            break;             

        // ------------------------------------ TODOS LOS PROYECTOS  ------------------------------------ // 
        case 'buscar_proyectos_todos':
            $idfichaJugador = $datos['idfichaJugador'];
            $resultado = $link->query("
                SELECT * FROM udc_cargadiaria_proyecto
                WHERE idfichaJugador = ".$idfichaJugador."
            ");
            while($row = mysqli_fetch_assoc($resultado)) {
                $dato[] = utf8_converter( $row );
            }                 
            break;            

    }


    $link->close();
    return $dato;       
    
}

function guardar_proyecto($datos){
    include("conexion.php");
    $respuesta = "";
    $query = "";
    if($datos['idudc_cargadiaria_proyecto']==''){//agregar nuevo jugador
        $query = $link->query("INSERT INTO udc_cargadiaria_proyecto (
            idfichaJugador,
            nombre_cargadiaria_proyecto,
            fechainicio_cargadiaria_proyecto,
            objetivos_cargadiaria_proyecto,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
              '".utf8_decode($datos['idfichaJugador'])."',
              '".utf8_decode($datos['nombre_cargadiaria_proyecto'])."',
              '".utf8_decode($datos['fechainicio_cargadiaria_proyecto'])."',
              '".utf8_decode($datos['objetivos_cargadiaria_proyecto'])."',
              '".utf8_decode($datos['nombre_usuario_software'])."',
              '".getDateTime()."'
        )");

        if( $query )  { 
            $respuesta = 1; // INSERT ejecutado correctamente.
        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        }   
            
    }else{
        $query = $link->query("UPDATE udc_cargadiaria_proyecto SET 
            nombre_cargadiaria_proyecto = '".utf8_decode(ucwords(strtolower($datos['nombre_cargadiaria_proyecto'])))."',
            fechainicio_cargadiaria_proyecto = '".utf8_decode(ucwords(strtolower($datos['fechainicio_cargadiaria_proyecto'])))."',
            objetivos_cargadiaria_proyecto = '".utf8_decode(ucwords(strtolower($datos['objetivos_cargadiaria_proyecto'])))."',
            nombre_usuario_software = '".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
            fecha_software = '".getDateTime()."'
            WHERE idudc_cargadiaria_proyecto = '".$datos['idudc_cargadiaria_proyecto']."'
        "); 

        if( $query )  { 
            $respuesta = 2; // UPDATE ejecutado correctamente.
        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        } 

    }
    
    $link->close();
    return $respuesta;

}

function guardar_sesion($datos){
    include("conexion.php");
    $respuesta = "";
    $query = "";
    if($datos['idudc_cargadiaria_sesion']==''){//agregar nuevo jugador
        $query = $link->query("INSERT INTO udc_cargadiaria_sesion (
            idudc_cargadiaria_proyecto,
            fecha_cargadiaria_sesion,
            detalle_cargadiraria_sesion,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
              ".utf8_decode($datos['idudc_cargadiaria_proyecto']).",
              '".utf8_decode($datos['fecha_cargadiaria_sesion'])."',
              '".utf8_decode($datos['detalle_cargadiraria_sesion'])."',
              '".utf8_decode($datos['nombre_usuario_software'])."',
              '".getDateTime()."'
        )");

        if( $query )  { 
            $respuesta = 1; // INSERT ejecutado correctamente.
        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        }   
            
    }else{
        $query = $link->query("UPDATE udc_cargadiaria_sesion SET 
            idudc_cargadiaria_proyecto = ".utf8_decode($datos['idudc_cargadiaria_proyecto']).",
            fecha_cargadiaria_sesion = '".utf8_decode(ucwords(strtolower($datos['fecha_cargadiaria_sesion'])))."',
            detalle_cargadiraria_sesion = '".utf8_decode(ucwords(strtolower($datos['detalle_cargadiraria_sesion'])))."',
            fecha_software = '".getDateTime()."'
            WHERE idudc_cargadiaria_sesion = '".$datos['idudc_cargadiaria_sesion']."'
        "); 

        if( $query )  { 
            $respuesta = 2; // UPDATE ejecutado correctamente.
        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        } 

    }
    
    $link->close();
    return $respuesta;

}

function eliminar_proyecto($id){
    include("conexion.php");
    $query = $link->query("DELETE FROM udc_cargadiaria_proyecto WHERE idudc_cargadiaria_proyecto = ".$id." ");
    if( $query )  { 
        return 1;                   
        $link->close();
    } else {
        return $link->error; // Error al ejecutar UPDATE...                    
        $link->close();
    }      
    
}

function eliminar_sesion($id){
    include("conexion.php");
    $query = $link->query("DELETE FROM udc_cargadiaria_sesion WHERE idudc_cargadiaria_sesion = ".$id." ");
    if( $query )  { 
        return 1;                   
        $link->close();
    } else {
        return $link->error; // Error al ejecutar UPDATE...                    
        $link->close();
    }      
    
}

?>