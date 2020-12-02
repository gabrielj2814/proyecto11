<?php
    include('../config/datos.php');
    session_start();
    if(!(isset($_SESSION["nombre_usuario_software"]))){
        session_destroy();
        header('Location: ../index.php?cerrar_sesion=1');
    }else{

        include('../bd/ffch_ayuda_social_BD.php');
        $menu_actual="ffch";
        $submenu_actual="ffch_ayuda_social";
        $seccion_comentarios = $comentarios['ffch_ayuda_social'];//mis cuotas
        $demo_seccion = $demo['ffch_ayuda_social'];
        $nombre_pestana_navegador='FFCH';
        
        $datetime_now = new DateTime();
        $date_hoy = new DateTime();
        $datetime_now = $datetime_now->format('Y-m-d H:i:s');
        $year = $date_hoy->format('Y');
        $date_hoy = $date_hoy->format('Y-m-d');
        $data = explode(" ", $datetime_now);
        $ano_actual =  date("Y");
        $mes_actual =  date("m");

        $series         = ver_series_total();
        $posicion_j     = ver_posicion_jug();
        $arreglo_posicion1      = $posicion_j[0];
        $arreglo_posicion1_d    = $posicion_j[1];
        $arreglo_posicion2      = $posicion_j[2];
        $arreglo_posicion2_d    = $posicion_j[3];
        
        $nombre_mess    = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

?>   

<!DOCTYPE html> 
<html lang="es"> 
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title><?php echo $nombre_pestana_navegador;?> | Ayudas Sociales</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/fullcalendar.css" />
<link rel="stylesheet" href="css/matrix-style.css" />
<link rel="stylesheet" href="css/matrix-media.css" />
<link rel="stylesheet" href="font-awesome_3.2.1/css/font-awesome.css" />
<link rel="stylesheet" href="css/jquery.gritter.css" />
<link rel='stylesheet' href='css/font_googleapis.css' type='text/css'>
<link rel='stylesheet' href='css/comentarios.css' type='text/css'>
<link rel='stylesheet' href='../print_js/print.min.css' type='text/css'>
<link href="bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">

<style type="text/css">
    .sin_fondo:hover{
        background-color:transparent; 
    } 

    .boton_eliminar2{
        padding-left: 3px;
        padding-right: 3px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #fb973e; 
        color: #fb973e;
        border-radius:2px;
        cursor:pointer;
        margin-right:8px;
    }
    .boton_eliminar2:hover{
        padding-left: 3px;
        padding-right: 3px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #6e6d6c; 
        color: #6e6d6c;
        border-radius:2px;
        cursor:pointer;
        margin-right:8px;
    }
    .boton_refresh{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border:3px solid #e19830; 
        color: #e19830;
        border-radius:2px;
    } 
    .boton_refresh:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #8f5708; 
        color: #8f5708;
        border-radius:2px;
    } 
    .panel_seleccionar_serie:hover{ 
        background-color:#f7b48b; 
        color:white; 
    } 
    .panel_seleccionar_serie_inhabilitada{ 
        background-color:#ffa42d; 
        color:black; 
    } 
    .panel_seleccionar_serie{ 
        background-color:#ffa42d; 
        color:black; 
    } 
    
    .tabla_1_sin_efecto{
        border: 2px solid white; 
        color:white; 
        background-color:black; 
        opacity:0.5;
    }
    .tabla_1_sin_efecto:hover{
        border: 2px solid white; 
        color:white; 
        background-color:black; 
        opacity:0.5;
    }
    .tabla_2_sin_efecto{
        background-color:transparent;
        color:white; 
    }
    .tabla_2_sin_efecto:hover{
        background-color:transparent;
        color:white; 
    }

    .boton_informe_jugador{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #555555; 
        color: #555555;
        border-radius:5px;
    }
    .boton_informe_jugador:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #8f8f8f; 
        color: #8f8f8f;
        border-radius:5px;
    }
    .boton_menu_desactivado{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: <?php echo $color_fondo; ?>;
        border: 3px solid black; 
        color: black;
        border-radius:5px;
    }
    .boton_menu{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid <?php echo $color_fondo; ?>; 
        color: <?php echo $color_fondo; ?>;
        border-radius:5px;
    }
    .boton_menu:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: <?php echo $color_fondo; ?>;
        border: 3px solid black; 
        color: black;
        border-radius:5px;
    }
    .boton_menu:disabled{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 5px solid black; 
        color: black;
        border-radius:2px;
    }
    .checkeado {
        color: orange;
    }
    .panel_seleccionar_serie:hover .checkeado {
        color: <?php echo $color_fondo; ?>;
    }


    

    .panel_buscar {
        height:27px; 
        cursor:pointer; 
        color:#555555; 
        font-size:13px;
    }

    .panel_buscar_claro {
        background-color: #ffcd43;
    }

    .panel_buscar_oscuro {
        background-color: #ffbb00;
    }

    .panel_buscar_claro:hover{
        background-color: #ffbb00;
    }

    .panel_buscar:hover{
        background-color: #ffbb00;
    }    

    .boton_volver{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 1px solid <?php echo $color_fondo; ?>; 
        color: <?php echo $color_fondo; ?>;
        border-radius:10px;
    }
    .boton_volver:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 1px solid black; 
        color: black;
        border-radius:10px;
    }
    
    .boton_eliminar4{
        cursor: pointer;
        position: absolute;
        margin-left: -18px;
        margin-top: -7px;
        border: solid 1px red;
        padding: 1px 5px 2px 5px;
        border-radius: 50px;
        background-color: red;
        color: #E8E6E6;
        font-size: 16px;
    }

      .boton_eliminar4:hover {
        cursor: pointer;
        position: absolute;
        margin-left: -18px;
        margin-top: -7px;
        border: solid 1px red;
        padding: 1px 5px 2px 5px;
        border-radius: 50px;
        background-color: red;
        color: #fff;
        font-size: 17px;
    }
    .boton_eliminar4:disabled{
        cursor: pointer;
        position: absolute;
        margin-left: -18px;
        margin-top: -7px;
        border: solid 1px red;
        padding: 1px 5px 2px 5px;
        border-radius: 50px;
        background-color: red;
        color: #E8E6E6;
        font-size: 16px;
    }
    
    /* -------------------------- Botón de Eliminar -------------------------- */
    .boton_eliminar{
        padding-left: 3px;
        padding-right: 3px;
        text-shadow: none; 
        background-color: #f44336;
        border-left:1px solid  #f44336; 
        border-right: 1px solid  #f44336;
        font-size:16px;
        text-align: center;
        color: #fff;
        border-radius:5px;
        width: 20px;
        height:20px;
    }
    .boton_eliminar:hover{
        padding-left: 3px;
        padding-right: 3px;
        text-shadow: none; 
        background-color: #D83F25;
        border-left:1px solid  #D83F25; 
        border-right: 1px solid  #D83F25;
        font-size:16px;
        color: #ffffff;
        border-radius:5px;
        width: 20px;
        height:20px;
    }
    .boton_eliminar:disabled{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: #28b779;
        border: 3px solid rgba(0, 0, 0, .2);    
        color: #fff;
        border-radius:2px;
    }

    .boton_menu_desactivado{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: <?php echo $color_fondo; ?>;
        border: 3px solid black; 
        color: black;
        border-radius:5px;
    }


    
    /* -------------------------- Botón de Editar -------------------------- */
    .boton_editar{
        padding-left: 3px;
        padding-right: 3px;
        text-shadow: none; 
        background-color: #1d9663;
        border-left:1px solid  #1d9663; 
        border-right: 1px solid  #1d9663;
        font-size:16px;
        text-align: center;
        color: #fff;
        border-radius:5px;
        width: 20px;
        height:20px;
    }
    .boton_editar:hover{
        padding-left: 3px;
        padding-right: 3px;
        text-shadow: none; 
        background-color: #45b384;
        border-left:1px solid  #45b384; 
        border-right: 1px solid  #45b384;
        font-size:16px;
        color: #ffffff;
        border-radius:5px;
        width: 20px;
        height:20px;
    }
    .boton_editar:disabled{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: #28b779;
        border: 3px solid rgba(0, 0, 0, .2);    
        color: #fff;
        border-radius:2px;
    }
    
    .boton_ver{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid <?php echo $color_fondo; ?>; 
        color: <?php echo $color_fondo; ?>;
        border-radius:2px;
    }
    .boton_ver:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #1aa0d8; 
        color: #1aa0d8;
        border-radius:2px;
    }
    .boton_ver:disabled{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid rgba(0, 0, 0, .2);    
        color: rgba(0, 0, 0, .2);
        border-radius:2px;
    }
    
    /* -------------------------- Botón de Agregar -------------------------- */
    .boton_add{
        padding-left: 3px;
        padding-right: 3px;
        text-shadow: none; 
        background-color: #007bff;
        border-left:1px solid  #007bff; 
        border-right: 1px solid  #007bff;
        font-size:16px;
        text-align: center;
        color: #fff;
        border-radius:5px;
        width: 20px;
        height:20px;
    }
    .boton_add:hover{
        padding-left: 3px;
        padding-right: 3px;
        text-shadow: none; 
        background-color: #59a9ff;
        border-left:1px solid  #59a9ff; 
        border-right: 1px solid  #59a9ff;
        font-size:16px;
        color: #ffffff;
        border-radius:5px;
        width: 20px;
        height:20px;
    }
    .boton_add:disabled{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: #28b779;
        border: 3px solid rgba(0, 0, 0, .2);    
        color: #fff;
        border-radius:2px;
    }

    .boton_remove{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #f26027; 
        color: #f26027;
        border-radius:2px;
    }
    .boton_remove:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid black; 
        color: black;
        border-radius:2px;
    }
    .boton_modal{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid white; 
        color: white;
        border-radius:2px;
    }
    .boton_modal:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid black; 
        color: black;
        border-radius:2px;
    }
    
    .boton_gestionar_cargos{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid <?php echo $color_fondo; ?>; 
        color: <?php echo $color_fondo; ?>;
        border-radius:2px;
    }
    .boton_gestionar_cargos:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid black; 
        color: black;
        border-radius:2px;
    }
    .boton_gestionar_cargos_eliminar{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid <?php echo $color_fondo; ?>; 
        color: <?php echo $color_fondo; ?>;
        border-radius:2px;
    }
    .boton_gestionar_cargos_eliminar:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #D83F25; 
        color: #D83F25;
        border-radius:2px;
    }
    .boton_gestionar_cargos:disabled{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid rgba(0, 0, 0, .2);    
        color: rgba(0, 0, 0, .2);
        border-radius:2px;
    }
    .botonAgregar{
        padding-left: 10px;
        padding-right: 10px;
        text-shadow: none; 
        background-color: <?php echo $color_fondo; ?>;
        border: 1px solid <?php echo $color_fondo; ?>; 
        color: #fff;
        border-radius:5px;
        padding-bottom: 2px;
        padding-top: 2px;
    }
    .botonAgregar:hover{
        padding-left: 10px;
        padding-right: 10px;
        text-shadow: none; 
        color: black;
        border-radius:5px;
        padding-bottom: 2px;
        padding-top: 2px;
    }

    .ph-center::-webkit-input-placeholder{
      text-align: center;
    }

    .bootstrap-datetimepicker-widget table td.today:before {
    content: '';
    display: inline-block;
    border: solid transparent;
    border-width: 0 0 7px 7px;
    border-bottom-color: #337ab7;
    border-top-color: rgba(0, 0, 0, 0.2);
    position: absolute;
    bottom: 4px;
    right: 4px;
}
.btn-upload{
    border: 2px solid <?php echo $color_fondo; ?>;
    color: <?php echo $color_fondo; ?>;
    width: 40px;
    height:28px;
    margin-left: 10px;
}
.btn-upload:hover{
    border: 2px solid #000;
    color: #000;
}
.boton_informe_jugador{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #555555; 
        color: #555555;
        border-radius:5px;
    }
    .boton_informe_jugador:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #8f8f8f; 
        color: #8f8f8f;
        border-radius:5px;
    }
    .ph-center::-webkit-input-placeholder{
      text-align: center;
    }

.colorNegro{
        color: #000;
    }
.doubleTable{
    background-color: #fff;
    height:40px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding:4px;
    border:solid #666666 2px;
    margin: -2px;

}

.doubleTable_min{
    background-color: #fff;
    height:25px;
    display: flex;
    justify-content: center;
    align-items: center;
    padding:0px;
    border:solid #666666 2px;
    margin: -2px;

}
.boton_informe_jugador:disabled{
    opacity: 0.5;
    cursor: no-drop;
}

/* ---------------- Estilos -------------------*/

.cuadro_serie {
    display: inline-block;
    background: <?php echo $color_fondo; ?>;
    padding: 15px;
    color: white;
    text-align: center;
    border-radius: 5px;
    width: 100%;
    box-sizing: border-box;
    cursor: pointer;
}
.cuadro_serie:hover {
    background: <?php echo $color_fondo_suave; ?>;
}
.cuadro_serie .nombre_seleccion {
    width: 100%;
    display: inline-block;
    border-top: 2px solid #ffffff;
    border-bottom: 2px solid #ffffff;
    padding: 5px;
    box-sizing: border-box;
}

    .boton_volver_a_series{
        position: absolute;
        text-shadow: none; 
        background-color: <?php echo $color_fondo; ?>;
        border: 5px solid white;     
        color: white;
        border-radius: 50%;
        padding: 13px;
    }
    .boton_volver_a_series:hover{
        position: absolute;
        text-shadow: none; 
        background-color: <?php echo $color_fondo; ?>;
        border: 5px solid white;     
        color: white;
        border-radius: 50%;
        padding: 13px;
    }

    #ingresar_peso_ideal_informe_carga::placeholder {
        color: white;
    }

    #tabla_ver_informes_todos tbody tr, #tabla_jugadores_ayuda_social tbody tr {
        text-align: center;
        font-size: 10px;
    }

    #tabla_ver_informes_todos thead tr, #tabla_jugadores_ayuda_social thead tr {
        line-height: 15px;
        text-align: center;
        font-size: 11px;
        text-transform: uppercase;        
    }   

    .boton_crud_informe_carga{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #e19830; 
        color: #e19830;
        border-radius:2px;
    }
    .boton_crud_informe_carga:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #fda101; 
        color: #fda101;
        border-radius:2px;
    }       


.hr-line {
    position: relative;
    display: inline-block;
    margin-left: 5px;
    margin-right: 5px;
    width: 100%;
    border-bottom: 1px solid #7A7A7A;
}

.black-placeholder::placeholder { /* Chrome, Firefox, Opera, Safari 10.1+ */
   color: black;
}

.sexo_seleccion {
    width: 100%;
    display: inline-block;
    border-top: 2px solid #555555;
    border-bottom: 2px solid #555555;
    padding: 0px;
    box-sizing: border-box;
}

.th-small-font-size {
    font-weight: 600;
    font-size: 10px;
    width: 100px;
}

.tr-posiciones-jugador {
    background-color:#555555; 
    color:white;
}


#tabla_ver_ayudas_sociales_jugador thead tr {
    text-align: center;
    font-size: 12px;
}

#tabla_ver_ayudas_sociales_jugador tbody tr {
    font-size: 11px;   
}

.span-valoracion {
    font-weight: bold;
    background-color: grey;
    border-radius: 5px;
    color: white;
    text-transform: uppercase;   
}

.valoracion-baja {
    color: white;
    background-color: #f44336;
}

.valoracion-media {
    color: white;
    background-color: #ffc107;
}

.valoracion-alta {
    color: white;
    background-color: #4caf50;
}

.td-valoracion {
    padding-right: 10px;
    padding-top: 7px;
    padding-bottom: 7px;
}

.td-valoracion .span-valoracion {
    width: 70px;
    margin-left: 25px;
}

input[type=radio] {
  border: 1px solid black;
  padding: 0.5em;
  -webkit-appearance: none;
}

input[type=radio]:checked {
  background: black;
  background-size: 9px 9px;
}

input[type=radio]:focus {
  outline-color: blue;
}


.radio-button {
    display:none; 
    margin:10px;
}


.radio-button-valoracion-alta + label {
    display:inline-block;
    font-weight: bold;
    background-color: #4caf50;
    border-radius: 5px;
    padding: 5px;
    color: white;
    text-transform: uppercase;       
}

.radio-button-valoracion-media + label {
    display:inline-block;
    font-weight: bold;
    background-color: #ffc107;
    border-radius: 5px;
    padding: 5px;
    color: white;
    text-transform: uppercase;       
}

.radio-button-valoracion-baja + label {
    display:inline-block;
    font-weight: bold;
    background-color: #f44336;
    border-radius: 5px;
    padding: 5px;
    color: white;
    text-transform: uppercase;       
}


.radio-button:checked + label { 
    background-image: none;
    border: solid 4px #3e3e3e;
    color: white;
}

.textarea-social {
    width: 100%;
    -webkit-appearance: none;
    -moz-appearance: none;
    border: 2px solid #d6d0d0;
    /* border-radius: 6px; */
    margin-bottom: 0px;
    text-align: center;
    line-height: 16px;
    font-weight: bold;
    text-align: left;
}

.imagenes-centro {
    width: 35px;
}

.texto-imagen-centro {
    margin-right: 40px;
    font-weight: bold;
    color: black;
}

.nombre-jugador {
    font-weight: bold;
    color: black;
    margin-top: 0px;
    font-size: 20px;    
}

.titulo-campo-talento {
    text-transform: uppercase;
    color: black;    
}

.select-status-talento {
    text-indent: 35px;
    border-radius: 7px;
    height: 40px;    
    font-weight: bold;
    color: #999999;
    width: 250px;
    -webkit-appearance: none;
    -moz-appearance: none;        
}

#boton_agregar_informe_carga:enabled {
    cursor: pointer;
}

#boton_agregar_informe_carga:disabled {
    cursor: no-drop;
}

.img-next-to-text {
    float:left;
    display:block;
    position:relative;
    width:20%;
}

.ellipsis-text {
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;    
    margin-bottom: 0px;
    font-weight: bold;
}

#selecciones_cajas {
    margin-left: 5%;
    width: 97%;
}

@media (max-width: 980px) {
    .seleccion_test {
        width: calc(100% - 20px) !important;
    }
    .seleccion_test:hover {
        width: calc(100% - 0px) !important;
    }
    #selecciones_cajas {
        margin-left: 0px;
        width: 100%;
    }
    .titulo_series {
        width: 100%;
    }
}

.imagen-jugador {
    background-color: white;
}

.text-descripcion-seccion {
    font-weight: bold;
    margin: 0px;
    text-transform: uppercase;
    color: #555555;
    font-size: 11px;
    text-align: center;        
} 

/* ------------------ INPUT GRIS ------------------ */
.gray-a {
margin:0px; border-bottom-left-radius:2px; border-top-left-radius:2px; margin-left: 0px; margin-right: 0px; width: 90px; margin-top:0px; background-color:<?php echo $color_fondo; ?>; font-size: 12px; margin-bottom:0px;
}

.gray-a:hover{
    background-color:<?php echo $color_fondo; ?>;   
}

.gray-input {
margin:0px; width:52%; -webkit-appearance: none; -moz-appearance : none; border: 1px solid <?php echo $color_fondo; ?>; margin-left: 0px; margin-right: 0px; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px;  border-top-left-radius:0px; margin-bottom:0px; text-align:center;
}

/* ------------------ INPUT VERDE ------------------ */
.green-a {
margin:0px; border-bottom-left-radius:2px; border-top-left-radius:2px; margin-left: 0px; margin-right: 0px; width: 90px; margin-top:0px; background-color:<?php echo $color_fondo; ?>; font-size: 12px; margin-bottom:0px;
}

.green-a:hover{
    background-color:<?php echo $color_fondo; ?>;   
}

.green-input {
margin:0px; width:52%; -webkit-appearance: none; -moz-appearance : none; border: 1px solid <?php echo $color_fondo; ?>; margin-left: 0px; margin-right: 0px; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px;  border-top-left-radius:0px; margin-bottom:0px; text-align:center;
}

/* ------------------ #cargar_jugadores ------------------ */
#cargar_jugadores tr {
    border-bottom: 1px solid #D2DCDF;
    cursor: pointer;
}
#cargar_jugadores tr:last-child {
    border-bottom: none;
}
#cargar_jugadores tr.checked {
    background: <?php echo $color_fondo; ?>;
    color: white;
    border-bottom: 1px solid white;
}
#cargar_jugadores tr.checked:last-child {
    border-bottom: none;
}
#cargar_jugadores tr.checked:hover {
    background: <?php echo $color_fondo_suave; ?>;
    color: black;
}
#cargar_jugadores tr td {
    padding: 5px;
}

.btn-multimedia {
    background: <?php echo $color_fondo; ?>;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 5px 10px;
    cursor: pointer;
    font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
}
.btn-multimedia:hover {
    background: <?php echo $color_fondo_suave; ?>;
    color: white;
}

/* MULTISELECT */
.btn-group {
    white-space: initial;
}

.btn-group.open .btn.dropdown-toggle {
    background-color: white;
}

.btn-group .btn.dropdown-toggle {
    border: 1px solid #d8d5d5;
    background-color: white;
    outline: none;
    box-shadow: none;
    height: 25px;
    border-radius: 5px;
}

.input-ayuda-social {
    border: 1px solid #d8d5d5;
    background-color: white;
    border-radius: 5px;
}

.btn-group .dropdown-menu a, .btn-group .dropdown-menu a:active {
    background: transparent;
    color: grey;
}
.btn-group .dropdown-menu {
    margin: 0px;
    box-shadow: none;
    width: calc(100% - 2px);
    max-height: 300px;
    overflow-x: auto;
    padding: 0px;
}
.btn-group .dropdown-menu .option {
    display: flex;
    justify-content: space-between;
    width: 100%;
    padding: 2px 8px;
    box-sizing: border-box;
    color: #494949;
    margin: 0px;
}
.btn-group .dropdown-menu .option:hover {
    background: #1E90FF;
    color: white;
}
.btn-group .dropdown-menu .option input[type="checkbox"] {
    margin-left: 3px;
}

.caret {
    display: inline-block;
    width: 0;
    height: 0;
    vertical-align: top;
    border-top: 7px solid #000;
    border-right: 5px solid transparent;
    border-left: 5px solid transparent;
    content: "";
}

.tabla-modal-detalle-jugador {
    color: black;
}

.tabla-modal-detalle-jugador tbody tr th  {
    font-weight: 900;
}

.tabla-modal-detalle-jugador tbody tr td  {
    font-weight: bold;
}

.tabla-modal-detalle-jugador thead tr:hover, tbody tr:hover, tfoot tr:hover {
    background-color: transparent;
}

.boton_guardar_ayuda_social {
    font-weight: bold;
    border: 2px solid #d0cece;
    font-size: 9px;
    padding: 1px;
    width: 130px;
    text-transform: uppercase;
}

.boton_guardar_ayuda_social:hover {
    background-color: white;
    color: #2c2b2b;
    border: 2px solid #8e8c8c;
    font-weight: bold;
}

.img-star-five-stars {
    width: 80px;margin-left: 50px; height: 13px; margin-top: -3px;
}

.highcharts-credits {
    display: none;
}

.highcharts-range-selector-buttons {
    display: none;   
}

.highcharts-figure div {
    background-color: transparent;
}

.td-head-form-edit {
    width: 33.33%;
    text-align: center;
    font-weight: bold;
    color: black;
    font-size: 9px;
    padding: 0;
}

p.titulo_multi {
    font-weight: normal;
}


.btn-group .dropdown-menu a, .btn-group .dropdown-menu a:active {
    left: 3px;
    padding-left: 3px;
    padding-right: 3px;
    text-shadow: none;
    background-color: #1d9663;
    border-left: 1px solid #1d9663;
    border-right: 1px solid #1d9663;
    /* font-size: 16px; */
    text-align: center;
    color: #fff;
    border-radius: 5px;
    width: 10px;
    height: 20px;
    position: relative;
    top: 10px;
}
.icono-agregar-otro {
    
    left: 3px;
    padding-left: 3px;
    padding-right: 3px;
    text-shadow: none;
    background-color: #1d9663;
    border-left: 1px solid #1d9663;
    border-right: 1px solid #1d9663;
    /* font-size: 16px; */
    text-align: center;
    color: #fff;
    border-radius: 5px;
    width: 10px;
    height: 20px;
    position: relative;
    top: 10px;

    /*
    position: relative;
    top: 15px;
    height: 0;
    */

    /*left: 5px;*/
}

.btn-group .dropdown-menu {
    width: auto;
}


</style>
<script type="text/javascript">
    var imagen_cargando = new Image();
    imagen_cargando.src = "../config/cargando_final_2.gif";
</script>
<script src="../print_js/print.min.js"></script>
<script src="js/angular.min.js" type="application/javascript"></script>
<script type="text/javascript" src="graficos/jquery-3.1.1.min.js"></script>

<!--
<script type="text/javascript" src="graficos/highcharts-3d.js"></script>
<script type="text/javascript" src="graficos/highcharts.js"></script>
<script type="text/javascript" src="graficos/exporting.js"></script>
<script type="text/javascript" src="graficos/highcharts-more.js"></script>
<script type="text/javascript" src="graficos/series-label.js"></script>
-->

<!-- Highcharts -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/variable-pie.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>


<script src="js/excanvas.min.js"></script> 
<script src="js/jquery.min.js"></script> 
<script src="js/jquery.ui.custom.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.flot.min.js"></script> 
<script src="js/jquery.flot.resize.min.js"></script> 
<script src="js/jquery.peity.min.js"></script> 
<script src="js/fullcalendar.min.js"></script> 
<script src="js/matrix.js"></script> 
<script src="js/matrix.dashboard.js"></script> 
<script src="js/jquery.gritter.min.js"></script> 
<!--<script src="js/matrix.interface.js"></script> -->
<script src="js/matrix.chat.js"></script> 
<script src="js/jquery.validate.js"></script> 
<script src="js/matrix.form_validation.js"></script> 
<script src="js/jquery.wizard.js"></script> 
<script src="js/jquery.uniform.js"></script> 
<script src="js/select2.min.js"></script> 
<script src="js/matrix.popover.js"></script> 
<script src="js/jquery.dataTables.min.js"></script> 
<script src="js/matrix.tables.js"></script> 
<script type="text/javascript">



