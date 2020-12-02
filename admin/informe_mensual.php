<?PHP
include('../config/datos.php');
session_start();
if(!(isset($_SESSION["nombre_usuario_software"]))){
    session_destroy();
    header('Location: ../index.php?cerrar_sesion=1');
}
else{
    $menu_actual="informe";
    $submenu_actual="informe_mensual";
    $seccion_comentarios = $comentarios['informe_mensual'];//mis cuotas
    $demo_seccion = $demo['informe_mensual'];
    $nombre_pestana_navegador='Informe';

    $datetime_now = new DateTime();
    $date_hoy = new DateTime();
    $datetime_now = $datetime_now->format('Y-m-d H:i:s');
    $year = $date_hoy->format('Y');
    $date_hoy = $date_hoy->format('Y-m-d');
    $data = explode(" ", $datetime_now);
    $ano_actual =  date("Y");
    $mes_actual =  date("m");
}

?>
<!DOCTYPE html> 
<html lang="es"> 
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <title><?php echo $nombre_pestana_navegador;?> | Mensual</title>

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

        .table-striped tbody>tr:nth-child(odd):hover {
                background-color:#ffbb00; 
                color:white; 
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

            .boton_informe_semanal{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 3px solid #555555; 
                color: #555555;
                border-radius:5px;
            }
            .boton_informe_semanal:hover{
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

            .panel_buscar:hover{
                background-color:#ffbb00;
                color:white;
            }

            .table-striped tbody tr:hover {
                background-color:#ffbb00;
                color:white;
            }    
            .boton_volver{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 1px solid #3c3b3b; 
                color: #3c3b3b;
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
            
            .boton_guardar_informe{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 3px solid #555; 
                color: #555;
                border-radius:2px;
                font-size:0.9em;
            }
            .boton_guardar_informe:hover{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 3px solid black; 
                color: black;
                border-radius:2px;
            }
            .boton_guardar_informe_eliminar{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 3px solid <?php echo $color_fondo; ?>; 
                color: <?php echo $color_fondo; ?>;
                border-radius:2px;
            }
            .boton_guardar_informe_eliminar:hover{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 3px solid #D83F25; 
                color: #D83F25;
                border-radius:2px;
            }
            .boton_guardar_informe:disabled{
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
        .boton_informe_semanal{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 3px solid #555555; 
                color: #555555;
                border-radius:5px;
            }
            .boton_informe_semanal:hover{
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
        .boton_informe_semanal:disabled{
            opacity: 0.5;
            cursor: no-drop;
        }

        /* ---------------- Estilos (Edgar Aldana) -------------------*/

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

            input[name^='ingresar_peso_ideal_informe_carga']::placeholder {
                color: white;
            }   


            input[name^='ingresar_peso_ideal_informe_carga_ja']::placeholder {
                color: white;
            }   

            #tabla_ver_informes_todos tbody tr {
                text-align: center;
            }

            #tabla_ver_informes_todos thead tr {
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

        .agregar_semanales {
            color: #555555;
            background: #FFCD44;
            border-bottom: 1px solid transparent;
            box-sizing: border-box;
        }

        .agregar_semanales:hover {
            background: #ffbb00;
            cursor: pointer;
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

        .table-striped tbody tr.hovered td {
            background-color: #000000;
            color:#ffffff;
            }

        .table-hover>tbody>tr:hover>td, .table-hover>tbody>tr:hover>th {
        background-color: #550055;
        color:#eeeeee;
        }

        table.table-striped tbody tr.hovered td {
        background-color: #000000;
        color:#ffffff;
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
        .grey-input {
            margin:0px;
            width:52%; 
            -webkit-appearance: none; 
            -moz-appearance : none; 
            border: 2px solid #555!important;
            margin-left: 0px; 
            margin-right: 0px; 
            border-bottom-right-radius:2px; 
            border-top-right-radius:2px; 
            border-bottom-left-radius:0px;  
            border-top-left-radius:0px; 
            margin-bottom:0px; 
            text-align:center;
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
        .btn-group .dropdown-menu {
            width: auto;
        }
        /*   estilos modal   */
        .text-cabecera {
            color: #bfbfbf;
            margin: 0;
            font-size: 12px;
        }

        .titulo-club {
            text-transform: uppercase;
            letter-spacing: 0px;
            font-stretch: condensed;
            transform: scaleY(1.3);
            word-spacing: 4px;
            font-size: 5.5px;
        }

        .left-div-title {
            height: 2px; border-bottom: solid 2px #e3e3e3; 
            width: 35%; 
            float: left;
        }

        .right-div-title {
            height: 2px; 
            border-bottom: solid 2px #e3e3e3; 
            width: 35%; 
            float: right;
        }

        .middle-div-title {
            width: 30%; 
            float:left;
        }

        .middle-div-title p {
            text-align: center; 
            text-transform: uppercase;
            font-size: 11px; 
            position: relative; 
            top: -10px;
            color: #656565;
            
        }
        .textarea-text-align-left{
            text-align:left!important;
            white-space: normal!important;
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

var id_semanal = "";
var id_informe = "";
var cierra_ventana=0;

var id_matricula="";
var id_mensualidad="";
var edicion_informe = false;
var agregar_informe = true;
var linea_actual=0;
var pagina_actual=0;

var error_foto = 0;
var jugadores_scouting = {};
var ano_actual = '<?php echo $ano_actual;?>';
var mes_actual = parseInt('<?php echo $mes_actual;?>');
let fechaA = '<?php echo $date_hoy; ?>';


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
    $('#error_conexion').hide();
	$('#sin_resultados').hide();
    $('#cargando_buscar').hide();
    $('#cargando_pagina').hide(500);
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
        <div id="sidebar"><a href="#" class="visible-phone"><i class="icon-truck"></i> Estudios <i class="icon-chevron-right"></i> Registro</a>
            <?php include('../config/menu.php');?>
        </div>
            <!--sidebar-menu-->

            <!--main-container-part-->
        <div id="content">
            <!--breadcrumbs--><!-- migas de pan-->
            <div id="content-header">
                <div id="breadcrumb"> 
                        <a title="Go to Home" class="tip-bottom">
                            <i class="icon-home"></i> Inicio
                        </a> 
                        <a class="tip-bottom">
                            <i class="icon-truck"></i> Informe
                        </a> 
                        <a class="current">
                            Mensual
                        </a>  
                </div>
            </div>
        <!--End-breadcrumbs-->
        <!-- gif de carga -->
        <!-- <div class="container-fluid" id="cargando_pagina">
            <center>
            <img src="" style="margin-top:100px;" id="cargando_final">
            <script>$('#cargando_final').attr('src',imagen_cargando.src);</script>
            </center>
            </div>
         -->
            <div class="container-fluid" style="display:none;" id="pagina">
                <?php if(($software_demo && $demo_seccion) || !$software_demo){?>
                <div style="margin-top: 10px; margin-bottom: 60px;">
                    
                    <div class="row-fluid" id="component_informe_semanal">
                        <!-- ----------------------------- MODAL INFORME INICIO----------------------------------------- -->
                    <div id="modal_informe" class="modal hide" style="width: 900px; height: 565px; position: fixed; top: 5%; left: 43%; border-radius: 0px;" aria-hidden="false">
                        <div class="modal-header" style="background-color: #0b1972;height: 55px;">
                            <div style="float: left;position: relative;top: -3px;right: 17px;">
                                    <div>
                                        <div style="float: right;position: relative;top: 12px;right: 16px;">
                                            <p class="text-cabecera" style="position: relative;top: -5px;">Fútbol</p>
                                            <p class="text-cabecera" style="position: relative;top: -12px;">Formativo</p>
                                            <p class="text-cabecera titulo-club" style="position: relative;top: -20px;">Club Universidad de Chile</p>
                                        </div>                
                                        <div style=" width: 37px; height: 38px; padding: 20px; float: right;">
                                            <img src="../config/logo_equipo.png" style="top: -10px;position: relative;height: 40px;width: 26px;">
                                        </div>                    
                                    </div>
                            </div>
                            <div style="float: right; margin-left: 9px; margin-top: 6px;">  
                                <p style="text-transform: uppercase;color: white;font-size: 12px;position: relative;top: 7px;"><span style="font-weight: bold;">universidad</span> <span>de chile</span></p>
                            </div>
                            <div style="margin-top: 0px;/* max-width: 625px; */margin: auto;/* width: 625px; */position: relative;top: 79px;">
                                <p style="text-align: center;margin-top: 2px;margin-bottom: 40px;font-size: 15px; color: #4e4e4e; text-align: center;font-weight: bold;color: #8b8b8b;" class="big-text">INFORME MENSUAL</p>
                                <div>
                                    <img src="../config/logo_equipo.png" style="top: -25px;height: 100px;width: auto;position: relative;left: 240px;">
                                </div>
                                <div style="border-top: 2px solid #3c3b3b;border-bottom: 2px solid #3c3b3b;width: 15%;margin: auto;margin-top: -18px;">
                                    <p style="color: #3c3b3b;text-align: center;background-color: transparent;text-transform: uppercase;font-family: Open Sans, sans-serif!important;font-size: 12px;margin-top: 3px;margin-bottom: 1px;font-weight: bold;">área médica</p>
                                </div>  
                            </div>
                        </div>
                        <div class="modal-body" style="color:black;font-family:Arial, Helvetica, sans-serif;width: 97%;margin-top: 215px;height: 225px;padding: 10px 13px;">
                                <div style="background-color: transparent; width: 99.5%;">
                                    <div class="left-div-title"></div>
                                    <div class="middle-div-title">
                                        <p style=" text-align: center;font-size: 12px; color: #4e4e4e; text-align: center;font-weight: bold;color: #8b8b8b;" class="big-text">INFORME</p>
                                    </div>
                                    <div class="right-div-title"></div>
                                    <div>   
                                        <textarea id="contenedor_informe" class="textarea-text-align-left" readonly style="padding: 0;width: 100%;resize: none;border: solid 2px #e3e3e3;" rows="9"></textarea>
                                    </div>
                                </div> 
                        </div>
                        <div class="modal-footer" style="background-color: transparent; border: none; position: absolute;bottom: 0;border-radius: 0;width: -webkit-fill-available; padding: 0;">
                            <div style="width: 97%; margin: auto; background-color: #0b1972; height: 7px;"></div>
                            <p style="font-weight: bold;position: relative;text-align: left;text-transform: uppercase;color: #8b8b8b;font-size: 10px;padding: 2px 15px;top: 4px;">club universidad de chile</p>
                        </div>
                    </div>
<!--------------------------------  MODAL INFORME  FIN-------------------------------------------->
<!--------------------------------  MODAL INFORME ELIMINAR INICIO-------------------------------------------->
                    <div id="modalEliminarRegistro" class="modal hide" style="border-radius:10px;">
                        <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
                        </div>
                        <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
                        <center>
                                <br>
                                <div id="mensaje_agregar_modalEliminarRegistro">
                                <h5><!--mensaje modal --></h5>
                                </div>
                                <br>
                        </center>
                        </div>
                        <div class="modal-footer" id="modal-footer-eliminar" style="background-color: <?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
                            
                            <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>
                                <button type="button" id="eliminar_modal" class="btn btn-default boton_modal " onClick="botonEliminar();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button>  
                            </center>
                            
                        </div>
                    </div>
                    <!--------------------------------  MODAL INFORME ELIMINAR fin-------------------------------------------->
<!--------------------------------  MODAL INFORME PDF INICIO-------------------------------------------->
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
<!--------------------------------  MODAL INFORME PDF FIN-------------------------------------------->
                <!-- ========================================== Inicio del id="tabla de informe semanal" ========================================== -->     
                    <div id="cuadro_listado_informe_semanal" class="row-fluid" style="margin-top: -10px; color: black; font-family: Arial, Helvetica, sans-serif;">
                        <table style="color:black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
                            <tr class="sin_fondo" >
                                <td style="padding:12px; padding-top:15px;"><img src="../config/logo_equipo.png" style="height: 100px; margin-top:5px;"></td>
                                <td>
                                    <center>
                                        <h3 class="titulo_principal" style="color:#595959;">MÓDULO DE INFORMES</h3>
                                        <p style="margin: 0px;font-weight: bold;color: #595959;">INFORMES MENSUALES</p>
                                    </center>
                                </td>
                            </tr>
                        </table>
                        <center>
                            <div style="margin:0px; height:20px;"><img src="img/cargando_buscar.gif" id="cargando_buscar" style=" display:none;">
                                <span style="color:#dc4e4e; display:none;" id="error_conexion"><b>Error:</b> conexión a internet deficiente.</span>
                                <span style="color:#28b779; display:none;" id="sin_resultados">Busqueda sin resultados.</span>
                            </div>
                        </center>
                        <hr>
                            <div style="margin:auto;width: 100%;" > 
                                    <form id="filtro_trabla_informe">
                                        
                                        <div style="background-color: lightblue; width: 70%; margin: auto;">
                                            <div class="span4" style="display: flex;/*margin-right:2.5%;width:29.96%;display:flex;margin-bottom:15px*/">
                                                <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#555">
                                                    <div>
                                                        <p class="ellipsis-text" style="font-weight: normal;">Año</p>
                                                    </div>
                                                </a><!-- mostrarTipoDeFormulario(this.value) -->
                                                <select style="width:50%; height: 30px;background:#fff;border:2px solid" class="" id="ano_informe_mensual_filtro" name="ano_informe_mensual_filtro" onchange="buscarInformesFiltro()">
                                                </select>
                                            </div>
                                            <div class="span4" style="display: flex;">
                                                <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#555"><div><p class="ellipsis-text" style="font-weight: normal;;">Área</p></div></a>
                                                <div class="btn-group c_objetivo_fisico " style="width: 50%;">
                                                    <button id="boton_area" type="button" class="btn dropdown-toggle grey-input" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 1px solid #555;background:#fff;"><p id="area" class="titulo_multi ellipsis-text"><span id="texto_boton_filtro_area">Seleccione un área</span></p> <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>\
                                                    <ul id="tipo_area" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                                                </div>                    
                                            </div>

                                            <div class="span4" style="display: flex;">
                                                <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#555"><div><p class="ellipsis-text" style="font-weight: normal;;">Mes</p></div></a>
                                                <div class="btn-group c_objetivo_fisico " style="width: 50%;">
                                                    <button id="boton_mes" type="button" class="btn dropdown-toggle grey-input" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 1px solid #555;background:#fff;"><p id="mes" class="titulo_multi ellipsis-text"><span id="texto_boton_filtro_mes">Seleccione un mes</span></p> <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>\
                                                    <ul id="tipo_mes" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                                                </div>                    
                                            </div>

                                            <!-- <div class="span4" style="display: flex;">
                                                <a class="btn btn-md btn-primary green-a" style="width: 50%; height: 20px;background:#555"><div><p class="ellipsis-text" style="font-weight: normal;">Fecha fin</p></div></a><input type="text" readonly  style="width: 50%; height: 18px;background:#fff;" class="grey-input date_fechaNacimiento  fecha_final" id="fecha_final" name="fecha_final" onchange="buscarInformesFiltro();" />
                                            </div>                                                                                      -->

                                        </div>

                                    </form>
                                    
                            </div>
                        </div>
                        <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:30px;">
                            <div class="row-fluid" style="margin-top:0px;">
                                <button style="margin-bottom:10px; margin-top: 0px; float:right;" class="boton_informe_semanal" id="boton_agregar_informe" onClick="mostrarComponentFormular()"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar informe</b></button>

                                <div class="span12" style="margin: 0px;">
                                    <table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_ver_informes">
                                        <thead>
                                            <tr style="background-color:#555555; color:white;">
                                                <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;"><center>#</center></th>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="Fecha del informe" style="width:100px;text-align:left">MES</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="Área" style="width:190px;"><center>ÁREA QUE REALIZA EL INFORME</center></div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="Serie" style="width:40px;"><center>SERIE</center></div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="Quie realizo el informe" style="width:100px;"><center>REALIZADO POR</center></div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="Descripción del informe" style="width:200px;text-align:left">INFORME</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:0px; width:30px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:0px; width:30px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:5px; width:30px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="contenido_tabla">
                                            <!--  AQUI SE INSERTARAN CON JAVASCRIPT -->
                                        </tbody>
                                        <tfoot>
                                            <tr style="background-color:#555555; color:white;">
                                                <th scope="col" style="border-bottom-left-radius:5px; padding-top:5px; padding-bottom:5px;"></th>
                                                <th scope="col" style="cursor:pointer;  padding:15px;"></th> 
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-bottom-right-radius:5px;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                    </div><!-- koko -->
                    <!-- ========================================== Fin del id="cuadro_listado_informe_semanal" ========================================== -->
                    <!-- ========================================== Inicio del id="component_formulario" ========================================== -->
                    <div class="row-fluid" id="component_formulario_informe_semanal">
                    <!------------------------------------------------------->
                    <div id="myModalDescargarBoleta" class="modal hide" style="border-radius:10px;">
                        <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
                        </div>
                        <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
                        <center>
                                <br>
                                <div id="mensaje_agregar_DescargarBoleta">
                                <h5><!--mensaje modal --></h5>
                                </div>
                                <br>
                        </center>
                        </div>
                        <div class="modal-footer" style="background-color: <?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
                            
                            <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>
                            
                                <button type="button" id="guardar" class="btn btn-default boton_modal " onClick="botonGuardarInforme();" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button>  
                            
                            </center>
                            
                        </div>
                    </div>


<!--  -------------------------  MODAL -------------------------------- -->
                        <div class="row-fluid" style="margin: 0px; margin-top:5px;">
                            <button class="boton_volver" onClick="botonVolver();" style="float:left; margin:0px;"><i class="icon-arrow-left"></i> volver</button>
                        </div>
                        <table style="width:260px;color:black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
                            <tr class="sin_fondo">
                                <td style="padding:12px; padding-top:15px;"><img src="../config/logo_equipo.png" style="height: 80px; margin-top:5px;"></td>
                                <td>
                                    <center>
                                        <h3 style="top: -12px; font-size: 16px;position: relative;color:#3c3b3b;">ÁREA DE INFORMES</h3>
                                        <div style="width: 90%;border-top: 2px solid #3c3b3b;border-bottom: 2px solid #3c3b3b;margin: auto;margin-top: -18px;">
                                            <p style="font-size: 11px;text-transform: uppercase;font-weight: bold;color:#3c3b3b;text-align: center;margin: 1px 0px;">UNIVERSIDAD DE CHILE</p>
                                        </div>        
                                    </center>
                                </td>
                            </tr>
                        </table>
                        <hr>
                        <form id="formulario_informe_mensual">  
                        <div style="margin:auto;width: 100%;" > 
                            <div style="background-color: lightblue; width: 90%; margin: auto;">
                                <div class="span3" style="display: flex;/*margin-right:2.5%;width:29.96%;display:flex;margin-bottom:15px*/">
                                    <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#555">
                                        <div>
                                            <p class="ellipsis-text" style="font-weight: normal;">Año</p>
                                        </div>
                                    </a><!-- mostrarTipoDeFormulario(this.value) -->
                                    <select style="width:50%; height: 30px;background:#fff;border:2px solid" class="" id="ano_informe_mensual" name="ano_informe_mensual" onchange="">
                                    </select>
                                </div>
                                <div class="span3" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#555"><div><p class="ellipsis-text" style="font-weight: normal;">Mes</p></div></a>
                                    <div class="btn-group c_objetivo_fisico " style="width: 50%;">
                                        <button id="boton_mes_formulario" type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #555;background:#fff;"><p id="area" class="titulo_multi ellipsis-text"><span id="texto_boton_formulario_mes">Seleccione un mes</span></p><span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>\
                                        <ul id="tipo_mes_formulario" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                                    </div>                    
                                </div> 
                                <div class="span3" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#555"><div><p class="ellipsis-text" style="font-weight: normal;">Área</p></div></a>
                                    <div class="btn-group c_objetivo_fisico " style="width: 50%;">
                                        <button id="boton_area_formulario" type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #555; background:#fff;"><p id="area" class="titulo_multi ellipsis-text"><span id="texto_boton_formulario_area">Seleccione un área</span></p><span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>\
                                        <ul id="tipo_area_formulario" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                                    </div>                    
                                </div> 

                                <div class="span3" style="display: flex;">
                                    <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#555"><div><p class="ellipsis-text" style="font-weight: normal;">Serie</p></div></a>
                                    <div class="btn-group c_objetivo_fisico " style="width: 50%;">
                                        <button id="boton_serie" type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #555;background:#fff;"><p id="serie" class="titulo_multi ellipsis-text"><span id="texto_boton_formulario_serie">Seleccione un serie</span></p> <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>\
                                        <ul id="tipo_serie" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                                    </div>                    
                                </div>
                            </div>
                        </div>
                            
                            
                            <div class="row-fluid" >
                                <div class="span12" style="display: flex;margin-top:30px">
                                    <a class="btn btn-lg btn-block btn-primary" style="background-color: #0b1972;">INFORME MENSUAL</a><br>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12" style="display: flex;">
                                    <textarea style="margin:0px; padding:0px; height:210px; max-height:210px; min-height:210px; width:100%; max-width:100%; min-width:100%; border: 1px solid grey; border-bottom-left-radius:2px; border-bottom-right-radius:2px;resize:none;" name="descripcion_informe_mensual" maxlength="1999" id="descripcion_informe_mensual" onkeyup="activarBotonGuardarInforme()"  onkeydown="activarBotonGuardarInforme()"></textarea>
                                </div>
                            </div>
                            <div class="row-fluid">
                                <div class="span12"  style=" margin-top: 20px;">
                                    <center>
                                        <button type="button" ng-disabled="" class="boton_guardar_informe" onClick="botonGuardar();" id="boton_agregar_infrome"><i class="icon-save"></i> GUARDAR INFORME</button>
                                    </center>   
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- ========================================== Fin del id="component_formulario" ========================================== -->
                </div>
            </div>
        </div> 
            <?php } ?> <!--llave fin de  software_demo-->
    </body>
    
</html>

<script type="text/javascript">//funciones componentes
var ano_actual="";

function consultar_ano_actual(){
    $.ajax({
            url: "post/informe_mensual_ano_actual.php",
            type: "get"
            ,success: function(respuesta) {
                var json=JSON.parse(respuesta);
                // alert("registro")
                // console.log(json)
                window.ano_actual=parseInt(json.ano_actual)
                anos_informe_mensual()
                
		},error: function(){// will fire when timeout is reached
			// alert("errorXXXXX");
    	}, timeout: 10000 // sets timeout to 3 seconds
	});
}

function anos_informe_mensual(){
    $("#ano_informe_mensual").empty()
    $("#ano_informe_mensual_filtro").empty()
    let list_option_ano=[]
    let ano_minimo=window.ano_actual-2
    let ano_maximo=window.ano_actual+1
    for(ano_minimo;ano_minimo<=ano_maximo;ano_minimo++){
        list_option_ano.push(`<option value="${ano_minimo}" id="ano_${ano_minimo}">${ano_minimo}</option>`)
    }

    list_option_ano.map(ano => {
        $("#ano_informe_mensual").append(ano)
    })
    $("#ano_informe_mensual").val(window.ano_actual)

    list_option_ano.map(ano => {
        $("#ano_informe_mensual_filtro").append(ano)
    })
    $("#ano_informe_mensual_filtro").val(window.ano_actual)
    buscarInformesFiltro();

}

//#ffc6c6
//#d4ffdc
var id_informe_mensual="",
index_array_informe_mensual="",
tipo_formulario=false

var lista_areas_2=[
    {numero_area:0,nombre_area:"Todos"},
    {numero_area:1,nombre_area:"TECNICO – TACTICA"},
    {numero_area:2,nombre_area:"SOCIAL"},
    {numero_area:3,nombre_area:"MEDICA"},
    {numero_area:4,nombre_area:"NUTRICION"},
    {numero_area:5,nombre_area:"GESTION DE TALENTO"},
    {numero_area:6,nombre_area:"OPTIMIZACION DE RENDIMIENTO"}
];

var lista_meses=[
    {numero_mes:0,nombre_mes:"Todos"},
    {numero_mes:1,nombre_mes:"ENERO"},
    {numero_mes:2,nombre_mes:"FEBRERO"},
    {numero_mes:3,nombre_mes:"MARZO"},
    {numero_mes:4,nombre_mes:"ABRIL"},
    {numero_mes:5,nombre_mes:"MAYO"},
    {numero_mes:6,nombre_mes:"JUNIO"},
    {numero_mes:7,nombre_mes:"JULIO"},
    {numero_mes:8,nombre_mes:"AGOSTO"},
    {numero_mes:9,nombre_mes:"SEPTIEMBRE"},
    {numero_mes:10,nombre_mes:"OCTUBRE"},
    {numero_mes:11,nombre_mes:"NOVIEMBRE"},
    {numero_mes:12,nombre_mes:"DICIEMBRE"}
];

var lista_serie=[
    {numero_serie:"00_0",nombre_serie:"Todos"},
    //serie masculina
    {numero_serie:"99_1",nombre_serie:"PRIMER EQUIPO"},
    {numero_serie:"20_1",nombre_serie:"SUB 20"},
    {numero_serie:"17_1",nombre_serie:"SUB 17"},
    {numero_serie:"16_1",nombre_serie:"SUB 16"},
    {numero_serie:"15_1",nombre_serie:"SUB 15"},
    {numero_serie:"14_1",nombre_serie:"SUB 14"},
    {numero_serie:"13_1",nombre_serie:"SUB 13"},
    {numero_serie:"12_1",nombre_serie:"SUB 12"},
    {numero_serie:"11_1",nombre_serie:"SUB 11"},
    {numero_serie:"10_1",nombre_serie:"SUB 10"},
    {numero_serie:"9_1",nombre_serie:"SUB 9"},
    {numero_serie:"8_1",nombre_serie:"SUB 8"},
    //serie femenina
    {numero_serie:"99_2",nombre_serie:"ADULTA FEMENINA"},
    {numero_serie:"17_2",nombre_serie:"SUB 17 FEMENINA"},
    {numero_serie:"15_2",nombre_serie:"SUB 15 FEMENINA"},
]

var respuesta_servidor=[];
// --------------------------------------- Fin de la función descargarPDFTwo() --------------------------------------- // 


//funciones
function mostrarComponentFormular(){
    consultar_ano_actual();
    $("#component_informe_semanal").hide(500)
    $("#component_formulario_informe_semanal").show(500)
    $("#tipo_area_formulario").empty()
    $("#tipo_serie").empty()
    $("#tipo_mes_formulario").empty()
    $("#texto_boton_formulario_mes").text("Seleccione un Mes")
    $("#texto_boton_formulario_area").text("Seleccione un Área")
    $("#texto_boton_formulario_serie").text("Seleccione una Serie")
    $('#descripcion_informe_mensual').val("")
    window.index_array_informe_mensual=""
    window.id_informe_mensual=""
    window.id_informe=1//esto indica que el formulario es de creacion
    window.tipo_formulario=true//esto indica a los list checkbox que van hacer creado en el formulario de creacion
    $("#boton_agregar_infrome").prop("disabled",true)
}

function mostrarComponentFormularEditar(numero){
    consultar_ano_actual();
    $("#tipo_area_formulario").empty()
    $("#tipo_serie").empty()
    $("#tipo_mes_formulario").empty()
    $("#texto_boton_formulario_mes").text("Seleccione un Mes")
    $("#texto_boton_formulario_area").text("Seleccione un Área")
    $("#texto_boton_formulario_serie").text("Seleccione una Serie")
    $("#component_informe_semanal").hide(500)
    $("#component_formulario_informe_semanal").show(500)
    $('#descripcion_informe_mensual').val(respuesta_servidor[numero].descripcion_informe_mensual)
    $('#ano_informe_mensual').val(respuesta_servidor[numero].ano_informe_mensual)
    window.id_informe_mensual=respuesta_servidor[numero].idinforme_mensual;//id del informe a editar
    window.index_array_informe_mensual=numero
    window.tipo_formulario=false//esto indica a los list checkbox que van hacer creado en el formulario de edicion
    window.id_informe=""//esto indica que el formulario es de edicion
    $("#boton_agregar_infrome").prop("disabled",false)
    renderizarListCheckBoxArea()
    renderizarListCheckBoxMes()
    renderizarListCheckBoxSerie()
    let array_checkbox_serie_formulario_mensual = $('input[name="array_checkbox_serie_formulario_mensual[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    // console.log(array_checkbox_serie_formulario_mensual)
    if(array_checkbox_serie_formulario_mensual.length==1){
        const serie=lista_serie.filter((serie)=>{
            if(serie.numero_serie===array_checkbox_serie_formulario_mensual[0]){
                return serie
            }
        })
        // console.log(serie[0].nombre_serie)
        $("#texto_boton_formulario_serie").text(`${serie[0].nombre_serie}`)
    }
    else if(array_checkbox_serie_formulario_mensual.length>0){
        if(array_checkbox_serie_formulario_mensual.length==lista_serie.length){
            $("#checkbox_serie_formulario_mensual_00_0").prop("checked",true)
            $("#texto_boton_formulario_serie").text(`Todos`)
        }
        else{
            $("#texto_boton_formulario_serie").text(`${array_checkbox_serie_formulario_mensual.length} Elementos Selecionados`)
        }
    }
    else{
        // alert("hola")
        $("#texto_boton_formulario_serie").text(`Seleccione un Serie`)
    }


    /////////////////////////////////////////
    let array_checkbox_mes_formulario_mensual= $('input[name="array_checkbox_mes_formulario_mensual[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    if(array_checkbox_mes_formulario_mensual.length==1){
        const mes=lista_meses.filter((mes)=>{
            if(mes.numero_mes===parseInt(array_checkbox_mes_formulario_mensual[0])){
                return mes
            }
        })
        // console.log(mes[0].nombre_mes)
        $("#texto_boton_formulario_mes").text(`${mes[0].nombre_mes}`)
    }
    else if(array_checkbox_mes_formulario_mensual.length>0){
        if(array_checkbox_mes_formulario_mensual.length==lista_meses.length){
            $("#checkbox_mes_formulario_mensual_0").prop("checked",true)
            $("#texto_boton_formulario_mes").text(`Todos`)
        }
        else{
            $("#texto_boton_formulario_mes").text(`${array_checkbox_mes_formulario_mensual.length} Elementos Selecionados`)
        }
    }
    else{
        // alert("hola")
        $("#texto_boton_formulario_mes").text(`Seleccione un Mes`)
    }
    ////////
    let array_checkbox_area_formulario_mensual= $('input[name="array_checkbox_area_formulario_mensual[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    if(array_checkbox_area_formulario_mensual.length==1){
        const area=lista_areas_2.filter((area)=>{
            if(area.numero_area===parseInt(array_checkbox_area_formulario_mensual[0])){
                return area
            }
        })
        // console.log(area[0].nombre_area)
        $("#texto_boton_formulario_area").text(`${area[0].nombre_area}`)
    }
    else if(array_checkbox_area_formulario_mensual.length>0){
        if(array_checkbox_area_formulario_mensual.length==lista_areas_2.length){
            $("#checkbox_area_formulario_mensual_0").prop("checked",true)
            $("#texto_boton_formulario_area").text(`Todos`)
        }
        else{
            $("#texto_boton_formulario_area").text(`${array_checkbox_area_formulario_mensual.length} Elementos Selecionados`)
        }
    }
    else{
        // alert("hola")
        $("#texto_boton_formulario_area").text(`Seleccione un Área`)
    }
    
}


function renderizarListCheckBoxArea(){
    var contador=0
        var estado=true
        const lis=lista_areas_2.map((area)=>{
            // mejor copiar este 
            // console.log(window.tipo_formulario)
            const funcion=(area.numero_area===0)?'selecionarTodosAreaFormulario()':'activarBotonGuardarInforme()'
            if(!window.tipo_formulario){
                if(area.numero_area===0){
                    if(window.respuesta_servidor[window.index_array_informe_mensual].array_area_informe_mensual.length==6 && estado){
                        estado=false
                        return `<li><label class='option'><span class='label_s'>${area.nombre_area}</span> <input type='checkbox' checked id='checkbox_area_formulario_mensual_${area.numero_area}' name='array_checkbox_area_formulario_mensual[]' value='${area.numero_area}' data-eliminar='0' onchange='${funcion}' ></label></li>`
                    }
                    else{
                        estado=false
                        return `<li><label class='option'><span class='label_s'>${area.nombre_area}</span> <input type='checkbox' id='checkbox_area_formulario_mensual_${area.numero_area}' name='array_checkbox_area_formulario_mensual[]' value='${area.numero_area}' data-eliminar='0' onchange='${funcion}' ></label></li>`
                    }
                }
                while(contador<window.respuesta_servidor[window.index_array_informe_mensual].array_area_informe_mensual.length){
                    
                    if(area.nombre_area==window.respuesta_servidor[window.index_array_informe_mensual].array_area_informe_mensual[contador]){
                        contador++
                        return `<li><label class='option'><span class='label_s'>${area.nombre_area}</span> <input type='checkbox' checked id='checkbox_area_formulario_mensual_${area.numero_area}' name='array_checkbox_area_formulario_mensual[]' value='${area.numero_area}' data-eliminar='0' onchange='activarBotonGuardarInforme()' ></label></li>`
                    }
                    break
                }
                return `<li><label class='option'><span class='label_s'>${area.nombre_area}</span> <input type='checkbox' id='checkbox_area_formulario_mensual_${area.numero_area}' name='array_checkbox_area_formulario_mensual[]' value='${area.numero_area}' data-eliminar='0' onchange='activarBotonGuardarInforme()' ></label></li>`
            }
            else{
                return `<li><label class='option'><span class='label_s'>${area.nombre_area}</span> <input type='checkbox' id='checkbox_area_formulario_mensual_${area.numero_area}' name='array_checkbox_area_formulario_mensual[]' value='${area.numero_area}' data-eliminar='0' onchange='${funcion}' ></label></li>`
            }
        })
        
        if($("#tipo_area_formulario").html()!=""){
            console.log("no esta vacio")
        }
        else{
            lis.map((lista)=>{
            $("#tipo_area_formulario").append(lista)
            })
        }
}

function renderizarListCheckBoxMes(){
    var contador=0
        var estado=true
        const lis=lista_meses.map((mes)=>{
            // mejor copiar este 
            // console.log(window.tipo_formulario)
            const funcion=(mes.numero_mes===0)?'selecionarTodosMesFormulario()':'activarBotonGuardarInforme()'
            if(!window.tipo_formulario){
                if(mes.numero_mes===0){
                    if(window.respuesta_servidor[window.index_array_informe_mensual].array_mes_informe_mensual.length==12 && estado){
                        estado=false
                        return `<li><label class='option'><span class='label_s'>${mes.nombre_mes}</span> <input type='checkbox' checked id='checkbox_mes_formulario_mensual_${mes.numero_mes}' name='array_checkbox_mes_formulario_mensual[]' value='${mes.numero_mes}' data-eliminar='0' onchange='${funcion}' ></label></li>`
                    }
                    else{
                        estado=false
                        return `<li><label class='option'><span class='label_s'>${mes.nombre_mes}</span> <input type='checkbox' id='checkbox_mes_formulario_mensual_${mes.numero_mes}' name='array_checkbox_mes_formulario_mensual[]' value='${mes.numero_mes}' data-eliminar='0' onchange='${funcion}' ></label></li>`
                    }
                }
                while(contador<window.respuesta_servidor[window.index_array_informe_mensual].array_mes_informe_mensual.length){
                    
                    if(mes.nombre_mes==window.respuesta_servidor[window.index_array_informe_mensual].array_mes_informe_mensual[contador]){
                        contador++
                        return `<li><label class='option'><span class='label_s'>${mes.nombre_mes}</span> <input type='checkbox' checked id='checkbox_mes_formulario_mensual_${mes.numero_mes}' name='array_checkbox_mes_formulario_mensual[]' value='${mes.numero_mes}' data-eliminar='0' onchange='activarBotonGuardarInforme()' ></label></li>`
                    }
                    break
                }
                
                return `<li><label class='option'><span class='label_s'>${mes.nombre_mes}</span> <input type='checkbox' id='checkbox_mes_formulario_mensual_${mes.numero_mes}' name='array_checkbox_mes_formulario_mensual[]' value='${mes.numero_mes}' data-eliminar='0' onchange='activarBotonGuardarInforme()' ></label></li>`
            }
            else{
                return `<li><label class='option'><span class='label_s'>${mes.nombre_mes}</span> <input type='checkbox' id='checkbox_mes_formulario_mensual_${mes.numero_mes}' name='array_checkbox_mes_formulario_mensual[]' value='${mes.numero_mes}' data-eliminar='0' onchange='${funcion}' ></label></li>`
            }
        })

        
        if($("#tipo_mes_formulario").html()!=""){
            console.log("no esta vacio")
        }
        else{
            lis.map((lista)=>{
            $("#tipo_mes_formulario").append(lista)
            })
        }

}


function renderizarListCheckBoxSerie(){
    var contador_serie=0;
        var estado=true
        const lis=lista_serie.map((serie)=>{
            const funcion=(serie.numero_serie==="00_0")?'selecionarTodosSerieFormulario()':'activarBotonGuardarInforme()'
            if(!window.tipo_formulario){
                if(serie.numero_serie==="00_0"){
                    if(window.respuesta_servidor[window.index_array_informe_mensual].array_serie_informe_mensual.length==15 && estado){
                    estado=false
                    return `<li><label class='option'><span class='label_s'>${serie.nombre_serie}</span> <input type='checkbox' checked id='checkbox_serie_formulario_mensual_${serie.numero_serie}' name='array_checkbox_serie_formulario_mensual[]' value='${serie.numero_serie}' data-eliminar='0' onchange='${funcion}' ></label></li>`
                    }
                    else{
                        estado=false
                        return `<li><label class='option'><span class='label_s'>${serie.nombre_serie}</span> <input type='checkbox' id='checkbox_serie_formulario_mensual_${serie.numero_serie}' name='array_checkbox_serie_formulario_mensual[]' value='${serie.numero_serie}' data-eliminar='0' onchange='${funcion}' ></label></li>`
                    }
                }
                while(contador_serie<window.respuesta_servidor[window.index_array_informe_mensual].array_serie_informe_mensual.length){
                    
                    if(serie.nombre_serie==window.respuesta_servidor[window.index_array_informe_mensual].array_serie_informe_mensual[contador_serie]){
                        contador_serie++
                        return `<li><label class='option'><span class='label_s'>${serie.nombre_serie}</span> <input type='checkbox' checked id='checkbox_serie_formulario_mensual_${serie.numero_serie}' name='array_checkbox_serie_formulario_mensual[]' value='${serie.numero_serie}' data-eliminar='0' onchange='activarBotonGuardarInforme()' ></label></li>`
                    }
                    break//<---- no remover queda en un loop infinito por alguna razon
                }
                return `<li><label class='option'><span class='label_s'>${serie.nombre_serie}</span> <input type='checkbox' id='checkbox_serie_formulario_mensual_${serie.numero_serie}' name='array_checkbox_serie_formulario_mensual[]' value='${serie.numero_serie}' data-eliminar='0' onchange='activarBotonGuardarInforme()' ></label></li>`
            }
            else{
                return `<li><label class='option'><span class='label_s'>${serie.nombre_serie}</span> <input type='checkbox' id='checkbox_serie_formulario_mensual_${serie.numero_serie}' name='array_checkbox_serie_formulario_mensual[]' value='${serie.numero_serie}' data-eliminar='0' onchange='${funcion}' ></label></li>`
            }
        })
        // $("#tipo_serie").empty()
        if($("#tipo_serie").html()!=""){
            console.log("no esta vacio")
        }
        else{
            lis.map((lista)=>{
            $("#tipo_serie").append(lista)
        })
        }
}

function botonVolver(){
    // $('.fecha_final').datetimepicker({
    //     language:  'es',
    //     format: 'yyyy-mm-dd',
    //     //startDate: '2014-12-01',
    //     weekStart: 1,
    //     todayBtn:  1,
    //     autoclose: 1,
    //     todayHighlight: 1,
    //     startView: 2,
    //     minView: 2,
    //     forceParse: 0,
    //     autoclose: true,
    //     useCurrent: false
    // });
    $("#tipo_area").empty()
    $("#tipo_mes").empty()
    // $('.fecha_final').datetimepicker('setDate', new Date() );
    $('#error_conexion').hide();
	$('#sin_resultados').hide();
    $('#cargando_buscar').hide();
    $("#boton_area_formulario").css("background-color", "#ffff")
    $("#boton_mes_formulario").css("background-color", "#ffff")
    $("#boton_serie").css("background-color", "#ffff")
    // $("#fecha_informe_semanal").css("background-color", "#ffff")
    $("#descripcion_informe_mensual").css("background-color", "#ffff")
    buscarInformesFiltro();
    $("#component_formulario_informe_semanal").hide(500)
    $("#component_informe_semanal").show(500)
    consultar_ano_actual();
    
    
}

function botonGuardar(){
    // myModalDescargarBoleta
    const estado_checkbox_area=validarCheckBoxs("boton_area_formulario","checkbox_area_formulario_mensual_","numero_area",lista_areas_2),
    estado_checkbox_serie=validarCheckBoxs("boton_serie","checkbox_serie_formulario_mensual_","numero_serie",lista_serie),
    estado_checkbox_mes=validarCheckBoxs("boton_mes_formulario","checkbox_mes_formulario_mensual_","numero_mes",lista_meses);
    const descripcion_informe_mensual=validarCamposVacios("descripcion_informe_mensual");
    if(window.id_informe!=""){
		$('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar este informe mensual?</h5><br><img src="../config/agregar_archivo.png">');
	}else{
	    $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar este informe mensual?</h5><br><img src="../config/agregar_archivo.png">');
	}
	$('#myModalDescargarBoleta').modal('show');
	$('.boton_modal').css('display','');
}


function botonGuardarInforme(){
    const estado_checkbox_area=validarCheckBoxs("boton_area_formulario","checkbox_area_formulario_mensual_","numero_area",lista_areas_2),
    estado_checkbox_serie=validarCheckBoxs("boton_serie","checkbox_serie_formulario_mensual_","numero_serie",lista_serie),
    estado_checkbox_mes=validarCheckBoxs("boton_mes_formulario","checkbox_mes_formulario_mensual_","numero_mes",lista_meses);
    const descripcion_informe_mensual=validarCamposVacios("descripcion_informe_mensual");
    // $('#mensaje_agregar_modalEliminarRegistro').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando ejercicio...</h5><br><img src="../config/remover_archivo.png">');
    if(window.id_informe!=""){
		$('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando informe ...</h5><br><img src="../config/agregar_archivo.png">');
	}else{
	    $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando informe...</h5><br><img src="../config/agregar_archivo.png">');
	}
    
    if(estado_checkbox_mes && estado_checkbox_area && estado_checkbox_serie && descripcion_informe_mensual){
        // ano_informe_mensual
        var datos = $('#formulario_informe_mensual').serializeArray();
        datos.push({name: 'id_informe_mensual',  value: window.id_informe_mensual});
        datos.push({name: 'id_informe',  value: window.id_informe});
        datos.push({name: 'nombre_usuario_software', value: '<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>'})
        // console.log(datos)
        if($("#checkbox_mes_formulario_mensual_0").prop("checked") && $("#checkbox_area_formulario_mensual_0").prop("checked") && $("#checkbox_serie_formulario_mensual_00_0").prop("checked")){
            datos.splice(1,1)
            datos.splice(13,1)
            datos.splice(19,1)
        }
        else{
            var lista_name=[]
            var estado=false
            var lista_valor=[]
            if($("#checkbox_area_formulario_mensual_0").prop("checked")){
                estado=true
                lista_name.push($("#checkbox_area_formulario_mensual_0").attr("name"))
                lista_valor.push("0")
            }
            if($("#checkbox_mes_formulario_mensual_0").prop("checked")){
                estado=true
                lista_name.push($("#checkbox_mes_formulario_mensual_0").attr("name"))
                lista_valor.push("0")
            }
            if($("#checkbox_serie_formulario_mensual_00_0").prop("checked")){
                estado=true
                lista_name.push($("#checkbox_serie_formulario_mensual_00_0").attr("name"))
                lista_valor.push("00_0")
            }
            if(estado){
                var contador=0
                var aciertos=0
                while(contador<datos.length){
                    if(aciertos<lista_name.length){
                        if(datos[contador].name===lista_name[aciertos]){
                            if(datos[contador].value===lista_valor[aciertos]){
                                datos.splice(contador,1)
                                contador=-1
                                aciertos++

                            }
                        }
                    }
                    contador++
                }
            }
        }
        // console.log(datos)
        $.ajax({
            url: "post/informe_mensual_guardar.php",
            type: "post",
            data:datos
            ,success: function(respuesta) {
                var json=JSON.parse(respuesta);
                // alert("registro")
                console.log(json)
                $('#myModalDescargarBoleta').modal('hide');
                botonVolver();
                
		},error: function(){// will fire when timeout is reached
			// alert("errorXXXXX");
    	}, timeout: 10000 // sets timeout to 3 seconds
	    });
    }
}

function editarInforme(id){
    alert("actualizar ->"+id);
}

function abrirModalEliminar(id){
    $("#mensaje_agregar_modalEliminarRegistro").html('<h5>¿Estás seguro que quieres eliminar este  informe mensual?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">')
    const html=`
    <center><button type='button' class='btn btn-default boton_modal' data-dismiss='modal' id='boton_cerrar_alerta' style='margin-right:20px; border-radius:5px;'><span class='icon'><i class='icon-remove'></i></span> No</button>
        <button type='button' id='eliminar_modal' class='btn btn-default boton_modal ' onClick='botonEliminar(${id});' ng-click='desactivarBotonAgregarBoleta()' style='border-radius:5px;'><span class='icon'><i class='icon-ok'></i></span> Si</button>  
    </center>
    `
    $("#modal-footer-eliminar").html(html)
    $("#modalEliminarRegistro").modal("show")

}

function botonEliminar(id){
    $('#mensaje_agregar_modalEliminarRegistro').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Eliminando informe...</h5><br><img src="../config/remover_archivo.png">');
        $.ajax({
            url: `post/informe_mensual_eliminar.php?id=${id}`,
            type: "get",
            cache: false,
            success: function(respuesta) {
                var respuesta_servidor=JSON.parse(respuesta)
                console.log(respuesta_servidor);
                $("#modalEliminarRegistro").modal("hide")
                consultarTodosLosInformes();
                
		},error: function(){// will fire when timeout is reached
			// alert("error");
    	}, timeout: 10000 // sets timeout to 3 seconds
        });
}

//validaciones formularios
const validarCheckBoxs= (boton,nombre_selector,nombre_propiedad,lista) => {
    var contador=0;
    var validar_checkbox=false;
    while(contador<lista.length){
        if($(`#${nombre_selector}${lista[contador][nombre_propiedad]}`).prop("checked")){
            validar_checkbox=true
        }
        contador++
    }
    if(validar_checkbox){
        $(`#${boton}`).css("background-color", "#fff");
    }
    else{
        $(`#${boton}`).css("background-color", "#ffc6c6");
    }
    return validar_checkbox
}

const validarCamposVacios= (selector) => {
    var estado=false;
    const exprecion=/[A-Za-z]/,
    campo=$(`#${selector}`).val()
    if(campo!=""){
        if(exprecion.test(campo)){
            // alert("OK")
            estado=true;
            $(`#${selector}`).css("background-color", "#fff");
        }
        else{
            // alert("no puede solo enviar espacion en blanco en el informe")
            $(`#${selector}`).css("background-color", "#ffc6c6");
        }
    }
    else{
        // alert("no puede enviar la descripcicón de un informe vacio")
        $(`#${selector}`).css("background-color", "#ffc6c6");
    }
    return estado
}

function ver_informe(id){
    const text=$(`#informe_${id}`).text()
    $("#contenedor_informe").val(text)
    $("#modal_informe").modal("show")
}

const eliminarRegistro= (event) => {
    alert("eliminando registro")
}

const mostrarComponentListaInforme= () => {
    alert("mostrar formulario informe")
}

function buscarInformesFiltro(){
    $("#contenido_tabla").empty()
    $('#error_conexion').hide();
	$('#sin_resultados').hide();
    $('#cargando_buscar').show();
    let array_checkbox_area_filtro_informe_mensual = $('input[name="array_checkbox_area_filtro_informe_mensual[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    // console.log(array_checkbox_area_filtro_informe_mensual)
    if(array_checkbox_area_filtro_informe_mensual.length==1){
        const area=lista_areas_2.filter((area)=>{
            if(area.numero_area===parseInt(array_checkbox_area_filtro_informe_mensual[0])){
                return area
            }
        })
        // console.log(area[0].nombre_area)
        $("#texto_boton_filtro_area").text(`${area[0].nombre_area}`)
    }
    else if(array_checkbox_area_filtro_informe_mensual.length>0){
        if(array_checkbox_area_filtro_informe_mensual.length<=lista_areas_2.length-1){
            if(array_checkbox_area_filtro_informe_mensual.length==lista_areas_2.length-1 && !$("#checkbox_area_filtro_informe_mensual_0").prop("checked")){
                $("#checkbox_area_filtro_informe_mensual_0").prop("checked",true)
                $("#texto_boton_filtro_area").text(`Todos`)
            }
            else{
                if($("#checkbox_area_filtro_informe_mensual_0").prop("checked")){
                    $("#checkbox_area_filtro_informe_mensual_0").prop("checked",false)
                    array_checkbox_area_filtro_informe_mensual.shift()
                }
                
                $("#texto_boton_filtro_area").text(`${array_checkbox_area_filtro_informe_mensual.length} Elementos Selecionados`)
            }
        }
    }
    else{
        // alert("hola")
        $("#texto_boton_filtro_area").text(`Seleccione un Área`)
    }
//////////////////////
    let array_checkbox_mes_filtro_informe_mensual = $('input[name="array_checkbox_mes_filtro_informe_mensual[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    // console.log(array_checkbox_area_filtro_informe_mensual)
    if(array_checkbox_mes_filtro_informe_mensual.length==1){
        const mes=lista_meses.filter((mes)=>{
            if(mes.numero_mes===parseInt(array_checkbox_mes_filtro_informe_mensual[0])){
                return mes
            }
        })
        // console.log(mes[0].nombre_mes)
        $("#texto_boton_filtro_mes").text(`${mes[0].nombre_mes}`)
    }
    else if(array_checkbox_mes_filtro_informe_mensual.length>0){
        if(array_checkbox_mes_filtro_informe_mensual.length<=lista_meses.length-1){
            if(array_checkbox_mes_filtro_informe_mensual.length==lista_meses.length-1 && !$("#checkbox_mes_filtro_informe_mensual_0").prop("checked")){
                $("#checkbox_mes_filtro_informe_mensual_0").prop("checked",true)
                $("#texto_boton_filtro_mes").text(`Todos`)
            }
            else{
                if($("#checkbox_mes_filtro_informe_mensual_0").prop("checked")){
                    $("#checkbox_mes_filtro_informe_mensual_0").prop("checked",false)
                    array_checkbox_mes_filtro_informe_mensual.shift()
                }
                $("#texto_boton_filtro_mes").text(`${array_checkbox_mes_filtro_informe_mensual.length} Elementos Selecionados`)
            }
        }
    }
    else{
        // alert("hola")
        $("#texto_boton_filtro_mes").text(`Seleccione un Área`)
    }

    var repuesta_servidor_2=""
    var valores_filtro=$("#filtro_trabla_informe").serializeArray()
    console.log(valores_filtro)
    valores_filtro.push({name:"operacion",value:2})
    // ano_informe_mensual_filtro
    var valores_filtro_2=[]
    if($("#checkbox_area_filtro_informe_mensual_0").prop("checked") && $("#checkbox_mes_filtro_informe_mensual_0").prop("checked")){
        // console.log(valores_filtro)
        valores_filtro.splice(1,1)
        valores_filtro.splice(7,1)
        console.log(valores_filtro)
        // valores_filtro_2=valores_filtro.shift()//en esta variable contenemos un lista de objetos json pero sin el valor de el chackbox todos
    }
    else{
        var name=""
        var estado=false
        var valor=""
        if($("#checkbox_area_filtro_informe_mensual_0").prop("checked")){
            estado=true
            name=$("#checkbox_area_filtro_informe_mensual_0").attr("name")
            valor="0"
        }
        else if($("#checkbox_mes_filtro_informe_mensual_0").prop("checked")){
            estado=true
            name=$("#checkbox_mes_filtro_informe_mensual_0").attr("name")
            valor="0"
        }
        if(estado){
            var contador=0
            while(contador<valores_filtro.length){
                if(valores_filtro[contador].name===name){
                    if(valores_filtro[contador].value===valor){
                        valores_filtro.splice(contador,1)

                        }
                    }
                contador++
            }
        }
    }
    console.log(valores_filtro)
    valores_filtro_2=valores_filtro
        $.ajax({
            url: "post/informe_mensual_ver.php",
            type: "post",
            data:valores_filtro_2
            ,success: function(respuesta) {
                $('#cargando_buscar').hide();
                var json=JSON.parse(respuesta);
                console.log(json)
                if(json.datos.length>0){
                    var list=[]
                    var contadorx=0
                    while(contadorx<json.datos.length){
                        if(json.datos[contadorx]["array_area_informe_mensual"] && json.datos[contadorx]["array_mes_informe_mensual"]){
                            list.push(json.datos[contadorx])
                        }
                        contadorx++
                    }
                    repuesta_servidor_2={datos:list}
                    var contador=0;
                    while(contador<repuesta_servidor_2.datos.length){
                        if(repuesta_servidor_2.datos[contador]["array_area_informe_mensual"]){
                            var contador2=0;
                            while(contador2<repuesta_servidor_2.datos[contador].array_area_informe_mensual.length){
                                var contador3=0;
                                while(contador3<lista_areas_2.length){
                                    if(repuesta_servidor_2.datos[contador].array_area_informe_mensual[contador2]==lista_areas_2[contador3].numero_area){
                                        repuesta_servidor_2.datos[contador].array_area_informe_mensual[contador2]=lista_areas_2[contador3].nombre_area
                                    }
                                    contador3++
                                }
                                contador2++
                            }
                        }
                        var contador5=0;
                        while(contador5<repuesta_servidor_2.datos[contador].array_serie_informe_mensual.length){
                            var contador6=0;
                            while(contador6<lista_serie.length){
                                if(repuesta_servidor_2.datos[contador].array_serie_informe_mensual[contador5]==lista_serie[contador6].numero_serie){
                                    repuesta_servidor_2.datos[contador].array_serie_informe_mensual[contador5]=lista_serie[contador6].nombre_serie
                                }
                                contador6++
                            }
                            contador5++
                        }
                        
                        if(repuesta_servidor_2.datos[contador]["array_mes_informe_mensual"]){
                            var contador7=0;
                            while(contador7<repuesta_servidor_2.datos[contador].array_mes_informe_mensual.length){
                                var contador8=0;
                                while(contador8<lista_meses.length){
                                    if(repuesta_servidor_2.datos[contador].array_mes_informe_mensual[contador7]==lista_meses[contador8].numero_mes){
                                        repuesta_servidor_2.datos[contador].array_mes_informe_mensual[contador7]=lista_meses[contador8].nombre_mes
                                    }
                                    contador8++
                                }
                            contador7++
                            }
                        }
                        
                        contador++
                    }
                    // console.log(repuesta_servidor_2);
                    if(repuesta_servidor_2.datos.length==0){
                        $('#sin_resultados').show();
                        var markup = '<tr class="sin_fondo" ><td colspan="9"><center><h5 style="color:#555555;margin-top:10px;margin-buttom:10px;"><i class="icon-file-alt"></i> Sin informes mensuales</h5></center></td></tr>';
                        $("#contenido_tabla").append(markup)
                    }
                    else{
                        window.respuesta_servidor=repuesta_servidor_2.datos
                        const dato=repuesta_servidor_2.datos;
                        const filas=crearFilasTabla(dato);
                        agregarFilasTabla("#contenido_tabla",filas);
                    }
                }
                else{
                    $('#sin_resultados').show();
                    var markup = '<tr class="sin_fondo" ><td colspan="9"><center><h5 style="color:#555555;margin-top:10px;margin-buttom:10px;"><i class="icon-file-alt"></i> Sin informes mensuales</h5></center></td></tr>';
                    $("#contenido_tabla").append(markup)
                }
                
                
		},error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#error_conexion').show();
            var markup = '<tr class="sin_fondo" ><td colspan="9"><center><h5 style="color:#555555;margin-top:10px;margin-buttom:10px;"><i class="icon-file-alt"></i> Sin informes mensuales</h5></center></td></tr>';
            $("#contenido_tabla").append(markup)
    	}, timeout: 10000 // sets timeout to 3 seconds
	    });
}

function selecionarTodosAreaFiltro(){
    /*en esta lime conprovamos si el checkbox 0 del filtro area esta activo o no
    y en caso de que este activo activa todos los checkbox del filtro de area o 
    en caso contrario los desactiva
    y ejecuta la busqueda
    */
    if($("#checkbox_area_filtro_informe_mensual_0").prop("checked")){
        lista_areas_2.map((area)=>{
            $(`#checkbox_area_filtro_informe_mensual_${area.numero_area}`).prop("checked",true)
        })
        $("#texto_boton_filtro_area").text(`Todos`)
    }
    else{
        lista_areas_2.map((area)=>{
            $(`#checkbox_area_filtro_informe_mensual_${area.numero_area}`).prop("checked",false)
        })
        $("#texto_boton_filtro_area").text(`Selecione una Área`)
    }
    buscarInformesFiltro()
}

function selecionarTodosMesFiltro(){
    /*en esta lime conprovamos si el checkbox 0 del filtro area esta activo o no
    y en caso de que este activo activa todos los checkbox del filtro de area o 
    en caso contrario los desactiva
    y ejecuta la busqueda
    */
    if($("#checkbox_mes_filtro_informe_mensual_0").prop("checked")){
        lista_meses.map((mes)=>{
            $(`#checkbox_mes_filtro_informe_mensual_${mes.numero_mes}`).prop("checked",true)
        })
        $("#texto_boton_filtro_mes").text(`Todos`)
    }
    else{
        lista_meses.map((mes)=>{
            $(`#checkbox_mes_filtro_informe_mensual_${mes.numero_mes}`).prop("checked",false)
        })
        $("#texto_boton_filtro_mes").text(`Selecione un mes`)
    }
    buscarInformesFiltro()
}

function selecionarTodosMesFormulario(){
    /*en esta lime conprovamos si el checkbox 0 del filtro area esta activo o no
    y en caso de que este activo activa todos los checkbox del filtro de area o 
    en caso contrario los desactiva
    y ejecuta la busqueda
    */
    if($("#checkbox_mes_formulario_mensual_0").prop("checked")){
        lista_meses.map((mes)=>{
            $(`#checkbox_mes_formulario_mensual_${mes.numero_mes}`).prop("checked",true)
        })
        $("#texto_boton_formulario_mes").text(`Todos`)
        activarBotonGuardarInforme()
    }
    else{
        lista_meses.map((mes)=>{
            $(`#checkbox_mes_formulario_mensual_${mes.numero_mes}`).prop("checked",false)
        })
        $("#texto_boton_formulario_mes").text(`Seleccion un Mes`)
    }
}

function selecionarTodosAreaFormulario(){
    /*en esta lime conprovamos si el checkbox 0 del filtro area esta activo o no
    y en caso de que este activo activa todos los checkbox del filtro de area o 
    en caso contrario los desactiva
    y ejecuta la busqueda
    */
    if($("#checkbox_area_formulario_mensual_0").prop("checked")){
        lista_areas_2.map((area)=>{
            $(`#checkbox_area_formulario_mensual_${area.numero_area}`).prop("checked",true)
        })
        $("#texto_boton_formulario_area").text(`Todos`)
        activarBotonGuardarInforme()
    }
    else{
        lista_areas_2.map((area)=>{
            $(`#checkbox_area_formulario_mensual_${area.numero_area}`).prop("checked",false)
        })
        $("#texto_boton_formulario_area").text(`Seleccione una Área`)
    }
}


function selecionarTodosSerieFormulario(){
    /*en esta lime conprovamos si el checkbox 0 del filtro area esta activo o no
    y en caso de que este activo activa todos los checkbox del filtro de area o 
    en caso contrario los desactiva
    y ejecuta la busqueda
    */
    if($("#checkbox_serie_formulario_mensual_00_0").prop("checked")){
        lista_serie.map((serie)=>{
            $(`#checkbox_serie_formulario_mensual_${serie.numero_serie}`).prop("checked",true)
        })
        $("#texto_boton_formulario_serie").text(`Todos`)
        activarBotonGuardarInforme()
    }
    else{
        lista_serie.map((serie)=>{
            $(`#checkbox_serie_formulario_mensual_${serie.numero_serie}`).prop("checked",false)
        })
        $("#texto_boton_formulario_serie").text(`Seleccione una Serie`)
    }
}

const consultarTodosLosInformes=() => {
    $("#contenido_tabla").empty()
    $('#error_conexion').hide();
	$('#sin_resultados').hide();
    $('#cargando_buscar').show();
    var repuesta_servidor_2=""
    $.ajax({
            url: "post/informe_mensual_ver.php",
            type: "post",
            cache: false,
            data:[{name:"operacion",value:1}]
            ,success: function(respuesta) {
                $('#cargando_buscar').hide();
                const json=JSON.parse(respuesta)
                repuesta_servidor_2=json
                // console.log(repuesta_servidor_2)
                var contador=0;
                while(contador<repuesta_servidor_2.datos.length){
                    var contador2=0;
                    while(contador2<repuesta_servidor_2.datos[contador].array_area_informe_mensual.length){
                        var contador3=0;
                        while(contador3<lista_areas_2.length){
                            if(repuesta_servidor_2.datos[contador].array_area_informe_mensual[contador2]==lista_areas_2[contador3].numero_area){
                                repuesta_servidor_2.datos[contador].array_area_informe_mensual[contador2]=lista_areas_2[contador3].nombre_area
                            }
                            contador3++
                        }
                        contador2++
                    }
                    var contador5=0;
                    while(contador5<repuesta_servidor_2.datos[contador].array_serie_informe_mensual.length){
                        var contador6=0;
                        while(contador6<lista_serie.length){
                            if(repuesta_servidor_2.datos[contador].array_serie_informe_mensual[contador5]==lista_serie[contador6].numero_serie){
                                repuesta_servidor_2.datos[contador].array_serie_informe_mensual[contador5]=lista_serie[contador6].nombre_serie
                            }
                            contador6++
                        }
                        contador5++
                    }
                    var contador7=0;
                    while(contador7<repuesta_servidor_2.datos[contador].array_mes_informe_mensual.length){
                        var contador8=0;
                        while(contador8<lista_meses.length){
                            if(repuesta_servidor_2.datos[contador].array_mes_informe_mensual[contador7]==lista_meses[contador8].numero_mes){
                                repuesta_servidor_2.datos[contador].array_mes_informe_mensual[contador7]=lista_meses[contador8].nombre_mes
                            }
                            contador8++
                        }
                        contador7++
                    }
                    contador++
                }
                if(repuesta_servidor_2.datos.length==0){
                    $('#sin_resultados').show();
                    var markup = '<tr class="sin_fondo" ><td></td><td style="height:auto; width:10px;"></td><td></td><td><center><h5 style="color:#555555;margin-top:10px;margin-buttom:10px;"><i class="icon-file-alt"></i> Sin informes mensuales</h5></center></td></tr>';
                    $("#contenido_tabla").append(markup)
                }
                else{
                    console.log(repuesta_servidor_2.datos)
                    window.respuesta_servidor=repuesta_servidor_2.datos
                    const datos=repuesta_servidor_2.datos;
                    const filas=crearFilasTabla(datos);
                    var tabla=document.getElementById("contenido_tabla");
                    agregarFilasTabla("#contenido_tabla",filas);
                }
		},error: function(){// will fire when timeout is reached
            $('#cargando_buscar').hide();
            $('#error_conexion').show();
            var markup = '<tr class="sin_fondo" ><td></td><td style="height:80px; width:10px;"></td><td></td><td><center><h5 style="color:#555555;margin-top:10px;margin-buttom:10px;"><i class="icon-file-alt"></i> Sin informes mensuales</h5></center></td></tr>';
            $("#contenido_tabla").append(markup)
			// alert("error");
    	}, timeout: 10000 // sets timeout to 3 seconds
	    });
}



const crearFilasTabla= (datos) =>{
    var numero_fila=0;
    const filas = datos.map((informe) => {
        const fila=`
            <tr class='panel_buscar' style='cursor:pointer; color:#555555; font-size:13px;' id='fila_informe_${informe.idinforme_mensual}'>
                <td style="text-align:left;" onClick='ver_informe(${informe.idinforme_mensual});'>
                    <div style='max-width:100%'>
                        <center class='ellipsis-text'>
                            ${numero_fila+1}
                        </center>  
                    </div>
                </td>
                <td style="text-align:left;" onClick='ver_informe(${informe.idinforme_mensual});'>
                    <div style='max-width:90px'>
                        <p class='ellipsis-text'>
                        ${(informe.array_mes_informe_mensual.length==(lista_meses.length-1))?"Todos":informe.array_mes_informe_mensual.join(",")}
                        </p>  
                    </div>
                </td>
                <td style="text-align:left;" onClick='ver_informe(${informe.idinforme_mensual});'>
                    <div style='max-width:200px'>
                        <p class='ellipsis-text'>
                        ${(informe.array_area_informe_mensual.length==(lista_areas_2.length-1))?"Todos":informe.array_area_informe_mensual.join(",")}
                        </p>  
                    </div>
                </td>
                <td style="text-align:left;" onClick='ver_informe(${informe.idinforme_mensual});'>
                    <div style='max-width:70px'>
                        <p class='ellipsis-text'>
                        ${(informe.array_serie_informe_mensual.length==(lista_serie.length-1))?"Todos":informe.array_serie_informe_mensual.join(",")}
                        </p>  
                    </div>
                </td>
                <td style="text-align:left;" onClick='ver_informe(${informe.idinforme_mensual});'>
                    <div style='max-width:90px'>
                        <p class='ellipsis-text'>
                        ${informe.nombre_usuario_software}
                        </p>  
                    </div>
                </td>
                <td style="text-align:left;" onClick='ver_informe(${informe.idinforme_mensual});'>
                    <div style='max-width:150px'>
                        <p class='ellipsis-text' id='informe_${informe.idinforme_mensual}'>
                            ${informe.descripcion_informe_mensual}
                        </p>  
                    </div>
                </td>
                <td style='padding:5px;'>
                    <center>
                        <a class='boton_add' onClick='descargarPDF(${informe.idinforme_mensual});'>
                            <i class='icon-download-alt'></i>
                        </a>
                    </center>
                </td>
                <td style='padding:5px;'>
                    <center >
                        <a class='boton_editar'   onClick='mostrarComponentFormularEditar(${numero_fila});'>
                            <i class='icon-pencil'></i>
                        </a>
                    </center>
                </td>
                <td style='padding:5px;'>
                    <center>
                        <a class='boton_eliminar' onClick='abrirModalEliminar(${informe.idinforme_mensual});'>
                            <i class="icon-remove"></i>
                        </a>
                    </center>
                </td>
            </tr>
            `;
            numero_fila++;
            return fila;
    })
    return filas;
}

const agregarFilasTabla=(tabla,filas)=> {
    var contador=0;
    while(contador<filas.length){
        $(tabla).append(filas[contador]);
        contador++
    }
}

function descargarPDF(id){
    const descripcion_informe_mensual=$(`#informe_${id}`).text()
    const registro=respuesta_servidor.filter((informe_mensual=>{
        if(informe_mensual.idinforme_mensual===`${id}`){
            return informe_mensual
        }
    }))
    // console.log(registro)
    registro[0]["areas"]=registro[0].array_area_informe_mensual.join(", ")
    registro[0]["series"]=registro[0].array_serie_informe_mensual.join(", ")
    registro[0]["meses"]=registro[0].array_mes_informe_mensual.join(", ")
    $("#descargarPDF").modal('show');
    $('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');
    $.ajax({
        url: `post/reportes/generarPDF_informe_mensual.php?descripcion_informe_mensual=${descripcion_informe_mensual}&meses=${registro[0]["meses"]}&areas=${registro[0]["areas"]}&series=${registro[0]["series"]}`,
        type: "get",
        cache: false,
        dataType:"json"
        ,success:(respuesta) => {
            if(respuesta != ''){
                $('#mensaje_agregar_descargarPDF').html('<h5>PDF Generado Exitosamente...</h5><br><button type="submit" class="boton_informe_jugador" style="border-radius: 5px" id="boton_agregar_informe" ><a  class="btn_descargar" onClick="closeModal_pdf();" download href="reportes_pdf/'+respuesta+'">DESCARGAR PDF</a></button>');
            }else{
                $('#mensaje_agregar_descargarPDF').html('<h5>Error de conexión: los datos no se han podido insertar.</h5><br>');
            }
        },
        error:(error)=>{
            $('#mensaje_agregar_descargarPDF').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    })
}

function closeModal_pdf(){
    $("#descargarPDF").modal('hide');
}

function activarBotonGuardarInforme(){
    let array_checkbox_serie_formulario_mensual = $('input[name="array_checkbox_serie_formulario_mensual[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    // console.log(array_checkbox_serie_formulario_mensual)
    if(array_checkbox_serie_formulario_mensual.length==1){
        const serie=lista_serie.filter((serie)=>{
            if(serie.numero_serie===array_checkbox_serie_formulario_mensual[0]){
                return serie
            }
        })
        // console.log(serie[0].nombre_serie)
        $("#texto_boton_formulario_serie").text(`${serie[0].nombre_serie}`)
    }
    else if(array_checkbox_serie_formulario_mensual.length>0){
        if(array_checkbox_serie_formulario_mensual.length<=lista_serie.length-1){
            if(array_checkbox_serie_formulario_mensual.length==lista_serie.length-1 && !$("#checkbox_serie_formulario_mensual_00_0").prop("checked")){
                $("#checkbox_serie_formulario_mensual_00_0").prop("checked",true)
                $("#texto_boton_formulario_serie").text(`Todos`)
            }
            else{
                if($("#checkbox_serie_formulario_mensual_00_0").prop("checked")){
                    $("#checkbox_serie_formulario_mensual_00_0").prop("checked",false)
                    array_checkbox_serie_formulario_mensual.shift()
                }
                $("#texto_boton_formulario_serie").text(`${array_checkbox_serie_formulario_mensual.length} Elementos Selecionados`)
            }
        }
    }
    else{
        // alert("hola")
        $("#texto_boton_formulario_serie").text(`Seleccione un Serie`)
    }


    /////////////////////////////////////////
    let array_checkbox_mes_formulario_mensual= $('input[name="array_checkbox_mes_formulario_mensual[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    if(array_checkbox_mes_formulario_mensual.length==1){
        const mes=lista_meses.filter((mes)=>{
            if(mes.numero_mes===parseInt(array_checkbox_mes_formulario_mensual[0])){
                return mes
            }
        })
        // console.log(mes[0].nombre_mes)
        $("#texto_boton_formulario_mes").text(`${mes[0].nombre_mes}`)
    }
    else if(array_checkbox_mes_formulario_mensual.length>0){
        if(array_checkbox_mes_formulario_mensual.length<=lista_meses.length-1){
            if(array_checkbox_mes_formulario_mensual.length==lista_meses.length-1 && !$("#checkbox_mes_formulario_mensual_0").prop("checked")){
                $("#checkbox_mes_formulario_mensual_0").prop("checked",true)
                $("#texto_boton_formulario_mes").text(`Todos`)
            }
            else{
                if($("#checkbox_mes_formulario_mensual_0").prop("checked")){
                    $("#checkbox_mes_formulario_mensual_0").prop("checked",false)
                    array_checkbox_mes_formulario_mensual.shift()
                }
                
                $("#texto_boton_formulario_mes").text(`${array_checkbox_mes_formulario_mensual.length} Elementos Selecionados`)
            }
        }
    }
    else{
        // alert("hola")
        $("#texto_boton_formulario_mes").text(`Seleccione un Mes`)
    }


    ////////
    let array_checkbox_area_formulario_mensual= $('input[name="array_checkbox_area_formulario_mensual[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    if(array_checkbox_area_formulario_mensual.length==1){
        const area=lista_areas_2.filter((area)=>{
            if(area.numero_area===parseInt(array_checkbox_area_formulario_mensual[0])){
                return area
            }
        })
        // console.log(area[0].nombre_area)
        $("#texto_boton_formulario_area").text(`${area[0].nombre_area}`)
    }
    else if(array_checkbox_area_formulario_mensual.length>0){
        if(array_checkbox_area_formulario_mensual.length<=lista_areas_2.length-1){
            if(array_checkbox_area_formulario_mensual.length==lista_areas_2.length-1 && !$("#checkbox_area_formulario_mensual_0").prop("checked")){
                $("#checkbox_area_formulario_mensual_0").prop("checked",true)
                $("#texto_boton_formulario_area").text(`Todos`)
            }
            else{
                if($("#checkbox_area_formulario_mensual_0").prop("checked")){
                    $("#checkbox_area_formulario_mensual_0").prop("checked",false)
                    array_checkbox_area_formulario_mensual.shift()
                }
                $("#texto_boton_formulario_area").text(`${array_checkbox_area_formulario_mensual.length} Elementos Selecionados`)
            }
        }
    }
    else{
        // alert("hola")
        $("#texto_boton_formulario_area").text(`Seleccione un Área`)
    }

    // Validando que al menos un medio de transporte sea seleccionado:
    // const descripcion_informe_mensual=validarCamposVacios("descripcion_informe_mensual");
    var estado=false;
    const exprecion=/[A-Za-z]/,
    campo=$(`#descripcion_informe_mensual`).val()
    if(campo!=""){
        if(exprecion.test(campo)){
            // alert("OK")
            estado=true;
        }
    }
    if ( array_checkbox_mes_formulario_mensual.length > 0 &&  array_checkbox_area_formulario_mensual.length > 0 && array_checkbox_serie_formulario_mensual.length > 0 && estado) {
        $("#boton_agregar_infrome").prop("disabled",false)
    }
    else {
        $("#boton_agregar_infrome").prop("disabled",true)
    }
}

</script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript">
    $("#component_formulario_informe_semanal").hide()
    consultar_ano_actual()
    // $("#cuadro_listado_informe_semanal").hide(500)
    $('.fecha_final').datetimepicker({
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
    $('.fecha_final').datetimepicker('setDate', new Date() );
    mostrar_al_cargar_pagina();
    $(document).on('click', '.option', function(e) { //
        e.stopPropagation();
    });
    $('.c_objetivo_fisico li').click(function (e) { e.stopPropagation(); });
    $("#boton_area").on("click",()=>{
        const lis=lista_areas_2.map((area)=>{
            /*en esta variable almacenamos el nombre de la funcion que ejecutara el checkbox al hacer onclick
            si la condicion es true significa que el checkbox tiene el metodo para activar o desactivar los demas checkbox (selecionarTodosAreaFiltro)
            en el filtro y asubes realiza una consulta al servidor y es caso que sea false solo tiene el metodo que ejecuta una consulta al servidor del cual es (buscarInformesFiltro)
            */
            const funcion=(area.numero_area==0)?'selecionarTodosAreaFiltro':'buscarInformesFiltro'

            return `<li><label class='option'><span class='label_s'>${area.nombre_area}</span> <input type='checkbox' id='checkbox_area_filtro_informe_mensual_${area.numero_area}' name='array_checkbox_area_filtro_informe_mensual[]' value='${area.numero_area}' data-eliminar='0' onclick='${funcion}()' ></label></li>`
        })
        if($("#tipo_area").html()!=""){
            console.log("no esta basio")
        }
        else{
            console.log("esta basio")
            lis.map((lista)=>{
                $("#tipo_area").html($("#tipo_area").html()+lista)
            })
        }
    });
    $("#boton_mes").on("click",()=>{
        const lis=lista_meses.map((mes)=>{
            /*en esta variable almacenamos el nombre de la funcion que ejecutara el checkbox al hacer onclick
            si la condicion es true significa que el checkbox tiene el metodo para activar o desactivar los demas checkbox (selecionarTodosMesFiltro)
            en el filtro y asubes realiza una consulta al servidor y es caso que sea false solo tiene el metodo que ejecuta una consulta al servidor del cual es (buscarInformesFiltro)
            */
            const funcion=(mes.numero_mes==0)?'selecionarTodosMesFiltro':'buscarInformesFiltro'

            return `<li><label class='option'><span class='label_s'>${mes.nombre_mes}</span> <input type='checkbox' id='checkbox_mes_filtro_informe_mensual_${mes.numero_mes}' name='array_checkbox_mes_filtro_informe_mensual[]' value='${mes.numero_mes}' data-eliminar='0' onclick='${funcion}()' ></label></li>`
        })
        if($("#tipo_mes").html()!=""){
            console.log("no esta basio")
        }
        else{
            console.log("esta basio")
            lis.map((lista)=>{
                $("#tipo_mes").html($("#tipo_mes").html()+lista)
            })
        }
    });

    $("#boton_area_formulario").on("click",()=>{
        var contador=0
        var estado=true
        const lis=lista_areas_2.map((area)=>{
            // mejor copiar este 
            // console.log(window.tipo_formulario)
            const funcion=(area.numero_area===0)?'selecionarTodosAreaFormulario()':'activarBotonGuardarInforme()'
            if(!window.tipo_formulario){
                if(area.numero_area===0){
                    if(window.respuesta_servidor[window.index_array_informe_mensual].array_area_informe_mensual.length==6 && estado){
                        estado=false
                        return `<li><label class='option'><span class='label_s'>${area.nombre_area}</span> <input type='checkbox' checked id='checkbox_area_formulario_mensual_${area.numero_area}' name='array_checkbox_area_formulario_mensual[]' value='${area.numero_area}' data-eliminar='0' onchange='${funcion}' ></label></li>`
                    }
                    else{
                        estado=false
                        return `<li><label class='option'><span class='label_s'>${area.nombre_area}</span> <input type='checkbox' id='checkbox_area_formulario_mensual_${area.numero_area}' name='array_checkbox_area_formulario_mensual[]' value='${area.numero_area}' data-eliminar='0' onchange='${funcion}' ></label></li>`
                    }
                }
                while(contador<window.respuesta_servidor[window.index_array_informe_mensual].array_area_informe_mensual.length){
                    
                    if(area.nombre_area==window.respuesta_servidor[window.index_array_informe_mensual].array_area_informe_mensual[contador]){
                        contador++
                        return `<li><label class='option'><span class='label_s'>${area.nombre_area}</span> <input type='checkbox' checked id='checkbox_area_formulario_mensual_${area.numero_area}' name='array_checkbox_area_formulario_mensual[]' value='${area.numero_area}' data-eliminar='0' onchange='activarBotonGuardarInforme()' ></label></li>`
                    }
                    break
                }
                return `<li><label class='option'><span class='label_s'>${area.nombre_area}</span> <input type='checkbox' id='checkbox_area_formulario_mensual_${area.numero_area}' name='array_checkbox_area_formulario_mensual[]' value='${area.numero_area}' data-eliminar='0' onchange='activarBotonGuardarInforme()' ></label></li>`
            }
            else{
                return `<li><label class='option'><span class='label_s'>${area.nombre_area}</span> <input type='checkbox' id='checkbox_area_formulario_mensual_${area.numero_area}' name='array_checkbox_area_formulario_mensual[]' value='${area.numero_area}' data-eliminar='0' onchange='${funcion}' ></label></li>`
            }
        })
        
        if($("#tipo_area_formulario").html()!=""){
            console.log("no esta vacio")
        }
        else{
            lis.map((lista)=>{
            $("#tipo_area_formulario").append(lista)
            })
        }
    });

    $("#boton_mes_formulario").on("click",()=>{
        var contador=0
        var estado=true
        const lis=lista_meses.map((mes)=>{
            // mejor copiar este 
            // console.log(window.tipo_formulario)
            const funcion=(mes.numero_mes===0)?'selecionarTodosMesFormulario()':'activarBotonGuardarInforme()'
            if(!window.tipo_formulario){
                if(mes.numero_mes===0){
                    if(window.respuesta_servidor[window.index_array_informe_mensual].array_mes_informe_mensual.length==12 && estado){
                        estado=false
                        return `<li><label class='option'><span class='label_s'>${mes.nombre_mes}</span> <input type='checkbox' checked id='checkbox_mes_formulario_mensual_${mes.numero_mes}' name='array_checkbox_mes_formulario_mensual[]' value='${mes.numero_mes}' data-eliminar='0' onchange='${funcion}' ></label></li>`
                    }
                    else{
                        estado=false
                        return `<li><label class='option'><span class='label_s'>${mes.nombre_mes}</span> <input type='checkbox' id='checkbox_mes_formulario_mensual_${mes.numero_mes}' name='array_checkbox_mes_formulario_mensual[]' value='${mes.numero_mes}' data-eliminar='0' onchange='${funcion}' ></label></li>`
                    }
                }
                while(contador<window.respuesta_servidor[window.index_array_informe_mensual].array_mes_informe_mensual.length){
                    
                    if(mes.nombre_mes==window.respuesta_servidor[window.index_array_informe_mensual].array_mes_informe_mensual[contador]){
                        contador++
                        return `<li><label class='option'><span class='label_s'>${mes.nombre_mes}</span> <input type='checkbox' checked id='checkbox_mes_formulario_mensual_${mes.numero_mes}' name='array_checkbox_mes_formulario_mensual[]' value='${mes.numero_mes}' data-eliminar='0' onchange='activarBotonGuardarInforme()' ></label></li>`
                    }
                    break
                }
                
                return `<li><label class='option'><span class='label_s'>${mes.nombre_mes}</span> <input type='checkbox' id='checkbox_mes_formulario_mensual_${mes.numero_mes}' name='array_checkbox_mes_formulario_mensual[]' value='${mes.numero_mes}' data-eliminar='0' onchange='activarBotonGuardarInforme()' ></label></li>`
            }
            else{
                return `<li><label class='option'><span class='label_s'>${mes.nombre_mes}</span> <input type='checkbox' id='checkbox_mes_formulario_mensual_${mes.numero_mes}' name='array_checkbox_mes_formulario_mensual[]' value='${mes.numero_mes}' data-eliminar='0' onchange='${funcion}' ></label></li>`
            }
        })

        
        if($("#tipo_mes_formulario").html()!=""){
            console.log("no esta vacio")
        }
        else{
            lis.map((lista)=>{
            $("#tipo_mes_formulario").append(lista)
            })
        }
    });

    $("#boton_serie").on("click",(e)=>{
        var contador_serie=0;
        var estado=true
        const lis=lista_serie.map((serie)=>{
            const funcion=(serie.numero_serie==="00_0")?'selecionarTodosSerieFormulario()':'activarBotonGuardarInforme()'
            if(!window.tipo_formulario){
                if(serie.numero_serie==="00_0"){
                    if(window.respuesta_servidor[window.index_array_informe_mensual].array_serie_informe_mensual.length==15 && estado){
                    estado=false
                    return `<li><label class='option'><span class='label_s'>${serie.nombre_serie}</span> <input type='checkbox' checked id='checkbox_serie_formulario_mensual_${serie.numero_serie}' name='array_checkbox_serie_formulario_mensual[]' value='${serie.numero_serie}' data-eliminar='0' onchange='${funcion}' ></label></li>`
                    }
                    else{
                        estado=false
                        return `<li><label class='option'><span class='label_s'>${serie.nombre_serie}</span> <input type='checkbox' id='checkbox_serie_formulario_mensual_${serie.numero_serie}' name='array_checkbox_serie_formulario_mensual[]' value='${serie.numero_serie}' data-eliminar='0' onchange='${funcion}' ></label></li>`
                    }
                }
                while(contador_serie<window.respuesta_servidor[window.index_array_informe_mensual].array_serie_informe_mensual.length){
                    
                    if(serie.nombre_serie==window.respuesta_servidor[window.index_array_informe_mensual].array_serie_informe_mensual[contador_serie]){
                        contador_serie++
                        return `<li><label class='option'><span class='label_s'>${serie.nombre_serie}</span> <input type='checkbox' checked id='checkbox_serie_formulario_mensual_${serie.numero_serie}' name='array_checkbox_serie_formulario_mensual[]' value='${serie.numero_serie}' data-eliminar='0' onchange='activarBotonGuardarInforme()' ></label></li>`
                    }
                    break//<---- no remover queda en un loop infinito por alguna razon
                }
                return `<li><label class='option'><span class='label_s'>${serie.nombre_serie}</span> <input type='checkbox' id='checkbox_serie_formulario_mensual_${serie.numero_serie}' name='array_checkbox_serie_formulario_mensual[]' value='${serie.numero_serie}' data-eliminar='0' onchange='activarBotonGuardarInforme()' ></label></li>`
            }
            else{
                return `<li><label class='option'><span class='label_s'>${serie.nombre_serie}</span> <input type='checkbox' id='checkbox_serie_formulario_mensual_${serie.numero_serie}' name='array_checkbox_serie_formulario_mensual[]' value='${serie.numero_serie}' data-eliminar='0' onchange='${funcion}' ></label></li>`
            }
        })
        // $("#tipo_serie").empty()
        if($("#tipo_serie").html()!=""){
            console.log("no esta vacio")
        }
        else{
            lis.map((lista)=>{
            $("#tipo_serie").append(lista)
        })
        }
        
    });
</script>
