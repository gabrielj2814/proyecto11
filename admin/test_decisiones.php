<?PHP
include('../config/datos.php');
session_start();
if(!(isset($_SESSION["nombre_usuario_software"]))){
    session_destroy();
    header('Location: ../index.php?cerrar_sesion=1');
}
else{
    $menu_actual="test";
    $submenu_actual="test_decisiones_jugador";
    $seccion_comentarios = $comentarios['test_decisiones_jugador'];//mis cuotas
    $demo_seccion = $demo['test_decisiones_jugador'];
    $nombre_pestana_navegador='Test';

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
        <title><?php echo $nombre_pestana_navegador;?> | Decision</title>

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

            .boton-abrir-formulario{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 3px solid #555; 
                color: #555;
                border-radius:5px;
            }
            .boton-abrir-formulario:hover{
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
                /* color:white; */
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
                border: 1px solid #0b3b99; 
                color: #0b3b99;
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
                border: 3px solid #0b3b99; 
                color: #0b3b99;
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
        .boton-abrir-formulario{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 3px solid #555555; 
                color: #555555;
                border-radius:5px;
            }
            .boton-abrir-formulario:hover{
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
        .boton-abrir-formulario:disabled{
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
        margin:0px; border-bottom-left-radius:2px; border-top-left-radius:2px; margin-left: 0px; margin-right: 0px; width: 90px; margin-top:0px; background-color:<?php echo $color_fondo; ?>; font-size: 10px; margin-bottom:0px;
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
            border: 2px solid #001b73!important;
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
        /*------------------------------------*/
        .textarea-text-align-left{
            text-align:left!important;
            white-space: normal!important;
        }

        
        </style>
        <style>/* estilo modal jugador*/
                        .contenedor_modal_formulario{
                            width: 75%;
                            height: 50%;
                            left: 0%;
                            background-color: #fff;
                            margin-left: 20%;
                            /* margin-right: 20%; */
                            border-radius: 0px;
                            margin-top:70px;
                            border-radius: 5px;
                            box-sizing: border-box;
                            
                        }
                        .encabezado_modal{
                            width: 100%;
                            height: 70px;
                            box-sizing: border-box;
                        }
                        .contenedor_nombre_jugador{
                            /* background-color: grey; */
                            width: 100%;
                            height: 140px;
                            box-sizing: border-box;
                            padding-top: 90px;
                        }
                        .contenedor_foto_jugador{
                            background-color: #fff;
                            width: 126px;
                            height: 126px;
                            box-sizing: border-box;
                            position: absolute;
                            margin-left: 43.5%;
                            margin-right: 43.5%;
                            margin-top: 24px;
                            border-radius: 67px;
                            border:2px solid #dcdcdc;
                        }
                        .caja_nombre_jugador{
                            background-color: #fff;
                            width: 15%;
                            margin-left: 42.5%;
                            margin-right: 42.5%;
                            text-align: center;
                            border-top: 2px solid #555;
                            box-sizing: border-box;
                            border-bottom: 2px solid #555;
                        }
                        .nombre_jugador{
                            font-weight: bold;
                            display: block;
                        }
                        .serie_jugador{
                            font-weight: bold;
                            display: block;
                        }
                        .tabla_detalle_atencion_seguimiento{
                            /* background-color: grey; */
                            width: 70%;
                            /* height: 500px; */
                            margin-left: 15%;
                            margin-right: 15%;
                            border: 2px solid #555;
                        }
                        .row_tabla{
                            width: 100%;
                            height: 30px;
                            box-sizing: border-box;
                            border-bottom: 2px solid #555;
                            display: flex;
                            flex-direction: row;

                        }
                        .celda_propiedad{
                            width: 30%;
                            height: 100%;
                            background-color: #2099f4;
                            border-right: 2px solid #555;
                            box-sizing: border-box;
                            color: #fff;
                            padding-left: 5px;
                        }
                        .celda_valor{
                            width: 70%;
                            height: 100%;
                            background-color: #fff;
                            box-sizing: border-box;
                            padding-left: 5px;
                        }
                    .test-box-model{
                        box-sizing: border-box;
                        border:1px solid #111;
                    }
                    </style>
                    <style>
                        /* estilos graficos */
                        .highcharts-figure, .highcharts-data-table table {
                            /* min-width: 310px; 
                            max-width: 800px; */
                            width: 100%;
                            height: 300px;
                            margin: 1em auto;
                        }

                        #container {
                            height: 100%;
                        }

                        .highcharts-data-table table {
                            font-family: Verdana, sans-serif;
                            border-collapse: collapse;
                            border: 1px solid #EBEBEB;
                            margin: 10px auto;
                            text-align: center;
                            width: 100%;
                            max-width: 500px;
                        }
                        .highcharts-data-table caption {
                        padding: 1em 0;
                        font-size: 1.2em;
                        color: #555;
                        }
                        .highcharts-data-table th {
                            font-weight: 600;
                        padding: 0.5em;
                        }
                        .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
                        padding: 0.5em;
                        }
                        .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
                        background: #f8f8f8;
                        }
                        .highcharts-data-table tr:hover {
                        background: #f1f7ff;
                        }
                                            </style>
                    
                    <link rel="stylesheet" href="flags/flags.css" />
                    <link rel="stylesheet" href="flags/flags.min.css" />
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
<link   href="subir_imagen3/croppie.css" rel="stylesheet"/>
<script src="subir_imagen3/croppie.js"></script>
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
    <body onload="setInterval(refrescar, 1000)" ng-controller="controlador_1" ng-app="App_Angular" id="angularData" >
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
        <div id="content" style="min-height: 100vh;">
            <!--breadcrumbs--><!-- migas de pan-->
            <div id="content-header">
                <div id="breadcrumb"> 
                        <a title="Go to Home" class="tip-bottom">
                            <i class="icon-home"></i> Inicio
                        </a> 
                        <a class="tip-bottom">
                            <i class="icon-truck"></i>Primera A
                        </a> 
                </div>
            </div>
            <!-- End-breadcrumbs-->
            <!-- gif de carga -->
            <div class="container-fluid" id="cargando_pagina">
                <center>
                <img src="" style="margin-top:100px;" id="cargando_final">
                <script>$('#cargando_final').attr('src',imagen_cargando.src);</script>
                </center>
            </div>
            <div  style="display:none;" id="pagina" style="padding:0px;height: auto;">
                <?php if(($software_demo && $demo_seccion) || !$software_demo){?>
                    <!-- #303030 -->
                    <!-- #25282a -->
                    <!-- #39b682 -->
                    <!-- #ff5b4d -->
                    <!-- #404040 -->
                    <!-- #a2a2a2 -->
                    <!-- #0b3b99 -->
                    <!-- ======================================================================= -->
                    <!-- INICIO TEST OCULAR -->
                    <div id="vista_test" style="height:auto;" >
                        <!--------------------------------  MODAL INFORME PDF INICIO-------------------------------------------->
                        <div id="descargarPDF" class="modal hide" style="border-radius:10px;">
                            <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
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
                        <div id="modalInicioTest" class="modal hide" style="border-radius:10px;">
                                <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
                                </div>
                                <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
                                <center>
                                        <br>
                                        <div id="mensaje_agregar_DescargarBoleta_inicio_test">
                                        <h5><!--mensaje modal --></h5>
                                        </div>
                                        <br>
                                </center>
                                </div>
                                <div class="modal-footer" style="background-color: <?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
                                    
                                    <center>
                                        <div id="contendor_botones_modal_inicio_test">
                                            <button type="button" class="btn btn-default boton_modal" onClick="cerrarModalAtencionDiariaNuevo()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>
                                            <button type="button" id="guardar" class="btn btn-default boton_modal " onClick="agregarNuevoTratamiento()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button>
                                        </div>
                                    </center>
                                    
                                </div>
                        </div>
<!-- ================================================================= -->
                        <div id="modalInicioTestInfo" class="modal hide" style="border-radius:10px;width: 74%;margin-left: -365px;margin-top:-30px;">
                                <div class="modal-header" style="background-color: #1c438c; border-top-right-radius: 5px; border-top-left-radius: 5px;height: 75px;">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <div style="box-sizing: border-box;border:0;width:100%;height: 75px;display:inline-flex;flex-direction:row;flex-wrap:wrap;">
                                    
                                        <div style="box-sizing: border-box;border:0;width:20%;height: 75px;">
                                        </div>

                                        <div style="box-sizing: border-box;border:0;width:60%;height: 75px;padding-top:21px;">

                                            <div style="box-sizing: border-box;border:0;color:#fff;font-size:15px;font-weight: bold;text-align:center;margin-bottom:10px;">EVALUACIÓN TIMPO DE REACCIÓN </div>
                                            <div style="box-sizing: border-box;border:0;width:80%;height: 29px;color:#fff;margin-left:auto;margin-right:auto;">
                                                <div style="box-sizing: border-box;border:0;width:60%;height: 29px;float:left;font-weight: bold;">
                                                    Fecha: <span id="fechaModalInfo" style="font-weight: normal;">xxxxxx</span>
                                                </div>
                                                <div style="box-sizing: border-box;border:0;width:40%;height: 29px;float:right;text-align:right;font-weight: bold;">
                                                    Categoría: <span style="font-weight: normal;">Primer Equipo</span>
                                                </div>
                                            </div>

                                        </div>

                                        <div style="box-sizing: border-box;border:0;width:20%;height: 75px;color:#fff;text-align:center;line-height:75px;font-weight: bold;">

                                            Neurociencias

                                        </div>
                                    </div>
                                    
                                </div>
                                <img src="../config/logo_equipo.png" alt="logo_equipo" style="box-sizing: border-box;border:0;display:block;position:absolute;top: 10px;left: 15px;width:150px;height:150px;z-index: 1;">
                                <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;padding-top:70px;">
                                    <div style="box-sizing: border-box;border:0;margin-left:auto;margin-right:auto;color:#555;font-weight: bold;text-align:center;margin-bottom:10px;">RESULTADO</div>
                                    <div style="box-sizing: border-box;border:0;height: 125px;overflow: scroll;overflow-x: hidden;">

                                        <table style="box-sizing:border-box;border:0;width:100%;">
                                            <thead>
                                            <tr style="box-sizing:border-box;border:0;width:100%;height:20px;background-color:#555;text-transform:uppercase;font-size:10px;color:#fff;font-weight: bold;">
                                                <th  style="border:0;height:20px;line-height:20px;/*border-right:1px solid #111;*/text-align: center; max-width: 2px;" >
                                                    #
                                                </th>
                                                <th style="border:0;height:20px;line-height:20px;/*border-right:1px solid #111;*/text-align: center;max-width: 18px;" >JUGADOR</th>
                                                <th style="border:0;height:20px;line-height:20px;/*border-right:1px solid #111;*/text-align: center;max-width: 10px;" >1</th>
                                                <th style="border:0;height:20px;line-height:20px;/*border-right:1px solid #111;*/text-align: center;max-width: 10px;" >2</th>
                                                <th style="border:0;height:20px;line-height:20px;/*border-right:1px solid #111;*/text-align: center;max-width: 10px;" >3</th>
                                                <th style="border:0;height:20px;line-height:20px;/*border-right:1px solid #111;*/text-align: center;max-width: 10px;" >4</th>
                                                <th style="border:0;height:20px;line-height:20px;/*border-right:1px solid #111;*/max-width: 36px;    text-align: left;" >POSICIÓN</th>
                                            </tr>
                                                
                                            </thead>
                                            
                                            <tbody id="tabla_info" style="font-size: 10px;background-color:#fff;">
                                            
                                                <!-- <tr style="box-sizing:border-box;border:0;height:50px;color:#555;font-size:10px;">
                                                    <th  id="numero_rank_tabla" style="border:0;height:50px;line-height:50px;/*border-right:1px solid #111;*/text-align: center; max-width: 10px;font-weight: bold;" >
                                                        RANK
                                                    </th>
                                                    <th style="border:0;height:50px;line-height:50px;/*border-right:1px solid #111;*/text-align: center; max-width: 10px;font-weight: bold;" >
                                                        <div style="box-sizing:border-box;border:0;float:left;width:40px;height:40px;border:2px solid #555;border-radius:100px;overflow:hidden;">
                                                            <img style="box-sizing:border-box;display:block;width:40px;height:40px;" src="" alt="foto_jugador_tabla">
                                                        </div>
                                                        <div id="nombre_jugador_tabla" style="box-sizing:border-box;border:0;float:left;height:40px;line-height:40px;margin-left:10px;">nombre jugador</div>
                                                    
                                                    </th>
                                                    <th style="border:0;height:50px;line-height:50px;/*border-right:1px solid #111;*/text-align: center;max-width: 10px;font-weight: normal;" >seg</th>
                                                    <th style="border:0;height:50px;line-height:50px;/*border-right:1px solid #111;*/text-align: center;max-width: 10px;font-weight: normal;" >-</th>
                                                    <th style="border:0;height:50px;line-height:50px;/*border-right:1px solid #111;*/max-width: 10px;    text-align: left;font-weight: normal;" >POSICIÓN</th>
                                                </tr> -->
                                            
                                            </tbody>

                                        </table>
                                    </div>
                                    


                                <hr>

                                    <div style="box-sizing: border-box;border:0;width:100%;height:400px;">

                                        <div style="box-sizing: border-box;border:0;width:100%;height:200px;float:left;">
                                    
                                            <figure class="highcharts-figure">
                                                <div id="container"></div>
                                            </figure>
                                    
                                    
                                    
                                        </div>
                                
                                
                                    </div>

                                </div>
                               
                        </div>


                        <!-- <button class="boton_volver" onclick="botonVolverAInicio(this);" style="margin-left:10px"><i class="icon-arrow-left"></i> volver</button> -->
                        <div style="box-sizing: border-box;border:0;width:45%;height:100px;margin-left:auto;margin-right:auto;margin-bottom:15px;">
                            <img style="box-sizing: border-box;border:0;float:left;width:20%;height:100px;" src="../config/logo_equipo.png" alt="logo equipo"/>
                            <div style="box-sizing: border-box;border:0;float:left;width:80%;height:100px;padding-top:15px;color:#404040;text-align:center;" >
                                <h4 >EVALUACIONES NEUROCIENCIAS</h4>
                                <div style="font-weight: 800;">Primer Equipo</div>
                            </div>
                        </div>
                        <div style="box-sizing: border-box;border:0;width:90%;height:15px;margin-left:auto;margin-right:auto;background-color:#0b3b99 ;margin-bottom:60px;"></div>
                        <!-- <h1>VITSA OCULAR</h1> -->
                        <div style="box-sizing:border-box;border:0;width:109px;margin-left:auto;margin-right:25px;margin-bottom:15px;">
                            <button data-boton-abrir-formulario-test="ocular" class="boton-abrir-formulario" onClick="abrirFormularioTest()"><b style="font-size:10px;"><i class="icon-plus"></i> Agregar informe</b></button>
                        </div>

                        

                        <div style="box-sizing: border-box;border:0;margin-right:auto;margin-left:auto;width:40%;height: 30px;margin-bottom:15px;">
                            <div style="margin-right:10%;width:45%;height: 30px;display:flex;float:left;">
                                <a class="btn btn-md btn-primary green-a" style="width: 36%;height: 20px;background:#0b3b99">
                                    <div>
                                        <p class="ellipsis-text" style="font-weight: normal;">Año</p>
                                    </div>
                                </a>
                                <select style="width:60%; height: 30px;background:#fff;border:2px solid #0b3b99" id="filtro_ano_test" name="filtro_ano_test" onchange="filtrarTest()">
                                    
                                </select>
                            </div>

                            <div style="width:45%;height: 30px;display:flex;float:left;">
                                <a class="btn btn-md btn-primary green-a" style="width: 36%;height: 20px;background:#0b3b99">
                                    <div>
                                        <p class="ellipsis-text" style="font-weight: normal;">Mes</p>
                                    </div>
                                </a>
                                <select style="width:60%; height: 30px;background:#fff;border:2px solid #0b3b99" id="filtro_mes_test" name="filtro_mes_test" onchange="filtrarTest()">
                                    <option value="01">Enero</option>
                                    <option value="02">Febrero</option>
                                    <option value="03">Marzo</option>
                                    <option value="04">Abril</option>
                                    <option value="05">Mayo</option>
                                    <option value="06">Junio</option>
                                    <option value="07">Julio</option>
                                    <option value="08">Agosto</option>
                                    <option value="09">Septiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                        </div>

                            <div id="tabla_html_inicio_test_ocular" style="box-sizing:border-box;border:0;width:95%;margin-left:auto;margin-right:auto;margin-bottom:50px;">
                                <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;border-top-left-radius: 5px;border-top-right-radius: 5px;">
                                    <div style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;padding-left:5px;text-align:center">#</div>
                                    <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;padding-left:5px;">Fecha Evaluación</div>
                                    <div style="box-sizing:border-box;border:0;width:6%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;padding-left:5px;">Año</div>
                                    <div style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;padding-left:5px;">N° informe</div>
                                    <div style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;text-align:center">Evaluados</div>
                                    <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/text-align:center;line-height: 30px;font-size: 12px;padding-left:5px;">MEDIA 1</div>
                                    <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/text-align:center;line-height: 30px;font-size: 12px;padding-left:5px;">MEDIA 2</div>
                                    <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/text-align:center;line-height: 30px;font-size: 12px;padding-left:5px;">MEDIA 3</div>
                                    <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/text-align:center;line-height: 30px;font-size: 12px;padding-left:5px;">MEDIA 4</div>
                                    <div style="box-sizing:border-box;border:0;width:4%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height:30px;"></div>
                                    <div style="box-sizing:border-box;border:0;width:4%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height:30px;"></div>
                                    <div style="box-sizing:border-box;border:0;width:4%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height:30px;"></div>
                                    
                                </div>
                                <div id="contenedor_fila_tabla_inicio_test" style="box-sizing:border-box;border:0;width:100%;color:#555;">

                                </div>
                                <div style="box-sizing:border-box;border:0;width:100%;height:10px;background-color:#555;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;"></div>
                            </div>
                    </div>
                    
                    <div id="vista_test_formulario" style="display:none;">
                        <button data-boton-cerrar-formulario-test="ocular" class="boton_volver" onclick="volverInicioModuloTest(this);" style="margin-left:10px"><i class="icon-arrow-left"></i> volver</button>
                        
                        <!--    MODAL FORMULARIO TEST OCULAR INICIO  modalFormularioTestOcular -->
                        <div id="modalFormularioTestOcular" class="modal hide" style="border-radius:10px;">
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
                                    
                                    <center>
                                        <div id="contendor_botones_modal">
                                            <button type="button" class="btn btn-default boton_modal" onClick="cerrarModalAtencionDiariaNuevo()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>
                                            <button type="button" id="guardar" class="btn btn-default boton_modal " onClick="agregarNuevoTratamiento()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button>
                                        </div>
                                    </center>
                                    
                                </div>
                        </div>
                        <!--    MODAL FORMULARIO TEST OCULAR FIN     -->
                         <!--    MODAL AGREGAR JUGADOR TEST OCULAR INICIO  modalFormularioTestOcular -->
                         <div id="modalAgregarJugadorTest" class="modal hide" style="border-radius:10px;">
                                <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
                                </div>
                                <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
                                <center>
                                        <br>
                                        <div id="mensaje_agregar_DescargarBoletaAgregarJugador">
                                            <div style="display: flex;margin-left:auto;margin-right:auto;width:50%;margin-bottom:15px;">
                                                <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#001b73">
                                                    <div>
                                                        <p class="ellipsis-text" style="font-weight: normal;">Serie Jugador</p>
                                                    </div>
                                                </a>
                                                <select style="width:50%; height: 30px;background:#fff;border:2px solid #001b73" class="" id="serie_test" name="serie_test" onchange="consultarJugadoresSerieAgregarTest(this.value)">
                                                    <option value="null">Seleccione</option>
                                                    <option value="99_1">Primer equipo masculino</option>
                                                    <option value="20_1">Sub 20</option>
                                                    <option value="17_1">Sub 17</option>
                                                    <option value="16_1">Sub 16</option>
                                                    <option value="15_1">Sub 15</option>
                                                    <option value="14_1">Sub 14</option>
                                                    <option value="13_1">Sub 13</option>
                                                    <option value="12_1">Sub 12</option>
                                                    <option value="11_1">Sub 11</option>
                                                    <option value="10_1">Sub 10</option>
                                                    <option value="9_1">Sub 9</option>
                                                    <option value="8_1">Sub 8</option>
                                                    <option value="99_2">Primer equipo femenino</option>
                                                    <option value="17_2">Sub 17</option>
                                                    <option value="15_2">Sub 15</option>
                                                </select>
                                                <!-- <input type="text" readonly  style="width:50%; height: 18px;background:#fff;" class="grey-input date_fechaNacimiento fecha_inicio" id="fecha_atencion" name="fecha_atencion" onchange="" />                    -->
                                            </div>
                                            <div id="contendor_jugadores_test" style="display: none;margin-left:auto;margin-right:auto;width:50%;">
                                                <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#001b73">
                                                    <div>
                                                        <p class="ellipsis-text" style="font-weight: normal;">Jugador</p>
                                                    </div>
                                                </a>
                                                <select style="width:50%; height: 30px;background:#fff;border:2px solid #001b73" class="" id="jugador_test" name="jugador_test" onchange="">
                                                </select>
                                                <!-- <input type="text" readonly  style="width:50%; height: 18px;background:#fff;" class="grey-input date_fechaNacimiento fecha_inicio" id="fecha_atencion" name="fecha_atencion" onchange="" />                    -->
                                            </div>
                                        </div>
                                        <br>
                                </center>
                                </div>
                                <div class="modal-footer" style="background-color: <?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
                                    
                                    <center>
                                        <div id="contendor_botones_modal_AgregarJugador">
                                            <button type="button" class="btn btn-default boton_modal" onClick="cerrarModalAgregarJugadorTest()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>
                                            <button type="button" id="guardar" class="btn btn-default boton_modal " onClick="agregarJugadorTest()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button>
                                        </div>
                                    </center>
                                    
                                </div>
                        </div>
                        <!--    MODAL AGREGAR JUGADOR TEST OCULAR FIN     -->

                        <form id="formulario-ocular" style="box-sizing: border-box;border:0;padding-top:15px;">
                            <div style="box-sizing: border-box;border:0;width:100%;box-sizing: border-box;border:0;width:100%;height:200px;margin-left:auto;margin-right:auto;margin-bottom:15px;/*background-color:lime;*/padding-left:15px;padding-right:15px;">
                                <img src="../config/logo_equipo.png" alt="logo equipo" style="box-sizing: border-box;border:0;width:20%;height:200px;float:left;"/>
                                <div style="box-sizing: border-box;border:0;width:80%;height:200px;float:left;" >
                                    <div style="box-sizing: border-box;border:0;color:#404040;font-size:13px;font-weight: 800;padding-left:27%;margin-bottom:15px;">TEST TOMA DE DECISIONES</div>
                                    
                                    <div style="margin-left:25%;width:26%;height: 30px;display:flex;margin-bottom:30px;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 40%;height: 20px;background:#001b73">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Fecha evaluación</p>
                                            </div>
                                        </a>
                                        <input type="text" readonly style="width:60%; height: 18px;background:#fff;" class="grey-input" id="fecha_evaluacion_test" name="fecha_evaluacion_test" />                   
                                    </div>

                                    <div style="box-sizing: border-box;border:0;width: 100%;height: 104px;" >
                                        <div style="box-sizing: border-box;border:0;width: 100%;height: 20px;font-size:12px;font-weight: 800;">Observaciones</div>
                                        <textarea name="observacion_test" id="observacion_test"  style="box-sizing: border-box;border:0;width: 100%;height: 84px;resize: none;display:block;border-radius:5px;border:1px solid #acacac;" ></textarea>
                                
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div style="box-sizing:border-box;border:0;color:#555;width:50%;font-size: 12px;margin-left:auto;margin-right:auto;text-align:center;font-weight: 800;">JUGADORES ACTIVOS</div>
                            
                            <div style="box-sizing:border-box;border:0;width:109px;margin-left:auto;margin-right:25px;margin-bottom:5px;">
                                <button data-boton-abrir-formulario-test="ocular" class="boton-abrir-formulario" onClick="abrirModalAgregarJugadorTest()"><b style="font-size:10px;"><i class="icon-plus"></i> Agregar jugador</b></button>
                            </div>

                            <div id="tabla_html_formulario_test" style="box-sizing:border-box;border:0;width:95%;margin-left:auto;margin-right:auto;margin-bottom:15px;">
                                <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;border-top-left-radius: 5px;border-top-right-radius: 5px;">
                                    <div style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;text-align:center">#</div>
                                    <div style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">POSICION</div>

                                    <div style="box-sizing:border-box;border:0;width:16%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">NOMBRE</div>
                                    <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;text-align:center;">Toma de decisiones</div>
                                    <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;text-align:center;">Precision</div>
                                    <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;text-align:center;">Manejo de la presion</div>
                                    <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;text-align:center;">Reaccion</div>
                                    <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;text-align:center;">Adaptabilidad</div>
                                    <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/"></div>
                                </div>
                                <div id="contenedor_fila_tabla_formulario_test" style="box-sizing:border-box;border:0;width:100%;color:#555;">

                                </div>
                                <div style="box-sizing:border-box;border:0;width:100%;height:10px;background-color:#555;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;"></div>
                            </div>
                            <div style="box-sizing:border-box;border:0;width:490px;height:30px;margin-left:auto;margin-right:auto;margin-bottom:15px;">
                                <span style="box-sizing:border-box;float:left;width:85px;height:30px;font-size:12px;color:#111;font-weight: 800;margin-right:15px;line-height:30px;">PROMEDIO</span>
                                <div id="promedio_toma_decision" style="box-sizing:border-box;float:left;width:70px;height:30px;background-color:#555;border:2px solid #acacac;text-align:right;font-size:12px;font-weight: 800;color:#fff;line-height:30px;padding-right:5px;border-radius:5px;">xxx</div>
                                <div id="promedio_presicion" style="box-sizing:border-box;float:left;width:70px;height:30px;background-color:#555;border:2px solid #acacac;text-align:right;font-size:12px;font-weight: 800;color:#fff;line-height:30px;padding-right:5px;border-radius:5px;margin-left: 10px;">xxx</div>
                                <div id="promedio_menejo_presion" style="box-sizing:border-box;float:left;width:70px;height:30px;background-color:#555;border:2px solid #acacac;text-align:right;font-size:12px;font-weight: 800;color:#fff;line-height:30px;padding-right:5px;border-radius:5px;margin-left: 10px;">xxx</div>
                                <div id="promedio_reaccion" style="box-sizing:border-box;float:left;width:70px;height:30px;background-color:#555;border:2px solid #acacac;text-align:right;font-size:12px;font-weight: 800;color:#fff;line-height:30px;padding-right:5px;border-radius:5px;margin-left: 10px;">xxx</div>
                                <div id="promedio_adaptacion" style="box-sizing:border-box;float:left;width:70px;height:30px;background-color:#555;border:2px solid #acacac;text-align:right;font-size:12px;font-weight: 800;color:#fff;line-height:30px;padding-right:5px;border-radius:5px;margin-left: 10px;">xxx</div>
                            </div>

                            <div style="box-sizing:border-box;border:0;width: 140px;margin-left: auto;margin-right:auto;">
                                    <button type="button" ng-disabled="" class="boton_guardar_informe" onClick="mostrarModalEnviarDatosTest();" id="boton_guardar_test_ocular"><i class="icon-save"></i> GUARDAR CAMBIOS</button>
                            </div>
                            
                    
                            <button data-boton-cerrar-formulario-test="ocular" class="boton_volver" onclick="volverInicioModuloTest(this);" style="margin-left:10px"><i class="icon-arrow-left"></i> volver</button>
                    






                    
                    
                        </form>







                    </div>
                    
                    
                    
                    

                    

            </div>
                    
                <?php } ?>
            </div>
        </div>
    </body>
</html>
<script>
// variables globales
var nombre_usuario_software='<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>';

var tipo_test=null;

var tipo_formulario=null;

var datos_test={
    ocular:{
        tipo_fomrulario:false,
        lista_inicio_test:[],
        jugadores_test:[]
    },
    reaccion:{
        tipo_fomrulario:false,
        lista_inicio_test:[],
        jugadores_test:[]
    },
    cerebral:{
        tipo_fomrulario:false,
        lista_inicio_test:[],
        jugadores_test:[]
    },
    decisiones:{
        tipo_fomrulario:false,
        lista_inicio_test:[],
        jugadores_test:[]
    }
    
}

var ranking_test_cerabral=[];

var ranking_test_decision=[];
/*
id
rank
velocidad
comentario
*/

var ano_actual_servidor=null;

var lista_posiciones=[
    "Arquero",
    "Defensor Central",
    "Lateral Izquierdo",
    "Lateral Derecho",
    "Volante Defensivo",
    "Volante Izquierdo",
    "Volante Derecho",
    "Volante Mixto",
    "Volante Ofensivo",
    "Extremo Izquierdo",
    "Extremo Derecho",
    "Centro Delantero"
];

var listaJugadores=[];

var idtest_decision=null;


</script>
<script>

async function cargarVentanaInicioTest(){
    await consultarAnoActual();
    let mesNumero=obtenerMesNumero();
    window.tipo_test="decisiones";
    insertarOptionSelectFiltroTest();
    $("#filtro_mes_test").val(mesNumero);
    await consultarTests($("#filtro_ano_test").val(),$("#filtro_mes_test").val());
}

async function consultarAnoActual(){
    await $.ajax({
        url: 'post/test_año_actual_test_decision.php',
        type: "post",
        data:[],
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            window.ano_actual_servidor=parseInt(json.ano_actual);
            
        },error: function(){// will fire when timeout is reached
        }, timeout: 10000 // sets timeout to 3 seconds
    });
}