var id_jugador = "";
var cierra_ventana=0;

var id_matricula="";
var id_mensualidad="";
var edicion_informe = false;
var agregar_informe = true;
var linea_actual=0;
var pagina_actual=0;
var semestre1= true;
var semestre2 = true;

var error_foto = 0;
var datos_ultima_ayuda_social = {};
var datos_ayuda_social_jugador = {};

let fechaA      = '<?php echo $date_hoy; ?>';

var idfichaJugador = "";
var idfichaJugador_club = "";
var idinforme_ayuda_social = "";
// Array para guardar datos del jugador:
var datos_jugador_club = {};

var estatus_editar = 0;

var ano_actual = '<?php echo $ano_actual;?>';
var mes_actual = parseInt('<?php echo $mes_actual;?>');
var seriesV2 = <?php echo json_encode($series); ?>;

//////////////////////////////////////////////////
let pieHabil            = ['DERECHA', 'IZQUIERDA', 'AMBIDIESTRO'];
let arreglo_posicion1   = <?php echo json_encode($arreglo_posicion1); ?>;
let arreglo_posicion1_d = <?php echo json_encode($arreglo_posicion1_d); ?>;
let arreglo_posicion2   = <?php echo json_encode($arreglo_posicion2); ?>;
let arreglo_posicion2_d = <?php echo json_encode($arreglo_posicion2_d); ?>;


// Array Posiciones:
// Nota: La posición 2 hace referencia número del grupo de posiciones y el 3 al nombre:
var array_posiciones = [
    [0, 'Todos'],
    [1, 'Arquero', 1, 'Arqueros'],
    [2, 'Defensa Central', 2, 'Defensas'],
    [3, 'Lateral Izquierdo', 2, 'Defensas'],
    [4, 'Lateral Derecho', 2, 'Defensas'],
    [5, 'Volante Defensivo', 3, 'Mediocampistas'],
    [6, 'Volante Izquierdo', 3, 'Mediocampistas'],
    [7, 'Volante Derecho', 3, 'Mediocampistas'],
    [8, 'Volante Mixto', 3, 'Mediocampistas'],
    [9, 'Volante Ofensivo', 3, 'Mediocampistas'],
    [10, 'Extremo Izquierdo', 4, 'Delanteros'],
    [11, 'Extremo Derecho', 4, 'Delanteros'],
    [12, 'Delantero Centro', 4, 'Delanteros'],
];

// Array Lateralidad:
var array_lateralidad = [
    [0, 'Todos'],
    [1, 'Derecho'],
    [2, 'Izquierdo'],
    [3, 'Ambidiestro'],
];

function goPage (newURL) {
    if (newURL != "") {
        if (newURL == 0 ) {
            resetMenu();            
        }   
        else {  
          document.location.href = newURL;
        }
    }
}

function resetMenu() {
   document.gomenu.selector.selectedIndex = 2;
}

function refrescar(){
    $("#search").load("post/consultar_datetime.php");
}

function colocar_icono_cargando(opcionMenu){
    var texto_opcion="<i class='icon-spinner icon-spin icon-large'></i> "+opcionMenu.innerHTML;
    opcionMenu.innerHTML = texto_opcion;
}

function mostrar_al_cargar_pagina(){
    $('#pagina').slideDown("slow");
    $('#cargando_pagina').hide();
}




//Angular//
/*
//////////////////////Expresiones regulares//////////////////////
?     0 o 1 vez
*     0 o muchas veces
+     1 o muchas veces
\s    espacio en blanco
{n}   n veces
{n,m} n a m veces
//////////////////////Angular JS//////////////////////////
ng-trim    false-->     elimina espacios en blanco al comienzo y al final
*/
var app= angular.module("App_Angular",[]);
app.controller("controlador_1",['$scope',function($scope){
    
    $.fn.modal.Constructor.prototype.enforceFocus = function () {};

    $scope.ER_alfaNumericoConEspacios=/^([a-zA-Z0-9\x7f-\xff](\s[a-zA-Z0-9\x7f-\xff])*)+$/;
    $scope.ER_email=/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    $scope.ER_alfaNumericoSinEspacios=/^([a-zA-Z0-9])+$/;
    $scope.ER_numericoSinEspacios=/^[0-9]+$/;
    $scope.ER_caracteresConEspacios=/^([a-zA-Z\x7f-\xff](\s[a-zA-Z\x7f-\xff])*)+$/;
    $scope.ER_altura=/^([1-2]{1}[0-9]{2})$/;
    $scope.ER_peso=/^((([1]{1}[0-4]{1}[0-9]{1})|([3-9]{1}[0-9]{1}))(\.[1-9])?)$/;
    $scope.ER_telefono=/^[0-9]+$/;
    $scope.ER_rut=/^(([1-2]{1}[0-9]?)|([1-9]{1}))[0-9]{6}-([0-9]|k){1}$/;
    $scope.ER_rut_empresa=/^(([1-9]{1}[0-9]{1,2})|([1-9]{1}))[0-9]{6}-([0-9]|k){1}$/;
    
    $scope.ER_valorMonto=/^[1-9]{1}[0-9]*[0]{1}$/;
    
    $scope.ER_alfaNumericoConEspaciosAcentos=/^([a-zA-Z0-9\x7f-\xff](\s[a-zA-Z0-9])*)+$/;
    
    $scope.clickFunction = function() {
        $scope.buttonClicks=1;
    };
    
    $scope.aplicar = function() {
        $scope.ingresar_nombre = 'value here';
    }
    
    $scope.desactivarBoton = function() {
        $('#boton_comentario').attr('disabled', true);
        //$scope.isDisabled = true;
        return false;
    }
    
    $scope.activarBoton = function() {
        $('#boton_comentario').attr('disabled', false);
        //$scope.isDisabled = true;
        return false;
    }
    $scope.desactivarBoton2 = function() {
        $('#boton_agregar_Fertilizante').attr('disabled', true);    
        //$scope.isDisabled = true;
        return false;
    }
    
    
    $scope.desactivarBotonAgregarProveedor = function() {
        $('#boton_agregar_informe_carga').attr('disabled', true);   
        //$scope.isDisabled = true;
        return false;
    }
    $scope.desactivarBotonEliminarProveedor = function() {
        $('#boton_eliminar_proveedor').attr('disabled', true);  
        //$scope.isDisabled = true;
        return false;
    }
}]);
</script>

</head>
<body onload="setInterval(refrescar, 1000)" ng-controller="controlador_1" ng-app="App_Angular" id="angularData">

<!--Header-part-->
<div id="header">
  <h1><a href="dashboard.html"><?php echo $abreviacion_dominio;?></a></h1>
</div>
<!--close-Header-part--> 
<!--start-top-serch-->
<div id="search" style="font-size:15px; font-weight: bold; color: white; padding-top:3px; padding-right:5px;">
    <?php 
        echo $data[0]."&nbsp;&nbsp;&nbsp;".$data[1];
    ?>
</div>
<!--close-top-serch-->
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon-truck"></i> FFCH <i class="icon-chevron-right"></i> Ayudas Sociales</a>
  <?php include('../config/menu.php');?>
</div>
<!--sidebar-menu-->

<!--main-container-part-->
<div id="content">
<!--breadcrumbs-->
  <div id="content-header">
   <div id="breadcrumb"> 
        <a title="Go to Home" class="tip-bottom">
            <i class="icon-home"></i> Inicio
        </a> 
        <a class="tip-bottom">
            <i class="icon-truck"></i> FFCH
        </a> 
        <a class="current">
            Ayudas Sociales
        </a> 
    
    </div>
  </div>
<!--End-breadcrumbs-->
 
<div class="container-fluid" id="cargando_pagina">
    <center>
    <img src="" style="margin-top:100px;" id="cargando_final">
    <script>$('#cargando_final').attr('src',imagen_cargando.src);</script>
    </center>
</div>
<!--Action boxes-->


