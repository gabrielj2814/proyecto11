<?PHP
include('../config/datos.php');
session_start();
if(!(isset($_SESSION["nombre_usuario_software"]))){
    session_destroy();
    header('Location: ../index.php?cerrar_sesion=1');
}
else{
    $menu_actual="test";
    $submenu_actual="test_ocular_jugador";
    $seccion_comentarios = $comentarios['test_ocular_jugador'];//mis cuotas
    $demo_seccion = $demo['test_ocular_jugador'];
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
        <title><?php echo $nombre_pestana_navegador;?> | Ocular</title>

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
        <div id="content" style="min-height: auto;">
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
                    <div id="vista_test_ocular" style="height:auto;" >
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
                        <div id="modalInicioTestOcular" class="modal hide" style="border-radius:10px;">
                                <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
                                </div>
                                <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
                                <center>
                                        <br>
                                        <div id="mensaje_agregar_DescargarBoleta_inicio_test_ocular">
                                        <h5><!--mensaje modal --></h5>
                                        </div>
                                        <br>
                                </center>
                                </div>
                                <div class="modal-footer" style="background-color: <?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
                                    
                                    <center>
                                        <div id="contendor_botones_modal_inicio_test_ocular">
                                            <button type="button" class="btn btn-default boton_modal" onClick="cerrarModalAtencionDiariaNuevo()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>
                                            <button type="button" id="guardar" class="btn btn-default boton_modal " onClick="agregarNuevoTratamiento()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button>
                                        </div>
                                    </center>
                                    
                                </div>
                        </div>
<!-- ================================================================= -->
                        <div id="modalInicioTestOcularInfo" class="modal hide" style="border-radius:10px;width: 74%;margin-left: -365px;margin-top:-30px;">
                                <div class="modal-header" style="background-color: #1c438c; border-top-right-radius: 5px; border-top-left-radius: 5px;height: 75px;">
                                    <!-- <button type="button" class="close" data-dismiss="modal">&times;</button> -->
                                    <div style="box-sizing: border-box;border:0;width:100%;height: 75px;display:inline-flex;flex-direction:row;flex-wrap:wrap;">
                                    
                                        <div style="box-sizing: border-box;border:0;width:20%;height: 75px;">
                                        </div>

                                        <div style="box-sizing: border-box;border:0;width:60%;height: 75px;padding-top:21px;">

                                            <div style="box-sizing: border-box;border:0;color:#fff;font-size:15px;font-weight: bold;text-align:center;margin-bottom:10px;">EVALUACIÓN VELOCIDAD OCULAR</div>
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
                                                    RANK
                                                </th>
                                                <th style="border:0;height:20px;line-height:20px;/*border-right:1px solid #111;*/text-align: center;max-width: 18px;" >JUGADOR</th>
                                                <th style="border:0;height:20px;line-height:20px;/*border-right:1px solid #111;*/text-align: center;max-width: 10px;" >RESULTADO</th>
                                                <th style="border:0;height:20px;line-height:20px;/*border-right:1px solid #111;*/text-align: center;max-width: 10px;" >EV.ANTERIOR</th>
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

                                        <div style="box-sizing: border-box;border:0;width:50%;height:200px;float:left;">
                                    
                                            <figure class="highcharts-figure">
                                                <div id="container"></div>
                                            </figure>
                                    
                                    
                                    
                                        </div>
                                        
                                        
                                        <div style="box-sizing: border-box;border:0;width:50%;height:200px;float:right;">

                                        <div style="box-sizing: border-box;border:0;width:100%;height:100px;padding-top:10px;padding-bottom:10px;">
                                            
                                            <div style="box-sizing: border-box;border:0;float:left;height:80px;color:#555;line-height:80px;font-weight: bold;margin-left:15px;margin-right:15px;width: 88px;">
                                                Mejor evaluado
                                            </div>
                                            <div id="velocidad_mejor_evaluador" style="box-sizing: border-box;border:0;float:left;width: 63px;height:80px;color:#555;line-height:80px;font-weight: bold;margin-right:15px;">
                                                0 seg
                                            </div>
                                            <div id="nombre_mejor_evaluador" style="box-sizing: border-box;border:0;float:left;height:80px;color:#555;line-height:80px;margin-right:15px;">
                                                nombre
                                            </div>
                                            <div style="box-sizing: border-box;border:0;background-color:#FFF;width:80px;height:80px;float:right;border-radius:100px;border:2px solid #555;overflow:hidden;">
                                                <img id="img_foto_mejor_jugador" src="" alt="foto_jugador_mejor_tiempo" style="box-sizing: border-box;border:0;display:block;width:80px;height:80px;">
                                            </div>
                                        
                                        </div>
                                        
                                        <div style="box-sizing: border-box;border:0;width:100%;height:100px;padding-top:10px;padding-bottom:10px;">
                                            
                                            <div style="box-sizing: border-box;border:0;float:left;height:80px;color:#555;line-height:80px;font-weight: bold;margin-left:15px;margin-right:15px;width: 88px;">
                                                Peor evaluado
                                            </div>
                                            <div id="velocidad_peor_evaluador" style="box-sizing: border-box;border:0;float:left;width: 63px;height:80px;color:#555;line-height:80px;font-weight: bold;margin-right:15px;">
                                                0 seg
                                            </div>
                                            <div id="nombre_peor_evaluador" style="box-sizing: border-box;border:0;float:left;height:80px;color:#555;line-height:80px;margin-right:15px;">
                                                nombre
                                            </div>
                                            <div style="box-sizing: border-box;border:0;background-color:#FFF;width:80px;height:80px;float:right;border-radius:100px;border:2px solid #555;overflow:hidden;">
                                                <img id="img_foto_peor_jugador" src="" alt="foto_jugador_peor_tiempo" style="box-sizing: border-box;border:0;display:block;width:80px;height:80px;">
                                            </div>
                                        
                                        </div>

                                        
                                        
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
                        <div style="margin:0px; height:20px;margin-left: auto;margin-right: auto;width: 141px;">
                                <img src="img/cargando_buscar.gif" id="cargando_buscar" style=" display:none;">
                                <span style="color:#dc4e4e; display:none;" id="error_conexion"><b>Error:</b> conexión a internet deficiente.</span>
                                <span style="color:#28b779; display:none;" id="sin_resultados">Busqueda sin resultados.</span>
                        </div>
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
                                <select style="width:60%; height: 30px;background:#fff;border:2px solid #0b3b99" id="filtro_ano_test_ocular" name="filtro_ano_test_ocular" onchange="filtrarTestOcular()">
                                    
                                </select>
                            </div>

                            <div style="width:45%;height: 30px;display:flex;float:left;">
                                <a class="btn btn-md btn-primary green-a" style="width: 36%;height: 20px;background:#0b3b99">
                                    <div>
                                        <p class="ellipsis-text" style="font-weight: normal;">Mes</p>
                                    </div>
                                </a>
                                <select style="width:60%; height: 30px;background:#fff;border:2px solid #0b3b99" id="filtro_mes_test_ocular" name="filtro_mes_test_ocular" onchange="filtrarTestOcular()">
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
                                    <div style="box-sizing:border-box;border:0;width:11%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;text-align:center">Evaluados</div>
                                    <div style="box-sizing:border-box;border:0;width:20%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;text-align:center">Mejor tiempo</div>
                                    <div style="box-sizing:border-box;border:0;width:20%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;text-align:center">Peor tiempo</div>
                                    <div style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;padding-left:5px;">Media</div>
                                    <div style="box-sizing:border-box;border:0;width:4%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height:30px;"></div>
                                    <div style="box-sizing:border-box;border:0;width:4%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height:30px;"></div>
                                    <div style="box-sizing:border-box;border:0;width:4%;height:30px;float:left;color:#fff;font-weight: 600;/*border-right:1px solid red;*/line-height:30px;"></div>
                                    
                                </div>
                                <div id="contenedor_fila_tabla_inicio_test_ocular" style="box-sizing:border-box;border:0;width:100%;color:#555;">

                                </div>
                                <div style="box-sizing:border-box;border:0;width:100%;height:10px;background-color:#555;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;"></div>
                            </div>
                    </div>
                    <div id="vista_test_formulario_ocular" style="display:none;">
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
                         <div id="modalAgregarJugadorTestOcular" class="modal hide" style="border-radius:10px;">
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
                                                <select style="width:50%; height: 30px;background:#fff;border:2px solid #001b73" class="" id="serie_test_ocular" name="serie_test_ocular" onchange="consultarJugadoresSerieAgregarTestOcular(this.value)">
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
                                            <div id="contendor_jugadores_test_ocular" style="display: none;margin-left:auto;margin-right:auto;width:50%;">
                                                <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#001b73">
                                                    <div>
                                                        <p class="ellipsis-text" style="font-weight: normal;">Jugador</p>
                                                    </div>
                                                </a>
                                                <select style="width:50%; height: 30px;background:#fff;border:2px solid #001b73" class="" id="jugador_test_ocular" name="jugador_test_ocular" onchange="">
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
                                            <button type="button" class="btn btn-default boton_modal" onClick="cerrarModalAgregarJugadorTestOcular()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>
                                            <button type="button" id="guardar" class="btn btn-default boton_modal " onClick="agregarJugadorTestOcular()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button>
                                        </div>
                                    </center>
                                    
                                </div>
                        </div>
                        <!--    MODAL AGREGAR JUGADOR TEST OCULAR FIN     -->

                        <form id="formulario-ocular" style="box-sizing: border-box;border:0;padding-top:15px;">
                            <div style="box-sizing: border-box;border:0;width:100%;box-sizing: border-box;border:0;width:100%;height:200px;margin-left:auto;margin-right:auto;margin-bottom:15px;/*background-color:lime;*/padding-left:15px;padding-right:15px;">
                                <img src="../config/logo_equipo.png" alt="logo equipo" style="box-sizing: border-box;border:0;width:20%;height:200px;float:left;"/>
                                <div style="box-sizing: border-box;border:0;width:80%;height:200px;float:left;" >
                                    <div style="box-sizing: border-box;border:0;color:#404040;font-size:13px;font-weight: 800;padding-left:27%;margin-bottom:15px;">TEST DE VELOCIDAD OCULAR</div>
                                    
                                    <div style="margin-left:25%;width:26%;height: 30px;display:flex;margin-bottom:30px;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 40%;height: 20px;background:#001b73">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Fecha evaluación</p>
                                            </div>
                                        </a>
                                        <input type="text" readonly style="width:60%; height: 18px;background:#fff;" class="grey-input" id="fecha_evaluacion_test_ocular" name="fecha_evaluacion_test_ocular" />                   
                                    </div>

                                    <div style="box-sizing: border-box;border:0;width: 100%;height: 104px;" >
                                        <div style="box-sizing: border-box;border:0;width: 100%;height: 20px;font-size:12px;font-weight: 800;">Observaciones</div>
                                        <textarea name="observacion_test_ocular" id="observacion_test_ocular"  style="box-sizing: border-box;border:0;width: 100%;height: 84px;resize: none;display:block;border-radius:5px;border:1px solid #acacac;" ></textarea>
                                
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div style="box-sizing:border-box;border:0;color:#555;width:50%;font-size: 12px;margin-left:auto;margin-right:auto;text-align:center;font-weight: 800;">JUGADORES ACTIVOS</div>
                            
                            <div style="box-sizing:border-box;border:0;width:109px;margin-left:auto;margin-right:25px;margin-bottom:5px;">
                                <button data-boton-abrir-formulario-test="ocular" class="boton-abrir-formulario" onClick="abrirModalAgregarJugadorTestOcular()"><b style="font-size:10px;"><i class="icon-plus"></i> Agregar jugador</b></button>
                            </div>

                            <div id="tabla_html_formulario_test_ocular" style="box-sizing:border-box;border:0;width:95%;margin-left:auto;margin-right:auto;margin-bottom:15px;">
                                <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;border-top-left-radius: 5px;border-top-right-radius: 5px;">
                                    <div style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;text-align:center">#</div>
                                    <div style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">POSICION</div>

                                    <div style="box-sizing:border-box;border:0;width:16%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">NOMBRE</div>
                                    <div style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">EDAD</div>
                                    <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">PIE HABIL</div>
                                    <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;text-align:center;">VELOCIADAD</div>
                                    <div style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;text-align:center;">RANK</div>
                                    <div style="box-sizing:border-box;border:0;width:29%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;text-align:center;"></div>
                                    <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#fff;font-weight: 800;/*border-right:1px solid red;*/"></div>
                                </div>
                                <div id="contenedor_fila_tabla_formulario_test_ocular" style="box-sizing:border-box;border:0;width:100%;color:#555;">

                                </div>
                                <div style="box-sizing:border-box;border:0;width:100%;height:10px;background-color:#555;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;"></div>
                            </div>
                            <div style="box-sizing:border-box;border:0;width:176px;height:30px;margin-left:auto;margin-right:auto;margin-bottom:15px;">
                                <span style="box-sizing:border-box;float:left;width:85px;height:30px;font-size:12px;color:#111;font-weight: 800;margin-right:15px;line-height:30px;">PROMEDIO</span>
                                <div id="promedio_test_ocular" style="box-sizing:border-box;float:left;width:70px;height:30px;background-color:#555;border:2px solid #acacac;text-align:right;font-size:12px;font-weight: 800;color:#fff;line-height:30px;padding-right:5px;border-radius:5px;">xxx</div>
                            </div>

                            <div style="box-sizing:border-box;border:0;width: 140px;margin-left: auto;margin-right:auto;">
                                    <button type="button" ng-disabled="" class="boton_guardar_informe" onClick="mostrarModalEnviarDatosTestOcular();" id="boton_guardar_test_ocular"><i class="icon-save"></i> GUARDAR CAMBIOS</button>
                            </div>
                            
                    
                            <button data-boton-cerrar-formulario-test="ocular" class="boton_volver" onclick="volverInicioModuloTest(this);" style="margin-left:10px"><i class="icon-arrow-left"></i> volver</button>
                    






                    
                    
                        </form>







                    </div>
                    
                    <!-- FIN TEST REACCION -->
                    <!-- ===================================================================== -->
                    
                    
                    
                    

                    

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


var ranking_test_ocular=[];

var ranking_test_cerabral=[];

var ranking_test_reaccion=[];

var ranking_test_decisiones=[];
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

var idtest_ocular=null;



</script>
<script>
// functiones
// async function consultarTestMensual(){
//     await $.ajax({
//         url: 'post/test_total_mes_test.php',
//         type: "post",
//         data:[],
//         success: function(respuesta) {
//             var json=JSON.parse(respuesta);
//             console.log(json);
//             document.getElementById("numero_de_informes_ocular").textContent="("+json.ocular.datos.length+") informes del mes"
            
//         },error: function(){// will fire when timeout is reached
//         }, timeout: 10000 // sets timeout to 3 seconds
//     });
// }

function descargarPDF(id){
    // alert(id);
    $("#descargarPDF").modal("show");
    $('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');
    $.ajax({
        url: "post/reportes/generarPDF_test_ocular.php",
        type: "post",
        cache: false,
        data:[{name:"id",value:id}],
        dataType:"json",
        success:(respuesta) => {
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

function mostrarModalInfoTest(indice){
    // alert(indice);
    let test=window.datos_test[window.tipo_test].lista_inicio_test[indice];
    let testAnterior=null;
    if(indice!==0){
        testAnterior=window.datos_test[window.tipo_test].lista_inicio_test[indice-1];
    }
    console.log(test);
    console.log(testAnterior);
    let fechaEvaluacion=formatoFechaDetalle(test.fecha_evaluacuion_test_ocular);
    let nombreJugadorMejorTiempo=test.info_jugador_mejor_tiempo.nombre+" "+test.info_jugador_mejor_tiempo.apellido1+" "+test.info_jugador_mejor_tiempo.apellido2;
    let nombreJugadorPeorTiempo=test.info_jugador_peor_tiempo.nombre+" "+test.info_jugador_peor_tiempo.apellido1+" "+test.info_jugador_peor_tiempo.apellido2;
    if(nombreJugadorPeorTiempo.length>=20){
        nombreJugadorPeorTiempo=nombreJugadorPeorTiempo.substring(0,20)+"...";
    }
    if(nombreJugadorMejorTiempo.length>=20){
        nombreJugadorMejorTiempo=nombreJugadorMejorTiempo.substring(0,20)+"...";
    }
    $("#fechaModalInfo").text(fechaEvaluacion);
    $("#img_foto_mejor_jugador").attr("src","./foto_jugadores/"+test.id_jugador_mejor_tiempo_test_ocular+".png");
    $("#nombre_mejor_evaluador").text(nombreJugadorMejorTiempo);
    $("#velocidad_mejor_evaluador").text(test.mejor_tiempo_test_ocular+" seg");
    $("#img_foto_peor_jugador").attr("src","./foto_jugadores/"+test.id_jugador_peor_tiempo_test_ocular+".png");
    $("#nombre_peor_evaluador").text(nombreJugadorPeorTiempo);
    $("#velocidad_peor_evaluador").text(test.peor_tiempo_test_ocular+" seg");
    $("#modalInicioTestOcularInfo").modal("show");
    let listaDetallesTest=[];
    if(testAnterior!==null){
        listaDetallesTest=[...test.detalles_test_ocular,...testAnterior.detalles_test_ocular];
    }
    else{
        listaDetallesTest=[...test.detalles_test_ocular];
    }
    console.log(listaDetallesTest);
    insertarFilasTablaModalInfo(listaDetallesTest);
    insertarDatosGraficoBar(test);
}

function insertarFilasTablaModalInfo(listaDetallesTest){
    $("#tabla_info").empty();
    let listaJugadoresDestallesTests=[];
    for(let testDetalle of listaDetallesTest){
        if(testDetalle.ranking_detalle_test_ocular!=="0"){
            let jugador=testDetalle.jugador_info;
            let nombre=jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2;
            if(nombre.length>=15){
                nombre=nombre.substring(0,15)+"...";
            }
            let plantilla='\
                <tr style="box-sizing:border-box;border:0;height:50px;color:#555;font-size:10px;">\
                    <th  id="numero_rank_tabla" style="border:0;height:50px;line-height:50px;/*border-right:1px solid #111;*/text-align: center; max-width: 10px;font-weight: bold;" >\
                        '+testDetalle.ranking_detalle_test_ocular+'\
                    </th>\
                    <th style="border:0;height:50px;line-height:50px;/*border-right:1px solid #111;*/text-align: center; max-width: 10px;font-weight: bold;" >\
                        <div style="box-sizing:border-box;border:0;float:left;width:40px;height:40px;border:2px solid #555;border-radius:100px;overflow:hidden;">\
                            <img style="box-sizing:border-box;display:block;width:40px;height:40px;" src="./foto_jugadores/'+jugador.idfichaJugador+'.png" alt="foto_jugador_tabla">\
                        </div>\
                        <div style="box-sizing:border-box;border:0;float:left;height:40px;line-height:40px;margin-left:10px;">'+nombre+'</div>\
                    </th>\
                    <th style="border:0;height:50px;line-height:50px;/*border-right:1px solid #111;*/text-align: center;max-width: 10px;font-weight: normal;" >'+testDetalle.velocidad_detalle_test_ocular+' seg</th>\
                    <th style="border:0;height:50px;line-height:50px;/*border-right:1px solid #111;*/text-align: center;max-width: 10px;font-weight: normal;" >'+testDetalle.idtest_ocular+'</th>\
                    <th style="border:0;height:50px;line-height:50px;/*border-right:1px solid #111;*/max-width: 10px;    text-align: left;font-weight: normal;" >'+jugador.texto_posicion+'</th>\
                </tr>';
            listaJugadoresDestallesTests.push(plantilla);
        }
    }
    let strFilaTabla=listaJugadoresDestallesTests.join("");
    $("#tabla_info").append(strFilaTabla);

}

function validarCampoFormulario(){
    let $listaInputCampoVelocidadFormulario=document.querySelectorAll(".campo_velocidad");
    // let $listaInputCampoComentarioFormulario=document.querySelectorAll(".campo_comentario");
    let exprecionRegular=/[a-zA-Z]/g;
    // console.log("listando nodos input velocidad ->>>",$listaInputCampoVelocidadFormulario);
    let estadoInputVelocidad=false;
    for($inputVelocidad of $listaInputCampoVelocidadFormulario){
        if($inputVelocidad.value!==""){
            if(exprecionRegular.test($inputVelocidad.value)){
                estadoInputVelocidad=true;
                break;
            }
        }
        else{
            estadoInputVelocidad=true;
            break;
        }
    }
    // boton_guardar_test_ocular
    if(!estadoInputVelocidad){
        $("#boton_guardar_test_ocular").prop("disabled",false);
    }
    else{
        $("#boton_guardar_test_ocular").prop("disabled",true);
    }
}

function consultarAnoActual(){
    $.ajax({
        url: 'post/test_año_actual.php',
        type: "post",
        data:[],
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            window.ano_actual_servidor=parseInt(json.ano_actual);
            
        },error: function(){// will fire when timeout is reached
        }, timeout: 10000 // sets timeout to 3 seconds
    });
}

function formato_fecha_mes_texto(fecha_sin_formato){
    let lista_meses=[
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
                "Diciembre"
            ] ; 

        let dia_semana=[
                "Domingo",
                "Lunes",
                "Martes",
                "Miercoles",
                "Jueves",
                "Viernes",
                "Sabado"
        ] ; 
            let ano=fecha_sin_formato.split("-")[0] ; 
            let mes=fecha_sin_formato.split("-")[1] ; 
            let dia=fecha_sin_formato.split("-")[2] ; 
            let fecha=new Date() ; 
            fecha.setDate(parseInt(dia)) ; 
            fecha.setMonth(parseInt(mes)-1) ; 
            fecha.setFullYear(parseInt(ano)) ; 

            // let fecha_con_formato=dia_semana[fecha.getDay()]+' '+fecha.getDate()+' de '+lista_meses[fecha.getMonth()]+' '+fecha.getFullYear() ; 
            let fecha_con_formato=fecha.getDate()+' de '+lista_meses[fecha.getMonth()]+' del '+fecha.getFullYear() ; 
            return fecha_con_formato;
}

function insertarOptionSelectFiltroTestOcular(){
    let list_option=[];
    for(let contador=window.ano_actual;contador>=window.ano_actual-5;contador--){
        let option_str="<option value='"+contador+"'>"+contador+"</option>";
        list_option.push(option_str);
    }
    let str_list_option=list_option.join("");
    document.getElementById("filtro_ano_test_ocular").innerHTML=str_list_option;
}


function botonVolverAInicio($botonVolver){
    let etiquetaPadre=$botonVolver.parentElement;
    $("#"+etiquetaPadre.id).hide(500);
    $("#vista_inicio_test").show(500);
    window.tipo_test=null;
    for(let test in window.datos_test){
        window.datos_test[test]={
            tipo_fomrulario:false,
            lista_inicio_test:[],
            jugadores_test:[]
        };
    }
}


function cargarVentanaInicioTest(){
    // alert("hlo")
    $('#cargando_buscar').show();
    consultarAnoActual();
    let mesNumero=obtenerMesNumero();
    window.tipo_test="ocular";
    insertarOptionSelectFiltroTestOcular();
    $("#filtro_mes_test_ocular").val(mesNumero);
    setTimeout(() => {
        // alert("hola")
        consultarTestsOculares($("#filtro_ano_test_ocular").val(),$("#filtro_mes_test_ocular").val());
        
    },3000);

}

function volverInicioModuloTest($botonCerrarFormularioTest){
    $("#cargando_buscar").show();
    $("#vista_test_formulario_ocular").hide(500);
    $("#vista_test_ocular").show(500);
    insertarOptionSelectFiltroTestOcular();
    $("#filtro_mes_test_ocular").val("01");
    consultarTestsOculares($("#filtro_ano_test_ocular").val(),$("#filtro_mes_test_ocular").val());
}

function abrirFormularioTest(){
    $("#vista_test_ocular").hide(500);
    $("#vista_test_formulario_ocular").show(500);
    formularioTestOcular();
}

function abrirFormularioTestEditar(indice){
    $("#vista_test_ocular").hide(500);
    $("#vista_test_formulario_ocular").show(500);
    formularioTestOcular(true,indice);
}

function formularioTestOcular(tipo=false,index=null){
    if(!tipo){
        formularioTestOcularCrear();
        consultarJugadoresSerie("99_1");
    }
    else{
        formularioTestOcularEditar(index);
    }
}

function formularioTestOcularCrear(){
    window.idtest_ocular=null;
    window.datos_test[window.tipo_test].tipo_fomrulario=false;
    window.ranking_test_ocular=[];
    window.datos_test[window.tipo_test].jugadores_test=[];
    fechaTestEvaluacionOcular();
    $("#observacion_test_ocular").val("");
    document.getElementById("promedio_test_ocular").textContent="0.00";
}

function formularioTestOcularEditar(indice){
    let test=window.datos_test[window.tipo_test].lista_inicio_test[indice];
    window.idtest_ocular=test.idtest_ocular;
    window.ranking_test_ocular=[];
    // console.log(test);
    window.datos_test[window.tipo_test].tipo_fomrulario=true;
    fechaTestEvaluacionOcular();
    $("#fecha_evaluacion_test_ocular").val(test.fecha_evaluacuion_test_ocular);
    $("#observacion_test_ocular").val(test.observacion_test_ocular);
    insertarFilaJugadoresTestOcularEditar(test.detalles_test_ocular);

}

function consultarJugadoresSerie(valor){
    // consultar jugadores por la serie en base al tipo de test del formulario
    let serie=valor.split("_")[0],
    sexo=valor.split("_")[1];
    window.datos_test[window.tipo_test].jugadores_test=[];
    $.ajax({
        url: 'post/test_consultar_Jugadores.php',
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
                insertarFilaJugadoresTestOcular(window.datos_test[window.tipo_test].jugadores_test);
                // validarCampoFormulario();
            }
            else{
                let plantilla='<div class="panel_buscar" style="box-sizing:border-box;border:0;width:100%;height:34px;padding-top:2px;padding-bottom:2px;text-align:center;font-weight: 800;font-size:12px;line-height:30px;">Sin Jugadores</div>';
                $("#contenedor_fila_tabla_formulario_test_ocular").append(plantilla);
            }
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
        }, timeout: 10000 // sets timeout to 3 seconds
    });
}


// TEST OCULAR ==================================================================


function abrirModalAgregarJugadorTestOcular(){
    $("#modalAgregarJugadorTestOcular").modal("show");
}

function cerrarModalAgregarJugadorTestOcular(){
    $("#modalAgregarJugadorTestOcular").modal("hide");
    $("#jugador_test_ocular").empty();
    $("#contendor_jugadores_test_ocular").css("display","none");
    $("#serie_test_ocular").val("null");
}

function agregarJugadorTestOcular(){
    let jugadorSeleccionado=window.listaJugadores.filter(jugador => jugador.idfichaJugador===$("#jugador_test_ocular").val())[0];
    agregarJugadorNuevoAlTestOcular(jugadorSeleccionado);
}

function agregarJugadorNuevoAlTestOcular(jugador){
    console.log(window.datos_test[window.tipo_test]);
    let estado=false;

    for(let jugadorBusqueda of window.datos_test[window.tipo_test].jugadores_test){

        if(jugador.idfichaJugador===jugadorBusqueda.idfichaJugador){
            estado=true;

        }


    }

    if(!estado){
        
        let $indeces=document.querySelectorAll(".index_formulario_test_ocular");
        let numero_fila=parseInt($indeces[$indeces.length-1].textContent)+1;
        let plantilla='\
            <div id="fila_formulario_test_ocular_'+jugador.idfichaJugador+'" class="panel_buscar" style="box-sizing:border-box;border:0;width:100%;height:34px;padding-top:2px;padding-bottom:2px;">\
                <div class="index_formulario_test_ocular" style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-align:center;">'+(numero_fila)+'</div>\
                <div style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-transform: Capitalize" class="ellipsis-text">\
                    <img src="flags/blank.gif" class="flag flag-'+jugador.nacionalidad1.toLowerCase()+'"/> '+obtenerInicialDelPosicion(window.lista_posiciones[parseInt(jugador.posicion)-1])+'\
                </div>\
                <div style="box-sizing:border-box;border:0;width:16%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;" >\
                    <div style="box-sizing:border-box;border:0;float:left;width:20%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;" >\
                        <img style="width:100%;height:32px" src="./foto_jugadores/'+jugador.idfichaJugador+'.png"/>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;float:left;width:80%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;text-transform: Capitalize" class="ellipsis-text">'+jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2+'</div>\
                </div>\
                <div style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">'+calcularEdad(jugador.fechaNacimiento)+' Años</div>\
                <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">'+obtenerPieHabil(jugador.pieHabil)+'</div>\
                <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                    <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]" class="campo_velocidad" id="velocidad_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)"/>\
                </div>\
                <div style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-align:center;">\
                    <div id="ranking_test_ocular_formulario_'+jugador.idfichaJugador+'" style="box-sizing:border-box;border:0;width:100%;height:100%;line-height:30px;background-color:#f4f86f;font-weight: bold;">-</div>\
                </div>\
                <div style="box-sizing:border-box;border:0;width:29%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                    <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_comentario[]" class="campo_comentario" id="comentario_test_ocular_'+jugador.idfichaJugador+'"/>\
                </div>\
                <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;">\
                    <center>\
                        <a class="boton_eliminar" id="'+jugador.idfichaJugador+'" onClick="eliminarFilaJugadorTest(this)">\
                            <i class="icon-remove"></i>\
                        </a>\
                    </center>\
                </div>\
            </div>';
            window.datos_test[window.tipo_test].jugadores_test.push(jugador);
            $("#contenedor_fila_tabla_formulario_test_ocular").append(plantilla);
            
        }
        cerrarModalAgregarJugadorTestOcular();

    // let $indeces=document.querySelectorAll(".index_formulario_test_ocular");
    //     let numero_fila=parseInt($indeces[$indeces.length-1].textContent)+1;
    //     let plantilla='\
    //         <div id="fila_formulario_test_ocular_'+jugador.idfichaJugador+'" class="panel_buscar" style="box-sizing:border-box;border:0;width:100%;height:34px;padding-top:2px;padding-bottom:2px;">\
    //             <div class="index_formulario_test_ocular" style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-align:center;">'+(numero_fila)+'</div>\
    //             <div style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-transform: Capitalize" class="ellipsis-text">\
    //                 <img src="flags/blank.gif" class="flag flag-'+jugador.nacionalidad1.toLowerCase()+'"/> '+obtenerInicialDelPosicion(window.lista_posiciones[parseInt(jugador.posicion)-1])+'\
    //             </div>\
    //             <div style="box-sizing:border-box;border:0;width:16%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;" >\
    //                 <div style="box-sizing:border-box;border:0;float:left;width:20%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;" >\
    //                     <img style="width:100%;height:32px" src="./foto_jugadores/'+jugador.idfichaJugador+'.png"/>\
    //                 </div>\
    //                 <div style="box-sizing:border-box;border:0;float:left;width:80%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;text-transform: Capitalize" class="ellipsis-text">'+jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2+'</div>\
    //             </div>\
    //             <div style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">'+calcularEdad(jugador.fechaNacimiento)+' Años</div>\
    //             <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">'+obtenerPieHabil(jugador.pieHabil)+'</div>\
    //             <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
    //                 <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]" class="campo_velocidad" id="velocidad_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)"/>\
    //             </div>\
    //             <div style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-align:center;">\
    //                 <div id="ranking_test_ocular_formulario_'+jugador.idfichaJugador+'" style="box-sizing:border-box;border:0;width:100%;height:100%;line-height:30px;background-color:#f4f86f;font-weight: bold;">-</div>\
    //             </div>\
    //             <div style="box-sizing:border-box;border:0;width:29%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
    //                 <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_comentario[]" class="campo_comentario" id="comentario_test_ocular_'+jugador.idfichaJugador+'"/>\
    //             </div>\
    //             <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;">\
    //                 <center>\
    //                     <a class="boton_eliminar" id="'+jugador.idfichaJugador+'" onClick="eliminarFilaJugadorTest(this)">\
    //                         <i class="icon-remove"></i>\
    //                     </a>\
    //                 </center>\
    //             </div>\
    //         </div>';
    //         $("#contenedor_fila_tabla_formulario_test_ocular").append(plantilla);
    //         cerrarModalAgregarJugadorTestOcular();

    
    
}


function consultarJugadoresSerieAgregarTestOcular(valor){
    // consultar jugadores por la serie en base al tipo de test del formulario
    if(valor!=="null"){
        let serie=valor.split("_")[0],
        sexo=valor.split("_")[1];
        $.ajax({
            url: 'post/test_consultar_Jugadores.php',
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
        $("#jugador_test_ocular").empty();
        $("#contendor_jugadores_test_ocular").css("display","none");
    }
}

function insertarJugadoresSelect(jugadores=[]){
    $("#jugador_test_ocular").empty();
    let listaJugadores=[{id:null,nombre:"Seleccione jugador"}];
    if(jugadores.length>0){
        for(let jugador of jugadores){
            let nombre_jugador=jugador.nombre+" "+jugador.apellido1+" "+jugador.apellido2;
            listaJugadores.push({id:jugador.idfichaJugador,nombre:nombre_jugador});
        }
    }else{
        listaJugadores[0].nombre="Sin Jugadores";
    }
    $("#contendor_jugadores_test_ocular").css("display","flex");
    for(let optionJugador of listaJugadores){
        $("#jugador_test_ocular").append("<option value='"+optionJugador.id+"'>"+optionJugador.nombre+"</option>");
    }
}

function fechaTestEvaluacionOcular(){
    $('#fecha_evaluacion_test_ocular').datetimepicker({
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
    $('#fecha_evaluacion_test_ocular').datetimepicker('setDate', new Date() );
}


function consultarTestsOculares(ano="2020",mes="01"){
    $("#contenedor_fila_tabla_inicio_test_ocular").empty();
    window.datos_test[window.tipo_test].lista_inicio_test=[];
    $.ajax({
        url: 'post/test_consultar_test_ocular_año_mes.php',
        type: "post",
        data:[
            {name:"ano_test_oculares",value:ano},
            {name:"mes_test_oculares",value:mes},
        ],
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            window.datos_test[window.tipo_test].lista_inicio_test=json.datos;
            $('#cargando_buscar').hide();
            $("#error_conexion").hide();
            // console.log("listando test oculares",window.datos_test[window.tipo_test].lista_inicio_test);
            insertarFilaInicioTestOculares(window.datos_test[window.tipo_test].lista_inicio_test);
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
            $("#error_conexion").show();
        }, timeout: 10000 // sets timeout to 3 seconds
    });
}

function filtrarTestOcular (){
    consultarTestsOculares($("#filtro_ano_test_ocular").val(),$("#filtro_mes_test_ocular").val());
}

function insertarFilaInicioTestOculares(tests=[]){
    if(tests.length!==0){
        $("#sin_resultados").hide();
        let lista_test_ocular=[];
        let contador=0;
        for(let test of tests){

            let detalleInfoTestOcular=test.detalles_test_ocular.filter( detalle => {
                if(detalle.idfichaJugador===test.id_jugador_mejor_tiempo_test_ocular){
                    return detalle;
                }
                else if(detalle.idfichaJugador===test.id_jugador_peor_tiempo_test_ocular){
                    return detalle;
                }
            });

            let str_fila_registro='\
            <div class="panel_buscar" style="box-sizing:border-box;border:0;width:100%;height:64px;padding-top:2px;padding-bottom:2px;">\
                <div onClick="mostrarModalInfoTest('+contador+')" style="box-sizing:border-box;border:0;width:2%;height:60px;float:left;color:#555;font-weight: 600;/*border-right:1px solid red;*/line-height: 60px;font-size: 11px;padding-left:5px;text-align:center">'+(contador+1)+'</div>\
                <div onClick="mostrarModalInfoTest('+contador+')" style="box-sizing:border-box;border:0;width:12%;height:60px;float:left;color:#555;font-weight: 600;/*border-right:1px solid red;*/line-height: 60px;font-size: 11px;padding-left:5px;">'+fecha_formato_ddmmaaa(test.fecha_evaluacuion_test_ocular)+'</div>\
                <div onClick="mostrarModalInfoTest('+contador+')" style="box-sizing:border-box;border:0;width:6%;height:60px;float:left;color:#555;font-weight: 600;/*border-right:1px solid red;*/line-height: 60px;font-size: 11px;padding-left:5px;">'+test.ano_test_ocular+'</div>\
                <div onClick="mostrarModalInfoTest('+contador+')" style="box-sizing:border-box;border:0;width:10%;height:60px;float:left;color:#555;font-weight: 400;/*border-right:1px solid red;*/line-height: 60px;font-size: 11px;padding-left:5px;">Informe N°'+test.idtest_ocular+'</div>\
                <div onClick="mostrarModalInfoTest('+contador+')" style="box-sizing:border-box;border:0;width:11%;height:60px;float:left;color:#555;font-weight: 400;/*border-right:1px solid red;*/line-height: 60px;font-size: 11px;text-align:center">'+test.numeros_jugadores_evaluados_test_ocular+' Jugadores</div>\
                <div onClick="mostrarModalInfoTest('+contador+')" style="box-sizing:border-box;border:0;width:20%;height:60px;float:left;color:#555;font-weight: 600;/*border-right:1px solid red;*/line-height: 60px;font-size: 11px;">\
                    <div style="box-sizing:border-box;border:0;width:100%;height:60px;">\
                        <div style="box-sizing:border-box;border:0;float:left;width:31%;height:60px;border-radius: 34px;overflow: hidden;border: 2px solid #555;">\
                            <img style="width:100%;height:113%" src="./foto_jugadores/'+test.id_jugador_mejor_tiempo_test_ocular+'.png">\
                        </div>\
                        <div style="box-sizing:border-box;border:0;float:left;width:65%;height:60px;padding-left:5px;color:#555;font-weight: 900;line-height: 60px;color:#555;text-transform: Capitalize" class="ellipsis-text"><span style="font-weight: 400;">'+detalleInfoTestOcular[0].velocidad_detalle_test_ocular+' seg</span> '+test.info_jugador_mejor_tiempo.nombre+' '+test.info_jugador_mejor_tiempo.apellido1+' '+test.info_jugador_mejor_tiempo.apellido2+'</div>\
                    </div>\
                </div>\
                <div onClick="mostrarModalInfoTest('+contador+')" style="box-sizing:border-box;border:0;width:20%;height:60px;float:left;color:#555;font-weight: 600;/*border-right:1px solid red;*/line-height: 60px;font-size: 11px;text-align:center">\
                    <div style="box-sizing:border-box;border:0;width:100%;height:60px;">\
                        <div style="box-sizing:border-box;border:0;float:left;width:31%;height:60px;border-radius: 34px;overflow: hidden;border: 2px solid #555;">\
                            <img style="width:100%;height:113%" src="./foto_jugadores/'+test.id_jugador_peor_tiempo_test_ocular+'.png">\
                        </div>\
                        <div style="box-sizing:border-box;border:0;float:left;width:65%;height:60px;padding-left:5px;color:#555;font-weight: 900;line-height: 60px;color:#555;text-transform: Capitalize" class="ellipsis-text"><span style="font-weight: 400;">'+detalleInfoTestOcular[1].velocidad_detalle_test_ocular+' seg</span> '+test.info_jugador_peor_tiempo.nombre+' '+test.info_jugador_peor_tiempo.apellido1+' '+test.info_jugador_peor_tiempo.apellido2+'</div>\
                    </div>\
                </div>\
                <div onClick="mostrarModalInfoTest('+contador+')" style="box-sizing:border-box;border:0;width:7%;height:60px;float:left;color:#555;font-weight: 400;/*border-right:1px solid red;*/line-height: 60px;font-size: 11px;padding-left:5px;">'+test.media_test_ocular+' seg</div>\
                <div style="box-sizing:border-box;border:0;width:4%;height:60px;float:left;color:#555;font-weight: 600;/*border-right:1px solid red;*/line-height:60px;">\
                    <center>\
                            <a class="boton_editar" onClick="abrirFormularioTestEditar('+contador+')">\
                                <i class="icon-pencil"></i>\
                            </a>\
                    </center>\
                </div>\
                <div style="box-sizing:border-box;border:0;width:4%;height:60px;float:left;color:#555;font-weight: 600;/*border-right:1px solid red;*/line-height:60px;">\
                    <center>\
                            <a class="boton_add" onClick="descargarPDF('+test.idtest_ocular+')">\
                                <i class="icon-download-alt"></i>\
                            </a>\
                    </center>\
                </div>\
                <div style="box-sizing:border-box;border:0;width:4%;height:60px;float:left;color:#555;font-weight: 600;/*border-right:1px solid red;*/line-height:60px;">\
                    <center>\
                            <a class="boton_eliminar" onClick="mostrarModalEliminarTestOcular('+test.idtest_ocular+')">\
                                <i class="icon-remove"></i>\
                            </a>\
                    </center>\
                </div>\
            </div>';
            lista_test_ocular.push(str_fila_registro);
            contador++;
        }
        let string_list_option_join=lista_test_ocular.join("");
        $("#contenedor_fila_tabla_inicio_test_ocular").append(string_list_option_join);

    }
    else{
        $("#sin_resultados").show();
        let str_fila_registro='<div class="panel_buscar" style="box-sizing:border-box;border:0;width:100%;height:34px;padding-top:2px;padding-bottom:2px;text-align:center;font-weight: 800;font-size:12px;line-height:30px;">Sin Test</div>';
        $("#contenedor_fila_tabla_inicio_test_ocular").append(str_fila_registro);
    }
}





function insertarFilaJugadoresTestOcular(jugadores=[]){
    let lista_str_filas_jugadores=[];
    $("#contenedor_fila_tabla_formulario_test_ocular").empty();
    if(jugadores.length>0){
        let contador=0;
        for(let jugador of jugadores){
            let plantilla='\
                <div id="fila_formulario_test_ocular_'+jugador.idfichaJugador+'" class="panel_buscar" style="box-sizing:border-box;border:0;width:100%;height:34px;padding-top:2px;padding-bottom:2px;">\
                    <div class="index_formulario_test_ocular" style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-align:center;">'+(contador+1)+'</div>\
                    <div style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-transform: Capitalize" class="ellipsis-text">\
                        <img src="flags/blank.gif" class="flag flag-'+jugador.nacionalidad1.toLowerCase()+'"/> '+obtenerInicialDelPosicion(lista_posiciones[parseInt(jugador.posicion)-1])+'\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:16%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;" >\
                        <div style="box-sizing:border-box;border:0;float:left;width:20%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;" >\
                            <img style="width:100%;height:32px" src="./foto_jugadores/'+jugador.idfichaJugador+'.png"/>\
                        </div>\
                        <div style="box-sizing:border-box;border:0;float:left;width:80%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;text-transform: Capitalize" class="ellipsis-text">'+jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2+'</div>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">'+calcularEdad(jugador.fechaNacimiento)+' Años</div>\
                    <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">'+obtenerPieHabil(jugador.pieHabil)+'</div>\
                    <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                        <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]"  class="campo_velocidad" id="velocidad_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)"/>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-align:center;">\
                        <div id="ranking_test_ocular_formulario_'+jugador.idfichaJugador+'" style="box-sizing:border-box;border:0;width:100%;height:100%;line-height:30px;background-color:#f4f86f;font-weight: bold;">-</div>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;width:29%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                        <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_comentario[]"  class="campo_comentario" id="comentario_test_ocular_'+jugador.idfichaJugador+'"/>\
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
        // contenedor_fila_tabla_formulario_test_ocular
        if(lista_str_filas_jugadores.length!==0){
            let filas_join=lista_str_filas_jugadores.join("");
            $("#contenedor_fila_tabla_formulario_test_ocular").append(filas_join);
        }
    }
}

function insertarFilaJugadoresTestOcularEditar(detallesTest=[]){
    let lista_str_filas_jugadores=[];
    let lista_id_filas=[];
    window.datos_test[window.tipo_test].jugadores_test=[];
    $("#contenedor_fila_tabla_formulario_test_ocular").empty();
    console.log("->>>>",detallesTest);
    let contador=0;
    if(detallesTest.length>0){
        for(let detalle of detallesTest){
            if(detalle.ranking_detalle_test_ocular!=="0"){
                let jugador=detalle.jugador_info;
                let plantilla='\
                    <div id="fila_formulario_test_ocular_'+jugador.idfichaJugador+'" class="panel_buscar" style="box-sizing:border-box;border:0;width:100%;height:34px;padding-top:2px;padding-bottom:2px;">\
                        <div class="index_formulario_test_ocular" style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-align:center;">'+(contador+1)+'</div>\
                        <div style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-transform: Capitalize" class="ellipsis-text">\
                            <img src="flags/blank.gif" class="flag flag-'+jugador.nacionalidad1.toLowerCase()+'"/> '+obtenerInicialDelPosicion(lista_posiciones[parseInt(jugador.posicion)-1])+'\
                        </div>\
                        <div style="box-sizing:border-box;border:0;width:16%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;" >\
                            <div style="box-sizing:border-box;border:0;float:left;width:20%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;" >\
                                <img style="width:100%;height:32px" src="./foto_jugadores/'+jugador.idfichaJugador+'.png"/>\
                            </div>\
                            <div style="box-sizing:border-box;border:0;float:left;width:80%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;text-transform: Capitalize" class="ellipsis-text">'+jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2+'</div>\
                        </div>\
                        <div style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">'+calcularEdad(jugador.fechaNacimiento)+' Años</div>\
                        <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">'+obtenerPieHabil(jugador.pieHabil)+'</div>\
                        <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                            <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]"  class="campo_velocidad" id="velocidad_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)" value="'+detalle.velocidad_detalle_test_ocular+'"/>\
                        </div>\
                        <div style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-align:center;">\
                            <div id="ranking_test_ocular_formulario_'+jugador.idfichaJugador+'" style="box-sizing:border-box;border:0;width:100%;height:100%;line-height:30px;background-color:#f4f86f;font-weight: bold;">-</div>\
                        </div>\
                        <div style="box-sizing:border-box;border:0;width:29%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                            <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_comentario[]"  class="campo_comentario" id="comentario_test_ocular_'+jugador.idfichaJugador+'" value="'+detalle.comentario_detalle_test_ocular+'"/>\
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
                    window.datos_test[window.tipo_test].jugadores_test.push(jugador);
                    lista_id_filas.push(jugador.idfichaJugador);
                    lista_str_filas_jugadores.push(plantilla);
            }
        }
        // contenedor_fila_tabla_formulario_test_ocular
        if(lista_str_filas_jugadores.length!==0){
            let filas_join=lista_str_filas_jugadores.join("");
            $("#contenedor_fila_tabla_formulario_test_ocular").append(filas_join);
            for(id of lista_id_filas){
                const $input=document.getElementById("velocidad_"+id);
                sumarAlRankingTestOcular($input);
            }
        }
    }
    lista_str_filas_jugadores=[];
    if(detallesTest.length>0){
        for(let detalle of detallesTest){
            if(detalle.ranking_detalle_test_ocular==="0"){
                let jugador=detalle.jugador_info;
                let plantilla='\
                    <div id="fila_formulario_test_ocular_'+jugador.idfichaJugador+'" class="panel_buscar" style="box-sizing:border-box;border:0;width:100%;height:34px;padding-top:2px;padding-bottom:2px;">\
                        <div class="index_formulario_test_ocular" style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-align:center;">'+(contador+1)+'</div>\
                        <div style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-transform: Capitalize" class="ellipsis-text">\
                            <img src="flags/blank.gif" class="flag flag-'+jugador.nacionalidad1.toLowerCase()+'"/> '+obtenerInicialDelPosicion(lista_posiciones[parseInt(jugador.posicion)-1])+'\
                        </div>\
                        <div style="box-sizing:border-box;border:0;width:16%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;" >\
                            <div style="box-sizing:border-box;border:0;float:left;width:20%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;" >\
                                <img style="width:100%;height:32px" src="./foto_jugadores/'+jugador.idfichaJugador+'.png"/>\
                            </div>\
                            <div style="box-sizing:border-box;border:0;float:left;width:80%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;text-transform: Capitalize" class="ellipsis-text">'+jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2+'</div>\
                        </div>\
                        <div style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">'+calcularEdad(jugador.fechaNacimiento)+' Años</div>\
                        <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 12px;">'+obtenerPieHabil(jugador.pieHabil)+'</div>\
                        <div style="box-sizing:border-box;border:0;width:12%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                            <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_velocidad[]"  class="campo_velocidad" id="velocidad_'+jugador.idfichaJugador+'" data-id-jugador="'+jugador.idfichaJugador+'" onKeyup="sumarAlRankingTestOcular(this)" value=""/>\
                        </div>\
                        <div style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;text-align:center;">\
                            <div id="ranking_test_ocular_formulario_'+jugador.idfichaJugador+'" style="box-sizing:border-box;border:0;width:100%;height:100%;line-height:30px;background-color:#f4f86f;font-weight: bold;">-</div>\
                        </div>\
                        <div style="box-sizing:border-box;border:0;width:29%;height:30px;float:left;font-weight: bold;/*border-right:1px solid red;*/line-height: 30px;font-size: 11px;padding-left:5px;padding-right:5px;">\
                            <input style="box-sizing:border-box;width:100%;height:100%;border:1px solid #acacac;" type="text" name="array_comentario[]"  class="campo_comentario" id="comentario_test_ocular_'+jugador.idfichaJugador+'" value="'+detalle.comentario_detalle_test_ocular+'"/>\
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
                    window.datos_test[window.tipo_test].jugadores_test.push(jugador);
                    lista_id_filas.push(jugador.idfichaJugador);
                    lista_str_filas_jugadores.push(plantilla);
            }
        }
        if(lista_str_filas_jugadores.length!==0){
            let filas_join=lista_str_filas_jugadores.join("");
            $("#contenedor_fila_tabla_formulario_test_ocular").append(filas_join);
        }


    }
}

function eliminarFilaJugadorTest($boton){
    // este codigo se encarga de eliminar los jugadores del test en el te encuentras
    // actualiza el ranking
    let id=$boton.id;
    let $fila=document.getElementById("fila_formulario_test_ocular_"+id);
    let $contenedorFilasTablaTest=document.getElementById("contenedor_fila_tabla_formulario_test_ocular");
    let $contenedorIndex=$fila.children[0];
    let numero_fila_removida=parseInt($contenedorIndex.textContent);

    $contenedorFilasTablaTest.removeChild($fila);
    let contador=0;
    for(let jugador of window.datos_test[window.tipo_test].jugadores_test){
        if(jugador.idfichaJugador===id){
            window.datos_test[window.tipo_test].jugadores_test.splice(contador,1);
        }
        contador++;
    }
    let lista=window.ranking_test_ocular;
    let contador2=0;
    for(let jugador of lista){
        if(jugador.id===id){
            lista.splice(contador2,1);
        }
        contador2++;
    }
    document.getElementById("promedio_test_ocular").textContent=promedioTestOcularFormulario().toFixed(2).toString();
    reordenarListaFormularioTestOcular(numero_fila_removida);
    // validarCampoFormulario();
}

function reordenarListaFormularioTestOcular(numero){
    $indicesTestOcularFormulario=document.querySelectorAll(".index_formulario_test_ocular");
    for(let indice of $indicesTestOcularFormulario){
        if(numero<parseInt(indice.textContent)){
            indice.textContent=(parseInt(indice.textContent)-1).toString();
        }
    }
}

function mostrarModalEnviarDatosTestOcular(){
    if(!window.datos_test[window.tipo_test].tipo_fomrulario){
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar un nuevo test ocular?</h5><br><img src="../config/agregar_archivo.png">');
    }
    else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar este test ocular?</h5><br><img src="../config/agregar_archivo.png">');
    }
    $("#contendor_botones_modal").empty();
    $("#contendor_botones_modal").html(
        '<button type="button" class="btn btn-default boton_modal" onClick="cerrarModalFormularioEnviarDatosTestOcular()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>'
        +'<button type="button" id="guardar" class="btn btn-default boton_modal " onClick="enviarDatosTestOcular()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> ');
    $("#modalFormularioTestOcular").modal("show");
}

function cerrarModalFormularioEnviarDatosTestOcular(){
    $("#modalFormularioTestOcular").modal("hide");
}

function enviarDatosTestOcular(){
    if(!window.datos_test[window.tipo_test].tipo_fomrulario){
        
		$('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando test ...</h5><br><img src="../config/agregar_archivo.png">');
	}else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando test ...</h5><br><img src="../config/agregar_archivo.png">');
	}
    let expresion_fecha=/-/g;
    let datosFormulario=[];

    let lista_ranking=rankingOrdenTestOcular();
    console.log(lista_ranking);
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
            listIdJugadoresFueraDelRank.push(jugador.idfichaJugador);
        }
    }

    for(let idJugador of listIdJugadoresFueraDelRank){
        // alert("");
        
        lista_ranking.push({
            comentario: "",
            id: idJugador,
            rank: 0,
            velocidad:0
        });
    }

    for(let contador=0;contador<lista_ranking.length;contador++){
        if(lista_ranking[contador].velocidad===0) lista_ranking[contador].rank=0;
        lista_ranking[contador].comentario=document.getElementById("comentario_test_ocular_"+lista_ranking[contador].id).value;
    }
    console.log(lista_ranking);
    // ordenar ranking si hay ranking 0 en la primera posicion
    if(lista_ranking[0].rank===0){
        for(let contador=0;contador<lista_ranking.length;contador++){
            if(lista_ranking[contador].rank!==0){
                lista_ranking[contador].rank=lista_ranking[contador].rank-1;
            }
        }
    }

     // obteniendo datos detallados del test
    // obteniendo ids jugadores 
    for(let {id} of lista_ranking){
        datosFormulario.push({name:"array_idJugador[]",value:id});
    }
    // obteniendo rank jugadores 
    for(let {rank} of lista_ranking){
        datosFormulario.push({name:"array_ranking[]",value:rank});
    }
    // obteniendo velocidad jugadores 
    for(let {velocidad} of lista_ranking){
        datosFormulario.push({name:"array_velocidad[]",value:velocidad});
    }
    // obteniendo comentario jugadores 
    for(let {comentario} of lista_ranking){
        datosFormulario.push({name:"array_comentario[]",value:comentario});
    }
    let jugadorMejorTiempo=buscarJugadorConMejorTiempo(lista_ranking);
    let jugadorPeorTiempo=buscarJugadorConPeorTiempo(lista_ranking);
    // Obteniendo datos generales test
    datosFormulario.push({name:"tipo_formulario",value:window.datos_test[window.tipo_test].tipo_fomrulario});
    datosFormulario.push({name:"idtest_ocular",value: window.idtest_ocular});
    datosFormulario.push({name:"fecha_evaluacuion_test_ocular",value:$("#fecha_evaluacion_test_ocular").val()});
    datosFormulario.push({name:"ano_test_ocular",value:$("#fecha_evaluacion_test_ocular").val().split(expresion_fecha)[0]});
    datosFormulario.push({name:"observacion_test_ocular",value:$("#observacion_test_ocular").val()});
    datosFormulario.push({name:"nombre_usuario_software",value:window.nombre_usuario_software});
    datosFormulario.push({name:"numeros_jugadores_evaluados_test_ocular",value:lista_ranking.length});
    datosFormulario.push({name:"id_jugador_mejor_tiempo_test_ocular",value:jugadorMejorTiempo.id});
    datosFormulario.push({name:"mejor_tiempo_test_ocular",value:jugadorMejorTiempo.velocidad});
    datosFormulario.push({name:"id_jugador_peor_tiempo_test_ocular",value:jugadorPeorTiempo.id});
    datosFormulario.push({name:"peor_tiempo_test_ocular",value:jugadorPeorTiempo.velocidad});
    datosFormulario.push({name:"media_test_ocular",value:document.getElementById("promedio_test_ocular").textContent});

    console.log(datosFormulario);
    $.ajax({
            url: "post/test_guardar_test_ocular.php",
            type: "post",
            data:datosFormulario,
            success: function(respuesta) {
                var json=JSON.parse(respuesta);
                // console.log(json)
                // console.log(json);
               
                $("#modalFormularioTestOcular").modal("hide");
                $("#vista_test_formulario_ocular").hide(500);
                $("#vista_test_ocular").show(500);
                consultarTestsOculares($("#filtro_ano_test_ocular").val(),$("#filtro_mes_test_ocular").val());
                
            },error: function(){// will fire when timeout is reached
                // $('#error_conexion').show();
            }, timeout: 10000 // sets timeout to 3 seconds
        });

}

function buscarJugadorConMejorTiempo(lista_ranking){

    let jugador=null;
    for(let jugadorComparar of lista_ranking){
        if(jugadorComparar.rank!==0){
            jugador=jugadorComparar;
            break;
        }
    }
    return jugador;

}

function buscarJugadorConPeorTiempo(lista_ranking){

    let jugador=null;
    for(let contador=lista_ranking.length-1;contador!==0;contador--){
        if(lista_ranking[contador].rank!==0){
            jugador=lista_ranking[contador];
            break;
        }
    }
    return jugador;

}

function promedioTestOcularFormulario(){
    let numeroDeJugadores=window.ranking_test_ocular.length;
    let totalVelocidadJugadores=0;
    for(let jugador of window.ranking_test_ocular){
        totalVelocidadJugadores=totalVelocidadJugadores+jugador.velocidad;
    }
    return totalVelocidadJugadores/numeroDeJugadores;

}

function sumarAlRankingTestOcular($inputVelocidad){
    // calcular ranking y calcular promedio velocidad
    // let exprexion=/[0-9]||[0-9]{1,1}.[0-9]{1,1}/g;
    let expresion=/^[0-9]+([.]|[,])?([0-9]+)?$/g;
    if(expresion.test($inputVelocidad.value)){
        // alert("si")
        let id=$inputVelocidad.getAttribute("data-id-jugador");
    let exprexion=/[a-zA-z]/;
    if(window.ranking_test_ocular.length===0){
            window.ranking_test_ocular.push({
                id:$inputVelocidad.getAttribute("data-id-jugador"),
                rank:0,
                velocidad:(document.getElementById("velocidad_"+id).value!="")?parseFloat(document.getElementById("velocidad_"+id).value):0,
                comentario:""
            });
        }
        else{
            let posicion=0;
            let econtrado=false;
            for(let jugador of window.ranking_test_ocular){
                if(jugador.id===$inputVelocidad.getAttribute("data-id-jugador")){
                        window.ranking_test_ocular[posicion]={
                        id:$inputVelocidad.getAttribute("data-id-jugador"),
                        rank:0,
                        velocidad:(document.getElementById("velocidad_"+id).value!="")?parseFloat(document.getElementById("velocidad_"+id).value):0,
                        comentario:""
                    }
                    econtrado=true;
                }
                posicion++;
            }
            if(!econtrado){
                window.ranking_test_ocular.push({
                    id:$inputVelocidad.getAttribute("data-id-jugador"),
                    rank:0,
                    velocidad:(document.getElementById("velocidad_"+id).value!="")?parseFloat(document.getElementById("velocidad_"+id).value):0,
                    comentario:""
                });
            }
        }
        let estado_ranking=false;
        for(let jugador of rankingOrdenTestOcular()){
            // console.log("->>",jugador)
            if(jugador.velocidad===0){
                document.getElementById("ranking_test_ocular_formulario_"+jugador.id).textContent="-";
                estado_ranking=true;
            }
            else{
                if(estado_ranking){
                    jugador.rank=jugador.rank-1;
                    document.getElementById("ranking_test_ocular_formulario_"+jugador.id).textContent=jugador.rank.toString();
                }
                else{
                    document.getElementById("ranking_test_ocular_formulario_"+jugador.id).textContent=jugador.rank.toString();
                }
            }
        }
        // alert(promedioTestOcularFormulario().toFixed(2).toString());
        document.getElementById("promedio_test_ocular").textContent=promedioTestOcularFormulario().toFixed(2).toString();
    }
    else{
        $inputVelocidad.value="";
        let id=$inputVelocidad.getAttribute("data-id-jugador");
        let exprexion=/[a-zA-z]/;
        if(window.ranking_test_ocular.length===0){
                window.ranking_test_ocular.push({
                    id:$inputVelocidad.getAttribute("data-id-jugador"),
                    rank:0,
                    velocidad:(document.getElementById("velocidad_"+id).value!="")?parseFloat(document.getElementById("velocidad_"+id).value):0,
                    comentario:""
                });
            }
            else{
                let posicion=0;
                let econtrado=false;
                for(let jugador of window.ranking_test_ocular){
                    if(jugador.id===$inputVelocidad.getAttribute("data-id-jugador")){
                            window.ranking_test_ocular[posicion]={
                            id:$inputVelocidad.getAttribute("data-id-jugador"),
                            rank:0,
                            velocidad:(document.getElementById("velocidad_"+id).value!="")?parseFloat(document.getElementById("velocidad_"+id).value):0,
                            comentario:""
                        }
                        econtrado=true;
                    }
                    posicion++;
                }
                if(!econtrado){
                    window.ranking_test_ocular.push({
                        id:$inputVelocidad.getAttribute("data-id-jugador"),
                        rank:0,
                        velocidad:(document.getElementById("velocidad_"+id).value!="")?parseFloat(document.getElementById("velocidad_"+id).value):0,
                        comentario:""
                    });
                }
            }
            let estado_ranking=false;
            for(let jugador of rankingOrdenTestOcular()){
                // console.log("->>",jugador)
                if(jugador.velocidad===0){
                    document.getElementById("ranking_test_ocular_formulario_"+jugador.id).textContent="-";
                    estado_ranking=true;
                }
                else{
                    if(estado_ranking){
                        jugador.rank=jugador.rank-1;
                        document.getElementById("ranking_test_ocular_formulario_"+jugador.id).textContent=jugador.rank.toString();
                    }
                    else{
                        document.getElementById("ranking_test_ocular_formulario_"+jugador.id).textContent=jugador.rank.toString();
                    }
                }
            }
            // alert(promedioTestOcularFormulario().toFixed(2).toString());
            document.getElementById("promedio_test_ocular").textContent=promedioTestOcularFormulario().toFixed(2).toString();
    }
}

function rankingOrdenTestOcular(){
    // ordenar ranking de menor a mayor
    let numero_ranking=1;
    let total_jugadores=window.datos_test[window.tipo_test].jugadores_test.length;
    let lista_jugadores =window.ranking_test_ocular.slice();
    let lista_ranking=[];
    for(let contador=0;contador<window.datos_test[window.tipo_test].jugadores_test.length;contador++){
        if(lista_jugadores.length===0){
            break;
        }
        else{
            let tmp={
                id:0,
                rank:0,
                velocidad:9999999,
                comentario:""
            }
            let posicion=0;
            let posicion_eliminar=0;
            for(let jugador of lista_jugadores){
                if(jugador.velocidad<=tmp.velocidad){
                    // tmp=JSON.parse(JSON.stringify(jugador));
                    tmp=JSON.parse(JSON.stringify(jugador));
                    tmp=compararResultados(tmp,numero_ranking,lista_ranking);
                    posicion_eliminar=posicion;
                }
                posicion++;
            }
            if(tmp.rank===0){
                tmp.rank=numero_ranking;
                numero_ranking++;
            }
            lista_jugadores.splice(posicion_eliminar,1);
            lista_ranking.push(tmp);
        }
    }
    console.log("-->>>",lista_ranking);
    return lista_ranking;
}


function compararResultados(tmp,numero_ranking,lista_ranking){
    if(numero_ranking>1){
        for(let jugadoresRanking of lista_ranking){
            if(jugadoresRanking.velocidad===tmp.velocidad){
                tmp.rank=jugadoresRanking.rank;
            }
        }
    }
    else{
        return tmp;
    }
    return tmp;

}

function mostrarModalEliminarTestOcular(id){
    $("#mensaje_agregar_DescargarBoleta_inicio_test_ocular").html('<h5>¿Estás seguro que quieres eliminar este test?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    const html_botones=' <button type="button" class="btn btn-default boton_modal" data-dismiss="modal" onClick="cerrarModalEliminarTestOcular()" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>\
        <button type="button" id="eliminar_modal" class="btn btn-default boton_modal " onClick="eliminarTestOcular('+id+');" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button>';
    $("#contendor_botones_modal_inicio_test_ocular").html(html_botones);
    $("#modalInicioTestOcular").modal("show");
}

function cerrarModalEliminarTestOcular(){
    $("#modalInicioTestOcular").modal("hide");
}

function eliminarTestOcular(id){
    $.ajax({
        url: "post/test_eliminar_test_ocular.php",
        type: "post",
        data:[{name:"id",value:id}],
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            // console.log(json)
            cerrarModalEliminarTestOcular();
            consultarTestsOculares($("#filtro_ano_test_ocular").val(),$("#filtro_mes_test_ocular").val());
            
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
            // $('#error_conexion').show();
        }, timeout: 10000 // sets timeout to 3 seconds
    });

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

function obtenerPieHabil(pie){
    let pieHabil=[
        "Derecho",
        "Izquierdo",
        "Ambidiestro"
    ];

    return pieHabil[pie];
}

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

function formatoFechaDetalle(fecha){
    let lista_meses=[
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
            "Diciembre"
        ] ; 

        let dia_semana=[
            "Domingo",
            "Lunes",
            "Martes",
            "Miercoles",
            "Jueves",
            "Viernes",
            "Sabado"
        ] ; 
        let ano=fecha.split("-")[0] ; 
        let mes=fecha.split("-")[1] ; 
        let dia=fecha.split("-")[2] ; 
        let fechaDate=new Date() ; 
        fechaDate.setDate(parseInt(dia)) ; 
        fechaDate.setMonth(parseInt(mes)-1) ; 
        fechaDate.setFullYear(parseInt(ano)) ; 

        let fechaFormato=dia_semana[fechaDate.getDay()]+' '+fechaDate.getDate()+' de '+lista_meses[fechaDate.getMonth()]+' '+fechaDate.getFullYear() ; 
        return fechaFormato;
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

</script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script>
// scripts 
    mostrar_al_cargar_pagina();
    cargarVentanaInicioTest();
    // ===================================================


function insertarDatosGraficoBar(test){
    // Create the chart
    let datosGrafico=[];
    for(let detalle of test.detalles_test_ocular){
        if(detalle.ranking_detalle_test_ocular!=="0"){
                let jugador=detalle.jugador_info;
            let nombreJugador=jugador.nombre+" "+jugador.apellido1+" "+jugador.apellido2;
           

            datosGrafico.push({
                name: nombreJugador,
                y: parseFloat(detalle.velocidad_detalle_test_ocular),
                drilldown: nombreJugador
            })
        }
    }

    Highcharts.chart('container', {
    chart: {
        type: 'bar'
    },
    title: {
        text: 'EVALUACIÓN DE LOS JUGADORES'
    },
    subtitle: {
        text: 'TEST DE VELOCIDAD'
    },
    accessibility: {
        announceNewData: {
        enabled: true
        }
    },
    xAxis: {
        type: 'category'
    },
    yAxis: {
        title: {
        text: 'TEST DE VELOCIDAD seg.'
        }

    },
    legend: {
        enabled: false
    },
    plotOptions: {
        series: {
        borderWidth: 0,
        dataLabels: {
            enabled: true,
            format: '{point.y:.1f} seg.'
        }
        }
    },
    credits: {
        enabled: false
    },

    tooltip: {
        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f} seg.</b> <br/>'
    },

    series: [
        {
        name: "Jugadores",
        colorByPoint: true,
        data: datosGrafico
        //   [
        //     {
        //       name: "Chrome",
        //       y: 62.74,
        //       drilldown: "Chrome"
        //     },
        //     {
        //       name: "Firefox",
        //       y: 10.57,
        //       drilldown: "Firefox"
        //     },
        //     {
        //       name: "Internet Explorer",
        //       y: 7.23,
        //       drilldown: "Internet Explorer"
        //     },
        //     {
        //       name: "Safari",
        //       y: 5.58,
        //       drilldown: "Safari"
        //     },
        //     {
        //       name: "Edge",
        //       y: 4.02,
        //       drilldown: "Edge"
        //     },
        //     {
        //       name: "Opera",
        //       y: 1.92,
        //       drilldown: "Opera"
        //     },
        //     {
        //       name: "Other",
        //       y: 7.62,
        //       drilldown: null
        //     }
        //   ]
        }
    ]
    });
}
</script>
