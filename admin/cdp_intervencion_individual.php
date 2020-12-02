<?php
    include('../config/datos.php');
    session_start();
    if(!(isset($_SESSION["nombre_usuario_software"]))){
        session_destroy();
        header('Location: ../index.php?cerrar_sesion=1');
    }else{

        include('../bd/cdp_intervencion_individual_BD.php');
        $menu_actual="cdp";
        $submenu_actual="cdp_intervencion_individual";
        $seccion_comentarios = $comentarios['cdp_intervencion_individual'];//mis cuotas
        $demo_seccion = $demo['cdp_intervencion_individual'];
        $nombre_pestana_navegador='Intervenciones Individuales';
        
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
<title><?php echo $nombre_pestana_navegador;?> | Intervenciones Individuales</title>

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
    
    .boton_eliminar{
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
        background-color: <?php echo $color_fondo; ?>
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


    
    .boton_editar{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid <?php echo $color_fondo; ?> 
        color: <?php echo $color_fondo; ?>
        border-radius:2px;
    }
    .boton_editar:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid #fda101; 
        color: #fda101;
        border-radius:2px;
    }
    .boton_editar:disabled{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid rgba(0, 0, 0, .2);    
        color: rgba(0, 0, 0, .2);
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
    
    .boton_add{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid <?php echo $color_fondo; ?> 
        color: <?php echo $color_fondo; ?>
        border-radius:2px;
    }
    .boton_add:hover{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid black; 
        color: black;
        border-radius:2px;
    }
    .boton_add:disabled{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid rgba(0, 0, 0, .2);    
        color: rgba(0, 0, 0, .2);
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
    color: #7b7575;
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
    background-color: <?php echo $color_fondo; ?>
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
    border: 2px solid <?php echo $color_fondo; ?> 
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

#boton_agregar_informe_carga:enabled {
    cursor: pointer;
}

#boton_agregar_informe_carga:disabled {
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
var idcdp_intervencion_individual = "";
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
var datos_intervencion_individual = {};
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
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon-truck"></i> CDP <i class="icon-chevron-right"></i> Intervenciones Individuales</a>
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
            <i class="icon-truck"></i> CDP
        </a> 
        <a class="current">
            Intervenciones Individuales
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
            <td style="width: 150px; text-align: center;">
                <div style="padding:0px; margin:0px; width: 250px; margin-top: 25px;">
                    <h3 style="margin-top: 0px; text-transform: uppercase;">
                        Área Psicológica
                    </h3>
                    <h5 style="margin-top: 0px; text-transform: uppercase; font-weight: 100; position: relative; top: -10px;">
                        ATENCIONES INDIVIDUALES
                    </h5>                        
                    <!-- <h5 id="sexo_seleccion" class="sexo_seleccion" style="margin: 0px;"></h5> -->
                </div>
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
                                    <h3 class="titulo_principal" style="margin: 0px; line-height: 26px;">ATENCIONES INDIVIDUALES</h3>
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
                                                <th scope="col" style="cursor:pointer; padding:0px;text-align: center;">
                                                    <div class="tip-top" data-original-title="Edad" style="width:100%;">EDAD</div>
                                                </th>
                                                
                                                <th scope="col" style="cursor:pointer; padding:0px; border-top-right-radius:5px; width:140px;" colspan="1"></th>
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
                            <input type="hidden" id="titulo_serie_reporte">
                        </td>
                    </tr>
                </tbody>
            </table>            
         
            <div class="row-fluid" style="margin-top:0px;">
                <div class="span12" style="margin: 0px;">
                    <div style="width:100%; background-color: <?php echo $color_fondo; ?> color: white; height:20px; border-radius: 4px;">
                        <img src="../config/five_white_stars_2.png" class="img-star-five-stars">
                    </div>
                    <img src="" class="imagen-jugador" style="width: 120px; border-radius: 50%; border: solid 2px; height: 120px; margin-top: -75px; margin-right: 80px; float: right;"> 

                    <button class="boton_volver" onclick="boton_volver_serie_selected_registro_cargas_diarias();" style="float:left; margin:0px; margin-top: 20px;">
                        <i class="icon-arrow-left"></i> volver
                    </button>

                </div>
            </div>
                        
            <br/>
        </center>   

        <!--
        <center>
            <table style="color:black; font-family:Arial, Helvetica, sans-serif;margin-bottom: 10px">
                <tr class="sin_fondo">
                    <td style="padding:0px; padding-top:15px;">
                        <table>
                            <tbody><tr class="sin_fondo">
                                <td><center><img src="../config/cdp.png" style="width:100px; margin-top:5px;"></center></td>
                            </tr>
                        </tbody></table>
                    </td>
                    <td style="width: 77%; text-align: center;">
                        <div style="padding:0px; margin:0px; ">
                            <h5 class="nombre-jugador" style="margin-top: 0px;"></h5>
                            <h5 class="datos-jugador" style="color: black; margin: 0px;"></h5>
                            <input type="hidden" name="" class="idfichaJugador">
                            <input type="hidden" id="titulo_serie_reporte">
                            <input type="hidden" id="sexo_seleccion_reporte">
                        </div>
                    </td>
                </tr>
            </table>
         
            <div class="row-fluid" style="margin-top:0px;">
                <div class="span12" style="margin: 0px;">
                    <div style="width:100%; background-color:<?php echo $color_fondo; ?> height:20px;">
                        <img src="../config/five_white_stars_2.png" class="img-star-five-stars"> 
                    </div>
                    <img src="" class="imagen-jugador" style="width: 120px; border-radius: 50%; border: solid #059c4c 4px; height: 120px; margin-top: -75px; margin-right: 80px; float: right;"> 

                    <button class="boton_volver" onclick="boton_volver_serie_selected_registro_cargas_diarias();" style="float:left; margin:0px; margin-top: 20px;">
                        <i class="icon-arrow-left"></i> volver
                    </button>                    
                </div>
            </div>
            <br/>
        </center>   
        -->

        <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?> height:20px;"></div> -->
    </div>
    <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
    
    <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:30px;">
        <div class="row-fluid" style="margin-top:-30px;">

            <button style="margin-bottom:10px; margin-top: 0px; float:right;" class="boton_informe_jugador" onclick="boton_agregar_informe_carga();">
                <b style="font-size:13px;"><i class="icon-plus"></i> Agregar informe</b>
            </button>

                            <center>
                                <div style="margin:0px; height:20px;"><img src="../config/cargando_buscar.gif" id="cargando_buscar_perfil_jugador" style=" display:none;">
                                    <span style="color:#dc4e4e; display:none;" id="error_conexion_perfil_jugador"><b>Error:</b> conexión a internet deficiente.</span>
                                </div>
                            </center>            

            <div class="span12" style="margin: 0px;">
                <table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_ver_perfil_jugador">
                    <thead>
                        <tr style="background-color:#555555; color:white;">
                            <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; max-width:80px; width: 80px;">
                                <div class="tip-top" data-original-title="Número" style="width:100%; ">#</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 100px; max-width: 100px;">
                                <div class="tip-top" data-original-title="Fecha de Intervención" style="width:155px; text-align: left;">FECHA INTERVENCIÓN</div>
                            </th>                                                
                            <th scope="col" style="cursor:pointer; padding:0px; width: 650px; max-width: 650px;">
                                <div class="tip-top" data-original-title="Motivo de Consulta" style="width:100%; text-align: left;">MOTIVO CONSULTA</div>
                            </th>
                            <th scope="col" style="cursor:pointer; padding:0px; width: 650px; max-width: 650px;">
                                <div class="tip-top" data-original-title="Objetivos" style="width:100%; text-align: left;">OBJETIVOS</div>
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
                    <div style="width:100%; background-color: <?php echo $color_fondo; ?> color: white; height:20px; border-radius: 4px;">
                        <img src="../config/five_white_stars_2.png" class="img-star-five-stars">
                    </div>
                    <img src="" class="imagen-jugador" style="width: 120px; border-radius: 50%; border: solid 2px; height: 120px; margin-top: -75px; margin-right: 80px; float: right;"> 

                    <button class="boton_volver" onclick="boton_volver_perfil_jugador_selected();" style="float:left; margin:0px; margin-top: 20px;">
                        <i class="icon-arrow-left"></i> volver
                    </button>

                </div>
            </div>
                        
            <br/>
        </center>      

        <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?> height:20px;"></div> -->
    </div>
    <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
    
    <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:-60px;">
        <div class="row-fluid" style="margin-top:0px;">


            <div class="span12" style="margin: 0px;">

                <!-- ========================================== Inicio del id="formulario" ========================================== -->
                <form method="post" ng-model="formulario" name="formulario" id="formulario" novalidate>

                    <input type="hidden" name="idfichaJugador" id="idfichaJugador">
    
                <!-- ========================================== Inicio del id="formulario_gestion_talento" ========================================== -->
                    <table style="border: 0px solid #8f8f8f; width:100%;" id="formulario_gestion_talento">
                                            
                        <tbody>
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                    <h5 class="titulo-campo-talento">NUEVA INTERVENCIÓN</h5>
                                </td>
                            </tr>
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <td style="width: 100%; padding: 0px;">
                                    <div class="span12" style="display: flex; width: 100%;">
                                        <a class="btn btn-md btn-primary" style="width: 9%; border-bottom-left-radius:2px; border-top-left-radius:2px; font-size: 13px; background-color:<?php echo $color_fondo; ?> height: 22px;"> <span style="margin-right: 20px;">Fecha</span>
                                        </a>
                                        <input readonly class="date_fechaNacimiento" type="text" onchange="chequear_datos();" style="width:13%; -webkit-appearance: none; -moz-appearance : none; border: 2px solid <?php echo $color_fondo; ?> border-bottom-right-radius:2px; border-top-right-radius:2px; border-bottom-left-radius:0px; border-top-left-radius:0px; margin-bottom:0px; text-align:center; line-height: 16px;" name="fecha_cdp_intervindiv" id="fecha_cdp_intervindiv" />                            
                                    </div>
                                </td>                               
                            </tr>  
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                    <div class="div-tr-break"></div>
                                </td>
                            </tr>                                                                                                        
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <table style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="th-textarea">MOTIVO DE LA CONSULTA</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 100%; padding: 0px;">
                                                <div class="span12" style="display: flex; width: 100%;">
                                                    <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="motivoconsulta_cdp_intervindiv" id="motivoconsulta_cdp_intervindiv"></textarea>
                                                </div>
                                            </td>                                                  
                                        </tr>
                                    </tbody>
                                </table>                         
                            </tr>                             
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                    <div class="div-tr-break"></div>
                                </td>
                            </tr>                                                                                                        
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <table style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="th-textarea">OBJETIVOS (A través de la siguiente dinámica se espera que el jugador logre)</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 100%; padding: 0px;">
                                                <div class="span12" style="display: flex; width: 100%;">
                                                    <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="objetivos_cdp_intervindiv" id="objetivos_cdp_intervindiv"></textarea>
                                                </div>
                                            </td>                                                  
                                        </tr>
                                    </tbody>
                                </table>                         
                            </tr>
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                    <div class="div-tr-break"></div>
                                </td>
                            </tr>                                                                                                        
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <table style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="th-textarea">ACTIVIDAD</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 100%; padding: 0px;">
                                                <div class="span12" style="display: flex; width: 100%;">
                                                    <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="actividad_cdp_intervindiv" id="actividad_cdp_intervindiv"></textarea>
                                                </div>
                                            </td>                                                  
                                        </tr>
                                    </tbody>
                                </table>                         
                            </tr> 
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                    <div class="div-tr-break"></div>
                                </td>
                            </tr>                                                                                                        
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <table style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="th-textarea">INTERVENCIÓN O DINÁMICA</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 100%; padding: 0px;">
                                                <div class="span12" style="display: flex; width: 100%;">
                                                    <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="intervdinamica_cdp_intervindiv" id="intervdinamica_cdp_intervindiv"></textarea>
                                                </div>
                                            </td>                                                  
                                        </tr>
                                    </tbody>
                                </table>                         
                            </tr> 
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                    <div class="div-tr-break"></div>
                                </td>
                            </tr>                                                                                                        
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo">
                                <table style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th class="th-textarea">OBSERVACIONES</th>
                                        </tr> 
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="width: 100%; padding: 0px;">
                                                <div class="span12" style="display: flex; width: 100%;">
                                                    <textarea onkeyup="chequear_datos();" style="resize: none;" class="textarea-social" name="observaciones_cdp_intervindiv" id="observaciones_cdp_intervindiv"></textarea>
                                                </div>
                                            </td>                                                  
                                        </tr>
                                    </tbody>
                                </table>                         
                            </tr>                                                                                                                  
                            <!-- ============================================================================================================ -->
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; width: 100%;">
                                    <div class="div-tr-break"></div>
                                </td>
                            </tr>                                                                                                                                              
                            <tr class="sin_fondo" style="color:#555555;">
                                <td style="border-top-left-radius:5px; padding-top:30px; padding-bottom:5px; width: 100%;">
                                    <center>
                                        <button type="submit" class="boton_gestionar_cargos" onclick="boton_guardar();" id="boton_agregar_informe_carga">
                                            <i class="icon-save"></i> GUARDAR INFORME
                                        </button>
                                    </center>
                                </td>
                            </tr>
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
                        </tbody>
                                            
                    </table>    

                </form>        
                <!-- ========================================== Fin del id="formulario" ========================================== -->

            </div>
        </div>
    </div>      

</div>
<!-- ========================================== Fin del id="cuadro_formulario_guardar" ========================================== -->

  
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

<!-- ************************************************ Modal del PDF ************************************************ -->
<div id="descargarPDF" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?> border-top-right-radius: 5px; border-top-left-radius: 5px;">
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
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?> border-bottom-left-radius:10px; border-bottom-right-radius:10px;">     
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
            <img src="../config/cdp.png" style="width:75px; margin-top:5px;">
            
            <hr style="display: inline-block; margin-left: 30px; width: 250px; border: 1px solid #e3e3e3;">
            <h3 style="margin-left: 17px;"><center>CARGA DIARIA</center></h3>

            <!-- <div class="hr-line"></div>
            <fieldset>
                <legend>
                    <img src="../config/cdp.png" style="width:75px; margin-top:5px;">
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
        // $(this).attr("placeholder", "Escriba aquí...");
        $(this).attr("rows", "7");
    });

    // -------------------- Inicio de la función 'get_cantidad_jugadores_sexo_serie()' -------------------- // 
    function get_cantidad_jugadores_sexo_serie(){

        let array_sexo = [];
        let array_numero_serie = [];
        $(".cuadro_serie").each(function(i){

            let sexo = $(this).attr("sexo");
            let numero_serie = $(this).attr("numero-serie");

            array_sexo[i] = sexo;
            array_numero_serie[i] = numero_serie;

        });

        $.ajax({
            url: "post/cdp_ver_intervencion_individual.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
                'tipo_consulta': 0,    
                'array_sexo': array_sexo,
                'array_numero_serie': array_numero_serie
            },success: function(respuesta){
                var count = 1;
                var x = [];
                for(var i=0; i < respuesta.length; i++) {   
                    x[i] = respuesta[i];
                }

                $(".cantidad-jugadores").each(function(i){
                    let sexo = $(this).attr("sexo");
                    if( sexo == "1" ) {
                        $(this).html( '(' + x[i] + ')' + ' jugadores' );
                    } else {
                        $(this).html( '(' + x[i] + ')' + ' jugadoras' );
                    } 
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
    // -------------------- Fin de la función 'get_cantidad_jugadores_sexo_serie()' -------------------- //
    get_cantidad_jugadores_sexo_serie();

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
        $('#sin_resultados').hide();
        $('#cargando_buscar_perfil_jugador').show();
        $("#tabla_ver_perfil_jugador tbody").empty(); // <--- Vaciando tabla.
        var idfichaJugador = $(".idfichaJugador").val();

        var titulo_serie_reporte = $("#titulo_serie_reporte").val();
        titulo_serie_reporte = "'" + titulo_serie_reporte + "'";
        var sexo_seleccion_reporte = $("#sexo_seleccion_reporte").val();
        sexo_seleccion_reporte = "'" + sexo_seleccion_reporte + "'"; 

        // alert( titulo_serie_reporte + " - " + sexo_seleccion_reporte );

        $.ajax({
            url: "post/cdp_ver_intervencion_individual.php",
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
                    var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td colspan="11"><center><b>Aún no tiene informes</b></center></td></tr>';
                    $("#tabla_ver_perfil_jugador tbody").append(markup);
                    $("#graficos_informes_resumen").hide();
                    $('#cargando_buscar_perfil_jugador').hide();
                    $('#sin_resultados').show();
                    $('#boton_editar').hide();
                    $('.boton_refresh').hide();
                    $('#boton_agregar_informe_carga').prop("disabled", true);
                }else{              
                    $('#boton_agregar_informe_carga').prop("disabled", false); // <--- Habilitando el botón de guardar.
                    window.datos_intervencion_individual = respuesta; //se copian todos los profesores al cache
                    $("#tabla_ver_perfil_jugador tbody").empty();
                    var count = 1;

                    for(var i=0; i < respuesta.length; i++){              

                        let fecha_cdp_intervindiv = respuesta[i]['fecha_cdp_intervindiv'];
                        
                        // Día:
                        let dia_talento = fecha_cdp_intervindiv.substring(8, 10); 

                        // Mes:
                        let mes_talento = fecha_cdp_intervindiv.substring(5, 7);     

                        // Año:
                        let anio_talento = fecha_cdp_intervindiv.substring(0, 4); 

                        fecha_cdp_intervindiv = dia_talento + "-" + mes_talento + "-" + anio_talento;

                        var markup = 
                        '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;">\
                            <td class="td-valoracion" onclick="boton_editar('+i+')" style="max-width: 80px; width: 32px;">\
                                <p class="ellipsis-text" style="font-weight: bold; margin-bottom: 0px;">'+count+'</p>\
                                <input type="hidden" value="'+ respuesta[i]['idfichaJugador'] +'" name="id_ficha_jugador[]" />\
                            </td>\
                            <td class="td-valoracion" onclick="boton_editar('+i+')" style="text-align: left; font-weight: bold; max-width: 200px; width: 200px;">\
                                <p class="ellipsis-text">\
                                    '+fecha_cdp_intervindiv+'\
                                </p>\
                            </td>\
                            <td onclick="boton_editar('+i+')" class="td-valoracion" style="text-align: left; font-weight: bold; max-width: 250px; width: 250px;">\
                                <p class="ellipsis-text">\
                                    '+respuesta[i]['motivoconsulta_cdp_intervindiv']+'\
                                </p>\
                            </td>\
                            <td onclick="boton_editar('+i+')" class="td-valoracion" style="text-align: left; font-weight: bold; max-width: 250px; width: 250px;">\
                                <p class="ellipsis-text">\
                                    '+respuesta[i]['objetivos_cdp_intervindiv']+'\
                                </p>\
                            </td>\
                            <td style="padding: 7px; width: 9px;">\
                                <a class="boton_eliminar" onclick="descargarPDF('+respuesta[i]['idcdp_intervencion_individual']+', '+titulo_serie_reporte+', '+sexo_seleccion_reporte+');">\
                                    <i class="icon-download-alt"></i>\
                                </a>\
                            </td>\
                            <td style="padding: 7px; width: 9px;">\
                                <a class="boton_eliminar" onClick="boton_editar('+i+');">\
                                    <i class="icon-pencil"></i>\
                                </a>\
                            </td>\
                            <td style="padding: 7px; width: 9px;">\
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
    // -------------------- Fin de la función 'buscar_visitas_jugador_social()' -------------------- //


// -------------------------- Inicio de la función 'boton_ver_perfil_jugador()' - AGREGAR (INSERT) --------------------------- //
function boton_ver_perfil_jugador( linea ){

    window.idcdp_intervencion_individual ='';

    // alert( idfichaJugador + ' - ' + nombre_completo_jugador + ' - ' + edad + ' - ' + numero_posicion );
    $(".idfichaJugador").val( datos_intervencion_individual[linea]['idfichaJugador'] );
    $(".nombre-jugador").html( datos_intervencion_individual[linea]['nombre'] + " " + datos_intervencion_individual[linea]['apellido1'] + " " + datos_intervencion_individual[linea]['apellido2'] );    

    // Posición:
    let posicion;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_intervencion_individual[linea]['posicion0'] === null || datos_intervencion_individual[linea]['posicion0'] == '0' || datos_intervencion_individual[linea]['posicion0'] == '' || datos_intervencion_individual[linea]['posicion0'] == '999' ) {
        posicion = 'Posición no especificada';
    } else {
        posicion = parseInt( datos_intervencion_individual[linea]['posicion0'] );
        posicion = array_posiciones[posicion][1];
    }

    // Pie Hábil:
    let dinamico;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_intervencion_individual[linea]['dinamico'] === null || datos_intervencion_individual[linea]['dinamico'] == '0' || datos_intervencion_individual[linea]['dinamico'] == '' ) {
        dinamico = 'Pie hábil no especificado';
    } else {
        dinamico = parseInt( datos_intervencion_individual[linea]['dinamico'] );
        if( dinamico === 3 ) { // <---- Ambidiestro.
            dinamico = 'Ambidiestro';
        } else {
            dinamico = 'Pie ' + array_lateralidad[dinamico][1];
        }
        
    }   

    // Edad:
    let edad;
    // Validando datos (nulos, vacíos, '0', '0000-00-00', ect):
    if( datos_intervencion_individual[linea]['fechaNacimiento'] === null || datos_intervencion_individual[linea]['fechaNacimiento'] == '0000-00-00' || datos_intervencion_individual[linea]['fechaNacimiento'] == '' ) {
        edad = '0 años (no especificado), ';
    } else {
        edad = calcularEdad( datos_intervencion_individual[linea]['fechaNacimiento'] ) + ' Años, ';
    }

    let datos_jugador = edad + posicion + ", " + dinamico;

    $(".datos-jugador").html( datos_jugador );

    $(".imagen-jugador").attr("src", "foto_jugadores/" + datos_intervencion_individual[linea]['idfichaJugador'] + '.png');
    

    $('#cuadro_serie_selected').hide(500);
    $('#cuadro_perfil_jugador_selected').show(500);
        
    buscar_visitas_jugador_social();

/*
    window.idcdp_intervencion_individual ='';

    // alert( idfichaJugador + ' - ' + nombre_completo_jugador + ' - ' + edad + ' - ' + numero_posicion );
    $(".idfichaJugador").val( datos_intervencion_individual[linea]['idfichaJugador'] );
    $(".nombre-jugador").html( datos_intervencion_individual[linea]['nombre'] + " " + datos_intervencion_individual[linea]['apellido1'] + " " + datos_intervencion_individual[linea]['apellido2'] );    

    let posicion = parseInt( datos_intervencion_individual[linea]['numero_posicion'] );
    switch( posicion ) {
        case 1:
            posicion = "Arquero";
            break;
        case 2:
            posicion = "Defensa";
            break;
        case 3:
            posicion = "Mediocampista";
            break;
        default:
            posicion = "Delantero";
            break;                                    

    }

    let dinamico = parseInt( datos_intervencion_individual[linea]['dinamico'] );
    switch( dinamico ) {
        case 0:
            dinamico = "Derecho";
            break;
        case 1:
            dinamico = "Izquierdo";
            break;
        case 2:
            dinamico = "Ambidiestro";
            break;                                
        default:
            dinamico = "Indefinido";
            break;  
    }    

    let edad = calcularEdad( datos_intervencion_individual[linea]['fechaNacimiento'] );
    let datos_jugador = edad + " años, " + posicion + ", Pie " + dinamico;

    $(".datos-jugador").html( datos_jugador );

    $(".imagen-jugador").attr("src", "foto_jugadores/" + datos_intervencion_individual[linea]['idfichaJugador'] + '.png');
    

    var titulo_serie = $(".titulo_serie").html();
    var sexo_seleccion = $(".sexo_seleccion").html();

    $("#titulo_serie_reporte").val( titulo_serie );
    $("#sexo_seleccion_reporte").val( sexo_seleccion );

    $('#cuadro_serie_selected').hide(500);
    $('#cuadro_perfil_jugador_selected').show(500);
        
    buscar_visitas_jugador_social();
*/

}

// -------------------------- Inicio de la función 'boton_agregar_informe_carga()' - AGREGAR (INSERT) --------------------------- //
function boton_agregar_informe_carga(){
    window.idcdp_intervencion_individual='';
    $("#tabla_ver_informes tbody").empty();

    var idfichaJugador = $(".idfichaJugador").val();        
    // alert( idfichaJugador );
    $("#idfichaJugador").val( idfichaJugador );
    

    $('#cuadro_perfil_jugador_selected').hide(500);
    $('#cuadro_formulario_guardar').show(500);
    $("#boton_agregar_informe_carga").prop("disabled", true); 
    $("#formulario")[0].reset();  

    let fecha_actual = "<?php echo date("Y-m-d"); ?>";  
    $("#fecha_cdp_intervindiv").val( fecha_actual );   

    chequear_datos();

    $("#formulario input[type='text']").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    });
    $("#formulario textarea").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    });

}
// -------------------------- Fin de la función 'boton_agregar_informe_carga()' - AGREGAR (INSERT) --------------------------- //

// -------------------------- Inicio de la función 'boton_editar( idcdp_intervencion_individual )' - EDITAR (UPDATE) --------------------------- //
function boton_editar( linea ){
    
    // alert( window.idcdp_intervencion_individual );
    window.idcdp_intervencion_individual = datos_intervencion_individual[linea]['idcdp_intervencion_individual'];
    $("#fecha_cdp_intervindiv").val( datos_intervencion_individual[linea]['fecha_cdp_intervindiv'] );
    $("#motivoconsulta_cdp_intervindiv").val( datos_intervencion_individual[linea]['motivoconsulta_cdp_intervindiv'] );
    $("#objetivos_cdp_intervindiv").val( datos_intervencion_individual[linea]['objetivos_cdp_intervindiv'] );
    $("#actividad_cdp_intervindiv").val( datos_intervencion_individual[linea]['actividad_cdp_intervindiv'] );
    $("#intervdinamica_cdp_intervindiv").val( datos_intervencion_individual[linea]['intervdinamica_cdp_intervindiv'] );
    $("#observaciones_cdp_intervindiv").val( datos_intervencion_individual[linea]['observaciones_cdp_intervindiv'] );

    // -------------------------------------------------------- //
    // alert( idfichaJugador + ' - ' + nombre_completo_jugador + ' - ' + edad + ' - ' + numero_posicion );
    $(".idfichaJugador").val( datos_intervencion_individual[linea]['idfichaJugador'] );
    $(".nombre-jugador").html( datos_intervencion_individual[linea]['nombre'] + " " + datos_intervencion_individual[linea]['apellido1'] + " " + datos_intervencion_individual[linea]['apellido2'] );    

    let posicion = parseInt( datos_intervencion_individual[linea]['numero_posicion'] );
    switch( posicion ) {
        case 1:
            posicion = "Arquero";
            break;
        case 2:
            posicion = "Defensa";
            break;
        case 3:
            posicion = "Mediocampista";
            break;
        default:
            posicion = "Delantero";
            break;                                    

    }

    let dinamico = parseInt( datos_intervencion_individual[linea]['dinamico'] );
    switch( dinamico ) {
        case 0:
            dinamico = "Derecho";
            break;
        case 1:
            dinamico = "Izquierdo";
            break;
        case 2:
            dinamico = "Ambidiestro";
            break;                                
        default:
            dinamico = "Indefinido";
            break;  
    }    

    // ---------------------------- Calculando la edad del jugador ---------------------------- //
    let edad = calcularEdad( datos_intervencion_individual[linea]['fechaNacimiento'] );
    
    let datos_jugador = edad + " años, " + posicion + ", Pie " + dinamico;

    $(".datos-jugador").html( datos_jugador );

    $(".imagen-jugador").attr("src", "foto_jugadores/" + datos_intervencion_individual[linea]['idfichaJugador'] + '.png');
    // -------------------------------------------------------- //

    $('#cuadro_perfil_jugador_selected').hide(500);    
    $('#cuadro_formulario_guardar').show(500);

    chequear_datos();

    $("#formulario input[type='text']").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    });
    $("#formulario textarea").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    });

}
// -------------------------- Fin de la función 'boton_editar( idcdp_intervencion_individual )' - EDITAR (UPDATE) --------------------------- //

