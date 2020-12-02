<?PHP
include('../config/datos.php');
session_start();
if(!(isset($_SESSION["nombre_usuario_software"]))){
    session_destroy();
    header('Location: ../index.php?cerrar_sesion=1');
}
else{
    $menu_actual="evaluacion";
    $submenu_actual="evaluacion_concepto";
    $seccion_comentarios = $comentarios['evaluacion_concepto'];//mis cuotas
    $demo_seccion = $demo['evaluacion_concepto'];
    $nombre_pestana_navegador='Evaluación';

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
        <title><?php echo $nombre_pestana_navegador;?> | Concepto</title>

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

            .boton_evaluacion_contepto{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 3px solid #555; 
                color: #555;
                border-radius:5px;
            }
            .boton_evaluacion_contepto:hover{
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
                border: 1px solid #229cf5; 
                color: #229cf5;
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
                border: 3px solid #249bf3; 
                color: #249bf3;
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
        .boton_evaluacion_contepto{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 3px solid #555555; 
                color: #555555;
                border-radius:5px;
            }
            .boton_evaluacion_contepto:hover{
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
        .boton_evaluacion_contepto:disabled{
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
        /*------------------------------------*/
        .textarea-text-align-left{
            text-align:left!important;
            white-space: normal!important;
        }
        /* estilo radio checkbox */
        /* input[name="array_examen_solicitado[]"] {
            border: 1px solid #343434;
            padding: 0.5em;
            -webkit-appearance: none;
            height: 16px;
            border-radius: 0;
        }

        input[name="array_examen_solicitado[]"]:checked {
        background: black;
        background-size: 9px 9px;
        }

        input[name="array_examen_solicitado[]"]:focus {
        outline-color: blue;
        }

        .label-radio {
            display: inline-block;
            font-size: 11px;
            position: relative;
            top: 3px;
            color: #373737;
            margin-left: 6px;
            margin-right: 13px;
            font-weight: bold;
        }
        .radio-button {
            margin:10px;
        }

        .radio-button {
            font-size: 11px!important;
        }


        .radio-button {
            display:inline-block;
            font-weight: bold;
            background-color: #f44336;
            border-radius: 5px;
            padding: 5px;
            color: white;
            text-transform: uppercase;
            text-align: center;
            width: 100%;
            /*margin-right: 13px;
            } 
            */   

        .radio-button:checked { 
            border: solid 3px #3e3e3e;
        } */
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
                    </style>
                    <style>
                        .contenedor_jugador{
                            box-sizing:border-box;
                            border:0;
                            width:96%;
                            height:60px;
                            padding-top: 5px;
                            padding-bottom: 5px;
                            margin-left: auto;
                            margin-right: auto;
                            /* margin-bottom: 10px; */
                        }
                        .contenedor_jugador:hover{
                            background-color: #ffbb00;
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
        <div id="content" style="height: 1093px;">
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
            <div  style="display:none;" id="pagina" style="padding:0px;height: 696px;">
                <?php if(($software_demo && $demo_seccion) || !$software_demo){?>
                    <!-- #303030 -->
                    <!-- #25282a -->
                    <!-- #39b682 -->
                    <!-- #ff5b4d -->
                    <!-- #404040 -->
                    <!-- #a2a2a2 -->
                    <div style="box-sizing:border-box;border:0;width:45%;height:80px;margin-left:auto;margin-right:auto;margin-bottom:15px;">
                    
                        <div style="box-sizing:border-box;border:0;width:17%;height:80px;float:left;">

                            <img style="box-sizing:border-box;border:0;width:100%;height:100%;" src="../config/logo_equipo.png" alt="logo_equipo">
                        
                        </div>
                        <div style="box-sizing:border-box;border:0;width:83%;height:80px;float:left;text-align: center;line-height: 80px;font-size: 1.5em;font-weight: bold;color: #000;">

                            MÓDULO CONCEPTOS EVALUACIÓN
                        
                        </div>
                    </div>

                    <div style="box-sizing:border-box;border:0;width:95%;height:15px;margin-left:auto;margin-right:auto;margin-bottom:50px;background-color:<?php echo $color_fondo; ?>;"></div>
                    <center>
                        <div style="margin:0px; height:20px;"><img src="img/cargando_buscar.gif" id="cargando_buscar" style=" display:none;">
                            <span style="color:#dc4e4e; display:none;" id="error_conexion"><b>Error:</b> conexión a internet deficiente.</span>
                            <span style="color:#28b779; display:none;" id="sin_resultados">Busqueda sin resultados.</span>
                        </div>
                    </center>
                    <div style="box-sizing:border-box;border:0;width:109px;margin-left:auto;margin-right:25px;margin-bottom:15px;">
                        <button class="boton_evaluacion_contepto" id="boton_agregar_concepto" onClick="AbrirModalFormulario()"><b style="font-size:10px;"><i class="icon-plus"></i> Agregar informe</b></button>
                    </div>
                     <!--    MODAL INICIO  -->
                     <div id="modalEvaluacionConcepto" class="modal hide" style="border-radius:10px;">
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
                        <!--    MODAL FIN     -->

                        


                     <!-- MODAL FORMULARIO INICIO  -->
                     <div id="modalFormulario" class="modal hide contenedor_modal_formulario" >
                     
                        <div style="box-sizing:border-box;border:0;width:25%;height:100%;float:left;padding-top:35px;">
                            <img style="box-sizing:border-box;border:0;width:100%;height:80%;margin-top:auto;" src="../config/logo_equipo.png">
                        </div>
                        <div style="box-sizing:border-box;border:0;width:75%;height:100%;float:left;padding-top:35px;">

                            <div style="box-sizing:border-box;border:0;width:100%;margin-bottom:50px;padding-left: 135px;font-size: 1.5em;font-weight: bold;color: #000;">
                                CREAR CONCEPTOS DE EVALUACIÓN
                            </div>

                            <form id="formulario" style="box-sizing:border-box;border:0;display:inline-flex;flex-direction:row;flex-wrap:wrap;justify-content: space-evenly;align-items: center;width:95%;height:70px;margin-left:auto;margin-right:auto;border-radius:2px;border:2px solid #d2d2d2;margin-bottom:40px;">
                                
                                <div style="box-sizing:border-box;border:0;width:35%;height:60px">
                                    <div style="font-weight: bold;color: #000;font-size: 10px;">CONCEPTO</div>
                                    <input  style="box-sizing:border-box;border:0;width:100%;height:30px;border-radius:2px;border:2px solid #d2d2d2;margin-bottom:0;" type="text" name="evaluacion_concepto" id="evaluacion_concepto"  onChange="validarFormulario()"/>
                                </div>
                                <div style="box-sizing:border-box;border:0;width:20%;height:60px;">
                                    <div style="font-weight: bold;color: #000;font-size: 10px;">INCLUIR EN EVALUACIÓN</div>
                                    <select style="box-sizing:border-box;border:0;width:100%;height:30px;border-radius:2px;border:2px solid #d2d2d2;margin-bottom:0;" name="evaluacion" id="evaluacion" onChange="validarFormulario()">
                                        <option value="0">Tecnica</option>
                                        <option value="1">Tactica</option>
                                        <option value="2">Otro conceptos</option>
                                    </select>
                                </div>
                                <div style="box-sizing:border-box;border:0;width:20%;height:60px;">
                                    <div style="font-weight: bold;color: #000;font-size: 10px;">POSICIONES</div>
                                    <select style="box-sizing:border-box;border:0;width:100%;height:30px;border-radius:2px;border:2px solid #d2d2d2;margin-bottom:0;" name="posicion_evaluacion_concepto" id="posicion_evaluacion_concepto" onChange="validarFormulario()">
                                        <option value="1">Arquero</option>
                                        <option value="2">Defensor Central</option>
                                        <option value="3">Lateral Izquierdo</option>
                                        <option value="4">Lateral Derecho</option>
                                        <option value="5">Volante Defensivo</option>
                                        <option value="6">Volante Izquierdo</option>
                                        <option value="7">Volante Derecho</option>
                                        <option value="8">Volante Mixto</option>
                                        <option value="9">Volante Ofensivo</option>
                                        <option value="10">Extremo Izquierdo</option>
                                        <option value="11">Extremo Derecho</option>
                                        <option value="12">Centro Delantero</option>
                                    </select>
                                </div>
                                <div style="box-sizing:border-box;border:0;width:20%;height:60px;">
                                    <div style="font-weight: bold;color: #000;font-size: 10px;">ESTADO</div>
                                    <select style="box-sizing:border-box;border:0;width:100%;height:30px;border-radius:2px;border:2px solid #d2d2d2;margin-bottom:0;" name="estado_evaluacion_concepto" id="estado_evaluacion_concepto" onChange="validarFormulario()">
                                        <option value="1">Activo</option>
                                        <option value="0">Inactivo</option>
                                    </select>
                                </div>

                        
                            </form>

                            <div style="box-sizing:border-box;border:0;width: 140px;margin-left: 215px;margin-right:auto;">
                                    <button type="button" ng-disabled="" class="boton_guardar_informe" onClick="mostrarModalEnviarDatos();" id="boton_agregar_infrome"><i class="icon-save"></i> GUARDAR INFORME</button>
                            </div>
                            
                        </div>
                        
                        
                    
                    </div>
                    <!-- MODAL FORMULARIO FIN  -->
                    <form id="filtros">

                    <div style="width:25%;margin-left:auto;margin-right:auto;display:flex;margin-bottom:50px">
                                <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#404040;border:2px solid #8a8a8a;height: 18.5px;"><div><p class="ellipsis-text" style="font-weight: bold;">Posición</p></div></a>
                                <div class="btn-group c_objetivo_fisico " style="width: 50%;">
                                    <button id="boton_posicion_jugador_filtro" type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border:2px solid #8a8a8a; background-color: #fff;">
                                        <p class="titulo_multi ellipsis-text">
                                            <span id="texto_boton_posicion_jugador_filtro">Seleccione una posición</span>
                                        </p> 
                                        <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span>
                                    </button>
                                        <ul id="posicion_jugador_filtro" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                                </div>                    
                    </div> 

                    </form>
                    <table style="border: 0px solid #8f8f8f; width:95%;margin-left:auto;margin-right:auto;" id="tabla_ver_informes">
                        <thead>
                            <tr style="background-color:#555; color:white;">
                                <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px;font-size: 10px;width: 20px;"><center>#</center></th>
                                <th scope="col" style="cursor:pointer; padding:0px;width: 89px;">
                                <div class="tip-top" data-original-title="" style="text-align: left;font-size: 10px;">ÁREA</div>
                                </th>
                                <th scope="col" style="cursor:pointer; padding:0px;width: 135px;">
                                <div class="tip-top" data-original-title="" style="text-align:left;font-size: 10px;">CONCEPTO</div>
                                </th>
                                <th scope="col" style="cursor:pointer; padding:0px;width: 135px;">
                                <div class="tip-top" data-original-title="" style="text-align:left;font-size: 10px;">POSICIÓN</div>
                                </th>
                                <th scope="col" style="cursor:pointer; padding:0px;width: 407px;">
                                <div class="tip-top" data-original-title="" style="width:150px;text-align:left;font-size: 10px;">ESTADO</div>
                                </th>
                                <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:0px; width:30px;"></th>
                                <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:5px; width:30px;"></th>
                            </tr>
                        </thead>
                        <tbody id="contenido_tabla">
                            <!--  AQUI SE INSERTARAN CON JAVASCRIPT -->
                            <!-- <tr class="panel_buscar" style='cursor:pointer; color:#404040; font-size:12px;'>
                                <td style="width: 20px;text-align:center;">1</td>
                                <td style="padding:0;width: 89px;font-weight: bold;">Técnica</td>
                                <td style="padding:0;width: 135px;">Control y pase</td>
                                <td style="padding:0;width: 407px;">ACTIVO</td>
                                <td style='padding:2px;'>
                                    <center >
                                        <a class='boton_editar'   onClick=''>
                                            <i class='icon-pencil'></i>
                                        </a>
                                    </center>
                                </td>
                                <td style='padding:2px;'>
                                    <center>
                                        <a class='boton_eliminar' onClick=''>
                                            <i class="icon-remove"></i>
                                        </a>
                                    </center>
                                </td>
                            </tr> -->
                            <!-- <tr class="sin_fondo" ><td colspan="6" ><center><h5 style="color:#555555;margin-top:10px;margin-bottom:10px;"><i class="icon-file-alt"></i> Sin conceptos</h5></center></td></tr> -->
                        </tbody>
                        <tfoot>
                            <tr style="background-color:#555555; color:white;">
                                <th scope="col" style="border-bottom-left-radius:5px; padding-top:5px; padding-bottom:5px;"></th>
                                <th scope="col" style="cursor:pointer;  padding:15px;"></th> 
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
                    
                <?php } ?>
            </div>
        </div>
    </body>
</html>
<!-- variables globales -->
<script>

var tipo_formulario=false;

var nombre_usuario_software='<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>';

var lista_de_concepto=[];

var id_concepto="";

var lista_posiciones_glovales=[
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

var lista_posiciones_glovales_2=[
    {numero_posicion:0,posicion:"Todos"},
    {numero_posicion:1,posicion:"Arquero"},
    {numero_posicion:2,posicion:"Defensor Central"},
    {numero_posicion:3,posicion:"Lateral Izquierdo"},
    {numero_posicion:4,posicion:"Lateral Derecho"},
    {numero_posicion:5,posicion:"Volante Defensivo"},
    {numero_posicion:6,posicion:"Volante Izquierdo"},
    {numero_posicion:7,posicion:"Volante Derecho"},
    {numero_posicion:8,posicion:"Volante Mixto"},
    {numero_posicion:9,posicion:"Volante Ofensivo"},
    {numero_posicion:10,posicion:"Extremo Izquierdo"},
    {numero_posicion:11,posicion:"Extremo Derecho"},
    {numero_posicion:12,posicion:"Centro Delantero"}
];


</script>
<script>

function buscar(){
    let filtros=$("#filtros").serializeArray();
    window.lista_de_concepto=[];
    $("#contenido_tabla").empty();
    $('#sin_resultados').hide();
    if(filtros.length>0){
        $.ajax({
            url: "post/evaluacion_concepto_consultar_por_filtro.php",
            type: "post",
            data:filtros,
            success: function(respuesta) {
                var json=JSON.parse(respuesta);
                // console.log(json)
                console.log(json.datos);
                for(let concepto of json.datos){
                    window.lista_de_concepto.push(concepto);
                }
                mostarDatosTabla();
            },error: function(){// will fire when timeout is reached
                // alert("errorXXXXX");
                $('#error_conexion').show();
            }, timeout: 10000 // sets timeout to 3 seconds
        });
    }
    else{
        listarTodosLosConceptos();
    }
}

function volver(){
    $("#modalEvaluacionConcepto").modal("hide");
    listarTodosLosConceptos();
    limpiarFormulario();
}

function AbrirModalFormulario(){
    limpiarFormulario();
    validarFormulario();
    window.id_concepto="";
    window.tipo_formulario=false;
    $("#modalFormulario").modal("show");
}

function AbrirModalFormularioModoEditar(index){
    let concepto=window.lista_de_concepto[index];
    window.id_concepto=concepto.idevaluacion_concepto;
    limpiarFormulario();
    insertarDatosFormulario(concepto);
    validarFormulario();
    window.tipo_formulario=true;
    $("#modalFormulario").modal("show");
}

function limpiarFormulario(){
    $("#evaluacion_concepto").val("");
    $("#evaluacion").val("0");
    $("#posicion_evaluacion_concepto").val("1");
    $("#estado_evaluacion_concepto").val("1");
}

function insertarDatosFormulario(concepto){
    $("#evaluacion_concepto").val(concepto.evaluacion_concepto);
    $("#evaluacion").val(concepto.evaluacion);
    $("#posicion_evaluacion_concepto").val(concepto.posicion_evaluacion_concepto);
    $("#estado_evaluacion_concepto").val(concepto.estado_evaluacion_concepto);
}

function validarFormulario(){
    let concepto=$("#evaluacion_concepto").val();
    let estado_concepto=false;
    if(concepto!=""){
        estado_concepto=true;
    }
    if(estado_concepto){
        // alert("hola")
        $("#boton_agregar_infrome").prop("disabled",false);
    }
    else{
        $("#boton_agregar_infrome").prop("disabled",true);
    }
    // disabled
}

function mostrarModalEnviarDatos(){
    $("#modalFormulario").modal("hide");
    if(!window.tipo_formulario){;
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar un nuevo concepto?</h5><br><img src="../config/agregar_archivo.png">');
    }
    else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar este concepto?</h5><br><img src="../config/agregar_archivo.png">');
    }
    $("#contendor_botones_modal").empty();
    $("#contendor_botones_modal").html(
        '<button type="button" class="btn btn-default boton_modal" onClick="cerrarModalFormularioEnviarDatos()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>'
        +'<button type="button" id="guardar" class="btn btn-default boton_modal " onClick="enviarDatos()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> ');
    $("#modalEvaluacionConcepto").modal("show");
}

function cerrarModalFormularioEnviarDatos(){
    $("#modalEvaluacionConcepto").modal("hide");
    $("#modalFormulario").modal("show");
}

function enviarDatos(){
    // alert("enviando datos")
    if(!window.tipo_formulario){
		$('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando concepto ...</h5><br><img src="../config/agregar_archivo.png">');
	}else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando concepto ...</h5><br><img src="../config/agregar_archivo.png">');
	}

    let formulario=$("#formulario").serializeArray();
    formulario.push({name:"tipo_formulario",value:window.tipo_formulario});
    formulario.push({name:"nombre_usuario_software",value:window.nombre_usuario_software});
    formulario.push({name:"idevaluacion_concepto",value:window.id_concepto});
    // console.log(formulario)


    $.ajax({
        url: "post/evaluacion_concepto_guardar.php",
        type: "post",
        data:formulario,
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            // console.log(json)
            volver()
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
        }, timeout: 10000 // sets timeout to 3 seconds
    });

}



function  listarTodosLosConceptos(){
    window.lista_de_concepto=[];
    $("#contenido_tabla").empty();
    $('#sin_resultados').hide();
    $.ajax({
        url: "post/evaluacion_concepto_consultar_todos_los_conceptos.php",
        type: "post",
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            // console.log(json)
            for(let concepto of json.datos){
                window.lista_de_concepto.push(concepto);
            }
            // console.log(window.lista_de_concepto)
            mostarDatosTabla();
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
            $('#error_conexion').show();
            
        }, timeout: 10000 // sets timeout to 3 seconds
    });
}

function mostarDatosTabla(){
    let numero=0;
    let fila_sin_registros='<tr class="sin_fondo" ><td colspan="6" ><center><h5 style="color:#555555;margin-top:10px;margin-bottom:10px;"><i class="icon-file-alt"></i> Sin conceptos</h5></center></td></tr>';
    let filas_tabla=window.lista_de_concepto.map(concepto => {
        
        let area="sin area";
        if(concepto.evaluacion==="0"){
            area="Tecnica";
        }
        else if(concepto.evaluacion==="1"){
            area="Tactica";
        }
        else if(concepto.evaluacion==="2"){
            area="Otro conceptos";
        }
        let color_letra_estado="#000";
        let estado="";
        if(concepto.estado_evaluacion_concepto==="1"){
            color_letra_estado="green";
            estado="ACTIVO";
        }
        else{
            color_letra_estado="#ff5b4d";
            estado="INACTIVO";
        }
        let fila='\
        <tr class="panel_buscar" style="cursor:pointer; color:#404040; font-size:12px;">\
            <td style="width: 20px;text-align:center;">'+(numero+1)+'</td>\
            <td style="padding:0;width: 89px;font-weight: bold;">'+area+'</td>\
            <td style="padding:0;width: 135px;">'+concepto.evaluacion_concepto+'</td>\
            <td style="padding:0;width: 135px;">'+lista_posiciones_glovales[parseInt(concepto.posicion_evaluacion_concepto)-1]+'</td>\
            <td style="padding:0;width: 407px;font-weight: bold;color:'+color_letra_estado+';">'+estado+'</td>\
            <td style="padding:2px;">\
                <center >\
                    <a class="boton_editar"   onClick="AbrirModalFormularioModoEditar('+numero+')">\
                        <i class="icon-pencil"></i>\
                    </a>\
                </center>\
            </td>\
            <td style="padding:2px;">\
                <center>\
                    <a class="boton_eliminar" onClick="mostrarModalEliminarConcepto('+numero+')">\
                        <i class="icon-remove"></i>\
                    </a>\
                </center>\
            </td>\
        </tr>';
        numero++;
        return fila;
    })
    if(filas_tabla.length>0){
        filas_tabla.map(fila => {
            $("#contenido_tabla").append(fila);
        })
        
    }
    else{
        $('#sin_resultados').show();
        $('#error_conexion').hide();
        $("#contenido_tabla").html(fila_sin_registros);
    }
}

function mostrarModalEliminarConcepto(index){
    $("#mensaje_agregar_DescargarBoleta").html('<h5>¿Estás seguro que quieres eliminar este concepto?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    const html_botones=' <button type="button" class="btn btn-default boton_modal" data-dismiss="modal" onClick="cerrarModalEliminarConcepto()" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>\
        <button type="button" id="eliminar_modal" class="btn btn-default boton_modal " onClick="eliminarConcepto('+index+');" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button>';
    $("#contendor_botones_modal").html(html_botones);
    $("#modalEvaluacionConcepto").modal("show");
}

function cerrarModalEliminarConcepto(){
    $("#modalEvaluacionConcepto").modal("hide");
}

function eliminarConcepto(index){
    let concepto=window.lista_de_concepto[index];
    console.log(concepto);
    $.ajax({
        url: 'post/evaluacion_concepto_eliminar.php',
        type: "post",
        data:[{name:"id",value:concepto.idevaluacion_concepto}],
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            console.log(json);
            listarTodosLosConceptos();
            cerrarModalEliminarConcepto();
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
        }, timeout: 10000 // sets timeout to 3 seconds
    });

}

function seleccionarTodasLasPosicones(){

    if($("#checkbox_filtro_posicon_evaluacion_concepto_0").prop("checked")){
        for(let posicion of window.lista_posiciones_glovales_2){
            $("#checkbox_filtro_posicon_evaluacion_concepto_"+posicion.numero_posicion).prop("checked",true);
        }
        $("#texto_boton_posicion_jugador_filtro").text("Todos");
    }
    else{
        for(let posicion of window.lista_posiciones_glovales_2){
            $("#checkbox_filtro_posicon_evaluacion_concepto_"+posicion.numero_posicion).prop("checked",false);
        }
        $("#texto_boton_posicion_jugador_filtro").text("Seleccione una posición");
        // listarTodosLosConceptos()
    }
    buscar();
}

</script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script>
    listarTodosLosConceptos();
    mostrar_al_cargar_pagina();
    $(document).on('click', '.option', function(e) { //
        e.stopPropagation();
    });
    $('.c_objetivo_fisico li').click(function (e) { e.stopPropagation(); });

    function contarPosiciones(){
        let array_checkbox_posiciones = $('input[name="array_checkbox_filtro_posicon_evaluacion_concepto[]"]:checked').map(function(){ 
            return this.value; 
        }).get();
        // alert("hola")
        // alert(array_checkbox_posiciones)

        if(array_checkbox_posiciones.length==1){
            const posicion_jugador=window.lista_posiciones_glovales_2.filter((posicion)=>{
                if(posicion.numero_posicion===parseInt(array_checkbox_posiciones[0])){
                    return posicion;
                }
            })
            // alert(posicion_jugador[0].posicion)
            $("#texto_boton_posicion_jugador_filtro").text(posicion_jugador[0].posicion);
        }
        else if(array_checkbox_posiciones.length>0){
            if(array_checkbox_posiciones.length<=window.lista_posiciones_glovales_2.length-1){
                if(array_checkbox_posiciones.length==window.lista_posiciones_glovales_2.length-1 && !$("#checkbox_filtro_posicon_evaluacion_concepto_0").prop("checked")){
                    $("#checkbox_filtro_posicon_evaluacion_concepto_0").prop("checked",true);
                    $("#texto_boton_posicion_jugador_filtro").text("Todos");
                }
                else{
                    if($("#checkbox_filtro_posicon_evaluacion_concepto_0").prop("checked")){
                        $("#checkbox_filtro_posicon_evaluacion_concepto_0").prop("checked",false);
                        // array_checkbox_posiciones.shift();
                    }
                    $("#texto_boton_posicion_jugador_filtro").text(array_checkbox_posiciones.length+" Elementos Selecionados");
                }
            }
        }
        else{
            // alert("hola")
            $("#texto_boton_posicion_jugador_filtro").text("Seleccione una posición");
        }
        buscar();

    }


    $("#boton_posicion_jugador_filtro").on("click",()=>{

        const lis=window.lista_posiciones_glovales_2.map((posicion)=>{
            if(posicion.numero_posicion!=0){
                return '<li ><label class="option"><span class="label_s" style="font-size:13px;">'+posicion.posicion+'</span> <input type="checkbox" id="checkbox_filtro_posicon_evaluacion_concepto_'+posicion.numero_posicion+'" name="array_checkbox_filtro_posicon_evaluacion_concepto[]" value="'+posicion.numero_posicion+'" data-eliminar="0" onclick="contarPosiciones()" ></label></li>';
            }
            else{
                return '<li ><label class="option"><span class="label_s" style="font-size:13px;">'+posicion.posicion+'</span> <input type="checkbox" id="checkbox_filtro_posicon_evaluacion_concepto_'+posicion.numero_posicion+'" value="'+posicion.numero_posicion+'" data-eliminar="0" onclick="seleccionarTodasLasPosicones()" ></label></li>';
            }
        })
        if($("#posicion_jugador_filtro").html()!=""){
            console.log("no esta basio");
        }
        else{
            console.log("esta basio");
            lis.map((lista)=>{
                $("#posicion_jugador_filtro").html($("#posicion_jugador_filtro").html()+lista);
            });
        }
    });

</script>