<div class="container-fluid" style="display:none;" id="pagina">
      
    
<?php if(($software_demo && $demo_seccion) || !$software_demo){?>


<div class="row-fluid">

<!--
cuadro_listado_series
cuadro_serie_selected
cuadro_formulario_guardar
-->

<!-- ========================================== Inicio del id="cuadro_listado_series" ========================================== -->     
<div class="row-fluid" style="margin-top: 0px; color:black; font-family:Arial, Helvetica, sans-serif;" id="cuadro_listado_series"> 

    <table style="color:black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
        <tr class="sin_fondo">
            <td style="padding:12px; padding-top:15px;"><img src="../config/logo_equipo.png" style="height: 100px; margin-top:5px;"></td>
            <td>
                <center>
                    <h3 class="titulo_principal" style="text-transform: uppercase;">módulo área social</h3>
                    <h5 class="titulo_principal" style="text-transform: uppercase;">ayudas sociales</h5>                  
                </center>
            </td>
        </tr>
    </table>

    <div style="text-align: center;margin-bottom: 45px;">
        <i class="icon-coffee"></i> <p class="text-descripcion-seccion" style="display: inline-block;margin-left: 20px;">En esta sección puedes ver, editar y asignar ayudas sociales para jugadores de estas categorías</p>              
    </div>

    <div style="width:100%; background-color:#163D61; height:20px; border-radius: 4px;"></div>

                        <div id="selecciones_cajas" class="row-fluid" style="margin-top: 20px;">
                            <div class="span11 titulo_series" style="margin-top: 30px; margin-left: 0px; margin-bottom: 20px;">
                                <h4 style="text-align: center;">MASCULINA</h4>
                            </div>
                            
                            <?php
                            foreach ($series AS $indice => $valor) {
                                $arreglo_serie = t_serie($indice);
                                if ($arreglo_serie[1] == 1) { $numero_jugadores = informes_por_serie($indice); ?>

                                    <?php  
                                    $sexo = explode('_', $indice, 2)[1]; // Returns This_is_a_string
                                    $numero_serie = strtok( $indice, '_' );
                                    ?>

                                    <div class="span3" style="text-align: center; margin: 0px; padding: 10px;">
                                        <div class="cuadro_serie" numero-serie="<?php echo $numero_serie; ?>" sexo="<?php echo $sexo[0]; ?>" onclick="seleccionSerie('<?php echo $indice; ?>')">
                                            <div style="margin-bottom: 10px;"><img src="../config/logo_equipo.png" style="height: 120px"></div>
                                            <div class="nombre_seleccion"><b><?php echo $valor; ?></b></div>
                                            <div class="cantidad_jugadores" style="padding-top: 15px;"><i class="icon-male"></i> <span class="cantidad-informes">(<?php echo $numero_jugadores; ?>) informes</span> </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                            
                            <div class="span11 titulo_series" style="margin-top: 30px; margin-left: 0px; margin-bottom: 20px;">
                                <h4 style="text-align: center;">FEMENINA</h4>
                            </div>
                            
                            <?php
                            foreach ($series AS $indice => $valor) {
                                $arreglo_serie = t_serie($indice);
                                if ($arreglo_serie[1] == 2) { $numero_jugadores = informes_por_serie($indice); ?>

                                    <?php  
                                    $sexo = explode('_', $indice, 2)[1]; // Returns This_is_a_string
                                    $numero_serie = strtok( $indice, '_' );
                                    ?>

                                    <div class="span3" style="text-align: center; margin: 0px; padding: 10px;">
                                        <div class="cuadro_serie" numero-serie="<?php echo $numero_serie; ?>" sexo="<?php echo $sexo[0]; ?>" onclick="seleccionSerie('<?php echo $indice; ?>')">
                                            <div style="margin-bottom: 10px;"><img src="../config/logo_equipo.png" style="height: 120px"></div>
                                            <div class="nombre_seleccion"><b><?php echo $valor; ?></b></div>
                                            <div class="cantidad_jugadores" style="padding-top: 15px;"><i class="icon-male"></i> <span class="cantidad-informes">(<?php echo $numero_jugadores; ?>) informes</span></div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </div>


</div>
<!-- ========================================== Fin del id="cuadro_listado_series" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_serie_selected" ========================================== -->
<div style=" display:none;" id="cuadro_serie_selected">

<!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
<div class="cuadro_buscar_titulo">

<table style="color: black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
                            <tbody><tr class="sin_fondo">
                                <td style="padding: 15px; text-align: center;">
                                    <img src="../config/logo_equipo.png" style="height: 90px;">
                                </td>

      <input class="sexo" type="hidden">
      <input class="numero_serie" type="hidden">
      <input class="tecnico" type="hidden">  

                                <td style="text-align: center;">
                                    <h3 class="titulo_principal" style="margin: 0px; line-height: 26px;">MÓDULO ÁREA SOCIAL</h3>
                                    <p class="titulo_serie" style="margin-top: 10px; font-weight: bold; font-weight: 14px;"></p>
                                </td>
                            </tr>
                        </tbody>
</table>

<div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px; border-radius: 4px;">

</div>

</div>
<!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->

    <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:30px;">
      
      <div class="row-fluid" style="margin: 0px;">
        <button class="boton_volver" onclick="boton_volver_cuadro_listado_series();" style="position: absolute; top: 100px;">
            <i class="icon-arrow-left"></i> volver
        </button>
      </div>  

            
        <center>
            <div style="margin:0px; height:20px;"><img src="../config/cargando_buscar.gif" id="cargando_buscar" style=" display:none;">
                <span style="color:#dc4e4e; display:none;" id="error_conexion"><b>Error:</b> conexión a internet deficiente.</span>
            </div>
        </center>
        
        <!-- ============================== Inicio de los filtros de búsqueda ============================== -->
        <div style="margin-top: 10px; margin-bottom: 60px;">
            <div style="margin: auto; width: 90%;">
                <!-- ======================================================================== -->
                <div class="span3" style="display: flex;">
                    <a class="btn btn-md btn-primary gray-a" style="width: 50%; text-transform: none;"> 
                        Año
                    </a>
                    <select class="gray-input" id="anio_filtro_busqueda" name="anio_filtro_busqueda" style="width: 40%;" onchange="cargar_graficas();"></select>
                </div>
                <!-- ======================================================================== -->
                <div class="span3" style="display: flex;">
                    <a class="btn btn-md btn-primary gray-a"> 
                        MES
                    </a>
                    <select class="gray-input" id="mes_filtro_busqueda" name="mes_filtro_busqueda" onchange="buscador();">
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>                        
                    </select>
                </div>
                <!-- ======================================================================== -->
                <div class="span3" style="display: flex;">
                    <a class="btn btn-md btn-primary gray-a"> 
                        CLUB
                    </a>
                    <!-- <select class="gray-input select-club-filtro-busqueda" id="idclub_fbjscouting_main" name="idclub_fbjscouting_main" onchange="buscar_jugadores_seguimiento( 2 );"></select> -->
                    <select class="gray-input select-club" id="idclub_filtro_busqueda" name="idclub_filtro_busqueda" onchange="buscador();">
                        <option value="">Seleccione primero una división</option>
                    </select>
                </div>
                <!-- ======================================================================== -->
                <!--  
                <div class="span3" style="display: flex;">
                    <a class="btn btn-md btn-primary gray-a"> 
                        Tipo de Ayuda
                    </a>
                    
                    <select class="gray-input select-tipo-ayuda-social-filtro" id="tipoayuda_filtro_busqueda" name="tipoayuda_filtro_busqueda" onchange="buscador();"></select>    
                </div>
                -->                  

                <div class="span3" style="display: flex;">
                    <a class="btn btn-md btn-primary green-a" style="width: 150px;"><div><p class="ellipsis-text" style="font-weight: normal;">Tipo de Ayuda</p></div></a>
                    <div class="btn-group c_objetivo_fisico" style="width: 120px;">
                        <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 1px solid <?php echo $color_fondo; ?>"><p id="tipo_ayuda" class="titulo_multi ellipsis-text">Seleccione tipos de ayuda</p> <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>\
                        <ul id="ul_tipos_ayuda_filtro_busqueda" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                    </div>                    
                </div> 

            </div>
        </div>                             
        <!-- ============================== Fin de los filtros de búsqueda ============================== -->


        <div class="row-fluid" style="margin-top: 90px;">
            <div style="margin-bottom:10px;display: inline-block;float: left;width: 30%;">
                <table border="0" style="width: 100%;">
                    <tbody><tr class="sin_fondo">
                        <td style="width:330px;">
                            <input class="ph-center" name="buscar_nombre" style="width:96%; background-color:white; border: 3px solid #555555; border-radius:20px; margin-bottom:0px;padding-left: 10px; height: 24px;" placeholder="Nombre del Jugador o Vacío para Ver Todos" maxlength="149" id="buscar_nombre" onkeydown="buscador();">
                        </td>
                        <td style="width:40px; cursor:pointer;">
                            <button class="boton_refresh" onclick="buscador()" style="margin-left: 10px; display: none;"><i class="icon-refresh"></i></button>
                        </td>
                    </tr>
                </tbody></table>
            </div>            

            <div style="width: 50%;display: inline-block;/* margin: auto; */">
                <h4 style="color: black;text-transform: uppercase;text-align: center;margin: 0;font-size: 13px;">jugadores que han recibido ayuda social</h4>
            </div>
            
            <div style="float:right;display: inline-block;width: 20%;">
                <button style="margin-bottom:10px;/* margin-top: -20px; */float: right;" class="boton_informe_jugador" onclick="boton_ir_gestion_ayuda_social();"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar informe</b></button>
            </div>

        </div>

        <div class="row-fluid" style="margin-top:0px;">

            <div class="span12" style="margin: 0px;">
                <table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_ver_informes_todos">
                    <thead>
                        <tr style="background-color:#555555; color:white;">
                            <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px; width: 35px;">
                              <div class="tip-top" data-original-title="Número" style="width:100%;">#</div>
                          </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 140px;">
                                <div class="tip-top" data-original-title="Posición" style=" cursor: pointer; padding: 0px; text-align: center;">
                                    POSICIÓN
                                </div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px;">
                                <div class="tip-top" data-original-title="Nombre" style="width: 170px;">NOMBRE</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px;width: 113px;">
                                <div class="tip-top" data-original-title="RUT" style="width:100%;">RUT</div>
                            </th>                                                
                            <th scope="col" style="cursor:pointer; padding:0px; width: 140px;">
                                <div class="tip-top" data-original-title="Club" style=" cursor: pointer; padding: 0px; text-align: left; width: 170px;">
                                    CLUB
                                </div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 140px;">
                                <div class="tip-top" data-original-title="Fecha de última compra" style="cursor: pointer; padding: 0px; text-align: left; width: 150px;">
                                    FECHA ÚLTIMA COMPRA
                                </div>
                            </th>  
                            <th scope="col" style="cursor:pointer; padding:0px; width: 140px;">
                                <div class="tip-top" data-original-title="Monto" style=" cursor: pointer; padding: 0px; text-align: center;">
                                    MONTO
                                </div>
                            </th>     
                            <th scope="col" style="cursor:pointer; padding:0px; width: 140px;">
                                <div class="tip-top" data-original-title="Descripción" style=" cursor: pointer; padding: 0px; text-align: center;">
                                    descripción
                                </div>
                            </th>    
                            <th scope="col" style="cursor:pointer; padding:0px; width: 140px;">
                                <div class="tip-top" data-original-title="Detalle" style=" cursor: pointer; padding: 0px; text-align: center;">
                                    Detalle
                                </div>
                            </th>  
                            <th scope="col" style="cursor:pointer; padding:0px; border-top-right-radius:5px; width:140px;">
                                <div class="tip-top" data-original-title="Ayudas recibidas" style=" cursor: pointer; padding: 0px; text-align: center; width: 150px;">
                                    Ayudas recibidas
                                </div>
                            </th>                            
                        </tr>

                    </thead>
                    
                    <tbody><!--AQUI SE INSERTARAN CON JAVASCRIPT --></tbody>
                    
                    <tfoot>

                        <!--
                        <tr class="sin_fondo"><td colspan="8"><center><h5 style="color:#555555;"><i class="icon-file-alt"></i> Sin Jugadores</h5></center></td></tr>
                        -->
                        
                        <tr style="background-color:#555555; color:white;">
                            <th scope="col" style="border-bottom-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px; "></th>
                        </tr>

                    </tfoot>
                </table>
            </div>
        </div>
    </div>
        

    <div class="row-fluid" style="margin-top: 20px;">          
        <div>
            <h4 style="color: black;text-transform: uppercase;text-align: center;margin: 0;font-size: 13px;">total entregado:</h4>
        </div>
    </div>


    <!-- ================= Inicio del class="row-fluid" ================= -->
    <div class="row-fluid" style="margin-top: 30px;">
        <!-- ================= Inicio del class="span6" ================= -->
        <div class="span6">
            <figure class="highcharts-figure">
                <div id="chart-montos-entregados"></div>
                <p class="highcharts-description">
                   
                </p>
            </figure>                            
        </div>
        <!-- ================= Fin del class="span6" ================= -->
        
        <!-- ================= Inicio del class="span6" ================= -->
        <div class="span6">
            <figure class="highcharts-figure">
                <div id="chart-club-origen-jugadores"></div>
                <p class="highcharts-description">
                  
                </p>
            </figure>                             
        </div>
        <!-- ================= Fin del class="span6" ================= -->
    </div>    
    <!-- ================= Fin del class="row-fluid" ================= -->  

    <!-- ================= Inicio del class="row-fluid" ================= -->
    <div class="row-fluid" style="margin-top: 30px;">
        <!-- ================= Inicio del class="span12" ================= -->
        <div class="span12">
            <figure class="highcharts-figure">
                <div id="chart-montos-entregados-xjugador"></div>
                <p class="highcharts-description">
                   
                </p>
            </figure>                            
        </div>
        <!-- ================= Fin del class="span12" ================= -->
    </div>    
    <!-- ================= Fin del class="row-fluid" ================= -->    

    <!-- ================= Inicio del class="row-fluid" ================= -->
    <div class="row-fluid" style="margin-top: 30px;">
        <!-- ================= Inicio del class="span12" ================= -->
        <div class="span6">
            <figure class="highcharts-figure">
                <div id="chart-monto-entregado-segun-club"></div>
                <p class="highcharts-description">
                   
                </p>
            </figure>                            
        </div>
        <!-- ================= Fin del class="span12" ================= -->
    </div>    
    <!-- ================= Fin del class="row-fluid" ================= -->         

</div>
<!-- ========================================== Fin del id="cuadro_serie_selected" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_gestion_ayudas_sociales" ========================================== -->
<div id="cuadro_gestion_ayudas_sociales" class="row-fluid" style="margin-top: 0px; color:black; font-family:Arial, Helvetica, sans-serif; display: none">

    <table style="color:black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
        <tr class="sin_fondo">
            <td style="padding:12px; padding-top:15px;"><img src="../config/logo_equipo.png" style="height: 100px; margin-top:5px;"></td>
            <td>
                <center>
                    <h3 class="titulo_principal" style="text-transform: uppercase;">módulo área social</h3>
                    <h5 class="titulo_principal" style="text-transform: uppercase;">ayudas sociales</h5>                  
                </center>
            </td>
        </tr>
    </table>

    <div style="text-align: center;margin-bottom: 45px; margin-top: -5px;">
        <i class="icon-coffee"></i> <p class="text-descripcion-seccion" style="display: inline-block;margin-left: 20px;">En esta sección puedes ver, editar y asignar ayudas sociales para jugadores de estas categorías</p>              
    </div>
    
    <div style="width: 100%; background-color: <?php echo $color_fondo; ?>; height: 20px; border-radius: 5px;"></div>
    
    <form name="formulario_entrenamiento" id="formulario_entrenamiento">
        <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top: 20px;">
            
            <div class="span12" style="margin: 0px; margin-bottom: 15px;">
                
                <button class="boton_volver" onclick="boton_volver_de_gestion_ayuda_social();" style="float: left; margin: 0px;"><i class="icon-arrow-left"></i> volver</button>

                <h5 style="text-align: center; text-transform: uppercase; margin: 5px 0px 10px; color: #555555;">
                    SELECCIONA LOS JUGADORES A LOS QUE SE LE ASIGNARÁ ESTA AYUDA                    
                    <button id="btn_cargar_jugadores" class="boton_refresh" onclick="cargarJugadores();" style="margin-left: 10px;"><i class="icon-refresh"></i></button>
                    
                    <!--
                    <button id="btn_buscar_jugadores" class="btn-multimedia" onclick="buscarJugador();" style="margin-left: 50px;"><i class="icon-plus"></i></button>
                    -->

                    <button id="btn_marcar_jugadores" class="btn-multimedia" onclick="marcarTodos();" style="margin-left: 10px;"></button>
                </h5>

                <hr>
                
                <center>

                    <h6 style="text-align: center; text-transform: uppercase; margin: 5px 0px 10px;">
                        BUSCAR JUGADORES                    
                    </h6>

                    <div style=" width:500px; margin-bottom:10px;">
                        <table border="0">
                            <tbody><tr class="sin_fondo">
                                <td style="width:330px; padding-left:40px;"><input class="ph-center" name="buscar_jugadores_ayuda_social" style="width:96%; background-color:white; border: 3px solid #555555; border-radius:20px; margin-bottom:0px;padding-left: 10px; height: 24px;" placeholder="Nombre del Jugador o Vacío para Ver Todos" maxlength="149" id="buscar_jugadores_ayuda_social" onkeyup="cargarJugadores();" onkeydown="cargarJugadores();"></td>
                                <td style="width:40px; cursor:pointer;"> <button class="boton_refresh" onclick="cargarJugadores();" style="margin-left: 10px; display: none;"><i class="icon-refresh"></i></button></td>
                            </tr>
                        </tbody></table>
                    </div>
                </center>

                <div style="background: white; max-width: 800px; margin: auto;">
                    <table id="tabla_cargar_jugadores" style="width: 100%;">
                        <tbody id="cargar_jugadores"></tbody>
                    </table>
                </div>

            </div>
            
            <!-- =================================== Inicio de class="span12" =================================== -->
            <div class="span12" style="margin: 0px;">
                <!-- =================================== Inicio de id="tabla_jugadores_ayuda_social" =================================== -->
                <table style="display: none; border: 0px solid #8f8f8f; width:100%; margin-bottom: 25px;" id="tabla_jugadores_ayuda_social">
                    <thead>
                        <tr style="background-color:#555555; color:white;">
                            <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px; width: 35px;">
                              <div class="tip-top" data-original-title="Número" style="width:100%;">#</div>
                          </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 140px;">
                                <div class="tip-top" data-original-title="Posición" style=" cursor: pointer; padding: 0px; text-align: left;">
                                    POSICIÓN
                                </div>
                            </th>
                            <th scope="col" style="cursor:pointer;padding:0px;/* width: 150px; */">
                                <div class="tip-top" data-original-title="Nombre" style="width: 170px;">NOMBRE</div>
                            </th>                                           
                            <th scope="col" style="cursor:pointer;padding:0px;/* width: 140px; */">
                                <div class="tip-top" data-original-title="Club" style="cursor: pointer;padding: 0px;text-align: left;width: 170px;">
                                    CLUB
                                </div>
                            </th>
                            <th scope="col" style="cursor:pointer;padding:0px;/* width: 140px; */">
                                <div class="tip-top" data-original-title="Fecha de compra" style="cursor: pointer;padding: 0px;text-align: center;width: 170px;">
                                    FECHA COMPRA
                                </div>
                            </th>  
                            <th scope="col" style="cursor:pointer; padding:0px; width: 140px;">
                                <div class="tip-top" data-original-title="Monto" style=" cursor: pointer; padding: 0px; text-align: center;">
                                    MONTO
                                </div>
                            </th>  
                            <th scope="col" style="cursor:pointer; padding:0px; width: 140px;">
                                <div class="tip-top" data-original-title="Descripción" style=" cursor: pointer; padding: 0px; text-align: center;">
                                    Descripción
                                </div>
                            </th>                                 
                            <th scope="col" style="cursor:pointer;padding:0px; border-top-right-radius:5px;">
                                <div class="tip-top" data-original-title="Detalle" style="cursor: pointer;padding: 0px; text-align: center; width: 120px;">
                                    Detalle compra
                                </div>
                            </th>                      
                        </tr>

                    </thead>
                    
                    <tbody><!--AQUI SE INSERTARAN CON JAVASCRIPT --></tbody>
                    
                    <tfoot>                       
                        <tr style="background-color:#555555; color:white;">
                            <th scope="col" style="border-bottom-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px; "></th>
                        </tr>
                    </tfoot>
                </table>                
                <!-- =================================== Fin de id="tabla_jugadores_ayuda_social" =================================== -->

                <table>
                    <tbody id="angelimar"></tbody>
                </table>

            </div>
            <!-- =================================== Fin de class="span12" =================================== -->

            <div id="div_boton_guardar_informes" class="span12" style="display: none; margin: 0px; text-align: center; position: relative; top: -10px;">
                <button type="button" id="boton_guardar_informes_todos" class="boton_gestionar_cargos" onclick="boton_guardar();" style="border-radius: 5px;"><i class="icon-save"></i> GUARDAR INFORMES</button>
            </div>

        </div>
    </form>
    
    <div class="row-fluid" style="margin: 20px 0px 0px;">
        <button class="boton_volver" onclick="boton_volver_de_gestion_ayuda_social();" style="float: left; margin: 0px;"><i class="icon-arrow-left"></i> volver</button>
    </div>
</div>
<!-- ========================================== Fin del id="cuadro_gestion_ayudas_sociales" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_perfil_jugador_selected" ========================================== -->
<!-- <br><center><h1>----------</h1></center><br> -->
<div style="display:none" id="cuadro_perfil_jugador_selected">

    <!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
    <div class="cuadro_buscar_titulo">
        <center>

            <table style="color: black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
                <tbody>
                    <tr class="sin_fondo">
                        <td style="padding: 15px; text-align: center;">
                            <img src="../config/logo_equipo.png" style="height: 90px;">
                        </td>

                        <input class="sexo" type="hidden" autocomplete="off" value="1">
                        <input class="numero_serie" type="hidden" autocomplete="off" value="10">
                        <input class="tecnico" type="hidden" autocomplete="off">  

                        <td style="text-align: center;">
                            <h5 class="nombre-jugador" style="margin-top: 0px;"></h5>
                            <h5 class="datos-jugador" style="color: black; margin: 0px;"></h5>
                            <input type="hidden" name="" class="idfichaJugador">
                        </td>
                    </tr>
                </tbody>
            </table>            
         
            <div class="row-fluid" style="margin-top:0px; margin-bottom: 20px;">
                <div class="span12" style="margin: 0px;">
                    <div style="width:100%; background-color: <?php echo $color_fondo; ?> color: white; height:20px; border-radius: 4px;">
                        <img src="./../config/five_white_stars_2.png" class="img-star-five-stars">
                    </div>
                    <img src="" class="imagen-jugador" style="width: 120px; border-radius: 50%; border: solid 5px <?php echo $color_fondo; ?> height: 120px; margin-top: -75px; margin-right: 80px; float: right;"> 


                    <button class="boton_volver" onclick="boton_volver_serie_selected_registro_cargas_diarias();" style="float:left; margin:0px; margin-top: 20px;">
                        <i class="icon-arrow-left"></i> volver
                    </button>
                </div>
            </div>

            <br/>
        </center>   

        <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
    </div>
    <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
    
    <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:30px;">
        <div class="row-fluid" style="margin-top:-70px;">

            <center>
                <div style="margin:0px; height:20px;"><img src="../config/cargando_buscar.gif" id="cargando_buscar_perfil_jugador" style=" display:none;">
                    <span style="color:#dc4e4e; display:none;" id="error_conexion_perfil_jugador"><b>Error:</b> conexión a internet deficiente.</span>
                    <span style="color:<?php echo $color_fondo; ?>; display:block;" id="sin_resultados_perfil_jugador">Busqueda sin resultados.</span>
                    <button id="boton_refresh_perfil_jugador" class="boton_refresh" onclick="buscar_ayudas_sociales_jugador();" style="margin-left:10px;"><i class="icon-refresh"></i></button>
                </div>       
            </center>

            <!--
            <button style="margin-bottom:10px; margin-top: 0px; float:right;" class="boton_informe_jugador" onclick="boton_agregar_informe_carga();">
                <b style="font-size:13px;"><i class="icon-plus"></i> Agregar informe</b>
            </button>
            -->

            <div class="span12" style="margin: 0px;">
                <table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_ver_ayudas_sociales_jugador">
                    <thead>
                        <tr style="background-color:#555555; color:white;">
                            <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px; width: 45px; text-indent: 10px; text-align: left;">
                                <div class="tip-top" data-original-title="Número" style="width:100%; ">#</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 100px;">
                                <div class="tip-top" data-original-title="Fecha" style="width:100%; text-align: left;">FECHA</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 100px;">
                                <div class="tip-top" data-original-title="Serie" style="text-align: left;">SERIE</div>
                            </th>                                                
                            <th scope="col" style="cursor:pointer; padding:0px; width: 100px;">
                                <div class="tip-top" data-original-title="Monto" style="width:100%; text-align: left;">MONTO</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 170px;">
                                <div class="tip-top" data-original-title="Tipo de Ayuda" style="width:100%; text-align: left;">TIPO DE AYUDA</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 200px;">
                                <div class="tip-top" data-original-title="Detalle de compra" style="width:450px; text-align: left;">DETALLE</div>
                            </th>                                                        
                            <th scope="col" style="cursor:pointer; padding:0px; border-top-right-radius:5px; width:30px;" colspan="3"></th>                            
                        </tr>
                    </thead>
                                        
                    <tbody></tbody>
                                        
                    <tfoot>
                        <!--
                        <tr class="sin_fondo"><td colspan="8"><center><h5 style="color:#555555;"><i class="icon-file-alt"></i> Sin Jugadores</h5></center></td></tr>
                        -->
                        <tr style="background-color:#555555; color:white;">
                            <th scope="col" style="border-bottom-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>                            
                            <th scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px; "></th>
                        </tr>  
                    </tfoot>
                </table>
            </div>


            <div class="span12" style="margin: 0px;">
                <button class="boton_volver" onclick="boton_volver_serie_selected_registro_cargas_diarias();" style="float:left; margin:0px; margin-top: 20px;">
                    <i class="icon-arrow-left"></i> volver
                </button>
            </div>

        </div>
    </div>      

</div>
<!-- ========================================== Fin del id="cuadro_perfil_jugador_selected" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_formulario_guardar" ========================================== -->
<!-- <br><center><h1>----------</h1></center><br> -->
<div style="display:none" id="cuadro_formulario_guardar">

    <!-- ========================================== Inicio del id="formulario" ========================================== -->
    <form method="post" ng-model="formulario" name="formulario" id="formulario" novalidate>

        <!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
        <div class="cuadro_buscar_titulo">
            <center>

                <table style="color: black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
                    <tbody>
                        <tr class="sin_fondo">
                            <td style="padding: 15px; text-align: center;">
                                <img src="../config/logo_equipo.png" style="height: 90px;">
                            </td>

                            <input class="sexo" type="hidden" autocomplete="off" value="1">
                            <input class="numero_serie" type="hidden" autocomplete="off" value="10">
                            <input class="tecnico" type="hidden" autocomplete="off">  

                            <td style="text-align: center;">
                                <h5 class="nombre-jugador" style="margin-top: 0px;"></h5>
                                <h5 class="datos-jugador" style="color: black; margin: 0px;"></h5>
                                <input type="hidden" name="" class="idfichaJugador">
                            </td>
                        </tr>
                    </tbody>
                </table> 
                          
                <div class="row-fluid" style="margin-top:0px; margin-bottom: 20px;">
                        <div class="span12" style="margin: 0px;">
                            <div style="width:100%; background-color: <?php echo $color_fondo; ?> color: white; height:20px; border-radius: 4px;"></div>
                            <img src="" class="imagen-jugador" style="width: 120px; border-radius: 50%; border: solid 2px; height: 120px; margin-top: -75px; margin-right: 80px; float: right;"> 


                        </div>
                </div>
                <br/>
            </center>     

            <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
        </div>
        <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->

        <!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
        <div class="cuadro_buscar_titulo">
            <center>      
                <div class="row-fluid" style="margin: 0px 35px;">
                    <center>
                        <h5 style="margin-left: 10px; color: black;">
                            GESTIÓN DE TALENTOS
                        </h5>
                    </center>
                </div>
                <br/>
            </center>     
            <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
        </div>
        <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
        
        <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:-60px;">
            <div class="row-fluid" style="margin-top:0px;">

                <div class="span12" style="margin: 0px;">

                    <input type="hidden" name="idfichaJugador" id="idfichaJugador">
        
                    <!-- ========================================== Inicio del id="tabla_gestion_talento" ========================================== -->
                    <table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_gestion_talento">
                                            
                        <tbody>
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:30px; padding-bottom:5px; width: 100%;">
                                    <center>
                                    <button class="boton_volver" onclick="boton_volver_perfil_jugador_selected();" style="float:left; margin:0px;">
                                      <i class="icon-arrow-left"></i> volver
                                    </button>
                                    </center>
                                </td>
                            </tr>                                  
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                    <h5 class="titulo-campo-talento">Perfil Comunicacional</h5>
                                </td>
                            </tr>
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <td style="width: 100%; padding: 0px;">
                                    <div class="span12" style="display: flex; width: 100%;">
                                        <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="perfil_comunicacional_talento" id="perfil_comunicacional_talento"></textarea>
                                    </div>
                                </td>                               
                            </tr> 
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                    <h5 class="titulo-campo-talento">Reputación Deportiva</h5>
                                </td>
                            </tr>
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <td style="width: 100%; padding: 0px;">
                                    <div class="span12" style="display: flex; width: 100%;">
                                        <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="reputacion_deportiva_talento" id="reputacion_deportiva_talento"></textarea>
                                    </div>
                                </td>                               
                            </tr>                             
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                    <h5 class="titulo-campo-talento">Redes Sociales</h5>
                                </td>
                            </tr>
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <td style="width: 100%; padding: 0px;">
                                    <div class="span12" style="display: flex; width: 100%;">
                                        <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="redes_sociales_talento" id="redes_sociales_talento"></textarea>
                                    </div>
                                </td>                               
                            </tr>                             
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                    <h5 class="titulo-campo-talento">Aspectos a mejorar</h5>
                                </td>
                            </tr>
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <td style="width: 100%; padding: 0px;">
                                    <div class="span12" style="display: flex; width: 100%;">
                                        <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="aspectos_mejorar_talento" id="aspectos_mejorar_talento"></textarea>
                                    </div>
                                </td>                               
                            </tr>                             
                            <!-- ============================================================================================================ --> 
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                    <h5 class="titulo-campo-talento">Actividades a realizar</h5>
                                </td>
                            </tr>
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <td style="width: 100%; padding: 0px;">
                                    <div class="span12" style="display: flex; width: 100%;">
                                        <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="actividades_realizar_talento" id="actividades_realizar_talento"></textarea>
                                    </div>
                                </td>                               
                            </tr>                             
                            <!-- ============================================================================================================ --> 
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                    <h5 class="titulo-campo-talento">Status</h5>
                                </td>
                            </tr>
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <td style="width: 100%; padding: 0px;">
                                    <div class="span12" style="display: flex; width: 100%;">
                                        <select class="select-status-talento" id="status_talento" name="status_talento" onchange="chequear_datos();">
                                            <option value="">Seleccione un status</option>
                                            <option value="0">Jugador seleccionable</option>
                                            <option value="1">Jugador pre seleccionable</option>
                                            <option value="2">Jugador en desarrollo</option>
                                        </select>
                                    </div>
                                </td>                               
                            </tr>                             
                            <!-- ============================================================================================================ -->
                        </tbody>                                            
                    </table>    
                    <!-- ========================================== Fin del id="tabla_gestion_talento" ========================================== -->

                </div>
            </div>
        </div>      

        <!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
        <div class="cuadro_buscar_titulo">
            <center>      
                <div class="row-fluid" style="margin: 35px;">
                    <center>
                        <h5 style="margin-left: 10px; color: black;">
                            SOCIOLOGÍA
                        </h5>
                    </center>
                </div>
                <br/>
            </center>     
            <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
        </div>
        <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->

        <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:-60px;">
            <div class="row-fluid" style="margin-top:0px;">

                <div class="span12" style="margin: 0px;">
        
                </div>
            </div>
        </div>

    </form>        
    <!-- ========================================== Fin del id="formulario" ========================================== -->

</div>
<!-- ========================================== Fin del id="cuadro_formulario_guardar" ========================================== -->

  
<!-- ========================================== Inicio del id="modal_detalle_ayudasocial" ========================================== -->
<div id="modal_detalle_ayudasocial" class="modal hide" style="border-radius: 0px; width: 700px; height: 500px; background-color: #efefef;">

    <div class="modal-header" style="border: none;">
        <div>

            <center>
                <hr style="width: 270px;display: inline-block;position: absolute;top: 20px;left: 10px;border-top: 1px solid #beb6b6;border-bottom: 2px solid #e0d8d8;">
                <img src="../config/logo_equipo.png" style="height: 100px;margin-top: 10px;">
                <hr style="display: inline-block;width: 270px;position: absolute;top: 20px;margin-left: 38px;border-top: 1px solid #beb6b6;border-bottom: 2px solid #e0d8d8;">
            </center>
        
            <center>
                <p style="color: black;text-transform: uppercase;font-size: 12px;font-weight: bold;">
                    detalle ayuda social
                </p>
            </center>


            <!-- ============================= -->
            <div style="padding: 0px;">
                <div style="margin-top: 10px; font-size: 11px;">
                    <div style="width: 15%; float: left;">
                        <center>
                            <img class="foto-jugador-modal" src="" style="width: 70px;border-radius: 50%;border: solid 2px;height: 70px;position: relative;top: -15px;left: 2px;">
                        </center>
                    </div>
                    <div style="width: 85%;float: right;text-align: left;">
                        <table class="tabla-modal-detalle-jugador" style="float: left; width: 50%;">
                            <tbody>
                                <tr>
                                    <th>Jugador:</th>
                                    <td >                                        
                                        <div style="max-width: 200px;">
                                            <p class="nombrecompleto-jugador-modal ellipsis-text" style="/*position: relative; left: -20px;*/ font-weight: bold;">Edgar Alejandro Aldana</p>
                                        </div>                                                                                       
                                    </td>                                    
                                </tr>   
                                <tr>
                                    <th>Club:</th>
                                    <td class="club-jugador-modal">
                                        <div style="position: relative; left: -35px;">
                                            <div class="img-next-to-text" style="width: 25px;">
                                                <img class="foto-club-modal" src="" style="width: 25px;height:25px;">
                                            </div>
                                            <div style="max-width: 200px;">
                                                <p class="nombre-club-modal ellipsis-text" style="top: 3px;position: relative; font-weight: bold;"></p>
                                            </div>                                             
                                        </div>                                           
                                    </td>                           
                                </tr>                                                          
                            </tbody>
                        </table>
                        <table class="tabla-modal-detalle-jugador" style="float: left; width: 50%;">
                            <tbody>
                                <tr>
                                    <th>RUT:</th>
                                    <td>
                                        <div style="max-width: 200px;">
                                            <p class="rut-modal ellipsis-text" style="left: -70px; position: relative; font-weight: bold;">123124123-7</p>
                                        </div>                                              
                                    </td>                                    
                                </tr>   
                                <tr>
                                    <th>Fecha Nac:</th>
                                    <td>
                                        <div style="max-width: 200px;">
                                            <p class="fecha-nac-modal ellipsis-text" style="left: -35px; position: relative; font-weight: bold;">30-05-2020 (19 años)</p>
                                        </div>                                            
                                    </td>                           
                                </tr>                                                          
                            </tbody>
                        </table>                        
                    </div>
                </div>          
            </div>            
            <!-- ============================= -->

        </div>
        <button type="button" class="close" data-dismiss="modal" style="margin-top: -2px;color: #fff">&times;</button>
    </div>
    
        
    <div class="modal-body" style="clear: both;">

        <!-- ========================================== Inicio del id="formulario_guardar_proyecto" ========================================== -->
        <form method="post" ng-model="formulario" name="formulario_guardar_proyecto" id="formulario_guardar_proyecto" novalidate>

            <!-- ========================================== Inicio del id="tabla_guardar_proyecto" ========================================== -->
            <table style="border: 0px solid #8f8f8f; width:100%; margin-top: 5px;" id="tabla_guardar_proyecto">
                                    
                <input type="hidden" name="idfichaJugador" class="idfichaJugador">

                <tbody>
                    <!-- ============================================================================================================ -->
                    <tr id="tr_head_campos_editar" class="sin_fondo"></tr> 
                    <!-- ============================================================================================================ -->
                    <tr id="tr_campos_editar" class="sin_fondo"></tr> 
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo">
                        <center>
                            <p id="titulo_modal_detalle_compra" style="color: black;text-transform: uppercase;margin: 0;font-weight: bold;font-size: 9px;"></p>
                        </center>                                                  
                    </tr> 
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo">
                        <td style="width: 100%; padding: 0px;" colspan="3">
                            <div class="span12" style="display: flex; width: 100%;" id="div_textarea_detalle_compra"></div>
                        </td>                               
                    </tr>     
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo" style="color:#555555;">
                        <td colspan="3" style="border-top-left-radius:5px; padding-top:30px; padding-bottom:5px; width: 100%;">
                            <center id="container_boton_guadar_modal"></center>
                        </td>
                    </tr>                                                                                     
                </tbody>
                                    
            </table>    

        </form>        
        <!-- ========================================== Fin del id="formulario_guardar_proyecto" ========================================== -->

        
    </div>


</div>
<!-- ========================================== Fin del id="modal_detalle_ayudasocial" ========================================== -->

<div id="modal_agregar_tipoayuda_otro" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
     <center>
            <br>
            <div id="mensaje_agregar_tipoayuda_otro">
              <h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button onclick="boton_cerrar_confirm_tipoayuda_otro();" type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " id="btn_modal_guardar_tipoayuda_otro" onclick="" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>    

<div id="myModalDescargarBoleta" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
     <center>
            <br>
            <div id="mensaje_agregar_DescargarBoleta">
              <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button onclick="boton_cerrar_alerta_confirm_ayuda();" type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_registro();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>    

<!-- ************************************************ Modal del PDF ************************************************ -->
<div id="descargarPDF" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
     <center>
            <br>
            <div id="mensaje_agregar_descargarPDF">
              <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">     
    </div>
</div>

<div id="myModalDescargarExcel" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_agregar_DescargarExcel">
              <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="boton_aceptar_excel();" ng-click="desactivarBotonAgregarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>

<div id="myModal2" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_eliminar_proveedor" style="color:black;">
              <h5><i class="icon-spinner icon-spin icon-large"></i> Cargando informes del jugador...</h5>
              <br>
              <img src="../config/ver_archivo_jugador.png">
              </div>
           
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar_informe();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>


<!-- VIEW JUGADOR -->
<div id="view_ejercicio" class="modal hide" style="border-radius:10px; width: 700px; height: 500px;">

    <div class="modal-header" style="margin-left: 1px; background-color: white; border: white; border-top-right-radius: 5px; border-top-left-radius: 5px;height: 20px">
        <div>

            <hr style="display: inline-block; margin-right: 30px; width: 270px; border: 1px solid #e3e3e3;">
            <img src="../config/logo_equipo.png" style="width:75px; margin-top:5px;">
            
            <hr style="display: inline-block; margin-left: 30px; width: 250px; border: 1px solid #e3e3e3;">
            <h3 style="margin-left: 17px;"><center>CARGA DIARIA</center></h3>

            <!-- <div class="hr-line"></div>
            <fieldset>
                <legend>
                    <img src="../config/logo_equipo.png" style="width:75px; margin-top:5px;">
                </legend>
            </fieldset>
             -->
        </div>
        <button type="button" class="close" data-dismiss="modal" style="margin-top: -2px;color: #fff">&times;</button>
    </div>
    
    
    <div class="modal-body">
        
    </div>


</div>
<!-- FIN VIEW JUGADOR -->
      
      
<div id="myModalComentario" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: #28AEB7; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_agregar_comentario">
              <h5>¿Estás seguro que quieres agregar este comentario?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:#28AEB7; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;" ng-click="activarBoton()"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="enviar_comentario();" ng-click="desactivarBoton()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>
      
      
  </div>
  
  <?php }?>
</div>
</div>





</div>
<!--end-main-container-part-->
<!--Footer-part-->
<div class="row-fluid" style="color: white;">
    <div id="footer" class="span12"> &copy; <?php echo date("Y"); ?> | <?php echo $abreviacion_dominio;?>&#x2122;. Todos los derechos reservados.</div>
</div>
<!--end-Footer-part-->
</body>
</html>

<?php 
    }
?>


<script>

// --------------------- Inicio de la función 'buscar_clubes_todos()' --------------------- //
function buscar_clubes_todos() {

    // Vaciando selects:
    $(".select-club").empty();
    $(".select-club-filtro-busqueda").empty();
    
    $.ajax({
        url: "post/ffch_ayuda_social_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_all_clubes',    
        },success: function(respuesta){

            // Para los formularios (la primera opción es 'Seleccione')
            $(".select-club").append('<option value="0">Todos</option>');
            for(var i=0; i < respuesta.length; i++) {   
                $(".select-club").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
            }        
            
        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
            $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    });     
}
// --------------------- Fin de la función 'buscar_clubes_todos()' --------------------- //

// --------------------- Inicio de la función 'buscar_tipos_ayuda_social()' --------------------- //
function buscar_tipos_ayuda_social() {
    
    $.ajax({
        url: "post/ffch_ayuda_social_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_tipos_ayuda_social',    
        },success: function(respuesta){

            // Vaciando el ul:
            $('#ul_tipos_ayuda_filtro_busqueda').html('');

            $('#ul_tipos_ayuda_filtro_busqueda').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_idtipo_ayuda_filtro input_multiple" value="000" data-eliminar="0"></label></li>');
            for(var i=0; i < respuesta.length; i++) {   

                $('#ul_tipos_ayuda_filtro_busqueda').append('<li><label class="option"><span class="label_s">'+respuesta[i]['descripcion_tipo_ayuda_social']+'</span> <input type="checkbox" name="tipoayuda_filtro_busqueda[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['idtipo_ayuda_social']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
            }//aqui_1
   

            seleccionar_todos_tiposayuda_filtro();
            
        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
            $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    });     

}
// --------------------- Fin de la función 'buscar_tipos_ayuda_social()' --------------------- //

// --------------------- Inicio de la función 'get_tipoayuda_guardado_otro()' --------------------- //
function get_tipoayuda_guardado_otro() {
    
    $.ajax({
        url: "post/ffch_ayuda_social_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_ultimo_tipo_ayuda_social',    
        },success: function(respuesta){

            if( window.estatus_editar === 1 ) { 
                // alert('Agregando otro en el modal de editar');
                let elem = $('#modal_detalle_ayudasocial .dropdown-menu');

                let idfichaJugador = elem.attr('idfichaJugador');

                let x = $('<li><label class="option"><span class="label_s">'+respuesta[0]['descripcion_tipo_ayuda_social']+'</span> <input type="checkbox" name="array_idtipo_ayuda_'+idfichaJugador+'[]" class="array_idtipo_ayuda_editar input_multiple" value="'+respuesta[0]['idtipo_ayuda_social']+'" data-eliminar="0" idfichaJugador="'+idfichaJugador+'" onchange="chequear_datos_form_editar('+idfichaJugador+');"></label></li>');

                x.insertAfter( elem.find('.li-tipo-ayuda:last') );
                elem.find('.li_input_text_tipo_ayuda_otro').hide(); // <--- Ocultando li
                elem.find('.li_input_text_tipo_ayuda_otro input').val(''); // <--- Vaciando input text del  li
                elem.find('.li_tipo_ayuda_otro input').prop('checked', false); // <--- Quitanto la propiedad checked del input otro.

                

                 // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
                let numero_select = 0;
                let nombre_option = '';

                $('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').each(function () {

                    if ($(this).prop('checked')) {
                        nombre_option = $(this).closest('label').find(".label_s").html();
                        numero_select++;
                        //alert( nombre_option );
                    }
                });
                
                // ESTABLECEMOS EL TITULO DEL BOTON
                // SI NO HAY NINGUNO COLOCAMOS EL QUE TRAE POR DEFAULT.
                if (numero_select == 0) {
                    descripcion = 'Seleccione tipos de ayuda';
                }
                
                // SI HAY UNO SE AGREGA ESTE.
                else if (numero_select == 1) {
                    if (nombre_option.length > 25) {
                        nombre_option = nombre_option.substr(0, 22);
                        
                        if (nombre_option[nombre_option.length] == ' ') {nombre_option[nombre_option.length].replace(' ', '')}
                        nombre_option += '...';
                    }
                    descripcion = nombre_option;
                }
                
                // DE LO CONTRARIO SE AGREGA EL NUMERO DE ELEMENTOS SELECIONADOS.
                else { descripcion = numero_select+' Elementos selec.'; }
                
                // ARREGLO CON LOS VALORES DE LAS OPCIONES YA REGISTRADAS PARA SU POSTERIOR ELIMINACION.
                if ($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').prop('checked')) {
                    if ($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar') != 0) {
                        let posicion = window.eliminarObjetivos.indexOf($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar'));
                        if (posicion != -1) { window.eliminarObjetivos.splice(posicion, 1); }
                    }
                } else {
                    if ($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar') != 0) { window.eliminarObjetivos.push($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar')); }
                }
                
                $('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').closest('ul').siblings().find('.titulo_multi').html(descripcion);               


            } else {

                $('#tabla_jugadores_ayuda_social .dropdown-menu').each(function(i){

                    let idfichaJugador = $(this).attr('idfichaJugador');

                    let x = $('<li class="li-tipo-ayuda"><label class="option"><span class="label_s">'+respuesta[0]['descripcion_tipo_ayuda_social']+'</span> <input type="checkbox" name="array_idtipo_ayuda[]" class="array_idtipo_ayuda_incluir input_multiple" value="'+respuesta[0]['idtipo_ayuda_social']+'" data-eliminar="0" idfichaJugador="'+idfichaJugador+'" onchange="chequear_datos_form_incluir();"></label></li>');

                    x.insertAfter( $(this).find('.li-tipo-ayuda:last') );
                    $(this).find('.li_input_text_tipo_ayuda_otro').hide(); // <--- Ocultando li
                    $(this).find('.li_input_text_tipo_ayuda_otro input').val(''); // <--- Vaciando input text del  li
                    $(this).find('.li_tipo_ayuda_otro input').prop('checked', false); // <--- Quitanto la propiedad checked del input otro.

                });

                // Mostrando texto de opciones seleccionadas por cada fila:
                $('#tabla_jugadores_ayuda_social .array_idtipo_ayuda_incluir').each(function(){
                    // alert('s');
                    let idfichaJugador = $(this).attr('idfichaJugador');
                   
                     // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
                    let numero_select = 0;
                    let nombre_option = '';

                    $('#tabla_jugadores_ayuda_social input[idfichaJugador="'+idfichaJugador+'"]').each(function () {

                        if ($(this).prop('checked')) {
                            nombre_option = $(this).closest('label').find(".label_s").html();
                            numero_select++;
                            //alert( nombre_option );
                        }
                    });
                    
                    // ESTABLECEMOS EL TITULO DEL BOTON
                    // SI NO HAY NINGUNO COLOCAMOS EL QUE TRAE POR DEFAULT.
                    if (numero_select == 0) {
                        descripcion = 'Seleccione tipos de ayuda';
                    }
                    
                    // SI HAY UNO SE AGREGA ESTE.
                    else if (numero_select == 1) {
                        if (nombre_option.length > 25) {
                            nombre_option = nombre_option.substr(0, 22);
                            
                            if (nombre_option[nombre_option.length] == ' ') {nombre_option[nombre_option.length].replace(' ', '')}
                            nombre_option += '...';
                        }
                        descripcion = nombre_option;
                    }
                    
                    // DE LO CONTRARIO SE AGREGA EL NUMERO DE ELEMENTOS SELECIONADOS.
                    else { descripcion = numero_select+' Elementos selec.'; }
                    
                    // ARREGLO CON LOS VALORES DE LAS OPCIONES YA REGISTRADAS PARA SU POSTERIOR ELIMINACION.
                    if ($(this).prop('checked')) {
                        if ($(this).attr('data-eliminar') != 0) {
                            let posicion = window.eliminarObjetivos.indexOf($(this).attr('data-eliminar'));
                            if (posicion != -1) { window.eliminarObjetivos.splice(posicion, 1); }
                        }
                    } else {
                        if ($(this).attr('data-eliminar') != 0) { window.eliminarObjetivos.push($(this).attr('data-eliminar')); }
                    }
                    
                    $(this).closest('ul').siblings().find('.titulo_multi').html(descripcion);
                });



            }
   
            
        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
            $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    });     
}
// --------------------- Fin de la función 'get_tipoayuda_guardado_otro()' --------------------- //

// --------------------- Inicio de la función 'buscar_tipos_ayuda_social_form()' --------------------- //
function buscar_tipos_ayuda_social_form( idfichaJugador, linea ) {

    $.ajax({
        url: "post/ffch_ayuda_social_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_tipos_ayuda_social',    
        },success: function(respuesta){

            if( linea !== -1 ) { // <---- Modificar.

                // Vaciando el ul:
                $('#modal_detalle_ayudasocial #ul_tipos_ayuda_form_'+idfichaJugador+'').html('');

                console.log( 'Array de ID de Tipo de Ayudas (modal editar): ' + datos_ayuda_social_jugador[linea]['array_id_tipos_ayuda'] );
                // alert('Modal editar');
                let array_id_tipos_ayuda = datos_ayuda_social_jugador[linea]['array_id_tipos_ayuda'];

                for(var i=0; i < respuesta.length; i++) {   

                    console.log( array_id_tipos_ayuda );

                    let n = array_id_tipos_ayuda.includes( respuesta[i]['idtipo_ayuda_social'] );

                    let attr_check = '';
                    if( n ) {
                        // alert( 'Si' );
                        attr_check = 'checked';
                    } else {
                        // alert( 'No' );
                    }

                    $('#modal_detalle_ayudasocial #ul_tipos_ayuda_form_'+idfichaJugador+'').append('<li class="li-tipo-ayuda"><label class="option"><span class="label_s">'+respuesta[i]['descripcion_tipo_ayuda_social']+'</span> <input '+attr_check+' type="checkbox" name="array_idtipo_ayuda_'+idfichaJugador+'[]" class="array_idtipo_ayuda_editar input_multiple" value="'+respuesta[i]['idtipo_ayuda_social']+'" data-eliminar="0" idfichaJugador="'+idfichaJugador+'" onchange="chequear_datos_form_editar('+idfichaJugador+');"></label></li>');
                }   

                $('#modal_detalle_ayudasocial #ul_tipos_ayuda_form_'+idfichaJugador+'').append('<li style="display: none;" class="li_input_text_tipo_ayuda_otro" id="li_input_tipo_ayuda_otro_'+idfichaJugador+'"><label class="option"><input type="text" id="input_ayuda_otro_'+idfichaJugador+'" name="input_ayuda_otro_'+idfichaJugador+'" class="array_idtipo_ayuda_editar input-ayuda-social" style="width: 150px; border: 1px solid #d8d5d5; background-color: white; border-radius: 5px; margin: 5px 0px;" idfichaJugador="'+idfichaJugador+'" onkeyup="chequear_datos_form_editar('+idfichaJugador+');" onkeydown="chequear_datos_form_editar('+idfichaJugador+');"><a class="icono-agregar-otro" onclick="boton_guardar_tipo_ayuda_otro('+idfichaJugador+', 2);"><i class="icon-plus"></i></a></label></li>');

                $('#modal_detalle_ayudasocial #ul_tipos_ayuda_form_'+idfichaJugador+'').append('<li id="'+idfichaJugador+'" class="li_tipo_ayuda_otro"><label class="option"><span class="label_s">Otro</span> <input onclick="agregarOtroTipoAyuda('+idfichaJugador+', 2);" type="checkbox" name="array_idtipo_ayuda_'+idfichaJugador+'[]" class="array_idtipo_ayuda_editar input_multiple" value="000" data-eliminar="0" idfichaJugador="'+idfichaJugador+'" onchange="chequear_datos_form_editar('+idfichaJugador+');"></label></li>');                 

                 // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
                let numero_select = 0;
                let nombre_option = '';

                $('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').each(function () {

                    if ($(this).prop('checked')) {
                        nombre_option = $(this).closest('label').find(".label_s").html();
                        numero_select++;
                        //alert( nombre_option );
                    }
                });
                
                // ESTABLECEMOS EL TITULO DEL BOTON
                // SI NO HAY NINGUNO COLOCAMOS EL QUE TRAE POR DEFAULT.
                if (numero_select == 0) {
                    descripcion = 'Seleccione tipos de ayuda';
                }
                
                // SI HAY UNO SE AGREGA ESTE.
                else if (numero_select == 1) {
                    if (nombre_option.length > 25) {
                        nombre_option = nombre_option.substr(0, 22);
                        
                        if (nombre_option[nombre_option.length] == ' ') {nombre_option[nombre_option.length].replace(' ', '')}
                        nombre_option += '...';
                    }
                    descripcion = nombre_option;
                }
                
                // DE LO CONTRARIO SE AGREGA EL NUMERO DE ELEMENTOS SELECIONADOS.
                else { descripcion = numero_select+' Elementos selec.'; }
                
                // ARREGLO CON LOS VALORES DE LAS OPCIONES YA REGISTRADAS PARA SU POSTERIOR ELIMINACION.
                if ($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').prop('checked')) {
                    if ($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar') != 0) {
                        let posicion = window.eliminarObjetivos.indexOf($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar'));
                        if (posicion != -1) { window.eliminarObjetivos.splice(posicion, 1); }
                    }
                } else {
                    if ($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar') != 0) { window.eliminarObjetivos.push($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar')); }
                }
                
                $('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').closest('ul').siblings().find('.titulo_multi').html(descripcion);                

            } else { // <--- Incluir

                // Vaciando el ul:
                $('#angelimar #ul_tipos_ayuda_form_'+idfichaJugador+'').html('');

                for(var i=0; i < respuesta.length; i++) {   

                    $('#angelimar #ul_tipos_ayuda_form_'+idfichaJugador+'').append('<li class="li-tipo-ayuda"><label class="option"><span class="label_s">'+respuesta[i]['descripcion_tipo_ayuda_social']+'</span> <input type="checkbox" name="array_idtipo_ayuda[]" class="array_idtipo_ayuda_incluir input_multiple" value="'+respuesta[i]['idtipo_ayuda_social']+'" data-eliminar="0" idfichaJugador="'+idfichaJugador+'" onchange="chequear_datos_form_incluir();"></label></li>');
                }   

                $('#angelimar #ul_tipos_ayuda_form_'+idfichaJugador+'').append('<li style="display: none;" class="li_input_text_tipo_ayuda_otro" id="li_input_tipo_ayuda_otro_'+idfichaJugador+'"><label class="option"><input type="text" id="input_ayuda_otro_'+idfichaJugador+'" class="array_idtipo_ayuda_incluir input-ayuda-social" style="width: 120px; border: 1px solid #d8d5d5; background-color: white; border-radius: 5px; margin: 5px 0px;" idfichaJugador="'+idfichaJugador+'" onkeyup="chequear_datos_form_incluir();" onkeydown="chequear_datos_form_incluir();"><a class="icono-agregar-otro" onclick="boton_guardar_tipo_ayuda_otro('+idfichaJugador+', 1);"><i class="icon-plus"></i></a></label></li>');

                $('#angelimar #ul_tipos_ayuda_form_'+idfichaJugador+'').append('<li id="'+idfichaJugador+'" class="li_tipo_ayuda_otro"><label class="option"><span class="label_s">Otro</span> <input onclick="agregarOtroTipoAyuda('+idfichaJugador+', 1);" type="checkbox" name="array_idtipo_ayuda[]" class="array_idtipo_ayuda_incluir input_multiple" value="000" data-eliminar="0" idfichaJugador="'+idfichaJugador+' onchange="chequear_datos_form_incluir();""></label></li>');                 

            }
            
            /*            
            $('#ul_tipos_ayuda_form_'+idfichaJugador+'').append('<li><label class="option"><input type="text" id="input_ayuda_otro_'+idfichaJugador+'" name="input_ayuda_otro_'+idfichaJugador+'" class="array_idtipo_ayuda input-ayuda-social" style="display: none; width: 150px; border: 1px solid #d8d5d5; background-color: white; border-radius: 5px; margin: 5px 0px;"></label></li>');

            $('#ul_tipos_ayuda_form_'+idfichaJugador+'').append('<li id="'+idfichaJugador+'" class="li_tipo_ayuda_otro"><label class="option"><span class="label_s">Otro</span> <input onclick="agregarOtroTipoAyuda('+idfichaJugador+');" type="checkbox" name="array_idtipo_ayuda_'+idfichaJugador+'[]" class="array_idtipo_ayuda input_multiple" value="000" data-eliminar="0"></label></li>'); 
            */    
     
            
        },error: function(){// will fire when timeout is reached
            console.log('Error al consultar tipos de ayuda');
        }, timeout: 15000 // sets timeout to 3 seconds
    });     
}
// --------------------- Fin de la función 'buscar_tipos_ayuda_social_form()' --------------------- //

    // ---------------------------- Cambiando formato de fecha a DD-MMM-AAAA ---------------------------- //
    function fecha_formato_ddmmaaa( fecha ) {
        // Día:
        var dia = fecha.substring(8, 10); 
        // Mes:
        var mes = fecha.substring(5, 7);     
        // Año:
        var anio = fecha.substring(0, 4); 
        // Resultado:
        return fecha = dia + "-" + mes + "-" + anio;
    }

    // ---------------------------- Cambiando formato de fecha a DD/MMM/AAAA ---------------------------- //
    function fecha_date_js( fecha ) {
        // Día:
        var dia = fecha.substring(8, 10); 
        // Mes:
        var mes = fecha.substring(5, 7);     
        // Año:
        var anio = fecha.substring(0, 4); 
        // Fecha:
        let date = dia + "/" + mes + "/" + anio;

        // Resultado:
        anio = parseInt( anio );
        mes = parseInt( mes );
        dia = parseInt( dia );
        return new Date( anio, mes, dia );
    }       

    function getCurrentDate() {

        let today = new Date();
        today = today.toString();

        // nuevaFechaTiempoDesbloqueo = today.toString();

        // Fri Jan 03 2020 19:30:46 GMT-0400 (hora de Venezuela)
        let anio = today.substring(11, 15); 
        let mes = today.substring(4, 7);
        let dia = today.substring(8, 10);
      
        switch( mes ) {
            case "Jan":
                mes = '01';
                break;
            case "Feb":
                mes = '02';
                break;
            case "Mar":
                mes = '03';
                break;
            case "Apr":
                mes = '04';
                break;
            case "May":
                mes = '05';
                break;
            case "Jun":
                mes = '06';
                break;
            case "Jul":
                mes = '07';
                break;
            case "Aug":
                mes = '08';
                break;
            case "Sep":
                mes = '09';
                break;
            case "Oct":
                mes = '10';
                break;                                                                                    
            case "Nov":
                mes = '11';
                break;
            case "Dec":
                mes = '12';
                break;
        }
                    

        let fecha = dia + "/" + mes + "/" + anio;

        // Resultado:
        anio = parseInt( anio );
        mes = parseInt( mes );
        dia = parseInt( dia );
        return new Date( anio, mes, dia );
    }    


    // -------------------- Inicio de la función 'buscarJugador()' -------------------- //
    function buscarJugador () {
        $('#modal_buscar_jugador').modal();
        $('#listado_jugadores_modal').html('<div style="text-align: center;"><h5 style="margin: 0px 0px 20px;"><i class="icon-spinner icon-spin icon-large"></i> Cargando jugadores...</h5><img src="../config/ver_archivo_jugador.png"></div>');
        $.ajax({
            url: "post/udc_modulo_entrenamientos_jugadores.php",
            type: "post",
            dataType: 'json',
            data: {
                'seleccion': window.id_seleccion
            },success: function(respuesta){
                window.listaJugadoresA = respuesta;
                $('#listado_jugadores_modal').empty();

                if (window.listaJugadoresA == "") {
                    $('#listado_jugadores_modal').html('<div style="text-align: center;"><h5 style="margin: 0px 0px 20px;"><i class="icon-remove"></i> No hay jugadores disponibles</h5><img src="../config/ver_archivo_jugador.png"></div>');
                } else {
                    for (var i = 0; i < window.listaJugadoresA.length; i++) {
                        let estatusAgregar = true;
                        $('.lista_jugadores').each(function () {
                            if ($(this).val() == window.listaJugadoresA[i]['idfichaJugador']) {
                                estatusAgregar = false;
                            }
                        });
                        if (estatusAgregar){
                            let edad = calcular_edad(window.listaJugadoresA[i]['fechaNacimiento']);
                            $('#listado_jugadores_modal').append('<div class="agregar_jugadores" style="display: flex; align-items: center; width: 100%; padding: 3px 5px;" onclick="agregarJugador('+i+');"><b style="width: 100%;"><img src="flags/blank.gif" class="flag flag-'+window.listaJugadoresA[i]['codigoNacionalidad1'].toLowerCase()+'" /> '+arreglo_posicion1_d[window.listaJugadoresA[i]['posicion']]+' <img src="foto_jugadores/'+window.listaJugadoresA[i]['idfichaJugador']+'.png" style="width: 27.5px; border: 2px solid #555555; border-radius: 50%; margin: 0px 5px;">'+window.listaJugadoresA[i]['nombre']+' '+window.listaJugadoresA[i]['apellido1']+' '+window.listaJugadoresA[i]['apellido2']+', '+edad+' Años</b></div>');
                        }
                    }
                    if ($('#listado_jugadores_modal').html() == '') {
                        $('#listado_jugadores_modal').append('<div style="text-align: center;"><b>No hay jugadores por agregar</b></div>');
                    }
                }
            },error: function(){
                $("#listado_jugadores_modal").html('<h5 style="color: #555555; text-align: center;"><i class="icon-remove"></i> <span style="color: #dc4e4e;"><b>Error:</b> conexión a internet deficiente.<span></h5>');
            }, timeout: 15000
        });
    }    
    // -------------------- Fin de la función 'buscarJugador()' -------------------- //

    // -------------------- Inicio de la función 'agregarJugador()' -------------------- //
    function agregarJugador (posicion) {
        let n_lista = $("#cargar_jugadores tr").length + 1;
        
        // ------------------------------
        let fila_tabla_jugadores = '';
        let edad = calcular_edad(window.listaJugadoresA[posicion]['fechaNacimiento']);
        fila_tabla_jugadores += '<tr class="elejir_jugador" id="jug_'+window.listaJugadoresA[posicion]['idfichaJugador']+'">';
        fila_tabla_jugadores += '<td style="width: 30px; text-align: center;"><b>'+n_lista+'</b></td>';
        fila_tabla_jugadores += '<td style="width: 140px; font-size: 12px;">';
        fila_tabla_jugadores += '<input type="checkbox" name="lista_jugadores[]" id="jug_'+window.listaJugadoresA[posicion]['idfichaJugador']+'_check" class="lista_jugadores" value="'+window.listaJugadoresA[posicion]['idfichaJugador']+'" style="margin: 0px; display: none;" data-eliminar="0">';
        fila_tabla_jugadores += '<img src="flags/blank.gif" class="flag flag-'+window.listaJugadoresA[posicion]['codigoNacionalidad1'].toLowerCase()+'" /> <b>'+arreglo_posicion1_d[window.listaJugadoresA[posicion]['posicion']]+'</b></td>';
        fila_tabla_jugadores += '<td><b><img src="foto_jugadores/'+window.listaJugadoresA[posicion]['idfichaJugador']+'.png" style="width: 27.5px; border: 2px solid #555555; border-radius: 50%;"> '+window.listaJugadoresA[posicion]['nombre']+' '+window.listaJugadoresA[posicion]['apellido1']+' '+window.listaJugadoresA[posicion]['apellido2']+'</b></td>';
        fila_tabla_jugadores += '<td style="width: 60px;"><b>'+edad+' años</b></td>';
        fila_tabla_jugadores += '<td style="width: 120px;"><b>'+pieHabil[window.listaJugadoresA[posicion]['pieHabil']]+'</b></td>';
        fila_tabla_jugadores += '</tr>';
        $("#cargar_jugadores").append(fila_tabla_jugadores);
               

        $('.lista_jugadores').keypress(function (e) { e.preventDefault(); });
        $($('.elejir_jugador')[n_lista - 1]).click(elegirJugador);
        $($('.elejir_jugador')[n_lista - 1]).trigger('click');
        
        $('#modal_buscar_jugador').modal('hide');
    }    
    // -------------------- Fin de la función 'agregarJugador()' -------------------- //

    // -------------------- Inicio de la función 'calcular_edad (fecha_j)' -------------------- //
    function calcular_edad (fecha_j) {
        let year    = fecha_j.substr(0,4);
        let month   = fecha_j.substr(5,2);
        let day     = fecha_j.substr(8,2);
        let yearA   = fechaA.substr(0,4);
        let monthA  = fechaA.substr(5,2);
        let dayA    = fechaA.substr(8,2);
        
        let edad = 0;
        if (year <= yearA) {
            edad = yearA - year;
            if (month > monthA) {
                if (edad != 0) { edad--; }
            } else if (month == monthA) {
                if (day > dayA) { if (edad != 0) { edad--; } }
            }
        }
        return edad;
    }
    // -------------------- Fin de la función 'calcular_edad (fecha_j)' -------------------- //

    // ---------------------------- Calculando la edad del jugador ---------------------------- //
    function calcularEdad( fecha_nacimiento_param ) {

                    var date = new Date();
                    var anioActual = date.getFullYear();

                    var date_actual_str = date.toString();
                        
                    var anio_actual = date_actual_str.substring(11, 15); 
                    var mes_actual_str = date_actual_str.substring(4, 7);
                    var dia_actual = date_actual_str.substring(8, 10);

                    var anio_actual_int = parseInt( anio_actual ); 
                    var mes_actual_int = parseInt( mes_actual_str );
                    var dia_actual = parseInt( dia_actual );
                    
                    let fecha_nacimiento = fecha_nacimiento_param;

                    // Día de Nacimiento:
                    let dia_nacimiento = fecha_nacimiento.substring(8, 10);
                    dia_nacimiento = parseInt( dia_nacimiento ); 

                    // Mes de Nacimiento:
                    let mes_nacimiento = fecha_nacimiento.substring(5, 7);
                    mes_nacimiento = parseInt( mes_nacimiento );     

                    // Año de Nacimiento:
                    let anio_nacimiento = fecha_nacimiento.substring(0, 4);
                    anio_nacimiento = parseInt( anio_nacimiento ); 


                    // Calculando edad:
                    let edad = anio_actual_int - anio_nacimiento;

                    if( mes_actual_int < mes_nacimiento ) {
                      edad--;
                    }

                    if( mes_actual_int > mes_nacimiento ) {
                      edad;
                    }    

                    if( mes_actual_int === mes_nacimiento ) {
                      // Comparamos los días:
                      if( dia_actual >= dia_nacimiento ) {
                        edad;
                      } else {
                        edad--;
                      }
                    }

                    return edad;

    }

    // ----------- Agregando los cuadros de las series ------------- //
    
    let array_series = [

        // Masculino:
        [1, "SUB-8 Masculina", 8, "Jesús Estrada"],
        [1, "SUB-9 Masculina", 9, "Arturo Medina"],
        [1, "SUB-10 Masculina", 10, "Juan Carrasco"],
        [1, "SUB-11 Masculina", 11, "Fabián Quiroz"],
        
        [1, "SUB-12 Masculina", 12, "Miguel Valenzuela"],
        [1, "SUB-13 Masculina", 13, "Alexis Rivero"],
        [1, "SUB-14 Masculina", 14, "Germán Calderón"],
        [1, "SUB-15 Masculina", 15, "Ernesto Quintero"],
        
        [1, "SUB-16 Masculina", 16, "Pedro Seijas"],
        [1, "SUB-17 Masculina", 17, "Willian Valera"],
        [1, "SUB-19 Masculina", 19, "Carlos Ramírez"],
        [1, "Primer Equipo", 99, "Daniel Páez"],
        
        // Femenino:
        [2, "SUB-15 Femenina", 15, "Manuel Gallardo"],
        [2, "SUB-17 Femenina", 17, "Alejandro Landaeta"],
        [2, "Primer Equipo", 99, "Eduardo Escalona"]

    ];

    for( let i = 0; i < array_series.length; i++ ) {

        let sexo = array_series[i][0];
        let serie = array_series[i][1];
        let numero_serie = array_series[i][2];
        let tecnico = array_series[i][3];

        let cuadro_series =
        '<div class="span3" style="text-align: center; margin: 0px; padding: 10px;">\
            <div sexo="'+sexo+'" serie="'+serie+'" numero-serie="'+numero_serie+'" tecnico="'+tecnico+'" class="cuadro_serie">\
                <div style="margin-bottom: 10px;"><img src="../config/logo_equipo.png" style="height: 120px"></div>\
                <div class="nombre_seleccion"><b>'+serie+'</b></div>\
                <div class="cantidad_jugadores" style="padding-top: 15px;"><i class="icon-male"></i> <span class="cantidad-jugadores" sexo="'+sexo+'"></span> </div>\
            </div>\
        </div>';


        if( sexo === 1 ) {
            $(cuadro_series).appendTo('#btn_series_masculinas');
        } else {
            $(cuadro_series).appendTo('#btn_series_femeninas');
        }

    }

    /*
    $('.radio-button').click(function() {
        alert( $(this).val() );
    });
    */

    // Añadiendo filas a todos los <textarea></textarea>
    $("textarea").each(function(){
        $(this).attr("placeholder", "Escriba aquí...");
        $(this).attr("rows", "7");
    });


    // -------------------- Inicio de la función 'get_informes_por_serie()' -------------------- // 
    function get_informes_por_serie(){

        let array_sexo = [];
        let array_numero_serie = [];
        $(".cuadro_serie").each(function(i){

            let sexo = $(this).attr("sexo");
            let numero_serie = $(this).attr("numero-serie");

            array_sexo[i] = sexo;
            array_numero_serie[i] = numero_serie;

        });

        $.ajax({
            url: "post/ffch_ayuda_social_ver.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
            'tipo_consulta': 'cantidad_informes_sexo_serie',
            'array_sexo': array_sexo,
            'array_numero_serie': array_numero_serie
            },success: function(respuesta){
                var count = 1;
                var x = [];
                for(var i=0; i < respuesta.length; i++) {   
                    x[i] = respuesta[i];
                }

                $(".cantidad-informes").each(function(i){
                    $(this).html( '(' + x[i]['cantidad_informes'] + ')' + ' informes' );
                });         
                
            },error: function(){// will fire when timeout is reached
                $('#cargando_buscar').hide();
                $('#sin_resultados').hide();
                $('#error_conexion').show();
                $('#boton_editar').hide();
                $('.boton_refresh').show();
            }, timeout: 15000 // sets timeout to 3 seconds
        });
    }
    // -------------------- Fin de la función 'get_informes_por_serie()' -------------------- //
    // get_informes_por_serie();

