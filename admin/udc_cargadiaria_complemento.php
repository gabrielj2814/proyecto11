<?php
    include('../config/datos.php');
    session_start();
    if(!(isset($_SESSION["nombre_usuario_software"]))){
        session_destroy();
        header('Location: ../index.php?cerrar_sesion=1');
    }else{

        include('../bd/udc_cargadiaria_complemento_BD.php');
        $menu_actual="udc";
        $submenu_actual="udc_cargadiaria_complemento";
        $seccion_comentarios = $comentarios['udc_cargadiaria_complemento'];//mis cuotas
        $demo_seccion = $demo['udc_cargadiaria_complemento'];
        $nombre_pestana_navegador='Carga Diaria - Complemento';
        
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
<title><?php echo $nombre_pestana_navegador;?> | Carga Diaria - Complemento</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-responsive.min.css" />
<link rel="stylesheet" href="css/bootstrap-select.min.css" />
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

#selecciones_cajas {
    margin-left: 5%;
    width: 97%;
}

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

#tabla_ver_informes_todos tbody tr {
    text-align: center;
    font-size: 11px;
}

#tabla_ver_informes_todos thead tr {
    text-align: center;
    font-size: 14px;
}

.celdas-carga-diaria{
    text-align: center;
    border: 3px #a89f9f solid;
    padding: 0px;
}


#tabla_ver_perfil_jugador {

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
    background-image: url(../config/img_udc_3.png);
    background-repeat: no-repeat;
    background-position: center;
    background-size: 30% 150px;
    width: 100%;
    -webkit-appearance: none;
    -moz-appearance: none;
    border: 2px solid #9e9e9ee0;
    border-radius: 6px;
    margin-bottom: 0px;
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

#boton_agregar_informe_carga:enabled {
    cursor: pointer;
}

#boton_agregar_informe_carga:disabled {
    cursor: no-drop;
}

.categoria-0 {
    background-color: #3f51b5;
    color: white;
}

.categoria-1 {
    background-color: #8bc34a;
    color: black;
}

.categoria-2 {
    background-color: #ffd007d6;
    color: black;
}

.categoria-3 {
    background-color: #ffd007e6;
    color: black;
}

.categoria-4 {
    background-color: #ffd007;
    color: black;
}

.categoria-5 {
    background-color: #ffb0cb;
    color: black;
}

.categoria-6 {
    background-color: #ff6a5f;
    color: black;
}

.categoria-7 {
    background-color: #bd0d00;
    color: white;
}
 

.td-title {
    color: black;
    font-weight: bold;
    text-transform: uppercase;
    font-style: 16px;
}

.datos-jugador-small {
    margin-top: 0px; 
    color: white; 
    padding: 10px 0px 0px 50px; 
    font-size: 12px;
    position: relative;
    right: 10px;    
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

.mytooltip {
  position: relative;
  /*display: inline-block;*/
}

.mytooltip .mytext {
    font-size: 11px;
    visibility: hidden;
    position: absolute;
    display: inline-block;
    transform: translate(-50%, -50%) scale(0.75) rotate(5deg);
    transform-origin: bottom center;
    /* padding: 10px 30px; */
    padding: 3px;
    top: 1%;
    border-radius: 5px;
    background: rgba(0, 0, 0, 0.75);
    text-align: center;
    color: white;
    font-weight: bold;
    transition: 0.15s ease-in-out;
    opacity: 0;
    /* max-width: 200px; */
    width: 180px;
    /* pointer-events: none; */
    cursor: pointer;
    z-index: 99999;
}

.mytooltip .mytext.categoria-0 {
    background-color: #3f51b5;
    color: white;
}
.mytooltip .mytext.categoria-0:after {
  border-top: 5px solid #3498DB;
}
/* ---------------------------- */
.mytooltip .mytext.categoria-1 {
    background-color: #8bc34a;
    color: black;
}
.mytooltip .mytext.categoria-1:after {
  border-top: 5px solid #eb6532;
}
/* ---------------------------- */
.mytooltip .mytext.categoria-2 {
    background-color: #ffd007d6;
    color: black;
}
.mytooltip .mytext.categoria-2:after {
  border-top: 5px solid #eb6532;
}
/* ---------------------------- */
.mytooltip .mytext.categoria-3 {
    background-color: #ffd007e6;
    color: black;
}
.mytooltip .mytext.categoria-3:after {
  border-top: 5px solid #eb6532;
}
/* ---------------------------- */
.mytooltip .mytext.categoria-4 {
    background-color: #ffd007;
    color: black;
}
.mytooltip .mytext.categoria-4:after {
  border-top: 5px solid #eb6532;
}
/* ---------------------------- */
.mytooltip .mytext.categoria-5 {
    background-color: #ffb0cb;
    color: black;
}
.mytooltip .mytext.categoria-5:after {
  border-top: 5px solid #eb6532;
}
/* ---------------------------- */
.mytooltip .mytext.categoria-6 {
    background-color: #ff6a5f;
    color: black;
}
.mytooltip .mytext.categoria-6:after {
  border-top: 5px solid #eb6532;
}
/* ---------------------------- */
.mytooltip .mytext.categoria-7 {
    background-color: #bd0d00;
    color: white;
}
.mytooltip .mytext.categoria-7:after {
  border-top: 5px solid #eb6532;
}
/* ---------------------------- */

.mytooltip .mytext::after{
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: black transparent transparent transparent;
}

.mytooltip:hover .mytext {
  visibility: visible;
  opacity: 1;
  transform: translate(-50%, -100%) scale(1) rotate(0deg);
  pointer-events: inherit;
}

.td-wg-even {
    background-color: #e6e5e5;
}
.td-wg-odd {
    background-color: white;
}

/*
.dropdown-menu li a.selected, .dropdown-menu .active a, .dropdown-menu .active a.selected {
    color: white;
    background: red;
}
*/

#tabla_partidos thead tr th div {
    padding: 5px;
}

#tabla_peso_diario tbody tr td {
    background-color: #dfdfdf;
}

.img-bandera-tabla {
    border-radius: 2px;
    width: 25px;
    height: 18px;
}

