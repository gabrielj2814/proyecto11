<?php
    include('../config/datos.php');
    session_start();
    if(!(isset($_SESSION["nombre_usuario_software"]))){
        session_destroy();
        header('Location: ../index.php?cerrar_sesion=1');
    }else{

        include('../bd/udc_ficha_social_BD.php');
        $menu_actual="udc";
        $submenu_actual="udc_visita_social";
        $seccion_comentarios = $comentarios['udc_visita_social'];//mis cuotas
        $demo_seccion = $demo['udc_visita_social'];
        $nombre_pestana_navegador='Visita Social';
        
        $datetime_now = new DateTime();
        $date_hoy = new DateTime();
        $datetime_now = $datetime_now->format('Y-m-d H:i:s');
        $year = $date_hoy->format('Y');
        $date_hoy = $date_hoy->format('Y-m-d');
        $data = explode(" ", $datetime_now);
        $ano_actual =  date("Y");
        $mes_actual =  date("m");
        $series= ver_series_total();
?>   

<!DOCTYPE html> 
<html lang="es"> 
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
<title><?php echo $nombre_pestana_navegador;?> | Visita Social</title>

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
        background-color: <?php echo $color_fondo; ?>
        border: 3px solid black; 
        color: black;
        border-radius:5px;
    }
    .boton_menu{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid <?php echo $color_fondo; ?> 
        color: <?php echo $color_fondo; ?>
        border-radius:5px;
    }
    .boton_menu:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: <?php echo $color_fondo; ?>
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
        color: <?php echo $color_fondo; ?>
    }

    .panel_buscar:hover{
        background-color:#ffd9ad;
        color:white;
    }

    .boton_volver{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 1px solid <?php echo $color_fondo; ?> 
        color: <?php echo $color_fondo; ?>
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
        background-color: <?php echo $color_fondo; ?>
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
        border: 3px solid <?php echo $color_fondo; ?> 
        color: <?php echo $color_fondo; ?>
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
        border: 3px solid <?php echo $color_fondo; ?> 
        color: <?php echo $color_fondo; ?>
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
        border: 3px solid <?php echo $color_fondo; ?> 
        color: <?php echo $color_fondo; ?>
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
        background-color: <?php echo $color_fondo; ?>
        border: 1px solid <?php echo $color_fondo; ?> 
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
    border: 2px solid <?php echo $color_fondo; ?>
    color: <?php echo $color_fondo; ?>
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
        background-color: <?php echo $color_fondo; ?>
        border: 5px solid white;     
        color: white;
        border-radius: 50%;
        padding: 13px;
    }
    .boton_volver_a_series:hover{
        position: absolute;
        text-shadow: none; 
        background-color: <?php echo $color_fondo; ?>
        border: 5px solid white;     
        color: white;
        border-radius: 50%;
        padding: 13px;
    }

    #ingresar_peso_ideal_informe_carga::placeholder {
        color: white;
    }

    #tabla_ver_informes_todos tbody tr {
        text-align: center;
        font-size: 11px;
    }

    #tabla_ver_informes_todos thead tr {
        text-align: center;
        font-size: 12px;
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

#tabla_ver_informes_todos thead tr {
    text-align: center;
}

#tabla_ver_perfil_jugador thead tr {
    text-align: center;
    font-size: 12px;
}

#tabla_ver_perfil_jugador tbody tr {
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
    color: black;
    background-color: #4caf50;
}

.valoracion-media {
    color: black;
    background-color: #ffc107;
}

.valoracion-alta {
    color: white;
    background-color: #f44336;
}

.td-valoracion {
    padding-right: 10px;
    padding-top: 7px;
    padding-bottom: 7px;
}