function boton_mostrar_modal_descarga() {

    $('#view_ejercicio').modal('show');
    /*
    $('#mensaje_eliminar_proveedor').html('<h5>¿Estás seguro que quieres eliminar este informe?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
    */
}

    // -------------------- Inicio de la función 'buscar_ayudas_sociales_jugador()' -------------------- // 
    function buscar_ayudas_sociales_jugador(){
        $('#error_conexion_perfil_jugador').hide();
        $('#sin_resultados_perfil_jugador').hide();
        $('#cargando_buscar_perfil_jugador').show();
        $("#tabla_ver_ayudas_sociales_jugador tbody").empty(); // <--- Vaciando tabla.
        var idfichaJugador = $(".idfichaJugador").val();

        $.ajax({
            url: "post/ffch_ayuda_social_ver.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
                'tipo_consulta': 'buscar_ayudas_sociales_jugador',
                'idfichaJugador': idfichaJugador
            },
            success: function(respuesta){
                // alert(JSON.stringify(respuesta));
                if(respuesta== ""){ //jugador sin informes
                    $("#tabla_ver_ayudas_sociales_jugador tbody").empty();
                    var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555;" id="informe_"><td colspan="11"><center><b>Aún no tiene informes</b></center></td></tr>';
                    $("#tabla_ver_ayudas_sociales_jugador tbody").append(markup);
                    $("#graficos_informes_resumen").hide();
                    $('#cargando_buscar_perfil_jugador').hide();
                    $('#sin_resultados_perfil_jugador').show();
                    $('#boton_editar').hide();
                    $('.boton_refresh').hide();
                    $('#boton_agregar_informe_carga').prop("disabled", true);
                }else{              
                    $('#boton_agregar_informe_carga').prop("disabled", false); // <--- Habilitando el botón de guardar.
                    window.datos_ayuda_social_jugador = respuesta; //se copian todos los profesores al cache
                    $("#tabla_ver_ayudas_sociales_jugador tbody").empty();
                    var count = 1;

                    for(var i=0; i < respuesta.length; i++){              

                        let idinforme_ayuda_social = respuesta[i]['idinforme_ayuda_social'];

                        let fecha_ayuda_social;
                        if( typeof respuesta[i]['fecha_ayuda_social'] === "undefined" || respuesta[i]['fecha_ayuda_social'] == '0000-00-00' || respuesta[i]['fecha_ayuda_social'] == '' || respuesta[i]['fecha_ayuda_social'] === null ) {
                            fecha_ayuda_social = '-';
                        } else {
                            fecha_ayuda_social = fecha_formato_ddmmaaa( respuesta[i]['fecha_ayuda_social'] );
                        }                    

                        let descripcion_serie;
                        if( respuesta[i]['serieActual'] === null || respuesta[i]['serieActual'] == '' || respuesta[i]['serieActual'] == '0' || respuesta[i]['sexo'] === null || respuesta[i]['sexo'] == '' || respuesta[i]['sexo'] == '0' ) {
                            descripcion_serie = '-';
                        } else {
                            let serieActual = respuesta[i]['serieActual'];
                            let sexo = respuesta[i]['sexo'];                        
                            if( serieActual == '99' ) {
                                descripcion_serie = 'Primer Equipo';
                            } else {
                                /*
                                genero = '';
                                if( sexo == '1' ) {
                                genero = 'Masculina';
                                } else {
                                genero = 'Femenina';
                                }
                                descripcion_serie = 'SUB ' + serieActual + ' ' + genero;
                                */
                                descripcion_serie = 'Sub ' + serieActual;
                            }                        
                        }

                        let monto_ayuda_social;
                        if( respuesta[i]['monto_ayuda_social'] === null || respuesta[i]['monto_ayuda_social'] == '' ) {
                            monto_ayuda_social = '-';
                        } else {    
                            monto_ayuda_social = '$' + respuesta[i]['monto_ayuda_social'];
                        }  

                        let lista_tipos_ayuda;
                        if( respuesta[i]['array_tipos_ayuda'] != null ) {
                            lista_tipos_ayuda = respuesta[i]['array_tipos_ayuda'].join(", ");
                        } else {
                            lista_tipos_ayuda = 'No especificado';
                        }

                        let detalle_ayuda_social = respuesta[i]['detalle_ayuda_social'];

                        var markup = 
                        '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555;">\
                            <td onclick="boton_modal_detalle_ayudasocial('+i+', 3)" style="text-align: left; text-indent: 10px;"><b>'+count+'</b>\</td>\
                            <td onclick="boton_modal_detalle_ayudasocial('+i+', 3)" style="text-align: left;"><b>'+fecha_ayuda_social+'</b></td>\
                            <td onclick="boton_modal_detalle_ayudasocial('+i+', 3)" style="text-align: left;"><b>'+descripcion_serie+'</b>\
                            </td>\
                            <td onclick="boton_modal_detalle_ayudasocial('+i+', 3)" class="td-valoracion">\
                                 <div style="max-width: 130px; text-align: left;">\
                                    <div><p class="ellipsis-text">'+monto_ayuda_social+'</p></div>\
                                </div>\
                            </td>\
                            <td onclick="boton_modal_detalle_ayudasocial('+i+', 3)" class="td-valoracion" style="text-align: left;">\
                                <div style="max-width: 120px;"><p class="ellipsis-text" style="">'+lista_tipos_ayuda+'</p></div>\
                            </td>\
                            <td onclick="boton_modal_detalle_ayudasocial('+i+', 3)" class="td-valoracion" style="text-align: left;">\
                                '+detalle_ayuda_social+'\
                            </td>\
                            <td style="padding: 7px;">\
                                <a class="boton_add" onclick="descargarPDF('+idinforme_ayuda_social+');">\
                                    <i class="icon-download-alt"></i>\
                                </a>\
                            </td>\
                            <td style="padding: 7px;">\
                                <a onclick="boton_modal_detalle_ayudasocial('+i+', 3)" class="boton_editar" >\
                                    <i class="icon-pencil"></i>\
                                </a>\
                            </td>\
                            <td style="padding: 7px;">\
                                <a class="boton_eliminar" onClick="boton_eliminar('+i+');">\
                                    <i class="icon-remove"></i>\
                                </a>\
                            </td>\
                        </tr>';
                        $("#tabla_ver_ayudas_sociales_jugador tbody").append(markup);
                        count = count + 1;
                    }
            

                    $('#boton_agregar').show();
                    $('.boton_refresh').hide();
                } 
                $('#cargando_buscar_perfil_jugador').hide();
                $('#error_conexion_perfil_jugador').hide();
                $('#sin_resultados_perfil_jugador').hide();
            
            },error: function(){// will fire when timeout is reached
                $('#cargando_buscar_perfil_jugador').hide();
                $('#sin_resultados_perfil_jugador').hide();
                $('#error_conexion_perfil_jugador').show();
                $('#boton_editar').hide();
                $('.boton_refresh').show();
            }, timeout: 15000 // sets timeout to 3 seconds
        });
    }
    // -------------------- Fin de la función 'buscar_ayudas_sociales_jugador()' -------------------- //