function insertarOptionSelectFiltroTest(){
    let list_option=[];
    for(let contador=window.ano_actual;contador>=window.ano_actual-5;contador--){
        let option_str="<option value='"+contador+"'>"+contador+"</option>";
        list_option.push(option_str);
    }
    let str_list_option=list_option.join("");
    document.getElementById("filtro_ano_test").innerHTML=str_list_option;
}

async function filtrarTest (){
    await consultarTests($("#filtro_ano_test").val(),$("#filtro_mes_test").val());
}


async function consultarTests(ano="2020",mes="01"){
    $("#contenedor_fila_tabla_inicio_test").empty();
    window.datos_test[window.tipo_test].lista_inicio_test=[];
    await $.ajax({
        url: 'post/test_consultar_test_decision_año_mes.php',
        type: "post",
        data:[
            {name:"ano_test_oculares",value:ano},
            {name:"mes_test_oculares",value:mes},
        ],
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            window.datos_test[window.tipo_test].lista_inicio_test=json.datos;
            console.log("listando test ->>>",window.datos_test[window.tipo_test].lista_inicio_test);
            // insertarFilaInicioTestOculares(window.datos_test[window.tipo_test].lista_inicio_test);
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
        }, timeout: 10000 // sets timeout to 3 seconds
    });
}

