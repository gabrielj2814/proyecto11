<?php
    include('../config/datos.php');
    session_start();
    if(!(isset($_SESSION["nombre_usuario_software"]))){
        session_destroy();
        header('Location: ../index.php?cerrar_sesion=1');
    }else{
        $menu_actual="campeonato";
        $submenu_actual="campeonato";
        $seccion_comentarios = $comentarios['campeonato'];//mis cuotas
        $demo_seccion = $demo['campeonato'];
        $nombre_pestana_navegador='Campeonato';
        
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
<title><?php echo $nombre_pestana_navegador;?> | Campeonato</title>

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
    
    .boton_add{
        padding-left: 7px;
        padding-right: 7px;
        text-shadow: none; 
        background-color: transparent;
        border: 3px solid <?php echo $color_fondo; ?>; 
        color: <?php echo $color_fondo; ?>;
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

/* ---------------- Estilos -------------------*/

.cuadro_serie_masculino{
    cursor: pointer;
    text-shadow: none; 
    background-color: #1d9663;
    color: white;
    border-radius:10px;
}   
.cuadro_serie_masculino:hover{
    background-color: #23b276;
}   

.cuadro_serie_femenino{
    cursor: pointer;
    text-shadow: none; 
    background-color: #E420A1;
    color: white;
    border-radius:10px;
}   
.cuadro_serie_femenino:hover{
    background-color: #F82FB3;
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

    #tabla_ver_campeonatos_todos tbody tr {
        text-align: center;
    }

    #tabla_ver_campeonatos_todos thead tr {
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

#tabla_ver_campeonatos_todos thead tr {
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

#boton_agregar_campeonato:enabled {
    cursor: pointer;
}

#boton_agregar_campeonato:disabled {
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

.row-form-jugador {
    width: 100%;
    margin-bottom: 50px;
    height: 5px;
}

div#div_file {
    border: 3px solid <?php echo $color_fondo; ?>;
    position: relative;
    margin: auto;
    width: 170px;
}

p#texto {
    text-align: center;
    color: <?php echo $color_fondo; ?>;
    margin: 0;
    font-weight: 600;
}

input#foto_campeonato {
    position: absolute;
    top: 0px;
    left: 0px;
    right: 0px;
    bottom: 0px;
    width: 100%;
    height: 100%;
    opacity: 0;
}

.img-next-to-text {
    float:left;
    display:block;
    position:relative;
    width:30px;
}

/*
.img-next-to-text img {
    height: 30px;
    max-height: 30px;
}
*/

.div-club-table {
    text-align: center;
    max-width: 150px;
}

select {
  text-align: center;
  text-align-last: center;
  color: black
}
option {
  text-align: center;
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

var idcampeonato = "";
var datos_campeonato = {};

var ano_actual = '<?php echo $ano_actual;?>';
var mes_actual = parseInt('<?php echo $mes_actual;?>');

var error_foto = 0;

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

// ----------------------- Inicio de la función 'subir_imagen_campeonato()' ----------------------- // 
function subir_imagen_campeonato(){
    var file = document.forms['formulario_campeonato']['foto_campeonato'].files[0];
    var imagefile = file.type;
    var imagesize = file.size;
    var match= ["image/jpeg","image/png","image/jpg"];
    if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
        if(window.error_foto!=1){//1=copia camiseta (AGREGAR)
            window.error_foto=1;
        }else{
            window.error_foto=3; //no se copia nada
        }
        $("#message_foto_campeonato").html("<span id='error_message' style='color:#f76b0e; font-size:10px;'><i class='icon-remove'></i><b>Error:</b> solo formato jpg o png</span>");
    }else if(imagesize > 4000000){  
        if(error_foto!=1){//1=copia camiseta (AGREGAR)
            window.error_foto=1;
        }else{
            window.error_foto=3; //no se copia nada
        }
        $("#message_foto_campeonato").html("<span id='error_message' style='color:#f76b0e; font-size:10px;'><i class='icon-remove'></i><b>Error:</b> tamaño máximo 4[mb]</span>");
    }else{
        window.error_foto=4;
        
        $("#message_foto_campeonato").html("");
    }
    return window.error_foto;
}
// ----------------------- Fin de la función 'subir_imagen_campeonato()' ----------------------- //

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
        $('#boton_agregar_campeonato').attr('disabled', true);   
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
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon-truck"></i> CAMPEONATO <i class="icon-chevron-right"></i> Campeonato</a>
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
            <i class="icon-truck"></i> CAMPEONATO
        </a> 
        <a class="current">
            Campeonato
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
cuadro_campeonato_main
cuadro_formulario_guardar
-->

<!-- ========================================== Inicio del id="cuadro_campeonato_main" ========================================== -->
<div id="cuadro_campeonato_main">

<!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
<div class="cuadro_buscar_titulo" style="margin-top: -10px;">



