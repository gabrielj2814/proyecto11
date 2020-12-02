<?php
    include('../config/datos.php');
    session_start();
    if(!(isset($_SESSION["nombre_usuario_software"]))){
        session_destroy();
        header('Location: ../index.php?cerrar_sesion=1');
    }else{
        $menu_actual="scouting";
        $submenu_actual="scouting_centro";
        $seccion_comentarios = $comentarios['scouting_centro'];//mis cuotas
        $demo_seccion = $demo['scouting_centro'];
        $nombre_pestana_navegador='Scouting';
        
        $datetime_now = new DateTime();
        $date_hoy = new DateTime();
        $datetime_now = $datetime_now->format('Y-m-d H:i:s');
        $year = $date_hoy->format('Y');
        $date_hoy = $date_hoy->format('Y-m-d');
        $data = explode(" ", $datetime_now);
        $ano_actual =  date("Y");
        $mes_actual =  date("m");
?>   

<!DOCTYPE html> 
<html lang="es"> 
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title><?php echo $nombre_pestana_navegador;?> | Centro</title>

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
<!-- Países -->
<link rel="stylesheet" href="flags/flags.css" />
<link rel="stylesheet" href="flags/flags.min.css" />


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
    /* ----------- MODIFICADO ----------- */
    .boton_refresh{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: #e19830;
        border: 1px solid #e19830; 
        color: white;
        border-radius: 50%;
    } 
    .boton_refresh:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: white;
        border: 1px solid #e19830; 
        color: #e19830;
        border-radius: 50%;
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

    /* ------------------------ */
    .boton_informe_jugador{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid <?php echo $color_fondo; ?>; 
        color: <?php echo $color_fondo; ?>;
        border-radius:5px;
    }
    .boton_informe_jugador:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid black; 
        color: black;
        border-radius:5px;
    }

    /* ------------------------ */
    .boton_agregar_jugador {
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none;
        background-color: <?php echo $color_fondo; ?>;
        border: 1px solid white;
        color: white;
        border-radius: 5px;
    }

    .boton_agregar_jugador:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 1px solid #8f8f8f; 
        color: #8f8f8f;
        border-radius:5px;
    }    

    /* ------------------------ */
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
        background-color: <?php echo $color_fondo; ?>;
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
        background-color: <?php echo $color_fondo; ?>;
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
        background-color: <?php echo $color_fondo; ?>;
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

    /* -------------- BOTÓN PARA AGREGAR VÍDEO (MODAL) */
    .boton_agregar_video_modal {
        background-color: #7ad4a2;
        border: 3px solid #a6f2d1;
        color: #11442e;
        border-radius: 4px;
        padding: 5px 10px;
        font-weight: bold;
    }
    .boton_agregar_video_modal:hover {
        background-color: #e9e9e9;
        border: 3px solid #a6f2d1;
        color: #11442e;
        border-radius: 4px;
        padding: 5px 10px;
        font-weight: bold;
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
    cursor: pointer;
    text-shadow: none; 
    background-color: <?php echo $color_fondo; ?>
    color: white;
    border-radius:10px;
}   
.cuadro_serie:hover{
    background-color: <?php echo $color_fondo_suave; ?>
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

    .black-table thead tr {
        text-align: center;
        height: 45px;
    }   

    .black-table thead tr {
        text-align: center;
        height: 45px;
    } 

    .black-table thead tr th{
        padding-top: 10px; 
        padding-bottom:5px;        
    }           

    .black-table tbody tr {
        text-align: center;
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
    color: #7b7575;
    width: 100%;
    display: inline-block;
    border-top: 2px solid #555555;
    border-bottom: 2px solid #555555;
    padding: 0px;
    box-sizing: border-box;
}

.titulo_serie {
    color: #7b7575;
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

/* ------------------------------------------------------------------ */

.black-table { 
    background-color: transparent;
    border-collapse: separate;
    border-spacing: 0px 3px;
    width: 93%;
    margin: auto;
}

.black-table tbody tr:hover {
    background-color: transparent;
}

.black-table thead tr, .black-table tbody tr {
    background-color: #2b2a2a;
}

.black-table thead tr {
    text-align: center;
}

.black-table thead tr th {
    font-weight: normal;
}

.black-table tbody tr {
    color: white;
    height:27px;
    cursor:pointer;
    font-size:13px;
}


/* ------------------------------------------------------------------ */

#tabla_ver_perfil_jugador thead tr, #tabla_ver_perfil_jugador tbody tr {
    text-align: center;  
}

#tabla_ver_perfil_jugador thead tr, #tabla_ver_perfil_jugador tbody tr {
    text-align: center;  
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

.th-textarea {
    background-color: <?php echo $color_fondo; ?>;
    color: white;
    border-radius: 6px 6px 0px 0px;
    font-weight: bold;
}

.div-tr-break {
    height: 20px;
}

.textarea-social {
    width:100%; -webkit-appearance: none; 
    -moz-appearance : none; 
    border: 2px solid <?php echo $color_fondo; ?>; 
    border-radius: 0px 0px 0px 0px;
    margin-bottom:0px; 
    text-align:center; 
    line-height: 16px;          
    font-weight: bold;
    text-align: left;
}

.textarea-informe-scouting {
    width:100%; -webkit-appearance: none; 
    -moz-appearance : none; 
    border: 1px solid #dad7d7;
    border-radius: 0px 0px 0px 0px;
    margin-bottom:0px; 
    text-align:center; 
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
    width: 230px;
    -webkit-appearance: none;
    -moz-appearance: none;        
}

#boton_agregar_informe_icsj:enabled {
    cursor: pointer;
}

#boton_agregar_informe_icsj:disabled {
    cursor: no-drop;
}

 
.img-star-five-stars {
    width: 80px;margin-left: 50px; height: 13px; margin-top: -3px;
}

.imagen-jugador {
    background-color: white;
}

.ellipsis-text {
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;    
    margin-bottom: 0px;
    font-weight: bold;
}

.nombre-club-table {
    display: inline;
} 

.div-club-table {
    text-align: center;
    max-width: 150px;
}

.serie-cantidad-jugadores {
    text-align: center;
    height: 20px;
    margin-top: -15px;
    width: 70px;
    float: right;
    background-color: #ff291a;
    color: white;
    border: 2px solid white;
    border-radius: 20px;
    padding: 2px;
}

.nombre-pais-inicio {
    color: aliceblue;
    margin: 0;
}

.img-nacionalidad {
    width: 20px; 
    height:auto; 
}

.img-club { 
    width: 15px; 
    height:auto; 
    margin-right: 5px;
}


/* ------------------------------------------ */

.form-range-control {
    margin: 0 auto;
    padding: 1.5em;
    border-radius: 5px; 
}
/*
.form-range-control input[type="range"] {
    -webkit-appearance: none;
    background-color: white;
    height: 1px;
    border-radius: 1px;
    width: 100%;
}

.form-range-control input[type="range"]::-webkit-slider-thumb {
    -webkit-appearance: none;
    width: 20px;
    height: 20px;
    background-color: #f44336;
    border-radius: 50%;
    cursor: -moz-grab;
    cursor: -webkit-grab; 
}
*/

.span-input-range {
    margin-top: 4px;
    color: white;
    margin-right: 10px; 
}

.multi-range, .multi-range * { box-sizing: border-box; padding: 0; margin: 0; }
.multi-range { 
    position: relative; 
    width: 80%;
    height: 28px; 
    /* margin: 16px; 
    border: 1px solid #ddd;
    */
    font-family: monospace;
}
.multi-range > hr { position: absolute; width: 100%; top: 50%; }
.multi-range > input[type=range] {
    width: calc(100% - 16px); 
    position: absolute; bottom: 6px; left: 0;
}
.multi-range > input[type=range]:last-of-type { margin-left: 16px; }
.multi-range > input[type=range]::-webkit-slider-thumb { transform: translateY(-18px); }
.multi-range > input[type=range]::-webkit-slider-runnable-track { -webkit-appearance: none; height: 0px;}
.multi-range > input[type=range]::-moz-range-thumb { transform: translateY(-18px); }
.multi-range > input[type=range]::-moz-range-track { -webkit-appearance: none; height: 0px;}
.multi-range > input[type=range]::-ms-thumb { transform: translateY(-18px); }
.multi-range > input[type=range]::-ms-track { -webkit-appearance: none; height: 0px; }
.multi-range::after { 
    /*
    content: attr(data-lbound) ' - ' attr(data-ubound); 
    position: absolute; top: 0; left: 100%; white-space: nowrap;
    display: block; padding: 0px 4px; margin: -1px 2px;
    height: 26px; width: auto; border: 1px solid #ddd; 
    font-size: 13px; line-height: 26px;
    */
    content: attr(data-lbound) ' - ' attr(data-ubound);
    position: absolute;
    top: 20px;
    left: 35%;
    white-space: nowrap;
    display: block;
    padding: 0px 4px;
    margin: -1px 2px;
    height: 26px;
    width: auto;
    font-size: 13px;
    line-height: 26px;
    color: black;    
}


.multi-range > input[type=range]::-moz-range-track {
  width: 100%;
  height: 8.4px;
  cursor: pointer;
  box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
  background: #3071a9;
  border-radius: 1.3px;
  border: 0.2px solid #010101;
}
/* ------------------------------- */
.multi-range > input[type=range] {
    -webkit-appearance: none;
    /*
    margin: 18px 0;
    width: 100%;
    background-color: blue;
    */
}
.multi-range > input[type=range]:focus {
    outline: none;
}
.multi-range > input[type=range]::-webkit-slider-runnable-track {
    width: 100%;
    cursor: pointer;
    animate: 0.2s;
    background-color: #f44336;
    border-radius: 50%;
}

.multi-range > input[type=range]::-webkit-slider-thumb {
    border: 1px solid #000000;
    height: 20px;
    width: 20px;
    background-color: #f44336;
    border-radius: 50%;
    cursor: pointer;
    -webkit-appearance: none;
}

/*------------------ */
.cr-slider-wrap > input[type=range]::-webkit-slider-runnable-track {
    width: 100%;
    cursor: pointer;
    animate: 0.2s;
    background-color: <?php echo $color_fondo; ?>
    border-radius: 50%;
}

.cr-slider-wrap > input[type=range]::-webkit-slider-thumb {
    border: 1px solid #000000;
    height: 20px;
    width: 20px;
    background-color: <?php echo $color_fondo; ?>
    border-radius: 50%;
    cursor: pointer;
    -webkit-appearance: none;
}

.row-form-jugador {
    width: 100%;
    margin-bottom: 50px;
    height: 5px;
}


div.div_file{
    border: 3px solid <?php echo $color_fondo; ?>;
    position: relative;
    margin: auto;
    width: 170px;
}

p.texto_input_file{
    text-align: center;
    color: <?php echo $color_fondo; ?>;
    margin: 0;
    font-weight: 600;
}

input#foto_jugador, input#foto_entrenador{
    position:absolute;
    top:0px;
    left:0px;
    right:0px;
    bottom:0px;
    width:100%;
    height:100%;
    opacity: 0;
}

.tabbable {
    -webkit-appearance: none;
    -moz-appearance: none;
    border: 1px solid <?php echo $color_fondo; ?>;
    border-radius: 6px;
    background-color: transparent;
}

.nav-tabs>li>a {
    padding-top: 8px;
    padding-bottom: 8px;
    line-height: 20px;
    border: 1px solid transparent;
    -webkit-border-radius: 4px 4px 0 0;
    -moz-border-radius: 4px 4px 0 0;
    border-radius: 4px 4px 0 0;
    color: white;
    font-weight: bold;
}

.nav-tabs {
    background-color: <?php echo $color_fondo; ?>;
    border-bottom: 1px solid #ddd;
}

.nav-tabs>.active>a, .nav-tabs>.active>a:hover, .nav-tabs>.active>a:focus {
    color: black;
    cursor: default;
    background-color: #fff;
    border: 1px solid #ddd;
    border-bottom-color: transparent;
}

.nav>li>a:hover, .nav>li>a:focus {
    text-decoration: none;
    background-color: <?php echo $color_fondo; ?>; /*#eee*/
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

#modal-detalle-jugador {
    width: 800px; 
    height: auto;
    position: fixed;
    top: 5%;
    left: 50%;  
    background-color: #212121;
    border: 1px solid white;
    border-radius: 0px; 
    margin-left: -400px;
}

/* ------------------ INPUT NEGRO ------------------ */
.black-a {
    margin: 0px;
    width: 35%;
    border-bottom-left-radius: 2px;
    border-top-left-radius: 2px;
    margin-left: 0px;
    margin-right: 0px;
    margin-top: 0px;
    font-size: 13px;
    margin-bottom: 0px;
    background-color: #343333;

}

.black-a:hover {
    background-color: #343333;
}

.black-input {
    background-color: white;
    margin: 0px;
    width: 65%;
    -webkit-appearance: none;
    -moz-appearance: none;
    border: 1px solid #343333;
    margin-left: 0px;
    margin-right: 0px;
    border-bottom-right-radius: 2px;
    border-top-right-radius: 2px;
    border-bottom-left-radius: 0px;
    border-top-left-radius: 0px;
    margin-bottom: 0px;
    text-align: center;
    line-height: 16px;
}

#modal-detalle-jugador .modal-header {
    border-bottom: none;
    background-color: inherit;
}

.tabla-modal-detalle-jugador {
    width: 100%;
    color: white;
}
.tabla-modal-detalle-jugador tr:hover {
    background-color: inherit;
}

.tabla-modal-detalle-jugador tr th, .tabla-modal-detalle-jugador tr td {
    text-align: left;
}

.tarjetaAmarilla {
    background: #ffbd4c;
    background: -moz-radial-gradient(center, ellipse cover, #ffbd4c 0%, #ffa500 100%);
    background: -webkit-radial-gradient(center, ellipse cover, #ffbd4c 0%,#ffa500 100%);
    background: radial-gradient(ellipse at center, #ffbd4c 0%,#ffa500 100%);
    border-radius: 2px;
    width: 14px;
    height: 20px;
    vertical-align: middle;
}

.tarjetaRoja {
    background: #ff3f3f;
    background: -moz-radial-gradient(center, ellipse cover, #ff3f3f 1%, #ff0000 99%);
    background: -webkit-radial-gradient(center, ellipse cover, #ff3f3f 1%,#ff0000 99%);
    background: radial-gradient(ellipse at center, #ff3f3f 1%,#ff0000 99%);
    border-radius: 2px;
    width: 14px;
    height: 20px;
    vertical-align: middle;
}

/* ------------------------------------------------------------------ */

.blackt-jugador-modal { 
    background-color: transparent;
    /*
    border-collapse: separate;
    border-spacing: 0px 3px;
    */
    width: 100%;
}

.blackt-jugador-modal thead tr {
    border-bottom: 1px solid white;
    font-weight: bold;
}

.blackt-jugador-modal thead tr, .blackt-jugador-modal tbody tr {
    background-color: transparent;
}


.blackt-jugador-modal thead tr th {
    font-weight: bold;
    text-align: center;
    color: #dcdbdb;
}

.blackt-jugador-modal tbody tr td{
    color: #a29f9f;
    height:27px;
    cursor:pointer;
    font-size:13px;
}

.blackt-jugador-modal tbody tr:hover{
    background-color: #e0e0e0;
}

.div-imagen-club-tabla {
    margin: auto;
    background-color: #6b6a6a;
    border-radius: 50%;
    width: 45px;
    margin-top: 5px;
    margin-bottom: 5px; 
    margin-left: 5px;
}

.imagen-club-tabla {
    display: block;
    width: 30px;
    /* border-radius: 230px; */
    /* border: solid 2px; */
    /* background-color: #6b6a6a; */
    height: 35px;
    /* margin-right: 5px; */
    margin: auto;
    padding: 5px;
}


table tfoot tr:hover {
    background-color: transparent;
    cursor: none;
}

/* --------------- Botón para agregar partido deshabilitado -------------- */
.boton-agregar-partido-disabled {
    font-weight: bold;
    text-transform: uppercase;
    padding: 10px;
    border: none;
    display: block;
    margin: auto;
    border-radius: 7px;
    width: 250px;
    background-color: transparent;
    color: #8e8c8c;
    border: 1px solid #8e8c8c;
    margin-bottom: 20px;
    cursor: not-allowed;
}

.boton-agregar-partido-disabled:hover {
    background-color: transparent;
}

/* --------------- Botón para agregar partido habilitado -------------- */
.boton-agregar-partido-enabled {
    font-weight: bold;
    text-transform: uppercase;
    padding: 10px;
    border: none;
    display: block;
    margin: auto;
    border-radius: 7px;
    width: 250px;
    background-color: transparent;
    color: <?php echo $color_fondo; ?>;
    border: 1px solid <?php echo $color_fondo; ?>;
    margin-bottom: 20px;
    cursor: pointer;
}

.boton-agregar-partido-enabled:hover {
    background-color: transparent;
    border: 1px solid black;
    color: black;    
}

/* --------------- Botón para agregar partido -------------- */
#boton-agregar-video {
    font-weight: bold;
    text-transform: uppercase;
    padding: 5px;
    border: none;
    display: block;
    margin: auto;
    border-radius: 7px;
    width: 200px;
    background-color: white;
    color: #2c2b2b;
    border: 1px solid #8e8c8c;
}

#boton-agregar-video:hover {
    background-color: #e7e7e7;
    color: black;
}
/* --------------- Botón para agregar a Scouting -------------- */
#boton-agregar-scouting {
    font-weight: bold;
    text-transform: uppercase;
    padding: 10px;
    border: none;
    display: block;
    margin: auto;
    border-radius: 7px;
    width: 250px;
    background-color: #30b76c;
    color: white;    
    margin-bottom: 20px;
}



.datos-jugador-small {
    margin-top: 0px; 
    color: white; 
    padding: 10px 0px 0px 50px; 
    font-size: 12px;
}

.datos-jugador-small-modal {
    margin-top: 0px; 
    color: white; 
    padding: 10px 0px 0px 50px; 
    font-size: 10px;
}

.datos-jugador-medium {
    margin-top: 0px; 
    color: white; 
    padding: 10px 0px 0px 50px; 
    font-size: 16px;
}

.img-datos-jugador {
    width: 20px;
    height: 25px;
    position: relative;
    left: 35px;
}

.img-datos-jugador-modal {
    width: 15px;
    height: auto;
    position: relative;
    left: 35px;
}

#tabla-evaluacion-jugador, #tabla-evaluacion-jugador tr th {
    border: 1px solid #cdcaca;
    padding: 5px;
}

.texto-tipo-informe {
    text-align: left;
}

.tr-informe-unbordered {
    border: 1px solid #eeeeee;" 
}


.tr-informe-bordered {
    border: 1px solid #cdcaca;
}


/*
#div-form-informe-general, #div-form-informe-partido {
    margin-top: 25px;
}
*/
.input-label-match {
    color: black;
    font-weight: bold;
    display: inline-block;
    margin: -1px 20px 0px 10px;
}


input[type=radio].input-label-match {
    border: 1px solid gray;
    padding: 0.5em;
    -webkit-appearance: none;
    border-radius: 20px;
    background-color: white;
    font-size: 15px;
}

input[type=radio].input-label-match:checked {
    background: #f4f4f4; 
    background-size: 9px 9px;
    box-shadow: inset 0 0 0 5px #2196F3;
}

/* --------------------------------- */
.input-label-match-small {
    color: black;
    font-weight: bold;
    display: inline-block;
    font-size: 10px;
}

label.input-label-match-small {
    position: relative;
    top: 2px;
    /*font-size: 11px;*/
    font-size: 13px;
}

input[type=radio].input-label-match-small {
    border: 1px solid gray;
    padding: 0.5em;
    -webkit-appearance: none;
    border-radius: 20px;
    background-color: white;
    font-size: 10px;
}

input[type=radio].input-label-match-small:checked {
    background: #f4f4f4; 
    background-size: 9px 9px;
    box-shadow: inset 0 0 0 3px #2196F3;
}

.input-modal-video {
    height: 31px;
    border: 1px solid #b1160b;
    border-radius: 2px;
}

.label-input-modal-video {
    font-weight: bold;
    color: #2d2929;
    margin: 0;
}

.div-datos-partido {
    width: 100%;
}

.div-datos-partido .span4 {
    width: 30%;
    margin-bottom: 20px;
}

#form_informe_cscouting_jugador table tr:hover {
    background-color: transparent;
}

.tdatos-jugador-informe-scouting table tbody tr {
    height: 20px;
}

.tdatos-jugador-informe-scouting table tr:hover {
    background-color: transparent;
}

.tdatos-jugador-informe-scouting table tbody tr th {
    text-align: left;
    text-indent: 10px;
    color: black;
}

.tdatos-jugador-informe-scouting table tbody tr td {
    color: black;
}

.img-next-to-text {
    float:left;
    display:block;
    position:relative;
    width:20%;
}

#tabla_informe_datos_partido tr th {
    border: none;
}

#cuadro_form_agregar_jugador select {
    color: black;
}

select {
  text-align: center;
  text-align-last: center;
  color: black;
}
option {
  text-align: center;
}

/* Centrando texto de inputs del formulario de partido regular y scouting */
#formulario_partido_jugador input, #form_informe_cscouting_jugador input, #formulario_partido_entrenador input {
    text-align: center;
}

.div-imagen-form {
    height: 190px; 
    width: 220px; 
    display: block; 
    margin-bottom: 10px; 
    margin: auto; 
    background-color: transparent; 
    border: solid <?php echo $color_fondo; ?>; 5px; 
    border-radius: 50%; 
    margin-bottom: 10px;
}

.img-form {
    position: relative; 
    width: 140px; 
    height: 140px; 
    padding: 5px; 
    top: 20px; 
    display: block; 
    margin: auto;
}

.my-input {
    width: 48%!important;
    border: 1px solid <?php echo substr($color_fondo, 0, -1) . '!important;'; ?>
    margin-left: 0px!important;
    margin-right: 0px!important;
    text-transform: capitalize!important;
    border-bottom-right-radius: 2px!important;
    border-top-right-radius: 2px!important;
    margin-bottom: 0px!important;
    background-color: white!important;
}

.img-nacionalidad-small {
    width: 20px; 
    height: 15px;
}

.date-picker::placeholder {
    color: gray;
    text-transform: none;
}

.div-cuadro-principal {
    margin-bottom: 10px;
}

</style>
<script type="text/javascript">
    var imagen_cargando = new Image();
    imagen_cargando.src = "../config/cargando_final_2.gif";
</script>
<script src="../print_js/print.min.js"></script>
<script src="js/angular.min.js" type="application/javascript"></script>
<script type="text/javascript" src="graficos/jquery-3.1.1.min.js"></script>
<script type="text/javascript" src="graficos/highcharts-3d.js"></script>
<script type="text/javascript" src="graficos/highcharts.js"></script>
<script type="text/javascript" src="graficos/exporting.js"></script>
<!--<script type="text/javascript" src="graficos/highcharts-3d.js"></script>-->
<script type="text/javascript" src="graficos/highcharts-more.js"></script>
<script type="text/javascript" src="graficos/series-label.js"></script>
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

// Array de Países:
// El penúltimo elemento de cada array representa el tipo de país.
// El último elemento de cada array representa el gentilicio.
var dir_img_system = '../config/';
var array_paises = [
    [0, 'Todos', ''],
    [1, 'Chile', dir_img_system + 'chile.png', 1, 'Chileno'],
    [2, 'Argentina', dir_img_system + 'argentina.png', 1, 'Argentino'],
    [3, 'Venezuela', dir_img_system + 'venezuela.png', 1, 'Venezolano'],
    [4, 'Brasil', dir_img_system + 'brasil.png', 1, 'Brasileño'],
    [5, 'Colombia', dir_img_system + 'colombia.png', 1, 'Colombiano'],
    [6, 'Ecuador', dir_img_system + 'ecuador.png', 1, 'Ecuatoriano'],
    [7, 'Uruguay', dir_img_system + 'uruguay.png', 1, 'Uruguayo'],
    [8, 'Perú', dir_img_system + 'peru.png', 1, 'Peruano'],
    [9, 'Paraguay', dir_img_system + 'paraguay.png', 'Paraguayo'],
    [10, 'México', dir_img_system + 'mexico.png', 1, 'Mexicano'],
    [11, 'España', dir_img_system + 'espana.png', 2, 'Español'],
    [12, 'Inglaterra', dir_img_system + 'inglaterra.png', 2, 'Inglés'],
    [13, 'Alemania', dir_img_system + 'alemania.png', 2, 'Alemán'],
    [14, 'China', dir_img_system + 'china.png', 2, 'Chino'],
    [15, 'Bélgica', dir_img_system + 'belgica.png', 2, 'Belga'],
    [16, 'Bolivia', dir_img_system + 'bolivia.png', 2, 'Boliviano'],
    [17, 'Costa Rica', dir_img_system + 'costa_rica.png', 2, 'Costarricense'],
    [18, 'Estados Unidos', dir_img_system + 'estados_unidos.png', 2, 'Estadounidense'],
    [19, 'Honduras', dir_img_system + 'honduras.png', 2, 'Hondureño'],
    [20, 'El Salvador', dir_img_system + 'el_salvador.png', 2, 'Salvadoreño'],
    [21, 'Escocia', dir_img_system + 'escocia.png', 2, 'Escocés'],
    [22, 'Francia', dir_img_system + 'francia.png', 2, 'Francés'],
    [23, 'Grecia', dir_img_system + 'grecia.png', 2, 'Griego'],
    [24, 'Holanda', dir_img_system + 'holanda.png', 2, 'Holandés'],
    [25, 'Italia', dir_img_system + 'italia.png', 2, 'Italiano'],
    [26, 'Japón', dir_img_system + 'japon.png', 2, 'Japonés'],
    [27, 'Portugal', dir_img_system + 'portugal.png', 2, 'Portugués'],
    [28, 'Rusia', dir_img_system + 'rusia.png', 2, 'Ruso'],
    [29, 'Turquía', dir_img_system + 'turquia.png', 2, 'Turco'],
];

// Array series
var array_series = [
    ['nulo', "Seleccione"],
    [8, "SUB-8"],
    [9, "SUB-9"],
    [10, "SUB-10"],
    [11, "SUB-11"],
    [12, "SUB-12"],
    [13, "SUB-13"],
    [14, "SUB-14"],
    [15, "SUB-15"],
    [16, "SUB-16"],
    [17, "SUB-17"],
    [19, "SUB-19"],
    [99, "Primer Equipo"],
];

// Array de Divisiones:
var array_divisiones = [];

// Chile:
array_divisiones['cl'] = [];
array_divisiones['cl'][1] = [1, 'Primera A'];
array_divisiones['cl'][2] = [2, 'Primera B'];
array_divisiones['cl'][3] = [3, 'Segunda Profesional'];
array_divisiones['cl'][4] = [4, 'Tercera A'];    

// Argentina:
array_divisiones['ar'] = [];
array_divisiones['ar'][5] = [5, 'Primera División'];
array_divisiones['ar'][6] = [6, 'Primera Nacional'];
array_divisiones['ar'][7] = [7, 'Primera B Metropolitana'];    

// Uruguay:
array_divisiones['uy'] = [];
array_divisiones['uy'][8] = [8, 'Primera División'];
array_divisiones['uy'][9] = [9, 'Segunda División'];   


// Venezuela:
array_divisiones['ve'] = [];
array_divisiones['ve'][10] = [10, 'Primera División'];
array_divisiones['ve'][11] = [11, 'Segunda División'];

// --- Perú:
array_divisiones['pe'] = [];
array_divisiones['pe'][12] = [12, 'Primera División'];
array_divisiones['pe'][13] = [13, 'Segunda División'];

// --- Brasil:
array_divisiones['br'] = [];
array_divisiones['br'][14] = [14, 'Serie A Primera División'];
array_divisiones['br'][15] = [15, 'Serie B Segunda División'];


// --- Ecuador:
array_divisiones['ec'] = [];
array_divisiones['ec'][16] = [16, 'Serie A Primera División'];

// --- Colombia:
array_divisiones['co'] = [];
array_divisiones['co'][17] = [17, 'Primera A'];
array_divisiones['co'][18] = [18, 'Primera B'];   
 
// --- Paraguay:
array_divisiones['py'] = [];
array_divisiones['py'][19] = [19, 'Primera División'];     

// --- Bolivia:
array_divisiones['bo'] = [];
array_divisiones['bo'][20] = [20, 'Primera División']; 

      
// --- México:
array_divisiones['mx'] = [];
array_divisiones['mx'][21] = [21, 'Primera División Liga MX'];
array_divisiones['mx'][22] = [22, 'Ascenso Mexicano']; 

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

// -------- Países ------------- //
var paises_nacionalidad = [];
paises_nacionalidad['af'] = 'Afganistán';
paises_nacionalidad['al'] = 'Albania';
paises_nacionalidad['de'] = 'Alemania';
paises_nacionalidad['ad'] = 'Andorra';
paises_nacionalidad['ao'] = 'Angola';
paises_nacionalidad['ai'] = 'Anguilla';
paises_nacionalidad['aq'] = 'Antártida';
paises_nacionalidad['ag'] = 'Antigua y Barbuda';
paises_nacionalidad['an'] = 'Antillas Holandesas';
paises_nacionalidad['sa'] = 'Arabia Saudí';
paises_nacionalidad['dz'] = 'Argelia';
paises_nacionalidad['ar'] = 'Argentina';
paises_nacionalidad['am'] = 'Armenia';
paises_nacionalidad['aw'] = 'Aruba';
paises_nacionalidad['au'] = 'Australia';
paises_nacionalidad['at'] = 'Austria';
paises_nacionalidad['az'] = 'Azerbaiyán';
paises_nacionalidad['bs'] = 'Bahamas';
paises_nacionalidad['bh'] = 'Bahrein';
paises_nacionalidad['bd'] = 'Bangladesh';
paises_nacionalidad['bb'] = 'Barbados';
paises_nacionalidad['be'] = 'Bélgica';
paises_nacionalidad['bz'] = 'Belice';
paises_nacionalidad['bj'] = 'Benin';
paises_nacionalidad['bm'] = 'Bermudas';
paises_nacionalidad['by'] = 'Bielorrusia';
paises_nacionalidad['mm'] = 'Birmania';
paises_nacionalidad['bo'] = 'Bolivia';
paises_nacionalidad['ba'] = 'Bosnia y Herzegovina';
paises_nacionalidad['bw'] = 'Botswana';
paises_nacionalidad['br'] = 'Brasil';
paises_nacionalidad['bn'] = 'Brunei';
paises_nacionalidad['bg'] = 'Bulgaria';
paises_nacionalidad['bf'] = 'Burkina Faso';
paises_nacionalidad['bi'] = 'Burundi';
paises_nacionalidad['bt'] = 'Bután';
paises_nacionalidad['cv'] = 'Cabo Verde';
paises_nacionalidad['kh'] = 'Camboya';
paises_nacionalidad['cm'] = 'Camerún';
paises_nacionalidad['ca'] = 'Canadá';
paises_nacionalidad['td'] = 'Chad';
paises_nacionalidad['cl'] = 'Chile';
paises_nacionalidad['cn'] = 'China';
paises_nacionalidad['cy'] = 'Chipre';
paises_nacionalidad['va'] = 'Ciudad del Vaticano (Santa Sede)';
paises_nacionalidad['co'] = 'Colombia';
paises_nacionalidad['km'] = 'Comores';
paises_nacionalidad['cg'] = 'Congo';
paises_nacionalidad['cd'] = 'Congo, República Democrática del';
paises_nacionalidad['kr'] = 'Corea';
paises_nacionalidad['kp'] = 'Corea del Norte';
paises_nacionalidad['ci'] = 'Costa de Marfíl';
paises_nacionalidad['cr'] = 'Costa Rica';
paises_nacionalidad['hr'] = 'Croacia (Hrvatska)';
paises_nacionalidad['cu'] = 'Cuba';
paises_nacionalidad['dk'] = 'Dinamarca';
paises_nacionalidad['dj'] = 'Djibouti';
paises_nacionalidad['dm'] = 'Dominica';
paises_nacionalidad['ec'] = 'Ecuador';
paises_nacionalidad['eg'] = 'Egipto';
paises_nacionalidad['sv'] = 'El Salvador';
paises_nacionalidad['ae'] = 'Emiratos Árabes Unidos';
paises_nacionalidad['er'] = 'Eritrea';
paises_nacionalidad['si'] = 'Eslovenia';
paises_nacionalidad['es'] = 'España';
paises_nacionalidad['us'] = 'Estados Unidos';
paises_nacionalidad['ee'] = 'Estonia';
paises_nacionalidad['et'] = 'Etiopía';
paises_nacionalidad['fj'] = 'Fiji';
paises_nacionalidad['ph'] = 'Filipinas';
paises_nacionalidad['fi'] = 'Finlandia';
paises_nacionalidad['fr'] = 'Francia';
paises_nacionalidad['ga'] = 'Gabón';
paises_nacionalidad['gm'] = 'Gambia';
paises_nacionalidad['ge'] = 'Georgia';
paises_nacionalidad['gh'] = 'Ghana';
paises_nacionalidad['gi'] = 'Gibraltar';
paises_nacionalidad['gd'] = 'Granada';
paises_nacionalidad['gr'] = 'Grecia';
paises_nacionalidad['gl'] = 'Groenlandia';
paises_nacionalidad['gp'] = 'Guadalupe';
paises_nacionalidad['gu'] = 'Guam';
paises_nacionalidad['gt'] = 'Guatemala';
paises_nacionalidad['gy'] = 'Guayana';
paises_nacionalidad['gf'] = 'Guayana Francesa';
paises_nacionalidad['gn'] = 'Guinea';
paises_nacionalidad['gq'] = 'Guinea Ecuatorial';
paises_nacionalidad['gw'] = 'Guinea-Bissau';
paises_nacionalidad['ht'] = 'Haití';
paises_nacionalidad['hn'] = 'Honduras';
paises_nacionalidad['hu'] = 'Hungría';
paises_nacionalidad['in'] = 'India';
paises_nacionalidad['id'] = 'Indonesia';
paises_nacionalidad['iq'] = 'Irak';
paises_nacionalidad['ir'] = 'Irán';
paises_nacionalidad['ie'] = 'Irlanda';
paises_nacionalidad['bv'] = 'Isla Bouvet';
paises_nacionalidad['cx'] = 'Isla de Christmas';
paises_nacionalidad['is'] = 'Islandia';
paises_nacionalidad['ky'] = 'Islas Caimán';
paises_nacionalidad['ck'] = 'Islas Cook';
paises_nacionalidad['cc'] = 'Islas de Cocos o Keeling';
paises_nacionalidad['fo'] = 'Islas Faroe';
paises_nacionalidad['hm'] = 'Islas Heard y McDonald';
paises_nacionalidad['fk'] = 'Islas Malvinas';
paises_nacionalidad['mp'] = 'Islas Marianas del Norte';
paises_nacionalidad['mh'] = 'Islas Marshall';
paises_nacionalidad['um'] = 'Islas menores de Estados Unidos';
paises_nacionalidad['pw'] = 'Islas Palau';
paises_nacionalidad['sb'] = 'Islas Salomón';
paises_nacionalidad['sj'] = 'Islas Svalbard y Jan Mayen';
paises_nacionalidad['tk'] = 'Islas Tokelau';
paises_nacionalidad['tc'] = 'Islas Turks y Caicos';
paises_nacionalidad['vi'] = 'Islas Vírgenes (EEUU)';
paises_nacionalidad['vg'] = 'Islas Vírgenes (Reino Unido)';
paises_nacionalidad['wf'] = 'Islas Wallis y Futuna';
paises_nacionalidad['il'] = 'Israel';
paises_nacionalidad['it'] = 'Italia';
paises_nacionalidad['jm'] = 'Jamaica';
paises_nacionalidad['jp'] = 'Japón';
paises_nacionalidad['jo'] = 'Jordania';
paises_nacionalidad['kz'] = 'Kazajistán';
paises_nacionalidad['ke'] = 'Kenia';
paises_nacionalidad['kg'] = 'Kirguizistán';
paises_nacionalidad['ki'] = 'Kiribati';
paises_nacionalidad['kw'] = 'Kuwait';
paises_nacionalidad['la'] = 'Laos';
paises_nacionalidad['ls'] = 'Lesotho';
paises_nacionalidad['lv'] = 'Letonia';
paises_nacionalidad['lb'] = 'Líbano';
paises_nacionalidad['lr'] = 'Liberia';
paises_nacionalidad['ly'] = 'Libia';
paises_nacionalidad['li'] = 'Liechtenstein';
paises_nacionalidad['lt'] = 'Lituania';
paises_nacionalidad['lu'] = 'Luxemburgo';
paises_nacionalidad['mk'] = 'Macedonia, Ex-República Yugoslava de';
paises_nacionalidad['mg'] = 'Madagascar';
paises_nacionalidad['my'] = 'Malasia';
paises_nacionalidad['mw'] = 'Malawi';
paises_nacionalidad['mv'] = 'Maldivas';
paises_nacionalidad['ml'] = 'Malí';
paises_nacionalidad['mt'] = 'Malta';
paises_nacionalidad['ma'] = 'Marruecos';
paises_nacionalidad['mq'] = 'Martinica';
paises_nacionalidad['mu'] = 'Mauricio';
paises_nacionalidad['mr'] = 'Mauritania';
paises_nacionalidad['yt'] = 'Mayotte';
paises_nacionalidad['mx'] = 'México';
paises_nacionalidad['fm'] = 'Micronesia';
paises_nacionalidad['md'] = 'Moldavia';
paises_nacionalidad['mc'] = 'Mónaco';
paises_nacionalidad['mn'] = 'Mongolia';
paises_nacionalidad['ms'] = 'Montserrat';
paises_nacionalidad['mz'] = 'Mozambique';
paises_nacionalidad['na'] = 'Namibia';
paises_nacionalidad['nr'] = 'Nauru';
paises_nacionalidad['np'] = 'Nepal';
paises_nacionalidad['ni'] = 'Nicaragua';
paises_nacionalidad['ne'] = 'Níger';
paises_nacionalidad['ng'] = 'Nigeria';
paises_nacionalidad['nu'] = 'Niue';
paises_nacionalidad['nf'] = 'Norfolk';
paises_nacionalidad['no'] = 'Noruega';
paises_nacionalidad['nc'] = 'Nueva Caledonia';
paises_nacionalidad['nz'] = 'Nueva Zelanda';
paises_nacionalidad['om'] = 'Omán';
paises_nacionalidad['nl'] = 'Países Bajos';
paises_nacionalidad['pa'] = 'Panamá';
paises_nacionalidad['pg'] = 'Papúa Nueva Guinea';
paises_nacionalidad['pk'] = 'Paquistán';
paises_nacionalidad['py'] = 'Paraguay';
paises_nacionalidad['pe'] = 'Perú';
paises_nacionalidad['pn'] = 'Pitcairn';
paises_nacionalidad['pf'] = 'Polinesia Francesa';
paises_nacionalidad['pl'] = 'Polonia';
paises_nacionalidad['pt'] = 'Portugal';
paises_nacionalidad['pr'] = 'Puerto Rico';
paises_nacionalidad['qa'] = 'Qatar';
paises_nacionalidad['uk'] = 'Reino Unido';
paises_nacionalidad['cf'] = 'República Centroafricana';
paises_nacionalidad['cz'] = 'República Checa';
paises_nacionalidad['za'] = 'República de Sudáfrica';
paises_nacionalidad['do'] = 'República Dominicana';
paises_nacionalidad['sk'] = 'República Eslovaca';
paises_nacionalidad['re'] = 'Reunión';
paises_nacionalidad['rw'] = 'Ruanda';
paises_nacionalidad['ro'] = 'Rumania';
paises_nacionalidad['ru'] = 'Rusia';
paises_nacionalidad['eh'] = 'Sahara Occidental';
paises_nacionalidad['kn'] = 'Saint Kitts y Nevis';
paises_nacionalidad['ws'] = 'Samoa';
paises_nacionalidad['as'] = 'Samoa Americana';
paises_nacionalidad['sm'] = 'San Marino';
paises_nacionalidad['vc'] = 'San Vicente y Granadinas';
paises_nacionalidad['sh'] = 'Santa Helena';
paises_nacionalidad['lc'] = 'Santa Lucía';
paises_nacionalidad['st'] = 'Santo Tomé y Príncipe';
paises_nacionalidad['sn'] = 'Senegal';
paises_nacionalidad['sc'] = 'Seychelles';
paises_nacionalidad['sl'] = 'Sierra Leona';
paises_nacionalidad['sg'] = 'Singapur';
paises_nacionalidad['sy'] = 'Siria';
paises_nacionalidad['so'] = 'Somalia';
paises_nacionalidad['lk'] = 'Sri Lanka';
paises_nacionalidad['pm'] = 'St Pierre y Miquelon';
paises_nacionalidad['sz'] = 'Suazilandia';
paises_nacionalidad['sd'] = 'Sudán';
paises_nacionalidad['se'] = 'Suecia';
paises_nacionalidad['ch'] = 'Suiza';
paises_nacionalidad['sr'] = 'Surinam';
paises_nacionalidad['th'] = 'Tailandia';
paises_nacionalidad['tw'] = 'Taiwán';
paises_nacionalidad['tz'] = 'Tanzania';
paises_nacionalidad['tj'] = 'Tayikistán';
paises_nacionalidad['tf'] = 'Territorios franceses del Sur';
paises_nacionalidad['tp'] = 'Timor Oriental';
paises_nacionalidad['tg'] = 'Togo';
paises_nacionalidad['to'] = 'Tonga';
paises_nacionalidad['tt'] = 'Trinidad y Tobago';
paises_nacionalidad['tn'] = 'Túnez';
paises_nacionalidad['tm'] = 'Turkmenistán';
paises_nacionalidad['tr'] = 'Turquía';
paises_nacionalidad['tv'] = 'Tuvalu';
paises_nacionalidad['ua'] = 'Ucrania';
paises_nacionalidad['ug'] = 'Uganda';
paises_nacionalidad['uy'] = 'Uruguay';
paises_nacionalidad['uz'] = 'Uzbekistán';
paises_nacionalidad['vu'] = 'Vanuatu';
paises_nacionalidad['ve'] = 'Venezuela';
paises_nacionalidad['vn'] = 'Vietnam';
paises_nacionalidad['ye'] = 'Yemen';
paises_nacionalidad['yu'] = 'Yugoslavia';
paises_nacionalidad['zm'] = 'Zambia';
paises_nacionalidad['zw'] = 'Zimbabue';

// Array Posiciones:
var array_lateralidad = [
    [0, 'Todos'],
    [1, 'Derecho'],
    [2, 'Izquierdo'],
    [3, 'Ambidiestro'],
];

// Array del estado del club del jugador:
var array_estadoclub_jugador = [
    [0, 'Todos'],
    [1, 'Jugador Libre'],
    [2, 'En club'],
];

// Variable para determinar el estatus de las vistas: Alternando entre jugadores y entrenadores
// 1 <-- Jugadores
// 2 <-- Entrenadores
var vista_jugador_entrenador = "";

// Array para guardar datos del jugador (tabla 'fichaJugador_club'):
var idfichaJugador = ""; // <--- Tabla 'fichaJugador'
var idfichaJugador_club = "";
var datos_jugador_club = {};

// Array para guardar datos de los partidos del jugador (tabla 'fichaJugador_partido'):
var idfichaJugador_partido = "";
var datos_jugador_partido = {};

// Array para guardar datos del jugador (tabla 'entrenador_club'):
var identrenador = ""; // <--- Tabla 'fichaJugador'
var identrenador_club = "";
var datos_entrenador_club = {};

// Array para guardar datos de los partidos del jugador (tabla 'entrenador_partido'):
var identrenador_partido = "";
var datos_entrenador_partido = {};

// Variables globales para los datos consultados de la tabla 'cscouting_jugador' del jugador seleccionado:
var idcscouting_jugador = "";
var datos_cscouting_jugador = {};

// Variables globales para los datos consultados de la tabla 'informe_cscouting_jugador' del jugador seleccionado:
var idinforme_cscouting_jugador = "";
var datos_informe_cscouting_jugador = {};

var idinforme_csj_general = "";
var idinforme_csj_partido = "";
var tipo_informe_icsj = "";

var idestadistica_informe_csj = "";

var ano_actual = '<?php echo $ano_actual;?>';
var mes_actual = parseInt('<?php echo $mes_actual;?>');
var error_foto = 0;

var sumUpload = 0;

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


// ----------------------- Inicio de la función 'subir_imagen_jugador()' ----------------------- // 
function subir_imagen_jugador(){
    var file = document.forms['formulario_ficha_jugador']['foto_jugador'].files[0];
    var imagefile = file.type;
    var imagesize = file.size;
    var match= ["image/jpeg","image/png","image/jpg"];
    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
        if(window.error_foto!=1){//1=copia camiseta (AGREGAR)
            window.error_foto=1;
        }else{
            window.error_foto=3; //no se copia nada
        }
        $("#message_foto_jugador").html("<span id='error_message' style='color:#f76b0e; font-size:10px;'><i class='icon-remove'></i><b>Error:</b> solo formato jpg o png</span>");
    }else if(imagesize > 4000000){  
        if(error_foto!=1){//1=copia camiseta (AGREGAR)
            window.error_foto=1;
        }else{
            window.error_foto=3; //no se copia nada
        }
        $("#message_foto_jugador").html("<span id='error_message' style='color:#f76b0e; font-size:10px;'><i class='icon-remove'></i><b>Error:</b> tamaño máximo 4[mb]</span>");
    }else{
        window.error_foto=4;
        
        $("#message_foto_jugador").html("");
    }
    return window.error_foto;
}
// ----------------------- Fin de la función 'subir_imagen_jugador()' ----------------------- //

// ----------------------- Inicio de la función 'subir_imagen_entrenador()' ----------------------- // 
function subir_imagen_entrenador(){
    var file = document.forms['formulario_entrenador']['foto_entrenador'].files[0];
    var imagefile = file.type;
    var imagesize = file.size;
    var match= ["image/jpeg","image/png","image/jpg"];
    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
        if(window.error_foto!=1){//1=copia camiseta (AGREGAR)
            window.error_foto=1;
        }else{
            window.error_foto=3; //no se copia nada
        }
        $("#message_foto_entrenador").html("<span id='error_message' style='color:#f76b0e; font-size:10px;'><i class='icon-remove'></i><b>Error:</b> solo formato jpg o png</span>");
    }else if(imagesize > 4000000){  
        if(error_foto!=1){//1=copia camiseta (AGREGAR)
            window.error_foto=1;
        }else{
            window.error_foto=3; //no se copia nada
        }
        $("#message_foto_entrenador").html("<span id='error_message' style='color:#f76b0e; font-size:10px;'><i class='icon-remove'></i><b>Error:</b> tamaño máximo 4[mb]</span>");
    }else{
        window.error_foto=4;
        
        $("#message_foto_entrenador").html("");
    }
    return window.error_foto;
}
// ----------------------- Fin de la función 'subir_imagen_entrenador()' ----------------------- //

function imageIsLoaded(e) {
    $('#image_preview_jugador').css("display", "block");
    /*
    $('#foto-jugador').attr('src', e.target.result);
    $('#foto-jugador').attr('width', '250px');
    $('#foto-jugador').attr('height', '230px');
    */
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
        $('#boton_agregar_informe_icsj').attr('disabled', true);   
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
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon-truck"></i> SCOUTING <i class="icon-chevron-right"></i> Centro</a>
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
            <i class="icon-truck"></i> SCOUTING
        </a> 
        <a class="current">
            Centro
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
cuadro_modulo_scouting_main
cuadro_jugadores_seguimiento
cuadro_form_agregar_jugador
-->

<!-- ========================================== Inicio del id="cuadro_modulo_scouting_main" ========================================== -->     
<div id="cuadro_modulo_scouting_main" class="row-fluid" style="margin-top: 0px; color:black; font-family:Arial, Helvetica, sans-serif;"> 

    <!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
    <div class="cuadro_buscar_titulo">

        <table style="color:black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
                <tbody>
                    <tr class="sin_fondo">
                        <td style="padding:12px; padding-top:15px;"><img src="../config/icon-search-inverted.png" style="height: 100px; margin-top:5px;"></td>
                        <td>
                            <center>
                                <h3 class="titulo_principal" style="text-transform: uppercase;">Scouting - centro</h3>
                                <p style="margin: 0px;">
                                    En esta sección puedes crear, visualizar, modifcar y eliminar datos de jugadores clasificados por país y club
                                </p>
                            </center>
                        </td>
                    </tr>
            </tbody>
        </table>        

        <div style="width:100%; background-color:#163D61; height:20px; border-radius: 4px;"></div>
        <br>

    </div>
    <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->

    <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px;">

        <div class="row-fluid" style="margin-top: 20px; /*margin-left: 5%;*/ width: 100%;">
            <!-- Aquí se insertarán los cuadros de las series -->
            <div style="width: 70%; margin: auto;">
                <div style="text-align: center;margin: 0px;width: 30%;padding: 10px; float: left;">
                    <div class="serie-cantidad-jugadores">
                        <i class="icon-male"></i> <span class="cantidad-jugadores-scouting" style="font-weight: bold;">(0)</span>
                    </div>
                    <div class="cuadro_serie" style="padding: 15px;" onclick="ir_scouting_jugadores();">
                        <div style="clear: right">
                            <div class="div-cuadro-principal">
                                <img src="../config/silueta_jugador.png" style="width:100px; height: 100px; margin-top:5px;">
                            </div>
                        </div>
                        <div class="nombre_seleccion"><h4 class="nombre-pais-inicio">JUGADORES</h4></div>
                    </div>
                </div>
                <div style="text-align: center;margin: 0px;padding: 10px;width: 30%; float: right;">
                    <div class="serie-cantidad-jugadores">
                        <i class="icon-male"></i> <span class="cantidad-entrenadores-scouting" style="font-weight: bold;">(0)</span>
                    </div>
                    <div class="cuadro_serie" style="padding: 15px;" onclick="ir_scouting_entrenadores();">
                        <div style="clear: right">
                            <div class="div-cuadro-principal">
                                <img src="../config/silueta_entrenador.png" style="width:100px; height: 100px; margin-top:5px;">
                            </div>
                        </div>
                        <div class="nombre_seleccion"><h4 class="nombre-pais-inicio">ENTRENADORES</h4></div>
                    </div>
                </div>              
            </div>                  
        </div>

    </div>

</div>
<!-- ========================================== Fin del id="cuadro_modulo_scouting_main" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_jugadores_seguimiento" ========================================== -->
<div style="display: none; margin: -41px -22px 0px -20px; /*margin: -41px -30px 0px -20px;*/" id="cuadro_jugadores_seguimiento">

    <!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
    <div class="cuadro_buscar_titulo" style="background-image: url('../config/banner_centro_scouting_1.png'); background-size: cover; height: 220px; margin-top: -10px">
        
        <div class="row-fluid">
            <div style="padding:0px; margin:0px; margin-top: -20px;">

                <div>
                    <div>
                        <div style="position: relative; width: 33px; top: 50px; left: 55px; height: 55px; background-color: green; transform: skew(170deg);"></div>        
                    </div>
                    <div>
                        <h5 style="margin-top: 0px; color: white; padding: 0px 0px 0px 100px; font-size: 18px; line-height: 7px; text-transform: uppercase; font-weight: normal;">centro de </h5>
                        <h5 style="margin-top: 0px; color: white; padding: 15px 0px 0px 100px; font-size: 40px; text-transform: uppercase;">scouting</h5>
                    </div>
                </div>

                <br>
                
                <img src="../config/logo_equipo.png" style=" height: auto; position: relative; width: 40px; top: 10px; left: 160px;">
            </div>            
        </div>
         
        <br/>
        
        <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
    </div>  
    <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
    
    <!-- <hr style="width: 95%; margin-left: auto; margin-right: auto; margin-bottom: 30px; border-bottom: 1px solid #c4c4c4;" /> -->

    

    <!-- ================= Inicio del class="fluid cuadro_buscar_buscar" ================= -->
    <div class="row-fluid cuadro_buscar_buscar" style="width: 97%; margin: auto; margin-top: 20px;">
        
        <div style="width:100%; background-color: <?php echo $color_fondo; ?> height:20px; border-radius: 4px;"></div> 

        <button class="boton_volver" onclick="boton_volver_cuadro_scouting();" style="position: relative; top: 25px;">
            <i class="icon-arrow-left"></i> volver
        </button>       

        <center>
            <div style=" width:500px; margin-bottom:10px; display: inline-block;">
                <table border="0">
                    <tbody>
                        <tr class="sin_fondo">
                            <td style="width:330px; padding-left:40px;"><input class="ph-center" style="width:96%; background-color:white; border: 3px solid #555555; border-radius:20px; margin-bottom:0px;padding-left: 10px; height: 24px;" placeholder="Nombre del Jugador o Vacío para Ver Todos" maxlength="149" id="nombre_fbjscouting_main" name="nombre_fbjscouting_main" onkeyup="buscar_jugadores_seguimiento( 2 );" onkeydown="buscar_jugadores_seguimiento( 2 );"></td>
                            <td style="width:40px; cursor:pointer;"> <button class="boton_refresh" onclick="buscar_jugadores_seguimiento( 2 );" id="boton_refresh_jugadores_seguimiento" style="margin-left: 10px; display: none;">
                                <i class="icon-refresh"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </center>
                                
        <!-- Inicio de elementos que se mostrarán en caso de fallar consultas (tabla id="tabla_jugadores_seguimiento")-->
        <center>
            <div style="margin:0px; height:20px;">
                <img src="../config/cargando_buscar.gif" id="cargando_buscar_jugadores_seguimiento" style="display: none;">
                <span style="color: rgb(220, 78, 78); display: none;" id="error_conexion_jugadores_seguimiento"><b>Error:</b> conexión a internet deficiente.</span>
                <span style="color:<?php echo $color_fondo; ?>; display:block;" id="sin_resultados_jugadores_seguimiento">Busqueda sin resultados.</span>                
            </div>
        </center>
        <!-- Fin de elementos que se mostrarán en caso de fallar consultas (tabla id="tabla_jugadores_seguimiento")-->

        <div style="margin-top: 10px; margin-bottom: 60px;">
            <div>
                <!-- ======================================================================== -->
                <div class="span3" style="display: flex;">
                    <a class="btn btn-md btn-primary gray-a" style="width: 50%; text-transform: none;"> 
                        País donde juega
                    </a>
                    <select class="gray-input select-pais-filtro-busqueda" id="idpais_fbjscouting_main" name="idpais_fbjscouting_main" style="width: 40%;" onchange="get_divisiones_from_pais( 11 );"></select>
                </div>
                <!-- ======================================================================== -->
                <div class="span3" style="display: flex;">
                    <a class="btn btn-md btn-primary gray-a"> 
                            División
                    </a>
                    <select class="gray-input" id="division_fbjscouting_main" name="division_fbjscouting_main" onchange="get_clubes_from_paisdivision_jugadores_scouting();">
                        <option value="">Seleccione primero un país</option>
                    </select>
                </div>
                <!-- ======================================================================== -->
                <div class="span3" style="display: flex;">
                    <a class="btn btn-md btn-primary gray-a"> 
                            Club
                    </a>
                    <!-- <select class="gray-input select-club-filtro-busqueda" id="idclub_fbjscouting_main" name="idclub_fbjscouting_main" onchange="buscar_jugadores_seguimiento( 2 );"></select> -->
                    <select class="gray-input" id="idclub_fbjscouting_main" name="idclub_fbjscouting_main" onchange="buscar_jugadores_seguimiento( 2 );">
                        <option value="">Seleccione primero una división</option>
                    </select>
                </div>
                <!-- ======================================================================== -->
                <div class="span3" style="display: flex;">
                    <a class="btn btn-md btn-primary gray-a"> 
                            Nacionalidad
                    </a>
                    <select class="gray-input select-pais-filtro-busqueda" id="nacionalidad_fbjscouting_main" name="nacionalidad_fbjscouting_main" onchange="buscar_jugadores_seguimiento( 2 );"></select>
                </div>                
            </div>

            <div style="height: 25px;"></div>

            <div style="margin-top: 20px;">
                <!-- ======================================================================== -->      
                <div class="span3" style="display: flex; margin-left: 0;">
                    <span class="span-input-range" style="width: 20%; color: black; font-weight: bold;">Edad</span>
                    <div class="multi-range mr-edad-jscouting" data-lbound="" data-ubound="">
                        <hr style="border-bottom: 1px solid #7d7979;">
                        <input type="range" id="range_min_edad_fbjscouting_main" name="range_min_edad_fbjscouting_main" min="0" max="0" step="" oninput="this.parentNode.dataset.lbound=this.value;" onchange="buscar_jugadores_seguimiento( 2 );">
                        <input type="range" id="range_max_edad_fbjscouting_main" name="range_max_edad_fbjscouting_main" min="0" max="50000" step="" oninput="this.parentNode.dataset.ubound=this.value;" onchange="buscar_jugadores_seguimiento( 2 );">
                    </div>
                </div>
                <!-- ======================================================================== -->       
                <div class="span3" style="display: flex;">
                    <a class="btn btn-md btn-primary gray-a"> 
                        Lateralidad
                    </a>
                    <select class="gray-input select-lateralidad-filtro-busqueda" id="lateralidad_fbjscouting_main" name="lateralidad_fbjscouting_main" onchange="buscar_jugadores_seguimiento( 2 );"></select>
                </div>
                <!-- ======================================================================== -->                
            </div>
                                                
        </div>        
               

        <div class="row-fluid" style="margin-top: 90px;">
            <h4 style="color: black; text-transform: uppercase; text-align: center;margin: 0; font-size: 13px;">jugadores en seguimiento</h4>
            <button style="margin-bottom:10px;margin-top: -20px;float:right;" class="boton_informe_jugador" onclick="btn_ir_form_agregarjugador();"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar jugador</b></button>            
        </div>
                            
            <!-- ================= Inicio del class="row-fluid" ================= -->
            <div class="row-fluid" style="margin-top:0px;">

            <!-- ================= Inicio del class="span12" ================= -->
            <div class="span12" style="margin: 0px;"> 
                <!-- ================= Inicio del id="tabla_jugadores_seguimiento" ================= -->  
                <table style="border: 0px solid #8f8f8f; width:100%; font-size: 10px;" id="tabla_jugadores_seguimiento">
                    <thead>
                        <tr style="background-color:#555555; color:white; font-size: 10px;">
                            <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; max-width:25px; width: 25px;">
                                <div class="tip-top" data-original-title="Número" style="width:100%;">#</div>
                            </th>
                            <th scope="col" style="cursor:pointer;padding:0px;width: 120px;">
                                <div class="tip-top" data-original-title="Jugador" style="cursor: pointer;padding: 0px;text-align: left;">JUGADOR</div>
                            </th>
                            <th scope="col" style="cursor:pointer;padding:0px;width: 110px;">
                                <div class="tip-top" data-original-title="Posición/es" style="width: 85px;">POSICIÓN/ES</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; max-width: 100px; width: 100px; text-align: left;">
                                <div class="tip-top" data-original-title="Club" style="width: 100px;">CLUB</div>
                            </th>                                                
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                <div class="tip-top" data-original-title="Nacionalidad" style="width: 70px;">NACIONALIDAD</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                <div class="tip-top" data-original-title="Altura" style="width:65px;">ALT</div>
                            </th>           
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                <div class="tip-top" data-original-title="Fecha de Nacimiento" style="width: 70px;">FECHA NAC</div>
                            </th>                                       
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                <div class="tip-top" data-original-title="Edad" style="width: 55px;">EDAD</div>
                            </th>                                       
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: left;">
                                <div class="tip-top" data-original-title="Fin de Contrato" style="width: 80px;">FIN CONTRATO</div>
                            </th>                                                        
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: left;">
                                <div class="tip-top" data-original-title="Pie Hábil" style="width: 70px;">PIE HÁBIL</div>
                            </th>  
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: left;">
                                <div class="tip-top" data-original-title="Representante" style="width: 90px;">REPRESENTANTE</div>
                            </th>                   
                            <th scope="col" style="cursor:pointer; padding:0px; border-top-right-radius:5px; max-width:20px; width:20px;" colspan="2"></th>
                        </tr>
                    </thead>
                                        
                    <tbody><!-- AQUÍ SERÁN INSERTADOS CON JAVASCRIPT--></tbody>
                                        
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
                <!-- ================= Fin del id="tabla_jugadores_seguimiento" ================= -->
            </div>
            <!-- ================= Fin del class="span12" ================= -->
        </div>
        <!-- ================= Fin del class="row-fluid" ================= -->
    </div>
    <!-- ================= Fin del class="fluid cuadro_buscar_buscar" ================= -->

</div>
<!-- ========================================== Fin del id="cuadro_jugadores_seguimiento" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_form_agregar_jugador" ========================================== -->
<!-- <br><center><h1>----------</h1></center><br> -->
<div style="display:none" id="cuadro_form_agregar_jugador">



    <!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
    <div class="cuadro_buscar_titulo">
        <center>
            <div class="row-fluid" style="margin-top:0px;">
                <div class="span12" style="margin: 0px;">
                    <button class="boton_volver" onclick="bntvolver_desde_form_jugador();" style="float:left; margin:0px; margin-top: 20px;">
                        <i class="icon-arrow-left"></i> volver
                    </button>    

                    <p class="datos_fichaJugador" style="left: 170px;top: 25px;position: relative;display: inline-block;color: #040404;">
                        <b style="text-transform: uppercase;color: #292727;">!NOTA: </b><span>los campos con (*) son</span><span style="text-decoration: underline;"> obligatorios</span>!
                    </p>

                </div>          
            </div> 
        </center>     

        <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
    </div>
    <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
    
    <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; /*margin-top:-60px;*/">
        <div class="row-fluid" style="margin-top:0px;">

            <div class="span12 datos_fichaJugador" style="margin: 0px; margin-top: 10px;">            
                <p style="color: black; font-weight: bold; text-transform: uppercase; float: left;">Nuevo jugador:</p>
            </div>  

            <!-- ========================================== Inicio del id="formulario_ficha_jugador" ========================================== -->
            <form method="post" ng-model="formulario_ficha_jugador" name="formulario_ficha_jugador" id="formulario_ficha_jugador" novalidate autocomplete="off" enctype="multipart/form-data">          

            <div class="span12" style="margin-top: -10px; margin-left: 0;">

                    <div style="width: 100%" class="datos_fichaJugador">
                        
                        <div class="span4">
                            <!--
                            <div class="div-imagen-form">
                                <img id="foto-jugador" class="img-form" src="">
                            </div>  
                            <div id="div_file">
                                <p id="texto"><i class="icon-cloud-upload"></i> Subir foto (.jpg o png)</p>
                                <input type="file" class="custom-file-input" id="foto_jugador" name="foto_jugador" required="" accept=".jpg, .png, .jpeg" onchange="readURL(this);"/>
                                <input type="hidden" name="foto_anterior_jugador" id="foto_anterior_jugador" value="sinFoto">
                            </div>
                            -->
                          <center>
                            <div id="image_preview_jugador" style="border: 6px solid <?php echo $color_fondo; ?>; width:180px; height:180px;  border-radius:100px;">
                                <img id="foto-jugador" src="../config/cargando_logo_final.gif" style="width:180px; border-radius:100px; height:180px;" class="img-thumbnail"/>
                            </div>  
                            <label for="foto_jugador" class="boton_gestionar_cargos subiendo_foto" style="width:170px; margin-top:10px;">
                                <i class="icon-cloud-upload"></i> Subir foto (.jpg o .png)
                            </label>
                            <input type="file" name="foto_jugador" id="foto_jugador" value="Seleccionar foto"  style="display:none;"/>
                            <input type="hidden" name="foto_anterior_jugador" id="foto_anterior_jugador" value="sinFoto">
                            <div id="message_foto_jugador">
                            </div>
                          </center>

                        </div>

                        <!-- ========================================== Inicio de campos a la derecha ========================================== -->
                      <div class="span8" style="margin: 0px;">
                        <div class="span12"  style="margin: 0px;">
                            <div class="span6" style="margin: 0px; margin-bottom:20px;">
                              <div style="padding:0px; margin:0px;">
                                <a class="btn btn-md btn-primary green-a" style="border-bottom-left-radius:2px; border-top-left-radius:2px; margin-left: 0px; margin-right: 0px; width: 90px; margin-top:0px; background-color:<?php echo $color_fondo; ?>; font-size: 12px; margin-bottom:0px;"> *Nombre</a><input type="text" class="my-input" maxlength="149" name="nombre" id="nombre" onkeyup="chequear_datos_form_fichajugador();" onkeydown="chequear_datos_form_fichajugador();">
                                </div>
                            </div>
                            <div class="span6" style="margin: 0px; margin-bottom:20px;">
                              <div style="padding:0px; margin:0px;">
                                <a class="btn btn-md btn-primary green-a"> *Apellido 1</a><input id="apellido1" name="apellido1" type="text" class="my-input" maxlength="149" onkeyup="chequear_datos_form_fichajugador();" onkeydown="chequear_datos_form_fichajugador();"></div>
                              </div>
                        </div>
                        <!-- ==================================================================================== -->
                        <div class="span12"  style="margin: 0px;">
                            <div class="span6" style="margin: 0px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a"> Apellido 2</a><input id="apellido2" name="apellido2" type="text" class="my-input" maxlength="149" onkeyup="chequear_datos_form_fichajugador();" onkeydown="chequear_datos_form_fichajugador();">
                                </div>
                            </div>
                            <div class="span6" style="margin: 0px; margin-bottom:20px;">
                                <a class="btn btn-md btn-primary green-a"> Fecha nac.</a><input class="date-picker my-input" id="fechaNacimiento" name="fechaNacimiento" size="16" type="text" readonly>
                              </div>
                        </div>

                        <div class="span12"  style="margin: 0px;">
                            <div class="span6" style="margin: 0px; margin-bottom:20px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a"> Sexo</a><select id="sexo" name="sexo" class="green-input" onchange="chequear_datos_form_fichajugador();">
                                        <option value="">Seleccione</option>
                                        <option value="1">Masculino</option>
                                        <option value="2">Femenino</option>
                                    </select>
                                </div>
                            </div>

                            <div class="span6" style="margin: 0px; margin-bottom:20px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a"> Altura</a><input id="altura" name="altura" type="text" class="my-input" onkeyup="chequear_datos_form_fichajugador();" onkeydown="chequear_datos_form_fichajugador();">
                                </div>
                            </div>                          
                        </div>

                        <!-- ==================================================================================== -->
                        <div class="span12"  style="margin: 0px;">
                            <div class="span6" style="margin: 0px; margin-bottom:20px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a"> Nacionalidad 1</a><select id="nacionalidad1" name="nacionalidad1" class="green-input select-pais-form" onchange="chequear_datos_form_fichajugador();">
                                    </select>
                                </div>
                            </div>
                            <div class="span6" style="margin: 0px; margin-bottom:20px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a"> Nacionalidad 2</a><select id="nacionalidad2" name="nacionalidad2" class="green-input select-pais-form select-pais-form-adicional" onchange="chequear_datos_form_fichajugador();">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- ==================================================================================== -->
                        <div class="span12"  style="margin: 0px;">
                            <div class="span6" style="margin: 0px; margin-bottom:20px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a"> Serie</a><select id="serieActual" name="serieActual" class="green-input select-serie-jugador-form" onchange="chequear_datos_form_fichajugador();">
                                    </select>
                                </div>
                            </div>

                            <div class="span6" style="margin: 0px; margin-bottom:20px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a"> Lateralidad</a><select id="dinamico" name="dinamico" class="select-lateralidad-form green-input" onchange="chequear_datos_form_fichajugador();">
                                    </select>
                                </div>
                            </div>                          
                        </div>
                     </div>                     
                        <!-- ========================================== Fin de campos a la derecha ========================================== -->

                        <div class="span12" style="margin: 0px; margin-top: 10px;">
                            <div class="span4" style="margin: 0px; margin-bottom:20px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Posición Principal</p></div></a><select id="posicion0" name="posicion0" class="select-posicion-jugador-form green-input " onchange="chequear_datos_form_fichajugador();">
                                    </select>
                                </div>
                            </div>
                            
                            <div class="span4" style="margin: 0px; margin-bottom:20px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Posición Adicional</p></div></a><select id="posicion1" name="posicion1" class="select-posicion-jugador-form select-posicion-jugador-form-adicional green-input " style="width:52.5%;" onchange="chequear_datos_form_fichajugador();">
                                    </select>
                                </div>
                            </div>

                            <div class="span4" style="margin: 0px; margin-bottom:20px; margin-left: 5px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Posición Adicional</p></div></a><select id="posicion2" name="posicion2" class="select-posicion-jugador-form select-posicion-jugador-form-adicional green-input " style="width:52.5%;" onchange="chequear_datos_form_fichajugador();">
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="span12" style="margin: 0px; margin-top: 10px;">
                            <div class="span4" style="margin: 0px; margin-bottom:20px;">
                                <div style="padding:0px; margin:0px;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Seleccionado</p></div></a><select id="seleccionado" name="seleccionado" class="green-input " onchange="chequear_datos_form_fichajugador();">
                                        <option value="">Seleccione</option>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
            </div>

            <div class="span12" style="margin-top: 10px; margin-left: 0;">
                <div class="tabbable"> <!-- Only required for left/right tabs -->
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_form_fichajugador" data-toggle="tab">Datos</a></li>
                    <li><a href="#tab_form_partido" data-toggle="tab">Partidos</a></li>
                  </ul>
                  <div class="tab-content" style="overflow: visible;">
                    
                    <!-- ================================================= Inicio del id="tab_form_fichajugador" ================================================= -->
                    <div class="tab-pane active" id="tab_form_fichajugador">
                    
                            <hr style="margin: auto; margin-top: 50px; margin-bottom: 20px; border-top: 2px solid #c8c5c5; border-bottom: 1px solid #fff; width: 97%;" />

                            <div class="row-fluid cuadro_buscar_buscar" style="width: 98%;">
                                
                            <div class="row-fluid div-datos-partido">
                                
                                <div class="span4" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Estado
                                    </a>
                                    <select class="green-input select-estadoclub-jugador-form" id="estado_jugadorclub" name="estado_jugadorclub" onchange="campos_ficha_jugador();"></select>
                                </div>
                                <!-- ======================================================================== -->
                                <div class="span4 campo-jugador-libre" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Último Club
                                    </a>
                                    <select class="green-input select-club" id="idclub_jugadorlibre" name="idclub_jugadorlibre" onchange="chequear_datos_form_fichajugador();"></select>
                                </div> 

                                <!-- ====================== Inicio de los campos class="campo-club-jugador-libre-otro" ====================== -->
                                <div class="span4 campo-club-jugador-libre-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> País club (Último) </a>
                                    <!-- select-pais-form <- Esta clase agrega valores al select -->
                                    <select class="green-input select-pais-form" id="pais_club_jugadorlibre_otro" name="pais_club_jugadorlibre_otro" onchange="get_divisiones_from_pais( 0 );"></select>
                                </div>

                                <div class="span4 campo-club-jugador-libre-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a">División club (Último) </a>
                                    <select class="green-input select-division-form" id="division_club_jugadorlibre_otro" name="division_club_jugadorlibre_otro" onchange="chequear_datos_form_fichajugador();"></select>
                                </div>

                                <div class="span4 campo-club-jugador-libre-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a">Club (Último)</a>
                                    <input class="green-input" id="nombre_club_jugadorlibre_otro" name="nombre_club_jugadorlibre_otro" onkeyup="chequear_datos_form_fichajugador();"/>
                                </div>  

                                <div class="span4 campo-club-jugador-libre-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a">Entrenador (Último)</a>
                                    <input class="green-input" id="entrenador_club_jugadorlibre_otro" name="entrenador_club_jugadorlibre_otro" onkeyup="chequear_datos_form_fichajugador();"/>
                                </div>                                                                                          
                                <!-- ====================== Fin de los campos class="campo-club-jugador-libre-otro" ====================== -->  

                                <!-- ======================================================================== -->
                                <div class="span4 campo-jugador-en-club" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        País club actual
                                    </a>
                                    <!-- select-pais-form <- Esta clase agrega valores al select -->
                                    <select class="green-input select-pais-form select-pais-dinamico" id="pais_club_actual" name="pais_club_actual" onchange="get_divisiones_from_pais( 1 );"></select>
                                </div> 
                                <!-- ======================================================================== -->
                                <div class="span4 campo-jugador-en-club" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">División club actual</p></div></a>
                                    <!-- select-division-form <- Esta clase agrega valores al select -->
                                    <select class="green-input select-division-form select-division-dinamico" id="division_club_actual" name="division_club_actual" onchange="get_clubes_from_paisdivision();">
                                        <option value="">Seleccione primero un país</option>
                                    </select>
                                </div>                                                      

                                <!-- ************************************************************************************************************************ -->
                                <div class="span4 campo-jugador-en-club" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Club actual
                                    </a>
                                    <select class="green-input select-idclub-dinamico" id="idclub_actual_jugadorenclub" name="idclub_actual_jugadorenclub" onchange="chequear_datos_form_fichajugador();"></select>
                                </div>

                                <!-- ====================== Inicio de los campos class="campo-club-jugadorenclub-otro" ====================== -->
                                <div class="span4 campo-club-jugadorenclub-otro" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> País club </a>
                                    <!-- select-pais-form <- Esta clase agrega valores al select -->
                                    <select class="green-input select-pais-form" id="pais_club_jugadorenclub_otro" name="pais_club_jugadorenclub_otro" onchange="get_divisiones_from_pais( 2 );"></select>
                                </div>

                                <div class="span4 campo-club-jugadorenclub-otro" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a">División club </a>
                                    <select class="green-input select-division-form" id="division_club_jugadorenclub_otro" name="division_club_jugadorenclub_otro" onchange="chequear_datos_form_fichajugador();"></select>
                                </div>

                                <div class="span4 campo-club-jugadorenclub-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a">Club</a>
                                    <input class="green-input" id="nombre_clubenclub_jugadorenclub_otro" name="nombre_clubenclub_jugadorenclub_otro" onkeyup="chequear_datos_form_fichajugador();"/>
                                </div>  

                                <div class="span4 campo-club-jugadorenclub-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a">Entrenador</a>
                                    <input class="green-input" id="entrenador_club_jugadorenclub_otro" name="entrenador_club_jugadorenclub_otro" onkeyup="chequear_datos_form_fichajugador();"/>
                                </div>                                                                                          
                                <!-- ====================== Fin de los campos class="campo-club-jugadorenclub-otro" ====================== -->                              
                                <!-- ======================================================================== -->
                                <div class="span4 campo-jugador-en-club" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"><div><p class="ellipsis-text" style="font-weight: normal;">Contrato Profesional</p></div></a>
                                    <select class="green-input" id="contrato_pro_jugadorclub" name="contrato_pro_jugadorclub" onchange="chequear_datos_form_fichajugador();">
                                        <option value="">Seleccione</option>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div> 
                                <!-- ======================================================================== -->
                                <div class="span4 campo-jugador-en-club" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Situación en el club actual</p></div></a>
                                    <select class="green-input" id="situ_clubactual_jugadorclub" name="situ_clubactual_jugadorclub" onchange="campos_ficha_jugador();">
                                        <option value="">Seleccione</option>
                                        <option value="1">A préstamo</option>
                                        <option value="2">Pertenece al club</option>
                                    </select>
                                </div>                                                      

                                <!-- ************************************************************************************************************************ -->
                                <div class="span4 campo-jugador-prestamo campo-jugador-en-club campo-situacion-club-actual" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Fecha fin préstamo</p></div></a>
                                    <input readonly class="green-input date-picker" id="fechafin_prestamo_jugadorclub" name="fechafin_prestamo_jugadorclub" onchange="chequear_datos_form_fichajugador();"/>
                                </div>
                                <!-- ======================================================================== -->
                                <div class="span4 campo-jugador-prestamo campo-jugador-en-club campo-situacion-club-actual" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Su pase pertenece a</p></div></a>
                                    <input class="green-input" id="pase_pertenencia_jugadorclub" name="pase_pertenencia_jugadorclub" onkeyup="chequear_datos_form_fichajugador();"/>
                                </div> 
                                <!-- ======================================================================== -->
                                <div class="span4 campo-jugador-en-club campo-situacion-club-actual" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Fin contrato
                                    </a>
                                    <input readonly class="green-input date-picker" id="fechafin_contrato_jugadorclub" name="fechafin_contrato_jugadorclub" onchange="chequear_datos_form_fichajugador();"/>
                                </div>                                                      

                                <!-- ************************************************************************************************************************ -->
                                <div class="span4 campo-jugador-en-club campo-situacion-club-actual" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Valor de mercado</p></div></a>
                                    <input class="green-input" id="valor_mercado_jugadorclub" name="valor_mercado_jugadorclub" onkeyup="chequear_datos_form_fichajugador();"/>
                                </div>
                                <!-- ======================================================================== -->
                                <div class="span4 campo-jugador-en-club campo-situacion-club-actual" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Cláusula de salida</p></div></a>
                                    <select class="green-input" id="clausula_salida_jugadorclub" name="clausula_salida_jugadorclub" onchange="campos_ficha_jugador();">
                                        <option value="0">Seleccione</option>
                                        <option value="1">Sí</option>
                                        <option value="2">No</option>
                                    </select>
                                </div> 
                                <!-- ======================================================================== -->
                                <div class="span4 campo-jugador-en-club campo-situacion-club-actual" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Valor cláusula
                                    </a>
                                    <input class="green-input" id="valor_clausula_jugadorclub" name="valor_clausula_jugadorclub" onkeyup="chequear_datos_form_fichajugador();"/>
                                </div> 

                                <!-- ======================================================================== -->
                                <div class="span4 campo-representante" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Representante
                                    </a>
                                    <input class="green-input" id="representante_jugadorclub" name="representante_jugadorclub" onkeyup="chequear_datos_form_fichajugador();"/>
                                </div>                                                                                      

                                <!-- Salto de línea -->
                                <div class="div-break"></div>

                                <!-- ************************************************************************************************************************ -->                       
                                <div class="span12" style="display: flex; margin-left: 2.5%;">
                                    <table style="width: 95.2%; margin-bottom: 15px;">
                                        <thead>
                                            <tr>
                                                <th class="th-textarea">Observaciones</th>
                                            </tr> 
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width: 100%; padding: 0px;">
                                                    <div class="span12" style="display: flex; width: 100%;">
                                                        <textarea onkeyup="chequear_datos_form_fichajugador();" style="resize: none;" class="textarea-social" name="observaciones_jugadorclub" id="observaciones_jugadorclub" rows="10"></textarea>
                                                    </div>
                                                </td>                                                  
                                            </tr>
                                        </tbody>
                                    </table>     
                                </div>
                                
                            </div>  


                            </div>                                          
                        
                        <!-- ************************************************************************************************************************ -->                                                                   
            </form>        
            <!-- ========================================== Fin del id="formulario_ficha_jugador" ========================================== -->                    
                
                    </div>
                    <!-- ================================================= Fin del id="tab_form_fichajugador" ================================================= -->

                    <!-- ================================================= Inicio del id="tab_form_partido" ================================================= -->
                    <div class="tab-pane" id="tab_form_partido">
                        <!-- ================================================= Inicio del id="formulario_partido_jugador" ================================================= -->
                        <form id="formulario_partido_jugador" style="display: none;">
                            <div class="row-fluid div-datos-partido">

                                <div class="span4" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Fecha Partido
                                    </a>
                                    <input readonly class="green-input date-picker" id="fecha_jugadorpartido" name="fecha_jugadorpartido" onchange="chequear_datos_form_partidojugador();" />
                                </div>

                                <div class="span4" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Campeonato
                                    </a>
                                    <select class="green-input select-campeonato" id="idcampeonato" name="idcampeonato" onchange="get_clubes_from_paiscampeonato();"></select>
                                </div> 

                                <!-- ====================== Inicio de los campos class="campo-campeonato-otro" ====================== -->
                                <div class="span4 campo-campeonato-otro" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">País campeonato</p></div></a>
                                    <!-- select-pais-form <- Esta clase agrega valores al select -->
                                    <select class="green-input select-pais-form" id="pais_campeonato_otro" name="pais_campeonato_otro" onchange="get_divisiones_from_pais( 8 );"></select>
                                </div>

                                <div class="span4 campo-campeonato-otro" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">División campeonato</p></div></a>
                                    <select class="green-input select-division-form" id="division_campeonato_otro" name="division_campeonato_otro" onchange="chequear_datos_form_partidojugador();"></select>
                                </div>

                                <div class="span4 campo-campeonato-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Nombre campeonato</p></div></a>
                                    <input class="green-input" id="nombre_campeonato_otro" name="nombre_campeonato_otro" onkeyup="chequear_datos_form_partidojugador();" />
                                </div>  

                                <div class="span4 campo-campeonato-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Organizador campeonato</p></div></a>
                                    <input class="green-input" id="organizador_campeonato_otro" name="organizador_campeonato_otro" onkeyup="chequear_datos_form_partidojugador();" />
                                </div>                                                                                          
                                <!-- ====================== Fin de los campos class="campo-campeonato-otro" ====================== -->

                                <div class="span4" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Temporada
                                    </a>
                                    <input class="green-input" id="temporada_jugadorpartido" name="temporada_jugadorpartido" onkeyup="chequear_datos_form_partidojugador();" />
                                </div> 

                                <div class="span4" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Jornada
                                    </a>
                                    <input class="green-input" id="jornada_jugadorpartido" name="jornada_jugadorpartido" onkeyup="chequear_datos_form_partidojugador();" />
                                </div>          

                                <div class="span4" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        *Rival
                                    </a>
                                    <!-- <select class="green-input select-club" id="idclub_rival" name="idclub_rival" onchange="chequear_datos_form_partidojugador();"></select> -->
                                    <select class="green-input" id="idclub_rival" name="idclub_rival" onchange="chequear_datos_form_partidojugador();">
                                        <option value="">Seleccione primero un campeonato</option>
                                        <option value="000">Otro</option>
                                    </select>
                                </div>

                                <!-- ====================== Inicio de los campos class="campo-club-rival-otro" ====================== -->
                                <div class="span4 campo-club-rival-otro" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> País club rival</a>
                                    <!-- select-pais-form <- Esta clase agrega valores al select -->
                                    <select class="green-input select-pais-form" id="pais_club_rival_otro" name="pais_club_rival_otro" onchange="get_divisiones_from_pais( 3 );"></select>
                                </div>

                                <div class="span4 campo-club-rival-otro" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">División club rival</p></div></a>
                                    <select class="green-input select-division-form" id="division_club_rival_otro" name="division_club_rival_otro" onchange="chequear_datos_form_partidojugador();"></select>
                                </div>

                                <div class="span4 campo-club-rival-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a">Club rival</a>
                                    <input class="green-input" id="nombre_club_rival_otro" name="nombre_club_rival_otro" onkeyup="chequear_datos_form_partidojugador();" />
                                </div>  

                                <div class="span4 campo-club-rival-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Entrenador rival</p></div></a>
                                    <input class="green-input" id="entrenador_club_rival_otro" name="entrenador_club_rival_otro" onkeyup="chequear_datos_form_partidojugador();" />
                                </div>                                                                                          
                                <!-- ====================== Fin de los campos class="campo-club-rival-otro" ====================== -->

                                <div class="span4" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Posición
                                    </a>
                                    <select class="green-input select-posicion-jugador-form" id="posicion_jugadorpartido" name="posicion_jugadorpartido" onchange="chequear_datos_form_partidojugador();"></select>
                                </div> 

                                <div class="span4" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        *Tit/Sup
                                    </a>
                                    <select class="green-input" id="tit_sup_nc_jugadorpartido" name="tit_sup_nc_jugadorpartido" onchange="chequear_datos_form_partidojugador();">
                                        <option value="">Seleccione</option>
                                        <option value="1">Titular</option>
                                        <option value="2">Suplente</option>
                                        <option value="3">No compite</option>
                                    </select>
                                </div>                                                                                                                                              
                            </div>

                            <center>
                                <div style="width: 92%; margin: auto; display: none;" class="mensaje_registrarjugador_formpartido">
                                    <p style="top: 25px; position: relative; display: inline-block; color: rgb(4, 4, 4);">
                                        <b style="text-transform: uppercase;color: #292727;">!NOTA: </b><span style="text-decoration: underline;"> primero debe registrar jugadores</span> <span>antes de registrar partidos</span>!
                                    </p>
                                </div>                              
                            </center>
                        
                            <div style="width: 92%; margin: auto; margin-top: 90px; margin-bottom: 25px;">
                                <h4 style="text-align: center; color: black; text-transform: uppercase;">estadísticas</h4>
                            </div>

                            <!-- ================================================ Inicio del div para imagen e input para indicar la cantidad de goles - Tabla de estadísticas ================================================ -->
                            <div class="row-fluid" style="width: 92%; margin: auto; margin-bottom: 50px;">
                                
                                <!-- ========================== Inicio del div para imagen e input para indicar la cantidad de goles ========================== -->
                                <div class="span6" style="width: 40%; /*display: inline-block;*/">
                                    <center>
                                        <div style="margin-bottom: 20px;">
                                            <img id="foto_1_club_jugador_partido" src="../config/default.png" style="width: 30px;position: relative;right: 10px;">
                                            <input type="text" id="gol_equipo1_jugadorpartido" name="gol_equipo1_jugadorpartido" style="width: 20px;border: 1px solid <?php echo $color_fondo; ?>;" maxlength="2" onkeyup="chequear_datos_form_partidojugador();"> 
                                            <div style="font-size: 30px;position: relative;top: 5px;font-weight: bold;width: 40px;display: inline-block;">-</div>
                                            <input type="text" id="gol_equipo2_jugadorpartido" maxlength="2" name="gol_equipo2_jugadorpartido" style="width: 20px;border: 1px solid <?php echo $color_fondo; ?>;" onkeyup="chequear_datos_form_partidojugador();">
                                            <img id="foto_1_club_rival_partido" src="../config/default.png" style="width: 30px;position: relative;left: 10px;">                                        
                                        </div>
                                    </center>

                                    <div>
                                        <center>
                                            <div style="z-index: 100;position: relative;top: 60px;">
                                                <div style="position: relative; top: -10px;">
                                                    <img id="foto_2_club_jugador_partido" src="../config/default.png" style="width: 60px; height: 60px;">
                                                    <img src="../config/balon.png" style="width: 30px;">
                                                    <img id="foto_2_club_rival_partido" src="../config/default.png" style="width: 60px; height: 60px;">                                                     
                                                </div>
                                                <div style="background-color: <?php echo $color_fondo; ?>; width: 90%; border-radius: 5px; position: relative; top: 10px;">
                                                    <div style="padding: 10px;">
                                                        <input class="input-label-match" type="radio" id="condicion_local_jugadorpartido" name="condicion_jugadorpartido" value="1" onclick="chequear_datos_form_partidojugador();">
                                                        <label class="input-label-match" for="male">Local</label>
                                                        <input class="input-label-match" type="radio" id="condicion_visita_jugadorpartido" name="condicion_jugadorpartido" value="2" onclick="chequear_datos_form_partidojugador();">
                                                        <label class="input-label-match" for="female">Visita</label>
                                                        <input class="input-label-match" type="radio" id="condicion_neutral_jugadorpartido" name="condicion_jugadorpartido" value="3" onclick="chequear_datos_form_partidojugador();">
                                                        <label class="input-label-match" for="other">Neutral</label>
                                                    </div>                                      
                                                </div>                                  
                                            </div>
                                        </center>                               

                                        <center>
                                            <div style="height: 100px;">
                                                <img src="../config/cancha-scouting.png" style="width: 100%;height: 250px;margin: 0;position: relative;top: -120px;">
                                            </div>
                                        </center>                                   
                                    </div>
                                </div>
                                <!-- ========================== Fin del div para imagen e input para indicar la cantidad de goles ========================== -->
                                
                                <!-- ========================== Inicio del div para tabla de estadísticas ========================== -->
                                <div class="span6" style="width: 60%; margin: 0;">

                                    <table class="table-striped" style="width:100%; margin-bottom: 100px; margin: auto; border: 1px solid dimgray;" id="">
                                        <thead>
                                            <tr style="background-color:#2e2c2c; color:white;height:30px;">
                                                <th scope="col" style="cursor:pointer; padding-top:5px; padding-bottom:5px; text-align: center; width: 350px;">
                                                    <div class="tip-top" data-original-title="Jugador" style="width:100%;">TITULARES</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                    <div class="tip-top" data-original-title="Tarjetas Amarillas" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/yellow-card-hand.png"></center></div>                                              
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                    <div class="tip-top" data-original-title="Dobles Tarjetas Amarillas" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/double-yellow-card.png"></center></div> 
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                    <div class="tip-top" data-original-title="Tarjetas Rojas" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/red-card-hand.png"></center></div> 
                                                </th>                                                                                       
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 80px;">
                                                    <div class="tip-top" data-original-title="Goles" style="width:100%;"><center><img src="../config/balon.png" style="width: 19px"></center></div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                    <div class="tip-top" data-original-title="Minuto de entrada" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/green-arrow-facing-right.png" style="transform: rotate(90deg);"></center></div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                    <div class="tip-top" data-original-title="Minuto de salida" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/red-arrow.png" style="    transform: rotate(270deg);"></center></div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 300px;">
                                                    <div class="tip-top" data-original-title="Minutos jugados" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/min-jugados.png"></center></div>
                                                </th>                                                                                                                                   
                                            </tr>
                                        </thead>
                                       <tbody>
                                            <tr style="cursor: pointer;">
                                                
                                                <td style="width: 200px; max-width: 200px;">
                                                    <div class="div-club-table" style="text-align: left; max-width: 250px;">
                                                        <div class="img-next-to-text">
                                                            <img class="foto-jugador-partido" src="" style="width: 25px;border-radius: 50%;border: solid 2px;height:25px;display: block;margin: auto;">
                                                        </div>
                                                        <div style="float: right;width: 80%;">
                                                            <p class="ellipsis-text nombre-jugador-partido" style="text-transform: uppercase; font-weight: bold; color: black; margin: 0; text-align: left; position: relative; top: 5px;"></p>
                                                        </div>
                                                    </div>
                                                </td> 
                                                
                                                <td><center><input type="text" style="width: 25px;" id="t_amarilla_jugadorpartido" name="t_amarilla_jugadorpartido" maxlength="1" onkeyup="chequear_datos_form_partidojugador();"></center></td>

                                                <td><center><input type="text" style="width: 25px;" id="t_amarilladb_jugadorpartido" name="t_amarilladb_jugadorpartido" maxlength="1" onkeyup="chequear_datos_form_partidojugador();"></center></td>
                                                
                                                <td><center><input type="text" style="width: 25px;" id="t_roja_jugadorpartido" name="t_roja_jugadorpartido" maxlength="1" onkeyup="chequear_datos_form_partidojugador();"></center></td>
                                                
                                                <td><center><input type="text" style="width: 25px;" id="num_gol_jugadorpartido" name="num_gol_jugadorpartido" placeholder="nº" maxlength="2" onkeyup="chequear_datos_form_partidojugador();"></center></td>
                                                
                                                <td><center><input type="text" style="width: 25px; background-color: <?php echo $color_fondo; ?>;" id="min_entrada_jugadorpartido" name="min_entrada_jugadorpartido" placeholder="min" maxlength="3" onkeyup="calcular_minutos_jugados();"></center></td>
                                                
                                                <td><center><input type="text" style="width: 25px;" id="min_salida_jugadorpartido" name="min_salida_jugadorpartido" placeholder="min" maxlength="3" onkeyup="calcular_minutos_jugados();"></center></td>
                                                <td><center><b id="min_jugados_jugadorpartido_text" style="color: black; position: relative; top: -4px;">0 minutos</b><input type="hidden" style="width: 25px;" id="min_jugados_jugadorpartido" name="min_jugados_jugadorpartido" maxlength="3"></center></td>

                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr><td colspan="9"></td></tr>
                                        </tfoot>
                                    </table>                                
                                </div>
                                <!-- ========================== Fin del div para tabla de estadísticas ========================== -->

                            </div>
                            <!-- ================================================ Fin del div para imagen e input para indicar la cantidad de goles - Tabla de estadísticas ================================================ -->

                            <button id="boton-agregar-partido" onclick="boton_guardar_partido();">guardar partido</button>

                        </form>     
                        <!-- ================================================= Fin del id="formulario_partido_jugador" ================================================= -->  

                            <div style="margin-bottom: 50px;">

                                <div class="row-fluid" style="margin-top: 90px; width: 95%; margin: auto;">
                                    <h4 style="color: black; text-transform: uppercase; text-align: center;margin: 0; font-size: 13px;">Análisis de partidos</h4>
                                    <button style="margin-bottom:10px;margin-top: -20px;float:right;" class="boton_informe_jugador" onclick="boton_agregar_partido();"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar partido</b></button>            
                                </div>  

                                <!-- ================================================ Inicio del class="tabla_partidos_jugador" ================================================ -->
                                <table class="table-striped tabla_partidos_jugador" style="width:95%; margin-bottom: 100px; margin: auto; font-size: 10px;" vista-modal-partido='0'>
                                    <thead>
                                        <tr style="background-color:#555555; color:white;height:30px; ">                                        
                                            <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; border-right: 1px solid;">
                                                <div class="tip-top" data-original-title="Fecha" style="width: 60px;">FECHA</div>
                                            </th>
                                            <th scope="col" style="cursor:pointer;padding:0px;border-right: 1px solid;width: 120px;">
                                                <div class="tip-top" data-original-title="Club" style="width: 90px;">CLUB</div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid;">
                                                <div class="tip-top" data-original-title="Campeonato" style="width: 90px;">
                                                    CAMPEONATO
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid;">
                                                <div class="tip-top" data-original-title="Jornada" style="width:70px;">
                                                    JORNADA
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 65px;">
                                                <div class="tip-top" data-original-title="Condición" style="width:60px;">
                                                    COND
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer;padding:0px;border-right: 1px solid;width: 120px;">
                                                <div class="tip-top" data-original-title="Rival" style="width: 50px;">
                                                    RIVAL
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer;padding:0px;border-right: 1px solid;width: 100px;">
                                                <div class="tip-top" data-original-title="Resultado" style="width: 85px;">
                                                    RESULTADO
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid;">
                                                <div class="tip-top" data-original-title="Posición" style="width:100%;">
                                                    POS
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer;padding:0px;border-right: 1px solid;width: 80px;">
                                                <div class="tip-top" data-original-title="Titula/Suplente" style="/*width: 55px;*/width: 80px;">
                                                    TIT / SUP/ NC
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 40px;">
                                                <div class="tip-top" data-original-title="%." style="width: 40px;">
                                                    MIN
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 30px;">
                                                <div class="tip-top" data-original-title="Minuto de entrada" style="width:30px;"><center style="margin: auto;display: block;width: 15px;"><img src="../config/green-arrow-facing-right.png"></center></div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 30px;">
                                                <div class="tip-top" data-original-title="Goles" style="width:30px;"><center><img src="../config/balon.png" style="width: 15px;"></center></div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 30px;">
                                                <div class="tip-top" data-original-title="Tarjeta Amarilla" style="width: 30px;"><div style="display:inline-block;" class="tarjetaAmarilla"></div></div>
                                            </th>                                       
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 30px;">
                                                <div class="tip-top" data-original-title="Tarjeta Roja" style="width:30px;"><div style="display:inline-block;" class="tarjetaRoja"></div></div>
                                            </th>
                                            <th scope="col" style="cursor:pointer;  border-top-right-radius:5px;" colspan="2"></th>
                                        </tr>
                                   </thead>
                                   <tbody></tbody>
                                    <tfoot>
                                        <tr><td colspan="16" style="border-bottom: 1px solid"></td></tr>
                                    </tfoot>
                                </table>
                                <!-- ================================================ Fin del class="tabla_partidos_jugador" ================================================ -->                           
                            </div>
                          
                    </div>
                    <!-- ================================================= Fin del id="tab_form_partido" ================================================= -->

                  </div>
                </div>              
            </div>

            <div class="span12" style="margin-top: 20px;">
                <center>
                    <button type="submit" class="boton_gestionar_cargos" onclick="boton_guardar_ficha_jugador();" id="boton_agregar_ficha_jugador">
                        <i class="icon-save"></i> GUARDAR FICHA JUGADOR
                    </button>
               </center>     
            </div>  

        <center>
            <div class="row-fluid" style="margin-top:0px;">
                <div class="span12" style="margin: 0px;">
                    <button class="boton_volver" onclick="bntvolver_desde_form_jugador();" style="float:left; margin:0px; margin-top: 20px;">
                        <i class="icon-arrow-left"></i> volver
                    </button>                      
                </div>          
            </div> 
        </center>

        </div>
    </div>      
</div>
<!-- ========================================== Fin del id="cuadro_form_agregar_jugador" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_informes_seguimiento_jugador" ========================================== -->
<div style="margin: -41px -22px 0px -20px; display: none;" id="cuadro_informes_seguimiento_jugador">

    <!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
    <div class="cuadro_buscar_titulo" style="background-image: url('../config/banner-scouting-informe.png'); background-size: cover; height: 190px; margin-top: -10px">
        
        <div class="row-fluid">
            <div style="padding:0px; margin:0px; margin-top: -20px;">

                <div>
                    <div>
                        <div style="position: relative; width: 30px; top: 50px; left: 55px; height: 55px; background-color: white; transform: skew(170deg);"></div>        
                    </div>
                    <div style="position: relative; top: -15px;">
                        <div style="display: inline-block; position: relative; top: 3px;">
                            <h5 class="nombre-jugador" style="margin-top: 0px; color: white; padding: 0px 0px 0px 100px; font-size: 20px; line-height: 7px; text-transform: capitalize; font-weight: normal; display: inline-block;"></h5>
                            <h5 class="apellido-jugador" style="display: inline-block; top: 0px; color: white; font-size: 20px; line-height: 7px; text-transform: capitalize; font-weight: bold;"></h5>                            
                        </div>
                        <img class="bandera-pais-jugador-banner" src="" style="position: relative; left: 10px; top: -5px; /*border-radius: 10px; width: 30px;*/">
                        <h5 class="datos-jugador" style="margin-top: 0px; color: white; padding: 15px 0px 0px 100px; font-size: 15px; text-transform: capitalize; font-weight: normal;"></h5>
                    </div>

                </div>

                <br>
                
                <div style="position: relative; top: -25px;">
                    <img src="../config/estatura-1.png" class="img-datos-jugador">
                    <span class="datos-jugador-small">Estatura: <span class="estatura-banner" style="font-weight: bold;"></span> </span>
                    <br>
                    
                    <img src="../config/birthday_1.png" class="img-datos-jugador">
                    <span class="datos-jugador-small">Fecha de Nacimiento: <span class="edad-jugador-banner"></span></span>
                    <br>
                    
                    <img src="../config/soccer_shoes_1.png" class="img-datos-jugador">
                    <span class="datos-jugador-small">Lateralidad: <span class="lateralidad-banner" style="font-weight: bold;"></span> </span>                 
                </div>

                <div style="position: relative; /*width: 350px;*/ margin: 0;float: right;right: 5%;/* display: flex; */top: -105px;">
                    <h5 style="color: black; font-size: 16px; line-height: 7px;text-transform: capitalize; display: block;margin: 0; display: inline-block; font-weight: normal;">
                        Club Actual: <span class="nombre-club-banner" style="font-weight: bold;"></span> 
                    </h5>
                    <img class="foto-club-banner" src="foto_clubes/globe_flags_earth.png" style="width: 30px;/* position: relative; *//* left: 35px; *//* top: -20px; */display: inline-block;position: relative;top: -5px;">
                </div>            

            </div>            
        </div>
         
        <div class="row-fluid" style="margin: 35px;">
            <input type="hidden" name="cantidad_total_sesiones" id="cantidad_total_sesiones" autocomplete="off" value="">
            <center>
                <img class="imagen-jugador" style="width: 160px; border-radius: 50%; border: solid 2px; height: 155px; border: 1px white solid; position: relative; top: -250px;">

                <!-- Valor de las fotos del jugador y del club -->
                <input type="hidden" class="input-hidden-fotojugador" />
                <input type="hidden" class="input-hidden-nombrejugador" />
                <input type="hidden" class="input-hidden-apellidojugador" />
                <input type="hidden" class="input-hidden-fotoclub" />

            </center>
        </div>
        
        <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
    </div>  
    <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
    
    <!-- <hr style="width: 95%; margin-left: auto; margin-right: auto; margin-bottom: 30px; border-bottom: 1px solid #c4c4c4;" /> -->

    <!-- ================= Inicio del class="fluid cuadro_buscar_buscar" ================= -->
    <div class="row-fluid cuadro_buscar_buscar" style="/*width: 93%;*/ width: 97%; margin: auto; margin-top: 20px;">

        <div style="width:100%; background-color: <?php echo $color_fondo; ?> height:20px; border-radius: 4px;"></div>

        <button class="boton_volver" onclick="boton_volver_cuadro_jugadores_seguimiento();" style="position: relative; top: 25px;">
            <i class="icon-arrow-left"></i> volver
        </button>       
                                    
        <center>
            <div style="margin:0px; height:20px;">
                <img src="../config/cargando_buscar.gif" id="cargando_buscar_informes_seguimiento" style="display: none;">
                <span style="color: rgb(220, 78, 78); display: none;" id="error_conexion_informes_seguimiento"><b>Error:</b> conexión a internet deficiente.</span>
                <span style="color:<?php echo $color_fondo; ?>; display:block;" id="sin_resultados_informes_seguimiento">Busqueda sin resultados.</span>
                <button class="boton_refresh" id="boton_refresh_informes_seguimiento" onclick="buscar_informes_partido_jugador();" style="margin-left:10px;"><i class="icon-refresh"></i></button>
            </div>
        </center>       

        <div class="row-fluid" style="/*margin-top: 90px;*/">
            <button style="margin-bottom:10px;margin-top: -20px;float:right;" class="boton_informe_jugador" onclick="btn_ir_form_agregarinforme_seguimiento();"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar informe</b></button>            
        </div>
                            
        <!-- ================= Inicio del class="row-fluid" ================= -->
        <div class="row-fluid" style="margin-top:0px;">
            <!-- ================= Inicio del class="span12" ================= -->
            <div class="span12" style="margin: 0px;"> 
                <!-- ================= Inicio del id="tabla_informes_seguimiento_jugador" ================= -->  
                <table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_informes_seguimiento_jugador">
                    <thead>
                        <tr style="background-color:#555555; color:white;">
                            <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 40px; text-align: left;">
                                <div class="tip-top" data-original-title="Número" style="width:100%; margin-left: 10px;">#</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 100px;">
                                <div class="tip-top" data-original-title="Fecha" style=" cursor: pointer; padding: 0px; text-align: left;">
                                    FECHA
                                </div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 300px; text-align: left;">
                                <div class="tip-top" data-original-title="Nombre del Informe" style="width:100%;">NOMBRE INFOME</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 150px; text-align: left;">
                                <div class="tip-top" data-original-title="Realizado por" style="width:100%;">REALIZADO POR</div>
                            </th>                                                
                            <th scope="col" style="cursor:pointer; padding:0px; width: 150px; text-align: left;">
                                <div class="tip-top" data-original-title="Tipo de Informe" style="width:100%;">TIPO INFORME</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 300px; text-align: left;">
                                <div class="tip-top" data-original-title="Observación" style="width:100%;">OBSERVACIÓN</div>
                            </th>           
                            <th scope="col" style="cursor:pointer; padding:0px; border-top-right-radius:5px; width:140px;" colspan="3"></th>
                        </tr>
                    </thead>
                                        
                    <tbody><!-- AQUÍ SERÁN INSERTADOS CON JS --></tbody>
                                        
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
                <!-- ================= Fin del id="tabla_informes_seguimiento_jugador" ================= -->
            </div>
            <!-- ================= Fin del class="span12" ================= -->
        </div>
        <!-- ================= Fin del class="row-fluid" ================= -->


        <!-- ================= Inicio del class="row-fluid" ================= -->
        <div class="row-fluid tdatos-jugador-informe-scouting" style="margin-top:30px;">

            <!-- ================= Inicio del class="span14" ================= -->
            <div class="span4" style="margin: 0px;width: 27%;/*width: 30%;*/float: left;background-color: white;"> 
                <!-- ================= Inicio del id="t_jugador_generales" ================= -->  
                <table style="border: 1px solid #8f8f8f;width:100%;height: 200px;max-height: 200px;" id="t_jugador_generales">
                    <thead>
                        <tr style="background-color:#555555; color:white;">
                            <th colspan="2">GENERALES</th>
                        </tr>
                    </thead>
                    <tbody>                
                        <tr>
                            <th style="">Nombre: </th>
                            <td class="nombre-t-generales"></td>                                                                        
                        </tr>    
                        <tr>
                            <th>Apellido: </th>
                            <td class="apellido-t-generales"></td>                                                                        
                        </tr>       
                        <tr>
                            <th>Fecha Nacimiento: </th>
                            <td class="fecha-nac-t-generales"></td>                                                                        
                        </tr> 
                        <tr>
                            <th></th>
                            <td></td>                                                                        
                        </tr> 
                        <tr>
                            <th></th>
                            <td></td>                                                                        
                        </tr>                                                                                                      
                    </tbody>
                </table>
                <!-- ================= Fin del id="t_jugador_generales" ================= -->
            </div>
            <!-- ================= Fin del class="span4" ================= -->

            <!-- ================= Inicio del class="span14" ================= -->
            <div class="span4" style="border: 1px solid #8f8f8f;/*width: 35%;*/width: 38%;max-height: 200px;height: 200px;background-color: white;"> 
                <div style="width: 100%; background-color: #555555; color: white; font-weight: bold; text-transform: uppercase; text-align: center;">Posición</div>
                <div style="width: 25%;/* background-color: lightblue; */float: left;height: 20px;padding: 2px 8px;"><img src="../config/canchachica.png" style="height: 170px;max-height: 170px;width: 100%;"></div>
                <div style="width: 75%;float: right;">
                    <!-- ================= Inicio del id="" ================= -->  
                    <table style="border: 0px solid #8f8f8f;width:95%; float: right;" id="">
                        <tbody>                
                            <tr>
                                <th></th>
                                <td></td>                                                                        
                            </tr>  
                            <tr style="height: 30px;">
                                <th style="text-indent: 20px;">Posición principal: </th>
                                <td class="t-posicion-principal"></td>                                        
                            </tr>    
                            <tr>
                                <th style="text-indent: 20px;">Posición secundaria: </th>
                                <td class="t-posicion-secundaria"></td>                                  
                            </tr>  
                            <tr>
                                <th></th>
                                <td></td>                                                                        
                            </tr>                                                                                      
                        </tbody>
                    </table>
                    <!-- ================= Fin del id="" ================= -->                    
                </div>
            </div>
            <!-- ================= Fin del class="span4" ================= -->

            <!-- ================= Inicio del class="span14" ================= -->
            <div class="span4" style="width: 30%;float: right;margin: 0;"> 
                <!-- ================= Inicio del id="" ================= -->  
                <table style="height: 200px;border: 1px solid #8f8f8f;width:100%;max-height: 200px;background-color: white;" id="">
                    <thead>
                        <tr style="background-color:#555555; color:white;">
                            <th colspan="2">DATOS ADICIONALES</th>
                        </tr>
                    </thead>
                    <tbody>                
                        <tr>
                            <th>Nacionalidad: </th>
                            <td class="t-add-nacionalidad"></td>                                                                        
                        </tr>    
                        <tr>
                            <th>Lateralidad: </th>
                            <td class="t-add-lateralidad"></td>                                                                        
                        </tr>       
                        <tr>
                            <th>Representante: </th>
                            <td class="t-add-representante"></td>                                                                        
                        </tr>  
                        <tr>
                            <th>Contrato Profesional: </th>
                            <td class="t-add-contratopro"></td>                                                                        
                        </tr>  
                        <tr>
                            <th>Fin contrato: </th>
                            <td class="t-add-fechafin-contrato"></td>                                                                        
                        </tr>                                                                                                      
                    </tbody>
                </table>
                <!-- ================= Fin del id="" ================= -->
            </div>
            <!-- ================= Fin del class="span4" ================= -->

        </div>
        <!-- ================= Fin del class="row-fluid" ================= -->

        <!-- ================= Inicio del class="row-fluid" ================= -->
        <div class="row-fluid" style="margin-top: 30px;background-color: <?php echo $color_fondo; ?>;border-radius: 4px;height: 25px;">
            <p style="color: white;text-align: center;font-weight: bold;font-size: 14px;margin: 3px 0px;"><i class="icon-check" style="margin-right: 5px;"></i>Partidos</p>
        </div>
        <!-- ================= Fin del class="row-fluid" ================= -->

        <!-- ================= Inicio del class="row-fluid" ================= -->
        <div class="row-fluid" style="margin-top: 20px;">
            <!-- ================= Inicio del class="span12" ================= -->
            <div class="span12" style="margin: 0px;"> 
                <!-- ================= Inicio del id="tabla_informes_seguimiento_jugador_partidos" ================= -->  
                <table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_informes_seguimiento_jugador_partidos">
                    <thead>
                        <tr style="background-color:#555555; color:white;">
                            <th scope="col" style="border-top-left-radius: 5px; padding-top: 5px; padding-bottom: 5px; width: 60px; cursor:pointer; text-align: center;">
                                <div class="tip-top" data-original-title="Serie" style=" cursor: pointer; padding: 0px; width: 100px;">SERIE</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 150px;">
                                <div class="tip-top" data-original-title="Fecha" style="width:100%;">FECHA</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px;width: 150px; text-align: left;">
                                <div class="tip-top" data-original-title="Oponente" style="width:100%;">OPONENTE</div>
                            </th>                                                
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                <div class="tip-top" data-original-title="Tipo de Partido" style="width:100%;">TIPO PARTIDO</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                <div class="tip-top" data-original-title="Condición" style="width:100%;">CONDICIÓN</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                <div class="tip-top" data-original-title="Titular o Suplente" style="width:100%;">TIT/SUP</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                <div class="tip-top" data-original-title="Minutos jugados" style="width:100%;">MIN</div>
                            </th>  
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                <div class="tip-top" data-original-title="Tarjetas Amarillas" style="width:100%;">T.A.</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                <div class="tip-top" data-original-title="Tarjetas Rojas" style="width:100%;">T.R.</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                <div class="tip-top" data-original-title="Doble Tarjetas Amarillas" style="width:100%;">D.A.</div>
                            </th> 
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                <div class="tip-top" data-original-title="Goles convertidos" style="width:100%;">GOLES</div>
                            </th> 
                            <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                <div class="tip-top" data-original-title="Sustituto" style="width:100%;">SUST.</div>
                            </th> 
                            <th scope="col" style="cursor:pointer; padding:0px; border-top-right-radius:5px; width: 120px; text-align: center;">
                                <div class="tip-top" data-original-title="Resultado" style="width:100%;">RESULTADO</div>
                            </th>                        
                            <!--
                            <th scope="col" style="cursor:pointer; padding:0px; border-top-right-radius:5px; width:140px;" colspan="3"></th>
                            -->
                        </tr>
                    </thead>
                                        
                    <tbody><!-- AQUÍ SERÁN INSERTADOS CON JS --></tbody>
                                        
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
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px; "></th>
                        </tr>
                    </tfoot>

                </table>
                <!-- ================= Fin del id="tabla_informes_seguimiento_jugador_partidos" ================= -->
            </div>
            <!-- ================= Fin del class="span12" ================= -->
        </div>
        <!-- ================= Fin del class="row-fluid" ================= -->

    </div>
    <!-- ================= Fin del class="fluid cuadro_buscar_buscar" ================= -->
</div>
<!-- ========================================== Fin del id="cuadro_informes_seguimiento_jugador" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_form_guardar_informe_seguimento" ========================================== -->
<div style="display: none;" id="cuadro_form_guardar_informe_seguimento">
    <!-- ============================= Inicio del id="form_informe_cscouting_jugador" ============================= -->
    <form id="form_informe_cscouting_jugador">
        <!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
        <div class="cuadro_buscar_titulo" style="">
            <center>
                <div style="color:black; font-family:Arial, Helvetica, sans-serif;margin-bottom: 10px">
                    <img class="foto-club-icsj" src="" style="width:100px; margin-top:5px; margin-top:5px; margin-right: 20px; display: inline-block;" />
                    <p style="margin-top: 0px; display: inline-block; color: black; font-size: 20px;" class="nombre-jugador-icsj"> </p> <b class="apellido-jugador-icsj" style="font-size: 20px;"></b>
                    <!-- <input type="hidden" name="" class="idfichaJugador" autocomplete="off" value="2"> -->
                </div>

                <div class="row-fluid" style="margin-top:0px;">
                    <div class="span12" style="margin: 0px;">
                        <div style="width:100%; background-color: <?php echo $color_fondo; ?>; color: white; height:20px; border-radius: 4px;"></div>
                        <img src="" class="foto-jugador-icsj" style="width: 120px; border-radius: 50%; border: solid <?php echo $color_fondo; ?>; 4px; height: 120px; margin-top: -75px; margin-right: 80px; float: right; background-color: white;"> 


                        <button class="boton_volver" onclick="btnvolver_cuadro_informes_seguimiento_jugador();" style="float:left; margin:0px; margin-top: 20px;">
                            <i class="icon-arrow-left"></i> volver
                        </button>    

                        <div style="width: 100%; margin-top: 20px;">
                            <div style="display: block;width: 30%;">
                                <p style="text-align: center; font-size: 13px; font-weight: bold; color: black;">Seleccione el tipo de informe a realizar</p>
                            </div>
                            <div style="display: block;width: 30%;">
                                <a class="btn-md btn-primary gray-a" style="padding: 5px 0px;vertical-align: middle;width: 50%;display: block;float: left;"> Informe</a>
                                <select class="gray-input" style="width: 50%;text-align: center;margin: 0;float: right;" id="tipo_informe_icsj" name="tipo_informe_icsj" onchange="chequear_datos_form_informe_icsj();">
                                    <option value="1" selected>General</option>
                                    <option value="2">Partido</option>
                                </select>
                            </div> 
                        </div>

                    </div>
                </div> 

                <div class="row-fluid" style="margin-top:40px;">
                    <div class="span4" style="display: flex;">
                        <a class="btn btn-md btn-primary gray-a">Fecha</a>
                        <input class="gray-input date-picker" id="fecha_icsj" name="fecha_icsj" readonly onchange="chequear_datos_form_informe_icsj();" />
                    </div>
                    <div class="span4" style="display: flex;">
                        <a class="btn btn-md btn-primary gray-a" style="width: 50%;">Nombre Informe</a>
                        <input class="gray-input" id="nombre_icsj" name="nombre_icsj" onkeyup="chequear_datos_form_informe_icsj();" />
                    </div>                    
                </div> 

                <div class="row-fluid" style="margin-top:20px;">
                    <div class="span12" style="margin: 0px;">
                        <h4 style="text-align: center; text-transform: uppercase;">evaluación del jugador</h4>
                    </div>
                </div> 

                <div class="row-fluid" style="margin-top:20px;">
                    <div class="span12" style="margin: 0px;">
                        <table style="width: 100%; cursor: pointer;" id="tabla-evaluacion-jugador" tipo-informe="">
                            <tr id="tr-toggle-informe">
                                <th style="text-align: center; width: 35px;"><i class="icon-check" style="color: <?php echo $color_fondo; ?>;"></i></td>
                                <th><p style="margin: 0; text-indent: 20px; font-weight: bold;" class="texto-tipo-informe">Evaluación general del jugador</p></td>
                            </tr>
                            <tr class="tr-informe-unbordered">
                                <td colspan="2">
                                    <!-- ========================================== Inicio del id="div-form-informe-general" ========================================== -->
                                    <div id="div-form-informe-general" style="display: none;">

                                        <div style="padding: 10px;">
                                            <!-- ========================================== Inicio del id="tabla_informe_general" ========================================== -->
                                            <table style="width:100%;" id="tabla_informe_general">
                                                                    
                                                <tbody>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo" style="color:#555555;">
                                                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                                            <h5>Aspectos técnicos</h5>
                                                        </td>
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo">
                                                        <td style="width: 100%; padding: 0px;">
                                                            <div class="span12" style="display: flex; width: 100%;">
                                                                <textarea onkeyup="chequear_datos_form_informe_icsj();" style="resize: none; background-color: white;" class="textarea-informe-scouting" name="aspct_tecnico_icsjg" id="aspct_tecnico_icsjg" rows="7" placeholder="Ingrese aspectos técnicos..."></textarea>
                                                            </div>
                                                        </td>                               
                                                    </tr>
                                                    <!-- ============================================================================================================ --> 
                                                    <tr class="sin_fondo" style="color:#555555;">
                                                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                                            <h5>Aspectos tácticos</h5>
                                                        </td>
                                                    </tr>
                                                    <!-- ============================================================================================================ -->  
                                                    <tr class="sin_fondo" style="color:#555555;"> 
                                                        <td style="width: 100%; padding: 0px;">
                                                            <div class="span12" style="display: flex; width: 100%;">
                                                                <textarea onkeyup="chequear_datos_form_informe_icsj();" style="resize: none; background-color: white;" class="textarea-informe-scouting" id="aspct_tactico_icsjg" name="aspct_tactico_icsjg" rows="7" placeholder="Ingrese aspectos tácticos..."></textarea>
                                                            </div>
                                                        </td>                                                    
                                                    </tr>
                                                    <!-- ============================================================================================================ -->   
                                                    <tr class="sin_fondo" style="color:#555555;">
                                                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                                            <h5>Aspectos físicos</h5>
                                                        </td>
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo">
                                                        <td style="width: 100%; padding: 0px;">
                                                            <div class="span12" style="display: flex; width: 100%;">
                                                                <textarea onkeyup="chequear_datos_form_informe_icsj();" style="resize: none; background-color: white;" class="textarea-informe-scouting" id="aspct_fisico_icsjg" name="aspct_fisico_icsjg" rows="7" placeholder="Ingrese aspectos físicos..."></textarea>
                                                            </div>
                                                        </td>                               
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo" style="color:#555555;">
                                                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                                            <h5 style="display: inline-block;">Aspectos Psicológicos</h5>
                                                        </td>                          
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo">
                                                        <td style="width: 100%; padding: 0px;">
                                                            <div class="span12" style="display: flex; width: 100%;">
                                                                <textarea onkeyup="chequear_datos_form_informe_icsj();" style="resize: none; background-color: white;" class="textarea-informe-scouting" id="aspct_psico_icsjg" name="aspct_psico_icsjg" rows="7" placeholder="Ingrese aspectos psicológicos..."></textarea>
                                                            </div>
                                                        </td>                               
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo" style="color:#555555;">
                                                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                                            <h5 style="display: inline-block;">Resumen</h5>
                                                        </td>                          
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo">
                                                        <td style="width: 100%; padding: 0px;">
                                                            <div class="span12" style="display: flex; width: 100%;">
                                                                <textarea onkeyup="chequear_datos_form_informe_icsj();" style="resize: none; background-color: white;" class="textarea-informe-scouting" id="resumen_obsrv_icsjg" name="resumen_obsrv_icsjg" rows="7" placeholder="Ingrese resumen..."></textarea>
                                                            </div>
                                                        </td>                               
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo" style="color:#555555;">
                                                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                                            <h5 style="display: inline-block;">Sugerencias</h5>
                                                        </td>                          
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo">
                                                        <td style="width: 100%; padding: 0px;">
                                                            <div class="span12" style="display: flex; width: 100%;">
                                                                <textarea onkeyup="chequear_datos_form_informe_icsj();" style="resize: none; background-color: white;" class="textarea-informe-scouting" id="sugerencias_icsjg" name="sugerencias_icsjg" rows="7" placeholder="Ingrese sugerencias..."></textarea>
                                                            </div>
                                                        </td>                               
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo" style="color:#555555;">
                                                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                                            <h5 style="display: inline-block;">Proyección</h5>
                                                        </td>                          
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo">
                                                        <td style="width: 100%; padding: 0px;">
                                                            <div class="span12" style="display: flex; width: 100%;">
                                                                <textarea onkeyup="chequear_datos_form_informe_icsj();" style="resize: none; background-color: white;" class="textarea-informe-scouting" id="proyeccion_icsjg" name="proyeccion_icsjg" rows="7" placeholder="Ingrese proyección..."></textarea>
                                                            </div>
                                                        </td>                               
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo" style="color:#555555;">
                                                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                                            <h5 style="display: inline-block;">Exportación</h5>
                                                        </td>                          
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo">
                                                        <td style="width: 100%; padding: 0px;">
                                                            <div class="span12" style="display: flex; width: 100%;">
                                                                <textarea onkeyup="chequear_datos_form_informe_icsj();" style="resize: none; background-color: white;" class="textarea-informe-scouting" id="exportacion_icsjg" name="exportacion_icsjg" rows="7" placeholder="Ingrese exportación..."></textarea>
                                                            </div>
                                                        </td>                               
                                                    </tr>                                                                                                                                                                                             
                                                </tbody>           
                                            </table>                                                                    
                                            <!-- ========================================== Fin del id="tabla_informe_general" ========================================== -->
                                        </div>       

                                    </div>
                                    <!-- ========================================== Fin del id="div-form-informe-general" ========================================== -->    

                                    <!-- ========================================== Inicio del id="div-form-informe-partido" ========================================== -->
                                    <div id="div-form-informe-partido" style="display: none;">
                                        <div style="padding: 10px;">

                        <div class="row-fluid div-datos-partido">

                            <div class="span4" style="display: flex; margin-left: 2.5%;">
                                <a class="btn btn-md btn-primary green-a"> 
                                    Fecha Partido
                                </a>
                                <input class="green-input date-picker" id="fecha_icsjp" name="fecha_icsjp" readonly onchange="chequear_datos_form_informe_icsj();" />
                            </div>

                            <div class="span4" style="display: flex; margin-left: 2.5%;">
                                <a class="btn btn-md btn-primary green-a"> 
                                    Campeonato
                                </a>
                                <select class="green-input select-campeonato" id="idcampeonato_icsjp" name="idcampeonato_icsjp" onchange="get_clubes_from_paiscampeonato_icsjp();"></select>
                            </div> 

                            <!-- ====================== Inicio de los campos class="campo-campeonato-otro" ====================== -->
                            <div class="span4 campo-campeonato-otro" style="display: flex;">
                                <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">País campeonato</p></div></a>
                                <!-- select-pais-form <- Esta clase agrega valores al select -->
                                <select class="green-input select-pais-form" id="pais_campeonato_otro_icsjp" name="pais_campeonato_otro_icsjp" onchange="get_divisiones_from_pais( 10 );"></select>
                            </div>

                            <div class="span4 campo-campeonato-otro" style="display: flex;">
                                <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">División campeonato</p></div></a>
                                <select class="green-input select-division-form" id="division_campeonato_otro_icsjp" name="division_campeonato_otro_icsjp" onchange="chequear_datos_form_informe_icsj();"></select>
                            </div>

                            <div class="span4 campo-campeonato-otro" style="display: flex; margin-left: 2.5%;">
                                <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Nombre campeonato</p></div></a>
                                <input class="green-input" id="nombre_campeonato_otro_icsjp" name="nombre_campeonato_otro_icsjp" onkeyup="chequear_datos_form_informe_icsj();"/>
                            </div>  

                            <div class="span4 campo-campeonato-otro" style="display: flex; margin-left: 2.5%;">
                                <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Organizador campeonato</p></div></a>
                                <input class="green-input" id="organizador_campeonato_otro_icsjp" name="organizador_campeonato_otro_icsjp" onkeyup="chequear_datos_form_informe_icsj();"/>
                            </div>                                                                                          
                            <!-- ====================== Fin de los campos class="campo-campeonato-otro" ====================== -->

                            <div class="span4" style="display: flex; margin-left: 2.5%;">
                                <a class="btn btn-md btn-primary green-a"> 
                                    Temporada
                                </a>
                                <input class="green-input" id="temporada_icsjp" name="temporada_icsjp" onkeyup="chequear_datos_form_informe_icsj();"/>
                            </div>    

                            <div class="span4" style="display: flex; margin-left: 2.5%;">
                                <a class="btn btn-md btn-primary green-a"> 
                                    Jornada
                                </a>
                                <input class="green-input" id="jornada_icsjp" name="jornada_icsjp" onkeyup="chequear_datos_form_informe_icsj();"/>
                            </div>          

                            <div class="span4" style="display: flex; margin-left: 2.5%;">
                                <a class="btn btn-md btn-primary green-a"> 
                                    *Rival
                                </a>
                                <!-- <select class="green-input select-club select-idclub-dinamico" id="idclub_rival_icsjp" name="idclub_rival_icsjp" onchange="chequear_datos_form_informe_icsj();"></select> -->
                                <select class="green-input" id="idclub_rival_icsjp" name="idclub_rival_icsjp" onchange="chequear_datos_form_informe_icsj();">
                                    <option value="">Seleccione primero un campeonato</option>
                                    <option value="000">Otro</option>                                    
                                </select>
                            </div>

                            <!-- ====================== Inicio de los campos class="campo-club-rival-otro" ====================== -->
                            <div class="span4 campo-club-rival-otro" style="display: flex;">
                                <a class="btn btn-md btn-primary green-a"> País club </a>
                                <!-- select-pais-form <- Esta clase agrega valores al select -->
                                <select class="green-input select-pais-form" id="pais_club_rival_otro_icsjp" name="pais_club_rival_otro_icsjp" onchange="get_divisiones_from_pais( 7 );"></select>
                            </div>

                            <div class="span4 campo-club-rival-otro" style="display: flex;">
                                <a class="btn btn-md btn-primary green-a">División club </a>
                                <select class="green-input select-division-form" id="division_club_rival_otro_icsjp" name="division_club_rival_otro_icsjp" onchange="chequear_datos_form_informe_icsj();"></select>
                            </div>

                            <div class="span4 campo-club-rival-otro" style="display: flex; margin-left: 2.5%;">
                                <a class="btn btn-md btn-primary green-a">Club</a>
                                <input class="green-input" id="nombre_club_rival_otro_icsjp" name="nombre_club_rival_otro_icsjp" onkeyup="chequear_datos_form_informe_icsj();"/>
                            </div>  

                            <div class="span4 campo-club-rival-otro" style="display: flex; margin-left: 2.5%;">
                                <a class="btn btn-md btn-primary green-a">Entrenador</a>
                                <input class="green-input" id="entrenador_club_rival_otro_icsjp" name="entrenador_club_rival_otro_icsjp" onkeyup="chequear_datos_form_informe_icsj();"/>
                            </div>                                                                                          
                            <!-- ====================== Fin de los campos class="campo-club-rival-otro" ====================== -->

                            <div class="span4" style="display: flex; margin-left: 2.5%;">
                                <a class="btn btn-md btn-primary green-a"> 
                                    Posición
                                </a>
                                <select class="green-input select-posicion-jugador-form" id="posicion_icsjp" name="posicion_icsjp" onchange="chequear_datos_form_informe_icsj();"></select>
                            </div> 

                            <div class="span4" style="display: flex;">
                                <a class="btn btn-md btn-primary green-a"> 
                                    *Tit/Sup
                                </a>
                                <select class="green-input" id="tit_sup_nc_icsjp" name="tit_sup_nc_icsjp" onchange="chequear_datos_form_informe_icsj();">
                                    <option value="">Seleccione</option>
                                    <option value="1">Titular</option>
                                    <option value="2">Suplente</option>
                                    <option value="3">No compite</option>
                                </select>
                            </div>                                                                                                                                              
                        </div>
                    
                        <div style="width: 92%; margin: auto; margin-top: 100px; margin-bottom: 25px;">
                            <h4 style="text-align: center; color: black; text-transform: uppercase;">estadísticas</h4>
                        </div>

                        <!-- ================================================ Inicio del div para imagen e input para indicar la cantidad de goles - Tabla de estadísticas ================================================ -->
                        <div class="row-fluid" style="width: 92%; margin: auto; margin-bottom: 50px;">
                            
                            <!-- ========================== Inicio del div para imagen e input para indicar la cantidad de goles ========================== -->
                            <div class="span6" style="width: 40%; /*display: inline-block;*/">
                                <center>
                                    <div style="margin-bottom: 20px;">
                                        <img id="foto_1_club_jugador_partido_icsjp" src="" style="width: 30px;position: relative;right: 10px;">
                                        <input type="text" id="golequipo1_icsjp" name="golequipo1_icsjp" style="width: 20px;border: 1px solid <?php echo $color_fondo; ?>;" maxlength="2" onkeyup="chequear_datos_form_informe_icsj();"> 
                                        <div style="font-size: 30px;position: relative;top: 5px;font-weight: bold;width: 40px;display: inline-block;">-</div>
                                        <input type="text" id="golequipo2_icsjp" name="golequipo2_icsjp" style="width: 20px;border: 1px solid <?php echo $color_fondo; ?>;" maxlength="2" onkeyup="chequear_datos_form_informe_icsj();">
                                        <img id="foto_1_club_rival_partido_icsjp" src="" style="width: 30px;position: relative;left: 10px;">                                        
                                    </div>
                                </center>

                                <div>
                                    <center>
                                        <div style="z-index: 100;position: relative;top: 60px;">
                                            <div style="position: relative; top: -10px;">
                                                <img id="foto_2_club_jugador_partido_icsjp" src="" style="width: 60px; height: 60px;">
                                                <img src="../config/balon.png" style="width: 30px;">
                                                <img id="foto_2_club_rival_partido_icsjp" src="" style="width: 60px; height: 60px;">                                                
                                            </div>
                                            <div style="background-color: <?php echo $color_fondo; ?>; width: 90%; border-radius: 5px; position: relative; top: 10px;">
                                                <div style="padding: 10px;">
                                                    <input class="input-label-match" type="radio" id="condicion_icsjp_local" name="condicion_icsjp" value="1" onclick="chequear_datos_form_informe_icsj();">
                                                    <label class="input-label-match" for="male">Local</label>
                                                    <input class="input-label-match" type="radio" id="condicion_icsjp_visita" name="condicion_icsjp" value="2" onclick="chequear_datos_form_informe_icsj();">
                                                    <label class="input-label-match" for="female">Visita</label>
                                                    <input class="input-label-match" type="radio" id="condicion_icsjp_neutral" name="condicion_icsjp" value="3" onclick="chequear_datos_form_informe_icsj();">
                                                    <label class="input-label-match" for="other">Neutral</label>
                                                </div>                                      
                                            </div>                                  
                                        </div>
                                    </center>                               

                                    <center>
                                        <div style="height: 100px;">
                                            <img src="../config/cancha-scouting.png" style="width: 100%;height: 250px;margin: 0;position: relative;top: -120px;">
                                        </div>
                                    </center>                                   
                                </div>
                            </div>
                            <!-- ========================== Fin del div para imagen e input para indicar la cantidad de goles ========================== -->
                            
                            <!-- ========================== Inicio del div para tabla de estadísticas ========================== -->
                            <div class="span6" style="width: 60%; margin: 0;">

                                <table class="table-striped" style="width:100%; margin-bottom: 100px; margin: auto; border: 1px solid dimgray;" id="tabla_informe_datos_partido">
                                    <thead>
                                        <tr style="background-color:#2e2c2c; color:white;height:30px;">
                                            <th scope="col" style="cursor:pointer; padding-top:5px; padding-bottom:5px; text-align: center; width: 350px;">
                                                <div class="tip-top" data-original-title="Jugador" style="width:100%;">TITULARES</div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="Tarjetas Amarillas" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/yellow-card-hand.png"></center></div>                                              
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="Dobles Tarjetas Amarillas" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/double-yellow-card.png"></center></div> 
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="Tarjetas Rojas" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/red-card-hand.png"></center></div> 
                                            </th>                                                                                       
                                            <th scope="col" style="cursor:pointer; padding:0px; width: 80px;">
                                                <div class="tip-top" data-original-title="Goles" style="width:100%;"><center><img src="../config/balon.png" style="width: 19px"></center></div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="Minuto de entrada" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/green-arrow-facing-right.png" style="transform: rotate(90deg);"></center></div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="Minuto de salida" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/red-arrow.png" style="    transform: rotate(270deg);"></center></div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; width: 300px;">
                                                <div class="tip-top" data-original-title="Minutos jugados" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/min-jugados.png"></center></div>
                                            </th>                                                                                                                                   
                                        </tr>
                                    </thead>
                                   <tbody>
                                        <tr style="cursor: pointer;">
                                            <td style="width: 200px; max-width: 200px;">
                                                <div class="div-club-table" style="text-align: left; max-width: 250px;">
                                                    <div class="img-next-to-text">
                                                        <img class="foto-jugador-partido" src="" style="width: 25px;border-radius: 50%;border: solid 2px;height:25px;display: block;margin: auto;">
                                                    </div>
                                                    <div style="float: right;width: 80%;">
                                                        <p class="ellipsis-text nombre-jugador-partido" style="text-transform: uppercase; font-weight: bold; color: black; margin: 0; text-align: left; position: relative; top: 5px;"></p>
                                                    </div>
                                                </div>
                                            </td>  
                                            <td>
                                                <center>
                                                    <input type="text" style="width: 25px;" id="t_amarilla_icsjp" name="t_amarilla_icsjp" maxlength="1" onkeyup="chequear_datos_form_informe_icsj();">
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <input type="text" style="width: 25px;" id="t_amarilladb_icsjp" name="t_amarilladb_icsjp" maxlength="1" onkeyup="chequear_datos_form_informe_icsj();">
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <input type="text" style="width: 25px;" id="t_roja_icsjp" name="t_roja_icsjp" maxlength="1" onkeyup="chequear_datos_form_informe_icsj();">
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <input type="text" style="width: 25px;" id="num_gol_icsjp" name="num_gol_icsjp" placeholder="nº" maxlength="2" onkeyup="chequear_datos_form_informe_icsj();">
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <input type="text" style="width: 25px;" id="min_entrada_icsjp" name="min_entrada_icsjp" placeholder="min" maxlength="3" onkeyup="calcular_minutos_jugados_icsjp();">
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <input type="text" style="width: 25px;" id="min_salida_icsjp" name="min_salida_icsjp" placeholder="min" maxlength="3" onkeyup="calcular_minutos_jugados_icsjp();">
                                                </center>
                                            </td>
                                            <td>
                                                <center>
                                                    <b id="min_jugados_icsjp_text" style="color: black; position: relative; top: -4px;">0 minutos</b><input type="hidden" style="width: 25px;" id="min_jugados_icsjp" name="min_jugados_icsjp" maxlength="3" autocomplete="off">
                                                </center>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr><td colspan="9"></td></tr>
                                    </tfoot>
                                </table>                               
                            </div>
                            <!-- ========================== Fin del div para tabla de estadísticas ========================== -->

                                            <!-- ========================================== Inicio del id="tabla_informe_partido" ========================================== -->
                                            <table style="border: 0px solid #8f8f8f; width:100%; margin-top: 300px;" id="tabla_informe_partido">
                                                                    
                                                <tbody>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo" style="color:#555555;">
                                                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                                            <h5>Observaciones generales del jugador en el partido</h5>
                                                        </td>
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo">
                                                        <td style="width: 100%; padding: 0px;">
                                                            <div class="span12" style="display: flex; width: 100%;">
                                                                <textarea onkeyup="chequear_datos_form_informe_icsj();" style="resize: none; background-color: white;" class="textarea-informe-scouting" name="observaciones_generales_icsjp" id="observaciones_generales_icsjp" rows="7" placeholder="Ingrese observaciones generales..."></textarea>
                                                            </div>
                                                        </td>                               
                                                    </tr>
                                                    <!-- ============================================================================================================ --> 
                                                    <tr class="sin_fondo" style="color:#555555;">
                                                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                                            <h5>Aspectos Ofensivos</h5>
                                                        </td>
                                                    </tr>
                                                    <!-- ============================================================================================================ -->  
                                                    <tr class="sin_fondo" style="color:#555555;"> 
                                                        <td style="width: 100%; padding: 0px;">
                                                            <div class="span12" style="display: flex; width: 100%;">
                                                                <textarea onkeyup="chequear_datos_form_informe_icsj();" style="resize: none; background-color: white;" class="textarea-informe-scouting" id="aspct_ofen_icsjp" name="aspct_ofen_icsjp" rows="7" placeholder="Ingrese aspectos ofensivos..."></textarea>
                                                            </div>
                                                        </td>                                                    
                                                    </tr>
                                                    <!-- ============================================================================================================ -->   
                                                    <tr class="sin_fondo" style="color:#555555;">
                                                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                                            <h5>Aspectos Defensivos</h5>
                                                        </td>
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo">
                                                        <td style="width: 100%; padding: 0px;">
                                                            <div class="span12" style="display: flex; width: 100%;">
                                                                <textarea onkeyup="chequear_datos_form_informe_icsj();" style="resize: none; background-color: white;" class="textarea-informe-scouting" id="aspct_def_icsjp" name="aspct_def_icsjp" rows="7" placeholder="Ingrese aspectos defensivos..."></textarea>
                                                            </div>
                                                        </td>                               
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo" style="color:#555555;">
                                                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                                            <h5 style="display: inline-block;">Aspectos Físicos</h5>
                                                        </td>                          
                                                    </tr>
                                                    <!-- ============================================================================================================ -->
                                                    <tr class="sin_fondo">
                                                        <td style="width: 100%; padding: 0px;">
                                                            <div class="span12" style="display: flex; width: 100%;">
                                                                <textarea onkeyup="chequear_datos_form_informe_icsj();" style="resize: none; background-color: white;" class="textarea-informe-scouting" id="aspct_fisico_icsjp" name="aspct_fisico_icsjp" rows="7" placeholder="Ingrese aspectos físicos..."></textarea>
                                                            </div>
                                                        </td>                               
                                                    </tr>
                                                </tbody>           
                                            </table>                                                                    
                                            <!-- ========================================== Fin del id="tabla_informe_partido" ========================================== -->                                               

                                        </div>
                                    </div>
                                    <!-- ========================================== Fin del id="div-form-informe-partido" ========================================== -->                                                                                
                                </td>                            
                            </tr>
                        </table>
                    </div>
                </div>                          
              

                <div class="row-fluid" style="margin-top:20px;">
                    <div class="span12" style="margin: 0px;">
                        <h4 style="text-align: center; text-transform: uppercase;">ediciones</h4>
                        <button style="float: right;" id="boton-agregar-video" style="margin-bottom" onclick="boton_modal_agregar_video();">
                            <i class="icon-plus"></i> agregar vídeo
                        </button>
                    </div>
                </div>            
                <br>
            </center>     

            <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
        </div>
        <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
        
        <!-- Datos del vídeo (Escondidos) -->
        <input type="hidden" id="fecha_video" name="fecha_video">
        <input type="hidden" id="servidor_video" name="servidor_video">
        <input type="hidden" id="titulo_video" name="titulo_video">
        <input type="hidden" id="link_video" name="link_video">
        <input type="hidden" id="categoria_video" name="categoria_video">
        <input type="hidden" id="sub_categoria_video" name="sub_categoria_video">


        <div class="row-fluid" style="margin-top:0px;">
            <div class="span12" style="margin: 0px;width: 50%;margin-left: 20px;">
                <div style="display: inline-block;">
                    <img src="../config/pause-video-icon.png" style="width: 40px;position: relative;top: -170px;">
                </div> 
                <div style="padding: 5px;height: 108px;width: 50%;display: inline-block;"> 
                    <h3 style="display: inline-block;">Repliegue</h3>
                    <iframe id="iframe_video_modal" style="width: 104.6%; margin: -5px 0px 0px -6px;" src="" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>
                </div>
            </div>            
        </div> 

        <!-- Tabla dinámica -->
        <div class="row-fluid" style="margin-top:10px">
            <center style="margin-bottom: -36px">
                <h6 style="text-transform: uppercase;">otras estadísticas</h6>
            </center>
            
            <button class="boton_informe_jugador" onclick="agregarRenglon();" style="float:right; margin-right: 20px; cursor: pointer;">
                <b style="font-size: 13px"></b><i class="icon-plus"></i> Agregar parámetro
            </button>

            <br><br>

            <div style="width:100%; background-color: <?php echo $color_fondo; ?>; height:7px;"></div><br>

            <!-- TABLA VER UPLOADERS -->
            <table id="tabla_ver_estadisticas_informe" class="sin_fondo" style="width: 100%">
                <tbody class="sin_fondo" style="width: 100%"></tbody>
            </table>

        </div>  

        <div class="row-fluid" style="margin-top:0px;">
            <div class="span12" style="margin: 0px; margin-left: 20px;">
                <h4>Recomendación final:</h4>
                <div style="padding: 10px;">
                    <input class="input-label-match" type="radio" id="recomendacion_observar" name="recomendacion_icsj" value="1" onclick="chequear_datos_form_informe_icsj();">
                    <label class="input-label-match" for="male">Observar</label>
                    <input class="input-label-match" type="radio" id="recomendacion_fichar" name="recomendacion_icsj" value="2" onclick="chequear_datos_form_informe_icsj();">
                    <label class="input-label-match" for="female">Fichar</label>
                    <input class="input-label-match" type="radio" id="recomendacion_descartar" name="recomendacion_icsj" value="3" onclick="chequear_datos_form_informe_icsj();">
                    <label class="input-label-match" for="other">Descartar</label>
                    <input class="input-label-match" type="radio" id="recomendacion_continuar_seguimiento" name="recomendacion_icsj" value="4" onclick="chequear_datos_form_informe_icsj();">
                    <label class="input-label-match" for="other">Continuar seguimiento</label>                
                </div>
            </div>            
        </div>                  

        <div class="row-fluid cuadro_buscar_buscar" style="margin: -60px 0px 0px; padding: 0px;">
            <div class="row-fluid" style="margin-top:0px;">


                <div class="span12" style="margin: 0px;">
                    <div class="div-tr-break"></div>    
                    <center>
                        <button type="submit" class="boton_gestionar_cargos" onclick="boton_guardar();" id="boton_agregar_informe_icsj" disabled="">
                            <i class="icon-save"></i> GUARDAR INFORME
                        </button>
                    </center>
                    <!-- ============================================================================================================ -->
                    <center>
                        <button class="boton_volver" onclick="btnvolver_cuadro_informes_seguimiento_jugador();" style="float:left; margin:0px;">
                            <i class="icon-arrow-left"></i> volver
                        </button>
                    </center>

                </div>
            </div>
        </div>      
    </form>
    <!-- ============================= Fin del id="form_informe_cscouting_jugador" ============================= -->
</div>
<!-- ========================================== Fin del id="cuadro_form_guardar_informe_seguimento" ========================================== -->
  


<!-- *********************************************************************************************************************************************************************************************************************** ENTRENADORES *********************************************************************************************************************************************************************************************************************** -->

<!-- ========================================== Inicio del id="cuadro_entrenadores_seguimiento" ========================================== -->
<div style="margin: -41px -30px 0px -20px; display: none;" id="cuadro_entrenadores_seguimiento">

    <!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
    <div class="cuadro_buscar_titulo" style="background-image: url('../config/banner_centro_scouting_1.png'); background-size: cover; height: 220px; margin-top: -10px">
        
        <div class="row-fluid">
            <div style="padding:0px; margin:0px; margin-top: -20px;">

                <div>
                    <div>
                        <div style="position: relative; width: 33px; top: 50px; left: 55px; height: 55px; background-color: green; transform: skew(170deg);"></div>        
                    </div>
                    <div>
                        <h5 style="margin-top: 0px; color: white; padding: 0px 0px 0px 100px; font-size: 18px; line-height: 7px; text-transform: uppercase; font-weight: normal;">centro de </h5>
                        <h5 style="margin-top: 0px; color: white; padding: 15px 0px 0px 100px; font-size: 40px; text-transform: uppercase;">scouting</h5>
                    </div>
                </div>

                <br>
                
                <img src="../config/logo_equipo.png" style=" height: auto; position: relative; width: 40px; top: 10px; left: 160px;">
            </div>            
        </div>
         
        <br>
        
        <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
    </div>  
    <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
    
    <!-- <hr style="width: 95%; margin-left: auto; margin-right: auto; margin-bottom: 30px; border-bottom: 1px solid #c4c4c4;"> -->

    <!-- ================= Inicio del class="fluid cuadro_buscar_buscar" ================= -->
    <div class="row-fluid cuadro_buscar_buscar" style="width: 97%; margin: auto; margin-top: 20px;">

        <div style="width:100%; background-color: <?php echo $color_fondo; ?> height:20px; border-radius: 4px;"></div>

        <button class="boton_volver" onclick="boton_volver_cuadro_scouting();" style="position: relative; top: 25px;">
            <i class="icon-arrow-left"></i> volver
        </button>       

        <center>
            <div style=" width:500px; margin-bottom:10px; display: inline-block;">
                <table border="0">
                    <tbody>
                        <tr class="sin_fondo">
                            <td style="width:330px; padding-left:40px;"><input class="ph-center" style="width:96%; background-color:white; border: 3px solid #555555; border-radius:20px; margin-bottom:0px;padding-left: 10px; height: 24px;" placeholder="Nombre del Entrenador o Vacío para Ver Todos" maxlength="149" id="nombre_entrenador_cscouting" name="nombre_entrenador_cscouting" onkeyup="buscar_entrenadores_seguimiento( 2 );" onkeydown="buscar_entrenadores_seguimiento( 2 );"></td>
                            <td style="width:40px; cursor:pointer;"> <button class="boton_refresh" onclick="buscar_entrenadores_seguimiento( 2 );" id="boton_refresh_entrenadores_seguimiento" style="margin-left: 10px; display: none;">
                                <i class="icon-refresh"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </center>
                                
        <!-- Inicio de elementos que se mostrarán en caso de fallar consultas (tabla id="tabla_entrenadores_seguimiento")-->
        <center>
            <div style="margin:0px; height:20px;">
                <img src="../config/cargando_buscar.gif" id="cargando_buscar_entrenadores_seguimiento" style="display: none;">
                <span style="color: rgb(220, 78, 78); display: none;" id="error_conexion_entrenadores_seguimiento"><b>Error:</b> conexión a internet deficiente.</span>
                <span style="color: rgb(40, 183, 121); display: none;" id="sin_resultados_entrenadores_seguimiento">Busqueda sin resultados.</span>                
            </div>
        </center>
        <!-- Fin de elementos que se mostrarán en caso de fallar consultas (tabla id="tabla_entrenadores_seguimiento")-->

        <div style="margin-top: 10px; margin-bottom: 60px;">
            <div>
                <!-- ======================================================================== -->
                <div class="span3" style="display: flex;">
                    <a class="btn btn-md btn-primary gray-a" style="text-transform: none;"> 
                        País club
                    </a>
                    <select class="gray-input select-pais-filtro-busqueda" id="idpais_entrenador_cscouting" name="idpais_entrenador_cscouting" style="" onchange="get_divisiones_from_pais( 12 );"></select>
                </div>
                <!-- ======================================================================== -->
                <div class="span3" style="display: flex;">
                    <a class="btn btn-md btn-primary gray-a"> 
                            División
                    </a>
                    <select class="gray-input select-division-filtro-busqueda" id="division_entrenador_cscouting" name="division_entrenador_cscouting" onchange="get_clubes_from_paisdivision_entrenadores_scouting();">
                        <option value="">Seleccione primero un país</option>
                    </select>
                </div>
                <!-- ======================================================================== -->
                <div class="span3" style="display: flex;">
                    <a class="btn btn-md btn-primary gray-a"> 
                            Club
                    </a>
                    <select class="gray-input select-club-filtro-busqueda" id="idclub_entrenador_cscouting" name="idclub_entrenador_cscouting" onchange="buscar_entrenadores_seguimiento( 2 );">
                        <option value="">Seleccione primero una división</option>
                    </select>
                </div>
                <!-- ======================================================================== -->
                <div class="span3" style="display: flex;">
                    <a class="btn btn-md btn-primary gray-a"> 
                            Nacionalidad
                    </a>
                    <select class="gray-input select-pais-filtro-busqueda" id="nacionalidad_entrenador_cscouting" name="nacionalidad_entrenador_cscouting" onchange="buscar_entrenadores_seguimiento( 2 );"></select>
                </div>                
            </div>

            <div style="height: 25px;"></div>
            <div style="margin-top: 20px;">
                <!-- ======================================================================== -->      
                <div class="span3" style="display: flex; margin-left: 0;">
                    <span class="span-input-range" style="width: 20%; color: black; font-weight: bold;">Edad</span>
                    <div class="multi-range mr-edad-entrenador" data-lbound="0" data-ubound="0">
                        <hr style="border-bottom: 1px solid #7d7979;">
                        <input type="range" id="min_edad_entrenador_cscouting" name="min_edad_entrenador_cscouting" min="0" max="0" step="" oninput="this.parentNode.dataset.lbound=this.value;" onchange="buscar_entrenadores_seguimiento( 2 );">
                        <input type="range" id="max_edad_entrenador_cscouting" name="max_edad_entrenador_cscouting" min="0" max="0" step="" oninput="this.parentNode.dataset.ubound=this.value;" onchange="buscar_entrenadores_seguimiento( 2 );">
                    </div>
                </div>            
            </div>            
                                                
        </div>        
               

        <div class="row-fluid" style="margin-top: 90px;">
            <h4 style="color: black; text-transform: uppercase; text-align: center;margin: 0; font-size: 13px;">entrenadores en seguimiento</h4>
            <button style="margin-bottom:10px;margin-top: -20px;float:right;" class="boton_informe_jugador" onclick="btn_ir_form_agregar_entrenador();"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar entrenador</b></button>            
        </div>
                            
            <!-- ================= Inicio del class="row-fluid" ================= -->
            <div class="row-fluid" style="margin-top:0px;">

            <!-- ================= Inicio del class="span12" ================= -->
            <div class="span12" style="margin: 0px;"> 
                <!-- ================= Inicio del id="tabla_entrenadores_seguimiento" ================= -->  
                <table style="border: 0px solid #8f8f8f; width:100%; font-size: 11px;" id="tabla_entrenadores_seguimiento">
                    <thead>
                        <tr style="background-color:#555555; color:white;">
                            <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; max-width:25px; width: 25px;">
                                <div class="tip-top" data-original-title="Número" style="width:100%;">#</div>
                            </th>
                            <th scope="col" style="cursor:pointer;padding:0px;/* max-width: 150px; */width: 245px;">
                                <div class="tip-top" data-original-title="Jugador" style="cursor: pointer;padding: 0px;text-align: left;width: 150px;">ENTRENADOR</div>
                            </th>
                            <th scope="col" style="cursor:pointer;padding:0px;/* max-width: 100px; */width: 150px;text-align: left;">
                                <div class="tip-top" data-original-title="Club" style="width: 150px;">CLUB</div>
                            </th>                                                
                            <th scope="col" style="cursor:pointer;padding:0px;text-align: center;width: 100px;">
                                <div class="tip-top" data-original-title="Nacionalidad" style="width: 100px;">NACIONALIDAD</div>
                            </th>         
                            <th scope="col" style="cursor:pointer;padding:0px;text-align: center;width: 100px;">
                                <div class="tip-top" data-original-title="Fecha de Nacimiento" style="width: 100px;">FECHA NAC</div>
                            </th>                                       
                            <th scope="col" style="cursor:pointer;padding:0px;text-align: center;width: 100px;">
                                <div class="tip-top" data-original-title="Edad" style="width: 100px;">EDAD</div>
                            </th>                                       
                            <th scope="col" style="cursor:pointer;padding:0px;text-align: left;width: 120px;">
                                <div class="tip-top" data-original-title="Fin de Contrato" style="width: 120px;">FIN CONTRATO</div>
                            </th>                                                         
                            <th scope="col" style="cursor:pointer;padding:0px;width: 150px;text-align: left;">
                                <div class="tip-top" data-original-title="Representante" style="width: 100px;">REPRESENTANTE</div>
                            </th>                   
                            <th scope="col" style="cursor:pointer; padding:0px; border-top-right-radius:5px; max-width:20px; width:20px;" colspan="3"></th>
                        </tr>
                    </thead>
                                        
                    <tbody></tbody>
                                        
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
                            <th colspan="2" scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px;"></th>
                        </tr>
                    </tfoot>

                </table>
                <!-- ================= Fin del id="tabla_entrenadores_seguimiento" ================= -->
            </div>
            <!-- ================= Fin del class="span12" ================= -->
        </div>
        <!-- ================= Fin del class="row-fluid" ================= -->
    </div>
    <!-- ================= Fin del class="fluid cuadro_buscar_buscar" ================= -->

</div>
<!-- ========================================== Fin del id="cuadro_entrenadores_seguimiento" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_form_agregar_entrenador" ========================================== -->
<!-- <br><center><h1>----------</h1></center><br> -->
<div style="display:none" id="cuadro_form_agregar_entrenador">

    <!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
    <div class="cuadro_buscar_titulo">
        <center>
            <div class="row-fluid" style="margin-top:0px;">
                <div class="span12" style="margin: 0px;">
                    <button class="boton_volver" onclick="bntvolver_desde_form_entrenador();" style="float:left; margin:0px; margin-top: 20px;">
                        <i class="icon-arrow-left"></i> volver
                    </button>    

                    <p class="datos_form_entrenador" style="left: 170px;top: 25px;position: relative;display: inline-block;color: #040404;">
                        <b style="text-transform: uppercase;color: #292727;">!NOTA: </b><span>los campos con (*) son</span><span style="text-decoration: underline;"> obligatorios</span>!
                    </p>

                </div>          
            </div> 
        </center>     

        <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
    </div>
    <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
    
    <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; /*margin-top:-60px;*/">
        <div class="row-fluid" style="margin-top:0px;">

            <div class="span12 datos_form_entrenador" style="margin: 0px; margin-top: 10px;">            
                <p style="color: black; font-weight: bold; text-transform: uppercase; float: left;">Nuevo entrenador:</p>
            </div>  


            <!-- ========================================== Inicio del id="formulario_entrenador" ========================================== -->
            <form method="post" ng-model="formulario_entrenador" name="formulario_entrenador" id="formulario_entrenador" novalidate autocomplete="off" enctype="multipart/form-data">            

            <div class="span12" style="margin-top: -10px; margin-left: 0;">

                    <div style="width: 100%" class="datos_form_entrenador">
                        
                        <div class="span4">
                            <!--
                            <div class="div-imagen-form">
                                <img id="foto-entrenador" class="img-form" src="">
                            </div>  
                            <div id="div_file">
                                <p id="texto"><i class="icon-cloud-upload"></i> Subir foto (.jpg o png)</p>
                                <input type="file" class="custom-file-input" id="foto_entrenador" name="foto_entrenador" required="" accept=".jpg, .png, .jpeg" onchange="readURL(this);"/>
                                <input type="hidden" name="foto_anterior_entrenador" id="foto_anterior_entrenador" value="sinFoto">
                            </div>
                            -->
                          <center>
                            <div id="image_preview_entrenador" style="border: 6px solid <?php echo $color_fondo; ?>; width:180px; height:180px;  border-radius:100px;">
                                <img id="foto-entrenador" src="../config/cargando_logo_final.gif" style="width:180px; border-radius:100px; height:180px;" class="img-thumbnail"/>
                            </div>  
                            <label for="foto_entrenador" class="boton_gestionar_cargos subiendo_foto" style="width:170px; margin-top:10px;">
                                <i class="icon-cloud-upload"></i> Subir foto (.jpg o .png)
                            </label>
                            <input type="file" name="foto_entrenador" id="foto_entrenador" value="Seleccionar foto"  style="display:none;"/>
                            <input type="hidden" name="foto_anterior_entrenador" id="foto_anterior_entrenador" value="sinFoto">
                            <div id="message_foto_entrenador">
                            </div>
                          </center>

                        </div>

                        <!-- ========================================== Inicio de campos a la derecha ========================================== -->
                      <!-- ========================================== Inicio de campos a la derecha ========================================== -->
                      <div class="span8" style="margin: 0px;">
                        <div class="span12"  style="margin: 0px;">
                            <div class="span6" style="margin: 0px; margin-bottom:20px;">
                              <div style="padding:0px; margin:0px;">
                                <a class="btn btn-md btn-primary green-a"> *Nombre</a><input type="text" name="nombre_entrenador" id="nombre_entrenador" class="my-input" maxlength="149" onkeyup="chequear_datos_form_entrenador();" onkeydown="chequear_datos_form_entrenador();">
                                </div>
                            </div>
                            <div class="span6" style="margin: 0px; margin-bottom:20px;">
                              <div style="padding:0px; margin:0px;">
                                <a class="btn btn-md btn-primary green-a"> *Apellido 1</a><input id="apellido1_entrenador" name="apellido1_entrenador" type="text" class="my-input" maxlength="149" onkeyup="chequear_datos_form_entrenador();" onkeydown="chequear_datos_form_entrenador();"></div>
                              </div>
                        </div>
                        <!-- ==================================================================================== -->
                        <div class="span12"  style="margin: 0px;">
                            <div class="span6" style="margin: 0px; margin-bottom:20px;">
                              <div style="padding:0px; margin:0px;">
                                <a class="btn btn-md btn-primary green-a"> Apellido 2</a><input type="text" id="apellido2_entrenador" name="apellido2_entrenador" class="my-input" maxlength="149" onkeyup="chequear_datos_form_entrenador();" onkeydown="chequear_datos_form_entrenador();">
                                </div>
                            </div>
                            <div class="span6" style="margin: 0px; margin-bottom:20px;">
                              <div style="padding:0px; margin:0px;">
                                <a class="btn btn-md btn-primary green-a"> Fecha Nac</a><input readonly id="fecha_nacimiento_entrenador" name="fecha_nacimiento_entrenador" type="text" class="my-input green-input date-picker" onchange="chequear_datos_form_entrenador();"></div>
                              </div>
                        </div>
                        <!-- ==================================================================================== -->  
                        <div class="span12"  style="margin: 0px;">
                          <div class="span6" style="margin: 0px; margin-bottom:20px;">
                              <div style="padding:0px; margin:0px;">
                                  <a class="btn btn-md btn-primary green-a"> Nacionalidad 1</a><select id="nacionalidad_entrenador" name="nacionalidad_entrenador" class="green-input select-pais-form" onchange="chequear_datos_form_entrenador();">
                                  </select>
                              </div>
                          </div>
                        </div>                                              
                      </div>
                      <!-- ========================================== Fin de campos a la derecha ========================================== -->
                 

                    </div>



            </div>

            <div class="span12" style="margin-top: 40px; margin-left: 0;">
                <div class="tabbable"> <!-- Only required for left/right tabs -->
                  <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab_form_entrenador" data-toggle="tab">Datos</a></li>
                    <li><a href="#tab_form_partido_entrenador" data-toggle="tab">Partidos</a></li>
                  </ul>
                  <div class="tab-content" style="overflow: visible;">
                    
                    <!-- ================================================= Inicio del id="tab_form_entrenador" ================================================= -->
                    <div class="tab-pane active" id="tab_form_entrenador">
                    
                            <hr style="margin: auto; margin-top: 50px; margin-bottom: 20px; border-top: 2px solid #c8c5c5; border-bottom: 1px solid #fff; width: 97%;" />

                            <div class="row-fluid cuadro_buscar_buscar" style="width: 98%;">
                                
                            <div class="row-fluid div-datos-partido">
                                
                                <!-- ======================================================================== -->
                                <div class="span4 campo-jugador-en-club" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        País club actual
                                    </a>
                                    <!-- select-pais-form <- Esta clase agrega valores al select -->
                                    <select class="green-input select-pais-form" id="pais_club_actual_entrenador" name="pais_club_actual_entrenador" onchange="get_divisiones_from_pais( 4 );"></select>
                                </div> 
                                <!-- ======================================================================== -->
                                <div class="span4 campo-jugador-en-club" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"><div><p class="ellipsis-text" style="font-weight: normal;">División club actual</p></div></a>                                    
                                    <!-- select-division-form <- Esta clase agrega valores al select -->
                                    <select class="green-input" id="division_club_actual_entrenador" name="division_club_actual_entrenador" onchange="get_clubes_from_paisdivision_entrenador();"></select>
                                </div>                                                      

                                <!-- ************************************************************************************************************************ -->
                                <div class="span4 campo-jugador-en-club" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Club actual
                                    </a>
                                    <select class="green-input select-idclub-dinamico" id="idclub_actual_entrenador" name="idclub_actual_entrenador" onchange="chequear_datos_form_entrenador();"><option value="">Seleccione</option></select>
                                </div>

                                <!-- ====================== Inicio de los campos class="campo-club-entrenador-otro" ====================== -->
                                <div class="span4 campo-club-entrenador-otro" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> País club </a>
                                    <!-- select-pais-form <- Esta clase agrega valores al select -->
                                    <select class="green-input select-pais-form" id="pais_club_entrenador_otro" name="pais_club_entrenador_otro" onchange="get_divisiones_from_pais( 5 );"></select>
                                </div>

                                <div class="span4 campo-club-entrenador-otro" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a">División club </a>
                                    <select class="green-input select-division-form" id="division_club_entrenador_otro" name="division_club_entrenador_otro" onchange="chequear_datos_form_entrenador();"></select>
                                </div>

                                <div class="span4 campo-club-entrenador-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a">Club</a>
                                    <input class="green-input" id="nombre_club_entrenador_otro" name="nombre_club_entrenador_otro" onkeyup="chequear_datos_form_entrenador();"/>
                                </div>  

                                <div class="span4 campo-club-entrenador-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a">Entrenador</a>
                                    <input class="green-input" id="entrenador_club_entrenador_otro" name="entrenador_club_entrenador_otro" onkeyup="chequear_datos_form_entrenador();"/>
                                </div>                                                                                          
                                <!-- ====================== Fin de los campos class="campo-club-entrenador-otro" ====================== -->                                                                               
                                <!-- ======================================================================== -->
                                <div class="span4" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Fin contrato
                                    </a>
                                    <input readonly class="green-input date-picker" id="fechafin_contrato_entrenadorclub" name="fechafin_contrato_entrenadorclub" onchange="chequear_datos_form_entrenador();"/>
                                </div>                                                      

                                <!-- ======================================================================== -->
                                <div class="span4" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Cláusula de salida</p></div></a>
                                    <select class="green-input" id="clausula_salida_entrenadorclub" name="clausula_salida_entrenadorclub" onchange="campos_entrenador();">
                                        <option value="0">Seleccione</option>
                                        <option value="1">Sí</option>
                                        <option value="2">No</option>
                                    </select>
                                </div> 
                                <!-- ======================================================================== -->
                                <div class="span4" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Valor cláusula
                                    </a>
                                    <input class="green-input" id="valor_clausula_entrenadorclub" name="valor_clausula_entrenadorclub" onkeyup="chequear_datos_form_entrenador();"/>
                                </div> 

                                <!-- ======================================================================== -->
                                <div class="span4" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Representante
                                    </a>
                                    <input class="green-input" id="representante_entrenadorclub" name="representante_entrenadorclub" onkeyup="chequear_datos_form_entrenador();"/>
                                </div>                                                                                      

                                <!-- Salto de línea -->
                                <div class="div-break"></div>

                                <!-- ************************************************************************************************************************ -->                       
                                <div class="span12" style="display: flex; margin-left: 2.5%;">
                                    <table style="width: 95.2%; margin-bottom: 15px;">
                                        <thead>
                                            <tr>
                                                <th class="th-textarea">Observaciones</th>
                                            </tr> 
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="width: 100%; padding: 0px;">
                                                    <div class="span12" style="display: flex; width: 100%;">
                                                        <textarea onkeyup="chequear_datos_form_entrenador();" style="resize: none;" class="textarea-social" name="observaciones_entrenadorclub" id="observaciones_entrenadorclub" rows="10"></textarea>
                                                    </div>
                                                </td>                                                  
                                            </tr>
                                        </tbody>
                                    </table>     
                                </div>
                                
                            </div>  


                            </div>                                          
                        
                        <!-- ************************************************************************************************************************ -->                                                                   
            </form>        
            <!-- ========================================== Fin del id="formulario_entrenador" ========================================== -->                    
                    </div>
                    <!-- ================================================= Fin del id="tab_form_entrenador" ================================================= -->

                    <!-- ================================================= Inicio del id="tab_form_partido_entrenador" ================================================= -->
                    <div class="tab-pane" id="tab_form_partido_entrenador">
                        <!-- ================================================= Inicio del id="formulario_partido_entrenador" ================================================= -->
                        <form id="formulario_partido_entrenador" style="display: none;">
                            <div class="row-fluid div-datos-partido">

                                <div class="span4" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Fecha Partido
                                    </a>
                                    <input readonly class="green-input date-picker" id="fecha_entrenadorpartido" name="fecha_entrenadorpartido" onchange="chequear_datos_form_partidoentrenador();" />
                                </div>

                                <div class="span4" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Campeonato
                                    </a>
                                    <select class="green-input select-campeonato" id="idcampeonato_entrenador" name="idcampeonato_entrenador" onchange="get_clubes_from_paiscampeonato_entrenador();"></select>
                                </div> 

                                <!-- ====================== Inicio de los campos class="campo-campeonato-entrenador-otro" ====================== -->
                                <div class="span4 campo-campeonato-entrenador-otro" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> País campeonato </a>
                                    <!-- select-pais-form <- Esta clase agrega valores al select -->
                                    <select class="green-input select-pais-form" id="pais_campeonato_entrenador_otro" name="pais_campeonato_entrenador_otro" onchange="get_divisiones_from_pais( 9 );"></select>
                                </div>

                                <div class="span4 campo-campeonato-entrenador-otro" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">División campeonato</p></div></a>
                                    <select class="green-input select-division-form" id="division_campeonato_entrenador_otro" name="division_campeonato_entrenador_otro" onchange="chequear_datos_form_partidoentrenador();"></select>
                                </div>

                                <div class="span4 campo-campeonato-entrenador-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Nombre campeonato</p></div></a>
                                    <input class="green-input" id="nombre_campeonato_entrenador_otro" name="nombre_campeonato_entrenador_otro" onkeyup="chequear_datos_form_partidoentrenador();" />
                                </div>  

                                <div class="span4 campo-campeonato-entrenador-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Organizador campeonato</p></div></a>
                                    <input class="green-input" id="organizador_campeonato_entrenador_otro" name="organizador_campeonato_entrenador_otro" onkeyup="chequear_datos_form_partidoentrenador();" />
                                </div>                                                                                          
                                <!-- ====================== Fin de los campos class="campo-campeonato-entrenador-otro" ====================== -->

                                <div class="span4" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Temporada
                                    </a>
                                    <input class="green-input select-posicion-jugador-form" id="temporada_entrenadorpartido" name="temporada_entrenadorpartido" onkeyup="chequear_datos_form_partidoentrenador();"/>
                                </div> 

                                <div class="span4" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        MD
                                    </a>
                                    <input class="green-input select-posicion-jugador-form" id="md_entrenadorpartido" name="md_entrenadorpartido" onkeyup="chequear_datos_form_partidoentrenador();"/>
                                </div>

                                <div class="span4" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Jornada
                                    </a>
                                    <input class="green-input" id="jornada_entrenadorpartido" name="jornada_entrenadorpartido" onkeyup="chequear_datos_form_partidoentrenador();" />
                                </div>          

                                <div class="span4" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        *Rival
                                    </a>
                                    <!-- <select class="green-input select-club" id="idclub_rival_entrenador" name="idclub_rival_entrenador" onchange="chequear_datos_form_partidoentrenador();"></select> -->
                                    <select class="green-input" id="idclub_rival_entrenador" name="idclub_rival_entrenador" onchange="chequear_datos_form_partidoentrenador();">
                                        <option value="">Seleccione primero un campeonato</option>
                                        <option value="000">Otro</option>                                        
                                    </select>
                                </div>

                                <!-- ====================== Inicio de los campos class="campo-club-rival-entrenador-otro" ====================== -->
                                <div class="span4 campo-club-rival-entrenador-otro" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> País club rival</a>
                                    <!-- select-pais-form <- Esta clase agrega valores al select -->
                                    <select class="green-input select-pais-form" id="pais_club_rival_entrenador_otro" name="pais_club_rival_entrenador_otro" onchange="get_divisiones_from_pais( 6 );"></select>
                                </div>

                                <div class="span4 campo-club-rival-entrenador-otro" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">División club rival</p></div></a>
                                    <select class="green-input select-division-form" id="division_club_rival_entrenador_otro" name="division_club_rival_entrenador_otro" onchange="chequear_datos_form_partidoentrenador();"></select>
                                </div>

                                <div class="span4 campo-club-rival-entrenador-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a">Club rival</a>
                                    <input class="green-input" id="nombre_club_rival_entrenador_otro" name="nombre_club_rival_entrenador_otro" onkeyup="chequear_datos_form_partidoentrenador();" />
                                </div>  

                                <div class="span4 campo-club-rival-entrenador-otro" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a" style="font-size: 10px;"><div><p class="ellipsis-text" style="font-weight: normal;">Entrenador rival</p></div></a>
                                    <input class="green-input" id="entrenador_club_rival_entrenador_otro" name="entrenador_club_rival_entrenador_otro" onkeyup="chequear_datos_form_partidoentrenador();" />
                                </div>                                                                                          
                                <!-- ====================== Fin de los campos class="campo-club-rival-entrenador-otro" ====================== -->
                                <div class="span4" style="display: flex; margin-left: 2.5%;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Táctica
                                    </a>
                                    <input class="green-input select-posicion-jugador-form" id="tactica_entrenadorpartido" name="tactica_entrenadorpartido" onkeyup="chequear_datos_form_partidoentrenador();"/>
                                </div>

                            </div>
                        
                            <div style="width: 92%; margin: auto; margin-top: 90px; margin-bottom: 25px;">
                                <h4 style="text-align: center; color: black; text-transform: uppercase;">estadísticas</h4>
                            </div>

                            <!-- ================================================ Inicio del div para imagen e input para indicar la cantidad de goles - Tabla de estadísticas ================================================ -->
                            <div class="row-fluid" style="width: 92%; margin: auto; margin-bottom: 100px;">
                                
                                <!-- ========================== Inicio del div para imagen e input para indicar la cantidad de goles ========================== -->
                                <div class="span6" style="width: 40%; /*display: inline-block;*/">
                                    <center>
                                        <div style="margin-bottom: 20px;">
                                            <img id="foto_1_club_entrenador_partido" src="../config/default.png" style="width: 30px;position: relative;right: 10px;">
                                            <input type="text" id="gol_equipo1_entrenadorpartido" name="gol_equipo1_entrenadorpartido" style="width: 20px;border: 1px solid <?php echo $color_fondo; ?>;" maxlength="2" onkeyup="chequear_datos_form_partidoentrenador();"> 
                                            <div style="font-size: 30px;position: relative;top: 5px;font-weight: bold;width: 40px;display: inline-block;">-</div>
                                            <input type="text" id="gol_equipo2_entrenadorpartido" maxlength="2" name="gol_equipo2_entrenadorpartido" style="width: 20px;border: 1px solid <?php echo $color_fondo; ?>;" onkeyup="chequear_datos_form_partidoentrenador();">
                                            <img id="foto_1_club_rival_entrenador_partido" src="../config/default.png" style="width: 30px;position: relative;left: 10px;">                                        
                                        </div>
                                    </center>

                                    <div>
                                        <center>
                                            <div style="z-index: 100;position: relative;top: 60px;">
                                                <div style="position: relative; top: -10px;">
                                                    <img id="foto_2_club_entrenador_partido" src="../config/default.png" style="width: 60px; height: 60px;">
                                                    <img src="../config/balon.png" style="width: 30px;">
                                                    <img id="foto_2_club_rival_entrenador_partido" src="../config/default.png" style="width: 60px; height: 60px;">                                                     
                                                </div>
                                                
                                                <div style="background-color: <?php echo $color_fondo; ?>; width: 90%; border-radius: 5px; position: relative; top: 10px;">

                                                    <div style="padding: 5px;width: 45%;float: left;background-color: <?php echo $color_fondo; ?>;">
                                                        <input class="input-label-match-small" type="radio" id="condicion_local_equipo1_entrenadorpartido" name="cond_equipo1_entrenadorpartido" value="1" onclick="chequear_datos_form_partidoentrenador();" disabled="" style="background-color: rgb(207, 204, 204);">
                                                        <label class="input-label-match-small" for="male">Local</label>

                                                        <div style="width: 10px; display: inline-block;"></div>

                                                        <input class="input-label-match-small" type="radio" id="condicion_visita_equipo1_entrenadorpartido" name="cond_equipo1_entrenadorpartido" value="2" onclick="chequear_datos_form_partidoentrenador();" disabled="" style="background-color: rgb(207, 204, 204);">
                                                        <label class="input-label-match-small" for="female">Visita</label>
                                                        <!--
                                                        <input class="input-label-match-small" type="radio" id="condicion_neutral_equipo1_entrenadorpartido" name="cond_equipo1_entrenadorpartido" value="3" onclick="chequear_datos_form_partidoentrenador();" disabled="" style="background-color: rgb(207, 204, 204);">
                                                        <label class="input-label-match-small" for="other">Neutral</label>
                                                        -->
                                                    
                                                    </div>

                                                    <div style="padding: 5px;width: 45%;float: right;background-color: <?php echo $color_fondo; ?>;">
                                                        <input class="input-label-match-small" type="radio" id="condicion_local_equipo2_entrenadorpartido" name="cond_equipo2_entrenadorpartido" value="1" onclick="chequear_datos_form_partidoentrenador();" disabled="" style="background-color: rgb(207, 204, 204);">
                                                        <label class="input-label-match-small" for="male">Local</label>

                                                        <div style="width: 10px; display: inline-block;"></div>

                                                        <input class="input-label-match-small" type="radio" id="condicion_visita_equipo2_entrenadorpartido" name="cond_equipo2_entrenadorpartido" value="2" onclick="chequear_datos_form_partidoentrenador();" disabled="" style="background-color: rgb(207, 204, 204);">
                                                        <label class="input-label-match-small" for="female">Visita</label>
                                                        <!--
                                                        <input class="input-label-match-small" type="radio" id="condicion_neutral_equipo2_entrenadorpartido" name="cond_equipo2_entrenadorpartido" value="3" onclick="chequear_datos_form_partidoentrenador();" disabled="" style="background-color: rgb(207, 204, 204);">
                                                        <label class="input-label-match-small" for="other">Neutral</label>
                                                        -->

                                                    </div>                                                      

                                                </div>

                                            </div>
                                        </center>                               

                                        <center>
                                            <div style="height: 100px;">
                                                <img src="../config/cancha-scouting.png" style="width: 100%;height: 250px;margin: 0;position: relative;top: -120px;">
                                            </div>
                                        </center>                                   
                                    </div>
                                </div>
                                <!-- ========================== Fin del div para imagen e input para indicar la cantidad de goles ========================== -->
                                
                                <!-- ========================== Inicio del div para tabla de estadísticas ========================== -->
                                <div class="span6" style="width: 60%; margin: 0;">

                                    <table class="table-striped" style="width:100%; margin-bottom: 100px; margin: auto; border: 1px solid dimgray;" id="">
                                        <thead>
                                            <tr style="background-color:#2e2c2c; color:white;height:30px;">
                                                <th scope="col" style="cursor:pointer; padding-top:5px; padding-bottom:5px; text-align: center; width: 350px;">
                                                    <div class="tip-top" data-original-title="Jugador" style="width:100%;">ENTRENADOR</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                    <div class="tip-top" data-original-title="Tarjetas Amarillas" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/yellow-card-hand.png"></center></div>                                              
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                    <div class="tip-top" data-original-title="Dobles Tarjetas Amarillas" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/double-yellow-card.png"></center></div> 
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                    <div class="tip-top" data-original-title="Tarjetas Rojas" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/red-card-hand.png"></center></div> 
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 210px;">
                                                    <div class="tip-top" data-original-title="Minutos jugados" style="width:100%;"><center style="margin: auto;display: block;width: 20px;"><img src="../config/min-jugados.png"></center></div>
                                                </th>                                                                                                                                   
                                            </tr>
                                        </thead>
                                       <tbody>
                                            <tr style="cursor: pointer;">
                                                
                                                <td style="width: 250px; max-width: 250px;">
                                                    <div class="div-club-table" style="text-align: left; max-width: 310px;">
                                                        <div class="img-next-to-text"><img class="foto-entrenador-partido" src="" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px; display: block;margin: auto;">
                                                        </div>
                                                        <div style="float: right;width: 80%;">
                                                            <p class="ellipsis-text nombre-entrenador-partido" style="text-transform: uppercase; font-weight: bold; color: black; margin: 0; text-align: left; position: relative; top: 5px;"></p>
                                                        </div>
                                                    </div>
                                                </td> 
                                                
                                                <td><center><input type="text" style="width: 25px;" id="t_amarilla_entrenadorpartido" name="t_amarilla_entrenadorpartido" maxlength="1" onkeyup="chequear_datos_form_partidoentrenador();"></center></td>

                                                <td><center><input type="text" style="width: 25px;" id="t_amarilladb_entrenadorpartido" name="t_amarilladb_entrenadorpartido" maxlength="1" onkeyup="chequear_datos_form_partidoentrenador();"></center></td>
                                                
                                                <td><center><input type="text" style="width: 25px;" id="t_roja_entrenadorpartido" name="t_roja_entrenadorpartido" maxlength="1" onkeyup="chequear_datos_form_partidoentrenador();"></center></td>
                                                
                                                <td><center><input type="text" style="width: 25px;" id="min_jugados_entrenadorpartido" name="min_jugados_entrenadorpartido" maxlength="3" onkeyup="chequear_datos_form_partidoentrenador();"><b id="min_jugados_entrenadorpartido_text" style="color: black; position: relative; top: -4px; left: 5px;">minutos jugados</b></center></td>

                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr><td colspan="9"></td></tr>
                                        </tfoot>
                                    </table>                                
                                </div>
                                <!-- ========================== Fin del div para tabla de estadísticas ========================== -->

                            </div>
                            <!-- ================================================ Fin del div para imagen e input para indicar la cantidad de goles - Tabla de estadísticas ================================================ -->

                            <button id="boton-agregar-partido-entrenador" onclick="boton_guardar_partido_entrenador();">guardar partido</button>

                        </form>     
                        <!-- ================================================= Fin del id="formulario_partido_entrenador" ================================================= -->                            

                            <div style="margin-bottom: 50px;">

                                <div class="row-fluid" style="margin-top: 90px; width: 92%; margin: auto;">
                                    <h4 style="color: black; text-transform: uppercase; text-align: center;margin: 0; font-size: 13px;">Análisis de partidos</h4>
                                    <button style="margin-bottom:10px;margin-top: -20px;float:right;" class="boton_informe_jugador" onclick="boton_agregar_partido_entrenador();"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar partido</b></button>            
                                </div>  

                                <!-- ================================================ Inicio del id="tabla_partidos_entrenador" ================================================ -->
                                <table id="tabla_partidos_entrenador" class="table-striped" style="width:92%; margin-bottom: 100px; margin: auto; font-size: 10px;" vista-modal-partido='0'>
<thead>
                                        <tr style="background-color:#555555; color:white;height:30px; ">                               
                                            <th scope="col" style="border-top-left-radius:5px;padding-top:5px;padding-bottom:5px;border-right: 1px solid;text-align: center; width:70px">
                                                <div class="tip-top" data-original-title="Fecha" style="width:70px;">FECHA</div>
                                            </th>
                                            <th scope="col" style="cursor:pointer;padding:0px;border-right: 1px solid;text-align: center; width:150px;">
                                                <div class="tip-top" data-original-title="Competición" style="width: 110px;">
                                                    COMPETICIÓN
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer;padding:0px;text-align: center;border-right: 1px solid; width:120px;">
                                                <div class="tip-top" data-original-title="Temporada" style="text-align: center;width: 100px;">
                                                    TEMPORADA
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer;padding:0px;border-right: 1px solid;text-align: center; width:120px;">
                                                <div class="tip-top" data-original-title="MD" style="width:120px;">
                                                    MD
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 150px">
                                                <div class="tip-top" data-original-title="Equipo local" style="width: 110px;">EQUIPO LOCAL</div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width: 120px;">
                                                <div class="tip-top" data-original-title="Resultado" style="width: 90px;">
                                                    RESULTADO
                                                </div>
                                            </th>                                                                                        
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width:150px;">
                                                <div class="tip-top" data-original-title="Equipo visitante" style="width: 110px;">
                                                    EQUIPO VISITANTE
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer; padding:0px; border-right: 1px solid; width:120px;">
                                                <div class="tip-top" data-original-title="Táctica" style="width: 100px;">
                                                    TÁCTICA
                                                </div>
                                            </th>
                                            <th scope="col" style="cursor:pointer;  border-top-right-radius:5px;" colspan="2"></th>
                                        </tr>
                                   </thead>
                                   <tbody></tbody>
                                    <tfoot>
                                        <tr><td colspan="16" style="border-bottom: 1px solid"></td></tr>
                                    </tfoot>
                                </table>
                                <!-- ================================================ Fin del id="tabla_partidos_entrenador" ================================================ -->                           
                            </div>

                    </div>
                    <!-- ================================================= Fin del id="tab_form_partido_entrenador" ================================================= -->

                  </div>
                </div>              
            </div>

            <div class="span12" style="margin-top: 20px;">
                <center>
                    <button type="submit" class="boton_gestionar_cargos" onclick="boton_guardar_entrenador();" id="boton_agregar_entrenador">
                        <i class="icon-save"></i> GUARDAR ENTRENADOR
                    </button>
               </center>     
            </div>  

        <center>
            <div class="row-fluid" style="margin-top:0px;">
                <div class="span12" style="margin: 0px;">
                    <button class="boton_volver" onclick="bntvolver_desde_form_entrenador();" style="float:left; margin:0px; margin-top: 20px;">
                        <i class="icon-arrow-left"></i> volver
                    </button>                      
                </div>          
            </div> 
        </center>

        </div>
    </div>      
</div>
<!-- ========================================== Fin del id="cuadro_form_agregar_entrenador" ========================================== -->


<!-- *********************************************************************************************************************************************************************************************************************** VENTANAS MODALES *********************************************************************************************************************************************************************************************************************** -->

<!-- ========================================== Inicio del id="modal_formulario_ficha_jugador" ========================================== -->
<div id="modal_formulario_ficha_jugador" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
     <center>
            <br>
            <div id="mensaje_agregar_ficha_jugador">
              <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_ficha_jugador();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>    
<!-- ========================================== Fin del id="modal_formulario_ficha_jugador" ========================================== -->

<!-- ========================================== Inicio del id="modal_formulario_guardar_partido_jugador" ========================================== -->
<div id="modal_formulario_guardar_partido_jugador" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
     <center>
            <br>
            <div id="mensaje_agregar_partido_jugador">
              <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_partido_jugador();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>    
<!-- ========================================== Fin del id="modal_formulario_guardar_partido_jugador" ========================================== -->

<!-- ============================== Inicio del id="modal_eliminar_partido" ============================== -->
<div id="modal_eliminar_partido" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_eliminar_partido" style="color:black;">
              <h5><i class="icon-spinner icon-spin icon-large"></i> Cargando informes del jugador...</h5>
              <br>
              <img src="../config/ver_archivo_jugador.png">
              </div>
           
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar_partido();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>
<!-- ============================== Fin del id="modal_eliminar_partido" ============================== -->

<!-- ========================================== Inicio del id="modal_formulario_entrenador" ========================================== -->
<div id="modal_formulario_entrenador" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
     <center>
            <br>
            <div id="mensaje_agregar_entrenador">
              <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_entrenador();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>    
<!-- ========================================== Fin del id="modal_formulario_entrenador" ========================================== -->

<!-- ============================== Inicio del id="modal_eliminar_entrenador" ============================== -->
<div id="modal_eliminar_entrenador" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_eliminar_entrenador" style="color:black;">
              <h5><i class="icon-spinner icon-spin icon-large"></i> Cargando informes del jugador...</h5>
              <br>
              <img src="../config/ver_archivo_jugador.png">
              </div>
           
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar_entrenador();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>
<!-- ============================== Fin del id="modal_eliminar_entrenador" ============================== -->

<!-- ========================================== Inicio del id="modal_formulario_guardar_partido_entrenador" ========================================== -->
<div id="modal_formulario_guardar_partido_entrenador" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
     <center>
            <br>
            <div id="mensaje_agregar_partido_entrenador">
              <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_partido_entrenador();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>    
<!-- ========================================== Fin del id="modal_formulario_guardar_partido_entrenador" ========================================== -->

<!-- ============================== Inicio del id="modal_eliminar_partido_entrenador" ============================== -->
<div id="modal_eliminar_partido_entrenador" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_eliminar_partido_entrenador" style="color:black;">
              <h5><i class="icon-spinner icon-spin icon-large"></i> Cargando informes del jugador...</h5>
              <br>
              <img src="../config/ver_archivo_jugador.png">
              </div>
           
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar_partido_entrenador();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>
<!-- ============================== Fin del id="modal_eliminar_partido_entrenador" ============================== -->

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
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_registro();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
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

<!-- ============================== Inicio del id="modal_eliminar_scouting" ============================== -->
<div id="modal_eliminar_scouting" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_eliminar_scouting" style="color:black;">
              <h5><i class="icon-spinner icon-spin icon-large"></i> Cargando informes del jugador...</h5>
              <br>
              <img src="../config/ver_archivo_jugador.png">
              </div>
           
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar_scouting();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>
<!-- ============================== Fin del id="modal_eliminar_scouting" ============================== -->

<!-- ============================== Inicio del id="modal_eliminar_informe_scouting" ============================== -->
<div id="modal_eliminar_informe_scouting" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_eliminar_informe_scouting" style="color:black;">
              <h5><i class="icon-spinner icon-spin icon-large"></i> Cargando informes del jugador...</h5>
              <br>
              <img src="../config/ver_archivo_jugador.png">
              </div>
           
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar_informe_scouting();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>
<!-- ============================== Fin del id="modal_eliminar_informe_scouting" ============================== -->

<!-- ============================== Inicio del id="modal_eliminar_estadistica_informe_scouting" ============================== -->
<div id="modal_eliminar_estadistica_informe_scouting" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_eliminar_estadistica_informe_scouting" style="color:black;">
              <h5><i class="icon-spinner icon-spin icon-large"></i> Cargando informes del jugador...</h5>
              <br>
              <img src="../config/ver_archivo_jugador.png">
              </div>
           
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar_estadistica_informe_scouting();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>
<!-- ============================== Fin del id="modal_eliminar_estadistica_informe_scouting" ============================== -->

<!-- ========================================== Inicio del id="modal_detalle_informe" ========================================== -->
<div id="modal_detalle_informe" class="modal hide" style="width: 850px; height: 570px; left: 40%; top: 5%;">
    <div class="modal-header" style="padding: 0;">

<div class="cuadro_buscar_titulo" style="background-image: url('../config/banner-scouting-informe.png');background-size: contain;height: 140px;margin-top: -10px;background-repeat: round;">
            
            <div class="row-fluid" style="margin-top: 0;">
                <div style="padding:0px; margin:0px;">

                    <div>
                        <div style="position: relative;right: 10px;">
                            <div style="position: relative;width: 20px;top: 15px;left: 55px;height: 35px;background-color: white;transform: skew(170deg);"></div>        
                        </div>
                        <div style="position: relative;top: -30px;right: 10px;">
                            <div style="display: inline-block;position: relative;">
                                <h5 class="nombre-jugador" style="margin-top: 0px;color: white;padding: 0px 0px 0px 100px;font-size: 14px;line-height: 7px;text-transform: capitalize;font-weight: normal;display: inline-block;position: relative;right: 10px;"></h5>
                                <h5 class="apellido-jugador" style="display: inline-block;top: 0px;color: white;font-size: 14px;line-height: 7px;text-transform: capitalize;font-weight: bold;position: relative;right: 10px;"></h5>                            
                            </div>
                            <img class="bandera-pais-jugador-banner" src="" style="position: relative;left: 0px;top: -3px; /*border-radius: 7px; width: 25px;*/">
                            <h5 class="datos-jugador" style="margin-top: 0px;color: white;padding: 15px 0px 0px 100px;font-size: 12px;position: relative;top: -15px;text-transform: capitalize;right: 10px;font-weight: normal;"></h5>
                        </div>


                    </div>

                    <br>
                    
                    <div style="position: relative;top: -60px;right: 10px;">
                        <div style="height: 15px;margin-bottom: 5px;">
                            <img src="../config/estatura-1.png" class="img-datos-jugador-modal">
                            <span class="datos-jugador-small-modal">Estatura: <span class="estatura-banner" style="font-weight: bold;"></span> </span>
                        </div>    
                        <div style="height: 15px;margin-bottom: 5px;">
                            <img src="../config/birthday_1.png" class="img-datos-jugador-modal">
                            <span class="datos-jugador-small-modal">Fecha de Nacimiento: <span class="edad-jugador-banner"></span></span>  
                        </div>    
                        <div style="height: 15px;">
                            <img src="../config/soccer_shoes_1.png" class="img-datos-jugador-modal">
                            <span class="datos-jugador-small-modal">Lateralidad: <span class="lateralidad-banner" style="font-weight: bold;">Izquierdo </span> 
                            </span>
                        </div>                                                                 
                    </div>

                    <div style="position: relative;/* width: 300px; */margin: 0;float: right;right: 5%;top: -125px;">
                        <h5 style="color: black; font-size: 16px; line-height: 7px;text-transform: capitalize; display: block;margin: 0; display: inline-block; font-weight: normal;">
                            Club Actual: <span class="nombre-club-banner" style="font-weight: bold;">Colo Colo</span> 
                        </h5>
                        <img class="foto-club-banner" src="" style="width: 25px; position: relative; left: 5px; top: -2px;">
                    </div>              

                </div>            
            </div>
             
            <div class="row-fluid" style="margin: 35px;">
                <input type="hidden" name="cantidad_total_sesiones" id="cantidad_total_sesiones" autocomplete="off" value="">
                <center>
                    <img src="" class="imagen-jugador" style="width: 110px;border-radius: 50%;border: solid 2px;height: 110px;border: 1px white solid;position: relative;top: -230px;">
                </center>
            </div>
            
            <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
        </div>

    <!-- <button type="button" class="close" data-dismiss="modal" style="margin-top: -2px;color: #fff">&times;</button> --> 
    </div>

    <div class="modal-body" style="position: relative; top: -65px; max-height: 400px; padding: 15px; overflow-y: auto; width: 820px;">
        <div>
            
            <div class="row-fluid" style="margin-top:20px;">
                <div class="span12" style="margin: 0px;">
                    <h5 style="text-align: center; text-transform: uppercase; color: black;">Informe</h5>
                </div>
            </div>             

            <!-- ============================== Inicio del id="t_informe_general_detalle_modal" ============================== -->
            <table style="width:100%;">
                <tbody>
                    <tr class="sin_fondo">
                        <td style="width: 100%; padding: 0px;">
                            <div class="span12" style="display: flex; width: 100%;">                        
                                <a class="btn btn-md btn-primary green-a"> Recomendación:</a><input style="width: 30%!important;" class="my-input" id="recomendacion_icsj_modal" name="recomendacion_icsj_modal" type="text">
                            </div>
                        </td>                               
                    </tr>
                </tbody>
            </tbody>

            <!-- ============================== Inicio del id="t_informe_general_detalle_modal" ============================== -->
            <table style="width:100%; display: none;" id="t_informe_general_detalle_modal">
                <tbody>

                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo" style="color:#555555;">
                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                            <h5>Aspectos técnicos</h5>
                        </td>
                    </tr>
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo">
                        <td style="width: 100%; padding: 0px;">
                            <div class="span12" style="display: flex; width: 100%;">
                                <textarea style="resize: none; background-color: white;" class="textarea-informe-scouting" name="aspct_tecnico_icsjg_modal" id="aspct_tecnico_icsjg_modal" rows="7"></textarea>
                            </div>
                        </td>                               
                    </tr>
                    <!-- ============================================================================================================ --> 
                    <tr class="sin_fondo" style="color:#555555;">
                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                            <h5>Aspectos tácticos</h5>
                        </td>
                    </tr>
                    <!-- ============================================================================================================ -->  
                    <tr class="sin_fondo" style="color:#555555;"> 
                        <td style="width: 100%; padding: 0px;">
                            <div class="span12" style="display: flex; width: 100%;">
                                <textarea style="resize: none; background-color: white;" class="textarea-informe-scouting" id="aspct_tactico_icsjg_modal" name="aspct_tactico_icsjg_modal" rows="7"></textarea>
                            </div>
                        </td>                                                    
                    </tr>
                    <!-- ============================================================================================================ -->   
                    <tr class="sin_fondo" style="color:#555555;">
                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                            <h5>Aspectos físicos</h5>
                        </td>
                    </tr>
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo">
                        <td style="width: 100%; padding: 0px;">
                            <div class="span12" style="display: flex; width: 100%;">
                                <textarea style="resize: none; background-color: white;" class="textarea-informe-scouting" id="aspct_fisico_icsjg_modal" name="aspct_fisico_icsjg_modal" rows="7"></textarea>
                            </div>
                        </td>                               
                    </tr>
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo" style="color:#555555;">
                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                            <h5 style="display: inline-block;">Aspectos Psicológicos</h5>
                        </td>                          
                    </tr>
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo">
                        <td style="width: 100%; padding: 0px;">
                            <div class="span12" style="display: flex; width: 100%;">
                                <textarea style="resize: none; background-color: white;" class="textarea-informe-scouting" id="aspct_psico_icsjg_modal" name="aspct_psico_icsjg_modal" rows="7"></textarea>
                            </div>
                        </td>                               
                    </tr>
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo" style="color:#555555;">
                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                            <h5 style="display: inline-block;">Resumen</h5>
                        </td>                          
                    </tr>
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo">
                        <td style="width: 100%; padding: 0px;">
                            <div class="span12" style="display: flex; width: 100%;">
                                <textarea style="resize: none; background-color: white;" class="textarea-informe-scouting" id="resumen_obsrv_icsjg_modal" name="resumen_obsrv_icsjg_modal" rows="7"></textarea>
                            </div>
                        </td>                               
                    </tr> 
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo" style="color:#555555;">
                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                            <h5 style="display: inline-block;">Sugerencias</h5>
                        </td>                          
                    </tr>                    
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo">
                        <td style="width: 100%; padding: 0px;">
                            <div class="span12" style="display: flex; width: 100%;">
                                <textarea style="resize: none; background-color: white;" class="textarea-informe-scouting" id="sugerencias_icsjg_modal" name="sugerencias_icsjg_modal" rows="7"></textarea>
                            </div>
                        </td>                               
                    </tr> 
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo" style="color:#555555;">
                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                            <h5 style="display: inline-block;">Proyección</h5>
                        </td>                          
                    </tr>                    
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo">
                        <td style="width: 100%; padding: 0px;">
                            <div class="span12" style="display: flex; width: 100%;">
                                <textarea style="resize: none; background-color: white;" class="textarea-informe-scouting" id="proyeccion_icsjg_modal" name="proyeccion_icsjg_modal" rows="7"></textarea>
                            </div>
                        </td>                               
                    </tr> 
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo" style="color:#555555;">
                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                            <h5 style="display: inline-block;">Exportación</h5>
                        </td>                          
                    </tr>                    
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo">
                        <td style="width: 100%; padding: 0px;">
                            <div class="span12" style="display: flex; width: 100%;">
                                <textarea style="resize: none; background-color: white;" class="textarea-informe-scouting" id="exportacion_icsjg_modal" name="exportacion_icsjg_modal" rows="7"></textarea>
                            </div>
                        </td>                               
                    </tr>                                         
                </tbody>           
            </table> 
            <!-- ============================== Fin del id="t_informe_general_detalle_modal" ============================== -->     

            <!-- ============================== Inicio del id="t_informe_partido_detalle_modal" ============================== -->
            <table style="width:100%; display: none;" id="t_informe_partido_detalle_modal">
                <tbody>
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo" style="color:#555555;">
                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                            <h5>Observaciones generales del jugador en el partido</h5>
                        </td>
                    </tr>
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo">
                        <td style="width: 100%; padding: 0px;">
                            <div class="span12" style="display: flex; width: 100%;">
                                <textarea onkeyup="chequear_datos();" style="resize: none; background-color: white;" class="textarea-informe-scouting" name="observaciones_generales_icsjp_modal" id="observaciones_generales_icsjp_modal" rows="7"></textarea>
                            </div>
                        </td>                               
                    </tr>
                    <!-- ============================================================================================================ --> 
                    <tr class="sin_fondo" style="color:#555555;">
                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                            <h5>Aspectos Ofensivos</h5>
                        </td>
                    </tr>
                    <!-- ============================================================================================================ -->  
                    <tr class="sin_fondo" style="color:#555555;"> 
                        <td style="width: 100%; padding: 0px;">
                            <div class="span12" style="display: flex; width: 100%;">
                                <textarea onkeyup="chequear_datos();" style="resize: none; background-color: white;" class="textarea-informe-scouting" id="aspct_ofen_icsjp_modal" name="aspct_ofen_icsjp_modal" rows="7"></textarea>
                            </div>
                        </td>                                                    
                    </tr>
                    <!-- ============================================================================================================ -->   
                    <tr class="sin_fondo" style="color:#555555;">
                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                            <h5>Aspectos Defensivos</h5>
                        </td>
                    </tr>
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo">
                        <td style="width: 100%; padding: 0px;">
                            <div class="span12" style="display: flex; width: 100%;">
                                <textarea onkeyup="chequear_datos();" style="resize: none; background-color: white;" class="textarea-informe-scouting" id="aspct_def_icsjp_modal" name="aspct_def_icsjp_modal" rows="7"></textarea>
                            </div>
                        </td>                               
                    </tr>
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo" style="color:#555555;">
                        <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                            <h5 style="display: inline-block;">Aspectos Físicos</h5>
                        </td>                          
                    </tr>
                    <!-- ============================================================================================================ -->
                    <tr class="sin_fondo">
                        <td style="width: 100%; padding: 0px;">
                            <div class="span12" style="display: flex; width: 100%;">
                                <textarea onkeyup="chequear_datos();" style="resize: none; background-color: white;" class="textarea-informe-scouting" id="aspct_fisico_icsjp_modal" name="aspct_fisico_icsjp_modal" rows="7"></textarea>
                            </div>
                        </td>                               
                    </tr>
                </tbody>           
            </table>
            <!-- ============================== Fin del id="t_informe_partido_detalle_modal" ============================== -->

        </div>                          
    </div>
</div>
<!-- ========================================== Fin del id="modal_detalle_informe" ========================================== -->


<!-- ======================================== Inicio del id="modal_agregar_video" ======================================== -->
<div id="modal_agregar_video" class="modal hide in" style="border-radius: 10px; width: 700px;" aria-hidden="false">

    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>;border-top-right-radius: 5px;padding: 15px;border-top-left-radius: 5px;">
        <h3 style="text-transform: uppercase;text-align: center;font-size: 22px;color: white;text-shadow: none;">AGREGAR NUEVO VÍDEO</h3>
        <button type="button" class="close" data-dismiss="modal" style="margin-top: -30px; color: black;">×</button>
    </div>
    
    <div class="modal-body">
        
        <div style="margin: auto;width: 45%;">
            <div style="display: flex;">
                <a class="btn btn-md btn-primary black-a" style="width: 50%;">Fecha vídeo:</a>
                <input readonly class="black-input select-posicion-jugador date-picker" style="width: 50%;height: 28px;" id="fecha_video_modal" name="fecha_video_modal" onchange="chequear_datos_form_informe_icsj();">
            </div>            
        </div>

        <hr style="border-bottom: 1px solid #c6c2c2;">    
            <div>
                <div style="display: inline-block; width: 40%;">
                    <label class="label-input-modal-video">Servidor:</label>
                    <select onkeyup="chequear_datos_form_informe_icsj();" class="input-modal-video" type="" id="servidor_video_modal" name="servidor_video_modal" style="width: 90%; -webkit-appearance: none; height: 35px; position: relative; top: 5px;">
                        <option value="1">Vimeo</option>
                        <option value="2">YouTube</option>
                    </select>                        
                </div>   
                <div style="display: inline-block; width: 59%;">
                    <label class="label-input-modal-video">Título del vídeo (corto):</label>
                    <input onkeyup="chequear_datos_form_informe_icsj();" class="input-modal-video" type="" id="titulo_video_modal" name="titulo_video_modal" style="width: 100%;">                   
                </div>     
                <div style="margin-top: 8px;">
                    <label class="label-input-modal-video">Link del vídeo:</label>
                    <input onkeyup="chequear_datos_form_informe_icsj();" class="input-modal-video" type="" id="link_video_modal" name="link_video_modal" style="width: 99.5%;">                           
                </div>            
            </div>
        <hr style="border-bottom: 1px solid #c6c2c2;">
        <div style="/* background-color: orange; */">
            <div style="display: inline-block;width: 30%;float: left;">
                <img src="../config/pause-video-icon.png" style="width: 80px;display: block;margin: auto;">
            </div>
            <div style="display: inline-block;width: 33%;">
                <label class="label-input-modal-video">Categoría:</label>
                <select class="black-input" type="" id="categoria_video_modal" name="categoria_video_modal" style="width: 99.5%;height: 35px;" onchange="chequear_datos_form_informe_icsj();">
                    <option value="0" selected="">Partidos</option>
                    <option value="1">Entrenamientos</option>
                    <option value="2">Resúmen</option>
                    <option value="3">Otros</option>
                </select>                  
            </div>
            <div style="display: inline-block;width: 33%;margin-left: 22px;">
                <label class="label-input-modal-video">Sub-categoría:</label>
                <select class="black-input" type="" id="sub_categoria_video_modal" name="sub_categoria_video_modal" style="width: 99.5%;height: 35px;" onchange="chequear_datos_form_informe_icsj();">
                    <option value="0">Todas</option><option value="1">Amistoso Completo</option><option value="2">Oficial completo</option><option value="3">Goles a favor (Resumen)</option><option value="4">Goles a favor por ABP</option><option value="5">Gol a favor por recuperacion</option><option value="6">Goles a favor por reanudacion</option><option value="7">Goles rival (Resumen)</option><option value="8">Gol jugador</option><option value="9">Balones detenidos a favor</option><option value="10">Balones detenidos en contra</option><option value="11">Mejores jugadas propias</option><option value="12">Mejores jugadas del rival</option><option value="13">Transiciones Of</option><option value="14">Transiciones Def</option><option value="15">Salida corta</option><option value="16">Salida larga</option><option value="17">Ataque organizado</option><option value="18">Contraataque</option><option value="19">Ataque directo</option><option value="20">Presion alta</option><option value="21">Duelos ofensivos</option><option value="22">Duelos defensivos</option><option value="23">Error arquero</option><option value="24">Presion tras perdida</option><option value="25">Defensa organizada repliegue</option><option value="26">Gol rival por ABP</option><option value="27">Gol rival por recuperacion</option><option value="28">Gol rival por reanudacion</option><option value="29">Finalizaciones</option><option value="30">Ocasiones de gol por recuperacion</option><option value="31">Ocasiones de gol por reanudacion</option><option value="32">Ocasiones de gol por balones detenidos</option><option value="33">Ocasiones en contra por ABP</option><option value="34">Ocasiones en contra por reanudacion</option><option value="35">Ocasiones en contra por recuparacion</option>
                </select>                     
            </div>
        </div>
    </div>

    <div class="modal-footer" style="background-color: <?php echo $color_fondo; ?>;">
        <button type="button" class="boton_agregar_video_modal" onclick="boton_guardar_video_modal();" onclick="" id="" style="display: block;margin: auto;">
            <i class="icon-check"></i> GUARDAR VÍDEO
        </button>
    </div>

</div>
<!-- ======================================== Fin del id="modal_agregar_video" ======================================== -->


<div id="myModal1" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_agregar_proveedor" style="color:black;">
              <h5>¿Estás seguro que quieres agregar este Proveedor?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="guardar_registro();" ng-click="desactivarBotonAgregarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>
      
      
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

<!-- ========================================================== Inicio del id="uploadImageModalJugador" ========================================================== -->
<div id="uploadImageModalJugador" class="modal hide" role="dialog" style="border-radius:10px;">
    <div class="modal-header" style="background-color:<?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:white; font-family:Arial, Helvetica, sans-serif; background-color:black;">
     <center>
        <div class="imagen_subir_jugador" id="image_demo_jugador" style="width:350px; margin-top:10px;"></div>      
        <div class="texto_subir_jugador" style="margin-top:10px;"></div>    
        <!--<button class="btn btn-success crop_image">USAR ESTA IMAGEN</button>-->     
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center>
          <button type="button" id="crop_image_jugador" class="btn btn-default boton_modal" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> USAR ESTA IMAGEN</button></center>
    </div>
</div>
<!-- ========================================================== Fin del id="uploadImageModalJugador" ========================================================== -->
      
<!-- ========================================================== Inicio del id="uploadImageModalEntrenador" ========================================================== -->
<div id="uploadImageModalEntrenador" class="modal hide" role="dialog" style="border-radius:10px;">
    <div class="modal-header" style="background-color:<?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:white; font-family:Arial, Helvetica, sans-serif; background-color:black;">
     <center>
        <div class="imagen_subir_entrenador" id="image_demo_entrenador" style="width:350px; margin-top:10px;"></div>        
        <div class="texto_subir_entrenador" style="margin-top:10px;"></div> 
        <!--<button class="btn btn-success crop_image">USAR ESTA IMAGEN</button>-->     
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center>
          <button type="button" id="crop_image_entrenador" class="btn btn-default boton_modal" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> USAR ESTA IMAGEN</button></center>
    </div>
</div>
<!-- ========================================================== Fin del id="uploadImageModalEntrenador" ========================================================== -->

      
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

// Agregando placeholer a todos los inputs de tipo fecha:
$('.date-picker').each(function(){
    let thisElement = $(this);
    thisElement.attr('placeholder', 'Click aquí');
});

$("input:radio[name='cond_equipo1_entrenadorpartido']").click(function() {
    
    // Local:
    if($('#condicion_local_equipo1_entrenadorpartido').is(':checked')) {
        $('#condicion_local_equipo2_entrenadorpartido').prop('checked', false);
        $('#condicion_visita_equipo2_entrenadorpartido').prop('checked', true);
    } 

    // Visita:
    if($('#condicion_visita_equipo1_entrenadorpartido').is(':checked')) {
        $('#condicion_visita_equipo2_entrenadorpartido').prop('checked', false);
        $('#condicion_local_equipo2_entrenadorpartido').prop('checked', true);
    }     

});

$("input:radio[name='cond_equipo2_entrenadorpartido']").click(function() {

    // Local:
    if($('#condicion_local_equipo2_entrenadorpartido').is(':checked')) {
        $('#condicion_local_equipo1_entrenadorpartido').prop('checked', false);
        $('#condicion_visita_equipo1_entrenadorpartido').prop('checked', true);
    }

    // Visita:
    if($('#condicion_visita_equipo2_entrenadorpartido').is(':checked')) {
        $('#condicion_visita_equipo1_entrenadorpartido').prop('checked', false);
        $('#condicion_local_equipo1_entrenadorpartido').prop('checked', true);
    }    


});       


// ******************************************************************************************************************************************************************************************************************************************* INICIO DE FUNCIONES EN COMÚN CON EL MÓDULO 'BÚSQUEDA SCOUTING' ******************************************************************************************************************************************************************************************************************************************* //

// *********************************** JUGADOR *********************************** //

// -------------------- Inicio de la función 'ocultar_datos_fichaJugador()' -------------------- //
function ocultar_datos_fichaJugador() {
    // $(".datos_fichaJugador").hide();
    $("#boton_agregar_ficha_jugador").hide();   
}
// -------------------- Fin de la función 'ocultar_datos_fichaJugador()' -------------------- //

// -------------------- Inicio de la función 'mostrar_datos_fichaJugador()' -------------------- //
function mostrar_datos_fichaJugador() {
    // $(".datos_fichaJugador").show();
    $("#boton_agregar_ficha_jugador").show();   
}
// -------------------- Fin de la función 'mostrar_datos_fichaJugador()' -------------------- //


$('a[href="#tab_form_fichajugador"]').click(function(){
    mostrar_datos_fichaJugador();
});

$('a[href="#tab_form_partido"]').click(function(){
    ocultar_datos_fichaJugador();
});

// *********************************** ENTRENADOR *********************************** //

// -------------------- Inicio de la función 'ocultar_datos_entrenador()' -------------------- //
function ocultar_datos_entrenador() {
    // $(".datos_form_entrenador").hide();
    $("#boton_agregar_entrenador").hide();   
}
// -------------------- Fin de la función 'ocultar_datos_entrenador()' -------------------- //

// -------------------- Inicio de la función 'mostrar_datos_fichaJugador()' -------------------- //
function mostrar_datos_entrenador() {
    // $(".datos_form_entrenador").show();
    $("#boton_agregar_entrenador").show();   
}
// -------------------- Fin de la función 'mostrar_datos_fichaJugador()' -------------------- //

$('a[href="#tab_form_entrenador"]').click(function(){
    mostrar_datos_entrenador();
});

$('a[href="#tab_form_partido_entrenador"]').click(function(){
    ocultar_datos_entrenador();
});

// -------------------- Inicio de la función 'cambiar_color_contenedor()' -------------------- //
function cambiar_color_contenedor() {
    $("#content").css("background-color" , "#232323");  
}
// -------------------- Fin de la función 'cambiar_color_contenedor()' -------------------- //

// ---------- OCULTANDO POR DEFECTO LOS SIGUIENTES CAMPOS ---------- //
$('.campo-club-jugador-libre-otro').hide();
$('.campo-club-jugadorenclub-otro').hide();
$('.campo-club-entrenador-otro').hide();
$('.campo-campeonato-otro').hide();
$('.campo-campeonato-entrenador-otro').hide();
$('.campo-club-rival-otro').hide();
$('.campo-club-rival-entrenador-otro').hide();

// ---------- Mostrando los campos para agregar nuevo club según sea el caso (Jugador Libre) ---------- //:
$('#idclub_jugadorlibre').change(function(){
    let thisValue = $(this).val(); 
    if( thisValue == "000" ) {
        $('.campo-club-jugador-libre-otro').show();                             
    } else {
        $('.campo-club-jugador-libre-otro').hide();
    }
    chequear_datos_form_fichajugador(); // <--- Validando el formulario de la ficha del jugador.
});

// ---------- Mostrando los campos para agregar nuevo club según sea el caso (Jugador en club) ---------- //
$('#idclub_actual_jugadorenclub').change(function(){
    let thisValue = $(this).val(); 
    if( thisValue == "000" ) {
        $('.campo-club-jugadorenclub-otro').show();
        $('#pais_club_actual').parent().hide();
        $('#division_club_actual').parent().hide();                                     
    } else {
        $('.campo-club-jugadorenclub-otro').hide();
        $('#pais_club_actual').parent().show();
        $('#division_club_actual').parent().show();
    }
    chequear_datos_form_fichajugador(); // <--- Validando el formulario de la ficha del jugador.
});

// ---------- Mostrando los campos para agregar nuevo campeonato según sea el caso (JUGADOR)---------- //
$('#idcampeonato').change(function(){
    let thisValue = $(this).val(); 
    if( thisValue == "000" ) {
        $('.campo-campeonato-otro').show();
        $("#idclub_rival").append('<option value="">Seleccione</option>'); // <--- Importante.
        $("#idclub_rival").append('<option value="000">Otro</option>'); // <--- Importante.        
    } else {
        $('.campo-campeonato-otro').hide();
    }
    // chequear_datos_form_partidojugador(); // <--- Validando el formulario de partidos del jugador.
});

// ---------- Mostrando los campos para agregar nuevo campeonato según sea el caso (ENTRENADOR)---------- //
$('#idcampeonato_entrenador').change(function(){
    let thisValue = $(this).val(); 
    if( thisValue == "000" ) {
        $('.campo-campeonato-entrenador-otro').show();
        $("#idclub_rival_entrenador").append('<option value="">Seleccione</option>'); // <--- Importante.
        $("#idclub_rival_entrenador").append('<option value="000">Otro</option>'); // <--- Importante.         
    } else {
        $('.campo-campeonato-entrenador-otro').hide();
    }
    // chequear_datos_form_partidoentrenador(); // <--- Validando el formulario de partidos del entrenador.
});


// ---------- Mostrando los campos para agregar nuevo club según sea el caso (Rival - JUGADOR) ---------- //
$('#idclub_rival').change(function(){
    let thisValue = $(this).val(); 
    if( thisValue == "000" ) {
        $('.campo-club-rival-otro').show();
    } else {
        $('.campo-club-rival-otro').hide();
    }
    // chequear_datos_form_partidojugador(); // <--- Validando el formulario de partidos del jugador.
});

// ---------- Mostrando los campos para agregar nuevo club según sea el caso (Rival - ENTRENADOR) ---------- //
$('#idclub_rival_entrenador').change(function(){
    let thisValue = $(this).val(); 
    if( thisValue == "000" ) {
        $('.campo-club-rival-entrenador-otro').show();
    } else {
        $('.campo-club-rival-entrenador-otro').hide();
    }
    // chequear_datos_form_partidojugador(); // <--- Validando el formulario de partidos del entrenador.
});
   

// --------------- Inicio de la función 'get_divisiones_from_pais()' --------------- //
function get_divisiones_from_pais( form ) {
    
    var pais_club;
    var division_club;

    switch( form ) {

        case 0: // <---- Ficha Jugador - Jugador libre 
            pais_club = $('#pais_club_jugadorlibre_otro');
            division_club = $('#division_club_jugadorlibre_otro');
            break;

        case 1: // <---- Ficha Jugador - Jugador en club 
            pais_club = $('#pais_club_actual');
            division_club = $('#division_club_actual');
            break;

        case 2: // <---- Ficha Jugador - Jugador en club - Otro
            pais_club = $('#pais_club_jugadorenclub_otro');
            division_club = $('#division_club_jugadorenclub_otro');
            break;            

        case 3: // <---- Partido Jugador
            pais_club = $('#pais_club_rival_otro');
            division_club = $('#division_club_rival_otro');
            break;

        case 4: // <---- Entrenador
            pais_club = $('#pais_club_actual_entrenador');
            division_club = $('#division_club_actual_entrenador');
            break;

        case 5: // <---- Entrenador (otro) 
            pais_club = $('#pais_club_entrenador_otro');
            division_club = $('#division_club_entrenador_otro');
            break;  

        case 6: // <---- Entrenador partido 
            pais_club = $('#pais_club_rival_entrenador_otro');
            division_club = $('#division_club_rival_entrenador_otro');
            break;   

        case 7: // <---- Partido de Informes Scouting
            pais_club = $('#pais_club_rival_otro_icsjp');
            division_club = $('#division_club_rival_otro_icsjp');
            break; 

        // --------------- Campeonatos --------------- //           
        case 8: // <---- Partidos de jugador
            pais_club = $('#pais_campeonato_otro');
            division_club = $('#division_campeonato_otro');
            break;  

        case 9: // <---- Partidos de entrenador
            pais_club = $('#pais_campeonato_entrenador_otro');
            division_club = $('#division_campeonato_entrenador_otro');
            break;

        case 10: // <---- Partidos de Informe Scouting
            pais_club = $('#pais_campeonato_otro_icsjp');
            division_club = $('#division_campeonato_otro_icsjp');
            break; 

        case 11: // <---- Jugadores Scouting en Seguimento
            pais_club = $('#idpais_fbjscouting_main');
            division_club = $('#division_fbjscouting_main');
            break;

        case 12: // <---- Entrenadores Scouting en Seguimento
            pais_club = $('#idpais_entrenador_cscouting');
            division_club = $('#division_entrenador_cscouting');
            break;                                                                                    

    }

    pais_club = pais_club.val();
    division_club.empty(); // <--- Vaciando select.          
                        
    let divisiones_pais_selected = array_divisiones[pais_club];
    // console.log( divisiones_pais_selected );
    if( typeof divisiones_pais_selected !== 'undefined' ) {

        // console.log( divisiones_pais_selected );
        // --------------------- Agregando los valores del array del estado del club de jugadores --------------------- //
        // FILTRO DE BÚSQUEDA:
        divisiones_pais_selected = divisiones_pais_selected.filter(function(){return true;}); // Reiniciando el valor de los índices de 0 a n.
        division_club.append('<option value="">Seleccione</option>');
        for (var i = 0; i < divisiones_pais_selected.length; i++) {
            division_club.append('<option value="'+divisiones_pais_selected[i][0]+'">'+divisiones_pais_selected[i][1]+'</option>');
        } 

    } else {
        division_club.append('<option value="">No se encontraron divisiones según el país seleccionado</option>');
    }

    // Validando según el formulario del select:
    switch( form ) {

        case 0: // <---- Ficha Jugador - Jugador libre 
            /*
            pais_club = $('#pais_club_jugadorlibre_otro');
            division_club = $('#division_club_jugadorlibre_otro');
            */
            chequear_datos_form_fichajugador();
            break;

        case 1: // <---- Ficha Jugador - Jugador en club
            /* 
            pais_club = $('#pais_club_actual');
            division_club = $('#division_club_actual');
            */
            chequear_datos_form_fichajugador();
            break;

        case 2: // <---- Ficha Jugador - Jugador en club - Otro
            /*
            pais_club = $('#pais_club_jugadorenclub_otro');
            division_club = $('#division_club_jugadorenclub_otro');
            */
            chequear_datos_form_fichajugador();
            break;            

        case 3: // <---- Partido Jugador
            /*
            pais_club = $('#pais_club_rival_otro');
            division_club = $('#division_club_rival_otro');
            */
            chequear_datos_form_partidojugador();
            break;

        case 4: // <---- Entrenador
            /*
            pais_club = $('#pais_club_actual_entrenador');
            division_club = $('#division_club_actual_entrenador');
            */
            break;

        case 5: // <---- Entrenador (otro)
            /* 
            pais_club = $('#pais_club_entrenador_otro');
            division_club = $('#division_club_entrenador_otro');
            */
            chequear_datos_form_entrenador();
            break;  

        case 6: // <---- Entrenador partido
            /* 
            pais_club = $('#pais_club_rival_entrenador_otro');
            division_club = $('#division_club_rival_entrenador_otro');
            */
            chequear_datos_form_partidoentrenador();
            break;   

        case 7: // <---- Partido de Informes Scouting
            /*
            pais_club = $('#pais_club_rival_otro_icsjp');
            division_club = $('#division_club_rival_otro_icsjp');
            */
            chequear_datos_form_informe_icsj();
            break;


        // -------------- Campeonatos -------------- //
        case 8: // <---- Partidos de jugador
            /*
            pais_club = $('#pais_campeonato_otro');
            division_club = $('#division_campeonato_otro');
            */
            chequear_datos_form_partidojugador();
            break;                                    

        case 9: // <---- Partidos de entrenador
            /*
            pais_club = $('#pais_campeonato_entrenador_otro');
            division_club = $('#division_campeonato_otro');
            */
            chequear_datos_form_partidoentrenador();
            break;            

        case 10: // <---- Partidos de Informe Scouting
            /*
            pais_club = $('#pais_campeonato_otro_icsjp');
            division_club = $('#division_campeonato_otro_icsjp');
            */
            chequear_datos_form_informe_icsj();
            break; 

        case 11: // <---- Jugadores Scouting en Seguimento
            /*
            pais_club = $('#idpais_fbjscouting_main');
            division_club = $('#division_fbjscouting_main');
            */
            buscar_jugadores_seguimiento( 2 );
            break;

        case 12: // <---- Entrenadores Scouting en Seguimento
            /*
            pais_club = $('#idpais_entrenador_cscouting');
            division_club = $('#division_entrenador_cscouting');
            */
            buscar_entrenadores_seguimiento( 2 );
            break;  

    }


}
// --------------- Fin de la función 'get_divisiones_from_pais()' --------------- //            

// ----------- CONSULTANDO CLUBES CUANDO SE SELECCIONA OTRO CAMPEONATO --------------------- //

// ------------ Partidos de Jugador ------------ //
$('#division_campeonato_otro').change(function(){
    // Seleccionando el ID de club según el país y división seleccionado (para el select #idclub_actual_jugadorenclub):
    // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
            'pais_club': $('#pais_campeonato_otro').val(),
            'division_club': $('#division_campeonato_otro').val() 
        },
        success: function(respuesta)  {
            $('#idclub_rival').empty(); // <--- Vaciando select.
            if( respuesta== "" ) { //jugador sin informes
                console.log("No se encontró ningún club según el país y división seleccionada...");
                $("#idclub_rival").append('<option value="">Seleccione primero una división</option>');
            } else {                            
                $("#idclub_rival").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $("#idclub_rival").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }
                $("#idclub_rival").append('<option value="000">Otro</option>');
            } 
        
        },
        error: function(){// will fire when timeout is reached
            $('#idclub_rival').empty(); // <--- Vaciando select.
            console.log('Error al consulta clubes para el select de club actual del jugador');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
    // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
});

// ------------ Partidos de Entrenador ------------ //
$('#division_campeonato_entrenador_otro').change(function(){
    // Seleccionando el ID de club según el país y división seleccionado (para el select #idclub_actual_jugadorenclub):
    // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
            'pais_club': $('#pais_campeonato_entrenador_otro').val(),
            'division_club': $('#division_campeonato_entrenador_otro').val() 
        },
        success: function(respuesta)  {
            $('#idclub_rival_entrenador').empty(); // <--- Vaciando select.
            if( respuesta== "" ) { //jugador sin informes
                console.log("No se encontró ningún club según el país y división seleccionada...");
                $("#idclub_rival_entrenador").append('<option value="">Seleccione primero una división</option>');
            } else {                            
                $("#idclub_rival_entrenador").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $("#idclub_rival_entrenador").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }
                $("#idclub_rival_entrenador").append('<option value="000">Otro</option>');
            } 
        
        },
        error: function(){// will fire when timeout is reached
            $('#idclub_rival_entrenador').empty(); // <--- Vaciando select.
            console.log('Error al consulta clubes para el select de club actual del jugador');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
    // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
});

// ------------ Partidos de Informe Scouting ------------ //
$('#division_campeonato_otro_icsjp').change(function(){
    // Seleccionando el ID de club según el país y división seleccionado (para el select #idclub_actual_jugadorenclub):
    // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
            'pais_club': $('#pais_campeonato_otro_icsjp').val(),
            'division_club': $('#division_campeonato_otro_icsjp').val() 
        },
        success: function(respuesta)  {
            $('#idclub_rival_icsjp').empty(); // <--- Vaciando select.
            if( respuesta== "" ) { //jugador sin informes
                console.log("No se encontró ningún club según el país y división seleccionada...");
                $("#idclub_rival_icsjp").append('<option value="">Seleccione primero una división</option>');
            } else {                            
                $("#idclub_rival_icsjp").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $("#idclub_rival_icsjp").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }
                $("#idclub_rival_icsjp").append('<option value="000">Otro</option>');
            } 
        
        },
        error: function(){// will fire when timeout is reached
            $('#idclub_rival_icsjp').empty(); // <--- Vaciando select.
            console.log('Error al consulta clubes para el select de club actual del jugador');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
    // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
});


// --------------- Inicio de la función 'get_clubes_from_paisdivision_jugadores_scouting()' --------------- //
function get_clubes_from_paisdivision_jugadores_scouting() {
    
    var pais_club = $('#idpais_fbjscouting_main').val();
    var division_club = $('#division_fbjscouting_main').val();
    $("#idclub_fbjscouting_main").empty();

    // Inhabilitando el select de club dinámico:
    // $('#idclub_fbjscouting_main').prop("disabled", true).css('background-color', '#cfcccc');

    // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
            'pais_club': pais_club,
            'division_club': division_club 
        },
        success: function(respuesta)  {
            $('#idclub_fbjscouting_main').empty(); // <--- Vaciando select.
            if( respuesta== "" ) { //jugador sin informes
                console.log("No se encontró ningún club según el país y división seleccionada...");
                $("#idclub_fbjscouting_main").append('<option value="">No se encontraron clubes</option>');
            } else {              
                                
                $("#idclub_fbjscouting_main").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $("#idclub_fbjscouting_main").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }           } 
        
        },
        error: function(){// will fire when timeout is reached
            console.log('Error al consultar clubes para el select de clubes del jugador');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
    // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //

    buscar_jugadores_seguimiento( 2 );
}
// --------------- Fin de la función 'get_clubes_from_paisdivision_jugadores_scouting()' --------------- //

// --------------- Inicio de la función 'get_clubes_from_paisdivision_entrenadores_scouting()' --------------- //
function get_clubes_from_paisdivision_entrenadores_scouting() {
    
    var pais_club = $('#idpais_entrenador_cscouting').val();
    var division_club = $('#division_entrenador_cscouting').val();
    $("#idclub_entrenador_cscouting").empty();

    // Inhabilitando el select de club dinámico:
    // $('#idclub_entrenador_cscouting').prop("disabled", true).css('background-color', '#cfcccc');

    // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
            'pais_club': pais_club,
            'division_club': division_club 
        },
        success: function(respuesta)  {
            $('#idclub_entrenador_cscouting').empty(); // <--- Vaciando select.
            if( respuesta== "" ) { //jugador sin informes
                console.log("No se encontró ningún club según el país y división seleccionada...");
                $("#idclub_entrenador_cscouting").append('<option value="">No se encontraron clubes</option>');
            } else {              
                                
                $("#idclub_entrenador_cscouting").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $("#idclub_entrenador_cscouting").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }           } 
        
        },
        error: function(){// will fire when timeout is reached
            console.log('Error al consultar clubes para el select de clubes del jugador');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
    // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //

    buscar_entrenadores_seguimiento( 2 );
}
// --------------- Fin de la función 'get_clubes_from_paisdivision_entrenadores_scouting()' --------------- //

// --------------- Inicio de la función 'get_clubes_from_paisdivision()' --------------- //
function get_clubes_from_paisdivision() {
    

    var pais_club = $('.select-pais-dinamico').val();
    var division_club = $('.select-division-dinamico').val();
    $(".select-idclub-dinamico").empty();

    // Inhabilitando el select de club dinámico:
    // $('.select-idclub-dinamico').prop("disabled", true).css('background-color', '#cfcccc');

    // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
            'pais_club': pais_club,
            'division_club': division_club 
        },
        success: function(respuesta)  {
            $('.select-idclub-dinamico').empty(); // <--- Vaciando select.
            if( respuesta== "" ) { //jugador sin informes
                console.log("No se encontró ningún club según el país y división seleccionada...");
                $(".select-idclub-dinamico").append('<option value="">No se encontraron clubes</option>');
                $(".select-idclub-dinamico").append('<option value="000">Otro</option>');
            } else {              
                                
                $(".select-idclub-dinamico").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $(".select-idclub-dinamico").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }
                $(".select-idclub-dinamico").append('<option value="000">Otro</option>');
            } 
        
        },
        error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
                $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
    // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //

    chequear_datos_form_fichajugador();
}
// --------------- Fin de la función 'get_clubes_from_paisdivision()' --------------- //

// --------------- Inicio de la función 'get_clubes_from_paisdivision_entrenador()' --------------- //
function get_clubes_from_paisdivision_entrenador() {
    

    var pais_club = $('#pais_club_actual_entrenador').val();
    var division_club = $('#division_club_actual_entrenador').val();
    $("#idclub_actual_entrenador").empty();

    // Inhabilitando el select de club dinámico:
    // $('#idclub_actual_entrenador').prop("disabled", true).css('background-color', '#cfcccc');

    // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
    $.ajax({
        url: "post/scouting_centro_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paisdivision_entrenador', // <---- Consultando clubes según el país y la división.
            'pais_club': pais_club,
            'division_club': division_club 
        },
        success: function(respuesta)  {
            $('#idclub_actual_entrenador').empty(); // <--- Vaciando select.
            if( respuesta== "" ) { //jugador sin informes
                console.log("No se encontró ningún club según el país y división seleccionada...");
                $("#idclub_actual_entrenador").append('<option value="">No se encontraron clubes</option>');
                $("#idclub_actual_entrenador").append('<option value="000">Otro</option>');
            } else {              
                                
                $("#idclub_actual_entrenador").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $("#idclub_actual_entrenador").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }
                $("#idclub_actual_entrenador").append('<option value="000">Otro</option>');
            } 
        
        },
        error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
                $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
    // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //

    chequear_datos_form_entrenador();
}
// --------------- Fin de la función 'get_clubes_from_paisdivision_entrenador()' --------------- //
 
// --------------- Inicio de la función 'get_clubes_from_paiscampeonato()' --------------- //
function get_clubes_from_paiscampeonato() {

    var idcampeonato = $('#idcampeonato').val();
    var pais_campeonato = $('#idcampeonato option:selected').attr('pais-campeonato');

    // Seleccionando el país del campeonato:
    // $('#pais_club_rival_otro').prop('disabled', true);
    $('#pais_club_rival_otro option').each(function(){
        let thisElement = $(this);
        let thisValue = thisElement.val();
        if( thisValue == pais_campeonato ) {
            thisElement.prop('selected', true)
        }
    });

    get_divisiones_from_pais( 3 ); // Consultando las divisiones según el país.

    if( idcampeonato == '' ) {
        $("#idclub_rival").empty();
        $("#idclub_rival").append('<option value="">Seleccione primero un campeonato</option>');
    } else {

        $("#idclub_rival").empty();

        // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
        $.ajax({
            url: "post/scouting_busqueda_ver.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
                'tipo_consulta': 'get_clubes_from_paiscampeonato', // <---- Consultando clubes según el país del campeonato seleccionado.
                'pais_campeonato': pais_campeonato
            },
            success: function(respuesta)  {
                $('#idclub_rival').empty(); // <--- Vaciando select.
                if( respuesta== "" ) { //jugador sin informes
                    console.log("No se encontró ningún club según el país del campeonato seleccionado...");
                    $("#idclub_rival").append('<option value="">No se encontraron clubes</option>');
                    $("#idclub_rival").append('<option value="000">Otro</option>');
                } else {              
                                    
                    $("#idclub_rival").append('<option value="">Seleccione</option>');
                    for(var i=0; i < respuesta.length; i++) {   
                        $("#idclub_rival").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                    }
                    $("#idclub_rival").append('<option value="000">Otro</option>');
                } 
            
            },
            error: function(){// will fire when timeout is reached
                console.log('Error al consultar clubes para el select de clubes del rival');
            }, timeout: 15000 // sets timeout to 3 seconds
        }); 
        // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //

    }


    chequear_datos_form_partidojugador(); // <--- Ejecutando validación.
}
// --------------- Fin de la función 'get_clubes_from_paiscampeonato()' --------------- //


// --------------- Inicio de la función 'get_clubes_from_paiscampeonato_entrenador()' --------------- //
function get_clubes_from_paiscampeonato_entrenador() {

    var idcampeonato_entrenador = $('#idcampeonato_entrenador').val();
    var pais_campeonato = $('#idcampeonato_entrenador option:selected').attr('pais-campeonato');

    // Seleccionando el país del campeonato:
    // $('#pais_club_rival_entrenador_otro').prop('disabled', true);
    $('#pais_club_rival_entrenador_otro option').each(function(){
        let thisElement = $(this);
        let thisValue = thisElement.val();
        if( thisValue == pais_campeonato ) {
            thisElement.prop('selected', true)
        }
    });

    get_divisiones_from_pais( 6 ); // Consultando las divisiones según el país.

    if( idcampeonato_entrenador == '' ) {
        $("#idclub_rival_entrenador").empty();
        $("#idclub_rival_entrenador").append('<option value="">Seleccione primero un campeonato</option>');
    } else {

        // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
        $.ajax({
            url: "post/scouting_centro_ver.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
                'tipo_consulta': 'get_clubes_from_paiscampeonato_entrenador', // <---- Consultando clubes según el país del campeonato seleccionado.
                'pais_campeonato': pais_campeonato
            },
            success: function(respuesta)  {
                $('#idclub_rival_entrenador').empty(); // <--- Vaciando select.
                if( respuesta== "" ) { //jugador sin informes
                    console.log("No se encontró ningún club según el país del campeonato seleccionado...");
                    $("#idclub_rival_entrenador").append('<option value="">No se encontraron clubes</option>');
                    $("#idclub_rival_entrenador").append('<option value="000">Otro</option>');
                } else {              
                                    
                    $("#idclub_rival_entrenador").append('<option value="">Seleccione</option>');
                    for(var i=0; i < respuesta.length; i++) {   
                        $("#idclub_rival_entrenador").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                    }
                    $("#idclub_rival_entrenador").append('<option value="000">Otro</option>');
                } 
            
            },
            error: function(){// will fire when timeout is reached
                console.log('Error al consultar clubes para el select de clubes del rival');
            }, timeout: 15000 // sets timeout to 3 seconds
        }); 
        // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
        
    }

    chequear_datos_form_partidoentrenador(); // <--- Ejecutando validación.
}
// --------------- Fin de la función 'get_clubes_from_paiscampeonato_entrenador()' --------------- //

// --------------- Inicio de la función 'get_clubes_from_paiscampeonato_icsjp()' --------------- //
function get_clubes_from_paiscampeonato_icsjp() {

    var idcampeonato_icsjp = $('#idcampeonato_icsjp').val();
    var pais_campeonato = $('#idcampeonato_icsjp option:selected').attr('pais-campeonato');

    // Seleccionando el país del campeonato:
    // $('#pais_club_rival_otro_icsjp').prop('disabled', true);
    $('#pais_club_rival_otro_icsjp option').each(function(){
        let thisElement = $(this);
        let thisValue = thisElement.val();
        if( thisValue == pais_campeonato ) {
            thisElement.prop('selected', true)
        }
    });

    get_divisiones_from_pais( 7 ); // Consultando las divisiones según el país.

    if( idcampeonato_icsjp == '' ) {
        $("#idclub_rival_icsjp").empty();
        $("#idclub_rival_icsjp").append('<option value="">Seleccione primero un campeonato</option>');
    } else {

        $("#idclub_rival_icsjp").empty();

        // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
        $.ajax({
            url: "post/scouting_centro_ver.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
                'tipo_consulta': 'get_clubes_from_paiscampeonato_icsjp', // <---- Consultando clubes según el país del campeonato seleccionado.
                'pais_campeonato': pais_campeonato
            },
            success: function(respuesta)  {
                $('#idclub_rival_icsjp').empty(); // <--- Vaciando select.
                if( respuesta== "" ) { //jugador sin informes
                    console.log("No se encontró ningún club según el país del campeonato seleccionado...");
                    $("#idclub_rival_icsjp").append('<option value="">No se encontraron clubes</option>');
                    $("#idclub_rival_icsjp").append('<option value="000">Otro</option>');
                } else {              
                                    
                    $("#idclub_rival_icsjp").append('<option value="">Seleccione</option>');
                    for(var i=0; i < respuesta.length; i++) {   
                        $("#idclub_rival_icsjp").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                    }
                    $("#idclub_rival_icsjp").append('<option value="000">Otro</option>');
                } 
            
            },
            error: function(){// will fire when timeout is reached
                console.log('Error al consultar clubes para el select de clubes del rival');
            }, timeout: 15000 // sets timeout to 3 seconds
        }); 
        // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //

    }

    chequear_datos_form_informe_icsj(); // <--- Ejecutando validación.
}
// --------------- Fin de la función 'get_clubes_from_paiscampeonato_icsjp()' --------------- //


// ------------------------ Inicio de la función que carga foto en la etiqueta <img> del jugador ------------------------ //
function readURL(input) {
    chequear_datos_form_fichajugador();
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#foto-jugador')
                .attr('src', e.target.result)
                .width(140)
                .height(140);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
// ------------------------ Fin de la función que carga foto en la etiqueta <img> del jugador ------------------------ //

// ------------------------ Inicio de la función que carga foto en la etiqueta <img> del entrenador ------------------------ //
function readURL_entrenador(input) {
    chequear_datos_form_entrenador();
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#foto-entrenador')
                .attr('src', e.target.result)
                .width(140)
                .height(140);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
// ------------------------ Fin de la función que carga foto en la etiqueta <img> del entrenador ------------------------ //

// ------------------------ Inicio de la función 'campos_ficha_jugador()' ------------------------ //
function campos_ficha_jugador() {

    let estado_jugador = $('#estado_jugadorclub').val();
    switch( estado_jugador ) {
        case '1': // <----- JUGADOR LIBRE

            // Representante:
            $('.campo-representante').show(); // <---- Siempre será mostrado menos cuando no se seleccionada nada.

            $('.campo-jugador-en-club').hide();
            $('.campo-jugador-prestamo').hide(); // <--- También desaparece.            
            $('.campo-club-jugadorenclub-otro').hide();
            $('.campo-club-jugador-libre-otro').hide();
            $('.campo-jugador-libre').show(); // <--- Mostrar
            
            // Ejecutando sin que se desencadene un evento:
            let idclub_jugadorlibre = $('#idclub_jugadorlibre').val(); 
            if( idclub_jugadorlibre == "000" ) {
                $('.campo-club-jugador-libre-otro').show();                             
            } else {
                $('.campo-club-jugador-libre-otro').hide();
            }

            // Evento onchange:
            $('#idclub_jugadorlibre').change(function(){
                let thisValue = $(this).val(); 
                if( thisValue == "000" ) {
                    $('.campo-club-jugador-libre-otro').show();                             
                } else {
                    $('.campo-club-jugador-libre-otro').hide();
                }
            });

            break;
        case '2': // <----- EN CLUB

            // Representante:
            $('.campo-representante').show(); // <---- Siempre será mostrado menos cuando no se seleccionada nada.
            $('.campo-jugador-en-club').show();         

            // Estas funciones que muestra u ocultan los campos del club (si uno ya registrdo en la BD o nuevo/otro) debe ser ejecutada después ya que justo antes de este comentario se ejecuta la siguiente función: $('.campo-jugador-en-club').show();

            $('.campo-club-jugadorenclub-otro').hide(); // <--- Esconder

            // Ejecutando sin que se desencadene un evento:
            let idclub_actual_jugadorenclub = $('#idclub_actual_jugadorenclub').val(); 
            if( idclub_actual_jugadorenclub == "000" ) {
                $('.campo-club-jugadorenclub-otro').show();
                $('#pais_club_actual').parent().hide();
                $('#division_club_actual').parent().hide();                             
            } else {
                $('.campo-club-jugadorenclub-otro').hide();
                $('#pais_club_actual').parent().show();
                $('#division_club_actual').parent().show();
            }

            // Evento onchange:
            $('#idclub_actual_jugadorenclub').change(function(){
                let thisValue = $(this).val(); 
                if( thisValue == "000" ) {
                    $('.campo-club-jugadorenclub-otro').show();
                    $('#pais_club_actual').parent().hide();
                    $('#division_club_actual').parent().hide();                                     
                } else {
                    $('.campo-club-jugadorenclub-otro').hide();
                    $('#pais_club_actual').parent().show();
                    $('#division_club_actual').parent().show();
                }
            });         

            $('.campo-jugador-libre').hide(); // <--- Esconder
            $('.campo-club-jugador-libre-otro').hide(); // <--- Esconder
            

            let situacion = $('#situ_clubactual_jugadorclub').val();
            switch( situacion ) {
                case '1': // <----- A PRÉSTAMO
                    $('.campo-jugador-prestamo').show();                        
                    break;
                case '2': // <----- PERTENECE AL CLUB
                    $('.campo-jugador-prestamo').hide();            
                    break;      
                default:
                    $('.campo-situacion-club-actual').hide();
                    //$('.campo-jugador-prestamo').show();
                    break;
            }   

            // Cláusula de salida:
            let clausula_salida_jugadorclub = $("#clausula_salida_jugadorclub").val();  
                switch( clausula_salida_jugadorclub ) {
                    case '0': // <---- NO
                        $("#valor_clausula_jugadorclub").parent().hide();
                        break;
                    case '1': // <---- SÍ
                        $("#valor_clausula_jugadorclub").parent().show();
                        break;
                    default:
                        $("#valor_clausula_jugadorclub").parent().hide();
                        break;                          
            }   

            break;      
        default:
            // Escondemos todos los campos:
            $('.campo-representante').hide();
            $('.campo-jugador-en-club').hide();
            $('.campo-jugador-libre').hide(); // <--- Esconder
            $('.campo-club-jugadorenclub-otro').hide();
            break;
    }
    chequear_datos_form_fichajugador(); // <--- Validando el formulario de la ficha del jugador.
}
// ------------------------ Fin de la función 'campos_ficha_jugador()' ------------------------ //

// ------------------------ Inicio de la función 'campos_entrenador()' ------------------------ //
function campos_entrenador() {

    // Ejecutando sin que se desencadene un evento:
    let idclub_actual_entrenador = $('#idclub_actual_entrenador').val(); 
    if( idclub_actual_entrenador == "000" ) {
        $('.campo-club-entrenador-otro').show();
        $('#pais_club_actual_entrenador').parent().hide();
        $('#division_club_actual_entrenador').parent().hide();                             
    } else {
        $('.campo-club-entrenador-otro').hide();
        $('#pais_club_actual_entrenador').parent().show();
        $('#division_club_actual_entrenador').parent().show();
    }

    // Evento onchange:
    $('#idclub_actual_entrenador').change(function(){
        let thisValue = $(this).val(); 
        if( thisValue == "000" ) {
            $('.campo-club-entrenador-otro').show();
            $('#pais_club_actual_entrenador').parent().hide();
            $('#division_club_actual_entrenador').parent().hide();                                     
        } else {
            $('.campo-club-entrenador-otro').hide();
            $('#pais_club_actual_entrenador').parent().show();
            $('#division_club_actual_entrenador').parent().show();
        }
    });         
    
    // Cláusula de salida:
    let clausula_salida_entrenadorclub = $("#clausula_salida_entrenadorclub").val();  
        switch( clausula_salida_entrenadorclub ) {
            case '0': // <---- NO
                $("#valor_clausula_entrenadorclub").parent().hide();
                break;
            case '1': // <---- SÍ
                $("#valor_clausula_entrenadorclub").parent().show();
                break;
            default:
                $("#valor_clausula_entrenadorclub").parent().hide();
                break;                          
    }   

    
    chequear_datos_form_entrenador(); // <--- Validando el formulario de la ficha del jugador.
}
// ------------------------ Fin de la función 'campos_entrenador()' ------------------------ //

// campos_ficha_jugador();

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
                    
        var fecha_nacimiento = fecha_nacimiento_param;

        // Día de Nacimiento:
        var dia_nacimiento = fecha_nacimiento.substring(8, 10);
        dia_nacimiento = parseInt( dia_nacimiento ); 

        // Mes de Nacimiento:
        var mes_nacimiento = fecha_nacimiento.substring(5, 7);
        mes_nacimiento = parseInt( mes_nacimiento );     

        // Año de Nacimiento:
        var anio_nacimiento = fecha_nacimiento.substring(0, 4);
        anio_nacimiento = parseInt( anio_nacimiento ); 


        // Calculando edad:
        var edad = anio_actual_int - anio_nacimiento;

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

// -------------------- Inicio de la función 'buscar_partidos_jugador()' ------------------------- //
function buscar_partidos_jugador( idfichaJugador_club ) {

    // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'buscar_partidos_jugador',
            'idfichaJugador_club': idfichaJugador_club    
        },
        success: function(respuesta)  {

            if(respuesta== ""){ //jugador sin informes
                $(".tabla_partidos_jugador tbody").empty();
                var markup = '<tr class="panel_buscar"><td colspan="16" style="text-align: center;"><b>No se encontraron partidos registrados</b></td></tr>';
                $(".tabla_partidos_jugador tbody").append(markup);
                $("#graficos_informes_resumen").hide();
                $('#cargando_buscar').hide();
                $('#sin_resultados').show();
                $('#boton_editar').hide();
                $('.boton_refresh').hide();
                // $('#boton_agregar_ficha_jugador').prop("disabled", true);
            }else{              
                window.datos_jugador_partido = respuesta; //se copian todos los profesores al cache
                $(".tabla_partidos_jugador tbody").empty(); // <--- Vaciando la tabla.

                // Inicio de la función each
                $('.tabla_partidos_jugador').each(function(){
                    let vista_modal_partido = $(this).attr('vista-modal-partido');
                    vista_modal_partido = parseInt( vista_modal_partido );

                    let img_club_width = "";
                    let img_club_resultados_width = "";
                    let img_height = "";
                    let td_valoracion = "";
                    let icon_size = "";
                    let p_position = "";
                    let max_width_campeonato_clubes = "";
                    let max_width_posicion_partido = "";
                    if( vista_modal_partido == '1' ) { // <--- La tabla se muestra en al ventana modal.
                        img_club_width = "width: 14%;";
                        img_club_resultados_width = "";
                        img_height = "height: 15px;";
                        td_valoracion = "";
                        icon_size = "font-size: 12px;";
                        p_position = "position: relative; top: 5px; text-align: left; left: 7px;";
                        max_width_campeonato_pos = "max-width: 60px;";  
                        max_width_campeonato_clubes = "max-width: 60px;";    
                        max_width_posicion_partido = "max-width: 60px;";                            
                    } else {
                        img_club_width = "";
                        img_club_resultados_width = "width: 23px;";
                        img_height = "height: 25px;";
                        td_valoracion = "td-valoracion";
                        icon_size = "";
                        p_position = "position: relative; top: 5px; text-align: left; left: 7px;";      
                        max_width_campeonato_pos = "max-width: 100px;";                 
                        max_width_campeonato_clubes = "max-width: 80px;"; 
                        max_width_posicion_partido = "max-width: 80px;";  
                    }

                    var count = 1;
                    for(var i=0; i < respuesta.length; i++){

                        // Tabla 'fichaJugador_partido':
                        
                        let fecha_jugadorpartido;
                        if( respuesta[i]['fecha_jugadorpartido'] === null || respuesta[i]['fecha_jugadorpartido'] == '' || respuesta[i]['fecha_jugadorpartido'] == '0000-00-00' ) {
                            fecha_jugadorpartido = '-';
                        } else {    
                            fecha_jugadorpartido = fecha_formato_ddmmaaa( respuesta[i]['fecha_jugadorpartido'] );
                        }
                        
                        let jornada_jugadorpartido
                        if( respuesta[i]['jornada_jugadorpartido'] === null || respuesta[i]['jornada_jugadorpartido'] == '' ) {
                            jornada_jugadorpartido = 'No especificado';
                        } else {    
                            jornada_jugadorpartido = respuesta[i]['jornada_jugadorpartido'];
                        }                        
                        
                        let condicion_jugadorpartido = respuesta[i]['condicion_jugadorpartido'];
                        switch( condicion_jugadorpartido ) {
                            case '1': // <---- Local.
                                condicion_jugadorpartido = "Local";
                                break;
                            case '2': // <---- Visita.
                                condicion_jugadorpartido = "Visita";
                                break;
                            case '3': // <---- Neutral.
                                condicion_jugadorpartido = "Neutral";
                                break;
                            default:
                                condicion_jugadorpartido = "-";
                                break;
                        }

                        let gol_equipo1_jugadorpartido = respuesta[i]['gol_equipo1_jugadorpartido'];
                        let gol_equipo2_jugadorpartido = respuesta[i]['gol_equipo2_jugadorpartido'];

                        let posicion_jugadorpartido = respuesta[i]['posicion_jugadorpartido'];
                        let nombre_posicion;
                        if( posicion_jugadorpartido === null || posicion_jugadorpartido == '' || posicion_jugadorpartido == '0' || posicion_jugadorpartido == '999' ) {
                            nombre_posicion = 'No especificado';
                        } else {
                            nombre_posicion = array_posiciones[posicion_jugadorpartido][1];
                        }                        
                        
                        let tit_sup_nc_jugadorpartido = respuesta[i]['tit_sup_nc_jugadorpartido'];
                        switch( tit_sup_nc_jugadorpartido ) {
                            case '1': // <---- Titular.
                                tit_sup_nc_jugadorpartido = "Titular";
                                break;
                            case '2': // <---- Suplente.
                                tit_sup_nc_jugadorpartido = "Suplente";
                                break;
                            case '3': // <---- No compite.
                                tit_sup_nc_jugadorpartido = "No compite";
                                break;
                            default: // <---- No compite.
                                tit_sup_nc_jugadorpartido = "-";
                                break;                                
                        }       

                        let min_jugados_jugadorpartido = respuesta[i]['min_jugados_jugadorpartido'];
                        let min_entrada_jugadorpartido = respuesta[i]['min_entrada_jugadorpartido'];
                        let num_gol_jugadorpartido = respuesta[i]['num_gol_jugadorpartido'];
                        let t_amarilla_jugadorpartido = respuesta[i]['t_amarilla_jugadorpartido'];
                        let t_roja_jugadorpartido = respuesta[i]['t_roja_jugadorpartido'];

                        // Tabla 'campeonato':
                        let idcampeonato = respuesta[i]['idcampeonato'];
                        
                        let nombre_campeonato;
                        if( respuesta[i]['nombre_campeonato'] === null || respuesta[i]['nombre_campeonato'] == '' ) {
                            nombre_campeonato = 'No especificado';
                        } else {    
                            nombre_campeonato = respuesta[i]['nombre_campeonato'];
                        }

                        let foto_campeonato = './foto_campeonatos/'+idcampeonato+'.png?lala='+new Date()+'';

                        // Tabla 't_club_jugador':
                        let idclub_jugador = respuesta[i]['idclub_jugador'];
                        let nombre_club_jugador;
                        if( respuesta[i]['nombre_club_jugador'] === null || respuesta[i]['nombre_club_jugador'] == '' ) {
                            nombre_club_jugador = 'No especificado';
                        } else {    
                            nombre_club_jugador = respuesta[i]['nombre_club_jugador'];
                        }                                            
                        let foto_club_jugador = './foto_clubes/'+idclub_jugador+'.png?lala='+new Date()+'';

                        // Tabla 't_club_rival':
                        let idclub_rival = respuesta[i]['idclub_rival'];
                        let nombre_club_rival;
                        if( respuesta[i]['nombre_club_rival'] === null || respuesta[i]['nombre_club_rival'] == '' ) {
                            nombre_club_rival = 'No especificado';
                        } else {    
                            nombre_club_rival = respuesta[i]['nombre_club_rival'];
                        }                        
                        let foto_club_rival = './foto_clubes/'+idclub_rival+'.png?lala='+new Date()+'';

                        var markup = 
                        '<tr style="cursor: pointer;">\
                            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="text-align: center;"><div style="max-width: 60px;"><p class="ellipsis-text">'+fecha_jugadorpartido+'</p></div></td>\
                            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid;">\
                                <div class="div-club-table" style="text-align: center;">\
                                    <div class="img-next-to-text" style="'+img_club_width+'"><img src="'+foto_club_jugador+'" style="width: 25px; border-radius: 50%; border: solid 2px;'+img_height+'"></div>\
                                    <div style="'+max_width_campeonato_clubes+'"><p class="ellipsis-text" style="'+p_position+'">'+nombre_club_jugador+'</p></div>\
                                </div>\
                            </td>\
                            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid;">\
                                <div class="div-club-table" style="text-align: center; '+max_width_campeonato_pos+'">\
                                    <div class="img-next-to-text" style="'+img_club_width+'"><img src="'+foto_campeonato+'" style="width: 25px; border-radius: 50%; border: solid 2px;'+img_height+'"></div>\
                                    <div style="'+max_width_campeonato_clubes+'"><p class="ellipsis-text" style="'+p_position+'">'+nombre_campeonato+'</p></div>\
                                </div>\
                            </td style="border-left: 1px solid;">\
                            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid;"><div class="div-club-table" style="text-align: center; font-weight: bold; max-width:60px;"><p class="ellipsis-text">'+jornada_jugadorpartido+'</p></div></td>\
                            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid;"><div class="div-club-table" style="text-align: center; font-weight: bold; max-width:60px;"><p class="ellipsis-text">'+condicion_jugadorpartido+'</p></div></td>\
                            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid;">\
                                <div class="div-club-table" style="text-align: center;">\
                                    <div class="img-next-to-text" style="'+img_club_width+'"><img src="'+foto_club_rival+'" style="width: 25px; border-radius: 50%; border: solid 2px;'+img_height+'"></div>\
                                    <div style="'+max_width_campeonato_clubes+'"><p class="ellipsis-text" style="'+p_position+'">'+nombre_club_rival+'</p></div>\
                                </div>\
                            </td style="border-left: 1px solid;">\
                            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')"  style="width: 25px; border-left: 1px solid;">\
                                <center>\
                                    <img src="'+foto_club_jugador+'" class="img-club" style="'+img_club_resultados_width+'"> '+gol_equipo1_jugadorpartido+'<span> - </span> '+gol_equipo2_jugadorpartido+' <img src="'+foto_club_rival+'" class="img-club" style="'+img_club_resultados_width+' position: relative; left: 3px;">\
                                </center>\
                            </td>\
                            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid; text-align: center; font-weight: bold;"><div style="'+max_width_posicion_partido+'"><p class="ellipsis-text">'+nombre_posicion+'</p></div></td>\
                            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid; text-align: center; font-weight: bold;"><div class="div-club-table"><p class="ellipsis-text">'+tit_sup_nc_jugadorpartido+'</p></div></td>\
                            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid; text-align: center; font-weight: bold;">'+min_jugados_jugadorpartido+'\'</td>\
                            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid; text-align: center; font-weight: bold;">'+min_entrada_jugadorpartido+'\'</td>\
                            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid; text-align: center; font-weight: bold;">'+num_gol_jugadorpartido+'</td>\
                            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid; text-align: center; font-weight: bold;">'+t_amarilla_jugadorpartido+'</td>\
                            <td onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')" style="border-left: 1px solid; text-align: center; font-weight: bold;">'+t_roja_jugadorpartido+'</td>\
                            <td style="padding: 2px; width: 9px; border-left: 1px solid;">\
                                <a style="'+icon_size+'" class="boton_editar" onclick="boton_editar_form_partido('+i+', '+vista_modal_partido+')">\
                                    <i class="icon-pencil"></i>\
                                </a>\
                            </td>\
                            <td style="padding: 2px; width: 9px;">\
                                <a style="'+icon_size+'" class="boton_eliminar" onclick="boton_eliminar_partido('+i+', '+vista_modal_partido+');">\
                                    <i class="icon-remove"></i>\
                                </a>\
                            </td>\
                        </tr>';

                        //$(".tabla_partidos_jugador tbody").append(markup);
                        
                        $(this).children('tbody').append(markup); 

                        count = count + 1;
                    }                           
                });
                // Inicio de la función each

                $('#boton_agregar').show();
                $('.boton_refresh').hide();
            } 
            $('#cargando_buscar').hide();
            $('#error_conexion').hide();
            $('#sin_resultados').hide();
        
        },
        error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
                $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
    // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //    
} 
// -------------------- Fin de la función 'buscar_partidos_jugador()' ------------------------- //

// -------------------- Inicio de la función 'buscar_partidos_entrenador()' -------------------- // 
function buscar_partidos_entrenador( identrenador_club ){

    $.ajax({
        url: "post/scouting_centro_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'buscar_partidos_entrenador',
            'identrenador_club': identrenador_club            
        },
        success: function(respuesta){
            // alert(JSON.stringify(respuesta));
            if(respuesta== ""){ //jugador sin informes
                $("#tabla_partidos_entrenador tbody").empty();
                var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td colspan="9"><center><b>No se encontraron partidos registrados</b></center></td></tr>';
                $("#tabla_partidos_entrenador tbody").append(markup);
                $('#cargando_buscar_jugadores_seguimiento').hide();
                $('#sin_resultados_jugadores_seguimiento').show();
                $('#boton_refresh_jugadores_seguimiento').hide();
            }else{              
                window.datos_entrenador_partido = respuesta; //se copian todos los profesores al cache
                $("#tabla_partidos_entrenador tbody").empty();

                var count = 1;

                for(var i=0; i < respuesta.length; i++){              

                    // Tabla '<-- Local: Equipo del Entrenador - Local: Equipo Rival':
                    let fecha_entrenadorpartido = fecha_formato_ddmmaaa( respuesta[i]['fecha_entrenadorpartido'] );
                    let temporada_entrenadorpartido = respuesta[i]['temporada_entrenadorpartido'];
                    let md_entrenadorpartido = respuesta[i]['md_entrenadorpartido'];
                    let tactica_entrenadorpartido = respuesta[i]['tactica_entrenadorpartido'];
                    
                    let gol_equipo1_entrenadorpartido = respuesta[i]['gol_equipo1_entrenadorpartido'];
                    let gol_equipo2_entrenadorpartido = respuesta[i]['gol_equipo2_entrenadorpartido'];    

                    // Tabla 'campeonato':
                    let idcampeonato = respuesta[i]['idcampeonato'];
                    let nombre_campeonato;
                    if( respuesta[i]['nombre_campeonato'] === null || respuesta[i]['nombre_campeonato'] == '' ) {
                        nombre_campeonato = 'No especificado';
                    } else {    
                        nombre_campeonato = respuesta[i]['nombre_campeonato'];
                    }
                    let foto_campeonato = './foto_campeonatos/'+idcampeonato+'.png?lala='+new Date()+'';

                    // Tabla 't_club_entrenador':
                    let idclub_entrenador = respuesta[i]['idclub_entrenador'];
                    let nombre_club_entrenador;
                    if( respuesta[i]['nombre_club_entrenador'] === null || respuesta[i]['nombre_club_entrenador'] == '' ) {
                        nombre_club_entrenador = 'No especificado';
                    } else {    
                        nombre_club_entrenador = respuesta[i]['nombre_club_entrenador'];
                    }                        
                    let foto_club_entrenador = './foto_clubes/'+idclub_entrenador+'.png?lala='+new Date()+'';

                    // Tabla 't_club_rival':
                    let idclub_rival = respuesta[i]['idclub_rival'];
                    let nombre_club_rival;
                    if( respuesta[i]['nombre_club_rival'] === null || respuesta[i]['nombre_club_rival'] == '' ) {
                        nombre_club_rival = 'No especificado';
                    } else {    
                        nombre_club_rival = respuesta[i]['nombre_club_rival'];
                    }                        
                    let foto_club_rival = './foto_clubes/'+idclub_rival+'.png?lala='+new Date()+'';
                    
                    // Condición de los equipos:
                    let cond_equipo1_entrenadorpartido = respuesta[i]['cond_equipo1_entrenadorpartido'];
                    let cond_equipo2_entrenadorpartido = respuesta[i]['cond_equipo2_entrenadorpartido'];

                    // Datos del Equipo Local:
                    let nombre_equipo_local = "";
                    let foto_equipo_local = "";

                    // Datos del Equipo Visitante:
                    let nombre_equipo_visitante = "";
                    let foto_equipo_visitante = "";                    

                    if( cond_equipo1_entrenadorpartido == '1' ) { // <-- Local: Equipo del Entrenador - Local: Equipo Rival
                        // Datos del Equipo Local (Equipo del Entrenador):
                        nombre_equipo_local = nombre_club_entrenador;
                        foto_equipo_local = foto_club_entrenador;

                        // Datos del Equipo Visitante (Equipo del Rival:
                        nombre_equipo_visitante = nombre_club_rival;
                        foto_equipo_visitante = foto_club_rival;    
                    
                    } else { // <-- Local: Equipo Rival - Local: Equipo del Entrenador
                        // Datos del Equipo Local (Equipo del Rival):
                        nombre_equipo_local = nombre_club_rival;
                        foto_equipo_local = foto_club_rival;

                        // Datos del Equipo Visitante (Equipo del Entrenador):
                        nombre_equipo_visitante = nombre_club_entrenador;
                        foto_equipo_visitante = foto_club_entrenador;                          
                    } 

                    var markup = 
                    '<tr style="cursor: pointer;">\
                        <td onclick="boton_editar_form_partido_entrenador('+i+')" style="text-align: center;">\
                            <b>'+fecha_entrenadorpartido+'</b>\
                        </td>\
                        <td onclick="boton_editar_form_partido_entrenador('+i+')" style="border-left: 1px solid;">\
                            <div class="div-club-table" style="text-align: center;">\
                                <div class="img-next-to-text" style="">\
                                    <img src="'+foto_campeonato+'" style="width: 25px; border-radius: 50%; border: solid 2px;height: 25px;">\
                                </div>\
                                <div style="max-width: 100px;">\
                                    <p class="ellipsis-text" style="position: relative; top: 5px; text-align: left; left: 7px;">'+nombre_campeonato+'</p>\
                                </div>\
                            </div>\
                        </td style="border-left: 1px solid;">\
                        <td onclick="boton_editar_form_partido_entrenador('+i+')" style="border-left: 1px solid; text-align: center;">\
                            <div style="max-width: 115px;">\
                                <p class="ellipsis-text">'+temporada_entrenadorpartido+'</p>\
                            </div>\
                        </td>\
                        <td onclick="boton_editar_form_partido_entrenador('+i+')" style="border-left: 1px solid; text-align: center;">\
                            <div style="max-width: 115px;">\
                                <p class="ellipsis-text">'+md_entrenadorpartido+'</p>\
                            </div>\
                        </td>\
                        <td onclick="boton_editar_form_partido_entrenador('+i+')" style="border-left: 1px solid;">\
                            <div class="div-club-table" style="text-align: center;">\
                                <div class="img-next-to-text" style="">\
                                    <img src="'+foto_equipo_local+'" style="width: 25px; border-radius: 50%; border: solid 2px;height: 25px;">\
                                </div>\
                                <div style="max-width: 120px;">\
                                    <p class="ellipsis-text" style="position: relative; top: 5px; text-align: left; left: 7px;">'+nombre_equipo_local+'</p>\
                                </div>\
                            </div>\
                        </td>\
                        <td onclick="boton_editar_form_partido_entrenador(0, 0)" style="width: 25px; border-left: 1px solid;">\
                            <center>\
                                <img src="'+foto_equipo_local+'" class="img-club" style="width: 23px;">\
                                 '+gol_equipo1_entrenadorpartido+' <span> - </span> '+gol_equipo2_entrenadorpartido+'\
                                 <img src="'+foto_equipo_visitante+'" class="img-club" style="width: 23px; position: relative; left: 3px;">\
                            </center>\
                        </td>\
                        <td onclick="boton_editar_form_partido_entrenador('+i+')" style="border-left: 1px solid;">\
                            <div class="div-club-table" style="text-align: center;">\
                                <div class="img-next-to-text" style="">\
                                    <img src="'+foto_equipo_visitante+'" style="width: 25px; border-radius: 50%; border: solid 2px;height: 25px;">\
                                </div>\
                                <div style="max-width: 120px;">\
                                    <p class="ellipsis-text" style="position: relative; top: 5px; text-align: left; left: 7px;">'+nombre_equipo_visitante+'</p>\
                                </div>\
                            </div>\
                        </td>\
                        <td onclick="boton_editar_form_partido_entrenador('+i+')" style="border-left: 1px solid; text-align: center;">\
                            <div style="max-width: 115px;">\
                                <p class="ellipsis-text">'+tactica_entrenadorpartido+'</p>\
                            </div>\
                        </td>\
                        <td style="padding: 2px; width: 9px; border-left: 1px solid;">\
                            <a class="boton_editar" onclick="boton_editar_form_partido_entrenador('+i+')">\
                                <i class="icon-pencil"></i>\
                            </a>\
                        </td>\
                        <td style="padding: 2px; width: 9px;">\
                            <a class="boton_eliminar" onclick="boton_eliminar_partido_entrenador('+i+');">\
                                <i class="icon-remove"></i>\
                            </a>\
                        </td>\
                    </tr>';
                    $("#tabla_partidos_entrenador tbody").append(markup);
                    count = count + 1;
                }

                $('#boton_refresh_jugadores_seguimiento').hide();
            } 
            $('#cargando_buscar_jugadores_seguimiento').hide();
            $('#error_conexion_jugadores_seguimiento').hide();
            $('#sin_resultados_jugadores_seguimiento').hide();
        
        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar_jugadores_seguimiento').hide();
            $('#sin_resultados_jugadores_seguimiento').hide();
            $('#error_conexion_jugadores_seguimiento').show();
            $('#boton_refresh_jugadores_seguimiento').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    });
}
// -------------------- Fin de la función 'buscar_partidos_entrenador()' -------------------- //


// -------------------------- Inicio de la función 'boton_agregar_partido( linea )' - AGREGAR (INSERT) PARTIDOS --------------------------- //
function boton_agregar_partido() {

    window.idfichaJugador_partido = ''; // <---- DEBE ESTAR VACÍO PARA EJECUTAR EL INSERT
    $('#formulario_partido_jugador').slideDown('fast'); // <---- Mostrando el formulario
    // -------------------------------------------- FORMULARIO DE PARTIDO -------------------------------------------- //
    // Agregando por defecto la foto del club rival:
    $('#foto_1_club_rival_partido').attr( 'src', '../config/default.png' );
    $('#foto_2_club_rival_partido').attr( 'src', '../config/default.png' );
    $('#formulario_partido_jugador')[0].reset(); // <--- Vaciando el formulario #formulario_partido_jugador.
    $('#min_jugados_jugadorpartido_text').html('0 minutos'); // <--- Importante. Cambiar texto
    $('#min_jugados_jugadorpartido').val(''); // <--- Importante. Vaciar
    chequear_datos_form_partidojugador(); // <---- Validando

    $('.campo-campeonato-otro').hide(); // <--- Importante - Agregado el 18-05-2020
    $('.campo-club-rival-otro').hide(); // <--- Importante - Agregado el 18-05-2020

}
// -------------------------- Fin de la función 'boton_agregar_partido( linea )' - AGREGAR (INSERT) PARTIDOS --------------------------- //


// -------------------------- Inicio de la función 'boton_editar_form_jugador( linea )' - EDITAR (UPDATE) --------------------------- //
function boton_editar_form_jugador( linea ){

    window.idfichaJugador = datos_jugador_club[linea]['idfichaJugador'];
    window.idfichaJugador_club = datos_jugador_club[linea]['idfichaJugador_club'];
    window.idfichaJugador_partido = ''; // DEBE ESTAR VACÍO PARA EJECUTAR EL INSERT

    // Mostrando por defecto la pestaña 'Datos':
    $('a[href="#tab_form_fichajugador"]').parent().attr('class', 'active');
    $('#tab_form_fichajugador').attr('class', 'tab-pane active');

    $('a[href="#tab_form_partido"]').parent('li').show(); // <--- Mostrando tab de formulario de partidos.
    $('a[href="#tab_form_partido"]').parent().attr('class', '');
    $('#tab_form_partido').attr('class', 'tab-pane');
 
    $('#formulario_partido_jugador').hide(); // <--- Ocultando el formulario // Ocultando el formulario

    // alert( datos_jugador_club[linea]['idfichaJugador_club'] );

    // -------------------------------------------- FORMUARLIO DE FICHA DE JUGADOR -------------------------------------------- //
    let foto_jugador = 'foto_jugadores_scouting/' + datos_jugador_club[linea]['idfichaJugador'] + '.png?lala='+new Date()+'';
    // $('#foto_anterior_jugador').val( foto_jugador ); // <--- Importante. Cargar valor de la foto del entrenador en este campo oculto.
    $('#foto_anterior_jugador').val( datos_jugador_club[linea]['idfichaJugador'] + '.png' ); // <--- Importante. Cargar valor de la foto del entrenador en este campo oculto.
    $('#foto_jugador').val(''); // <--- Importante. Vaciar. 
    $('#foto-jugador').attr( 'src', foto_jugador ); // <--- Formulario id="formulario_ficha_jugador"

    $("#nombre").val( datos_jugador_club[linea]['nombre'] );
    $("#apellido1").val( datos_jugador_club[linea]['apellido1'] );
    
    if( datos_jugador_club[linea]['apellido2'] === null ||  datos_jugador_club[linea]['apellido2'] === '' ) {
        datos_jugador_club[linea]['apellido2'] = "";
    }
    $("#apellido2").val( datos_jugador_club[linea]['apellido2'] );
    
    $("#fechaNacimiento").val( datos_jugador_club[linea]['fechaNacimiento'] );

    let nombre_completo_jugador = datos_jugador_club[linea]['nombre'] + " " + datos_jugador_club[linea]['apellido1'] + " " + datos_jugador_club[linea]['apellido2'];

    // Selects:
    $("#sexo option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['sexo'] ) {
            thisElement.prop("selected", true);
        }
    });

    $("#altura").val( datos_jugador_club[linea]['altura'] );
    
    // Selects:
    $("#nacionalidad1").prop("selectedIndex", 0);
    $("#nacionalidad1 option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['nacionalidad1'] ) {
            thisElement.prop("selected", true);
        }
    });
    
    $("#nacionalidad2").prop("selectedIndex", 0);
    $("#nacionalidad2 option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['nacionalidad2'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    $("#serieActual").prop("selectedIndex", 0);
    $("#serieActual option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['serieActual'] ) {
            thisElement.prop("selected", true);
        }
    });     

    $("#dinamico").prop("selectedIndex", 0);
    $("#dinamico option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['dinamico'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    $("#posicion0").prop("selectedIndex", 0);
    $("#posicion0 option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['posicion0'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    $("#posicion1").prop("selectedIndex", 0);
    $("#posicion1 option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['posicion1'] ) {
            thisElement.prop("selected", true);
        }
    });

    $("#posicion2").prop("selectedIndex", 0);
    $("#posicion2 option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['posicion2'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    $("#seleccionado").prop("selectedIndex", 0);
    $("#seleccionado option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['seleccionado'] ) {
            thisElement.prop("selected", true);
        }
    });                     

    // Estado del jugador:
    $("#estado_jugadorclub").prop("selectedIndex", 0);
    $("#estado_jugadorclub option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['estado_jugadorclub'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    // Club anterior de Jugador libre:
    $("#idclub_jugadorlibre").prop("selectedIndex", 0);
    $("#idclub_jugadorlibre option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['idclub'] ) {
            thisElement.prop("selected", true);
        }
    });

    $('#representante_jugadorclub').val( datos_jugador_club[linea]['representante_jugadorclub'] );

    // Club actual de Jugador en Club:
    // alert( 'idclub: ' + datos_jugador_club[linea]['idclub'] );

    $("#pais_club_actual").prop("selectedIndex", 0);
    $("#pais_club_actual option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['pais_club'] ) {
            thisElement.prop("selected", true);
        }
    });

    // División:
    $("#division_club_actual").prop("selectedIndex", 0);
    if( datos_jugador_club[linea]['division_club'] === null || datos_jugador_club[linea]['division_club'] == '' || datos_jugador_club[linea]['division_club'] == '0'  ) {

        $("#division_club_actual option").each(function(){
            let thisElement = $(this);
            let thisValue = $(this).val();
            if( thisValue == datos_jugador_club[linea]['division_club'] ) {
                thisElement.prop("selected", true);
            }
        });

    } else {

        $('#division_club_actual').empty();
        let divisiones_pais_selected = array_divisiones[ datos_jugador_club[linea]['pais_club'] ];
        divisiones_pais_selected = divisiones_pais_selected.filter(function(){return true;}); // Reiniciando el valor de los índices de 0 a n.
        $('#division_club_actual').append('<option value="">Seleccione</option>');
        for (var i = 0; i < divisiones_pais_selected.length; i++) {
            let division =  divisiones_pais_selected[i][0];
            let prop_selected = '';
            if( division == datos_jugador_club[linea]['division_club'] ) {
                prop_selected = 'selected'
            }

            $('#division_club_actual').append('<option '+prop_selected+' value="'+divisiones_pais_selected[i][0]+'">'+divisiones_pais_selected[i][1]+'</option>');
        }

    }

    // Seleccionando el ID de club según el país y división seleccionado (para el select #idclub_actual_jugadorenclub):
    // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
            'pais_club': datos_jugador_club[linea]['pais_club'],
            'division_club': datos_jugador_club[linea]['division_club'] 
        },
        success: function(respuesta)  {
            $('.select-idclub-dinamico').empty(); // <--- Vaciando select.
            if( respuesta== "" ) { //jugador sin informes
                console.log("No se encontró ningún club según el país y división seleccionada...");
                $(".select-idclub-dinamico").append('<option value="">Seleccione primero una división</option>');
            } else {              
                                
                $(".select-idclub-dinamico").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $(".select-idclub-dinamico").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }
                $(".select-idclub-dinamico").append('<option value="000">Otro</option>');

                $("#idclub_actual_jugadorenclub option").each(function(){
                    let thisElement = $(this);
                    let thisValue = $(this).val();
                    if( thisValue == datos_jugador_club[linea]['idclub'] ) {
                        thisElement.prop("selected", true);
                    }
                });
            } 
        
        },
        error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
                $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
    // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //

    $("#contrato_pro_jugadorclub").prop("selectedIndex", 0);
    $("#contrato_pro_jugadorclub option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['contrato_pro_jugadorclub'] ) {
            thisElement.prop("selected", true);
        }
    });         

    // Situación del jugador en el club actual:
    $("#situ_clubactual_jugadorclub").prop("selectedIndex", 0);
    $("#situ_clubactual_jugadorclub option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['situ_clubactual_jugadorclub'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    // Inputs:
    $("#fechafin_prestamo_jugadorclub").val( datos_jugador_club[linea]['fechafin_prestamo_jugadorclub'] );
    $("#pase_pertenencia_jugadorclub").val( datos_jugador_club[linea]['pase_pertenencia_jugadorclub'] );
    $("#fechafin_contrato_jugadorclub").val( datos_jugador_club[linea]['fechafin_contrato_jugadorclub'] );
    $("#valor_mercado_jugadorclub").val( datos_jugador_club[linea]['valor_mercado_jugadorclub'] );

    // Cláusula de salida:
    $("#clausula_salida_jugadorclub").prop("selectedIndex", 0);
    $("#clausula_salida_jugadorclub option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_club[linea]['clausula_salida_jugadorclub'] ) {
            thisElement.prop("selected", true);
            /*
            if( thisValue == '0' ) {
                $("#valor_clausula_jugadorclub").parent().hide();
            }
            */
        }
    });

    $("#valor_clausula_jugadorclub").val( datos_jugador_club[linea]['valor_clausula_jugadorclub'] );        

    $("#observaciones_jugadorclub").val( datos_jugador_club[linea]['observaciones_jugadorclub'] );


    // -------------------------------------------- FORMUARLIO DE PARTIDOS -------------------------------------------- // 
    // Habilitando todos los inputs y selects del formulario id="formulario_partido_jugador" (estarán únicamente habilitados cuando se seleccione el partido a modificar desde la ventana modal):
    $('#formulario_partido_jugador input, #formulario_partido_jugador select').each(function(){
        let thisElement = $(this);
        thisElement.prop('disabled', false).css('background-color', '');
    });

    // Ocultando el mensaje de registrar jugadores en el formulario de partidos:
    $('.mensaje_registrarjugador_formpartido').hide();

    // Agregando la foto del club del jugador:
    // alert( datos_jugador_club[linea]['idclub'] );
    let foto_club_jugador = 'foto_clubes/' + datos_jugador_club[linea]['idclub'] + '.png?lala='+new Date()+'';

    $('#foto_1_club_jugador_partido').attr( 'src', foto_club_jugador );
    $('#foto_2_club_jugador_partido').attr( 'src', foto_club_jugador );

    // Agregando por defecto la foto del club rival:
    $('#foto_1_club_rival_partido').attr( 'src', '../config/default.png' );
    $('#foto_2_club_rival_partido').attr( 'src', '../config/default.png' );

    $('.foto-jugador-partido').attr( 'src', foto_jugador ); // <--- Formulario id="formulario_partido_jugador"  
    $('.nombre-jugador-partido').html( nombre_completo_jugador ); // <--- Formulario id="formulario_partido_jugador"
    
    buscar_partidos_jugador( datos_jugador_club[linea]['idfichaJugador_club'] ); // <---- Consultando los partidos del jugador

    /*
    // Deshabilitando todos los inputs y selects del formulario id="formulario_partido_jugador" (estarán únicamente habilitados cuando se seleccione el partido a modificar desde la ventana modal):
    $('#formulario_partido_jugador input, #formulario_partido_jugador select').each(function(){
        let thisElement = $(this);
        // thisElement.prop('disabled', true).css('background-color', '#cfcccc');
    });
    */

    $('#formulario_partido_jugador')[0].reset(); // <---- Vaciando formulario de partido.

    // Deshabilitando el botón de agregar partido:
    $('#boton-agregar-partido').prop('disabled', true); // <---- Deshabilitando el botón de guardar partido
    $('#boton-agregar-partido').removeClass('boton-agregar-partido-enabled');
    $('#boton-agregar-partido').addClass('boton-agregar-partido-disabled');

    calcular_minutos_jugados(); // <--- Calculando la cantidad de minutos jugados.

    // Ocultando cualquiera de las dos vistas desde las cuales el usuario haya visualizado los jugadores:
    $('#cuadro_jugadores_seguimiento').hide(500);
    $('#cuadro_form_agregar_jugador').show(500);

    campos_ficha_jugador(); // <--- Con esta función se muestran los campos según sea el caso.
    chequear_datos_form_fichajugador(); // <----- Validando los campos del formulario id="formulario_partido_jugador".
    $('.campo-club-jugadorenclub-otro').hide(); // <--- Esconder (Añadido el 18-05-2020 a las 12:47)
    $('.campo-campeonato-otro').hide(); // <--- Importante - Agregado el 18-05-2020
    $('.campo-club-rival-otro').hide(); // <--- Importante - Agregado el 18-05-2020

    // Mostrando el botón de agregar ficha jugador:
    $('#boton_agregar_ficha_jugador').show();

}
// -------------------------- Fin de la función 'boton_editar_form_jugador( linea )' - EDITAR (UPDATE) --------------------------- //


// -------------------------- Inicio de la función 'boton_editar_form_partido( linea, vista_modal_partido )' - EDITAR (UPDATE) --------------------------- //
function boton_editar_form_partido( linea, vista_modal_partido ){

    window.idfichaJugador = datos_jugador_partido[linea]['idfichaJugador'];
    window.idfichaJugador_club = datos_jugador_partido[linea]['idfichaJugador_club'];
    window.idfichaJugador_partido = datos_jugador_partido[linea]['idfichaJugador_partido'];


    $('#formulario_partido_jugador').show();
    // alert(datos_jugador_partido[linea]['idfichaJugador_partido']);

    // -------------------------------------------- FORMULARIO DE FICHA JUGADOR -------------------------------------------- //
    let foto_jugador = 'foto_jugadores_scouting/' + datos_jugador_partido[linea]['idfichaJugador'] + '.png?lala='+new Date()+'';
    // $('#foto_anterior_jugador').val( foto_jugador ); // <--- Importante. Cargar valor de la foto del entrenador en este campo oculto.
    $('#foto_anterior_jugador').val( datos_jugador_partido[linea]['idfichaJugador'] + '.png' ); // <--- Importante. Cargar valor de la foto del entrenador en este campo oculto.
    $('#foto_jugador').val(''); // <--- Importante. Vaciar.     

    $('#foto-jugador').attr( 'src', foto_jugador ); // <--- Formulario id="formulario_ficha_jugador"
    $("#nombre").val( datos_jugador_partido[linea]['nombre'] );
    $("#apellido1").val( datos_jugador_partido[linea]['apellido1'] );
    
    if( datos_jugador_partido[linea]['apellido2'] === null ||  datos_jugador_partido[linea]['apellido2'] === '' ) {
        datos_jugador_partido[linea]['apellido2'] = "";
    }
    $("#apellido2").val( datos_jugador_partido[linea]['apellido2'] );
    
    $("#fechaNacimiento").val( datos_jugador_partido[linea]['fechaNacimiento'] );

    let nombre_completo_jugador = datos_jugador_partido[linea]['nombre'] + " " + datos_jugador_partido[linea]['apellido1'] + " " + datos_jugador_partido[linea]['apellido2'];

    // Selects:
    $("#sexo option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['sexo'] ) {
            thisElement.prop("selected", true);
        }
    });

    $("#altura").val( datos_jugador_partido[linea]['altura'] );
    
    // Selects:
    $("#nacionalidad1 option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['nacionalidad1'] ) {
            thisElement.prop("selected", true);
        }
    });
    
    $("#nacionalidad2 option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['nacionalidad2'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    $("#serieActual option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['serieActual'] ) {
            thisElement.prop("selected", true);
        }
    });     

    $("#dinamico option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['dinamico'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    $("#posicion0 option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['posicion0'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    $("#posicion1 option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['posicion1'] ) {
            thisElement.prop("selected", true);
        }
    });

    $("#posicion2 option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['posicion2'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    $("#seleccionado option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['seleccionado'] ) {
            thisElement.prop("selected", true);
        }
    });                     

    // Estado del jugador:
    $("#estado_jugadorclub option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['estado_jugadorclub'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    // Club anterior de Jugador libre:
    $("#idclub_jugadorlibre option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['idclub_jugador'] ) {
            thisElement.prop("selected", true);
        }
    });

    // Representante
    $('#representante_jugadorclub').val( datos_jugador_partido[linea]['representante_jugadorclub'] );

    // Club actual de Jugador en Club:

    $("#pais_club_actual option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['pais_club_jugador'] ) {
            thisElement.prop("selected", true);
        }
    });

    $("#division_club_actual option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['division_club_jugador'] ) {
            thisElement.prop("selected", true);
        }
    });

    // Seleccionando el ID de club según el país y división seleccionado (para el select #idclub_actual_jugadorenclub):
    // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
    $('#idclub_actual_jugadorenclub').empty(); // <--- Vaciando select.
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
            'pais_club': datos_jugador_partido[linea]['pais_club_jugador'],
            'division_club': datos_jugador_partido[linea]['division_club_jugador'] 
        },
        success: function(respuesta)  {
            $('#idclub_actual_jugadorenclub').empty(); // <--- Vaciando select.
            if( respuesta== "" ) { //jugador sin informes
                console.log("No se encontró ningún club según el país y división seleccionada...");
                $("#idclub_actual_jugadorenclub").append('<option value="">No se encontraron clubes</option>');
                $("#idclub_actual_jugadorenclub").append('<option value="000">Otro</option>');
            } else {              
                                
                $("#idclub_actual_jugadorenclub").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $("#idclub_actual_jugadorenclub").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }
                $("#idclub_actual_jugadorenclub").append('<option value="000">Otro</option>');

                $("#idclub_actual_jugadorenclub option").each(function(){
                    let thisElement = $(this);
                    let thisValue = $(this).val();
                    if( thisValue == datos_jugador_partido[linea]['idclub_jugador'] ) {
                        thisElement.prop("selected", true);
                    }
                });
            } 
        
        },
        error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
                $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
    // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //


    $("#contrato_pro_jugadorclub option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['contrato_pro_jugadorclub'] ) {
            thisElement.prop("selected", true);
        }
    });         

    // Situación del jugador en el club actual:
    $("#situ_clubactual_jugadorclub option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['situ_clubactual_jugadorclub'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    // Inputs:
    $("#fechafin_prestamo_jugadorclub").val( datos_jugador_partido[linea]['fechafin_prestamo_jugadorclub'] );
    $("#pase_pertenencia_jugadorclub").val( datos_jugador_partido[linea]['pase_pertenencia_jugadorclub'] );
    $("#fechafin_contrato_jugadorclub").val( datos_jugador_partido[linea]['fechafin_contrato_jugadorclub'] );
    $("#valor_mercado_jugadorclub").val( datos_jugador_partido[linea]['valor_mercado_jugadorclub'] );

    // Cláusula de salida:
    $("#clausula_salida_jugadorclub option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['clausula_salida_jugadorclub'] ) {
            thisElement.prop("selected", true);
            /*
            if( thisValue == '0' ) {
                $("#valor_clausula_jugadorclub").parent().hide();
            }
            */
        }
    });

    $("#valor_clausula_jugadorclub").val( datos_jugador_partido[linea]['valor_clausula_jugadorclub'] );     

    $("#observaciones_jugadorclub").val( datos_jugador_partido[linea]['observaciones_jugadorclub'] );

    campos_ficha_jugador(); // <--- Con esta función se muestran los campos según sea el caso.
    chequear_datos_form_fichajugador(); // <----- Validando los campos del formulario id="formulario_partido_jugador".

    // -------------------------------------------- FORMUARLIO DE FICHA DE PARTIDO -------------------------------------------- //
    if( vista_modal_partido === 1 ) {
        $('#modal-detalle-jugador').modal('hide');

        if( window.estatus_vista_form === 1 ) {
            $('#cuadro_jugadores_club_selected').hide(500);
        } else {
            $('#jugadores_pozo_comun').hide(500);
        }
        
        $('#cuadro_form_agregar_jugador').show(500);

        // Ocultando por defecto los datos de ficha jugador:
        ocultar_datos_fichaJugador();
        $('a[href="#tab_form_fichajugador"]').parent().attr('class', '');
        $('#tab_form_fichajugador').attr('class', 'tab-pane');

        $('a[href="#tab_form_partido"]').parent('li').show(); // <--- Mostrando tab de formulario de partidos.
        $('a[href="#tab_form_partido"]').parent().attr('class', 'active');
        $('#tab_form_partido').attr('class', 'tab-pane active');
        $('#formulario_partido_jugador').show(); // <--- Mostrando formulario.
        
    } 

    // Habilitando todos los inputs y selects del formulario id="formulario_partido_jugador" (estarán únicamente habilitados cuando se seleccione el partido a modificar desde la ventana modal):
    $('#formulario_partido_jugador input, #formulario_partido_jugador select').each(function(){
        let thisElement = $(this);
        thisElement.prop('disabled', false).css('background-color', '');
    });

    // Habilitando el botón de agregar partido (estaránrá únicamente habilitado cuando se seleccione el partido a modificar desde la ventana modal):
    /*
    $('#boton-agregar-partido').prop('disabled', false).css('cursor', 'default'); // <---- Deshabilitando el botón de guardar partido
    $('#boton-agregar-partido').addClass('boton-agregar-partido-enabled');
    */

    // Agregando la foto del club del jugador:
    let foto_club_jugador = 'foto_clubes/' + datos_jugador_partido[linea]['idclub_jugador'] + '.png?lala='+new Date()+'';

    $('#foto_1_club_jugador_partido').attr( 'src', foto_club_jugador );
    $('#foto_2_club_jugador_partido').attr( 'src', foto_club_jugador );

    // Agregando la foto del club rival:
    let foto_club_rival = 'foto_clubes/' + datos_jugador_partido[linea]['idclub_rival'] + '.png?lala='+new Date()+'';

    $('#foto_1_club_rival_partido').attr( 'src', foto_club_rival );
    $('#foto_2_club_rival_partido').attr( 'src', foto_club_rival );

    // -------------------------- Agregando los valores a los inputs y selects del partido seleccionado -------------------------- //
    $("#fecha_jugadorpartido").val( datos_jugador_partido[linea]['fecha_jugadorpartido'] );

    // ---------------------- Establecer como selected el campeonato ---------------------- // 
    $("#idcampeonato").empty();
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_all_campeonatos',    
        },success: function(respuesta){

            $("#idcampeonato").append('<option value="">Seleccione</option>');
            for(var i=0; i < respuesta.length; i++) {   
                $("#idcampeonato").append('<option pais-campeonato="'+respuesta[i]['pais_campeonato']+'" value="'+respuesta[i]['idcampeonato']+'">'+respuesta[i]['nombre_campeonato']+'</option>');
            }
            $("#idcampeonato").append('<option value="000">Otro</option>');

            $("#idcampeonato option").each(function(){
                let thisElement = $(this);
                let thisValue = $(this).val();
                if( thisValue == datos_jugador_partido[linea]['idcampeonato'] ) {
                    thisElement.prop("selected", true);
                }
            });

            
        },error: function(){// will fire when timeout is reached
            console.log('Error al consultar campeonatos para el select de campeonatos (partidos de jugador)');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 

    $("#temporada_jugadorpartido").val( datos_jugador_partido[linea]['temporada_jugadorpartido'] );
    $("#jornada_jugadorpartido").val( datos_jugador_partido[linea]['jornada_jugadorpartido'] );

    // ---------------------- Establecer como selected el club rival ---------------------- // 
    $("#idclub_rival").empty();
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paiscampeonato', // <---- Consultando clubes según el país del campeonato seleccionado.
            'pais_campeonato': datos_jugador_partido[linea]['pais_campeonato']   
        },success: function(respuesta){

            $("#idclub_rival").append('<option value="">Seleccione</option>');
            for(var i=0; i < respuesta.length; i++) {   
                $("#idclub_rival").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
            }
            $("#idclub_rival").append('<option value="000">Otro</option>');

            $("#idclub_rival option").each(function(){
                let thisElement = $(this);
                let thisValue = $(this).val();
                if( thisValue == datos_jugador_partido[linea]['idclub_rival'] ) {
                    thisElement.prop("selected", true);
                }
            });

            
        },error: function(){// will fire when timeout is reached
            console.log('Error al consultar clubes para el select de clubes rival (partidos de jugador)');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 

    $("#posicion_jugadorpartido option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['posicion_jugadorpartido'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    $("#tit_sup_nc_jugadorpartido option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_jugador_partido[linea]['tit_sup_nc_jugadorpartido'] ) {
            thisElement.prop("selected", true);
        }
    });

    $("#gol_equipo1_jugadorpartido").val( datos_jugador_partido[linea]['gol_equipo1_jugadorpartido'] );
    $("#gol_equipo2_jugadorpartido").val( datos_jugador_partido[linea]['gol_equipo2_jugadorpartido'] );

    switch( datos_jugador_partido[linea]['condicion_jugadorpartido'] ) {
        case "1": // <---- Local.
            $("#condicion_local_jugadorpartido").prop('checked', true);
            break;
        case "2": // <---- Visitante.
            $("#condicion_visita_jugadorpartido").prop('checked', true);
            break;     
        case "3": // <---- Neutral.
            $("#condicion_neutral_jugadorpartido").prop('checked', true);
            break;                                                                  
    }

    $('#t_amarilla_jugadorpartido').val( datos_jugador_partido[linea]['t_amarilla_jugadorpartido'] );
    $('#t_amarilladb_jugadorpartido').val( datos_jugador_partido[linea]['t_amarilladb_jugadorpartido'] );
    $('#t_roja_jugadorpartido').val( datos_jugador_partido[linea]['t_roja_jugadorpartido'] );
    $('#num_gol_jugadorpartido').val( datos_jugador_partido[linea]['num_gol_jugadorpartido'] );
    $('#min_entrada_jugadorpartido').val( datos_jugador_partido[linea]['min_entrada_jugadorpartido'] );
    $('#min_salida_jugadorpartido').val( datos_jugador_partido[linea]['min_salida_jugadorpartido'] );
    $('#min_jugados_jugadorpartido_text').html( datos_jugador_partido[linea]['min_jugados_jugadorpartido'] + ' minutos' );
    $('#min_jugados_jugadorpartido').val( datos_jugador_partido[linea]['min_jugados_jugadorpartido'] );

    chequear_datos_form_partidojugador(); // <---- Validando campos del formulario id="formulario_partido_jugador"
    $('.campo-club-jugadorenclub-otro').hide(); // <--- Esconder (Añadido el 18-05-2020 a las 12:47)
    $('.campo-campeonato-otro').hide(); // <--- Importante - Agregado el 18-05-2020
    $('.campo-club-rival-otro').hide(); // <--- Importante - Agregado el 18-05-2020
}
// -------------------------- Fin de la función 'boton_editar_form_partido( linea, vista_modal_partido )' - EDITAR (UPDATE) --------------------------- //

    
// ----------------- Inicio de la función 'boton_guardar_ficha_jugador()' ----------------- // 
function boton_guardar_ficha_jugador(){
    if (window.idfichaJugador != "" ) {
        $('#mensaje_agregar_ficha_jugador').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_ficha_jugador').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }
    $('#modal_formulario_ficha_jugador').modal('show');
    $('.boton_modal').css('display','');
}
// ----------------- Fin de la función 'boton_guardar_ficha_jugador()' ----------------- //

// ----------------- Inicio de la función 'guardar_ficha_jugador()' ----------------- //
function guardar_ficha_jugador(){
    $('.boton_modal').css('display','none');

    if(window.idfichaJugador_club!=""){
        $('#mensaje_agregar_ficha_jugador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_ficha_jugador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }

    // var data = $('#formulario_ficha_jugador').serializeArray();
    var data = new FormData( $('#formulario_ficha_jugador')[0] );

    data.append('idfichaJugador', window.idfichaJugador);
    data.append('idfichaJugador_club', window.idfichaJugador_club);
    data.append('nombre_usuario_software', '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>');

    $.ajax({
        url: "post/scouting_centro_guardar_fichajugador.php",
        type: "post",
            contentType:false,
            data:data,
            processData:false,
            cache:false,
        success: function(respuesta){
            // alert(respuesta);
            if(respuesta==1){

                $('#mensaje_agregar_ficha_jugador').html('<h4>Registro ingresado correctamente!</h4>');
                buscar_jugadores_seguimiento( 1 );
                $("#cuadro_form_agregar_jugador").hide(500);
                $('#cuadro_jugadores_seguimiento').show(500);
                $('#modal_formulario_ficha_jugador').modal('hide');

            }else if(respuesta==2){
                $('#mensaje_agregar_ficha_jugador').html('<h4>Registro editado correctamente!</h4>');

                $('#mensaje_agregar_ficha_jugador').html('<h4>Registro editado correctamente!</h4>');
                buscar_jugadores_seguimiento( 1 );            
                $("#cuadro_form_agregar_jugador").hide(500);
                $('#cuadro_jugadores_seguimiento').show(500);
                $('#modal_formulario_ficha_jugador').modal('hide')
            }
            else{ // respuesta==4
                $('#mensaje_agregar_ficha_jugador').html('<h5>Ha ocurrido un error al ejecutar la consulta: '+respuesta+'.</h5><br>');
            }
            
        },error: function(){// will fire when timeout is reached
           $('#mensaje_agregar_ficha_jugador').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 

    // Reiniciando selects de la vista:
    // Código agregado el 17-05-2020 a las 17:27:
    $('#cuadro_jugadores_seguimiento select').each(function() {
        let thisElement = $(this);
        thisElement.prop('selectedIndex', 0);
    });     

}
// ----------------- Fin de la función 'guardar_ficha_jugador()' ----------------- //


// ------------------------------------------ Inicio de la función 'boton_eliminar_jugador( linea )' ------------------------------------------ // 
function boton_eliminar_jugador( linea ) {
    window.idfichaJugador= datos_jugador_club[linea]['idfichaJugador'];
    // alert( datos_jugador_club[linea]['idfichaJugador'] );
    $('#modal_eliminar_jugador').modal('show');
    $('#mensaje_eliminar_jugador').html('<h5>¿Estás seguro que quieres eliminar este jugador?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
}
// ------------------------------------------ Fin de la función 'boton_eliminar_jugador( linea )' ------------------------------------------ //

// ------------------------------------------ Inicio de la función 'eliminar_jugador()' ------------------------------------------ //
function eliminar_jugador() {
    //alert( window.idfichaJugador );

     $('.boton_modal').hide();
     $('#mensaje_eliminar_jugador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando jugador...</h5><br><img src="../config/remover_archivo.png">');
     $.ajax({
        url: "post/scouting_busqueda_eliminar_fichajugador.php",
        type: "post",
        data: {
            'idfichaJugador': window.idfichaJugador
        },success: function(respuesta) {
            if(respuesta==1){//eliminado correctamente
                $('#mensaje_eliminar_jugador').html('<h5>Jugador eliminado correctamente!</h5>');
                
                // alert( window.estatus_vista_form );
                if( window.estatus_vista_form === 1 ) { // Ingresó al formulario desde la vista de un determinado club. 
                    get_edad_minmax_club();
                    ver_jugadores_club_selected();                  
                } else { // Ingresó al formulario desde la vista de jugadores del pozo común.
                    get_edad_altura_minmax_pozocomun();
                    buscar_jugadores_pozo_comun();
                }               
                $('#modal_eliminar_jugador').modal('hide');
            }else{
                $('#mensaje_eliminar_jugador').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> contacte al administrador.</h5>");
            }
            // $('#modal_eliminar_jugador').modal('hide');
        },error: function(){// will fire when timeout is reached
            $('#mensaje_eliminar_jugador').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> compruebe conexión a internet.</h5>");
        }, timeout: 10000 // sets timeout to 3 seconds
      });     
}
// ------------------------------------------ Fin de la función 'eliminar_jugador()' ------------------------------------------ //

// ----------------- Inicio de la función 'boton_guardar_partido()' ----------------- // 
function boton_guardar_partido(){

    // alert( "idfichaJugador_partido: " + window.idfichaJugador_partido );
    
    if (window.idfichaJugador_partido != "" ) {
        $('#mensaje_agregar_partido_jugador').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_partido_jugador').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }
    $('#modal_formulario_guardar_partido_jugador').modal('show');
    $('.boton_modal').css('display','');
}
// ----------------- Fin de la función 'boton_guardar_partido()' ----------------- //

// ----------------- Inicio de la función 'guardar_partido_jugador()' ----------------- //
function guardar_partido_jugador(){
    $('.boton_modal').css('display','none');

    if(window.idfichaJugador_partido!=""){
        $('#mensaje_agregar_partido_jugador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_partido_jugador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }

    // var data = $('#formulario_partido_jugador').serializeArray();
    var data = new FormData( $('#formulario_partido_jugador')[0] );

    data.append('idfichaJugador_club', window.idfichaJugador_club);
    data.append('idfichaJugador_partido', window.idfichaJugador_partido);
    data.append('nombre_usuario_software', '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>');

    // alert(JSON.stringify(data));
    $.ajax({
        url: "post/scouting_busqueda_guardar_partidojugador.php",
        type: "post",
            contentType:false,
            data:data,
            processData:false,
            cache:false,
        success: function(respuesta){
            // alert(respuesta);
            if(respuesta==1){

                $('#mensaje_agregar_partido_jugador').html('<h4>Registro ingresado correctamente!</h4>');
                buscar_partidos_jugador( window.idfichaJugador_club ); // <---- Consultando los partidos del jugador
                $('#modal_formulario_guardar_partido_jugador').modal('hide');
                $('#formulario_partido_jugador')[0].reset(); // <--- Vaciando formulario.
                
                // Escondiendo los inputs de otro campeonato y club:
                $('.campo-campeonato-otro').hide();
                $('.campo-club-rival-otro').hide();                 

                window.idfichaJugador_partido = ''; // <--- Vaciando la variable en caso de que el usuario quiera registrar otro partido (para que pueda ejecutarse el INSERT)
                $('#formulario_partido_jugador').hide(); // <--- Escondiendo formulario de partido de jugador.


            }else if(respuesta==2){

                $('#mensaje_agregar_partido_jugador').html('<h4>Registro editado correctamente!</h4>');
                buscar_partidos_jugador( window.idfichaJugador_club ); // <---- Consultando los partidos del jugador
                $('#modal_formulario_guardar_partido_jugador').modal('hide');
                $('#formulario_partido_jugador')[0].reset(); // <--- Vaciando formulario.
                
                // Escondiendo los inputs de otro campeonato y club:
                $('.campo-campeonato-otro').hide();
                $('.campo-club-rival-otro').hide();                 

                window.idfichaJugador_partido = ''; // <--- Vaciando la variable en caso de que el usuario quiera registrar otro partido (para que pueda ejecutarse el INSERT)
                $('#formulario_partido_jugador').hide(); // <--- Escondiendo formulario de partido de jugador.


            }
            else{ // respuesta==4
                $('#mensaje_agregar_partido_jugador').html('<h5>Ha ocurrido un error al ejecutar la consulta: '+respuesta+'.</h5><br>');
            }
            
        },error: function(){// will fire when timeout is reached
           $('#mensaje_agregar_partido_jugador').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
}
// ----------------- Fin de la función 'guardar_partido_jugador()' ----------------- //

// ------------------------------------------ Inicio de la función 'boton_eliminar_partido( linea )' ------------------------------------------ // 
function boton_eliminar_partido( linea ) {
    
    window.idfichaJugador_club = datos_jugador_partido[linea]['idfichaJugador_club'];
    window.idfichaJugador_partido = datos_jugador_partido[linea]['idfichaJugador_partido'];
    
    // alert( datos_jugador_partido[linea]['idfichaJugador_partido'] );

    $('#modal-detalle-jugador').modal('hide'); // <--- Ocultando la venta modal del jugador por si se el usuario ha decidido eliminar desde la ventana modal.

    // alert( datos_partido_club[linea]['idfichaJugador_partido']; );
    $('#modal_eliminar_partido').modal('show');
    $('#mensaje_eliminar_partido').html('<h5>¿Estás seguro que quieres eliminar este partido?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();

}
// ------------------------------------------ Fin de la función 'boton_eliminar_partido( linea )' ------------------------------------------ //

// ------------------------------------------ Inicio de la función 'eliminar_partido()' ------------------------------------------ //
function eliminar_partido() {
    //alert( window.idfichaJugador_partido );

     $('.boton_modal').hide();
     $('#mensaje_eliminar_partido').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando partido...</h5><br><img src="../config/remover_archivo.png">');
     $.ajax({
        url: "post/scouting_busqueda_eliminar_partidojugador.php",
        type: "post",
        data: {
            'idfichaJugador_partido': window.idfichaJugador_partido
        },success: function(respuesta) {
            if(respuesta==1){//eliminado correctamente
                $('#mensaje_eliminar_partido').html('<h5>Partido eliminado correctamente!</h5>');

                $('#modal_eliminar_partido').modal('hide');
                $('#modal-detalle-jugador').modal('hide'); // <--- Ocultando la venta modal del jugador por si se el usuario ha decidido eliminar desde la ventana modal.

                buscar_partidos_jugador( window.idfichaJugador_club ); // <---- Consultando los partidos del jugador

                $('#formulario_partido_jugador')[0].reset(); // <---- Vaciando formulario.
                $('#formulario_partido_jugador').hide(); // <---- Escondiendo formulario.
                // Escondiendo los inputs de otro campeonato y club:
                $('.campo-campeonato-otro').hide();
                $('.campo-club-rival-otro').hide();             

                window.idfichaJugador_partido = ''; // <--- Vaciando la variable en caso de que el usuario quiera registrar otro partido (para que pueda ejecutarse el INSERT)

            }else{
                $('#mensaje_eliminar_partido').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> contacte al administrador.</h5>");
            }
            // $('#modal_eliminar_partido').modal('hide');
        },error: function(){// will fire when timeout is reached
            $('#mensaje_eliminar_partido').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> compruebe conexión a internet.</h5>");
        }, timeout: 10000 // sets timeout to 3 seconds
      });     
}
// ------------------------------------------ Fin de la función 'eliminar_partido()' ------------------------------------------ //

// -------------------- Inicio de la función 'buscar_club_pais()' ------------------------- //
function buscar_club_pais() {

    // Filtros de búsqueda:
    var tipo_pais =  $('.input-filtro-tipo-pais').val();
    var pais_club;
    var division_club;
    if( tipo_pais == '1' ) {
        $('.filtros-pais-otros').hide();
        $('.filtros-pais-principales').show();      
        pais_club = $('.input-filtro-pais_club').val();
        division_club = $('.select-division-filtro-busqueda').val();
    } else {
        $('.filtros-pais-principales').hide();
        $('.filtros-pais-otros').show();
        pais_club = $('#idpais_otros_filtro').val();
        division_club = $('#division_idpais_otros_filtro').val();
    }
    
    // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 1, // <---- Consultando clubes del país seleccionado (los mostrados en la vista principal).
            'tipo_pais': tipo_pais,
            'pais_club': pais_club,
            'division_club': division_club      
        },
        success: function(respuesta)  {

            if(respuesta== ""){ //jugador sin informes
                $("#tabla_club_pais_selected tbody").empty();
                var markup = '<tr class="panel_buscar" id="informe_"><td colspan="10"><b>No se encontraron clubes según el país seleccionado</b></td></tr>';
                $("#tabla_club_pais_selected tbody").append(markup);
                $('#cargando_buscar_club_pais').hide();
                $('#sin_resultados_club_pais').show();
                $('#boton_refresh_club_pais').hide();
                // $('#boton_agregar_ficha_jugador').prop("disabled", true);
            }else{              
                window.datos_jugador_club = respuesta; //se copian todos los profesores al cache
                $("#tabla_club_pais_selected tbody").empty();

                var count = 1;
                for(var i=0; i < respuesta.length; i++){
                    let idclub = parseInt( respuesta[i]['idclub'] );
                    let pais_club = parseInt( respuesta[i]['pais_club'] );
                    let division_club = parseInt( respuesta[i]['division_club'] );
                    let nombre_club = respuesta[i]['nombre_club'];                              
                    let entrenador_club = respuesta[i]['entrenador_club'];
                    let foto_club = respuesta[i]['foto_club'];
                    let cantidad_total_jugadores = respuesta[i]['cantidad_total_jugadores'];
                    let media_edad = respuesta[i]['media_edad'];

                    var markup = 
                    '<tr class="tr-club" tr-id-club="'+idclub+'" tr-nombre-club="'+nombre_club+'" tr-foto-club="'+foto_club+'">\
                        <td style="font-weight:bold;">\
                            <div class="div-imagen-club-tabla"><img class="imagen-club-tabla" src="'+foto_club+'"></div>\
                        </td>\
                        <td style="text-align: left; max-width: 170px; width: 170px;">\
                            <p class="ellipsis-text">\
                                '+nombre_club+'\
                            </p>\
                        </td>\
                        <td class="td-valoracion" style="text-align: left;">\
                            <div class="div-club-table"><img src="'+array_paises[pais_club][2]+'" class="img-club" /><p class="ellipsis-text nombre-club-table">'+array_divisiones[division_club][1]+'</p></div>\
                        </td>\
                        <td style="text-align: left;">\
                            <b>'+cantidad_total_jugadores+' jugadores</b>\
                        </td>\
                        <td class="td-valoracion">\
                            <b>'+entrenador_club+'</b>\
                        </td>\
                        <td class="td-valoracion">\
                            <b>'+media_edad+' años</b>\
                        </td>\
                        <td class="td-valoracion"></td>\
                    </tr>';

                    $("#tabla_club_pais_selected tbody").append(markup);

                    count = count + 1;
                }

                $('#boton_refresh_club_pais').hide();
            } 
            $('#cargando_buscar_club_pais').hide();
            $('#error_conexion_club_pais').hide();
            $('#sin_resultados_club_pais').hide();
        
        },
        error: function(){// will fire when timeout is reached
            $('#cargando_buscar_club_pais').hide();
            $('#sin_resultados_club_pais').hide();
            $('#error_conexion_club_pais').show();
            $('#boton_refresh_club_pais').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
    // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //    
} 
// -------------------- Fin de la función 'buscar_club_pais()' ------------------------- //

// --------------------- Inicio de la función 'buscar_campeonatos_todos()' --------------------- //
function buscar_campeonatos_todos() {

    $(".select-campeonato").empty();

    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_all_campeonatos',    
        },success: function(respuesta){

            $(".select-campeonato").append('<option value="">Seleccione</option>');
            for(var i=0; i < respuesta.length; i++) {   
                $(".select-campeonato").append('<option pais-campeonato="'+respuesta[i]['pais_campeonato']+'" value="'+respuesta[i]['idcampeonato']+'">'+respuesta[i]['nombre_campeonato']+'</option>');
            }
            $(".select-campeonato").append('<option value="000">Otro</option>');
            
        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
            $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    });     
}
// --------------------- Fin de la función 'buscar_campeonatos_todos()' --------------------- //

// --------------------- Inicio de la función 'buscar_clubes_todos()' --------------------- //
function buscar_clubes_todos() {

    // Vaciando selects:
    $(".select-club").empty();
    $(".select-club-filtro-busqueda").empty();
    
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_all_clubes',    
        },success: function(respuesta){

            // Para los formularios (la primera opción es 'Seleccione')
            $(".select-club").append('<option value="">Seleccione</option>');
            for(var i=0; i < respuesta.length; i++) {   
                $(".select-club").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
            }
            $(".select-club").append('<option value="000">Otro</option>');

            // Para los filtros de búsqueda (la primera opción es 'Todos')
            $(".select-club-filtro-busqueda").append('<option value="">Todos</option>');
            for(var i=0; i < respuesta.length; i++) {   
                $(".select-club-filtro-busqueda").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
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

// ------------------------------ Inicio de la función 'chequear_datos_form_fichajugador()' ------------------------------ // 
function chequear_datos_form_fichajugador(){
    // alert('Estoy validando...');
    // var ER_numericosDecimales = /^([0-9]*|(\d+))(\.\d{1,2})?$/;
    var ER_numericosDecimales = /^([0-9]*|(\d+))((.|,)\d{1,})?$/;
    var ER_numericosEnteros = /[0-9]/;
    var ER_caracteresAlfaNumericos = /^[a-zA-ZáàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜñÑ 0-9,.-_¿?¡!$%#()]*$/;
    flag = true;
        
    /*
    #ffc6c6 <--- Color rosado.
    #d4ffdc <--- Color verde.
    */

    // ---------------------- Datos fichaJugador ---------------------- //

    // ------------------------------------------------------------------------ //
    let foto_jugador = $("#foto_jugador").val();
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if( foto_jugador != "" ) {
        if( !allowedExtensions.exec(foto_jugador) ) {      
            // alert('Formato inválido para foto');
            flag = false;
        } else {
            // alert('Formato correcto para foto');
        }
    } else {
        // flag = false;
    }
        
    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let nombre = $("#nombre").val();
    if( nombre != "" ) {
        if( nombre.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre.length) >= 1 && parseInt(nombre.length) <= 150 ) ) {      
            $("#nombre").css("background-color", "white");
        } else {
            $("#nombre").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#nombre").css("background-color", "white");
        flag = false;
    }

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let apellido1 = $("#apellido1").val();
    if( apellido1 != "" ) {
        if( apellido1.match(ER_caracteresAlfaNumericos) && ( parseInt(apellido1.length) >= 1 && parseInt(apellido1.length) <= 150 ) ) {      
            $("#apellido1").css("background-color", "white");
        } else {
            $("#apellido1").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#apellido1").css("background-color", "white");
        flag = false;
    }

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let apellido2 = $("#apellido2").val();
    if( apellido2 != "" ) {
        if( apellido2.match(ER_caracteresAlfaNumericos) && ( parseInt(apellido2.length) >= 1 && parseInt(apellido2.length) <= 150 ) ) {      
            $("#apellido2").css("background-color", "white");
        } else {
            $("#apellido2").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#apellido2").css("background-color", "white");
        // flag = false;
    }   

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let fechaNacimiento = $("#fechaNacimiento").val();
    if( fechaNacimiento == "" ) {
        $("#fechaNacimiento").css("background-color", "white");
        // flag = false;
    } else {
        $("#fechaNacimiento").css("background-color", "white");
    }

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let sexo = $("#sexo").val();
    if( sexo == "" ) {
        $("#sexo").css("background-color", "white");
        // flag = false;
    } else {
        $("#sexo").css("background-color", "white");
    }

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let altura = $("#altura").val();
    if( altura != "" ) {
        if( altura.match(ER_numericosEnteros) && ( parseInt(altura.length) >= 1 && parseInt(altura.length) <= 3 ) ) {      
            $("#altura").css("background-color", "white");
        } else {
            $("#altura").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#altura").css("background-color", "white");
        // flag = false;
    }           

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let nacionalidad1 = $("#nacionalidad1").val();
    if( nacionalidad1 == "" ) {
        $("#nacionalidad1").css("background-color", "white");
        // flag = false;
    } else {
        $("#nacionalidad1").css("background-color", "white");
    }

    // ------------------------------------------------------------------------ //
    let nacionalidad2 = $("#nacionalidad2").val();
    if( nacionalidad2 == "" ) {
        $("#nacionalidad2").css("background-color", "white");
        // flag = false;
    } else {
        $("#nacionalidad2").css("background-color", "white");
    }

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let serieActual = $("#serieActual").val();
    if( serieActual == "" ) {
        $("#serieActual").css("background-color", "white");
        // flag = false;
    } else {
        $("#serieActual").css("background-color", "white");
    }       

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let dinamico = $("#dinamico").val();
    if( dinamico == "" ) {
        $("#dinamico").css("background-color", "white");
        // flag = false;
    } else {
        $("#dinamico").css("background-color", "white");
    }

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let posicion0 = $("#posicion0").val();
    if( posicion0 == "" ) {
        $("#posicion0").css("background-color", "white");
        // flag = false;
    } else {
        $("#posicion0").css("background-color", "white");
    }

    // ------------------------------------------------------------------------ //
    let posicion1 = $("#posicion1").val();
    if( posicion1 == "" ) {
        $("#posicion1").css("background-color", "white");
        // flag = false;
    } else {
        $("#posicion1").css("background-color", "white");
    }       

    // ------------------------------------------------------------------------ //
    let posicion2 = $("#posicion2").val();
    if( posicion2 == "" ) {
        $("#posicion2").css("background-color", "white");
        // flag = false;
    } else {
        $("#posicion2").css("background-color", "white");
    }

    // ---------------------- Datos fichaJugador_club ---------------------- //
    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let estado_jugadorclub = $("#estado_jugadorclub").val();
    if( estado_jugadorclub == "" ) {
        $("#estado_jugadorclub").css("background-color", "white");
        // flag = false;
    } else {
        $("#estado_jugadorclub").css("background-color", "white");
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#representante_jugadorclub").is(":visible")) {
        // ------------------------------------------------------------------------ //
        let representante_jugadorclub = $("#representante_jugadorclub").val();
        if( representante_jugadorclub != "" ) {
            if( representante_jugadorclub.match(ER_caracteresAlfaNumericos) && ( parseInt(representante_jugadorclub.length) >= 1 && parseInt(representante_jugadorclub.length) <= 150 ) ) {
                $("#representante_jugadorclub").css("background-color", "white");
            } else {
                $("#representante_jugadorclub").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#representante_jugadorclub").css("background-color", "white");
            // flag = false;
        }
    }   

    // --------------- JUGADOR LIBRE --------------- //
    // ------------------------------------------------------------------------ //

    // Aplicando validación solamente si el campo es visible:
    if($("#idclub_jugadorlibre").is(":visible")) {
        // alert("El campo es visible.");
        // OBLIGATORIO
        let idclub_jugadorlibre = $("#idclub_jugadorlibre").val();
        if( idclub_jugadorlibre == "" ) {
            $("#idclub_jugadorlibre").css("background-color", "white");
            // flag = false;
        } else {
            $("#idclub_jugadorlibre").css("background-color", "white");
        }   
    } 


    // Datos del último club (otro):
    // ------------------------------------------------------------------------ //

    // Aplicando validación solamente si el campo es visible:
    if($("#pais_club_jugadorlibre_otro").is(":visible")) {
        // alert("El campo es visible.");
        // OBLIGATORIO
        let pais_club_jugadorlibre_otro = $("#pais_club_jugadorlibre_otro").val();
        if( pais_club_jugadorlibre_otro == "" ) {
            $("#pais_club_jugadorlibre_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#pais_club_jugadorlibre_otro").css("background-color", "white");
        }   
    } 

    // Aplicando validación solamente si el campo es visible:
    if($("#division_club_jugadorlibre_otro").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let division_club_jugadorlibre_otro = $("#division_club_jugadorlibre_otro").val();
        if( division_club_jugadorlibre_otro == "" ) {
            $("#division_club_jugadorlibre_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#division_club_jugadorlibre_otro").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#nombre_club_jugadorlibre_otro").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let nombre_club_jugadorlibre_otro = $("#nombre_club_jugadorlibre_otro").val();
        if( nombre_club_jugadorlibre_otro != "" ) {
            if( nombre_club_jugadorlibre_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_club_jugadorlibre_otro.length) >= 1 && parseInt(nombre_club_jugadorlibre_otro.length) <= 150 ) ) {
                $("#nombre_club_jugadorlibre_otro").css("background-color", "white");
            } else {
                $("#nombre_club_jugadorlibre_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#nombre_club_jugadorlibre_otro").css("background-color", "white");
            // flag = false;
        }
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#entrenador_club_jugadorlibre_otro").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let entrenador_club_jugadorlibre_otro = $("#entrenador_club_jugadorlibre_otro").val();
        if( entrenador_club_jugadorlibre_otro != "" ) {
            if( entrenador_club_jugadorlibre_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(entrenador_club_jugadorlibre_otro.length) >= 1 && parseInt(entrenador_club_jugadorlibre_otro.length) <= 150 ) ) {
                $("#entrenador_club_jugadorlibre_otro").css("background-color", "white");
            } else {
                $("#entrenador_club_jugadorlibre_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#entrenador_club_jugadorlibre_otro").css("background-color", "white");
            // flag = false;
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#idclub_actual_jugadorenclub").is(":visible")) {
        // --------------- JUGADOR EN CLUB --------------- //
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let idclub_actual_jugadorenclub = $("#idclub_actual_jugadorenclub").val();
        if( idclub_actual_jugadorenclub == "" ) {
            $("#idclub_actual_jugadorenclub").css("background-color", "white");
            // flag = false;
        } else {
            $("#idclub_actual_jugadorenclub").css("background-color", "white");
        }           
    }

    // alert( $("#idclub_actual_jugadorenclub").val() + typeof( $("#idclub_actual_jugadorenclub").val() ) );
    // Datos del club actual (otro):

    // Aplicando validación solamente si el campo es visible:
    if($("#pais_club_jugadorenclub_otro").is(":visible")) {
        // Datos del club actual (otro):
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let pais_club_jugadorenclub_otro = $("#pais_club_jugadorenclub_otro").val();
        if( pais_club_jugadorenclub_otro == "" ) {
            $("#pais_club_jugadorenclub_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#pais_club_jugadorenclub_otro").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#division_club_jugadorenclub_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let division_club_jugadorenclub_otro = $("#division_club_jugadorenclub_otro").val();
        if( division_club_jugadorenclub_otro == "" ) {
            $("#division_club_jugadorenclub_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#division_club_jugadorenclub_otro").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#nombre_clubenclub_jugadorenclub_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let nombre_clubenclub_jugadorenclub_otro = $("#nombre_clubenclub_jugadorenclub_otro").val();
        if( nombre_clubenclub_jugadorenclub_otro != "" ) {
            if( nombre_clubenclub_jugadorenclub_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_clubenclub_jugadorenclub_otro.length) >= 1 && parseInt(nombre_clubenclub_jugadorenclub_otro.length) <= 150 ) ) {
                $("#nombre_clubenclub_jugadorenclub_otro").css("background-color", "white");
            } else {
                $("#nombre_clubenclub_jugadorenclub_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#nombre_clubenclub_jugadorenclub_otro").css("background-color", "white");
            // flag = false;
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#entrenador_club_jugadorenclub_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let entrenador_club_jugadorenclub_otro = $("#entrenador_club_jugadorenclub_otro").val();
        if( entrenador_club_jugadorenclub_otro != "" ) {
            if( entrenador_club_jugadorenclub_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(entrenador_club_jugadorenclub_otro.length) >= 1 && parseInt(entrenador_club_jugadorenclub_otro.length) <= 150 ) ) {
                $("#entrenador_club_jugadorenclub_otro").css("background-color", "white");
            } else {
                $("#entrenador_club_jugadorenclub_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#entrenador_club_jugadorenclub_otro").css("background-color", "white");
            // flag = false;
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#contrato_pro_jugadorclub").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let contrato_pro_jugadorclub = $("#contrato_pro_jugadorclub").val();
        if( contrato_pro_jugadorclub == "" ) {
            $("#contrato_pro_jugadorclub").css("background-color", "white");
            // flag = false;
        } else {
            $("#contrato_pro_jugadorclub").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#situ_clubactual_jugadorclub").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let situ_clubactual_jugadorclub = $("#situ_clubactual_jugadorclub").val();
        if( situ_clubactual_jugadorclub == "" ) {
            $("#situ_clubactual_jugadorclub").css("background-color", "white");
            // flag = false;
        } else {
            $("#situ_clubactual_jugadorclub").css("background-color", "white");
            // alert('godd');
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#fechafin_prestamo_jugadorclub").is(":visible")) {
        // Datos de jugador a préstamo:
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let fechafin_prestamo_jugadorclub = $("#fechafin_prestamo_jugadorclub").val();
        if( fechafin_prestamo_jugadorclub == "" ) {
            $("#fechafin_prestamo_jugadorclub").css("background-color", "white");
            // flag = false;
        } else {
            $("#fechafin_prestamo_jugadorclub").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#pase_pertenencia_jugadorclub").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let pase_pertenencia_jugadorclub = $("#pase_pertenencia_jugadorclub").val();
        if( pase_pertenencia_jugadorclub != "" ) {
            if( pase_pertenencia_jugadorclub.match(ER_caracteresAlfaNumericos) && ( parseInt(pase_pertenencia_jugadorclub.length) >= 1 && parseInt(pase_pertenencia_jugadorclub.length) <= 150 ) ) {
                $("#pase_pertenencia_jugadorclub").css("background-color", "white");
            } else {
                $("#pase_pertenencia_jugadorclub").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#pase_pertenencia_jugadorclub").css("background-color", "white");
            // flag = false;
        }
    }   

    // Aplicando validación solamente si el campo es visible:
    if($("#fechafin_contrato_jugadorclub").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let fechafin_contrato_jugadorclub = $("#fechafin_contrato_jugadorclub").val();
        if( fechafin_contrato_jugadorclub == "" ) {
            $("#fechafin_contrato_jugadorclub").css("background-color", "white");
            // flag = false;
        } else {
            $("#fechafin_contrato_jugadorclub").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#valor_mercado_jugadorclub").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let valor_mercado_jugadorclub = $("#valor_mercado_jugadorclub").val();
        if( valor_mercado_jugadorclub != "" ) {
            if( valor_mercado_jugadorclub.match(ER_numericosDecimales) && ( parseInt(valor_mercado_jugadorclub.length) >= 1 && parseInt(valor_mercado_jugadorclub.length) <= 10 ) ) {      
                $("#valor_mercado_jugadorclub").css("background-color", "white");
            } else {
                $("#valor_mercado_jugadorclub").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#valor_mercado_jugadorclub").css("background-color", "white");
            // flag = false;
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#clausula_salida_jugadorclub").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let clausula_salida_jugadorclub = $("#clausula_salida_jugadorclub").val();
        if( clausula_salida_jugadorclub == "" ) {
            $("#clausula_salida_jugadorclub").css("background-color", "white");
            // flag = false;
        } else {
            $("#clausula_salida_jugadorclub").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#valor_clausula_jugadorclub").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let valor_clausula_jugadorclub = $("#valor_clausula_jugadorclub").val();
        if( valor_clausula_jugadorclub != "" ) {
            if( valor_clausula_jugadorclub.match(ER_numericosDecimales) && ( parseInt(valor_clausula_jugadorclub.length) >= 1 && parseInt(valor_clausula_jugadorclub.length) <= 10 ) ) {      
                $("#valor_clausula_jugadorclub").css("background-color", "white");
            } else {
                $("#valor_clausula_jugadorclub").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#valor_clausula_jugadorclub").css("background-color", "white");
            // flag = false;
        }
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let observaciones_jugadorclub = $("#observaciones_jugadorclub").val();
    if( observaciones_jugadorclub != "" ) {
        if( observaciones_jugadorclub.match(ER_caracteresAlfaNumericos) && ( parseInt(observaciones_jugadorclub.length) >= 1 && parseInt(observaciones_jugadorclub.length) <= 150 ) ) {
            $("#observaciones_jugadorclub").css("background-color", "white");
        } else {
            $("#observaciones_jugadorclub").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#observaciones_jugadorclub").css("background-color", "white");
        // flag = false;
    }    
    
    // alert('Bandera:' + flag);
    
    if( flag === false ){
        $('#boton_agregar_ficha_jugador').prop("disabled", true);
    }else{
        $('#boton_agregar_ficha_jugador').prop("disabled", false);
        // alert("Formulario validado");
    }
    

}
// ------------------------------ Fin de la función 'chequear_datos_form_fichajugador()' ------------------------------ //

// ------------------------------ Inicio de la función 'calcular_minutos_jugados()' ------------------------------ //
function calcular_minutos_jugados() {

    // Valor del minuto de salida:
    let min_salida_jugadorpartido = parseInt( $("#min_salida_jugadorpartido").val() );
    // Valor del minuto de entrada:
    let min_entrada_jugadorpartido = parseInt( $("#min_entrada_jugadorpartido").val() );    
    // Diferencia (resta) entre el minuto de salida y el minuto de entrada:
    let min_total_jugados = min_salida_jugadorpartido - min_entrada_jugadorpartido;
    // alert(min_entrada_jugadorpartido);
    // -----------Validando los minutos de entrada ----------- //
    // Si es 0, vacío o menor a 0 la cantidad de minutos jugados será 0:
    if( /*min_entrada_jugadorpartido === 0 ||*/ min_entrada_jugadorpartido === "" || min_entrada_jugadorpartido < 0 ) {
        min_total_jugados = 0;
        // alert('Error 1');
    }
    // Si el minuto de entrada es mayor al de salida, la cantidad de minutos jugados será 0:
    if( min_entrada_jugadorpartido > min_salida_jugadorpartido ) {
        min_total_jugados = 0;
        // alert('Error 2');
    }

    // -----------Validando los minutos de salida ----------- //
    // Si es 0, vacío o menor a 0 la cantidad de minutos jugados será 0:
    if( /*min_salida_jugadorpartido === 0 ||*/ min_salida_jugadorpartido === "" || min_salida_jugadorpartido < 0 ) {
        min_total_jugados = 0;
        // alert('Error 3');
    }
    // Si el minuto de salida es menor al de entrada, la cantidad de minutos jugados será 0:
    if( min_salida_jugadorpartido < min_entrada_jugadorpartido ) {
        min_total_jugados = 0;
    }   


    if( min_total_jugados === 0 || min_total_jugados == "" || min_total_jugados < 0 ) {
        min_entrada_jugadorpartido = 0;
    }   


    if( Number.isNaN( min_total_jugados ) ) {
        min_total_jugados = 0;
    }
    if( min_total_jugados < 0 ) {
        min_total_jugados = 0;
    }

    // Agregando el valor del total de minutos jugados al campo '#min_jugados_jugadorpartido':
    $("#min_jugados_jugadorpartido_text").html( min_total_jugados + ' minutos' );

    $("#min_jugados_jugadorpartido").val( min_total_jugados );       

    chequear_datos_form_partidojugador(); // <---------------------- Validando   
}
// ------------------------------ Fin de la función 'calcular_minutos_jugados()' ------------------------------ //

// ------------------------------ Inicio de la función 'calcular_minutos_jugados_icsjp()' ------------------------------ //
function calcular_minutos_jugados_icsjp() {
    // Valor del minuto de salida:
    let min_salida_icsjp = parseInt( $("#min_salida_icsjp").val() );
    // Valor del minuto de entrada:
    let min_entrada_icsjp = parseInt( $("#min_entrada_icsjp").val() );    
    // Diferencia (resta) entre el minuto de salida y el minuto de entrada:
    let min_total_jugados = min_salida_icsjp - min_entrada_icsjp;

    // -----------Validando los minutos de entrada ----------- //
    // Si es 0, vacío o menor a 0 la cantidad de minutos jugados será 0:
    if( /*min_entrada_icsjp === 0 ||*/ min_entrada_icsjp === "" || min_entrada_icsjp < 0 ) {
        min_total_jugados = 0;
    }
    // Si el minuto de entrada es mayor al de salida, la cantidad de minutos jugados será 0:
    if( min_entrada_icsjp > min_salida_icsjp ) {
        min_total_jugados = 0;
    }

    // -----------Validando los minutos de salida ----------- //
    // Si es 0, vacío o menor a 0 la cantidad de minutos jugados será 0:
    if( /*min_salida_icsjp === 0 ||*/ min_salida_icsjp === "" || min_salida_icsjp < 0 ) {
        min_total_jugados = 0;
    }
    // Si el minuto de salida es menor al de entrada, la cantidad de minutos jugados será 0:
    if( min_salida_icsjp < min_entrada_icsjp ) {
        min_total_jugados = 0;
    }   


    if( min_total_jugados === 0 || min_total_jugados == "" || min_total_jugados < 0 ) {
        min_entrada_icsjp = 0;
    }   


    if( Number.isNaN( min_total_jugados ) ) {
        min_total_jugados = 0;
    }
    if( min_total_jugados < 0 ) {
        min_total_jugados = 0;
    }

    // Agregando el valor del total de minutos jugados al campo '#min_jugados_icsjp':
    $("#min_jugados_icsjp_text").html( min_total_jugados + ' minutos' );

    $("#min_jugados_icsjp").val( min_total_jugados );      

    chequear_datos_form_informe_icsj(); // <------------ Validando

}
// ------------------------------ Fin de la función 'calcular_minutos_jugados_icsjp()' ------------------------------ //

// ------------------------------ Inicio de la función 'chequear_datos_form_partidojugador()' ------------------------------ // 
function chequear_datos_form_partidojugador(){

    // alert('Estoy validando...');
    // var ER_numericosDecimales = /^([0-9]*|(\d+))(\.\d{1,2})?$/;
    var ER_numericosDecimales = /^([0-9]*|(\d+))((.|,)\d{1,})?$/;
    var ER_numericosEnteros = /[0-9]/;
    var ER_caracteresAlfaNumericos = /^[a-zA-ZáàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜñÑ 0-9,.-_¿?¡!$%#()]*$/;
    flag = true;
        
    /*
    #ffc6c6 <--- Color rosado.
    #d4ffdc <--- Color verde.
    */
        
    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let fecha_jugadorpartido = $("#fecha_jugadorpartido").val();
    if( fecha_jugadorpartido == "" ) {
        $("#fecha_jugadorpartido").css("background-color", "white");
        // flag = false;
    } else {
        $("#fecha_jugadorpartido").css("background-color", "white");
    }  

    // ------------------------------------------------------------------------ //
    // Campeonato:
    // OBLIGATORIO
    let idcampeonato = $("#idcampeonato").val();
    if( idcampeonato == "" ) {
        $("#idcampeonato").css("background-color", "white");
        // flag = false;
    } else {
        $("#idcampeonato").css("background-color", "white");
    }       
 
    // Datos del campeonato (otro):
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("#pais_campeonato_otro").is(":visible")) {
        // alert("El campo es visible.");
        // OBLIGATORIO
        let pais_campeonato_otro = $("#pais_campeonato_otro").val();
        if( pais_campeonato_otro == "" ) {
            $("#pais_campeonato_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#pais_campeonato_otro").css("background-color", "white");
        }   
    } 
    
    // Aplicando validación solamente si el campo es visible:
    if($("#division_campeonato_otro").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let division_campeonato_otro = $("#division_campeonato_otro").val();
        if( division_campeonato_otro == "" ) {
            $("#division_campeonato_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#division_campeonato_otro").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#nombre_campeonato_otro").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let nombre_campeonato_otro = $("#nombre_campeonato_otro").val();
        if( nombre_campeonato_otro != "" ) {
            if( nombre_campeonato_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_campeonato_otro.length) >= 1 && parseInt(nombre_campeonato_otro.length) <= 150 ) ) {
                $("#nombre_campeonato_otro").css("background-color", "white");
            } else {
                $("#nombre_campeonato_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#nombre_campeonato_otro").css("background-color", "white");
            // flag = false;
        }
    }    

    // Aplicando validación solamente si el campo es visible:
    if($("#organizador_campeonato_otro").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let organizador_campeonato_otro = $("#organizador_campeonato_otro").val();
        if( organizador_campeonato_otro != "" ) {
            if( organizador_campeonato_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(organizador_campeonato_otro.length) >= 1 && parseInt(organizador_campeonato_otro.length) <= 150 ) ) {
                $("#organizador_campeonato_otro").css("background-color", "white");
            } else {
                $("#organizador_campeonato_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#organizador_campeonato_otro").css("background-color", "white");
            // flag = false;
        }       
    }    

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let jornada_jugadorpartido = $("#jornada_jugadorpartido").val();
    if( jornada_jugadorpartido != "" ) {
        if( jornada_jugadorpartido.match(ER_caracteresAlfaNumericos) && ( parseInt(jornada_jugadorpartido.length) >= 1 && parseInt(jornada_jugadorpartido.length) <= 150 ) ) {
            $("#jornada_jugadorpartido").css("background-color", "white");
        } else {
            $("#jornada_jugadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#jornada_jugadorpartido").css("background-color", "white");
        // flag = false;
    }     

    // Club rival:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let idclub_rival = $("#idclub_rival").val();
    if( idclub_rival == "" ) {
        $("#idclub_rival").css("background-color", "white");
        // flag = false;
    } else {
        $("#idclub_rival").css("background-color", "white");
    }   

    // Datos del club rival (otro):

    // Aplicando validación solamente si el campo es visible:
    if($("#pais_club_rival_otro").is(":visible")) {
        // Datos del club actual (otro):
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let pais_club_rival_otro = $("#pais_club_rival_otro").val();
        if( pais_club_rival_otro == "" ) {
            $("#pais_club_rival_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#pais_club_rival_otro").css("background-color", "white");
        }       
    }   

    // Aplicando validación solamente si el campo es visible:
    if($("#division_club_rival_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let division_club_rival_otro = $("#division_club_rival_otro").val();
        if( division_club_rival_otro == "" ) {
            $("#division_club_rival_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#division_club_rival_otro").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#nombre_club_rival_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let nombre_club_rival_otro = $("#nombre_club_rival_otro").val();
        if( nombre_club_rival_otro != "" ) {
            if( nombre_club_rival_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_club_rival_otro.length) >= 1 && parseInt(nombre_club_rival_otro.length) <= 150 ) ) {
                $("#nombre_club_rival_otro").css("background-color", "white");
            } else {
                $("#nombre_club_rival_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#nombre_club_rival_otro").css("background-color", "white");
            // flag = false;
        }       
    }    

    // Aplicando validación solamente si el campo es visible:
    if($("#entrenador_club_rival_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let entrenador_club_rival_otro = $("#entrenador_club_rival_otro").val();
        if( entrenador_club_rival_otro != "" ) {
            if( entrenador_club_rival_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(entrenador_club_rival_otro.length) >= 1 && parseInt(entrenador_club_rival_otro.length) <= 150 ) ) {
                $("#entrenador_club_rival_otro").css("background-color", "white");
            } else {
                $("#entrenador_club_rival_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#entrenador_club_rival_otro").css("background-color", "white");
            // flag = false;
        }       
    }    

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let posicion_jugadorpartido = $("#posicion_jugadorpartido").val();
    if( posicion_jugadorpartido == "" ) {
        $("#posicion_jugadorpartido").css("background-color", "white");
        // flag = false;
    } else {
        $("#posicion_jugadorpartido").css("background-color", "white");
    }

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let tit_sup_nc_jugadorpartido = $("#tit_sup_nc_jugadorpartido").val();
    if( tit_sup_nc_jugadorpartido == "" ) {
        $("#tit_sup_nc_jugadorpartido").css("background-color", "white");
        // flag = false;
    } else {
        $("#tit_sup_nc_jugadorpartido").css("background-color", "white");
    }    

    // Condición del equipo en el partido:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    if( $("input:radio[name='condicion_jugadorpartido']:checked").length === 0 ) {
        // flag = false;
    } 

    // Datos de goles del partido:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let gol_equipo1_jugadorpartido = $("#gol_equipo1_jugadorpartido").val();
    if( gol_equipo1_jugadorpartido != "" ) {
        if( gol_equipo1_jugadorpartido.match(ER_numericosEnteros) && ( parseInt(gol_equipo1_jugadorpartido.length) >= 1 && parseInt(gol_equipo1_jugadorpartido.length) <= 2 ) ) {      
            $("#gol_equipo1_jugadorpartido").css("background-color", "white");
        } else {
            $("#gol_equipo1_jugadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#gol_equipo1_jugadorpartido").css("background-color", "white");
        // flag = false;
    } 

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let gol_equipo2_jugadorpartido = $("#gol_equipo2_jugadorpartido").val();
    if( gol_equipo2_jugadorpartido != "" ) {
        if( gol_equipo2_jugadorpartido.match(ER_numericosEnteros) && ( parseInt(gol_equipo2_jugadorpartido.length) >= 1 && parseInt(gol_equipo2_jugadorpartido.length) <= 2 ) ) {      
            $("#gol_equipo2_jugadorpartido").css("background-color", "white");
        } else {
            $("#gol_equipo2_jugadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#gol_equipo2_jugadorpartido").css("background-color", "white");
        // flag = false;
    }       

    // Datos del jugador con respecto a tarjetas, goles y minutos:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let t_amarilla_jugadorpartido = $("#t_amarilla_jugadorpartido").val();
    if( t_amarilla_jugadorpartido != "" ) {
        if( t_amarilla_jugadorpartido.match(ER_numericosEnteros) && parseInt(t_amarilla_jugadorpartido.length) === 1 ) {      
            $("#t_amarilla_jugadorpartido").css("background-color", "white");
        } else {
            $("#t_amarilla_jugadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#t_amarilla_jugadorpartido").css("background-color", "white");
        // flag = false;
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //  
    let t_amarilladb_jugadorpartido = $("#t_amarilladb_jugadorpartido").val();
    if( t_amarilladb_jugadorpartido != "" ) {
        if( t_amarilladb_jugadorpartido.match(ER_numericosEnteros) && parseInt(t_amarilladb_jugadorpartido.length) === 1 ) {      
            $("#t_amarilladb_jugadorpartido").css("background-color", "white");
        } else {
            $("#t_amarilladb_jugadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#t_amarilladb_jugadorpartido").css("background-color", "white");
        // flag = false;
    }   

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let t_roja_jugadorpartido = $("#t_roja_jugadorpartido").val();
    if( t_roja_jugadorpartido != "" ) {
        if( t_roja_jugadorpartido.match(ER_numericosEnteros) && parseInt(t_roja_jugadorpartido.length) === 1 ) {      
            $("#t_roja_jugadorpartido").css("background-color", "white");
        } else {
            $("#t_roja_jugadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#t_roja_jugadorpartido").css("background-color", "white");
        // flag = false;
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let num_gol_jugadorpartido = $("#num_gol_jugadorpartido").val();
    if( num_gol_jugadorpartido != "" ) {
        if( num_gol_jugadorpartido.match(ER_numericosEnteros) && ( parseInt(num_gol_jugadorpartido.length) >= 1 && parseInt(num_gol_jugadorpartido.length) <= 2 ) ) {      
            $("#num_gol_jugadorpartido").css("background-color", "white");
        } else {
            $("#num_gol_jugadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#num_gol_jugadorpartido").css("background-color", "white");
        // flag = false;
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let min_entrada_jugadorpartido = $("#min_entrada_jugadorpartido").val();
    // Validando que no esté vacío:
    if( min_entrada_jugadorpartido != "" ) {
        // Validando que sea un número entero y que la longitud sea entre 1 y 3.
        if( min_entrada_jugadorpartido.match(ER_numericosEnteros) && ( parseInt(min_entrada_jugadorpartido.length) >= 1 && parseInt(min_entrada_jugadorpartido.length) <= 3 ) ) {      

            // Validando que el minuto de entrada sea menor al minuto de salida:
            // Valor del minuto de salida.
            let min_salida_jugadorpartido = $("#min_salida_jugadorpartido").val();
            
            // Convirtiendo tipo de dato a entero:
            min_entrada_jugadorpartido = parseInt( min_entrada_jugadorpartido );
            min_salida_jugadorpartido = parseInt( min_salida_jugadorpartido );

            if( min_entrada_jugadorpartido < min_salida_jugadorpartido ) {
                $("#min_entrada_jugadorpartido").css({
                    "background-color": "white",
                    "color": "black",
                });
            } else {
                $("#min_entrada_jugadorpartido").css("background-color", "white");
                // flag = false;   
                // alert('Error 1');            
            }

        } else {
            $("#min_entrada_jugadorpartido").css("background-color", "white");
            flag = false;
            // alert('Error 2');
        }
    } else {
        $("#min_entrada_jugadorpartido").css("background-color", "white");
        // flag = false;
        // alert('Error 3');
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let min_salida_jugadorpartido = $("#min_salida_jugadorpartido").val();
    // Validando que no esté vacío:
    if( min_salida_jugadorpartido != "" ) {
        // Validando que sea un número entero y que la longitud sea entre 1 y 3.
        if( min_salida_jugadorpartido.match(ER_numericosEnteros) && ( parseInt(min_salida_jugadorpartido.length) >= 1 && parseInt(min_salida_jugadorpartido.length) <= 2 ) ) {

            // Validando que el minuto de salida sea mayor al minuto de entrada:
            // Valor del minuto de entrada.

            let min_entrada_jugadorpartido = $("#min_entrada_jugadorpartido").val();

            // Convirtiendo tipo de dato a entero:
            min_entrada_jugadorpartido = parseInt( min_entrada_jugadorpartido );
            min_salida_jugadorpartido = parseInt( min_salida_jugadorpartido );
            
            if( min_salida_jugadorpartido > min_entrada_jugadorpartido ) {
                $("#min_salida_jugadorpartido").css("background-color", "white");
            } else {
                $("#min_salida_jugadorpartido").css("background-color", "white");
                // flag = false;               
                // alert('Error 4');
            }           
        
        } else {
            $("#min_salida_jugadorpartido").css("background-color", "white");
            flag = false;
            // alert('Error 5');
        }
    } else {
        $("#min_salida_jugadorpartido").css("background-color", "white");
        // flag = false;
        // alert('Error 6');
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let min_jugados_jugadorpartido = $("#min_jugados_jugadorpartido").val();
    // Validando que no esté vacío:
    if( min_jugados_jugadorpartido != "" ) {
        // Validando que sea un número entero y que la longitud sea entre 1 y 3.
        if( min_jugados_jugadorpartido.match(ER_numericosEnteros) && ( parseInt(min_jugados_jugadorpartido.length) >= 1 && parseInt(min_jugados_jugadorpartido.length) <= 3 ) ) {      

            // Validando que la cantidad de minutos jugados sea el resultado de la diferencia (resta) entre el minuto de salida y el minuto de entrada:
            // Valor del minuto de salida:
            let min_salida_jugadorpartido = parseInt( $("#min_salida_jugadorpartido").val() );
            // Valor del minuto de entrada:
            let min_entrada_jugadorpartido = parseInt( $("#min_entrada_jugadorpartido").val() );                        

            // Diferencia (resta) entre el minuto de salida y el minuto de entrada:
            let min_total_jugados = min_salida_jugadorpartido - min_entrada_jugadorpartido;

            // alert( min_jugados_jugadorpartido + ' - ' + min_total_jugados )

            // min_jugados_jugadorpartido <--- Valor del input:
            min_jugados_jugadorpartido = parseInt( min_jugados_jugadorpartido ); // <--- Hay que convertirlo en número entero para ejecutar correctamente la comparación.
            if( min_jugados_jugadorpartido === min_total_jugados ) {
                $("#min_jugados_jugadorpartido").css("background-color", "white");
            } else {
                $("#min_jugados_jugadorpartido").css("background-color", "white");
                // flag = false;   
                // alert('Error 7');            
            }

        } else {
            $("#min_jugados_jugadorpartido").css("background-color", "white");
            flag = false;
            // alert('Error 8');
        }
    } else {
        $("#min_jugados_jugadorpartido").css("background-color", "white");
        // flag = false;
        // alert('Error 9');
    }           

    // alert('Bandera:' + flag);
    
    if( flag === false ){
        $('#boton-agregar-partido').prop("disabled", true);
        $('#boton-agregar-partido').removeClass('boton-agregar-partido-enabled');
        $('#boton-agregar-partido').addClass('boton-agregar-partido-disabled');
    }else{
        $('#boton-agregar-partido').prop("disabled", false);
        $('#boton-agregar-partido').removeClass('boton-agregar-partido-disabled');
        $('#boton-agregar-partido').addClass('boton-agregar-partido-enabled');
    }
    

}
// ------------------------------ Fin de la función 'chequear_datos_form_partidojugador()' ------------------------------ //

// ******************************************************************************************************************************************************************************************************************************************* FIN DE FUNCIONES EN COMÚN CON EL MÓDULO 'BÚSQUEDA SCOUTING' ******************************************************************************************************************************************************************************************************************************************* //

// ---------------------------------------------------------------------------------------------------------------------------------------- //

// ******************************************************************************************************************************************************************************************************************************************* INICIO DE FUNCIONES DEL MÓDULO 'CENTRO DE SCOUTING' ******************************************************************************************************************************************************************************************************************************************* //
// ------------------------------ Inicio de la función 'chequear_datos_form_entrenador()' ------------------------------ // 
function chequear_datos_form_entrenador(){
    // alert('Estoy validando...');
    // var ER_numericosDecimales = /^([0-9]*|(\d+))(\.\d{1,2})?$/;
    var ER_numericosDecimales = /^([0-9]*|(\d+))((.|,)\d{1,})?$/;
    var ER_numericosEnteros = /[0-9]/;
    var ER_caracteresAlfaNumericos = /^[a-zA-ZáàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜñÑ 0-9,.-_¿?¡!$%#()]*$/;
    flag = true;
        
    /*
    #ffc6c6 <--- Color rosado.
    #d4ffdc <--- Color verde.
    */

    // ---------------------- Datos 'entrenador' ---------------------- //

    // ------------------------------------------------------------------------ //
    let foto_entrenador = $("#foto_entrenador").val();
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if( foto_entrenador != "" ) {
        if( !allowedExtensions.exec(foto_entrenador) ) {      
            // alert('Formato inválido para foto');
            flag = false;
        } else {
            // alert('Formato correcto para foto');
        }
    } else {
        // flag = false;
    }
        
    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let nombre_entrenador = $("#nombre_entrenador").val();
    if( nombre_entrenador != "" ) {
        if( nombre_entrenador.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_entrenador.length) >= 1 && parseInt(nombre_entrenador.length) <= 150 ) ) {      
            $("#nombre_entrenador").css("background-color", "white");
        } else {
            $("#nombre_entrenador").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#nombre_entrenador").css("background-color", "white");
        flag = false;
    }

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let apellido1_entrenador = $("#apellido1_entrenador").val();
    if( apellido1_entrenador != "" ) {
        if( apellido1_entrenador.match(ER_caracteresAlfaNumericos) && ( parseInt(apellido1_entrenador.length) >= 1 && parseInt(apellido1_entrenador.length) <= 150 ) ) {      
            $("#apellido1_entrenador").css("background-color", "white");
        } else {
            $("#apellido1_entrenador").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#apellido1_entrenador").css("background-color", "white");
        flag = false;
    }

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let apellido2_entrenador = $("#apellido2_entrenador").val();
    if( apellido2_entrenador != "" ) {
        if( apellido2_entrenador.match(ER_caracteresAlfaNumericos) && ( parseInt(apellido2_entrenador.length) >= 1 && parseInt(apellido2_entrenador.length) <= 150 ) ) {      
            $("#apellido2_entrenador").css("background-color", "white");
        } else {
            $("#apellido2_entrenador").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#apellido2_entrenador").css("background-color", "white");
        // flag = false;
    }   

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let fecha_nacimiento_entrenador = $("#fecha_nacimiento_entrenador").val();
    if( fecha_nacimiento_entrenador == "" ) {
        $("#fecha_nacimiento_entrenador").css("background-color", "white");
        // flag = false;
    } else {
        $("#fecha_nacimiento_entrenador").css("background-color", "white");
    }
         
    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let nacionalidad_entrenador = $("#nacionalidad_entrenador").val();
    if( nacionalidad_entrenador == "" ) {
        $("#nacionalidad_entrenador").css("background-color", "white");
        // flag = false;
    } else {
        $("#nacionalidad_entrenador").css("background-color", "white");
    }


    // ---------------------- Datos 'entrenador_club' ---------------------- //

    // Aplicando validación solamente si el campo es visible:
    if($("#representante_entrenadorclub").is(":visible")) {
        // ------------------------------------------------------------------------ //
        let representante_entrenadorclub = $("#representante_entrenadorclub").val();
        if( representante_entrenadorclub != "" ) {
            if( representante_entrenadorclub.match(ER_caracteresAlfaNumericos) && ( parseInt(representante_entrenadorclub.length) >= 1 && parseInt(representante_entrenadorclub.length) <= 150 ) ) {
                $("#representante_entrenadorclub").css("background-color", "white");
            } else {
                $("#representante_entrenadorclub").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#representante_entrenadorclub").css("background-color", "white");
            // flag = false;
        }
    }   

    // Aplicando validación solamente si el campo es visible:
    if($("#idclub_actual_entrenador").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let idclub_actual_entrenador = $("#idclub_actual_entrenador").val();
        if( idclub_actual_entrenador == "" ) {
            $("#idclub_actual_entrenador").css("background-color", "white");
            // flag = false;
        } else {
            $("#idclub_actual_entrenador").css("background-color", "white");
        }           
    }

    // --------------- Datos del club del entrenador (en caso de seleccionar 'Otro') --------------- //
    
    // Aplicando validación solamente si el campo es visible:
    if($("#pais_club_entrenador_otro").is(":visible")) {
        // Datos del club actual (otro):
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let pais_club_entrenador_otro = $("#pais_club_entrenador_otro").val();
        if( pais_club_entrenador_otro == "" ) {
            $("#pais_club_entrenador_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#pais_club_entrenador_otro").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#division_club_entrenador_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let division_club_entrenador_otro = $("#division_club_entrenador_otro").val();
        if( division_club_entrenador_otro == "" ) {
            $("#division_club_entrenador_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#division_club_entrenador_otro").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#nombre_club_entrenador_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let nombre_club_entrenador_otro = $("#nombre_club_entrenador_otro").val();
        if( nombre_club_entrenador_otro != "" ) {
            if( nombre_club_entrenador_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_club_entrenador_otro.length) >= 1 && parseInt(nombre_club_entrenador_otro.length) <= 150 ) ) {
                $("#nombre_club_entrenador_otro").css("background-color", "white");
            } else {
                $("#nombre_club_entrenador_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#nombre_club_entrenador_otro").css("background-color", "white");
            // flag = false;
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#entrenador_club_entrenador_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let entrenador_club_entrenador_otro = $("#entrenador_club_entrenador_otro").val();
        if( entrenador_club_entrenador_otro != "" ) {
            if( entrenador_club_entrenador_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(entrenador_club_entrenador_otro.length) >= 1 && parseInt(entrenador_club_entrenador_otro.length) <= 150 ) ) {
                $("#entrenador_club_entrenador_otro").css("background-color", "white");
            } else {
                $("#entrenador_club_entrenador_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#entrenador_club_entrenador_otro").css("background-color", "white");
            // flag = false;
        }       
    }


    // Aplicando validación solamente si el campo es visible:
    if($("#fechafin_contrato_entrenadorclub").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let fechafin_contrato_entrenadorclub = $("#fechafin_contrato_entrenadorclub").val();
        if( fechafin_contrato_entrenadorclub == "" ) {
            $("#fechafin_contrato_entrenadorclub").css("background-color", "white");
            // flag = false;
        } else {
            $("#fechafin_contrato_entrenadorclub").css("background-color", "white");
        }       
    }


    // Aplicando validación solamente si el campo es visible:
    if($("#clausula_salida_entrenadorclub").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let clausula_salida_entrenadorclub = $("#clausula_salida_entrenadorclub").val();
        if( clausula_salida_entrenadorclub == "" ) {
            $("#clausula_salida_entrenadorclub").css("background-color", "white");
            // flag = false;
        } else {
            $("#clausula_salida_entrenadorclub").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#valor_clausula_entrenadorclub").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let valor_clausula_entrenadorclub = $("#valor_clausula_entrenadorclub").val();
        if( valor_clausula_entrenadorclub != "" ) {
            if( valor_clausula_entrenadorclub.match(ER_numericosDecimales) && ( parseInt(valor_clausula_entrenadorclub.length) >= 1 && parseInt(valor_clausula_entrenadorclub.length) <= 10 ) ) {      
                $("#valor_clausula_entrenadorclub").css("background-color", "white");
            } else {
                $("#valor_clausula_entrenadorclub").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#valor_clausula_entrenadorclub").css("background-color", "white");
            // flag = false;
        }
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let observaciones_entrenadorclub = $("#observaciones_entrenadorclub").val();
    if( observaciones_entrenadorclub != "" ) {
        if( observaciones_entrenadorclub.match(ER_caracteresAlfaNumericos) && ( parseInt(observaciones_entrenadorclub.length) >= 1 && parseInt(observaciones_entrenadorclub.length) <= 150 ) ) {
            $("#observaciones_entrenadorclub").css("background-color", "white");
        } else {
            $("#observaciones_entrenadorclub").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#observaciones_entrenadorclub").css("background-color", "white");
        // flag = false;
    }    
    
    // alert('Bandera:' + flag);
    
    if( flag === false ){
        $('#boton_agregar_entrenador').prop("disabled", true);
    }else{
        $('#boton_agregar_entrenador').prop("disabled", false);
        // alert("Formulario validado");
    }
    

}
// ------------------------------ Fin de la función 'chequear_datos_form_entrenador()' ------------------------------ //

// ------------------------------ Inicio de la función 'chequear_datos_form_partidoentrenador()' ------------------------------ // 
function chequear_datos_form_partidoentrenador(){
    // alert('Estoy validando...');
    // var ER_numericosDecimales = /^([0-9]*|(\d+))(\.\d{1,2})?$/;
    var ER_numericosDecimales = /^([0-9]*|(\d+))((.|,)\d{1,})?$/;
    var ER_numericosEnteros = /[0-9]/;
    var ER_caracteresAlfaNumericos = /^[a-zA-ZáàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜñÑ 0-9,.-_¿?¡!$%#()]*$/;
    flag = true;
        
    /*
    #ffc6c6 <--- Color rosado.
    #d4ffdc <--- Color verde.
    */
        
    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let fecha_entrenadorpartido = $("#fecha_entrenadorpartido").val();
    if( fecha_entrenadorpartido == "" ) {
        $("#fecha_entrenadorpartido").css("background-color", "white");
        // flag = false;
    } else {
        $("#fecha_entrenadorpartido").css("background-color", "white");
    }  

    // ------------------------------------------------------------------------ //
    // Campeonato:
    // OBLIGATORIO
    let idcampeonato_entrenador = $("#idcampeonato_entrenador").val();
    if( idcampeonato_entrenador == "" ) {
        $("#idcampeonato_entrenador").css("background-color", "white");
        // flag = false;
    } else {
        $("#idcampeonato_entrenador").css("background-color", "white");
    }       
 
    // Datos del campeonato (otro):
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("#pais_campeonato_entrenador_otro").is(":visible")) {
        // alert("El campo es visible.");
        // OBLIGATORIO
        let pais_campeonato_entrenador_otro = $("#pais_campeonato_entrenador_otro").val();
        if( pais_campeonato_entrenador_otro == "" ) {
            $("#pais_campeonato_entrenador_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#pais_campeonato_entrenador_otro").css("background-color", "white");
        }   
    } 
    
    // Aplicando validación solamente si el campo es visible:
    if($("#division_campeonato_entrenador_otro").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let division_campeonato_entrenador_otro = $("#division_campeonato_entrenador_otro").val();
        if( division_campeonato_entrenador_otro == "" ) {
            $("#division_campeonato_entrenador_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#division_campeonato_entrenador_otro").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#nombre_campeonato_entrenador_otro").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let nombre_campeonato_entrenador_otro = $("#nombre_campeonato_entrenador_otro").val();
        if( nombre_campeonato_entrenador_otro != "" ) {
            if( nombre_campeonato_entrenador_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_campeonato_entrenador_otro.length) >= 1 && parseInt(nombre_campeonato_entrenador_otro.length) <= 150 ) ) {
                $("#nombre_campeonato_entrenador_otro").css("background-color", "white");
            } else {
                $("#nombre_campeonato_entrenador_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#nombre_campeonato_entrenador_otro").css("background-color", "white");
            // flag = false;
        }
    }    

    // Aplicando validación solamente si el campo es visible:
    if($("#organizador_campeonato_entrenador_otro").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let organizador_campeonato_entrenador_otro = $("#organizador_campeonato_entrenador_otro").val();
        if( organizador_campeonato_entrenador_otro != "" ) {
            if( organizador_campeonato_entrenador_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(organizador_campeonato_entrenador_otro.length) >= 1 && parseInt(organizador_campeonato_entrenador_otro.length) <= 150 ) ) {
                $("#organizador_campeonato_entrenador_otro").css("background-color", "white");
            } else {
                $("#organizador_campeonato_entrenador_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#organizador_campeonato_entrenador_otro").css("background-color", "white");
            // flag = false;
        }       
    }    

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let temporada_entrenadorpartido = $("#temporada_entrenadorpartido").val();
    if( temporada_entrenadorpartido != "" ) {
        if( temporada_entrenadorpartido.match(ER_caracteresAlfaNumericos) && ( parseInt(temporada_entrenadorpartido.length) >= 1 && parseInt(temporada_entrenadorpartido.length) <= 150 ) ) {
            $("#temporada_entrenadorpartido").css("background-color", "white");
        } else {
            $("#temporada_entrenadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#temporada_entrenadorpartido").css("background-color", "white");
        // flag = false;
    }

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let md_entrenadorpartido = $("#md_entrenadorpartido").val();
    if( md_entrenadorpartido != "" ) {
        if( md_entrenadorpartido.match(ER_caracteresAlfaNumericos) && ( parseInt(md_entrenadorpartido.length) >= 1 && parseInt(md_entrenadorpartido.length) <= 150 ) ) {
            $("#md_entrenadorpartido").css("background-color", "white");
        } else {
            $("#md_entrenadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#md_entrenadorpartido").css("background-color", "white");
        // flag = false;
    } 

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let jornada_entrenadorpartido = $("#jornada_entrenadorpartido").val();
    if( jornada_entrenadorpartido != "" ) {
        if( jornada_entrenadorpartido.match(ER_caracteresAlfaNumericos) && ( parseInt(jornada_entrenadorpartido.length) >= 1 && parseInt(jornada_entrenadorpartido.length) <= 150 ) ) {
            $("#jornada_entrenadorpartido").css("background-color", "white");
        } else {
            $("#jornada_entrenadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#jornada_entrenadorpartido").css("background-color", "white");
        // flag = false;
    }     

    // Club rival:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let idclub_rival_entrenador = $("#idclub_rival_entrenador").val();
    if( idclub_rival_entrenador == "" ) {
        $("#idclub_rival_entrenador").css("background-color", "white");
        // flag = false;
    } else {
        $("#idclub_rival_entrenador").css("background-color", "white");
    }   

    // Datos del club rival (otro):

    // Aplicando validación solamente si el campo es visible:
    if($("#pais_club_rival_entrenador_otro").is(":visible")) {
        // Datos del club actual (otro):
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let pais_club_rival_entrenador_otro = $("#pais_club_rival_entrenador_otro").val();
        if( pais_club_rival_entrenador_otro == "" ) {
            $("#pais_club_rival_entrenador_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#pais_club_rival_entrenador_otro").css("background-color", "white");
        }       
    }   

    // Aplicando validación solamente si el campo es visible:
    if($("#division_club_rival_entrenador_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let division_club_rival_entrenador_otro = $("#division_club_rival_entrenador_otro").val();
        if( division_club_rival_entrenador_otro == "" ) {
            $("#division_club_rival_entrenador_otro").css("background-color", "white");
            // flag = false;
        } else {
            $("#division_club_rival_entrenador_otro").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#nombre_club_rival_entrenador_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let nombre_club_rival_entrenador_otro = $("#nombre_club_rival_entrenador_otro").val();
        if( nombre_club_rival_entrenador_otro != "" ) {
            if( nombre_club_rival_entrenador_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_club_rival_entrenador_otro.length) >= 1 && parseInt(nombre_club_rival_entrenador_otro.length) <= 150 ) ) {
                $("#nombre_club_rival_entrenador_otro").css("background-color", "white");
            } else {
                $("#nombre_club_rival_entrenador_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#nombre_club_rival_entrenador_otro").css("background-color", "white");
            // flag = false;
        }       
    }    

    // Aplicando validación solamente si el campo es visible:
    if($("#entrenador_club_rival_entrenador_otro").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let entrenador_club_rival_entrenador_otro = $("#entrenador_club_rival_entrenador_otro").val();
        if( entrenador_club_rival_entrenador_otro != "" ) {
            if( entrenador_club_rival_entrenador_otro.match(ER_caracteresAlfaNumericos) && ( parseInt(entrenador_club_rival_entrenador_otro.length) >= 1 && parseInt(entrenador_club_rival_entrenador_otro.length) <= 150 ) ) {
                $("#entrenador_club_rival_entrenador_otro").css("background-color", "white");
            } else {
                $("#entrenador_club_rival_entrenador_otro").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#entrenador_club_rival_entrenador_otro").css("background-color", "white");
            // flag = false;
        }       
    }    

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let tactica_entrenadorpartido = $("#tactica_entrenadorpartido").val();
    if( tactica_entrenadorpartido != "" ) {
        if( tactica_entrenadorpartido.match(ER_caracteresAlfaNumericos) && ( parseInt(tactica_entrenadorpartido.length) >= 1 && parseInt(tactica_entrenadorpartido.length) <= 150 ) ) {
            $("#tactica_entrenadorpartido").css("background-color", "white");
        } else {
            $("#tactica_entrenadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#tactica_entrenadorpartido").css("background-color", "white");
        // flag = false;
    } 

    // Condición del equipo en el partido (Equipo 1):
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    if( $("input:radio[name='cond_equipo1_entrenadorpartido']:checked").length === 0 ) {
        // flag = false;
    }

    // Condición del equipo en el partido (Equipo 2):
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    if( $("input:radio[name='cond_equipo2_entrenadorpartido']:checked").length === 0 ) {
        // flag = false;
    }     

    // Datos de goles del partido:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let gol_equipo1_entrenadorpartido = $("#gol_equipo1_entrenadorpartido").val();
    if( gol_equipo1_entrenadorpartido != "" ) {
        if( gol_equipo1_entrenadorpartido.match(ER_numericosEnteros) && ( parseInt(gol_equipo1_entrenadorpartido.length) >= 1 && parseInt(gol_equipo1_entrenadorpartido.length) <= 2 ) ) {      
            $("#gol_equipo1_entrenadorpartido").css("background-color", "white");
        } else {
            $("#gol_equipo1_entrenadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#gol_equipo1_entrenadorpartido").css("background-color", "white");
        // flag = false;
    } 

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let gol_equipo2_entrenadorpartido = $("#gol_equipo2_entrenadorpartido").val();
    if( gol_equipo2_entrenadorpartido != "" ) {
        if( gol_equipo2_entrenadorpartido.match(ER_numericosEnteros) && ( parseInt(gol_equipo2_entrenadorpartido.length) >= 1 && parseInt(gol_equipo2_entrenadorpartido.length) <= 2 ) ) {      
            $("#gol_equipo2_entrenadorpartido").css("background-color", "white");
        } else {
            $("#gol_equipo2_entrenadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#gol_equipo2_entrenadorpartido").css("background-color", "white");
        // flag = false;
    }       

    // Datos del jugador con respecto a tarjetas, goles y minutos:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let t_amarilla_entrenadorpartido = $("#t_amarilla_entrenadorpartido").val();
    if( t_amarilla_entrenadorpartido != "" ) {
        if( t_amarilla_entrenadorpartido.match(ER_numericosEnteros) && parseInt(t_amarilla_entrenadorpartido.length) === 1 ) {      
            $("#t_amarilla_entrenadorpartido").css("background-color", "white");
        } else {
            $("#t_amarilla_entrenadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#t_amarilla_entrenadorpartido").css("background-color", "white");
        // flag = false;
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //  
    let t_amarilladb_entrenadorpartido = $("#t_amarilladb_entrenadorpartido").val();
    if( t_amarilladb_entrenadorpartido != "" ) {
        if( t_amarilladb_entrenadorpartido.match(ER_numericosEnteros) && parseInt(t_amarilladb_entrenadorpartido.length) === 1 ) {      
            $("#t_amarilladb_entrenadorpartido").css("background-color", "white");
        } else {
            $("#t_amarilladb_entrenadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#t_amarilladb_entrenadorpartido").css("background-color", "white");
        // flag = false;
    }   

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let t_roja_entrenadorpartido = $("#t_roja_entrenadorpartido").val();
    if( t_roja_entrenadorpartido != "" ) {
        if( t_roja_entrenadorpartido.match(ER_numericosEnteros) && parseInt(t_roja_entrenadorpartido.length) === 1 ) {      
            $("#t_roja_entrenadorpartido").css("background-color", "white");
        } else {
            $("#t_roja_entrenadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#t_roja_entrenadorpartido").css("background-color", "white");
        // flag = false;
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    let min_jugados_entrenadorpartido = $("#min_jugados_entrenadorpartido").val();
    if( min_jugados_entrenadorpartido != "" ) {
        if( min_jugados_entrenadorpartido.match(ER_numericosEnteros) && ( parseInt(min_jugados_entrenadorpartido.length) >= 1 && parseInt(min_jugados_entrenadorpartido.length) <= 3 ) ) {      
            $("#min_jugados_entrenadorpartido").css("background-color", "white");
        } else {
            $("#min_jugados_entrenadorpartido").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#min_jugados_entrenadorpartido").css("background-color", "white");
        // flag = false;
    }
         

    // alert('Bandera:' + flag);
    
    if( flag === false ){
        $('#boton-agregar-partido-entrenador').prop("disabled", true);
        $('#boton-agregar-partido-entrenador').removeClass('boton-agregar-partido-enabled');
        $('#boton-agregar-partido-entrenador').addClass('boton-agregar-partido-disabled');
    }else{
        $('#boton-agregar-partido-entrenador').prop("disabled", false);
        $('#boton-agregar-partido-entrenador').removeClass('boton-agregar-partido-disabled');
        $('#boton-agregar-partido-entrenador').addClass('boton-agregar-partido-enabled');
    }
    

}
// ------------------------------ Fin de la función 'chequear_datos_form_partidoentrenador()' ------------------------------ //

// ----------------- Inicio de la función 'boton_guardar_entrenador();()' ----------------- // 
function boton_guardar_entrenador() {
    if (window.identrenador != "" ) {
        $('#mensaje_agregar_entrenador').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_entrenador').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }
    $('#modal_formulario_entrenador').modal('show');
    $('.boton_modal').css('display','');
}
// ----------------- Fin de la función 'boton_guardar_entrenador();()' ----------------- //

// ----------------- Inicio de la función 'guardar_entrenador()' ----------------- //
function guardar_entrenador(){
    $('.boton_modal').css('display','none');

    if(window.identrenador_club!=""){
        $('#mensaje_agregar_entrenador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_entrenador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }

    // var data = $('#formulario_ficha_jugador').serializeArray();
    var data = new FormData( $('#formulario_entrenador')[0] );

    data.append('identrenador', window.identrenador);
    data.append('identrenador_club', window.identrenador_club);
    data.append('nombre_usuario_software', '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>');

    $.ajax({
        url: "post/scouting_centro_guardar_entrenador.php",
        type: "post",
            contentType:false,
            data:data,
            processData:false,
            cache:false,
        success: function(respuesta){
            // alert(respuesta);
            if(respuesta==1){

                $('#mensaje_agregar_entrenador').html('<h4>Registro ingresado correctamente!</h4>');
                buscar_entrenadores_seguimiento( 1 );           
                $("#cuadro_form_agregar_entrenador").hide(500);
                $('#cuadro_entrenadores_seguimiento').show(500);
                $('#modal_formulario_entrenador').modal('hide');

            }else if(respuesta==2){
                $('#mensaje_agregar_entrenador').html('<h4>Registro editado correctamente!</h4>');

                $('#mensaje_agregar_entrenador').html('<h4>Registro editado correctamente!</h4>');
                buscar_entrenadores_seguimiento( 1 );               
                $("#cuadro_form_agregar_entrenador").hide(500);
                $('#cuadro_entrenadores_seguimiento').show(500);
                $('#modal_formulario_entrenador').modal('hide');
            }
            else{ // respuesta==4
                $('#mensaje_agregar_entrenador').html('<h5>Ha ocurrido un error al ejecutar la consulta: '+respuesta+'.</h5><br>');
            }
            
        },error: function(){// will fire when timeout is reached
           $('#mensaje_agregar_entrenador').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 

    // Reiniciando selects de la vista:
    // Código agregado el 17-05-2020 a las 17:27:
    $('#cuadro_entrenadores_seguimiento select').each(function() {
        let thisElement = $(this);
        thisElement.prop('selectedIndex', 0);
    });     

}
// ----------------- Fin de la función 'guardar_entrenador()' ----------------- //

// -------------------------- Inicio de la función 'boton_editar_form_entrenador( linea )' - EDITAR (UPDATE) --------------------------- //
function boton_editar_form_entrenador( linea ){

    window.identrenador = datos_entrenador_club[linea]['identrenador'];
    window.identrenador_club = datos_entrenador_club[linea]['identrenador_club'];
    window.identrenador_partido = ''; // DEBE ESTAR VACÍO PARA EJECUTAR EL INSERT

    // Seleccionando la primera opción en cada select:
    $('#formulario_entrenador select').each(function(){
        $(this).prop("selectedIndex", 0);
    });   


    // Mostrando por defecto la pestaña 'Datos':
    $('a[href="#tab_form_entrenador"]').parent().attr('class', 'active');
    $('#tab_form_entrenador').attr('class', 'tab-pane active');

    $('a[href="#tab_form_partido_entrenador"]').parent('li').show(); // <--- Mostrando tab de formulario de partidos.
    $('a[href="#tab_form_partido_entrenador"]').parent().attr('class', '');
    $('#tab_form_partido_entrenador').attr('class', 'tab-pane');
 
    $('#formulario_partido_entrenador').hide(); // <--- Ocultando el formulario // Ocultando el formulario

    // alert( datos_entrenador_club[linea]['identrenador_club'] );

    // -------------------------------------------- FORMUARLIO DE ENTRENADOR -------------------------------------------- //
    let foto_entrenador = 'foto_entrenadores/' + datos_entrenador_club[linea]['identrenador'] + '.png?lala='+new Date()+'';
    // $('#foto_anterior_entrenador').val( foto_entrenador ); // <--- Importante. Cargar valor de la foto del entrenador en este campo oculto.
    $('#foto_anterior_entrenador').val( datos_entrenador_club[linea]['identrenador'] + '.png' ); // <--- Importante. Cargar valor de la foto del entrenador en este campo oculto.
    $('#foto_entrenador').val(''); // <--- Importante. Vaciar. 

    $('#foto-entrenador').attr( 'src', foto_entrenador ); // <--- Formulario id="formulario_entrenador"
    $("#nombre_entrenador").val( datos_entrenador_club[linea]['nombre_entrenador'] );
    $("#apellido1_entrenador").val( datos_entrenador_club[linea]['apellido1_entrenador'] );
    
    if( datos_entrenador_club[linea]['apellido2_entrenador'] === null ||  datos_entrenador_club[linea]['apellido2_entrenador'] === '' ) {
        datos_entrenador_club[linea]['apellido2_entrenador'] = "";
    }
    $("#apellido2_entrenador").val( datos_entrenador_club[linea]['apellido2_entrenador'] );
    
    $("#fecha_nacimiento_entrenador").val( datos_entrenador_club[linea]['fecha_nacimiento_entrenador'] );

    let nombre_completo_entrenador = datos_entrenador_club[linea]['nombre_entrenador'] + " " + datos_entrenador_club[linea]['apellido1_entrenador'] + " " + datos_entrenador_club[linea]['apellido2_entrenador'];

    
    // Selects:
    $("#nacionalidad_entrenador option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_entrenador_club[linea]['nacionalidad_entrenador'] ) {
            thisElement.prop("selected", true);
        }
    });

    $("#idclub_actual_entrenador option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_entrenador_club[linea]['idclub'] ) {
            thisElement.prop("selected", true);
        }
    });

    $('#representante_entrenadorclub').val( datos_entrenador_club[linea]['representante_entrenadorclub'] );

    $("#pais_club_actual_entrenador option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_entrenador_club[linea]['pais_club'] ) {
            thisElement.prop("selected", true);
        }
    });

    // División:
    $("#division_club_actual_entrenador").empty();
    if( datos_entrenador_club[linea]['division_club'] === null || datos_entrenador_club[linea]['division_club'] == '' || datos_entrenador_club[linea]['division_club'] == '0'  ) {

        $("#division_club_actual_entrenador").append('<option value="">Seleccione primero un país</option>');

    } else {

        $('#division_club_actual_entrenador').empty();
        let divisiones_pais_selected = array_divisiones[ datos_entrenador_club[linea]['pais_club'] ];
        divisiones_pais_selected = divisiones_pais_selected.filter(function(){return true;}); // Reiniciando el valor de los índices de 0 a n.
        $('#division_club_actual_entrenador').append('<option value="">Seleccione</option>');
        for (var i = 0; i < divisiones_pais_selected.length; i++) {
            let division =  divisiones_pais_selected[i][0];
            let prop_selected = '';
            if( division == datos_entrenador_club[linea]['division_club'] ) {
                prop_selected = 'selected'
            }

            $('#division_club_actual_entrenador').append('<option '+prop_selected+' value="'+divisiones_pais_selected[i][0]+'">'+divisiones_pais_selected[i][1]+'</option>');
        }

    }    

    // Seleccionando el ID de club según el país y división seleccionado (para el select #idclub_actual_jugadorenclub):
    // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
    $("#idclub_actual_entrenador").empty(); // <--- Vaciando select
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
            'pais_club': datos_entrenador_club[linea]['pais_club'],
            'division_club': datos_entrenador_club[linea]['division_club'] 
        },
        success: function(respuesta)  {
            $('#idclub_actual_entrenador').empty(); // <--- Vaciando select.
            if( respuesta== "" ) { // consulta vacía
                console.log("No se encontró ningún club según el país y división seleccionada...");
                $("#idclub_actual_entrenador").append('<option value="">Seleccione primero una división</option>');
            } else {              
                                
                $("#idclub_actual_entrenador").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $("#idclub_actual_entrenador").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }
                $("#idclub_actual_entrenador").append('<option value="000">Otro</option>');

                $("#idclub_actual_entrenador option").each(function(){
                    let thisElement = $(this);
                    let thisValue = $(this).val();
                    if( thisValue == datos_entrenador_club[linea]['idclub'] ) {
                        thisElement.prop("selected", true);
                    }
                });
            } 
        
        },
        error: function(){// will fire when timeout is reached
            console.log('Error al consultar el club del entrenador');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
    // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //


    $("#fechafin_contrato_entrenadorclub").val( datos_entrenador_club[linea]['fechafin_contrato_entrenadorclub'] );

    // Cláusula de salida:
    $("#clausula_salida_entrenadorclub option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_entrenador_club[linea]['clausula_salida_entrenadorclub'] ) {
            thisElement.prop("selected", true);
            /*
            if( thisValue == '0' ) {
                $("#valor_clausula_jugadorclub").parent().hide();
            }
            */
        }
    });

    $("#valor_clausula_entrenadorclub").val( datos_entrenador_club[linea]['valor_clausula_entrenadorclub'] );        
    $("#observaciones_entrenadorclub").val( datos_entrenador_club[linea]['observaciones_entrenadorclub'] );

    // -------------------------------------------- FORMUARLIO DE PARTIDOS -------------------------------------------- // 
    // Habilitando todos los inputs y selects del formulario id="formulario_partido_entrenador" (estarán únicamente habilitados cuando se seleccione el partido a modificar desde la ventana modal):
    $('#formulario_partido_entrenador input, #formulario_partido_entrenador select').each(function(){
        let thisElement = $(this);
        thisElement.prop('disabled', false).css('background-color', '');
    });

    // Ocultando el mensaje de registrar entrenadores en el formulario de partidos:
    $('.mensaje_registrarentrenador_formpartido').hide();

    // Agregando la foto del club del entrenador:
    let foto_club_entrenador = 'foto_clubes/' + datos_entrenador_club[linea]['idclub'] + '.png?lala='+new Date()+'';

    $('#foto_1_club_entrenador_partido').attr( 'src', foto_club_entrenador );
    $('#foto_1_club_rival_entrenador_partido').attr( 'src', '../config/default.png' );

    // Agregando por defecto la foto del club rival:
    $('#foto_2_club_entrenador_partido').attr( 'src', foto_club_entrenador );
    $('#foto_2_club_rival_entrenador_partido').attr( 'src', '../config/default.png' );

    $('.foto-entrenador-partido').attr( 'src', foto_entrenador ); // <--- Formulario id="formulario_partido_entrenador"  
    $('.nombre-entrenador-partido').html( nombre_completo_entrenador ); // <--- Formulario id="formulario_partido_entrenador"
    
    // buscar_partidos_entrenador( datos_entrenador_club[linea]['identrenador_club'] ); // <---- Consultando los partidos del entrenador

    $('#formulario_partido_entrenador')[0].reset(); // <---- Vaciando formulario de partido.

    // Deshabilitando el botón de agregar partido:
    $('#boton-agregar-partido-entrenador').prop('disabled', true); // <---- Deshabilitando el botón de guardar partido
    $('#boton-agregar-partido-entrenador').removeClass('boton-agregar-partido-enabled');
    $('#boton-agregar-partido-entrenador').addClass('boton-agregar-partido-disabled');

    // Ocultando cualquiera de las dos vistas desde las cuales el usuario haya visualizado los jugadores:
    $('#cuadro_entrenadores_seguimiento').hide(500);
    $('#cuadro_form_agregar_entrenador').show(500);

    campos_entrenador(); // <--- Con esta función se muestran los campos según sea el caso.
    chequear_datos_form_entrenador(); // <----- Validando los campos del formulario id="formulario_partido_entrenador".
    buscar_partidos_entrenador( datos_entrenador_club[linea]['identrenador_club'] ); // <---- Consultando los partidos del entrenador

    $('.campo-campeonato-entrenador-otro').hide();
    $('.campo-club-rival-entrenador-otro').hide();

    // Mostrando el boton de guardar entrenador:
    $('#boton_agregar_entrenador').show();

}
// -------------------------- Fin de la función 'boton_editar_form_entrenador( linea )' - EDITAR (UPDATE) --------------------------- //

// ------------------------------------------ Inicio de la función 'boton_eliminar_entrenador( linea )' ------------------------------------------ // 
function boton_eliminar_entrenador( linea ) {
    window.identrenador= datos_entrenador_club[linea]['identrenador'];
    // alert( datos_entrenador_club[linea]['identrenador'] );
    $('#modal_eliminar_entrenador').modal('show');
    $('#mensaje_eliminar_entrenador').html('<h5>¿Estás seguro que quieres eliminar este entrenador?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
}
// ------------------------------------------ Fin de la función 'boton_eliminar_entrenador( linea )' ------------------------------------------ //

// ------------------------------------------ Inicio de la función 'eliminar_entrenador()' ------------------------------------------ //
function eliminar_entrenador() {
    //alert( window.identrenador );

     $('.boton_modal').hide();
     $('#mensaje_eliminar_entrenador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando entrenador...</h5><br><img src="../config/remover_archivo.png">');
     $.ajax({
        url: "post/scouting_centro_eliminar_entrenador.php",
        type: "post",
        data: {
            'identrenador': window.identrenador
        },success: function(respuesta) {
            if(respuesta==1){//eliminado correctamente
                $('#mensaje_eliminar_entrenador').html('<h5>Entrenador eliminado correctamente!</h5>');
                buscar_entrenadores_seguimiento( 1 );            
                $('#modal_eliminar_entrenador').modal('hide');
            }else{
                $('#mensaje_eliminar_entrenador').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> contacte al administrador.</h5>");
            }
            // $('#modal_eliminar_entrenador').modal('hide');
        },error: function(){// will fire when timeout is reached
            $('#mensaje_eliminar_entrenador').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> compruebe conexión a internet.</h5>");
        }, timeout: 10000 // sets timeout to 3 seconds
      });     
}
// ------------------------------------------ Fin de la función 'eliminar_entrenador()' ------------------------------------------ //

// ----------------- Inicio de la función 'boton_guardar_partido_entrenador()' ----------------- // 
function boton_guardar_partido_entrenador(){

    // alert( "identrenador_partido: " + window.identrenador_partido );
    
    if (window.identrenador_partido != "" ) {
        $('#mensaje_agregar_partido_entrenador').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_partido_entrenador').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }
    $('#modal_formulario_guardar_partido_entrenador').modal('show');
    $('.boton_modal').css('display','');
}
// ----------------- Fin de la función 'boton_guardar_partido_entrenador()' ----------------- //

// ----------------- Inicio de la función 'guardar_partido_entrenador()' ----------------- //
function guardar_partido_entrenador(){
    $('.boton_modal').css('display','none');

    if(window.identrenador_partido!=""){
        $('#mensaje_agregar_partido_entrenador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_partido_entrenador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }

    // var data = $('#formulario_partido_entrenador').serializeArray();
    var data = new FormData( $('#formulario_partido_entrenador')[0] );

    data.append('identrenador_club', window.identrenador_club);
    data.append('identrenador_partido', window.identrenador_partido);
    data.append('nombre_usuario_software', '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>');

    // alert(JSON.stringify(data));
    $.ajax({
        url: "post/scouting_centro_guardar_partidoentrenador.php",
        type: "post",
            contentType:false,
            data:data,
            processData:false,
            cache:false,
        success: function(respuesta){
            // alert(respuesta);
            if(respuesta==1){

                $('#mensaje_agregar_partido_entrenador').html('<h4>Registro ingresado correctamente!</h4>');
                buscar_partidos_entrenador( window.identrenador_club ); // <---- Consultando los partidos del entrenador
                $('#modal_formulario_guardar_partido_entrenador').modal('hide');
                $('#formulario_partido_entrenador')[0].reset(); // <--- Vaciando formulario.
                
                // Escondiendo los inputs de otro campeonato y club:
                $('.campo-campeonato-entrenador-otro').hide();
                $('.campo-club-rival-entrenador-otro').hide();             

                window.identrenador_partido = ''; // <--- Vaciando la variable en caso de que el usuario quiera registrar otro partido (para que pueda ejecutarse el INSERT)

                $('#formulario_partido_entrenador').hide(); // <--- Escondiendo el formulario


            }else if(respuesta==2){

                $('#mensaje_agregar_partido_entrenador').html('<h4>Registro editado correctamente!</h4>');
                buscar_partidos_entrenador( window.identrenador_club ); // <---- Consultando los partidos del entrenador
                $('#modal_formulario_guardar_partido_entrenador').modal('hide');
                $('#formulario_partido_entrenador')[0].reset(); // <--- Vaciando formulario.
                            
                // Escondiendo los inputs de otro campeonato y club:
                $('.campo-campeonato-entrenador-otro').hide();
                $('.campo-club-rival-entrenador-otro').hide();                 

                window.identrenador_partido = ''; // <--- Vaciando la variable en caso de que el usuario quiera registrar otro partido (para que pueda ejecutarse el INSERT)

                $('#formulario_partido_entrenador').hide(); // <--- Escondiendo el formulario


            }
            else{ // respuesta==4
                $('#mensaje_agregar_partido_entrenador').html('<h5>Ha ocurrido un error al ejecutar la consulta: '+respuesta+'.</h5><br>');
            }
            
        },error: function(){// will fire when timeout is reached
           $('#mensaje_agregar_partido_entrenador').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
}
// ----------------- Fin de la función 'guardar_partido_entrenador()' ----------------- //

// -------------------------- Inicio de la función 'boton_agregar_partido_entrenador( linea )' - AGREGAR (INSERT) --------------------------- //
function boton_agregar_partido_entrenador(){

    window.identrenador_partido = ''; // <---- DEBE ESTAR VACÍO PARA EJECUTAR EL INSERT
    $('#formulario_partido_entrenador').slideDown('fast'); // <---- Mostrando el formulario

    // -------------------------------------------- FORMUARLIO DE PARTIDOS -------------------------------------------- //
    // Agregando por defecto la foto del club rival:
    $('#foto_1_club_rival_entrenador_partido').attr( 'src', '../config/default.png' );
    $('#foto_2_club_rival_entrenador_partido').attr( 'src', '../config/default.png' );    
    $('#formulario_partido_entrenador')[0].reset(); // <---- Vaciando formulario de partido.
    // $('#min_jugados_entrenadorpartido_text').html('0 minutos'); // <--- Importante. Cambiar texto
    $('#min_jugados_entrenadorpartido').val(''); // <--- Importante. Vaciar
    chequear_datos_form_partidoentrenador(); // <---- Validando

    $('.campo-campeonato-entrenador-otro').hide();
    $('.campo-club-rival-entrenador-otro').hide();    

}
// -------------------------- Fin de la función 'boton_agregar_partido_entrenador( linea )' - AGREGAR (INSERT) --------------------------- //

// -------------------------- Inicio de la función 'boton_editar_form_partido_entrenador( linea )' - EDITAR (UPDATE) --------------------------- //
function boton_editar_form_partido_entrenador( linea ){

    window.identrenador_club = datos_entrenador_partido[linea]['identrenador_club'];
    window.identrenador = datos_entrenador_partido[linea]['identrenador'];
    window.identrenador_partido = datos_entrenador_partido[linea]['identrenador_partido'];

    $('#formulario_partido_entrenador').show();

    let foto_entrenador = 'foto_entrenadores/' + datos_entrenador_partido[linea]['identrenador'] + '.png?lala='+new Date()+'';
    // $('#foto_anterior_entrenador').val( foto_entrenador ); // <--- Importante. Cargar valor de la foto del entrenador en este campo oculto.
    $('#foto_anterior_entrenador').val( datos_entrenador_partido[linea]['identrenador'] + '.png' ); // <--- Importante. Cargar valor de la foto del entrenador en este campo oculto.
    $('#foto_entrenador').val(''); // <--- Importante. Vaciar. 

    $('#foto-entrenador').attr( 'src', foto_entrenador ); // <--- Formulario id="formulario_entrenador"
    $("#nombre_entrenador").val( datos_entrenador_partido[linea]['nombre_entrenador'] );
    $("#apellido1_entrenador").val( datos_entrenador_partido[linea]['apellido1_entrenador'] );
    
    if( datos_entrenador_partido[linea]['apellido2_entrenador'] === null ||  datos_entrenador_partido[linea]['apellido2_entrenador'] === '' ) {
        datos_entrenador_partido[linea]['apellido2_entrenador'] = "";
    }
    $("#apellido2_entrenador").val( datos_entrenador_partido[linea]['apellido2_entrenador'] );
    
    $("#fecha_nacimiento_entrenador").val( datos_entrenador_partido[linea]['fecha_nacimiento_entrenador'] );

    let nombre_completo_entrenador = datos_entrenador_partido[linea]['nombre_entrenador'] + " " + datos_entrenador_partido[linea]['apellido1_entrenador'] + " " + datos_entrenador_partido[linea]['apellido2_entrenador'];

    
    // Selects:
    $("#nacionalidad_entrenador option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_entrenador_partido[linea]['nacionalidad_entrenador'] ) {
            thisElement.prop("selected", true);
        }
    });

    $("#idclub_actual_entrenador option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_entrenador_partido[linea]['idclub'] ) {
            thisElement.prop("selected", true);
        }
    });

    $('#representante_entrenadorclub').val( datos_entrenador_partido[linea]['representante_entrenadorclub'] );

    $("#pais_club_actual_entrenador option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_entrenador_partido[linea]['pais_club'] ) {
            thisElement.prop("selected", true);
        }
    });

    $("#division_club_actual_entrenador option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_entrenador_partido[linea]['division_club'] ) {
            thisElement.prop("selected", true);
        }
    });

    // Seleccionando el ID de club según el país y división seleccionado (para el select #idclub_actual_jugadorenclub):
    // ----------------------------------------- INICIO DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //
    $("#idclub_actual_entrenador").empty(); // <--- Vaciando select.
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paisdivision', // <---- Consultando clubes según el país y la división.
            'pais_club': datos_entrenador_partido[linea]['pais_club'],
            'division_club': datos_entrenador_partido[linea]['division_club'] 
        },
        success: function(respuesta)  {
            $('#idclub_actual_entrenador').empty(); // <--- Vaciando select.
            if( respuesta== "" ) { // consulta vacía
                console.log("No se encontró ningún club según el país y división seleccionada...");
                $("#idclub_actual_entrenador").append('<option value="">No se encontraron clubes</option>');
                $("#idclub_actual_entrenador").append('<option value="000">Otro</option>');
            } else {              
                                
                $("#idclub_actual_entrenador").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $("#idclub_actual_entrenador").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
                }
                $("#idclub_actual_entrenador").append('<option value="000">Otro</option>');

                $("#idclub_actual_jugadorenclub option").each(function(){
                    let thisElement = $(this);
                    let thisValue = $(this).val();
                    if( thisValue == datos_entrenador_partido[linea]['idclub'] ) {
                        thisElement.prop("selected", true);
                    }
                });
            } 
        
        },
        error: function(){// will fire when timeout is reached
            console.log('Error al consultar clubes para select del club actual del entrenador');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
    // ----------------------------------------- FIN DE LA FUNCIÓN AJAX (CONSULTAR) ----------------------------------------- //


    $("#fechafin_contrato_entrenadorclub").val( datos_entrenador_partido[linea]['fechafin_contrato_entrenadorclub'] );

    // Cláusula de salida:
    $("#clausula_salida_entrenadorclub option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_entrenador_partido[linea]['clausula_salida_entrenadorclub'] ) {
            thisElement.prop("selected", true);
            /*
            if( thisValue == '0' ) {
                $("#valor_clausula_jugadorclub").parent().hide();
            }
            */
        }
    });

    $("#valor_clausula_entrenadorclub").val( datos_entrenador_partido[linea]['valor_clausula_entrenadorclub'] );        
    $("#observaciones_entrenadorclub").val( datos_entrenador_partido[linea]['observaciones_entrenadorclub'] );

    campos_entrenador(); // <--- Con esta función se muestran los campos según sea el caso.
    chequear_datos_form_entrenador(); // <----- Validando los campos del formulario id="formulario_entrenador".

    // -------------------------------------------- FORMUARLIO DE PARTIDOS -------------------------------------------- //
    // Habilitando todos los inputs y selects del formulario id="formulario_partido_entrenador" (estarán únicamente habilitados cuando se seleccione el partido a modificar desde la ventana modal):

    // Ocultando el mensaje de registrar entrenadores en el formulario de partidos:
    $('.mensaje_registrarentrenador_formpartido').hide();    

    $('#formulario_partido_entrenador input, #formulario_partido_entrenador select').each(function(){
        let thisElement = $(this);
        thisElement.prop('disabled', false).css('background-color', '');
    });

    // Agregando la foto del club del jugador:
    let foto_club_entrenador = 'foto_clubes/' + datos_entrenador_partido[linea]['idclub_entrenador'] + '.png?lala='+new Date()+'';

    $('#foto_1_club_entrenador_partido').attr( 'src', foto_club_entrenador );
    $('#foto_2_club_entrenador_partido').attr( 'src', foto_club_entrenador );

    $('.foto-entrenador-partido').attr( 'src', foto_entrenador ); // <--- Formulario id="formulario_partido_entrenador"  
    $('.nombre-entrenador-partido').html( nombre_completo_entrenador ); // <--- Formulario id="formulario_partido_entrenador"

    // Agregando la foto del club rival:
    let foto_club_rival = 'foto_clubes/' + datos_entrenador_partido[linea]['idclub_rival'] + '.png?lala='+new Date()+'';

    $('#foto_1_club_rival_entrenador_partido').attr( 'src', foto_club_rival );
    $('#foto_2_club_rival_entrenador_partido').attr( 'src', foto_club_rival );

    // -------------------------- Agregando los valores a los inputs y selects del partido seleccionado -------------------------- //
    $("#fecha_entrenadorpartido").val( datos_entrenador_partido[linea]['fecha_entrenadorpartido'] );

    // ---------------------- Establecer como selected el campeonato ---------------------- // 
    $("#idcampeonato_entrenador").empty(); // <--- Vaciando select
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_all_campeonatos',    
        },success: function(respuesta){
            $("#idcampeonato_entrenador").empty(); // <--- Vaciando select
            $("#idcampeonato_entrenador").append('<option value="">Seleccione</option>');
            for(var i=0; i < respuesta.length; i++) {   
                $("#idcampeonato_entrenador").append('<option pais-campeonato="'+respuesta[i]['pais_campeonato']+'" value="'+respuesta[i]['idcampeonato']+'">'+respuesta[i]['nombre_campeonato']+'</option>');
            }
            $("#idcampeonato_entrenador").append('<option value="000">Otro</option>');

            $("#idcampeonato_entrenador option").each(function(){
                let thisElement = $(this);
                let thisValue = $(this).val();
                if( thisValue == datos_entrenador_partido[linea]['idcampeonato'] ) {
                    thisElement.prop("selected", true);
                }
            });

            
        },error: function(){// will fire when timeout is reached
            console.log('Error al consultar campeonatos del partido del entrenador');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 

    $("#temporada_entrenadorpartido").val( datos_entrenador_partido[linea]['temporada_entrenadorpartido'] );
    $("#md_entrenadorpartido").val( datos_entrenador_partido[linea]['md_entrenadorpartido'] );
    $("#jornada_entrenadorpartido").val( datos_entrenador_partido[linea]['jornada_entrenadorpartido'] );
    $("#tactica_entrenadorpartido").val( datos_entrenador_partido[linea]['tactica_entrenadorpartido'] );

    // ---------------------- Establecer como selected el club rival ---------------------- // 
    $("#idclub_rival_entrenador").empty(); // <---- Vaciando select.
    $.ajax({
        url: "post/scouting_centro_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paiscampeonato_entrenador', // <---- Consultando clubes según el país del campeonato seleccionado.
            'pais_campeonato': datos_entrenador_partido[linea]['pais_campeonato']   
        },success: function(respuesta){
            $("#idclub_rival_entrenador").empty(); // <---- Vaciando select.
            $("#idclub_rival_entrenador").append('<option value="">Seleccione</option>');
            for(var i=0; i < respuesta.length; i++) {   
                $("#idclub_rival_entrenador").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
            }
            $("#idclub_rival_entrenador").append('<option value="000">Otro</option>');

            $("#idclub_rival_entrenador option").each(function(){
                let thisElement = $(this);
                let thisValue = $(this).val();
                if( thisValue == datos_entrenador_partido[linea]['idclub_rival'] ) {
                    thisElement.prop("selected", true);
                }
            });
            
        },error: function(){// will fire when timeout is reached
            console.log('Error al consultar clubes para select del club del rival (entrenador)');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 


    $("#gol_equipo1_entrenadorpartido").val( datos_entrenador_partido[linea]['gol_equipo1_entrenadorpartido'] );
    $("#gol_equipo2_entrenadorpartido").val( datos_entrenador_partido[linea]['gol_equipo2_entrenadorpartido'] );

    // Condición del equipo 1 (Entrenador)
    switch( datos_entrenador_partido[linea]['cond_equipo1_entrenadorpartido'] ) {
        case "1": // <---- Local.
            $("#condicion_local_equipo1_entrenadorpartido").prop('checked', true);
            break;
        case "2": // <---- Visitante.
            $("#condicion_visita_equipo1_entrenadorpartido").prop('checked', true);
            break;     
        case "3": // <---- Neutral.
            $("#condicion_neutral_equipo1_entrenadorpartido").prop('checked', true);
            break;                                                                  
    }

    // Condición del equipo 2 (Rival)
    switch( datos_entrenador_partido[linea]['cond_equipo2_entrenadorpartido'] ) {
        case "1": // <---- Local.
            $("#condicion_local_equipo2_entrenadorpartido").prop('checked', true);
            break;
        case "2": // <---- Visitante.
            $("#condicion_visita_equipo2_entrenadorpartido").prop('checked', true);
            break;     
        case "3": // <---- Neutral.
            $("#condicion_neutral_equipo2_entrenadorpartido").prop('checked', true);
            break;                                                                  
    }    

    $('#t_amarilla_entrenadorpartido').val( datos_entrenador_partido[linea]['t_amarilla_entrenadorpartido'] );
    $('#t_amarilladb_entrenadorpartido').val( datos_entrenador_partido[linea]['t_amarilladb_entrenadorpartido'] );
    $('#t_roja_entrenadorpartido').val( datos_entrenador_partido[linea]['t_roja_entrenadorpartido'] );
    $('#min_jugados_entrenadorpartido').val( datos_entrenador_partido[linea]['min_jugados_entrenadorpartido'] );

    chequear_datos_form_partidoentrenador(); // <---- Validando campos del formulario id="formulario_partido_jugador"
}
// -------------------------- Fin de la función 'boton_editar_form_partido_entrenador( linea )' - EDITAR (UPDATE) --------------------------- //

// ------------------------------------------ Inicio de la función 'boton_eliminar_partido_entrenador( linea )' ------------------------------------------ // 
function boton_eliminar_partido_entrenador( linea ) {
    
    window.identrenador_club = datos_entrenador_partido[linea]['identrenador_club'];
    window.identrenador_partido = datos_entrenador_partido[linea]['identrenador_partido'];
    
    // alert( datos_jugador_partido[linea]['identrenador_partido'] );
    // alert( datos_partido_club[linea]['identrenador_partido']; );

    $('#modal_eliminar_partido_entrenador').modal('show');
    $('#mensaje_eliminar_partido_entrenador').html('<h5>¿Estás seguro que quieres eliminar este partido?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();

}
// ------------------------------------------ Fin de la función 'boton_eliminar_partido_entrenador( linea )' ------------------------------------------ //

// ------------------------------------------ Inicio de la función 'eliminar_partido_entrenador()' ------------------------------------------ //
function eliminar_partido_entrenador() {
    //alert( window.identrenador_partido );

     $('.boton_modal').hide();
     $('#mensaje_eliminar_partido_entrenador').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando partido...</h5><br><img src="../config/remover_archivo.png">');
     $.ajax({
        url: "post/scouting_centro_eliminar_partidoentrenador.php",
        type: "post",
        data: {
            'identrenador_partido': window.identrenador_partido
        },success: function(respuesta) {
            if(respuesta==1){//eliminado correctamente
                $('#mensaje_eliminar_partido_entrenador').html('<h5>Partido eliminado correctamente!</h5>');

                $('#modal_eliminar_partido_entrenador').modal('hide');

                buscar_partidos_entrenador( window.identrenador_club ); // <---- Consultando los partidos del entrenador

                $('#formulario_partido_entrenador')[0].reset(); // <---- Vaciando formulario.
                $('#formulario_partido_entrenador').hide(); // <---- Escondiendo formulario.

                // Escondiendo los inputs de otro campeonato y club:
                $('.campo-campeonato-otro').hide();
                $('.campo-club-rival-otro').hide();             

                window.identrenador_partido = ''; // <--- Vaciando la variable en caso de que el usuario quiera registrar otro partido (para que pueda ejecutarse el INSERT)

            }else{
                $('#mensaje_eliminar_partido_entrenador').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> contacte al administrador.</h5>");
            }
            // $('#modal_eliminar_partido_entrenador').modal('hide');
        },error: function(){// will fire when timeout is reached
            $('#mensaje_eliminar_partido_entrenador').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> compruebe conexión a internet.</h5>");
        }, timeout: 10000 // sets timeout to 3 seconds
      });     
}
// ------------------------------------------ Fin de la función 'eliminar_partido_entrenador()' ------------------------------------------ //

$('#idcampeonato_icsjp').change(function(){
    let thisValue = $(this).val(); 
    if( thisValue == "000" ) {
        $('.campo-campeonato-otro').show();
        $("#idclub_rival_icsjp").append('<option value="">Seleccione</option>'); // <--- Importante.
        $("#idclub_rival_icsjp").append('<option value="000">Otro</option>'); // <--- Importante.        
    } else {
        $('.campo-campeonato-otro').hide();
    }
});

$('#idclub_rival_icsjp').change(function(){
    let thisValue = $(this).val(); 
    if( thisValue == "000" ) {
        $('.campo-club-rival-otro').show();
    } else {
        $('.campo-club-rival-otro').hide();
    }
});

// -------------------- Inicio de la función 'get_cantidad_jugadores_scouting()' -------------------- // 
function get_cantidad_jugadores_scouting(){
    $.ajax({
        url: "post/scouting_centro_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_cantidad_jugadores_scouting'
        },success: function(respuesta){

            let cantidad_jugadores_scouting = respuesta[0]['COUNT(idcscouting_jugador)'];
            $(".cantidad-jugadores-scouting").html( cantidad_jugadores_scouting );   
            
        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
            $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    });
}
// -------------------- Fin de la función 'get_cantidad_jugadores_scouting()' -------------------- //
get_cantidad_jugadores_scouting(); // <--- Ejecutando función.

// -------------------- Inicio de la función 'get_cantidad_entrenadores_scouting()' -------------------- // 
function get_cantidad_entrenadores_scouting(){
    $.ajax({
        url: "post/scouting_centro_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_cantidad_entrenadores_scouting'
        },success: function(respuesta){

            let cantidad_entrenadores_scouting = respuesta[0]['COUNT(identrenador_club)'];
            $(".cantidad-entrenadores-scouting").html( cantidad_entrenadores_scouting );   
            
        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
            $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    });
}
// -------------------- Fin de la función 'get_cantidad_entrenadores_scouting()' -------------------- //
get_cantidad_entrenadores_scouting(); // <--- Ejecutando función.

// -------------------- Inicio de la función 'boton_modal_agregar_video()' -------------------- //
function boton_modal_agregar_video() {
    $('#modal_agregar_video').modal('show');
}
// -------------------- Fin de la función 'boton_modal_agregar_video()' -------------------- //

// -------------------- Inicio de la función 'boton_guardar_video_modal()' -------------------- //
function boton_guardar_video_modal() {
    
    let fecha_video_modal = $('#fecha_video_modal').val()
    let servidor_video_modal = $('#servidor_video_modal').val()
    let titulo_video_modal = $('#titulo_video_modal').val()
    let link_video_modal = $('#link_video_modal').val()
    let categoria_video_modal = $('#categoria_video_modal').val()
    let sub_categoria_video_modal = $('#sub_categoria_video_modal').val()

    $('#fecha_video').val( fecha_video_modal );
    $('#servidor_video').val( servidor_video_modal );
    $('#titulo_video').val( titulo_video_modal );
    $('#link_video').val( link_video_modal );
    $('#categoria_video').val( categoria_video_modal );
    $('#sub_categoria_video').val( sub_categoria_video_modal );

    $('#iframe_video_modal').attr('src', link_video_modal);

    $('#modal_agregar_video').modal('hide');

}
// -------------------- Fin de la función 'boton_guardar_video_modal()' -------------------- //

// -------------------- Inicio de la función 'buscar_jugadores_seguimiento()' -------------------- // 
function buscar_jugadores_seguimiento( query ){

    $('#error_conexion_jugadores_seguimiento').hide();
    $('#sin_resultados_jugadores_seguimiento').hide();
    $('#cargando_buscar_jugadores_seguimiento').show();
    $("#tabla_jugadores_seguimiento tbody").empty(); // <--- Vaciando tabla.     

    let data;
    if( query === 1 ) {

        data = {
            'tipo_consulta': 'get_edadminmax_jugadores_seguimiento',
        };

    } else {

        let string = $('#nombre_fbjscouting_main').val();
        let idpais_fbjscouting_main = $('#idpais_fbjscouting_main').val();
        let division_fbjscouting_main = $('#division_fbjscouting_main').val();
        let idclub_fbjscouting_main = $('#idclub_fbjscouting_main').val();
        let nacionalidad_fbjscouting_main = $('#nacionalidad_fbjscouting_main').val();
        let range_min_edad_fbjscouting_main = $('#range_min_edad_fbjscouting_main').val();
        let range_max_edad_fbjscouting_main = $('#range_max_edad_fbjscouting_main').val();
        let lateralidad_fbjscouting_main = $('#lateralidad_fbjscouting_main').val();

        data = {
            'tipo_consulta': 1,
            'string': string,
            'idpais_fbjscouting_main': idpais_fbjscouting_main,
            'division_fbjscouting_main': division_fbjscouting_main,
            'idclub_fbjscouting_main': idclub_fbjscouting_main,
            'nacionalidad_fbjscouting_main': nacionalidad_fbjscouting_main,
            'range_min_edad_fbjscouting_main': range_min_edad_fbjscouting_main,
            'range_max_edad_fbjscouting_main': range_max_edad_fbjscouting_main,
            'lateralidad_fbjscouting_main': lateralidad_fbjscouting_main,                
        }

    }

    $.ajax({
        url: "post/scouting_centro_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: data,
        success: function(respuesta){
            // alert(JSON.stringify(respuesta));
            if(respuesta== ""){ //jugador sin informes
                $("#tabla_jugadores_seguimiento tbody").empty();
                var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td colspan="13"><center><b>No se encontraron jugadores en seguimiento</b></center></td></tr>';
                $("#tabla_jugadores_seguimiento tbody").append(markup);
                $('#cargando_buscar_jugadores_seguimiento').hide();
                $('#sin_resultados_jugadores_seguimiento').show();
                $('#boton_refresh_jugadores_seguimiento').hide();
            }else{              
                window.datos_jugador_club = respuesta; //se copian todos los profesores al cache
                $("#tabla_jugadores_seguimiento tbody").empty();

                if( query === 1 ) {
                    let min_edad = respuesta[0]['min_edad'];
                    let max_edad = respuesta[0]['max_edad'];

                    console.log( 'Edad mínima: ' + min_edad );
                    console.log( 'Edad máxima: ' + max_edad );

                    $('.mr-edad-jscouting').attr('data-lbound', min_edad);
                    $('.mr-edad-jscouting').attr('data-ubound', max_edad);
                        
                    $('#range_min_edad_fbjscouting_main').attr('min', min_edad);
                    $('#range_min_edad_fbjscouting_main').attr('max', max_edad);
                    // $('#range_min_edad_fbjscouting_main').attr('value', min_edad);

                    //alert( $('#range_min_edad_fbjscouting_main').val() );

                    $('#range_max_edad_fbjscouting_main').attr('min', min_edad);
                    $('#range_max_edad_fbjscouting_main').attr('max', max_edad);
                    // $('#range_max_edad_fbjscouting_main').attr('value', max_edad);
                }

                var count = 1;

                for(var i=0; i < respuesta.length; i++){              

                    // Datos del Club:
                    let idclub = parseInt( respuesta[i]['idclub'] );
                    let division_club = parseInt( respuesta[i]['division_club'] );

                    let nombre_club;
                    if( respuesta[i]['nombre_club'] === null || respuesta[i]['nombre_club'] == '' ) {
                        nombre_club = 'No especificado';
                    } else {    
                        nombre_club = respuesta[i]['nombre_club'];
                    }                             
                    
                    let entrenador_club = respuesta[i]['entrenador_club'];

                    let foto_club = './foto_clubes/'+idclub+'.png?lala='+new Date()+'';
                    
                    let cantidad_total_jugadores = respuesta[i]['cantidad_total_jugadores'];
                    let media_edad = respuesta[i]['media_edad'];

                    // Datos del Jugador:                    
                    if( respuesta[i]['apellido2'] == null ) {
                        respuesta[i]['apellido2'] = "";
                    } 

                    let nombre_completo_jugador = respuesta[i]['nombre'] + " " + respuesta[i]['apellido1'] + " " + respuesta[i]['apellido2'];
                    
                    let fechaNacimiento;
                    if( respuesta[i]['fechaNacimiento'] == '0000-00-00' || respuesta[i]['fechaNacimiento'] == '' || respuesta[i]['fechaNacimiento'] === null ) {
                        fechaNacimiento = 'No especificado';
                    } else {
                        fechaNacimiento = fecha_formato_ddmmaaa( respuesta[i]['fechaNacimiento'] );
                    }
                    
                    let edad;
                    if( respuesta[i]['fechaNacimiento'] == '0000-00-00' || respuesta[i]['fechaNacimiento'] == '' || respuesta[i]['fechaNacimiento'] === null ) {
                        edad = 'No especificado';
                    } else {
                        edad = calcularEdad( respuesta[i]['fechaNacimiento'] );    
                    }

                    let codigoNacionalidad1 = respuesta[i]['codigoNacionalidad1'];
                    let nacionalidad2 = respuesta[i]['nacionalidad2'];

                    let nacionalidad;
                    if( codigoNacionalidad1 === null || codigoNacionalidad1 == '' || codigoNacionalidad1 == '0' ) {
                        nacionalidad = 'No especificado';
                    } else {
                        nacionalidad = paises_nacionalidad[ respuesta[i]['codigoNacionalidad1'] ];
                        nacionalidad = nacionalidad.substring(0, 3);   
                        nacionalidad = nacionalidad.toUpperCase();                        
                    }

                    let bandera_nacionalidad;
                    if( codigoNacionalidad1 === null || codigoNacionalidad1 == '' || codigoNacionalidad1 == '0' ) {
                        bandera_nacionalidad = 'src="img/default.png" class="img-nacionalidad-small"';
                    } else {
                        bandera_nacionalidad = 'src="flags/blank.gif" class="flag flag-'+respuesta[i]['codigoNacionalidad1'].toLowerCase()+'"';
                    }

                    let pie_habil;
                    let dinamico = respuesta[i]['dinamico'];
                    if( dinamico === null || dinamico == '' || dinamico == '0' ) {
                        pie_habil = 'No especificado';
                    } else {
                        pie_habil = array_lateralidad[dinamico][1];
                    }

                    let altura = respuesta[i]['altura'];                        
                    if( altura === null || altura == '' || altura == '0' ) {
                        altura = 'No especificado';
                    } else {
                        altura = respuesta[i]['altura'] + ' cm';
                    }
                    
                    let lista_posiciones = '';

                    let posicion0 = respuesta[i]['posicion0'];
                    let nombre_posicion0;
                    if( posicion0 === null || posicion0 == '' || posicion0 == '0' || posicion0 == '999' || typeof posicion0 === "undefined" ) {
                        nombre_posicion0 = '';
                        lista_posiciones += nombre_posicion0;
                    } else {
                        nombre_posicion0 = array_posiciones[posicion0][1];
                        lista_posiciones += nombre_posicion0 + ', '; 
                    }

                    let posicion1 = respuesta[i]['posicion1'];
                    let nombre_posicion1;
                    if( posicion1 === null || posicion1 == '' || posicion1 == '0' || posicion1 == '999' || typeof posicion1 === "undefined" ) {
                        nombre_posicion1 = '';
                        lista_posiciones += nombre_posicion1;
                    } else {
                        nombre_posicion1 = array_posiciones[posicion1][1];
                        lista_posiciones += nombre_posicion1 + ', ';
                    }

                    let posicion2 = respuesta[i]['posicion2'];
                    let nombre_posicion2;
                    if( posicion2 === null || posicion2 == '' || posicion2 == '0' || posicion2 == '999' || typeof posicion2 === "undefined" ) {
                        nombre_posicion2 = '';
                        lista_posiciones += nombre_posicion2;
                    } else {
                        nombre_posicion2 = array_posiciones[posicion2][1];
                        lista_posiciones += nombre_posicion2 + ', ';
                    }                                        


                    if( lista_posiciones == '' ) {
                        lista_posiciones = 'No especificado';
                    }

                    let idfichaJugador = parseInt( respuesta[i]['idfichaJugador'] );
                    let foto_jugador = './foto_jugadores_scouting/'+idfichaJugador+'.png?lala='+new Date()+'';

                    let representante_jugadorclub;
                    if( respuesta[i]['representante_jugadorclub'] === null || respuesta[i]['representante_jugadorclub'] === '' ) {
                        representante_jugadorclub = 'No informado';
                    } else {
                        representante_jugadorclub = respuesta[i]['representante_jugadorclub'];
                    }

                    let fechafin_contrato_jugadorclub;
                    if( respuesta[i]['fechafin_contrato_jugadorclub'] === null || respuesta[i]['fechafin_contrato_jugadorclub'] === '0000-00-00' ) {
                        fechafin_contrato_jugadorclub = 'No especificado';
                    } else {
                        fechafin_contrato_jugadorclub = fecha_formato_ddmmaaa( respuesta[i]['fechafin_contrato_jugadorclub'] );
                    }
                    
                    var markup = 
                    '<tr class="panel_buscar" style="font-size: 10px;">\
                        <td onclick="btnver_informes_seguimiento_jugador('+i+');" style="font-weight:bold; text-align: center;">'+count+'</td>\
                        <td onclick="btnver_informes_seguimiento_jugador('+i+');" style="text-align: center;">\
                            <div class="div-club-table" style="text-align: left; max-width: 110px;">\
                                <div class="img-next-to-text"><img src="'+foto_jugador+'" style="height: 25px; width: 30px; border-radius: 50%; border: solid 2px;"></div>\
                                <div><p class="ellipsis-text" style="position: relative; left: 7px; top: 3px; text-transform: capitalize;">'+nombre_completo_jugador+'</p></div>\
                            </div>\
                        </td>\
                        <td onclick="btnver_informes_seguimiento_jugador('+i+');" style="font-weight:bold;">\
                            <div style="max-width: 105px; text-align: center;"><p class="ellipsis-text">'+lista_posiciones+'</p></div>\
                        </td>\
                        <td onclick="btnver_informes_seguimiento_jugador('+i+');" style="text-align: left;">\
                            <div class="div-club-table" style="text-align: left;">\
                                <div class="img-next-to-text"><img src="'+foto_club+'" style="width: 30px;"></div>\
                                <div style="max-width: 90px;"><p class="ellipsis-text" style="position: relative; left: 7px; top: 1px;">'+nombre_club+'</p></div>\
                            </div>\
                        </td>\
                        <td onclick="btnver_informes_seguimiento_jugador('+i+');" style="text-align: left;">\
                            <div class="img-next-to-text"><img '+bandera_nacionalidad+' style="/*width: 30px;*/"></div>\
                            <div style="max-width: 85px;"><p class="ellipsis-text" style="position: relative; left: 7px; top: 1px;">'+nacionalidad+'</p></div>\
                        </td>\
                        <td onclick="btnver_informes_seguimiento_jugador('+i+');" style="font-weight:bold; text-align: center;">\
                            <div style="max-width: 60px;"><p class="ellipsis-text">'+altura+'</p></div>\
                        </td>\
                        <td onclick="btnver_informes_seguimiento_jugador('+i+');" style="font-weight:bold; text-align: center;">\
                            <div style="max-width: 60px;"><p class="ellipsis-text">'+fechaNacimiento+'</p></div>\
                        </td>\
                        <td onclick="btnver_informes_seguimiento_jugador('+i+');" style="font-weight:bold; text-align: center;">\
                            <div style="max-width: 50px;"><p class="ellipsis-text">'+edad+'</p></div>\
                        </td>\
                        <td onclick="btnver_informes_seguimiento_jugador('+i+');" style="font-weight:bold; text-align: left;">\
                            <div style="max-width: 80px;"><p class="ellipsis-text">'+fechafin_contrato_jugadorclub+'</p></div>\
                        </td>\
                        <td onclick="btnver_informes_seguimiento_jugador('+i+');" style="font-weight:bold; text-align: left;">\
                            <div style="max-width: 60px;"><p class="ellipsis-text">'+pie_habil+'</p></div>\
                        </td>\
                        <td onclick="btnver_informes_seguimiento_jugador('+i+');" style="font-weight:bold; text-align: left;">\
                            <div style="max-width: 85px;">\
                                <p class="ellipsis-text">'+representante_jugadorclub+'</p>\
                            </div>\
                        </td>\
                        <td style="padding: 3px">\
                            <a style="font-size: 15px;" class="boton_editar" onClick="boton_editar_form_jugador('+i+');">\
                                <i style="font-size: 15px;" class="icon-pencil"></i>\
                            </a>\
                        </td>\
                        <td style="padding: 3px">\
                            <a style="font-size: 15px;" class="boton_eliminar" onclick="boton_eliminar_scouting('+i+');">\
                                <i style="font-size: 15px;" class="icon-remove"></i>\
                            </a>\
                        </td>\
                    </tr>\
                    ';
                    $("#tabla_jugadores_seguimiento tbody").append(markup);
                    count = count + 1;
                }

                $('#boton_refresh_jugadores_seguimiento').hide();
            } 
            $('#cargando_buscar_jugadores_seguimiento').hide();
            $('#error_conexion_jugadores_seguimiento').hide();
            $('#sin_resultados_jugadores_seguimiento').hide();
        
        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar_jugadores_seguimiento').hide();
            $('#sin_resultados_jugadores_seguimiento').hide();
            $('#error_conexion_jugadores_seguimiento').show();
            $('#boton_refresh_jugadores_seguimiento').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    });
}
// -------------------- Fin de la función 'buscar_jugadores_seguimiento()' -------------------- //

// -------------------- Inicio de la función 'buscar_entrenadores_seguimiento()' -------------------- // 
function buscar_entrenadores_seguimiento( query ){

    $('#error_conexion_entrenadores_seguimiento').hide();
    $('#sin_resultados_entrenadores_seguimiento').hide();
    $('#cargando_buscar_entrenadores_seguimiento').show();
    $("#tabla_entrenadores_seguimiento tbody").empty(); // <--- Vaciando tabla. 

    let data;
    if( query === 1 ) {

        data = {
            'tipo_consulta': 'get_edadminmax_entrenadores_seguimiento'
        };

    } else {

        let string = $('#nombre_entrenador_cscouting').val();
        let idpais_entrenador_cscouting = $('#idpais_entrenador_cscouting').val();
        let division_entrenador_cscouting = $('#division_entrenador_cscouting').val();
        let idclub_entrenador_cscouting = $('#idclub_entrenador_cscouting').val();
        let nacionalidad_entrenador_cscouting = $('#nacionalidad_entrenador_cscouting').val();
        let min_edad_entrenador_cscouting = $('#min_edad_entrenador_cscouting').val();
        let max_edad_entrenador_cscouting = $('#max_edad_entrenador_cscouting').val();

        data = {
            'tipo_consulta': 'buscar_entrenadores_seguimiento',
            'string': string,
            'idpais_entrenador_cscouting': idpais_entrenador_cscouting,
            'division_entrenador_cscouting': division_entrenador_cscouting,
            'idclub_entrenador_cscouting': idclub_entrenador_cscouting,
            'nacionalidad_entrenador_cscouting': nacionalidad_entrenador_cscouting,
            'min_edad_entrenador_cscouting': min_edad_entrenador_cscouting,
            'max_edad_entrenador_cscouting': max_edad_entrenador_cscouting,
        };

    }

    $.ajax({
        url: "post/scouting_centro_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: data,
        success: function(respuesta){
            // alert(JSON.stringify(respuesta));
            if(respuesta== ""){ //jugador sin informes
                $("#tabla_entrenadores_seguimiento tbody").empty();
                var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td colspan="14"><center><b>No se encontraron entrenadores en seguimiento</b></center></td></tr>';
                $("#tabla_entrenadores_seguimiento tbody").append(markup);
                $('#cargando_buscar_entrenadores_seguimiento').hide();
                $('#sin_resultados_entrenadores_seguimiento').show();
                $('#boton_refresh_entrenadores_seguimiento').hide();
            }else{              
                window.datos_entrenador_club = respuesta; //se copian todos los profesores al cache
                $("#tabla_entrenadores_seguimiento tbody").empty();

                if( query === 1 ) {
                    let min_edad = respuesta[0]['min_edad'];
                    let max_edad = respuesta[0]['max_edad'];

                    $('.mr-edad-entrenador').attr('data-lbound', min_edad);
                    $('.mr-edad-entrenador').attr('data-ubound', max_edad);
                        
                    $('#min_edad_entrenador_cscouting').attr('min', min_edad);
                    $('#min_edad_entrenador_cscouting').attr('max', max_edad);
                    // $('#min_edad_entrenador_cscouting').attr('value', min_edad);

                    //alert( $('#min_edad_entrenador_cscouting').val() );

                    $('#max_edad_entrenador_cscouting').attr('min', min_edad);
                    $('#max_edad_entrenador_cscouting').attr('max', max_edad);
                    // $('#max_edad_entrenador_cscouting').attr('value', max_edad);
                }

                var count = 1;

                for(var i=0; i < respuesta.length; i++){              

                    // Datos del Club:
                    let idclub = parseInt( respuesta[i]['idclub'] );
                    let division_club = parseInt( respuesta[i]['division_club'] );
                    let nombre_club;
                    if( respuesta[i]['nombre_club'] === null || respuesta[i]['nombre_club'] == '' ) {
                        nombre_club = 'No especificado';
                    } else {    
                        nombre_club = respuesta[i]['nombre_club'];
                    }                        
                    let entrenador_club = respuesta[i]['entrenador_club'];

                    let foto_club = './foto_clubes/'+idclub+'.png?lala='+new Date()+'';
                    
                    // Datos del Entrenador:
                    let nombre_completo_entrenador = respuesta[i]['nombre_entrenador'] + " " + respuesta[i]['apellido1_entrenador'] + " " + respuesta[i]['apellido2_entrenador'];
                    
                    let fecha_nacimiento_entrenador;
                    if( respuesta[i]['fecha_nacimiento_entrenador'] == '0000-00-00' || respuesta[i]['fecha_nacimiento_entrenador'] == '' || respuesta[i]['fecha_nacimiento_entrenador'] === null ) {
                        fecha_nacimiento_entrenador = 'No especificada';
                    } else {
                        fecha_nacimiento_entrenador = fecha_formato_ddmmaaa( respuesta[i]['fecha_nacimiento_entrenador'] );
                    }
                    
                    let edad;
                    if( respuesta[i]['fecha_nacimiento_entrenador'] == '0000-00-00' || respuesta[i]['fecha_nacimiento_entrenador'] == '' || respuesta[i]['fecha_nacimiento_entrenador'] === null ) {
                        edad = 'No especificada';
                    } else {
                        edad = calcularEdad( respuesta[i]['fecha_nacimiento_entrenador'] );    
                    }

                    /*
                    let nacionalidad;
                    let num_nacionalidad = parseInt( respuesta[i]['nacionalidad_entrenador'] );
                    if( num_nacionalidad === null || num_nacionalidad == '' || num_nacionalidad == '0' ) {
                        nacionalidad = 'No especificado';
                    } else {
                        nacionalidad = array_paises[num_nacionalidad][1];
                        nacionalidad = nacionalidad.substring(0, 3);   
                        nacionalidad = nacionalidad.toUpperCase();                        
                    }

                    let bandera_nacionalidad = array_paises[num_nacionalidad][2];
                    */

                    let nacionalidad_entrenador = respuesta[i]['nacionalidad_entrenador'];

                    let nacionalidad;
                    if( nacionalidad_entrenador === null || nacionalidad_entrenador == '' || nacionalidad_entrenador == '0' ) {
                        nacionalidad = 'No especificado';
                    } else {
                        nacionalidad = paises_nacionalidad[ respuesta[i]['nacionalidad_entrenador'] ];
                        nacionalidad = nacionalidad.substring(0, 3);   
                        nacionalidad = nacionalidad.toUpperCase();                        
                    }

                    let bandera_nacionalidad;
                    if( nacionalidad_entrenador === null || nacionalidad_entrenador == '' || nacionalidad_entrenador == '0' ) {
                        bandera_nacionalidad = 'src="img/default.png" class="img-nacionalidad-small"';
                    } else {
                        bandera_nacionalidad = 'src="flags/blank.gif" class="flag flag-'+respuesta[i]['nacionalidad_entrenador'].toLowerCase()+'"';
                    }                    

                    let identrenador = respuesta[i]['identrenador'];
                    let foto_entrenador = './foto_entrenadores/'+identrenador+'.png?lala='+new Date()+'';

                    let representante_entrenadorclub;
                    if( respuesta[i]['representante_entrenadorclub'] === null || respuesta[i]['representante_entrenadorclub'] === '' ) {
                        representante_entrenadorclub = 'No especificado';
                    } else {
                        representante_entrenadorclub = respuesta[i]['representante_entrenadorclub'];
                    }

                    let fechafin_contrato_entrenadorclub;
                    if( respuesta[i]['fechafin_contrato_entrenadorclub'] === null || respuesta[i]['fechafin_contrato_entrenadorclub'] === '0000-00-00' || respuesta[i]['fechafin_contrato_entrenadorclub'] == '' ) {
                        fechafin_contrato_entrenadorclub = 'No especificado';
                    } else {
                        fechafin_contrato_entrenadorclub = fecha_formato_ddmmaaa( respuesta[i]['fechafin_contrato_entrenadorclub'] );
                    }
                    
                    var markup = 
                    '<tr class="panel_buscar" style="font-size: 11px;">\
                        <td onclick="boton_editar_form_entrenador('+i+');" style="font-weight:bold;text-align: center;">'+count+'</td>\
                        <td onclick="boton_editar_form_entrenador('+i+');" style="text-align: center;">\
                            <div class="div-club-table" style="text-align: left; max-width: 200px;">\
                                <div class="img-next-to-text"><img src="'+foto_entrenador+'" style="height: 25px; width:26px;"></div>\
                                <div><p class="ellipsis-text" style="position: relative; top: 3px; text-transform: capitalize;">'+nombre_completo_entrenador+'</p></div>\
                            </div>\
                        </td>\
                        <td onclick="boton_editar_form_entrenador('+i+');" style="text-align: left;">\
                            <div class="div-club-table" style="text-align: left; max-width: 130px;">\
                                <div class="img-next-to-text"><img src="'+foto_club+'" style="height: 25px; width:30px;"></div>\
                                <div><p class="ellipsis-text" style="position: relative;left: 7px; top: 3px;">'+nombre_club+'</p></div>\
                            </div>\
                        </td>\
                        <td onclick="boton_editar_form_entrenador('+i+');" style="text-align: left;">\
                            <div class="div-club-table" style="text-align: left;position: relative;left: 5px;">\
                                <div class="img-next-to-text"><img '+bandera_nacionalidad+' /*style="width: 30px;*/"></div>\
                                <div style="max-width: 85px;"><p class="ellipsis-text" style="position: relative; left: 7px; top: 1px;">'+nacionalidad+'</p></div>\
                            </div>\
                        </td>\
                        <td onclick="boton_editar_form_entrenador('+i+');" style="font-weight:bold; text-align: center;">\
                            '+fecha_nacimiento_entrenador+'\
                        </td>\
                        <td onclick="boton_editar_form_entrenador('+i+');" style="font-weight:bold; text-align: center;">\
                            <div style="max-width: 100px;"><p class="ellipsis-text">'+edad+'</p></div>\
                        </td>\
                        <td onclick="boton_editar_form_entrenador('+i+');" style="font-weight:bold; text-align: left;">\
                            '+fechafin_contrato_entrenadorclub+'\
                        </td>\
                        <td onclick="boton_editar_form_entrenador('+i+');" style="font-weight:bold; text-align: left;">\
                            <div style="max-width: 100px;">\
                                <p class="ellipsis-text">'+representante_entrenadorclub+'</p>\
                            </div>\
                        </td>\
                        <td style="padding: 3px">\
                            <a style="font-size: 15px;" class="boton_editar" onclick="boton_editar_form_entrenador('+i+');">\
                                <i style="font-size: 15px;" class="icon-pencil"></i>\
                            </a>\
                        </td>\
                        <td style="padding: 3px">\
                            <a style="font-size: 15px;" class="boton_eliminar" onclick="boton_eliminar_entrenador('+i+');">\
                                <i style="font-size: 15px;" class="icon-remove"></i>\
                            </a>\
                        </td>\
                    </tr>\
                    ';
                    $("#tabla_entrenadores_seguimiento tbody").append(markup);
                    count = count + 1;
                }

                $('#boton_refresh_entrenadores_seguimiento').hide();
            } 
            $('#cargando_buscar_entrenadores_seguimiento').hide();
            $('#error_conexion_entrenadores_seguimiento').hide();
            $('#sin_resultados_entrenadores_seguimiento').hide();
        
        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar_entrenadores_seguimiento').hide();
            $('#sin_resultados_entrenadores_seguimiento').hide();
            $('#error_conexion_entrenadores_seguimiento').show();
            $('#boton_refresh_entrenadores_seguimiento').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    });
}
// -------------------- Fin de la función 'buscar_entrenadores_seguimiento()' -------------------- //

// -------------------------- Inicio de la función 'btn_ir_form_agregarjugador()' --------------------------- //
function btn_ir_form_agregarjugador() {

    window.idfichaJugador = '';
    window.idfichaJugador_club = '';

    // Mostrando por defecto la pestaña 'Datos':
    $('a[href="#tab_form_fichajugador"]').parent().attr('class', 'active');
    $('#tab_form_fichajugador').attr('class', 'tab-pane active');

    /*
    $('a[href="#tab_form_partido"]').parent().attr('class', '');
    */

    // Seleccionando por defecto la primera opción de cada select del formulario #formulario_ficha_jugador:
    $('#formulario_ficha_jugador select').each(function(){
        $(this).prop('selectedIndex', 0);   
    });


    $('a[href="#tab_form_partido"]').parent('li').hide();
    $('#tab_form_partido').attr('class', 'tab-pane');
 
    $('#formulario_partido_jugador').hide(); // <--- Ocultando el formulario // Ocultando el formulario

    // -------------------------------------------- FORMUARLIO DE FICHA DE JUGADOR -------------------------------------------- // 
    $('#foto_anterior_jugador').val(''); // <---- Vaciar - IMPORTANTE.
    $('#foto_jugador').val(''); // <---- Vaciar - IMPORTANTE.    
    // Estableciendo imagen por defecto:
    let foto_jugador = '../config/silueta_jugador.png';

    $('#foto-jugador').attr( 'src', foto_jugador );

    // Vaciando ambos formularios:
    $("#formulario_ficha_jugador")[0].reset();
    $("#formulario_partido_jugador")[0].reset();  

    // Formualario de jugador en club:
    $("#estado_jugadorclub").prop('selectedIndex', 0); // <--- Seleccionando por defecto el primer option del estado del jugador.
    
    // Jugador libre:
    $("#idclub_jugadorlibre").prop('selectedIndex', 0);
    $('#division_club_jugadorlibre_otro').empty().append('<option value="">Seleccione primero una división</option>');

    // Jugador en club:
    $('#idclub_actual_jugadorenclub').empty().append('<option value="">Seleccione primero una división</option>');
    $('#division_club_actual').empty().append('<option value="">Seleccione primero un país</option>');

    $('#cuadro_jugadores_seguimiento').hide(500);
    $('#cuadro_form_agregar_jugador').show(500);

    // Cambiando el color de fonto de los inputs, selects y textareas del formulario id="formulario_ficha_jugador":
    $("#formulario_ficha_jugador input").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    });

    $("#formulario_ficha_jugador select").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    }); 

    $("#formulario_ficha_jugador textarea").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    });     

    // Deshabilitando todos los inputs y selects del formulario id="formulario_partido_jugador" (estarán únicamente habilitados cuando se seleccione el partido a modificar desde la ventana modal):
    $('#formulario_partido_jugador input, #formulario_partido_jugador select').each(function(){
        let thisElement = $(this);
        thisElement.prop('disabled', true).css('background-color', '#cfcccc');
    });

    // Deshabilitando el botón de agregar partido (estará únicamente habilitado cuando se seleccione el partido a modificar desde la ventana modal):
    $('#boton-agregar-partido').prop('disabled', true).css('cursor', 'not-allowed'); // <---- Deshabilitando el botón de guardar partido
    $('#boton-agregar-partido').addClass('boton-agregar-partido-disabled');

    $('#boton_agregar_ficha_jugador').show();
    campos_ficha_jugador(); // <--- Con esta función se muestran los campos según sea el caso.
    calcular_minutos_jugados(); // Calculando la cantidad total de minutos jugados (en caso de que el usuario decida seleccionar el tab 'Partidos').        
    // get_clubes_from_paisdivision(); // <------------- Ejecutando la función 'get_clubes_from_paisdivision()'
    
}
// -------------------------- Fin de la función 'btn_ir_form_agregarjugador()' --------------------------- //

// -------------------------- Inicio de la función 'btn_ir_form_agregar_entrenador()' --------------------------- //
function btn_ir_form_agregar_entrenador() {

    window.identrenador = '';
    window.identrenador_club = '';

    // Mostrando por defecto la pestaña 'Datos':
    $('a[href="#tab_form_entrenador"]').parent().attr('class', 'active');
    $('#tab_form_entrenador').attr('class', 'tab-pane active');

    $('a[href="#tab_form_partido_entrenador"]').parent('li').hide();
    $('#tab_form_partido_entrenador').attr('class', 'tab-pane');
 
    $('#formulario_partido_entrenador').hide(); // <--- Ocultando el formulario // Ocultando el formulario

    // -------------------------------------------- FORMUARLIO DE ENTRENADOR -------------------------------------------- // 
    $('#foto_anterior_entrenador').val(''); // <---- Vaciar - IMPORTANTE.
    $('#foto_entrenador').val(''); // <---- Vaciar - IMPORTANTE.    
    // Estableciendo imagen por defecto:
    let foto_entrenador = '../config/silueta_entrenador.png';

    $('#foto-entrenador').attr( 'src', foto_entrenador );

    // Vaciando ambos formularios:
    $("#formulario_entrenador")[0].reset();
    $("#formulario_partido_entrenador")[0].reset();  

    // Select del club y división del entrenador (Club actual):
    $('#idclub_actual_entrenador').empty().append('<option value="">Seleccione primero una división</option>');
    $('#division_club_actual_entrenador').empty().append('<option value="">Seleccione primero un país</option>');   

    // Select de la división del entrenador (otro club):
    $('#division_club_entrenador_otro').empty().append('<option value="">Seleccione primero un país</option>');        

    $('#cuadro_entrenadores_seguimiento').hide(500);
    $('#cuadro_form_agregar_entrenador').show(500);

    // Cambiando el color de fonto de los inputs, selects y textareas del formulario id="formulario_partido_entrenador":
    $("#formulario_entrenador input").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    });

    $("#formulario_entrenador select").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    }); 

    $("#formulario_entrenador textarea").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    });     

    // -------------------------------------------- FORMUARLIO DE PARTIDOS -------------------------------------------- // 
    // Mostrando el mensaje de registrar entrenadores en el formulario de partidos:
    $('.mensaje_registrarentrenador_formpartido').show();  
    // Nombre del entrenador por defecto (sin registrar):
    $('.nombre-entrenador-partido').html( 'Registre entrenador' );


    // Deshabilitando todos los inputs y selects del formulario id="formulario_partido_entrenador" (estarán únicamente habilitados cuando se seleccione el partido a modificar desde la ventana modal):
    $('#formulario_partido_entrenador input, #formulario_partido_entrenador select').each(function(){
        let thisElement = $(this);
        thisElement.prop('disabled', true).css('background-color', '');
    });

    // Deshabilitando el botón de agregar partido (estará únicamente habilitado cuando se seleccione el partido a modificar desde la ventana modal):
    $('#boton-agregar-partido-entrenador').prop('disabled', true).css('cursor', 'not-allowed'); // <---- Deshabilitando el botón de guardar partido
    $('#boton-agregar-partido-entrenador').addClass('boton-agregar-partido-disabled');

    // Vaciando la tabla de partidos (tabla '.tabla_partidos_jugador')
    $('#tabla_partidos_entrenador tbody').empty();
    let markup = '<tr class="panel_buscar"><td colspan="9" style="text-align: center;"><b>Debe registrar primero al entrenador antes de ingresar partidos</b></td></tr>';
    $('#tabla_partidos_entrenador tbody').append( markup );

    $('#boton_agregar_entrenador').show();   
    campos_entrenador();  

}
// -------------------------- Fin de la función 'btn_ir_form_agregar_entrenador()' --------------------------- //

// -------------------------- Inicio de la función 'btn_ir_form_agregarinforme_seguimiento()' - AGREGAR (INSERT) --------------------------- //
function btn_ir_form_agregarinforme_seguimiento() {

    window.idinforme_cscouting_jugador = '';
    window.tipo_informe_icsj = '';
    window.idinforme_csj_general = '';
    window.idinforme_csj_partido = '';

    $('#cuadro_informes_seguimiento_jugador').hide(500);
    $('#cuadro_form_guardar_informe_seguimento').show(500);
    // Vaciando el formulario:
    $("#form_informe_cscouting_jugador")[0].reset();  
    $('#min_jugados_icsjp_text').html('0 minutos'); // <--- Importante. Cambiar texto
    $('#min_jugados_icsjp').val(''); // <--- Importante. Vaciar    

    let fotoclub = $('.input-hidden-fotoclub').val();
    let fotojugador = $('.input-hidden-fotojugador').val();
    let nombrejugador = $('.input-hidden-nombrejugador').val();
    let apellidojugador = $('.input-hidden-apellidojugador').val();
    

    $('.foto-club-icsj').attr( 'src', fotoclub );
    $('.foto-jugador-icsj').attr( 'src', fotojugador );
    $('.nombre-jugador-icsj').html( nombrejugador );
    $('.apellido-jugador-icsj').html( apellidojugador );

    // Foto y nombre completo del jugador en la tabla de estadísticas de partido scouting:
    $('.foto-jugador-partido').attr( 'src', fotojugador );
    $('.nombre-jugador-partido').html( nombrejugador + " " + apellidojugador );

    // Agregando la foto del club del jugador:
    $('#foto_1_club_jugador_partido_icsjp').attr( 'src', fotoclub );
    $('#foto_2_club_jugador_partido_icsjp').attr( 'src', fotoclub );

    // Agregando la foto del club del rival por defecto:
    $('#foto_1_club_rival_partido_icsjp').attr( 'src', '../config/default.png' );    
    $('#foto_2_club_rival_partido_icsjp').attr( 'src', '../config/default.png' ); 

    select_tipo_informe_scouting_jugador(); // <--- Mostrando por los campos según el option seleccionado del elemento #tipo_informe_icsj
    chequear_datos_form_informe_icsj(); // <--- Validando formulario.

    // Cambiando el color de fonto de los inputs, selects y textareas del formulario id="form_informe_cscouting_jugador":
    $("#form_informe_cscouting_jugador input").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    });

    $("#form_informe_cscouting_jugador select").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    }); 

    $("#form_informe_cscouting_jugador textarea").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    }); 

    // Reiniciando y cambiando de color a inputs y selects del modal para agregar vídeo:
    $('#modal_agregar_video input').each(function(){
        $(this).val('');
        $(this).css("background-color", "white");        
    });

    $('#modal_agregar_video select').each(function(){
        $(this).prop('selectedIndex', 0);
        $(this).css("background-color", "white");        
    });    
    
    // Vaciando tabla de estadísticas:
    $("#tabla_ver_estadisticas_informe tbody").empty();   

    $('.campo-campeonato-otro').hide(); // <--- Importante - Agregado el 18-05-2020
    $('.campo-club-rival-otro').hide(); // <--- Importante - Agregado el 18-05-2020

}
// -------------------------- Fin de la función 'btn_ir_form_agregarinforme_seguimiento()' - AGREGAR (INSERT) --------------------------- //

// -------------------------- Inicio de la función 'btn_ver_detalles_informe( linea )' - EDITAR (UPDATE) --------------------------- //
function btn_ver_detalles_informe( linea ) {
    $('#modal_detalle_informe').modal('show');
    
    // window.idcscouting_jugador = datos_cscouting_jugador[linea]['idcscouting_jugador'];
    window.idinforme_cscouting_jugador = datos_cscouting_jugador[linea]['idinforme_cscouting_jugador'];
    window.tipo_informe_icsj = datos_cscouting_jugador[linea]['tipo_informe_icsj'];
    window.idinforme_csj_general = datos_cscouting_jugador[linea]['idinforme_csj_general'];
    window.idinforme_csj_partido = datos_cscouting_jugador[linea]['idinforme_csj_partido'];

    let recomendacion_icsj = datos_cscouting_jugador[linea]['recomendacion_icsj'];
    switch( recomendacion_icsj ) {
        case '1': // <---- Observar.
            recomendacion_icsj = "Observar";
            break;
        case '2': // <---- Fichar.
            recomendacion_icsj = "Fichar";
            break;
        case '3': // <---- Descartar.
            recomendacion_icsj = "Descartar";
            break;                                
        case '4': // <---- Continuar seguimiento.
            recomendacion_icsj = "Continuar seguimiento";
            break; 

        default:
            recomendacion_icsj = "No especificado";
            break;                                            
    }

    $('#recomendacion_icsj_modal').val( recomendacion_icsj ).prop('disabled', true);

    if( datos_cscouting_jugador[linea]['tipo_informe_icsj'] == '1' ) { // <---- General
        $('#t_informe_partido_detalle_modal').hide();        
        $('#t_informe_general_detalle_modal').show();

        // Insertando datos en los campos:
        $('#aspct_tecnico_icsjg_modal').val( datos_cscouting_jugador[linea]['aspct_tecnico_icsjg'] ).prop('disabled', true);
        $('#aspct_tactico_icsjg_modal').val( datos_cscouting_jugador[linea]['aspct_tactico_icsjg'] ).prop('disabled', true);
        $('#aspct_fisico_icsjg_modal').val( datos_cscouting_jugador[linea]['aspct_fisico_icsjg'] ).prop('disabled', true);
        $('#aspct_psico_icsjg_modal').val( datos_cscouting_jugador[linea]['aspct_psico_icsjg'] ).prop('disabled', true);
        $('#resumen_obsrv_icsjg_modal').val( datos_cscouting_jugador[linea]['resumen_obsrv_icsjg'] ).prop('disabled', true);
        $('#sugerencias_icsjg_modal').val( datos_cscouting_jugador[linea]['sugerencias_icsjg'] ).prop('disabled', true);
        $('#proyeccion_icsjg_modal').val( datos_cscouting_jugador[linea]['proyeccion_icsjg'] ).prop('disabled', true);
        $('#exportacion_icsjg_modal').val( datos_cscouting_jugador[linea]['exportacion_icsjg'] ).prop('disabled', true);        

    } else { // <---- Partido
        $('#t_informe_general_detalle_modal').hide();
        $('#t_informe_partido_detalle_modal').show();

        // Insertando datos en los campos:
        $('#observaciones_generales_icsjp_modal').val( datos_cscouting_jugador[linea]['observaciones_generales_icsjp'] ).prop('disabled', true);
        $('#aspct_ofen_icsjp_modal').val( datos_cscouting_jugador[linea]['aspct_ofen_icsjp'] ).prop('disabled', true);
        $('#aspct_def_icsjp_modal').val( datos_cscouting_jugador[linea]['aspct_def_icsjp'] ).prop('disabled', true);
        $('#aspct_fisico_icsjp_modal').val( datos_cscouting_jugador[linea]['aspct_fisico_icsjp'] ).prop('disabled', true);

    }

}
// -------------------------- Fin de la función 'btn_ver_detalles_informe( linea )' - EDITAR (UPDATE) --------------------------- //

// -------------------------- Inicio de la función 'btneditar_informes_seguimiento_jugador( linea )' - EDITAR (UPDATE) --------------------------- //
function btneditar_informes_seguimiento_jugador( linea ) {
    
    let fotoclub = $('.input-hidden-fotoclub').val();
    let fotojugador = $('.input-hidden-fotojugador').val();
    let nombrejugador = $('.input-hidden-nombrejugador').val();
    let apellidojugador = $('.input-hidden-apellidojugador').val();

    $('.foto-club-icsj').attr( 'src', fotoclub );
    $('.foto-jugador-icsj').attr( 'src', fotojugador );
    $('.nombre-jugador-icsj').html( nombrejugador );
    $('.apellido-jugador-icsj').html( apellidojugador );    
    // Escondiendo los siguientes campos:
    $('.campo-campeonato-otro').hide();
    $('.campo-club-rival-otro').hide();

    // window.idcscouting_jugador = datos_cscouting_jugador[linea]['idcscouting_jugador'];
    window.idinforme_cscouting_jugador = datos_cscouting_jugador[linea]['idinforme_cscouting_jugador'];
    window.tipo_informe_icsj = datos_cscouting_jugador[linea]['tipo_informe_icsj'];
    window.idinforme_csj_general = datos_cscouting_jugador[linea]['idinforme_csj_general'];
    window.idinforme_csj_partido = datos_cscouting_jugador[linea]['idinforme_csj_partido'];

    /*
    alert( "Hello: " + window.idinforme_cscouting_jugador );
    alert( "ID Informe General: " + window.idinforme_csj_general + " - " + "ID Informe de Partido: " + window.idinforme_csj_partido );
    */

    // Foto del club:
    // Agregando la foto del club del jugador:
    $('#foto_1_club_jugador_partido_icsjp').attr( 'src', fotoclub );
    $('#foto_2_club_jugador_partido_icsjp').attr( 'src', fotoclub );

    // Agregando la foto del club del rival:
    let foto_club_rival = 'foto_clubes/' + datos_cscouting_jugador[linea]['idclub_rival'] + '.png?lala='+new Date()+'';
  
    $('#foto_1_club_rival_partido_icsjp').attr( 'src', foto_club_rival );    
    $('#foto_2_club_rival_partido_icsjp').attr( 'src', foto_club_rival ); 
    
    // Datos del jugador:
    // - Nombre:
    $(".nombre-jugador-icsj").html( datos_cscouting_jugador[linea]['nombre'] );
    
    if( datos_cscouting_jugador[linea]['apellido2'] === null ) {
       datos_cscouting_jugador[linea]['apellido2'] = ''; 
    }
    // - Apellido:
    let apellido_jugador = datos_cscouting_jugador[linea]['apellido1'] + " " + datos_cscouting_jugador[linea]['apellido2'];
    $(".apellido-jugador-icsj").html( apellido_jugador );
    
    // Tipo Informe:

    // alert( datos_cscouting_jugador[linea]['tipo_informe_icsj']  + " - " + typeof( datos_cscouting_jugador[linea]['tipo_informe_icsj'] ) );
    $("#tipo_informe_icsj option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_cscouting_jugador[linea]['tipo_informe_icsj'] ) {
            thisElement.prop("selected", true);

            let tipo_informe = thisValue;
            switch( tipo_informe ) {
                case '1': // <----- GENERAL
                    $('#div-form-informe-partido').hide();
                    $('#div-form-informe-general').show();            
                    break;
                case '2': // <----- PARTIDO
                    $('#div-form-informe-general').hide(); 
                    $('#div-form-informe-partido').show();           
                    break;      
                default:
                    $('#div-form-informe-general').hide();
                    $('#div-form-informe-partido').hide();
                    break;
            }            
        } 
    });
 

    // Inputs:
    
    // Fecha:
    $("#fecha_icsj").val( datos_cscouting_jugador[linea]['fecha_icsj'] );
    // Nombre de Informe:
    $("#nombre_icsj").val( datos_cscouting_jugador[linea]['nombre_icsj'] );

    // ------- INFORME GENERAL ------- //
    $("#aspct_tecnico_icsjg").val( datos_cscouting_jugador[linea]['aspct_tecnico_icsjg'] );
    $("#aspct_tactico_icsjg").val( datos_cscouting_jugador[linea]['aspct_tactico_icsjg'] );
    $("#aspct_fisico_icsjg").val( datos_cscouting_jugador[linea]['aspct_fisico_icsjg'] );
    $("#aspct_psico_icsjg").val( datos_cscouting_jugador[linea]['aspct_psico_icsjg'] );
    $("#resumen_obsrv_icsjg").val( datos_cscouting_jugador[linea]['resumen_obsrv_icsjg'] );
    $("#sugerencias_icsjg").val( datos_cscouting_jugador[linea]['sugerencias_icsjg'] );
    $("#proyeccion_icsjg").val( datos_cscouting_jugador[linea]['proyeccion_icsjg'] );
    $("#exportacion_icsjg").val( datos_cscouting_jugador[linea]['exportacion_icsjg'] );


    $("#infp_jornada_icsj").val( datos_cscouting_jugador[linea]['infp_jornada_icsj'] );

    // ------- INFORME DE PARTIDO ------- //

    // Selects:
    // Campeonato:
    // ---------------------- Establecer como selected el campeonato ---------------------- // 
    $("#idcampeonato_icsjp").empty();
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_all_campeonatos',    
        },success: function(respuesta){

            $("#idcampeonato_icsjp").append('<option value="">Seleccione</option>');
            for(var i=0; i < respuesta.length; i++) {   
                $("#idcampeonato_icsjp").append('<option pais-campeonato="'+respuesta[i]['pais_campeonato']+'" value="'+respuesta[i]['idcampeonato']+'">'+respuesta[i]['nombre_campeonato']+'</option>');
            }
            $("#idcampeonato_icsjp").append('<option value="000">Otro</option>');

            $("#idcampeonato_icsjp option").each(function(){
                let thisElement = $(this);
                let thisValue = $(this).val();
                // alert( thisValue );
                if( thisValue == datos_cscouting_jugador[linea]['idcampeonato'] ) {
                    thisElement.prop("selected", true);
                }
            });

        },error: function(){// will fire when timeout is reached
            console.log('Error al consultar campeonatos para el select de campeonatos (partidos de informe scouting)');
        }, timeout: 15000 // sets timeout to 3 seconds
    });


    // Club Rival:
    // alert( datos_cscouting_jugador[linea]['pais_campeonato'] );
    // ---------------------- Establecer como selected el club rival ---------------------- // 
    $("#idclub_rival_icsjp").empty();
    $.ajax({
        url: "post/scouting_centro_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_clubes_from_paiscampeonato_icsjp', // <---- Consultando clubes según el país del campeonato seleccionado.
            'pais_campeonato': datos_cscouting_jugador[linea]['pais_campeonato']   
        },success: function(respuesta){

            $("#idclub_rival_icsjp").append('<option value="">Seleccione</option>');
            for(var i=0; i < respuesta.length; i++) {   
                $("#idclub_rival_icsjp").append('<option value="'+respuesta[i]['idclub']+'">'+respuesta[i]['nombre_club']+'</option>');
            }
            $("#idclub_rival_icsjp").append('<option value="000">Otro</option>');

            $("#idclub_rival_icsjp option").each(function(){
                let thisElement = $(this);
                let thisValue = $(this).val();
                if( thisValue == datos_cscouting_jugador[linea]['idclub_rival'] ) {
                    thisElement.prop("selected", true);
                }
            });
     
        },error: function(){// will fire when timeout is reached
            console.log('Error al consultar clubes para el select de clubes rival (partidos de informe)');
        }, timeout: 15000 // sets timeout to 3 seconds
    });     

    // Fecha del partido:
    $("#fecha_icsjp").val( datos_cscouting_jugador[linea]['fecha_icsjp'] );

    // Temporada:
    $("#temporada_icsjp").val( datos_cscouting_jugador[linea]['temporada_icsjp'] );

    // Jornada:
    $("#jornada_icsjp").val( datos_cscouting_jugador[linea]['jornada_icsjp'] );

    // Posición del jugador:
    $("#posicion_icsjp option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_cscouting_jugador[linea]['posicion_icsjp'] ) {
            thisElement.prop("selected", true);
        }
    });

    // Titular o suplente:
    $("#tit_sup_nc_icsjp option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_cscouting_jugador[linea]['tit_sup_nc_icsjp'] ) {
            thisElement.prop("selected", true);
        }
    });  

    // Tarjetas Amarillas:
    $("#t_amarilla_icsjp").val( datos_cscouting_jugador[linea]['t_amarilla_icsjp'] );
    // Tarjetas Amarillas Dobles:
    $("#t_amarilladb_icsjp").val( datos_cscouting_jugador[linea]['t_amarilladb_icsjp'] ); 
    // Tarjetas Rojas:
    $("#t_roja_icsjp").val( datos_cscouting_jugador[linea]['t_roja_icsjp'] );  
    // Goles convertidos por el jugador:
    $("#num_gol_icsjp").val( datos_cscouting_jugador[linea]['num_gol_icsjp'] );           
    // Minuto de entrada:
    $("#min_entrada_icsjp").val( datos_cscouting_jugador[linea]['min_entrada_icsjp'] );           
    // Minuto de salida:
    $("#min_salida_icsjp").val( datos_cscouting_jugador[linea]['min_salida_icsjp'] );           
    // Minutos jugados:         
    $('#min_jugados_icsjp_text').html( datos_cscouting_jugador[linea]['min_jugados_icsjp'] + ' minutos' );
    $('#min_jugados_icsjp').val( datos_cscouting_jugador[linea]['min_jugados_icsjp'] );

    // Condición:
    switch( datos_cscouting_jugador[linea]['condicion_icsjp'] ) {
        case "1":
            $("#condicion_icsjp_local").prop('checked', true);
            break;
        case "2":
            $("#condicion_icsjp_visita").prop('checked', true);
            break;
        case "3":
            $("#condicion_icsjp_neutral").prop('checked', true);
            break;                                                                     
    }


    // Goles del equipo del jugador:
    $("#golequipo1_icsjp").val( datos_cscouting_jugador[linea]['golequipo1_icsjp'] );  
    // Goles del equipo rival:
    $("#golequipo2_icsjp").val( datos_cscouting_jugador[linea]['golequipo2_icsjp'] ); 
    // Aspectos Generales:
    $("#observaciones_generales_icsjp").val( datos_cscouting_jugador[linea]['observaciones_generales_icsjp'] );  
    // Aspectos Ofensivos:
    $("#aspct_ofen_icsjp").val( datos_cscouting_jugador[linea]['aspct_ofen_icsjp'] );  
    // Aspectos Defensivos:
    $("#aspct_def_icsjp").val( datos_cscouting_jugador[linea]['aspct_def_icsjp'] );  
    // Aspectos Físicos:
    $("#aspct_fisico_icsjp").val( datos_cscouting_jugador[linea]['aspct_fisico_icsjp'] );                      

    // Recomendación
    switch( datos_cscouting_jugador[linea]['recomendacion_icsj'] ) {
        case "1":
            $("#recomendacion_observar").prop('checked', true);
            break;
        case "2":
            $("#recomendacion_fichar").prop('checked', true);
            break;
        case "3":
            $("#recomendacion_descartar").prop('checked', true);
            break;    
        case "4":
            $("#recomendacion_continuar_seguimiento").prop('checked', true);
            break;                                                                    
    }

    // Realizado por:
    $("#realizado_por_icsj  ").val( datos_cscouting_jugador[linea]['realizado_por_icsj  '] );                      


    // Vídeos:
    $('#fecha_video_modal').val( datos_cscouting_jugador[linea]['fecha_video'] );
    $('#servidor_video_modal').val( datos_cscouting_jugador[linea]['servidor_video'] );
    $('#titulo_video_modal').val( datos_cscouting_jugador[linea]['titulo_video'] );
    $('#link_video_modal').val( datos_cscouting_jugador[linea]['link_video'] );
    $('#categoria_video_modal').val( datos_cscouting_jugador[linea]['categoria_video'] );
    $('#sub_categoria_video_modal').val( datos_cscouting_jugador[linea]['sub_categoria_video'] );

    $('#fecha_video').val( datos_cscouting_jugador[linea]['fecha_video'] );

    // Servidor:
    $("#servidor_video option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_cscouting_jugador[linea]['servidor_video'] ) {
            thisElement.prop("selected", true);
        }
    });

    $('#titulo_video').val( datos_cscouting_jugador[linea]['titulo_video'] );
    $('#link_video').val( datos_cscouting_jugador[linea]['link_video'] );


    // Categoría:
    $("#categoria_video option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_cscouting_jugador[linea]['categoria_video'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    // Sub-categoría:
    $("#sub_categoria_video option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_cscouting_jugador[linea]['sub_categoria_video'] ) {
            thisElement.prop("selected", true);
        }
    });  
    
    $('#iframe_video_modal').attr('src', datos_cscouting_jugador[linea]['link_video']);


    // Cargando estadísticas:
    $("#tabla_ver_estadisticas_informe tbody").empty(); // <--- Vaciando tabla.

    // Se insertarán los datos si existen:
    // alert( datos_cscouting_jugador[linea]['estadisticas'] );
    if( datos_cscouting_jugador[linea]['estadisticas'] != null ) {

        // window.idcscouting_jugador = datos_cscouting_jugador[linea]['idcscouting_jugador'];
        let idinforme_cscouting_jugador = datos_cscouting_jugador[linea]['idinforme_cscouting_jugador'];
        let tipo_informe_icsj = datos_cscouting_jugador[linea]['tipo_informe_icsj'];
        let idinforme_csj_general = datos_cscouting_jugador[linea]['idinforme_csj_general'];
        let idinforme_csj_partido = datos_cscouting_jugador[linea]['idinforme_csj_partido'];

        var sums = window.sumUpload;
        for (var i = 0; i < datos_cscouting_jugador[linea]['estadisticas'].length; i++) {

            let idestadistica_informe_csj = datos_cscouting_jugador[linea]['estadisticas'][i]['idestadistica_informe_csj'];
            let descripcion_estadistica_icsj = datos_cscouting_jugador[linea]['estadisticas'][i]['descripcion_estadistica_icsj'];
            let valor_estadistica_icsj = datos_cscouting_jugador[linea]['estadisticas'][i]['valor_estadistica_icsj'];

            let fila = 
            '<tr id="tr_'+sums+'" class="sin_fondo" style="width: 100%">\
                <td class="sin_fondo" style="width: 100%">\
                    <div class="span4" style="display: flex; margin-bottom: 10px; float: left;">\
                        <a class="btn btn-md btn-primary gray-a" style="width: 100px;">Estadística</a>\
                        <input style="width: 600px;" class="gray-input" name="descripcion_estadistica_icsj_update[]" id="descripcion_estadistica_icsj_update_'+sums+'" value="'+descripcion_estadistica_icsj+'" onkeyup="chequear_datos_form_informe_icsj();" onkeydown="chequear_datos_form_informe_icsj();" placeholder="Breve descripción">\
                    </div>\
                    <div class="span4" style="display: flex; margin-bottom: 10px; float: left;">\
                        <a class="btn btn-md btn-primary gray-a" style="width: 100px;">Valor</a>\
                        <input style="width: 800px;" class="gray-input" name="valor_estadistica_icsj_update[]" id="valor_estadistica_icsj_update_'+sums+'" value="'+valor_estadistica_icsj+'" onkeyup="chequear_datos_form_informe_icsj();" onkeydown="chequear_datos_form_informe_icsj();">\
                    </div>\
                    <input type="hidden" name="idestadistica_informe_csj_update[]" value="'+idestadistica_informe_csj+'">\
                    <div style="float: right;">\
                        <a id="borrador'+sums+'" class="boton_eliminar" style="display:inline;cursor: pointer;float: right;" onclick="boton_eliminar_estadistica_informe_scouting('+idestadistica_informe_csj+');">\
                            <i class="icon-remove"></i>\
                        </a>\
                    </div>\
                    <hr style="width: 100%; background-color: #28b779;">\
                </td>\
            </tr>';        
            $("#tabla_ver_estadisticas_informe tbody").append(fila);  
            sums= sums+1;  
        }
        window.sumUpload= sums;
    }

    $('#cuadro_informes_seguimiento_jugador').hide(500);
    $('#cuadro_form_guardar_informe_seguimento').show(500);
    chequear_datos_form_informe_icsj(); // <--- Validando formulario.

    $('.campo-campeonato-otro').hide(); // <--- Importante - Agregado el 18-05-2020
    $('.campo-club-rival-otro').hide(); // <--- Importante - Agregado el 18-05-2020    
}
// -------------------------- Fin de la función 'btneditar_informes_seguimiento_jugador( linea )' - EDITAR (UPDATE) --------------------------- //

// -------------------------- Inicio de la función 'ver_estadisticas_informe()' - EDITAR (UPDATE) --------------------------- //
function ver_estadisticas_informe() {
    
    $.ajax({
        url: "post/scouting_centro_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'ver_estadisticas_informe', // <---- Consultando clubes según el país del campeonato seleccionado.
            'idinforme_cscouting_jugador': window.idinforme_cscouting_jugador   
        },success: function(respuesta){

            // Cargando estadísticas:
            $("#tabla_ver_estadisticas_informe tbody").empty(); // <--- Vaciando tabla.

            // Se insertarán los datos si existen:
            // alert( respuesta[i]['estadisticas'] );
            if( respuesta != '' ) {

                var sums = window.sumUpload;
                for (var i = 0; i < respuesta.length; i++) {

                    let idestadistica_informe_csj = respuesta[i]['idestadistica_informe_csj'];
                    let descripcion_estadistica_icsj = respuesta[i]['descripcion_estadistica_icsj'];
                    let valor_estadistica_icsj = respuesta[i]['valor_estadistica_icsj'];

                    let fila = 
                    '<tr id="tr_'+sums+'" class="sin_fondo" style="width: 100%">\
                        <td class="sin_fondo" style="width: 100%">\
                            <div class="span4" style="display: flex; margin-bottom: 10px; float: left;">\
                                <a class="btn btn-md btn-primary gray-a" style="width: 100px;">Estadística</a>\
                                <input style="width: 600px;" class="gray-input" name="descripcion_estadistica_icsj_update[]" id="descripcion_estadistica_icsj_update_'+sums+'" value="'+descripcion_estadistica_icsj+'" onkeyup="chequear_datos_form_informe_icsj();" onkeydown="chequear_datos_form_informe_icsj();" placeholder="Breve descripción">\
                            </div>\
                            <div class="span4" style="display: flex; margin-bottom: 10px; float: left;">\
                                <a class="btn btn-md btn-primary gray-a" style="width: 100px;">Valor</a>\
                                <input style="width: 800px;" class="gray-input" name="valor_estadistica_icsj_update[]" id="valor_estadistica_icsj_update_'+sums+'" value="'+valor_estadistica_icsj+'" onkeyup="chequear_datos_form_informe_icsj();" onkeydown="chequear_datos_form_informe_icsj();">\
                            </div>\
                            <input type="hidden" name="idestadistica_informe_csj_update[]" value="'+idestadistica_informe_csj+'">\
                            <div style="float: right;">\
                                <a id="borrador'+sums+'" class="boton_eliminar" style="display:inline;cursor: pointer;float: right;" onclick="boton_eliminar_estadistica_informe_scouting('+idestadistica_informe_csj+');">\
                                    <i class="icon-remove"></i>\
                                </a>\
                            </div>\
                            <hr style="width: 100%; background-color: #28b779;">\
                        </td>\
                    </tr>';        
                    $("#tabla_ver_estadisticas_informe tbody").append(fila);  
                    sums= sums+1;  
                }
                window.sumUpload= sums;
                chequear_datos_form_informe_icsj(); // <--- Validando formulario.
            }

                 
        },error: function(){// will fire when timeout is reached
            console.log('Error al consultar las estadísticas del informe Nº: ' + window.idinforme_cscouting_jugador);
        }, timeout: 15000 // sets timeout to 3 seconds
    });     

}
// -------------------------- Fin de la función 'ver_estadisticas_informe()' - EDITAR (UPDATE) --------------------------- //

// -------------------------- Inicio de la función 'boton_eliminar_scouting( linea )' - DELETE --------------------------- //
function boton_eliminar_scouting( linea ){
    window.idcscouting_jugador = datos_jugador_club[linea]['idcscouting_jugador'];
    // alert( datos_jugador_club[linea]['idcscouting_jugador'] );
    $('#modal_eliminar_scouting').modal('show');
    $('#mensaje_eliminar_scouting').html('<h5>¿Estás seguro que quieres eliminar este jugador scouting?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
}
// -------------------------- Fin de la función 'boton_eliminar_scouting( linea )' - DELETE --------------------------- //

// -------------------------- Inicio de la función 'eliminar_scouting()' - DELETE --------------------------- //
function eliminar_scouting() {

     $('.boton_modal').hide();
     $('#mensaje_eliminar_scouting').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando informe...</h5><br><img src="../config/remover_archivo.png">');
     $.ajax({
        url: "post/scouting_centro_eliminar_scouting.php",
        type: "post",
        data: {
            'idcscouting_jugador': window.idcscouting_jugador
        },success: function(respuesta) {
            if(respuesta==1){//eliminado correctamente
                $('#mensaje_eliminar_scouting').html('<h5>Jugador eliminado correctamente!</h5>');
                buscar_jugadores_seguimiento( 1 );
                $('#modal_eliminar_scouting').modal('hide');
            }else{
                $('#mensaje_eliminar_scouting').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> contacte al administrador.</h5>");
            }
            // $('#modal_eliminar_scouting').modal('hide');
        },error: function(){// will fire when timeout is reached
            $('#mensaje_eliminar_scouting').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> compruebe conexión a internet.</h5>");
        }, timeout: 10000 // sets timeout to 3 seconds
      });     
}
// -------------------------- Fin de la función 'eliminar_scouting()' - DELETE --------------------------- //

function boton_guardar(){
    // alert( "ID Informe General: " + window.idinforme_csj_general + " - " + "ID Informe de Partido: " + window.idinforme_csj_partido );
    // alert( window.idcscouting_jugador );
    if (window.idinforme_cscouting_jugador != "" ) {
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }
    

    $('#myModalDescargarBoleta').modal('show');
    $('.boton_modal').css('display','');
}


function guardar_registro(){
    $('.boton_modal').css('display','none');

    // alert( "Yera: " + window.idinforme_cscouting_jugador );
    if(window.idinforme_cscouting_jugador!=""){
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }

    var data = $('#form_informe_cscouting_jugador').serializeArray();
    data.push({name: 'idcscouting_jugador',  value: window.idcscouting_jugador});
    data.push({name: 'idinforme_cscouting_jugador',  value: window.idinforme_cscouting_jugador});
    data.push({name: 'idinforme_csj_general',  value: window.idinforme_csj_general});
    data.push({name: 'idinforme_csj_partido',  value: window.idinforme_csj_partido});
    data.push({name: 'nombre_usuario_software', value: '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>'});
    
    // alert(JSON.stringify(data));
    $.ajax({
        url: "post/scouting_centro_guardar.php",
        type: "post",
        data: data,
        dataType: 'json',
        cache: false,
        success: function(respuesta){
            // alert(respuesta);
            if(respuesta==1){
                buscar_informes_jugador(); // <----- Datos de todos los informes (General y de Partido).
                buscar_informes_partido_jugador(); // <----- Datos de todos los informes de Partido.                
                $('#mensaje_agregar_DescargarBoleta').html('<h4>Registro ingresado correctamente!</h4>');
                $("#cuadro_form_guardar_informe_seguimento").hide(500);
                $("#cuadro_informes_seguimiento_jugador").show(500);
                $('#myModalDescargarBoleta').modal('hide');

            }else if(respuesta==2){
                buscar_informes_jugador(); // <----- Datos de todos los informes (General y de Partido).
                buscar_informes_partido_jugador(); // <----- Datos de todos los informes de Partido.                
                $('#mensaje_agregar_DescargarBoleta').html('<h4>Registro editado correctamente!</h4>');
                $("#cuadro_form_guardar_informe_seguimento").hide(500);
                $("#cuadro_informes_seguimiento_jugador").show(500);
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


// -------------------------- Inicio de la función 'boton_eliminar_informe_scouting( linea )' - DELETE --------------------------- //
function boton_eliminar_informe_scouting( linea ){
    window.idcscouting_jugador = datos_cscouting_jugador[linea]['idcscouting_jugador'];
    window.idinforme_cscouting_jugador = datos_cscouting_jugador[linea]['idinforme_cscouting_jugador'];
    // alert( datos_jugador_club[linea]['idinforme_cscouting_jugador'] );
    $('#modal_eliminar_informe_scouting').modal('show');
    $('#mensaje_eliminar_informe_scouting').html('<h5>¿Estás seguro que quieres eliminar este informe?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
}
// -------------------------- Fin de la función 'boton_eliminar_informe_scouting( linea )' - DELETE --------------------------- //

// -------------------------- Inicio de la función 'eliminar_informe_scouting()' - DELETE --------------------------- //
function eliminar_informe_scouting() {

     $('.boton_modal').hide();
     $('#mensaje_eliminar_informe_scouting').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando informe...</h5><br><img src="../config/remover_archivo.png">');
     $.ajax({
        url: "post/scouting_centro_eliminar_informe.php",
        type: "post",
        data: {
            'idinforme_cscouting_jugador': window.idinforme_cscouting_jugador
        },success: function(respuesta) {
            if(respuesta==1){//eliminado correctamente
            
                $('#mensaje_eliminar_informe_scouting').html('<h5>Informe eliminado correctamente!</h5>');
                buscar_informes_jugador(); // <----- Datos de todos los informes (General y de Partido).
                buscar_informes_partido_jugador(); // <----- Datos de todos los informes de Partido.                
                $('#modal_eliminar_informe_scouting').modal('hide');

            }else{
                $('#mensaje_eliminar_informe_scouting').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> contacte al administrador.</h5>");
            }
            // $('#modal_eliminar_informe_scouting').modal('hide');
        },error: function(){// will fire when timeout is reached
            $('#mensaje_eliminar_informe_scouting').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> compruebe conexión a internet.</h5>");
        }, timeout: 10000 // sets timeout to 3 seconds
      });     
}
// -------------------------- Fin de la función 'eliminar_informe_scouting()' - DELETE --------------------------- //

/*
cuadro_modulo_scouting_main
cuadro_jugadores_seguimiento
cuadro_perfil_jugador_selected
cuadro_form_agregar_jugador
*/

function boton_volver_cuadro_listado_series() {
    $('#cuadro_jugadores_seguimiento').hide(500);
    $('#cuadro_modulo_scouting_main').show(500);
    get_cantidad_jugadores_scouting();
    $('.cuadro_buscar_buscar').show(500);
    $('.cuadro_buscar_titulo').show(500);
    $("#tabla_verEjercicios tbody").empty();
}

function boton_volver_serie_selected_registro_cargas_diarias() {
    $("#tabla_ver_informes_todos tbody").empty(); // <--- Vaciando tabla.
    $('#cuadro_perfil_jugador_selected').hide(500);
    $('#cuadro_jugadores_seguimiento').show(500);
    buscador();
}

function boton_volver_perfil_jugador_selected() {
    $("#tabla_ver_perfil_jugador tbody").empty(); // <--- Vaciando tabla.
    $('#cuadro_form_agregar_jugador').hide(500);
    $('#cuadro_perfil_jugador_selected').show(500);
    buscar_jugadores_seguimiento( 1 ); // <--- Modificación hecha el 28-02-2020.
}

function volver_despues_eliminacion() {
    buscar_jugadores_seguimiento( 1 );
}


// -------------------------- Inicio de la función 'ir_scouting_jugadores()' --------------------------- //
function ir_scouting_jugadores() {
    window.vista_jugador_entrenador = 1; // <---- Jugadores
    $('#cuadro_modulo_scouting_main').hide(500);
    $('#cuadro_jugadores_seguimiento').show(500);   
    buscar_jugadores_seguimiento( 1 );

    // Reiniciando selects de la vista:
    // Código agregado el 17-05-2020 a las 17:27:
    $('#cuadro_jugadores_seguimiento select').each(function() {
        let thisElement = $(this);
        thisElement.prop('selectedIndex', 0);
    });    
}
// -------------------------- Fin de la función 'ir_scouting_jugadores()' --------------------------- //

// -------------------------- Inicio de la función 'ir_scouting_entrenadores()' --------------------------- //
function ir_scouting_entrenadores() {
    window.vista_jugador_entrenador = 2; // <---- Entrenadores
    $('#cuadro_modulo_scouting_main').hide(500);
    $('#cuadro_entrenadores_seguimiento').show(500);   
    buscar_entrenadores_seguimiento( 1 );

    // Reiniciando selects de la vista:
    // Código agregado el 17-05-2020 a las 17:27:
    $('#cuadro_entrenadores_seguimiento select').each(function() {
        let thisElement = $(this);
        thisElement.prop('selectedIndex', 0);
    });         
}
// -------------------------- Fin de la función 'ir_scouting_entrenadores()' --------------------------- //

// -------------------------- Inicio de la función 'boton_volver_cuadro_scouting()' --------------------------- //
function boton_volver_cuadro_scouting() {

    if( window.vista_jugador_entrenador === 1 ) { // <---- Jugadores
        $('#cuadro_jugadores_seguimiento').hide(500);
    } else {
        $('#cuadro_entrenadores_seguimiento').hide(500);
    }
    
    $('#cuadro_modulo_scouting_main').show(500);

    get_cantidad_jugadores_scouting();
    get_cantidad_entrenadores_scouting();

}
// -------------------------- Fin de la función 'boton_volver_cuadro_scouting()' --------------------------- //

// -------------------------- Inicio de la función 'bntvolver_desde_form_jugador()' --------------------------- //
function bntvolver_desde_form_jugador() {
    $('#cuadro_form_agregar_jugador').hide(500);
    $('#cuadro_jugadores_seguimiento').show(500);  

    // Reiniciando selects de la vista:
    // Código agregado el 17-05-2020 a las 17:27:
    $('#cuadro_jugadores_seguimiento select').each(function() {
        let thisElement = $(this);
        thisElement.prop('selectedIndex', 0);
    });     
}
// -------------------------- Fin de la función 'bntvolver_desde_form_jugador()' --------------------------- //

// -------------------------- Inicio de la función 'bntvolver_desde_form_entrenador()' --------------------------- //
function bntvolver_desde_form_entrenador() {
    $('#cuadro_form_agregar_entrenador').hide(500);
    $('#cuadro_entrenadores_seguimiento').show(500); 

    // Reiniciando selects de la vista:
    // Código agregado el 17-05-2020 a las 17:27:
    $('#cuadro_entrenadores_seguimiento select').each(function() {
        let thisElement = $(this);
        thisElement.prop('selectedIndex', 0);
    });           
}
// -------------------------- Fin de la función 'bntvolver_desde_form_entrenador()' --------------------------- //

// -------------------- Inicio de la función 'buscar_informes_jugador()' -------------------- // 
function buscar_informes_jugador() {
    // alert( idcscouting_jugador );
    $('#error_conexion_perfil_jugador').hide();
    $('#sin_resultados').hide();
    $('#cargando_buscar_perfil_jugador').show();
    $("#tabla_informes_seguimiento_jugador tbody").empty(); // <--- Vaciando tabla

    $.ajax({
        url: "post/scouting_centro_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'buscar_informes_jugador',
            'idcscouting_jugador': window.idcscouting_jugador
        },
        success: function(respuesta){
            // alert(JSON.stringify(respuesta));
            if(respuesta== ""){ //jugador sin informes
                $("#tabla_informes_seguimiento_jugador tbody").empty();
                var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td colspan="11"><center><b>Aún no tiene informes</b></center></td></tr>';
                $("#tabla_informes_seguimiento_jugador tbody").append(markup);
                $("#graficos_informes_resumen").hide();
                $('#cargando_buscar_perfil_jugador').hide();
                $('#sin_resultados').show();
                $('#boton_editar').hide();
                $('.boton_refresh').hide();
                $('#boton_agregar_informe_icsj').prop("disabled", true);
            }else{              
                $('#boton_agregar_informe_icsj').prop("disabled", false); // <--- Habilitando el botón de guardar.
                window.datos_cscouting_jugador = respuesta; //se copian todos los profesores al cache
                $("#tabla_informes_seguimiento_jugador tbody").empty();
                var count = 1;

                for(var i=0; i < respuesta.length; i++){              

                    let idinforme_cscouting_jugador = respuesta[i]['idinforme_cscouting_jugador']; 

                    let fecha_icsj;
                    if( respuesta[i]['fecha_icsj'] == '0000-00-00' || respuesta[i]['fecha_icsj'] == '' || respuesta[i]['fecha_icsj'] === null ) {
                        fecha_icsj = '-';
                    } else {
                        fecha_icsj = fecha_formato_ddmmaaa( respuesta[i]['fecha_icsj'] );
                    }
                    
                    let nombre_icsj = respuesta[i]['nombre_icsj'];
                    if( respuesta[i]['nombre_icsj'] === null || respuesta[i]['nombre_icsj'] == '' ) {
                        nombre_icsj = '-';
                    } else {    
                        nombre_icsj = respuesta[i]['nombre_icsj'];
                    }                     

                    let realizado_por_icsj = respuesta[i]['realizado_por_icsj'];
                    
                    let tipo_informe_icsj = respuesta[i]['tipo_informe_icsj'];
                    switch( tipo_informe_icsj ) {
                        case '1': // <---- General.
                            tipo_informe_icsj = "General";
                            break;
                        case '2': // <---- Partido.
                            tipo_informe_icsj = "Partido";
                            break;
                        default: // <---- No especificado.
                            tipo_informe_icsj = "-";
                            break;                             
                    }

                    let recomendacion_icsj = respuesta[i]['recomendacion_icsj'];
                    switch( recomendacion_icsj ) {
                        case '1': // <---- Observar.
                            recomendacion_icsj = "Observar";
                            break;
                        case '2': // <---- Fichar.
                            recomendacion_icsj = "Fichar";
                            break;
                        case '3': // <---- Descartar.
                            recomendacion_icsj = "Descartar";
                            break;                                
                        case '4': // <---- Continuar seguimiento.
                            recomendacion_icsj = "Continuar seguimiento";
                            break;
                        default: // <---- No especificado.
                            recomendacion_icsj = "-";
                            break;                                                                
                    }

                    var markup = 
                    '<tr class="panel_buscar ">\
                        <td onclick="btn_ver_detalles_informe('+i+');" style="font-weight:bold; text-align: left; max-width: 40px; width: 40px;">\
                            <p class="ellipsis-text" style="margin-left: 10px;">'+count+'</p>\
                        </td>\
                        <td onclick="btn_ver_detalles_informe('+i+');" style="text-align: left; max-width: 100px; width: 100px;">\
                            <p class="ellipsis-text">'+fecha_icsj+'</p>\
                        </td>\
                        <td onclick="btn_ver_detalles_informe('+i+');" style="text-align: left; max-width: 300px; width: 300px;">\
                            <p class="ellipsis-text">'+nombre_icsj+'</p>\
                        </td>\
                        <td onclick="btn_ver_detalles_informe('+i+');" class="td-valoracion" style="text-align: left; max-width: 150px; width: 150px;">\
                            <p class="ellipsis-text">'+realizado_por_icsj+'</p>\
                        </td>\
                        <td onclick="btn_ver_detalles_informe('+i+');" class="td-valoracion" style="text-align: left; max-width: 150px; width: 150px;">\
                            <p class="ellipsis-text">'+tipo_informe_icsj+'</p>\
                        </td>\
                        <td onclick="btn_ver_detalles_informe('+i+');" class="td-valoracion" style="text-align: left; max-width: 300px; width: 300px;">\
                            <p class="ellipsis-text">'+recomendacion_icsj+'</p>\
                        </td>\
                        <td class="td-valoracion" style="padding: 7px; width: 9px;">\
                            <a class="boton_add" onclick="descargarPDF('+idinforme_cscouting_jugador+');">\
                                <i class="icon-download-alt"></i>\
                            </a>\
                        </td>\
                        <td class="td-valoracion" style="padding: 7px; width: 9px;">\
                            <a class="boton_editar" onclick="btneditar_informes_seguimiento_jugador('+i+');">\
                                <i class="icon-pencil"></i>\
                            </a>\
                        </td>\
                        <td class="td-valoracion" style="padding: 7px; width: 9px;">\
                            <a class="boton_eliminar" onclick="boton_eliminar_informe_scouting('+i+');">\
                                <i class="icon-remove"></i>\
                            </a>\
                        </td>\
                    </tr>';
                    $("#tabla_informes_seguimiento_jugador tbody").append(markup);
                    count = count + 1;
                }


                // Consultando partidos ingresados en búsqueda:

                $('#boton_agregar').show();
                $('.boton_refresh').hide();
            } 
            $('#cargando_buscar_perfil_jugador').hide();
            $('#error_conexion_perfil_jugador').hide();
            $('#sin_resultados').hide();
        
        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar_perfil_jugador').hide();
            $('#sin_resultados').hide();
            $('#error_conexion_perfil_jugador').show();
            $('#boton_editar').hide();
            $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    });
}
// -------------------- Fin de la función 'buscar_informes_jugador()' -------------------- //

// -------------------- Inicio de la función 'buscar_informes_partido_jugador()' -------------------- // 
function buscar_informes_partido_jugador() {
    // alert( idcscouting_jugador );
    $('#error_conexion_informes_seguimiento').hide();
    $('#sin_resultados_informes_seguimiento').hide();
    $('#cargando_buscar_informes_seguimiento').show();
    $("#tabla_informes_seguimiento_jugador_partidos tbody").empty(); // <--- Vaciando tabla

    var status_query_scouting_busqueda;
    var status_query_scouting_centro;

    // ============================================ INICIO DE FUNCIÓN AJAX QUE CONSULTA PARTIDOS INGRESADOS EN 'BÚSQUEDA' ============================================ //
    $.ajax({
        url: "post/scouting_busqueda_ver.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'buscar_partidos_jugador',
            'idfichaJugador_club': window.idfichaJugador_club    
        },
        success: function(respuesta){
            // alert(JSON.stringify(respuesta));
            if(respuesta== ""){ //jugador sin informes
                status_query_scouting_busqueda = 0; // <--- Vacío
            }else{              
                status_query_scouting_busqueda = 1; // <--- No Vacío
                // window.datos_informe_cscouting_jugador = respuesta; //se copian todos los profesores al cache
                $("#tabla_informes_seguimiento_jugador_partidos tbody").empty();
                var count = 1;
                for(var i=0; i < respuesta.length; i++){


                    let descripcion_serie;

                    if( respuesta[i]['serieActual'] === null || respuesta[i]['serieActual'] == '' || respuesta[i]['serieActual'] == '0' || respuesta[i]['sexo'] === null || respuesta[i]['sexo'] == '' || respuesta[i]['sexo'] == '0' ) {
                        descripcion_serie = '-';
                    } else {
                        let serieActual = respuesta[i]['serieActual'];
                        let sexo = respuesta[i]['sexo'];                        
                        if( serieActual == '99' ) {
                            descripcion_serie = 'Primer Equipo';
                        } else {
                            genero = '';
                            if( sexo == '1' ) {
                            genero = 'Masculina';
                            } else {
                            genero = 'Femenina';
                            }
                            descripcion_serie = 'SUB ' + serieActual + ' ' + genero;
                        }                        
                    }

                    // Tabla 'fichaJugador_partido':
                    let fecha_jugadorpartido;
                    if( respuesta[i]['fecha_jugadorpartido'] == '0000-00-00' || respuesta[i]['fecha_jugadorpartido'] == '' || respuesta[i]['fecha_jugadorpartido'] === null ) {
                        fecha_jugadorpartido = '-';
                    } else {
                        fecha_jugadorpartido = fecha_formato_ddmmaaa( respuesta[i]['fecha_jugadorpartido'] );
                    }                    

                    let jornada_jugadorpartido = respuesta[i]['jornada_jugadorpartido'];
                    
                    let condicion_jugadorpartido = respuesta[i]['condicion_jugadorpartido'];
                    switch( condicion_jugadorpartido ) {
                        case '1': // <---- Local.
                            condicion_jugadorpartido = "Local";
                            break;
                        case '2': // <---- Visita.
                            condicion_jugadorpartido = "Visita";
                            break;
                        case '3': // <---- Neutral.
                            condicion_jugadorpartido = "Neutral";
                            break;
                        default: // <---- No especificado.
                            condicion_jugadorpartido = "-";
                            break;                             
                    }

                    let gol_equipo1_jugadorpartido = respuesta[i]['gol_equipo1_jugadorpartido'];
                    let gol_equipo2_jugadorpartido = respuesta[i]['gol_equipo2_jugadorpartido'];
                    let posicion_jugadorpartido = respuesta[i]['posicion_jugadorpartido'];
                    
                    let tit_sup_nc_jugadorpartido = respuesta[i]['tit_sup_nc_jugadorpartido'];
                    switch( tit_sup_nc_jugadorpartido ) {
                        case '1': // <---- Titular.
                            tit_sup_nc_jugadorpartido = "Titular";
                            break;
                        case '2': // <---- Suplente.
                            tit_sup_nc_jugadorpartido = "Suplente";
                            break;
                        case '3': // <---- No compite.
                            tit_sup_nc_jugadorpartido = "No compite";
                            break;
                        default: // <---- No especificado.
                            tit_sup_nc_jugadorpartido = "-";
                            break;                            
                    }       

                    let min_jugados_jugadorpartido = respuesta[i]['min_jugados_jugadorpartido'];
                    let min_entrada_jugadorpartido = respuesta[i]['min_entrada_jugadorpartido'];
                    let num_gol_jugadorpartido = respuesta[i]['num_gol_jugadorpartido'];
                    let t_amarilla_jugadorpartido = respuesta[i]['t_amarilla_jugadorpartido'];
                    let t_roja_jugadorpartido = respuesta[i]['t_roja_jugadorpartido'];
                    let t_amarilladb_jugadorpartido = respuesta[i]['t_amarilladb_jugadorpartido'];
                    
                    let titutlar_suplente = '';
                    if( tit_sup_nc_jugadorpartido == '2' ) { // <---- Suplente
                        titutlar_suplente = 'Sí';                            
                    } else {
                        // Titular o No compite
                        titutlar_suplente = 'No';
                    }

                    // Tabla 'campeonato':
                    let idcampeonato = respuesta[i]['idcampeonato'];
                    let nombre_campeonato = respuesta[i]['nombre_campeonato'];
                    let foto_campeonato = './foto_campeonatos/'+idcampeonato+'.png?lala='+new Date()+'';

                    // Tabla 't_club_jugador':
                    let idclub_jugador = respuesta[i]['idclub_jugador'];
                    let nombre_club_jugador;
                    if( respuesta[i]['nombre_club_jugador'] === null || respuesta[i]['nombre_club_jugador'] == '' ) {
                        nombre_club_jugador = '-';
                    } else {    
                        nombre_club_jugador = respuesta[i]['nombre_club_jugador'];
                    }  

                    let foto_club_jugador = './foto_clubes/'+idclub_jugador+'.png?lala='+new Date()+'';

                    // Tabla 't_club_rival':
                    let idclub_rival = respuesta[i]['idclub_rival'];
                    
                    let nombre_club_rival;
                    if( respuesta[i]['nombre_club_rival'] === null || respuesta[i]['nombre_club_rival'] == '' ) {
                        nombre_club_rival = '-';
                    } else {    
                        nombre_club_rival = respuesta[i]['nombre_club_rival'];
                    }  

                    let foto_club_rival = './foto_clubes/'+idclub_rival+'.png?lala='+new Date()+'';                     

                    var markup = 
                    '<tr class="panel_buscar ">\
                        <td style="font-weight:bold; text-align: center;">'+descripcion_serie+'</td>\
                        <td style="text-align: center;">\
                            <p class="ellipsis-text">'+fecha_jugadorpartido+'</p>\
                        </td>\
                        <td class="td-valoracion" style="text-align: center; max-width: 100px; width: 100px; text-align: center;">\
                            <div class="div-club-table" style="text-align: left; position: relative; top: -3px;">\
                                <div class="img-next-to-text"><img src="'+foto_club_rival+'"></div>\
                                <div><p class="ellipsis-text" style="position: relative; left: 7px; top: 3px;">'+nombre_club_rival+'</p></div>\
                            </div>\
                        </td>\
                        <td style="text-align: center;">\
                            <p class="ellipsis-text">Campeonato</p>\
                        </td>\
                        <td style="text-align: center;">\
                            <p class="ellipsis-text">'+condicion_jugadorpartido+'</p>\
                        </td>\
                        <td style="text-align: center;">\
                            <p class="ellipsis-text">'+tit_sup_nc_jugadorpartido+'</p>\
                        </td>\
                        <td style="text-align: center;">\
                            <p class="ellipsis-text">'+min_jugados_jugadorpartido+'\'</p>\
                        </td>\
                        <td style="font-weight:bold; text-align: center;">'+t_amarilla_jugadorpartido+'</td>\
                        <td style="font-weight:bold; text-align: center;">'+t_roja_jugadorpartido+'</td>\
                        <td style="font-weight:bold; text-align: center;">'+t_amarilladb_jugadorpartido+'</td>\
                        <td style="font-weight:bold; text-align: center;">'+num_gol_jugadorpartido+'</td>\
                        <td style="font-weight:bold; text-align: center;">'+titutlar_suplente+'</td>\
                        <td class="td-valoracion" style="width: 25px;">\
                            <div style="position: relative; left: 20px;"><img src="'+foto_club_jugador+'" style="width: 25px;"/> '+gol_equipo1_jugadorpartido+' <span>-</span> '+gol_equipo2_jugadorpartido+' <img src="'+foto_club_rival+'" class="img-club" style="width: 25px;"/></div>\
                        </td>\
                    </tr>';
                    $("#tabla_informes_seguimiento_jugador_partidos tbody").append(markup);
                    count = count + 1;
                }

                $('#boton_refresh_informes_seguimiento').hide();
            } 

            $('#cargando_buscar_informes_seguimiento').hide();
            $('#error_conexion_informes_seguimiento').hide();
            $('#sin_resultados_informes_seguimiento').hide();
        
        },
        // Si la consulta de partidos ingresados en búsqueda, se consultan aquellos ingresados en centro: 
        complete:function(){

            // ============================================ INICIO DE FUNCIÓN AJAX QUE CONSULTA PARTIDOS INGRESADOS EN 'CENTRO' ============================================ //
            $.ajax({
                url: "post/scouting_centro_ver.php",
                type: "post",
                dataType: 'json',
                cache: false,
                data: {
                    'tipo_consulta': 'buscar_informes_partido_jugador',
                    'idcscouting_jugador': window.idcscouting_jugador
                },
                success: function(respuesta){
                    // alert(JSON.stringify(respuesta));
                    if(respuesta== ""){ //jugador sin informes
                        status_query_scouting_centro = 0; // <---- Vacío

                        if( status_query_scouting_busqueda === 0 ) {
                            $("#tabla_informes_seguimiento_jugador_partidos tbody").empty(); // Vaciando tabla.
                            var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td colspan="14"><center><b>Aún no tiene partidos registrados</b></center></td></tr>';
                            $("#tabla_informes_seguimiento_jugador_partidos tbody").append(markup);
                            $('#cargando_buscar_informes_seguimiento').hide();
                            $('#sin_resultados_informes_seguimiento').show();
                            $('#boton_refresh_informes_seguimiento').hide();
                            // alert('Vacío');
                        } 
                        /*
                        else {
                            alert('Con datos');
                        }
                        */

                        // alert('Valor de variable "status_query_scouting_busqueda": ' + status_query_scouting_busqueda + ' - Valor de variable "status_query_scouting_centro": ' + status_query_scouting_centro);

                    }else{              
                        status_query_scouting_centro = 1; // <---- No Vacío
                        // window.datos_informe_cscouting_jugador = respuesta; //se copian todos los profesores al cache
                        // $("#tabla_informes_seguimiento_jugador_partidos tbody").empty();
                        var count = 1;

                        for(var i=0; i < respuesta.length; i++){              

                            let descripcion_serie;

                            if( respuesta[i]['serieActual'] === null || respuesta[i]['serieActual'] == '' || respuesta[i]['serieActual'] == '0' || respuesta[i]['sexo'] === null || respuesta[i]['sexo'] == '' || respuesta[i]['sexo'] == '0' ) {
                                descripcion_serie = '-';
                            } else {
                                let serieActual = respuesta[i]['serieActual'];
                                let sexo = respuesta[i]['sexo'];                        
                                if( serieActual == '99' ) {
                                    descripcion_serie = 'Primer Equipo';
                                } else {
                                    genero = '';
                                    if( sexo == '1' ) {
                                    genero = 'Masculina';
                                    } else {
                                    genero = 'Femenina';
                                    }
                                    descripcion_serie = 'SUB ' + serieActual + ' ' + genero;
                                }                        
                            }

                            // Fecha:
                            let fecha_icsjp;
                            if( respuesta[i]['fecha_icsjp'] == '0000-00-00' || respuesta[i]['fecha_icsjp'] == '' || respuesta[i]['fecha_icsjp'] === null ) {
                                fecha_icsjp = '-';
                            } else {
                                fecha_icsjp = fecha_formato_ddmmaaa( respuesta[i]['fecha_icsjp'] );
                            } 

                            // Tipo Partido (agregar campo): 
                            let tipo_partido = 'Campeonato';

                            // Condición:
                            let condicion_icsjp = respuesta[i]['condicion_icsjp'];
                            switch( condicion_icsjp ) {
                                case '1': // <----- Local
                                    condicion_icsjp = 'Local';                        
                                    break;
                                case '2': // <----- Visitante
                                    condicion_icsjp = 'Visitante';            
                                    break;      
                                case '3': // <----- Neutral
                                    condicion_icsjp = 'Neutral';            
                                    break;   
                                default: // <---- No especificado.
                                    condicion_icsjp = "-";
                                    break;                                           
                            }

                            // Titualar/Suplente:
                            let tit_sup_nc_icsjp = respuesta[i]['tit_sup_nc_icsjp'];

                            switch( tit_sup_nc_icsjp ) {
                                case '1': // <---- Titular
                                    tit_sup_nc_icsjp = 'Titular';
                                    break
                                case '2': // <---- Suplente
                                    tit_sup_nc_icsjp = 'Suplente';
                                    break    
                                case '3': // <---- No compite
                                    tit_sup_nc_icsjp = 'No compite';
                                    break 
                                default: // <---- No especificado.
                                    tit_sup_nc_icsjp = "-";
                                    break;
                            }

                            // Minutos Jugados:
                            let min_jugados_icsjp = respuesta[i]['min_jugados_icsjp'];
                            // Tarjetas Amarillas:
                            let t_amarilla_icsjp = respuesta[i]['t_amarilla_icsjp'];
                            // Tarjetas Rojas:
                            let t_roja_icsjp = respuesta[i]['t_roja_icsjp'];
                            // Doble Tarjetas Amarillas:
                            let t_amarilladb_icsjp = respuesta[i]['t_amarilladb_icsjp'];
                            // Goles convertidos por el jugador:
                            let num_gol_icsjp = respuesta[i]['num_gol_icsjp'];

                            // Tabla 't_club_jugador':
                            let idclub_jugador = respuesta[i]['idclub_jugador'];
                            
                            let nombre_club_jugador;                  
                            if( respuesta[i]['nombre_club_jugador'] === null || respuesta[i]['nombre_club_jugador'] == '' ) {
                                nombre_club_jugador = '-';
                            } else {
                                nombre_club_jugador = respuesta[i]['nombre_club_jugador'];
                            }
                            
                            let foto_club_jugador = './foto_clubes/'+idclub_jugador+'.png';

                            // Tabla 't_club_rival':
                            let idclub_rival = respuesta[i]['idclub_rival'];
                            
                            let nombre_club_rival;
                            if( respuesta[i]['nombre_club_rival'] === null || respuesta[i]['nombre_club_rival'] == '' ) {
                                nombre_club_rival = '-';
                            } else {
                                nombre_club_rival = respuesta[i]['nombre_club_rival'];
                            }

                            let foto_club_rival = './foto_clubes/'+idclub_rival+'.png';                                          

                            let titutlar_suplente = '';
                            if( tit_sup_nc_icsjp == '2' ) { // <---- Suplente
                                titutlar_suplente = 'Sí';                            
                            } else {
                                // Titular o No compite
                                titutlar_suplente = 'No';
                            }

                            // Equipo 1 es el equipo del jugador:
                            let golequipo1_icsjp = respuesta[i]['golequipo1_icsjp'];

                            // Equipo 2 es el equipo OPONENTE:
                            let golequipo2_icsjp = respuesta[i]['golequipo2_icsjp'];                        

                            var markup = 
                            '<tr class="panel_buscar ">\
                                <td style="font-weight:bold; text-align: center;">'+descripcion_serie+'</td>\
                                <td style="text-align: center;">\
                                    <p class="ellipsis-text">'+fecha_icsjp+'</p>\
                                </td>\
                                <td class="td-valoracion" style="text-align: center; max-width: 100px; width: 100px; text-align: center;">\
                                    <div class="div-club-table" style="text-align: left; position: relative; top: -3px;">\
                                        <div class="img-next-to-text"><img src="'+foto_club_rival+'"></div>\
                                        <div><p class="ellipsis-text" style="position: relative; left: 7px; top: 3px;">'+nombre_club_rival+'</p></div>\
                                    </div>\
                                </td>\
                                <td style="text-align: center;">\
                                    <p class="ellipsis-text">'+tipo_partido+'</p>\
                                </td>\
                                <td style="text-align: center;">\
                                    <p class="ellipsis-text">'+condicion_icsjp+'</p>\
                                </td>\
                                <td style="text-align: center;">\
                                    <p class="ellipsis-text">'+tit_sup_nc_icsjp+'</p>\
                                </td>\
                                <td style="text-align: center;">\
                                    <p class="ellipsis-text">'+min_jugados_icsjp+'</p>\
                                </td>\
                                <td style="font-weight:bold; text-align: center;">'+t_amarilla_icsjp+'</td>\
                                <td style="font-weight:bold; text-align: center;">'+t_roja_icsjp+'</td>\
                                <td style="font-weight:bold; text-align: center;">'+t_amarilladb_icsjp+'</td>\
                                <td style="font-weight:bold; text-align: center;">'+num_gol_icsjp+'</td>\
                                <td style="font-weight:bold; text-align: center;">'+titutlar_suplente+'</td>\
                                <td class="td-valoracion" style="width: 25px;">\
                                    <div style="position: relative; left: 20px;"><img src="'+foto_club_jugador+'" style="width: 25px;"/> '+golequipo1_icsjp+' <span>-</span> '+golequipo2_icsjp+' <img src="'+foto_club_rival+'" class="img-club" style="width: 25px;"/></div>\
                                </td>\
                            </tr>';
                            $("#tabla_informes_seguimiento_jugador_partidos tbody").append(markup);
                            count = count + 1;
                        }

                        $('#boton_refresh_informes_seguimiento').hide();
                    } 

                    $('#cargando_buscar_informes_seguimiento').hide();
                    $('#error_conexion_informes_seguimiento').hide();
                    $('#sin_resultados_informes_seguimiento').hide();
                
                },error: function(){// will fire when timeout is reached
                    $("#tabla_informes_seguimiento_jugador_partidos tbody").empty(); // <--- Vaciando tabla si ocurre un error
                    $('#cargando_buscar_informes_seguimiento').hide();
                    $('#sin_resultados_informes_seguimiento').hide();
                    $('#error_conexion_informes_seguimiento').show();
                    $('#boton_refresh_informes_seguimiento').show();
                }, timeout: 15000 // sets timeout to 3 seconds
            });
            // ============================================ FIN DE FUNCIÓN AJAX QUE CONSULTA PARTIDOS INGRESADOS EN 'CENTRO' ============================================ //

        },
        error: function(){// will fire when timeout is reached
            $("#tabla_informes_seguimiento_jugador_partidos tbody").empty(); // <--- Vaciando tabla si ocurre un error
            $('#cargando_buscar_informes_seguimiento').hide();
            $('#sin_resultados_informes_seguimiento').hide();
            $('#error_conexion_informes_seguimiento').show();
            $('#boton_refresh_informes_seguimiento').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    });
    // ============================================ FIN DE FUNCIÓN AJAX QUE CONSULTA PARTIDOS INGRESADOS EN 'BÚSQUEDA' ============================================ //

}
// -------------------- Fin de la función 'buscar_informes_partido_jugador()' -------------------- //

// -------------------------- Inicio de la función 'btnver_informes_seguimiento_jugador()' - SELECT --------------------------- //
function btnver_informes_seguimiento_jugador( linea ) {
    
    window.idfichaJugador_club = datos_jugador_club[linea]['idfichaJugador_club'];
    window.idcscouting_jugador = datos_jugador_club[linea]['idcscouting_jugador'];

    window.sexo_jugador = parseInt( datos_jugador_club[linea]['sexo'] );

    // alert( window.idcscouting_jugador );
    if( datos_jugador_club[linea]['apellido2'] == null ) {
        datos_jugador_club[linea]['apellido2'] == "";
    } 

    // ----------------------------------------- BANNER ----------------------------------------- //
    $(".idcscouting_jugador").val( datos_jugador_club[linea]['idcscouting_jugador'] );
    $(".nombre-jugador").html( datos_jugador_club[linea]['nombre'] );    
    $(".apellido-jugador").html( datos_jugador_club[linea]['apellido1'] + " " + datos_jugador_club[linea]['apellido2'] );   

    // Posición:
    let posicion_principal;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_jugador_club[linea]['posicion0'] === null || datos_jugador_club[linea]['posicion0'] == '0' || datos_jugador_club[linea]['posicion0'] == '' ) {
        posicion_principal = 'No especificado';
    } else {
        posicion_principal = parseInt( datos_jugador_club[linea]['posicion0'] );
        posicion_principal = array_posiciones[posicion_principal][1];
    }

    // Pie Hábil:
    let dinamico;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_jugador_club[linea]['dinamico'] === null || datos_jugador_club[linea]['dinamico'] == '0' || datos_jugador_club[linea]['dinamico'] == '' ) {
        dinamico = 'No especificado';
    } else {
        dinamico = parseInt( datos_jugador_club[linea]['dinamico'] );
        dinamico = array_lateralidad[dinamico][1];
    }

    // Edad:
    let edad;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_jugador_club[linea]['fechaNacimiento'] === null || datos_jugador_club[linea]['fechaNacimiento'] == '0000-00-00' || datos_jugador_club[linea]['fechaNacimiento'] == '' ) {
        edad = '0 años (no especificado)';
    } else {
        edad = calcularEdad( datos_jugador_club[linea]['fechaNacimiento'] ) + ' años';
    }

    let datos_jugador = posicion_principal + ', ' + edad;
    // let datos_jugador = edad + " años, " + posicion_principal + ", Pie " + dinamico;

    // Datos del jugador:
    $(".datos-jugador").html( datos_jugador );
    // Foto del jugador:

    let foto_jugador = 'foto_jugadores_scouting/' + datos_jugador_club[linea]['idfichaJugador'] + '.png?lala='+new Date()+'';
    $(".imagen-jugador").attr("src", foto_jugador );
    $('.input-hidden-fotojugador').val( foto_jugador );
    $('.input-hidden-nombrejugador').val( datos_jugador_club[linea]['nombre'] );
    $('.input-hidden-apellidojugador').val( datos_jugador_club[linea]['apellido1'] + " " + datos_jugador_club[linea]['apellido2'] );
    
    // Bandera del país de la nacionalidad:
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):

    // Vaciando los atributos 'src' y 'class':   
    $('.bandera-pais-jugador-banner').attr( 'src', '' );
    $('.bandera-pais-jugador-banner').attr( 'class', 'bandera-pais-jugador-banner' );

    // alert( datos_jugador_club[linea]['codigoNacionalidad1'] );
    if( datos_jugador_club[linea]['codigoNacionalidad1'] === null || datos_jugador_club[linea]['codigoNacionalidad1'] == '0' || datos_jugador_club[linea]['codigoNacionalidad1'] == '' ) {

        $('.bandera-pais-jugador-banner').attr( 'class',  'bandera-pais-jugador-banner' );
        $('.bandera-pais-jugador-banner').attr( "src", '../config/default.png' ).css({
            'width': '16px',
            'height': '11px'
        });

    } else {
        nacionalidad = paises_nacionalidad[ datos_jugador_club[linea]['codigoNacionalidad1'] ];     


        $('.bandera-pais-jugador-banner').attr( 'src', 'flags/blank.gif' ).addClass('flag flag-'+datos_jugador_club[linea]['codigoNacionalidad1'].toLowerCase()+''); // <--- Bandera        
    }

    // $(".bandera-pais-jugador-banner").attr("src", bandera_nacionalidad );
    
    // Altura (Header):
    let altura;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_jugador_club[linea]['altura'] === null || datos_jugador_club[linea]['altura'] == '0' || datos_jugador_club[linea]['altura'] == '' ) {
        altura = '0 cm (no especificado)';
    } else {
        altura = datos_jugador_club[linea]['altura'] + ' cm';
    }

    let fechaNacimiento_ddmmaaa = fecha_formato_ddmmaaa( datos_jugador_club[linea]['fechaNacimiento'] );

    let fecha_nacimiento_edad = '<b>'+fechaNacimiento_ddmmaaa+'</b>' + ' ('+edad+')';

    $('.estatura-banner').html( altura );
    $('.edad-jugador-banner').html( fecha_nacimiento_edad );
    $('.lateralidad-banner').html( dinamico );    


    // Datos del club:
    // Nombre
    let nombre_club;
    if( datos_jugador_club[linea]['nombre_club'] === null || datos_jugador_club[linea]['nombre_club'] == '' ) {
        nombre_club = 'No especificado';
    } else {
        nombre_club = datos_jugador_club[linea]['nombre_club'];
    }
    $(".nombre-club-banner").html( nombre_club );
    
    // Foto
    let foto_club = 'foto_clubes/' + datos_jugador_club[linea]['idclub'] + '.png?lala='+new Date()+'';

    $(".foto-club-banner").attr("src", foto_club );
    $('.input-hidden-fotoclub').val( foto_club );

    // ----------------------------------------- LAS 3 TABLAS POSICIONADAS EN EL MEDIO ----------------------------------------- //
    // Datos generales:
    $('.nombre-t-generales').html( datos_jugador_club[linea]['nombre'] );
    $('.apellido-t-generales').html( datos_jugador_club[linea]['apellido1'] + " " + datos_jugador_club[linea]['apellido2'] );
    $('.fecha-nac-t-generales').html( fechaNacimiento_ddmmaaa );

    // Posición:
    // Principal:
    $('.t-posicion-principal').html( posicion_principal );
    // Secundaria:
    let posicion_secundaria;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    // alert( datos_jugador_club[linea]['posicion1'] );
    if( datos_jugador_club[linea]['posicion1'] === null || typeof datos_jugador_club[linea]['posicion1'] === 'undefined' || datos_jugador_club[linea]['posicion1'] == '0' || datos_jugador_club[linea]['posicion1'] == '' || datos_jugador_club[linea]['posicion1'] == '999' ) {
        posicion_secundaria = 'No especificado';
    } else {
        posicion_secundaria = parseInt( datos_jugador_club[linea]['posicion1'] );
        posicion_secundaria = array_posiciones[posicion_secundaria][1];
    }
    $('.t-posicion-secundaria').html( posicion_secundaria );

    // Datos Adicionales:
    $('.t-add-nacionalidad').html( nacionalidad );

    $('.t-add-lateralidad').html( dinamico );

    let representante_jugadorclub = datos_jugador_club[linea]['representante_jugadorclub'];
    if( representante_jugadorclub == "" || representante_jugadorclub === null ) {
        representante_jugadorclub = 'No informado';
    } 

    $('.t-add-representante').html( representante_jugadorclub );
    // Contrato Profesional:
    let contrato_pro_jugadorclub = parseInt( datos_jugador_club[linea]['contrato_pro_jugadorclub'] );
    if( contrato_pro_jugadorclub === 1 ) { // <---- Sí
        contrato_pro_jugadorclub = 'Sí';
    } else { // <---- No
        contrato_pro_jugadorclub = 'No tiene';
    }    
    // Contrato profesional:
    $('.t-add-contratopro').html( contrato_pro_jugadorclub );
    // Fin del Contrato:
    let fechafin_contrato_jugadorclub = datos_jugador_club[linea]['fechafin_contrato_jugadorclub'];
    if( fechafin_contrato_jugadorclub === null || fechafin_contrato_jugadorclub == '0000-00-00' ) {
        fechafin_contrato_jugadorclub = 'No tiene';
    } else {
        fechafin_contrato_jugadorclub = fecha_formato_ddmmaaa( fechafin_contrato_jugadorclub );
    }    
    $('.t-add-fechafin-contrato').html( fechafin_contrato_jugadorclub );

    // ----------------------------------------- MOSTRANDO Y OCULTANDO VISTAS ----------------------------------------- //
    $('#cuadro_jugadores_seguimiento').hide(500);
    $('#cuadro_informes_seguimiento_jugador').show(500);    

    // ----------------------------------------- EJECUTANDO CONSULTAS ----------------------------------------- //
    buscar_informes_jugador(); // <----- Datos de todos los informes (General y de Partido).
    buscar_informes_partido_jugador(); // <----- Datos de todos los informes de Partido.

}
// -------------------------- Fin de la función 'btnver_informes_seguimiento_jugador()' - SELECT --------------------------- //

// -------------------------- Fin de la función 'boton_volver_cuadro_jugadores_seguimiento()' - SELECT --------------------------- //
function boton_volver_cuadro_jugadores_seguimiento() {
    $('#cuadro_informes_seguimiento_jugador').hide(500);
    $('#cuadro_jugadores_seguimiento').show(500);
}
// -------------------------- Fin de la función 'boton_volver_cuadro_jugadores_seguimiento()' - SELECT --------------------------- //

// -------------------------- Inicio de la función 'btnvolver_cuadro_informes_seguimiento_jugador()' - SELECT --------------------------- //
function btnvolver_cuadro_informes_seguimiento_jugador() {

    buscar_informes_jugador(); // <----- Datos de todos los informes (General y de Partido).
    buscar_informes_partido_jugador(); // <----- Datos de todos los informes de Partido.  
    
    $('#cuadro_form_guardar_informe_seguimento').hide(500);
    $('#cuadro_informes_seguimiento_jugador').show(500);
}
// -------------------------- Fin de la función 'btnvolver_cuadro_informes_seguimiento_jugador()' - SELECT --------------------------- //

// Función que muestra por defecto los campos del informe o de tipo geneal o partido: 
function select_tipo_informe_scouting_jugador() {
    let thisValue = $('#tipo_informe_icsj option:selected').val();
    thisValue = parseInt( thisValue );

    // INFORME GENERAL ('informe_cscouting_jugador.tipo_informe_icsj' = 1):
    if( thisValue === 1 ){
        $('#tabla-evaluacion-jugador').attr('tipo-informe', '1');
        $("#div-form-informe-partido").slideUp("fast");
        $('.texto-tipo-informe').html('Evaluación general del jugador');
    } else {
        // INFORME DE PARTIDO ('informe_cscouting_jugador.tipo_informe_icsj' = 2):
        $("#div-form-informe-general").slideUp("fast");
        $('#tabla-evaluacion-jugador').attr('tipo-informe', '2');
        $('.texto-tipo-informe').html('Partido');        
    }
    $('#tabla-evaluacion-jugador tbody tr').eq(1).removeClass( 'tr-informe-bordered' );
    $('#tabla-evaluacion-jugador tbody tr').eq(1).addClass( 'tr-informe-unbordered' );   

    $('#boton_agregar_informe_icsj').prop('disabled', true); // <------ Deshabilitando el botón #boton_agregar_informe_icsj ya que los campos se esconden. 
}

// Ejecutando la función select_tipo_informe_scouting_jugador() cuando se desencadene en el evento onchange del elemento #tipo_informe_icsj:
$('#tipo_informe_icsj').change(function() {
    select_tipo_informe_scouting_jugador();
});

$('#tr-toggle-informe').click(function(){
    let tipo_informe = $('#tipo_informe_icsj').val();
    tipo_informe = parseInt( tipo_informe );
    // INFORME GENERAL ('informe_cscouting_jugador.tipo_informe_icsj' = 1):
    if( tipo_informe === 1 ){
        $("#div-form-informe-general").slideToggle("fast"); 
        /*
        $("#div-form-informe-partido").slideUp("fast");
        $("#div-form-informe-general").slideDown("fast");
        */
        $('.texto-tipo-informe').html('Evaluación general del jugador');
    } else {
        // INFORME DE PARTIDO ('informe_cscouting_jugador.tipo_informe_icsj' = 2):
        $("#div-form-informe-partido").slideToggle("fast");
        /*
        $("#div-form-informe-general").slideUp("fast");
        $("#div-form-informe-partido").slideDown("fast");
        */
        $('.texto-tipo-informe').html('Partido');        
    }
    $('#tabla-evaluacion-jugador tbody tr').eq(1).toggleClass( 'tr-informe-unbordered' );
    // $('#tabla-evaluacion-jugador tbody tr').eq(1).removeClass( 'tr-informe-unbordered' );
    //$('#tabla-evaluacion-jugador tbody tr').eq(1).addClass( 'tr-informe-bordered' );
    chequear_datos_form_informe_icsj(); // <------ Ejecutando validación otra vez ya que los campos anteriormente fueron escondidos.
});

// ------------------------------ Inicio de la función 'chequear_datos_form_informe_icsj()' ------------------------------ // 
function chequear_datos_form_informe_icsj(){
    // alert('Estoy validando...');
    // var ER_numericosDecimales = /^([0-9]*|(\d+))(\.\d{1,2})?$/;
    var ER_numericosDecimales = /^([0-9]*|(\d+))((.|,)\d{1,})?$/;
    var ER_numericosEnteros = /[0-9]/;
    var ER_caracteresAlfaNumericos = /^[a-zA-ZáàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜñÑ 0-9,.-_¿?¡!$%#()]*$/;
    flag = true;
        
    /*
    #ffc6c6 <--- Color rosado.
    #d4ffdc <--- Color verde.
    */

    // Tipo de Informe:
    // OBLIGATORIO
    let tipo_informe_icsj = $("#tipo_informe_icsj").val();
    if( tipo_informe_icsj == "" ) {
        $("#tipo_informe_icsj").css("background-color", "white");
        // flag = false;
    } else {
        $("#tipo_informe_icsj").css("background-color", "white");
    }

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    let nombre_icsj = $("#nombre_icsj").val();
    if( nombre_icsj != "" ) {
        if( nombre_icsj.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_icsj.length) >= 1 && parseInt(nombre_icsj.length) <= 150 ) ) {
            $("#nombre_icsj").css("background-color", "white");
        } else {
            $("#nombre_icsj").css("background-color", "white");
            flag = false;
            // alert('x');
        }
    } else {
        $("#nombre_icsj").css("background-color", "white");
        // flag = false;
        // alert('y');
    }

    // Fecha del Informe:
    // ------------------------------------------------------------------------ //
    let fecha_icsj = $("#fecha_icsj").val();
    if( fecha_icsj == "" ) {
        $("#fecha_icsj").css("background-color", "white");
        // flag = false;
    } else {
        $("#fecha_icsj").css("background-color", "white");
    }

    // ----------------------------------- CAMPOS PARA EL INFORME GENERAL ----------------------------------- //
    // Aplicando validación solamente si el campo es visible:
    if($("#aspct_tecnico_icsjg").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let aspct_tecnico_icsjg = $("#aspct_tecnico_icsjg").val();
        if( aspct_tecnico_icsjg != "" ) {
            if( aspct_tecnico_icsjg.match(ER_caracteresAlfaNumericos) && ( parseInt(aspct_tecnico_icsjg.length) >= 1 && parseInt(aspct_tecnico_icsjg.length) <= 2000 ) ) {
                $("#aspct_tecnico_icsjg").css("background-color", "white");
            } else {
                $("#aspct_tecnico_icsjg").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#aspct_tecnico_icsjg").css("background-color", "white");
            // flag = false;
        }
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#aspct_tactico_icsjg").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let aspct_tactico_icsjg = $("#aspct_tactico_icsjg").val();
        if( aspct_tactico_icsjg != "" ) {
            if( aspct_tactico_icsjg.match(ER_caracteresAlfaNumericos) && ( parseInt(aspct_tactico_icsjg.length) >= 1 && parseInt(aspct_tactico_icsjg.length) <= 2000 ) ) {
                $("#aspct_tactico_icsjg").css("background-color", "white");
            } else {
                $("#aspct_tactico_icsjg").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#aspct_tactico_icsjg").css("background-color", "white");
            // flag = false;
        }
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#aspct_fisico_icsjg").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let aspct_fisico_icsjg = $("#aspct_fisico_icsjg").val();
        if( aspct_fisico_icsjg != "" ) {
            if( aspct_fisico_icsjg.match(ER_caracteresAlfaNumericos) && ( parseInt(aspct_fisico_icsjg.length) >= 1 && parseInt(aspct_fisico_icsjg.length) <= 2000 ) ) {
                $("#aspct_fisico_icsjg").css("background-color", "white");
            } else {
                $("#aspct_fisico_icsjg").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#aspct_fisico_icsjg").css("background-color", "white");
            // flag = false;
        }
    } 
    
    // Aplicando validación solamente si el campo es visible:
    if($("#aspct_psico_icsjg").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let aspct_psico_icsjg = $("#aspct_psico_icsjg").val();
        if( aspct_psico_icsjg != "" ) {
            if( aspct_psico_icsjg.match(ER_caracteresAlfaNumericos) && ( parseInt(aspct_psico_icsjg.length) >= 1 && parseInt(aspct_psico_icsjg.length) <= 2000 ) ) {
                $("#aspct_psico_icsjg").css("background-color", "white");
            } else {
                $("#aspct_psico_icsjg").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#aspct_psico_icsjg").css("background-color", "white");
            // flag = false;
        }
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#resumen_obsrv_icsjg").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let resumen_obsrv_icsjg = $("#resumen_obsrv_icsjg").val();
        if( resumen_obsrv_icsjg != "" ) {
            if( resumen_obsrv_icsjg.match(ER_caracteresAlfaNumericos) && ( parseInt(resumen_obsrv_icsjg.length) >= 1 && parseInt(resumen_obsrv_icsjg.length) <= 2000 ) ) {
                $("#resumen_obsrv_icsjg").css("background-color", "white");
            } else {
                $("#resumen_obsrv_icsjg").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#resumen_obsrv_icsjg").css("background-color", "white");
            // flag = false;
        }
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#sugerencias_icsjg").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let sugerencias_icsjg = $("#sugerencias_icsjg").val();
        if( sugerencias_icsjg != "" ) {
            if( sugerencias_icsjg.match(ER_caracteresAlfaNumericos) && ( parseInt(sugerencias_icsjg.length) >= 1 && parseInt(sugerencias_icsjg.length) <= 2000 ) ) {
                $("#sugerencias_icsjg").css("background-color", "white");
            } else {
                $("#sugerencias_icsjg").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#sugerencias_icsjg").css("background-color", "white");
            // flag = false;
        }
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#proyeccion_icsjg").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let proyeccion_icsjg = $("#proyeccion_icsjg").val();
        if( proyeccion_icsjg != "" ) {
            if( proyeccion_icsjg.match(ER_caracteresAlfaNumericos) && ( parseInt(proyeccion_icsjg.length) >= 1 && parseInt(proyeccion_icsjg.length) <= 2000 ) ) {
                $("#proyeccion_icsjg").css("background-color", "white");
            } else {
                $("#proyeccion_icsjg").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#proyeccion_icsjg").css("background-color", "white");
            // flag = false;
        }
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#exportacion_icsjg").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let exportacion_icsjg = $("#exportacion_icsjg").val();
        if( exportacion_icsjg != "" ) {
            if( exportacion_icsjg.match(ER_caracteresAlfaNumericos) && ( parseInt(exportacion_icsjg.length) >= 1 && parseInt(exportacion_icsjg.length) <= 2000 ) ) {
                $("#exportacion_icsjg").css("background-color", "white");
            } else {
                $("#exportacion_icsjg").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#exportacion_icsjg").css("background-color", "white");
            // flag = false;
        }
    }                            

    // ----------------------------------- CAMPOS PARA EL INFORME DE PARTIDO ----------------------------------- //
        
    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("#fecha_icsjp").is(":visible")) {
        let fecha_icsjp = $("#fecha_icsjp").val();
        if( fecha_icsjp == "" ) {
            $("#fecha_icsjp").css("background-color", "white");
            // flag = false;
        } else {
            $("#fecha_icsjp").css("background-color", "white");
        }  
    }

    // ------------------------------------------------------------------------ //
    // Campeonato:
    // OBLIGATORIO
    // Aplicando validación solamente si el campo es visible:
    if($("#idcampeonato_icsjp").is(":visible")) {
        let idcampeonato_icsjp = $("#idcampeonato_icsjp").val();
        if( idcampeonato_icsjp == "" ) {
            $("#idcampeonato_icsjp").css("background-color", "white");
            // flag = false;
        } else {
            $("#idcampeonato_icsjp").css("background-color", "white");
        }        
    }   
       
    // Datos del campeonato (otro):
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("#pais_campeonato_otro_icsjp").is(":visible")) {
        // alert("El campo es visible.");
        // OBLIGATORIO
        let pais_campeonato_otro_icsjp = $("#pais_campeonato_otro_icsjp").val();
        if( pais_campeonato_otro_icsjp == "" ) {
            $("#pais_campeonato_otro_icsjp").css("background-color", "white");
            // flag = false;
        } else {
            $("#pais_campeonato_otro_icsjp").css("background-color", "white");
        }   
    } 
    
    // Aplicando validación solamente si el campo es visible:
    if($("#division_campeonato_otro_icsjp").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let division_campeonato_otro_icsjp = $("#division_campeonato_otro_icsjp").val();
        if( division_campeonato_otro_icsjp == "" ) {
            $("#division_campeonato_otro_icsjp").css("background-color", "white");
            // flag = false;
        } else {
            $("#division_campeonato_otro_icsjp").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#nombre_campeonato_otro_icsjp").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let nombre_campeonato_otro_icsjp = $("#nombre_campeonato_otro_icsjp").val();
        if( nombre_campeonato_otro_icsjp != "" ) {
            if( nombre_campeonato_otro_icsjp.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_campeonato_otro_icsjp.length) >= 1 && parseInt(nombre_campeonato_otro_icsjp.length) <= 150 ) ) {
                $("#nombre_campeonato_otro_icsjp").css("background-color", "white");
            } else {
                $("#nombre_campeonato_otro_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#nombre_campeonato_otro_icsjp").css("background-color", "white");
            // flag = false;
        }
    }    

    // Aplicando validación solamente si el campo es visible:
    if($("#organizador_campeonato_otro_icsjp").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let organizador_campeonato_otro_icsjp = $("#organizador_campeonato_otro_icsjp").val();
        if( organizador_campeonato_otro_icsjp != "" ) {
            if( organizador_campeonato_otro_icsjp.match(ER_caracteresAlfaNumericos) && ( parseInt(organizador_campeonato_otro_icsjp.length) >= 1 && parseInt(organizador_campeonato_otro_icsjp.length) <= 150 ) ) {
                $("#organizador_campeonato_otro_icsjp").css("background-color", "white");
            } else {
                $("#organizador_campeonato_otro_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#organizador_campeonato_otro_icsjp").css("background-color", "white");
            // flag = false;
        }       
    }    

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    // Aplicando validación solamente si el campo es visible:
    if($("#jornada_icsjp").is(":visible")) {
        let jornada_icsjp = $("#jornada_icsjp").val();
        if( jornada_icsjp != "" ) {
            if( jornada_icsjp.match(ER_caracteresAlfaNumericos) && ( parseInt(jornada_icsjp.length) >= 1 && parseInt(jornada_icsjp.length) <= 150 ) ) {
                $("#jornada_icsjp").css("background-color", "white");
            } else {
                $("#jornada_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#jornada_icsjp").css("background-color", "white");
            // flag = false;
        }        
    }
     
    // Club rival:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("#idclub_rival_icsjp").is(":visible")) {
        let idclub_rival_icsjp = $("#idclub_rival_icsjp").val();
        if( idclub_rival_icsjp == "" ) {
            $("#idclub_rival_icsjp").css("background-color", "white");
            // flag = false;
        } else {
            $("#idclub_rival_icsjp").css("background-color", "white");
        } 
    }  

    // Datos del club rival (otro):

    // Aplicando validación solamente si el campo es visible:
    if($("#pais_club_rival_otro_icsjp").is(":visible")) {
        // Datos del club actual (otro):
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let pais_club_rival_otro_icsjp = $("#pais_club_rival_otro_icsjp").val();
        if( pais_club_rival_otro_icsjp == "" ) {
            $("#pais_club_rival_otro_icsjp").css("background-color", "white");
            // flag = false;
        } else {
            $("#pais_club_rival_otro_icsjp").css("background-color", "white");
        }       
    }   

    // Aplicando validación solamente si el campo es visible:
    if($("#division_club_rival_otro_icsjp").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let division_club_rival_otro_icsjp = $("#division_club_rival_otro_icsjp").val();
        if( division_club_rival_otro_icsjp == "" ) {
            $("#division_club_rival_otro_icsjp").css("background-color", "white");
            // flag = false;
        } else {
            $("#division_club_rival_otro_icsjp").css("background-color", "white");
        }       
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#nombre_club_rival_otro_icsjp").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let nombre_club_rival_otro_icsjp = $("#nombre_club_rival_otro_icsjp").val();
        if( nombre_club_rival_otro_icsjp != "" ) {
            if( nombre_club_rival_otro_icsjp.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_club_rival_otro_icsjp.length) >= 1 && parseInt(nombre_club_rival_otro_icsjp.length) <= 150 ) ) {
                $("#nombre_club_rival_otro_icsjp").css("background-color", "white");
            } else {
                $("#nombre_club_rival_otro_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#nombre_club_rival_otro_icsjp").css("background-color", "white");
            // flag = false;
        }       
    }    

    // Aplicando validación solamente si el campo es visible:
    if($("#entrenador_club_rival_otro_icsjp").is(":visible")) {
        // OBLIGATORIO
        // ------------------------------------------------------------------------ //
        let entrenador_club_rival_otro_icsjp = $("#entrenador_club_rival_otro_icsjp").val();
        if( entrenador_club_rival_otro_icsjp != "" ) {
            if( entrenador_club_rival_otro_icsjp.match(ER_caracteresAlfaNumericos) && ( parseInt(entrenador_club_rival_otro_icsjp.length) >= 1 && parseInt(entrenador_club_rival_otro_icsjp.length) <= 150 ) ) {
                $("#entrenador_club_rival_otro_icsjp").css("background-color", "white");
            } else {
                $("#entrenador_club_rival_otro_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#entrenador_club_rival_otro_icsjp").css("background-color", "white");
            // flag = false;
        }       
    }    

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    // Aplicando validación solamente si el campo es visible:
    if($("#posicion_icsjp").is(":visible")) {
        let posicion_icsjp = $("#posicion_icsjp").val();
        if( posicion_icsjp == "" ) {
            $("#posicion_icsjp").css("background-color", "white");
            // flag = false;
        } else {
            $("#posicion_icsjp").css("background-color", "white");
        }
    }

    // ------------------------------------------------------------------------ //
    // OBLIGATORIO
    // Aplicando validación solamente si el campo es visible:
    if($("#tit_sup_nc_icsjp").is(":visible")) {
        let tit_sup_nc_icsjp = $("#tit_sup_nc_icsjp").val();
        if( tit_sup_nc_icsjp == "" ) {
            $("#tit_sup_nc_icsjp").css("background-color", "white");
            // flag = false;
        } else {
            $("#tit_sup_nc_icsjp").css("background-color", "white");
        } 
    }    


    // Condición del equipo en el partido:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("input:radio[name='condicion_icsjp']").is(":visible")) {
        if( $("input:radio[name='condicion_icsjp']:checked").length === 0 ) {
            // flag = false;
        } 
    }

    // Datos de goles del partido:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("#golequipo1_icsjp").is(":visible")) {
        let golequipo1_icsjp = $("#golequipo1_icsjp").val();
        if( golequipo1_icsjp != "" ) {
            if( golequipo1_icsjp.match(ER_numericosEnteros) && ( parseInt(golequipo1_icsjp.length) >= 1 && parseInt(golequipo1_icsjp.length) <= 2 ) ) {      
                $("#golequipo1_icsjp").css("background-color", "white");
            } else {
                $("#golequipo1_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#golequipo1_icsjp").css("background-color", "white");
            // flag = false;
        }        
    }    
 
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("#golequipo2_icsjp").is(":visible")) {
        let golequipo2_icsjp = $("#golequipo2_icsjp").val();
        if( golequipo2_icsjp != "" ) {
            if( golequipo2_icsjp.match(ER_numericosEnteros) && ( parseInt(golequipo2_icsjp.length) >= 1 && parseInt(golequipo2_icsjp.length) <= 2 ) ) {      
                $("#golequipo2_icsjp").css("background-color", "white");
            } else {
                $("#golequipo2_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#golequipo2_icsjp").css("background-color", "white");
            // flag = false;
        } 
    }         

    // Datos del jugador con respecto a tarjetas, goles y minutos:
    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("#t_amarilla_icsjp").is(":visible")) {
        let t_amarilla_icsjp = $("#t_amarilla_icsjp").val();
        if( t_amarilla_icsjp != "" ) {
            if( t_amarilla_icsjp.match(ER_numericosEnteros) && parseInt(t_amarilla_icsjp.length) === 1 ) {      
                $("#t_amarilla_icsjp").css("background-color", "white");
            } else {
                $("#t_amarilla_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#t_amarilla_icsjp").css("background-color", "white");
            // flag = false;
        }
    }    

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //  
    // Aplicando validación solamente si el campo es visible:
    if($("#t_amarilladb_icsjp").is(":visible")) {
        let t_amarilladb_icsjp = $("#t_amarilladb_icsjp").val();
        if( t_amarilladb_icsjp != "" ) {
            if( t_amarilladb_icsjp.match(ER_numericosEnteros) && parseInt(t_amarilladb_icsjp.length) === 1 ) {      
                $("#t_amarilladb_icsjp").css("background-color", "white");
            } else {
                $("#t_amarilladb_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#t_amarilladb_icsjp").css("background-color", "white");
            // flag = false;
        } 
    }  

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("#t_roja_icsjp").is(":visible")) {
        let t_roja_icsjp = $("#t_roja_icsjp").val();
        if( t_roja_icsjp != "" ) {
            if( t_roja_icsjp.match(ER_numericosEnteros) && parseInt(t_roja_icsjp.length) === 1 ) {      
                $("#t_roja_icsjp").css("background-color", "white");
            } else {
                $("#t_roja_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#t_roja_icsjp").css("background-color", "white");
            // flag = false;
        }
    } 

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("#num_gol_icsjp").is(":visible")) {
        let num_gol_icsjp = $("#num_gol_icsjp").val();
        if( num_gol_icsjp != "" ) {
            if( num_gol_icsjp.match(ER_numericosEnteros) && ( parseInt(num_gol_icsjp.length) >= 1 && parseInt(num_gol_icsjp.length) <= 2 ) ) {      
                $("#num_gol_icsjp").css("background-color", "white");
            } else {
                $("#num_gol_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#num_gol_icsjp").css("background-color", "white");
            // flag = false;
        }        
    }    


    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("#min_entrada_icsjp").is(":visible")) {
        let min_entrada_icsjp = $("#min_entrada_icsjp").val();
        // Validando que no esté vacío:
        if( min_entrada_icsjp != "" ) {
            // Validando que sea un número entero y que la longitud sea entre 1 y 3.
            if( min_entrada_icsjp.match(ER_numericosEnteros) && ( parseInt(min_entrada_icsjp.length) >= 1 && parseInt(min_entrada_icsjp.length) <= 3 ) ) {      

                // Validando que el minuto de entrada sea menor al minuto de salida:
                // Valor del minuto de salida.
                let min_salida_icsjp = $("#min_salida_icsjp").val();

                // Convirtiendo tipo de dato a entero:
                min_entrada_icsjp = parseInt( min_entrada_icsjp );
                min_salida_icsjp = parseInt( min_salida_icsjp );

                if( min_entrada_icsjp < min_salida_icsjp ) {
                    $("#min_entrada_icsjp").css({
                        "background-color": "white",
                        "color": "black",
                    });
                } else {
                    $("#min_entrada_icsjp").css("background-color", "white");
                    // flag = false;   
                    // alert('Error 1');           
                }

            } else {
                $("#min_entrada_icsjp").css("background-color", "white");
                // flag = false;
                // alert('Error 2');
            }
        } else {
            $("#min_entrada_icsjp").css("background-color", "white");
            // flag = false;
            // alert('Error 3');
        }        
    } 


    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("#min_salida_icsjp").is(":visible")) {
        let min_salida_icsjp = $("#min_salida_icsjp").val();
        // Validando que no esté vacío:
        if( min_salida_icsjp != "" ) {
            // Validando que sea un número entero y que la longitud sea entre 1 y 3.
            if( min_salida_icsjp.match(ER_numericosEnteros) && ( parseInt(min_salida_icsjp.length) >= 1 && parseInt(min_salida_icsjp.length) <= 2 ) ) {

                // Validando que el minuto de salida sea mayor al minuto de entrada:
                // Valor del minuto de entrada.
                let min_entrada_icsjp = $("#min_entrada_icsjp").val();

                // Convirtiendo tipo de dato a entero:
                min_entrada_icsjp = parseInt( min_entrada_icsjp );
                min_salida_icsjp = parseInt( min_salida_icsjp );

                if( min_salida_icsjp > min_entrada_icsjp ) {
                    $("#min_salida_icsjp").css("background-color", "white");
                } else {
                    $("#min_salida_icsjp").css("background-color", "white");
                    // flag = false;               
                    // alert('Error 4');
                }           
            
            } else {
                $("#min_salida_icsjp").css("background-color", "white");
                // flag = false;
                // alert('Error 5');
            }
        } else {
            $("#min_salida_icsjp").css("background-color", "white");
            // flag = false;
            // alert('Error 6');
        }        
    }

    // OBLIGATORIO
    // ------------------------------------------------------------------------ //
    // Aplicando validación solamente si el campo es visible:
    if($("#min_jugados_icsjp").is(":visible")) {
        let min_jugados_icsjp = $("#min_jugados_icsjp").val();
        // Validando que no esté vacío:
        if( min_jugados_icsjp != "" ) {
            // Validando que sea un número entero y que la longitud sea entre 1 y 3.
            if( min_jugados_icsjp.match(ER_numericosEnteros) && ( parseInt(min_jugados_icsjp.length) >= 1 && parseInt(min_jugados_icsjp.length) <= 3 ) ) {      

                // Validando que la cantidad de minutos jugados sea el resultado de la diferencia (resta) entre el minuto de salida y el minuto de entrada:
                // Valor del minuto de salida:
                let min_salida_icsjp = parseInt( $("#min_salida_icsjp").val() );
                // Valor del minuto de entrada:
                let min_entrada_icsjp = parseInt( $("#min_entrada_icsjp").val() );                        

                // Diferencia (resta) entre el minuto de salida y el minuto de entrada:
                let min_total_jugados = min_salida_icsjp - min_entrada_icsjp;

                // alert( min_jugados_icsjp + ' - ' + min_total_jugados )

                // min_jugados_icsjp <--- Valor del input:
                min_jugados_icsjp = parseInt( min_jugados_icsjp ); // <--- Hay que convertirlo en número entero para ejecutar correctamente la comparación.
                if( min_jugados_icsjp === min_total_jugados ) {
                    $("#min_jugados_icsjp").css("background-color", "white");
                } else {
                    $("#min_jugados_icsjp").css("background-color", "white");
                    // flag = false;   
                    // alert('Error 7');           
                }

            } else {
                $("#min_jugados_icsjp").css("background-color", "white");
                // flag = false;
                // alert('Error 8');
            }
        } else {
            $("#min_jugados_icsjp").css("background-color", "white");
            // flag = false;
            // alert('Error 9');
        }
    }           

    // Aplicando validación solamente si el campo es visible:
    if($("#observaciones_generales_icsjp").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let observaciones_generales_icsjp = $("#observaciones_generales_icsjp").val();
        if( observaciones_generales_icsjp != "" ) {
            if( observaciones_generales_icsjp.match(ER_caracteresAlfaNumericos) && ( parseInt(observaciones_generales_icsjp.length) >= 1 && parseInt(observaciones_generales_icsjp.length) <= 2000 ) ) {
                $("#observaciones_generales_icsjp").css("background-color", "white");
            } else {
                $("#observaciones_generales_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#observaciones_generales_icsjp").css("background-color", "white");
            // flag = false;
        }
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#aspct_ofen_icsjp").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let aspct_ofen_icsjp = $("#aspct_ofen_icsjp").val();
        if( aspct_ofen_icsjp != "" ) {
            if( aspct_ofen_icsjp.match(ER_caracteresAlfaNumericos) && ( parseInt(aspct_ofen_icsjp.length) >= 1 && parseInt(aspct_ofen_icsjp.length) <= 2000 ) ) {
                $("#aspct_ofen_icsjp").css("background-color", "white");
            } else {
                $("#aspct_ofen_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#aspct_ofen_icsjp").css("background-color", "white");
            // flag = false;
        }
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#aspct_def_icsjp").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let aspct_def_icsjp = $("#aspct_def_icsjp").val();
        if( aspct_def_icsjp != "" ) {
            if( aspct_def_icsjp.match(ER_caracteresAlfaNumericos) && ( parseInt(aspct_def_icsjp.length) >= 1 && parseInt(aspct_def_icsjp.length) <= 2000 ) ) {
                $("#aspct_def_icsjp").css("background-color", "white");
            } else {
                $("#aspct_def_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#aspct_def_icsjp").css("background-color", "white");
            // flag = false;
        }
    }

    // Aplicando validación solamente si el campo es visible:
    if($("#aspct_fisico_icsjp").is(":visible")) {
        // ------------------------------------------------------------------------ //
        // OBLIGATORIO
        let aspct_fisico_icsjp = $("#aspct_fisico_icsjp").val();
        if( aspct_fisico_icsjp != "" ) {
            if( aspct_fisico_icsjp.match(ER_caracteresAlfaNumericos) && ( parseInt(aspct_fisico_icsjp.length) >= 1 && parseInt(aspct_fisico_icsjp.length) <= 2000 ) ) {
                $("#aspct_fisico_icsjp").css("background-color", "white");
            } else {
                $("#aspct_fisico_icsjp").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#aspct_fisico_icsjp").css("background-color", "white");
            // flag = false;
        }
    }            

    // --------------- CAMPOS PARA EL VÍDEO --------------- //
    // ------------------------------------------------------------------------ //
    let fecha_video_modal = $("#fecha_video_modal").val();
    if( fecha_video_modal == "" ) {
        $("#fecha_video_modal").css("background-color", "white");
        // flag = false;
    } else {
        $("#fecha_video_modal").css("background-color", "white");
    }

    // ------------------------------------------------------------------------ //
    let servidor_video_modal = $("#servidor_video_modal").val();
    if( servidor_video_modal != "" ) {
        if( servidor_video_modal.match(ER_caracteresAlfaNumericos) && ( parseInt(servidor_video_modal.length) >= 1 && parseInt(servidor_video_modal.length) <= 150 ) ) {
            $("#servidor_video_modal").css("background-color", "white");
        } else {
            $("#servidor_video_modal").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#servidor_video_modal").css("background-color", "white");
        // flag = false;
    }

    // ------------------------------------------------------------------------ //
    let titulo_video_modal = $("#titulo_video_modal").val();
    if( titulo_video_modal != "" ) {
        if( titulo_video_modal.match(ER_caracteresAlfaNumericos) && ( parseInt(titulo_video_modal.length) >= 1 && parseInt(titulo_video_modal.length) <= 150 ) ) {
            $("#titulo_video_modal").css("background-color", "white");
        } else {
            $("#titulo_video_modal").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#titulo_video_modal").css("background-color", "white");
        // flag = false;
    }

    // ------------------------------------------------------------------------ //
    let link_video_modal = $("#link_video_modal").val();
    if( link_video_modal != "" ) {
        if( link_video_modal.match(ER_caracteresAlfaNumericos) && ( parseInt(link_video_modal.length) >= 1 && parseInt(link_video_modal.length) <= 150 ) ) {
            $("#link_video_modal").css("background-color", "white");
        } else {
            $("#link_video_modal").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#link_video_modal").css("background-color", "white");
        // flag = false;
    }    

    // ------------------------------------------------------------------------ //
    let categoria_video_modal = $("#categoria_video_modal").val();
    if( categoria_video_modal == "" ) {
        $("#categoria_video_modal").css("background-color", "white");
        // flag = false;
    } else {
        $("#categoria_video_modal").css("background-color", "white");
    }

    // ------------------------------------------------------------------------ //
    let sub_categoria_video_modal = $("#sub_categoria_video_modal").val();
    if( sub_categoria_video_modal == "" ) {
        $("#sub_categoria_video_modal").css("background-color", "white");
        // flag = false;
    } else {
        $("#sub_categoria_video_modal").css("background-color", "white");
    }    

    // --------------- RECOMENDACIÓN --------------- // 
    if( $("input:radio[name='recomendacion_icsj']:checked").length === 0 ) {
        // flag = false;
    } else {
        // Verificando cuál tipo de informe actualmente se encuentra seleccionado:
        let tipo_informe_icsj = $('#tipo_informe_icsj').val();
        if( tipo_informe_icsj == '1' ) { // <--- GENERAL

            // Evitando que el botón esté habilitado usando algunos de los inputs relacionados al informe de GENERAL. Usaremos el campo #aspct_tecnico_icsjg como ejemplo::
            if($("#aspct_tecnico_icsjg").is(":visible")) {
               console.log('true - GENERAL'); 
            } else {
                flag = false;
                // alert('Inhabilitando botón - GENERAL');
            }

        } else { // <--- PARTIDO
            // Evitando que el botón esté habilitado usando algunos de los inputs relacionados al informe de PARTIDO. Usaremos el campo #idcampeonato_icsjp como ejemplo::
            if($("#idcampeonato_icsjp").is(":visible")) {
               console.log('true - PARTIDO'); 
            } else {
                flag = false;
                // alert('Inhabilitando botón - PARTIDO');
            }
        }
    }
        // VISIBILIDAD DE LAS PESTAÑAS:
    // Verificando cuál tipo de informe actualmente se encuentra seleccionado:
    /*
    if( $('#tipo_informe_icsj').val() == '1' ) { // <--- GENERAL

        if($("#div-form-informe-general").is(":visible")) {
           console.log('Visible'); 
        } else {
            flag = false;
            // alert('Inhabilitando botón - GENERAL');
        }

    } else { // <--- PARTIDO

        if($("#div-form-informe-partido").is(":visible")) {
           console.log('Visible'); 
        } else {
            flag = false;
            // alert('Inhabilitando botón - GENERAL');
        } 

    }    
    */

    // alert('Bandera:' + flag);
    
    if( flag === false ){
        $('#boton_agregar_informe_icsj').prop("disabled", true);
        // $('#boton_agregar_informe_icsj').addClass('boton-agregar-partido-disabled');
    }else{
        $('#boton_agregar_informe_icsj').prop("disabled", false);
        // $('#boton_agregar_informe_icsj').addClass('boton-agregar-partido-enabled');
    }
    

}
// ------------------------------ Fin de la función 'chequear_datos_form_informe_icsj()' ------------------------------ //

// --------------------- Inicio del a función agregarRenglon() --------------------- //
function agregarRenglon(){
    // $('#boton_agregar_informe_icsj').prop("disabled", true);

    var sums = window.sumUpload;

    var fila = 
    '<tr id="tr_'+sums+'" class="sin_fondo" style="width: 100%">\
        <td class="sin_fondo" style="width: 100%">\
            <div class="span4" style="display: flex; margin-bottom: 10px; float: left;">\
                <a class="btn btn-md btn-primary gray-a" style="width: 100px;">Estadística</a>\
                <input style="width: 600px;" class="gray-input" name="descripcion_estadistica_icsj_insert[]" id="descripcion_estadistica_icsj_insert_'+sums+'" onkeyup="chequear_datos_form_informe_icsj();" onkeydown="chequear_datos_form_informe_icsj();" placeholder="Breve descripción">\
            </div>\
            <div class="span4" style="display: flex; margin-bottom: 10px; float: left;">\
                <a class="btn btn-md btn-primary gray-a" style="width: 100px;">Valor</a>\
                <input style="width: 800px;" class="gray-input" name="valor_estadistica_icsj_insert[]" id="valor_estadistica_icsj_insert_'+sums+'" onkeyup="chequear_datos_form_informe_icsj();" onkeydown="chequear_datos_form_informe_icsj();">\
            </div>\
            <div style="float: right;">\
                <a id="borrador'+sums+'" class="boton_eliminar" style="display:inline;cursor: pointer;float: right;" onclick="boton_eliminarFilas_Dom('+sums+');">\
                    <i class="icon-remove"></i>\
                </a>\
            </div>\
            <hr style="width: 100%; background-color: #28b779;">\
        </td>\
    </tr>';

    $("#tabla_ver_estadisticas_informe tbody").append(fila);

    // $('#boton_agregar_informe_icsj').attr('disabled', true);
    
    for (var i = 0; i < sums; i++) {
        if ($("#borrador_"+i) == $("#borrador_"+sums)) {
            $("#borrador_"+i).show();
        }else{
            $("#borrador_"+i).hide();
        }
    }
    
    sums= sums+1;
    window.sumUpload= sums;
}
// --------------------- Fin del a función agregarRenglon() --------------------- //
    
// --------------------- Inicio del a función boton_eliminarFilas_Dom() --------------------- //
function boton_eliminarFilas_Dom(id){
    $("#tr_"+id).remove();
    /*
    var numeral = parseInt(id)-1;
    var inputFileImage = document.getElementById("archivoImage"+numeral);
    var descripcion = $("#ingresar_descripcion"+numeral).val();
    //Validaciones
    if(inputFileImage.files.length == 0 ){
        $('#boton_agregar_proveedor').attr('disabled', true);
    }
    if (descripcion == '' ){
        $('#boton_agregar_proveedor').attr('disabled', true);   
    }
    
    var resta = window.sumUpload;
    resta = parseInt(resta) - 1;
    var ids = parseInt(id)-1;
    window.sumUpload = resta;
    $("#borrador_"+ids).show();
    
    var data = new FormData();
    data.append('id',id);
    var url = "post/kine_eliminar_imagen.php";
    $.ajax({
        url:url,
        type:'POST',
        contentType:false,
        data:data,
        processData:false,
        cache:false,
        success: function(respuesta){
            window.archivos.splice(id,1);
        },error: function(){// will fire when timeout is reached
            $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }
    });
    chequear_datos_form_informe_icsj();
    */
}
// --------------------- Fin del a función boton_eliminarFilas_Dom() --------------------- //

// -------------------------- Inicio de la función 'boton_eliminar_estadistica_informe_scouting( linea )' - DELETE --------------------------- //
function boton_eliminar_estadistica_informe_scouting( idestadistica_informe_csj ){
    
    window.idestadistica_informe_csj = idestadistica_informe_csj;
    
    // alert( window.idestadistica_informe_csj );
    $('#modal_eliminar_estadistica_informe_scouting').modal('show');
    $('#mensaje_eliminar_estadistica_informe_scouting').html('<h5>¿Estás seguro que quieres eliminar esta estadística?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
}

// -------------------------- Inicio de la función 'eliminar_estadistica_informe_scouting()' - DELETE --------------------------- //
function eliminar_estadistica_informe_scouting() {

     $('.boton_modal').hide();
     $('#mensaje_eliminar_estadistica_informe_scouting').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando estadística...</h5><br><img src="../config/remover_archivo.png">');
     $.ajax({
        url: "post/scouting_centro_eliminar_estadistica_informe.php",
        type: "post",
        data: {
            'idestadistica_informe_csj': window.idestadistica_informe_csj
        },success: function(respuesta) {
            if(respuesta==1){//eliminado correctamente
            
                $('#mensaje_eliminar_estadistica_informe_scouting').html('<h5>Estadística eliminada correctamente!</h5>');
                ver_estadisticas_informe();              
                $('#modal_eliminar_estadistica_informe_scouting').modal('hide');

            }else{
                $('#mensaje_eliminar_estadistica_informe_scouting').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> contacte al administrador.</h5>");
            }
            // $('#modal_eliminar_estadistica_informe').modal('hide');
        },error: function(){// will fire when timeout is reached
            $('#mensaje_eliminar_estadistica_informe_scouting').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> compruebe conexión a internet.</h5>");
        }, timeout: 10000 // sets timeout to 3 seconds
      });     
}
// -------------------------- Fin de la función 'eliminar_estadistica_informe_scouting()' - DELETE --------------------------- //

// ******************************************************************************************************************************************************************************************************************************************* FIN DE FUNCIONES DEL MÓDULO 'CENTRO DE SCOUTING' ******************************************************************************************************************************************************************************************************************************************* //


function closeModal_pdf(){
    $("#descargarPDF").modal('hide');
}

// --------------------------------------- Inicio de la función descargarPDF() --------------------------------------- //
function descargarPDF( idinforme_cscouting_jugador ){

// alert( sexo_seleccion_reporte );

$("#descargarPDF").modal('show');
$('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');

    $.ajax({
        url: "post/reportes/generarPDF_scouting_centro_informe.php",
        type: "post",
        data: {
            'idinforme_cscouting_jugador': idinforme_cscouting_jugador
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

</script>

<script src="subir_imagen3/croppie.js"></script>
<link rel="stylesheet" href="subir_imagen3/croppie.css" />
<script>  

// --------------------------------  Subiendo imagen al jugador -------------------------------- //
$image_crop_jugador = $('#image_demo_jugador').croppie({
    
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:300,
      height:300
    }
});

// Evento onchange desencadenado al seleccionar foto del jugador:
$('#foto_jugador').on('change', function(){
  // alert("0");
   $('.boton_modal').show();
  if(subir_imagen_jugador()==4){ //subir
      var reader = new FileReader();
      reader.onload = function (event) {
        $image_crop_jugador.croppie('bind', {
          url: event.target.result
        }).then(function(){
          console.log('jQuery bind complete');
        });
      }
      reader.readAsDataURL(this.files[0]);
      $('#uploadImageModalJugador').modal('show');
  }
});

$('#crop_image_jugador').click(function(event){
  //alert("1");
  //$('.imagen_subir_jugador').hide();
  $('.boton_modal').hide();
  $('.texto_subir_jugador').html("<br><h3 style='color:white;'><i class='icon-spinner icon-spin icon-large'></i> Subiendo imagen...</h3><br><br><br>");
  $('.texto_subir_jugador').show();
    $image_crop_jugador.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
          $('.imagen_subir_jugador').hide();
          $.ajax({
            url:"subir_imagen3/upload.php",
            type: "POST",
            data:{"image": response},
            success:function(data){
              window.error_foto=2; //copiar la camiseta
              $('#foto-jugador').attr('src', data+'?lala='+new Date());
              $('.imagen_subir_jugador').show();
              $('.texto_subir_jugador').hide();
              $('#uploadImageModalJugador').modal('hide');
            },error: function(){// will fire when timeout is reached
                $('.texto_subir_jugador').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
                $('.boton_modal').show();
            }, timeout: 15000 // sets timeout to 3 seconds
          });
      
    })
});

// --------------------------------  Subiendo imagen al entrenador -------------------------------- //
$image_crop_entrenador = $('#image_demo_entrenador').croppie({
    
    enableExif: true,
    viewport: {
      width:200,
      height:200,
      type:'square' //circle
    },
    boundary:{
      width:300,
      height:300
    }
});

// Evento onchange desencadenado al seleccionar foto del entrenador:
$('#foto_entrenador').on('change', function(){
  // alert("0");
   $('.boton_modal').show();
  if(subir_imagen_entrenador()==4){ //subir
      var reader = new FileReader();
      reader.onload = function (event) {
        $image_crop_entrenador.croppie('bind', {
          url: event.target.result
        }).then(function(){
          console.log('jQuery bind complete - entrenador');
        });
      }
      reader.readAsDataURL(this.files[0]);
      $('#uploadImageModalEntrenador').modal('show');
  }
});

$('#crop_image_entrenador').click(function(event){
  //alert("1");
  //$('.imagen_subir_entrenador').hide();
  $('.boton_modal').hide();
  $('.texto_subir_entrenador').html("<br><h3 style='color:white;'><i class='icon-spinner icon-spin icon-large'></i> Subiendo imagen...</h3><br><br><br>");
  $('.texto_subir_entrenador').show();
    $image_crop_entrenador.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
          $('.imagen_subir_entrenador').hide();
          $.ajax({
            url:"subir_imagen3/upload.php",
            type: "POST",
            data:{"image": response},
            success:function(data){
              window.error_foto=2; //copiar la camiseta
              $('#foto-entrenador').attr('src', data+'?lala='+new Date());
              $('.imagen_subir_entrenador').show();
              $('.texto_subir_entrenador').hide();
              $('#uploadImageModalEntrenador').modal('hide');
            },error: function(){// will fire when timeout is reached
                $('.texto_subir_entrenador').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
                $('.boton_modal').show();
            }, timeout: 15000 // sets timeout to 3 seconds
          });
      
    })
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

    $('.date-picker').datetimepicker({
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

    // ============================================ AGREGANDO VALORES DE ARRAYS A LOS SELECTS ============================================ // 

    // --------------------- Agregando los valores del array de las divisiones a select(s) --------------------- //
    // FILTRO DE BÚSQUEDA:
    /*
    for (var i = 0; i < array_divisiones.length; i++) {
        $(".select-division-filtro-busqueda").append('<option value="'+array_divisiones[i][0]+'">'+array_divisiones[i][1]+'</option>');
    }
    // FORMULARIO:
    for (var i = 0; i < array_divisiones.length; i++) {
        if( i === 0 ){
            array_divisiones[i][0] = '';
            array_divisiones[i][1] = 'Seleccione';
        }        
        $(".select-division-form").append('<option value="'+array_divisiones[i][0]+'">'+array_divisiones[i][1]+'</option>');
    } 
    */

    // --------------------- Agregando los valores de países a select(s) --------------------- //
    var paises = 
    '<option value="af">Afganistán</option>\
    <option value="al">Albania</option>\
    <option value="de">Alemania</option>\
    <option value="ad">Andorra</option>\
    <option value="ao">Angola</option>\
    <option value="ai">Anguilla</option>\
    <option value="aq">Antártida</option>\
    <option value="ag">Antigua y Barbuda</option>\
    <option value="an">Antillas Holandesas</option>\
    <option value="sa">Arabia Saudí</option>\
    <option value="dz">Argelia</option>\
    <option value="ar">Argentina</option>\
    <option value="am">Armenia</option>\
    <option value="aw">Aruba</option>\
    <option value="au">Australia</option>\
    <option value="at">Austria</option>\
    <option value="az">Azerbaiyán</option>\
    <option value="bs">Bahamas</option>\
    <option value="bh">Bahrein</option>\
    <option value="bd">Bangladesh</option>\
    <option value="bb">Barbados</option>\
    <option value="be">Bélgica</option>\
    <option value="bz">Belice</option>\
    <option value="bj">Benin</option>\
    <option value="bm">Bermudas</option>\
    <option value="by">Bielorrusia</option>\
    <option value="mm">Birmania</option>\
    <option value="bo">Bolivia</option>\
    <option value="ba">Bosnia y Herzegovina</option>\
    <option value="bw">Botswana</option>\
    <option value="br">Brasil</option>\
    <option value="bn">Brunei</option>\
    <option value="bg">Bulgaria</option>\
    <option value="bf">Burkina Faso</option>\
    <option value="bi">Burundi</option>\
    <option value="bt">Bután</option>\
    <option value="cv">Cabo Verde</option>\
    <option value="kh">Camboya</option>\
    <option value="cm">Camerún</option>\
    <option value="ca">Canadá</option>\
    <option value="td">Chad</option>\
    <option value="cl">Chile</option>\
    <option value="cn">China</option>\
    <option value="cy">Chipre</option>\
    <option value="va">Ciudad del Vaticano (Santa Sede)</option>\
    <option value="co">Colombia</option>\
    <option value="km">Comores</option>\
    <option value="cg">Congo</option>\
    <option value="cd">Congo, República Democrática del</option>\
    <option value="kr">Corea</option>\
    <option value="kp">Corea del Norte</option>\
    <option value="ci">Costa de Marfíl</option>\
    <option value="cr">Costa Rica</option>\
    <option value="hr">Croacia (Hrvatska)</option>\
    <option value="cu">Cuba</option>\
    <option value="dk">Dinamarca</option>\
    <option value="dj">Djibouti</option>\
    <option value="dm">Dominica</option>\
    <option value="ec">Ecuador</option>\
    <option value="eg">Egipto</option>\
    <option value="sv">El Salvador</option>\
    <option value="ae">Emiratos Árabes Unidos</option>\
    <option value="er">Eritrea</option>\
    <option value="si">Eslovenia</option>\
    <option value="es">España</option>\
    <option value="us">Estados Unidos</option>\
    <option value="ee">Estonia</option>\
    <option value="et">Etiopía</option>\
    <option value="fj">Fiji</option>\
    <option value="ph">Filipinas</option>\
    <option value="fi">Finlandia</option>\
    <option value="fr">Francia</option>\
    <option value="ga">Gabón</option>\
    <option value="gm">Gambia</option>\
    <option value="ge">Georgia</option>\
    <option value="gh">Ghana</option>\
    <option value="gi">Gibraltar</option>\
    <option value="gd">Granada</option>\
    <option value="gr">Grecia</option>\
    <option value="gl">Groenlandia</option>\
    <option value="gp">Guadalupe</option>\
    <option value="gu">Guam</option>\
    <option value="gt">Guatemala</option>\
    <option value="gy">Guayana</option>\
    <option value="gf">Guayana Francesa</option>\
    <option value="gn">Guinea</option>\
    <option value="gq">Guinea Ecuatorial</option>\
    <option value="gw">Guinea-Bissau</option>\
    <option value="ht">Haití</option>\
    <option value="hn">Honduras</option>\
    <option value="hu">Hungría</option>\
    <option value="in">India</option>\
    <option value="id">Indonesia</option>\
    <option value="iq">Irak</option>\
    <option value="ir">Irán</option>\
    <option value="ie">Irlanda</option>\
    <option value="bv">Isla Bouvet</option>\
    <option value="cx">Isla de Christmas</option>\
    <option value="is">Islandia</option>\
    <option value="ky">Islas Caimán</option>\
    <option value="ck">Islas Cook</option>\
    <option value="cc">Islas de Cocos o Keeling</option>\
    <option value="fo">Islas Faroe</option>\
    <option value="hm">Islas Heard y McDonald</option>\
    <option value="fk">Islas Malvinas</option>\
    <option value="mp">Islas Marianas del Norte</option>\
    <option value="mh">Islas Marshall</option>\
    <option value="um">Islas menores de Estados Unidos</option>\
    <option value="pw">Islas Palau</option>\
    <option value="sb">Islas Salomón</option>\
    <option value="sj">Islas Svalbard y Jan Mayen</option>\
    <option value="tk">Islas Tokelau</option>\
    <option value="tc">Islas Turks y Caicos</option>\
    <option value="vi">Islas Vírgenes (EEUU)</option>\
    <option value="vg">Islas Vírgenes (Reino Unido)</option>\
    <option value="wf">Islas Wallis y Futuna</option>\
    <option value="il">Israel</option>\
    <option value="it">Italia</option>\
    <option value="jm">Jamaica</option>\
    <option value="jp">Japón</option>\
    <option value="jo">Jordania</option>\
    <option value="kz">Kazajistán</option>\
    <option value="ke">Kenia</option>\
    <option value="kg">Kirguizistán</option>\
    <option value="ki">Kiribati</option>\
    <option value="kw">Kuwait</option>\
    <option value="la">Laos</option>\
    <option value="ls">Lesotho</option>\
    <option value="lv">Letonia</option>\
    <option value="lb">Líbano</option>\
    <option value="lr">Liberia</option>\
    <option value="ly">Libia</option>\
    <option value="li">Liechtenstein</option>\
    <option value="lt">Lituania</option>\
    <option value="lu">Luxemburgo</option>\
    <option value="mk">Macedonia, Ex-República Yugoslava de</option>\
    <option value="mg">Madagascar</option>\
    <option value="my">Malasia</option>\
    <option value="mw">Malawi</option>\
    <option value="mv">Maldivas</option>\
    <option value="ml">Malí</option>\
    <option value="mt">Malta</option>\
    <option value="ma">Marruecos</option>\
    <option value="mq">Martinica</option>\
    <option value="mu">Mauricio</option>\
    <option value="mr">Mauritania</option>\
    <option value="yt">Mayotte</option>\
    <option value="mx">México</option>\
    <option value="fm">Micronesia</option>\
    <option value="md">Moldavia</option>\
    <option value="mc">Mónaco</option>\
    <option value="mn">Mongolia</option>\
    <option value="ms">Montserrat</option>\
    <option value="mz">Mozambique</option>\
    <option value="na">Namibia</option>\
    <option value="nr">Nauru</option>\
    <option value="np">Nepal</option>\
    <option value="ni">Nicaragua</option>\
    <option value="ne">Níger</option>\
    <option value="ng">Nigeria</option>\
    <option value="nu">Niue</option>\
    <option value="nf">Norfolk</option>\
    <option value="no">Noruega</option>\
    <option value="nc">Nueva Caledonia</option>\
    <option value="nz">Nueva Zelanda</option>\
    <option value="om">Omán</option>\
    <option value="nl">Países Bajos</option>\
    <option value="pa">Panamá</option>\
    <option value="pg">Papúa Nueva Guinea</option>\
    <option value="pk">Paquistán</option>\
    <option value="py">Paraguay</option>\
    <option value="pe">Perú</option>\
    <option value="pn">Pitcairn</option>\
    <option value="pf">Polinesia Francesa</option>\
    <option value="pl">Polonia</option>\
    <option value="pt">Portugal</option>\
    <option value="pr">Puerto Rico</option>\
    <option value="qa">Qatar</option>\
    <option value="uk">Reino Unido</option>\
    <option value="cf">República Centroafricana</option>\
    <option value="cz">República Checa</option>\
    <option value="za">República de Sudáfrica</option>\
    <option value="do">República Dominicana</option>\
    <option value="sk">República Eslovaca</option>\
    <option value="re">Reunión</option>\
    <option value="rw">Ruanda</option>\
    <option value="ro">Rumania</option>\
    <option value="ru">Rusia</option>\
    <option value="eh">Sahara Occidental</option>\
    <option value="kn">Saint Kitts y Nevis</option>\
    <option value="ws">Samoa</option>\
    <option value="as">Samoa Americana</option>\
    <option value="sm">San Marino</option>\
    <option value="vc">San Vicente y Granadinas</option>\
    <option value="sh">Santa Helena</option>\
    <option value="lc">Santa Lucía</option>\
    <option value="st">Santo Tomé y Príncipe</option>\
    <option value="sn">Senegal</option>\
    <option value="sc">Seychelles</option>\
    <option value="sl">Sierra Leona</option>\
    <option value="sg">Singapur</option>\
    <option value="sy">Siria</option>\
    <option value="so">Somalia</option>\
    <option value="lk">Sri Lanka</option>\
    <option value="pm">St Pierre y Miquelon</option>\
    <option value="sz">Suazilandia</option>\
    <option value="sd">Sudán</option>\
    <option value="se">Suecia</option>\
    <option value="ch">Suiza</option>\
    <option value="sr">Surinam</option>\
    <option value="th">Tailandia</option>\
    <option value="tw">Taiwán</option>\
    <option value="tz">Tanzania</option>\
    <option value="tj">Tayikistán</option>\
    <option value="tf">Territorios franceses del Sur</option>\
    <option value="tp">Timor Oriental</option>\
    <option value="tg">Togo</option>\
    <option value="to">Tonga</option>\
    <option value="tt">Trinidad y Tobago</option>\
    <option value="tn">Túnez</option>\
    <option value="tm">Turkmenistán</option>\
    <option value="tr">Turquía</option>\
    <option value="tv">Tuvalu</option>\
    <option value="ua">Ucrania</option>\
    <option value="ug">Uganda</option>\
    <option value="uy">Uruguay</option>\
    <option value="uz">Uzbekistán</option>\
    <option value="vu">Vanuatu</option>\
    <option value="ve">Venezuela</option>\
    <option value="vn">Vietnam</option>\
    <option value="ye">Yemen</option>\
    <option value="yu">Yugoslavia</option>\
    <option value="zm">Zambia</option>\
    <option value="zw">Zimbabue</option>';
    
    // FILTRO DE BÚSQUEDA:
    // $('.select-pais-filtro-busqueda').append( paises );
    // --------------------- Agregando los valores del array de países (OTROS) a los select(s) --------------------- //
    // FILTRO DE BÚSQUEDA:
    for ( let codigo_pais in paises_nacionalidad ) {
        let pais = paises_nacionalidad[codigo_pais];
        $(".select-pais-filtro-busqueda").append('<option value="'+codigo_pais+'">'+pais+'</option>');
    }  

    $('.select-pais-filtro-busqueda').prepend('<option value="0" selected>Todos</option>');
    // FORMULARIO:
    for ( let codigo_pais in paises_nacionalidad ) {
        let pais = paises_nacionalidad[codigo_pais];
        $(".select-pais-form").append('<option value="'+codigo_pais+'">'+pais+'</option>');
    }  

    // Agregando la opción 'Seleccione':
    $('.select-pais-form').prepend('<option value="" selected>Seleccione</option>');
    // Agregando la opción 'No aplica' a los selects de nacionalidades adicionales:
    $('.select-pais-form-adicional').append("<option value='999'>No aplica</option>");       

    // --------------------- Agregando los valores del array de posiciones de jugador a select(s) --------------------- //
    // FILTRO DE BÚSQUEDA:
    for (var i = 0; i < array_posiciones.length; i++) {
        $(".select-posicion-jugador-filtro-busqueda").append('<option value="'+array_posiciones[i][0]+'">'+array_posiciones[i][1]+'</option>');
    }
    // FORMULARIO:
    for (var i = 0; i < array_posiciones.length; i++) {
        if( i === 0 ){
            array_posiciones[i][0] = '';
            array_posiciones[i][1] = 'Seleccione';
        }     
        $(".select-posicion-jugador-form").append('<option value="'+array_posiciones[i][0]+'">'+array_posiciones[i][1]+'</option>');
    }
    // FORMULARIO (POSICIÓN ADICIONAL):  
    $(".select-posicion-adicional").append('<option value="999">No aplica</option>');
       
    // --------------------- Agregando los valores del array de países (OTROS) a los select(s) --------------------- //
    // FILTRO DE BÚSQUEDA:
    for (var i = 0; i < array_paises.length; i++) {
        if( i === 0 ){
            array_paises[i][0] = '0';
            array_paises[i][1] = 'Todos';
        }   
        // El 2 representa a los países que NO aparecen en la pantalla principal:
        if( array_paises[i][3] === 2 ){
            $(".select-pais-otro").append('<option value="'+array_paises[i][0]+'">'+array_paises[i][1]+'</option>');
        }
    }           

    // --------------------- Agregando los valores del array del estado del club de jugadores --------------------- //
    // FILTRO DE BÚSQUEDA:
    for (var i = 0; i < array_estadoclub_jugador.length; i++) {
        $(".select-estadoclub-jugador-filtro-busqueda").append('<option value="'+array_estadoclub_jugador[i][0]+'">'+array_estadoclub_jugador[i][1]+'</option>');
    }     
    // FORMULARIO:
    for (var i = 0; i < array_estadoclub_jugador.length; i++) { // <-------------- PARA FORMULARIO (sin la opción 'Todos').
        if( i === 0 ){
            array_estadoclub_jugador[i][0] = '';
            array_estadoclub_jugador[i][1] = 'Seleccione';
        }     
        $(".select-estadoclub-jugador-form").append('<option value="'+array_estadoclub_jugador[i][0]+'">'+array_estadoclub_jugador[i][1]+'</option>');
    }                  

    // --------------------- Agregando los valores del array de series --------------------- //
    // FORMULARIO:
    for (var i = 0; i < array_series.length; i++) { // <-------------- PARA FORMULARIO (sin la opción 'Todos').
        if( i === 0 ){
            array_series[i][0] = '';
            array_series[i][1] = 'Seleccione';
        }     
        $(".select-serie-jugador-form").append('<option value="'+array_series[i][0]+'">'+array_series[i][1]+'</option>');
    }

    // --------------------- Agregando los valores del array de lateralidad de jugadores --------------------- //
    // FILTRO DE BÚSQUEDA:
    for (var i = 0; i < array_lateralidad.length; i++) {   
        $(".select-lateralidad-filtro-busqueda").append('<option value="'+array_lateralidad[i][0]+'">'+array_lateralidad[i][1]+'</option>');
    }      
    // FORMULARIO:
    for (var i = 0; i < array_lateralidad.length; i++) {
        if( i === 0 ){
            array_lateralidad[i][0] = '';
            array_lateralidad[i][1] = 'Seleccione';
        }        
        $(".select-lateralidad-form").append('<option value="'+array_lateralidad[i][0]+'">'+array_lateralidad[i][1]+'</option>');
    }    

    // ============================================ CONSULTANDO TODOS LOS CAMPEONATOS Y CLUBES A LOS SELECTS ============================================ //
    // Insertando en los selects los campeonatos y clubes de la BD:
    buscar_campeonatos_todos();
    buscar_clubes_todos();
    // buscar_jugadores_seguimiento( 1 );

/*
// Ordenando options de los selects para países :
// - Filtro de Búsqueda:
$('.select-pais-filtro-busqueda').find('option[value="0"]').remove(); // <--- Eliminando el option 'Todos'
$('.select-pais-filtro-busqueda').each(function(){
    let thisSelect = $(this);
    let thisSelectOptions = $(this).find('option');

    //$(this).find('option[value="0"]').remove();
    
    // Ordenando select de países:
    $(thisSelect).html($(thisSelectOptions).sort(function (a, b) {
        if(!a.value) return;
        return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
    }));
    $(thisSelect).prepend("<option value='0' selected>Todos</option>");
});

// ---------------- Selects de países para formulario:
// - Filtro de Formulario:
$('.select-pais-form').each(function(){
    let thisSelect = $(this);
    let thisSelectOptions = $(this).find('option');
    // Ordenando select de países:
    $(thisSelect).html($(thisSelectOptions).sort(function (a, b) {
        if(!a.value) return;
        return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
    }));
    // $(thisSelect).prepend("<option value='' selected>Seleccione</option>");
});

// - Filtro de Formulario:
$('.select-pais-form').each(function(){
    let thisSelect = $(this);
    $(thisSelect).prepend("<option value='' selected>Seleccione</option>");
});

// ---------------- Selects de nacionalidad adicionales para formulario :
$('.select-pais-form-adicional').find('option[value=""]').remove(); // <--- Eliminando el option 'Todos'
// - Filtro de Formulario:
$('.select-pais-form-adicional').each(function(){
    let thisSelect = $(this);
    let thisSelectOptions = $(this).find('option');
    // Ordenando select de países:
    $(thisSelect).html($(thisSelectOptions).sort(function (a, b) {
        if(!a.value) return;
        return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
    }));
    // $(thisSelect).prepend("<option value='' selected>Seleccione</option>");
});

$('.select-pais-form-adicional').each(function(){
    let thisSelect = $(this);
    $(thisSelect).prepend("<option value='' selected>Seleccione</option>");
});

// - Filtro de Formulario:
$('.select-pais-form-adicional').each(function(){
    let thisSelect = $(this);
    $(thisSelect).append("<option value='999'>No aplica</option>");
});
*/

// ---------------- Selects de posiciones adicionales :
$('.select-posicion-jugador-form-adicional').each(function(){
    let thisSelect = $(this);
    $(thisSelect).append("<option value='999'>No aplica</option>");
});

</script>