function eliminarTest(id){
    // alert(id);
    $.ajax({
        url: "post/test_eliminar_test_reaccion.php",
        type: "post",
        data:[{name:"id",value:id}],
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            // console.log(json)
            cerrarModalEliminarTest();
            consultarTests($("#filtro_ano_test").val(),$("#filtro_mes_test").val());
            
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
            // $('#error_conexion').show();
        }, timeout: 10000 // sets timeout to 3 seconds
    });

}

function abrirFormularioTest(){
    $("#vista_test").hide(500);
    $("#vista_test_formulario").show(500);
    formularioTest();
}

function abrirFormularioTestEditar(indice){
    $("#vista_test").hide(500);
    $("#vista_test_formulario").show(500);
    formularioTest(true,indice);
}

function formularioTest(tipo=false,index=null){
    if(!tipo){
        formularioTestCrear();
        consultarJugadoresSerie("99_1");
    }
    else{
        formularioTestEditar(index);
    }
}

function formularioTestCrear(){
    console.log(window.datos_test[window.tipo_test])
    window.idtest_decision=null;
    window.datos_test[window.tipo_test].tipo_fomrulario=false;
    window.ranking_test_decision=[];
    window.datos_test[window.tipo_test].jugadores_test=[];
    fechaTestEvaluacion();
    $("#observacion_test").val("");
    document.getElementById("promedio_toma_decision").textContent="0.00";
    document.getElementById("promedio_presicion").textContent="0.00";
    document.getElementById("promedio_menejo_presion").textContent="0.00";
    document.getElementById("promedio_reaccion").textContent="0.00";
    document.getElementById("promedio_adaptacion").textContent="0.00";
}

