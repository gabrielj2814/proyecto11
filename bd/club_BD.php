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

function ver_datos( $datos ){
    include("conexion.php");
    
    $dato = [];

    $tipo_consulta = $datos['tipo_consulta'];
    
    switch( $tipo_consulta ) {

        case '1':
            $string = $datos['string'];
            $pais_club = $datos['pais_club'];
            
            // País:
            $f_paisclub = "";
            // 0 = Todos
            if( $pais_club == '0' ) {
                $f_paisclub = "1 = 1";
            } else {
                $f_paisclub = "pais_club = '".$pais_club."'";
            }            

            if( $string=='' ) {

                $resultado = $link->query("
                    SELECT * FROM club
                    WHERE ".$f_paisclub."
                ");

            } else {

                $resultado = $link->query("
                    SELECT * FROM club
                    WHERE nombre_club LIKE '".$string."%'
                    AND ".$f_paisclub."
                ");

            }
            while( $row = mysqli_fetch_assoc( $resultado ) ) {
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

    if($datos['idclub']==''){//agregar nuevo jugador

        $tipo_pais_club = '';
        if( in_array( $datos['pais_club'], $array_paises ) ) {
            $tipo_pais_club = 1;
        } else {
            $tipo_pais_club = 2;
        }

        $query = $link->query("INSERT INTO club (
            pais_club,
            tipo_pais_club,
            nombre_club,
            division_club,
            entrenador_club,
            nombre_usuario_software,
            fecha_software
            ) VALUES (
              '".utf8_decode($datos['pais_club'])."',
              '".utf8_decode($tipo_pais_club)."',
              '".utf8_decode($datos['nombre_club'])."',
              '".utf8_decode($datos['division_club'])."',
              '".utf8_decode($datos['entrenador_club'])."',
              '".utf8_decode($datos['nombre_usuario_software'])."',
              '".getDateTime()."'
        )");

        if( $query )  { 

            // Valor del ID del jugador recién insertado:
            $idclub = $link->insert_id;            

            // ------------------- FOTO --------------- //
            if( isset($_FILES['foto_club']['name']) ){
                if( $_FILES['foto_club']['name'] == '' ) {
                    copy('../img/default.png', '../foto_clubes/'.$idclub.'.png');
                } else {
                    copy('../subir_imagen3/buffer_imagen.png', '../foto_clubes/'.$idclub.'.png');
                }

            } else{ // Si no selecciona foto (registro de usuario con nuevo perfil)... 
                copy('../subir_imagen3/buffer_imagen.png', '../foto_clubes/'.$idclub.'.png');
            }

            $respuesta = 1; // INSERT ejecutado correctamente.
        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        }   
            
    }else{

        $tipo_pais_club = '';
        if( in_array( $datos['pais_club'], $array_paises ) ) {
            $tipo_pais_club = 1;
        } else {
            $tipo_pais_club = 2;
        }

        $query = $link->query("UPDATE club SET 
            pais_club = '".$datos['pais_club']."',
            tipo_pais_club = '".$tipo_pais_club."',
            nombre_club = '".utf8_decode(ucwords(strtolower($datos['nombre_club'])))."',
            division_club = '".$datos['division_club']."',
            entrenador_club = '".utf8_decode(ucwords(strtolower($datos['entrenador_club'])))."',
            nombre_usuario_software = '".utf8_decode(ucwords(strtolower($datos['nombre_usuario_software'])))."',
            fecha_software = '".getDateTime()."'
            WHERE idclub = ".$datos['idclub']."
        "); 

        if( $query )  { 

            $idclub = $datos['idclub'];            

            // ------------------- FOTO --------------- //
            if( isset($_FILES['foto_club']['name']) ){
                if( $_FILES['foto_club']['name'] == '' ) {
                    
                    if (!file_exists('../foto_clubes/'.$idclub.'.png')) {
                        copy('../img/default.png', '../foto_clubes/'.$idclub.'.png');
                    } else {
                        copy('../foto_clubes/'.$datos['idclub'].'.png', '../'.$datos['foto_anterior_club']);
                    }

                } else {
                    copy('../subir_imagen3/buffer_imagen.png', '../foto_clubes/'.$datos['idclub'].'.png');
                }

            } else{ // Si no selecciona foto (registro de usuario con nuevo perfil)... 
                copy('../subir_imagen3/buffer_imagen.png', '../foto_clubes/'.$datos['idclub'].'.png');
            }            

            $respuesta = 2; // UPDATE ejecutado correctamente.
        } else {
            $respuesta = $link->error; // Error al ejecutar UPDATE...                    
        } 

    }
    
    $link->close();
    return $respuesta;

}

function eliminar($id){
    include("conexion.php");
    $query = $link->query("DELETE FROM club WHERE idclub = ".$id." ");
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
        SELECT * FROM club
        WHERE idclub = ".$id."        
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