<div class="row-fluid" style="margin-top:0px;width: 100%;">
    <!--
    <div class="span12" style="margin-top: 15px;margin-bottom: 34px;">
        <div style="color:black; font-family:Arial, Helvetica, sans-serif;margin-bottom: 10px">
            <img class="foto-pais-clubpais-tipo1" src="../config/campeonato.png" style="width: 60px;position: relative;top: 15px;">
            <p style="left: 10px;margin-top: 0px;display: inline-block;font-weight: bold;font-size: 24px;position: relative;top: 5px; text-transform: uppercase;">Campeonatos</p>
        </div>                                  
    </div>
    -->
    <table style="color:black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
        <tr class="sin_fondo">
            <td style="padding:12px; padding-top:15px;"><img src="../config/campeonato.png" style="height: 100px; margin-top:5px;"></td>
            <td>
                <center>
                    <h3 class="titulo_principal" style="text-transform: uppercase;">Campeonatos</h3>
                    <p style="margin: 0px;">En esta sección puedes crear, visualizar, modifcar y eliminar campeonatos de fútbol.</p>                    
                </center>
            </td>
        </tr>
    </table>

</div>

<br>



<div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px; border-radius: 4px;">

</div>

</div>
<!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->

                        <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:30px;">
                          
                            <center>
                                <div style=" width:500px; margin-bottom:10px; display: inline-block;">
                                    <table border="0">
                                        <tr class="sin_fondo">
                                            <td style="width:330px; padding-left:40px;"><input class="ph-center" name="buscar_nombre" style="width:96%; background-color:white; border: 3px solid #555555; border-radius:20px; margin-bottom:0px;padding-left: 10px; height: 24px;" placeholder="Nombre del Campeonato o Vacío para Ver Todos" maxlength="149" id="buscar_nombre" onkeyup="buscador();" onkeydown="buscador();" ></td>
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
                                
                                <button style="margin-bottom:10px; margin-top: 0px; float:right;" class="boton_informe_jugador" onclick="boton_ir_form_guardar();"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar campeonato</b></button>
                                
                                <div class="span12" style="margin: 0px;">
                                    <table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_ver_campeonatos_todos">
                                        <thead>
                                            <tr style="background-color:#555555; color:white;">
                                                <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px; width: 25px;">
                                                  <div class="tip-top" data-original-title="Número" style="width:100%;">#</div>
                                              </th>
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 100px; text-align: center;">
                                                    <div class="tip-top" data-original-title="Fecha" style=" cursor: pointer; padding: 0px;">FECHA</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px; width: 100px; text-align: left;">
                                                    <div class="tip-top" data-original-title="País" style="width:100%;">PAÍS</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;width: 300px;">
                                                    <div class="tip-top" data-original-title="Campeonato" style="width:310px;">CAMPEONATO</div>
                                                </th>                                                
                                                <th scope="col" style="cursor:pointer; padding:0px;text-align: center;width: 200px; ">
                                                    <div class="tip-top" data-original-title="Organizador" style="width:100%;">ORGANIZADOR</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;text-align: left; width: 300px;">
                                                    <div class="tip-top" data-original-title="División" style="width:100%;">DIVISIÓN</div>
                                                </th>
                                                
                                                <th scope="col" style="cursor:pointer; padding:0px; border-top-right-radius:5px; width:140px;" colspan="2"></th>
                                            </tr>

                                        </thead>
                                        
                                        <tbody><!-- AQUÍ SERÁN INSERTADOS CON JS --></tbody>
                                        
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
<!-- ========================================== Fin del id="cuadro_campeonato_main" ========================================== -->


<!-- ========================================== Inicio del id="cuadro_formulario_guardar" ========================================== -->
<!-- <br><center><h1>----------</h1></center><br> -->
<div style="display:none" id="cuadro_formulario_guardar">



    <!-- ========================================== Inicio del class="cuadro_buscar_titulo" ========================================== -->
    <div class="cuadro_buscar_titulo">

        <!-- <div style="width:100%; background-color:<?php echo $color_fondo; ?>; height:20px;"></div> -->
    </div>
    <!-- ========================================== Fin del class="cuadro_buscar_titulo" ========================================== -->
    