// -------------------------- Inicio de la función 'boton_ver_perfil_jugador()' - AGREGAR (INSERT) --------------------------- //
function boton_ver_perfil_jugador( linea ){

    window.idinforme_ayuda_social = datos_ultima_ayuda_social[linea]['idinforme_ayuda_social'];

    // alert( idfichaJugador + ' - ' + nombre_completo_jugador + ' - ' + edad + ' - ' + numero_posicion );
    $(".idfichaJugador").val( datos_ultima_ayuda_social[linea]['idfichaJugador'] );
    $(".nombre-jugador").html( datos_ultima_ayuda_social[linea]['nombre'] + " " + datos_ultima_ayuda_social[linea]['apellido1'] + " " + datos_ultima_ayuda_social[linea]['apellido2'] );    

    // Posición:
    let posicion;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_ultima_ayuda_social[linea]['posicion0'] === null || datos_ultima_ayuda_social[linea]['posicion0'] == '0' || datos_ultima_ayuda_social[linea]['posicion0'] == '' || datos_ultima_ayuda_social[linea]['posicion0'] == '999' ) {
        posicion = 'Posición no especificada';
    } else {
        posicion = parseInt( datos_ultima_ayuda_social[linea]['posicion0'] );
        posicion = array_posiciones[posicion][1];
    }

    // Pie Hábil:
    let dinamico;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_ultima_ayuda_social[linea]['dinamico'] === null || datos_ultima_ayuda_social[linea]['dinamico'] == '0' || datos_ultima_ayuda_social[linea]['dinamico'] == '' ) {
        dinamico = 'Pie hábil no especificado';
    } else {
        dinamico = parseInt( datos_ultima_ayuda_social[linea]['dinamico'] );
        if( dinamico === 3 ) { // <---- Ambidiestro.
            dinamico = 'Ambidiestro';
        } else {
            dinamico = 'Pie ' + array_lateralidad[dinamico][1];
        }
        
    }   

    // Edad:
    let edad;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_ultima_ayuda_social[linea]['fechaNacimiento'] === null || datos_ultima_ayuda_social[linea]['fechaNacimiento'] == '0000-00-00' || datos_ultima_ayuda_social[linea]['fechaNacimiento'] == '' ) {
        edad = '0 años (no especificado), ';
    } else {
        edad = calcularEdad( datos_ultima_ayuda_social[linea]['fechaNacimiento'] ) + ' Años, ';
    }

    let datos_jugador = edad + posicion + ", " + dinamico;

    $(".datos-jugador").html( datos_jugador );

    $(".imagen-jugador").attr("src", "foto_jugadores/" + datos_ultima_ayuda_social[linea]['idfichaJugador'] + '.png');
    

    $('#cuadro_serie_selected').hide(500);
    $('#cuadro_perfil_jugador_selected').show(500);
        
    buscar_ayudas_sociales_jugador();

}


$('body').on('keyup keydowm', "#buscar_jugadores_ayuda_social", function () {
  $('#angelimar').empty();
});

// -------------------------- Inicio de la función 'cargarJugadores' --------------------------- //
function cargarJugadores() {


    var array_idfichaJugador = [];
    $('#tabla_cargar_jugadores tbody tr').each(function(i) {

        thisClass = $(this).attr('class');
        idfichaJugador = $(this).attr('idfichaJugador');
        // $(this).attr( 'class', 'elejir_jugador' );
        if( thisClass == 'elejir_jugador checked' ){
            $(this).attr( 'class', 'elejir_jugador checked' );
            array_idfichaJugador[i] = idfichaJugador;           
        }         

    });

    $('#angelimar').empty();

    $('#btn_cargar_jugadores').hide();
    $('#cargar_jugadores').html('<h5 style="color: #555555; text-align: center;"><i class="icon-spinner icon-spin"></i> <b>Cargando...</b></h5>');


    /////////////////////////////////////
    let string = $('#buscar_jugadores_ayuda_social').val();
    $.ajax({
        url: "post/ffch_ayuda_social_ver.php",
        type: "post",
        dataType: 'json',
        data: {
            'string': string,
            'tipo_consulta': 'consultar_jugadores',
            'seleccion': window.id_seleccion
        },success: function(respuesta){
            if (respuesta == "") {
                $("#cargar_jugadores").html('<h5 style="color: #555555; text-align: center;"><i class="icon-file-alt"></i> No hay jugadores</h5>');
                $('#tabla_jugadores_ayuda_social').hide();
                $("#tabla_jugadores_ayuda_social tbody").empty();
                $('#div_boton_guardar_informes').hide();
            } else {
                window.datos_jugador_club = respuesta; //se copian todos los profesores al cache
                $("#cargar_jugadores").empty();
                $("#tabla_jugadores_ayuda_social tbody").empty()
                $("#tabla_jugadores_ayuda_social").hide();
                $('#div_boton_guardar_informes').hide();
                for(var i = 0; i < respuesta.length; i++){

                    // Datos del club:
                    let idclub = respuesta[i]['idclub'];
                    let nombre_club = respuesta[i]['nombre_club'];                    

                    /*
                    let class_tr_checked;
                    let prop_check = '';
                    let n = array_idfichaJugador.includes( respuesta[i]['idfichaJugador'] );
                    if( n ) {
                        prop_check = 'checked';
                        console.log('Si');
                    } else {
                        class_tr_checked = 'elejir_jugador';
                        console.log('No');
                    }
                    */

                    let markup = '';
                    let edad = calcular_edad(respuesta[i]['fechaNacimiento']);
                    markup += '<tr class="elejir_jugador" id="jug_'+respuesta[i]['idfichaJugador']+'" idfichaJugador="'+respuesta[i]['idfichaJugador']+'">';
                    markup += '<td style="width: 30px; text-align: center;"><b>'+(i + 1)+'</b></td>';
                    markup += '<td style="width: 140px; font-size: 12px;">';
                    markup += '<input type="checkbox" name="lista_jugadores[]" id="jug_'+respuesta[i]['idfichaJugador']+'_check" class="lista_jugadores" value="'+respuesta[i]['idfichaJugador']+'" style="margin: 0px; display: none;" data-eliminar="0">';
                    markup += '<img src="flags/blank.gif" class="flag flag-'+respuesta[i]['codigoNacionalidad1'].toLowerCase()+'" /> <b>'+arreglo_posicion1_d[respuesta[i]['posicion']]+'</b></td>';
                    markup += '<td><div class="img-next-to-text" style="width:25px;"><img src="foto_jugadores/'+respuesta[i]['idfichaJugador']+'.png" style="width: 20px; height: 20px; border: 2px solid #555555; border-radius: 50%;"></div><div style="max-width: 300px;"><p class="ellipsis-text" style="position: relative; top: 3px; left: 7px;">'+respuesta[i]['nombre']+' '+respuesta[i]['apellido1']+' '+respuesta[i]['apellido2']+'</p></div></td>';
                    markup += '<td style="width: 140px;"><center><img src="foto_clubes/'+idclub+'.png" style="width: 20px; height: 20px; border: 2px solid #555555; border-radius: 50%;" /></center></td>';
                    markup += '<td style="width: 60px;"><b>'+edad+' años</b></td>';
                    markup += '<td style="width: 120px;"><b>'+pieHabil[respuesta[i]['pieHabil']]+'</b></td>';
                    markup += '</tr>';
                    $("#cargar_jugadores").append(markup);

                    // ----------------------------------
                    let fila_tabla_ayuda_social = 
                    '<tr id="jug_ayuda_social_'+respuesta[i]['idfichaJugador']+'" class="panel_buscar" style="display: none;">\
                        <td style="font-weight:bold;"><b>Num</b>\
                        </td>\
                        <td style="text-align: left;">\
                            <div style="max-width: 130px; text-align: left;">\
                                <div><p class="ellipsis-text">'+arreglo_posicion1_d[respuesta[i]['posicion']]+'</p></div>\
                            </div>\
                        </td>\
                        <td style="text-align: left;">\
                            <div class="img-next-to-text" style="width: 25px;">\
                                <input type="hidden" value="'+ respuesta[i]['idfichaJugador'] +'" name="array_idfichaJugador[]" />\
                                <img src="foto_jugadores/'+respuesta[i]['idfichaJugador']+'.png" class="imagen-jugador" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;">\
                            </div>\
                            <div style="max-width: 200px;">\
                                <p class="ellipsis-text" style="position: relative; top: 3px; left: 7px; text-align: left;">'+respuesta[i]['nombre']+' '+respuesta[i]['apellido1']+' '+respuesta[i]['apellido2']+'</p>\
                            </div>\
                        </td>\
                        <td class="td-valoracion">\
                            <div class="img-next-to-text" style="width:25px;">\
                                <img src="foto_clubes/'+idclub+'.png" class="imagen-jugador" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;">\
                            </div>\
                            <div style="max-width: 300px;">\
                                <p class="ellipsis-text" style="position: relative; top: 3px; left: 7px; text-align: left;">' + nombre_club + '</p>\
                            </div>\
                        </td>\
                        <td class="td-valoracion">\
                            <input readonly id="fecha_ayuda_social_'+respuesta[i]['idfichaJugador']+'" name="fecha_ayuda_social[]" class="datepicker_recurring_start input-ayuda-social" type="" style="width: 100px; background-color: white;" onchange="chequear_datos_form_incluir();" placeholder="Click aquí"/>\
                        </td>\
                        <td class="td-valoracion">\
                            <div class="input-icons">\
                                <span style=" position: absolute; padding-left: 5px; padding-top: 2px; font-weight: bold;">$</span>\
                                <input id="monto_ayuda_social_'+respuesta[i]['idfichaJugador']+'" name="monto_ayuda_social[]" class="input-ayuda-social" type="" style="width: 150px; text-indent: 10px;" onkeyup="chequear_datos_form_incluir();" onkeydown="chequear_datos_form_incluir();" />\
                            </div>\
                        </td>\
                        <td class="td-valoracion">\
                            <div class="btn-group c_objetivo_fisico" style="width: 150px;">\
                                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;"><p id="tipo_ayuda" class="titulo_multi ellipsis-text">Seleccione tipos de ayuda</p> <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>\
                                    <ul idfichaJugador="'+respuesta[i]['idfichaJugador']+'" id="ul_tipos_ayuda_form_'+respuesta[i]['idfichaJugador']+'" class="dropdown-menu" data-titulo="tipo_ayuda">';
                                    buscar_tipos_ayuda_social_form( respuesta[i]['idfichaJugador'], -1 );
                                    fila_tabla_ayuda_social += 
                                    '</ul>\
                            </div>\
                        </td>\
                        <td class="td-valoracion" style="text-align: center;">\
                            <i onclick="boton_modal_detalle_ayudasocial('+i+', 1);" id="carrito_guadar_'+respuesta[i]['idfichaJugador']+'" class="icon-shopping-cart" style="font-size: 25px;"></i>\
                            <input type="hidden" id="detalle_ayuda_modal_hidde_form_'+respuesta[i]['idfichaJugador']+'" name="detalle_ayuda_modal_hidde_form[]" class="input-ayuda-social" type="" style="width: 150px;"/>\
                        </td>\
                    </tr>';

                    $("#angelimar").append(fila_tabla_ayuda_social);                     

                }
                $('.lista_jugadores').keypress(function (e) { e.preventDefault(); });
                
                $('.elejir_jugador').click(elegirJugador);
            }
        },error: function(){
            $('#btn_cargar_jugadores').show();
            $("#cargar_jugadores").html('<h5 style="color: #555555; text-align: center;"><i class="icon-remove"></i> <span style="color: #dc4e4e;"><b>Error:</b> conexión a internet deficiente.<span></h5>');
        }, timeout: 15000
    });
}
// -------------------------- Fin de la función 'cargarJugadores' --------------------------- //

function reordenar_t_ayuda_social() {
    let num = 1;
    $("#tabla_jugadores_ayuda_social tbody tr").each(function(){
      $(this).find('td').eq(0).text(num);
      num++;
    });        

}

function agregarOtroTipoAyuda ( idfichaJugador, operacion ) {

    if( operacion === 1 ) { // <----------- Incluir 
        $('#tabla_jugadores_ayuda_social #li_input_tipo_ayuda_otro_'+idfichaJugador+'').toggle();
    } else { // <----------- Editar
        $('#modal_detalle_ayudasocial #li_input_tipo_ayuda_otro_'+idfichaJugador+'').toggle();
    }

    // alert(idfichaJugador  );
}

function elegirJugador () {

    $("#tabla_jugadores_ayuda_social").show();
    $("#div_boton_guardar_informes").show();

    let id_check = $(this).attr('id')+'_check';
    let idfichaJugador = $(this).attr('idfichaJugador');

    if ($('#'+id_check).prop('checked')) {
        $('#'+id_check).prop('checked', false);
        $(this).removeClass('checked');

        // Ocultando fila del jugador seleccionado de la tabla de ayudas sociales:
        $('#'+idfichaJugador+'_delete').remove();

        let num_rows = $('#tabla_jugadores_ayuda_social tbody tr').length;
        if( num_rows === 0 ) {
            $('#tabla_jugadores_ayuda_social').hide();
            $("#div_boton_guardar_informes").hide();
        } else {
            $('#tabla_jugadores_ayuda_social').show();
            $("#div_boton_guardar_informes").show();
        }   

        reordenar_t_ayuda_social();

    } else {

        $('#'+id_check).prop('checked', true);
        $(this).addClass('checked');
        let delete_row = $('#jug_ayuda_social_'+idfichaJugador+'_old');
        let add_row = $('#jug_ayuda_social_'+idfichaJugador+'').clone().attr('id', idfichaJugador + '_delete');
        // Mostrando fila del jugador seleccionado de la tabla de ayudas sociales:
        $('#tabla_jugadores_ayuda_social').show(); // <--- Mostrando la tabla.
        $('#tabla_jugadores_ayuda_social tbody').append( add_row );
        add_row.show(); 
        delete_row.remove();

        reordenar_t_ayuda_social();


    }

    if (window.id_informe != '') {
        if ($('#'+id_check).prop('checked')) {
            if ($('#'+id_check).attr('data-eliminar') != 0) {
                let posicion = window.eliminarJugadores.indexOf($('#'+id_check).attr('data-eliminar'));
                if (posicion != -1) {
                    window.eliminarJugadores.splice(posicion, 1);
                }
            }
        } else {
            if ($('#'+id_check).attr('data-eliminar') != 0) {
                window.eliminarJugadores.push($('#'+id_check).attr('data-eliminar'));
            }
        }
    }
    
    let numeros_input = $('.lista_jugadores').length;
    let contador_chec = 0;
    
    $('.lista_jugadores').each(function () {
        if ($(this).prop('checked')) { contador_chec++; }
    });
    
    let btn_descripcion = '';
    if (contador_chec == 0) {
        btn_descripcion = '<i class="icon-check"></i> Marcar todos';
    } else if (contador_chec > 0 && contador_chec < numeros_input) {
        btn_descripcion = '<i class="icon-check-minus"></i> Desmarcar todos';
    } else if (contador_chec == numeros_input) {
        btn_descripcion = '<i class="icon-check-empty"></i> Desmarcar todos';
    }
    $('#btn_marcar_jugadores').html(btn_descripcion);
    
    // chequear_datos_form_incluir(); // <---- Validando formulario.
    $('#boton_guardar_informes_todos').prop("disabled", true); // <---- Deshabilitando el botón.

}
// -------------------------- Fin de la función 'elegirJugador' --------------------------- //

// -------------------------- Inicio de la función 'marcarTodos' --------------------------- //
function marcarTodos () {
    let numeros_input = $('.lista_jugadores').length;
    let contador_chec = 0;
    
    $('.lista_jugadores').each(function () {
        if ($(this).prop('checked')) { contador_chec++; }
    });
    
    if (contador_chec > 0 && contador_chec < numeros_input) {
        $('.lista_jugadores').prop('checked', true);
    }
    $('.elejir_jugador').trigger('click');
}
// -------------------------- Fin de la función 'marcarTodos' --------------------------- //


function guardar_datelle_input_hidden( idfichaJugador ) {
    let detalle_ayuda_social = $('#detalle_ayuda_social_'+idfichaJugador+'').val();
    $('#detalle_ayuda_modal_hidde_form_'+idfichaJugador+'').val( detalle_ayuda_social );
    let detalle_ayuda_modal_hidde_form = $('#detalle_ayuda_modal_hidde_form_'+idfichaJugador+'').val();

    if( detalle_ayuda_modal_hidde_form != '' ) {
        $('#carrito_guadar_'+idfichaJugador+'').css('color', 'orange');
    } else {
        $('#carrito_guadar_'+idfichaJugador+'').css('color', '');
    }

    chequear_datos_form_incluir();

}