// function formularioTestEditar(indice){
//     let test=window.datos_test[window.tipo_test].lista_inicio_test[indice];
//     window.idtest_decision=test.idtest_decision;
//     window.ranking_test_decision=[];
//     // console.log(test);
//     window.datos_test[window.tipo_test].tipo_fomrulario=true;
//     fechaTestEvaluacion();
//     $("#fecha_evaluacion_test").val(test.fecha_evaluacion_test);
//     $("#observacion_test").val(test.observacion_test);
//     insertarFilaJugadoresTestEditar(test.detalle_test);

// }

function fechaTestEvaluacion(){
    $('#fecha_evaluacion_test').datetimepicker({
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
    $('#fecha_evaluacion_test').datetimepicker('setDate', new Date() );
}

function obtenerMesNumero(){
    let lista_meses=[
            "01",
            "02",
            "03",
            "04",
            "05",
            "06",
            "07",
            "08",
            "09",
            "10",
            "11",
            "12"
        ] ; 
        let fechaDate=new Date() ; 
        return lista_meses[fechaDate.getMonth()];
}

async function volverInicioModuloTest($botonCerrarFormularioTest){
    $("#vista_test_formulario").hide(500);
    $("#vista_test").show(500);
    insertarOptionSelectFiltroTest();
    $("#filtro_mes_test").val("01");
    await consultarTests($("#filtro_ano_test").val(),$("#filtro_mes_test").val());
}


async function consultarJugadoresSerie(valor){
    // consultar jugadores por la serie en base al tipo de test del formulario
    let serie=valor.split("_")[0],
    sexo=valor.split("_")[1];
    window.datos_test[window.tipo_test].jugadores_test=[];
    await $.ajax({
        url: 'post/test_consultar_Jugadores_decision.php',
        type: "post",
        data:[
            {name:"serie",value:serie},
            {name:"sexo",value:sexo}
        ],
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            window.datos_test[window.tipo_test].jugadores_test=json.datos;
            // console.log("->>",window.datos_test[window.tipo_test].jugadores_test);
            if(json.respuesta){
                insertarFilaJugadoresTest(window.datos_test[window.tipo_test].jugadores_test);
                // validarCampoFormulario();
            }
            else{
                let plantilla='<div class="panel_buscar" style="box-sizing:border-box;border:0;width:100%;height:34px;padding-top:2px;padding-bottom:2px;text-align:center;font-weight: 800;font-size:12px;line-height:30px;">Sin Jugadores</div>';
                $("#contenedor_fila_tabla_formulario_test").append(plantilla);
            }
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
        }, timeout: 10000 // sets timeout to 3 seconds
    });
}

function insertarFilaJugadoresTest(jugadores=[]){
    let lista_str_filas_jugadores=[]
    $("#contenedor_fila_tabla_formulario_test").empty();
    if(jugadores.length>0){
        let contador=0;
        for(let jugador of jugadores){
            let plantilla='\
                <div id="fila_formulario_test_'+jugador.idfichaJugador+'" class="panel_buscar" style="box-sizing:border-box;border:0;width:100%;height:34px;padding-top:2px;padding-bottom:2px;">\
                    <div class="index_formulario_test" style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-align:center;">'+(contador+1)+'</div>\
                    <div style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-transform: Capitalize" class="ellipsis-text">\
                        <img src="flags/blank.gif" class="flag flag-'+jugador.nacionalidad1.toLowerCase()+'"/> '+obtenerInicialDelPosicion(lista_posiciones[parseInt(jugador.posicion)-1])+'\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:16%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;" >\
                        <div style="box-sizing:border-box;border:0;float:left;width:20%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;" >\
                            <img style="width:100%;height:32px" src="./foto_jugadores/'+jugador.idfichaJugador+'.png"/>\
                        </div>\
                        <div style="box-sizing:border-box;border:0;float:left;width:80%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;text-transform: Capitalize" class="ellipsis-text">'+jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2+'</div>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                        <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]"  class="campo_velocidad" id="toma_decision_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)"/>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                        <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]"  class="campo_velocidad" id="presicion_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)"/>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                        <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]"  class="campo_velocidad" id="manejo_presion_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)"/>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                        <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]"  class="campo_velocidad" id="reaccion_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)"/>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                        <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]"  class="campo_velocidad" id="adaptacion_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)"/>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;">\
                        <center>\
                            <a class="boton_eliminar" id="'+jugador.idfichaJugador+'" onClick="eliminarFilaJugadorTest(this)">\
                                <i class="icon-remove"></i>\
                            </a>\
                        </center>\
                    </div>\
                </div>';
                contador++;
                lista_str_filas_jugadores.push(plantilla);
        }
        // contenedor_fila_tabla_formulario_test
        if(lista_str_filas_jugadores.length!==0){
            let filas_join=lista_str_filas_jugadores.join("");
            $("#contenedor_fila_tabla_formulario_test").append(filas_join);
        }
    }
}

function obtenerInicialDelPosicion(posicion){
    // volante mixto -> V. Mixto
    let exprecion=/\s/;
    if(exprecion.test(posicion)){
        let inicial=posicion[0];
        let InicialMasPosicion=inicial+". "+posicion.split(" ")[1];
        return InicialMasPosicion;
    }
    else{
        return posicion;
    }

}

function sumarAlRankingTestOcular($inputVelocidad){
    let id=$inputVelocidad.getAttribute("data-id-jugador");
    if(window.ranking_test_decision.length===0){
            window.ranking_test_decision.push({
                id:$inputVelocidad.getAttribute("data-id-jugador"),
                
                rank:0,
                // velocidad:(parseFloat($inputVelocidad.value)!=="")?parseFloat($inputVelocidad.value):"",
                toma_decision:(document.getElementById("toma_decision_"+id).value!=="")?parseFloat(document.getElementById("toma_decision_"+id).value):0,
                presicion:(document.getElementById("presicion_"+id).value!=="")?parseFloat(document.getElementById("presicion_"+id).value):0,
                manejo_presion:(document.getElementById("manejo_presion_"+id).value!=="")?parseFloat(document.getElementById("manejo_presion_"+id).value):0,
                reaccion:(document.getElementById("reaccion_"+id).value!=="")?parseFloat(document.getElementById("reaccion_"+id).value):0,
                adaptacion:(document.getElementById("adaptacion_"+id).value!=="")?parseFloat(document.getElementById("adaptacion_"+id).value):0

            });
        }
        else{
            let posicion=0;
            let econtrado=false;
            for(let jugador of window.ranking_test_decision){
                if(jugador.id===$inputVelocidad.getAttribute("data-id-jugador")){
                        window.ranking_test_decision[posicion]={
                        id:$inputVelocidad.getAttribute("data-id-jugador"),
                        rank:0,
                        // velocidad:(parseFloat($inputVelocidad.value)!=="")?parseFloat($inputVelocidad.value):"",
                        toma_decision:(document.getElementById("toma_decision_"+id).value!=="")?parseFloat(document.getElementById("toma_decision_"+id).value):0,
                        presicion:(document.getElementById("presicion_"+id).value!=="")?parseFloat(document.getElementById("presicion_"+id).value):0,
                        manejo_presion:(document.getElementById("manejo_presion_"+id).value!=="")?parseFloat(document.getElementById("manejo_presion_"+id).value):0,
                        reaccion:(document.getElementById("reaccion_"+id).value!=="")?parseFloat(document.getElementById("reaccion_"+id).value):0,
                        adaptacion:(document.getElementById("adaptacion_"+id).value!=="")?parseFloat(document.getElementById("adaptacion_"+id).value):0
                    }
                    econtrado=true;
                }
                posicion++;
            }
            if(!econtrado){
                window.ranking_test_decision.push({
                    id:$inputVelocidad.getAttribute("data-id-jugador"),
                    rank:0,
                    // velocidad:(parseFloat($inputVelocidad.value)!=="")?parseFloat($inputVelocidad.value):"",
                    toma_decision:(document.getElementById("toma_decision_"+id).value!=="")?parseFloat(document.getElementById("toma_decision_"+id).value):0,
                    presicion:(document.getElementById("presicion_"+id).value!=="")?parseFloat(document.getElementById("presicion_"+id).value):0,
                    manejo_presion:(document.getElementById("manejo_presion_"+id).value!=="")?parseFloat(document.getElementById("manejo_presion_"+id).value):0,
                    reaccion:(document.getElementById("reaccion_"+id).value!=="")?parseFloat(document.getElementById("reaccion_"+id).value):0,
                    adaptacion:(document.getElementById("adaptacion_"+id).value!=="")?parseFloat(document.getElementById("adaptacion_"+id).value):0
                });
            }
        }
        // console.log(window.ranking_test_decision);
        for(let jugador of rankingOrdenTest()){
            
            console.log("ranking ->>>",jugador)
            // document.getElementById("ranking_test_formulario_"+jugador.id).textContent=jugador.rank.toString();
        }
        let promedios=promedioTestFormulario();
        document.getElementById("promedio_toma_decision").textContent=(promedios.toma_decision.toFixed(2).toString()==="Infinity")?"0.00":promedios.toma_decision.toFixed(2).toString();
        document.getElementById("promedio_presicion").textContent=(promedios.presicion.toFixed(2).toString()==="Infinity")?"0.00":promedios.presicion.toFixed(2).toString();
        document.getElementById("promedio_menejo_presion").textContent=(promedios.manejo_presion.toFixed(2).toString()==="Infinity")?"0.00":promedios.manejo_presion.toFixed(2).toString();
        document.getElementById("promedio_reaccion").textContent=(promedios.reaccion.toFixed(2).toString()==="Infinity")?"0.00":promedios.reaccion.toFixed(2).toString();
        document.getElementById("promedio_adaptacion").textContent=(promedios.adaptacion.toFixed(2).toString()==="Infinity")?"0.00":promedios.adaptacion.toFixed(2).toString();
    
    // validarCampoFormulario();
}

function rankingOrdenTest(){
    // ordenar ranking de menor a mayor
    let numero_ranking=1;
    let total_jugadores=window.datos_test[window.tipo_test].jugadores_test.length;
    let lista_jugadores =window.ranking_test_decision.slice();
    let lista_ranking=[];
    for(let contador=0;contador<window.datos_test[window.tipo_test].jugadores_test.length;contador++){
        if(lista_jugadores.length===0){
            break;
        }
        else{
            let tmp={
                id:0,
                rank:0,
                toma_decision:999999,
                presicion:999999,
                manejo_presion:999999,
                reaccion:999999,
                adaptacion:999999,
            }
            let posicion=0;
            let posicion_eliminar=0;
            for(let jugador of lista_jugadores){
                let total_jugador=jugador.toma_decision+jugador.presicion+jugador.manejo_presion+jugador.reaccion+jugador.adaptacion;
                let total_tmp=tmp.toma_decision+tmp.presicion+tmp.manejo_presion+tmp.reaccion+tmp.adaptacion;
                if(total_jugador<=total_tmp){
                    tmp=JSON.parse(JSON.stringify(jugador));
                    posicion_eliminar=posicion;
                }
                posicion++;
            }
            tmp.rank=numero_ranking;
            numero_ranking++;
            lista_jugadores.splice(posicion_eliminar,1);
            lista_ranking.push(tmp);
        }
    }
    console.log("-->>>",lista_ranking);
    return lista_ranking;
}


function promedioTestFormulario(){
    let numeroDeJugadores=window.ranking_test_decision.length;
    let toma_decision_total=0;
    let presicion_total=0;
    let manejo_presion_total=0;
    let reaccion_total=0;
    let adaptacion_total=0;
    for(let jugador of window.ranking_test_decision){
        toma_decision_total=toma_decision_total+jugador.toma_decision;
        presicion_total=presicion_total+jugador.presicion;
        manejo_presion_total=manejo_presion_total+jugador.manejo_presion;
        reaccion_total=reaccion_total+jugador.reaccion;
        adaptacion_total=adaptacion_total+jugador.adaptacion;
    }
    return {
        toma_decision:toma_decision_total/numeroDeJugadores,
        presicion:presicion_total/numeroDeJugadores,
        manejo_presion:manejo_presion_total/numeroDeJugadores,
        reaccion:reaccion_total/numeroDeJugadores,
        adaptacion:adaptacion_total/numeroDeJugadores
    };

}

function abrirModalAgregarJugadorTest(){
    $("#modalAgregarJugadorTest").modal("show");
}

function cerrarModalAgregarJugadorTest(){
    $("#modalAgregarJugadorTest").modal("hide");
    $("#jugador_test").empty();
    $("#contendor_jugadores_test").css("display","none");
    $("#serie_test").val("null");
}

async function consultarJugadoresSerieAgregarTest(valor){
    // consultar jugadores por la serie en base al tipo de test del formulario
    if(valor!=="null"){
        let serie=valor.split("_")[0],
        sexo=valor.split("_")[1];
        await $.ajax({
            url: 'post/test_consultar_Jugadores_reaccion.php',
            type: "post",
            data:[
                {name:"serie",value:serie},
                {name:"sexo",value:sexo}
            ],
            success: function(respuesta) {
                let json=JSON.parse(respuesta);
                window.listaJugadores=JSON.parse(JSON.stringify(json.datos));
                insertarJugadoresSelect(window.listaJugadores);
                
            },error: function(){// will fire when timeout is reached
                // alert("errorXXXXX");
            }, timeout: 10000 // sets timeout to 3 seconds
        });
    }
    else{
        $("#jugador_test").empty();
        $("#contendor_jugadores_test").css("display","none");
    }
}

function insertarJugadoresSelect(jugadores=[]){
    $("#jugador_test").empty();
    let listaJugadores=[{id:null,nombre:"Seleccione jugador"}];
    if(jugadores.length>0){
        for(let jugador of jugadores){
            let nombre_jugador=jugador.nombre+" "+jugador.apellido1+" "+jugador.apellido2
            listaJugadores.push({id:jugador.idfichaJugador,nombre:nombre_jugador});
        }
    }else{
        listaJugadores[0].nombre="Sin Jugadores";
    }
    $("#contendor_jugadores_test").css("display","flex");
    for(let optionJugador of listaJugadores){
        $("#jugador_test").append("<option value='"+optionJugador.id+"'>"+optionJugador.nombre+"</option>");
    }
}

function agregarJugadorTest(){
    let jugadorSeleccionado=window.listaJugadores.filter(jugador => jugador.idfichaJugador===$("#jugador_test").val())[0];
    agregarJugadorNuevoAlTest(jugadorSeleccionado);
}

function agregarJugadorNuevoAlTest(jugador){
    let $indeces=document.querySelectorAll(".index_formulario_test");
    let numero_fila=parseInt($indeces[$indeces.length-1].textContent)+1;
    let plantilla='\
        <div id="fila_formulario_test_'+jugador.idfichaJugador+'" class="panel_buscar" style="box-sizing:border-box;border:0;width:100%;height:34px;padding-top:2px;padding-bottom:2px;">\
            <div class="index_formulario_test" style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-align:center;">'+(numero_fila)+'</div>\
            <div style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-transform: Capitalize" class="ellipsis-text">\
                <img src="flags/blank.gif" class="flag flag-'+jugador.nacionalidad1.toLowerCase()+'"/> '+obtenerInicialDelPosicion(window.lista_posiciones[parseInt(jugador.posicion)-1])+'\
            </div>\
            <div style="box-sizing:border-box;border:0;width:16%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;" >\
                <div style="box-sizing:border-box;border:0;float:left;width:20%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;" >\
                    <img style="width:100%;height:32px" src="./foto_jugadores/'+jugador.idfichaJugador+'.png"/>\
                </div>\
                <div style="box-sizing:border-box;border:0;float:left;width:80%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;text-transform: Capitalize" class="ellipsis-text">'+jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2+'</div>\
            </div>\
            <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                        <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]"  class="campo_velocidad" id="toma_decision_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)"/>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                        <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]"  class="campo_velocidad" id="presicion_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)"/>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                        <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]"  class="campo_velocidad" id="manejo_presion_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)"/>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                        <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]"  class="campo_velocidad" id="reaccion_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)"/>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:13.6%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                        <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]"  class="campo_velocidad" id="adaptacion_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)"/>\
                    </div>\
            <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;">\
                <center>\
                    <a class="boton_eliminar" id="'+jugador.idfichaJugador+'" onClick="eliminarFilaJugadorTest(this)">\
                        <i class="icon-remove"></i>\
                    </a>\
                </center>\
            </div>\
        </div>';
        $("#contenedor_fila_tabla_formulario_test").append(plantilla);
        cerrarModalAgregarJugadorTest();
}

function eliminarFilaJugadorTest($boton){
    // este codigo se encarga de eliminar los jugadores del test en el te encuentras
    // actualiza el ranking
    let id=$boton.id;
    let $fila=document.getElementById("fila_formulario_test_"+id);
    let $contenedorFilasTablaTest=document.getElementById("contenedor_fila_tabla_formulario_test");
    let $contenedorIndex=$fila.children[0];
    let numero_fila_removida=parseInt($contenedorIndex.textContent)

    $contenedorFilasTablaTest.removeChild($fila);
    let contador=0;
    for(let jugador of window.datos_test[window.tipo_test].jugadores_test){
        if(jugador.idfichaJugador===id){
            window.datos_test[window.tipo_test].jugadores_test.splice(contador,1);
        }
        contador++;
    }
    let lista=window.ranking_test_decision;
    let contador2=0;
    for(let jugador of lista){
        if(jugador.id===id){
            lista.splice(contador2,1);
        }
        contador2++;
    }
    console.log("eliminando ->>>",lista);
    let promedios=promedioTestFormulario();
    document.getElementById("promedio_toma_decision").textContent=(promedios.toma_decision.toFixed(2).toString()==="Infinity")?"0.00":promedios.toma_decision.toFixed(2).toString();
    document.getElementById("promedio_presicion").textContent=(promedios.presicion.toFixed(2).toString()==="Infinity")?"0.00":promedios.presicion.toFixed(2).toString();
    document.getElementById("promedio_menejo_presion").textContent=(promedios.manejo_presion.toFixed(2).toString()==="Infinity")?"0.00":promedios.manejo_presion.toFixed(2).toString();
    document.getElementById("promedio_reaccion").textContent=(promedios.reaccion.toFixed(2).toString()==="Infinity")?"0.00":promedios.reaccion.toFixed(2).toString();
    document.getElementById("promedio_adaptacion").textContent=(promedios.adaptacion.toFixed(2).toString()==="Infinity")?"0.00":promedios.adaptacion.toFixed(2).toString();
    reordenarListaFormularioTestOcular(numero_fila_removida);
    // se encarga de actuaizar el ranking despues de eliminar a un jugador
    // for(let jugador of rankingOrdenTest()){
    //         // console.log("->>",jugador)
    //         document.getElementById("ranking_test_formulario_"+jugador.id).textContent=jugador.rank.toString();
    //     }
    // validarCampoFormulario();
}

function reordenarListaFormularioTestOcular(numero){
    $indicesTestOcularFormulario=document.querySelectorAll(".index_formulario_test");
    for(let indice of $indicesTestOcularFormulario){
        if(numero<parseInt(indice.textContent)){
            indice.textContent=(parseInt(indice.textContent)-1).toString();
        }
    }
}


function mostrarModalEnviarDatosTest(){
    if(!window.datos_test[window.tipo_test].tipo_fomrulario){
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar un nuevo test decisiones?</h5><br><img src="../config/agregar_archivo.png">');
    }
    else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar este test decisiones?</h5><br><img src="../config/agregar_archivo.png">');
    }
    $("#contendor_botones_modal").empty();
    $("#contendor_botones_modal").html(
        '<button type="button" class="btn btn-default boton_modal" onClick="cerrarModalFormularioEnviarDatosTest()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>'
        +'<button type="button" id="guardar" class="btn btn-default boton_modal " onClick="enviarDatosTest()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> ');
    $("#modalFormularioTestOcular").modal("show");
}

