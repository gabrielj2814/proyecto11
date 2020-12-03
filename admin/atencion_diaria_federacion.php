<?PHP
include('../config/datos.php');
session_start();
if(!(isset($_SESSION["nombre_usuario_software"]))){
    session_destroy();
    header('Location: ../index.php?cerrar_sesion=1');
}
else{
    $menu_actual="atencion";
    $submenu_actual="atencion_diaria_federacion";
    $seccion_comentarios = $comentarios['atencion_diaria_federacion'];//mis cuotas
    $demo_seccion = $demo['atencion_federacion'];
    $nombre_pestana_navegador='Atención';

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
        <title><?php echo $nombre_pestana_navegador;?> | Diaria (federación)</title>

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
        margin:0px;
        border-bottom-left-radius:2px;
        border-top-left-radius:2px;
        margin-left: 0px;
        margin-right: 0px;
        width: 90px;
        margin-top:0px;
        background-color:<?php echo $color_fondo; ?>;
        font-size: 10px;
        margin-bottom:0px;
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
                        .tabla_detalle_atencion_diaria{
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
                            <i class="icon-truck"></i> Atención
                        </a> 
                        <a class="current">
                            Diaria
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
                <div style="margin-top: 0px; margin-bottom: 60px;">
                
<!--------------------------------  MODAL INFORME PDF FIN-------------------------------------------->
<!--------------------------------  MODAL VER JUGADOR INICIO-------------------------------------------->
                    <div id="modalVerJugador" class="modal hide contenedor_modal_jugador" >
                        <div class="contenedor_foto_jugador" id="contenedor_foto_jugador">
                            <!-- <img src="" alt=""> -->
                        </div>
                        <div class="modal-header encabezado_modal" style="background-color: #5fbfe4;">
                            <div style="float:left;width:120px;height: 100%;color:#fff;box-sizing: border-box;padding-top: 19px;">ÁREA <span style="font-weight: bold">MÉDICA</span></div>
                            <div style="float:right;width:134px;height: 100%;display:flex;flex-direction:row;">
                                <div style="width:50px;margin-right: 10px;height: 100%;box-sizing: border-box;">
                                    <img style="width:100%;height: 100%;box-sizing: border-box;" src="../config/logo_equipo.png" >
                                </div>
                                <div style="width:40px;box-sizing: border-box;color:#fff;font-weight: bold;">
                                    <div>FOTBOL</div>
                                    <div>FORMATIVO</div>
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
                        <div style="margin-bottom:20px;" class="tabla_detalle_atencion_diaria" id="tabla_detalle_atencion_diaria"></div>
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
                    <!--    MODAL INICIO  -->
                    <div id="modalAtencionDiariaEliminar" class="modal hide" style="border-radius:10px;">
                        <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
                        </div>
                        <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
                        <center>
                                <br>
                                <div id="mensaje_eliminar_atencion_diaria">
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
                    <!--    MODAL FIN     -->
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

                    <div class="row-fluid" id="component_atencion_diaria_inicio" style="padding-left: 20px;padding-right: 21px;box-sizing: border-box;">
                        <div id="cuadro_listado_atencion_diaria" class="row-fluid" style="margin-top: -10px; color: black; font-family: Arial, Helvetica, sans-serif;">
                            <table style="color:black; font-family: Arial, Helvetica, sans-serif; margin: 0px auto 10px;">
                                <tr class="sin_fondo" >
                                    <td style="padding:12px; padding-top:15px;"><img src="../config/logo_equipo.png" style="height: 100px; margin-top:5px;"></td>
                                    <td>
                                        <center>
                                            <h3 class="titulo_principal" style="color:#595959;">MÓDULO DE ATENCIÓN</h3>
                                            <div style="width:auto;margin: 0px;font-weight: bold;border-top:2px solid #404040;border-bottom:2px solid #404040;color: #595959;">OHIGGINS DE RANCAGUA</div>
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
                                    <form id="filtro_tabla_informe">
                                        
                                        <div style="background-color: lightblue; width: 90%; margin: auto;">

                                            <div class="span3" style="display: flex">
                                                <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040">
                                                    <div>
                                                        <p class="ellipsis-text" style="font-weight: normal;">Fecha inicio</p>
                                                    </div>
                                                </a>
                                                <input type="text" readonly  style="width:50%; height: 18px;background:#fff;" class="grey-input date_fechaNacimiento fecha_inicio" id="fecha_inicio" name="fecha_inicio" onchange="buscarJugador()" />                   
                                            </div>

                                            <div class="span3" style="display: flex;">
                                                <a class="btn btn-md btn-primary green-a" style="width: 50%; height: 20px;background:#404040">
                                                    <div>
                                                        <p class="ellipsis-text" style="font-weight: normal;">Fecha fin</p>
                                                    </div>
                                                </a>
                                                <input type="text" readonly  style="width: 50%; height: 18px;background:#fff;" class="grey-input date_fechaNacimiento  fecha_final" id="fecha_final" name="fecha_final" onchange="buscarJugador()" />
                                            </div> 
                                            <div class="span3" style="display: flex;">
                                                <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#404040"><div><p class="ellipsis-text" style="font-weight: normal;">Serie</p></div></a>
                                                <div class="btn-group c_objetivo_fisico " style="width: 50%;">
                                                    <button id="boton_serie" type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #404040; background-color: #fff;">
                                                        <p id="serie" class="titulo_multi ellipsis-text">
                                                            <span id="texto_boton_filtro_serie">Seleccione una serie</span>
                                                        </p> 
                                                        <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span>
                                                    </button>
                                                    <ul id="tipo_serie" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                                                </div>                    
                                            </div>  
                                            <div class="span3" style="display: flex;">
                                                <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#404040"><div><p class="ellipsis-text" style="font-weight: normal;">Tipo Atención</p></div></a>
                                                <div class="btn-group c_objetivo_fisico " style="width: 50%;">
                                                    <button id="boton_tipo_atencion" type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #404040; background-color: #fff;">
                                                        <p id="tipo_atencion" class="titulo_multi ellipsis-text">
                                                            <span id="texto_boton_filtro_tipo_atencion">Seleccione un Tipo de Atención</span>
                                                        </p> 
                                                        <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span>
                                                    </button>
                                                    <ul id="tipo_tipo_atencion" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                                                </div>                    
                                            </div>                                                                                    

                                        </div>

                                    </form>

                            </div>
                        </div>
                        <div style="display:block;width:100%;">
                            <div style="width:20%;margin:0px 40%;">
                                <input type="text" style="width:100%;text-align:center;border: 2px solid #404040" name="campo_buscar_jugador" id="campo_buscar_jugador" onKeyup="buscarJugador()" placeholder="Buscar Jugador">
                            </div>
                            
                        </div>
                        <div class="row-fluid cuadro_buscar_buscar" style="margin: 0px; padding:0px; margin-top:30px;">
                            <div class="row-fluid" style="margin-top:0px;">
                                <button style="margin-bottom:10px; margin-top: 0px; float:right;" class="boton_informe_semanal" id="boton_agregar_informe" onClick="mostrarModalFormulario()"><b style="font-size:10px;"><i class="icon-plus"></i> Agregar informe</b></button>

                                <div class="span12" style="margin: 0px;">
                                    <table style="border: 0px solid #8f8f8f; width:100%;" id="tabla_ver_informes">
                                        <thead>
                                            <tr style="background-color:#555; color:white;">
                                                <!-- <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;font-size: 10px;"><center>#</center></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="Fecha atención" style="width:105px;text-align: left;font-size: 10px;">FECHA ATENCION</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="Mes" style="width:50px;text-align:left;font-size: 10px;">MES</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="jugador atendido" style="width:150px;text-align:left;font-size: 10px;">JUGADOR ATENDIDO</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="rut" style="width:75px;text-align:left;font-size: 10px;">RUT</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="serie" style="width:55px;text-align:left;font-size: 10px;">SERIE</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="fecha incidente" style="width:105px;text-align:left;font-size: 10px;">FECHA INCIDENTE</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="tipo de atención" style="width:90px;text-align:left;font-size: 10px;">TIPO ATENCIÓN</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="seguro" style="width:60px;text-align:left;font-size: 10px;">SEGURO</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="jugador atendido" style="width:90px;text-align:left;font-size: 10px;">ALTE ENT.SERIE</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="fecha de alta" style="width:80px;text-align:left;font-size: 10px;">FECHA ALTA</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:0px; width:30px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:0px; width:30px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:5px; width:30px;"></th> -->
                                                <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px; min-width:25px;font-size: 10px;"><center>#</center></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="Fecha atención" style="width:105px;text-align: left;font-size: 10px;">FECHA ATENCION</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="Mes" style="width:50px;text-align:left;font-size: 10px;">MES</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="jugador atendido" style="width:116px;text-align:left;font-size: 10px;">JUGADOR ATENDIDO</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="serie" style="width:55px;text-align:left;font-size: 10px;">SERIE</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="fecha incidente" style="width:105px;text-align:left;font-size: 10px;">FECHA INCIDENTE</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;max-width:86px">
                                                <div class="tip-top" data-original-title="tipo de atención" style="width:86px;text-align:left;font-size: 10px;">TIPO ATENCIÓN</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="seguro" style="width:60px;text-align:left;font-size: 10px;">SEGURO</div>
                                                </th>
                                                <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="seguro" style="width:90px;text-align:left;font-size: 10px;">ESTADO</div>
                                                </th>
                                                <!-- <th scope="col" style="cursor:pointer; padding:0px;">
                                                <div class="tip-top" data-original-title="fecha de alta" style="width:80px;text-align:left;font-size: 10px;">FECHA ALTA</div>
                                                </th> -->
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:0px; width:30px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:0px; width:30px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:5px; width:30px;"></th>
                                            </tr>
                                        </thead>
                                        <tbody id="contenido_tabla">
                                            <!--  AQUI SE INSERTARAN CON JAVASCRIPT -->
                                            <!-- <tr class="sin_fondo" ><td colspan="14" ><center><h5 style="color:#555555;margin-top:10px;margin-bottom:10px;"><i class="icon-file-alt"></i> Sin atenciones diarias</h5></center></td></tr> -->
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
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;"></th>
                                                <th scope="col" style="cursor:pointer; padding:0px;  border-bottom-right-radius:5px;"></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- <input type="button" value="generar pdf lista" onclick="descargarListaPDF()"> -->
                        <div class="row-fluid">
                            <div class="span12"  style=" margin-top: 20px;">
                                <center>
                                    <button type="button"  ng-disabled="" class="boton_guardar_informe" style="font-size:10px;" onClick="descargarListaPDF();" id="boton_generar_pdf_list">DESCARGAR REPORTE</button>
                                </center>   
                            </div>
                        </div>
                    </div>

                    <div id="component_atencion_diaria_formulario" style="width: 100%; height: 100%; display:none;">   
                        <div class="row-fluid" style="margin-top:30px;">
                            <button class="boton_volver" onClick="botonVolver();" style="float:left;margin-left:10px"><i class="icon-arrow-left"></i> volver</button>
                        </div>
                        <div style="box-sizing: border-box;border:0;width:35%;height:100px;margin-left:auto;margin-right:auto;margin-bottom:15px;">
                            <img style="box-sizing: border-box;border:0;float:left;width:25%;height:100px;" src="../config/logo_equipo.png" alt="logo equipo"/>
                            <div style="box-sizing: border-box;border:0;float:left;width:75%;height:100px;padding-top:15px;color:#404040;text-align:center;" >
                                <h4 >MODULO DE AREA MÉDICA</h4>
                                <div style="font-weight: 800;">Atenciones diarias <span id="text_serie_quipo_titulo_formulario"></span></div>
                            </div>
                        </div>
                        
                        <div class="" style="background-color: #eeeeee;width: 100%; height: 100%; max-height: 100%; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
                            <br>
                            <div style="width: 100%;margin-left: 5.5%;" > 
                                <form id="filtro_modal_formulario" >
                                    <div style="background-color: lightblue; width: 100%; margin: auto;">
                                        <div class="span3" style="display: flex;flex-wrap:wrap">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;">Fecha Atención</div>
                                            <input  readonly style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;background-color:#fff;" type="text" class="date_fechaNacimiento fecha_inicio" id="fecha_atencion" name="fecha_atencion" onchange=""/>
                                        </div>
                                    </div>
                                    
                                    <div style="background-color: lightblue; width: 100%; margin: auto;">
                                        <div class="span3" style="display: flex;flex-wrap:wrap;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;width:100%;">Serie</div>
                                            <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" id="serie_jugador" name="serie_jugador" onchange="consultarJugadoreXSeries(this.value)">
                                                
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div style="background-color: lightblue; width: 100%; margin: auto;" id="contenedor_jugador">

                                        <div class="span3" style="display: flex;flex-wrap:wrap;">
                                            <div style="font-size: 12px;font-weight: 900;color: #404040;width:100%;">Jugador</div>
                                            <select  style="box-sizing:border-box;width:100%;height:30px;border:2px solid #d2d2d2;" id="jugador" name="jugador" onchange="mostrarJugador(this.value)">
                                                
                                            </select>
                                             
                                        </div>
                                    </div>
                                </form>
                                
                            </div>
                            <br>
                            <br>
                            <hr>
                            <!--    MODAL INICIO  -->
                            <div id="modalAtencionDiariaNuevo" class="modal hide" style="border-radius:10px;">
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
                            <form id="formulario_modal_atencion_new" >
                                <div style="display:flex;flex-direction:row;flex-wrap:wrap;width:100%;height: 370px;/*background:green*/background:#eee;margin-bottom:15px;">
                                    <div style="width:20%;background:#eee;"><!--contendor foto-->
                                        <div style="width:100%;height:100%;display:flex;flex-direction:column;flex-wrap:wrap;justify-content:felx-start;align-items:center;">
                                            <div id="contendor_imagen_jugador" style="overflow: hidden;width:140px;height:140px;border-radius:100px;background:#eee;border: 2px solid #cdcdcd;"></div>
                                            <div style="font-size: 1.2em;margin-top: 10px;width:80%;background:#eee;text-align:center;font-weight:bold;color:#404040;">
                                                <span id="nombre_jugador_formulario_new" style="text-transform: Capitalize">Gabriel Valera</span><br><!--nombre jugador-->
                                                <!-- <span id="serie_jugador_formulario_new">SUB-20</span> -->
                                            </div>

                                            <div  id="contendor_serie_jugador" style="font-size: 1.2em;margin-top: 10px;width:80%;background:#eee;font-weight:bold;color:#404040;">
                                                <img src="../config/equipo.png" alt="logo equipo serie" style="box-sizing:borde-box;border:0;width: 20px;height: 20px;"/><span style="color:#808080;font-weight:bold;font-size: 10px;margin-left: 10px;">Serie: <span id="texto_serie">xxxx</span></span>
                                            </div>
                                            <div  id="contendor_posicion_jugador" style="font-size: 1.2em;margin-top: 10px;width:80%;background:#eee;font-weight:bold;color:#404040;">
                                                <img src="../config/cancha.png" alt="cancha posicion" style="box-sizing:borde-box;border:0;width: 20px;height: 20px;"/><span style="color:#808080;font-weight:bold;font-size: 10px;margin-left: 10px;">Posición: <span id="texto_posicion_cancha">xxxx</span></span>
                                            </div>
                                            <div  id="contendor_fecha_nacimiento_jugador" style="font-size: 1.2em;margin-top: 10px;width:80%;background:#eee;font-weight:bold;color:#404040;">
                                                <img src="../config/cumpleaño.png" alt="torta cumpleaño" style="box-sizing:borde-box;border:0;width: 20px;height: 20px;"/><span style="color:#808080;font-weight:bold;font-size: 10px;margin-left: 10px;">Fecha Nac.: <span id="texto_fecha_cumple">xxxx</span></span>
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
<script type="text/javascript">
var jugadoresPorSerie=[];




function botonVolver(){
    $("#component_atencion_diaria_formulario").hide();
    $("#component_atencion_diaria_inicio").show();
    fechaInicioHoy();
    fechaFinalHoy();
}


var html_tipo_atencion='\
<div style="margin-right:2.5%;width:29.96%;display:flex;margin-bottom:10px">\
        <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040">\
            <div>\
                <p class="ellipsis-text" style="font-weight: normal;">*Tipo Atención</p>\
            </div>\
        </a>\
        <select style="width:50%; height: 30px;background:#fff;border:2px solid" class="" id="tipo_tipo_atencion_formulario" name="tipo_tipo_atencion_formulario" onchange="mostrarTipoDeFormulario(this.value)">\
        </select>\
    </div>';

var frt="'frt'";
var bck="'bck'";

var html_atencion_nuevo_incidente={
    parte_1:'\
    <div style="margin-right:3.5%;width:29.96%;display:flex;margin-bottom:10px">\
        <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#404040;height:22px;">\
            <div>\
                <p class="ellipsis-text" style="font-weight: normal;">*Fecha Incidente</p>\
            </div>\
        </a>\
        <input type="text" readonly  style="width:50%;background:#fff;margin:0" class="grey-input date_fechaNacimiento " id="fecha_incidente" name="fecha_incidente" />\
    </div>\
    <div style="margin-right:0px;width:29.96%;display:flex;">\
        <a class="btn btn-md btn-primary green-a" style="width: 46%;background:#404040;height:20px;">\
            <div>\
                <p class="ellipsis-text" style="font-weight: normal;">*Contexto Incidente</p>\
            </div>\
        </a>\
        <select style="width:43%;background:#fff;border:2px solid;margin:0" class="" id="contexto_incidente_formulario" name="contexto_incidente_formulario" onchange="mostrarCampoOtroContextoIncidente(this.value)"></select>\
    </div>\
    <div style="width:95.8%;display:none;margin-bottom:15px" id="campo_otro_contexto_incidente">\
        <a class="btn btn-md btn-primary green-a" style="width: 28%;background:#404040">\
            <div>\
                <p class="ellipsis-text" style="font-weight: normal;">*¿Indique cual fue el incidente?</p>\
            </div>\
        </a>\
        <input type="text" style="width:67%;background:#fff;text-align:left;margin:0" class="grey-input " id="indique_incidente" name="indique_incidente" onchange="validarFormulario()" />\
    </div>\
    <div style="margin-right:0px;width:95.8%;display:flex;margin-bottom:15px">\
        <a class="btn btn-md btn-primary green-a" style="width: 14%;background:#404040">\
            <div>\
                <p class="ellipsis-text" style="font-weight: normal;">*Diagnostico</p>\
            </div>\
        </a>\
        <input type="text" style="width:81%;background:#fff;text-align:left;margin:0" class="grey-input " id="diagnostico" name="diagnostico" onchange="validarFormulario()" />\
    </div>\
    <div style="margin-right:0px;width:95.8%;display:flex;margin-bottom:15px">\
        <a class="btn btn-md btn-primary green-a" style="width: 14%;background:#404040">\
            <div style="margin-top:10%;">\
                <p class="ellipsis-text" style="font-weight: normal;">Anamnesis</p>\
            </div>\
        </a>\
        <textarea type="text" style="width:81%;background:#fff;text-align:left;resize:none" class="grey-input " id="anamnesis" name="anamnesis" onKeyup="validarFormulario()" ></textarea>\
    </div>\
    <div style="margin-right:0px;width:95.8%;display:flex;flex-wrap:wrap;margin-bottom:15px">\
        <div style="font-size: 12px;font-weight: 900;color: #404040;width:100%;">Examen Fisico</div>\
        <textarea type="text" style="width:100%;height: 102px;background:#fff;text-align:left;border:2px solid #d2d2d2;resize:none" class=" " id="examen_fisico" name="examen_fisico" ></textarea>\
    </div>\
    <div style="width:30%;display:flex;margin-right:2.5%;;margin-bottom:10px">\
        <a class="btn btn-md btn-primary green-a" style="width: 44%;background:#df4f4f;border: 2px solid #555;padding-bottom: 2px;">\
            <div>\
                <p class="ellipsis-text" style="font-weight: normal;">Derivado a seguro</p>\
            </div>\
        </a>\
        <select style="width:45%;background:#fff;border:2px solid;margin:0" class="" id="derivado_seguro" name="derivado_seguro" onchange="validarFormulario()">\
            <option id="option_derivado_seguro_from_new_00" value="00" >Seleccione</option> \
            <option id="option_derivado_seguro_from_new_1" value="1" >SI</option>\
            <option id="option_derivado_seguro_from_new_0" value="0" >NO</option>\
        </select>\
    </div>\
    <div style="width:30%;display:flex;margin-right:0px;margin-bottom:10px">\
        <a class="btn btn-md btn-primary green-a" style="width: 51%;background:#df4f4f;border: 2px solid #555;padding-bottom: 2px;"><div><p class="ellipsis-text" style="font-weight: normal;">Examenes Solicitados</p></div></a>\
        <div class="btn-group c_objetivo_fisico " style="width: 49%;">\
            <button id="boton_examenes_solicitados" type="button" class="btn dropdown-toggle" data-toggle="dropdown" onclick="renderizarCheckboxExamenesSolicitados()" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #404040; background-color: #fff;">\
                <p id="examenes_solicitados" class="titulo_multi ellipsis-text">\
                    <span id="texto_boton_examenes_solicitados">Seleccione un Examen</span>\
                </p> \
                <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span>\
            </button>\
            <ul id="lista_examenes_solicitados" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>\
        </div>                    \
    </div>\
            </div>\
        </div>',
    parte_2:'\
    <div style="width:100%;margin-top:10px;">\
        <div class="tarjeta_cuerpo_leciones" style="width:31.6%;margin-left:1.2%;height: 350px;">\
            <div class="cabezera_tarjeta cabezera_tarjeta_gris">\
                <span>*Zonas Afectadas</span>\
            </div>\
            <div class="cuerpo_tarjerta" style="overflow: auto;overflow-x: hidden;    height: 325px;">\
            \
            \
            \
            \
            <div id="botones_zonas" class="width:100%;" style="margin-top: 0px; margin-bottom: 10px;display:block;">\
                                        \
            </div>\
                <div class="hombre_front" style="display: inline-block;margin-left:30px;margin-top: 10px;">\
                                            <svg height="210px" viewBox="0 0 698.40479 1316.3297">\
                                                <image xlink:href="img/cuerpo_masculino_f1.png" src="img/cuerpo_masculino_f1.png" width="695.29614" height="1315.5781" preserveAspectRatio="none" id="image947" x="0.97671771" y="-0.1400058" />\
                                                <path onClick="sector('+window.frt+',1);" class="frt" id="frt_1" d="m 403.74101,51.5 c -1.666,-32 -36.334,-51 -55.334,-51 -30.833,0 -50.167,31.5 -53.167,44.5 -1.915,8.295 -2.833,23.5 -2.5,28.167 0.333,4.667 1,12.333 0.667,16.167 2.04,7.695 6.667,23 6.667,33 0.667,5.167 1.167,12.5 3.333,18.833 3,4 22.5,23.333 44.167,23.333 21.667,0 36.5,-8.667 45.708,-23 2.625,-5.625 5,-15.25 4.75,-18.625 -0.708,-5.125 4.708,-28.042 5.709,-32.708 0.667,-7.333 1.666,-6.667 0,-38.667 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path class="frt" d="m 285.24001,87.5 c -4,4 -1.833,17 -0.833,20.667 1,3.667 5.833,14.667 7.167,15.833 1.334,1.166 5.167,4.833 8.5,-1.667 0,-10 -4.627,-25.305 -6.667,-33 -1,-1.833 -4.167,-5.833 -8.167,-1.833 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 398.03201,122.875 c 3.75,6.375 8.875,3.25 10,-1.75 1.125,-5 7.625,-7.875 6.75,-23.625 -0.875,-15.75 -8.041,-11.667 -11.041,-7.333 -1.001,4.666 -6.417,27.583 -5.709,32.708 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 325.90701,83.75 c 8.561,0 15.5,-4.197 15.5,-9.375 0,-5.178 -6.939,-9.375 -15.5,-9.375 -9.75,0 -15.5,4.197 -15.5,9.375 0,5.178 6.939,9.375 15.5,9.375 z" cursor="pointer"inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 373.90701,83.75 c 8.561,0 15.5,-4.197 15.5,-9.375 0,-5.178 -5.5,-9.375 -15.5,-9.375 -8.561,0 -15.5,4.197 -15.5,9.375 0,5.178 6.939,9.375 15.5,9.375 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 340.78201,86.75 c -0.375,3.125 -5,6.375 -5.625,13.125 -0.438,4.731 6.25,7.5 10.25,6.5 5,2.625 6.75,0.625 9.875,-0.625 5.75,0.875 8,-3.25 8,-7.75 0,-4.5 -4.375,-6.75 -4.875,-12.25 -0.5,-5.5 -3.375,-7.625 -3.125,-13.5 0.25,-5.875 -2.375,-9.875 -6.086,-9.875 -5.21,0 -6.289,7.875 -5.914,10.625 0.375,2.75 -2.125,10.625 -2.5,13.75 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 359.65701,114.75 c -2.256,-2.723 -6.231,-1.652 -7.875,-0.75 -0.882,0.484 -3.5,0.875 -5.125,-0.375 -1.625,-1.25 -6.125,-0.125 -7.375,1.625 -1.25,1.75 -11.75,5.125 -12.625,8.125 -0.875,3 8.625,3.25 11,4.125 2.375,0.875 4.5,3.75 13.125,3.75 8.625,0 10.966,-2.787 13.25,-3.25 2.284,-0.463 8.125,-1.125 8.5,-3.5 0.375,-2.375 -9.25,-5.375 -12.875,-9.75 z"cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path class="frt" d="m 293.07401,225.667 c 15.667,-0.833 41.167,-2.166 45.333,3.667 4.166,5.833 15.834,6 19.667,0 3.833,-6 38.028,-6.245 50.833,-4.333 4.95,0.739 9.833,0.81 14.438,0.363 10.976,-1.066 20.373,-5.078 25.342,-10.017 -8.889,0.081 -18.524,-5.195 -31.03,-10.721 -16.125,-7.126 -24.625,-15.876 -25.25,-18.626 -0.625,-2.75 0.125,-34.5 0.875,-44.5 -9.208,14.333 -24.041,23 -45.708,23 -21.667,0 -41.167,-19.333 -44.167,-23.333 2.167,6.333 1.5,29.833 0.75,45.333 -8.5,15.25 -40,24 -48,27.5 2.042,1.655 10.695,6.598 20.857,9.508 5.186,1.485 10.766,2.44 16.06,2.159 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.frt+',2);" class="frt" id="frt_2" d="m 224.88701,281.816 c 6.094,-31.882 44.123,-54.828 52.127,-58.308 -10.162,-2.91 -18.816,-7.853 -20.857,-9.508 -8,3.5 -15.5,2 -26.75,4.25 -11.25,2.25 -41.5,13.25 -53.5,37.75 -12,24.5 -9.5,57 -9.25,65.75 0.034,1.202 0.012,2.258 -0.058,3.222 12.866,-15.389 43.708,-19.127 58.288,-43.156 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.frt+',3);" class="frt" id="frt_3" d="m 471.90701,276.5 c 13.5,30.001 46.022,30.211 58.595,48.439 -0.768,-3.438 -1.004,-7.947 -0.345,-14.439 1.931,-19.007 -4.875,-52.125 -17.875,-68.5 -13,-16.375 -53.125,-26.75 -63.595,-26.654 -4.969,4.939 -14.366,8.951 -25.342,10.017 10.812,2.887 46.544,30.388 48.562,51.137 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',4);" class="frt" id="frt_4" d="m 471.90701,276.5 c -2.018,-20.749 -37.75,-48.25 -48.562,-51.137 -4.605,0.447 -9.488,0.376 -14.438,-0.363 -12.805,-1.911 -47,-1.667 -50.833,4.333 -3.833,6 -15.5,5.833 -19.667,0 -4.167,-5.833 -29.667,-4.5 -45.333,-3.667 -5.294,0.281 -10.873,-0.674 -16.059,-2.159 -8.004,3.48 -46.033,26.426 -52.127,58.308 -0.459,2.402 -0.744,4.852 -0.814,7.351 -1,35.667 0.003,72.11 -0.165,85.722 0.383,-0.096 9.666,25.111 12.166,30.778 2.5,5.667 5.082,17.834 8.582,24.584 8.25,7.75 46.75,25.25 73.25,18.25 26.5,-7 36.5,-6.244 65,0.128 28.5,6.372 52.668,-2.794 73.084,-27.211 1.25,-3.25 4.75,-11.75 5.333,-15 0.583,-3.25 2.667,-6.999 4.084,-9.749 1.417,-2.75 7.455,-21.675 8.005,-21.176 0.672,-13.342 -0.339,-86.991 -1.506,-98.992 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.frt+',5);" class="frt" id="frt_5" d="m 224.07401,289.167 c 0.07,-2.499 0.354,-4.949 0.814,-7.351 -14.58,24.029 -45.423,27.768 -58.288,43.156 -0.437,6.049 -2.914,8.093 -7.442,14.778 -5.251,7.75 -15.251,39.25 -18.751,51.25 -0.507,1.738 -0.896,3.229 -1.221,4.551 -1.413,17.735 10.718,25.876 24.421,31.618 11.394,4.774 24.501,8.306 33.45,1.543 0.711,-1.544 1.634,-3.368 2.85,-5.712 3.5,-6.75 23.363,-47.953 24.001,-48.111 0.168,-13.612 -0.834,-50.055 0.166,-85.722 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.frt+',6);" class="frt" id="frt_6" d="m 534.98001,427.169 c 14.284,-5.985 25.869,-14.57 23.177,-33.919 -1.625,-11.25 -17.875,-51.25 -22,-57.25 -2.265,-3.294 -4.53,-6.027 -5.655,-11.061 -12.573,-18.228 -45.095,-18.438 -58.595,-48.439 1.167,12.001 2.178,85.65 1.506,98.992 0.108,0.098 20.827,42.675 23.494,48.175 8.512,13.114 24.509,9.186 38.073,3.502 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',7);" class="frt" id="frt_7" d="m 107.86901,463.177 c -2.96,8.722 -5.318,17.111 -6.462,23.823 -2.027999,11.896 -8.778999,39.212 -16.706999,62.487 -1.735,5.094 -3.563,9.992 -5.337,14.495 1.722,9.015 32.507999,23.476 42.631999,18.606 1.457,-2.714 2.764,-5.01 3.745,-6.587 4.667,-7.5 11.917,-19.251 24.917,-35.251 13,-16 25.5,-39.75 32,-55.75 0.255,-0.629 0.508,-1.285 0.76,-1.953 -7.052,-15.175 -59.665,-48.114 -75.548,-19.87 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',8);" class="frt" id="frt_8" d="m 618.24001,562.561 c -2.89,-7.644 -5.897,-16.096 -8.083,-21.561 -4,-10 -12.75,-51 -18.75,-74.25 -14.5,-37.25 -78.5,6.75 -77,19.75 7,18 35.75,60.25 40.375,65.875 4.625,5.625 16.49,23.007 19.5,28.25 6.539,10.154 45.792,-8.458 43.958,-18.064 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.frt+',9);" class="frt" id="frt_9" d="m 382.90701,448.628 c -28.5,-6.372 -38.5,-7.128 -65,-0.128 -26.5,7 -65,-10.5 -73.25,-18.25 3.5,6.75 2,12 3.75,17.75 1.75,5.75 5,21.334 0.5,41.501 -4.5,20.167 -1.667,35.666 -0.5,40.166 0.785,3.029 2.326,5.001 1.419,8.813 11.581,11.52 30.415,34.52 100.498,34.52 70.083,0 86.417,-20.498 98.75,-33.499 -1.666,-4.5 -0.501,-12 2.499,-21.167 3,-9.167 -3.499,-44.667 -3.833,-52.833 -0.334,-8.166 2.501,-21.5 2.751,-27.584 0.25,-6.084 4.25,-13.25 5.5,-16.5 -20.416,24.417 -44.584,33.583 -73.084,27.211 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.frt+',10);" class="frt" id="frt_10" d="m 79.363011,563.982 c -5.112,12.975 -9.774,22.651 -10.456,24.143 -0.886,1.939 -1.456,3.337 -2.977,4.62 9.057,0.416 28.988,8.686 43.014999,19.44 2.127,-7.809 8.37,-20.88 13.05,-29.598 -10.124,4.871 -40.909999,-9.59 -42.631999,-18.605 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',11);" class="frt" id="frt_11" d="m 634.15701,592.75 c -8.5,-4 -5.75,-8.25 -9.5,-15 -1.7,-3.061 -4.019,-8.847 -6.417,-15.189 1.834,9.606 -37.419,28.219 -43.958,18.064 1.544,2.689 5.188,10.48 8.506,17.668 3.15,6.824 6.007,13.104 6.494,13.957 14.875,-11.916 36.458,-20.084 44.875,-19.5 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',12);" class="frt" id="frt_12" d="m 108.24001,615.667 c 0.096,-0.975 0.344,-2.156 0.705,-3.481 -14.026999,-10.755 -33.957999,-19.024 -43.014999,-19.44 -1.911,1.612 -5.326,3.042 -12.773,5.13 -1.854,0.52 -3.833,1.291 -5.874,2.231 -12.688,5.84 -27.892,18.435 -31.876,21.019 -4.625,3 -7.75,8.375 -11.875,10.5 -4.12500004,2.125 -4.12500004,8.625 0,10.5 4.125,1.875 9.625,0.125 13,-1.5 3.375,-1.625 9.042,-8.457 15.5,-10.5 3.788,-1.198 7.625,-1.5 7.625,0.125 0,1.625 -8.5,22.375 -9.125,25.5 -0.625,3.125 -3.875,13.875 -5.875,21.125 -2,7.25 -5.5,21.25 -6.75,29.25 -1.25,8 0.875,11.75 5.125,12.625 4.25,0.875 7.875,-7.625 8.646,-10.625 0.771,-3 2.854,-12.75 3.979,-15.5 1.125,-2.75 6.625,-18.75 8,-22 1.375,-3.25 2.375,-8.625 4.375,-7.75 2,0.875 -0.375,5.875 -1.75,9.75 -1.375,3.875 -7.125,24.749 -7.875,28.624 -0.75,3.875 -5,19.75 -5.25,22.5 -0.25,2.75 -1.875,8.75 2.75,10.5 4.625,1.75 7.75,-1.875 9.5,-5.625 1.75,-3.75 5.375,-17.625 7.375,-26.125 2,-8.5 5.75,-19.5 7.125,-24 1.375,-4.5 2.125,-8 3.875,-7.875 1.75,0.125 1.5,2.5 0.75,4.75 -0.75,2.25 -6.125,20.625 -7.125,25.625 -1,5 -4.25,16.125 -5.375,20.375 -1.125,4.25 -1.75,9.25 2.5,10.75 4.25,1.5 6.875,-1.5 8.75,-4.75 1.875,-3.25 7.875,-21.5 9.369,-27.125 1.494,-5.625 4.756,-18.5 6.131,-22.375 1.375,-3.875 2.5,-5.625 3.625,-5.5 1.125,0.125 0.25,2.625 -1.125,7 -1.375,4.375 -5.375,18.5 -7.125,25 -1.75,6.5 -2.25,9.625 0,12 2.25,2.375 7.083,-0.541 8.25,-2.541 1.167,-2 3,-11 5.667,-16.333 1.676,-3.352 3.669,-11.246 6.53,-19.381 1.691,-4.808 4.336,-9.699 5.635999,-13.786 0.352,-1.106 0.67,-2.172 0.973,-3.219 2.707,-9.367 3.628,-16.586 6.027,-25.281 2.667,-9.667 0.167,-11.667 1,-20.167 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',13);" class="frt" id="frt_13" d="m 687.65701,622.75 c -2.75,-3.75 -17.5,-11.5 -21.75,-14.5 -2.125,-1.5 -7.938,-4.375 -14.281,-7.375 -6.343,-3 -13.219,-6.125 -17.469,-8.125 -8.417,-0.584 -30,7.584 -44.875,19.5 1,1.75 -0.875,7.125 0.125,16.25 1,9.125 4.125,23.25 6.375,32.125 2.25,8.875 7,18.375 8.5,22.875 1.5,4.5 9.403,29.364 12.625,32 2.75,2.25 7.5,0.75 8.25,-2.75 0.75,-3.5 -1.625,-10.875 -2.5,-14.125 -0.875,-3.25 -5.625,-19.25 -6.5,-21.75 -0.875,-2.5 -2,-5.125 -0.25,-5.125 1.75,0 2.125,2.75 3.25,5.625 1.125,2.875 5.875,19.5 6.875,24.125 1,4.625 4.5,17 6.25,21.75 1.75,4.75 5,10 9,9.75 4,-0.25 4.875,-4.75 5.125,-8.375 0.25,-3.625 -5.875,-23.5 -6.375,-27.625 -0.5,-4.125 -5.375,-19.25 -6.125,-21.25 -0.75,-2 -1.375,-5 0.625,-5.125 2,-0.125 2.875,5.625 3.75,8.625 0.875,3 9.75,31.875 10.25,35.5 0.5,3.625 2.625,14.5 6,17.75 2.744,2.643 5.625,3.875 8.625,0.875 3,-3 2.25,-10 0.875,-15.25 -1.375,-5.25 -4.625,-21.125 -5.5,-25 -0.875,-3.875 -6.375,-20.875 -7.25,-24 -0.875,-3.125 -2.125,-5.375 -1.125,-5.75 1,-0.375 2.25,1.125 3.5,5.25 1.25,4.125 6.625,20.5 8.375,25.5 1.75,5 1.5,11.625 4.125,17.375 2.625,5.75 7,7.625 10.625,7.125 3.625,-0.5 4.277,-7.391 4.375,-10.125 0.098,-2.734 -4.75,-20.5 -6.25,-27.375 -1.5,-6.875 -5.25,-16.625 -6.5,-23 -1.25,-6.375 -7.375,-23.375 -8.625,-26 -1.25,-2.625 -0.625,-4.75 2.5,-3.875 3.125,0.875 9.25,2.625 13,7.625 3.75,5 10.875,6.75 13.375,7 2.5,0.25 8.5,0.375 9.25,-6.375 0.75,-6.75 -7.5,-10 -10.25,-13.75 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',14);" class="frt" id="frt_14" d="m 350.32401,573 c -70.083,0 -88.917,-23 -100.498,-34.52 -0.44,1.852 -1.458,4.137 -3.419,7.188 -2.708,4.214 -5.009,15.491 -6.673,27.332 10.34,9.027 56.21,47.939 84.084,82.636 8.255,-3.802 35.957,-5.104 49.606,-0.453 28.214,-33.03 74.964,-71.046 85.649,-79.515 -1,-13.666 -8.334,-31.667 -10,-36.167 -12.332,13.001 -28.666,33.499 -98.749,33.499 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 323.81901,655.636 c 7.636,9.505 13.921,18.693 17.755,26.864 1,-2.167 2.75,-2.833 6.833,-3.167 4.083,-0.334 5.75,0.834 6.917,1.584 3.8,-7.69 10.229,-16.519 18.101,-25.734 -13.65,-4.652 -41.351,-3.349 -49.606,0.453 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',15);" class="frt" id="frt_15" d="m 239.73401,573 c -2.021,14.389 -3.102,29.611 -2.827,34 0.5,8 -6.5,46 -11.5,70 -3.981,19.107 -12.131,56.915 -14.375,92.478 -0.575,9.105 0.172,18.063 0.375,26.522 0.845,35.062 9.541,55.489 16.139,69.427 35.654,13.2 53.799,56.767 88.484,34.358 2.478,-11.204 8.03,-39.965 9.627,-52.285 1.75,-13.5 10.083,-66.333 11.815,-88.167 1.732,-21.834 1.269,-38.833 0.435,-43.166 -0.834,-4.333 -0.167,-12.667 -0.417,-21.334 -0.25,-8.667 3.083,-10.166 4.083,-12.333 -3.834,-8.171 -10.12,-17.359 -17.755,-26.864 -27.873,-34.697 -73.744,-73.609 -84.084,-82.636 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',16);" class="frt" id="frt_16" d="m 373.42501,655.183 c -7.872,9.216 -14.301,18.044 -18.101,25.734 1.167,0.75 3.083,5.083 4.333,8.083 1.25,3 1,20.75 -0.25,31.5 -1.25,10.75 1.5,59.75 3.75,71 2.25,11.25 8.417,55.334 10.084,67.001 1.667,11.667 5.166,31.5 7.166,39.833 36.334,25.833 52.479,-20.023 89.334,-33.168 5.667,-10 13.999,-27.333 15.999,-52.333 0.874,-10.926 1.603,-27.168 0.824,-43.078 -1.002,-20.493 -3.844,-40.436 -5.157,-47.754 -2.333,-13 -14.834,-82.834 -17,-92.667 -2.166,-9.833 -4.333,-40 -5.333,-53.666 -10.686,8.469 -57.436,46.484 -85.649,79.515 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 163.60701,427.169 c -13.704,-5.742 -25.834,-13.883 -24.421,-31.618 -1.917,7.803 -1.51,9.506 -8.779,18.699 -5.907,7.47 -15.794,29.063 -22.538,48.927 15.882,-28.244 68.495,4.695 75.547,19.871 6.154,-16.332 11.13,-43.69 11.49,-47.172 0.245,-2.366 0.814,-4.26 2.15,-7.163 -8.947,6.762 -22.055,3.23 -33.449,-1.544 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 591.40701,466.75 c -2.028,-7.858 -4.954,-16.438 -9.03,-24.074 -4.97,-9.31 -16.414,-30.066 -17.72,-32.176 -3.25,-5.25 -5.336,-9.194 -6.5,-17.25 2.692,19.349 -8.893,27.934 -23.177,33.919 -13.564,5.684 -29.562,9.612 -38.073,-3.502 2.667,5.5 7,11.333 7,17.333 0,1.363 1.692,13.781 4.385,25.354 2.187,9.396 5.372,18.235 6.115,20.146 -1.5,-13 62.5,-57 77,-19.75 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',17);" class="frt" id="frt_17" d="m 227.54601,865.427 c 1.212,2.56 2.353,4.901 3.361,7.073 6.5,14 6,37.5 6.5,61 0.078,3.657 0.262,7.679 0.348,11.921 10.591,44.449 51.024,21.223 68.904,3.938 0.325,-1.35 0.929,-2.658 1.373,-3.483 0.875,-1.625 2.125,-10.625 3.375,-16.625 1.25,-6 2,-18.5 4,-26.75 0.175,-0.721 0.386,-1.643 0.623,-2.715 -34.685,22.407 -52.83,-21.159 -88.484,-34.359 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',18);" class="frt" id="frt_18" d="m 380.40701,898.334 c 2,8.333 4.333,14.167 4.333,24 0,9.833 4,22.167 5.167,25 17.417,18.167 61,46.833 69.25,-8.834 0,-11.5 3.25,-39.334 3.584,-50.334 0.334,-11 1.333,-13 7,-23 -36.855,13.145 -53,59.001 -89.334,33.168 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',19);" class="frt" id="frt_19" d="m 237.75501,945.421 c 0.085,4.202 0.072,8.622 -0.239,13.122 -1.393,20.15 -4.799,41.913 -4.109,52.957 1,16 4.5,62 7.5,83 3,21 6.875,83 7.125,87.5 0.06,1.082 0.008,2.26 -0.107,3.478 6.992,-11.484 36.463,-9.869 44.754,-6.101 -1.079,-3.858 -2.297,-10.522 -2.438,-15.043 -0.167,-5.333 7.5,-47.167 8.333,-58.333 0.833,-11.166 3.667,-29.5 4.333,-33.333 0.666,-3.833 5.75,-17.168 9.5,-25.918 3.75,-8.75 3.5,-20 2.5,-27.25 -1,-7.25 -3.75,-45.75 -4.5,-51.375 -0.75,-5.625 -2.25,-13.125 -3.5,-15.125 -0.615,-0.984 -0.563,-2.333 -0.248,-3.642 -17.88,17.286 -58.313,40.512 -68.904,-3.937 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',20);" class="frt" id="frt_20" d="m 389.90701,947.334 c 1.167,2.833 -1.25,16.416 -4.25,33.916 -3,17.5 -4.083,48.751 -3.083,56.751 1,8 9.667,28.833 11.833,35 2.166,6.167 0.667,8.833 2,20.833 1.333,12 7.167,47.334 9,59 1.833,11.666 1.5,21 -0.667,27.167 6.667,-4.501 42.667,-7.001 46.167,8.499 -0.75,-4.25 -1.75,-10 -1,-22.25 0.75,-12.25 5,-60.25 8.25,-87.75 3.25,-27.5 6.75,-82 4.5,-96.5 -2.25,-14.5 -3.5,-32 -3.5,-43.5 -8.25,55.667 -51.833,27.001 -69.25,8.834 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',21);" class="frt" id="frt_21" d="m 247.92501,1185.478 c -0.363,3.847 -1.388,8.108 -1.768,11.147 -0.5,4 2.125,8.625 1.375,15.875 -0.034,0.332 -0.091,0.67 -0.146,1.008 12.665,-4.423 40.242,8.668 48.998,21.075 1.177,-7.814 1.063,-15.23 -0.478,-19.082 -1.667,-4.166 -2.167,-7.167 -0.833,-12.5 1.334,-5.333 -0.667,-18.667 -1.833,-21.834 -0.178,-0.482 -0.368,-1.097 -0.562,-1.79 -8.29,-3.769 -37.761,-5.384 -44.753,6.101 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',22);" class="frt" id="frt_22" d="m 404.74001,1180.001 c -2.167,6.167 -3.166,21 -2.666,22.667 0.5,1.667 0.833,9.333 -1,13.499 -1.833,4.166 -1.667,13.334 -0.667,21.5 6,-13.583 37,-29.917 50,-23.667 -2,-5.5 -2.25,-5.75 -1,-9.25 1.25,-3.5 2.25,-12 1.5,-16.25 -3.5,-15.5 -39.5,-13 -46.167,-8.499 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',23);" class="frt" id="frt_23" d="m 247.38601,1213.508 c -1.15,7.047 -6.68,15.393 -10.854,23.742 -4.375,8.75 -13,19.375 -21,28.25 -2.286,2.536 -4.111,5.777 -5.548,9.185 -3.593,8.519 -4.755,18.083 -4.577,20.315 0.25,3.125 3.125,5.875 6.125,5.5 0,1.125 1,2.875 4.25,2.5 0.25,2 0,6.25 8.25,5 4,4.875 7.875,4.625 10.75,1.75 5.292,6.314 10.383,6.492 15.75,5.809 4.375,-0.558 11.125,-7.809 12.25,-10.559 1.125,-2.75 2.25,-3.875 5.875,-6.75 1.972,-1.563 3.795,-4.086 5.156,-8.824 0.683,-2.376 1.247,-5.519 1.657,-8.232 0.275,-1.824 0.481,-3.456 0.604,-4.525 0.667,-5.833 0.667,-10.834 4.5,-21.334 8.667,-3.667 14,-10.333 15.5,-18.833 0.113,-0.642 0.215,-1.28 0.311,-1.918 -8.757,-12.408 -36.333,-25.499 -48.999,-21.076 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',24);" class="frt" id="frt_24" d="m 488.57301,1274.667 c -1.167,-4.167 -9.666,-14.833 -16.333,-21.833 -6.667,-7 -7.833,-11.333 -12.5,-18.667 -4.667,-7.334 -7.333,-14.667 -9.333,-20.167 -13,-6.25 -44,10.084 -50,23.667 1,8.166 12,15 15,16.5 3,1.5 3,4.167 3.833,7 0.833,2.833 2.834,10.667 3.834,21 1,10.333 6.25,15.749 8.666,17.666 2.416,1.917 2.834,3 3.667,4.667 0.833,1.667 3.417,6.083 11.167,9.75 7.75,3.667 14.999,-1.167 16.749,-4.75 4.5,4.5 11.084,0.416 12.25,-2.084 4.916,1.416 7.834,-3.25 7.917,-5.166 1.583,0.334 3.584,-1.082 4.25,-2.582 0.833,0.334 2.5,0.666 5,-3.334 2.5,-4 -3,-17.5 -4.167,-21.667 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                            </svg>\
                                        </div>\
                            <div class="hombre_back" style="display: inline-block;margin-right:30px;margin-left: 34px;margin-top: 10px;">\
                                            <svg height="210px" viewBox="0 0 659.40924 1327.2756">\
                                                <image xlink:href="img/cuerpo_masculino_b1.png" width="657.27032" height="1329.8563" preserveAspectRatio="none" id="image860" x="1.6774961" y="-1.5002179" />\
                                                <path class="bck" d="m 379.90633,139.576 c 3.058,-18.988 9.442,-66.107 10.527,-83.743 1.333,-21.666 -29,-55.333 -61.333,-55.333 -27.334,0 -58.5,32 -58,52.667 0.19,7.875 2,33 2.333,36.333 0.239,2.389 4.332,32.016 7.459,49.645 10.208,21.022 88.819,20.841 99.014,0.431 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',1);" class="bck" id="bck_1" d="m 426.93333,211.5 c -28,-9.5 -48.999,-27.333 -49.999,-29.5 -1,-2.167 0.166,-30.667 1.5,-34.5 0.248,-0.713 0.773,-3.584 1.472,-7.924 -10.194,20.41 -88.806,20.59 -99.013,-0.432 1.235,6.962 2.32,12.053 2.957,12.855 1.555,1.958 2.93,28.364 0.5,31.5 -7.805,10.073 -31.475,20.792 -49.208,27.5 21.708,-5.999 173.866,-3.279 191.791,0.501 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',2);" class="bck" id="bck_2" d="m 468.10033,336.5 c 2.836,-16.7 6.265,-36.969 4.098,-48.71 -0.126,-0.68 -0.267,-1.336 -0.431,-1.956 -3,-11.333 -7.667,-52 -44.834,-74.333 -17.925,-3.78 -170.083,-6.5 -191.792,-0.5 -39.458,21.5 -44.542,68.75 -45.542,74.5 -1,5.75 0.5,26.25 2.25,36.75 1.75,10.5 8.25,29.583 4.625,66.375 1.125,0 1.5,3.5 1.875,6.125 0.375,2.625 4.25,16.75 9.25,23 5,6.25 9.25,25 13.25,32.5 4.468,5.507 41.373,10.639 83.746,11.485 9.657,0.193 19.599,-1.733 29.504,-1.776 9.978,-0.044 19.919,1.793 29.499,1.512 39.579,-1.163 72.98,-6.345 77.196,-11.47 2.613,-5.708 6.414,-14.637 7.473,-18.167 1.5,-5 2.666,-9.167 4.833,-12.667 2.167,-3.5 7.833,-18.083 8.666,-21.083 0.833,-3 2.167,-9.417 3.334,-9.5 -1,-15.418 0,-34.418 3,-52.085 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.bck+',3);" class="bck" id="bck_3" d="m 363.59933,461.47 c -9.58,0.281 -19.521,-1.556 -29.499,-1.512 -9.906,0.043 -19.847,1.969 -29.504,1.776 -42.373,-0.846 -79.277,-5.978 -83.746,-11.485 4,7.5 6.5,19 8.5,37.75 2,18.75 -2.25,32 -3.25,37.75 -1,5.75 -0.227,23.88 1.25,28 1.412,3.939 3.607,9.041 -0.422,15.812 6.278,-9.18 30.556,-16.657 56.643,-16.657 29.53,0 31.03,10.279 51.53,10.279 19,0 26,-10.042 51.526,-10.166 25.239,-0.123 43.853,7.19 48.38,16.593 -0.532,-1.279 -0.915,-2.17 -1.072,-2.61 -0.834,-2.333 -1.166,-6.167 -0.333,-8.167 0.833,-2 2.667,-12.833 2.833,-19 0.166,-6.167 -3.667,-30 -4.667,-34.833 -1,-4.833 1.667,-28.5 2.334,-33.333 0.667,-4.833 3,-14.667 4.333,-16.833 0.392,-0.637 1.273,-2.456 2.361,-4.833 -4.217,5.124 -37.618,10.306 -77.197,11.469 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.bck+',4);" class="bck" id="bck_4" d="m 134.49333,452.18 c -15.45,-5.68 -30.124,-11.904 -26.143,-46.43 -2.75,7.75 -1.75,15.25 -6.5,23.5 -4.749997,8.25 -0.75,6.5 -9.749997,20 -4.221,6.332 -8.992,20.141 -13.178,35.472 -1.258,4.606 -2.463,9.351 -3.584,14.07 3.399,-5.935 6.601,-22.609 50.437997,-11 10.714,2.837 31.865,11.173 26.897,27.549 2.671,-7.794 4.745,-15.229 6.308,-21.617 2.547,-10.41 3.739,-18.036 3.953,-19.891 0.5,-4.333 0.833,-7.333 1.5,-9.333 0.667,-2 2.167,-9.833 2.333,-13.167 0.122,-2.427 3.069,-8.474 6.014,-14.285 -9.056,15.771 -21.75,21.212 -38.288,15.132 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',5);" class="bck" id="bck_5" d="m 535.92433,487.792 c 39.135,-10.364 46.681,1.813 50.268,8.767 -0.215,-1.377 -0.413,-2.655 -0.592,-3.809 -2.75,-17.75 -17.75,-47 -19.5,-49.75 -1.75,-2.75 -8.25,-16.5 -10.25,-26.75 -0.298,-1.528 -0.625,-2.92 -0.976,-4.249 1.46,29.062 -13.201,34.86 -27.667,40.179 -15.259,5.61 -27.922,1.412 -37.038,-11.656 0.798,1.699 1.386,2.92 1.681,3.476 2.25,4.25 2.25,4.75 2.177,7.75 -0.073,3 2.823,14.25 4.073,19.5 1.179,4.95 0.139,15.905 7.558,38.93 2.556,-12.233 21.21,-19.99 30.266,-22.388 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 189.60033,285.5 c 1,-5.75 6.083,-52.999 45.542,-74.5 -8.126,3.074 -15.006,5.307 -18.542,6.25 -8.263,2.203 -41.894,9.408 -53.5,19.5 -17.25,15 -26,35 -27.5,62.75 -0.721,13.331 0,25.833 0,34.5 9.833,-24.25 34.167,-26.167 54,-48.5 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path class="bck" d="m 471.76733,285.833 c 0.164,0.62 0.305,1.276 0.431,1.956 16.05,17.076 38.94,31.042 53.412,43.878 -0.086,-0.138 -0.175,-0.282 -0.26,-0.417 0.25,-20.25 4.75,-50.75 -12.25,-78.5 -17,-27.75 -58.167,-31.75 -86.167,-41.25 37.167,22.333 41.834,63 44.834,74.333 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 191.85033,322.25 c -1.75,-10.5 -3.25,-31 -2.25,-36.75 -19.833,22.333 -44.167,24.25 -54,48.5 -6.833,10.667 -18.25,33.75 -20,44 -1.75,10.25 -4.5,20 -7.25,27.75 -3.98,34.526 10.693,40.75 26.143,46.43 16.538,6.08 29.232,0.639 38.288,-15.131 1.1,-2.171 2.2,-4.311 3.152,-6.215 3.5,-7 16.417,-34.458 17.292,-37.333 0.875,-2.875 2.125,-4.875 3.25,-4.875 3.625,-36.793 -2.875,-55.876 -4.625,-66.376 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path class="bck" d="m 527.20733,452.18 c 14.466,-5.319 29.127,-11.117 27.667,-40.179 -2.005,-7.583 -4.833,-13.009 -8.024,-28.751 -3.706,-18.282 -14.002,-39.975 -21.24,-51.583 -14.472,-12.836 -37.362,-26.802 -53.412,-43.878 2.167,11.742 -1.262,32.011 -4.098,48.71 -3,17.667 -4,36.667 -2.999,52.083 1.167,-0.082 2.749,2.918 3.999,5.668 1.086,2.39 15.768,34.99 21.069,46.274 9.117,13.068 21.78,17.266 37.038,11.656 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',6);" class="bck" id="bck_6" d="m 386.62633,553.018 c -25.526,0.124 -32.526,10.166 -51.526,10.166 -20.5,0 -22,-10.279 -51.53,-10.279 -26.087,0 -50.365,7.477 -56.643,16.657 -0.185,0.311 -0.366,0.62 -0.578,0.938 -6,9 -12,51.75 -11.5,64 0.5,12.25 -2.5,24 -4,32.5 0,19 7.324,25.063 15.316,37.142 20.695,31.272 58.17,54.262 92.435,20.358 2.75,-2.875 6.75,-8.875 7.75,-11.625 1,-2.75 2,-3.25 4.375,-3.25 2.375,0 3.75,1.125 4.25,2.875 0.5,1.75 3.792,8.5 7.292,11.334 37.774,39.903 74.878,12.96 94.414,-18.404 8.533,-13.701 14.134,-14.93 14.134,-38.43 -1.558,-8.437 -3.389,-18.087 -4.048,-21.667 -1.167,-6.333 -0.5,-24.333 -2.666,-42.667 -1.622,-13.732 -6.051,-25.594 -8.521,-31.664 -0.206,-0.505 -0.397,-0.97 -0.573,-1.393 -4.528,-9.401 -23.141,-16.714 -48.381,-16.591 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path class="bck" d="m 125.77633,487.792 c -43.836997,-11.609 -47.037997,5.065 -50.437997,11 -3.104,13.064 -5.568,25.943 -6.738,35.208 -2.207,17.467 -8.379,42.596 -11.756,56.062 -0.875,6.021 6.182,9.66 17.564,14.473 11.004,4.653 23.67,4.044 26.294997,0.232 10.117,-17.065 26.772,-37.525 39.896,-61.517 4.95,-9.049 8.926,-18.728 12.073,-27.909 4.969,-16.376 -16.182,-24.712 -26.896,-27.549 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 587.29133,604.535 c 8.857,-3.745 15.074,-6.784 16.994,-10.783 -1.959,-5.819 -4.01,-12.795 -5.436,-20.252 -3.039,-15.895 -9.573,-57.137 -12.658,-76.941 -3.587,-6.955 -11.133,-19.131 -50.268,-8.767 -9.057,2.398 -27.71,10.155 -30.267,22.388 0.45,1.397 0.928,2.833 1.442,4.32 9,26 30,55.25 45.5,79.5 2.965,4.638 5.481,8.858 7.626,12.689 6.01,1.915 18.322,1.543 27.067,-2.154 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path class="bck" d="m 74.409333,604.535 c -11.382,-4.813 -18.439,-8.452 -17.564,-14.473 -1.215,4.844 -2.068,8.179 -2.244,9.105 -0.667,3.5 -4.164,10.214 -6.167,18.333 -0.375,1.692 -2.811,3.547 -5.5,4.5 3.667,-0.75 44.577,18.365 45.167,20.5 -1,-4 -1.25,-8 7,-27 1.483,-3.416 3.387,-6.993 5.603997,-10.733 -2.625997,3.812 -15.291997,4.421 -26.295997,-0.232 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 615.10033,621.25 c -3.5,-0.5 -4,-8.25 -5.25,-12.25 -0.701,-2.246 -3.058,-7.8 -5.564,-15.248 -1.92,3.999 -8.137,7.038 -16.994,10.783 -8.745,3.698 -21.058,4.07 -27.065,2.155 9.067,16.197 11.432,25.37 12.375,29.144 0.527,2.109 0.644,3.571 0.461,4.91 8.146,-4.652 34.231,-16.276 43.573,-19.125 -0.559,-0.175 -1.077,-0.304 -1.536,-0.369 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 42.933333,622 c -3.168,1.123 -14.167,7 -17.833,8.5 -3.666,1.5 -5.833,6.5 -10.167,9 -4.334,2.5 -8.3329997,6 -8.9999997,8.833 -0.667,2.833 -5.49999997,4.333 -5.49999997,7.333 0,3 1.99999997,5.333 6.87899997,6 4.8789997,0.667 12.6209997,-8 14.1209997,-9.5 1.5,-1.5 2.5,0.5 1.833,2.333 -0.667,1.833 -5.667,15 -6.833,19.834 -1.167,4.833 -3.833,17 -4.5,21 -0.667,4 -2.9999997,20.999 -3.3329997,23.999 -0.333,3 -3.333,15 1.167,18.334 4.4999997,3.334 7.8329997,-2.334 9.8329997,-7.667 2,-5.333 1.5,-11.833 2.667,-14.5 1.167,-2.667 4.333,-19 6.333,-22.5 2,-3.5 2.833,1.166 1.667,4.166 -1.166,3 -3.834,16.168 -3.834,18.335 0,2.167 -1.833,14 -2.5,18 -0.667,4 -1.333,14 0,18.167 1.333,4.167 7.167,1.666 9,-0.5 1.833,-2.166 3.667,-11.167 4.5,-16.5 0.833,-5.333 1,-14.167 2.531,-20 1.531,-5.833 3.636,-16.333 5.469,-19.167 1.833,-2.834 3.833,0.334 3.333,2.5 -0.5,2.166 -2.333,9.5 -4,16.333 -1.667,6.833 -1.5,14.5 -3,21.334 -1.5,6.834 -3.167,12.333 0,15.833 3.167,3.5 6.5,0.833 8.5,-1.667 2,-2.5 4.334,-13.333 5.667,-21.833 1.333,-8.5 4.667,-21.166 5.833,-25.166 1.167,-4.001 3.5,-7.834 5.333,-7.5 1.833,0.333 -0.167,6 -1,9.166 -0.833,3.166 -5,20.667 -5.167,26.334 -0.167,5.667 2.5,7.833 5.667,6.5 3.167,-1.333 4.333,-6 5,-8.834 0.667,-2.834 2.667,-8.666 3.167,-12 0.5,-3.334 4.167,-16.166 6.167,-20.334 2,-4.166 2.833,-9.332 6.673,-27.332 3.84,-18.001 1.494,-22.334 0.494,-26.334 -0.589,-2.135 -41.5,-21.25 -45.167,-20.5 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 653.10133,646.5 c -1.445,-3.854 -8,-7.667 -10.333,-8.667 -2.333,-1 -7.918,-8.083 -12.668,-10.083 -4.127,-1.738 -9.761,-4.982 -13.465,-6.132 -9.342,2.85 -35.428,14.474 -43.573,19.125 -0.222,1.623 -0.882,3.065 -1.795,5.257 -1.667,4 -0.666,16.167 0.334,19.5 1,3.334 4.166,22.334 5.833,26 1.667,3.666 3,8.167 3.667,10.5 0.667,2.333 7.667,32 10.167,34.333 2.5,2.333 5.666,1.834 7,-0.5 1.334,-2.334 0.5,-7.5 0,-10.833 -0.5,-3.333 -1.667,-9.833 -2,-12.5 -0.333,-2.667 -2.334,-10.5 -3.334,-14.166 -1,-3.667 1.334,-3.668 3,-1.5 1.666,2.166 3.334,8.666 4.167,11.833 0.833,3.167 3.5,16.166 4.333,20.666 0.833,4.5 2.834,17.667 5.834,20.834 3,3.167 5.666,3.333 8.166,1 2.5,-2.333 1.167,-7.333 0.834,-10.167 -0.333,-2.834 -2.5,-19.166 -2.834,-23 -0.334,-3.834 -3.833,-14.334 -4.666,-20.5 -0.833,-6.166 2.666,-1.834 3,-0.5 0.334,1.334 4.166,14.833 4.666,18.333 0.5,3.5 3,15.667 3.5,22.667 0.5,7 3.667,13 4.834,14.5 1.167,1.5 6,2.167 7.5,0 1.5,-2.167 1.166,-5.667 1,-9.333 -0.166,-3.666 -1.5,-22.167 -1.5,-25.667 0,-3.5 -4.5,-19.834 -5,-23.5 -0.5,-3.666 1.333,-1.834 2,-0.166 0.667,1.666 4.999,19.166 5.833,22.833 0.834,3.667 1.166,7.333 1.833,12 0.667,4.667 3.833,9 6.333,10.333 2.5,1.333 5.5,-1.166 6.5,-3.833 1,-2.667 -1.5,-15.167 -1.833,-23.333 -0.333,-8.166 -1.5,-11.334 -2.167,-14 -0.667,-2.667 -3,-18.167 -3.833,-22.5 -0.833,-4.334 -6.666,-19 -7.666,-21.834 -1,-2.834 4.166,0.5 5.666,2.833 1.5,2.333 7.5,5.5 10.5,5.333 3,-0.167 5.667,-1.667 6,-5.333 0.333,-3.666 -3.833,-4.5 -5.833,-9.833 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',7);" class="bck" id="bck_7" d="m 226.16633,704.142 c -7.993,-12.078 -15.316,-18.142 -15.316,-37.142 -1.5,8.5 -8.25,43 -9.75,54 -1.5,11 -3,14.5 -7.25,46.75 -4.25,32.25 -1.25,76 2.75,93.5 4,17.5 12.75,36.25 15.25,49.25 14.239,23.213 32.047,27.719 48.263,28.709 17.666,1.079 33.441,-2.949 40.654,-15.376 1.667,-5.833 6,-44.5 8.167,-58 2.167,-13.5 9.5,-61.333 10.5,-78.667 1,-17.334 1,-34.999 0.167,-40.999 -0.833,-6 -1.625,-16.292 -1,-21.667 -34.266,33.904 -71.741,10.914 -92.435,-20.358 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',8);" class="bck" id="bck_8" d="m 342.26733,723.834 c 0.833,5.834 0.083,10.166 -1.167,28.666 -1.25,18.5 3.25,73.25 6.5,86.75 3.25,13.5 7,38 8.75,56.25 1.093,11.397 3.355,23.087 5.571,32.39 8.43,9.247 24.089,12.271 39.665,11.319 15.283,-0.934 32.867,-4.996 46.76,-24.891 0.889,-5.953 1.705,-9.622 2.004,-10.818 0.75,-3 10.75,-28 13.5,-41.25 2.75,-13.25 4.25,-43.083 5.25,-58.083 1,-15 -4.499,-54.001 -5.833,-61.667 -1.334,-7.666 -3.833,-29.666 -5.166,-35.833 -1.333,-6.167 -4.334,-21.667 -4.834,-25.667 -0.218,-1.739 -1.254,-7.511 -2.452,-14 0,23.5 -5.601,24.729 -14.134,38.43 -19.536,31.364 -56.64,58.307 -94.414,18.404 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path class="bck" d="m 260.11333,939.209 c -16.216,-0.99 -34.024,-5.496 -48.263,-28.709 2.5,13 3.25,32.25 4.25,53.5 0.655,13.917 -0.084,29.658 -1.164,42.445 2.574,-20.91 19.106,-19.136 35.64,-17.488 16.633,1.658 33.267,3.272 35.69,9.876 -1.167,-5.5 0.667,-11.167 3,-16 2.333,-4.833 3.167,-17.833 4,-28.833 0.833,-11 5.833,-24.334 7.5,-30.167 -7.211,12.427 -22.987,16.455 -40.653,15.376 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 401.58633,939.209 c -15.576,0.951 -31.235,-2.072 -39.665,-11.319 1.331,5.594 2.646,10.325 3.679,13.61 2.75,8.75 2.25,34.25 5.5,40.5 2.566,4.935 3.724,9.253 3.484,15.155 6.028,-4.677 22.368,-6.785 36.539,-8.198 13.658,-1.361 29.354,1.297 35.854,14.047 -1.023,-13.899 -1.763,-29.888 -1.628,-46.754 0.15,-18.787 1.655,-32.959 2.996,-41.932 -13.891,19.895 -31.475,23.957 -46.759,24.891 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',9);" class="bck" id="bck_9" d="m 250.57633,988.957 c -16.533,-1.647 -33.065,-3.422 -35.64,17.488 -0.569,6.737 -1.232,12.655 -1.836,17.055 -1.75,12.75 -5,46 -2.5,60 2.5,14 8.75,70.5 9,91.75 2.411,11.598 18.52,15.432 31.624,15.948 13.165,0.52 23.325,-2.338 25.624,-16.146 1.52,-12.183 2.896,-25.104 3.086,-31.552 0.333,-11.333 8.333,-24 12.833,-37.334 4.5,-13.334 0.5,-46.666 -1.167,-65.5 -1.667,-18.834 -4.167,-36.333 -5.333,-41.833 -2.424,-6.604 -19.058,-8.218 -35.691,-9.876 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',10);" class="bck" id="bck_10" d="m 411.12333,988.957 c -14.171,1.413 -30.511,3.521 -36.539,8.198 -0.064,1.573 -0.222,3.253 -0.484,5.095 -1.25,8.75 -7,65.25 -7.5,84.75 -0.5,19.5 7.5,36 10.5,40 3,4 3.75,15.5 4,21.75 0.127,3.173 1.801,16.722 3.811,30.928 5.639,7.736 15.869,11.903 25.566,11.521 11.76,-0.464 25.933,-3.604 30.46,-12.624 0.124,-3.28 0.258,-6.378 0.413,-9.074 0.75,-13 4.75,-46.75 7.5,-74 2.75,-27.25 3,-44.75 1,-62.25 -0.921,-8.055 -1.999,-18.392 -2.872,-30.246 -6.501,-12.751 -22.196,-15.409 -35.855,-14.048 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 251.22433,1191.198 c -13.104,-0.517 -29.212,-4.351 -31.624,-15.948 0.25,21.25 4.125,51.5 4.25,58.125 0.125,6.625 -1.25,26.75 -1,28.625 0.25,1.875 0.25,3.75 -0.875,3.75 6.082,14.415 4.342,25.212 3.644,34.406 -0.388,5.104 0.181,9.513 1.315,14.177 10.5,-13.499 47.957,-20.15 48.229,-7.491 -0.177,-6.154 -1.244,-13.505 -2.062,-20.509 -1.5,-12.834 1.833,-27.333 2.167,-31.167 0.334,-3.834 -4.5,-18.5 -5.833,-25.5 -1.333,-7 2.167,-19.166 4.167,-31.333 0.862,-5.245 2.096,-14.051 3.247,-23.281 -2.301,13.808 -12.46,16.666 -25.625,16.146 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 410.47733,1191.198 c -9.697,0.383 -19.928,-3.784 -25.566,-11.521 1.949,13.775 4.214,28.17 5.69,34.323 3,12.5 1,17.833 -1.833,26.667 -2.833,8.834 -2.334,14.333 -1.334,21.999 1,7.666 0.667,17.5 0.5,24.5 -0.098,4.075 -2.111,11.312 -2.63,18.029 5.397,-8.651 37.767,-2.677 48.526,9.038 0.54,-0.488 1.031,-0.948 1.459,-1.357 0.771,-4.053 1.113,-8.488 0.792,-12.721 -0.999,-13.15 -1.991,-21.145 2.987,-33.769 -0.096,-0.073 -0.193,-0.146 -0.302,-0.221 -2.166,-1.498 -1.666,-12.665 -1.666,-21.665 0,-9 1.25,-24.25 2.25,-32 0.793,-6.143 1.114,-21.391 1.587,-33.926 -4.527,9.021 -18.7,12.16 -30.46,12.624 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 226.93333,1314.333 c 2.334,2.167 12.667,9.167 23.167,11.679 10.5,2.512 19.167,-1.512 23,-7.179 1.741,-2.574 2.21,-6.868 2.062,-11.991 -0.271,-12.659 -37.729,-6.008 -48.229,7.491 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 385.30433,1305.196 c -0.372,4.823 0.025,9.38 2.463,12.305 6.573,7.889 13.334,10.333 26.667,7.166 9.396,-2.231 15.717,-7.104 19.396,-10.433 -10.759,-11.714 -43.128,-17.689 -48.526,-9.038 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 225.61933,1300.156 c 0.699,-9.194 2.438,-19.991 -3.644,-34.406 -1.125,0 -2.875,1.375 -3.125,2.625 -0.25,1.25 -2.375,0.625 -4,0.125 -1.625,-0.5 -6.625,4.5 -6.75,5.125 -0.125,0.625 -0.25,1.25 -2.25,1.125 -2,-0.125 -5.75,3.125 -5.875,4.125 -0.125,1 -1.208,1.792 -2.875,1.958 -1.667,0.166 -4.167,3 -5.167,5.334 -1,2.334 0.833,4.833 1.667,9.166 0.834,4.333 6.667,9.333 18.833,12.167 12.166,2.834 12.167,4.666 14.5,6.833 -1.134,-4.664 -1.703,-9.072 -1.314,-14.177 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 436.08133,1300.156 c 0.321,4.232 -0.021,8.668 -0.792,12.721 0.792,-0.758 1.396,-1.358 1.812,-1.71 2.167,-1.834 16,-5.666 21.5,-7.5 5.5,-1.834 7.333,-7.166 7.666,-10.166 0.333,-3 0.5,-2.667 1.834,-5.834 1.334,-3.167 -5.167,-7.5 -6,-7.5 -0.833,0 -2,0 -2,-1.5 0,-1.5 -3.667,-4.333 -5.167,-4.333 -1.5,0 -3,-1 -3.5,-2.5 -0.5,-1.5 -6.667,-3.833 -8.833,-3.5 -2.058,0.316 -1.715,-0.571 -3.532,-1.946 -4.979,12.624 -3.987,20.618 -2.988,33.768 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                            </svg>\
                                        </div>\
            \
            \
            \
            \
            \
            \
            \
            \
            \
            \
            \
            \
            \
            \
    \
            </div>\
        </div>\
        <div class="tarjeta " style="width:31.6%;margin-left:1.2%;height: 350px;">\
            <div class="cabezera_tarjeta cabezera_tarjeta_gris" >\
                <span>Tratamiento realizado</span>\
            </div>\
            <div class="cuerpo_tarjerta" id="contenedor_tratamiento" style="overflow: auto;overflow-x: hidden;height: 325px;"></div>\
        </div>\
        <div class="tarjeta" style="width:31.6%;margin-left:1.2%;height: 350px;">\
            <div class="cabezera_tarjeta cabezera_tarjeta_roja" >\
                <span>Se recomienda</span>\
            </div>\
            <div class="cuerpo_tarjerta" style="overflow: auto;overflow-x: hidden;height: 325px;">\
                <div style="width:100%;height:auto;display:block;padding-top:15px;" id="contenedor_radios_sesion">\
                </div>\
            </div>\
        </div>\
        <div style="width: 97%;margin-top: 35px;margin-left: 1.5%;box-sizing: border-box;color: #555;font-weight: bold;font-size: 13px;">\
            ESTADO DEL JUGADOR\
        </div>\
        <div style="width:97%;margin-left: 1.5%;box-sizing: border-box;">\
            <div style="width:30%;display:flex;margin-right:2.5%;">\
                <a class="btn btn-md btn-primary green-a" style="width: 44%;background:#df4f4f;border: 2px solid #555;padding-bottom: 2px;">\
                    <div>\
                        <p class="ellipsis-text" style="font-weight: normal;">Estado</p>\
                    </div>\
                </a>\
                <select style="width:45%;background:#fff;border:2px solid;margin:0" class="" id="estado_jugador" name="estado_jugador" >\
                    <option value="0" >Seleccione</option>\
                    <option value="1" >Apto para jugar</option>\
                    <option value="2" >Apto para entrenar</option>\
                    <option value="3" >En reintegro deportivo</option>\
                    <option value="4" >En rehabilitación kinésica</option>\
                    <option value="5" >En espera de revisión médica</option>\
                    <option value="6" >En espera de resultado de examenes</option>\
                    <option value="7" >En post operatorio</option>\
                    <option value="8" >En espera de cirugia</option>\
                    <option value="9" >En reposo</option>\
                </select>\
            </div>\
        </div>\
        <div style="width:97%;height:250px;margin-top:35px;margin-left: 1.5%;box-sizing: border-box;">\
            <textarea id="observaciones_kinesiologo" name="observaciones_kinesiologo" onKeyup="validarFormulario()" onKeydown="validarFormulario()" style="width:100%;height:100%;border-radius: 0px 0px 5px 5px;resize: none;box-sizing: border-box;border: 2px solid #d2d2d2;"></textarea>\
        </div>\
        <div class="row-fluid">\
            <div class="span12"  style=" margin-top: 20px;">\
                <center>\
                    <button type="button" ng-disabled="" disabled="disabled" class="boton_guardar_informe" onClick="mostrarModalFormularioEnviarDatos();" id="boton_agregar_infrome"><i class="icon-save"></i> GUARDAR INFORME</button>\
                </center>\
            </div>\
        </div>\
    </div>'
};

var html_nueva_atencion={
    parte_1:'\
    <div style="margin-right:3.5%;width:29.96%;display:flex;margin-bottom:10px">\
        <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#404040;height:22px;">\
            <div>\
                <p class="ellipsis-text" style="font-weight: normal;">*Fecha Incidente</p>\
            </div>\
        </a>\
        <input type="text" readonly  style="width:50%;background:#fff;margin:0" class="grey-input date_fechaNacimiento " id="fecha_incidente" name="fecha_incidente" />\
    </div>\
    <div style="margin-right:0px;width:29.96%;display:flex;">\
        <a class="btn btn-md btn-primary green-a" style="width: 46%;background:#404040;height:20px;">\
            <div>\
                <p class="ellipsis-text" style="font-weight: normal;">*Contexto Incidente</p>\
            </div>\
        </a>\
        <select style="width:43%;background:#fff;border:2px solid;margin:0" class="" id="contexto_incidente_formulario" name="contexto_incidente_formulario" onchange="mostrarCampoOtroContextoIncidente(this.value)"></select>\
    </div>\
    <div style="width:95.8%;display:none;margin-bottom:15px" id="campo_otro_contexto_incidente">\
        <a class="btn btn-md btn-primary green-a" style="width: 28%;background:#404040">\
            <div>\
                <p class="ellipsis-text" style="font-weight: normal;">*¿Indique cual fue el incidente?</p>\
            </div>\
        </a>\
        <input type="text" style="width:67%;background:#fff;text-align:left;margin:0" class="grey-input " id="indique_incidente" name="indique_incidente" onchange="validarFormulario()" />\
    </div>\
    <div style="margin-right:0px;width:95.8%;display:flex;margin-bottom:15px">\
        <a class="btn btn-md btn-primary green-a" style="width: 14%;background:#404040">\
            <div>\
                <p class="ellipsis-text" style="font-weight: normal;">*Diagnostico</p>\
            </div>\
        </a>\
        <input type="text" style="width:81%;background:#fff;text-align:left;margin:0" class="grey-input " id="diagnostico" name="diagnostico" onchange="validarFormulario()" />\
    </div>\
    <div style="margin-right:0px;width:95.8%;display:flex;margin-bottom:15px">\
        <a class="btn btn-md btn-primary green-a" style="width: 14%;background:#404040">\
            <div style="margin-top:10%;">\
                <p class="ellipsis-text" style="font-weight: normal;">Anamnesis</p>\
            </div>\
        </a>\
        <textarea type="text" style="width:81%;background:#fff;text-align:left;resize:none" class="grey-input " id="anamnesis" name="anamnesis" onKeyup="validarFormulario()" ></textarea>\
    </div>\
    <div style="margin-right:0px;width:95.8%;display:flex;flex-wrap:wrap;margin-bottom:15px">\
        <div style="font-size: 12px;font-weight: 900;color: #404040;width:100%;">Examen Fisico</div>\
        <textarea type="text" style="width:100%;height: 102px;background:#fff;text-align:left;border:2px solid #d2d2d2;resize:none" class=" " id="examen_fisico" name="examen_fisico" ></textarea>\
    </div>\
    <div style="width:30%;display:flex;margin-right:0px;margin-bottom:10px">\
        <a class="btn btn-md btn-primary green-a" style="width: 51%;background:#df4f4f;border: 2px solid #555;padding-bottom: 2px;"><div><p class="ellipsis-text" style="font-weight: normal;">Examenes Solicitados</p></div></a>\
        <div class="btn-group c_objetivo_fisico " style="width: 49%;">\
            <button id="boton_examenes_solicitados" type="button" class="btn dropdown-toggle" data-toggle="dropdown" onclick="renderizarCheckboxExamenesSolicitados()" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #404040; background-color: #fff;">\
                <p id="examenes_solicitados" class="titulo_multi ellipsis-text">\
                    <span id="texto_boton_examenes_solicitados">Seleccione un Examen</span>\
                </p> \
                <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span>\
            </button>\
            <ul id="lista_examenes_solicitados" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>\
        </div>                    \
    </div>\
            </div>\
        </div>',
    parte_2:'\
    <div style="width:100%;margin-top:10px;">\
        <div class="tarjeta_cuerpo_leciones" style="width:31.6%;margin-left:1.2%;height: 350px;">\
            <div class="cabezera_tarjeta cabezera_tarjeta_gris">\
                <span>*Zonas Afectadas</span>\
            </div>\
            <div class="cuerpo_tarjerta" style="overflow: auto;overflow-x: hidden;    height: 325px;">\
            \
            \
            \
            \
            <div id="botones_zonas" class="width:100%;" style="margin-top: 0px; margin-bottom: 10px;display:block;">\
                                        \
            </div>\
                <div class="hombre_front" style="display: inline-block;margin-left:30px;margin-top: 10px;">\
                                            <svg height="210px" viewBox="0 0 698.40479 1316.3297">\
                                                <image xlink:href="img/cuerpo_masculino_f1.png" src="img/cuerpo_masculino_f1.png" width="695.29614" height="1315.5781" preserveAspectRatio="none" id="image947" x="0.97671771" y="-0.1400058" />\
                                                <path onClick="sector('+window.frt+',1);" class="frt" id="frt_1" d="m 403.74101,51.5 c -1.666,-32 -36.334,-51 -55.334,-51 -30.833,0 -50.167,31.5 -53.167,44.5 -1.915,8.295 -2.833,23.5 -2.5,28.167 0.333,4.667 1,12.333 0.667,16.167 2.04,7.695 6.667,23 6.667,33 0.667,5.167 1.167,12.5 3.333,18.833 3,4 22.5,23.333 44.167,23.333 21.667,0 36.5,-8.667 45.708,-23 2.625,-5.625 5,-15.25 4.75,-18.625 -0.708,-5.125 4.708,-28.042 5.709,-32.708 0.667,-7.333 1.666,-6.667 0,-38.667 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path class="frt" d="m 285.24001,87.5 c -4,4 -1.833,17 -0.833,20.667 1,3.667 5.833,14.667 7.167,15.833 1.334,1.166 5.167,4.833 8.5,-1.667 0,-10 -4.627,-25.305 -6.667,-33 -1,-1.833 -4.167,-5.833 -8.167,-1.833 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 398.03201,122.875 c 3.75,6.375 8.875,3.25 10,-1.75 1.125,-5 7.625,-7.875 6.75,-23.625 -0.875,-15.75 -8.041,-11.667 -11.041,-7.333 -1.001,4.666 -6.417,27.583 -5.709,32.708 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 325.90701,83.75 c 8.561,0 15.5,-4.197 15.5,-9.375 0,-5.178 -6.939,-9.375 -15.5,-9.375 -9.75,0 -15.5,4.197 -15.5,9.375 0,5.178 6.939,9.375 15.5,9.375 z" cursor="pointer"inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 373.90701,83.75 c 8.561,0 15.5,-4.197 15.5,-9.375 0,-5.178 -5.5,-9.375 -15.5,-9.375 -8.561,0 -15.5,4.197 -15.5,9.375 0,5.178 6.939,9.375 15.5,9.375 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 340.78201,86.75 c -0.375,3.125 -5,6.375 -5.625,13.125 -0.438,4.731 6.25,7.5 10.25,6.5 5,2.625 6.75,0.625 9.875,-0.625 5.75,0.875 8,-3.25 8,-7.75 0,-4.5 -4.375,-6.75 -4.875,-12.25 -0.5,-5.5 -3.375,-7.625 -3.125,-13.5 0.25,-5.875 -2.375,-9.875 -6.086,-9.875 -5.21,0 -6.289,7.875 -5.914,10.625 0.375,2.75 -2.125,10.625 -2.5,13.75 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 359.65701,114.75 c -2.256,-2.723 -6.231,-1.652 -7.875,-0.75 -0.882,0.484 -3.5,0.875 -5.125,-0.375 -1.625,-1.25 -6.125,-0.125 -7.375,1.625 -1.25,1.75 -11.75,5.125 -12.625,8.125 -0.875,3 8.625,3.25 11,4.125 2.375,0.875 4.5,3.75 13.125,3.75 8.625,0 10.966,-2.787 13.25,-3.25 2.284,-0.463 8.125,-1.125 8.5,-3.5 0.375,-2.375 -9.25,-5.375 -12.875,-9.75 z"cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path class="frt" d="m 293.07401,225.667 c 15.667,-0.833 41.167,-2.166 45.333,3.667 4.166,5.833 15.834,6 19.667,0 3.833,-6 38.028,-6.245 50.833,-4.333 4.95,0.739 9.833,0.81 14.438,0.363 10.976,-1.066 20.373,-5.078 25.342,-10.017 -8.889,0.081 -18.524,-5.195 -31.03,-10.721 -16.125,-7.126 -24.625,-15.876 -25.25,-18.626 -0.625,-2.75 0.125,-34.5 0.875,-44.5 -9.208,14.333 -24.041,23 -45.708,23 -21.667,0 -41.167,-19.333 -44.167,-23.333 2.167,6.333 1.5,29.833 0.75,45.333 -8.5,15.25 -40,24 -48,27.5 2.042,1.655 10.695,6.598 20.857,9.508 5.186,1.485 10.766,2.44 16.06,2.159 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.frt+',2);" class="frt" id="frt_2" d="m 224.88701,281.816 c 6.094,-31.882 44.123,-54.828 52.127,-58.308 -10.162,-2.91 -18.816,-7.853 -20.857,-9.508 -8,3.5 -15.5,2 -26.75,4.25 -11.25,2.25 -41.5,13.25 -53.5,37.75 -12,24.5 -9.5,57 -9.25,65.75 0.034,1.202 0.012,2.258 -0.058,3.222 12.866,-15.389 43.708,-19.127 58.288,-43.156 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.frt+',3);" class="frt" id="frt_3" d="m 471.90701,276.5 c 13.5,30.001 46.022,30.211 58.595,48.439 -0.768,-3.438 -1.004,-7.947 -0.345,-14.439 1.931,-19.007 -4.875,-52.125 -17.875,-68.5 -13,-16.375 -53.125,-26.75 -63.595,-26.654 -4.969,4.939 -14.366,8.951 -25.342,10.017 10.812,2.887 46.544,30.388 48.562,51.137 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',4);" class="frt" id="frt_4" d="m 471.90701,276.5 c -2.018,-20.749 -37.75,-48.25 -48.562,-51.137 -4.605,0.447 -9.488,0.376 -14.438,-0.363 -12.805,-1.911 -47,-1.667 -50.833,4.333 -3.833,6 -15.5,5.833 -19.667,0 -4.167,-5.833 -29.667,-4.5 -45.333,-3.667 -5.294,0.281 -10.873,-0.674 -16.059,-2.159 -8.004,3.48 -46.033,26.426 -52.127,58.308 -0.459,2.402 -0.744,4.852 -0.814,7.351 -1,35.667 0.003,72.11 -0.165,85.722 0.383,-0.096 9.666,25.111 12.166,30.778 2.5,5.667 5.082,17.834 8.582,24.584 8.25,7.75 46.75,25.25 73.25,18.25 26.5,-7 36.5,-6.244 65,0.128 28.5,6.372 52.668,-2.794 73.084,-27.211 1.25,-3.25 4.75,-11.75 5.333,-15 0.583,-3.25 2.667,-6.999 4.084,-9.749 1.417,-2.75 7.455,-21.675 8.005,-21.176 0.672,-13.342 -0.339,-86.991 -1.506,-98.992 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.frt+',5);" class="frt" id="frt_5" d="m 224.07401,289.167 c 0.07,-2.499 0.354,-4.949 0.814,-7.351 -14.58,24.029 -45.423,27.768 -58.288,43.156 -0.437,6.049 -2.914,8.093 -7.442,14.778 -5.251,7.75 -15.251,39.25 -18.751,51.25 -0.507,1.738 -0.896,3.229 -1.221,4.551 -1.413,17.735 10.718,25.876 24.421,31.618 11.394,4.774 24.501,8.306 33.45,1.543 0.711,-1.544 1.634,-3.368 2.85,-5.712 3.5,-6.75 23.363,-47.953 24.001,-48.111 0.168,-13.612 -0.834,-50.055 0.166,-85.722 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.frt+',6);" class="frt" id="frt_6" d="m 534.98001,427.169 c 14.284,-5.985 25.869,-14.57 23.177,-33.919 -1.625,-11.25 -17.875,-51.25 -22,-57.25 -2.265,-3.294 -4.53,-6.027 -5.655,-11.061 -12.573,-18.228 -45.095,-18.438 -58.595,-48.439 1.167,12.001 2.178,85.65 1.506,98.992 0.108,0.098 20.827,42.675 23.494,48.175 8.512,13.114 24.509,9.186 38.073,3.502 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',7);" class="frt" id="frt_7" d="m 107.86901,463.177 c -2.96,8.722 -5.318,17.111 -6.462,23.823 -2.027999,11.896 -8.778999,39.212 -16.706999,62.487 -1.735,5.094 -3.563,9.992 -5.337,14.495 1.722,9.015 32.507999,23.476 42.631999,18.606 1.457,-2.714 2.764,-5.01 3.745,-6.587 4.667,-7.5 11.917,-19.251 24.917,-35.251 13,-16 25.5,-39.75 32,-55.75 0.255,-0.629 0.508,-1.285 0.76,-1.953 -7.052,-15.175 -59.665,-48.114 -75.548,-19.87 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',8);" class="frt" id="frt_8" d="m 618.24001,562.561 c -2.89,-7.644 -5.897,-16.096 -8.083,-21.561 -4,-10 -12.75,-51 -18.75,-74.25 -14.5,-37.25 -78.5,6.75 -77,19.75 7,18 35.75,60.25 40.375,65.875 4.625,5.625 16.49,23.007 19.5,28.25 6.539,10.154 45.792,-8.458 43.958,-18.064 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.frt+',9);" class="frt" id="frt_9" d="m 382.90701,448.628 c -28.5,-6.372 -38.5,-7.128 -65,-0.128 -26.5,7 -65,-10.5 -73.25,-18.25 3.5,6.75 2,12 3.75,17.75 1.75,5.75 5,21.334 0.5,41.501 -4.5,20.167 -1.667,35.666 -0.5,40.166 0.785,3.029 2.326,5.001 1.419,8.813 11.581,11.52 30.415,34.52 100.498,34.52 70.083,0 86.417,-20.498 98.75,-33.499 -1.666,-4.5 -0.501,-12 2.499,-21.167 3,-9.167 -3.499,-44.667 -3.833,-52.833 -0.334,-8.166 2.501,-21.5 2.751,-27.584 0.25,-6.084 4.25,-13.25 5.5,-16.5 -20.416,24.417 -44.584,33.583 -73.084,27.211 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.frt+',10);" class="frt" id="frt_10" d="m 79.363011,563.982 c -5.112,12.975 -9.774,22.651 -10.456,24.143 -0.886,1.939 -1.456,3.337 -2.977,4.62 9.057,0.416 28.988,8.686 43.014999,19.44 2.127,-7.809 8.37,-20.88 13.05,-29.598 -10.124,4.871 -40.909999,-9.59 -42.631999,-18.605 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',11);" class="frt" id="frt_11" d="m 634.15701,592.75 c -8.5,-4 -5.75,-8.25 -9.5,-15 -1.7,-3.061 -4.019,-8.847 -6.417,-15.189 1.834,9.606 -37.419,28.219 -43.958,18.064 1.544,2.689 5.188,10.48 8.506,17.668 3.15,6.824 6.007,13.104 6.494,13.957 14.875,-11.916 36.458,-20.084 44.875,-19.5 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',12);" class="frt" id="frt_12" d="m 108.24001,615.667 c 0.096,-0.975 0.344,-2.156 0.705,-3.481 -14.026999,-10.755 -33.957999,-19.024 -43.014999,-19.44 -1.911,1.612 -5.326,3.042 -12.773,5.13 -1.854,0.52 -3.833,1.291 -5.874,2.231 -12.688,5.84 -27.892,18.435 -31.876,21.019 -4.625,3 -7.75,8.375 -11.875,10.5 -4.12500004,2.125 -4.12500004,8.625 0,10.5 4.125,1.875 9.625,0.125 13,-1.5 3.375,-1.625 9.042,-8.457 15.5,-10.5 3.788,-1.198 7.625,-1.5 7.625,0.125 0,1.625 -8.5,22.375 -9.125,25.5 -0.625,3.125 -3.875,13.875 -5.875,21.125 -2,7.25 -5.5,21.25 -6.75,29.25 -1.25,8 0.875,11.75 5.125,12.625 4.25,0.875 7.875,-7.625 8.646,-10.625 0.771,-3 2.854,-12.75 3.979,-15.5 1.125,-2.75 6.625,-18.75 8,-22 1.375,-3.25 2.375,-8.625 4.375,-7.75 2,0.875 -0.375,5.875 -1.75,9.75 -1.375,3.875 -7.125,24.749 -7.875,28.624 -0.75,3.875 -5,19.75 -5.25,22.5 -0.25,2.75 -1.875,8.75 2.75,10.5 4.625,1.75 7.75,-1.875 9.5,-5.625 1.75,-3.75 5.375,-17.625 7.375,-26.125 2,-8.5 5.75,-19.5 7.125,-24 1.375,-4.5 2.125,-8 3.875,-7.875 1.75,0.125 1.5,2.5 0.75,4.75 -0.75,2.25 -6.125,20.625 -7.125,25.625 -1,5 -4.25,16.125 -5.375,20.375 -1.125,4.25 -1.75,9.25 2.5,10.75 4.25,1.5 6.875,-1.5 8.75,-4.75 1.875,-3.25 7.875,-21.5 9.369,-27.125 1.494,-5.625 4.756,-18.5 6.131,-22.375 1.375,-3.875 2.5,-5.625 3.625,-5.5 1.125,0.125 0.25,2.625 -1.125,7 -1.375,4.375 -5.375,18.5 -7.125,25 -1.75,6.5 -2.25,9.625 0,12 2.25,2.375 7.083,-0.541 8.25,-2.541 1.167,-2 3,-11 5.667,-16.333 1.676,-3.352 3.669,-11.246 6.53,-19.381 1.691,-4.808 4.336,-9.699 5.635999,-13.786 0.352,-1.106 0.67,-2.172 0.973,-3.219 2.707,-9.367 3.628,-16.586 6.027,-25.281 2.667,-9.667 0.167,-11.667 1,-20.167 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',13);" class="frt" id="frt_13" d="m 687.65701,622.75 c -2.75,-3.75 -17.5,-11.5 -21.75,-14.5 -2.125,-1.5 -7.938,-4.375 -14.281,-7.375 -6.343,-3 -13.219,-6.125 -17.469,-8.125 -8.417,-0.584 -30,7.584 -44.875,19.5 1,1.75 -0.875,7.125 0.125,16.25 1,9.125 4.125,23.25 6.375,32.125 2.25,8.875 7,18.375 8.5,22.875 1.5,4.5 9.403,29.364 12.625,32 2.75,2.25 7.5,0.75 8.25,-2.75 0.75,-3.5 -1.625,-10.875 -2.5,-14.125 -0.875,-3.25 -5.625,-19.25 -6.5,-21.75 -0.875,-2.5 -2,-5.125 -0.25,-5.125 1.75,0 2.125,2.75 3.25,5.625 1.125,2.875 5.875,19.5 6.875,24.125 1,4.625 4.5,17 6.25,21.75 1.75,4.75 5,10 9,9.75 4,-0.25 4.875,-4.75 5.125,-8.375 0.25,-3.625 -5.875,-23.5 -6.375,-27.625 -0.5,-4.125 -5.375,-19.25 -6.125,-21.25 -0.75,-2 -1.375,-5 0.625,-5.125 2,-0.125 2.875,5.625 3.75,8.625 0.875,3 9.75,31.875 10.25,35.5 0.5,3.625 2.625,14.5 6,17.75 2.744,2.643 5.625,3.875 8.625,0.875 3,-3 2.25,-10 0.875,-15.25 -1.375,-5.25 -4.625,-21.125 -5.5,-25 -0.875,-3.875 -6.375,-20.875 -7.25,-24 -0.875,-3.125 -2.125,-5.375 -1.125,-5.75 1,-0.375 2.25,1.125 3.5,5.25 1.25,4.125 6.625,20.5 8.375,25.5 1.75,5 1.5,11.625 4.125,17.375 2.625,5.75 7,7.625 10.625,7.125 3.625,-0.5 4.277,-7.391 4.375,-10.125 0.098,-2.734 -4.75,-20.5 -6.25,-27.375 -1.5,-6.875 -5.25,-16.625 -6.5,-23 -1.25,-6.375 -7.375,-23.375 -8.625,-26 -1.25,-2.625 -0.625,-4.75 2.5,-3.875 3.125,0.875 9.25,2.625 13,7.625 3.75,5 10.875,6.75 13.375,7 2.5,0.25 8.5,0.375 9.25,-6.375 0.75,-6.75 -7.5,-10 -10.25,-13.75 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',14);" class="frt" id="frt_14" d="m 350.32401,573 c -70.083,0 -88.917,-23 -100.498,-34.52 -0.44,1.852 -1.458,4.137 -3.419,7.188 -2.708,4.214 -5.009,15.491 -6.673,27.332 10.34,9.027 56.21,47.939 84.084,82.636 8.255,-3.802 35.957,-5.104 49.606,-0.453 28.214,-33.03 74.964,-71.046 85.649,-79.515 -1,-13.666 -8.334,-31.667 -10,-36.167 -12.332,13.001 -28.666,33.499 -98.749,33.499 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 323.81901,655.636 c 7.636,9.505 13.921,18.693 17.755,26.864 1,-2.167 2.75,-2.833 6.833,-3.167 4.083,-0.334 5.75,0.834 6.917,1.584 3.8,-7.69 10.229,-16.519 18.101,-25.734 -13.65,-4.652 -41.351,-3.349 -49.606,0.453 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',15);" class="frt" id="frt_15" d="m 239.73401,573 c -2.021,14.389 -3.102,29.611 -2.827,34 0.5,8 -6.5,46 -11.5,70 -3.981,19.107 -12.131,56.915 -14.375,92.478 -0.575,9.105 0.172,18.063 0.375,26.522 0.845,35.062 9.541,55.489 16.139,69.427 35.654,13.2 53.799,56.767 88.484,34.358 2.478,-11.204 8.03,-39.965 9.627,-52.285 1.75,-13.5 10.083,-66.333 11.815,-88.167 1.732,-21.834 1.269,-38.833 0.435,-43.166 -0.834,-4.333 -0.167,-12.667 -0.417,-21.334 -0.25,-8.667 3.083,-10.166 4.083,-12.333 -3.834,-8.171 -10.12,-17.359 -17.755,-26.864 -27.873,-34.697 -73.744,-73.609 -84.084,-82.636 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',16);" class="frt" id="frt_16" d="m 373.42501,655.183 c -7.872,9.216 -14.301,18.044 -18.101,25.734 1.167,0.75 3.083,5.083 4.333,8.083 1.25,3 1,20.75 -0.25,31.5 -1.25,10.75 1.5,59.75 3.75,71 2.25,11.25 8.417,55.334 10.084,67.001 1.667,11.667 5.166,31.5 7.166,39.833 36.334,25.833 52.479,-20.023 89.334,-33.168 5.667,-10 13.999,-27.333 15.999,-52.333 0.874,-10.926 1.603,-27.168 0.824,-43.078 -1.002,-20.493 -3.844,-40.436 -5.157,-47.754 -2.333,-13 -14.834,-82.834 -17,-92.667 -2.166,-9.833 -4.333,-40 -5.333,-53.666 -10.686,8.469 -57.436,46.484 -85.649,79.515 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 163.60701,427.169 c -13.704,-5.742 -25.834,-13.883 -24.421,-31.618 -1.917,7.803 -1.51,9.506 -8.779,18.699 -5.907,7.47 -15.794,29.063 -22.538,48.927 15.882,-28.244 68.495,4.695 75.547,19.871 6.154,-16.332 11.13,-43.69 11.49,-47.172 0.245,-2.366 0.814,-4.26 2.15,-7.163 -8.947,6.762 -22.055,3.23 -33.449,-1.544 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="frt" d="m 591.40701,466.75 c -2.028,-7.858 -4.954,-16.438 -9.03,-24.074 -4.97,-9.31 -16.414,-30.066 -17.72,-32.176 -3.25,-5.25 -5.336,-9.194 -6.5,-17.25 2.692,19.349 -8.893,27.934 -23.177,33.919 -13.564,5.684 -29.562,9.612 -38.073,-3.502 2.667,5.5 7,11.333 7,17.333 0,1.363 1.692,13.781 4.385,25.354 2.187,9.396 5.372,18.235 6.115,20.146 -1.5,-13 62.5,-57 77,-19.75 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',17);" class="frt" id="frt_17" d="m 227.54601,865.427 c 1.212,2.56 2.353,4.901 3.361,7.073 6.5,14 6,37.5 6.5,61 0.078,3.657 0.262,7.679 0.348,11.921 10.591,44.449 51.024,21.223 68.904,3.938 0.325,-1.35 0.929,-2.658 1.373,-3.483 0.875,-1.625 2.125,-10.625 3.375,-16.625 1.25,-6 2,-18.5 4,-26.75 0.175,-0.721 0.386,-1.643 0.623,-2.715 -34.685,22.407 -52.83,-21.159 -88.484,-34.359 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',18);" class="frt" id="frt_18" d="m 380.40701,898.334 c 2,8.333 4.333,14.167 4.333,24 0,9.833 4,22.167 5.167,25 17.417,18.167 61,46.833 69.25,-8.834 0,-11.5 3.25,-39.334 3.584,-50.334 0.334,-11 1.333,-13 7,-23 -36.855,13.145 -53,59.001 -89.334,33.168 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',19);" class="frt" id="frt_19" d="m 237.75501,945.421 c 0.085,4.202 0.072,8.622 -0.239,13.122 -1.393,20.15 -4.799,41.913 -4.109,52.957 1,16 4.5,62 7.5,83 3,21 6.875,83 7.125,87.5 0.06,1.082 0.008,2.26 -0.107,3.478 6.992,-11.484 36.463,-9.869 44.754,-6.101 -1.079,-3.858 -2.297,-10.522 -2.438,-15.043 -0.167,-5.333 7.5,-47.167 8.333,-58.333 0.833,-11.166 3.667,-29.5 4.333,-33.333 0.666,-3.833 5.75,-17.168 9.5,-25.918 3.75,-8.75 3.5,-20 2.5,-27.25 -1,-7.25 -3.75,-45.75 -4.5,-51.375 -0.75,-5.625 -2.25,-13.125 -3.5,-15.125 -0.615,-0.984 -0.563,-2.333 -0.248,-3.642 -17.88,17.286 -58.313,40.512 -68.904,-3.937 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',20);" class="frt" id="frt_20" d="m 389.90701,947.334 c 1.167,2.833 -1.25,16.416 -4.25,33.916 -3,17.5 -4.083,48.751 -3.083,56.751 1,8 9.667,28.833 11.833,35 2.166,6.167 0.667,8.833 2,20.833 1.333,12 7.167,47.334 9,59 1.833,11.666 1.5,21 -0.667,27.167 6.667,-4.501 42.667,-7.001 46.167,8.499 -0.75,-4.25 -1.75,-10 -1,-22.25 0.75,-12.25 5,-60.25 8.25,-87.75 3.25,-27.5 6.75,-82 4.5,-96.5 -2.25,-14.5 -3.5,-32 -3.5,-43.5 -8.25,55.667 -51.833,27.001 -69.25,8.834 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',21);" class="frt" id="frt_21" d="m 247.92501,1185.478 c -0.363,3.847 -1.388,8.108 -1.768,11.147 -0.5,4 2.125,8.625 1.375,15.875 -0.034,0.332 -0.091,0.67 -0.146,1.008 12.665,-4.423 40.242,8.668 48.998,21.075 1.177,-7.814 1.063,-15.23 -0.478,-19.082 -1.667,-4.166 -2.167,-7.167 -0.833,-12.5 1.334,-5.333 -0.667,-18.667 -1.833,-21.834 -0.178,-0.482 -0.368,-1.097 -0.562,-1.79 -8.29,-3.769 -37.761,-5.384 -44.753,6.101 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',22);" class="frt" id="frt_22" d="m 404.74001,1180.001 c -2.167,6.167 -3.166,21 -2.666,22.667 0.5,1.667 0.833,9.333 -1,13.499 -1.833,4.166 -1.667,13.334 -0.667,21.5 6,-13.583 37,-29.917 50,-23.667 -2,-5.5 -2.25,-5.75 -1,-9.25 1.25,-3.5 2.25,-12 1.5,-16.25 -3.5,-15.5 -39.5,-13 -46.167,-8.499 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',23);" class="frt" id="frt_23" d="m 247.38601,1213.508 c -1.15,7.047 -6.68,15.393 -10.854,23.742 -4.375,8.75 -13,19.375 -21,28.25 -2.286,2.536 -4.111,5.777 -5.548,9.185 -3.593,8.519 -4.755,18.083 -4.577,20.315 0.25,3.125 3.125,5.875 6.125,5.5 0,1.125 1,2.875 4.25,2.5 0.25,2 0,6.25 8.25,5 4,4.875 7.875,4.625 10.75,1.75 5.292,6.314 10.383,6.492 15.75,5.809 4.375,-0.558 11.125,-7.809 12.25,-10.559 1.125,-2.75 2.25,-3.875 5.875,-6.75 1.972,-1.563 3.795,-4.086 5.156,-8.824 0.683,-2.376 1.247,-5.519 1.657,-8.232 0.275,-1.824 0.481,-3.456 0.604,-4.525 0.667,-5.833 0.667,-10.834 4.5,-21.334 8.667,-3.667 14,-10.333 15.5,-18.833 0.113,-0.642 0.215,-1.28 0.311,-1.918 -8.757,-12.408 -36.333,-25.499 -48.999,-21.076 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.frt+',24);" class="frt" id="frt_24" d="m 488.57301,1274.667 c -1.167,-4.167 -9.666,-14.833 -16.333,-21.833 -6.667,-7 -7.833,-11.333 -12.5,-18.667 -4.667,-7.334 -7.333,-14.667 -9.333,-20.167 -13,-6.25 -44,10.084 -50,23.667 1,8.166 12,15 15,16.5 3,1.5 3,4.167 3.833,7 0.833,2.833 2.834,10.667 3.834,21 1,10.333 6.25,15.749 8.666,17.666 2.416,1.917 2.834,3 3.667,4.667 0.833,1.667 3.417,6.083 11.167,9.75 7.75,3.667 14.999,-1.167 16.749,-4.75 4.5,4.5 11.084,0.416 12.25,-2.084 4.916,1.416 7.834,-3.25 7.917,-5.166 1.583,0.334 3.584,-1.082 4.25,-2.582 0.833,0.334 2.5,0.666 5,-3.334 2.5,-4 -3,-17.5 -4.167,-21.667 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                            </svg>\
                                        </div>\
                            <div class="hombre_back" style="display: inline-block;margin-right:30px;margin-left: 34px;margin-top: 10px;">\
                                            <svg height="210px" viewBox="0 0 659.40924 1327.2756">\
                                                <image xlink:href="img/cuerpo_masculino_b1.png" width="657.27032" height="1329.8563" preserveAspectRatio="none" id="image860" x="1.6774961" y="-1.5002179" />\
                                                <path class="bck" d="m 379.90633,139.576 c 3.058,-18.988 9.442,-66.107 10.527,-83.743 1.333,-21.666 -29,-55.333 -61.333,-55.333 -27.334,0 -58.5,32 -58,52.667 0.19,7.875 2,33 2.333,36.333 0.239,2.389 4.332,32.016 7.459,49.645 10.208,21.022 88.819,20.841 99.014,0.431 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',1);" class="bck" id="bck_1" d="m 426.93333,211.5 c -28,-9.5 -48.999,-27.333 -49.999,-29.5 -1,-2.167 0.166,-30.667 1.5,-34.5 0.248,-0.713 0.773,-3.584 1.472,-7.924 -10.194,20.41 -88.806,20.59 -99.013,-0.432 1.235,6.962 2.32,12.053 2.957,12.855 1.555,1.958 2.93,28.364 0.5,31.5 -7.805,10.073 -31.475,20.792 -49.208,27.5 21.708,-5.999 173.866,-3.279 191.791,0.501 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',2);" class="bck" id="bck_2" d="m 468.10033,336.5 c 2.836,-16.7 6.265,-36.969 4.098,-48.71 -0.126,-0.68 -0.267,-1.336 -0.431,-1.956 -3,-11.333 -7.667,-52 -44.834,-74.333 -17.925,-3.78 -170.083,-6.5 -191.792,-0.5 -39.458,21.5 -44.542,68.75 -45.542,74.5 -1,5.75 0.5,26.25 2.25,36.75 1.75,10.5 8.25,29.583 4.625,66.375 1.125,0 1.5,3.5 1.875,6.125 0.375,2.625 4.25,16.75 9.25,23 5,6.25 9.25,25 13.25,32.5 4.468,5.507 41.373,10.639 83.746,11.485 9.657,0.193 19.599,-1.733 29.504,-1.776 9.978,-0.044 19.919,1.793 29.499,1.512 39.579,-1.163 72.98,-6.345 77.196,-11.47 2.613,-5.708 6.414,-14.637 7.473,-18.167 1.5,-5 2.666,-9.167 4.833,-12.667 2.167,-3.5 7.833,-18.083 8.666,-21.083 0.833,-3 2.167,-9.417 3.334,-9.5 -1,-15.418 0,-34.418 3,-52.085 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.bck+',3);" class="bck" id="bck_3" d="m 363.59933,461.47 c -9.58,0.281 -19.521,-1.556 -29.499,-1.512 -9.906,0.043 -19.847,1.969 -29.504,1.776 -42.373,-0.846 -79.277,-5.978 -83.746,-11.485 4,7.5 6.5,19 8.5,37.75 2,18.75 -2.25,32 -3.25,37.75 -1,5.75 -0.227,23.88 1.25,28 1.412,3.939 3.607,9.041 -0.422,15.812 6.278,-9.18 30.556,-16.657 56.643,-16.657 29.53,0 31.03,10.279 51.53,10.279 19,0 26,-10.042 51.526,-10.166 25.239,-0.123 43.853,7.19 48.38,16.593 -0.532,-1.279 -0.915,-2.17 -1.072,-2.61 -0.834,-2.333 -1.166,-6.167 -0.333,-8.167 0.833,-2 2.667,-12.833 2.833,-19 0.166,-6.167 -3.667,-30 -4.667,-34.833 -1,-4.833 1.667,-28.5 2.334,-33.333 0.667,-4.833 3,-14.667 4.333,-16.833 0.392,-0.637 1.273,-2.456 2.361,-4.833 -4.217,5.124 -37.618,10.306 -77.197,11.469 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path onClick="sector('+window.bck+',4);" class="bck" id="bck_4" d="m 134.49333,452.18 c -15.45,-5.68 -30.124,-11.904 -26.143,-46.43 -2.75,7.75 -1.75,15.25 -6.5,23.5 -4.749997,8.25 -0.75,6.5 -9.749997,20 -4.221,6.332 -8.992,20.141 -13.178,35.472 -1.258,4.606 -2.463,9.351 -3.584,14.07 3.399,-5.935 6.601,-22.609 50.437997,-11 10.714,2.837 31.865,11.173 26.897,27.549 2.671,-7.794 4.745,-15.229 6.308,-21.617 2.547,-10.41 3.739,-18.036 3.953,-19.891 0.5,-4.333 0.833,-7.333 1.5,-9.333 0.667,-2 2.167,-9.833 2.333,-13.167 0.122,-2.427 3.069,-8.474 6.014,-14.285 -9.056,15.771 -21.75,21.212 -38.288,15.132 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',5);" class="bck" id="bck_5" d="m 535.92433,487.792 c 39.135,-10.364 46.681,1.813 50.268,8.767 -0.215,-1.377 -0.413,-2.655 -0.592,-3.809 -2.75,-17.75 -17.75,-47 -19.5,-49.75 -1.75,-2.75 -8.25,-16.5 -10.25,-26.75 -0.298,-1.528 -0.625,-2.92 -0.976,-4.249 1.46,29.062 -13.201,34.86 -27.667,40.179 -15.259,5.61 -27.922,1.412 -37.038,-11.656 0.798,1.699 1.386,2.92 1.681,3.476 2.25,4.25 2.25,4.75 2.177,7.75 -0.073,3 2.823,14.25 4.073,19.5 1.179,4.95 0.139,15.905 7.558,38.93 2.556,-12.233 21.21,-19.99 30.266,-22.388 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 189.60033,285.5 c 1,-5.75 6.083,-52.999 45.542,-74.5 -8.126,3.074 -15.006,5.307 -18.542,6.25 -8.263,2.203 -41.894,9.408 -53.5,19.5 -17.25,15 -26,35 -27.5,62.75 -0.721,13.331 0,25.833 0,34.5 9.833,-24.25 34.167,-26.167 54,-48.5 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path class="bck" d="m 471.76733,285.833 c 0.164,0.62 0.305,1.276 0.431,1.956 16.05,17.076 38.94,31.042 53.412,43.878 -0.086,-0.138 -0.175,-0.282 -0.26,-0.417 0.25,-20.25 4.75,-50.75 -12.25,-78.5 -17,-27.75 -58.167,-31.75 -86.167,-41.25 37.167,22.333 41.834,63 44.834,74.333 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 191.85033,322.25 c -1.75,-10.5 -3.25,-31 -2.25,-36.75 -19.833,22.333 -44.167,24.25 -54,48.5 -6.833,10.667 -18.25,33.75 -20,44 -1.75,10.25 -4.5,20 -7.25,27.75 -3.98,34.526 10.693,40.75 26.143,46.43 16.538,6.08 29.232,0.639 38.288,-15.131 1.1,-2.171 2.2,-4.311 3.152,-6.215 3.5,-7 16.417,-34.458 17.292,-37.333 0.875,-2.875 2.125,-4.875 3.25,-4.875 3.625,-36.793 -2.875,-55.876 -4.625,-66.376 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path class="bck" d="m 527.20733,452.18 c 14.466,-5.319 29.127,-11.117 27.667,-40.179 -2.005,-7.583 -4.833,-13.009 -8.024,-28.751 -3.706,-18.282 -14.002,-39.975 -21.24,-51.583 -14.472,-12.836 -37.362,-26.802 -53.412,-43.878 2.167,11.742 -1.262,32.011 -4.098,48.71 -3,17.667 -4,36.667 -2.999,52.083 1.167,-0.082 2.749,2.918 3.999,5.668 1.086,2.39 15.768,34.99 21.069,46.274 9.117,13.068 21.78,17.266 37.038,11.656 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',6);" class="bck" id="bck_6" d="m 386.62633,553.018 c -25.526,0.124 -32.526,10.166 -51.526,10.166 -20.5,0 -22,-10.279 -51.53,-10.279 -26.087,0 -50.365,7.477 -56.643,16.657 -0.185,0.311 -0.366,0.62 -0.578,0.938 -6,9 -12,51.75 -11.5,64 0.5,12.25 -2.5,24 -4,32.5 0,19 7.324,25.063 15.316,37.142 20.695,31.272 58.17,54.262 92.435,20.358 2.75,-2.875 6.75,-8.875 7.75,-11.625 1,-2.75 2,-3.25 4.375,-3.25 2.375,0 3.75,1.125 4.25,2.875 0.5,1.75 3.792,8.5 7.292,11.334 37.774,39.903 74.878,12.96 94.414,-18.404 8.533,-13.701 14.134,-14.93 14.134,-38.43 -1.558,-8.437 -3.389,-18.087 -4.048,-21.667 -1.167,-6.333 -0.5,-24.333 -2.666,-42.667 -1.622,-13.732 -6.051,-25.594 -8.521,-31.664 -0.206,-0.505 -0.397,-0.97 -0.573,-1.393 -4.528,-9.401 -23.141,-16.714 -48.381,-16.591 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path class="bck" d="m 125.77633,487.792 c -43.836997,-11.609 -47.037997,5.065 -50.437997,11 -3.104,13.064 -5.568,25.943 -6.738,35.208 -2.207,17.467 -8.379,42.596 -11.756,56.062 -0.875,6.021 6.182,9.66 17.564,14.473 11.004,4.653 23.67,4.044 26.294997,0.232 10.117,-17.065 26.772,-37.525 39.896,-61.517 4.95,-9.049 8.926,-18.728 12.073,-27.909 4.969,-16.376 -16.182,-24.712 -26.896,-27.549 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 587.29133,604.535 c 8.857,-3.745 15.074,-6.784 16.994,-10.783 -1.959,-5.819 -4.01,-12.795 -5.436,-20.252 -3.039,-15.895 -9.573,-57.137 -12.658,-76.941 -3.587,-6.955 -11.133,-19.131 -50.268,-8.767 -9.057,2.398 -27.71,10.155 -30.267,22.388 0.45,1.397 0.928,2.833 1.442,4.32 9,26 30,55.25 45.5,79.5 2.965,4.638 5.481,8.858 7.626,12.689 6.01,1.915 18.322,1.543 27.067,-2.154 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path class="bck" d="m 74.409333,604.535 c -11.382,-4.813 -18.439,-8.452 -17.564,-14.473 -1.215,4.844 -2.068,8.179 -2.244,9.105 -0.667,3.5 -4.164,10.214 -6.167,18.333 -0.375,1.692 -2.811,3.547 -5.5,4.5 3.667,-0.75 44.577,18.365 45.167,20.5 -1,-4 -1.25,-8 7,-27 1.483,-3.416 3.387,-6.993 5.603997,-10.733 -2.625997,3.812 -15.291997,4.421 -26.295997,-0.232 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 615.10033,621.25 c -3.5,-0.5 -4,-8.25 -5.25,-12.25 -0.701,-2.246 -3.058,-7.8 -5.564,-15.248 -1.92,3.999 -8.137,7.038 -16.994,10.783 -8.745,3.698 -21.058,4.07 -27.065,2.155 9.067,16.197 11.432,25.37 12.375,29.144 0.527,2.109 0.644,3.571 0.461,4.91 8.146,-4.652 34.231,-16.276 43.573,-19.125 -0.559,-0.175 -1.077,-0.304 -1.536,-0.369 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 42.933333,622 c -3.168,1.123 -14.167,7 -17.833,8.5 -3.666,1.5 -5.833,6.5 -10.167,9 -4.334,2.5 -8.3329997,6 -8.9999997,8.833 -0.667,2.833 -5.49999997,4.333 -5.49999997,7.333 0,3 1.99999997,5.333 6.87899997,6 4.8789997,0.667 12.6209997,-8 14.1209997,-9.5 1.5,-1.5 2.5,0.5 1.833,2.333 -0.667,1.833 -5.667,15 -6.833,19.834 -1.167,4.833 -3.833,17 -4.5,21 -0.667,4 -2.9999997,20.999 -3.3329997,23.999 -0.333,3 -3.333,15 1.167,18.334 4.4999997,3.334 7.8329997,-2.334 9.8329997,-7.667 2,-5.333 1.5,-11.833 2.667,-14.5 1.167,-2.667 4.333,-19 6.333,-22.5 2,-3.5 2.833,1.166 1.667,4.166 -1.166,3 -3.834,16.168 -3.834,18.335 0,2.167 -1.833,14 -2.5,18 -0.667,4 -1.333,14 0,18.167 1.333,4.167 7.167,1.666 9,-0.5 1.833,-2.166 3.667,-11.167 4.5,-16.5 0.833,-5.333 1,-14.167 2.531,-20 1.531,-5.833 3.636,-16.333 5.469,-19.167 1.833,-2.834 3.833,0.334 3.333,2.5 -0.5,2.166 -2.333,9.5 -4,16.333 -1.667,6.833 -1.5,14.5 -3,21.334 -1.5,6.834 -3.167,12.333 0,15.833 3.167,3.5 6.5,0.833 8.5,-1.667 2,-2.5 4.334,-13.333 5.667,-21.833 1.333,-8.5 4.667,-21.166 5.833,-25.166 1.167,-4.001 3.5,-7.834 5.333,-7.5 1.833,0.333 -0.167,6 -1,9.166 -0.833,3.166 -5,20.667 -5.167,26.334 -0.167,5.667 2.5,7.833 5.667,6.5 3.167,-1.333 4.333,-6 5,-8.834 0.667,-2.834 2.667,-8.666 3.167,-12 0.5,-3.334 4.167,-16.166 6.167,-20.334 2,-4.166 2.833,-9.332 6.673,-27.332 3.84,-18.001 1.494,-22.334 0.494,-26.334 -0.589,-2.135 -41.5,-21.25 -45.167,-20.5 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 653.10133,646.5 c -1.445,-3.854 -8,-7.667 -10.333,-8.667 -2.333,-1 -7.918,-8.083 -12.668,-10.083 -4.127,-1.738 -9.761,-4.982 -13.465,-6.132 -9.342,2.85 -35.428,14.474 -43.573,19.125 -0.222,1.623 -0.882,3.065 -1.795,5.257 -1.667,4 -0.666,16.167 0.334,19.5 1,3.334 4.166,22.334 5.833,26 1.667,3.666 3,8.167 3.667,10.5 0.667,2.333 7.667,32 10.167,34.333 2.5,2.333 5.666,1.834 7,-0.5 1.334,-2.334 0.5,-7.5 0,-10.833 -0.5,-3.333 -1.667,-9.833 -2,-12.5 -0.333,-2.667 -2.334,-10.5 -3.334,-14.166 -1,-3.667 1.334,-3.668 3,-1.5 1.666,2.166 3.334,8.666 4.167,11.833 0.833,3.167 3.5,16.166 4.333,20.666 0.833,4.5 2.834,17.667 5.834,20.834 3,3.167 5.666,3.333 8.166,1 2.5,-2.333 1.167,-7.333 0.834,-10.167 -0.333,-2.834 -2.5,-19.166 -2.834,-23 -0.334,-3.834 -3.833,-14.334 -4.666,-20.5 -0.833,-6.166 2.666,-1.834 3,-0.5 0.334,1.334 4.166,14.833 4.666,18.333 0.5,3.5 3,15.667 3.5,22.667 0.5,7 3.667,13 4.834,14.5 1.167,1.5 6,2.167 7.5,0 1.5,-2.167 1.166,-5.667 1,-9.333 -0.166,-3.666 -1.5,-22.167 -1.5,-25.667 0,-3.5 -4.5,-19.834 -5,-23.5 -0.5,-3.666 1.333,-1.834 2,-0.166 0.667,1.666 4.999,19.166 5.833,22.833 0.834,3.667 1.166,7.333 1.833,12 0.667,4.667 3.833,9 6.333,10.333 2.5,1.333 5.5,-1.166 6.5,-3.833 1,-2.667 -1.5,-15.167 -1.833,-23.333 -0.333,-8.166 -1.5,-11.334 -2.167,-14 -0.667,-2.667 -3,-18.167 -3.833,-22.5 -0.833,-4.334 -6.666,-19 -7.666,-21.834 -1,-2.834 4.166,0.5 5.666,2.833 1.5,2.333 7.5,5.5 10.5,5.333 3,-0.167 5.667,-1.667 6,-5.333 0.333,-3.666 -3.833,-4.5 -5.833,-9.833 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',7);" class="bck" id="bck_7" d="m 226.16633,704.142 c -7.993,-12.078 -15.316,-18.142 -15.316,-37.142 -1.5,8.5 -8.25,43 -9.75,54 -1.5,11 -3,14.5 -7.25,46.75 -4.25,32.25 -1.25,76 2.75,93.5 4,17.5 12.75,36.25 15.25,49.25 14.239,23.213 32.047,27.719 48.263,28.709 17.666,1.079 33.441,-2.949 40.654,-15.376 1.667,-5.833 6,-44.5 8.167,-58 2.167,-13.5 9.5,-61.333 10.5,-78.667 1,-17.334 1,-34.999 0.167,-40.999 -0.833,-6 -1.625,-16.292 -1,-21.667 -34.266,33.904 -71.741,10.914 -92.435,-20.358 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',8);" class="bck" id="bck_8" d="m 342.26733,723.834 c 0.833,5.834 0.083,10.166 -1.167,28.666 -1.25,18.5 3.25,73.25 6.5,86.75 3.25,13.5 7,38 8.75,56.25 1.093,11.397 3.355,23.087 5.571,32.39 8.43,9.247 24.089,12.271 39.665,11.319 15.283,-0.934 32.867,-4.996 46.76,-24.891 0.889,-5.953 1.705,-9.622 2.004,-10.818 0.75,-3 10.75,-28 13.5,-41.25 2.75,-13.25 4.25,-43.083 5.25,-58.083 1,-15 -4.499,-54.001 -5.833,-61.667 -1.334,-7.666 -3.833,-29.666 -5.166,-35.833 -1.333,-6.167 -4.334,-21.667 -4.834,-25.667 -0.218,-1.739 -1.254,-7.511 -2.452,-14 0,23.5 -5.601,24.729 -14.134,38.43 -19.536,31.364 -56.64,58.307 -94.414,18.404 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                                <path class="bck" d="m 260.11333,939.209 c -16.216,-0.99 -34.024,-5.496 -48.263,-28.709 2.5,13 3.25,32.25 4.25,53.5 0.655,13.917 -0.084,29.658 -1.164,42.445 2.574,-20.91 19.106,-19.136 35.64,-17.488 16.633,1.658 33.267,3.272 35.69,9.876 -1.167,-5.5 0.667,-11.167 3,-16 2.333,-4.833 3.167,-17.833 4,-28.833 0.833,-11 5.833,-24.334 7.5,-30.167 -7.211,12.427 -22.987,16.455 -40.653,15.376 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 401.58633,939.209 c -15.576,0.951 -31.235,-2.072 -39.665,-11.319 1.331,5.594 2.646,10.325 3.679,13.61 2.75,8.75 2.25,34.25 5.5,40.5 2.566,4.935 3.724,9.253 3.484,15.155 6.028,-4.677 22.368,-6.785 36.539,-8.198 13.658,-1.361 29.354,1.297 35.854,14.047 -1.023,-13.899 -1.763,-29.888 -1.628,-46.754 0.15,-18.787 1.655,-32.959 2.996,-41.932 -13.891,19.895 -31.475,23.957 -46.759,24.891 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',9);" class="bck" id="bck_9" d="m 250.57633,988.957 c -16.533,-1.647 -33.065,-3.422 -35.64,17.488 -0.569,6.737 -1.232,12.655 -1.836,17.055 -1.75,12.75 -5,46 -2.5,60 2.5,14 8.75,70.5 9,91.75 2.411,11.598 18.52,15.432 31.624,15.948 13.165,0.52 23.325,-2.338 25.624,-16.146 1.52,-12.183 2.896,-25.104 3.086,-31.552 0.333,-11.333 8.333,-24 12.833,-37.334 4.5,-13.334 0.5,-46.666 -1.167,-65.5 -1.667,-18.834 -4.167,-36.333 -5.333,-41.833 -2.424,-6.604 -19.058,-8.218 -35.691,-9.876 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path onClick="sector('+window.bck+',10);" class="bck" id="bck_10" d="m 411.12333,988.957 c -14.171,1.413 -30.511,3.521 -36.539,8.198 -0.064,1.573 -0.222,3.253 -0.484,5.095 -1.25,8.75 -7,65.25 -7.5,84.75 -0.5,19.5 7.5,36 10.5,40 3,4 3.75,15.5 4,21.75 0.127,3.173 1.801,16.722 3.811,30.928 5.639,7.736 15.869,11.903 25.566,11.521 11.76,-0.464 25.933,-3.604 30.46,-12.624 0.124,-3.28 0.258,-6.378 0.413,-9.074 0.75,-13 4.75,-46.75 7.5,-74 2.75,-27.25 3,-44.75 1,-62.25 -0.921,-8.055 -1.999,-18.392 -2.872,-30.246 -6.501,-12.751 -22.196,-15.409 -35.855,-14.048 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 251.22433,1191.198 c -13.104,-0.517 -29.212,-4.351 -31.624,-15.948 0.25,21.25 4.125,51.5 4.25,58.125 0.125,6.625 -1.25,26.75 -1,28.625 0.25,1.875 0.25,3.75 -0.875,3.75 6.082,14.415 4.342,25.212 3.644,34.406 -0.388,5.104 0.181,9.513 1.315,14.177 10.5,-13.499 47.957,-20.15 48.229,-7.491 -0.177,-6.154 -1.244,-13.505 -2.062,-20.509 -1.5,-12.834 1.833,-27.333 2.167,-31.167 0.334,-3.834 -4.5,-18.5 -5.833,-25.5 -1.333,-7 2.167,-19.166 4.167,-31.333 0.862,-5.245 2.096,-14.051 3.247,-23.281 -2.301,13.808 -12.46,16.666 -25.625,16.146 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 410.47733,1191.198 c -9.697,0.383 -19.928,-3.784 -25.566,-11.521 1.949,13.775 4.214,28.17 5.69,34.323 3,12.5 1,17.833 -1.833,26.667 -2.833,8.834 -2.334,14.333 -1.334,21.999 1,7.666 0.667,17.5 0.5,24.5 -0.098,4.075 -2.111,11.312 -2.63,18.029 5.397,-8.651 37.767,-2.677 48.526,9.038 0.54,-0.488 1.031,-0.948 1.459,-1.357 0.771,-4.053 1.113,-8.488 0.792,-12.721 -0.999,-13.15 -1.991,-21.145 2.987,-33.769 -0.096,-0.073 -0.193,-0.146 -0.302,-0.221 -2.166,-1.498 -1.666,-12.665 -1.666,-21.665 0,-9 1.25,-24.25 2.25,-32 0.793,-6.143 1.114,-21.391 1.587,-33.926 -4.527,9.021 -18.7,12.16 -30.46,12.624 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 226.93333,1314.333 c 2.334,2.167 12.667,9.167 23.167,11.679 10.5,2.512 19.167,-1.512 23,-7.179 1.741,-2.574 2.21,-6.868 2.062,-11.991 -0.271,-12.659 -37.729,-6.008 -48.229,7.491 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 385.30433,1305.196 c -0.372,4.823 0.025,9.38 2.463,12.305 6.573,7.889 13.334,10.333 26.667,7.166 9.396,-2.231 15.717,-7.104 19.396,-10.433 -10.759,-11.714 -43.128,-17.689 -48.526,-9.038 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 225.61933,1300.156 c 0.699,-9.194 2.438,-19.991 -3.644,-34.406 -1.125,0 -2.875,1.375 -3.125,2.625 -0.25,1.25 -2.375,0.625 -4,0.125 -1.625,-0.5 -6.625,4.5 -6.75,5.125 -0.125,0.625 -0.25,1.25 -2.25,1.125 -2,-0.125 -5.75,3.125 -5.875,4.125 -0.125,1 -1.208,1.792 -2.875,1.958 -1.667,0.166 -4.167,3 -5.167,5.334 -1,2.334 0.833,4.833 1.667,9.166 0.834,4.333 6.667,9.333 18.833,12.167 12.166,2.834 12.167,4.666 14.5,6.833 -1.134,-4.664 -1.703,-9.072 -1.314,-14.177 z" cursor="pointer" inkscape:connector-curvature="0" style="stroke:#ff0000;stroke-opacity:0.5" />\
                                                <path class="bck" d="m 436.08133,1300.156 c 0.321,4.232 -0.021,8.668 -0.792,12.721 0.792,-0.758 1.396,-1.358 1.812,-1.71 2.167,-1.834 16,-5.666 21.5,-7.5 5.5,-1.834 7.333,-7.166 7.666,-10.166 0.333,-3 0.5,-2.667 1.834,-5.834 1.334,-3.167 -5.167,-7.5 -6,-7.5 -0.833,0 -2,0 -2,-1.5 0,-1.5 -3.667,-4.333 -5.167,-4.333 -1.5,0 -3,-1 -3.5,-2.5 -0.5,-1.5 -6.667,-3.833 -8.833,-3.5 -2.058,0.316 -1.715,-0.571 -3.532,-1.946 -4.979,12.624 -3.987,20.618 -2.988,33.768 z" cursor="pointer" style="stroke:#ff0000;stroke-opacity:0.5" inkscape:connector-curvature="0" />\
                                            </svg>\
                                        </div>\
            \
            \
            \
            \
            \
            \
            \
            \
            \
            \
            \
            \
            \
            \
    \
            </div>\
        </div>\
        <div style="float:right;box-sizing: border-box;border:0;width:62%;height: 358px;margin-left: 1.2%;padding-right: 53px;">\
            <div style="text-align:center;font-size: 16px;margin-bottom: 15px;">Plan</div>\
            <textarea type="text" style="width:100%;height: 315px;background:#fff;text-align:left;border:2px solid #d2d2d2;resize:none" class=" " id="plan" name="plan"></textarea>\
        \
        </div>\
        <div style="width: 97%;margin-top: 35px;margin-left: 1.5%;box-sizing: border-box;color: #555;font-weight: bold;font-size: 13px;">\
            ESTADO DEL JUGADOR\
        </div>\
        <div style="width:97%;margin-left: 1.5%;box-sizing: border-box;">\
            <div style="width:30%;display:flex;margin-right:2.5%;">\
                <a class="btn btn-md btn-primary green-a" style="width: 44%;background:#df4f4f;border: 2px solid #555;padding-bottom: 2px;">\
                    <div>\
                        <p class="ellipsis-text" style="font-weight: normal;">Estado</p>\
                    </div>\
                </a>\
                <select style="width:45%;background:#fff;border:2px solid;margin:0" class="" id="estado_jugador" name="estado_jugador" >\
                    <option value="0" >Seleccione</option>\
                    <option value="1" >Apto para jugar</option>\
                    <option value="2" >Apto para entrenar</option>\
                    <option value="3" >En reintegro deportivo</option>\
                    <option value="4" >En rehabilitación kinésica</option>\
                    <option value="5" >En espera de revisión médica</option>\
                    <option value="6" >En espera de resultado de examenes</option>\
                    <option value="7" >En post operatorio</option>\
                    <option value="8" >En espera de cirugia</option>\
                    <option value="9" >En reposo</option>\
                </select>\
            </div>\
        </div>\
        <div style="width:97%;height:250px;margin-top:35px;margin-left: 1.5%;box-sizing: border-box;">\
            <textarea id="indicaciones" name="indicaciones" onKeyup="validarFormulario()" onKeydown="validarFormulario()" style="width:100%;height:100%;border-radius: 0px 0px 5px 5px;resize: none;box-sizing: border-box;border: 2px solid #d2d2d2;"></textarea>\
        </div>\
        <div class="row-fluid">\
            <div class="span12"  style=" margin-top: 20px;">\
                <center>\
                    <button type="button" ng-disabled="" disabled="disabled" class="boton_guardar_informe" onClick="mostrarModalFormularioEnviarDatos();" id="boton_agregar_infrome"><i class="icon-save"></i> GUARDAR INFORME</button>\
                </center>\
            </div>\
        </div>\
    </div>'
};

function activar_campo_seguimiento(derivado){
    if(derivado==="1"){
        $("#contenedor_seguimiento_diagnostico").css("display","flex");
        $("#contenedor_seguimiento_fecha_accidente").css("display","flex");
    }
    else if(derivado==="0"){
        $("#contenedor_seguimiento_diagnostico").css("display","none");
        $("#contenedor_seguimiento_fecha_accidente").css("display","none");
    }
    else{
        $("#contenedor_seguimiento_diagnostico").css("display","none");
        $("#contenedor_seguimiento_fecha_accidente").css("display","none");
    }
    validarFormulario();
}

var zonas_frt=[];
var zonas_bck=[];
var idzonas_frt=[];
var idzonas_bck=[];
var eliminar=[];

var n_zonas_frt = ["","Cara \/ Cabeza","Hombro derecho","Hombro izquierdo","Torax","Brazo Derecho","Brazo izquierdo","Antebrazo Derecho","Antebrazo izquierdo","Abdomen","Mu\u00f1eca Derecha","Mu\u00f1eca izquierda","Manos \/ Dedos Der","Manos \/ Dedos Izq","Cadera \/ Ingle\/ Pelvis","Muslo Anterior Der","Muslo Anterior Izq","Rodilla Derecha","Rodilla Izquierda","Pierna Derecha","Pierna Izquierda","Tobillo Derecho","Tobillo Izquierdo","Pie Derecho","Pie Izquierdo"];
var n_zonas_bck = ["","Cuello \/ Cervical","Dorsales","Lumbares","Codo Izquierdo","Codo Derecho","Gluteos","Muslo Posterior Izquierdo","Muslo Posterior Derecho","Pantorrilla Izquierda","Pantorrilla Derecha"];

function sector(frontBack,zona){ 
        if(frontBack=='frt'){
            var i = window.zonas_frt.indexOf(zona);
            if (i !== -1) {
                // alert("agregando")
                window.zonas_frt.splice(i, 1);
                if(window.id_informe!=false) {
                    var id_a = window.idzonas_frt.splice(i, 1);
                    window.eliminar.push(zona);
                }
                
                let attributeA = $('#'+frontBack+"_"+zona).attr('style');
                attributeA = attributeA.replace('fill-opacity: 0.2;', '');
                $('#'+frontBack+"_"+zona).attr('style', attributeA);
            } else {
                if(window.id_informe!=false) {
                    window.idzonas_frt.push(0);
                }
                window.zonas_frt.push(zona);
                $('#'+frontBack+"_"+zona).css({"fill-opacity":"0.2"});
            }
            
            if ($('#btn_zonaf_'+zona).length > 0) {
                $('#btn_zonaf_'+zona).remove();
            } else{
                $('#botones_zonas').append('<div id="btn_zonaf_'+zona+'" style="display: inline-block; border-radius: 5px; padding: 2px; margin-right: 3px; margin-bottom: 3px; color: white; background: #28b779;">'+n_zonas_frt[zona]+'</div>');
            }
        }else{
            var i = window.zonas_bck.indexOf(zona);
            if (i !== -1) {
                window.zonas_bck.splice(i, 1);
                if(window.id_informe!=false) {
                    var id_a = window.idzonas_bck.splice(i, 1);
                    window.eliminar.push(zona);
                }
                
                let attributeA = $('#'+frontBack+"_"+zona).attr('style');
                attributeA = attributeA.replace('fill-opacity: 0.2;', '');
                $('#'+frontBack+"_"+zona).attr('style', attributeA);
            } else {
                if(window.id_informe!=false) {
                    window.idzonas_bck.push(0);
                }
                
                window.zonas_bck.push(zona);
                $('#'+frontBack+"_"+zona).css({"fill-opacity":"0.2"});
            }
            
            if ($('#btn_zonab_'+zona).length > 0) {
                $('#btn_zonab_'+zona).remove();
            } else{
                $('#botones_zonas').append('<div id="btn_zonab_'+zona+'" style="display: inline-block; border-radius: 5px; padding: 2px; margin-right: 3px; margin-bottom: 3px; color: white; background: #28b779;">'+n_zonas_bck[zona]+'</div>');
            }
        }
        valiarFormularioNuevoIncidente();

}

function extraerZonasCuerpoFrente(formulario){
    let n_zonas_frt = ["","Cara \/ Cabeza","Hombro derecho","Hombro izquierdo","Torax","Brazo Derecho","Brazo izquierdo","Antebrazo Derecho","Antebrazo izquierdo","Abdomen","Mu\u00f1eca Derecha","Mu\u00f1eca izquierda","Manos \/ Dedos Der","Manos \/ Dedos Izq","Cadera \/ Ingle\/ Pelvis","Muslo Anterior Der","Muslo Anterior Izq","Rodilla Derecha","Rodilla Izquierda","Pierna Derecha","Pierna Izquierda","Tobillo Derecho","Tobillo Izquierdo","Pie Derecho","Pie Izquierdo"];
    let zonas_cuerpo_frente=[];
    for(let contador=0;contador<window.zonas_frt.length;contador++){
        let numero_zona=window.zonas_frt[contador];
        zonas_cuerpo_frente.push(n_zonas_frt[numero_zona]);
    }
    for(let contador_1=0;contador_1<zonas_frt.length;contador_1++){
        formulario.push({name:"array_codigo_cuerpo_frente[]",value:zonas_frt[contador_1]});
    }

    for(let contador_2=0;contador_2<zonas_cuerpo_frente.length;contador_2++){
        formulario.push({name:"array_zona_cuerpo_frente[]",value:zonas_cuerpo_frente[contador_2]});
    }

    return formulario
}

function extraerZonasCuerpoTracera(formulario){
    var n_zonas_bck = ["","Cuello \/ Cervical","Dorsales","Lumbares","Codo Izquierdo","Codo Derecho","Gluteos","Muslo Posterior Izquierdo","Muslo Posterior Derecho","Pantorrilla Izquierda","Pantorrilla Derecha"];
    let zonas_cuerpo_frente=[];
    let zonas_cuerpo_trasera=[];
    for(let contador=0;contador<window.zonas_bck.length;contador++){
        let numero_zona=window.zonas_bck[contador];
        zonas_cuerpo_trasera.push(n_zonas_bck[numero_zona]);
    }

    for(let contador_1=0;contador_1<zonas_bck.length;contador_1++){
        formulario.push({name:"array_codigo_cuerpo_tracera[]",value:zonas_bck[contador_1]});
    }

    for(let contador_2=0;contador_2<zonas_cuerpo_trasera.length;contador_2++){
        formulario.push({name:"array_zona_cuerpo_tracera[]",value:zonas_cuerpo_trasera[contador_2]});
    }
    return formulario;
}

function checkboxNingunoExamen(){
    if($("#examen_0").prop("checked")){
        let array_examen_solicitado = $('input[name="array_examen_solicitado[]"]:checked').map(function(){ 
            if(this.value!=="0"){
                $('#examen_'+this.value).prop("checked",false);
            }
            return this.value; 
        }).get();
    }
    contarElementosExamenesSolicitados();
    validarFormulario();
}

function checkedExamenes(){
    let array_examen_solicitado = $('input[name="array_examen_solicitado[]"]:checked').map(function(){ 
        if(this.value==="0"){
            $('#examen_'+this.value).prop("checked",false);
        }
        return this.value; 
    }).get();
    contarElementosExamenesSolicitados();
    validarFormulario();
}


var html_sesion={
    actual:'\
    <div id="grupo_radios_sesion_actual" style="display:none">\
        <label for="sesion_actual_1" style="font-size:12px"><input type="radio"  name="sesion_actual" id="sesion_actual_1" value="1" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="mostrarFechaReposoDeportiva()"/>Reposo Deportivo <input type="text" readonly  style="display:none;width:73px;background:#fff;margin:0" class="myDatepicker" id="actual_fecha_reposo_deportivo" name="actual_fecha_reposo_deportivo" /></label>\
        \
        <label for="sesion_actual_2" style="font-size:12px"><input type="radio" name="sesion_actual" id="sesion_actual_2" value="2" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Entrenamiento diferenciado</label>\
        <label for="sesion_actual_3" style="font-size:12px"><input type="radio" name="sesion_actual" id="sesion_actual_3" value="3" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Alta médica solo para entrenar</label>\
        <label for="sesion_actual_4" style="font-size:12px"><input type="radio" name="sesion_actual" id="sesion_actual_4" value="4" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Kinesiología</label>\
        <label for="sesion_actual_5" style="font-size:12px"><input type="radio" name="sesion_actual" id="sesion_actual_5" value="5" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Reaptador</label>\
        <label for="sesion_actual_6" style="font-size:12px"><input type="radio" name="sesion_actual" id="sesion_actual_6" value="6" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Regenerativo</label>\
        <label for="sesion_actual_7" style="font-size:12px"><input type="radio" name="sesion_actual" id="sesion_actual_7" value="7" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="mostrarFechaReposoTotal()"/>Reposo total<input type="text" readonly  style="display:none;width:73px;background:#fff;margin:0" class="" id="actual_fecha_reposo_total" name="actual_fecha_reposo_total" /></label>\
        \
        <label for="sesion_actual_8" style="font-size:12px"><input type="radio" name="sesion_actual" id="sesion_actual_8" value="8" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Derivado a relizar examenes</label>\
        <label for="sesion_actual_9" style="font-size:12px"><input type="radio" name="sesion_actual" id="sesion_actual_9" value="9" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Derivado a urgencias</label>\
        <label for="sesion_actual_10" style="font-size:12px"><input type="radio" name="sesion_actual" id="sesion_actual_10" value="10" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Alta médica para partidos y entrenamientos</label>\
        <label for="sesion_actual_11" style="font-size:12px"><input type="radio" name="sesion_actual" id="sesion_actual_11" value="11" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Citado a Médico</label>\
        <label for="sesion_actual_12" style="font-size:12px"><input type="radio" name="sesion_actual" id="sesion_actual_12" value="12" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Citado a Médico para Alta</label>\
        <label for="sesion_actual_13" style="font-size:12px"><input type="radio" name="sesion_actual" id="sesion_actual_13" value="13" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Reintegro deportivo progresivo</label>\
    </div>',
    siguiente:'\
    <div id="grupo_radios_sesion_siguiente" style="display:none">\
        <label for="sesion_siguiente_1" style="font-size:12px"><input type="radio"  name="sesion_siguiente" id="sesion_siguiente_1" value="1" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="mostrarFechaReposoDeportivaSiguiente()"/>Reposo Deportivo <input type="text" readonly  style="display:none;width:73px;background:#fff;margin:0" class="myDatepicker" id="siguiente_fecha_reposo_deportivo" name="siguiente_fecha_reposo_deportivo" /></label>\
        \
        <label for="sesion_siguiente_2" style="font-size:12px"><input type="radio" name="sesion_siguiente" id="sesion_siguiente_2" value="2" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Entrenamiento diferenciado</label>\
        <label for="sesion_siguiente_3" style="font-size:12px"><input type="radio" name="sesion_siguiente" id="sesion_siguiente_3" value="3" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Alta médica solo para entrenar</label>\
        <label for="sesion_siguiente_4" style="font-size:12px"><input type="radio" name="sesion_siguiente" id="sesion_siguiente_4" value="4" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Kinesiología</label>\
        <label for="sesion_siguiente_5" style="font-size:12px"><input type="radio" name="sesion_siguiente" id="sesion_siguiente_5" value="5" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Reaptador</label>\
        <label for="sesion_siguiente_6" style="font-size:12px"><input type="radio" name="sesion_siguiente" id="sesion_siguiente_6" value="6" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Regenerativo</label>\
        <label for="sesion_siguiente_7" style="font-size:12px"><input type="radio" name="sesion_siguiente" id="sesion_siguiente_7" value="7" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="mostrarFechaReposoTotalSiguiente()"/>Reposo total <input type="text" readonly  style="display:none;width:73px;background:#fff;margin:0" class="" id="siguiente_fecha_reposo_total" name="siguiente_fecha_reposo_total" /></label>\
        \
        <label for="sesion_siguiente_8" style="font-size:12px"><input type="radio" name="sesion_siguiente" id="sesion_siguiente_8" value="8" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Derivado a relizar examenes</label>\
        <label for="sesion_siguiente_9" style="font-size:12px"><input type="radio" name="sesion_siguiente" id="sesion_siguiente_9" value="9" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Derivado a urgencias</label>\
        <label for="sesion_siguiente_10" style="font-size:12px"><input type="radio" name="sesion_siguiente" id="sesion_siguiente_10" value="10" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Alta médica para partidos y entrenamientos</label>\
        <label for="sesion_siguiente_11" style="font-size:12px"><input type="radio" name="sesion_siguiente" id="sesion_siguiente_11" value="11" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Citado a Médico</label>\
        <label for="sesion_siguiente_12" style="font-size:12px"><input type="radio" name="sesion_siguiente" id="sesion_siguiente_12" value="12" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Citado a Médico para Alta</label>\
        <label for="sesion_siguiente_13" style="font-size:12px"><input type="radio" name="sesion_siguiente" id="sesion_siguiente_13" value="13" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="estadoFecha()"/>Reintegro deportivo progresivo</label>\
    </div>',
    recomendaciones_1:'\
    <label for="recomendacion_1" style="font-size:12px"><input type="checkbox"  name="array_recomendacion[]" id="recomendacion_1" value="1" style="margin-left:5px;margin-right:5px;margin-top:0px;" />Reposo Deportivo <input type="text" readonly  style="width:73px;background:#fff;margin:0" class="myDatepicker" id="reposo_deportivo" name="1_reposo_deportivo" /></label>\
    <label for="recomendacion_2" style="font-size:12px"><input type="checkbox"  name="array_recomendacion[]" id="recomendacion_2" value="2" style="margin-left:5px;margin-right:5px;margin-top:0px;" />Reposo total <input type="text" readonly  style="width:73px;background:#fff;margin:0" class="myDatepicker" id="reposo_total" name="2_reposo_total" /></label>\
    <label for="recomendacion_3" style="font-size:12px"><input type="checkbox"  name="array_recomendacion[]" id="recomendacion_3" value="3" style="margin-left:5px;margin-right:5px;margin-top:0px;" />Sesiones Kinesiología</label>\
    <label for="recomendacion_4" style="font-size:12px"><input type="checkbox"  name="array_recomendacion[]" id="recomendacion_4" value="4" style="margin-left:5px;margin-right:5px;margin-top:0px;" />Trabajo con readaptador</label>\
    <label for="recomendacion_5" style="font-size:12px"><input type="checkbox"  name="array_recomendacion[]" id="recomendacion_5" value="5" style="margin-left:5px;margin-right:5px;margin-top:0px;" />Realizarse exámenes</label>\
    <label for="recomendacion_6" style="font-size:12px"><input type="checkbox"  name="array_recomendacion[]" id="recomendacion_6" value="6" style="margin-left:5px;margin-right:5px;margin-top:0px;" />Entrenamiento normal</label>\
    <label for="recomendacion_7" style="font-size:12px"><input type="checkbox"  name="array_recomendacion[]" id="recomendacion_7" value="7" style="margin-left:5px;margin-right:5px;margin-top:0px;" />Entrenamiento diferenciado</label>\
    <label for="recomendacion_8" style="font-size:12px"><input type="checkbox"  name="array_recomendacion[]" id="recomendacion_8" value="8" style="margin-left:5px;margin-right:5px;margin-top:0px;" />Control/Revisión médica</label>\
    <label for="recomendacion_9" style="font-size:12px"><input type="checkbox"  name="array_recomendacion[]" id="recomendacion_9" value="9" style="margin-left:5px;margin-right:5px;margin-top:0px;" />Control/Cirugia</label>\
    '
};

var html_atencion_control_sesion={
    parte_1:'\
    <div style="width:100%;">\
        <div class="tarjeta " style="margin-left: 1%;background: #fff0;height: 377px;float: left;">\
            <div class="cabezera_tarjeta cabezera_tarjeta_gris">\
                <span>*Trabajo con readaptador</span>\
            </div>\
            <div class="cuerpo_tarjerta" id="contenedor_trabajo_readaptador" style="overflow: auto;overflow-x: hidden;"></div>\
        </div>\
        <div style="box-sizing: border-box;width: 53%;height: 377px;float: left;margin-left: 1%;">\
            <div style="font-size: 12px;margin-bottom: 5px;">Detalle tratamiento readaptador / Obseravación</div>\
            <textarea type="text" style="width:100%;height: 323px;background:#fff;text-align:left;border:2px solid #d2d2d2;resize:none" class=" " id="observaciones_generales" name="observaciones_generales"></textarea>\
        </div>\
        <div class="tarjeta" style="height: 290px;margin-left: 3%;background: #fff0;width: 22%;float: left;">\
            <div class="cabezera_tarjeta cabezera_tarjeta_roja" >\
                <span>Se recomienda</span>\
            </div>\
            <div class="cuerpo_tarjerta" style="overflow: auto;overflow-x: hidden;height: 325px;">\
                <div style="width:100%;height:auto;display:block;padding-top:15px;" id="contenedor_radios_sesion">\
                </div>\
            </div>\
        </div>\
    </div>\
        <div style="box-sizing:border-box;width:100%;clear: both;display:inline-flex;flex-wrap:wrap;flex-direction:row;">\
            <div style="width: 97%;margin-top: 35px;margin-left: 2%;box-sizing: border-box;color: #555;font-weight: bold;font-size: 13px;">ACTUALIZACIÓN DEL ESTADO DEL JUGADOR</div>\
            <div style="width: 25%;margin-left: 2%;display:flex;margin-bottom:10px">\
                <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#df4f4f;border:2px solid #555;padding-bottom: 2px;">\
                    <div>\
                        <p class="ellipsis-text" style="font-weight: normal;">% de recuperación</p>\
                    </div>\
                </a>\
                <select style="width:50%; height: 30px;background:#fff;border:2px solid" class="" id="porcentaje_recuperacion" name="porcentaje_recuperacion" onchange="validarFormulario()">\
                </select>\
            </div>\
            <div style="width: 25%;margin-left: 5%;display:flex;margin-bottom:10px">\
                <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#df4f4f;border:2px solid #555;padding-bottom: 2px;">\
                    <div>\
                        <p class="ellipsis-text" style="font-weight: normal;">Estado</p>\
                    </div>\
                </a>\
                <select style="width:45%;background:#fff;border:2px solid;margin:0" class="" id="estado_jugador" name="estado_jugador">\
                    <option value="0">Seleccione</option>\
                    <option value="1">Apto para jugar</option>\
                    <option value="2">Apto para entrenar</option>\
                    <option value="3">En reintegro deportivo</option>\
                    <option value="4">En rehabilitación kinésica</option>\
                    <option value="5">En espera de revisión médica</option>\
                    <option value="6">En espera de resultado de examenes</option>\
                    <option value="7">En post operatorio</option>\
                    <option value="8">En espera de cirugia</option>\
                    <option value="9">En reposo</option>\
                </select>\
            </div>\
            <div style="width: 35%;margin-left: 5%;display:flex;margin-bottom:10px">\
                <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#df4f4f;border:2px solid #555;padding-bottom: 2px;">\
                    <div>\
                        <p class="ellipsis-text" style="font-weight: normal;">Fecha estimada para el alta medica</p>\
                    </div>\
                </a>\
                <input readonly="" style="box-sizing:border-box;width:50%;height:30px;border:2px solid;background-color:#fff;" type="text" class="" id="fecha_alta" name="fecha_alta">\
            </div>\
        </div>\
        <div style="width:95%;height:250px;margin-top:35px;margin-left: 2%;box-sizing: border-box;">\
            <textarea id="indicaciones" name="indicaciones" style="width:100%;height:100%;border-radius: 0px 0px 5px 5px;resize: none;box-sizing: border-box;border: 2px solid #d2d2d2;"></textarea>\
        </div>\
        <div class="row-fluid">\
            <div class="span12"  style=" margin-top: 20px;">\
                <center>\
                    <button type="button" ng-disabled="" disabled="disabled" class="boton_guardar_informe" onClick="mostrarModalFormularioEnviarDatos();" id="boton_agregar_infrome"><i class="icon-save"></i> GUARDAR INFORME</button>\
                </center>\
            </div>\
        </div>',
    parte_2:'\
        <div style="margin-right:2.5%;width:29.96%;display:flex;margin-bottom:10px">\
            <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040">\
                <div>\
                    <p class="ellipsis-text" style="font-weight: normal;">*N° Sesión</p>\
                </div>\
            </a>\
            <select style="width:50%; height: 30px;background:#fff;border:2px solid" class="" id="numero_sesiones" name="numero_sesiones" onchange="validarFormulario()">\
            </select>\
        </div>\
        <div style="margin-right:2.5%;width:29.96%;display:flex;margin-bottom:10px">\
            <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040">\
                <div>\
                    <p class="ellipsis-text" style="font-weight: normal;">*Asistencia</p>\
                </div>\
            </a>\
            <select style="width:50%; height: 30px;background:#fff;border:2px solid" class="" id="asistencia_control" name="asistencia_control" onchange="validarFormulario()">\
                <option value="1">Presente</option>\
                <option value="0">Ausente</option>\
                <option value="2">No avisa</option>\
                <option value="3">Avisa</option>\
            </select>\
        </div>\
        <div style="margin-right:2.5%;width:95%;display:flex;margin-bottom:10px">\
            <a class="btn btn-md btn-primary green-a" style="width: 14.5%;height: 20px;background:#404040">\
                <div>\
                    <p class="ellipsis-text" style="font-weight: normal;">Diagnostico</p>\
                </div>\
            </a>\
            <select style="width:85%; height: 30px;background:#fff;border:2px solid" class="" id="idinforme_medico" name="idinforme_medico" onchange="mostrarInformeMedico(this.value)"></select>\
        </div>\
        <div style="width:100%;margin-bottom:10px;display:none;" id="infon_diagnostico">\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Examenes realizados:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Fecha de lesion:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Contexto:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Zona afectada:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Recidiva:</span> asdasddasda </div>\
        </div>'
};

var html_atencion_control_medico={
    parte_1:'\
    <div style="width:100%;">\
        <div style="box-sizing: border-box;width: 35%;height: 377px;float: left;margin-left: 1%;">\
            <div style="font-size: 12px;margin-bottom: 5px;">Examen fisico</div>\
            <textarea type="text" style="width:100%;height: 323px;background:#fff;text-align:left;border:2px solid #d2d2d2;resize:none" class=" " id="examen_fisico" name="examen_fisico"></textarea>\
        </div>\
        <div style="box-sizing: border-box;width: 35%;height: 377px;float: left;margin-left: 3%;">\
            <div style="font-size: 12px;margin-bottom: 5px;">Observaciones / Indicaciones / Evolución del jugador</div>\
            <textarea type="text" style="width:100%;height: 323px;background:#fff;text-align:left;border:2px solid #d2d2d2;resize:none" class=" " id="observacion" name="observacion"></textarea>\
        </div>\
        <div class="tarjeta" style="height: 290px;margin-left: 3%;background: #fff0;width: 22%;float: left;">\
            <div class="cabezera_tarjeta cabezera_tarjeta_roja" >\
                <span>Se recomienda</span>\
            </div>\
            <div class="cuerpo_tarjerta" style="overflow: auto;overflow-x: hidden;height: 325px;">\
                <div style="width:100%;height:auto;display:block;padding-top:15px;" id="contenedor_radios_sesion">\
                </div>\
            </div>\
        </div>\
    </div>\
        <div style="box-sizing:border-box;width:100%;clear: both;display:inline-flex;flex-wrap:wrap;flex-direction:row;">\
            <div style="width: 97%;margin-top: 35px;margin-left: 2%;box-sizing: border-box;color: #555;font-weight: bold;font-size: 13px;">ACTUALIZACIÓN DEL ESTADO DEL JUGADOR</div>\
            <div style="width: 25%;margin-left: 2%;display:flex;margin-bottom:10px">\
                <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#df4f4f;border:2px solid #555;padding-bottom: 2px;">\
                    <div>\
                        <p class="ellipsis-text" style="font-weight: normal;">Estado</p>\
                    </div>\
                </a>\
                <select style="width:45%;background:#fff;border:2px solid;margin:0" class="" id="estado_jugador" name="estado_jugador">\
                    <option value="0">Seleccione</option>\
                    <option value="1">Apto para jugar</option>\
                    <option value="2">Apto para entrenar</option>\
                    <option value="3">En reintegro deportivo</option>\
                    <option value="4">En rehabilitación kinésica</option>\
                    <option value="5">En espera de revisión médica</option>\
                    <option value="6">En espera de resultado de examenes</option>\
                    <option value="7">En post operatorio</option>\
                    <option value="8">En espera de cirugia</option>\
                    <option value="9">En reposo</option>\
                </select>\
            </div>\
            <div style="width: 35%;margin-left: 5%;display:flex;margin-bottom:10px">\
                <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#df4f4f;border:2px solid #555;padding-bottom: 2px;">\
                    <div>\
                        <p class="ellipsis-text" style="font-weight: normal;">Fecha estimada para el alta medica</p>\
                    </div>\
                </a>\
                <input readonly="" style="box-sizing:border-box;width:50%;height:30px;border:2px solid;background-color:#fff;" type="text" class="" id="fecha_alta" name="fecha_alta">\
            </div>\
        </div>\
        <div style="width:95%;height:250px;margin-top:35px;margin-left: 2%;box-sizing: border-box;">\
            <textarea id="indicaciones" name="indicaciones" style="width:100%;height:100%;border-radius: 0px 0px 5px 5px;resize: none;box-sizing: border-box;border: 2px solid #d2d2d2;"></textarea>\
        </div>\
        <div class="row-fluid">\
            <div class="span12"  style=" margin-top: 20px;">\
                <center>\
                    <button type="button" ng-disabled="" disabled="disabled" class="boton_guardar_informe" onClick="mostrarModalFormularioEnviarDatos();" id="boton_agregar_infrome"><i class="icon-save"></i> GUARDAR INFORME</button>\
                </center>\
            </div>\
        </div>',
    parte_2:'\
        <div style="margin-right:2.5%;width:29.96%;display:flex;margin-bottom:10px">\
            <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040">\
                <div>\
                    <p class="ellipsis-text" style="font-weight: normal;">*N° Sesión</p>\
                </div>\
            </a>\
            <select style="width:50%; height: 30px;background:#fff;border:2px solid" class="" id="numero_sesiones" name="numero_sesiones" onchange="validarFormulario()">\
            </select>\
        </div>\
        <div style="margin-right:2.5%;width:29.96%;display:flex;margin-bottom:10px">\
            <a class="btn btn-md btn-primary green-a" style="width: 50%;height: 20px;background:#404040">\
                <div>\
                    <p class="ellipsis-text" style="font-weight: normal;">*Asistencia</p>\
                </div>\
            </a>\
            <select style="width:50%; height: 30px;background:#fff;border:2px solid" class="" id="asistencia_control" name="asistencia_control" onchange="validarFormulario()">\
                <option value="1">Presente</option>\
                <option value="0">Ausente</option>\
                <option value="2">No avisa</option>\
                <option value="3">Avisa</option>\
            </select>\
        </div>\
        <div style="margin-right:2.5%;width:95%;display:flex;margin-bottom:10px">\
            <a class="btn btn-md btn-primary green-a" style="width: 14.5%;height: 20px;background:#404040">\
                <div>\
                    <p class="ellipsis-text" style="font-weight: normal;">Diagnostico</p>\
                </div>\
            </a>\
            <select style="width:85%; height: 30px;background:#fff;border:2px solid" class="" id="idinforme_medico" name="idinforme_medico" onchange="mostrarInformeMedico(this.value)"></select>\
        </div>\
        <div style="width:100%;margin-bottom:10px;display:none;" id="infon_diagnostico">\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Examenes realizados:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Fecha de lesion:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Contexto:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Zona afectada:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Recidiva:</span> asdasddasda </div>\
        </div>'
};

// Indicaciones / Detalles textarea
var html_atencion_alta_medica={
    parte_1:'\
    <div style="width:100%;">\
        <div class="tarjeta" style="margin-left:19%;height: 237px;background: #fff;margin-right: 1%;">\
            <div class="cabezera_tarjeta cabezera_tarjeta_roja">\
                <span>*Recomendaciones de Alta</span>\
            </div>\
            <div class="cuerpo_tarjerta" style="overflow: auto;overflow-x: hidden;height: 105%;background: #ff000000;">\
                <div>\
                    <label for="recomendacion_alta_4" style="font-size:12px"><input type="checkbox"  name="array_recomendacion_alta[]" id="recomendacion_alta_4" value="4" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="validarFormulario()"/>Derivado al trabajo con readaptacion</label>\
                    <label for="recomendacion_alta_5" style="font-size:12px"><input type="checkbox"  name="array_recomendacion_alta[]" id="recomendacion_alta_5" value="5" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="validarFormulario()"/>Kinesiologia completa</label>\
                    <label for="recomendacion_alta_6" style="font-size:12px"><input type="checkbox"  name="array_recomendacion_alta[]" id="recomendacion_alta_6" value="6" style="margin-left:5px;margin-right:5px;margin-top:0px;" onchange="validarFormulario()"/>Reevaluación médica</label>\
                </div>\
            </div>\
        </div>\
        <div class="tarjeta_cuerpo_leciones" style="width:42%;height: 238px;">\
            <div class="cabezera_tarjeta cabezera_tarjeta_gris">\
                <span>Recomendaciones Médicas</span>\
            </div>\
            <div style="width:100%;height:250px;overflow: auto;overflow-x: hidden;">\
                <textarea id="recomendacion_medica" name="recomendacion_medica" onKeyup="validarFormulario()" onKedown="validarFormulario()" style="width:97%;height:194px;border-radius: 0px 0px 5px 5px;resize: none;margin:0px;"></textarea>\
            </div>\
        </div>\
        <div class="row-fluid">\
            <div class="span12"  style=" margin-top: 20px;">\
                <center>\
                    <button type="button" ng-disabled="" disabled="disabled" class="boton_guardar_informe" onClick="mostrarModalFormularioEnviarDatos();" id="boton_agregar_infrome"><i class="icon-save"></i> GUARDAR INFORME</button>\
                </center>   \
            </div>\
        </div>\
    </div>',
    parte_2:'\
    <div style="margin-right:2.5%;width:100%;display:flex;margin-bottom:10px">\
            <a class="btn btn-md btn-primary green-a" style="width: 14%;height: 20px;background:#404040">\
                <div>\
                    <p class="ellipsis-text" style="font-weight: normal;">Diagnostico</p>\
                </div>\
            </a>\
            <select style="width:85%; height: 30px;background:#fff;border:2px solid" class="" id="idinforme_medico" name="idinforme_medico" onchange="mostrarInformeMedico(this.value)">\
            </select>\
        </div>\
        <div style="width:100%;margin-bottom:10px;display:none;" id="infon_diagnostico">\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Examenes realizados:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Fecha de lesion:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Contexto:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Zona afectada:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Recidiva:</span> asdasddasda </div>\
        </div>'
};


var html_atencion_alta_deportiva={
    parte_1:'\
    <div style="width:100%;">\
        <div class="span3" style="display: flex;">\
            <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#404040"><div><p class="ellipsis-text" style="font-weight: normal;">Alta Deportiva</p></div></a>\
            <div class="btn-group c_objetivo_fisico " style="width: 50%;">\
                <button id="boton_alta_deportiva" type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" onclick="renderizarCheckboxAltaDeportiva()" style="width: 100%;height: 30px;border-radius: 0;border: 2px solid #404040; background-color: #fff;">\
                    <p id="alta_deportiva" class="titulo_multi ellipsis-text">\
                        <span id="texto_boton_alta_deportiva">Seleccione una alta deportiva</span>\
                    </p> \
                    <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span>\
                </button>\
                <ul id="tipo_alta_deportiva" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>\
            </div>\
        </div>\
        <div class="tarjeta" style="margin-left:5%;height: 290px;margin-right: 1%;">\
            <div class="cabezera_tarjeta cabezera_tarjeta_roja">\
                <span>*Recomendaciones de Alta</span>\
            </div>\
            <div class="cuerpo_tarjerta" style="overflow: auto;overflow-x: hidden;height: 88%;">\
                <div>\
                <label for="recomendacion_alta_1" style="font-size:12px"><input type="checkbox"  name="array_recomendacion_alta[]" id="recomendacion_alta_1" value="1" style="margin-left:5px;margin-right:5px;margin-top:0px" onchange="validarFormulario()"/>Continuar el trabajo con readaptacion</label>\
                <label for="recomendacion_alta_2" style="font-size:12px"><input type="checkbox"  name="array_recomendacion_alta[]" id="recomendacion_alta_2" value="2" style="margin-left:5px;margin-right:5px;margin-top:0px" onchange="validarFormulario()"/>Reevaluación Fisica</label>\
                <label for="recomendacion_alta_3" style="font-size:12px"><input type="checkbox"  name="array_recomendacion_alta[]" id="recomendacion_alta_3" value="3" style="margin-left:5px;margin-right:5px;margin-top:0px" onchange="validarFormulario()"/>Debe realizar trabajo diferenciado</label>\
                </div>\
            </div>\
        </div>\
        <div class="tarjeta_cuerpo_leciones" style="width:42%;">\
            <div class="cabezera_tarjeta cabezera_tarjeta_gris">\
                <span>Recomendaciones Readaptadores</span>\
            </div>\
            <div style="width:100%;height:255px;overflow: auto;overflow-x: hidden;">\
                <textarea id="recomendacion_readaptadores" name="recomendacion_readaptadores" onKeyup="validarFormulario()" onKeydown="validarFormulario()" style="width:96.9%;height:245px;border-radius: 0px 0px 5px 5px;resize: none;margin:0px;"></textarea>\
            </div>\
        </div>\
        <div class="row-fluid">\
            <div class="span12"  style=" margin-top: 20px;">\
                <center>\
                    <button type="button" ng-disabled="" disabled="disabled" class="boton_guardar_informe" onClick="mostrarModalFormularioEnviarDatos();" id="boton_agregar_infrome"><i class="icon-save"></i> GUARDAR INFORME</button>\
                </center>\
            </div>\
        </div>\
    </div>',
    parte_2:'\
    <div style="margin-right:2.5%;width:100%;display:flex;margin-bottom:10px">\
            <a class="btn btn-md btn-primary green-a" style="width: 14%;height: 20px;background:#404040">\
                <div>\
                    <p class="ellipsis-text" style="font-weight: normal;">Diagnostico</p>\
                </div>\
            </a>\
            <select style="width:85%; height: 30px;background:#fff;border:2px solid" class="" id="idinforme_medico" name="idinforme_medico" onchange="mostrarInformeMedico(this.value)">\
            </select>\
        </div>\
        <div style="width:100%;margin-bottom:10px;display:none;" id="infon_diagnostico">\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Examenes realizados:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Fecha de lesion:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Contexto:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Zona afectada:</span> asdasddasda </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Recidiva:</span> asdasddasda </div>\
        </div>'
};


var lista_contexto_incidente_modal=[];

var lista_tratamiento_aplicado_modal=[];

var lista_trabajo_readaptador_modal=[];

var lista_sesion_actual=[];

var lista_sesion_siguiente=[];

var lista_recomendacion_alta=[];

var lista_alta_deportiva=[];



function consultarTratamiento2(){
    window.lista_tratamiento_aplicado=[];
    $.ajax({
        url: 'post/atencion_diaria_federacion_consultar_tratamiento.php',
        type: "post",
        success: function(respuesta) {
            $("#contenedor_tratamiento").empty();
            let json=JSON.parse(respuesta);
            
            for(let contador=0;contador<json.datos.length;contador++){
                window.lista_tratamiento_aplicado_modal.push(json.datos[contador]);
            }
		},error: function(){// will fire when timeout is reached
			// alert("errorXXXXX");
    	}, timeout: 10000 // sets timeout to 3 seconds
	    });
}

function consultarContextosIncidente2(){
    window.lista_contexto_incidente_modal=[];
    $.ajax({
        url: 'post/atencion_diaria_federacion_consultar_contexto_incidente.php',
        type: "post",
        success: function(respuesta) {
            let json=JSON.parse(respuesta);
            window.lista_contexto_incidente_modal=json.respuesta;
		},error: function(){// will fire when timeout is reached
			// alert("errorXXXXX");
    	}, timeout: 10000 // sets timeout to 3 seconds
	    });
}

function consultarTrabajoReadaptador2(){
    window.lista_trabajo_readaptador_modal=[];
    $.ajax({
        url: 'post/atencion_diaria_federacion_consultar_trabajo_readaptador.php',
        type: "post",
        success: function(respuesta) {
            let json=JSON.parse(respuesta);
            // console.log(json.datos.length);
            
            for(let contador=0;contador<json.datos.length;contador++){
                window.lista_trabajo_readaptador_modal.push(json.datos[contador]);
            }
		},error: function(){// will fire when timeout is reached
			// alert("errorXXXXX");
    	}, timeout: 10000 // sets timeout to 3 seconds
	});
}

function verAtencionDiaria(posicion){
    let atencion_diaria=window.busqueda_respuesta_servidor[posicion];
    console.log(atencion_diaria);
    $("#tabla_detalle_atencion_diaria").empty();
    $("#contenedor_foto_jugador").html('<img style="width:100%;height:100%;border-radius: 67px;" src="./foto_jugadores/'+atencion_diaria.idfichaJugador+'.png"/>')
    $("#nombre_jugador").text(atencion_diaria.nombre);
    let texto_serie="";
    if(atencion_diaria.sexo==="1"){
        if(atencion_diaria.serieActual==="99"){
            texto_serie="PRIMER EQUIPO";
        }
        if(atencion_diaria.serieActual!="99"){
            texto_serie="Sub  "+atencion_diaria.serieActual;
        }
    }
    else{
        if(atencion_diaria.serieActual==="99" ){
            texto_serie="ADULTA FEMENINA";
        }
        if(atencion_diaria.serieActual!="99"){
            texto_serie="Sub  "+atencion_diaria.serieActual;
        }
    }
    
    



    // let serie=(atencion_diaria.serieActual==="99")?"Primer equipo":""


    $("#serie_jugador_modal").text(texto_serie);
    switch(atencion_diaria.tipo_atencion_atencion_diaria){
        case "1":$("#tabla_detalle_atencion_diaria").html(tablaNuevoIncidente(atencion_diaria));break;
        case "2":$("#tabla_detalle_atencion_diaria").html(tablaControl(atencion_diaria));break;
        case "3":$("#tabla_detalle_atencion_diaria").html(tablaMedica(atencion_diaria));break;
        case "4":$("#tabla_detalle_atencion_diaria").html(tablaDeportiva(atencion_diaria));break;
    }
    $("#modalVerJugador").modal("show");
}

function tablaNuevoIncidente(atencion_diaria){
    console.log(atencion_diaria)
    let partes_frt = ["","Cara \/ Cabeza","Hombro derecho","Hombro izquierdo","Torax","Brazo Derecho","Brazo izquierdo","Antebrazo Derecho","Antebrazo izquierdo","Abdomen","Mu\u00f1eca Derecha","Mu\u00f1eca izquierda","Manos \/ Dedos Der","Manos \/ Dedos Izq","Cadera \/ Ingle\/ Pelvis","Muslo Anterior Der","Muslo Anterior Izq","Rodilla Derecha","Rodilla Izquierda","Pierna Derecha","Pierna Izquierda","Tobillo Derecho","Tobillo Izquierdo","Pie Derecho","Pie Izquierdo"];
    let partes_bck = ["","Cuello \/ Cervical","Dorsales","Lumbares","Codo Izquierdo","Codo Derecho","Gluteos","Muslo Posterior Izquierdo","Muslo Posterior Derecho","Pantorrilla Izquierda","Pantorrilla Derecha"];
    let partes_frt_encontradas=[];
    let partes_bck_encontradas=[];
    let partes_cuerpo_total=[];
    for(let contador_cuerpo=0;contador_cuerpo<atencion_diaria.lesiones.length;contador_cuerpo++){
        let parte=atencion_diaria.lesiones[contador_cuerpo];
        if(parte.codigo_zonas_lesion.split("-")[0]==="frt"){
            partes_frt_encontradas.push(partes_frt[parseInt(parte.codigo_zonas_lesion.split("-")[1])]);
        }
        else{
            partes_bck_encontradas.push(partes_bck[parseInt(parte.codigo_zonas_lesion.split("-")[1])]);
        }
    }


    let lista_sesion=[
        "Reposo Deportivo",
        "Entrenamiento diferenciado",
        "Alta médica solo para entrenar",
        "Kinesiología",
        "Reaptador",
        "Regenerativo",
        "Reposo total",
        "Derivado a relizar examenes",
        "Derivado a urgencias",
        "Alta médica para partidos y entrenamientos",
        "Citado a Médico",
        "Citado a Médico para Alta",
        "Reintegro deportivo progresivo"
    ];

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

    let tipo_atencion=[
        "Nuevo incidente",
        "Control",
        "Medica",
        "Deportiva"
    ];

    let ano=atencion_diaria.fecha_atencion_diaria.split("-")[0];
    let mes=atencion_diaria.fecha_atencion_diaria.split("-")[1];
    let dia=atencion_diaria.fecha_atencion_diaria.split("-")[2];
    let fecha_atencion=new Date();
    fecha_atencion.setDate(parseInt(dia));
    fecha_atencion.setMonth(parseInt(mes)-1);
    fecha_atencion.setFullYear(parseInt(ano));

    let fecha_atencion_diaria_modificada=dia_semana[fecha_atencion.getDay()]+' '+fecha_atencion.getDate()+' de '+lista_meses[fecha_atencion.getMonth()]+' '+fecha_atencion.getFullYear();

    let ano2=atencion_diaria.fecha_incidente_atencion_diaria.split("-")[0];
    let mes2=atencion_diaria.fecha_incidente_atencion_diaria.split("-")[1];
    let dia2=atencion_diaria.fecha_incidente_atencion_diaria.split("-")[2];
    let fecha_incidente=new Date();
    fecha_incidente.setDate(parseInt(dia2));
    fecha_incidente.setMonth(parseInt(mes2)-1);
    fecha_incidente.setFullYear(parseInt(ano2));
    // alert(fecha_incidente.getMonth())
    // alert(fecha_incidente.getDay())

    let fecha_incidente_atencion_diaria_modificada=dia_semana[fecha_incidente.getDay()]+' '+fecha_incidente.getDate()+' de '+lista_meses[fecha_incidente.getMonth()]+' '+fecha_incidente.getFullYear();
    atencion_diaria.lista_tratamiento=[];
    for(let contador_0=0;contador_0<atencion_diaria.tratamiento_aplicado.length;contador_0++){
        let tratamiento=atencion_diaria.tratamiento_aplicado[contador_0];
        let tratamiento_filtrados=window.lista_tratamiento_aplicado_modal.filter((tratamiento_filtrado)=> tratamiento.nombre_tratamiento_atencion_diaria===tratamiento_filtrado.idtratamiento_aplicado);
        atencion_diaria.lista_tratamiento.push(tratamiento_filtrados[0].nombre_tratamiento_aplicado);
    }
    atencion_diaria.contexto="";
    for(let contador_1=0;contador_1<lista_contexto_incidente_modal.length;contador_1++){
        let contexto=lista_contexto_incidente_modal[contador_1];
        if(contexto.idcontexto_incidente===atencion_diaria.idcontexto_incidente){
            atencion_diaria.contexto=contexto.nombre_contexto_incidente;
        }
    }
    atencion_diaria.lista_trbajo_readaptador=[];
    for(let contador_2=0;contador_2<atencion_diaria.trabajo_readaptor.length;contador_2++){
        let trabajo_readaptador=atencion_diaria.trabajo_readaptor[contador_2];
        let trabajo_readaptador_filtrados=lista_trabajo_readaptador_modal.filter((trabajo_re=> trabajo_readaptador.trabajo_readaptador_atencion_diaria===trabajo_re.idtrabajo_readatador));
        atencion_diaria.lista_trbajo_readaptador.push(trabajo_readaptador_filtrados[0].trabajo_readatador);
    }
    let fecha_recomendacion_sesion_actual="";
    if(atencion_diaria.recomendacion_sesion_actual_atencion_diaria==="1" || atencion_diaria.recomendacion_sesion_actual_atencion_diaria==="7"){
        let ano3=atencion_diaria.fecha_recomendacion_sesion_actual_atencion_diaria.split("-")[0];
        let mes3=atencion_diaria.fecha_recomendacion_sesion_actual_atencion_diaria.split("-")[1];
        let dia3=atencion_diaria.fecha_recomendacion_sesion_actual_atencion_diaria.split("-")[2];
        let fecha_sesion_actual=new Date();
        fecha_sesion_actual.setDate(parseInt(dia3));
        fecha_sesion_actual.setMonth(parseInt(mes3)-1);
        fecha_sesion_actual.setFullYear(parseInt(ano3));

        let fecha_sesion_actual_modificada=dia_semana[fecha_sesion_actual.getDay()]+' '+fecha_sesion_actual.getDate()+' de '+lista_meses[fecha_sesion_actual.getMonth()]+' '+fecha_sesion_actual.getFullYear();
        
        
        fecha_recomendacion_sesion_actual=", "+fecha_sesion_actual_modificada;
    }
    
    let fecha_recomendacion_sesion_siguiente="";
    if(atencion_diaria.recomendacion_sesion_siguiente_atencion_diaria ==="1" || atencion_diaria.recomendacion_sesion_siguiente_atencion_diaria ==="7"){
        let ano4=atencion_diaria.fecha_recomendacion_sesion_siguiente_atencion_diairai.split("-")[0];
        let mes4=atencion_diaria.fecha_recomendacion_sesion_siguiente_atencion_diairai.split("-")[1];
        let dia4=atencion_diaria.fecha_recomendacion_sesion_siguiente_atencion_diairai.split("-")[2];
        let fecha_sesion_siguiente=new Date();
        fecha_sesion_siguiente.setDate(parseInt(dia4));
        fecha_sesion_siguiente.setMonth(parseInt(mes4)-1);
        fecha_sesion_siguiente.setFullYear(parseInt(ano4));

        let fecha_sesion_siguiente_modificada=dia_semana[fecha_sesion_siguiente.getDay()]+' '+fecha_sesion_siguiente.getDate()+' de '+lista_meses[fecha_sesion_siguiente.getMonth()]+' '+fecha_sesion_siguiente.getFullYear();
        
        fecha_recomendacion_sesion_siguiente=", "+fecha_sesion_siguiente_modificada;
    }

    const lista_examenes=[
            {idExamen:1,examen:"Resonancia Magenética"},
            {idExamen:2,examen:"Radiografía"},
            {idExamen:3,examen:"Scanner / TAC"},
            {idExamen:4,examen:"Artroscopia"},
            {idExamen:5,examen:"Ecotomografía"},
            {idExamen:6,examen:"Fisico"},
            {idExamen:7,examen:"Clinico"},
            {idExamen:0,examen:"Ninguno"}
    ];

    let valor_ninguno=false;
    let lista_examenes_busqueda=[];
    if(atencion_diaria.examen_solicitados_atencion_diaria==="1"){
        valor_ninguno=true;
        for(let contador_examenes=0;contador_examenes<atencion_diaria.examenes_solicitados.length;contador_examenes++){
            let examen=atencion_diaria.examenes_solicitados[contador_examenes];
            examenes_filtrados=lista_examenes.filter(examen_filtro => examen_filtro.idExamen===parseInt(examen.nombre_examen_atencion_diaria));
            lista_examenes_busqueda.push(examenes_filtrados[0].examen);
        }
    }
    // partes_bck_encontradas
    let lista_partes_frt="";
    if(partes_frt_encontradas.length>1){
        if(partes_bck_encontradas.length>1 || partes_bck_encontradas.length===1){
            lista_partes_frt=partes_frt_encontradas.join(",")+',';
        }
        else{
            lista_partes_frt=partes_frt_encontradas.join(",");
        }
        
    }
    else{
        if(partes_frt_encontradas.length===1){
            if(partes_bck_encontradas.length>1 || partes_bck_encontradas.length===1){
                lista_partes_frt=partes_frt_encontradas[0]+',';
            }
            else{
                lista_partes_frt=partes_frt_encontradas[0];
            }
            
        }
        else{
            lista_partes_frt="";
        }
    }
    let lista_partes_bck="";
    if(partes_bck_encontradas.length>1){
        lista_partes_bck=partes_bck_encontradas.join(",");
    }
    else{
        if(partes_bck_encontradas.length===1){
            lista_partes_bck=partes_bck_encontradas[0];
        }
        else{
            lista_partes_bck="";
        }
    }



    const template='\
    <div class="row_tabla">\
        <span class="celda_propiedad">Jugador Atendido</span>\
        <span class="celda_valor">'+atencion_diaria.nombre+' '+atencion_diaria.apellido1+' '+atencion_diaria.apellido2+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Serie</span>\
        <span class="celda_valor">Sub  '+atencion_diaria.serieActual+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Fecha Atencion</span>\
        <span class="celda_valor">'+fecha_atencion_diaria_modificada+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Tipo atención</span>\
        <span class="celda_valor">'+tipo_atencion[parseInt(atencion_diaria.tipo_atencion_atencion_diaria)-1]+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Contexto</span>\
        <span class="celda_valor">'+atencion_diaria.contexto+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Fecha incidente</span>\
        <span class="celda_valor">'+fecha_incidente_atencion_diaria_modificada+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Diagnostico</span>\
        <span class="celda_valor">'+atencion_diaria.diagnostico_atencion_diaria+'</span>\
    </div>\
    <div class="row_tabla" style="height:100px">\
        <span class="celda_propiedad" style="padding-top: 41px;">Anamnesis</span>\
        <span class="celda_valor">'+atencion_diaria.anamnesis_atencion_diaria+'</span>\
    </div>\
    <div class="row_tabla" style="height:auto;">\
        <span class="celda_propiedad" style="height:auto;background-color:#ec7d7c;">Derivado a seguro</span>\
        <span class="celda_valor" style="height:auto;">'+((atencion_diaria.derivado_seguro_atencion_diaria==="1")?"Si":"No")+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad" style="height:auto;background-color:#ec7d7c;">Examenes solicitados</span>\
        <span class="celda_valor" style="height:auto;">'+((valor_ninguno)?lista_examenes_busqueda.join(", "):"Ninguno")+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad" style="height:auto;background-color:#ec7d7c;">Zonas Afectadas</span>\
        <span class="celda_valor" style="height:auto;">'+lista_partes_frt+''+lista_partes_bck+' </span>\
    </div>\
    <div class="row_tabla" style="height:auto;">\
        <span class="celda_propiedad" style="height:auto;background-color:#ec7d7c;">Tratamiento realizado</span>\
        <span class="celda_valor" style="height:auto;">'+((atencion_diaria.lista_tratamiento.length>1)?atencion_diaria.lista_tratamiento.join(", "):atencion_diaria.lista_tratamiento[0] )+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad" style="background-color:#ec7d7c;">Recomendación actual</span>\
        <span class="celda_valor">'+lista_sesion[parseInt(atencion_diaria.recomendacion_sesion_actual_atencion_diaria)-1]+''+fecha_recomendacion_sesion_actual+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad" style="background-color:#ec7d7c;">Recomendación proxima sesion</span>\
        <span class="celda_valor">'+lista_sesion[parseInt(atencion_diaria.recomendacion_sesion_siguiente_atencion_diaria)-1]+''+fecha_recomendacion_sesion_siguiente+'</span>\
    </div>';
    return template;
}

function tablaControl(atencion_diaria){
    let informe_medico=atencion_diaria.informes_medicos.filter(informe => informe.idinforme_medico===atencion_diaria.idinforme_medico);

    let lista_sesion=[
        "Reposo Deportivo",
        "Entrenamiento diferenciado",
        "Alta médica solo para entrenar",
        "Kinesiología",
        "Reaptador",
        "Regenerativo",
        "Reposo total",
        "Derivado a relizar examenes",
        "Derivado a urgencias",
        "Alta médica para partidos y entrenamientos",
        "Citado a Médico",
        "Citado a Médico para Alta",
        "Reintegro deportivo progresivo"
    ];

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

    let tipo_atencion=[
        "Nuevo incidente",
        "Control",
        "Medica",
        "Deportiva"
    ];

    let ano=atencion_diaria.fecha_atencion_diaria.split("-")[0];
    let mes=atencion_diaria.fecha_atencion_diaria.split("-")[1];
    let dia=atencion_diaria.fecha_atencion_diaria.split("-")[2];
    let fecha_atencion=new Date();
    fecha_atencion.setDate(parseInt(dia));
    fecha_atencion.setMonth(parseInt(mes)-1);
    fecha_atencion.setFullYear(parseInt(ano));

    let fecha_atencion_diaria_modificada=dia_semana[fecha_atencion.getDay()]+' '+fecha_atencion.getDate()+' de '+lista_meses[fecha_atencion.getMonth()]+' '+fecha_atencion.getFullYear();

    let ano2=informe_medico[0].agregado_fecha_lesion.split("-")[0];
    let mes2=informe_medico[0].agregado_fecha_lesion.split("-")[1];
    let dia2=informe_medico[0].agregado_fecha_lesion.split("-")[2];
    let fecha_lesion=new Date();
    fecha_lesion.setDate(parseInt(dia2));
    fecha_lesion.setMonth(parseInt(mes2)-1);
    fecha_lesion.setFullYear(parseInt(ano2));

    let fecha_lesion_informe=dia_semana[fecha_lesion.getDay()]+' '+fecha_lesion.getDate()+' de '+lista_meses[fecha_lesion.getMonth()]+' '+fecha_lesion.getFullYear();



    atencion_diaria.lista_tratamiento=[];
    for(let contador_0=0;contador_0<atencion_diaria.tratamiento_aplicado.length;contador_0++){
        let tratamiento=atencion_diaria.tratamiento_aplicado[contador_0];
        let tratamiento_filtrados=window.lista_tratamiento_aplicado_modal.filter((tratamiento_filtrado)=> tratamiento.nombre_tratamiento_atencion_diaria===tratamiento_filtrado.idtratamiento_aplicado);
        atencion_diaria.lista_tratamiento.push(tratamiento_filtrados[0].nombre_tratamiento_aplicado);
    }
    atencion_diaria.contexto="";
    for(let contador_1=0;contador_1<lista_contexto_incidente_modal.length;contador_1++){
        let contexto=lista_contexto_incidente_modal[contador_1];
        if(contexto.idcontexto_incidente===atencion_diaria.idcontexto_incidente){
            atencion_diaria.contexto=contexto.nombre_contexto_incidente;
        }
    }
    atencion_diaria.lista_trbajo_readaptador=[];
    for(let contador_2=0;contador_2<atencion_diaria.trabajo_readaptor.length;contador_2++){
        let trabajo_readaptador=atencion_diaria.trabajo_readaptor[contador_2];
        let trabajo_readaptador_filtrados=lista_trabajo_readaptador_modal.filter((trabajo_re=> trabajo_readaptador.trabajo_readaptador_atencion_diaria===trabajo_re.idtrabajo_readatador));
        atencion_diaria.lista_trbajo_readaptador.push(trabajo_readaptador_filtrados[0].trabajo_readatador);
    }
    let fecha_recomendacion_sesion_actual="";
    if(atencion_diaria.recomendacion_sesion_actual_atencion_diaria==="1" || atencion_diaria.recomendacion_sesion_actual_atencion_diaria==="7"){
        let ano3=atencion_diaria.fecha_recomendacion_sesion_actual_atencion_diaria.split("-")[0];
        let mes3=atencion_diaria.fecha_recomendacion_sesion_actual_atencion_diaria.split("-")[1];
        let dia3=atencion_diaria.fecha_recomendacion_sesion_actual_atencion_diaria.split("-")[2];
        let fecha_sesion_actual=new Date();
        fecha_sesion_actual.setDate(parseInt(dia3));
        fecha_sesion_actual.setMonth(parseInt(mes3)-1);
        fecha_sesion_actual.setFullYear(parseInt(ano3));

        let fecha_sesion_actual_modificada=dia_semana[fecha_sesion_actual.getDay()]+' '+fecha_sesion_actual.getDate()+' de '+lista_meses[fecha_sesion_actual.getMonth()]+' '+fecha_sesion_actual.getFullYear();
        
        
        fecha_recomendacion_sesion_actual=", "+fecha_sesion_actual_modificada;
    }
    
    let fecha_recomendacion_sesion_siguiente="";
    if(atencion_diaria.recomendacion_sesion_siguiente_atencion_diaria ==="1" || atencion_diaria.recomendacion_sesion_siguiente_atencion_diaria ==="7"){
        let ano4=atencion_diaria.fecha_recomendacion_sesion_siguiente_atencion_diairai.split("-")[0];
        let mes4=atencion_diaria.fecha_recomendacion_sesion_siguiente_atencion_diairai.split("-")[1];
        let dia4=atencion_diaria.fecha_recomendacion_sesion_siguiente_atencion_diairai.split("-")[2];
        let fecha_sesion_siguiente=new Date();
        fecha_sesion_siguiente.setDate(parseInt(dia4));
        fecha_sesion_siguiente.setMonth(parseInt(mes4)-1);
        fecha_sesion_siguiente.setFullYear(parseInt(ano4));

        let fecha_sesion_siguiente_modificada=dia_semana[fecha_sesion_siguiente.getDay()]+' '+fecha_sesion_siguiente.getDate()+' de '+lista_meses[fecha_sesion_siguiente.getMonth()]+' '+fecha_sesion_siguiente.getFullYear();
        
        fecha_recomendacion_sesion_siguiente=", "+fecha_sesion_siguiente_modificada;
    }

    const template='\
    <div class="row_tabla">\
        <span class="celda_propiedad">Jugador Atendido</span>\
        <span class="celda_valor">'+atencion_diaria.nombre+' '+atencion_diaria.apellido1+' '+atencion_diaria.apellido2+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Serie</span>\
        <span class="celda_valor">Sub  '+atencion_diaria.serieActual+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Fecha Atencion</span>\
        <span class="celda_valor">'+fecha_atencion_diaria_modificada+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Tipo atención</span>\
        <span class="celda_valor">'+tipo_atencion[parseInt(atencion_diaria.tipo_atencion_atencion_diaria)-1]+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">N° sesiones</span>\
        <span class="celda_valor">'+atencion_diaria.numero_sesion+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Diagnostico</span>\
        <span class="celda_valor">'+informe_medico[0].diagnostico+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Fecha lesion</span>\
        <span class="celda_valor">'+fecha_lesion_informe+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Zona Afectada</span>\
        <span class="celda_valor">'+informe_medico[0].agregado_localizacion_lesion+'</span>\
    </div>\
    <div class="row_tabla" style="height:auto;">\
        <span class="celda_propiedad" style="height:auto;background-color:#ec7d7c;">Tratamiento realizado</span>\
        <span class="celda_valor" style="height:auto;">'+((atencion_diaria.lista_tratamiento.length>1)?atencion_diaria.lista_tratamiento.join(", "):atencion_diaria.lista_tratamiento[0])+'</span>\
    </div>\
    <div class="row_tabla" style="height:auto;">\
        <span class="celda_propiedad" style="height:auto;background-color:#ec7d7c;">Trabajo readaptor</span>\
        <span class="celda_valor" style="height:auto;">'+((atencion_diaria.lista_trbajo_readaptador.length>1)?atencion_diaria.lista_trbajo_readaptador.join(", "):atencion_diaria.lista_trbajo_readaptador[0])+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad" style="background-color:#ec7d7c;">% de recuperación</span>\
        <span class="celda_valor">'+atencion_diaria.porcentaje_recuperacion+'%</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad" style="background-color:#ec7d7c;">Recomendación actual</span>\
        <span class="celda_valor">'+lista_sesion[parseInt(atencion_diaria.recomendacion_sesion_actual_atencion_diaria)-1]+''+fecha_recomendacion_sesion_actual+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad" style="background-color:#ec7d7c;">Recomendación proxima sesion</span>\
        <span class="celda_valor">'+lista_sesion[parseInt(atencion_diaria.recomendacion_sesion_siguiente_atencion_diaria)-1]+''+fecha_recomendacion_sesion_siguiente+'</span>\
    </div>';
    return template;

}

function tablaMedica(atencion_diaria){
    let informe_medico=atencion_diaria.informes_medicos.filter(informe => informe.idinforme_medico===atencion_diaria.idinforme_medico);
    let lista_recomendacion_alta=[
        {codigo:"1",valor:"Continuar el trabajo con readaptacion"},
        {codigo:"2",valor:"Reevaluación Fisica"},
        {codigo:"3",valor:"Debe realizar trabajo diferenciado"},
        {codigo:"4",valor:"Derivado al trabajo con readaptacion"},
        {codigo:"5",valor:"Kinesiologia completa"},
        {codigo:"6",valor:"Reevaluación médica"},
    ];

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

    let tipo_atencion=[
        "Nuevo incidente",
        "Control",
        "Medica",
        "Deportiva"
    ];
    // recomendacion_alta_atencion_diaria 

    atencion_diaria.recomendaciones_alta=[];
    for(let contador=0;contador<atencion_diaria.recomendacion_alta.length;contador++){
        let recomendacion=atencion_diaria.recomendacion_alta[contador];
        let recomendaciones_filtradas=lista_recomendacion_alta.filter(recomendacion_filtro => recomendacion_filtro.codigo===recomendacion.recomendacion_alta_atencion_diaria);
        atencion_diaria.recomendaciones_alta.push(recomendaciones_filtradas[0].valor);

    }

    let ano=atencion_diaria.fecha_atencion_diaria.split("-")[0];
    let mes=atencion_diaria.fecha_atencion_diaria.split("-")[1];
    let dia=atencion_diaria.fecha_atencion_diaria.split("-")[2];
    let fecha_atencion=new Date();
    fecha_atencion.setDate(parseInt(dia));
    fecha_atencion.setMonth(parseInt(mes)-1);
    fecha_atencion.setFullYear(parseInt(ano));

    let fecha_atencion_diaria_modificada=dia_semana[fecha_atencion.getDay()]+' '+fecha_atencion.getDate()+' de '+lista_meses[fecha_atencion.getMonth()]+' '+fecha_atencion.getFullYear();


    const template='\
    <div class="row_tabla">\
        <span class="celda_propiedad">Jugador Atendido</span>\
        <span class="celda_valor">'+atencion_diaria.nombre+' '+atencion_diaria.apellido1+' '+atencion_diaria.apellido2+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Serie</span>\
        <span class="celda_valor">Sub  '+atencion_diaria.serieActual+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Diagnostico</span>\
        <span class="celda_valor">'+informe_medico[0].diagnostico+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Fecha Atencion</span>\
        <span class="celda_valor">'+fecha_atencion_diaria_modificada+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Localización de la lesion</span>\
        <span class="celda_valor">'+informe_medico[0].agregado_localizacion_lesion+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Derivado seguro</span>\
        <span class="celda_valor">'+((informe_medico[0].agregado_seguro_medico==="1")?"Si":"No")+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Examenes realizados</span>\
        <span class="celda_valor">'+informe_medico[0].agregado_examenes_realizados+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Dias de baja</span>\
        <span class="celda_valor">'+informe_medico[0].agregado_dias_de_baja+' '+((informe_medico[0].agregado_dias_de_baja>1)?"días":"día")+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">N° sesiones</span>\
        <span class="celda_valor">'+((atencion_diaria.numero_sesion!==null)?atencion_diaria.numero_sesion:"no tiene ninguna sesion")+'</span>\
    </div>\
    <div class="row_tabla" style="height:auto;">\
        <span class="celda_propiedad" style="height:auto;background-color:#ec7d7c;">Recomendaciones de Alta</span>\
        <span class="celda_valor" style="height:auto;">'+((atencion_diaria.recomendaciones_alta.length>1)?atencion_diaria.recomendaciones_alta.join(", "):atencion_diaria.recomendaciones_alta[0])+'</span>\
    </div>\
    <div class="row_tabla" style="height:100px">\
        <span class="celda_propiedad" style="height:auto;padding-top: 41px;background-color:#ec7d7c;">Observación</span>\
        <span class="celda_valor" style="height:auto;">'+((atencion_diaria.observacion_medica===null)?"Sin observación":atencion_diaria.observacion_medica)+'</span>\
    </div>';
    return template;
}


function tablaDeportiva(atencion_diaria){
    let informe_medico=atencion_diaria.informes_medicos.filter(informe => informe.idinforme_medico===atencion_diaria.idinforme_medico);
    let lista_recomendacion_alta=[
        {codigo:"1",valor:"Continuar el trabajo con readaptacion"},
        {codigo:"2",valor:"Reevaluación Fisica"},
        {codigo:"3",valor:"Debe realizar trabajo diferenciado"},
        {codigo:"4",valor:"Derivado al trabajo con readaptacion"},
        {codigo:"5",valor:"Kinesiologia completa"},
        {codigo:"6",valor:"Reevaluación médica"},
    ];

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

    let tipo_atencion=[
        "Nuevo incidente",
        "Control",
        "Medica",
        "Deportiva"
    ];

    let alta_deportiva=[
        {idalta_deportiva:1,alta_deportiva:"entrenamiento"},
        {idalta_deportiva:2,alta_deportiva:"partido"}
    ];

    // recomendacion_alta_atencion_diaria 

    atencion_diaria.recomendaciones_alta=[];
    for(let contador=0;contador<atencion_diaria.recomendacion_alta.length;contador++){
        let recomendacion=atencion_diaria.recomendacion_alta[contador];
        let recomendaciones_filtradas=lista_recomendacion_alta.filter(recomendacion_filtro => recomendacion_filtro.codigo===recomendacion.recomendacion_alta_atencion_diaria);
        atencion_diaria.recomendaciones_alta.push(recomendaciones_filtradas[0].valor);

    }
    
    let pedaso_html_alta_deportiva="";
    if(atencion_diaria.alta_deportiva.length>0){
        atencion_diaria.lista_alta_deportiva=[];

        for(let contador2=0;contador2<atencion_diaria.alta_deportiva.length;contador2++){

            let alta_deportiva_posision=atencion_diaria.alta_deportiva[contador2];
            let alta_deportiva_filtradas=alta_deportiva.filter(alta_deportiva_filtro => alta_deportiva_filtro.idalta_deportiva===parseInt(alta_deportiva_posision.alta_deportiva_atencion_diaria));
            atencion_diaria.lista_alta_deportiva.push(alta_deportiva_filtradas[0].alta_deportiva);
        }
        pedaso_html_alta_deportiva='\
        <div class="row_tabla" style="height:auto;">\
            <span class="celda_propiedad" style="height:auto;">Alta depotiva para</span>\
            <span class="celda_valor" style="height:auto;">'+((atencion_diaria.lista_alta_deportiva.length>1)?atencion_diaria.lista_alta_deportiva.join(" y "):atencion_diaria.lista_alta_deportiva[0] )+'</span>\
        </div>';
    }
    else{
        pedaso_html_alta_deportiva='\
        <div class="row_tabla" style="height:auto;">\
            <span class="celda_propiedad" style="height:auto;">Alta Deportiva</span>\
            <span class="celda_valor" style="height:auto;">no tiene lata deportiva</span>\
        </div>';
    }
    
    let ano=atencion_diaria.fecha_atencion_diaria.split("-")[0];
    let mes=atencion_diaria.fecha_atencion_diaria.split("-")[1];
    let dia=atencion_diaria.fecha_atencion_diaria.split("-")[2];
    let fecha_atencion=new Date();
    fecha_atencion.setDate(parseInt(dia));
    fecha_atencion.setMonth(parseInt(mes)-1);
    fecha_atencion.setFullYear(parseInt(ano));

    let fecha_atencion_diaria_modificada=dia_semana[fecha_atencion.getDay()]+' '+fecha_atencion.getDate()+' de '+lista_meses[fecha_atencion.getMonth()]+' '+fecha_atencion.getFullYear();


    const template='\
    <div class="row_tabla">\
        <span class="celda_propiedad">Jugador Atendido</span>\
        <span class="celda_valor">'+atencion_diaria.nombre+' '+atencion_diaria.apellido1+' '+atencion_diaria.apellido2+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Serie</span>\
        <span class="celda_valor">Sub  '+atencion_diaria.serieActual+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Diagnostico</span>\
        <span class="celda_valor">'+informe_medico[0].diagnostico+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Fecha Atencion</span>\
        <span class="celda_valor">'+fecha_atencion_diaria_modificada+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Localización de la lesion</span>\
        <span class="celda_valor">'+informe_medico[0].agregado_localizacion_lesion+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Derivado seguro</span>\
        <span class="celda_valor">'+((informe_medico[0].agregado_seguro_medico==="1")?"Si":"No")+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Examenes realizados</span>\
        <span class="celda_valor">'+informe_medico[0].agregado_examenes_realizados+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">Dias de baja</span>\
        <span class="celda_valor">'+informe_medico[0].agregado_dias_de_baja+' '+((informe_medico[0].agregado_dias_de_baja>1)?"días":"día")+'</span>\
    </div>\
    <div class="row_tabla">\
        <span class="celda_propiedad">N° sesiones</span>\
        <span class="celda_valor">'+((atencion_diaria.numero_sesion!==null)?atencion_diaria.numero_sesion:"no tiene ninguna sesion")+'</span>\
    </div>\
    '+pedaso_html_alta_deportiva+'\
    <div class="row_tabla" style="height:auto;">\
        <span class="celda_propiedad" style="height:auto;background-color:#ec7d7c;">Recomendaciones de Alta</span>\
        <span class="celda_valor" style="height:auto;">'+((atencion_diaria.recomendaciones_alta.length>1)?atencion_diaria.recomendaciones_alta.join(", "):atencion_diaria.recomendaciones_alta[0])+'</span>\
    </div>\
    <div class="row_tabla" style="height:100px">\
        <span class="celda_propiedad" style="height:auto;padding-top: 41px;background-color:#ec7d7c;">Recomendaciones readaptador</span>\
        <span class="celda_valor" style="height:auto;">'+((atencion_diaria.observacion_medica===null)?"Sin observación":atencion_diaria.observacion_medica)+'</span>\
    </div>';
    return template;
}

async function descargarPDF(posicion){
    let atencion_diaria=window.busqueda_respuesta_servidor[posicion];
    
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
    let lista_sesion=[
        "Reposo Deportivo",
        "Entrenamiento diferenciado",
        "Alta médica solo para entrenar",
        "Kinesiología",
        "Reaptador",
        "Regenerativo",
        "Reposo total",
        "Derivado a relizar examenes",
        "Derivado a urgencias",
        "Alta médica para partidos y entrenamientos",
        "Citado a Médico",
        "Citado a Médico para Alta",
        "Reintegro deportivo progresivo"
    ];

    let lista_examenes=[
        {codigo:"1",valor:"Resonancia Magenética",},
        {codigo:"2",valor:"Radiografía"},
        {codigo:"3",valor:"Scanner / TAC"},
        {codigo:"4",valor:"Artroscopia"},
        {codigo:"5",valor:"Ecotomografía"},
        {codigo:"6",valor:"Fisico"},
        {codigo:"7",valor:"Clinico"}
    ];

    

    if(atencion_diaria.sexo==="1"){
        if(atencion_diaria.serieActual==="99"){
            texto_serie="PRIMER EQUIPO";
        }
        if(atencion_diaria.serieActual!="99"){
            texto_serie="Sub "+atencion_diaria.serieActual;
        }
    }
    else{
        if(atencion_diaria.serieActual==="99" ){
            texto_serie="ADULTA FEMENINA";
        }
        if(atencion_diaria.serieActual!="99"){
            texto_serie="Sub "+atencion_diaria.serieActual;
        }
    }

    atencion_diaria.texto_serie=texto_serie;


    let lista_recomendacion_alta=[
        {codigo:"1",valor:"Continuar el trabajo con readaptacion"},
        {codigo:"2",valor:"Reevaluación Fisica"},
        {codigo:"3",valor:"Debe realizar trabajo diferenciado"},
        {codigo:"4",valor:"Derivado al trabajo con readaptacion"},
        {codigo:"5",valor:"Kinesiologia completa"},
        {codigo:"6",valor:"Reevaluación médica"},
    ];
    let alta_deportiva=[
        {idalta_deportiva:1,alta_deportiva:"entrenamiento"},
        {idalta_deportiva:2,alta_deportiva:"partido"}
    ];


    let array_contexto=[
            "Partido Oficial",
            "Partido Amistoso",
            "Entrenamiento",
            "Otro"
    ];


    if(atencion_diaria.tipo_atencion_atencion_diaria==="1"){

        atencion_diaria.lista_tratamiento=[];
        for(let contador_0=0;contador_0<atencion_diaria.tratamiento_aplicado.length;contador_0++){
            let tratamiento=atencion_diaria.tratamiento_aplicado[contador_0];
            // console.log(tratamiento)
            let tratamiento_filtrados=window.lista_tratamiento_aplicado_modal.filter((tratamiento_filtrado)=> tratamiento.nombre_tratamiento_atencion_diaria===tratamiento_filtrado.idtratamiento_aplicado);
            atencion_diaria.lista_tratamiento.push(tratamiento_filtrados[0].nombre_tratamiento_aplicado);
        }
        atencion_diaria.contexto="";
        for(let contador_1=0;contador_1<lista_contexto_incidente_modal.length;contador_1++){
            let contexto=lista_contexto_incidente_modal[contador_1];
            if(contexto.idcontexto_incidente===atencion_diaria.idcontexto_incidente){
                atencion_diaria.contexto=contexto.nombre_contexto_incidente;
            }
        }
        atencion_diaria.lista_examenes=[];
        if(atencion_diaria.examenes_solicitados.length>0){
            for(let contador_3=0;contador_3<atencion_diaria.examenes_solicitados.length;contador_3++){
                let examen=atencion_diaria.examenes_solicitados[contador_3];
                let examen_filtrados=lista_examenes.filter( examen_filtro =>  examen_filtro.codigo===examen.nombre_examen_atencion_diaria);
                atencion_diaria.lista_examenes.push(examen_filtrados[0].valor);
            }
        }
        else{
            atencion_diaria.lista_examenes.push("Ninguno");
        }
        let partes_frt = ["","Cara \/ Cabeza","Hombro derecho","Hombro izquierdo","Torax","Brazo Derecho","Brazo izquierdo","Antebrazo Derecho","Antebrazo izquierdo","Abdomen","Mu\u00f1eca Derecha","Mu\u00f1eca izquierda","Manos \/ Dedos Der","Manos \/ Dedos Izq","Cadera \/ Ingle\/ Pelvis","Muslo Anterior Der","Muslo Anterior Izq","Rodilla Derecha","Rodilla Izquierda","Pierna Derecha","Pierna Izquierda","Tobillo Derecho","Tobillo Izquierdo","Pie Derecho","Pie Izquierdo"];
        let partes_bck = ["","Cuello \/ Cervical","Dorsales","Lumbares","Codo Izquierdo","Codo Derecho","Gluteos","Muslo Posterior Izquierdo","Muslo Posterior Derecho","Pantorrilla Izquierda","Pantorrilla Derecha"];
        atencion_diaria.partes_frt_encontradas=[];
        atencion_diaria.partes_bck_encontradas=[];
        for(let contador_cuerpo=0;contador_cuerpo<atencion_diaria.lesiones.length;contador_cuerpo++){
            let parte=atencion_diaria.lesiones[contador_cuerpo];
            if(parte.codigo_zonas_lesion.split("-")[0]==="frt"){
                atencion_diaria.partes_frt_encontradas.push(partes_frt[parseInt(parte.codigo_zonas_lesion.split("-")[1])]);
            }
            else{
                atencion_diaria.partes_bck_encontradas.push(partes_bck[parseInt(parte.codigo_zonas_lesion.split("-")[1])]);
            }
        }

        let fecha_recomendacion_sesion_actual="";
        if(atencion_diaria.recomendacion_sesion_actual_atencion_diaria==="1" || atencion_diaria.recomendacion_sesion_actual_atencion_diaria==="7"){
            let ano3=atencion_diaria.fecha_recomendacion_sesion_actual_atencion_diaria.split("-")[0];
            let mes3=atencion_diaria.fecha_recomendacion_sesion_actual_atencion_diaria.split("-")[1];
            let dia3=atencion_diaria.fecha_recomendacion_sesion_actual_atencion_diaria.split("-")[2];
            let fecha_sesion_actual=new Date();
            fecha_sesion_actual.setDate(parseInt(dia3));
            fecha_sesion_actual.setMonth(parseInt(mes3)-1);
            fecha_sesion_actual.setFullYear(parseInt(ano3));

            let fecha_sesion_actual_modificada=dia_semana[fecha_sesion_actual.getDay()]+' '+fecha_sesion_actual.getDate()+' de '+lista_meses[fecha_sesion_actual.getMonth()]+' '+fecha_sesion_actual.getFullYear();
            
            
            fecha_recomendacion_sesion_actual=", "+fecha_sesion_actual_modificada;
        }
        
        let fecha_recomendacion_sesion_siguiente="";
        if(atencion_diaria.recomendacion_sesion_siguiente_atencion_diaria ==="1" || atencion_diaria.recomendacion_sesion_siguiente_atencion_diaria ==="7"){
            let ano4=atencion_diaria.fecha_recomendacion_sesion_siguiente_atencion_diairai.split("-")[0];
            let mes4=atencion_diaria.fecha_recomendacion_sesion_siguiente_atencion_diairai.split("-")[1];
            let dia4=atencion_diaria.fecha_recomendacion_sesion_siguiente_atencion_diairai.split("-")[2];
            let fecha_sesion_siguiente=new Date();
            fecha_sesion_siguiente.setDate(parseInt(dia4));
            fecha_sesion_siguiente.setMonth(parseInt(mes4)-1);
            fecha_sesion_siguiente.setFullYear(parseInt(ano4));

            let fecha_sesion_siguiente_modificada=dia_semana[fecha_sesion_siguiente.getDay()]+' '+fecha_sesion_siguiente.getDate()+' de '+lista_meses[fecha_sesion_siguiente.getMonth()]+' '+fecha_sesion_siguiente.getFullYear();
            
            fecha_recomendacion_sesion_siguiente=", "+fecha_sesion_siguiente_modificada;
        }
        // lista_sesion[parseInt(atencion_diaria.recomendacion_sesion_siguiente_atencion_diaria)-1]
        atencion_diaria.recomendacion_sesion_siguiente=lista_sesion[parseInt(atencion_diaria.recomendacion_sesion_siguiente_atencion_diaria)-1]+fecha_recomendacion_sesion_siguiente;
        atencion_diaria.recomendacion_sesion_actual=lista_sesion[parseInt(atencion_diaria.recomendacion_sesion_actual_atencion_diaria)-1]+fecha_recomendacion_sesion_actual;
        
    }
    if(atencion_diaria.tipo_atencion_atencion_diaria==="2"){





        let informe_medico=atencion_diaria.informes_medicos.filter(informe => informe.idinforme_medico===atencion_diaria.idinforme_medico);
        // console.log(informe_medico[0]);
        // agregado_fecha_lesion
        atencion_diaria.agregado_fecha_lesion=informe_medico[0].agregado_fecha_lesion;
        atencion_diaria.lista_tratamiento=[];
        for(let contador_0=0;contador_0<atencion_diaria.tratamiento_aplicado.length;contador_0++){
            let tratamiento=atencion_diaria.tratamiento_aplicado[contador_0];
            // console.log(tratamiento)
            let tratamiento_filtrados=window.lista_tratamiento_aplicado_modal.filter((tratamiento_filtrado)=> tratamiento.nombre_tratamiento_atencion_diaria===tratamiento_filtrado.idtratamiento_aplicado);
            atencion_diaria.lista_tratamiento.push(tratamiento_filtrados[0].nombre_tratamiento_aplicado);
        }
        atencion_diaria.contexto="";
        for(let contador_1=0;contador_1<lista_contexto_incidente_modal.length;contador_1++){
            let contexto=lista_contexto_incidente_modal[contador_1];
            if(contexto.idcontexto_incidente===atencion_diaria.idcontexto_incidente){
                atencion_diaria.contexto=contexto.nombre_contexto_incidente;
            }
        }
        atencion_diaria.lista_trbajo_readaptador=[];
        for(let contador_2=0;contador_2<atencion_diaria.trabajo_readaptor.length;contador_2++){
            let trabajo_readaptador=atencion_diaria.trabajo_readaptor[contador_2];
            let trabajo_readaptador_filtrados=lista_trabajo_readaptador_modal.filter((trabajo_re=> trabajo_readaptador.trabajo_readaptador_atencion_diaria===trabajo_re.idtrabajo_readatador));
            atencion_diaria.lista_trbajo_readaptador.push(trabajo_readaptador_filtrados[0].trabajo_readatador);
        }
        let partes_frt = ["","Cara \/ Cabeza","Hombro derecho","Hombro izquierdo","Torax","Brazo Derecho","Brazo izquierdo","Antebrazo Derecho","Antebrazo izquierdo","Abdomen","Mu\u00f1eca Derecha","Mu\u00f1eca izquierda","Manos \/ Dedos Der","Manos \/ Dedos Izq","Cadera \/ Ingle\/ Pelvis","Muslo Anterior Der","Muslo Anterior Izq","Rodilla Derecha","Rodilla Izquierda","Pierna Derecha","Pierna Izquierda","Tobillo Derecho","Tobillo Izquierdo","Pie Derecho","Pie Izquierdo"];
        let partes_bck = ["","Cuello \/ Cervical","Dorsales","Lumbares","Codo Izquierdo","Codo Derecho","Gluteos","Muslo Posterior Izquierdo","Muslo Posterior Derecho","Pantorrilla Izquierda","Pantorrilla Derecha"];
        atencion_diaria.partes_frt_encontradas=[];
        atencion_diaria.partes_bck_encontradas=[];
        for(let contador_cuerpo=0;contador_cuerpo<atencion_diaria.lesiones.length;contador_cuerpo++){
            let parte=atencion_diaria.lesiones[contador_cuerpo];
            if(parte.codigo_zonas_lesion.split("-")[0]==="frt"){
                atencion_diaria.partes_frt_encontradas.push(partes_frt[parseInt(parte.codigo_zonas_lesion.split("-")[1])]);
            }
            else{
                atencion_diaria.partes_bck_encontradas.push(partes_bck[parseInt(parte.codigo_zonas_lesion.split("-")[1])]);
            }
        }
        let fecha_recomendacion_sesion_actual="";
        if(atencion_diaria.recomendacion_sesion_actual_atencion_diaria==="1" || atencion_diaria.recomendacion_sesion_actual_atencion_diaria==="7"){
            let ano3=atencion_diaria.fecha_recomendacion_sesion_actual_atencion_diaria.split("-")[0];
            let mes3=atencion_diaria.fecha_recomendacion_sesion_actual_atencion_diaria.split("-")[1];
            let dia3=atencion_diaria.fecha_recomendacion_sesion_actual_atencion_diaria.split("-")[2];
            let fecha_sesion_actual=new Date();
            fecha_sesion_actual.setDate(parseInt(dia3));
            fecha_sesion_actual.setMonth(parseInt(mes3)-1);
            fecha_sesion_actual.setFullYear(parseInt(ano3));

            let fecha_sesion_actual_modificada=dia_semana[fecha_sesion_actual.getDay()]+' '+fecha_sesion_actual.getDate()+' de '+lista_meses[fecha_sesion_actual.getMonth()]+' '+fecha_sesion_actual.getFullYear();
            
            
            fecha_recomendacion_sesion_actual=", "+fecha_sesion_actual_modificada;
        }
        
        let fecha_recomendacion_sesion_siguiente="";
        if(atencion_diaria.recomendacion_sesion_siguiente_atencion_diaria ==="1" || atencion_diaria.recomendacion_sesion_siguiente_atencion_diaria ==="7"){
            let ano4=atencion_diaria.fecha_recomendacion_sesion_siguiente_atencion_diairai.split("-")[0];
            let mes4=atencion_diaria.fecha_recomendacion_sesion_siguiente_atencion_diairai.split("-")[1];
            let dia4=atencion_diaria.fecha_recomendacion_sesion_siguiente_atencion_diairai.split("-")[2];
            let fecha_sesion_siguiente=new Date();
            fecha_sesion_siguiente.setDate(parseInt(dia4));
            fecha_sesion_siguiente.setMonth(parseInt(mes4)-1);
            fecha_sesion_siguiente.setFullYear(parseInt(ano4));

            let fecha_sesion_siguiente_modificada=dia_semana[fecha_sesion_siguiente.getDay()]+' '+fecha_sesion_siguiente.getDate()+' de '+lista_meses[fecha_sesion_siguiente.getMonth()]+' '+fecha_sesion_siguiente.getFullYear();
            
            fecha_recomendacion_sesion_siguiente=", "+fecha_sesion_siguiente_modificada;
        }
        atencion_diaria.nombre_medico=informe_medico[0].nombre_medico;
        atencion_diaria.diagnostico_informe= informe_medico[0].diagnostico ;
        atencion_diaria.contexto_informe_medico=array_contexto[parseInt(informe_medico[0].contexto)];
        atencion_diaria.examenes_informe_medico=informe_medico[0].agregado_examenes_realizados;
        atencion_diaria.zonas_afectadas=informe_medico[0].agregado_zona_afectada;
        atencion_diaria.seguro_informe_medico=informe_medico[0].agregado_seguro_medico; 
        atencion_diaria.recomendacion_sesion_siguiente=lista_sesion[parseInt(atencion_diaria.recomendacion_sesion_siguiente_atencion_diaria)-1]+fecha_recomendacion_sesion_siguiente;
        atencion_diaria.recomendacion_sesion_actual=lista_sesion[parseInt(atencion_diaria.recomendacion_sesion_actual_atencion_diaria)-1]+fecha_recomendacion_sesion_actual;
        // atencion_diaria






    }
    if(atencion_diaria.tipo_atencion_atencion_diaria==="3"){
        let informe_medico=atencion_diaria.informes_medicos.filter(informe => informe.idinforme_medico===atencion_diaria.idinforme_medico);
        // console.log(informe_medico[0]);
        let lista_recomendacion_alta=[
            {codigo:"1",valor:"Continuar el trabajo con readaptacion"},
            {codigo:"2",valor:"Reevaluación Fisica"},
            {codigo:"3",valor:"Debe realizar trabajo diferenciado"},
            {codigo:"4",valor:"Derivado al trabajo con readaptacion"},
            {codigo:"5",valor:"Kinesiologia completa"},
            {codigo:"6",valor:"Reevaluación médica"},
        ];
        atencion_diaria.recomendaciones_alta=[];
        for(let contador=0;contador<atencion_diaria.recomendacion_alta.length;contador++){
            let recomendacion=atencion_diaria.recomendacion_alta[contador];
            let recomendaciones_filtradas=lista_recomendacion_alta.filter(recomendacion_filtro => recomendacion_filtro.codigo===recomendacion.recomendacion_alta_atencion_diaria);
            atencion_diaria.recomendaciones_alta.push(recomendaciones_filtradas[0].valor);
        }
        
        let ano2=informe_medico[0].agregado_fecha_lesion.split("-")[0];
        let mes2=informe_medico[0].agregado_fecha_lesion.split("-")[1];
        let dia2=informe_medico[0].agregado_fecha_lesion.split("-")[2];
        let fecha_lesion=new Date();
        fecha_lesion.setDate(parseInt(dia2));
        fecha_lesion.setMonth(parseInt(mes2)-1);
        fecha_lesion.setFullYear(parseInt(ano2));

        let fecha_lesion_informe=dia_semana[fecha_lesion.getDay()]+' '+fecha_lesion.getDate()+' de '+lista_meses[fecha_lesion.getMonth()]+' '+fecha_lesion.getFullYear();
        atencion_diaria.fecha_lesion_informe=fecha_lesion_informe;
        atencion_diaria.recidiva_informe=informe_medico[0].agregado_recidiva ;
        atencion_diaria.comentario_examen_informe=informe_medico[0].agregado_comentario_examen ;
        atencion_diaria.dias_baja_informe=informe_medico[0].agregado_dias_de_baja  ;
        atencion_diaria.nombre_medico=informe_medico[0].nombre_medico;
        atencion_diaria.diagnostico_informe= informe_medico[0].diagnostico  ;
        atencion_diaria.contexto_informe_medico=array_contexto[parseInt(informe_medico[0].contexto)] ;
        atencion_diaria.examenes_informe_medico=informe_medico[0].agregado_examenes_realizados ;
        atencion_diaria.zonas_afectadas=informe_medico[0].agregado_zona_afectada ;
        atencion_diaria.seguro_informe_medico=informe_medico[0].agregado_seguro_medico  ;
    }
    if(atencion_diaria.tipo_atencion_atencion_diaria==="4"){
        let informe_medico=atencion_diaria.informes_medicos.filter(informe => informe.idinforme_medico===atencion_diaria.idinforme_medico);
        console.log(informe_medico[0]);
        let lista_recomendacion_alta=[
            {codigo:"1",valor:"Continuar el trabajo con readaptacion"},
            {codigo:"2",valor:"Reevaluación Fisica"},
            {codigo:"3",valor:"Debe realizar trabajo diferenciado"},
            {codigo:"4",valor:"Derivado al trabajo con readaptacion"},
            {codigo:"5",valor:"Kinesiologia completa"},
            {codigo:"6",valor:"Reevaluación médica"},
        ];
        atencion_diaria.recomendaciones_alta=[];
        for(let contador=0;contador<atencion_diaria.recomendacion_alta.length;contador++){
            let recomendacion=atencion_diaria.recomendacion_alta[contador];
            let recomendaciones_filtradas=lista_recomendacion_alta.filter(recomendacion_filtro => recomendacion_filtro.codigo===recomendacion.recomendacion_alta_atencion_diaria);
            atencion_diaria.recomendaciones_alta.push(recomendaciones_filtradas[0].valor);
        }
        // console.log(atencion_diaria.recomendaciones_alta);
        
        let ano2=informe_medico[0].agregado_fecha_lesion.split("-")[0];
        let mes2=informe_medico[0].agregado_fecha_lesion.split("-")[1];
        let dia2=informe_medico[0].agregado_fecha_lesion.split("-")[2];
        let fecha_lesion=new Date();
        fecha_lesion.setDate(parseInt(dia2));
        fecha_lesion.setMonth(parseInt(mes2)-1);
        fecha_lesion.setFullYear(parseInt(ano2));

        let fecha_lesion_informe=dia_semana[fecha_lesion.getDay()]+' '+fecha_lesion.getDate()+' de '+lista_meses[fecha_lesion.getMonth()]+' '+fecha_lesion.getFullYear();
        atencion_diaria.fecha_lesion_informe=fecha_lesion_informe;
        atencion_diaria.recidiva_informe=informe_medico[0].agregado_recidiva ;
        atencion_diaria.comentario_examen_informe=informe_medico[0].agregado_comentario_examen ;
        atencion_diaria.dias_baja_informe=informe_medico[0].agregado_dias_de_baja  ;
        atencion_diaria.nombre_medico=informe_medico[0].nombre_medico;
        atencion_diaria.diagnostico_informe= informe_medico[0].diagnostico  ;
        atencion_diaria.contexto_informe_medico=array_contexto[parseInt(informe_medico[0].contexto)] ;
        atencion_diaria.examenes_informe_medico=informe_medico[0].agregado_examenes_realizados ;
        atencion_diaria.zonas_afectadas=informe_medico[0].agregado_zona_afectada ;
        atencion_diaria.seguro_informe_medico=informe_medico[0].agregado_seguro_medico  ;
    }
    // console.log(atencion_diaria)
    $("#descargarPDF").modal('show');
    $('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');
    $.ajax({
        url: "post/reportes/generarPDF_ODR_tencion_diaria_federacion_jugador.php",
        type: "post",
        cache: false,
        data:atencion_diaria,
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

async function descargarListaPDF(){
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
    ];
    let fecha_inicio=$("#fecha_inicio").val();
    let ano1=fecha_inicio.split("-")[0];
    let mes1=fecha_inicio.split("-")[1];
    let dia1=fecha_inicio.split("-")[2];
    let fecha_desde=new Date();
    fecha_desde.setDate(parseInt(dia1));
    fecha_desde.setMonth(parseInt(mes1)-1);
    fecha_desde.setFullYear(parseInt(ano1));

    let fecha_desde_atencion=fecha_desde.getDate()+' de '+lista_meses[fecha_desde.getMonth()]+' '+fecha_desde.getFullYear();

    let fecha_final=$("#fecha_final").val();
    let ano2=fecha_final.split("-")[0];
    let mes2=fecha_final.split("-")[1];
    let dia2=fecha_final.split("-")[2];
    let fecha_hasta=new Date();
    fecha_hasta.setDate(parseInt(dia2));
    fecha_hasta.setMonth(parseInt(mes2)-1);
    fecha_hasta.setFullYear(parseInt(ano2));

    let fecha_hasta_atencion=fecha_hasta.getDate()+' de '+lista_meses[fecha_hasta.getMonth()]+' '+fecha_hasta.getFullYear();

    let fecha_pdf='Atenciones diarias del '+fecha_desde_atencion+' al '+fecha_hasta_atencion;

    let lista_atencion=[
        "Nuevo Incidnte",
        "Control",
        "Medica",
        "Deportiva"
    ];
    let lista_sesion=[
        "Reposo Deportivo",
        "Entrenamiento diferenciado",
        "Alta médica solo para entrenar",
        "Kinesiología",
        "Reaptador",
        "Regenerativo",
        "Reposo total",
        "Derivado a relizar examenes",
        "Derivado a urgencias",
        "Alta médica para partidos y entrenamientos",
        "Citado a Médico",
        "Citado a Médico para Alta",
        "Reintegro deportivo progresivo"
    ];
    const lista_examenes=[
        {idExamen:1,examen:"Resonancia Magenética"},
        {idExamen:2,examen:"Radiografía"},
        {idExamen:3,examen:"Scanner / TAC"},
        {idExamen:4,examen:"Artroscopia"},
        {idExamen:5,examen:"Ecotomografía"},
        {idExamen:6,examen:"Fisico"},
        {idExamen:7,examen:"Clinico"},
        {idExamen:0,examen:"Ninguno"}
    ];

    let lista_id_atencion_diaria=[];
    for(let atencion of window.busqueda_respuesta_servidor){
        lista_id_atencion_diaria.push({name:"array_id_atencion_diaria[]",value:atencion.idatencion_diaria_federacion});
    }
    lista_id_atencion_diaria.push({name:"fecha_pdf",value:fecha_pdf});
    // console.log(lista_id_atencion_diaria);
    
    $("#descargarPDF").modal('show');
    $('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');
    $.ajax({
        url: "post/reportes/generarPDF_ODR_tencion_diaria_federacion_lista_atenciones_jugadores.php",
        type: "post",
        cache: false,
        data:lista_id_atencion_diaria,
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
    {numero_serie:"15_2",nombre_serie:"SUB 17 FEMENINA"},
];

var lista_tipo_atencion=[
    {numero_tipo_atencion:0,nombre_tipo_atencion:"Todos"},
    {numero_tipo_atencion:1,nombre_tipo_atencion:"Nuevo Incidente"},
    {numero_tipo_atencion:2,nombre_tipo_atencion:"Control"},
    {numero_tipo_atencion:3,nombre_tipo_atencion:"Alta Médica"},
    {numero_tipo_atencion:4,nombre_tipo_atencion:"Alta Deportiva"}
];
//almacena los contexto incidente que vez en el input contexto incidente
var lista_contexto_incidente=[];
//almacena los tratamientos aplicados para despues renderizarlo en input del tipo checkbox
var lista_tratamiento_aplicado=[];
// var lista_tratamiento_aplicado2=[];
//almacena los trabajos readaptadores para despues renderizarlo en input del tipo checkbox
var lista_trabajo_readaptador=[];

var respuesta_servidor=[];
// almacena los datos que 
var busqueda_respuesta_servidor=[];

var respuesta_servidor_jugadores=[];

var nombre_usuario_software='<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>';

var id_ficha_jugador="";

var id_atencion_diaria="";

var index_array_atencion_diaria="";

function consulatarDespuesDeRegistrar_Actualizar_Eliminar(){
    $("#tipo_tipo_atencion").empty();
    $("#tipo_serie").empty();
    fechaInicioHoy();
    fechaFinalHoy();
    buscarJugador();
}

function eliminarAtencionDiaria(id){
    $("#error_conexion").hide();
    // alert(id)
    let datos=[{name:"id_atencion_diaria",value:id}]
    $.ajax({
            url: "post/atencion_diaria_federacion_eliminar.php",
            type: "post",
            data:datos,
            success: function(respuesta) {
                consulatarDespuesDeRegistrar_Actualizar_Eliminar();
                $("#modalAtencionDiariaEliminar").modal("hide");
            },error: function(){// will fire when timeout is reached
                // alert("errorXXXXX");
                $("#modalAtencionDiariaEliminar").modal("hide");
                $("#error_conexion").show();
            }, timeout: 10000 // sets timeout to 3 seconds
	});
}

function abrirModalEliminarAtencionDiaria(id){
    $("#mensaje_eliminar_atencion_diaria").html('<h5>¿Estás seguro que quieres eliminar esta atención diaria?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    const html_botones='\
        <button type="button" class="btn btn-default boton_modal" data-dismiss="modal" onClick="cerrarModalEliminarAtencionDiaria()" id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>\
        <button type="button" id="eliminar_modal" class="btn btn-default boton_modal " onClick="eliminarAtencionDiaria('+id+');" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button>\
    ';
    $("#contendor_botones_modal_eliminar_atencion_diaria").html(html_botones);
    $("#modalAtencionDiariaEliminar").modal("show");
}

function cerrarModalEliminarAtencionDiaria(){
    $("#modalAtencionDiariaEliminar").modal("hide");
}
// esta funcion se encarga de buscar al jugador por mediante los filtros
function buscarJugador(){
    $("#sin_resultados").hide();
    $("#error_conexion").hide();
    window.busqueda_respuesta_servidor=[];
    $("#contenido_tabla").empty();
    let nombre_jugador=$("#campo_buscar_jugador").val();
    let datos_filtro=$("#filtro_tabla_informe").serializeArray();
    // checkbox_tipo_atencion_filtro_atencion_diaria_0
    if($("#checkbox_serie_filtro_atencion_diaria_00_0").prop("checked") && $("#checkbox_tipo_atencion_filtro_atencion_diaria_0").prop("checked")){
        datos_filtro.splice(2,1);
        datos_filtro.splice(17,1);
    }
    else{
        var lista_name=[];
        var estado=false;
        var lista_valor=[];
        //array_checkbox_serie_filtro_atencion_diaria
        if($("#checkbox_serie_filtro_atencion_diaria_00_0").prop("checked")){
            estado=true;
            lista_name.push($("#checkbox_serie_filtro_atencion_diaria_00_0").attr("name"));
            lista_valor.push("00_0");
        }
        if($("#checkbox_tipo_atencion_filtro_atencion_diaria_0").prop("checked")){
            estado=true;
            lista_name.push($("#checkbox_tipo_atencion_filtro_atencion_diaria_0").attr("name"));
            lista_valor.push("0");
        }
        if(estado){
            var contador=0;
            var aciertos=0;
            while(contador<datos_filtro.length){
                if(aciertos<lista_name.length){
                    if(datos_filtro[contador].name===lista_name[aciertos]){
                        if(datos_filtro[contador].value===lista_valor[aciertos]){
                            datos_filtro.splice(contador,1);
                            contador=-1;
                            aciertos++;
                        }
                    }
                }
                contador++;
            }
        }
    }
    datos_filtro.push({name:"nombre_jugador",value:nombre_jugador});
    // console.log(datos_filtro)
    $.ajax({
            url: "post/atencion_diaria_federacion_consultar.php",
            type: "post",
            data:datos_filtro,
            success: function(respuesta) {
                var json=JSON.parse(respuesta);
                if(json.respuesta){
                    busqueda_respuesta_servidor=json.datos;
                    let filas=crearFilasTabla(json.datos);
                    insertarFilasTabla(filas);
                }
                else{
                    $("#sin_resultados").show();
                    let fila='<tr class="sin_fondo" ><td colspan="14" ><center><h5 style="color:#404040;margin-top:10px;margin-bottom:10px;"><i class="icon-file-alt"></i> Sin atenciones diarias</h5></center></td></tr>';
                    $("#contenido_tabla").html(fila);
                }
                // console.log(json.datos);
            },error: function(){// will fire when timeout is reached
                // alert("errorXXXXX");
                $("#error_conexion").show();
            }, timeout: 10000 // sets timeout to 3 seconds
	});
}

function colorEstadoAtencionDiariaJugador(estado){

    if(estado===1){
        return "background-color:#99ff99;color:#;";
    }
    else if(estado===2){
        return "background-color:#ffa502;color:#111;";
    }
    else{
        return "background-color:#F96C6C;color:#111;";
    }


}

function crearFilasTabla(datos){
    let listaEstadoJugador=[
        "Sin estado",
        "Apto para jugar",
        "Apto para entrenar",
        "En reintegro deportivo",
        "En rehabilitación kinésica",
        "En espera de revisión médica",
        "En espera de resultado de examenes",
        "En post operatorio",
        "En espera de cirugia",
        "En reposo"
    ];
    let numero_fila=0;
    let filas=datos.map(atencion_diaria=>{
        // ((atencion_diaria.fecha_incidente_atencion_diaria!=null)?fecha_formato_ddmmaaa(atencion_diaria.fecha_incidente_atencion_diaria):"Sin Fecha")
        let fecha_lescion=null;
        if(atencion_diaria.idinforme_medico!==null){
            let informe_medico=atencion_diaria.informes_medicos.filter(informe => informe.idinforme_medico===atencion_diaria.idinforme_medico);
            fecha_lescion=fecha_formato_ddmmaaa(informe_medico[0].agregado_fecha_lesion);

        }
        else if(atencion_diaria.fecha_incidente_atencion_diaria!==null){
            fecha_lescion=fecha_formato_ddmmaaa(atencion_diaria.fecha_incidente_atencion_diaria);
        }
        else{
            fecha_lescion="Sin Fecha";
        }
        const fila='\
        <tr class="panel_buscar" style="cursor:pointer; color:#404040; font-size:12px;" id="atencion_diaria_'+atencion_diaria.idatencion_diaria_federacion+'">\
            <td style="text-align:left;" onClick="verAtencionDiaria('+numero_fila+');">\
                <div style="max-width:100%">\
                    <center class="ellipsis-text" style="font-size:10px;">\
                        '+(numero_fila+1)+'\
                    </center>  \
                </div>\
            </td>\
            <td style="text-align:left;" onClick="verAtencionDiaria('+numero_fila+');">\
                <div style="max-width:105px">\
                    <p class="ellipsis-text" style="font-weight: normal;font-size:10px;">\
                        '+fecha_formato_ddmmaaa(atencion_diaria.fecha_atencion_diaria)+'\
                    </p>  \
                </div>\
            </td>\
            <td style="text-align:left;" onClick="verAtencionDiaria('+numero_fila+');">\
                <div style="max-width:50px">\
                    <p class="ellipsis-text" style="font-weight: normal;font-size:10px;">\
                        '+obtenerMesFechaIncidente(atencion_diaria.fecha_atencion_diaria)+'\
                    </p>  \
                </div>\
            </td>\
            <td style="text-align:left;" onClick="verAtencionDiaria('+numero_fila+');">\
            <div style="display:block;float: left;margin-right: 5px;border:2px solid #404040;border-radius: 100px;width:22px;height:22px;"><img style="border-radius: 100px;width:100%;height:100%" src="./foto_jugadores/'+atencion_diaria.idfichaJugador+'.png?idasas='+new Date().getTime()+'"" style="width:100%;height:100%;"/></div>\
                <div style="max-width:151px;margin-top: 3px;">\
                    <p class="ellipsis-text" style="text-transform: Capitalize">\
                        '+atencion_diaria.nombre+' '+atencion_diaria.apellido1+' '+atencion_diaria.apellido2+'\
                    </p>  \
                </div>\
            </td>\
            <td style="text-align:left;" onClick="verAtencionDiaria('+numero_fila+');">\
                <div style="max-width:55px">\
                    <p class="ellipsis-text" style="font-weight: normal;font-size:10px;">\
                        '+obtenerSerieJugador(atencion_diaria.serieActual,atencion_diaria.sexo)+'\
                    </p>  \
                </div>\
            </td>\
            <td style="text-align:left;" onClick="verAtencionDiaria('+numero_fila+');">\
                <div style="max-width:105px">\
                    <p class="ellipsis-text" style="font-weight: normal;font-size:10px;">\
                        '+fecha_lescion+'\
                    </p>  \
                </div>\
            </td>\
            <td style="text-align:left;" onClick="verAtencionDiaria('+numero_fila+');">\
                <div style="max-width:86px">\
                    <p class="ellipsis-text" style="font-size:10px;">\
                        '+obtenerTipoDeAtencion(atencion_diaria.tipo_atencion_atencion_diaria)+'\
                    </p>  \
                </div>\
            </td>\
            <td style="text-align:center;" onClick="verAtencionDiaria('+numero_fila+');">\
                <div style="max-width:60px">\
                    <p class="ellipsis-text" style="color:#fff;'+((atencion_diaria.derivado_seguro_atencion_diaria==="1")?"background-color:red;":"background-color:green;")+'font-size:10px;">\
                        '+((atencion_diaria.derivado_seguro_atencion_diaria==="1")?"Si":"No")+'\
                    </p>  \
                </div>\
            </td>\
            <td style="text-align: center;" class="tooltip-customized" onClick="verAtencionDiaria('+numero_fila+');">\
                <span class="tooltiptext">'+listaEstadoJugador[parseInt(atencion_diaria.estado_jugador)]+'</span>\
                <div style="max-width:119px;width: 100px;">\
                    <p class="ellipsis-text" style="'+colorEstadoAtencionDiariaJugador(parseInt(atencion_diaria.estado_jugador))+'font-size:10px;">\
                    '+listaEstadoJugador[parseInt(atencion_diaria.estado_jugador)]+'\
                    </p>  \
                </div>\
            </td>\
           <!-- <td style="text-align:left;" onClick="verAtencionDiaria('+numero_fila+');">\
                <div style="max-width:90px">\
                    <p class="ellipsis-text" style="font-weight: normal;font-size:10px;">\
                        '+((atencion_diaria.fecha_recomendacion_sesion_actual_atencion_diaria !=null)?fecha_formato_ddmmaaa(atencion_diaria.fecha_recomendacion_sesion_actual_atencion_diaria ):"Sin fecha" )+'\
                    </p>  \
                </div>\
            </td>-->\
            <td style="padding:2px;">\
                    <center>\
                        <a class="boton_add" onClick="descargarPDF('+numero_fila+');">\
                            <i class="icon-download-alt"></i>\
                        </a>\
                    </center>\
                </td>\
                <td style="padding:2px;">\
                    <center >\
                        <a class="boton_editar"   onClick="mostrarModalFormularioEditar('+numero_fila+');">\
                            <i class="icon-pencil"></i>\
                        </a>\
                    </center>\
                </td>\
                <td style="padding:2px;">\
                    <center>\
                        <a class="boton_eliminar" onClick="abrirModalEliminarAtencionDiaria('+atencion_diaria.idatencion_diaria_federacion+');">\
                            <i class="icon-remove"></i>\
                        </a>\
                    </center>\
                </td>\
        </tr>';
        numero_fila+=1;
        return fila;
    })
    return filas;
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

function obtenerMesFechaIncidente(fecha){
    let lista_meses=[
    {numero_mes:1,nombre_mes:"Enero"},
    {numero_mes:2,nombre_mes:"Febrero"},
    {numero_mes:3,nombre_mes:"Marzo"},
    {numero_mes:4,nombre_mes:"Abril"},
    {numero_mes:5,nombre_mes:"Mayo"},
    {numero_mes:6,nombre_mes:"Junio"},
    {numero_mes:7,nombre_mes:"Julio"},
    {numero_mes:8,nombre_mes:"Agosto"},
    {numero_mes:9,nombre_mes:"Septiembre"},
    {numero_mes:10,nombre_mes:"Octubre"},
    {numero_mes:11,nombre_mes:"Noviembre"},
    {numero_mes:12,nombre_mes:"Diciembre"}
    ];
    // console.log(mes_fecha)
    let mes_fecha=parseInt(fecha.split("-")[1]);
    let mes_busqueda=lista_meses.filter( mes => mes.numero_mes===mes_fecha);
    return mes_busqueda[0].nombre_mes;
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
    ];
    let serie_completa=serie+"_"+sexo;
    let serie_jugador=lista_serie_jugador.filter(serie_j=> serie_j.numero_serie===serie_completa);
    return serie_jugador[0].nombre_serie;

}

function obtenerTipoDeAtencion(tipo){
    var lista_tipo_atencion=[
        {numero_tipo_atencion:1,nombre_tipo_atencion:"Nuevo incidente"},
        {numero_tipo_atencion:5,nombre_tipo_atencion:"Nueva atencion"},
        {numero_tipo_atencion:2,nombre_tipo_atencion:"Control / sesion kinesica"},
        {numero_tipo_atencion:6,nombre_tipo_atencion:"Control médico"},
        {numero_tipo_atencion:7,nombre_tipo_atencion:"Sesión readaptador"},
        {numero_tipo_atencion:3,nombre_tipo_atencion:"Médica"},
        {numero_tipo_atencion:4,nombre_tipo_atencion:"Deportiva"}
    ];
    let list_atencion=lista_tipo_atencion.filter(atencion=> atencion.numero_tipo_atencion===parseInt(tipo));
    return list_atencion[0].nombre_tipo_atencion;

}
function insertarFilasTabla(filas){
    filas.map(fila=>{
        $("#contenido_tabla").append(fila);
    })
}

function closeModal_pdf(){
    $("#descargarPDF").modal('hide');
}

function descargarPDFTodoLoConsultado(){
    // console.log(window.busqueda_respuesta_servidor);
}

function mostrarModalFormulario(){
    fechaAtencionDiariaHoy();
    window.id_atencion_diaria="";
    $("#serie_jugador").empty();
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
    ];
    let list_option_serie=series_array.map(serie=> {
        return '<option id="option_select_serie_jugador_'+serie.numero_serie+'" value="'+serie.numero_serie+'" >'+serie.nombre_serie+'</option>';
    });
    for(let contador=0;contador<list_option_serie.length;contador++){
        $("#serie_jugador").append(list_option_serie[contador]);
    }
    $("#serie_jugador").prop("disabled",false);
    $("#jugador").prop("disabled",false);
    $("#component_atencion_diaria_inicio").hide();
    $("#component_atencion_diaria_formulario").show();
    // $("#myModalFormulario").modal("show")
    $("#contenedor_jugador").css("display","none");
    $("#formulario_modal_atencion_new").hide();
    window.id_informe=false;
}

var atencion_diaria_jugador=[];

async function mostrarModalFormularioEditar(posicion){
    window.atencion_diaria_jugador=[];
    window.index_array_atencion_diaria=posicion;
    window.id_informe=true;
    let atencion_diaria=window.busqueda_respuesta_servidor[posicion];
    window.atencion_diaria_jugador=window.busqueda_respuesta_servidor[posicion];
    window.id_atencion_diaria=atencion_diaria.idatencion_diaria_federacion;
    $("#serie_jugador").empty();
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
    ];
    let list_option_serie=series_array.map(serie=> {
        return '<option id="option_select_serie_jugador_'+serie.numero_serie+'" value="'+serie.numero_serie+'" >'+serie.nombre_serie+'</option>';
    });
    for(let contador=0;contador<list_option_serie.length;contador++){
        $("#serie_jugador").append(list_option_serie[contador]);
    }
    let serie=atencion_diaria.serieActual+"_"+atencion_diaria.sexo;
    let serie_2=atencion_diaria.serieActual;
    $("#serie_jugador").val(serie);
    await consultarJugadoreXSeries(serie);
    $("#serie_jugador").prop("disabled",true);
    $("#jugador").prop("disabled",true);

    let codigo_jugador=atencion_diaria.idfichaJugador+"_"+atencion_diaria.idclub;
    $("#jugador").val(codigo_jugador);

    $("#component_atencion_diaria_inicio").hide();
    $("#component_atencion_diaria_formulario").show();
    
    mostrarJugadorEditar(atencion_diaria,serie_2);
}

async function consultarJugadoreXSeries(serie_select){
    $("#jugador").empty();
    if(serie_select!=="0"){
        const serie=serie_select.split("_")[0];
        const sexo=serie_select.split("_")[1];
        let datos=[{name:"serie",value:serie},{name:"sexo",value:sexo}];
        await $.ajax({
                url: "post/atencion_diaria_federacion_consultar_jugador.php",
                type: "post",
                data:datos,
                success: function(respuesta) {
                    var json=JSON.parse(respuesta);
                    window.jugadoresPorSerie=JSON.parse(JSON.stringify(json.respuesta));
                    window.respuesta_servidor_jugadores=json.respuesta;
                    // console.log(respuesta_servidor_jugadores);
                    let array=respuesta_servidor_jugadores;
                    let list_option_jugadores=array.map(jugadores=> {
                        return '<option id="option_select_jugador_'+jugadores.idfichaJugador+'_0'+'" value="'+jugadores.idfichaJugador+'_0'+'" >'+jugadores.nombre+' '+jugadores.apellido1+' '+jugadores.apellido2+'</option>';
                    });
                    for(let contador=0;contador<list_option_jugadores.length;contador++){
                        $("#jugador").append(list_option_jugadores[contador]);
                    }
                    // formato_fecha_mes_texto
                    // $("#texto_fecha_cumple").text(formato_fecha_mes_texto());
                    $("#texto_serie").text(obtenerSerieJugador(serie,sexo));
                    $("#text_serie_quipo_titulo_formulario").text(obtenerSerieJugador(serie,sexo));
                    $("#formulario_modal_atencion_new").hide();
                    $("#contenedor_jugador").css("display","inline");
                    if(!window.id_informe){
                        let valor_jugadora=$("#jugador").val();
                        mostrarJugador(valor_jugadora);
                    }
            },error: function(){// will fire when timeout is reached
                // alert("errorXXXXX");
            }, timeout: 10000 // sets timeout to 3 seconds
        });
    }
    else{
        $("#text_serie_quipo_titulo_formulario").text("");
        $("#formulario_modal_atencion_new").hide();
        $("#contenedor_jugador").css("display","none");
    }
}

function mostrarJugadorEditar(atencion_diaria,serie){
    //limpiar elemientos del formulario
    
    $("#contenedor_flex_segmento_izquierdo_formulario").css("align-content","start");
    $("#contenedor_flex_segmento_izquierdo_formulario").empty();
    $("#segmento_inferior_formulario").empty();
    $("#nombre_jugador_formulario_new").text(" ");
    $("#texto_fecha_cumple").text(formato_fecha_mes_texto(atencion_diaria.fechaNacimiento));
    $("#texto_posicion_cancha").text(atencion_diaria.texto_posicion);
    // $("#serie_jugador_formulario_new").text(" ")
    // ingresar nombre y serie jugador 
    $("#nombre_jugador_formulario_new").text(atencion_diaria.nombre+' '+atencion_diaria.apellido1+' '+atencion_diaria.apellido2);
    let serie_jugador=$('#option_select_serie_jugador_'+serie+'_'+atencion_diaria.sexo).text();
    // $("#serie_jugador_formulario_new").text(serie_jugador)
    //capturar id ficha jugador
    window.id_ficha_jugador=atencion_diaria.idfichaJugador ;
    $("#jugador").val(window.id_ficha_jugador+"_0");
    //insertar foto del jugador 
    $("#contendor_imagen_jugador").html('<img style="border-radius: 100px;width:100%;height:100%;" id="imagen_jugador_'+atencion_diaria.idfichaJugador+'" src="./foto_jugadores/'+atencion_diaria.idfichaJugador+'.png"/>');
    //inserto input select tipo de atencion pero esta vacio
    $("#contenedor_flex_segmento_izquierdo_formulario").html(window.html_tipo_atencion);//atencion_diaria.php
    // $("#contexto_incidente_formulario").empty()
    //aqui inserto los valores al select tipo de atencion
    generarOptionSelectTipoDeAtencion();
    //aqui se decide dependiendo del tipo de atencion diaria que registro se mostrar un tipo de formulario 
    mostrarTipoDeFormulario(atencion_diaria.tipo_atencion_atencion_diaria);
    // aqui en conjunto con la funcion anterior, la tarea de esta funcion es de mostrar los datos del registro
    // dependiendo del tipo de atencion diaria
    // setTimeout(()=>{
    //     mostarDatosTipoFormulario(atencion_diaria.tipo_atencion_atencion_diaria,atencion_diaria)
    // },90)
    // simplemente muestra el formulario ya armado 
    
}

function mostarDatosTipoFormulario(tipo,atencion_diaria){
    // alert(tipo)
    switch(tipo){
        case "1":mostrarDatosFormularioNuevoIncidente(atencion_diaria);break; 
        case "2":mostrarDatosFormularioControl(atencion_diaria);break; 
        case "3":mostrarDatosFormularioMedica(atencion_diaria);break; 
        case "4":mostrarDatosFormularioDeportiva(atencion_diaria);break;
        case "5":mostrarDatosFormularioNuevaAtencion(atencion_diaria);break; 
        case "6":mostrarDatosFormularioControlMedico(atencion_diaria);break; 
        // case "7":formularioSesionReadaptador(atencion_diaria);break; 
    }
}

function mostrarDatosFormularioControlMedico(atencion_diaria){
    $("#examen_fisico").val(atencion_diaria.examen_fisico);
    $("#estado_jugador").val(atencion_diaria.estado_jugador);
    $("#fecha_atencion").val(atencion_diaria.fecha_atencion_diaria);
    $("#observacion").val(atencion_diaria.observacion);
    $("#asistencia_control").val(atencion_diaria.asistencia_atencion_diaria) ; 
    $("#fecha_alta").val(atencion_diaria.fecha_estimada_de_alta);
    $("#indicaciones").val(atencion_diaria.indicaciones);
    // insertando los valores de recomendacion
    for(let recomendacion of atencion_diaria.recomendaciones){
        if(recomendacion.recomendacion_numero==="1"){
            $("#reposo_deportivo").val(recomendacion.fecha_recomendacion);
        }
        else if(recomendacion.recomendacion_numero==="2"){
            $("#reposo_total").val(recomendacion.fecha_recomendacion);
        }
        $("#recomendacion_"+recomendacion.recomendacion_numero).prop("checked",true);
    }
    $("#numero_sesiones").val(atencion_diaria.numero_sesion) ; 
    $("#porcentaje_recuperacion").val(atencion_diaria.porcentaje_recuperacion) ; 
    if(atencion_diaria.trabajo_readaptor.length===lista_trabajo_readaptador.length-1){
        $("#checkbox_trabajo_readaptador_atencion_diaria_0").prop("checked",true) ; 
    }
    for(let contador3=0;contador3<atencion_diaria.trabajo_readaptor.length;contador3++){
        if(document.getElementById('checkbox_trabajo_readaptador_atencion_diaria_'+atencion_diaria.trabajo_readaptor[contador3].trabajo_readaptador_atencion_diaria)){
            $('#checkbox_trabajo_readaptador_atencion_diaria_'+atencion_diaria.trabajo_readaptor[contador3].trabajo_readaptador_atencion_diaria).prop("checked",true)   ; 
        }
    }
    $("#idinforme_medico").empty() ; 
    $("#idinforme_medico").append("<option value='0'>Seleccione</option>") ; 
    let lista_option_dignostico=[] ; 
    for(let contador4=0;contador4<atencion_diaria.informes_medicos.length;contador4++){
        let inform_medico=atencion_diaria.informes_medicos[contador4] ; 
        let option="<option value='"+inform_medico.idinforme_medico+"'>"+inform_medico.diagnostico+"</option>" ; 
        $("#idinforme_medico").append(option) ; 
    }
    if(atencion_diaria.idinforme_medico!==null){
        $("#infon_diagnostico").empty() ; 
        $("#idinforme_medico").val(atencion_diaria.idinforme_medico) ; 
        let informe=atencion_diaria.informes_medicos.filter(informe_medico=> informe_medico.idinforme_medico===atencion_diaria.idinforme_medico) ; 
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
        let ano=informe[0].agregado_fecha_lesion.split("-")[0] ; 
        let mes=informe[0].agregado_fecha_lesion.split("-")[1] ; 
        let dia=informe[0].agregado_fecha_lesion.split("-")[2] ; 
        let fecha_lesion=new Date() ; 
        fecha_lesion.setDate(parseInt(dia)) ; 
        fecha_lesion.setMonth(parseInt(mes)-1) ; 
        fecha_lesion.setFullYear(parseInt(ano)) ; 

        let fecha_lesion_diaria_modificada=dia_semana[fecha_lesion.getDay()]+' '+fecha_lesion.getDate()+' de '+lista_meses[fecha_lesion.getMonth()]+' '+fecha_lesion.getFullYear(); 

        let array_contexto=[
            "Partido Oficial",
            "Partido Amistoso",
            "Entrenamiento",
            "Otro"
        ] ; 

        let html_info_diagnostico='\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Examenes realizados:</span> '+informe[0].agregado_examenes_realizados+'</div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Fecha de lesion:</span> '+fecha_lesion_diaria_modificada+' </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Contexto:</span> '+array_contexto[parseInt(informe[0].contexto)]+'</div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Zona afectada:</span> '+informe[0].agregado_zona_afectada+' </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Recidiva:</span> '+((informe[0].agregado_recidiva==="1")?"Si":"No")+' </div>\
        '; 
        $("#infon_diagnostico").html(html_info_diagnostico) ; 
        $("#infon_diagnostico").css("display","block") ; 
    }
    else{
        $("#infon_diagnostico").css("display","none") ; 
    }

    $("#boton_agregar_infrome").prop("disabled",false);
    $("#formulario_modal_atencion_new").show() ; 
}

function mostrarDatosFormularioNuevaAtencion(atencion_diaria){
    console.log(atencion_diaria);
    $("#estado_jugador").val(atencion_diaria.estado_jugador);
    $("#examen_fisico").val(atencion_diaria.examen_fisico);
    $("#indicaciones").val(atencion_diaria.indicaciones);
    $("#plan").val(atencion_diaria.plan_atencion_diaria);
    $("#diagnostico").val(atencion_diaria.diagnostico_atencion_diaria);
    $("#anamnesis").val(atencion_diaria.anamnesis_atencion_diaria);
    $("#observaciones_kinesiologo").val(atencion_diaria.observacion_kinesiologo);
    $("#contexto_incidente_formulario").val(atencion_diaria.idcontexto_incidente);
    // $("#examen_solicitado").val()
    renderizarCheckboxExamenesSolicitados();
    if(atencion_diaria.examenes_solicitados.length===0){
        $("#examen_0").prop("checked",true);
    }
    else{
        atencion_diaria.examenes_solicitados.map(examen=>{
            $('#examen_'+examen.nombre_examen_atencion_diaria).prop("checked",true);
        });
    }
    contarElementosExamenesSolicitados();
    // mostrarExamenesSolicitados(atencion_diaria.examen_solicitados_atencion_diaria)
    for(let contador=0;contador<atencion_diaria.examenes_solicitados.length;contador++){
        if(document.getElementById('examen_'+atencion_diaria.examenes_solicitados[contador].nombre_examen_atencion_diaria)){
            // console.log('examen_'+atencion_diaria.examenes_solicitados[contador].nombre_examen_atencion_diaria);
            $('#examen_'+atencion_diaria.examenes_solicitados[contador].nombre_examen_atencion_diaria).prop("checked",true) ; 
        }
    }
    window.zonas_frt=[];
    window.zonas_bck=[];
    window.idzonas_frt=[];
    window.idzonas_bck=[];
    window.eliminar=[];
    for(let contador1=0;contador1<atencion_diaria.lesiones.length;contador1++){
        // codigo_zonas_lesion
        // window.zonas_frt
        let lado_lesion=atencion_diaria.lesiones[contador1].codigo_zonas_lesion.split("-")[0];
        let zona_lesion=parseInt(atencion_diaria.lesiones[contador1].codigo_zonas_lesion.split("-")[1]);
        sector(lado_lesion,zona_lesion);
    }
    $("#fecha_incidente").val(atencion_diaria.fecha_incidente_atencion_diaria);
    $("#fecha_atencion").val(atencion_diaria.fecha_atencion_diaria);

    $("#boton_agregar_infrome").prop("disabled",false);
    $("#formulario_modal_atencion_new").show();
}

function mostrarDatosFormularioNuevoIncidente(atencion_diaria){
    console.log(atencion_diaria);
    $("#estado_jugador").val(atencion_diaria.estado_jugador);
    $("#examen_fisico").val(atencion_diaria.examen_fisico)
    $("#diagnostico").val(atencion_diaria.diagnostico_atencion_diaria);
    $("#anamnesis").val(atencion_diaria.anamnesis_atencion_diaria);
    $("#observaciones_kinesiologo").val(atencion_diaria.observacion_kinesiologo);
    $("#contexto_incidente_formulario").val(atencion_diaria.idcontexto_incidente);
    $("#derivado_seguro").val(atencion_diaria.derivado_seguro_atencion_diaria);
    for(let recomendacion of atencion_diaria.recomendaciones){
        if(recomendacion.recomendacion_numero==="1"){
            $("#reposo_deportivo").val(recomendacion.fecha_recomendacion);
        }
        else if(recomendacion.recomendacion_numero==="2"){
            $("#reposo_total").val(recomendacion.fecha_recomendacion);
        }
        $("#recomendacion_"+recomendacion.recomendacion_numero).prop("checked",true);
    }
    renderizarCheckboxExamenesSolicitados();
    if(atencion_diaria.examenes_solicitados.length===0){
        $("#examen_0").prop("checked",true);
    }
    else{
        atencion_diaria.examenes_solicitados.map(examen=>{
            $('#examen_'+examen.nombre_examen_atencion_diaria).prop("checked",true);
        });
    }
    contarElementosExamenesSolicitados();
    for(let contador=0;contador<atencion_diaria.examenes_solicitados.length;contador++){
        if(document.getElementById('examen_'+atencion_diaria.examenes_solicitados[contador].nombre_examen_atencion_diaria)){
            $('#examen_'+atencion_diaria.examenes_solicitados[contador].nombre_examen_atencion_diaria).prop("checked",true) ; 
        }
    }
    window.zonas_frt=[];
    window.zonas_bck=[];
    window.idzonas_frt=[];
    window.idzonas_bck=[];
    window.eliminar=[];
    for(let contador1=0;contador1<atencion_diaria.lesiones.length;contador1++){
        let lado_lesion=atencion_diaria.lesiones[contador1].codigo_zonas_lesion.split("-")[0];
        let zona_lesion=parseInt(atencion_diaria.lesiones[contador1].codigo_zonas_lesion.split("-")[1]);
        sector(lado_lesion,zona_lesion);
    }
    
    if(atencion_diaria.tratamiento_aplicado.length===lista_tratamiento_aplicado.length-1){
        $("#checkbox_tratamiento_aplicado_atencion_diaria_0").prop("checked",true);
    }
    for(let contador2=0;contador2<atencion_diaria.tratamiento_aplicado.length;contador2++){
        if(document.getElementById('checkbox_tratamiento_aplicado_atencion_diaria_'+atencion_diaria.tratamiento_aplicado[contador2].nombre_tratamiento_atencion_diaria)){
            $('#checkbox_tratamiento_aplicado_atencion_diaria_'+atencion_diaria.tratamiento_aplicado[contador2].nombre_tratamiento_atencion_diaria).prop("checked",true) ;
        }
    }
    
    $("#boton_agregar_infrome").prop("disabled",false);
    $("#formulario_modal_atencion_new").show();
}

function mostrarDatosFormularioControl(atencion_diaria){
    $("#estado_jugador").val(atencion_diaria.estado_jugador);
    $("#fecha_atencion").val(atencion_diaria.fecha_atencion_diaria);
    $("#observaciones_generales").val(atencion_diaria.observacion_general);
    $("#asistencia_control").val(atencion_diaria.asistencia_atencion_diaria) ; 
    $("#fecha_alta").val(atencion_diaria.fecha_estimada_de_alta);
    $("#indicaciones").val(atencion_diaria.indicaciones);
    // insertando los valores de recomendacion
    for(let recomendacion of atencion_diaria.recomendaciones){
        if(recomendacion.recomendacion_numero==="1"){
            $("#reposo_deportivo").val(recomendacion.fecha_recomendacion);
        }
        else if(recomendacion.recomendacion_numero==="2"){
            $("#reposo_total").val(recomendacion.fecha_recomendacion);
        }
        $("#recomendacion_"+recomendacion.recomendacion_numero).prop("checked",true);
    }
    $("#numero_sesiones").val(atencion_diaria.numero_sesion) ; 
    $("#porcentaje_recuperacion").val(atencion_diaria.porcentaje_recuperacion) ; 
    if(atencion_diaria.trabajo_readaptor.length===lista_trabajo_readaptador.length-1){
        $("#checkbox_trabajo_readaptador_atencion_diaria_0").prop("checked",true) ; 
    }
    for(let contador3=0;contador3<atencion_diaria.trabajo_readaptor.length;contador3++){
        if(document.getElementById('checkbox_trabajo_readaptador_atencion_diaria_'+atencion_diaria.trabajo_readaptor[contador3].trabajo_readaptador_atencion_diaria)){
            $('#checkbox_trabajo_readaptador_atencion_diaria_'+atencion_diaria.trabajo_readaptor[contador3].trabajo_readaptador_atencion_diaria).prop("checked",true)   ; 
        }
    }
    $("#idinforme_medico").empty() ; 
    $("#idinforme_medico").append("<option value='0'>Seleccione</option>") ; 
    let lista_option_dignostico=[] ; 
    for(let contador4=0;contador4<atencion_diaria.informes_medicos.length;contador4++){
        let inform_medico=atencion_diaria.informes_medicos[contador4] ; 
        let option="<option value='"+inform_medico.idinforme_medico+"'>"+inform_medico.diagnostico+"</option>" ; 
        $("#idinforme_medico").append(option) ; 
    }
    if(atencion_diaria.idinforme_medico!==null){
        $("#infon_diagnostico").empty() ; 
        $("#idinforme_medico").val(atencion_diaria.idinforme_medico) ; 
        let informe=atencion_diaria.informes_medicos.filter(informe_medico=> informe_medico.idinforme_medico===atencion_diaria.idinforme_medico) ; 
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
        let ano=informe[0].agregado_fecha_lesion.split("-")[0] ; 
        let mes=informe[0].agregado_fecha_lesion.split("-")[1] ; 
        let dia=informe[0].agregado_fecha_lesion.split("-")[2] ; 
        let fecha_lesion=new Date() ; 
        fecha_lesion.setDate(parseInt(dia)) ; 
        fecha_lesion.setMonth(parseInt(mes)-1) ; 
        fecha_lesion.setFullYear(parseInt(ano)) ; 

        let fecha_lesion_diaria_modificada=dia_semana[fecha_lesion.getDay()]+' '+fecha_lesion.getDate()+' de '+lista_meses[fecha_lesion.getMonth()]+' '+fecha_lesion.getFullYear(); 

        let array_contexto=[
            "Partido Oficial",
            "Partido Amistoso",
            "Entrenamiento",
            "Otro"
        ] ; 

        let html_info_diagnostico='\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Examenes realizados:</span> '+informe[0].agregado_examenes_realizados+'</div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Fecha de lesion:</span> '+fecha_lesion_diaria_modificada+' </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Contexto:</span> '+array_contexto[parseInt(informe[0].contexto)]+'</div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Zona afectada:</span> '+informe[0].agregado_zona_afectada+' </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Recidiva:</span> '+((informe[0].agregado_recidiva==="1")?"Si":"No")+' </div>\
        '; 
        $("#infon_diagnostico").html(html_info_diagnostico) ; 
        $("#infon_diagnostico").css("display","block") ; 
    }
    else{
        $("#infon_diagnostico").css("display","none") ; 
    }

    $("#boton_agregar_infrome").prop("disabled",false);
    $("#formulario_modal_atencion_new").show() ; 

}

function mostrarInformeMedico(id){
    if(id!=="0"){
        $("#infon_diagnostico").empty() ; 
        let informe=window.atencion_diaria_jugador.informes_medicos.filter(informe_medico=> informe_medico.idinforme_medico===id) ; 
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
        let ano=informe[0].agregado_fecha_lesion.split("-")[0] ; 
        let mes=informe[0].agregado_fecha_lesion.split("-")[1] ; 
        let dia=informe[0].agregado_fecha_lesion.split("-")[2] ; 
        let fecha_lesion=new Date() ; 
        fecha_lesion.setDate(parseInt(dia)) ; 
        fecha_lesion.setMonth(parseInt(mes)-1) ; 
        fecha_lesion.setFullYear(parseInt(ano)) ; 

        let fecha_lesion_diaria_modificada=dia_semana[fecha_lesion.getDay()]+' '+fecha_lesion.getDate()+' de '+lista_meses[fecha_lesion.getMonth()]+' '+fecha_lesion.getFullYear() ; 
        let html_info_diagnostico='' ; 
        // alert(window.atencion_diaria_jugador.tipo_atencion_atencion_diaria)
        // alert(JSON.stringify(window.atencion_diaria_jugador))
        let array_contexto=[
            "Partido Oficial",
            "Partido Amistoso",
            "Entrenamiento",
            "Otro"
        ] ; 
        if($("#tipo_tipo_atencion_formulario").val()==="2" || $("#tipo_tipo_atencion_formulario").val()==="6" || $("#tipo_tipo_atencion_formulario").val()==="7"){
            
            html_info_diagnostico='\
                <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Examenes realizados:</span> '+informe[0].agregado_examenes_realizados+'</div>\
                <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Fecha de lesion:</span> '+fecha_lesion_diaria_modificada+' </div>\
                <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Contexto:</span> '+array_contexto[parseInt(informe[0].contexto)]+'</div>\
                <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Zona afectada:</span> '+informe[0].agregado_zona_afectada+' </div>\
                <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Recidiva:</span> '+((informe[0].agregado_recidiva==="1")?"Si":"No")+' </div>\
            '; 
        }
        else if($("#tipo_tipo_atencion_formulario").val()==="3" || $("#tipo_tipo_atencion_formulario").val()==="4"){
            // alert("hola")
            html_info_diagnostico='\
                <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Fecha de lesion:</span> '+fecha_lesion_diaria_modificada+' <span style="margin-left:40px"><span style="font-weight: bold;">Dias que el jugador tiene de baja:</span> '+informe[0].agregado_dias_de_baja+' '+((parseInt(informe[0].agregado_dias_de_baja)===1)?"Día":"Días")+'</span></div>\
                <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Localización de la lesion:</span> '+informe[0].agregado_localizacion_lesion+' </div>\
                <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Derivado seguro médico:</span> '+((informe[0].agregado_seguro_medico==="1")?"Si":"No")+' </div>\
                <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Examenes realizados:</span> '+informe[0].agregado_examenes_realizados+'</div>\
                <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Comentario de los examenes realizados:</span> '+informe[0].agregado_comentario_examen+'</div>\
                <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Recidiva:</span> '+((informe[0].agregado_recidiva==="1")?"Si":"No")+' </div>\
            ' ; 
        }
        $("#infon_diagnostico").html(html_info_diagnostico) ; 
        $("#infon_diagnostico").css("display","block") ; 
    }
    else{
        $("#infon_diagnostico").css("display","none") ; 
    }

}

function mostrarDatosFormularioMedica(atencion_diaria){
    // console.log(atencion_diaria) ; 
    $("#fecha_atencion").val(atencion_diaria.fecha_atencion_diaria) ; 
    $("#recomendacion_medica").val(atencion_diaria.observacion_medica ) ; 
    $("#idinforme_medico").empty() ; 
    $("#idinforme_medico").append("<option value='0'>Seleccione</option>") ; 
    let lista_option_dignostico=[] ; 
    for(let contador4=0;contador4<atencion_diaria.informes_medicos.length;contador4++){
        let inform_medico=atencion_diaria.informes_medicos[contador4] ; 
        let option="<option value='"+inform_medico.idinforme_medico+"'>"+inform_medico.diagnostico+"</option>" ; 
        $("#idinforme_medico").append(option) ; 
    }
    if(atencion_diaria.idinforme_medico!==null){
        $("#infon_diagnostico").empty() ; 
        $("#idinforme_medico").val(atencion_diaria.idinforme_medico) ; 
        let informe=atencion_diaria.informes_medicos.filter(informe_medico=> informe_medico.idinforme_medico===atencion_diaria.idinforme_medico) ; 
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
        let ano=informe[0].agregado_fecha_lesion.split("-")[0] ; 
        let mes=informe[0].agregado_fecha_lesion.split("-")[1] ; 
        let dia=informe[0].agregado_fecha_lesion.split("-")[2] ; 
        let fecha_lesion=new Date() ; 
        fecha_lesion.setDate(parseInt(dia)) ; 
        fecha_lesion.setMonth(parseInt(mes)-1) ; 
        fecha_lesion.setFullYear(parseInt(ano)) ; 

        let fecha_lesion_diaria_modificada=dia_semana[fecha_lesion.getDay()]+' '+fecha_lesion.getDate()+' de '+lista_meses[fecha_lesion.getMonth()]+' '+fecha_lesion.getFullYear() ; 

        let html_info_diagnostico='\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Fecha de lesion:</span> '+fecha_lesion_diaria_modificada+' <span style="margin-left:40px"><span style="font-weight: bold;">Dias que el jugador tiene de baja:</span> '+informe[0].agregado_dias_de_baja+' '+((parseInt(informe[0].agregado_dias_de_baja)===1)?"Día":"Días")+'</span></div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Localización de la lesion:</span> '+informe[0].agregado_localizacion_lesion+' </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Derivado seguro médico:</span> '+((informe[0].agregado_seguro_medico==="1")?"Si":"No")+' </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Examenes realizados:</span> '+informe[0].agregado_examenes_realizados+'</div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Comentario de los examenes realizados:</span> '+informe[0].agregado_comentario_examen+'</div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Recidiva:</span> '+((informe[0].agregado_recidiva==="1")?"Si":"No")+' </div>\
        ' ; 
        $("#infon_diagnostico").html(html_info_diagnostico) ; 
        $("#infon_diagnostico").css("display","block") ; 
    }
    else{
        $("#infon_diagnostico").css("display","none") ; 
    }
    for(let contador=0;contador<atencion_diaria.recomendacion_alta.length;contador++){
        if(document.getElementById('recomendacion_alta_'+atencion_diaria.recomendacion_alta[contador].recomendacion_alta_atencion_diaria)){
            $('#recomendacion_alta_'+atencion_diaria.recomendacion_alta[contador].recomendacion_alta_atencion_diaria).prop("checked",true)  ;  
        }
    }
    // $("#boton_agregar_infrome").prop("disabled",false)
    $("#formulario_modal_atencion_new").show() ; 
}

function mostrarDatosFormularioDeportiva(atencion_diaria){
    // console.log(atencion_diaria) ; 
    $("#fecha_atencion").val(atencion_diaria.fecha_atencion_diaria) ; 
    $("#idinforme_medico").empty() ; 
    $("#idinforme_medico").append("<option value='0'>Seleccione</option>") ; 
    let lista_option_dignostico=[] ; 
    for(let contador4=0;contador4<atencion_diaria.informes_medicos.length;contador4++){
        let inform_medico=atencion_diaria.informes_medicos[contador4] ; 
        let option="<option value='"+inform_medico.idinforme_medico+"'>"+inform_medico.diagnostico+"</option>" ; 
        $("#idinforme_medico").append(option) ; 
    }
    if(atencion_diaria.idinforme_medico!==null){
        $("#infon_diagnostico").empty() ; 
        $("#idinforme_medico").val(atencion_diaria.idinforme_medico) ; 
        let informe=atencion_diaria.informes_medicos.filter(informe_medico=> informe_medico.idinforme_medico===atencion_diaria.idinforme_medico) ; 
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
        let ano=informe[0].agregado_fecha_lesion.split("-")[0] ; 
        let mes=informe[0].agregado_fecha_lesion.split("-")[1] ; 
        let dia=informe[0].agregado_fecha_lesion.split("-")[2] ; 
        let fecha_lesion=new Date() ; 
        fecha_lesion.setDate(parseInt(dia)) ; 
        fecha_lesion.setMonth(parseInt(mes)-1) ; 
        fecha_lesion.setFullYear(parseInt(ano)) ; 

        let fecha_lesion_diaria_modificada=dia_semana[fecha_lesion.getDay()]+' '+fecha_lesion.getDate()+' de '+lista_meses[fecha_lesion.getMonth()]+' '+fecha_lesion.getFullYear() ; 

        let html_info_diagnostico='\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Fecha de lesion:</span> '+fecha_lesion_diaria_modificada+' <span style="margin-left:40px"><span style="font-weight: bold;">Dias que el jugador tiene de baja:</span> '+informe[0].agregado_dias_de_baja+' '+((parseInt(informe[0].agregado_dias_de_baja)===1)?"Día":"Días")+'</span></div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Localización de la lesion:</span> '+informe[0].agregado_localizacion_lesion+' </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Derivado seguro médico:</span> '+((informe[0].agregado_seguro_medico==="1")?"Si":"No")+' </div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Examenes realizados:</span> '+informe[0].agregado_examenes_realizados+'</div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Comentario de los examenes realizados:</span> '+informe[0].agregado_comentario_examen+'</div>\
            <div style="display:block;box-sizing: border-box;margin-bottom: 10px;"><span style="font-weight: bold;">Recidiva:</span> '+((informe[0].agregado_recidiva==="1")?"Si":"No")+' </div>\
        ';
        $("#infon_diagnostico").html(html_info_diagnostico) ; 
        $("#infon_diagnostico").css("display","block") ; 
    }
    else{
        $("#infon_diagnostico").css("display","none") ; 
    }
    $("#recomendacion_readaptadores").val(atencion_diaria.observacion_readaptor  ) ; 
    $("#tipo_alta_deportiva").empty() ; 
    renderizarCheckboxAltaDeportiva() ; 
    for(let contador0=0;contador0<atencion_diaria.alta_deportiva.length;contador0++){
        if(document.getElementById('checkbox_alta_deportiva_atencion_diaria_'+atencion_diaria.alta_deportiva[contador0].alta_deportiva_atencion_diaria)){
            $('#checkbox_alta_deportiva_atencion_diaria_'+atencion_diaria.alta_deportiva[contador0].alta_deportiva_atencion_diaria).prop("checked",true) ; 
        }
    }
    contarElementosAltaDeportiva() ; 
    for(let contador=0;contador<atencion_diaria.recomendacion_alta.length;contador++){
        if(document.getElementById('recomendacion_alta_'+atencion_diaria.recomendacion_alta[contador].recomendacion_alta_atencion_diaria)){
            $('#recomendacion_alta_'+atencion_diaria.recomendacion_alta[contador].recomendacion_alta_atencion_diaria).prop("checked",true)  ;  
        }
    }
    $("#formulario_modal_atencion_new").show() ; 
}

function mostrarJugador(value){
    window.id_ficha_jugador=value.split("_")[0] ; 
    let jugador=window.jugadoresPorSerie.filter(jug => jug.idfichaJugador===window.id_ficha_jugador)[0];
    $("#texto_fecha_cumple").text(formato_fecha_mes_texto(jugador.fechaNacimiento));
    $("#texto_posicion_cancha").text(jugador.texto_posicion);
    $("#contendor_imagen_jugador").html('<img style="border-radius: 100px;width:100%;height:100%;" id="imagen_jugador_'+value.split("_")[0]+'" src="./foto_jugadores/'+value.split("_")[0]+'.png?idasas='+new Date().getTime()+'"/>') ; 
    $("#contenedor_flex_segmento_izquierdo_formulario").css("align-content","start") ; 
    $("#contenedor_flex_segmento_izquierdo_formulario").empty() ; 
    $("#segmento_inferior_formulario").empty() ; 
    $("#nombre_jugador_formulario_new").text(" ") ; 
    let nombre_jugador=$('#option_select_jugador_'+value).text() ; 
    let codigo_serie=$("#serie_jugador").val() ; 
    let serie_jugador=$('#option_select_serie_jugador_'+codigo_serie).text() ; 
    $("#nombre_jugador_formulario_new").text(nombre_jugador) ;  
    $("#contenedor_flex_segmento_izquierdo_formulario").html(window.html_tipo_atencion) ; 
    generarOptionSelectTipoDeAtencion() ; 
    mostrarTipoDeFormulario($("#tipo_tipo_atencion_formulario").val()) ; 
    $("#formulario_modal_atencion_new").show() ; 
}

function mostrarTipoDeFormulario(tipo){
    $("#contenedor_flex_segmento_izquierdo_formulario").empty() ; 
    $("#contenedor_flex_segmento_izquierdo_formulario").html(window.html_tipo_atencion) ; 
    generarOptionSelectTipoDeAtencion() ; 
    $("#tipo_tipo_atencion_formulario").val(tipo) ; 
    $("#segmento_inferior_formulario").empty() ; 
    switch(tipo){
        case "1":formularioNuevoIncidente(tipo);break; 
        case "2":formularioControl(tipo);break; 
        case "3":formularioMedica(tipo);break; 
        case "4":formularioDeportiva(tipo);break; 
        case "5":formularioNuevaAtencion(tipo);break; 
        case "6":formularioControlMedico(tipo);break; 
        case "7":formularioSesionReadaptador(tipo);break; 
    }
}

async function formularioNuevaAtencion(tipo){
    await consultarContextosIncidentes() ; 
    $("#contexto_incidente_formulario").empty() ; 
    window.zonas_frt=[] ; 
    window.zonas_bck=[] ; 
    window.idzonas_frt=[] ; 
    window.idzonas_bck=[] ; 
    window.eliminar=[] ; 
    $("#contenedor_flex_segmento_izquierdo_formulario").css("align-content","start") ; 
    $("#contenedor_flex_segmento_izquierdo_formulario").append(html_nueva_atencion.parte_1) ; 
    $("#segmento_inferior_formulario").html(html_nueva_atencion.parte_2) ; 
    $("#radio_actual").prop("checked",true) ; 
    $("#sesion_actual_1").prop("checked",true) ; 
    $("#sesion_siguiente_1").prop("checked",true) ; 
    fechaRecomendacionReposoTotalHoy();
    fechaRecomendacionReposoDepotivoHoy();
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
    fechaIncidenteHoy() ; 
    $("#boton_agregar_infrome").prop("disabled",true) ; 
    if(window.id_informe){
        setTimeout(()=>{
            mostarDatosTipoFormulario(tipo,window.busqueda_respuesta_servidor[index_array_atencion_diaria])
        },1000) ; 
    }
}
function formularioControlMedico(tipo){
    // alert("formulario control medico");

    $("#contenedor_flex_segmento_izquierdo_formulario").css("align-content","flex-start") ; 
    $("#contenedor_flex_segmento_izquierdo_formulario").append(html_atencion_control_medico.parte_2) ; 
    $("#segmento_inferior_formulario").html(html_atencion_control_medico.parte_1) ; 
    $("#contenedor_radios_sesion").html(html_sesion.recomendaciones_1) ; 
    $("#numero_sesiones").empty() ; 
    $("#numero_sesiones").append('<option value="0">Seleccione</option>') ; 
    for(let contador_0=1;contador_0<=150;contador_0++){ 
        let option='<option value="'+contador_0+'">'+contador_0+'</option>' ; 
        $("#numero_sesiones").append(option) ; 
    }
    $("#porcentaje_recuperacion").append('<option value="0">Seleccione</option>') ; 
    for(let contador_1=1;contador_1<=100;contador_1++){
        let option='<option value="'+contador_1+'">'+contador_1+'%</option>' ; 
        $("#porcentaje_recuperacion").append(option) ; 
    }
    fechaAltaMedicaHoy();
    fechaRecomendacionReposoTotalHoy();
    fechaRecomendacionReposoDepotivoHoy();
    $("#sesion_actual_1").prop("checked",true) ; 
    $("#sesion_siguiente_1").prop("checked",true) ; 
    mostrarFechaReposoDeportivaSiguiente() ; 
    mostrarFechaReposoDeportiva() ; 
    sesion_radio() ; 
    $("#idinforme_medico").empty() ; 
    $("#idinforme_medico").append("<option value='0'>Seleccione</option>") ; 
    // console.log(window.respuesta_servidor_jugadores)
    // jugador
    let id_jugador=$("#jugador").val() ; 
    let jugador=window.respuesta_servidor_jugadores.filter(jugador => jugador.idfichaJugador===id_jugador.split("_")[0]) ; 
    // console.log(jugador)
    window.atencion_diaria_jugador=jugador[0] ; 
    let atencion_diaria=jugador[0] ; 
    for(let contador4=0;contador4<atencion_diaria.informes_medicos.length;contador4++){
        let inform_medico=atencion_diaria.informes_medicos[contador4] ; 
        let option="<option value='"+inform_medico.idinforme_medico+"'>"+inform_medico.diagnostico+"</option>" ; 
        $("#idinforme_medico").append(option) ; 
    }
    $("#boton_agregar_infrome").prop("disabled",true) ; 
    if(window.id_informe){
        setTimeout(()=>{
            mostarDatosTipoFormulario(tipo,window.busqueda_respuesta_servidor[index_array_atencion_diaria]) ; 
        },1000)
    }
}
function formularioSesionReadaptador(tipo){
    alert("formulario sesion readaptador");
}

async function formularioNuevoIncidente(tipo){
    await consultarTratamientos() ;
    await consultarContextosIncidentes() ;  
    $("#contexto_incidente_formulario").empty() ; 
    window.zonas_frt=[] ; 
    window.zonas_bck=[] ; 
    window.idzonas_frt=[] ; 
    window.idzonas_bck=[] ; 
    window.eliminar=[] ; 
    $("#contenedor_flex_segmento_izquierdo_formulario").css("align-content","start") ; 
    $("#contenedor_flex_segmento_izquierdo_formulario").append(html_atencion_nuevo_incidente.parte_1) ; 
    $("#segmento_inferior_formulario").html(html_atencion_nuevo_incidente.parte_2) ; 
    $("#contenedor_radios_sesion").html(html_sesion.recomendaciones_1) ; 
    $("#sesion_actual_1").prop("checked",true) ; 
    $("#sesion_siguiente_1").prop("checked",true) ; 
    // fechaReposoDeportivoHoy() ; 
    fechaRecomendacionReposoTotalHoy();
    fechaRecomendacionReposoDepotivoHoy();
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
    fechaIncidenteHoy() ; 
    $("#boton_agregar_infrome").prop("disabled",true) ; 
    if(window.id_informe){
        setTimeout(()=>{
            mostarDatosTipoFormulario(tipo,window.busqueda_respuesta_servidor[index_array_atencion_diaria])
        },1000) ; 
    }
    
}

async function formularioControl(tipo){
    // await consultarTratamientos() ; 
    await consultarTrabajoReadaptador() ; 
    await consultarContextosIncidentes() ; 
    
    // porcentaje_recuperacion
    $("#contenedor_flex_segmento_izquierdo_formulario").css("align-content","flex-start") ; 
    $("#contenedor_flex_segmento_izquierdo_formulario").append(html_atencion_control_sesion.parte_2) ; 
    $("#segmento_inferior_formulario").html(html_atencion_control_sesion.parte_1) ; 
    $("#contenedor_radios_sesion").html(html_sesion.recomendaciones_1) ; 
    $("#numero_sesiones").empty() ; 
    $("#numero_sesiones").append('<option value="0">Seleccione</option>') ; 
    for(let contador_0=1;contador_0<=150;contador_0++){ 
        let option='<option value="'+contador_0+'">'+contador_0+'</option>' ; 
        $("#numero_sesiones").append(option) ; 
    }
    $("#porcentaje_recuperacion").append('<option value="0">Seleccione</option>') ; 
    for(let contador_1=1;contador_1<=100;contador_1++){
        let option='<option value="'+contador_1+'">'+contador_1+'%</option>' ; 
        $("#porcentaje_recuperacion").append(option) ; 
    }
    fechaAltaMedicaHoy();
    fechaRecomendacionReposoTotalHoy();
    fechaRecomendacionReposoDepotivoHoy();
    $("#sesion_actual_1").prop("checked",true) ; 
    $("#sesion_siguiente_1").prop("checked",true) ; 
    mostrarFechaReposoDeportivaSiguiente() ; 
    mostrarFechaReposoDeportiva() ; 
    sesion_radio() ; 
    $("#idinforme_medico").empty() ; 
    $("#idinforme_medico").append("<option value='0'>Seleccione</option>") ; 
    // console.log(window.respuesta_servidor_jugadores)
    // jugador
    let id_jugador=$("#jugador").val() ; 
    let jugador=window.respuesta_servidor_jugadores.filter(jugador => jugador.idfichaJugador===id_jugador.split("_")[0]) ; 
    // console.log(jugador)
    window.atencion_diaria_jugador=jugador[0] ; 
    let atencion_diaria=jugador[0] ; 
    for(let contador4=0;contador4<atencion_diaria.informes_medicos.length;contador4++){
        let inform_medico=atencion_diaria.informes_medicos[contador4] ; 
        let option="<option value='"+inform_medico.idinforme_medico+"'>"+inform_medico.diagnostico+"</option>" ; 
        $("#idinforme_medico").append(option) ; 
    }
    $("#boton_agregar_infrome").prop("disabled",true) ; 
    if(window.id_informe){
        setTimeout(()=>{
            mostarDatosTipoFormulario(tipo,window.busqueda_respuesta_servidor[index_array_atencion_diaria]) ; 
        },1000)
    }
}

function fechaAltaMedicaHoy(){
    $("#fecha_alta").datetimepicker({
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
    $("#fecha_alta").datetimepicker('setDate', new Date() );
}

function formularioMedica(tipo){
    $("#segmento_inferior_formulario").empty() ; 
    $("#contenedor_flex_segmento_izquierdo_formulario").css("align-content","flex-start") ; 
    $("#contenedor_flex_segmento_izquierdo_formulario").append(html_atencion_alta_medica.parte_2) ; 
    $("#segmento_inferior_formulario").html(html_atencion_alta_medica.parte_1) ; 
    $("#boton_agregar_infrome").prop("disabled",true) ; 
    $("#idinforme_medico").empty() ; 
    $("#idinforme_medico").append("<option value='0'>Seleccione</option>") ; 
    let id_jugador=$("#jugador").val() ; 
    let jugador=window.respuesta_servidor_jugadores.filter(jugador => jugador.idfichaJugador===id_jugador.split("_")[0]) ; 
    // console.log(jugador)
    window.atencion_diaria_jugador=jugador[0] ; 
    let atencion_diaria=jugador[0] ; 
    for(let contador4=0;contador4<atencion_diaria.informes_medicos.length;contador4++){
        let inform_medico=atencion_diaria.informes_medicos[contador4] ; 
        let option="<option value='"+inform_medico.idinforme_medico+"'>"+inform_medico.diagnostico+"</option>" ; 
        $("#idinforme_medico").append(option) ; 
    }
    
    if(window.id_informe){
        setTimeout(()=>{
            mostarDatosTipoFormulario(tipo,window.busqueda_respuesta_servidor[index_array_atencion_diaria]) ; 
        },50)
    }
}

function formularioDeportiva(tipo){
    $("#segmento_inferior_formulario").empty() ; 
    $("#contenedor_flex_segmento_izquierdo_formulario").css("align-content","flex-start") ; 
    $("#contenedor_flex_segmento_izquierdo_formulario").append(html_atencion_alta_deportiva.parte_2) ; 
    $("#segmento_inferior_formulario").html(html_atencion_alta_deportiva.parte_1) ; 
    $("#boton_agregar_infrome").prop("disabled",true) ; 
    $("#idinforme_medico").empty() ; 
    $("#idinforme_medico").append("<option value='0'>Seleccione</option>") ; 
    let id_jugador=$("#jugador").val() ; 
    let jugador=window.respuesta_servidor_jugadores.filter(jugador => jugador.idfichaJugador===id_jugador.split("_")[0]) ; 
    // console.log(jugador)
    window.atencion_diaria_jugador=jugador[0] ; 
    let atencion_diaria=jugador[0] ; 
    for(let contador4=0;contador4<atencion_diaria.informes_medicos.length;contador4++){
        let inform_medico=atencion_diaria.informes_medicos[contador4] ; 
        let option="<option value='"+inform_medico.idinforme_medico+"'>"+inform_medico.diagnostico+"</option>" ; 
        $("#idinforme_medico").append(option) ; 
    }
    if(window.id_informe){
        setTimeout(()=>{
            mostarDatosTipoFormulario(tipo,window.busqueda_respuesta_servidor[index_array_atencion_diaria]) ; 
        },50)
    }
}

function sesion_radio(){
    if($("#radio_actual").prop("checked")){
        $("#texto_radio_actual").css("color","#404040") ; 
        $("#grupo_radios_sesion_actual").css("display","block") ; 
    }
    else{
        $("#texto_radio_actual").css("color","#adadad") ; 
        $("#grupo_radios_sesion_actual").css("display","none") ; 
    }
    if($("#radio_seguiente").prop("checked")){
        $("#texto_radio_seguiente").css("color","#404040") ; 
        $("#grupo_radios_sesion_siguiente").css("display","block") ; 
    }
    else{
        $("#texto_radio_seguiente").css("color","#adadad") ; 
        $("#grupo_radios_sesion_siguiente").css("display","none") ; 
    }
}

function mostrarFechaReposoDeportiva(){
    if($("#sesion_actual_1").prop("checked")){
        $("#actual_fecha_reposo_deportivo").css("display","inline-block") ; 
        $("#actual_fecha_reposo_total").css("display","none") ; 
        // fechaReposoDeportivoHoy()
    }
    else{
        $("#actual_fecha_reposo_deportivo").css("display","none") ; 
    }
    validarFormulario() ; 
}

function mostrarFechaReposoTotal(){
    if($("#sesion_actual_7").prop("checked")){
        $("#actual_fecha_reposo_total").css("display","inline-block") ; 
        $("#actual_fecha_reposo_deportivo").css("display","none") ; 
        // fechaReposoTotaloHoy()
    }
    else{
        $("#actual_fecha_reposo_total").css("display","none") ; 
    }
    validarFormulario() ; 
}

function mostrarFechaReposoDeportivaSiguiente(){
    if($("#sesion_siguiente_1").prop("checked")){
        // fechaReposoDeportivoHoySiguiente()
        $("#siguiente_fecha_reposo_deportivo").css("display","inline-block") ; 
        $("#siguiente_fecha_reposo_total").css("display","none") ; 
        
    }
    else{
        $("#siguiente_fecha_reposo_deportivo").css("display","none") ; 
    }
    validarFormulario() ; 
}

function mostrarFechaReposoTotalSiguiente(){
    if($("#sesion_siguiente_7").prop("checked")){
        $("#siguiente_fecha_reposo_total").css("display","inline-block") ; 
        $("#siguiente_fecha_reposo_deportivo").css("display","none") ; 
        // fechaReposoTotaloHoySiguiente()
    }
    else{
        $("#siguiente_fecha_reposo_total").css("display","none") ; 
    }
    validarFormulario() ; 
    
}

function fechaReposoDeportivoHoy(){
    $('.actual_fecha_reposo_deportivo').datetimepicker({
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
    $('#actual_fecha_reposo_deportivo').datetimepicker('setDate', new Date() );
}

function fechaReposoTotaloHoy(){
    $('.actual_fecha_reposo_total').datetimepicker({
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
    $('#actual_fecha_reposo_total').datetimepicker('setDate', new Date() );
}

function fechaReposoDeportivoHoySiguiente(){
    $('.siguiente_fecha_reposo_deportivo').datetimepicker({
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
    $('#siguiente_fecha_reposo_deportivo').datetimepicker('setDate', new Date() );
}

function fechaReposoTotaloHoySiguiente(){
    $('.siguiente_fecha_reposo_total').datetimepicker({
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
    $('#siguiente_fecha_reposo_total').datetimepicker('setDate', new Date() );
}


function fechaIncidenteHoy(){
    $('#fecha_incidente').datetimepicker({
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
    $('#fecha_incidente').datetimepicker('setDate', new Date() );
}

function fechaDeAltaHoy(){
    $('#fecha_de_alta').datetimepicker({
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
    $('#fecha_de_alta').datetimepicker('setDate', new Date() );
}

function consultarContextosIncidentes(){
    $.ajax({
        url: "post/atencion_diaria_federacion_consultar_contexto_incidente.php",
        type: "post",
        success: function(respuesta) {
            let json=JSON.parse(respuesta) ; 
            window.lista_contexto_incidente=json.respuesta ; 
            generarOptionSelectContextoIncidente() ; 
		},error: function(){// will fire when timeout is reached
			// alert("errorXXXXX");
    	}, timeout: 10000 // sets timeout to 3 seconds
	    });
}

function generarOptionSelectContextoIncidente(){
    let list_option_contexto_incidente=lista_contexto_incidente.map(contexto_incidente=> {
        return '<option id="option_select_contexto_incidente_form_modal_'+contexto_incidente.idcontexto_incidente+'" value="'+contexto_incidente.idcontexto_incidente+'" >'+contexto_incidente.nombre_contexto_incidente+'</option>' ; 
    })
    list_option_contexto_incidente.push('<option id="option_select_contexto_incidente_form_modal_0" value="0" >Otro</option>') ; 
    for(let contador=0;contador<list_option_contexto_incidente.length;contador++){
        $("#contexto_incidente_formulario").append(list_option_contexto_incidente[contador]) ; 
    }
    if(list_option_contexto_incidente.length===1){
        $("#campo_otro_contexto_incidente").css("display","flex") ; 
    }
}

function mostrarCampoOtroContextoIncidente(value){
    if(value==="0"){
        $("#campo_otro_contexto_incidente").css("display","flex") ; 
    }
    else{
        $("#campo_otro_contexto_incidente").css("display","none") ; 
    }
    validarFormulario() ; 
}

function generarOptionSelectTipoDeAtencion(){
    let lista =[
        {numero_tipo_atencion:1,nombre_tipo_atencion:"Nuevo Incidente"},
        {numero_tipo_atencion:5,nombre_tipo_atencion:"Nueva Atención"},
        {numero_tipo_atencion:2,nombre_tipo_atencion:"Control / Sesión kinesica"},
        {numero_tipo_atencion:6,nombre_tipo_atencion:"Control Medico"},
        {numero_tipo_atencion:7,nombre_tipo_atencion:"Sesión Readaptador"},
        {numero_tipo_atencion:3,nombre_tipo_atencion:"Alta Médica"},
        {numero_tipo_atencion:4,nombre_tipo_atencion:"Alta Deportiva"}
    ] ; 
    let list_option_tipo_atencion=lista.map(tipo_atencion=> {
        return '<option id="option_select_tipo_atencion_form_modal_'+tipo_atencion.numero_tipo_atencion+'" value="'+tipo_atencion.numero_tipo_atencion+'" >'+tipo_atencion.nombre_tipo_atencion+'</option>' ; 
    }) ; 
    for(let contador=0;contador<list_option_tipo_atencion.length;contador++){
        $("#tipo_tipo_atencion_formulario").append(list_option_tipo_atencion[contador]) ; 
    }
}

function mostrarCampoOtroTratamientoAplicado(){
    //li_otro_tratamiento_aplicado
    if($("#checkbox_tratamiento_aplicado_atencion_diaria_otro").prop("checked")){
        $("#li_otro_tratamiento_aplicado").css("display","block") ; 
    }
    else{
        $("#li_otro_tratamiento_aplicado").css("display","none") ; 
    }
}

function mostrarCampoOtroTrabajoReadaptdor(){
    //li_otro_tratamiento_aplicado
    if($("#checkbox_trabajo_readaptador_atencion_diaria_otro").prop("checked")){
        $("#li_trabajo_readaptador").css("display","block") ; 
    }
    else{
        $("#li_trabajo_readaptador").css("display","none") ; 
    }
}

function mostrarModalAgregarNuevoTratamiento(){
    $('#mensaje_agregar_DescargarBoleta').empty() ; 
    $("#contendor_botones_modal").empty() ; 
    $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar un nuevo tratamiento?</h5><br><img src="../config/agregar_archivo.png">');
    $("#contendor_botones_modal").html('\
        <button type="button" class="btn btn-default boton_modal" onClick="cerrarModalAtencionDiariaNuevo()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>\
        <button type="button" id="guardar" class="btn btn-default boton_modal " onClick="agregarNuevoTratamiento()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> \
    ') ; 
    $('#modalAtencionDiariaNuevo').modal('show');
}

function modalAgregarNuevoTrabajoReadaptador(){
    $('#mensaje_agregar_DescargarBoleta').empty() ; 
    $("#contendor_botones_modal").empty() ; 
    $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar un nuevo trabajo readaptador?</h5><br><img src="../config/agregar_archivo.png">');

    $("#contendor_botones_modal").html('\
    <button type="button" class="btn btn-default boton_modal" onClick="cerrarModalAtencionDiariaNuevo()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>\
        <button type="button" id="guardar" class="btn btn-default boton_modal " onClick="agregarNuevoTrabajoReadaptador()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> \
    ') ; 
    $('#modalAtencionDiariaNuevo').modal('show');
}

function cerrarModalAtencionDiariaNuevo(){
    $('#modalAtencionDiariaNuevo').modal('hide');
}

function mostrarExamenesSolicitados(value){
    if(value==="1"){
        $('#fila_examenes_solicitados').css("display","flex") ; 
    }
    else if(value==="0"){
        $('#fila_examenes_solicitados').css("display","none") ; 
    }
    else{
        // alert("seleccione")
        $('#fila_examenes_solicitados').css("display","none") ; 
    }
    validarFormulario() ; 
}

function agregarNuevoTratamiento(){
    let otro_tratamiento=$("#otro_tratamiento_aplicado").val() ; 
    let usuario_software=window.nombre_usuario_software ; 
    let datos_backend=[
        {name:"otro_tratamiento_aplicado",value:otro_tratamiento},
        {name:"nombre_usuario_software",value:usuario_software}
    ] ; 
    $.ajax({
        url: "post/atencion_diaria_federacion_agregar_tratamiento.php",
        type: "post",
        data:datos_backend,
        success: function(respuesta) {
            let json=JSON.parse(respuesta) ; 
            if(json.respuesta){
                consultarTratamiento2() ; 
                consultarTratamientos() ; 
                $('#modalAtencionDiariaNuevo').modal('hide');
            }
		},error: function(){// will fire when timeout is reached
			// alert("errorXXXXX");
    	}, timeout: 10000 // sets timeout to 3 seconds
	    });
}

function agregarNuevoTrabajoReadaptador(){
    let otro_trabajo_readaptador=$("#otro_trabajo_readaptador").val() ; 
    let usuario_software=window.nombre_usuario_software ; 
    let datos_backend=[
        {name:"otro_trabajo_readaptador",value:otro_trabajo_readaptador},
        {name:"nombre_usuario_software",value:usuario_software}
    ] ; 
    $.ajax({
        url: "post/atencion_diaria_federacion_agregar_trabajo_readaptor.php",
        type: "post",
        data:datos_backend,
        success: function(respuesta) {
            let json=JSON.parse(respuesta) ; 
            if(json.respuesta){
                
                consultarTrabajoReadaptador2() ; 
                consultarTrabajoReadaptador() ; 
                $('#modalAtencionDiariaNuevo').modal('hide');
            }
		},error: function(){// will fire when timeout is reached
			// alert("errorXXXXX");
    	}, timeout: 10000 // sets timeout to 3 seconds
	    });
}

function consultarTratamientos(){
    window.lista_tratamiento_aplicado=[] ; 
    window.lista_tratamiento_aplicado.push({idtratamiento_aplicado:"0",nombre_tratamiento_aplicado:"Todos"}) ; 
    $.ajax({
        url: "post/atencion_diaria_federacion_consultar_tratamiento.php",
        type: "post",
        success: function(respuesta) {
            $("#contenedor_tratamiento").empty() ; 
            let json=JSON.parse(respuesta) ; 
            // console.log(json.datos.length);
            
            for(let contador=0;contador<json.datos.length;contador++){
                window.lista_tratamiento_aplicado.push(json.datos[contador]) ; 
            }
            // alert(JSON.stringify(window.lista_tratamiento_aplicado))
            rederizarCheckboxTratamiento() ; 
		},error: function(){// will fire when timeout is reached
			// alert("errorXXXXX");
            rederizarCheckboxTratamiento() ; 
    	}, timeout: 10000 // sets timeout to 3 seconds
	    });
}

function consultarTrabajoReadaptador(){
    $("#contenedor_trabajo_readaptador").empty() ; 
    window.lista_trabajo_readaptador=[] ; 
    window.lista_trabajo_readaptador.push({idtrabajo_readatador :"0",trabajo_readatador:"Todos"}) ; 
    $.ajax({
        url: "post/atencion_diaria_federacion_consultar_trabajo_readaptador.php",
        type: "post",
        success: function(respuesta) {
            let json=JSON.parse(respuesta) ; 
            // console.log(json.datos.length);
            
            for(let contador=0;contador<json.datos.length;contador++){
                window.lista_trabajo_readaptador.push(json.datos[contador]) ; 
            }
            // console.log(lista_trabajo_readaptador.length);
            // alert(JSON.stringify( window.lista_trabajo_readaptador))
            rederizarCheckboxTrabajoReadaptador() ; 
		},error: function(){// will fire when timeout is reached
			// alert("errorXXXXX"); ; 
            rederizarCheckboxTrabajoReadaptador() ; 
    	}, timeout: 10000 // sets timeout to 3 seconds
	});
}


function validarFormulario(){//validaciones
    let tipo_atencion_formulario=$("#tipo_tipo_atencion_formulario").val() ; 
    switch(tipo_atencion_formulario){
        case "1":valiarFormularioNuevoIncidente();break;
        case "2":validarFormularioControl();break;
        case "3":validarFormularioAltaMedica();break;
        case "4":validarFormulariDeportiva();break;
        case "5":validarFormularioNuevaAtencion();break;
        case "6":validarFormularioControlMedico();break;
    }

}

function estadoFecha(){
    mostrarFechaReposoDeportiva() ; 
    mostrarFechaReposoTotal() ; 
    mostrarFechaReposoDeportivaSiguiente() ; 
    mostrarFechaReposoTotalSiguiente() ; 
    validarFormulario() ; 
}

function validarFormularioControlMedico(){
    let valor_select_numero_sesiones=$("#numero_sesiones").val() ; 
    // alert($("#numero_sesiones").val())
    let estado_select_numero_sesiones=false ; 
    if(valor_select_numero_sesiones!="0"){
        estado_select_numero_sesiones=true ; 
    }

    let estado_select=false ; 
    if(estado_select_numero_sesiones){
        estado_select=true ; 
    }
    if(estado_select){
        $("#boton_agregar_infrome").prop("disabled",false) ; 
    }
    else{
        $("#boton_agregar_infrome").prop("disabled",true) ; 
    }
}

function validarFormularioNuevaAtencion(){
    // console.log("validando... ")
    //campos
    let estado_diagnostico=validarCamposVacios2("diagnostico") ; 
    let estado_anamnesis=validarCamposVacios2("anamnesis") ; 
    let estado_indicaciones=validarCamposVacios2("indicaciones") ; 
    //
    //select
    let estado_indique_incidente=false ; 
    let estado_indique_incidente2=false ; 
    let valor_contexto_incidente_formulario=$("#contexto_incidente_formulario").val() ; 
    if(valor_contexto_incidente_formulario==="0"){
        // alert("cero texto")
        estado_indique_incidente=validarCamposVacios2("indique_incidente") ; 
    }
    else{
        estado_indique_incidente2=true ; 
    }
    //validando campos de texto
    let estado_campo_texto=false ; 
    if( estado_diagnostico){
        estado_campo_texto=true ; 
    }
    // validando checkbox examen solicitud
    let array_examen_solicitado = $('input[name="array_examen_solicitado[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    let estado_examenes_solicitados=false ; 
    if(array_examen_solicitado.length>0){
        estado_examenes_solicitados=true ; 
    }
    //------------------
    // console.log(array_checkbox_trabajo_readaptador_atencion_diaria)
    //validacion final
    if((zonas_frt.length>0 || zonas_bck.length>0) && estado_campo_texto){
        if(estado_indique_incidente || estado_indique_incidente2){
            $("#boton_agregar_infrome").prop("disabled",false) ; 
        }
    }
    else{
        $("#boton_agregar_infrome").prop("disabled",true) ; 
    }
}

function valiarFormularioNuevoIncidente(){
//  zonas_frt
//  zonas_bck
    // console.log("validando... ")
    //campos
    let estado_diagnostico=validarCamposVacios2("diagnostico") ; 
    let estado_anamnesis=validarCamposVacios2("anamnesis") ; 
    //
    //select
    let estado_derivado_seguro=validarSelectDeSiYNo("derivado_seguro") ; 
    // let estado_examen_solicitado=validarSelectDeSiYNo("examen_solicitado") ; 

    let estado_indique_incidente=false ; 
    let estado_indique_incidente2=false ; 
    let valor_contexto_incidente_formulario=$("#contexto_incidente_formulario").val() ; 
    if(valor_contexto_incidente_formulario==="0"){
        // alert("cero texto")
        estado_indique_incidente=validarCamposVacios2("indique_incidente") ; 
    }
    else{
        estado_indique_incidente2=true ; 
    }
    //validando campos de texto
    let estado_campo_texto=false ; 
    if( estado_diagnostico){
        estado_campo_texto=true ; 
    }
    // validando select que si valor sea otro menos  -> 00 que significa seleccionado
    let estado_select=false ; 
    if( estado_derivado_seguro){
        estado_select=true ; 
    }
    // validando checkbox examen solicitud
    let array_examen_solicitado = $('input[name="array_examen_solicitado[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    let estado_examenes_solicitados=false ; 
    if(array_examen_solicitado.length>0){
        estado_examenes_solicitados=true ; 
    }
    //------------------
    // validar checkbox list tratamiento aplicado
    let array_checkbox_tratamiento_aplicado_atencion_diaria = $('input[name="array_checkbox_tratamiento_aplicado_atencion_diaria[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    let estado_tratamiento_aplicado=false ; 
    if(array_checkbox_tratamiento_aplicado_atencion_diaria.length>0){
        estado_tratamiento_aplicado=true ; 
    }
    // console.log(array_checkbox_trabajo_readaptador_atencion_diaria)
    //validacion final
    if((zonas_frt.length>0 || zonas_bck.length>0) && estado_campo_texto){
        if(estado_indique_incidente || estado_indique_incidente2){
            $("#boton_agregar_infrome").prop("disabled",false) ; 
            //enviarDatos
        }
    }
    else{
        $("#boton_agregar_infrome").prop("disabled",true) ; 
    }
}

function validarFormularioControl(){
    // validar checkbox list tratamiento aplicado
    // let estado_examen_solicitado=validarSelectDeSiYNo("examen_solicitado")

    let valor_select_numero_sesiones=$("#numero_sesiones").val() ; 
    // alert($("#numero_sesiones").val())
    let estado_select_numero_sesiones=false ; 
    if(valor_select_numero_sesiones!="0"){
        estado_select_numero_sesiones=true ; 
    }

    let valor_select_porcentaje_recuperacion=$("#porcentaje_recuperacion").val() ; 
    let estado_select_porcentaje_recuperacion=false ; 
    if(valor_select_porcentaje_recuperacion!="0"){
        estado_select_porcentaje_recuperacion=true ; 
    }

    let estado_select=false ; 
    if(estado_select_numero_sesiones && estado_select_porcentaje_recuperacion){
        estado_select=true ; 
    }
    if(estado_select){
        $("#boton_agregar_infrome").prop("disabled",false) ; 
    }
    else{
        $("#boton_agregar_infrome").prop("disabled",true) ; 
    }
}

function validarFormularioAltaMedica(){
    let array_recomendacion_alta = $('input[name="array_recomendacion_alta[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    let estado_recomendacion_alta=false ; 
    if(array_recomendacion_alta.length>0){
        estado_recomendacion_alta=true ; 
    }
    let estado_observaciones_medica=validarCamposVacios2("recomendacion_medica") ; 
    if(estado_recomendacion_alta){
        $("#boton_agregar_infrome").prop("disabled",false) ; 
    }
    else{
        $("#boton_agregar_infrome").prop("disabled",true) ; 
    }
}

function validarFormulariDeportiva(){
    
    let array_recomendacion_alta = $('input[name="array_recomendacion_alta[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    let estado_recomendacion_alta=false ; 
    if(array_recomendacion_alta.length>0){
        estado_recomendacion_alta=true ; 
    }
    let estado_recomendacion_readaptadores=validarCamposVacios2("recomendacion_readaptadores")
    if(estado_recomendacion_alta){
        $("#boton_agregar_infrome").prop("disabled",false) ; 
    }
    else{
        $("#boton_agregar_infrome").prop("disabled",true) ; 
    }
}


function validarFormularioAltaMedicaOAltaKinesica(){
    //campos
    let estado_detalles_inidicaciones=validarCamposVacios2("detalles_inidicaciones") ; 
    //select
    let alta_entrar_serie=validarSelectDeSiYNo("alta_entrar_serie") ; 
    //validando campos de texto estado_examen_solicitado
    let estado_campo_texto=false ; 
    if(estado_detalles_inidicaciones ){
        estado_campo_texto=true ; 
    }
    // validando select que si valor sea otro menos  -> 00 que significa seleccionado
    let estado_select=false ; 
    if( alta_entrar_serie){
        estado_select=true ; 
    }
    //validacion final
    if(estado_campo_texto && estado_select){
        $("#boton_agregar_infrome").prop("disabled",false) ; 
    }
    else{
        $("#boton_agregar_infrome").prop("disabled",true) ; 
    }
}

function mostrarModalFormularioEnviarDatos(){
    if(!window.id_informe){
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar una nueva atención diaria?</h5><br><img src="../config/agregar_archivo.png">');
    }
    else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar esta atencion diaria?</h5><br><img src="../config/agregar_archivo.png">');
    }
    $("#contendor_botones_modal").empty() ; 
    $("#contendor_botones_modal").html('\
    <button type="button" class="btn btn-default boton_modal" onClick="cerrarModalFormularioEnviarDatos()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>\
        <button type="button" id="guardar" class="btn btn-default boton_modal " onClick="enviarDatos()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button> \
    ') ; 
    $('#modalAtencionDiariaNuevo').modal('show');
}

function cerrarModalFormularioEnviarDatos(){
    $('#modalAtencionDiariaNuevo').modal('hide');
}


function enviarDatos(){
    let tipo_atencion_formulario=$("#tipo_tipo_atencion_formulario").val() ; 
    if(!window.id_informe){
		$('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando atencion ...</h5><br><img src="../config/agregar_archivo.png">');
	}else{
	    $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando atencion ...</h5><br><img src="../config/agregar_archivo.png">');
	}
    let datos_formulario=$("#formulario_modal_atencion_new").serializeArray() ; 
    if(tipo_atencion_formulario==="1"){
        const estado_checkbox_tratamiento=validarCheckBoxs("checkbox_tratamiento_aplicado_atencion_diaria_","idtratamiento_aplicado",lista_tratamiento_aplicado) ; 
        const estado_checkbox_trabajo_readaptador=validarCheckBoxs("checkbox_trabajo_readaptador_atencion_diaria_","idtrabajo_readatador",lista_trabajo_readaptador) ; 
        let contador1=0 ; 
            while(contador1<datos_formulario.length){
                if(datos_formulario[contador1].name==="array_checkbox_tratamiento_aplicado_atencion_diaria[]"){
                    if(datos_formulario[contador1].value==="0"){
                        datos_formulario.splice(contador1,1) ; 
                    }
                }
                contador1++ ; 
            }
            if($("#examen_0").prop("checked")){
                datos_formulario.push({name:'examen_solicitado',value:"0"}) ; 
            }
            else{
                datos_formulario.push({name:'examen_solicitado',value:"1"}) ; 
            }
            // array_examen_solicitado[]
            let contador2=0 ; 
            while(contador2<datos_formulario.length){
                if(datos_formulario[contador2].name==="array_examen_solicitado[]"){
                    if(datos_formulario[contador2].value==="0"){
                        datos_formulario.splice(contador2,1) ; 
                    }
                }
                contador2++ ; 
            }
            datos_formulario=extraerZonasCuerpoFrente(datos_formulario) ; 
            datos_formulario=extraerZonasCuerpoTracera(datos_formulario) ; 
            // console.log(cuerpo_trasero)


            let fecha_atencion_diaria=$("#fecha_atencion").val() ; 
            datos_formulario.push({name:'id_ficha_jugador',value:window.id_ficha_jugador}) ; 
            datos_formulario.push({name:'fecha_atencion_diaria',value:fecha_atencion_diaria}) ; 
            datos_formulario.push({name:'tipo_formulario',value:tipo_atencion_formulario}) ; 
            datos_formulario.push({name:'id_informe',value:window.id_informe}) ; 
            datos_formulario.push({name:'nombre_usuario_software',value:window.nombre_usuario_software}) ; 
            datos_formulario.push({name:'id_atencion_diaria',value:window.id_atencion_diaria}) ; 
            $.ajax({
                url: "post/atencion_diaria_federacion_guardar.php",
                type: "post",
                data:datos_formulario
                ,success: function(respuesta) {
                    var json=JSON.parse(respuesta);
                    console.log(json) ; 
                    $('#modalAtencionDiariaNuevo').modal('hide');
                    consultarTratamiento2() ; 
                    consultarTrabajoReadaptador2() ; 
                    consultarContextosIncidente2() ; 
                    consulatarDespuesDeRegistrar_Actualizar_Eliminar() ; 
                    botonVolver() ; 
                    
                },error: function(){// will fire when timeout is reached
                    // alert("errorXXXXX");
                }, timeout: 10000 // sets timeout to 3 seconds
            });
            // modalidad_tipo_formulario
        if($("#derivado_seguro").val()==="1"){
            let datos_seguimiento=[] ; 
            datos_seguimiento.push({name:'id_ficha_jugador',value:window.id_ficha_jugador}) ; 
            datos_seguimiento.push({name:'diagnostico',value:$("#diagnostico").val()}) ; 
            datos_seguimiento.push({name:'fecha_accidente',value:$("#fecha_incidente").val()}) ; 
            datos_seguimiento.push({name:'nombre_usuario_software',value:window.nombre_usuario_software}) ; 
            datos_seguimiento.push({name:'modalidad_tipo_formulario',value:"null"}) ; 
            console.log(datos_seguimiento) ; 
            $.ajax({
                    url: "post/seguimiento_guardar.php",
                    type: "post",
                    data:datos_seguimiento
                    ,success: function(respuesta) {
                        var json=JSON.parse(respuesta);
                        console.log(json) ; 
                        $('#modalSeguimiento').modal('hide');
                        // consulatarDespuesDeRegistrar_Actualizar_Eliminar()
                        botonVolver() ; 
                        
                    },error: function(){// will fire when timeout is reached
                        // alert("errorXXXXX");
                    }, timeout: 10000 // sets timeout to 3 seconds
                });
            }
        
    }
    if(tipo_atencion_formulario==="2"){
        // alert("enviar datos control")
            let contador2=0 ; 
            while(contador2<datos_formulario.length){
                if(datos_formulario[contador2].name==="array_checkbox_trabajo_readaptador_atencion_diaria[]"){
                    if(datos_formulario[contador2].value==="0"){
                        datos_formulario.splice(contador2,1) ; 
                    }
                }
                contador2++ ; 
            }
            let fecha_atencion_diaria=$("#fecha_atencion").val() ; 
            datos_formulario.push({name:'id_ficha_jugador',value:window.id_ficha_jugador}) ; 
            datos_formulario.push({name:'fecha_atencion_diaria',value:fecha_atencion_diaria}) ; 
            datos_formulario.push({name:'tipo_formulario',value:tipo_atencion_formulario}) ; 
            datos_formulario.push({name:'id_informe',value:window.id_informe}) ; 
            datos_formulario.push({name:'nombre_usuario_software',value:window.nombre_usuario_software}) ; 
            datos_formulario.push({name:'id_atencion_diaria',value:window.id_atencion_diaria}) ; 
            console.log(datos_formulario) ; 
            $.ajax({
                url: "post/atencion_diaria_federacion_guardar.php",
                type: "post",
                data:datos_formulario
                ,success: function(respuesta) {
                    var json=JSON.parse(respuesta);
                    console.log(json) ; 
                    $('#modalAtencionDiariaNuevo').modal('hide');
                    consultarTratamiento2() ; 
                    consultarTrabajoReadaptador2() ; 
                    consultarContextosIncidente2() ; 
                    consulatarDespuesDeRegistrar_Actualizar_Eliminar() ; 
                    botonVolver() ; 
                    
                },error: function(){// will fire when timeout is reached
                    // alert("errorXXXXX");
                }, timeout: 10000 // sets timeout to 3 seconds
            });
    }
    if(tipo_atencion_formulario==="3"){
        // alert("enviar datos medica")
        let fecha_atencion_diaria=$("#fecha_atencion").val() ; 
        datos_formulario.push({name:'id_ficha_jugador',value:window.id_ficha_jugador}) ; 
        datos_formulario.push({name:'fecha_atencion_diaria',value:fecha_atencion_diaria}) ; 
        datos_formulario.push({name:'tipo_formulario',value:tipo_atencion_formulario}) ; 
        datos_formulario.push({name:'id_informe',value:window.id_informe}) ; 
        datos_formulario.push({name:'nombre_usuario_software',value:window.nombre_usuario_software}) ; 
        datos_formulario.push({name:'id_atencion_diaria',value:window.id_atencion_diaria}) ; 
        console.log(datos_formulario) ; 
        $.ajax({
                url: "post/atencion_diaria_federacion_guardar.php",
                type: "post",
                data:datos_formulario
                ,success: function(respuesta) {
                    var json=JSON.parse(respuesta);
                    console.log(json) ; 
                    $('#modalAtencionDiariaNuevo').modal('hide');
                    consultarTratamiento2() ; 
                    consultarTrabajoReadaptador2() ; 
                    consultarContextosIncidente2() ; 
                    consulatarDespuesDeRegistrar_Actualizar_Eliminar() ; 
                    botonVolver() ; 
                    
                },error: function(){// will fire when timeout is reached
                    // alert("errorXXXXX");
                }, timeout: 10000 // sets timeout to 3 seconds
            });
    }
    if(tipo_atencion_formulario==="4"){
        // alert("enviar datos deportiva")
        let fecha_atencion_diaria=$("#fecha_atencion").val() ; 
        datos_formulario.push({name:'id_ficha_jugador',value:window.id_ficha_jugador}) ; 
        datos_formulario.push({name:'fecha_atencion_diaria',value:fecha_atencion_diaria}) ; 
        datos_formulario.push({name:'tipo_formulario',value:tipo_atencion_formulario}) ; 
        datos_formulario.push({name:'id_informe',value:window.id_informe}) ; 
        datos_formulario.push({name:'nombre_usuario_software',value:window.nombre_usuario_software}) ; 
        datos_formulario.push({name:'id_atencion_diaria',value:window.id_atencion_diaria}) ; 
        console.log(datos_formulario) ; 
        $.ajax({
                url: "post/atencion_diaria_federacion_guardar.php",
                type: "post",
                data:datos_formulario
                ,success: function(respuesta) {
                    var json=JSON.parse(respuesta);
                    $('#modalAtencionDiariaNuevo').modal('hide');
                    consultarTratamiento2() ; 
                    consultarTrabajoReadaptador2() ; 
                    consultarContextosIncidente2() ; 
                    consulatarDespuesDeRegistrar_Actualizar_Eliminar() ; 
                    botonVolver() ; 
                    
                },error: function(){// will fire when timeout is reached
                    // alert("errorXXXXX");
                }, timeout: 10000 // sets timeout to 3 seconds
            });
    }
    if(tipo_atencion_formulario==="5"){
            if($("#examen_0").prop("checked")){
                datos_formulario.push({name:'examen_solicitado',value:"0"}) ; 
            }
            else{
                datos_formulario.push({name:'examen_solicitado',value:"1"}) ; 
            }
            // array_examen_solicitado[]
            let contador2=0 ; 
            while(contador2<datos_formulario.length){
                if(datos_formulario[contador2].name==="array_examen_solicitado[]"){
                    if(datos_formulario[contador2].value==="0"){
                        datos_formulario.splice(contador2,1) ; 
                    }
                }
                contador2++ ; 
            }
            datos_formulario=extraerZonasCuerpoFrente(datos_formulario) ; 
            datos_formulario=extraerZonasCuerpoTracera(datos_formulario) ; 
            // console.log(cuerpo_trasero)

            let fecha_atencion_diaria=$("#fecha_atencion").val() ; 
            datos_formulario.push({name:'id_ficha_jugador',value:window.id_ficha_jugador}) ; 
            datos_formulario.push({name:'fecha_atencion_diaria',value:fecha_atencion_diaria}) ; 
            datos_formulario.push({name:'tipo_formulario',value:tipo_atencion_formulario}) ; 
            datos_formulario.push({name:'id_informe',value:window.id_informe}) ; 
            datos_formulario.push({name:'nombre_usuario_software',value:window.nombre_usuario_software}) ; 
            datos_formulario.push({name:'id_atencion_diaria',value:window.id_atencion_diaria}) ; 
            $.ajax({
                url: "post/atencion_diaria_federacion_guardar.php",
                type: "post",
                data:datos_formulario
                ,success: function(respuesta) {
                    var json=JSON.parse(respuesta);
                    console.log(json) ; 
                    $('#modalAtencionDiariaNuevo').modal('hide');
                    consultarTratamiento2() ; 
                    consultarTrabajoReadaptador2() ; 
                    consultarContextosIncidente2() ; 
                    consulatarDespuesDeRegistrar_Actualizar_Eliminar() ; 
                    botonVolver() ; 
                    
                },error: function(){// will fire when timeout is reached
                    // alert("errorXXXXX");
                }, timeout: 10000 // sets timeout to 3 secondfffffffff
            });
    }
    if(tipo_atencion_formulario==="6"){
        // alert("enviar datos control")
            let fecha_atencion_diaria=$("#fecha_atencion").val() ; 
            datos_formulario.push({name:'id_ficha_jugador',value:window.id_ficha_jugador}) ; 
            datos_formulario.push({name:'fecha_atencion_diaria',value:fecha_atencion_diaria}) ; 
            datos_formulario.push({name:'tipo_formulario',value:tipo_atencion_formulario}) ; 
            datos_formulario.push({name:'id_informe',value:window.id_informe}) ; 
            datos_formulario.push({name:'nombre_usuario_software',value:window.nombre_usuario_software}) ; 
            datos_formulario.push({name:'id_atencion_diaria',value:window.id_atencion_diaria}) ; 
            console.log(datos_formulario) ; 
            $.ajax({
                url: "post/atencion_diaria_federacion_guardar.php",
                type: "post",
                data:datos_formulario
                ,success: function(respuesta) {
                    var json=JSON.parse(respuesta);
                    console.log(json) ; 
                    $('#modalAtencionDiariaNuevo').modal('hide');
                    consultarTratamiento2() ; 
                    consultarTrabajoReadaptador2() ; 
                    consultarContextosIncidente2() ; 
                    consulatarDespuesDeRegistrar_Actualizar_Eliminar() ; 
                    botonVolver() ; 
                    
                },error: function(){// will fire when timeout is reached
                    // alert("errorXXXXX");
                }, timeout: 10000 // sets timeout to 3 seconds
            });
    }
        
}

function modificandoDatosNuevoIncidente(datos_formulario,tipo_atencion){
    if($("#checkbox_tratamiento_aplicado_atencion_diaria_0").prop("checked")){
        datos_formulario.splice(6,1) ; 
    }
    if(datos_formulario[5].value===""){
        datos_formulario.splice(5,1) ; 
    }
    return datos_formulario ; 
}

function modificandoDatosControl(datos_formulario){
    if($("#checkbox_tratamiento_aplicado_atencion_diaria_0").prop("checked")){
        datos_formulario.splice(1,1) ; 
    }
    return datos_formulario ; 

}

const validarSelectDeSiYNo= (selector) =>{
    let estado=false;
    const exprecion=/[A-Za-z]/,
    campo=$('#'+selector).val() ; 
    if(campo!=="00"){
        estado=true ; 
    }
    return estado ; 
}

const validarCamposVacios= (selector) => {
    var estado=false;
    const exprecion=/[A-Za-z]/,
    campo=$('#'+selector).val() ; 
    if(campo!=""){
        if(exprecion.test(campo)){
            // alert("OK")
            estado=true;
            $('#'+selector).css("background-color", "#fff");
        }
        else{
            // alert("no puede solo enviar espacion en blanco en el informe")
            $('#'+selector).css("background-color", "#ffc6c6");
        }
    }
    else{
        // alert("no puede enviar la descripcicón de un informe vacio")
        $('#'+selector).css("background-color", "#ffc6c6");
    }
    return estado ; 
}

const validarCamposVacios2 = (nombre) => {
    let estado=false;
    const exprecion=/[A-Za-z]/,
    campo=$('#'+nombre).val() ; 
    if(campo!=""){
        if(exprecion.test(campo)){
            // alert("OK")
            estado=true;
        }
    }
    return estado ; 
}

const validarCheckBoxs= (nombre_selector,nombre_propiedad,lista) => {
    var contador=0;
    var validar_checkbox=false;
    while(contador<lista.length){
        if($('#'+nombre_selector+lista[contador][nombre_propiedad]).prop("checked")){
            validar_checkbox=true ; 
        }
        contador++ ; 
    }
    return validar_checkbox ; 
}


function rederizarCheckboxTratamiento(){
    const lis=lista_tratamiento_aplicado.map((tratamiento_aplicado)=>{
        const funcion=(tratamiento_aplicado.idtratamiento_aplicado==0)?'selecionarTodosTratamientoAplicados':'activarBotonGuardarInforme' ; 

        return "<span ><label class='option'><input type='checkbox' style='margin-left:5px;margin-right: 3px;margin-top:0px;' id='checkbox_tratamiento_aplicado_atencion_diaria_"+tratamiento_aplicado.idtratamiento_aplicado+"' name='array_checkbox_tratamiento_aplicado_atencion_diaria[]' value='"+tratamiento_aplicado.idtratamiento_aplicado+"' data-eliminar='0' onclick='"+funcion+"()' ><span class='label_s' style='font-size: 12px;'>"+tratamiento_aplicado.nombre_tratamiento_aplicado+"</span> </label></span>" ; 
    })
    if($("#contenedor_tratamiento").html()!=""){
        console.log("no esta basio") ; 
    }
    else{
        console.log("esta basio") ; 
        lis.push("<span id='li_otro_tratamiento_aplicado' style='display:none;'><label class='option' style='width:100%'><input type='text' style='width:70%;height: 100%;margin-bottom:0;' id='otro_tratamiento_aplicado' name='otro_tratamiento_aplicado' /><input type='button' id='boton_agregar_otro_tratamiento_aplicado' style='width:15%;height:100%;margin-left:5%;' value='+' onClick='mostrarModalAgregarNuevoTratamiento()'/></label></span>") ; 
        lis.push("<span ><label class='option'><input type='checkbox' style='margin-left:5px;margin-right: 3px;margin-top:0px;' id='checkbox_tratamiento_aplicado_atencion_diaria_otro' value='otro' data-eliminar='0' onclick='mostrarCampoOtroTratamientoAplicado()' ><span class='label_s' style='font-size:12px'>Otro</span> </label></span>") ; 
        lis.map((lista)=>{
            $("#contenedor_tratamiento").html($("#contenedor_tratamiento").html()+lista) ; 
        })
    }
}

function rederizarCheckboxTrabajoReadaptador(){
    const lis=lista_trabajo_readaptador.map((trabajo_redaptador)=>{// idtrabajador_readatador
        const funcion=(parseInt(trabajo_redaptador.idtrabajo_readatador) ===0)?'selecionarTodosTrabajoReadaptador':'activarBotonGuardarInforme' ; 

        return "<span><label class='option'><input type='checkbox' style='margin-left:5px;margin-right: 3px;margin-top:0px;' id='checkbox_trabajo_readaptador_atencion_diaria_"+trabajo_redaptador.idtrabajo_readatador+"' name='array_checkbox_trabajo_readaptador_atencion_diaria[]' value='"+trabajo_redaptador.idtrabajo_readatador+"' data-eliminar='0' onclick='"+funcion+"()' ><span class='label_s' style='font-size:12px;'>"+trabajo_redaptador.trabajo_readatador+"</span> </label></span>" ; 
    })
    if($("#contenedor_trabajo_readaptador").html()!=""){
        console.log("no esta basio") ; 
    }
    else{
        console.log("esta basio") ; 
        lis.push("<span id='li_trabajo_readaptador' style='display:none;'><label class='option' style='width:100%'><input type='text' style='width:70%;height: 100%;margin-bottom:0;' id='otro_trabajo_readaptador' name='otro_trabajo_readaptador' /><input type='button' id='boton_agregar_otro_trabajo_readaptador' style='width:15%;height:100%;margin-left:5%;' value='+' onClick='modalAgregarNuevoTrabajoReadaptador()'/></label></span>") ; 
        lis.push("<span><label class='option'><input type='checkbox' style='margin-left:5px;margin-right: 3px;margin-top:0px;' id='checkbox_trabajo_readaptador_atencion_diaria_otro' value='otro' data-eliminar='0' onclick='mostrarCampoOtroTrabajoReadaptdor()' ><span class='label_s' style='font-size:12px;'>Otro</span> </label></span>") ; 
        lis.map((lista)=>{
            $("#contenedor_trabajo_readaptador").html($("#contenedor_trabajo_readaptador").html()+lista) ; 
        })
    }
}

function selecionarTodosSerieFiltro(){
    /*en esta lime conprovamos si el checkbox 0 del filtro area esta activo o no
    y en caso de que este activo activa todos los checkbox del filtro de area o 
    en caso contrario los desactiva
    y ejecuta la busqueda
    */
    if($("#checkbox_serie_filtro_atencion_diaria_00_0").prop("checked")){
        lista_serie.map((serie)=>{
            $('#checkbox_serie_filtro_atencion_diaria_'+serie.numero_serie).prop("checked",true) ; 
        })
        $("#texto_boton_filtro_serie").text('Todos') ; 
    }
    else{
        lista_serie.map((serie)=>{
            $('#checkbox_serie_filtro_atencion_diaria_'+serie.numero_serie).prop("checked",false) ; 
        })
        $("#texto_boton_filtro_serie").text('Seleccione un Área') ; 
    }
    buscarAtencionesDiariasFiltro() ; 
}

function selecionarTodosTipoAtencionFiltro(){
    /*en esta lime conprovamos si el checkbox 0 del filtro area esta activo o no
    y en caso de que este activo activa todos los checkbox del filtro de area o 
    en caso contrario los desactiva
    y ejecuta la busqueda
    */
    if($("#checkbox_tipo_atencion_filtro_atencion_diaria_0").prop("checked")){
        lista_tipo_atencion.map((tipo_atencion)=>{
            $('#checkbox_tipo_atencion_filtro_atencion_diaria_'+tipo_atencion.numero_tipo_atencion).prop("checked",true) ; 
        })
        $("#texto_boton_filtro_tipo_atencion").text("Todos") ; 
    }
    else{
        lista_tipo_atencion.map((tipo_atencion)=>{
            $('#checkbox_tipo_atencion_filtro_atencion_diaria_'+tipo_atencion.numero_tipo_atencion).prop("checked",false) ; 
        })
        $("#texto_boton_filtro_tipo_atencion").text("Seleccione un Tipo de Atención") ; 
    }
    buscarAtencionesDiariasFiltro() ; 
}

function activarBotonGuardarInforme(){
    let array_checkbox_tratamiento_aplicado_atencion_diaria = $('input[name="array_checkbox_tratamiento_aplicado_atencion_diaria[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    if(array_checkbox_tratamiento_aplicado_atencion_diaria.length>0){
        if(array_checkbox_tratamiento_aplicado_atencion_diaria.length<=lista_tratamiento_aplicado.length-1){
            if(array_checkbox_tratamiento_aplicado_atencion_diaria.length==lista_tratamiento_aplicado.length-1 && !$("#checkbox_tratamiento_aplicado_atencion_diaria_0").prop("checked")){
                $("#checkbox_tratamiento_aplicado_atencion_diaria_0").prop("checked",true) ; 
            }
            else{
                
                if($("#checkbox_tratamiento_aplicado_atencion_diaria_0").prop("checked")){
                    $("#checkbox_tratamiento_aplicado_atencion_diaria_0").prop("checked",false) ; 
                    array_checkbox_tratamiento_aplicado_atencion_diaria.shift() ; 
                }
            }
        }
    }
    /////////
    let array_checkbox_trabajo_readaptador_atencion_diaria = $('input[name="array_checkbox_trabajo_readaptador_atencion_diaria[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    if(array_checkbox_trabajo_readaptador_atencion_diaria.length>0){
        if(array_checkbox_trabajo_readaptador_atencion_diaria.length<=lista_trabajo_readaptador.length-1){
            if(array_checkbox_trabajo_readaptador_atencion_diaria.length==lista_trabajo_readaptador.length-1 && !$("#checkbox_trabajo_readaptador_atencion_diaria_0").prop("checked")){
                $("#checkbox_trabajo_readaptador_atencion_diaria_0").prop("checked",true) ; 
            }
            else{
                
                if($("#checkbox_trabajo_readaptador_atencion_diaria_0").prop("checked")){
                    $("#checkbox_trabajo_readaptador_atencion_diaria_0").prop("checked",false) ; 
                    array_checkbox_trabajo_readaptador_atencion_diaria.shift() ; 
                }
                
            }
        }
    }
    // valiarFormularioNuevoIncidente()
    validarFormulario() ; 
}

function selecionarTodosTratamientoAplicados(){
    /*en esta lime conprovamos si el checkbox 0 del filtro area esta activo o no
    y en caso de que este activo activa todos los checkbox del filtro de area o 
    en caso contrario los desactiva
    y ejecuta la busqueda
    */
    if($("#checkbox_tratamiento_aplicado_atencion_diaria_0").prop("checked")){
        lista_tratamiento_aplicado.map((tratamiento)=>{
            $('#checkbox_tratamiento_aplicado_atencion_diaria_'+tratamiento.idtratamiento_aplicado).prop("checked",true) ; 
            //checkbox_tratamiento_aplicado_atencion_diaria_2
        }) ; 
        $("#texto_boton_tipo_tratamiento").text("Todos") ; 
        validarFormulario() ; 
    }
    else{
        lista_tratamiento_aplicado.map((tratamiento)=>{
            $('#checkbox_tratamiento_aplicado_atencion_diaria_'+tratamiento.idtratamiento_aplicado).prop("checked",false) ; 
        }) ; 
        $("#texto_boton_tipo_tratamiento").text("Seleccione una Tratamiento") ; 
        validarFormulario() ; 
    }
}

function selecionarTodosTrabajoReadaptador(){
    /*en esta lime conprovamos si el checkbox 0 del filtro area esta activo o no
    y en caso de que este activo activa todos los checkbox del filtro de area o 
    en caso contrario los desactiva
    y ejecuta la busqueda
    */
    if($("#checkbox_trabajo_readaptador_atencion_diaria_0").prop("checked")){
        lista_trabajo_readaptador.map((trabajo_readaptador)=>{
            $('#checkbox_trabajo_readaptador_atencion_diaria_'+trabajo_readaptador.idtrabajo_readatador).prop("checked",true) ; 
            //checkbox_trabajo_readaptador_atencion_diaria_2
        }) ; 
        // valiarFormularioNuevoIncidente()
    }
    else{
        lista_trabajo_readaptador.map((trabajo_readaptador)=>{
            $('#checkbox_trabajo_readaptador_atencion_diaria_'+trabajo_readaptador.idtrabajo_readatador).prop("checked",false) ; 
        }) ; 
        // valiarFormularioNuevoIncidente()
    }
}

function buscarAtencionesDiariasFiltro(){
    estatusCheckboxSerieFiltro() ; 
    estatusCheckboxAtencionDiariaFiltro() ; 
    buscarJugador() ; 
}

function estatusCheckboxSerieFiltro(){
    let array_checkbox_serie_filtro_atencion_diaria = $('input[name="array_checkbox_serie_filtro_atencion_diaria[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    if(array_checkbox_serie_filtro_atencion_diaria.length==1){
        const serie=lista_serie.filter((serie)=>{
            if(serie.numero_serie===array_checkbox_serie_filtro_atencion_diaria[0]){
                return serie ; 
            }
        }) ; 
        $("#texto_boton_filtro_serie").text(serie[0].nombre_serie) ; 
    }
    else if(array_checkbox_serie_filtro_atencion_diaria.length>0){
        if(array_checkbox_serie_filtro_atencion_diaria.length<=lista_serie.length-1){
            if(array_checkbox_serie_filtro_atencion_diaria.length==lista_serie.length-1 && !$("#checkbox_serie_filtro_atencion_diaria_00_0").prop("checked")){
                $("#checkbox_serie_filtro_atencion_diaria_00_0").prop("checked",true) ; 
                $("#texto_boton_filtro_serie").text("Todos") ; 
            }
            else{
                if($("#checkbox_serie_filtro_atencion_diaria_00_0").prop("checked")){
                    $("#checkbox_serie_filtro_atencion_diaria_00_0").prop("checked",false) ; 
                    array_checkbox_serie_filtro_atencion_diaria.shift() ; 
                }
                
                $("#texto_boton_filtro_serie").text(array_checkbox_serie_filtro_atencion_diaria.length+" Elementos Selecionados") ; 
            }
        }
    }
    else{
        // alert("hola")
        $("#texto_boton_filtro_serie").text("Seleccione una Serie") ; 
    }
}

function estatusCheckboxAtencionDiariaFiltro(){
    let array_checkbox_tipo_atencion_filtro_atencion_diaria = $('input[name="array_checkbox_tipo_atencion_filtro_atencion_diaria[]"]:checked').map(function(){ 
        return this.value; 
    }).get();
    if(array_checkbox_tipo_atencion_filtro_atencion_diaria.length==1){
        const tipo_atencion=lista_tipo_atencion.filter((tipo_atencion)=>{
            if(tipo_atencion.numero_tipo_atencion===parseInt(array_checkbox_tipo_atencion_filtro_atencion_diaria[0])){
                return tipo_atencion ; 
            }
        })
        $("#texto_boton_filtro_tipo_atencion").text(tipo_atencion[0].nombre_tipo_atencion) ; 
    }
    else if(array_checkbox_tipo_atencion_filtro_atencion_diaria.length>0){
        if(array_checkbox_tipo_atencion_filtro_atencion_diaria.length<=lista_tipo_atencion.length-1){
            if(array_checkbox_tipo_atencion_filtro_atencion_diaria.length==lista_tipo_atencion.length-1 && !$("#checkbox_tipo_atencion_filtro_atencion_diaria_0").prop("checked")){
                $("#checkbox_tipo_atencion_filtro_atencion_diaria_0").prop("checked",true) ; 
                $("#texto_boton_filtro_tipo_atencion").text("Todos") ; 
            }
            else{
                if($("#checkbox_tipo_atencion_filtro_atencion_diaria_0").prop("checked")){
                    $("#checkbox_tipo_atencion_filtro_atencion_diaria_0").prop("checked",false) ; 
                    array_checkbox_tipo_atencion_filtro_atencion_diaria.shift() ; 
                }
                $("#texto_boton_filtro_tipo_atencion").text(array_checkbox_tipo_atencion_filtro_atencion_diaria.length+' Elementos Selecionados') ; 
            }
        }
    }
    else{
        // alert("hola")
        $("#texto_boton_filtro_tipo_atencion").text("Seleccione un Tipo de Atención") ; 
    }
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

function fechaRecomendacionReposoDepotivoHoy(){
    $('#reposo_deportivo').datetimepicker({
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
    $('#reposo_deportivo').datetimepicker('setDate', new Date() );
}
function fechaRecomendacionReposoTotalHoy(){
    $('#reposo_total').datetimepicker({
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
    $('#reposo_total').datetimepicker('setDate', new Date() );
}

function fechaInicioHoy(){
    $('.fecha_inicio').datetimepicker({
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
    $('.fecha_inicio').datetimepicker('setDate', fecha );
}

function fechaFinalHoy(){
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
}

function fechaAtencionDiariaHoy(){
    $('#fecha_atencion').datetimepicker({
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
    $('#fecha_atencion').datetimepicker('setDate', new Date() );
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

</script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script type="text/javascript">
    mostrar_al_cargar_pagina();
    fechaInicioHoy() ; 
    fechaFinalHoy() ; 
    buscarJugador() //esta funcion consulta los jugadores para despues mostrarlos en la tabla
    consultarTratamiento2() ; 
    consultarTrabajoReadaptador2() ; 
    consultarContextosIncidente2() ; 
    $(document).on('click', '.option', function(e) { //
        e.stopPropagation();
    });
    $('.c_objetivo_fisico li').click(function (e) { e.stopPropagation(); });
    $("#boton_serie").on("click",()=>{
        const lis=lista_serie.map((serie)=>{
            /*en esta variable almacenamos el nombre de la funcion que ejecutara el checkbox al hacer onclick
            si la condicion es true significa que el checkbox tiene el metodo para activar o desactivar los demas checkbox (selecionarTodosAreaFiltro)
            en el filtro y asubes realiza una consulta al servidor y es caso que sea false solo tiene el metodo que ejecuta una consulta al servidor del cual es (buscarAtencionesDiariasFiltro)
            */
            const funcion=(serie.numero_serie==="00_0")?'selecionarTodosSerieFiltro':'buscarAtencionesDiariasFiltro' ; 

            return "<li><label class='option'><span class='label_s'>"+serie.nombre_serie+"</span> <input type='checkbox' id='checkbox_serie_filtro_atencion_diaria_"+serie.numero_serie+"' name='array_checkbox_serie_filtro_atencion_diaria[]' value='"+serie.numero_serie+"' data-eliminar='0' onclick='"+funcion+"()' ></label></li>" ; 
        }) ; 
        if($("#tipo_serie").html()!=""){
            console.log("no esta basio") ; 
        }
        else{
            console.log("esta basio")
            lis.map((lista)=>{
                $("#tipo_serie").html($("#tipo_serie").html()+lista) ; 
            }) ; 
        }
    });
    $("#boton_tipo_atencion").on("click",()=>{
        const lis=lista_tipo_atencion.map((tipo_atencion)=>{
            /*en esta variable almacenamos el nombre de la funcion que ejecutara el checkbox al hacer onclick
            si la condicion es true significa que el checkbox tiene el metodo para activar o desactivar los demas checkbox (selecionarTodosAreaFiltro)
            en el filtro y asubes realiza una consulta al servidor y es caso que sea false solo tiene el metodo que ejecuta una consulta al servidor del cual es (buscarAtencionesDiariasFiltro)
            */
            const funcion=(tipo_atencion.numero_tipo_atencion==0)?'selecionarTodosTipoAtencionFiltro':'buscarAtencionesDiariasFiltro' ; 

            return "<li><label class='option'><span class='label_s'>"+tipo_atencion.nombre_tipo_atencion+"</span> <input type='checkbox' id='checkbox_tipo_atencion_filtro_atencion_diaria_"+tipo_atencion.numero_tipo_atencion+"' name='array_checkbox_tipo_atencion_filtro_atencion_diaria[]' value='"+tipo_atencion.numero_tipo_atencion+"' data-eliminar='0' onclick='"+funcion+"()' ></label></li>" ; 
        }) ; 
        if($("#tipo_tipo_atencion").html()!=""){
            console.log("no esta basio") ; 
        }
        else{
            console.log("esta basio") ; 
            lis.map((lista)=>{
                $("#tipo_tipo_atencion").html($("#tipo_tipo_atencion").html()+lista) ; 
            }) ; 
        }
    });
    function contarElementosAltaDeportiva(){
        const lista_alta_deportiva=[
            {idalta_deportiva:1,alta_deportiva:"entrenamiento"},
            {idalta_deportiva:2,alta_deportiva:"partido"}
        ] ; 
        let array_checkbox_alta_deportiva_atencion_diaria = $('input[name="array_checkbox_alta_deportiva_atencion_diaria[]"]:checked').map(function(){ 
            return this.value; 
        }).get();
        if(array_checkbox_alta_deportiva_atencion_diaria.length===1){
            let alta_deportiva=lista_alta_deportiva.filter(alta => alta.idalta_deportiva===parseInt(array_checkbox_alta_deportiva_atencion_diaria[0])) ; 
            $("#texto_boton_alta_deportiva").text(alta_deportiva[0].alta_deportiva) ; 
        }   
        else{
            if(array_checkbox_alta_deportiva_atencion_diaria.length>1){
            $("#texto_boton_alta_deportiva").text(array_checkbox_alta_deportiva_atencion_diaria.length+" elementos seleccionados") ; 
            }
            else{
                $("#texto_boton_alta_deportiva").text("Seleccion una alta deportiva") ; 
            }
        }
    }

    function renderizarCheckboxAltaDeportiva(){
        const lista_alta_deportiva=[
            {idalta_deportiva:1,alta_deportiva:"entrenamiento"},
            {idalta_deportiva:2,alta_deportiva:"partido"}
        ] ; 
        const lis=lista_alta_deportiva.map((alta_deportiva)=>{
            /*en esta variable almacenamos el nombre de la funcion que ejecutara el checkbox al hacer onclick
            si la condicion es true significa que el checkbox tiene el metodo para activar o desactivar los demas checkbox (selecionarTodosAreaFiltro)
            en el filtro y asubes realiza una consulta al servidor y es caso que sea false solo tiene el metodo que ejecuta una consulta al servidor del cual es (buscarAtencionesDiariasFiltro)
            */

            return "<li><label class='option'><span class='label_s'>"+alta_deportiva.alta_deportiva+"</span> <input type='checkbox' id='checkbox_alta_deportiva_atencion_diaria_"+alta_deportiva.idalta_deportiva+"' name='array_checkbox_alta_deportiva_atencion_diaria[]' value='"+alta_deportiva.idalta_deportiva+"' data-eliminar='0' onchange='contarElementosAltaDeportiva()' ></label></li>" ; 
        }) ; 
        if($("#tipo_alta_deportiva").html()!=""){
            console.log("no esta basio") ; 
        }
        else{
            console.log("esta basio") ; 
            lis.map((lista)=>{
                $("#tipo_alta_deportiva").html($("#tipo_alta_deportiva").html()+lista) ; 
            }) ; 
        }
    } 

    function renderizarCheckboxExamenesSolicitados(){
        const lista_examenes=[
            {idExamen:1,examen:"Resonancia Magenética"},
            {idExamen:2,examen:"Radiografía"},
            {idExamen:3,examen:"Scanner / TAC"},
            {idExamen:4,examen:"Artroscopia"},
            {idExamen:5,examen:"Ecotomografía"},
            {idExamen:6,examen:"Fisico"},
            {idExamen:7,examen:"Clinico"},
            {idExamen:0,examen:"Ninguno"}
        ] ; 
        const lis=lista_examenes.map((alta_deportiva)=>{

            return "<li><label class='option'><span class='label_s'>"+alta_deportiva.examen+"</span> <input type='checkbox' id='examen_"+alta_deportiva.idExamen+"' name='array_examen_solicitado[]' value='"+alta_deportiva.idExamen+"' data-eliminar='0' ></label></li>" ; 
        }) ; 
        if($("#lista_examenes_solicitados").html()!=""){
            console.log("no esta basio") ; 
        }
        else{
            console.log("esta basio") ; 
            lis.map((lista)=>{
                $("#lista_examenes_solicitados").html($("#lista_examenes_solicitados").html()+lista) ; 
            }) ; 
        }
    } 

    function contarElementosExamenesSolicitados(){
        const lista_examenes=[
            {idExamen:1,examen:"Resonancia Magenética"},
            {idExamen:2,examen:"Radiografía"},
            {idExamen:3,examen:"Scanner / TAC"},
            {idExamen:4,examen:"Artroscopia"},
            {idExamen:5,examen:"Ecotomografía"},
            {idExamen:6,examen:"Fisico"},
            {idExamen:7,examen:"Clinico"},
            {idExamen:0,examen:"Ninguno"}
        ] ; 
        let array_examen_solicitado = $('input[name="array_examen_solicitado[]"]:checked').map(function(){ 
            return this.value; 
        }).get();
        if(array_examen_solicitado.length===1){
            const examne_selecionado=lista_examenes.filter(examen=> parseInt(array_examen_solicitado[0])===examen.idExamen) ; 
            // alert(examne_selecionado[0].examen)
            $("#texto_boton_examenes_solicitados").text(examne_selecionado[0].examen) ; 
        }
        else{
            if(array_examen_solicitado.length>1){
                $("#texto_boton_examenes_solicitados").text(array_examen_solicitado.length+" elementos seleccionados") ; 
            }
            else{
                $("#texto_boton_examenes_solicitados").text("Seleccion un Examen") ; 
            }
        }
        
    }

</script>