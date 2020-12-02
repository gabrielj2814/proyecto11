<?php 
$n_zonas_frt    = [
    '',
    'Cara / Cabeza',
    'Hombro derecho',
    'Hombro izquierdo',
    'Torax',
    'Brazo Derecho',
    'Brazo izquierdo',
    'Antebrazo Derecho',
    'Antebrazo izquierdo',
    'Abdomen',
    'Muñeca Derecha',
    'Muñeca izquierda',
    'Manos / Dedos Der',
    'Manos / Dedos Izq',
    'Cadera / Ingle/ Pelvis',
    'Muslo Anterior Der',
    'Muslo Anterior Izq',
    'Rodilla Derecha',
    'Rodilla Izquierda',
    'Pierna Derecha',
    'Pierna Izquierda',
    'Tobillo Derecho',
    'Tobillo Izquierdo',
    'Pie Derecho',
    'Pie Izquierdo',
    'Senos'
];
$pos_frt        = [
    '',
    'top: 2%; left: 50%;',      // CABEZA
    'top: 18%; left: 32%;',     // HOMBRO DERECHO
    'top: 18%; left: 67.5%;',   // HOMBRO IZQUIERDO
    'top: 18%; left: 50%;',     // TORAX
    'top: 25%; left: 31%;',     // BRAZO DERECHO
    'top: 25%; left: 68%;',     // BRAZO IZQUIERDO
    'top: 36%; left: 24%;',     // ANTEBRAZO DERECHO
    'top: 36%; left: 75%;',     // ANTEBRAZO IZQUIERDO
    'top: 34%; left: 50%;',     // ABDOMEN
    'top: 44%; left: 18%;',     // MUÑECA DERECHA
    'top: 44%; left: 81%;',     // MUÑECA IZQUIERDA
    'top: 46%; left: 18%;',     // MANO DERECHA
    'top: 46%; left: 81%;',     // MANO IZQUIERDA
    'top: 44%; left: 50%;',     // CADERA
    'top: 57%; left: 40%;',     // MUSLO ANTERIOR DERECHO
    'top: 57%; left: 60%;',     // MUSLO ANTERIOR IZQUIERDO
    'top: 68%; left: 40%;',     // RODILLA DERECHA
    'top: 68%; left: 60%;',     // RODILLA IZQUIERDA
    'top: 74%; left: 40%;',     // PIERNA DERECHA 
    'top: 74%; left: 60%;',     // PIERNA IZQUIERDA 
    'top: 90%; left: 40%;',     // TOBILLO DERECHO
    'top: 90%; left: 60%;',     // TOBILLO IZQUIERDO
    'top: 92%; left: 38%;',     // PIE DERECHO
    'top: 92%; left: 61%;',     // PIE IZQUIERDO
    'top: 24%; left: 50%;'      // SENOS
];
$n_zonas_bck    = [
    '',
    'Cuello / Cervical',
    'Dorsales',
    'Lumbares',
    'Codo Izquierdo',
    'Codo Derecho',
    'Gluteos',
    'Muslo Posterior Izquierdo',
    'Muslo Posterior Derecho',
    'Pantorrilla Izquierda',
    'Pantorrilla Derecha',
];
$pos_bck        = [
    '',
    'top: 12.5%; left: 50%;',   // CUELLO
    'top: 17%; left: 50%;',     // DORSAL
    'top: 36%; left: 50%;',     // LUMBARES
    'top: 34%; left: 23%;',     // CODO IZQUIERDO
    'top: 34%; left: 78%;',     // CODO DERECHO
    'top: 45%; left: 50%;',     // GLUTEOS
    'top: 57%; left: 40%;',     // MUSLO ANTERIOR IZQUIERDO
    'top: 57%; left: 60%;',     // MUSLO ANTERIOR DERECHO
    'top: 76%; left: 40%;',     // PANTORRILLA IZQUIERDA
    'top: 76%; left: 60%;',     // PANTORRILLA DERECHA
];
$id_jugador     = 52;