// -------------------------- Inicio de la función 'boton_modal_detalle_ayudasocial' --------------------------- //
function boton_modal_detalle_ayudasocial( linea, vista_modal ) {


    /*
    vista_modal: 
    1 -> Incluir
    2 -> Consultar (Última ayuda)
    3 -> Modificar
    */

    // Vaciando el div que almacena el textarea para el detalle de compra:
    $('#div_textarea_detalle_compra').html('');

    var variable_global;
    var boton_guardar_modal;
    var titulo_detalle_compra;
    switch( vista_modal ) {

        case 1: // <----- Incluir

            window.idinforme_ayuda_social = '';

            window.estatus_editar = 0;

            variable_global = window.datos_jugador_club;

            titulo_detalle_compra = 'detalle aquí la compra';

            $('#div_textarea_detalle_compra').html('<textarea placeholder="Escriba aquí" rows="7" onkeyup="guardar_datelle_input_hidden('+variable_global[linea]['idfichaJugador']+');" onkeydown="guardar_datelle_input_hidden('+variable_global[linea]['idfichaJugador']+');" style="resize: none;" class="textarea-social" id="detalle_ayuda_social_'+variable_global[linea]['idfichaJugador']+'" name="detalle_ayuda_social_'+variable_global[linea]['idfichaJugador']+'"></textarea>');        

            let detalle_ayuda_modal_hidde_form = $('#detalle_ayuda_modal_hidde_form_'+variable_global[linea]['idfichaJugador']+'').val();
            $('#detalle_ayuda_social_'+variable_global[linea]['idfichaJugador']+'').val( detalle_ayuda_modal_hidde_form );    

            $('#tr_head_campos_editar').html('');
            $('#tr_campos_editar').html('');

            boton_guardar_modal = 
            '<button style="position: relative; top: -15px;" type="submit" id="boton_guardar_ayuda_social_incluir" class="boton_guardar_ayuda_social" onclick="boton_cerrar_modal_guardar();">\
                GUARDAR\
            </button>';
            $('#container_boton_guadar_modal').html(boton_guardar_modal);

            $('#boton_guardar_ayuda_social').show();

            break;

        case 2: // <----- Consultar (Última ayuda)

            window.estatus_editar = 0;

            window.idinforme_ayuda_social = window.datos_ultima_ayuda_social[linea]['idinforme_ayuda_social'];

            variable_global = window.datos_ultima_ayuda_social;

            titulo_detalle_compra = 'detalle compra';

            $('#div_textarea_detalle_compra').html('<textarea readonly rows="7" style="resize: none; background-color: white;" class="textarea-social" id="detalle_ayuda_social_'+variable_global[linea]['idfichaJugador']+'" name="detalle_ayuda_social_'+variable_global[linea]['idfichaJugador']+'">'+variable_global[linea]['detalle_ayuda_social']+'</textarea>');        

            $('#tr_head_campos_editar').html('');
            $('#tr_campos_editar').html('');

            boton_guardar_modal = '';
            $('#container_boton_guadar_modal').html(boton_guardar_modal);

            $('#boton_guardar_ayuda_social').hide();

            break;

        case 3: // <----- Modificar

            console.log( 'Array de ID de tipos de ayuda: ' + datos_ayuda_social_jugador[linea]['array_id_tipos_ayuda'] );

            window.estatus_editar = 1;

            window.idinforme_ayuda_social = window.datos_ayuda_social_jugador[linea]['idinforme_ayuda_social'];

            variable_global = window.datos_ayuda_social_jugador;

            titulo_detalle_compra = 'detalle aquí la compra';

            $('#div_textarea_detalle_compra').html('<textarea placeholder="Escriba aquí" rows="7" style="resize: none;" class="textarea-social" id="detalle_ayuda_social_'+variable_global[linea]['idfichaJugador']+'" name="detalle_ayuda_social_'+variable_global[linea]['idfichaJugador']+'" onkeyup="chequear_datos_form_editar('+variable_global[linea]['idfichaJugador']+');" onkeydown="chequear_datos_form_editar('+variable_global[linea]['idfichaJugador']+');">'+variable_global[linea]['detalle_ayuda_social']+'</textarea>'); 

            // ----------------------------------
            
            let tr_head_campos_editar =
            '<td class="td-valoracion td-head-form-edit">FECHA COMPRA</td>\
            <td class="td-valoracion td-head-form-edit">MONTO</td>\
            <td class="td-valoracion td-head-form-edit">DESCRIPCIÓN</td>';

            let tr_campos_editar = 
            '<td class="td-valoracion">\
                    <center>\
                        <input readonly id="fecha_ayuda_social_'+variable_global[linea]['idfichaJugador']+'" name="fecha_ayuda_social_'+variable_global[linea]['idfichaJugador']+'" value="'+variable_global[linea]['fecha_ayuda_social']+'" class="datepicker_recurring_start input-ayuda-social" type="" style="background-color: white;" onchange="chequear_datos_form_editar('+variable_global[linea]['idfichaJugador']+');"/>\
                    </center>\
            </td>\
            <td class="td-valoracion">\
                <center>\
                    <div class="input-icons">\
                            <span style=" position: absolute; padding-left: 5px; padding-top: 2px; font-weight: bold;">$</span>\
                            <input id="monto_ayuda_social_'+variable_global[linea]['idfichaJugador']+'" name="monto_ayuda_social_'+variable_global[linea]['idfichaJugador']+'" value="'+variable_global[linea]['monto_ayuda_social']+'" class="input-ayuda-social" type="" style="text-indent: 10px;" onkeyup="chequear_datos_form_editar('+variable_global[linea]['idfichaJugador']+');" onkeydown="chequear_datos_form_editar('+variable_global[linea]['idfichaJugador']+');"/>\
                    </div>\
                </center>\
            </td>\
            <td class="td-valoracion" style="padding-right: 0;">\
                <center>\
                    <div class="btn-group c_objetivo_fisico" style="width: 100%;">\
                            <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;"><p id="tipo_ayuda" class="titulo_multi ellipsis-text">Seleccione tipos de ayuda</p> <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>\
                                <ul idfichaJugador="'+variable_global[linea]['idfichaJugador']+'" id="ul_tipos_ayuda_form_'+variable_global[linea]['idfichaJugador']+'" class="dropdown-menu" data-titulo="tipo_ayuda">';
                                buscar_tipos_ayuda_social_form( variable_global[linea]['idfichaJugador'], linea );
                                tr_campos_editar += 
                                '</ul>\
                    </div>\
                </center>\
            </td>';

            $('#tr_head_campos_editar').html( tr_head_campos_editar );
            $('#tr_campos_editar').html( tr_campos_editar );

            boton_guardar_modal = 
            '<button style="position: relative; top: -15px;" type="submit" id="boton_guardar_ayuda_social" class="boton_guardar_ayuda_social" onclick="boton_guardar();">\
                GUARDAR\
            </button>';
            $('#container_boton_guadar_modal').html(boton_guardar_modal);

            $('#boton_guardar_ayuda_social').show();

            break;                        

    }

    $('#titulo_modal_detalle_compra').html( titulo_detalle_compra );

    // alert( window.idinforme_ayuda_social );

    window.idfichaJugador = variable_global[linea]['idfichaJugador'];


    // alert( window.idfichaJugador );

    let foto_jugador = 'foto_jugadores/' + variable_global[linea]['idfichaJugador'] + '.png?lala='+new Date()+'';

    // Foto del jugador:
    $(".foto-jugador-modal").attr("src", foto_jugador );
    
    if( variable_global[linea]['apellido2'] === null ) {
        variable_global[linea]['apellido2'] = "";
    } 

    // Nombre Completo:
    $(".nombrecompleto-jugador-modal").html( variable_global[linea]['nombre'] + " " + variable_global[linea]['apellido1'] + " " + variable_global[linea]['apellido2'] );    

    // RUT:
    let rut;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( variable_global[linea]['rut'] === null || variable_global[linea]['rut'] == '' ) {
        rut = 'No especificado';
    } else {
        rut = variable_global[linea]['rut'];
    }
    $(".rut-modal").html( rut ); 

    // Club:
    let idclub_jugador = variable_global[linea]['idclub'];
    let nombre_club_jugador;
    if( variable_global[linea]['nombre_club'] === null || variable_global[linea]['nombre_club'] == '' ) {
        nombre_club_jugador = 'No especificado';
    } else {    
        nombre_club_jugador = variable_global[linea]['nombre_club'];
    }                                            
    let foto_club_jugador = 'foto_clubes/'+idclub_jugador+'.png?lala='+new Date()+'';

    $('.foto-club-modal').attr( 'src', foto_club_jugador );
    $(".nombre-club-modal").html( nombre_club_jugador );

    // Edad:
    let text_fecha_nac; 
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( variable_global[linea]['fechaNacimiento'] === null || variable_global[linea]['fechaNacimiento'] == '0000-00-00' || variable_global[linea]['fechaNacimiento'] == '' ) {
        text_fecha_nac = 'No especificado';
    } else {
        let edad;
        let fechaNacimiento;
        fechaNacimiento = fecha_formato_ddmmaaa( variable_global[linea]['fechaNacimiento'] );  
        edad = calcularEdad( variable_global[linea]['fechaNacimiento'] );
        text_fecha_nac = fechaNacimiento + ' ('+edad+' años)'; 
    }

    // Fecha de Nacimiento:
    $(".fecha-nac-modal").html( text_fecha_nac );

    $('#modal_detalle_ayudasocial').modal('show');

    if( window.estatus_editar === 3 ) { // <---- Modificar.
        chequear_datos_form_editar( variable_global[linea]['idfichaJugador'] ); // <--- Validando
    }

}
// -------------------------- Fin de la función 'boton_modal_detalle_ayudasocial' --------------------------- //