<div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:60px;">
        
        <div class="row-fluid" style="margin-top:0px;">
            <div class="span12" style="margin: 0px;">
                <button class="boton_volver" onclick="boton_volver_campeonato_main();" style="float:left; margin:0px; margin-top: 20px;">
                    <i class="icon-arrow-left"></i> volver
                </button>                      
            </div>          
        </div> 

        <div class="row-fluid" style="margin-top:0px;">

            <div class="span12" style="margin-top: -10px; margin-left: 0;">

                <!-- ========================================== Inicio del id="formulario_campeonato" ========================================== -->
                <form method="post" ng-model="formulario_campeonato" name="formulario_campeonato" id="formulario_campeonato" novalidate="" class="ng-pristine ng-untouched ng-valid ng-not-empty">

                    <div style="width: 100%">
                        
                        <div style="width: 40%; float: left; margin-top: 20px;">

                            <!--
                            <img src="foto_jugadores/13.png" class="imagen-jugador" style="width: 220px; border-radius: 50%; border: solid #24ac5f 5px; height: 190px; display: block; margin: auto; margin-bottom: 10px;" id="foto-campeonato-img">
                            <div id="div_file">
                                <p id="texto"><i class="icon-cloud-upload"></i> Subir foto (.jpg o png)</p>
                                <input type="file" class="custom-file-input" id="foto_campeonato" name="foto_campeonato" required="" accept=".jpg, .png, .jpeg" onchange="readURL(this);">
                                <input type="hidden" name="foto_anterior_campeonato" id="foto_anterior_campeonato" value="sinFoto">
                            </div> 
                            -->

                          <center>
                            <div id="image_preview_campeonato" style="border: 6px solid <?php echo $color_fondo; ?>; width:180px; height:180px;  border-radius:100px;">
                                <img id="foto-campeonato" src="../config/cargando_logo_final.gif" style="width:180px; border-radius:100px; height:180px;" class="img-thumbnail"/>
                            </div>  
                            <label for="foto_campeonato" class="boton_gestionar_cargos subiendo_foto" style="width:170px; margin-top:10px;">
                                <i class="icon-cloud-upload"></i> Subir foto (.jpg o .png)
                            </label>
                            <input type="file" name="foto_campeonato" id="foto_campeonato" value="Seleccionar foto"  style="display:none;"/>
                            <input type="hidden" name="foto_anterior_campeonato" id="foto_anterior_campeonato" value="sinFoto">
                            <div id="message_foto_campeonato">
                            </div>
                          </center> 
                                                 
                        </div>

                        <div style="width: 60%; float: left;">
                           
                            <div>
                                <p style="color: black; font-weight: bold; text-transform: uppercase; text-align: center;">Nuevo campeonato</p>
                            </div>

                           <div class="row-form-jugador">
                                <div class="span6" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        País
                                    </a>
                                    <select class="green-input select-pais-form" id="pais_campeonato" name="pais_campeonato" onchange="get_divisiones_from_pais( 1 );"></select>
                                </div>  
                                <!-- ======================================================================== -->
                                <div class="span6" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Nombre
                                    </a>
                                    <input class="green-input" name="nombre_campeonato" id="nombre_campeonato" onkeyup="chequear_datos();" onkeydown="chequear_datos();">
                                </div>
                           </div>
                           <!-- ============================================================================================== -->
                           <div class="row-form-jugador">
                                <div class="span6" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        División
                                    </a>
                                    <select class="green-input select-division-form" id="division_campeonato" name="division_campeonato" onchange="chequear_datos();">
                                        <option value="">Seleccione primero un país</option>
                                    </select>
                                </div>
                                <!-- ======================================================================== -->
                                <div class="span6" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Organizador
                                    </a>
                                    <input class="green-input" id="organizador_campeonato" name="organizador_campeonato" onkeyup="chequear_datos();" onkeydown="chequear_datos();">
                                </div>                                                              
                           </div>
                           <!-- ============================================================================================== -->
                           <div class="row-form-jugador">
                                <div class="span6" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a"> 
                                        Fecha
                                    </a>
                                    <input readonly class="green-input date_fechaNacimiento" id="fecha_campeonato" name="fecha_campeonato" onchange="chequear_datos();" />
                                </div>                                                           
                           </div>                           
                                                                                                                                     
                        </div>                  

                    </div>

                </form>        
                <!-- ========================================== Fin del id="formulario_campeonato" ========================================== -->

            </div>

            <div class="span12" style="margin-top: 20px;">
                <center>
                    <button type="submit" class="boton_gestionar_cargos" onclick="boton_guardar_campeonato();" id="boton_agregar_campeonato" disabled="">
                        <i class="icon-save"></i> GUARDAR
                    </button>
               </center>     
            </div>  
        </div>


        <div class="row-fluid" style="margin-top:0px;">
            <div class="span12" style="margin: 0px;">
                <button class="boton_volver" onclick="boton_volver_campeonato_main();" style="float:left; margin:0px; margin-top: 20px;">
                    <i class="icon-arrow-left"></i> volver
                </button>                      
            </div>          
        </div> 

    </div>    

</div>
<!-- ========================================== Fin del id="cuadro_formulario_guardar" ========================================== -->

  
<div id="modal_formulario_campeonato" class="modal hide" style="border-radius:10px;">
    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
     <center>
            <br>
            <div id="mensaje_agregar_campeonato">
              <h5>¿Estás seguro que quieres generar un reporte excel?</h5>
              </div>
            <br>
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal " onClick="guardar_campeonato();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
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
          <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button> <button type="button" class="btn btn-default boton_modal" onClick="eliminar();" ng-click="desactivarBotonEliminarProveedor()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> </center>
        
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
     
<!-- ========================================================== Inicio del id="uploadImageModalCampeonato" ========================================================== -->
<div id="uploadImageModalCampeonato" class="modal hide" role="dialog" style="border-radius:10px;">
    <div class="modal-header" style="background-color:<?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
       <button type="button" class="close" data-dismiss="modal">&times;</button>
          <center><h4 class="modal-title"><img src="../config/logo3.png" style="height:30px; width:265px;"></h4></center>
    </div>
    <div class="modal-body" style="color:white; font-family:Arial, Helvetica, sans-serif; background-color:black;">
     <center>
        <div class="imagen_subir_campeonato" id="image_demo_campeonato" style="width:350px; margin-top:10px;"></div>      
        <div class="texto_subir_campeonato" style="margin-top:10px;"></div>    
        <!--<button class="btn btn-success crop_image">USAR ESTA IMAGEN</button>-->     
     </center>
    </div>
      <div class="modal-footer" style="background-color:<?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
          <center>
          <button type="button" id="crop_image_campeonato" class="btn btn-default boton_modal" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> USAR ESTA IMAGEN</button></center>
    </div>