function boton_eliminar( linea ){
    window.idcdp_intervencion_individual= datos_intervencion_individual[linea]['idcdp_intervencion_individual'];
    // alert( idcdp_intervencion_individual );
    $('#myModal2').modal('show');
    $('#mensaje_eliminar_proveedor').html('<h5>¿Estás seguro que quieres eliminar este informe?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
}

function eliminar_informe() {

    //alert( window.idcdp_intervencion_individual );

     $('.boton_modal').hide();
     $('#mensaje_eliminar_proveedor').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando informe...</h5><br><img src="../config/remover_archivo.png">');
     $.ajax({
        url: "post/cdp_eliminar_intervencion_individual.php",
        type: "post",
        data: {
            'idcdp_intervencion_individual': window.idcdp_intervencion_individual
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
    // alert( window.idcdp_intervencion_individual );
    if (window.idcdp_intervencion_individual != "" ) {
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }
    

    $('#myModalDescargarBoleta').modal('show');
    $('.boton_modal').css('display','');
}


function guardar_registro(){
    $('.boton_modal').css('display','none');

    if(window.idcdp_intervencion_individual!=""){
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }

    var data = $('#formulario').serializeArray();
    data.push({name: 'idcdp_intervencion_individual',  value: window.idcdp_intervencion_individual});
    // data.push({name: 'id_jugador',  value: window.id_jugador});
    data.push({name: 'nombre_usuario_software', value: '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>'});
    
    // alert(JSON.stringify(data));
    $.ajax({
        url: "post/cdp_guardar_intervencion_individual.php",
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
        sexo_seleccion = '(Hombres)';
    } else {
        sexo_seleccion = '(Mujeres)';
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
            url: "post/cdp_ver_intervencion_individual.php",
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
                var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555;" id="informe_"><td colspan="11"><b>No se encontraron visitas</b></td></tr>';
                $("#tabla_ver_informes_todos tbody").append(markup);
                $("#graficos_informes_resumen").hide();
                $('#cargando_buscar').hide();
                $('#sin_resultados').show();
                $('#boton_editar').hide();
                $('.boton_refresh').hide();
                $('#boton_agregar_informe_carga').prop("disabled", true);
            }else{              
                window.datos_intervencion_individual = respuesta; //se copian todos los profesores al cache
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
                    let nombre_completo_jugador = respuesta[i]['nombre'] + ' ' + respuesta[i]['apellido1'] + ' ' + respuesta[i]['apellido2'];
                    
                    // Fecha de Nacimiento:
                    let fechaNacimiento;
                    if( respuesta[i]['fechaNacimiento'] == '0000-00-00' || respuesta[i]['fechaNacimiento'] == '' || respuesta[i]['fechaNacimiento'] === null ) {
                        fechaNacimiento = 'No especificado';
                    } else {
                        fechaNacimiento = fecha_formato_ddmmaaa( respuesta[i]['fechaNacimiento'] );
                    }
                    
                    // Edad:
                    let edad;
                    if( respuesta[i]['fechaNacimiento'] == '0000-00-00' || respuesta[i]['fechaNacimiento'] == '' || respuesta[i]['fechaNacimiento'] === null ) {
                        edad = 'No especificado';
                    } else {
                        edad = calcularEdad( respuesta[i]['fechaNacimiento'] ) + ' años';
                    }
                                 
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
                        rut = '-';
                    }

                    let num_grupo_posicion = array_posiciones[posicion0][2];
                    let nombre_grupo_posicion = array_posiciones[posicion0][3]; 
                                 
                    // alert( respuesta[i]['idcdp_intervencion_individual'] );
                    if( typeof respuesta[i]['idcdp_intervencion_individual'] === 'undefined' ) {

                        var markup = 
                        '<tr class="panel_buscar tr_posicion_jugador_'+posicion0+'" style="height:0px; cursor:pointer; color:#555555;" num-grupo-posicion="'+num_grupo_posicion+'" nombre-grupo-posicion="'+nombre_grupo_posicion+'">\
                            <td onClick="boton_ver_perfil_jugador('+i+');">\
                                <b>'+count+'</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" style="text-align: left;">\
                                <b>' + nombre_posicion + '</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" style="text-align: left;">\
                                <img src="foto_jugadores/'+idfichaJugador+'.png" class="imagen-jugador" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;"> \
                                <b>' + respuesta[i]['nombre'] + ' ' + respuesta[i]['apellido1'] + ' ' + respuesta[i]['apellido2'] + '</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                                <b>'+respuesta[i]['rut']+'</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                                <b>'+respuesta[i]['fechaNacimiento']+'</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                                <b>'+edad+' años</b>\
                            </td>\
                            <td style="padding: 7px;">\
                                <i class="icon-paper-clip"></i> <b>(0) informes</b>\
                            </td>\
                        </tr>';

                    } else {

                        var markup = 
                        '<tr class="panel_buscar tr_posicion_jugador_'+posicion0+'" style="height:0px; cursor:pointer; color:#555555;" num-grupo-posicion="'+num_grupo_posicion+'" nombre-grupo-posicion="'+nombre_grupo_posicion+'">\
                            <td onClick="boton_ver_perfil_jugador('+i+');">\
                                <b>'+count+'</b>\
                            </td>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" style="text-align: left;">\
                                <b>' + nombre_posicion + '</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" style="text-align: left;">\
                                <img src="foto_jugadores/'+idfichaJugador+'.png" class="imagen-jugador" style="width: 25px; border-radius: 50%; border: solid 2px;height:25px;margin-right: 5px;"> \
                                <b>' + respuesta[i]['nombre'] + ' ' + respuesta[i]['apellido1'] + ' ' + respuesta[i]['apellido2'] + '</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                                <b>'+respuesta[i]['rut']+'</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                                <b>'+respuesta[i]['fechaNacimiento']+'</b>\
                            </td>\
                            <td onClick="boton_ver_perfil_jugador('+i+');" class="td-valoracion">\
                                <b>'+edad+' años</b>\
                            </td>\
                            <td style="padding: 7px;">\
                                <i class="icon-paper-clip"></i> <b>('+respuesta[i]['cantidad_informes_cdp_interindiv']+') informes</b>\
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

function boton_volver_cuadro_listado_series() {
    $('#cuadro_serie_selected').hide(500);
    $('#cuadro_listado_series').show(500);
    get_cantidad_jugadores_sexo_serie();
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
        
    // ------------------------------------------------------------------------ //
    let fecha_cdp_intervindiv = $("#fecha_cdp_intervindiv").val();
    if( fecha_cdp_intervindiv == "" ) {
        $("#fecha_cdp_intervindiv").css("background-color", "white"); // <--- Color blanco.
        // flag = false;
    } else {
        $("#fecha_cdp_intervindiv").css("background-color", "white");
    }

    // ------------------------------------------------------------------------ //
    let motivoconsulta_cdp_intervindiv = $("#motivoconsulta_cdp_intervindiv").val();
    if( motivoconsulta_cdp_intervindiv != "" ) {
        if( motivoconsulta_cdp_intervindiv.match(ER_caracteresAlfaNumericos) && ( parseInt(motivoconsulta_cdp_intervindiv.length) >= 1 && parseInt(motivoconsulta_cdp_intervindiv.length) <= 2000 ) ) {      
            $("#motivoconsulta_cdp_intervindiv").css("background-color", "white");
        } else {
            $("#motivoconsulta_cdp_intervindiv").css("background-color", "#ffc6c6");
            flag = false;
        }
    } else {
        $("#motivoconsulta_cdp_intervindiv").css("background-color", "#ffc6c6");
        flag = false;
    }

    // ------------------------------------------------------------------------ //
    let objetivos_cdp_intervindiv = $("#objetivos_cdp_intervindiv").val();
    if( objetivos_cdp_intervindiv != "" ) {
        if( objetivos_cdp_intervindiv.match(ER_caracteresAlfaNumericos) && ( parseInt(objetivos_cdp_intervindiv.length) >= 1 && parseInt(objetivos_cdp_intervindiv.length) <= 2000 ) ) {      
            $("#objetivos_cdp_intervindiv").css("background-color", "white");
        } else {
            $("#objetivos_cdp_intervindiv").css("background-color", "#ffc6c6");
            flag = false;
        }
    } else {
        $("#objetivos_cdp_intervindiv").css("background-color", "white");
        // flag = false;
    }

    // ------------------------------------------------------------------------ //
    let actividad_cdp_intervindiv = $("#actividad_cdp_intervindiv").val();
    if( actividad_cdp_intervindiv != "" ) {
        if( actividad_cdp_intervindiv.match(ER_caracteresAlfaNumericos) && ( parseInt(actividad_cdp_intervindiv.length) >= 1 && parseInt(actividad_cdp_intervindiv.length) <= 2000 ) ) {      
            $("#actividad_cdp_intervindiv").css("background-color", "white");
        } else {
            $("#actividad_cdp_intervindiv").css("background-color", "#ffc6c6");
            flag = false;
        }
    } else {
        $("#actividad_cdp_intervindiv").css("background-color", "white");
        // flag = false;
    }
        
    // ------------------------------------------------------------------------ //
    let intervdinamica_cdp_intervindiv = $("#intervdinamica_cdp_intervindiv").val();
    if( intervdinamica_cdp_intervindiv != "" ) {
        if( intervdinamica_cdp_intervindiv.match(ER_caracteresAlfaNumericos) && ( parseInt(intervdinamica_cdp_intervindiv.length) >= 1 && parseInt(intervdinamica_cdp_intervindiv.length) <= 2000 ) ) {      
            $("#intervdinamica_cdp_intervindiv").css("background-color", "white");
        } else {
            $("#intervdinamica_cdp_intervindiv").css("background-color", "#ffc6c6");
            flag = false;
        }
    } else {
        $("#intervdinamica_cdp_intervindiv").css("background-color", "white");
        // flag = false;
    }

    // ------------------------------------------------------------------------ //
    let observaciones_cdp_intervindiv = $("#observaciones_cdp_intervindiv").val();
    if( observaciones_cdp_intervindiv != "" ) {
        if( observaciones_cdp_intervindiv.match(ER_caracteresAlfaNumericos) && ( parseInt(observaciones_cdp_intervindiv.length) >= 1 && parseInt(observaciones_cdp_intervindiv.length) <= 2000 ) ) {      
            $("#observaciones_cdp_intervindiv").css("background-color", "white");
        } else {
            $("#observaciones_cdp_intervindiv").css("background-color", "#ffc6c6");
            flag = false;
        }
    } else {
        $("#observaciones_cdp_intervindiv").css("background-color", "white");
        // flag = false;
    }

    if( flag === false ){
        $('#boton_agregar_informe_carga').prop("disabled", true);
    }else{
        $('#boton_agregar_informe_carga').prop("disabled", false);
        // alert("Formulario validado");
    }

}

function closeModal_pdf(){
    $("#descargarPDF").modal('hide');
}

// --------------------------------------- Inicio de la función descargarPDF() --------------------------------------- //
function descargarPDF( idcdp_intervencion_individual, titulo_serie_reporte, sexo_seleccion_reporte ){

console.log("ID Intervención Individual: " + idcdp_intervencion_individual );

// alert( titulo_serie_reporte + " - " + sexo_seleccion_reporte );

if( sexo_seleccion_reporte == '(Hombres)') {
    sexo_seleccion_reporte = '(Masculino)';
} else {
    sexo_seleccion_reporte = '(Femenina)';
}

// alert( sexo_seleccion_reporte );

$("#descargarPDF").modal('show');
$('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');

    $.ajax({
        url: "post/reportes/generarPDF_cdp_intervindiv.php",
        type: "post",
        data: {
            idcdp_intervencion_individual,
            titulo_serie_reporte,
            sexo_seleccion_reporte
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

</script>