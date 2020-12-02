<?PHP
include('../config/datos.php');
session_start();
if(!(isset($_SESSION["nombre_usuario_software"]))){
    session_destroy();
    header('Location: ../index.php?cerrar_sesion=1');
}
else{
    $menu_actual="perfil_f";
    $submenu_actual="perfil_fisico";
    $seccion_comentarios = $comentarios['perfil_fisico'];//mis cuotas
    $demo_seccion = $demo['perfil_fisico'];
    $nombre_pestana_navegador='Perfil';

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
        <title><?php echo $nombre_pestana_navegador;?> | Fisico</title>

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
                    <!-- grafico -->
                    <style>
                        .highcharts-figure, .highcharts-data-table table {
                            min-width: 320px;
                            max-width: 1500px;
                            margin: 1em auto;
                        }

                        .highcharts-data-table table {
                            font-family: Verdana, sans-serif;
                            border-collapse: collapse;
                            border: 1px solid #EBEBEB;
                            margin: 10px auto;
                            text-align: center;
                            width: 100%;
                            max-width: 1000px;
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
                    <div style="box-sizing:border-box;border:0;display:inline-flex;flex-direction:row;flex-wrap:wrap;width:100%;height: 696px;margin-bottom:20px;">
                        <div style="box-sizing:border-box;border:0;width:25%;height:100%;/*background:lime;*/border-right:2px solid #a2a2a2;border-bottom:2px solid #a2a2a2;">

                            <div style="box-sizing:border-box;border:0;width:100%;height:130px;background:#404040;padding-top:10px;">

                                <img style="box-sizing:border-box;border:0;display:block;width:110px;height:110px;margin-left:auto;margin-right:auto;" src="../config/logo_equipo.png" alt="imagen_logo_equipo"/>
                        
                            </div>

                            <div style="box-sizing:border-box;border:0;width:75%;margin-top:15px;margin-bottom:15px;margin-left:auto;margin-right:auto;display:flex;">
                                <a class="btn btn-md btn-primary green-a" style="width: 30%;height: 18.5px;background-color:#fff;"><div><p class="ellipsis-text" style="font-weight: bold;color:#555;">Serie</p></div></a>
                                <div class="btn-group c_objetivo_fisico " style="width: 70%;">
                                    <button id="boton_serie_filtro_a" type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border:2px solid #d2d2d2; background-color: #fff;">
                                        <p class="titulo_multi ellipsis-text">
                                            <span id="texto_boton_filtro_serie_filtro_a">Seleccione una serie</span>
                                        </p> 
                                        <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span>
                                    </button>
                                        <ul id="filtro_serie_filtro_a" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                                </div>                    
                            </div>

                            <div style="box-sizing:border-box;border:0;width:100%;height:504px;/*background:#111;*/overflow:scroll;overflow-x:hidden;">

                        

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                            </div> 







                    
                        </div>























                        <div style="box-sizing:border-box;border:0;width:50%;height:100%;">

                            <!-- <div style="box-sizing:border-box;border:0;width:70%;height:45px;background-color:#404040;margin-left:auto;margin-right:auto;margin-top:20px;margin-bottom:15px;color:#fff;text-align: center;line-height: 45px;font-size: 1.5em;">
                                PERFIL FÍSICO - ANTROPOMÉTRICO
                            </div> -->
                            <!-- border-right:2px solid #a2a2a2; -->
                            <div style="box-sizing:border-box;border:0;width:100%;height:170px;border-bottom:2px solid #a2a2a2;">
                                <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;border-right:2px solid #a2a2a2;background-color:#5fbfe4;">

                                    <div style="box-sizing:border-box;border:0;width:48%;height:100%;float:left;padding-top: 10px;">

                                        <div style="box-sizing:border-box;border:0;width:90%;height:110px;background-color:#fff;border-radius: 80px;border:5px solid #df4f4f;margin-left: auto;margin-right: auto;overflow:hidden;">
                                            <img style="box-sizing:border-box;border:0;height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                        </div>
                                        <div style="box-sizing:border-box;border:0;width:100%;height:40px;color:#fff;text-align:center;line-height: 40px;font-weight: bold;">
                                            Moisés González V.
                                    
                                        </div>

                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:52%;height:100%;float:left;color:#fff;font-size: 10px;padding-top: 10px;">
                                        <div><span style="font-weight: bold;">Pos:</span> Volante Defensivo</div>
                                        <div><span style="font-weight: bold;">Año:</span> 2002</div>
                                        <div><span style="font-weight: bold;">Mes nac:</span> Enero</div>
                                        <div><span style="font-weight: bold;">Altura:</span> 181 cm</div>
                                        <div><span style="font-weight: bold;">Min jugados este año:</span> 303</div>
                                        <div><span style="font-weight: bold;">Peso:</span> 78 kg</div>
                                    </div>
                                    
                            
                            
                            
                                </div>
                                <div style="box-sizing:border-box;border:0;width:50%;height:100%;float:left;background-color:#555;">

                                    <div style="box-sizing:border-box;border:0;width:52%;height:100%;float:left;color:#fff;font-size: 10px;padding-top: 10px; padding-left:7px;">
                                        <div><span style="font-weight: bold;">Pos:</span> Volante Defensivo</div>
                                        <div><span style="font-weight: bold;">Año:</span> 2002</div>
                                        <div><span style="font-weight: bold;">Mes nac:</span> Enero</div>
                                        <div><span style="font-weight: bold;">Altura:</span> 181 cm</div>
                                        <div><span style="font-weight: bold;">Min jugados este año:</span> 303</div>
                                        <div><span style="font-weight: bold;">Peso:</span> 78 kg</div>
                                    </div>

                                    <div style="box-sizing:border-box;border:0;width:48%;height:100%;float:left;padding-top: 10px;">

                                        <div style="box-sizing:border-box;border:0;width:90%;height:110px;background-color:#fff;border-radius: 80px;margin-left: auto;margin-right: auto;overflow:hidden;">
                                            <img style="box-sizing:border-box;border:0;height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                        </div>
                                        <div style="box-sizing:border-box;border:0;width:100%;height:40px;color:#fff;text-align:center;line-height: 40px;font-weight: bold;">
                                            Matías H. Cahais

                                        </div>

                                    </div>

                                    

                                </div>





                            </div>
                            <div  style="box-sizing:border-box;border:0;width:100%;height:80px;display:inline-flex;flex-direction:row;flex-wrap:wrap;justify-content:center;align-items:center;">


                                <div style="box-sizing:border-box;border:0;width:40%;margin-right:30px;">
                                    <div style="color:#404040;font-weight: bold;font-size:10px;">Seleccione parámetros</div>
                                    <select style="box-sizing:border-box;border:0;width:100%;border: 2px solid #d2d2d2;margin-bottom:0;border-radius:2px;"></select>
                                </div>
                                <div style="box-sizing:border-box;border:0;width:40%;margin-right:10px;">
                                    <div style="color:#404040;font-weight: bold;font-size:10px;">Seleccione la serie del gold estandar</div>
                                    <select style="box-sizing:border-box;border:0;width:100%;border: 2px solid #d2d2d2;margin-bottom:0;border-radius:2px;"></select>
                                </div>
                                <figure class="highcharts-figure" style="box-sizing:border-box;border:0;width:100%;">
                                    <div id="container"></div>
                                    <p class="highcharts-description">
                                    
                                    </p>
                                </figure>
                        
                        
                        
                        
                            </div>







                    
                    
                        </div>





















                        <div style="box-sizing:border-box;border:0;width:25%;height:100%;/*background:lime;*/border-left:2px solid #a2a2a2;border-bottom:2px solid #a2a2a2;">
                            <div style="box-sizing:border-box;border:0;width:100%;height:130px;background:#404040;padding-top:10px;">

                                <img style="box-sizing:border-box;border:0;display:block;width:110px;height:110px;margin-left:auto;margin-right:auto;" src="../config/logo_equipo.png" alt="imagen_logo_equipo"/>

                            </div>

                            <div style="box-sizing:border-box;border:0;width:75%;margin-top:15px;margin-bottom:15px;margin-left:auto;margin-right:auto;display:flex;">
                                <a class="btn btn-md btn-primary green-a" style="width: 30%;height: 18.5px;background-color:#fff;"><div><p class="ellipsis-text" style="font-weight: bold;color:#555;">Serie</p></div></a>
                                <div class="btn-group c_objetivo_fisico " style="width: 70%;">
                                    <button id="boton_serie_filtro_b" type="button" class="btn dropdown-toggle" data-toggle="dropdown" href="#" style="width: 100%;height: 30px;border-radius: 0;border:2px solid #d2d2d2; background-color: #fff;">
                                        <p class="titulo_multi ellipsis-text">
                                            <span id="texto_boton_filtro_serie_filtro_b">Seleccione una serie</span>
                                        </p> 
                                        <span class="caret" style="position: absolute; right: 5px; top: 2px;"></span>
                                    </button>
                                        <ul id="filtro_serie_filtro_b" class="dropdown-menu" data-titulo="tipo_ayuda"></ul>
                                </div>                    
                            </div>

                            <div style="box-sizing:border-box;border:0;width:100%;height:504px;/*background:#111;*/overflow:scroll;overflow-x:hidden;">

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                <div class="contenedor_jugador">
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:50px;/*background-color:lime;*/border-radius:55px;border: 2px solid #8a8a8a;overflow:hidden;">
                                        
                                        <img style="height:100%;width:100%;" src="./foto_jugadores/jugador100.png" alt="imagen_jugador" />
                                    </div>
                                    <div style="box-sizing:border-box;border:0;float:left;height:50px;width:68%;/*background-color:grey*/;">
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;font-weight: bold;overflow:hidden;text-overflow:ellipsis;">Moisés González V.</div> 
                                        <div style="box-sizing:border-box;border:0;display:block;width:100%;height:25px;line-height:25px;padding-left:5px;">Volante Defensivo ( Sub 20)</div>
                                    </div>
                                </div>

                                
                                
                            </div> 

                            
                    

                    
                        </div>




                
                
                    </div>
                    <!-- TABLA -->
                    <table style="box-sizing:border-box;width:50%;margin-left:auto;margin-right:auto;color:#000;" border="2">
                        <thead >
                            <tr>
                                <th style="border:2px solid #000;">Parámetros</th>
                                <th style="border:2px solid #000;">Gold estandar</th>
                                <th style="border:2px solid #000;">Unidad</th>
                                <th style="border:2px solid #000;">Moisés González</th>
                                <th style="border:2px solid #000;">Matías Cahais</th>


                            </tr>
                        </thead>
                        <tbody style="text-align:center;">
                            <tr>
                                <td style="border:2px solid #000;">
                                Masa Muscular
                                </td>
                                <td style="border:2px solid #000;">
                                50
                                </td>
                                <td style="border:2px solid #000;">
                                %
                                </td>
                                <td style="border:2px solid #000;background-color:#ff97b4;">
                                47.3
                                </td>
                                <td style="border:2px solid #000;background-color:#c0efc1;">
                                51.2
                                </td>
                            </tr>
                            <tr>
                                <td style="border:2px solid #000;">
                                Masa Adiposa
                                </td>
                                <td style="border:2px solid #000;">
                                21.5
                                </td>
                                <td style="border:2px solid #000;">
                                %
                                </td>
                                <td style="border:2px solid #000;background-color:#c0efc1;">
                                21.1
                                </td>
                                <td style="border:2px solid #000;background-color:#ff97b4;">
                                23.1
                                </td>
                            </tr>
                            <tr>
                                <td style="border:2px solid #000;">
                                Velocidad 10m
                                </td>
                                <td style="border:2px solid #000;">
                                2.1
                                </td>
                                <td style="border:2px solid #000;">
                                seg
                                </td>
                                <td style="border:2px solid #000;background-color:#c0efc1;">
                                
                                </td>
                                <td style="border:2px solid #000;background-color:#ff97b4;">
                                
                                </td>
                            </tr>
                            <tr>
                                <td style="border:2px solid #000;">
                                Velocidad 30m
                                </td>
                                <td style="border:2px solid #000;">
                                4.4
                                </td>
                                <td style="border:2px solid #000;">
                                seg
                                </td>
                                <td style="border:2px solid #000;background-color:#c0efc1;">
                                
                                </td>
                                <td style="border:2px solid #000;background-color:#ff97b4;">
                                
                                </td>
                            </tr>
                            <tr>
                                <td style="border:2px solid #000;">
                                Fuerza Sup
                                </td>
                                <td style="border:2px solid #000;">
                                
                                </td>
                                <td style="border:2px solid #000;">
                                
                                </td>
                                <td style="border:2px solid #000;background-color:#c0efc1;">
                                
                                </td>
                                <td style="border:2px solid #000;background-color:#ff97b4;">
                                
                                </td>
                            </tr>
                            <tr>
                                <td style="border:2px solid #000;">
                                Fuerza Inf
                                </td>
                                <td style="border:2px solid #000;">
                                
                                </td>
                                <td style="border:2px solid #000;">
                                
                                </td>
                                <td style="border:2px solid #000;background-color:#c0efc1;">
                                
                                </td>
                                <td style="border:2px solid #000;background-color:#ff97b4;">
                                
                                </td>
                            </tr>
                        </tbody>


                    </table>

































































                    


















                    

            </div>
                    
                <?php } ?>
            </div>
        </div>
    </body>
</html>
<!-- variables globales -->
<script>

var jugadore_filtro_serie_resume=[]

var jugadores_historial_lesiones=[]

var id_ficha_jugador=""

var nombre_usuario_software='<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>'


// historial
var lista_jugadores_serie=[]
// jugador
var lista_jugadores_serie_seccion_jugador=[]
var informe_medicos_jugador=[]

var ano_actual_servidor=""

var lista_ano=[]



</script>
<script>


</script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script>
    mostrar_al_cargar_pagina()
    $(document).on('click', '.option', function(e) { //
        e.stopPropagation();
    });
    $('.c_objetivo_fisico li').click(function (e) { e.stopPropagation(); });


</script>
<script>
    Highcharts.chart('container', {

    chart: {
        polar: true,
        type: 'area',
        backgroundColor:null
        
    },

    credits:{
        enabled:false
    },


    title: {
        text: null,
        x: -80
    },

    pane: {
        size: '80%'
    },

    xAxis: {
        categories: ['M.Adiposa', 'M.Muscular', 'Vo2Max', 'Fuerza Tren Inf',
            'Fuerza Tren Sup', 'Velocidad 10m',],
        tickmarkPlacement: 'on',
        lineWidth: 0
    },

    yAxis: {
        gridLineInterpolation: 'polygon',
        lineWidth: 0,
        min: 0,
        max:100,
    },

    tooltip: {
        shared: true,
        pointFormat: '<span style="color:{series.color}">{series.name}: <b>{point.y:,.0f} % </b><br/>'
    },

    legend: {
        
    },

    series: [{
        name: 'Jugador',
        color:'#FE6A6A',
        data: [70, 56, 67,56,78,86],
    
        marker: {
                    symbol: 'circle',
                    fillColor: '#FFFFFF',
                lineWidth: 2,
                lineColor: '#464343'
                },
        pointPlacement: 'on',

    }, {
        name: 'Media posición',
        color:'#4591F7',
        visible:false,
        data: [84.1, 76.3, 56.2,66.3,78.9,96.3],
        marker: {
                    symbol: 'circle',
                    fillColor: '#FFFFFF',
                lineWidth: 2,
                lineColor: '#464343'
                },
        pointPlacement: 'on'
        
        }, {
        name: 'Comparativa',
        color:'#6E6E6E',
        visible:true,
        data: [84.1, 76.3, 56.2,66.3,78.9,96.3],
        marker: {
                    symbol: 'circle',
                    fillColor: '#FFFFFF',
                lineWidth: 2,
                lineColor: '#464343'
                },
        pointPlacement: 'on'
        
        }, {
        name: 'Media de la serie',
        color:'#F7AB45',
        visible:false,
        data: [84.1, 76.3, 56.2,66.3,78.9,96.3],
        marker: {
                    symbol: 'circle',
                    fillColor: '#FFFFFF',
                lineWidth: 2,
                lineColor: '#464343'
                },
        pointPlacement: 'on'
        
        
        }, {
        name: 'Media seleccion',
        color:'#3B31FF',
        visible:false,
        data: [84.1, 76.3, 56.2,66.3,78.9,96.3],
        marker: {
                    symbol: 'circle',
                    fillColor: '#FFFFFF',
                lineWidth: 2,
                lineColor: '#464343'
                },
        pointPlacement: 'on'
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    align: 'center',
                    verticalAlign: 'bottom',
                    layout: 'horizontal'
                },
                pane: {
                    size: '70%'
                }
            }
        }]
    }

    });
</script>

