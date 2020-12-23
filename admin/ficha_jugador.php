<?PHP
include('../config/datos.php');
session_start();
if(!(isset($_SESSION["nombre_usuario_software"]))){
    session_destroy();
    header('Location: ../index.php?cerrar_sesion=1');
}
else{
    $menu_actual="fichajugador";
    $submenu_actual="ficha_jugador";
    $seccion_comentarios = $comentarios['ficha_jugador'];//mis cuotas
    $demo_seccion = $demo['ficha_jugador'];
    $nombre_pestana_navegador='Ficha';

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
        <title><?php echo $nombre_pestana_navegador;?> | Jugador</title>

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

            .boton_agregar_ficha_jugador{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 3px solid #555; 
                color: #555;
                border-radius:5px;
            }
            .boton_agregar_ficha_jugador:hover{
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
        .boton_agregar_ficha_jugador{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 3px solid #555555; 
                color: #555555;
                border-radius:5px;
            }
            .boton_agregar_ficha_jugador:hover{
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
        .boton_agregar_ficha_jugador:disabled{
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
                        /* =================================================================== */
                        .boton_gestionar_cargos {
                            margin-left: auto;
                            margin-right: auto;
                            padding-left: 7px;
                            padding-right: 7px;
                            text-shadow: none; 
                            background-color: transparent;
                            border: 3px solid <?php echo $color_fondo; ?>; 
                            color: <?php echo $color_fondo; ?>;
                            border-radius:2px;
                            width: 181px;
                        }
                        .boton_gestionar_cargos:hover {
                            padding-left: 7px;
                            padding-right: 7px;
                            text-shadow: none; 
                            background-color: transparent;
                            border: 3px solid <?php echo $color_fondo_suave; ?>;
                            color: <?php echo $color_fondo_suave; ?>;
                            border-radius:2px;
                        }
                        .boton_gestionar_cargos:disabled {
                            padding-left: 7px;
                            padding-right: 7px;
                            text-shadow: none; 
                            background-color: transparent;
                            border: 3px solid rgba(0, 0, 0, .2);	
                            color: rgba(0, 0, 0, .2);
                            border-radius:2px;
                        }
                        .fila_serie_jugador:hover{
                            background-color: #ffbb00;
                        }
                        .baner_info_ficha_jugador{
                            box-sizing:border-box;
                            border:0;
                            width: 100%;
                            height:210px;
                            background-image:url(./img/baner_ficha_jugador.jpeg);
                            background-repeat: no-repeat;
                            background-size:contain;
                            background-color: #ffffff;
                        }   
                    </style>
                    <style>
                        /* Tooltip container */
                        .tooltip-customized {
                            position: relative;
                            display: inline-block;
                        }

                        /* Tooltip text */
                        .tooltip-customized .tooltiptext {
                        visibility: hidden;
                        width: 120px;
                        background-color: black;
                        color: #fff;
                        text-align: center;
                        padding: 5px 5px;
                        border-radius: 6px;
                        
                        /* Position the tooltip text - see examples below! */
                        position: absolute;
                        z-index: 1;

                        /* /Top/ */
                        bottom: 100%;
                        left: 50%;
                        margin-left: -60px; /* Use half of the width (120/2 = 60), to center the tooltip */  
                        }

                        /* Show the tooltip text when you mouse over the tooltip container */
                        .tooltip-customized:hover .tooltiptext {
                        visibility: visible;
                        }

                        .tooltip-customized .tooltiptext::after {
                        content: " ";
                        position: absolute;
                        top: 100%; /* At the bottom of the tooltip */
                        left: 50%;
                        margin-left: -5px;
                        border-width: 5px;
                        border-style: solid;
                        border-color: black transparent transparent transparent;
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
        <div id="content" style="height: auto;">
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
                    <div id="modalFormulario" class="modal hide" style="border-radius:10px;">
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
                    <div id="vista_inicio" style="padding-top:10px;">

                        <div style="box-sizing:border-box;border:0;width:29%;height:100px;margin-left:auto;margin-right:auto;margin-bottom:15px;">
                                <!-- <div  style="box-sizing:border-box;border:0;width:10%;height:100px;float:left;margin-right:310px;padding-top:45px;">
                                    <button class="boton_volver" onClick="botonVolverHaVistaSeries();" style="margin-left:10px;"><i class="icon-arrow-left"></i> volver</button>
                                </div> -->
                                <div style="box-sizing:border-box;border:0;width:35%;height:100px;float:left;">

                                    <img style="box-sizing:border-box;border:0;width:100%;height:100%;" src="../config/logo_equipo.png" alt="logo_equipo">
                                
                                </div>
                                <div style="box-sizing:border-box;border:0;width:65%;height:100px;float:left;">

                                    <!-- Sub-00 -->
                                    <div style="box-sizing:border-box;border:0;width:100%;height:65px;text-align: center;line-height: 80px;font-size: 1.5em;font-weight: bold;color: #000;">
                                        Primer Equipo
                                    </div>
                                    <div  style="box-sizing:border-box;border:0;width:65%;margin-left:auto;margin-right:auto;height: 23px;text-align: center;line-height: 20px;font-size: 1em;font-weight: bold;color: #000;border-top: 2px solid #000;border-bottom: 2px solid #000;">
                                        Masculino
                                    </div>
                                
                                </div>
                        </div>
                        <hr/>
                        <div style="box-sizing:border-box;border:0;width:40%;height:40px;margin-left:auto;margin-right:auto;margin-bottom: 40px;">
                            <input style="box-sizing:border-box;border:0;width:100%;height:100%;border-radius:20px;border:5px solid #555;margin:0;" type="text" name="nombre_jugador_filtro" id="nombre_jugador_filtro" placeholder="Nombre Del Jugador o Vacio Para Ver Todos" onKeyup="consultarFichaJugadores()" />
                        </div>

                        <img id="gif_de_carga_tabla_jugadores" style="display:none;box-sizing:border-box;border:0;margin-left:auto;margin-right:auto;" src="../config/cargando_buscar.gif" alt="gif_cargar"/>

                        <button style="margin-bottom: 10px;margin-left: auto;margin-right: 25px;width: 127px;display: block;margin-bottom:10px;" class="boton_agregar_ficha_jugador" onClick="abrirFormulario()"><b style="font-size:12px;"><i class="icon-plus"></i> Agregar jugador</b></button>

                        <div  style="box-sizing:border-box;display: flex;width: 20%;margin-left:auto;margin-right:auto;margin-bottom:15px;">
                            <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#555"><div><p class="ellipsis-text" style="font-weight: normal;;">Prestamo</p></div></a>
                            <div class="btn-group c_objetivo_fisico " style="width: 50%;">
                                <button id="boton_prestamo" type="button" class="btn dropdown-toggle grey-input" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 1px solid #555;background:#fff;"><p id="area" class="titulo_multi ellipsis-text"><span id="texto_boton_filtro_prestamo">Seleccione un tipo de préstamo</span></p> <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span></button>\
                                <ul id="tipo_prestamo" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                            </div>                    
                        </div>
















                        <!-- ================================================================ -->



                        <div id="tabla_html" style="box-sizing:border-box;border:0;width:95%;margin-left:auto;margin-right:auto;">
                            <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;border-top-left-radius: 5px;border-top-right-radius: 5px;">
                                <div style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;font-size: 12px;">#</div>
                                <div class="tooltip-customized" style="box-sizing:border-box;border:0;width:13%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;font-size: 12px;">
                                <!-- POSICION -->
                                    POSICION
                                    <span class="tooltiptext">Posición del jugador</span>
                                </div>
                                <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;font-size: 12px;">SERIE</div>

                                <div style="box-sizing:border-box;border:0;width:16%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;font-size: 12px;">NOMBRE</div>

                                
                                <div class="tooltip-customized" style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;font-size: 12px;">
                                    ALTURA
                                    <span class="tooltiptext">Altura del jugador</span>
                                </div>
                                <div class="tooltip-customized" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;font-size: 12px;">
                                    F.NACIMIENTO
                                    <span class="tooltiptext">Fecha nacimiento</span>
                                </div>
                                <div class="tooltip-customized" style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;font-size: 12px;">EDAD</div>
                                <div class="tooltip-customized" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;font-size: 12px;">NACIONALIDAD</div>
                                <div class="tooltip-customized" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;font-size: 12px;">PRESTAMO</div>
                                <div class="tooltip-customized" style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;font-size: 12px;">
                                    FECHA V.C
                                    <span class="tooltiptext">Fecha vencimiento contrato</span>

                                </div>
                                <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#fff;font-weight: bold;"></div>
                                <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#fff;font-weight: bold;"></div>
                            </div>
                            <div id="seccion_arquero" style="box-sizing:border-box;border:0;width:100%;">
                                <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;color:#fff;font-weight: bold;line-height: 30px;font-size: 18px;padding-left: 25px;">Arqueros</div>
                            </div>
                            <div id="seccion_defensa" style="box-sizing:border-box;border:0;width:100%;">
                                <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;color:#fff;font-weight: bold;line-height: 30px;font-size: 18px;padding-left: 25px;">Defensas</div>
                            
                            </div>
                            <div id="seccion_medio_campista" style="box-sizing:border-box;border:0;width:100%;">
                                <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;color:#fff;font-weight: bold;line-height: 30px;font-size: 18px;padding-left: 25px;">Mediocampistas</div>
                                
                            </div>
                            <div id="seccion_delantero" style="box-sizing:border-box;border:0;width:100%;">
                                <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;color:#fff;font-weight: bold;line-height: 30px;font-size: 18px;padding-left: 25px;">Delanteros</div>
                                
                            </div>
                            <div style="box-sizing:border-box;border:0;width:100%;height:10px;background-color:#555;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;"></div>
                        </div>


                        <!-- ================================================================ -->

                    </div>

                    <form id="vista_formulario" style="display:none;" >
                        <!-- <h1>formulario</h1> -->
                        <div style="box-sizing:border-box;border:0;width:100%;height:100px;margin-bottom:15px;">
                                <div  style="box-sizing:border-box;border:0;width:10%;height:100px;float:left;margin-right:310px;padding-top:45px;">
                                    <button class="boton_volver" onClick="botonVolverHaInicio();" style="margin-left:10px;"><i class="icon-arrow-left"></i> volver</button>
                                </div>
                                <div style="box-sizing:border-box;border:0;width:20%;height:100px;float:left;line-height: 100px;font-size: 13px;font-weight: 900;color: #404040;"> AGREGAR JUGADOR </div>
                                
                        </div>

                        <div style="box-sizing:border-box;width:95%;height:auto;margin-left:auto;margin-right:auto;margin-bottom:30px;background-color:#fff;">
                            <div style="box-sizing:border-box;width:100%;height:40px;background-color:#555;border-top-left-radius: 10px;border-top-right-radius: 10px;line-height: 40px;padding-left: 10px;color: #fff;font-size: 12px;">
                                DATOS GENERALES
                            </div>
                            <div style="box-sizing:border-box;width:100%;height:410px;border:2px solid #555;display:inline-flex;flex-direction:row;flex-wrap:wrap;">
                                <div style="box-sizing:border-box;width:35%;height:240px;padding-top:10px;">
                                
                                    <div style="box-sizing:border-box;width:190px;height:190px;margin-left:auto;margin-right:auto;background-color:#fff;border-radius:100px;overflow:hidden;border:8px solid <?php print($color_fondo);?>margin-bottom:10px;">
                                        <img id="foto_perfil_jugador" src="" style="box-sizing:border-box;width:100%;height:100%;"  alt="imagen_jugador">
                                    </div>

                                    <label for="foto_registro" class="boton_gestionar_cargos" style="border-radius: 5px;display:block;">
                                        <i class="icon-cloud-upload"></i> SUBIR FOTO (.jpg o.png)
                                    </label>
                                    <input type="file" name="foto_registro" id="foto_registro" style="display: none;"/>
                                    <!-- <input type="checkbox" name="nueva_img_jugador" id="nueva_img_jugador" value="1" style="display: none;"> -->
                                
                                </div>
                                <div style="box-sizing:border-box;width:65%;height:240px;padding-top:10px;display:inline-flex;flex-direction:row;flex-wrap:wrap;">

                                    <div style="margin-right:10%;width:40%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 40%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Nombre</p>
                                            </div>
                                        </a>
                                        <input type="text" id="nombre" name="nombre" class="grey-input " style="width:60%;margin:0;background:#fff;border:2px solid;height: 18px;text-transform: Capitalize" onKeyup="validarFormulario()"/>
                                    </div>

                                    <div style="margin-right:10%;width:40%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 40%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Apellido 1</p>
                                            </div>
                                        </a>
                                        <input type="text" id="apellido1" name="apellido1" class="grey-input " style="width:60%;margin:0;background:#fff;border:2px solid;height: 18px;text-transform: Capitalize" onKeyup="validarFormulario()"/>
                                    </div>

                                    <div style="margin-right:10%;width:40%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 40%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;text-transform: Capitalize">Apellido 2</p>
                                            </div>
                                        </a>
                                        <input type="text" id="apellido2" name="apellido2" class="grey-input " style="width:60%;margin:0;background:#fff;border:2px solid;height: 18px;text-transform: Capitalize" />
                                    </div>

                                    <div style="margin-right:10%;width:40%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 40%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">RUT/DNI</p>
                                            </div>
                                        </a>
                                        <input type="text" id="rut" name="rut" class="grey-input " style="width:60%;margin:0;background:#fff;border:2px solid;height: 18px;" onKeyup="validarFormulario()"/>
                                    </div>

                                    <div style="margin-right:10%;width:40%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 40%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Fecha nac</p>
                                            </div>
                                        </a>
                                        <input type="text" readonly style="width:60%; height: 18px;background:#fff;" class="grey-input" id="fecha_nacimiento" name="fecha_nacimiento" />                   
                                    </div>

                                    <div style="margin-right:10%;width:40%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 34%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Nacionalidad</p>
                                            </div>
                                        </a>
                                        <select style="width:57%; height: 30px;background:#fff;border:2px solid" class="" id="nacionalidad" name="nacionalidad" onchange="">
                                            <option  value="NULL">Seleccione</option>
                                            <option value="AF">Afganistán</option><option value="AL">Albania</option><option value="DE">Alemania</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antártida</option><option value="AG">Antigua y Barbuda</option><option value="AN">Antillas Holandesas</option><option value="SA">Arabia Saudí</option><option value="DZ">Argelia</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaiyán</option><option value="BS">Bahamas</option><option value="BH">Bahrein</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BE">Bélgica</option><option value="BZ">Belice</option><option value="BJ">Benin</option><option value="BM">Bermudas</option><option value="BY">Bielorrusia</option><option value="MM">Birmania</option><option value="BO">Bolivia</option><option value="BA">Bosnia y Herzegovina</option><option value="BW">Botswana</option><option value="BR">Brasil</option><option value="BN">Brunei</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="BT">Bután</option><option value="CV">Cabo Verde</option><option value="KH">Camboya</option><option value="CM">Camerún</option><option value="CA">Canadá</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CY">Chipre</option><option value="VA">Ciudad del Vaticano (Santa Sede)</option><option value="CO">Colombia</option><option value="KM">Comores</option><option value="CG">Congo</option><option value="CD">Congo, República Democrática del</option><option value="KR">Corea</option><option value="KP">Corea del Norte</option><option value="CI">Costa de Marfíl</option><option value="CR">Costa Rica</option><option value="HR">Croacia (Hrvatska)</option><option value="CU">Cuba</option><option value="DK">Dinamarca</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="EC">Ecuador</option><option value="EG">Egipto</option><option value="SV">El Salvador</option><option value="AE">Emiratos Árabes Unidos</option><option value="ER">Eritrea</option><option value="SI">Eslovenia</option><option value="ES">España</option><option value="US">Estados Unidos</option><option value="EE">Estonia</option><option value="ET">Etiopía</option><option value="FJ">Fiji</option><option value="PH">Filipinas</option><option value="FI">Finlandia</option><option value="FR">Francia</option><option value="GA">Gabón</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GD">Granada</option><option value="GR">Grecia</option><option value="GL">Groenlandia</option><option value="GP">Guadalupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GY">Guayana</option><option value="GF">Guayana Francesa</option><option value="GN">Guinea</option><option value="GQ">Guinea Ecuatorial</option><option value="GW">Guinea-Bissau</option><option value="HT">Haití</option><option value="HN">Honduras</option><option value="HU">Hungría</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IQ">Irak</option><option value="IR">Irán</option><option value="IE">Irlanda</option><option value="BV">Isla Bouvet</option><option value="CX">Isla de Christmas</option><option value="IS">Islandia</option><option value="KY">Islas Caimán</option><option value="CK">Islas Cook</option><option value="CC">Islas de Cocos o Keeling</option><option value="FO">Islas Faroe</option><option value="HM">Islas Heard y McDonald</option><option value="FK">Islas Malvinas</option><option value="MP">Islas Marianas del Norte</option><option value="MH">Islas Marshall</option><option value="UM">Islas menores de Estados Unidos</option><option value="PW">Islas Palau</option><option value="SB">Islas Salomón</option><option value="SJ">Islas Svalbard y Jan Mayen</option><option value="TK">Islas Tokelau</option><option value="TC">Islas Turks y Caicos</option><option value="VI">Islas Vírgenes (EEUU)</option><option value="VG">Islas Vírgenes (Reino Unido)</option><option value="WF">Islas Wallis y Futuna</option><option value="IL">Israel</option><option value="IT">Italia</option>
<option value="JM">Jamaica</option><option value="JP">Japón</option><option value="JO">Jordania</option><option value="KZ">Kazajistán</option><option value="KE">Kenia</option><option value="KG">Kirguizistán</option><option value="KI">Kiribati</option><option value="KW">Kuwait</option><option value="LA">Laos</option><option value="LS">Lesotho</option><option value="LV">Letonia</option><option value="LB">Líbano</option><option value="LR">Liberia</option><option value="LY">Libia</option><option value="LI">Liechtenstein</option><option value="LT">Lituania</option><option value="LU">Luxemburgo</option><option value="MK">Macedonia, Ex-República Yugoslava de</option><option value="MG">Madagascar</option><option value="MY">Malasia</option><option value="MW">Malawi</option><option value="MV">Maldivas</option><option value="ML">Malí</option><option value="MT">Malta</option><option value="MA">Marruecos</option><option value="MQ">Martinica</option><option value="MU">Mauricio</option><option value="MR">Mauritania</option><option value="YT">Mayotte</option><option value="MX">México</option><option value="FM">Micronesia</option><option value="MD">Moldavia</option><option value="MC">Mónaco</option><option value="MN">Mongolia</option><option value="MS">Montserrat</option><option value="MZ">Mozambique</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NI">Nicaragua</option><option value="NE">Níger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk</option><option value="NO">Noruega</option><option value="NC">Nueva Caledonia</option><option value="NZ">Nueva Zelanda</option><option value="OM">Omán</option><option value="NL">Países Bajos</option><option value="PA">Panamá</option><option value="PG">Papúa Nueva Guinea</option><option value="PK">Paquistán</option><option value="PY">Paraguay</option><option value="PE">Perú</option><option value="PN">Pitcairn</option><option value="PF">Polinesia Francesa</option><option value="PL">Polonia</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="UK">Reino Unido</option><option value="CF">República Centroafricana</option><option value="CZ">República Checa</option><option value="ZA">República de Sudáfrica</option><option value="DO">República Dominicana</option><option value="SK">República Eslovaca</option><option value="RE">Reunión</option><option value="RW">Ruanda</option><option value="RO">Rumania</option><option value="RU">Rusia</option><option value="EH">Sahara Occidental</option><option value="KN">Saint Kitts y Nevis</option><option value="WS">Samoa</option><option value="AS">Samoa Americana</option><option value="SM">San Marino</option><option value="VC">San Vicente y Granadinas</option><option value="SH">Santa Helena</option><option value="LC">Santa Lucía</option><option value="ST">Santo Tomé y Príncipe</option><option value="SN">Senegal</option><option value="SC">Seychelles</option><option value="SL">Sierra Leona</option><option value="SG">Singapur</option><option value="SY">Siria</option><option value="SO">Somalia</option><option value="LK">Sri Lanka</option><option value="PM">St Pierre y Miquelon</option><option value="SZ">Suazilandia</option><option value="SD">Sudán</option><option value="SE">Suecia</option><option value="CH">Suiza</option><option value="SR">Surinam</option><option value="TH">Tailandia</option><option value="TW">Taiwán</option><option value="TZ">Tanzania</option><option value="TJ">Tayikistán</option><option value="TF">Territorios franceses del Sur</option><option value="TP">Timor Oriental</option><option value="TG">Togo</option><option value="TO">Tonga</option><option value="TT">Trinidad y Tobago</option><option value="TN">Túnez</option><option value="TM">Turkmenistán</option><option value="TR">Turquía</option><option value="TV">Tuvalu</option><option value="UA">Ucrania</option><option value="UG">Uganda</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistán</option><option value="VU">Vanuatu</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option value="YE">Yemen</option><option value="YU">Yugoslavia</option><option value="ZM">Zambia</option><option value="ZW">Zimbabue</option>
                                        </select>
                                    </div>

                                    <div style="margin-right:10%;width:40%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 34%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Nacionalidad Adi</p>
                                            </div>
                                        </a>
                                        <select style="width:57%; height: 30px;background:#fff;border:2px solid" class="" id="nacionalidad_adicional" name="nacionalidad_adicional" onchange="">
                                            <option  value="NULL">Seleccione</option>
                                            <option value="AF">Afganistán</option><option value="AL">Albania</option><option value="DE">Alemania</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antártida</option><option value="AG">Antigua y Barbuda</option><option value="AN">Antillas Holandesas</option><option value="SA">Arabia Saudí</option><option value="DZ">Argelia</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaiyán</option><option value="BS">Bahamas</option><option value="BH">Bahrein</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BE">Bélgica</option><option value="BZ">Belice</option><option value="BJ">Benin</option><option value="BM">Bermudas</option><option value="BY">Bielorrusia</option><option value="MM">Birmania</option><option value="BO">Bolivia</option><option value="BA">Bosnia y Herzegovina</option><option value="BW">Botswana</option><option value="BR">Brasil</option><option value="BN">Brunei</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="BT">Bután</option><option value="CV">Cabo Verde</option><option value="KH">Camboya</option><option value="CM">Camerún</option><option value="CA">Canadá</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CY">Chipre</option><option value="VA">Ciudad del Vaticano (Santa Sede)</option><option value="CO">Colombia</option><option value="KM">Comores</option><option value="CG">Congo</option><option value="CD">Congo, República Democrática del</option><option value="KR">Corea</option><option value="KP">Corea del Norte</option><option value="CI">Costa de Marfíl</option><option value="CR">Costa Rica</option><option value="HR">Croacia (Hrvatska)</option><option value="CU">Cuba</option><option value="DK">Dinamarca</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="EC">Ecuador</option><option value="EG">Egipto</option><option value="SV">El Salvador</option><option value="AE">Emiratos Árabes Unidos</option><option value="ER">Eritrea</option><option value="SI">Eslovenia</option><option value="ES">España</option><option value="US">Estados Unidos</option><option value="EE">Estonia</option><option value="ET">Etiopía</option><option value="FJ">Fiji</option><option value="PH">Filipinas</option><option value="FI">Finlandia</option><option value="FR">Francia</option><option value="GA">Gabón</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GD">Granada</option><option value="GR">Grecia</option><option value="GL">Groenlandia</option><option value="GP">Guadalupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GY">Guayana</option><option value="GF">Guayana Francesa</option><option value="GN">Guinea</option><option value="GQ">Guinea Ecuatorial</option><option value="GW">Guinea-Bissau</option><option value="HT">Haití</option><option value="HN">Honduras</option><option value="HU">Hungría</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IQ">Irak</option><option value="IR">Irán</option><option value="IE">Irlanda</option><option value="BV">Isla Bouvet</option><option value="CX">Isla de Christmas</option><option value="IS">Islandia</option><option value="KY">Islas Caimán</option><option value="CK">Islas Cook</option><option value="CC">Islas de Cocos o Keeling</option><option value="FO">Islas Faroe</option><option value="HM">Islas Heard y McDonald</option><option value="FK">Islas Malvinas</option><option value="MP">Islas Marianas del Norte</option><option value="MH">Islas Marshall</option><option value="UM">Islas menores de Estados Unidos</option><option value="PW">Islas Palau</option><option value="SB">Islas Salomón</option><option value="SJ">Islas Svalbard y Jan Mayen</option><option value="TK">Islas Tokelau</option><option value="TC">Islas Turks y Caicos</option><option value="VI">Islas Vírgenes (EEUU)</option><option value="VG">Islas Vírgenes (Reino Unido)</option><option value="WF">Islas Wallis y Futuna</option><option value="IL">Israel</option><option value="IT">Italia</option>
<option value="JM">Jamaica</option><option value="JP">Japón</option><option value="JO">Jordania</option><option value="KZ">Kazajistán</option><option value="KE">Kenia</option><option value="KG">Kirguizistán</option><option value="KI">Kiribati</option><option value="KW">Kuwait</option><option value="LA">Laos</option><option value="LS">Lesotho</option><option value="LV">Letonia</option><option value="LB">Líbano</option><option value="LR">Liberia</option><option value="LY">Libia</option><option value="LI">Liechtenstein</option><option value="LT">Lituania</option><option value="LU">Luxemburgo</option><option value="MK">Macedonia, Ex-República Yugoslava de</option><option value="MG">Madagascar</option><option value="MY">Malasia</option><option value="MW">Malawi</option><option value="MV">Maldivas</option><option value="ML">Malí</option><option value="MT">Malta</option><option value="MA">Marruecos</option><option value="MQ">Martinica</option><option value="MU">Mauricio</option><option value="MR">Mauritania</option><option value="YT">Mayotte</option><option value="MX">México</option><option value="FM">Micronesia</option><option value="MD">Moldavia</option><option value="MC">Mónaco</option><option value="MN">Mongolia</option><option value="MS">Montserrat</option><option value="MZ">Mozambique</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NI">Nicaragua</option><option value="NE">Níger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk</option><option value="NO">Noruega</option><option value="NC">Nueva Caledonia</option><option value="NZ">Nueva Zelanda</option><option value="OM">Omán</option><option value="NL">Países Bajos</option><option value="PA">Panamá</option><option value="PG">Papúa Nueva Guinea</option><option value="PK">Paquistán</option><option value="PY">Paraguay</option><option value="PE">Perú</option><option value="PN">Pitcairn</option><option value="PF">Polinesia Francesa</option><option value="PL">Polonia</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="UK">Reino Unido</option><option value="CF">República Centroafricana</option><option value="CZ">República Checa</option><option value="ZA">República de Sudáfrica</option><option value="DO">República Dominicana</option><option value="SK">República Eslovaca</option><option value="RE">Reunión</option><option value="RW">Ruanda</option><option value="RO">Rumania</option><option value="RU">Rusia</option><option value="EH">Sahara Occidental</option><option value="KN">Saint Kitts y Nevis</option><option value="WS">Samoa</option><option value="AS">Samoa Americana</option><option value="SM">San Marino</option><option value="VC">San Vicente y Granadinas</option><option value="SH">Santa Helena</option><option value="LC">Santa Lucía</option><option value="ST">Santo Tomé y Príncipe</option><option value="SN">Senegal</option><option value="SC">Seychelles</option><option value="SL">Sierra Leona</option><option value="SG">Singapur</option><option value="SY">Siria</option><option value="SO">Somalia</option><option value="LK">Sri Lanka</option><option value="PM">St Pierre y Miquelon</option><option value="SZ">Suazilandia</option><option value="SD">Sudán</option><option value="SE">Suecia</option><option value="CH">Suiza</option><option value="SR">Surinam</option><option value="TH">Tailandia</option><option value="TW">Taiwán</option><option value="TZ">Tanzania</option><option value="TJ">Tayikistán</option><option value="TF">Territorios franceses del Sur</option><option value="TP">Timor Oriental</option><option value="TG">Togo</option><option value="TO">Tonga</option><option value="TT">Trinidad y Tobago</option><option value="TN">Túnez</option><option value="TM">Turkmenistán</option><option value="TR">Turquía</option><option value="TV">Tuvalu</option><option value="UA">Ucrania</option><option value="UG">Uganda</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistán</option><option value="VU">Vanuatu</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option value="YE">Yemen</option><option value="YU">Yugoslavia</option><option value="ZM">Zambia</option><option value="ZW">Zimbabue</option>
                                        </select>
                                    </div>
                                    
                                    <div style="margin-right:10%;width:40%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 36%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Pie Hábil</p>
                                            </div>
                                        </a>
                                        <select style="width:60%; height: 30px;background:#fff;border:2px solid" class="" id="pie_habil" name="pie_habil" onchange="">
                                            <option  value="0">Derecho</option>
                                            <option value="1">Izquierdo</option>
                                            <option value="2">Ambidiestro</option>
                                        </select>
                                    </div>

                                    <div style="margin-right:10%;width:40%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 40%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Estatura (cm)</p>
                                            </div>
                                        </a>
                                        <input type="text" id="estatura" name="estatura" class="grey-input " style="width:60%;margin:0;background:#fff;border:2px solid;height: 18px;" onKeyup="validarFormulario()"/>
                                    </div>

                                    <div style="margin-right:10%;width:40%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 36%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Dorsal</p>
                                            </div>
                                        </a>
                                        <select style="width:60%; height: 30px;background:#fff;border:2px solid" class="" id="dorsal" name="dorsal" onchange="">
                                            
                                        </select>
                                    </div>



                                
                                
                                </div>
                                <div style="box-sizing:border-box;width:100%;height:135px;display:inline-flex;flex-direction:row;flex-wrap:wrap;">
                                    <div style=" margin-left:5%; margin-right:5%;width:25%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 40%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Correo</p>
                                            </div>
                                        </a>
                                        <input type="text" id="correo" name="correo" class="grey-input " style="width:60%;margin:0;background:#fff;border:2px solid;height: 18px;"/>
                                    </div>

                                    <div style="margin-right:6.5%;width:26%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 40%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Celular</p>
                                            </div>
                                        </a>
                                        <input type="text" id="telefono" name="telefono" class="grey-input " style="width:60%;margin:0;background:#fff;border:2px solid;height: 18px;"/>
                                    </div>

                                    <div style="margin-right:6%;width:26%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 36%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Posicion principal</p>
                                            </div>
                                        </a>
                                        <select style="width:60%; height: 30px;background:#fff;border:2px solid" class="" id="posicion" name="posicion" onchange="">
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
                                    <div style="width:25%;height: 30px;display:flex;margin-left:5%;margin-right:5%;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 36%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Posicion secundaria</p>
                                            </div>
                                        </a>
                                        <select style="width:60%; height: 30px;background:#fff;border:2px solid;" class="" id="posicion2" name="posicion2" onchange="">
                                            <option value="null">Seleccione</option>
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

                                    <div style=" margin-right:6.5%;width:26%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 36%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Previsión de salud</p>
                                            </div>
                                        </a>
                                        <select style="width:60%; height: 30px;background:#fff;border:2px solid" class="" id="prevision" name="prevision" onchange="">
                                            <option value="0">Fonasa A</option>
                                            <option value="1">Fonasa B</option>
                                            <option value="2">Fonasa C</option>
                                            <option value="3">Fonasa D</option>
                                            <option value="4">Isapre Banmedica</option>
                                            <option value="5">Isapre Vida tres</option>
                                            <option value="6">Isapre Colmena</option>
                                            <option value="7">Isapre Consalud</option>
                                            <option value="8">Isapre Cruz blanca</option>
                                            <option value="9">Isapre Nueva mas vida</option>
                                            <option value="10">Isapre Fusat</option>
                                            <option value="11">Isapre Isalud</option>
                                            <option value="12">Capredena</option>
                                            <option value="13">Dipreca</option>
                                            <option value="14">PRAIS</option>
                                            <option value="15">Ninguna</option>
                                        </select>
                                    </div>

                                    <div style="margin-right:6%;width:26%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 36%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Seguro Médico</p>
                                            </div>
                                        </a>
                                        <select style="width:60%; height: 30px;background:#fff;border:2px solid" class="" id="seguro" name="seguro" onchange="">
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>

                                    
                            
                                </div>
                            
                            
                            
                            
                            
                            </div>
                        </div>

                        <div style="box-sizing:border-box;width:95%;height:auto;margin-left:auto;margin-right:auto;margin-bottom:30px;background-color:#fff;">
                            <div style="box-sizing:border-box;width:100%;height:40px;background-color:#555;border-top-left-radius: 10px;border-top-right-radius: 10px;line-height: 40px;padding-left: 10px;color: #fff;font-size: 12px;">
                                DOCUMENTOS Y OTROS DATOS
                            </div>
                            <div style="box-sizing:border-box;width:100%;height:auto;border:2px solid #555;padding-top:10px;margin-bottom:10px;">
                                <div style="box-sizing:border-box;width:100%;display:inline-flex;flex-direction:row;flex-wrap:wrap;">

                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Nº Pasaporte</div>
                                        <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="pasaporte" id="pasaporte" />

                                    </div>

                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Fecha venc. Pasaporte</div>
                                        <input  readonly style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="fecha_vencimiento_pasaporte" id="fecha_vencimiento_pasaporte" />

                                    </div>

                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Fecha venc. DNI / C.I</div>
                                        <input  readonly style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="fecha_vencimiento_rut" id="fecha_vencimiento_rut" />

                                    </div>

                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Valor de mercado</div>
                                        <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="valor_mercado" id="valor_mercado" />

                                    </div>

                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Representante</div>
                                        <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="representante" id="representante" />

                                    </div>

                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Correo Representante</div>
                                        <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="correo_representante" id="correo_representante" />

                                    </div>

                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Telefono Representante</div>
                                        <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="telefono_representante" id="telefono_representante" />

                                    </div>


                                </div>
                        
                        
                        
                            </div>
                        </div>

                        <div style="box-sizing:border-box;width:95%;height:auto;margin-left:auto;margin-right:auto;margin-bottom:30px;background-color:#fff;">
                            <div style="box-sizing:border-box;width:100%;height:40px;background-color:#555;border-top-left-radius: 10px;border-top-right-radius: 10px;line-height: 40px;padding-left: 10px;color: #fff;font-size: 12px;">
                                DATOS DEPORTIVOS
                            </div>
                            <div style="box-sizing:border-box;width:100%;border:2px solid #555;padding-top:10px;margin-bottom:10px;">
                                <div style="box-sizing:border-box;width:100%;display:inline-flex;flex-direction:row;flex-wrap:wrap;">
                                    
                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Formado en</div>
                                        <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="formado_en" id="formado_en" onChange="activarCampoOtroClub(this.value)" >
                                            <option value="NULL">Seleccione</option>
                                            <option value="0">El club</option>
                                            <option value="1">Otro club</option>
                                            <option value="2">Co - formado</option>
                                        </select>

                                    </div>

                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;display:none;" id="campo_otro_club">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Club</div>
                                        <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="otro_club" id="otro_club" />

                                    </div>

                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Derechos federativos</div>
                                        <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="derecho_federativo" id="derecho_federativo" onChange="">
                                            <option value="0">Pertenece al club</option>
                                            <option value="1">No pertenece al club</option>
                                        </select>

                                    </div>

                                    <div id="contenedor_condicion" style="box-sizing:border-box;width:20%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Condición</div>
                                        <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="condicion" id="condicion" onChange="mostrarCampoCondicion(this.value)">
                                            
                                            <option value="5">En el club</option>
                                            <option value="2">Préstamo en el club</option>
                                            <option value="1">Préstamo en otro club</option>
                                            <option value="0">Eliminar</option>
                                        </select>

                                    </div>

                                    <!-- campos condicion prestamo club y prestamo en otro club -->

                                    <div id="campo_condicion_0_y_2"  style="box-sizing:border-box;width:100%;display:none;flex-direction:row;flex-wrap:wrap;">
                                        <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                            <div id="pais_condicion" style="font-size: 12px;font-weight: 900;color: #404040;">País club origen</div>
                                            <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="pais_origen_club" id="pais_origen_club" onChange="insertarClubPais(this.value)" >
                                                
                                            </select>

                                        </div>

                                        <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                            <div id="club_condicion" style="font-size: 12px;font-weight: 900;color: #404040;">Club origen</div>
                                            <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="origen_club" id="origen_club" onChange="" >
                                                
                                            </select>

                                        </div>

                                        <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Fecha inicio préstamo</div>
                                            <input  readonly style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="fecha_inicio_prestamo" id="fecha_inicio_prestamo" />

                                        </div>

                                        <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Fecha fin préstamo</div>
                                            <input  readonly style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="fecha_fin_prestamo" id="fecha_fin_prestamo" />

                                        </div>

                                        <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Valor préstamo</div>
                                            <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="valor_prestamo" id="valor_prestamo" />

                                        </div>

                                        <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Opcion de compra</div>
                                            <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="opcion_compra" id="opcion_compra" />

                                        </div>

                                        <div style="box-sizing:border-box;width:80%;margin-right:auto;margin-left:auto;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Observación</div>
                                            <textarea  style="box-sizing:border-box;width:100%;height:60px;border:2px solid #d2d2d2;resize: none;" type="text" name="observacion_datos_deportivos" id="observacion_datos_deportivos" ></textarea>

                                        </div>
                                        <div id="contenedor_fecha_fin_contrato_prestamo" style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Fecha fin contrato</div>
                                            <input  readonly style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="fecha_fin_contrato_prestamo" id="fecha_fin_contrato_prestamo" />

                                        </div>


                                    </div>

                                    <!-- ======================= -->

                                    <div id="campo_condicion_1"  style="box-sizing:border-box;width:100%;display:none;flex-direction:row;flex-wrap:wrap;">
                                        <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Año llega al club</div>
                                            <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="ano_llegada_club" id="ano_llegada_club" onChange="" >
                                                
                                            </select>

                                        </div>

                                        <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Fecha inicio contrato</div>
                                            <input  readonly style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="fecha_inicio_contrato" id="fecha_inicio_contrato" />

                                        </div>

                                        <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Fecha fin contrato</div>
                                            <input  readonly style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="fecha_fin_contrato" id="fecha_fin_contrato" />

                                        </div>

                                        <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Costos de derechos</div>
                                            <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="costos_derecho" id="costos_derecho" />

                                        </div>

                                        <div style="box-sizing:border-box;width:20%;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Cláusula de rescisión </div>
                                            <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="clausula_rescision" id="clausula_rescision" />

                                        </div>

                                        <div style="box-sizing:border-box;width:80%;margin-right:auto;margin-left:auto;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Observación</div>
                                            <textarea  style="box-sizing:border-box;width:100%;height:60px;border:2px solid #d2d2d2;resize: none;" type="text" name="observacion_datos_contrato_condicion_pertenece" id="observacion_datos_contrato_condicion_pertenece" ></textarea>

                                        </div>






                                        

                                    </div>


                                </div>

                        
                        
                            </div>
                        </div>

                        <div style="box-sizing:border-box;width:95%;margin-left:auto;margin-right:auto;margin-bottom:30px;background-color:#fff;">
                            <div style="box-sizing:border-box;width:100%;height:40px;background-color:#555;border-top-left-radius: 10px;border-top-right-radius: 10px;line-height: 40px;padding-left: 10px;color: #fff;font-size: 12px;">
                                DATOS CONTRATO
                            </div>
                            <div style="box-sizing:border-box;width:100%;border:2px solid #555;padding-top:10px;margin-bottom:10px;">
                                <div style="box-sizing:border-box;width:100%;display:inline-flex;flex-direction:row;flex-wrap:wrap;">
                                    
                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Sueldo bruto</div>
                                        <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="sueldo_bruto" id="sueldo_bruto" />

                                    </div>

                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Sueldo neto</div>
                                        <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="sueldo_neto" id="sueldo_neto" />

                                    </div>

                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Monto arriendo vivienda</div>
                                        <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="monto_arriendo_vivienda" id="monto_arriendo_vivienda" />

                                    </div>

                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Valor total contrato</div>
                                        <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="valor_total_contrato" id="valor_total_contrato" />

                                    </div>

                                    <div style="box-sizing:border-box;width:50%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Otros costos asociados</div>
                                        <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="otros_costos_asociados" id="otros_costos_asociados" />

                                    </div>

                                    <div style="box-sizing:border-box;width:80%;margin-left:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Premios pactados</div>
                                        <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="premios_pactados" id="premios_pactados" />

                                    </div>
                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Movilización</div>
                                        <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="movilizacion" id="movilizacion" />
                                    </div>
                                    
                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Colación</div>
                                        <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="colacion" id="colacion" />
                                    </div>
                                    
                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Desgaste</div>
                                        <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="desgaste" id="desgaste" />
                                    </div>
                                    
                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Viaticos</div>
                                        <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="viaticos" id="viaticos" />
                                    </div>

                                    <div style="box-sizing:border-box;width:50%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Otras remuneraciones</div>
                                        <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="remuneracion" id="remuneracion" />
                                    </div>

                                    <div style="box-sizing:border-box;width:80%;margin-right:auto;margin-left:auto;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Observación</div>
                                        <textarea  style="box-sizing:border-box;width:100%;height:60px;border:2px solid #d2d2d2;resize: none;" type="text" name="observacion_datos_contrato" id="observacion_datos_contrato" ></textarea>

                                    </div>
                                    
                                    
                            
                                </div>
                                <button style="margin-bottom: 10px;margin-left: auto;margin-right: 100px;width: 127px;display: block;margin-bottom:10px;" class="boton_agregar_ficha_jugador" onClick="agregarBono()"><b style="font-size:12px;"><i class="icon-plus"></i> Agregar bono</b></button>
                                <div id="contendor_lista_bono" >
                                    
                                </div>
                        
                            </div>
                        </div>

                        <div style="box-sizing:border-box;width:95%;margin-left:auto;margin-right:auto;margin-bottom:30px;background-color:#fff;">
                            <div style="box-sizing:border-box;width:100%;height:40px;background-color:#555;border-top-left-radius: 10px;border-top-right-radius: 10px;line-height: 40px;padding-left: 10px;color: #fff;font-size: 12px;">
                                RESCISION DE CONTRATO
                            </div>
                            <div style="box-sizing:border-box;width:100%;border:2px solid #555;margin-bottom:10px;">
                                <div style="box-sizing:border-box;width:100%;display:inline-flex;flex-direction:row;flex-wrap:wrap;">

                                    <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Estado</div>
                                        <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="estado" id="estado" onChange="datosContratoEstado(this.value)" >
                                                <option value="0">Contrato activo</option>
                                                <option value="1">Rescindir contrato</option>
                                        </select>
                                    </div>

                                    <div class="estado" style="box-sizing:border-box;width:20%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Fecha fin contrato</div>
                                        <input  readonly style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="fecha_termino_contrato" id="fecha_termino_contrato" onChange=""/>

                                    </div>

                                    <div class="estado" style="box-sizing:border-box;width:20%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Motivo</div>
                                        <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="motivo" id="motivo" onChange="" >
                                                <option value="0">Transferido a otro club</option>
                                                <option value="1">No fue renovado</option>
                                                <option value="2">Incumplimiento del contrato</option>
                                                <option value="3">Quedó libre</option>
                                                <option value="4">Se retira del fútbol</option>
                                                <option value="5">Finaliza préstamo</option>
                                                <option value="6">Otro</option>
                                        </select>
                                    </div>

                                    <div class="estado" style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Costos asociados</div>
                                        <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="costos_asociados" id="costos_asociados" />
                                    </div>

                                    <div class="estado" style="box-sizing:border-box;width:50%;margin-right:10%;">
                                        <div style="font-size: 12px;font-weight: 900;color: #404040;">Observación</div>
                                        <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="observacion_rescision_contrato" id="observacion_rescision_contrato" />
                                    </div>




                                
                                </div>
                            
                            </div>
                        </div>

                        <div style="box-sizing:border-box;width:95%;height:auto;margin-left:auto;margin-right:auto;margin-bottom:30px;background-color:#fff;">
                            <div style="box-sizing:border-box;width:100%;height:40px;background-color:#555;border-top-left-radius: 10px;border-top-right-radius: 10px;line-height: 40px;padding-left: 10px;color: #fff;font-size: 12px;">
                                ARCHIVOS
                            </div>
                            <div id="myModalValidacionPdf" class="modal hide" style="border-radius:10px;">
                                <div class="modal-header" style="background-color: #28b779; border-top-right-radius: 5px; border-top-left-radius: 5px;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
                                </div>
                                <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
                                <center>
                                        <br>
                                        <div id="mensaje_validacion_pdf">
                                        <h5><b style="color:#f26027; ">Alerta:</b> no se ha seleccionado ningun archivo por favor intente de nuevo.</h5>
                                        </div>
                                        <br>
                                </center>
                                </div>
                                <div class="modal-footer" style="background-color:#28b779; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
                                    <center><button type="button" class="btn btn-default boton_modal" data-dismiss="modal" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> Ok</button> </center>
                                    
                                </div>
                            </div>
                            <div style="box-sizing:border-box;width:100%;border:2px solid #555;margin-bottom:10px;padding-top:10px;">
                            <button style="margin-bottom: 10px;margin-left: auto;margin-right: 100px;width: 127px;display: block;margin-bottom:10px;" class="boton_agregar_ficha_jugador" onClick="agregarPdf()"><b style="font-size:12px;"><i class="icon-plus"></i> Agregar pdf</b></button>
                            <div id="contendor_lista_pdf" >
                               

                            </div>
                        
                            </div>
                        </div>


                        <div id="editar_prestamos" style="box-sizing:border-box;width:95%;height:auto;margin-left:auto;margin-right:auto;margin-bottom:30px;background-color:#fff;">
                                <div style="box-sizing:border-box;width:100%;height:40px;background-color:#00b14b;border-top-left-radius: 10px;border-top-right-radius: 10px;line-height: 40px;padding-left: 10px;color: #fff;font-size: 12px;">
                                    EDITAR PRÉSTAMOS
                                </div>
                                <div style="box-sizing:border-box;width:100%;border:2px solid #00b14b;padding-top:10px;margin-bottom:10px;">
                                    <div style="box-sizing:border-box;width:100%;display:inline-flex;flex-direction:row;flex-wrap:wrap;">
                                        
                                        <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Tipo de préstamo</div>
                                            <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="tipo_prestamo" id="tipo_prestamo_edita" onChange="consultarTipoPrestamosJugador(this.value)" >
                                                <option value="NULL">Seleccione</option>
                                                <option value="2">Préstamo en el club</option>
                                                <option value="1">Préstamo en otro club</option>
                                            </select>

                                        </div>

                                        <div id="editar_prestamo_jugador" style="box-sizing:border-box;width:50%;margin-right:10%;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Préstamo jugador</div>
                                            <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="prestamo_jugador" id="prestamo_jugador" onChange="mostrarDatosPrestamo(this.value)">
                                                
                                            </select>

                                        </div>

                                        <!-- ======================================================================================== -->

                                        <div id="campos_editar_prestamos"  style="box-sizing:border-box;width:100%;display:none;flex-direction:row;flex-wrap:wrap;">
                                            <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                                <div id="pais_condicion_editar" style="font-size: 12px;font-weight: 900;color: #404040;">País club origen</div>
                                                <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="editar_pais_origen_club" id="editar_pais_origen_club" onChange="insertarClubPaisEditar(this.value)" >
                                                    
                                                </select>

                                            </div>

                                            <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                                <div id="club_condicion_editar" style="font-size: 12px;font-weight: 900;color: #404040;">Club origen</div>
                                                <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="editar_origen_club" id="editar_origen_club" onChange="" >
                                                    
                                                </select>

                                            </div>

                                            <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                                <div style="font-size: 12px;font-weight: 900;color: #404040;">Fecha inicio préstamo</div>
                                                <input  readonly style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="editar_fecha_inicio_prestamo" id="editar_fecha_inicio_prestamo" />

                                            </div>

                                            <div style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                                <div style="font-size: 12px;font-weight: 900;color: #404040;">Fecha fin préstamo</div>
                                                <input  readonly style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="editar_fecha_fin_prestamo" id="editar_fecha_fin_prestamo" />

                                            </div>

                                            <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                                <div style="font-size: 12px;font-weight: 900;color: #404040;">Valor préstamo</div>
                                                <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="editar_valor_prestamo" id="editar_valor_prestamo" />

                                            </div>

                                            <div style="box-sizing:border-box;width:20%;margin-right:10%;">
                                                <div style="font-size: 12px;font-weight: 900;color: #404040;">Opcion de compra</div>
                                                <input  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="editar_opcion_compra" id="editar_opcion_compra" />

                                            </div>

                                            <div style="box-sizing:border-box;width:80%;margin-right:auto;margin-left:auto;">
                                                <div style="font-size: 12px;font-weight: 900;color: #404040;">Observación</div>
                                                <textarea  style="box-sizing:border-box;width:100%;height:60px;border:2px solid #d2d2d2;resize: none;" type="text" name="editar_observacion_datos_deportivos" id="editar_observacion_datos_deportivos" ></textarea>

                                            </div>

                                            <div id="contenedor_fecha_fin_contrato_prestamo_editar" style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">
                                                <div style="font-size: 12px;font-weight: 900;color: #404040;">Fecha fin contrato</div>
                                                <input  readonly style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="fecha_fin_contrato_prestamo_editar" id="fecha_fin_contrato_prestamo_editar" />
                                            </div>
                                            

                                            

                                        </div>
                                        <!-- f44336 -->
                                        <input  class="boton_actuzaliar_prestamo" id="" type="button" value="Actualizar" onClick="mostrarModalEnviarDatosEditarPrestamo(this)"  style="display:none;box-sizing:border-box;width:10%;margin-right:1%;margin-left:10%;margin-bottom:15px;outline: none;color: #fff;background-color: #00b14b;border: 0;border-radius: 3px;" />
                                        <input  class="boton_eliminar_prestamo" id="" type="button" value="Eliminar" onClick="mostrarModalEliminarPrestamo(this)"  style="display:none;box-sizing:border-box;width:10%;margin-right:10%;margin-left:0;margin-bottom:15px;outline: none;color: #fff;background-color: #f44336;border: 0;border-radius: 3px;" />

                                    </div>
                            
                            
                                </div>
                            </div>

                        <!-- ============================================================================================= -->

                        <div style="box-sizing:border-box;border:0;width: 240px;margin-left: auto;margin-right:auto;">
                            <button type="button" ng-disabled="" class="boton_guardar_informe" onClick="mostrarModalEnviarDatos()" id="boton_agregar_infrome"><i class="icon-plus"></i> AGREGAR FICHA JUGADOR</button>
                        </div>

                        <div id="uploadImageModal" class="modal hide" role="dialog" style="border-radius:10px;">
                            <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title" style="text-align: center;"><img src="img/logo3.png" style="height: 30px; width: 265px;"></h4>
                            </div>
                            <div class="modal-body" style=" background-color: black; color: white; font-family: Arial, Helvetica, sans-serif; text-align: center;">
                                <div class="imagen_subir_foto" id="image_demo" style="width:350px; margin: 10px auto 0px;"></div>      
                                <div class="texto_subir_foto" style=" margin: 10px auto 0px;"></div>
                            </div>
                            <div class="modal-footer" style="background-color: <?php echo $color_fondo; ?>; text-align: center; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                                <button type="button" id="crop_image_jugador" class="btn btn-default boton_modal" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> USAR ESTA IMAGEN</button>
                            </div>
                        </div>

                    </form>

                    <div id="vista_info_ficha_jugador" style="box-sizing:border-box;border:0;width: 100%;display:none;min-height:1300px;">
                        <!-- <h1>vista ficha jugador </h1> -->

                        <!-- <button class="boton_volver" onclick="botonVolverDeinfoAInicio();" style="margin-left:10px;margin-bottom:15px;margin-top:15px;"><i class="icon-arrow-left"></i> volver</button> -->

                        <div class="baner_info_ficha_jugador" >

                            <div style="box-sizing:border-box;border:0;width: 100%;height:100%;display:inline-flex;flex-direction:row;flex-wrap:wrap;">

                                <div style="box-sizing:border-box;border:0;width: 25%;padding-top:10px;padding-left:10px;padding-top:20px;padding-top:50px;">

                                    <div id="info_ficha_jugador_dorsal" style="box-sizing:border-box;border:0;color:#fff;font-size:58px;height:30px;margin-bottom:20px;font-weight: bold;">
                                        0
                                    </div>
                                    <div id="info_ficha_jugador_nombre_apellido1" style="box-sizing:border-box;border:0;color:#fff;font-size:20px;height:20px;text-transform: uppercase;">
                                        Nombre
                                    </div>
                                    <div id="info_ficha_jugador_apellido2" style="box-sizing:border-box;border:0;color:#fff;font-size:40px;height:48px;font-weight: 600;text-transform: uppercase;padding-top: 10px;overflow:hidden;">
                                        Apellido
                                    </div>


                                </div>

                                <div style="box-sizing:border-box;border:0;width: 12%;padding-top:50px;padding-left:1px;">
                                    <div style="box-sizing:border-box;border:0;color:#fff;font-size:10px;height:18px;font-weight: 900;margin-bottom:5px;">FECHA NAC: <span id="info_ficha_jugador_fecha_nacimiento" style="font-weight: normal;">0000 / 00 / 00</span></div>
                                    <div style="box-sizing:border-box;border:0;color:#fff;font-size:10px;height:18px;font-weight: 900;margin-bottom:5px;">EDAD: <span id="info_ficha_jugador_edad" style="font-weight: normal;">XX Años</span></div>
                                    <div style="box-sizing:border-box;border:0;color:#fff;font-size:10px;height:18px;font-weight: 900;margin-bottom:5px;">NACIONALIDAD:  <span id="info_ficha_jugador_nacionalidad" style="font-weight: normal;">X</span></div>
                                    <div style="box-sizing:border-box;border:0;color:#fff;font-size:10px;height:18px;font-weight: 900;margin-bottom:5px;">PIE HABIL: <span id="info_ficha_jugador_pie" style="font-weight: normal;">p i e</span></div>
                                    <div style="box-sizing:border-box;border:0;color:#fff;font-size:10px;height:18px;font-weight: 900;margin-bottom:5px;">RUT/DNI: <span id="info_ficha_jugador_rut"  style="font-weight: normal;">27636392</span></div>
                                </div>

                                <div style="box-sizing:border-box;border:0;width: 20%;background-color:transparen;padding-top:10px;">

                                    <div style="box-sizing:border-box;border:0;width: 190px;height:190px;border-radius:100px;margin-left:auto;margin-right:auto;overflow:hidden;border:4px solid #ccc;background-color:#fff;">
                                        <img  id="info_ficha_jugador_foto_jugador" style="box-sizing:border-box;border:0;width: 190px;height:190px;" src="./img/jugador2.png" alt="imagen_info_jugador">
                                    </div>

                                </div>

                                <div style="box-sizing:border-box;border:0;width: 43%;">
                                <!-- background-color:aqua; -->
                                    <div style="box-sizing:border-box;border:0;width: 100%;text-align:center;font-weight: 900;margin-bottom:5px;">Posición: <span id="info_ficha_jugador_posicion" style="font-weight: normal;">X X X</span> </div>
                                    <div style="box-sizing:border-box;border:0;width: 50%;height:150px;margin-left:auto;margin-right:auto;">
                                        <img  id="info_ficha_jugador_foto_cancha_posicion" style="box-sizing:border-box;border:0;width: 100%;height:100%;" src="" alt="posicion_cancha_jugador">
                                    </div>
                                    <button class="boton_volver" onclick="botonVolverDeinfoAInicio();" style="position:absolute;margin-top:-180px;right:5px;color:#111;border:1px solid #111;"><i class="icon-arrow-left"></i> volver</button>

                                </div>


                            </div>

                        </div>
                        <div id="botonera_menu_info_jugador" style="box-sizing:border-box;border:0;width: 100%;height:30px;background-color:#404040;margin-bottom:30px;display:inline-flex;flex-direction:row;flex-wrap:wrap;">

                            <label for="seccion_info_jugador_resume" id="seccion_info_jugador_resume_pest" style="box-sizing:border-box;border:0;width: 10%;height:100%;display:inline-block;color:#fff;text-align:center;font-weight:700;line-height:30px;cursor:pointer;font-size:10px;">RESUMEN</label>
                            <label for="seccion_info_jugador_personales" id="seccion_info_jugador_personales_pest" style="box-sizing:border-box;border:0;width: 10%;height:100%;display:inline-block;color:#fff;text-align:center;font-weight:700;line-height:30px;cursor:pointer;font-size:10px;">PERSONALES</label>
                            <label for="seccion_info_jugador_partidos" id="seccion_info_jugador_partidos_pest" style="box-sizing:border-box;border:0;width: 10%;height:100%;display:inline-block;color:#fff;text-align:center;font-weight:700;line-height:30px;cursor:pointer;font-size:10px;">PARTIDOS</label>
                            <label for="seccion_info_jugador_estadisticas" id="seccion_info_jugador_estadisticas_pest" style="box-sizing:border-box;border:0;width: 10%;height:100%;display:inline-block;color:#fff;text-align:center;font-weight:700;line-height:30px;cursor:pointer;font-size:10px;">ESTADISTICAS</label>
                            <label for="seccion_info_jugador_lesiones" id="seccion_info_jugador_lesiones_pest" style="box-sizing:border-box;border:0;width: 10%;height:100%;display:inline-block;color:#fff;text-align:center;font-weight:700;line-height:30px;cursor:pointer;font-size:10px;">LESIONES</label>
                            <label for="seccion_info_jugador_antro" id="seccion_info_jugador_antro_pest" style="box-sizing:border-box;border:0;width: 10%;height:100%;display:inline-block;color:#fff;text-align:center;font-weight:700;line-height:30px;cursor:pointer;font-size:10px;">ANTROPOMETRIA</label>
                            <label for="seccion_info_jugador_test" id="seccion_info_jugador_test_pest" style="box-sizing:border-box;border:0;width: 10%;height:100%;display:inline-block;color:#fff;text-align:center;font-weight:700;line-height:30px;cursor:pointer;font-size:10px;">TEST FISICO</label>
                            <label for="seccion_info_jugador_tratamiento" id="seccion_info_jugador_tratamiento_pest" style="box-sizing:border-box;border:0;width: 10%;height:100%;display:inline-block;color:#fff;text-align:center;font-weight:700;line-height:30px;cursor:pointer;font-size:10px;">TRATAMIENTOS</label>
                            <label for="seccion_info_jugador_seleccion" id="seccion_info_jugador_seleccion_pest" style="box-sizing:border-box;border:0;width: 10%;height:100%;display:inline-block;color:#fff;text-align:center;font-weight:700;line-height:30px;cursor:pointer;font-size:10px;">SELECCION</label>
                            <label for="seccion_info_jugador_prestamos" id="seccion_info_jugador_prestamos_pest" style="box-sizing:border-box;border:0;width: 10%;height:100%;display:inline-block;color:#fff;text-align:center;font-weight:700;line-height:30px;cursor:pointer;font-size:10px;">PRESTAMOS</label>
                            <!-- =================================================== -->
                            <input type="radio" style="display:none;" name="radio_seccion_ficha_jugador" id="seccion_info_jugador_resume" onClick="seccionInfoJugador()"/>
                            <input type="radio" style="display:none;" name="radio_seccion_ficha_jugador" id="seccion_info_jugador_personales" onClick="seccionInfoJugador()"/>
                            <input type="radio" style="display:none;" name="radio_seccion_ficha_jugador" id="seccion_info_jugador_partidos" onClick="seccionInfoJugador()"/>
                            <input type="radio" style="display:none;" name="radio_seccion_ficha_jugador" id="seccion_info_jugador_estadisticas" onClick="seccionInfoJugador()"/>
                            <input type="radio" style="display:none;" name="radio_seccion_ficha_jugador" id="seccion_info_jugador_lesiones" onClick="seccionInfoJugador()"/>
                            <input type="radio" style="display:none;" name="radio_seccion_ficha_jugador" id="seccion_info_jugador_antro" onClick="seccionInfoJugador()"/>
                            <input type="radio" style="display:none;" name="radio_seccion_ficha_jugador" id="seccion_info_jugador_test" onClick="seccionInfoJugador()"/>
                            <input type="radio" style="display:none;" name="radio_seccion_ficha_jugador" id="seccion_info_jugador_tratamiento" onClick="seccionInfoJugador()"/>
                            <input type="radio" style="display:none;" name="radio_seccion_ficha_jugador" id="seccion_info_jugador_seleccion" onClick="seccionInfoJugador()"/>
                            <input type="radio" style="display:none;" name="radio_seccion_ficha_jugador" id="seccion_info_jugador_prestamos" onClick="seccionInfoJugador()"/>
                        </div>
                        
                        <div style="display:none;" id="seccion_info_jugador_resume_apartado">
                            <h1> apartado resume</h1>
                        </div>

                        <div style="box-sizing:border-box;border:0;display:none;width:100%;height:400px;flex-direction:row;flex-wrap:wrap;justify-content:space-evenly;" id="seccion_info_jugador_personales_apartado" >
                            <!-- <h1> apartado personales</h1> -->

                            <div style="box-sizing:border-box;border:0;width:21%;height:400px;">
                                <div style="box-sizing:border-box;border:0;width:100%;height:6.8%;color:#fff;background-color:#555;line-height:30px;font-weight:700;font-size:10px;text-transform:capitalize;text-align:center;border-top-right-radius: 5px;border-top-left-radius: 5px;">
                                    general
                                </div>
                                <div style="box-sizing:border-box;border:0;width:100%;height:93.2%;border:1px solid #555;font-size:10px;background-color:#fff;">

                                    <div style="box-sizing:border-box;border:0;width:auto;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Nombre :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-word;" id="presonal_nombre_ficha_jugador"></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">RUT/DNI :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;" id="presonal_rut_ficha_jugador"></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Fecha de Naci. :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;" id="presonal_fecha_nacimiento_ficha_jugador"></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">País de Naci. :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;"><br></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Direccion :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;"><br></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Comuna :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;"><br></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Ciudad :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;"><br></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Region :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;"><br></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Nac. Principal :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;" id="presonal_nacionalidad_1_ficha_jugador"></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Nac. Adicional :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;" id="presonal_nacionalidad_2_ficha_jugador"></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:25px;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Email :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;" id="presonal_correo_ficha_jugador"></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:25px;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Teléfono :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;" id="presonal_telefono_ficha_jugador"></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Institución :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;"><br></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Curso :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;"><br></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Prevision :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-word;" id="presonal_prevision_ficha_jugador" ><br></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Seguro :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;" id="presonal_seguro_ficha_jugador"></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Cia. seguro :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;"><br></div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Venc. seguro :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;"><br></div>
                                    </div>

                                    
                                
                            
                                </div>
                                
                            </div>

                            <div style="box-sizing:border-box;border:0;width:21%;height:400px;">

                                <div style="box-sizing:border-box;border:0;width:100%;height:150px;margin-bottom:15px;">
                                    <div style="box-sizing:border-box;border:0;width:100%;height:19%;color:#fff;background-color:#555;line-height:30px;font-weight:700;font-size:10px;text-transform:capitalize;text-align:center;border-top-right-radius: 5px;border-top-left-radius: 5px;">
                                        documentos
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:81.2%;border:1px solid #555;font-size:10px;background-color:#fff;">

                                        <div style="box-sizing:border-box;border:0;width:100%;height:16.66%;">
                                            <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Pasaporte :</div>
                                            <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;" id="presonal_pasaporte_ficha_jugador"></div>
                                        </div>

                                        <div style="box-sizing:border-box;border:0;width:100%;height:16.66%;">
                                            <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Fecha venc. pasa. :</div>
                                            <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;" id="presonal_fecha_vencimiento_pasaporte_ficha_jugador"></div>
                                        </div>

                                        <div style="box-sizing:border-box;border:0;width:100%;height:66.68%;">
                                            <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Fecha venc. RUT:</div>
                                            <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;" id="presonal_fecha_vencimiento_rut_ficha_jugador"></div>
                                        </div>

                                    </div>
                            
                                </div>

                                <div style="box-sizing:border-box;border:0;width:100%;height:150px;margin-bottom:15px;">
                                    <div style="box-sizing:border-box;border:0;width:100%;height:19%;color:#fff;background-color:#555;line-height:30px;font-weight:700;font-size:10px;text-transform:capitalize;text-align:center;border-top-right-radius: 5px;border-top-left-radius: 5px;">
                                        representante
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:81.2%;border:1px solid #555;font-size:10px;background-color:#fff;">

                                        <div style="box-sizing:border-box;border:0;width:100%;height:16.66%;">
                                            <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Valor de Mercado :</div>
                                            <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;" id="presonal_valor_mercado_ficha_jugador"></div>
                                        </div>

                                        <div style="box-sizing:border-box;border:0;width:100%;height:16.66%;">
                                            <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Representante :</div>
                                            <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;" id="presonal_representante_ficha_jugador"></div>
                                        </div>

                                        <div style="box-sizing:border-box;border:0;width:100%;height:66.68%;">
                                            <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Correp Rep. :</div>
                                            <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break: break-all;" id="presonal_correo_representante_ficha_jugador"></div>
                                        </div>

                                    </div>
                            
                                </div>

                            </div>

                            <div style="box-sizing:border-box;border:0;width:21%;height:auto;">
                                <div style="box-sizing:border-box;border:0;width:100%;height:6.8%;color:#fff;background-color:#555;line-height:30px;font-weight:700;font-size:10px;text-transform:capitalize;text-align:center;border-top-right-radius: 5px;border-top-left-radius: 5px;">
                                    datos deportivos
                                </div>
                                <div style="box-sizing:border-box;border:0;width:100%;height:93.2%;border:1px solid #555;font-size:10px;background-color:#fff;">

                                    <div style="box-sizing:border-box;border:0;width:100%;height:25px;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Estatura :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;" id="presonal_estatura_ficha_jugador">x</div>
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:25px;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Dorsal :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;" id="presonal_dorsal_ficha_jugador">x</div>
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:25px;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Formado en :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;" id="presonal_formado_en_ficha_jugador"></div>
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Condición :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;" id="presonal_condicion_ficha_jugador">x</div>
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:25px;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Sueldo bruto :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;" id="presonal_sueldo_bruto_ficha_jugador">x</div>
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:25px;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Sueldo neto :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;" id="presonal_sueldo_neto_ficha_jugador">x</div>
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:25px;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Monto vivienda :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;" id="presonal_monto_vivienda_ficha_jugador">x</div>
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:25px;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Valor total contrato:</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;" id="presonal_monto_total_contrato_ficha_jugador"></div>
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Otros costos :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break:break-all;" id="presonal_otros_costos_asociados_ficha_jugador">x</div>
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Premios pactados :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break:break-all;" id="presonal_premios_pactados_ficha_jugador">xxxxxxxxxxxxxxxxxxxxxxxxxxxx</div>
                                    </div>


                                    <div style="box-sizing:border-box;border:0;width:100%;height:25px;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Movilización :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break:break-all;" id="presonal_movilizacion_ficha_jugador">xxxxxxxxxxxxxxxxxxxxxxxxxxxx</div>
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:25px;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Colocación :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break:break-all;" id="presonal_colocacion_ficha_jugador">xxxxxxxxxxxxxxxxxxxxxxxxxxxx</div>
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:25px;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Desgaste :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break:break-all;" id="presonal_desgaste_ficha_jugador">xxxxxxxxxxxxxxxxxxxxxxxxxxxx</div>
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:25px;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Viaticos :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break:break-all;" id="presonal_viaticos_ficha_jugador">xxxxxxxxxxxxxxxxxxxxxxxxxxxx</div>
                                    </div>
                                    <div style="box-sizing:border-box;border:0;width:100%;height:50px;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;">Otras Rem. :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break:break-all;" id="presonal_remuneracion_ficha_jugador">xxxxxxxxxxxxxxxxxxxxxxxxxxxx</div>
                                    </div>


                                    <div style="box-sizing:border-box;border:0;width:100%;height:auto;">
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;padding-left:2px;font-weight:900;color:#555;margin-bottom: 38px;">Observación :</div>
                                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;word-break:break-all;margin-bottom: 38px;" id="presonal_observacion_ficha_jugador">xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx</div>
                                    </div>
                                    

                                </div>
                                <select id="paises_ocultos" style="display:none;" >
                                            <option  value="NULL">Seleccione</option>
                                            <option value="AF">Afganistán</option><option value="AL">Albania</option><option value="DE">Alemania</option><option value="AD">Andorra</option><option value="AO">Angola</option><option value="AI">Anguilla</option><option value="AQ">Antártida</option><option value="AG">Antigua y Barbuda</option><option value="AN">Antillas Holandesas</option><option value="SA">Arabia Saudí</option><option value="DZ">Argelia</option><option value="AR">Argentina</option><option value="AM">Armenia</option><option value="AW">Aruba</option><option value="AU">Australia</option><option value="AT">Austria</option><option value="AZ">Azerbaiyán</option><option value="BS">Bahamas</option><option value="BH">Bahrein</option><option value="BD">Bangladesh</option><option value="BB">Barbados</option><option value="BE">Bélgica</option><option value="BZ">Belice</option><option value="BJ">Benin</option><option value="BM">Bermudas</option><option value="BY">Bielorrusia</option><option value="MM">Birmania</option><option value="BO">Bolivia</option><option value="BA">Bosnia y Herzegovina</option><option value="BW">Botswana</option><option value="BR">Brasil</option><option value="BN">Brunei</option><option value="BG">Bulgaria</option><option value="BF">Burkina Faso</option><option value="BI">Burundi</option><option value="BT">Bután</option><option value="CV">Cabo Verde</option><option value="KH">Camboya</option><option value="CM">Camerún</option><option value="CA">Canadá</option><option value="TD">Chad</option><option value="CL">Chile</option><option value="CN">China</option><option value="CY">Chipre</option><option value="VA">Ciudad del Vaticano (Santa Sede)</option><option value="CO">Colombia</option><option value="KM">Comores</option><option value="CG">Congo</option><option value="CD">Congo, República Democrática del</option><option value="KR">Corea</option><option value="KP">Corea del Norte</option><option value="CI">Costa de Marfíl</option><option value="CR">Costa Rica</option><option value="HR">Croacia (Hrvatska)</option><option value="CU">Cuba</option><option value="DK">Dinamarca</option><option value="DJ">Djibouti</option><option value="DM">Dominica</option><option value="EC">Ecuador</option><option value="EG">Egipto</option><option value="SV">El Salvador</option><option value="AE">Emiratos Árabes Unidos</option><option value="ER">Eritrea</option><option value="SI">Eslovenia</option><option value="ES">España</option><option value="US">Estados Unidos</option><option value="EE">Estonia</option><option value="ET">Etiopía</option><option value="FJ">Fiji</option><option value="PH">Filipinas</option><option value="FI">Finlandia</option><option value="FR">Francia</option><option value="GA">Gabón</option><option value="GM">Gambia</option><option value="GE">Georgia</option><option value="GH">Ghana</option><option value="GI">Gibraltar</option><option value="GD">Granada</option><option value="GR">Grecia</option><option value="GL">Groenlandia</option><option value="GP">Guadalupe</option><option value="GU">Guam</option><option value="GT">Guatemala</option><option value="GY">Guayana</option><option value="GF">Guayana Francesa</option><option value="GN">Guinea</option><option value="GQ">Guinea Ecuatorial</option><option value="GW">Guinea-Bissau</option><option value="HT">Haití</option><option value="HN">Honduras</option><option value="HU">Hungría</option><option value="IN">India</option><option value="ID">Indonesia</option><option value="IQ">Irak</option><option value="IR">Irán</option><option value="IE">Irlanda</option><option value="BV">Isla Bouvet</option><option value="CX">Isla de Christmas</option><option value="IS">Islandia</option><option value="KY">Islas Caimán</option><option value="CK">Islas Cook</option><option value="CC">Islas de Cocos o Keeling</option><option value="FO">Islas Faroe</option><option value="HM">Islas Heard y McDonald</option><option value="FK">Islas Malvinas</option><option value="MP">Islas Marianas del Norte</option><option value="MH">Islas Marshall</option><option value="UM">Islas menores de Estados Unidos</option><option value="PW">Islas Palau</option><option value="SB">Islas Salomón</option><option value="SJ">Islas Svalbard y Jan Mayen</option><option value="TK">Islas Tokelau</option><option value="TC">Islas Turks y Caicos</option><option value="VI">Islas Vírgenes (EEUU)</option><option value="VG">Islas Vírgenes (Reino Unido)</option><option value="WF">Islas Wallis y Futuna</option><option value="IL">Israel</option><option value="IT">Italia</option>
<option value="JM">Jamaica</option><option value="JP">Japón</option><option value="JO">Jordania</option><option value="KZ">Kazajistán</option><option value="KE">Kenia</option><option value="KG">Kirguizistán</option><option value="KI">Kiribati</option><option value="KW">Kuwait</option><option value="LA">Laos</option><option value="LS">Lesotho</option><option value="LV">Letonia</option><option value="LB">Líbano</option><option value="LR">Liberia</option><option value="LY">Libia</option><option value="LI">Liechtenstein</option><option value="LT">Lituania</option><option value="LU">Luxemburgo</option><option value="MK">Macedonia, Ex-República Yugoslava de</option><option value="MG">Madagascar</option><option value="MY">Malasia</option><option value="MW">Malawi</option><option value="MV">Maldivas</option><option value="ML">Malí</option><option value="MT">Malta</option><option value="MA">Marruecos</option><option value="MQ">Martinica</option><option value="MU">Mauricio</option><option value="MR">Mauritania</option><option value="YT">Mayotte</option><option value="MX">México</option><option value="FM">Micronesia</option><option value="MD">Moldavia</option><option value="MC">Mónaco</option><option value="MN">Mongolia</option><option value="MS">Montserrat</option><option value="MZ">Mozambique</option><option value="NA">Namibia</option><option value="NR">Nauru</option><option value="NP">Nepal</option><option value="NI">Nicaragua</option><option value="NE">Níger</option><option value="NG">Nigeria</option><option value="NU">Niue</option><option value="NF">Norfolk</option><option value="NO">Noruega</option><option value="NC">Nueva Caledonia</option><option value="NZ">Nueva Zelanda</option><option value="OM">Omán</option><option value="NL">Países Bajos</option><option value="PA">Panamá</option><option value="PG">Papúa Nueva Guinea</option><option value="PK">Paquistán</option><option value="PY">Paraguay</option><option value="PE">Perú</option><option value="PN">Pitcairn</option><option value="PF">Polinesia Francesa</option><option value="PL">Polonia</option><option value="PT">Portugal</option><option value="PR">Puerto Rico</option><option value="QA">Qatar</option><option value="UK">Reino Unido</option><option value="CF">República Centroafricana</option><option value="CZ">República Checa</option><option value="ZA">República de Sudáfrica</option><option value="DO">República Dominicana</option><option value="SK">República Eslovaca</option><option value="RE">Reunión</option><option value="RW">Ruanda</option><option value="RO">Rumania</option><option value="RU">Rusia</option><option value="EH">Sahara Occidental</option><option value="KN">Saint Kitts y Nevis</option><option value="WS">Samoa</option><option value="AS">Samoa Americana</option><option value="SM">San Marino</option><option value="VC">San Vicente y Granadinas</option><option value="SH">Santa Helena</option><option value="LC">Santa Lucía</option><option value="ST">Santo Tomé y Príncipe</option><option value="SN">Senegal</option><option value="SC">Seychelles</option><option value="SL">Sierra Leona</option><option value="SG">Singapur</option><option value="SY">Siria</option><option value="SO">Somalia</option><option value="LK">Sri Lanka</option><option value="PM">St Pierre y Miquelon</option><option value="SZ">Suazilandia</option><option value="SD">Sudán</option><option value="SE">Suecia</option><option value="CH">Suiza</option><option value="SR">Surinam</option><option value="TH">Tailandia</option><option value="TW">Taiwán</option><option value="TZ">Tanzania</option><option value="TJ">Tayikistán</option><option value="TF">Territorios franceses del Sur</option><option value="TP">Timor Oriental</option><option value="TG">Togo</option><option value="TO">Tonga</option><option value="TT">Trinidad y Tobago</option><option value="TN">Túnez</option><option value="TM">Turkmenistán</option><option value="TR">Turquía</option><option value="TV">Tuvalu</option><option value="UA">Ucrania</option><option value="UG">Uganda</option><option value="UY">Uruguay</option><option value="UZ">Uzbekistán</option><option value="VU">Vanuatu</option><option value="VE">Venezuela</option><option value="VN">Vietnam</option><option value="YE">Yemen</option><option value="YU">Yugoslavia</option><option value="ZM">Zambia</option><option value="ZW">Zimbabue</option>
                                </select>
                        
                            </div>

                            <div style="box-sizing:border-box;border:0;width:21%;height:400px;">
                                <div style="box-sizing:border-box;border:0;width:100%;height:30px;color:#fff;background-color:#555;line-height:30px;font-weight:700;font-size:10px;text-align:center;border-top-right-radius: 5px;border-top-left-radius: 5px;">
                                    Posiciones en las que ha jugado
                                </div>
                                <div style="box-sizing:border-box;border:0;width:100%;height:370px;border:1px solid #555;background-color:#fff;">

                                    <img style="box-sizing:border-box;border:0;display:block;width:90%;height:300px;margin-left:auto;margin-right:auto;" src="./img/posicion_cancha_vertical.jpeg" alt="posicion_cancha_vertical">

                                </div>
                            </div>
                            <!-- =========================================== -->

                            <h3 id="titulo_tabla_bono" style="display:none;box-sizing:border-box;border:0;width:100%;margin-left:auto;margin-right:auto;text-align:center;">Bonos</h3>

                            <table id="tabla_bono" style="display:none;box-sizing:border-box;border:0;width:85%;height:auto;margin-left:auto;margin-right:auto;">
                                <thead>
                                <tr style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;text-transform:uppercase;font-size:10px;color:#fff;font-weight: 700;">
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 19px;" >TIPO DE BONO</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 19px;" >MONTO</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 40px;" >TIPO DE MONEDA</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 51px;" >COMENTARIO</th>
                                </tr>
                                    
                                </thead>
                                
                                <tbody id="contendor_body_tabla_bono" style="font-size: 10px;background-color:#fff;">
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 19px;">
                                        Partido ganado
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 19px;">
                                            XX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 40px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 51px;">
                                            XXXX
                                        </td>
                                    </tr>

                                </tbody>

                            </table>

                            <div id="contenedor_archivos_pdf_select" style="box-sizing:border-box;width:100%;margin-top: 30px;text-align:center;">
                                <div style="font-size: 12px;font-weight: 900;color: #404040;">Archivos subidos</div>
                                <select style="box-sizing:border-box;width:250px;height:30px;border:2px solid #d2d2d2;"  id="archivo_pdf" onChange="mostrarPdf(this.value)"></select>
                                <!-- <div style="margin-right:auto;margin-left:auto;width:40%;height: 30px;display:flex;">
                                        <a class="btn btn-md btn-primary green-a" style="width: 36%;height: 20px;background:#555">
                                            <div>
                                                <p class="ellipsis-text" style="font-weight: normal;">Dorsal</p>
                                            </div>
                                        </a>
                                        <select style="width:60%; height: 30px;background:#fff;border:2px solid" class="" id="dorsal" name="dorsal" onchange="">
                                            
                                        </select>
                                    </div> -->
                            </div>
                            <div id="contenedor_visor_pdf" style="display:none;clear:both;background-color:#525659;width:100%;margin-top:30px;">
                                <iframe id="viewer" frameborder="0" scrolling="no" style="width:100%;height:600px;"></iframe>
                                <!-- <object id="viewer"  data='' type='application/pdf' width='100%' height='500px' style='margin-top: 10px; border: 1px solid black;'></object> -->
                            </div>

                        </div>
                        <div style="display:none;" id="seccion_info_jugador_partidos_apartado">
                            <!-- <h1> apartado partidos</h1> -->
                            <table style="box-sizing:border-box;border:0;width:95%;height:auto;margin-left:auto;margin-right:auto;">
                                <thead>
                                <tr style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;text-transform:uppercase;font-size:10px;color:#fff;font-weight: 700;">
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 19px;" >FECHA PARTIDOS</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 12px;" >RIVAL</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 11px;" >CAMPEONATOS</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 12px;" >CONDICIÓN</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 12px;" >INICIO COMO</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 17px;" >POSICION DE INICIO</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 11px;" >MIN JUGADOS</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 5px;" >TA</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 5px;" >TR</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 6px;" >GOLES</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 10px;" >SUSTITUIDO</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 5px;" >MIN</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 10px;" >MOTIVO</th>
                                </tr>
                                    
                                </thead>
                                
                                <tbody style="font-size: 10px;background-color:#fff;">
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 19px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            rival
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 11px;">
                                            campeonatos
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            condición
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            inicio como
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 17px;">
                                            posicion de inicio
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 11px;">
                                            min juegados
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 5px;">
                                            ta
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 5px;">
                                            tr
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 6px;">
                                            goless
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 10px;">
                                            sustituido
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 5px;">
                                            min
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 10px;">
                                            motivo
                                        </td>
                                        
                                    </tr>
                                                   
                                </tbody>

                            </table>

                        </div>
                        <div style="display:none;" id="seccion_info_jugador_estadisticas_apartado">
                            <h1> apartado estadisticas</h1>
                        </div>
                        <div style="display:none;" id="seccion_info_jugador_lesiones_apartado">
                            <!-- <h1> apartado lesiones</h1> -->
                            <table style="box-sizing:border-box;border:0;width:95%;height:auto;margin-left:auto;margin-right:auto;">
                                <thead>
                                <tr style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;text-transform:uppercase;font-size:10px;color:#fff;font-weight: 700;">
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;" >fecha lesion</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;" >patologia</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;" >gravedad</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;" >contexto</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;" >detalle</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;" >mecanismo</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;" >recidiva</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;" >tipo de lesion</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;" >zona afectada</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;" >dias de baja</th>
                                </tr>
                                    
                                </thead>
                                
                                <tbody style="font-size: 10px;background-color:#fff;">
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;">
                                        xxxxx
                                        </td>
                                    </tr>
                                </tbody>

                            </table>

                        </div>
                        <div style="display:none;" id="seccion_info_jugador_antro_apartado">
                            <!-- <h1> apartado antropometria</h1> -->

                            <table style="box-sizing:border-box;border:0;width:95%;height:auto;margin-left:auto;margin-right:auto;">
                                <thead>
                                <tr style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;text-transform:uppercase;font-size:10px;color:#fff;font-weight: 700;">
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 19px;" >FECHA EVALUACIÓN</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 12px;" >PESO</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 12px;" >TALLA</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 12px;" >6 PLIEGUES</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 12px;" >%M. ADINOSA</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 17px;" >%M. MUSCULAR</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 11px;" >KG M. ADINOSA</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 13px;" >KG M. MUSCULAR</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 12px;" >IMO</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 7px;" >REPORTE</th>
                                </tr>
                                    
                                </thead>
                                
                                <tbody style="font-size: 10px;background-color:#fff;">
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 19px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 11px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 17px;">
                                            XXXXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 11px;">
                                            XXXXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 7px;">
                                            XXX
                                        </td>
                                        
                                        
                                    </tr>
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 19px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 11px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 17px;">
                                            XXXXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 11px;">
                                            XXXXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 7px;">
                                            XXX
                                        </td>
                                        
                                        
                                    </tr>
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 19px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 11px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 17px;">
                                            XXXXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 11px;">
                                            XXXXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 7px;">
                                            XXX
                                        </td>
                                        
                                        
                                    </tr>
                                    
                                </tbody>

                            </table>


                        </div>
                        <div style="display:none;" id="seccion_info_jugador_test_apartado">
                            <h1> apartado test fisico</h1>
                        </div>
                        <div style="display:none;" id="seccion_info_jugador_tratamiento_apartado">
                            <!-- <h1> apartado tratamiento</h1> -->
                            <table style="box-sizing:border-box;border:0;width:95%;height:auto;margin-left:auto;margin-right:auto;">
                                <thead>
                                <tr style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;text-transform:uppercase;font-size:10px;color:#fff;font-weight: 700;">
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 19px;" >FECHA ATENCIÓN</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 42px;" >PATOLOGÍA</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 40px;" >TRATAMIENTO REALIZADO</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 38px;" >REPORTE</th>
                                </tr>
                                    
                                </thead>
                                
                                <tbody style="font-size: 10px;background-color:#fff;">
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 19px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 42px;">
                                            XX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 40px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 38px;">
                                            XXXX
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 19px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 42px;">
                                            XX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 40px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 38px;">
                                            XXXX
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 19px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 42px;">
                                            XX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 40px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 38px;">
                                            XXXX
                                        </td>
                                    </tr>
                                    
                                    
                                </tbody>

                            </table>


                        </div>
                        <div style="display:none;" id="seccion_info_jugador_seleccion_apartado">
                            <!-- <h1> apartado seleccion</h1> -->
                            <table style="box-sizing:border-box;border:0;width:95%;height:auto;margin-left:auto;margin-right:auto;">
                                <thead>
                                <tr style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;text-transform:uppercase;font-size:10px;color:#fff;font-weight: 700;">
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 19px;" >FECHA ATENCIÓN</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 11px;" >TIPO</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 12px;" >SERIE</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 25px;" >FECHA FIN CONVOCATORIA</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 18px;" >LUGAR</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 35px;" >INFORME</th>
                                </tr>
                                    
                                </thead>
                                
                                <tbody style="font-size: 10px;background-color:#fff;">
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 19px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 11px;">
                                            XX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 25px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 18px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 35px;">
                                            XXXX
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 19px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 11px;">
                                            XX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 25px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 18px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 35px;">
                                            XXXX
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 19px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 11px;">
                                            XX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 12px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 25px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 18px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 35px;">
                                            XXXX
                                        </td>
                                    </tr>
                                    
                                    
                                </tbody>

                            </table>
                    

                        </div>
                        <div style="display:none;" id="seccion_info_jugador_prestamo_apartado">
                            <!-- <h1> apartado prestamo</h1> -->
                            <table style="box-sizing:border-box;border:0;width:95%;height:auto;margin-left:auto;margin-right:auto;">
                                <thead>
                                <tr style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;text-transform:uppercase;font-size:10px;color:#fff;font-weight: 700;">
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 47px;" >TIPO PRÉSTAMO</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 56px;" >FECHA INICIO PRÉSTAMO</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 56px;" >FECHA FIN PRÉSTAMO</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 26px;" >PAÍS</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 31px;" >CLUB</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 38px;" >VALOR DE PRÉSTAMO</th>
                                    <th style="box-sizing:border-box;border:0;height:30px;line-height:30px;/*border-right:1px solid #111;*/text-align: left;padding-left: 5px;    max-width: 63px;" >OPCIÓN DE COMPRA</th>
                                </tr>
                                    
                                </thead>
                                
                                <tbody id="contenedo_prestamo_tabla_html_div" style="font-size: 10px;background-color:#fff;">
                                    <!-- <tr>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 47px;">
                                        24 de septiembre del 2020
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 56px;">
                                            XX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 56px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 26px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 31px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 38px;">
                                            XXXX
                                        </td>
                                        <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 63px;">
                                            XXXX
                                        </td>
                                    </tr> -->
                                    
                                    
                                </tbody>

                            </table>

                            <!-- <div style="box-sizing:border-box;border:0;width:90%;height:auto;margin-left:auto;margin-right:auto;">
                                <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;text-transform:uppercase;font-size:10px;color:#fff;font-weight: 700;display:inline-flex;flex-direction:row;flex-wrap:wrap;">

                                    <div style="box-sizing:border-box;border:0;width:15%;height:30px;line-height:30px;padding-left:5px;">tipo préstamo</div>
                                    <div style="box-sizing:border-box;border:0;width:14.2%;height:30px;line-height:30px;padding-left:5px;">fecha inicio préstamo</div>
                                    <div style="box-sizing:border-box;border:0;width:14.2%;height:30px;line-height:30px;padding-left:5px;">fecha fin préstamo</div>
                                    <div style="box-sizing:border-box;border:0;width:10%;height:30px;line-height:30px;padding-left:5px;">país</div>
                                    <div style="box-sizing:border-box;border:0;width:10%;height:30px;line-height:30px;padding-left:5px;">club</div>
                                    <div style="box-sizing:border-box;border:0;width:14.28%;height:30px;line-height:30px;padding-left:5px;">valor de préstamo</div>
                                    <div style="box-sizing:border-box;border:0;width:22.32%;height:30px;line-height:30px;padding-left:5px;">opción de compra</div>


                                </div>

                                

                                <div id="contenedo_prestamo_tabla_html_div" style="box-sizing:border-box;border:0;width:100%;height:auto;background-color:#fff;font-size:10px;">

                                </div>

                            </div> -->

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

var pie=[
    "Derecho",
    "Izquierdo",
    "Ambidiestro"
];

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

var tipo_formulario=false;

var nombre_usuario_software='<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>';

var idficha_jugador=null;

var lista_paises=[
    "argentina",
    "chile",
    "venezuela",
    "brasil",
    "peru",
    "uruguay",
    "bolivia",
    "colombia",
    "paraguay",
    "mexico"
];

// var lista_club_paises={
//     "argentina":[
//         "Argentinos Juniors",
//         "Arsenal de Sarandi",
//         "Atletico Tucumán",
//         "Banfield",
//         "Belgrano de córdoba",
//         "Boca Juniors",
//         "Chacarita Juniors",
//         "Colon de Santa Fe",
//         "Defensa y Justicia",
//         "Estudiantes de la plata",
//         "Gimnasia La plata",
//         "Godoy Cruz",
//         "Huracán",
//         "Independiente",
//         "Lanús",
//         "Newell's Old Boys",
//         "Olimpo de Bahía Blanca",
//         "Patronato",
//         "Racing club",
//         "River plate",
//         "Rosario Central",
//         "San Lorenzo",
//         "San MartÌn de San Juan",
//         "Talleres de córdoba",
//         "Temperley",
//         "Tigre",
//         "Union de Santa Fe",
//         "Velez Sarsfield",
//         // ===================
//         "Acassuso",
//         "Agropecuario",
//         "Aldosivi",
//         "All Boys",
//         "Almagro",
//         "Almirante Brown",
//         "Alvarado",
//         "Argentino Merlo",
//         "Argentino Quilmes",
//         "Atlanta",
//         "Atletico Rafaela",
//         "Barracas Central",
//         "Belgrano",
//         "Berazategui",
//         "Boca Unidos",
//         "Brow de Aldrogue",
//         "Camioneros Buenos Aires",
//         "Cañuelas",
//         "Central Cordoba",
//         "Central Norte",
//         "Chaco For Ever",
//         "Cipolletti",
//         "Circulo Deportivo",
//         "Club Atletico Guemes",
//         "Club Atletico Mitre",
//         "Colegiales",
//         "Comunicaciones",
//         "Crucero del norte",
//         "Def. de Pronunciamiento",
//         "Defensores Belgrano",
//         "Defensores Belgrano VR",
//         "Defensores Unidos",
//         "Deportivo Armenio",
//         "Deportivo Español",
//         "Deportivo Laferrere",
//         "Deportivo Madryn",
//         "Deportivo Maipu",
//         "Deportivo Merlo",
//         "Deportivo Moron",
//         "Deportivo Riestra",
//         "Deportivo Santamarina",
//         "Dock Sud",
//         "Douglas Haig",
//         "El Porvenir",
//         "Estudiantes",
//         "Estudiantes Caseros",
//         "Estudiantes de San Luis",
//         "Estudiantes Rio Cuarto",
//         "Excursionistas",
//         "Fenix",
//         "Ferro Carril Oeste",
//         "FerroCarril Oeste LP",
//         "Flandria",
//         "General Lamadrid",
//         "Gimnasia Concepcion",
//         "Gimnasia Jujuy",
//         "Gimnasia Mendoza",
//         "Guillermo Brown",
//         "Huracan Las Heras",
//         "Independiente Rivadavia",
//         "Instituto",
//         "Ituzaingo",
//         "JJ Urquiza",
//         "Juventud Unida G.",
//         "Juventud Unida Univ.",
//         "Leandro Niceforo Alem",
//         "Los Andes",
//         "Lujan",
//         "Midland",
//         "Nueva Chicago",
//         "Olimpo",
//         "Platense",
//         "Quilmes",
//         "Racing",
//         "Real Pilar",
//         "Sacachispas",
//         "San Martin Buzaco",
//         "San Martin Formosa",
//         "San Martin San Juan",
//         "San Martin Tucuman",
//         "San Miguel",
//         "San Telmo",
//         "Sansinena",
//         "Sarmiento",
//         "Sarmiento Resistencia",
//         "Sol de Mayo",
//         "Sportivo Belgrano",
//         "Sportivo Desamparados",
//         "Sportivo Italiano",
//         "Sportivo Las Parejas",
//         "Sportivo Peñarol",
//         "Talleres Cordoba",
//         "Talleres Remedios",
//         "Tristan Suarez",
//         "UAI Urquiza",
//         "Union Santa Fe",
//         "Union Sunchales",
//         "Victoriano Arenas",
//         "Villa Dalmine",
//         "Villa Mitre",
//         "Villa San Carlos"
//     ],

//     "chile":[
//         "Colo Colo",
//         "Universidad de Chile",
//         "Union Española",
//         "Universidad Católica",
//         "Audax italiano",
//         "Everton",
//         "San Luis de Quillota",
//         "Santiago Wanderers",
//         "Huachipato",
//         "Universidad de Concepción",
//         "Palestino",
//         "Deportes Antofagasta",
//         "Deportes Iquique",
//         "Deportes Temuco",
//         "O`Higgins",
//         "Curico Unido",
//         "Union la Calera",
//         "Deportes Copiapo",
//         "San Marcos de Arica",
//         "Deportes Valdivia",
//         "Cobreloa",
//         "Rangers de Talca",
//         "Magallanes",
//         "A.C Barnechea",
//         "Santiago Morning",
//         "Coquimbo Unido",
//         "Deportes la Serena",
//         "Puerto Montt",
//         "Ñublense",
//         "Cobresal",
//         "Naval",
//         "San Antonio Unido",
//         "Deportes Santa Cruz",
//         "Malleco Unido",
//         "Deportes Melipilla",
//         "Colchagua CD",
//         "Deportes Recoleta",
//         "Independiente de Cauquenes",
//         "Deportes La Pintana",
//         "Provincial Osorno",
//         "Iberia de los Angeles",
//         "Fernandez Vial",
//         "General Velasquez",
//         "Lautaro de Buin",
//         "Deportes Colina",
//         "Brujas de Salamanca",
//         "Deportes Concepción",
//         "Deportes Limache",
//         "Linares Unido",
//         "Deportes Rengo",
//         "Deportivo Pilmahue",
//         "Ferroviarios",
//         "Municipal Mejillones",
//         "Municipal Santiago",
//         "Provincial Ovalle",
//         "Rancagua Sur",
//         "Real San Joaquin",
//         "Trasandino de los Andes",
//         "Union Compañias",
//         // =======================
//         "Copiapo",
//         "Deportes Concepcion",
//         "Deportes Iberia",
//         "Deportes Linares",
//         "Deportes Santa Cruz",
//         "Deportes Vallenar",
//         "La Pintana Unida",
//         "Lota Schwager",
//         "Macul",
//         "Melipilla",
//         "Municipal Salamanca",
//         "Ohiggins",
//         "Osorno",
//         "Pilmahue",
//         "Provincial Ranco",
//         "Quintero Unido",
//         "Rangers",
//         "Rengo",
//         "Rodelindo Roman",
//         "Trasandino LA",
//         "Union Español",
//         "Union San Felipe",
//         "Universidad Catolica",
//         "Universidad de Chile",
//         "Universidad de Concepcion"
//     ],

//     "venezuela":[
//         "Academia Puerto Cabello",
//         "Angostura FC",
//         "Aragua",
//         "Atletico el vigia",
//         "Atletico Guanare",
//         "Atletico Venezuela",
//         "Atletico Venezuela II",
//         "Carabobo",
//         "Caracas",
//         "Caracas II",
//         "Chico de Guayana",
//         "Deportivo La Guaira",
//         "Deportivo Lara",
//         "Deportivo Tachira",
//         "Estudiantes de Caracas",
//         "Estudiantes de Merida",
//         "Gran Valencia Maracay",
//         "LALA",
//         "Llanero de Guanare",
//         "Margarita",
//         "Metropolitanos",
//         "Mineros de Guayana",
//         "Monagas",
//         "Petare",
//         "Petroletos",
//         "Portuguesa",
//         "Real Frontera",
//         "Titanes",
//         "Trujillanos",
//         "Tucanes",
//         "UCV",
//         "ULA",
//         "Union Atletico Falcon",
//         "Ureña",
//         "Yaracuy",
//         "Yaracuyanos",
//         "Zamora",
//         "Zamora II"
//     ],

//     "brasil":[
//         "America Mineiro",
//         "Atletico GO",
//         "Atletico Mineiro",
//         "Atletico Paranaense",
//         "Avai",
//         "Bahia",
//         "Botafogo",
//         "Botafogo SP",
//         "Brasil de Pelotas",
//         "Ceara",
//         "Chapecoense",
//         "Confianca",
//         "Corinthians",
//         "Coritiba",
//         "CRB",
//         "Cruzeiro",
//         "CSA",
//         "Cuiaba",
//         "Figueirense",
//         "Flamengo",
//         "Fluminense", 
//         "Fortaleza",
//         "Goias",
//         "Gremio",
//         "Guarani",
//         "Internacional",
//         "Juventude",
//         "Nautico",
//         "Oeste",
//         "Operario PR",
//         "Palmeiras",
//         "Parana",
//         "Ponte Preta",
//         "Red Bull Bragantino",
//         "Sampaio Correa",
//         "Santos",
//         "Sao Paulo",
//         "Sport Recife",
//         "Vasco da Gama",
//         "Vitoria"
//     ],
//     "peru":[
//         "Academia Cantolao",
//         "Alianza Lima",
//         "Alianza Universidad",
//         "Atletico Grau",
//         "Ayacucho",
//         "Binacional",
//         "Carlos Mannucci",
//         "Carlos Stein",
//         "Cesar Vallejo",
//         "Cienciano",
//         "Cusco",
//         "Deportivo Llacuabamba",
//         "Deportivo Municipal",
//         "Melgar",
//         "Sport Boys",
//         "Sport Huancayo",
//         "Sporting Cristal",
//         "Universidad San Martin",
//         "Universitario",
//         "UTC Cajamarca"
//     ],
//     "uruguay":[
//         "Albion",
//         "Atenas",
//         "Boston River",
//         "Central Español",
//         "Cerrito",
//         "Cerro",
//         "Cerro Largo",
//         "Danubio",
//         "Defensor Sporting",
//         "Deportivo Maldonado",
//         "Fenix",
//         "Juventud",
//         "Liverpool",
//         "Nacional",
//         "Peñarol",
//         "Plaza Colonia",
//         "Progreso",
//         "Racing",
//         "Rampla Juniors",
//         "Rentistas",
//         "River Plate",
//         "Rocha",
//         "Sud America",
//         "Tacuarembo",
//         "Torque",
//         "Villa Española",
//         "Villa Teresa",
//         "Wanderers"
//     ],
//     "bolivia":[
//         "Always Ready",
//         "Atletico Palmaflor",
//         "Aurora",
//         "Blooming",
//         "Bolivar",
//         "Guabira",
//         "Nacional Potosi",
//         "Oriente Petrolero",
//         "Real Potosi",
//         "Royal Pari",
//         "San Jose",
//         "Santa Cruz",
//         "The Strongest",
//         "Wilstermann"
//     ],
//     "colombia":[
//         "Alianza Petrolera",
//         "America de Cali",
//         "Atletico Bucaramanga",
//         "Atletico Nacional",
//         "Boyaca Chico",
//         "Cucuta Deportivo",
//         "Deportes Tolima",
//         "Deportivo Cali",
//         "Deportivo Pasto",
//         "Deportivo Pereira",
//         "Envigado",
//         "Jaguares de Cordoba",
//         "Junior", 
//         "La Equidad",
//         "Medellin",
//         "Millonarios",
//         "Once Caldas",
//         "Patriotas Boyaca",
//         "Rionegro Aguilas",
//         "Santa Fe"
//     ],
//     "paraguay":[
//         "12 de Octubre",
//         "Cerro Porteño",
//         "General Diaz",
//         "Guaireña",
//         "Guarani",
//         "Libertad",
//         "Nacional Asuncion",
//         "Olimpia",
//         "River Plate",
//         "Sol de America",
//         "Sportivo Luqueño",
//         "Sportivo San Lorenzo"
//     ],
//     "mexico":[
//         "Alebrijes de Oaxaca",
//         "America",
//         "Atlante",
//         "Atlas",
//         "Atletico Morelia",
//         "Atletico San Luis",
//         "Cancun",
//         "Celaya",
//         "Cimarrones Sonora",
//         "Correcaminos UAT",
//         "Cruz Azul",
//         "Dorados",
//         "Guadalajara",
//         "Juarez",
//         "Leon",
//         "Mazatlan",
//         "Mineros de Zacatecas",
//         "Monterrey",
//         "Necaxa",
//         "Pachuca",
//         "Puebla",
//         "Pumas Tabasco",
//         "Pumas UNAM",
//         "Queretaro",
//         "Santos Laguna",
//         "Tampico Madero",
//         "Tapatio",
//         "Tepatitlan de Morelos",
//         "Tigres",
//         "Tijuana",
//         "Tlaxcala",
//         "Toluca",
//         "Univesidad Guadalajara",
//         "Venados"
//     ]
// };

var lista_club_paises=null;

var ano_actual_servidor=0;

var listas_fichas_jugadores=[];

var jugador_json=null;

var listas_prestamos_jugador=null;

var contadorNumerosBonos=0;

var contadorNumerosPdf=0;

var listaIdPdf=[];

var lista_pdf_delete=[];

var listaIdPdfUpload=[];

var jugadorInfo=null;

var estadoBorrarBuffer=true;


</script>
<script>

function consultarEquiposClub(){
    window.lista_club_paises=[];
    var url = "post/consumirEquiposClub.php";
    $.ajax({
            url:url,
            type:'POST',
            contentType:false,
            processData:false,
            cache:false,
            success: function(respuesta){
                let json=JSON.parse(respuesta)
                window.lista_club_paises=json;
                console.log(window.lista_club_paises);
            }
    });
}    

function vaciarTemp(){
    if(window.estadoBorrarBuffer){
        borrarArchivosBuffer();
        window.estadoBorrarBuffer=false;
    }
}

function borrarArchivosBuffer(){
    // borrar_archivos_temp
    var url = "post/borrar_archivos_temp.php";
    $.ajax({
            url:url,
            type:'POST',
            contentType:false,
            processData:false,
            cache:false,
            success: function(respuesta){
                console.log("ok")
            }
    });
}

function uploadTemporalPdfCambiar(id){
        //FORMATEO
        $("#loaderSpinnerPdf_n_"+id).show(50);
        $("#progresoPdf_"+id).show(50);
        $("#checkOkPdf"+id).hide(0);
        
        $("#progressPdf_n_"+id).animate({width:"5%"},500);
        var inputFileImage = document.getElementById("pdf_n_"+id);
        
        //Validaciones
        if(inputFileImage.files.length == 0 ){
            $('#mensaje_validacion_pdf').html("<h5><b style='color:#f26027;'>Alerta:</b> no se ha seleccionado ningun archivo por favor intente de nuevo.</h5>");
            $("#myModalValidacionPdf").modal('show');
            $("#progressPdf_n_"+id).animate({width:"0%"},2000);
            $("#loaderSpinnerPdf_n_"+id).hide();
            $("#progressPdf_n_"+id).hide(2500);
            $("#progresoPdf_"+id).hide(2500);
            inputFileImage='';
        }
        
        if (document.getElementById("nombre_n_"+id).value == '' ){
            $('#mensaje_validacion_pdf').html("<h5><b style='color:#f26027;'>Alerta:</b> debe ingresar un nombre.</h5>");
            $("#myModalValidacionPdf").modal('show');
            $("#progressPdf_n_"+id).animate({width:"0%"},2000);
            $("#loaderSpinnerPdf_n_"+id).hide();
            $("#progressPdf_n_"+id).hide(2500);
            $("#progresoPdf_"+id).hide(2500);
        }

        if (document.getElementById("descripcion_n_"+id).value == '' ){
            $('#mensaje_validacion_pdf').html("<h5><b style='color:#f26027;'>Alerta:</b> debe ingresar una breve descripción.</h5>");
            $("#myModalValidacionPdf").modal('show');
            $("#progressPdf_n_"+id).animate({width:"0%"},2000);
            $("#loaderSpinnerPdf_n_"+id).hide();
            $("#progressPdf_n_"+id).hide(2500);
            $("#progresoPdf_"+id).hide(2500);
        }
        
        var fileSize = inputFileImage.files[0].size;
        if (fileSize > 2000000) {
            $('#mensaje_validacion_pdf').html("<h5><b style='color:#f26027;'>Alerta:</b> el archivo debe ser inferior a  2MB.</h5>");
            $("#myModalValidacionPdf").modal('show');
            $("#progressPdf_n_"+id).animate({width:"0%"},2000);
            $("#loaderSpinnerPdf_n_"+id).hide();
            $("#progressPdf_n_"+id).hide(2500);
            $("#progresoPdf_"+id).hide(2500);
        }
        
        if (fileSize < 0) {
            $('#mensaje_validacion_pdf').html("<h5><b style='color:#f26027;'>Alerta:</b> no se ha seleccionado ningun archivo por favor intente de nuevo.</h5>");
            $("#myModalValidacionPdf").modal('show');
            $("#progressPdf_n_"+id).animate({width:"0%"},1000);
            $("#loaderSpinnerPdf_n_"+id).hide();
            $("#progressPdf_n_"+id).hide(2500);
            $("#progresoPdf_"+id).hide(2500);
        }
        
        // //ADICIONALES
        
        $("#progressPdf_n_"+id).animate({width:"20%"},1000);
        var file = inputFileImage.files[0];
        var data = new FormData();
        data.append('archivo_pdf',file);
        data.append('id_pdf',id+"_upload"); // <----- UPDATE


        // console.log( window.archivosPdf );
        var url = "post/ficha_jugador_guardar_buffer_archivo.php";
        $("#progressPdf_n_"+id).animate({width:"80%"},5000);
        $.ajax({
            url:url,
            type:'POST',
            contentType:false,
            data:data,
            processData:false,
            cache:false,
            success: function(respuesta){
                $("#progressPdf_n_"+id).animate({width:"100%"},1000,function luego(){
                    $("#loaderSpinnerPdf_n_"+id).hide();
                    $("#checkOkPdf"+id).show(200);
                    $('#boton_agregar_infrome').attr('disabled', false);
                    validarFormulario();
                });
                console.log(window.listaIdPdf);
            }
    });
}

function uploadTemporalPdf(id){
        //FORMATEO
        $("#loaderSpinnerPdf_n_"+id).show(50);
        $("#progresoPdf_"+id).show(50);
        $("#checkOkPdf"+id).hide(0);
        
        $("#progressPdf_n_"+id).animate({width:"5%"},500);
        var inputFileImage = document.getElementById("pdf_n_"+id);
        
        //Validaciones
        if(inputFileImage.files.length == 0 ){
            $('#mensaje_validacion_pdf').html("<h5><b style='color:#f26027;'>Alerta:</b> no se ha seleccionado ningun archivo por favor intente de nuevo.</h5>");
            $("#myModalValidacionPdf").modal('show');
            $("#progressPdf_n_"+id).animate({width:"0%"},2000);
            $("#loaderSpinnerPdf_n_"+id).hide();
            $("#progressPdf_n_"+id).hide(2500);
            $("#progresoPdf_"+id).hide(2500);
            inputFileImage='';
        }
        
        if (document.getElementById("nombre_n_"+id).value == '' ){
            $('#mensaje_validacion_pdf').html("<h5><b style='color:#f26027;'>Alerta:</b> debe ingresar un nombre.</h5>");
            $("#myModalValidacionPdf").modal('show');
            $("#progressPdf_n_"+id).animate({width:"0%"},2000);
            $("#loaderSpinnerPdf_n_"+id).hide();
            $("#progressPdf_n_"+id).hide(2500);
            $("#progresoPdf_"+id).hide(2500);
        }

        if (document.getElementById("descripcion_n_"+id).value == '' ){
            $('#mensaje_validacion_pdf').html("<h5><b style='color:#f26027;'>Alerta:</b> debe ingresar una breve descripción.</h5>");
            $("#myModalValidacionPdf").modal('show');
            $("#progressPdf_n_"+id).animate({width:"0%"},2000);
            $("#loaderSpinnerPdf_n_"+id).hide();
            $("#progressPdf_n_"+id).hide(2500);
            $("#progresoPdf_"+id).hide(2500);
        }
        
        var fileSize = inputFileImage.files[0].size;
        if (fileSize > 2000000) {
            $('#mensaje_validacion_pdf').html("<h5><b style='color:#f26027;'>Alerta:</b> el archivo debe ser inferior a  2MB.</h5>");
            $("#myModalValidacionPdf").modal('show');
            $("#progressPdf_n_"+id).animate({width:"0%"},2000);
            $("#loaderSpinnerPdf_n_"+id).hide();
            $("#progressPdf_n_"+id).hide(2500);
            $("#progresoPdf_"+id).hide(2500);
        }
        
        if (fileSize < 0) {
            $('#mensaje_validacion_pdf').html("<h5><b style='color:#f26027;'>Alerta:</b> no se ha seleccionado ningun archivo por favor intente de nuevo.</h5>");
            $("#myModalValidacionPdf").modal('show');
            $("#progressPdf_n_"+id).animate({width:"0%"},1000);
            $("#loaderSpinnerPdf_n_"+id).hide();
            $("#progressPdf_n_"+id).hide(2500);
            $("#progresoPdf_"+id).hide(2500);
        }
        
        // //ADICIONALES
        
        $("#progressPdf_n_"+id).animate({width:"20%"},1000);
        var file = inputFileImage.files[0];
        var data = new FormData();
        data.append('archivo_pdf',file);
        data.append('id_pdf',id); // <----- UPDATE


        // console.log( window.archivosPdf );
        var url = "post/ficha_jugador_guardar_buffer_archivo.php";
        $("#progressPdf_n_"+id).animate({width:"80%"},5000);
        $.ajax({
            url:url,
            type:'POST',
            contentType:false,
            data:data,
            processData:false,
            cache:false,
            success: function(respuesta){
                window.listaIdPdf.push(id.toString());
                $("#progressPdf_n_"+id).animate({width:"100%"},1000,function luego(){
                    $("#loaderSpinnerPdf_n_"+id).hide();
                    $("#checkOkPdf"+id).show(200);
                    $('#boton_agregar_infrome').attr('disabled', false);
                    validarFormulario();
                });
                console.log(window.listaIdPdf);
            }
    });
}



function boton_eliminarFilas(id){
    let fila=document.getElementById("fila_pdf_n_"+id);
    let $contenedorFilasPdf=fila.parentElement;
    $contenedorFilasPdf.removeChild(fila);
    if(window.listaIdPdf.length>0){
        let contador=0;
        for(let numero of window.listaIdPdf){
            if(numero===id.toString()){
                window.listaIdPdf.splice(contador,1);
            }
            contador++;
        }
        console.log(window.listaIdPdf);
    }
    if(window.tipo_formulario){
        window.lista_pdf_delete.push(id);
        let contador=0;
        for(let numero of window.listaIdPdfUpload){
            if(numero===id.toString()){
                window.listaIdPdfUpload.splice(contador,1);
            }
            contador++;
        }
        console.log(window.listaIdPdfUpload);
        console.log(window.lista_pdf_delete);
    }
    validarFormulario();

}

function agregarPdf(){
    window.contadorNumerosPdf++;
    let plantilla='\
    <div id="fila_pdf_n_'+window.contadorNumerosPdf+'" style="box-sizing:border-box;width:100%;display:inline-flex;flex-direction:row;flex-wrap:wrap;">\
        <div  style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">\
            <br>\
            <input type="file" name="array_pdf[]" id="pdf_n_'+ window.contadorNumerosPdf+'" accept=".pdf" class="input_fila_nuevo">\
        </div>\
        <div  style="box-sizing:border-box;width:20%;margin-right:10%;">\
            <div style="font-size: 12px;font-weight: 900;color: #404040;">Nombre</div>\
            <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="array_nombre_pdf[]" class="nombre_nuevo_pdf" id="nombre_n_'+ window.contadorNumerosPdf+'" onKeyup="validarFormulario()" />\
        </div>\
        <div  style="box-sizing:border-box;width:20%;margin-right:1%;">\
            <div style="font-size: 12px;font-weight: 900;color: #404040;">Descripción</div>\
            <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="array_descripcion_pdf[]" class="descripcion_nuevo_pdf" id="descripcion_n_'+ window.contadorNumerosPdf+'" onKeyup="validarFormulario()"/>\
        </div>\
        <button style="width: 3%;display: block;cursor: pointer;background-color: #f44336;height: 25px;border: 0;border-radius: 5px;color: #fff;margin-top: 21px;font-size: 16px;" class="" onClick="boton_eliminarFilas('+window.contadorNumerosPdf+')">\
            <i class="icon-remove"></i>\
        </button>\
        <button style="margin-bottom: 10px;margin-left: 10%;width: 10%;margin-bottom:10px;" class="boton_agregar_ficha_jugador" onClick="uploadTemporalPdf('+window.contadorNumerosPdf+')"><b style="font-size:12px;">Subir</b></button>\
        <img id="loaderSpinnerPdf_n_'+ window.contadorNumerosPdf+'" src="../config/spinner.gif" style="display:none;width: 20px;height: 20px;margin-top: 5px;margin-left: 10px;margin-right:30%;">\
        <br>\
        <div id="checkOkPdf'+window.contadorNumerosPdf+'" style="margin-left:20px;color:<?php echo $color_fondo; ?>;font-size:18px;display:none;margin-right:30%;"><i class="icon-ok"></i></div>\
        <br>\
        <div id="progresoPdf_'+window.contadorNumerosPdf+'" class="progress" style="margin-left:10%;margin-top:10px;height:5px;width: 80%"><div id="progressPdf_n_'+window.contadorNumerosPdf+'" style="height:5px;background-color: <?php echo $color_fondo; ?>;width: 0%"></div>\
        <br>\
        <hr style="box-sizing:border-box;width:80%;margin-left:10%;background-color: #111;">\
    </div>';
    $("#contendor_lista_pdf").append(plantilla);
    validarFormulario();
    
}

function agregarBono(){
    
    if(window.contadorNumerosBonos===0){
        window.contadorNumerosBonos++;
        let plantilla='\
        <div id="fila_bono_n_'+window.contadorNumerosBonos+'" style="box-sizing:border-box;width:100%;display:inline-flex;flex-direction:row;flex-wrap:wrap;">\
            <div  style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">\
                <div style="font-size: 12px;font-weight: 900;color: #404040;">Tipo de Bono</div>\
                <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="array_tipo_bono[]" id="tipo_bono_n_'+window.contadorNumerosBonos+'" onChange="">\
                    <option value="0">Partido citado</option>\
                    <option value="1">Partido ganado</option>\
                    <option value="2">Partido jugado</option>\
                </select>\
            </div>\
            <div  style="box-sizing:border-box;width:20%;margin-right:10%;">\
                <div style="font-size: 12px;font-weight: 900;color: #404040;">Monto</div>\
                <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="array_monto[]" id="moton_n_'+window.contadorNumerosBonos+'" />\
            </div>\
            <div  style="box-sizing:border-box;width:20%;margin-right:10%;">\
                <div style="font-size: 12px;font-weight: 900;color: #404040;">Tipo de moneda</div>\
                <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="array_moneda[]" id="moneda_n_'+window.contadorNumerosBonos+'" onChange="">\
                    <option value="0">USD</option>\
                    <option value="1">Peso chileno</option>\
                    <option value="2">Euro</option>\
                </select>\
            </div>\
            <div  style="box-sizing:border-box;width:80%;margin-left:10%;">\
                <div style="font-size: 12px;font-weight: 900;color: #404040;">Comentario</div>\
                <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="array_comentario[]" id="comentario_n_'+window.contadorNumerosBonos+'" />\
            </div>\
            <hr style="box-sizing:border-box;width:80%;margin-left:10%;background-color: #111;">\
        </div>';
        $("#contendor_lista_bono").append(plantilla);
    }
    else{
        window.contadorNumerosBonos++;
        let plantilla='\
        <div id="fila_bono_n_'+window.contadorNumerosBonos+'" style="box-sizing:border-box;width:100%;display:inline-flex;flex-direction:row;flex-wrap:wrap;">\
            <div  style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">\
                <div style="font-size: 12px;font-weight: 900;color: #404040;">Tipo de Bono</div>\
                <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="array_tipo_bono[]" id="tipo_bono_n_'+window.contadorNumerosBonos+'" onChange="">\
                    <option value="0">Partido citado</option>\
                    <option value="1">Partido ganado</option>\
                    <option value="2">Partido jugado</option>\
                </select>\
            </div>\
            <div  style="box-sizing:border-box;width:20%;margin-right:10%;">\
                <div style="font-size: 12px;font-weight: 900;color: #404040;">Monto</div>\
                <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="array_monto[]" id="moton_n_'+window.contadorNumerosBonos+'" />\
            </div>\
            <div  style="box-sizing:border-box;width:20%;margin-right:10%;">\
                <div style="font-size: 12px;font-weight: 900;color: #404040;">Tipo de moneda</div>\
                <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="array_moneda[]" id="moneda_n_'+window.contadorNumerosBonos+'" onChange="">\
                    <option value="0">USD</option>\
                    <option value="1">Peso chileno</option>\
                    <option value="2">Euro</option>\
                </select>\
            </div>\
            <div  style="box-sizing:border-box;width:80%;margin-left:10%;">\
                <div style="font-size: 12px;font-weight: 900;color: #404040;">Comentario</div>\
                <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="array_comentario[]" id="comentario_n_'+window.contadorNumerosBonos+'" />\
            </div>\
            <hr style="box-sizing:border-box;width:80%;margin-left:10%;background-color: #111;">\
        </div>';
        $("#contendor_lista_bono").append(plantilla);
    }

}

function iterarBonosJugador(bonos){
    let listaBonoHtml=[];
    for(let contador=0;contador<bonos.length;contador++){
        let plantilla='\
        <div id="fila_bono_n_'+window.contadorNumerosBonos+'" style="box-sizing:border-box;width:100%;display:inline-flex;flex-direction:row;flex-wrap:wrap;">\
            <div  style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">\
                <div style="font-size: 12px;font-weight: 900;color: #404040;">Tipo de Bono</div>\
                <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="array_tipo_bono[]" id="tipo_bono_n_'+(contador+1)+'" onChange="">\
                    <option value="0">Partido citado</option>\
                    <option value="1">Partido ganado</option>\
                    <option value="2">Partido jugado</option>\
                </select>\
            </div>\
            <div  style="box-sizing:border-box;width:20%;margin-right:10%;">\
                <div style="font-size: 12px;font-weight: 900;color: #404040;">Monto</div>\
                <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="array_monto[]" id="moton_n_'+(contador+1)+'" />\
            </div>\
            <div  style="box-sizing:border-box;width:20%;margin-right:10%;">\
                <div style="font-size: 12px;font-weight: 900;color: #404040;">Tipo de moneda</div>\
                <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" name="array_moneda[]" id="moneda_n_'+(contador+1)+'" onChange="">\
                    <option value="0">USD</option>\
                    <option value="1">Peso chileno</option>\
                    <option value="2">Euro</option>\
                </select>\
            </div>\
            <div  style="box-sizing:border-box;width:80%;margin-left:10%;">\
                <div style="font-size: 12px;font-weight: 900;color: #404040;">Comentario</div>\
                <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="array_comentario[]" id="comentario_n_'+(contador+1)+'" />\
            </div>\
            <hr style="box-sizing:border-box;width:80%;margin-left:10%;background-color: #111;">\
        </div>';
        listaBonoHtml.push(plantilla);
    }
    let str_bono_html=listaBonoHtml.join("");
    $("#contendor_lista_bono").append(str_bono_html);
    for(let contador2=0;contador2<bonos.length;contador2++){
        let bono=bonos[contador2];
        $("#tipo_bono_n_"+(contador2+1)).val(bono.tipo_bono);
        $("#moton_n_"+(contador2+1)).val(bono.monto);
        $("#moneda_n_"+(contador2+1)).val(bono.moneda);
        $("#comentario_n_"+(contador2+1)).val(bono.comentario_bono);
    }



}


function abrirFormulario(){
    window.estadoBorrarBuffer=true;
    $("#contendor_lista_bono").empty();
    $("#contendor_lista_pdf").empty();
    window.lista_pdf_delete=[];
    window.contadorNumerosBonos=0;
    window.contadorNumerosPdf=0;
    window.listaIdPdf=[];
    window.tipo_formulario=false;
    window.idficha_jugador=null;
    // isertar foto por defeto perfil jugador
    $("#foto_perfil_jugador").attr("src","../config/camiseta.png");
    //foto pdf default
    $("#vista_inicio").hide(500);
    $("#vista_formulario").show(500);
    limpiarFormularioCompleto();
    $("#editar_prestamos").css("display","none");
    $("#derecho_federativo").val("0");
    $("#boton_agregar_infrome").prop("disabled",true);
    $("#nacionalidad").val("CL");
    $("#mostrarCampoCondicion").val("5");
    mostrarCampoCondicion("5");
    agregarBono();
    vaciarTemp();
    // condicion -> 1
}

function contadorSelector(selector){
    let $selectores=document.querySelectorAll(selector);
    let contador=0;
    for(let selector of $selectores){
            console.log(selector);
            contador++;
        }
        return contador;
}

function validarFormulario(){
    
        
    let expresion=/[a-zA-z]/g;
    let nombre=$("#nombre").val();
    let apellido1=$("#apellido1").val();
    let rut=$("#rut").val();
    if(window.tipo_formulario){
        if(nombre!=="" && apellido1!=="" && rut!==""){
            
            let pdfsNombreNuevo=contadorSelector(".nombre_nuevo_pdf");
            let pdfsNombreUpdate=contadorSelector(".nombre_update_pdf");
            // let pdfsDescripcionNuevo=contadorSelector(".descripcion_nuevo_pdf");
            // let pdfsDescripcionUpdate=contadorSelector(".nombre_update_pdf");
            console.log(pdfsNombreNuevo);
            if(pdfsNombreUpdate>0){

                if(validarPdfUpdates()){

                    if(pdfsNombreNuevo>0){
                        if(validarPdfNuevos()){
                            $("#boton_agregar_infrome").prop("disabled",false);

                        }
                        else{
                            $("#boton_agregar_infrome").prop("disabled",true);
                            
                        }
                    }
                    else{
                        $("#boton_agregar_infrome").prop("disabled",false);

                    }

                }
                else{
                    $("#boton_agregar_infrome").prop("disabled",true);
                }
                
            }
            else{
                if(pdfsNombreNuevo>0){
                    if(validarPdfNuevos()){
                        
                        $("#boton_agregar_infrome").prop("disabled",false);

                    }
                    else{
                        $("#boton_agregar_infrome").prop("disabled",true);
                        
                    }
                }
                else{
                    $("#boton_agregar_infrome").prop("disabled",false);

                }


            }
        }
        else{
            $("#boton_agregar_infrome").prop("disabled",true);
        }
    }
    else{
        if(nombre!=="" && apellido1!=="" && rut!==""){
            let pdfsNombreNuevo=contadorSelector(".nombre_nuevo_pdf");
            if(pdfsNombreNuevo>0){
                if(validarPdfNuevos()){
                    $("#boton_agregar_infrome").prop("disabled",false);
                }
                else{
                    $("#boton_agregar_infrome").prop("disabled",true);

                }
                
            }
            else{
                $("#boton_agregar_infrome").prop("disabled",false);

            }

        }
        else{
            $("#boton_agregar_infrome").prop("disabled",true);
        }
    }
    
}

function validarPdfNuevos(){
    let $pdfsNombre=document.querySelectorAll(".nombre_nuevo_pdf");
    let $pdfsDescripcion=document.querySelectorAll(".descripcion_nuevo_pdf");
    let $inputFiles=document.querySelectorAll(".input_fila_nuevo");
    let estadoNombre=false;
    let estadoDescripcion=false;
    let estadoFile=false;
    for($pdfFile of $inputFiles){
        if($pdfFile.value===""){
            estadoFile=true;
            
        }
    }

    for($pdfNombre of $pdfsNombre){
        if($pdfNombre.value===""){
            estadoNombre=true;
        }
    }
    
    for($pdfDescripcion of $pdfsDescripcion){
        if($pdfDescripcion.value===""){
            estadoDescripcion=true;
        }
    }

    if(estadoNombre===false && estadoDescripcion===false && estadoFile===false){
        // $("#boton_agregar_infrome").prop("disabled",true);
        return true;
    }
    else{
        return false;
        // $("#boton_agregar_infrome").prop("disabled",false);
    }
}

function validarPdfUpdates(){
    let $pdfsNombre=document.querySelectorAll(".nombre_update_pdf");
    let $pdfsDescripcion=document.querySelectorAll(".descripcion_update_pdf");
    let estadoNombre=false;
    let estadoDescripcion=false;

    for($pdfNombre of $pdfsNombre){
        if($pdfNombre.value===""){
            estadoNombre=true;
            
        }
    }
    
    for($pdfDescripcion of $pdfsDescripcion){
        if($pdfDescripcion.value===""){
            estadoDescripcion=true;
        }
    }

    if(estadoNombre===false && estadoDescripcion===false){
        // $("#boton_agregar_infrome").prop("disabled",true);
        return true;
    }
    else{
        // $("#boton_agregar_infrome").prop("disabled",false);
        return false;
    }
}

function abrirFormularioEdicion(index){
    window.estadoBorrarBuffer=true;
    // document.getElementById("foto_registro").
    $("#contendor_lista_bono").empty();
    $("#contendor_lista_pdf").empty();
    window.contadorNumerosPdf=0;
    window.listaIdPdf=[];
    window.listaIdPdfUpload=[];
    window.lista_pdf_delete=[];
    window.tipo_formulario=true;
    let jugador=window.listas_fichas_jugadores.filter( jug =>{
        if(jug.idfichaJugador===index.toString()){
            return jug;
        }
    })[0];
    window.jugador_json=JSON.parse(JSON.stringify(jugador));
    console.log(window.jugador_json);
    window.idficha_jugador=jugador.idfichaJugador;
    $("#foto_perfil_jugador").attr("src","./foto_jugadores/"+jugador.idfichaJugador+".png");
    limpiarFormularioCompleto();
    $("#vista_inicio").hide(500);
    $("#vista_formulario").show(500);
    if(jugador.prestamos.length>0){
        $("#editar_prestamos").css("display","block");
        $("#editar_prestamo_jugador").css("display","none");
        $(".boton_actuzaliar_prestamo").css("display","none");
        $(".boton_eliminar_prestamo").css("display","none");
    }
    else{
        $("#editar_prestamos").css("display","none");
        $(".boton_actuzaliar_prestamo").css("display","none");
        $(".boton_eliminar_prestamo").css("display","none");
    }
    $("#tipo_prestamo_edita").val("NULL");
    
    // =================== INSERTAR DATOS GENERALES =================
    $("#fecha_vencimiento_pasaporte").val(window.jugador_json.fecha_vencimiento_pasaporte_ficha_jugador_mc);
    $("#fecha_nacimiento").val(window.jugador_json.fechaNacimiento);
    $("#nombre").val(window.jugador_json.nombre);
    $("#apellido1").val(window.jugador_json.apellido1);
    $("#apellido2").val(window.jugador_json.apellido2);
    $("#rut").val(window.jugador_json.rut);
    $("#nacionalidad").val(window.jugador_json.nacionalidad1);
    $("#nacionalidad_adicional").val(window.jugador_json.nacionalidad_adicional_ficha_jugador_mc);
    $("#pie_habil").val(window.jugador_json.pieHabil);
    $("#estatura").val( ((window.jugador_json.altura===null)?"":window.jugador_json.altura));
    $("#correo").val(window.jugador_json.email);
    $("#telefono").val(window.jugador_json.telefono);
    $("#posicion").val(jugador.posicionesJugador[0].posicion);
    if(jugador.posicionesJugador.length>1){
        $("#posicion2").val(jugador.posicionesJugador[1].posicion);
    }
    $("#prevision").val(window.jugador_json.prevision);
    $("#seguro").val(window.jugador_json.seguro_ficha_jugador_mc);
    $("#dorsal").val(window.jugador_json.numeroDorsal);
    // =================== DOCUMENTOS Y OTROS DATOS =================
    $("#pasaporte").val(window.jugador_json.pasaporte_ficha_jugador_mc);
    $("#valor_mercado").val(window.jugador_json.valor_mercado_ficha_jugador_mc);
    $("#representante").val(window.jugador_json.representante_ficha_jugador_mc);
    $("#correo_representante").val(window.jugador_json.correo_representante_ficha_jugador_mc);
    $("#telefono_representante").val(window.jugador_json.telefono_representante_ficha_jugador_mc);
    // =================== DATOS DEPORTIVOS ==========================
    $("#derecho_federativo").val(jugador.derecho_federativo);
    $("#formado_en").val(window.jugador_json.formado_en_ficha_jugador_mc);
    
    activarCampoOtroClub($("#formado_en").val());
    if($("#formado_en").val()==="1"){
        $("#otro_club").val(window.jugador_json.otro_club_ficha_jugador_mc);
    }
    $("#condicion").val(window.jugador_json.estado);
    mostrarCampoCondicion("5");
    if($("#condicion").val()==="5"){
        $("#ano_llegada_club").val(window.jugador_json.ano_llegada_club_ficha_jugador_mc);
        $("#fecha_inicio_contrato").val(window.jugador_json.fecha_inicio_contrato_ficha_jugador_mc);
        $("#fecha_fin_contrato").val(window.jugador_json.fecha_fin_contrato_ficha_jugador_mc);
        $("#costos_derecho").val(window.jugador_json.costos_derecho_ficha_jugador_mc);
        $("#clausula_rescision").val(window.jugador_json.clausula_rescision_ficha_jugador_mc);
        $("#observacion_datos_contrato_condicion_pertenece").val(window.jugador_json.observacion_datos_contrato_condicion_pertenece_ficha_jugador_mc);
    }
    // =================== DATOS CONTRATO ===========================
    $("#sueldo_bruto").val(window.jugador_json.sueldo_bruto_ficha_jugador_mc);
    $("#sueldo_neto").val(window.jugador_json.sueldo_neto_ficha_jugador_mc);
    $("#monto_arriendo_vivienda").val(window.jugador_json.monto_arriendo_vivienda_ficha_jugador_mc);
    $("#valor_total_contrato").val(window.jugador_json.valor_total_contrato_ficha_jugador_mc);
    $("#otros_costos_asociados").val(window.jugador_json.otros_costos_asociados_ficha_jugador_mc);
    $("#premios_pactados").val(window.jugador_json.premios_pactados_ficha_jugador_mc);
    $("#observacion_datos_contrato").val(window.jugador_json.observacion_datos_contrato_ficha_jugador_mc);
    // =================== RESCISION DE CONTRATO ======================
    $("#estado").val(window.jugador_json.estado_ficha_jugador_mc);
    datosContratoEstado($("#estado").val());
    if(window.jugador_json.estado_ficha_jugador_mc==="1"){
        $("#fecha_termino_contrato").val(window.jugador_json.fecha_termino_contrato_ficha_jugador_mc);
        $("#motivo").val(window.jugador_json.motivo_ficha_jugador_mc);
        $("#costos_asociados").val(window.jugador_json.costos_asociados_ficha_jugador_mc);
        $("#observacion_rescision_contrato").val(window.jugador_json.observacion_rescision_contrato_ficha_jugador_mc);
    }
    $("#movilizacion").val(window.jugador_json.movilizacion);
    $("#colacion").val(window.jugador_json.colacion);
    $("#viaticos").val(window.jugador_json.viaticos);
    $("#remuneracion").val(window.jugador_json.otros_remuneraciones);
    $("#desgaste").val(window.jugador_json.desgaste);
    
    if(window.jugador_json.bonos.length===0){
        window.contadorNumerosBonos=0;
        agregarBono();
    }
    else{
        window.contadorNumerosBonos=window.jugador_json.bonos.length;
        iterarBonosJugador(window.jugador_json.bonos);
    }
    iterrarArchivosPdfs(window.jugador_json.archivos_pdfs);
    validarFormulario();
    vaciarTemp();
    
}

function iterrarArchivosPdfs(pdfs){
    
    // window.listaIdPdf=
    let contador=0;
    for(let pdf of pdfs){
        window.listaIdPdfUpload.push(pdf.idarchivo_pdf_jugador);
        let plantilla='\
        <div id="fila_pdf_n_'+pdf.idarchivo_pdf_jugador+'" style="box-sizing:border-box;width:100%;display:inline-flex;flex-direction:row;flex-wrap:wrap;">\
            <div  style="box-sizing:border-box;width:20%;margin-right:10%;margin-left:10%;">\
                <br>\
                <input type="file" name="array_pdf_update[]" id="pdf_n_'+ pdf.idarchivo_pdf_jugador+'" accept=".pdf" class="input_fila_update">\
            </div>\
            <div  style="box-sizing:border-box;width:20%;margin-right:10%;">\
                <div style="font-size: 12px;font-weight: 900;color: #404040;">Nombre</div>\
                <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="array_nombre_pdf_update[]"  class="nombre_update_pdf" id="nombre_n_'+ pdf.idarchivo_pdf_jugador+'"  onKeyup="validarFormulario()"/>\
            </div>\
            <div  style="box-sizing:border-box;width:20%;margin-right:1%;">\
                <div style="font-size: 12px;font-weight: 900;color: #404040;">Descripción</div>\
                <input style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" type="text" name="array_descripcion_pdf_update[]"  class="descripcion_update_pdf" id="descripcion_n_'+ pdf.idarchivo_pdf_jugador+'"  onKeyup="validarFormulario()"/>\
            </div>\
            <button style="width: 3%;display: block;cursor: pointer;background-color: #f44336;height: 25px;border: 0;border-radius: 5px;color: #fff;margin-top: 21px;font-size: 16px;" class="" onClick="boton_eliminarFilas('+pdf.idarchivo_pdf_jugador+')">\
                <i class="icon-remove"></i>\
            </button>\
            <button style="margin-bottom: 10px;margin-left: 10%;width: 10%;margin-bottom:10px;" class="boton_agregar_ficha_jugador" onClick="uploadTemporalPdfCambiar('+pdf.idarchivo_pdf_jugador+')"><b style="font-size:12px;">Subir</b></button>\
            <img id="loaderSpinnerPdf_n_'+ pdf.idarchivo_pdf_jugador+'" src="../config/spinner.gif" style="display:none;width: 20px;height: 20px;margin-top: 5px;margin-left: 10px;margin-right:30%;">\
            <br>\
            <div id="checkOkPdf'+pdf.idarchivo_pdf_jugador+'" style="margin-left:20px;color:<?php echo $color_fondo; ?>;font-size:18px;display:none;margin-right:30%;"><i class="icon-ok"></i></div>\
            <br>\
            <div id="progresoPdf_'+pdf.idarchivo_pdf_jugador+'" class="progress" style="margin-left:10%;margin-top:10px;height:5px;width: 80%"><div id="progressPdf_n_'+pdf.idarchivo_pdf_jugador+'" style="height:5px;background-color: <?php echo $color_fondo; ?>;width: 0%"></div>\
            <br>\
            <hr style="box-sizing:border-box;width:80%;margin-left:10%;background-color: #111;">\
        </div>';
        $("#contendor_lista_pdf").append(plantilla);
        $('#nombre_n_'+ pdf.idarchivo_pdf_jugador).val(pdf.nombre_archivo);
        $('#descripcion_n_'+ pdf.idarchivo_pdf_jugador).val(pdf.titulo_archivo);
    }
    // console.log(window.listaIdPdfUpload);

}

function mostrarInfoFichaJugador(index){
    $("html, body").animate({ scrollTop: 0 }, 600);
    let jugador=window.listas_fichas_jugadores.filter( jug =>{
        if(jug.idfichaJugador===index.toString()){
            return jug;
        }
    })[0];
    console.log(jugador.archivos_pdfs);
    window.jugadorInfo=jugador;

    

    // console.log(jugador);
    $("#vista_inicio").hide(500);
    $("#vista_info_ficha_jugador").show(500);
    $("#info_ficha_jugador_dorsal").text(jugador.numeroDorsal);
    $("#info_ficha_jugador_nombre_apellido1").text(jugador.nombre);
    $("#info_ficha_jugador_apellido2").text(jugador.apellido1);
    let expresion=/-/g;
    let fecha=fecha_formato_ddmmaaa(jugador.fechaNacimiento).replace(expresion,"/");
    $("#info_ficha_jugador_fecha_nacimiento").text(fecha);
    $("#info_ficha_jugador_edad").text(calcularEdad(jugador.fechaNacimiento)+" Años");
    $("#info_ficha_jugador_nacionalidad").html('<img src="flags/blank.gif" class="flag flag-'+jugador.nacionalidad1.toLowerCase()+'"/>');
    $("#info_ficha_jugador_pie").text(window.pie[parseInt(jugador.pieHabil)]);
    $("#info_ficha_jugador_rut").text(jugador.rut);
    $("#info_ficha_jugador_foto_jugador").attr("src","./foto_jugadores/"+jugador.idfichaJugador+".png?idasas='"+new Date().getTime()+"'");
    $("#info_ficha_jugador_foto_cancha_posicion").attr("src","./img/cancha_posicion_"+jugador.posicionesJugador[0].posicion+".jpeg");
    $("#info_ficha_jugador_posicion").text(lista_posiciones[parseInt(jugador.posicionesJugador[0].posicion)-1]);
    // $("#seccion_info_jugador_resume").prop("checked",true);
    $("#seccion_info_jugador_resume").prop("checked",true);
    seccionInfoJugador();
    // DATOS GENERALES
    $("#presonal_nombre_ficha_jugador").text(jugador.nombre+" "+jugador.apellido1+" "+jugador.apellido2);
    $("#presonal_rut_ficha_jugador").text(jugador.rut);
    $("#presonal_fecha_nacimiento_ficha_jugador").text(fecha);
    $("#presonal_nacionalidad_1_ficha_jugador").text(obtenerNacionalidadSelectPaisesOcultos(jugador.nacionalidad1));
    $("#presonal_nacionalidad_2_ficha_jugador").text(obtenerNacionalidadSelectPaisesOcultos(jugador.nacionalidad_adicional_ficha_jugador_mc));
    $("#presonal_correo_ficha_jugador").text(jugador.email);
    $("#presonal_telefono_ficha_jugador").text(jugador.telefono);
    $("#presonal_prevision_ficha_jugador").text(mostrarSaludJugador(jugador.prevision));
    $("#presonal_seguro_ficha_jugador").text((jugador.seguro_ficha_jugador_mc==="1")?"Si":"No");
    // DOCUMENTOS
    $("#presonal_pasaporte_ficha_jugador").text(jugador.pasaporte_ficha_jugador_mc);
    let fecha_vencimiento_pasaporte=fecha_formato_ddmmaaa(jugador.fecha_vencimiento_pasaporte_ficha_jugador_mc).replace(expresion,"/");
    $("#presonal_fecha_vencimiento_pasaporte_ficha_jugador").text(fecha_vencimiento_pasaporte);
    let fecha_vencimiento_rut=fecha_formato_ddmmaaa(jugador.fecha_vencimiento_rut_ficha_jugador_mc).replace(expresion,"/");
    $("#presonal_fecha_vencimiento_rut_ficha_jugador").text(fecha_vencimiento_rut);
    // REPRESENTANTE
    let lista_formado_en=[
        "El club",
        "Otro club",
        "Co - formado"
    ];
    let lista_condicion={
        2:"A préstamo en el club",
        5:"En el club",
        1:"A préstamo en otro club"
    };
    // DATOS DEPORTIVOS
    $("#presonal_valor_mercado_ficha_jugador").text(jugador.valor_mercado_ficha_jugador_mc);
    $("#presonal_representante_ficha_jugador").text(jugador.representante_ficha_jugador_mc);
    $("#presonal_correo_representante_ficha_jugador").text(jugador.correo_representante_ficha_jugador_mc);
    $("#presonal_estatura_ficha_jugador").text(((jugador.altura===null)?"":jugador.altura+" cm"));
    $("#presonal_dorsal_ficha_jugador").text(jugador.numeroDorsal);
    $("#presonal_formado_en_ficha_jugador").text(lista_formado_en[parseInt(jugador.formado_en_ficha_jugador_mc)]);
    $("#presonal_condicion_ficha_jugador").text((jugador.estado===null)?"A préstamo en el club":lista_condicion[parseInt(jugador.estado)]);
    $("#presonal_sueldo_bruto_ficha_jugador").text(jugador.sueldo_bruto_ficha_jugador_mc);
    $("#presonal_sueldo_neto_ficha_jugador").text(jugador.sueldo_neto_ficha_jugador_mc);
    $("#presonal_monto_vivienda_ficha_jugador").text(jugador.monto_arriendo_vivienda_ficha_jugador_mc);
    $("#presonal_monto_total_contrato_ficha_jugador").text((jugador.valor_total_contrato_ficha_jugador_mc===null || jugador.valor_total_contrato_ficha_jugador_mc==="")?"Sin monto":jugador.valor_total_contrato_ficha_jugador_mc+" V");
    $("#presonal_otros_costos_asociados_ficha_jugador").text((jugador.otros_costos_asociados_ficha_jugador_mc==="")?"Sin costos asociados":jugador.otros_costos_asociados_ficha_jugador_mc+" V");
    $("#presonal_premios_pactados_ficha_jugador").text((jugador.premios_pactados_ficha_jugador_mc==="")?"Sin premios pactados":jugador.premios_pactados_ficha_jugador_mc);
    $("#presonal_observacion_ficha_jugador").text((jugador.observacion_datos_contrato_condicion_pertenece_ficha_jugador_mc===null)?"Sin observación":jugador.observacion_datos_contrato_condicion_pertenece_ficha_jugador_mc);
    
    
    
    $("#presonal_movilizacion_ficha_jugador").text(( jugador.movilizacion==="" || jugador.movilizacion===null)?"":jugador.movilizacion);
    $("#presonal_colocacion_ficha_jugador").text(( jugador.colacion==="" || jugador.colacion===null)?"":jugador.colacion);
    $("#presonal_desgaste_ficha_jugador").text(( jugador.desgaste==="" || jugador.desgaste===null)?"":jugador.desgaste);
    $("#presonal_viaticos_ficha_jugador").text(( jugador.viaticos==="" || jugador.viaticos===null)?"":jugador.viaticos);
    $("#presonal_remuneracion_ficha_jugador").text(( jugador.otros_remuneraciones==="" || jugador.otros_remuneraciones===null)?"":jugador.otros_remuneraciones);
    
    insertarPrestamosJugadorInfo(jugador);
    if(jugador.bonos.length>0){
        $("#titulo_tabla_bono").css("display","block");
        $("#tabla_bono").css("display","table");
        insertarBonosTabla(jugador.bonos);
    }
    else{
        $("#titulo_tabla_bono").css("display","none");
        $("#tabla_bono").css("display","none");

    }

    $("#archivo_pdf").empty();
    if(jugador.archivos_pdfs.length>0){
        $("#contenedor_visor_pdf").css("display","none");
        $("#contenedor_archivos_pdf_select").css("display","block");
        insertarOptionSelectArchivosPdf(jugador.archivos_pdfs);

    }
    else{
        $("#contenedor_visor_pdf").css("display","none");
        $("#contenedor_archivos_pdf_select").css("display","none");
    }
    

}

function insertarBonosTabla(bonos){
    $("#contendor_body_tabla_bono").empty();
    let listaTiposDeBonos=[
        "Partido citado",
        "Partido ganado",
        "Partido jugado"
    ];
    let listMonedas=[
        "USD",
        "Peso chileno",
        "Euro"
    ];

    let listaRowTableBono=[];
    for(let bono of bonos){
        let plantilla='\
        <tr>\
            <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 19px;">\
            '+listaTiposDeBonos[parseInt(bono.tipo_bono)]+'\
            </td>\
            <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 19px;">\
                '+bono.monto+'\
            </td>\
            <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 40px;">\
                '+listMonedas[parseInt(bono.moneda)]+'\
            </td>\
            <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 51px;">\
                '+bono.comentario_bono+'\
            </td>\
        </tr>';
        listaRowTableBono.push(plantilla);
    }

    let str_bono_row=listaRowTableBono.join("");
    $("#contendor_body_tabla_bono").append(str_bono_row);
}

function mostrarPdf(idPdf){
    if(idPdf==="null"){
        $('#contenedor_visor_pdf').css("display","none");
    }
    else{
        let idCarpetaJugador=window.jugadorInfo.idfichaJugador;
        $('#contenedor_visor_pdf').css("display","block");
        $('#viewer').attr('src',"pdf_jugadores/"+idCarpetaJugador+"/"+idPdf+".pdf");

    }
}

function insertarOptionSelectArchivosPdf(pdfs){


    let listaOptionPdfs=["<option value='null'>Seleccione archivo</option>"];
    for(let pdf of pdfs){
        let option="<option value='"+pdf.idarchivo_pdf_jugador+"'>"+pdf.nombre_archivo+" ("+pdf.titulo_archivo+")</option>";
        listaOptionPdfs.push(option);
    }
    let strOption=listaOptionPdfs.join("");
    $("#archivo_pdf").append(strOption);


}

function insertarPrestamosJugadorInfo(jugador){
    // <img style='margin-left:30%;margin-right:2px;float:left;width: 20px;height: 20px;' src='../config/equipos/"+prestamos[posicion].pais_origen_club_prestamo_ficha_jugador_mc.toLowerCase()+"/"+prestamos[posicion].origen_club_prestamo_ficha_jugador_mc+".png'/>
    
    $("#contenedo_prestamo_tabla_html_div").empty();
    if(jugador.prestamos.length>0){
        for(let prestamo of jugador.prestamos){
            // console.log(prestamo);
            let platillaFila='\
                <tr>\
                <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 47px;">\
                '+((prestamo.condicion_prestamo_ficha_jugador_mc==="2")?"A préstamo en el club":"A préstamo en otro club")+'\
                </td>\
                <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 56px;">\
                '+formato_fecha_mes_texto(prestamo.fecha_inicio_prestamo_prestamo_ficha_jugador_mc)+'\
                </td>\
                <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 56px;">\
                '+formato_fecha_mes_texto(prestamo.fecha_fin_prestamo_prestamo_ficha_jugador_mc)+'\
                </td>\
                <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 26px;">\
                <img src="flags/blank.gif" class="flag flag-'+obtenerNacionalidadSelectPaisesOcultostexto(prestamo.pais_origen_club_prestamo_ficha_jugador_mc).toLowerCase()+'"> '+prestamo.pais_origen_club_prestamo_ficha_jugador_mc+'\
                </td>\
                <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 31px;">\
                <img style="margin-right:5px;width: 20px;height: 20px;" src="../config/equipos/'+prestamo.pais_origen_club_prestamo_ficha_jugador_mc.toLowerCase()+'/'+prestamo.origen_club_prestamo_ficha_jugador_mc+'.png"/>'+window.lista_club_paises[prestamo.pais_origen_club_prestamo_ficha_jugador_mc][parseInt(prestamo.origen_club_prestamo_ficha_jugador_mc)]+'\
                </td>\
                <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 38px;">\
                '+prestamo.valor_prestamo_prestamo_ficha_jugador_mc+'\
                </td>\
                <td style="box-sizing:border-box;border:0;height:30px;line-height:30px;word-break: break-word;text-align: left;padding-left: 5px;max-width: 63px;">\
                '+prestamo.observacion_datos_deportivos_prestamo_ficha_jugador_mc+'\
                </td>\
            </tr>\
            ';
            // $("#contenedo_prestamo_tabla_html_div").append('\
            //     <div  style="box-sizing:border-box;border:0;width:100%;height:auto;display:inline-flex;flex-direction:row;flex-wrap:wrap;">\
            //         <div style="box-sizing:border-box;border:0;width:15%;height:30px;line-height:30px;padding-left:5px;font-weight: 700;">'+((prestamo.condicion_prestamo_ficha_jugador_mc==="0")?"A préstamo en el club":"A préstamo en otro club")+'</div>\
            //         <div style="box-sizing:border-box;border:0;width:14.2%;height:30px;line-height:30px;padding-left:5px;">'+formato_fecha_mes_texto(prestamo.fecha_inicio_prestamo_prestamo_ficha_jugador_mc)+'</div>\
            //         <div style="box-sizing:border-box;border:0;width:14.2%;height:30px;line-height:30px;padding-left:5px;">'+formato_fecha_mes_texto(prestamo.fecha_fin_prestamo_prestamo_ficha_jugador_mc)+'</div>\
            //         <div style="box-sizing:border-box;border:0;width:10%;height:30px;line-height:30px;padding-left:5px;"><img src="flags/blank.gif" class="flag flag-'+obtenerNacionalidadSelectPaisesOcultostexto(prestamo.pais_origen_club_prestamo_ficha_jugador_mc).toLowerCase()+'"> '+prestamo.pais_origen_club_prestamo_ficha_jugador_mc+'</div>\
            //         <div style="box-sizing:border-box;border:0;width:10%;height:30px;line-height:30px;padding-left:5px;text-overflow:ellipsis;overflow:hidden;"><img style="margin-right:5px;width: 20px;height: 20px;" src="../config/equipos/'+prestamo.pais_origen_club_prestamo_ficha_jugador_mc.toLowerCase()+'/'+prestamo.origen_club_prestamo_ficha_jugador_mc+'.png"/>'+window.lista_club_paises[prestamo.pais_origen_club_prestamo_ficha_jugador_mc][parseInt(prestamo.origen_club_prestamo_ficha_jugador_mc)]+'</div>\
            //         <div style="box-sizing:border-box;border:0;width:14.28%;height:30px;line-height:30px;padding-left:5px;">'+prestamo.valor_prestamo_prestamo_ficha_jugador_mc+'</div>\
            //         <div style="box-sizing:border-box;border:0;width:22.32%;height:30px;line-height:30px;padding-left:5px;" class="ellipsis-text">'+prestamo.observacion_datos_deportivos_prestamo_ficha_jugador_mc+'</div>\
            //     </div>\
            // ');
            $("#contenedo_prestamo_tabla_html_div").append(platillaFila);
        }
    }
    else{
        $("#contenedo_prestamo_tabla_html_div").append('<tr ><td colspan="7" style="box-sizing:border-box;border:0;height:30px;line-height:30px;text-align:center;color:#111;font-weight: 700;"><h5 style="color:#555555;margin-top:10px;margin-buttom:10px;"><i class="icon-file-alt"></i> Sin Préstamos</h5></td></tr>');
        // $("#contenedo_prestamo_tabla_html_div").append('<div style="box-sizing:border-box;border:0;width:100%;height:30px;line-height:30px;text-align:center;color:#111;font-weight: 700;">sin prestamos</div>');
    }
    
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


function mostrarSaludJugador(prevision){
    let texto_salud=[
        'Fonasa A',
        'Fonasa B',
        'Fonasa C',
        'Fonasa D',
        'Isapre Banmedica',
        'Isapre Vida tres',
        'Isapre Colmena',
        'Isapre Consalud',
        'Isapre Cruz blanza',
        'Isapre Nueva Más Vida',
        'Isapre Fusat',
        'Isapre Isalud',
        'Capredena',
        'Dipreca',
        'PRAIS',
        'Ninguna',
    ];
    return texto_salud[parseInt(prevision)]
}

function obtenerNacionalidadSelectPaisesOcultos(nacionalidad="NULL"){
    // esta function compara el valor insetado con los valores en el select de paises ocultos pero con el value
    let select_paises_ocultos=document.getElementById("paises_ocultos"),
    nacionalidad_opction=null;
    for(let option of select_paises_ocultos){
        if(option.value===nacionalidad){
            nacionalidad_opction=option;
            break;
        }
    }
    return (nacionalidad_opction.value==="NULL")?"no tiene":nacionalidad_opction.text;
}

function obtenerNacionalidadSelectPaisesOcultostexto(nacionalidad="NULL"){
    // esta function compara el valor insetado con los valores en el select de paises ocultos pero con el text
    let select_paises_ocultos=document.getElementById("paises_ocultos"),
    nacionalidad_opction=null;
    for(let option of select_paises_ocultos){
        if(option.text.toLowerCase()===nacionalidad){
            console.log(option);
            nacionalidad_opction=option;
            break;
        }
    }
    return (nacionalidad_opction.value==="NULL")?"no tiene":nacionalidad_opction.value;
}

function seccionInfoJugador(){

    if($("#seccion_info_jugador_resume").prop("checked")){
        $("#seccion_info_jugador_resume_pest").css("border-bottom","2px solid #fff");
        $("#seccion_info_jugador_resume_apartado").css("display","block");
    }
    else{
        $("#seccion_info_jugador_resume_pest").css("border-bottom","0 solid #fff");
        $("#seccion_info_jugador_resume_apartado").css("display","none");
    }

    if($("#seccion_info_jugador_personales").prop("checked")){
        $("#seccion_info_jugador_personales_pest").css("border-bottom","2px solid #fff");
        $("#seccion_info_jugador_personales_apartado").css("display","inline-flex");
    }
    else{
        $("#seccion_info_jugador_personales_pest").css("border-bottom","0 solid #fff");
        $("#seccion_info_jugador_personales_apartado").css("display","none");
    }

    if($("#seccion_info_jugador_partidos").prop("checked")){
        $("#seccion_info_jugador_partidos_pest").css("border-bottom","2px solid #fff");
        $("#seccion_info_jugador_partidos_apartado").css("display","block");
    }
    else{
        $("#seccion_info_jugador_partidos_pest").css("border-bottom","0 solid #fff");
        $("#seccion_info_jugador_partidos_apartado").css("display","none");
    }

    if($("#seccion_info_jugador_estadisticas").prop("checked")){
        $("#seccion_info_jugador_estadisticas_pest").css("border-bottom","2px solid #fff");
        $("#seccion_info_jugador_estadisticas_apartado").css("display","block");
    }
    else{
        $("#seccion_info_jugador_estadisticas_pest").css("border-bottom","0 solid #fff");
        $("#seccion_info_jugador_estadisticas_apartado").css("display","none");
    }

    if($("#seccion_info_jugador_lesiones").prop("checked")){
        $("#seccion_info_jugador_lesiones_pest").css("border-bottom","2px solid #fff");
        $("#seccion_info_jugador_lesiones_apartado").css("display","block");
    }
    else{
        $("#seccion_info_jugador_lesiones_pest").css("border-bottom","0 solid #fff");
        $("#seccion_info_jugador_lesiones_apartado").css("display","none");
    }

    if($("#seccion_info_jugador_antro").prop("checked")){
        $("#seccion_info_jugador_antro_pest").css("border-bottom","2px solid #fff");
        $("#seccion_info_jugador_antro_apartado").css("display","block");
    }
    else{
        $("#seccion_info_jugador_antro_pest").css("border-bottom","0 solid #fff");
        $("#seccion_info_jugador_antro_apartado").css("display","none");
    }

    if($("#seccion_info_jugador_test").prop("checked")){
        $("#seccion_info_jugador_test_pest").css("border-bottom","2px solid #fff");
        $("#seccion_info_jugador_test_apartado").css("display","block");
    }
    else{
        $("#seccion_info_jugador_test_pest").css("border-bottom","0 solid #fff");
        $("#seccion_info_jugador_test_apartado").css("display","none");
    }

    if($("#seccion_info_jugador_tratamiento").prop("checked")){
        $("#seccion_info_jugador_tratamiento_pest").css("border-bottom","2px solid #fff");
        $("#seccion_info_jugador_tratamiento_apartado").css("display","block");
    }
    else{
        $("#seccion_info_jugador_tratamiento_pest").css("border-bottom","0 solid #fff");
        $("#seccion_info_jugador_tratamiento_apartado").css("display","none");
    }

    if($("#seccion_info_jugador_seleccion").prop("checked")){
        $("#seccion_info_jugador_seleccion_pest").css("border-bottom","2px solid #fff");
        $("#seccion_info_jugador_seleccion_apartado").css("display","block");
    }
    else{
        $("#seccion_info_jugador_seleccion_pest").css("border-bottom","0 solid #fff");
        $("#seccion_info_jugador_seleccion_apartado").css("display","none");
    }

    if($("#seccion_info_jugador_prestamos").prop("checked")){
        $("#seccion_info_jugador_prestamos_pest").css("border-bottom","2px solid #fff");
        $("#seccion_info_jugador_prestamo_apartado").css("display","block");
    }
    else{
        $("#seccion_info_jugador_prestamos_pest").css("border-bottom","0px solid #fff");
        $("#seccion_info_jugador_prestamo_apartado").css("display","none");
    }

}

function botonVolverHaInicio(){
    limpiarFormularioCompleto();
    $("#nombre_jugador_filtro").val("");
    $("#vista_formulario").hide(500);
    $("#vista_inicio").show(500);
    $("html, body").animate({ scrollTop: 0 }, 600);
    mostrarDatosPrestamo("NULL");
    $("#tipo_prestamo").val("NULL");
    consultarFichaJugadores();
}

function botonVolverDeinfoAInicio(){
    $("#nombre_jugador_filtro").val("");
    $("#vista_info_ficha_jugador").hide(500);
    $("#vista_inicio").show(500);
    consultarFichaJugadores();
}

function datosContratoEstado(estado){
    if(estado==="1"){
        limpiarEstadoContrato();
        $(".estado").css("display","block");
        // $(".fecha_termino_contrato").css("display","block");

    }
    else{
        $(".estado").css("display","none");
        // $(".fecha_termino_contrato").css("display","none");
    }
} 

function limpiarFormularioCompleto(){
    fechaNacimientoHoy();
    insertarNumeroDorsal();
    fechaVencimientoPasaporte();
    fechaVencimientoRut();
    fechaInicioPrestamoHoy();
    fechaFinPrestamoHoy();
    insetarPaisesOrigenClub();
    fechaInicioContratoHoy();
    fechaFinContratoHoy();
    insertarAnosSelect();
    $("#foto_registro").val("");
    $("#nombre").val("");
    $("#apellido1").val("");
    $("#apellido2").val("");
    $("#rut").val("");
    $("#nacionalidad").val("NULL");
    $("#nacionalidad_adicional").val("NULL");
    $("#pie_habil").val("0");
    $("#estatura").val("");
    $("#correo").val("");
    $("#telefono").val("");
    $("#posicion").val("1");
    $("#posicion2").val("null");
    $("#prevision").val("0");
    $("#seguro").val("1");
    // ------------------------
    $("#condicion").val("NULL");
    mostrarCampoCondicion("NULL");
    $("#formado_en").val("NULL");
    activarCampoOtroClub("0");
    $("#pasaporte").val("");
    $("#valor_mercado").val("");
    $("#representante").val("");
    $("#correo_representante").val("");
    $("#telefono_representante").val("");
    // ---------------------------
    $("#sueldo_bruto").val("");
    $("#sueldo_neto").val("");
    $("#monto_arriendo_vivienda").val("");
    $("#valor_total_contrato").val("");
    $("#otros_costos_asociados").val("");
    $("#premios_pactados").val("");
    $("#observacion_datos_contrato").val("");
    $("#estado").val("0");
    datosContratoEstado($("#estado").val());
    // isertar foto por defeto perfil jugador
    // $("#foto_perfil_jugador").attr("src","../config/default.png");
    //foto pdf default
    $("#imagen_pdf").attr("src","../images/pdf_upload.png");
    $("#checked_imagen").css("display","none")
    $("#contrato_pdf").val("");
    $("#movilizacion").val("");
    $("#colacion").val("");
    $("#viaticos").val("");
    $("#remuneracion").val("");
    $("#desgaste").val("");
}

function limpiarEstadoContrato(){
    fechaTerminoContratoHoy();
    $("#motivo").val("0");
    $("#costos_asociados").val("");
    $("#observacion_rescision_contrato").val("");
}

function limpiarCampoCondicion0Y2(){
    fechaFinPrestamoHoy();
    fechaInicioPrestamoHoy();
    fechaFinalContratoPrestamoEnOtroClub();
    $("#valor_prestamo").val("");
    $("#opcion_compra").val("");
    $("#observacion_datos_deportivos").val("");
    insetarPaisesOrigenClub();
}

function limpiarCampoCondicion1(){
    fechaInicioContratoHoy();
    fechaFinContratoHoy();
    $("#costos_derecho").val("");
    $("#clausula_rescision").val("");
    $("#observacion_datos_contrato_condicion_pertenece").val("");
    insertarAnosSelect();
}

function fechaNacimientoHoy(){
    $("#fecha_nacimiento").datetimepicker({
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
    $("#fecha_nacimiento").datetimepicker('setDate', new Date() );
}

function fechaVencimientoPasaporte(){
    $("#fecha_vencimiento_pasaporte").datetimepicker({
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
    $("#fecha_vencimiento_pasaporte").datetimepicker('setDate', new Date() );
}

function fechaVencimientoRut(){
    $("#fecha_vencimiento_rut").datetimepicker({
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
    $("#fecha_vencimiento_rut").datetimepicker('setDate', new Date() );
}

function fechaInicioPrestamoHoy(){
    $("#fecha_inicio_prestamo").datetimepicker({
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
    $("#fecha_inicio_prestamo").datetimepicker('setDate', new Date() );
}

function fechaFinPrestamoHoy(){
    $("#fecha_fin_prestamo").datetimepicker({
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
    $("#fecha_fin_prestamo").datetimepicker('setDate', new Date() );
}

function fechaInicioContratoHoy(){
    $("#fecha_inicio_contrato").datetimepicker({
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
    $("#fecha_inicio_contrato").datetimepicker('setDate', new Date() );
}

function fechaFinContratoHoy(){
    $("#fecha_fin_contrato").datetimepicker({
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
    $("#fecha_fin_contrato").datetimepicker('setDate', new Date() );
}


function fechaTerminoContratoHoy(){
    $("#fecha_termino_contrato").datetimepicker({
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
    $("#fecha_termino_contrato").datetimepicker('setDate', new Date() );
}

function fechaInicioPrestamo(){
    $("#editar_fecha_inicio_prestamo").datetimepicker({
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
    $("#editar_fecha_inicio_prestamo").datetimepicker('setDate', new Date() );
}

function fechaFinalPrestamo(){
    $("#editar_fecha_fin_prestamo").datetimepicker({
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
    $("#editar_fecha_fin_prestamo").datetimepicker('setDate', new Date() );
}

function fechaFinalContratoPrestamoEnOtroClub(){
    $("#fecha_fin_contrato_prestamo").datetimepicker({
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
    $("#fecha_fin_contrato_prestamo").datetimepicker('setDate', new Date() );
}

// fecha_fin_contrato_prestamo_editar

function fechaFinalContratoPrestamoEnOtroClubEditar(){
    $("#fecha_fin_contrato_prestamo_editar").datetimepicker({
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
    $("#fecha_fin_contrato_prestamo_editar").datetimepicker('setDate', new Date() );
}


function insertarNumeroDorsal(){
    // dorsal
    $("#dorsal").empty();
    for(let contador=1;contador<=100;contador++){
        $("#dorsal").append("<option value='"+contador+"'>"+contador+"</option>");
    }
}

function activarCampoOtroClub(valor){
    let $contenedor_condicion=document.getElementById("contenedor_condicion");
    if(valor==="1"){
        $("#campo_otro_club").css("display","block");
        $("#otro_club").val("");
        $contenedor_condicion.style.marginLeft="10%";
        
    }
    else{
        $("#otro_club").val("");
        $("#campo_otro_club").css("display","none");
        $contenedor_condicion.style.marginLeft="";
    }
}

function mostrarCampoCondicion(valor){
    if(valor==="2" || valor==="1"){ 
        limpiarCampoCondicion0Y2();
        if(valor==="2"){
            document.getElementById("pais_condicion").textContent="País club origen"
            document.getElementById("club_condicion").textContent="Club origen"
            $("#contenedor_fecha_fin_contrato_prestamo").css("display","none");
            $("#fecha_fin_contrato_prestamo").val("");

        }
        else{
            document.getElementById("pais_condicion").textContent="País club destino"
            document.getElementById("club_condicion").textContent="Club destino"
            $("#contenedor_fecha_fin_contrato_prestamo").css("display","block");
            
        }

        $("#campo_condicion_0_y_2").css("display","inline-flex");
    }
    else{
        limpiarCampoCondicion0Y2();
        $("#campo_condicion_0_y_2").css("display","none");
    }

    if(!window.tipo_formulario){
        if(valor==="5"){ 
            limpiarCampoCondicion1();
            $("#campo_condicion_1").css("display","inline-flex");
        }
        else{
            limpiarCampoCondicion1();
            $("#campo_condicion_1").css("display","none");
        }
    }
    else{
        if(valor==="5"){ 
            $("#campo_condicion_1").css("display","inline-flex");
        }
        else{
            $("#campo_condicion_1").css("display","none");
        }
    }
    // campo_condicion_1
}

function insetarPaisesOrigenClub(){
    $("#pais_origen_club").empty();
    for( let pais of window.lista_paises){
        $("#pais_origen_club").append("<option value='"+pais+"'>"+pais+"</option>");
    }
    insertarClubPais($("#pais_origen_club").val());
}

function insertarClubPais(pais){
    $("#origen_club").empty();
    let contado=0;
    for (let club of window.lista_club_paises[pais]){
        $("#origen_club").append("<option value='"+contado+"'>"+club+"</option>");
        // $("#origen_club").append("<option data-id-club='"+(contado)+"' value='"+club+"'>"+club+"</option>");
        contado++
    }
}

function consultar_ano_actual(){
    $.ajax({
            url: "post/ficha_jugador_consultar_año_actual.php",
            type: "get"
            ,success: function(respuesta) {
                var json=JSON.parse(respuesta);
                window.ano_actual_servidor=parseInt(json.ano_actual);
                
		},error: function(){// will fire when timeout is reached
			// alert("errorXXXXX");
    	}, timeout: 10000 // sets timeout to 3 seconds
	});
}

function insertarAnosSelect(){
    $("#ano_llegada_club").empty();

    for(let contador=window.ano_actual_servidor;contador>=window.ano_actual_servidor-15;contador--){
        $("#ano_llegada_club").append("<option value='"+contador+"'>"+contador+"</option>");
    }

}

function mostrarModalEnviarDatos(){
    if(!window.tipo_formulario){;
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar una ficha?</h5><br><img src="../config/agregar_archivo.png">');
    }
    else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar esta ficha?</h5><br><img src="../config/agregar_archivo.png">');
    }
    $("#contendor_botones_modal").empty();
    $("#contendor_botones_modal").html(
        '<button type="button" class="btn btn-default boton_modal" onClick="cerrarModalFormularioEnviarDatos()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>'
        +'<button type="button" id="guardar" class="btn btn-default boton_modal " onClick="enviarDatos()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> ');
    $("#modalFormulario").modal("show");
}

function cerrarModalFormularioEnviarDatos(){
    $("#modalFormulario").modal("hide");
}

function enviarDatos(){
    if(!window.tipo_formulario){
		$('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando jugador ...</h5><br><img src="../config/agregar_archivo.png">');
	}else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando jugador ...</h5><br><img src="../config/agregar_archivo.png">');
	}
    
    let formData =new FormData(document.getElementById("vista_formulario"));
    formData=validarCondicion(formData);
    formData=validarEstadoContrato(formData);
    formData.append("tipo_formulario",window.tipo_formulario);
    formData.append("nombre_usuario_software",window.nombre_usuario_software);
    formData.append("idficha_jugador",window.idficha_jugador);
    //  window.listaIdPdf}


    if(document.getElementById("foto_registro").files.length>0){
        estado_foto_jugador=true;
        formData.append("estado_foto_jugador",true);
    }
    else{
        formData.append("estado_foto_jugador",false);
    }

    for(let idpPdf of window.listaIdPdf){
        formData.append("array_id_buffer_pdf[]",idpPdf);
    }
    
    for(let idpPdfDelete of window.lista_pdf_delete){
        formData.append("array_id_pdf_delete[]",idpPdfDelete);
    }
    
    for(let idpPdfUpdate of window.listaIdPdfUpload){
        formData.append("array_id_pdf_update[]",idpPdfUpdate);
    }
    // estatura
    if(formData.get("estatura")===""){
        formData.set("estatura","NULL");
    }

   

    for (var pair of formData.entries()) {
        console.log(pair[0]+ ', ' + pair[1]); 
    }
    // console.log("===========");
    // console.log(window.listaIdPdfUpload);

    $.ajax({
        url: "post/ficha_jugador_guardar.php",
        type: "post",
        data:formData,
        processData: false,
        contentType: false,
        cache:false,
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            // console.log(json);
            $("#modalFormulario").modal("hide");
            $("#vista_formulario").hide();
            $("#vista_inicio").show();
            botonVolverHaInicio();
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
        }, timeout: 10000 // sets timeout to 3 seconds
    });
}

function validarCondicion(formData){
    if(!window.tipo_formulario){
        if(formData.get("condicion")!=="5"){
            formData.set("ano_llegada_club","null");
            formData.set("fecha_inicio_contrato","null");
            formData.set("fecha_fin_contrato","null");
            formData.set("costos_derecho","null");
            formData.set("clausula_rescision","null");
            formData.set("observacion_datos_contrato_condicion_pertenece","null");
        }
        return formData;
    }
    else{
        return formData;
    }
}

function validarEstadoContrato(formData){
    if(formData.get("estado")==="0"){
        formData.set("fecha_termino_contrato","null");
        formData.set("motivo","null");
        formData.set("costos_asociados","null");
        formData.set("observacion_rescision_contrato","null");
    }
    return formData;
}

function consultarFichaJugadores(){
    // console.log(nombre);
    $("#gif_de_carga_tabla_jugadores").css("display","block");
    let nombre=$("#nombre_jugador_filtro").val();
    let datosFiltros=[];
    datosFiltros.push({name:"nombre",value:nombre});
    let $checkBoxPrestamos=document.querySelectorAll("[name='array_prestamos[]']:checked");
    for(let prestamo of $checkBoxPrestamos){
        datosFiltros.push({name:"array_lista_prestamo[]",value:prestamo.value})
    }
    // alert(JSON.stringify(datosFiltros));
    window.listas_fichas_jugadores=[];
    $("#seccion_arquero").empty();
    $("#seccion_defensa").empty();
    $("#seccion_medio_campista").empty();
    $("#seccion_delantero").empty();
    $.ajax({
        url: "post/ficha_jugador_consultar.php",
        type: "post",
        data:datosFiltros,
        success: function(respuesta) {
            $("#gif_de_carga_tabla_jugadores").css("display","none");
            var json=JSON.parse(respuesta);
            console.log(json);
            window.listas_fichas_jugadores=json.datos
            insetarDatosTablaHtml(window.listas_fichas_jugadores);
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
        }, timeout: 10000 // sets timeout to 3 seconds
    });
}

function insetarDatosTablaHtml(jugadores){
    // console.clear();
    console.log(jugadores);
    let lista_arqueros=[],
    lista_defensas=[],
    lista_campistas=[],
    lista_delantero=[],
    contador=0;
    let contador1=0;
    let contador2=0;
    let contador3=0;
    let contador4=0;
    for(let jugador of jugadores){
        let fila="";
        if(jugador.posicionA===1){
            // contador++;
            let pie=null;
            if(jugador.pieHabil==="0"){
                pie="Derecho";
            }
            else if(jugador.pieHabil==="1"){
                pie="Izquierdo";
            }
            else{
                pie="Ambidiestro";
            }
            let prestamo_str=estadoPrestamoJugador(jugador);

            
            // alert(jugador.posicion);
            fila='\
            <div class="fila_serie_jugador"  style="box-sizing:border-box;border:0;width:100%;height:32px;cursor:pointer;padding-top: 1px;padding-bottom: 1px;font-size:11px;">\
                <div onClick="mostrarInfoFichaJugador('+jugador.idfichaJugador+')" style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+(contador+1)+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador.idfichaJugador+')" style="box-sizing:border-box;border:0;width:13%;height:30px;float:left;color:#555;line-height: 30px;">'+jugador.posicion_texto+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador.idfichaJugador+')" style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">P.E</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador.idfichaJugador+')" style="box-sizing:border-box;border:0;width:16%;height:30px;float:left;">\
                    <div style="box-sizing:border-box;border:0;float:left;width:20%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;">\
                        <img style="width:100%;height:100%" src="./foto_jugadores/'+jugador.idfichaJugador+'.png?idasas='+new Date().getTime()+'" />\
                    </div>\
                    <div style="box-sizing:border-box;border:0;float:left;width:80%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;text-transform: Capitalize" class="ellipsis-text">'+jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2+'</div>\
                </div>\
                <div onClick="mostrarInfoFichaJugador('+jugador.idfichaJugador+')" style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+ ((jugador.altura===null)?"":jugador.altura+" cm")+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador.idfichaJugador+')" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+jugador.fechaNacimiento+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador.idfichaJugador+')" style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+calcularEdad(jugador.fechaNacimiento)+' Años</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador.idfichaJugador+')" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">\
                    <img src="flags/blank.gif" class="flag flag-'+jugador.nacionalidad1.toLowerCase()+'"/>\
                </div>\
                <div onClick="mostrarInfoFichaJugador('+jugador.idfichaJugador+')" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;font-size: 10px;padding-top: 5px;background-color:'+prestamo_str.colorEstadoPrestamo+';" class="tooltip-customized"><span class="tooltiptext">'+prestamo_str.club+'<br>'+prestamo_str.fechaPrestamo+'</span>'+prestamo_str.estado+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador.idfichaJugador+')" style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+prestamo_str.fecha+'</div>\
                <div  style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;text-align:center;padding-top:5px;">\
                    <center >\
                        <a class="boton_editar" onClick="abrirFormularioEdicion('+jugador.idfichaJugador+')">\
                            <i class="icon-pencil"></i>\
                        </a>\
                    </center>\
                </div>\
                <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;text-align:center;padding-top:5px;">\
                    <center >\
                        <a class="boton_eliminar" onClick="modalEliminar('+jugador.idfichaJugador+')">\
                            <i class="icon-remove"></i>\
                        </a>\
                    </center>\
                </div>\
            </div>';

            let $checkBoxPrestamos=document.querySelectorAll("[name='array_prestamos[]']:checked");
            if( $checkBoxPrestamos.length===0){
                contador++
                lista_arqueros.push(fila);
            }
            else{
                for(let prestamo of $checkBoxPrestamos){
                    console.log(prestamo.value)
                    if(parseInt(prestamo.value)===prestamo_str.prestamo){
                        contador++
                        lista_arqueros.push(fila);
                    }
                }
            }
            // console.log(checkBoxPrestamos);
            // console.log(jugador.nombre+"  "+prestamo_str.prestamo)
            
        }
    }
    for(let jugador2 of jugadores){
        let fila="";
        if(jugador2.posicionA===2){
            let pie=null;
            if(jugador2.pieHabil==="0"){
                pie="Derecho";
            }
            else if(jugador2.pieHabil==="1"){
                pie="Izquierdo";
            }
            else{
                pie="Ambidiestro";
            }
            let prestamo_str=estadoPrestamoJugador(jugador2);
            
            fila='\
            <div class="fila_serie_jugador"  style="box-sizing:border-box;border:0;width:100%;height:32px;cursor:pointer;padding-top: 1px;padding-bottom: 1px;font-size:11px;">\
                <div onClick="mostrarInfoFichaJugador('+jugador2.idfichaJugador+')" style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+(contador+1)+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador2.idfichaJugador+')" style="box-sizing:border-box;border:0;width:13%;height:30px;float:left;color:#555;line-height: 30px;">'+jugador2.posicion_texto+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador2.idfichaJugador+')" style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">P.E</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador2.idfichaJugador+')" style="box-sizing:border-box;border:0;width:16%;height:30px;float:left;">\
                    <div style="box-sizing:border-box;border:0;float:left;width:20%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;">\
                        <img style="width:100%;height:100%" src="./foto_jugadores/'+jugador2.idfichaJugador+'.png?idasas='+new Date().getTime()+'"/>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;float:left;width:80%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;text-transform: Capitalize" class="ellipsis-text">'+jugador2.nombre+' '+jugador2.apellido1+' '+jugador2.apellido2+'</div>\
                </div>\
                <div onClick="mostrarInfoFichaJugador('+jugador2.idfichaJugador+')" style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+((jugador2.altura===null)?"":jugador2.altura+" cm")+' </div>\
                <div onClick="mostrarInfoFichaJugador('+jugador2.idfichaJugador+')" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+jugador2.fechaNacimiento+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador2.idfichaJugador+')" style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+calcularEdad(jugador2.fechaNacimiento)+' Años</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador2.idfichaJugador+')" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">\
                    <img src="flags/blank.gif" class="flag flag-'+jugador2.nacionalidad1.toLowerCase()+'"/>\
                </div>\
                <div onClick="mostrarInfoFichaJugador('+jugador2.idfichaJugador+')" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;font-size: 10px;padding-top: 5px;background-color:'+prestamo_str.colorEstadoPrestamo+';" class="tooltip-customized"><span class="tooltiptext">'+prestamo_str.club+'</span>'+prestamo_str.estado+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador2.idfichaJugador+')" style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+prestamo_str.fecha+'</div>\
                <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;text-align:center;padding-top:5px;">\
                    <center >\
                        <a class="boton_editar" onClick="abrirFormularioEdicion('+jugador2.idfichaJugador+')">\
                            <i class="icon-pencil"></i>\
                        </a>\
                    </center>\
                </div>\
                <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;text-align:center;padding-top:5px;">\
                    <center >\
                        <a class="boton_eliminar"  onClick="modalEliminar('+jugador2.idfichaJugador+')">\
                            <i class="icon-remove"></i>\
                        </a>\
                    </center>\
                </div>\
            </div>';
            let $checkBoxPrestamos=document.querySelectorAll("[name='array_prestamos[]']:checked");
            if( $checkBoxPrestamos.length===0){
                contador++
                lista_defensas.push(fila);
            }
            else{
                for(let prestamo of $checkBoxPrestamos){
                    console.log(prestamo.value)
                    if(parseInt(prestamo.value)===prestamo_str.prestamo){
                        contador++
                        lista_defensas.push(fila);
                    }
                }
            }
        }
    }
    for(let jugador3 of jugadores){
        let fila="";
        if(jugador3.posicionA===3){
            let pie=null;
            if(jugador3.pieHabil==="0"){
                pie="Derecho";
            }
            else if(jugador3.pieHabil==="1"){
                pie="Izquierdo";
            }
            else{
                pie="Ambidiestro";
            }
            let prestamo_str=estadoPrestamoJugador(jugador3);
            
            fila='\
            <div class="fila_serie_jugador" style="box-sizing:border-box;border:0;width:100%;height:32px;cursor:pointer;padding-top: 1px;padding-bottom: 1px;font-size:11px;">\
                <div onClick="mostrarInfoFichaJugador('+jugador3.idfichaJugador+')" style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+(contador+1)+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador3.idfichaJugador+')" style="box-sizing:border-box;border:0;width:13%;height:30px;float:left;color:#555;line-height: 30px;">'+jugador3.posicion_texto+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador3.idfichaJugador+')" style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">P.E</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador3.idfichaJugador+')" style="box-sizing:border-box;border:0;width:16%;height:30px;float:left;">\
                    <div style="box-sizing:border-box;border:0;float:left;width:20%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;">\
                        <img style="width:100%;height:100%" src="./foto_jugadores/'+jugador3.idfichaJugador+'.png?idasas='+new Date().getTime()+'"/>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;float:left;width:80%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;text-transform: Capitalize" class="ellipsis-text">'+jugador3.nombre+' '+jugador3.apellido1+' '+jugador3.apellido2+'</div>\
                </div>\
                <div onClick="mostrarInfoFichaJugador('+jugador3.idfichaJugador+')" style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+((jugador3.altura===null)?"":jugador3.altura+" cm")+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador3.idfichaJugador+')" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+jugador3.fechaNacimiento+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador3.idfichaJugador+')" style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+calcularEdad(jugador3.fechaNacimiento)+' Años</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador3.idfichaJugador+')" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">\
                    <img src="flags/blank.gif" class="flag flag-'+jugador3.nacionalidad1.toLowerCase()+'"/>\
                </div>\
                <div onClick="mostrarInfoFichaJugador('+jugador3.idfichaJugador+')" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;font-size: 10px;padding-top: 5px;background-color:'+prestamo_str.colorEstadoPrestamo+';" class="tooltip-customized"><span class="tooltiptext">'+prestamo_str.club+'</span>'+prestamo_str.estado+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador3.idfichaJugador+')" style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+prestamo_str.fecha+'</div>\
                <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;text-align:center;padding-top:5px;">\
                    <center >\
                        <a class="boton_editar" onClick="abrirFormularioEdicion('+jugador3.idfichaJugador+')">\
                            <i class="icon-pencil"></i>\
                        </a>\
                    </center>\
                </div>\
                <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;text-align:center;padding-top:5px;">\
                    <center >\
                        <a class="boton_eliminar"  onClick="modalEliminar('+jugador3.idfichaJugador+')">\
                            <i class="icon-remove"></i>\
                        </a>\
                    </center>\
                </div>\
            </div>';
            let $checkBoxPrestamos=document.querySelectorAll("[name='array_prestamos[]']:checked");
            if( $checkBoxPrestamos.length===0){
                contador++
                lista_campistas.push(fila);
            }
            else{
                for(let prestamo of $checkBoxPrestamos){
                    console.log(prestamo.value)
                    if(parseInt(prestamo.value)===prestamo_str.prestamo){
                        contador++
                        lista_campistas.push(fila);
                    }
                }
            }
        }
    }
    for(let jugador4 of jugadores){
        let fila="";
        if(jugador4.posicionA===4){
            let pie=null;
            if(jugador4.pieHabil==="0"){
                pie="Derecho";
            }
            else if(jugador4.pieHabil==="1"){
                pie="Izquierdo";
            }
            else{
                pie="Ambidiestro";
            }
            let prestamo_str=estadoPrestamoJugador(jugador4);
            fila='\
            <div class="fila_serie_jugador"  style="box-sizing:border-box;border:0;width:100%;height:32px;cursor:pointer;padding-top: 1px;padding-bottom: 1px;font-size:11px;">\
                <div onClick="mostrarInfoFichaJugador('+jugador4.idfichaJugador+')" style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+(contador+1)+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador4.idfichaJugador+')" style="box-sizing:border-box;border:0;width:13%;height:30px;float:left;color:#555;line-height: 30px;">'+jugador4.posicion_texto+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador4.idfichaJugador+')" style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">P.E</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador4.idfichaJugador+')" style="box-sizing:border-box;border:0;width:16%;height:30px;float:left;">\
                    <div style="box-sizing:border-box;border:0;float:left;width:20%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;">\
                        <img style="width:100%;height:100%" src="./foto_jugadores/'+jugador4.idfichaJugador+'.png?idasas='+new Date().getTime()+'"/>\
                    </div>\
                    <div style="box-sizing:border-box;border:0;float:left;width:80%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;text-transform: Capitalize" class="ellipsis-text">'+jugador4.nombre+' '+jugador4.apellido1+' '+jugador4.apellido2+'</div>\
                </div>\
                <div onClick="mostrarInfoFichaJugador('+jugador4.idfichaJugador+')" style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+ ((jugador4.altura===null)?"":jugador4.altura+" cm")+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador4.idfichaJugador+')" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+jugador4.fechaNacimiento+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador4.idfichaJugador+')" style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+calcularEdad(jugador4.fechaNacimiento)+' Años</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador4.idfichaJugador+')" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">\
                    <img src="flags/blank.gif" class="flag flag-'+jugador4.nacionalidad1.toLowerCase()+'"/>\
                </div>\
                <div onClick="mostrarInfoFichaJugador('+jugador4.idfichaJugador+')" style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;font-size: 10px;padding-top: 5px;background-color:'+prestamo_str.colorEstadoPrestamo+';" class="tooltip-customized"><span class="tooltiptext">'+prestamo_str.club+'</span>'+prestamo_str.estado+'</div>\
                <div onClick="mostrarInfoFichaJugador('+jugador4.idfichaJugador+')" style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;color:#555;line-height: 30px;text-align:center;">'+prestamo_str.fecha+'</div>\
                <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;text-align:center;padding-top:5px;">\
                    <center >\
                        <a class="boton_editar" onClick="abrirFormularioEdicion('+jugador4.idfichaJugador+')">\
                            <i class="icon-pencil"></i>\
                        </a>\
                    </center>\
                </div>\
                <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;text-align:center;padding-top:5px;">\
                    <center >\
                        <a class="boton_eliminar"  onClick="modalEliminar('+jugador4.idfichaJugador+')">\
                            <i class="icon-remove"></i>\
                        </a>\
                    </center>\
                </div>\
            </div>';
            let $checkBoxPrestamos=document.querySelectorAll("[name='array_prestamos[]']:checked");
            if( $checkBoxPrestamos.length===0){
                contador++
                lista_delantero.push(fila);
            }
            else{
                for(let prestamo of $checkBoxPrestamos){
                    console.log(prestamo.value)
                    if(parseInt(prestamo.value)===prestamo_str.prestamo){
                        contador++
                        lista_delantero.push(fila);
                    }
                }
            }
        }
    }
    // =============================================
    if(lista_arqueros.length>0){
        $("#seccion_arquero").append('<div style="box-sizing:border-box;border:0;width:100%;height:20px;background-color:#555;color:#fff;font-weight: bold;padding-left: 25px;">AQUEROS</div>');
        for(let arquero of lista_arqueros ){
            $("#seccion_arquero").append(arquero);
        }
    }
     // =============================================
    if(lista_defensas.length>0){
        $("#seccion_defensa").append('<div style="box-sizing:border-box;border:0;width:100%;height:20px;background-color:#555;color:#fff;font-weight: bold;padding-left: 25px;">DEFENSAS</div>');
        for(let defensa of lista_defensas ){
            $("#seccion_defensa").append(defensa);
        }
    }
     // =============================================
    if(lista_campistas.length>0){
        $("#seccion_medio_campista").append('<div style="box-sizing:border-box;border:0;width:100%;height:20px;background-color:#555;color:#fff;font-weight: bold;padding-left: 25px;">MEDIOCAMPISTAS</div>');
        for(let campista of lista_campistas ){
            $("#seccion_medio_campista").append(campista);
        }
    }
     // =============================================
    if(lista_delantero.length>0){
        $("#seccion_delantero").append('<div style="box-sizing:border-box;border:0;width:100%;height:20px;background-color:#555;color:#fff;font-weight: bold;padding-left: 25px;">DELANTEROS</div>');
        for(let delantero of lista_delantero ){
            $("#seccion_delantero").append(delantero);
        }
    }
    if(lista_arqueros.length===0 && lista_defensas.length===0 && lista_campistas.length===0 && lista_delantero.length===0){
        $("#seccion_arquero").append(' <div class="fila_serie_jugador"  style="box-sizing:border-box;border:0;width:100%;height:32px;cursor:pointer;padding-top: 1px;padding-bottom: 1px;font-size:11px;text-align:center;line-height:30px;font-weight: bold;">Sin jugadores</div>');
    }
    console.log(jugadores);
}

function estadoPrestamoJugador(jugador){
    if(jugador.prestamos.length===0 && jugador.estado==="5"){
        let fecha2=coloresFechaVenciminetoContrato(jugador.fecha_fin_contrato_ficha_jugador_mc,parseInt(jugador.meses_diferencia.meses_diferencia));
        return  {
                estado:"-",
                fecha:fecha2,
                club:"",
                prestamo:5,
                fechaPrestamo:"",
                colorEstadoPrestamo:""
            };
    }
    else{
        // alert("hola")
        return rangoPrestamo(jugador.prestamos,jugador);
        // return "XX  ";
    }
}

function rangoPrestamo(prestamos,jugador){
    // console.log(prestamos);
    let estado=false;
    let condicion=null;
    let posicion=0;
    let contador=0;
    for(prestamo of prestamos){
        if(prestamo.condicion_prestamo_ficha_jugador_mc==="1"){
            let fecha_fin_tmp=prestamo.fecha_fin_prestamo_prestamo_ficha_jugador_mc.split("-")
            let mes_fecha_fin_tmp=parseInt(fecha_fin_tmp[1]);
            let fecha_fin=new Date(fecha_fin_tmp[0],mes_fecha_fin_tmp-1,fecha_fin_tmp[2]);
            let fecha_inicio_tmp=prestamo.fecha_inicio_prestamo_prestamo_ficha_jugador_mc.split("-")
            let mes_fecha_inicio_tmp=parseInt(fecha_inicio_tmp[1]);
            let fecha_inicio=new Date(fecha_inicio_tmp[0],mes_fecha_inicio_tmp-1,fecha_inicio_tmp[2]);
            let hoy=new Date();
            if(hoy < fecha_fin){
                estado=true;
                condicion="1";
                posicion=contador;
                break;
            }
            else{
                // alert("hola 1");
                
                condicion="5";
            }
        }
        else{
            // posicion=contador;
            posicion=contador;
            condicion="2";
        }
        contador++;

    }
    // console.log(jugador)
    if(condicion==="2"){
        let fecha2=coloresFechaVenciminetoContrato(prestamos[posicion].fecha_fin_prestamo_prestamo_ficha_jugador_mc,parseInt(prestamos[posicion].dias_diferencia_fecha_fin_prestamo.meses_diferencia));
        let colorEstadoPrestamo=coloresFechaVenciminetoPrestamo(prestamos[posicion].fecha_fin_prestamo_prestamo_ficha_jugador_mc,parseInt(prestamos[posicion].dias_diferencia_fecha_fin_prestamo.meses_diferencia));
        return {
                estado:"<img style='margin-left:30%;margin-right:2px;float:left;width: 20px;height: 20px;' src='../config/equipos/"+prestamos[posicion].pais_origen_club_prestamo_ficha_jugador_mc.toLowerCase()+"/"+prestamos[posicion].origen_club_prestamo_ficha_jugador_mc+".png'/><span style='float:left;color:green;'><svg width='1em' style='font-size:15px;line-height:30px;' height='1em' viewBox='0 0 16 16' class='bi bi-arrow-left-circle-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5.5a.5.5 0 0 0 0-1H5.707l2.147-2.146a.5.5 0 1 0-.708-.708l-3 3a.5.5 0 0 0 0 .708l3 3a.5.5 0 0 0 .708-.708L5.707 8.5H11.5z'/></svg></span>",
                fecha:fecha2,
                club:window.lista_club_paises[prestamos[posicion].pais_origen_club_prestamo_ficha_jugador_mc][parseInt(prestamos[posicion].origen_club_prestamo_ficha_jugador_mc)],
                prestamo:2,
                fechaPrestamo:"("+prestamos[posicion].fecha_fin_prestamo_prestamo_ficha_jugador_mc+")",
                colorEstadoPrestamo:colorEstadoPrestamo
            };
    }
    else if(condicion==="5"){
        let fecha2=coloresFechaVenciminetoContrato(jugador.fecha_fin_contrato_ficha_jugador_mc,parseInt(jugador.meses_diferencia.meses_diferencia));
        return {
                estado:"-",
                fecha:fecha2,
                club:"",
                prestamo:5,
                fechaPrestamo:"",
                colorEstadoPrestamo:""
            };
    }
    else if(condicion==="1"){
        let fecha2=coloresFechaVenciminetoContrato(prestamos[posicion].fecha_fin_contrato_prestamo,parseInt(prestamos[posicion].dias_diferencia_fecha_fin_contrato_prestamo.meses_diferencia));
        let colorEstadoPrestamo=coloresFechaVenciminetoPrestamo(prestamos[posicion].fecha_fin_prestamo_prestamo_ficha_jugador_mc,parseInt(prestamos[posicion].dias_diferencia_fecha_fin_prestamo.meses_diferencia));
        return {
                estado:"<img style='margin-left:30%;margin-right:2px;float:left;width: 20px;height: 20px;' src='../config/equipos/"+prestamos[posicion].pais_origen_club_prestamo_ficha_jugador_mc.toLowerCase()+"/"+prestamos[posicion].origen_club_prestamo_ficha_jugador_mc+".png'/> <span style='float:left;color:red;'><svg width='1em' style='font-size:15px;line-height:30px;' height='1em' viewBox='0 0 16 16' class='bi bi-arrow-right-circle-fill' fill='currentColor' xmlns='http://www.w3.org/2000/svg'><path fill-rule='evenodd' d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-11.5.5a.5.5 0 0 1 0-1h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5z'/></svg></span>",
                fecha:fecha2,
                club:window.lista_club_paises[prestamos[posicion].pais_origen_club_prestamo_ficha_jugador_mc][parseInt(prestamos[posicion].origen_club_prestamo_ficha_jugador_mc)],
                prestamo:1,
                fechaPrestamo:"("+prestamos[posicion].fecha_fin_prestamo_prestamo_ficha_jugador_mc+")",
                colorEstadoPrestamo:colorEstadoPrestamo
            };
    }
}

function coloresFechaVenciminetoContrato(fecha,dias){
    // (dias<270 && dias>=210
    if(fecha!==null){
        if(dias>365){
            return "<span >"+fecha+"</span>";
        }
        else if(dias>180 && dias<=365){
            return "<span style='background-color:#ffa502;color:#111;'>"+fecha+"</span>";
        }
        else if(dias<=180){
            return "<span style='background-color:#F96C6C;color:#111;'>"+fecha+"</span>";
        }

    }
    else{
        return "-";
    }
    // alert(mesNumber);
}
function coloresFechaVenciminetoPrestamo(fecha,dias){
    // (dias<270 && dias>=210
    if(fecha!==null){
        if(dias>365){
            return "";
        }
        else if(dias>180 && dias<=365){
            return "#ffa502";
        }
        else if(dias<=180){
            return "#F96C6C";
        }

    }
    else{
        return "";
    }
    // alert(mesNumber);
}

function modalEliminar(id){
    // alert(id);
    $("#mensaje_agregar_DescargarBoleta").html('<h5>¿Estás seguro que quieres eliminar esta jugador?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    const html_botones=' <button type="button" class="btn btn-default boton_modal" data-dismiss="modal" onClick="cerrarModalEliminarJugador()" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>\
        <button type="button" id="eliminar_modal" class="btn btn-default boton_modal " onClick="eliminarJugador('+id+');" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button>';
    $("#contendor_botones_modal").html(html_botones);
    $("#modalFormulario").modal("show");
}

function cerrarModalEliminarJugador(){
    $("#modalFormulario").modal("hide");
}

function eliminarJugador(id){
    // alert(id);
    $.ajax({
        url: "post/ficha_jugador_eliminar.php",
        type: "post",
        data:[{name:"idfichaJugador",value:id}],
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            consultarFichaJugadores();
            cerrarModalEliminarJugador();
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
        }, timeout: 10000 // sets timeout to 3 seconds
    });
}

function formatoRut(rut_sin_formato){
    let cortar_rut=rut_sin_formato.split("-");
    let numeros=cortar_rut[0];
    let ultimo_caracter=cortar_rut[1];
    let rut_con_formato="";
    if(numeros.length===8){
        rut_con_formato=numeros.substring(0,2)+'.'+numeros.substring(2,5)+'.'+numeros.substring(5,8)+'-'+ultimo_caracter;
    }
    else{
        rut_con_formato=numeros.substring(0,1)+'.'+numeros.substring(1,4)+'.'+numeros.substring(4,7)+'-'+ultimo_caracter;
    }
    return rut_con_formato;
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


function consultarTipoPrestamosJugador(tipo){
    $(".boton_actuzaliar_prestamo").css("display","none");
    $(".boton_eliminar_prestamo").css("display","none");
    if(tipo==="2"){
        document.getElementById("pais_condicion_editar").textContent="País club origen";
        document.getElementById("club_condicion_editar").textContent="Club origen";
        $("#contenedor_fecha_fin_contrato_prestamo_editar").css("display","none");
        $("#fecha_fin_contrato_prestamo_editar").val("");

    }
    else{
        document.getElementById("pais_condicion_editar").textContent="País club destino";
        document.getElementById("club_condicion_editar").textContent="Club destino";
        $("#contenedor_fecha_fin_contrato_prestamo_editar").css("display","block");
    }
    let lista_prestamo_jugador=[
        {id:"NULL",value:"Seleccione"}
    ];
    window.listas_prestamos_jugador=[];
    $("#prestamo_jugador").empty();
    $("#editar_prestamo_jugador").css("display","none");
    $("#campos_editar_prestamos").css("display","none");
    if(tipo!=="NULL"){
        $.ajax({
        url: "post/ficha_jugador_consultar_prestamos_jugador.php",
        type: "post",
        data:[
            {name:"tipo_prestamo",value:tipo},
            {name:"idfichaJugador",value:window.idficha_jugador}
        ],
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            console.log(json);
            if(json.datos.length>0){
                window.listas_prestamos_jugador=json.datos;
                for(let prestamo of json.datos){
                    // value:prestamo.pais_origen_club_prestamo_ficha_jugador_mc+", "+window.lista_club_paises[prestamo.pais_origen_club_prestamo_ficha_jugador_mc][parseInt(prestamo.origen_club_prestamo_ficha_jugador_mc)]+" ("+prestamo.fecha_inicio_prestamo_prestamo_ficha_jugador_mc+")"
                    lista_prestamo_jugador.push({
                        id:prestamo.idprestamo_ficha_jugador_mc,
                        // value:prestamo.pais_origen_club_prestamo_ficha_jugador_mc+", "+prestamo.origen_club_prestamo_ficha_jugador_mc+" ("+prestamo.fecha_inicio_prestamo_prestamo_ficha_jugador_mc+")"
                        value:prestamo.pais_origen_club_prestamo_ficha_jugador_mc+", "+window.lista_club_paises[prestamo.pais_origen_club_prestamo_ficha_jugador_mc][parseInt(prestamo.origen_club_prestamo_ficha_jugador_mc)]+" ("+prestamo.fecha_inicio_prestamo_prestamo_ficha_jugador_mc+")"
                        });
                }
                for(let option of lista_prestamo_jugador){
                    $("#prestamo_jugador").append("<option value='"+option.id+"'>"+option.value+"</option>");
                }
                $("#editar_prestamo_jugador").css("display","block");
            }
            else{
                $("#editar_prestamo_jugador").css("display","none");
            }
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
        }, timeout: 10000 // sets timeout to 3 seconds
        });
    }
}

function mostrarDatosPrestamo(valor){
    if(valor!=="NULL"){
        insetarPaisesOrigenClubEditar();
        InsertarDatosPrestamo(valor);
        $("#campos_editar_prestamos").css("display","inline-flex");
        $(".boton_actuzaliar_prestamo").css("display","block");
        $(".boton_eliminar_prestamo").css("display","block");
    }
    else{
        $("#campos_editar_prestamos").css("display","none");
        $(".boton_actuzaliar_prestamo").css("display","none");
        $(".boton_eliminar_prestamo").css("display","none");
    }
    
}

function insetarPaisesOrigenClubEditar(){
    $("#editar_pais_origen_club").empty();
    for( let pais of window.lista_paises){
        $("#editar_pais_origen_club").append("<option value='"+pais+"'>"+pais+"</option>");
    }
    insertarClubPaisEditar($("#editar_pais_origen_club").val());
}

function insertarClubPaisEditar(pais){
    $("#editar_origen_club").empty();
    let contador=0;
    for (let club of window.lista_club_paises[pais]){
        // $("#editar_origen_club").append("<option value='"+club+"'>"+club+"</option>");
        $("#editar_origen_club").append("<option value='"+contador+"'>"+club+"</option>");
        contador++
    }
}

function InsertarDatosPrestamo(id_prestamo){
    // alert(id_prestamo);
    // console.log(window.listas_prestamos_jugador);
    fechaInicioPrestamo();
    fechaFinalPrestamo();
    fechaFinalContratoPrestamoEnOtroClubEditar();
    let prestamo_seleccionado=null;
    for(let prestamo of window.listas_prestamos_jugador){
        if(prestamo.idprestamo_ficha_jugador_mc===id_prestamo){
            prestamo_seleccionado=prestamo;
        }
    }
    $(".boton_actuzaliar_prestamo").attr("id",prestamo_seleccionado.idprestamo_ficha_jugador_mc);
    $(".boton_eliminar_prestamo").attr("id",prestamo_seleccionado.idprestamo_ficha_jugador_mc);
    $("#editar_pais_origen_club").val(prestamo_seleccionado.pais_origen_club_prestamo_ficha_jugador_mc);
    insertarClubPaisEditar(prestamo_seleccionado.pais_origen_club_prestamo_ficha_jugador_mc);
    $("#editar_origen_club").val(prestamo_seleccionado.origen_club_prestamo_ficha_jugador_mc);
    $("#editar_fecha_inicio_prestamo").val(prestamo_seleccionado.fecha_inicio_prestamo_prestamo_ficha_jugador_mc);
    $("#editar_fecha_fin_prestamo").val(prestamo_seleccionado.fecha_fin_prestamo_prestamo_ficha_jugador_mc);
    $("#editar_valor_prestamo").val(prestamo_seleccionado.valor_prestamo_prestamo_ficha_jugador_mc);
    $("#editar_opcion_compra").val(prestamo_seleccionado.opcion_compra_prestamo_ficha_jugador_mc);
    $("#editar_observacion_datos_deportivos").val(prestamo_seleccionado.observacion_datos_deportivos_prestamo_ficha_jugador_mc);
    $("#fecha_fin_contrato_prestamo_editar").val(prestamo_seleccionado.fecha_fin_contrato_prestamo);
    
}

function mostrarModalEnviarDatosEditarPrestamo(boton){
    $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar este prestamo?</h5><br><img src="../config/agregar_archivo.png">');
    $("#contendor_botones_modal").empty();
    $("#contendor_botones_modal").html(
        '<button type="button" class="btn btn-default boton_modal" onClick="cerrarModalFormularioEnviarDatos()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>'
        +'<button type="button" id="" class="btn btn-default boton_modal " onClick="enviarDatosEditarPrestamo('+boton.id+')" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> ');
    $("#modalFormulario").modal("show");
}

function mostrarModalEliminarPrestamo(boton){
    $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres Eliminar este prestamo?</h5><br><img src="../config/remover_archivo.png">');
    $("#contendor_botones_modal").empty();
    $("#contendor_botones_modal").html(
        '<button type="button" class="btn btn-default boton_modal" onClick="cerrarModalFormularioEnviarDatos()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>'
        +'<button type="button" id="" class="btn btn-default boton_modal " onClick="eliminarPrestamo('+boton.id+')" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> ');
    $("#modalFormulario").modal("show");
}


function eliminarPrestamo(id){
    // alert("eliminando ->"+id);
    $.ajax({
        url: "post/ficha_jugador_eliminar_prestamo_jugador.php",
        type: "post",
        data:[{name:"id",value:id}],
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            console.log(json);
            $("#contendor_botones_modal").empty();
            $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">Prestamo eliminado exitosamente</h5><br><img src="../config/remover_archivo.png">');
            setTimeout(()=>{
                cerrarModalFormularioEnviarDatos();
                mostrarDatosPrestamo("NULL");
                $("#tipo_prestamo_edita").val("NULL");
                consultarTipoPrestamosJugador($("#tipo_prestamo").val());
            },2000);
            
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
        }, timeout: 10000 // sets timeout to 3 seconds
    });
}

function enviarDatosEditarPrestamo(id){
    let datos_formulario=[];
    // editar_origen_club
    datos_formulario.push({name:"idprestamo_ficha_jugador_mc",value:id});
    datos_formulario.push({name:"condicion_prestamo_ficha_jugador_mc",value:$("#tipo_prestamo_edita").val()});
    datos_formulario.push({name:"pais_origen_club_prestamo_ficha_jugador_mc",value:$("#editar_pais_origen_club").val()});
    datos_formulario.push({name:"origen_club_prestamo_ficha_jugador_mc",value:$("#editar_origen_club").val()});
    datos_formulario.push({name:"fecha_inicio_prestamo_prestamo_ficha_jugador_mc",value:$("#editar_fecha_inicio_prestamo").val()});
    datos_formulario.push({name:"fecha_fin_prestamo_prestamo_ficha_jugador_mc",value:$("#editar_fecha_fin_prestamo").val()});
    datos_formulario.push({name:"valor_prestamo_prestamo_ficha_jugador_mc",value:$("#editar_valor_prestamo").val()});
    datos_formulario.push({name:"opcion_compra_prestamo_ficha_jugador_mc",value:$("#editar_opcion_compra").val()});
    datos_formulario.push({name:"observacion_datos_deportivos_prestamo_ficha_jugador_mc",value:$("#editar_observacion_datos_deportivos").val()});
    datos_formulario.push({name:"nombre_usuario_software",value:window.nombre_usuario_software});
    
    let expreion=/[0-9]/g;
    if(expreion.test($("#fecha_fin_contrato_prestamo_editar").val())){
        datos_formulario.push({name:"fecha_fin_contrato_prestamo_editar",value:$("#fecha_fin_contrato_prestamo_editar").val()});
    }
    else{
        datos_formulario.push({name:"fecha_fin_contrato_prestamo_editar",value:null});
    }
    console.table(datos_formulario);
    
    $.ajax({
        url: "post/ficha_jugador_editar_prestamo_jugador.php",
        type: "post",
        data:datos_formulario,
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            // console.log(json);
            $("#contendor_botones_modal").empty();
            $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">Prestamo actualizado exitosamente</h5><br><img src="../config/agregar_archivo.png">');
            setTimeout(()=>{
                cerrarModalFormularioEnviarDatos();
                mostrarDatosPrestamo("NULL");
                $("#tipo_prestamo_edita").val("NULL");
                consultarTipoPrestamosJugador($("#tipo_prestamo").val());
            },2000);
            
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
    consultarEquiposClub();
    setTimeout(() => {
        mostrar_al_cargar_pagina();
        consultarFichaJugadores();
    },2000);
    // console.clear();
    $(document).on('click', '.option', function(e) { //
        e.stopPropagation();
    });
    $('.c_objetivo_fisico li').click(function (e) { e.stopPropagation(); });
    $("html, body").animate({ scrollTop: 0 }, 600);


    $('#foto_registro').on('change', function(){
            // MOSTRAMOS LOS BOTONES PARA ACEPTAR.
            $('.boton_modal').show();
            
            // VERIFICAMOS QUE LA IMAGEN CUMPLA LOS REQUISITOS.
            if (subir_imagen() == 4) {
                // SE CARGA PARA EDITAR.
                var reader      = new FileReader();
                reader.onload   = function (event) {
                    $image_crop_jugador.croppie('bind', {
                        url: event.target.result
                    }).then(function(){
                        console.log('jQuery bind complete');
                    });
                }
                reader.readAsDataURL(this.files[0]);
                
                // MOSTRAMOS LA MODAL CON LA HERRAMIENTA.
                $('#uploadImageModal').modal('show');
            }
        });

    function subir_imagen () {
        var file        = document.forms['vista_formulario']['foto_registro'].files[0];
        var imagefile   = file.type;
        var imagesize   = file.size;
        var match       = ["image/jpeg", "image/png", "image/jpg"];
        
        if (!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))) {
            if (window.error_foto!=1){// 1 = copia la foto (AGREGAR)
                window.error_foto=1;
            } else {
                window.error_foto=3; // no se copia nada
            }
            $("#message_foto_registro").html("<span id='error_message' style='color: #f76b0e; font-size:10px;'><i class='icon-remove'></i><b>Error:</b> solo formato jpg o png</span>");
        } else if(imagesize > 4000000) {  
            if(error_foto!=1) {// 1 = copia la foto (AGREGAR)
                window.error_foto=1;
            } else {
                window.error_foto=3; // no se copia nada
            }
            $("#message_foto_registro").html("<span id='error_message' style='color: #f76b0e; font-size:10px;'><i class='icon-remove'></i><b>Error:</b> tamaño máximo 4[mb]</span>");
        } else {
            window.error_foto=4;
            $("#message_foto_registro").html("");
        }
        return window.error_foto;
    }
    
    $image_crop_jugador = $('#image_demo').croppie({
        enableExif: true,
        viewport: {
            width : 200,
            height: 200,
            type  :'square' // circle || square;
        },
        boundary: {
            width :300,
            height:300
        }
    });

    $('#crop_image_jugador').click(function(event){
        $('.boton_modal').hide();
        
        // MENSAJE DE ESTATUS.
        $('.texto_subir_foto').html("<br><h3 style='color:white;'><i class='icon-spinner icon-spin icon-large'></i> Subiendo imagen...</h3><br><br><br>");
        $('.texto_subir_foto').show();
        
        $image_crop_jugador.croppie('result', {
            type: 'canvas',
            size: 'viewport'
        }).then(function(response){
            // OCULTAMOS EL CUADRO DE RECORTE.
            $('.imagen_subir_foto').hide();
            
            // SE ENVIA POR AJAX.
            $.ajax({
                url : "subir_imagen3/upload.php",
                type: "POST",
                data: { "image": response },
                success: function (data) {
                    window.error_foto = 2;
                    
                    // MOSTRAMOS LA FOTO EN EL OBJETO IMG.
                    $('#foto_perfil_jugador').attr('src', '../config/cargando_logo_final.gif');
                    setTimeout(function () { $('#foto_perfil_jugador').attr('src', data+'?'+Math.random()); }, 500);
                    $('#nueva_img_jugador').prop('checked', 'true');
                    
                    // MOSTRAMOS NUEVAMENTE EL RECUADRO PARA NUEVAS MODIFICACIONES.
                    $('.imagen_subir_foto').show();
                    $('.texto_subir_foto').hide();
                    $('#uploadImageModal').modal('hide');
                },
                error: function(){
                    $('.texto_subir_foto').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
                    $('.boton_modal').show();
                }, timeout: 15000
            });
        })
    });

    // contrato_pdf
    $('#contrato_pdf').on('change', function(){
        // $("#imagen_pdf").attr("src","../images/pdf_visor.png");
        $("#checked_imagen").css("display","none");
        $("#imagen_pdf").attr("src","../config/cargando_logo_final.gif");
        setTimeout(() => {
            $("#imagen_pdf").attr("src","../images/pdf_icon.png");
            $("#checked_imagen").css("display","inline-block");
        },1000)
        
    });

    function renderizarCheckboxExamenesSolicitados(){
        const lista_prestamo=[
            {idPrestamo:99,prestamo:"Todos"},
            {idPrestamo:2,prestamo:"Préstamo en el club"},
            {idPrestamo:5,prestamo:"En el club"},
            {idPrestamo:1,prestamo:"Préstamo en otro club"}
        ] ; 
        const lis=lista_prestamo.map((prestamo)=>{
            /*en esta variable almacenamos el nombre de la funcion que ejecutara el checkbox al hacer onclick
            si la condicion es true significa que el checkbox tiene el metodo para activar o desactivar los demas checkbox (selecionarTodosAreaFiltro)
            en el filtro y asubes realiza una consulta al servidor y es caso que sea false solo tiene el metodo que ejecuta una consulta al servidor del cual es (buscarAtencionesDiariasFiltro)
            */
            if(prestamo.idPrestamo===99){
                return "<li><label class='option'><span class='label_s'>"+prestamo.prestamo+"</span> <input type='checkbox' id='prestamo_"+prestamo.idPrestamo+"' value='"+prestamo.idPrestamo+"' data-eliminar='0' onchange='chequearTodosLosPrestamos(this)' ></label></li>" ; 
            }
            else{
                return "<li><label class='option'><span class='label_s'>"+prestamo.prestamo+"</span> <input type='checkbox' id='prestamo_"+prestamo.idPrestamo+"' name='array_prestamos[]' value='"+prestamo.idPrestamo+"' data-eliminar='0' onchange='checkPrestamo()' ></label></li>" ; 
            }


            
        }) ; 
        if($("#tipo_prestamo").html()!=""){
            console.log("no esta basio") ; 
        }
        else{
            console.log("esta basio") ; 
            lis.map((lista)=>{
                $("#tipo_prestamo").html($("#tipo_prestamo").html()+lista) ; 
            }) ; 
        }
    }
    renderizarCheckboxExamenesSolicitados();

    function chequearTodosLosPrestamos($check){
        let $checkBoxPrestamos=document.querySelectorAll("[name='array_prestamos[]']");
        if($check.checked){
            for(let $checkBox of $checkBoxPrestamos){
                $checkBox.checked=true;
            }
            document.getElementById("texto_boton_filtro_prestamo").textContent="Todos";
        }
        else{
            for(let $checkBox of $checkBoxPrestamos){
                $checkBox.checked=false;
            }
            document.getElementById("texto_boton_filtro_prestamo").textContent="Seleccione un tipo de préstamo";
        }
        consultarFichaJugadores();
    }

    function checkPrestamo(){
        const lista_prestamo=[
            {idPrestamo:99,prestamo:"Todos"},
            {idPrestamo:2,prestamo:"Préstamo en el club"},
            {idPrestamo:5,prestamo:"En el club"},
            {idPrestamo:1,prestamo:"Préstamo en otro club"}
        ] ; 
        let $checkBoxPrestamos=document.querySelectorAll("[name='array_prestamos[]']:checked");
        if($checkBoxPrestamos.length===3){
            $("#prestamo_99").prop("checked",true);
            // chequearTodosLosPrestamos();
            document.getElementById("texto_boton_filtro_prestamo").textContent="Todos";
        }
        else if($checkBoxPrestamos.length===1){
            $("#prestamo_99").prop("checked",false);
            //     ($checkBoxPrestamos[0].value)
            let $padre=document.getElementById("prestamo_"+$checkBoxPrestamos[0].value).parentElement;
            document.getElementById("texto_boton_filtro_prestamo").textContent=$padre.children[0].textContent;
        }
        else if($checkBoxPrestamos.length>1){
            $("#prestamo_99").prop("checked",false);
            // chequearTodosLosPrestamos();
            document.getElementById("texto_boton_filtro_prestamo").textContent=$checkBoxPrestamos.length+" elementos seleccionados";
        }
        else{
            $("#prestamo_99").prop("checked",false);
            // chequearTodosLosPrestamos();
            document.getElementById("texto_boton_filtro_prestamo").textContent="Seleccione un tipo de préstamo";
        }
        consultarFichaJugadores();
    }




</script>
