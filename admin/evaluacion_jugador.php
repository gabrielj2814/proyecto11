<?PHP
include('../config/datos.php');
session_start();
if(!(isset($_SESSION["nombre_usuario_software"]))){
    session_destroy();
    header('Location: ../index.php?cerrar_sesion=1');
}
else{
    include("../bd/evaluacion_jugador_BD.php");
    $menu_actual="evaluacion";
    $submenu_actual="evaluacion_jugador";
    $seccion_comentarios = $comentarios['evaluacion_jugador'];//mis cuotas
    $demo_seccion = $demo['evaluacion_jugador'];
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
$series = [
    '8_1'  => 'SUB-8',
    '9_1'  => 'SUB-9',
    '10_1' => 'SUB-10',
    '11_1' => 'SUB-11',
    '12_1' => 'SUB-12',
    '13_1' => 'SUB-13',
    '14_1' => 'SUB-14',
    '15_1' => 'SUB-15',
    '16_1' => 'SUB-16',
    '17_1' => 'SUB-17',
    '20_1' => 'SUB-20',
    '99_1' => 'Primer Equipo',
    
    '15_2' => 'SUB-15',
    '17_2' => 'SUB-17',
    '99_2' => 'Primer Equipo'
];
function t_serie ($serie){
    $arreglo = explode('_', $serie);
    return $arreglo;
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

            .boton_evaluacion_jugador{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 3px solid #555; 
                color: #555;
                border-radius:5px;
            }
            .boton_evaluacion_jugador:hover{
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
        .boton_evaluacion_jugador{
                padding-left: 7px;
                padding-right: 7px;
                text-shadow: none; 
                background-color: transparent;
                border: 3px solid #555555; 
                color: #555555;
                border-radius:5px;
            }
            .boton_evaluacion_jugador:hover{
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
        .boton_evaluacion_jugador:disabled{
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
                        .fila_serie_jugador:hover{
                            background-color: #ffbb00;
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
    $("#content").css("min-height","800px")
    // min-height: 1700px
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
            <!-- 2100px -->
            <!-- 1800px -->
            <!-- 1527px -->
            <!-- min-height: 1800px -->
        <div id="content" >
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
            <!-- 696px -->
            <div  id="pagina" style="padding:0px;height: auto;">
                <?php if(($software_demo && $demo_seccion) || !$software_demo){?>
                    <!-- #303030 -->
                    <!-- #25282a -->
                    <!-- #39b682 -->
                    <!-- #ff5b4d -->
                    <!-- #404040 -->
                    <!-- #a2a2a2 -->
                    <!-- vista_series -->
                    <div id="vista_series">
                        <div style="box-sizing:border-box;border:0;width:30%;height:80px;margin-left:auto;margin-right:auto;margin-bottom:15px;">
                        
                            <div style="box-sizing:border-box;border:0;width:27%;height:80px;float:left;">

                                <img style="box-sizing:border-box;border:0;width:100%;height:100%;" src="../config/logo_equipo.png" alt="logo_equipo">
                            
                            </div>
                            <div style="box-sizing:border-box;border:0;width:73%;height:80px;float:left;text-align: center;line-height: 80px;font-size: 1.5em;font-weight: bold;color: #000;">

                                MÓDULO EVALUACIÓNES
                            
                            </div>
                        </div>

                        <div style="box-sizing:border-box;border:0;width:95%;height:15px;margin-left:auto;margin-right:auto;margin-bottom:50px;background-color:#249bf3;"></div>
                        <center>
                            <div style="margin:0px; height:20px;"><img src="img/cargando_buscar.gif" id="cargando_buscar" style=" display:none;">
                                <span style="color:#dc4e4e; display:none;" id="error_conexion"><b>Error:</b> conexión a internet deficiente.</span>
                                <span style="color:#28b779; display:none;" id="sin_resultados">Busqueda sin resultados.</span>
                            </div>
                        </center>
                        <div class="container-fluid" style="margin-top:0px;">    
                        <div class="row-fluid" style="margin-top: 10px;">     
                            <div class="span12 titulo_masculino" style="margin-top: 10px; margin-left: 0px; margin-bottom: 10px;">
                                <h4 style="text-align: center; color:black;">SERIES MASCULINAS</h4>
                            </div>
                       
                      <div class="span12">
                            <?php
                            $titulo_masculino=false;     
                            foreach ($series AS $indice => $valor) {
                                $arreglo_serie = t_serie($indice);
                                if ($arreglo_serie[1] == 1) { 
                                $titulo_masculino=true;     
                                ?>
                                    <div class="span3" style="text-align: center; margin: 0px; padding: 10px;">
                                        <div class="cuadro_serie"   onclick="consultarJugadorPorSerie('<?php print($arreglo_serie[0]."_".$arreglo_serie[1]);  ?>')">
                                            <div style="margin-bottom: 10px;"><img src="../config/logo_equipo.png" style="height: 120px"></div>
                                            <div class="nombre_seleccion"><b><?php echo $valor; ?></b></div>
                                            <?php $numero = 0;
                                            ?>
                                            <i class='icon-male'></i><b style="font-size:12px;">(<?php  print(cantidadDeValuacionesPorSerie($arreglo_serie[0],$arreglo_serie[1]))?>) Evaluaciones este mes</b>
                                        </div>
                                    </div>
                            <?php } ?>
                        <?php } ?>
                            </div>  
                       
         
                        <div class="row-fluid titulo_femenino" style="margin-top: 10px;">     
                            <div class="span12" style="margin-left: 0px; margin-bottom: 20px; <?php if($titulo_masculino==true){?> margin-top: 20px; border-top: 4px solid <?php echo $color_fondo; ?>;<?php }?>">
                                <h4 style="text-align: center; color:black;">SERIES FEMENINAS</h4>
                            </div>
                  <div class="span12">
                            
                            <?php
                            $titulo_femenino=false;     
                            foreach ($series AS $indice => $valor) {
                                $arreglo_serie = t_serie($indice);
                                if ($arreglo_serie[1] == 2 ) { 
                                $titulo_femenino=true;     
                                ?>
                                    <div class="span3" style="text-align: center; margin: 0px; padding: 10px;">
                                    <!-- aqui -->
                                        <div class="cuadro_serie"   onclick="consultarJugadorPorSerie('<?php print($arreglo_serie[0]."_".$arreglo_serie[1]);  ?>')">
                                            <div style="margin-bottom: 10px;"><img src="../config/logo_equipo.png" style="height: 120px"></div>
                                            <div class="nombre_seleccion"><b><?php echo $valor; ?></b></div>
                                            <?php $numero = 0;
                                            ?>
                                            <i class='icon-female'></i><b style="font-size:12px;" >(<?php  print(cantidadDeValuacionesPorSerie($arreglo_serie[0],$arreglo_serie[1]))?>) Evaluaciones este mes</b>
                                        </div>
                                    </div>
                            <?php } ?>
                        <?php } ?>
                            </div>  
                            
                          
                            <br><br><br><br>
                            
                        </div>
                        
         </div>        
                        
                
         
                <?php 
                  if($titulo_masculino==false){
                      echo "<script>$('.titulo_masculino').hide();</script>";
                  }  
                  if($titulo_femenino==false){
                      echo "<script>$('.titulo_femenino').hide();</script>";
                  }                                            
                                                               
                ?>                                             
    
 </div>



                        
                    </div>

                    <!-- vista_serie_jugadores -->
                    <div style="display:none;box-sizing:border-box;border:0;width:100%;" id="vista_serie_jugadores">
                            <!-- <h1>vista vista_serie_jugadores</h1> -->
                            <!-- botonVolverHaVistaSeries -->
                            <div style="box-sizing:border-box;border:0;width:100%;height:100px;margin-left:auto;margin-right:auto;margin-bottom:15px;">
                                <div  style="box-sizing:border-box;border:0;width:10%;height:100px;float:left;margin-right:310px;padding-top:45px;">
                                    <button class="boton_volver" onClick="botonVolverHaVistaSeries();" style="margin-left:10px;"><i class="icon-arrow-left"></i> volver</button>
                                </div>
                                <div style="box-sizing:border-box;border:0;width:10%;height:100px;float:left;">

                                    <img style="box-sizing:border-box;border:0;width:100%;height:100%;" src="../config/logo_equipo.png" alt="logo_equipo">
                                
                                </div>
                                <div style="box-sizing:border-box;border:0;width:10%;height:100px;float:left;">

                                    <!-- Sub-00 -->
                                    <div id="serie_seleccionada" style="box-sizing:border-box;border:0;width:100%;height:65px;text-align: center;line-height: 80px;font-size: 1.5em;font-weight: bold;color: #000;">
                                        Sub-00
                                    </div>
                                    <div  style="box-sizing:border-box;border:0;width:100%;height: 23px;text-align: center;line-height: 20px;font-size: 1em;font-weight: bold;color: #000;border-top: 2px solid #000;border-bottom: 2px solid #000;">
                                        Masculino
                                    </div>
                                
                                </div>
                            </div>
                            <hr/>
                            <div style="box-sizing:border-box;border:0;width:40%;height:40px;margin-left:auto;margin-right:auto;margin-bottom: 40px;">
                                <input style="box-sizing:border-box;border:0;width:100%;height:100%;border-radius:20px;border:5px solid #555;margin:0;" type="text" name="nombre_jugador_filtro" id="nombre_jugador_filtro" placeholder="Nombre Del Jugador o Vacio Para Ver Todos" onKeyup="traerJugadores()" />
                            </div>
                            <div id="tabla_html" style="box-sizing:border-box;border:0;width:90%;height:700px;margin-left:auto;margin-right:auto;">
                                <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;border-top-left-radius: 5px;border-top-right-radius: 5px;">
                                    <div style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;">#</div>
                                    <div style="box-sizing:border-box;border:0;width:13%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;">POSICION</div>
                                    <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;">SERIE</div>
                                    <div style="box-sizing:border-box;border:0;width:31%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;">NOMBRE</div>
                                    <div style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;">RUT</div>
                                    <div style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;">F.NACIMIENTO</div>
                                    <div style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;">EDAD</div>
                                    <div style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;">PIE HABIL</div>
                                    <div style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#fff;font-weight: bold;line-height: 30px;text-align:center;">NACIONALIDAD</div>
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
                                <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;border-bottom-left-radius: 5px;border-bottom-right-radius: 5px;"></div>
                                
                            
                            
                            </div>
                            




                    </div>

                    <!-- vista_evaluaciones_jugador -->
                    <div style="display:none;" id="vista_evaluaciones_jugador">
                        <!--    MODAL INICIO  -->
                        <div id="modalEvaluacionJugador_eliminar" class="modal hide" style="border-radius:10px;">
                                    <div class="modal-header" style="background-color: <?php echo $color_fondo; ?>; border-top-right-radius: 5px; border-top-left-radius: 5px;">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <center><h4 class="modal-title"><img src="img/logo3.png" style="height:30px; width:265px;"></h4></center>
                                    </div>
                                    <div class="modal-body" style="color:black; font-family:Arial, Helvetica, sans-serif;">
                                    <center>
                                            <br>
                                            <div id="mensaje_agregar_DescargarBoleta_eliminar">
                                            <h5><!--mensaje modal --></h5>
                                            </div>
                                            <br>
                                    </center>
                                    </div>
                                    <div class="modal-footer" style="background-color: <?php echo $color_fondo; ?>; border-bottom-left-radius:10px; border-bottom-right-radius:10px;">
                                        
                                        <center>
                                            <div id="contendor_botones_modal_eliminar">
                                                <button type="button" class="btn btn-default boton_modal" onClick="cerrarModalAtencionDiariaNuevo()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>
                                                <button type="button" id="guardar" class="btn btn-default boton_modal " onClick="agregarNuevoTratamiento()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button>
                                            </div>
                                        </center>
                                        
                                    </div>
                            </div>
                            <!--    MODAL FIN     -->
                        <div style="box-sizing:border-box;border:0;width:34%;height:80px;margin-left:auto;margin-right:auto;margin-bottom:15px;">
                            
                            <div style="box-sizing:border-box;border:0;width:25%;height:80px;float:left;">

                                <img style="box-sizing:border-box;border:0;width:100%;height:100%;" src="../config/logo_equipo.png" alt="logo_equipo">
                            
                            </div>
                            <div style="box-sizing:border-box;border:0;width:75%;height:80px;float:left;text-align: center;color: #000;padding-top: 10px;">
                                <div id="nombre_jugador_vista_evaluaciones_jugador" style="box-sizing:border-box;border:0;width:100%;font-weight: bold;font-size: 15px;margin-bottom: 5px;">
                                    Gabriel Jesus Valera Castillo
                                </div>
                                <div id="info_jugador_vista_evaluaciones_jugador" style="box-sizing:border-box;border:0;width:100%;font-weight: bold;font-size: 11px;">
                                    22 Años, posicion , Pie Derecho
                                </div>
                            
                            
                            </div>
                        </div>

                        <div style="box-sizing:border-box;border:0;width:95%;height:15px;margin-left:auto;margin-right:auto;margin-bottom:20px;background-color:#249bf3;"></div>
                        <div  style="box-sizing:border-box;border:0;width: 81px;height: 23px;margin-left:17px;margin-bottom:40px">
                            <button class="boton_volver" onClick="botonVolverHaVistaSerieJugadores();" style="margin-left:10px;"><i class="icon-arrow-left"></i> volver</button>
                        </div>

                        <button style="margin-bottom: 10px;margin-left: auto;margin-right: 25px;width: 146px;display: block;margin-bottom:10px" class="boton_evaluacion_jugador" id="boton_evaluacion_jugador" onClick="mostrarFormularioEvaluacionJugador()"><b style="font-size:13px;"><i class="icon-plus"></i> Agregar informe</b></button>
                        
                        <div id="contenedor_foto_jugador_1" style="box-sizing:border-box;border:0;width: 120px;height: 120px;background-color: #fff;position: absolute;top: 77px;right: 86px;border-radius: 61px;border: 5px solid #249bf3;overflow: hidden;">
                            
                        </div>
                        <table style="border: 0px solid #8f8f8f; width:95%;margin-left:auto;margin-right:auto;" id="tabla_ver_informes">
                            <thead>
                                <tr style="background-color:#555; color:white;">
                                    <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px;font-size: 10px;width: 20px;"><center>#</center></th>
                                    <th scope="col" style="cursor:pointer; padding:0px;width: 50px;">
                                    <div class="tip-top" data-original-title="" style="text-align: left;font-size: 10px;">INFORME</div>
                                    </th>
                                    <th scope="col" style="cursor:pointer; padding:0px;width: 53px;">
                                    <div class="tip-top" data-original-title="" style="text-align:left;font-size: 10px;">EVALUADO COMO</div>
                                    </th>
                                    <th scope="col" style="cursor:pointer; padding:0px;width: 36px;">
                                    <div class="tip-top" data-original-title="" style="text-align:left;font-size: 10px;    text-align: center;">TITULO</div>
                                    </th>
                                    <th scope="col" style="cursor:pointer; padding:0px;width: 34px;">
                                    <div class="tip-top" data-original-title="" style="text-align:left;font-size: 10px;text-align: center;">EV.TEC</div>
                                    </th>
                                    <th scope="col" style="cursor:pointer; padding:0px;width: 34px;">
                                    <div class="tip-top" data-original-title="" style="text-align:left;font-size: 10px;text-align: center;">EV.TAC</div>
                                    </th>
                                    <th scope="col" style="cursor:pointer; padding:0px;width: 28px;">
                                    <div class="tip-top" data-original-title="" style="text-align:left;font-size: 10px;text-align: center;">OTRO</div>
                                    </th>
                                    <th scope="col" style="cursor:pointer; padding:0px;width: 15px;">
                                    <div class="tip-top" data-original-title="" style="text-align:left;font-size: 10px;"></div>
                                    </th>
                                    <th scope="col" style="cursor:pointer; padding:0px;width: 54px;">
                                    <div class="tip-top" data-original-title="" style="text-align:left;font-size: 10px;text-align: center;">PROMEDIO</div>
                                    </th>
                                    <th scope="col" style="cursor:pointer; padding:0px;width: 54px;">
                                    <div class="tip-top" data-original-title="" style="text-align:left;font-size: 10px;">EVALUADO POR</div>
                                    </th>
                                    <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:0px; width:20px;"></th>
                                    <th scope="col" style="cursor:pointer; padding:0px;  border-top-right-radius:5px; width:20px;"></th>
                                </tr>
                            </thead>
                            <tbody id="contenido_tabla">

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

                    <!-- vista_evaluacion_jugador -->
                    <div style="display:none;" id="vista_evaluacion_jugador">
                        <!--    MODAL INICIO  -->
                        <div id="modalEvaluacionJugador" class="modal hide" style="border-radius:10px;">
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
                            <div  style="box-sizing:border-box;border:0;width: 81px;height: 23px;margin-left:17px;margin-bottom:40px">
                                <button class="boton_volver" onClick="botonVolverHaVistaEvaluacionesJugador();" style="margin-left:10px;"><i class="icon-arrow-left"></i> volver</button>
                            </div>
                            <!-- <center>
                            <h1>vista vista_evaluacion_jugador</h1>
                            </center> -->
                            <div  style="box-sizing:border-box;border:0;width: 90%;height: 170px;margin-left:auto;margin-right:auto;margin-bottom:40px">

                                <div id="foto_jugador_evaluacion" style="box-sizing:border-box;border:0;width: 19%;height: 170px;border-radius:30px;overflow:hidden;float:left;">
                                
                                </div>
                                <div style="box-sizing:border-box;border:0;width: 81%;height: 170px;float:left;">

                                    <div style="box-sizing:border-box;border:0;width: 43%;height: 70px;margin-left:110px;margin-right:auto;margin-bottom:25px;">

                                        <div style="box-sizing:border-box;border:0;width: 24.3%;height: 70px;float:left;">
                                            <img style="box-sizing:border-box;border:0;width:100%;height:100%;" src="../config/logo_equipo.png" alt="logo_equipo">
                                        </div>

                                        <div style="box-sizing:border-box;border:0;width: 75.7%;height: 70px;float:left;text-align:center;color: #000;padding-top: 10px">
                                                
                                            <div style="box-sizing:border-box;border:0;width:100%;font-weight: bold;font-size: 15px;margin-bottom: 5px;">
                                                EVALUACIÓN DE JUGADOR
                                            </div>

                                            <div id="nombre_jugador_evaluacion" style="box-sizing:border-box;border:0;width:100%;font-size: 13px;">
                                                nombre jugador
                                            </div>

                                        </div>

                                    </div>


                                    <div style="box-sizing:border-box;border:0;width: 100%;display:inline-flex;flex-direction:row;flex-wrap:wrap;">

                                        <div style="margin-right:3.5%;width:30%;display:flex;margin-bottom:10px;margin-left: 73px;">
                                            <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#404040;height: 25px;">
                                                <div>
                                                    <p class="ellipsis-text" style="font-weight: normal;">Fecha evaluación</p>
                                                </div>
                                            </a>
                                            <input type="text" readonly  style="width:50%;background:#fff;margin:0;height: 23px;" class="grey-input date_fechaNacimiento " id="fecha_evaluacion" name="fecha_evaluacion" />
                                        </div> 
                                        <div style="width:41%;display:flex;margin-bottom:10px" id="posicion_evaluacion">
                                            <a class="btn btn-md btn-primary green-a" style="width: 50%;background:#404040;height: 25px;">
                                                <div>
                                                    <p class="ellipsis-text" style="font-weight: normal;height: 35px;">Posición a evaluar</p>
                                                </div>
                                            </a>
                                            <select name="posicion_evaluar" id="posicion_evaluar" style="width:50%;background:#fff;text-align:left;margin:0;height: 35px;padding-top: 0px;" class="grey-input " onChange="cambiarConceptosEvaluacion(this.value)"></select>
                                            <!-- <input type="text" style="width:50%;background:#fff;text-align:left;margin:0" class="grey-input " id="posicion_evaluar" name="posicion_evaluar" /> -->
                                        </div>              

                                    </div>






                            
                                </div>
                            
                            </div>
                            <form id="formulario_evaluacion_jugador">
                                    
                                <div id="apartado_evaluacion_tecnica" style="background-color: #fff;box-sizing:border-box;border:0;width: 90%;margin-left:auto;margin-right:auto;border:2px solid #bebebe;">
                                    
                                    <div style="box-sizing:border-box;border:0;width: 100%;height:40px;border-bottom:2px solid #bebebe;">
                                        <div style="box-sizing:border-box;border:0;width: 40px;height:40px;padding-left:10px;padding-top:7px;float:left;">
                                            <input type="checkbox" id="checkbox_apartado_evaluacion_tecnica" onClick="abrirTablaTecnica()">
                                        </div>
                                        <div style="box-sizing:border-box;border:0;width: 177px;height:40px;float:left;font-weight: bold;line-height: 40px;padding-left:5px;border-left:1px solid #bebebe;">
                                            Evaluación Técnica
                                        </div>
                                        <div id="total_evaluacion_2_tecnica" style="box-sizing:border-box;border:0;width: 40px;height:40px;float:right;text-align: center;font-weight: bold;line-height: 40px;">
                                            0 %
                                        </div>
                                    </div>

                                    <div id="contendor_tabla_evaluacion_tecnica" style="display:none;box-sizing:border-box;border:0;width: 100%;padding-top:15px;">

                                        <img style="box-sizing:border-box;border:0;width:100px;height:100px;display:block;margin-left:auto;margin-right:auto;margin-bottom: 15px;" src="../config/logo_equipo.png" alt="logo_equipo">
                                        <div style="box-sizing:border-box;border:0;width: 100%;height: 25px;margin-bottom: 20px;">
                                            <div id="total_porcentaje_apartado_evaluacion_tecnica" style="box-sizing:border-box;border:0;width: 10%;height:25px;background-color: #dc4e4e;float: right;color: #fff;line-height: 25px;text-align: center;font-weight: bold;border-radius: 5px;margin-right: 25px;">
                                                0 %
                                            </div>
                                            <div style="box-sizing:border-box;border:0;width: 51%;height: 25px;float: right;color: #000;line-height: 25px;font-weight: bold;font-size: 14px;">
                                                Evaluación técnica como <span id="pocicon_seccion_tecnica"></span>
                                            </div>
                                        </div>

                                        <table style="box-sizing:border-box;border:0;width: 90%;margin-left:auto;margin-right:auto;margin-bottom: 35px;">
                                            <thead >
                                                <tr style="background-color:#404040;color:#fff;">
                                                    <th>
                                                        CONCEPTO
                                                    </th>
                                                    <th>
                                                        <div class="tip-top" data-original-title="Muy Bueno, es una de sus principales fortalezas como jugador">Muy bueno</div>
                                                        
                                                    </th>
                                                    <th >
                                                        <div class="tip-top" data-original-title="Bueno, tiene un adecuado dominio del contenido">Bueno</div>
                                                      
                                                    </th>
                                                    <th>
                                                        <div class="tip-top" data-original-title="Medio, en buena progresión pero necesita mejorar"> Medio</div>
                                                       
                                                    </th>
                                                    <th >
                                                        <div class="tip-top" data-original-title="Bajo, falta por desarrollar y trabajar el contenido">  Bajo</div>
                                                      
                                                    </th>
                                                    <th >
                                                        <div class="tip-top" data-original-title="Muy Bajo, no domina el contenido"> Muy bajo</div>
                                                       
                                                    </th>
                                                    <th>
                                                        Tot
                                                    </th>
                                                    <th style="width: 165px;">
                                                        Comentario
                                                    </th>
                                                </tr>
                                                <tr style="background-color:#7d7d7d;color:#fff;">
                                                    <th colspan="1"></th>
                                                    <th>
                                                        100 %
                                                    </th>
                                                    <th>
                                                        80 %
                                                    </th>
                                                    <th>
                                                        60 %
                                                    </th>
                                                    <th>
                                                        40 %
                                                    </th>
                                                    <th>
                                                        20 %
                                                    </th>
                                                    <th colspan="1"></th>
                                                    <th colspan="1"></th>
                                                    
                                                </tr>

                                            </thead>
                                            <tbody id="tabla_body_seccion_tecnica">
                                                
                                            </tbody>


                                        </table>






                                    </div>
                                    


                                </div>


                                

                                <div id="apartado_evaluacion_tactica" style="background-color: #fff;box-sizing:border-box;border:0;width: 90%;margin-left:auto;margin-right:auto;border:2px solid #bebebe;">
                                    
                                    <div style="box-sizing:border-box;border:0;width: 100%;height:40px;border-bottom:2px solid #bebebe;">
                                            <div style="box-sizing:border-box;border:0;width: 40px;height:40px;padding-left:10px;padding-top:7px;float:left">
                                                <input type="checkbox" id="checkbox_apartado_evaluacion_tactica" onClick="abrirTablaTactica()">
                                            </div>
                                            <div style="box-sizing:border-box;border:0;width: 177px;height:40px;float:left;font-weight: bold;line-height: 40px;padding-left:5px;border-left:1px solid #bebebe;">
                                                Evaluación Táctica
                                            </div>
                                            <div id="total_evaluacion_2_tactica" style="box-sizing:border-box;border:0;width: 40px;height:40px;float:right;text-align: center;font-weight: bold;line-height: 40px;">
                                                0 %
                                            </div>
                                    </div>

                                    <div id="contendor_tabla_evaluacion_tactica" style="display:none;box-sizing:border-box;border:0;width: 100%;padding-top:15px;">

                                        <img style="box-sizing:border-box;border:0;width:100px;height:100px;display:block;margin-left:auto;margin-right:auto;margin-bottom: 15px;" src="../config/logo_equipo.png" alt="logo_equipo">
                                        <div style="box-sizing:border-box;border:0;width: 100%;height: 25px;margin-bottom: 20px;">
                                            <div id="total_porcentaje_apartado_evaluacion_tactica" style="box-sizing:border-box;border:0;width: 10%;height:25px;background-color: #dc4e4e;float: right;color: #fff;line-height: 25px;text-align: center;font-weight: bold;border-radius: 5px;margin-right: 25px;">
                                                0 %
                                            </div>
                                            <div style="box-sizing:border-box;border:0;width: 51%;height: 25px;float: right;color: #000;line-height: 25px;font-weight: bold;font-size: 14px;">
                                                Evaluación táctica como <span id="pocicon_seccion_tactica"></span>
                                            </div>
                                        </div>

                                        <table style="box-sizing:border-box;border:0;width: 90%;margin-left:auto;margin-right:auto;margin-bottom: 35px;">
                                            <thead >
                                                <tr style="background-color:#404040;color:#fff;">
                                                    <th>
                                                        CONCEPTO
                                                    </th>
                                                    <th>
                                                        <div class="tip-top" data-original-title="Muy Bueno, es una de sus principales fortalezas como jugador">Muy bueno</div>
                                                        
                                                    </th>
                                                    <th >
                                                        <div class="tip-top" data-original-title="Bueno, tiene un adecuado dominio del contenido">Bueno</div>
                                                      
                                                    </th>
                                                    <th>
                                                        <div class="tip-top" data-original-title="Medio, en buena progresión pero necesita mejorar"> Medio</div>
                                                       
                                                    </th>
                                                    <th >
                                                        <div class="tip-top" data-original-title="Bajo, falta por desarrollar y trabajar el contenido">  Bajo</div>
                                                      
                                                    </th>
                                                    <th >
                                                        <div class="tip-top" data-original-title="Muy Bajo, no domina el contenido"> Muy bajo</div>
                                                       
                                                    </th>
                                                    <th>
                                                        Tot
                                                    </th>
                                                    <th style="width: 165px;">
                                                        Comentario
                                                    </th>
                                                </tr>
                                                <tr style="background-color:#7d7d7d;color:#fff;">
                                                    <th colspan="1"></th>
                                                    <th>
                                                        100 %
                                                    </th>
                                                    <th>
                                                        80 %
                                                    </th>
                                                    <th>
                                                        60 %
                                                    </th>
                                                    <th>
                                                        40 %
                                                    </th>
                                                    <th>
                                                        20 %
                                                    </th>
                                                    <th colspan="1"></th>
                                                    <th colspan="1"></th>
                                                    
                                                </tr>

                                            </thead>
                                            <tbody id="tabla_body_seccion_tactica">
                                               
                                            </tbody>


                                        </table>






                                    </div>
                                    


                                </div>





                                <div id="apartado_evaluacion_otro_concepto" style="background-color: #fff;box-sizing:border-box;border:0;width: 90%;margin-left:auto;margin-right:auto;border:2px solid #bebebe;margin-bottom: 50px;">
                                    
                                    
                                    <div style="box-sizing:border-box;border:0;width: 100%;height:40px;border-bottom:2px solid #bebebe;">
                                        <div style="box-sizing:border-box;border:0;width: 40px;height:40px;padding-left:10px;padding-top:7px;float:left">
                                        <input type="checkbox" id="checkbox_apartado_evaluacion_otro" onClick="abrirTablaOtro()">
                                        </div>
                                        <div style="box-sizing:border-box;border:0;width: 177px;height:40px;float:left;font-weight: bold;line-height: 40px;padding-left:5px;border-left:1px solid #bebebe;">
                                            Otros aspectos
                                        </div>
                                        <div id="total_evaluacion_2_otro" style="box-sizing:border-box;border:0;width: 40px;height:40px;float:right;text-align: center;font-weight: bold;line-height: 40px;">
                                            0 %
                                        </div>
                                    </div>
                                        

                                    <div id="contendor_tabla_evaluacion_otro" style="display:none;box-sizing:border-box;border:0;width: 100%;padding-top:15px;">

                                        <img style="box-sizing:border-box;border:0;width:100px;height:100px;display:block;margin-left:auto;margin-right:auto;margin-bottom: 15px;" src="../config/logo_equipo.png" alt="logo_equipo">
                                        <div style="box-sizing:border-box;border:0;width: 100%;height: 25px;margin-bottom: 20px;">
                                            <div id="total_porcentaje_apartado_evaluacion_otro_concepto" style="box-sizing:border-box;border:0;width: 10%;height:25px;background-color: #dc4e4e;float: right;color: #fff;line-height: 25px;text-align: center;font-weight: bold;border-radius: 5px;margin-right: 25px;">
                                                0 %
                                            </div>
                                            <div style="box-sizing:border-box;border:0;width: 53%;height: 25px;float: right;color: #000;line-height: 25px;font-weight: bold;font-size: 14px;">
                                                Evaluación otros aspectos como <span id="pocicon_seccion_otro"></span>
                                            </div>
                                        </div>

                                        <table style="box-sizing:border-box;border:0;width: 90%;margin-left:auto;margin-right:auto;margin-bottom: 35px;">
                                            <thead >
                                                <tr style="background-color:#404040;color:#fff;">
                                                    <th>
                                                        CONCEPTO
                                                    </th>
                                                    <th>
                                                        <div class="tip-top" data-original-title="Muy Bueno, es una de sus principales fortalezas como jugador">Muy bueno</div>
                                                        
                                                    </th>
                                                    <th >
                                                        <div class="tip-top" data-original-title="Bueno, tiene un adecuado dominio del contenido">Bueno</div>
                                                    </th>
                                                    <th>
                                                        <div class="tip-top" data-original-title="Medio, en buena progresión pero necesita mejorar"> Medio</div>
                                                    </th>
                                                    <th >
                                                        <div class="tip-top" data-original-title="Bajo, falta por desarrollar y trabajar el contenido">  Bajo</div>
                                                    </th>
                                                    <th >
                                                        <div class="tip-top" data-original-title="Muy Bajo, no domina el contenido"> Muy bajo</div>
                                                    </th>
                                                    <th>
                                                        Tot
                                                    </th>
                                                    <th style="width: 165px;">
                                                        Comentario
                                                    </th>
                                                </tr>
                                                <tr style="background-color:#7d7d7d;color:#fff;">
                                                    <th colspan="1"></th>
                                                    <th>
                                                        100 %
                                                    </th>
                                                    <th>
                                                        80 %
                                                    </th>
                                                    <th>
                                                        60 %
                                                    </th>
                                                    <th>
                                                        40 %
                                                    </th>
                                                    <th>
                                                        20 %
                                                    </th>
                                                    <th colspan="1"></th>
                                                    <th colspan="1"></th>
                                                    
                                                </tr>

                                            </thead>
                                            <tbody id="tabla_body_seccion_otro_concepto">

                                            </tbody>


                                        </table>






                                    </div>
                                    


                                </div>
                                <div style="box-sizing:border-box;border:0;width: 100%;color: #000;text-align: center;font-weight: bold;font-size: 18px;margin-bottom: 50px;">
                                    RESULTADO EVALUACIÓN
                                </div>
                                <div style="box-sizing:border-box;border:0;width: 100%;display:inline-flex;flex-direction:row;flex-wrap:wrap;justify-content:center;">

                                    <div style="box-sizing:border-box;border:0;width: 30%;height:30px;background-color:#47c18e;border-right: 1px solid #fff;    color: #fff;text-align: center;line-height: 30px;font-weight: bold;font-size: 13px;">Técnica</div>
                                    <div style="box-sizing:border-box;border:0;width: 30%;height:30px;background-color:#47c18e;border-right: 1px solid #fff;    color: #fff;text-align: center;line-height: 30px;font-weight: bold;font-size: 13px;">Táctica</div>
                                    <div style="box-sizing:border-box;border:0;width: 30%;height:30px;background-color:#47c18e;    color: #fff;text-align: center;line-height: 30px;font-weight: bold;font-size: 13px;">Otros aspecto</div>
                                    
                                </div>
                                <div style="box-sizing:border-box;border:0;width: 100%;display:inline-flex;flex-direction:row;flex-wrap:wrap;justify-content:center;margin-top: -5px;margin-bottom: 90px;">

                                    <div id="total_evaluacion_3_tecnica" style="box-sizing:border-box;border:0;width: 30%;height:30px;border-right: 1px solid #47c18e;border-bottom: 1px solid #47c18e;border-left: 1px solid #47c18e;color: #555;text-align: center;line-height: 33px;font-weight: bold;font-size: 13px;">0 %</div>
                                    <div id="total_evaluacion_3_tactica" style="box-sizing:border-box;border:0;width: 30%;height:30px;border-right: 1px solid #47c18e;border-bottom: 1px solid #47c18e;color: #555;text-align: center;line-height: 33px;font-weight: bold;font-size: 13px;">0 %</div>
                                    <div id="total_evaluacion_3_otro" style="box-sizing:border-box;border:0;width: 30%;height:30px;border-right: 1px solid #47c18e;border-bottom: 1px solid #47c18e;color: #555;text-align: center;line-height: 33px;font-weight: bold;font-size: 13px;">0 %</div>
                                    
                                </div>

                                <div style="box-sizing:border-box;border:0;width: 90%;height:200px;margin-left:auto;margin-right:auto;margin-bottom: 40px;">
                                    <div style="box-sizing:border-box;border:0;width: 100%;color:#000;height: 25px;line-height: 25px;font-weight: bold;padding-left: 10px;">Fortalezas / Puntos fuertes</div>
                                    <textarea style="box-sizing:border-box;border:0;width: 100%;height:175px;border:2px solid #acacac;resize: none;margin:0;" name="comentario_fortaleza" id="comentario_fortaleza"></textarea>
                                </div>

                                <div style="box-sizing:border-box;border:0;width: 90%;height:200px;margin-left:auto;margin-right:auto;margin-bottom: 40px;">
                                    <div style="box-sizing:border-box;border:0;width: 100%;color:#000;height: 25px;line-height: 25px;font-weight: bold;padding-left: 10px;">Debilidades / Aspectos que debe mejorar</div>
                                    <textarea style="box-sizing:border-box;border:0;width: 100%;height:175px;border:2px solid #acacac;resize: none;margin:0;" name="comentario_devilidad" id="comentario_devilidad"></textarea>
                                </div>

                                <div style="box-sizing:border-box;border:0;width: 90%;height:200px;margin-left:auto;margin-right:auto;margin-bottom: 40px;">
                                    <div style="box-sizing:border-box;border:0;width: 100%;color:#000;height: 25px;line-height: 25px;font-weight: bold;padding-left: 10px;">Recomendaciones / Observaciones</div>
                                    <textarea style="box-sizing:border-box;border:0;width: 100%;height:175px;border:2px solid #acacac;resize: none;margin:0;" name="comentario_recomendacion" id="comentario_recomendacion"></textarea>
                                </div>

                                <div style="box-sizing:border-box;border:0;width: 140px;margin-left: auto;margin-right:auto;">
                                    <button type="button" ng-disabled="" class="boton_guardar_informe" onClick="mostrarModalEnviarDatos();" id="boton_agregar_infrome"><i class="icon-save"></i> GUARDAR INFORME</button>
                                </div>



                                <!-- <input type="button" value="enviar" onclick="enviarDatos()"> -->
















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

var tipo_formulario=false;

var nombre_usuario_software='<?php echo utf8_encode($_SESSION["nombre_usuario_software"]);?>';

var serie="";

var sexo="";

var jugadores_serie=[];

var jugador_selecionado={};

var concetos_evaluar_jugador=[];

var evaluaciones_jugador=[];

var id_evaluacion="";

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

var lista_id_concepto_tipo_evaluacion=[];





</script>
<script>

function abrirTablaTecnica(){
    if($("#checkbox_apartado_evaluacion_tecnica").prop("checked")){
        
        $("#contendor_tabla_evaluacion_tecnica").slideDown();
    }
    else{
        $("#contendor_tabla_evaluacion_tecnica").slideUp();
    }
}

function abrirTablaTactica(){
    if($("#checkbox_apartado_evaluacion_tactica").prop("checked")){
        
        $("#contendor_tabla_evaluacion_tactica").slideDown();
    }
    else{
        $("#contendor_tabla_evaluacion_tactica").slideUp();
    }
}

function abrirTablaOtro(){
    if($("#checkbox_apartado_evaluacion_otro").prop("checked")){
        $("#contendor_tabla_evaluacion_otro").slideDown();
    }
    else{
        $("#contendor_tabla_evaluacion_otro").slideUp();
    }
}

function botonVolverHaVistaSeries(){
    $("#vista_serie_jugadores").css("display","none");
    $("#vista_series").css("display","block");
    $("#content").css("min-height","800px");
    $("#nombre_jugador_filtro").val("");
}

function botonVolverHaVistaSerieJugadores(){
    $("#vista_evaluaciones_jugador").css("display","none");
    $("#vista_serie_jugadores").css("display","block");
    $("#content").css("min-height","1700px");
    
}

function botonVolverHaVistaEvaluacionesJugador(){
    $("#vista_evaluacion_jugador").css("display","none");
    $("#vista_evaluaciones_jugador").css("display","block");
    $("#content").css("min-height","800px");
    
}

function mostrarFormularioEvaluacionJugador(){
    $("html, body").animate({ scrollTop: 0 }, 600);
    window.id_evaluacion="";
    window.tipo_formulario=false;
    fechaEvaluacion();
    $("#vista_evaluaciones_jugador").css("display","none");
    $("#vista_evaluacion_jugador").css("display","block");
    $("#foto_jugador_evaluacion").html(' <img style="box-sizing: border-box;border: 0;width:100%;height:100%" src="./foto_jugadores/'+window.jugador_selecionado.idfichaJugador+'.jpeg" alt="foto_jugador_1"/>');
    let nombrer_jugador=jugador_selecionado.nombre+' '+ jugador_selecionado.apellido1+' '+jugador_selecionado.apellido2;
    $("#nombre_jugador_evaluacion").text(nombrer_jugador);
    // $("#posicion_evaluar").val(jugador_selecionado.posicion_texto)
    $("#pocicon_seccion_tecnica").text(jugador_selecionado.posicion_texto);
    $("#pocicon_seccion_tactica").text(jugador_selecionado.posicion_texto);
    $("#pocicon_seccion_otro").text(jugador_selecionado.posicion_texto);
    limpiarFormulario();
    $("#checkbox_apartado_evaluacion_tecnica").prop("checked",false);
    $("#checkbox_apartado_evaluacion_tactica").prop("checked",false);
    $("#checkbox_apartado_evaluacion_otro").prop("checked",false);
    abrirTablaTecnica();
    abrirTablaTactica();
    abrirTablaOtro();
    $("#content").css("min-height","1800px");



    insetarPosiciones(window.jugador_selecionado.posiciones_jugador);
    // insertarFilasConceptos(window.jugador_selecionado.listas_concepto_jugador[$("#posicion_evaluar").val()])
    $("#posicion_evaluar").val(window.jugador_selecionado.posicion);
    cambiarConceptosEvaluacion($("#posicion_evaluar").val());

    $("#posicion_evaluar").prop("disabled",false);
}

function cambiarConceptosEvaluacion(valor){
    window.lista_id_concepto_tipo_evaluacion=[];
    insertarFilasConceptos(window.jugador_selecionado.listas_concepto_jugador[valor]);
    for( let concepto of window.jugador_selecionado.listas_concepto_jugador[valor]){
        window.lista_id_concepto_tipo_evaluacion.push(concepto.idevaluacion_concepto+'_'+concepto.evaluacion);
    };
    limpiarFormulario();
}

function insetarPosiciones(posiciones){
    $("#posicion_evaluar").empty();
    posiciones=ordenarPosiciones(posiciones);
    console.log(posiciones);
    for(let posicion of posiciones){
        $("#posicion_evaluar").append("<option value='"+posicion.codigo_posicion+"'>"+posicion.texto_posicion+"</option>");
    }
}
function ordenarPosiciones(posiciones){

    for(let contador=1;contador<posiciones.length;contador++){
        for(let contador2=0;contador2<(posiciones.length-contador);contador2++){
            console.log(posiciones[contador2]);
            let numero_1=parseInt(posiciones[contador2].codigo_posicion),
            numero_2=parseInt(posiciones[contador2+1].codigo_posicion);
            if(numero_1>numero_2){
                let temporal=posiciones[contador2];
                posiciones[contador2]=posiciones[contador2+1];
                posiciones[contador2+1]=temporal;
            }
        }
    }
    return posiciones;
    
}



function abrirModaleliminarEvaluacion(index){
    $("#mensaje_agregar_DescargarBoleta_eliminar").html('<h5>¿Estás seguro que quieres eliminar esta evaluación?</h5>*Al borrarlo se perderán todos los datos asociados!<br><img src="../config/remover_archivo.png">');
    const html_botones="<button type='button' class='btn btn-default boton_modal' data-dismiss='modal' onClick='cerrarModalEliminarEvaluacion()' id='boton_cerrar_alerta' style='margin-right:20px; border-radius:5px;'><span class='icon'><i class='icon-remove'></i></span> No</button>"+"<button type='button' id='eliminar_modal' class='btn btn-default boton_modal ' onClick='eliminarEvaluacion("+index+");' ng-click='desactivarBotonAgregarBoleta()' style='border-radius:5px;'><span class='icon'><i class='icon-ok'></i></span> Si</button> ";
    $("#contendor_botones_modal_eliminar").html(html_botones);
    $("#modalEvaluacionJugador_eliminar").modal("show");
}


function cerrarModalEliminarEvaluacion(){
    $("#modalEvaluacionJugador_eliminar").modal("hide");
}

function eliminarEvaluacion(index){
    let evaluacion=window.evaluaciones_jugador[index];
    // console.log(evaluacion)
    $.ajax({
        url: 'post/evaluacion_jugador_eliminar.php',
        type: "post",
        data:[{name:"id",value:evaluacion.idevaluacion_jugador}],
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            console.log(json);
            cerrarModalEliminarEvaluacion();
            // consultarEvaluacionesJugador(evaluacion.idfichaJugador)
            consultarEvaluacionesJugador(window.jugador_selecionado.idfichaJugador,window.jugador_selecionado.posicion);
        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
        }, timeout: 10000 // sets timeout to 3 seconds
    });

}




// function consultarCantidadDeJugadoresPorSerie(){
//     $.ajax({
//         url: "post/evaluacion_jugador_consultar_cantidad_serie.php",
//         type: "post",
//         success: function(respuesta) {
//             var json=JSON.parse(respuesta);
//             // console.log(json)
//             // cantidad_serie_99 (00) Jugadores
//             $("#cantidad_serie_8").text('('+json.serie_8+') Evaluaciones este mes');
//             $("#cantidad_serie_9").text('('+json.serie_9+') Evaluaciones este mes');
//             $("#cantidad_serie_10").text('('+json.serie_10+') Evaluaciones este mes');
//             $("#cantidad_serie_11").text('('+json.serie_11+') Evaluaciones este mes');
//             $("#cantidad_serie_12").text('('+json.serie_12+') Evaluaciones este mes');
//             $("#cantidad_serie_13").text('('+json.serie_13+') Evaluaciones este mes');
//             $("#cantidad_serie_14").text('('+json.serie_14+') Evaluaciones este mes');
//             $("#cantidad_serie_15").text('('+json.serie_15+') Evaluaciones este mes');
//             $("#cantidad_serie_16").text('('+json.serie_16+') Evaluaciones este mes');
//             $("#cantidad_serie_17").text('('+json.serie_17+') Evaluaciones este mes');
//             $("#cantidad_serie_20").text('('+json.serie_20+') Evaluaciones este mes');
//             $("#cantidad_serie_99").text('('+json.serie_99+') Evaluaciones este mes');
//             $("#cantidad_serie_15_2").text('('+json.serie_15_2+') Evaluaciones este mes');
//             $("#cantidad_serie_17_2").text('('+json.serie_17_2+') Evaluaciones este mes');
//             $("#cantidad_serie_99_2").text('('+json.serie_99_2+') Evaluaciones este mes');


//         },error: function(){// will fire when timeout is reached
//             // alert("errorXXXXX");
//             $('#error_conexion').show();
            
//         }, timeout: 10000 // sets timeout to 3 seconds
//     });
// }

// evaluacion_jugador_consultar_jugadores_por_serie



function consultarJugadorPorSerie(serie_sexo){
    let serie=serie_sexo.split("_")[0],
    sexo=serie_sexo.split("_")[1];
    let datos=[
        {name:"serie",value:serie},
        {name:"sexo",value:sexo}
    ];
    console.log(datos);

    $.ajax({
        url: 'post/evaluacion_jugador_consultar_jugadores_por_serie.php',
        type: "post",
        data:datos,
        success: function(respuesta) {
            $("#content").css("min-height","1700px");
            var json=JSON.parse(respuesta);
            // console.log(json)
            let texto_serie="";
            if(serie==="99"){
                $("#serie_seleccionada").css("font-size","1.2em");
                texto_serie="Primer Equipo";
            }
            else{
                $("#serie_seleccionada").css("font-size","1.5em");
                texto_serie="Sub"+serie;
            }
            window.sexo=sexo;
            window.serie=serie;
            $("#serie_seleccionada").text(texto_serie);
            $("#vista_series").css("display","none");
            $("#vista_serie_jugadores").css("display","block");
            traerJugadores();

        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
            $('#error_conexion').show();
            
        }, timeout: 10000 // sets timeout to 3 seconds
    });
}



function traerJugadores () {
        // $('.boton_refresh').hide();

        // scrollTop()
        $("html, body").animate({ scrollTop: 0 }, 600);


        window.jugadores_serie=[];
        $("#seccion_arquero").empty();
        $("#seccion_defensa").empty();
        $("#seccion_medio_campista").empty();
        $("#seccion_delantero").empty();
        let lista_arqueros=[],
        lista_defensas=[],
        lista_campistas=[],
        lista_delantero=[];
        
        let datos=[
            // {name:"campo_busqueda",value:"Sa"},
            {name:"campo_busqueda",value:$('#nombre_jugador_filtro').val()},
            {name:"sexo",value:window.sexo},
            {name:"serieActual",value:window.serie},
        ];

        // console.log(datos)

        $.ajax({
            url: "post/evaluacion_jugador_jugadores_serie.php",
            type: "post",
            data: datos,
            success: function (respuesta) {
                window.jugadores_scouting = JSON.parse(respuesta);
                console.log(window.jugadores_scouting);
                let contador=0;
                // jugadores_serie
                for(let jugador_x of window.jugadores_scouting){
                    window.jugadores_serie.push(jugador_x);
                }

                for(let jugador of window.jugadores_scouting){
                    let fila="";
                    if(jugador.posicionA===1 && jugador.numero_posicion==="0"){
                        contador++;
                        let pie=(jugador.pieHabil==="1")?"Derecho":"izquierdo",
                        serie=(jugador.serieActual==="99")?"Prime":"Sub-"+jugador.serieActual,
                        datos_funcion="'"+jugador.idfichaJugador+"','"+jugador.posicion+"'";
                        fila='\
                        <div class="fila_serie_jugador" onClick="consultarEvaluacionesJugador('+datos_funcion+')" style="box-sizing:border-box;border:0;width:100%;height:40px;cursor:pointer;padding-top: 5px;padding-bottom: 5px;">\
                            <div style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+contador+'</div>\
                            <div style="box-sizing:border-box;border:0;width:13%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+jugador.posicion_texto+'</div>\
                            <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+serie+'</div>\
                            <div style="box-sizing:border-box;border:0;width:31%;height:30px;float:left;">\
                                <div style="box-sizing:border-box;border:0;float:left;width:11%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;">\
                                    <img style="width:100%;height:100%" src="./foto_jugadores/'+jugador.idfichaJugador+'.jpeg"/>\
                                </div>\
                                <div style="box-sizing:border-box;border:0;float:left;width:89%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;overflow:hidden;">'+jugador.nombre+' '+jugador.apellido1+' '+jugador.apellido2+'</div>\
                            </div>\
                            <div style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+formatoRut(jugador.rut)+'</div>\
                            <div style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+jugador.fechaNacimiento+'</div>\
                            <div style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+calcularEdad(jugador.fechaNacimiento)+' Años</div>\
                            <div style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+pie+'</div>\
                            <div style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">\
                                <img src="flags/blank.gif" class="flag flag-'+jugador.nacionalidad1.toLowerCase()+'"/>\
                            </div>\
                            <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;text-align:center;">('+jugador.numero_de_evaluaciones+')</div>\
                        </div>';
                        
                        lista_arqueros.push(fila);
                    }
                }
                for(let jugador2 of window.jugadores_scouting){
                    
                    let fila="";
                    if(jugador2.posicionA===2 && jugador2.numero_posicion==="0"){
                        contador++;
                        let pie=(jugador2.pieHabil==="1")?"Derecho":"izquierdo",
                        serie=(jugador2.serieActual==="99")?"Prime":"Sub-"+jugador2.serieActual,
                        datos_funcion="'"+jugador2.idfichaJugador+"','"+jugador2.posicion+"'";
                        fila='\
                        <div class="fila_serie_jugador" onClick="consultarEvaluacionesJugador('+datos_funcion+')" style="box-sizing:border-box;border:0;width:100%;height:40px;cursor:pointer;padding-top: 5px;padding-bottom: 5px;">\
                            <div style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+contador+'</div>\
                            <div style="box-sizing:border-box;border:0;width:13%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+jugador2.posicion_texto+'</div>\
                            <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+serie+'</div>\
                            <div style="box-sizing:border-box;border:0;width:31%;height:30px;float:left;">\
                                <div style="box-sizing:border-box;border:0;float:left;width:11%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;">\
                                    <img style="width:100%;height:100%" src="./foto_jugadores/'+jugador2.idfichaJugador+'.jpeg"/>\
                                </div>\
                                <div style="box-sizing:border-box;border:0;float:left;width:89%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;overflow:hidden;">'+jugador2.nombre+' '+jugador2.apellido1+' '+jugador2.apellido2+'</div>\
                            </div>\
                            <div style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+formatoRut(jugador2.rut)+'</div>\
                            <div style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+jugador2.fechaNacimiento+'</div>\
                            <div style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+calcularEdad(jugador2.fechaNacimiento)+' Años</div>\
                            <div style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+pie+'</div>\
                            <div style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">\
                                <img src="flags/blank.gif" class="flag flag-'+jugador2.nacionalidad1.toLowerCase()+'"/>\
                            </div>\
                            <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;text-align:center;">('+jugador2.numero_de_evaluaciones+')</div>\
                        </div>';
                        lista_defensas.push(fila);
                    }
                }
                for(let jugador3 of window.jugadores_scouting){
                    
                    let fila="";
                    if(jugador3.posicionA===3 && jugador3.numero_posicion==="0"){
                        contador++;
                        let pie=(jugador3.pieHabil==="1")?"Derecho":"izquierdo",
                        serie=(jugador3.serieActual==="99")?"Prime":"Sub-"+jugador3.serieActual,
                        datos_funcion="'"+jugador3.idfichaJugador+"','"+jugador3.posicion+"'";
                        fila='\
                        <div class="fila_serie_jugador" onClick="consultarEvaluacionesJugador('+datos_funcion+')" style="box-sizing:border-box;border:0;width:100%;height:40px;cursor:pointer;padding-top: 5px;padding-bottom: 5px;">\
                            <div style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+contador+'</div>\
                            <div style="box-sizing:border-box;border:0;width:13%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+jugador3.posicion_texto+'</div>\
                            <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+serie+'</div>\
                            <div style="box-sizing:border-box;border:0;width:31%;height:30px;float:left;">\
                                <div style="box-sizing:border-box;border:0;float:left;width:11%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;">\
                                    <img style="width:100%;height:100%" src="./foto_jugadores/'+jugador3.idfichaJugador+'.jpeg"/>\
                                </div>\
                                <div style="box-sizing:border-box;border:0;float:left;width:89%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;overflow:hidden;">'+jugador3.nombre+' '+jugador3.apellido1+' '+jugador3.apellido2+'</div>\
                            </div>\
                            <div style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+formatoRut(jugador3.rut)+'</div>\
                            <div style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+jugador3.fechaNacimiento+'</div>\
                            <div style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+calcularEdad(jugador3.fechaNacimiento)+' Años</div>\
                            <div style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+pie+'</div>\
                            <div style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">\
                                <img src="flags/blank.gif" class="flag flag-'+jugador3.nacionalidad1.toLowerCase()+'"/>\
                            </div>\
                            <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;text-align:center;">('+jugador3.numero_de_evaluaciones+')</div>\
                        </div>';
                        lista_campistas.push(fila);
                    }
                }

                for(let jugador4 of window.jugadores_scouting){
                    
                    let fila="";
                    if(jugador4.posicionA===4 && jugador4.numero_posicion==="0"){
                        contador++;
                        let pie=(jugador4.pieHabil==="1")?"Derecho":"izquierdo",
                        serie=(jugador4.serieActual==="99")?"Prime":"Sub-"+jugador4.serieActual,
                        datos_funcion="'"+jugador4.idfichaJugador+"','"+jugador4.posicion+"'";
                        fila='\
                        <div class="fila_serie_jugador" onClick="consultarEvaluacionesJugador('+datos_funcion+')" style="box-sizing:border-box;border:0;width:100%;height:40px;cursor:pointer;padding-top: 5px;padding-bottom: 5px;">\
                            <div style="box-sizing:border-box;border:0;width:2%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+contador+'</div>\
                            <div style="box-sizing:border-box;border:0;width:13%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+jugador4.posicion_texto+'</div>\
                            <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+serie+'</div>\
                            <div style="box-sizing:border-box;border:0;width:31%;height:30px;float:left;">\
                                <div style="box-sizing:border-box;border:0;float:left;width:11%;height:30px;border-radius: 26px;overflow: hidden;border: 2px solid #555;">\
                                    <img style="width:100%;height:100%" src="./foto_jugadores/'+jugador4.idfichaJugador+'.jpeg"/>\
                                </div>\
                                <div style="box-sizing:border-box;border:0;float:left;width:89%;height:30px;padding-left:5px;color:#555;font-weight: bold;line-height: 30px;overflow:hidden;">'+jugador4.nombre+' '+jugador4.apellido1+' '+jugador4.apellido2+'</div>\
                            </div>\
                            <div style="box-sizing:border-box;border:0;width:9%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+formatoRut(jugador4.rut)+'</div>\
                            <div style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+jugador4.fechaNacimiento+'</div>\
                            <div style="box-sizing:border-box;border:0;width:7%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+calcularEdad(jugador4.fechaNacimiento)+' Años</div>\
                            <div style="box-sizing:border-box;border:0;width:8%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">'+pie+'</div>\
                            <div style="box-sizing:border-box;border:0;width:10%;height:30px;float:left;color:#555;font-weight: bold;line-height: 30px;text-align:center;">\
                                <img src="flags/blank.gif" class="flag flag-'+jugador4.nacionalidad1.toLowerCase()+'"/>\
                            </div>\
                            <div style="box-sizing:border-box;border:0;width:5%;height:30px;float:left;color:#555;font-weight: bold;text-align:center;">('+jugador4.numero_de_evaluaciones+')</div>\
                        </div>';
                        lista_delantero.push(fila);
                    }
                }



                if(lista_arqueros.length>0){
                    // <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;color:#fff;font-weight: bold;line-height: 30px;font-size: 18px;padding-left: 25px;">Arqueros</div>
                    $("#seccion_arquero").append('<div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;color:#fff;font-weight: bold;line-height: 30px;font-size: 18px;padding-left: 25px;">Arqueros</div>');
                    for(let arquero of lista_arqueros ){
                        $("#seccion_arquero").append(arquero);
                    }
                }
                if(lista_defensas.length>0){
                    // <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;color:#fff;font-weight: bold;line-height: 30px;font-size: 18px;padding-left: 25px;">Arqueros</div>
                    $("#seccion_defensa").append('<div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;color:#fff;font-weight: bold;line-height: 30px;font-size: 18px;padding-left: 25px;">Defensas</div>');
                    for(let defensa of lista_defensas ){
                        $("#seccion_defensa").append(defensa);
                    }
                }
                if(lista_campistas.length>0){
                    // <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;color:#fff;font-weight: bold;line-height: 30px;font-size: 18px;padding-left: 25px;">Arqueros</div>
                    $("#seccion_medio_campista").append('<div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;color:#fff;font-weight: bold;line-height: 30px;font-size: 18px;padding-left: 25px;">Mediocampistas</div>');
                    for(let campista of lista_campistas ){
                        $("#seccion_medio_campista").append(campista);
                    }
                }
                if(lista_delantero.length>0){
                    // <div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;color:#fff;font-weight: bold;line-height: 30px;font-size: 18px;padding-left: 25px;">Arqueros</div>
                    $("#seccion_delantero").append('<div style="box-sizing:border-box;border:0;width:100%;height:30px;background-color:#555;color:#fff;font-weight: bold;line-height: 30px;font-size: 18px;padding-left: 25px;">Delanteros</div>');
                    for(let delantero of lista_delantero ){
                        $("#seccion_delantero").append(delantero);
                    }
                }
            },
            error: function () {
                // $('.boton_refresh').show();
                // $("#tabla_ver_jugadores tbody").html('<tr class="sin_fondo"><td colspan="11" style="text-align: center; color: #dc4e4e; font-size: 16px; padding: 5px;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</td></tr>');
            }, timeout: 15000
        });
}



function consultarEvaluacionesJugador(id,posicion){
    $("html, body").animate({ scrollTop: 0 }, 600);
    window.jugador_selecionado={};
    for(let jugador of window.jugadores_serie){
        if(jugador.idfichaJugador===id && jugador.posicion===posicion){
            window.jugador_selecionado=jugador;
        }
    }
    console.log(window.jugador_selecionado);
    // window.lista_id_concepto_tipo_evaluacion=[]
    window.evaluaciones_jugador=[];
    
    // concetos_evaluar_jugador
    if(window.jugador_selecionado.idfichaJugador){
        let id_jugador_seleccionado=window.jugador_selecionado.idfichaJugador,
        posicion_jugador_seleccionado=window.jugador_selecionado.posicion;
        $.ajax({
            url: 'post/evaluacion_jugador_consultar_evaluaciones_y_conceptos_jugador.php',
            type: "post",
            data:[{name:"id",value:id_jugador_seleccionado}],
            success: function (respuesta) {
                let json= JSON.parse(respuesta);
                // console.log(json)
                window.jugador_selecionado.listas_concepto_jugador=json.listas_conceptos;
                window.jugador_selecionado.posiciones_jugador=json.posiciones_jugador;
                // window.concetos_evaluar_jugador=json.listas_conceptos
               

                window.evaluaciones_jugador=json.lista_evaluaciones_jugador;
                console.log(window.jugador_selecionado.posiciones_jugador);
                console.log(window.jugador_selecionado.listas_concepto_jugador);
                
                $("#vista_serie_jugadores").css("display","none");
                $("#vista_evaluaciones_jugador").css("display","block");
                $("#contenedor_foto_jugador_1").html('<img style="box-sizing: border-box;border: 0;width:100%;height:100%" src="./foto_jugadores/'+window.jugador_selecionado.idfichaJugador+'.jpeg" alt="foto_jugador_1"/>');
                let nombrer_jugador=jugador_selecionado.nombre+' '+jugador_selecionado.apellido1+' '+jugador_selecionado.apellido2;
                $("#nombre_jugador_vista_evaluaciones_jugador").text(nombrer_jugador);
                // info_jugador_vista_evaluaciones_jugador
                let pie=(jugador_selecionado.pieHabil==="1")?"Derecho":"Izquierdo";
                let texto_info=calcularEdad(jugador_selecionado.fechaNacimiento)+' Años, '+jugador_selecionado.posicion_texto+', Pie '+pie;
                $("#info_jugador_vista_evaluaciones_jugador").text(texto_info);
                mostrarDatosEvaluacionesTabla();
                
            },
            error: function () {
                // $('.boton_refresh').show();
                // $("#tabla_ver_jugadores tbody").html('<tr class="sin_fondo"><td colspan="11" style="text-align: center; color: #dc4e4e; font-size: 16px; padding: 5px;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</td></tr>');
            }, timeout: 15000
        });
    }

}

function mostrarDatosEvaluacionesTabla(){
    let numero_fila=0,
    lista_fila_tabla=[];
    $("#contenido_tabla").empty();
    for(let evaluacion of window.evaluaciones_jugador){
        // font-weight: bold
        let fila='\
        <tr class="fila_serie_jugador" style="box-sizing:border-box;border:0;height:40px;cursor:pointer;padding-top: 5px;padding-bottom: 5px;">\
            <th scope="col" style="border-top-left-radius:5px; padding-top:5px; padding-bottom:5px;font-size: 10px;width: 20px;"><center>'+(numero_fila+1)+'</center></th>\
            <td scope="col" style="box-sizing:border-box;border:0;height:30px;padding:0px;width: 50px;font-weight: bold">\
            <div class="tip-top" data-original-title="" style="text-align: left;font-size: 10px;">'+evaluacion.fecha_evaluacion_jugador+'</div>\
            </td>\
            <td scope="col" style="box-sizing:border-box;border:0;height:30px;padding:0px;width: 53px;font-weight: bold">\
            <div class="tip-top" data-original-title="" style="text-align:left;font-size: 10px;">'+lista_posiciones_glovales[parseInt(evaluacion.posicion_evaluacion_jugador)-1]+'</div>\
            </td>\
            <td scope="col" style="box-sizing:border-box;border:0;height:30px;padding:0px;width: 36px;font-weight: bold">\
            <div class="tip-top" data-original-title="" style="text-align:left;font-size: 10px;text-align: center;">informe N° '+evaluacion.idevaluacion_jugador+'</div>\
            </td>\
            <td scope="col" style="box-sizing:border-box;border:0;height:30px;padding:0px;width: 34px;">\
            <div class="tip-top" data-original-title="" style="font-size: 10px;box-sizing: border-box;border: 0;width: 50%;height: 24px;margin-left: auto;margin-right: auto;text-align: center;line-height: 24px; '+calcularColor(parseInt(evaluacion.total_final_tecnica))+';border-radius: 5px;font-weight: bold;">'+evaluacion.total_final_tecnica+' %</div>\
            </td>\
            <td scope="col" style="box-sizing:border-box;border:0;height:30px;padding:0px;width: 34px;">\
            <div class="tip-top" data-original-title="" style="font-size: 10px;box-sizing: border-box;border: 0;width: 50%;height: 24px;margin-left: auto;margin-right: auto;text-align: center;line-height: 24px;'+calcularColor(parseInt(evaluacion.total_final_tactica))+';border-radius: 5px;font-weight: bold;">'+evaluacion.total_final_tactica+' %</div>\
            </td>\
            <td scope="col" style="box-sizing:border-box;border:0;height:30px;padding:0px;width: 28px;">\
            <div class="tip-top" data-original-title="" style="font-size: 10px;box-sizing: border-box;border: 0;width: 50%;height: 24px;margin-left: auto;margin-right: auto;text-align: center;line-height: 24px;'+calcularColor(parseInt(evaluacion.total_final_otra))+';border-radius: 5px;font-weight: bold;">'+evaluacion.total_final_otra+' %</div>\
            </td>\
            <td scope="col" style="box-sizing:border-box;border:0;height:30px;padding:0px;width: 15px;">\
            <div class="tip-top" data-original-title="" style="font-size: 10px;">-></div>\
            </td>\
            <td scope="col" style="box-sizing:border-box;border:0;height:30px;padding:0px;width: 54px;">\
            <div class="tip-top" data-original-title="" style="    box-sizing: border-box;border: 0;width: 90%;height: 24px;text-align: center;line-height: 21px;font-weight: bold;border: 2px solid '+calcularColorBorder(parseInt(evaluacion.total_promedio))+';border-radius: 10px;">'+evaluacion.total_promedio+' %</div>\
            </td>\
            <td scope="col" style="box-sizing:border-box;border:0;height:30px;padding:0px;width: 54px;font-weight: bold">\
            <div class="tip-top" data-original-title="" style="text-align:left;font-size: 10px;">'+evaluacion.nombre_usuario_software+'</div>\
            </td>\
            <td style="padding:2px;width: 20px;">\
                <center >\
                    <a class="boton_editar"   onClick="editarEvaluacion('+numero_fila+')">\
                        <i class="icon-pencil"></i>\
                    </a>\
                </center>\
            </td>\
            <td style="padding:2px;width: 20px;">\
                <center>\
                    <a class="boton_eliminar" onClick="abrirModaleliminarEvaluacion('+numero_fila+')">\
                        <i class="icon-remove"></i>\
                    </a>\
                </center>\
            </td>\
        </tr>';
        numero_fila++;
        lista_fila_tabla.push(fila);
    }
    console.log(lista_fila_tabla);
    if(lista_fila_tabla.length>0){
        for(let fila_evaluacion of lista_fila_tabla){
            // console.log(1)
            // alert(fila_evaluacion)
            $("#contenido_tabla").append(fila_evaluacion);
        }
    }
    else{
        $("#contenido_tabla").append('<tr class="sin_fondo" ><td colspan="12" ><center><h5 style="color:#555555;margin-top:10px;margin-bottom:10px;"><i class="icon-file-alt"></i> Sin Evaluaciones</h5></center></td></tr>');
    }
    

}

function calcularColor(valor){
    if(valor>60){
        return "background-color:#28b779;color:#fff;";
    }
    else if (valor>=40 && valor<=60){
        return "background-color:#ffbb00;color:#fff;";
    }
    else if (valor>=1 && valor<40){
        return "background-color:#dc4e4e;color:#fff";
    }
    else{
        return "color:#000";
    }
}

function calcularColorBorder(valor){
    if(valor>60){
        return "#28b779;";
    }
    else if (valor>=40 && valor<=60){
        return "#ffbb00;";
    }
    else if (valor>=1 && valor<40){
        return "#dc4e4e;";
    }
    else{
        return "#d52121";
    }
}

function editarEvaluacion(index){
    $("html, body").animate({ scrollTop: 0 }, 600);
    window.tipo_formulario=true;
    limpiarFormulario();
    let evaluacion=window.evaluaciones_jugador[index];
    console.log(evaluacion);
    $("#vista_evaluaciones_jugador").css("display","none");
    $("#vista_evaluacion_jugador").css("display","block");
    $("#foto_jugador_evaluacion").html('<img style="box-sizing: border-box;border: 0;width:100%;height:100%" src="./foto_jugadores/'+window.jugador_selecionado.idfichaJugador+'.jpeg" alt="foto_jugador_1"/>');
    let nombrer_jugador=jugador_selecionado.nombre+' '+jugador_selecionado.apellido1+' '+jugador_selecionado.apellido2;
    $("#nombre_jugador_evaluacion").text(nombrer_jugador);
    insetarPosiciones(window.jugador_selecionado.posiciones_jugador);
    $("#posicion_evaluar").val(evaluacion.posicion_evaluacion_jugador);
    cambiarConceptosEvaluacion(evaluacion.posicion_evaluacion_jugador);

    $("#pocicon_seccion_tecnica").text(evaluacion.posicion_evaluacion_jugador);
    $("#pocicon_seccion_tactica").text(evaluacion.posicion_evaluacion_jugador);
    $("#pocicon_seccion_otro").text(evaluacion.posicion_evaluacion_jugador);
    $("#fecha_evaluacion").val(evaluacion.fecha_evaluacion_jugador);
    $("#comentario_fortaleza").val(evaluacion.comentario_fortaleza);
    $("#comentario_devilidad").val(evaluacion.comentario_devilidad);
    $("#comentario_recomendacion").val(evaluacion.comentario_recomendacion);
    activarRadiosNotas(evaluacion.detalle_evaluaciones);
    $("#checkbox_apartado_evaluacion_tecnica").prop("checked",false);
    $("#checkbox_apartado_evaluacion_tactica").prop("checked",false);
    $("#checkbox_apartado_evaluacion_otro").prop("checked",false);
    abrirTablaTecnica();
    abrirTablaTactica();
    abrirTablaOtro();
    window.id_evaluacion=evaluacion.idevaluacion_jugador;
    $("#content").css("min-height","1800px");
    $("#posicion_evaluar").prop("disabled",true);

    
    

}
function activarRadiosNotas(detalles){
    
    for(let detalle of detalles){
        let punto=detalle.nota_detalle_evaluacion_jugador,
        id_concepto=detalle.idevaluacion_concepto;
        let sufijo_encontrado="";
        let tipo="";
        for(sufijo of window.lista_id_concepto_tipo_evaluacion){
            let id_concepto_sifijo=sufijo.split("_")[0];
            if(id_concepto===id_concepto_sifijo){
                sufijo_encontrado=sufijo;
                tipo=sufijo.split("_")[1];
            }
        }
        $('#evaluacion_p'+punto+'_'+sufijo_encontrado).prop("checked",true);
        $('#total_'+sufijo_encontrado).text(punto+' %');
        $('#comentario_'+sufijo_encontrado).val(detalle.comentario_detalle_evaluacion_jugador);
        obtenerTotalDelTipoEvaluacion(tipo);
        estadoLabel(sufijo_encontrado);
    }

}

function insertarFilasConceptos(conceptos){

    let lista_filas_seccion_tecnica=[],
    lista_filas_seccion_tactica=[],
    lista_filas_seccion_otra=[];
    $("#tabla_body_seccion_tecnica").empty();
    $("#tabla_body_seccion_tactica").empty();
    $("#tabla_body_seccion_otro_concepto").empty();
    // console.log(conceptos)
    for(let concepto of conceptos){
        // console.log("1")
        let fila_tabla="";
        if(concepto.evaluacion==="0"){
            
        fila_tabla='\
            <tr style="box-sizing: border-box;border: 0;height:40px;paddign-top:5px;">\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    '+concepto.evaluacion_concepto+'\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p100_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p100_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="100" id="evaluacion_p100_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p80_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p80_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="80" id="evaluacion_p80_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p60_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p60_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="60" id="evaluacion_p60_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p40_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p40_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="40" id="evaluacion_p40_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p20_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p20_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="20" id="evaluacion_p20_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                    <input type="radio" style="display:none;" checked name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="0" id="evaluacion_p0_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                   <div style="box-sizing: border-box;width: 90%;background-color: #47c18e;border-radius: 5px;text-align: center;color: #fff;font-weight: bold;" id="total_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'">0 %</div>\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <input style="box-sizing: border-box;border: 0;height:30px;margin-bottom:0;width:100%;border: 1px solid #9c9c9c;" type="text" name="comentario_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" id="comentario_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" />\
                </td>\
            </tr>';
            lista_filas_seccion_tecnica.push(fila_tabla);
        }
        if(concepto.evaluacion==="1"){
            
            fila_tabla='\
            <tr style="box-sizing: border-box;border: 0;height:40px;paddign-top:5px;">\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    '+concepto.evaluacion_concepto+'\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p100_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p100_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="100" id="evaluacion_p100_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p80_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p80_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="80" id="evaluacion_p80_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p60_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p60_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="60" id="evaluacion_p60_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p40_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p40_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="40" id="evaluacion_p40_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p20_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p20_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="20" id="evaluacion_p20_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                    <input type="radio" style="display:none;" checked name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="0" id="evaluacion_p0_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                   <div style="box-sizing: border-box;width: 90%;background-color: #47c18e;border-radius: 5px;text-align: center;color: #fff;font-weight: bold;" id="total_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'">0 %</div>\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <input style="box-sizing: border-box;border: 0;height:30px;margin-bottom:0;width:100%;border: 1px solid #9c9c9c;" type="text" name="comentario_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" id="comentario_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" />\
                </td>\
            </tr>';
            lista_filas_seccion_tactica.push(fila_tabla);
        }
        if(concepto.evaluacion==="2"){
            
            fila_tabla='\
            <tr style="box-sizing: border-box;border: 0;height:40px;paddign-top:5px;">\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    '+concepto.evaluacion_concepto+'\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p100_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p100_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="100" id="evaluacion_p100_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p80_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p80_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="80" id="evaluacion_p80_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p60_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p60_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="60" id="evaluacion_p60_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p40_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p40_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="40" id="evaluacion_p40_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <label id="label_evaluacion_p20_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" for="evaluacion_p20_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" style="box-sizing: border-box;border: 0;    height: 20px;width: 20px;border-radius: 6px;border: 2px solid #9c9c9c;margin-left: auto;margin-right: auto;background-color:#fff;"></label>\
                    <input type="radio" style="display:none;" name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="20" id="evaluacion_p20_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                    <input type="radio" style="display:none;" checked name="evaluacion_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" value="0" id="evaluacion_p0_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" onClick="total_nota_evaluacion_concepto(this)">\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                   <div style="box-sizing: border-box;width: 90%;background-color: #47c18e;border-radius: 5px;text-align: center;color: #fff;font-weight: bold;" id="total_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'">0 %</div>\
                </td>\
                <td style="box-sizing: border-box;border: 0;height:30px;">\
                    <input style="box-sizing: border-box;border: 0;height:30px;margin-bottom:0;width:100%;border: 1px solid #9c9c9c;" type="text" name="comentario_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" id="comentario_'+concepto.idevaluacion_concepto+'_'+concepto.evaluacion+'" />\
                </td>\
            </tr>';
            lista_filas_seccion_otra.push(fila_tabla);
        }
    }

    if(lista_filas_seccion_tecnica.length>0){
        for(let fila_tabla_seccion_tecnica of lista_filas_seccion_tecnica){
            $("#tabla_body_seccion_tecnica").append(fila_tabla_seccion_tecnica);
        }
    }
    if(lista_filas_seccion_tactica.length>0){
        for(let fila_tabla_seccion_tactica of lista_filas_seccion_tactica){
            $("#tabla_body_seccion_tactica").append(fila_tabla_seccion_tactica);
        }
    }
    if(lista_filas_seccion_otra.length>0){
        for(let fila_tabla_seccion_otra of lista_filas_seccion_otra){
            $("#tabla_body_seccion_otro_concepto").append(fila_tabla_seccion_otra);
        }
    }


}






function total_nota_evaluacion_concepto(radio){
    // alert(radio.id)
    
    let id_radio=radio.id;
    let codigo_auxiliar=id_radio.split("_");
    $('#total_'+codigo_auxiliar[codigo_auxiliar.length-2]+'_'+codigo_auxiliar[codigo_auxiliar.length-1]).text(radio.value+' %');
    obtenerTotalDelTipoEvaluacion(codigo_auxiliar[codigo_auxiliar.length-1]);
    estadoLabel(codigo_auxiliar[codigo_auxiliar.length-2]+'_'+codigo_auxiliar[codigo_auxiliar.length-1]);

}

function estadoLabel(codigo){
    if($('#evaluacion_p100_'+codigo).prop("checked")){
        $('#label_evaluacion_p100_'+codigo).css("background-color","#404040");
    }
    else{
        $('#label_evaluacion_p100_'+codigo).css("background-color","#fff");
    }
    if($('#evaluacion_p80_'+codigo).prop("checked")){
        $('#label_evaluacion_p80_'+codigo).css("background-color","#404040");
    }
    else{
        $('#label_evaluacion_p80_'+codigo).css("background-color","#fff");
    }
    if($('#evaluacion_p60_'+codigo).prop("checked")){
        $('#label_evaluacion_p60_'+codigo).css("background-color","#404040");
    }
    else{
        $('#label_evaluacion_p60_'+codigo).css("background-color","#fff");
    }
    if($('#evaluacion_p40_'+codigo).prop("checked")){
        $('#label_evaluacion_p40_'+codigo).css("background-color","#404040");
    }
    else{
        $('#label_evaluacion_p40_'+codigo).css("background-color","#fff");
    }
    if($('#evaluacion_p20_'+codigo).prop("checked")){
        $('#label_evaluacion_p20_'+codigo).css("background-color","#404040");
    }
    else{
        $('#label_evaluacion_p20_'+codigo).css("background-color","#fff");
    }

}

function limpiarFormulario(){
    $("#comentario_fortaleza").val("");
    $("#comentario_devilidad").val("");
    $("#comentario_recomendacion").val("");
    $("#total_evaluacion_3_tecnica").text("0 %");
    $("#total_evaluacion_3_tactica").text("0 %");
    $("#total_evaluacion_3_otro").text("0 %");

    $("#total_porcentaje_apartado_evaluacion_tecnica").text("0 %");
    $("#total_porcentaje_apartado_evaluacion_tactica").text("0 %");
    $("#total_porcentaje_apartado_evaluacion_otro_concepto").text("0 %");

    $("#total_evaluacion_2_tecnica").text("0 %");
    $("#total_evaluacion_2_tactica").text("0 %");
    $("#total_evaluacion_2_otro").text("0 %");
}

// total_porcentaje_apartado_evaluacion_tecnica

function obtenerTotalDelTipoEvaluacion(tipo){
    // window.concetos_evaluar_jugador
    console.log(window.lista_id_concepto_tipo_evaluacion);
    let lis_totales=[];
    for(let codigo of window.lista_id_concepto_tipo_evaluacion){
        let str_tipo = codigo.split("_")[1];
        if(str_tipo===tipo){
            let total=$('#total_'+codigo).text();
            lis_totales.push(parseInt(total.split(" ")[0]));
        }

    }
    // console.log(lis_totales)
    let numero_divisor=lis_totales.length;
    let suma_total=0;
    for(let numero of lis_totales){
        suma_total=suma_total+numero;
    }
    // alert(parseInt(suma_total/numero_divisor))
    let total_final=parseInt(suma_total/numero_divisor);
    if(tipo==="0"){
        $("#total_porcentaje_apartado_evaluacion_tecnica").text(total_final+' %');
        $("#total_evaluacion_3_tecnica").text(total_final+' %');
        $("#total_evaluacion_2_tecnica").text(total_final+' %');
    }
    if(tipo==="1"){
        $("#total_porcentaje_apartado_evaluacion_tactica").text(total_final+' %');
        $("#total_evaluacion_3_tactica").text(total_final+' %');
        $("#total_evaluacion_2_tactica").text(total_final+' %');
    }
    if(tipo==="2"){
        $("#total_porcentaje_apartado_evaluacion_otro_concepto").text(total_final+' %');
        $("#total_evaluacion_3_otro").text(total_final+' %');
        $("#total_evaluacion_2_otro").text(total_final+' %');
    }

}

function mostrarModalEnviarDatos(){
    if(!window.tipo_formulario){
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres agregar una nueva evaluación a este jugador?</h5><br><img src="../config/agregar_archivo.png">');
    }
    else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5 style="color:black;">¿Estás seguro que quieres editar esta evaluación?</h5><br><img src="../config/agregar_archivo.png">');
    }
    
    $("#contendor_botones_modal").empty();
    $("#contendor_botones_modal").html('\
    <button type="button" class="btn btn-default boton_modal" onClick="cerrarModalFormularioEnviarDatos()"  id="boton_cerrar_alerta" style="margin-right:20px; border-radius:5px;"><span class="icon"><i class="icon-remove"></i></span> No</button>\
        <button type="button" id="guardar" class="btn btn-default boton_modal " onClick="enviarDatos()" ng-click="desactivarBotonAgregarBoleta()" style="border-radius:5px;"><span class="icon"><i class="icon-ok"></i></span> Si</button>')
    $("#modalEvaluacionJugador").modal("show");
}

function cerrarModalFormularioEnviarDatos(){
    $("#modalEvaluacionJugador").modal("hide");
}

function enviarDatos(){
    if(!window.tipo_formulario){
		$('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Agregando evaluació ...</h5><br><img src="../config/agregar_archivo.png">');
	}else{
        $('#mensaje_agregar_DescargarBoleta').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Editando evaluació ...</h5><br><img src="../config/agregar_archivo.png">');
	}
    let datos=$("#formulario_evaluacion_jugador").serializeArray(),
    fecha_evaluacion=$("#fecha_evaluacion").val(),
    posicion=$("#posicion_evaluar").val(),
    total_tecnica=$("#total_evaluacion_3_tecnica").text().split(" ")[0],
    total_tactica=$("#total_evaluacion_3_tactica").text().split(" ")[0],
    total_otra=$("#total_evaluacion_3_otro").text().split(" ")[0];
    total_promedio_final=parseInt((parseInt(total_otra)+parseInt(total_tactica)+parseInt(total_tecnica))/3);
    datos.push({name:"total_final_tecnica",value:total_tecnica});
    datos.push({name:"total_final_tactica",value:total_tactica});
    datos.push({name:"total_final_otra",value:total_otra});
    datos.push({name:"total_promedio",value:total_promedio_final});
    for(let codigo of lista_id_concepto_tipo_evaluacion){
        datos.push({name:"array_id_concepto_tipo_evaluacion[]",value:codigo});
    }
    datos.push({name:"fecha_evaluacion_jugador",value:fecha_evaluacion});
    datos.push({name:"posicion_evaluacion_jugador",value:posicion});
    datos.push({name:"nombre_usuario_software",value:window.nombre_usuario_software});
    datos.push({name:"idfichaJugador",value:window.jugador_selecionado.idfichaJugador});
    datos.push({name:"tipo_formulario",value:window.tipo_formulario});
    datos.push({name:"idevaluacion_jugador",value:window.id_evaluacion});
    console.log(datos);
    // evaluacion_jugador_guardar
    $.ajax({
        url: "post/evaluacion_jugador_guardar.php",
        type: "post",
        data:datos,
        success: function(respuesta) {
            var json=JSON.parse(respuesta);
            // console.log(json)
            $("#modalEvaluacionJugador").modal("hide");
            botonVolverHaVistaEvaluacionesJugador();
            consultarEvaluacionesJugador(window.jugador_selecionado.idfichaJugador,window.jugador_selecionado.posicion);

        },error: function(){// will fire when timeout is reached
            // alert("errorXXXXX");
            $('#error_conexion').show();
            
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

function fechaEvaluacion(){
    $('#fecha_evaluacion').datetimepicker({
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
    $('#fecha_evaluacion').datetimepicker('setDate', new Date() );
}


</script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap-datetimepicker/js/locales/bootstrap-datetimepicker.es.js" charset="UTF-8"></script>
<script>
    // generarCartasSerie()
    // consultarCantidadDeJugadoresPorSerie();
    mostrar_al_cargar_pagina();
    // $(document).on('click', '.option', function(e) { //
    //     e.stopPropagation();
    // });
    // $('.c_objetivo_fisico li').click(function (e) { e.stopPropagation(); });


</script>