function boton_eliminar( linea ){
    window.idinforme_ayuda_social= datos_ayuda_social_jugador[linea]['idinforme_ayuda_social'];
    // alert( idinforme_ayuda_social );
    $('#myModal2').modal('show');
    $('#mensaje_eliminar_proveedor').html('<h5>¿Estás seguro que quieres eliminar este informe?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
}

function eliminar_informe() {

    //alert( window.idinforme_ayuda_social );

     $('.boton_modal').hide();
     $('#mensaje_eliminar_proveedor').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando informe...</h5><br><img src="../config/remover_archivo.png">');
     $.ajax({
        url: "post/ffch_ayuda_social_eliminar.php",
        type: "post",
        data: {
            'idinforme_ayuda_social': window.idinforme_ayuda_social
        },success: function(respuesta) {
            if(respuesta==1){//eliminado correctamente
                $('#mensaje_eliminar_proveedor').html('<h5>Informe eliminado correctamente!</h5>');
                buscar_ayudas_sociales_jugador();
                $('#myModal2').modal('hide');
            }else{
                $('#mensaje_eliminar_proveedor').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> contacte al administrador.</h5>");
            }
            // $('#myModal2').modal('hide');
        },error: function(){// will fire when timeout is reached
            $('#mensaje_eliminar_proveedor').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> compruebe conexión a internet.</h5>");
        }, timeout: 10000 // sets timeout to 3 seconds
      });     
}

function boton_cerrar_alerta_confirm_ayuda(){
    $('#myModalDescargarBoleta').modal('hide');
        
    if( window.estatus_editar === 1 ) {
        $('#modal_detalle_ayudasocial').modal('show');
    }

}

// -------------------------- Inicio de la función 'boton_guardar_tipo_ayuda_otro' --------------------------- //
function boton_guardar_tipo_ayuda_otro( idfichaJugador, operacion ) {

    let input_ayuda_otro;
    if( operacion === 1 ) { // <--- Incluir
        input_ayuda_otro = $('#tabla_jugadores_ayuda_social #input_ayuda_otro_'+idfichaJugador+'').val();
    } else { // <--- Editar
        input_ayuda_otro = $('#modal_detalle_ayudasocial #input_ayuda_otro_'+idfichaJugador+'').val();
    }

    $('#mensaje_agregar_tipoayuda_otro').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');

    if( input_ayuda_otro != ''  ) {

        if( window.estatus_editar === 1 ) {
            $('#modal_detalle_ayudasocial').modal('hide');
        } else { // Incluir
            // Escondiendo los ul de la tabla #tabla_jugadores_ayuda_social cuando se muestra el modal:
            $('#tabla_jugadores_ayuda_social .dropdown-menu').each(function(){
                $(this).hide();
            });
        }

        $('#modal_agregar_tipoayuda_otro').modal('show');

        $('#btn_modal_guardar_tipoayuda_otro').attr('onclick', 'guardar_tipoayuda_otro('+idfichaJugador+', '+operacion+');');
        $('.boton_modal').css('display','');    

    }


}
// -------------------------- Fin de la función 'boton_guardar_tipo_ayuda_otro' --------------------------- //

// -------------------------- Inicio de la función 'guardar_tipoayuda_otro' --------------------------- //
function guardar_tipoayuda_otro( idfichaJugador, operacion ) {

    $('.boton_modal').css('display','none');

    let input_ayuda_otro;
    if( operacion === 1 ) { // <--- Incluir
        input_ayuda_otro = $('#tabla_jugadores_ayuda_social #input_ayuda_otro_'+idfichaJugador+'').val();
    } else { // <--- Editar
        input_ayuda_otro = $('#modal_detalle_ayudasocial #input_ayuda_otro_'+idfichaJugador+'').val();
    }
    // alert( input_ayuda_otro );

    // alert(JSON.stringify(data));
    $.ajax({
        url: "post/ffch_ayuda_social_guardar_tipoayuda_otro.php",
        type: "post",
        data: {
            'input_ayuda_otro': input_ayuda_otro,
            'nombre_usuario_software': '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>'
        },
        dataType: 'json',
        cache: false,
        success: function(respuesta){
            // alert(respuesta);
            if(respuesta==1){
                $('#mensaje_agregar_tipoayuda_otro').html('<h4>Registro ingresado correctamente!</h4>');

                // Consultando nuevamente todos los tipos de ayuda:
                get_tipoayuda_guardado_otro();

                $('#modal_agregar_tipoayuda_otro').modal('hide');
                if( window.estatus_editar === 1 ){
                    $('#modal_detalle_ayudasocial').modal('show');
                } 

            } else { 
                $('#mensaje_agregar_tipoayuda_otro').html('<h5>Ha ocurrido un error al ejecutar la consulta: '+respuesta+'.</h5><br>');
            }
            
        },error: function(){// will fire when timeout is reached
           $('#mensaje_agregar_tipoayuda_otro').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 

}
// -------------------------- Fin de la función 'guardar_tipoayuda_otro' --------------------------- //

// -------------------------- Inicio de la función 'boton_guardar_tipo_ayuda_otro' --------------------------- //
function boton_cerrar_confirm_tipoayuda_otro() {
    $('#btn_modal_guardar_tipoayuda_otro').attr('onclick', '');
    $('#modal_agregar_tipoayuda_otro').modal('hide');

    if( window.estatus_editar === 1 ) {
        $('#modal_detalle_ayudasocial').modal('show');
    } 
    /*
    else { // Incluir
        // Mostrando los ul de la tabla #tabla_jugadores_ayuda_social cuando se muestra el modal:
        $('#tabla_jugadores_ayuda_social .dropdown-menu').each(function(){
            $(this).show();
        });        
    } 
    */  

}
// -------------------------- Fin de la función 'boton_guardar_tipo_ayuda_otro' --------------------------- //

function boton_guardar(){

    // alert( window.idfichaJugador );
    // alert( 'Estatus editar: ' + window.estatus_editar );

    /*
    let array_idtipo_ayuda;
    if( window.estatus_editar === 1 ) {
        alert('Editando');
        array_idtipo_ayuda = $('#modal_detalle_ayudasocial input[name="array_idtipo_ayuda_'+window.idfichaJugador+'[]"]:checked').map(function(){ 
            alert( this.value ); 
        }).get();  
    } else {
        alert('Insertando');
        array_idtipo_ayuda = $('#tabla_jugadores_ayuda_social input[name="array_idtipo_ayuda_'+window.idfichaJugador+'[]:checked"]').map(function(){ 
            alert( this.value );  
        }).get();        
    }
    */

    /*
        idfichaJugador = $('#tabla_jugadores_ayuda_social input[name="array_idfichaJugador[]"]').map(function(){ 
            return $(this).val();
        }).get(); 
        // console.log( idfichaJugador );

        fecha_ayuda_social = $('#tabla_jugadores_ayuda_social input[name="fecha_ayuda_social[]"]').map(function(){ 
            return $(this).val(); 
        }).get(); 
        // console.log( fecha_ayuda_social );

        monto_ayuda_social = $('#tabla_jugadores_ayuda_social input[name="monto_ayuda_social[]"]').map(function(){ 
            return $(this).val();  
        }).get();    
        // console.log( monto_ayuda_social );     

        detalle_ayuda_social = $('#tabla_jugadores_ayuda_social input[name="detalle_ayuda_modal_hidde_form[]"]').map(function(){ 
            return $(this).val();  
        }).get();  
        // console.log( detalle_ayuda_social );


    */
        array_idtipo_ayuda = [];
        $('#tabla_jugadores_ayuda_social ul[class="dropdown-menu"]').each(function(i){
            let array_idtipo_ayuda_xjugador = $(this).find('input[name="array_idtipo_ayuda[]"]:checked').map(function(){ 
                return $(this).val(); 
            }).get();  

            array_idtipo_ayuda[i] = array_idtipo_ayuda_xjugador;

        });

        // console.log( array_idtipo_ayuda );

        /*
        array_idtipo_ayuda = $('#tabla_jugadores_ayuda_social input[name="array_idtipo_ayuda[]"]:checked').map(function(){ 
            return $(this).val(); 
        }).get();  
        console.log( array_idtipo_ayuda );
        */

        /*
        input_ayuda_otro = []; 
        $('#tabla_jugadores_ayuda_social ul[class="dropdown-menu"]').each(function(i){
            let input_ayuda_otro_xjugador = $(this).find('input[name="input_ayuda_otro[]"]').map(function(){ 
                return $(this).val(); 
            }).get();  
            input_ayuda_otro[i] = input_ayuda_otro_xjugador;
        }); 
        */  


        input_ayuda_otro = $('#tabla_jugadores_ayuda_social ul[class="dropdown-menu"] input[name="input_ayuda_otro[]"]').map(function(){ 
            return $(this).val();  
        }).get();  


        // console.log( input_ayuda_otro );              


    // alert( window.idinforme_ayuda_social );
    if (window.idinforme_ayuda_social != "" ) {
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }
    

    $('#myModalDescargarBoleta').modal('show');
    $('#modal_detalle_ayudasocial').modal('hide');

    $('.boton_modal').css('display','');
}


function guardar_registro() {
    $('.boton_modal').css('display','none');

    // alert( $('#fecha_ayuda_social_'+window.idfichaJugador+'') );

    if(window.idinforme_ayuda_social !="" ){
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }

    
    var idfichaJugador_form;
    var fecha_ayuda_social;
    var monto_ayuda_social;
    var detalle_ayuda_social;
    var array_idtipo_ayuda;
    var input_ayuda_otro;


    if( window.estatus_editar === 1 ) { // <----------- Editar (Datos indivudales):

        idfichaJugador_form = window.idfichaJugador;
        fecha_ayuda_social = $('#modal_detalle_ayudasocial #fecha_ayuda_social_'+window.idfichaJugador+'').val();
        monto_ayuda_social = $('#modal_detalle_ayudasocial #monto_ayuda_social_'+window.idfichaJugador+'').val();
        detalle_ayuda_social = $('#modal_detalle_ayudasocial #detalle_ayuda_social_'+window.idfichaJugador+'').val();
        array_idtipo_ayuda = $('#modal_detalle_ayudasocial input[name="array_idtipo_ayuda_'+window.idfichaJugador+'[]"]:checked').map(function(){ 
            return this.value; 
        }).get();  
        input_ayuda_otro = $('#modal_detalle_ayudasocial #input_ayuda_otro_'+window.idfichaJugador+'').val();     

    } else { // <----------- Incluir (Guardar paquete completo):
        

        idfichaJugador_form = $('#tabla_jugadores_ayuda_social input[name="array_idfichaJugador[]"]').map(function(){ 
            return $(this).val();
        }).get(); 
        // console.log( idfichaJugador );

        fecha_ayuda_social = $('#tabla_jugadores_ayuda_social input[name="fecha_ayuda_social[]"]').map(function(){ 
            return $(this).val(); 
        }).get(); 
        // console.log( fecha_ayuda_social );

        monto_ayuda_social = $('#tabla_jugadores_ayuda_social input[name="monto_ayuda_social[]"]').map(function(){ 
            return $(this).val();  
        }).get();    
        // console.log( monto_ayuda_social );     

        detalle_ayuda_social = $('#tabla_jugadores_ayuda_social input[name="detalle_ayuda_modal_hidde_form[]"]').map(function(){ 
            return $(this).val();  
        }).get();  
        // console.log( detalle_ayuda_social );


        array_idtipo_ayuda = [];
        $('#tabla_jugadores_ayuda_social ul[class="dropdown-menu"]').each(function(i){
            let array_idtipo_ayuda_xjugador = $(this).find('input[name="array_idtipo_ayuda[]"]:checked').map(function(){ 
                return $(this).val(); 
            }).get();  

            array_idtipo_ayuda[i] = array_idtipo_ayuda_xjugador;

        });

        // console.log( array_idtipo_ayuda );

        /*
        array_idtipo_ayuda = $('#tabla_jugadores_ayuda_social input[name="array_idtipo_ayuda[]"]:checked').map(function(){ 
            return $(this).val(); 
        }).get();  
        console.log( array_idtipo_ayuda );
        */

        /*
        input_ayuda_otro = []; 
        $('#tabla_jugadores_ayuda_social ul[class="dropdown-menu"]').each(function(i){
            let input_ayuda_otro_xjugador = $(this).find('input[name="input_ayuda_otro[]"]').map(function(){ 
                return $(this).val(); 
            }).get();  
            input_ayuda_otro[i] = input_ayuda_otro_xjugador;
        }); 
        */  


        input_ayuda_otro = $('#tabla_jugadores_ayuda_social ul[class="dropdown-menu"] input[name="input_ayuda_otro[]"]').map(function(){ 
            return $(this).val();  
        }).get();  


        // console.log( input_ayuda_otro );          

    }

    var data = {
        'idinforme_ayuda_social': window.idinforme_ayuda_social,
        'idfichaJugador': idfichaJugador_form,
        'fecha_ayuda_social': fecha_ayuda_social,
        'monto_ayuda_social': monto_ayuda_social,
        'detalle_ayuda_social': detalle_ayuda_social,
        'array_idtipo_ayuda': array_idtipo_ayuda,
        'input_ayuda_otro': input_ayuda_otro,
        'nombre_usuario_software': '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>'
    };

    // alert(JSON.stringify(data));
    $.ajax({
        url: "post/ffch_ayuda_social_guardar.php",
        type: "post",
        data: data,
        dataType: 'json',
        cache: false,
        success: function(respuesta){
            // alert(respuesta);
            if(respuesta==1){
                $('#mensaje_agregar_DescargarBoleta').html('<h4>Registro ingresado correctamente!</h4>');
                $('#modal_detalle_ayudasocial').modal('hide');
                $('#buscar_jugadores_ayuda_social').val('');
                cargarJugadores();
                /*
                $("#cuadro_formulario_guardar").hide(500);
                $("#cuadro_perfil_jugador_selected").show(500);
                */
                $('#myModalDescargarBoleta').modal('hide');

            }else if(respuesta==2){
                $('#mensaje_agregar_DescargarBoleta').html('<h4>Registro editado correctamente!</h4>');
                $('#modal_detalle_ayudasocial').modal('hide');
                buscar_ayudas_sociales_jugador();
               /*
                $("#cuadro_formulario_guardar").hide(500);
                $("#cuadro_perfil_jugador_selected").show(500);
               */
                $('#myModalDescargarBoleta').modal('hide');
            }
            else{ // respuesta==4
                $('#mensaje_agregar_DescargarBoleta').html('<h5>Ha ocurrido un error al ejecutar la consulta: '+respuesta+'.</h5><br>');
            }
            
        },error: function(){// will fire when timeout is reached
           $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
}


// -------------------------- Inicio de la función 'seleccionar_todos_tiposayuda_filtro' --------------------------- //
function seleccionar_todos_tiposayuda_filtro() {

    $('#ul_tipos_ayuda_filtro_busqueda li input[type="checkbox"]').each(function(){
        $(this).prop('checked', true);
    });

    let x = $('#ul_tipos_ayuda_filtro_busqueda li input[type="checkbox"]:checked').map(function(){
        return $(this).val();
    }).get();    

    let cantidad_ayudas_seleccionadas = x.length;
    let descripcion;
    if( cantidad_ayudas_seleccionadas === 0 ) {
        descripcion = 'Seleccione tipos de ayuda';
    } else {
        descripcion = cantidad_ayudas_seleccionadas + ' Elementos selec';
    }

    $('#ul_tipos_ayuda_filtro_busqueda').siblings().find('.titulo_multi').html(descripcion);

}
// -------------------------- Fin de la función 'seleccionar_todos_tiposayuda_filtro' --------------------------- //


    function seleccionSerie (seleccion) {
        
        let serie = seleccion.substring(0, seleccion.indexOf('_'));
        let sexo = seleccion.split("_").pop();

        // alert( 'Serie: ' + serie + '; Sexo: ' + sexo );

        window.id_seleccion = seleccion;

        ////////////////////////////////////////////////////////////
        let nombre_seleccion_titulo = seriesV2[window.id_seleccion];

        
        $("#tabla_ver_informes_todos tbody").empty(); // Vaciando la tabla.

        // alert( sexo  + " - " + serie + " - " + numero_serie );
        $('#cuadro_listado_series').hide(500);
        $('#cuadro_serie_selected').show(500);
        // $('.cuadro_buscar_buscar').show(500);
        // $('.cuadro_buscar_titulo').show(500);
        // $("#tabla_verEjercicios tbody").empty();
        /*
        let sexo = $(this).attr("sexo");
        let serie = $(this).attr("serie");
        let numero_serie = $(this).attr("numero-serie");
        let tecnico = $(this).attr("tecnico");
        */
        $(".titulo_serie").html( nombre_seleccion_titulo );
        $(".sexo").val( sexo );

        let sexo_seleccion = '';
        if( sexo == '1' ) {
            sexo_seleccion = 'Masculina';
        } else {
            sexo_seleccion = 'Femenina';
        }

        $(".sexo_seleccion").html( sexo_seleccion );
        
        $(".numero_serie").val( serie );
        // $(".tecnico").val( tecnico );

        get_anio_mes_filtro(); 
        buscar_clubes_todos(); // <--- Consultando todos los clubes 
        buscar_tipos_ayuda_social(); // <--- Consultando todos los tipos de ayuda
        buscador(); // <--- Ejecutando la función 'buscador()' 
        cargar_graficas(); // <--- Cargando gráficas
        
    }

    // -------------------- Inicio de la función 'get_anio_mes_filtro()' ------------------------- //
    function get_anio_mes_filtro() {
        // Vaciando selects:
        $("#anio_filtro_busqueda").empty();

        // Agregando años al select #anio_filtro_busqueda:
        var year = 2018;
        var current_year = "<?php echo $ano_actual; ?>";
        current_year = parseInt( current_year );   
        while( year <= current_year ) {
            $("#anio_filtro_busqueda").append('<option value="'+year+'">'+year+'</option>');
            year++;
        }

        $("#anio_filtro_busqueda option").each(function(){
            let thisElement = $(this);
            let thisValue = thisElement.val();
            // alert( current_month );
            thisValue = parseInt( thisValue );
            if( thisValue === current_year ) {
                thisElement.prop("selected", true);
            }
        });

        // Agregando meses al select #mes_filtro_busqueda:
        var current_month = "<?php echo date('m'); ?>";

        current_month = parseInt( current_month );
        $("#mes_filtro_busqueda option").each(function(){
            let thisElement = $(this);
            let thisValue = thisElement.val();
            // alert( current_month );
            thisValue = parseInt( thisValue );
            if( thisValue === current_month ) {
                thisElement.prop("selected", true);
            }
        });        
    }
    // -------------------- Fin de la función 'get_anio_mes_filtro()' ------------------------- //

    // -------------------- Inicio de la función 'buscador()' ------------------------- //
    function buscador() {

        var string = $("#buscar_nombre").val();
        $('#error_conexion').hide();
        $('#sin_resultados').hide();
        $('#cargando_buscar').show();
     
        var sexo = $(".sexo").val();
        var numero_serie = $(".numero_serie").val();

        var anio_filtro_busqueda = $("#anio_filtro_busqueda").val();
        var mes_filtro_busqueda = $("#mes_filtro_busqueda").val();
        var idclub_filtro_busqueda = $("#idclub_filtro_busqueda").val();
        var tipoayuda_filtro_busqueda = $("input[name='tipoayuda_filtro_busqueda[]']:checked").map(function(){ 
            return this.value; 
        }).get();

        if( tipoayuda_filtro_busqueda.length === 0 ) {
            tipoayuda_filtro_busqueda = 0;
        }

        // console.log( tipoayuda_filtro_busqueda );

        /*
        array_idtipo_ayuda = $('#modal_detalle_ayudasocial input[name="array_idtipo_ayuda_'+window.idfichaJugador+'[]"]:checked').map(function(){ 
            return this.value; 
        }).get(); 
        */ 
        

        $.ajax({
            url: "post/ffch_ayuda_social_ver.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
                'tipo_consulta': 'get_jug_ultima_ayudasocial_sexoserie',
                'string': string,
                'sexo': sexo,
                'numero_serie': numero_serie,
                'anio_filtro_busqueda': anio_filtro_busqueda,
                'mes_filtro_busqueda': mes_filtro_busqueda,
                'idclub_filtro_busqueda': idclub_filtro_busqueda,
                'tipoayuda_filtro_busqueda': tipoayuda_filtro_busqueda                       
        },success: function(respuesta){

            var tecnico = $('.tecnico').val();
            // alert( tecnico );
            // alert(JSON.stringify(respuesta));
            if(respuesta== ""){ //jugador sin informes
                $("#tabla_ver_informes_todos tbody").empty();
                var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555;" id="informe_"><td colspan="10"><b>No se encontraron jugadores que han recibido ayuda social</b></td></tr>';
                $("#tabla_ver_informes_todos tbody").append(markup);
                $("#graficos_informes_resumen").hide();
                $('#cargando_buscar').hide();
                $('#sin_resultados').show();
                $('#boton_editar').hide();
                $('.boton_refresh').hide();
                $('#boton_agregar_informe_carga').prop("disabled", true);
            }else{              
                window.datos_ultima_ayuda_social = respuesta; //se copian todos los profesores al cache
                $("#tabla_ver_informes_todos tbody").empty();
                let tr_line = '\
                <tr style="background-color:#eee; height:1px;">\
                    <td colspan="10"></td>\
                </tr>\
                ';
                $("#tabla_ver_informes_todos tbody").append( tr_line );

                var count = 1;
                for(var i=0; i < respuesta.length; i++){

                    let nombre_posicion;
                    let posicion0 = respuesta[i]['posicion0'];
                    if( posicion0 === null || posicion0 == '' || posicion0 == '0' || posicion0 == '999' ) {
                        nombre_posicion = 'No especificado';
                    } else {
                        nombre_posicion = array_posiciones[posicion0][1];
                    }
                    let num_grupo_posicion = array_posiciones[posicion0][2];
                    let nombre_grupo_posicion = array_posiciones[posicion0][3]; 
                                        
                    if( respuesta[i]['apellido2'] === null ) {
                        respuesta[i]['apellido2'] = "";
                    }  
                    
                    let idfichaJugador = respuesta[i]['idfichaJugador'];
                    // Nombre completo del jugador:
                    let nombre_completo_jugador = respuesta[i]['nombre'] + ' ' + respuesta[i]['apellido1'] + ' ' + respuesta[i]['apellido2'];
                                                    
                    let rut = respuesta[i]['rut'];
                    if( rut === null || rut == '' || rut == '0' ) {
                        rut = '-';
                    }

                    let idclub = respuesta[i]['idclub'];
                    let nombre_club = respuesta[i]['nombre_club'];

                    let descripcion_fecha_ayuda_social;
                    if( typeof respuesta[i]['fecha_ayuda_social'] === "undefined" || respuesta[i]['fecha_ayuda_social'] == '0000-00-00' || respuesta[i]['fecha_ayuda_social'] == '' || respuesta[i]['fecha_ayuda_social'] === null ) {
                        descripcion_fecha_ayuda_social = '-';
                    } else {
                        let fecha_ayuda_social = fecha_formato_ddmmaaa( respuesta[i]['fecha_ayuda_social'] );
                        let fecha_ayuda_social_slash = fecha_date_js( respuesta[i]['fecha_ayuda_social'] );
                        let fecha_actual = getCurrentDate();                              
                        // Diferencia en tiempo: 
                        let diferencia_time = fecha_actual.getTime() - fecha_ayuda_social_slash.getTime(); 
                        // Diferencia en días: 
                        let oneDay = 24 * 60 * 60 * 1000; //
                        let diferencia_dias = Math.round(Math.abs((fecha_ayuda_social_slash - fecha_actual) / oneDay));
                        

                        // alert(fecha_ayuda_social_slash);
                        if( diferencia_dias < 0 ) {
                            diferencia_dias = 0;
                        }

                        descripcion_fecha_ayuda_social = fecha_ayuda_social + ' <b>(Hace '+diferencia_dias+' días)</b>';
                    }                    

                    let monto_ayuda_social;
                    if( typeof respuesta[i]['monto_ayuda_social'] === 'undefined' || respuesta[i]['monto_ayuda_social'] === null || respuesta[i]['monto_ayuda_social'] == '' ) {
                        monto_ayuda_social = '-';
                    } else {    
                        monto_ayuda_social = '$' + respuesta[i]['monto_ayuda_social'];
                    }  

                    let lista_tipos_ayuda;
                    if( respuesta[i]['array_tipos_ayuda'] != null ) {
                        console.log( respuesta[i]['array_tipos_ayuda'] );
                        if( respuesta[i]['array_tipos_ayuda'] != '' ) {
                            lista_tipos_ayuda = respuesta[i]['array_tipos_ayuda'].join(", ");
                        } else {
                            lista_tipos_ayuda = '-';
                        }
                        
                    } else {
                        lista_tipos_ayuda = 'No especificado';
                    }

                    let cantidad_informes;
                    if( respuesta[i]['cantidad_informes_ayuda_social'] == '0' ) {
                        cantidad_informes = '(0) informes';
                    } else {
                        cantidad_informes = '('+respuesta[i]['cantidad_informes_ayuda_social']+') informes';
                    }

                    var markup = 
                    '<tr class="panel_buscar tr_posicion_jugador_'+posicion0+'" num-grupo-posicion="'+num_grupo_posicion+'" nombre-grupo-posicion="'+nombre_grupo_posicion+'">\
                        <td onClick="boton_ver_perfil_jugador('+i+');" style="font-weight:bold;"><b>'+count+'</b>\
                        </td>\
                        <td onClick="boton_ver_perfil_jugador('+i+');" style="text-align: left;">\
                            <div style="max-width: 130px; text-align: left;">\
                                <div><p class="ellipsis-text">'+nombre_posicion+'</p></div>\
                            </div>\
                        </td>\
                        <td onClick="boton_ver_perfil_jugador('+i+');" style="text-align: left;">\
                            <div class="img-next-to-text" style="width:25px;">\
                                <img src="foto_jugadores/'+idfichaJugador+'.png" class="imagen-jugador" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;">\
                            </div>\
                            <div style="max-width: 300px;">\
                                <p class="ellipsis-text" style="position: relative; top: 3px; left: 7px;">' + nombre_completo_jugador + '</p>\
                            </div>\
                        </td>\
                        <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                            <div><p class="ellipsis-text">'+rut+'</p></div>\
                        </td>\
                        <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                            <div class="img-next-to-text" style="width:25px;">\
                                <img src="foto_clubes/'+idclub+'.png" class="imagen-jugador" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;">\
                            </div>\
                            <div style="max-width: 300px;">\
                                <p class="ellipsis-text" style="position: relative; top: 3px; left: 7px; text-align: left;">' + nombre_club + '</p>\
                            </div>\
                        </td>\
                        <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                             <div style="max-width: 130px; text-align: center;">\
                                <div><p class="ellipsis-text">'+descripcion_fecha_ayuda_social+'</p></div>\
                            </div>\
                        </td>\
                        <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                             <div style="max-width: 130px; text-align: center;">\
                                <div><p class="ellipsis-text">'+monto_ayuda_social+'</p></div>\
                            </div>\
                        </td>\
                        <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                            <div style="max-width: 120px; text-align: center;">\
                                <p class="ellipsis-text">'+lista_tipos_ayuda+'</p>\
                            </div>\
                        </td>\
                        <td onClick="boton_modal_detalle_ayudasocial('+i+', 2);" style="padding: 7px;">\
                            <i style="font-size: 27px;" class="icon-shopping-cart"></i>\
                        </td>\
                        <td onClick="boton_ver_perfil_jugador('+i+');" style="padding: 7px;">\
                            <i class="icon-paper-clip"></i> <b>'+cantidad_informes+'</b>\
                        </td>\
                    </tr>';

                    $("#tabla_ver_informes_todos tbody").append( markup );

                    count = count + 1;
                }

                let contador = 1;
                $("#tabla_ver_informes_todos tbody .panel_buscar").each(function(){
                    $(this).find('td').eq(0).text( contador );
                    contador++;
                });


                $("#tabla_ver_informes_todos tbody tr").each(function(){

                    let num_grupo_posicion = $(this).attr('num-grupo-posicion');
                    let nombre_grupo_posicion = $(this).attr('nombre-grupo-posicion');

                    if( typeof num_grupo_posicion !== 'undefined' ) {

                        let class_tr_posicion = "tr_posicion_" + num_grupo_posicion;
                        let class_id_posicion = num_grupo_posicion;
                        let tr_posicion = '\
                        <tr id="'+class_id_posicion+'" class="'+class_tr_posicion+'" style="text-align: left; background-color:#555555; cursor:pointer; color:white;">\
                            <td colspan="10">\
                                <b style="text-transform: uppercase; font-size: 11px; padding-left: 40px;">'+nombre_grupo_posicion+'</b>\
                            </td>\
                        </tr>\
                        ';

                        let class_tr_jquery = '.' + class_tr_posicion;

                        if( $(class_tr_jquery).length === 0 ) {
                            // $(tr_posicion).before( $(this) );     
                             $( tr_posicion ).insertBefore( $(this) );        
                        }

                    }

                });                

                // Agregando línea azul en la última tr de las siguientes posiciones:
                let blue_line_color = '1px #0948a4 solid';

                // Defensa Central (Posición Nº 2):
                $('#tabla_ver_informes_todos tbody tr.tr_posicion_jugador_2:last').css('border-bottom', blue_line_color);

                // Lateral Izquierdo (Posición Nº 3):
                $('#tabla_ver_informes_todos tbody tr.tr_posicion_jugador_3:last').css('border-bottom', blue_line_color);   

                // Lateral Derecho (Posición Nº 4):
                // $('#tabla_ver_informes_todos tbody tr.tr_posicion_jugador_4:last').css('border-bottom', '2px '+blue_line_color+' solid');     

                // Volante Defensivo (Posición Nº 5):
                $('#tabla_ver_informes_todos tbody tr.tr_posicion_jugador_5:last').css('border-bottom', blue_line_color);

                // Volante Izquierdo (Posición Nº 6):
                $('#tabla_ver_informes_todos tbody tr.tr_posicion_jugador_6:last').css('border-bottom', blue_line_color);

                // Volante Derecho (Posición Nº 7):
                $('#tabla_ver_informes_todos tbody tr.tr_posicion_jugador_7:last').css('border-bottom', blue_line_color);                                                                                
                // Volante Mixto (Posición Nº 8):
                $('#tabla_ver_informes_todos tbody tr.tr_posicion_jugador_8:last').css('border-bottom', blue_line_color);

                // Volante Ofensivo (Posición Nº 9):
                // $('#tabla_ver_informes_todos tbody tr.tr_posicion_jugador_9:last').css('border-bottom', '2px '+blue_line_color+' solid');

                // Extremo Izquierdo (Posición Nº 10):
                $('#tabla_ver_informes_todos tbody tr.tr_posicion_jugador_10:last').css('border-bottom', blue_line_color); 

                // Extremo Derecho (Posición Nº 11):
                $('#tabla_ver_informes_todos tbody tr.tr_posicion_jugador_11:last').css('border-bottom', blue_line_color);

                // Delantero Centro (Posición Nº 12):
                // $('#tabla_ver_informes_todos tbody tr.tr_posicion_jugador_12:last').css('border-bottom', '2px '+blue_line_color+' solid');   

                $('#boton_agregar').show();
                $('.boton_refresh').hide();
            } 
            $('#cargando_buscar').hide();
            $('#error_conexion').hide();
            $('#sin_resultados').hide();
            
        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
                $('.boton_refresh').show();
            }, timeout: 15000 // sets timeout to 3 seconds
        });
    }
    // -------------------- Fin de la función 'buscador()' ------------------------- //

    // -------------------- Inicio de la función 'cargar_graficas()' ------------------------- //
    function cargar_graficas() {
        $('#error_conexion').hide();
        $('#sin_resultados').hide();
        $('#cargando_buscar').show();

        buscador();
     
        var anio = $('#anio_filtro_busqueda').val();
        var sexo = $(".sexo").val();
        var numero_serie = $(".numero_serie").val();

        $.ajax({
            url: "post/ffch_ayuda_social_ver.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
                'tipo_consulta': 'cargar_graficas',
                'sexo': sexo,
                'numero_serie': numero_serie,
                'anio': anio,        
        },success: function(respuesta){

            // Traduciendo gráficas al español:
            Highcharts.setOptions({
                lang: {
                    loading: 'Cargando...',
                    months: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
                    weekdays: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                    shortMonths: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                    exportButtonTitle: "Exportar",
                    printButtonTitle: "Importar",
                    rangeSelectorFrom: "Desde",
                    rangeSelectorTo: "Hasta",
                    rangeSelectorZoom: "Período",
                    downloadCSV: 'Descargar imagen CSV',
                    downloadJPEG: 'Descargar imagen JPEG', 
                    downloadPDF: 'Descargar documento PDF',
                    downloadPNG: 'Descargar imagen PNG', 
                    downloadSVG: 'Descargar imagen SVG',
                    downloadXLS: 'Descargar XLS',
                    printChart: 'Imprimir',
                    resetZoom: 'Reiniciar zoom',
                    resetZoomTitle: 'Reiniciar zoom',
                    thousandsSep: ",",
                    decimalPoint: '.',
                    viewFullscreen: 'Ver pantalla completa',
                    exitFullscreen: 'Salir de pantalla completa',
                    viewData: 'Visualizar tabla'
                }        
            });

            var tecnico = $('.tecnico').val();
            // alert( tecnico );
            // alert(JSON.stringify(respuesta));
            if(respuesta== "") { //jugador sin informes
                /*
                $("#tabla_ver_informes_todos tbody").empty();
                var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555;" id="informe_"><td colspan="10"><b>No se encontraron jugadores que han recibido ayuda social</b></td></tr>';
                $("#tabla_ver_informes_todos tbody").append(markup);
                $("#graficos_informes_resumen").hide();
                $('#cargando_buscar').hide();
                $('#sin_resultados').show();
                $('#boton_editar').hide();
                $('.boton_refresh').hide();
                */

                // ----------------------- Inicio de las funciones que muestran las gráficas ----------------------- //
                // ======================== Inicio de gráfica para Montos entregados en ayuda social ======================== //
                var chart_montos_entregados = Highcharts.chart('chart-montos-entregados', {
                    chart: {
                        type: 'column',
                        backgroundColor:null
                    },
                    title: {
                        text: 'Montos entregados en ayuda social'
                    },
                    subtitle: {
                        text: null
                    },
                    xAxis: {
                        type: 'category',
                        labels: {
                            rotation: -45,
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Monto (CLP)'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                        pointFormat: 'Monto entregado: $<b>{point.y:.0f} pesos</b>'
                    },
                    series: [{
                        name: 'Mes',
                        color:'#FF5454',
                        data: [
                            /*
                            ['Enero', 24200],
                            ['Febrero', 20800],
                            ['Marzo', 149000],
                            ['Abril', 137000],
                            ['Mayo', 131000],
                            ['Junio', 127000],
                            ['Julio', 124000],
                            ['Agosto', 122000],
                            ['Septiembre', 120000],
                            ['Octubre', 117000],
                            ['Noviembre', 115000],
                            ['Diciembre', 112000],
                            */
                        ],
                        dataLabels: {
                            enabled: true,
                            rotation: -90,
                            color: '#FFFFFF',
                            align: 'right',
                            format: '{point.y:.0f}', // one decimal
                            y: 10, // 10 pixels down from the top
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    }]
                });
                // ======================== Fin de gráfica para Montos entregados en ayuda social ======================== //

                // ======================== Inicio de gráfica para Club de origen de los jugadores que han recibido ayuda social ======================== //
                // Build the chart
                var chart_club_origen_jugadores = Highcharts.chart('chart-club-origen-jugadores', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie',
                        backgroundColor:null
                    },
                    title: {
                        text: 'Club de origen de los jugadores que han recibido ayuda social'
                    },
                    tooltip: {
                        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                        shared: true
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Jugadores que han recibido la ayuda',
                        colorByPoint: true,
                        data: [
                            /*
                            {
                                name: 'Colo Colo',
                                y: 80,
                                sliced: true,
                                selected: true
                            }, {
                                name: 'Universidad de Chile',
                                y: 13
                            }, {
                                name: 'Santiago Wanderers',
                                y: 43        }, {
                                name: 'Audax Italiano',
                                y: 3
                            }, {
                                name: 'Universidad de Concepcion',
                                y:3
                            }, {
                                name: 'Union la Calera',
                                y: 3
                            }
                            */
                        ]
                    }]
                });        
                // ======================== Fin de gráfica para Club de origen de los jugadores que han recibido ayuda social ======================== //

                // ======================== Inicio de gráfica para Montos entregados en ayuda social por jugador ======================== //
                var chart_montos_entregados_xjugador = Highcharts.chart('chart-montos-entregados-xjugador', {
                    chart: {
                        type: 'column',
                        backgroundColor:null
                    },
                    title: {
                        text: 'Montos entregados en ayuda social por jugador'
                    },
                    subtitle: {
                        text: null
                    },
                    xAxis: {
                        type: 'category',
                        labels: {
                            rotation: -45,
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Monto (CLP)'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                        pointFormat: 'Monto entregado : $<b>{point.y:.0f} pesos</b>'
                    },
                    series: [{
                        name: 'Mes',
                        color:'#3D8BD5',
                        data: [
                            /*
                            ['Julian Perez', 442500],
                            ['Alexis Sanchez', 760800],
                            ['Marco Asensio', 649000],
                            ['Julio Garcia', 137000],
                            ['Felipe Vasquez', 131000],
                            ['Jorge Valdivia', 127000],
                            ['Gonzalo Jara', 124000],
                            ['Damian Gonzalez', 122000],
                            ['Pedro Porro', 120000],
                            ['Gaston Pereo', 317000],
                            ['Camilo Garces', 215000],
                            ['Gary Medel', 712000],
                            */
                            
                        ],
                        dataLabels: {
                            enabled: true,
                            rotation: -90,
                            color: '#FFFFFF',
                            align: 'right',
                            format: '{point.y:.0f}', // one decimal
                            y: 10, // 10 pixels down from the top
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    }]
                });        
                // ======================== Fin de gráfica para Montos entregados en ayuda social por jugador ======================== //

                // ======================== Inicio de gráfica para Montos entregados en ayuda social por jugador ======================== //
                var chart_monto_entregado_segun_club = Highcharts.chart('chart-monto-entregado-segun-club', {
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 45,
                            beta: 0
                        }
                    },
                    title: {
                        text: 'Monto entregado segun club de origen del jugador'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    tooltip: {
                        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                        shared: true
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            depth: 35,
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}'
                            }
                        }
                    },
                    series: [{
                        type: 'pie',
                          name: 'Monto total entregado a jugadores del club',
                        data: [
                            /*
                            ['Colo Colo', 450000],
                            ['Universidad de Chile', 268000],
                            {
                                name: 'Santiago Wanderers',
                                y: 128000,
                                sliced: true,
                                selected: true
                            },
                            ['Union la Calera', 850000],
                            ['Everton', 620000],
                            ['Rangers', 70000]
                            */
                        ]
                    }]
                });        
                // ======================== Fin de gráfica para Montos entregados en ayuda social por jugador ======================== //

                // ----------------------- Fin de las funciones que muestran las gráficas ----------------------- //

                // Expandiendo al 100% el ancho los gráficos: 
                window.setTimeout(function(){
                    $(window).trigger('resize');
                    chart_montos_entregados.reflow();
                    chart_club_origen_jugadores.reflow();
                    chart_montos_entregados_xjugador.reflow();
                    chart_monto_entregado_segun_club.reflow(); 
                }, 500);                

            } else {              

                // ---------------------------- Datos para gráfica de Montos entregados en ayuda social ---------------------------- //
                let array_montos_entregados = [];
                let array_montos_mes_suma = respuesta[0];
                let array_mes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];

                for( let i = 0; i < array_montos_mes_suma.length; i++ ) {
                    let monto = array_montos_mes_suma[i];
                    let mes = array_mes[i];
                    // console.log( 'Mes: ' + mes + ' - ' + 'Monto: ' + monto );    
                    array_montos_entregados[i] = [mes, monto];
                }

                // ---------------------------- Datos para gráfica de Club de origen de los jugadores que han recibido ayuda social ---------------------------- //
                let array_chart_club_origen = [];
                let array_club_origen = respuesta[1];
                let array_cantidad_jugadores_total_club = respuesta[2];

                for( let i = 0; i < array_club_origen.length; i++ ) {
                    let club = array_club_origen[i];
                    let cantidad_jugadores_total_club = parseInt( array_cantidad_jugadores_total_club[i] );
                    console.log( 'Club: ' + club + ' - ' + 'Cantidad: ' + cantidad_jugadores_total_club );    

                    if( i === 0 ) {

                        array_chart_club_origen[i] = {
                            name: club,
                            y: cantidad_jugadores_total_club,
                            sliced: true,
                            selected: true
                        };

                    } else {

                        array_chart_club_origen[i] = {
                            name: club,
                            y: cantidad_jugadores_total_club
                        }                        

                    }

                }                

                // ---------------------------- Datos para gráfica de Montos entregados en ayuda social por jugador ---------------------------- //
                let array_chart_ayuda_xjugador = [];
                let array_nombre_jugador = respuesta[3]; 
                let array_montos_jugador_suma = respuesta[4];
                for( let i = 0; i < array_montos_jugador_suma.length; i++ ) {
                    let nombre_jugador = array_nombre_jugador[i];
                    let monto_jugador_suma = parseInt( array_montos_jugador_suma[i] );
                    console.log( 'Jugador: ' + nombre_jugador + ' - ' + 'Monto total de ayuda: ' + monto_jugador_suma );    
                    array_chart_ayuda_xjugador[i] = [nombre_jugador, monto_jugador_suma];
                }

                // ---------------------------- Datos para gráfica de Monto entregado según club de origen del jugador ---------------------------- //
                let array_chart_monto_entregado_segun_club = [];
                let array_nombre_club = respuesta[5]; 
                let array_montos_club_suma = respuesta[6];
                for( let i = 0; i < array_montos_club_suma.length; i++ ) {
                    let nombre_club = array_nombre_club[i];
                    let monto_club_suma = parseInt( array_montos_club_suma[i] );  
                    console.log( 'Nombre del Club: ' + nombre_club + ' - ' + 'Monto total de ayuda al club: ' + monto_club_suma );      

                    if( i === 2 ) {
                        
                        array_chart_monto_entregado_segun_club[i] = {
                                name: nombre_club,
                                y: monto_club_suma,
                                sliced: true,
                                selected: true
                        };

                    } else {
                        array_chart_monto_entregado_segun_club[i] = [nombre_club, monto_club_suma];
                    }

                }


                // ----------------------- Inicio de las funciones que muestran las gráficas ----------------------- //
                // ======================== Inicio de gráfica para Montos entregados en ayuda social ======================== //
                var chart_montos_entregados = Highcharts.chart('chart-montos-entregados', {
                    chart: {
                        type: 'column',
                        backgroundColor:null
                    },
                    title: {
                        text: 'Montos entregados en ayuda social'
                    },
                    subtitle: {
                        text: null
                    },
                    xAxis: {
                        type: 'category',
                        labels: {
                            rotation: -45,
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Monto (CLP)'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                        pointFormat: 'Monto entregado: $<b>{point.y:.0f} pesos</b>'
                    },
                    series: [{
                        name: 'Mes',
                        color:'#FF5454',
                        data: array_montos_entregados,
                        dataLabels: {
                            enabled: true,
                            rotation: -90,
                            color: '#FFFFFF',
                            align: 'right',
                            format: '{point.y:.0f}', // one decimal
                            y: 10, // 10 pixels down from the top
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    }]
                });
                // ======================== Fin de gráfica para Montos entregados en ayuda social ======================== //

                // ======================== Inicio de gráfica para Club de origen de los jugadores que han recibido ayuda social ======================== //
                // Build the chart
                var chart_club_origen_jugadores = Highcharts.chart('chart-club-origen-jugadores', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie',
                        backgroundColor:null
                    },
                    title: {
                        text: 'Club de origen de los jugadores que han recibido ayuda social'
                    },
                    tooltip: {
                        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                        shared: true
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Jugadores que han recibido la ayuda',
                        colorByPoint: true,
                        data: array_chart_club_origen
                    }]
                });        
                // ======================== Fin de gráfica para Club de origen de los jugadores que han recibido ayuda social ======================== //

                // ======================== Inicio de gráfica para Montos entregados en ayuda social por jugador ======================== //
                var chart_montos_entregados_xjugador = Highcharts.chart('chart-montos-entregados-xjugador', {
                    chart: {
                        type: 'column',
                        backgroundColor:null
                    },
                    title: {
                        text: 'Montos entregados en ayuda social por jugador'
                    },
                    subtitle: {
                        text: null
                    },
                    xAxis: {
                        type: 'category',
                        labels: {
                            rotation: -45,
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Monto (CLP)'
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    tooltip: {
                        pointFormat: 'Monto entregado : $<b>{point.y:.0f} pesos</b>'
                    },
                    series: [{
                        name: 'Mes',
                        color:'#3D8BD5',
                        data: array_chart_ayuda_xjugador,
                        dataLabels: {
                            enabled: true,
                            rotation: -90,
                            color: '#FFFFFF',
                            align: 'right',
                            format: '{point.y:.0f}', // one decimal
                            y: 10, // 10 pixels down from the top
                            style: {
                                fontSize: '13px',
                                fontFamily: 'Verdana, sans-serif'
                            }
                        }
                    }]
                });        
                // ======================== Fin de gráfica para Montos entregados en ayuda social por jugador ======================== //

                // ======================== Inicio de gráfica para Montos entregados en ayuda social por jugador ======================== //
                var chart_monto_entregado_segun_club = Highcharts.chart('chart-monto-entregado-segun-club', {
                    chart: {
                        type: 'pie',
                        options3d: {
                            enabled: true,
                            alpha: 45,
                            beta: 0
                        },
                        backgroundColor: 'transparent',
                    },
                    title: {
                        text: 'Monto entregado segun club de origen del jugador'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    tooltip: {
                        pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                        shared: true
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            depth: 35,
                            dataLabels: {
                                enabled: true,
                                format: '{point.name}'
                            }
                        }
                    },
                    series: [{
                        type: 'pie',
                          name: 'Monto total entregado a jugadores del club',
                        data: array_chart_monto_entregado_segun_club
                    }]
                });        
                // ======================== Fin de gráfica para Montos entregados en ayuda social por jugador ======================== //

                // ----------------------- Fin de las funciones que muestran las gráficas ----------------------- //

                // Expandiendo al 100% el ancho los gráficos: 
                window.setTimeout(function(){
                    $(window).trigger('resize');
                    chart_montos_entregados.reflow();
                    chart_club_origen_jugadores.reflow();
                    chart_montos_entregados_xjugador.reflow();
                    chart_monto_entregado_segun_club.reflow(); 
                }, 500);


                $('#boton_agregar').show();
                $('.boton_refresh').hide();
            } 
            $('#cargando_buscar').hide();
            $('#error_conexion').hide();
            $('#sin_resultados').hide();
            
        },error: function() {// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
             $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
        });
    }
    // -------------------- Fin de la función 'cargar_graficas()' ------------------------- //    

function boton_ir_gestion_ayuda_social() {
    window.idinforme_ayuda_social = '';
    window.estatus_editar = 0;

    $('#cuadro_serie_selected').hide(500);
    $('#cuadro_gestion_ayudas_sociales').show(500);
    cargarJugadores(); // <--- Consultando jugadores
    $('#btn_marcar_jugadores').html('<i class="icon-check"></i> Marcar todos');
    $("#tabla_jugadores_ayuda_social tbody").empty(); // <--- Vaciando tabla.
    $("#tabla_jugadores_ayuda_social").hide(); // <--- Ocultando tabla.
}

function boton_volver_de_gestion_ayuda_social() {
    $("#tabla_ver_informes_todos tbody").empty(); // <--- Vaciando tabla.
    $('#cuadro_gestion_ayudas_sociales').hide(500);
    $('#cuadro_serie_selected').show(500);
    get_anio_mes_filtro();
    buscar_clubes_todos(); // <--- Consultando todos los clubes
    buscar_tipos_ayuda_social() // <--- Consultando todos los tipos de ayuda
    buscador();
    cargar_graficas();
}

function boton_volver_cuadro_listado_series() {
    $('#cuadro_serie_selected').hide(500);
    $('#cuadro_listado_series').show(500);
    get_informes_por_serie();
    $('.cuadro_buscar_buscar').show(500);
    $('.cuadro_buscar_titulo').show(500);
    $("#tabla_verEjercicios tbody").empty();
}

function boton_volver_serie_selected_registro_cargas_diarias() {
    $("#tabla_ver_informes_todos tbody").empty(); // <--- Vaciando tabla.
    $('#cuadro_perfil_jugador_selected').hide(500);
    $('#cuadro_serie_selected').show(500);
    get_anio_mes_filtro();
    buscar_clubes_todos(); // <--- Consultando todos los clubes
    buscar_tipos_ayuda_social() // <--- Consultando todos los tipos de ayuda
    buscador();
    cargar_graficas();
}


function boton_volver_perfil_jugador_selected() {
    $("#tabla_ver_ayudas_sociales_jugador tbody").empty(); // <--- Vaciando tabla.
    $('#cuadro_formulario_guardar').hide(500);
    $('#cuadro_perfil_jugador_selected').show(500);
    buscar_ayudas_sociales_jugador(); // <--- Modificación hecha el 28-02-2020.
}


function volver_despues_guardado() {
    $('#cuadro_formulario_guardar').hide(500);
    $('#cuadro_serie_selected').show(500);
    buscar_clubes_todos(); // <--- Consultando todos los clubes
    buscar_tipos_ayuda_social() // <--- Consultando todos los tipos de ayuda
    buscador();
    cargar_graficas();
}


function volver_despues_eliminacion() {
    buscar_ayudas_sociales_jugador();
}

// --------------------------------------- Inicio de la función chequear_datos_form_incluir() --------------------------------------- //
function chequear_datos_form_incluir() {
    
    var ER_numericosDecimales = /^[0-9]+([,.][0-9]+)?$/g;
    // var ER_numericosDecimales = /^([0-9]*|(\d+))((.|,)\d{1,})?$/;
    var ER_numericosEnteros = /[0-9]/;
    var ER_caracteresAlfaNumericos = /^[a-zA-ZáàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜñÑ 0-9,.-_¿?¡!$%#()]*$/;
    flag = true;

    /*
    // --------- Validando los inputs cuyos atributos 'name' son monto_ayuda_social[] 
    let array_idtipo_ayuda = $('#tabla_jugadores_ayuda_social input[name="array_idtipo_ayuda[]"]:checked').map(function(){ 
        return this.value; 
    }).get();  

    // Validando que al menos un tipo de ayuda sea seleccionada:
    if ( array_idtipo_ayuda.length === 0 ) {
        flag = false;
    }
    */


    // --------- Validando los inputs cuyos atributos 'name' son array_idtipo_ayuda[] 
    $('#tabla_jugadores_ayuda_social .dropdown-menu').each(function(){
        
        let array_idtipo_ayuda = $(this).find('input[name="array_idtipo_ayuda[]"]:checked').map(function(){ 
            return this.value; 
        }).get();

        // Validando que al menos un tipo de ayuda sea seleccionada:
        if ( array_idtipo_ayuda.length === 0 ) {
            flag = false;
        }          

    });    


    // --------- Validando los inputs cuyos atributos 'name' son monto_ayuda_social[] 
    $('#tabla_jugadores_ayuda_social input[name="fecha_ayuda_social[]"]').each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();

        if( thisValue == "" ) {
            thisElement.css("background-color", "#ffc6c6"); // <--- Color blanco.
            flag = false;
        } else {
            thisElement.css("background-color", "white");
        }

    });     

    // --------- Validando los inputs cuyos atributos 'name' son monto_ayuda_social[] 
    $('#tabla_jugadores_ayuda_social input[name="monto_ayuda_social[]"]').each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();

        if( thisValue != "" ) {
            if( thisValue.match(ER_numericosDecimales) && ( parseInt(thisValue.length) >= 1 ) ) {      
                thisElement.css("background-color", "white");
            } else {
                thisElement.css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            thisElement.css("background-color", "#ffc6c6");
            flag = false;
        }

    }); 

    // --------- Validando los inputs cuyos atributos 'name' son input_ayuda_otro[] 
    $('#tabla_jugadores_ayuda_social ul[class="dropdown-menu"] input[name="input_ayuda_otro[]"]').each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        
        if(thisElement.is(":visible")) {

            if( thisValue != '' ) {       
              
                if( thisValue.match(ER_caracteresAlfaNumericos) && ( parseInt(thisValue.length) >= 1 ) ) {      
                    thisElement.css("background-color", "white");
                } else {
                    thisElement.css("background-color", "#ffc6c6");
                    flag = false;
                }

            } else {
                thisElement.css("background-color", "white");
                // thisElement.css({"background-color": "white", "color": "black"});
                thisElement.addClass("black-placeholder");            
                // flag = false;
            }

        }

    }); 

    // --------- Validando los inputs cuyos atributos 'name' son detalle_ayuda_modal_hidde_form[] 
    $('#tabla_jugadores_ayuda_social input[name="detalle_ayuda_modal_hidde_form[]"]').each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue != '' ) {       
          
            if( thisValue.match(ER_caracteresAlfaNumericos) && ( parseInt(thisValue.length) >= 1 ) ) {      
                thisElement.css("background-color", "white");
            } else {
                thisElement.css("background-color", "#ffc6c6");
                flag = false;
            }

        } else {
            thisElement.css("background-color", "white");
            // thisElement.css({"background-color": "white", "color": "black"});
            thisElement.addClass("black-placeholder");            
            // flag = false;
        }
    });   


    if( flag === false ){
        $('#boton_guardar_informes_todos').prop("disabled", true);
    } else{
        $('#boton_guardar_informes_todos').prop("disabled", false);
    }

}
// --------------------------------------- Fin de la función chequear_datos_form_incluir() --------------------------------------- //