</div>
<!-- ========================================================== Fin del id="uploadImageModalCampeonato" ========================================================== -->      
      
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

// ------------------------ Inicio de la función que carga foto en la etiqueta <img> del jugador ------------------------ //
function readURL(input) {
    chequear_datos();
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#foto-campeonato-img')
                .attr('src', e.target.result)
                .width(220)
                .height(190);
        };
        reader.readAsDataURL(input.files[0]);
    }
}
// ------------------------ Fin de la función que carga foto en la etiqueta <img> del jugador ------------------------ //

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
        [1, "SUB-8", 8, "Jesús Estrada"],
        [1, "SUB-9", 9, "Arturo Medina"],
        [1, "SUB-10", 10, "Juan Carrasco"],
        [1, "SUB-11", 11, "Fabián Quiroz"],
        
        [1, "SUB-12", 12, "Miguel Valenzuela"],
        [1, "SUB-13", 13, "Alexis Rivero"],
        [1, "SUB-14", 14, "Germán Calderón"],
        [1, "SUB-15", 15, "Ernesto Quintero"],
        
        [1, "SUB-16", 16, "Pedro Seijas"],
        [1, "SUB-17", 17, "Willian Valera"],
        [1, "SUB-19", 19, "Carlos Ramírez"],
        [1, "Primer Equipo", 99, "Daniel Páez"],
        
        // Femenino:
        [2, "SUB-17", 17, "Alejandro Landaeta"],
        [2, "Primer Equipo", 99, "Eduardo Escalona"]

    ];

    for( let i = 0; i < array_series.length; i++ ) {

        let sexo = array_series[i][0];
        let serie = array_series[i][1];
        let numero_serie = array_series[i][2];
        let tecnico = array_series[i][3];

        let class_cuadro_serie = "";
        if( sexo === 2 ) {
            class_cuadro_serie = "cuadro_serie_femenino";
        } else {
            class_cuadro_serie = "cuadro_serie_masculino";
        }

        let cuadro_series = 
        '<div class="span3" style="text-align: center; margin: 0px; padding: 10px;">\
            <div sexo="'+sexo+'" serie="'+serie+'" numero-serie="'+numero_serie+'" tecnico="'+tecnico+'" class="cuadro_serie '+class_cuadro_serie+'" style="padding: 5px;">\
                <center>\
                    <img src="../config/cdp.png" style="width:100px; margin-top:5px;">\
                </center>\
                <br/>\
                <div style="border-bottom: 3px solid; border-top: 3px solid; text-align: center; height: 20px; margin-top: -15px;">\
                    <h4 style="margin-top: 0px;">'+serie+'</h4>\
                </div>\
                <br/>\
                <div style="text-align: center; height: 20px; margin-top: -15px;">\
                    <i class="icon-male"></i> <span class="cantidad-jugadores" sexo="'+sexo+'" style="font-weight: bold;">(0) jugadores</span>\
                </div>\
            </div>\
        </div>\
        ';

        $("#selecciones_cajas").append( cuadro_series );

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


// ================= Inicio de la función 'boton_mostrar_modal_descarga()' ================= // 
function boton_mostrar_modal_descarga() {
    $('#view_ejercicio').modal('show');
}
// ================= Fin de la función 'boton_mostrar_modal_descarga()' ================= //

// --------------- Inicio de la función 'get_divisiones_from_pais()' --------------- //
function get_divisiones_from_pais( form ) {
    
    var pais_club;
    var division_club;

    switch( form ) {

        case 1: // <---- Ficha Jugador - Jugador en club
            pais_club = $('#pais_campeonato');
            division_club = $('#division_campeonato');
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

        case 1: // <---- Ficha Jugador - Jugador en club
            /* 
            pais_club = $('#pais_campeonato');
            division_club = $('#division_campeonato');
            */
            chequear_datos();
            break;            

    }

}
// --------------- Fin de la función 'get_divisiones_from_pais()' --------------- //

// -------------------------- Inicio de la función 'boton_ir_form_guardar()' - AGREGAR (INSERT) --------------------------- //
function boton_ir_form_guardar() {
    window.idcampeonato='';
    $('#cuadro_campeonato_main').hide(500);
    $('#cuadro_formulario_guardar').show(500);
    $("#boton_agregar_campeonato").prop("disabled", true); 
    $("#formulario_campeonato")[0].reset();  

    $('#foto_anterior_campeonato').val(''); // <---- Vaciar - IMPORTANTE.
    $('#foto_campeonato').val(''); // <---- Vaciar - IMPORTANTE.    
    $('#foto-campeonato').attr( 'src', '../config/default.png' );

    chequear_datos();

    $("#formulario_campeonato input").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    });
    $("#formulario_campeonato select").each(function(){
        let thisElement = $(this);
        thisElement.css("background-color", "white");
    });

}
// -------------------------- Fin de la función 'boton_ir_form_guardar()' - AGREGAR (INSERT) --------------------------- //

