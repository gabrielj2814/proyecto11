<?php
function getDateTime(){
     $datetime_now = new DateTime();
     $datetime_now = $datetime_now->format('Y-m-d H:i:s');
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


/*===============================
=            Ejercicios            =
===============================*/
function ver_cantidad_jugadores_sexo_serie( $array_sexo, $array_numero_serie ){
    include("conexion.php");

    $dato = [];
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
        ");
        
        
        while($row = mysqli_fetch_assoc($resultado)) {
            $dato[] =  $row["COUNT(idfichaJugador)"];
        }

    }

    $link->close();
    return $dato;       
    
}

function ver_jugadores_sexo_serie( $sexo, $numero_serie ){
    include("conexion.php");
    $dato = [];

    // Consultando último registro de informe de los jugadores:
    $resultado = $link->query("
            SELECT DISTINCT informe_carga.idinforme_carga FROM informe_carga 
            LEFT JOIN informe_carga_individual ON informe_carga_individual.idinforme_carga = informe_carga.idinforme_carga
            LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_carga_individual.idfichaJugador
            WHERE fichaJugador.sexo = ".$sexo."  
            AND fichaJugador.serieActual = ".$numero_serie."
            ORDER BY informe_carga.idinforme_carga DESC
            LIMIT 1 
    ");

    
    $idinforme_carga = "";
    while($row = mysqli_fetch_assoc($resultado)) {
        $idinforme_carga = $row['idinforme_carga'];
    }

    // Si no existe ni un registro de informe, simplemente se consultan todos los jugadores:
    if( $idinforme_carga == "" ) {
        $resultado1 = $link->query("
            SELECT * FROM fichaJugador 
            WHERE sexo = ".$sexo." 
            AND serieActual = ".$numero_serie."
        ");
        $dato = [];
        while($row = mysqli_fetch_assoc($resultado1)) {
            $dato[] = utf8_converter($row);
        }
        
        $link->close();
        return $dato;        
    } else { // De lo contrario:

        // Se consultan todos los jugadores (según su sexo y serie):
        $resultado1 = $link->query("
            SELECT * FROM fichaJugador 
            WHERE sexo = ".$sexo." 
            AND serieActual = ".$numero_serie."
        ");      

            /*
            // Y el último registro de informe de estos jugadores para obtener el último peso   
            $resultado2 = $link->query("
                SELECT * FROM informe_carga_individual 
                WHERE informe_carga_individual.idinforme_carga = ".$idinforme_carga."
                AND idfichaJugador = ".$row["idfichaJugador"]."
            ");
            $informe_carga_individual = [];
            while($row2 = mysqli_fetch_assoc($resultado2)){
                $informe_carga_individual[] = $row2;
            }

            $row['informe_carga_individual'] = $informe_carga_individual;
            // echo print_r($row['informe_carga_individual']);
            $dato[] = $row;
            */   

        $dato = [];
        
        while($row = mysqli_fetch_assoc($resultado1)) {
            // echo 'id: ' . $row["idfichaJugador"] . "<br>";
            $resultado2 = $link->query("
                SELECT peso_ideal_informe_carga_individual FROM informe_carga_individual 
                WHERE informe_carga_individual.idinforme_carga = ".$idinforme_carga."
                AND idfichaJugador = ".$row["idfichaJugador"]."
            ");
            $peso_ideal_informe_carga_individual = [];
            while($row2 = mysqli_fetch_assoc($resultado2)) {
                $peso_ideal_informe_carga_individual[] = $row2["peso_ideal_informe_carga_individual"];
                //echo $row2["peso_ideal_informe_carga_individual"];
            }  
            $row['peso_ideal_informe_carga_individual'] = $peso_ideal_informe_carga_individual;
            // $dato[] = utf8_converter($row['peso_ideal_informe_carga_individual']);
            // echo print_r($row['informe_carga_individual']);
            $dato[] = utf8_converter($row);
            // unset($resultados_esperados);                         
        }
        

        $link->close();
        return $dato;          

    }        

     
    
}


function ver_todos_informe_carga_sexo_serie_fecha_inicio_fin( $sexo, $numero_serie, $inicio, $fin ){
    include("conexion.php");

    $resultado = $link->query("
            SELECT DISTINCT informe_carga.idinforme_carga, informe_carga.fecha_informe_carga
            FROM informe_carga 
            LEFT JOIN informe_carga_individual ON informe_carga_individual.idinforme_carga = informe_carga.idinforme_carga
            LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_carga_individual.idfichaJugador
            WHERE fichaJugador.sexo = ".$sexo."  
            AND fichaJugador.serieActual = ".$numero_serie."
            AND informe_carga.fecha_informe_carga BETWEEN '".$inicio."' AND '".$fin."'
    ");
    $dato = [];
    while($row = mysqli_fetch_assoc($resultado)){
        $row['fecha_software'] = getDateTime(); // <--- Prueba.
        $row['idinforme_carga'] = $row['idinforme_carga'];
        $row['fecha_informe_carga'] = $row['fecha_informe_carga'];
        // ---------------------- Cantidad total de jugadores ---------------------- //    
        $resultado1 = $link->query("
            SELECT COUNT(idfichaJugador) 
            FROM fichaJugador
            WHERE sexo = ".$sexo." AND serieActual = ".$numero_serie."
        ");
        $cantidad_total_jugadores = [];
        while($row1 = mysqli_fetch_assoc($resultado1)){
            $cantidad_total_jugadores[] = $row1['COUNT(idfichaJugador)'];
        } 

        // idinforme_carga:
        $row['idinforme_carga'] = $row['idinforme_carga'];
        // Cantidad total de jugadores:
        $row['cantidad_total_jugadores'] = $cantidad_total_jugadores;

        // ---------------------- Cantidad total de jugadores (en el informe) ---------------------- //         
        $resultado2 = $link->query("
            SELECT COUNT(informe_carga_individual.idfichaJugador) 
            FROM informe_carga_individual
            LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_carga_individual.idfichaJugador
            WHERE informe_carga_individual.idinforme_carga = ".$row['idinforme_carga']."
        ");
        $cantidad_total_jugadores_en_informe = [];
        while($row2 = mysqli_fetch_assoc($resultado2)){
            $cantidad_total_jugadores_en_informe[] = $row2['COUNT(informe_carga_individual.idfichaJugador)'];
        }        

        // Cantidad total de jugadores (en el informe):
        $row['cantidad_total_jugadores_en_informe'] = $cantidad_total_jugadores_en_informe;        


        // ---------------------- Calculando los jugadores con peso normal y con sobrepeso (del informe) ---------------------- //         
        $resultado3 = $link->query("
            SELECT * FROM informe_carga_individual
            LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_carga_individual.idfichaJugador
            WHERE informe_carga_individual.idinforme_carga = ".$row['idinforme_carga']."
        ");
        $cantidad_total_jugadores_sobre_el_peso = 0;
        $cantidad_total_jugadores_peso_normal = 0;
        while($row3 = mysqli_fetch_assoc($resultado3)){
        
            $peso_informe_carga_individual = $row3['peso_informe_carga_individual'];
            $peso_ideal_informe_carga_individual = $row3['peso_ideal_informe_carga_individual'];

            $peso_informe_carga_individual = floatval( $peso_informe_carga_individual );
            $peso_ideal_informe_carga_individual = floatval( $peso_ideal_informe_carga_individual );

            // Peso normal:
            // Si no está vacío, se incrementa a 1:
            if( $peso_informe_carga_individual != '' ) {
                $cantidad_total_jugadores_peso_normal++;    
            }

            // Peso ideal:
            // Si no está vacío... 
            if( $peso_ideal_informe_carga_individual != '' ) {
                // Si el peso normal es mayor al peso ideal, se incrementa a 1:
                if( $peso_informe_carga_individual > $peso_ideal_informe_carga_individual ) {
                    $cantidad_total_jugadores_sobre_el_peso++; 
                } 

            }
        
        } 

        $cantidad_total_normales = ($cantidad_total_jugadores_peso_normal-$cantidad_total_jugadores_sobre_el_peso);
        if ($cantidad_total_normales<0) {
            $cantidad_total_normales = 0;
        }
        // Cantidad total de jugadores con peso normal (en el informe):
        $row['cantidad_total_jugadores_peso_normal'] = $cantidad_total_normales;
        // Cantidad total de jugadores con sobrepeso (en el informe):
        $row['cantidad_total_jugadores_sobre_el_peso'] = $cantidad_total_jugadores_sobre_el_peso;                

        $dato[] = $row;          
        
    }

    $link->close();
    return $dato;       
    
}


function ver_todos_informe_carga_sexo_serie( $sexo, $numero_serie ){
    include("conexion.php");

    $resultado = $link->query("
            SELECT DISTINCT informe_carga.idinforme_carga FROM informe_carga 
            LEFT JOIN informe_carga_individual ON informe_carga_individual.idinforme_carga = informe_carga.idinforme_carga
            LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_carga_individual.idfichaJugador
            WHERE fichaJugador.sexo = ".$sexo."  AND fichaJugador.serieActual = ".$numero_serie."
    ");
    $dato = [];
    while($row = mysqli_fetch_assoc($resultado)){
        $row['fecha_software'] = getDateTime(); // <--- Prueba.
        $row['idinforme_carga'] = $row['idinforme_carga'];
        // ---------------------- Cantidad total de jugadores ---------------------- //    
        $resultado1 = $link->query("
            SELECT COUNT(idfichaJugador) 
            FROM fichaJugador
            WHERE sexo = ".$sexo." AND serieActual = ".$numero_serie."
        ");
        $cantidad_total_jugadores = [];
        while($row1 = mysqli_fetch_assoc($resultado1)){
            $cantidad_total_jugadores[] = $row1['COUNT(idfichaJugador)'];
        } 

        // idinforme_carga:
        $row['idinforme_carga'] = $row['idinforme_carga'];
        // Cantidad total de jugadores:
        $row['cantidad_total_jugadores'] = $cantidad_total_jugadores;

        // ---------------------- Cantidad total de jugadores (en el informe) ---------------------- //         
        $resultado2 = $link->query("
            SELECT COUNT(informe_carga_individual.idfichaJugador) 
            FROM informe_carga_individual
            LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_carga_individual.idfichaJugador
            WHERE informe_carga_individual.idinforme_carga = ".$row['idinforme_carga']."
        ");
        $cantidad_total_jugadores_en_informe = [];
        while($row2 = mysqli_fetch_assoc($resultado2)){
            $cantidad_total_jugadores_en_informe[] = $row2['COUNT(informe_carga_individual.idfichaJugador)'];
        }        

        // Cantidad total de jugadores (en el informe):
        $row['cantidad_total_jugadores_en_informe'] = $cantidad_total_jugadores_en_informe;        


        // ---------------------- Calculando los jugadores con peso normal y con sobrepeso (del informe) ---------------------- //         
        $resultado3 = $link->query("
            SELECT * FROM informe_carga_individual
            LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_carga_individual.idfichaJugador
            WHERE informe_carga_individual.idinforme_carga = ".$row['idinforme_carga']."
        ");
        $cantidad_total_jugadores_sobre_el_peso = 0;
        $cantidad_total_jugadores_peso_normal = 0;
        while($row3 = mysqli_fetch_assoc($resultado3)){
        
            $peso_informe_carga_individual = $row3['peso_informe_carga_individual'];
            $peso_ideal_informe_carga_individual = $row3['peso_ideal_informe_carga_individual'];

            $peso_informe_carga_individual = floatval( $peso_informe_carga_individual );
            $peso_ideal_informe_carga_individual = floatval( $peso_ideal_informe_carga_individual );

            // Peso normal:
            // Si no está vacío, se incrementa a 1:
            if( $peso_informe_carga_individual != '' ) {
                $cantidad_total_jugadores_peso_normal++;    
            }

            // Peso ideal:
            // Si no está vacío... 
            if( $peso_ideal_informe_carga_individual != '' ) {
                // Si el peso normal es mayor al peso ideal, se incrementa a 1:
                if( $peso_informe_carga_individual > $peso_ideal_informe_carga_individual ) {
                    $cantidad_total_jugadores_sobre_el_peso++; 
                } 

            }

        
        } 

        // Cantidad total de jugadores con peso normal (en el informe):
        $row['cantidad_total_jugadores_peso_normal'] = $cantidad_total_jugadores_peso_normal;
        // Cantidad total de jugadores con sobrepeso (en el informe):
        $row['cantidad_total_jugadores_sobre_el_peso'] = $cantidad_total_jugadores_sobre_el_peso;                

        $dato[] = $row;          
        
    }

    $link->close();
    return $dato;       
    
}

function ver_informe_carga_filtro_id( $id_informe_carga ){
    include("conexion.php");

        $resultado = $link->query("
            SELECT * FROM informe_carga 
            LEFT JOIN informe_carga_individual ON informe_carga_individual.idinforme_carga = informe_carga.idinforme_carga
            LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_carga_individual.idfichaJugador
            WHERE informe_carga.idinforme_carga = ".$id_informe_carga."
            "
        );
        $dato = [];
        while($row = mysqli_fetch_array($resultado)){
            $dato[] = utf8_converter($row);
        }
        $link->close();
        return $dato;       
    
}


function guardar_informe_carga($datos){
    include("conexion.php");
    if($datos['id_informe']==''){//agregar nuevo jugador

        $link->query("INSERT INTO informe_carga (
            fecha_informe_carga,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
                '".getDateTime()."',
                '".utf8_decode($datos['nombre_usuario_software'])."',
                '".getDateTime()."'
        )");

        $last_insert_id = $link->insert_id;

        for(
            $i_1 = 0,
            $i_2 = 0, //
            $i_3 = 0,
            $i_4 = 0;
            // ---------------------- //
            $i_1 < count( $datos['id_ficha_jugador'] ),
            $i_2 < count( $datos['ingresar_faltas_cometidas_informe_carga'] ),
            $i_3 < count( $datos['ingresar_peso_informe_carga'] ),
            $i_4 < count( $datos['ingresar_peso_ideal_informe_carga'] );
            // ---------------------- //
            $i_1++,
            $i_2++,
            $i_3++,
            $i_4++
        ){

            /*
            echo $datos['ingresar_faltas_cometidas_informe_carga'][$i_1] . "<br>";
            echo $datos['ingresar_peso_informe_carga'][$i_2] . "<br>";
            echo $datos['ingresar_peso_ideal_informe_carga'][$i_3] . "<br>";  
            echo $datos['nombre_usuario_software'] . "<br>";
            echo getDateTime() . "<br>";
            */

            $query = $link->query("INSERT INTO informe_carga_individual (
                idinforme_carga, 
                idfichaJugador,
                categoria_informe_carga_individual,
                peso_informe_carga_individual,
                peso_ideal_informe_carga_individual,
                fecha_informe_carga_individual,
                nombre_usuario_software,
                fecha_software
                ) VALUES (
                  ".$last_insert_id.",
                  '".utf8_decode($datos['id_ficha_jugador'][$i_1])."',
                  '".utf8_decode($datos['ingresar_faltas_cometidas_informe_carga'][$i_2])."',
                  '".utf8_decode($datos['ingresar_peso_informe_carga'][$i_3])."',
                  '".utf8_decode($datos['ingresar_peso_ideal_informe_carga'][$i_4])."',
                  '".getDateTime()."',
                  '".utf8_decode($datos['nombre_usuario_software'])."',
                  '".getDateTime()."'
            )");            
                       
        }

        if( $query )  { // will return true if succefull else it will return false
            $respuesta = 1; // INSERT ejecutado correctamente.
            // code here
        } else {
            $respuesta = 3; // Error al ejecutar INSERT...                    
        }   
            
        $link->close();
        return $respuesta;    

    }else{

        for(
            $i_1 = 0,
            $i_2 = 0, //
            $i_3 = 0,
            $i_4 = 0,
            $i_5 = 0;
            // ---------------------- //
            $i_1 < count( $datos['id_ficha_jugador'] ),
            $i_2 < count( $datos['ingresar_faltas_cometidas_informe_carga'] ),
            $i_3 < count( $datos['ingresar_peso_informe_carga'] ),
            $i_4 < count( $datos['ingresar_peso_ideal_informe_carga'] ),
            $i_5 < count( $datos['idinforme_carga_individual'] );
            // ---------------------- //
            $i_1++,
            $i_2++,
            $i_3++,
            $i_4++,
            $i_5++
        ){

            /*
            echo $datos['ingresar_faltas_cometidas_informe_carga'][$i_2] . ' - ' . $datos['ingresar_peso_informe_carga'][$i_3] . ' - ' . $datos['ingresar_peso_ideal_informe_carga'][$i_4] . ' - ' . $datos['nombre_usuario_software'] . ' - ' . $datos['idinforme_carga_individual'][$i_5] . ' - ' . $datos['id_ficha_jugador'][$i_1];

            echo "<hr/>";
            */

            
            $query = $link->query("UPDATE 
                informe_carga_individual SET 
                categoria_informe_carga_individual = '".utf8_decode( $datos['ingresar_faltas_cometidas_informe_carga'][$i_2] )."',
                peso_informe_carga_individual = '".utf8_decode( $datos['ingresar_peso_informe_carga'][$i_3] )."',
                peso_ideal_informe_carga_individual = '".utf8_decode( $datos['ingresar_peso_ideal_informe_carga'][$i_4] )."',
                fecha_informe_carga_individual = '".getDateTime()."',
                nombre_usuario_software = '".utf8_decode( $datos['nombre_usuario_software'] )."',
                fecha_software = '".getDateTime()."' 
                WHERE idinforme_carga_individual = ".$datos['idinforme_carga_individual'][$i_5]." AND idfichaJugador = ".$datos['id_ficha_jugador'][$i_1]."
            ");
            

        }

        // echo "ID INFORME: " . $datos['id_informe'];

        if( isset( $datos['id_jugador_agregado'] ) ) {

            // ------------------------------- AGREGANDO JUGADOR --------------------------------- //
            for( $i = 0; $i < count($datos['id_jugador_agregado']); $i++ ) {

                $query = $link->query("INSERT INTO informe_carga_individual (
                    idinforme_carga, 
                    idfichaJugador,
                    categoria_informe_carga_individual,
                    peso_informe_carga_individual,
                    peso_ideal_informe_carga_individual,
                    fecha_informe_carga_individual,
                    nombre_usuario_software,
                    fecha_software
                    ) VALUES (
                      ".$datos['id_informe'].",
                      ".$datos['id_jugador_agregado'][$i].",
                      '".utf8_decode($datos['ingresar_faltas_cometidas_informe_carga_ja'][$i])."',
                      '".utf8_decode($datos['ingresar_peso_informe_carga_ja'][$i])."',
                      '".utf8_decode($datos['ingresar_peso_ideal_informe_carga_ja'][$i])."',
                      '".getDateTime()."',
                      '".utf8_decode($datos['nombre_usuario_software'])."',
                      '".getDateTime()."'
                )");            
                           
            }  

        } 

              

        if( $query )  { // will return true if succefull else it will return false
            $respuesta = 2; // UPDATE ejecutado correctamente.
            // code here
        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        }   
            
        $link->close();
        return $respuesta;         

    }


}

function eliminar_informe_carga($id){
    include("conexion.php");
    $query = $link->query("DELETE FROM informe_carga_individual WHERE idinforme_carga = ".$id." ");
    if( $query )  { 

        $query = $link->query("DELETE FROM informe_carga WHERE idinforme_carga = ".$id." ");
        if( $query )  { 
            return 1;
        } else {
            return $link->error; // Error al ejecutar UPDATE...                    
            $link->close();
        }   
    
    } else {
        return $link->error; // Error al ejecutar UPDATE...                    
        $link->close();
    }      
    
}

/*=====  End of BODEGAS  ======*/


function buscar_datosPDF($id){
    include("conexion.php");

    $resultado = $link->query("
        SELECT * FROM informe_carga
            LEFT JOIN informe_carga_individual ON informe_carga_individual.idinforme_carga = informe_carga.idinforme_carga
            LEFT JOIN fichaJugador ON fichaJugador.idfichaJugador = informe_carga_individual.idfichaJugador
        WHERE informe_carga.idinforme_carga = ".$id."        
    ");

     while($row = mysqli_fetch_array($resultado)){ 
        $dato[] = utf8_converter($row);
    }
    
    // var_dump( $dato );
    unset($row);

    
    $link->close();
    return $dato;
    
}

?>