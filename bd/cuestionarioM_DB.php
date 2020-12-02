<?php
/*===========================
=            LOGIN           =
===========================*/
function cuestionario_login($datos){
    include("conexion.php");
    
    $resultado = $link->query("
        SELECT idcuestionario_usuario, rut_usuario, nombre_usuario, apellido1_usuario, apellido2_usuario
        FROM cuestionario_usuario 
        WHERE rut_usuario='".$datos['usuario']."' AND
        contrasena=MD5('".$datos['contrasena']."')
    ");
    
    while($row = mysqli_fetch_array($resultado)){
        $dato[] = $row;
    }
    
    $link->close();
    return $dato;
}
/*=====  End of LOGIN  ======*/

/////////////////////////////////////////////////