// -------------------------- Inicio de la función 'boton_editar( idcampeonato )' - EDITAR (UPDATE) --------------------------- //
function boton_editar( linea ){
    
    $('#foto-campeonato').attr( 'src', '../config/cargando_logo_final.gif' );

    // alert( window.idcampeonato );
    window.idcampeonato = datos_campeonato[linea]['idcampeonato'];

    let pais_campeonato = datos_campeonato[linea]['pais_campeonato'];

    $("#pais_campeonato option").each(function(){
        let thisElement = $(this);
        let thisValue = $(this).val();
        if( thisValue == pais_campeonato ) {
            thisElement.prop("selected", true);
        }
    });

    $("#nombre_campeonato").val( datos_campeonato[linea]['nombre_campeonato'] );

    // División:
    let division_campeonato_element = $('#division_campeonato');
    let division_campeonato = datos_campeonato[linea]['division_campeonato'];
    division_campeonato_element.empty();
    if( division_campeonato === null || division_campeonato == '' || division_campeonato == '0'  ) {

        division_campeonato_element.append('<option value="">Seleccione primero un país</option>');

    } else {

        // Comprobando que el país está en el array de divisiones:
        if (typeof array_divisiones[pais_campeonato] !== 'undefined' && array_divisiones[pais_campeonato] !== null) { 
            // Comprobando que existen divisiones para el país:
            if (typeof array_divisiones[pais_campeonato][division_campeonato] !== 'undefined' && array_divisiones[pais_campeonato][division_campeonato] !== null) { 
                
                let divisiones_pais_selected = array_divisiones[ pais_campeonato ];
                divisiones_pais_selected = divisiones_pais_selected.filter(function(){return true;}); // Reiniciando el valor de los índices de 0 a n.
                division_campeonato_element.append('<option value="">Seleccione</option>');
                for (var i = 0; i < divisiones_pais_selected.length; i++) {
                    let division =  divisiones_pais_selected[i][0];
                    let prop_selected = '';
                    if( division == division_campeonato ) {
                        prop_selected = 'selected'
                    }

                    division_campeonato_element.append('<option '+prop_selected+' value="'+divisiones_pais_selected[i][0]+'">'+divisiones_pais_selected[i][1]+'</option>');
                } 

            }else{
               division_campeonato_element.append('<option value="">No existen divisiones para el país seleccionado</option>');
            }
        }else{
           division_campeonato_element.append('<option value="">No existen divisiones para el país seleccionado</option>');
        }

    }


    $("#organizador_campeonato").val( datos_campeonato[linea]['organizador_campeonato'] );

    let foto_campeonato = 'foto_campeonatos/' + datos_campeonato[linea]['idcampeonato'] + '.png?lala='+new Date()+'';
    // $('#foto_anterior_campeonato').val( foto_campeonato );
    $('#foto_anterior_campeonato').val( datos_campeonato[linea]['idcampeonato'] + '.png' );
    $('#foto_campeonato').val(''); // <---- Vaciar - IMPORTANTE.
    // $('#foto_campeonato').val( datos_campeonato[linea]['foto_campeonato'] )
    $('#foto-campeonato').attr( 'src', foto_campeonato );

    let fecha_campeonato = datos_campeonato[linea]['fecha_campeonato'];
    if( fecha_campeonato == '0000-00-00' || fecha_campeonato === null || fecha_campeonato == '' ) {
        fecha_campeonato = '';
    }

    $('#fecha_campeonato').val( fecha_campeonato );


    $('#cuadro_campeonato_main').hide(500);
    $('#cuadro_formulario_guardar').show(500);

    chequear_datos();
}
// -------------------------- Fin de la función 'boton_editar( idcampeonato )' - EDITAR (UPDATE) --------------------------- //