.td-valoracion .span-valoracion {
    width: 70px;
    margin-left: 25px;
    text-align: center;
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

.radio-button + label {
    font-size: 11px!important;
}


.radio-button-valoracion-alta + label {
    display:inline-block;
    font-weight: bold;
    background-color: #f44336;
    border-radius: 5px;
    padding: 5px;
    color: white;
    text-transform: uppercase;
    text-align: center;
    width: 100%;
    /*margin-right: 13px;*/       
}

.radio-button-valoracion-media + label {
    display:inline-block;
    font-weight: bold;
    background-color: #ffc107;
    border-radius: 5px;
    padding: 5px;
    color: black;
    text-transform: uppercase;
    text-align: center;
    width: 100%;
    /*margin-right: 13px;*/       
}

.radio-button-valoracion-baja + label {
    display:inline-block;
    font-weight: bold;
    background-color: #4caf50;
    border-radius: 5px;
    padding: 5px;
    color: black;
    text-transform: uppercase;
    text-align: center;
    width: 100%;
    /*margin-right: 13px;*/       
}


.radio-button:checked + label { 
    border: solid 3px #3e3e3e;
}

.textarea-social {
    width:100%; -webkit-appearance: none; 
    -moz-appearance : none; 
    border: 2px solid #9e9e9ee0; 
    border-radius: 6px;
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

.img-star-five-stars {
    width: 80px;margin-left: 50px; height: 13px; margin-top: -3px;
}

.ellipsis-text {
    text-overflow: ellipsis;
    overflow: hidden;
    white-space: nowrap;    
    margin-bottom: 0px;
    font-weight: bold;
}

/* ------------------ INPUT GRIS ------------------ */
.gray-a {
margin:0px; border-bottom-left-radius:2px; border-top-left-radius:2px; margin-left: 0px; margin-right: 0px; width: 90px; margin-top:0px; background-color: #555555; font-size: 12px; margin-bottom:0px;
}

.gray-a:hover{
    background-color: #555555;   
}

.gray-input {
margin:0px; width:52%; -webkit-appearance: none; -moz-appearance : none; border: 1px solid #555555!important; margin-left: 0px; margin-right: 0px; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px;  border-top-left-radius:0px; margin-bottom:0px; text-align:left;
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

/* ------------------ INPUT AZUL ------------------ */
.blue-input {
margin:0px; width:52%; -webkit-appearance: none; -moz-appearance : none; border: 1px solid <?php echo substr($color_fondo, 0, -1) . '!important;'; ?> margin-left: 0px; margin-right: 0px; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px;  border-top-left-radius:0px; margin-bottom:0px; text-align:center;
}

.titulo-form {
    font-weight: bold;
    text-transform: uppercase;
    color: black;
    position: relative;
    top: 3px;    
} 

.titulo-left {
    text-align: left;
}

.caret {
    display: inline-block;
    width: 0;
    height: 0;
    vertical-align: top;
    border-top: 7px solid #000;
    border-right: 6px solid transparent;
    border-left: 6px solid transparent;
    content: "";    
}

input[type="text"], input[type="number"] {
    margin-bottom: 0;
}

input[type="number"] {
    text-align: center;
}

.div-updown-line {
    border-top: 2px solid black;
    border-bottom: 2px solid black;
    padding: 5px;
    box-sizing: border-box;
    margin: auto;
}

.div-updown-line p {
    font-size: 13px;
    margin: -3px;
    color: black;
    font-weight: bold;
}

.titulo-modal {
    font-size: 13px;
    margin: -3px;
    color: black;
    font-weight: bold;
    background-color: #57bcff;
}

.bottom-space-modal {
    margin-bottom: 20px;
    width: 100%;
}

#modal_detalle_visita_social table tbody tr th, #modal_detalle_visita_social table tbody tr td {
    text-align: left;
    color: black;
}

.valoracion-modal {
    width: 150px;
    margin: auto;
    height: 70px;
    border-radius: 11px;
    display: inline-block;
    font-weight: bold;
    padding: 5px;
    color: white;
    text-transform: uppercase;
    text-align: center;
}

.valoracion-modal span {
    position: relative;
    top: 25px;
    font-size: 16px;    
}

.big-text-modal {
    border: 2px solid black;
    width: 100%;    
    color: black;
}

.div-otros-datos .span3 {
    margin-bottom: 20px;
    margin-left: 1%!important;
}

.titulo-form-valoracion {
    text-align: center;
    margin: -4px 0px;
    position: relative;
    top: 0px; 
    font-size: 14px;
    text-transform: uppercase;
    font-weight: bold;
    color: black;    
}

select {
  text-align: center;
  text-align-last: center;
}
option {
  text-align: center;
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



var id_jugador = "";
var idudc_visita_social = "";
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
var datos_visita_social = {};
var ano_actual = '<?php echo $ano_actual;?>';
var mes_actual = parseInt('<?php echo $mes_actual;?>');

var seriesV2 = <?php echo json_encode($series); ?>;


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

// Array parentesco:
var array_parentesco = [
    ['', 'Seleccione'],
    [1, 'Padre'],
    [2, 'Madre'],
    [3, 'Hijo/a'],
    [4, 'Suegro/a'],
    [5, 'Yerno'],
    [6, 'Nuera'],
    [7, 'Abuelo/a'],
    [8, 'Nieto/a'],
    [9, 'Hermano/a'],
    [10, 'Cuñado/a'],
    [11, 'Bisabuelo/a'],
    [12, 'Biznieto/a'],
    [13, 'Tio/a'],
    [14, 'Sobrino/a'],
    [15, 'Amigo/a'],
    [16, 'Padrastro'],
    [17, 'Madrastra'],
    [18, 'Primo/a'],
    [19, 'Madrastra'],
    [20, 'No familiar'],
    [21, 'Pareja'],
    [22, 'Esposa/o'],
];

// Array nivel educacional:
var array_nivel_educacional = [
    ['', 'Seleccione'],
    [1, 'Educación Pre-Escolar'],
    [2, 'Educación Básica incompleta'],
    [3, 'Educación Básica completa'],
    [4, 'Educación Básica en curso'],
    [5, 'Educación Media incompleta'],
    [6, 'Educación Media completa'],
    [7, 'Educación Media en curso'],
    [8, 'Educación Superior incompleta'],
    [9, 'Educación Superior completa'],
    [10, 'Educación Superior en curso'],
];

// Array situación conyugal:
var array_situacion_conyugal = [
    ['', 'Seleccione'],
    [1, 'Casados'],
    [2, 'Solteros'],
    [3, 'Separados'],
    [4, 'En proceso de separación'],
];

// Array conyugal de padres:
var array_conyugal_padres = [
    ['', 'Seleccione'],
    [1, 'Casados'],
    [2, 'Solteros'],
    [3, 'Separados'],
    [4, 'En proceso de separación'],
];

// Array situación amorosa:
var array_situacion_amorosa = [
    ['', 'Seleccione'],
    [1, 'En pareja'],
    [2, 'Soltero'],
];

// Array situación con pareja:
var array_relacion_pareja = [
    ['Seleccione', 'Seleccione'],
    [1, 'Sin problemas, muy buena relacion'],
    [2, 'Algunos problemas ocasionales'],
    [3, 'Existen problemas importantes'],
];

// Array coste de alimentación:
var array_coste_alimentacion = [
    ['', 'Seleccione'],
    [1, 'Si, no tengo problemas con eso'],
    [2, 'Tengo dificultades para costear mi alimentación'],
    [3, 'Tengo muchas dificultades para costear mi alimentación'],
];

// Array medios de transporte:
var array_medio_transporte = [
    ['', 'Seleccione'],
    [1, 'Bus'],
    [2, 'Micro'],
    [3, 'Metro'],
    [4, 'Auto'],
    [5, 'Caminando'],
    [6, 'Bicicleta'],
];

// Array comunas:
var array_comuna = [
    'Seleccione',
    'Arica',
    'Camarones',
    'General Lagos',
    'Putre',
    'Alto Hospicio',
    'Camiña',
    'Colchane',
    'Huara',
    'Iquique',
    'Pica',
    'Pozo Almonte',
    'Antofagasta',
    'Calama',
    'María Elena',
    'Mejillones',
    'Ollagüe',
    'San Pedro de Atacama',
    'Sierra Gorda',
    'Taltal',
    'Tocopilla',
    'Alto del Carmen',
    'Caldera',
    'Chañaral',
    'Copiapó',
    'Diego de Almagro',
    'Freirina',
    'Huasco',
    'Tierra Amarilla',
    'Vallenar',
    'Andacollo',
    'Canela',
    'Combarbalá',
    'Coquimbo',
    'Illapel',
    'La Higuera',
    'La Serena',
    'Los Vilos',
    'Monte Patria',
    'Ovalle',
    'Paihuano',
    'Punitaqui',
    'Río Hurtado',
    'Salamanca',
    'Vicuña',
    'Algarrobo',
    'Cabildo',
    'Calera',
    'Calle Larga',
    'Cartagena',
    'Casablanca',
    'Catemu',
    'Concón',
    'El Quisco',
    'El Tabo',
    'Hijuelas',
    'Isla de Pascua',
    'Juan Fernández',
    'La Cruz',
    'La Ligua',
    'Limache',
    'Llaillay',
    'Los Andes',
    'Nogales',
    'Olmué',
    'Panquehue',
    'Papudo',
    'Petorca',
    'Puchuncaví',
    'Putaendo',
    'Quillota',
    'Quilpué',
    'Quintero',
    'Rinconada',
    'San Antonio',
    'San Esteban',
    'San Felipe',
    'Santa María',
    'Santo Domingo',
    'Valparaíso',
    'Villa Alemana',
    'Viña del Mar',
    'Zapallar',
    'Chimbarongo',
    'Chépica',
    'Codegua',
    'Coltauco',
    'Coínco',
    'Doñihue',
    'Graneros',
    'La Estrella',
    'Las Cabras',
    'Litueche',
    'Lolol',
    'Machalí',
    'Malloa',
    'Marchihue',
    'Mostazal',
    'Nancagua',
    'Navidad',
    'Olivar',
    'Palmilla',
    'Paredones',
    'Peralillo',
    'Peumo',
    'Pichidegua',
    'Pichilemu',
    'Placilla',
    'Pumanque',
    'Quinta de Tilcoco',
    'Rancagua',
    'Rengo',
    'Requínoa',
    'San Fernando',
    'San Vicente',
    'Santa Cruz',
    'Cauquenes',
    'Chanco',
    'Colbún',
    'Constitución',
    'Curepto',
    'Curicó',
    'Empedrado',
    'Hualañé',
    'Licantén',
    'Linares',
    'Longaví',
    'Maule',
    'Molina',
    'Parral',
    'Pelarco',
    'Pelluhue',
    'Pencahue',
    'Rauco',
    'Retiro',
    'Romeral',
    'Río Claro',
    'Sagrada Familia',
    'San Clemente',
    'San Javier',
    'San Rafael',
    'Talca',
    'Teno',
    'Vichuquén',
    'Villa Alegre',
    'Yerbas Buenas',
    'Bulnes',
    'Chillán',
    'Chillán Viejo',
    'Cobquecura',
    'Coelemu',
    'Coihueco',
    'El Carmen',
    'Ninhue',
    'Pemuco',
    'Pinto',
    'Portezuelo',
    'Quillón',
    'Quirihue',
    'Ránquil',
    'San Carlos',
    'San Fabián',
    'San Ignacio',
    'San Nicolás',
    'Treguaco',
    'Yungay',
    'Ñiquén',
    'Alto Biobío',
    'Antuco',
    'Arauco',
    'Cabrero',
    'Cañete',
    'Chiguayante',
    'Concepción',
    'Contulmo',
    'Coronel',
    'Curanilahue',
    'Florida',
    'Hualpén',
    'Hualqui',
    'Laja',
    'Lebu',
    'Los Alamos',
    'Los Angeles',
    'Lota',
    'Mulchén',
    'Nacimiento',
    'Negrete',
    'Penco',
    'Quilaco',
    'Quilleco',
    'San Pedro de la Paz',
    'San Rosendo',
    'Santa Bárbara',
    'Santa Juana',
    'Talcahuano',
    'Tirúa',
    'Tomé',
    'Tucapel',
    'Yumbel',
    'Angol',
    'Carahue',
    'Cholchol',
    'Collipulli',
    'Cunco',
    'Curacautín',
    'Curarrehue',
    'Ercilla',
    'Freire',
    'Galvarino',
    'Gorbea',
    'Lautaro',
    'Loncoche',
    'Lonquimay',
    'Los Sauces',
    'Lumaco',
    'Melipeuco',
    'Nueva Imperial',
    'Padre Las Casas',
    'Perquenco',
    'Pitrufquén',
    'Pucón',
    'Purén',
    'Renaico',
    'Saavedra',
    'Temuco',
    'Teodoro Schmidt',
    'Toltén',
    'Traiguén',
    'Victoria',
    'Vilcún',
    'Villarrica',
    'Corral',
    'Futrono',
    'La Unión',
    'Lago Ranco',
    'Lanco',
    'Los Lagos',
    'Mariquina',
    'Máfil',
    'Paillaco',
    'Panguipulli',
    'Río Bueno',
    'Valdivia',
    'Ancud',
    'Calbuco',
    'Castro',
    'Chaitén',
    'Chonchi',
    'Cochamó',
    'Curaco de Vélez',
    'Dalcahue',
    'Fresia',
    'Frutillar',
    'Futaleufú',
    'Hualaihué',
    'Llanquihue',
    'Los Muermos',
    'Maullín',
    'Osorno',
    'Palena',
    'Puerto Montt',
    'Puerto Octay',
    'Puerto Varas',
    'Puqueldón',
    'Purranque',
    'Puyehue',
    'Queilén',
    'Quellón',
    'Quemchi',
    'Quinchao',
    'Río Negro',
    'San Juan de la Costa',
    'San Pablo',
    "Aisén",
    "Chile Chico",
    "Cisnes",
    "Cochrane",
    "Coihaique",
    "Guaitecas",
    "Lago Verde",
    "O'Higgins",
    "Río Ibáñez",
    "Tortel",
    'Antártica',
    'Cabo de Hornos',
    'Laguna Blanca',
    'Natales',
    'Porvenir',
    'Primavera',
    'Punta Arenas',
    'Río Verde',
    'San Gregorio',
    'Timaukel',
    'Torres del Paine',
    'Alhué',
    'Buin',
    'Calera de Tango',
    'Cerrillos',
    'Cerro Navia',
    'Colina',
    'Conchalí',
    'Curacaví',
    'El Bosque',
    'El Monte',
    'Estación Central',
    'Huechuraba',
    'Independencia',
    'Isla de Maipo',
    'La Cisterna',
    'La Florida',
    'La Granja',
    'La Pintana',
    'La Reina',
    'Lampa',
    'Las Condes',
    'Lo Barnechea',
    'Lo Espejo',
    'Lo Prado',
    'Macul',
    'Maipú',
    'María Pinto',
    'Melipilla',
    'Padre Hurtado',
    'Paine',
    'Pedro Aguirre Cerda',
    'Peñaflor',
    'Peñalolén',
    'Pirque',
    'Providencia',
    'Pudahuel',
    'Puente Alto',
    'Quilicura',
    'Quinta Normal',
    'Recoleta',
    'Renca',
    'San Bernardo',
    'San Joaquín',
    'San José de Maipo',
    'San Miguel',
    'San Pedro',
    'San Ramón',
    'Santiago',
    'Talagante',
    'Tiltil',
    'Vitacura',
    'Ñuñoa',
];

// ----------------------------------------------------------------------  FUNCIONES QUE AGREGAN DATOS DE ARRAYS A SELECTS ---------------------------------------------------------------------- //
function agregar_comuna_select() {
    $(".select-comuna").empty();
    for (var i = 0; i < array_comuna.length; i++) {
        if( i === 0 ) {
            $(".select-comuna").append('<option value="">Seleccione</option>');
        } else {
            $(".select-comuna").append('<option value="'+i+'">'+array_comuna[i]+'</option>');
        }
        
    }
}    
// ---------------------------------------------------------------------- //
function agregar_parentesco_select( param ) {

    if( param === 1 ) {

        $(".select-parentesco").empty();

        $('.select-parentesco').each(function(){

            let id = $(this).attr('id');

            for (var i = 0; i < array_parentesco.length; i++) {
                $(this).append('<option value="'+array_parentesco[i][0]+'">'+array_parentesco[i][1]+'</option>');
            }

            if( id == 'af_principal_sostenedor' ) {
                $(this).append('<option value="888">Yo</option>');
                $(this).append('<option value="999">La pareja de un familiar</option>');
            }

        });

        /*
        for (var i = 0; i < array_parentesco.length; i++) {
            $(".select-parentesco").append('<option value="'+array_parentesco[i][0]+'">'+array_parentesco[i][1]+'</option>');
        } 
        */   

    } else {

        $('select[name="array_parentesco_domicilio_jugador[]"]').each(function(){

            let options = $(this).find('option');
            if( options.length === 0 ) {

                for (var i = 0; i < array_parentesco.length; i++) {
                    $(this).append('<option value="'+array_parentesco[i][0]+'">'+array_parentesco[i][1]+'</option>');
                } 

            }

        });

        /*
        $('select[name="array_parentesco_domicilio_jugador[]"]').empty();
        for (var i = 0; i < array_parentesco.length; i++) {
            $('select[name="array_parentesco_domicilio_jugador[]"]').append('<option value="'+array_parentesco[i][0]+'">'+array_parentesco[i][1]+'</option>');
        } 
        
        */
    

    }
}
// ---------------------------------------------------------------------- //
function agregar_nivel_educacional_select() {
    // $(".select-nivel-educacional").empty(); 
    
    $('select[name="array_nivel_educacional_domicilio_jugador[]"]').each(function(){

        let options = $(this).find('option');
        if( options.length === 0 ) {

            for (var i = 0; i < array_nivel_educacional.length; i++) {
                $(this).append('<option value="'+array_nivel_educacional[i][0]+'">'+array_nivel_educacional[i][1]+'</option>');
            }

        }

    });


}
// ---------------------------------------------------------------------- //
function agregar_situacion_conyugal_padres_select() { 
    $(".select-conyugal-padres").empty();
    for (var i = 0; i < array_conyugal_padres.length; i++) {
        $(".select-conyugal-padres").append('<option value="'+array_conyugal_padres[i][0]+'">'+array_conyugal_padres[i][1]+'</option>');
    }    
}
// ---------------------------------------------------------------------- //
function agregar_situacion_amorosa_select() { 
    $(".select-situacion-amorosa").empty();
    for (var i = 0; i < array_situacion_amorosa.length; i++) {
        $(".select-situacion-amorosa").append('<option value="'+array_situacion_amorosa[i][0]+'">'+array_situacion_amorosa[i][1]+'</option>');
    }    
}
// ---------------------------------------------------------------------- //
function agregar_relacion_pareja_select() {
    $(".select-relacion-pareja").empty(); 
    for (var i = 0; i < array_relacion_pareja.length; i++) {
        $(".select-relacion-pareja").append('<option value="'+array_relacion_pareja[i][0]+'">'+array_relacion_pareja[i][1]+'</option>');
    }    
}
// ---------------------------------------------------------------------- //
function agregar_coste_alimentacion_select() { 
    $(".select-coste-alimentacion").empty();
    for (var i = 0; i < array_coste_alimentacion.length; i++) {
        $(".select-coste-alimentacion").append('<option value="'+array_coste_alimentacion[i][0]+'">'+array_coste_alimentacion[i][1]+'</option>');
    }    
}


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
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon-truck"></i> UDC <i class="icon-chevron-right"></i> Visita Social</a>
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
            <i class="icon-truck"></i> UDC
        </a> 
        <a class="current">
            Visita Social
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
                    <h3 class="titulo_principal">VISITA SOCIAL</h3>
                    <p style="margin: 0px;">En esta sección puedes crear, visualizar, modifcar y eliminar datos relacionados a las visitas sociales de los jugadores.</p>                    
                </center>
            </td>
        </tr>
    </table>

    <div style="width:100%; background-color:#163D61; height:20px; border-radius: 4px;"></div>

                        <div id="selecciones_cajas" class="row-fluid" style="margin-top: 20px;">
                            <div class="span11 titulo_series" style="margin-top: 30px; margin-left: 0px; margin-bottom: 20px;">
                                <h4 style="text-align: center;">MASCULINA</h4>
                            </div>
                            
                            <?php
                            foreach ($series AS $indice => $valor) {
                                $arreglo_serie = t_serie($indice);
                                if ($arreglo_serie[1] == 1) { $numero_jugadores = jugadores_por_serie($indice); ?>
                                    <div class="span3" style="text-align: center; margin: 0px; padding: 10px;">
                                        <div class="cuadro_serie"  onclick="seleccionSerie('<?php echo $indice; ?>')">
                                            <div style="margin-bottom: 10px;"><img src="../config/logo_equipo.png" style="height: 120px"></div>
                                            <div class="nombre_seleccion"><b><?php echo $valor; ?></b></div>
                                            <div class="cantidad_jugadores" style="padding-top: 15px;"><i class="icon-male"></i> (<span id="n_jugadores_<?php echo $indice; ?>"><?php echo $numero_jugadores; ?></span>) jugadores</div>
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
                                if ($arreglo_serie[1] == 2) { $numero_jugadores = jugadores_por_serie($indice); ?>
                                    <div class="span3" style="text-align: center; margin: 0px; padding: 10px;">
                                        <div class="cuadro_serie"  onclick="seleccionSerie('<?php echo $indice; ?>')">
                                            <div style="margin-bottom: 10px;"><img src="../config/logo_equipo.png" style="height: 120px"></div>
                                            <div class="nombre_seleccion"><b><?php echo $valor; ?></b></div>
                                            <div class="cantidad_jugadores" style="padding-top: 15px;"><i class="icon-male"></i> (<span id="n_jugadores_<?php echo $indice; ?>"><?php echo $numero_jugadores; ?></span>) jugadores</div>
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
                                    <!-- <h3 class="titulo_principal" style="margin: 0px; line-height: 26px;">VISITA SOCIAL</h3> -->
                                    <p class="descripcipn_serie" style="margin-top: 10px;font-weight: bold;font-size: 22px;">Sub-14</p>
                                    <div style="border-top: 2px solid black;border-bottom: 2px solid black;/* padding: 5px; *//* box-sizing: border-box; */margin: auto;width: 105px;">   
                                        <p class="sexo_serie" style="margin-top: 10px;font-weight: bold;margin: 0;font-size: 16px;">Masculina</p>
                                    </div>
                                   
                                </td>
                            </tr>
                        </tbody>
</table>

<hr>

</div>
<!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->

                        <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:30px;">
                          
                          <div class="row-fluid" style="margin: 0px;">
                            <button class="boton_volver" onclick="boton_volver_cuadro_listado_series();" style="position: absolute; top: 100px;">
                                <i class="icon-arrow-left"></i> volver
                            </button>
                          </div>  
                          
                            <center>
                                <div style=" width:500px; margin-bottom:10px; display: inline-block;">
                                    <table border="0">
                                        <tr class="sin_fondo">
                                            <td style="width:330px; padding-left:40px;"><input class="ph-center" name="buscar_nombre" style="width:96%; background-color:white; border: 3px solid #555555; border-radius:20px; margin-bottom:0px;padding-left: 10px; height: 24px;" placeholder="Nombre del Jugador o Vacío para Ver Todos" maxlength="149" id="buscar_nombre" onKeyUp="buscador();" ></td>
                                            <td style="width:40px; cursor:pointer;"> <button class="boton_refresh" onClick="buscador()" style="margin-left:10px;"><i class="icon-refresh"></i></button></td>
                                        </tr>
                                    </table>
                                </div>
                            </center>
                                
                            <center>
                                <div style="margin:0px; height:20px;"><img src="../config/cargando_buscar.gif" id="cargando_buscar" style=" display:none;">
                                    <span style="color:#dc4e4e; display:none;" id="error_conexion"><b>Error:</b> conexión a internet deficiente.</span>
                                </div>
                            </center>
                            
                            <div class="row-fluid" style="margin-top:0px;">

                                    <div class="span12" style="margin-bottom: 20px;">
                                        <center>
                                        <img class="imagenes-centro" src="../config/udc.png"> <span class="texto-imagen-centro">Dinámico</span>
                                        <i class="icon-star" style="color: #FFE50C;font-size: 25px;"></i> <span class="texto-imagen-centro">Proyección</span>
                                        <i class="icon-medkit" style="font-size: 25px;"></i>                     <span class="texto-imagen-centro">Lesionado</span>
                                        <img class="imagenes-centro" src="../config/logosw.png"> <span class="texto-imagen-centro">Selección chilena</span>
                                        </center>
                                        <!--
                                        <button style="margin-bottom:10px;margin-top: 0px;float:right;position: relative;top: -30px;" class="boton_informe_jugador" onclick="//boton_agregar_informe_carga();"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar jugador</b>
                                        </button>
                                        -->                                         
                                    </div>                              
                                

                                <div class="span12" style="margin: 0px;">
                                    <table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_ver_informes_todos">
                                        <thead>
                                            <tr style="background-color:#555555; color:white;">
                                                <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px; width: 35px;">
                                                  <div class="tip-top" data-original-title="Número" style="width:100%;">#</div>
                                              </th>
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 210px;">
                                                    <div class="tip-top" data-original-title="Posición" style=" cursor: pointer; padding: 0px; text-align: left;">
                                                        POSICIÓN    
                                                    </div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 150px;">
                                                    <div class="tip-top" data-original-title="Serie" style="width:100%;">SERIE</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 25%;">
                                                    <div class="tip-top" data-original-title="Nombre" style="width:100%;">NOMBRE</div>
                                                </th>
                                                <th class="th-small-font-size" scope="col" style="cursor:pointer; padding:0px;width: 113px;">
                                                    <div class="tip-top" data-original-title="Núcleo Familiar" style="width:120px;">FAMILIAR</div>
                                                </th>                                                
                                                <th class="th-small-font-size" scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                                    <div class="tip-top" data-original-title="Relaciones Personales" style="width:100%;">R. PERSONALES</div>
                                                </th>
                                                <th class="th-small-font-size" scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                                    <div class="tip-top" data-original-title="Alimentación" style="width:100%;">ALIMENTACIÓN</div>
                                                </th>
                                                <th class="th-small-font-size" scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                                    <div class="tip-top" data-original-title="Salud" style="width:100%;">SALUD</div>
                                                </th>
                                                <th class="th-small-font-size" scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                                    <div class="tip-top" data-original-title="Locomoción" style="width:100%;">LOCOMOCIÓN</div>
                                                </th>
                                                <th class="th-small-font-size" scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                                    <div class="tip-top" data-original-title="Antecedentes Judiciales" style="width:100%;">JUDICIAL</div>
                                                </th>
                                                
                                                <th scope="col" style="cursor:pointer; padding:0px; border-top-right-radius:5px; width:30px;" colspan="1"></th>
                                            </tr>

                                        </thead>
                                        
                                        <tbody>
                                            <!--
                                            <tr class="tr-posiciones-jugador">
                                                <td colspan="11">Arqueros</td>
                                            </tr>
                                            <tr class="tr-posiciones-jugador">
                                                <td colspan="11">Defensas</td>
                                            </tr>
                                            <tr class="tr-posiciones-jugador">
                                                <td colspan="11">Mediocampistas</td>
                                            </tr>              
                                            AQUI SE INSERTARAN CON JAVASCRIPT -->
                                        </tbody>
                                        
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
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px; "></th>
                                            </tr>

  
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
        
</div>
<!-- ========================================== Fin del id="cuadro_serie_selected" ========================================== -->

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
         
            <div class="row-fluid" style="margin-top:0px;">
                    <div class="span12" style="margin: 0px;">
                        <div style="width:100%; background-color: <?php echo $color_fondo; ?> color: white; height:20px; border-radius: 0px;">
                            <img src="./../config/five_white_stars_2.png" class="img-star-five-stars">
                        </div>
                        <img src="" class="imagen-jugador" style="width: 120px; border-radius: 50%; border: 6px solid <?php echo $color_fondo; ?>; height: 120px; margin-top: -75px; margin-right: 80px; float: right;"> 

                        <button class="boton_volver" onclick="boton_volver_serie_selected_registro_cargas_diarias();" style="float:left; margin:0px; margin-top: 20px;">
                            <i class="icon-arrow-left"></i> volver
                        </button>

                    </div>
            </div>

            <!--
            <div style="position: relative; top: -50px;">
                <img src="./../config/5_stars.png" style="width: 120px; position: relative; top: 20px;">           
            </div>
            -->
                        
            <br/>
        </center>   

        <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
    </div>
    <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
    
    <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:50px;">
        <div class="row-fluid" style="margin-top:-70px;">

            <center>
                <div style="margin:0px; height:20px;"><img src="../config/cargando_buscar.gif" id="cargando_buscar_perfil_jugador" style=" display:none;">
                    <span style="color:#dc4e4e; display:none;" id="error_conexion_perfil_jugador"><b>Error:</b> conexión a internet deficiente.</span>
                    <span style="color:<?php echo $color_fondo; ?>; display:block;" id="sin_resultados_perfil_jugador">Busqueda sin resultados.</span>
                    <button id="boton_refresh_perfil_jugador" class="boton_refresh" onclick="buscar_visitas_jugador_social();" style="margin-left:10px;"><i class="icon-refresh"></i></button>
                </div>       
            </center>

            <button style="margin-bottom:10px; margin-top: 0px; float:right;" class="boton_informe_jugador" onclick="boton_agregar_informe_carga();">
                <b style="font-size:13px;"><i class="icon-plus"></i> Agregar informe</b>
            </button>

            <div class="span12" style="margin: 0px;">
                <table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_ver_perfil_jugador">
                    <thead>
                        <tr style="background-color:#555555; color:white;">
                            <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px; width: 80px;">
                                <div class="tip-top" data-original-title="Número" style="width:100%; ">#</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 400px;">
                                <div class="tip-top" data-original-title="Fecha" style="width:100%;text-align: left">FECHA</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 150px;">
                                <div class="tip-top" data-original-title="Antecedentes Familiares" style="width:120px;">FAMILIAR</div>
                            </th>                                                
                            <th scope="col" style="cursor:pointer; padding:0px; width: 250px;">
                                <div class="tip-top" data-original-title="Relaciones Personales" style="width:100%;">R.PERSONALES</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 250px;">
                                <div class="tip-top" data-original-title="Alimentación" style="width:100%;">ALIMENTACIÓN</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 250px;">
                                <div class="tip-top" data-original-title="Salud" style="width:100%;">SALUD</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 250px;">
                                <div class="tip-top" data-original-title="Locomoción" style="width:100%;">LOCOMOCIÓN</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 250px;">
                                <div class="tip-top" data-original-title="Antecedentes Judiciales" style="width:100%;">JUDICIAL</div>
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
                            <th scope="col" style="cursor:pointer; padding:0px;"></th>
                            <th scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px; "></th>
                        </tr>  
                    </tfoot>
                </table>
            </div>
        </div>
    </div>      

</div>
<!-- ========================================== Fin del id="cuadro_perfil_jugador_selected" ========================================== -->

<!-- ========================================== Inicio del id="cuadro_formulario_guardar" ========================================== -->
<!-- <br><center><h1>----------</h1></center><br> -->
<div style="display:none" id="cuadro_formulario_guardar">

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
                          
                <div class="row-fluid" style="margin-top:0px;">
                        <div class="span12" style="margin: 0px;">
                            <div style="width:100%; background-color: <?php echo $color_fondo; ?> color: white; height:20px; border-radius: 0px;">
                                <!-- <img src="./../config/five_white_stars_2.png" class="img-star-five-stars"> -->
                            </div>
                            
                            <img src="" class="imagen-jugador" style="width: 120px; border-radius: 50%; border: 6px solid <?php echo $color_fondo; ?>; height: 120px; margin-top: -75px; margin-right: 80px; float: right;"> 
                           
                        </div>

                        <div>
                            <button class="boton_volver" onclick="boton_volver_perfil_jugador_selected();" style="float:left; margin:0px; position: relative; top: -40px;">
                              <i class="icon-arrow-left"></i> volver
                            </button>                                 
                        </div>

                </div>

                <div style="position: relative; top: -50px;">
                    <!-- <img src="./../config/5_stars.png" style="width: 120px; position: relative; top: 20px;"> -->     
                    <div style="position: relative; top: 40px;">
                        <h5 style="color: black; text-decoration: underline;">FICHA SOCIAL</h5>
                    </div>                          
                </div>

                <br/>
            </center>     

            <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
        </div>
        <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
    

    <!-- ========================================== Inicio del class="row-fluid cuadro_buscar_buscar" ========================================== -->        
    <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:-60px;">
            
        <!-- ========================================== Inicio del class="row-fluid" ========================================== -->
        <div class="row-fluid" style="margin-top:0px;">
            


            <!-- ========================================== Inicio del class="span12" ========================================== -->
            <div class="span12" style="margin: 0px;">

                <!-- ========================================== Inicio del id="formulario" ========================================== -->
                <form method="post" ng-model="formulario" name="formulario" id="formulario" novalidate>

                    <!-- ==========================================================================  idfichaJugador ========================================================================== -->                    
                    <input type="hidden" name="idfichaJugador" id="idfichaJugador">

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div>
                        <div class="row-fluid">
                            <div class="span12">
                                <p class="titulo-form titulo-left">antecedentes generales</p>
                            </div>                    
                        </div>
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span5" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Domicilio actual</p></div></a>
                                <input class="gray-input" id="domicilio_actual" name="domicilio_actual" style="width: 70%;"/>
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Comuna</p></div></a>
                                <select style="width: 70%;" class="gray-input select-comuna" id="comuna" name="comuna"></select>
                            </div>  
                            <!-- ======================================================================== -->
                            <div class="span4" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Comuna Proc.</p></div></a>
                                <select style="width: 70%;" class="gray-input select-comuna" id="comuna_procedencia" name="comuna_procedencia"></select>
                            </div>              
                        </div>                            
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div>
                        <div class="row-fluid">
                            <div class="span12">
                                <p class="titulo-form titulo-left">apoderado</p>
                            </div>                    
                        </div>
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Nombre</p></div></a>
                                <input class="gray-input" id="apod_nombre" name="apod_nombre" style="width: 70%;" />
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Parentesco</p></div></a>
                                <select class="gray-input select-parentesco" style="width: 70%;" id="apod_parentesco" name="apod_parentesco"></select>
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Correo</p></div></a>
                                <input class="gray-input" id="apod_correo" name="apod_correo" style="width: 70%;" />
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Tel</p></div></a>
                                <input class="gray-input" id="apod_telefono" name="apod_telefono" style="width: 70%;" />
                            </div>                            
                        </div>                            
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->

                    <div class="row-fluid" style="margin-top: 30px;background-color: #57bcff; border-radius: 0px;height: 25px;">
                        <div class="span12">
                            <p class="titulo-form" style="text-align: center; cursor: pointer;" onclick="hide_show_div( 1 );">antecedentes familiares</p><span class="caret" style="position: relative; right: 8px; top: -21px; float: right;"></span>
                        </div>
                    </div>

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div style="width: 90%;" class="div-antecedentes-familiares">
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;width: 20%;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 80%;padding: 4px 0px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;width: 100%;margin: 0;">Nº personas grupo familiar</p></div></a>
                               <input style="width: 20%;text-align: center;background-color: white;" type="number" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="gray-input" id="af_num_personas_gf" name="af_num_personas_gf">
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;width: 32%;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 75%; padding: 4px 5px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;width: 100%;">Nº personas que viven en el domicilio del jugador</p></div></a>
                                <input style="width: 15%; text-align: center; background-color: white;" type="number" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="gray-input" id="af_num_personas_domicilio" name="af_num_personas_domicilio">
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;width: 20%;">
                                 <a class="btn btn-md btn-primary gray-a" style="width: 80%;padding: 4px 5px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">Nº Habitaciones del domicilio</p></div></a>
                                <input style="width: 20%;text-align: center;background-color: white;" type="number" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="gray-input" id="af_num_habitaciones_domicilio" name="af_num_habitaciones_domicilio">
                            </div> 
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;width: 18%;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 60%; padding: 4px 5px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">Comparte habitación</p></div></a>
                                <select style="width: 40%;" class="gray-input" id="af_comparte_habitacion" name="af_comparte_habitacion" onchange="chequear_datos();">
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>                                  
                        </div>
                        <div class="row-fluid" style="margin-top: 20px;">
                            <!-- ======================================================================== -->
                            <div class="span3 div-comparte-habitacion" style="display: flex; margin-right: 15px; width: 34%;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 42%;padding: 4px 5px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">¿Con quién comparte habitación?</p></div></a><input style="width: 45%;background-color: white;" type="text" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="gray-input" id="af_conquien_comparte_habitacion" name="af_conquien_comparte_habitacion">
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex; margin-left: 0; width: 25%;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%;padding: 4px 5px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">Principal sostenedor</p></div></a>
                               <select class="gray-input select-parentesco" style="width: 70%;" id="af_principal_sostenedor" name="af_principal_sostenedor"></select>
                            </div> 
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex; width: 36%;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 55%;padding: 4px 5px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">Tipo de domicilio en que vive el jugador</p></div></a>
                               <select class="gray-input" style="width: 70%;" id="af_tipo_domicilio_jugador" name="af_tipo_domicilio_jugador">
                                   <option value="">Seleccione</option>
                                   <option value="1">Casa</option>
                                   <option value="2">Casa en cité</option>
                                   <option value="3">Casa en condominio</option>
                                   <option value="4">Departamento en edificio</option>
                                   <option value="5">Pieza en casa o departamento</option>
                                   <option value="6">Mediaagua</option>
                                   <option value="7">Otro tipo</option>

                               </select>
                            </div>                                                                                                           
                        </div>                                                    
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-antecedentes-familiares div-personas-viven-conjug">
                        <div class="row-fluid">
                            <div class="span12">
                                <p class="titulo-form titulo-left" style="text-decoration: underline;">detalle personas que viven con el jugador</p>
                            </div>

                            <div class="row-fluid" style="width: 90%;">
                                <table id="tabla_personas_viven_conjug">
                                    <tbody></tbody>
                                </table>
                            </div>                            

                        </div>
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->


                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-antecedentes-familiares">
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex; width: 25%;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">Ingreso núcleo familiar</p></div></a>
                               <input type="text" onkeyup="chequear_datos();" onkeydown="chequear_datos();" class="gray-input" id="af_ingreso_nucleo_familiar" name="af_ingreso_nucleo_familiar" style="background-color: white;">
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex; width: 25%;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 56%;padding: 3px 6px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">¿Tiene independencia económica?</p></div></a>
                                <select class="gray-input" id="af_indep_economica" name="af_indep_economica" style="width: 35%;" onchange="chequear_datos();">
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex; width: 25%;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%;width: 56%;padding: 3px 6px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">Situación conyugal padres</p></div></a>
                                <select class="gray-input select-conyugal-padres" id="af_situacion_conyugal_padres" name="af_situacion_conyugal_padres" style="width: 40%;" onchange="chequear_datos();"><option value="">Seleccione</option><option value="1">Casados</option><option value="2">Solteros</option><option value="3">Separados</option><option value="4">En proceso de separación</option></select>                                
                            </div> 
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex; width: 17%;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">Nº hermanos</p></div></a>
                                <input style="text-align: center; background-color: white;" type="number" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="gray-input" id="af_num_hermanos" name="af_num_hermanos">
                            </div>                                  
                        </div>                            
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-antecedentes-familiares">
                        <div class="row-fluid">
                            <div class="span12">
                                <p class="titulo-form titulo-left">información relevante del grupo familiar a destacar</p>
                            </div>                    
                        </div>                        
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span12" style="display: flex;">
                                <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="af_info_grupo_familiar" id="af_info_grupo_familiar"></textarea>
                            </div>                                 
                        </div>                            
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->       

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-antecedentes-familiares">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="div-updown-line bottom-space-modal" style="width: fit-content;">
                                    <p class="titulo-form-valoracion">valoración del riesgo del entorno familiar</p>
                                </div>
                            </div>                    
                        </div>                        
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span4" style="display: flex;">
                                <div style="display: flex;margin: auto;width: 100%;">                                  

                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-alta" type="radio" id="af_valoracion_0" name="af_valoracion" value="0">
                                        <label for="af_valoracion_0">Alto riesgo</label>
                                    </div>
                                    
                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-media" type="radio" id="af_valoracion_1" name="af_valoracion" value="1">
                                        <label for="af_valoracion_1">Medio riesgo</label>                                        
                                    </div>
                                    
                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-baja" type="radio" id="af_valoracion_2" name="af_valoracion" value="2">
                                        <label for="af_valoracion_2">Bajo riesgo</label>                                           
                                    </div>
                                    
                                </div>                                                            
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span8" style="display: flex;">
                                 <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="af_valoracion_text" id="af_valoracion_text"></textarea>
                            </div>                                                             
                        </div>                            
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->                                        


                    <!-- ==================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================== --->


    
                    <div class="row-fluid" style="margin-top: 30px;background-color: #57bcff; border-radius: 0px;height: 25px;">
                        <div class="span12">
                            <p class="titulo-form" style="text-align: center; cursor: pointer;" onclick="hide_show_div( 2 );">relaciones personales</p><span class="caret" style="position: relative; right: 8px; top: -21px; float: right;"></span>
                        </div>
                    </div>

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-relaciones-personales">
                        <div class="row-fluid">

                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%;"><div><p class="ellipsis-text" style="font-weight: normal;">Situación Amorosa</p></div></a>
                                <select class="gray-input select-situacion-amorosa" id="rp_situacion_amorosa" name="rp_situacion_amorosa" style="width: 50%;" onchange="chequear_datos();" ></select>
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3 div-en-pareja-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%;"><div><p class="ellipsis-text" style="font-weight: normal;">Hace cuanto</p></div></a>
                                <input style="width: 50%;" type="text" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="gray-input" id="rp_hace_cuanto" name="rp_hace_cuanto"/>
                            </div>

                            <!-- ======================================================================== -->
                            <div class="span3 div-en-pareja-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 61%; padding: 4px 5px;"><div><p class="ellipsis-text" style="font-weight: normal; font-size: 9px;">¿Cómo es la relación con tu pareja?</p></div></a>
                                <select class="gray-input select-relacion-pareja" id="rp_relacion_pareja" name="rp_relacion_pareja" style="width: 34%;" onchange="chequear_datos();" ></select>
                            </div> 

                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%;"><div><p class="ellipsis-text" style="font-weight: normal;">Inicio de vida sexual</p></div></a>
                                <select class="gray-input select-pais-filtro-busqueda" id="rp_inicio_vida_sexual" name="rp_inicio_vida_sexual" style="width: 40%; background-color: white;" onchange="chequear_datos();">
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div> 

                                
                        </div>                            
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-relaciones-personales">
                        <div class="row-fluid">
                            
                            <div class="span6" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 25%;"><div><p class="ellipsis-text" style="font-weight: normal;">Método de protección</p></div></a><input style="background-color: white;width: 66%;" type="text" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="gray-input" id="rp_metodo_proteccion" name="rp_metodo_proteccion">
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span6" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 70%;"><div><p class="ellipsis-text" style="font-weight: normal;">¿Te gustaría recibir orientación sobre temas sexuales?</p></div></a>
                                <select class="gray-input" id="rp_orientacion_temas_sexuales" name="rp_orientacion_temas_sexuales" style="width: 40%; background-color: white;" onchange="chequear_datos();">
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>                                
                            </div>
                            <!-- ======================================================================== -->

                        </div>                                                  
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->


                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-relaciones-personales">
                        <div class="row-fluid">
                            
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">¿Tiene hijos?</p></div></a>
                                <select class="gray-input select-pais-filtro-busqueda" id="rp_tiene_hijos" name="rp_tiene_hijos" style="width: 40%;" onchange="chequear_datos();" >
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div> 
                            <!-- ======================================================================== -->
                            <div class="span3 div-hijos-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">Nº Hijos</p></div></a>
                                <input type="number" class="gray-input" id="rp_num_hijos" name="rp_num_hijos" style="width: 40%;" onmouseup="chequear_datos();" />
                            </div> 


                        </div>                                                  
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-relaciones-personales div-datos-hijos-si" style="margin-top: 20px;">
                        <div id="tabla_datos_hijos" style="width: 100%;"></div>                        
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-relaciones-personales">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="div-updown-line bottom-space-modal" style="width: fit-content;">
                                    <p class="titulo-form-valoracion">valoración del riesgo de las relaciones personales</p>
                                </div>                                
                            </div>                    
                        </div>                        
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span4" style="display: flex;">
                                <div style="display: flex;margin: auto;width: 100%;">                                  

                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-alta" type="radio" id="rp_valoracion_0" name="rp_valoracion" value="0">
                                        <label for="rp_valoracion_0">Alto riesgo</label>
                                    </div>
                                    
                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-media" type="radio" id="rp_valoracion_1" name="rp_valoracion" value="1">
                                        <label for="rp_valoracion_1">Medio riesgo</label>                                        
                                    </div>
                                    
                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-baja" type="radio" id="rp_valoracion_2" name="rp_valoracion" value="2">
                                        <label for="rp_valoracion_2">Bajo riesgo</label>                                           
                                    </div>
                                    
                                </div>                                                            
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span8" style="display: flex;">
                                 <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="rp_valoracion_text" id="rp_valoracion_text"></textarea>
                            </div>                                                             
                        </div>                            
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== --> 


                    <!-- ==================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================== --->

                    <div class="row-fluid" style="margin-top: 30px;background-color: #57bcff; border-radius: 0px;height: 25px;">
                        <div class="span12">
                            <p class="titulo-form" style="text-align: center; cursor: pointer;" onclick="hide_show_div( 3 );">alimentación</p><span class="caret" style="position: relative; right: 8px; top: -21px; float: right;"></span>
                        </div>
                    </div>

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-alimentacion">
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span4" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%;padding: 3px 4px;"><div><p class="ellipsis-text" style="font-weight: normal; font-size: 9px;">¿Puede costear su alimentación?</p></div></a>
                                <select class="gray-input select-coste-alimentacion" id="a_costear_alimentacion" name="a_costear_alimentacion" style="width: 50%;" onchange="chequear_datos();" >
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span8" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">Observaciones</p></div></a>
                                <input style="width: 100%;" type="text" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="gray-input" id="a_observaciones" name="a_observaciones"/>
                            </div>                                
                        </div>                            
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-alimentacion">
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span8" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%"><div><p class="ellipsis-text" style="font-weight: normal;">Comidas que realiza en el club</p></div></a>
                                <select style="width: 70%;" class="gray-input select-pais-filtro-busqueda" id="a_comidas_club" name="a_comidas_club" onchange="chequear_datos();" >
                                    <option value="">Seleccione</option>
                                    <option value="1">Desayuno</option>
                                    <option value="2">Colocación mañana</option>
                                    <option value="3">Almuerzo</option>
                                    <option value="4">Merienda tarde</option>
                                    <option value="5">Cena</option>
                                    <option value="6">Snack post entrenamiento</option>
                                </select>
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span4" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 70%;"><div><p class="ellipsis-text" style="font-weight: normal;">¿Cuántas comidas realiza al día?</p></div></a>
                                <select style="width: 30%;" class="gray-input select-pais-filtro-busqueda" id="a_comidas_diarias" name="a_comidas_diarias" onchange="chequear_datos();" >
                                    <option value="">Seleccione</option>
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>                                                               
                        </div>                            
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== --> 

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-alimentacion">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="div-updown-line bottom-space-modal" style="width: fit-content;">
                                    <p class="titulo-form-valoracion">valoración del riesgo alimentación</p>
                                </div>                                     
                            </div>                    
                        </div>                        
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span4" style="display: flex;">
                                <div style="display: flex;margin: auto;width: 100%;">                                  

                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-alta" type="radio" id="a_valoracion_0" name="a_valoracion" value="0">
                                        <label for="a_valoracion_0">Alto riesgo</label>
                                    </div>
                                    
                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-media" type="radio" id="a_valoracion_1" name="a_valoracion" value="1">
                                        <label for="a_valoracion_1">Medio riesgo</label>                                        
                                    </div>
                                    
                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-baja" type="radio" id="a_valoracion_2" name="a_valoracion" value="2">
                                        <label for="a_valoracion_2">Bajo riesgo</label>                                           
                                    </div>
                                    
                                </div>                                                            
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span8" style="display: flex;">
                                 <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="a_valoracion_text" id="a_valoracion_text"></textarea>
                            </div>                                                             
                        </div>                            
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->                     


                    <div class="row-fluid" style="margin-top: 30px;background-color: #57bcff; border-radius:0px;height: 25px;">
                        <div class="span12">
                            <p class="titulo-form" style="text-align: center; cursor: pointer;" onclick="hide_show_div( 4 );">locomoción</p><span class="caret" style="position: relative; right: 8px; top: -21px; float: right;"></span>
                        </div>
                    </div>

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div style="width: 90%;" class="div-locomocion">
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span4" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%;"><div><p class="ellipsis-text" style="font-weight: normal;">¿Cómo llega al club?</p></div></a>
                                <div class="btn-group c_objetivo_fisico" style="width: 50%;">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #555555;"><p id="forma_llegada_club" class="titulo_multi ellipsis-text">Seleccione</p> <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>
                                    <ul id="ul_forma_llegada_club" class="dropdown-menu ul_llegada_ida_club" data-titulo="forma_llegada_club" tipo-ul="ul_llegada_club"></ul>
                                </div>    
                            </div>

                            <!-- ============== INICIO DE INPUT PARA INGRESAR OTRO FORMA DE LLEGAR AL CLUB -->
                            <!--
                            <div class="span4 div-forma-llegada-club-otro" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">¿Quién?</p></div></a>
                                <input class="gray-input" id="" name="" style="width: 70%;">
                            </div>                            
                            -->
                            <!-- ============== FIN DE INPUT PARA INGRESAR OTRO FORMA DE LLEGAR AL CLUB -->


                            <!-- ======================================================================== -->
                            <div class="span4" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;;">Medio</p></div></a>
                                <div class="btn-group c_objetivo_fisico" style="width: 50%;">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #555555;"><p id="mediotrans_llegada_club" class="titulo_multi ellipsis-text">Seleccione</p> <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>
                                    <ul id="ul_mediotrans_llegada_club" class="dropdown-menu ul_medio_transporte" data-titulo="mediotrans_llegada_club" tipo-ul="ul_medio_transporte"></ul>
                                </div>   
                            </div>  
                            <!-- ======================================================================== -->
                            <div class="span4" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 65%;"><div><p class="ellipsis-text" style="font-weight: normal;">¿Cómo se va del club a su casa?</p></div></a>
                                <div class="btn-group c_objetivo_fisico" style="width: 50%;">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #555555;"><p id="tipo_ayuda" class="titulo_multi ellipsis-text">Seleccione</p> <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>
                                    <ul id="ul_forma_ida_club" class="dropdown-menu ul_llegada_ida_club" data-titulo="forma_ida_club" tipo-ul="ul_ida_club"></ul>
                                </div> 
                            </div>                                                      
                        </div>  
                        <div class="row-fluid" style="margin-top: 15px;">
                            <!-- ======================================================================== -->
                            <div class="span4" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">Medio</p></div></a>
                                <div class="btn-group c_objetivo_fisico" style="width: 50%;">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #555555;"><p id="mediotrans_ida_club" class="titulo_multi ellipsis-text">Seleccione</p> <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>
                                    <ul id="ul_mediotrans_ida_club" class="dropdown-menu ul_medio_transporte" data-titulo="mediotrans_ida_club" tipo-ul="ul_medio_transporte"></ul>
                                </div>   
                            </div>                                                     
                        </div>                                                    
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-locomocion">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="div-updown-line bottom-space-modal" style="width: fit-content;">
                                    <p class="titulo-form-valoracion">valoración del riesgo locomoción</p>
                                </div>                                  
                            </div>                    
                        </div>                        
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span4" style="display: flex;">
                                <div style="display: flex;margin: auto;width: 100%;">                                  

                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-alta" type="radio" id="l_valoracion_0" name="l_valoracion" value="0">
                                        <label for="l_valoracion_0">Alto riesgo</label>
                                    </div>
                                    
                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-media" type="radio" id="l_valoracion_1" name="l_valoracion" value="1">
                                        <label for="l_valoracion_1">Medio riesgo</label>                                        
                                    </div>
                                    
                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-baja" type="radio" id="l_valoracion_2" name="l_valoracion" value="2">
                                        <label for="l_valoracion_2">Bajo riesgo</label>                                           
                                    </div>
                                    
                                </div>                                                            
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span8" style="display: flex;">
                                 <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="l_valoracion_text" id="l_valoracion_text"></textarea>
                            </div>                                                             
                        </div>                            
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== --> 

                    <!-- ==================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================== --->

                    <div class="row-fluid" style="margin-top: 30px;background-color: #57bcff; border-radius: 0px;height: 25px;">
                        <div class="span12">
                            <p class="titulo-form" style="text-align: center; cursor: pointer;" onclick="hide_show_div( 5 );">salud</p><span class="caret" style="position: relative; right: 8px; top: -21px; float: right;"></span>
                        </div>
                    </div>

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-salud">
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 60%;"><div><p class="ellipsis-text" style="font-weight: normal;">¿Consume drogas?</p></div></a>
                                <select class="gray-input select-pais-filtro-busqueda" id="s_consume_drogas" name="s_consume_drogas" style="width: 40%;" onchange="chequear_datos();" >
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3 div-consume-drogas-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%;"><div><p class="ellipsis-text" style="font-weight: normal;">Droga que consume</p></div></a>
                                <div class="btn-group c_objetivo_fisico" style="width: 50%;">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #555555;"><p id="drogas_consumidas_jugador" class="titulo_multi ellipsis-text">Seleccione</p> <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>
                                    <ul id="ul_drogas_consumidas_jugador" class="dropdown-menu ul_drogas" data-titulo="drogas_consumidas_jugador" tipo-ul="ul_drogas"></ul>
                                </div>  
                            </div>  
                            <!-- ======================================================================== -->
                            <div class="span3 div-consume-drogas-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">Frecuencia</p></div></a><input type="text" id="s_frecuencia_consumo_drogas" name="s_frecuencia_consumo_drogas" class="gray-input">
                            </div>
                            <!-- ======================================================================== -->
                            <!-- <div class="span3 div-consume-drogas-si" style="display: flex;"> -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 60%;"><div><p class="ellipsis-text" style="font-weight: normal;">Drogas que ha probado</p></div></a>
                                <div class="btn-group c_objetivo_fisico" style="width: 50%;">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #555555;"><p id="drogas_probadas_jugador" class="titulo_multi ellipsis-text">Seleccione</p> <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>
                                    <ul id="ul_drogas_probadas_jugador" class="dropdown-menu ul_drogas" data-titulo="drogas_probadas_jugador" tipo-ul="ul_drogas"></ul>
                                </div>  
                            </div>                                            
                        </div>                
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->


                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-salud">
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 65%; padding: 4px 4px;"><div><p class="ellipsis-text" style="font-weight: normal; font-size: 10px;">¿Familiar consume drogas?</p></div></a>
                                <select class="gray-input select-pais-filtro-busqueda" id="s_familiar_consume_drogas" name="s_familiar_consume_drogas" style="width: 40%;" onchange="chequear_datos();" >
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span6 div-familiar-consume-drogas-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">Quien/es</p></div></a>
                                <input class="gray-input select-pais-filtro-busqueda" id="s_quien_consume_drogas_familiar" name="s_quien_consume_drogas_familiar" style="width: 100%;" onchange="chequear_datos();" />
                            </div>  
                            <!-- ======================================================================== -->
                            <div class="span3 div-familiar-consume-drogas-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">¿Qué drogas?</p></div></a>
                                <div class="btn-group c_objetivo_fisico" style="width: 50%;">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #555555;"><p id="drogas_consumidas_familiar" class="titulo_multi ellipsis-text">Seleccione</p> <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>
                                    <ul id="ul_drogas_consumidas_familiar" class="dropdown-menu ul_drogas" data-titulo="ul_drogas_consumidas_familiar" tipo-ul="ul_drogas"></ul>
                                </div>                                 
                            </div>                                                      
                        </div>            
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->                    

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-salud">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="div-updown-line bottom-space-modal" style="width: fit-content;">
                                    <p class="titulo-form-valoracion">valoración del riesgo de salud</p>
                                </div>                                  
                            </div>                    
                        </div>                        
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span4" style="display: flex;">
                                <div style="display: flex;margin: auto;width: 100%;">                                  

                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-alta" type="radio" id="s_valoracion_0" name="s_valoracion" value="0">
                                        <label for="s_valoracion_0">Alto riesgo</label>
                                    </div>
                                    
                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-media" type="radio" id="s_valoracion_1" name="s_valoracion" value="1">
                                        <label for="s_valoracion_1">Medio riesgo</label>                                        
                                    </div>
                                    
                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-baja" type="radio" id="s_valoracion_2" name="s_valoracion" value="2">
                                        <label for="s_valoracion_2">Bajo riesgo</label>                                           
                                    </div>
                                    
                                </div>                                                            
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span8" style="display: flex;">
                                 <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="s_valoracion_text" id="s_valoracion_text"></textarea>
                            </div>                                                             
                        </div>                            
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== --> 

                    <!-- ==================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================== --->

                    <div class="row-fluid" style="margin-top: 30px;background-color: #57bcff; border-radius: 0px;height: 25px;">
                        <div class="span12">
                            <p class="titulo-form" style="text-align: center; cursor: pointer;" onclick="hide_show_div( 6 );">antecedenes judiciales</p><span class="caret" style="position: relative; right: 8px; top: -21px; float: right;"></span>
                        </div>
                    </div>

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-antecedentes-judiciales">
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 60%;"><div><p class="ellipsis-text" style="font-weight: normal;">¿Tiene antecedentes?</p></div></a>
                                <select class="gray-input select-pais-filtro-busqueda" id="aj_jugador_tiene_antecedentes" name="aj_jugador_tiene_antecedentes" style="width: 40%;" onchange="chequear_datos();" >
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span9 div-jugador-tiene-antecedentes-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">¿Cuáles?</p></div></a>
                                <input type="text" class="gray-input select-pais-filtro-busqueda" id="aj_jugador_antecedentes" name="aj_jugador_antecedentes" style="width: 100%;background-color: white;" onchange="chequear_datos();">
                            </div>
                        </div>                                     
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-antecedentes-judiciales">
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 60%; padding: 4px 5px;"><div><p class="ellipsis-text" style="font-weight: normal;">Familiar con antecedentes</p></div></a>
                                <select class="gray-input select-pais-filtro-busqueda" id="aj_familiar_tiene_antecedentes" name="aj_familiar_tiene_antecedentes" style="width: 40%;" onchange="chequear_datos();" >
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span9 div-familiar-tiene-antecedentes-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">¿Cuáles?</p></div></a>
                                <input type="text" class="gray-input select-pais-filtro-busqueda" id="aj_familiar_antecedentes" name="aj_familiar_antecedentes" style="width: 100%;background-color: white;" onchange="chequear_datos();">
                            </div> 
                        </div>                                     
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-antecedentes-judiciales">
                        <div class="row-fluid">
                            <div class="span12">
                                <div class="div-updown-line bottom-space-modal" style="width: fit-content;">
                                    <p class="titulo-form-valoracion">valoración de antecedentes judiciales</p>
                                </div>                                     
                            </div>                    
                        </div>                        
                        <div class="row-fluid">
                            <!-- ======================================================================== -->
                            <div class="span4" style="display: flex;">
                                <div style="display: flex;margin: auto;width: 100%;">                                  

                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-alta" type="radio" id="aj_valoracion_0" name="aj_valoracion" value="0">
                                        <label for="aj_valoracion_0">Alto riesgo</label>
                                    </div>
                                    
                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-media" type="radio" id="aj_valoracion_1" name="aj_valoracion" value="1">
                                        <label for="aj_valoracion_1">Medio riesgo</label>                                        
                                    </div>
                                    
                                    <div class="span4" style="display: flex;">
                                        <input onclick="chequear_datos();" class="radio-button radio-button-valoracion-baja" type="radio" id="aj_valoracion_2" name="aj_valoracion" value="2">
                                        <label for="aj_valoracion_2">Bajo riesgo</label>                                           
                                    </div>
                                    
                                </div>                                                            
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span8" style="display: flex;">
                                 <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="aj_valoracion_text" id="aj_valoracion_text"></textarea>
                            </div>                                                             
                        </div>                            
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== --> 

                    <!-- ==================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================== --->

                    <div class="row-fluid" style="margin-top: 30px;background-color: #57bcff; border-radius: 0px;height: 25px;">
                        <div class="span12">
                            <p class="titulo-form" style="text-align: center; cursor: pointer;" onclick="hide_show_div( 7 );">otros datos</p><span class="caret" style="position: relative; right: 8px; top: -21px; float: right;"></span>
                        </div>
                    </div>

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-otros-datos">
                        <div class="row-fluid" style="margin-left: -10px;">
                            <!-- ========================================================================  SEGURO ======================================================================== -->

                            <!-- ======================================================================== -->
                            <div class="span3 margin-left-otros-datos" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">Seguro</p></div></a>
                                <select class="gray-input select-pais-filtro-busqueda" id="od_tiene_seguro" name="od_tiene_seguro" style="width: 40%;" onchange="chequear_datos();" >
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3 div-seguro-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">Compañía</p></div></a>
                                <input type="text" class="gray-input select-pais-filtro-busqueda" id="od_nombre_compania_seguro" name="od_nombre_compania_seguro" style="width: 40%;" onchange="chequear_datos();" >
                            </div>    
                            <!-- ======================================================================== -->
                            <div class="span3 div-seguro-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">Vencimiento</p></div></a>
                                <input readonly type="text" class="gray-input date_fechaNacimiento" id="od_seguro_vencimiento" name="od_seguro_vencimiento" style="width: 40%;" onchange="chequear_datos();" >
                            </div>                            

                            <!-- ========================================================================  PASAPORTE ======================================================================== -->

                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 45%;"><div><p class="ellipsis-text" style="font-weight: normal;">¿Tiene pasaporte?</p></div></a>
                                <select class="gray-input select-pais-filtro-busqueda" id="od_tiene_pasaporte" name="od_tiene_pasaporte" style="width: 40%;" onchange="chequear_datos();" >
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3 div-pasaporte-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">Nº pasaporte</p></div></a>
                                <input type="text" class="gray-input select-pais-filtro-busqueda" id="od_num_pasaporte" name="od_num_pasaporte" style="width: 40%;" onchange="chequear_datos();" >
                            </div>    
                            <!-- ======================================================================== -->
                            <div class="span3 div-pasaporte-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">Vencimiento</p></div></a>
                                <input readonly type="text" class="gray-input date_fechaNacimiento" id="od_pasaporte_vencimiento" name="od_pasaporte_vencimiento" style="width: 40%;" onchange="chequear_datos();" >
                            </div> 
                            <!-- ======================================================================== -->
                            <div class="span3 div-fecha-vencimiento-carnet-id" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">Venc. Carnet Id</p></div></a>
                                <input readonly type="text" class="gray-input date_fechaNacimiento" id="od_vencimiento_carnetid" name="od_vencimiento_carnetid" style="width: 40%;" onchange="chequear_datos();" >
                            </div>                                                                                                                        
                        </div>                                     
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-otros-datos">
                        <div class="row-fluid">
                            <div class="span12">
                                <p class="titulo-form titulo-left">Datos del padre</p>
                            </div>                    
                        </div>
                        <div class="row-fluid" style="margin-left: -10px;">
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Nombre</p></div></a>
                                <input class="gray-input" id="od_padre_nombre" name="od_padre_nombre" style="width: 70%;" />
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Apellido</p></div></a>
                                <input class="gray-input" id="od_padre_apellido" name="od_padre_apellido" style="width: 70%;" />
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Tel</p></div></a>
                                <input class="gray-input" id="od_padre_telefono" name="od_padre_telefono" style="width: 70%;" />
                            </div>                                
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Correo</p></div></a>
                                <input class="gray-input" id="od_padre_correo" name="od_padre_correo" style="width: 70%;" />
                            </div>                        
                        </div>                          
                        <div class="row-fluid" style="margin-left: -10px;">
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 55%;padding: 4px 4px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">¿Tiene alguna discapacidad?</p></div></a>
                                <select class="gray-input" style="width: 40%;background-color: white;" id="od_padre_tiene_discapacidad" name="od_padre_tiene_discapacidad">
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <!-- ======================================================================== --> 
                            <div class="span3 div-padre-discapacidad-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%;padding: 4px 5px;"><div><p class="ellipsis-text" style="font-size: 9px;font-weight: normal;">Especifique discapacidad</p></div></a><input class="gray-input" id="od_padre_discapacidad" name="od_padre_discapacidad" style="width: 70%; background-color: white;">
                            </div>                            
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 45%;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">Comuna donde reside</p></div></a>
                                <select class="gray-input select-comuna" style="width: 40%;background-color: white;" id="od_padre_comuna_residencia" name="od_padre_comuna_residencia"></select>
                            </div>                               
                            <!-- ======================================================================== --> 
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 70%;padding: 4px 2px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">¿Se encuentra trabajando actualmente?</p></div></a>
                                <select class="gray-input" style="width: 30%;background-color: white;" id="od_padre_trabaja" name="od_padre_trabaja">
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="2">No, está cesante</option>
                                    <option value="3">No, está jubilado/pensionado</option>                                    
                                </select>
                            </div>
                            <!-- ======================================================================== --> 
                            <div class="span3 div-padre-trabaja-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">¿En qué trabaja?</p></div></a><input class="gray-input" id="od_padre_trabajo_nombre" name="od_padre_trabajo_nombre" style="width: 70%; background-color: white;">
                            </div> 
                            <!-- ======================================================================== --> 
                            <div class="span3 div-padre-cesante-jubilado-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%;padding: 4px 4px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">¿Hace cuánto está cesante?</p></div></a><input class="gray-input" id="od_padre_tiempo_cesante_jubilado" name="od_padre_tiempo_cesante_jubilado" style="width: 70%; background-color: white;">
                            </div>                                                                                   
                        </div>
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-otros-datos">
                        <div class="row-fluid">
                            <div class="span12">
                                <p class="titulo-form titulo-left">Datos de la madre</p>
                            </div>                    
                        </div>
                        <div class="row-fluid" style="margin-left: -10px;">
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Nombre</p></div></a>
                                <input class="gray-input" id="od_madre_nombre" name="od_madre_nombre" style="width: 70%;" />
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Apellido</p></div></a>
                                <input class="gray-input" id="od_madre_apellido" name="od_madre_apellido" style="width: 70%;" />
                            </div>
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Tel</p></div></a>
                                <input class="gray-input" id="od_madre_telefono" name="od_madre_telefono" style="width: 70%;" />
                            </div>                                
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;">Correo</p></div></a>
                                <input class="gray-input" id="od_madre_correo" name="od_madre_correo" style="width: 70%;" />
                            </div>                        
                        </div>                          
                        <div class="row-fluid" style="margin-left: -10px;">
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 55%;padding: 4px 4px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">¿Tiene alguna discapacidad?</p></div></a>
                                <select class="gray-input" style="width: 40%;background-color: white;" id="od_madre_tiene_discapacidad" name="od_madre_tiene_discapacidad">
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                            <!-- ======================================================================== --> 
                            <div class="span3 div-madre-discapacidad-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%;padding: 4px 5px;"><div><p class="ellipsis-text" style="font-size: 9px;font-weight: normal;">Especifique discapacidad</p></div></a><input class="gray-input" id="od_madre_discapacidad" name="od_madre_discapacidad" style="width: 70%; background-color: white;">
                            </div>                            
                            <!-- ======================================================================== -->
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 45%;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">Comuna donde reside</p></div></a>
                                <select class="gray-input select-comuna" style="width: 40%;background-color: white;" id="od_madre_comuna_residencia" name="od_madre_comuna_residencia"></select>
                            </div>                               
                            <!-- ======================================================================== --> 
                            <div class="span3" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 70%;padding: 4px 2px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">¿Se encuentra trabajando actualmente?</p></div></a>
                                <select class="gray-input" style="width: 30%;background-color: white;" id="od_madre_trabaja" name="od_madre_trabaja">
                                    <option value="">Seleccione</option>
                                    <option value="1">Sí</option>
                                    <option value="2">No, está cesante</option>
                                    <option value="3">No, está jubilado/pensionado</option>
                                </select>
                            </div>
                            <!-- ======================================================================== --> 
                            <div class="span3 div-madre-trabaja-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 30%;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">¿En qué trabaja?</p></div></a><input class="gray-input" id="od_madre_trabajo_nombre" name="od_madre_trabajo_nombre" style="width: 70%; background-color: white;">
                            </div> 
                            <!-- ======================================================================== --> 
                            <div class="span3 div-madre-cesante-jubilado-si" style="display: flex;">
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%;padding: 4px 4px;"><div><p class="ellipsis-text" style="font-weight: normal;font-size: 9px;">¿Hace cuánto está cesante?</p></div></a><input class="gray-input" id="od_madre_tiempo_cesante_jubilado" name="od_madre_tiempo_cesante_jubilado" style="width: 70%; background-color: white;">
                            </div>                                                                                   
                        </div>
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== -->                     

                    <!-- ==========================================================================  INICIO DE FILA ========================================================================== -->
                    <div class="div-otros-datos">
                        <div class="row-fluid">
                            <div class="span12">
                                <p class="titulo-form-valoracion">comentarios/observaciones generales</p>
                            </div>                    
                        </div>    
                        <div class="row-fluid">
                            <div class="span12">
                                <textarea onkeyup="chequear_datos();" style="resize: none; background-color: white;" class="textarea-social" id="od_observaciones" name="od_observaciones" placeholder="Escriba aquí..." rows="7"></textarea>
                            </div>                    
                        </div>                                                                         
                    </div>
                    <!-- ==========================================================================  FIN DE FILA ========================================================================== --> 

                    <!-- ==================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================== --->

                    <div style="margin-top: 10px;">
                        <center>
                            <button type="submit" class="boton_gestionar_cargos" onclick="boton_guardar();" id="boton_agregar_informe_carga">
                                <i class="icon-save"></i> GUARDAR INFORME
                            </button>                        
                        </center>                        
                    </div>

                </form>        
                <!-- ========================================== Fin del id="formulario" ========================================== -->

            </div>
            <!-- ========================================== Fin del class="span12" ========================================== -->
        </div>
        <!-- ========================================== Fin del class="row-fluid" ========================================== -->
    </div>      
    <!-- ========================================== Fin del class="row-fluid cuadro_buscar_buscar" ========================================== -->

</div>
<!-- ========================================== Fin del id="cuadro_formulario_guardar" ========================================== -->

  
<!-- ========================================== Inicio del id="modal_detalle_visita_social" ========================================== -->
<div id="modal_detalle_visita_social" class="modal hide" style="
    width: 1080px;
    height: 570px;
    /*height: auto;*/
    position: fixed;
    top: 5%;
    left: 47%;
    border: 2px solid #403f3f;
    border-radius: 0px;
    margin-left: -400px;">

    <div class="modal-header" style="border: none; background-color: transparent;">

        <div class="cuadro_buscar_titulo" style="">
            <center>
                <table style="color: black;font-family: Arial, Helvetica, sans-serif;margin: 0px auto 10px;position: relative;top: -15px;">
                    <tbody>
                        <tr class="sin_fondo">
                            <td style="padding: 15px; text-align: center;">
                                <img src="../config/logo_equipo.png" style="height: 80px;">
                            </td>

                            <input class="sexo" type="hidden" autocomplete="off" value="1">
                            <input class="numero_serie" type="hidden" autocomplete="off" value="19">
                            <input class="tecnico" type="hidden" autocomplete="off">  

                            <td style="text-align: center;">
                                <p class="" style="font-weight: bold;margin-top: 0px;text-transform: uppercase;font-size: 21px;margin: 0;color: #4a4747;">ficha social</p>
                            </td>
                        </tr>
                    </tbody>
                </table>            
             
                <div class="row-fluid" style="margin-top:0px;">
                    <div class="span12" style="position: relative;top: -30px;">
                        
                        <p class="apellido-jugador-modal" style="margin-top: 0px;text-transform: uppercase;float: right;font-size: 14px;position: relative;top: -67px; color: black; font-weight: bold;"></p> 
                        <p class="nombre-jugador-modal" style="margin-top: 0px;text-transform: uppercase;float: right;font-size: 14px;position: relative;top: -67px; margin-right: 5px; color: black;"></p> 

                        <div style="width:95%; background-color: #d6d6d6; color: white; height:20px; border-radius: 0px;"></div>
                        <img src="foto_jugadores/121.png" class="imagen-jugador" style="width: 120px;border-radius: 50%;border: 1px solid #d6d6d6;height: 120px;margin-top: -75px;margin-left: 80px;float: left;"> 
                    </div>
                </div>
   
                <br>
            </center>

            <!-- <div style="width:100%; background-color:#209BF5;; height:20px;"></div> -->
        </div>
        <!-- <button type="button" class="close" data-dismiss="modal" style="margin-top: -2px;color: #fff">&times;</button> -->
    </div>
    
        
    <div class="modal-body" style="position: relative; top: -60px; padding: 0px 20px;">        
        <center>
            <div class="div-updown-line bottom-space-modal" style="width: fit-content;"><p style="background-color: transparent;">ANTECEDENTES GENERALES</p></div> 
        </center>
        <!-- ============================================================================================================ -->
        <table class="bottom-space-modal" style="width: 90%;margin-top: 5px;margin: auto; margin-bottom: 20px;">
            <tbody>
                <tr>
                   <th style="width: 50px;">Nombre:</th>
                   <td class="nombrecompleto-jugador-modal"></td>
                
                   <th>Serie:</th>
                   <td class="serie-jugador-modal"></td>
                   
                   <th style="width: 105px;">Domicilio Actual:</th>
                   <td class="domicilio-actual-jugador-modal"></td>
                   
                   <th style="width: 55px;">Comuna:</th>
                   <td class="comuna-jugador-modal"></td>
                   
                   <th style="width: 135px;">Comuna Procedencia:</th>
                   <td class="comuna-procedencia-jugador-modal"></td>
                </tr>                                                                                  
            </tbody>                 
        </table>   
        <!-- ============================================================================================================ -->
        <center>
            <div class="div-updown-line bottom-space-modal" style="background-color: transparent; width: fit-content;"><p>APODERADO</p></div> 
        </center>
        <!-- ============================================================================================================ -->
        <table class="bottom-space-modal" style="width: 90%;margin-top: 5px;margin: auto; margin-bottom: 20px;">
            <tbody>
                <tr>
                   <th style="width: 50px;">Nombre:</th>
                   <td style="width: 140px;" class="nombre-apoderado-modal"></td>
                   
                   <th style="width: 75px;">Parentesco:</th>
                   <td class="parentesco-apoderado-modal" style="width: 95px;"></td>
                   
                   <th style="width: 55px;">Correo:</th>
                   <td class="correo-apoderado-modal" style="width: 155px;"></td>
                   
                   <th style="width: 60px;">Teléfono:</th>
                   <td class="telefono-apoderado-modal"></td>
                </tr>                                                                                  
            </tbody>                 
        </table>   
        <!-- ============================================================================================================ -->
        <center>
            <div style="padding: 3px; margin-left: 10px;" class="div-updown-line bottom-space-modal">
                <div style="background-color: #57bcff;">
                    <img src="../config/family.png" style="height: 30px;"> <p class="titulo-modal" style="display: inline-block; margin-left: 10px;">Antecedentes Familiares</p>
                </div>
            </div> 
        </center>
        <!-- ============================================================================================================ -->
        <table class="bottom-space-modal" style="width:100%; margin-top: 5px;">
            <tbody>
                <tr>
                    <th style="width: 170px;">Nº Personas grupo familiar:</th>
                    <td class="af_num_personas_gf_modal" style="width: 45px;">5</td>
                    
                    <th style="width: 300px;">Nº Personas que viven en el domicilio del jugador:</th>
                    <td class="af_num_personas_domicilio_modal" style="width: 30px;">2</td>
                    
                    <th style="width: 183px;">Nº Habitaciones del domicilio:</th>
                    <td class="af_num_habitaciones_domicilio_modal" style="width: 50px;">1</td>
                    
                    <th style="width: 130px;">Comparte habitación:</th>
                    <td class="af_comparte_habitacion_modal"></td>
                </tr>            
            </tbody>                 
        </table>
        <!-- ============================================================================================================ -->
        <table class="bottom-space-modal" style="width:100%; margin-top: 5px;">
            <tbody>
                <tr>
                    <th style="width: 144px;">Ingreso núcleo familiar:</th>
                    <td class="af_ingreso_nucleo_familiar_modal" style="width: 70px;"></td>
                    
                    <th style="width: 215px;">Es independiente económicamente:</th>
                    <td class="af_indep_economica_modal" style="width: 117px;"></td>
                    
                    <th style="width: 205px;">Situación conyugal de sus padres:</th>
                    <td class="af_situacion_conyugal_padres_modal"></td>
                </tr>                    
            </tbody>                 
        </table>  
        <!-- ============================================================================================================ -->
        <table class="bottom-space-modal" style="width:100%; margin-top: 5px;">
            <tbody>
                <tr>
                    <th style="width: 90px;">Nº Hermanos:</th>
                    <td class="af_num_hermanos_modal"></td>
                </tr>                 
            </tbody>                 
        </table>                
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal"><p style="text-transform: uppercase; text-decoration: underline; color: black; font-size: 13px;">detalle personas que viven con el jugador</p></div>        
        <!-- ============================================================================================================ -->
        <table id="tabla_personas_viven_conjug_modal" class="bottom-space-modal" style="width:100%; margin-top: 5px;">
            <tbody></tbody>                 
        </table>  
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal"><p style="text-transform: uppercase; text-decoration: underline; color: black; font-size: 13px;">INFORMACIÓN RELEVANTE DEL GRUPO FAMILIAR DEL JUGADOR</p></div>
        <!-- ============================================================================================================ -->
        <table class="bottom-space-modal" style="width:100%; margin-top: 5px;">
            <tbody>
                <tr>
                    <th class="af_info_grupo_familiar_modal"></th>
            </tbody>                 
        </table>         
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <div class="row-fluid">
                <div class="span12">
                    <!-- ============================================================================================================ -->
                    <div class="div-updown-line bottom-space-modal" style="width: fit-content;"><p style="text-transform: uppercase;">VALORACIÓN DEL RIESGO DEL ENTORNO FAMILIAR</p></div>                    
                </div>                    
            </div>                        
            <div class="row-fluid">
                <!-- ======================================================================== -->
                <div class="span4" style="display: flex;">
                    <div style="display: flex;margin: auto;width: 100%;">                                  
                        <div class="span12" style="display: flex;">
                            <label id="af_valoracion_modal" class=""><span></span></label>
                        </div>    
                    </div>                                                            
                </div>
                <!-- ======================================================================== -->
                <div class="span8" style="display: flex;">
                     <div id="af_valoracion_text_modal" class="big-text-modal"></div>
                </div>                                                             
            </div>                            
        </div>

        <!-- ================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ -->

        <!-- ============================================================================================================ -->
        <center>
            <div style="padding: 3px; margin-left: 10px;" class="div-updown-line bottom-space-modal">
                <div style="background-color: #57bcff;">
                    <img src="../config/relaciones_personales.png" style="height: 30px;"> <p class="titulo-modal" style="display: inline-block; margin-left: 10px;">Relaciones personales</p>
                </div>
            </div> 
        </center>        
        <!-- ============================================================================================================ -->
        <table class="bottom-space-modal" style="width:100%; margin-top: 5px;">
            <tbody>
                <tr>
                    <th style="width: 120px;">Situación amorosa:</th>
                    <td class="rp_situacion_amorosa_modal" style="width: 90px;"></td>
                    
                    <th>Hace:</th>
                    <td class="rp_hace_cuanto_modal" style="width: 50px;"></td>
                    
                    <th style="width: 195px;">Calidad de la relación en pareja:</th>
                    <td class="rp_relacion_pareja_modal" style="width: 110px;"></td>
                    
                    <th style="width: 110px;">Inició vida sexual:</th>
                    <td style="width: 30px;" class="rp_inicio_vida_sexual_modal"></td>

                    <th style="width: 140px;">Método de protección:</th>
                    <td class="rp_metodo_proteccion_modal"></td>                    
                </tr>
                <!-- ============================================================================================================ --> 
                <tr>
                    <th>Tiene hijos:</th>
                    <td class="rp_tiene_hijos_modal"></td>
                </tr>                   
            </tbody>                 
        </table>    
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <div class="row-fluid">
                <div class="span12">
                    <!-- ============================================================================================================ -->
                    <div class="div-updown-line bottom-space-modal" style="width: fit-content;"><p style="text-transform: uppercase;">VALORACIÓN DEL RIESGO DE LAS RELACIONES PERSONALES</p></div>                    
                </div>                    
            </div>                        
            <div class="row-fluid">
                <!-- ======================================================================== -->
                <div class="span4" style="display: flex;">
                    <div style="display: flex;margin: auto;width: 100%;">                                  
                        <div class="span12" style="display: flex;">
                            <label id="rp_valoracion_modal" class=""><span></span></label>
                        </div>    
                    </div>                                                            
                </div>
                <!-- ======================================================================== -->
                <div class="span8" style="display: flex;">
                     <div id="rp_valoracion_text_modal" class="big-text-modal"></div>
                </div>                                                             
            </div>                              
        </div>

        <!-- ================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ -->        

        <!-- ============================================================================================================ -->
        <center>
            <div style="padding: 3px; margin-left: 10px;" class="div-updown-line bottom-space-modal">
                <div style="background-color: #57bcff;">
                    <img src="../config/alimentacion.png" style="height: 30px;"> <p class="titulo-modal" style="display: inline-block; margin-left: 10px;">Alimentación</p>
                </div>
            </div> 
        </center>        
        <!-- ============================================================================================================ -->
        <table class="bottom-space-modal" style="width:100%; margin-top: 5px;">
            <tbody>
                <tr>
                    <th>Puede costear su alimentación:</th>
                    <td class="a_costear_alimentacion_modal"></td>
                    
                    <th>Observaciones:</th>
                    <td class="a_observaciones_modal"></td>                 
                </tr>
                <!-- ============================================================================================================ --> 
                <tr>
                    <th>Comidas que realiza en el club:</th>
                    <td class="a_comidas_club_modal"></td>
                    
                    <th>Comidas que realiza al día:</th>
                    <td class="a_comidas_diarias_modal"></td>                 
                </tr>                  
            </tbody>                 
        </table>    
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <div class="row-fluid">
                <div class="span12">
                    <!-- ============================================================================================================ -->
                    <div class="div-updown-line bottom-space-modal" style="width: fit-content;"><p style="text-transform: uppercase;">VALORACIÓN DEL RIESGO DE LA ALIMENTACIÓN</p></div>                    
                </div>                    
            </div>                        
            <div class="row-fluid">
                <!-- ======================================================================== -->
                <div class="span4" style="display: flex;">
                    <div style="display: flex;margin: auto;width: 100%;">                                  
                        <div class="span12" style="display: flex;">
                            <label id="a_valoracion_modal" class=""><span></span></label>
                        </div>    
                    </div>                                                            
                </div>
                <!-- ======================================================================== -->
                <div class="span8" style="display: flex;">
                     <div id="a_valoracion_text_modal" class="big-text-modal"></div>
                </div>                                                             
            </div>                            
        </div>

        <!-- ================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ --> 

        <!-- ============================================================================================================ -->
        <center>
            <div style="padding: 3px; margin-left: 10px;" class="div-updown-line bottom-space-modal">
                <div style="background-color: #57bcff;">
                    <img src="../config/bus.png" style="height: 30px;"> <p class="titulo-modal" style="display: inline-block; margin-left: 10px;">Locomoción</p>
                </div>
            </div> 
        </center>        
        <!-- ============================================================================================================ -->
        <table class="bottom-space-modal" style="width:100%; margin-top: 5px;">
            <tbody>
                <tr>
                    <th>Como llega al club:</th>
                    <td class="llegada_club_modal"></td>
                    
                    <th>Medio:</th>
                    <td class="mediotrans_llegada_club_modal"></td>  

                    <th>Como se va del club a su casa:</th>
                    <td class="ida_club_modal"></td>    

                    <th>Medio:</th>
                    <td class="mediotrans_ida_club_modal"></td>       
                    
                    <th>Observaciones:</th>
                    <td class="l_observaciones_modal">Sin observaciones</td>                                                                                 
                </tr>         
            </tbody>                 
        </table>    
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <div class="row-fluid">
                <div class="span12">
                    <!-- ============================================================================================================ -->
                    <div class="div-updown-line bottom-space-modal" style="width: fit-content;"><p style="text-transform: uppercase;">VALORACIÓN DEL RIESGO DE LA LOCOMOCIÓN</p></div>                    
                </div>                    
            </div>                        
            <div class="row-fluid">
                <!-- ======================================================================== -->
                <div class="span4" style="display: flex;">
                    <div style="display: flex;margin: auto;width: 100%;">                                  
                        <div class="span12" style="display: flex;">
                            <label id="l_valoracion_modal" class=""><span></span></label>
                        </div>    
                    </div>                                                            
                </div>
                <!-- ======================================================================== -->
                <div class="span8" style="display: flex;">
                     <div id="l_valoracion_text_modal" class="big-text-modal"></div>
                </div>                                                             
            </div>                           
        </div>

        <!-- ================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ -->  

        <!-- ============================================================================================================ -->
        <center>
            <div style="padding: 3px; margin-left: 10px;" class="div-updown-line bottom-space-modal">
                <div style="background-color: #57bcff;">
                    <img src="../config/salud.png" style="height: 30px;"> <p class="titulo-modal" style="display: inline-block; margin-left: 10px;">Salud</p>
                </div>
            </div> 
        </center>        
        <!-- ============================================================================================================ -->
        <table style="width:100%; margin-top: 5px;">
            <tbody>
                <tr>
                    <th>Consume drogas:</th>
                    <td class="s_consume_drogas_modal"></td>
                    
                    <th>Drogas que ha probado:</th>
                    <td class="drogas_probadas_jugador_modal"></td>  

                    <th>Familiar consume drogas:</th>
                    <td class="s_familiar_consume_drogas_modal"></td>    

                    <th>Quien / es:</th>
                    <td class="s_quien_consume_drogas_familiar_modal"></td>       
                    
                    <th>Que drogas:</th>
                    <td class="s_drogas_consumidas_familiar_modal"></td>                                                                                 
                </tr>         
            </tbody>                 
        </table>    
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <div class="row-fluid">
                <div class="span12">
                    <!-- ============================================================================================================ -->
                    <div class="div-updown-line bottom-space-modal" style="width: fit-content;"><p style="text-transform: uppercase;">VALORACIÓN DEL RIESGO DE SALUD</p></div>                    
                </div>                    
            </div>                        
            <div class="row-fluid">
                <!-- ======================================================================== -->
                <div class="span4" style="display: flex;">
                    <div style="display: flex;margin: auto;width: 100%;">                                  
                        <div class="span12" style="display: flex;">
                            <label id="s_valoracion_modal" class=""><span></span></label>
                        </div>    
                    </div>                                                            
                </div>
                <!-- ======================================================================== -->
                <div class="span8" style="display: flex;">
                     <div id="s_valoracion_text_modal" class="big-text-modal"></div>
                </div>                                                             
            </div>                            
        </div>

        <!-- ================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ --> 


        <!-- ============================================================================================================ -->
        <center>
            <div style="padding: 3px; margin-left: 10px;" class="div-updown-line bottom-space-modal">
                <div style="background-color: #57bcff;">
                    <img src="../config/juicio.png" style="height: 30px;"> <p class="titulo-modal" style="display: inline-block; margin-left: 10px; position: relative; top: 2px;">Antecedentes judiciales</p>
                </div>
            </div> 
        </center>        
        <!-- ============================================================================================================ -->
        <table style="width:100%; margin-top: 5px;">
            <tbody>
                <tr>
                    <th>Antecedentes:</th>
                    <td class="aj_jugador_antecedentes_modal"></td>
                    
                    <th>Familiar con antecedentes:</th>
                    <td class="aj_familiar_antecedentes_modal"></td>                                                                                  
                </tr>         
            </tbody>                 
        </table>    
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <div class="row-fluid">
                <div class="span12">
                    <!-- ============================================================================================================ -->
                    <div class="div-updown-line bottom-space-modal" style="width: fit-content;"><p style="text-transform: uppercase;">VALORACIÓN DEL RIESGO JUDICIAL</p></div>                    
                </div>                    
            </div>                        
            <div class="row-fluid">
                <!-- ======================================================================== -->
                <div class="span4" style="display: flex;">
                    <div style="display: flex;margin: auto;width: 100%;">                                  
                        <div class="span12" style="display: flex;">
                            <label id="aj_valoracion_modal" class=""><span></span></label>
                        </div>    
                    </div>                                                            
                </div>
                <!-- ======================================================================== -->
                <div class="span8" style="display: flex;">
                     <div id="aj_valoracion_text_modal" class="big-text-modal"></div>
                </div>                                                             
            </div>                              
        </div>

        <!-- ================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ --> 

        <!-- ============================================================================================================ -->
        <center>
            <div class="div-updown-line bottom-space-modal"><p class="titulo-modal">Otros datos</p></div> 
        </center>
        <!-- ============================================================================================================ -->
        <table class="bottom-space-modal" style="width:100%; margin-top: 5px;">
            <tbody>
                <tr>
                    <th>Seguro contra accidentes:</th>
                    <td class="od_tiene_seguro_modal"></td>
                    
                    <th>Compañia:</th>
                    <td class="od_nombre_compania_seguro_modal"></td>   

                    <th>Vencimiento:</th>
                    <td class="od_seguro_vencimiento_modal"></td>          

                    <th>Tiene pasaporte:</th>
                    <td class="od_tiene_pasaporte_modal"></td>  
                    
                    <th>Venc. Carnet Identidad:</th>
                    <td class="od_vencimiento_carnetid_modal"></td>                                                                                                                            
                </tr>         
            </tbody>                 
        </table>    
        <!-- ============================================================================================================ -->
        <div class="bottom-space-modal">
            <div class="row-fluid">
                <div class="span12">
                    <!-- ============================================================================================================ -->
                    <div class="div-updown-line bottom-space-modal" style="width: fit-content;"><p style="text-transform: uppercase;">OBSERVACIONES</p></div>                    
                </div>                    
            </div>                        
            <div class="row-fluid">
                <!-- ======================================================================== -->
                <div class="span12" style="display: flex;">
                    <div id="od_observaciones_modal" class="big-text-modal" style="width: 70%; margin: auto;"></div>
                </div>                                                             
            </div>                            
        </div>

        <!-- ================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================================ -->                          

    </div>


</div>
<!-- ========================================== Fin del id="modal_detalle_visita_social" ========================================== -->


<!-- ========================================== Inicio del id="modal_detalle_visita_social" ========================================== -->
<div id="modal_agregar_registro_otro" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
     <center>
            <br>
            <div id="mensaje_agregar_registro_otro">
              <h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button onclick="boton_cerrar_confirm_tipoayuda_otro();" type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " id="btn_modal_guardar_tipoayuda_otro" onclick="" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>    
<!-- ========================================== Fin del id="modal_detalle_visita_social" ========================================== -->

<div id="myModalDescargarBoleta" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?> border-top-right-radius: 5px; border-top-left-radius: 5px;">
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
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?> border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_registro();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>    

<div id="myModalDescargarExcel" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?> border-top-right-radius: 5px; border-top-left-radius: 5px;">
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
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?> border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="boton_aceptar_excel();" ng-click="desactivarBotonAgregarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>

<div id="myModal2" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?> border-top-right-radius: 5px; border-top-left-radius: 5px;">
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
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?> border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar_informe();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>


<!-- VIEW JUGADOR -->
<div id="view_ejercicio" class="modal hide" style="border-radius:10px; width: 700px; height: 500px;">

    <div class="modal-header" style="margin-left: 1px; background-color: white; border: white; border-top-right-radius: 5px; border-top-left-radius: 5px;height: 20px">
        <div>

            <hr style="display: inline-block; margin-right: 30px; width: 270px; border: 1px solid #e3e3e3;">
            <img src="../config/udc.png" style="width:75px; margin-top:5px;">
            
            <hr style="display: inline-block; margin-left: 30px; width: 250px; border: 1px solid #e3e3e3;">
            <h3 style="margin-left: 17px;"><center>CARGA DIARIA</center></h3>

            <!-- <div class="hr-line"></div>
            <fieldset>
                <legend>
                    <img src="../config/udc.png" style="width:75px; margin-top:5px;">
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


<div id="myModal1" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?> border-top-right-radius: 5px; border-top-left-radius: 5px;">
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
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?> border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
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

// Función que oculta divs y tablas por defecto:
function ocultar_div_tablas_defult() {

    $('.div-comparte-habitacion').hide();
    $('.div-en-pareja-si').hide();
    $('.div-hijos-si').hide();
    $('.div-datos-hijos-si').hide();
    $('.div-consume-drogas-si').hide();
    $('.div-jugador-tiene-antecedentes-si').hide();
    $('.div-familiar-tiene-antecedentes-si').hide();
    $('.div-seguro-si').hide();
    $('.div-pasaporte-si').hide();
    $('.div-forma-llegada-club-otro').hide();
    $('.div-personas-viven-conjug').hide();
    $('.div-familiar-consume-drogas-si').hide();

    $('#tabla_personas_viven_conjug tbody').empty();
    $('#tabla_personas_viven_conjug').hide();

    $('#tabla_datos_hijos').html('');
    $('#tabla_datos_hijos').hide();

    // ------- PADRE ------- //
    $('.div-padre-discapacidad-si').hide();
    $('.div-padre-trabaja-si').hide();
    $('.div-padre-cesante-jubilado-si').hide();

    // ------- MADRE ------- //
    $('.div-madre-discapacidad-si').hide();
    $('.div-madre-trabaja-si').hide();
    $('.div-madre-cesante-jubilado-si').hide();


    $('ul').siblings().find('.titulo_multi').html('Seleccione');

}

// Función que muestra los divs que pueden ocultarse y mostrarse pulsando el icono de la flecha:
function mostrar_divs_flecha() {
    $('.div-antecedentes-familiares').show();
    $('.div-relaciones-personales').show();
    $('.div-alimentacion').show();
    $('.div-locomocion').show();
    $('.div-salud').show();
    $('.div-antecedentes-judiciales').show();
    $('.div-otros-datos').show();
}

ocultar_div_tablas_defult(); // <-------- Ocultando divs y tablas por defecto

$('#af_num_personas_domicilio').on('mouseup keypress keyup keydown', function(){

    $('.div-personas-viven-conjug').hide();
    

    let thisValue = $(this).val();
    thisValue = parseInt( thisValue );

    if( thisValue > 0 ) {

        $('.div-personas-viven-conjug').show();
        $('#tabla_personas_viven_conjug').show();
        //$('#tabla_personas_viven_conjug tbody').empty();

        for( let i=0; i<thisValue; i++ ) {

            let tr = $('#tr_personas_viven_conjug_'+i+'');

            if( tr.length ) {

                let valor = thisValue - 1;

                $('#tabla_personas_viven_conjug tbody tr').each(function(){
                    let tr_id = $(this).attr('id');
                    let tr_id_number = tr_id.substr(tr_id.length - 1); // => "1"
                    if( valor < tr_id_number ) {
                        $(this).remove();
                    }
                });


            } else {

                let markup = 
                '<tr id="tr_personas_viven_conjug_'+i+'">\
                    <td style="display: inline-block;width: 20%;">\
                        <label>Nombre</label>\
                       <input type="text" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="blue-input" id="input_nombre_domicilio_jugador_'+i+'" name="array_nombre_domicilio_jugador[]" style="background-color: white;width: 80%; text-align: left;">\
                    </td>\
                    <td style="display: inline-block;width: 20%;">\
                        <label>Parentesco</label>\
                       <select onchange="chequear_datos();" class="blue-input select-parentesco" id="input_parentesco_domicilio_jugador_'+i+'" name="array_parentesco_domicilio_jugador[]" style="background-color: white;width: 80%;"></select>\
                    </td>\
                    <td style="display: inline-block;width: 15%;">\
                        <label>Edad</label>\
                       <input type="number" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="blue-input" id="input_edad_domicilio_jugador_'+i+'" name="array_edad_domicilio_jugador[]" style="background-color: white;">\
                    </td>\
                    <td style="display: inline-block;width: 20%;">\
                        <label>Nivel educacional</label>\
                       <select onchange="chequear_datos();" class="blue-input select-nivel-educacional" id="input_nivel_educacional_domicilio_jugador_'+i+'" name="array_nivel_educacional_domicilio_jugador[]" style="background-color: white;width: 80%;"></select>\
                    </td>\
                    <td style="display: inline-block;width: 20%;">\
                        <label>Ocupación</label>\
                       <input type="text" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="blue-input" id="input_ocupacion_domicilio_jugador_'+i+'" name="array_ocupacion_domicilio_jugador[]" style="background-color: white;width: 80%; text-align: left;">\
                    </td>\
                </tr>\
                ';

                $('#tabla_personas_viven_conjug tbody').append( markup );


                agregar_parentesco_select( 2 );
                agregar_nivel_educacional_select();

            }


        }


    } else {
        $('.div-personas-viven-conjug').hide();
        $('#tabla_personas_viven_conjug tbody').empty();
        $('#tabla_personas_viven_conjug').hide();        
    }

});

$('#rp_num_hijos').on('mouseup keypress keyup keydown', function(){

    $('.div-datos-hijos-si').hide();
    // $('#tabla_datos_hijos').html('');

    let thisValue = $(this).val();
    thisValue = parseInt( thisValue );

    if( thisValue > 0 ) {

        $('.div-datos-hijos-si').show();
        $('#tabla_datos_hijos').show();
        // $('#tabla_datos_hijos').html('');

        for( let i=0; i<thisValue; i++ ) {

            let tr = $('#tr_datos_hijos_'+i+'');

            if( tr.length ) {

                let valor = thisValue - 1;

                $('.tr_datos_hijos_class').each(function(){

                    // $(this).css('background-color', 'red');
                    
                    let tr_id = $(this).attr('id');
                    let tr_id_number = tr_id.substr(tr_id.length - 1); // => "1"
                    if( valor < tr_id_number ) {
                        $(this).remove();
                    }
                    
                });

            } else {

                let markup = 
                '<div id="tr_datos_hijos_'+i+'" class="row-fluid tr_datos_hijos_class" style="margin-bottom: 20px;">\
                    <div class="span6" style="display: flex;">\
                        <div class="span12">\
                            <div class="span5" style="display: flex;">\
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">Edad Hijo</p></div></a><input style="height: 20px;" type="number" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="gray-input" id="input_edadhijo_jugador_'+i+'" name="array_edadhijo_jugador[]"/>\
                            </div>\
                            <div class="span7" style="display: flex;">\
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%; padding: 4px 5px;"><div><p class="ellipsis-text" style="font-weight: normal;">Con quien vive hijo</p></div></a><input style="height: 20px;" type="text" onkeyup="chequear_datos();" onkeyup="chequear_datos();" onkeydown="chequear_datos();" class="gray-input" id="input_vivecon_hijo_jugador_'+i+'" name="array_vivecon_hijo_jugador[]"/>\
                            </div>\
                        </div>\
                    </div>\
                    <div class="span6" style="display: flex;">\
                        <div class="span12">\
                            <a class="btn btn-md btn-primary gray-a" style="width: 25%; padding: 3px 5px;"><div><p class="ellipsis-text" style="font-weight: normal;">Cada cuanto lo ve</p></div></a><input style="height: 18px;" type="text" onkeyup="chequear_datos();" onkeyup="chequear_datos();" onkeydown="chequear_datos();" class="gray-input" id="input_tiempocon_hijo_jugador_'+i+'" name="array_tiempocon_hijo_jugador[]"/>\
                        </div>\
                    </div>\
                </div>';

                $('#tabla_datos_hijos').append( markup );


            }
        }

    } else {
        $('.div-datos-hijos-si').hide();
        $('#tabla_datos_hijos').hide();
        $('#tabla_datos_hijos').html('');     
    }

});

// Eventos onchange para ocultar/mostrar divs:

// - Comparte habitación:
$('#af_comparte_habitacion').change(function(){
    let thisValue = $(this).val();
    if( thisValue == '1' ) { // Sí
        $('.div-comparte-habitacion').show();
    } else {
        $('.div-comparte-habitacion').hide();
    }
});

// - Situación amorosa:
$('#rp_situacion_amorosa').change(function(){
    let thisValue = $(this).val();
    if( thisValue == '1' ) { // <--- En pareja
        $('.div-en-pareja-si').show();
        agregar_relacion_pareja_select(); // <--- Agregando datos del array al select.
    } else {
        $('.div-en-pareja-si').hide();
    }
});

// - Tiene hijos:
$('#rp_tiene_hijos').change(function(){
    let thisValue = $(this).val();
    if( thisValue == '1' ) { // <--- Sí
        $('.div-hijos-si').show();
    } else {
        $('.div-hijos-si').hide();
    }
});

// - Jugador tiene antecedentes:
$('#aj_jugador_tiene_antecedentes').change(function(){
    let thisValue = $(this).val();
    if( thisValue == '1' ) { // <--- Sí
        $('.div-jugador-tiene-antecedentes-si').show();
    } else {
        $('.div-jugador-tiene-antecedentes-si').hide();
    }
});

// - Familiar tiene antecedentes:
$('#aj_familiar_tiene_antecedentes').change(function(){
    let thisValue = $(this).val();
    if( thisValue == '1' ) { // <--- Sí
        $('.div-familiar-tiene-antecedentes-si').show();
    } else {
        $('.div-familiar-tiene-antecedentes-si').hide();
    }
});


// - ¿Consume drogas?:
$('#s_consume_drogas').change(function(){
    let thisValue = $(this).val();
    if( thisValue == '1' ) { // <--- Sí
        $('.div-consume-drogas-si').show();
    } else {
        $('.div-consume-drogas-si').hide();
    }
});

// - ¿Familiar drogas?:
$('#s_familiar_consume_drogas').change(function(){
    let thisValue = $(this).val();
    if( thisValue == '1' ) { // <--- Sí
        $('.div-familiar-consume-drogas-si').show();
    } else {
        $('.div-familiar-consume-drogas-si').hide();
    }
});

// - ¿Tiene seguro?:
$('#od_tiene_seguro').change(function(){
    let thisValue = $(this).val();
    if( thisValue == '1' ) { // <--- Sí
        $('.div-seguro-si').show();
    } else {
        $('.div-seguro-si').hide();      
    }
});

// - ¿Tiene pasaporte?:
$('#od_tiene_pasaporte').change(function(){
    let thisValue = $(this).val();
    if( thisValue == '1' ) { // <--- Sí
        $('.div-pasaporte-si').show();
    } else {
        $('.div-pasaporte-si').hide();
    }
});

// - ¿Tiene discapacidad? (Padre):
$('#od_padre_tiene_discapacidad').change(function(){
    let thisValue = $(this).val();
    if( thisValue == '1' ) { // <--- Sí
        $('.div-padre-discapacidad-si').show();
    } else {
        $('.div-padre-discapacidad-si').hide();
    }
});

// - ¿Tiene discapacidad? (Madre):
$('#od_madre_tiene_discapacidad').change(function(){
    let thisValue = $(this).val();
    if( thisValue == '1' ) { // <--- Sí
        $('.div-madre-discapacidad-si').show();
    } else {
        $('.div-madre-discapacidad-si').hide();
    }
});

// - ¿Se encuentra trabajando actualmente? (Padre):
$('#od_padre_trabaja').change(function(){
    let thisValue = $(this).val();
    if( thisValue == '1' ) { // <--- Sí
        $('.div-padre-cesante-jubilado-si').hide();
        $('.div-padre-trabaja-si').show();
    } else {
        $('.div-padre-trabaja-si').hide();
        $('.div-padre-cesante-jubilado-si').show();
    }
});

// - ¿Se encuentra trabajando actualmente? (Madre):
$('#od_madre_trabaja').change(function(){
    let thisValue = $(this).val();
    if( thisValue == '1' ) { // <--- Sí
        $('.div-madre-cesante-jubilado-si').hide();
        $('.div-madre-trabaja-si').show();
    } else {
        $('.div-madre-trabaja-si').hide();
        $('.div-madre-cesante-jubilado-si').show();
    }
});


// --------------------- Inicio de la función 'buscar_formas_llegada_club()' --------------------- //
function buscar_formas_llegada_club( linea ) {
    
    $.ajax({
        url: "post/jugadores_ver_datos.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_llegada_ida_club',    
        },success: function(respuesta){

            // Vaciando el ul(s):
            $('#ul_forma_llegada_club').html('');
            $('#ul_forma_ida_club').html('');

            // --------------------------------- ul - LLEGADA --------------------------------- //

            if( linea !== -1 ){ // <------ EDITAR

                if( datos_visita_social[linea]['array_visitasocial_llegada_club'] != null ) { // Si el usuario al menos seleccionó un opción... 

                    let array_id_llegada_ida_club = [];
                    for (var i = 0; i < datos_visita_social[linea]['array_visitasocial_llegada_club'].length; i++) {
                        let idllegada_ida_club = datos_visita_social[linea]['array_visitasocial_llegada_club'][i]['idllegada_ida_club'];
                        array_id_llegada_ida_club[i] = idllegada_ida_club;
                    }  

                    // $('#ul_forma_llegada_club').show();

                    $('#ul_forma_llegada_club').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_llegada_club input_multiple input_checkbox_todos" value="001" data-eliminar="0"></label></li>');

                    for(var i=0; i < respuesta.length; i++) {   

                        // console.log( array_id_llegada_ida_club );

                        let n = array_id_llegada_ida_club.includes( respuesta[i]['idllegada_ida_club'] );

                        let attr_check = '';
                        if( n ) {
                            // alert( 'Si' );
                            attr_check = 'checked';
                        } else {
                            // alert( 'No' );
                        }

                        $('#ul_forma_llegada_club').append('<li><label class="option li-registro-regular"><span class="label_s">'+respuesta[i]['descripcion_llegada_ida_club']+'</span> <input '+attr_check+' type="checkbox" name="array_llegada_club[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['idllegada_ida_club']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
                    }               

                    $('#ul_forma_llegada_club').append('<li style="display: none;" class="li_input_text_otro"><label class="option"><input type="text" id="input_text_forma_llegada_otro" class="array_llegada_club input-ayuda-social" style="width: 120px; border: 1px solid #d8d5d5; background-color: white; border-radius: 5px; margin: 5px 0px;" onkeyup="chequear_datos();" onkeydown="chequear_datos();"><a class="icono-agregar-otro" onclick="boton_guardar_registro_otro(1);"><i class="icon-plus"></i></a></label></li>');

                    $('#ul_forma_llegada_club').append('<li class="li_otro"><label class="option"><span class="label_s">Otro</span> <input type="checkbox" name="array_llegada_club[]" class="array_llegada_club input_multiple input_otro_checkbox" value="000" data-eliminar="0" onchange="chequear_datos();""></label></li>');

                     // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
                    let numero_select = 0;
                    let nombre_option = '';

                    $('#ul_forma_llegada_club input[type="checkbox"]').each(function () {

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
                    if ($('#ul_forma_llegada_club input[type="checkbox"]').prop('checked')) {
                        if ($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar') != 0) {
                            let posicion = window.eliminarObjetivos.indexOf($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar'));
                            if (posicion != -1) { window.eliminarObjetivos.splice(posicion, 1); }
                        }
                    } else {
                        if ($('#ul_forma_llegada_club input[type="checkbox"]').attr('data-eliminar') != 0) { window.eliminarObjetivos.push($('#ul_forma_llegada_club input[type="checkbox"]').attr('data-eliminar')); }
                    }
                    
                    $('#ul_forma_llegada_club input[type="checkbox"]').closest('ul').siblings().find('.titulo_multi').html(descripcion);

                }                

            } else { // <------ INCLUIR

                $('#ul_forma_llegada_club').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_llegada_club input_multiple input_checkbox_todos" value="001" data-eliminar="0"></label></li>');

                for(var i=0; i < respuesta.length; i++) {   

                    $('#ul_forma_llegada_club').append('<li><label class="option li-registro-regular"><span class="label_s">'+respuesta[i]['descripcion_llegada_ida_club']+'</span> <input type="checkbox" name="array_llegada_club[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['idllegada_ida_club']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
                }               

                $('#ul_forma_llegada_club').append('<li style="display: none;" class="li_input_text_otro"><label class="option"><input type="text" id="input_text_forma_llegada_otro" class="array_llegada_club input-ayuda-social" style="width: 120px; border: 1px solid #d8d5d5; background-color: white; border-radius: 5px; margin: 5px 0px;" onkeyup="chequear_datos();" onkeydown="chequear_datos();"><a class="icono-agregar-otro" onclick="boton_guardar_registro_otro(1);"><i class="icon-plus"></i></a></label></li>');

                $('#ul_forma_llegada_club').append('<li class="li_otro"><label class="option"><span class="label_s">Otro</span> <input type="checkbox" name="array_llegada_club[]" class="array_llegada_club input_multiple input_otro_checkbox" value="000" data-eliminar="0" onchange="chequear_datos();""></label></li>');

            }


            // --------------------------------- ul - IDA --------------------------------- //


            if( linea !== -1 ) { // <------ EDITAR
 
                if( datos_visita_social[linea]['array_visitasocial_ida_club'] != null ) { // Si el usuario al menos seleccionó un opción... 

                    let array_id_llegada_ida_club = [];
                    for (var i = 0; i < datos_visita_social[linea]['array_visitasocial_ida_club'].length; i++) {
                        let idllegada_ida_club = datos_visita_social[linea]['array_visitasocial_ida_club'][i]['idllegada_ida_club'];
                        array_id_llegada_ida_club[i] = idllegada_ida_club;
                    }  

                    // $('#ul_forma_ida_club').show();

                    $('#ul_forma_ida_club').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_ida_club input_multiple input_checkbox_todos" value="001" data-eliminar="0"></label></li>');

                    for(var i=0; i < respuesta.length; i++) {   

                        // console.log( array_id_llegada_ida_club );

                        let n = array_id_llegada_ida_club.includes( respuesta[i]['idllegada_ida_club'] );

                        let attr_check = '';
                        if( n ) {
                            // alert( 'Si' );
                            attr_check = 'checked';
                        } else {
                            // alert( 'No' );
                        }

                        $('#ul_forma_ida_club').append('<li><label class="option li-registro-regular"><span class="label_s">'+respuesta[i]['descripcion_llegada_ida_club']+'</span> <input '+attr_check+' type="checkbox" name="array_ida_club[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['idllegada_ida_club']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
                    }               

                    $('#ul_forma_ida_club').append('<li style="display: none;" class="li_input_text_otro"><label class="option"><input type="text" id="input_text_forma_ida_otro" class="array_ida_club input-ayuda-social" style="width: 120px; border: 1px solid #d8d5d5; background-color: white; border-radius: 5px; margin: 5px 0px;" onkeyup="chequear_datos();" onkeydown="chequear_datos();"><a class="icono-agregar-otro" onclick="boton_guardar_registro_otro(1);"><i class="icon-plus"></i></a></label></li>');

                    $('#ul_forma_ida_club').append('<li class="li_otro"><label class="option"><span class="label_s">Otro</span> <input type="checkbox" name="array_ida_club[]" class="array_ida_club input_multiple input_otro_checkbox" value="000" data-eliminar="0" onchange="chequear_datos();""></label></li>');

                     // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
                    let numero_select = 0;
                    let nombre_option = '';

                    $('#ul_forma_ida_club input[type="checkbox"]').each(function () {

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
                    if ($('#ul_forma_ida_club input[type="checkbox"]').prop('checked')) {
                        if ($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar') != 0) {
                            let posicion = window.eliminarObjetivos.indexOf($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar'));
                            if (posicion != -1) { window.eliminarObjetivos.splice(posicion, 1); }
                        }
                    } else {
                        if ($('#ul_forma_ida_club input[type="checkbox"]').attr('data-eliminar') != 0) { window.eliminarObjetivos.push($('#ul_forma_ida_club input[type="checkbox"]').attr('data-eliminar')); }
                    }
                    
                    $('#ul_forma_ida_club input[type="checkbox"]').closest('ul').siblings().find('.titulo_multi').html(descripcion);

                } 

            } else { // <------ INCLUIR

                $('#ul_forma_ida_club').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_ida_club input_multiple input_checkbox_todos" value="001" data-eliminar="0"></label></li>');

                for(var i=0; i < respuesta.length; i++) {   

                    $('#ul_forma_ida_club').append('<li><label class="option li-registro-regular"><span class="label_s">'+respuesta[i]['descripcion_llegada_ida_club']+'</span> <input type="checkbox" name="array_ida_club[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['idllegada_ida_club']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
                }               

                $('#ul_forma_ida_club').append('<li style="display: none;" class="li_input_text_otro"><label class="option"><input type="text" id="input_text_forma_ida_otro" class="array_ida_club input-ayuda-social" style="width: 120px; border: 1px solid #d8d5d5; background-color: white; border-radius: 5px; margin: 5px 0px;" onkeyup="chequear_datos();" onkeydown="chequear_datos();"><a class="icono-agregar-otro" onclick="boton_guardar_registro_otro(2);"><i class="icon-plus"></i></a></label></li>');

                $('#ul_forma_ida_club').append('<li class="li_otro"><label class="option"><span class="label_s">Otro</span> <input type="checkbox" name="array_ida_club[]" class="array_ida_club input_multiple input_otro_checkbox" value="000" data-eliminar="0" onchange="chequear_datos();""></label></li>');

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
// --------------------- Fin de la función 'buscar_formas_llegada_club()' --------------------- //

// --------------------- Inicio de la función 'buscar_medio_transporte()' --------------------- //
function buscar_medio_transporte( linea ) {
    
    $.ajax({
        url: "post/jugadores_ver_datos.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_medio_transporte',    
        },success: function(respuesta){

            // Vaciando el ul(s):
            $('#ul_mediotrans_llegada_club').html('');
            $('#ul_mediotrans_ida_club').html('');


            // --------------------------------- ul - LLEGADA --------------------------------- //

            if( linea !== -1 ){ // <------ EDITAR

                if( datos_visita_social[linea]['array_visitasocial_mediotrans_llegada'] != null ) { // Si el usuario al menos seleccionó un opción...

                    let array_idmedio_transporte = [];
                    for (var i = 0; i < datos_visita_social[linea]['array_visitasocial_mediotrans_llegada'].length; i++) {
                        let idmedio_transporte = datos_visita_social[linea]['array_visitasocial_mediotrans_llegada'][i]['idmedio_transporte'];
                        array_idmedio_transporte[i] = idmedio_transporte;
                    }  

                    $('#ul_mediotrans_llegada_club').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_medio_transporte_llegada input_multiple input_checkbox_todos" value="001" data-eliminar="0"></label></li>');
                    for(var i=0; i < respuesta.length; i++) {   

                        // console.log( array_id_llegada_ida_club );

                        let n = array_idmedio_transporte.includes( respuesta[i]['idmedio_transporte'] );

                        let attr_check = '';
                        if( n ) {
                            // alert( 'Si' );
                            attr_check = 'checked';
                        } else {
                            // alert( 'No' );
                        }

                        $('#ul_mediotrans_llegada_club').append('<li><label class="option li-registro-regular"><span class="label_s">'+respuesta[i]['descripcion_medio_transporte']+'</span> <input '+attr_check+' type="checkbox" name="array_medio_transporte_llegada[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['idmedio_transporte']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
                    }     

                    // $('#ul_mediotrans_llegada_club').append('<li><label class="option"><span class="label_s">0tro</span> <input type="checkbox" name="array_medio_transporte_llegada[]" class="array_idtipo_ayuda_filtro input_multiple" value="000" data-eliminar="0" onclick="buscador();" ></label></li>');


                     // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
                    let numero_select = 0;
                    let nombre_option = '';

                    $('#ul_mediotrans_llegada_club input[type="checkbox"]').each(function () {

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
                    if ($('#ul_mediotrans_llegada_club input[type="checkbox"]').prop('checked')) {
                        if ($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar') != 0) {
                            let posicion = window.eliminarObjetivos.indexOf($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar'));
                            if (posicion != -1) { window.eliminarObjetivos.splice(posicion, 1); }
                        }
                    } else {
                        if ($('#ul_mediotrans_llegada_club input[type="checkbox"]').attr('data-eliminar') != 0) { window.eliminarObjetivos.push($('#ul_mediotrans_llegada_club input[type="checkbox"]').attr('data-eliminar')); }
                    }
                    
                    $('#ul_mediotrans_llegada_club input[type="checkbox"]').closest('ul').siblings().find('.titulo_multi').html(descripcion);                    

                }

            } else { // <------ INCLUIR

                $('#ul_mediotrans_llegada_club').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_medio_transporte_llegada input_multiple input_checkbox_todos" value="001" data-eliminar="0"></label></li>');
                for(var i=0; i < respuesta.length; i++) {   

                    $('#ul_mediotrans_llegada_club').append('<li><label class="option li-registro-regular"><span class="label_s">'+respuesta[i]['descripcion_medio_transporte']+'</span> <input type="checkbox" name="array_medio_transporte_llegada[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['idmedio_transporte']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
                }               

                // $('#ul_mediotrans_llegada_club').append('<li><label class="option"><span class="label_s">0tro</span> <input type="checkbox" name="array_medio_transporte_llegada[]" class="array_idtipo_ayuda_filtro input_multiple" value="000" data-eliminar="0" onclick="buscador();" ></label></li>');

            }

            // --------------------------------- ul - IDA --------------------------------- //


            if( linea !== -1 ) { // <------ EDITAR

                if( datos_visita_social[linea]['array_visitasocial_mediotrans_ida'] != null ) { // Si el usuario al menos seleccionó un opción...

                    let array_idmedio_transporte = [];
                    for (var i = 0; i < datos_visita_social[linea]['array_visitasocial_mediotrans_ida'].length; i++) {
                        let idmedio_transporte = datos_visita_social[linea]['array_visitasocial_mediotrans_ida'][i]['idmedio_transporte'];
                        array_idmedio_transporte[i] = idmedio_transporte;
                    }  

                    $('#ul_mediotrans_ida_club').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_medio_transporte_ida input_multiple input_checkbox_todos" value="001" data-eliminar="0"></label></li>');
                    for(var i=0; i < respuesta.length; i++) {   

                        // console.log( array_id_ida_ida_club );

                        let n = array_idmedio_transporte.includes( respuesta[i]['idmedio_transporte'] );

                        let attr_check = '';
                        if( n ) {
                            // alert( 'Si' );
                            attr_check = 'checked';
                        } else {
                            // alert( 'No' );
                        }

                        $('#ul_mediotrans_ida_club').append('<li><label class="option li-registro-regular"><span class="label_s">'+respuesta[i]['descripcion_medio_transporte']+'</span> <input '+attr_check+' type="checkbox" name="array_medio_transporte_ida[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['idmedio_transporte']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
                    }     

                    // $('#ul_mediotrans_ida_club').append('<li><label class="option"><span class="label_s">0tro</span> <input type="checkbox" name="array_medio_transporte_ida[]" class="array_idtipo_ayuda_filtro input_multiple" value="000" data-eliminar="0" onclick="buscador();" ></label></li>'); 

                     // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
                    let numero_select = 0;
                    let nombre_option = '';

                    $('#ul_mediotrans_ida_club input[type="checkbox"]').each(function () {

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
                    if ($('#ul_mediotrans_ida_club input[type="checkbox"]').prop('checked')) {
                        if ($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar') != 0) {
                            let posicion = window.eliminarObjetivos.indexOf($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar'));
                            if (posicion != -1) { window.eliminarObjetivos.splice(posicion, 1); }
                        }
                    } else {
                        if ($('#ul_mediotrans_ida_club input[type="checkbox"]').attr('data-eliminar') != 0) { window.eliminarObjetivos.push($('#ul_mediotrans_ida_club input[type="checkbox"]').attr('data-eliminar')); }
                    }
                    
                    $('#ul_mediotrans_ida_club input[type="checkbox"]').closest('ul').siblings().find('.titulo_multi').html(descripcion);                    

                }

            } else { // <------ INCLUIR

                $('#ul_mediotrans_ida_club').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_medio_transporte_ida input_multiple input_checkbox_todos" value="001" data-eliminar="0"></label></li>');
                for(var i=0; i < respuesta.length; i++) {   

                    $('#ul_mediotrans_ida_club').append('<li><label class="option li-registro-regular"><span class="label_s">'+respuesta[i]['descripcion_medio_transporte']+'</span> <input type="checkbox" name="array_medio_transporte_ida[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['idmedio_transporte']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
                }               

                // $('#ul_mediotrans_ida_club').append('<li><label class="option"><span class="label_s">0tro</span> <input type="checkbox" name="array_medio_transporte_ida[]" class="array_idtipo_ayuda_filtro input_multiple" value="000" data-eliminar="0" onclick="buscador();" ></label></li>');

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
// --------------------- Fin de la función 'buscar_medio_transporte()' --------------------- //

// --------------------- Inicio de la función 'buscar_drogas()' --------------------- //
function buscar_drogas( linea ) {
    
    $.ajax({
        url: "post/jugadores_ver_datos.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'get_droga',    
        },success: function(respuesta){

            // Vaciando el ul(s):
            $('#ul_drogas_consumidas_jugador').html('');
            $('#ul_drogas_probadas_jugador').html('');
            $('#ul_drogas_consumidas_familiar').html('');


            // --------------------------------- ul - DROGAS CONSUMIDAS (JUGADOR) --------------------------------- //

            if( linea !== -1 ){ // <------ EDITAR

                if( datos_visita_social[linea]['array_visitasocial_droga_consumidajug'] != null ) { // Si el usuario al menos seleccionó un opción...

                    let array_iddroga = [];
                    for (var i = 0; i < datos_visita_social[linea]['array_visitasocial_droga_consumidajug'].length; i++) {
                        let iddroga = datos_visita_social[linea]['array_visitasocial_droga_consumidajug'][i]['iddroga'];
                        array_iddroga[i] = iddroga;
                    }  

                    $('#ul_drogas_consumidas_jugador').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_drogas_consumidas_jugador input_multiple input_checkbox_todos" value="001" data-eliminar="0"></label></li>');
                    for(var i=0; i < respuesta.length; i++) {   

                        // console.log( array_iddroga );

                        let n = array_iddroga.includes( respuesta[i]['iddroga'] );

                        let attr_check = '';
                        if( n ) {
                            // alert( 'Si' );
                            attr_check = 'checked';
                        } else {
                            // alert( 'No' );
                        }

                        $('#ul_drogas_consumidas_jugador').append('<li><label class="option li-registro-regular"><span class="label_s">'+respuesta[i]['descripcion_droga']+'</span> <input '+attr_check+' type="checkbox" name="array_drogas_consumidas_jugador[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['iddroga']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
                    }               

                    $('#ul_drogas_consumidas_jugador').append('<li style="display: none;" class="li_input_text_otro"><label class="option"><input type="text" id="input_text_drogas_consumidas_jugador" class="array_drogas_consumidas_jugador input-ayuda-social" style="width: 120px; border: 1px solid #d8d5d5; background-color: white; border-radius: 5px; margin: 5px 0px;" onkeyup="chequear_datos();" onkeydown="chequear_datos();"><a class="icono-agregar-otro" onclick="boton_guardar_registro_otro(5);"><i class="icon-plus"></i></a></label></li>');

                    $('#ul_drogas_consumidas_jugador').append('<li class="li_otro"><label class="option"><span class="label_s">Otro</span> <input type="checkbox" name="array_drogas_consumidas_jugador[]" class="array_drogas_consumidas_jugador input_multiple input_otro_checkbox" value="000" data-eliminar="0" onchange="chequear_datos();""></label></li>');

                     // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
                    let numero_select = 0;
                    let nombre_option = '';

                    $('#ul_drogas_consumidas_jugador input[type="checkbox"]').each(function () {

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
                    if ($('#ul_drogas_consumidas_jugador input[type="checkbox"]').prop('checked')) {
                        if ($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar') != 0) {
                            let posicion = window.eliminarObjetivos.indexOf($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar'));
                            if (posicion != -1) { window.eliminarObjetivos.splice(posicion, 1); }
                        }
                    } else {
                        if ($('#ul_drogas_consumidas_jugador input[type="checkbox"]').attr('data-eliminar') != 0) { window.eliminarObjetivos.push($('#ul_drogas_consumidas_jugador input[type="checkbox"]').attr('data-eliminar')); }
                    }
                    
                    $('#ul_drogas_consumidas_jugador input[type="checkbox"]').closest('ul').siblings().find('.titulo_multi').html(descripcion);                    

                }

            } else { // <------ INCLUIR

                $('#ul_drogas_consumidas_jugador').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_drogas_consumidas_jugador input_multiple input_checkbox_todos" value="001" data-eliminar="0"></label></li>');
                for(var i=0; i < respuesta.length; i++) {   

                    $('#ul_drogas_consumidas_jugador').append('<li><label class="option li-registro-regular"><span class="label_s">'+respuesta[i]['descripcion_droga']+'</span> <input type="checkbox" name="array_drogas_consumidas_jugador[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['iddroga']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
                }               

                $('#ul_drogas_consumidas_jugador').append('<li style="display: none;" class="li_input_text_otro"><label class="option"><input type="text" id="input_text_drogas_consumidas_jugador" class="array_drogas_consumidas_jugador input-ayuda-social" style="width: 120px; border: 1px solid #d8d5d5; background-color: white; border-radius: 5px; margin: 5px 0px;" onkeyup="chequear_datos();" onkeydown="chequear_datos();"><a class="icono-agregar-otro" onclick="boton_guardar_registro_otro(5);"><i class="icon-plus"></i></a></label></li>');

                $('#ul_drogas_consumidas_jugador').append('<li class="li_otro"><label class="option"><span class="label_s">Otro</span> <input type="checkbox" name="array_drogas_consumidas_jugador[]" class="array_drogas_consumidas_jugador input_multiple input_otro_checkbox" value="000" data-eliminar="0" onchange="chequear_datos();""></label></li>');
                
            }

            // --------------------------------- ul - DROGAS PROBADAS (JUGADOR) --------------------------------- //

            if( linea !== -1 ){ // <------ EDITAR

                if( datos_visita_social[linea]['array_visitasocial_droga_probadajug'] != null ) { // Si el usuario al menos seleccionó un opción...

                    let array_iddroga = [];
                    for (var i = 0; i < datos_visita_social[linea]['array_visitasocial_droga_probadajug'].length; i++) {
                        let iddroga = datos_visita_social[linea]['array_visitasocial_droga_probadajug'][i]['iddroga'];
                        array_iddroga[i] = iddroga;
                    }  

                    $('#ul_drogas_probadas_jugador').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_drogas_probadas_jugador input_multiple input_checkbox_todos" value="001" data-eliminar="0"></label></li>');
                    for(var i=0; i < respuesta.length; i++) {   

                        // console.log( array_iddroga );

                        let n = array_iddroga.includes( respuesta[i]['iddroga'] );

                        let attr_check = '';
                        if( n ) {
                            // alert( 'Si' );
                            attr_check = 'checked';
                        } else {
                            // alert( 'No' );
                        }

                        $('#ul_drogas_probadas_jugador').append('<li><label class="option li-registro-regular"><span class="label_s">'+respuesta[i]['descripcion_droga']+'</span> <input '+attr_check+' type="checkbox" name="array_drogas_probadas_jugador[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['iddroga']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
                    }               

                    $('#ul_drogas_probadas_jugador').append('<li style="display: none;" class="li_input_text_otro"><label class="option"><input type="text" id="input_text_drogas_probadas_jugador" class="array_drogas_consumidas_jugador input-ayuda-social" style="width: 120px; border: 1px solid #d8d5d5; background-color: white; border-radius: 5px; margin: 5px 0px;" onkeyup="chequear_datos();" onkeydown="chequear_datos();"><a class="icono-agregar-otro" onclick="boton_guardar_registro_otro(6);"><i class="icon-plus"></i></a></label></li>');

                    $('#ul_drogas_probadas_jugador').append('<li class="li_otro"><label class="option"><span class="label_s">Otro</span> <input type="checkbox" name="array_drogas_consumidas_jugador[]" class="array_drogas_consumidas_jugador input_multiple input_otro_checkbox" value="000" data-eliminar="0" onchange="chequear_datos();""></label></li>');

                     // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
                    let numero_select = 0;
                    let nombre_option = '';

                    $('#ul_drogas_probadas_jugador input[type="checkbox"]').each(function () {

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
                    if ($('#ul_drogas_probadas_jugador input[type="checkbox"]').prop('checked')) {
                        if ($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar') != 0) {
                            let posicion = window.eliminarObjetivos.indexOf($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar'));
                            if (posicion != -1) { window.eliminarObjetivos.splice(posicion, 1); }
                        }
                    } else {
                        if ($('#ul_drogas_probadas_jugador input[type="checkbox"]').attr('data-eliminar') != 0) { window.eliminarObjetivos.push($('#ul_drogas_probadas_jugador input[type="checkbox"]').attr('data-eliminar')); }
                    }
                    
                    $('#ul_drogas_probadas_jugador input[type="checkbox"]').closest('ul').siblings().find('.titulo_multi').html(descripcion);                    

                }

            } else { // <------ INCLUIR

                $('#ul_drogas_probadas_jugador').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_drogas_probadas_jugador input_multiple input_checkbox_todos" value="001" data-eliminar="0"></label></li>');
                for(var i=0; i < respuesta.length; i++) {   

                    $('#ul_drogas_probadas_jugador').append('<li><label class="option li-registro-regular"><span class="label_s">'+respuesta[i]['descripcion_droga']+'</span> <input type="checkbox" name="array_drogas_probadas_jugador[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['iddroga']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
                }               

                $('#ul_drogas_probadas_jugador').append('<li style="display: none;" class="li_input_text_otro"><label class="option"><input type="text" id="input_text_drogas_probadas_jugador" class="array_drogas_consumidas_jugador input-ayuda-social" style="width: 120px; border: 1px solid #d8d5d5; background-color: white; border-radius: 5px; margin: 5px 0px;" onkeyup="chequear_datos();" onkeydown="chequear_datos();"><a class="icono-agregar-otro" onclick="boton_guardar_registro_otro(6);"><i class="icon-plus"></i></a></label></li>');

                $('#ul_drogas_probadas_jugador').append('<li class="li_otro"><label class="option"><span class="label_s">Otro</span> <input type="checkbox" name="array_drogas_consumidas_jugador[]" class="array_drogas_consumidas_jugador input_multiple input_otro_checkbox" value="000" data-eliminar="0" onchange="chequear_datos();""></label></li>');

            }

            // --------------------------------- ul - DROGAS CONSUMIDAS (FAMILIAR) --------------------------------- //

            if( linea !== -1 ){ // <------ EDITAR

                if( datos_visita_social[linea]['array_visitasocial_droga_consumidafam'] != null ) { // Si el usuario al menos seleccionó un opción...

                    let array_iddroga = [];
                    for (var i = 0; i < datos_visita_social[linea]['array_visitasocial_droga_consumidafam'].length; i++) {
                        let iddroga = datos_visita_social[linea]['array_visitasocial_droga_consumidafam'][i]['iddroga'];
                        array_iddroga[i] = iddroga;
                    }  

                    $('#ul_drogas_consumidas_familiar').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_drogas_consumidas_familiar input_multiple input_checkbox_todos" value="001" data-eliminar="0"></label></li>');
                    for(var i=0; i < respuesta.length; i++) {   

                        // console.log( array_iddroga );

                        let n = array_iddroga.includes( respuesta[i]['iddroga'] );

                        let attr_check = '';
                        if( n ) {
                            // alert( 'Si' );
                            attr_check = 'checked';
                        } else {
                            // alert( 'No' );
                        }

                        $('#ul_drogas_consumidas_familiar').append('<li><label class="option li-registro-regular"><span class="label_s">'+respuesta[i]['descripcion_droga']+'</span> <input '+attr_check+' type="checkbox" name="array_drogas_consumidas_familiar[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['iddroga']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
                    }               

                    $('#ul_drogas_consumidas_familiar').append('<li style="display: none;" class="li_input_text_otro"><label class="option"><input type="text" id="input_text_drogas_consumidas_familiar" class="array_drogas_consumidas_familiar input-ayuda-social" style="width: 120px; border: 1px solid #d8d5d5; background-color: white; border-radius: 5px; margin: 5px 0px;" onkeyup="chequear_datos();" onkeydown="chequear_datos();"><a class="icono-agregar-otro" onclick="boton_guardar_registro_otro(7);"><i class="icon-plus"></i></a></label></li>');

                    $('#ul_drogas_consumidas_familiar').append('<li class="li_otro"><label class="option"><span class="label_s">Otro</span> <input type="checkbox" name="array_drogas_consumidas_familiar[]" class="array_drogas_consumidas_familiar input_multiple input_otro_checkbox" value="000" data-eliminar="0" onchange="chequear_datos();""></label></li>');

                     // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
                    let numero_select = 0;
                    let nombre_option = '';

                    $('#ul_drogas_consumidas_familiar input[type="checkbox"]').each(function () {

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
                    if ($('#ul_drogas_consumidas_familiar input[type="checkbox"]').prop('checked')) {
                        if ($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar') != 0) {
                            let posicion = window.eliminarObjetivos.indexOf($('#modal_detalle_ayudasocial input[idfichaJugador="'+idfichaJugador+'"]').attr('data-eliminar'));
                            if (posicion != -1) { window.eliminarObjetivos.splice(posicion, 1); }
                        }
                    } else {
                        if ($('#ul_drogas_consumidas_familiar input[type="checkbox"]').attr('data-eliminar') != 0) { window.eliminarObjetivos.push($('#ul_drogas_consumidas_familiar input[type="checkbox"]').attr('data-eliminar')); }
                    }
                    
                    $('#ul_drogas_consumidas_familiar input[type="checkbox"]').closest('ul').siblings().find('.titulo_multi').html(descripcion);                    

                }

            } else { // <------ INCLUIR

                $('#ul_drogas_consumidas_familiar').append('<li><label class="option"><span class="label_s">Todos</span> <input type="checkbox" class="array_drogas_consumidas_familiar input_multiple input_checkbox_todos" value="001" data-eliminar="0"></label></li>');
                for(var i=0; i < respuesta.length; i++) {   

                    $('#ul_drogas_consumidas_familiar').append('<li><label class="option li-registro-regular"><span class="label_s">'+respuesta[i]['descripcion_droga']+'</span> <input type="checkbox" name="array_drogas_consumidas_familiar[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+respuesta[i]['iddroga']+'" data-eliminar="0" onclick="buscador();" ></label></li>');
                }               

                $('#ul_drogas_consumidas_familiar').append('<li style="display: none;" class="li_input_text_otro"><label class="option"><input type="text" id="input_text_drogas_consumidas_familiar" class="array_drogas_consumidas_familiar input-ayuda-social" style="width: 120px; border: 1px solid #d8d5d5; background-color: white; border-radius: 5px; margin: 5px 0px;" onkeyup="chequear_datos();" onkeydown="chequear_datos();"><a class="icono-agregar-otro" onclick="boton_guardar_registro_otro(7);"><i class="icon-plus"></i></a></label></li>');

                $('#ul_drogas_consumidas_familiar').append('<li class="li_otro"><label class="option"><span class="label_s">Otro</span> <input type="checkbox" name="array_drogas_consumidas_familiar[]" class="array_drogas_consumidas_familiar input_multiple input_otro_checkbox" value="000" data-eliminar="0" onchange="chequear_datos();""></label></li>');
                
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
// --------------------- Fin de la función 'buscar_drogas()' --------------------- //

    // ---------------------------- Inicio de la función 'hide_show_div' ---------------------------- //
    function hide_show_div( param ) {

        let class_div;

        switch( param ) {

            // ------- //
            case 1:
                class_div = $('.div-antecedentes-familiares');
                break;

            // ------- //
            case 2:
                class_div = $('.div-relaciones-personales');
                break;

            // ------- //
            case 3:
                class_div = $('.div-alimentacion');
                break;

            // ------- //
            case 4:
                class_div = $('.div-locomocion');
                break;

            // ------- //
            case 5:
                class_div = $('.div-salud');
                break;

            // ------- //
            case 6:
                class_div = $('.div-antecedentes-judiciales');
                break;

            // ------- //
            case 7:
                class_div = $('.div-otros-datos');
                break;                                                                                                


        }

        class_div.slideToggle('fast');

    }
    // ---------------------------- Fin de la función 'hide_show_div' ---------------------------- //

// -------------------------- Inicio de la función 'boton_guardar_registro_otro' --------------------------- //
function boton_guardar_registro_otro( registro ) {

    let input_registro_otro;

    switch( registro ) {

        case 1:
            input_registro_otro = $('#input_text_forma_llegada_otro').val();
            break;

        case 2:
            input_registro_otro = $('#input_text_forma_ida_otro').val();
            break;    

        case 5:
            input_registro_otro = $('#input_text_drogas_consumidas_jugador').val();
            break;    

        case 6:
            input_registro_otro = $('#input_text_drogas_probadas_jugador').val();
            break;  

        case 7:
            input_registro_otro = $('#input_text_drogas_consumidas_familiar').val();
            break;                                                

    }

    $('#mensaje_agregar_registro_otro').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');

    if( input_registro_otro != ''  ) {
        $('#modal_agregar_registro_otro').modal('show');
        $('#btn_modal_guardar_tipoayuda_otro').attr('onclick', 'guardar_registro_otro('+registro+');');
        $('.boton_modal').css('display','');    
    }


}
// -------------------------- Fin de la función 'boton_guardar_registro_otro' --------------------------- //


// -------------------------- Inicio de la función 'guardar_registro_otro' --------------------------- //
function guardar_registro_otro( registro ) {

    $('.boton_modal').css('display','none');

    let input_registro_otro;

    switch( registro ) {

        case 1:
            input_registro_otro = $('#input_text_forma_llegada_otro').val();
            break;

        case 2:
            input_registro_otro = $('#input_text_forma_ida_otro').val();
            break;    

        case 5:
            input_registro_otro = $('#input_text_drogas_consumidas_jugador').val();
            break;    

        case 6:
            input_registro_otro = $('#input_text_drogas_probadas_jugador').val();
            break;                                    

        case 7:
            input_registro_otro = $('#input_text_drogas_consumidas_familiar').val();
            break;   

    }

    // alert( input_registro_otro );
    
    $.ajax({
        url: "post/udc_guardar_registro_otro_ficha_social.php",
        type: "post",
        data: {
            'registro': registro,
            'input_registro_otro': input_registro_otro,
            'nombre_usuario_software': '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>'
        },
        dataType: 'json',
        cache: false,
        success: function(respuesta){
            // alert(respuesta);
            if(respuesta==1){
                $('#mensaje_agregar_registro_otro').html('<h4>Registro ingresado correctamente!</h4>');

                // Consultando nuevamente todos los registros según sea el caso:
                get_registros_otro( registro );

                $('#modal_agregar_registro_otro').modal('hide');

            } else { 
                $('#mensaje_agregar_registro_otro').html('<h5>Ha ocurrido un error al ejecutar la consulta: '+respuesta+'.</h5><br>');
            }
            
        },error: function(){// will fire when timeout is reached
           $('#mensaje_agregar_registro_otro').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 

}
// -------------------------- Fin de la función 'guardar_registro_otro' --------------------------- //

// --------------------- Inicio de la función 'get_registros_otro()' --------------------- //
function get_registros_otro( registro ) {
    
    $.ajax({
        url: "post/jugadores_ver_datos.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'registro': registro,
            'tipo_consulta': 'get_ultimo_registro',    
        },success: function(respuesta){

            let ul;
            let id;
            let descripcion;

            switch ( registro ) {

                case 1:
                case 2: 
                    ul = 'ul_llegada_ida_club';
                    id = respuesta[0]['idllegada_ida_club'];
                    descripcion = respuesta[0]['descripcion_llegada_ida_club'];                
                    break;
                // -------------------------- //
                case 5:
                case 6:
                case 7:
                    ul = 'ul_drogas';
                    id = respuesta[0]['iddroga'];
                    descripcion = respuesta[0]['descripcion_droga'];                             
                    break;
                // -------------------------- //            
                    
            }

            let x = $('<li><label class="option li-registro-regular"><span class="label_s">'+descripcion+'</span> <input type="checkbox" name="array_drogas_probadas_jugador[]" class="array_idtipo_ayuda_filtro input_multiple" value="'+id+'" data-eliminar="0" onclick="buscador();" ></label></li>');

            x.insertAfter( $('.'+ul+'').find('.li-registro-regular:last') );
            $('.'+ul+'').find('.li_input_text_otro').hide(); // <--- Ocultando li
            $('.'+ul+'').find('.li_input_text_otro input').val(''); // <--- Vaciando input text del  li
            $('.'+ul+'').find('.li_otro input').prop('checked', false); // <--- Quitanto la propiedad checked del input otro.

            // Mostrando texto de opciones seleccionadas por cada fila:
            $('.'+ul+' .array_idtipo_ayuda_filtro').each(function(){
              
                // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
                let numero_select = 0;
                let nombre_option = '';

                if ($(this).prop('checked')) {
                    nombre_option = $(this).closest('label').find(".label_s").html();
                    numero_select++;
                    //alert( nombre_option );
                }
                
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
            
        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#sin_resultados').hide();
            $('#error_conexion').show();
            $('#boton_editar').hide();
            $('.boton_refresh').show();
        }, timeout: 15000 // sets timeout to 3 seconds
    });     
}
// --------------------- Fin de la función 'get_registros_otro()' --------------------- //

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

function boton_mostrar_modal_descarga() {

    $('#view_ejercicio').modal('show');
    /*
    $('#mensaje_eliminar_proveedor').html('<h5>¿Estás seguro que quieres eliminar este informe?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
    */
}

    // -------------------- Inicio de la función 'buscar_visitas_jugador_social()' -------------------- // 
    function buscar_visitas_jugador_social(){
        $('#error_conexion_perfil_jugador').hide();
        $('#sin_resultados_perfil_jugador').hide();
        $('#cargando_buscar_perfil_jugador').show();
        $("#tabla_ver_perfil_jugador tbody").empty(); // <--- Vaciando tabla.
        var idfichaJugador = $(".idfichaJugador").val();

        $.ajax({
            url: "post/jugadores_ver_datos.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
                'tipo_consulta': 2,
                'idfichaJugador': idfichaJugador
            },
            success: function(respuesta){
                // alert(JSON.stringify(respuesta));
                if(respuesta== ""){ //jugador sin informes
                    $("#tabla_ver_perfil_jugador tbody").empty();
                    var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555;" id="informe_"><td colspan="12"><center><b>Aún no tiene visitas</b></center></td></tr>';
                    $("#tabla_ver_perfil_jugador tbody").append(markup);
                    $("#graficos_informes_resumen").hide();
                    $('#cargando_buscar_perfil_jugador').hide();
                    $('#sin_resultados_perfil_jugador').show();
                    $('#boton_editar').hide();
                    $('.boton_refresh').hide();
                    $('#boton_agregar_informe_carga').prop("disabled", true);
                }else{              
                    $('#boton_agregar_informe_carga').prop("disabled", false); // <--- Habilitando el botón de guardar.
                    window.datos_visita_social = respuesta; //se copian todos los profesores al cache
                    $("#tabla_ver_perfil_jugador tbody").empty();
                    var count = 1;

                    for(var i=0; i < respuesta.length; i++){              

                        // Núcleo Familiar:
                        let af_valoracion_class = '';
                        let af_valoracion_descripcion = '';
                        switch( respuesta[i]['af_valoracion'] ) {
                            case "0":
                                af_valoracion_class = 'valoracion-alta';
                                af_valoracion_descripcion = 'Alto';                                
                                break;

                            case "1":
                                af_valoracion_class = 'valoracion-media';
                                af_valoracion_descripcion = 'Medio';                                    
                                break;

                            case "2":
                                af_valoracion_class = 'valoracion-baja';
                                af_valoracion_descripcion = 'Bajo';                                 
                                break;                                                                
                        }

                        // Relaciones_personales:
                        let rp_valoracion = ""
                        switch( respuesta[i]['rp_valoracion'] ) {
                            case "0":
                                rp_valoracion_class = 'valoracion-alta';
                                rp_valoracion_descripcion = 'Alto';                                
                                break;

                            case "1":
                                rp_valoracion_class = 'valoracion-media';
                                rp_valoracion_descripcion = 'Medio';                                    
                                break;

                            case "2":
                                rp_valoracion_class = 'valoracion-baja';
                                rp_valoracion_descripcion = 'Bajo';                                 
                                break;                                                                   
                        }

                        // Alimentación:
                        let a_valoracion = ""
                        switch( respuesta[i]['a_valoracion'] ) {
                            case "0":
                                a_valoracion_class = 'valoracion-alta';
                                a_valoracion_descripcion = 'Alto';                                
                                break;

                            case "1":
                                a_valoracion_class = 'valoracion-media';
                                a_valoracion_descripcion = 'Medio';                                    
                                break;

                            case "2":
                                a_valoracion_class = 'valoracion-baja';
                                a_valoracion_descripcion = 'Bajo';                                 
                                break;                                                             
                        } 

                        // Salud:
                        let s_valoracion = ""
                        switch( respuesta[i]['s_valoracion'] ) {
                            case "0":
                                s_valoracion_class = 'valoracion-alta';
                                s_valoracion_descripcion = 'Alto';                                
                                break;

                            case "1":
                                s_valoracion_class = 'valoracion-media';
                                s_valoracion_descripcion = 'Medio';                                    
                                break;

                            case "2":
                                s_valoracion_class = 'valoracion-baja';
                                s_valoracion_descripcion = 'Bajo';                                 
                                break;                             
                        }

                        // Locomoción:
                        let l_valoracion = ""
                        switch( respuesta[i]['l_valoracion'] ) {
                            case "0":
                                l_valoracion_class = 'valoracion-alta';
                                l_valoracion_descripcion = 'Alto';                                
                                break;

                            case "1":
                                l_valoracion_class = 'valoracion-media';
                                l_valoracion_descripcion = 'Medio';                                    
                                break;

                            case "2":
                                l_valoracion_class = 'valoracion-baja';
                                l_valoracion_descripcion = 'Bajo';                                 
                                break;                                                                
                        }

                        // Antecedentes Judiciales:
                        let aj_valoracion = ""
                        switch( respuesta[i]['aj_valoracion'] ) {
                            case "0":
                                aj_valoracion_class = 'valoracion-alta';
                                aj_valoracion_descripcion = 'Alto';                                
                                break;

                            case "1":
                                aj_valoracion_class = 'valoracion-media';
                                aj_valoracion_descripcion = 'Medio';                                    
                                break;

                            case "2":
                                aj_valoracion_class = 'valoracion-baja';
                                aj_valoracion_descripcion = 'Bajo';                                 
                                break;                                                               
                        }                       

                        let style_valoracion = "style='width: 70px; margin: auto; /*position: relative; top: -3px;*/ font-weight: bold; border-radius: 5px; text-transform: uppercase; padding: 2px; text-align: center;'";                        

                        let fecha_udc_visita_social = respuesta[i]['fecha_software'];
                        
                        // Día:
                        let dia_visita_social = fecha_udc_visita_social.substring(8, 10); 

                        // Mes:
                        let mes_visita_social = fecha_udc_visita_social.substring(5, 7);     

                        // Año:
                        let anio_visita_social = fecha_udc_visita_social.substring(0, 4); 

                        fecha_udc_visita_social = dia_visita_social + "-" + mes_visita_social + "-" + anio_visita_social;

                        var markup = 
                        '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555;">\
                            <td onclick="boton_ver_detalle_informe('+i+')" style="text-align: center;"><b>'+count+'</b>\
                                <input type="hidden" value="'+ respuesta[i]['idfichaJugador'] +'" name="id_ficha_jugador[]" />\
                            </td>\
                            <td onclick="boton_ver_detalle_informe('+i+')" style="text-align: left;"><b>'+fecha_udc_visita_social+'</b></td>\
                            <td onClick="boton_ver_detalle_informe('+i+');" class="td-valoracion"><p '+style_valoracion+' class="'+af_valoracion_class+'">'+af_valoracion_descripcion+'</p></td>\
                            <td onClick="boton_ver_detalle_informe('+i+');" class="td-valoracion"><p '+style_valoracion+' class="'+rp_valoracion_class+'">'+rp_valoracion_descripcion+'</p></td>\
                            <td onClick="boton_ver_detalle_informe('+i+');" class="td-valoracion"><p '+style_valoracion+' class="'+a_valoracion_class+'">'+a_valoracion_descripcion+'</p></td>\
                            <td onClick="boton_ver_detalle_informe('+i+');" class="td-valoracion"><p '+style_valoracion+' class="'+s_valoracion_class+'">'+s_valoracion_descripcion+'</p></td>\
                            <td onClick="boton_ver_detalle_informe('+i+');" class="td-valoracion"><p '+style_valoracion+' class="'+l_valoracion_class+'">'+l_valoracion_descripcion+'</p></td>\
                            <td onClick="boton_ver_detalle_informe('+i+');" class="td-valoracion"><p '+style_valoracion+' class="'+aj_valoracion_class+'">'+aj_valoracion_descripcion+'</p></td>\
                            <td style="padding: 7px;">\
                                <a class="boton_add" onClick="descargarPDF('+i+');">\
                                    <i class="icon-download-alt"></i>\
                                </a>\
                            </td>\
                            <td style="padding: 7px;">\
                                <a class="boton_editar" onclick="boton_editar('+i+', 2)">\
                                    <i class="icon-pencil"></i>\
                                </a>\
                            </td>\
                            <td style="padding: 7px;">\
                                <a class="boton_eliminar" onClick="boton_eliminar('+i+');">\
                                    <i class="icon-remove"></i>\
                                </a>\
                            </td>\
                        </tr>';
                        $("#tabla_ver_perfil_jugador tbody").append(markup);
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
    // -------------------- Fin de la función 'buscar_visitas_jugador_social()' -------------------- //

function closeModal_pdf(){
    $("#descargarPDF").modal('hide');
}

// --------------------------------------- Inicio de la función descargarPDF() --------------------------------------- //
function descargarPDF( linea ){

    window.idudc_visita_social = datos_visita_social[linea]['idudc_visita_social'];

    $("#descargarPDF").modal('show');
    $('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');

    $.ajax({
        url: "post/reportes/generarPDF_udc_visita_social.php",
        type: "post",
        data: {
            'idudc_visita_social': window.idudc_visita_social
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

// -------------------------- Inicio de la función 'boton_ver_perfil_jugador()' - AGREGAR (INSERT) --------------------------- //
function boton_ver_perfil_jugador( linea ){
    window.idudc_gestion_talento ='';

    // alert( idfichaJugador + ' - ' + nombre_completo_jugador + ' - ' + edad + ' - ' + numero_posicion );
    $(".idfichaJugador").val( datos_visita_social[linea]['idfichaJugador'] );
    $(".nombre-jugador").html( datos_visita_social[linea]['nombre'] + " " + datos_visita_social[linea]['apellido1'] + " " + datos_visita_social[linea]['apellido2'] );    

    // Posición:
    let posicion;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_visita_social[linea]['posicion0'] === null || datos_visita_social[linea]['posicion0'] == '0' || datos_visita_social[linea]['posicion0'] == '' || datos_visita_social[linea]['posicion0'] == '999' ) {
        posicion = 'Posición no especificada';
    } else {
        posicion = parseInt( datos_visita_social[linea]['posicion0'] );
        posicion = array_posiciones[posicion][1];
    }

    // Pie Hábil:
    let dinamico;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_visita_social[linea]['dinamico'] === null || datos_visita_social[linea]['dinamico'] == '0' || datos_visita_social[linea]['dinamico'] == '' ) {
        dinamico = 'Pie hábil no especificado';
    } else {
        dinamico = parseInt( datos_visita_social[linea]['dinamico'] );
        if( dinamico === 3 ) { // <---- Ambidiestro.
            dinamico = 'Ambidiestro';
        } else {
            dinamico = 'Pie ' + array_lateralidad[dinamico][1];
        }
        
    }   

    // Edad:
    let edad;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_visita_social[linea]['fechaNacimiento'] === null || datos_visita_social[linea]['fechaNacimiento'] == '0000-00-00' || datos_visita_social[linea]['fechaNacimiento'] == '' ) {
        edad = '0 años (no especificado), ';
    } else {
        edad = calcularEdad( datos_visita_social[linea]['fechaNacimiento'] ) + ' Años, ';
    }

    let datos_jugador = edad + posicion + ", " + dinamico;

    $(".datos-jugador").html( datos_jugador );

    $(".imagen-jugador").attr("src", "foto_jugadores/" + datos_visita_social[linea]['idfichaJugador'] + '.png');
    

    $('#cuadro_serie_selected').hide(500);
    $('#cuadro_perfil_jugador_selected').show(500);
        
    buscar_visitas_jugador_social();

}

// -------------------------- Inicio de la función 'boton_agregar_informe_carga()' - AGREGAR (INSERT) --------------------------- //
function boton_agregar_informe_carga(){
    window.idudc_visita_social='';
    $("#tabla_ver_informes tbody").empty();

    // ------------------------------------------------------------------------------------ //

    mostrar_divs_flecha(); // <-------- Función que muestra los divs que pueden ocultarse y mostrarse pulsando el icono de la flecha
    ocultar_div_tablas_defult(); // <-------- Ocultando divs y tablas por defecto

    var idfichaJugador = $(".idfichaJugador").val();        
    // alert( idfichaJugador );
    $("#idfichaJugador").val( idfichaJugador );
    

    $('#cuadro_perfil_jugador_selected').hide(500);
    $('#cuadro_formulario_guardar').show(500);
    $("#boton_agregar_informe_carga").prop("disabled", true); 
    $("#formulario")[0].reset();  

    $("#formulario select").each(function(){
        $(this).prop('selectedIndex', 0);
    });

    ocultar_div_tablas_defult(); // <-------- Ocultando divs y tablas por defecto
    mostrar_divs_flecha(); // <-------- Función que muestra los divs que pueden ocultarse y mostrarse pulsando el icono de la flecha

    buscar_formas_llegada_club( -1 ); // <---- Consultando formas de llega/ida al/del club para los ul
    buscar_medio_transporte( -1 ); // <---- Consultando los medios de transporte para los ul
    buscar_drogas( -1 ); // <---- Consultando las drogas para los ul

    chequear_datos(); // <------------- Validando.

    $("#formulario input").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    });

    $("#formulario textarea").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    });

    $("#formulario select").each(function(){
        let thisElement = $(this);
        thisElement.prop('selectedIndex', 0);
    });    

    // Agregando valor por defecto el valor 'NO' a los radio booleanos y el valor 'BAJO' a los demás radio buttons:
    $("#formulario input[type='radio']").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == "0" ) {
            thisElement.prop("checked", true);
        }
        if( thisValue == "1" ) {
            thisElement.prop("checked", true);
        }        
    });    

}
// -------------------------- Fin de la función 'boton_agregar_informe_carga()' - AGREGAR (INSERT) --------------------------- //

// -------------------------- Inicio de la función 'boton_editar( idudc_visita_social )' - EDITAR (UPDATE) --------------------------- //
function boton_editar( linea, vista ){
    
    window.idudc_visita_social = datos_visita_social[linea]['idudc_visita_social'];
    // alert( window.idudc_visita_social );

    buscar_formas_llegada_club( linea ); // <---- Consultando formas de llega/ida al/del club para los ul
    buscar_medio_transporte( linea ); // <---- Consultando los medios de transporte para los ul
    buscar_drogas( linea ); // <---- Consultando las drogas para los ul

    $("#formulario select").each(function(){
        $(this).prop('selectedIndex', 0);
    });

    chequear_datos(); // <------------- Validando.

    // -------------------------------------------------------- //
    // alert( idfichaJugador + ' - ' + nombre_completo_jugador + ' - ' + edad + ' - ' + numero_posicion );
    $(".idfichaJugador").val( datos_visita_social[linea]['idfichaJugador'] );
    $(".nombre-jugador").html( datos_visita_social[linea]['nombre'] + " " + datos_visita_social[linea]['apellido1'] + " " + datos_visita_social[linea]['apellido2'] );    

    // Posición:
    let posicion;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_visita_social[linea]['posicion0'] === null || datos_visita_social[linea]['posicion0'] == '0' || datos_visita_social[linea]['posicion0'] == '' ) {
        posicion = 'No especificado';
    } else {
        posicion = parseInt( datos_visita_social[linea]['posicion0'] );
        posicion = array_posiciones[posicion][1];
    }


    // Pie Hábil:
    let dinamico;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_visita_social[linea]['dinamico'] === null || datos_visita_social[linea]['dinamico'] == '0' || datos_visita_social[linea]['dinamico'] == '' ) {
        dinamico = 'No especificado';
    } else {
        dinamico = parseInt( datos_visita_social[linea]['dinamico'] );
        dinamico = array_lateralidad[dinamico][1];
    }

    // ---------------------------- Calculando la edad del jugador ---------------------------- //
    var date = new Date();
    var anioActual = date.getFullYear();

    var date_actual_str = date.toString();
        
    var anio_actual = date_actual_str.substring(11, 15); 
    var mes_actual_str = date_actual_str.substring(4, 7);
    var dia_actual = date_actual_str.substring(8, 10);

    var anio_actual_int = parseInt( anio_actual ); 
    var mes_actual_int = parseInt( mes_actual_str );
    var dia_actual = parseInt( dia_actual );
    
    let fecha_nacimiento = datos_visita_social[linea]['fechaNacimiento'];

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

    let datos_jugador = edad + " años, " + posicion + ", Pie " + dinamico;

    $(".datos-jugador").html( datos_jugador );

    $(".imagen-jugador").attr("src", "foto_jugadores/" + datos_visita_social[linea]['idfichaJugador'] + '.png');
    // -------------------------------------------------------- //

    if( vista === 1 ) {
        $("#cuadro_serie_selected").hide(500);
    } else {
        $('#cuadro_perfil_jugador_selected').hide(500);
    }
    
    $('#cuadro_formulario_guardar').show(500);

    // Mostrando datos en los campos del formulario:

    // ------------------------------------------ ANTECEDENTES GENERALES ------------------------------------------ //

    $("#domicilio_actual").val( datos_visita_social[linea]['domicilio_actual'] );

    $("#comuna option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['comuna_visita_social'] ) {
            thisElement.prop("selected", true);
        }
    });

    $("#comuna_procedencia option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['comuna_procedencia'] ) {
            thisElement.prop("selected", true);
        }
    });  
    
    $("#apod_nombre").val( datos_visita_social[linea]['apod_nombre'] );  


    agregar_parentesco_select( 1 ); // <--- Parentesco
    $("#apod_parentesco option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['apod_parentesco'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    $("#apod_correo").val( datos_visita_social[linea]['apod_correo'] );  

    $("#apod_telefono").val( datos_visita_social[linea]['apod_telefono'] );  

    // ------------------------------------------ ANTECEDENTES FAMILIARES ------------------------------------------ //

    $("#af_num_personas_gf").val( datos_visita_social[linea]['af_num_personas_gf'] );

    $("#af_num_personas_domicilio").val( datos_visita_social[linea]['af_num_personas_domicilio'] );

    $("#af_num_habitaciones_domicilio").val( datos_visita_social[linea]['af_num_habitaciones_domicilio'] );

    $("#af_comparte_habitacion option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['af_comparte_habitacion'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    if( datos_visita_social[linea]['af_comparte_habitacion'] == '1' ) { // Sí
        $('.div-comparte-habitacion').show();
        $("#af_conquien_comparte_habitacion").val( datos_visita_social[linea]['af_conquien_comparte_habitacion'] );
    } else {
        $('.div-comparte-habitacion').hide();
    }          


    if( datos_visita_social[linea]['array_persona_domicilio_jugador'] != null ) {

        $('.div-personas-viven-conjug').show(); // <------------- Mostrando el div (IMPORTANTE).
        $('#tabla_personas_viven_conjug').show(); // <------------- Mostrando tabla (IMPORTANTE).
        $('#tabla_personas_viven_conjug tbody').empty(); // <------------- Vaciando tabla (IMPORTANTE).

        for( var i = 0; i < datos_visita_social[linea]['array_persona_domicilio_jugador'].length; i++ ) {

            let nombre_domicilio_jugador = datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['nombre_domicilio_jugador'];
            
            /*
            let parentesco_domicilio_jugador;
            if( datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['parentesco_domicilio_jugador'] === null || datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['parentesco_domicilio_jugador'] == '' || datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['parentesco_domicilio_jugador'] == '0' ) {

                parentesco_domicilio_jugador = 'No especificado';

            } else {
            
                parentesco_domicilio_jugador = array_parentesco[ datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['parentesco_domicilio_jugador'] ][1];
            
            }
            */
            
            let edad_domicilio_jugador = datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['edad_domicilio_jugador'];
            
            /*
            let nivel_educacional_domicilio_jugador;
            if( datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['nivel_educacional_domicilio_jugador'] === null || datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['nivel_educacional_domicilio_jugador'] == '' || datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['nivel_educacional_domicilio_jugador'] == '0' ) {
            
                nivel_educacional_domicilio_jugador = 'No especificado';
            
            } else {
            
                nivel_educacional_domicilio_jugador = array_nivel_educacional[ datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['nivel_educacional_domicilio_jugador'] ][1];
            }
            */
            

            let ocupacion_domicilio_jugador = datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['ocupacion_domicilio_jugador'];

            let markup = 
            '<tr id="tr_personas_viven_conjug_'+i+'">\
                <td style="display: inline-block;width: 20%;">\
                    <label>Nombre</label>\
                   <input type="text" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="blue-input" id="input_nombre_domicilio_jugador_'+i+'" name="array_nombre_domicilio_jugador[]" style="background-color: white;width: 80%; text-align: left;" value="'+nombre_domicilio_jugador+'">\
                </td>\
                <td style="display: inline-block;width: 20%;">\
                    <label>Parentesco</label>\
                   <select onchange="chequear_datos();" class="blue-input select-parentesco" id="input_parentesco_domicilio_jugador_'+i+'" name="array_parentesco_domicilio_jugador[]" style="background-color: white;width: 80%;"></select>\
                </td>\
                <td style="display: inline-block;width: 15%;">\
                    <label>Edad</label>\
                   <input type="number" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="blue-input" id="input_edad_domicilio_jugador_'+i+'" name="array_edad_domicilio_jugador[]" style="background-color: white;" value="'+edad_domicilio_jugador+'">\
                </td>\
                <td style="display: inline-block;width: 20%;">\
                    <label>Nivel educacional</label>\
                   <select onchange="chequear_datos();" class="blue-input select-nivel-educacional" id="input_nivel_educacional_domicilio_jugador_'+i+'" name="array_nivel_educacional_domicilio_jugador[]" style="background-color: white;width: 80%;"></select>\
                </td>\
                <td style="display: inline-block;width: 20%;">\
                    <label>Ocupación</label>\
                   <input type="text" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="blue-input" id="input_ocupacion_domicilio_jugador_'+i+'" name="array_ocupacion_domicilio_jugador[]" style="background-color: white;width: 80%; text-align: left;" value="'+ocupacion_domicilio_jugador+'" >\
                </td>\
            </tr>\
            ';

            $('#tabla_personas_viven_conjug tbody').append( markup );

        }

        agregar_parentesco_select( 2 );
        agregar_nivel_educacional_select();  

        // Seleccionando las opciones del parentesco guardados en la BD:
        $('select[name="array_parentesco_domicilio_jugador[]"]').each(function(i){
            
            let parentesco_domicilio_jugador = datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['parentesco_domicilio_jugador'];
            let thisSelect = $(this);
            
            thisSelect.find('option').each(function() {
                
                let thisOptionElem = $(this);
                let thisOptionValue = thisOptionElem.val();

                if( thisOptionValue == parentesco_domicilio_jugador ) {
                    thisOptionElem.prop('selected', true);
                }

            });
        });


        // Seleccionando las opciones del nivel educacional guardados en la BD:
        $('select[name="array_nivel_educacional_domicilio_jugador[]"]').each(function(i){
            
            let nivel_educacional_domicilio_jugador = datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['nivel_educacional_domicilio_jugador'];
            let thisSelect = $(this);
            
            thisSelect.find('option').each(function() {
                
                let thisOptionElem = $(this);
                let thisOptionValue = thisOptionElem.val();

                if( thisOptionValue == nivel_educacional_domicilio_jugador ) {
                    thisOptionElem.prop('selected', true);
                }

            });
        });


    } else {
        $('.div-personas-viven-conjug').hide(); // <------------- Ocultando el div (IMPORTANTE).
        $('#tabla_personas_viven_conjug').hide(); // <------------- Ocultando tabla (IMPORTANTE).
        $('#tabla_personas_viven_conjug tbody').empty(); // <------------- Vaciando tabla (IMPORTANTE).        
    }
  
    
    $("#af_ingreso_nucleo_familiar").val( datos_visita_social[linea]['af_ingreso_nucleo_familiar'] );
    
    $("#af_indep_economica option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['af_indep_economica'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    $("#af_situacion_conyugal_padres option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['af_situacion_conyugal_padres'] ) {
            thisElement.prop("selected", true);
        }
    });     

    $("#af_num_hermanos").val( datos_visita_social[linea]['af_num_hermanos'] );

    $("#af_principal_sostenedor option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['af_principal_sostenedor'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    $("#af_tipo_domicilio_jugador option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['af_tipo_domicilio_jugador'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    $("#af_info_grupo_familiar").val( datos_visita_social[linea]['af_info_grupo_familiar'] );

    switch( datos_visita_social[linea]['af_valoracion'] ) {
        case "0":
            $("#af_valoracion_0").prop('checked', true);
            break;
        case "1":
            $("#af_valoracion_1").prop('checked', true);
            break;
        case "2":
            $("#af_valoracion_2").prop('checked', true);
            break;                                                        
    }   

    $("#af_valoracion_text").val( datos_visita_social[linea]['af_valoracion_text'] );            

    // ------------------------------------------ RELACIONES PERSONALES ------------------------------------------ //

    $("#rp_situacion_amorosa option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['rp_situacion_amorosa'] ) {
            thisElement.prop("selected", true);
        }
    });     

    if( datos_visita_social[linea]['rp_situacion_amorosa'] == '1' ) { // <--- En pareja
        $('.div-en-pareja-si').show();
        agregar_relacion_pareja_select(); // <--- Agregando datos del array al select.

        $("#rp_hace_cuanto").val( datos_visita_social[linea]['rp_hace_cuanto'] );

        $("#rp_relacion_pareja option").each(function(){
            let thisElement = $(this);
            let thisValue = $(this).val();
            if( thisValue == datos_visita_social[linea]['rp_relacion_pareja'] ) {
                thisElement.prop("selected", true);
            }
        });    

    } else {
        $('.div-en-pareja-si').hide();
    }

    $("#rp_inicio_vida_sexual option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['rp_inicio_vida_sexual'] ) {
            thisElement.prop("selected", true);
        }
    });

    $("#rp_metodo_proteccion").val( datos_visita_social[linea]['rp_metodo_proteccion'] );     

    $("#rp_orientacion_temas_sexuales option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['rp_orientacion_temas_sexuales'] ) {
            thisElement.prop("selected", true);
        }
    });  

    $("#rp_tiene_hijos option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['rp_tiene_hijos'] ) {
            thisElement.prop("selected", true);
        }
    });  

    $("#rp_num_hijos").val( datos_visita_social[linea]['rp_num_hijos'] );      

    if( datos_visita_social[linea]['rp_tiene_hijos'] == '1' ) { // <--- Sí tiene hijos

        $('.div-hijos-si').show(); // <------------- Mostrando el div (IMPORTANTE).

        if( datos_visita_social[linea]['array_hijo_jugador'] != null ) { // <--- Sí ha agregado datos de al menos un hijo
            
            $('.div-datos-hijos-si').show(); // <------------- Mostrando el div (IMPORTANTE).
            $('#tabla_datos_hijos').html(''); // <------------- Vaciando tabla (IMPORTANTE).
            $('#tabla_datos_hijos').show(); // <------------- Mostrando tabla (IMPORTANTE).

            for( let i=0; i<datos_visita_social[linea]['array_hijo_jugador'].length; i++ ) {
                
                let edadhijo_jugador = datos_visita_social[linea]['array_hijo_jugador'][i]['edadhijo_jugador'];
                let vivecon_hijo_jugador = datos_visita_social[linea]['array_hijo_jugador'][i]['vivecon_hijo_jugador'];
                let tiempocon_hijo_jugador = datos_visita_social[linea]['array_hijo_jugador'][i]['tiempocon_hijo_jugador'];


                let markup = 
                '<div id="tr_datos_hijos_'+i+'" class="row-fluid tr_datos_hijos_class" style="margin-bottom: 20px;">\
                    <div class="span6" style="display: flex;">\
                        <div class="span12">\
                            <div class="span5" style="display: flex;">\
                                <a class="btn btn-md btn-primary gray-a"><div><p class="ellipsis-text" style="font-weight: normal;">Edad Hijo</p></div></a><input style="height: 20px;" type="number" onkeyup="chequear_datos();" onmouseup="chequear_datos();" class="gray-input" id="input_edadhijo_jugador_'+i+'" name="array_edadhijo_jugador[]" value="'+edadhijo_jugador+'"/>\
                            </div>\
                            <div class="span7" style="display: flex;">\
                                <a class="btn btn-md btn-primary gray-a" style="width: 50%; padding: 4px 5px;"><div><p class="ellipsis-text" style="font-weight: normal;">Con quien vive hijo</p></div></a><input style="height: 20px;" type="text" onkeyup="chequear_datos();" onkeyup="chequear_datos();" onkeydown="chequear_datos();" class="gray-input" id="input_vivecon_hijo_jugador_'+i+'" name="array_vivecon_hijo_jugador[]" value="'+vivecon_hijo_jugador+'"/>\
                            </div>\
                        </div>\
                    </div>\
                    <div class="span6" style="display: flex;">\
                        <div class="span12">\
                            <a class="btn btn-md btn-primary gray-a" style="width: 25%; padding: 3px 5px;"><div><p class="ellipsis-text" style="font-weight: normal;">Cada cuanto lo ve</p></div></a><input style="height: 18px;" type="text" onkeyup="chequear_datos();" onkeyup="chequear_datos();" onkeydown="chequear_datos();" class="gray-input" id="input_tiempocon_hijo_jugador_'+i+'" name="array_tiempocon_hijo_jugador[]" value="'+tiempocon_hijo_jugador+'"/>\
                        </div>\
                    </div>\
                </div>';

                $('#tabla_datos_hijos').append( markup );

            }

        } else {
            $('.div-datos-hijos-si').hide(); // <------------- Ocultando el div (IMPORTANTE).
            $('#tabla_datos_hijos').html(''); // <------------- Vaciando tabla (IMPORTANTE). 
            $('#tabla_datos_hijos').hide(); // <------------- Ocultando tabla (IMPORTANTE).
        }  

    } else {
        $('.div-hijos-si').hide(); // <------------- Ocultando el div (IMPORTANTE).
    }

    switch( datos_visita_social[linea]['rp_valoracion'] ) {
        case "0":
            $("#rp_valoracion_0").prop('checked', true);
            break;
        case "1":
            $("#rp_valoracion_1").prop('checked', true);
            break;
        case "2":
            $("#rp_valoracion_2").prop('checked', true);
            break;                                                        
    }   

    $("#rp_valoracion_text").val( datos_visita_social[linea]['rp_valoracion_text'] );    

    // ------------------------------------------ ALIMENTACIÓN ------------------------------------------ //

    $("#a_costear_alimentacion option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['a_costear_alimentacion'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    $("#a_observaciones").val( datos_visita_social[linea]['a_observaciones'] ); 

    $("#a_comidas_club option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['a_comidas_club'] ) {
            thisElement.prop("selected", true);
        }
    });

    $("#a_comidas_diarias option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['a_comidas_diarias'] ) {
            thisElement.prop("selected", true);
        }
    });     

    switch( datos_visita_social[linea]['a_valoracion'] ) {
        case "0":
            $("#a_valoracion_0").prop('checked', true);
            break;
        case "1":
            $("#a_valoracion_1").prop('checked', true);
            break;
        case "2":
            $("#a_valoracion_2").prop('checked', true);
            break;                                                        
    }   

    $("#a_valoracion_text").val( datos_visita_social[linea]['a_valoracion_text'] );     

    // ------------------------------------------ LOCOMOCIÓN ------------------------------------------ //

    switch( datos_visita_social[linea]['l_valoracion'] ) {
        case "0":
            $("#l_valoracion_0").prop('checked', true);
            break;
        case "1":
            $("#l_valoracion_1").prop('checked', true);
            break;
        case "2":
            $("#l_valoracion_2").prop('checked', true);
            break;                                                        
    }   

    $("#l_valoracion_text").val( datos_visita_social[linea]['l_valoracion_text'] );     

    // ------------------------------------------ SALUD ------------------------------------------ //

    $("#s_consume_drogas option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['s_consume_drogas'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    if( datos_visita_social[linea]['s_consume_drogas'] == '1' ) { // Sí
        $('.div-consume-drogas-si').show();
        $("#s_frecuencia_consumo_drogas").val( datos_visita_social[linea]['s_frecuencia_consumo_drogas'] );
    } else {
        $('.div-consume-drogas-si').hide();
    }


    $("#s_familiar_consume_drogas option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['s_familiar_consume_drogas'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    if( datos_visita_social[linea]['s_familiar_consume_drogas'] == '1' ) { // Sí
        $('.div-familiar-consume-drogas-si').show();
        $("#s_quien_consume_drogas_familiar").val( datos_visita_social[linea]['s_quien_consume_drogas_familiar'] );
    } else {
        $('.div-familiar-consume-drogas-si').hide();
    }

    switch( datos_visita_social[linea]['s_valoracion'] ) {
        case "0":
            $("#s_valoracion_0").prop('checked', true);
            break;
        case "1":
            $("#s_valoracion_1").prop('checked', true);
            break;
        case "2":
            $("#s_valoracion_2").prop('checked', true);
            break;                                                        
    }   

    $("#s_valoracion_text").val( datos_visita_social[linea]['s_valoracion_text'] ); 

    // ------------------------------------------ ANTECEDENES JUDICIALES ------------------------------------------ //

    $("#aj_jugador_tiene_antecedentes option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['aj_jugador_tiene_antecedentes'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    if( datos_visita_social[linea]['aj_jugador_tiene_antecedentes'] == '1' ) { // Sí
        $('.div-jugador-tiene-antecedentes-si').show();
        $("#aj_jugador_antecedentes").val( datos_visita_social[linea]['aj_jugador_antecedentes'] );
    } else {
        $('.div-jugador-tiene-antecedentes-si').hide();
    }

    $("#aj_familiar_tiene_antecedentes option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['aj_familiar_tiene_antecedentes'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    if( datos_visita_social[linea]['aj_familiar_tiene_antecedentes'] == '1' ) { // Sí
        $('.div-familiar-tiene-antecedentes-si').show();
        $("#aj_familiar_antecedentes").val( datos_visita_social[linea]['aj_familiar_antecedentes'] );
    } else {
        $('.div-familiar-tiene-antecedentes-si').hide();
    }    

    switch( datos_visita_social[linea]['aj_valoracion'] ) {
        case "0":
            $("#aj_valoracion_0").prop('checked', true);
            break;
        case "1":
            $("#aj_valoracion_1").prop('checked', true);
            break;
        case "2":
            $("#aj_valoracion_2").prop('checked', true);
            break;                                                        
    }   

    $("#aj_valoracion_text").val( datos_visita_social[linea]['aj_valoracion_text'] );     

    // ------------------------------------------ OTROS DATOS ------------------------------------------ //

    $("#od_tiene_seguro option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['od_tiene_seguro'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    if( datos_visita_social[linea]['od_tiene_seguro'] == '1' ) { // Sí
        $('.div-seguro-si').show();
        $("#od_nombre_compania_seguro").val( datos_visita_social[linea]['od_nombre_compania_seguro'] );
        $("#od_seguro_vencimiento").val( datos_visita_social[linea]['od_seguro_vencimiento'] );
    } else {
        $('.div-seguro-si').hide();
    }  

    $("#od_tiene_pasaporte option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['od_tiene_pasaporte'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    if( datos_visita_social[linea]['od_tiene_pasaporte'] == '1' ) { // Sí
        $('.div-pasaporte-si').show();
        $("#od_num_pasaporte").val( datos_visita_social[linea]['od_num_pasaporte'] );
        $("#od_pasaporte_vencimiento").val( datos_visita_social[linea]['od_pasaporte_vencimiento'] );
    } else {
        $('.div-pasaporte-si').hide();
    }        


    // ------------------------------------------ COMENTARIOS/OBSERVACIONES GENERALES ------------------------------------------ //

    $("#od_observaciones").val( datos_visita_social[linea]['od_observaciones'] );


    // -------------------- PADRE -------------------- //

    $("#od_padre_nombre").val( datos_visita_social[linea]['od_padre_nombre'] );
    $("#od_padre_apellido").val( datos_visita_social[linea]['od_padre_apellido'] );
    $("#od_padre_telefono").val( datos_visita_social[linea]['od_padre_telefono'] );
    $("#od_padre_correo").val( datos_visita_social[linea]['od_padre_correo'] );

    if( datos_visita_social[linea]['od_padre_tiene_discapacidad'] == '1' ) { // Sí
        $('.div-padre-discapacidad').show();
        $("#od_padre_discapacidad").val( datos_visita_social[linea]['od_padre_discapacidad'] );
    } else {
        $('.div-padre-discapacidad').hide();
    }    

    $("#od_padre_comuna_residencia option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['od_padre_comuna_residencia'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    if( datos_visita_social[linea]['od_padre_trabaja'] == '1' ) { // Sí
        $('.div-padre-trabaja-si').show();
        $("#od_padre_trabajo_nombre").val( datos_visita_social[linea]['od_padre_trabajo_nombre'] );
    } else {
        $('.div-padre-trabaja-si').hide();
    }  

    if( datos_visita_social[linea]['od_padre_trabaja'] == '1' ) { // Sí
        $('.div-padre-cesante-jubilado-si').hide();
        $('.div-padre-trabaja-si').show();
        $("#od_padre_trabajo_nombre").val( datos_visita_social[linea]['od_padre_trabajo_nombre'] );
    } else {
        $('.div-padre-trabaja-si').hide();
        $('.div-padre-cesante-jubilado-si').show();
        $("#od_padre_tiempo_cesante_jubilado").val( datos_visita_social[linea]['od_padre_tiempo_cesante_jubilado'] );
    }      

    // -------------------- MADRE -------------------- //  

    $("#od_madre_nombre").val( datos_visita_social[linea]['od_madre_nombre'] );
    $("#od_madre_apellido").val( datos_visita_social[linea]['od_madre_apellido'] );
    $("#od_madre_telefono").val( datos_visita_social[linea]['od_madre_telefono'] );
    $("#od_madre_correo").val( datos_visita_social[linea]['od_madre_correo'] );

    if( datos_visita_social[linea]['od_madre_tiene_discapacidad'] == '1' ) { // Sí
        $('.div-madre-discapacidad').show();
        $("#od_madre_discapacidad").val( datos_visita_social[linea]['od_madre_discapacidad'] );
    } else {
        $('.div-madre-discapacidad').hide();
    }    

    $("#od_madre_comuna_residencia option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == datos_visita_social[linea]['od_madre_comuna_residencia'] ) {
            thisElement.prop("selected", true);
        }
    }); 

    if( datos_visita_social[linea]['od_madre_trabaja'] == '1' ) { // Sí
        $('.div-madre-trabaja-si').show();
        $("#od_madre_trabajo_nombre").val( datos_visita_social[linea]['od_madre_trabajo_nombre'] );
    } else {
        $('.div-madre-trabaja-si').hide();
    }  

    if( datos_visita_social[linea]['od_madre_trabaja'] == '1' ) { // Sí
        $('.div-madre-cesante-jubilado-si').hide();
        $('.div-madre-trabaja-si').show();
        $("#od_madre_trabajo_nombre").val( datos_visita_social[linea]['od_madre_trabajo_nombre'] );
    } else {
        $('.div-madre-trabaja-si').hide();
        $('.div-madre-cesante-jubilado-si').show();
        $("#od_madre_tiempo_cesante_jubilado").val( datos_visita_social[linea]['od_madre_tiempo_cesante_jubilado'] );
    }    

}
// -------------------------- Fin de la función 'boton_editar( idudc_visita_social )' - EDITAR (UPDATE) --------------------------- //

function boton_eliminar( linea ){
    window.idudc_visita_social= datos_visita_social[linea]['idudc_visita_social'];
    // alert( idudc_visita_social );
    $('#myModal2').modal('show');
    $('#mensaje_eliminar_proveedor').html('<h5>¿Estás seguro que quieres eliminar este informe?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
}

function eliminar_informe() {

    //alert( window.idudc_visita_social );

     $('.boton_modal').hide();
     $('#mensaje_eliminar_proveedor').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando informe...</h5><br><img src="../config/remover_archivo.png">');
     $.ajax({
        url: "post/udc_eliminar_ficha_social.php",
        type: "post",
        data: {
            'idudc_visita_social': window.idudc_visita_social
        },success: function(respuesta) {
            if(respuesta==1){//eliminado correctamente
                $('#mensaje_eliminar_proveedor').html('<h5>Informe eliminado correctamente!</h5>');
                buscar_visitas_jugador_social();
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

function boton_guardar(){
    // alert( window.idudc_visita_social );
    if (window.idudc_visita_social != "" ) {
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }
    

    $('#myModalDescargarBoleta').modal('show');
    $('.boton_modal').css('display','');
}


function guardar_registro(){
    $('.boton_modal').css('display','none');

    if(window.idudc_visita_social!=""){
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }

    var data = $('#formulario').serializeArray();
    data.push({name: 'idudc_visita_social',  value: window.idudc_visita_social});
    // data.push({name: 'id_jugador',  value: window.id_jugador});
    data.push({name: 'nombre_usuario_software', value: '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>'});
    
    // alert(JSON.stringify(data));
    $.ajax({
        url: "post/udc_guardar_ficha_social.php",
        type: "post",
        data: data,
        dataType: 'json',
        cache: false,
        success: function(respuesta){
            // alert(respuesta);
            if(respuesta==1){
                $('#mensaje_agregar_DescargarBoleta').html('<h4>Registro ingresado correctamente!</h4>');
                buscar_visitas_jugador_social();
                $("#cuadro_formulario_guardar").hide(500);
                $("#cuadro_perfil_jugador_selected").show(500);
                $('#myModalDescargarBoleta').modal('hide');

            }else if(respuesta==2){
                $('#mensaje_agregar_DescargarBoleta').html('<h4>Registro editado correctamente!</h4>');
                buscar_visitas_jugador_social();
                $("#cuadro_formulario_guardar").hide(500);
                $("#cuadro_perfil_jugador_selected").show(500);
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


/*
cuadro_listado_series
cuadro_serie_selected
cuadro_perfil_jugador_selected
cuadro_formulario_guardar
*/
/*
$(".cuadro_serie").click(function(){

    $("#tabla_ver_informes_todos tbody").empty(); // Vaciando la tabla.

    // alert( sexo  + " - " + serie + " - " + numero_serie );
    $('#cuadro_listado_series').hide(500);
    $('#cuadro_serie_selected').show(500);
    // $('.cuadro_buscar_buscar').show(500);
    // $('.cuadro_buscar_titulo').show(500);
    // $("#tabla_verEjercicios tbody").empty();

    let sexo = $(this).attr("sexo");
    let serie = $(this).attr("serie");
    let numero_serie = $(this).attr("numero-serie");
    let tecnico = $(this).attr("tecnico");
    $(".titulo_serie").html( serie );
    $(".sexo").val( sexo );

    let sexo_seleccion = '';
    if( sexo == '1' ) {
        sexo_seleccion = 'Masculina';
    } else {
        sexo_seleccion = 'Femenina';
    }

    $(".sexo_seleccion").html( sexo_seleccion );
    
    $(".numero_serie").val( numero_serie );
    $(".tecnico").val( tecnico );

    // Llamando la función 'buscador()'
    buscador(); 

});
*/

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
        // $(".titulo_serie").html( nombre_seleccion_titulo );
        $(".sexo").val( sexo );

        let sexo_serie = '';
        if( sexo == '1' ) {
            sexo_serie = 'Masculina';
        } else {
            sexo_serie = 'Femenina';
        }

        let descripcion_serie;
        if( serie == '99' ) {
            descripcion_serie = 'Primer Equipo';
        } else {
            descripcion_serie = 'Sub-' + serie;
        }


        $(".descripcipn_serie").html( descripcion_serie );
        $(".sexo_serie").html( sexo_serie );
    

        $(".numero_serie").val( serie );
        // $(".tecnico").val( tecnico );

        // Llamando la función 'buscador()'
        buscador(); 
        
    }

    // -------------------- Inicio de la función 'buscador()' ------------------------- //
    function buscador() {
        var string = $("#buscar_nombre").val();
        $('#error_conexion').hide();
        $('#sin_resultados').hide();
        $('#cargando_buscar').show();
     

        var sexo = $(".sexo").val();
        var numero_serie = $(".numero_serie").val();

        $.ajax({
            url: "post/jugadores_ver_datos.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
                'string': string,
                'tipo_consulta': 1,
                'sexo': sexo,
                'numero_serie': numero_serie        
        },success: function(respuesta){

            var tecnico = $('.tecnico').val();
            // alert( tecnico );
            // alert(JSON.stringify(respuesta));
            if(respuesta== ""){ //jugador sin informes
                $("#tabla_ver_informes_todos tbody").empty();
                var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td colspan="11"><b>No se encontraron visitas</b></td></tr>';
                $("#tabla_ver_informes_todos tbody").append(markup);
                $("#graficos_informes_resumen").hide();
                $('#cargando_buscar').hide();
                $('#sin_resultados').show();
                $('#boton_editar').hide();
                $('.boton_refresh').hide();
                $('#boton_agregar_informe_carga').prop("disabled", true);
            }else{              
                window.datos_visita_social = respuesta; //se copian todos los profesores al cache
                $("#tabla_ver_informes_todos tbody").empty();
                let tr_line = '\
                <tr style="background-color:#eee; height:1px;">\
                    <td colspan="11"></td>\
                </tr>\
                ';
                $("#tabla_ver_informes_todos tbody").append( tr_line );

                var count = 1;
                for(var i=0; i < respuesta.length; i++){

                    if( respuesta[i]['apellido2'] === null ) {
                        respuesta[i]['apellido2'] = "";
                    }  

                    let idfichaJugador = respuesta[i]['idfichaJugador'];
                    let posicion0 = respuesta[i]['posicion0'];

                    let nombre_posicion;
                    if( posicion0 === null || posicion0 == '' || posicion0 == '0' || posicion0 == '999' ) {
                        nombre_posicion = 'No especificado';
                    } else {
                        nombre_posicion = array_posiciones[posicion0][1];
                    }

                    // Nombre completo del jugador:
                    let nombre_completo_jugador = "'" + respuesta[i]['nombre'] + ' ' + respuesta[i]['apellido1'] + ' ' + respuesta[i]['apellido2'] + "'";
                                    

                    // Nacionalidad:
                    let nacionalidad1 = respuesta[i]['nacionalidad1'];
                    /*
                    let bandera_nacionalidad;
                    if( nacionalidad1 === null || nacionalidad1 == '' || nacionalidad1 == '0' ) {
                        bandera_nacionalidad = 'default.png';
                    } else {
                        bandera_nacionalidad = array_paises[nacionalidad1][2];
                    }
                    */

                    let markup;

                    let num_grupo_posicion = array_posiciones[posicion0][2];
                    let nombre_grupo_posicion = array_posiciones[posicion0][3]; 

                    // alert( respuesta[i]['idudc_visita_social'] );
                    if( typeof respuesta[i]['idudc_visita_social'] === 'undefined' ) {

                        markup = 
                        '<tr class="panel_buscar tr_posicion_jugador_'+posicion0+'" style="height:0px; cursor:pointer; color:#555555;" num-grupo-posicion="'+num_grupo_posicion+'" nombre-grupo-posicion="'+nombre_grupo_posicion+'" onClick="boton_ver_perfil_jugador('+i+');">\
                            <td style="font-weight:bold;"><b>'+count+'</b>\
                            </td>\
                            <td style="text-align: left;">\
                                <b>' + nombre_posicion + '</b>\
                            </td>\
                            <td>\
                                <b>' + 'Sub-' + numero_serie + '</b>\
                            </td>\
                            <td style="text-align: left;">\
                                <img src="foto_jugadores/'+idfichaJugador+'.png" class="imagen-jugador" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;"> \
                                <b>' + respuesta[i]['nombre'] + ' ' + respuesta[i]['apellido1'] + ' ' + respuesta[i]['apellido2'] + '</b>\
                            </td>\
                            <td colspan="7"><center><b>Aún no tiene visitas</b></center></td>\
                        </tr>';

                    } else {

                        // Núcleo Familiar:
                        let af_valoracion_class = '';
                        let af_valoracion_descripcion = '';
                        switch( respuesta[i]['af_valoracion'] ) {
                            case "0":
                                af_valoracion_class = 'valoracion-alta';
                                af_valoracion_descripcion = 'Alto';                                
                                break;

                            case "1":
                                af_valoracion_class = 'valoracion-media';
                                af_valoracion_descripcion = 'Medio';                                    
                                break;

                            case "2":
                                af_valoracion_class = 'valoracion-baja';
                                af_valoracion_descripcion = 'Bajo';                                 
                                break;                                                                
                        }

                        // Relaciones_personales:
                        let rp_valoracion = ""
                        switch( respuesta[i]['rp_valoracion'] ) {
                            case "0":
                                rp_valoracion_class = 'valoracion-alta';
                                rp_valoracion_descripcion = 'Alto';                                
                                break;

                            case "1":
                                rp_valoracion_class = 'valoracion-media';
                                rp_valoracion_descripcion = 'Medio';                                    
                                break;

                            case "2":
                                rp_valoracion_class = 'valoracion-baja';
                                rp_valoracion_descripcion = 'Bajo';                                 
                                break;                                                                   
                        }

                        // Alimentación:
                        let a_valoracion = ""
                        switch( respuesta[i]['a_valoracion'] ) {
                            case "0":
                                a_valoracion_class = 'valoracion-alta';
                                a_valoracion_descripcion = 'Alto';                                
                                break;

                            case "1":
                                a_valoracion_class = 'valoracion-media';
                                a_valoracion_descripcion = 'Medio';                                    
                                break;

                            case "2":
                                a_valoracion_class = 'valoracion-baja';
                                a_valoracion_descripcion = 'Bajo';                                 
                                break;                                                             
                        } 

                        // Salud:
                        let s_valoracion = ""
                        switch( respuesta[i]['s_valoracion'] ) {
                            case "0":
                                s_valoracion_class = 'valoracion-alta';
                                s_valoracion_descripcion = 'Alto';                                
                                break;

                            case "1":
                                s_valoracion_class = 'valoracion-media';
                                s_valoracion_descripcion = 'Medio';                                    
                                break;

                            case "2":
                                s_valoracion_class = 'valoracion-baja';
                                s_valoracion_descripcion = 'Bajo';                                 
                                break;                             
                        }

                        // Locomoción:
                        let l_valoracion = ""
                        switch( respuesta[i]['l_valoracion'] ) {
                            case "0":
                                l_valoracion_class = 'valoracion-alta';
                                l_valoracion_descripcion = 'Alto';                                
                                break;

                            case "1":
                                l_valoracion_class = 'valoracion-media';
                                l_valoracion_descripcion = 'Medio';                                    
                                break;

                            case "2":
                                l_valoracion_class = 'valoracion-baja';
                                l_valoracion_descripcion = 'Bajo';                                 
                                break;                                                                
                        }

                        // Antecedentes Judiciales:
                        let aj_valoracion = ""
                        switch( respuesta[i]['aj_valoracion'] ) {
                            case "0":
                                aj_valoracion_class = 'valoracion-alta';
                                aj_valoracion_descripcion = 'Alto';                                
                                break;

                            case "1":
                                aj_valoracion_class = 'valoracion-media';
                                aj_valoracion_descripcion = 'Medio';                                    
                                break;

                            case "2":
                                aj_valoracion_class = 'valoracion-baja';
                                aj_valoracion_descripcion = 'Bajo';                                 
                                break;                                                               
                        }

                        let style_valoracion = "style='width: 70px; margin: auto; position: relative; top: -3px; font-weight: bold; border-radius: 5px; text-transform: uppercase; padding: 2px; text-align: center;'";

                        markup = 
                        '<tr class="panel_buscar tr_posicion_jugador_'+posicion0+'" style="height:0px; cursor:pointer; color:#555555;" num-grupo-posicion="'+num_grupo_posicion+'" nombre-grupo-posicion="'+nombre_grupo_posicion+'">\
                            <td onClick="boton_ver_perfil_jugador('+i+');" style="font-weight:bold;"><b>'+count+'</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" style="text-align: left;">\
                                <b>' + nombre_posicion + '</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');">\
                                <b>' + 'Sub-' + numero_serie + '</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" style="text-align: left;">\
                                <img src="foto_jugadores/'+idfichaJugador+'.png" class="imagen-jugador" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;"> \
                                <b>' + respuesta[i]['nombre'] + ' ' + respuesta[i]['apellido1'] + ' ' + respuesta[i]['apellido2'] + '</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion"><p '+style_valoracion+' class="'+af_valoracion_class+'">'+af_valoracion_descripcion+'</p></td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion"><p '+style_valoracion+' class="'+rp_valoracion_class+'">'+rp_valoracion_descripcion+'</p></td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion"><p '+style_valoracion+' class="'+a_valoracion_class+'">'+a_valoracion_descripcion+'</p></td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion"><p '+style_valoracion+' class="'+s_valoracion_class+'">'+s_valoracion_descripcion+'</p></td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion"><p '+style_valoracion+' class="'+l_valoracion_class+'">'+l_valoracion_descripcion+'</p></td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion"><p '+style_valoracion+' class="'+aj_valoracion_class+'">'+aj_valoracion_descripcion+'</p></td>\
                            <td style="padding: 7px;">\
                                <a class="boton_editar" onClick="boton_editar('+i+', 1);">\
                                    <i class="icon-pencil"></i>\
                                </a>\
                            </td>\
                        </tr>';

                    }

                    let class_tr_posicion = "tr_posicion_" + respuesta[i]['posicion0'];
                    let class_id_posicion = respuesta[i]['posicion0'];
                    let tr_posicion = '\
                    <tr id="'+class_id_posicion+'" class="'+class_tr_posicion+'" style="text-align: left; background-color:#555555; height:27px;cursor:pointer; color:white; font-size:13px;">\
                        <td colspan="11" style="padding-left: 40px;">\
                            <b style="text-transform: uppercase; font-size: 15px; padding-left: 40px;">'+nombre_posicion+'</b>\
                        </td>\
                    </tr>\
                    ';

                              
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
                            <td colspan="11">\
                                <b style="text-transform: uppercase; font-size: 14px; padding-left: 40px;">'+nombre_grupo_posicion+'</b>\
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

// -------------------------- Inicio de la función 'boton_ver_detalle_informe' --------------------------- //
function boton_ver_detalle_informe( linea ) {

    window.idfichaJugador = datos_visita_social[linea]['idfichaJugador'];



    let foto_jugador = 'foto_jugadores/' + datos_visita_social[linea]['idfichaJugador'] + '.png?lala='+new Date()+'';

    // Foto del jugador:
    $(".foto-jugador-modal").attr("src", foto_jugador );
    
    if( datos_visita_social[linea]['apellido2'] === null ) {
        datos_visita_social[linea]['apellido2'] = "";
    } 

    // Nombre:
    $(".nombre-jugador-modal").html( datos_visita_social[linea]['nombre'] ); 

    // Apellido:
    $(".apellido-jugador-modal").html( datos_visita_social[linea]['apellido1'] + " " + datos_visita_social[linea]['apellido2'] );     

    // Nombre Completo:
    $(".nombrecompleto-jugador-modal").html( datos_visita_social[linea]['nombre'] + " " + datos_visita_social[linea]['apellido1'] + " " + datos_visita_social[linea]['apellido2'] );    

    // --------------------------------------------------------------------------- ANTECEDENTES GENERALES --------------------------------------------------------------------------- //
    
    // Serie:
    let descripcion_serie;
    if( datos_visita_social[linea]['serieActual'] === null || datos_visita_social[linea]['serieActual'] == '' || datos_visita_social[linea]['serieActual'] == '0' || datos_visita_social[linea]['sexo'] === null || datos_visita_social[linea]['sexo'] == '' || datos_visita_social[linea]['sexo'] == '0' ) {
        descripcion_serie = '-';
    } else {
        let serieActual = datos_visita_social[linea]['serieActual'];
        let sexo = datos_visita_social[linea]['sexo'];                        
        if( serieActual == '99' ) {
            descripcion_serie = 'Primer Equipo';
        } else {
            genero = '';
            if( sexo == '1' ) {
            genero = 'Masculina';
            } else {
            genero = 'Femenina';
            }
            descripcion_serie = 'Sub ' + serieActual + ' ' + genero;
        }                        
    }
    $('.serie-jugador-modal').html( descripcion_serie );

    // Domicilio Actual:
    let domicilio_actual;
    if( datos_visita_social[linea]['domicilio_actual'] === null || datos_visita_social[linea]['domicilio_actual'] == '' || datos_visita_social[linea]['domicilio_actual'] == '0' ) {
        domicilio_actual = 'No especificado';
    } else {
        domicilio_actual = datos_visita_social[linea]['domicilio_actual'];
    }
    $('.domicilio-actual-jugador-modal').html( domicilio_actual );

    // Comuna (Visita Social):
    let comuna_visita_social;
    if( datos_visita_social[linea]['comuna_visita_social'] === null || datos_visita_social[linea]['comuna_visita_social'] == '' || datos_visita_social[linea]['comuna_visita_social'] == '0' ) {
        comuna_visita_social = 'No especificado';
    } else {
        comuna_visita_social = array_comuna[ datos_visita_social[linea]['comuna_visita_social'] ];
    }
    $('.comuna-jugador-modal').html( comuna_visita_social );

    // Comuna Procedencia:
    let comuna_procedencia;
    if( datos_visita_social[linea]['comuna_procedencia'] === null || datos_visita_social[linea]['comuna_procedencia'] == '' || datos_visita_social[linea]['comuna_procedencia'] == '0' ) {
        comuna_procedencia = 'No especificado';
    } else {
        comuna_procedencia = array_comuna[ datos_visita_social[linea]['comuna_procedencia'] ];
    }
    $('.comuna-procedencia-jugador-modal').html( comuna_procedencia );


    // --------------------------------------------------------------------------- APODERADO --------------------------------------------------------------------------- //

    // Nombre del Apoderado:
    let apod_nombre;
    if( datos_visita_social[linea]['apod_nombre'] === null || datos_visita_social[linea]['apod_nombre'] == '' || datos_visita_social[linea]['apod_nombre'] == '0' ) {
        apod_nombre = 'No especificado';
    } else {
        apod_nombre = datos_visita_social[linea]['apod_nombre'];
    }    
    $('.nombre-apoderado-modal').html( apod_nombre );


    // Parentesco del Apoderado:
    let apod_parentesco;
    if( datos_visita_social[linea]['apod_parentesco'] === null || datos_visita_social[linea]['apod_parentesco'] == '' || datos_visita_social[linea]['apod_parentesco'] == '0' ) {
        apod_parentesco = 'No especificado';
    } else {
        apod_parentesco = array_parentesco[datos_visita_social[linea]['apod_parentesco']][1];
    }
    $('.parentesco-apoderado-modal').html( apod_parentesco );

    // Correo del Apoderado:
    let apod_correo;
    if( datos_visita_social[linea]['apod_correo'] === null || datos_visita_social[linea]['apod_correo'] == '' || datos_visita_social[linea]['apod_correo'] == '0' ) {
        apod_correo = 'No especificado';
    } else {
        apod_correo = datos_visita_social[linea]['apod_correo'];
    }    
    $('.correo-apoderado-modal').html( apod_correo );   
    
    // Teléfono del Apoderado:
    let apod_telefono;
    if( datos_visita_social[linea]['apod_telefono'] === null || datos_visita_social[linea]['apod_telefono'] == '' || datos_visita_social[linea]['apod_telefono'] == '0' ) {
        apod_telefono = 'No especificado';
    } else {
        apod_telefono = datos_visita_social[linea]['apod_telefono'];
    }    
    $('.telefono-apoderado-modal').html( apod_telefono );        

    // --------------------------------------------------------------------------- Antecentes Familiares --------------------------------------------------------------------------- //

    // Nº Personas grupo familiar:
    let af_num_personas_gf;
    if( datos_visita_social[linea]['af_num_personas_gf'] === null || datos_visita_social[linea]['af_num_personas_gf'] == '' || datos_visita_social[linea]['af_num_personas_gf'] == '0' ) {
        af_num_personas_gf = 'No especificado';
    } else {
        af_num_personas_gf = datos_visita_social[linea]['af_num_personas_gf'];
    }    
    $('.af_num_personas_gf_modal').html( af_num_personas_gf );       

    // Nº Personas que viven en el domicilio del jugador:
    let af_num_personas_domicilio;
    if( datos_visita_social[linea]['af_num_personas_domicilio'] === null || datos_visita_social[linea]['af_num_personas_domicilio'] == '' || datos_visita_social[linea]['af_num_personas_domicilio'] == '0' ) {
        af_num_personas_domicilio = 'No especificado';
    } else {
        af_num_personas_domicilio = datos_visita_social[linea]['af_num_personas_domicilio'];
    }    
    $('.af_num_personas_domicilio_modal').html( af_num_personas_domicilio );    

    // Nº Habitaciones del domicilio:
    let af_num_habitaciones_domicilio;
    if( datos_visita_social[linea]['af_num_habitaciones_domicilio'] === null || datos_visita_social[linea]['af_num_habitaciones_domicilio'] == '' || datos_visita_social[linea]['af_num_habitaciones_domicilio'] == '0' ) {
        af_num_habitaciones_domicilio = 'No especificado';
    } else {
        af_num_habitaciones_domicilio = datos_visita_social[linea]['af_num_habitaciones_domicilio'];
    }    
    $('.af_num_habitaciones_domicilio_modal').html( af_num_habitaciones_domicilio );  

    // Comparte habitación:
    let af_comparte_habitacion;
    if( datos_visita_social[linea]['af_comparte_habitacion'] === null || datos_visita_social[linea]['af_comparte_habitacion'] == '' ) {
        af_comparte_habitacion = 'No especificado';
    } else {

        if( datos_visita_social[linea]['af_comparte_habitacion'] == '1' ) {
            af_comparte_habitacion = 'Sí';
        } else {
            af_comparte_habitacion = 'No';
        }
    }    
    $('.af_comparte_habitacion_modal').html( af_comparte_habitacion );                   

    // Ingreso núcleo familiar:
    let af_ingreso_nucleo_familiar;
    if( datos_visita_social[linea]['af_ingreso_nucleo_familiar'] === null || datos_visita_social[linea]['af_ingreso_nucleo_familiar'] == '' ) {
        af_ingreso_nucleo_familiar = 'No especificado';
    } else {
        af_ingreso_nucleo_familiar = datos_visita_social[linea]['af_ingreso_nucleo_familiar'];
    }    
    $('.af_ingreso_nucleo_familiar_modal').html( af_ingreso_nucleo_familiar );

    // Es independiente económicamente:
    let af_indep_economica;
    if( datos_visita_social[linea]['af_indep_economica'] === null || datos_visita_social[linea]['af_indep_economica'] == '' ) {
        af_indep_economica = 'No especificado';
    } else {

        if( datos_visita_social[linea]['af_indep_economica'] == '1' ) {
            af_indep_economica = 'Sí';
        } else {
            af_indep_economica = 'No';
        }
    }    
    $('.af_indep_economica_modal').html( af_indep_economica );

    // Situación conyugal de sus padres:
    let af_situacion_conyugal_padres;
    if( datos_visita_social[linea]['af_situacion_conyugal_padres'] === null || datos_visita_social[linea]['af_situacion_conyugal_padres'] == '' || datos_visita_social[linea]['af_situacion_conyugal_padres'] == '0' ) {
        af_situacion_conyugal_padres = 'No especificado';
    } else {
        af_situacion_conyugal_padres = array_situacion_conyugal[ datos_visita_social[linea]['af_situacion_conyugal_padres'] ][1];
    }    
    $('.af_situacion_conyugal_padres_modal').html( af_situacion_conyugal_padres );        

    // Nº Hermanos:
    let af_num_hermanos;
    if( datos_visita_social[linea]['af_num_hermanos'] === null || datos_visita_social[linea]['af_num_hermanos'] == '' ) {
        af_num_hermanos = 'No especificado';
    } else {
        af_num_hermanos = datos_visita_social[linea]['af_num_hermanos'];
    }    
    $('.af_num_hermanos_modal').html( af_num_hermanos );

    // DETALLE PERSONAS QUE VIVEN CON EL JUGADOR

    $('#tabla_personas_viven_conjug_modal tbody').empty(); // <----------- Vaciando tabla (IMPORTANTE).

    if( datos_visita_social[linea]['array_persona_domicilio_jugador'] != null ) {

        let count = 1;
        for( var i = 0; i < datos_visita_social[linea]['array_persona_domicilio_jugador'].length; i++ ) {

            let nombre_domicilio_jugador = datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['nombre_domicilio_jugador'];
            
            let parentesco_domicilio_jugador;
            if( datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['parentesco_domicilio_jugador'] === null || datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['parentesco_domicilio_jugador'] == '' || datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['parentesco_domicilio_jugador'] == '0' ) {

                parentesco_domicilio_jugador = 'No especificado';

            } else {
            
                parentesco_domicilio_jugador = array_parentesco[ datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['parentesco_domicilio_jugador'] ][1];
            
            }
            
            let edad_domicilio_jugador = datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['edad_domicilio_jugador'];
            
            let nivel_educacional_domicilio_jugador;
            if( datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['nivel_educacional_domicilio_jugador'] === null || datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['nivel_educacional_domicilio_jugador'] == '' || datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['nivel_educacional_domicilio_jugador'] == '0' ) {
            
                nivel_educacional_domicilio_jugador = 'No especificado';
            
            } else {
            
                nivel_educacional_domicilio_jugador = array_nivel_educacional[ datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['nivel_educacional_domicilio_jugador'] ][1];
            }
            

            let ocupacion_domicilio_jugador = datos_visita_social[linea]['array_persona_domicilio_jugador'][i]['ocupacion_domicilio_jugador'];


            let markup = 
            '<tr>\
                <th>'+count+'-</th>\
                <th style="width: 55px;">Nombre:</th>\
                <td style="width: 100px;">'+nombre_domicilio_jugador+'</td>\
                <th style="width: 75px;">Parentesco:</th>\
                <td style="width: 55px;">'+parentesco_domicilio_jugador+'</td>\
                <th>Edad:</th>\
                <td style="width: 80px;">'+edad_domicilio_jugador+'</td>\
                <th style="width: 115px;">Nivel educacional:</th>\
                <td class="">'+nivel_educacional_domicilio_jugador+'</td>\
                <th style="width: 70px;">Ocupación:</th>\
                <td class="">'+ocupacion_domicilio_jugador+'</td>\
            </tr>\
            ';

            $('#tabla_personas_viven_conjug_modal tbody').append( markup );
            count++;

        }

    } else {
            let markup = 
            '<tr>\
                <th>No se especificaron familiares</th>\
            </tr>\
            ';        
        $('#tabla_personas_viven_conjug_modal tbody').append( markup );
    }

    // INFORMACIÓN RELEVANTE DEL GRUPO FAMILIAR DEL JUGADOR:
    let af_info_grupo_familiar;
    if( datos_visita_social[linea]['af_info_grupo_familiar'] === null || datos_visita_social[linea]['af_info_grupo_familiar'] == '' ) {
        af_info_grupo_familiar = 'No especificado';
    } else {
        af_info_grupo_familiar = datos_visita_social[linea]['af_info_grupo_familiar'];
    }    
    $('.af_info_grupo_familiar_modal').html( af_info_grupo_familiar );

    // VALORACIÓN DEL RIESGO DEL ENTORNO FAMILIAR:
    let class_af_valoracion_modal;
    let descripcion_af_valoracion_modal;
    switch( datos_visita_social[linea]['af_valoracion'] ) {
        case "0":
            class_af_valoracion_modal = 'valoracion-alta';
            descripcion_af_valoracion_modal = 'ALTO RIESGO';
            break;
        case "1":
            class_af_valoracion_modal = 'valoracion-media';
            descripcion_af_valoracion_modal = 'MEDIO RIESGO';
            break;
        case "2":
            class_af_valoracion_modal = 'valoracion-baja';
            descripcion_af_valoracion_modal = 'BAJO RIESGO';
            break;                                                        
    }   

    $('#af_valoracion_modal').attr('class', ''); // <-------- Vaciando el atributo 'class'
    $('#af_valoracion_modal').attr('class', 'valoracion-modal ' + class_af_valoracion_modal);
    $('#af_valoracion_modal span').html( descripcion_af_valoracion_modal ).attr('class', class_af_valoracion_modal);

    $("#af_valoracion_text_modal").html( datos_visita_social[linea]['af_valoracion_text'] );     

    // --------------------------------------------------------------------------- RELACIONES PERSONALES --------------------------------------------------------------------------- //

    // Situación amorosa:
    let rp_situacion_amorosa;
    if( datos_visita_social[linea]['rp_situacion_amorosa'] === null || datos_visita_social[linea]['rp_situacion_amorosa'] == '' || datos_visita_social[linea]['rp_situacion_amorosa'] == '0' ) {
        rp_situacion_amorosa = 'No especificado';
    } else {
        rp_situacion_amorosa = array_situacion_amorosa[ datos_visita_social[linea]['rp_situacion_amorosa'] ][1];
    }    
    $('.rp_situacion_amorosa_modal').html( rp_situacion_amorosa );        

    // Hace cuanto:
    $(".rp_hace_cuanto_modal").html( datos_visita_social[linea]['rp_hace_cuanto'] );   

    // Calidad de la relación en pareja:
    $(".rp_relacion_pareja_modal").html( datos_visita_social[linea]['rp_relacion_pareja'] );  

    // Inició vida sexual:
    let rp_inicio_vida_sexual;
    if( datos_visita_social[linea]['rp_inicio_vida_sexual'] === null || datos_visita_social[linea]['rp_inicio_vida_sexual'] == '' ) {
        rp_inicio_vida_sexual = 'No especificado';
    } else {

        if( datos_visita_social[linea]['rp_inicio_vida_sexual'] == '1' ) {
            rp_inicio_vida_sexual = 'Sí';
        } else {
            rp_inicio_vida_sexual = 'No';
        }
    }    
    $('.rp_inicio_vida_sexual_modal').html( rp_inicio_vida_sexual );

    // Método de protección:
    $(".rp_metodo_proteccion_modal").html( datos_visita_social[linea]['rp_metodo_proteccion'] );  

    // Tiene hijos:
    let rp_tiene_hijos;
    if( datos_visita_social[linea]['rp_tiene_hijos'] === null || datos_visita_social[linea]['rp_tiene_hijos'] == '' ) {
        rp_tiene_hijos = 'No especificado';
    } else {

        if( datos_visita_social[linea]['rp_tiene_hijos'] == '1' ) {
            rp_tiene_hijos = 'Sí';
        } else {
            rp_tiene_hijos = 'No';
        }
    }    
    $('.rp_tiene_hijos_modal').html( rp_tiene_hijos );

    // VALORACIÓN DEL RIESGO DE LAS RELACIONES PERSONALES:
    let class_rp_valoracion_modal;
    let descripcion_rp_valoracion_modal;
    switch( datos_visita_social[linea]['rp_valoracion'] ) {
        case "0":
            class_rp_valoracion_modal = 'valoracion-alta';
            descripcion_rp_valoracion_modal = 'ALTO RIESGO';
            break;
        case "1":
            class_rp_valoracion_modal = 'valoracion-media';
            descripcion_rp_valoracion_modal = 'MEDIO RIESGO';
            break;
        case "2":
            class_rp_valoracion_modal = 'valoracion-baja';
            descripcion_rp_valoracion_modal = 'BAJO RIESGO';
            break;                                                        
    }   

    $('#rp_valoracion_modal').attr('class', ''); // <-------- Vaciando el atributo 'class'
    $('#rp_valoracion_modal').attr('class', 'valoracion-modal ' + class_rp_valoracion_modal);
    $('#rp_valoracion_modal span').html( descripcion_rp_valoracion_modal ).attr('class', class_rp_valoracion_modal);

    $("#rp_valoracion_text_modal").html( datos_visita_social[linea]['rp_valoracion_text'] );     

    // --------------------------------------------------------------------------- ALIMENTACIÓN --------------------------------------------------------------------------- //

    // Tiene hijos:
    let a_costear_alimentacion;
    if( datos_visita_social[linea]['a_costear_alimentacion'] === null || datos_visita_social[linea]['a_costear_alimentacion'] == '' ) {
        a_costear_alimentacion = 'No especificado';
    } else {

        if( datos_visita_social[linea]['a_costear_alimentacion'] == '1' ) {
            a_costear_alimentacion = 'Sí';
        } else {
            a_costear_alimentacion = 'No';
        }
    }    
    $('.a_costear_alimentacion_modal').html( a_costear_alimentacion );

    // Observaciones:
    $(".a_observaciones_modal").html( datos_visita_social[linea]['a_observaciones'] );

    // Observaciones:
    $(".a_observaciones_modal").html( datos_visita_social[linea]['a_observaciones'] );

    // Comidas que realiza en el club:
    let array_a_comidas_club = ['nulo', 'Desayuno', 'Colocación mañana', 'Almuerzo', 'Merienda tarde', 'Cena', 'Snack post entrenamiento']
    let a_comidas_club;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_visita_social[linea]['a_comidas_club'] === null || datos_visita_social[linea]['a_comidas_club'] == '0' || datos_visita_social[linea]['a_comidas_club'] == '' ) {
        a_comidas_club = 'No especificado';
    } else {
        a_comidas_club = parseInt( datos_visita_social[linea]['a_comidas_club'] );
        a_comidas_club = array_a_comidas_club[a_comidas_club];
    }    
    $(".a_comidas_club_modal").html( a_comidas_club ); 
    
    // Comidas que realiza al día:
    $(".a_comidas_diarias_modal").html( datos_visita_social[linea]['a_comidas_diarias'] );            

    //VALORACIÓN DEL RIESGO DE LA ALIMENTACIÓN:
    let class_a_valoracion_modal;
    let descripcion_a_valoracion_modal;
    switch( datos_visita_social[linea]['a_valoracion'] ) {
        case "0":
            class_a_valoracion_modal = 'valoracion-alta';
            descripcion_a_valoracion_modal = 'ALTO RIESGO';
            break;
        case "1":
            class_a_valoracion_modal = 'valoracion-media';
            descripcion_a_valoracion_modal = 'MEDIO RIESGO';
            break;
        case "2":
            class_a_valoracion_modal = 'valoracion-baja';
            descripcion_a_valoracion_modal = 'BAJO RIESGO';
            break;                                                        
    }   

    $('#a_valoracion_modal').attr('class', ''); // <-------- Vaciando el atributo 'class'
    $('#a_valoracion_modal').attr('class', 'valoracion-modal ' + class_a_valoracion_modal);
    $('#a_valoracion_modal span').html( descripcion_a_valoracion_modal ).attr('class', class_a_valoracion_modal);

    $("#a_valoracion_text_modal").html( datos_visita_social[linea]['a_valoracion_text'] );    

    // --------------------------------------------------------------------------- LOCOMOCIÓN --------------------------------------------------------------------------- //

    // Como llega al club:
    let lista_descripcion_llegada_club;
    if( datos_visita_social[linea]['array_visitasocial_llegada_club'] != null ) {
        // console.log( datos_visita_social[linea]['array_visitasocial_llegada_club'] );

        if( datos_visita_social[linea]['array_visitasocial_llegada_club'] != '' ) {

            let array_descripcion_llegada_ida_club = []; 
            for( var i = 0; i < datos_visita_social[linea]['array_visitasocial_llegada_club'].length; i++ ) {
                let descripcion_llegada_ida_club = datos_visita_social[linea]['array_visitasocial_llegada_club'][i]['descripcion_llegada_ida_club'];
                array_descripcion_llegada_ida_club[i] = descripcion_llegada_ida_club;
            }

            lista_descripcion_llegada_club = array_descripcion_llegada_ida_club.join(", ");
        
        } else {
            lista_descripcion_llegada_club = '-';
        }
        
    } else {
        lista_descripcion_llegada_club = 'No especificado';
    }    

    $('.llegada_club_modal').html( lista_descripcion_llegada_club );

    // Medio (Llegada al club):
    let lista_descripcion_medio_transporte_llegada;
    if( datos_visita_social[linea]['array_visitasocial_mediotrans_llegada'] != null ) {
        // console.log( datos_visita_social[linea]['array_visitasocial_mediotrans_llegada'] );

        if( datos_visita_social[linea]['array_visitasocial_mediotrans_llegada'] != '' ) {

            let array_descripcion_medio_transporte = []; 
            for( var i = 0; i < datos_visita_social[linea]['array_visitasocial_mediotrans_llegada'].length; i++ ) {
                let descripcion_medio_transporte = datos_visita_social[linea]['array_visitasocial_mediotrans_llegada'][i]['descripcion_medio_transporte'];
                array_descripcion_medio_transporte[i] = descripcion_medio_transporte;
            }

            lista_descripcion_medio_transporte_llegada = array_descripcion_medio_transporte.join(", ");
        
        } else {
            lista_descripcion_medio_transporte_llegada = '-';
        }
        
    } else {
        lista_descripcion_medio_transporte_llegada = 'No especificado';
    }        

    $('.mediotrans_llegada_club_modal').html( lista_descripcion_medio_transporte_llegada );

    // Como se va del club:
    let lista_descripcion_ida_club;
    if( datos_visita_social[linea]['array_visitasocial_ida_club'] != null ) {
        console.log( datos_visita_social[linea]['array_visitasocial_ida_club'] );

        if( datos_visita_social[linea]['array_visitasocial_ida_club'] != '' ) {

            let array_descripcion_ida_ida_club = []; 
            for( var i = 0; i < datos_visita_social[linea]['array_visitasocial_ida_club'].length; i++ ) {
                let descripcion_ida_ida_club = datos_visita_social[linea]['array_visitasocial_ida_club'][i]['descripcion_llegada_ida_club'];
                array_descripcion_ida_ida_club[i] = descripcion_ida_ida_club;
            }

            lista_descripcion_ida_club = array_descripcion_ida_ida_club.join(", ");
        
        } else {
            lista_descripcion_ida_club = '-';
        }
        
    } else {
        lista_descripcion_ida_club = 'No especificado';
    }    

    $('.ida_club_modal').html( lista_descripcion_ida_club );

    // Medio (Ida del club):
    let lista_descripcion_medio_transporte_ida;
    if( datos_visita_social[linea]['array_visitasocial_mediotrans_ida'] != null ) {
        // console.log( datos_visita_social[linea]['array_visitasocial_mediotrans_ida'] );

        if( datos_visita_social[linea]['array_visitasocial_mediotrans_ida'] != '' ) {

            let array_descripcion_medio_transporte = []; 
            for( var i = 0; i < datos_visita_social[linea]['array_visitasocial_mediotrans_ida'].length; i++ ) {
                let descripcion_medio_transporte = datos_visita_social[linea]['array_visitasocial_mediotrans_ida'][i]['descripcion_medio_transporte'];
                array_descripcion_medio_transporte[i] = descripcion_medio_transporte;
            }

            lista_descripcion_medio_transporte_ida = array_descripcion_medio_transporte.join(", ");
        
        } else {
            lista_descripcion_medio_transporte_ida = '-';
        }
        
    } else {
        lista_descripcion_medio_transporte_ida = 'No especificado';
    }        

    $('.mediotrans_ida_club_modal').html( lista_descripcion_medio_transporte_ida );

    //VALORACIÓN DEL RIESGO DE LA LOCOMOCIÓN:
    let class_l_valoracion_modal;
    let descripcion_l_valoracion_modal;
    switch( datos_visita_social[linea]['l_valoracion'] ) {
        case "0":
            class_l_valoracion_modal = 'valoracion-alta';
            descripcion_l_valoracion_modal = 'ALTO RIESGO';
            break;
        case "1":
            class_l_valoracion_modal = 'valoracion-media';
            descripcion_l_valoracion_modal = 'MEDIO RIESGO';
            break;
        case "2":
            class_l_valoracion_modal = 'valoracion-baja';
            descripcion_l_valoracion_modal = 'BAJO RIESGO';
            break;                                                        
    }   

    $('#l_valoracion_modal').attr('class', ''); // <-------- Vaciando el atributo 'class'
    $('#l_valoracion_modal').attr('class', 'valoracion-modal ' + class_l_valoracion_modal);
    $('#l_valoracion_modal span').html( descripcion_l_valoracion_modal ).attr('class', class_l_valoracion_modal);

    $("#l_valoracion_text_modal").html( datos_visita_social[linea]['l_valoracion_text'] );    

    // --------------------------------------------------------------------------- SALUD --------------------------------------------------------------------------- //
    
    // Consume drogas:
    let s_consume_drogas;
    if( datos_visita_social[linea]['s_consume_drogas'] === null || datos_visita_social[linea]['s_consume_drogas'] == '' ) {
        s_consume_drogas = 'No especificado';
    } else {

        if( datos_visita_social[linea]['s_consume_drogas'] == '1' ) {
            s_consume_drogas = 'Sí';
        } else {
            s_consume_drogas = 'No';
        }
    }    
    $('.s_consume_drogas_modal').html( s_consume_drogas );

    // Drogas que ha probado:
    let lista_descripcion_droga;
    if( datos_visita_social[linea]['array_visitasocial_droga_probadajug'] != null ) {
        // console.log( datos_visita_social[linea]['array_visitasocial_droga_probadajug'] );

        if( datos_visita_social[linea]['array_visitasocial_droga_probadajug'] != '' ) {

            let array_descripcion_droga = []; 
            for( var i = 0; i < datos_visita_social[linea]['array_visitasocial_droga_probadajug'].length; i++ ) {
                let descripcion_droga = datos_visita_social[linea]['array_visitasocial_droga_probadajug'][i]['descripcion_droga'];
                array_descripcion_droga[i] = descripcion_droga;
            }

            lista_descripcion_droga = array_descripcion_droga.join(", ");
        
        } else {
            lista_descripcion_droga = '-';
        }
        
    } else {
        lista_descripcion_droga = 'No especificado';
    }        

    $('.drogas_probadas_jugador_modal').html( lista_descripcion_droga );

    // Familiar consume drogas:
    let s_familiar_consume_drogas;
    if( datos_visita_social[linea]['s_familiar_consume_drogas'] === null || datos_visita_social[linea]['s_familiar_consume_drogas'] == '' ) {
        s_familiar_consume_drogas = 'No especificado';
    } else {

        if( datos_visita_social[linea]['s_familiar_consume_drogas'] == '1' ) {
            s_familiar_consume_drogas = 'Sí';
        } else {
            s_familiar_consume_drogas = 'No';
        }
    }    
    $('.s_familiar_consume_drogas_modal').html( s_familiar_consume_drogas );

    // Quien / es:
    $(".s_quien_consume_drogas_familiar_modal").html( datos_visita_social[linea]['s_quien_consume_drogas_familiar'] );  

    // Que drogas (Familiar):
    let lista_descripcion_familiar; 
    if( datos_visita_social[linea]['array_visitasocial_droga_consumidafam'] != null ) {
        // console.log( datos_visita_social[linea]['array_visitasocial_droga_consumidafam'] );

        if( datos_visita_social[linea]['array_visitasocial_droga_consumidafam'] != '' ) {

            let array_descripcion_droga = []; 
            for( var i = 0; i < datos_visita_social[linea]['array_visitasocial_droga_consumidafam'].length; i++ ) {
                let descripcion_droga = datos_visita_social[linea]['array_visitasocial_droga_consumidafam'][i]['descripcion_droga'];
                array_descripcion_droga[i] = descripcion_droga;
            }

            lista_descripcion_familiar = array_descripcion_droga.join(", ");
        
        } else {
            lista_descripcion_familiar = '-';
        }
        
    } else {
        lista_descripcion_familiar = 'No especificado';
    } 

    $(".s_drogas_consumidas_familiar_modal").html( lista_descripcion_familiar );


    //VALORACIÓN DEL RIESGO DE SALUD:
    let class_s_valoracion_modal;
    let descripcion_s_valoracion_modal;
    switch( datos_visita_social[linea]['s_valoracion'] ) {
        case "0":
            class_s_valoracion_modal = 'valoracion-alta';
            descripcion_s_valoracion_modal = 'ALTO RIESGO';
            break;
        case "1":
            class_s_valoracion_modal = 'valoracion-media';
            descripcion_s_valoracion_modal = 'MEDIO RIESGO';
            break;
        case "2":
            class_s_valoracion_modal = 'valoracion-baja';
            descripcion_s_valoracion_modal = 'BAJO RIESGO';
            break;                                                        
    }   

    $('#s_valoracion_modal').attr('class', ''); // <-------- Vaciando el atributo 'class'
    $('#s_valoracion_modal').attr('class', 'valoracion-modal ' + class_s_valoracion_modal);
    $('#s_valoracion_modal span').html( descripcion_s_valoracion_modal ).attr('class', class_s_valoracion_modal);

    $("#s_valoracion_text_modal").html( datos_visita_social[linea]['s_valoracion_text'] );    

    // --------------------------------------------------------------------------- ANTECEDENTES JUDICIALES --------------------------------------------------------------------------- //

    // Antecedentes (Jugador):
    let aj_jugador_antecedentes;
    if( datos_visita_social[linea]['aj_jugador_tiene_antecedentes'] == '1' ) {
        aj_jugador_antecedentes = datos_visita_social[linea]['aj_jugador_antecedentes'];
    } else {
        aj_jugador_antecedentes = 'Sin antecedentes';
    }
    
    $(".aj_jugador_antecedentes_modal").html( aj_jugador_antecedentes );

    // Antecedentes (Familiar):
    let aj_familiar_antecedentes;
    if( datos_visita_social[linea]['aj_familiar_tiene_antecedentes'] == '1' ) {
        aj_familiar_antecedentes = datos_visita_social[linea]['aj_familiar_antecedentes'];
    } else {
        aj_familiar_antecedentes = 'Sin antecedentes';
    }
    
    $(".aj_familiar_antecedentes_modal").html( aj_familiar_antecedentes );    

    //VALORACIÓN DEL RIESGO JUDICIAL:
    let class_aj_valoracion_modal;
    let descripcion_aj_valoracion_modal;
    switch( datos_visita_social[linea]['aj_valoracion'] ) {
        case "0":
            class_aj_valoracion_modal = 'valoracion-alta';
            descripcion_aj_valoracion_modal = 'ALTO RIESGO';
            break;
        case "1":
            class_aj_valoracion_modal = 'valoracion-media';
            descripcion_aj_valoracion_modal = 'MEDIO RIESGO';
            break;
        case "2":
            class_aj_valoracion_modal = 'valoracion-baja';
            descripcion_aj_valoracion_modal = 'BAJO RIESGO';
            break;                                                        
    }   

    $('#aj_valoracion_modal').attr('class', ''); // <-------- Vaciando el atributo 'class'
    $('#aj_valoracion_modal').attr('class', 'valoracion-modal ' + class_aj_valoracion_modal);
    $('#aj_valoracion_modal span').html( descripcion_aj_valoracion_modal ).attr('class', class_aj_valoracion_modal);

    $("#aj_valoracion_text_modal").html( datos_visita_social[linea]['aj_valoracion_text'] );    

    // --------------------------------------------------------------------------- OTROS DATOS --------------------------------------------------------------------------- //    

    // Seguro contra accidentes:
    let od_tiene_seguro;
    if( datos_visita_social[linea]['od_tiene_seguro'] === null || datos_visita_social[linea]['od_tiene_seguro'] == '' ) {
        od_tiene_seguro = 'No especificado';
    } else {

        if( datos_visita_social[linea]['od_tiene_seguro'] == '1' ) {
            od_tiene_seguro = 'Sí';
        } else {
            od_tiene_seguro = 'No';
        }
    }    
    $('.od_tiene_seguro_modal').html( od_tiene_seguro );    

    // Compañia:
    $(".od_nombre_compania_seguro_modal").html( datos_visita_social[linea]['od_nombre_compania_seguro'] );

    // Vencimiento:
    $(".od_seguro_vencimiento_modal").html( datos_visita_social[linea]['od_seguro_vencimiento'] );    

    // Tiene pasaporte:
    let od_tiene_pasaporte;
    if( datos_visita_social[linea]['od_tiene_pasaporte'] === null || datos_visita_social[linea]['od_tiene_pasaporte'] == '' ) {
        od_tiene_pasaporte = 'No especificado';
    } else {

        if( datos_visita_social[linea]['od_tiene_pasaporte'] == '1' ) {
            od_tiene_pasaporte = 'Sí';
        } else {
            od_tiene_pasaporte = 'No';
        }
    }    
    $('.od_tiene_pasaporte_modal').html( od_tiene_pasaporte );   

    // Venc. Carnet Identidad::
    $(".od_vencimiento_carnetid_modal").html( datos_visita_social[linea]['od_vencimiento_carnetid'] ); 

    // OBSERVACIONES:
    $("#od_observaciones_modal").html( datos_visita_social[linea]['od_observaciones'] ); 


    // -------------------------------------------------------------------------------------------------------------------- //

    $('#modal_detalle_visita_social').modal('show'); // <------------ MOSTRANDO EL MODAL

}
// -------------------------- Fin de la función 'boton_ver_detalle_informe' --------------------------- //

function boton_volver_cuadro_listado_series() {
    $('#cuadro_serie_selected').hide(500);
    $('#cuadro_listado_series').show(500);
    $('.cuadro_buscar_buscar').show(500);
    $('.cuadro_buscar_titulo').show(500);
    $("#tabla_verEjercicios tbody").empty();
}

function boton_volver_serie_selected_registro_cargas_diarias() {
    $("#tabla_ver_informes_todos tbody").empty(); // <--- Vaciando tabla.
    $('#cuadro_perfil_jugador_selected').hide(500);
    $('#cuadro_serie_selected').show(500);
    buscador();
}

function boton_volver_perfil_jugador_selected() {
    $("#tabla_ver_perfil_jugador tbody").empty(); // <--- Vaciando tabla.
    $('#cuadro_formulario_guardar').hide(500);
    $('#cuadro_perfil_jugador_selected').show(500);
    buscar_visitas_jugador_social(); // <--- Modificación hecha el 28-02-2020.
}


function volver_despues_guardado() {
    $('#cuadro_formulario_guardar').hide(500);
    $('#cuadro_serie_selected').show(500);
    buscador();
}


function volver_despues_eliminacion() {
    buscar_visitas_jugador_social();
}


function chequear_datos(){
    
    var ER_numericosDecimales = /^([0-9]*|(\d+))(\.\d{1,2})?$/;
    var ER_numericosEnteros = /[0-9]/;
    var ER_caracteresAlfaNumericos = /^[a-zA-ZáàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜñÑ 0-9,.-_¿?¡!$%#()]*$/;
    flag = true;

    // --------- Validando los inputs (radio): 
    var check = true;
    $("input:radio").each(function(){
        var name = $(this).attr("name");
        if($("input:radio[name="+name+"]:checked").length == 0){
            check = false;
        }
    });
    
    if(check){
        flag = true;
    }else{
        // flag = false;
    }


    // ---------------------------------------- ANTECEDENTES GENERALES ---------------------------------------- //
    let domicilio_actual = $("#domicilio_actual").val();
    if( domicilio_actual != "" ) {
        if( domicilio_actual.match(ER_caracteresAlfaNumericos) && ( parseInt(domicilio_actual.length) >= 1 ) ) {      
            $("#domicilio_actual").css("background-color", "white");
        } else {
            $("#domicilio_actual").css("background-color", "#ffc6c6");
            flag = false;
        }
    } else {
        $("#domicilio_actual").css("background-color", "#fff");
        // flag = false;
    }

    let comuna = $("#comuna").val();
    if( comuna == "" ) {
        $("#comuna").css("background-color", "white");
        // flag = false;
    } else {
        $("#comuna").css("background-color", "white");
    }

    let comuna_procedencia = $("#comuna_procedencia").val();
    if( comuna_procedencia == "" ) {
        $("#comuna_procedencia").css("background-color", "white");
        // flag = false;
    } else {
        $("#comuna_procedencia").css("background-color", "white");
    }    


    // ---------------------------------------- APODERADO---------------------------------------- //

    let apod_nombre = $("#apod_nombre").val();
    if( apod_nombre != "" ) {
        if( apod_nombre.match(ER_caracteresAlfaNumericos) && ( parseInt(apod_nombre.length) >= 1 ) ) {      
            $("#apod_nombre").css("background-color", "white");
        } else {
            $("#apod_nombre").css("background-color", "#ffc6c6");
            flag = false;
        }
    } else {
        $("#apod_nombre").css("background-color", "#fff");
        // flag = false;
    }

    let apod_parentesco = $("#apod_parentesco").val();
    if( apod_parentesco == "" ) {
        $("#apod_parentesco").css("background-color", "white");
        // flag = false;
    } else {
        $("#apod_parentesco").css("background-color", "white");
    } 

    let apod_correo = $("#apod_correo").val();
    if( apod_correo != "" ) {
        if( apod_correo.match(ER_caracteresAlfaNumericos) && ( parseInt(apod_correo.length) >= 1 ) ) {      
            $("#apod_correo").css("background-color", "white");
        } else {
            $("#apod_correo").css("background-color", "#ffc6c6");
            flag = false;
        }
    } else {
        $("#apod_correo").css("background-color", "#fff");
        // flag = false;
    } 
    
    let apod_telefono = $("#apod_telefono").val();
    if( apod_telefono != "" ) {
        if( apod_telefono.match(ER_caracteresAlfaNumericos) && ( parseInt(apod_telefono.length) >= 1 ) ) {      
            $("#apod_telefono").css("background-color", "white");
        } else {
            $("#apod_telefono").css("background-color", "#ffc6c6");
            flag = false;
        }
    } else {
        $("#apod_telefono").css("background-color", "#fff");
        // flag = false;
    }               

    // ---------------------------------------- ANTECEDENTES FAMILIARES---------------------------------------- //

    // Aplicando validación solamente si el campo es visible:
    if($("#af_num_personas_gf").is(":visible")) {

        let af_num_personas_gf = $("#af_num_personas_gf").val();
        if( af_num_personas_gf != "" ) {
            if( af_num_personas_gf.match(ER_numericosEnteros) && ( parseInt(af_num_personas_gf.length) >= 1 && parseInt(af_num_personas_gf.length) <= 2 ) ) {      
                $("#af_num_personas_gf").css("background-color", "white");
            } else {
                $("#af_num_personas_gf").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#af_num_personas_gf").css("background-color", "white");
            // flag = false;
        }  

    }

    // Aplicando validación solamente si el campo es visible:
    if($("#af_num_personas_domicilio").is(":visible")) {

        let af_num_personas_domicilio = $("#af_num_personas_domicilio").val();
        if( af_num_personas_domicilio != "" ) {
            if( af_num_personas_domicilio.match(ER_numericosEnteros) && ( parseInt(af_num_personas_domicilio.length) >= 1 && parseInt(af_num_personas_domicilio.length) <= 2 ) ) {      
                $("#af_num_personas_domicilio").css("background-color", "white");
            } else {
                $("#af_num_personas_domicilio").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#af_num_personas_domicilio").css("background-color", "white");
            // flag = false;
        }  

    }
    // Aplicando validación solamente si el campo es visible:
    if($("#af_num_habitaciones_domicilio").is(":visible")) {

        let af_num_habitaciones_domicilio = $("#af_num_habitaciones_domicilio").val();
        if( af_num_habitaciones_domicilio != "" ) {
            if( af_num_habitaciones_domicilio.match(ER_numericosEnteros) && ( parseInt(af_num_habitaciones_domicilio.length) >= 1 && parseInt(af_num_habitaciones_domicilio.length) <= 2 ) ) {      
                $("#af_num_habitaciones_domicilio").css("background-color", "white");
            } else {
                $("#af_num_habitaciones_domicilio").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#af_num_habitaciones_domicilio").css("background-color", "white");
            // flag = false;
        }      

    }    

    // Aplicando validación solamente si el campo es visible:
    if($("#af_comparte_habitacion").is(":visible")) {

        let af_comparte_habitacion = $("#af_comparte_habitacion").val();
        if( af_comparte_habitacion == "" ) {
            $("#af_comparte_habitacion").css("background-color", "white");
            // flag = false;
        } else {
            $("#af_comparte_habitacion").css("background-color", "white");
        }  

    } 

    // Aplicando validación solamente si el campo es visible:
    if($("#af_conquien_comparte_habitacion").is(":visible")) {

        let af_conquien_comparte_habitacion = $("#af_conquien_comparte_habitacion").val();
        if( af_conquien_comparte_habitacion != "" ) {
            if( af_conquien_comparte_habitacion.match(ER_caracteresAlfaNumericos) && ( parseInt(af_conquien_comparte_habitacion.length) >= 1 && parseInt(af_conquien_comparte_habitacion.length) <= 150 ) ) {
                $("#af_conquien_comparte_habitacion").css("background-color", "white");
            } else {
                $("#af_conquien_comparte_habitacion").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#af_conquien_comparte_habitacion").css("background-color", "white");
            // flag = false;
        }  

    } 

    // Aplicando validación solamente si el campo es visible:
    if($("#tabla_personas_viven_conjug").is(":visible")) {

        $("input[name='array_nombre_domicilio_jugador[]']").each(function(){
            let thisElement = $(this);
            let thisValue = $(this).val();

            if( thisValue != "" ) {
                if( thisValue.match(ER_caracteresAlfaNumericos) && ( parseInt(thisValue.length) >= 1 && parseInt(thisValue.length) <= 150 ) ) {
                    thisElement.css("background-color", "white");
                } else {
                    thisElement.css("background-color", "white");
                    flag = false;
                }
            } else {
                thisElement.css("background-color", "white");
                // flag = false;
            }       
                   
        }); 

        // --------------------------------- // 
        $("select[name='array_parentesco_domicilio_jugador[]']").each(function(){
            let thisElement = $(this);
            let thisValue = $(this).val();

            if( thisValue == "" ) {
                thisElement.css("background-color", "white");
                // flag = false;
            } else {
                thisElement.css("background-color", "white");
            }        
                   
        });         

        // --------------------------------- // 
        $("input[name='array_edad_domicilio_jugador[]']").each(function(){
            let thisElement = $(this);
            let thisValue = $(this).val();

            if( thisValue != "" ) {
                if( thisValue.match(ER_numericosEnteros) && ( parseInt(thisValue.length) >= 1 && parseInt(thisValue.length) <= 2 ) ) {      
                    thisElement.css("background-color", "white");
                } else {
                    thisElement.css("background-color", "white");
                    flag = false;
                }
            } else {
                thisElement.css("background-color", "white");
                // flag = false;
            } 
                   
        });     

        // --------------------------------- // 
        $("select[name='array_nivel_educacional_domicilio_jugador[]']").each(function(){
            let thisElement = $(this);
            let thisValue = $(this).val();

            if( thisValue == "" ) {
                thisElement.css("background-color", "white");
                // flag = false;
            } else {
                thisElement.css("background-color", "white");
            }        
                   
        }); 

        // --------------------------------- //
        $("input[name='array_ocupacion_domicilio_jugador[]']").each(function(){
            let thisElement = $(this);
            let thisValue = $(this).val();

            if( thisValue != "" ) {
                if( thisValue.match(ER_caracteresAlfaNumericos) && ( parseInt(thisValue.length) >= 1 && parseInt(thisValue.length) <= 150 ) ) {
                    thisElement.css("background-color", "white");
                } else {
                    thisElement.css("background-color", "white");
                    flag = false;
                }
            } else {
                thisElement.css("background-color", "white");
                // flag = false;
            }       
                   
        }); 


    }              

    // Aplicando validación solamente si el campo es visible:
    if($("#af_ingreso_nucleo_familiar").is(":visible")) {

        let af_ingreso_nucleo_familiar = $("#af_ingreso_nucleo_familiar").val();
        if( af_ingreso_nucleo_familiar != "" ) {
            if( af_ingreso_nucleo_familiar.match(ER_caracteresAlfaNumericos) && ( parseInt(af_ingreso_nucleo_familiar.length) >= 1 ) ) {      
                $("#af_ingreso_nucleo_familiar").css("background-color", "white");
            } else {
                $("#af_ingreso_nucleo_familiar").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#af_ingreso_nucleo_familiar").css("background-color", "#fff");
            // flag = false;
        }

    }
    
    // Aplicando validación solamente si el campo es visible:
    if($("#af_indep_economica").is(":visible")) {

        let af_indep_economica = $("#af_indep_economica").val();
        if( af_indep_economica == "" ) {
            $("#af_indep_economica").css("background-color", "white");
            // flag = false;
        } else {
            $("#af_indep_economica").css("background-color", "white");
        }  

    }     

    // Aplicando validación solamente si el campo es visible:
    if($("#af_situacion_conyugal_padres").is(":visible")) {

        let af_situacion_conyugal_padres = $("#af_situacion_conyugal_padres").val();
        if( af_situacion_conyugal_padres == "" ) {
            $("#af_situacion_conyugal_padres").css("background-color", "white");
            // flag = false;
        } else {
            $("#af_situacion_conyugal_padres").css("background-color", "white");
        }  

    }         

    // Aplicando validación solamente si el campo es visible:
    if($("#af_num_hermanos").is(":visible")) {

        let af_num_hermanos = $("#af_num_hermanos").val();
        if( af_num_hermanos != "" ) {
            if( af_num_hermanos.match(ER_numericosEnteros) && ( parseInt(af_num_hermanos.length) >= 1 && parseInt(af_num_hermanos.length) <= 2 ) ) {      
                $("#af_num_hermanos").css("background-color", "white");
            } else {
                $("#af_num_hermanos").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#af_num_hermanos").css("background-color", "white");
            // flag = false;
        }      

    }    

    if($("#af_info_grupo_familiar").is(":visible")) {

        let af_info_grupo_familiar = $("#af_info_grupo_familiar").val();
        if( af_info_grupo_familiar != "" ) {
            if( af_info_grupo_familiar.match(ER_caracteresAlfaNumericos) && ( parseInt(af_info_grupo_familiar.length) >= 1 ) ) {      
                $("#af_info_grupo_familiar").css("background-color", "white");
            } else {
                $("#af_info_grupo_familiar").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#af_info_grupo_familiar").css("background-color", "#fff");
            // flag = false;
        }  

    } 
    
    if($("#af_valoracion_text").is(":visible")) {

        let af_valoracion_text = $("#af_valoracion_text").val();
        if( af_valoracion_text != "" ) {
            if( af_valoracion_text.match(ER_caracteresAlfaNumericos) && ( parseInt(af_valoracion_text.length) >= 1 ) ) {      
                $("#af_valoracion_text").css("background-color", "white");
            } else {
                $("#af_valoracion_text").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#af_valoracion_text").css("background-color", "#fff");
            // flag = false;
        }  

    }        

    // ---------------------------------------- RELACIONES PERSONALES---------------------------------------- //

    // Aplicando validación solamente si el campo es visible:
    if($("#rp_situacion_amorosa").is(":visible")) {

        let rp_situacion_amorosa = $("#rp_situacion_amorosa").val();
        if( rp_situacion_amorosa == "" ) {
            $("#rp_situacion_amorosa").css("background-color", "white");
            // flag = false;
        } else {
            $("#rp_situacion_amorosa").css("background-color", "white");
        }  

    } 

    // Aplicando validación solamente si el campo es visible:
    if($("#rp_hace_cuanto").is(":visible")) {

        let rp_hace_cuanto = $("#rp_hace_cuanto").val();
        if( rp_hace_cuanto != "" ) {
            if( rp_hace_cuanto.match(ER_caracteresAlfaNumericos) && ( parseInt(rp_hace_cuanto.length) >= 1 ) ) {      
                $("#rp_hace_cuanto").css("background-color", "white");
            } else {
                $("#rp_hace_cuanto").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#rp_hace_cuanto").css("background-color", "#fff");
            // flag = false;
        }  

    }    

    // Aplicando validación solamente si el campo es visible:
    if($("#rp_relacion_pareja").is(":visible")) {

        let rp_relacion_pareja = $("#rp_relacion_pareja").val();
        if( rp_relacion_pareja == "" ) {
            $("#rp_relacion_pareja").css("background-color", "white");
            // flag = false;
        } else {
            $("#rp_relacion_pareja").css("background-color", "white");
        }  

    } 

    // Aplicando validación solamente si el campo es visible:
    if($("#rp_inicio_vida_sexual").is(":visible")) {

        let rp_inicio_vida_sexual = $("#rp_inicio_vida_sexual").val();
        if( rp_inicio_vida_sexual == "" ) {
            $("#rp_inicio_vida_sexual").css("background-color", "white");
            // flag = false;
        } else {
            $("#rp_inicio_vida_sexual").css("background-color", "white");
        }  

    }     

    // Aplicando validación solamente si el campo es visible:
    if($("#rp_metodo_proteccion").is(":visible")) {

        let rp_metodo_proteccion = $("#rp_metodo_proteccion").val();
        if( rp_metodo_proteccion != "" ) {
            if( rp_metodo_proteccion.match(ER_caracteresAlfaNumericos) && ( parseInt(rp_metodo_proteccion.length) >= 1 ) ) {      
                $("#rp_metodo_proteccion").css("background-color", "white");
            } else {
                $("#rp_metodo_proteccion").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#rp_metodo_proteccion").css("background-color", "#fff");
            // flag = false;
        }  

    }

    // Aplicando validación solamente si el campo es visible:
    if($("#rp_tiene_hijos").is(":visible")) {

        let rp_tiene_hijos = $("#rp_tiene_hijos").val();
        if( rp_tiene_hijos == "" ) {
            $("#rp_tiene_hijos").css("background-color", "white");
            // flag = false;
        } else {
            $("#rp_tiene_hijos").css("background-color", "white");
        }  

    }      

    // Aplicando validación solamente si el campo es visible:
    if($("#rp_num_hijos").is(":visible")) {

        let rp_num_hijos = $("#rp_num_hijos").val();
        if( rp_num_hijos != "" ) {
            if( rp_num_hijos.match(ER_numericosEnteros) && ( parseInt(rp_num_hijos.length) >= 1 && parseInt(rp_num_hijos.length) <= 2 ) ) {      
                $("#rp_num_hijos").css("background-color", "white");
            } else {
                $("#rp_num_hijos").css("background-color", "white");
                flag = false;
            }
        } else {
            $("#rp_num_hijos").css("background-color", "white");
            // flag = false;
        }      

    }    

    // Aplicando validación solamente si el campo es visible:
    if($("#tabla_personas_viven_conjug").is(":visible")) {

        // --------------------------------- // 
        $("input[name='array_edadhijo_jugador[]']").each(function(){
            let thisElement = $(this);
            let thisValue = $(this).val();

            if( thisValue != "" ) {
                if( thisValue.match(ER_numericosEnteros) && ( parseInt(thisValue.length) >= 1 && parseInt(thisValue.length) <= 2 ) ) {      
                    thisElement.css("background-color", "white");
                } else {
                    thisElement.css("background-color", "white");
                    flag = false;
                }
            } else {
                thisElement.css("background-color", "white");
                // flag = false;
            } 
                   
        });     

        $("input[name='array_vivecon_hijo_jugador[]']").each(function(){
            let thisElement = $(this);
            let thisValue = $(this).val();

            if( thisValue != "" ) {
                if( thisValue.match(ER_caracteresAlfaNumericos) && ( parseInt(thisValue.length) >= 1 && parseInt(thisValue.length) <= 150 ) ) {
                    thisElement.css("background-color", "white");
                } else {
                    thisElement.css("background-color", "white");
                    flag = false;
                }
            } else {
                thisElement.css("background-color", "white");
                // flag = false;
            }       
                   
        }); 

        $("input[name='array_tiempocon_hijo_jugador[]']").each(function(){
            let thisElement = $(this);
            let thisValue = $(this).val();

            if( thisValue != "" ) {
                if( thisValue.match(ER_caracteresAlfaNumericos) && ( parseInt(thisValue.length) >= 1 && parseInt(thisValue.length) <= 150 ) ) {
                    thisElement.css("background-color", "white");
                } else {
                    thisElement.css("background-color", "white");
                    flag = false;
                }
            } else {
                thisElement.css("background-color", "white");
                // flag = false;
            }       
                   
        }); 

    }              

    // Aplicando validación solamente si el campo es visible:
    if($("#rp_valoracion_text").is(":visible")) {

        let rp_valoracion_text = $("#rp_valoracion_text").val();
        if( rp_valoracion_text != "" ) {
            if( rp_valoracion_text.match(ER_caracteresAlfaNumericos) && ( parseInt(rp_valoracion_text.length) >= 1 ) ) {      
                $("#rp_valoracion_text").css("background-color", "white");
            } else {
                $("#rp_valoracion_text").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#rp_valoracion_text").css("background-color", "#fff");
            // flag = false;
        }  

    }

    // ------------------------------------- ALIMENTACIÓN ----------------------------------------------- //

    // Aplicando validación solamente si el campo es visible:
    if($("#a_costear_alimentacion").is(":visible")) {

        let a_costear_alimentacion = $("#a_costear_alimentacion").val();
        if( a_costear_alimentacion == "" ) {
            $("#a_costear_alimentacion").css("background-color", "white");
            // flag = false;
        } else {
            $("#a_costear_alimentacion").css("background-color", "white");
        }  

    } 

    // Aplicando validación solamente si el campo es visible:
    if($("#a_observaciones").is(":visible")) {

        let a_observaciones = $("#a_observaciones").val();
        if( a_observaciones != "" ) {
            if( a_observaciones.match(ER_caracteresAlfaNumericos) && ( parseInt(a_observaciones.length) >= 1 ) ) {      
                $("#a_observaciones").css("background-color", "white");
            } else {
                $("#a_observaciones").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#a_observaciones").css("background-color", "#fff");
            // flag = false;
        }  

    }

    // Aplicando validación solamente si el campo es visible:
    if($("#a_comidas_club").is(":visible")) {

        let a_comidas_club = $("#a_comidas_club").val();
        if( a_comidas_club == "" ) {
            $("#a_comidas_club").css("background-color", "white");
            // flag = false;
        } else {
            $("#a_comidas_club").css("background-color", "white");
        }  

    } 

    // Aplicando validación solamente si el campo es visible:
    if($("#a_comidas_diarias").is(":visible")) {

        let a_comidas_diarias = $("#a_comidas_diarias").val();
        if( a_comidas_diarias == "" ) {
            $("#a_comidas_diarias").css("background-color", "white");
            // flag = false;
        } else {
            $("#a_comidas_diarias").css("background-color", "white");
        }  

    }     

    // Aplicando validación solamente si el campo es visible:
    if($("#a_valoracion_text").is(":visible")) {

        let a_valoracion_text = $("#a_valoracion_text").val();
        if( a_valoracion_text != "" ) {
            if( a_valoracion_text.match(ER_caracteresAlfaNumericos) && ( parseInt(a_valoracion_text.length) >= 1 ) ) {      
                $("#a_valoracion_text").css("background-color", "white");
            } else {
                $("#a_valoracion_text").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#a_valoracion_text").css("background-color", "#fff");
            // flag = false;
        }  

    }

    // ------------------------------------- LOCOMOCIÓN ----------------------------------------------- //
        
    let array_llegada_club = $('input[name="array_llegada_club[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    // Validando que al menos un tipo de ayuda sea seleccionada:
    /*
    if ( array_llegada_club.length === 0 ) {
        flag = false;
    } 
    */     

    // ------------------ // 

    let array_medio_transporte_llegada = $('input[name="array_medio_transporte_llegada[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    // Validando que al menos un tipo de ayuda sea seleccionada:
    /*
    if ( array_medio_transporte_llegada.length === 0 ) {
        flag = false;
    } 
    */  

    // ------------------ // 

    let array_ida_club = $('input[name="array_ida_club[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    // Validando que al menos un tipo de ayuda sea seleccionada:
    /*
    if ( array_ida_club.length === 0 ) {
        flag = false;
    } 
    */    
    
    // ------------------ // 

    let array_medio_transporte_ida = $('input[name="array_medio_transporte_ida[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    // Validando que al menos un tipo de ayuda sea seleccionada:
    /*
    if ( array_medio_transporte_ida.length === 0 ) {
        flag = false;
    } 
    */                     
 
    // Aplicando validación solamente si el campo es visible:
    if($("#l_valoracion_text").is(":visible")) {

        let l_valoracion_text = $("#l_valoracion_text").val();
        if( l_valoracion_text != "" ) {
            if( l_valoracion_text.match(ER_caracteresAlfaNumericos) && ( parseInt(l_valoracion_text.length) >= 1 ) ) {      
                $("#l_valoracion_text").css("background-color", "white");
            } else {
                $("#l_valoracion_text").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#l_valoracion_text").css("background-color", "#fff");
            // flag = false;
        }  

    }


    // ------------------------------------- SALUD  ----------------------------------------------- //

    // Aplicando validación solamente si el campo es visible:
    if($("#s_consume_drogas").is(":visible")) {

        let s_consume_drogas = $("#s_consume_drogas").val();
        if( s_consume_drogas == "" ) {
            $("#s_consume_drogas").css("background-color", "white");
            // flag = false;
        } else {
            $("#s_consume_drogas").css("background-color", "white");
        }  

        // Aplicando validación solamente si la opción es 'Sí' (1):
        if( $('#s_consume_drogas').val() == '1' ) {

            let array_drogas_consumidas_jugador = $('input[name="array_drogas_consumidas_jugador[]"]:checked').map(function(){ 
                return this.value; 
            }).get();
            // Validando que al menos un tipo de ayuda sea seleccionada:
            /*
            if ( array_drogas_consumidas_jugador.length === 0 ) {
                flag = false;
            } 
            */      

            // ------------------ // 

            let s_frecuencia_consumo_drogas = $("#s_frecuencia_consumo_drogas").val();
            if( s_frecuencia_consumo_drogas != "" ) {
                if( s_frecuencia_consumo_drogas.match(ER_caracteresAlfaNumericos) && ( parseInt(s_frecuencia_consumo_drogas.length) >= 1 ) ) {      
                    $("#s_frecuencia_consumo_drogas").css("background-color", "white");
                } else {
                    $("#s_frecuencia_consumo_drogas").css("background-color", "#ffc6c6");
                    flag = false;
                }
            } else {
                $("#s_frecuencia_consumo_drogas").css("background-color", "#fff");
                // flag = false;
            }  

            // ------------------ // 

            let array_drogas_probadas_jugador = $('input[name="array_drogas_probadas_jugador[]"]:checked').map(function(){ 
                return this.value; 
            }).get();
            // Validando que al menos un tipo de ayuda sea seleccionada:
            /*
            if ( array_drogas_probadas_jugador.length === 0 ) {
                flag = false;
            } 
            */      

            // ------------------ //
            let array_drogas_consumidas_familiar = $('input[name="array_drogas_consumidas_familiar[]"]:checked').map(function(){ 
                return this.value; 
            }).get();
            // Validando que al menos un tipo de ayuda sea seleccionada:
            /*
            if ( array_drogas_consumidas_familiar.length === 0 ) {
                flag = false;
            } 
            */ 

        }

    } 

    // Aplicando validación solamente si el campo es visible:
    if($("#s_valoracion_text").is(":visible")) {

        let s_valoracion_text = $("#s_valoracion_text").val();
        if( s_valoracion_text != "" ) {
            if( s_valoracion_text.match(ER_caracteresAlfaNumericos) && ( parseInt(s_valoracion_text.length) >= 1 ) ) {      
                $("#s_valoracion_text").css("background-color", "white");
            } else {
                $("#s_valoracion_text").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#s_valoracion_text").css("background-color", "#fff");
            // flag = false;
        }  

    }    

    // ------------------------------------- ANTECEDENES JUDICIALES ----------------------------------------------- //

    // Aplicando validación solamente si el campo es visible:
    if($("#aj_jugador_tiene_antecedentes").is(":visible")) {

        let aj_jugador_tiene_antecedentes = $("#aj_jugador_tiene_antecedentes").val();
        if( aj_jugador_tiene_antecedentes == "" ) {
            $("#aj_jugador_tiene_antecedentes").css("background-color", "white");
            // flag = false;
        } else {
            $("#aj_jugador_tiene_antecedentes").css("background-color", "white");
        }  

    } 

    // Aplicando validación solamente si el campo es visible:
    if($("#aj_jugador_antecedentes").is(":visible")) {

        let aj_jugador_antecedentes = $("#aj_jugador_antecedentes").val();
        if( aj_jugador_antecedentes != "" ) {
            if( aj_jugador_antecedentes.match(ER_caracteresAlfaNumericos) && ( parseInt(aj_jugador_antecedentes.length) >= 1 ) ) {      
                $("#aj_jugador_antecedentes").css("background-color", "white");
            } else {
                $("#aj_jugador_antecedentes").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#aj_jugador_antecedentes").css("background-color", "#fff");
            // flag = false;
        }  

    }

    // Aplicando validación solamente si el campo es visible:
    if($("#aj_familiar_tiene_antecedentes").is(":visible")) {

        let aj_familiar_tiene_antecedentes = $("#aj_familiar_tiene_antecedentes").val();
        if( aj_familiar_tiene_antecedentes == "" ) {
            $("#aj_familiar_tiene_antecedentes").css("background-color", "white");
            // flag = false;
        } else {
            $("#aj_familiar_tiene_antecedentes").css("background-color", "white");
        }  

    } 

    // Aplicando validación solamente si el campo es visible:
    if($("#aj_familiar_antecedentes").is(":visible")) {

        let aj_familiar_antecedentes = $("#aj_familiar_antecedentes").val();
        if( aj_familiar_antecedentes != "" ) {
            if( aj_familiar_antecedentes.match(ER_caracteresAlfaNumericos) && ( parseInt(aj_familiar_antecedentes.length) >= 1 ) ) {      
                $("#aj_familiar_antecedentes").css("background-color", "white");
            } else {
                $("#aj_familiar_antecedentes").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#aj_familiar_antecedentes").css("background-color", "#fff");
            // flag = false;
        }  

    }  
    
    // Aplicando validación solamente si el campo es visible:
    if($("#aj_valoracion_text").is(":visible")) {

        let aj_valoracion_text = $("#aj_valoracion_text").val();
        if( aj_valoracion_text != "" ) {
            if( aj_valoracion_text.match(ER_caracteresAlfaNumericos) && ( parseInt(aj_valoracion_text.length) >= 1 ) ) {      
                $("#aj_valoracion_text").css("background-color", "white");
            } else {
                $("#aj_valoracion_text").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#aj_valoracion_text").css("background-color", "#fff");
            // flag = false;
        }  

    }        

    // ------------------------------------- OTROS DATOS ----------------------------------------------- //

    // Aplicando validación solamente si el campo es visible:
    if($("#od_tiene_seguro").is(":visible")) {

        let od_tiene_seguro = $("#od_tiene_seguro").val();
        if( od_tiene_seguro == "" ) {
            $("#od_tiene_seguro").css("background-color", "white");
            // flag = false;
        } else {
            $("#od_tiene_seguro").css("background-color", "white");
        }  

    } 

    // Aplicando validación solamente si el campo es visible:
    if($("#od_nombre_compania_seguro").is(":visible")) {

        let od_nombre_compania_seguro = $("#od_nombre_compania_seguro").val();
        if( od_nombre_compania_seguro != "" ) {
            if( od_nombre_compania_seguro.match(ER_caracteresAlfaNumericos) && ( parseInt(od_nombre_compania_seguro.length) >= 1 ) ) {      
                $("#od_nombre_compania_seguro").css("background-color", "white");
            } else {
                $("#od_nombre_compania_seguro").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_nombre_compania_seguro").css("background-color", "#fff");
            // flag = false;
        }  

    }    

    // Aplicando validación solamente si el campo es visible:
    if($("#od_seguro_vencimiento").is(":visible")) {

        let od_seguro_vencimiento = $("#od_seguro_vencimiento").val();
        if( od_seguro_vencimiento == "" ) {
            $("#od_seguro_vencimiento").css("background-color", "white");
            // flag = false;
        } else {
            $("#od_seguro_vencimiento").css("background-color", "white");
        }  

    }   
    
    // Aplicando validación solamente si el campo es visible:
    if($("#od_tiene_pasaporte").is(":visible")) {

        let od_tiene_pasaporte = $("#od_tiene_pasaporte").val();
        if( od_tiene_pasaporte == "" ) {
            $("#od_tiene_pasaporte").css("background-color", "white");
            // flag = false;
        } else {
            $("#od_tiene_pasaporte").css("background-color", "white");
        }  

    }         

    // Aplicando validación solamente si el campo es visible:
    if($("#od_num_pasaporte").is(":visible")) {

        let od_num_pasaporte = $("#od_num_pasaporte").val();
        if( od_num_pasaporte != "" ) {
            if( od_num_pasaporte.match(ER_caracteresAlfaNumericos) && ( parseInt(od_num_pasaporte.length) >= 1 ) ) {      
                $("#od_num_pasaporte").css("background-color", "white");
            } else {
                $("#od_num_pasaporte").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_num_pasaporte").css("background-color", "#fff");
            // flag = false;
        }  

    }

    // Aplicando validación solamente si el campo es visible:
    if($("#od_pasaporte_vencimiento").is(":visible")) {

        let od_pasaporte_vencimiento = $("#od_pasaporte_vencimiento").val();
        if( od_pasaporte_vencimiento == "" ) {
            $("#od_pasaporte_vencimiento").css("background-color", "white");
            // flag = false;
        } else {
            $("#od_pasaporte_vencimiento").css("background-color", "white");
        }  

    }     
    
    // Aplicando validación solamente si el campo es visible:
    if($("#od_vencimiento_carnetid").is(":visible")) {

        let od_vencimiento_carnetid = $("#od_vencimiento_carnetid").val();
        if( od_vencimiento_carnetid == "" ) {
            $("#od_vencimiento_carnetid").css("background-color", "white");
            // flag = false;
        } else {
            $("#od_vencimiento_carnetid").css("background-color", "white");
        }  

    }            

    // Aplicando validación solamente si el campo es visible:
    if($("#od_observaciones").is(":visible")) {

        let od_observaciones = $("#od_observaciones").val();
        if( od_observaciones != "" ) {
            if( od_observaciones.match(ER_caracteresAlfaNumericos) && ( parseInt(od_observaciones.length) >= 1 ) ) {      
                $("#od_observaciones").css("background-color", "white");
            } else {
                $("#od_observaciones").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_observaciones").css("background-color", "#fff");
            // flag = false;
        }  

    }

    // ------------------------------ PADRE ------------------------------ //

    // Aplicando validación solamente si el campo es visible:
    if($("#od_padre_nombre").is(":visible")) {

        let od_padre_nombre = $("#od_padre_nombre").val();
        if( od_padre_nombre != "" ) {
            if( od_padre_nombre.match(ER_caracteresAlfaNumericos) && ( parseInt(od_padre_nombre.length) >= 1 ) ) {      
                $("#od_padre_nombre").css("background-color", "white");
            } else {
                $("#od_padre_nombre").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_padre_nombre").css("background-color", "#fff");
            // flag = false;
        }  

    }

    // Aplicando validación solamente si el campo es visible:
    if($("#od_padre_apellido").is(":visible")) {

        let od_padre_apellido = $("#od_padre_apellido").val();
        if( od_padre_apellido != "" ) {
            if( od_padre_apellido.match(ER_caracteresAlfaNumericos) && ( parseInt(od_padre_apellido.length) >= 1 ) ) {      
                $("#od_padre_apellido").css("background-color", "white");
            } else {
                $("#od_padre_apellido").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_padre_apellido").css("background-color", "#fff");
            // flag = false;
        }  

    }

    // Aplicando validación solamente si el campo es visible:
    if($("#od_padre_telefono").is(":visible")) {

        let od_padre_telefono = $("#od_padre_telefono").val();
        if( od_padre_telefono != "" ) {
            if( od_padre_telefono.match(ER_caracteresAlfaNumericos) && ( parseInt(od_padre_telefono.length) >= 1 ) ) {      
                $("#od_padre_telefono").css("background-color", "white");
            } else {
                $("#od_padre_telefono").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_padre_telefono").css("background-color", "#fff");
            // flag = false;
        }  

    }

    // Aplicando validación solamente si el campo es visible:
    if($("#od_padre_correo").is(":visible")) {

        let od_padre_correo = $("#od_padre_correo").val();
        if( od_padre_correo != "" ) {
            if( od_padre_correo.match(ER_caracteresAlfaNumericos) && ( parseInt(od_padre_correo.length) >= 1 ) ) {      
                $("#od_padre_correo").css("background-color", "white");
            } else {
                $("#od_padre_correo").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_padre_correo").css("background-color", "#fff");
            // flag = false;
        }  

    } 

    // Aplicando validación solamente si el campo es visible:
    if($("#od_padre_tiene_discapacidad").is(":visible")) {

        let od_padre_tiene_discapacidad = $("#od_padre_tiene_discapacidad").val();
        if( od_padre_tiene_discapacidad == "" ) {
            $("#od_padre_tiene_discapacidad").css("background-color", "white");
            // flag = false;
        } else {
            $("#od_padre_tiene_discapacidad").css("background-color", "white");
        }  

    }        
    
    // Aplicando validación solamente si el campo es visible:
    if($("#od_padre_discapacidad").is(":visible")) {

        let od_padre_discapacidad = $("#od_padre_discapacidad").val();
        if( od_padre_discapacidad != "" ) {
            if( od_padre_discapacidad.match(ER_caracteresAlfaNumericos) && ( parseInt(od_padre_discapacidad.length) >= 1 ) ) {      
                $("#od_padre_discapacidad").css("background-color", "white");
            } else {
                $("#od_padre_discapacidad").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_padre_discapacidad").css("background-color", "#fff");
            // flag = false;
        }  

    }     

    // Aplicando validación solamente si el campo es visible:
    if($("#od_padre_comuna_residencia").is(":visible")) {

        let od_padre_comuna_residencia = $("#od_padre_comuna_residencia").val();
        if( od_padre_comuna_residencia == "" ) {
            $("#od_padre_comuna_residencia").css("background-color", "white");
            // flag = false;
        } else {
            $("#od_padre_comuna_residencia").css("background-color", "white");
        }  

    }

    // Aplicando validación solamente si el campo es visible:
    if($("#od_padre_trabaja").is(":visible")) {

        let od_padre_trabaja = $("#od_padre_trabaja").val();
        if( od_padre_trabaja == "" ) {
            $("#od_padre_trabaja").css("background-color", "white");
            // flag = false;
        } else {
            $("#od_padre_trabaja").css("background-color", "white");
        }  

    }     
                
    // Aplicando validación solamente si el campo es visible:
    if($("#od_padre_trabajo_nombre").is(":visible")) {

        let od_padre_trabajo_nombre = $("#od_padre_trabajo_nombre").val();
        if( od_padre_trabajo_nombre != "" ) {
            if( od_padre_trabajo_nombre.match(ER_caracteresAlfaNumericos) && ( parseInt(od_padre_trabajo_nombre.length) >= 1 ) ) {      
                $("#od_padre_trabajo_nombre").css("background-color", "white");
            } else {
                $("#od_padre_trabajo_nombre").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_padre_trabajo_nombre").css("background-color", "#fff");
            // flag = false;
        }  

    }  
    
    // Aplicando validación solamente si el campo es visible:
    if($("#od_padre_tiempo_cesante_jubilado").is(":visible")) {

        let od_padre_tiempo_cesante_jubilado = $("#od_padre_tiempo_cesante_jubilado").val();
        if( od_padre_tiempo_cesante_jubilado != "" ) {
            if( od_padre_tiempo_cesante_jubilado.match(ER_caracteresAlfaNumericos) && ( parseInt(od_padre_tiempo_cesante_jubilado.length) >= 1 ) ) {      
                $("#od_padre_tiempo_cesante_jubilado").css("background-color", "white");
            } else {
                $("#od_padre_tiempo_cesante_jubilado").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_padre_tiempo_cesante_jubilado").css("background-color", "#fff");
            // flag = false;
        }  

    } 

    // ------------------------------ MADRE ------------------------------ //                     

    // Aplicando validación solamente si el campo es visible:
    if($("#od_madre_nombre").is(":visible")) {

        let od_madre_nombre = $("#od_madre_nombre").val();
        if( od_madre_nombre != "" ) {
            if( od_madre_nombre.match(ER_caracteresAlfaNumericos) && ( parseInt(od_madre_nombre.length) >= 1 ) ) {      
                $("#od_madre_nombre").css("background-color", "white");
            } else {
                $("#od_madre_nombre").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_madre_nombre").css("background-color", "#fff");
            // flag = false;
        }  

    }

    // Aplicando validación solamente si el campo es visible:
    if($("#od_madre_apellido").is(":visible")) {

        let od_madre_apellido = $("#od_madre_apellido").val();
        if( od_madre_apellido != "" ) {
            if( od_madre_apellido.match(ER_caracteresAlfaNumericos) && ( parseInt(od_madre_apellido.length) >= 1 ) ) {      
                $("#od_madre_apellido").css("background-color", "white");
            } else {
                $("#od_madre_apellido").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_madre_apellido").css("background-color", "#fff");
            // flag = false;
        }  

    }

    // Aplicando validación solamente si el campo es visible:
    if($("#od_madre_telefono").is(":visible")) {

        let od_madre_telefono = $("#od_madre_telefono").val();
        if( od_madre_telefono != "" ) {
            if( od_madre_telefono.match(ER_caracteresAlfaNumericos) && ( parseInt(od_madre_telefono.length) >= 1 ) ) {      
                $("#od_madre_telefono").css("background-color", "white");
            } else {
                $("#od_madre_telefono").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_madre_telefono").css("background-color", "#fff");
            // flag = false;
        }  

    }

    // Aplicando validación solamente si el campo es visible:
    if($("#od_madre_correo").is(":visible")) {

        let od_madre_correo = $("#od_madre_correo").val();
        if( od_madre_correo != "" ) {
            if( od_madre_correo.match(ER_caracteresAlfaNumericos) && ( parseInt(od_madre_correo.length) >= 1 ) ) {      
                $("#od_madre_correo").css("background-color", "white");
            } else {
                $("#od_madre_correo").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_madre_correo").css("background-color", "#fff");
            // flag = false;
        }  

    } 

    // Aplicando validación solamente si el campo es visible:
    if($("#od_madre_tiene_discapacidad").is(":visible")) {

        let od_madre_tiene_discapacidad = $("#od_madre_tiene_discapacidad").val();
        if( od_madre_tiene_discapacidad == "" ) {
            $("#od_madre_tiene_discapacidad").css("background-color", "white");
            // flag = false;
        } else {
            $("#od_madre_tiene_discapacidad").css("background-color", "white");
        }  

    }        
    
    // Aplicando validación solamente si el campo es visible:
    if($("#od_madre_discapacidad").is(":visible")) {

        let od_madre_discapacidad = $("#od_madre_discapacidad").val();
        if( od_madre_discapacidad != "" ) {
            if( od_madre_discapacidad.match(ER_caracteresAlfaNumericos) && ( parseInt(od_madre_discapacidad.length) >= 1 ) ) {      
                $("#od_madre_discapacidad").css("background-color", "white");
            } else {
                $("#od_madre_discapacidad").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_madre_discapacidad").css("background-color", "#fff");
            // flag = false;
        }  

    }     

    // Aplicando validación solamente si el campo es visible:
    if($("#od_madre_comuna_residencia").is(":visible")) {

        let od_madre_comuna_residencia = $("#od_madre_comuna_residencia").val();
        if( od_madre_comuna_residencia == "" ) {
            $("#od_madre_comuna_residencia").css("background-color", "white");
            // flag = false;
        } else {
            $("#od_madre_comuna_residencia").css("background-color", "white");
        }  

    }

    // Aplicando validación solamente si el campo es visible:
    if($("#od_madre_trabaja").is(":visible")) {

        let od_madre_trabaja = $("#od_madre_trabaja").val();
        if( od_madre_trabaja == "" ) {
            $("#od_madre_trabaja").css("background-color", "white");
            // flag = false;
        } else {
            $("#od_madre_trabaja").css("background-color", "white");
        }  

    }     
                
    // Aplicando validación solamente si el campo es visible:
    if($("#od_madre_trabajo_nombre").is(":visible")) {

        let od_madre_trabajo_nombre = $("#od_madre_trabajo_nombre").val();
        if( od_madre_trabajo_nombre != "" ) {
            if( od_madre_trabajo_nombre.match(ER_caracteresAlfaNumericos) && ( parseInt(od_madre_trabajo_nombre.length) >= 1 ) ) {      
                $("#od_madre_trabajo_nombre").css("background-color", "white");
            } else {
                $("#od_madre_trabajo_nombre").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_madre_trabajo_nombre").css("background-color", "#fff");
            // flag = false;
        }  

    }  
    
    // Aplicando validación solamente si el campo es visible:
    if($("#od_madre_tiempo_cesante_jubilado").is(":visible")) {

        let od_madre_tiempo_cesante_jubilado = $("#od_madre_tiempo_cesante_jubilado").val();
        if( od_madre_tiempo_cesante_jubilado != "" ) {
            if( od_madre_tiempo_cesante_jubilado.match(ER_caracteresAlfaNumericos) && ( parseInt(od_madre_tiempo_cesante_jubilado.length) >= 1 ) ) {      
                $("#od_madre_tiempo_cesante_jubilado").css("background-color", "white");
            } else {
                $("#od_madre_tiempo_cesante_jubilado").css("background-color", "#ffc6c6");
                flag = false;
            }
        } else {
            $("#od_madre_tiempo_cesante_jubilado").css("background-color", "#fff");
            // flag = false;
        }  

    }

    // ------------------------------------- HABILITANDO/DESHABILITANDO EL BOTÓN DE GUARDAR ----------------------------------------------- //
    if( flag === false ){
        $('#boton_agregar_informe_carga').prop("disabled", true);
    }else{
        $('#boton_agregar_informe_carga').prop("disabled", false);
        // alert("Formulario validado");
    }

}



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

    buscador();
    mostrar_al_cargar_pagina();

    // ---------------- AGREGANDO DATOS DE ARRAYS A SELECTS ------------------------ //

    agregar_comuna_select(); // <--- Comuna    
    agregar_parentesco_select( 1 ); // <--- Parentesco
    agregar_situacion_conyugal_padres_select(); // <--- Situación conyugal de padres
    agregar_situacion_amorosa_select(); // <--- Situación amorosa
    // agregar_relacion_pareja_select(); // <--- Relación en pareja
    agregar_coste_alimentacion_select(); // <--- Coste de Alimentación

// Agregando placeholer a todos los inputs de tipo fecha:
$('.date_fechaNacimiento').each(function(){
    let thisElement = $(this);
    thisElement.attr('placeholder', 'Click aquí');
});

// Evitando que se oculte el ul al hacer click en un option:
$(document).on('click', '.option', function(e) { 
    e.stopPropagation();
});

// Evitando que se oculte el ul al hacer click en un option:
$(document).on('change', '.input_checkbox_todos', function() {

    let input_marcar_todos = $(this);

    $(this).closest('ul').find('li input[type="checkbox"]').each(function(){

        if (input_marcar_todos.prop('checked')) {
            $(this).prop('checked', true);
        } else {
            $(this).prop('checked', false);
        }

        
    });
});


// ---------------------------------------------- //
$(document).on('change', '.input_otro_checkbox', function() {
    $(this).closest('ul').find('.li_input_text_otro').toggle();
});

// ---------------------------------------------- //
$(document).on('change','input[type="checkbox"]', function(){
   
     // CALCULAMOS CUANTOS ELEMENTOS HAY SELECCIONADOS
    let numero_select = 0;
    let nombre_option = '';

    $(this).closest('ul').find('input[type="checkbox"]').each(function () {

        if ($(this).prop('checked')) {
            nombre_option = $(this).closest('label').find(".label_s").html();
            numero_select++;
            //alert( nombre_option );
        }
    });
    
    let tipo_ul = $(this).closest('ul').attr('tipo-ul');

    // ESTABLECEMOS EL TITULO DEL BOTON
    // SI NO HAY NINGUNO COLOCAMOS EL QUE TRAE POR DEFAULT.
    if (numero_select == 0) {

        switch( tipo_ul ) {

            case 'ul_llegada_club':
                tipo_ul = 'Seleccione formas de llegar al club';
                break;

            case 'ul_ida_club':
                tipo_ul = 'Seleccione formas de irse del club';
                break;                

            case 'ul_medio_transporte':
                tipo_ul = 'Seleccione medios de transporte';
                break;

            case 'ul_drogas':
                tipo_ul = 'Seleccione drogas';
                break;                                

        }

        descripcion = tipo_ul;
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