.img-next-to-text {
    float:left;
    display:block;
    position:relative;
    width:20%;
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

.highcharts-credits {
    display: none;
}

.bootstrap-select>.dropdown-toggle {
    border: 2px solid #595959;
}

.highcharts-range-selector-buttons {
    display: none;   
}

.titulo-tabla {
    color: black;
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

<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/data.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>
<script src="https://code.highcharts.com/stock/modules/export-data.js"></script>

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

<script src="js/bootstrap-select.min.js"></script> 
<script type="text/javascript">



var id_jugador = "";
var idudc_cargadiaria_proyecto = "";
var idudc_cargadiaria_sesion = "";
var num_cargadiaria_sesion = "";
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
var datos_cargadiaria_proyecto = {};
var datos_cargadiaria_sesion = {};


var ano_actual = '<?php echo $ano_actual;?>';
var mes_actual = parseInt('<?php echo $mes_actual;?>');
var seriesV2 = <?php echo json_encode($series); ?>;

// Array de Países:
// El penúltimo elemento de cada array representa el tipo de país.
// El último elemento de cada array representa el gentilicio.
var array_paises = [
    [0, 'Todos', ''],
    [1, 'Chile', 'chile.png', 1, 'Chileno'],
    [2, 'Argentina', 'argentina.png', 1, 'Argentino'],
    [3, 'Venezuela', 'venezuela.png', 1, 'Venezolano'],
    [4, 'Brasil', 'brasil.png', 1, 'Brasileño'],
    [5, 'Colombia', 'colombia.png', 1, 'Colombiano'],
    [6, 'Ecuador', 'ecuador.png', 1, 'Ecuatoriano'],
    [7, 'Uruguay', 'uruguay.png', 1, 'Uruguayo'],
    [8, 'Perú', 'peru.png', 1, 'Peruano'],
    [9, 'Paraguay', 'paraguay.png', 'Paraguayo'],
    [10, 'México', 'mexico.png', 1, 'Mexicano'],
    [11, 'España', 'espana.png', 2, 'Español'],
    [12, 'Inglaterra', 'inglaterra.png', 2, 'Inglés'],
    [13, 'Alemania', 'alemania.png', 2, 'Alemán'],
    [14, 'China', 'china.png', 2, 'Chino'],
    [15, 'Bélgica', 'belgica.png', 2, 'Belga'],
    [16, 'Bolivia', 'bolivia.png', 2, 'Boliviano'],
    [17, 'Costa Rica', 'costa_rica.png', 2, 'Costarricense'],
    [18, 'Estados Unidos', 'estados_unidos.png', 2, 'Estadounidense'],
    [19, 'Honduras', 'honduras.png', 2, 'Hondureño'],
    [20, 'El Salvador', 'el_salvador.png', 2, 'Salvadoreño'],
    [21, 'Escocia', 'escocia.png', 2, 'Escocés'],
    [22, 'Francia', 'francia.png', 2, 'Francés'],
    [23, 'Grecia', 'grecia.png', 2, 'Griego'],
    [24, 'Holanda', 'holanda.png', 2, 'Holandés'],
    [25, 'Italia', 'italia.png', 2, 'Italiano'],
    [26, 'Japón', 'japon.png', 2, 'Japonés'],
    [27, 'Portugal', 'portugal.png', 2, 'Portugués'],
    [28, 'Rusia', 'rusia.png', 2, 'Ruso'],
    [29, 'Turquía', 'turquia.png', 2, 'Turco'],
];

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


var array_categorias = [
    'Descanso, Ausente o Lesión',
    'Suave, carga ligera',
    'Regular, Descarga, Readaptador 1',
    'Regular, Regenerativo, Readaptador 2, Suplente sin jugar',
    'Regular +, Contracciones en velocidad, Carga Mixta, Readaptador 3',
    'Fuerte, Contracciones en Tensión, Readaptador Alta',
    'Muy Fuerte, Contracciones en duración',
    'Partido'
];

// Array Posiciones:
var array_lateralidad = [
    [0, 'Todos'],
    [1, 'Derecho'],
    [2, 'Izquierdo'],
    [3, 'Ambidiestro'],
];

var array_iniciales_categorias = [
    'DAL',
    'SCL',
    'RDR1',
    'RRR2SSJ',
    'R+CEVCMR3',
    'FCETRA',
    'MFCED',
    'P'
];

var array_class_categorias = [
    'categoria-0',
    'categoria-1',
    'categoria-2',
    'categoria-3',
    'categoria-4',
    'categoria-5',
    'categoria-6',
    'categoria-7'
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
            Carga Diaria - Complemento
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
                    <h3 class="titulo_principal" style="text-transform: uppercase;">Carga Diaria - Complemento</h3>
                    <p style="margin: 0px;">En esta sección puedes visualizar las cargas diarias de los jugadores</p>                    
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
<div class="cuadro_buscar_titulo" style="margin-top: -10px;">

<table style="color: black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
                            <tbody><tr class="sin_fondo">
                                <td style="padding: 15px; text-align: center;">
                                    <img src="../config/logo_equipo.png" style="height: 90px;">
                                </td>

      <input class="sexo" type="hidden">
      <input class="numero_serie" type="hidden">
      <input class="tecnico" type="hidden">  

                                <td style="text-align: center;">
                                    <h3 class="titulo_principal" style="margin: 0px; line-height: 26px;">CARGAS DIARIAS - COMPLEMENTO</h3>
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
                            <button class="boton_volver" onclick="boton_volver_cuadro_listado_series();" style="float:left; margin:0px;">
                              <i class="icon-arrow-left"></i> volver
                            </button>
                          </div>  

                            <center>
                                <div style=" width:500px; margin-bottom:10px; display: inline-block;">
                                    <table border="0">
                                        <tr class="sin_fondo">
                                            <td style="width:330px; padding-left:40px;"><input class="ph-center" name="buscar_nombre" style="width:96%; background-color:white; border: 3px solid #555555; border-radius:20px; margin-bottom:0px;padding-left: 10px; height: 24px;" placeholder="Nombre del Jugador o Vacío para Ver Todos" maxlength="149" id="buscar_nombre" onkeyup="buscador();" onkeydown="buscador();" ></td>
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

                                <div class="span12" style="margin: 0px;">
                                    <table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_ver_informes_todos">
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
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 30%;">
                                                    <div class="tip-top" data-original-title="Nombre" style="width:100%;">NOMBRE</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;width: 113px;">
                                                    <div class="tip-top" data-original-title="RUT" style="width:100%;">RUT</div>
                                                </th>                                                
                                                <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                                    <div class="tip-top" data-original-title="Fecha de Nacimiento" style="width:100%;">F. NACIMIENTO</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;text-align: center; border-top-right-radius:5px;">
                                                    <div class="tip-top" data-original-title="Edad" style="width:100%;">EDAD</div>
                                                </th>
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
<div style="display:none; margin: -41px -30px 0px -20px;" id="cuadro_perfil_jugador_selected">

    <!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
    <div class="cuadro_buscar_titulo" style="background-image: url('../config/banner_4.PNG'); background-size: cover; height: 190px;     margin-top: -10px;">
        
        <div class="row-fluid">
            <div style="padding:0px; margin:0px; margin-top: -20px;">

                <div>
                    <div>
                        <div style="position: relative; width: 30px; top: 50px; left: 55px; height: 55px; background-color: white; transform: skew(170deg);"></div>        
                    </div>
                    <div style="position: relative; top: -15px;">
                        <div style="display: inline-block; position: relative; top: 5px;">
                            <h5 class="nombre-jugador" style="margin-top: 0px; color: white; padding: 0px 0px 0px 100px; font-size: 18px; line-height: 7px; text-transform: capitalize; font-weight: normal; display: inline-block;"></h5>
                            <h5 class="apellido-jugador" style="display: inline-block; top: 0px; color: white; font-size: 26px; line-height: 7px; text-transform: capitalize; font-weight: bold; position: relative; left: 5px; top: 2px;"></h5>                            
                        </div>
                        <!--
                        <img class="bandera-pais-jugador-banner" src="" style="width: 40px;height: 25px;position: relative;left: 15px;top: 1px;border-radius: 4px;">
                        -->
                        <h5 class="datos-jugador" style="margin-top: 0px; color: white; padding: 15px 0px 0px 100px; font-size: 14px; text-transform: capitalize; font-weight: normal; position: relative; top: -5px;"></h5>
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

                <input type="hidden" name="" class="idfichaJugador">
            </div>            
        </div>
         
        <div class="row-fluid" style="margin: 35px;">
            <input type="hidden" name="cantidad_total_sesiones" id="cantidad_total_sesiones">
            <center>
                <img src="" class="imagen-jugador" style="width: 150px; border-radius: 50%; border: solid 2px; height: 150px; margin-top: -315px; margin-right: 80px; border: 1px white solid; background-color: white;">
            </center>
            <button class="boton_volver" onclick="boton_volver_serie_selected_registro_cargas_diarias();" style="float:left; margin:0px;     position: relative; top: 30px;">
                <i class="icon-arrow-left"></i> volver
            </button>
        </div>
        <br/>
        

        <!-- <div style="width:100%; background-color: <?php echo $color_fondo; ?>; height:20px;"></div> -->
    </div>
    <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
    
    <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top: 0px; background: url('../config/img_udc_3.png') repeat center; background-size: 80%;">

                          <center>
                                <div style=" width:600px; margin-bottom:10px;">
                                  
                                     <table border="0">
                                        <tbody>
                                        <tr class="sin_fondo">
                                          <td style="width:330px; padding-left:40px;">
                                            <h5 style="text-align: center;">FILTRAR BÚSQUEDA</h5>
                                          </td>
                                        </tr>              
                                      </tbody></table>
                                      <br>
                                      <div class="span3" style="width: 45%;margin: 0px;margin-left: 20px;display: flex;">
                                        <a class="btn btn-md btn-primary" style="margin: 0px; width: 35%; border-bottom-left-radius: 2px; border-top-left-radius: 2px; margin-left: 0px; margin-right: 0px; margin-top: 0px; font-size: 13px; margin-bottom: 0px; background-color: #555555; text-transform: uppercase; font-weight: bold;"> 
                                          Año
                                        </a>
                                        <select style="background-color: white; margin: 0px; width: 65%; -webkit-appearance: none; -moz-appearance: none; border: 2px solid #595959; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: center; line-height: 16px;" name="anio" id="anio" onchange="buscador_anio_mes();" ></select>
                                      </div>
  
                                      <div class="span3" style="width: 45%;margin: 0px;margin-left: 20px;display: flex;">
                                        <a class="btn btn-md btn-primary" style="margin: 0px; width: 35%; border-bottom-left-radius: 2px; border-top-left-radius: 2px; margin-left: 0px; margin-right: 0px; margin-top: 0px; font-size: 13px; margin-bottom: 0px; background-color: #555555; text-transform: uppercase; font-weight: bold;"> 
                                          Mes
                                        </a>
                                        <select multiple class="selectpicker" title="Seleccione" style="background-color: white; margin: 0px; width: 65%; -webkit-appearance: none; -moz-appearance: none; border: 2px solid #595959; margin-left: 0px; margin-right: 0px; border-bottom-right-radius: 2px; border-top-right-radius: 2px; border-bottom-left-radius: 0px; border-top-left-radius: 0px; margin-bottom: 0px; text-align: left; line-height: 16px;" name="mes" id="mes" onchange="buscador_anio_mes();">
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
                                            <option value="0">Todos</option>
                                        </select>
                                      </div>
                                         
                                 </div>

                                       
                               </center>



        <div class="row-fluid" style="margin-top: 30px;">

            <div class="span12" style="margin: 0px;" id="edgar">

                <div style="margin: auto; height:20px; width: 100%;">
                    <center>
                    <img src="../config/cargando_buscar.gif" id="cargando_buscar_cargadiaria" style="display: none;">
                    <span style="color:#dc4e4e; display:none;" id="error_conexion_cargadiaria"><b>Error:</b> conexión a internet deficiente.</span>
                    <span style="color:<?php echo $color_fondo; ?>; display:none;" id="sin_resultados_cargadiaria">Busqueda sin resultados.</span>
                    </center>
                </div>

                <h5 class="titulo-tabla" style="text-align: center;">CARGA DIARIA</h5>

                <table style="width:95%; margin: auto;" id="tabla_ver_perfil_jugador">
                    <thead>
                        <tr style="">
                            <th class="celdas-carga-diaria" scope="col" style="cursor:pointer; padding:0px; width: 100px;">
                                <div class="tip-top" data-original-title="Mes" style="width:150px; text-align: left; text-indent: 20px;">MES</div>
                            </th>
                            <?php 
                            $contador = 1;
                            while( $contador <= 31 ) {
                            ?>
                            <th class="celdas-carga-diaria" scope="col" style="padding-top:5px; padding-bottom:5px; min-width:25px; width: 80px;">
                                <div class="tip-top" data-original-title="Mes" style="width:100%; ">
                                    <?php echo $contador; ?>
                                </div>
                            </th>
                            <?php
                            $contador++;  
                            }
                            ?>
                            <th scope="col" style="cursor:pointer; padding:0px; border-top-right-radius:5px; width:30px;" colspan="3"></th>                            
                        </tr>
                    </thead>
                                        
                    <tbody>
                        <tr>
                           <td class="celdas-carga-diaria" colspan="32">
                                Seleccione uno o más meses para mostrar datos
                           </td> 
                        </tr>
                    </tbody>
                                        
                    <tfoot>
                        <!--
                        <tr class="sin_fondo"><td colspan="8"><center><h5 style="color:#555555;"><i class="icon-file-alt"></i> Sin Jugadores</h5></center></td></tr>
                        -->
                        <tr style="">
                            <th scope="col" style="border-bottom-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;"></th>
                            <?php 
                            $contador = 1;
                            while( $contador <= 31 ) {
                            ?>
                            <th scope="col" style="cursor:pointer; padding:0px;">
                            </th>
                            <?php
                            $contador++;  
                            }
                            ?>
                            <th scope="col" style="cursor:pointer; padding:0px; border-bottom-right-radius:5px; "></th>
                        </tr>  
                    </tfoot>
                </table>
            </div>

            <div class="span12" style="margin: 0px;">

                <!-- ========================================== Inicio del id="formulario" ========================================== -->
                <!-- <form method="post" ng-model="formulario" name="formulario" id="formulario" novalidate> -->

                    
                    <!-- ************************* Gráficos ************************* --->
                    <div class="row-fluid" style="margin: 25px 30px;">
                        <div class="span12" id="span-container-carga-diaria" style="display: block; margin: auto;">
                            <div id="container-carga-diaria" style="height: 400px; width: 95%;"></div>
                        </div>    
                    </div>

            <div class="span12" style="margin: 0px;">

                <h5 class="titulo-tabla" style="text-align: center;">PESO DIARIO</h5>

                <table style="width:95%; margin: auto; border: 0px solid #8f8f8f;" id="tabla_peso_diario">
                    <thead>
                        <tr style="">
                            <th scope="col" class="celdas-carga-diaria" style="cursor:pointer; padding:0px; width: 100px;">
                                <div class="tip-top" data-original-title="Mes" style="width:100%; text-align: center;">MES</div>
                            </th>
                            <?php 
                            $contador = 1;
                            while( $contador <= 31 ) {
                            ?>
                            <th scope="col" class="celdas-carga-diaria" style="padding-top:5px; padding-bottom:5px; min-width:25px; width: 80px;">
                                <div class="tip-top" data-original-title="Mes" style="width:100%; ">
                                    <?php echo $contador; ?>
                                </div>
                            </th>
                            <?php
                            $contador++;  
                            }
                            ?>                           
                        </tr>
                    </thead>
                                        
                    <tbody>
                        <tr>
                           <td class="celdas-carga-diaria" colspan="32">
                                Seleccione uno o más meses para mostrar datos
                           </td> 
                        </tr>
                    </tbody>
                                        
                </table>
            </div>

                    <div class="row-fluid" style="margin: 25px 30px;">
                        <div class="span12" style="margin-top: 20px;">
                            <div id="container-evolucion-peso-jugador" style="height: 400px; width: 95%;"></div>
                        </div>
                    </div>


        <div class="span12" style="margin: 0px;">

                <h5 class="titulo-tabla" style="text-align: center;">LESIONES</h5>

                <table style="width:95%; margin: auto; border: 0px solid #8f8f8f;;" id="tabla_lesiones">
                    <thead>
                        <tr style="">
                            <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer; padding:0px; width: 100px;">
                                <div class="tip-top" data-original-title="Fecha de la lesión" style="width:100%; text-align: center;">FECHA LESIÓN</div>
                            </th>
                            <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer; padding:0px;">
                                <div class="tip-top" data-original-title="Patoligía" style="width:100%; text-align: center;">PATOLOGÍA</div>
                            </th>
                            <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer; padding:0px;">
                                <div class="tip-top" data-original-title="Mecanismo" style="width:100%; text-align: center;">MECANISMO</div>
                            </th>   
                            <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer; padding:0px;">
                                <div class="tip-top" data-original-title="Zona Afectada" style="width:100%; text-align: center;">ZONA AFECTADA</div>
                            </th>  
                            <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer; padding:0px;">
                                <div class="tip-top" data-original-title="Detalle de la zona afectada" style="width:100%; text-align: center;">DETALLE ZONA</div>
                            </th>                        
                            <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer; padding:0px;">
                                <div class="tip-top" data-original-title="Contexto" style="width:100%; text-align: center;">CONTEXTO</div>
                            </th>                         
                            <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer; padding:0px;">
                                <div class="tip-top" data-original-title="Gravedad" style="width:100%; text-align: center;">GRAVEDAD</div>
                            </th>                     
                            <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer; padding:0px;">
                                <div class="tip-top" data-original-title="Fecha de alta" style="width:100%; text-align: center;">FECHA ALTA</div>
                            </th>  
                            <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer; padding:0px; border-top-right-radius:5px;">
                                <div class="tip-top" data-original-title="Día de baja" style="width:100%; text-align: center;">DÍA DE BAJA</div>
                            </th>                                               
                        </tr>
                    </thead>
                                        
                    <tbody>
                        <tr>
                           <td class="celdas-carga-diaria" colspan="32">
                                Seleccione uno o más meses para mostrar datos
                           </td> 
                        </tr>
                    </tbody>
                                        
                </table>
            
        </div>
                


                    <div class="row-fluid" style="margin-top: 30px;">
                        <div class="span6">
                            <figure class="highcharts-figure">
                                <div id="dias-bajas-por-mes"></div>
                                <p class="highcharts-description">
                                   
                                </p>
                            </figure>                            
                        </div>
                        <div class="span6">
                            <figure class="highcharts-figure">
                                <div id="mecanismo-lesion"></div>
                                <p class="highcharts-description">
                                  
                                </p>
                            </figure>                             
                        </div>
                    </div>
                    

                    <div class="row-fluid" style="margin-top: 30px;">
                        <div class="span6">
                            <figure class="highcharts-figure">
                                <div id="dia-baja-patologia"></div>
                                <p class="highcharts-description">
                                    
                                </p>
                            </figure>                            
                        </div>
                        <div class="span6">
                            <figure class="highcharts-figure">
                                <div id="perfil-patologia-dias-baja"></div>
                                <p class="highcharts-description">
                                    
                                </p>
                            </figure>                               
                        </div>
                    </div>


        <div class="row-fluid" style="margin-top: 30px;">
            <div class="span12" style="margin: 0px;">

                    <h5 class="titulo-tabla" style="text-align: center;">PARTIDOS</h5>

                    <table style="width:95%; margin: auto; border: 0px solid #8f8f8f;" id="tabla_partidos">
                        <thead>
                            <tr style="">
                                <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer; padding:0px; width: 150px;">
                                    <div class="tip-top" data-original-title="Fecha del Partido" style="text-align: left; text-indent: 15px;">FECHA PARTIDO</div>
                                </th>
                                <th scope="col" class="celdas-carga-diaria" style="cursor:pointer; padding:0px;">
                                    <div style="width:100%; text-align: center;"></div>
                                </th>
                                <th scope="col" class="celdas-carga-diaria" style="cursor:pointer; padding:0px;">
                                    <div style="width:100%; text-align: center;"></div>
                                </th>   
                                <th scope="col" class="celdas-carga-diaria" style="cursor:pointer; padding:0px;">
                                    <div style="width:100%; text-align: center;"></div>
                                </th>  
                                <th scope="col" class="celdas-carga-diaria" style="cursor:pointer; padding:0px;">
                                    <div style="width:100%; text-align: center;"></div>
                                </th>                        
                                <th scope="col" class="celdas-carga-diaria" style="cursor:pointer; padding:0px;">
                                    <div style="width:100%; text-align: center;"></div>
                                </th>                         
                                <th scope="col" class="celdas-carga-diaria" style="cursor:pointer; padding:0px;">
                                    <div style="width:100%; text-align: center;"></div>
                                </th>                     
                                <th scope="col" class="celdas-carga-diaria" style="cursor:pointer; padding:0px;">
                                    <div style="width:100%; text-align: center;"></div>
                                </th>  
                                <th scope="col" class="celdas-carga-diaria" style="cursor:pointer; padding:0px; border-top-right-radius:5px;">
                                    <div style="width:100%; text-align: center;"></div>
                                </th>                                               
                            </tr>
                        </thead>
                                            
                        <tbody>
                            <?php 
                            $contador = 0;
                            $array_text = [
                                'RIVAL',
                                'CONDICIÓN',
                                'RESULTADO',
                                'CITACIÓN',
                                'INICIA COMO',
                                'INGRESA',
                                'SUSTITUIDO',
                                'MIN JUGADOS',
                                'GOLES',
                                'T.A <img src="../config/yellow-card.jpg" style="max-width: 100%;vertical-align: middle; border: 0;width: 20px; height: 20px;">',
                                'T.R <img src="../config/red-card.jpg" style="max-width: 100%;vertical-align: middle; border: 0;width: 20px; height: 20px;">',
                                'EVALUACIÓN',
                                '<span style="font-size: 10px; text-transform: none;">Entendimiento del juego<span>',
                                'Controles',
                                'Pases',
                                'Conducción',
                                'Remate',
                                'Juego Aéreo',
                                'Agresividad'
                            ];
                            while( $contador <= 18 ) {
                            $class_td_wg = "";
                            if( $contador % 2 === 1 ){
                                $class_td_wg = "td-wg-odd";
                            } else{
                                $class_td_wg = "td-wg-even";
                            }
                            ?>                   
                            <tr>
                                <td class="celdas-carga-diaria td-title <?php echo $class_td_wg; ?>" scope="col" style="cursor:pointer; padding:0px; text-indent: 15px; text-align: left; padding: 5px;"> 
                                    <?php echo $array_text[$contador]; ?>
                                </td>
                                <td class="celdas-carga-diaria"></td>
                                <td class="celdas-carga-diaria"></td>
                                <td class="celdas-carga-diaria"></td>
                                <td class="celdas-carga-diaria"></td>
                                <td class="celdas-carga-diaria"></td>
                                <td class="celdas-carga-diaria"></td>
                                <td class="celdas-carga-diaria"></td>
                                <td class="celdas-carga-diaria"></td>
                            </tr>        
                            <?php
                            $contador++;  
                            }
                            ?>                                          
                        </tbody>
                                            
                    </table>
                
            </div>                                   
        </div>
                                                     

        <div class="row-fluid" style="margin-top: 30px;">
            <div class="span12" style="margin: 0px;">

                    <h5 class="titulo-tabla" style="text-align: center;">PROYECTOS INDIVIDUALES DE OPTIMIZACIÓN  (PIO)</h5>

                    <div style="width: 97%;">
                        <button style="margin-bottom:10px; margin-top: 0px; float:right;" class="boton_informe_jugador" onclick="boton_agregar_proyecto();">
                            <b style="font-size:13px;"><i class="icon-plus"></i> NUEVO PROYECTO</b>
                        </button>
                    </div>  

                    <table style="width:95%; margin: auto; border: 0px solid #8f8f8f;" id="tabla_proyectos">
                        <thead>
                            <tr style="">
                                <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer; padding:4px; width: 100px;">
                                    <div class="tip-top" data-original-title="Fecha Inicio" style="width:120px; text-align: center;">
                                        FECHA INICIO
                                    </div>
                                </th>
                                <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer; padding:4px; width: 100px;">
                                    <div style="width:255px; text-align: center;">
                                        NOMBRE PROYECTO
                                    </div>
                                </th>
                                <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer; padding:4px;">
                                    <div style="width:250px; text-align: left; text-indent: 15px;">
                                        OBJETIVOS
                                    </div>
                                </th>       
                                <th scope="col" class="celdas-carga-diaria" style="cursor:pointer; padding:0px; border-top-right-radius:5px; width:140px;" colspan="2"></th>                                                                          
                            </tr>
                        </thead>
                                            
                        <tbody>                                 
                        </tbody>
                                            
                    </table>
                
            </div>            
        </div>

        <div class="row-fluid" style="margin-top: 30px;">
         
            <div class="span12" style="margin: 0px;">

                    <h5 class="titulo-tabla" style="text-align: center;">SESIONES DE TRABAJO</h5>

                    <div style="width: 97%;">
                        <button style="margin-bottom:10px; margin-top: 0px; float:right;" class="boton_informe_jugador" onclick="boton_agregar_sesion();">
                            <b style="font-size:13px;"><i class="icon-plus"></i> NUEVA SESIÓN</b>
                        </button> 
                    </div>  

                    <table style="width:95%; margin: auto; border: 0px solid #8f8f8f;" id="tabla_sesiones">
                        <thead>
                            <tr style="">
                                <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer; padding:0px; width: 150px;">
                                    <div class="tip-top" data-original-title="Fecha Inicio" style="width:100%; text-align: center;">
                                        PROYECTO
                                    </div>
                                </th>
                                <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer;padding:0px;width: 100px;">
                                    <div style="text-align: center;">
                                        SESIÓN
                                    </div>
                                </th>
                                <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer;padding:0px;width: 100px;">
                                    <div style="width: 130px;text-align: center; padding: 5px;">
                                        FECHA DE LA SESIÓN
                                    </div>
                                </th>
                                <th scope="col" class="celdas-carga-diaria td-title" style="cursor:pointer;padding:0px;">
                                    <div style="width: 200px; text-align: left; text-indent: 15px;">
                                        DETALLE SESIÓN
                                    </div>
                                </th>           
                                <th scope="col" colspan="2" class="celdas-carga-diaria" style="cursor:pointer; padding:0px;"></th>  

                            </tr>
                        </thead>
                                            
                        <tbody>                                 
                        </tbody>
                                            
                    </table>
                
            </div>             
        </div>       

                <!-- </form> -->        
                <!-- ========================================== Fin del id="formulario" ========================================== -->

            </div>

        </div>
    </div>      

</div>
<!-- ========================================== Fin del id="cuadro_perfil_jugador_selected" ========================================== -->
  
<div id="myModalDescargarBoleta" class="modal hide" style="border-radius:10px; z-index: 999999999 !important;">
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
          <center><button type="button" class="btn btn-default boton_modal" onclick="boton_cerrar_alerta_confirm_proyecto();" id="boton_cerrar_alerta_confirm_proyecto" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_registro_proyecto();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>  

<div id="myModalDescargarBoleta_2" class="modal hide" style="border-radius:10px; z-index: 999999999 !important;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
     <center>
            <br>
            <div id="mensaje_agregar_DescargarBoleta_2">
              <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" onclick="boton_cerrar_alerta_confirm_sesion();" id="boton_cerrar_alerta_confirm_sesion" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_registro_sesion();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
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

<div id="myModalEliminarProyecto" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_eliminar_proyecto" style="color:black;">
              <h5><i class="icon-spinner icon-spin icon-large"></i> Cargando informes del jugador...</h5>
              <br>
              <img src="../config/ver_archivo_jugador.png">
              </div>
           
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar_proyecto();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>



<div id="myModalEliminarSesion" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body">
     <center>
            <br>
            <div id="mensaje_eliminar_sesion" style="color:black;">
              <h5><i class="icon-spinner icon-spin icon-large"></i> Cargando informes del jugador...</h5>
              <br>
              <img src="../config/ver_archivo_jugador.png">
              </div>
           
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar_sesion();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
    </div>
</div>


<!-- INICIO DE MODAL PARA AGREGAR PROYECTOS -->
<div id="modal_agregar_proyecto" class="modal hide" style="border-radius: 30px 30px 0px 0px; width: 700px; height: 500px; background-color: #efefef;">

    <div class="modal-header" style="border-radius: 30px 30px 0px 0px; border: none;">
        <div>

            <center>
                <img src="../config/logo_equipo.png" style="width:75px; margin-top:5px;">
            </center>
        
            <center>
                <h3 style="color: black;">
                    NUEVO PROYECTO
                </h3>
            </center>


                <!-- ========================================== Inicio del id="formulario_guardar_proyecto" ========================================== -->
                <form method="post" ng-model="formulario" name="formulario_guardar_proyecto" id="formulario_guardar_proyecto" novalidate>
    
                <!-- ========================================== Inicio del id="tabla_guardar_proyecto" ========================================== -->
                    <table style="border: 0px solid #8f8f8f; width:100%; margin-top: 20px;" id="tabla_guardar_proyecto">
                                            
                        <input type="hidden" name="idfichaJugador" class="idfichaJugador">

                        <tbody>
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <td style="width: 100%; padding: 0px;">
                                    <div class="span12" style="display: flex; width: 100%;">
                                        <a class="btn btn-md btn-primary" style="width: 120px; border-bottom-left-radius:2px; border-top-left-radius:2px; font-size: 13px; background-color:#555555;height: 25px;"> NUEVO PROYECTO
                                        </a>
                                        <input onkeyup="chequear_datos_proyecto();" type="text" style="width:170px; -webkit-appearance: none; -moz-appearance : none; border: 3px solid #555555; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px; border-top-left-radius:0px; margin-bottom:0px; text-align:center; line-height: 16px; height: auto;" name="nombre_cargadiaria_proyecto" id="nombre_cargadiaria_proyecto" />

                                        <a class="btn btn-md btn-primary" style="width: 120px; border-bottom-left-radius:2px; border-top-left-radius:2px; font-size: 13px; background-color:#555557; margin-left:30px;"> FECHA DE INICIO
                                        </a>
                                        <input readonly class="date_fechaNacimiento" type="text" onchange="chequear_datos_proyecto();" style="width: 120px; -webkit-appearance: none; -moz-appearance : none; border: 3px solid #555555; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px; border-top-left-radius:0px; margin-bottom:0px; text-align:center; line-height: 16px; height: 21px; background-color: white;" name="fechainicio_cargadiaria_proyecto" id="fechainicio_cargadiaria_proyecto">                                    
                                    </div>
                                </td>                               
                            </tr> 
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <td style="width: 100%; padding: 0px;">
                                    <div class="span12" style="display: flex; width: 100%;">
                                        
                                    </div>
                                </td>                               
                            </tr> 
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <td style="width: 100%; padding: 0px;">
                                    <div class="span12" style="display: flex; width: 100%;">
                                        <textarea onkeyup="chequear_datos_proyecto();" style="resize: none;" class="textarea-social" name="objetivos_cargadiaria_proyecto" id="objetivos_cargadiaria_proyecto"></textarea>
                                    </div>
                                </td>                               
                            </tr>     
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:30px; padding-bottom:5px; width: 100%;">
                                    <center>
                                        <button type="submit" class="boton_gestionar_cargos" onclick="boton_guardar_proyecto();" id="boton_agregar_proyecto">
                                            <i class="icon-save"></i> GUARDAR PROYECTO
                                        </button>
                                    </center>
                                </td>
                            </tr>                                                                                     
                        </tbody>
                                            
                    </table>    

                </form>        
                <!-- ========================================== Fin del id="formulario_guardar_proyecto" ========================================== -->

        </div>
        <button type="button" class="close" data-dismiss="modal" style="margin-top: -2px;color: #fff">&times;</button>
    </div>
    
    
    <div class="modal-body">
        
    </div>


</div>
<!-- FIN DE MODAL PARA AGREGAR PROYECTOS -->


<!-- INICIO DE MODAL PARA AGREGAR SESIÓN -->
<div id="modal_agregar_sesion" class="modal hide" style="border-radius: 30px 30px 0px 0px; width: 700px; background-color: #efefef;">

    <div class="modal-header" style="border-radius: 30px 30px 0px 0px; border: none;">
        <div>

            <center>
                <img src="../config/logo_equipo.png" style="width:75px; margin-top:5px;">
            </center>
        
            <center>
                <h3 style="color: black;">
                    NUEVA SESIÓN
                </h3>
            </center>


                <!-- ========================================== Inicio del id="formulario_guardar_sesion" ========================================== -->
                <form method="post" ng-model="formulario" name="formulario_guardar_sesion" id="formulario_guardar_sesion" novalidate>
                    
                    
                    <center>
                        <div style="display: flex; margin-left: 150px;"> 
                            <a class="btn btn-md btn-primary" style="width: 130px; border-bottom-left-radius:2px; border-top-left-radius:2px; font-size: 13px; background-color:#555557; margin-left:30px; height: 22px;"> PROYECTO
                            </a>
                            <select onchange="chequear_datos_sesion();" type="text" style="width: 160px; -webkit-appearance: none; -moz-appearance : none; border: 3px solid #555555; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px; border-top-left-radius:0px; margin-bottom:0px; text-align:center; line-height: 16px; height: auto;" name="idudc_cargadiaria_proyecto" id="idudc_cargadiaria_proyecto"></select>
                        </div>
                    </center>                                    
        
                
                <!-- ========================================== Inicio del id="tabla_guardar_sesion" ========================================== -->
                    <table style="border: 0px solid #8f8f8f; width:100%; margin-top: 20px;" id="tabla_guardar_sesion">
                        
                        <input type="hidden" name="idfichaJugador" class="idfichaJugador">

                        <tbody>

                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                    <h5>AGREGAR NUEVA SESIÓN</h5>
                                </td>
                            </tr>                            
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <td style="width: 100%; padding: 0px;">
                                    <div class="span12" style="display: flex; width: 100%;">
                                        <a class="btn btn-md btn-primary" style="width: 120px; border-bottom-left-radius:2px; border-top-left-radius:2px; font-size: 13px; background-color:#555555; height: 24px;"> Nº DE SESIÓN
                                        </a>
                                        <input readonly type="text" style="width:60px; -webkit-appearance: none; -moz-appearance : none; border: 3px solid #555555; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px; border-top-left-radius:0px; margin-bottom:0px; text-align:center; line-height: 16px; height: 20px; background-color: white;" name="num_sesiones" id="num_sesiones">

                                        <a class="btn btn-md btn-primary" style="width: 130px; border-bottom-left-radius:2px; border-top-left-radius:2px; font-size: 13px; background-color:#555557; margin-left:30px; height: 24px;"> FECHA DE LA SESIÓN
                                        </a>
                                        <input readonly class="date_fechaNacimiento" type="text" onchange="chequear_datos_sesion();" style="width: auto; -webkit-appearance: none; -moz-appearance : none; border: 3px solid #555555; border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px; border-top-left-radius:0px; margin-bottom:0px; text-align:center; line-height: 16px; background-color: white;" name="fecha_cargadiaria_sesion" id="fecha_cargadiaria_sesion">                                    
                                    </div>
                                </td>                               
                            </tr> 
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <td style="width: 100%; padding: 0px;">
                                    <div class="span12" style="display: flex; width: 100%;">
                                        
                                    </div>
                                </td>                               
                            </tr> 
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <td style="width: 100%; padding: 0px;">
                                    <div class="span12" style="display: flex; width: 100%;">
                                        <textarea onkeyup="chequear_datos_sesion();" style="resize: none;" class="textarea-social" name="detalle_cargadiraria_sesion" id="detalle_cargadiraria_sesion"></textarea>
                                    </div>
                                </td>                               
                            </tr>     
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:30px; padding-bottom:5px; width: 100%;">
                                    <center>
                                        <button type="submit" class="boton_gestionar_cargos" onclick="boton_guardar_sesion();" id="boton_agregar_sesion">
                                            <i class="icon-save"></i> GUARDAR SESIÓN
                                        </button>
                                    </center>
                                </td>
                            </tr>                                                                                     
                        </tbody>
                                            
                    </table>    

                </form>        
                <!-- ========================================== Fin del id="formulario_guardar_sesion" ========================================== -->

        </div>
        <button type="button" class="close" data-dismiss="modal" style="margin-top: -2px;color: #fff">&times;</button>
    </div>
    
    
    <div class="modal-body">
        
    </div>


</div>
<!-- FIN DE MODAL PARA AGREGAR SESIÓN -->



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
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="guardar_registro_sesion();" ng-click="desactivarBotonAgregarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
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

$('.selectpicker').selectpicker({iconBase: 'icon', tickIcon: 'icon-check'});




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
    
    /*    
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
    */


    /*
    $('.radio-button').click(function() {
        alert( $(this).val() );
    });
    */

    // Añadiendo filas a todos los <textarea></textarea>
    $("textarea").each(function(){
        $(this).attr("placeholder", "Escriba aquí...");
        $(this).attr("rows", "10");
    });



function boton_agregar_proyecto() {
    window.idudc_cargadiaria_proyecto ='';
    $('#modal_agregar_proyecto').modal('show');
    $("#formulario_guardar_proyecto")[0].reset();
    $('#boton_agregar_proyecto').prop("disabled", true);

    let fecha_actual = "<?php echo date("Y-m-d"); ?>";  
    $("#fechainicio_cargadiaria_proyecto").val( fecha_actual );

}

// --------------------- Inicio de la función 'buscar_proyectos_todos()' --------------------- //
function buscar_proyectos_todos() {

    // Vaciando select:
    $("#idudc_cargadiaria_proyecto").empty();
    var idfichaJugador = $(".idfichaJugador").val();
    // alert( idfichaJugador );
    $.ajax({
        url: "post/udc_ver_cargadiaria_complemento.php",
        type: "post",
        dataType: 'json',
        cache: false,
        data: {
            'tipo_consulta': 'buscar_proyectos_todos',
            'idfichaJugador': idfichaJugador   
        },success: function(respuesta){

            if( respuesta== "" ) {
                console.log("No se encontró ningún proyecto...");
                $("#idudc_cargadiaria_proyecto").append('<option value="">No se encontraron proyectos</option>');
            } else {
                // Para los formularios (la primera opción es 'Seleccione')
                $("#idudc_cargadiaria_proyecto").append('<option value="">Seleccione</option>');
                for(var i=0; i < respuesta.length; i++) {   
                    $("#idudc_cargadiaria_proyecto").append('<option value="'+respuesta[i]['idudc_cargadiaria_proyecto']+'">'+respuesta[i]['nombre_cargadiaria_proyecto']+'</option>');
                }                
            }
            
        },error: function(){// will fire when timeout is reached
            console.log('Error al consultar proyectos...');
        }, timeout: 15000 // sets timeout to 3 seconds
    });     
}
// --------------------- Fin de la función 'buscar_proyectos_todos()' --------------------- //

function boton_agregar_sesion() {
    consultar_cantidad_sesiones(); // <--- Consultando la cantidad de sesiones
    buscar_proyectos_todos(); // <--- Consultando todos los proyectos ingresados.
    window.idudc_cargadiaria_sesion ='';
    $('#modal_agregar_sesion').modal('show');
    $("#formulario_guardar_sesion")[0].reset();
    $('#boton_agregar_sesion').prop("disabled", true);
    let fecha_actual = "<?php echo date("Y-m-d"); ?>";  
    $("#fecha_cargadiaria_sesion").val( fecha_actual );
}

    // -------------------- Inicio de la función 'buscar_proyectos_jugador_cargadiaria()' -------------------- // 
    function buscar_proyectos_jugador_cargadiaria(){
        $('#error_conexion').hide();
        $('#sin_resultados').hide();
        $('#cargando_buscar').show();
        $("#tabla_proyectos tbody").empty(); // <--- Vaciando tabla.
        var idfichaJugador = $(".idfichaJugador").val();

        $.ajax({
            url: "post/udc_ver_cargadiaria_complemento.php",
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
                    $("#tabla_proyectos tbody").empty();
                    var markup = '<tr class="celdas-carga-diaria" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td colspan="6"><center><b>Aún no tiene proyectos</b></center></td></tr>';
                    $("#tabla_proyectos tbody").append(markup);
                    $("#graficos_informes_resumen").hide();
                    $('#cargando_buscar').hide();
                    $('#sin_resultados').show();
                    $('#boton_editar').hide();
                    $('.boton_refresh').hide();
                    $('#boton_agregar_informe_carga').prop("disabled", true);
                }else{              
                    $('#boton_agregar_informe_carga').prop("disabled", false); // <--- Habilitando el botón de guardar.
                    window.datos_cargadiaria_proyecto = respuesta; //se copian todos los profesores al cache
                    $("#tabla_proyectos tbody").empty();
                    var count = 1;

                    for(var i=0; i < respuesta.length; i++){              

                        var markup = 
                        '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;">\
                            <td class="celdas-carga-diaria" onclick="boton_editar('+i+', 1, '+count+')" class="td-valoracion" style="text-align: center;">\
                                '+respuesta[i]['fechainicio_cargadiaria_proyecto']+'\
                            </td>\
                            <td class="celdas-carga-diaria" onclick="boton_editar('+i+', 1, '+count+')" class="td-valoracion" style="text-align: center;">\
                                '+respuesta[i]['nombre_cargadiaria_proyecto']+'\
                            </td>\
                            <td class="celdas-carga-diaria" onclick="boton_editar('+i+', 1, '+count+')" class="td-valoracion" style="text-align: left; text-indent: 15px;">\
                                '+respuesta[i]['objetivos_cargadiaria_proyecto']+'\
                            </td>\
                            <td class="celdas-carga-diaria" style="padding: 7px; width: 20px;">\
                                <a class="boton_editar" onClick="boton_editar('+i+', 1, '+count+');">\
                                    <i class="icon-pencil"></i>\
                                </a>\
                            </td>\
                            <td class="celdas-carga-diaria" style="padding: 7px; width: 20px;">\
                                <a class="boton_eliminar" onClick="boton_eliminar_registro_proyecto('+i+');">\
                                    <i class="icon-remove"></i>\
                                </a>\
                            </td>\
                        </tr>';
                        $("#tabla_proyectos tbody").append(markup);
                        count = count + 1;
                    }
                


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
    // -------------------- Fin de la función 'buscar_proyectos_jugador_cargadiaria()' -------------------- //

    // -------------------- Inicio de la función 'buscar_sesiones_jugador_cargadiaria()' -------------------- // 
    function buscar_sesiones_jugador_cargadiaria(){
        $('#error_conexion').hide();
        $('#sin_resultados').hide();
        $('#cargando_buscar').show();
        $("#tabla_sesiones tbody").empty(); // <--- Vaciando tabla.
        var idfichaJugador = $(".idfichaJugador").val();

        $.ajax({
            url: "post/udc_ver_cargadiaria_complemento.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
                'tipo_consulta': 5,
                'idfichaJugador': idfichaJugador
            },
            success: function(respuesta){
                // alert(JSON.stringify(respuesta));
                if(respuesta== ""){ //jugador sin informes
                    $("#tabla_sesiones tbody").empty();
                    var markup = '<tr class="celdas-carga-diaria" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td colspan="6"><center><b>Aún no tiene sesiones</b></center></td></tr>';
                    $("#tabla_sesiones tbody").append(markup);
                    $("#graficos_informes_resumen").hide();
                    $('#cargando_buscar').hide();
                    $('#sin_resultados').show();
                    $('#boton_editar').hide();
                    $('.boton_refresh').hide();
                    $('#boton_agregar_informe_carga').prop("disabled", true);
                }else{              
                    $('#boton_agregar_informe_carga').prop("disabled", false); // <--- Habilitando el botón de guardar.
                    window.datos_cargadiaria_sesion = respuesta; //se copian todos los profesores al cache
                    $("#tabla_sesiones tbody").empty();
                    var count = 1;

                    var cantidad_total_sesiones;
                    for(var i=0; i < respuesta.length; i++){              

                        cantidad_total_sesiones = respuesta[i]['cantidad_total_sesiones']; 

                        var markup = 
                        '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;">\
                            <td class="celdas-carga-diaria" onclick="boton_editar('+i+', 2, '+count+')" class="td-valoracion" style="text-align: center;">\
                                '+respuesta[i]['nombre_cargadiaria_proyecto']+'\
                            </td>\
                            <td class="celdas-carga-diaria" onclick="boton_editar('+i+', 2, '+count+')" class="td-valoracion" style="text-align: center;">\
                                '+count+'\
                            </td>\
                            <td class="celdas-carga-diaria" onclick="boton_editar('+i+', 2, '+count+')" class="td-valoracion" style="text-align: left; text-indent: 15px;">\
                                '+respuesta[i]['fecha_cargadiaria_sesion']+'\
                            </td>\
                            <td class="celdas-carga-diaria" onclick="boton_editar('+i+', 2, '+count+')" class="td-valoracion" style="text-align: left; text-indent: 15px;">\
                                '+respuesta[i]['detalle_cargadiraria_sesion']+'\
                            </td>\
                            <td class="celdas-carga-diaria" style="padding: 7px; width: 20px;">\
                                <a class="boton_editar" onClick="boton_editar('+i+', 2, '+count+');">\
                                    <i class="icon-pencil"></i>\
                                </a>\
                            </td>\
                            <td class="celdas-carga-diaria" style="padding: 7px; width: 20px;">\
                                <a class="boton_eliminar" onClick="boton_eliminar_registro_sesion('+i+');">\
                                    <i class="icon-remove"></i>\
                                </a>\
                            </td>\
                        </tr>';
                        $("#tabla_sesiones tbody").append(markup);
                        count++;
                    }
                
                    // alert( cantidad_total_sesiones );
                    $("#cantidad_total_sesiones").val( cantidad_total_sesiones );

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
    // -------------------- Fin de la función 'buscar_sesiones_jugador_cargadiaria()' -------------------- //

// -------------------------- Inicio de la función 'boton_ver_perfil_jugador()' - AGREGAR (INSERT) --------------------------- //
function boton_ver_perfil_jugador( linea ){

    var year = 2018;
    var current_year = "<?php echo $ano_actual; ?>";
    current_year = parseInt( current_year );   
    while( year <= current_year ) {
        $("#anio").append('<option value="'+year+'">'+year+'</option>');
        year++;
    }

    $("#anio option").each(function(){
        let thisElement = $(this);
        let thisValue = thisElement.val();
        // alert( current_month );
        thisValue = parseInt( thisValue );
        if( thisValue === current_year ) {
            thisElement.prop("selected", true);
        }
    });



    var current_month = "<?php echo date('m'); ?>";

    current_month = parseInt( current_month );
    $("#mes option").each(function(){
        let thisElement = $(this);
        let thisValue = thisElement.val();
        // alert( current_month );
        thisValue = parseInt( thisValue );
        if( thisValue === current_month ) {
            thisElement.prop("selected", true);
        }
    });

    $('.selectpicker').selectpicker('refresh');
    $('.selectpicker').selectpicker('toggle');
    // $('.bootstrap-select .dropdown-menu').css('display','block');


    window.idudc_cargadiaria_proyecto ='';

    // alert( idfichaJugador + ' - ' + nombre_completo_jugador + ' - ' + edad + ' - ' + posicion0 );
    $(".idfichaJugador").val( datos_visita_social[linea]['idfichaJugador'] );
    $(".nombre-jugador").html( datos_visita_social[linea]['nombre'] );    
    $(".apellido-jugador").html( datos_visita_social[linea]['apellido1'] + " " + datos_visita_social[linea]['apellido2'] );    

    // Posición:
    let posicion_principal;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_visita_social[linea]['posicion0'] === null || datos_visita_social[linea]['posicion0'] == '0' || datos_visita_social[linea]['posicion0'] == '' ) {
        posicion_principal = 'No especificado';
    } else {
        posicion_principal = parseInt( datos_visita_social[linea]['posicion0'] );
        posicion_principal = array_posiciones[posicion_principal][1];
    }

    // Bandera del país de la nacionalidad:
    let num_nacionalidad;
    let nacionalidad;
    /*
    let bandera_nacionalidad;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_visita_social[linea]['nacionalidad1'] === null || datos_visita_social[linea]['nacionalidad1'] == '0' || datos_visita_social[linea]['nacionalidad1'] == '' ) {
        num_nacionalidad = '';
        nacionalidad = 'No especificado';
        bandera_nacionalidad = 'default.png';
    } else {
        num_nacionalidad = parseInt( datos_visita_social[linea]['nacionalidad1'] );
        nacionalidad = array_paises[num_nacionalidad][4];       
        bandera_nacionalidad = array_paises[num_nacionalidad][2];       
    }
    $(".bandera-pais-jugador-banner").attr("src", "../config/" + bandera_nacionalidad );
    */

    // Altura (Header):
    let altura;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_visita_social[linea]['altura'] === null || datos_visita_social[linea]['altura'] == '0' || datos_visita_social[linea]['altura'] == '' ) {
        altura = '0 cm (no especificado)';
    } else {
        altura = datos_visita_social[linea]['altura'] + ' cm';
    }    

    // Edad:
    let edad;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_visita_social[linea]['fechaNacimiento'] === null || datos_visita_social[linea]['fechaNacimiento'] == '0000-00-00' || datos_visita_social[linea]['fechaNacimiento'] == '' ) {
        edad = '0 años (no especificado)';
    } else {
        edad = calcularEdad( datos_visita_social[linea]['fechaNacimiento'] ) + ' años';
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

    let datos_jugador = posicion_principal + ', ' + edad;

    $(".posicion").html( posicion_principal );

    let fechaNacimiento_ddmmaaa = fecha_formato_ddmmaaa( datos_visita_social[linea]['fechaNacimiento'] );
    let fecha_nacimiento_edad = '<b>'+fechaNacimiento_ddmmaaa+'</b>' + ' ('+edad+')';

    $('.estatura-banner').html( altura );
    $('.lateralidad-banner').html( dinamico );
    $('.edad-jugador-banner').html( fecha_nacimiento_edad );
    

    $(".datos-jugador").html( datos_jugador );

    $(".imagen-jugador").attr("src", "foto_jugadores/" + datos_visita_social[linea]['idfichaJugador'] + '.png');
    

    $('#cuadro_serie_selected').hide(500);
    $('#cuadro_perfil_jugador_selected').show(500);
        
    buscar_proyectos_jugador_cargadiaria();
    buscar_sesiones_jugador_cargadiaria();


    buscador_anio_mes();

    $(window).trigger('resize');

}

// -------------------------- Inicio de la función 'boton_agregar_informe_carga()' - AGREGAR (INSERT) --------------------------- //
function boton_agregar_informe_carga(){
    window.idudc_cargadiaria_proyecto='';
    $("#tabla_ver_informes tbody").empty();

    var idfichaJugador = $(".idfichaJugador").val();        
    // alert( idfichaJugador );
    $("#idfichaJugador").val( idfichaJugador );
    

    $('#cuadro_perfil_jugador_selected').hide(500);
    $('#cuadro_formulario_guardar').show(500);
    $("#boton_agregar_informe_carga").prop("disabled", true); 
    $("#formulario")[0].reset();  

    $("#formulario input[type='text']").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    });
    $("#formulario textarea").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
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

// -------------------------- Inicio de la función 'boton_editar( idudc_cargadiaria_proyecto )' - EDITAR (UPDATE) --------------------------- //
function boton_editar( linea, vista, num_count_registro ){
    
    if( vista === 1 ) {
        
        window.idudc_cargadiaria_proyecto = datos_cargadiaria_proyecto[linea]['idudc_cargadiaria_proyecto'];
        $('#modal_agregar_proyecto').modal('show');
        $("#fechainicio_cargadiaria_proyecto").val( datos_cargadiaria_proyecto[linea]['fechainicio_cargadiaria_proyecto'] );
        $("#objetivos_cargadiaria_proyecto").val( datos_cargadiaria_proyecto[linea]['objetivos_cargadiaria_proyecto'] );
        $("#nombre_cargadiaria_proyecto").val( datos_cargadiaria_proyecto[linea]['nombre_cargadiaria_proyecto'] );

    } else {

        // consultar_cantidad_sesiones();
        window.idudc_cargadiaria_sesion = datos_cargadiaria_sesion[linea]['idudc_cargadiaria_sesion'];
        $('#modal_agregar_sesion').modal('show');
        $("#num_sesiones").val( num_count_registro );
        $("#fecha_cargadiaria_sesion").val( datos_cargadiaria_sesion[linea]['fecha_cargadiaria_sesion'] );
        $("#detalle_cargadiraria_sesion").val( datos_cargadiaria_sesion[linea]['detalle_cargadiraria_sesion'] );

        $("#idudc_cargadiaria_proyecto option").each(function(){
            let thisElement = $(this);
            let thisValue = $(this).val();
            if( thisValue == datos_cargadiaria_sesion[linea]['idudc_cargadiaria_proyecto'] ) {
                thisElement.prop("selected", true);
            }
        });

    }

}
// -------------------------- Fin de la función 'boton_editar( idudc_cargadiaria_proyecto )' - EDITAR (UPDATE) --------------------------- //

function boton_cerrar_alerta_confirm_proyecto(){
    $('#myModalDescargarBoleta').modal('hide');
    $('#modal_agregar_proyecto').modal('show');
}

function boton_cerrar_alerta_confirm_sesion(){
    $('#myModalDescargarBoleta_2').modal('hide');
    $('#modal_agregar_sesion').modal('show');
}

function boton_eliminar_registro_proyecto( linea ){
    window.idudc_cargadiaria_proyecto= datos_cargadiaria_proyecto[linea]['idudc_cargadiaria_proyecto'];
    // alert( idudc_cargadiaria_proyecto );
    $('#myModalEliminarProyecto').modal('show');
    $('#mensaje_eliminar_proyecto').html('<h5>¿Estás seguro que quieres eliminar este proyecto?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
}

function boton_eliminar_registro_sesion( linea ){
    window.idudc_cargadiaria_sesion= datos_cargadiaria_sesion[linea]['idudc_cargadiaria_sesion'];
    // alert( idudc_cargadiaria_proyecto );
    $('#myModalEliminarSesion').modal('show');
    $('#mensaje_eliminar_sesion').html('<h5>¿Estás seguro que quieres eliminar esta sesión?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
}

function eliminar_proyecto() {

    //alert( window.idudc_cargadiaria_proyecto );

     $('.boton_modal').hide();
     $('#mensaje_eliminar_proyecto').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando informe...</h5><br><img src="../config/remover_archivo.png">');
     $.ajax({
        url: "post/udc_eliminar_cargadiaria_proyecto.php",
        type: "post",
        data: {
            'idudc_cargadiaria_proyecto': window.idudc_cargadiaria_proyecto
        },success: function(respuesta) {
            if(respuesta==1){//eliminado correctamente
                $('#mensaje_eliminar_proyecto').html('<h5>Informe eliminado correctamente!</h5>');
                buscar_proyectos_jugador_cargadiaria();
                buscar_sesiones_jugador_cargadiaria();
                $('#myModalEliminarProyecto').modal('hide');
            }else{
                $('#mensaje_eliminar_proyecto').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> contacte al administrador.</h5>");
            }
            // $('#myModal2').modal('hide');
        },error: function(){// will fire when timeout is reached
            $('#mensaje_eliminar_proyecto').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> compruebe conexión a internet.</h5>");
        }, timeout: 10000 // sets timeout to 3 seconds
      });     
}

function eliminar_sesion() {

    //alert( window.idudc_cargadiaria_sesion );

     $('.boton_modal').hide();
     $('#mensaje_eliminar_sesion').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando informe...</h5><br><img src="../config/remover_archivo.png">');
     $.ajax({
        url: "post/udc_eliminar_cargadiaria_sesion.php",
        type: "post",
        data: {
            'idudc_cargadiaria_sesion': window.idudc_cargadiaria_sesion
        },success: function(respuesta) {
            if(respuesta==1){//eliminado correctamente
                $('#mensaje_eliminar_sesion').html('<h5>Informe eliminado correctamente!</h5>');
                buscar_proyectos_jugador_cargadiaria();
                buscar_sesiones_jugador_cargadiaria();
                $('#myModalEliminarSesion').modal('hide');
            }else{
                $('#mensaje_eliminar_sesion').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> contacte al administrador.</h5>");
            }
            // $('#myModal2').modal('hide');
        },error: function(){// will fire when timeout is reached
            $('#mensaje_eliminar_sesion').html("<h5><b style='color:#f26027;'>[Error al eliminar]:</b> compruebe conexión a internet.</h5>");
        }, timeout: 10000 // sets timeout to 3 seconds
      });     
}

function boton_guardar_proyecto(){
    // alert( window.idudc_cargadiaria_proyecto );
    if (window.idudc_cargadiaria_proyecto != "" ) {
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }
    

    $('#myModalDescargarBoleta').modal('show');
    $('#modal_agregar_proyecto').modal('hide');
    $('.boton_modal').css('display','');
    $('.boton_modal').css('display','');
}

function boton_guardar_sesion(){
    // alert( window.idudc_cargadiaria_proyecto );
    if (window.idudc_cargadiaria_sesion != "" ) {
        $('#mensaje_agregar_DescargarBoleta_2').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_DescargarBoleta_2').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }
    
    $('#myModalDescargarBoleta_2').modal('show');
    $('#modal_agregar_sesion').modal('hide');
    $('.boton_modal').css('display','');
}

// -------------------- Inicio de la función 'guardar_registro_proyecto()' -------------------- //
function guardar_registro_proyecto(){
    $('.boton_modal').css('display','none');

    if(window.idudc_cargadiaria_proyecto!=""){
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }

    var data = $('#formulario_guardar_proyecto').serializeArray();
    data.push({name: 'idudc_cargadiaria_proyecto',  value: window.idudc_cargadiaria_proyecto});
    // data.push({name: 'id_jugador',  value: window.id_jugador});
    data.push({name: 'nombre_usuario_software', value: '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>'});
    
    // alert(JSON.stringify(data));
    $.ajax({
        url: "post/udc_guardar_cargadiaria_proyecto.php",
        type: "post",
        data: data,
        dataType: 'json',
        cache: false,
        success: function(respuesta){
            // alert(respuesta);
            if(respuesta==1){
                $('#mensaje_agregar_DescargarBoleta').html('<h4>Registro ingresado correctamente!</h4>');
                buscar_proyectos_jugador_cargadiaria();
                buscar_sesiones_jugador_cargadiaria();
                $("#cuadro_formulario_guardar").hide(500);
                $("#cuadro_perfil_jugador_selected").show(500);
                $('#myModalDescargarBoleta').modal('hide');
                $('#modal_agregar_proyecto').modal('hide');
            }else if(respuesta==2){
                $('#mensaje_agregar_DescargarBoleta').html('<h4>Registro editado correctamente!</h4>');
                buscar_proyectos_jugador_cargadiaria();
                buscar_sesiones_jugador_cargadiaria();
                $("#cuadro_formulario_guardar").hide(500);
                $("#cuadro_perfil_jugador_selected").show(500);
                $('#myModalDescargarBoleta').modal('hide');
                $('#modal_agregar_proyecto').modal('hide');
            }
            else{ // respuesta==4
                $('#mensaje_agregar_DescargarBoleta').html('<h5>Ha ocurrido un error al ejecutar la consulta: '+respuesta+'.</h5><br>');
            }
            
        },error: function(){// will fire when timeout is reached
           $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
}
// -------------------- Fin de la función 'guardar_registro_proyecto()' -------------------- //

// -------------------- Inicio de la función 'guardar_registro_sesion()' -------------------- //
function guardar_registro_sesion(){
    $('.boton_modal').css('display','none');

    if(window.idudc_cargadiaria_sesion!=""){
        $('#mensaje_agregar_DescargarBoleta_2').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_DescargarBoleta_2').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }

    var data = $('#formulario_guardar_sesion').serializeArray();
    data.push({name: 'idudc_cargadiaria_sesion',  value: window.idudc_cargadiaria_sesion});
    // data.push({name: 'id_jugador',  value: window.id_jugador});
    data.push({name: 'nombre_usuario_software', value: '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>'});
    
    // alert(JSON.stringify(data));
    $.ajax({
        url: "post/udc_guardar_cargadiaria_sesion.php",
        type: "post",
        data: data,
        dataType: 'json',
        cache: false,
        success: function(respuesta){
            // alert(respuesta);
            if(respuesta==1){
                $('#mensaje_agregar_DescargarBoleta_2').html('<h4>Registro ingresado correctamente!</h4>');
                buscar_proyectos_jugador_cargadiaria();
                buscar_sesiones_jugador_cargadiaria();
                $("#cuadro_formulario_guardar").hide(500);
                $("#cuadro_perfil_jugador_selected").show(500);
                $('#myModalDescargarBoleta_2').modal('hide');
                $('#modal_agregar_sesion').modal('hide');

            }else if(respuesta==2){
                $('#mensaje_agregar_DescargarBoleta_2').html('<h4>Registro editado correctamente!</h4>');
                buscar_proyectos_jugador_cargadiaria();
                buscar_sesiones_jugador_cargadiaria();
                $("#cuadro_formulario_guardar").hide(500);
                $("#cuadro_perfil_jugador_selected").show(500);
                $('#myModalDescargarBoleta_2').modal('hide');
                $('#modal_agregar_sesion').modal('hide');
            }
            else{ // respuesta==4
                $('#mensaje_agregar_DescargarBoleta_2').html('<h5>Ha ocurrido un error al ejecutar la consulta: '+respuesta+'.</h5><br>');
            }
            
        },error: function(){// will fire when timeout is reached
           $('#mensaje_agregar_DescargarBoleta_2').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
}
// -------------------- Fin de la función 'guardar_registro_sesion()' -------------------- //

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
            url: "post/udc_ver_cargadiaria_complemento.php",
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
                var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555;" id="informe_"><td colspan="10"><b>No se encontraron jugadores</b></td></tr>';
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
                    
                    // Edad del jugador:
                    let edad = calcularEdad( respuesta[i]['fechaNacimiento'] );
                                 
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

                    let rut = respuesta[i]['rut'];
                    if( rut === null || rut == '' || rut == '0' ) {
                        rut = 'No especificado';
                    }

                    let num_grupo_posicion = array_posiciones[posicion0][2];
                    let nombre_grupo_posicion = array_posiciones[posicion0][3];      

                    // alert( num_grupo_posicion );          

                    // alert( respuesta[i]['idudc_cargadiaria_proyecto'] );
                    if( typeof respuesta[i]['idudc_cargadiaria_proyecto'] === 'undefined' ) {

                        var markup = 
                        '<tr class="panel_buscar tr_posicion_jugador_'+posicion0+'" style="height:0px; cursor:pointer; color:#555555;" num-grupo-posicion="'+num_grupo_posicion+'" nombre-grupo-posicion="'+nombre_grupo_posicion+'">\
                            <td onClick="boton_ver_perfil_jugador('+i+');" style="font-weight:bold;"><b>'+count+'</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" style="text-align: left;">\
                                <div style="max-width: 130px; text-align: left;">\
                                    <div><p class="ellipsis-text">'+nombre_posicion+'</p></div>\
                                </div>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" style="text-align: left;">\
                                <div class="img-next-to-text" style="width:10%;">\
                                    <img src="foto_jugadores/'+idfichaJugador+'.png" class="imagen-jugador" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;">\
                                </div>\
                                <div style="max-width: 300px;">\
                                    <p class="ellipsis-text" style="position: relative; top: 3px; left: 7px; color: black;">' + respuesta[i]['nombre'] + ' ' + respuesta[i]['apellido1'] + ' ' + respuesta[i]['apellido2'] + '</p>\
                                </div>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                                <div><p class="ellipsis-text">'+rut+'</p></div>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                                <b>'+respuesta[i]['fechaNacimiento']+'</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                                <b>'+edad+' años</b>\
                            </td>\
                        </tr>';

                    } else {

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
                                <div class="img-next-to-text" style="width:10%;">\
                                    <img src="foto_jugadores/'+idfichaJugador+'.png" class="imagen-jugador" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;">\
                                </div>\
                                <div style="max-width: 300px;">\
                                    <p class="ellipsis-text" style="position: relative; top: 3px; left: 7px; color: black;">' + respuesta[i]['nombre'] + ' ' + respuesta[i]['apellido1'] + ' ' + respuesta[i]['apellido2'] + '</p>\
                                </div>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                                <div><p class="ellipsis-text">'+rut+'</p></div>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                                <b>'+respuesta[i]['fechaNacimiento']+'</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                                <b>'+edad+' años</b>\
                            </td>\
                        </tr>';

                    }                                 

                    /*
                    let num_grupo_posicion = array_posiciones[posicion0][2];
                    let nombre_grupo_posicion = array_posiciones[posicion0][3];

                    let class_tr_posicion = "tr_posicion_" + num_grupo_posicion;
                    let class_id_posicion = num_grupo_posicion;
                    let tr_posicion = '\
                    <tr id="'+class_id_posicion+'" class="'+class_tr_posicion+'" style="text-align: left; background-color:#555555; height:27px;cursor:pointer; color:white; font-size:13px;">\
                        <td colspan="11" style="padding-left: 40px;">\
                            <b style="text-transform: uppercase; font-size: 15px; padding-left: 40px;">'+nombre_grupo_posicion+'</b>\
                        </td>\
                    </tr>\
                    ';

                    let class_tr_jquery = '.' + class_tr_posicion;

                    
                    if( $(class_tr_jquery).length === 0 ) {
                        $("#tabla_ver_informes_todos tbody").append( tr_posicion );             
                    }

                    if( $(class_tr_jquery).attr("id") == num_grupo_posicion ) {
                        
                        if( $(class_tr_jquery).next().length > 0 ) {
                            $( class_tr_jquery ).next().after(markup);
                        } else {
                            $( class_tr_jquery ).after(markup);
                        }

                    }
                    */

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

    // -------------------- Inicio de la función 'buscador_anio_mes()' ------------------------- //
    function buscador_anio_mes() {
        var anio = $("#anio").val();
        var mes = $("#mes").val();
        var idfichaJugador = $(".idfichaJugador").val();
        
        $('#error_conexion_cargadiaria').hide();
        $('#sin_resultados_cargadiaria').hide();
        $('#cargando_buscar_cargadiaria').show();
     
        var sexo = $(".sexo").val();
        var numero_serie = $(".numero_serie").val();

        $.ajax({
            url: "post/udc_ver_cargadiaria_complemento.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
                'tipo_consulta': 4,
                'idfichaJugador': idfichaJugador,
                'anio': anio,
                'mes': mes        
        },success: function(respuesta){


            var tecnico = $('.tecnico').val();
            // alert( tecnico );
            // alert(JSON.stringify(respuesta));
            if(respuesta== ""){ //jugador sin informes
                    
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


                // ---------------------------------------------- CARGA DIARIA ---------------------------- //
                  Highcharts.stockChart('container-carga-diaria', {
                    chart: { 
                      alignTicks: false
                    },

                    yAxis: {
                        min: 0,
                        max: 7,
                        tickInterval: 1
                    },        

                    rangeSelector: {
                      selected: 1
                    },

                    title: {
                      text: 'Cargas Diarias'
                    },

                    tooltip: {
                      headerFormat: '<b>{series.name}</b><br>',
                      pointFormat: 'Carga diaria del dia {point.x:%e. %b}:   <b>{point.y:.f}</b><br>',
                    },

                    series: [{
                      type: 'column',
                      name: 'Carga',
                      color: '#FF6E6E',
                      data: [0, 0],
                      dataGrouping: {
                        units: [
                          [
                            'week', // unit name
                            [1] // allowed multiples
                          ],
                          [
                            'month',
                            
                          ]
                        ]
                      }
                    }]
                  });

                  // ---------------------------------------------- GRÁFICO DE PESO DIARIO ---------------------------- //
                    // Create the chart
                    Highcharts.stockChart('container-evolucion-peso-jugador', {


                        rangeSelector: {
                            selected: 1
                        },

                        title: {
                            text: 'Evolucion del peso del jugador'
                        },

                        series: [{
                            name: 'Evolucion del peso',
                           data: [0, 0],
                            marker: {
                                enabled: true,
                                radius: 3
                            },
                            shadow: true,
                            tooltip: {
                                valueDecimals: 2
                            }
                        }]
                    });


                // ------------------------------------------------------------  //
                $("#tabla_ver_perfil_jugador tbody").empty();
                $("#tabla_peso_diario tbody").empty();
                $("#tabla_lesiones tbody").empty();

                var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td colspan="32" class="celdas-carga-diaria"><b>No se encontraron resultados</b></td></tr>';
                
                $("#tabla_ver_perfil_jugador tbody").append(markup);
                $("#tabla_peso_diario tbody").append(markup);
                $("#tabla_lesiones tbody").append(markup);
                
                $("#graficos_informes_resumen").hide();
                $('#cargando_buscar_cargadiaria').hide();
                $('#sin_resultados_cargadiaria').show();
                $('#boton_editar').hide();
                $('.boton_refresh').hide();
                $('#boton_agregar_informe_carga').prop("disabled", true);
            }else{              
                window.datos_visita_social = respuesta; //se copian todos los profesores al cache
                $("#tabla_ver_perfil_jugador tbody").empty();
                $("#tabla_peso_diario tbody").empty();
                $("#tabla_lesiones tbody").empty();

                var count = 1;

                var array_meses = [
                    "null",
                    "Enero", 
                    "Febrero", 
                    "Marzo", 
                    "Abril",
                    "Mayo", 
                    "Junio",
                    "Julio",
                    "Agosto",
                    "Septiembre",
                    "Octubre",
                    "Noviembre",
                    "Diciembre",
                ];

                var array_fechas_por_mes = respuesta[0];
                var array_fechas_todos = respuesta[1];

                var array_categoria_por_mes = respuesta[2];
                var array_categorias_todos = respuesta[3];

                var array_peso_por_mes = respuesta[4];
                var array_pesos_todos = respuesta[5];

                var array_fechas_carga_por_mes = respuesta[6];
                var array_fecha_carga_todos = respuesta[7];

                var array_mes = respuesta[8];
        
                for( var i = 0; i<array_fechas_por_mes.length; i++ ) {

                    // console.log( array_categoria_por_mes[i] );
                    var markup_carga_diaria = '<tr style="height:27px;cursor:pointer; color:#555555; font-size:13px;">';

                    var markup_peso_diario = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;">';
                    var markup_lesion = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;">';

                    markup_carga_diaria+= 
                    '<th class="celdas-carga-diaria td-title">\
                        <div style="width: 90px;">'+array_meses[array_mes[i]]+'</div>\
                    </th>';

                    var class_th_peso_diario = "";

                    if( i % 2 === 1) {
                        class_th_peso_diario = "td-wg-odd";
                    } else {
                        class_th_peso_diario = "td-wg-even";
                    }

                    markup_peso_diario+= 
                    '<th class="celdas-carga-diaria td-title '+class_th_peso_diario+'">\
                        <div style="width: 90px;">'+array_meses[array_mes[i]]+'</div>\
                    </th>';

                    markup_lesion+= 
                    '<th class="celdas-carga-diaria td-title">\
                        <div style="width: 90px;">'+array_meses[array_mes[i]]+'</div>\
                    </th>\
                    <td class="celdas-carga-diaria td-title">-</td>\
                    <td class="celdas-carga-diaria td-title">-</td>\
                    <td class="celdas-carga-diaria td-title">-</td>\
                    <td class="celdas-carga-diaria td-title">-</td>\
                    <td class="celdas-carga-diaria td-title">-</td>\
                    <td class="celdas-carga-diaria td-title">-</td>\
                    <td class="celdas-carga-diaria td-title">-</td>\
                    <td class="celdas-carga-diaria td-title">-</td>\
                    ';                         

                    var cantidad_dias_mes = array_fechas_por_mes[i].length;
                    console.log( "Cantidad de días por mes: " + cantidad_dias_mes );
                    if( array_categoria_por_mes[i] == "" ) {

                        markup_carga_diaria+= 
                        '<td colspan="'+cantidad_dias_mes+'" class="celdas-carga-diaria">Sin resultados...</td>';

                        switch( cantidad_dias_mes ) {

                            case 28:
                                markup_carga_diaria+= 
                                '<td class="celdas-carga-diaria td-title">-</td>\
                                <td class="celdas-carga-diaria td-title">-</td>\
                                <td class="celdas-carga-diaria td-title">-</td>\
                                ';
                                break;

                            case 29:
                                markup_carga_diaria+= 
                                '<td class="celdas-carga-diaria td-title">-</td>\
                                <td class="celdas-carga-diaria td-title">-</td>\
                                ';
                                break; 

                            case 30:
                                markup_carga_diaria+= 
                                '<td class="celdas-carga-diaria td-title">-</td>';
                                break;                                                                

                        }

                    } else {



                        for( var d=0; d <= 30; d++ ) {
                            
                            //var info_categoria = "";
                            // ---- Carga Diaria ----- //
                            // alert( respuesta[i]['categoria_informe_carga_individual'][d] );
                            var num_categoria = array_categoria_por_mes[i][d];
                            if( typeof num_categoria === "undefined" ) {
                                //info_categoria = "";
                                if( typeof array_fechas_por_mes[i][d] === "undefined"  ) {

                                    markup_carga_diaria+= 
                                    '<td scope="col" class="celdas-carga-diaria" style="cursor:pointer; padding:0px;">\
                                        <div style="width:100%;">\
                                            -\
                                        </div>\
                                    </td>';

                                } else {

                                    markup_carga_diaria+= 
                                    '<td scope="col" class="celdas-carga-diaria td-categoria-nulo" style="cursor:pointer; padding:0px;">\
                                        <div style="width:100%;"></div>\
                                    </td>';

                                }         

                            } else {

                                num_categoria = parseInt( num_categoria ); 
                                if( typeof array_fechas_por_mes[i][d] === "undefined"  ) {

                                    markup_carga_diaria+= 
                                    '<td scope="col" class="celdas-carga-diaria" style="cursor:pointer; padding:0px;">\
                                        <div style="width:100%;">\
                                            -\
                                        </div>\
                                    </td>';

                                } else {

                                    let fecha_carga = array_fechas_carga_por_mes[i][d];
                                    console.log( "Fecha de carga: " + fecha_carga );

                                    let dia_carga = fecha_carga.substring(8, 10);                                    
                                    let iniciales_carga = array_iniciales_categorias[num_categoria];
                                    if( iniciales_carga.length > 3 ) {
                                        iniciales_carga = iniciales_carga.substring(0, 3);
                                    }

                                    /*
                                    markup_carga_diaria+= 
                                    '<td scope="col" class="'+array_class_categorias[num_categoria]+' celdas-carga-diaria" style="cursor:pointer; padding:0px;">\
                                        <div dia-carga="'+dia_carga+'" class="div-categoria mytooltip" style="width:100%;">\
                                            <span>'+iniciales_carga+'</span><span class="mytext '+array_class_categorias[num_categoria]+'" categoria-tooltip="'+array_class_categorias[num_categoria]+'">Carga = '+num_categoria+' '+array_categorias[num_categoria]+'</span>\
                                        </div>\
                                    </td>';
                                    */

                                    markup_carga_diaria+= 
                                    '<td scope="col" class="'+array_class_categorias[num_categoria]+' celdas-carga-diaria" style="cursor:pointer; padding:0px;">\
                                        <div dia-carga="'+dia_carga+'" class="div-categoria mytooltip" style="width:100%;">\
                                            <span>'+iniciales_carga+'</span><span class="mytext '+array_class_categorias[num_categoria]+'" categoria-tooltip="'+array_class_categorias[num_categoria]+'">'+array_categorias[num_categoria]+'</span>\
                                        </div>\
                                    </td>';                                    

                                }

                            }

                        }

                    }                         

                    // ------------------------------ PESO DIARIO ------------------------------ //
                    array_pesos_dias_mes = []
                    for( let j=0; j<array_peso_por_mes[i].length; j++ ) {
                        let peso_dia = array_peso_por_mes[i][j];
                        if( peso_dia != '' ) {
                            array_pesos_dias_mes[j] = peso_dia;
                        }
                    }
                    // alert( array_pesos_dias_mes.length );
                    // if( array_peso_por_mes[i] == "" ) {
                    if( array_pesos_dias_mes.length === 0 ) {   

                        markup_peso_diario+= 
                        '<td colspan="'+cantidad_dias_mes+'" class="celdas-carga-diaria">Sin resultados...</td>';

                        switch( cantidad_dias_mes ) {

                            case 28:
                                markup_peso_diario+= 
                                '<td class="celdas-carga-diaria td-title">-</td>\
                                <td class="celdas-carga-diaria td-title">-</td>\
                                <td class="celdas-carga-diaria td-title">-</td>\
                                ';
                                break;

                            case 29:
                                markup_peso_diario+= 
                                '<td class="celdas-carga-diaria td-title">-</td>\
                                <td class="celdas-carga-diaria td-title">-</td>\
                                ';
                                break; 

                            case 30:
                                markup_peso_diario+= 
                                '<td class="celdas-carga-diaria td-title">-</td>';
                                break;                                                                

                        }


                    } else {

                        // alert("Con datos...");

                        for( var d=0; d <= 30; d++ ) {

                            // ---- Peso Diario ----- //
                            // alert( respuesta[i]['peso_informe_carga_individual'][d] );
                                
                            var peso_diario = array_peso_por_mes[i][d];
                            var info_peso_diario = "";
                            if( typeof peso_diario === "undefined" ) {
                                info_peso_diario = "";
                            } else {
                                info_peso_diario = peso_diario;
                            }

                            if( typeof array_fechas_por_mes[i][d] === "undefined"  ) {

                                markup_peso_diario+= 
                                '<td scope="col" class="celdas-carga-diaria" style="cursor:pointer; padding:0px;">\
                                    <div style="width:100%;">\
                                        -\
                                    </div>\
                                </td>';

                            } else {

                                let fecha_peso_diario = array_fechas_carga_por_mes[i][d];
                                let class_div_peso_diario = "";
                                let dia_peso_diario = "nulo";
                                if( typeof fecha_peso_diario !== "undefined" ) {
                                    class_div_peso_diario = "div-peso-diario";
                                    // console.log( "Fecha de peso diario: " + fecha_peso_diario );    
                                    dia_peso_diario = fecha_peso_diario.substring(8, 10);
                                }
                                
                                markup_peso_diario+= 
                                '<td class="celdas-carga-diaria" style="font-weight:bold;">\
                                    <div dia-peso-diario="'+dia_peso_diario+'" class="'+class_div_peso_diario+'">\
                                        '+info_peso_diario+'\
                                    </div>\
                                </td>';  

                            }
                            
                        }

                    } 

                    markup_carga_diaria+= '</tr>';
                    markup_peso_diario+= '</tr>';
                    markup_lesion+= '</tr>';
                    $("#tabla_ver_perfil_jugador tbody").append( markup_carga_diaria );
                    $("#tabla_peso_diario tbody").append( markup_peso_diario );
                    $("#tabla_lesiones tbody").append( markup_lesion );                    

                    // ------------------ Gráficos de Carga Diaria ------------------ // 
                    var array_cargas = [];
                    var array_descripcion_categoria = [];
                    var array_pesos = [];
                    var array_fecha_cargas = [];
                    var array_dias_carga = [];
                    var array_meses_carga = [];
                    var array_anios_carga = [];
                    var array_all_carga = [];
                    var array_all_descripcion_categoria = [];
                    var array_all_peso = [];
                
                    for( var l = 0; l < array_fechas_todos.length; l++ ) {
                        
                        var fecha = array_fechas_todos[l];
                    
                        // Loop a las fechas de carga para compararlas con cada una de las fechas del mes seleccionado:
                        for( var m = 0; m < array_fecha_carga_todos.length; m++ ) {
                            var fecha_carga = array_fecha_carga_todos[m]; 
                            var carga = array_categorias_todos[m];
                            var descripcion_categoria = array_categorias[carga];
                            var peso = array_pesos_todos[m];
                            if( fecha_carga == fecha ) {
                                carga = carga;
                                peso = peso;
                                array_cargas[l] = carga;
                                array_pesos[l] = peso;
                                array_descripcion_categoria[l] = descripcion_categoria;
                            }

                            array_fecha_cargas[l] = fecha;    
                            // console.log( "Fecha por mes: " + fecha + "; Fecha carga: " + fecha_carga + "; Carga: " + carga );
                        }

                        if( typeof array_cargas[l] === "undefined"  ) {
                            array_cargas[l] = 0;
                        }

                        // Modificado:
                        if( typeof array_pesos[l] === "undefined" || array_pesos[l] == "" ) {
                            array_pesos[l] = '';
                        }

                        /*
                        if( typeof array_pesos[l] === "undefined"  ) {
                            array_pesos[l] = 0;
                        }
                        */

                        if( typeof array_descripcion_categoria[l] === "undefined"  ) {
                            array_descripcion_categoria[l] = "No tiene";
                        }                                                

                        console.log( "Fecha por mes: " + array_fecha_cargas[l] + "; Carga: " + array_cargas[l] + "; Peso: " + array_pesos[l] + "; Desc Categoría: " + array_descripcion_categoria[l] );

                        array_cargas[l] = parseInt( array_cargas[l] );
                        array_pesos[l] = parseInt( array_pesos[l] );

                        // Día
                        let dia = fecha.substring(8, 10);
                        dia = parseInt( dia ); 
                        // Mes:
                        let mes = fecha.substring(5, 7);
                        mes = parseInt( mes );  
                        mes--;   

                        // Año:
                        let anio = fecha.substring(0, 4);
                        anio = parseInt( anio );     

                        // console.log( anio + "-" + mes + "-" + dia + ". Carga: " + carga );

                        array_dias_carga[l] = dia;
                        array_meses_carga[l] = mes;
                        array_anios_carga[l] = anio;
                        array_all_descripcion_categoria[l] = array_descripcion_categoria[l];

                        array_all_carga[l] = [Date.UTC(anio, mes, dia), array_cargas[l]];
                        array_all_peso[l] = [Date.UTC(anio, mes, dia), array_pesos[l]];         
                    
                    }


                } // Fin del for principal

                    $("#tabla_ver_perfil_jugador tbody tr td div.div-categoria").each(function(i){
                        // $(this).children().eq(1).css({"color": "red", "border": "2px solid red"});
                        let classCategoria = $(this).children().eq(1).attr("categoria-tooltip");
                        
                        let dia_carga = $(this).attr("dia-carga");
                        dia_carga = parseInt( dia_carga );
                        let posicionTd = dia_carga - 1;
                        let divCategoria = $(this);
                        let parentTd = $(this).parent("td");
                        let tooltipClass = divCategoria.find("span:nth-child(2)").attr("class");
                        tooltipClass = tooltipClass.substring(7, 18);
                        console.log( "Clase del tooltip Nº " + i + ": " + tooltipClass );
                        // parentTd.attr("class", "celdas-carga-diaria");

                        if( posicionTd === 0 ) {
                            parentTd.parent().find('td:first').append( divCategoria ).attr("class", "celdas-carga-diaria " + classCategoria).attr('carga', '1');
                        } else {
                            parentTd.siblings().eq(posicionTd).append( divCategoria ).attr("class", "celdas-carga-diaria " + classCategoria).attr('carga', '1');
                            // parentTd.siblings().eq(posicionTd).html( divCategoria ).addClass(tooltipClass);
                        }
                        
                    });

                    $("#tabla_ver_perfil_jugador tbody tr td").each(function(i){
                        let attr = $(this).attr('carga');
                        if( attr != '1' ) {
                            $(this).attr('class', 'celdas-carga-diaria');
                        }                         
                        // let thisElement = $(this);
                        // alert( thisElement.attr('class') );
                        // $(this).css('background-color', 'red');
                    });                    

                    $("#tabla_peso_diario tbody tr td div.div-peso-diario").each(function(){
                        let dia_peso_diario = $(this).attr("dia-peso-diario");
                        dia_peso_diario = parseInt( dia_peso_diario );
                        let posicionTd = dia_peso_diario - 1;
                        let divPesoDiario = $(this);
                        let parentTd = $(this).parent("td");
                        let parentTdClass = parentTd.attr("class");
                        parentTd.attr("class", "celdas-carga-diaria");

                        if( posicionTd === 0 ) {
                            parentTd.parent().find('td:first').append( divPesoDiario ).addClass( parentTdClass );    
                        } else {
                            parentTd.siblings().eq(posicionTd).append( divPesoDiario ).addClass( parentTdClass );
                        }
                        
                    });                    

                   console.log( array_all_carga );

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

    // Create the chart
    var myChart = Highcharts.stockChart('container-carga-diaria', {


        rangeSelector: {
            selected: 1
        },
        /*
                    xAxis: {
                        min: 0,
                        max: 7,
                    },
        */

                    yAxis: {
                        min: 0,
                        max: 7,
                        tickInterval: 1
                    },                    


                    title: {
                      text: 'Cargas Diarias'
                    },

                    tooltip: {
                      headerFormat: '<b>{series.name}</b><br>',
                      pointFormat: 'Carga diaria del dia {point.x:%e. %b}:   <b>{point.y:.f}</b><br>',
                    },

        series: [{
            name: 'Carga',
             type: 'area',
             data: array_all_carga,
            marker: {
                enabled: true,
                radius: 3
            },
            shadow: true,
            tooltip: {
                valueDecimals: 2
            }
        }]
    });    


                  // ---------------------------------------------- GRÁFICO DE PESO DIARIO ---------------------------- //
                    // Create the chart
                    var myChart2 = Highcharts.stockChart('container-evolucion-peso-jugador', {

                    chart: { 
                      alignTicks: false
                    },

                        rangeSelector: {
                            selected: 1
                        },

                        title: {
                            text: 'Evolucion del peso del jugador'
                        },

                        series: [{
                            name: 'Evolucion del peso',
                           data: array_all_peso,
                            marker: {
                                enabled: true,
                                radius: 3
                            },
                            shadow: true,
                            tooltip: {
                                valueDecimals: 2
                            }
                        }],                      
                    });

                  window.setTimeout(function(){
                   $(window).trigger('resize');
                   myChart.reflow();
                   myChart2.reflow(); 
                  }, 500);

                var $table= $('#tabla_ver_perfil_jugador, #tabla_peso_diario');
                var rows = $table.find('tr').get();
                rows.sort(function(a, b) {
                    return a.id < b.id ? -1 : a.id > b.id? 1 : 0;
                });


                $('#boton_agregar').show();
                $('.boton_refresh').hide();
            } 
            $('#cargando_buscar_cargadiaria').hide();
            $('#error_conexion_cargadiaria').hide();
            $('#sin_resultados_cargadiaria').hide();            

        },error: function(){// will fire when timeout is reached
            $('#cargando_buscar_cargadiaria').hide();
            $('#sin_resultados_cargadiaria').hide();
            $('#error_conexion_cargadiaria').show();
            $('#boton_editar').hide();
                $('.boton_refresh').show();
            }, timeout: 15000 // sets timeout to 3 seconds
        });

    /* ------------------------------------------------------------- */

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

// ----------------------------- DÍAS DE BAJAS POR MES ----------------------------- //
var chart_diasbajas_pormes = Highcharts.chart('dias-bajas-por-mes', {
    chart: {
        type: 'line',
        backgroundColor:null
    },
    title: {
        text: 'Dias de baja por mes'
    },
    subtitle: {
        text: null
    },
    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        min: 0,
    },
    yAxis: {
        min: 0, // <---- Nuevo.
        max: 200,
        tickInterval: 1,
        title: {
            text: 'Dias de baja por lesiones'
        }
    },
    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{
        name: 'Dias de baja por lesion',
        color:'#FA6464',
        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]
    
    }]
});

// ----------------------------- MECANISMO DE LESIÓN ----------------------------- //
// Build the chart
var chart_mecanismo_lesion = Highcharts.chart('mecanismo-lesion', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie',
        backgroundColor:null
    },
    title: {
        text: 'Mecanismo de la lesion'
    },
      tooltip: {
      headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{series.color}">{point.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
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
        name: 'Nº Lesiones',
        colorByPoint: true,
        data: [{
            name: 'Traumatismo',
            color:'#474747',
            y: 0,
            sliced: true,
            selected: true
        }, {
            name: 'Sobrecarga',
            color:'#FA6464',
            y: 0
       
        }]
    }]
});

// ----------------------------- DÍA DE BAJA POR PATOLOGÍA ----------------------------- //
var chart_diabaja_patologia = Highcharts.chart('dia-baja-patologia', {

    chart: {
        type: 'column',
        backgroundColor:null
    },

    title: {
        text: 'Dias de baja por patologia'
    },

    xAxis: {
        categories: ['Abrasion','Bursitis','Concusion','Contractura','Degeneracion de tendon','Desgarro','Dislocacion/Subluxacion','Edema Muscular','Edema oseo','Esguince','Fascitis','Fisura','Fractura','Inflamacion','Laceracion','Lesion de ligamentos (Rotura parcial)','Lesion de ligamentos (Rotura total)','Lesion de ligamentos (distension)','Lesion de meniscos / cartilago','Lesion de tendones (ruptura)','Lesion dental','Lesion nerviosa','Micosis','Otra lesion osea','Pubalgia','Ruptura muscular/distension/calambre','Sinovitis','Sobrecarga','Tendinopatia','Contusion']
    },

    yAxis: {
        allowDecimals: false,
        min: 0, // <---- Nuevo.
        max: 200,
        tickInterval: 1,
        title: {
            text: 'Dias de baja'
        },
         stackLabels: {
            style: {
                color: 'black'
            },
            enabled: true
        }
    
    },

    tooltip: {
        formatter: function () {
            return '<b>' + this.x + '</b><br/>' +
                'Dias de baja:' + ' ' + this.y +  '<br/>'  ;
        }
    },

    plotOptions: {
        column: {
            stacking: 'normal'
        }
    },

    series: [{
        name: 'Dias de baja segun patologia',
         colorByPoint: true,
        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        stack: 'male'
    
    }]
});
// ----------------------------- PERFIL DE PATOLOGÍAS Y DÍAS DE BAJA ----------------------------- //
var chart_perfil_patologia = Highcharts.chart('perfil-patologia-dias-baja', {

    chart: {
        polar: true,
        type: 'line',
        backgroundColor:null
    },

    accessibility: {
        description: null
    },

    title: {
        text: 'Perfil de patologias y dias de baja',
        x: 0
    },

    pane: {
        size: '80%'
    },

    xAxis: {
        categories: ['Desgarro','Fractura','lesion de ligamentos (rotura parcial)','lesion de ligamentos (rotura total)','Esguince','Contractura','Tendinopatia','Concusion','Bursitis','Abrasion','Dislocacion /subluxacion','Edema muscular','Edema oseo','Fisura','Inflamacion','Laceracion','Pubalgia','Sinovitis','Sobrecarga'
            ],
        tickmarkPlacement: 'on',
        lineWidth: 0
    },

    yAxis: {
        gridLineInterpolation: 'polygon',
        lineWidth: 0,
        min: 0, // <---- Nuevo.
        max: 200,
        tickInterval: 1,
        title: {
            text: 'Perfil de patologias y dias de baja'
        },        
    },

    tooltip: {
        shared: true,
        pointFormat: '<span style="color:{series.color}">{point.name} <b>{point.y:,.0f} dias de baja</b><br/>'
    },

    

    series: [{
        name: 'Jugador',
        type: 'area',
        color:'#F57575',
        data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        pointPlacement: 'on'
   
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
                },
                pane: {
                    size: '70%'
                }
            }
        }]
    }

});

                  window.setTimeout(function(){
                   $(window).trigger('resize');
                   chart_diasbajas_pormes.reflow();
                   chart_mecanismo_lesion.reflow(); 
                   chart_diabaja_patologia.reflow(); 
                   chart_perfil_patologia.reflow(); 
                  }, 500);    
    
    }
    // -------------------- Fin de la función 'buscador_anio_mes()' ------------------------- //

    // -------------------- Inicio de la función 'consultar_cantidad_sesiones()' -------------------- // 
    function consultar_cantidad_sesiones(){
        var idfichaJugador = $(".idfichaJugador").val();
        $.ajax({
            url: "post/udc_ver_cargadiaria_complemento.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
                'tipo_consulta': 6,
                'idfichaJugador': idfichaJugador
            },
            success: function(respuesta){
                // alert(JSON.stringify(respuesta));
                if(respuesta== ""){ //jugador sin informes
                    console.log("Consulta vacía...");
                }else{              
                    // alert( respuesta[0]["COUNT(udc_cargadiaria_sesion.idudc_cargadiaria_sesion)"] );
                    let cantidad_total_sesiones = respuesta[0]["COUNT(udc_cargadiaria_sesion.idudc_cargadiaria_sesion)"];
                    cantidad_total_sesiones = parseInt( cantidad_total_sesiones );
                    cantidad_total_sesiones++;
                    $("#num_sesiones").val( cantidad_total_sesiones );
                } 
            },error: function(){// will fire when timeout is reached
                console.log("Ha ocurrido un error con AJAX...");
            }, timeout: 15000 // sets timeout to 3 seconds
        });
    }
    // -------------------- Fin de la función 'consultar_cantidad_sesiones()' -------------------- //

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
    // Deseleccionando todos los options por defecto otra vez:
    $("#mes option").each(function(){
        let thisElement = $(this);
        let thisValue = thisElement.val();
        thisElement.prop("selected", false);
    });    

}

function boton_volver_perfil_jugador_selected() {
    $("#tabla_ver_perfil_jugador tbody").empty(); // <--- Vaciando tabla.
    $('#cuadro_formulario_guardar').hide(500);
    $('#cuadro_perfil_jugador_selected').show(500);
    buscar_proyectos_jugador_cargadiaria(); // <--- Modificación hecha el 28-02-2020.
    buscar_sesiones_jugador_cargadiaria();
}


function volver_despues_guardado() {
    $('#cuadro_formulario_guardar').hide(500);
    $('#cuadro_serie_selected').show(500);
    buscador();
}


function volver_despues_eliminacion() {
    buscar_proyectos_jugador_cargadiaria();
    buscar_sesiones_jugador_cargadiaria();
}


function chequear_datos_proyecto(){
    
    var ER_numericosDecimales = /^([0-9]*|(\d+))(\.\d{1,2})?$/;
    var ER_numericosEnteros = /[0-9]/;
    var ER_caracteresAlfaNumericos = /^[a-zA-ZáàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜñÑ 0-9,.-_¿?¡!$%#()]*$/;
    flag = true;

    // ------------------------------------------------------------------------ //
    let fechainicio_cargadiaria_proyecto = $("#fechainicio_cargadiaria_proyecto").val();
    if( fechainicio_cargadiaria_proyecto == "" ) {
        $("#fechainicio_cargadiaria_proyecto").css("background-color", "#fff"); // <--- Color blanco.
        flag = false;
    } else {
        $("#fechainicio_cargadiaria_proyecto").css("background-color", "#fff");
    }
        
    // ------------------------------------------------------------------------ //
    let objetivos_cargadiaria_proyecto = $("#objetivos_cargadiaria_proyecto").val();
    if( objetivos_cargadiaria_proyecto != "" ) {
        if( objetivos_cargadiaria_proyecto.match(ER_caracteresAlfaNumericos) ) {      
            $("#objetivos_cargadiaria_proyecto").css("background-color", "#fff");
        } else {
            $("#objetivos_cargadiaria_proyecto").css("background-color", "#ffc6c6");
            flag = false;
        }
    } else {
        $("#objetivos_cargadiaria_proyecto").css("background-color", "#fff");
        flag = false;
    }

    // ------------------------------------------------------------------------ //
    let nombre_cargadiaria_proyecto = $("#nombre_cargadiaria_proyecto").val();
    if( nombre_cargadiaria_proyecto != "" ) {
        if( nombre_cargadiaria_proyecto.match(ER_caracteresAlfaNumericos) ) {      
            $("#nombre_cargadiaria_proyecto").css("background-color", "#fff");
        } else {
            $("#nombre_cargadiaria_proyecto").css("background-color", "#ffc6c6");
            flag = false;
        }
    } else {
        $("#nombre_cargadiaria_proyecto").css("background-color", "#fff");
        flag = false;
    }  

    if( flag === false ){
        $('#boton_agregar_proyecto').prop("disabled", true);
    }else{
        $('#boton_agregar_proyecto').prop("disabled", false);
        // alert("Formulario validado");
    }

}

function chequear_datos_sesion(){
    
    var ER_numericosDecimales = /^([0-9]*|(\d+))(\.\d{1,2})?$/;
    var ER_numericosEnteros = /[0-9]/;
    var ER_caracteresAlfaNumericos = /^[a-zA-ZáàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜñÑ 0-9,.-_¿?¡!$%#()]*$/;
    flag = true;

    // ------------------------------------------------------------------------ //
    let fecha_cargadiaria_sesion = $("#fecha_cargadiaria_sesion").val();
    if( fecha_cargadiaria_sesion == "" ) {
        $("#fecha_cargadiaria_sesion").css("background-color", "#fff"); // <--- Color blanco.
        flag = false;
    } else {
        $("#fecha_cargadiaria_sesion").css("background-color", "#fff");
    }
        
    // ------------------------------------------------------------------------ //
    let detalle_cargadiraria_sesion = $("#detalle_cargadiraria_sesion").val();
    if( detalle_cargadiraria_sesion != "" ) {
        if( detalle_cargadiraria_sesion.match(ER_caracteresAlfaNumericos) ) {      
            $("#detalle_cargadiraria_sesion").css("background-color", "#fff");
        } else {
            $("#detalle_cargadiraria_sesion").css("background-color", "#ffc6c6");
            flag = false;
        }
    } else {
        $("#detalle_cargadiraria_sesion").css("background-color", "#fff");
        flag = false;
    }

    // ------------------------------------------------------------------------ //
    let idudc_cargadiaria_proyecto = $("#idudc_cargadiaria_proyecto").val();
    if( idudc_cargadiaria_proyecto == "" ) {
        $("#idudc_cargadiaria_proyecto").css("background-color", "#fff"); // <--- Color blanco.
        flag = false;
    } else {
        $("#idudc_cargadiaria_proyecto").css("background-color", "#fff");
    }      

    if( flag === false ){
        $('#boton_agregar_sesion').prop("disabled", true);
    }else{
        $('#boton_agregar_sesion').prop("disabled", false);
        // alert("Formulario validado");
    }

}



</script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.date_fechaNacimiento_year_only').datetimepicker({
        language:  'es',
        format: 'yyyy',
        startDate: '2018-01-01',
        endDate: new Date(),
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

    $('.date_fechaNacimiento_year_only').datetimepicker('setDate', new Date() );


    $('.date_fechaNacimiento').datetimepicker({
        language:  'es',
        format: 'yyyy-mm-dd',
        // startDate: '2018-01-01',
        // endDate: new Date(),
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

    // buscador();
    mostrar_al_cargar_pagina();
               
    // $(document).on('change','body',function(){ $('.bootstrap-select .dropdown-menu').css('display',''); });
    // $(document).on('click','body',function(){ $('.bootstrap-select .dropdown-menu').css('display',''); });

</script>