function boton_eliminar( linea ){
    window.idcampeonato= datos_campeonato[linea]['idcampeonato'];
    // alert( idcampeonato );
    $('#myModal2').modal('show');
    $('#mensaje_eliminar_proveedor').html('<h5>¿Estás seguro que quieres eliminar este campeonato?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    $('.boton_modal').show();
}

function eliminar() {

    //alert( window.idcampeonato );

     $('.boton_modal').hide();
     $('#mensaje_eliminar_proveedor').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando campeonato...</h5><br><img src="../config/remover_archivo.png">');
     $.ajax({
        url: "post/campeonato_eliminar.php",
        type: "post",
        data: {
            'idcampeonato': window.idcampeonato
        },success: function(respuesta) {
            if(respuesta==1){//eliminado correctamente
                $('#mensaje_eliminar_proveedor').html('<h5>Informe eliminado correctamente!</h5>');
                buscador();
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


// ============================== Inicio de la función 'boton_guardar_campeonato()' ============================== //
function boton_guardar_campeonato(){

    if (window.idcampeonato != "" ) {
        $('#mensaje_agregar_campeonato').html('<h5 style="color:black;">¿Estás seguro que quieres editar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_campeonato').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este registro?</h5><br><img src="../config/agregar_archivo.png">');
    }
    

    $('#modal_formulario_campeonato').modal('show');
    $('.boton_modal').css('display','');
}
// ============================== Fin de la función 'boton_guardar_campeonato()' ============================== //

// ============================== Inicio de la función 'guardar_campeonato()' ============================== // 
function guardar_campeonato() {
    $('.boton_modal').css('display','none');

    if(window.idcampeonato!=""){
        $('#mensaje_agregar_campeonato').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }else{
        $('#mensaje_agregar_campeonato').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando registro...</h5><br><img src="../config/agregar_archivo.png">');
    }

    var data = new FormData( $('#formulario_campeonato')[0] );

    data.append('idcampeonato', window.idcampeonato);
    data.append('nombre_usuario_software', '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>');

    // alert(JSON.stringify(data));
    $.ajax({
        url: "post/campeonato_guardar.php",
        type: "post",
            contentType:false,
            data:data,
            processData:false,
            cache:false,
        success: function(respuesta){
            // alert(respuesta);
            if(respuesta==1){
                $('#mensaje_agregar_campeonato').html('<h4>Registro ingresado correctamente!</h4>');
                buscador();
                $("#cuadro_formulario_guardar").hide(500);
                $("#cuadro_campeonato_main").show(500);
                $('#modal_formulario_campeonato').modal('hide');

            }else if(respuesta==2){
                $('#mensaje_agregar_campeonato').html('<h4>Registro editado correctamente!</h4>');
                buscador();
                $("#cuadro_formulario_guardar").hide(500);
                $("#cuadro_campeonato_main").show(500);
                $('#modal_formulario_campeonato').modal('hide');
            }
            else{ // respuesta==4
                $('#mensaje_agregar_campeonato').html('<h5>Ha ocurrido un error al ejecutar la consulta: '+respuesta+'.</h5><br>');
            }
            
        },error: function(){// will fire when timeout is reached
           $('#mensaje_agregar_campeonato').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    }); 
}
// ============================== Fin de la función 'guardar_campeonato()' ============================== //

/*
cuadro_campeonato_main
cuadro_perfil_jugador_selected
cuadro_formulario_guardar
*/

    // -------------------- Inicio de la función 'buscador()' ------------------------- //
    function buscador() {
        var string = $("#buscar_nombre").val();
        $('#error_conexion').hide();
        $('#sin_resultados').hide();
        $('#cargando_buscar').show();
     
        $.ajax({
            url: "post/campeonato_ver.php",
            type: "post",
            dataType: 'json',
            cache: false,
            data: {
                'tipo_consulta': 1,     
                'string': string,
        },success: function(respuesta){

            var tecnico = $('.tecnico').val();
            // alert( tecnico );
            // alert(JSON.stringify(respuesta));
            if(respuesta== ""){ //jugador sin informes
                $("#tabla_ver_campeonatos_todos tbody").empty();
                var markup = '<tr class="panel_buscar" style="height:27px;cursor:pointer; color:#555555; font-size:13px;" id="informe_"><td colspan="10"><b>No se encontraron campeonatos registrados</b></td></tr>';

                var tfoot = '<tr style="background-color:#555555; color:white;"><th scope="col" style="border-bottom-left-radius:5px;padding-top:5px;padding-bottom:5px;min-width:25px;border-bottom-right-radius: 5px;" colspan="11"></th></tr>';

                $("#tabla_ver_campeonatos_todos tbody").append(markup);

                $("#tabla_ver_campeonatos_todos tfoot").html(tfoot);

                $("#graficos_informes_resumen").hide();
                $('#cargando_buscar').hide();
                $('#sin_resultados').show();
                $('#boton_editar').hide();
                $('.boton_refresh').hide();
                $('#boton_agregar_campeonato').prop("disabled", true);
            }else{              
                window.datos_campeonato = respuesta; //se copian todos los profesores al cache
                $("#tabla_ver_campeonatos_todos tbody").empty();

                var count = 1;
                for(var i=0; i < respuesta.length; i++){

                    let idcampeonato = respuesta[i]['idcampeonato'];
                    let pais_campeonato = respuesta[i]['pais_campeonato'];
                    let nombre_campeonato = respuesta[i]['nombre_campeonato'];
                    let division_campeonato = respuesta[i]['division_campeonato'];
                    let organizador_campeonato = respuesta[i]['organizador_campeonato'];

                    let division;
                    // Comprobando que el país está en el array de divisiones:
                    if (typeof array_divisiones[pais_campeonato] !== 'undefined' && array_divisiones[pais_campeonato] !== null) { 
                        // Comprobando que existen divisiones para el país:
                        if (typeof array_divisiones[pais_campeonato][division_campeonato] !== 'undefined' && array_divisiones[pais_campeonato][division_campeonato] !== null) { 
                            division = array_divisiones[pais_campeonato][division_campeonato][1];
                        }else{
                           division = 'No especificada para el país seleccionado';
                        }
                    }else{
                       division = 'No especificada para el país seleccionado';
                    }

                    let foto_campeonato = './foto_campeonatos/'+idcampeonato+'.png?lala='+new Date()+'';

                    let fecha_campeonato = respuesta[i]['fecha_campeonato'];
                    if( fecha_campeonato == '0000-00-00' || fecha_campeonato === null || fecha_campeonato == '' ) {
                        fecha_campeonato = 'Sin especificar';
                    } else {
                        fecha_campeonato = fecha_formato_ddmmaaa( respuesta[i]['fecha_campeonato'] );
                    }

                    // Bandera del País:
                    let bandera_pais;
                    if( pais_campeonato === null || pais_campeonato == '' || pais_campeonato == '0' ) {
                        bandera_pais = 'src="img/default.png" style="height: 20px; width: 25px; position: relative; top: -2px;"';
                    } else {
                        bandera_pais = 'src="flags/blank.gif" class="flag flag-'+pais_campeonato.toLowerCase()+'"';
                    }
                    
                    var markup = 
                    '<tr style="cursor: pointer;">\
                        <td onclick="boton_editar('+i+');"><b>'+count+'</b></td>\
                        <td onclick="boton_editar('+i+');"><b>'+fecha_campeonato+'</b></td>\
                        <td onclick="boton_editar('+i+');" class="td-valoracion" style="text-align: left;">\
                            <div class="div-club-table" style="text-align: left;">\
                                <div class="img-next-to-text"><img '+bandera_pais+'></div>\
                                <div><p class="ellipsis-text" style="position: relative; left: 7px; top: 0px;">'+paises_nacionalidad[pais_campeonato]+'</p></div>\
                            </div>\
                        </td>\
                        <td onclick="boton_editar('+i+');" class="td-valoracion" style="text-align: center; padding: 0;">\
                            <div class="div-club-table" style="text-align: left; max-width:300px;">\
                                <div class="img-next-to-text"><img src="'+foto_campeonato+'"></div>\
                                <div><p class="ellipsis-text" style="position: relative; left: 7px; top: 5px;">'+nombre_campeonato+'</p></div>\
                            </div>\
                        </td>\
                        <td onclick="boton_editar('+i+');" class="td-valoracion" style="text-align: left; text-align: center;">\
                            <div style="max-width:150px;"><p class="ellipsis-text nombre-club-table">'+organizador_campeonato+'</p></div>\
                        </td>\
                        <td onclick="boton_editar('+i+');" class="td-valoracion" style="text-align: left;">\
                            <p class="ellipsis-text nombre-club-table">'+division+'</p>\
                        </td>\
                        <td style="padding: 7px;"><a class="boton_editar" onclick="boton_editar('+i+');">\
                            <i class="icon-pencil"></i></a>\
                        </td>\
                        <td style="padding: 7px;"><a class="boton_eliminar" onclick="boton_eliminar('+i+');">\
                            <i class="icon-remove"></i></a>\
                        </td>\
                    </tr>';
                    $("#tabla_ver_campeonatos_todos tbody").append(markup);
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
    // -------------------- Fin de la función 'buscador()' ------------------------- //

function boton_volver_campeonato_main() {
    $("#tabla_ver_perfil_jugador tbody").empty(); // <--- Vaciando tabla.
    $('#cuadro_formulario_guardar').hide(500);
    $('#cuadro_campeonato_main').show(500);
    buscador(); // <--- Modificación hecha el 28-02-2020.
}


function chequear_datos(){
    
    var ER_numericosDecimales = /^([0-9]*|(\d+))(\.\d{1,2})?$/;
    var ER_numericosEnteros = /[0-9]/;
    var ER_caracteresAlfaNumericos = /^[a-zA-ZáàäÁÀÄéèëÉÈËíìïÍÌÏóòöÓÒÖúùüÚÙÜñÑ 0-9,.-_¿?¡!$%#()]*$/;
    flag = true;
        
    // ------------------------------------------------------------------------ //
    let foto_campeonato = $("#foto_campeonato").val();
    var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
    if( foto_campeonato != "" ) {
        if( !allowedExtensions.exec(foto_campeonato) ) {      
            // alert('Formato inválido para foto');
            flag = false;
        } else {
            // alert('Formato correcto para foto');
        }
    } else {
        // flag = false;
    }

    // ------------------------------------------------------------------------ //
    let pais_campeonato = $("#pais_campeonato").val();
    if( pais_campeonato == "" ) {
        $("#pais_campeonato").css("background-color", "white");
        flag = false;
    } else {
        $("#pais_campeonato").css("background-color", "white");
    }

    // ------------------------------------------------------------------------ //
    let nombre_campeonato = $("#nombre_campeonato").val();
    if( nombre_campeonato != "" ) {
        if( nombre_campeonato.match(ER_caracteresAlfaNumericos) && ( parseInt(nombre_campeonato.length) >= 1 && parseInt(nombre_campeonato.length) <= 150 ) ) {      
            $("#nombre_campeonato").css("background-color", "white");
        } else {
            $("#nombre_campeonato").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#nombre_campeonato").css("background-color", "white");
        flag = false;
    }

    // ------------------------------------------------------------------------ //
    let division_campeonato = $("#division_campeonato").val();
    if( division_campeonato == "" ) {
        $("#division_campeonato").css("background-color", "white");
        // flag = false;
    } else {
        $("#division_campeonato").css("background-color", "white");
    }    

    // ------------------------------------------------------------------------ //
    let organizador_campeonato = $("#organizador_campeonato").val();
    if( organizador_campeonato != "" ) {
        if( organizador_campeonato.match(ER_caracteresAlfaNumericos) && ( parseInt(organizador_campeonato.length) >= 1 && parseInt(organizador_campeonato.length) <= 150 ) ) {      
            $("#organizador_campeonato").css("background-color", "white");
        } else {
            $("#organizador_campeonato").css("background-color", "white");
            flag = false;
        }
    } else {
        $("#organizador_campeonato").css("background-color", "white");
        flag = false;
    }

    // ------------------------------------------------------------------------ //
    let fecha_campeonato = $("#fecha_campeonato").val();
    if( fecha_campeonato == "" ) {
        $("#fecha_campeonato").css("background-color", "white");
        flag = false;
    } else {
        $("#fecha_campeonato").css("background-color", "white");
    }

    if( flag === false ){
        $('#boton_agregar_campeonato').prop("disabled", true);
    }else{
        $('#boton_agregar_campeonato').prop("disabled", false);
        // alert("Formulario validado");
    }

}

function closeModal_pdf(){
    $("#descargarPDF").modal('hide');
}

// --------------------------------------- Inicio de la función descargarPDF() --------------------------------------- //
function descargarPDF( idcampeonato, titulo_serie_reporte, sexo_seleccion_reporte ){

console.log("ID Intervención Individual: " + idcampeonato );

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
            idcampeonato,
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

<script src="subir_imagen3/croppie.js"></script>
<link rel="stylesheet" href="subir_imagen3/croppie.css" />
<script>  

// --------------------------------  Subiendo imagen al campeonato -------------------------------- //
$image_crop_campeonato = $('#image_demo_campeonato').croppie({
    
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

// Evento onchange desencadenado al seleccionar foto del campeonato:
$('#foto_campeonato').on('change', function(){
  // alert("0");
   $('.boton_modal').show();
  if(subir_imagen_campeonato()==4){ //subir
      var reader = new FileReader();
      reader.onload = function (event) {
        $image_crop_campeonato.croppie('bind', {
          url: event.target.result
        }).then(function(){
          console.log('jQuery bind complete');
        });
      }
      reader.readAsDataURL(this.files[0]);
      $('#uploadImageModalCampeonato').modal('show');
  }
});

$('#crop_image_campeonato').click(function(event){
  //alert("1");
  //$('.imagen_subir_campeonato').hide();
  $('#foto-campeonato').attr('src', '../config/cargando_logo_final.gif');
  $('.boton_modal').hide();
  $('.texto_subir_campeonato').html("<br><h3 style='color:white;'><i class='icon-spinner icon-spin icon-large'></i> Subiendo imagen...</h3><br><br><br>");
  $('.texto_subir_campeonato').show();
    $image_crop_campeonato.croppie('result', {
      type: 'canvas',
      size: 'viewport'
    }).then(function(response){
          $('.imagen_subir_campeonato').hide();
          $.ajax({
            url:"subir_imagen3/upload.php",
            type: "POST",
            data:{"image": response},
            success:function(data){
              window.error_foto=2; //copiar la camiseta
              $('#foto-campeonato').attr('src', data+'?lala='+new Date());
              $('.imagen_subir_campeonato').show();
              $('.texto_subir_campeonato').hide();
              $('#uploadImageModalCampeonato').modal('hide');
            },error: function(){// will fire when timeout is reached
                $('.texto_subir_campeonato').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
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

    $('.date_fechaNacimiento').datetimepicker('setDate', new Date() );

    for ( let codigo_pais in paises_nacionalidad ) { // <-------------- PARA FORMULARIO (sin la opción 'Todos').
        let pais = paises_nacionalidad[codigo_pais];
        $(".select-pais-form").append('<option value="'+codigo_pais+'">'+pais+'</option>');
    }  

    /*
    for (var i = 0; i < array_divisiones.length; i++) { // <-------------- PARA FORMULARIO (sin la opción 'Todos').
        if( i === 0 ){
            array_divisiones[i][0] = '';
            array_divisiones[i][1] = 'Seleccione';
        }        
        $(".select-division-form").append('<option value="'+array_divisiones[i][0]+'">'+array_divisiones[i][1]+'</option>');
    }    
    */

// Ordenando select de países:
/*
$("#pais_campeonato").html($("#pais_campeonato option").sort(function (a, b) {
    if(!a.value) return;
    return a.text == b.text ? 0 : a.text < b.text ? -1 : 1
}));
$("#pais_campeonato").prepend("<option value=''>Seleccione</option>");
*/

    buscador();
    mostrar_al_cargar_pagina();

</script>