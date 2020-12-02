<?PHP
include('../config/datos.php');
session_start();
if(!(isset($_SESSION["nombre_usuario_software"]))){
    session_destroy();
    header('Location: ../index.php?cerrar_sesion=1');
}
else{
    $menu_actual="seguro_medico";
    $submenu_actual="seguimiento";
    $seccion_comentarios = $comentarios['seguimiento'];//mis cuotas
    $demo_seccion = $demo['seguimiento'];
    $nombre_pestana_navegador='Seguro Médico';

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
        <title><?php echo $nombre_pestana_navegador;?> | Seguimiento</title>

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
                border: 3px solid #555; 
                color: #555;
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
        <style>
            .tarjeta{
                width: 20%;
                height: 290px;
                /* max-height: 250px; */
                background:#fff;
                display: inline-block;
                /* margin-right: 1%; */
            }
            .tarjeta_cuerpo_leciones{
                width: 32%;
                height: 290px;
                /* max-height: 250px; */
                background:#fff;
                display: inline-block;
                /* margin-right: 1%; */
            }
            .cabezera_tarjeta_roja{
                background-color: #df4f4f;
            }
            .cabezera_tarjeta_gris{
                background-color: #404040;
            }
            .cabezera_tarjeta{
                width: 100%;
                height: 35px;
                display: block;
                color:#fff;
                text-align: center;
                padding-top: 7px;   
                font-size: 12px;
                box-sizing: border-box;
                border-radius: 5px;
            }
            .cuerpo_tarjerta{
                width: 100%;
                height: 86%;
                background: #fff;
                display: block;
            }
        </style>
        <style type="text/css">
            path {
                stroke-width: 2px;
            }
            .frt{
                fill: rgb(255, 0, 0);
                fill-opacity: 0;
            }
            .frt:hover{
                fill: rgb(255, 0, 0);
                fill-opacity: 0.2;
            }
            .bck{
                fill: rgb(255, 0, 0);
                fill-opacity: 0;
            }
            .bck:hover{
                fill: rgb(255, 0, 0);
                fill-opacity: 0.2;
            }
        </style>
        <style>/* estilo modal jugador*/
                        .contenedor_modal_jugador{
                            width: 80%;
                            height: 80%;
                            left: 0%;
                            background-color: #fff;
                            margin-left: 10%;
                            margin-right: 10%;
                            border-radius: 0px;
                            box-sizing: border-box;
                            overflow: scroll;
                            overflow-x: none;
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
                            <i class="icon-truck"></i> Seguro médico
                        </a> 
                        <a class="current">
                            Seguimiento
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
            <div  style="display:none;" id="pagina" style="padding:0px;height: 601px;">
                <?php if(($software_demo && $demo_seccion) || !$software_demo){?>
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
                    <!--------------------------------  MODAL VER JUGADOR INICIO-------------------------------------------->
                    <div id="modalVerJugador" class="modal hide contenedor_modal_jugador" >
                        <div class="contenedor_foto_jugador" id="contenedor_foto_jugador">
                            <!-- <img src="" alt=""> -->
                        </div>
                                <div class="modal-header encabezado_modal" style="background-color: #5fbfe4;">
                                    <div style="float:left;width:120px;height: 100%;color:#fff;box-sizing: border-box;padding-top: 19px;font-weight: bold">CASO N° <span style="font-weight: bold" id="numero_caso_encabezado"></span></div>
                                    <div style="float:right;width:134px;height: 100%;display:flex;flex-direction:row;">
                                        <div style="width:50px;margin-right: 10px;height: 100%;box-sizing: border-box;">
                                            <img style="width:100%;height: 100%;box-sizing: border-box;" src="../config/logo_equipo.png" >
                                        </div>
                                        <div style="width:40px;box-sizing: border-box;color:#fff;font-weight: bold;">
                                            <div>SEGURO</div>
                                            <div>MÉDICO</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="contenedor_nombre_jugador">
                                    <div class="caja_nombre_jugador" id="caja_nombre_jugador">
                                        <span class="nombre_jugador" id="nombre_jugador"></span>
                                        <span class="serie_jugador_modal" id="serie_jugador_modal"></span>
                                    </div>
                                </div>
                                <hr>
                                <span style="width:50%;text-align:center;margin-left: 25%;margin-right: 25%;display:block;margin-bottom: 10px;font-weight: bold;color:#464646">DETALLE DE LA ATENCIÓN</span>
                                <div style="margin-bottom:20px;" class="tabla_detalle_atencion_seguimiento" id="tabla_detalle_atencion_seguimiento"></div>
                                <div style="width:100%;box-sizing: border-box;">
                                    <div style="width:259px;float:right;box-sizing: border-box;display:flex;flex-direction:row;">
                                            <div style="width: 23px;height: 29px;margin-right: 10px;">
                                                <img style="width:100%;height: 100%;box-sizing: border-box;" src="../config/logo_equipo.png" >
                                            </div>
                                            <div style="width:225px;padding-top: 5px;">ÁREA MÉDICA OHIGGINS DE RANCAGUA</div>
                                            
                                    </div>
                                </div>
                            </div>
<!--------------------------------  MODAL INFORME VER JUGADOR FIN-------------------------------------------->
                    <div id="modalEliminarSeguimiento" class="modal hide" style="border-radius:10px;">
                        <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
                        </div>
                        <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
                        <center>
                                <br>
                                <div id="mensaje_eliminar_seguimiento">
                                <h5><!--mensaje modal --></h5>
                                </div>
                                <br>
                        </center>
                        </div>
                        <div class="modal-footer" style="background-color: <?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
                            
                            <center>
                                <div id="contendor_botones_modal_eliminar_atencion_diaria">
                                    <!-- boton dinamicos -->
                                </div>
                            </center>
                            
                        </div>
                    </div>
                <div style="margin-top: 0px; margin-bottom: 60px;">
                    <div class="row-fluid" id="component_seguimiento_inicio" style="padding-left: 20px;padding-right: 21px;box-sizing: border-box;">
                        <div id="cuadro_listado_atencion_diaria" class="row-fluid" style="margin-top: -10px; color: black; font-family: Arial, Helvetica, sans-serif;">
                            <table style="color:black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
                                <tr class="sin_fondo" >
                                    <td style="padding:12px; padding-top:15px;"><img src="../config/logo_equipo.png" style="height: 100px; margin-top:5px;"></td>
                                    <td>
                                        <center>
                                            <h3 class="titulo_principal" style="color:#595959;margin-bottom: 0px;">Seguro Médico</h3>
                                            <div style="width:auto;margin: 0px;font-weight: bold;border-top:2px solid #404040;border-bottom:2px solid #404040;color: #595959;">Seguimiento</div>
                                            <!-- <p ></p> -->
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
                                <div style="/*background-color: lightblue;*/ width: 90%; margin: auto;display: flex;flex-direction:row;flex-wrap:wrap;justify-content:center;">
                                    <div class="span3" style="display: flex">
                                        <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Fecha inicio</p>
                                            </div>
                                        </a>
                                        <input type="text" readonly  style="width:50%; height: 17.5px;background:#fff;" class="grey-input date_fechaNacimiento fecha_inicio" id="fecha_inicio" name="fecha_inicio" onchange="buscarSeguimientos()" />                   
                                    </div>
                                    <div class="span3" style="display: flex;">
                                                <a class="btn btn-md btn-primary green-a" style="width: 50%; height: 20px;background:#404040">
                                                    <div>
                                                        <p class="ellipsis-text" style="font-weight: normal;">Fecha fin</p>
                                                    </div>
                                                </a>
                                        <input type="text" readonly  style="width: 50%; height: 17.5px;background:#fff;" class="grey-input date_fechaNacimiento  fecha_final" id="fecha_final" name="fecha_final" onchange="buscarSeguimientos()" />
                                    </div> 
                                    <div class="span3" style="display: flex">
                                            <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040">
                                                <div>
                                                    <p class="ellipsis-text" style="font-weight: normal;">Serie</p>
                                                </div>
                                            </a>
                                            <select style="width:50%; height: 29.5px;background:#fff;border:2px solid" class="" id="serie_filtro" name="serie_filtro" onchange="consultarJugadoreXSeriesFiltro(this.value)">
                                            </select>
                                            <!-- <input type="text" readonly  style="width:50%; height: 18px;background:#fff;" class="grey-input date_fechaNacimiento fecha_inicio" id="fecha_atencion" name="fecha_atencion" onchange="" />                    -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <form id="formulario_filtro_jugadores" style="width:100%;display: flex;flex-direction:row;flex-wrap:wrap;justify-content:center;">

                                <div style="width:30%;display: flex">
                                                <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#404040"><div><p class="ellipsis-text" style="font-weight: normal;">Jugador</p></div></a>
                                                <div class="btn-group c_objetivo_fisico " style="width: 50%;">
                                                    <button id="boton_jugador" type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #404040; background-color: #fff;">
                                                        <p class="titulo_multi ellipsis-text">
                                                            <span id="texto_boton_filtro_jugador">Seleccione a un jugador</span>
                                                        </p> 
                                                        <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span>
                                                </button>
                                            <ul id="jugador_filtro" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                                        </div>                    
                                </div> 
                            </form>
                        <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:30px;">
                            <div class="row-fluid" style="margin-top:0px;">
                                <button style="margin-bottom:10px; margin-top: 0px; float:right;" class="boton_informe_semanal" id="boton_agregar_informe" onClick="mostrarModalFormulario()"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar informe</b></button>
<!--  AQUI SE INSERTARAN CON JAVASCRIPT -->
                                            <!-- <tr class="sin_fondo" ><td colspan="14" ><center><h5 style="color:#555555;margin-top:10px;margin-bottom:10px;"><i class="icon-file-alt"></i> Sin atenciones diarias</h5></center></td></tr> -->
                                <div class="span12" style="margin: 0px;">
                                    <table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_ver_informes">
                                        <thead>
                                            <tr style="background-color:#555; color:white;">
                                                <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;font-size: 10px;"><center>#</center></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;width: 80px;">
                                                <div class="tip-top" data-original-title="Fecha atención" style="width:100%;text-align: left;font-size: 10px;">N° CASO</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;width: 155px;">
                                                <div class="tip-top" data-original-title="jugador atendido" style="width:100%;text-align:left;font-size: 10px;">JUGADOR</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;width: 65px;">
                                                <div class="tip-top" data-original-title="rut" style="width:100%;text-align:left;font-size: 10px;">SERIE</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;width: 90px;">
                                                <div class="tip-top" data-original-title="serie" style="width:100%;text-align:left;font-size: 10px;">PREVISION</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;width: 388px;">
                                                <div class="tip-top" data-original-title="fecha incidente" style="width:100%;text-align:left;font-size: 10px;">DIAGNOSTICO</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;width: 100px;">
                                                <div class="tip-top" data-original-title="fecha incidente" style="width:100%;text-align:left;font-size: 10px;">FECHA ACCIDENTE</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:0px; width:30px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:0px; width:30px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:5px; width:30px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="contenido_tabla">
                                            <!-- <tr class="sin_fondo" ><td colspan="10" ><center><h5 style="color:#555555;margin-top:10px;margin-bottom:10px;"><i class="icon-file-alt"></i> Sin seguimiento</h5></center></td></tr> -->
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
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-bottom-right-radius:5px;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12"  style=" margin-top: 20px;">
                                <center>
                                    <button type="button" ng-disabled="" class="boton_guardar_informe" style="margin-right:10px;" onClick="descargarListaPDF();" id="boton_generar_pdf_list">DESCARGAR REPORTE  PDF<i class="icon-cloud-download"></i> </button>
                                    <button type="button" ng-disabled="" class="boton_guardar_informe" onClick="generarExcelLista();" id="boton_generar_pdf_list">DESCARGAR REPORTE EXCEL<i class="icon-cloud-download"></i> </button>
                                </center>  
                            </div>
                            
                        </div>
                    </div>

                    <div id="component_siguimiento_formulario" style="width: 100%; height: 100%; display:none;">   
                        <div class="" style="background-color: #eeeeee;width: 100%; height: 100%; max-height: 100%; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <div style="display:flex;flex-direction:row;flex-wrap:wrap;justify-content:start;">
                                <div class="row-fluid" style="/*background:red;*/width:30%;">
                                    <button class="boton_volver" onClick="botonVolver();" style="float:left;margin-left:10px;margin-top:61px;"><i class="icon-arrow-left"></i> volver</button>
                                </div>
                                <table style="/*background:red;*/width:30%;color:black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 0px;">
                                    <tr class="sin_fondo" >
                                        <td style="padding:12px; padding-top:15px;"><img src="../config/logo_equipo.png" style="height: 100px; margin-top:5px;"></td>
                                        <td>
                                            <center>
                                                <h3 class="titulo_principal" style="color:#595959;margin-bottom: 0px;">Seguro Médico</h3>
                                                <div style="width:auto;margin: 0px;font-weight: bold;border-top:2px solid #404040;border-bottom:2px solid #404040;color: #595959;">Seguimiento</div>
                                            </center>
                                        </td>
                                    </tr>
                                </table>
                                <div class="row-fluid" style="/*background:red;*/width:30%;"></div>
                            </div>
                        
                            
                            <br>
                            <hr>
                            <div style="width: 100%;margin-left: 20%;" > 
                                <form id="filtro_modal_formulario" >
                                    <div style="background-color: lightblue; width: 100%; margin: auto;">
                                        <div class="span3" style="display: flex">
                                            <a class="  green-a" style="width: 50%;height: 20px;background:#eee;height: 32px;display: block;text-align: center;">
                                                <div>
                                                    <p class="ellipsis-text" style="font-weight: normal;color:#555;margin-top: 5px;">Serie</p>
                                                </div>
                                            </a>
                                            <select style="width:50%; height: 30px;background:#fff;border:2px solid #bfbfbf" class="" id="serie_jugador" name="serie_jugador" onchange="consultarJugadoreXSeries(this.value)">
                                            </select>
                                            <!-- <input type="text" readonly  style="width:50%; height: 18px;background:#fff;" class="grey-input date_fechaNacimiento fecha_inicio" id="fecha_atencion" name="fecha_atencion" onchange="" />                    -->
                                        </div>
                                    </div>
                                    <div style="background-color: lightblue; width: 100%; margin: auto;" id="contenedor_jugador">
                                        <div class="span3" style="display: flex">
                                            <a class="green-a" style="width: 50%;height: 20px;background:#eee;height: 32px;display: block;text-align: center;">
                                                <div>
                                                    <p class="ellipsis-text" style="font-weight: normal;color:#555;margin-top: 5px;">Jugador</p>
                                                </div>
                                            </a>
                                            <select style="width:50%; height: 30px;background:#fff;border:2px solid #bfbfbf" class="" id="jugador" name="jugador" onchange="mostrarJugador(this.value)"></select>
                                            <!-- <input type="text" readonly  style="width:50%; height: 18px;background:#fff;" class="grey-input date_fechaNacimiento fecha_inicio" id="fecha_atencion" name="fecha_atencion" onchange="" />                    -->
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                            <br>
                            <hr>

                            <!--    MODAL INICIO  -->
                            <div id="modalSeguimiento" class="modal hide" style="border-radius:10px;">
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
                            <form id="formulario_seguimiento" >
                                <div style="display:flex;flex-direction:row;flex-wrap:wrap;width:100%;height: 270px;/*background:green*/background:#eee;margin-bottom:15px;">
                                    <div style="width:20%;background:#eee;"><!--contendor foto-->
                                        <div style="width:100%;height:100%;display:flex;flex-direction:column;flex-wrap:wrap;justify-content:felx-start;align-items:center;">
                                            <div id="contendor_imagen_jugador" style="overflow: hidden;width:140px;height:140px;border-radius:100px;background:#eee;border: 2px solid #cdcdcd;"></div>
                                            <div style="font-size: 1em;margin-top: 10px;width:80%;background:#eee;text-align:center;font-weight:bold;color:#404040;border-top:5px solid #404040;border-bottom:5px solid #404040">
                                                <span id="nombre_jugador_formulario_new">Gabriel Valera</span><br><!--nombre jugador-->
                                                <span id="serie_jugador_formulario_new">SUB-20</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="width: 80%;background:#eee; height:100%;" id="segmento_izquierdo_formulario"><!--contendor formulario-->
                                        <div id="contenedor_flex_segmento_izquierdo_formulario" style="width:100%;height:100%;display: flex;flex-direction:row;flex-wrap:wrap;justify-content:flex-start;align-content:center;"></div>
                                        <!-- insertarpor medio de javascript y jquery el formulario dinamico -->
                                    </div>
                                    <div style="width:100%;background:#eee;margin-top: 40px;" id="segmento_inferior_formulario">
                                        <!-- insertarpor medio de javascript y jquery el formulario dinamico -->
                                    </div>
                                </div>
                            </form>

                            
                        </div>


                    </div>





















                    

                </div>
                    
                <?php } ?>
            </div>
        </div>
    </body>
</html>
<!-- variables globales -->
<script>

var respuesta_servidor_jugadores=[]

var jugador_json={}

var id_ficha_jugador=""

var numero_detalle_atencion=[]

var contador_numero_detalle_atencion=0

var nombre_usuario_software='<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>'

var jugadores_filtro=[]// se usa para almacenar los jugadores consultados por serie y lo dispara el input serie filtro

var buqueda_filtro=[]

var seguimiento=""

var id_seguimiento=""

var index_array_atencion_diaria=""


var html_modalidad=`
    <div style="margin-right:2.5%;width:29.96%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Modalidad</p>
            </div>
        </a>
        <select style="width:50%; height: 30px;background:#fff;border:2px solid" class="" id="modalidad_tipo_formulario" name="modalidad_tipo_formulario" onchange="mostrarTipoDeFormulario(this.value)">
        </select>
    </div>
`

var formulario_modalidad_cordinada={
    parte_1:`
    <div style="margin-right:2.5%;width:29.96%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040;">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Previsión</p>
            </div>
        </a>
        <input type="text" id="prevision_jugador" disabled="disabled" class="grey-input " style="width:50%;margin:0;background:#fff;border:2px solid;height: 18px;"/>
    </div>
    <div style="margin-right:2.5%;width:29.96%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">N° Caso</p>
            </div>
        </a>
        <input type="text" id="numero_caso" name="numero_caso" class="grey-input " style="width:50%;margin:0;background:#fff;border:2px solid;height: 18px;" onchange="validarFormulario()"/>
    </div>
    <div style="margin-right:2%;width:63%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 21.5%;height: 22px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Diagnostico</p>
            </div>
        </a>
        <input type="text" style="width:69.5%;background:#fff;text-align:left;margin:0" class="grey-input " id="diagnostico" name="diagnostico" onchange="validarFormulario()" />
    </div>
    <div style="margin-right:2.5%;width:30%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Fecha accidente</p>
            </div>
        </a>
        <input type="text" readonly  style="width:50%; height: 18px;background:#fff;" class="grey-input fecha_accidente" id="fecha_accidente" name="fecha_accidente" onchange="ajustarFechasPlazoMaximo(this.value)")" />                   
    </div>
    <div style="margin-right:2%;width:31%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 44%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Fecha denuncia</p>
            </div>
        </a>
        <input type="text" readonly  style="width:37%; height: 18px;background:#fff;" class="grey-input fecha_denuncia" id="fecha_denuncia" name="fecha_denuncia" onchange="" />                   
    </div>
    <div style="margin-right:2%;width:30%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 43%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Plazo máx 30 días</p>
            </div>
        </a>
        <input type="text" readonly  style="width:38%; height: 18px;background:#fff;" class="grey-input fecha_plazo_maximo_30" id="fecha_plazo_maximo_30" name="fecha_plazo_maximo_30" onchange="" />                   
    </div>
    <div style="width:30%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 42%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Pendiente año ant</p>
            </div>
        </a>
        <select style="width:47%; height: 30px;background:#fff;border:2px solid" class="" id="pendiente_ano" name="pendiente_ano" onchange="">
            <option id="option_pendiente_ano_00" value="NULL">Seleccione</option>
            <option id="option_pendiente_ano_1" value="1">Si</option>
            <option id="option_pendiente_ano_0" value="0">No</option>
        </select>
    </div>


    <div style="margin-right:3%;width:30%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 47%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Entrega documentación</p>
            </div>
        </a>
        <select style="width:47%; height: 30px;background:#fff;border:2px solid" class="" id="entrada_documentacion" name="entrada_documentacion" onchange="">
            <option id="option_entrada_documentacion_00" value="NULL">Seleccione</option>
            <option id="option_entrada_documentacion_1" value="1">Si</option>
            <option id="option_entrada_documentacion_0" value="0">No</option>
        </select>
    </div>
    <div style="margin-right:2.5%;width:29.5%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 49%;height: 20px;background:#404040;padding-left:6px;padding-right:6px;">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Continuidad tratamiento</p>
            </div>
        </a>
        <select style="width:45%; height: 30px;background:#fff;border:2px solid" class="" id="continuidad_tratamiento" name="continuidad_tratamiento" onchange="">
            <option id="option_continuidad_tratamiento_00" value="NULL">Seleccione</option>
            <option id="option_continuidad_tratamiento_1" value="1">Si</option>
            <option id="option_continuidad_tratamiento_0" value="0">No</option>
        </select>
    </div>



    <div style="margin-right:2%;width:31%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 41%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Plazo máx 90 días</p>
            </div>
        </a>
        <input type="text" readonly  style="width:40%; height: 18px;background:#fff;" class="grey-input fecha_plazo_maximo_90" id="fecha_plazo_maximo_90" name="fecha_plazo_maximo_90" onchange="" />                   
    </div>
    <div style="margin-right:2%;width:31%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 44%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Plazo máx 180 días</p>
            </div>
        </a>
        <input type="text" readonly  style="width:37%; height: 18px;background:#fff;" class="grey-input fecha_plazo_maximo_180" id="fecha_plazo_maximo_180" name="fecha_plazo_maximo_180" onchange="" />                   
    </div>
    <div style="width:30%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 44%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Plazo reembolso</p>
            </div>
        </a>
        <input type="text" readonly  style="width:37%; height: 18px;background:#fff;" class="grey-input fecha_plazo_reembolzo" id="fecha_plazo_reembolzo" name="fecha_plazo_reembolzo" onchange="" />                   
    </div>
    `,
    parte_2:`
    <div style="display:flex;width: 93%;margin-left: 2%;">Comentarios del caso</div>
    <textarea id="comentario_caso" name="comentario_caso" style="width: 93%;height: 100px;margin-left: 2%;resize: none;border:2px solid #bfbfbf"></textarea>
    <div class="row-fluid" style="margin-top: 50px;margin-bottom: 80px;">
            <div class="span12">
                <center><!-- disabled="disabled"  -->
                    <button type="button" ng-disabled="" disabled="disabled" class="boton_guardar_informe" onClick="mostrarModalFormularioEnviarDatos();" id="boton_agregar_infrome"><i class="icon-save"></i> GUARDAR INFORME</button>
                </center>   
            </div>
        </div>
    </div>
    `
}

var formulario_modalidad_libre_eleccion={
    parte_1:`
    <div style="margin-right:2.5%;width:29.96%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Previsión</p>
            </div>
        </a>
        <input type="text" id="prevision_jugador" disabled="disabled" class="grey-input " style="width:50%;margin:0;background:#fff;border:2px solid;height: 18px;"/>
    </div>
    <div style="margin-right:2.5%;width:29.96%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">N° Caso</p>
            </div>
        </a>
        <input type="text" id="numero_caso" name="numero_caso" class="grey-input " style="width:50%;margin:0;background:#fff;border:2px solid;height: 18px;" onchange="validarFormulario()"/>
    </div>
    <div style="margin-right:2%;width:63%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 21.5%;height: 22px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Diagnostico</p>
            </div>
        </a>
        <input type="text" style="width:69.5%;background:#fff;text-align:left;margin:0" class="grey-input " id="diagnostico" name="diagnostico" onchange="validarFormulario()" />
    </div>
    <div style="margin-right:2.5%;width:30%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Fecha accidente</p>
            </div>
        </a>
        <input type="text" readonly  style="width:50%; height: 18px;background:#fff;" class="grey-input fecha_accidente" id="fecha_accidente" name="fecha_accidente" onchange="" />                   
    </div>
    <div style="margin-right:2%;width:31%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 44%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Fecha denuncia</p>
            </div>
        </a>
        <input type="text" readonly  style="width:37%; height: 18px;background:#fff;" class="grey-input fecha_denuncia" id="fecha_denuncia" name="fecha_denuncia" onchange="" />                   
    </div>
    <div style="margin-right:2%;width:30%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 39%;height: 20px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Fecha atención</p>
            </div>
        </a>
        <input type="text" readonly  style="width:42%; height: 18px;background:#fff;" class="grey-input fecha_atencion" id="fecha_atencion" name="fecha_atencion" onchange="" />                   
    </div>
    <div style="margin-right:2%;width:52%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 26%;height: 22px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Centro de atención</p>
            </div>
        </a>
        <input type="text" style="width:63%;background:#fff;text-align:left;margin:0" class="grey-input " id="centro_atencion" name="centro_atencion" onchange="" />
    </div>
    <div style="margin-right:2%;width:42%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 32%;height: 22px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Centro de derivación</p>
            </div>
        </a>
        <input type="text" style="width:54%;background:#fff;text-align:left;margin:0" class="grey-input " id="centro_derivacion" name="centro_derivacion" onchange="" />
    </div>
    <div style="margin-right:2%;width:74%;display:flex;margin-bottom:15px">
        <a class="btn btn-md btn-primary green-a" style="width: 18%;height: 22px;background:#404040">
            <div>
                <p class="ellipsis-text" style="font-weight: normal;">Médico tratante</p>
            </div>
        </a>
        <input type="text" style="width:74%;background:#fff;text-align:left;margin:0" class="grey-input " id="medico_tratante" name="medico_tratante" onchange="" />
    </div>
    `,
    parte_2:`
    <div style="display:flex;width: 93%;margin-left: 2%;">Comentarios del caso</div>
    <textarea id="comentario_caso" name="comentario_caso" style="width: 93%;height: 100px;margin-left: 2%;resize: none;border:2px solid #bfbfbf"></textarea>
    <div style="display:flex;width: 93%;margin-left: 2%;font-weight: bold;color:#404040;">DETALLE ATENCIONES</div>
    

    <button style="margin-right:3.5%;margin-top: 0px; float:right;" class="boton_informe_semanal" id="boton_agregar_informe_detalle_atencion" onClick="agregarInformeDetalleAtencion()"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar informe</b></button>
    
    
    <div style="width: 93%;margin-left: 2%;height:auto;" id="contenedor_detalle_atencion">
    </div>
    <div class="row-fluid" style="margin-top: 20px;margin-bottom: 80px;">
            <div class="span12"  style=" ">
                <center><!-- disabled="disabled" -->
                    <button type="button" ng-disabled="" disabled="disabled"  class="boton_guardar_informe" onClick="mostrarModalFormularioEnviarDatos();" id="boton_agregar_infrome"><i class="icon-save"></i> GUARDAR INFORME</button>
                </center>   
            </div>
        </div>
    </div>
    
    `
}

</script>
<script>

function botonVolver(){
    $("#component_siguimiento_formulario").hide()
    $("#component_seguimiento_inicio").show()
    cargarOpionSelectSerieFiltro()
    fechaFinalFiltro()
    fechaInicioFiltroPrimero()
    buscarSeguimientos()

}

function generarExcelLista(){
    let datos=[]
    let fecha_desde=formatofecha($("#fecha_inicio").val())
    let fecha_hasta=formatofecha($("#fecha_final").val())
    for(let contador=0;contador<window.buqueda_filtro.length;contador++){
        datos.push({name:"array_id_seguimiento[]",value:window.buqueda_filtro[contador].idseguimiento})
    }
    let fecha_completa=`Jugadoras derivadas al seguro médico entre el ${fecha_desde} y ${fecha_hasta}`
    datos.push({name:"fecha_completa",value:fecha_completa})
    console.log(datos)
    $("#descargarPDF").modal('show');
    $('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando EXCEL...</h5><br><img src="../config/agregar_archivo.png">');
    $.ajax({
        url: `post/reportes/generarExcel_seguimiento.php`,
        type: "post",
        cache: false,
        data:datos,
        success:(respuesta) => {
            if(respuesta != ''){
                $('#mensaje_agregar_descargarPDF').html('<h5>EXCEL Generado Exitosamente...</h5><br><button type="submit" class="boton_informe_jugador" style="border-radius: 5px" id="boton_agregar_informe" ><a  class="btn_descargar" onClick="closeModal_pdf();" download href="reportes_excel/'+respuesta+'">DESCARGAR PDF</a></button>');
            }else{
                $('#mensaje_agregar_descargarPDF').html('<h5>Error de conexión: los datos no se han podido insertar.</h5><br>');
            }
        },
        error:(error)=>{
            $('#mensaje_agregar_descargarPDF').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
        }, timeout: 15000 // sets timeout to 3 seconds
    })
}

//
function descargarListaPDF(){
    // id="fecha_inicio" formatofecha
    let datos=[]
    let fecha_desde=formatofecha($("#fecha_inicio").val())
    let fecha_hasta=formatofecha($("#fecha_final").val())
    for(let contador=0;contador<window.buqueda_filtro.length;contador++){
        datos.push({name:"array_id_seguimiento[]",value:window.buqueda_filtro[contador].idseguimiento})
    }
    let fecha_completa=`Jugadoras derivadas al seguro médico entre el ${fecha_desde} y ${fecha_hasta}`
    datos.push({name:"fecha_completa",value:fecha_completa})
    console.log(datos)
    $("#descargarPDF").modal('show');
    $('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');
    $.ajax({
        url: `post/reportes/generarPDF_ODR_seguimiento_lista.php`,
        type: "post",
        cache: false,
        data:datos,
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

function descargarPDF(posicion){
    let seguimiento=window.buqueda_filtro[posicion]
    // alert(seguimiento.modalidad_seguimiento)
    switch(seguimiento.modalidad_seguimiento){
        case "1":datosLibreEleccionPdf(seguimiento);break;
        case "2":datosCoordinadaPdf(seguimiento);break;
        default:alert("el registro no tiene una modalidad para poder generar un pdf");break;
    }
}


function datosLibreEleccionPdf(seguimiento){
    let datos_pdf=[]
    let nombre_completo=`${seguimiento.nombre} ${seguimiento.apellido1} ${seguimiento.apellido2}`
    datos_pdf.push({name:"nombre_completo",value:nombre_completo})

    let serie=serieJugador(`${seguimiento.serieActual}_${seguimiento.sexo}`)
    datos_pdf.push({name:"serie",value:serie})

    let modalidad="Libre Elección"
    datos_pdf.push({name:"modalidad",value:modalidad})
    datos_pdf.push({name:"tipo_modalidad",value:seguimiento.modalidad_seguimiento})

    let prevision=mostrarSaludJugador(seguimiento.prevision)
    datos_pdf.push({name:"prevision",value:prevision})

    let diagnostico=seguimiento.diagnostico_seguimiento
    datos_pdf.push({name:"diagnostico",value:diagnostico})

    let numero_caso=seguimiento.numero_caso_seguimiento
    datos_pdf.push({name:"numero_caso",value:numero_caso})

    let fecha_accidente=formatofecha(seguimiento.fecha_accidente_seguimiento)
    datos_pdf.push({name:"fecha_accidente",value:fecha_accidente})

    let fecha_denuncia=formatofecha(seguimiento.fecha_denuncia_seguimiento)
    datos_pdf.push({name:"fecha_denuncia",value:fecha_denuncia})

    let fecha_maximo_30=formatofecha(seguimiento.fecha_plazo_maximo_30_seguimiento) 
    datos_pdf.push({name:"fecha_maximo_30",value:fecha_maximo_30})

    let fecha_maximo_90=formatofecha(seguimiento.fecha_plazo_maximo_90_seguimiento )
    datos_pdf.push({name:"fecha_maximo_90",value:fecha_maximo_90})

    let fecha_maximo_180=formatofecha(seguimiento.fecha_plazo_maximo_180_seguimiento)
    datos_pdf.push({name:"fecha_maximo_180",value:fecha_maximo_180})

    let fecha_reembolzo=formatofecha(seguimiento.fecha_plazo_reembolzo_seguimiento) 
    datos_pdf.push({name:"fecha_reembolzo",value:fecha_reembolzo})

    let pendiente_ano_anterior=""
    let color_pendiente_ano_anterior="#fff"
    if(seguimiento.pendiente_ano_anterior_seguimiento ==="1"){
        pendiente_ano_anterior="Si"
    }
    else if(seguimiento.pendiente_ano_anterior_seguimiento ==="0"){
        pendiente_ano_anterior="No"
        color_pendiente_ano_anterior="#dc4e4e"
    }
    datos_pdf.push({name:"pendiente_ano_anterior",value:pendiente_ano_anterior})
    datos_pdf.push({name:"color_pendiente_ano_anterior",value:color_pendiente_ano_anterior})

    let entrega_documento=""
    let color_entrega_documento="#fff"
    if(seguimiento.entrega_documento_seguimiento  ==="1"){
        entrega_documento="Si"
    }
    else if(seguimiento.entrega_documento_seguimiento  ==="0"){
        entrega_documento="No"
        color_entrega_documento="#dc4e4e"
    }
    datos_pdf.push({name:"entrega_documento",value:entrega_documento})
    datos_pdf.push({name:"color_entrega_documento",value:color_entrega_documento})

    let continuidad_tratamiento=""
    let color_continuidad_tratamiento="#fff"
    if(seguimiento.continuidad_tratamiento_seguimiento  ==="1"){
        continuidad_tratamiento="Si"
    }
    else if(seguimiento.continuidad_tratamiento_seguimiento  ==="0"){
        continuidad_tratamiento="No"
        color_continuidad_tratamiento="#dc4e4e"
    }
    datos_pdf.push({name:"continuidad_tratamiento",value:continuidad_tratamiento})
    datos_pdf.push({name:"color_continuidad_tratamiento",value:color_continuidad_tratamiento})
    datos_pdf.push({name:"id_ficha_jugador",value:seguimiento.idfichaJugador})

    console.log(datos_pdf)
    $("#descargarPDF").modal('show');
    $('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');
    $.ajax({
        url: `post/reportes/generarPDF_ODR_seguimiento_jugador.php`,
        type: "post",
        cache: false,
        data:datos_pdf,
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

function datosCoordinadaPdf(seguimiento){
    let datos_pdf=[]
    console.log(seguimiento)
    let nombre_completo=`${seguimiento.nombre} ${seguimiento.apellido1} ${seguimiento.apellido2}`
    datos_pdf.push({name:"nombre_completo",value:nombre_completo})

    let serie=serieJugador(`${seguimiento.serieActual}_${seguimiento.sexo}`)
    datos_pdf.push({name:"serie",value:serie})

    let modalidad="Coordinada"
    datos_pdf.push({name:"modalidad",value:modalidad})
    datos_pdf.push({name:"tipo_modalidad",value:seguimiento.modalidad_seguimiento})

    let prevision=mostrarSaludJugador(seguimiento.prevision)
    datos_pdf.push({name:"prevision",value:prevision})

    let diagnostico=seguimiento.diagnostico_seguimiento
    datos_pdf.push({name:"diagnostico",value:diagnostico})

    let numero_caso=seguimiento.numero_caso_seguimiento
    datos_pdf.push({name:"numero_caso",value:numero_caso})

    let fecha_atencion=formatofecha(seguimiento.fecha_atencion_seguimiento)
    datos_pdf.push({name:"fecha_atencion",value:fecha_atencion})

    let fecha_denuncia=formatofecha(seguimiento.fecha_denuncia_seguimiento)
    datos_pdf.push({name:"fecha_denuncia",value:fecha_denuncia})


    let centro_atencion=(seguimiento.centro_atencion_seguimiento!==null)?seguimiento.centro_atencion_seguimiento:""
    datos_pdf.push({name:"centro_atencion",value:centro_atencion})

    let centro_derivacion=(seguimiento.centro_derivacion_seguimiento!==null)?seguimiento.centro_derivacion_seguimiento:""
    datos_pdf.push({name:"centro_derivacion",value:centro_derivacion})

    let medico_tratante=(seguimiento.medico_tratante_seguimiento!==null)?seguimiento.medico_tratante_seguimiento:""
    datos_pdf.push({name:"medico_tratante",value:medico_tratante})
    datos_pdf.push({name:"id_ficha_jugador",value:seguimiento.idfichaJugador})

    for(let detalle_atencion of seguimiento.detalles_atencion_seguimiento){
        datos_pdf.push({name:"array_fecha_detalle_atencion[]",value:detalle_atencion.fecha_atencion_detalle_atencion_seguimiento})
        datos_pdf.push({name:"array_centro_detalle_atencion[]",value:detalle_atencion.centro_atencion_detalle_atencion_seguimiento})
        datos_pdf.push({name:"array_detalle_atencion[]",value:detalle_atencion.detalle_atencion_seguimiento})
    }
    
    console.log(datos_pdf)
    $("#descargarPDF").modal('show');
    $('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');
    $.ajax({
        url: `post/reportes/generarPDF_ODR_seguimiento_jugador.php`,
        type: "post",
        cache: false,
        data:datos_pdf,
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


function serieJugador(serie){
    let lista_codigo_serie=[
        "99_1",
        "20_1",
        "19_1",
        "18_1",
        "17_1",
        "16_1",
        "15_1",
        "14_1",
        "13_1",
        "12_1",
        "11_1",
        "10_1",
        "9_1",
        "8_1",
        "99_2",
        "17_2",
        "15_2",
    ];
    let lista_nombre_serie=[
        "Primer",
        "Sub-20",
        "Sub-19",
        "Sub-18",
        "Sub-17",
        "Sub-16",
        "Sub-15",
        "Sub-14",
        "Sub-13",
        "Sub-12",
        "Sub-11",
        "Sub-10",
        "Sub-9",
        "Sub-8",
        "Adulta",
        "Sub-17",
        "Sub-15",
    ];
    let posicion="";
    for(let contador=0;contador<lista_codigo_serie.length;contador++){
        if(serie===lista_codigo_serie[contador]){
            posicion=contador;
        }
    }
    return lista_nombre_serie[posicion];
}




function buscarSeguimientos(){
    let datos_filtro_jugadores=$("#formulario_filtro_jugadores").serializeArray()
    datos_filtro_jugadores.push({name:"fecha_inicio",value:$("#fecha_inicio").val()})
    datos_filtro_jugadores.push({name:"fecha_final",value:$("#fecha_final").val()})
    console.log(datos_filtro_jugadores)
    $.ajax({
            url: `post/seguimiento_buscar_filtro.php`,
            type: "post",
            data:datos_filtro_jugadores,
            success: function(respuesta) {
                var json=JSON.parse(respuesta);
                console.log(json.datos)
                if(json.respuesta){
                    window.buqueda_filtro=json.datos
                    let filas=crearFilaTabla(window.buqueda_filtro)
                    insertarFilasTabla(filas)
                }
                else{
                    $('#sin_resultados').show();
                    $("#contenido_tabla").html(`<tr class="sin_fondo" ><td colspan="10" ><center><h5 style="color:#555555;margin-top:10px;margin-bottom:10px;"><i class="icon-file-alt"></i> Sin seguimiento</h5></center></td></tr>`)
                }
            },error: function(){// will fire when timeout is reached
                // alert("errorXXXXX");
                $("#error_conexion").show()
            }, timeout: 10000 // sets timeout to 3 seconds
        });

}

function crearFilaTabla(datos){
    let numero_fila=0;
    let filas=datos.map(seguimiento=>{
        const fila=`
        <tr class='panel_buscar' style='cursor:pointer; color:#404040; font-size:12px;' id='seguimiento${seguimiento.idseguimiento}'>
            <td style="text-align:left;" onClick='verAtencionDiaria(${numero_fila});'>
                <div style='max-width:100%'>
                    <center class='ellipsis-text' style="font-size:10px;">
                        ${numero_fila+1}
                    </center>  
                </div>
            </td>
            <td style="text-align:left;" onClick='verAtencionDiaria(${numero_fila});'>
                <div style='max-width:105px'>
                    <p class='ellipsis-text' style="font-weight: normal;font-size:10px;">
                    ${(seguimiento.numero_caso_seguimiento!=null)?seguimiento.numero_caso_seguimiento:"-"}
                    </p>  
                </div>
            </td>
            <td style="text-align:left;" onClick='verAtencionDiaria(${numero_fila});'>
            <div style="display:block;float: left;margin-right: 5px;border:2px solid #404040;border-radius: 100px;width:22px;height:22px;"><img style="border-radius: 100px;width:100%;height:100%" src="./foto_jugadores/${seguimiento.idfichaJugador}.png" style="width:100%;height:100%;"/></div>
                <div style='max-width:151px' style="float: left;margin-top: 2px;font-size:10px;">
                    <p class='ellipsis-text'>
                    ${seguimiento.nombre} ${seguimiento.apellido1} ${seguimiento.apellido2}
                    </p>  
                </div>
            </td>
            <td style="text-align:left;" onClick='verAtencionDiaria(${numero_fila});'>
                <div style='max-width:50px'>
                    <p class='ellipsis-text' style="font-weight: normal;font-size:10px;">
                    ${obtenerSerieJugador(seguimiento.serieActual,seguimiento.sexo)}
                    </p>  
                </div>
            </td>
            
            <td style="text-align:left;" onClick='verAtencionDiaria(${numero_fila});'>
                <div style='max-width:75px'>
                    <p class='ellipsis-text' style="font-weight: normal;font-size:10px;">
                    ${mostrarSaludJugador(seguimiento.prevision)}
                    </p>  
                </div>
            </td>
            <td style="text-align:left;" onClick='verAtencionDiaria(${numero_fila});'>
                <div style='max-width:386px'>
                    <p class='ellipsis-text' style="font-weight: normal;font-size:10px;">
                        ${seguimiento.diagnostico_seguimiento}
                    </p>  
                </div>
            </td>
            <td style="text-align:left;" onClick='verAtencionDiaria(${numero_fila});'>
                <div style='max-width:55px'>
                    <p class='ellipsis-text' style="font-weight: normal;font-size:10px;">
                        ${fecha_formato_ddmmaaa(seguimiento.fecha_accidente_seguimiento)}
                    </p>  
                </div>
            </td>

            <td style='padding:2px;'>
                    <center>
                        <a class='boton_add' onClick='descargarPDF(${numero_fila});'>
                            <i class='icon-download-alt'></i>
                        </a>
                    </center>
                </td>
                <td style='padding:2px;'>
                    <center >
                        <a class='boton_editar'   onClick='mostrarModalFormularioEditar(${numero_fila});'>
                            <i class='icon-pencil'></i>
                        </a>
                    </center>
                </td>
                <td style='padding:2px;'>
                    <center>
                        <a class='boton_eliminar' onClick='abrirModalEliminarAtencionDiaria(${seguimiento.idseguimiento});'>
                            <i class="icon-remove"></i>
                        </a>
                    </center>
                </td>
        </tr>
        `
        numero_fila+=1
        return fila
    })
    return filas
}

function insertarFilasTabla(filas){
    $("#contenido_tabla").html(" ")
    filas.map(fila=>{
        $("#contenido_tabla").append(fila)
    })
}

function abrirModalEliminarAtencionDiaria(id){
    $("#mensaje_eliminar_seguimiento").html(`<h5>¿Estás seguro que quieres eliminar esta atención diaria?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">`)
    const html_botones=`
        <button type='button' class='btn btn-default boton_modal' data-dismiss='modal' onClick='cerrarModalEliminarSeguimiento()' id='boton_cerrar_alerta' style='margin-right:20px; border-radius:5px;'><span class='icon'><i class='icon-remove'></i></span> No</button>
        <button type='button' id='eliminar_modal' class='btn btn-default boton_modal ' onClick='eliminarSeguimiento(${id});' ng-click='desactivarBotonAgregarBoleta()' style='border-radius:5px;'><span class='icon'><i class='icon-ok'></i></span> Si</button>  
    `;
    $("#contendor_botones_modal_eliminar_atencion_diaria").html(html_botones);
    $("#modalEliminarSeguimiento").modal("show");
}

function cerrarModalEliminarSeguimiento(){
    $("#modalEliminarSeguimiento").modal("hide")
}

function eliminarSeguimiento(id){
    $("#error_conexion").hide()
    // alert(id)
    $.ajax({
            url: `post/seguimiento_eliminar.php?id=${id}`,
            type: "get",
            success: function(respuesta) {
                buscarSeguimientos()
                $("#modalEliminarSeguimiento").modal("hide")
            },error: function(){// will fire when timeout is reached
                // alert("errorXXXXX");
                $("#modalEliminarSeguimiento").modal("hide")
                $("#error_conexion").show()
            }, timeout: 10000 // sets timeout to 3 seconds
	});
}

function obtenerSerieJugador(serie,sexo){
    let lista_serie_jugador=[
        //serie masculina
        {numero_serie:"99_1",nombre_serie:"Primer equipo"},
        {numero_serie:"20_1",nombre_serie:"Sub 20"},
        {numero_serie:"17_1",nombre_serie:"Sub 17"},
        {numero_serie:"16_1",nombre_serie:"Sub 16"},
        {numero_serie:"15_1",nombre_serie:"Sub 15"},
        {numero_serie:"14_1",nombre_serie:"Sub 14"},
        {numero_serie:"13_1",nombre_serie:"Sub 13"},
        {numero_serie:"12_1",nombre_serie:"Sub 12"},
        {numero_serie:"11_1",nombre_serie:"Sub 11"},
        {numero_serie:"10_1",nombre_serie:"Sub 10"},
        {numero_serie:"9_1",nombre_serie:"Sub 9"},
        {numero_serie:"8_1",nombre_serie:"Sub 8"},
        //serie femenina
        {numero_serie:"99_2",nombre_serie:"Adulta femenina"},
        {numero_serie:"17_2",nombre_serie:"Sub 17 femenina"},
        {numero_serie:"15_2",nombre_serie:"Sub 15 femenina"},
    ]
    let serie_completa=serie+"_"+sexo
    let serie_jugador=lista_serie_jugador.filter(serie_j=> serie_j.numero_serie===serie_completa)
    return serie_jugador[0].nombre_serie

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



async function mostrarModalFormularioEditar(posicion){
    window.index_array_atencion_diaria=posicion
    window.id_informe=true
    let seguimiento_jugador=window.buqueda_filtro[posicion]
    window.seguimiento=window.buqueda_filtro[posicion]
    window.id_seguimiento=window.buqueda_filtro[posicion].idseguimiento
    let series_array=[
    //serie masculina
    {numero_serie:"0",nombre_serie:"Seleccione una serie"},
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
    let list_option_serie=series_array.map(serie=> {
        return `<option id="option_select_serie_jugador_${serie.numero_serie}" value="${serie.numero_serie}" >${serie.nombre_serie}</option>`
    })
    for(let contador=0;contador<list_option_serie.length;contador++){
        $("#serie_jugador").append(list_option_serie[contador])
    }
    let serie=seguimiento_jugador.serieActual+"_"+seguimiento_jugador.sexo
    let serie_2=seguimiento_jugador.serieActual
    $("#serie_jugador").val(serie)
    await consultarJugadoreXSeries(serie)
    $("#serie_jugador").prop("disabled",true)
    $("#jugador").prop("disabled",true)

    let codigo_jugador=seguimiento_jugador.idfichaJugador+"_"+seguimiento_jugador.idclub
    $("#jugador").val(codigo_jugador)
    $("#component_seguimiento_inicio").hide()
    $("#component_siguimiento_formulario").show()
    mostrarJugadorEditar(seguimiento_jugador,serie_2)
    
}

function mostrarJugadorEditar(seguimiento_jugador,serie){
    $("#contenedor_flex_segmento_izquierdo_formulario").css("align-content","start")
    $("#contenedor_flex_segmento_izquierdo_formulario").empty()
    $("#segmento_inferior_formulario").empty()
    $("#nombre_jugador_formulario_new").text(" ")
    window.id_ficha_jugador=seguimiento_jugador.idfichaJugador 
    $("#contendor_imagen_jugador").html(`<img style="border-radius: 100px;width:100%;height:100%;" id="imagen_jugador_${seguimiento_jugador.idfichaJugador}" src="./foto_jugadores/${seguimiento_jugador.idfichaJugador}.png"/>`)
    $("#contenedor_flex_segmento_izquierdo_formulario").html(window.html_modalidad)
    generarOptionSelectModalidad()
    mostrarTipoDeFormulario(seguimiento_jugador.modalidad_seguimiento)
    $("#formulario_seguimiento").show()
}

function mostrarModalFormulario(){
    // fechaAtencionDiariaHoy()
    window.id_informe=false
    $("#serie_jugador").empty()
    let series_array=[
    //serie masculina
    {numero_serie:"0",nombre_serie:"Seleccione una serie"},
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
    let list_option_serie=series_array.map(serie=> {
        return `<option id="option_select_serie_jugador_${serie.numero_serie}" value="${serie.numero_serie}" >${serie.nombre_serie}</option>`
    })
    for(let contador=0;contador<list_option_serie.length;contador++){
        $("#serie_jugador").append(list_option_serie[contador])
    }
    $("#serie_jugador").prop("disabled",false)
    $("#jugador").prop("disabled",false)
    $("#component_seguimiento_inicio").hide()
    $("#component_siguimiento_formulario").show()
    // $("#myModalFormulario").modal("show")
    $("#contenedor_jugador").css("display","none")
    $("#formulario_seguimiento").hide()
}

async function consultarJugadoreXSeries(serie_select){
    $("#jugador").empty()
    if(serie_select!=="0"){
        const serie=serie_select.split("_")[0]
        const sexo=serie_select.split("_")[1]
        await $.ajax({
                url: `post/seguimiento_consultar_jugador.php?serie=${serie}&sexo=${sexo}`,
                type: "get"
                ,success: function(respuesta) {
                    var json=JSON.parse(respuesta);
                    window.respuesta_servidor_jugadores=json.respuesta
                    let array=respuesta_servidor_jugadores
                    //nombre
                    //idfichaJugador
                    //idclub
                    //--------------
                    let list_option_jugadores=array.map(jugadores=> {
                        return `<option id="option_select_jugador_${jugadores.idfichaJugador}_${jugadores.idclub}" value="${jugadores.idfichaJugador}_${jugadores.idclub}" >${jugadores.nombre} ${jugadores.apellido1} ${jugadores.apellido2}</option>`
                    })
                    for(let contador=0;contador<list_option_jugadores.length;contador++){
                        $("#jugador").append(list_option_jugadores[contador])
                    }
                    $("#formulario_seguimiento").hide()
                    $("#contenedor_jugador").css("display","inline")
                    if(!window.id_informe){
                        let valor_jugadora=$("#jugador").val()
                        mostrarJugador(valor_jugadora)
                    }
                },error: function(){// will fire when timeout is reached
                // alert("errorXXXXX");
            }, timeout: 10000 // sets timeout to 3 seconds
        });
    }
    else{
        $("#formulario_seguimiento").hide()
        $("#contenedor_jugador").css("display","none")
    }
}

function mostrarJugador(value){
    window.id_seguimiento=""
    $("#contendor_imagen_jugador").html(`<img style="border-radius: 100px;;width:100%;height:100%;" id="imagen_jugador_${value.split("_")[0]}" src="./foto_jugadores/${value.split("_")[0]}.png"/>`)
    // $("#contendor_imagen_jugador").html(`<img style="border-radius: 100px;;width:100%;height:100%;" id="imagen_jugador_${value.split("_")[0]}" src="./foto_jugadores/jugador100.png"/>`)
    $("#contenedor_flex_segmento_izquierdo_formulario").css("align-content","start")
    $("#contenedor_flex_segmento_izquierdo_formulario").empty()
    $("#segmento_inferior_formulario").empty()
    $("#nombre_jugador_formulario_new").text(" ")
    $("#serie_jugador_formulario_new").text(" ")
    // let nombre_jugador=$(`#option_select_jugador_${value}`).text()
    let codigo_serie=$("#serie_jugador").val()
    let serie_jugador=$(`#option_select_serie_jugador_${codigo_serie}`).text()
    // $("#nombre_jugador_formulario_new").text(nombre_jugador)
    $("#serie_jugador_formulario_new").text(serie_jugador)
    window.id_ficha_jugador=value.split("_")[0]
    $("#contenedor_flex_segmento_izquierdo_formulario").html(window.html_modalidad)
    // // $("#contexto_incidente_formulario").empty()
    generarOptionSelectModalidad()
    mostrarTipoDeFormulario($("#modalidad_tipo_formulario").val())
    $("#boton_agregar_infrome").prop("disabled",true)
    $("#formulario_seguimiento").show()
}

function generarOptionSelectModalidad(){
    let lista =[
        {numero_modalidad:1,nombre_modalidad:"Libre elección"},
        {numero_modalidad:2,nombre_modalidad:"Coordinada"},
    ]
    let list_option_modalidad=lista.map(modalidad=> {
        return `<option id="option_select_modalidad_form_modal_${modalidad.numero_modalidad}" value="${modalidad.numero_modalidad}" >${modalidad.nombre_modalidad}</option>`
    })
    for(let contador=0;contador<list_option_modalidad.length;contador++){
        $("#modalidad_tipo_formulario").append(list_option_modalidad[contador])
    }
}

function mostrarTipoDeFormulario(tipo){
    $("#contenedor_flex_segmento_izquierdo_formulario").empty()
    $("#contenedor_flex_segmento_izquierdo_formulario").html(window.html_modalidad)
    generarOptionSelectModalidad()
    $("#modalidad_tipo_formulario").val(tipo)
    $("#segmento_inferior_formulario").empty()
    switch(tipo){
        case "1":formularioModalidadLibreEleccion(tipo);break; 
        case "2":formularioModalidadCordinada(tipo);break; 
        default:formularioModalidadLibreEleccion(null);break; 
    }
}

function mostrarDatosFormulario(tipo,seguimiento){
    switch(tipo){
        case "1":mostrarDatosLibreEleccion(tipo,seguimiento);break; 
        case "2":mostrarDatosCordinada(tipo,seguimiento);break; 
        default:mostrarDatosLibreEleccionDefault(null,seguimiento);break;
    }
}

function formularioModalidadLibreEleccion(tipo){
    $("#contenedor_flex_segmento_izquierdo_formulario").css("align-content","start")
    $("#contenedor_flex_segmento_izquierdo_formulario").append(formulario_modalidad_cordinada.parte_1)
    $("#segmento_inferior_formulario").html(formulario_modalidad_cordinada.parte_2)
    let jugador=respuesta_servidor_jugadores.filter(jugador => window.id_ficha_jugador===jugador.idfichaJugador)
    window.jugador_json=jugador[0]
    let nombre_completo_jugador=`${jugador_json.nombre} ${jugador_json.apellido1} ${jugador_json.apellido2}`
    let nombre_corto=""
    if(nombre_completo_jugador.length>24){
        nombre_completo_jugador=`${nombre_completo_jugador.substring(0,24)}...`
    }
    $("#nombre_jugador_formulario_new").text(nombre_completo_jugador)
    $("#prevision_jugador").val(mostrarSaludJugador(jugador[0].prevision))
    $("#fecha_plazo_reembolzo").datetimepicker({
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
    $("#fecha_plazo_reembolzo").datetimepicker('setDate', new Date() );
    $("#fecha_denuncia").datetimepicker({
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
    $("#fecha_denuncia").datetimepicker('setDate', new Date() );
    $("#fecha_accidente").datetimepicker({
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
    $("#fecha_accidente").datetimepicker('setDate', new Date() );
    $("#fecha_plazo_maximo_30").datetimepicker({
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
    $("#fecha_plazo_maximo_30").datetimepicker('setDate', sumarDiasFecha(new Date(),30) );
    $("#fecha_plazo_maximo_90").datetimepicker({
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
    $("#fecha_plazo_maximo_90").datetimepicker('setDate', sumarDiasFecha(new Date(),90) );
    $("#fecha_plazo_maximo_180").datetimepicker({
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
    $("#fecha_plazo_maximo_180").datetimepicker('setDate', sumarDiasFecha(new Date(),180) );
    if(window.id_informe){
        mostrarDatosFormulario(tipo,window.buqueda_filtro[window.index_array_atencion_diaria])
    }
}



function sumarDiasFecha(fecha,dias){
    fecha.setDate(fecha.getDate()+dias)
    return fecha
}

function formularioModalidadCordinada(tipo){
    $("#contenedor_flex_segmento_izquierdo_formulario").css("align-content","start")
    $("#contenedor_flex_segmento_izquierdo_formulario").append(formulario_modalidad_libre_eleccion.parte_1)
    $("#segmento_inferior_formulario").html(formulario_modalidad_libre_eleccion.parte_2)
    let jugador=respuesta_servidor_jugadores.filter(jugador => window.id_ficha_jugador===jugador.idfichaJugador)
    window.jugador_json=jugador[0]
    let nombre_completo_jugador=`${jugador_json.nombre} ${jugador_json.apellido1} ${jugador_json.apellido2}`
    let nombre_corto=""
    if(nombre_completo_jugador.length>24){
        nombre_completo_jugador=`${nombre_completo_jugador.substring(0,24)}...`
    }
    $("#nombre_jugador_formulario_new").text(nombre_completo_jugador)
    $("#prevision_jugador").val(mostrarSaludJugador(jugador[0].prevision))

    $("#fecha_atencion").datetimepicker({
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
    $("#fecha_atencion").datetimepicker('setDate', new Date() );
    $("#fecha_denuncia").datetimepicker({
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
    $("#fecha_denuncia").datetimepicker('setDate', new Date() );
    $("#fecha_accidente").datetimepicker({
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
    $("#fecha_accidente").datetimepicker('setDate', new Date() );
    if(window.id_informe){
        mostrarDatosFormulario(tipo,window.buqueda_filtro[window.index_array_atencion_diaria])
    }
}

function mostrarSaludJugador(prevision){
    let texto_salud=[
        '',
        'Ninguna',
        'Fonasa A',
        'Fonasa B',
        'Fonasa C',
        'Fonasa D',
        'Fonasa C',
        'Isapre Banmedica',
        'Isapre Vida tres',
        'Isapre Colmena',
        'Isapre Consalud',
        'Isapre Cruz blanza',
        'Isapre Nueva Más Vida',
        'Capredena',
        'Dipreca',
        'Isapre Fusat',
        'Isapre Isalud',
        'PRAIS'
    ];
    return texto_salud[parseInt(prevision)]
}

function mostrarDatosLibreEleccion(tipo,seguimiento){
    // alert("OK")
    $("#numero_caso").val(seguimiento.numero_caso_seguimiento)
    $("#diagnostico").val(seguimiento.diagnostico_seguimiento)
    $("#fecha_accidente").val(seguimiento.fecha_accidente_seguimiento)
    $("#fecha_denuncia").val(seguimiento.fecha_denuncia_seguimiento)
    $("#fecha_plazo_maximo_30").val(seguimiento.fecha_plazo_maximo_30_seguimiento)
    $("#fecha_plazo_maximo_90").val(seguimiento.fecha_plazo_maximo_90_seguimiento)
    $("#fecha_plazo_maximo_180").val(seguimiento.fecha_plazo_maximo_180_seguimiento)
    $("#fecha_plazo_reembolzo").val(seguimiento.fecha_plazo_reembolzo_seguimiento)
    if(seguimiento.pendiente_ano_anterior_seguimiento!=null){
        $("#pendiente_ano").val(seguimiento.pendiente_ano_anterior_seguimiento)
    }
    if(seguimiento.entrega_documento_seguimiento!=null){
        $("#entrada_documentacion").val(seguimiento.entrega_documento_seguimiento)
    }
    if(seguimiento.continuidad_tratamiento_seguimiento!=null){
        $("#continuidad_tratamiento").val(seguimiento.continuidad_tratamiento_seguimiento)
    }
    if(seguimiento.comentario_caso!=null && seguimiento.comentario_caso!=""){
        $("#comentario_caso").val(seguimiento.comentario_caso)
    }
    $("#boton_agregar_infrome").prop("disabled",false)
}

function mostrarDatosLibreEleccionDefault(tipo,seguimiento){
    // alert("OK")
    $("#diagnostico").val(seguimiento.diagnostico_seguimiento)
    $("#fecha_accidente").val(seguimiento.fecha_accidente_seguimiento)
    let fecha=new Date(seguimiento.fecha_accidente_seguimiento)
    $("#fecha_plazo_maximo_30").datetimepicker({
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
    $("#fecha_plazo_maximo_30").datetimepicker('setDate', sumarDiasFecha(fecha,30) );
    $("#fecha_plazo_maximo_90").datetimepicker({
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
    $("#fecha_plazo_maximo_90").datetimepicker('setDate', sumarDiasFecha(fecha,90) );
    $("#fecha_plazo_maximo_180").datetimepicker({
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
    $("#fecha_plazo_maximo_180").datetimepicker('setDate', sumarDiasFecha(fecha,180) );
    $("#boton_agregar_infrome").prop("disabled",false)
}

function mostrarDatosCordinada(tipo,seguimiento){
    $("#contenedor_detalle_atencion").empty()
    window.contador_numero_detalle_atencion=0
    $("#numero_caso").val(seguimiento.numero_caso_seguimiento)
    $("#diagnostico").val(seguimiento.diagnostico_seguimiento)
    $("#fecha_accidente").val(seguimiento.fecha_accidente_seguimiento)
    $("#fecha_denuncia").val(seguimiento.fecha_denuncia_seguimiento)
    $("#fecha_atencion").val(seguimiento.fecha_atencion_seguimiento)
    if(seguimiento.comentario_caso!=null && seguimiento.comentario_caso!=""){
        $("#comentario_caso").val(seguimiento.comentario_caso)
    }
    if(seguimiento.centro_atencion_seguimiento!=null && seguimiento.centro_atencion_seguimiento!=""){
        $("#centro_atencion").val(seguimiento.centro_atencion_seguimiento )
    }
    if(seguimiento.centro_derivacion_seguimiento!=null && seguimiento.centro_derivacion_seguimiento!=""){
        $("#centro_derivacion").val(seguimiento.centro_derivacion_seguimiento)
    }
    if(seguimiento.medico_tratante_seguimiento!=null && seguimiento.medico_tratante_seguimiento!=""){
        $("#medico_tratante").val(seguimiento.medico_tratante_seguimiento)
    }
    for(let contador=0;contador<seguimiento.detalles_atencion_seguimiento.length;contador++){
        let detalle_atencion_seguimiento=seguimiento.detalles_atencion_seguimiento[contador]
        generarDetallesAtencion(detalle_atencion_seguimiento.fecha_atencion_detalle_atencion_seguimiento,detalle_atencion_seguimiento.centro_atencion_detalle_atencion_seguimiento,detalle_atencion_seguimiento.detalle_atencion_seguimiento)
    }
    $("#boton_agregar_infrome").prop("disabled",false)
    
}

function generarDetallesAtencion(fecha,centro,detalle){
    window.contador_numero_detalle_atencion++
    // console.log(window.contador_numero_detalle_atencion)
    let template_html_detalle_atencion=`
    <div style="display:flex;flex-direction:row;flex-wrap:wrap;width: 100%;height:auto;/*background:red*/;margin-top:15px;">
            <div style="/*background:blue;*/width: 15%;height: 49px;margin-right:2.5%;">
                <div style="display:block;">Fecha atención</div>
                <input type="text" readonly  style="display:block;width:100%;background:#fff;box-sizing: border-box;height: 29px;border:2px solid #bfbfbf;" id="fecha_detalle_atencion_${window.contador_numero_detalle_atencion}" name="array_fecha_detalle_atencion[]" onchange="" />                   
            </div>
            <div style="/*background:blue;*/width: 30%;height: 49px;margin-right:2.5%;">
            <div style="display:block;">Centro de atención</div>
                <input type="text"  style="display:block;width:100%;background:#fff;box-sizing: border-box;height: 29px;border:2px solid #bfbfbf;" id="centro_atencion_detalle_atencion_${window.contador_numero_detalle_atencion}" name="array_centro_atencion_detalle_atencion[]" onchange="" />                   
            </div>
            <div style="/*background:blue;*/width: 50%;height: 49px;">
            <div style="display:block;">Detalle atención</div>
                <input type="text" style="display:block;width:100%;background:#fff;box-sizing: border-box;height: 29px;border:2px solid #bfbfbf;" id="detalle_atencion_${window.contador_numero_detalle_atencion}" name="array_detalle_atencion[]" onchange="" />                   
            </div>
        </div>
    `
    $("#contenedor_detalle_atencion").append(template_html_detalle_atencion)
    $(`#fecha_detalle_atencion_${window.contador_numero_detalle_atencion}`).datetimepicker({
            language:  'es',
            format: 'yyyy-mm-dd hh:ii',
            //startDate: '2014-12-01',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            // minView: 2,
            forceParse: 0,
            autoclose: true,
            useCurrent: false
    });  
    $(`#fecha_detalle_atencion_${window.contador_numero_detalle_atencion}`).datetimepicker('setDate', new Date() );
    $(`#fecha_detalle_atencion_${window.contador_numero_detalle_atencion}`).val(fecha)
    $(`#centro_atencion_detalle_atencion_${window.contador_numero_detalle_atencion}`).val(centro)
    $(`#detalle_atencion_${window.contador_numero_detalle_atencion}`).val(detalle)
}

function agregarInformeDetalleAtencion(){
    window.contador_numero_detalle_atencion++
    // alert(contador_numero_detalle_atencion)
    let template_html_detalle_atencion=`
    <div style="display:flex;flex-direction:row;flex-wrap:wrap;width: 100%;height:auto;/*background:red*/;margin-top:15px;">
            <div style="/*background:blue;*/width: 15%;height: 49px;margin-right:2.5%;">
                <div style="display:block;">Fecha atención</div>
                <input type="text" readonly  style="display:block;width:100%;background:#fff;box-sizing: border-box;height: 29px;border:2px solid #bfbfbf;" id="fecha_detalle_atencion_${window.contador_numero_detalle_atencion}" name="array_fecha_detalle_atencion[]" onchange="" />                   
            </div>
            <div style="/*background:blue;*/width: 30%;height: 49px;margin-right:2.5%;">
            <div style="display:block;">Centro de atención</div>
                <input type="text"  style="display:block;width:100%;background:#fff;box-sizing: border-box;height: 29px;border:2px solid #bfbfbf;" id="centro_atencion_detalle_atencion_${window.contador_numero_detalle_atencion}" name="array_centro_atencion_detalle_atencion[]" onchange="" />                   
            </div>
            <div style="/*background:blue;*/width: 50%;height: 49px;">
            <div style="display:block;">Detalle atención</div>
                <input type="text" style="display:block;width:100%;background:#fff;box-sizing: border-box;height: 29px;border:2px solid #bfbfbf;" id="detalle_atencion_${window.contador_numero_detalle_atencion}" name="array_detalle_atencion[]" onchange="" />                   
            </div>
        </div>
    `
    $("#contenedor_detalle_atencion").append(template_html_detalle_atencion)
    $(`#fecha_detalle_atencion_${window.contador_numero_detalle_atencion}`).datetimepicker({
            language:  'es',
            format: 'yyyy-mm-dd hh:ii',
            //startDate: '2014-12-01',
            weekStart: 1,
            todayBtn:  1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            // minView: 2,
            forceParse: 0,
            autoclose: true,
            useCurrent: false
    });  
    $(`#fecha_detalle_atencion_${window.contador_numero_detalle_atencion}`).datetimepicker('setDate', new Date() );
}

function ajustarFechasPlazoMaximo(valor){

    let fecha_accidente=valor
    let fecha=new Date()
    fecha.setDate(parseInt(fecha_accidente.split("-")[2]))
    fecha.setMonth(parseInt(fecha_accidente.split("-")[1])-1)
    fecha.setFullYear(fecha_accidente.split("-")[0])

    $("#fecha_plazo_maximo_30").datetimepicker({
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
    $("#fecha_plazo_maximo_30").datetimepicker('setDate', sumarDiasFecha(fecha,30) );
    $("#fecha_plazo_maximo_90").datetimepicker({
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
    $("#fecha_plazo_maximo_90").datetimepicker('setDate', sumarDiasFecha(fecha,90) );
    $("#fecha_plazo_maximo_180").datetimepicker({
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
    $("#fecha_plazo_maximo_180").datetimepicker('setDate', sumarDiasFecha(fecha,180) );
}

function mostrarModalFormularioEnviarDatos(){
    if(!window.id_informe){
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar un nuevo seguimiento?</h5><br><img src="../config/agregar_archivo.png">');
    }
    else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar este seguimiento?</h5><br><img src="../config/agregar_archivo.png">');
    }
    $("#contendor_botones_modal").empty()
    $("#contendor_botones_modal").html(`
        <button type="button" class="btn btn-default boton_modal" onClick="cerrarModalFormularioEnviarDatos()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>
        <button type="button" id="guardar" class="btn btn-default boton_modal " onClick="enviarDatos()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> 
    `)
    $('#modalSeguimiento').modal('show');
}

function cerrarModalFormularioEnviarDatos(){
    $('#modalSeguimiento').modal('hide');
}

function enviarDatos(){
    let tipo_modalidad_seguimiento=$("#modalidad_tipo_formulario").val()
    if(!window.id_informe){
		$('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando atencion ...</h5><br><img src="../config/agregar_archivo.png">');
	}else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando atencion ...</h5><br><img src="../config/agregar_archivo.png">');
	}
    let datos_formulario=$("#formulario_seguimiento").serializeArray()
    if(tipo_modalidad_seguimiento==="1"){
        datos_formulario.push({name:"id_informe",value:window.id_informe})
        datos_formulario.push({name:"id_ficha_jugador",value:window.id_ficha_jugador})
        datos_formulario.push({name:"nombre_usuario_software",value:window.nombre_usuario_software})
        datos_formulario.push({name:"idseguimiento",value:window.id_seguimiento})
        console.log(datos_formulario)

        $.ajax({
                url: "post/seguimiento_guardar.php",
                type: "post",
                data:datos_formulario
                ,success: function(respuesta) {
                    var json=JSON.parse(respuesta);
                    console.log(json)
                    $('#modalSeguimiento').modal('hide');
                    // consulatarDespuesDeRegistrar_Actualizar_Eliminar()
                    botonVolver()
                    
                },error: function(){// will fire when timeout is reached
                    // alert("errorXXXXX");
                }, timeout: 10000 // sets timeout to 3 seconds
            });
    }
    if(tipo_modalidad_seguimiento==="2"){
        datos_formulario.push({name:"id_informe",value:window.id_informe})
        datos_formulario.push({name:"id_ficha_jugador",value:window.id_ficha_jugador})
        datos_formulario.push({name:"nombre_usuario_software",value:window.nombre_usuario_software})
        datos_formulario.push({name:"idseguimiento",value:window.id_seguimiento})
        console.log(datos_formulario)

        $.ajax({
                url: "post/seguimiento_guardar.php",
                type: "post",
                data:datos_formulario
                ,success: function(respuesta) {
                    var json=JSON.parse(respuesta);
                    console.log(json)
                    $('#modalSeguimiento').modal('hide');
                    // consulatarDespuesDeRegistrar_Actualizar_Eliminar()
                    botonVolver()
                    
                },error: function(){// will fire when timeout is reached
                    // alert("errorXXXXX");
                }, timeout: 10000 // sets timeout to 3 seconds
            });
    }
}

function cargarOpionSelectSerieFiltro(){
    let series_array=[
    //serie masculina
    {numero_serie:"0",nombre_serie:"Seleccione una serie"},
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
    let list_option_serie=series_array.map(serie=> {
        return `<option id="option_select_serie_filtro_${serie.numero_serie}" value="${serie.numero_serie}" >${serie.nombre_serie}</option>`
    })
    for(let contador=0;contador<list_option_serie.length;contador++){
        $("#serie_filtro").append(list_option_serie[contador])
    }
}

function fechaInicioFiltroPrimero(){
    $("#fecha_inicio").datetimepicker({
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
    let fecha=new Date()
    fecha.setDate(1)
    $("#fecha_inicio").datetimepicker('setDate', fecha);
}
function fechaFinalFiltro(){
    $("#fecha_final").datetimepicker({
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
    $("#fecha_final").datetimepicker('setDate', new Date() );
}



function consultarJugadoreXSeriesFiltro(serie_select){
    $("#jugador_filtro").empty()
    $("#texto_boton_filtro_jugador").text(`Seleccione a un jugador`)
    window.jugadores_filtro=[]
    // window.jugadores_filtro.push({idfichaJugador:0,nombre:"Todos"})
    if(serie_select!=="0"){
        const serie=serie_select.split("_")[0]
        const sexo=serie_select.split("_")[1]
        $.ajax({
                url: `post/seguimiento_consultar_jugador.php?serie=${serie}&sexo=${sexo}`,
                type: "get"
                ,success: function(respuesta) {
                    var json=JSON.parse(respuesta);
                    window.jugadores_filtro=json.respuesta
                    let array=jugadores_filtro
            },error: function(){// will fire when timeout is reached
                // alert("errorXXXXX");
            }, timeout: 10000 // sets timeout to 3 seconds
        });
    }
}


// modal

function verAtencionDiaria(posicion){
    let seguimiento=window.buqueda_filtro[posicion]
    $("#tabla_detalle_atencion_seguimiento").empty()
    $("#numero_caso_encabezado").empty()
    $("#contenedor_foto_jugador").html(`<img style="width:100%;height:100%;border-radius: 67px;" src="./foto_jugadores/${seguimiento.idfichaJugador}.png"/>`)
    $("#nombre_jugador").text(`${seguimiento.nombre} ${seguimiento.apellido1} ${seguimiento.apellido2}`)
    let texto_serie=""
    if(seguimiento.sexo==="1"){
        if(seguimiento.serieActual==="99"){
            texto_serie="PRIMER EQUIPO"
        }
        if(seguimiento.serieActual!="99"){
            texto_serie="Sub  "+seguimiento.serieActual
        }
    }
    else{
        if(seguimiento.serieActual==="99" ){
            texto_serie="ADULTA FEMENINA"
        }
        if(seguimiento.serieActual!="99"){
            texto_serie="Sub  "+seguimiento.serieActual
        }
    }
    // let serie=(atencion_diaria.serieActual==="99")?"Primer equipo":""
    $("#numero_caso_encabezado").text(seguimiento.numero_caso_seguimiento)


    $("#serie_jugador_modal").text(texto_serie)
    switch(seguimiento.modalidad_seguimiento){
        case "1":
            $("#tabla_detalle_atencion_seguimiento").html(tablaModalidadLibreEleccion(seguimiento))
            $("#modalVerJugador").modal("show")
        ;break;
        case "2":
            $("#tabla_detalle_atencion_seguimiento").html(tablaModalidadCordinada(seguimiento))
            $("#modalVerJugador").modal("show")
        ;break;
        default:
            $("#tabla_detalle_atencion_seguimiento").html(tablaModalDefault(seguimiento))
            $("#modalVerJugador").modal("show")
        ;break;
    }
    
}

function tablaModalidadLibreEleccion(seguimiento){
    const template=`
    <div class="row_tabla">
        <span class="celda_propiedad">Modalidad</span>
        <span class="celda_valor">${(seguimiento.modalidad_seguimiento==="1")?"Libre Elección":"Cordinada"}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Previsión</span>
        <span class="celda_valor">${mostrarSaludJugador(seguimiento.prevision)}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Diagnostico</span>
        <span class="celda_valor">${seguimiento.diagnostico_seguimiento}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Fecha accidente</span>
        <span class="celda_valor">${formatofecha(seguimiento.fecha_accidente_seguimiento)}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Fecha denuncia</span>
        <span class="celda_valor">${formatofecha(seguimiento.fecha_denuncia_seguimiento)}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Entrega Documentación</span>
        <span class="celda_valor" style="background-color:${(seguimiento.entrega_documento_seguimiento==="1")?"#fff;color:#555;":"#ec7d7c;color:#fff;"}">${(seguimiento.entrega_documento_seguimiento==="1")?"Si":"No"}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Continuidad tratamiento</span>
        <span class="celda_valor">${(seguimiento.continuidad_tratamiento_seguimiento==="1")?"Si":"No"}</span>
    </div>
    <div class="row_tabla" style="height:100px">
        <span class="celda_propiedad" style="padding-top: 41px;">Comentarios del caso</span>
        <span class="celda_valor">${(seguimiento.comentario_caso!=null)?seguimiento.comentario_caso:"Sin comentario"}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Plazo máximo 30 días</span>
        <span class="celda_valor">${formatofecha(seguimiento.fecha_plazo_maximo_30_seguimiento)}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Plazo máximo 90 días</span>
        <span class="celda_valor">${formatofecha(seguimiento.fecha_plazo_maximo_90_seguimiento)}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Plazo máximo 180 días</span>
        <span class="celda_valor">${formatofecha(seguimiento.fecha_plazo_maximo_180_seguimiento)}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Fecha denuncia</span>
        <span class="celda_valor">${formatofecha(seguimiento.fecha_plazo_reembolzo_seguimiento)}</span>
    </div>
    
    `
    return template
}

function tablaModalDefault(seguimiento){
    const template=`
    <div class="row_tabla">
        <span class="celda_propiedad">Previsión</span>
        <span class="celda_valor">${mostrarSaludJugador(seguimiento.prevision)}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Diagnostico</span>
        <span class="celda_valor">${seguimiento.diagnostico_seguimiento}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Fecha accidente</span>
        <span class="celda_valor">${formatofecha(seguimiento.fecha_accidente_seguimiento)}</span>
    </div>
    `
    return template
}

function tablaModalidadCordinada(seguimiento){
    const template=`
    <div class="row_tabla">
        <span class="celda_propiedad">Modalidad</span>
        <span class="celda_valor">${(seguimiento.modalidad_seguimiento==="1")?"Libre Elección":"Cordinada"}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Previsión</span>
        <span class="celda_valor">${mostrarSaludJugador(seguimiento.prevision)}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Diagnostico</span>
        <span class="celda_valor">${seguimiento.diagnostico_seguimiento}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Fecha accidente</span>
        <span class="celda_valor">${formatofecha(seguimiento.fecha_accidente_seguimiento)}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Fecha denuncia</span>
        <span class="celda_valor">${formatofecha(seguimiento.fecha_denuncia_seguimiento)}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Fecha atención</span>
        <span class="celda_valor">${formatofecha(seguimiento.fecha_atencion_seguimiento)}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Centro de atención</span>
        <span class="celda_valor">${seguimiento.centro_atencion_seguimiento}</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Centro de derivación</span>
        <span class="celda_valor">${seguimiento.centro_derivacion_seguimiento }</span>
    </div>
    <div class="row_tabla">
        <span class="celda_propiedad">Médico tratante</span>
        <span class="celda_valor">${seguimiento.medico_tratante_seguimiento}</span>
    </div>
    <div class="row_tabla" style="height:100px">
        <span class="celda_propiedad" style="padding-top: 41px;">Comentarios del caso</span>
        <span class="celda_valor">${(seguimiento.comentario_caso!=null)?seguimiento.comentario_caso:"Sin comentario"}</span>
    </div>

    
    `
    return template
}

function formatofecha(fecha){
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
    ]

    let dia_semana=[
        "Domingo",
        "Lunes",
        "Martes",
        "Miercoles",
        "Jueves",
        "Viernes",
        "Sabado"
    ]
    let ano=fecha.split("-")[0]
    let mes=fecha.split("-")[1]
    let dia=fecha.split("-")[2]
    let fecha_date=new Date()
    fecha_date.setDate(parseInt(dia))
    fecha_date.setMonth(parseInt(mes)-1)
    fecha_date.setFullYear(parseInt(ano))

    return `${dia_semana[fecha_date.getDay()]} ${fecha_date.getDate()} de ${lista_meses[fecha_date.getMonth()]} ${fecha_date.getFullYear()}`

}


//validaciones

function validarCampoVacio(selector){
    let valor=$(`#${selector}`).val()
    let estado=false
    let expresion=/[A-Za-z] || [0-9]/
    if(valor!=""){
        if(expresion.test(valor)){
            estado=true 
        }
    }
    return estado
}

function validarCampoNumerico(selector){
    let valor=$(`#${selector}`).val()
    let estado=false
    let expresion=/[0-9]/
    if(valor!=""){
        if(expresion.test(valor)){
            estado=true 
        }
    }
    return estado
}

function validarFormulario(){
    let estado_numero_caso=validarCampoNumerico("numero_caso"),
    estado_diagnostico=validarCampoVacio("diagnostico")
    // boton_agregar_infrome
    if(estado_numero_caso && estado_diagnostico){
        $("#boton_agregar_infrome").prop("disabled",false)
    }
    else{
        $("#boton_agregar_infrome").prop("disabled",true)
    }



}






</script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script>
    cargarOpionSelectSerieFiltro()
    fechaFinalFiltro()
    fechaInicioFiltroPrimero()
    buscarSeguimientos()
    mostrar_al_cargar_pagina()
    $(document).on('click', '.option', function(e) { //
        e.stopPropagation();
    });
    $('.c_objetivo_fisico li').click(function (e) { e.stopPropagation(); });

    function contarJugadoresSeleccionados(){//buscarAtencionesDiariasFiltro
        // const lista_alta_deportiva=[
        //     {idalta_deportiva:1,alta_deportiva:"entrenamiento"},
        //     {idalta_deportiva:2,alta_deportiva:"partido"}
        // ]
        let array_checkbox_jugadores = $('input[name="array_checkbox_seguimiento_filtro_jugador[]"]:checked').map(function(){ 
            return this.value; 
        }).get();
        console.log(jugadores_filtro    )
        if(array_checkbox_jugadores.length===1){
            let jugador_filtrado=window.jugadores_filtro.filter(jugador => jugador.idfichaJugador===array_checkbox_jugadores[0])
            $("#texto_boton_filtro_jugador").text(`${jugador_filtrado[0].nombre} ${jugador_filtrado[0].apellido1} ${jugador_filtrado[0].apellido2}`)
        }   
        else{
            if(array_checkbox_jugadores.length>1){
            $("#texto_boton_filtro_jugador").text(`${array_checkbox_jugadores.length} elementos seleccionados`)
            }
            else{
                $("#texto_boton_filtro_jugador").text(`Seleccione a un jugador`)
            }
        }
        buscarSeguimientos()

    }

    $("#boton_jugador").on("click",()=>{
        const lis=window.jugadores_filtro.map((jugador)=>{
            /*en esta variable almacenamos el nombre de la funcion que ejecutara el checkbox al hacer onclick
            si la condicion es true significa que el checkbox tiene el metodo para activar o desactivar los demas checkbox (selecionarTodosAreaFiltro)
            en el filtro y asubes realiza una consulta al servidor y es caso que sea false solo tiene el metodo que ejecuta una consulta al servidor del cual es (buscarAtencionesDiariasFiltro)
            */
            const funcion=(jugador.idfichaJugador==0)?'selecionarTodosTipoAtencionFiltro':'contarJugadoresSeleccionados'
            if(jugador.idfichaJugador==0){
                return `<li ><label class='option'><span class='label_s' style="font-size:13px;">${jugador.nombre}</span> <input type='checkbox' id='checkbox_seguimiento_filtro_jugador_${jugador.idfichaJugador}' data-eliminar='0' onclick='${funcion}()' ></label></li>`
            }
            else{
                return `<li "><label class='option'><span class='label_s' style="font-size:13px;">${jugador.nombre} ${jugador.apellido1} ${jugador.apellido2}</span> <input type='checkbox' id='checkbox_seguimiento_filtro_jugador_${jugador.idfichaJugador}' name='array_checkbox_seguimiento_filtro_jugador[]' value='${jugador.idfichaJugador}' data-eliminar='0' onclick='${funcion}()' ></label></li>`
            }
        })
        if($("#jugador_filtro").html()!=""){
            console.log("no esta basio")
        }
        else{
            console.log("esta basio")
            lis.map((lista)=>{
                $("#jugador_filtro").html($("#jugador_filtro").html()+lista)
            })
        }
    });
</script>
