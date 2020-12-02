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
        }

        #cuestionario_checkin .tabla_opciones tbody tr td {
            border-right: 1px solid black;
        }

        #cuestionario_checkin .tabla_opciones tr:nth-child(even) {
            background-color: #d3d3d3;
        }

        #cuestionario_checkin .tabla_opciones tr:nth-child(odd) {
            background-color: #FFF;
        }

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
            text-align: left;
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
            font-size: 10px;
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

    </style>

    <!-- Archivos JS -->
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

            <div style="width: 100%; margin-bottom: 60px;">
                <img src="../config/cinetica_logo_header.png" style="width: 63px;height: 20px;float: right;">
            </div>

            <div class="titulo-cuestionario div-responsive" style="overflow: hidden;">
                <div style="float: left;width: 14%;">
                    <img src="../config/cinetica_logo.png" style="width: 100%; height: 80px;">
                </div>
                <div style="float: right;width: 83%;padding-left: 10px;">
                    <p class="small-text">El diagnóstico de la diversidad: establecemos el perfil de aprendizaje del alumnado</p>
                    <p class="big-text">TEST SISTEMA DE REPRESENTACIÓN DOMINANTE</p>
                    <p class="small-text">Diseñado por Ralph Metts (1999) y re-maquetado por Colectivo Cinética</p>
                    <p class="small-text"><a class="a-colectivo-cinetica" href="https://www.colectivocinetica.es" target="_blank">www.colectivocinetica.es</a> - info@colectivocinetica.es</p>
                </div>

                <div class="div-responsive" style="clear: both; max-width: 600px; margin: auto;width: 600px; margin-top: 100px; margin-bottom: 25px;">
                    <p class="small-text" style="margin: 0; margin: 10px 0px; color: gray;">Establece cuál es tu sistema de representación dominante valorando desde el 1 (muy en desacuerdo) al 5 (totalmente de cuerdo) las siguientes afirmaciones.</p>
                </div>          

            </div>

            <div class="container-responsive-table">
                <table class="tabla_opciones">
                    <tbody></tbody>
                </table>
            </div>
        
            <div class="div-responsive">
                <p class="small-text"><span style="text-decoration: overline; font-weight: normal;">En Colectivo Cinética creemos que la</span> innovación educativa ha de basarse en el intercambio y la construcción compartida de conocimientos. Por eso, en aras de promover la inteligencia colectiva, os autorizamos a utilizar, modificar y compartir este documento, siempre que respetéis su autoría y, por supuesto, lo convirtáis en algo mejor.</p>
            </div>


            <div class="div-responsive">
                <p class="big-text" style="text-align: left;margin: 20px 0px 0px 0px;">EVALUACIÓN DEL TEST</p>
                <p class="small-text" style="font-size: 12px; margin: 3px 0px 25px 0px;">Rellena las siguientes tablas escribiendo en el recuadro de cada pregunta la puntuación que estableciste en el test anterior. Luego suma estos puntajes y tendrás tu sistema de representación dominante: los que presenten valores más altos</p>
            </div>
    
            <!-- ================================================ Inicio del class="container-responsive-table" ================================================ -->
            <div class="container-responsive-table">
            <!-- ================================================ RESULTADO DE TEST VISUAL ================================================ -->
                <table class="tabla_resultados_test">
                    <tr>
                        <td class="titulo-tabla-resultado" rowspan="2"><div>visual</div></td>
                        <th>1</th>
                        <th>3</th>
                        <th>6</th>
                        <th>9</th>
                        <th>10</th>
                        <th>11</th>
                        <th>14</th>
                        <th>16</th>
                        <th class="celda-total">TOTAL</th>
                    </tr>
                    <tr>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td class="celda-total"><input class="celda-total" type="" name=""></td>
                    </tr>                
                </table>

                <!-- ================================================ RESULTADO DE TEST AUDITIVO ================================================ -->
                <table class="tabla_resultados_test">
                    <tr>
                        <td class="titulo-tabla-resultado" rowspan="2"><div>auditivo</div></td>
                        <th>2</th>
                        <th>5</th>
                        <th>12</th>
                        <th>15</th>
                        <th>17</th>
                        <th>18</th>
                        <th>21</th>
                        <th>23</th>
                        <th class="celda-total">TOTAL</th>
                    </tr>
                    <tr>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td class="celda-total"><input class="celda-total" type="" name=""></td>
                    </tr>                
                </table>  

                <!-- ================================================ RESULTADO DE TEST KINESTÉSICO ================================================ -->
                <table class="tabla_resultados_test">
                    <tr>
                        <td class="titulo-tabla-resultado" rowspan="2"><div>kinestésico</div></td>
                        <th>4</th>
                        <th>7</th>
                        <th>8</th>
                        <th>13</th>
                        <th>19</th>
                        <th>20</th>
                        <th>22</th>
                        <th>24</th>
                        <th class="celda-total">TOTAL</th>
                    </tr>
                    <tr>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td><input type="" name=""></td>
                        <td class="celda-total"><input class="celda-total" type="" name=""></td>
                    </tr>                
                </table>                
            </div>            
            <!-- ================================================ Fin del class="container-responsive-table" ================================================ -->            

            <div class="div-responsive" style="display: flex;align-items: stretch; margin: 15px 0px;">
                
                <div class="div-resultado-test">
                    <p class="big-text-resultado-test text-center text-bold">VISUAL</p>
                    <p class="normal-text-resultado-test text-bold text-left">CÓMO APRENDO…</p>
                    <p class="normal-text-resultado-test text-left">APRENDO LO QUE VEO. PIENSO EN IMÁGENES.</p>
                    <p class="normal-text-resultado-test text-left">NECESITO UNA VISIÓN DETALLADA DE TODO. ME CUESTA RECORDAR LO QUE OIGO.</p>
                    <p class="normal-text-resultado-test text-left">ALMACENO INFORMACIÓN RÁPIDAMENTE Y EN CUALQUIER ORDEN.</p>
                    <p class="normal-text-resultado-test text-left">ME DISTRAIGO CON EL MOVIMIENTO Y EL DESORDEN VISUAL. EL RUIDO NO ME MOLESTA DEMASIADO.</p>
                    <p style="margin-top: 20px;" class="normal-text-resultado-test text-bold text-right">PROPUESTAS ADECUADAS PARA MÍ</p>
                    <p class="normal-text-resultado-test text-right">VER, MIRAR, IMAGINAR, LEER, PELÍCULAS, DIBUJOS, VIDEOS, MAPAS, CARTELES, DIAGRAMAS, FOTOS, CARICATURAS, DIAPOSITIVAS, PINTURAS, EXPOSICIONES, TARJETAS, TELESCOPIOS, MICROSCOPIOS,  BOCETOS.</p>
                    <div class="break-div-result-test"></div>
                    <div class="div-img-resultado-test">
                        <img class="img-resultado-test" src="../config/visual.png">
                    </div>
                </div>

                <div class="div-resultado-test" style="margin: 0 40px;">
                    <p class="big-text-resultado-test text-center text-bold">AUDITIVO</p>
                    <p class="normal-text-resultado-test text-bold text-left">CÓMO APRENDO…</p>
                    <p class="normal-text-resultado-test text-left">APRENDO LO QUE OIGO.</p>
                    <p class="normal-text-resultado-test text-left">TIENDO A UTILIZAR LA REPETICIÓN ORAL.</p>
                    <p class="normal-text-resultado-test text-left">NO SUELO TENER UNA VISIÓN GLOBAL DE LAS COSAS. ALMACENO INFORMACIÓN DE MANERA SECUENCIAL Y POR</p>
                    <p class="normal-text-resultado-test text-left">BLOQUES ENTEROS, POR ESO ME PIERDO SI ME PREGUNTAS POR UN ELEMENTO AISLADO O ME CAMBIAS EL ORDEN DE LA PREGUNTA.</p>
                    <p class="normal-text-resultado-test text-left">ME DISTRAIGO CON EL RUIDO.</p>
                    <p style="margin-top: 20px;" class="normal-text-resultado-test text-bold text-right">PROPUESTAS ADECUADAS PARA MÍ</p>
                    <p class="normal-text-resultado-test text-right">
                        ESCUCHAR, OÍR, CANTAR, RITMO, DEBATES, DISCUSIONES, CINTAS AUDIO, LECTURAS, HABLAR EN PÚBLICO, TELEFONEAR, GRUPOS
                        PEQUEÑOS,  ENTREVISTAS.                        
                    </p>
                    <div class="break-div-result-test"></div>
                    <div class="div-img-resultado-test">
                        <img class="img-resultado-test" src="../config/auditivo.png">
                    </div>
                </div>
                
                <div class="div-resultado-test">
                    <p class="big-text-resultado-test text-center text-bold">KINESTÉSICO</p>
                    <p class="normal-text-resultado-test text-bold text-left text-bold">CÓMO APRENDO…</p>
                    <p class="normal-text-resultado-test text-left">APRENDO TOCANDO Y HACIENDO.</p>
                    <p class="normal-text-resultado-test text-left">NECESITO INVOLUCRARME FÍSICAMENTE EN EL TRABAJO.</p>
                    <p class="normal-text-resultado-test text-left">SOY MÁS DE IMPRESIONES GENERALES QUE DE DETALLES.</p>
                    <p class="normal-text-resultado-test text-left">ALMACENO INFORMACIÓN A TRAVÉS DE SENSACIONES CORPORALES Y MOVIMIENTO.</p>
                    <p class="normal-text-resultado-test text-left">ME DISTRAIGO CUANDO LAS EXPLICACIONES SON BÁSICAMENTE AUDITIVAS Y NO ME INVOLUCRAN DE ALGUNA FORMA</p>
                    <p style="margin-top: 20px;" class="normal-text-resultado-test text-bold text-right">PROPUESTAS ADECUADAS PARA MÍ</p>
                    <p class="normal-text-resultado-test text-right">TOCAR, MOVER, SENTIR, TRABAJO DE CAMPO, PINTAR, DIBUJAR, BAILAR, LABORATORIO, HACER COSAS, MOSTRAR, REPARAR COSAS.</p>
                    <div class="break-div-result-test"></div>
                    <div class="div-img-resultado-test">
                        <img class="img-resultado-test" style="/*position: relative; left: 10px;*/" src="../config/kinestesico.png">
                    </div>
                </div>

            </div>            

            <center>
                <p>Generar PDF</p>
            </center>

            <div class="btn-center">
                <!-- <button type="button" id="btn-enviar-cuestionario-checkin" class="btn">Enviar cuestionario</button> -->
                <button type="button" id="btn-pdf-representacion" class="btn" onclick="descargarPDF(1);">Representación</button>
                <button type="button" id="btn-pdf-personalidad" class="btn" onclick="descargarPDF(2);">Personalidad</button>
                <button type="button" id="btn-pdf-cprd" class="btn" onclick="descargarPDF(3);">CPRD</button>
                <button type="button" id="btn-pdf-udc" class="btn">UDC</button>
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

    <!-- ************************************************ Modal del PDF ************************************************ -->
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

    
        let array_items_test = [
            'nulo',
            'Me ayuda escribir a mano las palabras cuando tengo que aprenderlas de memoria',
            'Recuerdo mejor las cosas cuando las cuenta el profesor/a que leyéndolas en el libro de texto',
            'Se me dan bien las pruebas en las que tengo que demostrar lo aprendido leyendo el libro de texto',
            'Me gusta comer y mascar chicle mientras estudio y hago ejercicios',
            'Si presto atención a una exposición oral, puedo recordar las ideas principales sin anotarlas',
            'Prefiero las instrucciones escritas antes que las orales',
            'Resuelvo muy bien rompecabezas y laberintos',
            'Se me dan bien las pruebas en las que he de demostrar lo que aprendí oyendo una conferencia',
            'Me ayuda ver diapositivas y videos para comprender un tema',
            'Recuerdo más cuando leo un libro que cuando escucho una exposición oral',
            'Por lo general, tengo que escribir los números del teléfono para recordarlos bien',
            'Prefiero recibir las noticias escuchando la radio antes que leerlas en un periódico',
            'Me gusta tener algo como un bolígrafo o un lápiz en la mano cuando estudio',
            'Necesito copiar los ejemplos de la pizarra del profesor/a para poder repasarlos más tarde',
            'Prefiero las instrucciones orales del profesor/a a aquellas escritas en un examen o en la pizarra',
            'Prefiero que los libros con diagramas gráficos y cuadros porque me ayudan a aprender mejor',
            'Me gusta escuchar música al hacer ejercicios y estudiar.',
            'Las clases que más me gustan son aquellas en las que se organizan debates y se puede dialogar',
            'Puedo corregir mi propia tarea examinándola y encontrando la mayoría de los errores',
            'Prefiero las actividades en las que tengo que hacer cosas y puedo moverme',
            'Puedo recordar los números de teléfono cuando los oigo',
            'Me encanta hacer cosas con las manos y herramientas',
            'Cuando escribo algo, necesito leerlo en voz alta para oír como suena',
            'Recuerdo mejor las cosas cuando puedo moverme o caminar mientras estoy aprendiéndolas'
        ];

        let count = 1;
        for( let i=1; i<array_items_test.length; i++ ) {

            let item = array_items_test[i];

            let markup = 
            '<tr>\
                <td style="width: 20px; text-align: center;"><span>'+count+'</span></td>\
                <td class="td-descripcion-item">\
                    <p class="descripcion-item-text">'+item+'</p>\
                </td>\
                <td>\
                    <input type="radio" name="item_'+count+'" id="item_'+count+'_1" value="1">\
                    <label for="item_'+count+'_1" class="label-opcion">1</label>\
                </td>\
                <td>\
                    <input type="radio" name="item_'+count+'" id="item_'+count+'_2" value="2">\
                    <label for="item_'+count+'_2" class="label-opcion">2</label>\
                </td>\
                <td>\
                    <input type="radio" name="item_'+count+'" id="item_'+count+'_3" value="3">\
                    <label for="item_'+count+'_3" class="label-opcion">3</label>\
                </td>\
                <td>\
                    <input type="radio" name="item_'+count+'" id="item_'+count+'_4" value="4">\
                    <label for="item_'+count+'_4" class="label-opcion">4</label>\
                </td>\
                <td>\
                    <input type="radio" name="item_'+count+'" id="item_'+count+'_5" value="5">\
                    <label for="item_'+count+'_5" class="label-opcion">5</label>\
                </td>\
            </tr>';

            count++;
            $('.tabla_opciones').append( markup );

        }

        
        var $radios = $('#cuestionario_checkin .tabla_opciones input:radio');
        $radios.change(function () {

            $(this).parent().siblings('td').find('input:radio').prop('checked', false);
            $(this).parent().siblings('td').removeClass('checked');
            
            $(this).parent().addClass('checked');
            $(this).parent().addClass('checked');

        });
               

        /*
        $('#cuestionario_checkin .tabla_opciones input:radio').on('change', function() {
              if( $(this).is(':checked') ){
                $(this).parents('td').css('background-color', '');
                $(this).parent('td').addClass('checked');
              } else {
                $(this).parent('td').removeClass('checked');
              }
        });
        */

    // --------------------------------------- Inicio de la función closeModal_pdf() --------------------------------------- // 
    function closeModal_pdf(){
        $("#descargarPDF").modal('hide');
    }
    // --------------------------------------- Fin de la función closeModal_pdf() --------------------------------------- //

    // --------------------------------------- Inicio de la función descargarPDF() --------------------------------------- //
    function descargarPDF( archivo ){

        let url; 
        switch( archivo ) {

            case 1:
                url = 'post/reportes/generarPDF_cuestionario_representacion.php';
                break;

            case 2:
                url = 'post/reportes/generarPDF_cuestionario_personalidad.php';
                break;

            case 3:
                url = 'post/reportes/generarPDF_cuestionario_cprd_deportivo.php';
                break;                


        }

        $("#descargarPDF").modal('show');
        $('#mensaje_agregar_descargarPDF').html('<h5><i class="icon-spinner icon-spin icon-large"></i> Generando PDF...</h5><br><img src="../config/agregar_archivo.png">');

        $.ajax({
            url: url,
            type: "post",
            data: {
                
            },
            dataType: 'json',
            cache: false,
            success: function(respuesta){
                if(respuesta != ''){
                    $('#mensaje_agregar_descargarPDF').html('<h5>PDF Generado Exitosamente...</h5><br><button type="submit" class="boton_informe_jugador" style="border-radius: 5px" id="boton_agregar_informe" ><a  class="btn_descargar" onClick="closeModal_pdf();" download href="reportes_pdf/'+respuesta+'">DESCARGAR PDF</a></button>');

                    // window.location='reportes_pdf/'+respuesta+'';
                    window.open('reportes_pdf/'+respuesta+'', '_blank');
                    // window.open('/reportes_pdf/' +respuesta + '/', '_blank', '');

                }else{
                    $('#mensaje_agregar_descargarPDF').html('<h5>Error de conexión: los datos no se han podido consultar.</h5><br>');
                }
                
            },error: function(){// will fire when timeout is reached
               $('#mensaje_agregar_descargarPDF').html('<h5 style="color: #dc4e4e;"><i class="icon-warning-sign"></i> <b>ERROR:</b> compruebe conexión a internet.</h5>');
            }, timeout: 15000 // sets timeout to 3 seconds
        }); 
        // }, 1500);

    }
    // --------------------------------------- Fin de la función descargarPDF() --------------------------------------- // 

    </script>
</body>
</html>