<?PHP
include('../config/datos.php');
session_start();
if(!(isset($_SESSION["nombre_usuario_software"]))){
    session_destroy();
    header('Location: ../index.php?cerrar_sesion=1');
}
else{
    $menu_actual="centro_m";
    $submenu_actual="centro_medico";
    $seccion_comentarios = $comentarios['centro_medico'];//mis cuotas
    $demo_seccion = $demo['centro_medico'];
    $nombre_pestana_navegador='Centro';

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
        <title><?php echo $nombre_pestana_navegador;?> | medico</title>

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
                            width: 60%;
                            height: 80%;
                            left: 0%;
                            background-color: #fff;
                            margin-left: 20%;
                            margin-right: 20%;
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
        <div id="content" style="background-color:#303030;height: 1610px;">
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
            <div  style="display:none;" id="pagina" style="padding:0px;height: 601px;">
                <?php if(($software_demo && $demo_seccion) || !$software_demo){?>
                    <!-- #303030 -->
                    <!-- #25282a -->
                    <!-- #39b682 -->
                    <!-- #ff5b4d -->
                    <!-- #404040 -->
                    <!-- #a2a2a2 -->
                    <div style="box-sizing:border-box;border:0;display:block;position: absolute;width:100px;height:100px;/*background-color:lime;*/margin-top:-25px;">
                        <img style="box-sizing:border-box;width:100%;height:100%;" src="../config/logo_equipo.png" alt="imagen logo equipo"/>
                    </div>
                    <div style="box-sizing:border-box;border:0;width:100%;height:50px;background-color:#595959;margin-top:35px;margin-bottom: 35px;">
                        <div style="box-sizing:border-box;border:0;/*display:inline-block;*/float:left;width:40%;height:100%;/*background:lime*/;color:#fff;padding-left:100px;">
                            <h3>CENTRO MÉDICO</h3>
                        </div>
                        <div style="box-sizing:border-box;border:0;/*display:inline-block;*/float:left;width:60%;height:100%;/*background:lime;*/color:#fff;">
                            <div style="box-sizing:border-box;border:0;display:inline-flex;flex-direction:row;flex-wrap:wrap;justify-content:space-evenly;align-items:flex-end;width:100%;height:100%;">
                                <div id="seccion-radio-resume" style="box-sizing:border-box;border:0;background-color:#303030;width:15%;height:30px;text-align:center;cursor:pointer;">
                                    <label for="radio-resume" style="width:100%;height:100%;line-height:30px;font-weight: bold;font-size:12px;">Resume</label>
                                    <!-- </br> -->
                                    <input type="radio" name="seccion" style="display:none;" onChange="mostrarSeccion(this)" id="radio-resume">
                                </div>
                                <div id="seccion-radio-historial" style="box-sizing:border-box;border:0;background-color:#303030;width:15%;height:30px;text-align:center;line-height:30px;font-weight: bold;cursor:pointer;">
                                    <label for="radio-historial" style="width:100%;height:100%;line-height:30px;font-weight: bold;font-size:12px;">
                                        Historial
                                    </label>
                                    <!-- </br> -->
                                    <input type="radio" name="seccion" style="display:none;" onChange="mostrarSeccion(this)" id="radio-historial">
                                </div>
                                <div id="seccion-radio-disponibilidad" style="box-sizing:border-box;border:0;background-color:#303030;width:15%;height:30px;text-align:center;line-height:30px;font-weight: bold;cursor:pointer;">
                                    <label for="radio-disponibilidad" style="width:100%;height:100%;line-height:30px;font-weight: bold;font-size:12px;">
                                    Disponibilidad
                                    </label>
                                    <!-- </br> -->
                                    <input type="radio" name="seccion" style="display:none;" onChange="mostrarSeccion(this)" id="radio-disponibilidad">
                                </div>
                                <div id="seccion-radio-jugador" style="box-sizing:border-box;border:0;background-color:#303030;width:15%;height:30px;text-align:center;line-height:30px;font-weight: bold;cursor:pointer;">
                                    <label for="radio-jugador" style="width:100%;height:100%;line-height:30px;font-weight: bold;font-size:12px;">
                                        Jugador
                                    </label>
                                    <!-- </br> -->
                                    <input type="radio" name="seccion" style="display:none;" onChange="mostrarSeccion(this)" id="radio-jugador">
                                    
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- MODAL RESUME JUAGDOR INICIO  -->
                    <div id="modalVerJugadorResume" class="modal hide contenedor_modal_jugador" style="padding-top:10px;">
                        <div style="box-sizing:border-box;border:0;width: 100%;height:112px;">
                            <div style="box-sizing:border-box;border:0;width: 15%;height:100%;float:left;">
                                <img style="box-sizing:border-box;border:0;width:100%;height:100%;" src="../config/logo_equipo.png">
                            </div>
                            <div style="box-sizing:border-box;border:0;width: 70%;height:100%;float:left;">
                                <div style="box-sizing:border-box;border:0;width: 100%;height:50%;float:left;font-size:1.5em;font-weight: bold;line-height:85px;text-align:center;">
                                    INFORME MÉDICO
                                </div>
                                <div id="titulo_modal_nombre_jugador" style="box-sizing:border-box;border:0;width: 100%;height:50%;float:left;font-size:1.5em;font-weight: normal;line-height:56px;text-align:center;">
                                    
                                </div>
                        
                            </div>
                            <div id="contendor_foto_jugador_modal" style="box-sizing:border-box;border:0;width: 15%;height:100%;float:left;border-radius:58px;border: 2px solid #555;overflow:hidden;">
                                <!-- <img style="box-sizing:border-box;border:0;width:100%;height:100%;" src="./foto_jugadores/jugador100.png"> -->
                                <!-- <img style="box-sizing:border-box;border:0;width:100%;height:100%;" src="./foto_jugadores/jugador100.png"> -->
                            </div>
                        </div>
                        <hr style="width: 88%;margin-left: auto;margin-right: auto;background-color: #8d8d8d;">
                        <span style="width:50%;text-align:center;margin-left: 25%;margin-right: 25%;display:block;margin-bottom: 10px;font-weight: bold;color:#464646">DETALLE DEL INFORME MÉDICO:</span>
                        <div style="margin-bottom:20px;height:auto;"  class="tabla_detalle_atencion_seguimiento" id="tabla_detalle_resume_jugador">
                    
                    
                    
                    
                            <div class="row_tabla">
                                <span class="celda_propiedad" style="background-color:#fff;color:#111;">Jugador</span>
                                <span class="celda_valor" id="valor_modal_nombre_jugador"></span>
                            </div>
                            <div class="row_tabla">
                                <span class="celda_propiedad"  style="background-color:#fff;color:#111;">Edad</span>
                                <span class="celda_valor" id="valor_modal_edad_jugador"></span>
                            </div>
                            <div class="row_tabla">
                                <span class="celda_propiedad" style="background-color:#fff;color:#111;">Posición</span>
                                <span class="celda_valor" id="valor_modal_posicion_jugador"></span>
                            </div>
                            <div class="row_tabla">
                                <span class="celda_propiedad" style="background-color:#fff;color:#111;">Diagnostico</span>
                                <span class="celda_valor" id="valor_modal_diagnostico_informe"></span>
                            </div>
                            <div class="row_tabla">
                                <span class="celda_propiedad" style="background-color:#fff;color:#111;">Fecha lesion</span>
                                <span class="celda_valor" id="valor_modal_fecha_lesion"></span>
                            </div>
                            <div class="row_tabla">
                                <span class="celda_propiedad" style="background-color:#fff;color:#111;">Contexto</span>
                                <span class="celda_valor" id="valor_modal_contexto"></span>
                            </div>
                            <div class="row_tabla">
                                <span class="celda_propiedad" style="background-color:#fff;color:#111;">Patología</span>
                                <span class="celda_valor" id="valor_modal_patologia"></span>
                            </div>
                            
                            <div class="row_tabla">
                                <span class="celda_propiedad" style="background-color:#fff;color:#111;">Zona anatómica</span>
                                <span class="celda_valor" id="valor_modal_zona_anatomica"></span>
                            </div>
                            <div class="row_tabla">
                                <span class="celda_propiedad" style="background-color:#fff;color:#111;">Examenes realizados</span>
                                <span class="celda_valor" id="valor_modal_examenes_realizados"></span>
                            </div>
                            <div class="row_tabla">
                                <span class="celda_propiedad" style="background-color:#fff;color:#111;">Tipo</span>
                                <span class="celda_valor" id="valor_modal_tipo_informe_medico"></span>
                            </div>
                            <div class="row_tabla">
                                <span class="celda_propiedad" style="background-color:#fff;color:#111;">Recivida</span>
                                <span class="celda_valor" id="valor_modal_recivida"></span>
                            </div>
                            <div class="row_tabla" style="height:100px">
                                <span class="celda_propiedad"  style="background-color:#fff;color:#111;text-align: center;line-height: 98px;font-weight: bold;" >informe médico</span>
                                <span class="celda_valor" id="valor_modal_informe_medico"></span>
                            </div>
                        </div>
                    </div>
                    <!-- MODAL RESUME JUAGDOR FIN  -->
                    <div id="contenedor_resume" style="box-sizing:border-box;border:0;width: 100%;display:none;">
                        <div class="contenedor_filtro_resume" style="box-sizing:border-box;border:0;Width:100%;">
                            <div style="width:30%;display:flex;margin-left:auto;margin-right:auto;margin-bottom:15px">
                                <a class="btn btn-md btn-primary green-a" style="width: 42%;height: 20px;background:#404040;border:2px solid #8a8a8a;padding-bottom:2px;">
                                    <div>
                                        <p class="ellipsis-text" style="font-weight: bold;">SERIE</p>
                                    </div>
                                </a>
                                <select style="width:47%; height: 30px;background:#fff;border:2px solid #8a8a8a" class="" id="serie_filtro_resume" name="serie_filtro_resume" onchange="consultarJugadoresSerieSinAlta(this.value)">
                                    <option value="0_0">Seleccione</option>
                                    <option value="99_1">Primer equipo</option>
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
                                    <option value="99_2">ADULTA FEMENINA</option>
                                    <option value="17_2">Sub 17 ADULTA FEMENINA</option>
                                    <option value="15_2">Sub 15 ADULTA FEMENINA</option>
                                </select>
                            </div>
                        </div>
                        <div style="box-sizing:border-box;border:0;width:90%;height:42px;/*background-color:lime*/;margin-left:auto;margin-right:auto;margin-bottom: 15px;">
                            <div style="box-sizing:border-box;border:0;display:inline-flex;flex-direction:row;flex-wrap:wrap;justify-content:space-between;width:100%;height:100%;">
                                <div style="box-sizing:border-box;border:0;width:22%;height:100%;border-radius:10px;background-color:#39b682;text-align:center;font-size:12px;font-weight: bold;">
                                    <div style="color:#fff;">JUGADORES DISPONIBLES</div>
                                    <div style="color:#fff;" id="numero_jugadores_disponibles">0</div>
                                </div>
                                <div style="box-sizing:border-box;border:0;width:22%;height:100%;border-radius:10px;background-color:#ff5b4d;text-align:center;font-size:12px;font-weight: bold;">
                                    <div style="color:#fff;">JUGADORES SIN ALTA MÉDICA</div>
                                    <div style="color:#fff;" id="numero_jugadores_sin_alta_medica">0</div>
                                </div>
                                <div style="box-sizing:border-box;border:0;width:22%;height:100%;border-radius:10px;background-color:#ff5b4d;text-align:center;font-size:12px;font-weight: bold;">
                                    <div style="color:#fff;">JUGADORES SIN ALTA DEPORTIVA</div>
                                    <div style="color:#fff;" id="numero_jugadores_sin_alta_deportiva">0</div>
                                </div>
                                <div style="box-sizing:border-box;border:0;width:22%;height:100%;border-radius:10px;background-color:#39b682;text-align:center;font-size:12px;font-weight: bold;">
                                    <div style="color:#fff;">ATENCIONES DIARIAS DE HOY</div>
                                    <div style="color:#fff;" id="numero_atenciones_diarias_hoy">0</div>
                                </div>

                            </div>    
                        

                        </div>
                        <div style="box-sizing:border-box;border:0;display:block;width:95%;height:1000px;/*background:lime;*/margin-left:auto;margin-right:auto;">
                            <div style="box-sizing:border-box;border:0;display:inline-flex;flex-direction:row;flex-wrap:wrap;justify-content:space-between;width:100%;">
                            <!-- overflow:scroll;overflow-x:hidden; -->
                                <div style="box-sizing:border-box;border:0;width:70%;height:300px;background-color: #595959;border: 2px solid #8a8a8a;margin-bottom:15px;">
                                    <div style="box-sizing:border-box;border:0;width:100%;height:22px;font-size:12px;color:#fff;font-weight: bold;text-align:center;background-color:#ff5b4d;border-bottom: 2px solid #8a8a8a;">
                                        JUGADORES SIN ALTA
                                    </div>
                                    <div id="contenedor_jugadores_sin_alta" style="box-sizing:border-box;border:0;width:100%;height: 273px;padding-top:5px;">
                                        <table style="width:95%;margin-left:auto;margin-right:auto;">
                                            <thead>
                                                <tr style="background-color:#303030; color:white;">
                                                    <th scope="col" style="padding-left:10px;/*background:red;*/border-top-left-radius:5px;border-bottom-left-radius:5px;text-align: left;font-size: 10px;width: 109px;">JUGADOR</th>
                                                    <th scope="col" style="padding-left:10px;/*background:purple;*/cursor:pointer;width: 166px;">
                                                    <div class="tip-top" data-original-title="Fecha atención" style="width:100%;text-align: left;font-size: 10px;">DIAGNOSTICO</div>
                                                    </th>
                                                    <th scope="col" style="padding-left:10px;/*background:blue;*/cursor:pointer;width: 63px;">
                                                    <div class="tip-top" data-original-title="jugador atendido" style="width:100%;text-align:left;font-size: 10px;">FECHA LESION</div>
                                                    </th>
                                                    <th scope="col" style="padding-left:10px;/*background:lime;*/border-top-right-radius:5px;border-bottom-right-radius:5px;cursor:pointer;width: 55px;" >
                                                    <div class="tip-top" data-original-title="rut" style="width:100%;text-align:center;font-size: 10px;">BAJA</div>
                                                    </th style="">
                                                    
                                                </tr>
                                            </thead>
                                            <tbody id="contenido_tabla" >
                                               
                                            </tbody>
                                        </table>
                                
                                    </div>


                                    
                                </div>

                                <div style="box-sizing:border-box;border:0;width:29%;height:300px;background-color: #595959;border: 2px solid #8a8a8a;margin-bottom:15px;">
                                    <div style="box-sizing:border-box;border:0;width:100%;font-size:12px;color:#fff;font-weight: bold;text-align:center;background-color:#ff5b4d;border-bottom: 2px solid #8a8a8a;">
                                        DISTRIBUCIÓN POR TIPO DE LESIÓN
                                    </div>
                                </div>

                                <div style="box-sizing:border-box;border:0;width:100%;height:300px;background-color: #595959;border: 2px solid #8a8a8a;margin-bottom:15px;">
                                    <div style="box-sizing:border-box;border:0;width:100%;font-size:12px;color:#fff;font-weight: bold;text-align:center;background-color:#ff5b4d;border-bottom: 2px solid #8a8a8a;">
                                        LESIONES POR MES
                                    </div>
                                </div>

                                <div style="box-sizing:border-box;border:0;width:35%;height:330px;background-color: #595959;border: 2px solid #8a8a8a;margin-bottom:15px;">
                                    <div style="box-sizing:border-box;border:0;width:100%;font-size:12px;color:#fff;font-weight: bold;text-align:center;background-color:#ff5b4d;border-bottom: 2px solid #8a8a8a;">
                                        ZONAS ANATÓMICAS AFECTADAS
                                    </div>
                                </div>

                                <div style="box-sizing:border-box;border:0;width:64%;height:330px;background-color: #595959;border: 2px solid #8a8a8a;margin-bottom:15px;">
                                    <div style="box-sizing:border-box;border:0;width:100%;font-size:12px;color:#fff;font-weight: bold;text-align:center;background-color:#ff5b4d;border-bottom: 2px solid #8a8a8a;">
                                        MUSCULOS AFECTADOS
                                    </div>
                                </div>
                                <div style="box-sizing:border-box;border:0;width:40%;height:330px;background-color: #595959;border: 2px solid #8a8a8a;margin-bottom:15px;">
                                    <div style="box-sizing:border-box;border:0;width:100%;font-size:12px;color:#fff;font-weight: bold;text-align:center;background-color:#ff5b4d;border-bottom: 2px solid #8a8a8a;">
                                        SEVERIDAD DE LAS LESIONES
                                    </div>
                                </div>

                                <div style="box-sizing:border-box;border:0;width:59%;height:330px;background-color: #595959;border: 2px solid #8a8a8a;margin-bottom:15px;">
                                    <div style="box-sizing:border-box;border:0;width:100%;font-size:12px;color:#fff;font-weight: bold;text-align:center;background-color:#ff5b4d;border-bottom: 2px solid #8a8a8a;">
                                        CONTEXTO DE LA LESIÓN
                                    </div>
                                </div>
                                
                        
                            </div>
                        </div>
                    </div>














                    <div id="contenedor_historial_lesiones" style="box-sizing:border-box;border:0;width: 100%;display:none;">
                        <form id="filtros_historial_lesiones" class="contenedor_filtro_historial_lesiones" style="box-sizing:border-box;border:0;Width:100%;display:flex;flex-direction:row;flex-wrap:wrap;justify-content:flex-end;">
                            <div style="width:18%;margin-right:26.6px;display:flex;margin-bottom:15px">
                                <a class="btn btn-md btn-primary green-a" style="width: 42%;height: 20px;background:#404040;border:2px solid #8a8a8a;padding-bottom:2px;">
                                    <div>
                                        <p class="ellipsis-text" style="font-weight: bold;">SERIE</p>
                                    </div>
                                </a>
                                <select style="width:47%; height: 30px;background:#fff;border:2px solid #8a8a8a" class="" id="serie_filtro_historial_lesiones" name="serie_filtro_historial_lesiones" onchange="consultarJugadoresSerie(this.value)">
                                    <option value="0_0">Seleccione</option>
                                    <option value="99_1">Primer equipo</option>
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
                                    <option value="99_2">ADULTA FEMENINA</option>
                                    <option value="17_2">Sub 17 ADULTA FEMENINA</option>
                                    <option value="15_2">Sub 15 ADULTA FEMENINA</option>
                                </select>
                            </div>



                            <div style="width:18%;margin-right:26.6px;display:flex;margin-bottom:15px">
                                <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#404040;border:2px solid #8a8a8a;height: 18.5px;"><div><p class="ellipsis-text" style="font-weight: bold;">Jugador</p></div></a>
                                <div class="btn-group c_objetivo_fisico " style="width: 50%;">
                                    <button id="boton_jugador_historial_lesion" type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border:2px solid #8a8a8a; background-color: #fff;">
                                        <p class="titulo_multi ellipsis-text">
                                            <span id="texto_boton_filtro_jugador_historial_lesion">Seleccione a un jugador</span>
                                        </p> 
                                        <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span>
                                    </button>
                                        <ul id="jugador_filtro_historial_lesion" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                                </div>                    
                            </div> 




                            <div style="width:18%;margin-right:26.6px;display:flex;margin-bottom:15px">
                                <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#404040;border:2px solid #8a8a8a;height: 18.5px;"><div><p class="ellipsis-text" style="font-weight: bold;">AÑO</p></div></a>
                                <div class="btn-group c_objetivo_fisico " style="width: 50%;">
                                    <button id="boton_ano_historial_lesion" type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border:2px solid #8a8a8a; background-color: #fff;">
                                        <p class="titulo_multi ellipsis-text">
                                            <span id="texto_boton_filtro_ano_historial_lesion">Seleccione un Año</span>
                                        </p> 
                                        <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span>
                                    </button>
                                        <ul id="ano_filtro_historial_lesion" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                                </div>                    
                            </div> 






                            <div style="width:18%;margin-right:26.6px;display:flex;margin-bottom:15px">
                                <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#404040;border:2px solid #8a8a8a;height: 18.5px;"><div><p class="ellipsis-text" style="font-weight: bold;">TIPO</p></div></a>
                                <div class="btn-group c_objetivo_fisico " style="width: 50%;">
                                    <button id="boton_tipo_informe_historial_lesion" type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border:2px solid #8a8a8a; background-color: #fff;">
                                        <p class="titulo_multi ellipsis-text">
                                            <span id="texto_boton_filtro_tipo_informe_historial_lesion">Seleccione un Tipo de Informe</span>
                                        </p> 
                                        <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span>
                                    </button>
                                        <ul id="tipo_informe_filtro_historial_lesion" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                                </div>                    
                            </div> 
                        </form>
                        <div style="box-sizing:border-box;border:0;display:block;width:95%;/*background:lime;*/margin-left:auto;margin-right:auto;">
                            <div style="box-sizing:border-box;border:0;display:inline-flex;flex-direction:row;flex-wrap:wrap;justify-content:space-between;width:100%;">
                                <div style="box-sizing:border-box;border:0;width:100%;height:300px;background-color: #595959;border: 2px solid #8a8a8a;margin-bottom:15px;">
                                    <div style="box-sizing:border-box;border:0;width:100%;height:22px;font-size:12px;color:#fff;font-weight: bold;text-align:center;background-color:#ff5b4d;border-bottom: 2px solid #8a8a8a;">
                                        HISTORIAL DE LESIONES
                                    </div>
                                    <div id="contenedor_tabla_historial_lesiones" style="box-sizing:border-box;border:0;width:100%;height: 273px;padding-top:5px;">

                                        <table style="width:99%;margin-left:auto;margin-right:auto;">
                                            <thead>
                                                <tr style="background-color:#303030; color:white;">
                                                    <th scope="col" style="padding-left:10px;/*background:red;*/border-top-left-radius:5px;border-bottom-left-radius:5px;text-align: left;font-size: 10px;width: 109px;">JUGADOR</th>
                                                    <th scope="col" style="padding-left:10px;/*background:purple;*/cursor:pointer;width: 166px;">
                                                    <div class="tip-top" data-original-title="Fecha atención" style="width:100%;text-align: left;font-size: 10px;">DIAGNOSTICO</div>
                                                    </th>
                                                    <th scope="col" style="padding-left:10px;/*background:blue;*/cursor:pointer;width: 63px;">
                                                    <div class="tip-top" data-original-title="jugador atendido" style="width:100%;text-align:left;font-size: 10px;">FECHA LESION</div>
                                                    </th>
                                                    <th scope="col" style="padding-left:10px;/*background:lime;*/cursor:pointer;width: 63px;" >
                                                    <div class="tip-top" data-original-title="rut" style="width:100%;text-align:left;font-size: 10px;">ALTA MEDICA</div>
                                                    </th>
                                                    <th scope="col" style="padding-left:10px;/*background:lime;*/cursor:pointer;width: 70px;" >
                                                    <div class="tip-top" data-original-title="rut" style="width:100%;text-align:left;font-size: 10px;">ALTA DEPORTIVA</div>
                                                    </th>
                                                    <th scope="col" style="padding-left:10px;/*background:lime;*/cursor:pointer;width: 56px;" >
                                                    <div class="tip-top" data-original-title="rut" style="width:100%;text-align:center;font-size: 10px;">TIEMPO DE BAJA</div>
                                                    </th>
                                                    <th scope="col" style="padding-left:10px;/*background:lime;*/cursor:pointer;width: 72px;" >
                                                    <div class="tip-top" data-original-title="rut" style="width:100%;text-align:center;font-size: 10px;">PARTIDOS PERDIDOS</div>
                                                    </th>
                                                    <th style="width:20px;border-top-right-radius:5px;border-bottom-right-radius:5px;">
                                                    
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="contenido_tabla_jugadores_historial_lesiones" >
                                                
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>







                    <div id="contenedor_disponibilidad" style="box-sizing:border-box;border:0;width: 100%;display:none;">
                    <div class="contenedor_filtro_historial_lesiones" style="box-sizing:border-box;border:0;Width:100%;display:flex;flex-direction:row;flex-wrap:wrap;justify-content:center;">
                            <div style="width:20%;margin-right:26.6px;display:flex;margin-bottom:15px">
                                <a class="btn btn-md btn-primary green-a" style="width: 42%;height: 20px;background:#404040;border:2px solid #8a8a8a;padding-bottom:2px;">
                                    <div>
                                        <p class="ellipsis-text" style="font-weight: bold;">Año</p>
                                    </div>
                                </a>
                                <select style="width:47%; height: 30px;background:#fff;border:2px solid #8a8a8a" class="" id="ano_filtro_disponibilidad" name="ano_filtro_disponibilidad" onchange="consultarJugadoresSerie(this.value)">
                                    
                                </select>
                            </div>
                            <div style="width:20%;margin-right:26.6px;display:flex;margin-bottom:15px">
                                <a class="btn btn-md btn-primary green-a" style="width: 42%;height: 20px;background:#404040;border:2px solid #8a8a8a;padding-bottom:2px;">
                                    <div>
                                        <p class="ellipsis-text" style="font-weight: bold;">Campeonato</p>
                                    </div>
                                </a>
                                <select style="width:47%; height: 30px;background:#fff;border:2px solid #8a8a8a" class="" id="campeonato_filtro_disponibilidad" name="campeonato_filtro_disponibilidad" onchange="consultarJugadoresSerie(this.value)">
                                    
                                </select>
                            </div>
                        </div>
                        <div style="box-sizing:border-box;border:0;display:block;width:95%;/*background:lime;*/margin-left:auto;margin-right:auto;">
                            <div style="box-sizing:border-box;border:0;display:inline-flex;flex-direction:row;flex-wrap:wrap;justify-content:space-between;width:100%;">
                                <div style="box-sizing:border-box;border:0;width:100%;height:300px;background-color: #595959;border: 2px solid #8a8a8a;margin-bottom:15px;">
                                    <div style="box-sizing:border-box;border:0;width:100%;font-size:12px;color:#fff;font-weight: bold;text-align:center;background-color:#ff5b4d;border-bottom: 2px solid #8a8a8a;margin-bottom:5px;">
                                        DISPONIBILIDAD
                                    </div>
                                    <div id="contenedor_tabla_disponibilidad" style="box-sizing:border-box;border:0;width:100%;height: 273px;padding-top:5px;">

                                        <table style="width:99%;margin-left:auto;margin-right:auto;">
                                            <thead>
                                                <tr style="background-color:#303030; color:white;">
                                                    <th scope="col" style="padding-left:10px;/*background:red;*/border-top-left-radius:5px;border-bottom-left-radius:5px;text-align: left;font-size: 10px;width: 109px;">JUGADOR</th>
                                                    <th scope="col" style="padding-left:10px;/*background:purple;*/cursor:pointer;width: 141px;">
                                                    <div class="tip-top" data-original-title="Fecha atención" style="width:100%;text-align: left;font-size: 10px;">PARTIDOS NO CONVOCADO POR LESIÓN</div>
                                                    </th>
                                                    <th scope="col" style="padding-left:10px;/*background:blue;*/cursor:pointer;width: 40px;">
                                                    <div class="tip-top" data-original-title="jugador atendido" style="width:100%;text-align:left;font-size: 10px;">PJ EQUIPO</div>
                                                    </th>
                                                    <th scope="col" style="padding-left:10px;/*background:lime;*/cursor:pointer;width: 83px;" >
                                                    <div class="tip-top" data-original-title="rut" style="width:100%;text-align:left;font-size: 10px;">% DISPONIBILIDAD</div>
                                                    </th>
                                                    <th scope="col" style="padding-left:10px;/*background:lime;*/cursor:pointer;width: 48px;" >
                                                    <div class="tip-top" data-original-title="rut" style="width:100%;text-align:left;font-size: 10px;">Nº LESIONES</div>
                                                    </th>
                                                    <th scope="col" style="padding-left:10px;/*background:lime;*/cursor:pointer;width: 43px;" >
                                                    <div class="tip-top" data-original-title="rut" style="width:100%;text-align:center;font-size: 10px;">DIAS DE BAJA</div>
                                                    </th>
                                                    <th scope="col" style="padding-left:10px;/*background:lime;*/cursor:pointer;width: 46px;" >
                                                    <div class="tip-top" data-original-title="rut" style="width:100%;text-align:center;font-size: 10px;">MIN JUGADOS</div>
                                                    </th>
                                                    <th style="width:20px;">
                                                        <div class="tip-top" data-original-title="rut" style="width:100%;text-align:center;font-size: 10px;">PJ</div>
                                                    </th>
                                                    <th style="border-top-right-radius:5px;border-bottom-right-radius:5px;width: 46px;">
                                                    
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody id="contenido_tabla_jugadores_disponibilidad" >
                                                <tr style="background-color:#595959; color:white;font-size:10px;cursor:pointer;">
                                                    <td style="width:109px;padding-left:10px;/*background-color:grey;*/padding-top:5px;height:50px;" onClick="">
                                                        <div style="box-sizing:border-box;border:0;float:left;width:50px;height:50px;border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                                            <!--  <img style="height:100%;width:100%;" src="./foto_jugadores/${jugador.idfichaJugador}.png" alt="imagen_jugador" /> -->
                                                            <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                                        </div>
                                                        <div style="box-sizing:border-box;border:0;float:left;width:66%;/*background-color:grey*/;height:50px">
                                                            <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Gabriel Jesus Valera Castillo</div> 
                                                            <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Arquero</div>
                                                        </div>
                                                    </td>
                                                    <td style="width:141px;padding-left:10px;text-align: center;" onClick="">
                                                        5
                                                    </td>
                                                    <td style="width:40px;padding-left:10px;" onClick="">
                                                       20
                                                    </td>
                                                    <td style="width:83px;padding-left:10px;" onClick="">
                                                       76%
                                                    </td>
                                                    <td style="width:48px;padding-left:10px;" onClick="">
                                                       3
                                                    </td>
                                                    <td style="width:43px;text-align:center;" onClick="">
                                                        45 Días
                                                    </td>
                                                    <td style="width:46px;padding-left:10px;text-align:center;" onClick="">
                                                       344 min
                                                    </td>
                                                    <td style="width:20px;max-width:20px;text-align: center;">
                                                        14
                                                    </td>
                                                    <td >
                                                        
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            
                                <div style="box-sizing:border-box;border:0;width:100%;height:300px;background-color: #595959;border: 2px solid #8a8a8a;margin-bottom:15px;">
                                    <div style="box-sizing:border-box;border:0;width:100%;font-size:12px;color:#fff;font-weight: bold;text-align:center;background-color:#ff5b4d;border-bottom: 2px solid #8a8a8a;margin-bottom:5px;">
                                        DISPONIBILIDAD POR MES
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>












                    <div id="contenedor_jugador" style="box-sizing:border-box;border:0;width: 100%;display:none;">
                        <div class="contenedor_filtro_historial_lesiones" style="box-sizing:border-box;border:0;Width:100%;display:flex;flex-direction:row;flex-wrap:wrap;justify-content:center;">
                            <div style="width:20%;margin-right:26.6px;display:flex;margin-bottom:15px">
                                <a class="btn btn-md btn-primary green-a" style="width: 42%;height: 20px;background:#404040;border:2px solid #8a8a8a;padding-bottom:2px;">
                                    <div>
                                        <p class="ellipsis-text" style="font-weight: bold;">SERIE</p>
                                    </div>
                                </a>
                                <select style="width:47%; height: 30px;background:#fff;border:2px solid #8a8a8a" class="" id="serie_filtro_jugador" name="serie_filtro_jugador" onchange="consultarJugadoresSerie(this.value)">
                                    <option value="0_0">Seleccione</option>
                                    <option value="99_1">Primer equipo</option>
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
                                    <option value="99_2">ADULTA FEMENINA</option>
                                    <option value="17_2">Sub 17 ADULTA FEMENINA</option>
                                    <option value="15_2">Sub 15 ADULTA FEMENINA</option>
                                </select>
                            </div>
                            <div style="width:20%;margin-right:26.6px;display:flex;margin-bottom:15px">
                                <a class="btn btn-md btn-primary green-a" style="width: 42%;height: 20px;background:#404040;border:2px solid #8a8a8a;padding-bottom:2px;">
                                    <div>
                                        <p class="ellipsis-text" style="font-weight: bold;">Jugador</p>
                                    </div>
                                </a>
                                <select style="width:47%; height: 30px;background:#fff;border:2px solid #8a8a8a" class="" id="jugador_filtro_jugador_historial" name="jugador_filtro_jugador_historial" onchange="consultarHistorialLesionesJugador(this.value)">
                                    
                                </select>
                            </div>
                        </div>
                        <div id="informacion_jugador" style="box-sizing:border-box;border:0;width:95%;/*background:lime;*/margin-left:auto;margin-right:auto;margin-bottom:15px;">
                            <div style="box-sizing:border-box;border:0;Width:100%;height:250px;display:inline-flex;flex-direction:row;flex-wrap:wrap;">
                                <div style="box-sizing:border-box;border:0;Width:25%;height:100%;/*background:lime;*/"> 
                                    <div id="contenedor_sesccion_jugador" style="box-sizing:border-box;border:0;Width:80%;margin-left: auto;margin-right: auto;border-radius: 150px;overflow: hidden;border: 2px solid #555;height:80%;">
                                        <!-- jugador100.png -->
                                        <!-- <img  style="box-sizing:border-box;border:0;Width:100%;height:100%;" src="./foto_jugadores/jugador100.png" alt="foto_jugador"> -->

                                    </div>
                                    <div id="nombre_jugador" style="box-sizing:border-box;border:0;Width:100%;height:20%;/*background:blue*/;font-size: 1.3em;text-align: center;font-weight: bold;color: #fff;line-height: 50px;">
                                        Gabriel Jesus Valera Castillo
                                    </div>

                                </div>
                                <div style="box-sizing:border-box;border:0;Width:25%;height:100%;/*background:grey;*/padding-top: 40px;">
                                    <div id="total_lesiones" style="box-sizing:border-box;border:0;Width:100%;/*background:orange;*/height: 85px;font-size: 3em;text-align: center;font-weight: bold;color: #fff;line-height: 85px;">
                                        0
                                    </div>
                                    <div style="box-sizing:border-box;border:0;Width:100%;height:20%;/*background:blue*/;font-size: 2em;text-align: center;color: #fff;line-height: 50px;">
                                        LESIONES
                                    </div>
                                </div>
                                <div style="box-sizing:border-box;border:0;Width:25%;height:100%;/*background:grey;*/padding-top: 40px;">
                                    <div id="total_tiempo_de_baja" style="box-sizing:border-box;border:0;Width:100%;/*background:orange;*/height: 85px;font-size: 3em;text-align: center;font-weight: bold;color: #fff;line-height: 85px;">
                                        0
                                    </div>
                                    <div style="box-sizing:border-box;border:0;Width:100%;height:20%;/*background:blue*/;font-size: 2em;text-align: center;color: #fff;line-height: 50px;">
                                        TIEMPO DE BAJA
                                    </div>
                                </div>
                                <div style="box-sizing:border-box;border:0;Width:25%;height:100%;/*background:grey;*/padding-top: 40px;">
                                    <div id="total_atenciones_diarias" style="box-sizing:border-box;border:0;Width:100%;/*background:orange;*/height: 85px;font-size: 3em;text-align: center;font-weight: bold;color: #fff;line-height: 85px;">
                                        0
                                    </div>
                                    <div style="box-sizing:border-box;border:0;Width:100%;height:20%;/*background:blue*/;font-size: 2em;text-align: center;color: #fff;line-height: 50px;">
                                        ATENCIONES DIARIAS
                                    </div>
                                </div>
                                
                            </div>
                    
                        </div>
                        <div id="fila_contenedor_tabla" style="box-sizing:border-box;border:0;display:block;width:95%;/*background:lime;*/margin-left:auto;margin-right:auto;">
                            <div style="box-sizing:border-box;border:0;display:inline-flex;flex-direction:row;flex-wrap:wrap;justify-content:space-between;width:100%;">
                                <div id="contenedor_jugador_tabla" style="box-sizing:border-box;border:0;width:100%;height:300px;background-color: #595959;border: 2px solid #8a8a8a;margin-bottom:15px;">
                                    <div style="box-sizing:border-box;border:0;width:100%;font-size:12px;color:#fff;font-weight: bold;text-align:center;background-color:#ff5b4d;border-bottom: 2px solid #8a8a8a;margin-bottom:5px;">
                                        HISTORIAL DE LESIONES
                                    </div>
                                    <table style="width:99%;margin-left:auto;margin-right:auto;">
                                        <thead>
                                            <tr style="background-color:#303030; color:white;">
                                                <th scope="col" style="padding-left:10px;/*background:red;*/border-top-left-radius:5px;border-bottom-left-radius:5px;text-align: left;font-size: 10px;width: 109px;">JUGADOR</th>
                                                <th scope="col" style="padding-left:10px;/*background:purple;*/cursor:pointer;width: 166px;">
                                                <div class="tip-top" data-original-title="Fecha atención" style="width:100%;text-align: left;font-size: 10px;">DIAGNOSTICO</div>
                                                </th>
                                                <th scope="col" style="padding-left:10px;/*background:blue;*/cursor:pointer;width: 63px;">
                                                <div class="tip-top" data-original-title="jugador atendido" style="width:100%;text-align:left;font-size: 10px;">FECHA LESION</div>
                                                </th>
                                                <th scope="col" style="padding-left:10px;/*background:lime;*/cursor:pointer;width: 63px;" >
                                                <div class="tip-top" data-original-title="rut" style="width:100%;text-align:left;font-size: 10px;">ALTA MEDICA</div>
                                                </th>
                                                <th scope="col" style="padding-left:10px;/*background:lime;*/cursor:pointer;width: 70px;" >
                                                <div class="tip-top" data-original-title="rut" style="width:100%;text-align:left;font-size: 10px;">ALTA DEPORTIVA</div>
                                                </th>
                                                <th scope="col" style="padding-left:10px;/*background:lime;*/cursor:pointer;width: 57px;" >
                                                <div class="tip-top" data-original-title="rut" style="width:100%;text-align:center;font-size: 10px;">TIEMPO DE BAJA</div>
                                                </th>
                                                <th scope="col" style="padding-left:10px;/*background:lime;*/cursor:pointer;width: 73px;" >
                                                <div class="tip-top" data-original-title="rut" style="width:100%;text-align:center;font-size: 10px;">PARTIDOS PERDIDOS</div>
                                                </th>
                                                <th style="width:20px;border-top-right-radius:5px;border-bottom-right-radius:5px;">
                                                
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="contenido_tabla_jugador_historial_lesiones" >
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

var jugadore_filtro_serie_resume=[];

var jugadores_historial_lesiones=[];

var id_ficha_jugador="";

var nombre_usuario_software='<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>';


// historial
var lista_jugadores_serie=[];
// jugador
var lista_jugadores_serie_seccion_jugador=[];
var informe_medicos_jugador=[];

var ano_actual_servidor="";

var lista_ano=[];



</script>
<script>
function consultar_jugadores(){
    $.ajax({
            url: 'post/centro_medico_ver_estado_equipo.php',
            type: "get",
            success: function(respuesta) {
                const json=JSON.parse(respuesta);
                console.log(json);
                $("#numero_jugadores_disponibles").text(json.jugadores_disponibles);
                $("#numero_jugadores_sin_alta_medica").text(json.jugadores_sin_alta_medica);
                $("#numero_jugadores_sin_alta_deportiva").text(json.jugadores_sin_alta_deportiva);
                $("#numero_atenciones_diarias_hoy").text(json.atenciones_diarias_hoy);
            },error: function(){// will fire when timeout is reached
                // alert("errorXXXXX");
                // $("#error_conexion").show()
            }, timeout: 10000 // sets timeout to 3 seconds
	});
}

function consultarJugadoresSerieSinAlta(serie_sexo){
    let serie=serie_sexo.split("_")[0];
    let sexo=serie_sexo.split("_")[1];
    // alert(serie)
    $("#contenido_tabla").empty();
    $.ajax({
            url: 'post/centro_medico_consultar_jugadores_serie_sin_alta_medica.php?serie='+serie+'&sexo='+sexo,
            type: "get",
            success: function(respuesta) {
                const json=JSON.parse(respuesta);
                console.log(json);
                // overflow:scroll;overflow-x:hidden;
                if(json.datos.length>4){
                    // alert("hola")
                    $("#contenedor_jugadores_sin_alta").css("overflow","scroll");
                    $("#contenedor_jugadores_sin_alta").css("overflow-x","hidden");
                }
                else{
                    // alert("hola dos")
                    $("#contenedor_jugadores_sin_alta").css("overflow","none");
                    $("#contenedor_jugadores_sin_alta").css("overflow-x","hidden");
                    $("#contenedor_jugadores_sin_alta").css("overflow-y","hidden");
                }
                window.jugadore_filtro_serie_resume=json.datos;
                filaJugadoresSinAltaMedica(json.datos);

            },error: function(){// will fire when timeout is reached
                // alert("errorXXXXX");
                // $("#error_conexion").show()
            }, timeout: 10000 // sets timeout to 3 seconds
	});
}

function consultarJugadoresSerie(serie_sexo){
    let serie=serie_sexo.split("_")[0];
    let sexo=serie_sexo.split("_")[1];
    $("#jugador_filtro_historial_lesion").empty();
    $("#jugador_filtro_jugador_historial").empty();
    $("#texto_boton_filtro_jugador_historial_lesion").text("Seleccione a un jugador");
    $("#contenido_tabla_jugador_historial_lesiones").empty();
    $("#contenido_tabla_jugadores_historial_lesiones").empty();
    window.lista_jugadores_serie=[];
    window.lista_jugadores_serie_seccion_jugador=[];
    window.lista_jugadores_serie.push({idfichaJugador:0,nombre:"Todos"});
    window.lista_jugadores_serie_seccion_jugador.push({idfichaJugador:"0_0",nombre:"Seleccione",apellido1:"",apellido2:""});
    $.ajax({
            url: 'post/centro_medico_consultar_jugadores_serie.php?serie='+serie+'&sexo='+sexo,
            type: "get",
            success: function(respuesta) {
                const json=JSON.parse(respuesta);
                // console.log(json)
                
                if($("#radio-historial").prop("checked")){
                    for(let jugador of json.datos){
                        window.lista_jugadores_serie.push(jugador);
                    }
                }
                if($("#radio-jugador").prop("checked")){
                    $("#informacion_jugador").css("display","none");
                    $("#fila_contenedor_tabla").css("display","none");
                    if(json.datos.length>0){
                        for(let jugador of json.datos){
                        window.lista_jugadores_serie_seccion_jugador.push(jugador);
                        }
                        for(let jugador2 of window.lista_jugadores_serie_seccion_jugador){
                            $("#jugador_filtro_jugador_historial").append('<option value="'+jugador2.idfichaJugador+'">'+jugador2.nombre+' '+jugador2.apellido1+' '+jugador2.apellido2+'</option>');
                        }
                    }
                    else{
                        $("#jugador_filtro_jugador_historial").append("<option value='0_0'>Seleccione</option>");
                    }
                    
                }
                

            },error: function(){// will fire when timeout is reached
                // alert("errorXXXXX");
                // $("#error_conexion").show()
            }, timeout: 10000 // sets timeout to 3 seconds
	});
}

function filaJugadoresSinAltaMedica(lista_jugadores_sin_alta_medica){
    let numero=0;
    let lista_filas_tabla_jugadores=lista_jugadores_sin_alta_medica.map(jugador => {
        let nombre_completo=jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2;
        // jugador100
        let fila='\
        <tr style="background-color:#595959; color:white;font-size:10px;height:50px;cursor:pointer;">\
                <td style="width:109px;padding-left:10px;/*background-color:grey;*/padding-top:5px;" onClick="modalJugadoresSinAlta('+numero+')">\
                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">\
                        <img style="height:100%;width:100%;" src="./foto_jugadores/'+jugador.idfichaJugador+'.png" alt="imagen_jugador" />\
                    </div>\
                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">\
                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">'+nombre_completo+'</div> \
                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">'+jugador.posicion+'</div>\
                    </div>\
                </td>\
                <td style="width:166px;padding-left:10px;overflow:hidden;text-overflow:ellipsis;" onClick="modalJugadoresSinAlta('+numero+')">\
                    '+jugador.informe_medico.diagnostico+'\
                </td>\
                <td style="width:63px;padding-left:10px;" onClick="modalJugadoresSinAlta('+numero+')">\
                    '+fecha_formato_ddmmaaa(jugador.informe_medico.agregado_fecha_lesion)+'\
                </td>\
                <td style="width:63px;text-align:center;" onClick="modalJugadoresSinAlta('+numero+')">\
                    '+jugador.informe_medico.agregado_dias_de_baja+' '+((jugador.informe_medico.agregado_dias_de_baja>1)?"Días":"Día")+'\
                </td>\
                <td style="width:4px;text-align:center;">\
                    1\
                </td>\
            </tr>\ ';
        numero++;
        return fila;
    })
    lista_filas_tabla_jugadores.map(fila_jugador => {
        $("#contenido_tabla").append(fila_jugador);
    })

}

function modalJugadoresSinAlta(index){
    let array_contexto=[
            "Partido Oficial",
            "Partido Amistoso",
            "Entrenamiento",
            "Otro"
        ];
    let array_tipo_informe=[
        "Muscular",
        "Tendinosa",
        "Ligamentosa",
        "Osea",
        "Cartilago (condal)",
        "Articular",
        "Nerviosa",
        "Contusion",
        "Otra"
    ];
    let lista_patologia=[
        "Abrasion",
        "Adherenciolisis",
        "Bursistis",
        "Calambre",
        "Concusion",
        "Contractura",
        "Contusión ",
        "Degeneracion de tendon",
        "Desgarro Fascicular",
        "Desgarro Fibrilar",
        "Desgarro masivo o total con o sin avulsión ósea",
        "Desgarro Miofacial",
        "Desgarro Multifibrilar",
        "Desinserción",
        "Distensión ",
        "Disyuncion",
        "Doms",
        "Edema muscular",
        "Edema oseo",
        "Esguince",
        "Fascitis",
        "Fisura",
        "Fractura",
        "Hematoma",
        "Herida cortante",
        "Inflamacion",
        "Laceración",
        "Lesión de menisco",
        "Lesion dental",
        "Lesion nerviosa",
        "Luxación",
        "Micosis",
        "Microrrotura fibrilar",
        "Otra lesion osea",
        "Periostitis",
        "Pubalgia",
        "Quemadura",
        "Rotura muscular",
        "Rotura parcial",
        "Rotura total",
        "Sinovitis",
        "Sobrecarga",
        "Tendinitis",
        "Lesion condral",
        "Otra"
    ];
    // alert(index+1)
    // alert()
    console.log(window.jugadore_filtro_serie_resume[index]);
    let jugador=window.jugadore_filtro_serie_resume[index];
    let nombre_jugador=jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2;
    // contendor_foto_jugador_modal
    // <img style="height:100%;width:100%;" src="./foto_jugadores/${jugador.idfichaJugador}.png" alt="imagen_jugador" />
    $("#contendor_foto_jugador_modal").html('<img style="height:100%;width:100%;" src="./foto_jugadores/'+jugador.idfichaJugador+'.png" alt="imagen_jugador" />');
    $("#titulo_modal_nombre_jugador").text(nombre_jugador);
    $("#valor_modal_nombre_jugador").text(nombre_jugador);
    $("#valor_modal_edad_jugador").text(calcular_edad(jugador.fechaNacimiento));
    $("#valor_modal_posicion_jugador").text(jugador.posicion);
    $("#valor_modal_diagnostico_informe").text(jugador.informe_medico.diagnostico);
    $("#valor_modal_fecha_lesion").text(fecha_formato_ddmmaaa(jugador.informe_medico.agregado_fecha_lesion));
    $("#valor_modal_contexto").text(array_contexto[jugador.informe_medico.contexto]);
    $("#valor_modal_patologia").text(lista_patologia[jugador.informe_medico.patologia]);
    $("#valor_modal_zona_anatomica").text(jugador.informe_medico.agregado_localizacion_lesion);
    $("#valor_modal_examenes_realizados").text(jugador.informe_medico.agregado_examenes_realizados);
    let recivida=(jugador.informe_medico.agregado_recidiva==="1")?"Si":"No";
    $("#valor_modal_recivida").text(recivida);
    $("#valor_modal_tipo_informe_medico").text(array_tipo_informe[jugador.informe_medico.tipo]);
    let informe='<span style="font-weight: bold;">'+formatofecha(jugador.informe_medico.agregado_fecha_lesion)+': </span>'+jugador.informe_medico.informe_medico;
    $("#valor_modal_informe_medico").html(informe);

    
    $("#modalVerJugadorResume").modal("show");

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
        "Diciembre"
    ];

    let dia_semana=[
        "Domingo",
        "Lunes",
        "Martes",
        "Miercoles",
        "Jueves",
        "Viernes",
        "Sabado"
    ];
    let ano=fecha.split("-")[0]
    let mes=fecha.split("-")[1]
    let dia=fecha.split("-")[2]
    let fecha_date=new Date()
    fecha_date.setDate(parseInt(dia))
    fecha_date.setMonth(parseInt(mes)-1)
    fecha_date.setFullYear(parseInt(ano))

    return dia_semana[fecha_date.getDay()]+' '+fecha_date.getDate()+' de '+lista_meses[fecha_date.getMonth()]+' '+fecha_date.getFullYear();

}

function calcular_edad(fecha_nacimiento){
    // "2003-01-01"
    let ano=parseInt(fecha_nacimiento.split("-")[0]);
    let edad=0;
    while(ano<parseInt(window.ano_actual_servidor)){
        edad++;
        ano++;
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

function seccionPorDefecto(){
    $("#radio-resume").prop("checked",true);
    $("#seccion-radio-resume").css("background-color","#fff");
    $("#seccion-radio-resume").css("color","#111");
    $("#contenedor_resume").css("display","block");
}

function mostrarSeccion(radio){
    // alert(radio.id)
    if($("#radio-resume").prop("checked")){

        $("#seccion-radio-resume").css("background-color","#fff");
        $("#seccion-radio-resume").css("color","#111");
        $("#contenedor_resume").css("display","block");
        $("#serie_filtro_resume").val("0_0");
        $("#contenido_tabla").empty();
        window.jugadore_filtro_serie_resume=[];
        $("#contenedor_jugadores_sin_alta").css("overflow","none");
        $("#contenedor_jugadores_sin_alta").css("overflow-x","hidden");
        $("#contenedor_jugadores_sin_alta").css("overflow-y","hidden");

    }
    else{

        $("#seccion-radio-resume").css("background-color","#303030");
        $("#seccion-radio-resume").css("color","#fff");
        $("#contenedor_resume").css("display","none");

    }
    if($("#radio-historial").prop("checked")){

        $("#seccion-radio-historial").css("background-color","#fff");
        $("#seccion-radio-historial").css("color","#111");
        $("#contenedor_historial_lesiones").css("display","block");

        $("#jugador_filtro_historial_lesion").empty();
        window.lista_jugadores_serie=[];
        $("#texto_boton_filtro_jugador_historial_lesion").text("Seleccione a un jugador");
        window.lista_jugadores_serie.push({idfichaJugador:0,nombre:"Todos"});
        $("#contenido_tabla_jugadores_historial_lesiones").empty();
        $("#serie_filtro_historial_lesiones").val("0_0");
        $("#contenedor_tabla_historial_lesiones").css("overflow","none");
        $("#contenedor_tabla_historial_lesiones").css("overflow-x","hidden");
        $("#contenedor_tabla_historial_lesiones").css("overflow-y","hidden");
    }
    else{
        $("#seccion-radio-historial").css("background-color","#303030");
        $("#seccion-radio-historial").css("color","#fff");
        $("#contenedor_historial_lesiones").css("display","none");
    }
    if($("#radio-disponibilidad").prop("checked")){
        $("#seccion-radio-disponibilidad").css("background-color","#fff");
        $("#seccion-radio-disponibilidad").css("color","#111");
        $("#contenedor_disponibilidad").css("display","block");
    }
    else{
        $("#seccion-radio-disponibilidad").css("background-color","#303030");
        $("#seccion-radio-disponibilidad").css("color","#fff");
        $("#contenedor_disponibilidad").css("display","none");
    }
    if($("#radio-jugador").prop("checked")){
        $("#seccion-radio-jugador").css("background-color","#fff");
        $("#seccion-radio-jugador").css("color","#111");
        $("#contenedor_jugador").css("display","block");

        $("#jugador_filtro_jugador_historial").empty();
        window.lista_jugadores_serie_seccion_jugador=[];
        $("#contenido_tabla_jugador_historial_lesiones").empty();
        $("#jugador_filtro_jugador_historial").append('<option value="NULL">Seleccione</option>');
        $("#serie_filtro_jugador").val("0_0");
        $("#informacion_jugador").css("display","none");
        $("#fila_contenedor_tabla").css("display","none");
    }
    else{
        $("#seccion-radio-jugador").css("background-color","#303030");
        $("#seccion-radio-jugador").css("color","#fff");
        $("#contenedor_jugador").css("display","none");
    }

}


function consultarHistorialLesionesJugadores(){
    let filtros_historial_lesiones=$("#filtros_historial_lesiones").serializeArray();
    // console.log(filtros_historial_lesiones)
    // array_checkbox_centro_medico_filtro_jugador
    console.log(filtros_historial_lesiones);
    let estado_filtro=false;
    for(let filtro of filtros_historial_lesiones){
        if(filtro.name==="array_checkbox_centro_medico_filtro_jugador[]"){
            estado_filtro=true;
        }
    }
    if(estado_filtro){
        $("#contenido_tabla_jugadores_historial_lesiones").empty();
        $.ajax({
            url: "post/centro_medico_consultar_historial_lesiones_jugador.php",
            type: "post",
            data:filtros_historial_lesiones,
            success: function(respuesta) {
                const json=JSON.parse(respuesta);
                console.log(json);
                window.jugadores_historial_lesiones=json.datos;
                filaJugadoresHistorialLesiones(json.datos);
            },error: function(){// will fire when timeout is reached
                // alert("errorXXXXX");
                // $("#error_conexion").show()
            }, timeout: 10000 // sets timeout to 3 seconds
	    });
    }
}

function consultarHistorialLesionesJugador(){
    // jugador_filtro_jugador_historial
    let id_juagdor=$("#jugador_filtro_jugador_historial").val();
    // alert(id_juagdor)
    if($("#jugador_filtro_jugador_historial").val()!=="NULL"){
        $("#contenido_tabla_jugador_historial_lesiones").empty();
        $.ajax({
            url: 'post/centro_medico_consultar_historial_jugador.php?id='+id_juagdor,
            type: "get",
            success: function(respuesta) {
                const json=JSON.parse(respuesta);
                console.log(json);
                // window.jugadores_historial_lesiones=json.datos
                // filaJugadoresHistorialLesiones(json.datos)
                $("#informacion_jugador").css("display","block");
                $("#fila_contenedor_tabla").css("display","block");
                window.informe_medicos_jugador=json.datos;
                // contenedor_sesccion_jugador
                //  <img style="height:100%;width:100%;" src="./foto_jugadores/${jugador.idfichaJugador}.png" alt="imagen_jugador" />
                $("#contenedor_sesccion_jugador").html('<img style="height:100%;width:100%;" src="./foto_jugadores/'+window.informe_medicos_jugador[0].idfichaJugador+'.png" alt="imagen_jugador" />');

                $("#total_lesiones").text(window.informe_medicos_jugador[0].total_numero_de_lesiones);
                $("#total_tiempo_de_baja").text(window.informe_medicos_jugador[0].total_tiempo_de_baja);
                $("#total_atenciones_diarias").text(window.informe_medicos_jugador[0].total_atenciones_diarias);
                $("#nombre_jugador").text(window.informe_medicos_jugador[0].nombre+' '+window.informe_medicos_jugador[0].apellido1+' '+window.informe_medicos_jugador[0].apellido2);
                filaJugadorHistorialLesiones(window.informe_medicos_jugador);
            },error: function(){// will fire when timeout is reached

                
            }, timeout: 10000 // sets timeout to 3 seconds
	    });
    }
}

function filaJugadorHistorialLesiones(lista_jugadores_historial_lesiones){
    let lista_filas=[];
    let contador_fila=0;
    let posicion_jugador=0;
    let numero_informes=lista_jugadores_historial_lesiones[0].informes_medicos;
    if(numero_informes.length>0){
        for(let jugador of lista_jugadores_historial_lesiones){
            let nombre_completo=jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2;
            let posicion_informe_medico_jugador=0;
            for(informe_medico of jugador.informes_medicos){
                let fecha_alta_medica="00-00-0000",
                fecha_alta_deportiva="00-00-0000";
                if(informe_medico.alta_medica.length===1){
                    fecha_alta_medica=fecha_formato_ddmmaaa(informe_medico.alta_medica[0].fecha_atencion_diaria);
                }
                if(informe_medico.alta_deportiva.length===1){
                    fecha_alta_deportiva=fecha_formato_ddmmaaa(informe_medico.alta_deportiva[0].fecha_atencion_diaria);
                }
                let codigo_historial_lesiones="'"+posicion_jugador+"_"+posicion_informe_medico_jugador+"'";
                let fila='\
                <tr style="background-color:#595959; color:white;font-size:10px;cursor:pointer;">\
                        <td style="width:109px;padding-left:10px;/*background-color:grey;*/padding-top:5px;height:50px;" onClick="modalJugadorHistorialLesion('+codigo_historial_lesiones+')">\
                            <div style="box-sizing:border-box;border:0;float:left;width:50px;height:50px;border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">\
                                <img style="height:100%;width:100%;" src="./foto_jugadores/'+jugador.idfichaJugador+'.png" alt="imagen_jugador" />\
                            </div>\
                            <div style="box-sizing:border-box;border:0;float:left;width:66%;/*background-color:grey*/;height:50px">\
                                <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">'+nombre_completo+'</div> \
                                <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">'+jugador.posicion+'</div>\
                            </div>\
                        </td>\
                        <td style="width:166px;padding-left:10px;" onClick="modalJugadorHistorialLesion('+codigo_historial_lesiones+')">\
                            '+informe_medico.diagnostico+'\
                        </td>\
                        <td style="width:63px;padding-left:10px;" onClick="modalJugadorHistorialLesion('+codigo_historial_lesiones+')">\
                            '+fecha_formato_ddmmaaa(informe_medico.agregado_fecha_lesion)+'\
                        </td>\
                        <td style="width:63px;padding-left:10px;" onClick="modalJugadorHistorialLesion('+codigo_historial_lesiones+')">\
                            '+fecha_alta_medica+'\
                        </td>\
                        <td style="width:70px;padding-left:10px;" onClick="modalJugadorHistorialLesion('+codigo_historial_lesiones+')">\
                            '+fecha_alta_deportiva+'\
                        </td>\
                        <td style="width:72px;text-align:center;" onClick="modalJugadorHistorialLesion('+codigo_historial_lesiones+')">\
                            '+informe_medico.agregado_dias_de_baja+' '+((informe_medico.agregado_dias_de_baja>1)?"Días":"Día")+'\
                        </td>\
                        <td style="width:85px;padding-left:10px;text-align:center;" onClick="modalJugadorHistorialLesion('+codigo_historial_lesiones+')">\
                            10\
                        </td>\
                        <td style="width:20px;max-width:20px;padding-left:10px;">\
                            x\
                        </td>\
                    </tr>';
                lista_filas.push(fila);
                contador_fila++;
                posicion_informe_medico_jugador++;
            }
            posicion_jugador++;
                
        }
        lista_filas.map(fila_jugador => {
            $("#contenido_tabla_jugador_historial_lesiones").append(fila_jugador);
        })
        if(contador_fila>4){
            $("#contenedor_jugador_tabla").css("overflow","scroll");
            $("#contenedor_jugador_tabla").css("overflow-x","hidden");
        }
        else{
            $("#contenedor_jugador_tabla").css("overflow","none");
            $("#contenedor_jugador_tabla").css("overflow-x","hidden");
            $("#contenedor_jugador_tabla").css("overflow-y","hidden");
        }
    }

}




function filaJugadoresHistorialLesiones(lista_jugadores_historial_lesiones){
    let lista_filas=[];
    let contador_fila=0;
    let posicion_jugador=0;
    for(let jugador of lista_jugadores_historial_lesiones){
        let nombre_completo=jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2;
        let posicion_informe_medico_jugador=0;
        for(informe_medico of jugador.informes_medicos){
            let fecha_alta_medica="00-00-0000",
            fecha_alta_deportiva="00-00-0000";
            if(informe_medico.alta_medica.length===1){
                fecha_alta_medica=fecha_formato_ddmmaaa(informe_medico.alta_medica[0].fecha_atencion_diaria);
            }
            if(informe_medico.alta_deportiva.length===1){
                fecha_alta_deportiva=fecha_formato_ddmmaaa(informe_medico.alta_deportiva[0].fecha_atencion_diaria);
            }
            let codigo_historial_lesiones="'"+posicion_jugador+"_"+posicion_informe_medico_jugador+"'";
            let fila='\
            <tr style="background-color:#595959; color:white;font-size:10px;cursor:pointer;">\
                    <td style="width:109px;padding-left:10px;/*background-color:grey;*/padding-top:5px;height:50px;" onClick="modalHistorialLesion('+codigo_historial_lesiones+')">\
                        <div style="box-sizing:border-box;border:0;float:left;width:50px;height:50px;border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">\
                        <img style="height:100%;width:100%;" src="./foto_jugadores/'+jugador.idfichaJugador+'.png" alt="imagen_jugador" />\
                        </div>\
                        <div style="box-sizing:border-box;border:0;float:left;width:66%;/*background-color:grey*/;height:50px">\
                            <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">'+nombre_completo+'</div> \
                            <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">'+jugador.posicion+'</div>\
                        </div>\
                    </td>\
                    <td style="width:166px;padding-left:10px;" onClick="modalHistorialLesion('+codigo_historial_lesiones+')">\
                        '+informe_medico.diagnostico+'\
                    </td>\
                    <td style="width:63px;padding-left:10px;" onClick="modalHistorialLesion('+codigo_historial_lesiones+')">\
                        '+fecha_formato_ddmmaaa(informe_medico.agregado_fecha_lesion)+'\
                    </td>\
                    <td style="width:63px;padding-left:10px;" onClick="modalHistorialLesion('+codigo_historial_lesiones+')">\
                        '+fecha_alta_medica+'\
                    </td>\
                    <td style="width:70px;padding-left:10px;" onClick="modalHistorialLesion('+codigo_historial_lesiones+')">\
                        '+fecha_alta_deportiva+'\
                    </td>\
                    <td style="width:72px;text-align:center;" onClick="modalHistorialLesion('+codigo_historial_lesiones+')">\
                        '+informe_medico.agregado_dias_de_baja+' '+((informe_medico.agregado_dias_de_baja>1)?"Días":"Día")+'\
                    </td>\
                    <td style="width:85px;padding-left:10px;text-align:center;" onClick="modalHistorialLesion('+codigo_historial_lesiones+')">\
                        10\
                    </td>\
                    <td style="width:20px;max-width:20px;padding-left:10px;">\
                        x\
                    </td>\
                </tr>';
            lista_filas.push(fila);
            contador_fila++;
            posicion_informe_medico_jugador++;
        }
        posicion_jugador++;
            
    }
    lista_filas.map(fila_jugador => {
        $("#contenido_tabla_jugadores_historial_lesiones").append(fila_jugador);
    })
    if(contador_fila>4){
        $("#contenedor_tabla_historial_lesiones").css("overflow","scroll");
        $("#contenedor_tabla_historial_lesiones").css("overflow-x","hidden");
    }
    else{
        $("#contenedor_tabla_historial_lesiones").css("overflow","none");
        $("#contenedor_tabla_historial_lesiones").css("overflow-x","hidden");
        $("#contenedor_tabla_historial_lesiones").css("overflow-y","hidden");
    }

}


function anos_informe_mensual(){
    // $("#ano_informe_mensual").empty()
    // $("#ano_informe_mensual_filtro").empty()
    let ano_minimo=window.ano_actual_servidor-2;
    let ano_maximo=window.ano_actual_servidor+1;
    for(ano_minimo;ano_minimo<=ano_maximo;ano_minimo++){
        window.lista_ano.push(ano_minimo);
    }
}

function modalHistorialLesion(posionIndexJugador_posicionIndexInforme){
    // alert(posionIndexJugador_posicionIndexInforme);
    let pocicion_jugador=posionIndexJugador_posicionIndexInforme.split("_")[0],
    pocision_informe=posionIndexJugador_posicionIndexInforme.split("_")[1];
    console.log(window.jugadores_historial_lesiones[pocicion_jugador]);
    console.log(window.jugadores_historial_lesiones[pocicion_jugador].informes_medicos[pocision_informe]);
    let array_contexto=[
        "Partido Oficial",
        "Partido Amistoso",
        "Entrenamiento",
        "Otro"
    ];
    let array_tipo_informe=[
        "Muscular",
        "Tendinosa",
        "Ligamentosa",
        "Osea",
        "Cartilago (condal)",
        "Articular",
        "Nerviosa",
        "Contusion",
        "Otra"
    ];
    let lista_patologia=[
        "Abrasion",
        "Adherenciolisis",
        "Bursistis",
        "Calambre",
        "Concusion",
        "Contractura",
        "Contusión ",
        "Degeneracion de tendon",
        "Desgarro Fascicular",
        "Desgarro Fibrilar",
        "Desgarro masivo o total con o sin avulsión ósea",
        "Desgarro Miofacial",
        "Desgarro Multifibrilar",
        "Desinserción",
        "Distensión ",
        "Disyuncion",
        "Doms",
        "Edema muscular",
        "Edema oseo",
        "Esguince",
        "Fascitis",
        "Fisura",
        "Fractura",
        "Hematoma",
        "Herida cortante",
        "Inflamacion",
        "Laceración",
        "Lesión de menisco",
        "Lesion dental",
        "Lesion nerviosa",
        "Luxación",
        "Micosis",
        "Microrrotura fibrilar",
        "Otra lesion osea",
        "Periostitis",
        "Pubalgia",
        "Quemadura",
        "Rotura muscular",
        "Rotura parcial",
        "Rotura total",
        "Sinovitis",
        "Sobrecarga",
        "Tendinitis",
        "Lesion condral",
        "Otra"
    ];
    // alert(index+1) 
    let jugador=window.jugadores_historial_lesiones[pocicion_jugador];
    let informe_medico=window.jugadores_historial_lesiones[pocicion_jugador].informes_medicos[pocision_informe];
    let nombre_jugador=jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2;
    $("#contendor_foto_jugador_modal").html('<img style="height:100%;width:100%;" src="./foto_jugadores/'+jugador.idfichaJugador+'.png" alt="imagen_jugador" />');
    $("#titulo_modal_nombre_jugador").text(nombre_jugador);
    $("#valor_modal_nombre_jugador").text(nombre_jugador);
    $("#valor_modal_edad_jugador").text(calcular_edad(jugador.fechaNacimiento));
    $("#valor_modal_posicion_jugador").text(jugador.posicion);
    $("#valor_modal_diagnostico_informe").text(informe_medico.diagnostico);
    $("#valor_modal_fecha_lesion").text(fecha_formato_ddmmaaa(informe_medico.agregado_fecha_lesion));
    $("#valor_modal_contexto").text(array_contexto[informe_medico.contexto]);
    $("#valor_modal_patologia").text(lista_patologia[informe_medico.patologia]);
    $("#valor_modal_zona_anatomica").text(informe_medico.agregado_localizacion_lesion);
    $("#valor_modal_examenes_realizados").text(informe_medico.agregado_examenes_realizados);
    let recivida=(informe_medico.agregado_recidiva==="1")?"Si":"No";
    $("#valor_modal_recivida").text(recivida);
    $("#valor_modal_tipo_informe_medico").text(array_tipo_informe[informe_medico.tipo]);
    let informe='<span style="font-weight: bold;">'+formatofecha(informe_medico.agregado_fecha_lesion)+': </span>'+informe_medico.informe_medico;
    $("#valor_modal_informe_medico").html(informe);

    // 
    $("#modalVerJugadorResume").modal("show");
}

function modalJugadorHistorialLesion(posionIndexJugador_posicionIndexInforme){
    // alert(posionIndexJugador_posicionIndexInforme)
    let pocicion_jugador=posionIndexJugador_posicionIndexInforme.split("_")[0],
    pocision_informe=posionIndexJugador_posicionIndexInforme.split("_")[1];
    console.log(window.informe_medicos_jugador[pocicion_jugador]);
    console.log(window.informe_medicos_jugador[pocicion_jugador].informes_medicos[pocision_informe]);
    let array_contexto=[
        "Partido Oficial",
        "Partido Amistoso",
        "Entrenamiento",
        "Otro"
    ];
    let array_tipo_informe=[
        "Muscular",
        "Tendinosa",
        "Ligamentosa",
        "Osea",
        "Cartilago (condal)",
        "Articular",
        "Nerviosa",
        "Contusion",
        "Otra"
    ];
    let lista_patologia=[
        "Abrasion",
        "Adherenciolisis",
        "Bursistis",
        "Calambre",
        "Concusion",
        "Contractura",
        "Contusión ",
        "Degeneracion de tendon",
        "Desgarro Fascicular",
        "Desgarro Fibrilar",
        "Desgarro masivo o total con o sin avulsión ósea",
        "Desgarro Miofacial",
        "Desgarro Multifibrilar",
        "Desinserción",
        "Distensión ",
        "Disyuncion",
        "Doms",
        "Edema muscular",
        "Edema oseo",
        "Esguince",
        "Fascitis",
        "Fisura",
        "Fractura",
        "Hematoma",
        "Herida cortante",
        "Inflamacion",
        "Laceración",
        "Lesión de menisco",
        "Lesion dental",
        "Lesion nerviosa",
        "Luxación",
        "Micosis",
        "Microrrotura fibrilar",
        "Otra lesion osea",
        "Periostitis",
        "Pubalgia",
        "Quemadura",
        "Rotura muscular",
        "Rotura parcial",
        "Rotura total",
        "Sinovitis",
        "Sobrecarga",
        "Tendinitis",
        "Lesion condral",
        "Otra"
    ];
    // alert(index+1) 
    let jugador=window.informe_medicos_jugador[pocicion_jugador];
    let informe_medico=window.informe_medicos_jugador[pocicion_jugador].informes_medicos[pocision_informe];
    let nombre_jugador=jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2;
    $("#contendor_foto_jugador_modal").html('<img style="height:100%;width:100%;" src="./foto_jugadores/'+jugador.idfichaJugador+'.png" alt="imagen_jugador" />');
    $("#titulo_modal_nombre_jugador").text(nombre_jugador);
    $("#valor_modal_nombre_jugador").text(nombre_jugador);
    $("#valor_modal_edad_jugador").text(calcular_edad(jugador.fechaNacimiento));
    $("#valor_modal_posicion_jugador").text(jugador.posicion);
    $("#valor_modal_diagnostico_informe").text(informe_medico.diagnostico);
    $("#valor_modal_fecha_lesion").text(fecha_formato_ddmmaaa(informe_medico.agregado_fecha_lesion));
    $("#valor_modal_contexto").text(array_contexto[informe_medico.contexto]);
    $("#valor_modal_patologia").text(lista_patologia[informe_medico.patologia]);
    $("#valor_modal_zona_anatomica").text(informe_medico.agregado_localizacion_lesion);
    $("#valor_modal_examenes_realizados").text(informe_medico.agregado_examenes_realizados);
    let recivida=(informe_medico.agregado_recidiva==="1")?"Si":"No";
    $("#valor_modal_recivida").text(recivida);
    $("#valor_modal_tipo_informe_medico").text(array_tipo_informe[informe_medico.tipo]);
    let informe='<span style="font-weight: bold;">'+formatofecha(informe_medico.agregado_fecha_lesion)+': </span>'+informe_medico.informe_medico;
    $("#valor_modal_informe_medico").html(informe);

    // 
    $("#modalVerJugadorResume").modal("show");
}

function consultar_ano_actual(){
    $.ajax({
            url: "post/centro_medico_consultar_ano_actual.php",
            type: "get"
            ,success: function(respuesta) {
                var json=JSON.parse(respuesta);
                // alert("registro")
                // console.log(json)
                window.ano_actual_servidor=parseInt(json.ano_actual);
                anos_informe_mensual();
                
		},error: function(){// will fire when timeout is reached
			// alert("errorXXXXX");
    	}, timeout: 10000 // sets timeout to 3 seconds
	});
}

</script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script>
    consultar_ano_actual();
    consultar_jugadores();
    mostrar_al_cargar_pagina();
    seccionPorDefecto();
    $(document).on('click', '.option', function(e) { //
        e.stopPropagation();
    });
    $('.c_objetivo_fisico li').click(function (e) { e.stopPropagation(); });

    function selecionarTodosJugadoresHistorial(){
        // checkbox_centro_medico_filtro_jugador_${jugador.idfichaJugador}
        if( $("#checkbox_centro_medico_filtro_jugador_0").prop("checked")){
            for(let jugador of window.lista_jugadores_serie){
                $("#texto_boton_filtro_jugador_historial_lesion").text("Todos");
                $("#checkbox_centro_medico_filtro_jugador_"+jugador.idfichaJugador).prop("checked",true);
            }
        }
        else{
            for(let jugador of window.lista_jugadores_serie){
                $("#texto_boton_filtro_jugador_historial_lesion").text("Todos");
                $("#checkbox_centro_medico_filtro_jugador_"+jugador.idfichaJugador).prop("checked",false);
            }
            $("#texto_boton_filtro_jugador_historial_lesion").text("Seleccione un Jugador");
            $("#checkbox_centro_medico_filtro_jugador_0").prop("checked",false);
        }
        consultarHistorialLesionesJugadores();
        
    }

    function contarJugadoresSeleccionados(){
        let array_checkbox_jugadores = $('input[name="array_checkbox_centro_medico_filtro_jugador[]"]:checked').map(function(){ 
            return this.value; 
        }).get();
        // console.log(array_checkbox_area_filtro_atencion_diaria)

        if(array_checkbox_jugadores.length==1){
            const jugador_filtrado=window.lista_jugadores_serie.filter((jugador)=>{
                if(jugador.idfichaJugador===array_checkbox_jugadores[0]){
                    return jugador;
                }
            })
            // console.log(serie[0].nombre_serie)
            $("#texto_boton_filtro_jugador_historial_lesion").text(jugador_filtrado[0].nombre+" "+jugador_filtrado[0].apellido1+" "+jugador_filtrado[0].apellido2);
        }
        else if(array_checkbox_jugadores.length>0){
            if(array_checkbox_jugadores.length<=window.lista_jugadores_serie.length-1){
                if(array_checkbox_jugadores.length==window.lista_jugadores_serie.length-1 && !$("#checkbox_centro_medico_filtro_jugador_0").prop("checked")){
                    $("#checkbox_centro_medico_filtro_jugador_0").prop("checked",true);
                    $("#texto_boton_filtro_jugador_historial_lesion").text("Todos");
                }
                else{
                    if($("#checkbox_centro_medico_filtro_jugador_0").prop("checked")){
                        $("#checkbox_centro_medico_filtro_jugador_0").prop("checked",false);
                        array_checkbox_jugadores.shift();
                    }
                    $("#texto_boton_filtro_jugador_historial_lesion").text(array_checkbox_jugadores.length+" Elementos Selecionados");
                }
            }
        }
        else{
            // alert("hola")
            $("#texto_boton_filtro_jugador_historial_lesion").text("Seleccione un Jugador");
        }
        consultarHistorialLesionesJugadores();

    }

    $("#boton_jugador_historial_lesion").on("click",()=>{
        const lis=window.lista_jugadores_serie.map((jugador)=>{
            const funcion=(jugador.idfichaJugador==0)?'selecionarTodosJugadoresHistorial':'contarJugadoresSeleccionados';
            if(jugador.idfichaJugador==0){
                return "<li ><label class='option'><span class='label_s' style='font-size:13px;'>"+jugador.nombre+"</span> <input type='checkbox' id='checkbox_centro_medico_filtro_jugador_"+jugador.idfichaJugador+"' data-eliminar='0' onclick='"+funcion+"()' ></label></li>";
            }
            else{
                return "<li ><label class='option'><span class='label_s' style='font-size:13px;'>"+jugador.nombre+" "+jugador.apellido1+" "+jugador.apellido2+"</span> <input type='checkbox' id='checkbox_centro_medico_filtro_jugador_"+jugador.idfichaJugador+"' name='array_checkbox_centro_medico_filtro_jugador[]' value='"+jugador.idfichaJugador+"' data-eliminar='0' onclick='"+funcion+"()' ></label></li>";
            }
        })
        if($("#jugador_filtro_historial_lesion").html()!=""){
            console.log("no esta basio");
        }
        else{
            console.log("esta basio")
            lis.map((lista)=>{
                $("#jugador_filtro_historial_lesion").html($("#jugador_filtro_historial_lesion").html()+lista);
            });
        }
    });

    $("#texto_boton_filtro_ano_historial_lesion").on("click",()=>{
        const lis=window.lista_ano.map((ano)=>{
    
            return "<li ><label class='option'><span class='label_s' style='font-size:13px;'>"+ano+"</span> <input type='checkbox' id='checkbox_centro_medico_filtro_ano_"+ano+"' name='array_checkbox_centro_medico_filtro_ano[]' value='"+ano+"' data-eliminar='0' onclick='consultarHistorialLesionesJugadores()' ></label></li>";
        })
        if($("#ano_filtro_historial_lesion").html()!=""){
            console.log("no esta basio");
        }
        else{
            console.log("esta basio");
            lis.map((lista)=>{
                $("#ano_filtro_historial_lesion").html($("#ano_filtro_historial_lesion").html()+lista);
            });
        }
    });
    $("#boton_tipo_informe_historial_lesion").on("click",()=>{
        let array_tipo_informe=[
            {numero:0,tipo:"Muscular"},
            {numero:1,tipo:"Tendinosa"},
            {numero:2,tipo:"Ligamentosa"},
            {numero:3,tipo:"Osea"},
            {numero:4,tipo:"Cartilago (condal)"},
            {numero:5,tipo:"Articular"},
            {numero:6,tipo:"Nerviosa"},
            {numero:7,tipo:"Contusion"},
            {numero:8,tipo:"Otra"}
        ];
        const lis=array_tipo_informe.map((tipo_informe)=>{
    
            return "<li ><label class='option'><span class='label_s' style='font-size:13px;'>"+tipo_informe.tipo+"</span> <input type='checkbox' id='checkbox_centro_medico_filtro_tipo_informe_"+tipo_informe.numero+"' name='array_checkbox_centro_medico_filtro_tipo_informe[]' value='"+tipo_informe.numero+"' data-eliminar='0' onclick='consultarHistorialLesionesJugadores()' ></label></li>";
        })
        if($("#tipo_informe_filtro_historial_lesion").html()!=""){
            console.log("no esta basio");
        }
        else{
            console.log("esta basio");
            lis.map((lista)=>{
                $("#tipo_informe_filtro_historial_lesion").html($("#tipo_informe_filtro_historial_lesion").html()+lista);
            });
        }
    });

</script>