$fecha = new DateTime();
$anio_a = $fecha->format('Y');
$meses = ['', 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Cuestionario Checkin</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel='stylesheet' href='css/font_googleapis.css' type='text/css'>
    <link rel="stylesheet" href="font-awesome_3.2.1/css/font-awesome.css" />
    <script type="text/javascript" src="graficos/jquery-3.1.1.min.js"></script>
    <style>
        * {
            box-sizing: content-box;
        }
        body, html {
            height: 100%;
            width: 100%;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            overflow: auto;
        }
        body {
            padding: 0px;
            margin: 0px;
        }
        h1, h2, h3, h4, h5, h6 {
            padding: 5px 3px;
            margin: 0px;
            font-weight: medium;
            text-shadow: none;
        }
        .btn-center {
            text-align: center;
        }
        button{
            cursor: pointer;
        }
        .contenedor_input {
            display: flex;
            width: 100%;
            margin-bottom: 10px;
        }
        .contenedor_input a, .contenedor_textarea a {
            display: inline-block;
            text-align: center;
            font-size: 11px;
            line-height: 18px;
            color: #ffffff;
            background: #28b779;
            border-bottom-left-radius: 1px;
            border-top-left-radius: 1px;
            padding: 3px;
            box-sizing: border-box;
        }
        .contenedor_input input, .contenedor_input select, .contenedor_textarea textarea {
            display: inline-block;
            -webkit-appearance: none;
            -moz-appearance: none;
            font-size: 14px;
            // line-height: 16px;
            border: 1px solid #28b779;
            border-bottom-right-radius: 1px;
            border-top-right-radius: 1px;
            border-bottom-left-radius: 0px;
            border-top-left-radius: 0px;
            padding: 3px;
            box-shadow: none;
            outline: none;
            resize: none;
            box-sizing: border-box;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            background: #ffffff;
        }
        .contenedor_input input:read-only {
            background: #e4e4e4;
        }
        /* =============== =============== */
        /* =============== =============== */
        #login-container {
            height: 100%;
            width: 100%;
            background: url('../images/background.png') fixed;
            background-repeat: no-repeat;
            background-position-x: center;
            background-position-y: center;
            background-size: 1200px auto;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: auto;
        }
        #login-container #form_container {
            background: rgba(0, 0, 0, 0.5);
            width: 80vw;
            max-width: 600px;
            min-height: 75vh;
            border-radius: 3px;
            padding: 20px;
            position: relative;
        }
        #login-container #form_container h1, #login-container #form_container h2, #login-container #form_container h3, #login-container #form_container h4, #login-container #form_container h5, #login-container #form_container h6 {
            color: #ffffff;
            text-shadow: 0px 0px 1px black;
            text-align: center;
            font-weight: normal;
            font-size: 20px;
            margin-bottom: 5px;
        }
        #login-container #form_container #contenedor_logo {
            text-align: center;
        }
        #login-container #form_container #img-equipo {
            margin: 25px auto;
            width: 75%;
            max-width: 200px;
        }
        #login-container #form_login {
            box-sizing: content-box;
        }
        #login-container #form_login input, #login-container #form_login button {
            background: none;
            color: #ffffff;
            border: 1.5px solid #ffffff;
            width: 100%;
            margin-bottom: 20px;
            box-shadow: none;
            outline: none;
            padding: 5px 5px 5px 25px;
            box-sizing: border-box;
            font-size: 16px;
        }
        #login-container #form_login input::-webkit-input-placeholder { color: #C3C3C3; } 
        #login-container #form_login input:-moz-placeholder { /* Firefox 18- */ color: #C3C3C3; } 
        #login-container #login-container #form_login input::-moz-placeholder { /* Firefox 19+ */ color: #C3C3C3; } 
        #login-container #form_login input:-ms-input-placeholder { color: #C3C3C3; } 
        #login-container #form_login i[class^="icon-"] {
            color: #ffffff;
            position: absolute;
            top: 7px;
            left: 7px;
        }
        #login-container #form_login button {
            width: 50%;
            max-width: 150px;
            padding: 5px !important;
        }
        #login-container #form_login #error_inicio {
            background: rgba(255,50,50,.3);
            padding: 8px;
            margin-bottom: 20px;
            color: #ffffff;
            border-radius: 2px;
        }
        #login-container #form_login #error_inicio p {
            margin: 0px;
            text-align: center;
        }
        /* =============== =============== */
        /* =============== =============== */
        #app-container {
            height: 100%;
            width: 100%;
            background: #ffffff;
            position: absolute;
            right: 100%;
            top: 0px;
            transition: all ease .3s;
            overflow: auto;
        }
        #app-container.show {
            right: 0%;
        }
        #app-container #header_perfil {
            display: flex;
            background: #28b779;
            color: #ffffff;
            margin-bottom: 20px;
        }
        #app-container #header_perfil button {
            background: none;
            border: none;
            border-right: 1px solid #ffffff;
            margin-right: 10px;
            padding: 0px 10px;
            outline: none;
            color: #ffffff;
        }
        #app-container #header_perfil span {
            font-size: 10px;
            font-weight: bold;
            padding-top: 9px;
            padding-bottom: 9px;
        }
        #app-container #titulo_perfil {
            color: #888888;
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin-bottom:20px;
        }
        #app-container .img-jugador {
            text-align: center;
        }
        #app-container .img-jugador img {
            width: 120px;
            border: 3px solid #28b779;
            border-radius: 50%;
            margin-bottom: 20px;
        }
        .contenedor-centro {
            width: 60%;
            max-width: 400px;
            margin: auto;
        }
        #app-container .contenedor_input a {
            width: 40%;
        }
        #app-container .contenedor_input input {
            width: 60%;
        }
        #app-container .descripcion_formulario {
            display: inline-block;
            width: 100%;
            text-align: center;
            font-weight: normal;
            color: #888888;
            font-size: 14.5px;
            font-style: italic;
            margin-top: 15px;
            margin-bottom: 15px;
        }
        #app-container .btn {
            display: inline-block;
            color: #ffffff;
            outline: none;
            border-radius: 6px;
            background: #28b779;
            padding: 12px 7px;
            min-width: 100px;
            text-align: center;
            cursor: pointer;
            font-size: 13px;
            margin-bottom: 20px;
            text-decoration: none;
            box-sizing: border-box;
            width: 100%;
            border: none;
        }
        #app-container .btn.check-in {
            background: #FF4C3E;
        }
        #app-container .btn.check-out {
            background: #0070C0;
        }
        /* =============== =============== */
        /* =============== =============== */
        #cuestionario_checkin {
            height: 100%;
            width: 100%;
            background: #ececec;
            position: absolute;
            right: 100%;
            top: 0px;
            transition: all ease .3s;
            overflow: auto;
        }
        #cuestionario_checkin.show {
            right: 0%;
        }
        #cuestionario_checkin form {
            max-width: 600px;
            margin: auto;
        }
        #cuestionario_checkin #header_cuestionario {
            display: flex;
            background: #FF4C3E;
            color: #ffffff;
        }
        #cuestionario_checkin #header_cuestionario button {
            background: none;
            border: none;
            border-right: 1px solid #ffffff;
            margin-right: 10px;
            padding: 0px 10px;
            outline: none;
            color: #ffffff;
            z-index: 99;
        }
        #cuestionario_checkin #header_cuestionario span {
            display: inline-block;
            width: 100%;
            font-size: 10px;
            font-weight: bold;
            padding-top: 9px;
            padding-bottom: 9px;
            text-align: center;
            margin-left: -32px;
        }
        #cuestionario_checkin .titulo_label {
            display: inline-block;
            width: 100%;
            font-size: 14px;
            margin-bottom: 10px;
        }
        #cuestionario_checkin form {
            padding: 15px;
        }
        #cuestionario_checkin .form {
            margin-bottom: 10px;
        }
        #cuestionario_checkin .contenedor_input a {
            width: 40%;
        }
        #cuestionario_checkin .contenedor_input.suenio a {
            width: 40%;
        }
        #cuestionario_checkin .contenedor_input.suenio a:last-child {
            width: 20%;
        }
        #cuestionario_checkin .contenedor_input.suenio input {
            width: 40%;
        }
        #cuestionario_checkin .contenedor_input input, #cuestionario_checkin .contenedor_input select {
            width: 60%;
        }
        #cuestionario_checkin .contenedor_textarea a {
            width: 100%;
        }
        #cuestionario_checkin .contenedor_textarea textarea {
            width: 100%;
            height: 100px;
            font-size: 12px;
        }
        #cuestionario_checkin .list_opciones {
            list-style: none;
            margin: 0px 0px 10px;
            padding: 0px;
        }

        #cuestionario_checkin .tabla_opciones {
            margin: 0px 0px 10px;
            padding: 0px;
            border-collapse: collapse;
            /*width: 600px;*/
            background-color: white;
        }

        #cuestionario_checkin .tabla_opciones tbody tr td, #cuestionario_checkin .tabla_opciones tbody tr th {
            border: 1px solid black;
        }

        #cuestionario_checkin .tabla_opciones tbody tr td p, #cuestionario_checkin .tabla_opciones tbody tr th p {
            word-break: break-all;
            line-height: 15px;
            font-size: 11px;
        } 

        #cuestionario_checkin .tabla_opciones tbody tr th p {
            font-weight: bold;
            text-shadow: 0.1px 0px #232020;
        }                

        /*
        #cuestionario_checkin .tabla_opciones tr:nth-child(even) {
            background-color: #d3d3d3;
        }

        #cuestionario_checkin .tabla_opciones tr:nth-child(odd) {
            background-color: #FFF;
        }
        */

        #cuestionario_checkin .list_opciones li {
            display: flex;
            width: 100%;
            align-items: center;
        }
        #cuestionario_checkin .list_opciones input[type=radio], #cuestionario_checkin .tabla_opciones input[type=radio] {
            display: none;
        }

        #cuestionario_checkin .list_opciones span, #cuestionario_checkin .tabla_opciones span {
            display: inline-block;
            width: 15px;
            font-size: 10px;
            font-weight: normal;
            text-align: center;
        }

        #cuestionario_checkin .list_opciones label, #cuestionario_checkin .tabla_opciones label {
            font-size: 10px;
            padding: 5px 3px;
            /*background: #ffffff;*/
            border: 3px solid transparent;
            display: inline-block;
            width: calc(100% - 15px);
            margin-bottom: 3px;
            text-align: center;
            font-weight: normal;
            /*cursor: pointer;*/
        }

        #cuestionario_checkin .tabla_opciones p {
            margin: 0;
            font-size: 10px;
            padding: 5px 3px;
            border: 3px solid transparent;
            font-weight: normal;          
        }

        #cuestionario_checkin .list_opciones .label-opcion, #cuestionario_checkin .tabla_opciones .label-opcion {
            cursor: pointer;
        }        

        #cuestionario_checkin .list_opciones input[type=radio]:checked ~ label {
            border: 3px solid #28b779;
        }     

        /*
        #cuestionario_checkin .tabla_opciones input[type=radio]:checked ~ .label-opcion {
            border: 3px solid #28b779;
        } 
        */
        

        .checked {
            background-color: #28b779;
            color: white;
        }       

        #cuestionario_checkin #opciones_orina label {
            height: 15px;
            margin-bottom: 5px;
        }
        .orina7 {
            background: #DE8D28 !important;
        }
        .orina6 {
            background: #F7871A !important;
        }
        .orina5 {
            background: #F6A817 !important;
        }
        .orina4 {
            background: #F6C92D !important;
        }
        .orina3 {
            background: #F5EB56 !important;
        }
        .orina2 {
            background: #F7F5B8 !important;
        }
        .orina1 {
            background: #FEFEFE !important;
        }
        #cuestionario_checkin .btn {
            display: inline-block;
            background: transparent;
            color: #28b779;
            outline: none;
            border-radius: 6px;
            border: 3px solid #28b779;
            padding: 9px 7px;
            min-width: 100px;
            text-align: center;
            cursor: pointer;
            font-size: 13px;
            margin-bottom: 15px;
            text-decoration: none;
            background: #ffffff;
        }
        .btn_rango {
            display: inline-block;
            background: transparent;
            color: #28b779;
            outline: none;
            border-radius: 6px;
            border: 3px solid #28b779;
            padding: 9px 7px;
            min-width: 100px;
            text-align: center;
            cursor: pointer;
            font-size: 13px;
            margin-bottom: 15px;
            text-decoration: none;
            background: #ffffff;
            font-weight: bold;
        }
        .btn_rango:hover{
            color: #0F9E60;
            border: 3px solid #0F9E60;
        }
        .btn_rango:active {
            color: #2de093;
            border-color: #2de093;
        }
        #cuestionario_checkin .btn:active {
            color: #2de093;
            border-color: #2de093;
        }
        /* =============== =============== */
        /* =============== =============== */
        #img-loader {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            
            display: inline-block;
            width: 100px;
            height: 60px;
            padding: 20px;
            background: rgba(0, 0, 0, 0.7);
            color: #ffffff;
            border-radius: 3px;
            text-align: center;
        }
        #img-loader i {
            font-size: 32px;
        }
        #img-loader p {
            margin: 5px;
            text-align: center;
        }
        @media (min-width: 700px) {
            #login-container {
                background-size: cover;
            }
            #login-container #form_container {
                min-height:400px;
                max-height:400px;
            }
        }
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
        /* ESTILOS TOOLTIPS */
        .tooltip-2{
            position: relative;
        }
        .tooltip-2 .contenedor-tooltip{
            color: #ffffff;
            display: none;
            background: #2C353E;
            padding: 10px;
            min-width: 150px;
            position:relative;
            z-index:9;
            transition: all ease .3s;
            border-radius: 7px;
        }
        .tooltip-2 .contenedor-tooltip::after {
            content: "";
            position: absolute;
            border-top: 10px solid;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 0px;
            left: 45%;
            bottom: -10px;
            transition: all ease .3s;
            border-top-color: #2C353E;
        }
        .tooltip-2 .contenedor-tooltip.show {
            display:inline;
            position:absolute;
            right: -83px;
            bottom: calc(100% + 10px);
            font-weight: normal;
            box-shadow: 0px 0px 5px #BABABA;
        }
        .tooltip-2 .contenedor-tooltip:hover {
            background: #37424D;
        }
        .tooltip-2 .contenedor-tooltip:hover::after {
            border-top-color: #37424D;
        }
        
        .img_btn {
            display: inline-block;
            padding: 15px 3px;
            border-radius: 5px;
            background: #28b77950;
        }
        .img_btn img {
            background: white;
            padding: 5px;
            border-radius: 5px;
            cursor: pointer;
        }
        .img_btn:active, .img_btn:hover {
            background: #28b779;
        }
        .img_btn img:hover {
            background: #ffffff80;
        }
        
        #vista_previa, #form_fechas {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            margin: auto;
            
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: auto;
            
            width: 75%;
            height: 60%;
            padding: 22px;
            background: rgba(0, 0, 0, 0.85);
            border-radius: 8px;
            color: white;
            z-index: 100;
        }
        #vista_previa .icon-remove, #form_fechas .icon-remove {
            position: absolute;
            top: 8px;
            right: 8px;
        }
        
        #form_fechas {
            height: 300px !important;
            padding: 22px;
            width: 80%;
            max-width: 389px;
            box-sizing: border-box;
        }
        
        #form_fechas label {
            color: white;
            display: inline-block;
            width: 100%;
            margin: 0px;
            padding: 2px 0px;
            font-size: 13px;
        }
        #form_fechas select, #form_fechas button {
            background: none;
            border: 2px solid white;
            border-radius: 3px;
            -moz-appearance: none;
            -webkit-appearance: none;
            color: white;
            width: 100%;
            padding: 3px;
            box-sizing: border-box;
        }
        #form_fechas select option {
            color: black;
        }
        #form_fechas button {
            width: auto;
        }
    </style>
    <style>
        .custom-range {
            width: 100%;
            height: 1.4rem;
            padding: 0;
            background-color: transparent;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
        }
        .custom-range:focus {
            outline: none;
        }
        .custom-range:focus::-webkit-slider-thumb {
            box-shadow: 0 0 0 1px #fff, 0 0 0 0.2rem rgba(40, 193, 121, 0.25);
        }
        .custom-range:focus::-moz-range-thumb {
            box-shadow: 0 0 0 1px #fff, 0 0 0 0.2rem rgba(40, 193, 121, 0.25);
        }
        .custom-range:focus::-ms-thumb {
            box-shadow: 0 0 0 1px #fff, 0 0 0 0.2rem rgba(40, 193, 121, 0.25);
        }
        .custom-range::-moz-focus-outer {
            border: 0;
        }
        .custom-range::-webkit-slider-thumb {
            width: 1rem;
            height: 1rem;
            margin-top: -0.25rem;
            border: 0;
            border-radius: 1rem;
            -webkit-transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            -webkit-appearance: none;
            appearance: none;
        }
        
        @media (prefers-reduced-motion: reduce) {
            .custom-range::-webkit-slider-thumb {
                -webkit-transition: none;
                transition: none;
            }
        }
        .custom-range::-webkit-slider-runnable-track {
            width: 100%;
            height: 0.5rem;
            color: transparent;
            cursor: pointer;
            background-color: #fff; /*barra*/
            border-color: transparent;
            border-radius: 1rem;
        }
        .custom-range::-moz-range-thumb {
            width: 1rem;
            height: 1rem;
            border: 0;
            border-radius: 1rem;
            -moz-transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            -moz-appearance: none;
            appearance: none;
        }
        @media (prefers-reduced-motion: reduce) {
            .custom-range::-moz-range-thumb {
                -moz-transition: none;
                transition: none;
            }
        }
        
        .custom-range::-moz-range-track {
            width: 100%;
            height: 0.5rem;
            color: transparent;
            cursor: pointer;
            background-color: #dee2e6;
            border-color: transparent;
            border-radius: 1rem;
        }
        .custom-range::-ms-thumb {
            width: 1rem;
            height: 1rem;
            margin-top: 0;
            margin-right: 0.2rem;
            margin-left: 0.2rem;
            background-color: #28b779;
            border: 0;
            border-radius: 1rem;
            -ms-transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
            appearance: none;
        }
        @media (prefers-reduced-motion: reduce) {
            .custom-range::-ms-thumb {
                -ms-transition: none;
                transition: none;
            }
        }
        .custom-range::-ms-thumb:active {
            background-color: #B3FFE3;
        }
        .custom-range::-ms-track {
            width: 100%;
            height: 0.5rem;
            color: transparent;
            cursor: pointer;
            background-color: transparent;
            border-color: transparent;
            border-width: 0.5rem;
        }
        .custom-range::-ms-fill-lower {
            background-color: #dee2e6;
            border-radius: 1rem;
        }
        .custom-range::-ms-fill-upper {
            margin-right: 15px;
            background-color: #dee2e6;
            border-radius: 1rem;
        }
        .custom-range:disabled::-webkit-slider-thumb {
            background-color: #ADBDB3;
        }
        .custom-range:disabled::-webkit-slider-runnable-track {
            cursor: default;
        }
        .custom-range:disabled::-moz-range-thumb {
            background-color: #ADBDB3;
        }
        .custom-range:disabled::-moz-range-track {
            cursor: default;
        }
        .custom-range:disabled::-ms-thumb {
            background-color: #ADBDB3;
        }

        .custom-range-c1::-webkit-slider-thumb {background-color: #7bb93e; /*centro*/ } 
        .custom-range-c1::-webkit-slider-thumb:active {background-color: #7bb93e; /*centro active*/ }
        .custom-range-c1::-moz-range-thumb:active {background-color: #7bb93e; /*centro active moz*/ }
        .custom-range-c1::-moz-range-thumb {background-color: #7bb93e; /*centro moz*/}

        .custom-range-c2::-webkit-slider-thumb {background-color: #82c341; /*centro*/ } 
        .custom-range-c2::-webkit-slider-thumb:active {background-color: #82c341; /*centro active*/ }
        .custom-range-c2::-moz-range-thumb:active {background-color: #82c341; /*centro active moz*/ }
        .custom-range-c2::-moz-range-thumb {background-color: #82c341; /*centro moz*/}

        .custom-range-c3::-webkit-slider-thumb {background-color: #8bc751; /*centro*/ } 
        .custom-range-c3::-webkit-slider-thumb:active {background-color: #8bc751; /*centro active*/ }
        .custom-range-c3::-moz-range-thumb:active {background-color: #8bc751; /*centro active moz*/ }
        .custom-range-c3::-moz-range-thumb {background-color: #8bc751; /*centro moz*/}

        .custom-range-c4::-webkit-slider-thumb {background-color: #a6ce39; /*centro*/ } 
        .custom-range-c4::-webkit-slider-thumb:active {background-color: #a6ce39; /*centro active*/ }
        .custom-range-c4::-moz-range-thumb:active {background-color: #a6ce39; /*centro active moz*/ }
        .custom-range-c4::-moz-range-thumb {background-color: #a6ce39; /*centro moz*/}

        .custom-range-c5::-webkit-slider-thumb {background-color: #ffcd05; /*centro*/ } 
        .custom-range-c5::-webkit-slider-thumb:active {background-color: #ffcd05; /*centro active*/ }
        .custom-range-c5::-moz-range-thumb:active {background-color: #ffcd05; /*centro active moz*/ }
        .custom-range-c5::-moz-range-thumb {background-color: #ffcd05; /*centro moz*/}

        .custom-range-c6::-webkit-slider-thumb {background-color: #fcb216; /*centro*/ } 
        .custom-range-c6::-webkit-slider-thumb:active {background-color: #fcb216; /*centro active*/ }
        .custom-range-c6::-moz-range-thumb:active {background-color: #fcb216; /*centro active moz*/ }
        .custom-range-c6::-moz-range-thumb {background-color: #fcb216; /*centro moz*/}

        .custom-range-c7::-webkit-slider-thumb {background-color: #f8981d; /*centro*/ } 
        .custom-range-c7::-webkit-slider-thumb:active {background-color: #f8981d; /*centro active*/ }
        .custom-range-c7::-moz-range-thumb:active {background-color: #f8981d; /*centro active moz*/ }
        .custom-range-c7::-moz-range-thumb {background-color: #f8981d; /*centro moz*/}

        .custom-range-c8::-webkit-slider-thumb {background-color: #f58120; /*centro*/ } 
        .custom-range-c8::-webkit-slider-thumb:active {background-color: #f58120; /*centro active*/ }
        .custom-range-c8::-moz-range-thumb:active {background-color: #f58120; /*centro active moz*/ }
        .custom-range-c8::-moz-range-thumb {background-color: #f58120; /*centro moz*/}

        .custom-range-c9::-webkit-slider-thumb {background-color: #f26a22; /*centro*/ } 
        .custom-range-c9::-webkit-slider-thumb:active {background-color: #f26a22; /*centro active*/ }
        .custom-range-c9::-moz-range-thumb:active {background-color: #f26a22; /*centro active moz*/ }
        .custom-range-c9::-moz-range-thumb {background-color: #f26a22; /*centro moz*/}

        .custom-range-c10::-webkit-slider-thumb {background-color: #da1a32; /*centro*/ } 
        .custom-range-c10::-webkit-slider-thumb:active {background-color: #da1a32; /*centro active*/ }
        .custom-range-c10::-moz-range-thumb:active {background-color: #da1a32; /*centro active moz*/ }
        .custom-range-c10::-moz-range-thumb {background-color: #da1a32; /*centro moz*/}
        
        /*PUSH BAR*/
        html.pushbar_locked {
            overflow: hidden;
            -ms-touch-action: none;
            touch-action: none;
        }

        .pushbar_locked .pushbar_main_content.pushbar_blur {
            filter: blur(15px);
        }

        .pushbar_overlay {
            z-index: -999;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            will-change: opacity;
            transition: opacity 0.5s ease;
            opacity: 0;
            background: #3c3442;
        }

        html.pushbar_locked .pushbar_overlay {
            opacity: 0.8;
            z-index: 999;
        }

        [data-pushbar-id] {
            z-index: 1000;
            position: fixed;
            overflow-y: auto;
            will-change: transform;
            transition: transform 0.5s ease;
            background: #fff;
        }

        [data-pushbar-direction="left"][data-pushbar-id], [data-pushbar-direction="right"][data-pushbar-id] {
            top: 0;
            width: 256px;
            max-width: 100%;
            height: 100%;
        }

        [data-pushbar-direction="top"][data-pushbar-id], [data-pushbar-direction="bottom"][data-pushbar-id] {
            left: 0;
            width: 100%;
            min-height: 150px;
        }

        [data-pushbar-direction="left"][data-pushbar-id] {
            left: 0;
            transform: translateZ(0) translateX(-100%);
        }

        [data-pushbar-direction="right"][data-pushbar-id] {
            right: 0;
            transform: translateZ(0) translateX(100%);
        }

        [data-pushbar-direction="top"][data-pushbar-id] {
            top: 0;
            transform: translateZ(0) translateY(-100%);
        }

        [data-pushbar-direction="bottom"][data-pushbar-id] {
            bottom: 0;
            transform: translateZ(0) translateY(100%);
        }

        [data-pushbar-id].opened {
            display: block;
            transform: translateX(0px) translateY(0px);
        }
        .pushbar{
          background-color: #000;
          color: #fff;
          padding:20px;
        }
        .pushbar .btn-cerrar{
          text-align: right;
        }
        .pushbar .btn-cerrar button{
          background: none;
          color: #808080;
          border:none;
          cursor: pointer;
          font-size: 20px;
        }
        .menu_lateral a{
          display: block;
          color: #fff;
          padding:20px 0;
          border-bottom: 1px solid #fff;
          font-family: helvetica;
          font-size: 18px;
          transition: 3s ease color;
          text-decoration: none;
        }
        .menu_lateral a:hover{
          color: #aaa;
        }
        .menu ul{
            list-style: none;
            padding: 0px;
        }
        .menu ul ul{
            display:none;
            list-style: none;
            padding-left: 30px;
            background: #0d0d0d;
        }
        .menu ul ul a{
            text-decoration:none;
        }
        .submenu span{
            float: right;
            margin-right: 8px;
        }

        .descripcion-item-text {
            word-break: break-all;
            line-height: 15px;
            font-weight: normal;
        }

        .ellipsis-text {
            text-overflow: ellipsis;
            overflow: hidden;
            white-space: nowrap;    
            margin-bottom: 0px;
            font-weight: bold;
        }

        .titulo-cuestionario {
            max-width: 600px;
            margin: auto;
            width: 100%;
            margin-top: 50px;
        }   

        .tabla_resultados_test {
            border-collapse: collapse;
            margin-bottom: 15px;
            max-width: 600px;
            width: 600px;
            font-size: 11px;
            background-color: white;
        }

        .celda-total {
            background-color: #ececec;
        }

        .tabla_resultados_test tr th {
            font-weight: normal;
            padding: 5px 0px;
            color: #4b4646;
        }

        .tabla_resultados_test tr td, .tabla_resultados_test tr th {
            border: 1px solid black;
        }   

        .tabla_resultados_test input {
            border: none;
            width: 45px;
            height: 50px;
            text-align: center;
        }     

        .container-responsive-table {
            overflow-x:auto;
        }

        .titulo-cuestionario p {
            margin: 0;
            margin-bottom: 7px;
        }

        .small-text {
            font-size: 11px;
            line-height: 16px;
        } 

        .big-text {
            font-size: 20px;
            text-transform: uppercase;
        }                

        .titulo-tabla-resultado {
            text-align: center;
            text-transform: uppercase;
            background-color: black;
            color: white;
        }

        .titulo-tabla-resultado div {
            width: 121px;
            font-size: 15px;
            position: relative;
            top: -25px;
        }

        .img-resultado-test {
            width: 125px;
            height: 100px;
        }

        .div-resultado-test {
            width: 30%;
            padding: 7px;
            border: 1px dashed #6c6969;
            position: relative;
        }

        .text-center {
            text-align: center;
        }
        
        .text-left {
            text-align: left;
        }
        
        .text-right {
            text-align: right;
        }

        .text-bold {
            font-weight: bold;
            text-shadow: 0.1px 0px #232020;
        }

        .big-text-resultado-test {
            font-size: 20px;
            margin: 5px 0px 20px 0px;
            font-stretch: condensed;
            transform: scaleX(1.15);
            word-spacing: 4px;
            text-shadow: 0.1px 0px #232020;
            letter-spacing: 0.2px;
            word-break: break-all;
        }

        .normal-text-resultado-test-nosacle {
            font-size: 11px;
        }

        .normal-text-resultado-test {
            font-size: 9px;
            letter-spacing: 0px;
            font-stretch: condensed;
            transform: scaleX(0.96);
            word-spacing: 4px;
            line-height: 11px;
            position: relative;
        }

        /* unvisited link */
        a.a-colectivo-cinetica:link {
          color: black;
        }

        /* visited link */
        a.a-colectivo-cinetica:visited {
          color: black;
        }

        /* mouse over link */
        a.a-colectivo-cinetica:hover {
          color: black;
        }

        /* selected link */
        a.a-colectivo-cinetica:active {
          color: black;
        }

        .td-descripcion-item {
            max-width: 465px;
            width: 465px;
        }

        .div-img-resultado-test {
            position: absolute;
            bottom: 0;
            left: 9%;
        }

        .break-div-result-test {
            height: 95px;
        }

        /* If in mobile screen with maximum width 479px. The iPhone screen resolution is 320x480 px (except iPhone4, 640x960) */    
        @media only screen and (max-width: 479px){
            .div-responsive { width: 90%; }
            .img-resultado-test { width: 80px; }
            .div-img-resultado-test {
                position: absolute;
                bottom: 0;
                left: 5%;
            }            
        }        

        @media screen and (max-width: 402px) {
            .img-resultado-test { width: 80px;  }
            .div-img-resultado-test {
                position: absolute;
                bottom: 0;
                /*left: 5%;*/
            }            
        }      

        @media screen and (max-width: 540px) {
            .img-resultado-test { width: 65px;  }
            .div-img-resultado-test {
                position: absolute;
                bottom: 0;
                /*left: -5%;*/
            }            


            .tabla_resultados_test {
                border-collapse: collapse;
                margin-bottom: 15px;
                width: 366px;
                font-size: 7px;
                background-color: white;
            }            
            .titulo-tabla-resultado div {
                width: 50px;
                font-size: 12px;
                position: relative;
                top: -25px;
            }


            .tabla_resultados_test input {
                border: none;
                width: 20px;
                height: 50px;
                text-align: center;
            }

        }                

        /* --------------------------------------- */
        @media screen and (max-width: 600px) {

            .tabla_resultados_test {
                border-collapse: collapse;
                margin-bottom: 15px;
                width: 245px;
                font-size: 11px;
                background-color: white;
            }            
            .titulo-tabla-resultado div {
                width: 70px;
                font-size: 10px;
                position: relative;
                top: -25px;
            }


            .tabla_resultados_test input {
                border: none;
                width: 42px;
                height: 50px;
                text-align: center;
            }

        }     

        /* --------------------------------------- */
        @media screen and (max-width: 550px) {

            .tabla_resultados_test {
                border-collapse: collapse;
                margin-bottom: 15px;
                width: 245px;
                font-size: 11px;
                background-color: white;
            }            
            .titulo-tabla-resultado div {
                width: 70px;
                font-size: 10px;
                position: relative;
                top: -25px;
            }


            .tabla_resultados_test input {
                border: none;
                width: 39px;
                height: 50px;
                text-align: center;
            }

        }  

        /* --------------------------------------- */
        @media screen and (max-width: 520px) {

            .tabla_resultados_test {
                border-collapse: collapse;
                margin-bottom: 15px;
                width: 245px;
                font-size: 11px;
                background-color: white;
            }            
            .titulo-tabla-resultado div {
                width: 70px;
                font-size: 10px;
                position: relative;
                top: -25px;
            }


            .tabla_resultados_test input {
                border: none;
                width: 30px;
                height: 50px;
                text-align: center;
            }

        }          

        /* --------------------------------------- */
        @media screen and (max-width: 380px) {

            .tabla_resultados_test {
                border-collapse: collapse;
                margin-bottom: 15px;
                width: 245px;
                font-size: 11px;
                background-color: white;
            }            
            .titulo-tabla-resultado div {
                width: 70px;
                font-size: 10px;
                position: relative;
                top: -25px;
            }


            .tabla_resultados_test input {
                border: none;
                width: 13px;
                height: 50px;
                text-align: center;
            }

        }                       


        /* --------------------------------------- */
        @media screen and (max-width: 300px) {

            .tabla_resultados_test {
                border-collapse: collapse;
                margin-bottom: 15px;
                width: 245px;
                font-size: 11px;
                background-color: white;
            }            
            .titulo-tabla-resultado div {
                width: 48px;
                font-size: 10px;
                position: relative;
                top: -25px;
            }


            .tabla_resultados_test input {
                border: none;
                width: 12px;
                height: 50px;
                text-align: center;
            }

        }      

        /* --------------------------------------- */
        @media screen and (max-width: 230px) {

            .tabla_resultados_test {
                border-collapse: collapse;
                margin-bottom: 15px;
                width: 100px;
                font-size: 11px;
                background-color: white;
            }            
            .titulo-tabla-resultado div {
                width: 10px;
                font-size: 6px;
                position: relative;
                top: -25px;
                word-break: break-all;
            }


            .tabla_resultados_test input {
                border: none;
                width: 12px;
                height: 50px;
                text-align: center;
            }

        }                        

        textarea {
            border: none;
            resize: none;
            width: 97%;
            height: 100%;
            background-color: transparent;
            font-size: 11px;
        }

        .p-td-frecuencia {
            text-align: center;
            width: 70px;
            text-shadow: 0.1px 0px #232020;
            position: relative;
            top: -5px;
        }

        .celda-input-radio, .celda-input-radio-t5 {
            cursor: pointer;
        }

        .t2, .t3 {
            text-align: center;
        }

        .t1, .t4 {
            text-align: left;
        }

        .text-cabecera {
            color: white;
            /*text-shadow: 2px 1px 1px grey;*/
            text-shadow: -0.5px 0px 1px grey, 1px 1px 0px grey;           
            margin: 0;
            font-size: 19px;
        }

        .titulo-club {
            text-transform: uppercase;
            letter-spacing: 0px;
            font-stretch: condensed;
            transform: scaleY(1.3);
            word-spacing: 4px;            
            font-size: 10px;
        }

    </style>
</head>
<body>
    <div id="login-container">
        <div id="form_container">
            <h4>Cuestionarios</h4>
            <h4>Check in – Check Out</h4>
            
            <div id="contenedor_logo">
                <img id="img-equipo" src="../images/img-equipo.png">
            </div>
            
            <form id="form_login" name="form_login">
                <div style="position: relative;">
                    <i class="icon-user icon"></i>
                    <input type="text" name="usuario" id="usuario" value="12345678-9" placeholder="12345678-1">
                </div>
            
                <div style="position: relative;">
                    <i class="icon-key icon"></i>
                    <input type="password" name="contrasena" id="contrasena" value="1234" placeholder="CONTRASEÑA">
                </div>
                
                <div id="error_inicio" style="display: none;">
                    <p>Usuario y/o contraseña incorrecta</p>
                </div>
                
                <div class="btn-center">
                    <button type="button" id="iniciar-sesion">ENTRAR</button>
                </div>
            </form>
        </div>
    </div>
    
    <div id="app-container">
        <div id="header_1" style="position: fixed;width: 100%;z-index:99;">
            <div id="header_perfil">
                <button id="btn-menu" data-pushbar-target="menu_lateral"><i class="icon-ellipsis-vertical"></i> </button>
                <span>Mi perfil de usuario (Software)</span>
            </div>
        </div>
        
        <h5 id="titulo_perfil"><i class="icon-user"></i> Mi perfil de usuario</h5>

        <div class="img-jugador">
            <img src="../images/img-jugador.png">
        </div>
    
        <div class="contenedor-centro" style="margin-bottom: 20px;">
            <div class="contenedor_input">
                <a>Nombre</a>
                <input type="text" id="nombre" readonly>
            </div>
            <div class="contenedor_input">
                <a>Apellido 1</a>
                <input type="text" id="apellido1" readonly>
            </div>
            <div class="contenedor_input">
                <a>Apellido 2</a>
                <input type="text" id="apellido2" readonly>
            </div>
            <div class="contenedor_input">
                <a>Usuario</a>
                <input type="text" id="usuario_2" readonly>
            </div>
        </div>
        
        <!--
        <div class="contenedor-centro" style="display: flex; justify-content-between">
            <div id="contenedor_p_documentos" style="width: 50%;"></div>
            <div id="contenedor_c_documentos" style="width: 50%;"></div>
        </div>
        -->
        
        <span class="descripcion_formulario">Selecciona el cuestionario a contestar</span>
        
        <div class="contenedor-centro">
            <button type="button" id="btn-cuestionario_checkin" class="btn check-in">Check In</button>
            <button type="button" id="btn-cuestionario_checkout" class="btn check-out">Check Out</button>
        </div>
    </div>
    
    <div id="cuestionario_checkin">
        <div id="header_2" style="position: fixed;width: 100%;z-index:99;">
            <div id="header_cuestionario">
                <button type="button" id="btn-volver-perfil"><i class="icon-arrow-left"></i></button>
                <span>CUESTIONARIO CHECK IN</span>
            </div>
        </div>

        <form name="cuestionario_checkin_form" style="margin-top: 35px;">

            <div style="width: 100%; margin-bottom: 100px;">
                <div>
                    <div style="float: right; margin-left: 10px; position: relative; top: 13px;">
                        <p class="text-cabecera">Fútbol</p>
                        <p class="text-cabecera">Formativo</p>
                        <p class="text-cabecera titulo-club" style="/*text-shadow: 1px 1px 1px grey;*/">Club Universidad de Chile</p>
                    </div>                
                    <div style=" width: 37px; height: 38px; background-color: #021965; padding: 20px; float: right; border-radius: 30px 0px 30px 30px; box-shadow: 0 0 1px 1px grey; border: 2px solid white;">
                        <img src="../config/logo_equipo.png" style="top: -10px;position: relative;height: 60px;">
                    </div>                    
                </div>
            </div>

            <div class="titulo-cuestionario div-responsive" style="overflow: hidden;">
                <div>
                    <p class="small-text">Estimado jugador y jugadora, a través de este cuestionario el Club Deportivo Universidad de Chile busca conocer más sobre lo que sienten y piensan todos los jugadores que forman parte del Fútbol Joven de la institución y de esa forma seguir mejorando en nuestra labor. De este modo, no existen respuestas correctas ni erradas pues lo importante es conocer sus opiniones.</p>

                    <p class="small-text">Asimismo, los datos que se obtendrán de este instrumento son absolutamente <span style="color: #021965; font-weight: bold; text-decoration: underline; text-shadow: 0.1px 0px #232020;">confidenciales</span> y sólo se usarán para la elaboración de estadísticas generales.</p>

                    <p class="small-text text-bold">Muchas Gracias por tu tiempo.</p>
                </div>    
            </div>

            <div style="margin-top: 30px;" class="container-responsive-table">
                
                <!-- ========================================================================================================= -->

                <!-- ================================================================================ INICIO DE LA TABLA 1 ================================================================================ -->
                <table class="tabla_opciones t1">
                    <tbody>
                        <tr>
                            <th><p style="text-align: left;">¿Qué año llegaste a la U?</p></th>
                            <td colspan="2"><textarea></textarea></td>
                        </tr>    
                        <tr>
                            <th><p style="text-align: left;">¿En qué ciudad vivías antes de llegar a la U?</p></th>
                            <td colspan="2"><textarea></textarea></td>
                        </tr>    
                        <tr>
                            <th><p style="text-align: left;">¿Eres parte del?</p></th>
                            <td>
                                <input type="radio" name="t1_1" id="t1_1_1" value="1">
                                <label for="t1_1_1" class="label-opcion" style="font-size: 11px; text-align: left;">Fútbol Formativo Masculino</label>
                            </td>
                            <td>
                                <input type="radio" name="t1_1" id="t1_1_2" value="2">
                                <label for="t1_1_2" class="label-opcion" style="font-size: 11px; text-align: left;">Fútbol Formativo Femenino</label>
                            </td>
                        </tr>                                                                        
                    </tbody>
                </table>
                <!-- ================================================================================ FIN DE LA TABLA 1 ================================================================================ -->

                <!-- ========================================================================================================= -->
                <!-- ================================================================================ INICIO DE LA TABLA 2 ================================================================================ -->
                <table class="tabla_opciones t2">
                    <tbody>
                        <tr>
                            <th></th>
                            <th><p class="p-td-frecuencia">Nunca</p></th>
                            <th><p class="p-td-frecuencia">Casi nunca</p></th>
                            <th><p class="p-td-frecuencia">A veces</p></th>
                            <th><p class="p-td-frecuencia">Casi siempre</p></th>
                            <th><p class="p-td-frecuencia">Siempre</p></th>
                        </tr>    
                        <tr>
                            <th><p>¿Tus padres o hermanos suelen jugar Fútbol de manera recreativa?</p></th>
                            <td class="celda-input-radio"><input type="radio" name="t2_1" id="t2_1_1" value="1"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_1" id="t2_1_2" value="2"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_1" id="t2_1_3" value="3"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_1" id="t2_1_4" value="4"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_1" id="t2_1_5" value="5"></td>
                        </tr>  
                        <tr>
                            <th><p>¿Las personas con las que vives suelen ver los partidos de la selección chilena?</p></th>
                            <td class="celda-input-radio"><input type="radio" name="t2_2" id="t2_2_1" value="1"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_2" id="t2_2_2" value="2"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_2" id="t2_2_3" value="3"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_2" id="t2_2_4" value="4"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_2" id="t2_2_5" value="5"></td>
                        </tr>  
                        <tr>
                            <th><p>¿Las personas con las que vives suelen ver partidos de diferentes selecciones o equipo del mundo?</p></th>
                            <td class="celda-input-radio"><input type="radio" name="t2_3" id="t2_3_1" value="1"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_3" id="t2_3_2" value="2"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_3" id="t2_3_3" value="3"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_3" id="t2_3_4" value="4"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_3" id="t2_3_5" value="5"></td>
                        </tr>   
                        <tr>
                            <th><p>¿Las personas con las que vives suelen ver los partidos de la U?</p></th>
                            <td class="celda-input-radio"><input type="radio" name="t2_4" id="t2_4_1" value="1"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_4" id="t2_4_2" value="2"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_4" id="t2_4_3" value="3"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_4" id="t2_4_4" value="4"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_4" id="t2_4_5" value="5"></td>
                        </tr>
                        <tr>
                            <th><p>¿Las personas con las que vives suelen ir al estadio a ver jugar a la U?</p></th>
                            <td class="celda-input-radio"><input type="radio" name="t2_5" id="t2_5_1" value="1"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_5" id="t2_5_2" value="2"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_5" id="t2_5_3" value="3"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_5" id="t2_5_4" value="4"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_5" id="t2_5_5" value="5"></td>
                        </tr>  
                        <tr>
                            <th><p>¿Las personas con las que vives, suelen conversar de fútbol?</p></th>
                            <td class="celda-input-radio"><input type="radio" name="t2_6" id="t2_6_1" value="1"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_6" id="t2_6_2" value="2"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_6" id="t2_6_3" value="3"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_6" id="t2_6_4" value="4"></td>
                            <td class="celda-input-radio"><input type="radio" name="t2_6" id="t2_6_5" value="5"></td>
                        </tr>                             
                    </tbody>
                </table>                
                <!-- ================================================================================ FIN DE LA TABLA 2 ================================================================================ -->


                <!-- ========================================================================================================= -->
                <!-- ================================================================================ INICIO DE LA TABLA 3 ================================================================================ -->
                <table class="tabla_opciones t2">
                    <tbody> 
                        <tr>
                            <th></th>
                            <th><p class="p-td-frecuencia">Nunca</p></th>
                            <th><p class="p-td-frecuencia">Casi nunca</p></th>
                            <th><p class="p-td-frecuencia">A veces</p></th>
                            <th><p class="p-td-frecuencia">Casi siempre</p></th>
                            <th><p class="p-td-frecuencia">Siempre</p></th>
                        </tr>    
                        <tr>
                            <th><p>¿Sueles ver los partidos del Campeonato Nacional?</p></th>
                            <td class="celda-input-radio"><input type="radio" name="t3_1" id="t3_1_1" value="1"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_1" id="t3_1_2" value="2"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_1" id="t3_1_3" value="3"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_1" id="t3_1_4" value="4"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_1" id="t3_1_5" value="5"></td>
                        </tr>  
                        <tr>
                            <th><p>¿Sueles ver los partidos de la Champions League o de la Europe League?</p></th>
                            <td class="celda-input-radio"><input type="radio" name="t3_2" id="t3_2_1" value="1"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_2" id="t3_2_2" value="2"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_2" id="t3_2_3" value="3"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_2" id="t3_2_4" value="4"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_2" id="t3_2_5" value="5"></td>
                        </tr>  
                        <tr>
                            <th><p>¿Sueles ver los partidos de la Copa Libertadores o la Copa Sudamericana?</p></th>
                            <td class="celda-input-radio"><input type="radio" name="t3_3" id="t3_3_1" value="1"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_3" id="t3_3_2" value="2"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_3" id="t3_3_3" value="3"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_3" id="t3_3_4" value="4"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_3" id="t3_3_5" value="5"></td>
                        </tr>   
                        <tr>
                            <th><p>¿Sueles ver los partidos de la U?</p></th>
                            <td class="celda-input-radio"><input type="radio" name="t3_4" id="t3_4_1" value="1"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_4" id="t3_4_2" value="2"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_4" id="t3_4_3" value="3"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_4" id="t3_4_4" value="4"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_4" id="t3_4_5" value="5"></td>
                        </tr>
                        <tr>
                            <th><p>¿Sueles ir al estadio a ver jugar a la U?</p></th>
                            <td class="celda-input-radio"><input type="radio" name="t3_5" id="t3_5_1" value="1"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_5" id="t3_5_2" value="2"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_5" id="t3_5_3" value="3"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_5" id="t3_5_4" value="4"></td>
                            <td class="celda-input-radio"><input type="radio" name="t3_5" id="t3_5_5" value="5"></td>
                        </tr>     
                    </tbody>
                </table>                
                <!-- ================================================================================ FIN DE LA TABLA 3 ================================================================================ -->

                <!-- ========================================================================================================= -->
                <!-- ================================================================================ INICIO DE LA TABLA 4 ================================================================================ -->
                <table class="tabla_opciones t3">
                    <tbody>
                        <tr>
                            <th style="width: 120px;"><p>¿Cuál fue tu principal motivación para convertirte en jugador(a)de la U?</p></th>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_1" id="t4_1_1" value="1">
                                <p>Todos o casi todos en mi familia son hinchas de la U </p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_1" id="t4_1_2" value="2">
                                <p>La U es el mejor equipo para formarme y llegar a convertirme en futbolista profesional</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_1" id="t4_1_3" value="3">
                                <p>Soy hincha de la U desde pequeño(a) y mi sueño siempre ha sido ser jugador(a) de la U</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_1" id="t4_1_4" value="4">
                                <p>Mi gran sueño es convertirme en jugador(a) de fútbol profesional sin importar el equipo donde juegue</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_1" id="t4_1_5" value="5">
                                <p>Jugar en la U me permite viajar y conocer muchos lugares</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_1" id="t4_1_6" value="6">
                                <p>Jugar en la U me puede ayudar a obtener una beca para estudiar en la universidad</p>
                            </td>                            
                        </tr>
                        <!-- ========================================================================================================= -->   
                        <tr>
                            <th><p>¿Cuáles son tus expectativas en el Fútbol?</p></th>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_2" id="t4_2_1" value="1">
                                <p>Convertirme en jugador de fútbol profesional</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_2" id="t4_2_2" value="2">
                                <p>Convertirme en jugador del primer equipo de la U</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_2" id="t4_2_3" value="3">
                                <p>Jugar en la selección chilena</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_2" id="t4_2_4" value="4">
                                <p>Jugar en algún equipo grande de Europa</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_2" id="t4_2_5" value="5">
                                <p>Viajar y conocer muchos lugares a través del fútbol.</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_2" id="t4_2_6" value="6">
                                <p>Conocer a muchas personas a través del fútbol</p>
                            </td>                            
                        </tr>
                        <!-- ========================================================================================================= -->   
                        <tr>
                            <th><p>¿Cuáles son tus expectativas en la U?</p></th>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_3" id="t4_3_1" value="1">
                                <p>Debutar en el primer equipo.</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_3" id="t4_3_2" value="2">
                                <p>Jugar por muchos años, salir campeón con la U y ser transferido(a) a un equipo extranjero importante</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_3" id="t4_3_3" value="3">
                                <p>Jugar una temporada a gran nivel y ser transferido(a) a un equipo grande de Europa</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_3" id="t4_3_4" value="4">
                                <p>Convertirme en un referente para los jugadores más jóvenes del fútbol formativo.</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_3" id="t4_3_5" value="5">
                                <p>Jugar durante toda mi carrera en la U y convertirme en un ídolo(a) del club. </p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_3" id="t4_3_6" value="6">
                                <p>Llegar a la categoría Juvenil y luego dedicarme a estudiar.</p>
                            </td>                            
                        </tr>
                        <!-- ========================================================================================================= -->
                        <tr>
                            <th><p>¿Jugarías por algún otro equipo en Chile que no fuera la U?</p></th>
                            <td class="celda-input-radio" colspan="3">
                                <input type="radio" name="t4_4" id="t4_4_1" value="1">
                                <p style="text-align: left;">Sí</p>
                            </td>
                            <td class="celda-input-radio" colspan="3">
                                <input type="radio" name="t4_4" id="t4_4_2" value="2">
                                <p style="text-align: left;">No</p>
                            </td>                        
                        </tr>
                        <!-- ========================================================================================================= -->
                        <tr>
                            <th><p>¿Jugarías por la UC o por Colo Colo?</p></th>
                            <td class="celda-input-radio" colspan="3">
                                <input type="radio" name="t4_5" id="t4_5_1" value="1">
                                <p style="text-align: left;">Sí</p>
                            </td>
                            <td class="celda-input-radio" colspan="3">
                                <input type="radio" name="t4_5" id="t4_5_2" value="2">
                                <p style="text-align: left;">No</p>
                            </td>                        
                        </tr>
                        <!-- ========================================================================================================= -->
                        <tr>
                            <th><p>¿Cuál de las siguientes cualidades crees que es la que mejor caracteriza el estilo de juego de la U?</p></th>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_6" id="t4_1" value="1">
                                <p>Es un equipo organizado</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_6" id="t4_2" value="2">
                                <p>Es un equipo que siempre juega al ataque</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_6" id="t4_3" value="3">
                                <p>Es un equipo luchador</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_6" id="t4_4" value="4">
                                <p>Es un equipo que nunca se rinde</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_6" id="t4_5" value="5">
                                <p>Es un equipo que siempre juega de manera vistosa</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_6" id="t4_6" value="6">
                                <p>Es un equipo que se defiende muy bien</p>
                            </td>                            
                        </tr>
                        <!-- ========================================================================================================= -->
                        <tr>
                            <th><p>¿Cuál es la cualidad principal del jugador del primer equipo de la U? </p></th>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_7" id="t4_7_1" value="1">
                                <p>Disciplinado</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_7" id="t4_7_2" value="2">
                                <p>Perseverante</p>
                            </td>
                            <td style="width: 90px;" class="celda-input-radio">
                                <input type="radio" name="t4_7" id="t4_7_3" value="3">
                                <p>Comprometido</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_7" id="t4_7_4" value="4">
                                <p>Valiente</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_7" id="t4_7_5" value="5">
                                <p>Inteligente</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_7" id="t4_7_6" value="6">
                                <p>Competitivo</p>
                            </td>                            
                        </tr>
                        <!-- ========================================================================================================= -->
                       <tr>
                            <th><p>¿Cuál de los siguientes valores es el que caracteriza más a la U?</p></th>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_8" id="t4_8_1" value="1">
                                <p>Compañerismo</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_8" id="t4_8_2" value="2">
                                <p>Competitividad</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_8" id="t4_8_3" value="3">
                                <p>Solidaridad</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_8" id="t4_8_4" value="4">
                                <p>Respeto</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_8" id="t4_8_5" value="5">
                                <p>Responsabilidad</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_8" id="t4_8_6" value="6">
                                <p>Valentía</p>
                            </td>                            
                        </tr>
                        <!-- ========================================================================================================= -->
                        <tr>
                            <th><p>¿Qué significa para ti ser jugador de la u?</p></th>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_9" id="t4_9_1" value="1">
                                <p>Responsabilidad</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_9" id="t4_9_2" value="2">
                                <p>Orgullo</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_9" id="t4_9_3" value="3">
                                <p>Compromiso</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_9" id="t4_9_4" value="4">
                                <p>Alegría</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_9" id="t4_9_5" value="5">
                                <p>Preocupación</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_9" id="t4_9_6" value="6">
                                <p>Diversión</p>
                            </td>                            
                        </tr>
                        <!-- ========================================================================================================= -->
                        <tr>
                            <th><p>¿Qué es lo que te gusta de la U como equipo?</p></th>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_10" id="t4_10_1" value="1">
                                <p>Su historia y tradición</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_10" id="t4_10_2" value="2">
                                <p>Su Hinchada</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_10" id="t4_10_3" value="3">
                                <p>Haber Ganado la Copa Sudamericana 2011 invictos</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_10" id="t4_10_4" value="4">
                                <p>Haber Ganado muchos torneos nacionales</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_10" id="t4_10_5" value="5">
                                <p>Sus jugadores históricos</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_10" id="t4_10_6" value="6">
                                <p>Que siempre se ha luchado y se ha recuperado ante la adversidad</p>
                            </td>                            
                        </tr>
                        <!-- ========================================================================================================= -->
                        <tr>
                            <th><p>¿Qué es lo que más te gusta de venir a entrenar al CDA?</p></th>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_11" id="t4_11_1" value="1">
                                <p>Tener atención del área médica ante cualquier molestia física</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_11" id="t4_11_2" value="2">
                                <p>Compartir con los jugadores de todas las categorías del fútbol formativo</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_11" id="t4_11_3" value="3">
                                <p>Tener ropa y todos los implementos necesarios para entrenar </p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_11" id="t4_11_4" value="4">
                                <p>Las canchas y camarines</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_11" id="t4_11_5" value="5">
                                <p>Entrenar con mis compañeros</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t4_11" id="t4_11_6" value="6">
                                <p>Aprender de cada una de las personas que trabajan en el CDA</p>
                            </td>                            
                        </tr>
                        <!-- ========================================================================================================= -->
                        <tr>
                            <th><p>¿Qué esperas del la U?</p></th>
                            <td colspan="6"><textarea></textarea></td>                            
                        </tr>
                        <!-- ========================================================================================================= -->
                        <tr>
                            <th><p>¿Cuál es tu principal virtud como jugador(a) de fútbol?</p></th>
                            <td colspan="6"><textarea></textarea></td>                               
                        </tr>
                        <!-- ========================================================================================================= -->
                    </tbody>
                </table>                
                <!-- ========================================================================================================= -->
                <!-- ================================================================================ FIN DE LA TABLA 4 ================================================================================ -->

                <!-- ========================================================================================================= -->
                <!-- ================================================================================ INICIO DE LA TABLA 5 ================================================================================ -->
                <table class="tabla_opciones t4">
                    <tbody>
                        <!-- ========================================================================================================= -->
                        <tr>
                            <th style="width: 150px;"><p>¿En qué medio de transporte vienes a entrenar habitualmente al CDA?</p></th>
                            <td class="celda-input-radio" style="width: 76px;">
                                <input type="radio" name="t5_1" id="t5_1_1" value="1">
                                <p>En auto</p>
                            </td>
                            <td class="celda-input-radio" style="width: 100px;">
                                <input type="radio" name="t5_1" id="t5_1_2" value="2">
                                <p>En micro, metro y/ o movilización colectiva</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t5_1" id="t5_1_3" value="3">
                                <p style="width: 80px;">En Uber, Cabify, DIDI, Beat u otra aplicación de transporte</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t5_1" id="t5_1_4" value="4">
                                <p style="width: 60px;">En Bicicleta</p>
                            </td>
                            <td class="celda-input-radio">
                                <input type="radio" name="t5_1" id="t5_1_5" value="5">
                                <p style="width: 100px;">Me vengo caminando porque vivo muy cerca</p>
                            </td>
                            <td class="celda-input-radio" style="width: 50px;">
                                <input type="radio" name="t5_1" id="t5_1_6" value="6">
                                <p>Otro ¿Cuál?......</p>
                            </td>                            
                        </tr>
                        <!-- ========================================================================================================= -->
                        <tr>                            
                            <th rowspan="2"><p>¿Cuánto tiempo demoras en el trayecto entre el CDA y tu hogar?</p></th>
                            <td class="celda-input-radio-t5">
                                <input type="radio" name="t5_2" id="t5_2_1" value="1">
                                <p>Menos de 10 minutos</p>
                            </td>
                            <td class="celda-input-radio-t5">
                                <input type="radio" name="t5_2" id="t5_2_2" value="2">
                                <p>Entre 11 y 20 minutos</p>
                            </td>
                            <td class="celda-input-radio-t5">
                                <input type="radio" name="t5_2" id="t5_2_3" value="3">
                                <p>Entre 21 y 30 minutos</p>
                            </td>
                            <td class="celda-input-radio-t5">
                                <input type="radio" name="t5_2" id="t5_2_4" value="4">
                                <p>Entre 31 y 40 minutos</p>
                            </td>
                            <td class="celda-input-radio-t5">
                                <input type="radio" name="t5_2" id="t5_2_5" value="5">
                                <p>Entre 41 y 50 minutos</p>
                            </td>
                            <td class="celda-input-radio-t5">
                                <input type="radio" name="t5_2" id="t5_2_6" value="6">
                                <p>Entre 51 y 60 minutos.</p>
                            </td>                            
                        </tr>
                        <!-- ========================================================================================================= -->
                        <tr>                            
                            <td class="celda-input-radio-t5">
                                <input type="radio" name="t5_2" id="t5_2_7" value="7">
                                <p>Entre 71 y 80 minutos</p>
                            </td>
                            <td class="celda-input-radio-t5">
                                <input type="radio" name="t5_2" id="t5_2_8" value="8">
                                <p>Entre 81 y 90 minutos</p>
                            </td>
                            <td class="celda-input-radio-t5">
                                <input type="radio" name="t5_2" id="t5_2_9" value="9">
                                <p>Entre 91 y 100 minutos</p>
                            </td>
                            <td class="celda-input-radio-t5">
                                <input type="radio" name="t5_2" id="t5_2_10" value="10">
                                <p>Entre 101 y 110 minutos</p>
                            </td>
                            <td class="celda-input-radio-t5">
                                <input type="radio" name="t5_2" id="t5_2_11" value="11">
                                <p>Entre 111 y 120 minutos</p>
                            </td>
                            <td class="celda-input-radio-t5">
                                <input type="radio" name="t5_2" id="t5_2_12" value="12">
                                <p>Más de 120 minutos</p>
                            </td>                            
                        </tr>
                        <!-- ========================================================================================================= -->                                                
                    </tbody>
                </table>
                <!-- ================================================================================ FIN DE LA TABLA 5 ================================================================================ -->

            </div>        

            <div class="btn-center">
                <button type="button" id="btn-enviar-cuestionario-checkin" class="btn">Enviar cuestionario</button>
            </div>
        </form>
    </div>
    
    <div data-pushbar-id="menu_lateral" data-pushbar-direction="left" class="menu_lateral pushbar">
          <div class="btn-cerrar">
            <button data-pushbar-close><i class="icon-remove"></i></button>
          </div>

          <nav class="menu">
            <ul>
                <li><a href="#">Inicio</a></li>
                <li class="submenu"><a href="#">Cuestionario <span><i class="icon-chevron-down"></i></span></a>
                
                <ul>
                    <li><a href="cuestionario_movil_representacion.php">Representación</a></li>
                    <li><a href="cuestionario_movil_udc.php">UDC</a></li>
                </ul>
                    
                </li>
                <li><a href="#">Perfil</a></li>
                <li><a href="#">Otros</a></li>
            </ul>
          </nav>

      </div>
    
    <div id="vista_previa" style="display: none;">
        <i class="icon-remove" onclick="cerrarVistaPrevia();"></i>
        
        <div id="i_vista_previa">
            <!-- JAVASCRIPT -->
        </div>
        
        <p style="text-align: center;position: absolute; bottom: 0px;margin: 5px 0px; font-size: 12px;"><b><i class="icon-calendar"></i> Vencimiento: <span id="vista_fv"></span></b></p>
    </div>
    
    <div id="form_fechas" style="display: none;">
        <div>
            <p id="titulo_modal" style="text-align: center; color: white; margin-bottom: 5px;"></p>
            <p style="text-align: center; color: white;"><b>Fecha vencimiento</b></p>
            
            <label> Año</label>
            <select id="anio_vencimiento" class="vencimiento" style="margin-bottom: 5px;" onchange="cargarDias();">
                <option value="">Elija el año</option>
                <?php for ($var = $anio_a; $var < ($anio_a + 5); $var++) { ?>
                    <option value="<?php echo $var; ?>"><?php echo $var; ?></option>
                <?php } ?>
            </select>
            
            <label> Mes</label>
            <select id="mes_vencimiento" class="vencimiento" style="margin-bottom: 5px;" onchange="cargarDias();">
                <option value="">Elija el mes</option>
                <?php for ($var = 1; $var < count($meses); $var++) { $new_var = $var; if ($new_var < 10) { $new_var = '0'.$new_var; }  ?>
                    <option value="<?php echo $new_var; ?>"><?php echo $meses[$var]; ?></option>
                <?php } ?>
            </select>
            
            <label> Dia</label>
            <select id="dia_vencimiento" class="vencimiento" style="margin-bottom: 5px;">
            </select>
            
            <div style="text-align: center; margin-top: 8px;">
                <button type="button" onclick="guardarFechaV();"><i class="icon-donwload-alt"></i> Guardar</button>
            </div>
        </div>
    </div>
    
    <div id="img-loader" style="display: none; z-index: 102;">
        <!-- JAVASCRIPT -->
    </div>

    <script>
        window.vistaPrevia  = true;
        window.id_jugador   = <?php echo $id_jugador; ?>;
        window.sexo         = 2; //SEXO 1 = HOMBRE SEXO 2 = MUJER
        
        $("#btn-enviar-cuestionario-checkin").click(function(){
            console.log('Partes svg Frontal: '+window.zonas_frt);
            console.log('Valore input Frontal: '+window.valzonas_frt);
            console.log('Partes svg Trascero: '+window.zonas_bck);
            console.log('Valore input Trascero: '+window.valzonas_bck);
        });
        $('input[type=range]').on('input', function (e) {
            let min = e.target.min,
            max = e.target.max,
            val = e.target.value;
            
            for (var i = 1; i < 11; i++) {
                if (i != val) {
                    $(e.target).removeClass("custom-range-c"+i);
                }else{
                    $(e.target).addClass("custom-range-c"+i);
                }
            }
        }).trigger('input');
        
        let n_meses     = <?php echo json_encode($meses); ?>;
        let n_zonas_frt = <?php echo json_encode($n_zonas_frt); ?>;
        let n_zonas_bck = <?php echo json_encode($n_zonas_bck); ?>;
        window.zonas_frt = [];
        window.idzonas_frt = [];
        window.valzonas_frt = [];
        window.zonas_bck = [];
        window.idzonas_bck = [];
        window.valzonas_bck = [];
        
        function sector(frontBack,zona){ 
            $('.cont_'+frontBack).each(function () {
                if ('cont_'+frontBack+'_'+zona != $(this).attr('id')) {
                    let lista_cl2 = $(this).attr('class');
                    lista_cl2 = lista_cl2.replace(' show', '');
                    $(this).attr('class', lista_cl2);
                }
            });

            let lista_cl = $('#cont_'+frontBack+'_'+zona).attr('class');
            if (lista_cl.indexOf('show') == -1) {
                lista_cl+= ' show';
            } else {
                lista_cl = lista_cl.replace(' show', '');
            }
            $('#cont_'+frontBack+'_'+zona).attr('class', lista_cl);
        }
        
        function resetear (frontBack,zona) {
            $('#ran_'+frontBack+'_'+zona).val(1);
            for (var i = 2; i < 11; i++) { $('#ran_'+frontBack+'_'+zona).removeClass("custom-range-c"+i); } 
            $('#ran_'+frontBack+'_'+zona).addClass("custom-range-c1");
            
            if(frontBack=='frt' || frontBack=='frtf'){
                var i = window.zonas_frt.indexOf(zona);
                if (i !== -1) {
                    window.zonas_frt.splice(i, 1);
                    window.valzonas_frt.splice(i, 1);
                    
                    $('#'+frontBack+"_"+zona).css('fill-opacity','0');

                }
                console.log('Partes svg: '+window.zonas_frt);
                console.log('Valore input: '+window.valzonas_frt);
            }else{
                var i = window.zonas_bck.indexOf(zona);
                if (i !== -1) {
                    window.zonas_bck.splice(i, 1);
                    window.valzonas_bck.splice(i, 1);
                    
                    $('#'+frontBack+"_"+zona).css('fill-opacity','0');
                }
                console.log('Partes svg: '+window.zonas_bck);
                console.log('Valore input: '+window.valzonas_bck);
            }
            sector(frontBack,zona);
        }
        
        function guardarV (frontBack,zona) {
            let color_opacity = [null,0.18,0.24,0.30,0.36,0.42,0.48,0.54,0.60,0.66,0.72];
            let v = parseInt($('#ran_'+frontBack+'_'+zona).val());
            
            if(frontBack=='frt' || frontBack=='frtf'){
                let i = window.zonas_frt.indexOf(zona);
                if (i === -1) {
                    window.zonas_frt.push(zona);
                    window.valzonas_frt.push(v);
                } else {
                    window.valzonas_frt[i] = v;
                }

                $('#'+frontBack+"_"+zona).css("fill-opacity",color_opacity[v]);

                console.log('Partes svg: '+window.zonas_frt);
                console.log('Valore input: '+window.valzonas_frt);
            } else {
                let i = window.zonas_bck.indexOf(zona);
                if (i === -1) {
                    window.zonas_bck.push(zona);
                    window.valzonas_bck.push(v);
                } else {
                    window.valzonas_bck[i] = v;
                }

                $('#'+frontBack+"_"+zona).css("fill-opacity",color_opacity[v]);

                console.log('Partes svg: '+window.zonas_bck);
                console.log('Valore input: '+window.valzonas_bck);
            }
            sector(frontBack,zona);
        }
        
        var dataUsuario = [];
        $('#iniciar-sesion').click(iniciarSesion);
        function iniciarSesion () {
            $('#img-loader').html('<i class="icon-spinner icon-spin"></i><p>Cargando...</p>');
            $('#img-loader').fadeIn();
            $('#iniciar-sesion').attr('disabled', true);
            //////////////////////////////////////////
            $('#error_inicio').fadeOut();
            
            var data = $("#form_login").serializeArray();
            $.ajax({
                url : 'post/cuestionarioM_login.php',
                type: 'POST',
                data: data,
                dataType: 'json',
                success: function (respuesta) {
                    if (respuesta != null) {
                        dataUsuario = respuesta;
                        window.idusuario = dataUsuario[0].idcuestionario_usuario;
                        $('#nombre').val(dataUsuario[0].nombre_usuario);
                        $('#apellido1').val(dataUsuario[0].apellido1_usuario);
                        $('#apellido2').val(dataUsuario[0].apellido2_usuario);
                        $('#usuario_2').val(dataUsuario[0].rut_usuario);
                        $('#app-container').addClass('show');
                        $('#iniciar-sesion').attr('disabled', false);
                        
                        document.form_login.reset();
                        
                        agregarInpuFile(1); // CARNET
                        agregarInpuFile(2); // PASAPORTE
                    } else {
                        $('#error_inicio').fadeIn();
                    }
                    $('#img-loader').fadeOut();
                },
                error: function () {
                    $('#iniciar-sesion').attr('disabled', false);
                    $('#error_inicio').fadeIn();
                    $('#img-loader').fadeOut();
                }, timeout: 15000
            });
        }
        
        $('#btn-cuestionario_checkin').click(mostrarCuestionarioCheckin);
        function mostrarCuestionarioCheckin() {
            verificarCampoDolor();
            $('#cuestionario_checkin').addClass('show');
            
            if (window.sexo == 1) {
                $('.mujer_front').hide();
                $('.mujer_back').hide();
                
                $('.hombre_front').css('display', 'inline-block');
                $('.hombre_back').css('display', 'inline-block');
            } else {
                $('.hombre_front').hide();
                $('.hombre_back').hide();
                
                $('.mujer_front').css('display', 'inline-block');
                $('.mujer_back').css('display', 'inline-block');
            }
        }
        
        $('#btn-volver-perfil').click(volverAPerfil);
        function volverAPerfil () {
            $('#cuestionario_checkin').removeClass('show');
            document.cuestionario_checkin_form.reset();
        }
        
        $('#dolor').change(verificarCampoDolor);
        function verificarCampoDolor() {
            if ($('#dolor').val() == 2) {
                $('#cont-zona_dolencia').show(200);
                $('#cont-intensidad_dolor').show(200);
            } else {
                $('#cont-zona_dolencia').hide(200);
                $('#cont-intensidad_dolor').hide(200);
            }
        }
        
        $('.soloNumeros').keypress(function (e) {
            if (!(e.keyCode >= 48 && e.keyCode <= 57)) {
                e.preventDefault();
            }
        });
        $('#suenio').keyup(function (e) {
            let valor = parseInt($('#suenio').val());
            if (valor > 14) {
                $('#suenio').val(14);
            }
        });
        $('#intensidad_dolor').keyup(function (e) {
            let valor = parseInt($('#intensidad_dolor').val());
            if (valor > 10) {
                $('#intensidad_dolor').val(10);
            }
        });
        
        setInterval(function () {
            if (dataUsuario.length == 0) {
                if ($('#app-container').hasClass('show')) {
                    $('#app-container').removeClass('show');
                    
                    $('#img-loader').html('<i class="icon-warning-sign"></i><p>Sin permiso</p>');
                    $('#img-loader').fadeIn();
                    
                    setTimeout(function () {
                        $('#img-loader').fadeOut();
                    }, 3000);
                }
                
                if ($('#cuestionario_checkin').hasClass('show')) {
                    $('#cuestionario_checkin').removeClass('show');
                    
                    $('#img-loader').html('<i class="icon-warning-sign"></i><p>Sin permiso</p>');
                    $('#img-loader').fadeIn();
                    
                    setTimeout(function () {
                        $('#img-loader').fadeOut();
                    }, 3000);
                }
            }
        }, 100);
        
        function agregarInpuFile (tipo) {
            let contenedor = '';
            contenedor += '<div style="margin-bottom: 10px;">';
                contenedor += '<form class="formulario_imagen_'+tipo+'" enctype="multipart/form-data">';
                    let padding = '';
                    if      (tipo == '1') { padding = 'padding-right: 2.5px;'; }
                    else if (tipo == '2') { padding = 'padding-left: 2.5px;'; }
                    
                    contenedor += '<div style="margin: 0px 0px 5px; display: flex; justify-content: space-between; align-items: center; '+padding+'">';
                        contenedor += '<div class="img_btn" style="text-align: center; width: 100%;">';
                            let url_img = '';
                            if (tipo == 1) { url_img = '../config/icon_card_id.png'; }
                            else { url_img = '../config/icon_passport.png'; }
                            
                            contenedor += '<label for="img_ejercicio_'+tipo+'" style="display: inline-block; position: relative;"><img src="'+url_img+'?'+Math.random()+'" style="height: 40px;">';
                            contenedor += '<i class="icon-plus" style="height: 16px; width: 16px; position: absolute; top: -7px; right: -8px; background: white; border-radius: 50%; text-align: center; cursor: pointer;"></i></label>';
                            contenedor += '<input type="file" name="img_ejercicio_'+tipo+'" id="img_ejercicio_'+tipo+'" class="img_ejercicio_'+tipo+'" accept=".jpg, .png, .jpeg" style="display: none;" onchange="subirImagen('+tipo+')">';
                            
                            let prefijo     = '';
                            let descripcion = '';
                            let fecha_v     = '';
                            if      (tipo == '1') { prefijo = 'c_'; descripcion = 'Sin canet';      fecha_v = '2022-05-12'; }
                            else if (tipo == '2') { prefijo = 'p_'; descripcion = 'Sin pasaporte';  fecha_v = '2024-07-12'; }
                            
                            contenedor += '<div id="enlace_'+tipo+'" style="margin-top: 5px; text-align: center;">';
                                contenedor += '<img src="archivos/'+prefijo+window.id_jugador+'.png" onerror="ocultar('+tipo+');" style="display: none;"/>';
                                contenedor += '<b style="font-size: 11px; cursor: pointer;"><a id="link_'+tipo+'" onclick="vista_previa('+tipo+');"><i class="icon-external-link"></i> Ver</a></b>';
                                contenedor += '<b style="font-size: 11px;"><a id="link2_'+tipo+'" style="display: none;"><i class="icon-unlink"></i> '+descripcion+'</a></b>';
                                contenedor += '<span id="fecha_v_'+tipo+'" style="display: none;">'+fecha_v+'</span>';
                            contenedor += '</div>';
                        contenedor += '</div>';
                    contenedor += '</div>';
                    
                    contenedor += '<div id="barra_progreso_'+tipo+'" style="margin: 0px; height: 5px; width: 100%; '+padding+'"><div id="carga_progreso_'+tipo+'" style="height: 5px; background-color: #28b779; width: 0%;"></div></div>';
                    contenedor += '<p id="advertencia_error_'+tipo+'" style="margin: 0px; font-size: 10px; color: #B92121; display: none; '+padding+'"></p>';
                contenedor += '</form>';
            contenedor += '</div>';
            
            if (tipo == 1) { $('#contenedor_p_documentos').html(contenedor); }
            else { $('#contenedor_c_documentos').html(contenedor); }
        }
        
        function ocultar (tipo) {
            $('#link_'+tipo).hide();
            $('#link2_'+tipo).show();
        }
        
        function subirImagen (tipo) {
            window.tipo = tipo;
            window.vistaPrevia = false;
            let inputFileImage = $($('.img_ejercicio_'+tipo)[0])[0];
            
            $('#btn-menu').attr('disabled', true);
            $('#btn-cuestionario_checkin').attr('disabled', true);
            $('#btn-cuestionario_checkout').attr('disabled', true);
            
            $('#barra_progreso_'+tipo).show();
            $('#carga_progreso_'+tipo).animate({width: "0%" }, 1000);
            $('#advertencia_error_'+tipo).hide();
            
            let fileName    = inputFileImage.files[0].name;
            var file        = inputFileImage.files[0];
            var data        = new FormData();
            data.append('archivo', file);
            data.append('id_jugador', '<?php echo $id_jugador; ?>');
            data.append('tipo', tipo);
            
            $('#carga_progreso_'+tipo).animate({width: "80%" }, 5000);
            $.ajax({
                url: 'post/cuestionario_subir_img.php',
                type: 'POST',
                data: data,
                contentType: false,
                processData: false,
                cache: false,
                success: function (respuesta) {
                    $('#carga_progreso_'+tipo).animate({width: "99%"}, 2000, function luego(){
                        agregarInpuFile(tipo);
                        
                        if (respuesta == 'Exitoso') {
                            $('#img-loader').html('<i class="icon-ok"></i><p>Cargado<br>exitosamente</p>');
                            $('#img-loader').fadeIn();
                            
                            setTimeout(function () {
                                $('#img-loader').fadeOut();
                                
                                let descripcion = '';
                                if      (tipo == '1') { descripcion = 'CARNET'; }
                                else if (tipo == '2') { descripcion = 'PASAPORTE'; }
                                
                                $('#titulo_modal').html('<b>'+descripcion+'</b>');
                                $('.vencimiento').val('');
                                cargarDias();
                                $('#form_fechas').fadeIn();
                            }, 2100);
                        } else if (respuesta == 'Error') {
                            $('#img-loader').html('<i class="icon-remove"></i><p><b>[Error]: No se pudo<br>cargar la imagen</b></p>');
                            $('#img-loader').fadeIn();
                            
                            $('#btn-menu').attr('disabled', false);
                            $('#btn-cuestionario_checkin').attr('disabled', false);
                            $('#btn-cuestionario_checkout').attr('disabled', false);
                            
                            setTimeout(function () { $('#img-loader').fadeOut(); }, 2100);
                        }
                        $('#barra_progreso_'+tipo).hide();
                    });
                }
            });
        }
        
        function vista_previa (tipo) {
            if (window.vistaPrevia) {
                $('#vista_previa').fadeIn();
                $('#i_vista_previa').empty();
                
                $('#btn-cuestionario_checkin').attr('disabled', true);
                $('#btn-cuestionario_checkout').attr('disabled', true);
                
                let prefijo = '';
                if      (tipo == '1') { prefijo = 'c_'; }
                else if (tipo == '2') { prefijo = 'p_'; }
                
                let contenido_img = '';
                contenido_img += '<div>';
                contenido_img += '<img src="archivos/'+prefijo+window.id_jugador+'.png?'+Math.random()+'" style="width: 100%; background: white;">';
                contenido_img += '</div>';
                $('#i_vista_previa').html(contenido_img);
                
                let fecha_v = $('#fecha_v_'+tipo).html();
                $('#vista_fv').html(fecha_v.substr(8, 2)+' de '+n_meses[parseInt(fecha_v.substr(5, 2))]+' de '+fecha_v.substr(0, 4));
            }
        }
        
        function cerrarVistaPrevia () {
            $('#vista_previa').fadeOut();
            $('#i_vista_previa').empty();
            
            $('#btn-cuestionario_checkin').attr('disabled', false);
            $('#btn-cuestionario_checkout').attr('disabled', false);
        }
        
        function cargarDias () {
            if ($('#mes_vencimiento').val() != '' && $('#anio_vencimiento').val() != '') {
                let cant_dias = daysInMonth($('#mes_vencimiento').val(), $('#anio_vencimiento').val());
                
                $('#dia_vencimiento').html('<option value="">Elija el dia</option>');
                for (let i = 1; i <= cant_dias; i++) {
                    let new_i = i;
                    if (new_i < 10) { new_i = '0'+new_i; }
                    $('#dia_vencimiento').append('<option value="'+new_i+'">'+new_i+'</option>');
                }
            } else {
                $('#dia_vencimiento').html('<option value="">Elija un men y un año</option>');
            }
        }
        
        function guardarFechaV () {
            if ($('#dia_vencimiento').val() != '' && $('#mes_vencimiento').val() != '' && $('#anio_vencimiento').val() != '') {
                window.vistaPrevia = true;
                
                $('#form_fechas').fadeOut();
                $('#btn-menu').attr('disabled', false);
                $('#btn-cuestionario_checkin').attr('disabled', false);
                $('#btn-cuestionario_checkout').attr('disabled', false);
                $('#fecha_v_'+window.tipo).html($('#anio_vencimiento').val()+'-'+$('#mes_vencimiento').val()+'-'+$('#dia_vencimiento').val());
                
                $('#img-loader').html('<i class="icon-spinner icon-spin"></i><p>Cargando...</p>');
                $('#img-loader').fadeIn();
                
                setTimeout(function () {
                    $('#img-loader').html('<i class="icon-ok"></i><p>Cargado<br>exitosamente</p>');
                    setTimeout(function () { $('#img-loader').fadeOut(); }, 2000);
                }, 1500);
            } else {
                $('#img-loader').html('<i class="icon-remove"></i><p>Rellene los datos</p>');
                $('#img-loader').fadeIn();
                setTimeout(function () { $('#img-loader').fadeOut(); }, 2100);
            }
        }
        
        function daysInMonth (humanMonth, year) {
            return new Date(year || new Date().getFullYear(), humanMonth, 0).getDate();
        }
        
        class Pushbar {
            constructor(config = { overlay: true, blur: false }) {
                this.activeId;
                this.activeElement;
                this.overlayElement;
                if (config.overlay) {
                    this.overlayElement = document.createElement('div');
                    this.overlayElement.classList.add('pushbar_overlay');
                    document.querySelector('body').appendChild(this.overlayElement);
                }
                if (config.blur) {
                    const mainContent = document.querySelector('.pushbar_main_content');
                    if (mainContent) {
                        mainContent.classList.add('pushbar_blur');
                    }
                }
                this.bindEvents();
            }
            
            emitOpening() {
                const event = new CustomEvent('pushbar_opening', { bubbles: true, detail: { element: this.activeElement, id: this.activeId } });
                this.activeElement.dispatchEvent(event);
            }
            
            emitClosing() {
                const event = new CustomEvent('pushbar_closing', { bubbles: true, detail: { element: this.activeElement, id: this.activeId } });
                this.activeElement.dispatchEvent(event);
            }
            
            handleOpenEvent(e) {
                e.preventDefault();
                const pushbarId = e.currentTarget.getAttribute('data-pushbar-target');
                this.open(pushbarId);
            }
            
            handleCloseEvent(e) {
                e.preventDefault();
                this.close();
            }
            
            handleKeyEvent(e) {
                if (e.keyCode === 27) this.close();
            }
            
            bindEvents() {
                const triggers = document.querySelectorAll('[data-pushbar-target]');
                const closers = document.querySelectorAll('[data-pushbar-close]');
                triggers.forEach(trigger => trigger.addEventListener('click', e => this.handleOpenEvent(e), false));
                closers.forEach(closer => closer.addEventListener('click', e => this.handleCloseEvent(e), false));
                if (this.overlayElement) {
                    this.overlayElement.addEventListener('click', e => this.handleCloseEvent(e), false);
                }
                document.addEventListener('keyup', e => this.handleKeyEvent(e));
            }
            
            open(pushbarId) {
                if (this.activeId === String(pushbarId) || !pushbarId) return;
                if (this.activeId && this.activeId !== String(pushbarId)) this.close();
                this.activeId = pushbarId
                this.activeElement = document.querySelector(`[data-pushbar-id="${this.activeId}"]`)
                if (!this.activeElement) return;
                this.emitOpening();
                this.activeElement.classList.add('opened');
                const pageRootElement = document.querySelector('html')
                pageRootElement.classList.add('pushbar_locked');
                pageRootElement.setAttribute('pushbar', pushbarId)
            }
            
            close() {
                if (!this.activeId) return;
                this.emitClosing();
                this.activeElement.classList.remove('opened');
                const pageRootElement = document.querySelector('html')
                pageRootElement.classList.remove('pushbar_locked');
                pageRootElement.removeAttribute('pushbar')
                this.activeId = null;
                this.activeElement = null;
            }
        }
        var pushbar = new Pushbar({
            blur:true,
            overlay:true,
          });
        
        $(".submenu").click(function(){
            $(this).children("ul").slideToggle();
        });
        $("ul").click(function(p){
            p.stopPropagation();
        });

        
        var $radios = $('#cuestionario_checkin .tabla_opciones input:radio');
        $radios.change(function () {
            $(this).parent().siblings('td').removeClass('checked');
            $(this).parent().addClass('checked');
        });    

        // -------------------------------------------------------------------------------- //
        var $celda_input_radio = $('#cuestionario_checkin .tabla_opciones .celda-input-radio');
        $celda_input_radio.click(function () {
            $(this).find('input:radio').trigger('change');
        });   

        var $celda_input_radio = $('#cuestionario_checkin .tabla_opciones .celda-input-radio input:radio');
        $celda_input_radio.change(function () {
            
            $(this).parent().siblings('td').find('input:radio').prop('checked', false);
            $(this).parent().siblings('td').removeClass('checked');
            
            $(this).prop('checked', true);
            $(this).parent().addClass('checked');

        });  

        // -------------------------------------------------------------------------------- //
        var $celda_input_radio = $('#cuestionario_checkin .tabla_opciones .celda-input-radio-t5');
        $celda_input_radio.click(function () {
            $(this).find('input:radio').trigger('change');
        });   

        var $celda_input_radio = $('#cuestionario_checkin .tabla_opciones .celda-input-radio-t5 input:radio');
        $celda_input_radio.change(function () {
            
            $('td.celda-input-radio-t5').find('input:radio').prop('checked', false);
            $('td.celda-input-radio-t5').removeClass('checked');
            
            $(this).prop('checked', true);
            $(this).parent().addClass('checked');

        });                            

    </script>
</body>
</html>