function cerrarModalFormularioEnviarDatosTest(){
    $("#modalFormularioTestOcular").modal("hide");
}

function enviarDatosTest(){
    if(!window.datos_test[window.tipo_test].tipo_fomrulario){
        
		$('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando test ...</h5><br><img src="../config/agregar_archivo.png">');
	}else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando test ...</h5><br><img src="../config/agregar_archivo.png">');
	}
    let expresion_fecha=/-/g;
    let datosFormulario=[];
   

    let lista_ranking=rankingOrdenTest();
    // obteniendo los id de los jugadores wue no estan en el ranking en pocas palabras los
    // que no tiene nigun tiempo
    let listIdJugadoresFueraDelRank=[];
    for(let jugador of window.datos_test[window.tipo_test].jugadores_test){
        let estado=false;
        let idJugador=null;
        for(let {id} of lista_ranking){
            if(jugador.idfichaJugador===id){
                estado=true;
            }
        }
        if(!estado){
            listIdJugadoresFueraDelRank.push(jugador.idfichaJugador)
        }
    }

    for(let idJugador of listIdJugadoresFueraDelRank){
        lista_ranking.push({
            id: idJugador,
            rank: 0,
            toma_decision:0,
            presicion:0,
            manejo_presion:0,
            reaccion:0,
            adaptacion:0
        })
    }

    // for(let contador=0;contador<lista_ranking.length;contador++){
    //     let total_tiempo=lista_ranking[contador].tiempo_1+lista_ranking[contador].tiempo_2+lista_ranking[contador].tiempo_3+lista_ranking[contador].tiempo_4;
    //     if(total_tiempo===0) lista_ranking[contador].rank=0;
    //     lista_ranking[contador].comentario=document.getElementById("comentario_test_"+lista_ranking[contador].id).value;
    // }
    

    // obteniendo datos detalla      dos del test
    // obteniendo ids jugadores 
    for(let {id} of lista_ranking){
        datosFormulario.push({name:"array_idJugador[]",value:id});
    }
    // obteniendo rank jugadores 
    // for(let {rank} of lista_ranking){
    //     datosFormulario.push({name:"array_ranking[]",value:rank});
    // }
    // obteniendo tiempo 1 jugadores 
    for(let {toma_decision} of lista_ranking){
        datosFormulario.push({name:"array_toma_decision[]",value:toma_decision});
    }
    // obteniendo tiempo 2 jugadores 
    for(let {presicion} of lista_ranking){
        datosFormulario.push({name:"array_presicion[]",value:presicion});
    }
    // obteniendo tiempo 3 jugadores 
    for(let {manejo_presion} of lista_ranking){
        datosFormulario.push({name:"array_manejo_presion[]",value:manejo_presion});
    }
    // obteniendo tiempo 4 jugadores 
    for(let {reaccion} of lista_ranking){
        datosFormulario.push({name:"array_reaccion[]",value:reaccion});
    }
    // obteniendo tiempo 4 jugadores 
    for(let {adaptacion} of lista_ranking){
        datosFormulario.push({name:"array_adaptacion[]",value:adaptacion});
    }
    // obteniendo comentario jugadores 

     // Obteniendo datos generales test
    datosFormulario.push({name:"tipo_formulario",value:window.datos_test[window.tipo_test].tipo_fomrulario});
    datosFormulario.push({name:"idtest_decision",value: window.idtest_decision});
    datosFormulario.push({name:"fecha_evaluacion_test",value:$("#fecha_evaluacion_test").val()});
    datosFormulario.push({name:"ano_test",value:$("#fecha_evaluacion_test").val().split(expresion_fecha)[0]});
    datosFormulario.push({name:"observacion_test",value:$("#observacion_test").val()});
    datosFormulario.push({name:"nombre_usuario_software",value:window.nombre_usuario_software});
    datosFormulario.push({name:"numeros_jugadores_evaluados_test",value:lista_ranking.length});
    datosFormulario.push({name:"promedio_toma_decision",value:document.getElementById("promedio_toma_decision").textContent});
    datosFormulario.push({name:"promedio_presicion",value:document.getElementById("promedio_presicion").textContent});
    datosFormulario.push({name:"promedio_menejo_presion",value:document.getElementById("promedio_menejo_presion").textContent});
    datosFormulario.push({name:"promedio_reaccion",value:document.getElementById("promedio_reaccion").textContent});
    datosFormulario.push({name:"promedio_adaptacion",value:document.getElementById("promedio_adaptacion").textContent});
    console.log(datosFormulario);

    $.ajax({
            url: "post/test_guardar_test_decision.php",
            type: "post",
            data:datosFormulario,
            success: function(respuesta) {
                var json=JSON.parse(respuesta);
                // console.log(json);
                $("#modalFormularioTestOcular").modal("hide");
                $("#vista_test_formulario").hide(500);
                $("#vista_test").show(500);
                consultarTests($("#filtro_ano_test").val(),$("#filtro_mes_test").val());
                
            },error: function(){// will fire when timeout is reached
                // $('#error_conexion').show();
            }, timeout: 10000 // sets timeout to 3 seconds
        });

}


















</script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script>
// scripts 
    mostrar_al_cargar_pagina();
    cargarVentanaInicioTest();
    // ===================================================

</script>