// --------------------------------------- Inicio de la función chequear_datos_form_editar() --------------------------------------- //
function chequear_datos_form_editar( idfichaJugador ) {

    // alert( idfichaJugador );

    var ER_numericosDecimales = /^[0-9]+([,.][0-9]+)?$/g;
    // var ER_numericosDecimales = /^([0-9]*|(\d+))((.|,)\d{1,})?$/;
    var ER_numericosEnteros = /[0-9]/;
    var ER_caracteresAlfaNumericos = /^[a-zA-ZáàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜñÑ 0-9,.-_¿?¡!$%#()]*$/;
    let flag = true;
        

    let fecha_ayuda_social = $('#modal_detalle_ayudasocial #fecha_ayuda_social_'+idfichaJugador+'').val();
    let monto_ayuda_social = $('#modal_detalle_ayudasocial #monto_ayuda_social_'+idfichaJugador+'').val();

    let detalle_ayuda_social = $('#modal_detalle_ayudasocial #detalle_ayuda_social_'+idfichaJugador+'').val();
    let array_idtipo_ayuda = $('#modal_detalle_ayudasocial input[name="array_idtipo_ayuda_'+idfichaJugador+'[]"]:checked').map(function(){ 
        return this.value; 
    }).get();  
    let input_ayuda_otro = $('#modal_detalle_ayudasocial #input_ayuda_otro_'+idfichaJugador+'').val(); 

    // Validando que al menos un tipo de ayuda sea seleccionada:
    if ( array_idtipo_ayuda.length === 0 ) {
        flag = false;
    }

    // ------------------------------------------------------------------------ //
    if( fecha_ayuda_social == "" ) {
        $('#modal_detalle_ayudasocial #fecha_ayuda_social_'+idfichaJugador+'').css("background-color", "#ffc6c6"); // <--- Color blanco.
        flag = false;
        // alert('1');
    } else {
        $('#modal_detalle_ayudasocial #fecha_ayuda_social_'+idfichaJugador+'').css("background-color", "white");
    }

    // ------------------------------------------------------------------------ //
    if( monto_ayuda_social != "" ) {
        if( monto_ayuda_social.match(ER_numericosDecimales) && ( parseInt(monto_ayuda_social.length) >= 1 ) ) {      
            $('#modal_detalle_ayudasocial #monto_ayuda_social_'+idfichaJugador+'').css("background-color", "white");
        } else {
            $('#modal_detalle_ayudasocial #monto_ayuda_social_'+idfichaJugador+'').css("background-color", "#ffc6c6");
            flag = false;
            // alert('2');
        }
    } else {
        $('#modal_detalle_ayudasocial #monto_ayuda_social_'+idfichaJugador+'').css("background-color", "#ffc6c6");
        flag = false;
        // alert('3');
    }

    // ------------------------------------------------------------------------ //
    if($('#modal_detalle_ayudasocial #input_ayuda_otro_'+idfichaJugador+'').is(":visible")) {

        if( input_ayuda_otro != "" ) {
            if( input_ayuda_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(input_ayuda_otro.length) >= 1 ) ) {      
                $('#modal_detalle_ayudasocial #input_ayuda_otro_'+idfichaJugador+'').css("background-color", "white");
            } else {
                $('#modal_detalle_ayudasocial #input_ayuda_otro_'+idfichaJugador+'').css("background-color", "#ffc6c6");
                flag = false;
                // alert('4');
            }
        } else {
            $('#modal_detalle_ayudasocial #input_ayuda_otro_'+idfichaJugador+'').css("background-color", "white");
            // flag = false;
        }

    }

    // ------------------------------------------------------------------------ //
    if( detalle_ayuda_social != "" ) {
        if( detalle_ayuda_social.match(ER_caracteresAlfaNumericos) && ( parseInt(detalle_ayuda_social.length) >= 1 ) ) {      
            $('#modal_detalle_ayudasocial #detalle_ayuda_social_'+idfichaJugador+'').css("background-color", "white");
        } else {
            $('#modal_detalle_ayudasocial #detalle_ayuda_social_'+idfichaJugador+'').css("background-color", "#ffc6c6");
            flag = false;
            // alert('5');
        }
    } else {
        $('#modal_detalle_ayudasocial #detalle_ayuda_social_'+idfichaJugador+'').css("background-color", "white");
        // flag = false;
    }

    if( flag === false ){
        $('#modal_detalle_ayudasocial #boton_guardar_ayuda_social').prop("disabled", true);
    }else{
        $('#modal_detalle_ayudasocial #boton_guardar_ayuda_social').prop("disabled", false);
        // alert("Formulario validado");
    }

}
// --------------------------------------- Fin de la función chequear_datos_form_editar() --------------------------------------- //


function boton_cerrar_modal_guardar(){
    $("#modal_detalle_ayudasocial").modal('hide');
}

function closeModal_pdf(){
    $("#descargarPDF").modal('hide');
}

// --------------------------------------- Inicio de la función descargarPDF() --------------------------------------- //
function descargarPDF( idinforme_ayuda_social ){


$("#descargarPDF").modal('show');
$('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');

    $.ajax({
        url: "post/reportes/generarPDF_udc_gestion_talento.php",
        type: "post",
        data: {
            'idinforme_ayuda_social': idinforme_ayuda_social           
        },
        dataType: 'json',
        cache: false,
        success: function(respuesta){
            if(respuesta != ''){
                $('#mensaje_agregar_descargarPDF').html('<h5>PDF Generado Exitosamente...</h5><br><button type="submit" class="boton_informe_jugador" style="border-radius: 5px" id="boton_agregar_informe" ><a  class="btn_descargar" onClick="closeModal_pdf();" download href="reportes_pdf/'+respuesta+'">DESCARGAR PDF</a></button>');
            }else{
                $('#mensaje_agregar_descargarPDF').html('<h5>Error de conexión: los datos no se han podido insertar.</h5><br>');
            }
            
        },error: function(){// will fire when timeout is reached
           $('#mensaje_agregar_descargarPDF').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
// }, 1500);

}
// --------------------------------------- Fin de la función descargarPDF() --------------------------------------- // 

    $('.c_objetivo_fisico li').click(function (e) { e.stopPropagation(); });

    $(document).on('change',".array_idtipo_ayuda_incluir", function(){

        // alert('s');
        let idfichaJugador = $(this).attr('idfichaJugador');
       
         // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
        let numero_select = 0;
        let nombre_option = '';

        $('#tabla_jugadores_ayuda_social input[idfichaJugador="'+idfichaJugador+'"]').each(function () {

            if ($(this).prop('checked')) {
                nombre_option = $(this).closest('label').find(".label_s").html();
                numero_select++;
                //alert( nombre_option );
            }
        });
        
        // ESTABLECEMOS EL TITULO DEL BOTON
        // SI NO HAY NINGUNO COLOCAMOS EL QUE TRAE POR DEFAULT.
        if (numero_select == 0) {
            descripcion = 'Seleccione tipos de ayuda';
        }
        
        // SI HAY UNO SE AGREGA ESTE.
        else if (numero_select == 1) {
            if (nombre_option.length > 25) {
                nombre_option = nombre_option.substr(0, 22);
                
                if (nombre_option[nombre_option.length] == ' ') {nombre_option[nombre_option.length].replace(' ', '')}
                nombre_option += '...';
            }
            descripcion = nombre_option;
        }
        
        // DE LO CONTRARIO SE AGREGA EL NUMERO DE ELEMENTOS SELECIONADOS.
        else { descripcion = numero_select+' Elementos selec.'; }
        
        // ARREGLO CON LOS VALORES DE LAS OPCIONES YA REGISTRADAS PARA SU POSTERIOR ELIMINACION.
        if ($(this).prop('checked')) {
            if ($(this).attr('data-eliminar') != 0) {
                let posicion = window.eliminarObjetivos.indexOf($(this).attr('data-eliminar'));
                if (posicion != -1) { window.eliminarObjetivos.splice(posicion, 1); }
            }
        } else {
            if ($(this).attr('data-eliminar') != 0) { window.eliminarObjetivos.push($(this).attr('data-eliminar')); }
        }
        
        $(this).closest('ul').siblings().find('.titulo_multi').html(descripcion);

    });

    // --------------------------------------------------------------------------------------------------------------------------------//  
    $(document).on('change',".array_idtipo_ayuda_filtro", function(){
       
         // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
        let numero_select = 0;
        let nombre_option = '';

        $('.array_idtipo_ayuda_filtro').each(function () {

            if ($(this).prop('checked')) {
                nombre_option = $(this).closest('label').find(".label_s").html();
                numero_select++;
                //alert( nombre_option );
            }
        });
        
        // ESTABLECEMOS EL TITULO DEL BOTON
        // SI NO HAY NINGUNO COLOCAMOS EL QUE TRAE POR DEFAULT.
        if (numero_select == 0) {
            descripcion = 'Seleccione tipos de ayuda';
        }
        
        // SI HAY UNO SE AGREGA ESTE.
        else if (numero_select == 1) {
            if (nombre_option.length > 25) {
                nombre_option = nombre_option.substr(0, 22);
                
                if (nombre_option[nombre_option.length] == ' ') {nombre_option[nombre_option.length].replace(' ', '')}
                nombre_option += '...';
            }
            descripcion = nombre_option;
        }
        
        // DE LO CONTRARIO SE AGREGA EL NUMERO DE ELEMENTOS SELECIONADOS.
        else { descripcion = numero_select+' Elementos selec.'; }
        
        // ARREGLO CON LOS VALORES DE LAS OPCIONES YA REGISTRADAS PARA SU POSTERIOR ELIMINACION.
        if ($(this).prop('checked')) {
            if ($(this).attr('data-eliminar') != 0) {
                let posicion = window.eliminarObjetivos.indexOf($(this).attr('data-eliminar'));
                if (posicion != -1) { window.eliminarObjetivos.splice(posicion, 1); }
            }
        } else {
            if ($(this).attr('data-eliminar') != 0) { window.eliminarObjetivos.push($(this).attr('data-eliminar')); }
        }
        
        $(this).closest('ul').siblings().find('.titulo_multi').html(descripcion);

    });
    
    // -----------------------------------------------------------------
    $(document).on('change',".array_idtipo_ayuda_editar", function(){

        // alert('s');
        let idfichaJugador = $(this).attr('idfichaJugador');
       
         // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
        let numero_select = 0;
        let nombre_option = '';

        $('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').each(function () {

            if ($(this).prop('checked')) {
                nombre_option = $(this).closest('label').find(".label_s").html();
                numero_select++;
                //alert( nombre_option );
            }
        });
        
        // ESTABLECEMOS EL TITULO DEL BOTON
        // SI NO HAY NINGUNO COLOCAMOS EL QUE TRAE POR DEFAULT.
        if (numero_select == 0) {
            descripcion = 'Seleccione tipos de ayuda';
        }
        
        // SI HAY UNO SE AGREGA ESTE.
        else if (numero_select == 1) {
            if (nombre_option.length > 25) {
                nombre_option = nombre_option.substr(0, 22);
                
                if (nombre_option[nombre_option.length] == ' ') {nombre_option[nombre_option.length].replace(' ', '')}
                nombre_option += '...';
            }
            descripcion = nombre_option;
        }
        
        // DE LO CONTRARIO SE AGREGA EL NUMERO DE ELEMENTOS SELECIONADOS.
        else { descripcion = numero_select+' Elementos selec.'; }
        
        // ARREGLO CON LOS VALORES DE LAS OPCIONES YA REGISTRADAS PARA SU POSTERIOR ELIMINACION.
        if ($(this).prop('checked')) {
            if ($(this).attr('data-eliminar') != 0) {
                let posicion = window.eliminarObjetivos.indexOf($(this).attr('data-eliminar'));
                if (posicion != -1) { window.eliminarObjetivos.splice(posicion, 1); }
            }
        } else {
            if ($(this).attr('data-eliminar') != 0) { window.eliminarObjetivos.push($(this).attr('data-eliminar')); }
        }
        
        $(this).closest('ul').siblings().find('.titulo_multi').html(descripcion);

    });    


</script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript">
    

    $('.date_fechaNacimiento').datetimepicker({
        language:  'es',
        format: 'yyyy-mm-dd',
        //startDate: '2014-12-01',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0,
        autoclose: true,
        useCurrent: false
    });

    $('.date_fechaNacimiento').datetimepicker('setDate', new Date() );
    mostrar_al_cargar_pagina();

    $(document).on('click', '.option', function(e) { 
        e.stopPropagation();
    });

$(document).on('focus',".datepicker_recurring_start", function(){
    // $(this).datetimepicker('destroy');
    $(this).datetimepicker({
        language:  'es',
        format: 'yyyy-mm-dd',
        //startDate: '2014-12-01',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1,
        startView: 2,
        minView: 2,
        forceParse: 0,
        autoclose: true,
        useCurrent: false
    });  

    $(this).datetimepicker('setDate', new Date() );

});

$(document).on('change',"#ul_tipos_ayuda_filtro_busqueda li input[value='000']", function(){
    if ( $(this).prop('checked') ) {
        $('#ul_tipos_ayuda_filtro_busqueda li input[type="checkbox"]').each(function(){
            $(this).prop('checked', true);
        });
    } else {
        $('#ul_tipos_ayuda_filtro_busqueda li input[type="checkbox"]').each(function(){
            $(this).prop('checked', false);
        });        
    }

    buscador();

         // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
        let numero_select = 0;
        let nombre_option = '';

        $('.array_idtipo_ayuda_filtro').each(function () {

            if ($(this).prop('checked')) {
                nombre_option = $(this).closest('label').find(".label_s").html();
                numero_select++;
                //alert( nombre_option );
            }
        });
        
        // ESTABLECEMOS EL TITULO DEL BOTON
        // SI NO HAY NINGUNO COLOCAMOS EL QUE TRAE POR DEFAULT.
        if (numero_select == 0) {
            descripcion = 'Seleccione tipos de ayuda';
        }
        
        // SI HAY UNO SE AGREGA ESTE.
        else if (numero_select == 1) {
            if (nombre_option.length > 25) {
                nombre_option = nombre_option.substr(0, 22);
                
                if (nombre_option[nombre_option.length] == ' ') {nombre_option[nombre_option.length].replace(' ', '')}
                nombre_option += '...';
            }
            descripcion = nombre_option;
        }
        
        // DE LO CONTRARIO SE AGREGA EL NUMERO DE ELEMENTOS SELECIONADOS.
        else { descripcion = numero_select+' Elementos selec.'; }
        
        // ARREGLO CON LOS VALORES DE LAS OPCIONES YA REGISTRADAS PARA SU POSTERIOR ELIMINACION.
        if ($(this).prop('checked')) {
            if ($(this).attr('data-eliminar') != 0) {
                let posicion = window.eliminarObjetivos.indexOf($(this).attr('data-eliminar'));
                if (posicion != -1) { window.eliminarObjetivos.splice(posicion, 1); }
            }
        } else {
            if ($(this).attr('data-eliminar') != 0) { window.eliminarObjetivos.push($(this).attr('data-eliminar')); }
        }
        
        $(this).closest('ul').siblings().find('.titulo_multi').html(descripcion);

});


$(document).on('click', "#tabla_jugadores_ayuda_social .dropdown-toggle", function(){
    // alert('d');
    $(this).siblings('ul').css('display', '');
});

</script>